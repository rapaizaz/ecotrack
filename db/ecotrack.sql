-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Bulan Mei 2026 pada 12.45
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
-- Database: `ecotrack`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ai_conversations`
--

CREATE TABLE `ai_conversations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ai_conversations`
--

INSERT INTO `ai_conversations` (`id`, `user_id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 3, 'hslo', 'Maaf, AI Assistant sedang tidak tersedia saat ini. Silakan coba beberapa saat lagi.', '2026-05-13 00:01:02', '2026-05-13 00:01:02'),
(2, 3, 'Cara memilah sampah rumah tangga', 'Maaf, AI Assistant sedang tidak tersedia saat ini. Silakan coba beberapa saat lagi.', '2026-05-13 00:01:18', '2026-05-13 00:01:18'),
(3, 3, 'Cara memilah sampah rumah tangga', 'Maaf, AI Assistant sedang tidak tersedia saat ini. Silakan coba beberapa saat lagi.', '2026-05-13 00:08:25', '2026-05-13 00:08:25'),
(4, 3, 'Cara memilah sampah rumah tangga', 'Maaf, AI Assistant sedang tidak tersedia saat ini. Silakan coba beberapa saat lagi.', '2026-05-13 00:11:33', '2026-05-13 00:11:33'),
(5, 3, 'Tips menghemat air saat mandi', 'Maaf, AI Assistant sedang tidak tersedia saat ini. Silakan coba beberapa saat lagi.', '2026-05-13 00:16:05', '2026-05-13 00:16:05'),
(6, 3, 'Tips menghemat air saat mandi', 'Maaf, AI Assistant sedang tidak tersedia saat ini. Silakan coba beberapa saat lagi.', '2026-05-13 00:20:06', '2026-05-13 00:20:06'),
(7, 3, 'Tips menghemat air saat mandi', 'Maaf, AI Assistant sedang tidak tersedia saat ini. Silakan coba beberapa saat lagi.', '2026-05-13 00:24:51', '2026-05-13 00:24:51'),
(8, 3, 'hslo', 'Maaf, AI Assistant sedang tidak tersedia saat ini. Silakan coba beberapa saat lagi.', '2026-05-13 00:26:00', '2026-05-13 00:26:00'),
(9, 3, 'hslo', 'Maaf, AI Assistant sedang tidak tersedia saat ini. Silakan coba beberapa saat lagi.', '2026-05-13 00:26:03', '2026-05-13 00:26:03'),
(10, 2, 'Tips menghemat air saat mandi', 'Maaf, AI Assistant sedang tidak tersedia saat ini. Silakan coba beberapa saat lagi.', '2026-05-13 00:27:57', '2026-05-13 00:27:57'),
(11, 2, 'Tips menghemat air saat mandi', 'Maaf, AI Assistant sedang tidak tersedia saat ini. Silakan coba beberapa saat lagi.', '2026-05-13 00:29:36', '2026-05-13 00:29:36'),
(12, 2, 'Tips menghemat air saat mandi', '*(AI Offline - Menampilkan Tips Otomatis)*\n\nTips Hemat Air: Gunakan gayung secukupnya, matikan kran saat menyabun, dan segera perbaiki kebocoran pipa.', '2026-05-13 00:38:21', '2026-05-13 00:38:21'),
(13, 2, 'cara nikah sama davina karamoy', '*(AI Offline - Menampilkan Tips Otomatis)*\n\nEco Living Tips: Kurangi penggunaan plastik sekali pakai, bawa kantong belanja sendiri, dan mulailah menanam pohon di sekitar rumah.', '2026-05-13 00:39:26', '2026-05-13 00:39:26'),
(14, 2, 'pemakaian listrik boros nih', '*(AI Offline - Menampilkan Tips Otomatis)*\n\nTips Hemat Listrik: Matikan lampu saat siang hari, cabut charger jika tidak dipakai, dan gunakan AC pada suhu 24-25 derajat.', '2026-05-13 00:40:21', '2026-05-13 00:40:21'),
(15, 2, 'pemakaian listrik boros nih', '*(AI Offline - Menampilkan Tips Otomatis)*\n\nTips Hemat Listrik: Matikan lampu saat siang hari, cabut charger jika tidak dipakai, dan gunakan AC pada suhu 24-25 derajat.', '2026-05-13 00:40:22', '2026-05-13 00:40:22'),
(16, 3, 'halo', '*(AI Offline - Menampilkan Tips Otomatis)*\n\nEco Living Tips: Kurangi penggunaan plastik sekali pakai, bawa kantong belanja sendiri, dan mulailah menanam pohon di sekitar rumah.', '2026-05-13 00:50:56', '2026-05-13 00:50:56'),
(17, 3, 'halo', '*(AI Offline - Menampilkan Tips Otomatis)*\n\nEco Living Tips: Kurangi penggunaan plastik sekali pakai, bawa kantong belanja sendiri, dan mulailah menanam pohon di sekitar rumah.', '2026-05-13 00:51:00', '2026-05-13 00:51:00'),
(18, 3, 'halo', '*(AI Offline - Menampilkan Tips Otomatis)*\n\nEco Living Tips: Kurangi penggunaan plastik sekali pakai, bawa kantong belanja sendiri, dan mulailah menanam pohon di sekitar rumah.', '2026-05-13 00:54:57', '2026-05-13 00:54:57'),
(19, 3, 'halo', '*(AI Offline - Menampilkan Tips Otomatis)*\n\nEco Living Tips: Kurangi penggunaan plastik sekali pakai, bawa kantong belanja sendiri, dan mulailah menanam pohon di sekitar rumah.', '2026-05-13 00:55:00', '2026-05-13 00:55:00'),
(20, 3, 'halo', '*(AI Offline - Menampilkan Tips Otomatis)*\n\nEco Living Tips: Kurangi penggunaan plastik sekali pakai, bawa kantong belanja sendiri, dan mulailah menanam pohon di sekitar rumah.', '2026-05-13 00:55:03', '2026-05-13 00:55:03'),
(21, 3, 'Cara memilah sampah rumah tangga', '*(AI Offline - Menampilkan Tips Otomatis)*\n\nTips Sampah: Pisahkan sampah organik dan anorganik. Sampah organik bisa dijadikan kompos, anorganik bisa didaur ulang.', '2026-05-13 00:55:14', '2026-05-13 00:55:14'),
(22, 3, 'Cara memilah sampah rumah tangga', '*(AI Offline - Menampilkan Tips Otomatis)*\n\nTips Sampah: Pisahkan sampah organik dan anorganik. Sampah organik bisa dijadikan kompos, anorganik bisa didaur ulang.', '2026-05-13 00:55:17', '2026-05-13 00:55:17'),
(23, 3, 'Tips menghemat air saat mandi', '*(AI Offline - Menampilkan Tips Otomatis)*\n\nTips Hemat Air: Gunakan gayung secukupnya, matikan kran saat menyabun, dan segera perbaiki kebocoran pipa.', '2026-05-13 01:04:58', '2026-05-13 01:04:58'),
(24, 3, 'tips daur ulang bahan plastik', '*(AI Offline - Menampilkan Tips Otomatis)*\n\nEco Living Tips: Kurangi penggunaan plastik sekali pakai, bawa kantong belanja sendiri, dan mulailah menanam pohon di sekitar rumah.', '2026-05-13 01:05:21', '2026-05-13 01:05:21'),
(25, 3, 'tips daur ulang bahan plastik', '*(AI Offline - Menampilkan Tips Otomatis)*\n\nEco Living Tips: Kurangi penggunaan plastik sekali pakai, bawa kantong belanja sendiri, dan mulailah menanam pohon di sekitar rumah.', '2026-05-13 01:05:25', '2026-05-13 01:05:25'),
(26, 3, 'tips daur ulang bahan plastik', '*(AI Offline - Menampilkan Tips Otomatis)*\n\nEco Living Tips: Kurangi penggunaan plastik sekali pakai, bawa kantong belanja sendiri, dan mulailah menanam pohon di sekitar rumah.', '2026-05-13 01:05:28', '2026-05-13 01:05:28'),
(27, 3, 'tips daur ulang bahan plastik', '*(AI Offline - Menampilkan Tips Otomatis)*\n\nEco Living Tips: Kurangi penggunaan plastik sekali pakai, bawa kantong belanja sendiri, dan mulailah menanam pohon di sekitar rumah.', '2026-05-13 01:05:32', '2026-05-13 01:05:32'),
(28, 3, 'tips daur ulang bahan plastik', '*(AI Offline - Menampilkan Tips Otomatis)*\n\nEco Living Tips: Kurangi penggunaan plastik sekali pakai, bawa kantong belanja sendiri, dan mulailah menanam pohon di sekitar rumah.', '2026-05-13 01:05:36', '2026-05-13 01:05:36'),
(29, 3, 'bagaimana caranya mendaur ulang sampah yang tidak dapat diuraikan', '*(AI Offline - Menampilkan Tips Otomatis)*\n\nTips Sampah: Pisahkan sampah organik dan anorganik. Sampah organik bisa dijadikan kompos, anorganik bisa didaur ulang.', '2026-05-13 01:11:13', '2026-05-13 01:11:13'),
(30, 3, 'berikan penjelasan uyg panjang', '*(AI Offline - Menampilkan Tips Otomatis)*\n\nEco Living Tips: Kurangi penggunaan plastik sekali pakai, bawa kantong belanja sendiri, dan mulailah menanam pohon di sekitar rumah.', '2026-05-13 01:12:00', '2026-05-13 01:12:00'),
(31, 3, 'Cara memilah sampah rumah tangga', '*(AI Offline - Menampilkan Tips Otomatis)*\n\nTips Sampah: Pisahkan sampah organik dan anorganik. Sampah organik bisa dijadikan kompos, anorganik bisa didaur ulang.', '2026-05-13 01:15:47', '2026-05-13 01:15:47'),
(32, 3, 'Tips menghemat air saat mandi', '*(AI Offline - Menampilkan Tips Otomatis)*\n\nTips Hemat Air: Gunakan gayung secukupnya, matikan kran saat menyabun, dan segera perbaiki kebocoran pipa.', '2026-05-13 01:29:28', '2026-05-13 01:29:28'),
(33, 3, 'Tips menghemat air saat mandi', '*(AI Offline - Menampilkan Tips Otomatis)*\n\nTips Hemat Air: Gunakan gayung secukupnya, matikan kran saat menyabun, dan segera perbaiki kebocoran pipa.', '2026-05-13 03:09:45', '2026-05-13 03:09:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ai_insights`
--

CREATE TABLE `ai_insights` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `insight` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ai_insights`
--

INSERT INTO `ai_insights` (`id`, `user_id`, `month`, `year`, `insight`, `created_at`, `updated_at`) VALUES
(1, 2, 5, 2026, '### Insight Otomatis (Offline)\n\nBerdasarkan data bulan ini, penggunaan listrik Anda sebesar 0.15 kWh dan air 10.00 m³. Skor Eco Anda sangat bagus (87)! Terus pertahankan gaya hidup hijau ini.', '2026-05-13 00:37:52', '2026-05-13 00:37:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `badges`
--

CREATE TABLE `badges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) NOT NULL,
  `requirement_type` varchar(255) NOT NULL,
  `requirement_value` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `badges`
--

INSERT INTO `badges` (`id`, `name`, `description`, `icon`, `requirement_type`, `requirement_value`, `created_at`, `updated_at`) VALUES
(1, 'Eco Starter', 'Mulai perjalanan ramah lingkunganmu.', 'seedling', 'first_input', 1, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(2, 'Hemat Listrik', 'Mencapai skor listrik >= 80.', 'bolt', 'electricity', 80, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(3, 'Hemat Air', 'Mencapai skor air >= 80.', 'tint', 'water', 80, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(4, 'Zero Plastic', 'Mencapai skor sampah >= 80.', 'recycle', 'waste', 80, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(5, 'Eco Warrior', 'Mencapai skor total >= 85.', 'shield-alt', 'total', 85, '2026-05-12 22:54:37', '2026-05-12 22:54:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Struktur dari tabel `challenges`
--

CREATE TABLE `challenges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `target_value` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `challenges`
--

INSERT INTO `challenges` (`id`, `title`, `description`, `category`, `target_value`, `points`, `start_date`, `end_date`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Hemat listrik 10% bulan ini', 'Targetkan penurunan penggunaan listrik minimal 10% dibanding bulan lalu.', 'Listrik', 10, 100, '2026-05-01', '2026-05-31', 1, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(2, 'Kurangi sampah plastik selama 7 hari', 'Usahakan tidak menghasilkan sampah plastik sekali pakai selama seminggu.', 'Sampah', 7, 50, '2026-05-13', '2026-05-20', 1, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(3, 'Zero Plastic Day', 'Satu hari tanpa plastik sama sekali.', 'Sampah', 1, 20, '2026-05-13', '2026-05-14', 1, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(4, 'Hemat Air', 'Selesaikan ini dengan bagus dan cerdik', 'Air', 5, 50, '2026-05-14', '2026-05-31', 1, '2026-05-12 23:37:23', '2026-05-12 23:44:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `eco_scores`
--

CREATE TABLE `eco_scores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `electricity_score` int(11) NOT NULL,
  `water_score` int(11) NOT NULL,
  `waste_score` int(11) NOT NULL,
  `total_score` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `eco_scores`
--

INSERT INTO `eco_scores` (`id`, `user_id`, `month`, `year`, `electricity_score`, `water_score`, `waste_score`, `total_score`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 12, 2025, 80, 40, 60, 60, 'Cukup', '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(2, 2, 1, 2026, 80, 80, 60, 73, 'Baik', '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(3, 2, 2, 2026, 80, 60, 80, 73, 'Baik', '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(4, 2, 3, 2026, 60, 40, 60, 53, 'Perlu Ditingkatkan', '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(5, 2, 4, 2026, 60, 40, 60, 53, 'Perlu Ditingkatkan', '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(6, 2, 5, 2026, 100, 100, 60, 87, 'Sangat Ramah Lingkungan', '2026-05-12 22:54:37', '2026-05-12 23:28:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `electricity_usages`
--

CREATE TABLE `electricity_usages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `kwh` decimal(10,2) NOT NULL,
  `cost` decimal(15,2) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `electricity_usages`
--

INSERT INTO `electricity_usages` (`id`, `user_id`, `month`, `year`, `kwh`, `cost`, `notes`, `created_at`, `updated_at`) VALUES
(1, 2, 12, 2025, 115.00, 172500.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(2, 2, 1, 2026, 148.00, 222000.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(3, 2, 2, 2026, 134.00, 201000.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(4, 2, 3, 2026, 192.00, 288000.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(5, 2, 4, 2026, 152.00, 228000.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(6, 2, 5, 2026, 0.15, 50000.00, NULL, '2026-05-12 22:54:37', '2026-05-12 23:28:10');

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
-- Struktur dari tabel `landing_page_settings`
--

CREATE TABLE `landing_page_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `label` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'image',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `landing_page_settings`
--

INSERT INTO `landing_page_settings` (`id`, `key`, `value`, `label`, `type`, `created_at`, `updated_at`) VALUES
(1, 'hero_image', 'https://img.freepik.com/free-vector/dashboard-interface-user-panel-template-with-charts-data-analysis_107791-3142.jpg', 'Gambar Hero Utama', 'image', '2026-05-13 02:40:58', '2026-05-13 02:40:58'),
(2, 'ai_assistant_image', 'https://images.unsplash.com/photo-1675557009875-436f297b9a6e?auto=format&fit=crop&q=80&w=800', 'Gambar AI Assistant', 'image', '2026-05-13 02:40:58', '2026-05-13 02:40:58'),
(3, 'ai_insight_image', 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=800', 'Gambar AI Insight', 'image', '2026-05-13 02:40:58', '2026-05-13 02:40:58'),
(4, 'electricity_image', 'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?auto=format&fit=crop&q=80&w=800', 'Gambar Fitur Listrik', 'image', '2026-05-13 02:40:58', '2026-05-13 02:40:58'),
(5, 'water_image', 'https://images.unsplash.com/photo-1548839140-29a749e1cf4d?auto=format&fit=crop&q=80&w=800', 'Gambar Fitur Air', 'image', '2026-05-13 02:40:58', '2026-05-13 02:40:58'),
(6, 'waste_image', 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&q=80&w=800', 'Gambar Fitur Sampah', 'image', '2026-05-13 02:40:58', '2026-05-13 02:40:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `landing_problems`
--

CREATE TABLE `landing_problems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `icon_class` varchar(255) DEFAULT NULL,
  `bg_color_class` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `landing_problems`
--

INSERT INTO `landing_problems` (`id`, `title`, `description`, `image_path`, `icon_class`, `bg_color_class`, `created_at`, `updated_at`) VALUES
(1, 'Boros Listrik', 'Penggunaan perangkat elektronik yang tidak efisien menyebabkan tagihan membengkak dan emisi karbon tinggi.', 'problems/GUygqATOriarQYyFNYnpXl6zkpakS9K40WLHuRF5.jpg', 'fas fa-bolt', 'yellow', '2026-05-13 03:06:58', '2026-05-13 03:08:27'),
(2, 'Pemakaian Air Berlebih', 'Kebocoran kran dan penggunaan air yang tidak terkontrol mengancam ketersediaan sumber daya air bersih.', NULL, 'fas fa-tint', 'blue', '2026-05-13 03:06:58', '2026-05-13 03:06:58'),
(3, 'Sampah Tak Terkelola', 'Sampah rumah tangga yang tidak dipilah menumpuk di TPA dan mencemari ekosistem lingkungan sekitar.', NULL, 'fas fa-trash-alt', 'red', '2026-05-13 03:06:58', '2026-05-13 03:06:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `landing_settings`
--

CREATE TABLE `landing_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hero_title` varchar(255) DEFAULT NULL,
  `hero_subtitle` text DEFAULT NULL,
  `hero_image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `landing_settings`
--

INSERT INTO `landing_settings` (`id`, `hero_title`, `hero_subtitle`, `hero_image_path`, `created_at`, `updated_at`) VALUES
(1, 'tampilan', 'bagus', 'landing/zhbM4XjbdgU41mGlxEMN0A92C6y1NoWk6g7AlbfU.png', '2026-05-13 02:52:42', '2026-05-13 03:02:16');

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
(4, '2026_05_13_100001_modify_users_table', 1),
(5, '2026_05_13_100002_create_electricity_usages_table', 1),
(6, '2026_05_13_100003_create_water_usages_table', 1),
(7, '2026_05_13_100004_create_waste_records_table', 1),
(8, '2026_05_13_100005_create_eco_scores_table', 1),
(9, '2026_05_13_100006_create_tips_table', 1),
(10, '2026_05_13_100007_create_challenges_table', 1),
(11, '2026_05_13_100008_create_user_challenges_table', 1),
(12, '2026_05_13_100009_create_badges_table', 1),
(13, '2026_05_13_100010_create_user_badges_table', 1),
(14, '2026_05_13_100011_create_monthly_targets_table', 1),
(15, '2026_05_13_200001_create_ai_tables', 2),
(16, '2026_05_13_300001_create_landing_page_settings_table', 3),
(17, '2026_05_13_300001_create_landing_settings_table', 4),
(18, '2026_05_13_300002_create_landing_problems_table', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `monthly_targets`
--

CREATE TABLE `monthly_targets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `target_electricity_kwh` decimal(10,2) DEFAULT NULL,
  `target_water_m3` decimal(10,2) DEFAULT NULL,
  `target_waste_kg` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `tips`
--

CREATE TABLE `tips` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tips`
--

INSERT INTO `tips` (`id`, `title`, `category`, `content`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'Gunakan lampu LED', 'Listrik', 'Lampu LED jauh lebih hemat energi dan tahan lama dibanding lampu pijar atau CFL.', 1, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(3, 'Matikan kran saat tidak dipakai', 'Air', 'Jangan biarkan air mengalir saat menggosok gigi atau menyabuni tangan.', 1, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(4, 'Gunakan botol minum sendiri', 'Sampah', 'Mengurangi penggunaan botol plastik sekali pakai sangat membantu mengurangi beban sampah plastik.', 1, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(5, 'Pisahkan sampah organik dan plastik', 'Sampah', 'Pemisahan sampah memudahkan proses daur ulang dan pembuatan kompos.', 1, '2026-05-12 22:54:37', '2026-05-12 22:54:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `address`, `phone`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin EcoTrack', 'admin@ecotrack.test', NULL, '$2y$12$OHI4Mdim/QK6XLpL3aL4TOCUO3aEU4cKRMNdxm6SSyl6AQ1z.oAyq', 'admin', NULL, NULL, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(2, 'Rafa Izaz', 'user@ecotrack.test', NULL, '$2y$12$8iUS5n2ao.ISBV9hZnoACuEk8w0OWV4RpMxq.mmw2CxoJ8VAcZL02', 'user', 'Jl. Hijau No. 123', '08123456789', NULL, '2026-05-12 22:54:37', '2026-05-12 23:27:12'),
(3, 'TRPL-Rapaaaaa', 'rafaizaz50@gmail.com', NULL, '$2y$12$Zeto5kKyvu/9wQ4Rnd0MYucu8aB/Ae5zm9nyOwq4mcT9x83Sh0rvC', 'user', NULL, NULL, NULL, '2026-05-12 23:42:04', '2026-05-12 23:42:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_badges`
--

CREATE TABLE `user_badges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `badge_id` bigint(20) UNSIGNED NOT NULL,
  `earned_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user_badges`
--

INSERT INTO `user_badges` (`id`, `user_id`, `badge_id`, `earned_at`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2026-05-12 23:28:10', '2026-05-12 23:28:10', '2026-05-12 23:28:10'),
(2, 2, 2, '2026-05-12 23:28:10', '2026-05-12 23:28:10', '2026-05-12 23:28:10'),
(3, 2, 3, '2026-05-12 23:28:10', '2026-05-12 23:28:10', '2026-05-12 23:28:10'),
(4, 2, 5, '2026-05-12 23:28:10', '2026-05-12 23:28:10', '2026-05-12 23:28:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_challenges`
--

CREATE TABLE `user_challenges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `challenge_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'ongoing',
  `progress` int(11) NOT NULL DEFAULT 0,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user_challenges`
--

INSERT INTO `user_challenges` (`id`, `user_id`, `challenge_id`, `status`, `progress`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'ongoing', 0, NULL, '2026-05-12 23:03:45', '2026-05-12 23:03:45'),
(2, 2, 2, 'ongoing', 0, NULL, '2026-05-12 23:28:41', '2026-05-12 23:28:41'),
(3, 2, 3, 'ongoing', 0, NULL, '2026-05-12 23:28:44', '2026-05-12 23:28:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `waste_records`
--

CREATE TABLE `waste_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `organic_kg` decimal(10,2) NOT NULL DEFAULT 0.00,
  `plastic_kg` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paper_kg` decimal(10,2) NOT NULL DEFAULT 0.00,
  `metal_kg` decimal(10,2) NOT NULL DEFAULT 0.00,
  `other_kg` decimal(10,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `waste_records`
--

INSERT INTO `waste_records` (`id`, `user_id`, `date`, `organic_kg`, `plastic_kg`, `paper_kg`, `metal_kg`, `other_kg`, `notes`, `created_at`, `updated_at`) VALUES
(1, 2, '2025-12-08', 4.00, 3.00, 0.00, 1.00, 0.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(2, 2, '2025-12-15', 5.00, 1.00, 0.00, 0.00, 0.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(3, 2, '2025-12-22', 2.00, 3.00, 2.00, 0.00, 1.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(4, 2, '2025-12-29', 4.00, 0.00, 1.00, 0.00, 1.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(5, 2, '2026-01-08', 4.00, 3.00, 0.00, 1.00, 1.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(6, 2, '2026-01-15', 5.00, 2.00, 1.00, 0.00, 1.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(7, 2, '2026-01-22', 3.00, 2.00, 0.00, 1.00, 1.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(8, 2, '2026-01-29', 3.00, 3.00, 1.00, 1.00, 0.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(9, 2, '2026-02-08', 3.00, 3.00, 0.00, 1.00, 0.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(10, 2, '2026-02-15', 3.00, 2.00, 0.00, 0.00, 0.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(11, 2, '2026-02-22', 3.00, 3.00, 1.00, 0.00, 1.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(12, 2, '2026-03-01', 1.00, 1.00, 2.00, 0.00, 1.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(13, 2, '2026-03-08', 5.00, 2.00, 2.00, 0.00, 0.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(14, 2, '2026-03-15', 2.00, 3.00, 1.00, 1.00, 0.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(15, 2, '2026-03-22', 5.00, 0.00, 0.00, 1.00, 0.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(16, 2, '2026-03-29', 2.00, 1.00, 1.00, 1.00, 0.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(17, 2, '2026-04-08', 2.00, 3.00, 1.00, 1.00, 1.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(18, 2, '2026-04-15', 3.00, 0.00, 0.00, 1.00, 1.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(19, 2, '2026-04-22', 3.00, 1.00, 2.00, 0.00, 1.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(20, 2, '2026-04-29', 1.00, 0.00, 0.00, 1.00, 1.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(21, 2, '2026-05-08', 2.00, 1.00, 0.00, 1.00, 1.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(22, 2, '2026-05-15', 3.00, 1.00, 2.00, 1.00, 0.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(23, 2, '2026-05-22', 3.00, 3.00, 1.00, 0.00, 0.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(24, 2, '2026-05-29', 2.00, 1.00, 1.00, 1.00, 1.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `water_usages`
--

CREATE TABLE `water_usages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `cubic_meter` decimal(10,2) NOT NULL,
  `cost` decimal(15,2) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `water_usages`
--

INSERT INTO `water_usages` (`id`, `user_id`, `month`, `year`, `cubic_meter`, `cost`, `notes`, `created_at`, `updated_at`) VALUES
(1, 2, 12, 2025, 21.00, 105000.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(2, 2, 1, 2026, 14.00, 70000.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(3, 2, 2, 2026, 20.00, 100000.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(4, 2, 3, 2026, 24.00, 120000.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(5, 2, 4, 2026, 25.00, 125000.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37'),
(6, 2, 5, 2026, 10.00, 50000.00, NULL, '2026-05-12 22:54:37', '2026-05-12 22:54:37');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ai_conversations`
--
ALTER TABLE `ai_conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ai_conversations_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `ai_insights`
--
ALTER TABLE `ai_insights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ai_insights_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `challenges`
--
ALTER TABLE `challenges`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `eco_scores`
--
ALTER TABLE `eco_scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eco_scores_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `electricity_usages`
--
ALTER TABLE `electricity_usages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `electricity_usages_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indeks untuk tabel `landing_page_settings`
--
ALTER TABLE `landing_page_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `landing_page_settings_key_unique` (`key`);

--
-- Indeks untuk tabel `landing_problems`
--
ALTER TABLE `landing_problems`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `landing_settings`
--
ALTER TABLE `landing_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `monthly_targets`
--
ALTER TABLE `monthly_targets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `monthly_targets_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `tips`
--
ALTER TABLE `tips`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `user_badges`
--
ALTER TABLE `user_badges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_badges_user_id_foreign` (`user_id`),
  ADD KEY `user_badges_badge_id_foreign` (`badge_id`);

--
-- Indeks untuk tabel `user_challenges`
--
ALTER TABLE `user_challenges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_challenges_user_id_foreign` (`user_id`),
  ADD KEY `user_challenges_challenge_id_foreign` (`challenge_id`);

--
-- Indeks untuk tabel `waste_records`
--
ALTER TABLE `waste_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `waste_records_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `water_usages`
--
ALTER TABLE `water_usages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `water_usages_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `ai_conversations`
--
ALTER TABLE `ai_conversations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `ai_insights`
--
ALTER TABLE `ai_insights`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `badges`
--
ALTER TABLE `badges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `challenges`
--
ALTER TABLE `challenges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `eco_scores`
--
ALTER TABLE `eco_scores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `electricity_usages`
--
ALTER TABLE `electricity_usages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `landing_page_settings`
--
ALTER TABLE `landing_page_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `landing_problems`
--
ALTER TABLE `landing_problems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `landing_settings`
--
ALTER TABLE `landing_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `monthly_targets`
--
ALTER TABLE `monthly_targets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tips`
--
ALTER TABLE `tips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_badges`
--
ALTER TABLE `user_badges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_challenges`
--
ALTER TABLE `user_challenges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `waste_records`
--
ALTER TABLE `waste_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `water_usages`
--
ALTER TABLE `water_usages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `ai_conversations`
--
ALTER TABLE `ai_conversations`
  ADD CONSTRAINT `ai_conversations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ai_insights`
--
ALTER TABLE `ai_insights`
  ADD CONSTRAINT `ai_insights_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `eco_scores`
--
ALTER TABLE `eco_scores`
  ADD CONSTRAINT `eco_scores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `electricity_usages`
--
ALTER TABLE `electricity_usages`
  ADD CONSTRAINT `electricity_usages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `monthly_targets`
--
ALTER TABLE `monthly_targets`
  ADD CONSTRAINT `monthly_targets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_badges`
--
ALTER TABLE `user_badges`
  ADD CONSTRAINT `user_badges_badge_id_foreign` FOREIGN KEY (`badge_id`) REFERENCES `badges` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_badges_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_challenges`
--
ALTER TABLE `user_challenges`
  ADD CONSTRAINT `user_challenges_challenge_id_foreign` FOREIGN KEY (`challenge_id`) REFERENCES `challenges` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_challenges_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `waste_records`
--
ALTER TABLE `waste_records`
  ADD CONSTRAINT `waste_records_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `water_usages`
--
ALTER TABLE `water_usages`
  ADD CONSTRAINT `water_usages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
