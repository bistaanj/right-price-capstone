-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2024 at 11:37 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4
Create Database db_rightprice;

USE db_rightprice;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;

--
-- Database: `db_rightprice`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_user_credentials` (IN `in_email` VARCHAR(255), IN `in_password` VARCHAR(255), OUT `out_session_id` VARCHAR(128), OUT `out_user_id` INT, OUT `out_username` VARCHAR(255))   BEGIN
    DECLARE valid_user_id INT;
    DECLARE valid_username VARCHAR(255);
    DECLARE new_session_id VARCHAR(128);
    DECLARE new_timestamp DATETIME;

    SELECT user_id, fname
    INTO valid_user_id, valid_username
    FROM tbl_user
    WHERE email = in_email AND password = in_password
    LIMIT 1;

    IF valid_user_id IS NOT NULL THEN
        -- After email and password validation, creating unique session id for the user
        SET new_session_id = SHA1(NOW());
        -- Creating timestamp for the user
        SET new_timestamp = NOW();

        -- Inseting new login in session tablle
        INSERT INTO tbl_session (session_id, user_id, login_time,Status)
        VALUES (new_session_id, valid_user_id,new_timestamp,1);

        -- Output parameters
        SET out_session_id = new_session_id;
        SET out_user_id = valid_user_id;
        SET out_username = valid_username;
    ELSE
        SET out_session_id = NULL;
        SET out_user_id = NULL;
        SET out_username = NULL;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateSession` ()   BEGIN
    DELETE FROM tbl_session
    WHERE login_time < DATE_SUB(NOW(), INTERVAL 2 HOUR);
END$$

DELIMITER;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_session`
--

CREATE TABLE `tbl_session` (
    `session_id` varchar(255) NOT NULL,
    `user_id` int(10) NOT NULL,
    `login_time` datetime NOT NULL,
    `Status` int(1) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `tbl_session`
--

INSERT INTO
    `tbl_session` (
        `session_id`,
        `user_id`,
        `login_time`,
        `Status`
    )
VALUES (
        'd8490a4ed214defc9f8d62db2edea8ccfca919d4',
        1,
        '2024-06-04 16:41:25',
        1
    );

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
    `user_id` int(11) NOT NULL,
    `fname` varchar(50) NOT NULL,
    `lname` varchar(50) NOT NULL,
    `email` varchar(50) NOT NULL,
    `password` varchar(16) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--

--

--
-- Triggers `tbl_user`
--
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

DELIMITER;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_session`
--
ALTER TABLE `tbl_session` ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user` ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 10;

DELIMITER $$
--
-- Events
--
CREATE DEFINER = `root` @`localhost` EVENT `UpdateSessionEvent` ON SCHEDULE EVERY 1 MINUTE STARTS '2024-06-04 16:36:17' ON COMPLETION NOT PRESERVE ENABLE DO
CALL UpdateSession () $$ DELIMITER;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;