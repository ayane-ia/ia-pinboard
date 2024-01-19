-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 19/01/2024 às 06:24
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `iapinboard`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `adm`
--

CREATE TABLE `adm` (
  `adm_id` int(100) NOT NULL,
  `adm_name` varchar(30) NOT NULL,
  `adm_email` varchar(200) NOT NULL,
  `adm_password` varchar(100) NOT NULL,
  `adm_level` int(10) DEFAULT NULL,
  `adm_image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `adm`
--

INSERT INTO `adm` (`adm_id`, `adm_name`, `adm_email`, `adm_password`, `adm_level`, `adm_image`) VALUES
(1, 'ayano', 'ayano@gmail.com', '123', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_image`) VALUES
(1, 'Personagem', NULL),
(2, 'Paisagem', NULL),
(3, 'Mar', NULL),
(9, 'Salve', '180120242214Salve.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `image_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `comments`
--

INSERT INTO `comments` (`comment_id`, `image_id`, `user_id`, `comment_content`, `comment_date`) VALUES
(6, 27, 142, 'Aqui eh o meu proprio comentario', '2024-01-17');

-- --------------------------------------------------------

--
-- Estrutura para tabela `following`
--

CREATE TABLE `following` (
  `id` int(10) NOT NULL,
  `follower` int(100) NOT NULL DEFAULT 0,
  `followed` int(100) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `following`
--

INSERT INTO `following` (`id`, `follower`, `followed`) VALUES
(24, 142, 144);

-- --------------------------------------------------------

--
-- Estrutura para tabela `images`
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
-- Despejando dados para a tabela `images`
--

INSERT INTO `images` (`image_id`, `image_name`, `image_title`, `image_path`, `image_authorId`, `image_category`, `image_description`) VALUES
(27, 'user142image1', 'Wallpaper pika', 'user142/user142image1.png', '142', '1', 'papel de parede do luffy');

-- --------------------------------------------------------

--
-- Estrutura para tabela `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `image` int(11) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `likes`
--

INSERT INTO `likes` (`id`, `image`, `user`) VALUES
(35, 27, 144);

-- --------------------------------------------------------

--
-- Estrutura para tabela `messageBox`
--

CREATE TABLE `messageBox` (
  `message_id` int(11) NOT NULL,
  `menssager_id` int(100) NOT NULL,
  `received_id` int(100) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `messageBox_adm`
--

CREATE TABLE `messageBox_adm` (
  `message_id` int(11) NOT NULL,
  `adm_id` int(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `messageBox_adm`
--

INSERT INTO `messageBox_adm` (`message_id`, `adm_id`, `user_id`, `content`, `create_time`) VALUES
(6, 1, 142, 'Faz o l ai man', '2024-01-19 02:37:32'),
(7, 1, 142, 'salve salve', '2024-01-19 02:39:31'),
(8, 1, 142, 'Man tu eh doido eh kkkkkkk', '2024-01-19 02:39:40');

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
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
  `user_followers` int(100) DEFAULT NULL,
  `user_following` int(100) DEFAULT NULL,
  `user_publications` int(11) DEFAULT NULL,
  `user_ban` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_level`, `user_age`, `user_image`, `user_bio`, `user_likes`, `user_followers`, `user_following`, `user_publications`, `user_ban`) VALUES
(142, 'Ayron nasc', 'ayron@gmail.com', '123', NULL, '2024-01-15', NULL, '                                Agora eu tenho uma biografia !', NULL, 0, NULL, NULL, 0),
(144, 'Teste', 'teste@gmail.com', '123', NULL, '2024-01-11', '190120240617.png', '                                                                Troquei minha biografia                                                                ', NULL, 0, 1, NULL, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users_baned`
--

CREATE TABLE `users_baned` (
  `ban_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_email` text NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `adm`
--
ALTER TABLE `adm`
  ADD PRIMARY KEY (`adm_id`);

--
-- Índices de tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Índices de tabela `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `image` (`image_id`),
  ADD KEY `user` (`user_id`);

--
-- Índices de tabela `following`
--
ALTER TABLE `following`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK__user` (`follower`),
  ADD KEY `FK__user_2` (`followed`);

--
-- Índices de tabela `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Índices de tabela `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK__image` (`image`),
  ADD KEY `FK__user` (`user`),
  ADD KEY `FK__image1` (`image`),
  ADD KEY `FK__user1` (`user`);

--
-- Índices de tabela `messageBox`
--
ALTER TABLE `messageBox`
  ADD PRIMARY KEY (`message_id`);

--
-- Índices de tabela `messageBox_adm`
--
ALTER TABLE `messageBox_adm`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `adm_id` (`adm_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Índices de tabela `users_baned`
--
ALTER TABLE `users_baned`
  ADD PRIMARY KEY (`ban_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `adm`
--
ALTER TABLE `adm`
  MODIFY `adm_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `following`
--
ALTER TABLE `following`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `messageBox`
--
ALTER TABLE `messageBox`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `messageBox_adm`
--
ALTER TABLE `messageBox_adm`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT de tabela `users_baned`
--
ALTER TABLE `users_baned`
  MODIFY `ban_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `image` FOREIGN KEY (`image_id`) REFERENCES `images` (`image_id`),
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Restrições para tabelas `following`
--
ALTER TABLE `following`
  ADD CONSTRAINT `FK__user` FOREIGN KEY (`follower`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK__user_2` FOREIGN KEY (`followed`) REFERENCES `user` (`user_id`);

--
-- Restrições para tabelas `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `FK__image1` FOREIGN KEY (`image`) REFERENCES `images` (`image_id`),
  ADD CONSTRAINT `FK__user1` FOREIGN KEY (`user`) REFERENCES `user` (`user_id`);

--
-- Restrições para tabelas `messageBox_adm`
--
ALTER TABLE `messageBox_adm`
  ADD CONSTRAINT `adm_id` FOREIGN KEY (`adm_id`) REFERENCES `adm` (`adm_id`),
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
