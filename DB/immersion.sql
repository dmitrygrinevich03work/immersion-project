-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Гру 09 2021 р., 22:53
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
(36, '', 'dmitrygrinevich03@gmail.com', '$2y$10$P67I7Bv9/zw2YQc2IjhP2OndY0MHkJh//87CsIGs9JGAvfQpGNQ7u', '', 0, '', NULL, '', '', '', '', 'admin'),
(38, 'Vasya', 'ewfwef@gmail.com', '$2y$10$3pZaC/C3iD3ae/srjrjr5eCnNRrUBhKonChBZjdAfbcoHlg2F4sZS', '61b25a96dfdd61com.png', 2, 'Workkkk', 988111, 'HelloAddress111', 'vk', 'tg', 'ins', 'user');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
