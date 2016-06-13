-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-06-07 14:22:02
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `name`, `psw`) VALUES
(1, 'chyt', '111111');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `member`
--

INSERT INTO `member` (`id`, `name`, `psw`, `register_time`, `last_login_time`) VALUES
(4, 'printingchen', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '2016-06-05 16:32:52', '2016-06-05 16:32:52'),
(2, 'print', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '2016-06-05 16:21:40', '2016-06-05 16:21:40'),
(3, 'admin', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '2016-06-05 16:30:46', '2016-06-05 16:30:46'),
(5, '张三', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '2016-06-05 17:04:24', '2016-06-05 17:04:24'),
(6, '李四', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '2016-06-05 17:12:05', '2016-06-05 17:12:05'),
(7, '王五', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '2016-06-05 17:29:21', '2016-06-05 17:29:21'),
(8, '库里', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '2016-06-06 14:36:54', '2016-06-06 14:36:54'),
(9, 'James', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '2016-06-06 16:39:26', '2016-06-06 16:39:26');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `message`
--

INSERT INTO `message` (`id`, `mid`, `title`, `content`, `content_time`, `state`, `top_state`) VALUES
(1, 3, '库里', '勇士水花兄弟', '2016-06-05 17:57:55', 0, 0),
(2, 3, 'James', '骑士詹姆斯。。。', '2016-06-05 18:12:29', 0, 0),
(3, 5, '我不是张三', '我是隔壁李四', '2016-06-05 21:21:38', 0, 0),
(4, 6, '隔壁老王', '我是隔壁老王我是隔壁老王我是隔壁老王我是隔壁老王我是隔壁老王我是隔壁老王我是隔壁老王我是隔壁老王', '2016-06-05 21:52:50', 0, 0),
(5, 6, '今天是六月五号', '今天是六月五号 天气晴朗', '2016-06-05 22:04:55', 0, 0),
(6, 7, '勇士VS骑士', '明天总决赛G2勇士对阵骑士。。。', '2016-06-05 22:07:37', 0, 0),
(7, 7, '马刺', '邓呆呆要退役了吗', '2016-06-05 22:08:44', 0, 0),
(8, 2, '简单爱', '周杰伦--------简单爱', '2016-06-05 22:09:23', 0, 0),
(9, 2, '呵呵', '呵呵哈哈哈和^_^', '2016-06-05 22:09:55', 0, 0),
(10, 4, 'github', '这是我的github地址，欢迎大家访问！', '2016-06-05 22:10:36', 0, 0),
(11, 4, '码云', '码云是国内一个很好的版本控制系统....', '2016-06-05 22:11:56', 0, 0),
(12, 8, '吊打骑士', '今天又在主场吊打了一顿骑士***\r\n。。', '2016-06-06 14:38:45', 0, 0),
(13, 9, '输球', '今天又输了，大败勇士', '2016-06-06 16:40:03', 0, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `reply`
--

INSERT INTO `reply` (`id`, `content_id`, `content_reply`, `reply_time`, `member_id`, `quote_id`) VALUES
(1, 12, '詹姆斯在吐血了！！！', '2016-06-06 16:28:42', 3, 0),
(2, 8, '一首简单的小情歌', '2016-06-06 16:35:59', 4, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
