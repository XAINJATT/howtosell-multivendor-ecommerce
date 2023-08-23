-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2023 at 07:39 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing_infos`
--

CREATE TABLE `billing_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` text DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Josiah Velez', 'josiah-velez', 'Image-20230819-175350.jpg', '2023-08-20 00:53:50', '2023-08-20 00:53:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Black', '2023-08-20 00:54:00', '2023-08-20 00:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `discount_amount` double DEFAULT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `favorite_products`
--

CREATE TABLE `favorite_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favorite_products`
--

INSERT INTO `favorite_products` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2023-08-20 03:45:44', '2023-08-20 03:45:44');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_12_175947_create_categories_table', 1),
(6, '2023_05_16_180653_create_products_table', 1),
(7, '2023_05_23_183013_create_product_images_table', 1),
(8, '2023_05_26_164330_create_user_profiles_table', 1),
(9, '2023_05_26_164946_create_user_locations_table', 1),
(10, '2023_07_13_111623_create_languages_table', 1),
(11, '2023_07_17_111046_create_profiles_table', 1),
(12, '2023_07_17_180504_create_web_lang_details_table', 1),
(13, '2023_08_10_184411_create_colors_table', 1),
(14, '2023_08_10_184521_create_sizes_table', 1),
(15, '2023_08_10_213918_create_product_colors_table', 1),
(16, '2023_08_10_214105_create_product_sizes_table', 1),
(17, '2023_08_13_073149_create_coupons_table', 1),
(18, '2023_08_13_091225_create_permission_tables', 1),
(19, '2023_08_13_091548_create_orders_table', 1),
(20, '2023_08_13_093242_create_order_items_table', 1),
(21, '2023_08_13_093436_create_billing_infos_table', 1),
(22, '2023_08_13_093522_create_shipping_infos_table', 1),
(23, '2023_08_13_095324_create_stocks_table', 1),
(24, '2023_08_15_202759_create_reviews_table', 1),
(25, '2023_08_16_201933_create_favorite_products_table', 1),
(26, '2023_08_20_191551_create_order_venders_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `delivery_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shipping_info_id` bigint(20) UNSIGNED DEFAULT NULL,
  `billing_info_id` bigint(20) UNSIGNED DEFAULT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_status` enum('AFS','RFA','DEL') NOT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `shipping_amount` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `order_description` text DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'unpaid',
  `delivery_note` varchar(255) DEFAULT NULL,
  `IP_address` varchar(255) DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL,
  `shipped_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `product_price` double DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `promo_discount` double DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_venders`
--

CREATE TABLE `order_venders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(2, 'product', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(3, 'category', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(4, 'coupon', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(5, 'role', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(6, 'order', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(7, 'permission', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(8, 'stock', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(9, 'color', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(10, 'size', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(11, 'product-list', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(12, 'product-add', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(13, 'product-edit', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(14, 'product-delete', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(15, 'category-list', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(16, 'category-add', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(17, 'category-edit', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(18, 'category-delete', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(19, 'coupon-list', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(20, 'coupon-add', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(21, 'coupon-edit', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(22, 'coupon-delete', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(23, 'role-list', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(24, 'role-edit', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(25, 'role-delete', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(26, 'order-list', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(27, 'permission-list', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(28, 'permission-add', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(29, 'permission-edit', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(30, 'permission-delete', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(31, 'stock-list', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(32, 'color-list', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(33, 'color-add', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(34, 'color-edit', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(35, 'color-delete', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(36, 'size-list', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(37, 'size-add', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(38, 'size-edit', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03'),
(39, 'size-delete', 'web', '2023-08-19 04:05:03', '2023-08-19 04:05:03');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_id` varchar(255) NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
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
  `name` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `discounted_price` double DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `long_description` text DEFAULT NULL,
  `soh` int(11) DEFAULT NULL,
  `language_id` bigint(20) UNSIGNED DEFAULT NULL,
  `added_by` bigint(20) UNSIGNED DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `price`, `discounted_price`, `product_image`, `short_description`, `long_description`, `soh`, `language_id`, `added_by`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dana Carver', 1000, 800, 'Image-20230819-175440.jpg', 'Aliqua Consequat P', 'Sunt molestiae volup', 581, NULL, 1, NULL, '2023-08-20 00:54:40', '2023-08-20 00:54:40'),
(2, 1, 'Todd Vaughn', 919, 700, 'Image-20230819-204336.jpg', 'Sint consequat Dolo', 'Ratione ratione elit', 716, NULL, 1, NULL, '2023-08-20 03:43:36', '2023-08-20 03:43:36');

-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

CREATE TABLE `product_colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `color_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_colors`
--

INSERT INTO `product_colors` (`id`, `product_id`, `color_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2023-08-20 00:54:40', '2023-08-20 00:54:40'),
(2, 2, 1, '2023-08-20 03:43:36', '2023-08-20 03:43:36');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'public/product/1692464080299.jpg', '2023-08-20 00:54:40', '2023-08-20 00:54:40'),
(2, 1, 'public/product/169246408035.jpg', '2023-08-20 00:54:40', '2023-08-20 00:54:40'),
(3, 1, 'public/product/1692464080220.jpg', '2023-08-20 00:54:40', '2023-08-20 00:54:40'),
(4, 1, 'public/product/1692464080443.jpg', '2023-08-20 00:54:40', '2023-08-20 00:54:40'),
(5, 1, 'public/product/1692464080884.jpg', '2023-08-20 00:54:40', '2023-08-20 00:54:40'),
(6, 1, 'public/product/1692464080552.jpg', '2023-08-20 00:54:40', '2023-08-20 00:54:40'),
(7, 2, 'public/product/169247421622.jpg', '2023-08-20 03:43:36', '2023-08-20 03:43:36'),
(8, 2, 'public/product/1692474216950.jpg', '2023-08-20 03:43:36', '2023-08-20 03:43:36'),
(9, 2, 'public/product/1692474216192.jpg', '2023-08-20 03:43:36', '2023-08-20 03:43:36'),
(10, 2, 'public/product/169247421625.jpg', '2023-08-20 03:43:36', '2023-08-20 03:43:36'),
(11, 2, 'public/product/1692474216325.jpg', '2023-08-20 03:43:36', '2023-08-20 03:43:36');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `size_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `size_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2023-08-20 00:54:40', '2023-08-20 00:54:40'),
(2, 2, 1, '2023-08-20 03:43:36', '2023-08-20 03:43:36');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `review` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `rating`, `review`, `name`, `email`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'Ut impedit ipsa Na', 'Lawrence Langley', 'kiba@mailinator.com', '2023-08-20 01:08:03', '2023-08-20 01:08:03'),
(2, 1, 3, 'Quia incidunt vel p', 'Dillon Daugherty', 'fetype@mailinator.com', '2023-08-20 01:15:05', '2023-08-20 01:15:05'),
(3, 1, 2, 'A quis architecto iu', 'Kellie Stephens', 'nymudyxyh@mailinator.com', '2023-08-20 01:15:28', '2023-08-20 01:15:28'),
(4, 2, 5, 'Dolor reprehenderit', 'Blake Beck', 'lakalubemy@mailinator.com', '2023-08-20 03:46:10', '2023-08-20 03:46:10');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', NULL, NULL),
(2, 'Vendor', 'web', NULL, NULL),
(3, 'Customer', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3),
(4, 1),
(5, 1),
(6, 1),
(6, 2),
(6, 3),
(7, 1),
(8, 1),
(8, 2),
(8, 3),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_infos`
--

CREATE TABLE `shipping_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Small', '2023-08-20 00:54:12', '2023-08-20 00:54:12');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1- stock, 0- initial_quantity',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `product_id`, `qty`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 581, 0, '2023-08-20 00:54:40', '2023-08-20 00:54:40'),
(2, 2, 716, 0, '2023-08-20 03:43:36', '2023-08-20 03:43:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1- Active, 0- Ban',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$Jf.B/ckcK0vFDa17ma/Tx.NdUTP245Gn.2G8javRPASpA7FMnO/Ja', 1, NULL, '2023-08-19 04:03:50', '2023-08-19 04:03:50', NULL),
(3, 'Rehan', 'rehan@gmail.com', NULL, '$2y$10$4GVJ9A5GM3v3vgQBQ2gJeO/QiGq6lkEzO2BPvkNm0ODu6BjskwNaW', 1, NULL, '2023-08-19 04:13:46', '2023-08-19 04:13:46', NULL),
(4, 'Suleman', 'suleman@gmail.com', NULL, '$2y$10$ojBm0gkrCFQLRTtnmgQSQ.H0tN721GY6/RRo4/BshS0LebnJCnMp.', 1, NULL, '2023-08-19 04:14:58', '2023-08-19 04:14:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_locations`
--

CREATE TABLE `user_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `address_1` varchar(255) DEFAULT NULL,
  `address_2` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `business_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `about_myself` text DEFAULT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `web_lang_details`
--

CREATE TABLE `web_lang_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `detail` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing_infos`
--
ALTER TABLE `billing_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite_products`
--
ALTER TABLE `favorite_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_venders`
--
ALTER TABLE `order_venders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `shipping_infos`
--
ALTER TABLE `shipping_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_locations`
--
ALTER TABLE `user_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_locations_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `web_lang_details`
--
ALTER TABLE `web_lang_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing_infos`
--
ALTER TABLE `billing_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorite_products`
--
ALTER TABLE `favorite_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_venders`
--
ALTER TABLE `order_venders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_colors`
--
ALTER TABLE `product_colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shipping_infos`
--
ALTER TABLE `shipping_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_locations`
--
ALTER TABLE `user_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_lang_details`
--
ALTER TABLE `web_lang_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_locations`
--
ALTER TABLE `user_locations`
  ADD CONSTRAINT `user_locations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
