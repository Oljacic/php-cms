-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2020 at 04:35 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--
CREATE DATABASE IF NOT EXISTS `cms` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cms`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(3) NOT NULL,
  `category_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_title`) VALUES
(1, 'PHP'),
(2, 'Java'),
(5, 'Grind');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(3) NOT NULL,
  `post_id` int(3) NOT NULL,
  `author` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'unapproved',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `author`, `email`, `content`, `status`, `date`) VALUES
(1, 1, 'Hotina Latina', 'latinahotina@tina.bombina', 'Hey you ;)', 'unapproved', '2020-01-11'),
(2, 1, 'Normal Guy', 'justnormalguy@serbia.com', 'Hi I am best normal guy you will ever met ;)', 'approved', '2020-01-11'),
(3, 2, 'Spam', 'spamtilltomorow@spaminjo.com', 'Spam', 'unapproved', '2020-01-11'),
(4, 2, 'Monica', 'monicafromsilicon@mon.com', 'Hey Very good article for bulding skills.', 'approved', '2020-01-11'),
(5, 1, 'Test', 'test@test.test', 'test', 'unapproved', '2020-01-11'),
(6, 1, 'Sprki', 'spamtilltomorow@spaminjo.com', 'sprkinjo', 'unapproved', '2020-01-11'),
(7, 1, 'Malinka', 'malinedogodine@mail.com', 'Maliine mogu da se svrstaju pod successfull life?', 'unapproved', '2020-01-11'),
(8, 1, 'Burek', 'burekcic@buki.com', 'Burekcina', 'approved', '2020-01-11'),
(9, 1, 'Stef', 'support@setinjo.com', 'Stef', 'approved', '2020-01-11'),
(10, 1, 'Look', 'luk@look.com', 'Ssdada', 'approved', '2020-01-11'),
(11, 3, 'What', 'test@test.test', 'dsadad', 'unapproved', '2020-01-11');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(3) NOT NULL,
  `category_id` int(3) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `image` text NOT NULL,
  `content` text NOT NULL,
  `tags` varchar(255) NOT NULL,
  `comment_count` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `title`, `author`, `date`, `image`, `content`, `tags`, `comment_count`, `status`) VALUES
(1, 5, 'Success', 'Stef', '2020-01-05', 'placeholder-success.jpg', 'This content will tell you what to do and what you can get so evreythinh should be ok. ', 'life, success, working on increasing skills', '5', 'published'),
(2, 1, 'Test Unit', 'Stef', '2020-01-05', 'placeholder.jpg', 'Some content from greatest programer!', 'PHP, master', '4', 'published'),
(3, 1, 'Stef', 'Stef', '2020-01-11', 'placeholder.jpg', 'dasdsadasdsad', 'Succees, Life Goals, Habbit', '1', 'draft');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'admin',
  `rand_salt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `user_image`, `role`, `rand_salt`) VALUES
(1, 'Miko', '123', 'Miko', 'Mikovic', 'mikovic@mail.com', '', 'subscriber', ''),
(3, 'Nensi', 'lubav', 'Nena', 'Nena', 'nensi94@test.com', '', 'admin', ''),
(4, 'test1', 'test1', 'test1', 'test1', 'test1@test.test', '', 'subscriber', ''),
(7, 'makiss', '123', 'Makas', 'Zvaka', 'maki@maka.com', '', 'admin', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
