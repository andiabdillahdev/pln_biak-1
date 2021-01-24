-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jan 2021 pada 16.02
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pln_biak`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_01_01_123026_create_media_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_laporan`
--

CREATE TABLE `tb_laporan` (
  `id` int(11) NOT NULL,
  `id_users` int(11) UNSIGNED NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Dalam Proses',
  `progres` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_laporan`
--

INSERT INTO `tb_laporan` (`id`, `id_users`, `alamat`, `perihal`, `status`, `progres`, `created_at`, `updated_at`) VALUES
(1, 2, 'Jl. Poros Sumbbarrang, Gowa', 'Sembarang mo', 'Dalam Proses', 0, '2021-01-01 09:24:12', '2021-01-10 06:52:17'),
(2, 2, 'Jl. Sultan Alauddin', 'Tes Again', 'Dalam Proses', 0, '2021-01-01 09:26:16', '2021-01-10 06:52:07'),
(3, 3, 'Jl. Antang Raya', 'Lagi Tes', 'Dalam Proses', 0, '2021-01-01 09:28:40', '2021-01-10 06:51:54'),
(4, 2, 'Jl. Borong Palalla', 'Apapun itu, ini hanya tes', 'Dalam Proses', 0, '2021-01-05 00:38:54', '2021-01-10 06:51:44'),
(5, 3, 'Jl. Antang Raya', 'All of the test', 'Dalam Proses', 0, '2021-01-05 00:43:12', '2021-01-10 06:51:32'),
(6, 3, 'Jl. Sudiang Raya', 'Test Again Every Time', 'Dalam Proses', 0, '2021-01-05 01:49:38', '2021-01-05 01:49:38'),
(7, 2, 'Jl. Testing', 'Only Testing', 'Ditinjau', 20, '2021-01-06 08:15:49', '2021-01-10 06:08:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_media`
--

CREATE TABLE `tb_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `laporan_id` int(11) NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_media`
--

INSERT INTO `tb_media` (`id`, `laporan_id`, `foto`, `created_at`, `updated_at`) VALUES
(1, 1, 'img_laporan_01609521852.jpg', '2021-01-01 09:24:12', '2021-01-01 09:24:12'),
(2, 2, 'img_laporan_01609521976.jpg', '2021-01-01 09:26:16', '2021-01-01 09:26:16'),
(3, 2, 'img_laporan_11609521976.jpg', '2021-01-01 09:26:16', '2021-01-01 09:26:16'),
(4, 3, 'img_laporan_01609522120.png', '2021-01-01 09:28:40', '2021-01-01 09:28:40'),
(5, 3, 'img_laporan_11609522120.png', '2021-01-01 09:28:40', '2021-01-01 09:28:40'),
(6, 3, 'img_laporan_21609522121.png', '2021-01-01 09:28:41', '2021-01-01 09:28:41'),
(7, 4, 'img_laporan_01609835934.jpg', '2021-01-05 00:38:54', '2021-01-05 00:38:54'),
(8, 4, 'img_laporan_11609835934.jpg', '2021-01-05 00:38:54', '2021-01-05 00:38:54'),
(9, 5, 'img_laporan_01609836192.png', '2021-01-05 00:43:12', '2021-01-05 00:43:12'),
(10, 5, 'img_laporan_11609836192.png', '2021-01-05 00:43:12', '2021-01-05 00:43:12'),
(11, 6, 'img_laporan_01609840178.png', '2021-01-05 01:49:38', '2021-01-05 01:49:38'),
(12, 6, 'img_laporan_11609840179.png', '2021-01-05 01:49:39', '2021-01-05 01:49:39'),
(13, 7, 'img_laporan_01609949750.jpg', '2021-01-06 08:15:50', '2021-01-06 08:15:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin panel', 'admin@gmail.com', 'admin', NULL, '$2y$10$R.68uBKUq.FKMIw/AOXzwORWgzhVlQbg6t9EG5X/V6xKbmmuSqBpu', NULL, '2020-12-22 02:14:26', '2020-12-22 02:14:26'),
(2, 'agung azhari', 'agungazhari@gmail.com', 'agent', NULL, '$2y$10$NLcHm5ZvbxYZkR.AVJJUf.VXsCfaZZme7eEZSJT4megXM225qVbm2', NULL, '2020-12-23 19:31:01', '2020-12-23 19:31:01'),
(3, 'agent', 'andiabdilah004@gmail.com', 'agent', NULL, '$2y$10$8IGxud/o9zW.j8zgusC9Kuk6vm1Cog4uAmdsP9E7bptVFeNxkjDBC', NULL, '2020-12-23 19:31:02', '2021-01-06 08:48:43');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `tb_laporan`
--
ALTER TABLE `tb_laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`);

--
-- Indeks untuk tabel `tb_media`
--
ALTER TABLE `tb_media`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_laporan`
--
ALTER TABLE `tb_laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_media`
--
ALTER TABLE `tb_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
