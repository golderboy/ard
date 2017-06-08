/*
Navicat MySQL Data Transfer

Source Server         : localhost3309
Source Server Version : 50548
Source Host           : localhost:3309
Source Database       : yiiweb4

Target Server Type    : MYSQL
Target Server Version : 50548
File Encoding         : 65001

Date: 2017-06-07 12:04:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for drugdata
-- ----------------------------
DROP TABLE IF EXISTS `drugdata`;
CREATE TABLE `drugdata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pcucode` varchar(255) NOT NULL,
  `daterecord` date NOT NULL,
  `hn` varchar(255) NOT NULL,
  `cardid` varchar(255) DEFAULT NULL,
  `pttitle` varchar(255) DEFAULT NULL,
  `ptfname` varchar(255) DEFAULT NULL,
  `ptlname` varchar(255) DEFAULT NULL,
  `ptsex` varchar(255) DEFAULT NULL,
  `ptdob` date DEFAULT NULL,
  `ptaddress` varchar(255) DEFAULT NULL,
  `ptvillage` varchar(255) DEFAULT NULL,
  `pttambon` varchar(255) DEFAULT NULL,
  `ptamphur` varchar(255) DEFAULT NULL,
  `ptprovince` varchar(255) DEFAULT NULL,
  `ptphone` varchar(255) DEFAULT NULL,
  `listname` varchar(255) DEFAULT NULL,
  `listsign` varchar(255) DEFAULT NULL,
  `descrip` varchar(255) DEFAULT NULL,
  `pharmacist` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of drugdata
-- ----------------------------
