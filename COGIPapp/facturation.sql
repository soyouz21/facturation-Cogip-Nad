-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 13, 2017 at 09:24 AM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `facturation`
--

-- --------------------------------------------------------

--
-- Table structure for table `factures`
--

CREATE TABLE `factures` (
  `id_facture` int(11) NOT NULL,
  `numero_facture` varchar(50) NOT NULL,
  `date_facture` date NOT NULL,
  `id_societe` int(11) NOT NULL,
  `date_echeance_facture` date NOT NULL,
  `id_personne` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `factures`
--

INSERT INTO `factures` (`id_facture`, `numero_facture`, `date_facture`, `id_societe`, `date_echeance_facture`, `id_personne`) VALUES
(1, 'FACTO201709040001', '2017-09-04', 1, '2017-09-29', 1),
(2, 'FACTO201709040035', '2017-09-04', 1, '2017-09-28', 1),
(3, 'FACTO201709040043', '2017-09-04', 3, '2017-09-27', 1),
(4, 'FACTO201709040099', '2017-09-04', 3, '2017-09-25', 1),
(5, 'FACTO201709040028', '2017-09-04', 1, '2017-09-30', 1),
(6, 'FACTO201709040015', '2017-09-04', 1, '2017-09-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personnes`
--

CREATE TABLE `personnes` (
  `id_personne` int(11) NOT NULL,
  `nom_personne` varchar(100) NOT NULL,
  `prenom_personne` varchar(100) NOT NULL,
  `tel_personne` varchar(50) NOT NULL,
  `email_personne` varchar(50) NOT NULL,
  `id_societe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `personnes`
--

INSERT INTO `personnes` (`id_personne`, `nom_personne`, `prenom_personne`, `tel_personne`, `email_personne`, `id_societe`) VALUES
(1, 'Ranu', 'Jean-Christian', '0475/99.25.01', 'jean@gmail.com', 3),
(2, 'Peters', 'Claude', '0477/28.95.11', 'claude@hotmail.com', 3);

-- --------------------------------------------------------

--
-- Table structure for table `societe`
--

CREATE TABLE `societe` (
  `id_societe` int(11) NOT NULL,
  `nom_societe` varchar(50) NOT NULL,
  `adresse_societe` varchar(75) NOT NULL,
  `tel_societe` varchar(50) NOT NULL,
  `tva_societe` varchar(50) NOT NULL,
  `id_type` int(11) NOT NULL,
  `compte_bancaire_societe` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `societe`
--

INSERT INTO `societe` (`id_societe`, `nom_societe`, `adresse_societe`, `tel_societe`, `tva_societe`, `id_type`, `compte_bancaire_societe`) VALUES
(1, 'Orange', 'Rue des goujons, 152', '02/544.67.91', 'BE09.098.743.213', 1, 'BE23 3290 3298 3466'),
(2, 'Luminus', 'Rue du parc jean, 33', '071/65.91.30', 'BE01.984.349.126', 1, 'BE01 0010 9898 0268'),
(3, 'Belgacom', 'Avenue Brugmann, 55', '02/800.00.30', 'BE43.098.000.111', 2, 'BE32 0021 3451 7890'),
(4, 'BeCode', 'Rue des goujons, 152', '0456/55.89.00', 'BE47.091.167.081', 2, 'BE31 0945 0956 1257');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id_type` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id_type`, `type`) VALUES
(1, 'client'),
(2, 'fournisseur');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `factures`
--
ALTER TABLE `factures`
  ADD PRIMARY KEY (`id_facture`),
  ADD KEY `id_societe` (`id_societe`),
  ADD KEY `id_personne` (`id_personne`);

--
-- Indexes for table `personnes`
--
ALTER TABLE `personnes`
  ADD PRIMARY KEY (`id_personne`),
  ADD KEY `id_societe` (`id_societe`);

--
-- Indexes for table `societe`
--
ALTER TABLE `societe`
  ADD PRIMARY KEY (`id_societe`),
  ADD KEY `id_type` (`id_type`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `factures`
--
ALTER TABLE `factures`
  MODIFY `id_facture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `personnes`
--
ALTER TABLE `personnes`
  MODIFY `id_personne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `societe`
--
ALTER TABLE `societe`
  MODIFY `id_societe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
