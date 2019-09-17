-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2017 at 01:32 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bo_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `c_id` int(11) NOT NULL,
  `c_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Category Table';

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`c_id`, `c_name`) VALUES
(3, 'Smart Phone'),
(4, 'Computers'),
(5, 'Cars'),
(6, 'Books'),
(8, 'Electoronics'),
(12, 'Music'),
(13, 'Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `p_id` int(11) NOT NULL,
  `p_title` text NOT NULL,
  `p_post` longtext NOT NULL,
  `p_category` text NOT NULL,
  `p_image` text NOT NULL,
  `p_author` text NOT NULL,
  `p_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`p_id`, `p_title`, `p_post`, `p_category`, `p_image`, `p_author`, `p_date`) VALUES
(34, 'Hundai  car  ', 'car 2017', 'Cars', 'images/post/p_post592787cf2dcfd.jpg', '16', '2017-05-26'),
(35, 'Mysql Book', 'mysqli and mysql book', 'Books', 'images/post/p_post593dd6073c5d9.png', '16', '2017-05-26'),
(36, 'Nikon Camera', 'Capture the scenery around you in its true colors with the D7000 DSLR camera from Nikon. The 16.2MP CMOS sensor on this black camera helps you shoot brilliant images that will delight you with their clarity, definition, and vividness. You can record Full HD (1920 x 1080) videos', 'Electoronics', 'images/post/p_post593dc55d38162.jpg', '16', '2017-05-26'),
(38, 'Casio Dual Time Anadigi AW-80D-1AV for Men (Digital, Casual Watch)', 'More than just a showpiece, the Casio Dual Time Anadigi AW 80D 1AV for Men is a stylish wristwatch that comes packed with practical features. The timepiece displays time in analog and digital formats (12 and 24 hour and the day). Full auto calendar shows the precise day and date till', 'Accessories', 'images/post/p_post593dd11ca84a2.jpg', '16', '2017-05-26'),
(40, 'Sony 256GB Class 10 UHS-1/U3 SDXC up to 94MB/s Memory Card', 'Sony 256GB Class 10 UHS-1/U3 SDXC up to 94MB/s Memory CardUp to 94 MB/s transfer speed and up to 70MB/s write speedDesigned for the photographer /videographer who requires 4K video shooting, high speed burst shooting and fast transfer speedFile Rescue downloadable software helps recover ', 'Accessories', 'images/post/p_post593dd0c61efd4.jpg', '16', '2017-05-26'),
(41, 'Asus X540 XX020D Laptop -Intel', 'Brand Asus Product Name Asus X540 - XX070D Model X540 - XX070D Processor Intel Pintium Processor Information Intel Pentium Processor N3700 (2M Cache, up to 2.40 GHz) Ram 2 GB RAM Information DDR3L 1600 MHz Hard Disk Capacity 500 GB Hard Disk Type HDD 5,400 RPM DVD Yes Graphic Card ', 'Computers', 'images/post/p_post593dc7bd6e60d.jpg', '16', '2017-05-26'),
(42, 'Apple iPhone 6S with FaceTime - 16GB, 4G LTE, Rose Gold', 'The Apple iPhone 6S is a state of the art smartphone that stands out from the crowd with its svelte metallic design and incredible onboard features. Its light weight and slim form factor enables you to slip this mobile into your pockets and purses with the utmost ease', 'Smart Phone', 'images/post/p_post593dcbf957bac.jpg', '16', '2017-06-06'),
(43, 'Lenovo Ideapad Y700 15 Laptop', 'Processor: Intel Core i7-6700HQ - Quad-Core 4M Cache, 2.6 up to 3.5 GHz Memory: 16 GB DDR4 Hard drive: 1 TB HDD + 128 GB SSD Graphics Card: NVIDIA GeForce GTX 960M 4GB DDR5 Dedicated Display: 15.6 inch Frameless Full HD (1920 x 1080) Optical Drive: no Webcam: HD 720p Back-lit Keyboard ', 'Computers', 'images/post/p_post593dc734254b2.jpg', '16', '2017-06-06'),
(44, 'Samsung Galaxy J7 Prime Dual Sim - 16GB, 3GB, 4G LTE, Gold', 'The Samsung Galaxy J7 Prime Dual SIM smartphone performs smoothly and looks great, giving you the best of both worlds. It has an elegant, refined body in an attractive gold color. This smartphone has a sleek form factor that makes it easier to hold. It offers you a fast', 'Smart Phone', 'images/post/p_post593dcb65f0999.jpg', '16', '2017-06-06'),
(45, 'Hundai', 'Hundai', 'Cars', 'images/post/p_post593dcee73c2e0.jpg', '16', '2017-06-06'),
(46, 'Apple iPhone 7 with FaceTime - 128GB, 4G LTE, Red', 'The black color and the sleek design loaded with unmatched features makes the Apple iPhone 7 the smartphone that everyone dreams of owning. The rear camera captures photos at a resolution of 12 MP. It has a large f/1.8 aperture that offers excellent low light performance', 'Smart Phone', 'images/post/p_post593dcadcf3d7e.jpg', '16', '2017-06-06'),
(47, 'Kattey Perry DarkHorse', 'DarkHorse alboum and song', 'Music', 'images/post/p_post593dd264cb80e.jpg', '16', '2017-06-06'),
(48, 'Kingston Flash Memory (16GB, Metal)', 'Compatible with Windows (Seven - Vista - XP) and MacStrong Metal form anti-shock', 'Accessories', 'images/post/p_post593dd05178533.jpg', '16', '2017-06-06'),
(49, 'PHP', 'php book since 2002', 'Books', 'images/post/p_post593dd317e3174.jpg', '16', '2017-06-06'),
(50, 'HP 15-ay109ne Y7X91EA Laptop ', 'Processor: Intel Core i5-7200U Processor (3M Cache, up to 3.10 GHz) Memory: 8 GB DDR4-2133 SDRAM (1 x 8 GB) Hard drive: 1 TB 5400 rpm SATA Graphics Card: AMD Radeon R7 M440 Graphics (4 GB DDR3 dedicated) Display: 15.6 Inch HD SVA BrightView WLED-backlit (1366 x 768) ', 'Computers', 'images/post/p_post593dc6a25b0b8.jpg', '17', '2017-06-07'),
(51, ' Apple iPhone 7 Plus with FaceTime - 128GB ', 'Equipped with a host of advanced technologies, the Apple iPhone 7 Plus With FaceTime is all set to deliver a power packed performance. It conceals some seriously powerful hardware underneath its slim 7.3mm body. The phone sports a jet black ', 'Smart Phone', 'images/post/p_post593dca8240514.jpg', '16', '2017-06-10'),
(52, 'HP 15-ay022ne Notebook', 'The HP Intel i7 notebook delivers an incredible multitasking performance. This HP 15 notebook sports a 15.6inch, FHD display.The HP 15 ay022ne Notebook is perfect for all your daily computing and entertainment needs. It sports a 15.6inch, FHD display', 'Computers', 'images/post/p_post593dc6371e1df.jpg', '16', '2017-06-10'),
(53, 'TSST POWER BANAK DIGITAL', 'Features:5V (Actual battery charging current is limited to 1.8A)Output: USB 1.0A / 5V, USB 2.4A / 5VBattery Type: Li-ion polymerCell Capacity: 10,000 mAh @ 3.8 VCharging Capacity: 5,920 mAh @ 5VColor: SilverDimension: 133.0 x 67.0 x 16.4 mmWeight: 275.0 g', 'Accessories', 'images/post/p_post593dcfd95a9de.jpg', '16', '2017-06-10');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `s_id` int(11) NOT NULL,
  `s_category_a` text NOT NULL,
  `s_category_b` text NOT NULL,
  `s_category_c` text NOT NULL,
  `s_category_d` text NOT NULL,
  `s_category_e` text NOT NULL,
  `s_category_f` text NOT NULL,
  `s_category_g` text NOT NULL,
  `s_posts` text NOT NULL,
  `s_posts_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`s_id`, `s_category_a`, `s_category_b`, `s_category_c`, `s_category_d`, `s_category_e`, `s_category_f`, `s_category_g`, `s_posts`, `s_posts_value`) VALUES
(1, 'Smart Phone', 'Computers', 'Electoronics', 'Books', 'Music', 'Cars', 'Accessories', 'Posts            ', 16);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_name` text NOT NULL,
  `u_mail` text NOT NULL,
  `u_pass` text NOT NULL,
  `u_avatar` text NOT NULL,
  `reg_date` date NOT NULL,
  `isadmain` text CHARACTER SET utf32 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_name`, `u_mail`, `u_pass`, `u_avatar`, `reg_date`, `isadmain`) VALUES
(16, 'Admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'images/avatar/u_mail5925ee0d72efd.jpg', '2017-05-07', 'admin'),
(17, 'mohamed', 'mero@mero.com', 'd0ff812ad7553f05047ce40e48a0b009', 'images/500x400.png', '2017-06-07', 'user'),
(18, 'mm', 'mm@mm.com', '202cb962ac59075b964b07152d234b70', 'images/500x400.png', '2017-06-11', 'user'),
(19, 'yahya', 'yahya55@gamil.com', '264f9b1bfb77401e5f446c8ed6aef269', 'images/avatar/u_mail593df13d7600b.jpg', '2017-06-12', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
