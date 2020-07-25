-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 25. Jul 2020 um 15:12
-- Server-Version: 10.4.13-MariaDB
-- PHP-Version: 7.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Datenbank: `cr11_edinamuray_petadoption`
--
CREATE DATABASE IF NOT EXISTS `cr11_edinamuray_petadoption` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cr11_edinamuray_petadoption`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `animal`
--

CREATE TABLE `animal` (
  `ani_id` int(55) NOT NULL,
  `img` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `hobby` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `age` int(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `animal`
--

INSERT INTO `animal` (`ani_id`, `img`, `name`, `description`, `breed`, `hobby`, `city`, `address`, `type`, `age`) VALUES
(1, 'https://photosharingsites.files.wordpress.com/2014/10/cat-after-shower.jpg', 'Spirit', 'lorem ipsum bla blabla lorem ipsum', 'dog', 'lorem ipsum435256', '1150 Wien', 'Mainstreet 13', 'big', 2),
(2, 'https://www.spiritanimal.info/wp-content/uploads/Cat-Spirit-Animal-2.jpg', 'Bobby', 'lorem ipsum bla blabla lorem ipsum', 'cat', 'lorem ipsum5432567', '1150 Wien', 'Mainstreet 12', 'big', 2),
(3, 'https://wallsdesk.com/wp-content/uploads/2017/01/Dog-Wallpapers-HD.jpg', 'Dreamer', 'lorem ipsum bla blabla lorem ipsum', 'horse', 'lorem ipsum5934267', '1150 Wien', 'Mainstreet 11', 'big', 2),
(4, 'https://wallsdesk.com/wp-content/uploads/2017/01/Dog-High-Definition-Wallpapers-.jpg', 'Tom', 'lorem ipsum bla blabla lorem ipsum', 'cat', 'lorem ipsum3234267', '1150 Wien', 'Mainstreet 10', 'big', 9),
(5, 'https://wallsdesk.com/wp-content/uploads/2017/01/Dog-Widescreen-.jpg', 'Lisa', 'lorem ipsum bla blabla lorem ipsum', 'dog', 'lorem ipsum3276267', '2230 New York', 'Mainstreet 14', 'small', 9),
(6, 'https://i2.wp.com/ihearthorses.com/wp-content/uploads/2020/04/Canva-Portrait-of-a-beautiful-arabian-horse.-768x512.jpg', 'Little boy', 'lorem ipsum bla blabla lorem ipsum', 'horse', 'lorem ipsum3276437', '2230 New York', 'Mainstreet 13', 'small', 2),
(7, 'https://upload.wikimedia.org/wikipedia/commons/c/ce/Chestnut_horse_head%2C_all_excited.jpg', 'Elias', 'lorem ipsum bla blabla lorem ipsum', 'cat', 'lorem ipsum3546437', '2230 New York', 'Mainstreet 12', 'small', 2),
(8, 'https://upload.wikimedia.org/wikipedia/commons/3/38/Greyhound_Racing_2_amk.jpg', 'Jenny', 'lorem ipsum bla blabla lorem ipsum', 'dog', 'lorem ipsum3541637', '2230 New York', 'Mainstreet 11', 'small', 2),
(9, 'https://upload.wikimedia.org/wikipedia/commons/f/fd/Black-Tailed_Prairie_Dog.jpg', 'Black', 'lorem ipsum bla blabla lorem ipsum', 'dog', 'lorem ipsum3431637', '2230 New York', 'Mainstreet 10', 'big', 9),
(10, 'https://upload.wikimedia.org/wikipedia/commons/2/29/Cat_Sphynx._Kittens._img_11.jpg', 'Eva', 'lorem ipsum bla blabla lorem ipsum', 'horse', 'lorem ipsum347347', '5543 Little Hollow', 'Mainstreet 13', 'big', 9),
(11, 'https://upload.wikimedia.org/wikipedia/commons/6/69/June_odd-eyed-cat_cropped.jpg', 'Lenny', 'lorem ipsum bla blabla lorem ipsum', 'cat', 'lorem ipsum4567654', '5543 Little Hollow', 'Mainstreet 12', 'big', 9),
(12, 'https://upload.wikimedia.org/wikipedia/commons/c/ce/Dhole%28Asiatic_wild_dog%29.jpg', 'Denver', 'lorem ipsum bla blabla lorem ipsum', 'dog', 'lorem ipsum347347', '5543 Little Hollow', 'Mainstreet 11', 'big', 9);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `userId` int(55) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  `status` enum('user','admin','superadmin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPass`, `status`) VALUES
(1, 'Test Persson', 'gregr@gmail.com', 'b89f393ec9cb8be763d21a51c214bdd79bf5b7ef41d673697c8e1406168aebfc', 'user'),
(2, 'Edina', 'edina@gmail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'user'),
(3, 'adminEdina', 'adminEdina@adminEdina.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'admin'),
(4, 'superAdmin', 'superAdmin@superAdmin.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'superadmin');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`ani_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `animal`
--
ALTER TABLE `animal`
  MODIFY `ani_id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;
