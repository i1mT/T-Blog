-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2017-05-31 22:03:02
-- 服务器版本： 10.1.23-MariaDB-8
-- PHP Version: 7.0.19-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
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
(1, 'admin', '', 'admin', 'admin');

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
(1, '安装成功，请阅读这篇文章', 0, '## > 非常感谢你选择了T-Blog，当你看到这篇文章时，表示安装已经成功。\n\n###你可以在/admin下编辑使用后台，如果你不知道后台如何使用，可以先学习一点命令\n\n### [T-Blog的介绍以及使用方法](https://github.com/tfh93121/T-Blog)\n\n### 当你学会如何使用后台命令的时候，相信你会感受到它的爽(bi)快(ge)的\n\n### 祝使用此系统会使你更加愉快~\n\n###如果你是程序员，或者在使用途中遇到了问题，又或你有一些意见，欢迎来一起交流。\n\n### > 联系方式：QQ1298793121', '2017-05-10 08:26:37', '2017-05-15 08:35:25', 1, 0, 0, 0, 'http://oqapmzmc9.bkt.clouddn.com/default-cover.jpg');

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
('个人博客', '记录点滴思想', '', '2017-05-09 16:44:10', 1);

-- --------------------------------------------------------

--
-- 表的结构 `cate`
--

CREATE TABLE `cate` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- 使用表AUTO_INCREMENT `cate`
--
ALTER TABLE `cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `comment_user`
--
ALTER TABLE `comment_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
