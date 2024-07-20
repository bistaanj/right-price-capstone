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

