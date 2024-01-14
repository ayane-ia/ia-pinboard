-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 14, 2024 at 07:36 PM
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
-- Database: `iapinboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `adm`
--

CREATE TABLE `adm` (
  `adm_id` int(11) NOT NULL,
  `adm_name` varchar(30) NOT NULL,
  `adm_email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adm`
--

INSERT INTO `adm` (`adm_id`, `adm_name`, `adm_email`) VALUES
(1, 'ayano', 'ayano@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_image`) VALUES
(1, 'Personagem', NULL),
(2, 'Paisagem', NULL),
(3, 'Mar', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `image_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `image_id`, `user_id`, `comment_content`, `comment_date`) VALUES
(1, 26, 138, 'teste\r\n', '2024-01-14'),
(2, 26, 138, 'teste2', '2024-01-14'),
(3, 24, 138, 'O ayron eh pika', '2024-01-14'),
(4, 24, 138, 'mais ele eh poggers', '2024-01-14'),
(5, 24, 138, 'ta mais idai?', '2024-01-14');

-- --------------------------------------------------------

--
-- Table structure for table `following`
--

CREATE TABLE `following` (
  `id` int(10) NOT NULL,
  `follower` int(100) NOT NULL DEFAULT 0,
  `followed` int(100) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `following`
--

INSERT INTO `following` (`id`, `follower`, `followed`) VALUES
(17, 138, 137);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `image_name` text NOT NULL,
  `image_title` varchar(255) NOT NULL,
  `image_path` text NOT NULL,
  `image_authorId` varchar(100) NOT NULL,
  `image_category` varchar(90) DEFAULT NULL,
  `image_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `image_name`, `image_title`, `image_path`, `image_authorId`, `image_category`, `image_description`) VALUES
(23, 'user137image4', 'imagem legal', 'user137/user137image4.png', '137', '2', 'aaaaaaaaaaaaaaaaaaaaaa'),
(24, 'user137image2', 'Imagem de Teste', 'user137/user137image2.png', '137', '1', 'lorem ipsum'),
(25, 'user137image3', 'bluzao', 'user137/user137image3.jpg', '137', '2', 'aaaaaaaaaa'),
(26, 'user137image4', 'teste', 'user137/user137image4.jpg', '137', '1', 'bobao');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `image` int(11) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `image`, `user`) VALUES
(1, 25, 138),
(14, 24, 138);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_password` varchar(70) NOT NULL,
  `user_level` int(11) DEFAULT NULL,
  `user_age` date NOT NULL,
  `user_image` text DEFAULT NULL,
  `user_bio` text DEFAULT NULL,
  `user_likes` int(11) DEFAULT NULL,
  `user_followers` int(11) DEFAULT NULL,
  `user_following` int(11) DEFAULT NULL,
  `user_publications` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_level`, `user_age`, `user_image`, `user_bio`, `user_likes`, `user_followers`, `user_following`, `user_publications`) VALUES
(137, 'Ayron', 'ayron@gmail.com', '123', NULL, '2024-01-05', NULL, 'Alguma coisa...', NULL, NULL, NULL, NULL),
(138, 'teste', 'teste@gmail.com', '123', NULL, '2024-01-12', NULL, NULL, NULL, NULL, NULL, NULL),
(139, 'bluezao', 'bluezao@gmail.com', '123', NULL, '2004-01-07', NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adm`
--
ALTER TABLE `adm`
  ADD PRIMARY KEY (`adm_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `image` (`image_id`),
  ADD KEY `user` (`user_id`);

--
-- Indexes for table `following`
--
ALTER TABLE `following`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK__user` (`follower`),
  ADD KEY `FK__user_2` (`followed`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK__image` (`image`),
  ADD KEY `FK__user` (`user`),
  ADD KEY `FK__image1` (`image`),
  ADD KEY `FK__user1` (`user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adm`
--
ALTER TABLE `adm`
  MODIFY `adm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `following`
--
ALTER TABLE `following`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `image` FOREIGN KEY (`image_id`) REFERENCES `images` (`image_id`),
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `following`
--
ALTER TABLE `following`
  ADD CONSTRAINT `FK__user` FOREIGN KEY (`follower`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK__user_2` FOREIGN KEY (`followed`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `FK__image1` FOREIGN KEY (`image`) REFERENCES `images` (`image_id`),
  ADD CONSTRAINT `FK__user1` FOREIGN KEY (`user`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
