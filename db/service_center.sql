-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июн 03 2022 г., 14:31
-- Версия сервера: 8.0.28-0ubuntu0.20.04.3
-- Версия PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `wh48_service`
--

-- --------------------------------------------------------

--
-- Структура таблицы `catalog_parts`
--

CREATE TABLE `catalog_parts` (
  `ID_cat_part` int NOT NULL,
  `Name_part` varchar(300) NOT NULL,
  `Price_part` int DEFAULT NULL,
  `Color_part` varchar(20) DEFAULT NULL,
  `Vendor_part` varchar(20) DEFAULT NULL,
  `Condition_part` varchar(300) DEFAULT NULL,
  `Quantity_part` int DEFAULT NULL,
  `Status_delivery` varchar(30) NOT NULL,
  `ID_provider` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `catalog_parts`
--

INSERT INTO `catalog_parts` (`ID_cat_part`, `Name_part`, `Price_part`, `Color_part`, `Vendor_part`, `Condition_part`, `Quantity_part`, `Status_delivery`, `ID_provider`) VALUES
(27, 'Тачскрин iPhone X', 25000, 'Черный', 'Apple', 'Новое', 6, 'Доставлено', 1),
(28, 'Кнопка Home iPhone 7', 1790, 'Черный', 'Apple', 'Новое', 2, 'Доставлено', 2),
(29, 'Динамик iPhone 7 Plus', 650, 'Черный', 'Apple', 'Новое', 49, 'Доставлено', 1),
(30, 'Экран', 12500, 'Черный', 'Apple', 'Новое', 0, 'Доставлено', 3),
(31, 'Экран', 15000, 'Черный', 'Apple', 'Новое', 3, 'Доставлено', 2),
(32, 'Тестовое наименование', 150, 'Серебристый', 'Тест', 'Новое', 3, 'Доставлено', 3),
(33, 'MacBook 16 2020', 250000, 'Серебристый', 'Apple', 'Новое', 2, 'Доставлено', 1),
(34, 'Mac Pro 2020', 10000000, 'Серебристый', 'Apple', 'Новое', 2, 'Доставлено', 1),
(35, 'АКБ', 2520, 'Черный', 'Apple', 'Новое', 7, 'Доставлено', 1),
(36, '213', 123, 'Серебристый', '123', 'Новое', 2, 'Доставлено', 1),
(37, '213123', 213123, 'Серебристый', '21312', 'Новое', 23, 'Доставлено', 1),
(38, 'Экран iPhone 11 Pro', 35000, 'Черный', 'Apple', 'Новое', 22, 'Ожидает доставки', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `ID_client` int NOT NULL,
  `Name_client` varchar(50) DEFAULT NULL,
  `phone_client` varchar(20) DEFAULT NULL,
  `referrer` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`ID_client`, `Name_client`, `phone_client`, `referrer`) VALUES
(1, 'Даниил', '89996355228', 'Реклама ВКонтакте'),
(2, 'Дмитрий', '89996355228', 'Реклама ВКонтакте'),
(3, 'Александр', '89996355228', 'Реклама ВКонтакте'),
(4, 'Тимофей', '89996355228', 'Реклама ВКонтакте'),
(5, 'Оксана', '89996355228', 'Реклама ВКонтакте'),
(6, 'Екатерина', '89996355228', 'Реклама ВКонтакте'),
(7, 'Валерий', '89996355228', 'Реклама ВКонтакте'),
(8, 'Анатолий', '8 (545) 315-62-34', 'По совету друзей'),
(10, 'Анастасия', '8 (654) 168-96-54', 'Реклама Instagram'),
(11, '213123', '8 (123) 123-12-31', 'Реклама ВКонтакте'),
(12, '123123', '', 'Реклама ВКонтакте'),
(13, '', '', 'Другое'),
(14, 'Антонина', '8 (999) 554-52-45', 'По совету родственников'),
(15, 'Антон', '8 (994) 654-65-46', 'Реклама в интернете'),
(16, 'Даниил', '8 (999) 635-52-28', 'Реклама в интернете'),
(17, 'Анатолий', '8 (654) 632-45-23', 'Реклама ВКонтакте'),
(18, 'Дмитри', '8 (564) 654-65-46', 'Реклама ВКонтакте'),
(20, 'Тест', '8 (999) 999-99-99', 'Реклама ВКонтакте'),
(22, '123', '', 'Другое'),
(24, 'qudaev', '', 'Другое'),
(25, 'Qudaev1', '8 (888) 888-88-88', 'Другое'),
(26, 'Qudaev5', '8 (888) 888-88-88', 'Реклама ВКонтакте'),
(27, 'Qudaevv', '', 'Другое'),
(28, 'Qudaev', '8 (999) 999-99-99', 'Реклама ВКонтакте'),
(29, 'qudaev', '8 (222) 222-22-22', 'По совету родственников'),
(30, '1231231231', '8 (102) 938-11-28', 'Случайно'),
(31, '1230123', '8 (018) 230-91-28', 'Реклама ВКонтакте'),
(32, 'Сергей', '8 (999) 453-15-46', 'Реклама в интернете'),
(33, 'Потемка Даниил Геннадьевич', '8 (999) 365-14-23', 'Реклама Instagram'),
(34, 'Потемка Даниил Геннадьевич', '8 (999) 942-46-52', 'По совету друзей'),
(35, 'Потемка Даниил', '8 (999) 999-99-99', 'Реклама ВКонтакте'),
(36, 'Даниил', '8 (999) 999-99-92', 'Реклама Instagram'),
(37, 'Даниил', '8 (999) 999-99-92', 'Реклама Instagram'),
(42, 'Потемка Даниил', '8 (999) 987-56-46', 'Реклама Instagram'),
(43, 'Потемка Даниил', '8 (999) 987-56-46', 'Реклама Instagram'),
(44, 'adk;asjd', '8 (213) 123-12-38', 'Другое'),
(45, 'adk;asjd', '8 (213) 123-12-38', 'Другое'),
(46, 'adk;asjd', '8 (213) 123-12-38', 'Другое'),
(47, 'adk;asjd', '8 (213) 123-12-38', 'Другое'),
(48, 'adk;asjd', '8 (213) 123-12-38', 'Другое'),
(49, 'adk;asjd', '8 (213) 123-12-38', 'Другое'),
(50, 'adk;asjd23', '8 (213) 123-12-38', 'Другое'),
(51, 'adk;asjd23', '8 (213) 123-12-38', 'Другое'),
(52, 'adk;asjd23213', '8 (213) 123-12-38', 'Другое'),
(53, 'adk;asjd23213', '8 (213) 123-12-38', 'Другое'),
(54, 'adk;asjd23213', '8 (213) 123-12-38', 'Другое'),
(55, 'adk;asjd23213', '8 (213) 123-12-38', 'Другое'),
(56, 'adk;asjd23213', '8 (213) 123-12-38', 'Другое'),
(57, 'adk;asjd23213', '8 (213) 123-12-38', 'Другое'),
(58, 'adk;asjd23213', '8 (213) 123-12-38', 'Другое'),
(59, '123123', '8 (232) 321-31-23', 'По совету родственников'),
(60, 'Потемка Даниил Геннадьевич', '8 (999) 646-51-32', 'В приложении навигации');

-- --------------------------------------------------------

--
-- Структура таблицы `client_orders`
--

CREATE TABLE `client_orders` (
  `ID_order` int NOT NULL,
  `sn_hw_order` varchar(50) DEFAULT NULL,
  `name_hw_order` varchar(300) DEFAULT NULL,
  `order_datetime` datetime DEFAULT NULL,
  `order_end_datetime` datetime DEFAULT NULL,
  `warranty_order` tinyint DEFAULT NULL,
  `exec_order_start` datetime DEFAULT NULL,
  `exec_order_end` datetime DEFAULT NULL,
  `ID_client` int DEFAULT NULL,
  `price_order` int DEFAULT NULL,
  `device_condition` varchar(300) NOT NULL,
  `out_order` datetime NOT NULL,
  `problems` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `client_orders`
--

INSERT INTO `client_orders` (`ID_order`, `sn_hw_order`, `name_hw_order`, `order_datetime`, `order_end_datetime`, `warranty_order`, `exec_order_start`, `exec_order_end`, `ID_client`, `price_order`, `device_condition`, `out_order`, `problems`) VALUES
(34, 'DSKLFDF5RE44', 'Apple iPhone XS Max', '2022-05-22 15:21:29', '2022-06-05 01:17:12', 1, '2022-06-04 20:04:54', '2022-06-05 01:17:07', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(35, 'IZR7MMBGG2J2', 'iPhone 11 A2223 128 GB', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(36, 'MVBH049834NA', 'iPhone 11 Pro A2160 256 GB', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(37, '97POKJGUERSE', 'iPhone 11 Pro A2215 256 GB', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(38, 'N64XGVJIL4L4', 'iPhone 11 Pro A2217 256 GB', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(39, 'P8JB9OR452SL', 'iPhone 11 Pro Max A2161 256 GB', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(40, 'YD44L2CKBKP1', 'iPhone 11 Pro Max A2218 256 GB', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(41, 'O9L22PJD8U82', 'iPhone 11 Pro Max A2220 256 GB', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(42, 'ZWT6WMXPGHTH', 'iPhone XR A1984 128 GB', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(43, 'N3VGRS1JULF5', 'iPhone XR A2105 128 GB', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(44, '9LTNSCEKVKFJ', 'iPhone XR A2106 128 GB', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(45, '0RWSZ3YAURR6', 'iPhone XR A2108 128 GB', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(46, '6VSO81CUXMAL', 'iPhone 11 A2111 128 GB', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(47, 'W0MFYYZGN04Y', 'iPhone 11 A2221 128 GB', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(48, 'SOJR641PU19A', 'iPhone 8 Plus A1898 128 GB', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(49, 'QMA379A71I2Y', 'iPhone 8 Plus A1899 128 GB', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(50, 'DG8EGEWSU3RB', 'iPhone X A1865 256 GB', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(51, 'RLY3S0RL1FPX', 'Apple iPhone XS Max', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(52, 'GKUQLYRH83DV', 'Apple iPhone XS Max', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(53, '62V9X1V1JDPL', 'iPhone X A1901 256 GB', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(54, 'OKOOZRR337KE', 'Apple iPhone XS Max', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(55, 'HL7TYFYMCNWW', 'Apple iPhone XS Max', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(56, 'TFRVL8WT0KQ4', 'Apple iPhone XS Max', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(57, 'T4RI39QAOKO1', 'Apple iPhone XS Max', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(58, '710KDFK8VQ3B', 'iPhone Xs A2098 256 GB', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(59, 'GWVBL1YG166O', 'iPhone Xs A2100 256 GB', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(60, 'TYY8D9P28RZJ', 'iPhone Xs Max A1921 256 GB', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(61, 'PBHLW74LZFDK', 'Apple iPhone XS Max', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(62, '15OTX4KAHAYV', 'Apple iPhone XS Max', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(63, '3WAIOPSJBU0W', 'Apple iPhone XS Max', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(64, 'PU3XTNIFA2N0', 'Apple iPhone XS Max', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(65, 'K1Q6NH6ASNSZ', 'Apple iPhone XS Max', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(66, 'NTMUW52FR650', 'Apple iPhone XS Max', '2022-05-22 15:21:29', '2022-05-13 15:21:29', 1, '2022-05-30 15:21:29', '2022-05-27 15:21:29', 2, 1750, 'Включается, отличное состояние', '0000-00-00 00:00:00', ''),
(83, 'RU/A23WQEQWE', 'MacBook Pro 15 2015', '2022-05-27 19:09:33', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 16, 1500, 'Нет царапин, нет трещин, включается,', '0000-00-00 00:00:00', ''),
(148, 'ASDAS56498D', 'Apple iPod Touch 6 160GB', '2022-06-05 01:02:54', '2022-06-05 01:17:22', 0, '2022-06-05 01:04:10', '2022-06-05 01:17:20', 60, 1500, 'Есть мелкие коцки, не включается,', '0000-00-00 00:00:00', 'Умер жесткий диск');

-- --------------------------------------------------------

--
-- Структура таблицы `consigment`
--

CREATE TABLE `consigment` (
  `ID_consigment` int NOT NULL,
  `Condition_consigment` varchar(20) DEFAULT NULL,
  `ID_provider` int DEFAULT NULL,
  `ID_cat_part` int DEFAULT NULL,
  `Date_consigment` datetime DEFAULT NULL,
  `Quantity_consigment` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `employees`
--

CREATE TABLE `employees` (
  `ID_empl` int NOT NULL,
  `Name_empl` varchar(50) DEFAULT NULL,
  `Phone_empl` varchar(20) DEFAULT NULL,
  `Hiring_date_empl` datetime DEFAULT NULL,
  `Adress_empl` varchar(20) DEFAULT NULL,
  `Dismissall_date_empl` datetime DEFAULT NULL,
  `ID_job` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `employees`
--

INSERT INTO `employees` (`ID_empl`, `Name_empl`, `Phone_empl`, `Hiring_date_empl`, `Adress_empl`, `Dismissall_date_empl`, `ID_job`) VALUES
(1, 'Даниил Потемка', '89996677700', '2022-06-01 20:55:21', 'г. Краснодар', NULL, 1),
(2, 'Серебрякова Екатерина', '89996677777', '2022-06-01 20:57:10', 'г. Краснодар', NULL, 2),
(3, 'Власенко Александр', '89094512348', '2022-06-01 20:57:10', 'г. Новороссийск', NULL, 3),
(4, 'Кудаев Аскер', '89094512348', '2022-06-02 12:35:43', 'г. Новороссийск', NULL, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `jobs`
--

CREATE TABLE `jobs` (
  `ID_job` int NOT NULL,
  `Name_job` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `jobs`
--

INSERT INTO `jobs` (`ID_job`, `Name_job`) VALUES
(1, 'Администратор'),
(2, 'Менеджер'),
(3, 'Мастер');

-- --------------------------------------------------------

--
-- Структура таблицы `order_breakages`
--

CREATE TABLE `order_breakages` (
  `ID_oder` int NOT NULL,
  `ID_breakage` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `order_empls`
--

CREATE TABLE `order_empls` (
  `ID_order` int NOT NULL,
  `ID_empl` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `order_empls`
--

INSERT INTO `order_empls` (`ID_order`, `ID_empl`) VALUES
(34, 1),
(35, 1),
(34, 2),
(148, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `order_parts`
--

CREATE TABLE `order_parts` (
  `ID_cat_part` int NOT NULL,
  `ID_oder` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `order_works`
--

CREATE TABLE `order_works` (
  `ID_oder` int NOT NULL,
  `ID_work` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `price_works`
--

CREATE TABLE `price_works` (
  `ID_work` int NOT NULL,
  `Price_work` int DEFAULT NULL,
  `Name_work` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `productlist`
--

CREATE TABLE `productlist` (
  `id_prodlist` int NOT NULL,
  `name_prod_list` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `productlist`
--

INSERT INTO `productlist` (`id_prodlist`, `name_prod_list`) VALUES
(1, 'Apple iPhone 4s'),
(2, 'Apple iPhone 5'),
(3, 'Apple iPhone 5s'),
(4, 'Apple iPhone 6'),
(5, 'Apple iPhone 6 Plus'),
(6, 'Apple iPhone 6s'),
(7, 'Apple iPhone 6s Plus'),
(8, 'Apple iPhone 7'),
(9, 'Apple iPhone 7 Plus'),
(10, 'Apple iPhone 8'),
(11, 'Apple iPhone 8 Plus'),
(12, 'Apple iPhone X'),
(13, 'Apple iPhone XS '),
(14, 'Apple iPhone XS Max'),
(15, 'Apple iPhone XR '),
(16, 'Apple iPhone 11 '),
(17, 'Apple iPhone 11 Pro '),
(18, 'Apple iPhone 11 Pro Max ');

-- --------------------------------------------------------

--
-- Структура таблицы `providers`
--

CREATE TABLE `providers` (
  `ID_provider` int NOT NULL,
  `Name_provider` varchar(20) DEFAULT NULL,
  `Adress_provider` varchar(70) DEFAULT NULL,
  `Phone_provider` varchar(20) DEFAULT NULL,
  `Name_Rprsnt` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `providers`
--

INSERT INTO `providers` (`ID_provider`, `Name_provider`, `Adress_provider`, `Phone_provider`, `Name_Rprsnt`) VALUES
(1, 'ЭПЛ РУС', 'г.Москва, ул. Садовая, д.128', '88007777777', 'Рустам'),
(2, 'МТайм', 'г.Краснодар, ул. Красная, д.19', '88002222222', 'Иван'),
(3, 'Алекса', 'г.Ростов-на-Дону, ул. Светлая, д.5', '88002225566', 'Андрей'),
(4, 'ООО ИндексАйКью', 'г.Краснодар, ул. Ставропольская, д.220', '88002225577', 'Алексей');

-- --------------------------------------------------------

--
-- Структура таблицы `typical_breakage`
--

CREATE TABLE `typical_breakage` (
  `ID_breakage` int NOT NULL,
  `name_breakage` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `ID_user` int NOT NULL,
  `login` varchar(50) NOT NULL,
  `pass` varchar(90) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `role` varchar(30) DEFAULT NULL,
  `avatar` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`ID_user`, `login`, `pass`, `name`, `role`, `avatar`) VALUES
(1, 'admin', '$2y$10$Uu4JQkxihX1cOm.OVakZ3eVIgiSV80lAPFnkUXDucs8', 'Даниил', 'Администратор', 'img\\avatars\\admin.jpg'),
(12, 'leth', '$2y$10$.4rrLwLobln99ExDnmLE7u5LALdkdAT0EIQ.JgotWE0x1KBVBVmC6', 'gor', 'Администратор', NULL),
(13, 'gordaniel', '$2y$10$LnYZXCUpip/moQHHziUoDOmYpQnq0WUy0toRdyiL/Otbd8WtRgrye', 'Гор', 'Менеджер', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `catalog_parts`
--
ALTER TABLE `catalog_parts`
  ADD PRIMARY KEY (`ID_cat_part`),
  ADD KEY `Provider_part` (`ID_provider`);

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`ID_client`);

--
-- Индексы таблицы `client_orders`
--
ALTER TABLE `client_orders`
  ADD PRIMARY KEY (`ID_order`),
  ADD KEY `R_69` (`ID_client`);

--
-- Индексы таблицы `consigment`
--
ALTER TABLE `consigment`
  ADD PRIMARY KEY (`ID_consigment`),
  ADD KEY `R_60` (`ID_provider`),
  ADD KEY `R_62` (`ID_cat_part`);

--
-- Индексы таблицы `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`ID_empl`),
  ADD KEY `R_46` (`ID_job`);

--
-- Индексы таблицы `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`ID_job`);

--
-- Индексы таблицы `order_breakages`
--
ALTER TABLE `order_breakages`
  ADD PRIMARY KEY (`ID_oder`,`ID_breakage`),
  ADD KEY `R_63` (`ID_breakage`);

--
-- Индексы таблицы `order_empls`
--
ALTER TABLE `order_empls`
  ADD PRIMARY KEY (`ID_order`,`ID_empl`),
  ADD KEY `R_67` (`ID_empl`);

--
-- Индексы таблицы `order_parts`
--
ALTER TABLE `order_parts`
  ADD PRIMARY KEY (`ID_cat_part`,`ID_oder`),
  ADD KEY `R_66` (`ID_oder`);

--
-- Индексы таблицы `order_works`
--
ALTER TABLE `order_works`
  ADD PRIMARY KEY (`ID_oder`,`ID_work`),
  ADD KEY `R_68` (`ID_work`);

--
-- Индексы таблицы `price_works`
--
ALTER TABLE `price_works`
  ADD PRIMARY KEY (`ID_work`);

--
-- Индексы таблицы `productlist`
--
ALTER TABLE `productlist`
  ADD PRIMARY KEY (`id_prodlist`);

--
-- Индексы таблицы `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`ID_provider`);

--
-- Индексы таблицы `typical_breakage`
--
ALTER TABLE `typical_breakage`
  ADD PRIMARY KEY (`ID_breakage`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `catalog_parts`
--
ALTER TABLE `catalog_parts`
  MODIFY `ID_cat_part` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `ID_client` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT для таблицы `client_orders`
--
ALTER TABLE `client_orders`
  MODIFY `ID_order` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT для таблицы `consigment`
--
ALTER TABLE `consigment`
  MODIFY `ID_consigment` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `employees`
--
ALTER TABLE `employees`
  MODIFY `ID_empl` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `jobs`
--
ALTER TABLE `jobs`
  MODIFY `ID_job` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `price_works`
--
ALTER TABLE `price_works`
  MODIFY `ID_work` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `productlist`
--
ALTER TABLE `productlist`
  MODIFY `id_prodlist` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `providers`
--
ALTER TABLE `providers`
  MODIFY `ID_provider` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `typical_breakage`
--
ALTER TABLE `typical_breakage`
  MODIFY `ID_breakage` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `ID_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `catalog_parts`
--
ALTER TABLE `catalog_parts`
  ADD CONSTRAINT `catalog_parts_ibfk_1` FOREIGN KEY (`ID_provider`) REFERENCES `providers` (`ID_provider`);

--
-- Ограничения внешнего ключа таблицы `client_orders`
--
ALTER TABLE `client_orders`
  ADD CONSTRAINT `R_69` FOREIGN KEY (`ID_client`) REFERENCES `clients` (`ID_client`);

--
-- Ограничения внешнего ключа таблицы `consigment`
--
ALTER TABLE `consigment`
  ADD CONSTRAINT `R_60` FOREIGN KEY (`ID_provider`) REFERENCES `providers` (`ID_provider`),
  ADD CONSTRAINT `R_62` FOREIGN KEY (`ID_cat_part`) REFERENCES `catalog_parts` (`ID_cat_part`);

--
-- Ограничения внешнего ключа таблицы `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `R_46` FOREIGN KEY (`ID_job`) REFERENCES `jobs` (`ID_job`);

--
-- Ограничения внешнего ключа таблицы `order_breakages`
--
ALTER TABLE `order_breakages`
  ADD CONSTRAINT `R_57` FOREIGN KEY (`ID_oder`) REFERENCES `client_orders` (`ID_order`),
  ADD CONSTRAINT `R_63` FOREIGN KEY (`ID_breakage`) REFERENCES `typical_breakage` (`ID_breakage`);

--
-- Ограничения внешнего ключа таблицы `order_empls`
--
ALTER TABLE `order_empls`
  ADD CONSTRAINT `R_33` FOREIGN KEY (`ID_order`) REFERENCES `client_orders` (`ID_order`),
  ADD CONSTRAINT `R_67` FOREIGN KEY (`ID_empl`) REFERENCES `employees` (`ID_empl`);

--
-- Ограничения внешнего ключа таблицы `order_parts`
--
ALTER TABLE `order_parts`
  ADD CONSTRAINT `R_65` FOREIGN KEY (`ID_cat_part`) REFERENCES `catalog_parts` (`ID_cat_part`),
  ADD CONSTRAINT `R_66` FOREIGN KEY (`ID_oder`) REFERENCES `client_orders` (`ID_order`);

--
-- Ограничения внешнего ключа таблицы `order_works`
--
ALTER TABLE `order_works`
  ADD CONSTRAINT `R_44` FOREIGN KEY (`ID_oder`) REFERENCES `client_orders` (`ID_order`),
  ADD CONSTRAINT `R_68` FOREIGN KEY (`ID_work`) REFERENCES `price_works` (`ID_work`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
