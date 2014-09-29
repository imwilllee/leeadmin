/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50536
Source Host           : localhost:3306
Source Database       : leeadmin

Target Server Type    : MYSQL
Target Server Version : 50536
File Encoding         : 65001

Date: 2014-09-29 10:53:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for articles
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
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
  `modified` datetime DEFAULT NULL COMMENT '更新日期',
  `modified_by` int(11) unsigned DEFAULT NULL COMMENT '更新者ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
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
  `modified` datetime DEFAULT NULL COMMENT '更新日期',
  `modified_by` int(11) unsigned DEFAULT NULL COMMENT '更新者ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章分类表';

-- ----------------------------
-- Table structure for groups
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(255) NOT NULL COMMENT '用户组名称',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '状态 0:禁用  1:启用',
  `explain` varchar(255) DEFAULT NULL COMMENT '备注说明',
  `created` datetime DEFAULT NULL COMMENT '创建日期',
  `created_by` int(11) unsigned DEFAULT NULL COMMENT '创建者ID',
  `modified` datetime DEFAULT NULL COMMENT '更新日期',
  `modified_by` int(11) unsigned DEFAULT NULL COMMENT '更新者ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='用户组表';

-- ----------------------------
-- Table structure for group_accesses
-- ----------------------------
DROP TABLE IF EXISTS `group_accesses`;
CREATE TABLE `group_accesses` (
  `group_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户组ID',
  `menu_node_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '菜单节点ID',
  PRIMARY KEY (`group_id`,`menu_node_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户组访问规则表';

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `plugin_code` varchar(255) DEFAULT NULL COMMENT '插件代码',
  `menu_code` varchar(255) DEFAULT NULL COMMENT '菜单代码',
  `parent_code` varchar(255) DEFAULT NULL COMMENT '菜单主节点代码',
  `name` varchar(255) DEFAULT NULL COMMENT '菜单名称',
  `link` varchar(255) DEFAULT NULL COMMENT '链接',
  `class` varchar(255) DEFAULT NULL COMMENT '菜单图标CSS',
  `rank` int(22) unsigned DEFAULT '0' COMMENT '显示排序',
  `has_nodes` tinyint(1) unsigned DEFAULT '0' COMMENT '包含节点 0:否 1:是',
  `display_flg` tinyint(1) unsigned DEFAULT '0' COMMENT '显示标志 0:不显示 1:显示',
  `created` datetime DEFAULT NULL COMMENT '创建日期',
  `created_by` int(11) unsigned DEFAULT NULL COMMENT '创建者ID',
  `modified` datetime DEFAULT NULL COMMENT '更新日期',
  `modified_by` int(11) unsigned DEFAULT NULL COMMENT '更新者ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='菜单表';

-- ----------------------------
-- Table structure for menu_nodes
-- ----------------------------
DROP TABLE IF EXISTS `menu_nodes`;
CREATE TABLE `menu_nodes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `menu_id` int(10) unsigned DEFAULT NULL COMMENT '菜单ID',
  `link` varchar(255) DEFAULT NULL COMMENT '模块动作',
  `name` varchar(255) DEFAULT NULL COMMENT '动作名称',
  PRIMARY KEY (`id`),
  UNIQUE KEY `INDEX_1` (`link`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='菜单节点表';

-- ----------------------------
-- Table structure for plugins
-- ----------------------------
DROP TABLE IF EXISTS `plugins`;
CREATE TABLE `plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `plugin_code` varchar(255) NOT NULL COMMENT '插件代码',
  `name` varchar(255) NOT NULL COMMENT '插件名称',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '运行状态 0:禁用 1:启用',
  `version` varchar(255) DEFAULT NULL COMMENT '版本',
  `developer` varchar(255) DEFAULT NULL COMMENT '开发者',
  `explain` text COMMENT '说明描述',
  `autoload` tinyint(1) unsigned DEFAULT '0' COMMENT '自动加载 0:是 1:否',
  `bootstrap` tinyint(1) unsigned DEFAULT '0' COMMENT '加载引导文件 0:否 1:是',
  `routes` tinyint(1) unsigned DEFAULT '0' COMMENT '加载路由文件 0:否 1:是',
  `require` varchar(255) DEFAULT NULL COMMENT '依赖插件',
  `created` datetime DEFAULT NULL COMMENT '创建日期',
  `created_by` int(11) unsigned DEFAULT NULL COMMENT '创建者ID',
  `modified` datetime DEFAULT NULL COMMENT '更新日期',
  `modified_by` int(11) unsigned DEFAULT NULL COMMENT '更新者ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(40) NOT NULL COMMENT 'sessionID',
  `data` text COMMENT 'session值',
  `expires` int(11) unsigned NOT NULL COMMENT '过期时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='session表';

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '状态 0:禁用 1:启用',
  `group_id` int(11) unsigned DEFAULT NULL COMMENT '用户组ID',
  `alias` varchar(255) DEFAULT NULL COMMENT '昵称',
  `mobile` varchar(255) DEFAULT NULL COMMENT '手机号码',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像路径',
  `sex` int(1) unsigned DEFAULT '0' COMMENT '性别 0:保密 1:男性 2:女性',
  `birth` date DEFAULT NULL COMMENT '出生年月',
  `last_logined` datetime DEFAULT NULL COMMENT '最后登录日期',
  `last_login_ip` varchar(255) DEFAULT NULL COMMENT '最后登录IP',
  `last_user_agent` varchar(255) DEFAULT NULL COMMENT '最后登录时UA',
  `explain` text COMMENT '备注说明',
  `created` datetime DEFAULT NULL COMMENT '创建日期',
  `created_by` int(11) DEFAULT NULL COMMENT '创建者ID',
  `modified` datetime DEFAULT NULL COMMENT '更新日期',
  `modified_by` int(11) unsigned DEFAULT NULL COMMENT '更新者ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `INDEX_1` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='用户表';
