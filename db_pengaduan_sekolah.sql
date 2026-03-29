-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table db_pengaduan_sekolah.admin
DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_pengaduan_sekolah.admin: ~2 rows (approximately)
INSERT INTO `admin` (`username`, `nama`, `password`) VALUES
	('admin', 'Administrator', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
	('admin1', 'Administrator', '$2y$12$HHF1FwvXR5GXVdW.29Rs0eplrnjOZU88qJzJlw.kYOkr3ptZfHtOO');

-- Dumping structure for table db_pengaduan_sekolah.aspirasi
DROP TABLE IF EXISTS `aspirasi`;
CREATE TABLE IF NOT EXISTS `aspirasi` (
  `id_aspirasi` int unsigned NOT NULL AUTO_INCREMENT,
  `id_pelaporan` int unsigned NOT NULL,
  `status` enum('Menunggu','Proses','Selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Menunggu',
  `feedback` text COLLATE utf8mb4_unicode_ci,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_aspirasi`),
  KEY `aspirasi_id_pelaporan_foreign` (`id_pelaporan`),
  CONSTRAINT `aspirasi_id_pelaporan_foreign` FOREIGN KEY (`id_pelaporan`) REFERENCES `input_aspirasi` (`id_pelaporan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_pengaduan_sekolah.aspirasi: ~0 rows (approximately)
INSERT INTO `aspirasi` (`id_aspirasi`, `id_pelaporan`, `status`, `feedback`, `updated_at`) VALUES
	(1, 1, 'Proses', 'bakalan diselesain', '2026-03-28 10:24:51');

-- Dumping structure for table db_pengaduan_sekolah.input_aspirasi
DROP TABLE IF EXISTS `input_aspirasi`;
CREATE TABLE IF NOT EXISTS `input_aspirasi` (
  `id_pelaporan` int unsigned NOT NULL AUTO_INCREMENT,
  `nis` int unsigned NOT NULL,
  `id_kategori` int unsigned NOT NULL,
  `lokasi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `is_anonim` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pelaporan`),
  KEY `input_aspirasi_nis_foreign` (`nis`),
  KEY `input_aspirasi_id_kategori_foreign` (`id_kategori`),
  CONSTRAINT `input_aspirasi_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `input_aspirasi_nis_foreign` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_pengaduan_sekolah.input_aspirasi: ~0 rows (approximately)
INSERT INTO `input_aspirasi` (`id_pelaporan`, `nis`, `id_kategori`, `lokasi`, `keterangan`, `is_anonim`, `created_at`) VALUES
	(1, 5530001, 1, 'gedung 3', 'gfg', 0, '2026-03-28 10:13:16');

-- Dumping structure for table db_pengaduan_sekolah.kategori
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int unsigned NOT NULL AUTO_INCREMENT,
  `ket_kategori` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_pengaduan_sekolah.kategori: ~0 rows (approximately)
INSERT INTO `kategori` (`id_kategori`, `ket_kategori`) VALUES
	(1, 'Fasilitas'),
	(2, 'Kebersihan'),
	(3, 'Keamanan'),
	(4, 'Pembelajaran');

-- Dumping structure for table db_pengaduan_sekolah.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_pengaduan_sekolah.migrations: ~6 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2026_03_28_054046_create_kategori_table', 1),
	(2, '2026_03_28_054308_create_siswa_table', 1),
	(3, '2026_03_28_054352_create_admin_table', 1),
	(4, '2026_03_28_054449_create_input_aspirasi_table', 1),
	(5, '2026_03_28_054530_create_aspirasi_table', 1),
	(6, '2026_03_28_084045_create_sessions_table', 2);

-- Dumping structure for table db_pengaduan_sekolah.sessions
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_pengaduan_sekolah.sessions: ~1 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('K3a0C7bmNU17wtCZY4sEhpuhN7yjIXFcGn77JTfI', 5530001, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRGpIakt6Q09JVlJ6VmhadG82YXZxRjRpTUt1c0xNSnNObWEybFEzQyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaXN3YS9hc3BpcmFzaSI7czo1OiJyb3V0ZSI7czoxNDoic2lzd2EuYXNwaXJhc2kiO31zOjUyOiJsb2dpbl9zaXN3YV81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU1MzAwMDE7fQ==', 1774693504);

-- Dumping structure for table db_pengaduan_sekolah.siswa
DROP TABLE IF EXISTS `siswa`;
CREATE TABLE IF NOT EXISTS `siswa` (
  `nis` int unsigned NOT NULL,
  `kelas` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`nis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_pengaduan_sekolah.siswa: ~0 rows (approximately)
INSERT INTO `siswa` (`nis`, `kelas`) VALUES
	(5530001, 'X RPL 1'),
	(5530002, 'XI TKJ 1'),
	(5530003, 'XII MM 1');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
