
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Database Creation 
CREATE DATABASE db_rightprice;
USE db_rightprice;




-- --------------------------------------------------------

-- Table structure for table `tbl_session`
CREATE TABLE `tbl_session` (
  `session_id` int(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_time` int(10) NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Table structure for table `tbl_user`
CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Triggers to check if email exists in `tbl_user`

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
DELIMITER ;

-- Procedure to creating record for Session table.
DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `check_user_credentials` (IN `in_email` VARCHAR(255), IN `in_password` VARCHAR(255), OUT `out_session_id` VARCHAR(128), OUT `out_user_id` INT, OUT `out_username` VARCHAR(255))   BEGIN
    DECLARE valid_user_id INT;
    DECLARE valid_username VARCHAR(255);
    DECLARE session_id VARCHAR(128);
    DECLARE new_timestamp INT;

    SELECT user_id, fname
    INTO valid_user_id, valid_username
    FROM tbl_user
    WHERE email = in_email AND password = in_password
    LIMIT 1;

    IF valid_user_id IS NOT NULL THEN
        -- After email and password validation, creating unique session id for the user
        SET session_id = UUID();
        -- Creating timestamp for the user
        SET new_timestamp = UNIX_TIMESTAMP();

        -- Inseting new login in session tablle
        INSERT INTO tbl_session (session_id, user_id, login_time,Status)
        VALUES (session_id, valid_user_id,new_timestamp,1);

        -- Output parameters
        SET out_session_id = session_id;
        SET out_user_id = valid_user_id;
        SET out_username = valid_username;
    ELSE
        SET out_session_id = NULL;
        SET out_user_id = NULL;
        SET out_username = NULL;
    END IF;
END$$

DELIMITER ;

-- Changes in the table.
ALTER TABLE `tbl_session`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
