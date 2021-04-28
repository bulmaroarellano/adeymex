-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 28-04-2021 a las 13:58:49
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `paqueteria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigospostales`
--

CREATE TABLE `codigospostales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `codigoPostal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ciudad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigoEstado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `municipio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `codigospostales`
--

INSERT INTO `codigospostales` (`id`, `codigoPostal`, `direccion`, `ciudad`, `codigoEstado`, `municipio`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '13314', '4337 Tiara Forges Suite 610', 'New Jane', 'furt', 'Missouri', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(2, '00967', '78972 Feil Terrace Apt. 416', 'Lake Maggieland', 'burgh', 'Nevada', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(3, '05706', '328 Sporer Gateway Apt. 751', 'Klingville', 'mouth', 'Minnesota', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(4, '18613', '587 Haylee Stream Apt. 004', 'Lake Donato', 'mouth', 'Maryland', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(5, '26969', '49781 Arnulfo Ranch Apt. 691', 'South Ona', 'mouth', 'Texas', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(6, '58223', '7879 Predovic Roads', 'Rogahnstad', 'land', 'Nebraska', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(7, '77592-9927', '2507 Lueilwitz Cliffs', 'East Raymundotown', 'town', 'Massachusetts', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(8, '49337', '915 Cummings Station Apt. 535', 'Americoburgh', 'stad', 'Arkansas', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destinatarios`
--

CREATE TABLE `destinatarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sucursal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidoP` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidoM` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `empresa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domicilio1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domicilio2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domicilio3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pais` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigoPostal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `destinatarios`
--

INSERT INTO `destinatarios` (`id`, `sucursal`, `nombre`, `apellidoP`, `apellidoM`, `empresa`, `telefono`, `email`, `domicilio1`, `domicilio2`, `domicilio3`, `pais`, `codigoPostal`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Spencer PLC', 'Caden Bruen', 'Weissnat', 'Turcotte', 'Schinner, Hammes and Herman', '+1-812-225-8935', 'jason01@sanford.com', '79385 Stracke Stravenue Suite 329', 'Cassin Curve', 'Karlie Shores', 'British Indian Ocean Territory (Chagos Archipelago)', '04604', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(2, 'Bergnaum PLC', 'Mr. Craig Treutel', 'Leuschke', 'Kling', 'Wisozk Group', '478-648-0817', 'ybeahan@hotmail.com', '71320 Brielle Common Apt. 174', 'Waters Street', 'Kamron Roads', 'Paraguay', '01901', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(3, 'Treutel-Ullrich', 'Mckenna Casper MD', 'Rodriguez', 'Cormier', 'Langworth, Witting and Abernathy', '276-998-6543', 'feil.devin@yahoo.com', '495 Macy Walks Suite 040', 'Auer Prairie', 'Mosciski Knolls', 'Hong Kong', '03680-0940', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(4, 'Lynch Group', 'Adam McClure', 'Kutch', 'Raynor', 'Rowe-Greenholt', '+1-857-232-0526', 'harrison.reilly@bradtke.com', '1674 Cronin Greens', 'Deondre Gardens', 'Spinka Track', 'Bangladesh', '46660-7996', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(5, 'Moore, Mitchell and Sauer', 'Rosa Zemlak', 'Jerde', 'Mohr', 'Maggio Group', '+1-470-651-0966', 'watsica.wilma@hotmail.com', '2478 Durgan Lodge Suite 628', 'Dulce Harbor', 'Roob Gateway', 'Cuba', '82064', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(6, 'Strosin-Schamberger', 'Otha O\'Kon', 'Hackett', 'Green', 'Predovic, Fahey and Hudson', '(650) 345-0986', 'hilbert.kohler@gmail.com', '5623 Moen Run', 'Mueller Trail', 'Haley Meadow', 'Falkland Islands (Malvinas)', '59498-1193', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(7, 'Kshlerin, Eichmann and Stoltenberg', 'Dr. Delmer Crist', 'Frami', 'Kerluke', 'Reynolds-Donnelly', '(561) 206-7728', 'mtowne@hintz.com', '5733 Dach Ways Suite 779', 'Elody Freeway', 'Hayley Ferry', 'Hong Kong', '53920', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(8, 'Maggio, Cassin and McDermott', 'Conner Ullrich', 'Roberts', 'Hayes', 'Witting, Hill and Berge', '1-732-462-0777', 'johan.gorczany@yahoo.com', '56389 Cali Cliffs Apt. 073', 'Walsh Rapids', 'Mireya Knolls', 'Cambodia', '66375', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devices`
--

CREATE TABLE `devices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `platform` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `platform_version` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser_version` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_desktop` tinyint(1) NOT NULL DEFAULT 0,
  `is_mobile` tinyint(1) NOT NULL DEFAULT 0,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_trusted` tinyint(1) NOT NULL DEFAULT 0,
  `is_untrusted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `devices`
--

INSERT INTO `devices` (`id`, `user_id`, `user_type`, `platform`, `platform_version`, `browser`, `browser_version`, `is_desktop`, `is_mobile`, `language`, `is_trusted`, `is_untrusted`, `created_at`, `updated_at`) VALUES
(1, 1, 'App\\Models\\User', 'OS X', '11_3_0', 'Opera', '75.0.3969.218', 1, 0, 'es-419', 0, 0, '2021-04-27 22:01:53', '2021-04-27 22:01:53'),
(2, 2, 'App\\Models\\User', 'OS X', '11_3_0', 'Opera', '75.0.3969.218', 1, 0, 'es-419', 0, 0, '2021-04-27 22:09:06', '2021-04-27 22:09:06'),
(3, 1, 'App\\Models\\User', 'Ubuntu', '0', 'Firefox', '84.0', 1, 0, 'es-mx', 0, 0, '2021-04-28 02:39:35', '2021-04-28 02:39:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laravel_blocker`
--

CREATE TABLE `laravel_blocker` (
  `id` int(10) UNSIGNED NOT NULL,
  `typeId` int(10) UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userId` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `laravel_blocker`
--

INSERT INTO `laravel_blocker` (`id`, `typeId`, `value`, `note`, `userId`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 'test.com', 'Block all domains/emails @test.com', NULL, '2021-04-27 02:30:33', '2021-04-27 02:30:33', NULL),
(2, 3, 'test.ca', 'Block all domains/emails @test.ca', NULL, '2021-04-27 02:30:33', '2021-04-27 02:30:33', NULL),
(3, 3, 'fake.com', 'Block all domains/emails @fake.com', NULL, '2021-04-27 02:30:33', '2021-04-27 02:30:33', NULL),
(4, 3, 'example.com', 'Block all domains/emails @example.com', NULL, '2021-04-27 02:30:33', '2021-04-27 02:30:33', NULL),
(5, 3, 'mailinator.com', 'Block all domains/emails @mailinator.com', NULL, '2021-04-27 02:30:33', '2021-04-27 02:30:33', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laravel_blocker_types`
--

CREATE TABLE `laravel_blocker_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `laravel_blocker_types`
--

INSERT INTO `laravel_blocker_types` (`id`, `slug`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'email', 'E-mail', '2021-04-27 02:30:33', '2021-04-27 02:30:33', NULL),
(2, 'ipAddress', 'IP Address', '2021-04-27 02:30:33', '2021-04-27 02:30:33', NULL),
(3, 'domain', 'Domain Name', '2021-04-27 02:30:33', '2021-04-27 02:30:33', NULL),
(4, 'user', 'User', '2021-04-27 02:30:33', '2021-04-27 02:30:33', NULL),
(5, 'city', 'City', '2021-04-27 02:30:33', '2021-04-27 02:30:33', NULL),
(6, 'state', 'State', '2021-04-27 02:30:33', '2021-04-27 02:30:33', NULL),
(7, 'country', 'Country', '2021-04-27 02:30:33', '2021-04-27 02:30:33', NULL),
(8, 'countryCode', 'Country Code', '2021-04-27 02:30:33', '2021-04-27 02:30:33', NULL),
(9, 'continent', 'Continent', '2021-04-27 02:30:33', '2021-04-27 02:30:33', NULL),
(10, 'region', 'Region', '2021-04-27 02:30:33', '2021-04-27 02:30:33', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logins`
--

CREATE TABLE `logins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'auth',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `logins`
--

INSERT INTO `logins` (`id`, `ip_address`, `type`, `user_id`, `user_type`, `device_id`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', 'auth', 1, 'App\\Models\\User', 1, '2021-04-27 22:01:53', '2021-04-27 22:01:53'),
(2, '127.0.0.1', 'auth', 2, 'App\\Models\\User', 2, '2021-04-27 22:09:06', '2021-04-27 22:09:06'),
(3, '127.0.0.1', 'auth', 1, 'App\\Models\\User', 1, '2021-04-27 23:03:49', '2021-04-27 23:03:49'),
(4, '127.0.0.1', 'failed', 1, 'App\\Models\\User', 3, '2021-04-28 02:39:35', '2021-04-28 02:39:35'),
(5, '127.0.0.1', 'auth', 1, 'App\\Models\\User', 3, '2021-04-28 05:25:39', '2021-04-28 05:25:39'),
(6, '127.0.0.1', 'auth', 1, 'App\\Models\\User', 3, '2021-04-28 16:57:44', '2021-04-28 16:57:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajerias`
--

CREATE TABLE `mensajerias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mensajeria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `mensajerias`
--

INSERT INTO `mensajerias` (`id`, `mensajeria`, `logo`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'quod', 'https://via.placeholder.com/640x480.png/00ccff?text=esse', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(2, 'cumque', 'https://via.placeholder.com/640x480.png/002288?text=quia', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(3, 'dolor', 'https://via.placeholder.com/640x480.png/00ee99?text=ea', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(4, 'voluptatem', 'https://via.placeholder.com/640x480.png/001100?text=numquam', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(5, 'consectetur', 'https://via.placeholder.com/640x480.png/00bb44?text=molestias', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(6, 'rerum', 'https://via.placeholder.com/640x480.png/003311?text=mollitia', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(7, 'consequatur', 'https://via.placeholder.com/640x480.png/0033ee?text=officiis', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(8, 'similique', 'https://via.placeholder.com/640x480.png/003388?text=nulla', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mercancias`
--

CREATE TABLE `mercancias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `producto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productoIngles` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `claveInternacional` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `costo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `moneda` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medida` decimal(8,2) DEFAULT NULL,
  `unidadMedida` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pais` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peso` decimal(8,2) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `mercancias`
--

INSERT INTO `mercancias` (`id`, `producto`, `productoIngles`, `claveInternacional`, `costo`, `moneda`, `medida`, `unidadMedida`, `pais`, `peso`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'dolorum', 'voluptatem', '1906', '434', 'en_GU', '9.00', 'Litro', 'British Indian Ocean Territory (Chagos Archipelago)', '6.00', NULL, '2021-04-20 19:27:57', '2021-04-20 19:27:57'),
(2, 'fugit', 'distinctio', '6603', '223', 'es_CL', '6.00', 'Kilogramo', 'Paraguay', '6.00', NULL, '2021-04-20 19:27:57', '2021-04-20 19:27:57'),
(3, 'architecto', 'unde', '8811', '108', 'ro_MD', '9.00', 'Pieza', 'Hong Kong', '0.00', NULL, '2021-04-20 19:27:57', '2021-04-20 19:27:57'),
(4, 'natus', 'ipsa', '2971', '369', 'hy_AM', '6.00', 'Metro', 'Bangladesh', '2.00', NULL, '2021-04-20 19:27:57', '2021-04-20 19:27:57'),
(5, 'quis', 'minus', '5121', '232', 'nn_NO', '6.00', 'Metro', 'Cuba', '2.00', NULL, '2021-04-20 19:27:57', '2021-04-20 19:27:57'),
(6, 'in', 'architecto', '6192', '135', 'de_CH', '5.00', 'Litro', 'Falkland Islands (Malvinas)', '0.00', NULL, '2021-04-20 19:27:57', '2021-04-20 19:27:57'),
(7, 'voluptatum', 'laudantium', '7266', '263', 'en_NZ', '1.00', 'Metro', 'Hong Kong', '6.00', NULL, '2021-04-20 19:27:57', '2021-04-20 19:27:57'),
(8, 'amet', 'sapiente', '3194', '159', 'sr_CS', '5.00', 'Metro', 'Cambodia', '2.00', NULL, '2021-04-20 19:27:57', '2021-04-20 19:27:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2014_10_12_200000_update_users_table', 2),
(3, '2019_02_19_032636_create_laravel_blocker_types_table', 2),
(4, '2019_02_19_045158_create_laravel_blocker_table', 3),
(5, '2021_04_22_220652_create_permission_tables', 3),
(6, '2021_04_22_221519_create_products_table', 3),
(7, '2021_04_22_222849_create_table_users', 3),
(8, '2021_04_22_223639_create_users_table', 4),
(9, '2021_04_22_223905_created_failed_jobs_table', 4),
(10, '2021_04_24_064728_create_devices_table', 4),
(11, '2021_04_24_064728_create_logins_table', 4),
(12, '2021_04_24_064728_update_logins_and_devices_table_user_relation', 4),
(13, '2021_04_24_083745_create_activity_log_table', 4),
(14, '2021_04_24_213321_create_sessions_table', 4),
(15, '2021_04_24_223518_update_users_table', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(3, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monedas`
--

CREATE TABLE `monedas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `moneda` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `simbolo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `monedas`
--

INSERT INTO `monedas` (`id`, `moneda`, `codigo`, `simbolo`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'en_GU', 'CUC', 'ar', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(2, 'es_CL', 'IDR', 'mg', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(3, 'ro_MD', 'OMR', 'ar', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(4, 'hy_AM', 'AED', 'lb', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(5, 'nn_NO', 'GBP', 'xh', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(6, 'de_CH', 'MYR', 'rn', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(7, 'en_NZ', 'COP', 'vo', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(8, 'sr_CS', 'VND', 'oc', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pais` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigoPais` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `moneda` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `pais`, `codigoPais`, `moneda`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'British Indian Ocean Territory (Chagos Archipelago)', 'IE', 'AED', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(2, 'Paraguay', 'CN', 'USD', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(3, 'Hong Kong', 'VE', 'PAB', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(4, 'Bangladesh', 'SH', 'PEN', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(5, 'Cuba', 'LS', 'EUR', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(6, 'Falkland Islands (Malvinas)', 'AO', 'GIP', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(7, 'Hong Kong', 'AO', 'BRL', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(8, 'Cambodia', 'MA', 'BND', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'user-list', 'web', '2021-04-27 02:44:04', '2021-04-27 02:44:04'),
(2, 'user-create', 'web', '2021-04-27 02:44:04', '2021-04-27 02:44:04'),
(3, 'user-edit', 'web', '2021-04-27 02:44:04', '2021-04-27 02:44:04'),
(4, 'user-delete', 'web', '2021-04-27 02:44:04', '2021-04-27 02:44:04'),
(5, 'role-list', 'web', '2021-04-27 02:44:04', '2021-04-27 02:44:04'),
(6, 'role-create', 'web', '2021-04-27 02:44:04', '2021-04-27 02:44:04'),
(7, 'role-edit', 'web', '2021-04-27 02:44:04', '2021-04-27 02:44:04'),
(8, 'role-delete', 'web', '2021-04-27 02:44:04', '2021-04-27 02:44:04'),
(9, 'product-list', 'web', '2021-04-27 02:44:04', '2021-04-27 02:44:04'),
(10, 'product-create', 'web', '2021-04-27 02:44:04', '2021-04-27 02:44:04'),
(11, 'product-edit', 'web', '2021-04-27 02:44:04', '2021-04-27 02:44:04'),
(12, 'product-delete', 'web', '2021-04-27 02:44:04', '2021-04-27 02:44:04'),
(13, 'permission-list', 'web', '2021-04-27 02:44:04', '2021-04-27 02:44:04'),
(14, 'permission-create', 'web', '2021-04-27 02:44:04', '2021-04-27 02:44:04'),
(15, 'permission-edit', 'web', '2021-04-27 02:44:04', '2021-04-27 02:44:04'),
(16, 'permission-delete', 'web', '2021-04-27 02:44:04', '2021-04-27 02:44:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `remitentes`
--

CREATE TABLE `remitentes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sucursal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidoP` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidoM` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `empresa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoCliente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domicilio1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domicilio2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domicilio3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pais` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigoPostal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `remitentes`
--

INSERT INTO `remitentes` (`id`, `sucursal`, `nombre`, `apellidoP`, `apellidoM`, `empresa`, `telefono`, `email`, `tipoCliente`, `domicilio1`, `domicilio2`, `domicilio3`, `pais`, `codigoPostal`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Spencer PLC', 'Prof. Emelie Ziemann', 'Barton', 'Klocko', 'Smith Inc', '+1-857-358-5489', 'hintz.doris@oconnell.biz', 'General', '1059 Ferry Squares', 'Monahan Throughway', 'Ondricka Route', 'British Indian Ocean Territory (Chagos Archipelago)', '81156', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(2, 'Bergnaum PLC', 'Shakira Miller', 'Morar', 'Johns', 'Armstrong-Roob', '+1.463.602.0102', 'garth97@yahoo.com', 'General', '2933 Spinka Greens Suite 019', 'Fritsch Ways', 'Nathanael Isle', 'Paraguay', '01386-6574', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(3, 'Treutel-Ullrich', 'Mr. Cyril Bergnaum', 'Willms', 'Fay', 'Collins Inc', '+1-283-324-0662', 'onie57@gmail.com', 'General', '2031 Padberg Estate Apt. 827', 'Adah Forest', 'Shanahan Parkways', 'Hong Kong', '38435-8396', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(4, 'Lynch Group', 'Dr. Lyric Kub', 'Wintheiser', 'Rosenbaum', 'Berge-Rau', '505.854.0773', 'marcelo71@yahoo.com', 'General', '529 Aliyah Stream', 'Gunner Overpass', 'Alexanne Rapids', 'Bangladesh', '49853', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(5, 'Moore, Mitchell and Sauer', 'Enos Ryan IV', 'Grimes', 'Funk', 'Armstrong-Considine', '979.791.1889', 'adaniel@corwin.info', 'General', '63084 Princess Stream', 'Vandervort Prairie', 'Bauch Loop', 'Cuba', '01038', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(6, 'Strosin-Schamberger', 'Terrell Lehner', 'Cremin', 'Hills', 'McKenzie, Tillman and Farrell', '(734) 493-6215', 'jaleel52@gleichner.org', 'General', '459 Augusta Motorway Suite 255', 'Crooks Meadows', 'Thaddeus Canyon', 'Falkland Islands (Malvinas)', '10142', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(7, 'Kshlerin, Eichmann and Stoltenberg', 'Dr. Miller Donnelly Sr.', 'Hegmann', 'Eichmann', 'Stroman, Schmidt and Champlin', '+1.786.599.0556', 'bradtke.gertrude@cartwright.com', 'General', '154 Kareem Trace Apt. 841', 'Abshire Lights', 'Carolanne Manors', 'Hong Kong', '30161', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(8, 'Maggio, Cassin and McDermott', 'Mr. Kiley Gleichner IV', 'Kuphal', 'Huels', 'Hickle Group', '1-332-527-1793', 'marilyne.leffler@gmail.com', 'General', '86011 Dicki Overpass', 'Alverta Lodge', 'Ricardo Unions', 'Cambodia', '30184', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(3, 'Admin', 'web', '2021-04-27 03:02:52', '2021-04-27 03:02:52'),
(4, 'Editor', 'web', '2021-04-27 03:02:52', '2021-04-27 03:02:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 3),
(2, 1),
(2, 3),
(3, 1),
(3, 3),
(4, 1),
(4, 3),
(5, 1),
(5, 3),
(6, 1),
(6, 3),
(7, 1),
(7, 3),
(8, 1),
(8, 3),
(9, 1),
(9, 3),
(10, 1),
(10, 3),
(11, 1),
(11, 3),
(12, 1),
(12, 3),
(13, 1),
(13, 3),
(14, 1),
(14, 3),
(15, 1),
(15, 3),
(16, 1),
(16, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('U59IgnTAzuLBYeI24sDTQPhY0b0S8FIJb9p36k8W', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 11_3_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.128 Safari/537.36 OPR/75.0.3969.218', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQTAxSFE4a2Fvc0RXcHFVSnBSbDFCWmVKWDFlVHlXS3N4eFozV0lNQyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjE5OiJodHRwOi8vc3RhcnRlci50ZXN0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1619552843);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sucursal` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `encargado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domicilio1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domicilio2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domicilio3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pais` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigoPostal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`id`, `sucursal`, `telefono`, `email`, `encargado`, `domicilio1`, `domicilio2`, `domicilio3`, `pais`, `codigoPostal`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Spencer PLC', '757-268-7556', 'merlin.little@gmail.com', 'Gwendolyn Langosh', '74296 Kuhn Stravenue', 'Rory Cove', 'Stacy Crest', 'US-ESTADOS-UNIDOS', '79811', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(2, 'Bergnaum PLC', '571.298.3877', 'albert.stiedemann@hotmail.com', 'Piper Fritsch III', '396 Aylin Mall Apt. 224', 'Franecki Stravenue', 'Percival Island', 'MX-MEXICO', '72454', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(3, 'Treutel-Ullrich', '(631) 726-1879', 'amina.kunde@collier.com', 'Obie Robel', '60346 Bauch Prairie', 'Harber Ville', 'Goldner Island', 'MX-MEXICO', '25848', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(4, 'Lynch Group', '1-928-434-0877', 'sven82@gmail.com', 'Mrs. Pink Hermann', '83003 McClure Hills Suite 047', 'Yundt Stream', 'Schultz Ford', 'US-ESTADOS-UNIDOS', '04438', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(5, 'Moore, Mitchell and Sauer', '+1-615-675-3502', 'nsipes@hotmail.com', 'Troy Bernier', '135 Alejandrin Points Suite 386', 'Keebler Point', 'Gerson Pine', 'US-ESTADOS-UNIDOS', '74699', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(6, 'Strosin-Schamberger', '(413) 221-8524', 'ahyatt@hamill.com', 'Alexandro Altenwerth', '413 Cornelius Glen', 'Rhea Parks', 'Anna Road', 'US-ESTADOS-UNIDOS', '88482', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(7, 'Kshlerin, Eichmann and Stoltenberg', '+15414630394', 'dameon.champlin@mohr.com', 'Alena Donnelly', '61833 O\'Keefe Junctions', 'Brock View', 'Jennings Rue', 'MX-MEXICO', '35656-0825', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(8, 'Maggio, Cassin and McDermott', '+12603486203', 'alyson31@daugherty.org', 'Natasha Reynolds V', '10158 Viola Meadow', 'Pfannerstill Forks', 'Kathryne Pike', 'US-ESTADOS-UNIDOS', '59376-0729', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suministros`
--

CREATE TABLE `suministros` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sucursal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `producto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `costo` decimal(8,2) NOT NULL,
  `precioPublico` decimal(8,2) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `suministros`
--

INSERT INTO `suministros` (`id`, `sucursal`, `producto`, `costo`, `precioPublico`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Spencer PLC', 'optio', '7.00', '8.00', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(2, 'Bergnaum PLC', 'nobis', '5.00', '7.00', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(3, 'Treutel-Ullrich', 'eligendi', '3.00', '4.00', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(4, 'Lynch Group', 'quia', '2.00', '3.00', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(5, 'Moore, Mitchell and Sauer', 'veniam', '3.00', '2.00', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(6, 'Strosin-Schamberger', 'dolore', '4.00', '3.00', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(7, 'Kshlerin, Eichmann and Stoltenberg', 'quis', '7.00', '3.00', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(8, 'Maggio, Cassin and McDermott', 'animi', '8.00', '6.00', NULL, '2021-04-20 19:27:57', '2021-04-20 19:27:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `table_users`
--

CREATE TABLE `table_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_medidas`
--

CREATE TABLE `unidad_medidas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unidadMedida` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abreviacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `unidad_medidas`
--

INSERT INTO `unidad_medidas` (`id`, `unidadMedida`, `abreviacion`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Litro', 'm', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(2, 'Kilogramo', 'L', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(3, 'Pieza', 'm', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(4, 'Metro', 'Kg', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(5, 'Metro', 'Kg', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(6, 'Litro', 'Kg', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(7, 'Metro', 'm', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56'),
(8, 'Metro', 'Kg', NULL, '2021-04-20 19:27:56', '2021-04-20 19:27:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profile` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `profile`) VALUES
(1, 'Hardik Savani', 'admin@gmail.com', NULL, '$2y$10$ly09riQTIplfoEeL5Tv4Zue2v0OAkrZS6YtCYblT0/DG17jRTDpw6', NULL, '2021-04-27 03:02:52', '2021-04-27 03:02:52', NULL),
(2, 'John DOE', 'editor@gmail.com', NULL, '$2y$10$ly09riQTIplfoEeL5Tv4Zue2v0OAkrZS6YtCYblT0/DG17jRTDpw6', NULL, '2021-04-27 03:02:52', '2021-04-27 03:02:52', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indices de la tabla `codigospostales`
--
ALTER TABLE `codigospostales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `destinatarios`
--
ALTER TABLE `destinatarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `devices_is_trusted_index` (`is_trusted`),
  ADD KEY `devices_is_untrusted_index` (`is_untrusted`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `laravel_blocker`
--
ALTER TABLE `laravel_blocker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laravel_blocker_typeid_foreign` (`typeId`);

--
-- Indices de la tabla `laravel_blocker_types`
--
ALTER TABLE `laravel_blocker_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `laravel_blocker_types_slug_unique` (`slug`);

--
-- Indices de la tabla `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logins_device_id_index` (`device_id`);

--
-- Indices de la tabla `mensajerias`
--
ALTER TABLE `mensajerias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mercancias`
--
ALTER TABLE `mercancias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `monedas`
--
ALTER TABLE `monedas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `remitentes`
--
ALTER TABLE `remitentes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `suministros`
--
ALTER TABLE `suministros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `table_users`
--
ALTER TABLE `table_users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `unidad_medidas`
--
ALTER TABLE `unidad_medidas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `codigospostales`
--
ALTER TABLE `codigospostales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `destinatarios`
--
ALTER TABLE `destinatarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `devices`
--
ALTER TABLE `devices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `laravel_blocker`
--
ALTER TABLE `laravel_blocker`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `laravel_blocker_types`
--
ALTER TABLE `laravel_blocker_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `logins`
--
ALTER TABLE `logins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `mensajerias`
--
ALTER TABLE `mensajerias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `mercancias`
--
ALTER TABLE `mercancias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `monedas`
--
ALTER TABLE `monedas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `remitentes`
--
ALTER TABLE `remitentes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `suministros`
--
ALTER TABLE `suministros`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `table_users`
--
ALTER TABLE `table_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `unidad_medidas`
--
ALTER TABLE `unidad_medidas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `laravel_blocker`
--
ALTER TABLE `laravel_blocker`
  ADD CONSTRAINT `laravel_blocker_typeid_foreign` FOREIGN KEY (`typeId`) REFERENCES `laravel_blocker_types` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
