-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2019 at 07:37 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crainlyc_crainly`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chat`
--

CREATE TABLE `tbl_chat` (
  `id` int(11) NOT NULL,
  `mem_one` int(11) NOT NULL,
  `mem_two` int(11) NOT NULL,
  `time` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_chat`
--

INSERT INTO `tbl_chat` (`id`, `mem_one`, `mem_two`, `time`) VALUES
(1, 2, 1, 1555584747),
(2, 3, 1, 1555583980),
(3, 2, 3, 1558351304),
(4, 4, 3, 1555583980),
(5, 14, 13, 1558356157),
(6, 2, 13, 1559561593),
(7, 16, 3, 1559851735),
(8, 15, 3, 1560293323),
(9, 18, 17, 1562852094),
(10, 17, 18, 1561727733),
(11, 18, 17, 1561727899),
(12, 18, 17, 1561727906),
(13, 17, 18, 1561727909),
(14, 18, 17, 1561727925),
(15, 17, 18, 1561727992),
(16, 18, 17, 1561728004),
(17, 17, 18, 1561728033),
(18, 19, 20, 1561728321),
(19, 20, 19, 1561728348),
(20, 19, 20, 1561728401),
(21, 19, 20, 1561728497),
(22, 18, 17, 1561728808),
(23, 17, 18, 1561728821),
(24, 17, 18, 1561729189),
(25, 18, 17, 1561729196),
(26, 18, 17, 1561729586),
(27, 17, 18, 1561729593),
(28, 17, 18, 1561729604),
(29, 18, 17, 1561957303),
(30, 18, 17, 1561957660),
(31, 17, 18, 1561957674),
(32, 18, 17, 1561957685),
(33, 17, 18, 1561957699),
(34, 18, 17, 1561968743),
(35, 18, 17, 1561969402),
(36, 17, 18, 1561969426),
(37, 19, 20, 1562043253),
(38, 19, 20, 1562043259),
(39, 20, 19, 1562043266),
(40, 19, 20, 1562043454),
(41, 19, 20, 1562043574),
(42, 19, 20, 1562043754),
(43, 19, 20, 1562044555),
(44, 20, 19, 1562046455),
(45, 19, 20, 1562046472),
(46, 19, 20, 1562046607),
(47, 17, 18, 1562068182),
(48, 18, 17, 1562068298),
(49, 18, 17, 1562138280),
(50, 17, 18, 1562139007),
(51, 17, 18, 1562142143),
(52, 18, 17, 1562142155),
(53, 18, 17, 1562142170),
(54, 17, 18, 1562142177),
(55, 17, 18, 1562142852),
(56, 17, 18, 1562142852),
(57, 17, 18, 1562144097),
(58, 18, 17, 1562144103),
(59, 17, 18, 1562144109),
(60, 18, 17, 1562144109),
(61, 17, 18, 1562144250),
(62, 18, 17, 1562144317),
(63, 17, 18, 1562144333),
(64, 18, 17, 1562144336),
(65, 17, 18, 1562144373),
(66, 18, 17, 1562144422),
(67, 18, 17, 1562144423),
(68, 17, 18, 1562144443),
(69, 17, 18, 1562144460),
(70, 17, 18, 1562144469),
(71, 18, 17, 1562144485),
(72, 17, 18, 1562144791),
(73, 17, 18, 1562144803),
(74, 19, 20, 1562144959),
(75, 19, 20, 1562144960),
(76, 19, 20, 1562144962),
(77, 19, 20, 1562144971),
(78, 21, 22, 1562146645),
(79, 21, 22, 1562146669),
(80, 22, 21, 1562146693),
(81, 21, 22, 1562147830),
(82, 21, 22, 1562147915),
(83, 21, 22, 1562148023),
(84, 22, 21, 1562148033),
(85, 21, 22, 1562148156),
(86, 21, 22, 1562148183),
(87, 21, 22, 1562148244),
(88, 21, 22, 1562148330),
(89, 21, 22, 1562150100),
(90, 21, 22, 1562151414),
(91, 21, 22, 1562151474),
(92, 22, 21, 1562151755),
(93, 21, 22, 1562152065),
(94, 22, 21, 1562152075),
(95, 22, 21, 1562152088),
(96, 21, 22, 1562152121),
(97, 22, 21, 1562152130),
(98, 22, 21, 1562152388),
(99, 20, 19, 1562153883),
(100, 19, 20, 1562153900),
(101, 19, 20, 1562154029),
(102, 19, 20, 1562155612),
(103, 17, 18, 1562238886),
(104, 17, 18, 1562239845),
(105, 18, 17, 1562239846),
(106, 17, 18, 1562239865),
(107, 17, 18, 1562240077),
(108, 17, 18, 1562248583),
(109, 17, 18, 1562248591),
(110, 18, 17, 1562248602),
(111, 17, 18, 1562248638),
(112, 17, 18, 1562248802),
(113, 19, 20, 1562302888),
(114, 19, 20, 1562302925),
(115, 22, 21, 1562312444),
(116, 21, 22, 1562312449),
(117, 22, 21, 1562312460),
(118, 21, 22, 1562312478),
(119, 22, 21, 1562312479),
(120, 21, 22, 1562312488),
(121, 22, 21, 1562312537),
(122, 21, 22, 1562312548),
(123, 22, 21, 1562312569),
(124, 21, 22, 1562312576),
(125, 22, 21, 1562312612),
(126, 21, 22, 1562312629),
(127, 22, 21, 1562312654),
(128, 22, 21, 1562312698),
(129, 21, 22, 1562312721),
(130, 22, 21, 1562312729),
(131, 22, 21, 1562312774),
(132, 22, 21, 1562312810),
(133, 21, 22, 1562320084),
(134, 22, 21, 1562320093),
(135, 21, 22, 1562323245),
(136, 21, 22, 1562323264),
(137, 21, 22, 1562323273),
(138, 21, 22, 1562323580),
(139, 22, 21, 1562323592),
(140, 22, 21, 1562329032),
(141, 22, 21, 1562329039),
(142, 21, 22, 1562329050),
(143, 22, 21, 1562329187),
(144, 21, 22, 1562329192),
(145, 17, 18, 1562331312),
(146, 18, 17, 1562331333),
(147, 17, 18, 1562331333),
(148, 17, 18, 1562331373),
(149, 17, 18, 1562331394),
(150, 17, 18, 1562332384),
(151, 18, 17, 1562332400),
(152, 18, 17, 1562333026),
(153, 18, 17, 1562568413),
(154, 20, 19, 1562572537),
(155, 19, 20, 1562572543),
(156, 19, 20, 1562572680),
(157, 20, 19, 1562572696),
(158, 19, 20, 1562581316),
(159, 20, 19, 1562660459),
(160, 19, 20, 1562660470),
(161, 20, 19, 1562660510),
(162, 19, 20, 1562660525),
(163, 19, 20, 1562660535),
(164, 19, 20, 1562668438),
(165, 20, 19, 1562668446),
(166, 19, 20, 1562668451),
(167, 21, 22, 1562668623),
(168, 22, 21, 1562668636),
(169, 21, 22, 1562668642),
(170, 21, 22, 1562668653),
(171, 22, 21, 1562668685),
(172, 22, 21, 1562668766),
(173, 21, 22, 1562668823),
(174, 21, 22, 1562668833),
(175, 22, 21, 1562668845),
(176, 21, 22, 1562668957),
(177, 21, 22, 1562668964),
(178, 21, 22, 1562668977),
(179, 21, 22, 1562669003),
(180, 21, 22, 1562669014),
(181, 21, 22, 1562669026),
(182, 22, 21, 1562669043),
(183, 22, 21, 1562669064),
(184, 21, 22, 1562669074),
(185, 22, 21, 1562673514),
(186, 22, 21, 1562673808),
(187, 21, 22, 1562673822),
(188, 17, 18, 1562677859),
(189, 20, 19, 1562744204),
(190, 20, 19, 1562744238),
(191, 19, 20, 1562744247),
(192, 20, 19, 1562744270),
(193, 19, 20, 1562768576),
(194, 19, 20, 1562768592),
(195, 19, 20, 1562768616),
(196, 19, 20, 1562769128),
(197, 19, 20, 1562826462),
(198, 19, 20, 1562826524),
(199, 19, 20, 1562826667),
(200, 19, 20, 1562826678),
(201, 18, 17, 1562827764),
(202, 21, 22, 1562831938),
(203, 22, 21, 1562831945),
(204, 21, 22, 1562832262),
(205, 21, 22, 1562832263),
(206, 21, 22, 1562832277),
(207, 22, 21, 1562832292),
(208, 21, 22, 1562832313),
(209, 21, 22, 1562835762),
(210, 21, 22, 1562835770),
(211, 22, 21, 1562835779),
(212, 18, 17, 1562836908),
(213, 18, 17, 1562836937),
(214, 22, 21, 1562839337),
(215, 20, 19, 1562850436),
(216, 19, 20, 1562850455),
(217, 19, 20, 1562850534),
(218, 20, 19, 1562850970),
(219, 19, 20, 1562851031),
(220, 19, 20, 1562851040),
(221, 20, 19, 1562851045),
(222, 19, 20, 1562852964),
(223, 19, 20, 1562852981),
(224, 20, 19, 1562853037),
(225, 19, 20, 1562853166),
(226, 19, 20, 1562853209),
(227, 20, 19, 1562853393),
(228, 17, 18, 1562866984),
(229, 17, 18, 1562866992),
(230, 17, 18, 1562903297),
(231, 21, 22, 1562911663),
(232, 22, 21, 1562911684),
(233, 21, 22, 1562911722),
(234, 18, 17, 1562933077),
(235, 18, 17, 1562933835),
(236, 17, 18, 1562933843),
(237, 20, 19, 1562938061),
(238, 21, 22, 1562941415),
(239, 21, 22, 1562942599),
(240, 22, 21, 1563007499),
(241, 22, 21, 1563007553),
(242, 17, 18, 1563243197),
(243, 18, 17, 1563243202),
(244, 18, 17, 1563298753),
(245, 18, 17, 1563345741),
(246, 17, 18, 1563345778),
(247, 17, 18, 1563346814),
(248, 17, 18, 1563360774),
(249, 17, 18, 1563365620),
(250, 18, 17, 1563429759),
(251, 17, 18, 1563430063),
(252, 17, 18, 1563430723),
(253, 17, 18, 1563430765),
(254, 17, 18, 1563430772),
(255, 18, 17, 1563431062),
(256, 18, 17, 1563431073),
(257, 18, 17, 1563431079),
(258, 18, 17, 1563431182),
(259, 17, 18, 1563453517),
(260, 17, 18, 1563458243),
(261, 17, 18, 1563373835),
(262, 17, 18, 1563458125),
(263, 18, 17, 1563873605),
(264, 18, 17, 1563878426),
(265, 18, 17, 0),
(266, 18, 17, 0),
(267, 18, 17, 0),
(268, 18, 17, 1564145863),
(269, 18, 17, 1564145925),
(270, 18, 17, 1564145979),
(271, 17, 18, 1564146114),
(272, 18, 17, 1564146309),
(273, 18, 17, 1564146320),
(274, 18, 17, 1564146324),
(275, 17, 18, 1564146943),
(276, 18, 17, 1564146948),
(277, 17, 18, 1564147332),
(278, 17, 18, 1564147372),
(279, 17, 18, 1564147587),
(280, 17, 18, 1564147617),
(281, 17, 18, 1564147633),
(282, 17, 18, 1564147687),
(283, 17, 18, 1564147697),
(284, 17, 18, 1564147725),
(285, 17, 18, 1564148501),
(286, 18, 17, 1564148516),
(287, 18, 17, 1564149451),
(288, 18, 17, 1564149540),
(289, 18, 17, 1564149641),
(290, 17, 18, 1564149708),
(291, 17, 18, 1564204057),
(292, 17, 18, 1564204070),
(293, 17, 18, 1564204073),
(294, 17, 18, 1564204076),
(295, 17, 18, 1564204276),
(296, 17, 18, 1564204425),
(297, 17, 18, 1564204466),
(298, 17, 18, 1564204519),
(299, 17, 18, 1564205552),
(300, 17, 18, 1564205627),
(301, 17, 18, 1564205707),
(302, 18, 17, 1564205825),
(303, 18, 17, 1564205934),
(304, 18, 17, 1564206014),
(305, 18, 17, 1564206140),
(306, 18, 17, 1564206312),
(307, 18, 17, 1564206996),
(308, 18, 17, 1564207148),
(309, 18, 17, 1564207194),
(310, 18, 17, 1564210774),
(311, 17, 18, 1564210781),
(312, 18, 17, 1564210791),
(313, 17, 18, 1564232022),
(314, 17, 18, 1564232134),
(315, 18, 17, 1564232153),
(316, 17, 18, 1564377796),
(317, 18, 17, 1564378744),
(318, 18, 17, 1564382771),
(319, 17, 18, 1564383232),
(320, 18, 17, 1564384484),
(321, 18, 17, 1564384597),
(322, 17, 18, 1564384933),
(323, 17, 18, 1564384940),
(324, 17, 18, 1564385004),
(325, 17, 18, 1564385010),
(326, 18, 17, 1564385104),
(327, 18, 17, 1564385315),
(328, 18, 17, 1564385407),
(329, 18, 17, 1564385451),
(330, 18, 17, 1564385479),
(331, 18, 17, 1564385508),
(332, 18, 17, 1564386227),
(333, 18, 17, 1564386293),
(334, 18, 17, 1564386301),
(335, 18, 17, 1564386315),
(336, 18, 17, 1564386330),
(337, 18, 17, 1564386333),
(338, 18, 17, 1564386342),
(339, 18, 17, 1564386381),
(340, 18, 17, 1564386389),
(341, 18, 17, 1564386501),
(342, 18, 17, 1564386564),
(343, 18, 17, 1564386568),
(344, 18, 17, 1564386594),
(345, 18, 17, 1564386597),
(346, 18, 17, 1564386606),
(347, 18, 17, 1564386611),
(348, 18, 17, 1564386614),
(349, 17, 18, 1564392192),
(350, 17, 18, 1564392235),
(351, 17, 18, 1564392242),
(352, 17, 18, 1564392249),
(353, 17, 18, 1564392255),
(354, 17, 18, 1564392268),
(355, 18, 17, 1564392283),
(356, 18, 17, 1564392286),
(357, 18, 17, 1564392289),
(358, 18, 17, 1564392292),
(359, 17, 18, 1564392387),
(360, 17, 18, 1564469171),
(361, 17, 18, 1564469212),
(362, 17, 18, 1564469431),
(363, 18, 17, 1564469476),
(364, 18, 17, 1564469600),
(365, 17, 18, 1564469669),
(366, 17, 18, 1564469751),
(367, 17, 18, 1564470472),
(368, 17, 18, 1564470495),
(369, 17, 18, 1564478081),
(370, 17, 18, 1564485661),
(371, 17, 18, 1564485684),
(372, 18, 17, 1564494279),
(373, 18, 17, 1564494301),
(374, 18, 17, 1564550627),
(375, 22, 21, 1564551699),
(376, 20, 19, 1564551805),
(377, 20, 19, 1564551864),
(378, 22, 21, 1564551939),
(379, 17, 18, 1564651381),
(380, 21, 22, 1570619607),
(381, 22, 21, 1570619616),
(382, 22, 21, 1570620092),
(383, 21, 22, 1570620277),
(384, 21, 22, 1570620309),
(385, 21, 22, 1570620397),
(386, 22, 21, 1570620403),
(387, 21, 22, 1570685171),
(388, 21, 22, 1570685242),
(389, 22, 21, 1570685251),
(390, 22, 21, 1570685272),
(391, 21, 22, 1570685279),
(392, 21, 22, 1570685325),
(393, 21, 22, 1570685438),
(394, 21, 22, 1570685470),
(395, 22, 21, 1570685506),
(396, 22, 21, 1570690427),
(397, 22, 21, 1570690465),
(398, 21, 22, 1570691113),
(399, 21, 22, 1570691209),
(400, 21, 22, 1570691258);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chat_attachments`
--

CREATE TABLE `tbl_chat_attachments` (
  `id` int(11) NOT NULL,
  `msg_id` int(11) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `att_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_chat_attachments`
--

INSERT INTO `tbl_chat_attachments` (`id`, `msg_id`, `attachment`, `att_name`) VALUES
(1, 29, '82489c9737cc245530c7a6ebef3753ec_1551954626_2707.jpg', '5.jpg'),
(2, 30, '19f3cd308f1455b3fa09a282e0d496f4_1551957512_7457.jpg', '6.jpg'),
(3, 30, '13f3cf8c531952d72e5847c4183e6910_1551957512_6966.jpg', '7.jpg'),
(4, 109, '2421fcb1263b9530df88f7f002e78ea5_1560293321_2111.png', 'Screen Shot 2019-06-06 at 1.09.59 PM.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chat_lessons`
--

CREATE TABLE `tbl_chat_lessons` (
  `mem_id` int(11) NOT NULL,
  `msg_id` int(11) NOT NULL,
  `txt` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_chat_lessons`
--

INSERT INTO `tbl_chat_lessons` (`mem_id`, `msg_id`, `txt`) VALUES
(3, 58, '<a href=\"javascript:void(0)\" class=\"blk lessonLnk view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365p4x2\">Student Khan scheduled a lesson<span class=\"date\">click to view</span></a>'),
(2, 58, '<a href=\"javascript:void(0)\" class=\"blk lessonLnk view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365p4x2\">You requested a lesson<span class=\"date\">click to view</span></a>'),
(2, 61, '<a href=\"javascript:void(0)\" class=\"blk lessonLnk view-detail\" data-store=\"g5d3m3m4k365p4x2\" data-link=\"get-request-detail\"><strong>Tutor Khan</strong> Accepted your request!\r\n                            <span class=\"date\">click to book lesson</span>\r\n                        </a>'),
(2, 62, '<a href=\"javascript:void(0)\" class=\"blk lessonLnk view-detail\" data-store=\"g5d3m3m4k365p4x2\" data-link=\"get-request-detail\"><strong>Tutor Khan</strong> Accepted your request!\r\n                            <span class=\"date\">click to book lesson</span>\r\n                        </a>'),
(2, 73, '<a href=\"javascript:void(0)\" class=\"blk lessonLnk view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365t4v4\"><strong>Tutor Khan</strong> scheduled a lesson for you<span class=\"date\">click to view</span></a>'),
(3, 73, '<a href=\"javascript:void(0)\" class=\"blk lessonLnk view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365t4v4\">You schedule a lesson<span class=\"date\">click to view</span></a>'),
(2, 87, '<a href=\"javascript:void(0)\" class=\"blk lessonLnk view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365t4w4\"><strong>Tutor Khan</strong> scheduled a lesson for you<span class=\"date\">click to view</span></a>'),
(3, 87, '<a href=\"javascript:void(0)\" class=\"blk lessonLnk view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365t4w4\">You schedule a lesson<span class=\"date\">click to view</span></a>'),
(14, 95, '<a href=\"javascript:void(0)\" class=\"blk lessonLnk view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365t4x4\"><strong>Jahanzaib Khalid</strong> scheduled a lesson for you<span class=\"date\">click to view</span></a>'),
(13, 95, '<a href=\"javascript:void(0)\" class=\"blk lessonLnk view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365t4x4\">You schedule a lesson<span class=\"date\">click to view</span></a>'),
(2, 98, '<a href=\"javascript:void(0)\" class=\"blk lessonLnk view-detail\" data-store=\"g5d3m3m4k365t4w2\" data-link=\"get-request-detail\"><strong>Student Khan</strong> Accepted your request!<span class=\"date\">click to book lesson</span></a>'),
(2, 99, '<a href=\"javascript:void(0)\" class=\"blk lessonLnk view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365t4x2\"><strong>Jahanzaib Khalid</strong> scheduled a lesson for you<span class=\"date\">click to view</span></a>'),
(13, 99, '<a href=\"javascript:void(0)\" class=\"blk lessonLnk view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365t4x2\">You schedule a lesson<span class=\"date\">click to view</span></a>'),
(2, 100, '<a href=\"javascript:void(0)\" class=\"blk lessonLnk view-detail\" data-store=\"g5d3m3m4k365t4y2\" data-link=\"get-request-detail\"><strong>Student Khan</strong> Accepted your request!<span class=\"date\">click to book lesson</span></a>'),
(16, 103, '<a href=\"javascript:void(0)\" class=\"blk lessonLnk view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365x4u4\"><strong>Tutor K.</strong> scheduled a lesson for you<span class=\"date\">click to view</span></a>'),
(3, 103, '<a href=\"javascript:void(0)\" class=\"blk lessonLnk view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365x4u4\">You schedule a lesson<span class=\"date\">click to view</span></a>'),
(3, 104, '<a href=\"javascript:void(0)\" class=\"blk lessonLnk view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365x4x4\"><strong>Ahmad K.</strong> scheduled a lesson<span class=\"date\">click to view</span></a>'),
(15, 104, '<a href=\"javascript:void(0)\" class=\"blk lessonLnk view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365x4x4\">You requested a lesson<span class=\"date\">click to view</span></a>'),
(3, 105, '<a href=\"javascript:void(0)\" class=\"blk lessonLnk view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365x4v2\"><strong>Ahmad K.</strong> scheduled a lesson<span class=\"date\">click to view</span></a>'),
(15, 105, '<a href=\"javascript:void(0)\" class=\"blk lessonLnk view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365x4v2\">You requested a lesson<span class=\"date\">click to view</span></a>'),
(3, 106, '<a href=\"javascript:void(0)\" class=\"blk lessonLnk view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365x4w2\"><strong>Ahmad K.</strong> scheduled a lesson<span class=\"date\">click to view</span></a>'),
(15, 106, '<a href=\"javascript:void(0)\" class=\"blk lessonLnk view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365x4w2\">You requested a lesson<span class=\"date\">click to view</span></a>'),
(3, 107, '<a href=\"javascript:void(0)\" class=\"blk lessonLnk view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365x4x2\"><strong>Ahmad K.</strong> scheduled a lesson<span class=\"date\">click to view</span></a>'),
(15, 107, '<a href=\"javascript:void(0)\" class=\"blk lessonLnk view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365x4x2\">You requested a lesson<span class=\"date\">click to view</span></a>'),
(15, 108, '<a href=\"javascript:void(0)\" class=\"blk lessonLnk view-detail\" data-store=\"g5d3m3m4k365x4v2\" data-link=\"get-request-detail\"><strong>Tutor K.</strong> Accepted your request!<span class=\"date\">click to book lesson</span></a>');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chat_msgs`
--

CREATE TABLE `tbl_chat_msgs` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL DEFAULT '0',
  `chat_id` int(11) NOT NULL,
  `msg` longtext NOT NULL,
  `msg_type` enum('msg','lesson','attachment') NOT NULL DEFAULT 'msg',
  `no_deleted` varchar(100) DEFAULT NULL,
  `time` int(15) NOT NULL,
  `status` enum('new','seen') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_chat_msgs`
--

INSERT INTO `tbl_chat_msgs` (`id`, `sender_id`, `chat_id`, `msg`, `msg_type`, `no_deleted`, `time`, `status`) VALUES
(1, 3, 2, 'hi', 'msg', '1,3', 1548846981, 'seen'),
(2, 1, 2, 'bye', 'msg', '3,1', 1548846999, 'seen'),
(3, 1, 2, 'ok', 'msg', '3,1', 1548847004, 'seen'),
(4, 1, 2, 'go to hell', 'msg', '3,1', 1548847015, 'seen'),
(5, 1, 2, 'why', 'msg', '3,1', 1548847018, 'seen'),
(6, 3, 2, 'as you wish ', 'msg', '1,3', 1548847024, 'seen'),
(7, 3, 2, 'ok', 'msg', '1,3', 1548847029, 'seen'),
(8, 3, 2, 'why', 'msg', '1,3', 1548847033, 'seen'),
(9, 1, 2, 'cz i told you', 'msg', '3,1', 1548847045, 'seen'),
(10, 3, 2, 'who are you man', 'msg', '1,3', 1548847432, 'seen'),
(11, 1, 2, 'why i told you', 'msg', '3,1', 1548847504, 'seen'),
(12, 3, 2, 'cuz i am asking', 'msg', '1,3', 1548847510, 'seen'),
(13, 3, 2, 'don&#039;t you hear that', 'msg', '1,3', 1548847516, 'seen'),
(14, 3, 2, 'who the hell are you man', 'msg', '1,3', 1548847526, 'seen'),
(15, 1, 2, 'shutup', 'msg', '3,1', 1548847529, 'seen'),
(16, 3, 2, 'mind you language', 'msg', '1,3', 1548847540, 'seen'),
(17, 1, 2, 'go to jahan', 'msg', '3,1', 1548847550, 'seen'),
(18, 1, 2, '*jahanm', 'msg', '3,1', 1548847661, 'seen'),
(19, 3, 2, 'why i go to jahanm', 'msg', '1,3', 1548848458, 'seen'),
(20, 1, 2, 'cz you placed there', 'msg', '3,1', 1548848523, 'seen'),
(21, 3, 2, 'you are dumb', 'msg', '1,3', 1548848598, 'seen'),
(22, 1, 2, 'you also', 'msg', '3,1', 1548848606, 'seen'),
(23, 3, 2, 'fine', 'msg', '1,3', 1548848611, 'seen'),
(24, 1, 2, 'yes that my boy', 'msg', '3,1', 1548848629, 'seen'),
(25, 2, 1, 'shutup', 'msg', '1,3', 1548848642, 'seen'),
(26, 3, 2, 'test', 'msg', '1,3', 1548850880, 'seen'),
(27, 1, 2, 'ok', 'msg', '3,1', 1548851023, 'seen'),
(28, 1, 2, 'test', 'msg', '3,1', 1548853961, 'seen'),
(29, 3, 2, '', 'msg', '1,3', 1551954628, 'new'),
(30, 3, 2, '', 'msg', '1,3', 1551957514, 'new'),
(31, 2, 3, 'hello sir', 'msg', '3,2', 1551958913, 'seen'),
(32, 2, 3, 'how are you?', 'msg', '3,2', 1551958953, 'seen'),
(33, 3, 3, 'test', 'msg', '2,3', 1551959410, 'seen'),
(34, 3, 3, 'ok', 'msg', '2,3', 1551959445, 'seen'),
(35, 3, 3, 'hi beta how are you', 'msg', '2,3', 1552029005, 'seen'),
(36, 3, 3, 'hi', 'msg', '2,3', 1552034922, 'seen'),
(37, 2, 3, 'test', 'msg', '3,2', 1553244061, 'seen'),
(38, 2, 3, 'hello sir', 'msg', '3,2', 1553592141, 'seen'),
(39, 3, 3, 'hi', 'msg', '2,3', 1553592166, 'seen'),
(40, 3, 3, 'how are you?', 'msg', '2,3', 1553592181, 'seen'),
(41, 2, 3, 'fine what about you?', 'msg', '3,2', 1553592194, 'seen'),
(42, 3, 3, 'me good thank you', 'msg', '2,3', 1553592206, 'seen'),
(43, 4, 4, 'hello sir', 'msg', '3,4', 1554205070, 'seen'),
(44, 3, 3, 'daf', 'msg', '2,3', 1554295949, 'seen'),
(45, 3, 3, 'dsa', 'msg', '2,3', 1554295950, 'seen'),
(46, 3, 3, 'dsaf', 'msg', '2,3', 1554295950, 'seen'),
(47, 3, 3, 'f', 'msg', '2,3', 1554295950, 'seen'),
(48, 3, 3, 'ds', 'msg', '2,3', 1554295951, 'seen'),
(49, 3, 3, 'dsf', 'msg', '2,3', 1554295951, 'seen'),
(58, 2, 3, '', 'lesson', '3,2', 1554379638, 'seen'),
(62, 3, 3, '', 'lesson', '2,3', 1554386495, 'seen'),
(63, 3, 2, 'ok wish you good luck for your exam', 'msg', '1,3', 1555582545, 'new'),
(64, 3, 3, 'ok dear ', 'msg', '2,3', 1555583116, 'seen'),
(65, 3, 3, 'ok ', 'msg', '2,3', 1555583706, 'seen'),
(66, 3, 3, 'thats good', 'msg', '2,3', 1555583735, 'seen'),
(67, 3, 3, 'ok', 'msg', '2,3', 1555583963, 'seen'),
(68, 3, 3, 'test', 'msg', '2,3', 1555583980, 'seen'),
(69, 2, 1, 'ok', 'msg', '1,2', 1555584747, 'new'),
(70, 3, 3, 'what the hell is wrong with you', 'msg', '2,3', 1555584770, 'seen'),
(71, 3, 3, 'k', 'msg', '2,3', 1555584825, 'seen'),
(73, 3, 3, '', 'lesson', '2,3', 1557993254, 'seen'),
(74, 2, 3, 'hello', 'msg', '3,2', 1558351059, 'seen'),
(75, 3, 3, 'yes', 'msg', '2,3', 1558351155, 'seen'),
(76, 2, 3, 'sir i want to book a lesson can you please help me out', 'msg', '3,2', 1558351162, 'seen'),
(77, 3, 3, 'yes , which subject ?\r\n', 'msg', '2,3', 1558351173, 'seen'),
(78, 2, 3, 'jo parha do', 'msg', '3,2', 1558351188, 'seen'),
(79, 3, 3, 'sorry speak english', 'msg', '2,3', 1558351200, 'seen'),
(80, 2, 3, 'acutally i want to test this module', 'msg', '3,2', 1558351203, 'seen'),
(81, 3, 3, 'which module', 'msg', '2,3', 1558351215, 'seen'),
(82, 2, 3, 'lesson request send by teacher', 'msg', '3,2', 1558351218, 'seen'),
(83, 2, 3, 'tutor', 'msg', '3,2', 1558351222, 'seen'),
(84, 3, 3, 'sorry i dont understand what you are saying', 'msg', '2,3', 1558351222, 'seen'),
(85, 2, 3, 'tutor can also send lesson request to student', 'msg', '3,2', 1558351248, 'seen'),
(86, 2, 3, 'in chat ', 'msg', '3,2', 1558351261, 'seen'),
(87, 3, 3, '', 'lesson', '2,3', 1558351304, 'seen'),
(88, 14, 5, 'g zaror', 'msg', '13,14', 1558355420, 'seen'),
(89, 13, 5, 'hi', 'msg', '14,13', 1558355448, 'seen'),
(90, 13, 5, 'math parhna ha beta :P', 'msg', '14,13', 1558355455, 'seen'),
(91, 14, 5, 'g', 'msg', '13,14', 1558355468, 'seen'),
(92, 13, 5, 'akele ho :P ', 'msg', '14,13', 1558355475, 'seen'),
(93, 13, 5, 'hello', 'msg', '14,13', 1558356135, 'seen'),
(94, 14, 5, 'math parhna ha sir g', 'msg', '13,14', 1558356146, 'seen'),
(95, 13, 5, '', 'lesson', '14,13', 1558356152, 'seen'),
(96, 14, 5, 'ap waisy hi khtrnak lg rhy ho', 'msg', '13,14', 1558356157, 'seen'),
(97, 2, 6, 'hi', 'msg', '13,2', 1559559522, 'seen'),
(98, 2, 6, '', 'lesson', '13,2', 1559560219, 'seen'),
(99, 13, 6, '', 'lesson', '2,13', 1559561285, 'seen'),
(100, 2, 6, '', 'lesson', '13,2', 1559561593, 'seen'),
(101, 16, 7, 'hello', 'msg', '3,16', 1559851666, 'seen'),
(102, 3, 7, 'hey hows it going', 'msg', '16,3', 1559851696, 'seen'),
(103, 3, 7, '', 'lesson', '16,3', 1559851735, 'seen'),
(104, 15, 8, '', 'lesson', '3,15', 1560023301, 'seen'),
(105, 15, 8, '', 'lesson', '3,15', 1560023302, 'seen'),
(106, 15, 8, '', 'lesson', '3,15', 1560023302, 'seen'),
(107, 15, 8, '', 'lesson', '3,15', 1560023303, 'seen'),
(108, 3, 8, '', 'lesson', '15,3', 1560023317, 'seen'),
(109, 3, 8, '', 'msg', '15,3', 1560293323, 'new'),
(110, 18, 9, 'hello there\n', 'msg', '18,17', 1561727720, 'seen'),
(111, 17, 10, 'hi all', 'msg', '17,18', 1561727733, 'new'),
(112, 18, 11, 'Hello sir', 'msg', '18,17', 1561727899, 'new'),
(113, 18, 12, 'Are you there?\n', 'msg', '18,17', 1561727906, 'new'),
(114, 17, 13, 'hi\n', 'msg', '17,18', 1561727909, 'new'),
(115, 18, 14, 'can we start ?\n', 'msg', '18,17', 1561727925, 'new'),
(116, 17, 15, 'drawing circile\n', 'msg', '17,18', 1561727992, 'new'),
(117, 18, 16, 'yes , i draw\n', 'msg', '18,17', 1561728004, 'new'),
(118, 17, 17, 'rectangle drawing\n', 'msg', '17,18', 1561728033, 'new'),
(119, 19, 18, 'hello', 'msg', '19,20', 1561728321, 'new'),
(120, 20, 19, 'hye', 'msg', '20,19', 1561728348, 'new'),
(121, 19, 20, 'hye', 'msg', '19,20', 1561728401, 'new'),
(122, 19, 21, 'Hello sir', 'msg', '19,20', 1561728497, 'new'),
(123, 18, 22, 'hi', 'msg', '18,17', 1561728808, 'new'),
(124, 17, 23, 'hello\n', 'msg', '17,18', 1561728821, 'new'),
(125, 17, 24, 'hello sir', 'msg', '17,18', 1561729189, 'new'),
(126, 18, 25, 'hello', 'msg', '18,17', 1561729196, 'new'),
(127, 18, 26, 'sdad\n', 'msg', '18,17', 1561729586, 'new'),
(128, 17, 27, 'hi', 'msg', '17,18', 1561729593, 'new'),
(129, 17, 28, 'hiiii\n', 'msg', '17,18', 1561729604, 'new'),
(130, 18, 29, 'Hello', 'msg', '18,17', 1561957303, 'new'),
(131, 18, 30, 'hii', 'msg', '18,17', 1561957660, 'new'),
(132, 17, 31, 'Howz u?? ', 'msg', '17,18', 1561957674, 'new'),
(133, 18, 32, 'i m fine', 'msg', '18,17', 1561957685, 'new'),
(134, 17, 33, 'Good ?', 'msg', '17,18', 1561957699, 'new'),
(135, 18, 34, 'Hello', 'msg', '18,17', 1561968743, 'new'),
(136, 18, 35, 'Hye', 'msg', '18,17', 1561969402, 'new'),
(137, 17, 36, 'Hello', 'msg', '17,18', 1561969426, 'new'),
(138, 19, 37, 'Hello', 'msg', '19,20', 1562043253, 'new'),
(139, 19, 38, '', 'msg', '19,20', 1562043259, 'new'),
(140, 20, 39, 'Hello BL\n', 'msg', '20,19', 1562043266, 'new'),
(141, 19, 40, 'hello', 'msg', '19,20', 1562043454, 'new'),
(142, 19, 41, 'Hello , Are u there?\n', 'msg', '19,20', 1562043574, 'new'),
(143, 19, 42, 'Hye', 'msg', '19,20', 1562043754, 'new'),
(144, 19, 43, 'Helllo', 'msg', '19,20', 1562044555, 'new'),
(145, 20, 44, 'hello\n', 'msg', '20,19', 1562046455, 'new'),
(146, 19, 45, 'Hello', 'msg', '19,20', 1562046472, 'new'),
(147, 19, 46, 'hye', 'msg', '19,20', 1562046607, 'new'),
(148, 17, 47, 'asdasd', 'msg', '17,18', 1562068182, 'new'),
(149, 18, 48, 'accha', 'msg', '18,17', 1562068298, 'new'),
(150, 18, 49, 'Hello', 'msg', '18,17', 1562138280, 'new'),
(151, 17, 50, 'hye', 'msg', '17,18', 1562139007, 'new'),
(152, 17, 51, 'Hi\n', 'msg', '17,18', 1562142143, 'new'),
(153, 18, 52, 'hELLO tEACHER', 'msg', '18,17', 1562142155, 'new'),
(154, 18, 53, 'Hi', 'msg', '18,17', 1562142170, 'new'),
(155, 17, 54, 'cusd\nlkcdjsk\n\n\n\n', 'msg', '17,18', 1562142177, 'new'),
(156, 17, 55, 'Hi\n', 'msg', '17,18', 1562142852, 'new'),
(157, 17, 56, '', 'msg', '17,18', 1562142852, 'new'),
(158, 17, 57, 'Hi', 'msg', '17,18', 1562144097, 'new'),
(159, 18, 58, 'Hi\n', 'msg', '18,17', 1562144103, 'new'),
(160, 17, 59, 'Hello ', 'msg', '17,18', 1562144109, 'new'),
(161, 18, 60, 'vdfvhsdvhc\n', 'msg', '18,17', 1562144109, 'new'),
(162, 17, 61, 'Bro?', 'msg', '17,18', 1562144250, 'new'),
(163, 18, 62, 'hcjhcvc', 'msg', '18,17', 1562144317, 'new'),
(164, 17, 63, 'Yes??', 'msg', '17,18', 1562144333, 'new'),
(165, 18, 64, 'Sorry', 'msg', '18,17', 1562144336, 'new'),
(166, 17, 65, 'Hey', 'msg', '17,18', 1562144373, 'new'),
(167, 18, 66, 'hiiii\n', 'msg', '18,17', 1562144422, 'new'),
(168, 18, 67, '', 'msg', '18,17', 1562144423, 'new'),
(169, 17, 68, 'Hi', 'msg', '17,18', 1562144443, 'new'),
(170, 17, 69, 'Hello', 'msg', '17,18', 1562144460, 'new'),
(171, 17, 70, 'Hello???\n', 'msg', '17,18', 1562144469, 'new'),
(172, 18, 71, 'Test 123\n', 'msg', '18,17', 1562144485, 'new'),
(173, 17, 72, 'Who is it?', 'msg', '17,18', 1562144791, 'new'),
(174, 17, 73, 'Can you please end your session', 'msg', '17,18', 1562144803, 'new'),
(175, 19, 74, 'Hey Aastha', 'msg', '19,20', 1562144959, 'new'),
(176, 19, 75, '', 'msg', '19,20', 1562144960, 'new'),
(177, 19, 76, '', 'msg', '19,20', 1562144962, 'new'),
(178, 19, 77, 'Are you online?', 'msg', '19,20', 1562144971, 'new'),
(179, 21, 78, 'Hello sir', 'msg', '21,22', 1562146645, 'new'),
(180, 21, 79, 'Hello BL', 'msg', '21,22', 1562146669, 'new'),
(181, 22, 80, 'howz u ?', 'msg', '22,21', 1562146693, 'new'),
(182, 21, 81, 'Hello', 'msg', '21,22', 1562147830, 'new'),
(183, 21, 82, 'hye', 'msg', '21,22', 1562147915, 'new'),
(184, 21, 83, 'hye', 'msg', '21,22', 1562148023, 'new'),
(185, 22, 84, 'hii', 'msg', '22,21', 1562148033, 'new'),
(186, 21, 85, 'Hello', 'msg', '21,22', 1562148156, 'new'),
(187, 21, 86, 'Hello sir,\nare you there?\n', 'msg', '21,22', 1562148183, 'new'),
(188, 21, 87, 'hye.\nhuuu\n', 'msg', '21,22', 1562148244, 'new'),
(189, 21, 88, 'hye', 'msg', '21,22', 1562148330, 'new'),
(190, 21, 89, 'Hello', 'msg', '21,22', 1562150100, 'new'),
(191, 21, 90, 'Hello', 'msg', '21,22', 1562151414, 'new'),
(192, 21, 91, 'Hello', 'msg', '21,22', 1562151474, 'new'),
(193, 22, 92, 'hiiii', 'msg', '22,21', 1562151755, 'new'),
(194, 21, 93, 'hello', 'msg', '21,22', 1562152065, 'new'),
(195, 22, 94, 'Hello\n', 'msg', '22,21', 1562152075, 'new'),
(196, 22, 95, 'Test ', 'msg', '22,21', 1562152088, 'new'),
(197, 21, 96, 'Hello?', 'msg', '21,22', 1562152121, 'new'),
(198, 22, 97, 'Hi', 'msg', '22,21', 1562152130, 'new'),
(199, 22, 98, 'Hi', 'msg', '22,21', 1562152388, 'new'),
(200, 20, 99, 'hii', 'msg', '20,19', 1562153883, 'new'),
(201, 19, 100, 'hello', 'msg', '19,20', 1562153900, 'new'),
(202, 19, 101, 'Hye', 'msg', '19,20', 1562154029, 'new'),
(203, 19, 102, 'Hello', 'msg', '19,20', 1562155612, 'new'),
(204, 17, 9, 'Hi', 'msg', '18,17', 1562231569, 'new'),
(205, 17, 9, 'YesI am', 'msg', '18,17', 1562231582, 'new'),
(206, 17, 103, 'Hello', 'msg', '17,18', 1562238886, 'new'),
(207, 17, 104, 'Hello', 'msg', '17,18', 1562239845, 'new'),
(208, 18, 105, 'hii', 'msg', '18,17', 1562239846, 'new'),
(209, 17, 106, 'Hye', 'msg', '17,18', 1562239865, 'new'),
(210, 17, 107, 'hyew', 'msg', '17,18', 1562240077, 'new'),
(211, 17, 108, 'Hello', 'msg', '17,18', 1562248583, 'new'),
(212, 17, 109, 'msg recieved?\n', 'msg', '17,18', 1562248591, 'new'),
(213, 18, 110, 'yes\n', 'msg', '18,17', 1562248602, 'new'),
(214, 17, 111, 'wich browser used?\n', 'msg', '17,18', 1562248638, 'new'),
(215, 17, 112, 'hello', 'msg', '17,18', 1562248802, 'new'),
(216, 17, 9, 'Qwerty.', 'msg', '18,17', 1562249896, 'new'),
(217, 19, 113, 'Hello', 'msg', '19,20', 1562302888, 'new'),
(218, 19, 114, 'How are you ??\n', 'msg', '19,20', 1562302925, 'new'),
(219, 22, 115, 'Hello', 'msg', '22,21', 1562312444, 'new'),
(220, 21, 116, 'hi', 'msg', '21,22', 1562312449, 'new'),
(221, 22, 117, 'you see my screen?', 'msg', '22,21', 1562312460, 'new'),
(222, 21, 118, 'yes', 'msg', '21,22', 1562312478, 'new'),
(223, 22, 119, 'Please attached Mic', 'msg', '22,21', 1562312479, 'new'),
(224, 21, 120, '1 min', 'msg', '21,22', 1562312488, 'new'),
(225, 22, 121, 'once done..\nplesae let me know', 'msg', '22,21', 1562312537, 'new'),
(226, 21, 122, 'attached ', 'msg', '21,22', 1562312548, 'new'),
(227, 22, 123, 'you get my voice?', 'msg', '22,21', 1562312569, 'new'),
(228, 21, 124, 'no\n', 'msg', '21,22', 1562312576, 'new'),
(229, 22, 125, 'then whats issue ?', 'msg', '22,21', 1562312612, 'new'),
(230, 21, 126, 'voice issue', 'msg', '21,22', 1562312629, 'new'),
(231, 22, 127, 'calling you on skype', 'msg', '22,21', 1562312654, 'new'),
(232, 22, 128, 'voice yha nai aa rhi h mtlb', 'msg', '22,21', 1562312698, 'new'),
(233, 21, 129, 'fir se start kr lo session', 'msg', '21,22', 1562312721, 'new'),
(234, 22, 130, 'okey', 'msg', '22,21', 1562312729, 'new'),
(235, 22, 131, 'Hello sir', 'msg', '22,21', 1562312774, 'new'),
(236, 22, 132, 'hello', 'msg', '22,21', 1562312810, 'new'),
(237, 21, 133, 'ji', 'msg', '21,22', 1562320084, 'new'),
(238, 22, 134, 'shi chal rha h', 'msg', '22,21', 1562320093, 'new'),
(239, 21, 135, 'Hello ', 'msg', '21,22', 1562323245, 'new'),
(240, 21, 136, 'Howz you boss', 'msg', '21,22', 1562323264, 'new'),
(241, 21, 137, 'Can we start testing ', 'msg', '21,22', 1562323273, 'new'),
(242, 21, 138, 'Hye', 'msg', '21,22', 1562323580, 'new'),
(243, 22, 139, 'yes', 'msg', '22,21', 1562323592, 'new'),
(244, 22, 140, 'Hello', 'msg', '22,21', 1562329032, 'new'),
(245, 22, 141, 'hye', 'msg', '22,21', 1562329039, 'new'),
(246, 21, 142, 'hii', 'msg', '21,22', 1562329050, 'new'),
(247, 22, 143, 'Hello', 'msg', '22,21', 1562329187, 'new'),
(248, 21, 144, 'hi', 'msg', '21,22', 1562329192, 'new'),
(249, 17, 145, 'Hi\n', 'msg', '17,18', 1562331312, 'new'),
(250, 18, 146, 'hi\n\n', 'msg', '18,17', 1562331333, 'new'),
(251, 17, 147, 'fhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhffhf\n', 'msg', '17,18', 1562331333, 'new'),
(252, 17, 148, 'ghjgjggjghjg', 'msg', '17,18', 1562331373, 'new'),
(253, 17, 149, '                   ', 'msg', '17,18', 1562331394, 'new'),
(254, 17, 150, 'Hi One here', 'msg', '17,18', 1562332384, 'new'),
(255, 18, 151, 'Hello Two Here\n\n\n\n\n\n\nOKay', 'msg', '18,17', 1562332400, 'new'),
(256, 18, 152, 'Hii\n', 'msg', '18,17', 1562333026, 'new'),
(257, 18, 153, 'Hi\n', 'msg', '18,17', 1562568413, 'new'),
(258, 20, 154, 'Headphone lgao\n', 'msg', '20,19', 1562572537, 'new'),
(259, 19, 155, 'Ek minute', 'msg', '19,20', 1562572543, 'new'),
(260, 19, 156, 'Lorem Ipsum lorem ipsum', 'msg', '19,20', 1562572680, 'new'),
(261, 20, 157, 'Hello', 'msg', '20,19', 1562572696, 'new'),
(262, 19, 158, 'jbhjj', 'msg', '19,20', 1562581316, 'new'),
(263, 20, 159, 'Hello', 'msg', '20,19', 1562660459, 'new'),
(264, 19, 160, 'Yes<br />', 'msg', '19,20', 1562660470, 'new'),
(265, 20, 161, 'black image download kaisi hui  Thi.<br />Plesae aap bta sakte ho ?', 'msg', '20,19', 1562660510, 'new'),
(266, 19, 162, 'normal me hi download ho rhi he<br />', 'msg', '19,20', 1562660525, 'new'),
(267, 19, 163, 'bataya tha tumhe', 'msg', '19,20', 1562660535, 'new'),
(268, 19, 164, 'Hello', 'msg', '19,20', 1562668438, 'new'),
(269, 20, 165, 'hello', 'msg', '20,19', 1562668446, 'new'),
(270, 19, 166, 'Emraan This Side', 'msg', '19,20', 1562668451, 'new'),
(271, 21, 167, 'Hi Aastha', 'msg', '21,22', 1562668623, 'new'),
(272, 22, 168, 'HI', 'msg', '22,21', 1562668636, 'new'),
(273, 21, 170, 'Shall we test on Chrome or Firefox.', 'msg', '21,22', 1562668653, 'new'),
(274, 22, 171, 'Firefox', 'msg', '22,21', 1562668685, 'new'),
(275, 22, 172, 'Hi', 'msg', '22,21', 1562668766, 'new'),
(276, 21, 173, 'Hi Aastha', 'msg', '21,22', 1562668823, 'new'),
(277, 21, 174, 'Do you see this chat?', 'msg', '21,22', 1562668833, 'new'),
(278, 22, 175, 'Yes.', 'msg', '22,21', 1562668845, 'new'),
(279, 21, 176, 'Hi Aastha', 'msg', '21,22', 1562668957, 'new'),
(280, 21, 177, 'Can you see this message?', 'msg', '21,22', 1562668964, 'new'),
(281, 21, 178, 'Hi', 'msg', '21,22', 1562668977, 'new'),
(282, 21, 179, 'Hi Aastha', 'msg', '21,22', 1562669003, 'new'),
(283, 21, 180, 'Do you see this message?<br />', 'msg', '21,22', 1562669014, 'new'),
(284, 21, 181, 'What is this?', 'msg', '21,22', 1562669026, 'new'),
(285, 22, 182, 'Hi', 'msg', '22,21', 1562669043, 'new'),
(286, 22, 183, 'Can you see the messages now?', 'msg', '22,21', 1562669064, 'new'),
(287, 21, 184, 'I see none of your messages in case you are typing?', 'msg', '21,22', 1562669074, 'new'),
(288, 22, 185, 'Hi', 'msg', '22,21', 1562673514, 'new'),
(289, 22, 186, 'Hi', 'msg', '22,21', 1562673808, 'new'),
(290, 21, 187, 'Hello', 'msg', '21,22', 1562673822, 'new'),
(291, 17, 188, 'Hello <br />', 'msg', '17,18', 1562677859, 'new'),
(292, 20, 189, 'Gxuugxzgiugugxguxgxi', 'msg', '20,19', 1562744204, 'new'),
(293, 20, 190, 'Fy  yf yfixfyxxyfxyfxfyx', 'msg', '20,19', 1562744238, 'new'),
(294, 19, 191, 'Hello', 'msg', '19,20', 1562744247, 'new'),
(295, 20, 192, ' Fyhc gc gf yfxyfxxfyxfxyyfyxfyxfyxfxyyfxygxxfyfuxguxguxxfyugxygxygxugx', 'msg', '20,19', 1562744270, 'seen'),
(296, 19, 193, 'Hi', 'msg', '19,20', 1562768576, 'new'),
(297, 19, 194, 'You<br /><br /><br /><br />There', 'msg', '19,20', 1562768592, 'new'),
(298, 19, 195, 'Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum Lorem Ispum ', 'msg', '19,20', 1562768616, 'new'),
(299, 19, 196, 'hye', 'msg', '19,20', 1562769128, 'new'),
(300, 19, 197, 'HiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHiHi<br />', 'msg', '19,20', 1562826462, 'new'),
(301, 19, 198, 'Hello <br />', 'msg', '19,20', 1562826524, 'new'),
(302, 19, 199, 'There', 'msg', '19,20', 1562826667, 'new'),
(303, 19, 200, 'Lorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem Ipsum', 'msg', '19,20', 1562826678, 'new'),
(304, 18, 201, 'Hiii', 'msg', '18,17', 1562827764, 'new'),
(305, 21, 202, 'Hello Rajan', 'msg', '21,22', 1562831938, 'new'),
(306, 22, 203, 'bye<br />', 'msg', '22,21', 1562831945, 'new'),
(307, 21, 204, 'please check yrr', 'msg', '21,22', 1562832262, 'new'),
(308, 21, 205, 'plzzzz', 'msg', '21,22', 1562832263, 'new'),
(309, 21, 206, 'hye', 'msg', '21,22', 1562832277, 'new'),
(310, 22, 207, 'vjf', 'msg', '22,21', 1562832292, 'new'),
(311, 21, 208, 'hiii', 'msg', '21,22', 1562832313, 'new'),
(312, 21, 209, 'hye', 'msg', '21,22', 1562835762, 'new'),
(313, 21, 210, 'howz you ?', 'msg', '21,22', 1562835770, 'new'),
(314, 22, 211, 'its good', 'msg', '22,21', 1562835779, 'new'),
(315, 18, 212, 'hello', 'msg', '18,17', 1562836908, 'new'),
(316, 18, 213, 'hello Suir', 'msg', '18,17', 1562836937, 'seen'),
(317, 22, 214, 'Hye', 'msg', '22,21', 1562839337, 'new'),
(318, 19, 216, 'hye', 'msg', '19,20', 1562850455, 'new'),
(319, 19, 217, 'hye', 'msg', '19,20', 1562850534, 'new'),
(320, 20, 218, 'hye', 'msg', '20,19', 1562850970, 'new'),
(321, 19, 219, 'var times = Math.round(+new Date()/1000);', 'msg', '19,20', 1562851031, 'new'),
(322, 19, 220, 'var times = Math.round(+new Date()/1000);', 'msg', '19,20', 1562851040, 'new'),
(323, 20, 221, 'var times = Math.round(+new Date()/1000);', 'msg', '20,19', 1562851045, 'new'),
(324, 17, 9, 'hi', 'msg', '18,17', 1562852094, 'new'),
(325, 19, 222, 'test 1msg', 'msg', '19,20', 1562852964, 'new'),
(326, 19, 223, 'hiii', 'msg', '19,20', 1562852981, 'new'),
(327, 20, 224, 'Tester Msg', 'msg', '20,19', 1562853037, 'new'),
(328, 19, 225, 'data', 'msg', '19,20', 1562853166, 'new'),
(329, 19, 226, 'Hello sir<br />need to test related to chat save or not', 'msg', '19,20', 1562853209, 'new'),
(330, 20, 227, 'ok sir.<br />we will test .<br />when you avalible please let me know<br />', 'msg', '20,19', 1562853393, 'new'),
(331, 17, 228, 'Hye', 'msg', '17,18', 1562866984, 'new'),
(332, 17, 229, 'Gn', 'msg', '17,18', 1562866992, 'new'),
(333, 17, 230, 'Hello Team<br />are you there?', 'msg', '17,18', 1562903297, 'new'),
(334, 21, 231, 'Good morning Team', 'msg', '21,22', 1562911663, 'new'),
(335, 22, 232, 'hye', 'msg', '22,21', 1562911684, 'new'),
(336, 21, 233, 'http://crainly.codiantdev.com/', 'msg', '21,22', 1562911722, 'new'),
(337, 18, 234, 'hye', 'msg', '18,17', 1562933077, 'new'),
(338, 18, 235, 'Join over 10 million people celebrating on Crainly', 'msg', '18,17', 1562933835, 'new'),
(339, 17, 236, 'Join over 10 million people celebrating on Crainly', 'msg', '17,18', 1562933843, 'new'),
(340, 20, 237, 'Hi', 'msg', '20,19', 1562938061, 'new'),
(341, 21, 238, 'Hello sir', 'msg', '21,22', 1562941415, 'new'),
(342, 21, 239, 'hiii', 'msg', '21,22', 1562942599, 'new'),
(343, 22, 240, 'sachins@codiant.com', 'msg', '22,21', 1563007499, 'new'),
(344, 22, 241, 'sachins@codiant.com', 'msg', '22,21', 1563007553, 'new'),
(345, 17, 242, 'selectTool();', 'msg', '17,18', 1563243197, 'new'),
(346, 18, 243, 'selectTool();', 'msg', '18,17', 1563243202, 'new'),
(347, 18, 244, 'codiant', 'msg', '18,17', 1563298753, 'new'),
(348, 18, 245, 'message', 'msg', '18,17', 1563345741, 'new'),
(349, 17, 246, 'message', 'msg', '17,18', 1563345778, 'new'),
(350, 17, 247, 'oText.set', 'msg', '17,18', 1563346814, 'new'),
(351, 17, 248, 'https://limnu.com/d/draw.html?b=B_O80mbIZLQyiexs&', 'msg', '17,18', 1563360774, 'new'),
(352, 17, 249, 'https://crainly.codiantdev.com/', 'msg', '17,18', 1563365620, 'new'),
(353, 18, 250, 'ActiveItem', 'msg', '18,17', 1563429759, 'new'),
(354, 17, 251, 'function enterpressalert(e, textarea)<br />    {<br />        var code = (e.keyCode ? e.keyCode : e.which);<br />        if(code == 13) <br />        { <br />            alert(\"hii\");<br />            $(\"#sendMsg\").click();<br />        }<br />    }', 'msg', '17,18', 1563430063, 'new'),
(355, 17, 252, 'hello', 'msg', '17,18', 1563430723, 'new'),
(356, 17, 253, 'hello', 'msg', '17,18', 1563430765, 'new'),
(357, 17, 254, '<br />how are you ?', 'msg', '17,18', 1563430772, 'new'),
(358, 18, 256, 'hello<br />how are you ?', 'msg', '18,17', 1563431073, 'new'),
(359, 18, 257, 'hello', 'msg', '18,17', 1563431079, 'new'),
(360, 18, 258, 'hello', 'msg', '18,17', 1563431182, 'new'),
(361, 17, 259, 'chat-hide', 'msg', '17,18', 1563453517, 'new'),
(362, 17, 260, 'canvas1', 'msg', '17,18', 1563458243, 'new'),
(363, 17, 261, 'This is my textarea to be replaced with CKEditor.<br />This is my textarea to be replaced with CKEditor.<br />This is my textarea to be replaced with CKEditor.<br />This is my textarea to be replaced with CKEditor.<br />This is my textarea to be replaced with CKEditor.<br />This is my textarea to be replaced with CKEditor.<br />This is my textarea to be replaced with CKEditor.<br />bherulal mandawaliya<br />indore ratlam<br />indore<br />This is my textarea to be replaced with CKEditor.<br />This is my textarea to be replaced with CKEditor.<br />This is my textarea to be replaced with CKEditor.<br />This is my textarea to be replaced with CKEditor.<br />This is my textarea to be replaced with CKEditor.<br />This is my textarea to be replaced with CKEditor.<br />This is my textarea to be replaced with CKEditor.<br />bherulal mandawaliya<br />indore ratlam<br />indore<br />', 'msg', '17,18', 1563373835, 'new'),
(364, 17, 262, 'data', 'msg', '17,18', 1563458125, 'new'),
(365, 18, 264, 'IText', 'msg', '18,17', 1563878426, 'new'),
(366, 18, 268, 'http://localhost/crainly-web/uploads/chat/1564145862canvas(8).png', 'attachment', '18,17', 1564145863, 'new'),
(367, 18, 269, 'http://localhost/crainly-web/uploads/chat/15641459250001014620006363730_07132019_08022019.PDF', 'attachment', '18,17', 1564145925, 'new'),
(368, 18, 270, 'http://localhost/crainly-web/uploads/chat/1564145978pexels-photo-556416.jpeg', 'attachment', '18,17', 1564145979, 'new'),
(369, 17, 271, 'http://localhost/crainly-web/uploads/chat/1564146113Beautiful-Green-Nature-Wallpaper-620x501.jpg', 'attachment', '17,18', 1564146114, 'new'),
(370, 18, 272, 'http://localhost/crainly-web/uploads/chat/1564146308Client_Feedback_(22-07-2019).docx', 'attachment', '18,17', 1564146309, 'new'),
(371, 18, 273, 'http://localhost/crainly-web/uploads/chat/15641463190001014620006363730_06132019_07032019.PDF', 'attachment', '18,17', 1564146320, 'new'),
(372, 18, 274, 'http://localhost/crainly-web/uploads/chat/1564146323head-659652_960_720.png', 'attachment', '18,17', 1564146324, 'new'),
(373, 17, 275, 'hye', 'msg', '17,18', 1564146943, 'new'),
(374, 18, 276, 'http://localhost/crainly-web/uploads/chat/15641469470001014620006363730_07132019_08022019.PDF', 'attachment', '18,17', 1564146948, 'new'),
(375, 17, 277, 'http://localhost/crainly-web/uploads/chat/1564147331Beautiful-Green-Nature-Wallpaper-620x501.jpg', 'attachment', '17,18', 1564147332, 'new'),
(376, 17, 278, 'http://localhost/crainly-web/uploads/chat/1564147372pexels-photo-556416.jpeg', 'attachment', '17,18', 1564147372, 'new'),
(377, 17, 279, 'http://localhost/crainly-web/uploads/chat/1564147587Beautiful-Green-Nature-Wallpaper-620x501.jpg', 'attachment', '17,18', 1564147587, 'new'),
(378, 17, 280, 'http://localhost/crainly-web/uploads/chat/1564147616Beautiful-Green-Nature-Wallpaper-620x501.jpg', 'attachment', '17,18', 1564147617, 'new'),
(379, 17, 281, 'http://localhost/crainly-web/uploads/chat/1564147632pexels-photo-556416.jpeg', 'attachment', '17,18', 1564147633, 'new'),
(380, 17, 282, 'http://localhost/crainly-web/uploads/chat/1564147687pexels-photo-556416.jpeg', 'attachment', '17,18', 1564147687, 'new'),
(381, 17, 283, 'http://localhost/crainly-web/uploads/chat/15641476970001014620006363730_07132019_08022019.PDF', 'attachment', '17,18', 1564147697, 'new'),
(382, 17, 284, 'hyr', 'msg', '17,18', 1564147725, 'new'),
(383, 17, 285, 'http://localhost/crainly-web/uploads/chat/1564148501canvas(8).png', 'attachment', '17,18', 1564148501, 'new'),
(384, 18, 286, 'http://localhost/crainly-web/uploads/chat/1564148516head-659652_960_720.png', 'attachment', '18,17', 1564148516, 'new'),
(385, 18, 287, 'http://localhost/crainly-web/uploads/chat/1564149450Client_Feedback_(22-07-2019).docx', 'attachment', '18,17', 1564149451, 'new'),
(386, 18, 288, 'http://localhost/crainly-web/uploads/chat/15641495390001014620006363730_06132019_07032019.PDF', 'attachment', '18,17', 1564149540, 'new'),
(387, 18, 289, 'http://localhost/crainly-web/uploads/chat/15641496410001014620006363730_06132019_07032019.PDF', 'attachment', '18,17', 1564149641, 'new'),
(388, 17, 290, 'http://localhost/crainly-web/uploads/chat/15641497070001014620006363730_06132019_07032019.PDF', 'attachment', '17,18', 1564149708, 'new'),
(389, 17, 291, 'http://localhost/crainly-web/uploads/chat/1564204032pexels-photo-556416.jpeg', 'attachment', '17,18', 1564204057, 'new'),
(390, 17, 292, 'http://localhost/crainly-web/uploads/chat/1564204069pexels-photo-556416.jpeg', 'attachment', '17,18', 1564204070, 'new'),
(391, 17, 293, 'http://localhost/crainly-web/uploads/chat/1564204072Beautiful-Green-Nature-Wallpaper-620x501.jpg', 'attachment', '17,18', 1564204073, 'new'),
(392, 17, 294, 'http://localhost/crainly-web/uploads/chat/1564204075Beautiful-Green-Nature-Wallpaper-620x501.jpg', 'attachment', '17,18', 1564204076, 'new'),
(393, 17, 295, 'http://localhost/crainly-web/uploads/chat/15642042750001014620006363730_06132019_07032019.PDF', 'attachment', '17,18', 1564204276, 'new'),
(394, 17, 296, 'http://localhost/crainly-web/uploads/chat/15642044250001014620006363730_06132019_07032019.PDF', 'attachment', '17,18', 1564204425, 'new'),
(395, 17, 297, 'http://localhost/crainly-web/uploads/chat/15642044650001014620006363730_06132019_07032019.PDF', 'attachment', '17,18', 1564204466, 'new'),
(396, 17, 298, 'http://localhost/crainly-web/uploads/chat/15642045180001014620006363730_07132019_08022019.PDF', 'attachment', '17,18', 1564204519, 'new'),
(397, 17, 299, 'http://localhost/crainly-web/uploads/chat/15642055520001014620006363730_07132019_08022019.PDF', 'attachment', '17,18', 1564205552, 'new'),
(398, 17, 300, 'http://localhost/crainly-web/uploads/chat/15642056270001014620006363730_07132019_08022019.PDF', 'attachment', '17,18', 1564205627, 'new'),
(399, 17, 301, 'http://localhost/crainly-web/uploads/chat/15642057070001014620006363730_07132019_08022019.PDF', 'attachment', '17,18', 1564205707, 'new'),
(400, 18, 302, 'http://localhost/crainly-web/uploads/chat/15642058240001014620006363730_06132019_07032019.PDF', 'attachment', '18,17', 1564205825, 'new'),
(401, 18, 303, 'http://localhost/crainly-web/uploads/chat/15642059330001014620006363730_07132019_08022019.PDF', 'attachment', '18,17', 1564205934, 'new'),
(402, 18, 304, 'http://localhost/crainly-web/uploads/chat/15642060130001014620006363730_07132019_08022019.PDF', 'attachment', '18,17', 1564206014, 'new'),
(403, 18, 305, 'http://localhost/crainly-web/uploads/chat/15642061400001014620006363730_06132019_07032019.PDF', 'attachment', '18,17', 1564206140, 'new'),
(404, 18, 306, 'http://localhost/crainly-web/uploads/chat/15642063120001014620006363730_06132019_07032019.PDF', 'attachment', '18,17', 1564206312, 'new'),
(405, 18, 307, 'http://localhost/crainly-web/uploads/chat/15642069960001014620006363730_07132019_08022019.PDF', 'attachment', '18,17', 1564206996, 'new'),
(406, 18, 308, 'http://localhost/crainly-web/uploads/chat/15642071470001014620006363730_07132019_08022019.PDF', 'attachment', '18,17', 1564207148, 'new'),
(407, 18, 309, 'http://localhost/crainly-web/uploads/chat/15642071930001014620006363730_07132019_08022019.PDF', 'attachment', '18,17', 1564207194, 'new'),
(408, 18, 310, 'Hello sir', 'msg', '18,17', 1564210774, 'new'),
(409, 17, 311, 'http://localhost/crainly-web/uploads/chat/1564210781WhiteBoard events.docx', 'attachment', '17,18', 1564210781, 'new'),
(410, 18, 312, 'http://localhost/crainly-web/uploads/chat/1564210791Sad-Alone-Images-1-300x236.jpg', 'attachment', '18,17', 1564210791, 'new'),
(411, 17, 313, 'hye', 'msg', '17,18', 1564232022, 'new'),
(412, 17, 314, 'hye sir', 'msg', '17,18', 1564232134, 'new'),
(413, 18, 315, 'http://localhost/crainly-web/uploads/chat/1564232152suspension-bridge-into-the-jungle-nakhon-nayok.jpg', 'attachment', '18,17', 1564232153, 'new'),
(414, 17, 316, 'http://localhost/crainly-web/uploads/chat/1564377796pexels-photo-814499.jpeg', 'attachment', '17,18', 1564377796, 'new'),
(415, 18, 317, 'hye', 'msg', '18,17', 1564378744, 'new'),
(416, 18, 318, 'helllo', 'msg', '18,17', 1564382771, 'new'),
(417, 17, 319, 'http://localhost/crainly-web/uploads/chat/1564383232pexels-photo-248797.jpeg', 'attachment', '17,18', 1564383232, 'new'),
(418, 18, 320, 'http://localhost/crainly-web/uploads/chat/1564384484suspension-bridge-into-the-jungle-nakhon-nayok.jpg', 'attachment', '18,17', 1564384484, 'new'),
(419, 18, 321, 'http://localhost/crainly-web/uploads/chat/1564384596pexels-photo-248797.jpeg', 'attachment', '18,17', 1564384597, 'new'),
(420, 17, 322, 'hye', 'msg', '17,18', 1564384933, 'new'),
(421, 17, 323, 'hello', 'msg', '17,18', 1564384940, 'new'),
(422, 17, 324, 'http://localhost/crainly-web/uploads/chat/1564385004pexels-photo-248797.jpeg', 'attachment', '17,18', 1564385004, 'new'),
(423, 17, 325, 'http://localhost/crainly-web/uploads/chat/1564385009pexels-photo-814499.jpeg', 'attachment', '17,18', 1564385010, 'new'),
(424, 18, 326, 'http://localhost/crainly-web/uploads/chat/1564385104index.jpg', 'attachment', '18,17', 1564385104, 'new'),
(425, 18, 327, 'http://localhost/crainly-web/uploads/chat/15643853141280px-100-foot-cascading-autumn-waterfalls_-_West_Virginia_-_ForestWander.jpg', 'attachment', '18,17', 1564385315, 'new'),
(426, 18, 328, 'http://localhost/crainly-web/uploads/chat/1564385406pexels-photo-556416.jpeg', 'attachment', '18,17', 1564385407, 'new'),
(427, 18, 329, 'http://localhost/crainly-web/uploads/chat/1564385451pexels-photo-459225.jpeg', 'attachment', '18,17', 1564385451, 'new'),
(428, 18, 330, 'http://localhost/crainly-web/uploads/chat/15643854781280px-100-foot-cascading-autumn-waterfalls_-_West_Virginia_-_ForestWander.jpg', 'attachment', '18,17', 1564385479, 'new'),
(429, 18, 331, 'http://localhost/crainly-web/uploads/chat/15643855071280px-100-foot-cascading-autumn-waterfalls_-_West_Virginia_-_ForestWander.jpg', 'attachment', '18,17', 1564385508, 'new'),
(430, 18, 332, 'http://localhost/crainly-web/uploads/chat/1564386226Sad-Alone-Images-1-300x236.jpg', 'attachment', '18,17', 1564386227, 'new'),
(431, 18, 333, 'http://localhost/crainly-web/uploads/chat/1564386293pexels-photo-556416.jpeg', 'attachment', '18,17', 1564386293, 'new'),
(432, 18, 334, 'http://localhost/crainly-web/uploads/chat/1564386300img_forest.jpg', 'attachment', '18,17', 1564386301, 'new'),
(433, 18, 335, 'http://localhost/crainly-web/uploads/chat/1564386314Sad-Alone-Images-1-300x236.jpg', 'attachment', '18,17', 1564386315, 'new'),
(434, 18, 336, 'http://localhost/crainly-web/uploads/chat/1564386330pexels-photo-459225.jpeg', 'attachment', '18,17', 1564386330, 'new'),
(435, 18, 337, 'http://localhost/crainly-web/uploads/chat/15643863331280px-100-foot-cascading-autumn-waterfalls_-_West_Virginia_-_ForestWander.jpg', 'attachment', '18,17', 1564386333, 'new'),
(436, 18, 338, 'http://localhost/crainly-web/uploads/chat/1564386341Beautiful-Green-Nature-Wallpaper-620x501.jpg', 'attachment', '18,17', 1564386342, 'new'),
(437, 18, 339, 'http://localhost/crainly-web/uploads/chat/1564386381pexels-photo-556416.jpeg', 'attachment', '18,17', 1564386381, 'new'),
(438, 18, 340, 'http://localhost/crainly-web/uploads/chat/15643863881280px-100-foot-cascading-autumn-waterfalls_-_West_Virginia_-_ForestWander.jpg', 'attachment', '18,17', 1564386389, 'new'),
(439, 18, 341, 'http://localhost/crainly-web/uploads/chat/1564386482100-foot-cascading-autumn-waterfalls_-_West_Virginia_-_ForestWander.jpg', 'attachment', '18,17', 1564386501, 'new'),
(440, 18, 342, 'http://localhost/crainly-web/uploads/chat/1564386564pexels-photo-556416.jpeg', 'attachment', '18,17', 1564386564, 'new'),
(441, 18, 343, 'http://localhost/crainly-web/uploads/chat/1564386568100-foot-cascading-autumn-waterfalls_-_West_Virginia_-_ForestWander.jpg', 'attachment', '18,17', 1564386568, 'new'),
(442, 18, 344, 'http://localhost/crainly-web/uploads/chat/1564386593Beautiful-Green-Nature-Wallpaper-620x501.jpg', 'attachment', '18,17', 1564386594, 'new'),
(443, 18, 345, 'http://localhost/crainly-web/uploads/chat/1564386596100-foot-cascading-autumn-waterfalls_-_West_Virginia_-_ForestWander.jpg', 'attachment', '18,17', 1564386597, 'new'),
(444, 18, 346, 'http://localhost/crainly-web/uploads/chat/1564386605Beautiful-Green-Nature-Wallpaper-620x501.jpg', 'attachment', '18,17', 1564386606, 'new'),
(445, 18, 347, 'http://localhost/crainly-web/uploads/chat/1564386611img_forest.jpg', 'attachment', '18,17', 1564386611, 'new'),
(446, 18, 348, 'http://localhost/crainly-web/uploads/chat/1564386613100-foot-cascading-autumn-waterfalls_-_West_Virginia_-_ForestWander.jpg', 'attachment', '18,17', 1564386614, 'new'),
(447, 17, 349, 'ok sir', 'msg', '17,18', 1564392192, 'new'),
(448, 17, 350, 'http://localhost/crainly-web/uploads/chat/1564392235pexels-photo-459225.jpeg', 'attachment', '17,18', 1564392235, 'new'),
(449, 17, 351, 'http://localhost/crainly-web/uploads/chat/1564392241Sample-jpg-image-10mb.jpg', 'attachment', '17,18', 1564392242, 'new'),
(450, 17, 352, 'http://localhost/crainly-web/uploads/chat/1564392249Sample-jpg-image-20mb.jpg', 'attachment', '17,18', 1564392249, 'new'),
(451, 17, 353, 'http://localhost/crainly-web/uploads/chat/1564392254Sample-jpg-image-30mb.jpg', 'attachment', '17,18', 1564392255, 'new'),
(452, 17, 354, 'http://localhost/crainly-web/uploads/chat/1564392267Victoria_Memorial_situated_in_Kolkata.jpg', 'attachment', '17,18', 1564392268, 'new'),
(453, 18, 355, 'http://localhost/crainly-web/uploads/chat/1564392283Sample-jpg-image-30mb.jpg', 'attachment', '18,17', 1564392283, 'new'),
(454, 18, 356, 'http://localhost/crainly-web/uploads/chat/1564392286suspension-bridge-into-the-jungle-nakhon-nayok.jpg', 'attachment', '18,17', 1564392286, 'new'),
(455, 18, 357, 'http://localhost/crainly-web/uploads/chat/1564392289Sample-jpg-image-30mb.jpg', 'attachment', '18,17', 1564392289, 'new'),
(456, 18, 358, 'http://localhost/crainly-web/uploads/chat/1564392292Sample-jpg-image-15mb.jpeg', 'attachment', '18,17', 1564392292, 'new'),
(457, 17, 359, 'hye', 'msg', '17,18', 1564392387, 'new'),
(458, 17, 360, 'http://localhost/crainly-web/uploads/chat/1564469171100-foot-cascading-autumn-waterfalls_-_West_Virginia_-_ForestWander.jpg', 'attachment', '17,18', 1564469171, 'new'),
(459, 17, 361, 'http://localhost/crainly-web/uploads/chat/1564469211Sample-jpg-image-15mb.jpeg', 'attachment', '17,18', 1564469212, 'new'),
(460, 17, 362, 'http://localhost/crainly-web/uploads/chat/1564469430ktm-rc-200.jpg', 'attachment', '17,18', 1564469431, 'new'),
(461, 18, 363, 'http://localhost/crainly-web/uploads/chat/1564469475img_forest.jpg', 'attachment', '18,17', 1564469476, 'new'),
(462, 18, 364, 'http://localhost/crainly-web/uploads/chat/1564469599pexels-photo-814499.jpeg', 'attachment', '18,17', 1564469600, 'new'),
(463, 17, 365, 'http://localhost/crainly-web/uploads/chat/1564469668pexels-photo-257360.jpeg', 'attachment', '17,18', 1564469669, 'new'),
(464, 17, 366, 'hye', 'msg', '17,18', 1564469751, 'new'),
(465, 17, 367, 'video-size', 'msg', '17,18', 1564470472, 'new'),
(466, 17, 368, 'http://localhost/crainly-web/uploads/chat/1564470494WhiteBoard events.docx', 'attachment', '17,18', 1564470495, 'new'),
(467, 17, 369, 'hiii', 'msg', '17,18', 1564478081, 'new'),
(468, 17, 370, 'http://localhost/crainly-web/uploads/chat/1564485660Peloponnese_map.pdf', 'attachment', '17,18', 1564485661, 'new'),
(469, 17, 371, 'http://localhost/crainly-web/uploads/chat/1564485684Peloponnese_map.pdf', 'attachment', '17,18', 1564485684, 'new'),
(470, 18, 372, 'http://localhost/crainly-web/uploads/chat/1564494279100-foot-cascading-autumn-waterfalls_-_West_Virginia_-_ForestWander.jpg', 'attachment', '18,17', 1564494279, 'new'),
(471, 18, 373, 'http://localhost/crainly-web/uploads/chat/1564494300Beautiful-Green-Nature-Wallpaper-620x501.jpg', 'attachment', '18,17', 1564494301, 'new'),
(472, 18, 374, 'http://localhost/crainly-web/uploads/chat/1564550626Sample-jpg-image-20mb.jpg', 'attachment', '18,17', 1564550627, 'new'),
(473, 22, 375, 'hye', 'msg', '22,21', 1564551699, 'new'),
(474, 20, 376, 'http://localhost/crainly-web/my-lessons', 'msg', '20,19', 1564551805, 'new'),
(475, 20, 377, 'http://localhost/crainly-web/my-lessons', 'msg', '20,19', 1564551864, 'new'),
(476, 22, 378, 'http://localhost/crainly-web/my-lessons', 'msg', '22,21', 1564551939, 'new'),
(477, 17, 379, 'hii', 'msg', '17,18', 1564651381, 'new'),
(478, 21, 380, 'hy', 'msg', '21,22', 1570619607, 'new'),
(479, 22, 381, 'hi', 'msg', '22,21', 1570619616, 'new'),
(480, 22, 382, 'hy', 'msg', '22,21', 1570620092, 'new'),
(481, 21, 383, 'hy BL', 'msg', '21,22', 1570620277, 'new'),
(482, 21, 384, 'ge', 'msg', '21,22', 1570620309, 'new'),
(483, 21, 385, 'BL Wants to talk with you', 'msg', '21,22', 1570620397, 'new'),
(484, 22, 386, 'yes BL', 'msg', '22,21', 1570620403, 'new'),
(485, 21, 387, 'http://localhost/crainly-web/uploads/chat/1570685171carparking300.jpg', 'attachment', '21,22', 1570685171, 'new'),
(486, 21, 388, 'http://localhost/crainly-web/uploads/chat/1570685242carparking300.jpg', 'attachment', '21,22', 1570685242, 'new'),
(487, 22, 389, 'http://localhost/crainly-web/uploads/chat/15706852501564469171100-foot-cascading-autumn-waterfalls_-_West_Virginia_-_ForestWander.jpg', 'attachment', '22,21', 1570685251, 'new'),
(488, 22, 390, 'http://localhost/crainly-web/uploads/chat/15706852711564469211Sample-jpg-image-15mb.jpeg', 'attachment', '22,21', 1570685272, 'new'),
(489, 21, 391, 'http://localhost/crainly-web/uploads/chat/1570685279DLD_AI_Super Admin.docx', 'attachment', '21,22', 1570685279, 'new'),
(490, 21, 392, 'http://localhost/crainly-web/uploads/chat/1570685324carparking300.jpg', 'attachment', '21,22', 1570685325, 'new'),
(491, 21, 393, 'http://localhost/crainly-web/uploads/chat/1570685438carparking300.jpg', 'attachment', '21,22', 1570685438, 'new'),
(492, 21, 394, 'http://localhost/crainly-web/uploads/chat/1570685470LectureFile.png', 'attachment', '21,22', 1570685470, 'new'),
(493, 22, 395, 'http://localhost/crainly-web/uploads/chat/15706855050001014620006363730_06132019_07032019.PDF', 'attachment', '22,21', 1570685506, 'new'),
(494, 22, 396, 'hii', 'msg', '22,21', 1570690427, 'new'),
(495, 22, 397, 'jii', 'msg', '22,21', 1570690465, 'new'),
(496, 21, 398, 'http://localhost/crainly-web/uploads/chat/15706911131564469171100-foot-cascading-autumn-waterfalls_-_West_Virginia_-_ForestWander.jpg', 'attachment', '21,22', 1570691113, 'new'),
(497, 21, 399, 'http://localhost/crainly-web/uploads/chat/15706912081564469171100-foot-cascading-autumn-waterfalls_-_West_Virginia_-_ForestWander.jpg', 'attachment', '21,22', 1570691209, 'new'),
(498, 21, 400, 'hii', 'msg', '21,22', 1570691258, 'new');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chat_video_class`
--

CREATE TABLE `tbl_chat_video_class` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `tutor_id` int(11) NOT NULL,
  `session_name` varchar(100) NOT NULL,
  `session_id` text NOT NULL,
  `student_connected` int(11) NOT NULL DEFAULT '0' COMMENT '0-not connected,1 for connected',
  `tutor_connected` int(11) DEFAULT '0' COMMENT '0-not connected,1 for connected'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_chat_video_class`
--

INSERT INTO `tbl_chat_video_class` (`id`, `student_id`, `tutor_id`, `session_name`, `session_id`, `student_connected`, `tutor_connected`) VALUES
(1, 18, 17, 'M001', '2_MX40NjM5NjQ5Mn5-MTU2NDU3ODkyOTIyOH4reGxocEI1VVhHK3F4a2RzbzVtT2N3WHB-fg', 1, 1),
(2, 20, 19, 'M002', '', 0, 0),
(3, 22, 21, 'M003', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_countries`
--

CREATE TABLE `tbl_countries` (
  `id` int(11) NOT NULL,
  `sortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_countries`
--

INSERT INTO `tbl_countries` (`id`, `sortname`, `name`, `phonecode`) VALUES
(1, 'AF', 'Afghanistan', 93),
(2, 'AL', 'Albania', 355),
(3, 'DZ', 'Algeria', 213),
(4, 'AS', 'American Samoa', 1684),
(5, 'AD', 'Andorra', 376),
(6, 'AO', 'Angola', 244),
(7, 'AI', 'Anguilla', 1264),
(8, 'AQ', 'Antarctica', 0),
(9, 'AG', 'Antigua And Barbuda', 1268),
(10, 'AR', 'Argentina', 54),
(11, 'AM', 'Armenia', 374),
(12, 'AW', 'Aruba', 297),
(13, 'AU', 'Australia', 61),
(14, 'AT', 'Austria', 43),
(15, 'AZ', 'Azerbaijan', 994),
(16, 'BS', 'Bahamas The', 1242),
(17, 'BH', 'Bahrain', 973),
(18, 'BD', 'Bangladesh', 880),
(19, 'BB', 'Barbados', 1246),
(20, 'BY', 'Belarus', 375),
(21, 'BE', 'Belgium', 32),
(22, 'BZ', 'Belize', 501),
(23, 'BJ', 'Benin', 229),
(24, 'BM', 'Bermuda', 1441),
(25, 'BT', 'Bhutan', 975),
(26, 'BO', 'Bolivia', 591),
(27, 'BA', 'Bosnia and Herzegovina', 387),
(28, 'BW', 'Botswana', 267),
(29, 'BV', 'Bouvet Island', 0),
(30, 'BR', 'Brazil', 55),
(31, 'IO', 'British Indian Ocean Territory', 246),
(32, 'BN', 'Brunei', 673),
(33, 'BG', 'Bulgaria', 359),
(34, 'BF', 'Burkina Faso', 226),
(35, 'BI', 'Burundi', 257),
(36, 'KH', 'Cambodia', 855),
(37, 'CM', 'Cameroon', 237),
(38, 'CA', 'Canada', 1),
(39, 'CV', 'Cape Verde', 238),
(40, 'KY', 'Cayman Islands', 1345),
(41, 'CF', 'Central African Republic', 236),
(42, 'TD', 'Chad', 235),
(43, 'CL', 'Chile', 56),
(44, 'CN', 'China', 86),
(45, 'CX', 'Christmas Island', 61),
(46, 'CC', 'Cocos (Keeling) Islands', 672),
(47, 'CO', 'Colombia', 57),
(48, 'KM', 'Comoros', 269),
(49, 'CG', 'Republic Of The Congo', 242),
(50, 'CD', 'Democratic Republic Of The Congo', 242),
(51, 'CK', 'Cook Islands', 682),
(52, 'CR', 'Costa Rica', 506),
(53, 'CI', 'Cote D\'Ivoire (Ivory Coast)', 225),
(54, 'HR', 'Croatia (Hrvatska)', 385),
(55, 'CU', 'Cuba', 53),
(56, 'CY', 'Cyprus', 357),
(57, 'CZ', 'Czech Republic', 420),
(58, 'DK', 'Denmark', 45),
(59, 'DJ', 'Djibouti', 253),
(60, 'DM', 'Dominica', 1767),
(61, 'DO', 'Dominican Republic', 1809),
(62, 'TP', 'East Timor', 670),
(63, 'EC', 'Ecuador', 593),
(64, 'EG', 'Egypt', 20),
(65, 'SV', 'El Salvador', 503),
(66, 'GQ', 'Equatorial Guinea', 240),
(67, 'ER', 'Eritrea', 291),
(68, 'EE', 'Estonia', 372),
(69, 'ET', 'Ethiopia', 251),
(70, 'XA', 'External Territories of Australia', 61),
(71, 'FK', 'Falkland Islands', 500),
(72, 'FO', 'Faroe Islands', 298),
(73, 'FJ', 'Fiji Islands', 679),
(74, 'FI', 'Finland', 358),
(75, 'FR', 'France', 33),
(76, 'GF', 'French Guiana', 594),
(77, 'PF', 'French Polynesia', 689),
(78, 'TF', 'French Southern Territories', 0),
(79, 'GA', 'Gabon', 241),
(80, 'GM', 'Gambia The', 220),
(81, 'GE', 'Georgia', 995),
(82, 'DE', 'Germany', 49),
(83, 'GH', 'Ghana', 233),
(84, 'GI', 'Gibraltar', 350),
(85, 'GR', 'Greece', 30),
(86, 'GL', 'Greenland', 299),
(87, 'GD', 'Grenada', 1473),
(88, 'GP', 'Guadeloupe', 590),
(89, 'GU', 'Guam', 1671),
(90, 'GT', 'Guatemala', 502),
(91, 'XU', 'Guernsey and Alderney', 44),
(92, 'GN', 'Guinea', 224),
(93, 'GW', 'Guinea-Bissau', 245),
(94, 'GY', 'Guyana', 592),
(95, 'HT', 'Haiti', 509),
(96, 'HM', 'Heard and McDonald Islands', 0),
(97, 'HN', 'Honduras', 504),
(98, 'HK', 'Hong Kong S.A.R.', 852),
(99, 'HU', 'Hungary', 36),
(100, 'IS', 'Iceland', 354),
(101, 'IN', 'India', 91),
(102, 'ID', 'Indonesia', 62),
(103, 'IR', 'Iran', 98),
(104, 'IQ', 'Iraq', 964),
(105, 'IE', 'Ireland', 353),
(106, 'IL', 'Israel', 972),
(107, 'IT', 'Italy', 39),
(108, 'JM', 'Jamaica', 1876),
(109, 'JP', 'Japan', 81),
(110, 'XJ', 'Jersey', 44),
(111, 'JO', 'Jordan', 962),
(112, 'KZ', 'Kazakhstan', 7),
(113, 'KE', 'Kenya', 254),
(114, 'KI', 'Kiribati', 686),
(115, 'KP', 'Korea North', 850),
(116, 'KR', 'Korea South', 82),
(117, 'KW', 'Kuwait', 965),
(118, 'KG', 'Kyrgyzstan', 996),
(119, 'LA', 'Laos', 856),
(120, 'LV', 'Latvia', 371),
(121, 'LB', 'Lebanon', 961),
(122, 'LS', 'Lesotho', 266),
(123, 'LR', 'Liberia', 231),
(124, 'LY', 'Libya', 218),
(125, 'LI', 'Liechtenstein', 423),
(126, 'LT', 'Lithuania', 370),
(127, 'LU', 'Luxembourg', 352),
(128, 'MO', 'Macau S.A.R.', 853),
(129, 'MK', 'Macedonia', 389),
(130, 'MG', 'Madagascar', 261),
(131, 'MW', 'Malawi', 265),
(132, 'MY', 'Malaysia', 60),
(133, 'MV', 'Maldives', 960),
(134, 'ML', 'Mali', 223),
(135, 'MT', 'Malta', 356),
(136, 'XM', 'Man (Isle of)', 44),
(137, 'MH', 'Marshall Islands', 692),
(138, 'MQ', 'Martinique', 596),
(139, 'MR', 'Mauritania', 222),
(140, 'MU', 'Mauritius', 230),
(141, 'YT', 'Mayotte', 269),
(142, 'MX', 'Mexico', 52),
(143, 'FM', 'Micronesia', 691),
(144, 'MD', 'Moldova', 373),
(145, 'MC', 'Monaco', 377),
(146, 'MN', 'Mongolia', 976),
(147, 'MS', 'Montserrat', 1664),
(148, 'MA', 'Morocco', 212),
(149, 'MZ', 'Mozambique', 258),
(150, 'MM', 'Myanmar', 95),
(151, 'NA', 'Namibia', 264),
(152, 'NR', 'Nauru', 674),
(153, 'NP', 'Nepal', 977),
(154, 'AN', 'Netherlands Antilles', 599),
(155, 'NL', 'Netherlands The', 31),
(156, 'NC', 'New Caledonia', 687),
(157, 'NZ', 'New Zealand', 64),
(158, 'NI', 'Nicaragua', 505),
(159, 'NE', 'Niger', 227),
(160, 'NG', 'Nigeria', 234),
(161, 'NU', 'Niue', 683),
(162, 'NF', 'Norfolk Island', 672),
(163, 'MP', 'Northern Mariana Islands', 1670),
(164, 'NO', 'Norway', 47),
(165, 'OM', 'Oman', 968),
(166, 'PK', 'Pakistan', 92),
(167, 'PW', 'Palau', 680),
(168, 'PS', 'Palestinian Territory Occupied', 970),
(169, 'PA', 'Panama', 507),
(170, 'PG', 'Papua new Guinea', 675),
(171, 'PY', 'Paraguay', 595),
(172, 'PE', 'Peru', 51),
(173, 'PH', 'Philippines', 63),
(174, 'PN', 'Pitcairn Island', 0),
(175, 'PL', 'Poland', 48),
(176, 'PT', 'Portugal', 351),
(177, 'PR', 'Puerto Rico', 1787),
(178, 'QA', 'Qatar', 974),
(179, 'RE', 'Reunion', 262),
(180, 'RO', 'Romania', 40),
(181, 'RU', 'Russia', 70),
(182, 'RW', 'Rwanda', 250),
(183, 'SH', 'Saint Helena', 290),
(184, 'KN', 'Saint Kitts And Nevis', 1869),
(185, 'LC', 'Saint Lucia', 1758),
(186, 'PM', 'Saint Pierre and Miquelon', 508),
(187, 'VC', 'Saint Vincent And The Grenadines', 1784),
(188, 'WS', 'Samoa', 684),
(189, 'SM', 'San Marino', 378),
(190, 'ST', 'Sao Tome and Principe', 239),
(191, 'SA', 'Saudi Arabia', 966),
(192, 'SN', 'Senegal', 221),
(193, 'RS', 'Serbia', 381),
(194, 'SC', 'Seychelles', 248),
(195, 'SL', 'Sierra Leone', 232),
(196, 'SG', 'Singapore', 65),
(197, 'SK', 'Slovakia', 421),
(198, 'SI', 'Slovenia', 386),
(199, 'XG', 'Smaller Territories of the UK', 44),
(200, 'SB', 'Solomon Islands', 677),
(201, 'SO', 'Somalia', 252),
(202, 'ZA', 'South Africa', 27),
(203, 'GS', 'South Georgia', 0),
(204, 'SS', 'South Sudan', 211),
(205, 'ES', 'Spain', 34),
(206, 'LK', 'Sri Lanka', 94),
(207, 'SD', 'Sudan', 249),
(208, 'SR', 'Suriname', 597),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', 47),
(210, 'SZ', 'Swaziland', 268),
(211, 'SE', 'Sweden', 46),
(212, 'CH', 'Switzerland', 41),
(213, 'SY', 'Syria', 963),
(214, 'TW', 'Taiwan', 886),
(215, 'TJ', 'Tajikistan', 992),
(216, 'TZ', 'Tanzania', 255),
(217, 'TH', 'Thailand', 66),
(218, 'TG', 'Togo', 228),
(219, 'TK', 'Tokelau', 690),
(220, 'TO', 'Tonga', 676),
(221, 'TT', 'Trinidad And Tobago', 1868),
(222, 'TN', 'Tunisia', 216),
(223, 'TR', 'Turkey', 90),
(224, 'TM', 'Turkmenistan', 7370),
(225, 'TC', 'Turks And Caicos Islands', 1649),
(226, 'TV', 'Tuvalu', 688),
(227, 'UG', 'Uganda', 256),
(228, 'UA', 'Ukraine', 380),
(229, 'AE', 'United Arab Emirates', 971),
(230, 'GB', 'United Kingdom', 44),
(231, 'US', 'United States', 1),
(232, 'UM', 'United States Minor Outlying Islands', 1),
(233, 'UY', 'Uruguay', 598),
(234, 'UZ', 'Uzbekistan', 998),
(235, 'VU', 'Vanuatu', 678),
(236, 'VA', 'Vatican City State (Holy See)', 39),
(237, 'VE', 'Venezuela', 58),
(238, 'VN', 'Vietnam', 84),
(239, 'VG', 'Virgin Islands (British)', 1284),
(240, 'VI', 'Virgin Islands (US)', 1340),
(241, 'WF', 'Wallis And Futuna Islands', 681),
(242, 'EH', 'Western Sahara', 212),
(243, 'YE', 'Yemen', 967),
(244, 'YU', 'Yugoslavia', 38),
(245, 'ZM', 'Zambia', 260),
(246, 'ZW', 'Zimbabwe', 263);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faqs`
--

CREATE TABLE `tbl_faqs` (
  `id` int(11) NOT NULL,
  `question` varchar(500) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_faqs`
--

INSERT INTO `tbl_faqs` (`id`, `question`, `answer`) VALUES
(1, 'What Are The Delivery Charges?', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\r\n'),
(2, 'How Long Will My Order Take To Arrive?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.'),
(3, 'What Is The Estimated Delivery Time?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia.'),
(4, 'Do You Ship Internationally?', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage.'),
(5, 'How Do I Take Advantage Of FREE Shipping?', '<p>Variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage.</p>\r\n'),
(6, 'There Are Many Variations Of Passages ?', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia.</p>\r\n'),
(7, 'Why Have I Not Received My Product Yet?', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable.</p>\r\n'),
(8, 'What Are The Delivery Charges?', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_favorites`
--

CREATE TABLE `tbl_favorites` (
  `mem_id` int(11) NOT NULL,
  `ref_id` int(11) NOT NULL,
  `ref_type` enum('episode','novel','comment') NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_favorites`
--

INSERT INTO `tbl_favorites` (`mem_id`, `ref_id`, `ref_type`, `date`) VALUES
(1, 2, 'novel', '2018-10-12 06:38:53'),
(1, 5, 'episode', '2018-10-12 06:40:46'),
(2, 6, 'episode', '2018-10-12 08:51:11'),
(2, 2, 'episode', '2018-10-12 08:51:20'),
(1, 4, 'episode', '2018-10-16 08:31:10'),
(1, 1, 'novel', '2018-10-16 09:10:14'),
(1, 2, 'episode', '2018-10-16 13:39:50'),
(1, 6, 'episode', '2018-10-17 09:49:21'),
(1, 1, 'episode', '2018-10-17 13:53:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_followers`
--

CREATE TABLE `tbl_followers` (
  `mem_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_founders`
--

CREATE TABLE `tbl_founders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(500) NOT NULL,
  `overview` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_founders`
--

INSERT INTO `tbl_founders` (`id`, `name`, `designation`, `overview`, `image`) VALUES
(2, 'Joe Gebbia', 'CPO & Co-Founder', 'Joe Gebbia is the co-founder and CPO of Snap Sell Motors, serving on the Board of Directors and Executive staff, while leading Samara, Snap Sell Motors’s in-house design and innovation studio. An entrepreneur from an early age, Snap Sell Motors’s groundbreaking service began in his San Francisco apartment and spread to 3 million+ listings in over 191 countries, creating a new economy for thousands of people around the world. He is involved in crafting the company culture, shaping the design aesthetic, and innovating future growth opportunities. Joe has spoken globally about both entrepreneurship and design, and received numerous distinctions such as the Inc 30 under 30 and Fortune 40 under 40. His lifelong appreciation for art and design led him to the Rhode Island School of Design (RISD), where he earned dual degrees in Graphic Design and Industrial Design. Gebbia now serves on the institution’s Board of Trustees.', 'image_1531905006_8539.jpg'),
(3, 'Brian Chesky', 'Co-founder, CEO, Head of Community', 'Brian is the CEO and head of Community at MixMe Marketplace. He drives the company’s vision, strategy and growth as it provides interesting and unique ways for people to travel, as well as representing the interests of the millions of MixMe Marketplace hosts around the World.Under Brian’s leadership, MixMe Marketplace stands at the forefront of the sharing economy, and has expanded to over 3 million+ listings in more than 191 countries, as well as expanding into other areas of travel with MixMe Marketplace Trips. Brian met co-founder Joe Gebbia at the Rhode Island School of Design (RISD) where he received a Bachelor of Fine Arts in Industrial Design.', 'image_1531904992_2705.jpg'),
(4, 'Nathan Blecharczyk', 'CSO & Co-Founder', 'Nathan is the co-founder and Chief Strategy Officer at Snap Sell Motors. Nathan plays a leading role in driving key strategic initiatives across the global business. Previously he oversaw the creation of Snap Sell Motors’s engineering, data science, and performance marketing teams. Nathan became an entrepreneur in his youth, running a business whilehe was in high school that sold to clients in more than 20 countries. He earned a degree in Computer Science from Harvard University and held several engineering positions before co-founding Snap Sell Motors. As a guest, Nathan has stayed in hundreds of homes using Snap Sell Motors and he is also a host in San Francisco, where he lives with his family.', 'image_1531905014_9833.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lessons`
--

CREATE TABLE `tbl_lessons` (
  `id` int(11) UNSIGNED NOT NULL,
  `encoded_id` varchar(255) DEFAULT NULL,
  `tutor_id` int(11) UNSIGNED NOT NULL,
  `student_id` int(11) UNSIGNED NOT NULL,
  `subject_id` int(11) NOT NULL,
  `lesson_date_time` datetime NOT NULL,
  `hours` float NOT NULL,
  `lesson_type` enum('In Person','Online') NOT NULL DEFAULT 'In Person',
  `video_session_id` varchar(255) DEFAULT NULL,
  `student_connected` int(11) NOT NULL DEFAULT '0' COMMENT '0-not connected,1 for connected',
  `tutor_connected` int(11) DEFAULT '0' COMMENT '0-not connected,1 for connected',
  `video_start_time` datetime DEFAULT NULL,
  `video_end_time` datetime DEFAULT NULL,
  `video_max_join_time` datetime DEFAULT NULL,
  `video_lesson_status` tinyint(1) DEFAULT '0',
  `address` varchar(255) DEFAULT NULL,
  `detail` text,
  `amount` float NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '''0 for pending, 1 for accepted, 2 for confirmed, 3 for rejected''',
  `completed` tinyint(11) NOT NULL DEFAULT '0' COMMENT '''0 for pending, 1 for complete request, 2 for completed''',
  `final_date` date DEFAULT NULL,
  `final_start_time` varchar(10) DEFAULT NULL,
  `final_end_time` varchar(10) DEFAULT NULL,
  `canceled` tinyint(4) NOT NULL DEFAULT '0',
  `canceled_by` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tutor_noti` tinyint(4) NOT NULL DEFAULT '0',
  `student_noti` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_lessons`
--

INSERT INTO `tbl_lessons` (`id`, `encoded_id`, `tutor_id`, `student_id`, `subject_id`, `lesson_date_time`, `hours`, `lesson_type`, `video_session_id`, `student_connected`, `tutor_connected`, `video_start_time`, `video_end_time`, `video_max_join_time`, `video_lesson_status`, `address`, `detail`, `amount`, `status`, `completed`, `final_date`, `final_start_time`, `final_end_time`, `canceled`, `canceled_by`, `date`, `tutor_noti`, `student_noti`) VALUES
(1, 'g5d3m3m4k365p483', 3, 2, 4, '2019-04-01 15:00:00', 2.5, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, 'California', 'I have been a professional model since I was 16 years old. I have done both paid and charity work. I have done a variety of different styles of photo shoots, promotional and runway events.', 375, 2, 2, '2019-04-01', '15:04', '17:04', 0, NULL, '2019-03-19 01:23:19', 0, 0),
(2, 'g5d3m3m4k365t483', 3, 2, 1, '2019-03-31 09:00:00', 1.5, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, 'California1', 'I have been a professional model since I was 16 years old. I have done both paid and charity work. I have done a variety of different styles of photo shoots, promotional and runway events1.', 225, 3, 0, NULL, NULL, NULL, 0, NULL, '2019-03-19 07:39:39', 0, 0),
(3, 'g5d3m3m4k365x483', 3, 4, 4, '2019-04-07 17:00:00', 1, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, 'New Yark', 'This is testing description to test this module for better performance so please don&#039;t mind if there any kind of mistake like spelling aur grammatically.', 150, 2, 2, '2019-04-07', '17:04', '18:04', 0, NULL, '2019-04-02 11:09:08', 0, 1),
(4, 'g5d3m3m4k3651583', 3, 2, 4, '2019-04-07 14:00:00', 1.5, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, 'Loss Angles', 'This is my first testing lesson to test this module for testing purpose please don not mind if there is any spell mistake or grammar mistake', 225, 2, 2, '2019-04-07', '14:00', '15:30', 0, NULL, '2019-04-03 09:15:59', 1, 0),
(5, 'g5d3m3m4k3655583', 3, 2, 4, '2019-03-30 14:00:00', 1, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, 'test', 'test', 150, 2, 2, '2019-03-30', '14:00', '15:00', 0, NULL, '2019-04-03 09:36:50', 0, 0),
(6, 'g5d3m3m4k3659583', 3, 2, 1, '2019-04-21 13:00:00', 1, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, 'California', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 150, 1, 0, NULL, NULL, NULL, 0, NULL, '2019-04-04 08:23:00', 0, 0),
(16, 'g5d3m3m4k365p4x2', 3, 2, 1, '2019-04-14 16:00:00', 1, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, 'Down Town California', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#039;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#039;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary', 150, 2, 0, '2019-05-20', '13:00', '14:00', 1, 2, '2019-04-04 12:07:18', 1, 0),
(17, 'g5d3m3m4k365p4y2', 3, 4, 4, '2019-04-14 13:00:00', 1, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, 'New Down Town California', 'this is testing lesson', 150, 2, 0, NULL, NULL, NULL, 0, NULL, '2019-04-10 13:42:40', 1, 0),
(18, 'g5d3m3m4k365p4z2', 3, 2, 4, '2019-05-19 13:00:00', 1, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, 'New Orleans, LA, USA', 'this is testing detail for a test lesson ', 150, 1, 0, NULL, NULL, NULL, 0, NULL, '2019-05-07 08:17:35', 0, 0),
(19, 'g5d3m3m4k365p403', 3, 2, 1, '2019-05-19 18:00:00', 1, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, 'Testaccio, Rome, Metropolitan City of Rome, Italy', 'test desc', 150, 3, 0, NULL, NULL, NULL, 0, NULL, '2019-05-15 13:03:18', 0, 1),
(21, 'g5d3m3m4k365t4v4', 3, 2, 4, '2019-05-19 12:00:00', 1, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, '26 Bocea Drive', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#039;Content here, content here&#039;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#039;lorem ipsum&#039; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 150, 2, 0, NULL, NULL, NULL, 0, NULL, '2019-05-16 07:54:14', 0, 0),
(22, 'g5d3m3m4k365t4w4', 3, 2, 4, '2019-05-26 16:21:00', 2, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, 'block no 33 house no 133, block no 33 house no 133', 'i will teach you all things', 300, 1, 0, NULL, NULL, NULL, 0, NULL, '2019-05-20 11:21:43', 0, 0),
(23, 'g5d3m3m4k365t4x4', 13, 14, 3, '2019-05-20 17:42:00', 1, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, 'Testaccio, Rome, Metropolitan City of Rome, Italy', 'test', 20, 2, 2, '2019-05-01', '17:52', '19:53', 0, NULL, '2019-05-20 12:42:32', 0, 0),
(24, 'g5d3m3m4k365t4v2', 13, 14, 3, '2019-05-27 18:00:00', 1, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, '29310 Buchanan Drive, Burnet, TX, USA', 'agdsfdsafadsf', 20, 2, 2, '2019-05-07', '18:03', '18:03', 0, NULL, '2019-05-20 13:01:46', 0, 1),
(25, 'g5d3m3m4k365t4w2', 13, 2, 3, '2019-06-04 16:10:00', 1, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, 'Niagara Falls, ON, Canada', 'testng test', 20, 1, 0, NULL, NULL, NULL, 0, NULL, '2019-06-03 11:10:18', 1, 0),
(26, 'g5d3m3m4k365t4x2', 13, 2, 3, '2019-06-10 16:27:00', 1, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, 'Naples, FL, USA', 'testtsestsat', 20, 1, 0, NULL, NULL, NULL, 0, NULL, '2019-06-03 11:28:04', 0, 0),
(27, 'g5d3m3m4k365t4y2', 13, 2, 3, '2019-06-18 16:33:00', 1, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, 'Calicut, Kerala, India', 'dsfkalj', 20, 1, 0, NULL, NULL, NULL, 0, NULL, '2019-06-03 11:33:12', 1, 0),
(28, 'g5d3m3m4k365t4z2', 3, 15, 4, '2019-06-19 18:34:00', 1, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, 'Naples, FL, USA', 'test lesson', 135, 2, 2, '2019-06-12', '18:39', '18:39', 0, NULL, '2019-06-04 13:34:41', 0, 0),
(29, 'g5d3m3m4k365t403', 3, 16, 4, '2019-06-19 14:10:00', 2, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, '12345 Ventura Boulevard, Studio City, CA, USA', 'test', 270, 1, 0, NULL, NULL, NULL, 0, NULL, '2019-06-06 20:04:50', 0, 0),
(30, 'g5d3m3m4k365x4u4', 3, 16, 4, '2019-06-18 15:08:00', 1, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, '4443 test road', 'test', 135, 1, 0, NULL, NULL, NULL, 0, NULL, '2019-06-06 20:08:55', 0, 0),
(31, 'g5d3m3m4k365l483', 0, 0, 0, '0000-00-00 00:00:00', 0, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, '', NULL, 0, 0, 0, NULL, NULL, NULL, 0, NULL, '2019-06-08 19:46:06', 0, 0),
(32, 'g5d3m3m4k365l483', 0, 0, 0, '0000-00-00 00:00:00', 0, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, '', NULL, 0, 0, 0, NULL, NULL, NULL, 0, NULL, '2019-06-08 19:47:59', 0, 0),
(33, 'g5d3m3m4k365x4x4', 3, 15, 4, '2019-06-17 12:47:00', 1.5, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, '4321 765', '6655', 202.5, 3, 0, NULL, NULL, NULL, 0, NULL, '2019-06-08 19:48:21', 0, 1),
(34, 'g5d3m3m4k365x4v2', 3, 15, 4, '2019-06-17 12:47:00', 1.5, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, '4321 765', '6655', 202.5, 2, 2, '2019-06-05', '12:49', '12:49', 0, NULL, '2019-06-08 19:48:22', 0, 0),
(35, 'g5d3m3m4k365x4w2', 3, 15, 4, '2019-06-17 12:47:00', 1.5, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, '4321 765', '6655', 202.5, 0, 0, NULL, NULL, NULL, 0, NULL, '2019-06-08 19:48:22', 1, 1),
(36, 'g5d3m3m4k365x4x2', 3, 15, 4, '2019-06-17 15:47:00', 1.5, 'Online', NULL, 0, 0, NULL, NULL, NULL, 0, NULL, '6655', 202.5, 0, 0, NULL, NULL, NULL, 0, NULL, '2019-09-03 19:48:22', 0, 1),
(40, 'g5d3m3m4k36515u4', 3, 2, 4, '2019-09-04 16:00:00', 1, 'Online', '2_MX40NjQyMDE0Mn4zOS41Mi4xMDEuMTQ1fjE1NjgyOTgxNjEwNTJ-YkpwY21wbkNTKzZCK29wNWlpVklyNXEzfn4', 0, 0, '2019-09-13 01:52:00', '2019-09-13 02:52:00', NULL, 1, NULL, 'afdsdsfdsf', 140, 2, 0, NULL, NULL, NULL, 0, NULL, '2019-08-30 13:12:54', 0, 0),
(41, 'g5d3m3m4k36515v4', 28, 2, 14, '2019-09-10 12:00:00', 1, 'Online', NULL, 0, 0, NULL, NULL, NULL, 0, NULL, '23', 45, 0, 0, NULL, NULL, NULL, 0, NULL, '2019-09-06 21:24:52', 1, 0),
(42, 'g5d3m3m4k36515w4', 3, 22, 4, '2019-09-10 00:00:00', 1, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, 'Test', '', 140, 0, 0, NULL, NULL, NULL, 0, NULL, '2019-09-10 11:31:09', 0, 0),
(51, 'g5d3m3m4k36555v4', 64, 66, 81, '2019-09-19 00:00:00', 2, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, 'Los Angeles, CA, USA', '', 48, 1, 0, NULL, NULL, NULL, 0, NULL, '2019-09-12 13:27:58', 1, 1),
(58, 'g5d3m3m4k36555z2', 64, 68, 80, '2019-09-13 00:00:00', 3.5, 'In Person', NULL, 0, 0, NULL, NULL, NULL, 0, 'Los Angeles, CA, USA', 'Hi, i want to learn computer lessons', 84, 0, 0, NULL, NULL, NULL, 0, NULL, '2019-09-12 13:44:22', 1, 0),
(59, 'g5d3m3m4k3655503', 3, 2, 74, '2019-09-12 04:55:00', 1, 'Online', '1_MX40NjQyMDE0Mn4xMDguMTg0LjE1OS44OH4xNTY4Mjk5MzcwNzMzfmV3YVVNcmZ3anNhWnRFMFNyT2F3b2g4UH5-', 0, 0, '2019-09-13 02:12:00', '2019-09-13 03:12:00', NULL, 1, NULL, 'this is a testing lesson ', 154, 2, 0, NULL, NULL, NULL, 0, NULL, '2019-09-12 17:01:49', 1, 0),
(65, 'g5d3m3m4k36595w2', 3, 2, 75, '2019-09-16 16:00:00', 1.5, 'Online', '2_MX40NjQyMDE0Mn5-MTU2ODYzNzAwNDk0NH5JQ1N0bVdSTXQvV1JpSkduRXJjVnFpNm9-fg', 0, 0, '2019-09-16 16:31:00', '2019-09-16 18:01:00', NULL, 1, NULL, 'dsafds', 210, 2, 0, NULL, NULL, NULL, 0, NULL, '2019-09-12 18:03:52', 0, 0),
(66, 'g5d3m3m4k36595x2', 3, 2, 74, '2019-09-25 19:00:00', 1, 'Online', NULL, 0, 0, NULL, '2019-09-25 20:30:00', NULL, 0, NULL, 'n/a', 140, 0, 0, NULL, NULL, NULL, 0, NULL, '2019-09-25 13:17:17', 1, 0),
(67, 'g5d3m3m4k36595y2', 21, 22, 1, '2019-10-10 15:00:00', 1.5, 'Online', '2_MX40NjQzNjA1Mn5-MTU3MDY4NzU4NzM4Nn5nM2lpRFZqRHN4cDFUMldXOE1URHZrek1-fg', 1, 1, '2019-10-09 04:17:36', '2019-10-09 05:17:36', '2019-10-03 14:00:00', 0, NULL, '', 140, 2, 1, '2019-10-09', '14:40', '15:40', 0, NULL, '2019-09-25 13:20:30', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs`
--

CREATE TABLE `tbl_logs` (
  `id` int(11) NOT NULL,
  `tutor_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `log_created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_logs`
--

INSERT INTO `tbl_logs` (`id`, `tutor_id`, `student_id`, `subject_id`, `log_created_time`) VALUES
(1, 21, 22, 1, '2019-10-09 22:48:26'),
(2, 21, 22, 1, '2019-10-09 23:05:41'),
(3, 21, 22, 1, '2019-10-09 23:05:44'),
(4, 21, 22, 1, '2019-10-09 23:06:30'),
(5, 21, 22, 1, '2019-10-09 23:06:32'),
(6, 21, 22, 1, '2019-10-09 23:08:09'),
(7, 21, 22, 1, '2019-10-09 23:08:23'),
(8, 21, 22, 1, '2019-10-09 23:08:48'),
(9, 21, 22, 1, '2019-10-09 23:09:11'),
(10, 21, 22, 1, '2019-10-09 23:50:55'),
(11, 21, 22, 1, '2019-10-09 23:50:56'),
(12, 21, 22, 1, '2019-10-09 23:52:08'),
(13, 21, 22, 1, '2019-10-09 23:52:09'),
(14, 21, 22, 1, '2019-10-09 23:52:43'),
(15, 21, 22, 1, '2019-10-09 23:52:46'),
(16, 21, 22, 1, '2019-10-09 23:53:27'),
(17, 21, 22, 1, '2019-10-09 23:53:29'),
(18, 21, 22, 1, '2019-10-09 23:54:00'),
(19, 21, 22, 1, '2019-10-09 23:54:03'),
(20, 21, 22, 1, '2019-10-09 23:56:19'),
(21, 21, 22, 1, '2019-10-09 23:56:23'),
(22, 21, 22, 1, '2019-10-09 23:57:03'),
(23, 21, 22, 1, '2019-10-09 23:58:17'),
(24, 21, 22, 1, '2019-10-10 00:00:13'),
(25, 21, 22, 1, '2019-10-09 23:59:38'),
(26, 21, 22, 1, '2019-10-10 00:00:49'),
(27, 21, 22, 1, '2019-10-10 00:00:52'),
(28, 21, 22, 1, '2019-10-10 00:01:47'),
(29, 21, 22, 1, '2019-10-10 00:03:02'),
(30, 21, 22, 1, '2019-10-10 00:03:05'),
(31, 21, 22, 1, '2019-10-10 00:03:43'),
(32, 21, 22, 1, '2019-10-10 00:03:46'),
(33, 21, 22, 1, '2019-10-10 00:04:58'),
(34, 21, 22, 1, '2019-10-10 00:04:59'),
(35, 21, 22, 1, '2019-10-10 00:06:20'),
(36, 21, 22, 1, '2019-10-10 00:06:21'),
(37, 21, 22, 1, '2019-10-10 00:07:28'),
(38, 21, 22, 1, '2019-10-10 00:07:30'),
(39, 21, 22, 1, '2019-10-10 00:11:50'),
(40, 21, 22, 1, '2019-10-10 00:12:30'),
(41, 21, 22, 1, '2019-10-10 02:25:01'),
(42, 21, 22, 1, '2019-10-10 02:24:59'),
(43, 21, 22, 1, '2019-10-10 02:25:46'),
(44, 21, 22, 1, '2019-10-10 02:25:47');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_members`
--

CREATE TABLE `tbl_members` (
  `mem_id` int(11) NOT NULL,
  `mem_remember` varchar(255) DEFAULT NULL,
  `mem_token` varchar(100) DEFAULT NULL,
  `mem_type` enum('student','tutor') DEFAULT NULL,
  `mem_social_type` varchar(255) DEFAULT 'website',
  `mem_social_id` varchar(255) DEFAULT NULL,
  `mem_fname` varchar(255) DEFAULT NULL,
  `mem_lname` varchar(255) DEFAULT NULL,
  `mem_email` varchar(255) DEFAULT NULL,
  `mem_pswd` varchar(255) DEFAULT NULL,
  `mem_code` varchar(255) NOT NULL,
  `mem_phone` varchar(255) DEFAULT NULL,
  `mem_sex` enum('male','female','other') DEFAULT NULL,
  `mem_dob` varchar(50) DEFAULT NULL,
  `mem_website` varchar(255) NOT NULL,
  `mem_about` text,
  `mem_profile_heading` varchar(255) DEFAULT NULL,
  `mem_image` varchar(100) DEFAULT NULL,
  `mem_cover_image` varchar(255) NOT NULL,
  `mem_street` varchar(100) DEFAULT NULL,
  `mem_address1` varchar(255) NOT NULL,
  `mem_address2` varchar(255) NOT NULL,
  `mem_city` varchar(255) NOT NULL,
  `mem_state_id` int(11) NOT NULL,
  `mem_zip` varchar(100) DEFAULT NULL,
  `mem_country_id` int(11) NOT NULL,
  `mem_ip` varchar(255) NOT NULL,
  `mem_note` varchar(255) DEFAULT NULL,
  `mem_birthplace` varchar(255) DEFAULT NULL,
  `mem_hear_about` varchar(255) DEFAULT NULL,
  `mem_referral_code` varchar(6) DEFAULT NULL,
  `mem_hourly_rate` float DEFAULT NULL,
  `mem_school_name` varchar(255) DEFAULT NULL,
  `mem_major_subject` varchar(255) DEFAULT NULL,
  `mem_graduation_year` int(11) DEFAULT NULL,
  `mem_travel_radius` float DEFAULT NULL,
  `mem_fb_link` varchar(255) DEFAULT NULL,
  `mem_twitter_link` varchar(255) DEFAULT NULL,
  `mem_linkedin_link` varchar(255) DEFAULT NULL,
  `mem_youtube_link` varchar(255) DEFAULT NULL,
  `mem_paypal` varchar(255) DEFAULT NULL,
  `mem_stripe_id` varchar(255) DEFAULT NULL,
  `mem_map_lat` varchar(500) DEFAULT NULL,
  `mem_map_lng` varchar(500) DEFAULT NULL,
  `mem_seller` int(1) NOT NULL DEFAULT '0',
  `mem_tutor_application` tinyint(4) NOT NULL DEFAULT '0',
  `mem_phone_code` varchar(6) DEFAULT NULL,
  `mem_email_verified` tinyint(4) NOT NULL DEFAULT '0',
  `mem_tutor_verified` tinyint(4) NOT NULL DEFAULT '0',
  `mem_verified` int(1) NOT NULL DEFAULT '0',
  `mem_status` int(1) NOT NULL DEFAULT '1',
  `mem_featured` int(1) DEFAULT '0',
  `mem_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mem_last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `session_start` int(11) NOT NULL DEFAULT '0' COMMENT '0-not started,1-m started'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_members`
--

INSERT INTO `tbl_members` (`mem_id`, `mem_remember`, `mem_token`, `mem_type`, `mem_social_type`, `mem_social_id`, `mem_fname`, `mem_lname`, `mem_email`, `mem_pswd`, `mem_code`, `mem_phone`, `mem_sex`, `mem_dob`, `mem_website`, `mem_about`, `mem_profile_heading`, `mem_image`, `mem_cover_image`, `mem_street`, `mem_address1`, `mem_address2`, `mem_city`, `mem_state_id`, `mem_zip`, `mem_country_id`, `mem_ip`, `mem_note`, `mem_birthplace`, `mem_hear_about`, `mem_referral_code`, `mem_hourly_rate`, `mem_school_name`, `mem_major_subject`, `mem_graduation_year`, `mem_travel_radius`, `mem_fb_link`, `mem_twitter_link`, `mem_linkedin_link`, `mem_youtube_link`, `mem_paypal`, `mem_stripe_id`, `mem_map_lat`, `mem_map_lng`, `mem_seller`, `mem_tutor_application`, `mem_phone_code`, `mem_email_verified`, `mem_tutor_verified`, `mem_verified`, `mem_status`, `mem_featured`, `mem_date`, `mem_last_login`, `session_start`) VALUES
(1, 'g5s3u3l4x3v565w4x465n453', 'ad9obk41c8vrjoof1ulh2bsoqa3ehbqv', 'tutor', 'website', NULL, 'Sarim', 'Khan', 'sarim@gmail.com', 'i5c3u3r484q4p4w4y486z453', 'v4o3t2r4x3a5u4n4j575k4i4i504a3g48473z2n52464u253', '3216010544', '', NULL, '', '<p>I have been a professional model since I was 16 years old. I have done both paid and charity work. I have done a variety of different styles of photo shoots, promotional and runway events.</p>', 'I have been a professional teacher since I was 16 years old.', 'da8ce53cf0240070ce6c69c48cd588ee_1548853468_2254.jpg', '', NULL, 'Down Town', '', 'New York', 0, '10001', 231, '', NULL, NULL, 'From a Friend', 'XAFJEP', 20, 'Beacon House', 'English', 2016, 30, NULL, NULL, NULL, NULL, NULL, NULL, '32.083771', '72.6875946', 0, 1, '', 0, 2, 1, 1, 1, '2019-01-18 13:22:12', '2019-03-12 15:17:41', 0),
(2, 'g5s3u3l4x3v565w4x465n453', '7fqmg0mh28g45ibmc6mlv4uqojo0qbc3', 'student', 'website', NULL, 'Student', 'Khan', 'student@gmail.com', 'i5c3u3r484q4p4w4y486z453', '', '3216010543', NULL, NULL, '', 'I have been a professional model since I was 16 years old. I have done both paid and charity work. I have done a variety of different styles of photo shoots, promotional and runway events.', 'I have been a professional teacher since I was 16 years old.', '140f6969d5213fd0ece03148e62e461e_1548855862_1131.jpg', '', NULL, 'Down Town', '', 'New York', 0, '10001', 231, '', NULL, NULL, 'From a Friend', 'XAFJE1', 20, 'Beacon House', 'English', 2016, 20, NULL, NULL, NULL, NULL, NULL, '', '32.0837644', '72.6876025', 0, 0, '298095', 0, 0, 1, 1, 0, '2019-01-18 13:22:12', '2019-06-11 16:56:36', 0),
(3, 'g5s3u3l4x3v565w4x465v453', 'vl86sp942mq3sre091mqr2t9tc2afqmm', 'tutor', 'website', NULL, 'Tutor', 'Khan', 'tutor@gmail.com', 'i5c3u3r484q4p4w4y486z453', 'v4q4t2p284a525t4k5s5o493a5z2p28474r3t4y5t36433o4', '3216010541', '', NULL, '', '<p>I have been a professional model since I was 16 years old. I have done both paid and charity work. I have done a variety of different styles of photo shoots, promotional and runway events.</p><p>Some charities I participated in runway modeling events for:</p><ol><li>PETA (People for the Ethical Treatment of Animals)</li><li>American Cancer Society</li><li>Habitat for Humanity</li></ol><p><strong>Photographers:</strong></p><ol><li>to be is not to be</li></ol><p>Since I am experienced, I ask for compensation for our time together. I have reasonable rates, depending on the type of shoot and location.</p><p>I can provide accessories and clothing for the style of photo shoot or video we are creating (bikini, fitness, fetish, high fashion, lingerie, urban, etc.).</p><p>I can provide a variety of facial expressions and poses.</p><p>I have the most experience with modeling high fashion clothing, but also experience with commercial fashion and other types of modeling.</p><p>I am willing to work with any ideas you might have as far as a photo shoot or video.</p><p>If we work together, I will be respectful and accountable and expect the same in return.</p><p>To view more of my work, visit my Model Mayhem profile: https://www.modelmayhem.com/Cassiemodel.</p><p>Please send me a message on the site or email me directly at cassiemodel123@gmail.com, if you would like to work together.</p><p>Thank you for visiting my profile.</p>', 'Testing 123', 'e2a2dcc36a08a345332c751b2f2e476c_1560291051_5386.png', '', NULL, 'Reno, Nevada', '', 'California', 0, '10001', 231, '', NULL, NULL, 'from friend', 'XAFJE2', 140, 'Center for Advanced Studies in Engineering', 'Mathematics', 2016, 10, NULL, NULL, NULL, NULL, NULL, NULL, '32.0937664', '72.6976055', 0, 1, '819118', 0, 1, 1, 1, 0, '2019-01-21 12:43:23', '2019-06-09 18:20:50', 0),
(4, NULL, 'pbcrogrcnkdn5b9247vaggr6kb39qsj7', 'student', 'website', NULL, 'Asad', 'Ali', 'asad@gmail.com', 'i5c3u3r484q4p4w4y486z453', 'x493x3t2k395q4x4a5950593a5z2p28474r3t4y5t36433o4', '+923015588899', NULL, NULL, '', NULL, NULL, 'd045c59a90d7587d8d671b5f5aec4e7c_1551941985_4869.jpg', '', NULL, 'Down town kabul', '', 'Kabul', 0, '123', 1, '', NULL, NULL, 'From Sarim Khan', 'XAFJE3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 0, 0, NULL, 1, 0, 1, 1, 0, '2019-02-21 12:22:41', '2019-04-09 22:41:02', 0),
(6, NULL, NULL, 'student', 'website', NULL, 'Tipu', 'Khan', 'tipu@gmail.com', 'i5c3u3r484q4p4w4y486z453', 'v4p3d3t2k3a525n4k5u44593a5z2p28474r3t4y5t36433o4', '+923246352456', NULL, NULL, '', NULL, NULL, NULL, '', NULL, '', '', '', 0, NULL, 0, '', NULL, NULL, 'From a Altaf Bhai', 'XAFJE4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 0, 0, 1, 0, '2019-02-21 12:53:42', '2019-02-20 20:53:42', 0),
(7, NULL, '9di9lj4rlicjklu35ljj37g2dll26a49', 'student', 'website', NULL, 'Sarim', 'Khan', 'sairm@gmail.com', 'i5c3u3r484q4p4w4y486z453', 'v4p3l3q2k3a5y4f4i5a5s4o415k344k4z3r3i4w5g3t5o3q4b4s32333', '2316549877', NULL, NULL, '', NULL, NULL, NULL, '', NULL, '', '', '', 0, NULL, 0, '', NULL, NULL, 'from a friend', 'XAFJE5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 0, 0, 1, 0, '2019-03-12 09:35:32', '2019-03-12 18:26:12', 0),
(8, NULL, 'm0p0n61gcgu0b2j6q8pcbgbb8mgk0oq8', 'tutor', 'website', NULL, 'Tutor', 'Jones', 'tutorjones@gmail.com', 'i5c3u3r484q4p4w4y486z453', 'w4p3x3p4k3a525w2l5t4b4t4h5m4x2l404s3o3i4u364v2c4a4y3o4n4654463o4', '3216010123', NULL, '07/11/1990', '', '<p>this is testing profile bio</p>\r\n', 'Professional', NULL, '', NULL, 'Califorinia', '', '', 0, '123', 0, '', NULL, NULL, 'from a tutor', 'XAFJE6', 100, 'School Of California', 'Math', 2010, 15, NULL, NULL, NULL, NULL, NULL, NULL, '32.0836883', '72.7876140999', 0, 0, '', 0, 1, 1, 1, 0, '2019-03-13 11:12:37', '2019-03-14 10:25:30', 0),
(11, NULL, NULL, 'student', 'website', NULL, 'Ali', 'Khan', 'ali@gmail.com', 'i5c3u3r484q4p4w4y486z453', 'v4r474t2k395q4q4i575k4i4i504a3g48473z2n52464u253', '8123456789', NULL, NULL, '', NULL, NULL, NULL, '', NULL, '', '', '', 0, NULL, 0, '', NULL, NULL, 'test', 'XAFJE7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 0, 0, 1, 0, '2019-03-18 11:31:38', '2019-03-18 19:31:38', 0),
(12, NULL, 'pbcrogrcnkdn5b9247vaggr6kb39qsj7', 'student', 'website', NULL, 'Asad', 'Ali', 'asada@gmail.com', 'i5c3u3r484q4p4w4y486z453', 'x4p3x3q2k395q4x4a59505c415k344k4z3r3i4w5g3t5o3q4b4s32333', '9876543218', NULL, NULL, '', NULL, NULL, 'fc3cf452d3da8402bebb765225ce8c0e_1553583916_5587.jpg', '', NULL, '', '', '', 0, '', 0, '', NULL, NULL, 'from friend', 'J9FY1V', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 0, 0, 1, 0, '2019-03-26 06:35:51', '2019-04-09 22:40:41', 0),
(13, NULL, 'tr646nqhr99k18shjjfucrug3clcq6ma', 'tutor', 'website', NULL, 'Jahanzaib', 'Khalid', 'herosolutions.tk@gmail.com', 'v4p3h3r4m3q455x2', 'x493t3r4k395o5j4k5v5b4u4i5z2o4p2a4b3i4z524u5n3p4d4i3l4737544y2c464y356t475840316', '3227602530', NULL, '01/01/1970', '', '<p>Math parho beta</p>', 'Math guru', '3988c7f88ebcb58c6ce932b957b6f332_1558355165_4752.PNG', '', NULL, 'Asd', '', '', 0, '40100', 0, '', NULL, NULL, '5asd', '545', 20, 'Ambala', 'Math', 2015, 50, NULL, NULL, NULL, NULL, NULL, NULL, '32.083514199999996', '72.6873727', 0, 1, NULL, 0, 1, 1, 1, 0, '2019-05-20 11:23:59', '2019-06-03 16:23:35', 0),
(14, NULL, 'tr646nqhr99k18shjjfucrug3clcq6ma', 'student', 'website', NULL, 'Sarim', 'Khan', 'herosolutions.sarim@gmail.com', 'i5c3u3r484q4p4w4y486z453', 'x4p3b4q4k395o5j4k5v5b4u4i5z2o4p2a4b3i4z524u5n3p4c4x2b3r4e555y293z3x274g4f595q42675r213l4', '3039640929', NULL, NULL, '', NULL, NULL, 'f0adc8838f4bdedde4ec2cfad0515589_1558356191_2447.jpg', '', NULL, '', '', '', 0, '', 0, '', NULL, NULL, 'From a friend', 'IXTROF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'cus_F6MKZlyvJseaiX', NULL, NULL, 0, 0, NULL, 1, 0, 1, 1, 0, '2019-05-20 11:24:26', '2019-05-20 18:33:42', 0),
(15, NULL, 'sev0eq43mfkf6d3rvm6erj85c9qu80jr', 'student', 'website', NULL, 'Ahmad', 'Khan', 'ahmad@gmail.com', 'i5c3u3r484q4p4w4y486z453', 'x493d3t2k395q4m4j595o4f415k344k4z3r3i4w5g3t5o3q4b4s32333', '9326568978', NULL, NULL, '', NULL, NULL, NULL, '', NULL, '', '', '', 0, NULL, 0, '', NULL, NULL, 'from a friend', 'SF4IF9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'cus_FC0l1X4tZypPRT', NULL, NULL, 0, 0, NULL, 1, 0, 1, 1, 0, '2019-06-04 13:31:45', '2019-06-08 13:44:29', 0),
(16, NULL, '05j43baeb1fl215opk66vt6r0hs1kvs2', 'student', 'website', NULL, 'Student', 'Test', 'teststudent@gmail.com', 'i5c3u3r484t4s5s4b586n4t4x4w41313', 'x493l3o4k3a525j4k59405u4k5l3q3b404r3z214l3r4a4o424y3d4l4t4r5r3q474s3j493', '8184057356', NULL, NULL, '', NULL, NULL, 'b9228e0962a78b84f3d5d92f4faa000b_1559851816_7912.png', '', NULL, '', '', '', 0, NULL, 0, '', NULL, NULL, 'tv', 'LAT08K', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'cus_FCrVf50GMvDDLP', NULL, NULL, 0, 0, '', 0, 0, 1, 1, 0, '2019-06-06 20:01:55', '2019-07-01 16:08:17', 0),
(17, 'g5s3u3l4x3v565w4x465n4v2', 'qqu7cssv2olm1ud4b603tn2g0bkp10am', 'tutor', 'website', NULL, 'Tutor', '1', 'tutor1@mailinator.com', 'v4p3d3q4l3s5x4x4z4q4z453', 'x493t3r4k395o5j4k5v5b4u4i5z2o4p2a4b3i4z524u5n3p4d4i3l4737544y2c464y356t475840316', '3227602530', NULL, '01/01/1970', '', '<p>Math parho beta</p>', 'Math guru', '3988c7f88ebcb58c6ce932b957b6f332_1558355165_4752.PNG', '', NULL, 'Asd', '', '', 0, '40100', 0, '', NULL, NULL, '5asd', '545', 20, 'Ambala', 'Math', 2015, 50, NULL, NULL, NULL, NULL, NULL, NULL, '32.083514199999996', '72.6873727', 0, 1, NULL, 1, 1, 1, 1, 0, '2019-05-20 11:23:59', '2019-10-09 05:56:24', 0),
(18, 'g5s3u3l4x3v565w4x465n4w2', '603bcfj7kimt0v6vvjrss44g8ome01fv', 'student', 'website', NULL, 'Student', 'Test', 'teststudent@gmail.com', 'v4p3d3q4l3s5x4x4z4q4z453', 'x493l3o4k3a525j4k59405u4k5l3q3b404r3z214l3r4a4o424y3d4l4t4r5r3q474s3j493', '8184057356', NULL, NULL, '', NULL, NULL, 'b9228e0962a78b84f3d5d92f4faa000b_1559851816_7912.png', '', NULL, '', '', '', 0, NULL, 0, '', NULL, NULL, 'tv', 'LAT08K', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'cus_FCrVf50GMvDDLP', NULL, NULL, 0, 0, '', 1, 1, 1, 1, 0, '2019-06-06 20:01:55', '2019-10-10 05:54:31', 0),
(19, 'g5s3u3l4x3v565w4x465n4x2', 'b2kbcp88vuvuokqf432pjhnbu1337q8f', 'tutor', 'website', NULL, 'Tutor', '2', 'tutor2@mailinator.com', 'v4p3d3q4l3s5x4x4z4q4z453', 'x493t3r4k395o5j4k5v5b4u4i5z2o4p2a4b3i4z524u5n3p4d4i3l4737544y2c464y356t475840316', '3227602530', NULL, '01/01/1970', '', '<p>Math parho beta</p>', 'Math guru', '3988c7f88ebcb58c6ce932b957b6f332_1558355165_4752.PNG', '', NULL, 'Asd', '', '', 0, '40100', 0, '', NULL, NULL, '5asd', '545', 20, 'Ambala', 'Math', 2015, 50, NULL, NULL, NULL, NULL, NULL, NULL, '32.083514199999996', '72.6873727', 0, 1, NULL, 1, 1, 1, 1, 0, '2019-05-20 11:23:59', '2019-07-31 05:42:42', 0),
(20, NULL, 'd3gdvuh5no5gc6e99454fmfd21457d81', 'student', 'website', NULL, 'Student', 'Test2', 'teststudent2@gmail.com', 'v4p3d3q4l3s5x4x4z4q4z453', 'x493l3o4k3a525j4k59405u4k5l3q3b404r3z214l3r4a4o424y3d4l4t4r5r3q474s3j493', '8184057356', NULL, NULL, '', NULL, NULL, 'b9228e0962a78b84f3d5d92f4faa000b_1559851816_7912.png', '', NULL, '', '', '', 0, NULL, 0, '', NULL, NULL, 'tv', 'LAT08K', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'cus_FCrVf50GMvDDLP', NULL, NULL, 0, 0, '', 1, 1, 1, 1, 0, '2019-06-06 20:01:55', '2019-07-31 05:44:05', 0),
(21, 'g5s3u3l4x3v565w4x465n4x2', '9jveb9u6a12klfd70uck4303a7s8hr81', 'tutor', 'website', NULL, 'Tutor', '3', 'tutor3@mailinator.com', 'v4p3d3q4l3s5x4x4z4q4z453', 'x493t3r4k395o5j4k5v5b4u4i5z2o4p2a4b3i4z524u5n3p4d4i3l4737544y2c464y356t475840316', '3227602530', NULL, '01/01/1970', '', '<p>Math parho beta</p>', 'Math guru', '3988c7f88ebcb58c6ce932b957b6f332_1558355165_4752.PNG', '', NULL, 'Asd', '', '', 0, '40100', 0, '', NULL, NULL, '5asd', '545', 20, 'Ambala', 'Math', 2015, 50, NULL, NULL, NULL, NULL, NULL, NULL, '32.083514199999996', '72.6873727', 0, 1, NULL, 1, 1, 1, 1, 0, '2019-05-20 11:23:59', '2019-10-10 05:54:51', 0),
(22, 'g5s3u3l4x3v565w4x465r4t4', '603bcfj7kimt0v6vvjrss44g8ome01fv', 'student', 'website', NULL, 'Student', 'Test3', 'teststudent3@gmail.com', 'v4p3d3q4l3s5x4x4z4q4z453', 'x493l3o4k3a525j4k59405u4k5l3q3b404r3z214l3r4a4o424y3d4l4t4r5r3q474s3j493', '8184057356', NULL, NULL, '', NULL, NULL, 'b9228e0962a78b84f3d5d92f4faa000b_1559851816_7912.png', '', NULL, '', '', '', 0, NULL, 0, '', NULL, NULL, 'tv', 'LAT08K', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'cus_FCrVf50GMvDDLP', NULL, NULL, 0, 0, '', 1, 1, 1, 1, 0, '2019-06-06 20:01:55', '2019-10-10 05:54:44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

CREATE TABLE `tbl_notifications` (
  `id` int(11) NOT NULL,
  `encoded_id` varchar(255) DEFAULT NULL,
  `mem_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL DEFAULT '0',
  `txt` text NOT NULL,
  `cat` enum('comments','subscribed','notes','other') NOT NULL,
  `note_id` int(11) NOT NULL DEFAULT '0',
  `status` enum('new','seen') NOT NULL,
  `date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_notifications`
--

INSERT INTO `tbl_notifications` (`id`, `encoded_id`, `mem_id`, `from_id`, `txt`, `cat`, `note_id`, `status`, `date`) VALUES
(2, NULL, 2, 11, 'Your friend Ali Khan signed up with your referral link. You will be rewarded after they complete their first lesson', 'other', 0, 'seen', '2019-03-18 11:31:38'),
(3, NULL, 3, 2, 'You have a new lesson request from Student Khan. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365p483\" data-link=\"get-request-detail\">click here</a> to view detail.', 'other', 0, 'seen', '2019-03-19 04:23:19'),
(4, NULL, 3, 2, 'You have a new lesson request from Student Khan. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365t483\" data-link=\"get-request-detail\">click here</a> to view detail.', 'other', 0, 'seen', '2019-03-19 11:39:39'),
(8, NULL, 2, 3, 'Your lesson with Tutor Khan. has been canceled.', 'other', 0, 'seen', '2019-03-25 12:02:03'),
(9, NULL, 2, 12, 'Your friend Asad Ali signed up with your referral link. You will be rewarded after they complete their first lesson', 'other', 0, 'seen', '2019-03-26 06:35:51'),
(10, NULL, 2, 3, 'Tutor Khan. has accepted your lesson request. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365p483\" data-link=\"get-request-detail\">click here</a> here to book.', 'other', 0, 'seen', '2019-03-26 09:46:51'),
(13, NULL, 3, 2, 'Your lesson with Student Khan. has been confirmed! You can view your upcoming lesson in <a href=\"http://localhost/clients/crainly/my-lessons\">My Lessons</a>.', 'other', 0, 'seen', '2019-03-27 11:51:21'),
(14, NULL, 2, 3, 'Lesson has been booked!', 'other', 0, 'seen', '2019-03-27 11:51:21'),
(19, NULL, 3, 2, 'Student Khan. reviewed you 4.6 stars. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365p483\" data-link=\"lesson-detail\">click here</a> to view lesson.', 'other', 0, 'seen', '2019-04-02 07:52:31'),
(20, NULL, 2, 3, 'You reviewed Tutor Khan. 4.6 stars. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365p483\" data-link=\"lesson-detail\">click here</a> to view lesson.', 'other', 0, 'seen', '2019-04-02 07:52:31'),
(21, NULL, 3, 4, 'You have a new lesson request from Asad Ali. <a href=\"javascript:void(0)\" class=\"view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365x483\">click here</a> to view detail.', 'other', 0, 'seen', '2019-04-02 11:09:08'),
(22, NULL, 4, 3, 'Tutor Khan. has accepted your lesson request. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365x483\" data-link=\"get-request-detail\">click here</a> to book.', 'other', 0, 'seen', '2019-04-02 11:18:57'),
(23, NULL, 3, 4, 'Your lesson with Asad Ali. has been confirmed! You can view your upcoming lesson in <a href=\"http://localhost/clients/crainly/my-lessons\">My Lessons</a>.', 'other', 0, 'seen', '2019-04-02 11:19:32'),
(24, NULL, 4, 3, 'Lesson has been booked!', 'other', 0, 'seen', '2019-04-02 11:19:32'),
(25, NULL, 4, 3, 'Your lesson with Tutor Khan. is submitted. click here <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365x483\" data-link=\"lesson-detail\">click here</a>  to view lesson.', 'other', 0, 'seen', '2019-04-02 11:20:40'),
(26, NULL, 4, 3, 'Leave a review for your lesson with Tutor Khan. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365x483\" data-link=\"lesson-detail\">click here</a>', 'other', 0, 'seen', '2019-04-02 11:20:40'),
(27, NULL, 3, 4, 'Asad Ali. reviewed you 4.6 stars. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365x483\" data-link=\"lesson-detail\">click here</a> to view lesson.', 'other', 0, 'seen', '2019-04-02 11:31:51'),
(28, NULL, 4, 3, 'You reviewed Tutor Khan. 4.6 stars. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365x483\" data-link=\"lesson-detail\">click here</a> to view lesson.', 'other', 0, 'seen', '2019-04-02 11:31:51'),
(29, NULL, 3, 2, 'You have a new lesson request from Student Khan. <a href=\"javascript:void(0)\" class=\"view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k3651583\">click here</a> to view detail.', 'other', 0, 'seen', '2019-04-03 09:15:59'),
(30, NULL, 2, 3, 'Tutor Khan. has accepted your lesson request. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k3651583\" data-link=\"get-request-detail\">click here</a> to book.', 'other', 0, 'seen', '2019-04-03 09:16:28'),
(35, NULL, 3, 2, 'Your lesson with Student Khan. has been confirmed! You can view your upcoming lesson in <a href=\"http://localhost/clients/crainly/my-lessons\">My Lessons</a>.', 'other', 0, 'seen', '2019-04-03 09:25:42'),
(36, NULL, 2, 3, 'Lesson has been booked!', 'other', 0, 'seen', '2019-04-03 09:25:42'),
(37, NULL, 3, 2, 'You have a new lesson request from Student Khan. <a href=\"javascript:void(0)\" class=\"view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k3655583\">click here</a> to view detail.', 'other', 0, 'seen', '2019-04-03 09:36:50'),
(38, NULL, 2, 3, 'Tutor Khan. has accepted your lesson request. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k3655583\" data-link=\"get-request-detail\">click here</a> to book.', 'other', 0, 'seen', '2019-04-03 09:37:00'),
(39, NULL, 3, 2, 'Your lesson with Student Khan. has been confirmed! You can view your upcoming lesson in <a href=\"http://localhost/clients/crainly/my-lessons\">My Lessons</a>.', 'other', 0, 'seen', '2019-04-03 09:37:42'),
(40, NULL, 2, 3, 'Lesson has been booked!', 'other', 0, 'seen', '2019-04-03 09:37:42'),
(41, NULL, 2, 3, 'Your lesson with Tutor Khan. is submitted. click here <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k3655583\" data-link=\"lesson-detail\">click here</a>  to view lesson.', 'other', 0, 'seen', '2019-04-03 09:38:33'),
(42, NULL, 2, 3, 'Leave a review for your lesson with Tutor Khan. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k3655583\" data-link=\"lesson-detail\">click here</a>', 'other', 0, 'seen', '2019-04-03 09:38:33'),
(43, NULL, 3, 2, 'Student Khan. reviewed you 4.7 stars. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k3655583\" data-link=\"lesson-detail\">click here</a> to view lesson.', 'other', 0, 'seen', '2019-04-03 09:38:58'),
(44, NULL, 2, 3, 'You reviewed Tutor Khan. 4.7 stars. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k3655583\" data-link=\"lesson-detail\">click here</a> to view lesson.', 'other', 0, 'seen', '2019-04-03 09:38:58'),
(55, NULL, 3, 2, 'You have a new lesson request from Student Khan. <a href=\"javascript:void(0)\" class=\"view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365p4x2\">click here</a> to view detail.', 'other', 0, 'seen', '2019-04-04 12:07:18'),
(64, NULL, 2, 3, 'Tutor Khan. has accepted your lesson request. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365p4x2\" data-link=\"get-request-detail\">click here</a> to book.', 'other', 0, 'seen', '2019-04-04 14:01:35'),
(65, NULL, 3, 2, 'Your lesson with Student Khan. has been confirmed! You can view your upcoming lesson in <a href=\"http://localhost/clients/crainly/my-lessons\">My Lessons</a>.', 'other', 0, 'seen', '2019-04-05 08:45:20'),
(66, NULL, 2, 3, 'Lesson has been booked!', 'other', 0, 'seen', '2019-04-05 08:45:20'),
(87, NULL, 2, 3, 'Your lesson with Tutor Khan. is submitted. click here <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k3651583\" data-link=\"lesson-detail\">click here</a>  to view lesson.', 'other', 0, 'seen', '2019-04-10 09:02:13'),
(88, NULL, 2, 3, 'Leave a review for your lesson with Tutor Khan. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k3651583\" data-link=\"lesson-detail\">click here</a>', 'other', 0, 'seen', '2019-04-10 09:02:13'),
(91, NULL, 3, 2, 'Student Khan. reviewed you 4.9 stars. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k3651583\" data-link=\"lesson-detail\">click here</a> to view lesson.', 'other', 0, 'seen', '2019-04-10 09:11:32'),
(92, NULL, 2, 3, 'You reviewed Tutor Khan. 4.9 stars. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k3651583\" data-link=\"lesson-detail\">click here</a> to view lesson.', 'other', 0, 'seen', '2019-04-10 09:11:32'),
(93, NULL, 3, 4, 'You have a new lesson request from Asad Ali. <a href=\"javascript:void(0)\" class=\"view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365p4y2\">click here</a> to view detail.', 'other', 0, 'seen', '2019-04-10 13:42:40'),
(94, NULL, 4, 3, 'Tutor Khan. has accepted your lesson request. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365p4y2\" data-link=\"get-request-detail\">click here</a> to book.', 'other', 0, 'seen', '2019-04-11 11:07:10'),
(95, NULL, 3, 4, 'Your lesson with Asad Ali. has been confirmed! You can view your upcoming lesson in <a href=\"http://localhost/clients/crainly/my-lessons\">My Lessons</a>.', 'other', 0, 'seen', '2019-04-11 12:26:44'),
(96, NULL, 4, 3, 'Lesson has been booked!', 'other', 0, 'seen', '2019-04-11 12:26:44'),
(97, 'g5f4q3h4k365r5y2', 2, 3, 'Tutor Khan. has accepted your lesson request. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k3659583\" data-link=\"get-request-detail\">click here</a> to book.', 'other', 0, 'seen', '2019-04-18 11:14:01'),
(98, 'g5f4q3h4k365r5z2', 3, 2, 'You have a new lesson request from Student Khan. <a href=\"javascript:void(0)\" class=\"view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365p4z2\">click here</a> to view detail.', 'other', 0, 'seen', '2019-05-07 08:17:35'),
(99, 'g5f4q3h4k365r503', 2, 3, 'Tutor Khan. has accepted your lesson request. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365p4z2\" data-link=\"get-request-detail\">click here</a> to book.', 'other', 0, 'seen', '2019-05-07 08:18:03'),
(101, 'g5f4q3h4k365p4u4y435f453', 2, 3, 'Tutor Khan.scheduled a lesson with you <a href=\"javascript:void(0)\" class=\"view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365t4v4\">click here</a> to view detail.', 'other', 0, 'seen', '2019-05-16 07:54:14'),
(102, 'g5f4q3h4k365p4u4y4p5f453', 3, 2, 'Your lesson with Student Khan. has been confirmed! You can view your upcoming lesson in <a href=\"http://localhost/clients/crainly/my-lessons\">My Lessons</a>.', 'other', 0, 'seen', '2019-05-17 09:42:13'),
(103, 'g5f4q3h4k365p4u4y456f453', 2, 3, 'Lesson has been booked!', 'other', 0, 'seen', '2019-05-17 09:42:13'),
(104, 'g5f4q3h4k365p4u4z4n4f453', 2, 3, 'Your lesson request with Tutor Khan. has been rejected.', 'other', 0, 'seen', '2019-05-18 23:47:15'),
(105, 'g5f4q3h4k365p4u4z435f453', 2, 3, 'Tutor Khan.scheduled a lesson with you <a href=\"javascript:void(0)\" class=\"view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365t4w4\">click here</a> to view detail.', 'other', 0, 'seen', '2019-05-20 11:21:43'),
(106, 'g5f4q3h4k365p4u4z4p5f453', 14, 13, 'Jahanzaib Khalid.scheduled a lesson with you <a href=\"javascript:void(0)\" class=\"view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365t4x4\">click here</a> to view detail.', 'other', 0, 'seen', '2019-05-20 12:42:32'),
(107, 'g5f4q3h4k365p4u4z456f453', 13, 14, 'Your lesson with Sarim Khan. has been confirmed! You can view your upcoming lesson in <a href=\"https://crainly.com/my-lessons\">My Lessons</a>.', 'other', 0, 'seen', '2019-05-20 12:52:18'),
(108, 'g5f4q3h4k365p4u405n4f453', 14, 13, 'Lesson has been booked!', 'other', 0, 'seen', '2019-05-20 12:52:18'),
(109, 'g5f4q3h4k365p4u40535f453', 14, 13, 'Your lesson with Jahanzaib Khalid. is submitted. click here <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365t4x4\" data-link=\"lesson-detail\">click here</a>  to view lesson.', 'other', 0, 'seen', '2019-05-20 12:53:04'),
(110, 'g5f4q3h4k365p4v4y4n4f453', 14, 13, 'Leave a review for your lesson with Jahanzaib Khalid. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365t4x4\" data-link=\"lesson-detail\">click here</a>', 'other', 0, 'seen', '2019-05-20 12:53:04'),
(111, 'g5f4q3h4k365p4v4y435f453', 13, 14, 'Sarim Khan. reviewed you 4.5 stars. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365t4x4\" data-link=\"lesson-detail\">click here</a> to view lesson.', 'other', 0, 'seen', '2019-05-20 12:56:01'),
(112, 'g5f4q3h4k365p4v4y4p5f453', 14, 13, 'You reviewed Jahanzaib Khalid. 4.5 stars. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365t4x4\" data-link=\"lesson-detail\">click here</a> to view lesson.', 'other', 0, 'seen', '2019-05-20 12:56:01'),
(113, 'g5f4q3h4k365p4v4y456f453', 13, 14, 'You have a new lesson request from Sarim Khan. <a href=\"javascript:void(0)\" class=\"view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365t4v2\">click here</a> to view detail.', 'other', 0, 'seen', '2019-05-20 13:01:46'),
(114, 'g5f4q3h4k365p4v4z4n4f453', 14, 13, 'Jahanzaib Khalid. has accepted your lesson request. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365t4v2\" data-link=\"get-request-detail\">click here</a> to book.', 'other', 0, 'seen', '2019-05-20 13:02:03'),
(115, 'g5f4q3h4k365p4v4z435f453', 13, 14, 'Your lesson with Sarim Khan. has been confirmed! You can view your upcoming lesson in <a href=\"https://crainly.com/my-lessons\">My Lessons</a>.', 'other', 0, 'seen', NULL),
(116, 'g5f4q3h4k365p4v4z4p5f453', 14, 13, 'Lesson has been booked!', 'other', 0, 'seen', NULL),
(117, 'g5f4q3h4k365p4v4z456f453', 14, 13, 'Your lesson with Jahanzaib Khalid. is submitted. click here <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365t4v2\" data-link=\"lesson-detail\">click here</a>  to view lesson.', 'other', 0, 'seen', '2019-05-20 19:03:57'),
(118, 'g5f4q3h4k365p4v405n4f453', 14, 13, 'Leave a review for your lesson with Jahanzaib Khalid. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365t4v2\" data-link=\"lesson-detail\">click here</a>', 'other', 0, 'seen', '2019-05-20 19:03:57'),
(119, 'g5f4q3h4k365p4v40535f453', 13, 14, 'Sarim Khan. reviewed you 4.1 stars. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365t4v2\" data-link=\"lesson-detail\">click here</a> to view lesson.', 'other', 0, 'seen', '2019-05-20 19:04:36'),
(120, 'g5f4q3h4k365p4w4y4n4f453', 14, 13, 'You reviewed Jahanzaib Khalid. 4.1 stars. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365t4v2\" data-link=\"lesson-detail\">click here</a> to view lesson.', 'other', 0, 'seen', '2019-05-20 19:04:36'),
(121, 'g5f4q3h4k365p4w4y435f453', 3, 2, 'Your lesson with Student Khan. has been canceled. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365p4x2\" data-link=\"lesson-detail\">click here</a> to view.', 'other', 0, 'seen', '2019-05-21 05:04:45'),
(122, 'g5f4q3h4k365p4w4y4p5f453', 13, 2, 'You have a new lesson request from Student Khan. <a href=\"javascript:void(0)\" class=\"view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365t4w2\">click here</a> to view detail.', 'other', 0, 'seen', '2019-06-03 17:10:18'),
(123, 'g5f4q3h4k365p4w4y456f453', 2, 13, 'Jahanzaib Khalid.scheduled a lesson with you <a href=\"javascript:void(0)\" class=\"view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365t4x2\">click here</a> to view detail.', 'other', 0, 'seen', '2019-06-03 17:28:04'),
(124, 'g5f4q3h4k365p4w4z4n4f453', 13, 2, 'You have a new lesson request from Student Khan. <a href=\"javascript:void(0)\" class=\"view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365t4y2\">click here</a> to view detail.', 'other', 0, 'new', '2019-06-03 17:33:12'),
(125, 'g5f4q3h4k365p4w4z435f453', 3, 15, 'You have a new lesson request from Ahmad K.. <a href=\"javascript:void(0)\" class=\"view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365t4z2\">click here</a> to view detail.', 'other', 0, 'seen', '2019-06-04 19:34:42'),
(126, 'g5f4q3h4k365p4w4z4p5f453', 15, 3, 'Tutor K.. has accepted your lesson request. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365t4z2\" data-link=\"get-request-detail\">click here</a> to book.', 'other', 0, 'new', '2019-06-04 19:34:59'),
(127, 'g5f4q3h4k365p4w4z456f453', 3, 15, 'Your lesson with Ahmad K.. has been confirmed! You can view your upcoming lesson in <a href=\"https://crainly.com/my-lessons\">My Lessons</a>.', 'other', 0, 'seen', '2019-06-04 19:35:14'),
(128, 'g5f4q3h4k365p4w405n4f453', 15, 3, 'Lesson has been booked!', 'other', 0, 'new', '2019-06-04 19:35:14'),
(129, 'g5f4q3h4k365p4w40535f453', 3, 15, 'Ahmad K.. reviewed you 3 stars. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365t4z2\" data-link=\"lesson-detail\">click here</a> to view lesson.', 'other', 0, 'seen', '2019-06-04 19:39:26'),
(130, 'g5f4q3h4k365p4x4y4n4f453', 15, 3, 'You reviewed Tutor K.. 3 stars. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365t4z2\" data-link=\"lesson-detail\">click here</a> to view lesson.', 'other', 0, 'new', '2019-06-04 19:39:26'),
(131, 'g5f4q3h4k365p4x4y435f453', 3, 16, 'You have a new lesson request from Student T.. <a href=\"javascript:void(0)\" class=\"view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365t403\">click here</a> to view detail.', 'other', 0, 'seen', '2019-06-07 02:04:50'),
(132, 'g5f4q3h4k365p4x4y4p5f453', 16, 3, 'Tutor K.. has accepted your lesson request. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365t403\" data-link=\"get-request-detail\">click here</a> to book.', 'other', 0, 'seen', '2019-06-07 02:06:43'),
(133, 'g5f4q3h4k365p4x4y456f453', 16, 3, 'Tutor K..scheduled a lesson with you <a href=\"javascript:void(0)\" class=\"view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365x4u4\">click here</a> to view detail.', 'other', 0, 'seen', '2019-06-07 02:08:55'),
(134, 'g5f4q3h4k365p4x4z4n4f453', 3, 15, 'You have a new lesson request from Ahmad K.. <a href=\"javascript:void(0)\" class=\"view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365l483\">click here</a> to view detail.', 'other', 0, 'seen', '2019-06-09 01:46:06'),
(135, 'g5f4q3h4k365p4x4z435f453', 3, 15, 'You have a new lesson request from Ahmad K.. <a href=\"javascript:void(0)\" class=\"view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365l483\">click here</a> to view detail.', 'other', 0, 'seen', '2019-06-09 01:47:59'),
(136, 'g5f4q3h4k365p4x4z4p5f453', 3, 15, 'You have a new lesson request from Ahmad K.. <a href=\"javascript:void(0)\" class=\"view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365x4x4\">click here</a> to view detail.', 'other', 0, 'seen', '2019-06-09 01:48:21'),
(137, 'g5f4q3h4k365p4x4z456f453', 3, 15, 'You have a new lesson request from Ahmad K.. <a href=\"javascript:void(0)\" class=\"view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365x4v2\">click here</a> to view detail.', 'other', 0, 'seen', '2019-06-09 01:48:22'),
(138, 'g5f4q3h4k365p4x405n4f453', 3, 15, 'You have a new lesson request from Ahmad K.. <a href=\"javascript:void(0)\" class=\"view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365x4w2\">click here</a> to view detail.', 'other', 0, 'seen', '2019-06-09 01:48:22'),
(139, 'g5f4q3h4k365p4x40535f453', 3, 15, 'You have a new lesson request from Ahmad K.. <a href=\"javascript:void(0)\" class=\"view-detail\" data-link=\"get-request-detail\" data-store=\"g5d3m3m4k365x4x2\">click here</a> to view detail.', 'other', 0, 'seen', '2019-06-09 01:48:22'),
(140, 'g5f4q3h4k365p4v2y4n4f453', 15, 3, 'Tutor K.. has accepted your lesson request. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365x4v2\" data-link=\"get-request-detail\">click here</a> to book.', 'other', 0, 'new', '2019-06-09 01:48:36'),
(141, 'g5f4q3h4k365p4v2y435f453', 3, 15, 'Your lesson with Ahmad K.. has been confirmed! You can view your upcoming lesson in <a href=\"https://crainly.com/my-lessons\">My Lessons</a>.', 'other', 0, 'seen', '2019-06-09 01:49:00'),
(142, 'g5f4q3h4k365p4v2y4p5f453', 15, 3, 'Lesson has been booked!', 'other', 0, 'new', '2019-06-09 01:49:00'),
(143, 'g5f4q3h4k365p4v2y456f453', 3, 15, 'Ahmad K.. reviewed you 3 stars. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365x4v2\" data-link=\"lesson-detail\">click here</a> to view lesson.', 'other', 0, 'seen', '2019-06-09 01:49:51'),
(144, 'g5f4q3h4k365p4v2z4n4f453', 15, 3, 'You reviewed Tutor K.. 3 stars. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k365x4v2\" data-link=\"lesson-detail\">click here</a> to view lesson.', 'other', 0, 'new', '2019-06-09 01:49:51'),
(145, 'g5f4q3h4k365p4v2z435f453', 15, 3, 'Your lesson request with Tutor K.. has been rejected.', 'other', 0, 'new', '2019-06-11 17:46:38'),
(146, 'g5f4q3h4k365p4v2z4p5f453', 20, 21, 'Your lesson with Tutor 3.. is submitted. click here <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k36595y2\" data-link=\"lesson-detail\">click here</a>  to view lesson.', 'other', 0, 'new', '2019-10-09 05:40:03'),
(147, 'g5f4q3h4k365p4v2z456f453', 20, 21, 'Leave a review for your lesson with Tutor 3.. <a href=\"javascript:void(0)\" class=\"view-detail\" data-store=\"g5d3m3m4k36595y2\" data-link=\"lesson-detail\">click here</a>', 'other', 0, 'new', '2019-10-09 05:40:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_partners`
--

CREATE TABLE `tbl_partners` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_partners`
--

INSERT INTO `tbl_partners` (`id`, `title`, `link`, `image`) VALUES
(1, 'altima', 'altima.com', 'image_1549277171_1300.svg'),
(2, 'Seven News', 'seven-news.com', 'image_1549279810_1415.svg'),
(3, 'Aljazeera TV', 'aljazeera TV', 'image_1549279853_5025.svg'),
(4, 'AMT Debit', 'amt-debit.com', 'image_1549279879_8965.svg'),
(5, 'Discovery channel', 'discovery-channel.com', 'image_1549279904_9296.svg'),
(6, 'FDS', 'fds.com', 'image_1549279923_1371.svg'),
(7, 'International Cricket Council', 'international-cricket-council.com', 'image_1549279953_6933.svg'),
(8, 'Orbis', 'orbis.com', 'image_1549279979_9621.svg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_methods`
--

CREATE TABLE `tbl_payment_methods` (
  `id` int(11) NOT NULL,
  `encoded_id` varchar(255) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `last_digits` varchar(4) DEFAULT NULL,
  `expiry` varchar(100) DEFAULT NULL,
  `method_token` varchar(500) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `paypal` varchar(255) DEFAULT NULL,
  `acc_swift_code` varchar(255) NOT NULL,
  `acc_routing_number` varchar(255) NOT NULL,
  `acc_bank_name` varchar(255) NOT NULL,
  `acc_title` varchar(255) NOT NULL,
  `acc_number` varchar(100) NOT NULL,
  `acc_city` varchar(255) NOT NULL,
  `acc_state` varchar(255) NOT NULL,
  `acc_country` varchar(255) NOT NULL,
  `default_method` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payment_methods`
--

INSERT INTO `tbl_payment_methods` (`id`, `encoded_id`, `mem_id`, `last_digits`, `expiry`, `method_token`, `image`, `paypal`, `acc_swift_code`, `acc_routing_number`, `acc_bank_name`, `acc_title`, `acc_number`, `acc_city`, `acc_state`, `acc_country`, `default_method`) VALUES
(1, 'h5c3s2l4l335h483', 14, '4242', 'February, 2020', 'card_1EcANhKhbNNgyXc3aYUtF77w', 'visa.png', NULL, '', '', '', '', '', '', '', '', 1),
(2, 'h5c3s2l4l3p5h483', 13, NULL, NULL, NULL, NULL, NULL, '556565', '5656565', 'Habib the pen tha lama tid', '545656565', '6565656', '5656565', '65', 'Northern Mariana Islands', 0),
(3, 'h5c3s2l4l356h483', 15, '4242', 'March, 2020', 'card_1Ehcl0KhbNNgyXc3pNzQ0FpV', 'visa.png', NULL, '', '', '', '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permissions`
--

CREATE TABLE `tbl_permissions` (
  `id` int(11) NOT NULL,
  `permission` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_permissions`
--

INSERT INTO `tbl_permissions` (`id`, `permission`) VALUES
(1, 'Students'),
(2, 'Tutors'),
(3, 'Tutor Applications'),
(4, 'Subjects'),
(5, 'Chat Management'),
(6, 'Founders'),
(7, 'FAQ\'s'),
(8, 'Manage Pages'),
(9, 'Change Password'),
(10, 'Delete');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permissions_admin`
--

CREATE TABLE `tbl_permissions_admin` (
  `admin_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_permissions_admin`
--

INSERT INTO `tbl_permissions_admin` (`admin_id`, `permission_id`) VALUES
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_preferences`
--

CREATE TABLE `tbl_preferences` (
  `pref_id` int(11) NOT NULL,
  `pref_key` varchar(50) NOT NULL,
  `pref_title` varchar(500) NOT NULL,
  `pref_short_desc` varchar(1000) NOT NULL,
  `pref_detail` text NOT NULL,
  `pref_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_preferences`
--

INSERT INTO `tbl_preferences` (`pref_id`, `pref_key`, `pref_title`, `pref_short_desc`, `pref_detail`, `pref_image`) VALUES
(1, 'privacypolicy', 'Privacy Policy', '', '<p>We take our ethical responsibilities, the security of your personal information, and your privacy seriously. We have a strong commitment to providing excellent service to all our customers and visitors of this web site, including respecting your concerns about privacy. This Privacy Policy discloses how we collect, protect, use, And share information gathered about you on our website. If you use this site you explicitly agree to this Privacy Policy and the Terms Of Use in effect at the time of your accessing this website as set forth here. We hope that this disclosure will help increase your confidence in our web site. Therefore, in conformity with our goal of exceeding industry standards and the regulations enacted by federal and state authoritative bodies, we abide the following privacy policy.</p>\r\n\r\n<h3>Browsing</h3>\r\n\r\n<p>This website does collect personally identifiable information from your computer when you browse this website and request pages from our servers. This means that, unless you voluntarily and knowingly provide us with personally identifiable information, we will not know your name, your email address, or any other personally identifiable information. We may use IP addresses, browser types and access times to analyze trends, administer the site, improve site performance and gather broad demographic information for aggregate use. When you request a page from our website, our servers log the information provided in the HTTP request header including the IP number, the time of the request, the URL of your request, and other information that is provided in the HTTP header. We collect the HTTP request header information in order to make our website function correctly and provide you the functionality that you see on this website. We also use this information to better understand how visitors use our website and how we can better tune it, its contents and functionality to meet your needs.</p>\r\n\r\n<h3>Information collected and its uses</h3>\r\n\r\n<p>We collect your personal information if you decide to retain our services, participate in our affiliate marketing program, complete an application form, or transact other business with us. We need to collect personally identifiable information from you to execute the requested transaction, provide you with a particular service, and/or to further enhance and protect your account. At any time, we may ask you to voluntarily supply us with additional information needed. We will ask you for information such as, but not limited to: name, current and/or billing address, your e-mail address, telephone number and, other personal information, such as your date of birth, address, and loan account information. We may ask for your email address to send confirmations and, if necessary, we might use the other information to contact you for help in processing your requests.</p>\r\n\r\n<p>All information provided gives Crainly or an affiliate to contact you directly or indirectly. You give full permission to contact you through any and all devices and methods available to us whether it be manual or automated..</p>\r\n\r\n<p>We may also use the information we collect about you In order To, but Not limited To:</p>\r\n\r\n<ul>\r\n	<li>learn more about your interest In the products or services we offer and provide you with information;</li>\r\n	<li>enroll merchants who desire our services</li>\r\n	<li>open merchant files and establish their accounts</li>\r\n	<li>provide customer service</li>\r\n	<li>negotiate settlement of our merchants&rsquo; debts (according to the terms and conditions of their written agreements)</li>\r\n	<li>learn how to improve our products or services</li>\r\n	<li>evaluate your suitability for and provide opportunities for our affiliates and other companies to inform you about the products or services they offer that may interest you</li>\r\n</ul>\r\n\r\n<p>Aside from the ways mentioned above, we may use your personally identifiable information In many other ways, including sending you promotional materials, and sharing your information with third parties and Crainly affiliate so that these third parties and affiliate can send you promotional materials. (By &quot;promotional materials,&quot; we mean communications that directly promote the use Of web sites, or the purchase of products or services.). However, you may &quot;opt-out&quot; of certain uses of your personal information.</p>\r\n\r\n<h3>Disclosure of Information to third parties</h3>\r\n\r\n<p>We may disclose your personally identifiable information In order to effect or carry out any transaction that you have requested of us or As necessary to complete our contractual obligations with you. WE RESERVE THE RIGHT TO SELL, RENT OR TRANSFER YOUR PERSONAL INFORMATION TO THIRD PARTIES OR Crainly AFFILIATES FOR ANY PURPOSE IN OUR SOLE DISCRETION. Crainly may share your personally identifiable information with affiliated companies that are directly or indirectly controlled by, or under common control of Crainly. We may send personally identifiable information about you to non-affiliated companies that are not directly or indirectly controlled by, or under common control of Crainly. The personal information collected on this site and by third parties will be used to operate the site and to provide the services or products or carry out the transactions you have requested or authorized. We may change or broaden the use of your personal information at any time. We may use your personal information to provide promotional offers by means of email advertising, telephone marketing, direct mail marketing, banner advertising, and other possible uses.</p>\r\n\r\n<h3>Choice/opt-out</h3>\r\n\r\n<p>As indicated above, we provide you the opportunity to &#39;opt-out&rsquo; of having your personally identifiable information used for certain purposes, when we ask for or when you provide this information. For example, if you purchase a product/service but do not wish to receive any additional marketing material from us, you can indicate your preference on our order form. You may not, however, opt-out of any service that we deem to be required for us, our affiliates, transferees, or assignees to effectively and efficiently implement our services.</p>\r\n\r\n<p>If you no longer wish to receive promotional communications, you may opt-out of receiving them by following the instructions included in each newsletter or communication or by emailing or calling us per the information contained on our contact page.</p>\r\n\r\n<p>If you do not wish to have your applicable personal information collected, shared, or used by any third party that is not our affiliate/agent/service provider, please contact our customer service department to actively opt-out of having your personal information shared. Customer Service Contact Information:</p>\r\n\r\n<h3>Crainly</h3>\r\n\r\n<ul>\r\n	<li>Email: <a href=\"mailto:help@crainly.com\">help@crainly.com</a></li>\r\n	<li>Phone: <a href=\"tel:1-888-349-6226\">1-888-349-6226</a></li>\r\n</ul>\r\n', ''),
(2, 'termsservices', 'Term\'s of Services', '', '<p>We take our ethical responsibilities, the security of your personal information, and your privacy seriously. We have a strong commitment to providing excellent service to all our customers and visitors of this web site, including respecting your concerns about privacy. This term&#39;s of services discloses how we collect, protect, use, And share information gathered about you on our website. If you use this site you explicitly agree to this term&#39;s of services and the Terms Of Use in effect at the time of your accessing this website as set forth here. We hope that this disclosure will help increase your confidence in our web site. Therefore, in conformity with our goal of exceeding industry standards and the regulations enacted by federal and state authoritative bodies, we abide the following term&#39;s of services.</p>\r\n\r\n<h3>Browsing</h3>\r\n\r\n<p>This website does collect personally identifiable information from your computer when you browse this website and request pages from our servers. This means that, unless you voluntarily and knowingly provide us with personally identifiable information, we will not know your name, your email address, or any other personally identifiable information. We may use IP addresses, browser types and access times to analyze trends, administer the site, improve site performance and gather broad demographic information for aggregate use. When you request a page from our website, our servers log the information provided in the HTTP request header including the IP number, the time of the request, the URL of your request, and other information that is provided in the HTTP header. We collect the HTTP request header information in order to make our website function correctly and provide you the functionality that you see on this website. We also use this information to better understand how visitors use our website and how we can better tune it, its contents and functionality to meet your needs.</p>\r\n\r\n<h3>Information collected and its uses</h3>\r\n\r\n<p>We collect your personal information if you decide to retain our services, participate in our affiliate marketing program, complete an application form, or transact other business with us. We need to collect personally identifiable information from you to execute the requested transaction, provide you with a particular service, and/or to further enhance and protect your account. At any time, we may ask you to voluntarily supply us with additional information needed. We will ask you for information such as, but not limited to: name, current and/or billing address, your e-mail address, telephone number and, other personal information, such as your date of birth, address, and loan account information. We may ask for your email address to send confirmations and, if necessary, we might use the other information to contact you for help in processing your requests.</p>\r\n\r\n<p>All information provided gives Crainly or an affiliate to contact you directly or indirectly. You give full permission to contact you through any and all devices and methods available to us whether it be manual or automated..</p>\r\n\r\n<p>We may also use the information we collect about you In order To, but Not limited To:</p>\r\n\r\n<ul>\r\n	<li>learn more about your interest In the products or services we offer and provide you with information;</li>\r\n	<li>enroll merchants who desire our services</li>\r\n	<li>open merchant files and establish their accounts</li>\r\n	<li>provide customer service</li>\r\n	<li>negotiate settlement of our merchants&rsquo; debts (according to the terms and conditions of their written agreements)</li>\r\n	<li>learn how to improve our products or services</li>\r\n	<li>evaluate your suitability for and provide opportunities for our affiliates and other companies to inform you about the products or services they offer that may interest you</li>\r\n</ul>\r\n\r\n<p>Aside from the ways mentioned above, we may use your personally identifiable information In many other ways, including sending you promotional materials, and sharing your information with third parties and Crainly affiliate so that these third parties and affiliate can send you promotional materials. (By &quot;promotional materials,&quot; we mean communications that directly promote the use Of web sites, or the purchase of products or services.). However, you may &quot;opt-out&quot; of certain uses of your personal information.</p>\r\n\r\n<h3>Disclosure of Information to third parties</h3>\r\n\r\n<p>We may disclose your personally identifiable information In order to effect or carry out any transaction that you have requested of us or As necessary to complete our contractual obligations with you. WE RESERVE THE RIGHT TO SELL, RENT OR TRANSFER YOUR PERSONAL INFORMATION TO THIRD PARTIES OR Crainly AFFILIATES FOR ANY PURPOSE IN OUR SOLE DISCRETION. Crainly may share your personally identifiable information with affiliated companies that are directly or indirectly controlled by, or under common control of Crainly. We may send personally identifiable information about you to non-affiliated companies that are not directly or indirectly controlled by, or under common control of Crainly. The personal information collected on this site and by third parties will be used to operate the site and to provide the services or products or carry out the transactions you have requested or authorized. We may change or broaden the use of your personal information at any time. We may use your personal information to provide promotional offers by means of email advertising, telephone marketing, direct mail marketing, banner advertising, and other possible uses.</p>\r\n\r\n<h3>Choice/opt-out</h3>\r\n\r\n<p>As indicated above, we provide you the opportunity to &#39;opt-out&rsquo; of having your personally identifiable information used for certain purposes, when we ask for or when you provide this information. For example, if you purchase a product/service but do not wish to receive any additional marketing material from us, you can indicate your preference on our order form. You may not, however, opt-out of any service that we deem to be required for us, our affiliates, transferees, or assignees to effectively and efficiently implement our services.</p>\r\n\r\n<p>If you no longer wish to receive promotional communications, you may opt-out of receiving them by following the instructions included in each newsletter or communication or by emailing or calling us per the information contained on our contact page.</p>\r\n\r\n<p>If you do not wish to have your applicable personal information collected, shared, or used by any third party that is not our affiliate/agent/service provider, please contact our customer service department to actively opt-out of having your personal information shared. Customer Service Contact Information:</p>\r\n\r\n<h3>Crainly</h3>\r\n\r\n<ul>\r\n	<li>Email: <a href=\"mailto:help@crainly.com\">help@crainly.com</a></li>\r\n	<li>Phone: <a href=\"tel:1-888-349-6226\">1-888-349-6226</a></li>\r\n</ul>\r\n', ''),
(3, 'bannerimage', '', '', '', 'image_1547197860_6034.png'),
(4, 'contact', 'Contact us', 'Get in Touch', 'Address & Info', 'Location Info'),
(7, 'footer_section', 'Find the right fit or it’s free.', 'We guarantee you’ll find the right tutor, or we’ll cover the first hour of your lesson.', 'What would you like to see next?', 'Submit a Feature Request');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ref_signups`
--

CREATE TABLE `tbl_ref_signups` (
  `id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `ref_mem_id` int(11) NOT NULL,
  `reward` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ref_signups`
--

INSERT INTO `tbl_ref_signups` (`id`, `mem_id`, `ref_mem_id`, `reward`) VALUES
(1, 2, 11, 0),
(2, 2, 12, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reports`
--

CREATE TABLE `tbl_reports` (
  `id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `reason` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reviews`
--

CREATE TABLE `tbl_reviews` (
  `mem_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `ref_id` int(11) NOT NULL,
  `ref_type` enum('lesson') NOT NULL,
  `rating` float NOT NULL,
  `comment` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_reviews`
--

INSERT INTO `tbl_reviews` (`mem_id`, `from_id`, `ref_id`, `ref_type`, `rating`, `comment`, `date`) VALUES
(3, 2, 1, 'lesson', 4.6, 'I am very happy with his teaching method', '2019-04-02 07:52:31'),
(3, 4, 3, 'lesson', 4.6, 'Such nice Tutor', '2019-04-02 11:31:51'),
(3, 2, 5, 'lesson', 4.6, 'Good experience', '2019-04-03 09:38:58'),
(3, 2, 4, 'lesson', 4.9, 'He is genius He has good communication skills and his teaching method is brilliant ', '2019-04-10 09:11:32'),
(13, 14, 23, 'lesson', 4.5, 'mojain mr yr 5 star', '2019-05-20 12:56:01'),
(13, 14, 24, 'lesson', 4.1, 'test', '2019-05-20 13:04:36'),
(3, 15, 28, 'lesson', 3, 'test ratting', '2019-06-04 13:39:26'),
(3, 15, 34, 'lesson', 3, 'thanks', '2019-06-08 19:49:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_siteadmin`
--

CREATE TABLE `tbl_siteadmin` (
  `site_id` int(11) NOT NULL,
  `site_username` varchar(255) DEFAULT NULL,
  `site_password` varchar(255) DEFAULT NULL,
  `site_admin_name` varchar(255) DEFAULT NULL,
  `site_admin_type` enum('admin','subadmin') NOT NULL DEFAULT 'admin',
  `site_domain` varchar(100) DEFAULT NULL,
  `site_name` varchar(500) DEFAULT NULL,
  `site_email` varchar(255) DEFAULT NULL,
  `site_noreply_email` varchar(255) DEFAULT NULL,
  `site_phone` varchar(255) DEFAULT NULL,
  `site_fax` varchar(255) DEFAULT NULL,
  `site_paypal` varchar(255) NOT NULL,
  `site_ip` varchar(255) DEFAULT NULL,
  `site_logo` varchar(255) DEFAULT NULL,
  `site_address` varchar(255) DEFAULT NULL,
  `site_about` text,
  `site_city` varchar(100) DEFAULT NULL,
  `site_state` varchar(100) DEFAULT NULL,
  `site_zip` varchar(25) DEFAULT NULL,
  `site_country` varchar(100) DEFAULT NULL,
  `site_lastlogindate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `site_copyright` varchar(1000) DEFAULT NULL,
  `site_facebook` varchar(255) DEFAULT NULL,
  `site_twitter` varchar(255) DEFAULT NULL,
  `site_google` varchar(255) DEFAULT NULL,
  `site_instagram` varchar(255) DEFAULT NULL,
  `site_linkedin` varchar(255) DEFAULT NULL,
  `site_youtube` varchar(255) DEFAULT NULL,
  `site_contact_map` text,
  `site_google_ad` text,
  `site_meta_desc` text,
  `site_meta_keyword` varchar(1000) DEFAULT NULL,
  `site_meta_copyright` varchar(500) DEFAULT NULL,
  `site_meta_author` varchar(255) DEFAULT NULL,
  `site_how_to_pay` text,
  `site_status` int(11) NOT NULL DEFAULT '1',
  `sub_location` int(20) DEFAULT NULL,
  `site_chat` text,
  `sub_featured` int(30) DEFAULT NULL,
  `site_version` int(11) NOT NULL DEFAULT '0',
  `site_percentage` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tbl_siteadmin`
--

INSERT INTO `tbl_siteadmin` (`site_id`, `site_username`, `site_password`, `site_admin_name`, `site_admin_type`, `site_domain`, `site_name`, `site_email`, `site_noreply_email`, `site_phone`, `site_fax`, `site_paypal`, `site_ip`, `site_logo`, `site_address`, `site_about`, `site_city`, `site_state`, `site_zip`, `site_country`, `site_lastlogindate`, `site_copyright`, `site_facebook`, `site_twitter`, `site_google`, `site_instagram`, `site_linkedin`, `site_youtube`, `site_contact_map`, `site_google_ad`, `site_meta_desc`, `site_meta_keyword`, `site_meta_copyright`, `site_meta_author`, `site_how_to_pay`, `site_status`, `sub_location`, `site_chat`, `sub_featured`, `site_version`, `site_percentage`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administration', 'admin', 'www.crainly.com', 'Crainly', 'help@crainly.com', 'no-reply@crainly.com', '+254-775-050-697', '', 'herosolutions.tk@gmail.com', '103.255.4.74', 'favicon.ico', '70 east sunrise highway, \r\n<em>V35 - 80 Dto 1070-020 Lisboa,</em>\r\nNew York 11581.', '', 'New York', 'WA', '75350', 'USA', '2019-06-10 07:17:40', 'Copyright © 2018. All Rights Reserved', 'https://www.facebook.com/crainly', 'https://twitter.com/crainly', 'https://plus.google.com/mrservicecard', 'https://instagram.com/crainly', 'https://www.linkedin.com/mixme', 'https://www.youtube.com/crainly', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3318.7250567536676!2d-84.34897039425!3d33.71606266992961!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88f501790d22f717%3A0x7ff91decdaf344dc!2s1264+Custer+Ave+SE%2C+Atlanta%2C+GA+30316!5e0!3m2!1sen!2s!4v1493122321821', '', 'New Admin', 'HTML, CSS, XML, JavaScript', 'New Admin &copy; 2018 All Rights Reserved.', 'Administration', '', 1, 20, 'window.fcWidget.init({\r\ntoken: \"89884c16-15cc-484d-926f-ec74202a584d\",\r\nhost: \"https://wchat.freshchat.com\"\r\n});', 30, 28, 10),
(2, 'ajay', '098f6bcd4621d373cade4e832627b4f6', 'Malik Ajay Jones', 'subadmin', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-03-06 09:00:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sitecontent`
--

CREATE TABLE `tbl_sitecontent` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sitecontent`
--

INSERT INTO `tbl_sitecontent` (`id`, `type`, `code`) VALUES
(1, 'home', 'a:47:{s:14:\"banner_heading\";s:28:\"Better Tutors, Better Grades\";s:13:\"banner_detail\";s:143:\"Private, 1–on–1 lessons with the expert instructor of your choice. You decide when to meet, how much to pay, and who you want to work with.\";s:18:\"banner_button_text\";s:12:\"Search Tutor\";s:21:\"first_section_heading\";s:12:\"How it works\";s:20:\"first_section_detail\";s:38:\"Getting help is easier than you think.\";s:18:\"first_ico_heading1\";s:6:\"Search\";s:15:\"first_ico_text1\";s:103:\"Search for a subject you like help in and Crainly will provide you with compatible tutors in your area.\";s:18:\"first_ico_heading2\";s:7:\"Connect\";s:15:\"first_ico_text2\";s:137:\"After choosing the tutor thats right for you, set up your desired location, date, and time that you would like the session to take place.\";s:18:\"first_ico_heading3\";s:6:\"Review\";s:15:\"first_ico_text3\";s:132:\"After your session is complete, you will be able to rate and review your tutor which helps to maintain the quality of our community.\";s:22:\"second_section_heading\";s:17:\"Why use Crainly ?\";s:26:\"second_section_button_text\";s:15:\"Get Started Now\";s:19:\"second_ico_heading1\";s:18:\"On-demand tutoring\";s:16:\"second_ico_text1\";s:147:\"Connect with an online tutor in less than 30 seconds, 24/7. It doesn’t matter if you want help with a single problem or you need a 3-hour session\";s:19:\"second_ico_heading2\";s:26:\"Learn from the best tutors\";s:16:\"second_ico_text2\";s:153:\"Highly qualified tutors from the best universities across the globe ready to help. An acceptance rate of 4% means all our tutors are thoroughly screened.\";s:19:\"second_ico_heading3\";s:22:\"All the tools you need\";s:16:\"second_ico_text3\";s:158:\"Our lesson space features a virtual whiteboard, text editor, audio/video chat, screen sharing and so much more. All lessons are archived for your convenience.\";s:21:\"third_section_heading\";s:37:\"Online lessons. Real–world results.\";s:20:\"third_section_detail\";s:48:\"Get real results without ever leaving the house.\";s:25:\"third_section_button_text\";s:17:\"See how it workds\";s:18:\"third_ico_heading1\";s:13:\"Choose Expert\";s:15:\"third_ico_text1\";s:60:\"Meet with the expert of your choice, anywhere in the country\";s:18:\"third_ico_heading2\";s:9:\"Save Time\";s:15:\"third_ico_text2\";s:51:\"Save time and easily fit lessons into your schedule\";s:18:\"third_ico_heading3\";s:16:\"Skill or Subject\";s:15:\"third_ico_text3\";s:56:\"Collaborate with features built for any skill or subject\";s:22:\"fourth_section_heading\";s:16:\"Trusted Partners\";s:21:\"fourth_section_detail\";s:20:\"Real accurate quotes\";s:21:\"fifth_section_heading\";s:61:\"Last year, our students improved by an average of +1.7 grades\";s:20:\"fifth_section_detail\";s:150:\"Crainly students consistently improve their confidence and grades. Last year, our students made more than three times as much progress as their peers.\";s:21:\"sixth_section_heading\";s:19:\"World\'s Best Tutors\";s:20:\"last_section_heading\";s:27:\"Start tutoring with Crainly\";s:19:\"last_section_detail\";s:94:\"We’re always looking for talented tutors. Set your own rate, get paid and make a difference.\";s:24:\"last_section_button_text\";s:11:\"Apply Today\";s:12:\"banner_video\";s:52:\"98b297950041a42470269d56260243a1_1549284809_8478.mp4\";s:19:\"third_section_image\";s:52:\"b1d10e7bafa4421218a51b1e1f1b0ba2_1549284809_7049.svg\";s:19:\"second_ico_heading4\";s:23:\"Get help in any subject\";s:16:\"second_ico_text4\";s:143:\"We cover over 300 subjects across all grade levels. Whether it’s high school algebra or college-level Spanish, we have a tutor that can help.\";s:17:\"second_ico_image4\";s:52:\"9f396fe44e7c05c16873b05ec425cbad_1549284898_2335.svg\";s:17:\"second_ico_image1\";s:52:\"0f28b5d49b3020afeecd95b4009adf4c_1549286004_2355.svg\";s:17:\"second_ico_image2\";s:52:\"11b9842e0a271ff252c1903e7132cd68_1549286004_4685.svg\";s:17:\"second_ico_image3\";s:52:\"e46de7e1bcaaced9a54f1e9d0d2f800d_1549286004_7966.svg\";s:16:\"first_ico_image1\";s:52:\"46ba9f2a6976570b0353203ec4474217_1549286079_7602.svg\";s:16:\"first_ico_image2\";s:52:\"217eedd1ba8c592db97d0dbe54c7adfc_1549286079_4938.svg\";s:16:\"first_ico_image3\";s:52:\"0e01938fc48a2cfb5f2217fbfb00722d_1549286079_7236.svg\";}'),
(2, 'about', 'a:3:{s:13:\"about_heading\";s:8:\"About us\";s:15:\"founder_heading\";s:15:\"Our Co-Founders\";s:9:\"about_txt\";s:3388:\"<p>Please read these Terms of Service (&ldquo;Terms&rdquo;, &ldquo;Terms of Service&rdquo;) carefully before using the www.manganexus.com website (the &ldquo;Service&rdquo;) operated by Manga Nexus (&ldquo;us&rdquo;, &ldquo;we&rdquo;, or &ldquo;our&rdquo;).</p>\r\n\r\n<p>Your access to and use of the Service is conditioned on your acceptance of and compliance with these Terms. These Terms apply to all visitors, users and others who access or use the Service.</p>\r\n\r\n<p>By accessing or using the Service you agree to be bound by these Terms. If you disagree with any part of the terms then you may not access the Service.</p>\r\n\r\n<p><strong>Accounts</strong></p>\r\n\r\n<p>When you create an account with us, you must provide us information that is accurate, complete, and current at all times. Failure to do so constitutes a breach of the Terms, which may result in immediate termination of your account on our Service.</p>\r\n\r\n<p>You are responsible for safeguarding the password that you use to access the Service and for any activities or actions under your password, whether your password is with our Service or a third-party service.</p>\r\n\r\n<p>You agree not to disclose your password to any third party. You must notify us immediately upon becoming aware of any breach of security or unauthorized use of your account.</p>\r\n\r\n<p><strong>Links To Other Web Sites</strong></p>\r\n\r\n<p>Our Service may contain links to third-party web sites or services that are not owned or controlled by Manga Nexus.</p>\r\n\r\n<p>Manga Nexus has no control over, and assumes no responsibility for, the content, privacy policies, or practices of any third party web sites or services. You further acknowledge and agree that Manga Nexus shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with use of or reliance on any such content, goods or services available on or through any such web sites or services.</p>\r\n\r\n<p>We strongly advise you to read the terms and conditions and privacy policies of any third-party web sites or services that you visit.</p>\r\n\r\n<p><strong>Governing Law</strong></p>\r\n\r\n<p>These Terms shall be governed and construed in accordance with the laws of Ontario, Canada, without regard to its conflict of law provisions.</p>\r\n\r\n<p>Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights. If any provision of these Terms is held to be invalid or unenforceable by a court, the remaining provisions of these Terms will remain in effect. These Terms constitute the entire agreement between us regarding our Service, and supersede and replace any prior agreements we might have between us regarding the Service.</p>\r\n\r\n<p><strong>Changes</strong></p>\r\n\r\n<p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material we will try to provide at least 30 days notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>\r\n\r\n<p>By continuing to access or use our Service after those revisions become effective, you agree to be bound by the revised terms. If you do not agree to the new terms, please stop using the Service.</p>\r\n\r\n<p><strong>Contact Us</strong></p>\r\n\r\n<p>If you have any questions about these Terms, please contact us.</p>\r\n\";}'),
(3, 'login', 'a:3:{s:13:\"login_heading\";s:18:\"Login with Crainly\";s:12:\"left_section\";s:322:\"<h1>Join over 10 million people celebrating on Crainly</h1>\r\n\r\n<p>Crainly launches Enterprise Bot Factory for the Workplace by Facebook</p>\r\n\r\n<h3>-The Webbys</h3>\r\n\r\n<p>Why use Bitcoin for larger money transfers</p>\r\n\r\n<h3>-PSFK</h3>\r\n\r\n<p>Axa Insurance launches SalesForce CRM for 3000 agents</p>\r\n\r\n<h3>-Big Data</h3>\r\n\";s:11:\"login_image\";s:25:\"image_1547712574_5945.jpg\";}'),
(4, 'signup', 'a:2:{s:14:\"signup_heading\";s:20:\"Sign up with Crainly\";s:14:\"register_image\";s:25:\"image_1547197462_4211.jpg\";}'),
(5, 'forgot', 'a:4:{s:14:\"forgot_heading\";s:15:\"Forgot Password\";s:19:\"forgot_short_detail\";s:104:\"Enter the email address associated with your account, and we\'ll email you a link to reset your password.\";s:12:\"forgot_image\";s:25:\"image_1547197736_6001.jpg\";s:12:\"left_section\";s:318:\"<h1>Join over 10 million people celebrating on Crainly</h1>\r\n\r\n<p>Crainly launches Enterprise Bot Factory for Workplace by Facebook</p>\r\n\r\n<h3>-The Webbys</h3>\r\n\r\n<p>Why use Bitcoin for larger money transfers</p>\r\n\r\n<h3>-PSFK</h3>\r\n\r\n<p>Axa Insurance launches SalesForce CRM for 3000 agents</p>\r\n\r\n<h3>-Big Data</h3>\r\n\";}'),
(6, 'reset', 'a:4:{s:13:\"reset_heading\";s:14:\"Reset Password\";s:18:\"reset_short_detail\";s:38:\"Enter a new password for your account.\";s:11:\"reset_image\";s:25:\"image_1547197780_2514.jpg\";s:12:\"left_section\";s:318:\"<h1>Join over 10 million people celebrating on Crainly</h1>\r\n\r\n<p>Crainly launches Enterprise Bot Factory for Workplace by Facebook</p>\r\n\r\n<h3>-The Webbys</h3>\r\n\r\n<p>Why use Bitcoin for larger money transfers</p>\r\n\r\n<h3>-PSFK</h3>\r\n\r\n<p>Axa Insurance launches SalesForce CRM for 3000 agents</p>\r\n\r\n<h3>-Big Data</h3>\r\n\";}'),
(8, 'email_verify', 'a:2:{s:15:\"everify_heading\";s:18:\"Email Verification\";s:14:\"everify_detail\";s:272:\"<p>Please verify your email address, We&rsquo;ve sent a verify email to your email address. If you don&rsquo;t see the email, check your spam folder. If you didn&#39;t get email click on resend email link, or if you want to change email address click the link below.</p>\r\n\";}'),
(9, 'search', 'a:3:{s:10:\"page_title\";s:13:\"Search Result\";s:7:\"heading\";s:30:\"Find your private tutor online\";s:11:\"description\";s:57:\"Then book one-to-one Online Lessons to fit your schedule.\";}'),
(10, 'contact', 'a:4:{s:13:\"first_heading\";s:12:\"Get in Touch\";s:6:\"detail\";s:241:\"<p>Please fill out this form and let us know how we can be of service. We will happily offer you a FREE initial consultation to determine how we can best serve you.</p>\r\n\r\n<p>Thank you for visiting. We look forward to working together!</p>\r\n\";s:14:\"second_heading\";s:21:\"Questions or Comments\";s:13:\"third_heading\";s:12:\"Get in Touch\";}'),
(11, 'phone_verify', 'a:2:{s:15:\"pverify_heading\";s:18:\"Phone Verification\";s:14:\"pverify_detail\";s:293:\"<p>Crainly is going to send you a text message for Phone verification if you want to verify your phone number, Please make sure your phone number is correct before verification. Click the link below to verify your phone number or if you want to change Phone Number click the link below .</p>\r\n\";}'),
(12, 'tutor_signup', 'a:3:{s:12:\"page_heading\";s:13:\"Tutor Sign up\";s:12:\"left_section\";s:318:\"<h1>Join over 10 million people celebrating on Crainly</h1>\r\n\r\n<p>Crainly launches Enterprise Bot Factory for Workplace by Facebook</p>\r\n\r\n<h3>-The Webbys</h3>\r\n\r\n<p>Why use Bitcoin for larger money transfers</p>\r\n\r\n<h3>-PSFK</h3>\r\n\r\n<p>Axa Insurance launches SalesForce CRM for 3000 agents</p>\r\n\r\n<h3>-Big Data</h3>\r\n\";s:10:\"page_image\";s:52:\"1d7f7abc18fcb43975065399b0d1e48e_1552473045_7403.jpg\";}'),
(13, 'socket_url', 'http://localhost:3400/');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_site_texts`
--

CREATE TABLE `tbl_site_texts` (
  `txt_id` int(11) NOT NULL,
  `txt_type` varchar(50) DEFAULT NULL,
  `txt_label` varchar(100) DEFAULT NULL,
  `txt_key` text,
  `txt_value` text,
  `txt_subject` text,
  `txt_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_site_texts`
--

INSERT INTO `tbl_site_texts` (`txt_id`, `txt_type`, `txt_label`, `txt_key`, `txt_value`, `txt_subject`, `txt_status`) VALUES
(1, 'email', 'Signup Email', 'signup', '<h3>Dear $name</h3>\r\n\r\n<p>Thank you for your registration.</p>\r\n\r\n<p>Please click on the link below to verify your email addresss.</p>\r\n', 'Thank you for registering', 1),
(2, 'email', 'Forgot Password Email', 'forgot_password', '<h3>Dear $name</h3>\r\n\r\n<p>Please click on the link below to reset your password.</p>\r\n', 'Reset your Password', 1),
(3, 'email', 'Change Email', 'change_email', '<h3>Dear $name</h3>\r\n\r\n<p>You have changed your email.</p>\r\n\r\n<p>Please click on the link below to verify your email address.</p>\r\n', 'Verify Your Email', 1),
(4, 'email', 'Verify Email', 'verify_email', '<h3>Dear $name</h3>\r\n\r\n<p>Please click on the link below to verify your email address.</p>\r\n', 'Verify Your Email', 1),
(5, 'alert', 'Profile Complete Alert', 'profile_completion', 'Thanks for registering with Crainly. Please fill in the profile information.', NULL, 1),
(6, 'alert', 'Registration Alert', 'registration', 'You are register successfully. And We’ve sent a verify email to your email address. If you don’t see the email, check your spam folder', NULL, 1),
(7, 'alert', 'Sent Verification Email Alert', 'verify_email', 'We’ve sent a verify email to your email address. If you don’t see the email, check your spam folder. Please confirm your email address to continue.', NULL, 1),
(8, 'alert', 'Email Verfication Alert', 'email_verification', 'Thanks for registering with Crainly. Please verify your email.', NULL, 1),
(9, 'email', 'Approved Tutor Email', 'approved_tutor', '<h3>Dear $name</h3>\r\n\r\n<p>Your tutor application has been Approved.</p>\r\n', 'Approved Tutor Email', 1),
(10, 'email', 'Declinced Tutor Email', 'declined_tutor', '<h3>Dear $name</h3>\r\n\r\n<p>Your tutor application has been Declinced.</p>\r\n', 'Declinced Tutor Email', 1),
(11, 'email', 'Referral Signup Email', 'invite_friend', '<h3>Referral Signup Invitation</h3>\r\n\r\n<p>$name send you a referral signup link</p>\r\n\r\n<p>Please click on the link below to referral signup.</p>\r\n', 'Referral Signup Invitation', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subjects`
--

CREATE TABLE `tbl_subjects` (
  `id` int(11) NOT NULL,
  `encoded_id` varchar(100) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `slug` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_subjects`
--

INSERT INTO `tbl_subjects` (`id`, `encoded_id`, `parent_id`, `slug`, `name`, `status`) VALUES
(1, 'h5s2u3a4k365p483', 0, 'algebra', 'Algebra', 1),
(2, 'h5s2u3a4k365t483', 0, 'calculus', 'Calculus', 1),
(3, 'h5s2u3a4k365x483', 1, 'algebra-1', 'Algebra 1', 1),
(4, 'h5s2u3a4k3651583', 1, 'algebra-2', 'Algebra 2', 1),
(5, 'h5s2u3a4k3655583', 0, 'chemistry', 'Chemistry', 1),
(6, 'h5s2u3a4k3659583', 0, 'computer', 'Computer', 1),
(7, 'h5s2u3a4k365j583', 0, 'english', 'English', 1),
(8, 'h5s2u3a4k365n583', 0, 'physics', 'Physics', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscribers`
--

CREATE TABLE `tbl_subscribers` (
  `mem_id` int(11) NOT NULL,
  `ref_id` int(11) NOT NULL,
  `ref_type` enum('comic','novel') NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subscribers`
--

INSERT INTO `tbl_subscribers` (`mem_id`, `ref_id`, `ref_type`, `date`) VALUES
(2, 2, 'novel', '2018-10-16 09:21:56'),
(2, 2, 'comic', '2018-10-16 09:23:41'),
(2, 1, 'comic', '2018-10-17 07:06:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactions`
--

CREATE TABLE `tbl_transactions` (
  `id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `trx_detail` longtext,
  `status` tinyint(11) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transactions`
--

INSERT INTO `tbl_transactions` (`id`, `mem_id`, `lesson_id`, `amount`, `note`, `trx_detail`, `status`, `date`) VALUES
(1, 3, 1, 337.5, NULL, NULL, 1, '2019-04-02 07:52:31'),
(2, 3, 3, 135, NULL, NULL, 1, '2019-04-02 11:31:51'),
(3, 3, 5, 135, NULL, NULL, 1, '2019-04-03 09:38:58'),
(4, 3, 4, 202.5, NULL, NULL, 1, '2019-04-10 09:03:04'),
(5, 3, 4, 202.5, NULL, NULL, 1, '2019-04-10 09:11:32'),
(6, 13, 23, 18, NULL, NULL, 1, '2019-05-20 12:56:01'),
(7, 13, 24, 18, NULL, NULL, 1, '2019-05-20 13:04:36'),
(8, 3, 28, 121.5, NULL, NULL, 1, '2019-06-04 13:39:26'),
(9, 3, 34, 182.25, NULL, NULL, 1, '2019-06-08 19:49:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tutor_subjects`
--

CREATE TABLE `tbl_tutor_subjects` (
  `mem_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `type` enum('main','sub') NOT NULL DEFAULT 'sub'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tutor_subjects`
--

INSERT INTO `tbl_tutor_subjects` (`mem_id`, `subject_id`, `type`) VALUES
(1, 3, 'sub'),
(1, 1, 'main'),
(8, 3, 'sub'),
(8, 4, 'sub'),
(8, 1, 'main'),
(13, 3, 'sub'),
(13, 4, 'sub'),
(13, 1, 'main'),
(3, 4, 'sub'),
(3, 1, 'main');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tutor_timings`
--

CREATE TABLE `tbl_tutor_timings` (
  `mem_id` int(11) NOT NULL,
  `day` varchar(100) NOT NULL,
  `start_time` varchar(10) DEFAULT NULL,
  `end_time` varchar(10) DEFAULT NULL,
  `available` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tutor_timings`
--

INSERT INTO `tbl_tutor_timings` (`mem_id`, `day`, `start_time`, `end_time`, `available`) VALUES
(1, 'Sunday', '', '', 0),
(1, 'Monday', '', '', 0),
(1, 'Tuesday', '', '', 0),
(1, 'Wednesday', '', '', 0),
(1, 'Thursday', '', '', 0),
(1, 'Friday', '20:30', '20:30', 1),
(1, 'Saturday', '', '', 0),
(8, 'Sunday', '', '', 0),
(8, 'Monday', '12:00', '12:00', 1),
(8, 'Tuesday', '', '', 0),
(8, 'Wednesday', '', '', 0),
(8, 'Thursday', '', '', 0),
(8, 'Friday', '', '', 0),
(8, 'Saturday', '', '', 0),
(13, 'Sunday', '', '', 0),
(13, 'Monday', '12:24', '17:24', 1),
(13, 'Tuesday', '12:24', '17:24', 1),
(13, 'Wednesday', '15:24', '17:24', 1),
(13, 'Thursday', '16:24', '17:24', 1),
(13, 'Friday', '12:24', '17:24', 1),
(13, 'Saturday', '19:24', '17:24', 1),
(3, 'Sunday', '07:00', '17:00', 1),
(3, 'Monday', '15:11', '03:11', 1),
(3, 'Tuesday', '15:11', '03:11', 1),
(3, 'Wednesday', '15:11', '03:11', 1),
(3, 'Thursday', '15:11', '03:11', 1),
(3, 'Friday', '15:11', '', 1),
(3, 'Saturday', '03:11', '03:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_withdraws`
--

CREATE TABLE `tbl_withdraws` (
  `id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `payment_method_id` int(11) DEFAULT NULL,
  `status` tinyint(11) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paid_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_withdraws`
--

INSERT INTO `tbl_withdraws` (`id`, `mem_id`, `amount`, `note`, `payment_method_id`, `status`, `date`, `paid_date`) VALUES
(1, 3, 607.5, NULL, 2, 1, '2019-04-05 13:14:15', '2019-04-09 10:32:15'),
(2, 3, 405, NULL, NULL, 0, '2019-05-18 23:56:53', NULL),
(3, 13, 18, NULL, 2, 1, '2019-05-20 12:56:31', '2019-05-20 01:06:09'),
(4, 13, 18, NULL, 2, 1, '2019-05-20 13:06:14', '2019-05-20 01:06:26'),
(5, 3, 303.75, NULL, NULL, 0, '2019-06-09 22:46:17', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_chat`
--
ALTER TABLE `tbl_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_chat_attachments`
--
ALTER TABLE `tbl_chat_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `msg_id` (`msg_id`);

--
-- Indexes for table `tbl_chat_msgs`
--
ALTER TABLE `tbl_chat_msgs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_id` (`chat_id`);

--
-- Indexes for table `tbl_chat_video_class`
--
ALTER TABLE `tbl_chat_video_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_countries`
--
ALTER TABLE `tbl_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_faqs`
--
ALTER TABLE `tbl_faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_founders`
--
ALTER TABLE `tbl_founders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_lessons`
--
ALTER TABLE `tbl_lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_members`
--
ALTER TABLE `tbl_members`
  ADD PRIMARY KEY (`mem_id`);

--
-- Indexes for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mem_id` (`mem_id`);

--
-- Indexes for table `tbl_partners`
--
ALTER TABLE `tbl_partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payment_methods`
--
ALTER TABLE `tbl_payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_permissions`
--
ALTER TABLE `tbl_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_preferences`
--
ALTER TABLE `tbl_preferences`
  ADD PRIMARY KEY (`pref_id`);

--
-- Indexes for table `tbl_ref_signups`
--
ALTER TABLE `tbl_ref_signups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mem_id` (`mem_id`),
  ADD KEY `profile_id` (`profile_id`);

--
-- Indexes for table `tbl_siteadmin`
--
ALTER TABLE `tbl_siteadmin`
  ADD PRIMARY KEY (`site_id`);

--
-- Indexes for table `tbl_sitecontent`
--
ALTER TABLE `tbl_sitecontent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_site_texts`
--
ALTER TABLE `tbl_site_texts`
  ADD PRIMARY KEY (`txt_id`);

--
-- Indexes for table `tbl_subjects`
--
ALTER TABLE `tbl_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_withdraws`
--
ALTER TABLE `tbl_withdraws`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_chat`
--
ALTER TABLE `tbl_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=401;
--
-- AUTO_INCREMENT for table `tbl_chat_attachments`
--
ALTER TABLE `tbl_chat_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_chat_msgs`
--
ALTER TABLE `tbl_chat_msgs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=499;
--
-- AUTO_INCREMENT for table `tbl_chat_video_class`
--
ALTER TABLE `tbl_chat_video_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_countries`
--
ALTER TABLE `tbl_countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;
--
-- AUTO_INCREMENT for table `tbl_faqs`
--
ALTER TABLE `tbl_faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_founders`
--
ALTER TABLE `tbl_founders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_lessons`
--
ALTER TABLE `tbl_lessons`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `tbl_members`
--
ALTER TABLE `tbl_members`
  MODIFY `mem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;
--
-- AUTO_INCREMENT for table `tbl_partners`
--
ALTER TABLE `tbl_partners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_payment_methods`
--
ALTER TABLE `tbl_payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_permissions`
--
ALTER TABLE `tbl_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_preferences`
--
ALTER TABLE `tbl_preferences`
  MODIFY `pref_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_ref_signups`
--
ALTER TABLE `tbl_ref_signups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_siteadmin`
--
ALTER TABLE `tbl_siteadmin`
  MODIFY `site_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_sitecontent`
--
ALTER TABLE `tbl_sitecontent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_site_texts`
--
ALTER TABLE `tbl_site_texts`
  MODIFY `txt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_subjects`
--
ALTER TABLE `tbl_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_withdraws`
--
ALTER TABLE `tbl_withdraws`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
