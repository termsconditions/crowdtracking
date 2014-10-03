-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 03. Oktober 2014 jam 20:01
-- Versi Server: 5.5.16
-- Versi PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `crowdtracking`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `relations`
--

CREATE TABLE IF NOT EXISTS `relations` (
  `me` int(11) NOT NULL,
  `following` int(11) NOT NULL,
  `date` date NOT NULL,
  KEY `fk_me` (`me`),
  KEY `fk_following` (`following`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `relations`
--

INSERT INTO `relations` (`me`, `following`, `date`) VALUES
(2, 1, '2014-10-01'),
(2, 3, '2014-10-01'),
(1, 3, '2014-10-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_tab_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `live_status` int(1) NOT NULL,
  `status` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tab_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_tab_user`, `username`, `lat`, `lng`, `password`, `nama`, `live_status`, `status`, `photo`) VALUES
(1, 'rifqithomi', -8.77909, 110.722, '123', 'rifqi thomi', 1, 'apa deh', 'default'),
(2, 'tomtom', -6.1802, 106.821, '123', 'tomtom', 1, 'hahahhaha', 'default'),
(3, 'ouchouch', -1.527, 118.215, '123', 'timtim', 1, 'hihihihi', 'default');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `relations`
--
ALTER TABLE `relations`
  ADD CONSTRAINT `relations_ibfk_2` FOREIGN KEY (`following`) REFERENCES `user` (`id_tab_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `relations_ibfk_1` FOREIGN KEY (`me`) REFERENCES `user` (`id_tab_user`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
