DELIMITER $$
--
-- Procedures
/* trying new trigger */
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_user_credentials` (IN `in_email` VARCHAR(255), IN `in_password` VARCHAR(255), OUT `out_session_id` VARCHAR(128), OUT `out_user_id` INT, OUT `out_username` VARCHAR(255), OUT `query_status` VARCHAR(255))   BEGIN
    DECLARE valid_user_id INT;
    DECLARE valid_username VARCHAR(255);
    DECLARE new_session_id VARCHAR(128);
    DECLARE new_timestamp DATETIME;
    DECLARE ex_session VARCHAR(255);
    DECLARE ex_user VARCHAR(255);
    DECLARE login_status VARCHAR(255);
    DECLARE is_verified INT;

    SELECT user_id, fname, verified
    INTO valid_user_id, valid_username, is_verified
    FROM tbl_user
    WHERE email = in_email AND password = in_password
    LIMIT 1;

    IF valid_user_id IS NOT NULL AND is_verified = 1 THEN
        SELECT session_id, user_id
        INTO ex_session, ex_user
        FROM tbl_session
        WHERE user_id = valid_user_id;

        IF ex_session IS NOT NULL THEN
            SET out_session_id = ex_session;
            SET out_user_id = ex_user;
            SET out_username = valid_username;
            SET login_status = "OK";
        ELSE 
            SET new_session_id = SHA1(NOW());
            SET new_timestamp = NOW();

            INSERT INTO tbl_session (session_id, user_id, login_time, Status)
            VALUES (new_session_id, valid_user_id, new_timestamp, 1);

            SET out_session_id = new_session_id;
            SET out_user_id = valid_user_id;
            SET out_username = valid_username;
            SET login_status = "OK";
        END IF;
    ELSEIF valid_user_id IS NOT NULL AND is_verified = 0 THEN
        SET out_session_id = NULL;
        SET out_user_id = NULL;
        SET out_username = NULL;
        SET login_status = "User not verified";
    ELSE
        SET out_session_id = NULL;
        SET out_user_id = NULL;
        SET out_username = NULL;
        SET login_status = "Invalid Credentials";
    END IF;

    SET query_status = login_status;
END$$




DELIMITER $$

CREATE TRIGGER `check_email_duplicate` BEFORE INSERT ON `tbl_user` FOR EACH ROW BEGIN
    DECLARE email_exists INT;
    
    -- Check if the email already exists in tbl_user
    SELECT COUNT(*) INTO email_exists
    FROM tbl_user
    WHERE email = NEW.email;
    
    -- Set the message based on email existence
    IF email_exists > 0 THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'email exists';
    END IF;
END
$$

-- Procedure to cancle order by buyer
DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cancelOrder`(
    IN `in_product_id` INT,
    IN `in_user_id` INT,
    OUT `process_status` VARCHAR(20)
)
BEGIN
    DECLARE db_message VARCHAR(20);
    
    -- Default process_status
    SET process_status = 'UNKNOWN';

    -- Fetchs the order status from tbl_order for the given product_id and user_id
    SELECT order_status INTO db_message
    FROM tbl_order
    WHERE product_id = in_product_id AND buyer_id = in_user_id
    LIMIT 1;

    -- Checks the order status and sest the product_status and process_status accordingly
    IF db_message IS NOT NULL THEN
        IF db_message = 'ORDERED' THEN
            -- Deletes the order from tbl_order
            DELETE FROM tbl_order 
            WHERE product_id = in_product_id AND buyer_id = in_user_id;

            -- Updates the wishlist item status
            UPDATE tbl_wishlist_item
            SET product_status = 'UNORDERED'
            WHERE product_id = in_product_id AND user_id = in_user_id;

            -- Sets process status
            SET process_status = 'CANCELED';
        ELSEIF db_message = 'DISPATCHED' THEN
            SET process_status = 'DECLINED';
        END IF;
    ELSE
        -- If no order status found
        SET process_status = 'NOT_FOUND';
    END IF;
END$$

DELIMITER;

-- procedure to update the order transaction 
DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateOrderStatus`(
    IN in_order_id INT,
    IN in_user_id INT,
    IN in_product_id INT,
    IN transaction_type VARCHAR(255)
)
BEGIN
    IF transaction_type = 'DECLINED' THEN
        -- Update order status to 'DECLINED'
        UPDATE tbl_order
        SET order_status = 'DECLINED'
        WHERE order_id = in_order_id;

    ELSEIF transaction_type = 'DISPATCHED' THEN
        -- Update order status to 'DISPATCHED'
        UPDATE tbl_order
        SET order_status = 'DISPATCHED'
        WHERE order_id = in_order_id;
        
    END IF;
    
    -- Update product status to 'UNORDERED' in tbl_wishlist_item
    UPDATE tbl_wishlist_item
    SET product_status = 'UNORDERED'
    WHERE user_id = in_user_id AND product_id = in_product_id;

END$$

DELIMITER;


--Procedure to check if offer is already present
 DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `check_buyer`(IN `buyer_id` INT, IN `for_product_id` INT, IN `offer_amount` DECIMAL(10,2), OUT `response_message` VARCHAR(255))
BEGIN
    DECLARE count INT;
    SELECT COUNT(*) INTO count
    FROM tbl_auction_offer
    WHERE user_id = buyer_id AND product_id = for_product_id;

    IF count > 0 THEN        
        SET response_message = 'declined';
    ELSE
        INSERT INTO tbl_auction_offer (user_id, product_id, amount)
        VALUES (buyer_id, for_product_id, offer_amount);
        IF EXISTS (SELECT 1 FROM tbl_auction_details WHERE product_id = for_product_id) THEN
    -- If it exists, update the total_offer
    UPDATE tbl_auction_details
    SET total_offer = total_offer + 1
    WHERE product_id = for_product_id;
ELSE
    -- If it does not exist, insert a new row
    INSERT INTO tbl_auction_details (product_id, total_offer)
    VALUES (for_product_id, 1);
END IF;
        IF ROW_COUNT() > 0 THEN
            SET response_message = 'success';
        ELSE
            SET response_message = 'error';  
        END IF;
    END IF;
END$$

DELIMITER;


-- Procedure to get the winner Bidder for the auction
DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getWinnerBidder`(IN `productId` INT, OUT `highestBidder` INT, OUT `highestBidder_name` VARCHAR(255), OUT `highestBidder_email` VARCHAR(255), OUT `productName` VARCHAR(255), OUT `closure_status` VARCHAR(10), OUT `highestAmount` DECIMAL(10,2))
BEGIN
    -- Output Variables
    SET highestBidder = NULL;
    SET highestAmount = NULL;
    SET highestBidder_name = NULL;
    SET highestBidder_email = NULL;
    SET productName = NULL;
    SET closure_status = 'void';

    -- Highest Bidder based on first come first serve
    SELECT user_id, amount INTO highestBidder, highestAmount
    FROM tbl_auction_offer
    WHERE product_id = productId
    ORDER BY amount DESC, offer_id ASC
    LIMIT 1;

    -- Set status if there is an offer
    IF highestAmount IS NOT NULL AND highestAmount > 0 THEN
        SELECT u.fname, u.email, p.product_name INTO highestBidder_name, highestBidder_email, productName 
        FROM tbl_user u
        JOIN tbl_products p ON p.product_id = productId
        WHERE u.user_id = highestBidder;
        SET closure_status = 'success';
    END IF;
    UPDATE tbl_products SET product_status ="INACTIVE" WHERE product_id = productId;
    
END$$

DELIMITER;