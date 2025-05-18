-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2025 at 05:07 PM
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

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `session_id`, `total`, `tax`, `savings`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 0.00, 0.00, 0.00, '2025-05-18 00:51:18', '2025-05-18 00:51:18'),
(2, 5, NULL, 0.00, 0.00, 0.00, '2025-05-18 08:02:51', '2025-05-18 08:02:51');

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

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(20, 1, 2, 1, 50000.00, '2025-05-18 06:25:35', '2025-05-18 06:25:35'),
(22, 1, 1, 1, 90000.00, '2025-05-18 07:21:34', '2025-05-18 07:21:34'),
(23, 2, 7, 1, 30000.00, '2025-05-18 08:02:51', '2025-05-18 08:02:51');

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
(1, 'Women\'s', NULL, 'storage/categories/1747472974_pexels-castorlystock-3682293.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(2, 'Men\'s', NULL, 'storage/categories/1747472906_pexels-solliefoto-298863.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(3, 'Health & Beauty', 'Health & Beauty collection', 'storage/categories/1747472831_pexels-n-voitkevich-8468019.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(4, 'Babies & Kids', NULL, 'storage/categories/1747472620_asmund-gimre-NrJA1TPi0P8-unsplash.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(5, 'Luxury', NULL, 'storage/categories/1747472874_pexels-nappy-1058959.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(6, 'Electronics', NULL, 'storage/categories/1747472684_pexels-pixabay-356056.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56');

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
(7, '2024_03_14_000006_create_transactions_table', 1),
(8, '2024_03_14_000007_create_transaction_items_table', 1),
(9, '2024_03_15_000000_add_profile_picture_to_users_table', 1),
(10, '2025_05_15_165207_add_email_verified_at_to_users_table', 1),
(11, '2025_05_18_074239_create_carts_table', 1),
(12, '2025_05_18_074712_create_cart_items_table', 2),
(13, '2025_05_18_143804_create_wishlists_table', 3);

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
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(12,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `stock`, `image_url`, `created_at`, `updated_at`) VALUES
(1, 1, 'Stripe Knit Shirt', 'All size\r\nNo minus \r\nLike new', 90000.00, 2, 'products/a2CHCCFdCqC5mPQR3LCaReVq2EQcdXmlpSgN9GE3.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(2, 1, 'ATMOSPHERE - Crop Top Tosca', NULL, 50000.00, 1, 'products/xOewLjjf9sUieXzKs4Un1LeVSDCkatJ02TVM3Y0f.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(3, 1, 'Cardigan PLAY Abu', 'Minus tag bawah cutting', 150000.00, 1, 'products/AGyEmi3I756GAwB32CAusxdrdIKXRV2qvD6EwUIX.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(4, 1, 'UNIQLO Cardigan Shoffle Pink', 'Uniqlo Cardigan Shoffle Pink\r\nTag tagan masih amann \r\nSize L kecil (kids section)\r\nM fit to L \r\nNego Tipis', 200000.00, 1, 'products/rTLqbxdIP7F3f72BXJQPYRiEUHTfb58WM3Iy3Y22.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(5, 1, 'Cardigan Uniqlo Hitam Kerah O', 'ld 110\r\np 60\r\nMINUS NODA SAMAR DIBAGIAN BELAKANG', 88000.00, 1, 'products/jJcYl5U0mQWNNByMWpJDP1OUvgqSkLp9B4bkZaif.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(6, 2, 'Jaket NIKE Running', 'Jacket Nike Running \r\n#ready aggsstuff\r\nSize on Taq : L \r\nP x L    : 68 X L 58 \r\nMinus  : Tidak ada', 99000.00, 1, 'products/l7wJuAFDsB2KU9BiuG7gHiJWm88wy7gxjIbcGX2M.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(7, 2, 'Preloved Kaos UNIQLO', 'Ukuran S, tapi cenderung besar\r\nBaik dan tebal', 30000.00, 1, 'products/GtWiohzAcmTblVaRLIVMhtxPNERAlk32BvpibA7i.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(8, 2, 'Jaket Gym Master Reversible', 'size L\r\nPanjang 68cm\r\nLebar 118cm\r\nNominus\r\nGoodcondition', 130000.00, 1, 'products/ODnwWsWPU5EVb2e7oStjYD0gUlOsvmXctuUp0j6x.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(9, 2, 'T-Shirt Swellow Kaos', 'ukuran m (sekali pakai)', 250000.00, 1, 'products/eYLMdmyj4zO17WjYDAr01J02CAznhoULWBLeIOye.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(10, 2, 'Vintage Golden Bear Navy Harrington Work Jacket', '•Size M fit L (P63xL58) Ld116 Boxy\r\n\r\nGeser foto untuk detail ——>\r\n\r\nitem deskripsi : 𝗪𝗮𝗿𝗻𝗮 𝗯𝗶𝘀𝗮 𝘀𝗮𝗷𝗮 𝘀𝗲𝗱𝗶𝗸𝗶𝘁 𝗯𝗲𝗿𝗯𝗲𝗱𝗮 𝗸𝗮𝗿𝗲𝗻𝗮 𝗲𝗳𝗲𝗸 𝗰𝗮𝗵𝗮𝘆𝗮 ! ,sudah di loundry ,warna navy pekat ,bahan canvas ,very goodcondition.\r\n\r\n📩 For order / lebih detail Chat or WA \r\nWa : 0882001848112\r\nIg : hakki.thrifttops & hakkistuff.id\r\nRekber +13% Admin\r\nLok : Bandung ,Jawa Barat', 199000.00, 1, 'products/OF1bgkHTCEOFpqFUIuqOO42MqlzEkHs9jB5m1CNh.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(11, 3, 'Lip Cream Velvet BRASOV', 'dijual soalnya salah shade\r\nwarna nya thai tea cakep gt \r\nbisa oyenn 🧡', 20000.00, 1, 'products/X8oUb52RsQ2krcGjBT0YwDJzSUBBgJvcz1MnNA7w.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(12, 3, 'OMG Face Wash', 'Masih segel yaa', 12000.00, 1, 'products/vW4OkEnGAup0eGRWTu8I1YiswlHcunMbtoPFZXcz.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(13, 3, 'Amos Professional Unix Hair Dryer', 'Authentic 💯\r\nbeli di official store\r\nPemakaian Pribadi \r\n 🚩Malang', 100000.00, 1, 'products/9fqHH6WKiqfVvIHPfLVCphkJXBKLW4LGJFTZAdrI.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(14, 3, 'Supremacy In Oud Adnan EDP', 'Bought for 620.000\r\nSisa juice 60%\r\nFullset with box\r\nNego santai', 380000.00, 1, 'products/cfJ1GU20Qsf4d3N8N8NUKz0VtPLR8XMbq4NBTBjB.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(15, 3, 'Lavojoy - Hold Me Tight Pro Shampoo', 'Brand new masih segel\r\nDijual karena udah ada sampo lain\r\n\r\n📦 Pengiriman:\r\n• Kirim manual dari Benhil, Jakarta aja ya\r\n• Nggak bisa lewat e-commerce\r\n• Pengiriman hanya tiap weekend (Sabtu/Minggu)\r\nMakasih udah ngerti yaa! 😊', 75000.00, 1, 'products/IbSkdcJYWA3BGAYGgDE0hE8GDbnKADHEaBEqZDdB.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(16, 6, 'Digicam Sony DSC S930', 'kondisi fisik masih lumayan\r\nminus Kuningan batre udh karat mungkin perlu di Servis', 500000.00, 1, 'products/0MSx87hODTm7hTIrjqoo7m3JIvbhInD1bfb0deZX.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(17, 6, 'JBL GO 2 Black Blueetooth Speaker Authentic', 'Authentic 💯\r\nbeli di official store\r\nPemakaian Pribadi \r\n 🚩Malang', 100000.00, 1, 'products/mgKk3iOlNRrJtMGpOGFlPRdI97ZIrS0Bl2IVKFYP.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(18, 6, 'Kamera Canon Eos M10 with Box', 'Kamera Canon EOS M10 Fullset KIT\r\nLCD vignet tidak ngaruh hasil\r\nkondisi :\r\naf mf normal\r\naudio video normal\r\nTouchscreen normal\r\nFlash Nyala\r\nHasil Jepretan tajam\r\nKelengkapan :\r\n- Kamera\r\n- Baterai\r\n- Charger\r\n- Box\r\n\r\nlok : Jogja', 3650000.00, 1, 'products/9L2nS3AyYPjjMysY2fj11Mai1X3KEi4UEnO3GGVb.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(19, 6, 'Macbook Pro 2017', 'Good Condition!!\r\nMac OS terbaru, Storage 8/250, CC rendah, Pemakaian 4/5 Jam Nugas / Games / Netflix Lancar', 2000000.00, 1, 'products/P5HHfKNxTN2lgsLm6gbzJlzO2I5tzxq3cZeJhlNI.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(20, 6, 'PC gaming intel core i5 9400f GTX 1060 512GB', 'Dijual PC, Spec:\r\n- Intel Core i5 9400f\r\n- Mobo Asrock H310\r\n- VGA GTX 1060 3GB\r\n- RAM 16GB (2x8GB) \r\n- SSD 2x240GB\r\n- PSU Corsair VX 550W\r\n\r\nGak nego dapet bonus', 4200000.00, 1, 'products/IRtPGsQ7gpMLZSyUqYDJOCbOxfjnSSVTChbqeLcC.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(21, 5, 'Sleepsuit Adem', 'HARGA NETT, NO NEGO ❗❗❗\r\nCek Ongkir di Tokren \"Zydbabykids\"\r\n\r\n✔️ Keterangan ada di gambar, kalau ada berbulu, noda, minusnya sudah dijelaskan ya. harap baca dg teliti. Barang mantan ya mom, jangan berekspektasi tinggi. \r\n✔️ Transaksi di Tokren +12% admin oren. \r\n✔️ Pembayaran split (apabila terjadi kehilangan barang dlm perjalanan akan diganti sesuai co) kecuali barang kembali ke seller, silahkan chat terlebih dahulu. WAJIB VIDEO UNBOXING\r\n✔️ Warna di foto bisa real bisa beda tergantung pencahayaan di kamera hp\r\n✔️ Membeli = Setuju, No Complain. \r\n✔️ Harap memberikan review yg bijak di kolom komentar \r\n\r\nHappy Shopping mom\r\n\r\n#prelovedbanjarmasin #babystuff #garagesale #prelovedjaket #thriftimport #thrift #prelovedbranded #bajubayi #prelovedbayi #prelovedbajuanak #prelovedsleepsuit #jaketwinteranak #jaketbulanganak #kemejaanak', 25000.00, 1, 'products/A3BoZ7ZnDaocx38zD8JfwdQqFVT5FoRhRszw9k71.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(22, 5, 'ERGOBABY OMNI 360 AIRMESH CHAMBRAY ORIGINAL', NULL, 1550000.00, 1, 'products/EZkQDRjJPNM5rNEIXVw40Fx3SgdXW6TmFoSttBCC.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(23, 5, 'Rok petticoat anak rok pengembang dress anak', 'Rok petticoat anak, bahan organza, berfuring, pinggang karet\r\nSize 120 - 130 ( untuk usia 4 - 6 tahun) \r\n\r\nBrand -\r\nLP 46 - 70\r\nP 29', 35000.00, 1, 'products/1aoif8f8rp8wlcx1oqYU6PJHwwTBXosOIZQ6aqUs.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(24, 5, '110 Dress H&M Linen Biru Denim Anak Perempuan 3-4 Tahun', '• Pada foto pertama, warna diusahakan akan diedit semirip mungkin dengan aslinya.\r\n• Kadang ada barang yang sudah nett karena sudah termasuk freeong/admin marketplace yang sudah disubsidi (tergantung barangnya)\r\n• Kalau nego sadis otomatis di blok ya 🙏🏻\r\n\r\nPengiriman bisa melalui:\r\n✅ wahana (ongkir 5-15rb, rata2 7rb)\r\n✅ marketplace +admin (oren, ijo) bisa co link kecil sisanya transfer', 25000.00, 1, 'products/PDZ1XLubpq7qYQq7S7BMCDZAU4OgN9IgMMs5TDah.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(25, 5, 'Stroller pockit', 'stroller pockit gen 2s\\r\\nlike new', 700000.00, 1, 'products/03YJ9hIDuqyZTFRPW6nKQDHHSdPleS5fsEUNNc5G.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(26, 6, 'KATE SPADE KNOTT MINI SATCHEL', 'KATE SPADE KNOTT MINI SATCHEL\r\n\r\nKondisi: almost VVGC (hanya ada noda secuil di bagian salam, selebihnya VVGC)\r\nKelengkapan: Price Tag, Long Strap, DB Pengganti\r\n\r\n\r\n#katespade #katespadebags #katespadeauthentic #katespadeknott #barangauthentic #barangbranded #prelovedauthentic #prelovedmurah #prelovedjkt', 1500000.00, 1, 'products/bmIwTqQEKVRj7h1KVTau2fgp0HL9xKS8JYeFjwC3.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(27, 6, 'Coach Nolita', 'Coach nolita🖤\r\nAuthentic💯\r\nMuluss pamakaian wajar😍', 800000.00, 1, 'products/9HXzljYx5GCkM1gGWLHMlNvLrX9YiL4vNZJstwU4.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(28, 6, 'Tas Charles & Keith Alcott Scraft', 'Tas Charles & Keith Alcott Scraft\r\nLike new\r\nPemakaian 2x\r\nMasih mulus semua no deffect\r\nBisa toko oren ada biaya admin 10%', 850000.00, 1, 'products/BRk6dWTSn29o0nzsxe3nuNXdtSlmt1gQmASYxU24.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(29, 6, 'LV Speedy 30 Monogram 2005', 'bag db pengganti padlock (nempel)\r\nkondisi apa ada nya \r\nnett no nego', 2750000.00, 1, 'products/iBwPNS1z9I4YsFNj1c2vaAoHy4Je3AOhWIPHEz4o.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56'),
(30, 6, 'Coach Bag Reversible New', 'Original Coach Bag\r\nNever been used\r\nTipe reversible, 1 tas bisa dipakai 2 mode sehingga seperti punya 2 tas\r\nPanjang 32cm, Tinggi 26cm\r\nDust bag dan paper bag lengkap\r\nNego tipis\r\n\r\nMinat DM', 1799000.00, 1, 'products/SvshcDypurJ6ciReNftp0SqJCCpVfMF6NPP6NXud.jpg', '2025-05-18 00:46:56', '2025-05-18 00:46:56');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_price` decimal(12,2) NOT NULL,
  `status` enum('pending','paid','failed','cancelled') NOT NULL DEFAULT 'pending',
  `payment_method` varchar(50) NOT NULL DEFAULT 'midtrans',
  `midtrans_order_id` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `total_price`, `status`, `payment_method`, `midtrans_order_id`, `created_at`, `updated_at`) VALUES
(1, 1, 300.00, 'paid', 'midtrans', NULL, '2025-05-03 17:02:06', '2025-05-16 17:02:06'),
(2, 1, 105.00, 'paid', 'midtrans', NULL, '2025-05-10 17:02:06', '2025-05-16 17:02:06'),
(3, 1, 89.00, 'paid', 'midtrans', NULL, '2025-05-13 17:02:06', '2025-05-16 17:02:06'),
(4, 1, 300.00, 'paid', 'midtrans', NULL, '2025-04-16 17:02:06', '2025-05-16 17:02:06'),
(5, 1, 314.00, 'paid', 'midtrans', NULL, '2025-05-11 17:02:06', '2025-05-16 17:02:06'),
(6, 1, 135.00, 'paid', 'midtrans', NULL, '2025-04-26 17:02:06', '2025-05-16 17:02:06'),
(7, 1, 400.00, 'paid', 'midtrans', NULL, '2025-05-15 17:02:06', '2025-05-16 17:02:06'),
(8, 1, 230.00, 'paid', 'midtrans', NULL, '2025-05-12 17:02:06', '2025-05-16 17:02:06'),
(9, 1, 55.00, 'paid', 'midtrans', NULL, '2025-05-11 17:02:06', '2025-05-16 17:02:06'),
(10, 1, 130.00, 'paid', 'midtrans', NULL, '2025-04-22 17:02:06', '2025-05-16 17:02:06'),
(11, 1, 315.00, 'paid', 'midtrans', NULL, '2025-05-14 17:02:06', '2025-05-16 17:02:06'),
(12, 1, 255.00, 'paid', 'midtrans', NULL, '2025-05-03 17:02:06', '2025-05-16 17:02:06'),
(13, 1, 110.00, 'paid', 'midtrans', NULL, '2025-05-08 17:02:06', '2025-05-16 17:02:06'),
(14, 1, 75.00, 'paid', 'midtrans', NULL, '2025-05-06 17:02:06', '2025-05-16 17:02:06'),
(15, 1, 45.00, 'paid', 'midtrans', NULL, '2025-05-10 17:02:06', '2025-05-16 17:02:06'),
(16, 1, 330.00, 'paid', 'midtrans', NULL, '2025-05-13 17:02:06', '2025-05-16 17:02:06'),
(17, 1, 224.00, 'paid', 'midtrans', NULL, '2025-05-12 17:02:06', '2025-05-16 17:02:06'),
(18, 1, 268.00, 'paid', 'midtrans', NULL, '2025-04-18 17:02:06', '2025-05-16 17:02:06'),
(19, 1, 315.00, 'paid', 'midtrans', NULL, '2025-05-15 17:02:06', '2025-05-16 17:02:06'),
(20, 1, 225.00, 'paid', 'midtrans', NULL, '2025-04-20 17:02:06', '2025-05-16 17:02:06');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_items`
--

CREATE TABLE `transaction_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_items`
--

INSERT INTO `transaction_items` (`id`, `transaction_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, 45.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(2, 1, 5, 3, 55.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(3, 2, 2, 3, 35.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(4, 3, 3, 1, 89.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(5, 4, 5, 3, 55.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(6, 4, 1, 3, 45.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(7, 5, 3, 1, 89.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(8, 5, 6, 3, 75.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(9, 6, 1, 3, 45.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(10, 7, 1, 3, 45.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(11, 7, 4, 3, 65.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(12, 7, 2, 2, 35.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(13, 8, 2, 1, 35.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(14, 8, 1, 1, 45.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(15, 8, 6, 2, 75.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(16, 9, 5, 1, 55.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(17, 10, 4, 2, 65.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(18, 11, 6, 3, 75.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(19, 11, 5, 1, 55.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(20, 11, 2, 1, 35.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(21, 12, 4, 2, 65.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(22, 12, 5, 1, 55.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(23, 12, 2, 2, 35.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(24, 13, 5, 2, 55.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(25, 14, 6, 1, 75.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(26, 15, 1, 1, 45.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(27, 16, 6, 3, 75.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(28, 16, 2, 3, 35.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(29, 17, 3, 1, 89.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(30, 17, 1, 3, 45.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(31, 18, 1, 2, 45.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(32, 18, 3, 2, 89.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(33, 19, 5, 3, 55.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(34, 19, 6, 2, 75.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06'),
(35, 20, 6, 3, 75.00, '2025-05-16 17:02:06', '2025-05-16 17:02:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `phone`, `address`, `birth_date`, `remember_token`, `created_at`, `updated_at`, `profile_picture`, `email_verified_at`) VALUES
(1, 'Admin', 'admin@rewear.com', '$2y$12$3wtzq5ZQ1HcIbwMifr6lFujivLtBdC4MlLxyym.u4iUBZgQtCYjyO', 'admin', '081234567890', 'Jl. Admin No. 1', '1990-01-01', NULL, '2025-05-18 00:46:55', '2025-05-18 06:36:32', NULL, '2025-05-18 00:46:55'),
(2, 'User', 'user@rewear.com', '$2y$12$r6x3tuZF7XXgP58gJFt4HOK7tvqJgBfBTXrwr8bwHRqWHtrZ1pYc.', 'user', '089876543210', 'Jl. User No. 1', '1992-05-15', NULL, '2025-05-18 00:46:55', '2025-05-18 00:46:55', NULL, '2025-05-18 00:46:55'),
(3, 'John Doe', 'john@example.com', '$2y$12$0aQ43u0pOK4LdAqXQZZzQ.tS3pFBbbeveRwLH9Uj56BJL2T6XP09O', 'user', '081234567891', 'Jl. John Doe No. 1', '1995-03-20', NULL, '2025-05-18 00:46:55', '2025-05-18 00:46:55', NULL, '2025-05-18 00:46:55'),
(4, 'Jane Smith', 'jane@example.com', '$2y$12$J406U4glb6ScMDTHMaP5Z.Yi/OxpqNgw/HIO1qnZewH1h59Q9jnnu', 'user', '081234567892', 'Jl. Jane Smith No. 1', '1993-07-10', NULL, '2025-05-18 00:46:56', '2025-05-18 00:46:56', NULL, '2025-05-18 00:46:56'),
(5, 'Dina Eliza', 'dina@gmail.com', '$2y$12$k.fsWzDTpeuYA4iwfc2MUurnv3YtBZIUszlbifn9WetPBHWjuCHPC', 'user', '085212345678', 'Jl. Haji Karim', NULL, NULL, '2025-05-18 08:01:35', '2025-05-18 08:01:35', 'assets-admin/static/images/avatar-default.svg', NULL);

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
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(8, 5, 6, '2025-05-18 08:01:56', '2025-05-18 08:01:56'),
(9, 5, 2, '2025-05-18 08:02:00', '2025-05-18 08:02:00'),
(10, 5, 7, '2025-05-18 08:02:22', '2025-05-18 08:02:22');

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
  ADD KEY `products_category_id_foreign` (`category_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

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
