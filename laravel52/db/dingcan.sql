/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : 127.0.0.1:3306
Source Database       : dingcan

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-06-09 21:19:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for app_admin
-- ----------------------------
DROP TABLE IF EXISTS `app_admin`;
CREATE TABLE `app_admin` (
  `adminId` int(11) NOT NULL AUTO_INCREMENT,
  `adminName` varchar(255) DEFAULT NULL,
  `adminPwd` varchar(255) DEFAULT NULL,
  `adminImg` varchar(255) DEFAULT NULL,
  `adminTime` datetime DEFAULT NULL,
  `creatTime` datetime DEFAULT NULL,
  PRIMARY KEY (`adminId`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of app_admin
-- ----------------------------
INSERT INTO `app_admin` VALUES ('1', '张三', '123', null, '2018-06-09 11:06:38', null);
INSERT INTO `app_admin` VALUES ('18', '李四', '123', '\\uploads\\20180428\\5823aef7f6c1ef3cbfa6501186fbb7ea.jpg', '2018-06-06 15:09:44', '2018-04-28 11:01:31');
INSERT INTO `app_admin` VALUES ('19', '4444', '1', '\\uploads\\20180428\\53757310777ccede63bc79bb13ee2b13.jpg', null, '2018-04-28 19:11:08');
INSERT INTO `app_admin` VALUES ('20', '小郝', '123', null, '2018-06-09 12:56:53', null);

-- ----------------------------
-- Table structure for app_admin_role
-- ----------------------------
DROP TABLE IF EXISTS `app_admin_role`;
CREATE TABLE `app_admin_role` (
  `roleId` int(11) NOT NULL,
  `adminId` int(11) NOT NULL,
  PRIMARY KEY (`roleId`,`adminId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of app_admin_role
-- ----------------------------
INSERT INTO `app_admin_role` VALUES ('1', '1');
INSERT INTO `app_admin_role` VALUES ('1', '18');
INSERT INTO `app_admin_role` VALUES ('2', '19');
INSERT INTO `app_admin_role` VALUES ('36', '20');

-- ----------------------------
-- Table structure for app_jurisdiction
-- ----------------------------
DROP TABLE IF EXISTS `app_jurisdiction`;
CREATE TABLE `app_jurisdiction` (
  `jId` int(11) NOT NULL AUTO_INCREMENT,
  `jName` varchar(255) DEFAULT NULL,
  `jController` varchar(255) DEFAULT NULL,
  `jParent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`jId`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of app_jurisdiction
-- ----------------------------
INSERT INTO `app_jurisdiction` VALUES ('1', '权限管理', '', '0');
INSERT INTO `app_jurisdiction` VALUES ('2', '管理员管理', '', '1');
INSERT INTO `app_jurisdiction` VALUES ('3', '角色管理', '', '1');
INSERT INTO `app_jurisdiction` VALUES ('4', '菜单管理', '', '1');
INSERT INTO `app_jurisdiction` VALUES ('8', '管理员添加', '', '2');
INSERT INTO `app_jurisdiction` VALUES ('9', '角色添加', '', '3');
INSERT INTO `app_jurisdiction` VALUES ('10', '菜单添加', '', '4');
INSERT INTO `app_jurisdiction` VALUES ('11', '管理员展示', '', '2');
INSERT INTO `app_jurisdiction` VALUES ('12', '角色展示', '', '3');
INSERT INTO `app_jurisdiction` VALUES ('13', '菜单展示', '', '4');
INSERT INTO `app_jurisdiction` VALUES ('17', '城市管理', 'chengshi', '0');
INSERT INTO `app_jurisdiction` VALUES ('18', '城市添加', 'chengshi-add', '17');
INSERT INTO `app_jurisdiction` VALUES ('19', '商家管理', 'shangjia', '0');
INSERT INTO `app_jurisdiction` VALUES ('20', '商家添加', '', '19');
INSERT INTO `app_jurisdiction` VALUES ('21', '用户管理', 'yonghu', '0');
INSERT INTO `app_jurisdiction` VALUES ('22', '用户添加', 'yonghuadd', '21');
INSERT INTO `app_jurisdiction` VALUES ('23', '品牌管理', 'pingpai', '0');
INSERT INTO `app_jurisdiction` VALUES ('24', '品牌添加', 'pingpaiadd', '23');

-- ----------------------------
-- Table structure for app_role
-- ----------------------------
DROP TABLE IF EXISTS `app_role`;
CREATE TABLE `app_role` (
  `roleId` int(11) NOT NULL AUTO_INCREMENT,
  `roleName` varchar(255) DEFAULT NULL,
  `roleDesc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`roleId`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of app_role
-- ----------------------------
INSERT INTO `app_role` VALUES ('1', '超级管理员', null);
INSERT INTO `app_role` VALUES ('2', '111', null);
INSERT INTO `app_role` VALUES ('36', '项目组长', '整体项目流程');

-- ----------------------------
-- Table structure for app_role_jursdiction
-- ----------------------------
DROP TABLE IF EXISTS `app_role_jursdiction`;
CREATE TABLE `app_role_jursdiction` (
  `roleId` int(11) NOT NULL,
  `jId` int(11) NOT NULL,
  PRIMARY KEY (`roleId`,`jId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of app_role_jursdiction
-- ----------------------------
INSERT INTO `app_role_jursdiction` VALUES ('1', '1');
INSERT INTO `app_role_jursdiction` VALUES ('1', '2');
INSERT INTO `app_role_jursdiction` VALUES ('1', '3');
INSERT INTO `app_role_jursdiction` VALUES ('1', '4');
INSERT INTO `app_role_jursdiction` VALUES ('1', '5');
INSERT INTO `app_role_jursdiction` VALUES ('1', '6');
INSERT INTO `app_role_jursdiction` VALUES ('1', '7');
INSERT INTO `app_role_jursdiction` VALUES ('1', '8');
INSERT INTO `app_role_jursdiction` VALUES ('1', '9');
INSERT INTO `app_role_jursdiction` VALUES ('1', '10');
INSERT INTO `app_role_jursdiction` VALUES ('1', '11');
INSERT INTO `app_role_jursdiction` VALUES ('1', '12');
INSERT INTO `app_role_jursdiction` VALUES ('1', '13');
INSERT INTO `app_role_jursdiction` VALUES ('32', '1');
INSERT INTO `app_role_jursdiction` VALUES ('33', '1');
INSERT INTO `app_role_jursdiction` VALUES ('34', '1');
INSERT INTO `app_role_jursdiction` VALUES ('35', '0');
INSERT INTO `app_role_jursdiction` VALUES ('36', '17');
INSERT INTO `app_role_jursdiction` VALUES ('36', '18');
INSERT INTO `app_role_jursdiction` VALUES ('36', '19');
INSERT INTO `app_role_jursdiction` VALUES ('36', '20');
INSERT INTO `app_role_jursdiction` VALUES ('36', '21');
INSERT INTO `app_role_jursdiction` VALUES ('36', '22');
INSERT INTO `app_role_jursdiction` VALUES ('36', '23');
INSERT INTO `app_role_jursdiction` VALUES ('36', '24');

-- ----------------------------
-- Table structure for ding_city
-- ----------------------------
DROP TABLE IF EXISTS `ding_city`;
CREATE TABLE `ding_city` (
  `cid` int(11) NOT NULL AUTO_INCREMENT COMMENT '城市id',
  `cname` varchar(25) DEFAULT NULL COMMENT '城市名称',
  `cpid` int(11) DEFAULT '0' COMMENT '父级  儿子',
  `ctime` datetime DEFAULT NULL COMMENT '添加时间',
  `static` int(11) DEFAULT '1' COMMENT '状态  （1开启0关闭）',
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ding_city
-- ----------------------------
INSERT INTO `ding_city` VALUES ('1', '北京', '0', '2018-06-08 23:42:24', '1');
INSERT INTO `ding_city` VALUES ('2', '海淀', '1', '2018-06-09 00:12:26', '1');
INSERT INTO `ding_city` VALUES ('3', '杭州', '0', '2018-06-08 23:42:24', '1');
INSERT INTO `ding_city` VALUES ('4', '苏州', '3', '2018-06-09 00:12:26', '1');
INSERT INTO `ding_city` VALUES ('5', '上海', '0', '2018-06-08 23:42:24', '1');
INSERT INTO `ding_city` VALUES ('6', '无锡', '5', '2018-06-09 00:12:26', '1');
INSERT INTO `ding_city` VALUES ('8', '中关村', '2', '2018-06-09 14:22:00', '1');

-- ----------------------------
-- Table structure for ding_fang
-- ----------------------------
DROP TABLE IF EXISTS `ding_fang`;
CREATE TABLE `ding_fang` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `fdate` int(11) DEFAULT NULL COMMENT '访问日期',
  `fip` char(30) DEFAULT NULL COMMENT '访问ip',
  `fuv` int(11) DEFAULT NULL COMMENT 'UV访问量',
  `fpv` int(11) DEFAULT NULL COMMENT 'PV流量',
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ding_fang
-- ----------------------------
INSERT INTO `ding_fang` VALUES ('3', '1528502400', '127.0.0.1', null, '4');

-- ----------------------------
-- Table structure for ding_ping
-- ----------------------------
DROP TABLE IF EXISTS `ding_ping`;
CREATE TABLE `ding_ping` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `pname` varchar(20) DEFAULT NULL COMMENT '品牌名称',
  `pimg` varchar(255) DEFAULT NULL COMMENT '品牌图片',
  `sid` int(11) DEFAULT NULL COMMENT '商家id',
  `pxiang` varchar(20) DEFAULT NULL COMMENT '品牌详情',
  `ptime` datetime DEFAULT NULL COMMENT '时间',
  `static` int(11) DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ding_ping
-- ----------------------------
INSERT INTO `ding_ping` VALUES ('2', '鱼香肉丝', 'uploads\\662a709b2c6063bc3b1ff7d6c45142b1.jpg', '1', '111', '2018-06-09 09:47:55', '1');

-- ----------------------------
-- Table structure for ding_shang
-- ----------------------------
DROP TABLE IF EXISTS `ding_shang`;
CREATE TABLE `ding_shang` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `sname` varchar(20) DEFAULT NULL COMMENT '商家名称',
  `cid` int(11) DEFAULT NULL COMMENT '城市id',
  `sphone` varchar(20) DEFAULT NULL COMMENT '商家电话',
  `stime` datetime DEFAULT NULL COMMENT '添加时间',
  `static` int(1) DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ding_shang
-- ----------------------------
INSERT INTO `ding_shang` VALUES ('1', '汉堡店', '1', '18810081067', '2018-06-09 08:04:30', '1');
INSERT INTO `ding_shang` VALUES ('2', '凯文店铺', '2', '13746571415', '2018-06-09 15:29:57', '1');

-- ----------------------------
-- Table structure for ding_yi
-- ----------------------------
DROP TABLE IF EXISTS `ding_yi`;
CREATE TABLE `ding_yi` (
  `yid` int(11) NOT NULL AUTO_INCREMENT,
  `yname` varchar(20) DEFAULT NULL COMMENT '异常管理员',
  `ycontroller` varchar(50) DEFAULT NULL COMMENT '异常操作路由',
  `ytime` datetime DEFAULT NULL COMMENT '操作时间',
  `static` int(11) DEFAULT '1' COMMENT '状态',
  `sum` int(11) DEFAULT NULL COMMENT '次数统计',
  `yxiang` varchar(50) DEFAULT NULL COMMENT '异常操作',
  PRIMARY KEY (`yid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ding_yi
-- ----------------------------
INSERT INTO `ding_yi` VALUES ('1', '小郝', 'shangjiaadd', '2018-06-09 17:54:33', '1', '1', '异常');
INSERT INTO `ding_yi` VALUES ('2', '小郝', 'shangjiaadd', '2018-06-09 17:55:04', '1', '1', '异常');
INSERT INTO `ding_yi` VALUES ('3', '小郝', 'shangjiaadd', '2018-06-09 18:15:35', '1', '1', '异常操作');

-- ----------------------------
-- Table structure for ding_yong
-- ----------------------------
DROP TABLE IF EXISTS `ding_yong`;
CREATE TABLE `ding_yong` (
  `yid` int(11) NOT NULL AUTO_INCREMENT,
  `yuser` varchar(20) DEFAULT NULL COMMENT '用户名称',
  `ypwd` varchar(20) DEFAULT NULL COMMENT '用户密码',
  `yphone` varchar(20) DEFAULT NULL COMMENT '用户手机号',
  `ytime` datetime DEFAULT NULL COMMENT '时间',
  `static` int(11) DEFAULT NULL COMMENT '状态',
  `ytoken` varchar(20) DEFAULT NULL COMMENT '唯一 token',
  PRIMARY KEY (`yid`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ding_yong
-- ----------------------------
INSERT INTO `ding_yong` VALUES ('2', '小郝', '123', '18810081067', '2018-06-09 08:43:00', '1', '65d2caca4e8899465797');
INSERT INTO `ding_yong` VALUES ('4', '小郝', '123', '18810081067', '2018-06-09 08:43:00', '1', '65d2caca4e8899465797');
INSERT INTO `ding_yong` VALUES ('5', '小郝', '123', '18810081067', '2018-06-09 08:43:00', '1', '65d2caca4e8899465797');
INSERT INTO `ding_yong` VALUES ('6', '小郝', '123', '18810081067', '2018-06-09 08:43:00', '1', '65d2caca4e8899465797');
INSERT INTO `ding_yong` VALUES ('7', '小郝', '123', '18810081067', '2018-06-09 08:43:00', '1', '65d2caca4e8899465797');
INSERT INTO `ding_yong` VALUES ('8', '小郝', '123', '18810081067', '2018-06-09 08:43:00', '1', '65d2caca4e8899465797');
INSERT INTO `ding_yong` VALUES ('9', '小郝', '123', '18810081067', '2018-06-09 08:43:00', '1', '65d2caca4e8899465797');
INSERT INTO `ding_yong` VALUES ('10', '小郝', '123', '18810081067', '2018-06-09 08:43:00', '1', '65d2caca4e8899465797');
INSERT INTO `ding_yong` VALUES ('11', '小郝', '123', '18810081067', '2018-06-09 08:43:00', '1', '65d2caca4e8899465797');
INSERT INTO `ding_yong` VALUES ('12', '小郝', '123', '18810081067', '2018-06-09 08:43:00', '1', '65d2caca4e8899465797');
