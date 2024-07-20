
-- Query for Wishlist TABLE

CREATE TABLE `tbl_wishlist_item` (
  `wishlist_item_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `tbl_wishlist_item`
  ADD PRIMARY KEY (`wishlist_item_id`),
  ADD KEY `fk_wishlist_product` (`product_id`);


ALTER TABLE `tbl_wishlist_item`
  MODIFY `wishlist_item_id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `tbl_wishlist_item`
  ADD CONSTRAINT `fk_wishlist_product` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`product_id`) ON DELETE CASCADE;
COMMIT;

-- search query
SELECT * from tbl_products where product_name = 'productName' or keyword like '%$name%' 

--search for blog
SELECT * from tbl_blog where blog_author = 'authorName';

--Search for blog using title
SELECT * from tbl_blog where blog_title = 'authorTitle';


-- Display Your Products 
SELECT * from tbl_products where user_id = (Select user_id from tbl_user where fname = 'Session['User']')
