create database if not exists liangcmsdb;

use liangcmsdb;

/*
后台用户表
*/
create table if not exists `cms_admin` (
	`admin_id` mediumint(6) unsigned not null auto_increment,
    `username` varchar(20) not null default ' ',
	`password` varchar(32) not null default ' ',
    `lastloginip` varchar(15) default '0',
    `lastlogintime` int(10) unsigned default '0',
    `email` varchar(40) default ' ',
    `realname` varchar(50) not null default ' ',
    `status` tinyint(1) not null default '1',
    primary key (`admin_id`),
    key `username` (`username`)
) engine=MyISAM auto_increment=1 default charset=utf8;

/**
菜单表
*/
create table if not exists `cms_menu` (
	`menu_id` smallint(6) unsigned not null auto_increment,
    `name` varchar(40) not null default ' ',
    `parentid` smallint(6) not null default '0',
    `m` varchar(20) not null default ' ',
	`c` varchar(20) not null default ' ',
    `f` varchar(20) not null default ' ',
    `listorder` smallint(6) unsigned not null default '0',
    `status` tinyint(1) not null default '1',
    `type` tinyint(1) unsigned not null default '0',
    primary key (`menu_id`),
    key `listorder` (`listorder`),
    key `parentid` (`parentid`),
    key `module` (`m`,`c`,`f`)
) engine=MyISAM auto_increment=1 default charset=utf8;

/*
新闻文章主表
*/
create table if not exists `cms_news` (
	`news_id` mediumint(8) unsigned not null auto_increment,
    `cateid` smallint(5) unsigned not null default '0',
    `title` varchar(80) not null default ' ',
    `small_title` varchar(30) not null default ' ',
	`title_front_color` varchar(250) default null comment '标题颜色',
    `thumb` varchar(100) not null default ' ',
    `keywords` char(40) not null default ' ',
    `description` varchar(250) not null comment '文章描述',
    `listorder` tinyint(3) unsigned not null default '0',
    `status` tinyint(1) not null default '1',
    `copyfrom` varchar(250) default null comment '来源',
    `username` char(20) not null,
    `create_time` int(10) unsigned not null default '0',
    `update_time` int(10) unsigned not null default '0',
    `count` int(10) unsigned not null default '0',
    primary key (`news_id`),
    key `listorder` (`listorder`),
    key `cateid` (`cateid`)
) engine=MyISAM auto_increment=1 default charset=utf8;

/*
新闻文章内容副表
*/
create table if not exists `cms_news_content` (
	`id` mediumint(8) unsigned not null auto_increment,
    `news_id` mediumint(8) unsigned not null,
    `content` mediumtext not null,
    `create_time` int(10) unsigned not null default '0',
    `update_time` int(10) unsigned not null default '0',
    primary key (`id`),
    key `news_id` (`news_id`)
) engine=MyISAM auto_increment=1 default charset=utf8;

/*
推荐位表
*/
create table if not exists `cms_position` (
	`id` smallint(5) unsigned not null auto_increment,
    `name` char(30) not null default ' ',
    `status` tinyint(1) not null default '1',
    `description` char(100) default null,
    `create_time` int(10) unsigned not null default '0',
    `update_time` int(10) unsigned not null default '0',
    primary key (`id`)
) engine=MyISAM auto_increment=1 default charset=utf8;

create table if not exists `cms_position_content` (
	`id` smallint(5) unsigned not null auto_increment,
    `position_id` int(5) unsigned not null,
    `title` varchar(30) not null default ' ',
    `thumb` varchar(100) not null default ' ',
    `url` varchar(100) default null,
    `news_id` mediumint(8) unsigned not null,
    `listorder` tinyint(3) unsigned not null default '0',
    `status` tinyint(1) not null default '1',
    `create_time` int(10) unsigned not null default '0',
    `update_time` int(10) unsigned not null default '0',
    primary key (`id`),
    key `position_id` (`position_id`)
) engine=MyISAM auto_increment=1 default charset=utf8;