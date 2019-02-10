-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2017 at 11:49 AM
-- Server version: 5.6.36-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hostelassist`
--

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE IF NOT EXISTS `houses` (
  `post_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `type` tinyint(2) NOT NULL,
  `availablemonth` tinyint(2) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(35) NOT NULL,
  `furnished` tinyint(2) NOT NULL,
  `bedroom` tinyint(2) NOT NULL DEFAULT '0',
  `kitchen` tinyint(2) NOT NULL DEFAULT '0',
  `washroom` tinyint(2) NOT NULL DEFAULT '0',
  `ac` tinyint(2) NOT NULL DEFAULT '0',
  `cooler` tinyint(2) NOT NULL DEFAULT '0',
  `fridge` tinyint(2) NOT NULL DEFAULT '0',
  `wifi` tinyint(2) NOT NULL DEFAULT '0',
  `waterpurifier` tinyint(2) NOT NULL DEFAULT '0',
  `geyser` tinyint(2) NOT NULL DEFAULT '0',
  `inverter` tinyint(2) NOT NULL DEFAULT '0',
  `tv` tinyint(2) NOT NULL DEFAULT '0',
  `parking` tinyint(2) NOT NULL DEFAULT '0',
  `security` tinyint(2) NOT NULL DEFAULT '0',
  `other` varchar(200) NOT NULL,
  `image1` text NOT NULL,
  `image2` text NOT NULL,
  `image3` text NOT NULL,
  `image4` text NOT NULL,
  `showaddress` tinyint(2) NOT NULL DEFAULT '0',
  `price` int(10) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pincode` int(11) NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`post_id`, `user_id`, `type`, `availablemonth`, `address`, `city`, `furnished`, `bedroom`, `kitchen`, `washroom`, `ac`, `cooler`, `fridge`, `wifi`, `waterpurifier`, `geyser`, `inverter`, `tv`, `parking`, `security`, `other`, `image1`, `image2`, `image3`, `image4`, `showaddress`, `price`, `status`, `created`, `modified`, `pincode`) VALUES
(51, 42, 2, 4, 'kapurthala', 'phagwara', 2, 3, 1, 2, 1, 0, 0, 1, 1, 0, 1, 0, 0, 0, '', 'img3.jpeg', '', '', '', 1, 50000, 0, '2017-05-17 13:34:32', '2017-05-18 01:44:20', 144401),
(52, 54, 1, 6, 'model town', 'jalandhar', 1, 2, 1, 1, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, '', 'house.jpg', 'room1.jpg', 'room2.jpg', '', 1, 4000, 1, '2017-05-17 23:01:54', '2017-05-17 23:01:54', 144914),
(53, 52, 1, 5, 'deep nagar', 'jalandhar', 1, 2, 1, 1, 1, 1, 0, 1, 1, 1, 1, 0, 0, 0, '', 'img1.jpeg', 'img4.jpg', '', '', 1, 5000, 1, '2017-05-18 01:36:49', '2017-05-18 01:39:42', 144400),
(54, 52, 2, 7, 'Rama mandi', 'jalandhar', 2, 3, 1, 1, 1, 0, 0, 1, 1, 0, 1, 0, 0, 0, '', 'img3.jpeg', 'img5.jpg', '', '', 1, 7000, 1, '2017-05-18 01:38:59', '2017-05-18 01:38:59', 144401),
(55, 42, 2, 6, 'deep nagar', 'jalandhar', 1, 2, 1, 1, 1, 0, 0, 1, 1, 0, 0, 0, 0, 0, '', 'img2.jpeg', 'img6.jpg', 'img5.jpg', '', 1, 4000, 1, '2017-05-18 01:43:51', '2017-05-18 01:43:51', 144400),
(56, 42, 2, 6, 'kapurthala', 'phagwara', 2, 2, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 0, 0, '', 'img9.jpg', 'img8.jpg', 'img7.jpg', '', 1, 5000, 1, '2017-05-18 01:47:21', '2017-05-18 01:47:21', 144400);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `status`, `created`, `modified`) VALUES
(1, 'admin', 1, NULL, NULL),
(2, 'renter', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL DEFAULT '2',
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `ver_code` varchar(200) DEFAULT NULL,
  `verified` int(2) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `passwordreset` varchar(100) DEFAULT NULL,
  `modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `mobile` (`mobile`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `mobile`, `password`, `status`, `ver_code`, `verified`, `created`, `passwordreset`, `modified`) VALUES
(1, 1, 'Admininstrator', 'admin@hostelassist.com', '1111111111', '4e7afebcfbae000b22c7c85e5560f89a2a0280b4', 1, NULL, 1, NULL, NULL, '2017-05-17 11:53:18'),
(4, 1, 'abc', 'abc@gmail.com', '2216632352', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a', 0, NULL, 1, NULL, '4415979', '2017-08-03 10:27:20'),
(5, 1, 'Ashwini', 'aks@gmail.com', '1215647340', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a', 1, NULL, 1, NULL, NULL, '2017-05-18 00:50:12'),
(7, 2, 'ashwini', 'ashwinisingh009@yahoo.com', '1245643519', '7c222fb2927d828af22f592134e8932480637c0d', 1, NULL, 1, NULL, NULL, '2017-04-26 11:10:22'),
(21, 2, '6', '6', '6', '123457890', 0, NULL, 0, NULL, NULL, '2017-05-18 00:12:13'),
(40, 2, 'User', 'user@mail.com', '1234567800', '7c222fb2927d828af22f592134e8932480637c0d', 1, NULL, 0, '2017-04-24 02:05:05', NULL, '2017-04-26 11:10:17'),
(41, 2, 'Ashwini', 'Ashwinisingh1711@gmail.com', '8699652913', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a', 1, NULL, 1, '2017-04-25 06:52:12', '986017760', '2017-08-02 07:22:31'),
(42, 2, 'jagriti singh', 'jagriti.s21@gmail.com', '8400021605', '1ee80ea7d04b5394dd86e507af3655a58ebe7533', 1, '1002838639', 1, '2017-04-25 08:23:48', NULL, '2017-05-17 13:29:40'),
(43, 2, 'Ashutosh Singh', 'sashutosh683@gmail.com', '9872365278', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, '813447426', 1, '2017-04-25 12:17:36', NULL, '2017-05-18 07:06:18'),
(44, 2, 'Ashwini', 'ashwinisingh009@yahoo.in', '7623023023', '7c222fb2927d828af22f592134e8932480637c0d', 1, NULL, 1, '2017-04-25 13:03:45', '371010568', '2017-08-03 08:23:25'),
(45, 2, 'hostelassist', 'hostelasssist@gmail.com', '8529637410', '7c222fb2927d828af22f592134e8932480637c0d', 1, '1364724523', 1, '2017-04-25 13:14:03', NULL, '2017-04-26 11:09:42'),
(46, 2, 'Yugendra', 'yugendrac@gmail.com', '9056687383', '7c222fb2927d828af22f592134e8932480637c0d', 1, '2064248963', 1, '2017-04-26 08:48:51', NULL, '2017-04-26 08:49:14'),
(47, 2, 'Gaurang', 'gauranc@cmail.com', '9041391694', '499b0f3ac9e5e105fd5d545b122671ce82a81f24', 1, '299438125', 0, '2017-04-29 05:50:14', NULL, '2017-04-29 05:50:14'),
(48, 2, 'Gaurand', 'vishk65@gmail.com', '9119119119', '5d4319b23d60a99e6b095ba02bbc21115f9e3c6e', 0, '963982906', 1, '2017-04-29 05:56:10', NULL, '2017-05-17 11:55:37'),
(49, 2, 'yobaby', 'phonegap@mail.com', '8888888888', 'cbc174f242778458f6bda6a77f6cb559f8a3f5ed', 0, '1730850631', 1, '2017-04-29 06:10:14', NULL, '2017-05-17 11:55:17'),
(50, 2, 'kenil', 'kenspatel96@gmail.com', '9994739300', '7c222fb2927d828af22f592134e8932480637c0d', 1, NULL, 1, '2017-04-30 03:09:59', NULL, '2017-04-30 03:11:15'),
(52, 2, 'shreya sehgal', 'chutki.s21@gmail.com', '9872427653', 'dd38a2da06815ff1a65891b5e9e1dfcb166c1679', 1, NULL, 1, '2017-05-17 11:07:47', NULL, '2017-05-18 12:25:11'),
(53, 2, 'Dinesh', 'Dinesh.wasalwar888@gmail.com', '9898989898', '7c222fb2927d828af22f592134e8932480637c0d', 1, NULL, 1, '2017-05-17 12:54:17', NULL, '2017-05-17 13:08:22'),
(54, 2, 'vishakha', 'vishakhaa95@gmail.com', '7893759389', '7c222fb2927d828af22f592134e8932480637c0d', 1, NULL, 1, '2017-05-17 22:52:14', '150356551', '2017-05-17 22:55:03'),
(55, 2, 'abhishek', 'vanshi12pathania@gmail.com', '9988776655', '7c222fb2927d828af22f592134e8932480637c0d', 1, '914070602', 0, '2017-05-18 02:59:53', NULL, '2017-05-18 02:59:53'),
(56, 2, 'sukhjiwan kaur', 'sukhkaur0001@yahoo.in', '8146498836', 'fa28c29dd3d804b11b8e22ab0fcd01947a7d8d5f', 1, NULL, 1, '2017-06-12 07:54:49', NULL, '2017-06-12 07:58:27'),
(57, 2, 'Yogi', 'shrutishende310@gmail.com', '1234321452', '7c222fb2927d828af22f592134e8932480637c0d', 1, '1992699832', 0, '2017-08-02 08:09:02', NULL, '2017-08-02 08:09:02'),
(58, 2, 'shubham', 'shubhammishra057@gmail.com', '2662565656', 'c87c3ea16593e6b0c53aaa9327557097fcff8f91', 1, '1824099518', 0, '2017-08-04 21:10:41', NULL, '2017-08-04 21:10:41');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `houses`
--
ALTER TABLE `houses`
  ADD CONSTRAINT `houses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
