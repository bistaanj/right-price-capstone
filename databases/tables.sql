/* TABLE Creation  */

CREATE TABLE `tbl_pcategory` (
    `category_id` INT(11) NOT NULL AUTO_INCREMENT,
    `category_name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`category_id`)
);

CREATE TABLE `tbl_products` (
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
    PRIMARY KEY (`product_id`),
    CONSTRAINT `fk_product_category` FOREIGN KEY (`product_category`) REFERENCES `tbl_pcategory` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
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

CREATE TABLE `tbl_wishlist_item` (
    `wishlist_item_id` INT(11) NOT NULL AUTO_INCREMENT,
    `product_id` INT(11) NOT NULL,
    `quantity` FLOAT NOT NULL,
    PRIMARY KEY (`wishlist_item_id`),
    CONSTRAINT `fk_wishlist_product` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`product_id`) ON DELETE CASCADE
);

-- Adding Data

INSERT INTO
    `tbl_pcategory` (`category_name`)
VALUES ('Seeds'),
    ('Fertilizers'),
    ('Pesticides'),
    ('Farm Equipment'),
    ('Livestock');

INSERT INTO
    `tbl_products` (
        `product_name`,
        `product_category`,
        `product_price`,
        `product_unit`,
        `product_image`,
        `product_description`,
        `product_added`,
        `product_status`,
        `sale_type`
    )
VALUES (
        'Corn Seeds',
        1,
        10.99,
        'kg',
        'corn_seeds.jpg',
        'High-yield corn seeds suitable for various climates. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed fermentum tincidunt libero, sit amet pellentesque magna dictum quis. Nullam posuere, mauris nec fermentum gravida, nisi urna tempor turpis, ac lobortis nisi felis et tortor. Nullam at ligula ac felis tempus porttitor. Duis id sapien sed sem sollicitudin ullamcorper. Mauris consequat elit a arcu congue, at congue enim varius. Curabitur interdum purus vitae massa consequat, nec gravida eros laoreet. Duis id quam id orci iaculis sagittis. Proin accumsan erat vitae quam rutrum, et volutpat dui ultricies. Nulla facilisi. Nulla lobortis, felis vel sagittis vehicula, ipsum dui egestas sem, ut viverra odio nisi vel nisi.',
        '2023-01-15',
        'Active',
        'Sale'
    ),
    (
        'Nitrogen Fertilizer',
        2,
        29.99,
        'bag',
        'nitrogen_fertilizer.jpg',
        'Balanced nitrogen fertilizer for crops. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.',
        '2023-02-01',
        'Active',
        'Sale'
    ),
    (
        'Insecticide Spray',
        3,
        15.49,
        'bottle',
        'insecticide_spray.jpg',
        'Effective insecticide spray for pest control. Donec dapibus. Duis at velit eu est congue elementum. Fusce ultricies urna eget turpis. Sed varius. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi.',
        '2023-02-10',
        'Active',
        'Auction'
    ),
    (
        'Tractor',
        4,
        15000.00,
        'unit',
        'tractor.jpg',
        'Powerful tractor for farm operations. Nulla facilisi. Integer lacinia sollicitudin massa. Cras metus.',
        '2023-03-05',
        'Active',
        'Sale'
    ),
    (
        'Holstein Cow',
        5,
        5000.00,
        'head',
        'holstein_cow.jpg',
        'Holstein dairy cow with high milk production. Vivamus luctus.',
        '2023-03-20',
        'Active',
        'Sale'
    ),
    (
        'Wheat Seeds',
        1,
        8.99,
        'kg',
        'wheat_seeds.jpg',
        'Premium wheat seeds for bread-making. Sed condimentum.',
        '2023-04-01',
        'Active',
        'Auction'
    ),
    (
        'Phosphorus Fertilizer',
        2,
        34.99,
        'bag',
        'phosphorus_fertilizer.jpg',
        'Essential phosphorus fertilizer for root development. Duis vitae.',
        '2023-04-15',
        'Active',
        'Sale'
    ),
    (
        'Herbicide',
        3,
        12.99,
        'bottle',
        'herbicide.jpg',
        'Broad-spectrum herbicide for weed control. Sed pharetra.',
        '2023-05-01',
        'Active',
        'Sale'
    ),
    (
        'Combine Harvester',
        4,
        25000.00,
        'unit',
        'combine_harvester.jpg',
        'Efficient combine harvester for grain harvesting. Proin tincidunt.',
        '2023-05-15',
        'Active',
        'Sale'
    ),
    (
        'Angus Bull',
        5,
        7000.00,
        'head',
        'angus_bull.jpg',
        'Angus beef bull for breeding. Quisque volutpat.',
        '2023-06-01',
        'Active',
        'Sale'
    ),
    (
        'Rice Seeds',
        1,
        12.99,
        'kg',
        'rice_seeds.jpg',
        'Quality rice seeds suitable for wetland cultivation. Fusce vitae.',
        '2023-06-15',
        'Active',
        'Auction'
    ),
    (
        'Potassium Fertilizer',
        2,
        39.99,
        'bag',
        'potassium_fertilizer.jpg',
        'Potassium-rich fertilizer for crop growth. Nam vehicula.',
        '2023-07-01',
        'Active',
        'Sale'
    ),
    (
        'Rodenticide',
        3,
        9.99,
        'bottle',
        'rodenticide.jpg',
        'Effective rodenticide for rodent control in farms. Donec sollicitudin.',
        '2023-07-15',
        'Active',
        'Sale'
    ),
    (
        'Seeder Machine',
        4,
        18000.00,
        'unit',
        'seeder_machine.jpg',
        'Precision seeder machine for planting seeds. Phasellus at.',
        '2023-08-01',
        'Active',
        'Auction'
    ),
    (
        'Sheep',
        5,
        1500.00,
        'head',
        'sheep.jpg',
        'Healthy sheep for wool and meat production. Pellentesque habitant.',
        '2023-08-15',
        'Active',
        'Sale'
    ),
    (
        'Soybean Seeds',
        1,
        9.99,
        'kg',
        'soybean_seeds.jpg',
        'High-quality soybean seeds for protein production. Nullam bibendum.',
        '2023-09-01',
        'Active',
        'Sale'
    ),
    (
        'Calcium Fertilizer',
        2,
        29.99,
        'bag',
        'calcium_fertilizer.jpg',
        'Calcium-enriched fertilizer for plant cell structure. Ut luctus.',
        '2023-09-15',
        'Active',
        'Auction'
    ),
    (
        'Fungicide',
        3,
        11.99,
        'bottle',
        'fungicide.jpg',
        'Effective fungicide for fungal disease control. Vestibulum at.',
        '2023-10-01',
        'Active',
        'Sale'
    ),
    (
        'Sprayer',
        4,
        12000.00,
        'unit',
        'sprayer.jpg',
        'Versatile sprayer for pesticide and herbicide application. Quisque fermentum.',
        '2023-10-15',
        'Active',
        'Sale'
    ),
    (
        'Goats',
        5,
        1200.00,
        'head',
        'goats.jpg',
        'Goats for milk and meat production in farms. Maecenas non.',
        '2023-11-01',
        'Active',
        'Sale'
    );