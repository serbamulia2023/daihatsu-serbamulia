-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Okt 2026 pada 02.13
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
-- Database: `serba_mulia_daihatsu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(190) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password_hash`, `created_at`) VALUES
(1, 'fadli', 'fadly.fauzi11@gmail.com', '$2y$10$rI7q1yxctnddVl/Pg7.9seC4sUyatwLLkB2C4ESrOmpdKW4sRX3SW', '2026-10-19 02:34:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(220) NOT NULL,
  `slug` varchar(240) NOT NULL,
  `category` varchar(100) NOT NULL DEFAULT 'Tips Mobil',
  `summary` text NOT NULL,
  `body` mediumtext NOT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `published_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `category`, `summary`, `body`, `image_url`, `is_published`, `published_at`, `created_at`) VALUES
(1, '4 Faktor Penyebab Kunci Mobil Tidak Bisa Dicabut', 'kunci-mobil-tidak-bisa-dicabut', 'Tips Mobil', 'Kenali 4 penyebabnya sebagai berikut :', 'Apakah Anda pernah mengalami masalah kunci mobil tidak bisa dicabut meski mesin mobil dalam keadaan mati? Pasti Anda langsung panik dan bingung ketika kondisi ini tiba-tiba terjadi.\r\nLalu bagaimana cara mengatasi ketika kunci tidak bisa dicabut? Apa saja faktor penyebabnya? Untuk info lebih lengkapnya, perhatikan ulasan berikut ini.\r\n\r\n1. Posisi Transmisi Belum Netral\r\nAgar kunci mobil bisa dicabut, maka tuas mobil harus tepat di posisi netral (N) atau posisi park (P). Hal ini berlaku pada mobil dengan transmisi manual.\r\n\r\nSedangkan pada mobil transmisi otomatis, ketika gigi diatur ke posisi netral, drive, atau lainnya maka kunci tidak akan bisa dilepas. Pastikan Anda tidak tergesa-gesa saat mencabut kunci. Cek terlebih dahulu posisi transmisi sebelum mencabut kunci. \r\n\r\n2. Kunci Bengkok atau Aus\r\nIntensitas pemakaian kunci mobil yang tinggi, serta terbiasa mencabut kunci dengan cara kasar menyebabkan kunci menjadi bengkok dan aus. Sehingga kunci akan sulit dicabut karena biasanya kunci retak. \r\n\r\n3. Silinder Kontak Bermasalah\r\nSilinder kontak bermasalah biasanya disebabkan oleh banyaknya tumpukan debu, serta pegas yang kurang sejajar. Sehingga kunci sulit dimasukkan dan dicabut.\r\n\r\n4. Terkuncinya Kemudi\r\nSistem pengunci kemudi sangat berguna untuk menjaga keamanan mobil sehingga mobil berjalan sendiri. Namun, jika kemudi mobil terkunci maka kunci mobil sulit dicabut. \r\n\r\n4 Cara Mengatasi Kunci Mobil yang Tidak Bisa Dicabut\r\nJika Anda mengalami kunci mobil susah dicabut, maka Anda tidak perlu panik berlebihan. Anda harus tetap tenang agar dapat berpikir jernih untuk mencari solusi permasalahan tersebut. Berikut beberapa cara yang bisa Anda praktikan.\r\n\r\n1. Pastikan Transmisi Mobil Pada Posisi yang Tepat\r\nSeperti penjelasan di atas cara mencabut kunci mobil matic yang terkunci yaitu harus pada posisi netral dulu. Apabila posisi transmisi kurang tepat maka kunci tidak bisa dicabut. Sebaiknya Anda cek terlebih dahulu apakah posisi park atau netral sudah tepat.\r\n\r\n2. Cek Rem Tangan\r\nPastikan Anda mengecek kondisi rem tangan, jangan sampai mobil berjalan sendiri ketika Anda sedang mencoba mencabut kunci. \r\n\r\n3. Tekan Kunci Perlahan dan Putar Setir Sedikit\r\nSelanjutnya, Anda bisa menekan kunci dan memutar sedikit setir ke arah kanan dan kiri. Hal tersebut dilakukan guna mencari celah agar kunci bisa diputar. \r\n\r\n4. Beri Pelumas pada Silinder Kontak\r\nSelanjutnya, Anda bisa memberikan pelumas pada bagian silinder kontak. Agar kunci mudah dimasukkan dan dicabut.\r\nSemprot bagian silinder kontak dengan pelumas biarkan selama 2-5 menit, kemudian coba masukkan kunci, putar dan cabut. Ulangi untuk beberapa kali. Kunci yang tidak bisa dicabut biasanya karena kondisi silinder kotak tersumbat debu dan kotor. \r\n\r\nDemikian beberapa cara dan solusi jika kunci mobil Anda tidak bisa dicabut. Sangat mudah bukan? Nah, untuk menghindari permasalahan tersebut, pastikan Anda selalu rutin melakukan perawatan mobil secara berkala. Anda bisa melakukan perawatan secara mandiri atau membawanya ke bengkel resmi atau dealer Daihatsu terdekat.', 'https://res.cloudinary.com/x5qql7pc/image/upload/v1792384014/Kunci_susah_dicabut.jpg', 1, '2026-10-19 09:32:00', '2026-10-19 02:32:00'),
(2, 'Daihatsu Fellow, kei car dengan bodi yang simpel', 'daihatsu-fellow', 'Retromotive', 'mobil Jepang pertama yang menggunakan lampu depan berbentuk persegi panjang.', 'Kalau ngomongin mobil kecil zaman sekarang, mungkin yang kepikiran adalah mobil yang praktis dan irit.\r\nTapi sekitar 60 tahun lalu, Daihatsu sudah punya mobil kecil yang cukup menarik perhatian.\r\nNamanya... Daihatsu Fellow.\r\n\r\nDiperkenalkan pada 1966, Fellow hadir sebagai mobil kecil atau kei car dengan bodi yang simpel, tapi ternyata punya beberapa hal yang cukup menarik.\r\n\r\nDi balik kapnya ada mesin 356 cc, dua silinder, dua langkah, dengan tenaga awal 23 PS dan transmisi manual empat percepatan.\r\nKecil? Jelas.\r\nTapi jangan langsung anggap remeh.\r\n\r\nFellow punya satu hal yang cukup unik untuk zamannya.\r\nMobil ini menjadi mobil Jepang pertama yang menggunakan lampu depan berbentuk persegi panjang.\r\n\r\nDan ternyata, Fellow bukan cuma hadir sebagai sedan.\r\nAda juga versi van, pickup, sampai panel van.\r\nJadi satu mobil kecil ini bisa dipakai untuk kebutuhan yang berbeda-beda.\r\n\r\nLalu, memasuki akhir 1960-an, Fellow mulai mendapatkan beberapa pembaruan.\r\nBahkan muncul Fellow SS, dengan mesin yang sudah menghasilkan 32 PS dan mampu mencapai sekitar 115 kilometer per jam.\r\n\r\nSetelah itu, pada 1970, lahirlah penerusnya: Fellow Max.\r\nNamanya masih membawa \'Fellow\', tapi kali ini dengan perubahan besar—penggerak roda depan dan pilihan bodi yang semakin beragam, termasuk sedan, van, dan kemudian coupe.”\r\n\r\nDari Fellow sampai Fellow Max, kelihatan bagaimana mobil kecil ini ikut berkembang mengikuti zamannya.\r\nTulis di komentar mobil Daihatsu jadul apa lagi yang harus kita bahas di Serba Mulia Retromotive berikutnya!', 'https://res.cloudinary.com/x5qql7pc/image/upload/v1792384932/Fellow.jpg', 1, '2026-10-19 09:32:00', '2026-10-19 02:32:00'),
(3, 'SIM A Untuk Pengendara Apa?', 'sim-a-untuk-pengendara-apa', 'Ensiklomotive', 'Jenis SIM A umumnya digunakan untuk mobil pribadi yang digunakan untuk kebutuhan sehari-hari.', 'Kalau kamu punya SIM A... berarti boleh nyetir semua mobil? Eits... belum tentu.\r\nyang menentukan itu bukan bentuk mobilnya, tapi kategori dan berat kendaraannya.\r\nselamat datang di Ensiklomotive, belajar otomotif Bersama serba mulia auto.\r\nSIM A diperuntukkan buat mobil penumpang dan mobil barang dengan jumlah berat yang diizinkan sampai tiga ribu lima ratus kilogram.\r\nMakanya mobil seperti Ayla, Sigra, Xenia, Rocky, sampai Gran Max Pick Up umumnya masih bisa dikendarai pakai SIM A.\r\nTapi yang sering bikin orang salah paham. Banyak yang mengira kalau mobilnya besar pasti butuh SIM yang lebih tinggi. Padahal belum tentu. Yang jadi patokan itu jumlah berat kendaraan yang diizinkan, bukan apakah mobilnya sedan, SUV, atau pick up.\r\nAda lagi yang menarik. Mobil yang sama ternyata bisa butuh SIM yang berbeda. Kalau dipakai buat kendaraan pribadi, cukup SIM A. Tapi kalau digunakan sebagai angkutan umum, misalnya taksi atau travel, pengemudinya wajib punya SIM A Umum.\r\nDan buat yang bercita-cita jadi pengemudi kendaraan umum, SIM A Umum juga nggak bisa langsung dibuat.\r\nKamu harus berusia minimal 20 tahun dan sudah punya SIM A selama minimal satu tahun.\r\nJadi sekarang sudah tahu ya.\r\nYang menentukan golongan SIM bukan cuma jenis mobilnya, tapi juga berat dan peruntukan kendaraannya.\r\nSampai jumpa di Ensiklomotive selanjutnya, belajar otomotif Bersama serba mulia auto.', 'https://res.cloudinary.com/x5qql7pc/image/upload/v1792384654/SIM_A.jpg', 1, '2026-10-19 09:32:00', '2026-10-19 02:32:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `branches`
--

CREATE TABLE `branches` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `slug` varchar(140) NOT NULL,
  `region` varchar(120) NOT NULL DEFAULT '',
  `address` text DEFAULT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `whatsapp` varchar(40) DEFAULT NULL,
  `facebook_url` varchar(500) DEFAULT NULL,
  `instagram_url` varchar(500) DEFAULT NULL,
  `tiktok_url` varchar(500) DEFAULT NULL,
  `maps_url` varchar(500) DEFAULT NULL,
  `hours` text DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `branches`
--

INSERT INTO `branches` (`id`, `name`, `slug`, `region`, `address`, `image_url`, `description`, `whatsapp`, `facebook_url`, `instagram_url`, `tiktok_url`, `maps_url`, `hours`, `sort_order`, `is_active`, `created_at`) VALUES
(1, 'Samarinda', 'daihatsu-samarinda', 'KALIMANTAN TIMUR', 'Jl. PM. Noor Kel No.8, Sempaja Sel., Kec. Samarinda Utara, Kota Samarinda, Kalimantan Timur 75243', 'https://res.cloudinary.com/x5qql7pc/image/upload/v1792379571/Samarinda.png', 'Hubungi cabang Samarinda untuk informasi unit, penjualan, dan layanan.', '6282298669527', NULL, 'https://www.instagram.com/daihatsusamarinda_sma/', NULL, 'https://maps.app.goo.gl/DEt1h9xnrkf31Wpp9', 'Senin \r\n08.00–16.00\r\nSelasa \r\n08.00–16.00\r\nRabu \r\n08.00–16.00\r\nKamis \r\n08.00–16.00\r\nJumat \r\n08.00–16.00\r\nSabtu \r\n08.00–16.00\r\nMinggu \r\n08.00–16.00', 1, 1, '2026-10-19 02:32:00'),
(2, 'Balikpapan', 'daihatsu-balikpapan', 'KALIMANTAN TIMUR', 'Jl. Mayjend Sutoyo No.9, Klandasan Ilir, Kec. Balikpapan Kota, Kota Balikpapan, Kalimantan Timur 76113', 'https://res.cloudinary.com/x5qql7pc/image/upload/v1792381859/Daihatsu_Balikpapan.jpg', 'Temukan dealer, sales, service, dan sparepart Daihatsu di Balikpapan.', '6282190733285', NULL, NULL, NULL, 'https://maps.app.goo.gl/nbQ1Sn8RA9F52wXX8', 'Senin\r\n08.00–18.00\r\nSelasa\r\n08.00–18.00\r\nRabu\r\n08.00–18.00\r\nKamis\r\n08.00–18.00\r\nJumat\r\n08.00–18.00\r\nSabtu\r\n08.00–18.00\r\nMinggu\r\n08.00–18.00', 2, 1, '2026-10-19 02:32:00'),
(3, 'Paser', 'daihatsu-paser', 'KALIMANTAN TIMUR', 'Jl. Rm. Noto Sunardi, RT.006/RW.005, Tanah Grogot, Kec. Tanah Grogot, Kabupaten Paser, Kalimantan Timur 76251', 'https://res.cloudinary.com/x5qql7pc/image/upload/v1792380113/Paser.jpg', 'Layanan Daihatsu untuk kebutuhan masyarakat Paser dan sekitarnya.', '6282136023700', NULL, NULL, NULL, 'https://maps.app.goo.gl/8D7uxB5aDcu5T4hH6', 'Senin\r\n08.15–16.15\r\nSelasa\r\n08.15–16.15\r\nRabu\r\n08.15–16.15\r\nKamis\r\n08.15–16.15\r\nJumat\r\n08.15–16.15\r\nSabtu\r\n08.15–12.30\r\nMinggu\r\nTutup', 3, 1, '2026-10-19 02:32:00'),
(4, 'Jayapura', 'daihatsu-jayapura', 'PAPUA', 'Jl. Raya Abepura, Entrop, Distrik Jayapura Selatan, Kota Jayapura, Papua 99224', 'https://res.cloudinary.com/x5qql7pc/image/upload/v1792380536/Daihatsu_jayapura.jpg', 'Dealer Daihatsu untuk kebutuhan mobilitas di Jayapura.', '6281247126016', NULL, NULL, NULL, 'https://maps.app.goo.gl/gkYUVjC4ZAFjEgzC8', 'Senin\r\n08.15–16.15\r\nSelasa\r\n08.15–16.15\r\nRabu\r\n08.15–16.15\r\nKamis\r\n08.15–16.15\r\nJumat\r\n08.15–16.15\r\nSabtu\r\n08.15–12.30\r\nMinggu\r\nTutup', 4, 1, '2026-10-19 02:32:00'),
(5, 'Sorong', 'daihatsu-sorong', 'PAPUA BARAT DAYA', 'Klasabi, Kecamatan Sorong Manoi, Kota Sorong, Papua Barat Daya 98412', 'https://res.cloudinary.com/x5qql7pc/image/upload/v1792380889/Daihatsu_Sorong.jpg', 'Temukan pilihan mobil dan layanan Daihatsu di Sorong.', '6281247955055', NULL, NULL, NULL, 'https://maps.app.goo.gl/HYLi9Q6q3FUxBGfj8', 'Senin\r\n08.15–17.00\r\nSelasa\r\n08.15–17.00\r\nRabu\r\n08.15–17.00\r\nKamis\r\n08.15–17.00\r\nJumat\r\n08.15–17.00\r\nSabtu\r\n08.15–17.00\r\nMinggu\r\n13.00–17.00', 5, 1, '2026-10-19 02:32:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cars`
--

CREATE TABLE `cars` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `slug` varchar(160) DEFAULT NULL,
  `category` varchar(120) NOT NULL DEFAULT '',
  `description` text DEFAULT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `contact_url` varchar(500) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cars`
--

INSERT INTO `cars` (`id`, `name`, `slug`, `category`, `description`, `image_url`, `contact_url`, `sort_order`, `is_active`, `created_at`) VALUES
(1, 'Daihatsu Ayla', NULL, 'City Car', 'Pilihan ringkas untuk mobilitas harian.', 'https://res.cloudinary.com/x5qql7pc/image/upload/v1792382223/Ayla.jpg', NULL, 1, 1, '2026-10-19 02:32:00'),
(2, 'Daihatsu Sigra', NULL, 'MPV Keluarga', 'Pilihan untuk kebutuhan keluarga.', 'https://res.cloudinary.com/x5qql7pc/image/upload/v1792382357/Sigra.jpg', NULL, 2, 1, '2026-10-19 02:32:00'),
(3, 'Daihatsu Xenia', NULL, 'MPV Keluarga', 'Teman perjalanan bersama keluarga.', 'https://res.cloudinary.com/x5qql7pc/image/upload/v1792382495/Xenia.jpg', NULL, 3, 1, '2026-10-19 02:32:00'),
(4, 'Daihatsu Terios', NULL, 'SUV', 'SUV untuk aktivitas sehari-hari dan perjalanan.', 'https://res.cloudinary.com/x5qql7pc/image/upload/v1792382811/Terios.jpg', NULL, 4, 1, '2026-10-19 02:32:00'),
(5, 'Daihatsu Rocky', NULL, 'SUV Compact', 'SUV compact dengan gaya modern.', 'https://res.cloudinary.com/x5qql7pc/image/upload/v1792382966/Rocky.jpg', NULL, 5, 1, '2026-10-19 02:32:00'),
(6, 'Gran Max Mini Bus', NULL, 'Niaga', 'Pilihan kendaraan untuk mendukung usaha.', 'https://res.cloudinary.com/x5qql7pc/image/upload/v1792383084/GranMax_MB.jpg', NULL, 6, 1, '2026-10-19 02:32:00'),
(7, 'Daihatsu Luxio', NULL, 'MPV', 'MPV untuk kebutuhan mobilitas.', 'https://res.cloudinary.com/x5qql7pc/image/upload/v1792383212/Luxio.jpg', NULL, 7, 1, '2026-10-19 02:32:00'),
(8, 'Gran Max Pick Up', NULL, 'Mobil Usaha', 'Kendaraan niaga untuk berbagai kebutuhan bisnis.', 'https://res.cloudinary.com/x5qql7pc/image/upload/v1792383293/Gran_Max_PU.jpg', NULL, 8, 1, '2026-10-19 02:32:00'),
(9, 'Daihatsu Rocky Hybrid', NULL, 'SUV Compact', 'Believe In Real', 'https://res.cloudinary.com/x5qql7pc/image/upload/v1792383508/Rocky_Hybrid.jpg', NULL, 9, 1, '2026-10-19 04:18:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `car_colors`
--

CREATE TABLE `car_colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `variant_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `color_code` varchar(20) DEFAULT NULL,
  `image_url` varchar(500) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `car_specifications`
--

CREATE TABLE `car_specifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `variant_id` int(10) UNSIGNED NOT NULL,
  `spec_group` varchar(120) NOT NULL DEFAULT 'Umum',
  `spec_name` varchar(160) NOT NULL,
  `spec_value` text NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `car_variants`
--

CREATE TABLE `car_variants` (
  `id` int(10) UNSIGNED NOT NULL,
  `car_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(160) NOT NULL,
  `transmission` varchar(100) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `car_variants`
--

INSERT INTO `car_variants` (`id`, `car_id`, `name`, `transmission`, `price`, `description`, `sort_order`, `is_active`, `created_at`) VALUES
(1, 1, '1.0 X', 'CVT', NULL, 'Daihatsu Ayla adalah mobil hatchback perkotaan di kelas LCGC (Low Cost Green Car) generasi kedua yang menggunakan platform DNGA (Daihatsu New Global Architecture).', 3, 1, '2026-10-24 10:17:28'),
(2, 1, '1.0 M', 'MT', NULL, NULL, 2, 1, '2026-10-25 01:27:19'),
(3, 1, '1.0 X', 'MT', NULL, NULL, 1, 1, '2026-10-25 01:28:35'),
(4, 1, '1.2 R', 'MT', NULL, NULL, 4, 1, '2026-10-25 01:29:34'),
(5, 1, '1.2 R', 'CVT', NULL, NULL, 5, 1, '2026-10-25 01:30:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `promos`
--

CREATE TABLE `promos` (
  `id` int(10) UNSIGNED NOT NULL,
  `branch_id` int(10) UNSIGNED DEFAULT NULL,
  `contact_whatsapp` varchar(40) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `summary` text NOT NULL,
  `end_date` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image_url` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `promos`
--

INSERT INTO `promos` (`id`, `branch_id`, `contact_whatsapp`, `title`, `summary`, `end_date`, `is_active`, `created_at`, `image_url`) VALUES
(1, 2, '628177679074', 'Promo Akhir tahun All New Xenia', 'PROMO SPESIAL DAIHATSU\r\n\r\nDP MULAI Rp15 JUTA!\r\n\r\nBunga **0% — Tenor 1 Tahun**\r\natau\r\nDP mulai  10%  dengan tenor hingga 8 Tahun\r\n\r\nEXTRA BENEFIT\r\n- Free Jasa Servis & Oli hingga 50.000 KM / 4 Tahun\r\n- Free Asuransi All Risk selama 2 Tahun\r\n- Free Aksesori\r\n- Terima Tukar Tambah Semua Merek\r\n- Proses Kredit Cepat & Mudah\r\n\r\nMAU PUNYA MOBIL DAIHATSU?\r\nHubungi sekarang!\r\n\r\nTary Daihatsu\r\n📱 0817-7679-074\r\n\r\nSyarat dan ketentuan berlaku.', '2026-12-31', 1, '2026-10-19 08:01:48', 'https://res.cloudinary.com/x5qql7pc/image/upload/v1792397882/promo_xenia.jpg'),
(2, 3, NULL, 'Beli Mobil dan Service Dapat Es Krim', 'Kabar gembira bagi Anda warga Paser dan sekitarnya! Daihatsu Serba Mulia Auto Paser kembali menghadirkan program promosi menarik yang tidak boleh dilewatkan. Kali ini, setiap pelanggan yang melakukan pembelian unit mobil baru Daihatsu atau melakukan servis kendaraan di bengkel resmi Daihatsu Paser berhak mendapatkan satu porsi es krim Aice gratis. Program ini dirancang khusus untuk menambah keceriaan dan kenyamanan pelanggan saat berkunjung ke dealer Daihatsu, sambil menikmati berbagai penawaran spesial yang tersedia.\r\n\r\nSelain es krim gratis, Daihatsu Serba Mulia Auto Paser juga menawarkan kemudahan finansial yang sangat menarik. Anda bisa memiliki mobil Daihatsu impian seperti All New Ayla, All New Sigra, Daihatsu Rocky, atau model lainnya dengan Down Payment (DP) yang sangat ringan, mulai dari belasan juta rupiah saja. Bahkan, Anda bisa mengamankan unit mobil baru dengan tanda jadi hanya sebesar Rp500.000. Jangan lewatkan kesempatan emas ini untuk memiliki mobil baru dengan angsuran murah, proses yang mudah, dan layanan purna jual terbaik. Kunjungi segera dealer Daihatsu Serba Mulia Auto Paser di Jl. R.M. Noto Sunardi, Tanah Grogot, Paser, dan nikmati keuntungannya!', NULL, 1, '2026-10-22 04:18:28', 'https://res.cloudinary.com/x5qql7pc/image/upload/v1792642646/Gemini_Generated_Image_1fr4af1fr4af1fr4.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`setting_key`, `setting_value`) VALUES
('hero_text', 'Serba Mulia Auto hadir untuk menemani kebutuhan mobilitas Anda, mulai dari pembelian mobil, test drive, service hingga sparepart di berbagai kota.'),
('hero_title', 'Serba Mulia Auto Daihatsu.'),
('hq_email', 'serbamuliaauto.lt15@gmail.com'),
('hq_whatsapp', '6289646822137');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indeks untuk tabel `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indeks untuk tabel `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_cars_slug` (`slug`);

--
-- Indeks untuk tabel `car_colors`
--
ALTER TABLE `car_colors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_car_colors_variant_active_order` (`variant_id`,`is_active`,`sort_order`);

--
-- Indeks untuk tabel `car_specifications`
--
ALTER TABLE `car_specifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_car_specs_variant_group_order` (`variant_id`,`spec_group`,`sort_order`);

--
-- Indeks untuk tabel `car_variants`
--
ALTER TABLE `car_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_car_variants_car_active_order` (`car_id`,`is_active`,`sort_order`);

--
-- Indeks untuk tabel `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_promos_branch` (`branch_id`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`setting_key`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `car_colors`
--
ALTER TABLE `car_colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `car_specifications`
--
ALTER TABLE `car_specifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `car_variants`
--
ALTER TABLE `car_variants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `promos`
--
ALTER TABLE `promos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `car_colors`
--
ALTER TABLE `car_colors`
  ADD CONSTRAINT `fk_car_colors_variant` FOREIGN KEY (`variant_id`) REFERENCES `car_variants` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `car_specifications`
--
ALTER TABLE `car_specifications`
  ADD CONSTRAINT `fk_car_specifications_variant` FOREIGN KEY (`variant_id`) REFERENCES `car_variants` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `car_variants`
--
ALTER TABLE `car_variants`
  ADD CONSTRAINT `fk_car_variants_car` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `promos`
--
ALTER TABLE `promos`
  ADD CONSTRAINT `fk_promos_branch` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
