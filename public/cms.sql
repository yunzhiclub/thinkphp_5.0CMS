/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50626
Source Host           : localhost:3306
Source Database       : cms

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2016-08-21 20:54:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `cms_stysemset`
-- ----------------------------
DROP TABLE IF EXISTS `cms_stysemset`;
CREATE TABLE `cms_stysemset` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '系统设置id',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '公司名称',
  `is_show` tinyint(1) unsigned NOT NULL COMMENT '公司名称是否显示（1是0否）',
  `footer_name` varchar(20) NOT NULL DEFAULT '' COMMENT '页脚名称',
  `is_display` tinyint(1) unsigned NOT NULL COMMENT '页脚名称是否显示（1是0否）',
  `logo_url` varchar(200) NOT NULL COMMENT '公司logo地址url',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_stysemset
-- ----------------------------
INSERT INTO `cms_stysemset` VALUES ('1', 'dsd', '0', 'hehee', '0', 'adsad');

-- ----------------------------
-- Table structure for `cms_usermanage`
-- ----------------------------
DROP TABLE IF EXISTS `cms_usermanage`;
CREATE TABLE `cms_usermanage` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '姓名',
  `email` varchar(20) NOT NULL COMMENT '邮箱',
  `password` varchar(20) NOT NULL COMMENT '密码',
  `status` varchar(20) NOT NULL COMMENT '状态（0非正常1正常）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_usermanage
-- ----------------------------
INSERT INTO `cms_usermanage` VALUES ('1', 'xixi', 'xixi', '', '', '');
INSERT INTO `cms_usermanage` VALUES ('2', 'dasf', 'fsf', '', '', '');
