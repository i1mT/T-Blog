-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-05-11 07:53:12
-- 服务器版本： 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `t-blog`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pwd` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `nickname`, `pic`, `username`, `pwd`) VALUES
(1, 'iimT', '', 'iimT', 'ATyangguang');

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL COMMENT '标题',
  `cate` bigint(11) NOT NULL COMMENT '分类id',
  `content` text NOT NULL COMMENT '内容',
  `publishAt` datetime NOT NULL COMMENT '发布时间',
  `lastEdit` datetime NOT NULL COMMENT '上一次编辑时间',
  `author` bigint(11) NOT NULL COMMENT '作者id',
  `viewed` bigint(20) NOT NULL COMMENT '浏览数',
  `comments` bigint(20) NOT NULL COMMENT '评论数',
  `likes` bigint(20) NOT NULL COMMENT '赞数',
  `cover` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `article`
--

INSERT INTO `article` (`id`, `title`, `cate`, `content`, `publishAt`, `lastEdit`, `author`, `viewed`, `comments`, `likes`, `cover`) VALUES
(1, '更改文章标题1', 1, '#更改测试', '2017-05-10 08:26:37', '2017-05-10 15:07:06', 1, 1, 4, 1, '更改http://www.iimt.me/usr/themes/iimT//img/avatar.jpg'),
(2, '文章标题', 1, '#测试', '2017-05-10 08:28:24', '2017-05-10 08:28:24', 1, 0, 0, 0, 'http://www.iimt.me/usr/themes/iimT//img/avatar.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `bloginfo`
--

CREATE TABLE `bloginfo` (
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `siteurl` varchar(100) NOT NULL,
  `starttime` datetime NOT NULL,
  `id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bloginfo`
--

INSERT INTO `bloginfo` (`name`, `description`, `siteurl`, `starttime`, `id`) VALUES
('iimT', '介绍啊', '地1址', '2017-05-09 16:44:10', 1);

-- --------------------------------------------------------

--
-- 表的结构 `cate`
--

CREATE TABLE `cate` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cate`
--

INSERT INTO `cate` (`id`, `name`) VALUES
(1, '分类1'),
(2, '测试分类');

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `uid` bigint(20) NOT NULL,
  `likes` bigint(20) NOT NULL,
  `content` text NOT NULL,
  `commenttime` datetime NOT NULL,
  `articleid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `comment`
--

INSERT INTO `comment` (`id`, `uid`, `likes`, `content`, `commenttime`, `articleid`) VALUES
(1, 1, 1, '这是一条评论', '2017-05-10 15:34:15', 0);

-- --------------------------------------------------------

--
-- 表的结构 `comment_user`
--

CREATE TABLE `comment_user` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `site` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `comment_user`
--

INSERT INTO `comment_user` (`id`, `name`, `email`, `site`) VALUES
(1, 'iimT', 'tfhhh@qq.com', 'www.iimt.me');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `bloginfo`
--
ALTER TABLE `bloginfo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `cate`
--
ALTER TABLE `cate`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `comment_user`
--
ALTER TABLE `comment_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `cate`
--
ALTER TABLE `cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `comment_user`
--
ALTER TABLE `comment_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
