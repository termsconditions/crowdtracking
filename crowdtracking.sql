-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 04. Oktober 2014 jam 05:20
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
-- Struktur dari tabel `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `isi` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  KEY `fk_user1` (`user1`),
  KEY `fk_user2` (`user2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `chat`
--

INSERT INTO `chat` (`user1`, `user2`, `isi`, `tanggal`) VALUES
(1, 2, 'aaa', '2014-10-04'),
(1, 2, 'sdasad', '2014-10-04'),
(1, 2, 'dfgc', '2014-10-04'),
(1, 2, 'hola guys', '2014-10-04'),
(1, 2, 'asd', '2014-10-04'),
(1, 2, 'asd', '2014-10-04'),
(1, 2, 'asd', '2014-10-04'),
(1, 2, 'aaaaaa', '2014-10-04'),
(1, 2, 'aaaaaaaaaaaa', '2014-10-04'),
(1, 2, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2014-10-04'),
(1, 2, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2014-10-04'),
(1, 2, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2014-10-04'),
(1, 3, 'siapa nih', '2014-10-04');

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
(1, 3, '2014-10-01'),
(1, 2, '2014-10-02');

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
(1, 'rifqithomi', -6.18009, 106.821, '123', 'rifqi thomi', 1, 'apa deh', 'default'),
(2, 'tomtom', -6.91486, 107.608, '123', 'tomtom', 1, 'hahahhaha', 'default'),
(3, 'ouchouch', -6.18016, 106.821, '123', 'timtim', 1, 'hihihihi', 'dd');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`user2`) REFERENCES `user` (`id_tab_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`user1`) REFERENCES `user` (`id_tab_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `relations`
--
ALTER TABLE `relations`
  ADD CONSTRAINT `relations_ibfk_2` FOREIGN KEY (`following`) REFERENCES `user` (`id_tab_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `relations_ibfk_1` FOREIGN KEY (`me`) REFERENCES `user` (`id_tab_user`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
