-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Ned 08. bře 2026, 23:35
-- Verze serveru: 10.4.32-MariaDB
-- Verze PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `ebooks`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `ebooks`
--

CREATE TABLE `ebooks` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `author` text NOT NULL,
  `genre` text DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `ebooks`
--

INSERT INTO `ebooks` (`id`, `title`, `author`, `genre`, `year`, `price`, `rating`, `description`) VALUES
(1, '1984', 'George Orwell', 'Dystopian', 1949, 8.99, 10, 'Totalitní společnost, dohled a kontrola.'),
(2, 'Pýcha a předsudek', 'Jane Austen', 'Romance', 1813, 6.5, 9, 'Klasický román o lásce a společenských třídách.'),
(3, 'Hobit', 'J.R.R. Tolkien', 'Fantasy', 1937, 10, 9, 'Dobrodružství Bilba Pytlíka ve Středozemi.'),
(4, 'Malý princ', 'Antoine de Saint-Exupéry', 'Fable', 1943, 5.5, 10, 'Filozofická pohádka pro děti i dospělé.'),
(5, 'Sto roků samoty', 'Gabriel García Márquez', 'Magical Realism', 1967, 12, 9, 'Rodinná sága s prvky magie a reality.'),
(6, 'Mistr a Markétka', 'Michail Bulgakov', 'Fiction', 1967, 9.99, 10, 'Satira na sovětskou společnost s nadpřirozenými prvky.'),
(7, 'Hra o trůny', 'George R.R. Martin', 'Fantasy', 1996, 11.5, 8, 'První díl epické fantasy série Píseň ledu a ohně.'),
(8, 'Jane Eyre', 'Charlotte Brontë', 'Gothic', 1847, 7.5, 9, 'Romantický a gotický příběh o síle ženy.'),
(9, 'Velký Gatsby', 'F. Scott Fitzgerald', 'Classic', 1925, 6.99, 9, 'Tragický příběh amerického snu a lásky.'),
(10, 'Harry Potter a Kámen mudrců', 'J.K. Rowling', 'Fantasy', 1997, 10.99, 10, 'První díl slavné kouzelnické série.'),
(11, 'Lovec draků', 'Robin Hobb', 'Fantasy', 1995, 9.5, 8, 'Příběh mladého hrdiny a jeho dračího osudu.'),
(12, 'Anna Karenina', 'Lev Tolstoj', 'Romance', 1878, 8.5, 9, 'Tragický román o lásce, vášni a společnosti.'),
(13, 'Alchymista', 'Paulo Coelho', 'Fiction', 1988, 7.99, 8, 'Příběh o hledání vlastního osudu a snů.'),
(14, 'Duna', 'Frank Herbert', 'Science Fiction', 1965, 12.5, 10, 'Politická, ekologická a epická sci-fi sága.'),
(15, 'Zlodějka knih', 'Markus Zusak', 'Historical Fiction', 2005, 9.99, 9, 'Příběh dívky v nacistickém Německu, která miluje knihy.'),
(16, '1984', 'George Orwell', 'Dystopian', 1949, 8.99, 10, 'Totalitní společnost.'),
(17, 'Hobit', 'J.R.R. Tolkien', 'Fantasy', 1937, 10, 9, 'Dobrodružství Bilba Pytlíka.');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `ebooks`
--
ALTER TABLE `ebooks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `ebooks`
--
ALTER TABLE `ebooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
