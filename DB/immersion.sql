-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Гру 12 2021 р., 04:11
-- Версія сервера: 8.0.15
-- Версія PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `immersion`
--

-- --------------------------------------------------------

--
-- Структура таблиці `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(0, 'Онлайн'),
(1, 'Отошел'),
(2, 'Не беспокоить');

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `work` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `phone` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `vk` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `telegram` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `instagram` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `role` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `user_name`, `email`, `password`, `image`, `status`, `work`, `phone`, `address`, `vk`, `telegram`, `instagram`, `role`) VALUES
(43, 'Dmitry', 'dmitrygrinevich03@gmail.com', '$2y$10$cIwtiKoeETDaCX49U643ae4/toMGZIDKLqUeMyX/NoJvgI7oIGJia', '1com.png', 0, '123', 123, '123', '', '', '', 'admin'),
(44, '', 'ewfwef@gmail.com', '$2y$10$x9lQGDo2b5SIMubEHMyEuOLckIwtRTVHCMa0zbQZxo1EPRHxhi4Qe', NULL, 0, '', NULL, '', '', '', '', 'user'),
(45, '', '123@gmail.com', '$2y$10$2TuvVPP3VzRe7ROITlao5O4KVuQLKeVkchnu5c/DindpxFH7VYRMy', NULL, 0, '', NULL, '', '', '', '', 'user');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
