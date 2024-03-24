-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Mar-2024 às 20:44
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gesimoveis`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `contrato`
--

CREATE TABLE IF NOT EXISTS `contrato` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_inquilino` bigint(20) UNSIGNED NOT NULL,
  `id_imovel` bigint(20) UNSIGNED NOT NULL,
  `id_tipo_contrato` bigint(20) UNSIGNED NOT NULL,
  `data_ini` date NOT NULL,
  `data_fim` date NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `perocidade_pag` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `data_termino` date DEFAULT NULL,
  `valor_pago` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contrato_id_inquilino_foreign` (`id_inquilino`),
  KEY `contrato_id_imovel_foreign` (`id_imovel`),
  KEY `contrato_id_tipo_contrato_foreign` (`id_tipo_contrato`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `despesa`
--

CREATE TABLE IF NOT EXISTS `despesa` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_imovel` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_tipo_despesa` bigint(20) UNSIGNED NOT NULL,
  `data` date NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `despesa_id_imovel_foreign` (`id_imovel`),
  KEY `despesa_id_user_foreign` (`id_user`),
  KEY `despesa_id_tipo_despesa_foreign` (`id_tipo_despesa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fotos`
--

CREATE TABLE IF NOT EXISTS `fotos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_imovel` bigint(20) UNSIGNED NOT NULL,
  `foto` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fotos_id_imovel_foreign` (`id_imovel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `imovel`
--

CREATE TABLE IF NOT EXISTS `imovel` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_tipo_imovel` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `area` decimal(10,2) NOT NULL,
  `morada` varchar(255) NOT NULL,
  `andar` varchar(255) NOT NULL,
  `num_divisoes` int(11) NOT NULL,
  `ano_construcao` int(11) NOT NULL,
  `val_seguro` decimal(10,2) NOT NULL,
  `val_imi` decimal(10,2) NOT NULL,
  `val_condominio` decimal(10,2) NOT NULL,
  `data_aquisicao` date NOT NULL,
  `preco_compra` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `imovel_id_tipo_imovel_foreign` (`id_tipo_imovel`),
  KEY `imovel_id_user_foreign` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `inquilino`
--

CREATE TABLE IF NOT EXISTS `inquilino` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `apelido` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telemovel` varchar(20) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `morada` varchar(255) NOT NULL,
  `codigo_postal` varchar(20) NOT NULL,
  `nif` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_02_23_211552_create_tipo_despesa_table', 1),
(6, '2024_02_23_211553_create_tipo_contrato_table', 1),
(7, '2024_02_23_211555_create_tipo_imovel_table', 1),
(8, '2024_02_23_211556_create_imovel_table', 1),
(9, '2024_02_23_211557_create_despesa_table', 1),
(10, '2024_02_23_211557_create_inquilino_table', 1),
(11, '2024_02_23_211558_create_contrato_table', 1),
(12, '2024_02_23_211559_create_pagamento_table', 1),
(13, '2024_02_23_211600_create_fotos_table', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento`
--

CREATE TABLE IF NOT EXISTS `pagamento` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_contrato` bigint(20) UNSIGNED NOT NULL,
  `data_pag` date NOT NULL,
  `metodo_pag` varchar(255) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pagamento_id_contrato_foreign` (`id_contrato`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_reset_tokens`
--

CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `personal_access_tokens`
--

CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_contrato`
--

CREATE TABLE IF NOT EXISTS `tipo_contrato` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_despesa`
--

CREATE TABLE IF NOT EXISTS `tipo_despesa` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_imovel`
--

CREATE TABLE IF NOT EXISTS `tipo_imovel` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role` enum('admin','proprietario') NOT NULL DEFAULT 'proprietario',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `telemovel` varchar(255) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `morada` varchar(255) DEFAULT NULL,
  `codigo_postal` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `pais` varchar(255) DEFAULT NULL,
  `nif` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `estado` enum('ativo','inativo') NOT NULL DEFAULT 'ativo',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `email`, `email_verified_at`, `password`, `telemovel`, `telefone`, `titulo`, `morada`, `codigo_postal`, `cidade`, `pais`, `nif`, `foto`, `estado`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@ipvc.pt', NULL, '$2y$12$o/EvmWKttu6yffVnKdAKS.RB2F9UgsBCX1WMIGnFKAa28gDuqlmvK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', NULL, NULL, NULL);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `contrato`
--
ALTER TABLE `contrato`
  ADD CONSTRAINT `contrato_id_imovel_foreign` FOREIGN KEY (`id_imovel`) REFERENCES `imovel` (`id`),
  ADD CONSTRAINT `contrato_id_inquilino_foreign` FOREIGN KEY (`id_inquilino`) REFERENCES `inquilino` (`id`),
  ADD CONSTRAINT `contrato_id_tipo_contrato_foreign` FOREIGN KEY (`id_tipo_contrato`) REFERENCES `tipo_contrato` (`id`);

--
-- Limitadores para a tabela `despesa`
--
ALTER TABLE `despesa`
  ADD CONSTRAINT `despesa_id_imovel_foreign` FOREIGN KEY (`id_imovel`) REFERENCES `imovel` (`id`),
  ADD CONSTRAINT `despesa_id_tipo_despesa_foreign` FOREIGN KEY (`id_tipo_despesa`) REFERENCES `tipo_despesa` (`id`),
  ADD CONSTRAINT `despesa_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `fotos_id_imovel_foreign` FOREIGN KEY (`id_imovel`) REFERENCES `imovel` (`id`);

--
-- Limitadores para a tabela `imovel`
--
ALTER TABLE `imovel`
  ADD CONSTRAINT `imovel_id_tipo_imovel_foreign` FOREIGN KEY (`id_tipo_imovel`) REFERENCES `tipo_imovel` (`id`),
  ADD CONSTRAINT `imovel_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `pagamento`
--
ALTER TABLE `pagamento`
  ADD CONSTRAINT `pagamento_id_contrato_foreign` FOREIGN KEY (`id_contrato`) REFERENCES `contrato` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
