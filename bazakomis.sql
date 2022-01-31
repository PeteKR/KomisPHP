
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `bazakomis` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bazakomis`;

-- --------------------------------------------------------


CREATE TABLE `auctions` (
  `id` int(6) NOT NULL,
  `username` varchar(255) NOT NULL,
  `make` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `year` int(4) NOT NULL,
  `mileage` int(7) NOT NULL,
  `fuel` varchar(40) NOT NULL,
  `transmission` varchar(40) NOT NULL,
  `power` int(4) NOT NULL,
  `liters` decimal(2,1) NOT NULL,
  `price` int(8) NOT NULL,
  `extra` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `end_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

CREATE TABLE `stock` (
  `id` int(6) NOT NULL,
  `make` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `year` int(4) NOT NULL,
  `mileage` int(7) NOT NULL,
  `fuel` varchar(40) NOT NULL,
  `transmission` varchar(40) NOT NULL,
  `power` int(4) NOT NULL,
  `liters` decimal(2,1) NOT NULL,
  `price` int(8) NOT NULL,
  `extra` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Indeksy
--
ALTER TABLE `auctions`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT 
--
ALTER TABLE `auctions`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

ALTER TABLE `stock`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;
  
  
 --INSERT KONTO PRACOWNIKA
INSERT INTO `users`(`username`, `password`, `email`, `role`) VALUES ("admin","admin","","Pracownik") ;

COMMIT;

