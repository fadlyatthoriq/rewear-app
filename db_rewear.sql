-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2025 at 04:29 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rewear`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(10,2) NOT NULL DEFAULT 0.00,
  `savings` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `image_url`, `created_at`, `updated_at`) VALUES
(1, 'Women\'s', 'Koleksi pakaian wanita terbaik', 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748530084/1747472974_pexels-castorlystock-3682293_fpr1rs.jpg', '2025-05-29 12:24:55', '2025-05-29 12:24:55'),
(2, 'Men\'s', 'Koleksi pakaian pria terbaik', 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748530078/1747472906_pexels-solliefoto-298863_imb1df.jpg', '2025-05-29 12:24:55', '2025-05-29 12:24:55'),
(3, 'Health & Beauty', 'Health & Beauty collection', 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748530107/1747472831_pexels-n-voitkevich-8468019_wesgyg.jpg', '2025-05-29 12:24:55', '2025-05-29 12:24:55'),
(4, 'Babies & Kids', 'Koleksi pakaian bayi dan anak-anak', 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748530075/1747472620_asmund-gimre-NrJA1TPi0P8-unsplash_cmsv1s.jpg', '2025-05-29 12:24:55', '2025-05-29 12:24:55'),
(5, 'Luxury', 'Koleksi barang mewah dan eksklusif', 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748530100/1747472874_pexels-nappy-1058959_la9vc7.jpg', '2025-05-29 12:24:55', '2025-05-29 12:24:55'),
(6, 'Electronics', 'Koleksi elektronik dan gadget', 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748530075/1747472684_pexels-pixabay-356056_tw5pgh.jpg', '2025-05-29 12:24:55', '2025-05-29 12:24:55');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2024_03_14_000001_create_users_table', 1),
(5, '2024_03_14_000002_create_categories_table', 1),
(6, '2024_03_14_000003_create_products_table', 1),
(7, '2024_03_19_create_transactions_table', 1),
(8, '2025_05_18_074239_create_carts_table', 1),
(9, '2025_05_18_074712_create_cart_items_table', 1),
(10, '2025_05_18_143804_create_wishlists_table', 1),
(11, '2025_05_19_125211_create_transaction_items_table', 1),
(12, '2025_05_19_125341_add_midtrans_columns_to_transactions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `condition` enum('new','like_new','good','fair') NOT NULL DEFAULT 'new',
  `status` enum('active','inactive','sold') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `category_id`, `user_id`, `image`, `condition`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Zara Summer Floral Dress', 'Beautiful floral dress from Zara, perfect for summer. Size M, never worn.', 299000.00, 1, 1, 3, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748567205/products/x6taalscjo4gajaugtxh.jpg', 'new', 'active', '2025-05-29 12:24:55', '2025-05-29 18:06:46'),
(2, 'Nike Dri-FIT Running Shorts', 'Lightweight running shorts with built-in liner. Size S, excellent condition.', 199000.00, 1, 1, 6, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748571940/products/ui66wrpluujtvay6iwko.jpg', 'like_new', 'active', '2025-05-29 12:24:55', '2025-05-29 19:25:42'),
(3, 'H&M Blazer', 'Classic black blazer, perfect for office wear. Size S, like new condition.', 249000.00, 1, 1, 3, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748567426/products/o95ahqh0vrmvu8hitwrk.jpg', 'like_new', 'active', '2025-05-29 12:24:55', '2025-05-29 18:10:27'),
(4, 'Adidas Yoga Pants', 'High-waisted yoga pants with pockets. Size M, excellent condition.', 179000.00, 1, 1, 6, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748567141/products/fwjmkzedmjl5gx84nbn1.jpg', 'good', 'active', '2025-05-29 12:24:55', '2025-05-29 18:05:42'),
(5, 'Uniqlo Cardigan', 'Soft knit cardigan in beige. Size L, good condition.', 159000.00, 1, 1, 3, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748567483/products/wz6poladotysfziz6vb0.avif', 'good', 'active', '2025-05-29 12:24:55', '2025-05-29 18:11:24'),
(6, 'Uniqlo Slim Fit Jeans', 'Classic slim fit jeans from Uniqlo. Size 32, excellent condition.', 199000.00, 1, 2, 3, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748567532/products/wlhracgn895oiwxaacqc.avif', 'like_new', 'active', '2025-05-29 12:24:55', '2025-05-29 18:12:13'),
(7, 'Adidas Originals T-Shirt', 'Classic Adidas Originals t-shirt. Size L, good condition.', 149000.00, 1, 2, 6, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748547602/products/rulow2lzw5gizqfgm6xs.jpg', 'good', 'active', '2025-05-29 12:24:55', '2025-05-29 12:40:03'),
(8, 'Nike Air Jordan T-Shirt', 'Limited edition Air Jordan graphic tee. Size XL, new with tags.', 299000.00, 1, 2, 6, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748567575/products/yc5nyd1ertebgdyrvrfj.avif', 'new', 'active', '2025-05-29 12:24:55', '2025-05-29 18:12:56'),
(9, 'Zara Formal Shirt', 'Crisp white formal shirt. Size M, like new condition.', 229000.00, 1, 2, 3, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748567616/products/kyd6v8y9nczvovphng3m.jpg', 'like_new', 'active', '2025-05-29 12:24:55', '2025-05-29 18:13:38'),
(10, 'H&M Chino Pants', 'Classic khaki chino pants. Size 34, good condition.', 179000.00, 1, 2, 3, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748567716/products/lspnld0c20862tlpl5zr.jpg', 'good', 'active', '2025-05-29 12:24:55', '2025-05-29 18:15:16'),
(11, 'Louis Vuitton Neverfull MM', 'Authentic LV Neverfull MM in Damier Ebene. Comes with dust bag and receipt.', 15990000.00, 1, 5, 4, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748567847/products/o199k2pu9eefc4oeh7dn.avif', 'like_new', 'active', '2025-05-29 12:24:55', '2025-05-29 18:17:30'),
(12, 'Gucci Marmont Mini Bag', 'Authentic Gucci Marmont Mini in Black. Includes dust bag and authenticity card.', 12990000.00, 1, 5, 4, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748567899/products/uju95meitr4klbby9oyg.jpg', 'like_new', 'active', '2025-05-29 12:24:55', '2025-05-29 18:18:20'),
(13, 'Chanel Classic Flap Bag', 'Authentic Chanel Classic Flap in Black. Includes authenticity card and box.', 89900000.00, 1, 5, 4, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748572032/products/gdfafnh1tfh6lk9xbhnu.webp', 'like_new', 'active', '2025-05-29 12:24:55', '2025-05-29 19:27:14'),
(14, 'Hermes Birkin 30', 'Authentic Hermes Birkin 30 in Togo leather. Includes dust bag and receipt.', 199900000.00, 1, 5, 4, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748572090/products/rd10nrmqv1zfq7mzsuuw.jpg', 'like_new', 'active', '2025-05-29 12:24:55', '2025-05-29 19:28:10'),
(15, 'Prada Re-Edition 2005', 'Authentic Prada Re-Edition 2005 in Black. Includes dust bag and authenticity card.', 8990000.00, 1, 5, 4, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568072/products/eo7r5l8purunvur9ji6p.jpg', 'like_new', 'active', '2025-05-29 12:24:55', '2025-05-29 18:21:13'),
(16, 'SK-II Facial Treatment Essence', 'Original SK-II Facial Treatment Essence 230ml. Unopened, sealed.', 1899000.00, 1, 3, 8, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568105/products/vdakzgkougdehlt6hl97.jpg', 'new', 'active', '2025-05-29 12:24:55', '2025-05-29 18:21:46'),
(17, 'Estee Lauder Advanced Night Repair', 'Estee Lauder ANR Serum 50ml. 80% remaining, purchased 2 months ago.', 1299000.00, 1, 3, 8, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568135/products/sll75fu1amasiqqo3pa8.jpg', 'good', 'active', '2025-05-29 12:24:55', '2025-05-29 18:22:16'),
(18, 'La Mer Moisturizing Cream', 'La Mer Moisturizing Cream 60ml. Unopened, sealed.', 4999000.00, 1, 3, 8, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568168/products/rrv84y1xkemykhvsqipd.jpg', 'new', 'active', '2025-05-29 12:24:55', '2025-05-29 18:22:48'),
(19, 'Chanel Chance Eau Tendre', 'Chanel Chance Eau Tendre EDP 100ml. 90% remaining.', 1999000.00, 1, 3, 8, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568192/products/xmfleyozpo33ee5ch4mc.jpg', 'good', 'active', '2025-05-29 12:24:55', '2025-05-29 18:23:13'),
(20, 'Dior Forever Foundation', 'Dior Forever Foundation in 2N. Used once, like new condition.', 899000.00, 1, 3, 8, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568214/products/lkc1imtt0zh4yusucdaw.jpg', 'like_new', 'active', '2025-05-29 12:24:55', '2025-05-29 18:23:35'),
(21, 'H&M Kids Winter Jacket', 'Warm winter jacket for kids age 4-5 years. Lightly used, excellent condition.', 149000.00, 1, 4, 7, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748567790/products/vmgfl2tfrchdd7rpulc3.jpg', 'good', 'active', '2025-05-29 12:24:55', '2025-05-29 18:16:31'),
(22, 'Gap Kids Denim Overalls', 'Cute denim overalls for kids age 3-4 years. Like new condition.', 199000.00, 1, 4, 7, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568248/products/kzlfha8pypywvhnvxqcs.jpg', 'like_new', 'active', '2025-05-29 12:24:55', '2025-05-29 18:24:09'),
(23, 'Nike Kids Air Force 1', 'Nike Kids Air Force 1 in white. Size EU 30, new with box.', 799000.00, 1, 4, 7, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568279/products/l17d8vaur83cuqaptgnn.jpg', 'new', 'active', '2025-05-29 12:24:55', '2025-05-29 18:24:40'),
(24, 'Zara Kids Summer Dress', 'Floral summer dress for girls age 5-6 years. New with tags.', 249000.00, 1, 4, 7, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568308/products/aip4vrxydttopanttpeh.jpg', 'new', 'active', '2025-05-29 12:24:55', '2025-05-29 18:25:09'),
(25, 'Uniqlo Kids Pajama Set', 'Cotton pajama set for kids age 4-5 years. Good condition.', 129000.00, 1, 4, 7, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568339/products/cu4zxhhut6umfj1dovgr.jpg', 'good', 'active', '2025-05-29 12:24:55', '2025-05-29 18:25:40'),
(26, 'Apple AirPods Pro 2', 'Apple AirPods Pro 2nd Generation. Includes charging case and all accessories.', 2499000.00, 1, 6, 4, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568366/products/hai2ipdthohvhfyy2o7j.jpg', 'like_new', 'active', '2025-05-29 12:24:55', '2025-05-29 18:26:07'),
(27, 'Samsung Galaxy Watch 5', 'Samsung Galaxy Watch 5 40mm. Includes original box and charger.', 2999000.00, 1, 6, 4, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568405/products/mpcn7ac6yvpn7owtietd.jpg', 'like_new', 'active', '2025-05-29 12:24:55', '2025-05-29 18:26:46'),
(28, 'iPad Pro 11\" 2022', 'iPad Pro 11\" 2022 128GB WiFi. Includes original box and accessories.', 9999000.00, 1, 6, 4, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568430/products/nppk89aggqc53go7ubpl.jpg', 'like_new', 'active', '2025-05-29 12:24:55', '2025-05-29 18:27:10'),
(29, 'Sony WH-1000XM4', 'Sony WH-1000XM4 Wireless Headphones. Includes carrying case and cables.', 3499000.00, 1, 6, 4, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568454/products/mvckg4jmvsqiavdxl8fe.jpg', 'like_new', 'active', '2025-05-29 12:24:55', '2025-05-29 18:27:35'),
(30, 'DJI Mini 3 Pro', 'DJI Mini 3 Pro Drone. Includes controller, batteries, and carrying case.', 8999000.00, 1, 6, 4, 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568483/products/tlwbrjrt1ubcaphk8pso.jpg', 'like_new', 'active', '2025-05-29 12:24:55', '2025-05-29 18:28:04');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `midtrans_order_id` varchar(255) DEFAULT NULL,
  `midtrans_payment_token` varchar(255) DEFAULT NULL,
  `midtrans_payment_type` varchar(255) DEFAULT NULL,
  `midtrans_va_number` varchar(255) DEFAULT NULL,
  `midtrans_bank` varchar(255) DEFAULT NULL,
  `midtrans_expiry_time` varchar(255) DEFAULT NULL,
  `midtrans_transaction_id` varchar(255) DEFAULT NULL,
  `midtrans_transaction_status` varchar(255) DEFAULT NULL,
  `midtrans_fraud_status` varchar(255) DEFAULT NULL,
  `payment_expiry` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `delivery_method` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `shipping_status` varchar(255) NOT NULL DEFAULT 'pending',
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_items`
--

CREATE TABLE `transaction_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `profile_picture` varchar(255) DEFAULT NULL,
  `is_seller` tinyint(1) NOT NULL DEFAULT 0,
  `store_name` varchar(255) DEFAULT NULL,
  `store_description` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `birth_date`, `role`, `profile_picture`, `is_seller`, `store_name`, `store_description`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@rewear.com', '2025-05-29 12:24:52', '$2y$12$f7xckeG6II9XeFzT98hWce15ST1rm8zBIbk.eeVa2EiVLyrUfplGq', '081234567890', 'Jl. Admin No. 1', '1990-01-01', 'admin', 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748527264/profiles/vgzzewwq1ve4oj9pc33d.png', 0, NULL, NULL, NULL, '2025-05-29 12:24:52', '2025-05-29 12:24:52'),
(2, 'User', 'user@rewear.com', '2025-05-29 12:24:52', '$2y$12$T3pXiwTYvkc1rht9gBL4Uez8oTdrlbdJLw5.tzfJn1cYkuDPmMTE6', '089876543210', 'Jl. User No. 1', '1992-05-15', 'user', 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748527264/profiles/vgzzewwq1ve4oj9pc33d.png', 0, NULL, NULL, NULL, '2025-05-29 12:24:52', '2025-05-29 12:24:52'),
(3, 'Fashion Store', 'fashion@rewear.com', '2025-05-29 12:24:52', '$2y$12$NDPQugFQJ2jCJppyfyzioehoybuEHNFoK4XE7wAs1h4bccxPTjGtS', '081234567893', 'Jl. Fashion Store No. 1', '1988-06-20', 'user', 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748527581/profiles/prmji0fyfqw4hghzjgy4.png', 1, 'Fashion Store', 'Toko fashion terpercaya dengan koleksi terbaru', NULL, '2025-05-29 12:24:52', '2025-05-29 12:24:52'),
(4, 'Vintage Shop', 'vintage@rewear.com', '2025-05-29 12:24:53', '$2y$12$672TuS/v0CmIqN7.dbCajOabWSpglDMBrJcK3vj17/i.kdazW1Qai', '081234567894', 'Jl. Vintage Shop No. 1', '1991-09-15', 'user', 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748527581/profiles/prmji0fyfqw4hghzjgy4.png', 1, 'Vintage Shop', 'Koleksi pakaian vintage berkualitas', NULL, '2025-05-29 12:24:53', '2025-05-29 12:24:53'),
(5, 'Luxury Boutique', 'luxury@rewear.com', '2025-05-29 12:24:53', '$2y$12$4q.vwtrNqF1FxGHlyLpWPuAOnL85P2V8CW3zYpH9dNfU5XwyTRqUW', '081234567895', 'Jl. Luxury Boutique No. 1', '1985-03-10', 'user', 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748527581/profiles/prmji0fyfqw4hghzjgy4.png', 1, 'Luxury Boutique', 'Koleksi barang mewah dan eksklusif', NULL, '2025-05-29 12:24:53', '2025-05-29 12:24:53'),
(6, 'Sporty Style', 'sporty@rewear.com', '2025-05-29 12:24:54', '$2y$12$xo.NFEqZMdT1uV0l/DLS6.9ZTsNj7.JaGCtMUSryTr2aRyTO7zfky', '081234567896', 'Jl. Sporty Style No. 1', '1993-11-25', 'user', 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748527581/profiles/prmji0fyfqw4hghzjgy4.png', 1, 'Sporty Style', 'Koleksi pakaian olahraga dan casual sporty', NULL, '2025-05-29 12:24:54', '2025-05-29 12:24:54'),
(7, 'Kids Fashion', 'kids@rewear.com', '2025-05-29 12:24:54', '$2y$12$aEDCcERF9TFM5xNyGDHyEuunevikzUt/NkA053y6rIHNDn4t5QxvS', '081234567897', 'Jl. Kids Fashion No. 1', '1990-07-18', 'user', 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748527581/profiles/prmji0fyfqw4hghzjgy4.png', 1, 'Kids Fashion', 'Koleksi pakaian anak-anak yang lucu dan nyaman', NULL, '2025-05-29 12:24:54', '2025-05-29 12:24:54'),
(8, 'Beauty Store', 'beauty@rewear.com', '2025-05-29 12:24:55', '$2y$12$DRpEZsYbx2cfus6kQeMJxOU15UWFOWZsJOeicEW9M8Ibea6CkbH0y', '081234567898', 'Jl. Beauty Store No. 1', '1992-04-12', 'user', 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748527581/profiles/prmji0fyfqw4hghzjgy4.png', 1, 'Beauty Store', 'Koleksi produk kecantikan dan perawatan kulit terbaik', NULL, '2025-05-29 12:24:55', '2025-05-29 12:24:55'),
(9, 'Jane Smith', 'jane@example.com', '2025-05-29 12:24:55', '$2y$12$U9x2U8qhwQbK.AhSic6PrucqMpgG549bxRvMZE9o70bYFANuKsKmq', '081234567892', 'Jl. Jane Smith No. 1', '1993-07-10', 'user', 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748527264/profiles/vgzzewwq1ve4oj9pc33d.png', 0, NULL, NULL, NULL, '2025-05-29 12:24:55', '2025-05-29 12:24:55');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_user_id_foreign` (`user_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_items_transaction_id_foreign` (`transaction_id`),
  ADD KEY `transaction_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wishlists_user_id_product_id_unique` (`user_id`,`product_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD CONSTRAINT `transaction_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_items_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
