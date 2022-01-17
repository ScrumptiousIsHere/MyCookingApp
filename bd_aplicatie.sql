/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `categorie_retetas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `categorii_ingredients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tip` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `continut_ingredients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ingredient_id` bigint(20) unsigned NOT NULL,
  `nutrient_id` bigint(20) unsigned NOT NULL,
  `cantitate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `continut_ingredients_ingredient_id_foreign` (`ingredient_id`),
  KEY `continut_ingredients_nutrient_id_foreign` (`nutrient_id`),
  CONSTRAINT `continut_ingredients_ingredient_id_foreign` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`),
  CONSTRAINT `continut_ingredients_nutrient_id_foreign` FOREIGN KEY (`nutrient_id`) REFERENCES `nutrients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `continut_retetas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reteta_id` bigint(20) unsigned NOT NULL,
  `ingredient_id` bigint(20) unsigned NOT NULL,
  `cantitate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `continut_retetas_reteta_id_foreign` (`reteta_id`),
  KEY `continut_retetas_ingredient_id_foreign` (`ingredient_id`),
  CONSTRAINT `continut_retetas_ingredient_id_foreign` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`),
  CONSTRAINT `continut_retetas_reteta_id_foreign` FOREIGN KEY (`reteta_id`) REFERENCES `retetas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `favorits` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `reteta_id` bigint(20) unsigned NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `ingredients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nume` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UM` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorii_ingredient_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `ingredients_user_id_foreign` (`user_id`),
  CONSTRAINT `ingredients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `masas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `zi_id` bigint(20) unsigned NOT NULL,
  `reteta_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `nutrients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nume` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calorii` int(11) NOT NULL,
  `UM` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nutrients_nume_unique` (`nume`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `recipe_steps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Descriere` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reteta_id` bigint(20) unsigned NOT NULL,
  `nr_pas` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `report_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `reports` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `reteta_id` bigint(20) unsigned NOT NULL,
  `report_categories_id` bigint(20) unsigned NOT NULL,
  `motiv` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `retetas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `titlu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriere` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `durata_gatire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tip_masa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagine` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_visible` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `retetas_user_id_foreign` (`user_id`),
  CONSTRAINT `retetas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `reviews` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `continut` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nota` int(11) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `reteta_id` bigint(20) unsigned NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `chk_nota` CHECK (`nota` between 1 and 5)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenume` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_time` tinyint(1) NOT NULL DEFAULT 1,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `data_nasterii` date DEFAULT NULL,
  `greutate` int(11) DEFAULT NULL,
  `inaltime` int(11) DEFAULT NULL,
  `grad_activitate` int(11) DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  CONSTRAINT `chk_gr_activ` CHECK (`grad_activitate` between 1 and 5)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `zis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nume` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categorie_retetas` (`id`, `created_at`, `updated_at`, `tip`) VALUES
(1, NULL, NULL, 'Mic-dejun');
INSERT INTO `categorie_retetas` (`id`, `created_at`, `updated_at`, `tip`) VALUES
(2, NULL, NULL, 'Pranz');
INSERT INTO `categorie_retetas` (`id`, `created_at`, `updated_at`, `tip`) VALUES
(3, NULL, NULL, 'Cina');
INSERT INTO `categorie_retetas` (`id`, `created_at`, `updated_at`, `tip`) VALUES
(4, NULL, NULL, 'Gustare');

INSERT INTO `categorii_ingredients` (`id`, `created_at`, `updated_at`, `tip`) VALUES
(1, '2021-09-01 21:39:16', '2021-09-01 21:39:16', 'mezeluri');
INSERT INTO `categorii_ingredients` (`id`, `created_at`, `updated_at`, `tip`) VALUES
(2, '2021-09-01 21:39:16', '2021-09-01 21:39:16', 'carne');
INSERT INTO `categorii_ingredients` (`id`, `created_at`, `updated_at`, `tip`) VALUES
(3, '2021-09-01 21:39:16', '2021-09-01 21:39:16', 'peste');
INSERT INTO `categorii_ingredients` (`id`, `created_at`, `updated_at`, `tip`) VALUES
(4, '2021-09-01 21:39:16', '2021-09-01 21:39:16', 'legume/fructe'),
(5, '2021-09-01 21:39:16', '2021-09-01 21:39:16', 'seminte/nuci'),
(6, '2021-09-01 21:39:16', '2021-09-01 21:39:16', 'cereale'),
(7, '2021-09-01 21:39:16', '2021-09-01 21:39:16', 'condimente'),
(8, '2021-09-01 21:39:16', '2021-09-01 21:39:16', 'lactate'),
(9, '2021-09-01 21:39:16', '2021-09-01 21:39:16', 'branzeturi'),
(10, '2021-09-01 21:39:16', '2021-09-01 21:39:16', 'dulciuri'),
(11, '2021-09-01 21:39:16', '2021-09-01 21:39:16', 'bauturi'),
(12, '2021-09-01 21:39:16', '2021-09-01 21:39:16', 'semipreparate'),
(13, '2021-09-01 21:39:16', '2021-09-01 21:39:16', 'ready-to-eat'),
(14, '2021-09-01 21:39:16', '2021-09-01 21:39:16', 'uleioase'),
(15, '2021-09-01 21:39:16', '2021-09-01 21:39:16', 'sosuri'),
(16, '2021-09-01 21:39:16', '2021-09-01 21:39:16', 'paine'),
(17, '2021-09-01 21:39:16', '2021-09-01 21:39:16', 'gustari'),
(18, '2021-09-01 21:39:16', '2021-09-01 21:39:16', 'suplimente'),
(19, '2021-09-01 21:39:16', '2021-09-01 21:39:16', 'altele');

INSERT INTO `continut_ingredients` (`id`, `ingredient_id`, `nutrient_id`, `cantitate`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, '2021-09-01 21:39:16', '2021-09-01 21:39:16');
INSERT INTO `continut_ingredients` (`id`, `ingredient_id`, `nutrient_id`, `cantitate`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 5, '2021-09-01 21:39:16', '2021-09-01 21:39:16');
INSERT INTO `continut_ingredients` (`id`, `ingredient_id`, `nutrient_id`, `cantitate`, `created_at`, `updated_at`) VALUES
(3, 1, 7, 5, '2021-09-01 21:39:16', '2021-09-01 21:39:16');
INSERT INTO `continut_ingredients` (`id`, `ingredient_id`, `nutrient_id`, `cantitate`, `created_at`, `updated_at`) VALUES
(4, 1, 3, 2, '2021-09-01 21:39:16', '2021-09-01 21:39:16'),
(5, 1, 6, 1, '2021-09-01 21:39:16', '2021-09-01 21:39:16'),
(6, 2, 1, 8, '2021-09-01 21:39:16', '2021-09-01 21:39:16'),
(7, 2, 2, 76, '2021-09-01 21:39:16', '2021-09-01 21:39:16'),
(8, 2, 3, 2, '2021-09-01 21:39:16', '2021-09-01 21:39:16'),
(9, 2, 7, 25, '2021-09-01 21:39:16', '2021-09-01 21:39:16'),
(10, 2, 6, 1, '2021-09-01 21:39:16', '2021-09-01 21:39:16'),
(11, 2, 8, 9, '2021-09-01 21:39:16', '2021-09-01 21:39:16'),
(12, 2, 5, 440, '2021-09-01 21:39:16', '2021-09-01 21:39:16'),
(13, 3, 1, 1, '2021-09-01 21:51:24', '2021-09-01 21:51:24'),
(14, 3, 2, 2, '2021-09-01 21:51:24', '2021-09-01 21:51:24'),
(15, 3, 5, 1, '2021-09-01 21:51:24', '2021-09-01 21:51:24'),
(16, 3, 3, 1, '2021-09-01 21:51:24', '2021-09-01 21:51:24'),
(17, 3, 6, 1, '2021-09-01 21:51:25', '2021-09-01 21:51:25'),
(18, 3, 7, 1, '2021-09-01 21:51:25', '2021-09-01 21:51:25'),
(19, 3, 8, 1, '2021-09-01 21:51:25', '2021-09-01 21:51:25'),
(20, 3, 4, 1, '2021-09-01 21:51:25', '2021-09-01 21:51:25'),
(21, 4, 1, 10, '2021-09-02 07:25:25', '2021-09-02 07:25:25'),
(22, 4, 2, 6, '2021-09-02 07:25:25', '2021-09-02 07:25:25'),
(23, 4, 5, 1800, '2021-09-02 07:25:25', '2021-09-02 07:25:25'),
(24, 4, 3, 25, '2021-09-02 07:25:25', '2021-09-02 07:25:25'),
(25, 4, 6, 9, '2021-09-02 07:25:25', '2021-09-02 07:25:25'),
(26, 4, 7, 2, '2021-09-02 07:25:25', '2021-09-02 07:25:25'),
(27, 4, 8, 0, '2021-09-02 07:25:25', '2021-09-02 07:25:25'),
(28, 4, 4, 0, '2021-09-02 07:25:25', '2021-09-02 07:25:25'),
(29, 5, 1, 1, '2021-09-02 07:31:18', '2021-09-02 07:31:18'),
(30, 5, 2, 4, '2021-09-02 07:31:18', '2021-09-02 07:31:18'),
(31, 5, 5, 0, '2021-09-02 07:31:18', '2021-09-02 07:31:18'),
(32, 5, 3, 0, '2021-09-02 07:31:18', '2021-09-02 07:31:18'),
(33, 5, 6, 0, '2021-09-02 07:31:18', '2021-09-02 07:31:18'),
(34, 5, 7, 1, '2021-09-02 07:31:18', '2021-09-02 07:31:18'),
(35, 5, 8, 1, '2021-09-02 07:31:18', '2021-09-02 07:31:18'),
(36, 5, 4, 0, '2021-09-02 07:31:18', '2021-09-02 07:31:18'),
(37, 6, 1, 29, '2021-09-02 07:32:38', '2021-09-02 07:32:38'),
(38, 6, 2, 0, '2021-09-02 07:32:38', '2021-09-02 07:32:38'),
(39, 6, 5, 0, '2021-09-02 07:32:38', '2021-09-02 07:32:38'),
(40, 6, 3, 3, '2021-09-02 07:32:38', '2021-09-02 07:32:38'),
(41, 6, 6, 0, '2021-09-02 07:32:38', '2021-09-02 07:32:38'),
(42, 6, 7, 0, '2021-09-02 07:32:38', '2021-09-02 07:32:38'),
(43, 6, 8, 0, '2021-09-02 07:32:38', '2021-09-02 07:32:38'),
(44, 6, 4, 0, '2021-09-02 07:32:38', '2021-09-02 07:32:38'),
(45, 7, 1, 3, '2021-09-02 07:33:54', '2021-09-02 07:33:54'),
(46, 7, 2, 4, '2021-09-02 07:33:54', '2021-09-02 07:33:54'),
(47, 7, 5, 0, '2021-09-02 07:33:54', '2021-09-02 07:33:54'),
(48, 7, 3, 12, '2021-09-02 07:33:54', '2021-09-02 07:33:54'),
(49, 7, 6, 5, '2021-09-02 07:33:54', '2021-09-02 07:33:54'),
(50, 7, 7, 3, '2021-09-02 07:33:54', '2021-09-02 07:33:54'),
(51, 7, 8, 0, '2021-09-02 07:33:54', '2021-09-02 07:33:54'),
(52, 7, 4, 0, '2021-09-02 07:33:54', '2021-09-02 07:33:54'),
(53, 8, 1, 13, '2021-09-02 07:35:37', '2021-09-02 07:35:37'),
(54, 8, 2, 64, '2021-09-02 07:35:37', '2021-09-02 07:35:37'),
(55, 8, 5, 13, '2021-09-02 07:35:37', '2021-09-02 07:35:37'),
(56, 8, 3, 2, '2021-09-02 07:35:37', '2021-09-02 07:35:37'),
(57, 8, 6, 1, '2021-09-02 07:35:37', '2021-09-02 07:35:37'),
(58, 8, 7, 4, '2021-09-02 07:35:37', '2021-09-02 07:35:37'),
(59, 8, 8, 8, '2021-09-02 07:35:37', '2021-09-02 07:35:37'),
(60, 8, 4, 0, '2021-09-02 07:35:37', '2021-09-02 07:35:37'),
(61, 9, 1, 2, '2021-09-02 07:38:05', '2021-09-02 07:38:05'),
(62, 9, 2, 6, '2021-09-02 07:38:05', '2021-09-02 07:38:05'),
(63, 9, 5, 1200, '2021-09-02 07:38:05', '2021-09-02 07:38:05'),
(64, 9, 3, 8, '2021-09-02 07:38:05', '2021-09-02 07:38:05'),
(65, 9, 6, 3, '2021-09-02 07:38:05', '2021-09-02 07:38:05'),
(66, 9, 7, 0, '2021-09-02 07:38:05', '2021-09-02 07:38:05'),
(67, 9, 8, 1, '2021-09-02 07:38:05', '2021-09-02 07:38:05'),
(68, 9, 4, 0, '2021-09-02 07:38:05', '2021-09-02 07:38:05'),
(69, 10, 1, 13, '2021-09-02 07:52:28', '2021-09-02 07:52:28'),
(70, 10, 2, 39, '2021-09-02 07:52:28', '2021-09-02 07:52:28'),
(71, 10, 5, 20, '2021-09-02 07:52:28', '2021-09-02 07:52:28'),
(72, 10, 3, 1, '2021-09-02 07:52:28', '2021-09-02 07:52:28'),
(73, 10, 6, 0, '2021-09-02 07:52:28', '2021-09-02 07:52:28'),
(74, 10, 7, 8, '2021-09-02 07:52:28', '2021-09-02 07:52:28'),
(75, 10, 8, 10, '2021-09-02 07:52:28', '2021-09-02 07:52:28'),
(76, 10, 4, 0, '2021-09-02 07:52:28', '2021-09-02 07:52:28'),
(77, 11, 1, 3, '2021-09-02 19:01:14', '2021-09-02 19:01:14'),
(78, 11, 2, 3, '2021-09-02 19:01:14', '2021-09-02 19:01:14'),
(79, 11, 5, 0, '2021-09-02 19:01:14', '2021-09-02 19:01:14'),
(80, 11, 3, 0, '2021-09-02 19:01:14', '2021-09-02 19:01:14'),
(81, 11, 6, 0, '2021-09-02 19:01:14', '2021-09-02 19:01:14'),
(82, 11, 7, 0, '2021-09-02 19:01:14', '2021-09-02 19:01:14'),
(83, 11, 8, 1, '2021-09-02 19:01:14', '2021-09-02 19:01:14'),
(84, 11, 4, 0, '2021-09-02 19:01:14', '2021-09-02 19:01:14'),
(85, 12, 1, 25, '2021-09-02 19:01:59', '2021-09-02 19:01:59'),
(86, 12, 2, 1, '2021-09-02 19:01:59', '2021-09-02 19:01:59'),
(87, 12, 5, 100, '2021-09-02 19:01:59', '2021-09-02 19:01:59'),
(88, 12, 3, 19, '2021-09-02 19:01:59', '2021-09-02 19:01:59'),
(89, 12, 6, 6, '2021-09-02 19:01:59', '2021-09-02 19:01:59'),
(90, 12, 7, 1, '2021-09-02 19:01:59', '2021-09-02 19:01:59'),
(91, 12, 8, 0, '2021-09-02 19:01:59', '2021-09-02 19:01:59'),
(92, 12, 4, 0, '2021-09-02 19:01:59', '2021-09-02 19:01:59'),
(93, 13, 1, 26, '2021-09-02 19:02:45', '2021-09-02 19:02:45'),
(94, 13, 2, 2, '2021-09-02 19:02:45', '2021-09-02 19:02:45'),
(95, 13, 5, 100, '2021-09-02 19:02:45', '2021-09-02 19:02:45'),
(96, 13, 3, 13, '2021-09-02 19:02:45', '2021-09-02 19:02:45'),
(97, 13, 6, 0, '2021-09-02 19:02:45', '2021-09-02 19:02:45'),
(98, 13, 7, 0, '2021-09-02 19:02:45', '2021-09-02 19:02:45'),
(99, 13, 8, 0, '2021-09-02 19:02:45', '2021-09-02 19:02:45'),
(100, 13, 4, 0, '2021-09-02 19:02:45', '2021-09-02 19:02:45'),
(101, 14, 1, 9, '2021-09-02 19:04:01', '2021-09-02 19:04:01'),
(102, 14, 2, 48, '2021-09-02 19:04:01', '2021-09-02 19:04:01'),
(103, 14, 5, 0, '2021-09-02 19:04:01', '2021-09-02 19:04:01'),
(104, 14, 3, 5, '2021-09-02 19:04:01', '2021-09-02 19:04:01'),
(105, 14, 6, 0, '2021-09-02 19:04:01', '2021-09-02 19:04:01'),
(106, 14, 7, 10, '2021-09-02 19:04:01', '2021-09-02 19:04:01'),
(107, 14, 8, 5, '2021-09-02 19:04:01', '2021-09-02 19:04:01'),
(108, 14, 4, 0, '2021-09-02 19:04:01', '2021-09-02 19:04:01'),
(109, 15, 1, 3, '2021-09-02 19:17:12', '2021-09-02 19:17:12'),
(110, 15, 2, 32, '2021-09-02 19:17:12', '2021-09-02 19:17:12'),
(111, 15, 5, 540, '2021-09-02 19:17:12', '2021-09-02 19:17:12'),
(112, 15, 3, 14, '2021-09-02 19:17:13', '2021-09-02 19:17:13'),
(113, 15, 6, 11, '2021-09-02 19:17:13', '2021-09-02 19:17:13'),
(114, 15, 7, 25, '2021-09-02 19:17:13', '2021-09-02 19:17:13'),
(115, 15, 8, 0, '2021-09-02 19:17:13', '2021-09-02 19:17:13'),
(116, 15, 4, 0, '2021-09-02 19:17:13', '2021-09-02 19:17:13'),
(117, 16, 1, 16, '2021-09-02 19:19:31', '2021-09-02 19:19:31'),
(118, 16, 2, 4, '2021-09-02 19:19:31', '2021-09-02 19:19:31'),
(119, 16, 5, 48, '2021-09-02 19:19:31', '2021-09-02 19:19:31'),
(120, 16, 3, 27, '2021-09-02 19:19:31', '2021-09-02 19:19:31'),
(121, 16, 6, 10, '2021-09-02 19:19:31', '2021-09-02 19:19:31'),
(122, 16, 7, 1, '2021-09-02 19:19:31', '2021-09-02 19:19:31'),
(123, 16, 8, 0, '2021-09-02 19:19:31', '2021-09-02 19:19:31'),
(124, 16, 4, 0, '2021-09-02 19:19:31', '2021-09-02 19:19:31'),
(125, 17, 1, 0, '2021-09-02 19:20:17', '2021-09-02 19:20:17'),
(126, 17, 2, 100, '2021-09-02 19:20:17', '2021-09-02 19:20:17'),
(127, 17, 5, 1, '2021-09-02 19:20:17', '2021-09-02 19:20:17'),
(128, 17, 3, 0, '2021-09-02 19:20:17', '2021-09-02 19:20:17'),
(129, 17, 6, 0, '2021-09-02 19:20:17', '2021-09-02 19:20:17'),
(130, 17, 7, 100, '2021-09-02 19:20:17', '2021-09-02 19:20:17'),
(131, 17, 8, 0, '2021-09-02 19:20:17', '2021-09-02 19:20:17'),
(132, 17, 4, 0, '2021-09-02 19:20:17', '2021-09-02 19:20:17'),
(133, 18, 1, 14, '2021-09-02 19:22:29', '2021-09-02 19:22:29'),
(134, 18, 2, 28, '2021-09-02 19:22:29', '2021-09-02 19:22:29'),
(135, 18, 5, 0, '2021-09-02 19:22:29', '2021-09-02 19:22:29'),
(136, 18, 3, 12, '2021-09-02 19:22:29', '2021-09-02 19:22:29'),
(137, 18, 6, 0, '2021-09-02 19:22:29', '2021-09-02 19:22:29'),
(138, 18, 7, 2, '2021-09-02 19:22:29', '2021-09-02 19:22:29'),
(139, 18, 8, 2, '2021-09-02 19:22:29', '2021-09-02 19:22:29'),
(140, 18, 4, 0, '2021-09-02 19:22:29', '2021-09-02 19:22:29'),
(141, 19, 1, 4, '2021-09-02 19:23:42', '2021-09-02 19:23:42'),
(142, 19, 2, 39, '2021-09-02 19:23:42', '2021-09-02 19:23:42'),
(143, 19, 5, 150, '2021-09-02 19:23:42', '2021-09-02 19:23:42'),
(144, 19, 3, 14, '2021-09-02 19:23:42', '2021-09-02 19:23:42'),
(145, 19, 6, 3, '2021-09-02 19:23:42', '2021-09-02 19:23:42'),
(146, 19, 7, 1, '2021-09-02 19:23:42', '2021-09-02 19:23:42'),
(147, 19, 8, 4, '2021-09-02 19:23:42', '2021-09-02 19:23:42'),
(148, 19, 4, 0, '2021-09-02 19:23:42', '2021-09-02 19:23:42'),
(149, 20, 1, 12, '2021-09-02 19:24:54', '2021-09-02 19:24:54'),
(150, 20, 2, 25, '2021-09-02 19:24:54', '2021-09-02 19:24:54'),
(151, 20, 5, 0, '2021-09-02 19:24:54', '2021-09-02 19:24:54'),
(152, 20, 3, 11, '2021-09-02 19:24:54', '2021-09-02 19:24:54'),
(153, 20, 6, 0, '2021-09-02 19:24:54', '2021-09-02 19:24:54'),
(154, 20, 7, 0, '2021-09-02 19:24:54', '2021-09-02 19:24:54'),
(155, 20, 8, 0, '2021-09-02 19:24:54', '2021-09-02 19:24:54'),
(156, 20, 4, 0, '2021-09-02 19:24:54', '2021-09-02 19:24:54'),
(157, 21, 1, 8, '2021-09-02 19:25:33', '2021-09-02 19:25:33'),
(158, 21, 2, 23, '2021-09-02 19:25:33', '2021-09-02 19:25:33'),
(159, 21, 5, 0, '2021-09-02 19:25:33', '2021-09-02 19:25:33'),
(160, 21, 3, 7, '2021-09-02 19:25:33', '2021-09-02 19:25:33'),
(161, 21, 6, 0, '2021-09-02 19:25:33', '2021-09-02 19:25:33'),
(162, 21, 7, 0, '2021-09-02 19:25:33', '2021-09-02 19:25:33'),
(163, 21, 8, 0, '2021-09-02 19:25:33', '2021-09-02 19:25:33'),
(164, 21, 4, 0, '2021-09-02 19:25:33', '2021-09-02 19:25:33');

INSERT INTO `continut_retetas` (`id`, `reteta_id`, `ingredient_id`, `cantitate`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 300, '2021-09-01 21:39:16', '2021-09-01 21:39:16');
INSERT INTO `continut_retetas` (`id`, `reteta_id`, `ingredient_id`, `cantitate`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 100, '2021-09-01 21:39:16', '2021-09-01 21:39:16');
INSERT INTO `continut_retetas` (`id`, `reteta_id`, `ingredient_id`, `cantitate`, `created_at`, `updated_at`) VALUES
(3, 4, 8, 300, '2021-09-02 07:47:59', '2021-09-02 07:47:59');
INSERT INTO `continut_retetas` (`id`, `reteta_id`, `ingredient_id`, `cantitate`, `created_at`, `updated_at`) VALUES
(4, 4, 9, 100, '2021-09-02 07:47:59', '2021-09-02 07:47:59'),
(5, 5, 4, 100, '2021-09-02 07:53:11', '2021-09-02 07:53:11'),
(6, 5, 10, 249, '2021-09-02 07:53:11', '2021-09-02 07:53:11'),
(7, 6, 6, 200, '2021-09-02 07:54:04', '2021-09-02 07:54:04'),
(8, 6, 5, 100, '2021-09-02 07:54:04', '2021-09-02 07:54:04'),
(9, 7, 1, 100, '2021-09-02 07:54:47', '2021-09-02 07:54:47'),
(10, 7, 2, 100, '2021-09-02 07:54:47', '2021-09-02 07:54:47'),
(11, 7, 1, 100, '2021-09-02 07:54:47', '2021-09-02 07:54:47'),
(12, 8, 1, 100, '2021-09-02 07:55:11', '2021-09-02 07:55:11'),
(13, 8, 1, 200, '2021-09-02 07:55:11', '2021-09-02 07:55:11'),
(14, 9, 4, 100, '2021-09-02 07:55:34', '2021-09-02 07:55:34'),
(15, 9, 10, 100, '2021-09-02 07:55:34', '2021-09-02 07:55:34'),
(16, 10, 6, 100, '2021-09-02 07:55:59', '2021-09-02 07:55:59'),
(17, 11, 6, 100, '2021-09-02 07:56:36', '2021-09-02 07:56:36'),
(18, 12, 6, 200, '2021-09-02 07:56:49', '2021-09-02 07:56:49'),
(19, 13, 6, 300, '2021-09-02 07:57:04', '2021-09-02 07:57:04'),
(20, 14, 6, 100, '2021-09-02 07:57:23', '2021-09-02 07:57:23'),
(21, 14, 7, 100, '2021-09-02 07:57:23', '2021-09-02 07:57:23'),
(22, 15, 5, 100, '2021-09-02 07:59:39', '2021-09-02 07:59:39'),
(23, 15, 6, 300, '2021-09-02 07:59:39', '2021-09-02 07:59:39'),
(24, 15, 9, 200, '2021-09-02 07:59:39', '2021-09-02 07:59:39'),
(25, 16, 4, 149, '2021-09-02 08:00:13', '2021-09-02 08:00:13'),
(26, 16, 5, 200, '2021-09-02 08:00:13', '2021-09-02 08:00:13'),
(27, 16, 10, 200, '2021-09-02 08:00:13', '2021-09-02 08:00:13'),
(28, 17, 1, 300, '2021-09-02 08:00:26', '2021-09-02 08:00:26'),
(29, 18, 7, 100, '2021-09-02 08:00:52', '2021-09-02 08:00:52'),
(30, 18, 6, 300, '2021-09-02 08:00:52', '2021-09-02 08:00:52'),
(31, 19, 6, 200, '2021-09-02 08:01:08', '2021-09-02 08:01:08'),
(32, 19, 7, 200, '2021-09-02 08:01:08', '2021-09-02 08:01:08'),
(33, 20, 6, 100, '2021-09-02 08:01:36', '2021-09-02 08:01:36'),
(34, 20, 7, 300, '2021-09-02 08:01:36', '2021-09-02 08:01:36'),
(35, 21, 6, 0, '2021-09-02 08:05:08', '2021-09-02 08:05:08'),
(36, 21, 7, 99, '2021-09-02 08:05:08', '2021-09-02 08:05:08'),
(37, 22, 8, 200, '2021-09-02 08:05:27', '2021-09-02 08:05:27'),
(38, 22, 7, 100, '2021-09-02 08:05:27', '2021-09-02 08:05:27'),
(39, 23, 2, 50, '2021-09-02 08:05:42', '2021-09-02 08:05:42'),
(40, 24, 2, 100, '2021-09-02 08:05:50', '2021-09-02 08:05:50'),
(41, 25, 2, 150, '2021-09-02 08:05:59', '2021-09-02 08:05:59'),
(42, 26, 2, 200, '2021-09-02 08:06:07', '2021-09-02 08:06:07'),
(43, 27, 2, 300, '2021-09-02 08:06:16', '2021-09-02 08:06:16'),
(44, 28, 2, 500, '2021-09-02 16:19:46', '2021-09-02 16:19:46'),
(45, 29, 8, 500, '2021-09-02 17:37:36', '2021-09-02 17:37:36'),
(46, 30, 1, 500, '2021-09-02 17:37:57', '2021-09-02 17:37:57'),
(47, 31, 6, 500, '2021-09-02 17:38:17', '2021-09-02 17:38:17'),
(48, 32, 4, 400, '2021-09-02 17:38:31', '2021-09-02 17:38:31'),
(49, 33, 15, 75, '2021-09-02 19:20:59', '2021-09-02 19:20:59'),
(50, 33, 17, 10, '2021-09-02 19:20:59', '2021-09-02 19:20:59'),
(51, 33, 16, 40, '2021-09-02 19:20:59', '2021-09-02 19:20:59'),
(52, 34, 21, 300, '2021-09-02 19:26:04', '2021-09-02 19:26:04'),
(53, 35, 20, 300, '2021-09-02 19:26:25', '2021-09-02 19:26:25'),
(54, 36, 14, 200, '2021-09-02 19:26:53', '2021-09-02 19:26:53'),
(55, 36, 18, 300, '2021-09-02 19:26:53', '2021-09-02 19:26:53'),
(56, 37, 19, 200, '2021-09-02 19:27:14', '2021-09-02 19:27:14'),
(57, 67, 1, 1, '2021-09-04 11:08:09', '2021-09-04 11:08:09'),
(58, 68, 1, 1, '2021-09-04 11:22:40', '2021-09-04 11:22:40'),
(59, 69, 1, 1, '2021-09-04 11:22:55', '2021-09-04 11:22:55'),
(60, 70, 1, 1, '2021-09-04 11:25:07', '2021-09-04 11:25:07');



INSERT INTO `favorits` (`id`, `user_id`, `reteta_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 2, 37, 0, '2021-09-05 08:12:33', '2021-09-05 08:28:02');
INSERT INTO `favorits` (`id`, `user_id`, `reteta_id`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 1, '2021-09-05 08:12:38', '2021-09-05 08:12:38');
INSERT INTO `favorits` (`id`, `user_id`, `reteta_id`, `is_active`, `created_at`, `updated_at`) VALUES
(4, 2, 37, 0, '2021-09-05 08:28:06', '2021-09-05 08:28:13');
INSERT INTO `favorits` (`id`, `user_id`, `reteta_id`, `is_active`, `created_at`, `updated_at`) VALUES
(5, 2, 0, 1, '2021-09-05 08:31:32', '2021-09-05 08:31:32'),
(6, 2, 37, 0, '2021-09-05 08:33:52', '2021-09-05 08:33:54'),
(7, 2, 37, 0, '2021-09-05 08:34:44', '2021-09-06 20:17:13');

INSERT INTO `ingredients` (`id`, `nume`, `UM`, `categorii_ingredient_id`, `created_at`, `updated_at`, `is_active`, `user_id`, `is_visible`) VALUES
(1, 'Lapte Pilos 1.5% grasime', 'ml', 8, '2021-09-01 21:39:16', '2021-09-01 21:39:16', 1, 1, 1);
INSERT INTO `ingredients` (`id`, `nume`, `UM`, `categorii_ingredient_id`, `created_at`, `updated_at`, `is_active`, `user_id`, `is_visible`) VALUES
(2, 'Cereale Nesquik', 'g', 6, '2021-09-01 21:39:16', '2021-09-01 21:39:16', 1, 1, 1);
INSERT INTO `ingredients` (`id`, `nume`, `UM`, `categorii_ingredient_id`, `created_at`, `updated_at`, `is_active`, `user_id`, `is_visible`) VALUES
(3, 'da', 'g', 3, '2021-09-01 21:51:24', '2021-09-01 21:51:42', 1, 2, 1);
INSERT INTO `ingredients` (`id`, `nume`, `UM`, `categorii_ingredient_id`, `created_at`, `updated_at`, `is_active`, `user_id`, `is_visible`) VALUES
(4, 'Pate porc cu carne de curcan si rosii uscate - Ardealul', 'g', 1, '2021-09-02 07:25:25', '2021-09-02 07:25:25', 1, 2, 1),
(5, 'Rosii', 'g', 4, '2021-09-02 07:31:18', '2021-09-02 07:31:18', 1, 2, 1),
(6, 'Piept de pui gatit', 'g', 2, '2021-09-02 07:32:38', '2021-09-02 07:32:38', 1, 2, 1),
(7, 'Smantana 12%', 'ml', 8, '2021-09-02 07:33:54', '2021-09-02 07:33:54', 1, 2, 1),
(8, 'Paste integrale fusili Barilla', 'g', 6, '2021-09-02 07:35:37', '2021-09-02 07:35:37', 1, 2, 1),
(9, 'Sos 4 formaggi Panzani', 'ml', 15, '2021-09-02 07:38:05', '2021-09-02 07:38:05', 1, 2, 1),
(10, 'Paine 7 seminte Vel Pitar', 'g', 16, '2021-09-02 07:52:28', '2021-09-02 07:52:28', 1, 2, 1),
(11, 'Ciuperci Champignon', 'g', 4, '2021-09-02 19:01:14', '2021-09-02 19:01:14', 1, 2, 1),
(12, 'Cascaval', 'g', 9, '2021-09-02 19:01:59', '2021-09-02 19:01:59', 1, 2, 1),
(13, 'Bacon', 'g', 2, '2021-09-02 19:02:45', '2021-09-02 19:02:45', 1, 2, 1),
(14, 'Chifla hamburger', 'g', 16, '2021-09-02 19:04:00', '2021-09-02 19:04:00', 1, 2, 1),
(15, 'Inghetata de vanilie', 'g', 10, '2021-09-02 19:17:12', '2021-09-02 19:17:12', 1, 2, 1),
(16, 'Galbenus de ou', 'g', 19, '2021-09-02 19:19:31', '2021-09-02 19:19:31', 1, 2, 1),
(17, 'Zahar', 'g', 19, '2021-09-02 19:20:17', '2021-09-02 19:20:17', 1, 2, 1),
(18, 'Hamburger Burger King', 'g', 12, '2021-09-02 19:22:29', '2021-09-02 19:22:29', 1, 2, 1),
(19, 'Cartofi prajiti KFC', 'g', 12, '2021-09-02 19:23:42', '2021-09-02 19:23:42', 1, 2, 1),
(20, 'Pizza Peperoni Pizza Hut', 'g', 12, '2021-09-02 19:24:54', '2021-09-02 19:24:54', 1, 2, 1),
(21, 'Pizza Vegetariana Pizza Hut', 'g', 12, '2021-09-02 19:25:33', '2021-09-02 19:25:33', 1, 2, 1);



INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2021_04_27_034722_categorii_ingredients', 1),
(5, '2021_04_28_152253_create_nutrients_table', 1),
(6, '2021_04_28_154110_create_ingredients_table', 1),
(7, '2021_04_29_152956_create_retetas_table', 1),
(8, '2021_05_07_212917_blog', 1),
(9, '2021_05_28_153947_create_continut_ingredients_table', 1),
(10, '2021_05_29_155844_create_continut_retetas_table', 1),
(11, '2021_06_28_111535_create_recipe_steps_table', 1),
(12, '2021_07_02_093517_create_reviews_table', 1),
(13, '2021_07_19_210932_create_favorits_table', 1),
(14, '2021_07_23_110017_create_reports_table', 1),
(15, '2021_08_02_010204_create_report_categories_table', 1),
(16, '2021_08_30_141848_create_categorie_retetas_table', 1),
(17, '2021_08_31_085456_create_masas_table', 1),
(18, '2021_08_31_085510_create_zis_table', 1);

INSERT INTO `nutrients` (`id`, `nume`, `calorii`, `UM`, `created_at`, `updated_at`) VALUES
(1, 'Proteina', 4, 'g', '2021-09-01 21:39:16', '2021-09-01 21:39:16');
INSERT INTO `nutrients` (`id`, `nume`, `calorii`, `UM`, `created_at`, `updated_at`) VALUES
(2, 'Carbohidrat', 4, 'g', '2021-09-01 21:39:16', '2021-09-01 21:39:16');
INSERT INTO `nutrients` (`id`, `nume`, `calorii`, `UM`, `created_at`, `updated_at`) VALUES
(3, 'Grasime', 9, 'g', '2021-09-01 21:39:16', '2021-09-01 21:39:16');
INSERT INTO `nutrients` (`id`, `nume`, `calorii`, `UM`, `created_at`, `updated_at`) VALUES
(4, 'Alcool', 7, 'g', '2021-09-01 21:39:16', '2021-09-01 21:39:16'),
(5, 'Sare', 0, 'mg', '2021-09-01 21:39:16', '2021-09-01 21:39:16'),
(6, 'Grasimi Staturate', 9, 'g', '2021-09-01 21:39:16', '2021-09-01 21:39:16'),
(7, 'Zaharuri', 4, 'g', '2021-09-01 21:39:16', '2021-09-01 21:39:16'),
(8, 'Fibre', 0, 'g', '2021-09-01 21:39:16', '2021-09-01 21:39:16');



INSERT INTO `recipe_steps` (`id`, `created_at`, `updated_at`, `Descriere`, `reteta_id`, `nr_pas`) VALUES
(1, '2021-09-01 21:39:16', '2021-09-01 21:39:16', 'Se pun cerealele peste lapte', 1, 1);
INSERT INTO `recipe_steps` (`id`, `created_at`, `updated_at`, `Descriere`, `reteta_id`, `nr_pas`) VALUES
(2, '2021-09-01 21:39:16', '2021-09-01 21:39:16', 'Pofta buna!', 1, 2);
INSERT INTO `recipe_steps` (`id`, `created_at`, `updated_at`, `Descriere`, `reteta_id`, `nr_pas`) VALUES
(3, '2021-09-02 07:47:59', '2021-09-02 07:47:59', 'Se pune apa la fiert.', 4, 1);
INSERT INTO `recipe_steps` (`id`, `created_at`, `updated_at`, `Descriere`, `reteta_id`, `nr_pas`) VALUES
(4, '2021-09-02 07:47:59', '2021-09-02 07:47:59', 'Dupa ce fierbe apa, se adauga pastele.', 4, 2),
(5, '2021-09-02 07:47:59', '2021-09-02 07:47:59', 'Dupa ce fierb pastele, adaugati-le intr-un castron impreuna cu sosul si amestecati. Pofta buna!', 4, 3),
(6, '2021-09-02 07:53:11', '2021-09-02 07:53:11', '1', 5, 1),
(7, '2021-09-02 07:54:04', '2021-09-02 07:54:04', '1', 6, 1),
(8, '2021-09-02 07:54:47', '2021-09-02 07:54:47', '1', 7, 1),
(9, '2021-09-02 07:55:11', '2021-09-02 07:55:11', '1', 8, 1),
(10, '2021-09-02 07:55:34', '2021-09-02 07:55:34', '1', 9, 1),
(11, '2021-09-02 07:56:36', '2021-09-02 07:56:36', '1', 11, 1),
(12, '2021-09-02 07:56:49', '2021-09-02 07:56:49', '1', 12, 1),
(13, '2021-09-02 07:57:04', '2021-09-02 07:57:04', '1', 13, 1),
(14, '2021-09-02 07:57:23', '2021-09-02 07:57:23', '1', 14, 1),
(15, '2021-09-02 07:59:39', '2021-09-02 07:59:39', '1', 15, 1),
(16, '2021-09-02 08:00:13', '2021-09-02 08:00:13', '1', 16, 1),
(17, '2021-09-02 08:00:26', '2021-09-02 08:00:26', '1', 17, 1),
(18, '2021-09-02 08:00:52', '2021-09-02 08:00:52', '1', 18, 1),
(19, '2021-09-02 08:01:08', '2021-09-02 08:01:08', '1', 19, 1),
(20, '2021-09-02 08:01:36', '2021-09-02 08:01:36', '1', 20, 1),
(21, '2021-09-02 08:05:08', '2021-09-02 08:05:08', '1', 21, 1),
(22, '2021-09-02 08:05:27', '2021-09-02 08:05:27', '1', 22, 1),
(23, '2021-09-02 08:05:42', '2021-09-02 08:05:42', '1', 23, 1),
(24, '2021-09-02 08:05:50', '2021-09-02 08:05:50', '1', 24, 1),
(25, '2021-09-02 08:05:59', '2021-09-02 08:05:59', '1', 25, 1),
(26, '2021-09-02 08:06:07', '2021-09-02 08:06:07', '1', 26, 1),
(27, '2021-09-02 08:06:16', '2021-09-02 08:06:16', '1', 27, 1),
(28, '2021-09-02 16:19:46', '2021-09-02 16:19:46', '1', 28, 1),
(29, '2021-09-02 17:37:36', '2021-09-02 17:37:36', '1', 29, 1),
(30, '2021-09-02 17:37:57', '2021-09-02 17:37:57', '1', 30, 1),
(31, '2021-09-02 17:38:17', '2021-09-02 17:38:17', '1', 31, 1),
(32, '2021-09-02 17:38:31', '2021-09-02 17:38:31', '1', 32, 1),
(33, '2021-09-02 19:20:59', '2021-09-02 19:20:59', '1', 33, 1),
(34, '2021-09-02 19:26:04', '2021-09-02 19:26:04', '1', 34, 1),
(35, '2021-09-02 19:26:04', '2021-09-02 19:26:04', '2', 34, 2),
(36, '2021-09-02 19:26:25', '2021-09-02 19:26:25', '1', 35, 1),
(37, '2021-09-02 19:26:53', '2021-09-02 19:26:53', '1', 36, 1),
(38, '2021-09-02 19:27:14', '2021-09-02 19:27:14', '1', 37, 1),
(39, '2021-09-04 11:08:09', '2021-09-04 11:08:09', '1', 67, 1),
(40, '2021-09-04 11:22:40', '2021-09-04 11:22:40', '1', 68, 1),
(41, '2021-09-04 11:22:55', '2021-09-04 11:22:55', '1', 69, 1),
(42, '2021-09-04 11:25:07', '2021-09-04 11:25:07', '1', 70, 1);

INSERT INTO `report_categories` (`id`, `created_at`, `updated_at`, `tip`) VALUES
(1, '2021-09-01 21:39:16', '2021-09-01 21:39:16', 'categorie-incompatibila');
INSERT INTO `report_categories` (`id`, `created_at`, `updated_at`, `tip`) VALUES
(2, '2021-09-01 21:39:16', '2021-09-01 21:39:16', 'ingrediente-invalide');
INSERT INTO `report_categories` (`id`, `created_at`, `updated_at`, `tip`) VALUES
(3, '2021-09-01 21:39:16', '2021-09-01 21:39:16', 'reteta-necorespunzatoare');

INSERT INTO `reports` (`id`, `user_id`, `reteta_id`, `report_categories_id`, `motiv`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 2, 10, 1, 'da', 0, '2021-09-05 08:51:26', '2021-09-05 08:51:26');
INSERT INTO `reports` (`id`, `user_id`, `reteta_id`, `report_categories_id`, `motiv`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 2, 7, 1, 'da', 0, '2021-09-05 08:52:21', '2021-09-05 08:52:21');
INSERT INTO `reports` (`id`, `user_id`, `reteta_id`, `report_categories_id`, `motiv`, `is_active`, `created_at`, `updated_at`) VALUES
(4, 3, 67, 1, '1', 0, '2021-09-06 19:52:19', '2021-09-06 19:52:19');
INSERT INTO `reports` (`id`, `user_id`, `reteta_id`, `report_categories_id`, `motiv`, `is_active`, `created_at`, `updated_at`) VALUES
(5, 3, 68, 1, '1', 0, '2021-09-06 19:52:30', '2021-09-06 19:52:30'),
(6, 3, 69, 1, '1', 0, '2021-09-06 19:52:38', '2021-09-06 19:52:38'),
(7, 3, 70, 1, '1', 0, '2021-09-06 19:52:45', '2021-09-06 19:52:45');

INSERT INTO `retetas` (`id`, `user_id`, `titlu`, `descriere`, `durata_gatire`, `tip_masa`, `imagine`, `is_active`, `is_visible`, `created_at`, `updated_at`) VALUES
(1, 1, 'cereale cu lapte', 'Se pun cerealele peste lapte', '2', '1', 'cereale.jpg', 1, 1, '2021-09-01 21:39:16', '2021-09-01 21:39:16');
INSERT INTO `retetas` (`id`, `user_id`, `titlu`, `descriere`, `durata_gatire`, `tip_masa`, `imagine`, `is_active`, `is_visible`, `created_at`, `updated_at`) VALUES
(4, 2, 'Paste cu sos 4 formaggi', 'O reteta pentru o cina usoara si rapida', '25', '3', NULL, 1, 1, '2021-09-02 07:47:59', '2021-09-02 07:47:59');
INSERT INTO `retetas` (`id`, `user_id`, `titlu`, `descriere`, `durata_gatire`, `tip_masa`, `imagine`, `is_active`, `is_visible`, `created_at`, `updated_at`) VALUES
(5, 2, 'Pate cu paine', 'Bun', '0', '2', NULL, 1, 1, '2021-09-02 07:53:11', '2021-09-02 07:53:11');
INSERT INTO `retetas` (`id`, `user_id`, `titlu`, `descriere`, `durata_gatire`, `tip_masa`, `imagine`, `is_active`, `is_visible`, `created_at`, `updated_at`) VALUES
(6, 2, 'Reteta 1', '1', '1', '2', NULL, 1, 1, '2021-09-02 07:54:04', '2021-09-02 07:54:04'),
(7, 2, 'Mic dejun 1', '1', '1', '1', NULL, 1, 1, '2021-09-02 07:54:47', '2021-09-02 07:54:47'),
(8, 2, 'Mic dejun 2', '1', '1', '1', NULL, 1, 1, '2021-09-02 07:55:11', '2021-09-02 07:55:11'),
(9, 2, 'mic dejun 3', '1', '1', '1', NULL, 1, 1, '2021-09-02 07:55:34', '2021-09-02 07:55:34'),
(10, 2, 'Pranz 1', '1', '1', '2', NULL, 0, 1, '2021-09-02 07:55:59', '2021-09-02 07:56:31'),
(11, 2, 'Pranz 1', '1', '1', '2', NULL, 1, 1, '2021-09-02 07:56:36', '2021-09-02 07:56:36'),
(12, 2, 'Pranz 2', '1', '1', '1', NULL, 1, 1, '2021-09-02 07:56:49', '2021-09-02 07:56:49'),
(13, 2, 'Pranz 3', '1', '1', '2', NULL, 1, 1, '2021-09-02 07:57:04', '2021-09-02 07:57:04'),
(14, 2, 'Pranz 4', '1', '1', '2', NULL, 1, 1, '2021-09-02 07:57:23', '2021-09-02 07:57:23'),
(15, 2, 'Pranz 5', '1', '1', '2', NULL, 1, 1, '2021-09-02 07:59:39', '2021-09-02 07:59:39'),
(16, 2, 'mic dejun 4', '1', '1', '1', NULL, 1, 1, '2021-09-02 08:00:13', '2021-09-02 08:00:13'),
(17, 2, 'mic dejun 5', '1', '1', '1', NULL, 1, 1, '2021-09-02 08:00:26', '2021-09-02 08:00:26'),
(18, 2, 'Cina 1', '1', '1', '3', NULL, 1, 1, '2021-09-02 08:00:52', '2021-09-02 08:00:52'),
(19, 2, 'Cina 2', '1', '1', '1', NULL, 1, 1, '2021-09-02 08:01:08', '2021-09-02 08:01:08'),
(20, 2, 'Cina 3', '1', '1', '3', NULL, 1, 1, '2021-09-02 08:01:36', '2021-09-02 08:01:36'),
(21, 2, 'Cina 4', '1', '1', '3', NULL, 1, 1, '2021-09-02 08:05:08', '2021-09-02 08:05:08'),
(22, 2, 'Cina 5', '1', '1', '3', NULL, 1, 1, '2021-09-02 08:05:27', '2021-09-02 08:05:27'),
(23, 2, 'Gustare 1', '1', '1', '4', NULL, 1, 1, '2021-09-02 08:05:42', '2021-09-02 08:05:42'),
(24, 2, 'Gustare 2', '1', '1', '4', NULL, 1, 1, '2021-09-02 08:05:50', '2021-09-02 08:05:50'),
(25, 2, 'Gustare 3', '1', '1', '4', NULL, 1, 1, '2021-09-02 08:05:59', '2021-09-02 08:05:59'),
(26, 2, 'Gustare 4', '1', '1', '4', NULL, 1, 1, '2021-09-02 08:06:07', '2021-09-02 08:06:07'),
(27, 2, 'Gustare 5', '1', '1', '4', NULL, 1, 1, '2021-09-02 08:06:16', '2021-09-02 08:06:16'),
(28, 2, 'cereale', '1', '1', '1', NULL, 1, 1, '2021-09-02 16:19:46', '2021-09-02 16:19:46'),
(29, 2, 'pranz 6', '1', '1', '2', NULL, 0, 1, '2021-09-02 17:37:36', '2021-09-05 08:10:50'),
(30, 2, 'mic dejun 6', '1', '0', '1', NULL, 1, 1, '2021-09-02 17:37:57', '2021-09-02 17:37:57'),
(31, 2, 'Cina 6', '1', '1', '3', NULL, 1, 1, '2021-09-02 17:38:17', '2021-09-02 17:38:17'),
(32, 2, 'GUSTARE 6', '1', '1', '4', NULL, 1, 1, '2021-09-02 17:38:31', '2021-09-02 17:38:31'),
(33, 2, 'Crema de zahar ars', '1', '1', '4', NULL, 1, 1, '2021-09-02 19:20:59', '2021-09-02 19:20:59'),
(34, 2, 'Pizza Vegetariana', '1', '1', '3', NULL, 1, 1, '2021-09-02 19:26:04', '2021-09-02 19:26:04'),
(35, 2, 'Pizza Peperoni', '1', '1', '2', NULL, 1, 1, '2021-09-02 19:26:25', '2021-09-02 19:26:25'),
(36, 2, 'Hamburger', '1', '1', '1', NULL, 1, 1, '2021-09-02 19:26:53', '2021-09-02 19:26:53'),
(37, 2, 'Cartofi prajiti', '1', '0', '4', NULL, 1, 1, '2021-09-02 19:27:14', '2021-09-02 19:27:14'),
(67, 2, 'test', '1', '1', '1', 'test.jpg', 0, 0, '2021-09-04 11:08:09', '2021-09-04 11:28:18'),
(68, 2, 'test2', '1', '1', '1', '6133570020f7b4.91597296.jpg', 0, 0, '2021-09-04 11:22:40', '2021-09-04 11:28:09'),
(69, 2, 'daaaa', '1', '1', '1', '6133570f18f613.74937711.jpg', 0, 0, '2021-09-04 11:22:55', '2021-09-04 11:26:23'),
(70, 2, 'da', '1', '1', '1', '61335793009944.08997058.jpg', 0, 0, '2021-09-04 11:25:07', '2021-09-04 11:28:04');

INSERT INTO `reviews` (`id`, `continut`, `nota`, `user_id`, `reteta_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '1', 5, 2, 1, 1, '2021-09-06 20:16:36', '2021-09-06 20:16:36');


INSERT INTO `users` (`id`, `name`, `prenume`, `username`, `email`, `email_verified_at`, `password`, `first_time`, `is_admin`, `is_active`, `data_nasterii`, `greutate`, `inaltime`, `grad_activitate`, `sex`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ionescu', 'Gruia', 'clarabelle85', 'marianne.kling@example.net', '2021-09-01 21:39:16', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 0, 1, NULL, NULL, NULL, NULL, NULL, 'vyXaEydml0', NULL, NULL);
INSERT INTO `users` (`id`, `name`, `prenume`, `username`, `email`, `email_verified_at`, `password`, `first_time`, `is_admin`, `is_active`, `data_nasterii`, `greutate`, `inaltime`, `grad_activitate`, `sex`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'da', 'da', 'user', 'mail@mail', NULL, '$2y$10$jLwkHupl36dTvtliTbtCiO22YvtWmsXzE8l8h7wBPv386No18oFs2', 0, 1, 1, '1999-09-02', 90, 190, 1, 1, NULL, NULL, NULL);
INSERT INTO `users` (`id`, `name`, `prenume`, `username`, `email`, `email_verified_at`, `password`, `first_time`, `is_admin`, `is_active`, `data_nasterii`, `greutate`, `inaltime`, `grad_activitate`, `sex`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'o', 'o', 'u', 'mail2@mail', NULL, '$2y$10$MhuWuAD6qQqYxIogjDUKSe2VHN3Fl2fGccISVRn.5pkWaNl6zSWGG', 0, 0, 1, '1999-09-04', 100, 197, 2, 1, NULL, NULL, NULL);
INSERT INTO `users` (`id`, `name`, `prenume`, `username`, `email`, `email_verified_at`, `password`, `first_time`, `is_admin`, `is_active`, `data_nasterii`, `greutate`, `inaltime`, `grad_activitate`, `sex`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'ionescu', 'gruia', 'gruia', 'gruia@mail', NULL, '$2y$10$atyJNx4EXYKGrw0UJUTmee2H5YqkEoPKIoz7ZrCGr1iq4QmUCfbkC', 0, 0, 1, '1990-09-06', 95, 190, 2, 1, NULL, NULL, NULL);




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;