/*
Navicat MySQL Data Transfer

Source Server         : koneksimysql
Source Server Version : 50141
Source Host           : localhost:3306
Source Database       : dbwisatapati

Target Server Type    : MYSQL
Target Server Version : 50141
File Encoding         : 65001

Date: 2017-03-06 09:33:08
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO admin VALUES ('1', 'Admin', 'admin', 'fe01ce2a7fbac8fafaed7c982a04e229');

-- ----------------------------
-- Table structure for `berita`
-- ----------------------------
DROP TABLE IF EXISTS `berita`;
CREATE TABLE `berita` (
  `id_berita` int(10) NOT NULL AUTO_INCREMENT,
  `judul` varchar(50) DEFAULT NULL,
  `berita` text,
  `tanggal` varchar(25) DEFAULT NULL,
  `gambar` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`id_berita`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of berita
-- ----------------------------
INSERT INTO berita VALUES ('1', 'Air Terjun Grenjengan Jol', 'Jolong sebelumnya terkenal sebagai perkebunan kopi dan bumi perkemahan. Di wilayah yang berada di lereng lereng gunung Muria dan termasuk dalam wilayah administrasi kecamatan Gembong kabupaten Pati itu memang terdapat PT Perkebunan Nasional (PTPN IX) yang merupakan salah satu perkebunan dan pabrik pengolahan kopi yang sudah beroperasi sejak jaman penjajahan Belanda.', '10/08/2016', 'air-terjung-grenjengan-jolong.jpg');
INSERT INTO berita VALUES ('2', 'Pintu Gerbang Kaputren Majapahit di Pati ', 'Pintu Gerbang Kaputren Majapahit ini, terletak di Desa Rendole kec Margorejo kabupaten Pati. yang merupakan salah satu situs cagar alam yang berupa Pintu Gerbang yang terbuat dari kayu jati.Pintu gerbang ini merupakan peninggalan Kerajaan Majapahit.', '10/08/2016', 'dsc_9290.jpg');

-- ----------------------------
-- Table structure for `buku_tamu`
-- ----------------------------
DROP TABLE IF EXISTS `buku_tamu`;
CREATE TABLE `buku_tamu` (
  `id_buku_tamu` int(4) NOT NULL AUTO_INCREMENT,
  `nama` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `company` varchar(35) DEFAULT NULL,
  `telepon` varchar(12) DEFAULT NULL,
  `subjek` varchar(30) DEFAULT NULL,
  `pesan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_buku_tamu`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of buku_tamu
-- ----------------------------
INSERT INTO buku_tamu VALUES ('1', 'afif', 'afif_123@yahoo.co.id', 'lampung', '085228883437', 'admin', 'test pesan buku tamu');
INSERT INTO buku_tamu VALUES ('2', 'afif', 'afif_oke@yahoo.com', 'baturaja', '028388', 'samslalad', 'asdsaddsad');

-- ----------------------------
-- Table structure for `kategori`
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `jenis` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_kategori`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of kategori
-- ----------------------------
INSERT INTO kategori VALUES ('45', 'Lokasi Umum', 'lokasi_umum.png', 'Y');
INSERT INTO kategori VALUES ('44', 'Lokasi Wisata', 'wisata.png', 'Y');

-- ----------------------------
-- Table structure for `peta_wisata`
-- ----------------------------
DROP TABLE IF EXISTS `peta_wisata`;
CREATE TABLE `peta_wisata` (
  `id_wisata` int(4) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(4) DEFAULT NULL,
  `nama` text,
  `deskripsi` text,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `alamat` text,
  `gambar` text,
  PRIMARY KEY (`id_wisata`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of peta_wisata
-- ----------------------------
INSERT INTO peta_wisata VALUES ('9', '44', 'Goa Wareh, Kedumulyo, Sukolilo, Kabupaten Pati, Jawa Tengah', 'Gua Wareh adalah obyek wisata berupa goa di Desa Kedumulyo, Kecamatan Sukolilo, Kabupaten Pati, Jawa Tengah. Tempat wisata ini menyimpan sejarah, asal usul, mitos, misteri dan legenda yang berkembang di masyarakat setempat.\r\n\r\nDari pusat kota, lokasi objek wisata Gua Wareh bisa ditempuh sekitar 25 menit atau 15 kilometer. Goa Wareh merupakan satu di antara pesona dan keindahan pegunungan Kendeng yang membentang di sepanjang Pati wilayah selatan.\r\n\r\nLuas area di kawasan goa berkisar di angka 4,5 hektare, memiliki lorong gua menuju arah kiri sepanjang sekitar 100 meter. Daya tarik Goa Wareh semakin mempesona dengan adanya sungai bawah tanah sepanjang 50 meter dengan air yang sangat jernih dan bebas dari polusi air', '-6.94738663399983', '110.919878482819', 'Jl. Kudus - Purwodadi, Sukolilo, Kabupaten Pati, Jawa Tengah 59172, Indonesia', 'Gua Wareh Sukolilo Pati.jpg');
INSERT INTO peta_wisata VALUES ('8', '44', 'Goa Pancur Jimbaran, Kayen, Kabupaten Pati, Jawa Tengah', 'Gua pancur yang merupakan pesona wisata Kayen, Pati, Jawa Tengah menyimpan sejuta daya tarik tersendiri bagi wisatawan. Meski kondisinya sekarang ini tidak terawat, tetapi guo pancur bisa menjadi salah satu destinasi objek wisata di Pati yang paling menyenangkan.', '-6.92206010744324', '110.975700616837', 'Jl. Goa Pancur, Jimbaran, Kayen, Kabupaten Pati, Jawa Tengah 59171, Indonesia', 'Wisata Gua Pancur di Kayen Pati.jpg');
INSERT INTO peta_wisata VALUES ('7', '44', 'Waduk Gunungrowo, Gembong, Kabupaten Pati, Jawa Tengah', 'Waduk Gunung Rowo merupakan salah satu waduk yang ada di kabupaten Pati. Waduk ini tergolong luas dan mampu menampung air sebanyak kurang lebih 5,5 juta meter kubik. Waduk ini dibangun pada masa pemerintahan Belanda (menurut catatan Kantor Dinas Permukiman dan Prasarana Daerah setempat). Waduk Gunung Rowo sudah lama difungsikan sebagai penampungan air untuk mengairi area pertanian yang ada di bawahnya. Tetapi selain fungsi tersebut, ternyata waduk Gunung Rowo juga difungsikan sebagai lokasi wisata yang cukup menarik untuk menghabiskan waktu akhir pekan. Keadaa alam yang dikelilingi bukit dan berlatarkan pegunungan', '-6.6556135319192', '110.965969562531', 'Jl. Tlogo Wungu, Sitiluhur, Gembong, Kabupaten Pati, Jawa Tengah 59162, Indonesia', 'Waduk Gunung rowo.jpg');
INSERT INTO peta_wisata VALUES ('10', '44', 'Air Terjun Tadah Hujan, Sukolilo, Kabupaten Pati, Jawa Tengah', 'Pati adalah kabupaten yang sangat berpotensi akan tempat-tempat wisatanya yang dijamin memiliki keindahan yang luar biasa. Salah satu tempat wisata yang paling diminati oleh para wisatawan di Pati bernama Air Terjun Tadah Udan. Ini menjadi salah satu yang terbaik di Pati ', '-6.93145387284672', '110.88020324707', 'Jl. Galiran Baleadi, Baleadi, Sukolilo, Kabupaten Pati, Jawa Tengah 59172, Indonesia', 'air terjun tadah hujan.jpg');
INSERT INTO peta_wisata VALUES ('11', '44', 'Grenjengan Sewu, Jrahi, Gunung wungkal, Kabupaten Pati, Jawa Tengah', 'Air Terjun Grenjengan Sewu ini terletak di desa Jrahi, Kecamatan Gunung Wungkal, Kabupaten Pati. Cukup jauh memang jika di tempuh dari pusat kota Pati. Untuk menuju ke sana kita bisa menempuh perjalanan sekitar 1 jam dari pusat Kota Pati. Dari kota Pati, anda bisa ambil arah ke Tayu atau Jepara. Setelah itu lihat papan penunjuk arah dan ambil arah ke Gunung Wungkal dan anda teruskan ke Desa Jrahi dengan mengikuti papan penunjuk arah. Ketinggian air terjun ini sekitar 25 meter dan berada di ketinggian 485 meter di atas permukaan air laut.', '-6.59503808143451', '110.969038009644', 'Jl. Gunungwungkal-Tlogowungu, Gn. wungkal, Kabupaten Pati, Jawa Tengah 59156, Indonesia', 'Grenjenggan Sewu.jpg');
INSERT INTO peta_wisata VALUES ('12', '44', 'Air Terjun Tretes, Kali Silungonggo, Kabupaten Pati, Jawa Tengah', 'Bukan Tretes di kaki Gunumg Welirang Jatim, namun Tretes ini adalah nama sebuah air terjun yang treletak di kaki Gunung Muria, tepatnya di Desa Gunungsari, Kecamatan Tlogowungu, Kabupaten Pati.', '-6.74866816271937', '111.037917137146', 'Jl. Pangeran Diponegoro No.99, Pati Lor, Kec. Pati, Kabupaten Pati, Jawa Tengah 59111, Indonesia', 'air terjun tretes.jpg');
INSERT INTO peta_wisata VALUES ('13', '44', 'Masjid Agung Baitunnur, Pati Kidul, Kec. Pati, Kabupaten Pati, Jawa Tengah', 'Masjid Baitunnur ini terletak di sisi sebelah barat alun-alun kota Pati, atau yang lebih dikenal sebagai simpang lima. Di sebelah kiri Masjid Agung Baitunnur, tepat di sisi utara alun-alun, terdapat Kantor Bupati Pati dan Gedung DPRD Kabupaten Pati.', '-6.75687205663345', '111.035830378532', 'Jl. Supriyadi III, Pati Kidul, Kec. Pati, Kabupaten Pati, Jawa Tengah 59114, Indonesia', 'masjid baitunner.jpg');
INSERT INTO peta_wisata VALUES ('14', '44', 'Makam Syeh Jangkung, Landoh, Kayen, Pati, Kabupaten Pati, Jawa Tengah', 'Makam Saridin atau terkenal dengan nama Syeh Jangkung konon merupakan salah seorang murid Sunan Kalijaga (Wali Songo).\r\nLokasi : Makam tersebut terletak di Desa Landoh, Kecamatan Kayen. Jarak dari kota Pati kira-kira 17 Km kearah selatan  menuju Kabupaten Grobogan. Makam ini banyak dikunjungi orang setiap hari Jumat Kliwon dan Jumat Legi. Upacara khol dilaksanakan setiap 1 tahun sekali yaitu pada bulan Rajab tanggal 14-15 dalam rangka penggantian kelambu  makam.', '-6.74918490559566', '111.037935912609', 'Jl. Kiai Saleh, Pati Lor, Kec. Pati, Kabupaten Pati, Jawa Tengah 59111, Indonesia', 'makam.JPG');
INSERT INTO peta_wisata VALUES ('15', '44', 'Juwana Water Fantasy, Jl. Juwana Rembang KM 7, Bumimulyo, Batangan, Pati, Kabupaten Pati, Jawa Tenga', 'Liburan Seru di Juwana Water Fantasy di Pati Jawa Tengah, Tempat Wisata Terindah - Pada saat musim liburan merupakan waktu yang sangat ditunggu-tunggu bag kita semua, karena pada waktu liburan, kita dapat beristirahat dari segala rutinitas sekolah dan pekerjaan kita. Untuk mengisi liburan ini dapat dilakukan dengan berbagai macam aktivitas, salah satunya adalah mengunjungi berbagai macam tempat wisata terutama yang dapat dinikmati semua anggota keluarga. Bagi anda yang berada di Kabupaten Pati dan sekitarnya, anda dapat mengunjungi sebuah tempat wisata keluarga yang tergolong baru di Pati, yaitu Juwana Water Fantasy atau sering disingkat dengan JWF.', '-6.72035833514686', '111.053795814514', 'Jl. Raya Pati-Tayu, Tambaharjo, Kec. Pati, Kabupaten Pati, Jawa Tengah 59119, Indonesia', 'juwana water.jpg');
INSERT INTO peta_wisata VALUES ('16', '45', 'Swalayan ADA, Sidoharjo, Kec. Pati, Kabupaten Pati, Jawa Tengah ', 'Swalayan Ada adalah salah satu swalayan atau pusat perbelanjaan di Kota Pati. Swalayan ini belum lama dibangun, tepatnya diresmikan tanggal 7 Juli 2012.\r\n\r\nSwalayan Ada  berlokasi sangat strategis dan mudah ditemukan karena berada tepat di jalur pantura. Jika Anda berada di Simpanglima Pati, Anda cukup lurus menuju jalan arah Jalan Pemuda atau menuju arah kecamatan Juwana, kurang lebih 3 km. Kemudian Anda akan menumukan Tugu Tani dan swalayan Ada berada tepat di depan tugu tersebut.', '-6.7530897591877', '111.051735877991', 'Jl. Pemuda No.335, Kalidoro, Kec. Pati, Kabupaten Pati, Jawa Tengah 59118, Indonesia', 'swalayan ada pati.jpg');
INSERT INTO peta_wisata VALUES ('17', '45', 'Luwes Swalayan, Jalan Pati - Purwodadi, Pati Kidul, Kecamatan Pati, Kec. Pati, Kabupaten Pati, Jawa ', 'Luwes swalayan', '-6.75696794548005', '111.039445996284', 'Jalan Sukolilo - Babalan, Pati Kidul, Kec. Pati, Kabupaten Pati, Jawa Tengah 59114, Indonesia', 'pasar swalayan luwes pati.jpg');
INSERT INTO peta_wisata VALUES ('18', '45', 'Plasa Pati, Jl. Jenderal Sudirman, Pati Kidul, Kec. Pati, Kabupaten Pati, Jawa Tengah', 'Plasa Pati Tempat Belanja Kebutuhan Barang Sehari-hari ', '-6.75315768098709', '111.040716022253', 'Jl. DR. Wahidin Soediro Husodo, Kec. Pati, Kabupaten Pati, Jawa Tengah 59111, Indonesia', 'plasa pati.jpg');

-- ----------------------------
-- Table structure for `rute_wisata`
-- ----------------------------
DROP TABLE IF EXISTS `rute_wisata`;
CREATE TABLE `rute_wisata` (
  `id_rute` int(4) NOT NULL AUTO_INCREMENT,
  `lokasi_awal` varchar(350) DEFAULT NULL,
  `lokasi_tujuan` varchar(350) DEFAULT NULL,
  `lat` text,
  `lng` text,
  `alamat` text,
  `waktu` varchar(100) DEFAULT NULL,
  `km` varchar(100) DEFAULT NULL,
  `nilai` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_rute`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rute_wisata
-- ----------------------------
INSERT INTO rute_wisata VALUES ('9', 'Waduk Gunungrowo, Gembong, Kabupaten Pati, Jawa Tengah', 'Goa Pancur Jimbaran, Kayen, Kabupaten Pati, Jawa Tengah', '-6.763488342429051', '111.03933334350586', 'Jl. Ki Ageng Selo No.89, Blaru, Kec. Pati, Kabupaten Pati, Jawa Tengah 59114, Indonesia', '27', '14,5 km', '10');
INSERT INTO rute_wisata VALUES ('10', 'Waduk Gunungrowo, Gembong, Kabupaten Pati, Jawa Tengah', 'Goa Wareh, Kedumulyo, Sukolilo, Kabupaten Pati, Jawa Tengah', '-6.844623671722899', '111.00654602050781', 'Jalan Sukolilo - Babalan, Sundoluhur, Kayen, Kabupaten Pati, Jawa Tengah 59171, Indonesia', '42', '25,5 km', '20');
INSERT INTO rute_wisata VALUES ('11', 'Waduk Gunungrowo, Gembong, Kabupaten Pati, Jawa Tengah', 'Air Terjun Tadah Hujan, Sukolilo, Kabupaten Pati, Jawa Tengah', '-6.753601170148724', '111.00972175598145', 'Jl. Raya Banyu Urip, Sukoharjo, Margorejo, Kabupaten Pati, Jawa Tengah 59163, Indonesia', '28', '15,8 km', '34');
INSERT INTO rute_wisata VALUES ('12', 'Waduk Gunungrowo, Gembong, Kabupaten Pati, Jawa Tengah', 'Grenjengan Sewu, Jrahi, Gunung wungkal, Kabupaten Pati, Jawa Tengah', '-6.783602999068411', '111.05581283569336', 'Jl. Gabus Winong, Gempolsari, Gabus, Kabupaten Pati, Jawa Tengah 59173, Indonesia', '38', '20,7 km', '56');
INSERT INTO rute_wisata VALUES ('13', 'Goa Pancur Jimbaran, Kayen, Kabupaten Pati, Jawa Tengah', 'Waduk Gunungrowo, Gembong, Kabupaten Pati, Jawa Tengah', '-6.852122882357876', '111.00568771362305', 'Jalan Sukolilo - Babalan, Sundoluhur, Kayen, Kabupaten Pati, Jawa Tengah 59171, Indonesia', '19 menit', '9,6 km', '10');
INSERT INTO rute_wisata VALUES ('14', 'Goa Pancur Jimbaran, Kayen, Kabupaten Pati, Jawa Tengah', 'Goa Wareh, Kedumulyo, Sukolilo, Kabupaten Pati, Jawa Tengah', '-6.831329327029449', '111.04070663452148', 'Jl. Gabus-Tlogoayu, Sugihrejo, Gabus, Kabupaten Pati, Jawa Tengah 59173, Indonesia', '32 menit', '15,1 km', '22');
INSERT INTO rute_wisata VALUES ('15', 'Goa Pancur Jimbaran, Kayen, Kabupaten Pati, Jawa Tengah', 'Air Terjun Tadah Hujan, Sukolilo, Kabupaten Pati, Jawa Tengah', '-6.845134985283045', '111.05572700500488', 'Jl. Kayen - Tambakromo, Angkatan Lor, Tambakromo, Kabupaten Pati, Jawa Tengah 59174, Indonesia', '29 menit', '15,3 km', '22');
INSERT INTO rute_wisata VALUES ('16', 'Goa Wareh, Kedumulyo, Sukolilo, Kabupaten Pati, Jawa Tengah', 'Waduk Gunungrowo, Gembong, Kabupaten Pati, Jawa Tengah', '-6.860985433763648', '111.00105285644531', 'Jalan Sukolilo - Babalan, Boloagung, Kayen, Kabupaten Pati, Jawa Tengah 59171, Indonesia', '17 menit', '11,2 km', '23');
INSERT INTO rute_wisata VALUES ('17', 'Goa Wareh, Kedumulyo, Sukolilo, Kabupaten Pati, Jawa Tengah', 'Grenjengan Sewu, Jrahi, Gunung wungkal, Kabupaten Pati, Jawa Tengah', '-6.766897665279353', '111.11503601074219', 'Jl. Jakenan Winong, Tambahmulyo, Jakenan, Kabupaten Pati, Jawa Tengah 59182, Indonesia', '50 menit', '30,0 km', '44');
INSERT INTO rute_wisata VALUES ('18', 'Air Terjun Tadah Hujan, Sukolilo, Kabupaten Pati, Jawa Tengah', 'Waduk Gunungrowo, Gembong, Kabupaten Pati, Jawa Tengah', '-6.731439533231459', '111.05049133300781', 'Jalan Ngrandu, Mulyoharjo, Kec. Pati, Kabupaten Pati, Jawa Tengah 59118, Indonesia', null, null, '21');
INSERT INTO rute_wisata VALUES ('19', 'Air Terjun Tadah Hujan, Sukolilo, Kabupaten Pati, Jawa Tengah', 'Grenjengan Sewu, Jrahi, Gunung wungkal, Kabupaten Pati, Jawa Tengah', '-6.761783671980801', '111.12104415893555', 'Jl. Jakenan Winong, Jakenan, Kabupaten Pati, Jawa Tengah 59182, Indonesia', null, null, '21');
INSERT INTO rute_wisata VALUES ('20', 'Grenjengan Sewu, Jrahi, Gunung wungkal, Kabupaten Pati, Jawa Tengah', 'Masjid Agung Baitunnur, Pati Kidul, Kec. Pati, Kabupaten Pati, Jawa Tengah', '-6.673473553754948', '111.10628128051758', 'Jl. Juwana - Tayu, Kepoh, Wedarijaksa, Kabupaten Pati, Jawa Tengah 59152, Indonesia', null, null, '43');
INSERT INTO rute_wisata VALUES ('21', 'Grenjengan Sewu, Jrahi, Gunung wungkal, Kabupaten Pati, Jawa Tengah', 'Air Terjun Tretes, Kali Silungonggo, Kabupaten Pati, Jawa Tengah', '-6.77780733658107', '111.03538513183594', 'Jalan Sukolilo - Babalan, Langenharjo, Margorejo, Kabupaten Pati, Jawa Tengah 59116, Indonesia', null, null, '32');
INSERT INTO rute_wisata VALUES ('22', 'Masjid Agung Baitunnur, Pati Kidul, Kec. Pati, Kabupaten Pati, Jawa Tengah', 'Waduk Gunungrowo, Gembong, Kabupaten Pati, Jawa Tengah', '-6.623685526922454', '111.05478286743164', 'Jl. Raya Pati-Tayu, Sidomukti, Margoyoso, Kabupaten Pati, Jawa Tengah 59154, Indonesia', null, null, '29');
