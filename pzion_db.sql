/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50621
Source Host           : 127.0.0.1:3306
Source Database       : pzion_db

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2019-07-16 10:48:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_box
-- ----------------------------
DROP TABLE IF EXISTS `tbl_box`;
CREATE TABLE `tbl_box` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(64) DEFAULT NULL,
  `title` varchar(32) DEFAULT NULL,
  `box_name` varchar(64) DEFAULT NULL,
  `redirect_url` varchar(255) DEFAULT NULL,
  `msg_customers` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `server_coin_id` int(11) DEFAULT NULL,
  `seller_account` varchar(64) DEFAULT NULL,
  `user_id` int(11) DEFAULT '0',
  `description` varchar(140) DEFAULT NULL,
  `box_image` varchar(255) DEFAULT NULL,
  `reg_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `views_cnt` int(11) NOT NULL DEFAULT '0',
  `is_once_only` int(11) DEFAULT '0',
  `is_show` tinyint(4) DEFAULT '1',
  `__ci_last_regenerate` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_box
-- ----------------------------
INSERT INTO `tbl_box` VALUES ('1', null, null, 'f2f3e314d346157f04a064233c8f4574', null, null, '0.001', '1', '14Q39PYo66Czq6FPqk7zGKzj8xD97oHeor', null, null, null, '2019-05-12 19:56:05', '8', '0', '0', 'n68ovu26j5fgmqscfdod8m05sthsas8a');
INSERT INTO `tbl_box` VALUES ('2', null, null, 'db1ee2548712a9334892b4d21a211df5', null, null, '0.01', '1', 'sadfdsafsadfasdfdsaf', null, null, null, '2019-05-24 18:44:07', '20', '0', '1', 'bcueeba8mdp3vcm5vr52d2m51dn89rg7');
INSERT INTO `tbl_box` VALUES ('5', null, null, '0ac6390351ecb3a53953936ccd2e2624', null, null, '5000', null, 'asdfdsafsadfsadfsadfsadfsadf', '1', null, null, '2019-06-08 16:19:12', '21', '0', '1', 'hjlid3rgk4q0i70s59gpcpu16b67q2pc');
INSERT INTO `tbl_box` VALUES ('4', null, null, '64274d509fd9d248461901c41a2ff138', null, null, '23', '1', null, '1', null, null, '2019-05-29 22:24:49', '2', '0', '0', 'tuntnq1eu7oovr5k20cv6kvld31f4cnq');

-- ----------------------------
-- Table structure for tbl_files
-- ----------------------------
DROP TABLE IF EXISTS `tbl_files`;
CREATE TABLE `tbl_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `box_id` int(11) DEFAULT NULL,
  `original_filename` varchar(250) DEFAULT NULL,
  `converted_filename` varchar(250) DEFAULT NULL,
  `directory_path` varchar(250) DEFAULT NULL,
  `full_path` varchar(250) DEFAULT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `file_size` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `__ci_last_regenerate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_files
-- ----------------------------
INSERT INTO `tbl_files` VALUES ('1', '1', 'bandicam 2018-09-08 00-38-13-836.mp4', 'b0bcce9dbf08a8ccae60d67c35ede0ee.pzion', './uploads/1557661995', 'D:/xampp/htdocs/satoshi/uploads/1557661995/b0bcce9dbf08a8ccae60d67c35ede0ee.pzion', 'video/mp4', '1171.52', '2019-05-12 19:55:56', '2019-05-12 19:56:05', '1557661995');
INSERT INTO `tbl_files` VALUES ('2', '1', 'bandicam 2018-09-08 02-15-04-501.mp4', 'f652e0bfe28fb701617c8a52a94a0129.pzion', './uploads/1557661995', 'D:/xampp/htdocs/satoshi/uploads/1557661995/f652e0bfe28fb701617c8a52a94a0129.pzion', 'video/mp4', '1425.16', '2019-05-12 19:55:56', '2019-05-12 19:56:05', '1557661995');
INSERT INTO `tbl_files` VALUES ('3', '2', 'secondarytile.png', '94d26c450c3c37d5b3d709464bceedf2.pzion', './blobfuse/1558694067', 'F:/SERVER/htdocs/satoshi/blobfuse/1558694067/94d26c450c3c37d5b3d709464bceedf2.pzion', 'image/png', '0.62', '2019-05-24 18:43:56', '2019-05-24 18:44:07', '1558694067');
INSERT INTO `tbl_files` VALUES ('4', '3', 'Winter.jpg', '1a55abfb57c82956c41bec90f90d8121.pzion', './blobfuse/1558694067', 'F:/SERVER/htdocs/satoshi/blobfuse/1558694067/1a55abfb57c82956c41bec90f90d8121.pzion', 'image/jpeg', '103.07', '2019-05-24 20:06:29', '2019-05-24 20:06:31', '1558694067');
INSERT INTO `tbl_files` VALUES ('5', '4', 'MM_PLAY_TIME.ini', '70031d8b41efd66f1c42fd90515313bd.pzion', './blobfuse/1559188318', 'C:/wamp/www/satoshi/blobfuse/1559188318/70031d8b41efd66f1c42fd90515313bd.pzion', 'application/octet-stream', '511.54', '2019-05-29 22:24:44', '2019-05-29 22:24:49', '1559188318');
INSERT INTO `tbl_files` VALUES ('16', '0', 'crack(Win10).zip', 'cf65cac5e537db2cb622a3ceb8009164.pzion', './blobfuse/1559188318', 'C:/wamp/www/satoshi/blobfuse/1559188318/cf65cac5e537db2cb622a3ceb8009164.pzion', 'application/zip', '49824.5', '2019-05-29 23:14:32', '2019-05-29 23:14:32', '1559188318');
INSERT INTO `tbl_files` VALUES ('17', '0', 'Hirens BootCD v15.2.zip', '3f534c8e5d58e136d1e441fdc999cd5a.pzion', './blobfuse/1559188318', 'C:/wamp/www/satoshi/blobfuse/1559188318/3f534c8e5d58e136d1e441fdc999cd5a.pzion', 'application/zip', '974033', '2019-05-29 23:18:44', '2019-05-29 23:18:44', '1559188318');
INSERT INTO `tbl_files` VALUES ('18', '0', 'crack(Win10).zip', '0d17202ed0cea788c383d12162d2eddd.pzion', './blobfuse/1559234598', 'C:/wamp/www/satoshi/blobfuse/1559234598/0d17202ed0cea788c383d12162d2eddd.pzion', 'application/zip', '49824.5', '2019-05-30 12:26:12', '2019-05-30 12:26:12', '1559234598');
INSERT INTO `tbl_files` VALUES ('19', '0', 'xp2009.iso', '2c32b41e08c448336a7538cce346ae25.pzion', './blobfuse/1559234598', 'C:/wamp/www/satoshi/blobfuse/1559234598/2c32b41e08c448336a7538cce346ae25.pzion', 'application/x-iso9660-image', '709470', '2019-05-30 12:29:44', '2019-05-30 12:29:44', '1559234598');
INSERT INTO `tbl_files` VALUES ('20', '5', '5-30-2019_06_37_58_ErrorLog.txt', 'c4dbc12feb24689d7d2ee6f0c2560a1d.pzion', './blobfuse/1559972618', 'C:/xampp/htdocs/satoshi/blobfuse/1559972618/c4dbc12feb24689d7d2ee6f0c2560a1d.pzion', 'text/plain', '10.04', '2019-06-08 14:27:22', '2019-06-08 16:19:12', '1559972618');
INSERT INTO `tbl_files` VALUES ('21', '5', 'configuration.lua', 'bf8535f586fe2f16c8c54e38c664745a.pzion', './blobfuse/1559972618', 'C:/xampp/htdocs/satoshi/blobfuse/1559972618/bf8535f586fe2f16c8c54e38c664745a.pzion', 'text/plain', '2.49', '2019-06-08 14:28:33', '2019-06-08 16:19:12', '1559972618');
INSERT INTO `tbl_files` VALUES ('22', '5', '5-30-2019_17_27_42_MiniDump.dmp', '3eefdb8bf74ca3a5bd283e3ad7e11f8f.pzion', './blobfuse/1559972618', 'C:/xampp/htdocs/satoshi/blobfuse/1559972618/3eefdb8bf74ca3a5bd283e3ad7e11f8f.pzion', 'application/x-dmp', '58.85', '2019-06-08 14:29:39', '2019-06-08 16:19:12', '1559972618');
INSERT INTO `tbl_files` VALUES ('23', '5', '5-30-2019_17_27_42_MiniDump.dmp', 'b2cbeb4f0c6b73a7edf9a4c87b95fc90.pzion', './blobfuse/1559972618', 'C:/xampp/htdocs/satoshi/blobfuse/1559972618/b2cbeb4f0c6b73a7edf9a4c87b95fc90.pzion', 'application/x-dmp', '58.85', '2019-06-08 14:31:13', '2019-06-08 16:19:12', '1559972618');
INSERT INTO `tbl_files` VALUES ('24', '5', '1.pdf', '1a54a74a80436dafa764c5375dc98a0a.pzion', './blobfuse/1559972618', 'C:/xampp/htdocs/satoshi/blobfuse/1559972618/1a54a74a80436dafa764c5375dc98a0a.pzion', 'application/pdf', '93.62', '2019-06-08 14:37:30', '2019-06-08 16:19:12', '1559972618');
INSERT INTO `tbl_files` VALUES ('25', '5', 'aaaaa.docx', '8bf5c4ccb93ef99f956443025a814111.pzion', './blobfuse/1559972618', 'C:/xampp/htdocs/satoshi/blobfuse/1559972618/8bf5c4ccb93ef99f956443025a814111.pzion', 'application/vnd.openxmlformats-officedocument.word', '53.29', '2019-06-08 14:37:39', '2019-06-08 16:19:12', '1559972618');
INSERT INTO `tbl_files` VALUES ('26', '5', '1.pdf', '266da259ea4d0d64ede9db703bbbc1eb.pzion', './blobfuse/1559972618', 'C:/xampp/htdocs/satoshi/blobfuse/1559972618/266da259ea4d0d64ede9db703bbbc1eb.pzion', 'application/pdf', '93.62', '2019-06-08 14:38:10', '2019-06-08 16:19:12', '1559972618');

-- ----------------------------
-- Table structure for tbl_inout
-- ----------------------------
DROP TABLE IF EXISTS `tbl_inout`;
CREATE TABLE `tbl_inout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `action_type` enum('IN','OUT') NOT NULL DEFAULT 'OUT',
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `server_coin_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `coin_address` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_inout
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_rating
-- ----------------------------
DROP TABLE IF EXISTS `tbl_rating`;
CREATE TABLE `tbl_rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `box_id` int(11) DEFAULT NULL,
  `rating` decimal(11,1) DEFAULT NULL,
  `comment` varchar(140) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_rating
-- ----------------------------
INSERT INTO `tbl_rating` VALUES ('1', '2', '1.0', 'test', '2019-05-24 21:46:13');
INSERT INTO `tbl_rating` VALUES ('2', '2', '2.0', 'test', '2019-05-24 21:46:14');
INSERT INTO `tbl_rating` VALUES ('3', '3', '3.0', 'sss', '2019-05-24 21:46:14');
INSERT INTO `tbl_rating` VALUES ('4', '3', '4.0', 'ppp', '2019-05-24 21:46:15');
INSERT INTO `tbl_rating` VALUES ('5', '3', '5.0', 'ccc', '2019-05-24 21:46:16');
INSERT INTO `tbl_rating` VALUES ('6', '3', '2.0', 'xxxx', '2019-05-24 21:46:17');
INSERT INTO `tbl_rating` VALUES ('7', '3', '3.0', 'fdsafdsa', '2019-05-24 21:46:18');
INSERT INTO `tbl_rating` VALUES ('8', '3', '3.0', 'ssss', '2019-05-24 22:30:39');
INSERT INTO `tbl_rating` VALUES ('9', '3', '3.0', 'ssssssssssssssssssssssssssssssssss', '2019-05-24 22:31:22');
INSERT INTO `tbl_rating` VALUES ('10', '3', '2.0', 'ttttttttttttttttttttttttttttttttttttttttttt', '2019-05-24 22:31:45');
INSERT INTO `tbl_rating` VALUES ('11', '3', '1.0', 'dddddddddddddddddddddddddd', '2019-05-24 22:32:06');
INSERT INTO `tbl_rating` VALUES ('12', '3', '5.0', 'sssssssssssssssssssssssssssfdsafsdafdsaf', '2019-05-24 22:33:06');
INSERT INTO `tbl_rating` VALUES ('13', '3', '2.0', 'sssssssssssssssssss', '2019-05-24 22:33:16');

-- ----------------------------
-- Table structure for tbl_servercoin
-- ----------------------------
DROP TABLE IF EXISTS `tbl_servercoin`;
CREATE TABLE `tbl_servercoin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coin_type` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `coin_address` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `fee` float DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_servercoin
-- ----------------------------
INSERT INTO `tbl_servercoin` VALUES ('1', 'BTC', 'btc@fasdfsadbtcbtcbtcbtcsfdsafsadfsadfasdfsadf87j8978j9', '0.01');

-- ----------------------------
-- Table structure for tbl_settings
-- ----------------------------
DROP TABLE IF EXISTS `tbl_settings`;
CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(250) NOT NULL,
  `val` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_settings
-- ----------------------------
INSERT INTO `tbl_settings` VALUES ('2', 'max_upload_size', '50');
INSERT INTO `tbl_settings` VALUES ('3', 'owner_btc_address', '16GAP2qniD6sW8KGhGpDKqaexq81TXGiti');
INSERT INTO `tbl_settings` VALUES ('4', 'owner_btc_fee', '10');

-- ----------------------------
-- Table structure for tbl_trade
-- ----------------------------
DROP TABLE IF EXISTS `tbl_trade`;
CREATE TABLE `tbl_trade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `from_account` varchar(64) DEFAULT NULL,
  `from_user_id` int(11) DEFAULT NULL,
  `to_account` varchar(64) DEFAULT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `server_coin_id` int(10) DEFAULT '1',
  `amount` decimal(11,8) DEFAULT NULL,
  `box_id` int(11) DEFAULT NULL,
  `is_purchased` tinyint(4) NOT NULL DEFAULT '0',
  `download_key` varchar(32) DEFAULT NULL,
  `private` varchar(100) DEFAULT NULL,
  `public` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `wif` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_trade
-- ----------------------------
INSERT INTO `tbl_trade` VALUES ('1', '2019-05-12 19:56:34', null, null, '14Q39PYo66Czq6FPqk7zGKzj8xD97oHeor', null, '1', '0.00100000', '1', '1', '7e83i33cnob2v2imghtgtdqtagioq4fh', 'b9ee432d31bb94dcae062710d3b7cdf0fd0d6126d07f9c0e3e5b06b1317b79ad', '0215a46d6327bc8a89487ff72c821e991d3a2b1f336fbef231caf44acc4d04faf6', '1MbsnY5mXraLunNpbzoHjHcwPKeT5EPBVG', 'L3T8qPSWVwJEqqZZSFc57BwYfkxCs8k5dVKsHBtGjLErUCu29GPb');
INSERT INTO `tbl_trade` VALUES ('2', '2019-05-24 18:42:24', null, null, '14Q39PYo66Czq6FPqk7zGKzj8xD97oHeor', null, '1', '0.00100000', '1', '1', 'bcueeba8mdp3vcm5vr52d2m51dn89rg7', null, null, null, null);
INSERT INTO `tbl_trade` VALUES ('3', '2019-05-24 18:44:24', null, null, 'sadfdsafsadfasdfdsaf', null, '1', '0.01000000', '2', '1', 'bcueeba8mdp3vcm5vr52d2m51dn89rg7', null, null, null, null);
INSERT INTO `tbl_trade` VALUES ('4', '2019-05-24 18:46:38', null, null, 'sadfdsafsadfasdfdsaf', null, '1', '0.01000000', '2', '1', 'qqsi71i2qloh7os19uo2p363mt06jfdf', null, null, null, null);
INSERT INTO `tbl_trade` VALUES ('5', '2019-05-24 19:57:39', null, '1', 'sadfdsafsadfasdfdsaf', null, '1', '0.01000000', '2', '1', 'nfh41s9i4htl4gl2kckss1bgc4b5m1j1', null, null, null, null);
INSERT INTO `tbl_trade` VALUES ('6', '2019-05-24 20:08:26', null, '1', null, '1', '1', '0.01000000', '3', '1', '90k5muirknsvnp2b3s2vpngjg58o11ot', null, null, null, null);
INSERT INTO `tbl_trade` VALUES ('7', '2019-05-29 22:25:10', null, '1', null, '1', '1', '23.00000000', '4', '0', 'tuntnq1eu7oovr5k20cv6kvld31f4cnq', null, null, null, null);
INSERT INTO `tbl_trade` VALUES ('8', '2019-05-29 23:23:53', null, null, 'sadfdsafsadfasdfdsaf', null, '1', '0.01000000', '2', '0', '845sidmapetc0cbqavgl7ittlp88ttqo', null, null, null, null);
INSERT INTO `tbl_trade` VALUES ('9', '2019-06-08 16:20:18', null, null, 'asdfdsafsadfsadfsadfsadfsadf', '1', '1', '999.99999999', '5', '0', 'hjlid3rgk4q0i70s59gpcpu16b67q2pc', null, null, null, null);
INSERT INTO `tbl_trade` VALUES ('10', '2019-06-08 16:25:37', null, null, 'asdfdsafsadfsadfsadfsadfsadf', '1', '1', '999.99999999', '5', '0', '1i5e5tqrovotg4ipsektp5url8vrtj2a', null, null, null, null);
INSERT INTO `tbl_trade` VALUES ('11', '2019-06-08 16:42:50', null, null, 'asdfdsafsadfsadfsadfsadfsadf', '1', '1', '999.99999999', '5', '0', 'hfcf3fohr3ft12k5uiomtic68ek2feek', null, null, null, null);
INSERT INTO `tbl_trade` VALUES ('12', '2019-06-08 16:50:41', null, null, 'asdfdsafsadfsadfsadfsadfsadf', '1', '1', '999.99999999', '5', '0', '6fte8e7i08eqmmv0barlhlgkvr5k6smj', 'aaaaaaaaaaaaaaa', 'cccccccccccc', 'ababababababab', null);
INSERT INTO `tbl_trade` VALUES ('13', '2019-06-08 16:57:32', null, null, 'asdfdsafsadfsadfsadfsadfsadf', '1', '1', '999.99999999', '5', '1', 'eo76qt46dad78un0ipa58ki5leel5p9p', 'aaaaaaaaaaaaaaa', 'cccccccccccc', 'ababababababab', null);

-- ----------------------------
-- Table structure for tbl_trade_new
-- ----------------------------
DROP TABLE IF EXISTS `tbl_trade_new`;
CREATE TABLE `tbl_trade_new` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seller_account` varchar(64) DEFAULT NULL,
  `seller_user_id` int(11) DEFAULT NULL,
  `server_coin_id` int(10) DEFAULT '1',
  `amount` decimal(11,5) DEFAULT NULL,
  `box_id` int(11) DEFAULT NULL,
  `is_withdrawal` tinyint(4) DEFAULT '0',
  `download_key` varchar(32) DEFAULT NULL,
  `private` varchar(100) DEFAULT NULL,
  `public` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `wif` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_trade_new
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `PID` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `email_verified` enum('2','1','0') DEFAULT '0' COMMENT '0:not verified,1:verified',
  `verify_code` varchar(16) DEFAULT NULL,
  `payment_notice` tinyint(4) DEFAULT '1' COMMENT '1: send, 0: don''t send',
  `balance` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`PID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES ('1', 'psc', 'f5bb0c8de146c67b44babbf4e6584cc0', 'psc@psc.com', '1', 'LIGePjY2mvf1MqXh', '1', '4500.01');
INSERT INTO `tbl_user` VALUES ('4', 'kkkk', 'f5bb0c8de146c67b44babbf4e6584cc0', 'kkk@kkk.com', '0', '9VPsMA8Fm6RohNEX', '1', '0');
INSERT INTO `tbl_user` VALUES ('3', 'kstar', 'f5bb0c8de146c67b44babbf4e6584cc0', 'kstar@kstar.com', '1', null, '1', '0');
INSERT INTO `tbl_user` VALUES ('5', 'asfdasf', 'f5bb0c8de146c67b44babbf4e6584cc0', 'asdfasfd@asfasdf.com', '0', '3OPf2jBbkE6SRQFW', '1', '0');
INSERT INTO `tbl_user` VALUES ('6', 'dfaf', 'f5bb0c8de146c67b44babbf4e6584cc0', 'asdfasdf@asdfasfd.com', '0', '3ECwoezBmQU8q14Y', '1', '0');
INSERT INTO `tbl_user` VALUES ('7', '123123123', 'f5bb0c8de146c67b44babbf4e6584cc0', 'sfdasfd@asfsafd.com', '0', 'GbzFYvsVm9cEinuh', '1', '0');
INSERT INTO `tbl_user` VALUES ('8', 'wrwer', 'f5bb0c8de146c67b44babbf4e6584cc0', '898798@fdafasdf.com', '0', 'ScZklMGTUwa0D3zo', '1', '0');
