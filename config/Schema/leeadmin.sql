-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2014-08-15 11:59:13
-- 服务器版本： 5.5.36
-- PHP Version: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `leeadmin`
--

-- --------------------------------------------------------

--
-- 表的结构 `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `code` varchar(255) DEFAULT NULL COMMENT '文章代码',
  `title` varchar(255) DEFAULT NULL COMMENT '文章标题',
  `description` text COMMENT '文章摘要',
  `content` text COMMENT '文章内容',
  `category_id` int(11) unsigned DEFAULT NULL COMMENT '所属分类ID',
  `seo_title` text COMMENT 'seo标题',
  `seo_keyword` text COMMENT 'seo关键字',
  `seo_description` text COMMENT 'seo描述',
  `rank` int(11) unsigned DEFAULT '0' COMMENT '排序',
  `published_status` int(1) unsigned DEFAULT '0' COMMENT '公开状态 0:公开 1:不公开 2:草稿',
  `published_start` datetime DEFAULT NULL COMMENT '开放日期',
  `published_end` datetime DEFAULT NULL COMMENT '截止日期',
  `public_pc_flg` tinyint(1) unsigned DEFAULT '0' COMMENT 'PC端公开标志 0:不公开 1:公开',
  `public_mb_flg` tinyint(1) unsigned DEFAULT '0' COMMENT 'MB端公开标志 0:不公开 1:公开',
  `recommend_flg` tinyint(1) unsigned DEFAULT '0' COMMENT '推荐文章 0:否 1:是',
  `hot_flg` tinyint(1) unsigned DEFAULT '0' COMMENT '热门文章 0:否 1:是',
  `thumbnail_pc` varchar(255) DEFAULT NULL COMMENT 'PC缩略图',
  `thumbnail_mb` varchar(255) DEFAULT NULL COMMENT 'MB缩略图',
  `comment_status` int(1) unsigned DEFAULT '0' COMMENT '评论状态 0:禁止评论 1:登陆评论 2:游客评论',
  `comment_count` int(1) unsigned DEFAULT '0' COMMENT '评论数量',
  `view_count` int(11) unsigned DEFAULT '0' COMMENT '查看数量',
  `created` datetime DEFAULT NULL COMMENT '创建日期',
  `created_by` int(11) unsigned DEFAULT NULL COMMENT '创建者ID',
  `updated` datetime DEFAULT NULL COMMENT '更新日期',
  `updated_by` int(11) unsigned DEFAULT NULL COMMENT '更新者ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `article_categories`
--

DROP TABLE IF EXISTS `article_categories`;
CREATE TABLE IF NOT EXISTS `article_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `lft` int(11) unsigned DEFAULT NULL COMMENT '树排序左值',
  `rght` int(11) unsigned DEFAULT NULL COMMENT '树排序右值',
  `parent_id` int(11) unsigned DEFAULT NULL COMMENT '父分类ID',
  `first_word` char(1) DEFAULT NULL COMMENT '分类首字母',
  `name` varchar(255) DEFAULT NULL COMMENT '分类名称',
  `explain` text COMMENT '说明摘要',
  `code` varchar(255) DEFAULT NULL COMMENT '分类代码',
  `seo_title` text COMMENT 'seo标题',
  `seo_keyword` text COMMENT 'seo关键字',
  `seo_description` text COMMENT 'seo描述',
  `article_count` int(11) unsigned DEFAULT '0' COMMENT '下属文章数',
  `created` datetime DEFAULT NULL COMMENT '创建日期',
  `created_by` int(11) unsigned DEFAULT NULL COMMENT '创建者ID',
  `updated` datetime DEFAULT NULL COMMENT '更新日期',
  `updated_by` int(11) unsigned DEFAULT NULL COMMENT '更新者ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章分类表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `article_comments`
--

DROP TABLE IF EXISTS `article_comments`;
CREATE TABLE IF NOT EXISTS `article_comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `lft` int(11) unsigned DEFAULT NULL COMMENT '树排序左值',
  `rght` int(11) unsigned DEFAULT NULL COMMENT '树排序右值',
  `parent_id` int(11) unsigned DEFAULT NULL COMMENT '父ID',
  `article_id` int(11) unsigned DEFAULT NULL COMMENT '文章ID',
  `name` varchar(255) DEFAULT NULL COMMENT '评论者名称',
  `email` varchar(255) DEFAULT NULL COMMENT '评论者邮箱',
  `website` varchar(255) DEFAULT NULL COMMENT '评论者站点',
  `ip_address` varchar(255) DEFAULT NULL COMMENT '评论者IP',
  `user_agent` text COMMENT '评论者UA',
  `title` varchar(255) DEFAULT NULL COMMENT '评论标题',
  `body` text COMMENT '评论内容',
  `comment_status` int(1) unsigned DEFAULT '0' COMMENT '评论状态 0:审核中 1:通过 2:未通过',
  `type` int(1) unsigned DEFAULT '0' COMMENT '评论类型 0:一般评论 1:用户回复 2:管理员回复',
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '用户ID',
  `notify_flg` tinyint(1) unsigned DEFAULT '0' COMMENT '通知标志 0:未通知 1:已通知',
  `created` datetime DEFAULT NULL COMMENT '创建日期',
  `created_by` int(11) unsigned DEFAULT NULL COMMENT '创建者ID',
  `updated` datetime DEFAULT NULL COMMENT '更新日期',
  `updated_by` int(11) unsigned DEFAULT NULL COMMENT '更新者ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章评论表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `attachments`
--

DROP TABLE IF EXISTS `attachments`;
CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `link` varchar(255) DEFAULT NULL COMMENT '访问链接',
  `original_filename` varchar(255) DEFAULT NULL COMMENT '文件原名',
  `upload_filename` varchar(255) DEFAULT NULL COMMENT '保存文件名',
  `upload_dir` varchar(255) DEFAULT NULL COMMENT '保存目录',
  `mime_type` varchar(255) DEFAULT NULL COMMENT 'mime类型',
  `extension` varchar(255) DEFAULT NULL COMMENT '扩展名',
  `size` int(11) unsigned DEFAULT '0' COMMENT '文件大小',
  `type` varchar(255) DEFAULT NULL COMMENT '附件类型',
  `title` varchar(255) DEFAULT NULL COMMENT 'title属性',
  `alt` varchar(255) DEFAULT NULL COMMENT 'alt属性',
  `explain` text COMMENT '说明摘要',
  `privacy_flg` tinyint(1) unsigned DEFAULT '0' COMMENT '隐私标志 0:非隐私(通过浏览器可访问) 1:隐私(浏览器不可访问)',
  `terminal_flg` int(1) unsigned DEFAULT '0' COMMENT '展示终端  0:所有 1:PC端 2:MB端',
  `rank` int(11) unsigned DEFAULT '0' COMMENT '排序',
  `created` datetime DEFAULT NULL COMMENT '创建日期',
  `created_by` int(11) unsigned DEFAULT NULL COMMENT '创建者ID',
  `updated` datetime DEFAULT NULL COMMENT '更新日期',
  `updated_by` int(11) unsigned DEFAULT NULL COMMENT '更新者ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='附件表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(255) NOT NULL COMMENT '管理组名称',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '状态 0:正常  1:禁止登陆',
  `explain` text COMMENT '备注',
  `created` datetime DEFAULT NULL COMMENT '创建日期',
  `created_by` int(11) unsigned DEFAULT NULL COMMENT '创建者ID',
  `updated` datetime DEFAULT NULL COMMENT '更新日期',
  `updated_by` int(11) unsigned DEFAULT NULL COMMENT '更新者ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户组表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `groups`
--

INSERT INTO `groups` (`id`, `name`, `status`, `explain`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1, '超级管理员', 0, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `group_accesses`
--

DROP TABLE IF EXISTS `group_accesses`;
CREATE TABLE IF NOT EXISTS `group_accesses` (
  `group_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '管理员用户组ID',
  `menu_action_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '模块动作ID',
  PRIMARY KEY (`group_id`,`menu_action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户组访问规则表';

-- --------------------------------------------------------

--
-- 表的结构 `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `plugin_code` varchar(255) DEFAULT NULL COMMENT '插件代码',
  `menu_code` varchar(255) DEFAULT NULL COMMENT '菜单code',
  `parent_code` varchar(255) DEFAULT NULL COMMENT '菜单父code',
  `name` varchar(255) DEFAULT NULL COMMENT '菜单名称',
  `link` varchar(255) DEFAULT NULL COMMENT '链接',
  `class` varchar(255) DEFAULT NULL COMMENT '菜单图标CSS',
  `rank` int(22) unsigned DEFAULT '0' COMMENT '显示排序',
  `display_flg` tinyint(1) unsigned DEFAULT '0' COMMENT '显示标志 0:不显示 1:显示',
  `created` datetime DEFAULT NULL COMMENT '创建日期',
  `created_by` int(11) unsigned DEFAULT NULL COMMENT '创建者ID',
  `updated` datetime DEFAULT NULL COMMENT '更新日期',
  `updated_by` int(11) unsigned DEFAULT NULL COMMENT '更新者ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='菜单表' AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `menus`
--

INSERT INTO `menus` (`id`, `plugin_code`, `menu_code`, `parent_code`, `name`, `link`, `class`, `rank`, `display_flg`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1, NULL, 'dashboard', NULL, '控制面板', 'admin/dashboard/index', 'fa fa-dashboard', 0, 1, '2014-07-16 22:15:03', 1, NULL, NULL),
(2, NULL, 'user', NULL, '系统用户', NULL, 'fa fa-user', 0, 1, '2014-07-16 22:15:04', 1, NULL, NULL),
(3, NULL, NULL, 'user', '系统管理员', 'admin/user/index', NULL, 0, 1, '2014-07-16 22:15:04', 1, NULL, NULL),
(4, NULL, NULL, 'user', '创建管理员', 'admin/user/create', NULL, 0, 1, '2014-07-16 22:15:05', 1, NULL, NULL),
(5, NULL, NULL, 'user', '用户组管理', 'admin/user_group/index', NULL, 0, 1, '2014-07-16 22:15:05', 1, NULL, NULL),
(6, NULL, NULL, 'user', '创建用户组', 'admin/user_group/create', NULL, 0, 1, '2014-07-16 22:15:06', 1, NULL, NULL),
(7, NULL, 'member', NULL, '会员中心', NULL, 'fa fa-users', 0, 1, '2014-07-16 22:15:06', 1, NULL, NULL),
(8, NULL, NULL, 'member', '会员管理', 'admin/member/index', NULL, 0, 1, '2014-07-16 22:15:06', 1, NULL, NULL),
(9, NULL, NULL, 'member', '会员级别设置', 'admin/member_level/index', NULL, 0, 1, '2014-07-16 22:15:06', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `menu_actions`
--

DROP TABLE IF EXISTS `menu_actions`;
CREATE TABLE IF NOT EXISTS `menu_actions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `menu_id` int(10) unsigned DEFAULT NULL COMMENT '菜单ID',
  `link` varchar(255) DEFAULT NULL COMMENT '模块动作',
  `name` varchar(255) DEFAULT NULL COMMENT '动作名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='菜单动作表' AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `menu_actions`
--

INSERT INTO `menu_actions` (`id`, `menu_id`, `link`, `name`) VALUES
(1, 1, 'admin/dashboard/index', '控制面板'),
(2, 3, 'admin/user/create', '创建'),
(3, 3, 'admin/user/index', '查看'),
(4, 3, 'admin/user/view', '详细'),
(5, 3, 'admin/user/edit', '编辑'),
(6, 3, 'admin/user/delete', '删除'),
(7, 5, 'admin/user_group/create', '创建'),
(8, 5, 'admin/user_group/index', '查看'),
(9, 5, 'admin/user_group/edit', '编辑'),
(10, 5, 'admin/user_group/delete', '删除'),
(11, 8, 'admin/member/index', '查看'),
(12, 8, 'admin/member/view', '详细'),
(13, 8, 'admin/member/edit', '编辑'),
(14, 8, 'admin/member/delete', '删除'),
(15, 9, 'admin/member_level/index', '查看'),
(16, 9, 'admin/member_level/edit', '编辑'),
(17, 9, 'admin/member_level/delete', '删除');

-- --------------------------------------------------------

--
-- 表的结构 `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(40) NOT NULL COMMENT 'sessionID',
  `data` text COMMENT 'session值',
  `expires` int(11) unsigned NOT NULL COMMENT '过期时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='session表';

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '状态 0:允许登录 1:禁止登录',
  `mobile` varchar(255) DEFAULT NULL COMMENT '手机号码',
  `alias_name` varchar(255) DEFAULT NULL COMMENT '昵称',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像路径',
  `sex` int(1) unsigned DEFAULT '0' COMMENT '性别 0:保密 1:男性 2:女性',
  `birth` date DEFAULT NULL COMMENT '出生年月',
  `last_logined` datetime DEFAULT NULL COMMENT '最后登录日期',
  `last_login_ip` varchar(255) DEFAULT NULL COMMENT '最后登录IP',
  `last_user_agent` varchar(255) DEFAULT NULL COMMENT '最后登录时UA',
  `secret_key` varchar(255) DEFAULT NULL COMMENT '秘钥(找回密码用)',
  `secret_key_expired` datetime DEFAULT NULL COMMENT '秘钥过期时间',
  `explain` text COMMENT '备注说明',
  `created` datetime DEFAULT NULL COMMENT '创建日期',
  `created_by` int(11) unsigned DEFAULT NULL COMMENT '创建者ID',
  `updated` datetime DEFAULT NULL COMMENT '更新日期',
  `updated_by` int(11) unsigned DEFAULT NULL COMMENT '更新者ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `INDEX_1` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `status`, `mobile`, `alias_name`, `avatar`, `sex`, `birth`, `last_logined`, `last_login_ip`, `last_user_agent`, `secret_key`, `secret_key_expired`, `explain`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1, 'im.will.lee@gmail.com', '$2y$10$4oJmRN8qddmo8tF9Wr.pn.dfFNAQ82QhmkqwpTE1kgPHb/XvwWcDS', 1, '15902148503', '开发者WillLee', '', 1, '1989-07-09', '2014-07-17 17:42:58', NULL, NULL, NULL, NULL, '备注说明', '2014-07-17 11:01:38', 1, NULL, NULL),
(2, 'liwei@e-agency-china.com', '$2y$10$4oJmRN8qddmo8tF9Wr.pn.dfFNAQ82QhmkqwpTE1kgPHb/XvwWcDS', 0, '13823001234', '李伟', '', 0, '1990-12-30', NULL, NULL, NULL, NULL, NULL, '', '2014-07-17 11:07:49', 1, NULL, NULL),
(3, 'liwei+02@e-agency-china.com', '$2y$10$o0JZ3EpBuIkwCwB0sVdlGuaDh7rCEWmVZ4B7Gq1DT.IiaL5OH/bh.', 0, '13823001234', '李伟', '', 0, '1990-12-30', NULL, NULL, NULL, NULL, NULL, '', '2014-07-17 11:08:37', 1, NULL, NULL),
(4, 'liwei+004@e-agency-china.com', '$2y$10$7OzYsEt53/.5sk8U0/MFjOk3QRglBJ1Rz7K7ZCn.oUs9V0E3TvbRS', 0, '', '', '', 0, '2012-07-17', '2014-07-17 17:43:00', NULL, NULL, NULL, NULL, '', '2014-07-17 14:56:11', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `user_attributes`
--

DROP TABLE IF EXISTS `user_attributes`;
CREATE TABLE IF NOT EXISTS `user_attributes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `level_id` int(11) unsigned NOT NULL COMMENT '用户等级',
  `register_terminal_flg` int(1) unsigned DEFAULT NULL COMMENT '注册终端 0:PC 1:MB 2:微信',
  `register_date` date DEFAULT NULL COMMENT '注册日期',
  `register_ip` varchar(255) DEFAULT NULL COMMENT '注册IP',
  `register_user_agent` varchar(255) DEFAULT NULL COMMENT '注册UA',
  `register_status` int(1) unsigned DEFAULT '0' COMMENT '注册状态 0:验证中 1:验证通过 2:验证失败',
  `total_integral` int(11) unsigned DEFAULT '0' COMMENT '总积分',
  `integral` int(11) unsigned DEFAULT '0' COMMENT '当前剩余积分',
  `total_amount` decimal(11,2) unsigned DEFAULT '0.00' COMMENT '总金额',
  `balance` decimal(11,2) unsigned DEFAULT '0.00' COMMENT '当前余额',
  `total_buy` decimal(11,2) unsigned DEFAULT '0.00' COMMENT '总消费金额',
  `notify_flg` tinyint(1) unsigned DEFAULT '0' COMMENT '通知标志 0:未通知 1:已通知',
  `created` date DEFAULT NULL COMMENT '创建日期',
  `created_by` int(11) unsigned DEFAULT NULL COMMENT '创建者ID',
  `updated` date DEFAULT NULL COMMENT '更新日期',
  `updated_by` int(11) unsigned DEFAULT NULL COMMENT '更新者ID',
  PRIMARY KEY (`id`),
  KEY `INDEX_1` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户属性表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `user_levels`
--

DROP TABLE IF EXISTS `user_levels`;
CREATE TABLE IF NOT EXISTS `user_levels` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(255) NOT NULL COMMENT '级别名称',
  `total_buy_caps` int(11) unsigned DEFAULT NULL COMMENT '消费总金额下限',
  `total_buy_limit` int(11) unsigned DEFAULT NULL COMMENT '消费总金额上限',
  `explain` text COMMENT '备注说明',
  `created` datetime DEFAULT NULL COMMENT '创建日期',
  `created_by` int(11) unsigned DEFAULT NULL COMMENT '创建者ID',
  `updated` datetime DEFAULT NULL COMMENT '更新日期',
  `updated_by` int(11) unsigned DEFAULT NULL COMMENT '更新者ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员级别表' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
