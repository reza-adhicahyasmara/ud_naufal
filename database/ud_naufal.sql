/*
SQLyog Professional v12.5.1 (64 bit)
MySQL - 10.4.18-MariaDB : Database - ud_naufal
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ud_naufal` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `ud_naufal`;

/*Table structure for table `bank` */

DROP TABLE IF EXISTS `bank`;

CREATE TABLE `bank` (
  `kode_bank` varchar(5) NOT NULL,
  `nama_bank` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode_bank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `bank` */

insert  into `bank`(`kode_bank`,`nama_bank`) values 
('008','BANK MANDIRI'),
('009','BANK NEGARA INDONESIA'),
('011','BANK DANAMON INDONESIA'),
('013','BANK PERMATA'),
('014','BANK CENTRAL ASIA'),
('016','BANK MAYBANK  INDONESIA'),
('019','PAN INDONESIA BANK'),
('022','BANK CIMB NIAGA'),
('023','BANK UOB INDONESIA'),
('028','BANK OCBC NISP'),
('031','CITIBANK N.A.'),
('032','JP MORGAN CHASE BANK NA'),
('033','BANK OF AMERICA N.A'),
('036','BANK CHINA CONSTRUCTION BANK INDONESIA'),
('037','BANK ARTHA GRAHA INTERNASIONAL'),
('040','BANGKOK BANK PCL'),
('042','MUFG BANK LTD'),
('046','BANK DBS INDONESIA'),
('047','BANK RESONA PERDANIA'),
('048','BANK MIZUHO INDONESIA'),
('050','STANDARD CHARTERED BANK'),
('054','BANK CAPITAL INDONESIA'),
('057','BANK BNP PARIBAS INDONESIA'),
('061','BANK ANZ INDONESIA'),
('067','DEUTSCHE BANK AG'),
('069','BANK OF CHINA (HONG KONG) LIMITED'),
('076','BANK BUMI ARTA'),
('087','BANK HSBC INDONESIA'),
('095','BANK JTRUST INDONESIA'),
('097','BANK MAYAPADA INTERNATIONAL'),
('110','BPD JAWA BARAT DAN BANTEN'),
('111','BPD DKI'),
('112','BPD DAERAH ISTIMEWA YOGYAKARTA'),
('113','BPD JAWA TENGAH'),
('114','BPD JAWA TIMUR'),
('115','BPD JAMBI'),
('116','BANK ACEH SYARIAH'),
('117','BPD SUMATERA UTARA'),
('118','BPD SUMATERA BARAT'),
('119','BPD RIAU KEPRI'),
('120','BPD SUMATERA SELATAN DAN BANGKA BELITUNG'),
('121','BPD LAMPUNG'),
('122','BPD KALIMANTAN SELATAN'),
('123','BPD KALIMANTAN BARAT'),
('124','BPD KALIMANTAN TIMUR DAN KALIMANTAN UTARA'),
('125','BPD KALIMANTAN TENGAH'),
('126','BPD SULAWESI SELATAN DAN SULAWESI BARAT'),
('127','BPD SULAWESI UTARA DAN  GORONTALO'),
('128','BANK NTB SYARIAH'),
('129','BPD BALI'),
('130','BPD NUSA TENGGARA TIMUR'),
('131','BPD MALUKU DAN MALUKU UTARA'),
('132','BPD PAPUA'),
('133','BPD BENGKULU'),
('134','BPD SULAWESI TENGAH'),
('135','BPD SULAWESI TENGGARA'),
('137','BPD BANTEN'),
('146','BANK OF INDIA INDONESIA'),
('147','BANK MUAMALAT INDONESIA'),
('151','BANK MESTIKA DHARMA'),
('152','BANK SHINHAN INDONESIA'),
('153','BANK SINARMAS'),
('157','BANK MASPION INDONESIA'),
('161','BANK GANESHA'),
('164','BANK ICBC INDONESIA'),
('167','BANK QNB INDONESIA'),
('200','BANK TABUNGAN NEGARA'),
('212','BANK WOORI SAUDARA INDONESIA 1906'),
('213','BANK BTPN'),
('405','BANK VICTORIA SYARIAH'),
('425','BANK JABAR BANTEN SYARIAH'),
('426','BANK MEGA'),
('441','BANK KB BUKOPIN'),
('451','BANK SYARIAH Indonesia'),
('459','BANK BISNIS INTERNASIONAL'),
('472','BANK JASA JAKARTA'),
('484','BANK KEB HANA INDONESIA'),
('485','BANK MNC INTERNASIONAL'),
('490','BANK NEO COMMERCE'),
('494','BANK RAKYAT INDONESIA AGRONIAGA'),
('498','BANK SBI INDONESIA'),
('501','BANK DIGITAL BCA'),
('503','BANK NATIONALNOBU'),
('506','BANK MEGA SYARIAH'),
('513','BANK INA PERDANA'),
('517','BANK PANIN DUBAI SYARIAH'),
('520','PRIMA MASTER BANK'),
('521','BANK KB BUKOPIN SYARIAH'),
('523','BANK SAHABAT SAMPOERNA'),
('526','BANK OKE INDONESIA'),
('531','BANK AMAR INDONESIA'),
('535','BANK SEABANK INDONESIA'),
('536','BANK BCA SYARIAH'),
('542','BANK JAGO'),
('547','BANK BTPN SYARIAH'),
('548','BANK MULTIARTA SENTOSA'),
('553','BANK MAYORA'),
('555','BANK INDEX SELINDO'),
('562','BANK FAMA INTERNASIONAL'),
('564','BANK MANDIRI TASPEN'),
('566','BANK VICTORIA INTERNATIONAL'),
('567','ALLO BANK Indonesia'),
('945','BANK IBK INDONESIA'),
('947','BANK ALADIN SYARIAH'),
('949','BANK CTBC INDONESIA'),
('950','BANK COMMONWEALTH'),
('﻿002','BANK RAKYAT INDONESIA');

/*Table structure for table `distributor` */

DROP TABLE IF EXISTS `distributor`;

CREATE TABLE `distributor` (
  `id_distributor` varchar(50) NOT NULL,
  `nama_distributor` varchar(50) DEFAULT NULL,
  `pic_distributor` varchar(30) DEFAULT NULL,
  `kontak_distributor` varchar(15) DEFAULT NULL,
  `alamat_distributor` text DEFAULT NULL,
  `username_distributor` varchar(20) DEFAULT NULL,
  `password_distributor` varchar(20) DEFAULT NULL,
  `foto_distributor` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_distributor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `distributor` */

insert  into `distributor`(`id_distributor`,`nama_distributor`,`pic_distributor`,`kontak_distributor`,`alamat_distributor`,`username_distributor`,`password_distributor`,`foto_distributor`) values 
('735d350880a1e037c41a81dec16bf45820230520','PT SPC','Nurul','081111111111','Jakarta','distributor3','distributor3','2932221_9bf34dcf-7c57-4141-9dc7-dcc5309e295b.png'),
('9c47fe1189d9c1ea1a1ef13e21d8083c20220522','PT. Maju Mundur','Santo','0896434324123','Jln. Soekarno Hatta ','distributor1','distributor1',''),
('a6b5e3854877eeb3f68ea2f16bdcc16520220523','PT.  Punya Bapak','Ujang','023288872343','Jl. Pertatena','distributor2','distributor2','');

/*Table structure for table `ipembelian` */

DROP TABLE IF EXISTS `ipembelian`;

CREATE TABLE `ipembelian` (
  `kode_ipembelian` int(10) NOT NULL AUTO_INCREMENT,
  `kode_pembelian` varchar(50) DEFAULT NULL,
  `kode_produk` varchar(20) DEFAULT NULL,
  `id_distributor` varchar(50) DEFAULT NULL,
  `tanggal_masuk_ipembelian` datetime DEFAULT NULL,
  `qty_ipembelian` float DEFAULT NULL,
  `harga_ipembelian` float DEFAULT NULL,
  `subtotal_ipembelian` float DEFAULT NULL,
  `status_ipembelian` varchar(20) DEFAULT NULL,
  `tanggal_retur_ipembelian` datetime DEFAULT NULL,
  `qty_retur_ipembelian` float DEFAULT NULL,
  `gambar_retur_ipembelian` varchar(255) DEFAULT NULL,
  `keterangan_retur_ipembelian` text DEFAULT NULL,
  `status_retur_ipembelian` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`kode_ipembelian`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;

/*Data for the table `ipembelian` */

insert  into `ipembelian`(`kode_ipembelian`,`kode_pembelian`,`kode_produk`,`id_distributor`,`tanggal_masuk_ipembelian`,`qty_ipembelian`,`harga_ipembelian`,`subtotal_ipembelian`,`status_ipembelian`,`tanggal_retur_ipembelian`,`qty_retur_ipembelian`,`gambar_retur_ipembelian`,`keterangan_retur_ipembelian`,`status_retur_ipembelian`) values 
(48,'INV-20230521160516','MKN1','9c47fe1189d9c1ea1a1ef13e21d8083c20220522','2023-05-21 18:05:05',96,2250000,216000000,'Selesai',NULL,0,NULL,'',NULL);

/*Table structure for table `ipenjualan` */

DROP TABLE IF EXISTS `ipenjualan`;

CREATE TABLE `ipenjualan` (
  `kode_ipenjualan` int(10) NOT NULL AUTO_INCREMENT,
  `kode_penjualan` varchar(50) DEFAULT NULL,
  `kode_produk` varchar(30) DEFAULT NULL,
  `qty_ipenjualan` float DEFAULT NULL,
  `harga_ipenjualan` float DEFAULT NULL,
  `subtotal_ipenjualan` float DEFAULT NULL,
  `tanggal_ipenjualan` datetime DEFAULT NULL,
  `keterangan_ipenjualan` text DEFAULT NULL,
  `status_ipenjualan` int(10) DEFAULT NULL,
  PRIMARY KEY (`kode_ipenjualan`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `ipenjualan` */

insert  into `ipenjualan`(`kode_ipenjualan`,`kode_penjualan`,`kode_produk`,`qty_ipenjualan`,`harga_ipenjualan`,`subtotal_ipenjualan`,`tanggal_ipenjualan`,`keterangan_ipenjualan`,`status_ipenjualan`) values 
(3,'PNJ-20230521210521','MKN1',6,2350000,14100000,'2023-05-21 21:05:21',NULL,1),
(5,NULL,'MKN1',1,2350000,2350000,NULL,NULL,0);

/*Table structure for table `karyawan` */

DROP TABLE IF EXISTS `karyawan`;

CREATE TABLE `karyawan` (
  `id_karyawan` varchar(10) NOT NULL,
  `level_karyawan` varchar(10) DEFAULT NULL,
  `nama_karyawan` varchar(30) DEFAULT NULL,
  `alamat_karyawan` text DEFAULT NULL,
  `kontak_karyawan` varchar(15) DEFAULT NULL,
  `username_karyawan` varchar(50) DEFAULT NULL,
  `password_karyawan` varchar(50) DEFAULT NULL,
  `foto_karyawan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_karyawan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `karyawan` */

insert  into `karyawan`(`id_karyawan`,`level_karyawan`,`nama_karyawan`,`alamat_karyawan`,`kontak_karyawan`,`username_karyawan`,`password_karyawan`,`foto_karyawan`) values 
('1','Admin','Rian Balmon','Gewok Garawangi Kuningan','089999999999','admin','admin',''),
('2','Pemilik','Rizki','Kuningan','082222222222','pemilik','pemilik',NULL),
('3','Kasir','Aji','Ciawigebang','083333333333','kasir','kasir','');

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `kode_kategori` varchar(10) NOT NULL,
  `nama_kategori` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `kategori` */

insert  into `kategori`(`kode_kategori`,`nama_kategori`) values 
('MKNINS','Makanan Instan'),
('MKNRGN','Makanan Ringan'),
('MNMBTL','Minuman Botol'),
('MNMKLG','Minuman Kaleng'),
('MNMSRB','Minuman Serbuk');

/*Table structure for table `pembelian` */

DROP TABLE IF EXISTS `pembelian`;

CREATE TABLE `pembelian` (
  `kode_pembelian` varchar(50) NOT NULL,
  `id_distributor` varchar(50) DEFAULT NULL,
  `kode_rekening` varchar(10) DEFAULT NULL,
  `tanggal_pengajuan_pembelian` datetime DEFAULT NULL,
  `tanggal_penerimaan_pembelian` datetime DEFAULT NULL,
  `total_pby_pembelian` float DEFAULT NULL,
  `bukti_pby_pembelian` varchar(255) DEFAULT NULL,
  `status_pby_pembelian` varchar(20) DEFAULT NULL,
  `keterangan_pembelian` text DEFAULT NULL,
  `status_pembelian` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`kode_pembelian`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pembelian` */

insert  into `pembelian`(`kode_pembelian`,`id_distributor`,`kode_rekening`,`tanggal_pengajuan_pembelian`,`tanggal_penerimaan_pembelian`,`total_pby_pembelian`,`bukti_pby_pembelian`,`status_pby_pembelian`,`keterangan_pembelian`,`status_pembelian`) values 
('INV-20230521160516','9c47fe1189d9c1ea1a1ef13e21d8083c20220522','4','2023-05-21 16:05:16','2023-05-21 18:05:05',216000000,'bukti_transfer1.jpg','Lunas',NULL,'5');

/*Table structure for table `penawaran` */

DROP TABLE IF EXISTS `penawaran`;

CREATE TABLE `penawaran` (
  `kode_penawaran` varchar(50) NOT NULL,
  `id_distributor` varchar(50) DEFAULT NULL,
  `nama_penawaran` varchar(50) DEFAULT NULL,
  `tanggal_penawaran` datetime DEFAULT NULL,
  `berkas_penawaran` varchar(255) DEFAULT NULL,
  `status_penawaran` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`kode_penawaran`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `penawaran` */

insert  into `penawaran`(`kode_penawaran`,`id_distributor`,`nama_penawaran`,`tanggal_penawaran`,`berkas_penawaran`,`status_penawaran`) values 
('4236c94d4d85c0c8a06299de59963d54','9c47fe1189d9c1ea1a1ef13e21d8083c20220522','uuuuuuu','2023-05-21 10:05:11','Test_Aja.pdf','2');

/*Table structure for table `penjualan` */

DROP TABLE IF EXISTS `penjualan`;

CREATE TABLE `penjualan` (
  `kode_penjualan` varchar(50) NOT NULL,
  `nama_penjualan` varchar(30) DEFAULT NULL,
  `tanggal_penjualan` datetime DEFAULT NULL,
  `cash_penjualan` float DEFAULT NULL,
  `total_penjualan` float DEFAULT NULL,
  `keterangan_penjualan` text DEFAULT NULL,
  PRIMARY KEY (`kode_penjualan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `penjualan` */

insert  into `penjualan`(`kode_penjualan`,`nama_penjualan`,`tanggal_penjualan`,`cash_penjualan`,`total_penjualan`,`keterangan_penjualan`) values 
('PNJ-20230521210521','reza','2023-05-21 21:05:21',15000000,14100000,'');

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `kode_produk` varchar(30) NOT NULL,
  `kode_kategori` varchar(10) DEFAULT NULL,
  `kode_penawaran` varchar(50) DEFAULT NULL,
  `id_distributor` varchar(50) DEFAULT NULL,
  `status_penawaran_produk` varchar(20) DEFAULT NULL,
  `nama_produk` varchar(50) DEFAULT NULL,
  `satuan_produk` varchar(30) DEFAULT NULL,
  `harga_beli_produk` float DEFAULT NULL,
  `harga_jual_produk` float DEFAULT NULL,
  `stok_dis_produk` float DEFAULT NULL,
  `limit_dis_produk` float DEFAULT NULL,
  `stok_tok_produk` float DEFAULT NULL,
  `limit_tok_produk` float DEFAULT NULL,
  `gambar_produk` varchar(255) DEFAULT NULL,
  `d_produk` float DEFAULT NULL,
  `h_produk` float DEFAULT NULL,
  `lt_produk` float DEFAULT NULL,
  `au_produk` float DEFAULT NULL,
  `ss_produk` float DEFAULT NULL,
  `tanggal_produk` date DEFAULT NULL,
  `perubahan_produk` varchar(20) DEFAULT NULL,
  `perubahan_harga_produk` float DEFAULT NULL,
  PRIMARY KEY (`kode_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `produk` */

insert  into `produk`(`kode_produk`,`kode_kategori`,`kode_penawaran`,`id_distributor`,`status_penawaran_produk`,`nama_produk`,`satuan_produk`,`harga_beli_produk`,`harga_jual_produk`,`stok_dis_produk`,`limit_dis_produk`,`stok_tok_produk`,`limit_tok_produk`,`gambar_produk`,`d_produk`,`h_produk`,`lt_produk`,`au_produk`,`ss_produk`,`tanggal_produk`,`perubahan_produk`,`perubahan_harga_produk`) values 
('MKN1','MKNINS','4236c94d4d85c0c8a06299de59963d54','9c47fe1189d9c1ea1a1ef13e21d8083c20220522','Diterima','Mie Instan','Dus',2250000,2350000,904,10,90,10,'cropped-cropped-logo-RSU45-11.png',97,47500,6,0.265753,6,'2023-05-21','Baru',3000);

/*Table structure for table `rekening` */

DROP TABLE IF EXISTS `rekening`;

CREATE TABLE `rekening` (
  `kode_rekening` int(10) NOT NULL AUTO_INCREMENT,
  `id_distributor` varchar(50) DEFAULT NULL,
  `kode_bank` varchar(10) DEFAULT NULL,
  `an_rekening` varchar(50) DEFAULT NULL,
  `no_rekening` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`kode_rekening`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `rekening` */

insert  into `rekening`(`kode_rekening`,`id_distributor`,`kode_bank`,`an_rekening`,`no_rekening`) values 
(1,'','014','UD Naufal',2990923882),
(2,'9c47fe1189d9c1ea1a1ef13e21d8083c20220522','014','PT Maju Terus',2990000001),
(3,'a6b5e3854877eeb3f68ea2f16bdcc16520220523','008','PT KUNINGAN JAYA',2343434331312453),
(4,'9c47fe1189d9c1ea1a1ef13e21d8083c20220522','008','PT Maju Terus',4349324898939),
(5,'','﻿002','UD Naufal',5435454545434);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
