-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 11, 2023 lúc 05:43 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ecom`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blogs`
--

CREATE TABLE `blogs` (
  `blogID` int(11) NOT NULL,
  `blogTitle` varchar(200) NOT NULL,
  `blogIntro` varchar(200) NOT NULL,
  `blogContent` text DEFAULT NULL,
  `blogCreatedDate` datetime NOT NULL,
  `blogModifiedDate` datetime NOT NULL,
  `blogSlug` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brand`
--

CREATE TABLE `brand` (
  `brandID` int(11) NOT NULL,
  `brandName` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(200) NOT NULL,
  `categorySlug` varchar(1000) DEFAULT NULL,
  `categoryImage` varchar(1000) DEFAULT NULL,
  `categoryDescription` varchar(1000) DEFAULT NULL,
  `subCategoryCount` int(11) DEFAULT 0,
  `productCount` int(11) DEFAULT 0,
  `categoryCreatedDate` datetime DEFAULT NULL,
  `categoryModifiedDate` datetime DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`categoryID`, `categoryName`, `categorySlug`, `categoryImage`, `categoryDescription`, `subCategoryCount`, `productCount`, `categoryCreatedDate`, `categoryModifiedDate`, `isActive`, `created_at`, `updated_at`) VALUES
(21, 'Sữa tắm', 'sữa-tắm', NULL, 'Sữa tắm cho người lớn', 1, 0, '2023-12-06 00:00:00', '2023-12-06 00:00:00', 1, NULL, '2023-12-05 23:27:54'),
(22, 'dầu gội', 'dầu-gội', NULL, NULL, 1, 0, '2023-12-06 00:00:00', '2023-12-06 00:00:00', 1, NULL, '2023-12-06 00:00:26'),
(23, 'kem chống nắng', 'kem-chống-nắng', NULL, NULL, 1, 0, '2023-12-06 00:00:00', '2023-12-06 00:00:00', 1, NULL, '2023-12-06 00:00:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ch_favorites`
--

CREATE TABLE `ch_favorites` (
  `id` char(36) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `favorite_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ch_favorites`
--

INSERT INTO `ch_favorites` (`id`, `user_id`, `favorite_id`, `created_at`, `updated_at`) VALUES
('0238a5f3-6738-4c27-b4e5-cd779c7c6612', 8, 1, '2023-12-10 20:08:55', '2023-12-10 20:08:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ch_messages`
--

CREATE TABLE `ch_messages` (
  `id` char(36) NOT NULL,
  `from_id` bigint(20) NOT NULL,
  `to_id` bigint(20) NOT NULL,
  `body` varchar(5000) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ch_messages`
--

INSERT INTO `ch_messages` (`id`, `from_id`, `to_id`, `body`, `attachment`, `seen`, `created_at`, `updated_at`) VALUES
('25ccb9d4-a503-495c-87fe-131fc66cdb2b', 8, 1, 'kfnbelkwnb', NULL, 1, '2023-12-10 20:05:55', '2023-12-10 20:05:56'),
('2e6f961a-6b8a-48aa-a52b-14e3ad88a1c8', 8, 1, 'a', NULL, 1, '2023-12-10 20:03:07', '2023-12-10 20:03:13'),
('42c48935-299f-49e2-ab8a-2340040244e8', 8, 1, 'lfkjlakfsh lr;wh', NULL, 1, '2023-12-10 20:04:18', '2023-12-10 20:04:19'),
('458f1f58-8b69-4b7f-8daa-6817411deed9', 8, 1, 'dgafsg', NULL, 1, '2023-12-10 20:04:32', '2023-12-10 20:05:22'),
('4d926e14-8b28-4dcf-9677-d138c0fd2874', 8, 1, '', '{\"new_name\":\"96a6f82c-12ec-4857-8f3e-0d0fc110f328.jpg\",\"old_name\":\"393135882_1051794785958611_3011471789385254639_n.jpg\"}', 1, '2023-12-10 20:10:03', '2023-12-10 20:12:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer_infos`
--

CREATE TABLE `customer_infos` (
  `customerID` int(11) NOT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `customerName` varchar(200) DEFAULT NULL,
  `customerPhone` varchar(200) DEFAULT NULL,
  `customerEmail` varchar(200) DEFAULT NULL,
  `customerProvinceID` int(11) DEFAULT NULL,
  `customerAddress` varchar(200) DEFAULT NULL,
  `customerStatus` tinyint(1) NOT NULL DEFAULT 1,
  `customerJoinDate` datetime DEFAULT NULL,
  `customerOrderQuantity` int(11) NOT NULL DEFAULT 0,
  `customerBankAccount` varchar(200) DEFAULT NULL,
  `customerBankName` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `discounts`
--

CREATE TABLE `discounts` (
  `discountID` int(11) NOT NULL,
  `discountCode` varchar(200) NOT NULL,
  `discountName` varchar(200) NOT NULL,
  `discountDescription` text DEFAULT NULL,
  `discountQuantity` int(11) NOT NULL DEFAULT 0,
  `discountUsed` int(11) NOT NULL DEFAULT 0,
  `discountType` enum('percent','fixed') NOT NULL DEFAULT 'fixed',
  `discountAmount` double(10,2) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `discountStart` datetime DEFAULT NULL,
  `discountEnd` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
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
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_11_10_081911_laratrust_setup_tables', 2),
(6, '2023_11_18_182158_create_categories_table', 3),
(7, '2023_11_18_184151_create_subcategories_table', 4),
(8, '2023_11_18_184913_create_products_table', 5),
(9, '2023_12_11_999999_add_active_status_to_users', 6),
(10, '2023_12_11_999999_add_avatar_to_users', 7),
(11, '2023_12_11_999999_add_dark_mode_to_users', 8),
(12, '2023_12_11_999999_add_messenger_color_to_users', 9),
(13, '2023_12_11_999999_create_chatify_favorites_table', 10),
(14, '2023_12_11_999999_create_chatify_messages_table', 11);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `customerID` int(11) DEFAULT NULL,
  `orderCustomerName` varchar(200) DEFAULT NULL,
  `totalPrice` int(11) NOT NULL,
  `shippingFee` int(11) NOT NULL,
  `discountID` int(11) DEFAULT NULL,
  `discountCode` varchar(200) DEFAULT NULL,
  `discountPrice` varchar(200) DEFAULT NULL,
  `grandPrice` int(11) NOT NULL,
  `paymentMethod` varchar(200) DEFAULT NULL,
  `orderCreatedDate` datetime NOT NULL,
  `orderCompletedDate` datetime DEFAULT NULL,
  `orderProvinceID` int(11) DEFAULT NULL,
  `orderAddress` varchar(200) DEFAULT NULL,
  `orderPhone` varchar(200) DEFAULT NULL,
  `paymentStatus` enum('paid','unpaid') NOT NULL DEFAULT 'unpaid',
  `orderStatus` enum('pending','processing','completed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`orderID`, `customerID`, `orderCustomerName`, `totalPrice`, `shippingFee`, `discountID`, `discountCode`, `discountPrice`, `grandPrice`, `paymentMethod`, `orderCreatedDate`, `orderCompletedDate`, `orderProvinceID`, `orderAddress`, `orderPhone`, `paymentStatus`, `orderStatus`, `created_at`, `updated_at`) VALUES
(2, NULL, '', 7289696, 20000, NULL, NULL, NULL, 7289696, 'COD', '2023-12-09 15:23:54', '2023-12-09 15:23:54', NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 08:23:54', '2023-12-09 08:23:54'),
(3, NULL, 'Nguyễn Văn A', 2423232, 20000, NULL, NULL, NULL, 2423232, 'banking', '2023-12-09 16:47:41', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 09:47:41', '2023-12-09 09:47:41'),
(4, NULL, 'Nguyễn Văn A', 100000, 20000, NULL, NULL, NULL, 100000, NULL, '2023-12-09 16:48:45', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 09:48:45', '2023-12-09 09:48:45'),
(5, NULL, 'Nguyễn Văn A', 100000, 20000, NULL, NULL, NULL, 100000, NULL, '2023-12-09 16:49:50', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 09:49:50', '2023-12-09 09:49:50'),
(6, NULL, 'Nguyễn Văn A', 100000, 20000, NULL, NULL, NULL, 100000, 'cash', '2023-12-09 16:50:13', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 09:50:13', '2023-12-09 09:50:13'),
(7, NULL, 'Nguyễn Văn A', 320000, 20000, NULL, NULL, NULL, 320000, 'banking', '2023-12-09 16:51:47', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 09:51:47', '2023-12-09 09:51:47'),
(8, NULL, 'Nguyễn Văn A', 100000, 20000, NULL, NULL, NULL, 100000, 'banking', '2023-12-09 16:53:24', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 09:53:24', '2023-12-09 09:53:24'),
(9, NULL, 'Nguyễn Văn A', 100000, 20000, NULL, NULL, NULL, 100000, 'banking', '2023-12-09 16:53:55', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 09:53:55', '2023-12-09 09:53:55'),
(10, NULL, 'Nguyễn Văn A', 20000, 20000, NULL, NULL, NULL, 20000, NULL, '2023-12-09 16:54:57', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 09:54:57', '2023-12-09 09:54:57'),
(11, NULL, 'Nguyễn Văn A', 100000, 20000, NULL, NULL, NULL, 100000, NULL, '2023-12-09 16:55:11', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 09:55:11', '2023-12-09 09:55:11'),
(12, NULL, 'Nguyễn Văn A', 340000, 20000, NULL, NULL, NULL, 340000, NULL, '2023-12-09 16:55:38', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 09:55:38', '2023-12-09 09:55:38'),
(13, NULL, 'Nguyễn Văn A', 340000, 20000, NULL, NULL, NULL, 340000, 'cash', '2023-12-09 16:58:30', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 09:58:30', '2023-12-09 09:58:30'),
(14, NULL, 'Nguyễn Văn A', 340000, 20000, NULL, NULL, NULL, 340000, 'cash', '2023-12-09 16:58:30', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 09:58:30', '2023-12-09 09:58:30'),
(15, NULL, 'Nguyễn Văn A', 100000, 20000, NULL, NULL, NULL, 100000, NULL, '2023-12-09 16:59:01', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 09:59:01', '2023-12-09 09:59:01'),
(16, NULL, 'Nguyễn Văn A', 320000, 20000, NULL, NULL, NULL, 320000, NULL, '2023-12-09 17:01:35', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 10:01:35', '2023-12-09 10:01:35'),
(17, NULL, 'Nguyễn Văn A', 2343232, 20000, NULL, NULL, NULL, 2343232, NULL, '2023-12-09 17:02:04', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 10:02:04', '2023-12-09 10:02:04'),
(18, NULL, 'Nguyễn Văn A', 180000, 20000, NULL, NULL, NULL, 180000, NULL, '2023-12-10 03:11:29', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:11:29', '2023-12-09 20:11:29'),
(19, NULL, 'Nguyễn Văn A', 340000, 20000, NULL, NULL, NULL, 340000, NULL, '2023-12-10 03:12:27', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:12:27', '2023-12-09 20:12:27'),
(20, NULL, 'Nguyễn Văn A', 620000, 20000, NULL, NULL, NULL, 620000, NULL, '2023-12-10 03:13:28', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:13:28', '2023-12-09 20:13:28'),
(21, NULL, 'Nguyễn Văn A', 2423232, 20000, NULL, NULL, NULL, 2423232, NULL, '2023-12-10 03:14:51', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:14:51', '2023-12-09 20:14:51'),
(22, NULL, 'Nguyễn Văn A', 2720000, 20000, NULL, NULL, NULL, 2720000, NULL, '2023-12-10 03:15:17', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:15:17', '2023-12-09 20:15:17'),
(23, NULL, 'Nguyễn Văn A', 100000, 20000, NULL, NULL, NULL, 100000, NULL, '2023-12-10 03:16:00', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:16:00', '2023-12-09 20:16:00'),
(24, NULL, 'Nguyễn Văn A', 620000, 20000, NULL, NULL, NULL, 620000, NULL, '2023-12-10 03:18:37', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:18:37', '2023-12-09 20:18:37'),
(25, NULL, 'Nguyễn Văn A', 2343232, 20000, NULL, NULL, NULL, 2343232, NULL, '2023-12-10 03:19:57', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:19:57', '2023-12-09 20:19:57'),
(26, NULL, 'Nguyễn Văn A', 2343232, 20000, NULL, NULL, NULL, 2343232, NULL, '2023-12-10 03:20:00', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:20:00', '2023-12-09 20:20:00'),
(27, NULL, 'Nguyễn Văn A', 340000, 20000, NULL, NULL, NULL, 340000, NULL, '2023-12-10 03:21:59', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:21:59', '2023-12-09 20:21:59'),
(28, NULL, 'Nguyễn Văn A', 100000, 20000, NULL, NULL, NULL, 100000, NULL, '2023-12-10 03:22:25', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:22:25', '2023-12-09 20:22:25'),
(29, NULL, 'Nguyễn Văn A', 100000, 20000, NULL, NULL, NULL, 100000, NULL, '2023-12-10 03:25:33', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:25:33', '2023-12-09 20:25:33'),
(30, NULL, 'Nguyễn Văn A', 100000, 20000, NULL, NULL, NULL, 100000, NULL, '2023-12-10 03:29:14', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:29:14', '2023-12-09 20:29:14'),
(31, NULL, 'Nguyễn Văn A', 320000, 20000, NULL, NULL, NULL, 320000, NULL, '2023-12-10 03:32:24', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:32:24', '2023-12-09 20:32:24'),
(32, NULL, 'Nguyễn Văn A', 100000, 20000, NULL, NULL, NULL, 100000, NULL, '2023-12-10 03:34:05', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:34:05', '2023-12-09 20:34:05'),
(33, NULL, 'Nguyễn Văn A', 100000, 20000, NULL, NULL, NULL, 100000, NULL, '2023-12-10 03:34:36', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:34:36', '2023-12-09 20:34:36'),
(34, NULL, 'Nguyễn Văn A', 100000, 20000, NULL, NULL, NULL, 100000, NULL, '2023-12-10 03:38:30', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:38:30', '2023-12-09 20:38:30'),
(35, NULL, 'Nguyễn Văn A', 100000, 20000, NULL, NULL, NULL, 100000, NULL, '2023-12-10 03:38:33', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:38:33', '2023-12-09 20:38:33'),
(36, NULL, 'Nguyễn Văn A', 100000, 20000, NULL, NULL, NULL, 100000, NULL, '2023-12-10 03:38:42', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:38:42', '2023-12-09 20:38:42'),
(37, NULL, 'Nguyễn Văn A', 320000, 20000, NULL, NULL, NULL, 320000, NULL, '2023-12-10 03:43:01', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:43:01', '2023-12-09 20:43:01'),
(38, NULL, 'Nguyễn Văn A', 320000, 20000, NULL, NULL, NULL, 320000, NULL, '2023-12-10 03:43:03', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:43:03', '2023-12-09 20:43:03'),
(39, NULL, 'Nguyễn Văn A', 320000, 20000, NULL, NULL, NULL, 320000, NULL, '2023-12-10 03:43:04', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:43:04', '2023-12-09 20:43:04'),
(40, NULL, 'Nguyễn Văn A', 320000, 20000, NULL, NULL, NULL, 320000, NULL, '2023-12-10 03:43:04', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:43:04', '2023-12-09 20:43:04'),
(41, NULL, 'Nguyễn Văn A', 320000, 20000, NULL, NULL, NULL, 320000, NULL, '2023-12-10 03:43:05', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:43:05', '2023-12-09 20:43:05'),
(42, NULL, 'Nguyễn Văn A', 320000, 20000, NULL, NULL, NULL, 320000, NULL, '2023-12-10 03:43:05', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:43:05', '2023-12-09 20:43:05'),
(43, NULL, 'Nguyễn Văn A', 320000, 20000, NULL, NULL, NULL, 320000, NULL, '2023-12-10 03:43:05', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:43:05', '2023-12-09 20:43:05'),
(44, NULL, 'Nguyễn Văn A', 320000, 20000, NULL, NULL, NULL, 320000, NULL, '2023-12-10 03:43:45', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:43:45', '2023-12-09 20:43:45'),
(45, NULL, 'Nguyễn Văn A', 320000, 20000, NULL, NULL, NULL, 320000, NULL, '2023-12-10 03:43:52', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:43:52', '2023-12-09 20:43:52'),
(46, NULL, 'Nguyễn Văn A', 100000, 20000, NULL, NULL, NULL, 100000, NULL, '2023-12-10 03:44:32', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:44:32', '2023-12-09 20:44:32'),
(47, NULL, 'Nguyễn Văn A', 320000, 20000, NULL, NULL, NULL, 320000, NULL, '2023-12-10 03:53:28', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:53:28', '2023-12-09 20:53:28'),
(48, NULL, 'Nguyễn Văn A', 320000, 20000, NULL, NULL, NULL, 320000, NULL, '2023-12-10 03:53:45', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 20:53:45', '2023-12-09 20:53:45'),
(49, NULL, 'Nguyễn Văn A', 100000, 20000, NULL, NULL, NULL, 100000, NULL, '2023-12-10 04:09:52', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 21:09:52', '2023-12-09 21:09:52'),
(50, NULL, 'Nguyễn Văn A', 100000, 20000, NULL, NULL, NULL, 100000, NULL, '2023-12-10 04:09:57', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 21:09:57', '2023-12-09 21:09:57'),
(51, NULL, 'Nguyễn Văn A', 100000, 20000, NULL, NULL, NULL, 100000, NULL, '2023-12-10 04:10:44', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 21:10:44', '2023-12-09 21:10:44'),
(52, NULL, 'Nguyễn Văn A', 100000, 20000, NULL, NULL, NULL, 100000, NULL, '2023-12-10 04:14:50', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 21:14:50', '2023-12-09 21:14:50'),
(53, NULL, 'Nguyễn Văn A', 100000, 20000, NULL, NULL, NULL, 100000, NULL, '2023-12-10 04:17:30', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 21:17:30', '2023-12-09 21:17:30'),
(54, NULL, 'Nguyễn Văn A', 100000, 20000, NULL, NULL, NULL, 100000, NULL, '2023-12-10 04:18:06', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 21:18:06', '2023-12-09 21:18:06'),
(55, NULL, 'Nguyễn Văn A', 820000, 20000, NULL, NULL, NULL, 820000, NULL, '2023-12-10 04:18:30', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 21:18:30', '2023-12-09 21:18:30'),
(56, NULL, 'Nguyễn Văn A', 100000, 20000, NULL, NULL, NULL, 100000, NULL, '2023-12-10 04:20:35', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 21:20:35', '2023-12-09 21:20:35'),
(57, NULL, 'Nguyễn Văn A', 100000, 20000, NULL, NULL, NULL, 100000, NULL, '2023-12-10 04:23:41', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-09 21:23:41', '2023-12-09 21:23:41'),
(58, NULL, 'Nguyễn Văn A', 1060000, 20000, NULL, NULL, NULL, 1060000, NULL, '2023-12-10 11:09:21', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-10 04:09:21', '2023-12-10 04:09:21'),
(59, NULL, 'Nguyễn Văn A', 260000, 20000, NULL, NULL, NULL, 260000, NULL, '2023-12-11 03:13:32', NULL, NULL, 'Hà Nội', '0123456789', 'unpaid', 'pending', '2023-12-10 20:13:32', '2023-12-10 20:13:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `orderDetailID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `productName` varchar(200) NOT NULL,
  `productPrice` int(11) NOT NULL,
  `productQuantity` int(11) NOT NULL,
  `productTotalPrice` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`orderDetailID`, `orderID`, `productID`, `productName`, `productPrice`, `productQuantity`, `productTotalPrice`, `created_at`, `updated_at`) VALUES
(1, 2, 20, 'sữa dê núi', 300000, 1, 300000, '2023-12-09 08:23:54', '2023-12-09 08:23:54'),
(2, 2, 23, 'dầu gội XMEN', 2323232, 3, 6969696, '2023-12-09 08:23:54', '2023-12-09 08:23:54'),
(3, 3, 23, 'dầu gội XMEN', 2323232, 1, 2323232, '2023-12-09 09:47:41', '2023-12-09 09:47:41'),
(4, 3, 22, 'kem chống nắng đen da', 80000, 1, 80000, '2023-12-09 09:47:41', '2023-12-09 09:47:41'),
(5, 4, 22, 'kem chống nắng đen da', 80000, 1, 80000, '2023-12-09 09:48:45', '2023-12-09 09:48:45'),
(6, 5, 21, 'dầu gội ROMANO', 80000, 1, 80000, '2023-12-09 09:49:50', '2023-12-09 09:49:50'),
(7, 7, 20, 'sữa dê núi', 300000, 1, 300000, '2023-12-09 09:51:47', '2023-12-09 09:51:47'),
(8, 8, 22, 'kem chống nắng đen da', 80000, 1, 80000, '2023-12-09 09:53:24', '2023-12-09 09:53:24'),
(9, 11, 22, 'kem chống nắng đen da', 80000, 1, 80000, '2023-12-09 09:55:11', '2023-12-09 09:55:11'),
(10, 12, 22, 'kem chống nắng đen da', 80000, 4, 320000, '2023-12-09 09:55:38', '2023-12-09 09:55:38'),
(11, 13, 22, 'kem chống nắng đen da', 80000, 4, 320000, '2023-12-09 09:58:30', '2023-12-09 09:58:30'),
(12, 15, 21, 'dầu gội ROMANO', 80000, 1, 80000, '2023-12-09 09:59:01', '2023-12-09 09:59:01'),
(13, 16, 20, 'sữa dê núi', 300000, 1, 300000, '2023-12-09 10:01:35', '2023-12-09 10:01:35'),
(14, 17, 23, 'dầu gội XMEN', 2323232, 1, 2323232, '2023-12-09 10:02:04', '2023-12-09 10:02:04'),
(15, 18, 21, 'dầu gội ROMANO', 80000, 2, 160000, '2023-12-09 20:11:29', '2023-12-09 20:11:29'),
(16, 19, 22, 'kem chống nắng đen da', 80000, 4, 320000, '2023-12-09 20:12:27', '2023-12-09 20:12:27'),
(17, 20, 20, 'sữa dê núi', 300000, 2, 600000, '2023-12-09 20:13:28', '2023-12-09 20:13:28'),
(18, 21, 21, 'dầu gội ROMANO', 80000, 1, 80000, '2023-12-09 20:14:51', '2023-12-09 20:14:51'),
(19, 21, 23, 'dầu gội XMEN', 2323232, 1, 2323232, '2023-12-09 20:14:51', '2023-12-09 20:14:51'),
(20, 22, 20, 'sữa dê núi', 300000, 9, 2700000, '2023-12-09 20:15:17', '2023-12-09 20:15:17'),
(21, 23, 22, 'kem chống nắng đen da', 80000, 1, 80000, '2023-12-09 20:16:00', '2023-12-09 20:16:00'),
(22, 24, 20, 'sữa dê núi', 300000, 2, 600000, '2023-12-09 20:18:37', '2023-12-09 20:18:37'),
(23, 25, 23, 'dầu gội XMEN', 2323232, 1, 2323232, '2023-12-09 20:19:57', '2023-12-09 20:19:57'),
(24, 27, 22, 'kem chống nắng đen da', 80000, 4, 320000, '2023-12-09 20:21:59', '2023-12-09 20:21:59'),
(25, 28, 21, 'dầu gội ROMANO', 80000, 1, 80000, '2023-12-09 20:22:25', '2023-12-09 20:22:25'),
(26, 29, 21, 'dầu gội ROMANO', 80000, 1, 80000, '2023-12-09 20:25:33', '2023-12-09 20:25:33'),
(27, 30, 22, 'kem chống nắng đen da', 80000, 1, 80000, '2023-12-09 20:29:14', '2023-12-09 20:29:14'),
(28, 31, 20, 'sữa dê núi', 300000, 1, 300000, '2023-12-09 20:32:24', '2023-12-09 20:32:24'),
(29, 32, 22, 'kem chống nắng đen da', 80000, 1, 80000, '2023-12-09 20:34:05', '2023-12-09 20:34:05'),
(30, 33, 21, 'dầu gội ROMANO', 80000, 1, 80000, '2023-12-09 20:34:36', '2023-12-09 20:34:36'),
(31, 34, 21, 'dầu gội ROMANO', 80000, 1, 80000, '2023-12-09 20:38:30', '2023-12-09 20:38:30'),
(32, 37, 20, 'sữa dê núi', 300000, 1, 300000, '2023-12-09 20:43:01', '2023-12-09 20:43:01'),
(33, 44, 20, 'sữa dê núi', 300000, 1, 300000, '2023-12-09 20:43:45', '2023-12-09 20:43:45'),
(34, 46, 22, 'kem chống nắng đen da', 80000, 1, 80000, '2023-12-09 20:44:32', '2023-12-09 20:44:32'),
(35, 47, 20, 'sữa dê núi', 300000, 1, 300000, '2023-12-09 20:53:28', '2023-12-09 20:53:28'),
(36, 48, 20, 'sữa dê núi', 300000, 1, 300000, '2023-12-09 20:53:45', '2023-12-09 20:53:45'),
(37, 49, 22, 'kem chống nắng đen da', 80000, 1, 80000, '2023-12-09 21:09:52', '2023-12-09 21:09:52'),
(38, 51, 21, 'dầu gội ROMANO', 80000, 1, 80000, '2023-12-09 21:10:44', '2023-12-09 21:10:44'),
(39, 52, 21, 'dầu gội ROMANO', 80000, 1, 80000, '2023-12-09 21:14:50', '2023-12-09 21:14:50'),
(40, 53, 22, 'kem chống nắng đen da', 80000, 1, 80000, '2023-12-09 21:17:30', '2023-12-09 21:17:30'),
(41, 55, 22, 'kem chống nắng đen da', 80000, 10, 800000, '2023-12-09 21:18:30', '2023-12-09 21:18:30'),
(42, 56, 22, 'kem chống nắng đen da', 80000, 1, 80000, '2023-12-09 21:20:35', '2023-12-09 21:20:35'),
(43, 57, 22, 'kem chống nắng đen da', 80000, 1, 80000, '2023-12-09 21:23:41', '2023-12-09 21:23:41'),
(44, 58, 22, 'kem chống nắng đen da', 80000, 10, 800000, '2023-12-10 04:09:21', '2023-12-10 04:09:21'),
(45, 58, 21, 'dầu gội ROMANO', 80000, 3, 240000, '2023-12-10 04:09:21', '2023-12-10 04:09:21'),
(46, 59, 21, 'dầu gội ROMANO', 80000, 3, 240000, '2023-12-10 20:13:32', '2023-12-10 20:13:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('nhta10.1107@gmail.com', '$2y$12$f6MLkVh6JTYte9LrkewILuU47MupaNT5XP/AlCba9vasUFlbPlLdC', '2023-11-19 20:26:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'users-create', 'Create Users', 'Create Users', '2023-11-10 01:28:34', '2023-11-10 01:28:34'),
(2, 'users-read', 'Read Users', 'Read Users', '2023-11-10 01:28:34', '2023-11-10 01:28:34'),
(3, 'users-update', 'Update Users', 'Update Users', '2023-11-10 01:28:35', '2023-11-10 01:28:35'),
(4, 'users-delete', 'Delete Users', 'Delete Users', '2023-11-10 01:28:35', '2023-11-10 01:28:35'),
(5, 'payments-create', 'Create Payments', 'Create Payments', '2023-11-10 01:28:35', '2023-11-10 01:28:35'),
(6, 'payments-read', 'Read Payments', 'Read Payments', '2023-11-10 01:28:35', '2023-11-10 01:28:35'),
(7, 'payments-update', 'Update Payments', 'Update Payments', '2023-11-10 01:28:35', '2023-11-10 01:28:35'),
(8, 'payments-delete', 'Delete Payments', 'Delete Payments', '2023-11-10 01:28:35', '2023-11-10 01:28:35'),
(9, 'profile-read', 'Read Profile', 'Read Profile', '2023-11-10 01:28:35', '2023-11-10 01:28:35'),
(10, 'profile-update', 'Update Profile', 'Update Profile', '2023-11-10 01:28:35', '2023-11-10 01:28:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(9, 2),
(10, 1),
(10, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
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
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `productID` int(11) NOT NULL,
  `productName` varchar(200) NOT NULL,
  `productBrandID` int(11) DEFAULT NULL,
  `productBrandName` varchar(50) DEFAULT NULL,
  `productSubCategoryID` int(50) DEFAULT NULL,
  `productSubCategoryName` varchar(50) DEFAULT NULL,
  `productCategoryID` int(50) DEFAULT NULL,
  `productCategoryName` varchar(50) DEFAULT NULL,
  `productOriginalPrice` int(11) DEFAULT NULL,
  `productDiscountPrice` int(11) DEFAULT NULL,
  `productInfo` text DEFAULT NULL,
  `productBarcode` varchar(50) DEFAULT NULL,
  `productInStock` int(11) DEFAULT NULL,
  `productSoldQuantity` int(11) DEFAULT NULL,
  `productImage` varchar(1000) DEFAULT NULL,
  `productSideImage1` varchar(1000) DEFAULT NULL,
  `productSideImage2` varchar(1000) DEFAULT NULL,
  `productSideImage3` varchar(1000) DEFAULT NULL,
  `productCreatedDate` datetime DEFAULT NULL,
  `productModifiedDate` datetime DEFAULT NULL,
  `productSlug` varchar(50) DEFAULT NULL,
  `isFlashSale` tinyint(1) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`productID`, `productName`, `productBrandID`, `productBrandName`, `productSubCategoryID`, `productSubCategoryName`, `productCategoryID`, `productCategoryName`, `productOriginalPrice`, `productDiscountPrice`, `productInfo`, `productBarcode`, `productInStock`, `productSoldQuantity`, `productImage`, `productSideImage1`, `productSideImage2`, `productSideImage3`, `productCreatedDate`, `productModifiedDate`, `productSlug`, `isFlashSale`, `isActive`, `created_at`, `updated_at`) VALUES
(20, 'sữa dê núi', NULL, 'Haseline', 16, 'sữa dê', 21, 'Sữa tắm', 350000, 300000, NULL, NULL, 10, NULL, 'upload/1784512961868348.svg', NULL, NULL, NULL, '2023-01-11 00:00:00', '2023-12-30 00:00:00', 'sữa-dê-núi', 1, 1, NULL, NULL),
(21, 'dầu gội ROMANO', NULL, 'ROMANO', 18, 'dầu gội đen giả', 22, 'dầu gội', 100000, 80000, NULL, NULL, 10, NULL, 'upload/1784514958683048.jpg', NULL, NULL, NULL, '2023-01-11 00:00:00', '2023-12-30 00:00:00', 'dầu-gội-romano', 1, 1, NULL, NULL),
(22, 'kem chống nắng đen da', NULL, 'Xmen', 17, 'kem chống nắng giả', 23, 'kem chống nắng', 150000, 80000, NULL, NULL, 11, NULL, 'upload/1784515008807846.png', NULL, NULL, NULL, '2023-01-11 00:00:00', '2023-12-30 00:00:00', 'kem-chống-nắng-đen-da', 1, 1, NULL, NULL),
(23, 'dầu gội XMEN', NULL, 'XMEN', 18, 'dầu gội đen giả', 22, 'dầu gội', 2333333, 2323232, NULL, NULL, 22, NULL, 'upload/1784515098785999.png', NULL, NULL, NULL, '2023-01-11 00:00:00', '2023-12-30 00:00:00', 'dầu-gội-xmen', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `provinces`
--

CREATE TABLE `provinces` (
  `provinceID` int(11) NOT NULL,
  `provinceName` varchar(200) NOT NULL,
  `provinceCode` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `purchase_histories`
--

CREATE TABLE `purchase_histories` (
  `historyID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `totalPrice` int(11) NOT NULL,
  `paymentMethod` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'Admin', '2023-11-10 01:28:34', '2023-11-10 01:28:34'),
(2, 'user', 'User', 'User', '2023-11-10 01:28:35', '2023-11-10 01:28:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_user`
--

CREATE TABLE `role_user` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(1, 1, 'App\\Models\\User'),
(2, 6, 'App\\Models\\User'),
(2, 7, 'App\\Models\\User'),
(2, 8, 'App\\Models\\User'),
(2, 9, 'App\\Models\\User');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shippings`
--

CREATE TABLE `shippings` (
  `shippingID` int(11) NOT NULL,
  `provinceID` int(11) NOT NULL,
  `shippingExpense` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subcategories`
--

CREATE TABLE `subcategories` (
  `subCategoryID` int(11) NOT NULL,
  `subCategoryName` varchar(200) DEFAULT NULL,
  `subCategoryImage` varchar(1000) DEFAULT NULL,
  `subCategoryDescription` varchar(1000) DEFAULT NULL,
  `productCount` int(11) DEFAULT 0,
  `subCategoryCreatedDate` datetime DEFAULT NULL,
  `subCategoryModifiedDate` datetime DEFAULT NULL,
  `categoryID` int(11) DEFAULT NULL,
  `categoryName` varchar(50) DEFAULT '',
  `subCategorySlug` varchar(50) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `subcategories`
--

INSERT INTO `subcategories` (`subCategoryID`, `subCategoryName`, `subCategoryImage`, `subCategoryDescription`, `productCount`, `subCategoryCreatedDate`, `subCategoryModifiedDate`, `categoryID`, `categoryName`, `subCategorySlug`, `isActive`, `created_at`, `updated_at`) VALUES
(16, 'sữa dê', NULL, NULL, 0, '2023-12-06 00:00:00', '2023-12-06 00:00:00', 21, 'Sữa tắm', 'sữa-dê', 1, NULL, NULL),
(17, 'kem chống nắng giả', NULL, NULL, 0, '2023-12-06 00:00:00', '2023-12-06 00:00:00', 23, 'kem chống nắng', 'kem-chống-nắng-giả', 1, NULL, NULL),
(18, 'dầu gội đen giả', NULL, NULL, 0, '2023-12-06 00:00:00', '2023-12-06 00:00:00', 22, 'dầu gội', 'dầu-gội-đen-giả', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT 0,
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar.png',
  `dark_mode` tinyint(1) NOT NULL DEFAULT 0,
  `messenger_color` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `active_status`, `avatar`, `dark_mode`, `messenger_color`) VALUES
(1, 'Huy Thục', 'nhta10.1107@gmail.com', NULL, '$2y$12$9CJADC43iDEOIu5S5TDQGePupIav.smFOY9ozP5N3hfupi0SZnxja', NULL, '2023-11-10 05:24:05', '2023-12-10 20:03:02', 1, 'avatar.png', 0, NULL),
(6, 'Như Quỳnh', 'nhuquynh1711@gmail.com', NULL, '$2y$12$uMI0rK/3KoU4DUHYsbPB7ey4iO5aHJWjFMBSVVdH99jQ8cxHVt6LW', NULL, '2023-11-15 02:07:12', '2023-11-15 02:07:12', 0, 'avatar.png', 0, NULL),
(7, 'Huy Thuc', 'pinguser@gmail.com', NULL, '$2y$12$e3vCQ9ugqg9Wkx9wxBR8YeEJLtV4x4evwUvoCeBq9Rm0KqGMMP.N6', NULL, '2023-11-20 09:44:57', '2023-11-20 09:44:57', 0, 'avatar.png', 0, NULL),
(8, 'HOÀNG MẠNH THẮNG', 'manhthang085213@gmail.com', NULL, '$2y$12$TgpeZeKzQN/Tq4hDMPBZMeaObcSNbMdyxFGekYNkHK0cOrif7X/p2', NULL, '2023-11-25 10:18:09', '2023-12-10 20:12:30', 0, 'avatar.png', 0, NULL),
(9, 'user', 'user@gmail.com', NULL, '$2y$12$J5pkLXtaXnFhXT72Q.PP6eXeMr1x0d1g49zYjNSKj5e0NhuJr1svy', NULL, '2023-12-06 21:38:34', '2023-12-06 21:38:34', 0, 'avatar.png', 0, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blogID`);

--
-- Chỉ mục cho bảng `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brandID`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`);

--
-- Chỉ mục cho bảng `ch_favorites`
--
ALTER TABLE `ch_favorites`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ch_messages`
--
ALTER TABLE `ch_messages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customer_infos`
--
ALTER TABLE `customer_infos`
  ADD PRIMARY KEY (`customerID`),
  ADD KEY `customerProvinceID` (`customerProvinceID`),
  ADD KEY `userID` (`userID`);

--
-- Chỉ mục cho bảng `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`discountID`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `discountID` (`discountID`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`orderDetailID`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `productID` (`productID`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Chỉ mục cho bảng `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  ADD KEY `permission_user_permission_id_foreign` (`permission_id`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `productSubCategoryID` (`productSubCategoryID`),
  ADD KEY `productBrandID` (`productBrandID`);

--
-- Chỉ mục cho bảng `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`provinceID`);

--
-- Chỉ mục cho bảng `purchase_histories`
--
ALTER TABLE `purchase_histories`
  ADD PRIMARY KEY (`historyID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `orderID` (`orderID`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Chỉ mục cho bảng `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`shippingID`),
  ADD KEY `provinceID` (`provinceID`);

--
-- Chỉ mục cho bảng `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`subCategoryID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blogID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `brand`
--
ALTER TABLE `brand`
  MODIFY `brandID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `customer_infos`
--
ALTER TABLE `customer_infos`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `discounts`
--
ALTER TABLE `discounts`
  MODIFY `discountID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `orderDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `provinces`
--
ALTER TABLE `provinces`
  MODIFY `provinceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `purchase_histories`
--
ALTER TABLE `purchase_histories`
  MODIFY `historyID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `shippings`
--
ALTER TABLE `shippings`
  MODIFY `shippingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `subCategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `customer_infos`
--
ALTER TABLE `customer_infos`
  ADD CONSTRAINT `customer_infos_ibfk_1` FOREIGN KEY (`customerProvinceID`) REFERENCES `provinces` (`provinceID`),
  ADD CONSTRAINT `customer_infos_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer_infos` (`customerID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`discountID`) REFERENCES `discounts` (`discountID`);

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`);

--
-- Các ràng buộc cho bảng `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`productSubCategoryID`) REFERENCES `subcategories` (`subCategoryID`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`productBrandID`) REFERENCES `brand` (`brandID`);

--
-- Các ràng buộc cho bảng `purchase_histories`
--
ALTER TABLE `purchase_histories`
  ADD CONSTRAINT `purchase_histories_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer_infos` (`customerID`),
  ADD CONSTRAINT `purchase_histories_ibfk_2` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`);

--
-- Các ràng buộc cho bảng `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `shippings`
--
ALTER TABLE `shippings`
  ADD CONSTRAINT `shippings_ibfk_1` FOREIGN KEY (`provinceID`) REFERENCES `provinces` (`provinceID`);

--
-- Các ràng buộc cho bảng `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `categories` (`categoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- create an trigger insert into table customer_infos after an user is created
CREATE TRIGGER `customer_infos_AFTER_INSERT` 
AFTER INSERT ON `users` 
FOR EACH ROW 
INSERT INTO customer_infos (userID, customerName, customerEmail, customerJoinDate, created_at, updated_at) VALUES (NEW.id, New.name, NEW.email, NEW.created_at, NEW.created_at, NEW.updated_at);