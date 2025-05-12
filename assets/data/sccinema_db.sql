-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2025 at 06:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sccinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `cinemas`
--

CREATE TABLE `cinemas` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `cinemas`
--

INSERT INTO `cinemas` (`id`, `name`, `address`, `status`) VALUES
(1, 'Rạp Gò Vấp', '123 Lê Đức Thọ, Gò Vấp, TP.HCM', 1),
(2, 'Rạp Bình Thạnh', '456 Phan Văn Trị, Bình Thạnh, TP.HCM', 1),
(3, 'Rạp Quận 1', '789 Nguyễn Trãi, Quận 1, TP.HCM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `email`, `created_at`) VALUES
(1, 'Nguyễn Văn A', '0123456789', 'nguyenvana@example.com', '2025-05-03 08:04:41'),
(2, 'Trần Thị B', '0987654321', 'tranthib@example.com', '2025-05-03 08:04:41'),
(3, 'Lê Minh C', '0934567890', 'leminhc@example.com', '2025-05-03 08:04:41'),
(4, 'Phan Thi D', '0912345678', 'phanthid@example.com', '2025-05-03 08:04:41'),
(5, 'Vũ Thị E', '0901234567', 'vuthie@example.com', '2025-05-03 08:04:41');

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `type` enum('food','drink','combo') NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `available` tinyint(1) DEFAULT 1,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `name`, `price`, `type`, `description`, `image_url`, `available`, `status`) VALUES
(1, 'Bắp rang bơ nhỏ', 35000.00, 'food', 'Bắp rang bơ giòn thơm, cỡ nhỏ', 'assets/img/foods/popcorn.png', 1, 1),
(2, 'Bắp rang bơ lớn', 50000.00, 'food', 'Bắp rang bơ cỡ lớn dành cho 2 người', 'assets/img/foods/popcorn.png', 1, 1),
(3, 'Pepsi 500ml', 25000.00, 'drink', 'Nước ngọt Pepsi lạnh 500ml', 'assets/img/foods/pepsi.png', 1, 1),
(4, 'Sprite 500ml', 25000.00, 'drink', 'Nước ngọt Sprite mát lạnh 500ml', 'assets/img/foods/sprite.png', 1, 1),
(5, 'Combo 1 (Bắp nhỏ + Pepsi)', 55000.00, 'combo', 'Combo tiết kiệm: bắp nhỏ + Pepsi 500ml', 'asses/img/foods/combo1.png', 1, 1),
(6, 'Combo 2 (Bắp lớn + 2 nước)', 90000.00, 'combo', 'Combo cho 2 người: bắp lớn + 2 nước ngọt', 'asstes/img/foods/combo2.png', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `release_date` date DEFAULT NULL,
  `genres` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `director` text DEFAULT NULL,
  `actors` text DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `poster_url` text DEFAULT NULL,
  `thumbnail_url` text DEFAULT NULL,
  `trailer_url` text DEFAULT NULL,
  `vote_average` float DEFAULT 0,
  `age_rating` varchar(5) DEFAULT 'P',
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `release_date`, `genres`, `country`, `director`, `actors`, `duration`, `summary`, `poster_url`, `thumbnail_url`, `trailer_url`, `vote_average`, `age_rating`, `status`) VALUES
(1, 'Địa Đạo: Mặt Trời Trong Bóng Tối', '2025-04-04', 'Lịch sử, chiến tranh', 'Việt Nam', 'Bùi Thạc Chuyên', 'Thái Hoà, Quang Tuấn, Hồ Thu Anh', '120 phút', 'Bộ phim tái hiện cuộc chiến khốc liệt trong hệ thống địa đạo, thể hiện tinh thần chiến đấu và hy sinh của những người lính Việt Nam.', 'https://cdn.moveek.com/storage/media/cache/tall/67c85e3ee0d6e851549391.jpg', 'https://cdn.moveek.com/storage/media/cache/full/67c85e23092b4126914633.jpg', 'https://youtu.be/0Max1fYvNP4', 8.7, 'T16', 1),
(2, 'Tìm Xác: Ma Không Đầu', '2025-04-18', 'Hài, kinh dị', 'Việt Nam', 'Bùi Văn Hải', 'Tiến Luật, Ngô Kiến Huy, Hồng Vân, Đại Nghĩa', '119 phút', 'Một câu chuyện ly kỳ về hành trình tìm kiếm sự thật đằng sau những hiện tượng siêu nhiên.', 'https://cdn.moveek.com/storage/media/cache/tall/67f5e36bd1708530283842.jpg', 'https://cdn.moveek.com/storage/media/cache/full/67f5e39a7bf8d887123375.jpg', 'https://youtu.be/CBeWt_Mz_FE', 7.9, 'T18', 1),
(3, 'Mật Vụ Phụ Hồ', '2025-04-04', 'Hành động, phiêu lưu, kinh dị', 'Anh', 'David Ayer', 'Jason Statham, David Harbour, Michael Pena, Jason Flemyng, Arianna Rivas', '116 phút', 'Một công nhân xây dựng vô tình bị cuốn vào một âm mưu nguy hiểm và phải trở thành mật vụ bất đắc dĩ.', 'https://cdn.moveek.com/storage/media/cache/tall/67cef39b1ae36265380360.jpg', 'https://cdn.moveek.com/storage/media/cache/full/67cef38c8720f027877409.jpg', 'https://youtu.be/MjoOf3lQKYc', 8.3, 'T18', 1),
(4, 'Cưới Ma Giải Hạn', '2025-04-11', 'Hài, tâm linh', 'Đài Loan', 'Chayanop Bunprakob', 'Putthipong Assaratanakul, Krit Amnuaydechkorn, Goy Arachaporn Pokinpakorn, Piyamas Monayakul, Jaturong Mokjok', '128 phút', 'Câu chuyện hài hước về một đám cưới kỳ lạ nhằm giải hạn cho một gia đình gặp nhiều xui xẻo.', 'https://cdn.moveek.com/storage/media/cache/tall/67dd1ba0d2894105841288.jpg', 'https://cdn.moveek.com/storage/media/cache/full/67c684d7d6c0e256053614.jpg', 'https://youtu.be/INCHfJtLmbU', 8.6, 'T18', 1),
(5, 'Panor: Tà Thuật Huyết Ngải', '2025-04-11', 'Kinh dị, tâm linh', 'Thái Lan', 'Puttipong Saisrikaew', 'Cherprang Areekul, Jackrin Kungwankiatichai, Chalita Suansane, Rattanawadee Wongtong, Pijika Jittaputta', '117 phút', 'Một hành trình khám phá những bí ẩn liên quan đến tà thuật và huyết ngải trong văn hóa dân gian.', 'https://cdn.moveek.com/storage/media/cache/tall/67c6c450ab223709422078.jpg', 'https://cdn.moveek.com/storage/media/cache/full/67c6c3fb24043990469463.jpg', 'https://youtu.be/UFCmoJ2B4Fk', 8, 'T18', 1),
(6, 'Một Bộ Phim Minecraft', '2025-04-04', 'Phiêu lưu, hành động', 'Mỹ', 'Peter Sollett', NULL, '101 phút', 'Cuộc phiêu lưu kỳ thú trong thế giới Minecraft, nơi các nhân vật phải đối mặt với những thử thách để cứu lấy thế giới.', 'https://cdn.moveek.com/storage/media/cache/tall/67c12e7b2fce8194595515.jpg', 'https://cdn.moveek.com/storage/media/cache/full/67c12f008b3af927307337.png', 'https://youtu.be/RYbTX2o441Q', 9.3, 'K', 1),
(7, 'Pororo: Thám Hiểm Đại Dương Xanh', '2025-04-04', 'Hoạt hình, phiêu lưu, gia đình, viễn tưởng', 'Hàn Quốc', 'Yun Jae-wan', 'Lee Sun, Lee Mi-ja, Ham Su-jung, Hong So-young, Jung Mi-sook', '71 phút', 'Pororo và các bạn cùng nhau khám phá đại dương, đối mặt với những sinh vật biển kỳ lạ và học hỏi nhiều điều mới mẻ.', 'https://cdn.moveek.com/storage/media/cache/tall/67e54aa3933d6340437521.jpg', NULL, 'https://youtu.be/PIVQG-2BWHo', 9, 'P', 1),
(8, 'Oshi no Ko: Màn Trình Diễn Cuối Cùng', '2025-04-18', 'Chính kịch, viễn tưởng, âm nhạc', 'Nhật Bản', 'Smith, Hana Matsumoto', 'Nagisa Saito, Kaito Sakurai, Asuka Saito, Nanoka Hara, Mizuki Kayashima', '129 phút', 'Bộ phim hoạt hình Nhật Bản kể về hành trình cuối cùng của một ngôi sao nhạc pop và những bí mật đằng sau ánh hào quang.', 'https://cdn.moveek.com/storage/media/cache/tall/67e286abd502c612012985.jpg', 'https://cdn.moveek.com/storage/media/cache/full/67e2866aef78d798492441.jpg', 'https://youtu.be/rNjmXuIXfJs', 7, 'T18', 0),
(9, 'Mẹ Quỷ Con Ma', '2025-04-18', 'Kinh dị', 'Indonesia', 'Bambang Drias', 'Abun Sungkar, Gisellma Firmansyah, Iwa K, Nita Gunawan, Wavi Zihan', '97 phút', 'Một bộ phim kinh dị Việt pha yếu tố tâm linh và ám ảnh.', 'https://cdn.moveek.com/storage/media/cache/tall/67f5e4c8786dc157361018.jpg', 'https://cdn.moveek.com/storage/media/cache/full/67e8fdb4739c5884896530.jpg', 'https://youtu.be/micO8hIrzrI', 7.3, 'T18', 1),
(10, 'Đầu Xuôi Đuôi Đút Lót', '2025-04-18', 'Hài, chính kịch', 'Hàn Quốc', 'Ha Jung-Woo\n\n', 'Ha Jung-Woo, Kim Eui-sung, Kang Hae-lim, Lee Dong-Hwi, Park Byung-eun', '106 phút', 'Hài kịch xã hội phản ánh những tình huống trớ trêu trong công việc.', 'https://cdn.moveek.com/storage/media/cache/tall/67f8a39858da8895202511.jpg', 'https://cdn.moveek.com/storage/media/cache/full/67e8fd1651f5f875754716.jpg', 'https://youtu.be/jq3mphCGCS0', 6.8, 'T16', 1),
(11, 'Kappa Ác Linh Dưới Đáy Hồ', '2025-04-18', 'Kinh dị', 'Nhật Bản', 'Pablo Absento', 'Ben McKenzie, Bojana Novakovic, Sawyer Jones, Malcolm Fuller, Kane Kosugi', '87 phút', 'Truyền thuyết về sinh vật Kappa hồi sinh trong một ngôi làng ven hồ.', 'https://cdn.moveek.com/storage/media/cache/tall/67f5ebe4197de175055157.jpg', 'https://cdn.moveek.com/storage/media/cache/full/67ebe8704396b243002414.jpg', 'https://youtu.be/xL7dUWhUxK4', 7, 'T16', 1),
(12, 'Nàng Dâu Của Quỷ', '2025-04-18', 'Kinh dị', 'Indonesia', 'Azhar Kinoi Lubis', 'Erika Carlina, Emir Mahira, Wavi Zihan, Ruth Marini, Alfie Alfandy', '91 phút', 'Một cô gái trẻ phát hiện chồng mình có mối liên hệ với tà linh cổ đại.', 'https://example.com/poster_nangdau.jpg', 'https://cdn.moveek.com/storage/media/cache/full/67f9cd4de6f9a185808101.jpg', 'https://youtu.be/NrLAfkG7Xw4', 7.5, 'T18', 1),
(13, 'Tay Nghiệp Dư', '2025-04-11', 'Kinh dị', 'Mỹ', 'James Hawes', 'Rami Malek, Rachel Brosnahan, Caitriona Balfe, Laurence Fishburne, Holt McCallany', '122 phút', 'Một người bình thường bất ngờ trở thành tội phạm chuyên nghiệp.', 'https://cdn.moveek.com/storage/media/cache/tall/67e0f2491a320352196075.jpg', 'https://cdn.moveek.com/storage/media/cache/full/67e0f28135e1e811889935.png', 'https://youtu.be/byxI2UFRN2Y', 7.2, 'T16', 1),
(14, 'Peg O\' My Heart: Ký Ức Máu', '2025-05-09', 'Kinh dị', 'HongKong', 'Nick Cheung', 'Nick Cheung, Fala Chen, Terrance Lau, Rebecca Zhu, Ben Yuen', '98 phút', NULL, 'https://cdn.moveek.com/storage/media/cache/tall/680b381310144468448696.jpg', 'https://cdn.moveek.com/storage/media/cache/full/680b37c5543da744627724.jpg', 'https://youtu.be/3K6IZaxCMpo', 0, 'T16', 2),
(15, 'Demon Hunters: Đêm Thánh Đội Săn Quỷ', '2025-05-09', 'Hành động, Giả tưởng, Kinh dị', 'Hàn Quốc', 'Lim Dae-hee', 'Ma Dong-seok, Seohyun, Lee Da-wit, Kyung Soo-Jin, Jung Ji-so', '91 phút', 'Tổ đội săn lùng và tiêu diệt các thế lực tôn thờ quỷ dữ với những sức mạnh siêu nhiên khác nhau gồm “tay đấm” Ma Dong-seok, Seohuyn (SNSD) và David Lee hứa hẹn mở ra cuộc chiến săn quỷ khốc liệt nhất dịp lễ 30/4 này!', 'https://cdn.moveek.com/storage/media/cache/tall/6811039caeca9445686846.jpg', 'https://cdn.moveek.com/storage/media/cache/full/67bc723fa1dff709342493.jpg', 'https://youtu.be/gQ2DxpmeMUo', 0, 'T16', 2),
(16, 'Until Dawn: Bí Mật Kinh Hoàng', '2025-05-09', 'Kinh dị', 'Mỹ', 'David F. Sandberg', 'Ella Rubin, Michael Cimino, Odessa A\'zion, Ji-young Yoo, Belmont Cameli', '103 phút', 'Until Dawn/ Until Dawn: Bí Mật Kinh Hoàng diễn ra sau khi em gái Melanie mất tích một cách bí ẩn, Clover cùng bạn bè quyết định vào một thung lũng nơi cuối cùng nhìn thấy em gái để tìm kiếm câu trả lời. Khi lạc vào một khu nhà bỏ hoang, họ bị một kẻ giết người đeo mặt nạ theo dõi và bị sát hại một cách kinh hoàng từng người một... cho đến khi họ tỉnh dậy và phát hiện mình quay ngược lại vào buổi tối đầu tiên. Bị mắc kẹt trong một vòng lặp thời gian bí ẩn, họ buộc phải sống lại cơn ác mộng đó mỗi đêm, nhưng mỗi lần lại phải đối mặt với những mối đe dọa mới và những cách chết khác nhau, ngày càng đáng sợ hơn. Khi hy vọng dần tắt, nhóm bạn nhận ra họ chỉ còn 13 mạng sống trước khi biến mất mãi mãi. Cách duy nhất để thoát khỏi là sống sót cho đến khi bình minh.', 'https://cdn.moveek.com/storage/media/cache/tall/6804fe7f48c36679897990.jpg', 'https://cdn.moveek.com/storage/media/cache/full/678a30f3ef6f9599250088.jpg', 'https://youtu.be/L2r9X--a3oQ', 0, 'T18', 2);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `seat_rows` int(11) NOT NULL,
  `seat_columns` int(11) NOT NULL,
  `total_seats` int(11) NOT NULL,
  `screen_type` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `cinema_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `seat_rows`, `seat_columns`, `total_seats`, `screen_type`, `status`, `cinema_id`) VALUES
(1, 'Phòng 1', 10, 12, 120, '2D', 1, 1),
(2, 'Phòng 2', 8, 10, 80, '3D', 1, 3),
(3, 'Phòng 3', 8, 9, 72, '2D', 1, 2),
(4, 'Phòng 4', 9, 9, 81, '3D', 1, 2),
(5, 'Phòng VIP', 6, 8, 48, 'IMAX', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `showtimes`
--

CREATE TABLE `showtimes` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `show_date` date NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `showtimes`
--

INSERT INTO `showtimes` (`id`, `movie_id`, `room_id`, `show_date`, `start_time`, `end_time`, `price`, `status`) VALUES
(1, 1, 2, '2025-05-04', '12:00:00', NULL, 45000.00, 1),
(2, 2, 1, '2025-05-04', '20:30:00', '22:15:00', 45000.00, 1),
(3, 3, 3, '2025-05-04', '17:00:00', '19:00:00', 45000.00, 1),
(4, 1, 1, '2025-05-04', '14:30:00', NULL, 45000.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `gender` enum('Nam','Nữ','Khác') NOT NULL,
  `birth_date` date DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `position` varchar(50) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`id`, `full_name`, `gender`, `birth_date`, `phone`, `email`, `password`, `position`, `salary`, `hire_date`, `status`) VALUES
(1, 'Nguyễn Văn A', 'Nam', '1995-06-12', '0912345678', 'vana@sccinema.vn', 'e10adc3949ba59abbe56e057f20f883e', 'Quản lý', 15000000.00, '2024-12-16', 1),
(2, 'Trần Thị B', 'Nữ', '1998-11-22', '0987654321', 'thib@sccinema.vn', 'e10adc3949ba59abbe56e057f20f883e', 'Thu ngân', 9000000.00, '2024-12-17', 1),
(3, 'Lê Minh C', 'Nam', '2000-01-05', '0933888999', 'minhc@sccinema.vn', 'e10adc3949ba59abbe56e057f20f883e', 'Nhân viên bắp nước', 7000000.00, '2024-12-20', 1),
(4, 'Phan Văn D', 'Nam', '2001-02-26', '0933628968', 'vand@sccinema.vn', 'e10adc3949ba59abbe56e057f20f883e', 'Nhân viên soát vé', 7000000.00, '2024-12-20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `showtime_id` int(11) NOT NULL,
  `seat_code` varchar(10) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `food_id` int(11) NOT NULL,
  `status` enum('Đã đặt','Đã thanh toán','Đã huỷ') DEFAULT 'Đã đặt',
  `purchase_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `showtime_id`, `seat_code`, `staff_id`, `food_id`, `status`, `purchase_time`) VALUES
(1, 1, 'A5', 2, 1, 'Đã đặt', '2025-05-03 08:06:01'),
(2, 2, 'A6', 2, 2, 'Đã đặt', '2025-05-03 08:06:01'),
(3, 3, 'B3', 2, 4, 'Đã đặt', '2025-05-03 08:06:01'),
(4, 1, 'A7', 2, 3, 'Đã đặt', '2025-05-03 08:06:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cinemas`
--
ALTER TABLE `cinemas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `showtime_id` (`showtime_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cinemas`
--
ALTER TABLE `cinemas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `showtimes`
--
ALTER TABLE `showtimes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`cinema_id`) REFERENCES `cinemas` (`id`);

--
-- Constraints for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD CONSTRAINT `showtimes_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`),
  ADD CONSTRAINT `showtimes_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`showtime_id`) REFERENCES `showtimes` (`id`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staffs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
