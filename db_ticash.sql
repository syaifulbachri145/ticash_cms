-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Bulan Mei 2025 pada 15.08
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ticash`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `accesses`
--

CREATE TABLE `accesses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `access_name` varchar(255) NOT NULL,
  `status` enum('active','non active') NOT NULL,
  `disable` enum('no','yes') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `accesses`
--

INSERT INTO `accesses` (`id`, `access_name`, `status`, `disable`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'active', 'no', NULL, NULL),
(2, 'Institution', 'active', 'no', NULL, NULL),
(3, 'Tenant', 'active', 'no', NULL, NULL),
(4, 'User', 'active', 'no', NULL, NULL),
(5, 'Student', 'active', 'no', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bills`
--

CREATE TABLE `bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institution_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` bigint(20) NOT NULL,
  `bank_transfer` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` enum('waiting','pending','success','rejected','failed') NOT NULL,
  `disable` enum('no','yes') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bills`
--

INSERT INTO `bills` (`id`, `institution_id`, `user_id`, `amount`, `bank_transfer`, `account_name`, `description`, `status`, `disable`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 4500, 'BNI', 'NILAM', 'invoice FEB', 'success', 'no', '2025-02-02 01:47:03', '2025-02-02 02:00:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('3c556ad9c713ac9ba6df9a369ca422da', 'i:1;', 1736685626),
('3c556ad9c713ac9ba6df9a369ca422da:timer', 'i:1736685626;', 1736685626),
('55a7e80937738a1091284d588d5b5e79', 'i:1;', 1743682715),
('55a7e80937738a1091284d588d5b5e79:timer', 'i:1743682715;', 1743682715),
('744d8212e1d9304127235e1ca3e795d7', 'i:1;', 1738391969),
('744d8212e1d9304127235e1ca3e795d7:timer', 'i:1738391969;', 1738391969),
('7ad4f7733a1b7b3ac6ac235af503966e', 'i:1;', 1738059686),
('7ad4f7733a1b7b3ac6ac235af503966e:timer', 'i:1738059686;', 1738059686),
('c525a5357e97fef8d3db25841c86da1a', 'i:1;', 1747569735),
('c525a5357e97fef8d3db25841c86da1a:timer', 'i:1747569735;', 1747569735),
('c6be2cf7c13d9a527ee2fe401bbae3c7', 'i:1;', 1736213500),
('c6be2cf7c13d9a527ee2fe401bbae3c7:timer', 'i:1736213500;', 1736213500),
('fd0543cf9303072ed9c90ddc402de7eb', 'i:1;', 1738059672),
('fd0543cf9303072ed9c90ddc402de7eb:timer', 'i:1738059672;', 1738059672),
('kantin@unilam.com|127.0.0.1', 'i:1;', 1738059672),
('kantin@unilam.com|127.0.0.1:timer', 'i:1738059672;', 1738059672),
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:111:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"posts.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:12:\"posts.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:10:\"posts.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:12:\"posts.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:20:\"postCategories.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:21:\"postCategories.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:19:\"postCategories.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:21:\"postCategories.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:15:\"campaigns.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:16:\"campaigns.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:14:\"campaigns.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:16:\"campaigns.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:16:\"categories.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:17:\"categories.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:15:\"categories.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:17:\"categories.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:13:\"sliders.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:14:\"sliders.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:14:\"sliders.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:11:\"roles.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:12:\"roles.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:10:\"roles.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:12:\"roles.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:17:\"permissions.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:11:\"users.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:4;i:1;i:5;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:12:\"users.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:10:\"users.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:4;i:1;i:5;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:12:\"users.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:28;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:14:\"degrees.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:4;i:1;i:5;}}i:29;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:12:\"degrees.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:4;i:1;i:5;}}i:30;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:14:\"degrees.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:4;i:1;i:5;}}i:31;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:18:\"institutions.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:32;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:19:\"institutions.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:33;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:17:\"institutions.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:34;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:19:\"institutions.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:35;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:14:\"students.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:4;i:1;i:5;}}i:36;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:15:\"students.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:4;i:1;i:5;}}i:37;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:15:\"students.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:4;i:1;i:5;}}i:38;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:15:\"merchants.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:4;i:1;i:5;}}i:39;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:16:\"merchants.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:40;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:14:\"merchants.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:4;i:1;i:5;}}i:41;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:16:\"merchants.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:4;i:1;i:5;}}i:42;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:11:\"bills.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:4;i:1;i:5;}}i:43;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:12:\"bills.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:4;i:1;i:5;}}i:44;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:10:\"bills.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:4;i:1;i:5;}}i:45;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:12:\"bills.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:46;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:14:\"balances.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:3;i:1;i:4;i:2;i:5;}}i:47;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:15:\"balances.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:48;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:13:\"balances.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:49;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:15:\"balances.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:50;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:12:\"claims.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:4;i:1;i:5;}}i:51;a:4:{s:1:\"a\";i:53;s:1:\"b\";s:13:\"claims.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:4;i:1;i:5;}}i:52;a:4:{s:1:\"a\";i:54;s:1:\"b\";s:11:\"claims.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:53;a:4:{s:1:\"a\";i:55;s:1:\"b\";s:13:\"claims.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:54;a:4:{s:1:\"a\";i:56;s:1:\"b\";s:18:\"transactions.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:4;i:1;i:5;}}i:55;a:4:{s:1:\"a\";i:57;s:1:\"b\";s:19:\"transactions.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:56;a:4:{s:1:\"a\";i:58;s:1:\"b\";s:17:\"transactions.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:57;a:4:{s:1:\"a\";i:59;s:1:\"b\";s:19:\"transactions.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:58;a:4:{s:1:\"a\";i:60;s:1:\"b\";s:27:\"transactionCategories.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:59;a:4:{s:1:\"a\";i:61;s:1:\"b\";s:28:\"transactionCategories.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:60;a:4:{s:1:\"a\";i:62;s:1:\"b\";s:26:\"transactionCategories.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:61;a:4:{s:1:\"a\";i:63;s:1:\"b\";s:28:\"transactionCategories.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:62;a:4:{s:1:\"a\";i:64;s:1:\"b\";s:14:\"payments.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:4;i:1;i:5;}}i:63;a:4:{s:1:\"a\";i:65;s:1:\"b\";s:15:\"payments.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:4;i:1;i:5;}}i:64;a:4:{s:1:\"a\";i:66;s:1:\"b\";s:13:\"payments.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:65;a:4:{s:1:\"a\";i:67;s:1:\"b\";s:15:\"payments.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:66;a:4:{s:1:\"a\";i:68;s:1:\"b\";s:20:\"paymentDetails.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:4;i:1;i:5;}}i:67;a:4:{s:1:\"a\";i:69;s:1:\"b\";s:21:\"paymentDetails.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:4;i:1;i:5;}}i:68;a:4:{s:1:\"a\";i:70;s:1:\"b\";s:19:\"paymentDetails.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:69;a:4:{s:1:\"a\";i:71;s:1:\"b\";s:21:\"paymentDetails.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:70;a:4:{s:1:\"a\";i:72;s:1:\"b\";s:13:\"savings.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:3;i:1;i:4;i:2;i:5;i:3;i:6;}}i:71;a:4:{s:1:\"a\";i:73;s:1:\"b\";s:14:\"savings.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:3;i:1;i:4;i:2;i:6;}}i:72;a:4:{s:1:\"a\";i:74;s:1:\"b\";s:12:\"savings.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:3;i:1;i:4;}}i:73;a:4:{s:1:\"a\";i:75;s:1:\"b\";s:14:\"savings.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:3;i:1;i:4;}}i:74;a:4:{s:1:\"a\";i:76;s:1:\"b\";s:13:\"gethers.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:3;i:1;i:4;i:2;i:5;i:3;i:6;}}i:75;a:4:{s:1:\"a\";i:77;s:1:\"b\";s:14:\"gethers.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:3;i:1;i:4;i:2;i:6;}}i:76;a:4:{s:1:\"a\";i:78;s:1:\"b\";s:12:\"gethers.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:3;i:1;i:4;}}i:77;a:4:{s:1:\"a\";i:79;s:1:\"b\";s:14:\"gethers.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:3;i:1;i:4;}}i:78;a:4:{s:1:\"a\";i:80;s:1:\"b\";s:19:\"getherMembers.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:3;i:1;i:4;i:2;i:5;}}i:79;a:4:{s:1:\"a\";i:81;s:1:\"b\";s:20:\"getherMembers.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:3;i:1;i:4;}}i:80;a:4:{s:1:\"a\";i:82;s:1:\"b\";s:18:\"getherMembers.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:3;i:1;i:4;}}i:81;a:4:{s:1:\"a\";i:83;s:1:\"b\";s:20:\"getherMembers.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:3;i:1;i:4;}}i:82;a:4:{s:1:\"a\";i:84;s:1:\"b\";s:13:\"degrees.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:83;a:4:{s:1:\"a\";i:85;s:1:\"b\";s:13:\"classes.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:84;a:4:{s:1:\"a\";i:86;s:1:\"b\";s:13:\"students.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:85;a:4:{s:1:\"a\";i:87;s:1:\"b\";s:17:\"withdrawals.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:4;i:1;i:6;}}i:86;a:4:{s:1:\"a\";i:88;s:1:\"b\";s:18:\"withdrawals.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:4;i:1;i:6;}}i:87;a:4:{s:1:\"a\";i:89;s:1:\"b\";s:16:\"withdrawals.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:88;a:4:{s:1:\"a\";i:90;s:1:\"b\";s:18:\"withdrawals.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:89;a:4:{s:1:\"a\";i:91;s:1:\"b\";s:12:\"topups.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:3;i:1;i:4;}}i:90;a:4:{s:1:\"a\";i:92;s:1:\"b\";s:13:\"topups.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:3;i:1;i:4;}}i:91;a:4:{s:1:\"a\";i:93;s:1:\"b\";s:11:\"topups.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:92;a:4:{s:1:\"a\";i:94;s:1:\"b\";s:13:\"topups.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:93;a:4:{s:1:\"a\";i:95;s:1:\"b\";s:15:\"histories.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:3;i:1;i:4;}}i:94;a:4:{s:1:\"a\";i:96;s:1:\"b\";s:14:\"histories.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:95;a:4:{s:1:\"a\";i:97;s:1:\"b\";s:11:\"shops.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:4;i:1;i:6;}}i:96;a:4:{s:1:\"a\";i:98;s:1:\"b\";s:10:\"shops.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:97;a:4:{s:1:\"a\";i:99;s:1:\"b\";s:12:\"shops.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:4;i:1;i:6;}}i:98;a:3:{s:1:\"a\";i:100;s:1:\"b\";s:15:\"transfers.index\";s:1:\"c\";s:3:\"web\";}i:99;a:3:{s:1:\"a\";i:101;s:1:\"b\";s:16:\"transfers.create\";s:1:\"c\";s:3:\"web\";}i:100;a:3:{s:1:\"a\";i:102;s:1:\"b\";s:14:\"transfers.edit\";s:1:\"c\";s:3:\"web\";}i:101;a:4:{s:1:\"a\";i:103;s:1:\"b\";s:23:\"paymentCategories.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:102;a:4:{s:1:\"a\";i:104;s:1:\"b\";s:24:\"paymentCategories.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:103;a:4:{s:1:\"a\";i:105;s:1:\"b\";s:22:\"paymentCategories.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:104;a:4:{s:1:\"a\";i:106;s:1:\"b\";s:24:\"paymentCategories.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:105;a:4:{s:1:\"a\";i:107;s:1:\"b\";s:24:\"paymentCategories.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:106;a:4:{s:1:\"a\";i:108;s:1:\"b\";s:13:\"reedems.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:107;a:4:{s:1:\"a\";i:109;s:1:\"b\";s:14:\"reedems.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:108;a:4:{s:1:\"a\";i:110;s:1:\"b\";s:12:\"reedems.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:109;a:4:{s:1:\"a\";i:111;s:1:\"b\";s:14:\"reedems.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:110;a:4:{s:1:\"a\";i:112;s:1:\"b\";s:14:\"reedems.detete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}}s:5:\"roles\";a:4:{i:0;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:13:\"Administrator\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:5;s:1:\"b\";s:11:\"Institution\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:4:\"User\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:6;s:1:\"b\";s:8:\"Merchant\";s:1:\"c\";s:3:\"web\";}}}', 1747633327);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `campaigns`
--

CREATE TABLE `campaigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `target_donation` bigint(20) NOT NULL,
  `max_date` date NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `claims`
--

CREATE TABLE `claims` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institution_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(255) NOT NULL,
  `user_approved` varchar(255) DEFAULT NULL,
  `amount` bigint(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `request_date` date NOT NULL,
  `approval_date` date DEFAULT NULL,
  `status` enum('waiting','cenceled','rejected','approved','pending') NOT NULL,
  `disable` enum('no','yes') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `claims`
--

INSERT INTO `claims` (`id`, `institution_id`, `user_id`, `user_approved`, `amount`, `description`, `request_date`, `approval_date`, `status`, `disable`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Administrator', 600000, 'belanja ATK', '2025-02-01', '2025-02-01', 'approved', 'no', '2025-02-01 11:01:58', '2025-02-01 12:39:15'),
(2, 1, 1, 'Administrator', 200000, 'kas', '2025-02-01', '2025-02-01', 'approved', 'no', '2025-02-01 12:42:36', '2025-02-01 12:42:41'),
(3, 1, 1, 'Administrator', 50000, 'infak', '2025-02-01', '2025-02-01', 'approved', 'no', '2025-02-01 12:43:46', '2025-02-01 12:43:53'),
(4, 1, 1, 'Administrator', 50000, 'infak', '2025-02-01', '2025-02-01', 'approved', 'no', '2025-02-01 12:45:33', '2025-02-01 12:45:40'),
(5, 1, 1, 'Administrator', 10000, 'kas', '2025-02-01', '2025-02-01', 'approved', 'no', '2025-02-01 12:48:02', '2025-02-01 12:48:07'),
(6, 1, 1, 'Administrator', 10000, 'kas', '2025-02-01', '2025-02-01', 'approved', 'no', '2025-02-01 12:50:17', '2025-02-01 12:50:22'),
(7, 1, 1, 'Administrator', 10000, 'kas', '2025-02-01', '2025-02-01', 'approved', 'no', '2025-02-01 12:55:36', '2025-02-01 12:55:41'),
(8, 1, 1, 'Administrator', 10000, 'tes', '2025-02-01', '2025-02-01', 'approved', 'no', '2025-02-01 12:56:42', '2025-02-01 12:56:47'),
(9, 1, 1, 'Administrator', 10000, 'infak', '2025-02-02', '2025-02-02', 'approved', 'no', '2025-02-01 23:15:24', '2025-02-02 00:40:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `clas`
--

CREATE TABLE `clas` (
  `institution_id` bigint(20) UNSIGNED NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `status` enum('active','non active') NOT NULL,
  `disable` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `degrees`
--

CREATE TABLE `degrees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institution_id` bigint(20) UNSIGNED NOT NULL,
  `degree_name` varchar(255) NOT NULL,
  `status` enum('active','non active') NOT NULL,
  `disable` enum('no','yes') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `degrees`
--

INSERT INTO `degrees` (`id`, `institution_id`, `degree_name`, `status`, `disable`, `created_at`, `updated_at`) VALUES
(1, 1, 'TI Semester 4', 'non active', 'no', '2025-01-18 04:56:46', '2025-01-18 06:01:44'),
(2, 1, 'TI Semester 1', 'active', 'no', '2025-01-18 04:57:00', '2025-01-30 00:46:39'),
(4, 1, 'SI Semester 1', 'active', 'no', '2025-01-30 00:57:25', '2025-01-30 00:57:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `donations`
--

CREATE TABLE `donations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `campaign_id` int(10) UNSIGNED NOT NULL,
  `donatur_id` int(10) UNSIGNED NOT NULL,
  `amount` bigint(20) NOT NULL,
  `pray` text DEFAULT NULL,
  `snap_token` varchar(255) DEFAULT NULL,
  `status` enum('pending','success','expired','failed') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `donaturs`
--

CREATE TABLE `donaturs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `gethers`
--

CREATE TABLE `gethers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institution_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `balance` bigint(20) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `goal` varchar(255) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `status` enum('active','non active') NOT NULL,
  `disable` enum('no','yes') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `gethers`
--

INSERT INTO `gethers` (`id`, `institution_id`, `user_id`, `balance`, `description`, `goal`, `deadline`, `status`, `disable`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 40000, 'Uang Kas Kelas 6', 'jalan jalan', '2025-06-30', 'active', 'no', '2025-01-28 22:30:48', '2025-04-20 01:26:21'),
(3, 1, 1, 100000, 'Tabungan bersama', 'wisuda', '2025-04-30', 'active', 'no', '2025-01-29 22:03:11', '2025-04-20 01:27:47'),
(5, 1, 5, 30000, 'Tabungan Tour', 'Tabungan Tour', '2025-08-30', 'active', 'no', '2025-02-23 12:08:54', '2025-04-06 07:37:03'),
(6, 1, 5, 12000, 'Tabungan Kelas 5', 'gathering', '2025-04-17', 'active', 'no', '2025-04-06 03:51:52', '2025-04-13 13:08:53'),
(7, 1, 5, 5000, 'Tabungan Kelas 6', 'Wisuda', '2025-05-31', 'active', 'no', '2025-04-13 14:51:31', '2025-04-20 01:59:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gether_members`
--

CREATE TABLE `gether_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institution_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `gether_id` bigint(20) UNSIGNED NOT NULL,
  `amount` bigint(20) NOT NULL,
  `status` enum('active','non active') NOT NULL,
  `disable` enum('no','yes') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `gether_members`
--

INSERT INTO `gether_members` (`id`, `institution_id`, `user_id`, `gether_id`, `amount`, `status`, `disable`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 1, 0, 'active', 'no', '2025-01-29 00:21:29', '2025-01-29 02:22:30'),
(2, 1, 5, 1, 30000, 'active', 'no', '2025-01-29 00:23:44', '2025-04-20 01:26:21'),
(3, 1, 1, 2, 0, 'active', 'no', '2025-01-29 01:51:25', '2025-01-29 02:26:05'),
(4, 1, 6, 2, 0, 'active', 'no', '2025-01-29 01:51:31', '2025-01-29 02:26:05'),
(5, 1, 4, 2, 0, 'active', 'no', '2025-01-29 01:51:36', '2025-01-29 02:26:05'),
(6, 1, 1, 1, 0, 'active', 'no', '2025-01-29 19:03:42', '2025-01-29 19:03:42'),
(7, 1, 4, 1, 0, 'active', 'no', '2025-01-29 21:57:45', '2025-01-29 21:57:45'),
(8, 1, 3, 1, 0, 'active', 'no', '2025-01-29 22:00:17', '2025-01-29 22:00:17'),
(9, 1, 3, 3, 0, 'active', 'no', '2025-01-30 00:27:14', '2025-01-30 00:27:14'),
(10, 1, 5, 3, 10000, 'active', 'no', '2025-01-30 00:38:21', '2025-04-20 01:27:47'),
(11, 1, 6, 3, 0, 'active', 'no', '2025-02-18 10:44:08', '2025-02-18 10:44:08'),
(12, 1, 6, 4, 0, 'active', 'no', '2025-02-23 11:05:51', '2025-02-23 11:05:51'),
(13, 1, 1, 4, 25000, 'active', 'no', '2025-02-23 11:07:24', '2025-02-23 11:29:15'),
(14, 1, 7, 3, 0, 'active', 'no', '2025-04-06 07:11:02', '2025-04-06 07:11:02'),
(15, 1, 7, 1, 0, 'active', 'no', '2025-04-06 07:11:22', '2025-04-06 07:11:22'),
(16, 1, 6, 6, 0, 'active', 'no', '2025-04-13 13:18:57', '2025-04-13 13:18:57'),
(17, 1, 7, 6, 0, 'active', 'no', '2025-04-13 13:30:27', '2025-04-13 13:30:27'),
(18, 1, 2, 6, 0, 'active', 'no', '2025-04-13 13:31:20', '2025-04-13 13:31:20'),
(19, 1, 3, 6, 0, 'active', 'no', '2025-04-13 13:36:48', '2025-04-13 13:36:48'),
(20, 1, 8, 6, 0, 'active', 'no', '2025-04-13 13:37:28', '2025-04-13 13:37:28'),
(21, 1, 1, 6, 0, 'active', 'no', '2025-04-13 13:41:01', '2025-04-13 13:41:01'),
(22, 1, 4, 6, 0, 'active', 'no', '2025-04-13 14:05:48', '2025-04-13 14:05:48'),
(23, 1, 1, 5, 0, 'active', 'no', '2025-04-13 14:47:18', '2025-04-13 14:47:18'),
(24, 1, 6, 5, 0, 'active', 'no', '2025-04-13 14:47:29', '2025-04-13 14:47:29'),
(25, 1, 7, 5, 0, 'active', 'no', '2025-04-13 14:47:58', '2025-04-13 14:47:58'),
(26, 1, 4, 5, 0, 'active', 'no', '2025-04-13 14:48:39', '2025-04-13 14:48:39'),
(27, 1, 3, 5, 0, 'active', 'no', '2025-04-13 14:49:27', '2025-04-13 14:49:27'),
(28, 1, 8, 5, 0, 'active', 'no', '2025-04-13 14:50:37', '2025-04-13 14:50:37'),
(29, 1, 1, 7, 0, 'active', 'no', '2025-04-13 14:51:53', '2025-04-13 14:51:53'),
(30, 1, 6, 7, 5000, 'active', 'no', '2025-04-13 14:52:07', '2025-04-20 01:59:30'),
(31, 1, 7, 7, 0, 'active', 'no', '2025-04-13 14:52:27', '2025-04-13 14:52:27'),
(32, 1, 4, 7, 0, 'active', 'no', '2025-04-13 14:52:49', '2025-04-13 14:52:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `institutions`
--

CREATE TABLE `institutions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institution_code` bigint(20) NOT NULL,
  `institution_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `balance` bigint(20) NOT NULL,
  `admin_fee` bigint(20) NOT NULL,
  `shared_fee` bigint(20) NOT NULL,
  `profit` bigint(20) DEFAULT NULL,
  `invoice` bigint(20) NOT NULL,
  `bank_transfer` varchar(255) DEFAULT NULL,
  `account_number` bigint(20) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `status` enum('active','non active') NOT NULL,
  `disable` enum('no','yes') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `institutions`
--

INSERT INTO `institutions` (`id`, `institution_code`, `institution_name`, `address`, `contact`, `email`, `image`, `balance`, `admin_fee`, `shared_fee`, `profit`, `invoice`, `bank_transfer`, `account_number`, `account_name`, `status`, `disable`, `created_at`, `updated_at`) VALUES
(1, 112025, 'UNILAM', 'PERUM GRAND BATAVIA CLUSTER GROOVE BLOK 2 NO.03', '0812334534', 'unilam@gmail.com', 'wsIJzAHz57LZRUV7PD62A3nIBDeOHe757PDuyWpB.png', 15825000, 3000, 1000, 4000, 6000, 'BNI', 1056253423, 'UNIVERSITAS LATANSA MASHIRO', 'active', 'no', NULL, '2025-05-18 12:02:48'),
(4, 212025, 'Almadani', 'PERUM GRAND BATAVIA CLUSTER GROOVE BLOK 2 NO.03', '081285559758', 'madani@ticash.id', 'sKi2kgCFKZKJP21MNZqUeEJnf3yjlwLksSOXKv42.png', 0, 2500, 2000, 0, 0, NULL, NULL, NULL, 'active', 'no', '2025-01-19 00:22:43', '2025-01-19 00:22:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `merchants`
--

CREATE TABLE `merchants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institution_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `merchant_name` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `no_ktp` bigint(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` enum('active','non active') NOT NULL,
  `disable` enum('no','yes') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `merchants`
--

INSERT INTO `merchants` (`id`, `institution_id`, `user_id`, `merchant_name`, `banner`, `no_ktp`, `description`, `status`, `disable`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'Bakso malang unilam', 'sqVBuggNIQ8Pt1ah1sst0RtL6aTJbV2yyRo8OBVf.jpg', 1234, 'tes', 'active', 'no', '2025-01-17 21:50:56', '2025-04-05 18:13:21'),
(2, 1, 7, 'Batagor Bandung', 'e5SYPL7pyKLZLjzT5dk8xEUHiweUHGdht0LH3Hak.jpg', 232313232323, 'Batagor Bandung', 'active', 'no', '2025-01-30 02:17:01', '2025-04-05 18:11:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_07_000141_create_categories_table', 1),
(5, '2025_01_07_000242_create_campaigns_table', 1),
(6, '2025_01_07_000324_create_donaturs_table', 1),
(7, '2025_01_07_000506_create_donations_table', 1),
(8, '2025_01_07_000549_create_sliders_table', 1),
(9, '2025_01_07_003725_create_permission_tables', 1),
(10, '2025_01_07_005731_add_two_factor_columns_to_users_table', 2),
(11, '2025_01_09_004104_create_posts_table', 3),
(12, '2025_01_09_004134_create_post_categories_table', 3),
(13, '2025_01_09_005020_create_tags_table', 3),
(14, '2025_01_09_005231_create_videos_table', 3),
(15, '2025_01_10_004257_create_accesses_table', 4),
(16, '2025_01_10_105818_create_degrees_table', 5),
(17, '2025_01_10_105838_create_institutions_table', 5),
(18, '2025_01_10_105850_create_students_table', 5),
(19, '2025_01_10_105900_create_merchants_table', 5),
(20, '2025_01_12_021512_create_finances_table', 6),
(21, '2025_01_12_021907_create_balances_table', 6),
(22, '2025_01_12_022024_create_withdrawals_table', 6),
(23, '2025_01_12_022134_create_transactions_table', 6),
(24, '2025_01_12_022446_create_transaction_categories_table', 6),
(25, '2025_01_12_022907_create_payments_table', 6),
(26, '2025_01_12_022916_create_payment_details_table', 6),
(27, '2025_01_12_023556_create_savings_table', 6),
(28, '2025_01_12_023846_create_gethers_table', 6),
(29, '2025_01_12_023924_create_gether_members_table', 6),
(30, '2025_01_18_093438_create_clas_table', 7),
(31, '2025_01_20_025123_create_bills_table', 8),
(32, '2025_01_20_030257_create_claims_table', 9),
(33, '2025_02_01_082109_create_payment_categories_table', 10),
(34, '2025_02_01_202647_create_reedems_table', 11),
(35, '2025_05_02_104049_create_transfers_table', 12),
(36, '2025_05_15_132931_create_sharings_table', 13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6),
(4, 'App\\Models\\User', 1),
(5, 'App\\Models\\User', 3),
(6, 'App\\Models\\User', 4),
(6, 'App\\Models\\User', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$12$jnpMLwBeXiy3dy8clm/NLuhZ.2Q.os6A.QFRB99DApVmPPnXGLUh.', '2025-01-06 18:42:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institution_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_category_id` bigint(20) UNSIGNED NOT NULL,
  `amount` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `deadline` date NOT NULL,
  `status` enum('active','non active') NOT NULL,
  `disable` enum('no','yes') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `payments`
--

INSERT INTO `payments` (`id`, `institution_id`, `user_id`, `payment_category_id`, `amount`, `title`, `description`, `deadline`, `status`, `disable`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, 1500000, 'Buku Semester 3', 'Paket Buku Pembelajaran', '2025-02-28', 'active', 'no', '2025-01-31 03:26:10', '2025-02-01 05:11:56'),
(2, 1, 1, 1, 1500000, 'SPP Bulanan', 'SPP Bulanan Tahun ajaran 2025', '2025-03-31', 'active', 'no', '2025-01-31 03:27:12', '2025-02-01 04:59:27'),
(3, 1, 1, 2, 5000000, 'Uang Bangunan', 'Uang Bangunan Siswa Baru 2025', '2025-02-28', 'active', 'no', '2025-02-01 01:54:42', '2025-02-01 01:54:42'),
(4, 1, 1, 4, 10000, 'Iuran Pembangunan Masjid', 'Iuran Pembangunan Masjid', '2025-05-31', 'active', 'no', '2025-02-23 08:08:34', '2025-02-23 08:08:34'),
(5, 1, 1, 2, 15000000, 'Pendaftaran Masuk', 'Pendaftaran Masuk Awal', '2025-04-30', 'active', 'no', '2025-04-03 12:13:23', '2025-04-03 12:13:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_categories`
--

CREATE TABLE `payment_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institution_id` bigint(20) UNSIGNED NOT NULL,
  `payment_category_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` enum('active','non active') NOT NULL,
  `disable` enum('no','yes') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `payment_categories`
--

INSERT INTO `payment_categories` (`id`, `institution_id`, `payment_category_name`, `description`, `status`, `disable`, `created_at`, `updated_at`) VALUES
(1, 1, 'SPP Bulanan', 'SPP Bulanan 2025', 'active', 'no', NULL, NULL),
(2, 1, 'Uang Bangunan', 'Biaya masuk awal ', 'active', 'no', NULL, NULL),
(3, 1, 'Buku', 'Buku Pelajaran', 'active', 'no', NULL, NULL),
(4, 1, 'Infak', 'Infak siswa', 'active', 'no', '2025-02-01 07:33:58', '2025-02-01 07:42:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_details`
--

CREATE TABLE `payment_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institution_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `degree_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` bigint(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` enum('active','non active','success','failed','cancel') NOT NULL,
  `disable` enum('no','yes') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `payment_details`
--

INSERT INTO `payment_details` (`id`, `institution_id`, `user_id`, `payment_id`, `degree_id`, `amount`, `description`, `status`, `disable`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 2, 1, 1500000, 'SPP Bulanan Tahun ajaran 2025', 'success', 'no', '2025-02-01 06:31:57', '2025-02-01 06:31:57'),
(2, 1, 5, 4, 2, 10000, 'payment by API', 'success', 'no', '2025-02-23 08:47:31', '2025-02-23 08:47:31'),
(3, 1, 5, 4, 2, 10000, 'Iuran Pembangunan Masjid', 'success', 'no', '2025-04-03 12:12:02', '2025-04-03 12:12:02'),
(4, 1, 5, 5, 2, 15000000, 'Pendaftaran Masuk Awal', 'success', 'no', '2025-04-03 12:13:39', '2025-04-03 12:13:39'),
(5, 1, 5, 4, 2, 10000, 'Iuran Pembangunan Masjid', 'success', 'no', '2025-04-20 02:33:06', '2025-04-20 02:33:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'posts.index', 'web', '2025-01-06 17:42:35', '2025-01-06 17:42:35'),
(2, 'posts.create', 'web', '2025-01-06 17:42:35', '2025-01-06 17:42:35'),
(3, 'posts.edit', 'web', '2025-01-06 17:42:35', '2025-01-06 17:42:35'),
(4, 'posts.delete', 'web', '2025-01-06 17:42:35', '2025-01-06 17:42:35'),
(5, 'postCategories.index', 'web', '2025-01-06 17:42:35', '2025-01-06 17:42:35'),
(6, 'postCategories.create', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(7, 'postCategories.edit', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(8, 'postCategories.delete', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(9, 'campaigns.index', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(10, 'campaigns.create', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(11, 'campaigns.edit', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(12, 'campaigns.delete', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(13, 'categories.index', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(14, 'categories.create', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(15, 'categories.edit', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(16, 'categories.delete', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(17, 'sliders.index', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(18, 'sliders.create', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(19, 'sliders.delete', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(20, 'roles.index', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(21, 'roles.create', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(22, 'roles.edit', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(23, 'roles.delete', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(24, 'permissions.index', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(25, 'users.index', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(26, 'users.create', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(27, 'users.edit', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(28, 'users.delete', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(30, 'degrees.create', 'web', '2025-01-06 17:42:36', '2025-01-18 01:50:49'),
(31, 'degrees.edit', 'web', '2025-01-06 17:42:36', '2025-01-18 01:51:10'),
(32, 'degrees.delete', 'web', '2025-01-06 17:42:36', '2025-01-18 01:53:07'),
(33, 'institutions.index', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(34, 'institutions.create', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(35, 'institutions.edit', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(36, 'institutions.delete', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(37, 'students.index', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(38, 'students.create', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(39, 'students.delete', 'web', '2025-01-06 17:42:36', '2025-01-06 17:42:36'),
(40, 'merchants.index', 'web', '2025-01-06 17:42:37', '2025-01-06 17:42:37'),
(41, 'merchants.create', 'web', '2025-01-06 17:42:37', '2025-01-06 17:42:37'),
(42, 'merchants.edit', 'web', '2025-01-06 17:42:37', '2025-01-06 17:42:37'),
(43, 'merchants.delete', 'web', '2025-01-06 17:42:37', '2025-01-06 17:42:37'),
(44, 'bills.index', 'web', '2025-01-06 17:42:37', '2025-01-19 19:58:20'),
(45, 'bills.create', 'web', '2025-01-06 17:42:37', '2025-01-19 19:58:43'),
(46, 'bills.edit', 'web', '2025-01-06 17:42:37', '2025-01-19 19:59:00'),
(47, 'bills.delete', 'web', '2025-01-06 17:42:37', '2025-01-19 19:59:17'),
(48, 'balances.index', 'web', '2025-01-06 17:42:37', '2025-01-06 17:42:37'),
(49, 'balances.create', 'web', '2025-01-06 17:42:37', '2025-01-06 17:42:37'),
(50, 'balances.edit', 'web', '2025-01-06 17:42:37', '2025-01-06 17:42:37'),
(51, 'balances.delete', 'web', '2025-01-06 17:42:37', '2025-01-06 17:42:37'),
(52, 'claims.index', 'web', '2025-01-06 17:42:37', '2025-01-19 20:09:00'),
(53, 'claims.create', 'web', '2025-01-06 17:42:37', '2025-01-19 20:09:16'),
(54, 'claims.edit', 'web', '2025-01-06 17:42:37', '2025-01-19 20:09:34'),
(55, 'claims.delete', 'web', '2025-01-06 17:42:37', '2025-01-19 20:09:51'),
(56, 'transactions.index', 'web', '2025-01-06 17:42:37', '2025-01-06 17:42:37'),
(57, 'transactions.create', 'web', '2025-01-06 17:42:37', '2025-01-06 17:42:37'),
(58, 'transactions.edit', 'web', '2025-01-06 17:42:37', '2025-01-06 17:42:37'),
(59, 'transactions.delete', 'web', '2025-01-06 17:42:37', '2025-01-06 17:42:37'),
(60, 'transactionCategories.index', 'web', '2025-01-06 17:42:37', '2025-01-06 17:42:37'),
(61, 'transactionCategories.create', 'web', '2025-01-06 17:42:37', '2025-01-06 17:42:37'),
(62, 'transactionCategories.edit', 'web', '2025-01-06 17:42:37', '2025-01-06 17:42:37'),
(63, 'transactionCategories.delete', 'web', '2025-01-06 17:42:37', '2025-01-06 17:42:37'),
(64, 'payments.index', 'web', '2025-01-06 17:42:37', '2025-01-06 17:42:37'),
(65, 'payments.create', 'web', '2025-01-06 17:42:37', '2025-01-06 17:42:37'),
(66, 'payments.edit', 'web', '2025-01-06 17:42:37', '2025-01-06 17:42:37'),
(67, 'payments.delete', 'web', '2025-01-06 17:42:37', '2025-01-06 17:42:37'),
(68, 'paymentDetails.index', 'web', '2025-01-06 17:42:37', '2025-01-06 17:42:37'),
(69, 'paymentDetails.create', 'web', '2025-01-06 17:42:37', '2025-01-06 17:42:37'),
(70, 'paymentDetails.edit', 'web', '2025-01-06 17:42:37', '2025-01-06 17:42:37'),
(71, 'paymentDetails.delete', 'web', '2025-01-06 17:42:38', '2025-01-06 17:42:38'),
(72, 'savings.index', 'web', '2025-01-06 17:42:38', '2025-01-06 17:42:38'),
(73, 'savings.create', 'web', '2025-01-06 17:42:38', '2025-01-06 17:42:38'),
(74, 'savings.edit', 'web', '2025-01-06 17:42:38', '2025-01-06 17:42:38'),
(75, 'savings.delete', 'web', '2025-01-06 17:42:38', '2025-01-06 17:42:38'),
(76, 'gethers.index', 'web', '2025-01-06 17:42:38', '2025-01-06 17:42:38'),
(77, 'gethers.create', 'web', '2025-01-06 17:42:38', '2025-01-06 17:42:38'),
(78, 'gethers.edit', 'web', '2025-01-06 17:42:38', '2025-01-06 17:42:38'),
(79, 'gethers.delete', 'web', '2025-01-06 17:42:38', '2025-01-06 17:42:38'),
(80, 'getherMembers.index', 'web', '2025-01-06 17:42:38', '2025-01-06 17:42:38'),
(81, 'getherMembers.create', 'web', '2025-01-06 17:42:38', '2025-01-06 17:42:38'),
(82, 'getherMembers.edit', 'web', '2025-01-06 17:42:38', '2025-01-06 17:42:38'),
(83, 'getherMembers.delete', 'web', '2025-01-06 17:42:38', '2025-01-06 17:42:38'),
(84, 'degrees.index', 'web', '2025-01-18 02:21:08', '2025-01-18 02:21:08'),
(85, 'classes.index', 'web', '2025-01-18 02:24:35', '2025-01-18 02:24:35'),
(86, 'students.edit', 'web', '2025-01-19 01:01:23', '2025-01-19 01:01:23'),
(87, 'withdrawals.index', 'web', '2025-01-25 20:55:35', '2025-01-26 07:34:53'),
(88, 'withdrawals.create', 'web', '2025-01-25 20:55:49', '2025-01-26 07:34:45'),
(89, 'withdrawals.edit', 'web', '2025-01-25 20:56:04', '2025-01-26 07:34:36'),
(90, 'withdrawals.delete', 'web', '2025-01-25 20:56:20', '2025-01-26 07:34:29'),
(91, 'topups.index', 'web', '2025-01-26 07:35:09', '2025-01-26 07:35:09'),
(92, 'topups.create', 'web', '2025-01-26 07:35:22', '2025-01-26 07:35:22'),
(93, 'topups.edit', 'web', '2025-01-26 07:35:35', '2025-01-26 07:35:35'),
(94, 'topups.delete', 'web', '2025-01-26 07:35:49', '2025-01-26 07:35:49'),
(95, 'histories.index', 'web', '2025-01-26 17:39:00', '2025-01-26 17:39:00'),
(96, 'histories.edit', 'web', '2025-01-26 17:48:56', '2025-01-26 17:48:56'),
(97, 'shops.index', 'web', '2025-01-28 02:00:54', '2025-01-28 02:00:54'),
(98, 'shops.edit', 'web', '2025-01-28 02:01:04', '2025-01-28 02:01:14'),
(99, 'shops.create', 'web', '2025-01-28 02:03:40', '2025-01-28 02:03:40'),
(100, 'transfers.index', 'web', '2025-01-30 17:03:14', '2025-01-30 17:03:14'),
(101, 'transfers.create', 'web', '2025-01-30 17:03:28', '2025-01-30 17:03:28'),
(102, 'transfers.edit', 'web', '2025-01-30 17:03:44', '2025-01-30 17:03:44'),
(103, 'paymentCategories.index', 'web', '2025-02-01 07:14:15', '2025-02-01 07:14:15'),
(104, 'paymentCategories.create', 'web', '2025-02-01 07:14:24', '2025-02-01 07:14:24'),
(105, 'paymentCategories.edit', 'web', '2025-02-01 07:14:36', '2025-02-01 07:14:36'),
(106, 'paymentCategories.update', 'web', '2025-02-01 07:14:49', '2025-02-01 07:14:49'),
(107, 'paymentCategories.delete', 'web', '2025-02-01 07:14:58', '2025-02-01 07:14:58'),
(108, 'reedems.index', 'web', '2025-02-01 22:29:08', '2025-02-01 22:29:08'),
(109, 'reedems.create', 'web', '2025-02-01 22:29:19', '2025-02-01 22:29:19'),
(110, 'reedems.edit', 'web', '2025-02-01 22:29:30', '2025-02-01 22:29:30'),
(111, 'reedems.update', 'web', '2025-02-01 22:29:40', '2025-02-01 22:29:40'),
(112, 'reedems.detete', 'web', '2025-02-01 22:29:58', '2025-02-01 22:29:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `post_categories`
--

CREATE TABLE `post_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `post_tag`
--

CREATE TABLE `post_tag` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `reedems`
--

CREATE TABLE `reedems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institution_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `status` enum('success','failed') NOT NULL,
  `disable` enum('no','yes') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `reedems`
--

INSERT INTO `reedems` (`id`, `institution_id`, `user_id`, `amount`, `status`, `disable`, `created_at`, `updated_at`) VALUES
(1, 1, '1', 2500, 'success', 'no', '2025-02-02 00:06:35', '2025-02-02 00:06:35'),
(2, 1, '1', 50000, 'success', 'no', '2025-02-02 00:36:12', '2025-02-02 00:36:12'),
(3, 1, '1', 30000, 'success', 'no', '2025-02-02 00:37:36', '2025-02-02 00:37:36'),
(4, 1, '1', 20000, 'success', 'no', '2025-02-02 00:38:51', '2025-02-02 00:38:51'),
(5, 1, '1', 2500, 'success', 'no', '2025-02-02 00:39:31', '2025-02-02 00:39:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(3, 'User', 'web', '2025-01-12 03:52:50', '2025-01-12 03:52:50'),
(4, 'Administrator', 'web', '2025-01-12 03:55:31', '2025-01-12 03:55:31'),
(5, 'Institution', 'web', '2025-01-12 04:07:18', '2025-01-12 04:07:18'),
(6, 'Merchant', 'web', '2025-01-28 02:19:19', '2025-01-28 02:19:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 4),
(2, 4),
(3, 4),
(4, 4),
(5, 4),
(6, 4),
(7, 4),
(8, 4),
(9, 4),
(10, 4),
(11, 4),
(12, 4),
(13, 4),
(14, 4),
(15, 4),
(16, 4),
(17, 4),
(18, 4),
(19, 4),
(20, 4),
(21, 4),
(22, 4),
(23, 4),
(24, 4),
(25, 4),
(25, 5),
(26, 4),
(27, 4),
(27, 5),
(28, 4),
(30, 4),
(30, 5),
(31, 4),
(31, 5),
(32, 4),
(32, 5),
(33, 4),
(34, 4),
(35, 4),
(36, 4),
(37, 4),
(37, 5),
(38, 4),
(38, 5),
(39, 4),
(39, 5),
(40, 4),
(40, 5),
(41, 4),
(42, 4),
(42, 5),
(43, 4),
(43, 5),
(44, 4),
(44, 5),
(45, 4),
(45, 5),
(46, 4),
(46, 5),
(47, 4),
(48, 3),
(48, 4),
(48, 5),
(49, 4),
(50, 4),
(51, 4),
(52, 4),
(52, 5),
(53, 4),
(53, 5),
(54, 4),
(55, 4),
(56, 4),
(56, 5),
(57, 4),
(58, 4),
(59, 4),
(60, 4),
(61, 4),
(62, 4),
(63, 4),
(64, 4),
(64, 5),
(65, 4),
(65, 5),
(66, 4),
(67, 4),
(68, 4),
(68, 5),
(69, 4),
(69, 5),
(70, 4),
(71, 4),
(72, 3),
(72, 4),
(72, 5),
(72, 6),
(73, 3),
(73, 4),
(73, 6),
(74, 3),
(74, 4),
(75, 3),
(75, 4),
(76, 3),
(76, 4),
(76, 5),
(76, 6),
(77, 3),
(77, 4),
(77, 6),
(78, 3),
(78, 4),
(79, 3),
(79, 4),
(80, 3),
(80, 4),
(80, 5),
(81, 3),
(81, 4),
(82, 3),
(82, 4),
(83, 3),
(83, 4),
(84, 4),
(85, 4),
(86, 4),
(87, 4),
(87, 6),
(88, 4),
(88, 6),
(89, 4),
(90, 4),
(91, 3),
(91, 4),
(92, 3),
(92, 4),
(93, 4),
(94, 4),
(95, 3),
(95, 4),
(96, 4),
(97, 4),
(97, 6),
(98, 4),
(99, 4),
(99, 6),
(103, 4),
(104, 4),
(105, 4),
(106, 4),
(107, 4),
(108, 4),
(109, 4),
(110, 4),
(111, 4),
(112, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `savings`
--

CREATE TABLE `savings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institution_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `balance` bigint(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `goal` varchar(255) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `status` enum('active','non active') NOT NULL,
  `disable` enum('no','yes') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `savings`
--

INSERT INTO `savings` (`id`, `institution_id`, `user_id`, `balance`, `description`, `goal`, `deadline`, `status`, `disable`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 30000, 'Tabungan Kuliah', 'Kuliah', '2025-08-30', 'active', 'no', '2025-01-28 18:03:33', '2025-01-29 00:55:16'),
(2, 1, 1, 20000, 'Wisuda', 'wisuda', '2025-08-30', 'active', 'no', '2025-01-28 21:45:58', '2025-01-29 00:55:05'),
(3, 1, 5, 15000, 'saving by API', NULL, NULL, 'active', 'no', '2025-01-29 02:28:51', '2025-04-05 13:15:21'),
(4, 1, 5, 10000, 'Gathering', 'Gathering akhir tahun', '2025-06-30', 'active', 'no', '2025-02-23 09:24:31', '2025-04-05 17:16:58'),
(6, 1, 5, 50000, 'Wisuda', 'perpisahan kelas', '2025-04-26', 'active', 'no', '2025-04-05 11:21:00', '2025-04-05 17:18:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2XNIRr1bGdjWERhT5ymzUqHKPmul8IASIzvoCoZK', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWDFwZ0hWOWNiQnR1QXhRT2ZRUVczc3M3MTZ2UzI4WlhhU21jME44WiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMjoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2FkbWluL3VzZXIiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747195557),
('5HY9u38lSXGdoehtIRS5C1QiJOBAj38M21Nk2lgV', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidHZxMU03ejhnMzZSTW5OTFRSa3JkUFc5YkVLdk1SSHZmdWRsNjNlWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747270229),
('7ViiTW1LDpWELHDM8G3tnWNP1eW4G9k8mMPO9wF9', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQWpCa0piOTE3b202WmF1M3I4VHYzWExONXd2TnNrNDloMDlwRGpGcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9wZXJtaXNzaW9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1746248101),
('BJGHI9u5GRZDbGXQCvQ7oxUBz3SBUBTeO312BuXG', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOHBVVW1aYmFvMkZEYmZ1S05kOU9IMExXRUpxMWVYdkNseXdqbW1TayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1745318317),
('co2IB6KSdUUyTJn2b1vsTYP0KqDJNn8xFjQsTh6Z', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidVR0dHFRM3dqWnl1NHFDNjJ0bWRZSFJUSThVdVBZMmxoa3pPbjJjciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1745222027),
('GGeud9tNnfqsnbIqrNTkeRHHT0SIw38fc9ncl75a', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSVVOSHJlNm5IRWJ3bklQdko4dzV5YW9icGNoRThmYmpuSEZSOWVMMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747301474),
('iIVEjR8cORfIR1ENRQpoLirElriBzAHs39vCL7oN', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZ2k4ZE5FMmxRU3FOS1pGZmJISzVrc1RZd05hZW9aVkdEdlZkZTZZbyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2FkbWluL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1745310204),
('il3id9JLsvCMc3AWaPvpID1S4W1j8TB2LYREDwW0', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSnJPZTA4TVZwZTBuc2tYTzFMOHc1eEJ1SWs1QnJnWDZXNmNnS2hLVCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRtaW4vcGF5bWVudCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1745116473),
('l2ce15zJVQJeV3vboDbEIApdmxLXblFK81TmmKvK', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoickFwU2xqODJjZnFkZnpGSXdhbUliUU1qaDRpS004SEI1a2tDcnVjdSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fX0=', 1745458975),
('LDeQ0Qzu9eLGtV8McqW6oV94dbPdxKKSkOrkt63J', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYTZ3VHpadGVIUjVOdEZxc05tcjcwc1VHNnZDR1ROUHJoa0F2VFk3NiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi90b3B1cCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1745743664),
('mmX2lnh10zDcrFFwYIKRcm1clJrutAE70e5LGRFs', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV2w5NXB1b2pwMU9TcnppZktubkpINThuQ2FKZ3RKcEdoTWNUd1JtaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747357198),
('mQ9mMvEsUHD5O20LUcTVy6meJM9QHPgRuy1lqoBr', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ1BpQmVHVlI0bXlYTjFHdkYyRFhQVUNuSDRrNWtqZmVrejZIOG5McyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747208112),
('NTXIAFuJ7annW11jC4Z1uInOGK6qhb01qXql0WAI', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieXRsMk5maEtXWjBNUlE0QU5BZkcyZENheFFkbTI2dDAydnVicUx6VCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1745376978),
('NUN8Oa7iO4zrXdQA2iGxNbD2ec9uJbCwQw8Cqo2M', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidjBXY3hRZFdQMVp2S1N4WTlKZjhGV1N0T09HWWhCb0FvRDJhc3RoUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747377729),
('OPRWOQSPGHbnyi5jgvqHQxHPChkvNafHH3QShEQF', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoib3VQeVVFUUttVDl2VWp6Z0RTYnp4RVVuSTd6NG4ybGxZaGRoYjU1dyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1747454708),
('PeUuUOjciRDISZRz824AQSFGOHWJQySimLphgICt', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOGRDTGlhMjhLN1V4TFRHWnB1MERpUEc3OUc0NVBOOHFRaktueGtjSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1745652321),
('QHVqRTqJk1RPWoa3aWXfj4CM1uMl8uJCUfYU0idr', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWEVMdmhBUndKam5Bb3A3cUVnaFpuM2o4SVJ5czRKQ1dPdENMOHVMbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9zbGlkZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1745137112),
('R0btum2GfPi4ZnW7VH7fmPJToRm6WlZvW3pbRtkB', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMlgyOVRpWGh3bTEwN0J2QjBGZWVWTGRJemcxSkczSFB1SjM2NE5JRyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMzOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRtaW4vdG9wdXAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1747547004),
('TvVtGxKkOj6KJHF0thFFBsrqGFWwmmy30CEFmaIh', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiM1BkSXlzakxNNlVDYVlUYkJSamFPVXZwQ2F5VE81QTJYTmd3cWNnRSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMzOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRtaW4vdG9wdXAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1747569772),
('uUSmChonut81cWpBGWNEW2AbOkavtiIoqgCPZyIV', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiejF4azFGU0xnOGlQTklGWHVXMGo1c3I2YkVvc0wxZFpyZEtmRW8xeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1745392629),
('WOWZHm7qXS9ACRj6qTj9iWW9oE6VfQbf3QDcwqeZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieFZCaThyQ2d4R3F6b0w0cFBwbXZaUEZpeDZJOGVxaThTa2l2cDN6ZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1745401530),
('ZxUtDXbPRfu4xUtxnGrUe9KdsnY1M4LEsirBz7fs', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoianZSWldCTTdKdHE3dmlwVXJaVFlITFV1N3piS1l1dFM1dTF0aFdaaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi91c2VyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1746949653);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sharings`
--

CREATE TABLE `sharings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institution_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `destination_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('active','non active') NOT NULL,
  `disable` enum('no','yes') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sharings`
--

INSERT INTO `sharings` (`id`, `institution_id`, `user_id`, `destination_id`, `status`, `disable`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 1, 'active', 'no', '2025-05-15 06:36:03', '2025-05-15 06:36:03'),
(2, 1, 5, 6, 'active', 'no', '2025-05-17 09:22:17', '2025-05-17 09:22:17'),
(3, 1, 5, 4, 'active', 'no', '2025-05-17 12:08:08', '2025-05-17 12:08:08'),
(4, 1, 5, 9, 'active', 'no', '2025-05-17 12:31:35', '2025-05-17 12:31:35'),
(5, 1, 5, 8, 'active', 'no', '2025-05-18 03:12:40', '2025-05-18 03:12:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `title`, `link`, `created_at`, `updated_at`) VALUES
(6, 'mRxFETxiqcGOLzY3imTpBZ7oRZslMjZ54XWQfVEE.jpg', 'ticash1', 'tes', '2025-04-20 08:10:06', '2025-04-20 08:10:06'),
(7, 'zXdGxn5ZH9hwtZINI5NWXiuyFpdlZXLFn0j4XVVI.jpg', 'ticash 2', 'tes 2', '2025-04-20 08:11:27', '2025-04-20 08:11:27'),
(8, '9VzTmPnEfai1v0s0ZyviagOXnbZzSU0rKaWjIaVV.png', 'ticash 3', 'tes 3', '2025-04-20 08:14:29', '2025-04-20 08:14:29'),
(9, 'SRzxQWKefC3G9HhiPIN2PaW8WgQ4JfqcBq5zoq0b.png', 'ticash 5', 'tes 6', '2025-04-20 08:17:15', '2025-04-20 08:17:15'),
(10, 'TCwczu6owm6zG9bP7Neze1QCglO5vR6xiAg1xrUb.jpg', 'ticash 4', 'test 4', '2025-04-20 08:18:32', '2025-04-20 08:18:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institution_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `degree_id` bigint(20) UNSIGNED NOT NULL,
  `nim` bigint(20) NOT NULL,
  `major` varchar(255) NOT NULL,
  `graduation` varchar(255) NOT NULL,
  `status` enum('active','non active') NOT NULL,
  `disable` enum('no','yes') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `students`
--

INSERT INTO `students` (`id`, `institution_id`, `user_id`, `degree_id`, `nim`, `major`, `graduation`, `status`, `disable`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 2, 2323243434, 'TI', '2024', 'active', 'no', '2025-01-19 00:49:52', '2025-01-19 01:05:34'),
(2, 1, 6, 2, 34513243243, 'TI', '2025', 'active', 'no', '2025-01-30 01:10:58', '2025-01-30 01:10:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trans_number` varchar(255) NOT NULL,
  `institution_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_category_id` bigint(20) UNSIGNED NOT NULL,
  `destination_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('debit','credit') NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `admin_fee` bigint(20) NOT NULL,
  `shared_fee` bigint(20) NOT NULL,
  `status` enum('waiting','processing','success','pending') NOT NULL,
  `disable` enum('no','yes') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `trans_number`, `institution_id`, `user_id`, `transaction_category_id`, `destination_id`, `type`, `description`, `amount`, `admin_fee`, `shared_fee`, `status`, `disable`, `created_at`, `updated_at`) VALUES
(1, 'TP-MBGBP', 1, 1, 1, 1, 'debit', 'tes', 100000, 2500, 500, 'success', 'no', '2025-01-23 03:20:13', '2025-01-23 03:24:47'),
(2, 'TP-7PS0H', 1, 1, 1, 1, 'debit', 'tes', 50000, 2500, 500, 'success', 'no', '2025-01-23 03:28:51', '2025-01-23 03:29:12'),
(3, 'WD-6O900', 1, 1, 4, 1, 'debit', 'tes', 50000, 2500, 500, 'waiting', 'no', '2025-01-26 08:45:13', '2025-01-26 08:45:13'),
(4, 'WD-R2L58', 1, 1, 4, 1, 'debit', 'tes', 20000, 2500, 500, 'waiting', 'no', '2025-01-26 08:45:54', '2025-01-26 08:45:54'),
(5, 'TP-3C815', 1, 5, 1, 5, 'debit', 'topup', 500000, 2500, 500, 'success', 'no', '2025-01-28 02:08:39', '2025-01-28 02:09:43'),
(6, 'SP-3IOC8', 1, 5, 8, 4, 'credit', 'Shop', 20000, 0, 0, 'success', 'no', '2025-01-28 02:27:11', '2025-01-28 02:27:11'),
(7, 'SP-ZU56S', 1, 5, 8, 4, 'credit', 'Shop', 10000, 0, 0, 'success', 'no', '2025-01-28 02:27:46', '2025-01-28 02:27:46'),
(8, 'WD-QXJL6', 1, 4, 4, 4, 'credit', 'tarik tunai', 20000, 0, 0, 'success', 'no', '2025-01-28 03:19:49', '2025-01-28 03:19:49'),
(9, 'SVDZFTP', 1, 1, 7, 1, 'credit', 'saving', 20000, 0, 0, 'success', 'no', '2025-01-28 18:10:05', '2025-01-28 18:10:05'),
(10, 'SVA0LO8', 1, 1, 7, 1, 'credit', 'saving', 50000, 0, 0, 'success', 'no', '2025-01-28 18:10:31', '2025-01-28 18:10:31'),
(11, 'SV1KO3J', 1, 1, 7, 1, 'debit', 'saving', 0, 0, 0, 'success', 'no', '2025-01-28 18:10:52', '2025-01-28 18:10:52'),
(12, 'SVN97VQ', 1, 1, 7, 1, 'credit', 'saving', 20000, 0, 0, 'success', 'no', '2025-01-28 18:27:28', '2025-01-28 18:27:28'),
(13, 'SVIFP0Y', 1, 1, 7, 1, 'credit', 'saving', 10000, 0, 0, 'success', 'no', '2025-01-28 18:29:08', '2025-01-28 18:29:08'),
(14, 'SV279VD', 1, 1, 7, 1, 'credit', 'saving', 20000, 0, 0, 'success', 'no', '2025-01-28 21:46:11', '2025-01-28 21:46:11'),
(15, 'SVKHZD0', 1, 1, 7, 1, 'credit', 'saving', 10000, 0, 0, 'success', 'no', '2025-01-28 21:48:04', '2025-01-28 21:48:04'),
(16, 'SV5VW33', 1, 1, 7, 1, 'debit', 'saving', 0, 0, 0, 'success', 'no', '2025-01-28 21:51:56', '2025-01-28 21:51:56'),
(17, 'SVQS379', 1, 1, 7, 1, 'credit', 'saving', 20000, 0, 0, 'success', 'no', '2025-01-28 21:52:21', '2025-01-28 21:52:21'),
(18, 'SVMS37M', 1, 1, 7, 1, 'debit', 'saving', 0, 0, 0, 'success', 'no', '2025-01-28 21:52:30', '2025-01-28 21:52:30'),
(19, 'SV2897D', 1, 1, 7, 1, 'debit', 'saving', 0, 0, 0, 'success', 'no', '2025-01-28 21:52:49', '2025-01-28 21:52:49'),
(20, 'GT-0093F', 1, 1, 9, 1, 'credit', 'Tabungan Bersama', 10000, 0, 0, 'success', 'no', '2025-01-28 22:47:33', '2025-01-28 22:47:33'),
(21, 'SV-9J035', 1, 1, 7, 1, 'debit', 'Collect Saving', 0, 0, 0, 'success', 'no', '2025-01-29 00:54:54', '2025-01-29 00:54:54'),
(22, 'SV-555WN', 1, 1, 7, 1, 'credit', 'Saving', 20000, 0, 0, 'success', 'no', '2025-01-29 00:55:05', '2025-01-29 00:55:05'),
(23, 'SV-EEAX4', 1, 1, 7, 1, 'credit', 'Saving', 30000, 0, 0, 'success', 'no', '2025-01-29 00:55:16', '2025-01-29 00:55:16'),
(24, 'GT-428SD', 1, 5, 9, 5, 'credit', 'Tabungan Bersama', 20000, 0, 0, 'success', 'no', '2025-01-29 01:44:25', '2025-01-29 01:44:25'),
(25, 'GT-O5821', 1, 5, 9, 5, 'credit', 'Tabungan Bersama', 20000, 0, 0, 'success', 'no', '2025-01-29 01:45:50', '2025-01-29 01:45:50'),
(26, 'GT-KJJ69', 1, 5, 9, 5, 'credit', 'Tabungan Bersama', 20000, 0, 0, 'success', 'no', '2025-01-29 01:46:05', '2025-01-29 01:46:05'),
(27, 'GT-979PV', 1, 5, 9, 5, 'credit', 'Tabungan Bersama', 10000, 0, 0, 'success', 'no', '2025-01-29 01:46:31', '2025-01-29 01:46:31'),
(28, 'GT-6Y83M', 1, 5, 9, 5, 'credit', 'Tabungan Bersama', 20000, 0, 0, 'success', 'no', '2025-01-29 01:57:57', '2025-01-29 01:57:57'),
(29, 'GT-06534', 1, 1, 9, 1, 'credit', 'Tabungan Bersama', 10000, 0, 0, 'success', 'no', '2025-01-29 02:01:11', '2025-01-29 02:01:11'),
(30, 'TP-5L596', 1, 1, 1, 1, 'debit', 'topup via cash', 500000, 2500, 500, 'success', 'no', '2025-01-29 02:04:06', '2025-01-29 02:06:40'),
(31, 'GT-M34RH', 1, 1, 7, 1, 'debit', 'Collect Gether', 0, 0, 0, 'success', 'no', '2025-01-29 02:22:30', '2025-01-29 02:22:30'),
(32, 'GT-C02F0', 1, 1, 9, 1, 'credit', 'Tabungan Bersama', 200000, 0, 0, 'success', 'no', '2025-01-29 02:25:36', '2025-01-29 02:25:36'),
(33, 'GT-023MH', 1, 5, 7, 5, 'debit', 'Collect Gether', 230000, 0, 0, 'success', 'no', '2025-01-29 02:26:05', '2025-01-29 02:26:05'),
(34, 'SV-091MB', 1, 5, 7, 5, 'credit', 'Saving', 50000, 0, 0, 'success', 'no', '2025-01-29 02:29:12', '2025-01-29 02:29:12'),
(35, 'TF-CQFT5', 1, 6, 2, 6, 'credit', 'pinjam uang', 20000, 0, 0, 'success', 'no', '2025-01-30 17:11:10', '2025-01-30 17:11:10'),
(36, 'TF-7M05C', 1, 6, 2, 6, 'credit', 'pinjaman 2', 30000, 0, 0, 'success', 'no', '2025-01-30 17:20:27', '2025-01-30 17:20:27'),
(37, 'TF-W8IRJ', 1, 7, 2, 7, 'credit', 'pinjam raina', 20000, 0, 0, 'success', 'no', '2025-01-30 17:21:22', '2025-01-30 17:21:22'),
(38, 'WD-0W731', 1, 7, 4, 7, 'credit', 'tarik tunai raina', 10000, 0, 0, 'success', 'no', '2025-01-30 17:22:56', '2025-01-30 17:22:56'),
(39, 'TF-27TD3', 1, 7, 2, 7, 'credit', 'pinjaman', 20000, 0, 0, 'success', 'no', '2025-01-30 18:17:48', '2025-01-30 18:17:48'),
(40, 'TP-08U07', 1, 5, 1, 5, 'debit', 'tabungan', 10000000, 2500, 500, 'success', 'no', '2025-02-01 06:21:11', '2025-02-01 06:21:44'),
(41, 'PM-RVQ8F', 1, 5, 3, 5, 'credit', 'SPP Bulanan Tahun ajaran 2025', 1500000, 0, 0, 'success', 'no', '2025-02-01 06:25:55', '2025-02-01 06:25:55'),
(42, 'PM-73R57', 1, 5, 3, 5, 'credit', 'SPP Bulanan Tahun ajaran 2025', 1500000, 0, 0, 'success', 'no', '2025-02-01 06:32:59', '2025-02-01 06:32:59'),
(43, 'CM-14O9U', 1, 1, 5, 1, 'credit', 'tes', 10000, 0, 0, 'success', 'no', '2025-02-01 12:56:48', '2025-02-01 12:56:48'),
(44, 'TP-50TQ9', 1, 1, 1, 1, 'debit', 'uang bulanan', 5000000, 3000, 1000, 'success', 'no', '2025-02-01 13:15:56', '2025-02-01 13:16:01'),
(45, 'TP-CR7O3', 1, 1, 1, 1, 'debit', 'topup', 96000, 3000, 1000, 'success', 'no', '2025-02-01 13:21:15', '2025-02-01 13:21:23'),
(46, 'RD-813AO', 1, 1, 10, 1, 'debit', 'Redeem Profit', 20000, 0, 0, 'success', 'no', '2025-02-02 00:38:51', '2025-02-02 00:38:51'),
(47, 'RD-44TK6', 1, 1, 10, 1, 'debit', 'Redeem Profit', 2500, 0, 0, 'success', 'no', '2025-02-02 00:39:31', '2025-02-02 00:39:31'),
(48, 'CM-3J4ZT', 1, 1, 5, 1, 'credit', 'infak', 10000, 0, 0, 'success', 'no', '2025-02-02 00:40:04', '2025-02-02 00:40:04'),
(49, 'BL-P8OI0', 1, 1, 6, 1, 'credit', 'invoice FEB', 4500, 0, 0, 'success', 'no', '2025-02-02 02:01:42', '2025-02-02 02:01:42'),
(50, 'SP-T6ZKJ', 1, 1, 8, 4, 'credit', 'Shop', 3000, 0, 0, 'success', 'no', '2025-02-23 07:37:32', '2025-02-23 07:37:32'),
(51, 'TF-U7TJW', 1, 4, 2, 4, 'credit', 'tf by API', 5000, 0, 0, 'success', 'no', '2025-02-23 07:55:53', '2025-02-23 07:55:53'),
(52, 'PM-3L008', 1, 5, 3, 5, 'credit', 'payment by API', 10000, 0, 0, 'success', 'no', '2025-02-23 08:49:16', '2025-02-23 08:49:16'),
(53, 'SV-4EPVN', 1, 5, 7, 5, 'credit', 'Saving', 10000, 0, 0, 'success', 'no', '2025-02-23 09:19:11', '2025-02-23 09:19:11'),
(54, 'SV-U495H', 1, 5, 7, 5, 'credit', 'Saving', 10000, 0, 0, 'success', 'no', '2025-02-23 09:19:51', '2025-02-23 09:19:51'),
(55, 'SV-605OT', 1, 5, 7, 5, 'credit', 'Saving', 10000, 0, 0, 'success', 'no', '2025-02-23 09:23:19', '2025-02-23 09:23:19'),
(56, 'SV-8F49P', 1, 5, 7, 5, 'debit', 'Collect Saving', 0, 0, 0, 'success', 'no', '2025-02-23 09:25:09', '2025-02-23 09:25:09'),
(57, 'SV-RU047', 1, 5, 7, 5, 'debit', 'Collect Saving', 0, 0, 0, 'success', 'no', '2025-02-23 09:25:26', '2025-02-23 09:25:26'),
(58, 'SV-96CN7', 1, 5, 7, 5, 'credit', 'Saving', 500000, 0, 0, 'success', 'no', '2025-02-23 09:26:09', '2025-02-23 09:26:09'),
(59, 'SV-I54F9', 1, 5, 7, 5, 'debit', 'Collect Saving', 0, 0, 0, 'success', 'no', '2025-02-23 09:27:13', '2025-02-23 09:27:13'),
(60, 'SV-90C91', 1, 5, 7, 5, 'debit', 'Collect Saving', 0, 0, 0, 'success', 'no', '2025-02-23 09:27:24', '2025-02-23 09:27:24'),
(61, 'SV-T6655', 1, 5, 7, 5, 'credit', 'Saving', 500000, 0, 0, 'success', 'no', '2025-02-23 09:27:49', '2025-02-23 09:27:49'),
(62, 'SV-VBCT2', 1, 5, 7, 5, 'credit', 'Saving', 300000, 0, 0, 'success', 'no', '2025-02-23 09:28:00', '2025-02-23 09:28:00'),
(63, 'SV-K2THB', 1, 5, 7, 5, 'debit', 'Collect Saving', 0, 0, 0, 'success', 'no', '2025-02-23 09:28:22', '2025-02-23 09:28:22'),
(64, 'SV-R48A6', 1, 5, 7, 5, 'debit', 'Collect Saving', 500000, 0, 0, 'success', 'no', '2025-02-23 09:30:22', '2025-02-23 09:30:22'),
(65, 'GT-6X120', 1, 5, 9, 5, 'credit', 'Gether', 20000, 0, 0, 'success', 'no', '2025-02-23 11:16:36', '2025-02-23 11:16:36'),
(66, 'GT-944I3', 1, 5, 9, 5, 'credit', 'Gether', 30000, 0, 0, 'success', 'no', '2025-02-23 11:18:02', '2025-02-23 11:18:02'),
(67, 'GT-G2P63', 1, 5, 9, 5, 'credit', 'Gether', 30000, 0, 0, 'success', 'no', '2025-02-23 11:19:55', '2025-02-23 11:19:55'),
(68, 'GT-NU435', 1, 5, 9, 5, 'credit', 'Gether', 20000, 0, 0, 'success', 'no', '2025-02-23 11:20:08', '2025-02-23 11:20:08'),
(69, 'GT-J0VJG', 1, 5, 9, 5, 'credit', 'Gether', 30000, 0, 0, 'success', 'no', '2025-02-23 11:23:24', '2025-02-23 11:23:24'),
(70, 'GT-K6F4Z', 1, 5, 9, 5, 'credit', 'Gether', 25000, 0, 0, 'success', 'no', '2025-02-23 11:23:55', '2025-02-23 11:23:55'),
(71, 'GT-5I44Z', 1, 1, 9, 1, 'credit', 'Gether', 25000, 0, 0, 'success', 'no', '2025-02-23 11:25:41', '2025-02-23 11:25:41'),
(72, 'GT-Z8WV8', 1, 1, 9, 1, 'credit', 'Gether', 25000, 0, 0, 'success', 'no', '2025-02-23 11:27:22', '2025-02-23 11:27:22'),
(73, 'GT-51K76', 1, 1, 9, 1, 'credit', 'Gether', 25000, 0, 0, 'success', 'no', '2025-02-23 11:28:43', '2025-02-23 11:28:43'),
(74, 'GT-3SRP4', 1, 1, 9, 1, 'credit', 'Gether Member', 25000, 0, 0, 'success', 'no', '2025-02-23 11:29:15', '2025-02-23 11:29:15'),
(75, 'GT-XDSF5', 1, 5, 9, 5, 'credit', 'Gether', 20000, 0, 0, 'success', 'no', '2025-02-23 11:32:22', '2025-02-23 11:32:22'),
(76, 'GT-Q8DES', 1, 5, 9, 5, 'credit', 'Tabungan Bersama', 20000, 0, 0, 'success', 'no', '2025-02-23 11:32:54', '2025-02-23 11:32:54'),
(77, 'GT-U3389', 1, 5, 9, 5, 'debit', 'Collect gether', 165000, 0, 0, 'success', 'no', '2025-02-23 11:34:18', '2025-02-23 11:34:18'),
(78, 'GT-9XS66', 1, 5, 9, 5, 'debit', 'Collect gether', 0, 0, 0, 'success', 'no', '2025-02-23 11:34:33', '2025-02-23 11:34:33'),
(79, 'TF-6429N', 1, 5, 2, 1, 'credit', 'tf by API', 5000, 0, 0, 'success', 'no', '2025-03-20 05:37:03', '2025-03-20 05:37:03'),
(80, 'TF-61I97', 1, 5, 2, 1, 'credit', 'tes', 4000, 0, 0, 'success', 'no', '2025-03-20 06:11:47', '2025-03-20 06:11:47'),
(81, 'TP-6F695', 1, 1, 1, 1, 'debit', 'Topup Saldo', 30000, 3000, 1000, 'success', 'no', '2025-03-28 08:28:23', '2025-03-28 08:28:23'),
(82, 'SP-CEK6J', 1, 5, 8, 4, 'credit', 'Shop', 3000, 0, 0, 'success', 'no', '2025-04-03 08:52:09', '2025-04-03 08:52:09'),
(83, 'SP-22AV2', 1, 1, 8, 4, 'credit', 'Shop', 200000, 0, 0, 'success', 'no', '2025-04-03 08:55:23', '2025-04-03 08:55:23'),
(84, 'SP-K36YO', 1, 1, 8, 7, 'credit', 'Shop', 10000, 0, 0, 'success', 'no', '2025-04-03 08:57:40', '2025-04-03 08:57:40'),
(85, 'SP-87V13', 1, 1, 8, 7, 'credit', 'Shop', 3000, 0, 0, 'success', 'no', '2025-04-03 08:59:44', '2025-04-03 08:59:44'),
(86, 'SP-QOJ6C', 1, 1, 8, 7, 'credit', 'Shop', 0, 0, 0, 'success', 'no', '2025-04-03 09:01:31', '2025-04-03 09:01:31'),
(87, 'SP-98FO7', 1, 1, 8, 7, 'credit', 'Shop', 2000, 0, 0, 'success', 'no', '2025-04-03 09:04:13', '2025-04-03 09:04:13'),
(88, 'SP-J80M1', 1, 1, 8, 4, 'credit', 'Bakso malang unilam', 5000, 0, 0, 'success', 'no', '2025-04-03 09:42:43', '2025-04-03 09:42:43'),
(89, 'PM-4KK1C', 1, 5, 3, 5, 'credit', 'payment by API', 10000, 0, 0, 'success', 'no', '2025-04-03 12:11:01', '2025-04-03 12:11:01'),
(90, 'PM-9CBIO', 1, 5, 3, 5, 'credit', 'Iuran Pembangunan Masjid', 10000, 0, 0, 'success', 'no', '2025-04-03 12:12:02', '2025-04-03 12:12:02'),
(91, 'PM-4S67Q', 1, 5, 3, 5, 'credit', 'Pendaftaran Masuk Awal', 15000000, 0, 0, 'success', 'no', '2025-04-03 12:13:39', '2025-04-03 12:13:39'),
(92, 'PM-Z7EI9', 1, 5, 3, 5, 'credit', 'Pendaftaran Masuk Awal', 15000000, 0, 0, 'success', 'no', '2025-04-03 12:16:13', '2025-04-03 12:16:13'),
(93, 'TP-J6Y17', 1, 5, 1, 5, 'debit', 'topup', 8996000, 3000, 1000, 'success', 'no', '2025-04-03 12:17:53', '2025-04-03 12:21:00'),
(94, 'PM-W3578', 1, 5, 3, 5, 'credit', 'Iuran Pembangunan Masjid', 10000, 0, 0, 'success', 'no', '2025-04-03 12:21:59', '2025-04-03 12:21:59'),
(95, 'PM-8EU8F', 1, 5, 3, 5, 'credit', 'Iuran Pembangunan Masjid', 10000, 0, 0, 'success', 'no', '2025-04-03 12:25:50', '2025-04-03 12:25:50'),
(96, 'SV-G3657', 1, 5, 7, 5, 'credit', 'Saving', 10000, 0, 0, 'success', 'no', '2025-04-04 22:50:25', '2025-04-04 22:50:25'),
(97, 'SV-002P6', 1, 5, 7, 5, 'credit', 'Saving', 20000, 0, 0, 'success', 'no', '2025-04-05 03:13:22', '2025-04-05 03:13:22'),
(98, 'SV-4LXT4', 1, 5, 7, 5, 'credit', 'Saving', 20000, 0, 0, 'success', 'no', '2025-04-05 04:16:27', '2025-04-05 04:16:27'),
(99, 'SV-T027Z', 1, 5, 7, 5, 'debit', 'Collect Saving', 30000, 0, 0, 'success', 'no', '2025-04-05 12:52:24', '2025-04-05 12:52:24'),
(100, 'SV-WOK58', 1, 5, 7, 5, 'debit', 'Collect Saving', 20000, 0, 0, 'success', 'no', '2025-04-05 12:52:52', '2025-04-05 12:52:52'),
(101, 'SV-P94F8', 1, 5, 7, 5, 'debit', 'Tarik dana saving by API', 20000, 0, 0, 'success', 'no', '2025-04-05 13:15:21', '2025-04-05 13:15:21'),
(102, 'SV-QUDAZ', 1, 5, 7, 5, 'credit', 'Saving Gathering', 50000, 0, 0, 'success', 'no', '2025-04-05 13:17:39', '2025-04-05 13:17:39'),
(103, 'SP-183AR', 1, 5, 8, 4, 'credit', 'Bakso malang unilam', 2000, 0, 0, 'success', 'no', '2025-04-05 17:46:59', '2025-04-05 17:46:59'),
(104, 'TF-B523O', 1, 5, 2, 1, 'credit', 'pinjam', 10000, 0, 0, 'success', 'no', '2025-04-05 18:07:50', '2025-04-05 18:07:50'),
(105, 'PM-5JJ90', 1, 5, 3, 5, 'credit', 'Iuran Pembangunan Masjid', 10000, 0, 0, 'success', 'no', '2025-04-05 18:36:33', '2025-04-05 18:36:33'),
(106, 'GT-97V92', 1, 5, 9, 5, 'credit', 'Gether', 20000, 0, 0, 'success', 'no', '2025-04-06 07:16:23', '2025-04-06 07:16:23'),
(107, 'GT-WLRET', 1, 5, 9, 5, 'credit', 'Gether', 50000, 0, 0, 'success', 'no', '2025-04-06 07:16:43', '2025-04-06 07:16:43'),
(108, 'GT-B0JFN', 1, 5, 9, 5, 'debit', 'Collect getherTabungan Tour by API', 20000, 0, 0, 'success', 'no', '2025-04-06 07:26:03', '2025-04-06 07:26:03'),
(109, 'GT-W1421', 1, 5, 9, 5, 'debit', 'Collect getherTabungan Kelas 5', 10000, 0, 0, 'success', 'no', '2025-04-09 00:52:32', '2025-04-09 00:52:32'),
(110, 'GT-K8S9Y', 1, 1, 9, 1, 'credit', 'Tabungan Bersama', 10000, 0, 0, 'success', 'no', '2025-04-09 00:57:44', '2025-04-09 00:57:44'),
(111, 'GT-G88XU', 1, 1, 9, 1, 'credit', 'Tabungan Bersama', 10000, 0, 0, 'success', 'no', '2025-04-09 00:59:42', '2025-04-09 00:59:42'),
(112, 'GT-5E4UW', 1, 5, 9, 5, 'credit', 'Gether', 2000, 0, 0, 'success', 'no', '2025-04-13 13:08:53', '2025-04-13 13:08:53'),
(113, 'GT-425KT', 1, 5, 9, 5, 'credit', 'Gether Member', 20000, 0, 0, 'success', 'no', '2025-04-20 01:26:00', '2025-04-20 01:26:00'),
(114, 'GT-T8K4R', 1, 5, 9, 5, 'credit', 'Gether Member', 10000, 0, 0, 'success', 'no', '2025-04-20 01:26:21', '2025-04-20 01:26:21'),
(115, 'GT-QX3T2', 1, 5, 9, 5, 'credit', 'Gether Member', 10000, 0, 0, 'success', 'no', '2025-04-20 01:27:46', '2025-04-20 01:27:46'),
(116, 'GT-JPTV0', 1, 6, 9, 6, 'credit', 'Gether Member', 5000, 0, 0, 'success', 'no', '2025-04-20 01:59:29', '2025-04-20 01:59:29'),
(117, 'PM-49U7K', 1, 5, 3, 5, 'credit', 'Iuran Pembangunan Masjid', 10000, 0, 0, 'success', 'no', '2025-04-20 02:13:50', '2025-04-20 02:13:50'),
(118, 'PM-H8VD2', 1, 5, 3, 5, 'credit', 'Iuran Pembangunan Masjid', 10000, 0, 0, 'success', 'no', '2025-04-20 02:16:08', '2025-04-20 02:16:08'),
(119, 'PM-4CA43', 1, 5, 3, 5, 'credit', 'Iuran Pembangunan Masjid', 10000, 0, 0, 'success', 'no', '2025-04-20 02:23:55', '2025-04-20 02:23:55'),
(120, 'PM-IW171', 1, 5, 3, 5, 'credit', 'Iuran Pembangunan Masjid', 10000, 0, 0, 'success', 'no', '2025-04-20 02:33:06', '2025-04-20 02:33:06'),
(121, 'TF-GB1', 1, 5, 2, 1, 'credit', 'tes', 20000, 0, 0, 'success', 'no', '2025-05-17 09:19:32', '2025-05-17 09:19:32'),
(122, 'TF-8M1', 1, 5, 2, 1, 'credit', 'tf to syaiful', 5000, 0, 0, 'success', 'no', '2025-05-17 09:20:37', '2025-05-17 09:20:37'),
(123, 'TF-FDZ', 1, 5, 2, 6, 'credit', 'tf to rara', 10000, 0, 0, 'success', 'no', '2025-05-17 10:12:32', '2025-05-17 10:12:32'),
(124, 'TP-S34H9', 1, 1, 1, 1, 'debit', 'topup by admin', 200000, 3000, 1000, 'waiting', 'no', '2025-05-18 05:43:23', '2025-05-18 05:43:23'),
(125, 'TP-41F02', 1, 1, 1, 1, 'debit', 'Topup Via Transfer Bank', 20013, 3000, 1000, 'processing', 'no', '2025-05-18 08:06:20', '2025-05-18 10:54:22'),
(126, 'TP-2Q886', 1, 1, 1, 1, 'debit', 'Topup Via Transfer Bank', 46299, 3000, 1000, 'success', 'no', '2025-05-18 11:19:40', '2025-05-18 12:02:48'),
(127, 'TP-44495', 1, 1, 1, 1, 'debit', 'Topup Via Transfer Bank', 26984, 3000, 1000, 'success', 'no', '2025-05-18 12:00:24', '2025-05-18 12:01:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_categories`
--

CREATE TABLE `transaction_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` enum('active','non active') NOT NULL,
  `disable` enum('no','yes') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaction_categories`
--

INSERT INTO `transaction_categories` (`id`, `transaction_name`, `description`, `status`, `disable`, `created_at`, `updated_at`) VALUES
(1, 'Topup', 'Topup ', 'active', 'no', NULL, NULL),
(2, 'Transfer', 'Transfer', 'active', 'no', NULL, NULL),
(3, 'Payment', 'Payment', 'active', 'no', NULL, NULL),
(4, 'Withdrawal', 'Penarikan saldo user', 'active', 'no', NULL, NULL),
(5, 'Claim', 'Penarikan dana dari institusi', 'active', 'no', NULL, NULL),
(6, 'Bill', 'Pembayaran biaya admin', 'active', 'no', NULL, NULL),
(7, 'Saving', 'Tabungan Pengguna', 'active', 'no', NULL, NULL),
(8, 'Shop', 'Transaksi Kantin', 'active', 'no', NULL, NULL),
(9, 'Gether', 'Tabungan Bersama', 'active', 'no', NULL, NULL),
(10, 'Reedem', 'Claim profit institution', 'active', 'no', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institution_id` bigint(20) UNSIGNED NOT NULL,
  `access_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `balance` bigint(20) NOT NULL,
  `va_number` bigint(20) NOT NULL,
  `card_number` bigint(20) DEFAULT NULL,
  `pin_number` bigint(20) NOT NULL,
  `bank_transfer` varchar(255) DEFAULT NULL,
  `account_number` bigint(20) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `status` enum('active','non active') NOT NULL,
  `disable` enum('no','yes') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `institution_id`, `access_id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `avatar`, `phone`, `address`, `dob`, `balance`, `va_number`, `card_number`, `pin_number`, `bank_transfer`, `account_number`, `account_name`, `remember_token`, `status`, `disable`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Syaiful Bachri', 'admin@gmail.com', NULL, '$2y$12$bqouJHjwFKsKBJ6cI6fiP.onUE.hVP3PgQB913rF7Dn0ZpK3gmLHO', NULL, NULL, NULL, 'BmpZlisIyfhB6cSOtHXBEDvRNWEPozWncjg8n7p4.png', '081285559758', 'PERUM GRAND BATAVIA CLUSTER GROOVE BLOK 2 NO.03', '2025-01-01', 5167283, 432543253425, 123325432532, 0, NULL, NULL, NULL, NULL, 'active', 'no', '2025-01-06 17:42:38', '2025-05-18 12:02:48'),
(3, 1, 2, 'Unilam', 'admin@unilam.com', NULL, '$2y$12$T7RMpSBR6i1v2qZWezhlg.rBemn3ctibwdVdwQBTE53mXCna5Fj0m', NULL, NULL, NULL, 'MimZ6He7Q3MmQuhP6YBGu5AHvQqeEYt2KjMsZPpV.png', '81285559752', 'PERUM GRAND BATAVIA CLUSTER GROOVE BLOK 2 NO.03', '2025-01-01', 0, 13454345432, 0, 0, NULL, NULL, NULL, NULL, 'active', 'no', '2025-01-17 21:40:37', '2025-01-17 21:40:37'),
(4, 1, 3, 'Kantin Unilam', 'tenant@unilam.com', NULL, '$2y$12$0C48nC6uItKPIZ6w1BD7n.oMk1dzaKVPfRfR1ybfFhOVhZ/ZSa4a6', NULL, NULL, NULL, 'mBhlImA3E37T9rwVbPc7gmD3gGDmnEYXadsA1BO5.png', '81285559753', 'PERUM GRAND BATAVIA CLUSTER GROOVE BLOK 2 NO.03', '2025-01-15', 18000, 79831661378, 12321213223, 123, NULL, NULL, NULL, NULL, 'active', 'no', '2025-01-17 21:41:27', '2025-02-23 07:55:53'),
(5, 1, 5, 'Saddam MA', 'saddam@gmail.com', NULL, '$2y$12$BeGvH2oBzSY/bJ2SlFP0Y.m72RzE8BTrFsPi4PW3JrM6cUFkkPrXu', NULL, NULL, NULL, 'uRR5xYx4lwwJQR2WYzTgVAkokFaUvn3fWjglGoLz.png', '81285559754', NULL, '2025-01-08', 2790000, 243424324343, 111234553453, 81285559754, NULL, NULL, NULL, NULL, 'active', 'no', '2025-01-18 06:47:45', '2025-05-17 10:12:32'),
(6, 1, 5, 'Rara', 'rara@gmail.com', NULL, '$2y$12$xGcAOaP6f1VnxWn7Hcu/yurFHxVSaHbRPC3xGg758qd/TZUwaL1TS', NULL, NULL, NULL, 'kJ5845C8GrLsqcg1ygW9Jn4PERIUPe3QG93dNy1X.jpg', '81285559755', 'PERUM GRAND BATAVIA CLUSTER GROOVE BLOK 2 NO.03', '2025-01-06', 55000, 798316613790, 1324312415, 123, NULL, NULL, NULL, NULL, 'active', 'no', '2025-01-25 22:01:47', '2025-05-17 10:12:32'),
(7, 1, 3, 'Raina', 'raina@gmail.com', NULL, '$2y$12$x/dkyGTEuIkKl2cVfW3vkOdpSJ8YK75b7/4dNGh0qh1Dbdt8MPCOK', NULL, NULL, NULL, 'H3MQNoz9QOMW9QD47wv3g89UZRh4PgO2HxMC4PDL.jpg', '81285559753', 'PERUM GRAND BATAVIA CLUSTER GROOVE BLOK 2 NO.03', '2024-02-08', 30000, 12564534343, 13243124154, 23456, NULL, NULL, NULL, NULL, 'active', 'no', '2025-01-30 02:15:39', '2025-01-30 18:17:48'),
(8, 1, 4, 'Syaiful Bachri', 'syaiful@gmail.com', NULL, '$2y$12$BW7lLnTfEaixaXf5XvPWLeZpGE.K4wFVrVS0kaw531n90FhiyVqQa', NULL, NULL, NULL, NULL, '081276663738', NULL, NULL, 0, 34632483247, NULL, 200691, NULL, NULL, NULL, NULL, 'active', 'no', '2025-02-21 04:42:13', '2025-02-21 04:42:13'),
(9, 1, 4, 'Hambali', 'hambali@gmail.com', NULL, '$2y$12$XR4MahRkLjN88gtTc8IDLOGUNyoJQ.pO50.zK5FjModfYneT4FEh2', NULL, NULL, NULL, 'WQ9W9rpnhlyfwOaz4KXgG3NZPqYzPqAUBYb4wrFB.png', '981285559759', NULL, 'null', 1000000, 1120257674, NULL, 123456, NULL, NULL, NULL, NULL, 'active', 'no', '2025-04-27 10:21:07', '2025-04-27 10:41:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `embed` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `accesses`
--
ALTER TABLE `accesses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `claims`
--
ALTER TABLE `claims`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `degrees`
--
ALTER TABLE `degrees`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `donaturs`
--
ALTER TABLE `donaturs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `donaturs_email_unique` (`email`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `gethers`
--
ALTER TABLE `gethers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gether_members`
--
ALTER TABLE `gether_members`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `institutions`
--
ALTER TABLE `institutions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `merchants`
--
ALTER TABLE `merchants`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `payment_categories`
--
ALTER TABLE `payment_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `reedems`
--
ALTER TABLE `reedems`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `savings`
--
ALTER TABLE `savings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `sharings`
--
ALTER TABLE `sharings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaction_categories`
--
ALTER TABLE `transaction_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `accesses`
--
ALTER TABLE `accesses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `bills`
--
ALTER TABLE `bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `claims`
--
ALTER TABLE `claims`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `degrees`
--
ALTER TABLE `degrees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `donations`
--
ALTER TABLE `donations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `donaturs`
--
ALTER TABLE `donaturs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gethers`
--
ALTER TABLE `gethers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `gether_members`
--
ALTER TABLE `gether_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `institutions`
--
ALTER TABLE `institutions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `merchants`
--
ALTER TABLE `merchants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `payment_categories`
--
ALTER TABLE `payment_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT untuk tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `reedems`
--
ALTER TABLE `reedems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `savings`
--
ALTER TABLE `savings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `sharings`
--
ALTER TABLE `sharings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT untuk tabel `transaction_categories`
--
ALTER TABLE `transaction_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
