<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	
	public function install() {
		
		$sql = "
/*==============================================================*/
/* DB name:        plantsearch                                  */
/* Created on:     2012/11/18 23:13:07                          */
/* Edited by:      suwei.air                                    */
/*==============================================================*/
DROP TABLE IF EXISTS `feature`;
DROP TABLE IF EXISTS `plant`;
DROP TABLE IF EXISTS `plant_feature`;
DROP TABLE IF EXISTS `taxon`;
DROP TABLE IF EXISTS `photo`;
DROP TABLE IF EXISTS `user`;

/*==============================================================*/
/* Table: feature                                               */
/*==============================================================*/
CREATE TABLE `feature`
(
	`feature_id`	INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name`			VARCHAR(32) NOT NULL,
	`field_name`	VARCHAR(32) NOT NULL,
	`description`	VARCHAR(255),
	`type`			SET('SET', 'FLOAT', 'DATE') NOT NULL DEFAULT 'SET',
	`value`			TEXT,
	`is_display`	TINYINT DEFAULT 1,
	UNIQUE (`name`),
	UNIQUE (`field_name`)
);

/*==============================================================*/
/* Table: plant                                                 */
/*==============================================================*/
CREATE TABLE `plant`
(
	`plant_id`		INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name`			VARCHAR(64) NOT NULL,
	`pinyin`		VARCHAR(64),
	`sci_name`		VARCHAR(64),
	`comm_name`		VARCHAR(128),
	`taxon_id`		INT,
	`sci_intro`		TEXT,
	`pop_intro`		TEXT,
	`cover_pic` 	VARCHAR(255),
	UNIQUE (`name`)
);

/*==============================================================*/
/* Table: plant_feature                                         */
/*==============================================================*/
CREATE TABLE `plant_feature`
(
	`plant_feature_id`	INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`plant_id`		INT NOT NULL,
	UNIQUE (`species_id`)
);

/*==============================================================*/
/* Table: taxon                                                 */
/*==============================================================*/
CREATE TABLE `taxon`
(
	`taxon_id`		INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`level`			ENUM('KINGDOM', 'PHYLUM', 'CLASS', 'ORDER', 'FAMILY', 'GENUS', 'SPECIES') NOT NULL DEFAULT 'FAMILY',
	`name`			VARCHAR(64) NOT NULL,
	`sci_name`		VARCHAR(64),
	`intro`			TEXT,
	`parent_id`		INT DEFAULT 0,
	INDEX (`parent_id`)
);

/*==============================================================*/
/* Table: photo                                                 */
/*==============================================================*/
CREATE TABLE `photo`
(
	`pic_id`		INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`url`			VARCHAR(255) NOT NULL,
	`plant_id`		INT,
	`uploader_id`	INT NOT NULL,
	`upload_ip`		VARCHAR(32) NOT NULL,
	`upload_time`	DATETIME NOT NULL,
	UNIQUE (`url`)
);

/*==============================================================*/
/* Table: user                                                  */
/*==============================================================*/
CREATE TABLE `user`
(
	`user_id`		INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`email`			VARCHAR(64) NOT NULL,
	`password`		VARCHAR(128) NOT NULL,
	`username`		VARCHAR(32) NOT NULL,
	`reg_time`		DATETIME NOT NULL,
	`last_time`		DATETIME NOT NULL,
	`last_ip`		VARCHAR(32) NOT NULL,
	`authorization`	SET('LOGIN', 'COMMENT', 'UPLOAD', 'ADMIN') NOT NULL DEFAULT 'LOGIN',
	UNIQUE (`email`),
	UNIQUE (`username`)
);
";
		return $this->db->simple_query($sql);
	}
}
