/*==============================================================*/
/* DB name:        plantsearch                                  */
/* Created on:     2015/01/11 20:09                             */
/* Edited by:      suwei-air                                    */
/*==============================================================*/
CREATE DATABASE IF NOT EXISTS `app_plantsearch`;
USE `app_plantsearch`;

/*==============================================================*/
/* Table: feature                                               */
/*==============================================================*/
DROP TABLE IF EXISTS `feature`;
CREATE TABLE IF NOT EXISTS `feature` (
  `feature_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `field_name` varchar(32) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type` set('SET','FLOAT','DATE') NOT NULL DEFAULT 'SET',
  `value` text,
  `is_display` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`feature_id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `field_name` (`field_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

/*==============================================================*/
/* Table: plant                                                 */
/*==============================================================*/
DROP TABLE IF EXISTS `plant`;
CREATE TABLE IF NOT EXISTS `plant` (
  `plant_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `pinyin` varchar(64) DEFAULT NULL,
  `sci_name` varchar(64) DEFAULT NULL,
  `comm_name` varchar(128) DEFAULT NULL,
  `taxon_id` int(11) DEFAULT NULL,
  `sci_intro` text,
  `sci_intro_source` text,
  `pop_intro` text,
  `cover_pic` varchar(255) DEFAULT NULL,
  `uploader_id` int(11) NOT NULL,
  `upload_ip` varchar(32) NOT NULL,
  `upload_time` datetime NOT NULL,
  `status` enum('EDITING','VERIFYING','VERIFIED') NOT NULL DEFAULT 'EDITING',
  PRIMARY KEY (`plant_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

/*==============================================================*/
/* Table: plant_feature                                         */
/*==============================================================*/
DROP TABLE IF EXISTS `plant_feature`;
CREATE TABLE IF NOT EXISTS `plant_feature` (
  `plant_feature_id` int(11) NOT NULL AUTO_INCREMENT,
  `plant_id` int(11) NOT NULL,
  PRIMARY KEY (`plant_feature_id`),
  UNIQUE KEY `plant_id` (`plant_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

/*==============================================================*/
/* Table: taxon                                                 */
/*==============================================================*/
DROP TABLE IF EXISTS `taxon`;
CREATE TABLE IF NOT EXISTS `taxon` (
  `taxon_id` int(11) NOT NULL AUTO_INCREMENT,
  `level` enum('KINGDOM','PHYLUM','CLASS','ORDER','FAMILY','GENUS','SPECIES') NOT NULL DEFAULT 'FAMILY',
  `name` varchar(64) NOT NULL,
  `sci_name` varchar(64) DEFAULT NULL,
  `intro` text,
  `parent_id` int(11) DEFAULT '0',
  PRIMARY KEY (`taxon_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

/*==============================================================*/
/* Table: photo                                                 */
/*==============================================================*/
DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `pic_id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `url_original` varchar(255) NOT NULL,
  `plant_id` int(11) DEFAULT NULL,
  `uploader_id` int(11) NOT NULL,
  `upload_ip` varchar(32) NOT NULL,
  `upload_time` datetime NOT NULL,
  `description` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`pic_id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

/*==============================================================*/
/* Table: user                                                  */
/*==============================================================*/
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `username` varchar(32) NOT NULL,
  `reg_time` datetime NOT NULL,
  `last_time` datetime NOT NULL,
  `last_ip` varchar(32) NOT NULL,
  `authorization` set('LOGIN','COMMENT','UPLOAD','VERIFY','ADMIN') NOT NULL DEFAULT 'LOGIN',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

