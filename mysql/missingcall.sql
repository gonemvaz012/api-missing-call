-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 03-03-2023 a las 20:58:44
-- Versión del servidor: 8.0.29
-- Versión de PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `missingcall`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colas`
--

CREATE TABLE `colas` (
  `id` bigint UNSIGNED NOT NULL,
  `id_cola` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cola` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `colas`
--

INSERT INTO `colas` (`id`, `id_cola`, `cola`, `clid`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Departamento Marketing', '342434', '2023-02-24 00:06:03', '2023-02-24 00:06:03'),
(2, NULL, 'Departamento  Seguridad', '4565', '2023-02-24 00:07:03', '2023-02-24 00:07:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios_llamadas`
--

CREATE TABLE `comentarios_llamadas` (
  `id` bigint UNSIGNED NOT NULL,
  `comentario` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `id_llamada` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_usuario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comentarios_llamadas`
--

INSERT INTO `comentarios_llamadas` (`id`, `comentario`, `id_llamada`, `id_usuario`, `active`, `type`, `created_at`, `updated_at`) VALUES
(3, 'Api result', '1', '1', 0, '2', '2023-02-24 01:11:52', '2023-02-24 01:11:52'),
(4, 'La persona no contesto la llama', '1', '1', 0, '2', '2023-02-24 01:15:48', '2023-02-24 01:15:48'),
(5, 'Api result', '1', '1', 0, '2', '2023-02-24 01:30:26', '2023-02-24 01:30:26'),
(6, 'Todo bien ya contesto', '1', '1', 1, '2', '2023-02-24 01:30:55', '2023-02-24 01:30:55'),
(7, 'Todo bien ya contesto', '1', '1', 1, '2', '2023-02-24 01:31:48', '2023-02-24 01:31:48'),
(8, 'Api result', '2', '1', 0, '2', '2023-02-24 01:33:37', '2023-02-24 01:33:37'),
(9, NULL, '2', '1', 0, '2', '2023-02-24 01:33:40', '2023-02-24 01:33:40'),
(10, 'Api result', '2', '1', 0, '2', '2023-02-24 01:35:56', '2023-02-24 01:35:56'),
(11, 'No contesta', '2', '1', 0, '2', '2023-02-24 01:36:04', '2023-02-24 01:36:04'),
(12, 'Este user nunca contesta', '2', '1', 0, '1', '2023-02-24 01:50:26', '2023-02-24 01:50:26'),
(13, 'Llamada completa', '2', '1', 1, '1', '2023-02-24 01:51:02', '2023-02-24 01:51:02'),
(14, 'Llamada completa', '2', '1', 1, '1', '2023-02-24 01:51:46', '2023-02-24 01:51:46'),
(15, 'Api result', '1324', '1', 0, '2', '2023-02-24 03:57:23', '2023-02-24 03:57:23'),
(16, 'Api result', '1324', '1', 0, '2', '2023-02-24 03:59:56', '2023-02-24 03:59:56'),
(17, 'Api result', '1324', '1', 0, '2', '2023-02-24 04:01:26', '2023-02-24 04:01:26'),
(18, 'Api result', '6', '1', 0, '2', '2023-02-24 05:29:04', '2023-02-24 05:29:04'),
(19, 'Hola es un comentario de prueba', '6', '1', 0, '2', '2023-02-24 05:29:16', '2023-02-24 05:29:16'),
(20, 'Hola es un comentario de prueba', '1324', '1', 1, '2', '2023-02-24 05:29:23', '2023-02-24 05:29:23'),
(21, 'comentario', '6', '1', 0, '1', '2023-02-24 05:29:44', '2023-02-24 05:29:44'),
(22, 'prueba', '6', '6', 0, '1', '2023-02-24 05:44:15', '2023-02-24 05:44:15'),
(23, 'Api result', '6', '3', 0, '2', '2023-02-28 19:15:29', '2023-02-28 19:15:29'),
(24, 'hemos llamado al cliente sin exito.', '6', '3', 0, '2', '2023-02-28 19:15:58', '2023-02-28 19:15:58'),
(25, 'Api result', '5', '3', 0, '2', '2023-03-01 13:11:08', '2023-03-01 13:11:08'),
(26, 'El cliente no puede atenderlo y me dice que lo llame mañana,', '5', '3', 0, '2', '2023-03-01 13:11:46', '2023-03-01 13:11:46'),
(27, 'paso a nota recambios y espero respuesta', '4', '6', 0, '1', '2023-03-01 13:46:04', '2023-03-01 13:46:04'),
(28, 'Api result', '4', '6', 0, '2', '2023-03-01 13:48:15', '2023-03-01 13:48:15'),
(29, 'me dice que lo llame mañana', '4', '6', 0, '2', '2023-03-01 13:48:33', '2023-03-01 13:48:33'),
(30, 'la pieza cuesta 30€. manda email y espero contestacion del cliente', '4', '6', 0, '1', '2023-03-01 13:50:29', '2023-03-01 13:50:29'),
(31, 'Api result', '4', '6', 0, '2', '2023-03-01 13:53:54', '2023-03-01 13:53:54'),
(32, 'no puede hablar ahora y me indica que lo llame despues', '4', '6', 0, '2', '2023-03-01 13:54:56', '2023-03-01 13:54:56'),
(33, 'Api result', '4', '6', 0, '2', '2023-03-01 13:58:11', '2023-03-01 13:58:11'),
(34, 'cliente informado acepta rearacion.', '4', '6', 1, '2', '2023-03-01 13:58:38', '2023-03-01 13:58:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestiones_realizadas`
--

CREATE TABLE `gestiones_realizadas` (
  `id_gestion` bigint UNSIGNED NOT NULL,
  `fecha` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_usuario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comentarios` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `devolucion_efectiva` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_llamada_estado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `llamadas`
--

CREATE TABLE `llamadas` (
  `id_llamada_estado` bigint UNSIGNED NOT NULL,
  `id_llamada` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cola` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_llamante` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado_tramitacion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `llamadas`
--

INSERT INTO `llamadas` (`id_llamada_estado`, `id_llamada`, `cola`, `numero_llamante`, `fecha`, `hora`, `estado`, `estado_tramitacion`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '3436453425', '2023-02-23', '04:00', 'No Atendida', 'Completada', NULL, '2023-02-24 01:31:48'),
(2, '2', '2', '3436453425', '2023-02-23', '04:00', 'No Atendida', 'Completada', NULL, '2023-02-24 01:51:46'),
(4, '4', '1', '34333453425', '2023-02-23', '04:00', 'No Atendida', 'Completada', NULL, '2023-03-01 13:58:38'),
(5, '5', '2', '3437753425', '2023-02-23', '04:00', 'No Atendida', 'Tramitandose', NULL, '2023-03-01 13:11:08'),
(6, '6', '1', '3436000563', '2023-01-23', '05:00', 'No Atendida', 'Tramitandose', NULL, '2023-02-24 05:26:33'),
(1324, '3', '2', '34364544563', '2023-01-23', '05:00', 'Completada', 'Completada', NULL, '2023-02-24 05:29:23'),
(1325, '3455', '1', '04267966442', '2023-02-23', '04:00', 'No Atendida', 'Completada', NULL, '2023-03-02 05:39:20'),
(1326, '2344', '2', '04127864534', '2023-02-23', '04:00', 'No Atendida', 'Completada', NULL, '2023-03-02 05:38:52'),
(1327, '4768', '1', '04160987656', '2023-02-23', '04:00', 'No Atendida', 'Completada', NULL, '2023-03-02 05:35:07'),
(1328, '5656', '2', '04124644207', '2023-02-23', '04:00', 'No Atendida', 'Completada', NULL, '2023-03-02 05:34:41'),
(1329, '6789', '1', '04165344833', '2023-01-23', '05:00', 'No Atendida', 'Completada', NULL, '2023-03-02 04:40:12'),
(1330, '3', '2', '34364544563', '2023-01-23', '05:00', 'Sonando', 'Completada', NULL, '2023-02-24 05:29:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `llamadas_contestadas`
--

CREATE TABLE `llamadas_contestadas` (
  `id_llamada_contestada` bigint UNSIGNED NOT NULL,
  `duracion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agente_atiende` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_llamada` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `llamadas_realizadas`
--

CREATE TABLE `llamadas_realizadas` (
  `id_llamada_realizada` bigint UNSIGNED NOT NULL,
  `fecha` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_usuario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comentarios` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `devolucion_efectiva` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_llamada_estado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_callid` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `api_result` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2023_02_13_152834_create_colas_table', 1),
(10, '2023_02_13_152855_create_llamadas_table', 1),
(11, '2023_02_13_155821_create_comentarios_llamadas_table', 1),
(12, '2023_02_23_194229_create_llamadas_realizadas_table', 1),
(13, '2023_02_23_194241_create_gestiones_realizadas_table', 1),
(14, '2023_02_23_202443_create_llamadas_contestadas_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('0aa78edc6c8a9a8d07da72b65c1add726fbd24e8edf6b973b490a03a93a969dfb596c192b21f8d79', 3, 1, 'Token Web', '[]', 0, '2023-03-01 12:37:56', '2023-03-01 12:37:56', '2024-03-01 12:37:56'),
('2b4a69940e0ebf185ff0648a51a0b883ce7617534bb40f601ab8c33c9dd592889768d96db089b25d', 3, 1, 'Token Web', '[]', 0, '2023-02-28 18:23:14', '2023-02-28 18:23:14', '2024-02-28 18:23:14'),
('52fe7a6152c63133d0f6b970d05d9b05d7efdad3fe757d4c880764903e96a8fa30e8b65e5e8bc7f4', 3, 1, 'Token Web', '[]', 0, '2023-03-01 12:40:38', '2023-03-01 12:40:38', '2024-03-01 12:40:38'),
('5c7d74adff354492487f0014957cc52e83e77d6b47ad56c2fcb9e711b7d935c4d2621d77f29fb319', 1, 1, 'Token Web', '[]', 0, '2023-03-01 02:58:12', '2023-03-01 02:58:12', '2024-03-01 02:58:12'),
('9429f2cab364666eadc3c842c6508151ccee15837a731e87ab8f2346479d1664fe2de1ae46b1533d', 3, 1, 'Token Web', '[]', 0, '2023-02-24 02:31:22', '2023-02-24 02:31:22', '2024-02-24 02:31:22'),
('9cb3b3582510c57570d5bf63a103e42237d64582d3e8ab612d2461ee0762025c17f0cffe63b4450d', 3, 1, 'Token Web', '[]', 0, '2023-02-24 02:30:47', '2023-02-24 02:30:47', '2024-02-24 02:30:47'),
('a4a6915cf61f5ca6777ca4359e7bea65d4e23c85721c5fb4b55cd4e0b255ec666ee73708d704a3dc', 3, 1, 'Token Web', '[]', 0, '2023-02-24 17:52:26', '2023-02-24 17:52:26', '2024-02-24 17:52:26'),
('a7c98795495986aa14ced97fac6ccb0fb2e2ca024a51166e2c3f52f9cb6696ed06e99adf3e04a96c', 1, 1, 'Token Web', '[]', 0, '2023-02-24 00:07:13', '2023-02-24 00:07:13', '2024-02-23 21:07:13'),
('a9df3acbd95432e87a6d4581f3cd7f2e19b64177e36f320807d6e049ef2929861e5cbfb18dd929e5', 1, 1, 'Token Web', '[]', 0, '2023-02-24 05:20:36', '2023-02-24 05:20:36', '2024-02-24 02:20:36'),
('d98d4b790c571eaec987d767aba80d853dd1575d20dfc889538e01ced782861a1572dcbdf25e3f5b', 1, 1, 'Token Web', '[]', 0, '2023-02-24 00:00:56', '2023-02-24 00:00:56', '2024-02-23 21:00:56'),
('d9a1256195c3cdc116ced239adad2fda1798a13d8f85f60551a9edf279aeaaed3f7b06941efd72f6', 2, 1, 'Token Web', '[]', 0, '2023-02-24 00:05:42', '2023-02-24 00:05:42', '2024-02-23 21:05:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'esirnuvEHdiJWp3LmOyUW9kwTofepcIDmkx1aFzb', NULL, 'http://localhost', 1, 0, 0, '2023-02-24 00:00:53', '2023-02-24 00:00:53'),
(2, NULL, 'Laravel Password Grant Client', 'q4tz3CNuwXWkyIWv2q13MbIGp82vodKaVa2XA598', 'users', 'http://localhost', 0, 1, 0, '2023-02-24 00:00:53', '2023-02-24 00:00:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-02-24 00:00:53', '2023-02-24 00:00:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usuario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extension` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `type` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `usuario`, `extension`, `email_verified_at`, `type`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Alexis Carvajal', NULL, 'alexisjcr7', '0001', NULL, 'user', '$2y$10$Mq2StcUIvyzuep1S0mX0VeuLBF2KRjpOywGMxP5KSZVXxk2O5zRWG', NULL, '2023-02-24 00:00:15', '2023-02-24 00:00:15'),
(2, 'Administrador', NULL, 'admin', '0001', NULL, 'admin', '$2y$10$OCxLGys3kRpzok4E/xSpwuDEQWJX0133v/Ck8osf3b6xKwxiAqVAW', NULL, '2023-02-24 00:00:15', '2023-02-24 00:00:15'),
(3, 'Alberto Romario', NULL, 'alberto', '0002', NULL, 'user', '$2y$10$Mq2StcUIvyzuep1S0mX0VeuLBF2KRjpOywGMxP5KSZVXxk2O5zRWG', NULL, '2023-02-24 00:00:15', '2023-02-24 00:00:15');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `colas`
--
ALTER TABLE `colas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios_llamadas`
--
ALTER TABLE `comentarios_llamadas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gestiones_realizadas`
--
ALTER TABLE `gestiones_realizadas`
  ADD PRIMARY KEY (`id_gestion`);

--
-- Indices de la tabla `llamadas`
--
ALTER TABLE `llamadas`
  ADD PRIMARY KEY (`id_llamada_estado`);

--
-- Indices de la tabla `llamadas_contestadas`
--
ALTER TABLE `llamadas_contestadas`
  ADD PRIMARY KEY (`id_llamada_contestada`);

--
-- Indices de la tabla `llamadas_realizadas`
--
ALTER TABLE `llamadas_realizadas`
  ADD PRIMARY KEY (`id_llamada_realizada`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `colas`
--
ALTER TABLE `colas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `comentarios_llamadas`
--
ALTER TABLE `comentarios_llamadas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gestiones_realizadas`
--
ALTER TABLE `gestiones_realizadas`
  MODIFY `id_gestion` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `llamadas`
--
ALTER TABLE `llamadas`
  MODIFY `id_llamada_estado` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1331;

--
-- AUTO_INCREMENT de la tabla `llamadas_contestadas`
--
ALTER TABLE `llamadas_contestadas`
  MODIFY `id_llamada_contestada` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `llamadas_realizadas`
--
ALTER TABLE `llamadas_realizadas`
  MODIFY `id_llamada_realizada` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
