-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2024 at 04:41 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ql_nongsan_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `MaHang` int(11) NOT NULL,
  `MaHD` int(11) NOT NULL,
  `SoLuong` int(11) DEFAULT 1,
  `ThanhTien` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`MaHang`, `MaHD`, `SoLuong`, `ThanhTien`) VALUES
(1, 1, 2, 30000);

--
-- Triggers `chitiethoadon`
--
DELIMITER $$
CREATE TRIGGER `update_thanhtien` BEFORE INSERT ON `chitiethoadon` FOR EACH ROW BEGIN
    -- Tính toán giá trị mới của ThanhTien
   SET NEW.ThanhTien  = NEW.SoLuong * (SELECT GiaBan FROM hanghoa WHERE MaHang = NEW.MaHang);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_tongtien` AFTER INSERT ON `chitiethoadon` FOR EACH ROW BEGIN
    UPDATE hoadon
    SET TongTien = (
        SELECT SUM(ThanhTien)
        FROM chitiethoadon
        WHERE MaHD = NEW.MaHD
    )
    WHERE MaHD = NEW.MaHD;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `diachi`
--

CREATE TABLE `diachi` (
  `MaDiaChi` int(11) NOT NULL,
  `MaKH` int(11) NOT NULL,
  `MaLoai` int(11) NOT NULL,
  `SoNha` varchar(50) DEFAULT 'Chưa xác định',
  `PhuongXa` varchar(50) DEFAULT 'Chưa xác định',
  `QuanHuyen` varchar(50) DEFAULT 'Chưa xác định',
  `TinhThanhPho` varchar(50) DEFAULT 'Chưa xác định'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `diachi`
--

INSERT INTO `diachi` (`MaDiaChi`, `MaKH`, `MaLoai`, `SoNha`, `PhuongXa`, `QuanHuyen`, `TinhThanhPho`) VALUES
(1, 1, 1, 'c3/33 Vườn Thơm', 'Xã Bình Lợi', 'Huyện Bình Chánh', 'Thành Phố Hồ Chí Minh'),
(2, 1, 2, '178E Thành Thái', 'Phường 6', 'Quận 10', 'Thành Phố Hồ Chí Minh');

-- --------------------------------------------------------

--
-- Table structure for table `donvitinh`
--

CREATE TABLE `donvitinh` (
  `MaDVT` int(11) NOT NULL,
  `TenDVT` varchar(20) DEFAULT 'Túi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `donvitinh`
--

INSERT INTO `donvitinh` (`MaDVT`, `TenDVT`) VALUES
(1, 'Túi'),
(2, 'Trái'),
(3, 'Bó'),
(4, 'Hộp');

-- --------------------------------------------------------

--
-- Table structure for table `donvitrongluong`
--

CREATE TABLE `donvitrongluong` (
  `MaDVTrongLuong` int(11) NOT NULL,
  `TenDVTrongLuong` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `donvitrongluong`
--

INSERT INTO `donvitrongluong` (`MaDVTrongLuong`, `TenDVTrongLuong`) VALUES
(1, 'Kg'),
(2, 'g');

-- --------------------------------------------------------

--
-- Table structure for table `hanghoa`
--

CREATE TABLE `hanghoa` (
  `MaHang` int(11) NOT NULL,
  `MaNhomHang` int(11) NOT NULL,
  `MaDVT` int(11) NOT NULL,
  `MaDVTrongLuong` int(11) NOT NULL,
  `TenHang` varchar(50) NOT NULL,
  `TrongLuong` float DEFAULT 0,
  `GiaBan` float NOT NULL,
  `HeSo` float DEFAULT 1.2,
  `GiaNhap` float NOT NULL,
  `SoLuongTon` int(11) DEFAULT 0,
  `TrangThai` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hanghoa`
--

INSERT INTO `hanghoa` (`MaHang`, `MaNhomHang`, `MaDVT`, `MaDVTrongLuong`, `TenHang`, `TrongLuong`, `GiaBan`, `HeSo`, `GiaNhap`, `SoLuongTon`, `TrangThai`) VALUES
(1, 4, 1, 2, 'Chuối già Nam Mỹ', 500, 15000, 1.2, 12500, 20, b'1'),
(2, 4, 2, 1, 'Dưa hấu đỏ', 2, 31200, 1.2, 26000, 15, b'1'),
(3, 4, 2, 1, 'Dưa lưới', 1.3, 60000, 1.2, 50000, 27, b'1'),
(4, 4, 1, 1, 'Cam sành', 2, 30000, 1.2, 25000, 23, b'1'),
(5, 4, 1, 2, 'Ổi Trân Châu', 500, 9000, 1.2, 7500, 6, b'1'),
(6, 4, 1, 1, 'Bơ Sáp', 1, 20400, 1.2, 17000, 10, b'1'),
(7, 1, 3, 2, 'Cải bẹ xanh', 400, 9000, 1.2, 7500, 9, b'1'),
(8, 1, 3, 2, 'Cải ngọt', 400, 9600, 1.2, 8000, 16, b'1'),
(9, 1, 3, 2, 'Cải thìa', 500, 12000, 1.2, 10000, 11, b'1'),
(10, 1, 3, 2, 'Cải bẹ dún', 400, 12000, 1.2, 10000, 9, b'1'),
(11, 1, 3, 2, 'Rau dền', 400, 9600, 1.2, 8000, 27, b'1'),
(12, 1, 3, 2, 'Rau lang', 400, 9000, 1.2, 7500, 14, b'1'),
(13, 2, 3, 1, 'Khoai lang Nhật', 1, 9000, 1.2, 7500, 7, b'1'),
(14, 2, 3, 2, 'Bí đỏ hồ lô', 500, 9000, 1.2, 7500, 12, b'1'),
(15, 2, 3, 2, 'Bí xanh', 500, 14400, 1.2, 12000, 5, b'1'),
(16, 2, 3, 2, 'Cà rốt', 500, 9000, 1.2, 7500, 9, b'1'),
(17, 2, 3, 2, 'Khoai tây', 500, 15600, 1.2, 13000, 15, b'1'),
(18, 2, 3, 2, 'Củ cải trắng', 500, 9000, 1.2, 7500, 10, b'1'),
(19, 3, 4, 2, 'Nấm bào ngư trắng', 300, 18000, 1.2, 15000, 5, b'1'),
(20, 3, 4, 2, 'Nấm đùi gà', 200, 36000, 1.2, 30000, 5, b'1'),
(21, 3, 4, 2, 'Nấm rơm', 150, 36000, 1.2, 30000, 10, b'1');

--
-- Triggers `hanghoa`
--
DELIMITER $$
CREATE TRIGGER `insert_giaban` BEFORE INSERT ON `hanghoa` FOR EACH ROW BEGIN
    SET NEW.GiaBan = NEW.GiaNhap * NEW.HeSo;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_giaban` BEFORE UPDATE ON `hanghoa` FOR EACH ROW BEGIN
    -- Kiểm tra xem giá nhập hoặc hệ số có thay đổi không
    IF OLD.GiaNhap != NEW.GiaNhap OR OLD.HeSo != NEW.HeSo THEN
        -- Tính lại giá bán và cập nhật vào cột GiaBan
        SET NEW.GiaBan = NEW.GiaNhap * NEW.HeSo;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `hinhanh`
--

CREATE TABLE `hinhanh` (
  `MaHinhAnh` int(11) NOT NULL,
  `MaHang` int(11) NOT NULL,
  `DuongDan` varchar(50) DEFAULT 'Chưa xác định'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hinhanh`
--

INSERT INTO `hinhanh` (`MaHinhAnh`, `MaHang`, `DuongDan`) VALUES
(1, 1, 'traiCay/chuoiGia/chuoiGia-1.jpg'),
(2, 1, 'traiCay/chuoiGia/chuoiGia-2.jpg'),
(3, 1, 'traiCay/chuoiGia/chuoiGia-3.jpg'),
(4, 2, 'traiCay/duaHauDo/duaHauDo-1.jpg'),
(5, 2, 'traiCay/duaHauDo/duaHauDo-2.jpg'),
(6, 2, 'traiCay/duaHauDo/duaHauDo-3.jpg'),
(7, 2, 'traiCay/duaHauDo/duaHauDo-4.jpg'),
(8, 3, 'traiCay/duaLuoi/duaLuoi-1.jpg'),
(9, 3, 'traiCay/duaLuoi/duaLuoi-2.jpg'),
(10, 4, 'traiCay/camSanh/camSanh-1.jpg'),
(11, 4, 'traiCay/camSanh/camSanh-2.jpg'),
(12, 4, 'traiCay/camSanh/camSanh-3.jpg'),
(13, 4, 'traiCay/camSanh/camSanh-4.jpg'),
(14, 5, 'traiCay/oiTranChau/oiTranChau-1.jpg'),
(15, 5, 'traiCay/oiTranChau/oiTranChau-2.jpg'),
(16, 5, 'traiCay/oiTranChau/oiTranChau-3.jpg'),
(17, 6, 'traiCay/boSap/boSap-1.jpg'),
(18, 6, 'traiCay/boSap/boSap-2.jpg'),
(19, 7, 'rau/caiBeXanh/caiBeXanh-1.jpg'),
(20, 7, 'rau/caiBeXanh/caiBeXanh-2.jpg'),
(21, 8, 'rau/caiNgot/caiNgot-1.jpg'),
(22, 8, 'rau/caiNgot/caiNgot-2.jpg'),
(23, 9, 'rau/caiThia/caiThia-1.jpg'),
(24, 9, 'rau/caiThia/caiThia-2.jpg'),
(25, 9, 'rau/caiThia/caiThia-3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `MaHD` int(11) NOT NULL,
  `MaNV` int(11) DEFAULT NULL,
  `MaKH` int(11) DEFAULT NULL,
  `NgayTao` datetime DEFAULT current_timestamp(),
  `NgayGiao` datetime NOT NULL DEFAULT (current_timestamp() + interval 1 day),
  `TongTien` float DEFAULT 0,
  `TrangThai` varchar(50) DEFAULT 'Đang xử lý'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`MaHD`, `MaNV`, `MaKH`, `NgayTao`, `NgayGiao`, `TongTien`, `TrangThai`) VALUES
(1, 1, 1, '2024-04-04 15:19:11', '2024-04-13 00:00:00', 58800, 'Đã giao hàng');

--
-- Triggers `hoadon`
--
DELIMITER $$
CREATE TRIGGER `UpdateHangHoaQuantityTrigger` AFTER UPDATE ON `hoadon` FOR EACH ROW BEGIN
    IF NEW.TrangThai = 'Đang giao hàng' THEN
        UPDATE hanghoa
        INNER JOIN chitiethoadon ON hanghoa.MaHang = chitiethoadon.MaHang
        SET hanghoa.SoLuongTon = hanghoa.SoLuongTon - chitiethoadon.SoLuong
        WHERE chitiethoadon.MaHD = NEW.MaHD;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `MaKH` int(11) NOT NULL,
  `TenKH` varchar(50) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `SDT` varchar(30) DEFAULT 'Chưa xác định',
  `TrangThai` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`MaKH`, `TenKH`, `Username`, `Password`, `Email`, `SDT`, `TrangThai`) VALUES
(1, 'Nguyễn Từ Thành Đạt', 'Dat123', 'Dat123456789*', 'nguyentuthanhdat0801@gmail.com', '0839123478', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `loaidiachi`
--

CREATE TABLE `loaidiachi` (
  `MaLoai` int(11) NOT NULL,
  `TenLoai` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `loaidiachi`
--

INSERT INTO `loaidiachi` (`MaLoai`, `TenLoai`) VALUES
(1, 'Nhà riêng'),
(2, 'Văn phòng');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MaNV` int(11) NOT NULL,
  `TenNV` varchar(50) NOT NULL,
  `SDT` varchar(30) DEFAULT 'Chưa xác định',
  `UserName` varchar(30) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `ChucVu` varchar(50) DEFAULT 'Nhân viên',
  `DiaChi` varchar(200) DEFAULT 'Chưa xác định',
  `TrangThai` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`MaNV`, `TenNV`, `SDT`, `UserName`, `Password`, `ChucVu`, `DiaChi`, `TrangThai`) VALUES
(1, 'Nguyễn Văn Bình', '0897785658', 'admin', '$2y$10$iCLyq2668.sViPkXsmOlZ.BTyxhSGgP90nEhwNi4zBAc0B1Jb4irG', 'Quản lý', '243 Lạc Long Quân, Phường 5, Quận 11, Hồ Chí Minh', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `nhomhang`
--

CREATE TABLE `nhomhang` (
  `MaNhomHang` int(11) NOT NULL,
  `TenNhomHang` varchar(50) NOT NULL,
  `TrangThai` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nhomhang`
--

INSERT INTO `nhomhang` (`MaNhomHang`, `TenNhomHang`, `TrangThai`) VALUES
(1, 'Rau', b'1'),
(2, 'Củ', b'1'),
(3, 'Nấm', b'1'),
(4, 'Trái cây', b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`MaHang`,`MaHD`),
  ADD KEY `FK_chitiethoadon_HoaDon` (`MaHD`);

--
-- Indexes for table `diachi`
--
ALTER TABLE `diachi`
  ADD PRIMARY KEY (`MaDiaChi`),
  ADD KEY `FK_DiaChi_KhachHang` (`MaKH`),
  ADD KEY `FK_DiaChi_LoaiDiaChi` (`MaLoai`);

--
-- Indexes for table `donvitinh`
--
ALTER TABLE `donvitinh`
  ADD PRIMARY KEY (`MaDVT`);

--
-- Indexes for table `donvitrongluong`
--
ALTER TABLE `donvitrongluong`
  ADD PRIMARY KEY (`MaDVTrongLuong`);

--
-- Indexes for table `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD PRIMARY KEY (`MaHang`),
  ADD UNIQUE KEY `TenHang` (`TenHang`),
  ADD KEY `FK_HangHoa_NhomHang` (`MaNhomHang`),
  ADD KEY `FK_HangHoa_DonViTinh` (`MaDVT`),
  ADD KEY `FK_HangHoa_DonViTrongLuong` (`MaDVTrongLuong`);

--
-- Indexes for table `hinhanh`
--
ALTER TABLE `hinhanh`
  ADD PRIMARY KEY (`MaHinhAnh`),
  ADD KEY `FK_HinhAnh_HangHoa` (`MaHang`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`MaHD`),
  ADD KEY `FK_HoaDon_NhanVien` (`MaNV`),
  ADD KEY `FK_HoaDon_KhachHang` (`MaKH`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MaKH`);

--
-- Indexes for table `loaidiachi`
--
ALTER TABLE `loaidiachi`
  ADD PRIMARY KEY (`MaLoai`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MaNV`),
  ADD UNIQUE KEY `UserName` (`UserName`);

--
-- Indexes for table `nhomhang`
--
ALTER TABLE `nhomhang`
  ADD PRIMARY KEY (`MaNhomHang`),
  ADD UNIQUE KEY `TenNhomHang` (`TenNhomHang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diachi`
--
ALTER TABLE `diachi`
  MODIFY `MaDiaChi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `donvitinh`
--
ALTER TABLE `donvitinh`
  MODIFY `MaDVT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `donvitrongluong`
--
ALTER TABLE `donvitrongluong`
  MODIFY `MaDVTrongLuong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hanghoa`
--
ALTER TABLE `hanghoa`
  MODIFY `MaHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `hinhanh`
--
ALTER TABLE `hinhanh`
  MODIFY `MaHinhAnh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `MaHD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MaKH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loaidiachi`
--
ALTER TABLE `loaidiachi`
  MODIFY `MaLoai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `MaNV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nhomhang`
--
ALTER TABLE `nhomhang`
  MODIFY `MaNhomHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD CONSTRAINT `FK_chitiethoadon_HoaDon` FOREIGN KEY (`MaHD`) REFERENCES `hoadon` (`MaHD`),
  ADD CONSTRAINT `FK_chitiethoadon_mahang` FOREIGN KEY (`MaHang`) REFERENCES `hanghoa` (`MaHang`);

--
-- Constraints for table `diachi`
--
ALTER TABLE `diachi`
  ADD CONSTRAINT `FK_DiaChi_KhachHang` FOREIGN KEY (`MaKH`) REFERENCES `khachhang` (`MaKH`),
  ADD CONSTRAINT `FK_DiaChi_LoaiDiaChi` FOREIGN KEY (`MaLoai`) REFERENCES `loaidiachi` (`MaLoai`);

--
-- Constraints for table `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD CONSTRAINT `FK_HangHoa_DonViTinh` FOREIGN KEY (`MaDVT`) REFERENCES `donvitinh` (`MaDVT`),
  ADD CONSTRAINT `FK_HangHoa_DonViTrongLuong` FOREIGN KEY (`MaDVTrongLuong`) REFERENCES `donvitrongluong` (`MaDVTrongLuong`),
  ADD CONSTRAINT `FK_HangHoa_NhomHang` FOREIGN KEY (`MaNhomHang`) REFERENCES `nhomhang` (`MaNhomHang`);

--
-- Constraints for table `hinhanh`
--
ALTER TABLE `hinhanh`
  ADD CONSTRAINT `FK_HinhAnh_HangHoa` FOREIGN KEY (`MaHang`) REFERENCES `hanghoa` (`MaHang`);

--
-- Constraints for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `FK_hoadon_KhachHang` FOREIGN KEY (`MaKH`) REFERENCES `khachhang` (`MaKH`),
  ADD CONSTRAINT `FK_hoadon_NhanVien` FOREIGN KEY (`MaNV`) REFERENCES `nhanvien` (`MaNV`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
