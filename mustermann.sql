-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 21. Jul 2025 um 21:08
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `mustermann`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ausstattung`
--

CREATE TABLE `ausstattung` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `beschreibung` text DEFAULT NULL,
  `preis` decimal(6,2) DEFAULT NULL,
  `bildpfad` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `ausstattung`
--

INSERT INTO `ausstattung` (`id`, `name`, `beschreibung`, `preis`, `bildpfad`) VALUES
(1, 'GPU GeForce RTX 4060', 'Leistungsstarke Mittelklasse-Grafikkarte mit Raytracing', 369.99, 'gpu4060.jpg'),
(2, 'GPU Radeon RX 6700 XT', 'AMD Gaming-GPU mit 12 GB VRAM', 329.00, 'gpu6700xt.jpg'),
(3, '1TB SSD NVMe', 'Superschnelle SSD für Betriebssystem und Spiele', 119.00, 'ssd1tb.jpg'),
(4, '2TB SSD SATA', 'Großer Speicherplatz mit solider Performance', 149.00, 'ssd2tb.jpg'),
(5, 'RGB Lüfter 120mm', 'Leiser Gehäuselüfter mit RGB-Beleuchtung', 12.99, 'luefter_rgb.jpg'),
(6, 'Silent Lüfter 140mm', 'Besonders leise für optimale Kühlung', 14.99, 'luefter_silent.webp');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE `benutzer` (
  `id` int(11) NOT NULL,
  `anrede` varchar(10) DEFAULT NULL,
  `vorname` varchar(50) NOT NULL,
  `nachname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `firma` varchar(100) DEFAULT NULL,
  `ort` varchar(100) DEFAULT NULL,
  `strasse` varchar(100) NOT NULL,
  `plz` varchar(5) NOT NULL,
  `passwort` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`id`, `anrede`, `vorname`, `nachname`, `email`, `firma`, `ort`, `strasse`, `plz`, `passwort`) VALUES
(1, 'Frau', 'Mengyu', 'Wang', 'guiqulaixi2021@gmail.com', 'Technical University of Mittelhessen', 'Friedberg', 'in der Burg 15', '61169', '$2y$10$za5inLPadSC9ZTmTTpxhpu9MJqxX614EQ979hNE.tMQuJwWCHt/BK'),
(2, 'Herr', 'Jiaxu', 'Shen', 'jxshen2009@outlook.com', '', 'Frankfurt', 'Sigmund Freud Strasse 107', '60435', '$2y$10$CQVfnbJ9a12AHsHWXy3k9.onzTSMjvDLaEkcehWZ6KazNLFctZAnq'),
(7, 'Herr', 'omer faruk', 'kulaksiz', 'omer.faruk.kulaksiz@outlook.com', '', 'Friedberg(Hessen)', 'hanauer str 51', '61169', '$2y$10$18yuHfNfEaxAi0GpTN827.Ixug47ihSs/vXzRdVdYXGfaycQSjvK.'),
(9, 'Frau', 'Mengyu', 'Wang', '908721102@qq.com', 'Technical University of Mittelhessen', 'Friedberg(Hessen)', 'in der Burg 15', '61169', '$2y$10$sgTWBRruBeYTyP3YsLKvr.tjS2EJmnWd9A65NyT5gKlKFxufNmlky'),
(10, 'Herr', 'hjjhj', 'hjhjhj', 'jhhj@thn.de', 'hjhjh', 'hjh', 'hjh', '55555', '$2y$10$QwhGMJbMdRkW/GPw0qTZY.jOx2l/lUuPTosKlicd/OAbZvOBP4v4K'),
(11, 'Frau', 'Mengyu', 'Wang', '908721103@qq.com', 'Technical University of Mittelhessen', 'Friedberg(Hessen)', 'in der Burg 15', '61169', '$2y$10$ch2ohoL12mLhAcqjW6IOT.qx/BPsXiweq704HKA34V0tgUPP7svDe'),
(12, 'Divers', 'Mengyu', 'Wang', '908721104@qq.com', 'Technical University of Mittelhessen', 'Friedberg(Hessen)', 'in der Burg 15', '61169', '$2y$10$iK919Z2zgfOFnVO5XEsZOuV2Dyj.bVLzgI/jx85n2ME6f2U0qcYTy'),
(13, 'Frau', 'Meng', 'Wang', '908721105@qq.com', 'Technical University of Mittelhessen', 'Friedberg(Hessen)', 'in der Burg 15', '61169', '$2y$10$yrcA1pIVFCnTJh9jCSseIOIQbTDhF2hx18JGX/AOsgP7zpPABLy4O'),
(14, 'Frau', 'Meng', 'Wang', '908721106@qq.com', 'Technical University of Mittelhessen', 'Friedberg(Hessen)', 'in der Burg 15', '61169', '$2y$10$Z4DWaye.oqxlrweKqGD6PeJ8HqHm3Wf/TDtjszFRwG.PPD5Gv5/ya'),
(15, 'Frau', 'Meng', 'Wang', '908721109@qq.com', 'Technical University of Mittelhessen', 'Friedberg(Hessen)', 'in der Burg 15', '61169', '$2y$10$7VufzPIoCy2ERfxaYfIFwu5jFsLhIqXEWgHfN5PBQRtyNB7rMZT6G'),
(16, 'Frau', 'Meng', 'Wang', '12345@qq.com', 'Technical University of Mittelhessen', 'Friedberg(Hessen)', 'in der Burg 15', '61169', '$2y$10$/6.JNhBUiW6WA.vfjy7Tdec3TRx3dW7wf/wmfezVNhctqeV12pZr2'),
(17, 'Frau', 'Meng', 'Wang', '90872110@qq.com', 'Technical University of Mittelhessen', 'Friedberg(Hessen)', 'in der Burg 15', '61169', '$2y$10$0n70U7Deni2Q5dgKerzf7ec.nInOXCrbJLCrqAt0LmUOtW9XwpmMi');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellung`
--

CREATE TABLE `bestellung` (
  `id` int(11) NOT NULL,
  `benutzer_id` int(11) NOT NULL,
  `gehaeuse` varchar(50) DEFAULT NULL,
  `cpu` varchar(255) DEFAULT NULL,
  `ram` varchar(255) DEFAULT NULL,
  `os` varchar(255) DEFAULT NULL,
  `software` varchar(255) DEFAULT NULL,
  `zubehoer` varchar(255) DEFAULT NULL,
  `ausstattung` varchar(255) DEFAULT NULL,
  `monitore` varchar(255) DEFAULT NULL,
  `bestelldatum` datetime DEFAULT current_timestamp(),
  `gesamtpreis` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `bestellung`
--

INSERT INTO `bestellung` (`id`, `benutzer_id`, `gehaeuse`, `cpu`, `ram`, `os`, `software`, `zubehoer`, `ausstattung`, `monitore`, `bestelldatum`, `gesamtpreis`) VALUES
(1, 1, '', '', '', '', '', '', '', '2', '2025-07-16 20:50:54', NULL),
(2, 1, '', '', '', '', '', '', '', '3', '2025-07-16 20:55:10', NULL),
(3, 1, '', '', '', '', '', '', '', '', '2025-07-16 20:55:15', NULL),
(4, 1, '', '', '', '', '', '', '', '', '2025-07-16 22:03:54', NULL),
(5, 1, '', '', '', '', '', '', '', '', '2025-07-16 22:04:20', NULL),
(6, 1, '', '', '', '', '', '', '', '6', '2025-07-16 22:11:38', NULL),
(7, 1, '', '', '', '', '', '', '', '1', '2025-07-16 22:39:48', NULL),
(8, 1, '', '', '', '', '', '', '', '', '2025-07-16 22:53:25', NULL),
(9, 1, '', '', '', '', '', '', '', '6', '2025-07-16 22:53:33', NULL),
(10, 1, '', '', '', '', '', '', '', '2', '2025-07-16 23:24:02', NULL),
(11, 1, '', '', '', '', '', '', '', '', '2025-07-17 01:01:19', NULL),
(12, 7, '', '', '', '', '', '', '', '2', '2025-07-17 17:00:56', NULL),
(13, 9, '', '', '', '', '', '', '', '', '2025-07-18 18:46:06', NULL),
(14, 9, '', '', '', '', '', '', '', '5', '2025-07-18 18:50:07', NULL),
(15, 10, '', '', '', '', '', '', '', '', '2025-07-19 12:02:36', NULL),
(16, 9, '', '', '', '', '', '', '', '', '2025-07-19 13:31:55', NULL),
(17, 9, '', '', '', '', '', '', '', '', '2025-07-19 13:32:11', NULL),
(18, 9, '', '', '', '', '', '', '', '', '2025-07-19 19:49:28', NULL),
(19, 9, '', '', '', '', '', '', '', '6', '2025-07-19 20:38:12', NULL),
(20, 9, '', '', '', '', '', '', '', '6', '2025-07-19 20:55:56', NULL),
(21, 9, '', '', '', '', '', '', '', '6', '2025-07-19 20:57:33', NULL),
(22, 9, '', '', '', '', '', '', '', '6', '2025-07-19 20:58:34', NULL),
(23, 9, '', '', '', '', '', '', '', '6', '2025-07-19 20:59:52', NULL),
(24, 9, '', '', '', '', '', '', '', '6', '2025-07-19 21:00:56', NULL),
(25, 9, '', '', '', '', '', '', '', '5', '2025-07-19 21:11:27', NULL),
(26, 9, '', '', '', '', '', '', '', '5', '2025-07-19 21:11:40', NULL),
(27, 9, '', '', '', '1', '', '', '', '3', '2025-07-20 11:50:21', NULL),
(28, 9, 'maxi', 'Core i7-13620H', '60', '3', '', '1,7', '6', '6', '2025-07-20 15:44:24', NULL),
(29, 9, '', '', '', '', '', '', '', '6', '2025-07-20 16:24:42', NULL),
(30, 9, 'midi', 'Core i7-13620H', '24', '1', '', '1,2,6', '2,5', '3', '2025-07-20 16:26:56', NULL),
(31, 9, 'midi', 'Core i3-14100F', '28', '2', '3,5', '2,7', '3,5', '3', '2025-07-20 16:52:52', NULL),
(32, 9, 'midi', 'Core i3-14100F', '28', '2', '3,5', '2,7', '3,5', '3', '2025-07-20 18:08:17', NULL),
(33, 11, 'midi', 'Core i3-14100F', '28', '3', '5', '1', '6', '2,6', '2025-07-20 19:11:09', NULL),
(34, 11, '', '', '', '2', '3', '', '', '2,6', '2025-07-20 23:15:32', NULL),
(35, 12, '', 'Core i9-14900KS', '32', '3', '3', '2,7', '2', '1,6', '2025-07-20 23:32:29', NULL),
(36, 12, '', 'Core i9-14900KS', '32', '3', '3', '2,7', '2', '1,6', '2025-07-20 23:35:35', NULL),
(37, 12, 'midi', 'Core i9-14900KS', '32', '3', '3', '2,7', '2', '1,6', '2025-07-20 23:38:37', NULL),
(38, 13, 'midi', '', '', '', '', '', '', '2,6', '2025-07-20 23:44:23', NULL),
(39, 9, 'midi', 'Core i7-13620H', '12', '1', '2,5', '1,5', '5,6', '1,5', '2025-07-20 23:45:47', NULL),
(40, 9, 'midi', '', '', '', '', '', '', '', '2025-07-21 02:23:43', NULL),
(41, 14, 'midi', '', '', '', '', '', '', '2', '2025-07-21 13:07:52', NULL),
(42, 9, 'midi', 'Core i7-13620H', '28', '1', '5', '1,2', '2,6', '6', '2025-07-21 13:09:06', NULL),
(43, 9, 'midi', 'Core i7-13620H', '28', '3', '4,5', '5', '1,5', '6', '2025-07-21 13:11:24', NULL),
(44, 9, '', 'Ryzen 7 7800X', '24', '1', '5', '1,2', '2,6', '1,5', '2025-07-21 13:27:12', NULL),
(45, 9, 'midi', 'Ryzen 7 7800X', '20', '1', '2,3', '1,5', '5', '5,6', '2025-07-21 13:28:35', NULL),
(46, 14, 'midi', 'Ryzen 5 7600', '16', '2', '3,5', '1,2,6', '2,6', '3,6', '2025-07-21 14:11:19', NULL),
(47, 9, 'midi', '', '', '', '', '', '', '2,6', '2025-07-21 14:59:20', NULL),
(48, 9, 'desktop', 'Core i7-13620H', '16', '2', '5', '2', '2', '3', '2025-07-21 15:00:36', NULL),
(49, 15, 'desktop', '', '', '', '', '', '', '6', '2025-07-21 15:37:32', NULL),
(50, 16, 'midi', 'Core i7-13620H', '16', '1', '5', '1', '1', '1,6', '2025-07-21 15:45:49', NULL),
(51, 15, 'midi', 'Core i7-13620H', '24', '3', '3,4', '1,6', '2,6', '1,5', '2025-07-21 15:47:42', NULL),
(52, 15, 'midi', '', '', '', '', '', '', '', '2025-07-21 15:47:53', NULL),
(53, 9, 'midi', 'Core i7-13620H', '24', '1', '2,5', '1', '1', '2,6', '2025-07-21 15:50:16', NULL),
(54, 9, 'midi', '', '', '', '', '', '', '2', '2025-07-21 15:50:32', NULL),
(55, 9, 'midi', '', '', '2', '3,4', '', '', '3,6', '2025-07-21 18:11:33', NULL),
(56, 9, 'maxi', '', '', '', '', '', '', '', '2025-07-21 18:37:31', NULL),
(57, 15, 'midi', 'Ryzen 7 7800X', '100', '2', '3,4', '', '', '2,6', '2025-07-21 19:07:38', 0.00),
(58, 15, '', '', '', '', '', '', '', '6', '2025-07-21 19:07:57', 0.00),
(59, 15, '', '', '', '', '', '', '', '', '2025-07-21 19:13:37', 0.00),
(60, 15, 'midi', 'Ryzen 7 7800X', '28', '2', '3', '', '', '2,6', '2025-07-21 19:15:53', 0.00),
(61, 9, 'midi', 'Ryzen 5 7600', '28', '2', '3,5', '1,3', '2,6', '2,6', '2025-07-21 19:24:54', 0.00),
(62, 9, '', '', '', '2', '3', '', '', '2,6', '2025-07-21 19:25:29', 0.00),
(63, 9, 'midi', 'Core i7-13620H', '32', '3', '3,5', '1,6', '2,6', '3,6', '2025-07-21 19:47:02', 0.00),
(64, 9, 'midi', 'Core i7-13620H', '32', '3', '3,5', '1,6', '2,6', '2,6', '2025-07-21 19:47:43', 0.00),
(65, 9, 'midi', 'Core i7-13620H', '32', '3', '3,5', '1,6', '2,6', '2,6', '2025-07-21 19:47:50', 0.00),
(66, 9, '', '', '', '', '', '', '', '2', '2025-07-21 19:47:58', 0.00),
(67, 9, 'midi', 'Core i7-13620H', '20', '2', '3,5', '1,7', '2,3', '2,3', '2025-07-21 19:49:09', 0.00),
(68, 9, 'midi', 'Core i3-14100F', '4', '2', '4,5', '6,7', '6', '2,3', '2025-07-21 20:37:39', 79.00),
(69, 9, 'midi', 'Core i3-14100F', '4', '2', '4,5', '6,7', '6', '2,3', '2025-07-21 20:38:48', 79.00),
(70, 9, '', '', '', '', '', '', '', '', '2025-07-21 20:38:54', 0.00),
(71, 15, 'maxi', 'Core i7-13620H', '20', '2', '3,5', '1,7', '1,6', '3,6', '2025-07-21 20:40:53', 299.00),
(72, 15, 'maxi', 'Core i7-13620H', '20', '2', '3,5', '1,7', '1,6', '3,6', '2025-07-21 20:43:43', 299.00),
(73, 15, 'maxi', 'Core i7-13620H', '20', '2', '3,5', '1,7', '1,6', '3,6', '2025-07-21 20:43:44', 299.00),
(74, 15, 'maxi', 'Core i7-13620H', '20', '2', '3,5', '1,7', '1,6', '3,6', '2025-07-21 20:43:51', 299.00),
(75, 15, 'maxi', 'Core i7-13620H', '20', '2', '3,5', '1,7', '1,6', '3,6', '2025-07-21 20:43:53', 299.00),
(76, 15, '', '', '', '', '', '', '', '', '2025-07-21 20:43:58', 0.00),
(77, 15, 'maxi', 'Core i7-13620H', '20', '2', '3,4', '2,3', '2,6', '1,5', '2025-07-21 20:44:50', 299.00),
(78, 15, 'maxi', 'Core i7-13620H', '20', '2', '3,4', '2,3', '2,6', '1,5', '2025-07-21 20:49:15', 299.00),
(79, 15, '', '', '', '', '', '', '', '', '2025-07-21 20:49:19', 0.00),
(80, 9, 'desktop', 'Core i7-13620H', '20', '2', '3,5', '2,5', '2,6', '2,3', '2025-07-21 20:50:16', 299.00),
(81, 9, 'desktop', 'Core i7-13620H', '20', '2', '3,5', '2,5', '2,6', '2,3', '2025-07-21 20:59:32', 299.00),
(82, 9, 'desktop', 'Core i7-13620H', '20', '2', '3,5', '2,5', '2,6', '2,3', '2025-07-21 20:59:45', 299.00),
(83, 9, '', '', '', '', '', '', '', '', '2025-07-21 20:59:48', 0.00),
(84, 9, 'maxi', 'Core i7-13620H', '16', '2', '3,4,5', '2,7', '3,6', '2,6', '2025-07-21 21:00:36', 299.00),
(85, 9, 'maxi', 'Core i7-13620H', '16', '2', '3,4,5', '2,6', '1,6', '2,6', '2025-07-21 21:03:18', 299.00),
(86, 9, 'maxi', 'Core i7-13620H', '16', '2', '3,4,5', '2,6', '1,6', '2,5', '2025-07-21 21:03:28', 299.00),
(87, 9, 'maxi', 'Core i7-13620H', '16', '2', '3,4,5', '2,6', '1,6', '2,5', '2025-07-21 21:03:44', 299.00),
(88, 9, '', '', '', '', '', '', '', '', '2025-07-21 21:03:48', 0.00),
(89, 17, 'midi', 'Ryzen 7 7800X', '24', '3', '3,4', '2,6', '2,6', '2,3', '2025-07-21 21:06:15', 359.00);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cpus`
--

CREATE TABLE `cpus` (
  `id` int(11) NOT NULL,
  `modell` varchar(100) NOT NULL,
  `produktnummer` varchar(50) NOT NULL,
  `hersteller` enum('Intel','AMD') NOT NULL,
  `preis` decimal(10,2) NOT NULL,
  `max_ram` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `cpus`
--

INSERT INTO `cpus` (`id`, `modell`, `produktnummer`, `hersteller`, `preis`, `max_ram`) VALUES
(1, 'Core i3-14100F', 'BX8071514100F', 'Intel', 79.00, 128),
(2, 'Core i7-13620H', 'BX8071513620H', 'Intel', 299.00, 96),
(3, 'Core i9-14900KS', 'BX8071514900KS', 'Intel', 749.00, 192),
(4, 'Ryzen 5 7600', '100-100001015BOX', 'AMD', 199.00, 128),
(5, 'Ryzen 7 7800X', '100-10000159WOF', 'AMD', 359.00, 128),
(6, 'Ryzen 9 7950X', '100-100000514WOF', 'AMD', 599.00, 256);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `monitore`
--

CREATE TABLE `monitore` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `groesse_zoll` int(11) DEFAULT NULL,
  `preis` decimal(6,2) DEFAULT NULL,
  `bildpfad_thumb` varchar(255) DEFAULT NULL,
  `bildpfad_gross` varchar(255) DEFAULT NULL,
  `beschreibung` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `monitore`
--

INSERT INTO `monitore` (`id`, `name`, `groesse_zoll`, `preis`, `bildpfad_thumb`, `bildpfad_gross`, `beschreibung`) VALUES
(1, 'Full HD Monitor 22\"', 22, 89.99, 'monitor22_thumb.jpg', 'monitor22.jpg', 'Kompakter 22-Zoll-Monitor mit Full HD-Auflösung und HDMI-Anschluss.'),
(2, 'Full HD Monitor 24\"', 24, 109.00, 'monitor24_thumb.jpg', 'monitor24.jpg', '24-Zoll-Monitor mit brillanter Darstellung und schmalem Rahmen.'),
(3, 'QHD Monitor 27\"', 27, 179.00, 'monitor27_thumb.jpg', 'monitor27.jpg', '27-Zoll-Monitor mit QHD-Auflösung für mehr Platz auf dem Desktop.'),
(4, '4K UHD Monitor 32\"', 32, 249.00, 'monitor32_thumb.jpg', 'monitor32.jpg', 'Großer 32-Zoll-Monitor mit gestochen scharfer 4K-Auflösung.'),
(5, 'Basic Monitor 19\"', 19, 69.00, 'monitor19_thumb.jpg', 'monitor19.jpg', 'Kleiner 19-Zoll-Monitor für einfache Büroarbeiten.'),
(6, 'Ultrawide Monitor 34\"', 34, 299.00, 'monitor34_thumb.jpg', 'monitor34.jpg', 'Breiter 34-Zoll-Ultrawide-Monitor für produktives Multitasking.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `os`
--

CREATE TABLE `os` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `beschreibung` text DEFAULT NULL,
  `preis` decimal(10,2) DEFAULT NULL,
  `bildpfad` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `os`
--

INSERT INTO `os` (`id`, `name`, `beschreibung`, `preis`, `bildpfad`) VALUES
(1, 'Windows Home', 'Für den privaten Gebrauch geeignet.', 79.99, 'mswinhome_thumb.png'),
(2, 'Windows Pro', 'Für professionelle Nutzung mit erweiterten Funktionen.', 119.00, 'mswinpro_thumb.png'),
(3, 'Ubuntu', 'Kostenloses und sicheres Open-Source-Betriebssystem.', 0.00, 'ubuntu.webp');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `software`
--

CREATE TABLE `software` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `beschreibung` text DEFAULT NULL,
  `preis` decimal(10,2) DEFAULT NULL,
  `bildpfad` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `software`
--

INSERT INTO `software` (`id`, `name`, `beschreibung`, `preis`, `bildpfad`) VALUES
(2, 'Photoshop', 'Professionelle Bildbearbeitung mit vielen Funktionen.', 149.00, 'photoshop.webp'),
(3, 'Office 365', 'Cloudbasierte Office-Suite für produktives Arbeiten.', 99.00, 'msoffic365_thumb.png'),
(4, 'MeinBüro', 'Softwarelösung für Rechnungen, Kunden- und Warenverwaltung.', 89.00, 'meinbuero_thumb.png'),
(5, 'McAfee', 'Antivirus- und Sicherheitspaket für Windows-Systeme.', 39.00, 'mcafee_thumb.png');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `nachname` varchar(20) NOT NULL,
  `vorname` varchar(20) NOT NULL,
  `eintrittsjahr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `team`
--

INSERT INTO `team` (`id`, `nachname`, `vorname`, `eintrittsjahr`) VALUES
(2, 'Meier', 'Martin', 2019),
(1, 'Müller', 'Max', 2003),
(4, 'Peters', 'Paul', 2018),
(5, 'Schmid', 'Sandra', 2015),
(3, 'Unger', 'Ulrike', 2010);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zubehoer`
--

CREATE TABLE `zubehoer` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `beschreibung` text DEFAULT NULL,
  `preis` decimal(5,2) DEFAULT NULL,
  `bildpfad` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `zubehoer`
--

INSERT INTO `zubehoer` (`id`, `name`, `beschreibung`, `preis`, `bildpfad`) VALUES
(1, 'Drucker', 'Hochauflösender Tintenstrahldrucker', 89.99, 'drucker.jpg'),
(2, 'Maus', 'Kabellose ergonomische Maus', 19.99, 'maus.jpg'),
(3, 'Tastatur', 'Mechanische Tastatur mit RGB', 49.99, 'tastatur.avif'),
(4, 'Mauspad', 'Großes Gaming-Mauspad', 9.99, 'mauspad.jpg'),
(5, 'Kopfhörer', 'Noise-Cancelling Over-Ear-Kopfhörer', 79.99, 'kopfhoerer.jpg'),
(6, 'Mikrofon', 'USB-Kondensator-Mikrofon mit Stativ', 59.99, 'mikrofon.webp'),
(7, 'Lautsprecher', 'Stereo-Lautsprechersystem mit Subwoofer', 39.99, 'lautsprecher.avif'),
(8, 'Webcam', 'HD-USB-Webcam mit Autofokus', 29.99, 'webcam.jpg');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `ausstattung`
--
ALTER TABLE `ausstattung`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indizes für die Tabelle `bestellung`
--
ALTER TABLE `bestellung`
  ADD PRIMARY KEY (`id`),
  ADD KEY `benutzer_id` (`benutzer_id`);

--
-- Indizes für die Tabelle `cpus`
--
ALTER TABLE `cpus`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `monitore`
--
ALTER TABLE `monitore`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `os`
--
ALTER TABLE `os`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `software`
--
ALTER TABLE `software`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nachname` (`nachname`,`vorname`,`eintrittsjahr`);

--
-- Indizes für die Tabelle `zubehoer`
--
ALTER TABLE `zubehoer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `ausstattung`
--
ALTER TABLE `ausstattung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT für Tabelle `bestellung`
--
ALTER TABLE `bestellung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT für Tabelle `cpus`
--
ALTER TABLE `cpus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `monitore`
--
ALTER TABLE `monitore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `os`
--
ALTER TABLE `os`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `software`
--
ALTER TABLE `software`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `zubehoer`
--
ALTER TABLE `zubehoer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `bestellung`
--
ALTER TABLE `bestellung`
  ADD CONSTRAINT `bestellung_ibfk_1` FOREIGN KEY (`benutzer_id`) REFERENCES `benutzer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
