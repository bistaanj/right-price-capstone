use db_rightprice;
CREATE TABLE `tbl_session` (
    `session_id` varchar(255) NOT NULL,
    `user_id` int(10) NOT NULL,
    `login_time` datetime NOT NULL,
    `Status` int(1) NOT NULL
);
CREATE TABLE `tbl_user` (
    `user_id` int(11) NOT NULL,
    `fname` varchar(50) NOT NULL,
    `lname` varchar(50) NOT NULL,
    `email` varchar(50) NOT NULL,
    `password` varchar(16) NOT NULL,
    `verification_code` varchar(255) NOT NULL,
    `verified` int(1) NOT NULL
);

ALTER TABLE `tbl_session` ADD PRIMARY KEY (`session_id`);
ALTER TABLE `tbl_user` ADD PRIMARY KEY (`user_id`);
ALTER TABLE `tbl_user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 19;

CREATE TABLE `tbl_pcategory` (
    `category_id` INT(11) NOT NULL AUTO_INCREMENT,
    `category_name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`category_id`)
);

CREATE TABLE `tbl_blog` (
    `blog_id` INT(11) NOT NULL AUTO_INCREMENT,
    `blog_author` VARCHAR(255) NOT NULL,
    `blog_published_date` DATE NOT NULL,
    `blog_title` VARCHAR(1000) NOT NULL,
    `blog_picture` VARCHAR(255) NOT NULL,
    `blog_contents` VARCHAR(2000) NOT NULL,
    PRIMARY KEY (`blog_id`)
);
CREATE TABLE `tbl_products` (
    `user_id` INT(10) NOT NULL,
    `product_id` INT(10) NOT NULL AUTO_INCREMENT,
    `product_name` VARCHAR(255) NOT NULL,
    `product_category` INT(4) NOT NULL,
    `product_price` FLOAT NOT NULL,
    `product_unit` VARCHAR(10) NOT NULL,
    `product_image` VARCHAR(255) NOT NULL,
    `product_description` VARCHAR(1000) NOT NULL,
    `product_added` DATE NOT NULL,
    `product_status` VARCHAR(255) NOT NULL,
    `sale_type` VARCHAR(8) NOT NULL,
    `keyword` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`product_id`),
    CONSTRAINT `fk_product_category` FOREIGN KEY (`product_category`) REFERENCES `tbl_pcategory` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `tbl_wishlist_item` (
    `wishlist_item_id` INT(11) NOT NULL AUTO_INCREMENT,
    `product_id` INT(11) NOT NULL,
    `quantity` FLOAT NOT NULL,
    PRIMARY KEY (`wishlist_item_id`),
    CONSTRAINT `fk_wishlist_product` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`product_id`) ON DELETE CASCADE
);


ALTER TABLE `tbl_wishlist_item`
ADD COLUMN `user_id` INT(11) NOT NULL;
