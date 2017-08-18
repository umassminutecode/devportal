-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 18, 2017 at 12:23 AM
-- Server version: 5.6.35
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minuteco_devportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_keys`
--

CREATE TABLE `auth_keys` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `key_value` varchar(255) NOT NULL,
  `issued` datetime NOT NULL,
  `expires` datetime NOT NULL,
  `ip4_addr` varchar(50) NOT NULL,
  `browser` varchar(50) NOT NULL,
  `os` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_keys`
--

INSERT INTO `auth_keys` (`id`, `member_id`, `key_value`, `issued`, `expires`, `ip4_addr`, `browser`, `os`) VALUES
(36, 2, '140991183483568128', '2017-04-06 05:40:52', '2017-04-06 05:55:52', '128.119.202.121', 'Unknown Browser', 'Unknown OS Platform'),
(35, 2, '833366969892732928', '2017-04-06 05:27:52', '2017-04-06 05:46:26', '128.119.202.121', 'Unknown Browser', 'Unknown OS Platform'),
(34, 3, '210607037074112512', '2017-04-06 05:18:00', '2017-04-06 05:33:00', '128.119.202.239', 'Unknown Browser', 'Unknown OS Platform'),
(33, 2, '5233316091379318784', '2017-04-06 05:12:17', '2017-04-06 05:36:14', '128.119.202.121', 'Unknown Browser', 'Unknown OS Platform'),
(32, 2, '8984064636739387392', '2017-04-06 04:56:36', '2017-04-06 05:26:06', '128.119.202.121', 'Unknown Browser', 'Unknown OS Platform'),
(31, 2, '1568430831393832960', '2017-04-05 12:48:59', '2017-04-05 13:03:59', '128.119.202.72', 'Unknown Browser', 'Unknown OS Platform'),
(30, 2, '1052027461488869376', '2017-04-04 21:19:08', '2017-04-04 21:34:08', '128.119.202.101', 'Unknown Browser', 'Unknown OS Platform'),
(29, 2, '64009160332673024', '2017-04-04 21:18:05', '2017-04-04 21:33:05', '128.119.202.101', 'Unknown Browser', 'Unknown OS Platform'),
(28, 1, '4558511604588609536', '2017-04-04 21:17:07', '2017-04-04 21:32:07', '128.119.202.101', 'Unknown Browser', 'Unknown OS Platform'),
(27, 1, '8003469568079036416', '2017-04-04 21:16:46', '2017-04-02 21:31:46', '128.119.202.101', 'Unknown Browser', 'Unknown OS Platform'),
(26, 1, '743053445564465152', '2017-04-04 21:03:58', '2017-04-02 21:21:42', '128.119.202.101', 'Unknown Browser', 'Unknown OS Platform'),
(25, 1, '1027641590664921088', '2017-04-04 21:01:41', '2017-04-03 21:16:43', '128.119.202.101', 'Unknown Browser', 'Unknown OS Platform'),
(24, 1, '6811216947703709696', '2017-04-04 21:01:13', '2017-04-04 21:16:13', '128.119.202.101', 'Unknown Browser', 'Unknown OS Platform'),
(23, 1, '7092606853997133824', '2017-04-04 20:54:04', '2017-04-04 21:10:03', '128.119.202.101', 'Unknown Browser', 'Unknown OS Platform'),
(22, 1, '8920395547622244352', '2017-04-04 20:53:15', '2017-04-04 21:08:15', '128.119.202.101', 'Unknown Browser', 'Unknown OS Platform'),
(21, 1, '7440314096177643520', '2017-04-04 20:50:48', '2017-04-04 21:05:48', '128.119.202.101', 'Unknown Browser', 'Unknown OS Platform'),
(20, 1, '4961685110991618048', '2017-04-04 20:50:06', '2017-04-04 21:05:06', '128.119.202.101', 'Unknown Browser', 'Unknown OS Platform'),
(19, 1, '2255130397614538752', '2017-04-04 20:42:12', '2017-04-04 20:57:12', '128.119.202.101', 'Unknown Browser', 'Unknown OS Platform'),
(18, 1, '5912147917463879680', '2017-04-04 20:40:43', '2017-04-04 20:55:43', '128.119.202.101', 'Unknown Browser', 'Unknown OS Platform'),
(17, 1, '8192406476510199808', '2017-04-04 20:39:18', '2017-04-04 20:54:18', '128.119.202.101', 'Unknown Browser', 'Unknown OS Platform'),
(16, 1, '6852389728268845056', '2017-04-04 20:37:59', '2017-04-04 20:52:59', '128.119.202.101', 'Unknown Browser', 'Unknown OS Platform'),
(15, 1, '5336016503252713472', '2017-04-04 20:35:52', '2017-04-04 20:50:52', '128.119.202.101', 'Unknown Browser', 'Unknown OS Platform'),
(14, 1, '3118070777140740096', '2017-04-04 19:51:31', '2017-04-04 20:06:31', '128.119.202.75', 'Unknown Browser', 'Unknown OS Platform'),
(13, 1, '7483281640496562176', '2017-04-04 19:44:56', '2017-04-04 19:59:56', '128.119.202.75', 'Unknown Browser', 'Unknown OS Platform'),
(12, 1, '5565051007316000768', '2017-04-03 17:03:21', '2017-04-03 17:18:21', '128.119.202.99', 'Unknown Browser', 'Unknown OS Platform'),
(11, 1, '5836518289320181760', '2017-04-03 17:02:51', '2017-04-03 17:17:51', '128.119.202.99', 'Unknown Browser', 'Unknown OS Platform'),
(10, 1, '818416897404960768', '2017-04-03 17:01:40', '2017-04-03 17:16:40', '128.119.202.99', 'Unknown Browser', 'Unknown OS Platform'),
(9, 1, '879296448213024768', '2017-04-03 16:54:44', '2017-04-03 17:09:44', '128.119.202.99', 'Unknown Browser', 'Unknown OS Platform'),
(8, 1, '2486294067290308608', '2017-04-03 16:53:05', '0000-00-00 00:00:00', '128.119.202.99', 'Unknown Browser', 'Unknown OS Platform'),
(7, 1, '3819202163620446208', '2017-04-03 16:48:53', '0000-00-00 00:00:00', '128.119.202.99', 'Unknown Browser', 'Unknown OS Platform'),
(6, 1, '3419568088226463744', '2017-03-30 18:31:15', '0000-00-00 00:00:00', '128.119.202.156', 'Unknown Browser', 'Unknown OS Platform'),
(5, 1, '6461740329321103360', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '128.119.202.156', 'Unknown Browser', 'Unknown OS Platform'),
(4, 1, '8552210455425187840', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '128.119.202.156', 'Unknown Browser', 'Unknown OS Platform'),
(3, 1, '8229160586131275776', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '128.119.202.156', 'Unknown Browser', 'Unknown OS Platform'),
(2, 1, '4684701720884805632', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '128.119.202.156', 'Unknown Browser', 'Unknown OS Platform'),
(1, 1, '3591563794511298560', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '128.119.202.166', 'Unknown Browser', 'Unknown OS Platform'),
(37, 1, '1577380645590532096', '2017-04-07 03:25:44', '2017-04-07 03:40:45', '128.119.202.227', 'Unknown Browser', 'Unknown OS Platform'),
(38, 2, '3714113397743157248', '2017-04-07 21:17:13', '2017-04-07 21:32:13', '128.119.202.139', 'Unknown Browser', 'Unknown OS Platform'),
(39, 1, '105559013256593408', '2017-04-10 15:38:26', '2017-04-10 15:53:46', '128.119.202.77', 'Unknown Browser', 'Unknown OS Platform'),
(40, 1, '6834198334157094912', '2017-04-10 20:07:23', '2017-04-10 20:36:07', '128.119.202.148', 'Unknown Browser', 'Unknown OS Platform'),
(41, 1, '1079933852580839424', '2017-04-12 15:37:44', '2017-04-12 15:52:44', '128.119.202.211', 'Unknown Browser', 'Unknown OS Platform'),
(42, 1, '6014068062628610048', '2017-04-12 15:39:18', '2017-04-12 15:54:18', '128.119.202.211', 'Unknown Browser', 'Unknown OS Platform'),
(43, 2, '6946204698915373056', '2017-04-30 21:13:10', '2017-04-30 21:28:11', '128.119.202.110', 'Unknown Browser', 'Unknown OS Platform'),
(44, 2, '6919638427814068224', '2017-04-30 21:24:24', '2017-04-30 21:39:24', '128.119.202.110', 'Unknown Browser', 'Unknown OS Platform'),
(45, 2, '1985104059958296576', '2017-04-30 21:25:46', '2017-04-30 21:40:46', '128.119.202.199', 'Unknown Browser', 'Unknown OS Platform'),
(46, 3, '4475308849590435840', '2017-05-25 19:23:27', '2017-05-25 19:38:27', '71.192.217.207', 'Unknown Browser', 'Unknown OS Platform'),
(47, 2, '5875621265015832576', '2017-06-13 00:44:38', '2017-06-13 00:59:38', '73.38.114.165', 'Unknown Browser', 'Unknown OS Platform'),
(48, 2, '8968615940023386112', '2017-06-20 23:58:36', '2017-06-21 00:13:36', '73.38.114.165', 'Unknown Browser', 'Unknown OS Platform'),
(49, 2, '7097133564843524096', '2017-07-23 01:38:58', '2017-07-23 01:53:58', '73.38.114.165', 'Unknown Browser', 'Unknown OS Platform'),
(50, 1, '4263667713240465408', '2017-08-16 19:54:48', '2017-08-16 20:12:00', '73.38.114.165', 'Unknown Browser', 'Unknown OS Platform'),
(51, 1, '511984381133324288', '2017-08-17 15:42:44', '2017-08-17 15:57:48', '107.77.70.75', 'Unknown Browser', 'Unknown OS Platform'),
(52, 1, '7873887247957753856', '2017-08-17 23:13:07', '2017-08-17 23:28:07', '73.38.114.165', 'Unknown Browser', 'Unknown OS Platform');

-- --------------------------------------------------------

--
-- Table structure for table `global_vars`
--

CREATE TABLE `global_vars` (
  `id` int(11) NOT NULL,
  `var` varchar(100) NOT NULL,
  `value` varchar(512) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `global_vars`
--

INSERT INTO `global_vars` (`id`, `var`, `value`) VALUES
(1, 'key_expiration_mins', '15');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first-name` varchar(50) NOT NULL,
  `last-name` varchar(50) NOT NULL,
  `enrollment-year` int(4) NOT NULL,
  `graduation-year` int(4) NOT NULL,
  `graduated` tinyint(1) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `slack-username` varchar(50) NOT NULL,
  `github-username` varchar(50) NOT NULL,
  `trello-username` varchar(50) NOT NULL,
  `linked_in-username` varchar(50) NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_login_ip` varchar(50) NOT NULL,
  `key_id` int(11) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `failed_login_attempts` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `password`, `first-name`, `last-name`, `enrollment-year`, `graduation-year`, `graduated`, `email`, `phone`, `slack-username`, `github-username`, `trello-username`, `linked_in-username`, `last_login`, `last_login_ip`, `key_id`, `deleted`, `locked`, `failed_login_attempts`) VALUES
(1, 'tekelleher', 'test', 'Tom', 'Kelleher', 2016, 2020, 0, 'tekelleher@umass.edu', '5086854448', '', '', '', '', '2017-08-17 23:13:07', '73.38.114.165', 52, 0, 0, 0),
(2, 'test', 'test', 'test', '', 0, 0, 0, '', '', '', '', '', '', '2017-07-23 01:38:58', '73.38.114.165', 49, 0, 0, 0),
(3, 'dbrickell', 'dbrickell', 'Dan', 'Brickell', 2015, 2018, 0, 'dbrickell@umass.edu', '', '', '', '', '', '2017-05-25 19:23:27', '71.192.217.207', 46, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `short-desc` varchar(50) NOT NULL,
  `long-desc` longtext NOT NULL,
  `name` text NOT NULL,
  `company` int(11) NOT NULL,
  `team` int(11) NOT NULL,
  `github-project` text NOT NULL,
  `trello-board` text NOT NULL,
  `project-lead` int(11) NOT NULL,
  `img_url` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `short-desc`, `long-desc`, `name`, `company`, `team`, `github-project`, `trello-board`, `project-lead`, `img_url`, `active`) VALUES
(2, 'Minute Code Dev Portal', 'Minute Code Dev Portal', 'Dev Portal', 0, 1, 'https://github.com/umassminutecode/devportal', 'https://trello.com/b/x1fNSDvv/minutecode-org', 1, 'mcdevportal.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_keys`
--
ALTER TABLE `auth_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `global_vars`
--
ALTER TABLE `global_vars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_keys`
--
ALTER TABLE `auth_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `global_vars`
--
ALTER TABLE `global_vars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
