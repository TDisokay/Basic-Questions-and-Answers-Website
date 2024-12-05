-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 29, 2024 lúc 08:51 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `coursework`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(50) NOT NULL,
  `post_id` int(50) DEFAULT NULL,
  `user_id` int(50) DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `content`, `created_at`, `image_url`) VALUES
(1, 1, 2, 'Have you tried using the chain rule? That often helps with complex calculus problems.', '2024-08-15 18:56:14', NULL),
(2, 1, 4, 'I found this video really helpful for understanding calculus: [link to video]', '2024-08-15 18:56:14', NULL),
(3, 2, 1, "List comprehension is great for creating lists concisely. Here\'s an example: [code snippet]", '2024-08-15 18:56:14', NULL),
(4, 3, 5, "Quantum mechanics is complex, but I\'d start by understanding the double-slit experiment.", '2024-08-15 18:56:14', NULL),
(5, 4, 2, 'The DNA replication process involves several steps: 1) Unwinding 2) Primer binding 3) Elongation 4) Termination', '2024-08-15 18:56:14', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `messages`
--

CREATE TABLE `messages` (
  `id` int(50) NOT NULL,
  `user_id` int(50) DEFAULT NULL,
  `subject` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `status` enum('read','unread') DEFAULT 'unread',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `subject`, `content`, `status`, `created_at`) VALUES
(1, 1, 'Question about course registration', "Hi, I\'m having trouble registering for the Advanced Mathematics course. Can you help?", 'unread', '2024-08-15 18:56:14'),
(2, 2, 'Suggestion for new feature', 'It would be great if we could have a built-in LaTeX editor for math equations!', 'unread', '2024-08-15 18:56:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `modules`
--

CREATE TABLE `modules` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `modules`
--

INSERT INTO `modules` (`id`, `name`, `description`) VALUES
(1, 'Mathematics', 'The study of numbers, quantities, and shapes. Includes areas such as algebra, geometry, and calculus.'),
(2, 'Computer Science', 'The study of computation, information processing, and the design of computer systems. Covers programming, algorithms, and data structures.'),
(3, 'Physics', 'The natural science that studies matter, its motion and behavior through space and time, and the related entities of energy and force.'),
(4, 'Biology', 'The study of living organisms, their structure, function, growth, evolution, and distribution.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(50) NOT NULL,
  `user_id` int(50) DEFAULT NULL,
  `module_id` int(50) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `module_id`, `title`, `content`, `image_url`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Help with Calculus ', "I\'m struggling with this calculus problem. Can someone explain how to solve?", 'uploads/teach-you-how-to-do-calculus-1-problems.jpg', '2024-08-15 18:56:14', '2024-08-29 05:49:36'),
(2, 2, 2, 'Python List Comprehension', 'What are some good examples of using list comprehension in Python?', './uploads/c3d0647fbf9b2582f4712f0ccd793a9f.jpg', '2024-08-15 18:56:14', '2024-08-20 16:55:00'),
(3, 4, 3, 'Understanding Quantum Mechanics', 'Can someone explain the basics of quantum mechanics in simple terms?', './uploads/horse.jpg', '2024-08-15 18:56:14', '2024-08-20 16:55:02'),
(4, 5, 3, 'DNA Replication Process', 'I need help understanding the steps of DNA replication. Any resources or explanations?', 'uploads/st,small,507x507-pad,600x600,f8f8f8.u3.jpg', '2024-08-15 18:56:14', '2024-08-21 06:03:52'),
(5, 1, 1, 'zvzsvav', 'FFBGDFBDFB', '../uploads/Screenshot 2024-08-29 123131.png', '2024-08-29 06:32:24', '2024-08-29 06:47:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `bio` text DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `social_media` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`social_media`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `is_admin`, `created_at`, `bio`, `profile_picture`, `social_media`) VALUES
(1, 'john_doe', 'john@example.com', '$2y$10$ADVn2I1JgmkOrSziqTiS5uwFo0ybY3sWRZF9QANnhN75oW.zN.sM2', 0, '2024-08-15 18:56:14', "I\'m very good at Math, you can trust me :)", 'uploads/IMG_1350.jpg', '{\"linkedin\":\"\",\"github\":\"\"}'),
(2, 'jane_smith', 'jane@example.com', '$2y$10$Jym7eQfYYmuyimDeC.20kOH1TZzkixQwKrme7uOCd14f2K.wuCvLq', 0, '2024-08-15 18:56:14', 'Jane Smith to the help!!!', 'uploads/Second Princess Marie Typhonian.jpg', '{\"linkedin\":\"\",\"github\":\"\"}'),
(3, 'admin_user', 'admin@example.com', '$2y$10$iXP.8.pAiu5l4VvhayjEquN9aQKLAZjh2Aensg.yV/xFWpWMK/g1K', 1, '2024-08-15 18:56:14', NULL, NULL, NULL),
(4, 'student1', 'student1@example.com', '$2y$10$v51Cbh2BTBM9F1JV8kN8xe2TrM0R8EO70r9FTDxddH/Yoq6/1Arlm', 0, '2024-08-15 18:56:14', 'Just a normal student need help from random people on the Internet.', 'uploads/Apprentice Blacksmith Jacob Cobble.jpg', '{\"linkedin\":\"\",\"github\":\"\"}'),
(5, 'student2', 'student2@example.com', '$2y$10$pqNWVTWDdG3MLiIPjTte5Ovf.VfOSOheyb25ShCyU12ktA91nwsku', 0, '2024-08-15 18:56:14', 'Nothing much here', 'uploads/Untitled design.gif', '{\"linkedin\":\"\",\"github\":\"\"}');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `module_id` (`module_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
