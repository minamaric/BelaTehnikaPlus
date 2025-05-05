-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2024 at 05:18 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `belatehnikaplus`
--

-- --------------------------------------------------------

--
-- Table structure for table `ikonice`
--

CREATE TABLE `ikonice` (
  `id` int(11) NOT NULL,
  `naziv` varchar(20) NOT NULL,
  `tag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ikonice`
--

INSERT INTO `ikonice` (`id`, `naziv`, `tag`) VALUES
(1, 'Priuštivo', '<i class=\"fa-solid fa-wallet\"></i>'),
(2, 'Pouzdano', '<i class=\"fa-solid fa-thumbs-up\"></i>'),
(3, 'Praktično', '<i class=\"fa-solid fa-globe\"></i>');

-- --------------------------------------------------------

--
-- Table structure for table `kontakt`
--

CREATE TABLE `kontakt` (
  `id` int(11) NOT NULL,
  `imeKorisnika` varchar(30) NOT NULL,
  `emailKorisnika` varchar(50) NOT NULL,
  `poruka` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kontakt`
--

INSERT INTO `kontakt` (`id`, `imeKorisnika`, `emailKorisnika`, `poruka`) VALUES
(1, 'Mina Maric', 'maricmina2506@gmail.com', 'porukica');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(11) NOT NULL,
  `ime` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sifra` varchar(40) NOT NULL,
  `adresa` varchar(40) NOT NULL,
  `vrsta_isporuke` varchar(20) DEFAULT 'Nepoznato',
  `pol` varchar(10) DEFAULT 'Nepoznato',
  `uloga` int(11) NOT NULL,
  `aktiviran` tinyint(1) DEFAULT 0,
  `broj_neuspelih_pokusaja` int(11) DEFAULT 0,
  `poslednji_neuspeo_pokusaj` timestamp NULL DEFAULT NULL,
  `zakljucan` tinyint(1) DEFAULT 0,
  `aktivacija_kod` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `ime`, `email`, `sifra`, `adresa`, `vrsta_isporuke`, `pol`, `uloga`, `aktiviran`, `broj_neuspelih_pokusaja`, `poslednji_neuspeo_pokusaj`, `zakljucan`, `aktivacija_kod`) VALUES
(72, 'Mina Test', 'minatest2@gmail.com', '', '', 'Nepoznato', 'Nepoznato', 1, 0, 0, NULL, 0, ''),
(74, 'Mina', 'urosd@ict.edu.rslo', '$2y$10$Joejc.WdzX6IEyFmT.bWz.ZCnuDmKpuKd', 'Mina', '2', 'zenski', 1, 0, 0, NULL, 0, ''),
(76, 'Mina Maric', 'dsfaf@gmail.com', '$2y$10$KFge9wUN/swOqiw1hGKdsOHy38VwCefb0', 'Ict', '1', 'zenski', 1, 0, 0, NULL, 0, ''),
(77, 'Mina Maric', 'mina.maric@gmail.com', '$2y$10$nEDpAzZ6A70q3dfSRLIL8O.WyM46i.QED', 'Beograd', '1', 'zenski', 1, 0, 0, NULL, 0, ''),
(78, 'Mina Maric', 'test@gmail.com', '$2y$10$gd/AY38cQ2Iy/BTyNkbUXucQX2U4GSGd6', 'Beograd', '1', 'zenski', 1, 0, 0, NULL, 0, ''),
(79, 'Mina Maric', 'maricmina@gmail.com', '$2y$10$F0Bs7hJlCvncHKUfqLJNMewvqLEPFj.VT', 'Beograd', '1', 'zenski', 1, 0, 0, NULL, 0, ''),
(80, 'Most Naa Adi', 'mostnaadijeumagli@gmail.com', '$2y$10$NS/HRqEG3IilpayVZQK3neCu7BUiHzaaB', 'Dzehvy', '2', 'zenski', 1, 0, 0, NULL, 0, ''),
(81, 'Mina Maric', 'mina@gmail.com', '$2y$10$CmJN56PxspC5S3x.JlWPRuJyr/w933xma', 'Beograd', '1', 'zenski', 1, 0, 0, NULL, 0, ''),
(82, 'Mina Maric', 'antunovicnadezda@gmail.com', '$2y$10$BNayTEY7MvwRVLyNKvJYIeGTP6Y.UZGgF', 'Beograd', '1', 'zenski', 1, 0, 0, NULL, 0, ''),
(83, 'Mina Maric', 'test123@gmail.com', '$2y$10$vie5psN3EljemTMOwLm1TO0WltFQWM.NE', 'Beograd', '1', 'zenski', 1, 0, 0, NULL, 0, ''),
(84, 'Mina Maric', 'maricmina1@gmail.com', '$2y$10$epR5aidVO2fu5orloWBdo.s6zMpVngJRF', 'Beograd', '1', 'zenski', 1, 0, 0, NULL, 0, ''),
(85, 'Mina Maric', 'maricmina2ds506@gmail.com', '$2y$10$OMJ8UciVEBFbNR1pDtoBlOXySnrkLDlqM', 'Mina', '1', 'zenski', 1, 0, 0, NULL, 0, ''),
(86, 'Mina Maric', 'minasdas@gmail.com', '$2y$10$3VsOjcmi4jwRYRZP0PgUX.HdgvxU1RAFp', 'Mina', '2', 'zenski', 1, 0, 0, NULL, 0, ''),
(88, 'Korisnik', 'emailKorisnika1@gmail.com', '', '', 'Nepoznato', 'Nepoznato', 1, 0, 0, NULL, 0, ''),
(89, 'Mina Maric', 'fsaasfa@gmail.com', '$2y$10$nA7K9TB7/HnALRNOvQJZheOqYbsPnq.V8', 'Mina', '1', 'zenski', 1, 0, 0, NULL, 0, ''),
(93, 'Email Email', 'email12@gmail.com', '$2y$10$igXtZaOf9U.8pItdgOHpWuge9NytWaCUl', 'Email', '1', 'zenski', 1, 0, 2, '2024-08-25 21:23:31', 1, ''),
(94, 'Test Kod', 'aktivacija@gmail.com', '$2y$10$uwPOIpQhDj8J4suf5JseNe8.NAtTZcoFB', 'Aktivacija12', '2', 'zenski', 1, 0, 2, '2024-08-25 21:15:08', 1, '7cf10633fcd7fdb6293a2858a0430aed'),
(101, 'Mina Maric', 'maricmina2506@gmail.com', '$2y$10$D7SkzPK8MgOmIX.wBVXB8eL2MbJbnPBxo', 'Beograd', '2', 'zenski', 2, 1, 0, NULL, 0, ''),
(105, 'Mina Maric', 'mina.maric.55.22@ict.edu.rs', '$2y$10$sUD8D.kUXpZJ9TgjKDxMh.f9wzJL94n9k', 'Beograd', '2', 'zenski', 1, 0, 2, '2024-08-26 00:10:00', 1, '418b6c3e494ce1fab0a5cceec31bcb2a'),
(106, 'Mina Maric', 'maricmina22506@gmail.com', '$2y$10$Wr6RenNzUVSTMTTzm8DieO7uWnthRIw98', 'Beograd', '1', 'zenski', 1, 0, 0, NULL, 0, 'fa1828fd3feb11af507f24d7a6b69801'),
(107, 'Mina Maric', 'urosd@ict.edu.rs', '$2y$10$RTmmnJZAOSB23O55at.OxONcsrmgaiPrW', 'Beograd', '2', 'zenski', 1, 0, 0, NULL, 0, '0ad90c7db8ba759d6b22bd22cd31f180'),
(108, 'Mina Maric', 'logovanje@gmail.com', '$2y$10$VGNsOFcwJ469GkbHqgx8EurxF0cMxil8N', 'Beograd', '2', 'zenski', 1, 0, 0, NULL, 0, '0557bbed1181bf897417c7447e515ac0'),
(109, 'Test Log', 'testlog@gmail.com', '$2y$10$5I8dxJiTRdwj9nLTgFlkN.Jt0KmhyAyRA', 'Beograd', '2', 'zenski', 1, 0, 0, NULL, 0, '8aff2e0d0ba81d6e5ecbbc9ae76d5ea6'),
(110, 'Mina Maric', 'uro1sd@ict.edu.rs', '$2y$10$y1w/y2lV70F7iQCpAih.susNnnjpmYKWN', 'Beograd', '2', 'zenski', 1, 0, 0, NULL, 0, '93d3e6480cc3f66148149707bb827cb0'),
(111, 'Paginacija Pag', 'paginacija@gmail.com', '$2y$10$JsWkrpEUYjonXGSlD86orOWjaMX205l.4', 'Beograd', '1', 'zenski', 1, 0, 0, NULL, 0, 'e054bce7855ffea9d9de81cfdce8c345'),
(112, 'Jos Jedna', 'paginacija1@gmail.com', '$2y$10$0mkT8RhmdVzWm34.iejZ1OeU.WWBog6bX', 'Beograd', '2', 'zenski', 1, 0, 0, NULL, 0, '8d6f45d6ca78358e4e9c675f1a4a06af');

-- --------------------------------------------------------

--
-- Table structure for table `logovi`
--

CREATE TABLE `logovi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `aktivnost` varchar(255) DEFAULT NULL,
  `vreme` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logovi`
--

INSERT INTO `logovi` (`id`, `user_id`, `email`, `aktivnost`, `vreme`) VALUES
(3, 78, 'test@gmail.com', 'Prijava', '2024-08-26 17:00:45'),
(4, 101, 'maricmina2506@gmail.com', 'Prijava', '2024-08-26 17:01:17'),
(17, 101, 'maricmina2506@gmail.com', 'Prijava', '2024-08-26 17:20:19'),
(18, 101, 'maricmina2506@gmail.com', 'Prijava', '2024-08-26 18:10:39'),
(19, 107, 'logovanje@gmail.com', 'Registracija', '2024-08-26 21:59:59'),
(20, 101, 'maricmina2506@gmail.com', 'Prijava', '2024-08-26 22:00:15'),
(22, 110, 'uro1sd@ict.edu.rs', 'Registracija', '2024-08-26 22:06:43'),
(23, 101, 'maricmina2506@gmail.com', 'Prijava', '2024-08-26 22:07:07'),
(24, 101, 'maricmina2506@gmail.com', 'Prijava', '2024-08-27 00:18:04'),
(25, 111, 'paginacija@gmail.com', 'Registracija', '2024-08-27 01:41:27'),
(26, 112, 'paginacija1@gmail.com', 'Registracija', '2024-08-27 01:41:51'),
(27, 101, 'maricmina2506@gmail.com', 'Prijava', '2024-08-27 01:42:06'),
(28, 101, 'maricmina2506@gmail.com', 'Prijava', '2024-08-27 03:18:08');

-- --------------------------------------------------------

--
-- Table structure for table `meni`
--

CREATE TABLE `meni` (
  `id` int(11) NOT NULL,
  `naziv` varchar(20) NOT NULL,
  `putanja` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meni`
--

INSERT INTO `meni` (`id`, `naziv`, `putanja`) VALUES
(1, 'Početna', 'http://localhost/PHP2Sajt/index.php'),
(2, 'Prodavnica', 'http://localhost/PHP2Sajt/views/prodavnica.php'),
(3, 'Prijavite se', 'http://localhost/PHP2Sajt/views/prijavi_se.php'),
(5, 'Autor', 'http://localhost/PHP2Sajt/views/autor.php'),
(6, 'Kontakt', 'http://localhost/PHP2Sajt/views/kontakt.php');

-- --------------------------------------------------------

--
-- Table structure for table `narudzbine`
--

CREATE TABLE `narudzbine` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ukupan_iznos` decimal(10,2) NOT NULL,
  `adresa` varchar(255) NOT NULL,
  `vrsta_isporuke` varchar(50) NOT NULL,
  `datum` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `narudzbine`
--

INSERT INTO `narudzbine` (`id`, `user_id`, `ukupan_iznos`, `adresa`, `vrsta_isporuke`, `datum`) VALUES
(1, 93, 65.44, 'Beograd', 'standardna', '2024-08-25 02:24:49'),
(2, 101, 66.27, 'Beograd', 'brza', '2024-08-26 10:04:16');

-- --------------------------------------------------------

--
-- Table structure for table `narudzbine_proizvodi`
--

CREATE TABLE `narudzbine_proizvodi` (
  `id` int(11) NOT NULL,
  `narudzbina_id` int(11) NOT NULL,
  `proizvod_id` int(11) NOT NULL,
  `kolicina` int(11) NOT NULL,
  `cena` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `narudzbine_proizvodi`
--

INSERT INTO `narudzbine_proizvodi` (`id`, `narudzbina_id`, `proizvod_id`, `kolicina`, `cena`) VALUES
(1, 1, 2, 1, 38.68),
(2, 1, 3, 1, 38.68),
(3, 2, 3, 1, 27.59),
(4, 2, 4, 1, 27.59);

-- --------------------------------------------------------

--
-- Table structure for table `prijavanovosti`
--

CREATE TABLE `prijavanovosti` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prijavanovosti`
--

INSERT INTO `prijavanovosti` (`id`, `email`) VALUES
(1, 'maricmina2506@gmail.com'),
(7, 'maricmina@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi`
--

CREATE TABLE `proizvodi` (
  `id` int(11) NOT NULL,
  `slika` varchar(255) DEFAULT NULL,
  `cena` decimal(10,3) DEFAULT NULL,
  `opis` text DEFAULT NULL,
  `naziv` varchar(100) DEFAULT NULL,
  `vrsta_proizvoda_id` int(11) DEFAULT NULL,
  `snizenje_id` int(11) DEFAULT NULL,
  `snizena_cena` decimal(10,3) NOT NULL,
  `da_li_je_snizeno` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`id`, `slika`, `cena`, `opis`, `naziv`, `vrsta_proizvoda_id`, `snizenje_id`, `snizena_cena`, `da_li_je_snizeno`) VALUES
(1, '../assets/img/klima1.png', 40.990, 'Zahvaljujući naprednim funkcionalnostima kao što su Jet Cool i Jet Heat, možeš brzo da prilagodiš temperaturu prema svojim potrebama.\r\n', 'Beko Standardna klima, 9K BTU, BBFDB 090/BBFDB 091, Bela', 1, NULL, 0.000, 0),
(2, '../assets/img/klima2.png', 26.759, 'Specifikacije:\r\n• Kapacitet hladjenja: 12000 BTU\r\n• Kapacitet grejanja: 12000 BTU\r\n• Energetski razred: A', 'VOX Standardna klima,12K BTU, SFX12-IO', 1, NULL, 0.000, 0),
(3, '../assets/img/klima3.png', 38.679, 'Specifikacije:\r\n• Tip klima uređaja: On/Off serija\r\n• Inovativni dizajn: Fokusiranje na inovacije uzimajući u obzir ekonomske uslove', 'Venting Standardna klima, 9K BTU, Plus, Bela', 1, NULL, 0.000, 0),
(4, '../assets/img/klima4.png', 27.587, 'Uživaj u dodatnim pogodnostima kao što su noćni režim rada, samočišćenje, WiFi kontrola uz adapter, filteri obogaćeni srebrnim jonima i vitaminom C za poboljšan kvalitet vazduha.\r\n', 'VOX Standardna klima,12K BTU, SFG12-SC', 1, NULL, 0.000, 0),
(5, '../assets/img/masina1.png', 27.471, 'Sa 15 programa, uključujući Pamuk, Sport i Vunu, imaš svaku opciju koja ti je potrebna za savršeno čistu odeću.', 'Gorenje WNHVB 6X2 SDS Mašina za pranje veša, 6 kg', 2, NULL, 0.000, 0),
(6, '../assets/img/masina2.png', 27.899, 'Beko Mašina za pranje veša WUE 7611 D XAW ProSmart ima kapacitet pranja od 7 kg, omogućavajući ti da opereš veće količine veša istovremeno, štedeći vreme i energiju.', 'Beko ProSmart WUE 7611 D XAW Mašina za pranje veša, 7 kg, ProSmart motor', 2, NULL, 0.000, 0),
(7, '../assets/img/masina3.png', 31.999, 'Beko WTE 8511 X0 mašina za pranje veša pruža impresivan kapacitet pranja od 8 kg, omogućavajući efikasno pranje velikih količina veša u jednom ciklusu.\r\n', 'Beko WTE 8511 X0 Mašina za pranje veša, 8 kg, ProSmart motor', 2, NULL, 0.000, 0),
(8, '../assets/img/masina4.png', 26.299, 'Model takođe ima visok nivo buke od 60 dB tokom pranja i 72 dB tokom centrifuge, obezbeđujući mirno i tiho okruženje tokom rada.', 'Beko WUE 6411 XWW, Mašina za pranje veša, 6kg, Bela', 2, NULL, 0.000, 0),
(9, '../assets/img/frizider1.png', 22.491, ' Sa nivoom buke od samo 41 dB, frižider je izuzetno tih, što ga čini idealnim za otvorene prostorije ili stanove gde tišina znači komfor', 'VOX KG 2500F Kombinovani frižider, 213 l, 41 dB', 3, NULL, 0.000, 0),
(10, '../assets/img/frizider2.png', 42.999, 'Ovaj frižider ima praktičan LED ekran za jednostavno podešavanje temperature i indikator koji prikazuje tačnu temperaturu u frižideru.', 'Gorenje NRKE 62 XL Kombinovani frižider, 241 l, Sivi', 3, NULL, 0.000, 0),
(11, '../assets/img/frizider3.png', 44.999, 'Zahvaljujući No Frost sistemu u frižiderskom delu, zaboravi na ručno odmrzavanje i uživaj u uvek optimalnoj temperaturi za tvoje namirnice.', 'GORENJE Kombinovani frižider NRK6192SYBK', 3, NULL, 0.000, 0),
(12, '../assets/img/frizider4.png', 23.789, 'Specifikacije:\r\n• Dimenzije: 54.5 x 143 x 55.5 cm\r\n• LED osvetljenje\r\n• Nivo buke: 40 dB', 'BEKO Kombinovani frižider RDSO 206K31 SN srebrni', 3, NULL, 0.000, 0),
(13, '../assets/img/mikrotalasna1.png', 11.263, 'Uživaj u jednostavnoj upotrebi zahvaljujući automatskom podešavanju vremena i dečijoj zaštiti.', 'Samsung MS23F301TAK/OL Mikrotalasna rerna, 1150 W, Crna', 4, NULL, 0.000, 0),
(14, '../assets/img/mikrotalasna2.png', 16.390, 'Specifikacije:\r\n• Oprema, elementi i sastavni delovi: Ekran\r\n• Tip: Samostojeći\r\n• Smer otvaranja vrata. Na stranu', 'CANDY Mikrotalasna CMXG 22 DS Futura srebrna', 4, NULL, 0.000, 0),
(15, '../assets/img/mikrotalasna3.png', 12.490, 'Specifikacije:\r\n• Hansa mikrotalasna rerna AMG20M70GSVH\r\n• Samostojeća mikrotalasna rerna sa grilom\r\n• Snaga mikrotalasa: 700 W\r\n', 'Hansa AMG20M70GSVH Mikrotalasna rerna, Srebrna', 4, NULL, 0.000, 0),
(16, '../assets/img/mikrotalasna4.png', 10.473, '• SAMOSTOJEĆA: Tesla mikrotalasna rerna MW2060MS je samostojeći uređaj koji se lako uklapa u svaku kuhinju.\r\n• ZAPREMINA: Sa zapreminom od 20 litara, ova mikrotalasna rerna je idealna za pripremu obroka za male i srednje porodice.\r\n• GRIL FUNKCIJA: Uživaj u hrskavim i sočnim jelima zahvaljujući gril funkciji od 1000 W.\r\n• DIGITALNE KOMANDE: Elektronsko upravljanje i digitalne komande omogućavaju lako i precizno podešavanje programa kuvanja.\r\n• SIGURNOST: Sigurnosna brava za decu i zvučni signal kraja kuvanja pružaju dodatnu bezbednost i udobnost u korišćenju.', 'TESLA Mikrotalasna MW2060MS srebrna', 4, NULL, 0.000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `slike`
--

CREATE TABLE `slike` (
  `id` int(11) NOT NULL,
  `naziv` varchar(50) NOT NULL,
  `putanja` varchar(100) NOT NULL,
  `alt` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slike`
--

INSERT INTO `slike` (`id`, `naziv`, `putanja`, `alt`) VALUES
(1, 'naslovna', 'assets/img/naslovna.jpg', 'Naslova'),
(2, 'Frižideri', 'assets/img/frizider_ponuda.png', 'Frižideri'),
(3, 'Veš mašine', 'assets/img/ves_masina_ponuda.png', 'Veš mašine'),
(4, 'Klime', 'assets/img/klima_ponuda.png', 'Klima'),
(6, 'Mikrotalasne rerne', 'assets/img/mikrotalasna_ponuda.png', 'Mikrotalasna'),
(7, 'Bela tehnika baner', 'assets/img/bela_tehnika_baner.png', 'belatehnikabane');

-- --------------------------------------------------------

--
-- Table structure for table `snizenje_proizvoda`
--

CREATE TABLE `snizenje_proizvoda` (
  `id` int(11) NOT NULL,
  `snizenje` tinyint(1) NOT NULL,
  `proizvod_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `snizenje_proizvoda`
--

INSERT INTO `snizenje_proizvoda` (`id`, `snizenje`, `proizvod_id`) VALUES
(1, 1, 0),
(2, 0, 0),
(3, 0, 1),
(4, 1, 2),
(6, 0, 1),
(7, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `uloge`
--

CREATE TABLE `uloge` (
  `id` int(11) NOT NULL,
  `uloga` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `uloge`
--

INSERT INTO `uloge` (`id`, `uloga`) VALUES
(2, 'Admin'),
(1, 'Korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `vrsta_proizvoda`
--

CREATE TABLE `vrsta_proizvoda` (
  `id` int(11) NOT NULL,
  `vrsta` varchar(40) NOT NULL,
  `proizvod_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vrsta_proizvoda`
--

INSERT INTO `vrsta_proizvoda` (`id`, `vrsta`, `proizvod_id`) VALUES
(1, 'Klima', NULL),
(2, 'Veš mašina', NULL),
(3, 'Frižider', NULL),
(4, 'Mikrotalasna rerna', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ikonice`
--
ALTER TABLE `ikonice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontakt`
--
ALTER TABLE `kontakt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`email`),
  ADD KEY `fk_uloga` (`uloga`);

--
-- Indexes for table `logovi`
--
ALTER TABLE `logovi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meni`
--
ALTER TABLE `meni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `narudzbine`
--
ALTER TABLE `narudzbine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `narudzbine_proizvodi`
--
ALTER TABLE `narudzbine_proizvodi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `narudzbina_id` (`narudzbina_id`),
  ADD KEY `proizvod_id` (`proizvod_id`);

--
-- Indexes for table `prijavanovosti`
--
ALTER TABLE `prijavanovosti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vrsta_proizvoda_id` (`vrsta_proizvoda_id`);

--
-- Indexes for table `slike`
--
ALTER TABLE `slike`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `snizenje_proizvoda`
--
ALTER TABLE `snizenje_proizvoda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uloge`
--
ALTER TABLE `uloge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_uloga` (`uloga`);

--
-- Indexes for table `vrsta_proizvoda`
--
ALTER TABLE `vrsta_proizvoda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_proizvodi_vrsta_proizvoda` (`proizvod_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ikonice`
--
ALTER TABLE `ikonice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kontakt`
--
ALTER TABLE `kontakt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `logovi`
--
ALTER TABLE `logovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `meni`
--
ALTER TABLE `meni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `narudzbine`
--
ALTER TABLE `narudzbine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `narudzbine_proizvodi`
--
ALTER TABLE `narudzbine_proizvodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `prijavanovosti`
--
ALTER TABLE `prijavanovosti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `proizvodi`
--
ALTER TABLE `proizvodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `slike`
--
ALTER TABLE `slike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `snizenje_proizvoda`
--
ALTER TABLE `snizenje_proizvoda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `uloge`
--
ALTER TABLE `uloge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vrsta_proizvoda`
--
ALTER TABLE `vrsta_proizvoda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD CONSTRAINT `fk_uloga` FOREIGN KEY (`uloga`) REFERENCES `uloge` (`id`);

--
-- Constraints for table `narudzbine`
--
ALTER TABLE `narudzbine`
  ADD CONSTRAINT `narudzbine_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `korisnici` (`id`);

--
-- Constraints for table `narudzbine_proizvodi`
--
ALTER TABLE `narudzbine_proizvodi`
  ADD CONSTRAINT `narudzbine_proizvodi_ibfk_1` FOREIGN KEY (`narudzbina_id`) REFERENCES `narudzbine` (`id`),
  ADD CONSTRAINT `narudzbine_proizvodi_ibfk_2` FOREIGN KEY (`proizvod_id`) REFERENCES `proizvodi` (`id`);

--
-- Constraints for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD CONSTRAINT `FK_snizenje_proizvoda` FOREIGN KEY (`snizenje_id`) REFERENCES `snizenje_proizvoda` (`id`),
  ADD CONSTRAINT `proizvodi_ibfk_1` FOREIGN KEY (`vrsta_proizvoda_id`) REFERENCES `vrsta_proizvoda` (`id`),
  ADD CONSTRAINT `proizvodi_ibfk_2` FOREIGN KEY (`snizenje_id`) REFERENCES `snizenje_proizvoda` (`id`);

--
-- Constraints for table `snizenje_proizvoda`
--
ALTER TABLE `snizenje_proizvoda`
  ADD CONSTRAINT `FK_proizvodi_snizenje_proizvoda` FOREIGN KEY (`proizvod_id`) REFERENCES `proizvodi` (`id`);

--
-- Constraints for table `vrsta_proizvoda`
--
ALTER TABLE `vrsta_proizvoda`
  ADD CONSTRAINT `FK_proizvodi_vrsta_proizvoda` FOREIGN KEY (`proizvod_id`) REFERENCES `proizvodi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
