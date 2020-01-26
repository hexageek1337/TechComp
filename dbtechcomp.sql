-- --------------------------------------------------------
-- Tech Comp Database Structure
-- Version 1.0
-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `id_transaksi` varchar(12) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `kode_item` varchar(6) NOT NULL,
  `jumlah_transaksi` bigint(20) NOT NULL,
  `total_transaksi` bigint(20) NOT NULL,
  `tgl_transaksi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `pengguna`
--
DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` ENUM('Admin','User') NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `item`
--
DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `kode_item` varchar(6) NOT NULL,
  `kode_kategoriitem` varchar(6) NOT NULL,
  `nama_item` varchar(120) NOT NULL,
  `harga_item` bigint(20) NOT NULL,
  `stok_item` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_item`
--
DROP TABLE IF EXISTS `kategori_item`;
CREATE TABLE `kategori_item` (
  `kode_kategoriitem` varchar(6) NOT NULL,
  `nama_kategoriitem` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `pengguna` (`id_pengguna`, `nama_lengkap`, `email`, `username`, `password`, `role`) VALUES
(1, 'Administrator', 'denny@denny.my.id', 'admin', '21232f297a57a5a743894a0e4a801fc3','Admin'),
(2, 'Mamat', 'sealgeek@gmail.com', 'user', '21232f297a57a5a743894a0e4a801fc3','User');

INSERT INTO `kategori_item` (`kode_kategoriitem`, `nama_kategoriitem`) VALUES
('MSE', 'Mouse'),
('KYEBRD', 'Keyboard');

INSERT INTO `item` (`kode_item`, `kode_kategoriitem`, `nama_item`, `harga_item`, `stok_item`) VALUES
('STLF10', 'MSE', 'Steelseries F100', 1100000, 10),
('ARMAK3', 'KYEBRD', 'Armageddon Ak300x', 545000, 5);

INSERT INTO `transaksi` (`id_transaksi`, `id_pengguna`, `kode_item`, `jumlah_transaksi`, `total_transaksi`, `tgl_transaksi`) VALUES
('202001230001', 2, 'ARMAK3', 2, 1090000, '2020-01-23 07:15:25'),
('202001240001', 2, 'STLF10', 3, 3300000, '2020-01-24 08:44:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`kode_item`,`kode_kategoriitem`),
  ADD KEY `kode_kategoriitem` (`kode_kategoriitem`);

--
-- Indexes for table `kategori_item`
--
ALTER TABLE `kategori_item`
  ADD PRIMARY KEY (`kode_kategoriitem`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE(`email`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`,`id_pengguna`,`kode_item`),
  ADD KEY `id_pengguna` (`id_pengguna`,`kode_item`),
  ADD KEY `transkodeitem_FK` (`kode_item`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `itemKategoriFK` FOREIGN KEY (`kode_kategoriitem`) REFERENCES `kategori_item`(`kode_kategoriitem`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transIDPeng_FK` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `transkodeitem_FK` FOREIGN KEY (`kode_item`) REFERENCES `item` (`kode_item`) ON DELETE RESTRICT ON UPDATE RESTRICT;