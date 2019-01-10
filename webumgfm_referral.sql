-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 05, 2019 at 05:48 AM
-- Server version: 10.1.37-MariaDB-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webumgfm_referral`
--

-- --------------------------------------------------------

--
-- Table structure for table `refer`
--

CREATE TABLE `refer` (
  `sn` int(11) NOT NULL,
  `inviter` varchar(200) NOT NULL,
  `refer` varchar(200) NOT NULL,
  `date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `refer`
--

INSERT INTO `refer` (`sn`, `inviter`, `refer`, `date`) VALUES
(49, 'JainArgh@twitter.com', 'skantjain1@gmail.com', '2019-01-05 08:43:58.500952'),
(48, '', 'JainArgh@twitter.com', '2019-01-05 08:43:19.290223'),
(47, '', 'hooligansofts@gmail.com', '2019-01-05 07:28:47.732516'),
(46, 'akanshu@hooklabs.io', '9891023022.vj@gmail.com', '2019-01-05 06:59:11.550584'),
(45, '', 'akanshu@hooklabs.io', '2019-01-05 06:57:05.405097'),
(44, 'vibhor@getinfino.com', 'akanshu@kaizen.vc', '2019-01-05 06:53:28.337391'),
(43, '', 'vibhor@getinfino.com', '2019-01-05 06:52:36.785168'),
(42, '', 'pankajmittal496@gmail.com', '2019-01-05 06:51:45.652727'),
(41, '', 'undefined', '2019-01-05 06:41:35.882628'),
(40, '', 'codegente@gmail.com', '2019-01-05 06:31:32.290151'),
(39, '', 'cryptoheadd@twitter.com', '2019-01-05 06:29:22.894287'),
(38, '', 'undefined', '2019-01-05 06:28:15.610632'),
(37, 'vibhorvjjain@gmail.com', 'akanshu@getinfino.com', '2019-01-05 06:26:25.504058'),
(36, 'vibhorvjjain@gmail.com', 'akanshujain@gmail.com', '2019-01-05 06:20:04.812087'),
(35, '', 'vibhorvjjain@gmail.com', '2019-01-05 06:18:38.247742'),
(34, '', 'pankaz@codegente.com', '2019-01-05 06:18:12.671066'),
(50, 'JainArgh@twitter.com', 'admin@kaizen.vc', '2019-01-05 08:46:16.765680'),
(51, 'vibhor@getinfino.com', 'jay03intl@gmail.com', '2019-01-05 08:49:51.060703'),
(52, 'admin@kaizen.vc', 'vibhorjain03@outlook.com', '2019-01-05 08:51:50.651123'),
(53, '', 'support@codegente.com', '2019-01-05 09:19:16.991766'),
(54, '', 'pankazkumarofficial@gmail.com', '2019-01-05 09:20:01.520536'),
(55, '', 'a@z.z', '2019-01-05 09:21:37.409859'),
(56, '', 'alessandro_tc@twitter.com', '2019-01-05 09:38:48.708783'),
(57, '', '', '2019-01-05 09:48:28.055768'),
(58, '', 'hello@vibhorja.in', '2019-01-05 09:52:51.823023'),
(59, '', 'alessandro@kaizen.vc', '2019-01-05 09:55:28.034179'),
(60, 'hello@vibhorja.in', 'aletc.made@gmail.com', '2019-01-05 09:59:51.638748'),
(61, '', 'getinfino@gmail.com', '2019-01-05 10:12:17.186098'),
(62, '', 'getinfino@gmail.com', '2019-01-05 10:13:15.356463'),
(63, 'pankazkumarofficial@gmail.com', 'codegente@gmail.com', '2019-01-05 10:37:36.701447'),
(64, 'admin@kaizen.vc', 'akanshu@mailinator.com', '2019-01-05 10:44:57.035522');

-- --------------------------------------------------------

--
-- Table structure for table `reward`
--

CREATE TABLE `reward` (
  `sn` int(11) NOT NULL,
  `email` varchar(300) NOT NULL,
  `date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `sn` int(10) NOT NULL,
  `email` varchar(200) NOT NULL,
  `name` varchar(150) NOT NULL,
  `id` varchar(10) NOT NULL,
  `date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `verify` varchar(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`sn`, `email`, `name`, `id`, `date`, `verify`) VALUES
(97, 'codegente@gmail.com', 'codegente', '46130515', '2019-01-05 10:37:36.700625', '1'),
(73, 'cryptoheadd@twitter.com', 'Vibhor Jain', '81443565', '2019-01-05 06:29:22.893714', '1'),
(75, 'undefined', 'undefined', '56272849', '2019-01-05 06:41:35.882370', '1'),
(71, 'akanshu@getinfino.com', 'akanshu', '89915670', '2019-01-05 06:26:41.103419', '1'),
(70, 'akanshujain@gmail.com', 'akanshu', '65788460', '2019-01-05 06:20:40.100314', '1'),
(69, 'vibhorvjjain@gmail.com', 'Vibhor Jain', '57165313', '2019-01-05 06:18:38.247206', '1'),
(68, 'pankaz@codegente.com', 'Pankaz Kumar Mittal', '88047807', '2019-01-05 06:18:12.670646', '1'),
(76, 'pankajmittal496@gmail.com', 'Pankaj Mittal', '82141723', '2019-01-05 06:51:45.651897', '1'),
(77, 'vibhor@getinfino.com', 'Vibhor Jain', '28734287', '2019-01-05 06:52:36.784509', '1'),
(78, 'akanshu@kaizen.vc', 'Akanshu Jain', '21327447', '2019-01-05 06:53:28.336800', '1'),
(79, 'akanshu@hooklabs.io', 'akanshu Jain', '13663060', '2019-01-05 06:57:05.402571', '1'),
(80, '9891023022.vj@gmail.com', 'Vibhor Jain', '13831288', '2019-01-05 06:59:11.549135', '1'),
(81, 'hooligansofts@gmail.com', 'Depender', '78269338', '2019-01-05 07:30:07.634188', '1'),
(82, 'JainArgh@twitter.com', 'Akanshu ( Í¡Â° ÍœÊ– Í¡Â°) ðŸ¶', '42713994', '2019-01-05 08:43:19.289050', '1'),
(83, 'skantjain1@gmail.com', 's kant jain', '50000086', '2019-01-05 08:43:58.500179', '1'),
(84, 'admin@kaizen.vc', 'Admin Domain', '57441221', '2019-01-05 08:46:16.764224', '1'),
(85, 'jay03intl@gmail.com', 'Jay 03', '23439616', '2019-01-05 08:49:51.059738', '1'),
(86, 'vibhorjain03@outlook.com', 'Vibhor Jain', '80802851', '2019-01-05 08:51:50.650780', '0'),
(87, 'support@codegente.com', 'pankaz mittal', '17871756', '2019-01-05 09:19:16.988131', '0'),
(88, 'pankazkumarofficial@gmail.com', 'pankaz mittal', '27008106', '2019-01-05 09:20:01.518656', '0'),
(89, 'a@z.z', 'gbvdcdc', '74348236', '2019-01-05 09:21:37.408799', '0'),
(90, 'alessandro_tc@twitter.com', 'Alessandro Tenconi', '90392209', '2019-01-05 09:38:48.707693', '1'),
(91, '', '', '72103285', '2019-01-05 09:48:28.055421', '0'),
(92, 'hello@vibhorja.in', 'Vibhor Jain', '63482275', '2019-01-05 09:52:51.820308', '1'),
(93, 'alessandro@kaizen.vc', 'ale', '50862140', '2019-01-05 09:57:18.172516', '1'),
(94, 'aletc.made@gmail.com', 'Alessandro Doge', '94752382', '2019-01-05 09:59:51.637327', '0'),
(95, 'getinfino@gmail.com', 'Vibhor', '60983531', '2019-01-05 10:12:17.185129', '1'),
(98, 'akanshu@mailinator.com', 'akanshu', '68548364', '2019-01-05 10:44:57.033890', '1');

-- --------------------------------------------------------

--
-- Table structure for table `verify`
--

CREATE TABLE `verify` (
  `sn` int(11) NOT NULL,
  `email` varchar(300) NOT NULL,
  `otp` varchar(200) NOT NULL,
  `date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `verify`
--

INSERT INTO `verify` (`sn`, `email`, `otp`, `date`) VALUES
(2, 'akanshujain@gmail.com', 'VER391595181051d3codeGenteYcsR', '2019-01-05 06:20:04.813427'),
(3, 'akanshu@getinfino.com', 'VER117320367564d3codeGenteYcsR', '2019-01-05 06:26:25.504600'),
(4, 'hooligansofts@gmail.com', 'VER286974441296d3codeGenteYcsR', '2019-01-05 07:28:47.733871'),
(5, 'vibhorjain03@outlook.com', 'VER756711860595d3codeGenteYcsR', '2019-01-05 08:51:50.651757'),
(6, 'support@codegente.com', 'VER865000317563d3codeGenteYcsR', '2019-01-05 09:19:16.992306'),
(7, 'pankazkumarofficial@gmail.com', 'VER233524411014d3codeGenteYcsR', '2019-01-05 09:20:01.521348'),
(8, 'a@z.z', 'VER752492862185d3codeGenteYcsR', '2019-01-05 09:21:37.410397'),
(9, '', 'VER736155699804d3codeGenteYcsR', '2019-01-05 09:48:28.056036'),
(10, 'alessandro@kaizen.vc', 'VER977123798227d3codeGenteYcsR', '2019-01-05 09:55:28.035576'),
(11, 'aletc.made@gmail.com', 'VER477701875679d3codeGenteYcsR', '2019-01-05 09:59:51.639031'),
(12, 'getinfino@gmail.com', 'VER653863972872d3cOdeGentePh', '2019-01-05 10:11:46.304423'),
(14, 'codegente@gmail.com', 'VER800648393368d3cOdeGenteP88', '2019-01-05 10:37:15.171386'),
(15, 'akanshu@mailinator.com', 'VER712572538343d3cOdeGenteP84', '2019-01-05 10:44:38.443251');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `refer`
--
ALTER TABLE `refer`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `reward`
--
ALTER TABLE `reward`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `verify`
--
ALTER TABLE `verify`
  ADD PRIMARY KEY (`sn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `refer`
--
ALTER TABLE `refer`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `reward`
--
ALTER TABLE `reward`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `sn` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `verify`
--
ALTER TABLE `verify`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
