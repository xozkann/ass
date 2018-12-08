-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 01 Ara 2018, 23:08:58
-- Sunucu sürümü: 5.6.34-log
-- PHP Sürümü: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `ass`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `vt_basliklar`
--

CREATE TABLE `vt_basliklar` (
  `vt_id` int(11) NOT NULL,
  `vt_kullid` int(11) NOT NULL,
  `vt_baslik` varchar(255) NOT NULL,
  `vt_kategori` varchar(255) NOT NULL,
  `vt_detay` text NOT NULL,
  `vt_tarih` varchar(255) NOT NULL,
  `vt_saat` varchar(255) NOT NULL,
  `vt_durum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `vt_kategoriler`
--

CREATE TABLE `vt_kategoriler` (
  `vt_id` int(11) NOT NULL,
  `vt_kategori` varchar(255) NOT NULL,
  `vt_sira` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `vt_kullanicilar`
--

CREATE TABLE `vt_kullanicilar` (
  `vt_id` int(11) NOT NULL,
  `vt_isim` varchar(255) NOT NULL,
  `vt_soyisim` varchar(255) NOT NULL,
  `vt_eposta` varchar(255) NOT NULL,
  `vt_sifre` varchar(255) NOT NULL,
  `vt_durum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `vt_yorumlar`
--

CREATE TABLE `vt_yorumlar` (
  `vt_id` int(11) NOT NULL,
  `vt_kullid` varchar(255) NOT NULL,
  `vt_yorum` text NOT NULL,
  `vt_tarih` varchar(255) NOT NULL,
  `vt_saat` varchar(255) NOT NULL,
  `vt_konuid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `vt_basliklar`
--
ALTER TABLE `vt_basliklar`
  ADD PRIMARY KEY (`vt_id`);

--
-- Tablo için indeksler `vt_kategoriler`
--
ALTER TABLE `vt_kategoriler`
  ADD PRIMARY KEY (`vt_id`);

--
-- Tablo için indeksler `vt_kullanicilar`
--
ALTER TABLE `vt_kullanicilar`
  ADD PRIMARY KEY (`vt_id`);

--
-- Tablo için indeksler `vt_yorumlar`
--
ALTER TABLE `vt_yorumlar`
  ADD PRIMARY KEY (`vt_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `vt_basliklar`
--
ALTER TABLE `vt_basliklar`
  MODIFY `vt_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `vt_kategoriler`
--
ALTER TABLE `vt_kategoriler`
  MODIFY `vt_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `vt_kullanicilar`
--
ALTER TABLE `vt_kullanicilar`
  MODIFY `vt_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `vt_yorumlar`
--
ALTER TABLE `vt_yorumlar`
  MODIFY `vt_id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
