-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-06-19 15:06:57
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `message_board`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name` varchar(15) NOT NULL COMMENT '管理员名称',
  `psw` varchar(32) NOT NULL COMMENT '管理员密码',
  `insert_time` datetime NOT NULL COMMENT '添加时间',
  `last_login_time` datetime NOT NULL COMMENT '最后登陆时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `name`, `psw`, `insert_time`, `last_login_time`) VALUES
(9, 'admin', '8e4ca7af923595919610e17f0dde5140', '2016-06-12 15:40:32', '2016-06-19 14:15:39'),
(5, 'chyt', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '2016-06-11 13:09:26', '2016-06-14 17:31:51');

-- --------------------------------------------------------

--
-- 表的结构 `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name` varchar(15) NOT NULL COMMENT '用户名',
  `psw` varchar(32) NOT NULL COMMENT '密码',
  `register_time` datetime NOT NULL COMMENT '注册时间',
  `last_login_time` datetime NOT NULL COMMENT '最后登陆时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `member`
--

INSERT INTO `member` (`id`, `name`, `psw`, `register_time`, `last_login_time`) VALUES
(2, 'print', '9cbf8a4dcb8e30682b927f352d6559a0', '2016-06-05 16:21:40', '2016-06-14 08:54:22'),
(3, 'admin', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '2016-06-05 16:30:46', '2016-06-19 14:21:48'),
(11, '小益', '8e4ca7af923595919610e17f0dde5140', '2016-06-13 18:44:33', '2016-06-15 09:12:20'),
(7, '王五', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '2016-06-05 17:29:21', '2016-06-05 17:29:21'),
(8, '库里', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '2016-06-06 14:36:54', '2016-06-06 14:36:54'),
(9, 'James', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '2016-06-06 16:39:26', '2016-06-06 16:39:26'),
(10, '李六', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '2016-06-10 14:16:01', '2016-06-10 14:16:01');

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `mid` int(11) NOT NULL COMMENT '留言用户的id',
  `title` varchar(15) NOT NULL COMMENT '留言标题',
  `content` varchar(255) NOT NULL COMMENT '留言内容',
  `content_time` datetime NOT NULL COMMENT '留言时间',
  `state` int(11) NOT NULL DEFAULT '0' COMMENT '留言信息的状态',
  `top_state` int(11) NOT NULL DEFAULT '0' COMMENT '置顶状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- 转存表中的数据 `message`
--

INSERT INTO `message` (`id`, `mid`, `title`, `content`, `content_time`, `state`, `top_state`) VALUES
(1, 3, '库里', '勇士水花兄弟', '2016-06-05 17:57:55', 0, 0),
(2, 3, 'James', '骑士詹姆斯。。', '2016-06-05 18:12:29', 0, 0),
(23, 3, '决赛', '3:1了', '2016-06-13 13:12:28', 0, 0),
(8, 2, '简单爱', '周杰伦--------简单爱', '2016-06-05 22:09:23', 0, 0),
(18, 9, 'GS', 'GS is a strong team.', '2016-06-12 23:01:23', 0, 0),
(21, 3, '雪', '是对方的身份的说法', '2016-06-13 12:56:09', 0, 0),
(22, 3, '禁赛', 'Green·Dream被联盟禁赛一场。', '2016-06-13 13:11:08', 0, 0),
(12, 8, '吊打骑士', '今天又在主场吊打了一顿骑士***\r\n。。', '2016-06-06 14:38:45', 0, 0),
(13, 9, '输球', '今天又输了，大败勇士', '2016-06-06 16:40:03', 0, 0),
(17, 3, '端午', '粽子节。', '2016-06-10 13:16:18', 0, 0),
(24, 9, '金州勇士', '今天在甲骨文球馆又扳回了一局!', '2016-06-14 15:27:01', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `reply`
--

CREATE TABLE IF NOT EXISTS `reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `content_id` int(11) NOT NULL COMMENT '要回复留言的id',
  `content_reply` varchar(255) NOT NULL COMMENT '回复的内容',
  `reply_time` datetime NOT NULL COMMENT '回复的时间',
  `member_id` int(11) NOT NULL COMMENT '回复者的id',
  `quote_id` int(11) NOT NULL DEFAULT '0' COMMENT '要引入回复的留言的id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- 转存表中的数据 `reply`
--

INSERT INTO `reply` (`id`, `content_id`, `content_reply`, `reply_time`, `member_id`, `quote_id`) VALUES
(1, 12, '詹姆斯在吐血了！！！', '2016-06-06 16:28:42', 3, 0),
(2, 8, '一首简单的小情歌', '2016-06-06 16:35:59', 4, 0),
(5, 12, '是真的吐血了。', '2016-06-10 09:55:07', 7, 1),
(6, 16, '国家主席', '2016-06-10 09:56:47', 7, 3),
(7, 14, '反派反派反派反派反派', '2016-06-10 10:00:22', 7, 0),
(9, 16, '好！！！', '2016-06-10 12:38:14', 9, 6),
(10, 12, '没错！这是真的。', '2016-06-10 12:50:09', 8, 5),
(11, 17, '端午赛龙舟', '2016-06-10 13:16:41', 3, 0),
(12, 17, '龙舟大赛', '2016-06-10 13:18:30', 3, 0),
(13, 17, '比赛很激烈', '2016-06-10 13:18:47', 3, 12),
(14, 15, '耶路撒冷', '2016-06-10 13:20:00', 3, 0),
(16, 6, '比赛很激烈，很好看！！！', '2016-06-10 13:21:34', 3, 0),
(17, 17, '是的！', '2016-06-10 14:16:33', 10, 13),
(18, 12, '对对对对对！', '2016-06-10 14:19:30', 10, 10),
(26, 18, 'Yes!', '2016-06-12 23:01:46', 9, 0),
(27, 18, 'No!', '2016-06-12 23:02:01', 9, 26),
(28, 2, '的的点点滴滴', '2016-06-13 12:54:46', 3, 0),
(24, 13, '哈哈哈哈', '2016-06-10 14:57:53', 2, 0),
(25, 4, '老王老王老王', '2016-06-10 14:59:03', 2, 0),
(29, 2, '噢噢噢噢', '2016-06-14 15:25:55', 3, 28),
(30, 23, '悬了，要输了。', '2016-06-14 15:28:57', 9, 0),
(31, 25, 'eeeeee', '2016-06-19 09:59:35', 3, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
