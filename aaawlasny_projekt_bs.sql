-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 26 Mar 2024, 14:48
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `aaawlasny_projekt_bs`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uprawnienia`
--

CREATE TABLE `uprawnienia` (
  `ID_upr` int(11) NOT NULL,
  `nazwa_upr` text COLLATE utf32_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_polish_ci;

--
-- Zrzut danych tabeli `uprawnienia`
--

INSERT INTO `uprawnienia` (`ID_upr`, `nazwa_upr`) VALUES
(1, 'admin'),
(2, 'pracownik'),
(3, 'user'),
(4, 'viewer');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `ID` int(11) NOT NULL,
  `login` text COLLATE utf32_polish_ci NOT NULL,
  `pass` text COLLATE utf32_polish_ci NOT NULL,
  `upr` text COLLATE utf32_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`ID`, `login`, `pass`, `upr`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'pracownik', '21232f297a57a5a743894a0e4a801fc3', 'pracownik'),
(3, 'bartek', '21232f297a57a5a743894a0e4a801fc3', 'user'),
(4, 'michał', '21232f297a57a5a743894a0e4a801fc3', 'viewer'),
(19, 'user', '21232f297a57a5a743894a0e4a801fc3', 'user'),
(20, 'user1', '21232f297a57a5a743894a0e4a801fc3', 'user');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wydarzenia`
--

CREATE TABLE `wydarzenia` (
  `ID` int(11) NOT NULL,
  `nazwa_wyd` text COLLATE utf32_polish_ci NOT NULL,
  `opis_wyd` text COLLATE utf32_polish_ci NOT NULL,
  `data_wyd` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_polish_ci;

--
-- Zrzut danych tabeli `wydarzenia`
--

INSERT INTO `wydarzenia` (`ID`, `nazwa_wyd`, `opis_wyd`, `data_wyd`) VALUES
(1, 'Koncert na auli', 'Klasa 3TEST zaśpiewa hymn szkoły 20 razy z rzędu', '2024-04-27'),
(2, 'Zlot Samochodów', 'Na parkingu szkoły odbędzie się zlot supersamochodów takich jak Ferrari, Lamborghini i inne.', '2024-04-20'),
(3, 'Walentynki szkolne', 'Nie trzeba opisywać tego wydarzenia, nazwa mówi sama za siebie', '2024-02-14'),
(4, 'Podpisywanie współpracy z Uniwersytetem Warszawskim', 'Przewodniczący Uniwersytetu Siedleckiego podpisze współpracę z naszą szkołą ZS1 w Mińsku Mazowieckim', '2024-04-17');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zainteresowania`
--

CREATE TABLE `zainteresowania` (
  `ID` int(11) NOT NULL,
  `uzytkownik` text COLLATE utf32_polish_ci NOT NULL,
  `nazwa_wydarzenia` text COLLATE utf32_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_polish_ci;

--
-- Zrzut danych tabeli `zainteresowania`
--

INSERT INTO `zainteresowania` (`ID`, `uzytkownik`, `nazwa_wydarzenia`) VALUES
(3, 'michał', 'Zlot Samochodów'),
(4, 'michał', 'Koncert na auli'),
(5, 'user', 'Zlot Samochodów'),
(6, 'user', 'Koncert na auli'),
(7, 'user1', 'Zlot Samochodów'),
(10, 'bartek', 'Koncert na auli');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `uprawnienia`
--
ALTER TABLE `uprawnienia`
  ADD PRIMARY KEY (`ID_upr`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `wydarzenia`
--
ALTER TABLE `wydarzenia`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `zainteresowania`
--
ALTER TABLE `zainteresowania`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `uprawnienia`
--
ALTER TABLE `uprawnienia`
  MODIFY `ID_upr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT dla tabeli `wydarzenia`
--
ALTER TABLE `wydarzenia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `zainteresowania`
--
ALTER TABLE `zainteresowania`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
