/*
Navicat MySQL Data Transfer

Source Server         : localhost3309
Source Server Version : 50548
Source Host           : localhost:3309
Source Database       : yiiweb4

Target Server Type    : MYSQL
Target Server Version : 50548
File Encoding         : 65001

Date: 2017-06-07 12:04:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for log_import
-- ----------------------------
DROP TABLE IF EXISTS `log_import`;
CREATE TABLE `log_import` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) DEFAULT NULL,
  `records` int(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log_import
-- ----------------------------
