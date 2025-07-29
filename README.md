
# Right Price

Right Price is a full‑stack PHP/MySQL capstone project that turns the idea of selling farm produce and agricultural supplies into an interactive marketplace. The application allows producers to list items for direct sale or auction, buyers to search, bid or place orders, and both parties to manage their business through dashboards and notifications.

## Features

- **Product Marketplace:** Sellers can upload produce with images, descriptions, and prices.
- **Auction System:** Users can submit offers on auction-enabled listings, which close automatically.
- **Order Management:** Buyers can place orders and sellers manage status via a dashboard.
- **User Authentication:** Sign-up/login with session management and email verification (via PHPMailer).
- **Wishlist Functionality:** Save products for later interest.
- **Blog Posting:** Users can create blog posts.
- **Email Notifications:** Bid completion emails sent to all bidders using PHPMailer.

## Technology Stack

- **Frontend:** HTML5, CSS3, Bootstrap, JavaScript
- **Backend:** PHP 7+, MySQL, Composer
- **Libraries:** PHPMailer
- **Server:** XAMPP or any LAMP stack

## Installation

1. Clone or download this repository:
   ```bash
   git clone 
   ```
2. Place it in your web server directory (e.g., `htdocs/` in XAMPP).
3. Create a MySQL database named `db_rightprice` and import `databases/db_rightprice.sql` via phpMyAdmin.
4. Open `php/connection.php` and configure your DB credentials:
   ```php
   $con = mysqli_connect("localhost", "root", "", "db_rightprice");
   ```
5. Run `composer install` in the root to install dependencies like PHPMailer.

## Usage

- Visit `home.html` to see the landing page.
- Sign up/login to access the dashboard and selling features.
- Navigate to `sell_product.php` to list a new product for sale or auction.
- Visit `market.php` to browse products and make offers or purchases.
- Use the dashboard to manage listings, orders, and blog posts.
- View and manage wishlist from `wishlist.php`.

## File Structure

```
├── databases/                # SQL dump and setup files
├── pages/                   # HTML/PHP pages for views (home, market, dashboard, etc.)
├── php/                     # Backend scripts (login, orders, bids, etc.)
├── public/                  # Assets like CSS, images
├── includes/                # Headers, footers, and script includes
├── composer.json            # Dependencies
```

## Credits

Developed as a Capstone Project.

## License

This project is for educational purposes only.
