# TokoYogi — PHP Marketplace

A small marketplace written in plain PHP and MySQL: a public storefront where visitors browse and
search products and contact the seller on WhatsApp, and an admin area for managing products,
categories, and the seller's profile. There is no payment gateway; a purchase starts as a WhatsApp
conversation with the seller.

Built in 2022 as a learning project.

- **Screenshots:** [muhammadyogi.vercel.app/projects/php-ecommerce](https://muhammadyogi.vercel.app/projects/php-ecommerce)
- **Demo video:** [share.vidyard.com/watch/bn6RHvzhVw7DxAbSPRM3UD](https://share.vidyard.com/watch/bn6RHvzhVw7DxAbSPRM3UD)

## Features

**Storefront**

- Home page with the product categories and the 8 newest products
- Product catalog with keyword search and a category filter
- Product detail page with price and description
- "Contact via WhatsApp" button that opens a chat with the seller's number and a prefilled message

**Admin area** (login required)

- Login with a session; passwords are stored as MD5 hashes
- Dashboard
- Categories: list, add, edit, delete
- Products: list, add, edit, delete, with an image upload, a rich-text description (CKEditor), and an
  active/inactive status that hides a product from the storefront
- Profile: name, username, WhatsApp number, email, and address shown to buyers; change password

Only active products appear on the storefront.

## Tech stack

PHP with the `mysqli` extension, MySQL, HTML, CSS, and CKEditor 4 (loaded from its CDN).

## Project structure

| File | Purpose |
|---|---|
| `index.php` | Home page: categories and newest products |
| `produk.php` | Catalog with search and category filter |
| `detail-produk.php` | Product detail and the WhatsApp button |
| `login.php`, `keluar.php` | Admin login and logout |
| `dashboard.php`, `profil.php` | Admin dashboard and profile |
| `data-kategori.php`, `tambah-kategori.php`, `edit-kategori.php` | Category management |
| `data-produk.php`, `tambah-produk.php`, `edit-produk.php`, `proses-hapus.php` | Product management |
| `db.php` | Database connection settings |
| `produk/` | Uploaded product images |

## Running locally

Requirements: PHP with `mysqli` and a MySQL server (for example XAMPP or MAMP).

1. Put the project in your web server's document root.
2. Create a database and set its name and credentials in `db.php`.
3. Create the three tables the code uses (the repository has no SQL dump):

   | Table | Columns used by the code |
   |---|---|
   | `tb_admin` | `admin_id`, `admin_name`, `username`, `password` (MD5), `admin_telp`, `admin_email`, `admin_address` |
   | `tb_category` | `category_id`, `category_name` |
   | `tb_product` | `product_id`, `category_id`, `product_name`, `product_price`, `product_description`, `product_image`, `product_status`, plus one trailing column inserted as `NULL` (a creation timestamp) |

4. Insert an admin row (`admin_id = 1`; the storefront reads the seller's WhatsApp number from it),
   then open `login.php`.

## Known limitations

This was an early learning project and is not safe to deploy as is:

- **SQL injection:** queries are built by string concatenation. Login input is escaped, but other
  inputs, such as the catalog search, are not; prepared statements would fix this.
- **Cross-site scripting:** the search term is echoed back into the page without escaping.
- **Weak password hashing:** MD5 instead of `password_hash()` and `password_verify()`.
- **No database schema** in the repository; the tables above have to be created by hand.
