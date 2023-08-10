-- MySQL dump 10.13  Distrib 5.7.40, for Linux (x86_64)
--
-- Host: localhost    Database: ttt
-- ------------------------------------------------------
-- Server version	5.7.40-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `sjb_list`
--

DROP TABLE IF EXISTS `sjb_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sjb_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `qudao` int(11) NOT NULL DEFAULT '1',
  `del` int(11) NOT NULL,
  `sid` int(11) NOT NULL COMMENT '赛事ID',
  `gid` int(11) NOT NULL COMMENT '游戏ID',
  `title` varchar(64) NOT NULL COMMENT '赛事标题',
  `a` varchar(64) NOT NULL COMMENT 'A队伍',
  `b` varchar(64) NOT NULL COMMENT 'B队伍',
  `aid` int(11) NOT NULL COMMENT 'a队伍id',
  `bid` int(11) NOT NULL COMMENT 'b队id',
  `aurl` varchar(256) NOT NULL COMMENT 'A队国标',
  `burl` varchar(256) NOT NULL COMMENT 'B队国标',
  `tvurl` varchar(256) NOT NULL COMMENT '动画直播地址',
  `time` int(11) NOT NULL COMMENT '开赛时间',
  `date` timestamp NOT NULL,
  `go` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sid` (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sjb_list`
--

LOCK TABLES `sjb_list` WRITE;
/*!40000 ALTER TABLE `sjb_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `sjb_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sjb_logmoney`
--

DROP TABLE IF EXISTS `sjb_logmoney`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sjb_logmoney` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub` varchar(16) NOT NULL,
  `del` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `uname` varchar(16) NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `yue` decimal(10,2) NOT NULL,
  `type` int(11) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sjb_logmoney`
--

LOCK TABLES `sjb_logmoney` WRITE;
/*!40000 ALTER TABLE `sjb_logmoney` DISABLE KEYS */;
INSERT INTO `sjb_logmoney` VALUES (1,'',1,'kspade','马云',1000.00,1000.00,1,'开户',1650000000),(2,'',1,'kspade','马云',-100.00,990.00,2,'开户',1650000000),(3,'',1,'kspade2','王健林',100.00,100.00,1,'新开户',1669883822),(4,'',1,'kspade','马云',795.00,72517.00,4,'【中奖】突尼斯 vs. 法国■(让球)突尼斯■500.00*1.59',1669884343),(5,'',1,'kspade','马云',795.00,71722.00,0,'【取消中奖】突尼斯 vs. 法国■[让球·突尼斯+1]■500.00 @1.59',1669884422),(6,'',1,'kspade','马云',795.00,72517.00,4,'【中奖】突尼斯 vs. 法国■[让球·突尼斯+1]■500.00 @1.59',1669884577),(7,'',1,'kspade','马云',-795.00,72017.00,0,'【取消中奖】突尼斯 vs. 法国■[让球·突尼斯+1]■500.00 @1.59',1669884590),(8,'',1,'kspade','马云',795.00,72517.00,4,'【中奖】突尼斯 vs. 法国■[让球·突尼斯+1]■500.00 @1.59',1669884634),(9,'',1,'kspade','马云',-795.00,73312.00,0,'【取消中奖】突尼斯 vs. 法国■[让球·突尼斯+1]■500.00 @1.59',1669884640),(10,'',1,'kspade','马云',795.00,80795.00,4,'【中奖】突尼斯 vs. 法国■[让球·突尼斯+1]■500.00 @1.59',1669884717),(11,'',1,'kspade','马云',-795.00,81590.00,0,'【取消中奖】突尼斯 vs. 法国■[让球·突尼斯+1]■500.00 @1.59',1669884726),(12,'',1,'kspade','马云',795.00,80795.00,4,'【中奖】突尼斯 vs. 法国■[让球·突尼斯+1]■500.00 @1.59',1669884781),(13,'',1,'kspade','马云',-795.00,80795.00,0,'【取消中奖】突尼斯 vs. 法国■[让球·突尼斯+1]■500.00 @1.59',1669884782),(14,'',1,'kspade','马云',795.00,80795.00,4,'【中奖】突尼斯 vs. 法国■[让球·突尼斯+1]■500.00 @1.59',1669884812),(15,'',1,'kspade','马云',-795.00,81590.00,0,'【取消中奖】突尼斯 vs. 法国■[让球·突尼斯+1]■500.00 @1.59',1669884813),(16,'',1,'kspade','马云',795.00,80795.00,4,'【中奖】突尼斯 vs. 法国■[让球·突尼斯+1]■500.00 @1.59',1669884847),(17,'',1,'kspade','马云',-795.00,80000.00,0,'【取消中奖】突尼斯 vs. 法国■[让球·突尼斯+1]■500.00 @1.59',1669884848),(18,'',1,'kspade','马云',795.00,80795.00,4,'【中奖】突尼斯 vs. 法国■[让球·突尼斯+1]■500.00 @1.59',1669884879),(19,'',1,'kspade','马云',-795.00,80000.00,0,'【取消中奖】突尼斯 vs. 法国■[让球·突尼斯+1]■500.00 @1.59',1669884916),(20,'',1,'kspade','马云',795.00,80795.00,4,'【中奖】突尼斯 vs. 法国■[让球·突尼斯+1]■500.00 @1.59',1669884983);
/*!40000 ALTER TABLE `sjb_logmoney` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sjb_mg`
--

DROP TABLE IF EXISTS `sjb_mg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sjb_mg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1',
  `sid` int(11) NOT NULL,
  `mty` int(11) NOT NULL,
  `nm` varchar(32) NOT NULL,
  `pe` int(11) NOT NULL,
  `mc` tinyint(1) NOT NULL,
  `off` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sid` (`sid`),
  KEY `mty` (`mty`),
  KEY `nm` (`nm`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sjb_mg`
--

LOCK TABLES `sjb_mg` WRITE;
/*!40000 ALTER TABLE `sjb_mg` DISABLE KEYS */;
INSERT INTO `sjb_mg` VALUES (1,1,2,6522269,1127,'开球球队',1001,0,0),(2,1,2,6522269,1000,'让球',1001,0,0),(3,1,2,6522269,1000,'让球-上半场',1002,0,0),(4,1,2,6522269,1007,'大/小',1001,0,0),(5,1,2,6522269,1007,'大/小-上半场',1002,0,0),(6,1,2,6522269,1005,'独赢',1001,0,0),(7,1,2,6522269,1005,'独赢-上半场',1002,0,0),(8,1,2,6522269,1099,'波胆',1001,0,0),(9,1,2,6522269,1100,'波胆-上半场',1002,0,0),(10,1,2,6525421,1127,'开球球队',1001,0,0),(11,1,2,6525421,1000,'让球',1001,0,0),(12,1,2,6525421,1000,'让球-上半场',1002,0,0),(13,1,2,6525421,1007,'大/小',1001,0,0),(14,1,2,6525421,1007,'大/小-上半场',1002,0,0),(15,1,2,6525421,1005,'独赢',1001,0,0),(16,1,2,6525421,1005,'独赢-上半场',1002,0,0),(17,1,2,6525421,1099,'波胆',1001,0,0),(18,1,2,6525421,1100,'波胆-上半场',1002,0,0),(19,1,2,6522285,1127,'开球球队',1001,0,0),(20,1,2,6522285,1000,'让球',1001,0,0);
/*!40000 ALTER TABLE `sjb_mg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sjb_mks`
--

DROP TABLE IF EXISTS `sjb_mks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sjb_mks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `gidm` int(11) NOT NULL,
  `mty` int(11) NOT NULL,
  `nm` varchar(32) NOT NULL,
  `mgid` int(12) NOT NULL,
  `au` int(11) NOT NULL,
  `mksid` bigint(11) NOT NULL,
  `li` varchar(16) NOT NULL,
  `mbl` int(11) NOT NULL,
  `ss` int(11) NOT NULL,
  `pe` int(11) NOT NULL,
  `op` json NOT NULL,
  `gnum_h` int(11) NOT NULL,
  `gnum_c` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mgid` (`mgid`),
  KEY `mksid` (`mksid`),
  KEY `sid` (`sid`),
  KEY `nm` (`nm`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sjb_mks`
--

LOCK TABLES `sjb_mks` WRITE;
/*!40000 ALTER TABLE `sjb_mks` DISABLE KEYS */;
INSERT INTO `sjb_mks` VALUES (1,1,2,6531975,4075356,4630889,1000,'让球',0,0,0,'',0,0,0,'null',62070,62069),(2,1,2,6531975,4075356,4630889,1000,'让球-上半场',0,0,0,'0',0,0,0,'null',62070,62069),(3,1,2,6531975,4075356,4630889,1007,'大/小',0,0,0,'2 / 2.5',0,0,0,'null',62070,62069),(4,1,2,6531975,4075356,4630889,1007,'大/大小-上半场',0,0,0,'0.5 / 1',0,0,0,'null',62070,62069),(5,1,2,6531975,4075356,4630889,1005,'独赢',0,0,0,'',0,0,0,'null',62070,62069),(6,1,2,6531975,4075356,4630889,1005,'独赢-上半场',0,0,0,'',0,0,0,'null',62070,62069),(7,1,2,6531975,4075358,4630889,1000,'让球',0,0,0,'',0,0,0,'null',62072,62071),(8,1,2,6531975,4075358,4630889,1000,'让球-上半场',0,0,0,'0 / 0.5',0,0,0,'null',62072,62071),(9,1,2,6531975,4075358,4630889,1007,'大/小',0,0,0,'2.5',0,0,0,'null',62072,62071),(10,1,2,6531975,4075358,4630889,1007,'大/大小-上半场',0,0,0,'0.5',0,0,0,'null',62072,62071),(11,1,2,6531975,4075360,4630889,1000,'让球',0,0,0,'',0,0,0,'null',62074,62073),(12,1,2,6531975,4075360,4630889,1007,'大/小',0,0,0,'2',0,0,0,'null',62074,62073),(13,1,2,6531975,4075362,4630889,1000,'让球',0,0,0,'',0,0,0,'null',62076,62075),(14,1,2,6531975,4075362,4630889,1007,'大/小',0,0,0,'1.5 / 2',0,0,0,'null',62076,62075),(15,1,2,6531975,4075356,4630889,1099,'波胆',0,0,0,'',0,0,0,'null',62070,62069),(16,1,2,6531975,4075356,4630889,1100,'波胆-上半场',0,0,0,'',0,0,0,'null',62070,62069),(17,1,2,6531975,4075356,4630889,1007,'大/小-上半场',0,0,0,'0.5 / 1',0,0,0,'null',62070,62069),(18,1,2,6531975,4075358,4630889,1007,'大/小-上半场',0,0,0,'0.5',0,0,0,'null',62072,62071),(19,1,2,6531975,4075356,4630889,1000,'让球',0,0,0,'',0,0,0,'null',62070,62069),(20,1,2,6531975,4075356,4630889,1000,'让球-上半场',0,0,0,'0',0,0,0,'null',62070,62069);
/*!40000 ALTER TABLE `sjb_mks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sjb_op`
--

DROP TABLE IF EXISTS `sjb_op`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sjb_op` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `sid` int(11) NOT NULL COMMENT '赛事id',
  `gid` int(11) NOT NULL,
  `gidm` int(11) NOT NULL,
  `gnum_h` int(11) NOT NULL,
  `gnum_c` int(11) NOT NULL,
  `mksid` bigint(12) NOT NULL COMMENT '玩法ID',
  `mty` int(11) NOT NULL COMMENT '玩法',
  `pe` int(11) NOT NULL,
  `nm` varchar(16) NOT NULL COMMENT '玩法B',
  `na` varchar(16) NOT NULL COMMENT '玩法A',
  `li` varchar(16) NOT NULL,
  `GOD` decimal(10,2) NOT NULL COMMENT '官方赔率',
  `od` decimal(10,2) NOT NULL COMMENT '赔率',
  `ty` int(11) NOT NULL COMMENT '标识',
  `f` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '赔率浮动',
  `lok` int(11) NOT NULL COMMENT '999锁盘',
  PRIMARY KEY (`id`),
  KEY `sid` (`sid`),
  KEY `gid` (`gid`),
  KEY `na` (`na`),
  KEY `nm` (`nm`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sjb_op`
--

LOCK TABLES `sjb_op` WRITE;
/*!40000 ALTER TABLE `sjb_op` DISABLE KEYS */;
INSERT INTO `sjb_op` VALUES (1,1,2,6531975,4075356,4630889,62070,62069,1,1000,0,'让球','英格兰','0 / 0.5',1.87,1.87,0,0.00,0),(2,1,2,6531975,4075356,4630889,62070,62069,1,1000,0,'让球','法国','0 / 0.5',2.01,2.01,0,0.00,0),(3,1,2,6531975,4075356,4630889,62070,62069,2,1000,0,'让球-上半场','英格兰','0',2.17,2.17,0,0.00,0),(4,1,2,6531975,4075356,4630889,62070,62069,2,1000,0,'让球-上半场','法国','0',1.73,1.73,0,0.00,0),(5,1,2,6531975,4075356,4630889,62070,62069,3,1007,0,'大/小','大','2 / 2.5',1.98,1.98,0,0.00,0),(6,1,2,6531975,4075356,4630889,62070,62069,3,1007,0,'大/小','小','2 / 2.5',1.88,1.88,0,0.00,0),(7,1,2,6531975,4075356,4630889,62070,62069,4,1007,0,'大/大小-上半场','大','0.5 / 1',1.79,1.79,0,0.00,0),(8,1,2,6531975,4075356,4630889,62070,62069,4,1007,0,'大/大小-上半场','小','0.5 / 1',2.07,2.07,0,0.00,0),(9,1,2,6531975,4075356,4630889,62070,62069,5,1005,0,'独赢','英格兰','',3.05,3.05,0,0.00,0),(10,1,2,6531975,4075356,4630889,62070,62069,5,1005,0,'独赢','法国','',2.28,2.28,0,0.00,0),(11,1,2,6531975,4075356,4630889,62070,62069,5,1005,0,'独赢','和','',3.20,3.20,0,0.00,0),(12,1,2,6531975,4075356,4630889,62070,62069,6,1005,0,'独赢-上半场','英格兰','',3.95,3.95,0,0.00,0),(13,1,2,6531975,4075356,4630889,62070,62069,6,1005,0,'独赢-上半场','法国','',3.15,3.15,0,0.00,0),(14,1,2,6531975,4075356,4630889,62070,62069,6,1005,0,'独赢-上半场','和','',1.89,1.89,0,0.00,0),(15,1,2,6531975,4075358,4630889,62072,62071,7,1000,0,'让球','英格兰','0',2.25,2.25,0,0.00,0),(16,1,2,6531975,4075358,4630889,62072,62071,7,1000,0,'让球','法国','0',1.68,1.68,0,0.00,0),(17,1,2,6531975,4075358,4630889,62072,62071,8,1000,0,'让球-上半场','英格兰','0 / 0.5',1.56,1.56,0,0.00,0),(18,1,2,6531975,4075358,4630889,62072,62071,8,1000,0,'让球-上半场','法国','0 / 0.5',2.47,2.47,0,0.00,0),(19,1,2,6531975,4075358,4630889,62072,62071,9,1007,0,'大/小','大','2.5',2.20,2.20,0,0.00,0),(20,1,2,6531975,4075358,4630889,62072,62071,9,1007,0,'大/小','小','2.5',1.69,1.69,0,0.00,0);
/*!40000 ALTER TABLE `sjb_op` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sjb_pay`
--

DROP TABLE IF EXISTS `sjb_pay`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sjb_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub` varchar(16) NOT NULL,
  `del` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `ok` int(11) NOT NULL COMMENT '确认订单?',
  `sid` int(11) NOT NULL COMMENT '赛事id',
  `opid` int(11) NOT NULL,
  `titlea` varchar(64) NOT NULL COMMENT '赛事',
  `userid` int(11) NOT NULL COMMENT '用户id',
  `username` varchar(16) NOT NULL,
  `uname` varchar(16) NOT NULL,
  `money` decimal(10,2) NOT NULL COMMENT '下注金额',
  `od` decimal(10,2) NOT NULL COMMENT '赔率',
  `z` int(11) NOT NULL COMMENT '是否中奖',
  `z2` int(11) NOT NULL,
  `okmoney` decimal(10,2) NOT NULL COMMENT '赢m',
  `p` int(11) NOT NULL COMMENT '是否派奖',
  `oktime` int(11) NOT NULL COMMENT '派奖时间',
  `mksid` int(11) NOT NULL COMMENT '下注游戏ID',
  `mty` int(11) NOT NULL COMMENT '下注类型ID',
  `titleb` varchar(16) NOT NULL COMMENT '下注类型',
  `nm` varchar(16) NOT NULL,
  `na` varchar(16) NOT NULL,
  `pe` int(11) NOT NULL,
  `li` varchar(10) NOT NULL,
  `time` int(11) NOT NULL COMMENT '下注时间',
  PRIMARY KEY (`id`),
  KEY `sid` (`sid`),
  KEY `userid` (`userid`),
  KEY `username` (`username`),
  KEY `z` (`z`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sjb_pay`
--

LOCK TABLES `sjb_pay` WRITE;
/*!40000 ALTER TABLE `sjb_pay` DISABLE KEYS */;
INSERT INTO `sjb_pay` VALUES (1,'',1,1,0,929753,12,'加纳 vs. 乌拉圭',4,'test001','王健林',100.00,2.23,0,0,0.00,0,0,39006836,1000,'让球','0','加纳',0,'0',1670000094),(2,'',1,1,0,930249,62,'塞尔维亚 vs. 瑞士',4,'test001','王健林',1200.00,1.50,0,0,0.00,0,0,37240901,1000,'让球-上半场','+0/0.5','塞尔维亚',0,'+0/0.5',1670000122),(3,'',1,1,0,930249,46,'塞尔维亚 vs. 瑞士',4,'test001','王健林',300.00,1.85,0,0,0.00,0,0,36047525,1127,'开球球队','主','塞尔维亚',0,'',1670000122),(4,'',1,1,0,930250,122,'喀麦隆 vs. 巴西',4,'test001','王健林',980.00,1.85,0,0,0.00,0,0,36046833,1127,'开球球队','主','喀麦隆',0,'',1670000149),(5,'',1,1,0,930249,46,'塞尔维亚 vs. 瑞士',4,'test001','王健林',300.00,1.85,0,0,0.00,0,0,36047525,1127,'开球球队','主','塞尔维亚',0,'',1670000220),(6,'',1,1,0,930249,46,'塞尔维亚 vs. 瑞士',4,'test001','王健林',1000.00,1.85,0,0,0.00,0,0,36047525,1127,'开球球队','主','塞尔维亚',0,'',1670000674),(7,'',1,1,0,930249,46,'塞尔维亚 vs. 瑞士',5,'test002','刘德华',1000.00,1.89,0,0,0.00,0,0,36047525,1127,'开球球队','主','塞尔维亚',0,'',1670001610),(8,'',1,1,0,930249,80,'塞尔维亚 vs. 瑞士',5,'test002','刘德华',1000.00,2.41,0,0,0.00,0,0,36047413,1005,'独赢','主','塞尔维亚',0,'',1670001631),(9,'',1,1,0,930249,52,'塞尔维亚 vs. 瑞士',5,'test002','刘德华',1000.00,1.63,0,0,0.00,0,0,37240896,1000,'让球','+0/0.5','塞尔维亚',0,'+0/0.5',1670001765),(10,'',1,1,0,930249,83,'塞尔维亚 vs. 瑞士',5,'test002','刘德华',1000.00,3.15,0,0,0.00,0,0,36047414,1005,'独赢-上半场','主','塞尔维亚',0,'',1670001798),(11,'',1,1,0,930249,67,'塞尔维亚 vs. 瑞士',5,'test002','刘德华',1000.00,1.67,0,0,0.00,0,0,37240895,1007,'大/小','小 2.5/3','小',0,'2.5/3',1670001839),(12,'',1,1,0,930250,122,'喀麦隆 vs. 巴西',5,'test002','刘德华',1000.00,1.84,0,0,0.00,0,0,36046833,1127,'开球球队','主','喀麦隆',0,'',1670001965),(13,'',1,1,0,930250,130,'喀麦隆 vs. 巴西',5,'test002','刘德华',1000.00,1.59,1,0,1590.00,1,0,37070819,1000,'让球','+1.5/2','喀麦隆',0,'+1.5/2',1670018557),(14,'',1,1,0,930250,128,'喀麦隆 vs. 巴西',5,'test002','刘德华',1000.00,2.37,1,0,2370.00,1,0,38877498,1000,'让球','+1','喀麦隆',0,'+1',1670018555),(15,'',1,1,0,930250,126,'喀麦隆 vs. 巴西',5,'test002','刘德华',1000.00,1.79,1,0,1790.00,1,0,37070817,1000,'让球','+1.5','喀麦隆',0,'+1.5',1670018552),(16,'',1,1,0,930250,156,'喀麦隆 vs. 巴西',5,'test002','刘德华',1000.00,6.79,1,0,6790.00,1,0,36046721,1005,'独赢','主','喀麦隆',0,'',1670018550),(17,'',1,1,0,930249,80,'塞尔维亚 vs. 瑞士',6,'test003','郭富城',1000.00,2.42,0,0,0.00,0,0,36047413,1005,'独赢','主','塞尔维亚',0,'',1670002213),(18,'',1,1,0,930249,52,'塞尔维亚 vs. 瑞士',6,'test003','郭富城',1000.00,1.64,0,0,0.00,0,0,37240896,1000,'让球','+0/0.5','塞尔维亚',0,'+0/0.5',1670002213),(19,'',1,1,0,930249,46,'塞尔维亚 vs. 瑞士',6,'test003','郭富城',1000.00,1.85,0,0,0.00,0,0,36047525,1127,'开球球队','主','塞尔维亚',0,'',1670002213),(20,'',1,1,0,930249,87,'塞尔维亚 vs. 瑞士',6,'test003','郭富城',1000.00,13.25,0,0,0.00,0,0,36047499,1099,'波胆','2-0','2-0',0,'',1670002237);
/*!40000 ALTER TABLE `sjb_pay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sjb_set`
--

DROP TABLE IF EXISTS `sjb_set`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sjb_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `odset` int(11) NOT NULL DEFAULT '1',
  `smoney` decimal(10,2) NOT NULL,
  `sod` decimal(10,2) NOT NULL,
  `c1127` int(11) NOT NULL COMMENT '开球球队',
  `c1000` int(11) NOT NULL COMMENT '让球',
  `c1007` int(11) NOT NULL COMMENT '大/小',
  `c1005` int(11) NOT NULL COMMENT '独赢',
  `c1099` int(11) NOT NULL COMMENT '波胆',
  `c1100` int(11) NOT NULL COMMENT '波胆下半场',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sjb_set`
--

LOCK TABLES `sjb_set` WRITE;
/*!40000 ALTER TABLE `sjb_set` DISABLE KEYS */;
INSERT INTO `sjb_set` VALUES (1,1,1,10.00,1.20,5,5,5,5,5,5);
/*!40000 ALTER TABLE `sjb_set` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sjb_tongji`
--

DROP TABLE IF EXISTS `sjb_tongji`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sjb_tongji` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub` varchar(16) NOT NULL,
  `del` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `opid` int(11) NOT NULL,
  `mksid` int(11) NOT NULL,
  `mty` int(11) NOT NULL,
  `pe` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `date` int(11) NOT NULL,
  `nm` varchar(16) NOT NULL,
  `na` varchar(16) NOT NULL,
  `li` varchar(16) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sid` (`sid`),
  KEY `opid` (`opid`),
  KEY `date` (`date`),
  KEY `mksid` (`mksid`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sjb_tongji`
--

LOCK TABLES `sjb_tongji` WRITE;
/*!40000 ALTER TABLE `sjb_tongji` DISABLE KEYS */;
INSERT INTO `sjb_tongji` VALUES (1,'0',1,1,929752,1,39011009,1000,1001,0,0.00,0,'0','韩国','0',0),(2,'0',1,1,929752,2,39011009,1000,1001,0,0.00,0,'0','葡萄牙','0',0),(3,'0',1,1,929752,3,39011016,1000,1001,0,0.00,0,'+0/0.5','韩国','+0/0.5',0),(4,'0',1,1,929752,4,39011016,1000,1001,0,0.00,0,'-0/0.5','葡萄牙','-0/0.5',0),(5,'0',1,1,929752,5,39006144,1007,1001,0,0.00,0,'大 3.5','大','3.5',0),(6,'0',1,1,929752,6,39006144,1007,1001,0,0.00,0,'小 3.5','小','3.5',0),(7,'0',1,1,929752,7,39006883,1007,1001,0,0.00,0,'大 3.5/4','大','3.5/4',0),(8,'0',1,1,929752,8,39006883,1007,1001,0,0.00,0,'小 3.5/4','小','3.5/4',0),(9,'0',1,1,929752,9,36046591,1005,1001,0,0.00,0,'主','韩国','',0),(10,'0',1,1,929752,10,36046591,1005,1001,0,0.00,0,'和','和','',0),(11,'0',1,1,929752,11,36046591,1005,1001,0,0.00,0,'客','葡萄牙','',0),(12,'0',1,1,929753,12,39006836,1000,1001,1,100.00,20221203,'0','加纳','0',1670000094),(13,'0',1,1,929753,13,39006836,1000,1001,0,0.00,0,'0','乌拉圭','0',0),(14,'0',1,1,929753,14,39007022,1000,1001,0,0.00,0,'+0/0.5','加纳','+0/0.5',0),(15,'0',1,1,929753,15,39007022,1000,1001,0,0.00,0,'-0/0.5','乌拉圭','-0/0.5',0),(16,'0',1,1,929753,16,37070855,1007,1001,0,0.00,0,'大 2.5','大','2.5',0),(17,'0',1,1,929753,17,37070855,1007,1001,0,0.00,0,'小 2.5','小','2.5',0),(18,'0',1,1,929753,18,37240906,1007,1001,0,0.00,0,'大 2.5/3','大','2.5/3',0),(19,'0',1,1,929753,19,37240906,1007,1001,0,0.00,0,'小 2.5/3','小','2.5/3',0),(20,'0',1,1,929753,20,36046547,1099,1001,0,0.00,0,'1-0','1-0','',0);
/*!40000 ALTER TABLE `sjb_tongji` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sjb_user`
--

DROP TABLE IF EXISTS `sjb_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sjb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(11) NOT NULL,
  `zt` int(11) NOT NULL DEFAULT '1',
  `sub` varchar(16) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `user` varchar(16) NOT NULL,
  `tel` bigint(20) NOT NULL,
  `lianxi` varchar(16) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sjb_user`
--

LOCK TABLES `sjb_user` WRITE;
/*!40000 ALTER TABLE `sjb_user` DISABLE KEYS */;
INSERT INTO `sjb_user` VALUES (1,0,1,'','kspade','e10adc3949ba59abbe56e057f20f883e',43346.00,'马云',13111111115,'微信','马云',1652124031),(4,0,1,'','test001','e10adc3949ba59abbe56e057f20f883e',1744.00,'王健林',0,'飞机','121212@.',1669883822),(5,0,1,'','test002','e10adc3949ba59abbe56e057f20f883e',320.00,'刘德华',0,'其它','',1670001388),(6,0,1,'','test003','e10adc3949ba59abbe56e057f20f883e',3450.00,'郭富城',0,'其它','',1670001425),(7,0,1,'','test004','e10adc3949ba59abbe56e057f20f883e',28690.00,'谢霆锋',0,'其它','',1670001465),(8,0,1,'','test005','e10adc3949ba59abbe56e057f20f883e',9830.00,'张学友',0,'其它','',1670001513),(9,0,1,'kspade3','test111','e10adc3949ba59abbe56e057f20f883e',176529.00,'马化腾',0,'支付宝','测试1111',1670152259),(10,0,1,'kspade3','test112','e10adc3949ba59abbe56e057f20f883e',0.00,'王健林',0,'飞机','大',1670152400),(11,0,1,'kspade3','5454545','e10adc3949ba59abbe56e057f20f883e',100.00,'231312',0,'飞机','321321',1670152521),(12,0,1,'kspade3','kspade2112','ef293c4637ddd7d135229cdc1a2bba56',31.00,'对对对',0,'QQ','dsadsa',1670152832),(13,0,1,'kspade3','dsadsa','165c468905fa4e852e23d2ab8ab2c33a',110.00,'sad',0,'QQ','dsadsa',1670152857);
/*!40000 ALTER TABLE `sjb_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_crontab`
--

DROP TABLE IF EXISTS `sys_crontab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_crontab` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL COMMENT '任务标题',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '任务类型 (1 command, 2 class, 3 url, 4 eval)',
  `rule` varchar(100) NOT NULL COMMENT '任务执行表达式',
  `target` varchar(150) NOT NULL DEFAULT '' COMMENT '调用任务字符串',
  `parameter` varchar(500) NOT NULL COMMENT '任务调用参数',
  `running_times` int(11) NOT NULL DEFAULT '0' COMMENT '已运行次数',
  `last_running_time` int(11) NOT NULL DEFAULT '0' COMMENT '上次运行时间',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序，越大越前',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '任务状态状态[0:禁用;1启用]',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `singleton` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否单次执行 (0 是 1 不是)',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `title` (`title`) USING BTREE,
  KEY `create_time` (`create_time`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `type` (`type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='定时器任务表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_crontab`
--

LOCK TABLES `sys_crontab` WRITE;
/*!40000 ALTER TABLE `sys_crontab` DISABLE KEYS */;
INSERT INTO `sys_crontab` VALUES (2,'class',2,'*/3 * * * *','app\\task\\trx_price','',1820,1690177680,'trx兑换价格监听',0,1,1657776338,1657776338,1),(3,'class',2,'*/6 * * * * *','app\\task\\trx_jt','',52892,1690177717,'trx转账监听',0,1,1657776338,1657776338,1),(4,'class',2,'*/5 * * * * *','app\\task\\usdt_jt','',63430,1690177716,'usdt到账监听',0,1,1657776338,1657776338,1),(7,'class',2,'*/1 * * * *','app\\task\\group_adtext','',5489,1690177682,'群组定时广告任务',0,1,1657776338,1657776338,1),(9,'class',2,'*/10 * * * * *','app\\task\\trx_sunswap','',9392,1690177711,'监听闪兑TRX结果',0,1,1657776338,1657776338,1);
/*!40000 ALTER TABLE `sys_crontab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_crontab_log`
--

DROP TABLE IF EXISTS `sys_crontab_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_crontab_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `crontab_id` bigint(20) unsigned NOT NULL COMMENT '任务id',
  `target` varchar(255) NOT NULL COMMENT '任务调用目标字符串',
  `parameter` varchar(500) NOT NULL COMMENT '任务调用参数',
  `exception` text NOT NULL COMMENT '任务执行或者异常信息输出',
  `return_code` tinyint(1) NOT NULL DEFAULT '0' COMMENT '执行返回状态[0成功; 1失败]',
  `running_time` varchar(10) NOT NULL COMMENT '执行所用时间',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `create_time` (`create_time`) USING BTREE,
  KEY `crontab_id` (`crontab_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='定时器任务执行日志表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_crontab_log`
--

LOCK TABLES `sys_crontab_log` WRITE;
/*!40000 ALTER TABLE `sys_crontab_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_crontab_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_menu`
--

DROP TABLE IF EXISTS `sys_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_menu` (
  `menuId` int(11) NOT NULL AUTO_INCREMENT COMMENT '菜单id',
  `parentId` int(11) NOT NULL DEFAULT '0' COMMENT '上级id, 0是顶级',
  `title` varchar(200) NOT NULL COMMENT '菜单名称',
  `path` varchar(200) DEFAULT NULL COMMENT '菜单路由地址',
  `component` varchar(200) DEFAULT NULL COMMENT '菜单组件地址, 目录可为空',
  `menuType` int(11) DEFAULT '0' COMMENT '类型, 0菜单, 1按钮',
  `sortNumber` int(11) NOT NULL DEFAULT '1' COMMENT '排序号',
  `authority` varchar(200) DEFAULT NULL COMMENT '权限标识',
  `target` varchar(200) DEFAULT '_self' COMMENT '打开位置',
  `icon` varchar(200) DEFAULT NULL COMMENT '菜单图标',
  `color` varchar(200) DEFAULT NULL COMMENT '图标颜色',
  `hide` int(11) NOT NULL DEFAULT '0' COMMENT '是否隐藏, 0否, 1是(仅注册路由不显示在左侧菜单)',
  `active` varchar(200) DEFAULT NULL COMMENT '菜单侧栏选中的path',
  `meta` varchar(800) DEFAULT NULL COMMENT '其它路由元信息',
  `del` int(11) NOT NULL DEFAULT '0' COMMENT '是否删除, 0否, 1是',
  `tenantId` int(11) NOT NULL DEFAULT '1' COMMENT '租户id',
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`menuId`) USING BTREE,
  KEY `tenant_id` (`tenantId`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='菜单';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_menu`
--

LOCK TABLES `sys_menu` WRITE;
/*!40000 ALTER TABLE `sys_menu` DISABLE KEYS */;
INSERT INTO `sys_menu` VALUES (1,0,'Dashboard ','/dashboard','',0,0,'','_self','el-icon-s-home',NULL,0,NULL,'',0,1,'2022-06-15 11:49:57','2022-06-15 11:49:57'),(2,1,'分析页','/dashboard/monitor','/dashboard/monitor',0,11,'','_self','el-icon-odometer',NULL,0,NULL,'',0,1,'2022-06-15 12:02:41','2022-06-15 12:02:41'),(3,0,'商户信息','/user/profile','/user/profile',0,2,'','_self','el-icon-user-solid',NULL,0,NULL,'',0,1,'2022-06-15 12:06:23','2022-06-15 12:06:23'),(4,3,'基本信息','/user/profile','/user/profile',0,3,'','_self','el-icon-setting',NULL,0,NULL,'',1,1,'2022-06-15 12:07:45','2022-06-15 12:07:45'),(5,1,'消息','/user/message','/user/message',0,22,'','_self','el-icon-chat-dot-square',NULL,0,NULL,'',0,1,'2022-06-15 12:08:38','2022-06-15 12:08:38'),(6,0,'收款通道','/item','',0,15,'','_self','el-icon-_integral-solid',NULL,0,NULL,'',0,1,'2022-06-15 12:09:33','2022-06-15 12:09:33'),(7,6,'新增通道','/item/add','/pay/item_add.vue',0,1,'','_self','el-icon-_vercode',NULL,1,NULL,'',0,1,'2022-06-15 12:10:38','2022-06-15 12:10:38'),(8,6,'通道列表','/item/list','/pay/item.vue',0,5,'','_self','el-icon-_template',NULL,0,NULL,'',0,1,'2022-06-15 12:11:11','2022-06-15 12:11:11'),(9,0,'系统管理','/admin','',0,1,'','_self','el-icon-_setting-solid',NULL,0,NULL,'',0,1,'2022-06-15 12:11:58','2022-06-15 12:11:58'),(10,9,'菜单管理','/admin/menu','/admin/menu',0,10,'','_self','el-icon-s-operation',NULL,0,NULL,'',0,1,'2022-06-15 12:12:25','2022-06-15 12:12:25'),(11,9,'角色管理','/admin/role','/admin/role',0,91,'','_self','el-icon-user',NULL,0,NULL,'',0,1,'2022-06-15 12:12:50','2022-06-15 12:12:50'),(12,0,'订单列表','/order','',0,20,'','_self','el-icon-s-order',NULL,0,NULL,'',0,1,'2022-06-15 12:46:07','2022-06-15 12:46:07'),(13,12,'银行卡订单','/order/pay','/pay/dingdan.vue',0,121,'','_self','el-icon-bank-card',NULL,0,NULL,'',0,1,'2022-06-15 12:47:28','2022-06-15 12:47:28'),(14,12,'异常订单','/order/payerr','/pay/dingdan_err.vue',0,122,'','_self','el-icon-document-delete',NULL,0,NULL,'',0,1,'2022-06-15 12:48:22','2022-06-15 12:48:22'),(15,9,'消息管理','/admin/allmsg','/admin/allmsg',0,20,'','_self','el-icon-chat-line-round',NULL,0,NULL,'',0,1,'2022-06-15 12:53:20','2022-06-15 12:53:20'),(16,8,'编辑通道',NULL,NULL,1,2,'/api/payment/updatequdao','_self',NULL,NULL,0,NULL,'',0,1,'2022-06-15 13:33:30','2022-06-15 13:33:30'),(17,8,'获取通道列表',NULL,NULL,1,1,'/api/payment/itemlist','_self',NULL,NULL,0,NULL,'',0,1,'2022-06-15 13:45:21','2022-06-15 13:45:21'),(18,13,'获取订单',NULL,NULL,1,0,'/api/payment/AllPage','_self',NULL,NULL,0,NULL,'',0,1,'2022-06-15 13:47:27','2022-06-15 13:47:27'),(19,5,'获取消息',NULL,NULL,1,0,'/api/user/my_message_notice','_self',NULL,NULL,0,NULL,'',0,1,'2022-06-15 13:48:39','2022-06-15 13:48:39'),(20,3,'获取账户信息',NULL,NULL,1,31,'/api/user/user_basic','_self',NULL,NULL,0,NULL,'',0,1,'2022-06-15 13:49:55','2022-06-15 13:49:55'),(21,3,'绑解谷歌验证',NULL,NULL,1,31,'/api/user/my_open_Google','_self',NULL,NULL,0,NULL,'',0,1,'2022-06-15 13:56:48','2022-06-15 13:56:48'),(22,3,'绑定telgram',NULL,NULL,1,31,'/api/user/my_open_Telegram','_self',NULL,NULL,0,NULL,'',0,1,'2022-06-15 13:58:39','2022-06-15 13:58:39'),(23,5,'删除消息',NULL,NULL,1,20,'/api/user/my_message_del','_self',NULL,NULL,0,NULL,'',0,1,'2022-06-15 14:00:54','2022-06-15 14:00:54'),(24,8,'删除通道',NULL,NULL,1,5,'/api/payment/delqudao','_self',NULL,NULL,0,NULL,'',0,1,'2022-06-15 14:02:21','2022-06-15 14:02:21'),(25,13,'删除订单',NULL,NULL,1,2,'/api/payment/deldingdan','_self',NULL,NULL,0,NULL,'',0,1,'2022-06-15 14:03:14','2022-06-15 14:03:14'),(26,13,'补发订单',NULL,NULL,1,1,'/api/payment/repair','_self',NULL,NULL,0,NULL,'',0,1,'2022-06-15 14:05:11','2022-06-15 14:05:11'),(27,8,'启用通道',NULL,NULL,1,3,'/api/payment/updateztA','_self',NULL,NULL,0,NULL,'',0,1,'2022-06-15 18:38:59','2022-06-15 18:38:59'),(28,7,'新增通道',NULL,NULL,1,0,'/api/payment/addqudao','_self',NULL,NULL,0,NULL,'',0,1,'2022-06-22 08:44:29','2022-06-22 08:44:29'),(29,0,'财务报表','/log','',0,50,'','_self','el-icon-s-flag',NULL,0,NULL,'',0,1,'2022-06-22 10:50:58','2022-06-22 10:50:58'),(30,29,'每日总计','/log/r','/pay/log_R.vue',0,2,'','_self','el-icon-time',NULL,0,NULL,'',0,1,'2022-06-22 10:52:56','2022-06-22 10:52:56'),(31,29,'每日通道统计','/log/qd','/pay/log_qd.vue',0,3,'','_self','el-icon-pie-chart',NULL,0,NULL,'',0,1,'2022-06-22 10:54:17','2022-06-22 10:54:17'),(32,30,'获取每日账单',NULL,NULL,1,0,'/api/payment/getlogtday','_self',NULL,NULL,0,NULL,'',0,1,'2022-06-26 01:25:27','2022-06-26 01:25:27'),(33,30,'删除每日账单',NULL,NULL,1,1,'/api/payment/dellogtday','_self',NULL,NULL,0,NULL,'',0,1,'2022-06-26 01:25:55','2022-06-26 01:25:55'),(34,31,'获取通道账单',NULL,NULL,1,0,'/api/payment/getlogqd','_self',NULL,NULL,0,NULL,'',0,1,'2022-06-26 01:26:28','2022-06-26 01:26:28'),(35,31,'删除通道账单',NULL,NULL,1,1,'/api/payment/dellogqd','_self',NULL,NULL,0,NULL,'',0,1,'2022-06-26 01:26:46','2022-06-26 01:26:46'),(36,0,'对接文档','/url','',0,88,'','_self','el-icon-_service',NULL,1,NULL,'',0,1,'2022-07-02 09:07:18','2022-07-02 09:07:18'),(37,36,'在线测试','http://www.baidu.com',NULL,0,1,'','_self','el-icon-_upload',NULL,0,NULL,'',0,1,'2022-07-02 09:07:43','2022-07-02 09:07:43'),(38,36,'对接文档','http://www.baidu.com/2',NULL,0,2,'','_self','el-icon-_network',NULL,0,NULL,'',0,1,'2022-07-02 09:07:58','2022-07-02 09:07:58'),(39,3,'重置秘钥',NULL,NULL,1,31,'/api/user/retkey','_self',NULL,NULL,0,NULL,'',0,1,'2022-07-02 09:32:25','2022-07-02 09:32:25'),(40,0,'卡商列表','/agent','',0,6,'','_self','el-icon-_user-group','123456',1,NULL,'',1,1,'2022-07-27 00:51:57','2022-07-27 00:51:57'),(41,6,'卡商','/item/up','/pay/up.vue',0,1,'','_self','el-icon-coordinate',NULL,0,NULL,'{\"badge\": \"供\"}',0,1,'2022-07-27 00:53:00','2022-07-27 00:53:00'),(42,41,'获取卡商',NULL,NULL,1,1,'/api/up/uplist','_self',NULL,NULL,0,NULL,'',0,1,'2022-07-27 00:58:21','2022-07-27 00:58:21'),(43,41,'新增卡商',NULL,NULL,1,2,'/api/up/upadd','_self',NULL,NULL,0,NULL,'',0,1,'2022-07-27 01:01:07','2022-07-27 01:01:07'),(44,41,'修改卡商',NULL,NULL,1,3,'/api/payment/upput','_self',NULL,NULL,0,NULL,'',1,1,'2022-07-27 01:01:45','2022-07-27 01:01:45'),(45,41,'删除卡商',NULL,NULL,1,4,'/api/up/updel','_self',NULL,NULL,0,NULL,'',0,1,'2022-07-27 01:02:08','2022-07-27 01:02:08'),(46,41,'卡商权限修改',NULL,NULL,1,12,'/api/up/upauth','_self',NULL,NULL,0,NULL,'',0,1,'2022-07-27 11:58:40','2022-07-27 11:58:40'),(47,6,'通道回款记录','/item/dec','/pay/log_up_dec.vue',0,30,'','_self','el-icon-_refund',NULL,0,NULL,'',0,1,'2022-07-27 16:55:17','2022-07-27 16:55:17'),(48,47,'获取清算记录',NULL,NULL,1,1,'/api/up/upmoneylog','_self',NULL,NULL,0,NULL,'',0,1,'2022-07-27 16:56:31','2022-07-27 16:56:31'),(49,47,'删除清算记录',NULL,NULL,1,2,'/api/up/delmoneylog','_self',NULL,NULL,0,NULL,'',0,1,'2022-07-27 16:57:13','2022-07-27 16:57:13'),(50,3,'修改密码',NULL,NULL,1,31,'/api/user/UpdatePassword','_self',NULL,NULL,0,NULL,'',0,1,'2022-07-27 17:44:15','2022-07-27 17:44:15'),(51,9,'用户管理','/admin/user','/admin/user',0,0,'','_self','el-icon-coordinate',NULL,0,NULL,'',0,1,'2022-07-29 17:43:50','2022-07-29 17:43:50'),(52,14,'获取异常订单',NULL,NULL,1,1,'/api/payment/dderrlist','_self',NULL,NULL,0,NULL,'',0,1,'2022-08-11 15:39:06','2022-08-11 15:39:06'),(53,14,'删除异常订单',NULL,NULL,1,2,'/api/payment/delerrdd','_self',NULL,NULL,0,NULL,'',0,1,'2022-08-11 15:39:39','2022-08-11 15:39:39'),(54,6,'通道加款记录','/item/inc','/pay/log_up_inc.vue',0,20,'','_self','el-icon-_refund-solid',NULL,0,NULL,'',0,1,'2022-08-12 12:41:09','2022-08-12 12:41:09'),(55,54,'获取加款记录',NULL,NULL,1,1,'/api/up/incmoneylog','_self',NULL,NULL,0,NULL,'',0,1,'2022-08-12 12:41:47','2022-08-12 12:41:47'),(56,54,'删除加款记录',NULL,NULL,1,2,'/api/up/delincmoneylog','_self',NULL,NULL,0,NULL,'',0,1,'2022-08-12 12:42:26','2022-08-12 12:42:26'),(57,3,'设置谷歌授权页',NULL,NULL,1,31,'/api/user/SetGoogelMenu','_self',NULL,NULL,0,NULL,'',0,1,'2022-08-14 08:59:42','2022-08-14 08:59:42'),(58,8,'停用通道',NULL,NULL,1,4,'/api/payment/updateztB','_self',NULL,NULL,0,NULL,'',0,1,'2022-08-14 13:52:08','2022-08-14 13:52:08'),(59,41,'下发扣款',NULL,NULL,1,10,'/api/up/UpDecMoney','_self',NULL,NULL,0,NULL,'',0,1,'2022-08-19 13:44:55','2022-08-19 13:44:55'),(60,41,'查单加款',NULL,NULL,1,7,'/api/up/UpIncMoney','_self',NULL,NULL,0,NULL,'',0,1,'2022-08-19 15:26:52','2022-08-19 15:26:52'),(61,41,'封禁卡商',NULL,NULL,1,3,'/api/up/upputzt','_self',NULL,NULL,0,NULL,'',0,1,'2022-08-19 16:12:42','2022-08-19 16:12:42'),(62,41,'开关谷歌验证',NULL,NULL,1,13,'/api/up/upputgoog','_self',NULL,NULL,0,NULL,'',0,1,'2022-08-19 16:13:43','2022-08-19 16:13:43'),(63,41,'重置卡商密码',NULL,NULL,1,15,'/api/up/upputpassword','_self',NULL,NULL,0,NULL,'',0,1,'2022-08-19 16:17:12','2022-08-19 16:17:12'),(64,41,'重置卡商数据',NULL,NULL,1,20,'/api/up/upresetData','_self',NULL,NULL,0,NULL,'',0,1,'2022-08-19 16:19:06','2022-08-19 16:19:06'),(65,3,'设置登录IP白名单',NULL,NULL,1,31,'/api/user/LoginIp','_self',NULL,NULL,0,NULL,'',0,1,'2022-08-20 02:54:32','2022-08-20 02:54:32'),(66,3,'设置api接口白名单',NULL,NULL,1,31,'/api/user/ApiIp','_self',NULL,NULL,0,NULL,'',0,1,'2022-08-20 03:44:34','2022-08-20 03:44:34'),(67,3,'重置谷歌验证',NULL,NULL,1,31,'/api/user/googelRet','_self',NULL,NULL,0,NULL,'',0,1,'2022-08-20 04:16:11','2022-08-20 04:16:11'),(68,29,'收支明细报表','/log/mingxi','/pay/log_mingxi.vue',0,5,'','_self','el-icon-_table',NULL,0,NULL,'',0,1,'2022-08-20 04:28:28','2022-08-20 04:28:28'),(69,68,'获取收支报表',NULL,NULL,1,1,'/api/user/log_money','_self',NULL,NULL,0,NULL,'',0,1,'2022-08-20 04:32:35','2022-08-20 04:32:35'),(70,113,'设置子账号权限',NULL,NULL,1,1,'/api/sub/setSubMenu','_self',NULL,NULL,0,NULL,'',0,1,'2022-09-05 09:33:55','2022-09-05 09:33:55'),(71,113,'获取子账号列表',NULL,NULL,1,1131,'/api//user/sublist','_self',NULL,NULL,0,NULL,'',1,1,'2022-09-05 09:36:37','2022-09-05 09:36:37'),(72,113,'获取子账号权限',NULL,NULL,1,1131,'/api/user/subMenu','_self',NULL,NULL,0,NULL,'',1,1,'2022-09-05 09:37:20','2022-09-05 09:37:20'),(73,113,'删除子账号',NULL,NULL,1,1131,'/api/sub/subdel','_self',NULL,NULL,0,NULL,'',0,1,'2022-09-05 10:49:51','2022-09-05 10:49:51'),(74,113,'新增子账号',NULL,NULL,1,1131,'/api/sub/subadd','_self',NULL,NULL,0,NULL,'',0,1,'2022-09-05 10:50:35','2022-09-05 10:50:35'),(75,80,'代付订单','/daifu/list','/pay/daifu.vue',0,801,'','_self','el-icon-_table',NULL,0,NULL,'',0,1,'2022-09-08 11:19:42','2022-09-08 11:19:42'),(76,75,'获取代付订单',NULL,NULL,1,1,'/api/daifu/alldd','_self',NULL,NULL,0,NULL,'',0,1,'2022-09-08 11:21:09','2022-09-08 11:21:09'),(77,75,'上传下发凭证图',NULL,NULL,1,10,'/api/daifu/upload','_self',NULL,NULL,0,NULL,'',0,1,'2022-09-08 12:37:50','2022-09-08 12:37:50'),(78,75,'代付订单标记成功',NULL,NULL,1,15,'/api/daifu/setdd','_self',NULL,NULL,0,NULL,'',0,1,'2022-09-08 12:39:53','2022-09-08 12:39:53'),(79,75,'取消代付订单',NULL,NULL,1,6,'/api/daifu/deldd','_self',NULL,NULL,0,NULL,'',0,1,'2022-09-08 12:40:18','2022-09-08 12:40:18'),(80,0,'代付下发','/daifu','',0,30,'','_self','el-icon-_money-solid',NULL,0,NULL,'',0,1,'2022-09-08 14:11:08','2022-09-08 14:11:08'),(81,13,'修改订单金额',NULL,NULL,1,2,'/api/payment/xiugaimoney','_self',NULL,NULL,0,NULL,'',0,1,'2022-09-14 14:40:04','2022-09-14 14:40:04'),(82,75,'撤回代付订单',NULL,NULL,1,2,'/api/daifu/chehui','_self',NULL,NULL,0,NULL,'',0,1,'2022-09-14 14:40:33','2022-09-14 14:40:33'),(83,3,'设置代付IP白名单',NULL,NULL,1,31,'/api/user/DaifuIp','_self',NULL,NULL,0,NULL,'',0,1,'2022-09-20 08:46:26','2022-09-20 08:46:26'),(84,3,'设置代付自动分笔',NULL,NULL,1,31,'/api/user/daifuAuto','_self',NULL,NULL,0,NULL,'',0,1,'2022-09-20 08:46:56','2022-09-20 08:46:56'),(85,8,'设置通道优先出款',NULL,NULL,1,1,'/api/payment/youxiandec','_self',NULL,NULL,0,NULL,'',0,1,'2022-10-07 15:30:50','2022-10-07 15:30:50'),(86,5,'清空消息',NULL,NULL,1,10,'/api/user/message_read','_self',NULL,NULL,0,NULL,'',0,1,'2022-10-07 16:41:23','2022-10-07 16:41:23'),(87,8,'扣款',NULL,NULL,1,0,'/api/payment/koukuan','_self',NULL,NULL,0,NULL,'',0,1,'2022-10-10 02:18:14','2022-10-10 02:18:14'),(88,8,'加款',NULL,NULL,1,0,'/api/up/UpIncMoney','_self',NULL,NULL,0,NULL,'',0,1,'2022-10-10 02:18:55','2022-10-10 02:18:55'),(89,13,'撤销订单资金',NULL,NULL,1,2,'/api/payment/chehuidingdan','_self',NULL,NULL,0,NULL,'',0,1,'2022-10-10 02:20:11','2022-10-10 02:20:11'),(90,3,'飞机群机器人授权',NULL,NULL,1,31,'/api/user/TGqunbind','_self',NULL,NULL,0,NULL,'',0,1,'2022-10-21 16:37:46','2022-10-21 16:37:46'),(91,3,'查看在线终端',NULL,NULL,1,0,'/api/user/zxzd','_self',NULL,NULL,0,NULL,'',0,1,'2022-11-19 15:48:18','2022-11-19 15:48:18'),(92,0,'世界杯管理','/sjb','',0,200,'','_self','el-icon-_network',NULL,0,NULL,'',0,1,'2022-11-29 17:58:26','2022-11-29 17:58:26'),(93,92,'用户管理','/sjb/userlist','/sjb/userlist.vue',0,20,'','_self','el-icon-user',NULL,0,NULL,'',0,1,'2022-11-29 17:59:50','2022-11-29 17:59:50'),(94,92,'赛事管理','/sjb/list','/sjb/list.vue',0,30,'','_self','el-icon-video-play',NULL,0,NULL,'',0,1,'2022-11-29 18:00:40','2022-11-29 18:00:40'),(95,92,'投注订单','/sjb/pay','/sjb/pay.vue',0,40,'','_self','el-icon-_table',NULL,0,NULL,'',0,1,'2022-11-29 18:01:26','2022-11-29 18:01:26'),(96,93,'新增用户',NULL,NULL,1,1,'/api/sjb/adduser','_self',NULL,NULL,0,NULL,'',0,1,'2022-11-29 18:02:02','2022-11-29 18:02:02'),(97,93,'加款扣款',NULL,NULL,1,2,'/api/sjb/money','_self',NULL,NULL,0,NULL,'',0,1,'2022-11-29 18:02:21','2022-11-29 18:02:21'),(98,93,'修改用户密码',NULL,NULL,1,3,'/api/sjb/upputpassword','_self',NULL,NULL,0,NULL,'',0,1,'2022-11-29 18:03:46','2022-11-29 18:03:46'),(99,94,'赛事详情','/sjb/list/details','/sjb/details.vue',0,1,'','_self','el-icon-_trending-up',NULL,1,NULL,'',0,1,'2022-11-29 18:05:00','2022-11-29 18:05:00'),(100,99,'修改赔率',NULL,NULL,1,1,'/api/sjb/xiugaiod','_self',NULL,NULL,0,NULL,'',0,1,'2022-11-29 18:05:27','2022-11-29 18:05:27'),(101,99,'手动锁盘',NULL,NULL,1,2,'/api/sjb/xiugailok','_self',NULL,NULL,0,NULL,'',0,1,'2022-11-29 18:05:49','2022-11-29 18:05:49'),(102,99,'显示隐藏玩法',NULL,NULL,1,3,'/api/sjb/xiugaizt','_self',NULL,NULL,0,NULL,'',0,1,'2022-11-29 18:06:11','2022-11-29 18:06:11'),(103,95,'标记中奖',NULL,NULL,1,1,'/api/sjb/zhongjiang','_self',NULL,NULL,0,NULL,'',0,1,'2022-11-29 18:06:27','2022-11-29 18:06:27'),(104,95,'取消中奖',NULL,NULL,1,2,'/api/sjb/delzhongjiang','_self',NULL,NULL,0,NULL,'',0,1,'2022-11-29 18:06:44','2022-11-29 18:06:44'),(105,92,'数据统计','/sjb/tongji','/sjb/tongji',0,0,'','_self','el-icon-_trending-up',NULL,0,NULL,'',0,1,'2022-12-02 16:44:37','2022-12-02 16:44:37'),(106,92,'系统配置','/sjb/set','/sjb/set.vue',0,8,'','_self','el-icon-_setting',NULL,0,NULL,'',0,1,'2022-12-02 16:45:21','2022-12-02 16:45:21'),(107,106,'清理数据',NULL,NULL,1,0,'/api/sjb/qingli','_self',NULL,NULL,0,NULL,'',0,1,'2022-12-02 16:46:05','2022-12-02 16:46:05'),(108,106,'修改配置',NULL,NULL,1,0,'/api/sjb/putsetting','_self',NULL,NULL,0,NULL,'',0,1,'2022-12-02 16:46:40','2022-12-02 16:46:40'),(109,92,'资金记录','/sjb/logmoney','/sjb/logmoney.vue',0,60,'','_self','el-icon-postcard',NULL,0,NULL,'',0,1,'2022-12-02 16:48:29','2022-12-02 16:48:29'),(110,93,'封禁用户',NULL,NULL,1,0,'/api/sjb/userzt','_self',NULL,NULL,0,NULL,'',0,1,'2022-12-03 14:55:53','2022-12-03 14:55:53'),(111,0,'账户中心','/user','',0,2,'','_self','el-icon-setting',NULL,0,NULL,'',0,1,'2022-12-03 16:06:54','2022-12-03 16:06:54'),(112,111,'账户安全','/user/safe','/user/safe.vue',0,6,'','_self','el-icon-set-up',NULL,0,NULL,'',0,1,'2022-12-03 16:09:21','2022-12-03 16:09:21'),(113,111,'子账户','/user/sub','/user/sub',0,10,'','_self','el-icon-coordinate',NULL,0,NULL,'',0,1,'2022-12-03 16:10:09','2022-12-03 16:10:09'),(114,113,'修改子户账户状态',NULL,NULL,1,0,'/api/sub/apizt','_self',NULL,NULL,0,NULL,'',0,1,'2022-12-04 06:54:29','2022-12-04 06:54:29'),(115,113,'开关子户谷歌验证',NULL,NULL,1,0,'/api/sub/googlezt','_self',NULL,NULL,0,NULL,'',0,1,'2022-12-04 06:57:01','2022-12-04 06:57:01'),(116,113,'修改限管下级号',NULL,NULL,1,0,'/api/sub/onezt','_self',NULL,NULL,0,NULL,'',0,1,'2022-12-04 07:02:12','2022-12-04 07:02:12'),(117,113,'修改加款限制模式',NULL,NULL,1,0,'/api/sub/mtzt','_self',NULL,NULL,0,NULL,'',0,1,'2022-12-04 07:03:33','2022-12-04 07:03:33'),(118,113,'加减余额',NULL,NULL,1,0,'/api/sub/money','_self',NULL,NULL,0,NULL,'',0,1,'2022-12-04 08:20:51','2022-12-04 08:20:51'),(119,113,'修改子账户密码',NULL,NULL,1,0,'/api/sub/subpw','_self',NULL,NULL,0,NULL,'',0,1,'2022-12-04 10:03:11','2022-12-04 10:03:11'),(120,99,'获取赛事',NULL,NULL,1,0,'','_self',NULL,NULL,0,NULL,'',0,1,'2022-12-04 10:48:32','2022-12-04 10:48:32'),(121,95,'获取投注订单',NULL,NULL,1,0,'','_self',NULL,NULL,0,NULL,'',0,1,'2022-12-04 12:23:22','2022-12-04 12:23:22'),(122,109,'获取记录',NULL,NULL,1,0,'','_self',NULL,NULL,0,NULL,'',0,1,'2022-12-04 12:40:50','2022-12-04 12:40:50'),(123,111,'账户信息','/user/info','/user/my.vue',0,0,'','_self','el-icon-document',NULL,0,NULL,'',0,1,'2022-12-04 15:54:19','2022-12-04 15:54:19'),(124,0,'获取赛事',NULL,NULL,1,1,'','_self',NULL,NULL,0,NULL,'',1,1,'2022-12-04 15:57:36','2022-12-04 15:57:36'),(125,0,'Dashboard','/tg','',0,1,'','_self','el-icon-s-home',NULL,0,NULL,'',0,2,'2023-03-14 02:22:36','2023-03-14 02:22:36'),(126,125,'数据概况','/tg/index','/tg/index',0,10,'','_self','el-icon-data-line',NULL,0,NULL,'',0,2,'2023-03-14 02:43:09','2023-03-14 02:43:09'),(127,149,'钱包配置','/tg/setup','/tg/setup',0,111,'','_self','el-icon-_setting-solid',NULL,0,NULL,'',0,2,'2023-03-14 03:53:34','2023-03-14 03:53:34'),(128,0,'自定义菜单','/tg/command','/tg/command',0,80,'','_self','el-icon-_nav',NULL,0,NULL,'',0,2,'2023-03-14 03:54:01','2023-03-14 03:54:01'),(129,0,'自定义按钮','/tg/msgbtn','/tg/msgbtn',0,90,'','_self','el-icon-_pad',NULL,0,NULL,'',0,2,'2023-03-14 03:55:01','2023-03-14 03:55:01'),(130,0,'自定义键盘','/tg/reply','/tg/reply',0,100,'','_self','el-icon-_keyboard',NULL,0,NULL,'',0,2,'2023-03-14 03:55:34','2023-03-14 03:55:34'),(131,149,'机器人配置','/tg/info','/tg/info',0,100,'','_self','el-icon-_camera',NULL,0,NULL,'',0,2,'2023-03-14 04:03:52','2023-03-14 04:03:52'),(132,0,'群组管理','/tg/group','/tg/group',0,50,'','_self','el-icon-_user-group',NULL,0,NULL,'',0,2,'2023-03-14 04:29:12','2023-03-14 04:29:12'),(133,0,'用户管理','/tg/user','/tg/user',0,40,'','_self','el-icon-user',NULL,0,NULL,'',0,2,'2023-03-14 04:30:03','2023-03-14 04:30:03'),(134,151,'地址管理','/tg/trc20','/tg/trc20',0,298,'','_self','el-icon-location-information',NULL,0,NULL,'',0,2,'2023-03-14 04:33:36','2023-03-14 04:33:36'),(135,151,'兑换记录','/tg/dh_log','/tg/dh_log',0,300,'','_self','el-icon-tickets',NULL,0,NULL,'',0,2,'2023-03-14 04:37:32','2023-03-14 04:37:32'),(136,129,'发布更新按钮',NULL,NULL,1,10,'/api/tgbot/command_markup','_self',NULL,NULL,0,NULL,'',0,2,'2023-03-19 01:25:48','2023-03-19 01:25:48'),(137,129,'删除按钮',NULL,NULL,1,20,'/api/tgbot/markup_del','_self',NULL,NULL,0,NULL,'',0,2,'2023-03-19 05:26:16','2023-03-19 05:26:16'),(138,129,'添加事件',NULL,NULL,1,19,'/api/tgbot/command_add','_self',NULL,NULL,0,NULL,'',0,2,'2023-03-19 09:35:16','2023-03-19 09:35:16'),(139,128,'添加菜单命令',NULL,NULL,1,10,'/api/tgbot/commands_add','_self',NULL,NULL,0,NULL,'',0,2,'2023-03-21 15:04:08','2023-03-21 15:04:08'),(140,128,'删除菜单命令',NULL,NULL,1,20,'/api/tgbot/command_del','_self',NULL,NULL,0,NULL,'',0,2,'2023-03-21 16:30:20','2023-03-21 16:30:20'),(141,133,'发送消息',NULL,NULL,1,10,'/api/tgbot/send_Msg','_self',NULL,NULL,0,NULL,'',0,2,'2023-03-25 12:57:22','2023-03-25 12:57:22'),(142,132,'发送消息',NULL,NULL,1,10,'/api/tgbot/send_Msg','_self',NULL,NULL,0,NULL,'',0,2,'2023-03-25 12:57:40','2023-03-25 12:57:40'),(143,132,'加白名单',NULL,NULL,1,8,'/api/tgbot/group_update_zt','_self',NULL,NULL,0,NULL,'',0,2,'2023-03-28 10:37:48','2023-03-28 10:37:48'),(144,132,'机器人退群',NULL,NULL,1,6,'/api/tgbot/bot_tuiqun','_self',NULL,NULL,0,NULL,'',0,2,'2023-03-28 10:39:20','2023-03-28 10:39:20'),(145,131,'修改机器人信息',NULL,NULL,1,10,'/api/tgbot/bot_setup','_self',NULL,NULL,0,NULL,'',0,2,'2023-04-27 09:51:59','2023-04-27 09:51:59'),(146,127,'修改兑换配置信息',NULL,NULL,1,10,'/api/tgbot/bot_trx_setup','_self',NULL,NULL,0,NULL,'',0,2,'2023-04-27 15:21:07','2023-04-27 15:21:07'),(147,151,'购买TRX','/tg/trx','/tg/trx',0,290,'','_self','el-icon-_flash-solid',NULL,0,NULL,'{\"badge\": \"闪兑\"}',0,2,'2023-07-07 11:33:32','2023-07-07 11:33:32'),(148,151,'预支TRX','/tg/jie','/tg/jie',0,291,'','_self','el-icon-_red-packet-solid',NULL,0,NULL,'{\"badge\": \"借\"}',0,2,'2023-07-07 11:34:40','2023-07-07 11:34:40'),(149,0,'基础配置','/tg/x','',0,25,'','_self','el-icon-setting',NULL,0,NULL,'',0,2,'2023-07-07 11:36:07','2023-07-07 11:36:07'),(150,149,'功能开关','/tg/kaiguan','/tg/kaiguan',0,123,'','_self','el-icon-open',NULL,0,NULL,'',0,2,'2023-07-07 11:46:33','2023-07-07 11:46:33'),(151,0,'兑换管理','/tg/d','',0,28,'','_self','el-icon-_vercode',NULL,0,NULL,'',0,2,'2023-07-07 12:19:11','2023-07-07 12:19:11'),(152,132,'设置群欢迎语',NULL,NULL,1,0,'/api/tgbot/group_welcome','_self',NULL,NULL,0,NULL,'',0,2,'2023-07-07 16:53:18','2023-07-07 16:53:18'),(153,132,'设置定时广告',NULL,NULL,1,0,'/api/tgbot/group_adtext','_self',NULL,NULL,0,NULL,'',0,2,'2023-07-07 16:53:36','2023-07-07 16:53:36'),(154,0,'修改密码',NULL,NULL,1,999,'/api/user/UpdatePassword','_self',NULL,NULL,0,NULL,'',0,2,'2023-07-11 16:26:49','2023-07-11 16:26:49'),(155,0,'上传文件',NULL,NULL,1,998,'/api/upload/index','_self',NULL,NULL,0,NULL,'',0,2,'2023-07-14 15:11:31','2023-07-14 15:11:31'),(156,132,'删除群广告图',NULL,NULL,1,90,'/api/tgbot/group_delimg','_self',NULL,NULL,0,NULL,'',0,2,'2023-07-14 17:49:26','2023-07-14 17:49:26'),(157,148,'手动预支',NULL,NULL,1,11,'/api/tgbot/trx_addtrx','_self',NULL,NULL,0,NULL,'',0,2,'2023-07-17 03:41:28','2023-07-17 03:41:28'),(158,134,'修改接收通知状态',NULL,NULL,1,1,'/api/tgbot/trc20_update_zt','_self',NULL,NULL,0,NULL,'',0,2,'2023-07-17 14:01:01','2023-07-17 14:01:01'),(159,134,' 拉黑地址',NULL,NULL,1,11,'/api/tgbot/trc20_lahei','_self',NULL,NULL,0,NULL,'',0,2,'2023-07-17 14:20:49','2023-07-17 14:20:49'),(160,134,'绑定TGid',NULL,NULL,1,3,'/api/tgbot/trc20_bangding','_self',NULL,NULL,0,NULL,'',0,2,'2023-07-17 15:34:58','2023-07-17 15:34:58'),(161,147,'闪兑购买TRX',NULL,NULL,1,1,'/api/tgbot/trx_sunswapTrx','_self',NULL,NULL,0,NULL,'',0,2,'2023-07-19 14:02:38','2023-07-19 14:02:38'),(162,148,'自动预支设置',NULL,NULL,1,12,'/api/tgbot/trx_AutoSet','_self',NULL,NULL,0,NULL,'',0,2,'2023-07-20 13:03:52','2023-07-20 13:03:52'),(163,135,'补发兑换订单',NULL,NULL,1,2,'/api/tgbot/trx_bufa','_self',NULL,NULL,0,NULL,'',0,2,'2023-07-21 12:29:12','2023-07-21 12:29:12'),(164,0,'频道管理','/tg/pindao','/tg/pindao',0,52,NULL,'_self','el-icon-star-off',NULL,0,NULL,'',0,2,'2023-07-23 13:27:33','2023-07-23 13:27:33'),(165,150,'修改功能开关',NULL,NULL,1,0,'/api/tgbot/bot_setkg','_self',NULL,NULL,0,NULL,'',0,2,'2023-07-23 14:05:17','2023-07-23 14:05:17');
/*!40000 ALTER TABLE `sys_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_role`
--

DROP TABLE IF EXISTS `sys_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_role` (
  `roleId` int(11) NOT NULL AUTO_INCREMENT COMMENT '角色id',
  `roleName` varchar(200) NOT NULL COMMENT '角色名称',
  `roleCode` varchar(200) NOT NULL COMMENT '角色标识',
  `comments` varchar(400) DEFAULT NULL COMMENT '备注',
  `del` int(11) NOT NULL DEFAULT '0' COMMENT '是否删除, 0否, 1是',
  `tenantId` int(11) NOT NULL DEFAULT '1' COMMENT '租户id',
  `theme` varchar(255) NOT NULL,
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`roleId`) USING BTREE,
  KEY `tenant_id` (`tenantId`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='角色';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_role`
--

LOCK TABLES `sys_role` WRITE;
/*!40000 ALTER TABLE `sys_role` DISABLE KEYS */;
INSERT INTO `sys_role` VALUES (1,'系统管理员','admin','系统管理员',0,1,'','2020-02-26 07:18:37','2020-03-21 07:15:54'),(2,'支付商户','payuser','支付系统商户',0,1,'','2020-02-26 07:18:52','2020-03-21 07:16:02'),(3,'卡商/码商','payks','支付系统码商/卡商',0,1,'','2020-02-26 07:18:52','2020-03-21 07:16:02'),(4,'主管','sub','支付系统子账户',0,1,'','2022-08-11 07:08:08','2022-08-11 07:08:08'),(5,'世界杯超管','sjbadmin','世界杯系统管理员',0,1,'','2022-11-29 18:07:30','2022-11-29 18:07:30'),(6,'TRX兑换管理员','trxadmin','trx兑换项目管理员',0,2,'{\"colorfulIcon\":true,\"tabStyle\":\"card\",\"sideStyle\":\"light\",\"color\":\"#33cc99\"}','2023-02-08 07:05:08','2023-02-08 07:05:08'),(7,'记账机器管理员','keep','记账机器人管理员',0,2,'{\"colorfulIcon\":true,\"sideUniqueOpen\":false,\"fixedSidebar\":true}','2023-03-22 03:11:26','2023-03-22 03:11:26'),(8,'云记账超管','keepadmin','',0,2,'{\"sideUniqueOpen\":false,\"colorfulIcon\":true}','2023-04-03 16:31:01','2023-04-03 16:31:01');
/*!40000 ALTER TABLE `sys_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_role_menu`
--

DROP TABLE IF EXISTS `sys_role_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_role_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roleId` int(11) NOT NULL,
  `userId` int(11) NOT NULL DEFAULT '0',
  `tenantId` int(11) NOT NULL,
  `menuText` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_role_menu`
--

LOCK TABLES `sys_role_menu` WRITE;
/*!40000 ALTER TABLE `sys_role_menu` DISABLE KEYS */;
INSERT INTO `sys_role_menu` VALUES (1,1,0,1,'[2,51,10,11,1,9]'),(2,2,0,1,'[1,2,5,19,86,23,3,91,20,21,22,39,50,57,65,66,67,83,84,90,123,113,114,115,116,117,118,119,70,73,74,6,7,28,41,42,43,61,45,60,59,46,62,63,64,8,87,88,17,85,16,27,58,24,54,55,56,47,48,49,12,13,18,26,25,81,89,14,52,53,80,75,76,82,79,77,78,29,30,32,33,31,34,35,68,69,111]'),(3,3,10002,1,'[1,2]'),(4,3,10003,1,'[1,2]'),(5,3,0,1,'[1,2,19,20,48,55,17,16,18,52,76,77,78,32,34,68,69,3,5,4,40,47,54,6,8,12,13,14,80,75,29,30,31]'),(6,4,0,1,'[2,1]'),(8,4,100029,1,'[2,19,86,42,17,55,48,18,76,32,34,68,69,1,5,6,41,8,54,47,12,13,80,75,29,30,31]'),(9,4,100032,1,'[1,2,3,5,19,86,23,4,20,50,39,66,84,83,65,21,67,57,22,74,73,71,72,70,6,41,42,43,61,45,60,59,46,62,63,64,7,28,8,88,87,85,17,16,27,58,24,54,55,56,47,48,49,12,13,18,26,89,81,14,52,53,80,75,76,82,79,77,78,29,30,32,31,34,68,69]'),(10,4,100036,1,'[2,19,86,3,91,21,84,83,20,39,22,90,74,73,72,71,70,50,57,67,66,65,18,52,76,78,32,34,68,69,1,5,12,13,14,80,75,29,30,31]'),(11,5,0,1,'[123,113,114,115,116,117,118,119,70,73,74,92,105,106,107,108,93,110,96,97,98,94,99,120,100,101,102,95,121,103,104,109,122,111]'),(12,4,100042,1,'[123,93,110,96,97,98,121,104,109,122,111,92,95]'),(13,6,0,2,'[125,126,149,131,145,127,146,150,165,151,147,161,148,157,162,134,158,160,159,135,163,133,141,132,152,153,144,143,142,156,164,128,139,140,129,136,138,137,130,155,154]'),(14,7,0,2,'[125,126,131,145,133,141,144,143,142,128,139,140,129,136,138,137,130,155,149,132]'),(15,8,0,2,'[125,126,131,145,133,141,132,144,143,142,128,139,140,129,136,138,137,130]');
/*!40000 ALTER TABLE `sys_role_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_tenantId`
--

DROP TABLE IF EXISTS `sys_tenantId`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_tenantId` (
  `tenantId` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(1) NOT NULL,
  `name` varchar(16) NOT NULL,
  `text` varchar(100) NOT NULL,
  PRIMARY KEY (`tenantId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='租户';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_tenantId`
--

LOCK TABLES `sys_tenantId` WRITE;
/*!40000 ALTER TABLE `sys_tenantId` DISABLE KEYS */;
INSERT INTO `sys_tenantId` VALUES (1,0,'支付系统','支付 世界杯 卡商 码商'),(2,0,'TG机器人系统','电报机器人系统');
/*!40000 ALTER TABLE `sys_tenantId` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_theme`
--

DROP TABLE IF EXISTS `sys_theme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_theme` (
  `userId` int(11) NOT NULL,
  `theme` text NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_theme`
--

LOCK TABLES `sys_theme` WRITE;
/*!40000 ALTER TABLE `sys_theme` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_theme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_user_googel`
--

DROP TABLE IF EXISTS `sys_user_googel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_user_googel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `myid` int(11) NOT NULL,
  `menuText` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_user_googel`
--

LOCK TABLES `sys_user_googel` WRITE;
/*!40000 ALTER TABLE `sys_user_googel` DISABLE KEYS */;
INSERT INTO `sys_user_googel` VALUES (1,100012,'[57,39,50,3,4]'),(2,100011,'[57,39,50,3,4]'),(3,100013,'[57,39,50,3,4,65,66]'),(4,100020,'[57,39,50,3,4,65,66]');
/*!40000 ALTER TABLE `sys_user_googel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_account`
--

DROP TABLE IF EXISTS `tb_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商户',
  `del` int(11) NOT NULL DEFAULT '0',
  `roleId` int(11) NOT NULL DEFAULT '0',
  `tenantId` int(11) NOT NULL DEFAULT '0',
  `upid` int(11) NOT NULL DEFAULT '0' COMMENT '上家id',
  `key` char(32) DEFAULT NULL COMMENT '通讯密匙',
  `username` char(15) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `spassword` varchar(11) DEFAULT NULL,
  `SecretKey` varchar(32) NOT NULL COMMENT '谷歌key',
  `tgid` bigint(20) NOT NULL,
  `plugin` varchar(32) NOT NULL,
  `remark` varchar(32) NOT NULL,
  `Telegram` json NOT NULL,
  `money` decimal(10,2) DEFAULT '5.00' COMMENT '余额',
  `tmoney` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '待提现',
  `smoney` decimal(13,2) DEFAULT '0.00' COMMENT '流水',
  `ddnumber` int(11) DEFAULT '0' COMMENT '总订单',
  `rate` decimal(5,2) DEFAULT '1.38',
  `tel` decimal(11,0) DEFAULT '18800000000',
  `regtime` int(11) DEFAULT '1514736000',
  `api` int(11) DEFAULT '1' COMMENT '?可用',
  `google` int(11) NOT NULL DEFAULT '0' COMMENT '?谷歌',
  `post` int(11) NOT NULL DEFAULT '1' COMMENT '回调',
  `moshi` int(11) NOT NULL,
  `numMoney` decimal(10,2) NOT NULL,
  `sxf` decimal(10,2) NOT NULL,
  `etc` decimal(10,2) NOT NULL COMMENT '下发中',
  `sauto` int(11) NOT NULL DEFAULT '1' COMMENT '分笔',
  `webhook` int(11) NOT NULL,
  `webhookurl` varchar(64) NOT NULL,
  `dfset` int(11) NOT NULL,
  `DecSet` int(11) NOT NULL,
  `one` int(11) NOT NULL COMMENT '自己',
  `mt` int(11) NOT NULL COMMENT '扣自身余额',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `username` (`username`),
  KEY `tgid` (`tgid`),
  KEY `plugin` (`plugin`),
  KEY `remark` (`remark`)
) ENGINE=MyISAM AUTO_INCREMENT=100004 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_account`
--

LOCK TABLES `tb_account` WRITE;
/*!40000 ALTER TABLE `tb_account` DISABLE KEYS */;
INSERT INTO `tb_account` VALUES (100000,0,1,1,0,'-','admin','d1120e2540282ea96c0fe30212b23819','123456','YZRAR3RWULHBITV3',0,'','','null',100000.00,0.00,0.00,0,0.00,18888888888,1514736000,1,0,1,0,0.00,0.00,0.00,0,0,'',0,0,0,0),(100001,1,2,1,0,'07F6570C31FA81FE18720295B659B101','123456','25f9e794323b453885f5181f1b624d0b','123456','DSC5HXZJCZ4SGNEN',0,'','','null',99367.04,48368.00,51368.00,17,1.38,18800000000,1610350806,1,0,1,0,0.00,701.96,2900.00,0,0,'',0,0,0,0),(100002,0,3,1,100001,'F9F3342B11F9699DEF6D4C8B95E330AD','456789','25f9e794323b453885f5181f1b624d0b','123456',' ',0,'','','null',100000.00,0.00,0.00,0,0.00,18800000000,1610350806,0,0,1,0,0.00,0.00,0.00,0,0,'',0,0,0,0),(100003,0,3,1,100001,'F9F3342B11F9699DEF6D4C8B95E330AD','111222','25f9e794323b453885f5181f1b624d0b','123456',' ',0,'','','null',100000.00,0.00,0.00,0,0.00,18800000000,1610350806,0,0,1,0,0.00,0.00,0.00,0,0,'',0,0,0,0);
/*!40000 ALTER TABLE `tb_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_account_tg`
--

DROP TABLE IF EXISTS `tb_account_tg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_account_tg` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `del` int(1) NOT NULL COMMENT '停',
  `roleId` int(2) NOT NULL DEFAULT '1' COMMENT '角色id',
  `up` bigint(20) NOT NULL COMMENT '邀请',
  `bot` varchar(32) NOT NULL COMMENT '所属机器人',
  `tgid` bigint(20) NOT NULL COMMENT '电报ID',
  `username` varchar(16) NOT NULL COMMENT '电报用户名',
  `name` varchar(32) NOT NULL COMMENT '称呼',
  `regtime` int(11) NOT NULL COMMENT '注册时间',
  `tgnum` int(5) NOT NULL COMMENT '邀请数量',
  `tgtrx` bigint(20) NOT NULL,
  `tgyue` bigint(20) NOT NULL,
  `dhnum` int(11) NOT NULL,
  `dhusdt` bigint(20) NOT NULL,
  `dhtrx` bigint(20) NOT NULL,
  `send` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bot` (`bot`),
  KEY `tgid` (`tgid`),
  KEY `up` (`up`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_account_tg`
--

LOCK TABLES `tb_account_tg` WRITE;
/*!40000 ALTER TABLE `tb_account_tg` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_account_tg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_banklist`
--

DROP TABLE IF EXISTS `tb_banklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_banklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(11) NOT NULL DEFAULT '0',
  `name` varchar(16) NOT NULL,
  `png` varchar(16) NOT NULL DEFAULT 'no.png',
  `lv` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_banklist`
--

LOCK TABLES `tb_banklist` WRITE;
/*!40000 ALTER TABLE `tb_banklist` DISABLE KEYS */;
INSERT INTO `tb_banklist` VALUES (1,1,'网商银行','no.png',0),(2,0,'农业银行','no.png',0),(3,1,'邮储银行','no.png',0),(4,1,'建设银行','no.png',0),(5,1,'工商银行','no.png',0),(6,1,'交通银行','no.png',0),(7,1,'招商银行','no.png',0),(8,1,'光大银行','no.png',0),(9,1,'中信银行','no.png',0),(10,1,'浦发银行','no.png',0),(11,1,'平安银行','no.png',0),(12,1,'兴业银行','no.png',0),(13,1,'民生银行','no.png',0),(14,1,'中国银行','no.png',0),(15,0,'四川农信','no.png',0),(16,1,'柳州银行','no.png',0),(17,1,'邢台银行','no.png',0),(18,0,'河北省农村信用社','no.png',0),(19,0,'黑龙江农村信用社','no.png',0),(20,0,'吉林农村信用社','no.png',0),(21,1,'黑龙江农村商业银行','no.png',0);
/*!40000 ALTER TABLE `tb_banklist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_bot_address_jt`
--

DROP TABLE IF EXISTS `tb_bot_address_jt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_bot_address_jt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin` varchar(32) NOT NULL COMMENT '应用',
  `bot` varchar(32) NOT NULL COMMENT '机器人',
  `username` varchar(32) NOT NULL COMMENT '用户',
  `tgid` bigint(20) NOT NULL COMMENT '用户id',
  `coin` char(4) NOT NULL COMMENT '币',
  `address` char(48) NOT NULL COMMENT '地址',
  PRIMARY KEY (`id`),
  KEY `coin` (`coin`),
  KEY `address` (`address`),
  KEY `tgid` (`tgid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bot_address_jt`
--

LOCK TABLES `tb_bot_address_jt` WRITE;
/*!40000 ALTER TABLE `tb_bot_address_jt` DISABLE KEYS */;
INSERT INTO `tb_bot_address_jt` VALUES (1,'trxbot','SwapTRX8bot','',5677571362,'USDT','TAzsQ9Gx8eqFNFSKbeXrbi45CuVPHzA8wr');
/*!40000 ALTER TABLE `tb_bot_address_jt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_bot_channel`
--

DROP TABLE IF EXISTS `tb_bot_channel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_bot_channel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(1) NOT NULL,
  `plugin` varchar(16) NOT NULL,
  `bot` varchar(32) NOT NULL,
  `pid` bigint(20) NOT NULL,
  `title` varchar(64) NOT NULL,
  `info` json NOT NULL,
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bot` (`bot`),
  KEY `time` (`time`),
  KEY `pid` (`pid`),
  KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bot_channel`
--

LOCK TABLES `tb_bot_channel` WRITE;
/*!40000 ALTER TABLE `tb_bot_channel` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_bot_channel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_bot_comclass`
--

DROP TABLE IF EXISTS `tb_bot_comclass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_bot_comclass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin` varchar(16) NOT NULL,
  `del` int(1) NOT NULL,
  `chatType` varchar(16) NOT NULL DEFAULT 'private',
  `name` varchar(16) NOT NULL COMMENT '名称',
  `class` varchar(32) NOT NULL COMMENT '参数',
  `place` varchar(16) NOT NULL COMMENT '提示',
  `value` varchar(88) NOT NULL COMMENT '值',
  `yes` int(1) NOT NULL COMMENT '必须',
  PRIMARY KEY (`id`),
  KEY `plugin` (`plugin`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bot_comclass`
--

LOCK TABLES `tb_bot_comclass` WRITE;
/*!40000 ALTER TABLE `tb_bot_comclass` DISABLE KEYS */;
INSERT INTO `tb_bot_comclass` VALUES (1,'keepbot',0,'all','打开url','url','上面示例输入后(自己修改)','https://',1),(2,'keepbot',0,'all','联系用户飞机','lianxiren','飞机用户名不要加@','gd801',1),(3,'keepbot',0,'all','登录网址(需设定Domain)','login_url','需与机器人Domain一致','',1),(4,'keepbot',0,'all','添加机器人进群','group','','',0),(5,'keepbot',0,'all','按钮点击事件','callback_data','按钮发送data(开发者)','',1),(6,'keepbot',0,'supergroup','@机器人','switch_inline_query_current_chat','@机器人时附加输入的文字','',1),(7,'keepbot',0,'all','分享机器人','switch_inline_query','','',0),(8,'keepbot',0,'private','打开小程序','web_app','小程序地址(https://)','',1),(9,'keepbot',0,'supergroup','查看网页账单','excel','不需要输入值','',0),(10,'trxbot',0,'all','打开url','url','上面示例输入后(自己修改)','https://',1),(11,'trxbot',0,'all','联系用户飞机','lianxiren','飞机用户名不要加@','gd801',1),(12,'trxbot',0,'all','登录网址(需设定Domain)','login_url','需与机器人Domain一致','',1),(13,'trxbot',0,'all','添加机器人进群','group','','',0),(14,'trxbot',0,'all','按钮点击事件','callback_data','按钮发送data(开发者)','',1),(15,'trxbot',0,'supergroup','@机器人','switch_inline_query_current_chat','@机器人时附加输入的文字','',1),(16,'trxbot',0,'all','分享机器人','switch_inline_query','','',0),(17,'trxbot',0,'private','打开小程序','web_app','小程序地址(https://)','',1),(18,'adminbot',0,'all','打开url','url','上面示例输入后(自己修改)','https://',1),(19,'adminbot',0,'all','联系用户飞机','lianxiren','飞机用户名不要加@','gd801',1),(20,'adminbot',0,'all','登录网址(需设定Domain)','login_url','需与机器人Domain一致','',1),(21,'adminbot',0,'all','添加机器人进群','group','','',0),(22,'adminbot',0,'all','按钮点击事件','callback_data','按钮发送data(开发者)','',1),(23,'adminbot',0,'supergroup','@机器人','switch_inline_query_current_chat','@机器人时附加输入的文字','',1),(24,'adminbot',0,'all','分享机器人','switch_inline_query','','',0),(25,'adminbot',0,'private','打开小程序','web_app','小程序地址(https://)','',1);
/*!40000 ALTER TABLE `tb_bot_comclass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_bot_commands`
--

DROP TABLE IF EXISTS `tb_bot_commands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_bot_commands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(1) NOT NULL,
  `bot` varchar(32) NOT NULL,
  `parentId` int(1) NOT NULL COMMENT '层级',
  `command` varchar(10) NOT NULL,
  `description` varchar(64) NOT NULL,
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '1菜单命令2其它事件',
  `mtype` varchar(16) NOT NULL DEFAULT 'sendMessage' COMMENT 'sendPhoto,sendMessage',
  `chatType` varchar(16) NOT NULL DEFAULT 'private' COMMENT '私人群组频道',
  `photo` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `istext` int(1) NOT NULL DEFAULT '1' COMMENT '允许text',
  `reply_markup` varchar(16) NOT NULL DEFAULT 'inline_keyboard',
  PRIMARY KEY (`id`),
  KEY `bot` (`bot`),
  KEY `del` (`del`),
  KEY `command` (`command`),
  KEY `type` (`type`),
  KEY `chatType` (`chatType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='保留1 2';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bot_commands`
--

LOCK TABLES `tb_bot_commands` WRITE;
/*!40000 ALTER TABLE `tb_bot_commands` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_bot_commands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_bot_comtype`
--

DROP TABLE IF EXISTS `tb_bot_comtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_bot_comtype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin` varchar(16) NOT NULL COMMENT '所属应用',
  `chatType` varchar(16) NOT NULL DEFAULT 'supergroup',
  `command` varchar(16) NOT NULL COMMENT '事件名称',
  `tips` varchar(50) NOT NULL,
  `ismsg` int(1) NOT NULL DEFAULT '1' COMMENT '允许设定消息?',
  PRIMARY KEY (`id`),
  KEY `plugin` (`plugin`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bot_comtype`
--

LOCK TABLES `tb_bot_comtype` WRITE;
/*!40000 ALTER TABLE `tb_bot_comtype` DISABLE KEYS */;
INSERT INTO `tb_bot_comtype` VALUES (1,'keepbot','supergroup','机器人进群','自定义机器人进群时的提示消息内容和按钮',1),(2,'keepbot','supergroup','成为管理员','自定义机器人被设定为管理员时的消息和按钮',1),(3,'keepbot','supergroup','设置费率','自定义设置费率成功时的消息和按钮',1),(4,'keepbot','supergroup','设置汇率','自定义设置汇率成功时的消息和按钮',1),(5,'keepbot','supergroup','账单通用','自定义(加款,下发,显示账单等)时的按钮(不支持自定义消息)',0),(6,'keepbot','private','推广成功 - 待开发','推广别人使用机器人成功时的消息和按钮',1),(7,'trxbot','supergroup','机器人进群','自定义机器人进群时的提示消息内容和按钮',1),(8,'trxbot','supergroup','成为管理员','自定义机器人被设定为管理员时的消息和按钮',1),(9,'keepbot','supergroup','用户进群','定义用户进群欢迎语',0),(10,'trxbot','supergroup','新用户进群','设置新用户进群欢迎语消息按钮',0),(11,'trxbot','supergroup','群定时广告','设置群定时广告消息下方按钮',0);
/*!40000 ALTER TABLE `tb_bot_comtype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_bot_group`
--

DROP TABLE IF EXISTS `tb_bot_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_bot_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(1) NOT NULL,
  `plugin` varchar(32) NOT NULL,
  `bot` varchar(16) NOT NULL,
  `groupid` bigint(20) NOT NULL,
  `admin` int(1) NOT NULL COMMENT '?管理员',
  `grouptitle` varchar(64) NOT NULL,
  `groupname` varchar(32) NOT NULL,
  `send` int(1) NOT NULL,
  `vip` int(1) NOT NULL,
  `welcome` text NOT NULL,
  `hyimg` varchar(255) NOT NULL,
  `adtime` int(11) NOT NULL DEFAULT '0',
  `adtext` text NOT NULL,
  `images` varchar(255) NOT NULL COMMENT '图片地址',
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bot` (`bot`),
  KEY `groupid` (`groupid`),
  KEY `send` (`send`),
  KEY `plugin` (`plugin`),
  KEY `groupid_2` (`groupid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='机器人加群表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bot_group`
--

LOCK TABLES `tb_bot_group` WRITE;
/*!40000 ALTER TABLE `tb_bot_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_bot_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_bot_group_user`
--

DROP TABLE IF EXISTS `tb_bot_group_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_bot_group_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(1) NOT NULL,
  `qunid` bigint(20) NOT NULL COMMENT '群ID',
  `quninfo` json NOT NULL COMMENT '群信息',
  `userid` bigint(20) NOT NULL COMMENT '用户ID',
  `userinfo` json NOT NULL COMMENT '用户信息',
  `ufrom` json NOT NULL COMMENT '邀请人',
  `tfrom` json NOT NULL,
  `cretae_time` int(10) NOT NULL COMMENT '进入时间',
  `exit_time` int(10) NOT NULL COMMENT '退群时间',
  PRIMARY KEY (`id`),
  KEY `qunid` (`qunid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='群用户';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bot_group_user`
--

LOCK TABLES `tb_bot_group_user` WRITE;
/*!40000 ALTER TABLE `tb_bot_group_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_bot_group_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_bot_list`
--

DROP TABLE IF EXISTS `tb_bot_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_bot_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zt` int(1) NOT NULL DEFAULT '1',
  `plugin` varchar(32) NOT NULL,
  `API_BOT` varchar(32) NOT NULL COMMENT '机器用户名',
  `WEB_URL` varchar(64) NOT NULL COMMENT '部署域名',
  `WEB_IP` varchar(15) NOT NULL COMMENT '部署IP',
  `API_URL` varchar(64) NOT NULL DEFAULT 'https://api.telegram.org/bot' COMMENT '电报API',
  `API_TOKEN` varchar(64) NOT NULL COMMENT '机器人TOKEN',
  `Admin` bigint(11) NOT NULL DEFAULT '1418208536' COMMENT '管理员ID',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `outime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `zt` (`zt`),
  KEY `API_BOT` (`API_BOT`),
  KEY `plugin` (`plugin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bot_list`
--

LOCK TABLES `tb_bot_list` WRITE;
/*!40000 ALTER TABLE `tb_bot_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_bot_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_bot_log_jie`
--

DROP TABLE IF EXISTS `tb_bot_log_jie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_bot_log_jie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(1) NOT NULL,
  `plugin` varchar(16) NOT NULL,
  `bot` varchar(32) NOT NULL,
  `auto` int(1) NOT NULL COMMENT '模式0自动1手动',
  `type` int(1) NOT NULL COMMENT '1借2还',
  `money` decimal(12,2) NOT NULL COMMENT '数量',
  `address` varchar(48) NOT NULL,
  `zt` int(1) NOT NULL COMMENT '1成功2失败',
  `hash` varchar(64) NOT NULL,
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='预支记录';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bot_log_jie`
--

LOCK TABLES `tb_bot_log_jie` WRITE;
/*!40000 ALTER TABLE `tb_bot_log_jie` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_bot_log_jie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_bot_log_sunswap`
--

DROP TABLE IF EXISTS `tb_bot_log_sunswap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_bot_log_sunswap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(1) NOT NULL,
  `plugin` varchar(16) NOT NULL,
  `bot` varchar(32) NOT NULL,
  `qudao` varchar(16) NOT NULL COMMENT '渠道',
  `address` varchar(34) NOT NULL COMMENT '地址',
  `usdt` bigint(20) NOT NULL,
  `trx` bigint(20) NOT NULL COMMENT '数量',
  `zt` int(1) NOT NULL COMMENT '0提交 1成功 2失败',
  `msg` varchar(64) NOT NULL,
  `hash` varchar(64) NOT NULL,
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='预支记录';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bot_log_sunswap`
--

LOCK TABLES `tb_bot_log_sunswap` WRITE;
/*!40000 ALTER TABLE `tb_bot_log_sunswap` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_bot_log_sunswap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_bot_markup`
--

DROP TABLE IF EXISTS `tb_bot_markup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_bot_markup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(1) NOT NULL,
  `bot` varchar(32) NOT NULL,
  `comId` int(8) NOT NULL COMMENT '事件ID\r\n',
  `chatType` varchar(16) NOT NULL COMMENT '群组 私人',
  `type` varchar(32) NOT NULL,
  `aid` int(11) NOT NULL,
  `sortId` int(11) NOT NULL,
  `text` varchar(32) NOT NULL,
  `class` varchar(32) NOT NULL,
  `url` varchar(64) NOT NULL,
  `web_app` varchar(64) NOT NULL,
  `login_url` varchar(64) NOT NULL,
  `callback_data` varchar(64) NOT NULL,
  `switch_inline_query` varchar(64) NOT NULL,
  `switch_inline_query_current_chat` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `chatType` (`chatType`),
  KEY `aid` (`aid`),
  KEY `comId` (`comId`),
  KEY `bot` (`bot`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bot_markup`
--

LOCK TABLES `tb_bot_markup` WRITE;
/*!40000 ALTER TABLE `tb_bot_markup` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_bot_markup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_bot_set`
--

DROP TABLE IF EXISTS `tb_bot_set`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_bot_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(11) NOT NULL,
  `plugin` varchar(16) NOT NULL COMMENT '应用',
  `zt` int(1) NOT NULL COMMENT '状态',
  `name` varchar(32) NOT NULL COMMENT '名称',
  `class` varchar(48) NOT NULL,
  `color` varchar(16) NOT NULL,
  `tips` text NOT NULL COMMENT '说明',
  `time` int(10) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`),
  KEY `plugin` (`plugin`),
  KEY `name` (`name`),
  KEY `zt` (`zt`),
  KEY `name_2` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bot_set`
--

LOCK TABLES `tb_bot_set` WRITE;
/*!40000 ALTER TABLE `tb_bot_set` DISABLE KEYS */;
INSERT INTO `tb_bot_set` VALUES (2,0,'trxbot',1,'自动预支TRX','myico myico-TRX hong','zi','开启后用户将可以自动预支trx<br>请在：兑换管理>预支TRX 设定详细参数',1676717537),(3,0,'trxbot',1,'进群自动欢迎','el-icon-chat-line-round jiacu molv','molv','有新的用户进群时将自动发送欢迎语<br>\n需要在：群组管理 >设定欢迎内容',1676717537),(4,0,'trxbot',1,'群内定时广告','el-icon-chat-dot-round jiacu hong','cheng','开启后机器人所在群将定时发送广告<br>\n请在：群组管理 > 设定广告内容+时间',1676717537),(5,0,'trxbot',1,'机器人小程序功能','el-icon-_menu jiacu lan','lan','机器人是否启用小程序功能(关闭=菜单)<br>\n电报限制该功能<b>5分钟只能修改1次</b>',1676717537),(6,0,'trxbot',1,'TRX不足自动闪兑','el-icon-_flash  jiacu hong','hong','当钱包TRX余额不足时<br>\n自动在链上购买补充TRX余额',1676717537);
/*!40000 ALTER TABLE `tb_bot_set` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_bot_total_d`
--

DROP TABLE IF EXISTS `tb_bot_total_d`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_bot_total_d` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(1) NOT NULL,
  `dated` int(11) NOT NULL,
  `bot` varchar(32) NOT NULL,
  `user` int(11) NOT NULL,
  `tguser` int(11) NOT NULL,
  `numu` int(11) NOT NULL,
  `usdt` bigint(20) NOT NULL,
  `numt` int(11) NOT NULL,
  `trx` bigint(20) NOT NULL,
  `jie` decimal(12,2) NOT NULL,
  `huan` decimal(12,2) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `del` (`del`),
  KEY `dated` (`dated`),
  KEY `bot` (`bot`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bot_total_d`
--

LOCK TABLES `tb_bot_total_d` WRITE;
/*!40000 ALTER TABLE `tb_bot_total_d` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_bot_total_d` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_bot_total_h`
--

DROP TABLE IF EXISTS `tb_bot_total_h`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_bot_total_h` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(1) NOT NULL,
  `dateh` int(11) NOT NULL,
  `bot` varchar(32) NOT NULL,
  `botid` int(11) NOT NULL,
  `numu` int(11) NOT NULL,
  `usdt` bigint(20) NOT NULL,
  `numt` int(11) NOT NULL,
  `trx` bigint(20) NOT NULL,
  `jie` decimal(12,2) NOT NULL,
  `huan` decimal(12,2) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `del` (`del`),
  KEY `dateh` (`dateh`),
  KEY `bot` (`bot`),
  KEY `botid` (`botid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bot_total_h`
--

LOCK TABLES `tb_bot_total_h` WRITE;
/*!40000 ALTER TABLE `tb_bot_total_h` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_bot_total_h` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_bot_total_tg`
--

DROP TABLE IF EXISTS `tb_bot_total_tg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_bot_total_tg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bot` varchar(32) NOT NULL,
  `tgid` bigint(20) NOT NULL,
  `date` int(8) NOT NULL,
  `time` int(11) NOT NULL,
  `tgnum` int(11) NOT NULL,
  `account` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bot` (`bot`),
  KEY `date` (`date`),
  KEY `tgid` (`tgid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='每日推广统计表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bot_total_tg`
--

LOCK TABLES `tb_bot_total_tg` WRITE;
/*!40000 ALTER TABLE `tb_bot_total_tg` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_bot_total_tg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_bot_total_trc20`
--

DROP TABLE IF EXISTS `tb_bot_total_trc20`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_bot_total_trc20` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(11) NOT NULL,
  `bot` varchar(32) NOT NULL,
  `tgid` bigint(20) NOT NULL,
  `disable` int(1) NOT NULL COMMENT '黑名单',
  `trc20` varchar(34) NOT NULL,
  `send` int(1) NOT NULL,
  `numu` int(11) NOT NULL,
  `usdt` bigint(20) NOT NULL,
  `numt` int(11) NOT NULL,
  `trx` bigint(20) NOT NULL,
  `loan` decimal(12,2) NOT NULL COMMENT '贷款',
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `trc20` (`trc20`),
  KEY `del` (`del`),
  KEY `tgid` (`tgid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bot_total_trc20`
--

LOCK TABLES `tb_bot_total_trc20` WRITE;
/*!40000 ALTER TABLE `tb_bot_total_trc20` DISABLE KEYS */;
INSERT INTO `tb_bot_total_trc20` VALUES (1,0,'SwapTRX8bot',0,0,'TJiEqLhLs567W3yu7h6XAHe6uBNe888888',0,6,8000000,0,0,0.00,1678716003),(2,0,'SwapTRX8bot',5677571362,0,'TK9T9TLLRos6jdjKp9ELDvPEQ6Ng355555',1,1,1000000,0,0,0.00,1689516171),(3,0,'SwapTRX8bot',5650195126,0,'TGBu2pkBbaTc4qCoynfWeuGAHaKaW3S99b',0,0,0,0,0,0.00,1683021449),(4,0,'SwapTRX8bot',0,0,'TCzncA8y8dqzjaXJLhqdSGdqurYyyyyyyy',0,0,0,0,0,0.00,1687182434),(5,0,'SwapTRX8bot',5616335773,0,'TKmCag1by9tDTiQAGzFbz2u7Af4j8YZ5p5',1,0,0,0,0,0.00,1688310660),(6,0,'SwapTRX8bot',5616335773,0,'TB2qmcuSVrHSccxRYXAMkqV4PjCKJYZeJi',0,0,0,0,0,0.00,1688311489),(7,0,'SwapTRX8bot',1910217242,0,'TYfikhjnoQALuPvoBnwxPtfeJYiL777777',0,0,0,0,0,0.00,1689038632),(8,0,'SwapTRX8bot',5677571362,1,'TQLC5nE2aYdLhBC7o4i188NHp966666666',1,0,0,1,8000000,6.00,1689962793),(10,0,'SwapTRX8bot',0,0,'TVTcpRMShofqg3MtL4ZN1Xf7v477777777',0,0,0,0,0,0.00,1690041022),(11,0,'SwapTRX8bot',0,0,'TFCJWa1d1W9C5UpCAg1hX1NrpR66666666',0,0,0,0,0,0.00,1690077263),(12,0,'SwapTRX8bot',0,0,'TUGkkbCjCsBqmESjkrDP8be7k1zMoGCkSs',0,0,0,0,0,0.00,1690085195);
/*!40000 ALTER TABLE `tb_bot_total_trc20` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_bot_usdt_list`
--

DROP TABLE IF EXISTS `tb_bot_usdt_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_bot_usdt_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(1) NOT NULL,
  `bot` varchar(32) NOT NULL,
  `txid` varchar(64) NOT NULL,
  `ufrom` varchar(34) NOT NULL,
  `uto` varchar(34) NOT NULL,
  `value` bigint(20) NOT NULL,
  `time` int(10) NOT NULL,
  `huilv` decimal(10,2) NOT NULL,
  `oktxid` varchar(64) NOT NULL,
  `huan` decimal(12,2) NOT NULL COMMENT '还款数量',
  `oktrx` decimal(10,2) NOT NULL,
  `okzt` int(1) NOT NULL,
  `msg` varchar(64) NOT NULL,
  `oktime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `txid_2` (`txid`),
  KEY `bot` (`bot`),
  KEY `txid` (`txid`),
  KEY `zt` (`okzt`),
  KEY `oktxid` (`oktxid`),
  KEY `ufrom` (`ufrom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='usdt收款列表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bot_usdt_list`
--

LOCK TABLES `tb_bot_usdt_list` WRITE;
/*!40000 ALTER TABLE `tb_bot_usdt_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_bot_usdt_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_bot_vip_paylog`
--

DROP TABLE IF EXISTS `tb_bot_vip_paylog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_bot_vip_paylog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin` varchar(32) NOT NULL,
  `bot` varchar(32) NOT NULL,
  `user` varchar(32) NOT NULL,
  `name` varchar(64) NOT NULL,
  `num` int(11) NOT NULL,
  `amout` bigint(20) NOT NULL,
  `time` int(11) NOT NULL,
  `oktime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bot_vip_paylog`
--

LOCK TABLES `tb_bot_vip_paylog` WRITE;
/*!40000 ALTER TABLE `tb_bot_vip_paylog` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_bot_vip_paylog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_bot_vip_setup`
--

DROP TABLE IF EXISTS `tb_bot_vip_setup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_bot_vip_setup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin` varchar(16) NOT NULL,
  `bot` varchar(32) NOT NULL,
  `hash` varchar(32) NOT NULL,
  `cookie` json DEFAULT NULL,
  `3` decimal(10,2) NOT NULL DEFAULT '15.00',
  `6` decimal(10,2) NOT NULL DEFAULT '30.00',
  `12` decimal(10,2) NOT NULL DEFAULT '55.00',
  `24` decimal(10,2) NOT NULL DEFAULT '100.00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `bot` (`bot`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bot_vip_setup`
--

LOCK TABLES `tb_bot_vip_setup` WRITE;
/*!40000 ALTER TABLE `tb_bot_vip_setup` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_bot_vip_setup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_bot_vip_userlist`
--

DROP TABLE IF EXISTS `tb_bot_vip_userlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_bot_vip_userlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(32) NOT NULL,
  `name` varchar(64) NOT NULL,
  `rec` varchar(64) NOT NULL,
  `photo` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bot_vip_userlist`
--

LOCK TABLES `tb_bot_vip_userlist` WRITE;
/*!40000 ALTER TABLE `tb_bot_vip_userlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_bot_vip_userlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_bot_xufei_log`
--

DROP TABLE IF EXISTS `tb_bot_xufei_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_bot_xufei_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin` varchar(16) NOT NULL COMMENT '插件',
  `bot` varchar(32) NOT NULL COMMENT '续费机器人',
  `tgid` bigint(20) NOT NULL COMMENT '发起人TGID',
  `msgid` int(11) NOT NULL,
  `addr` varchar(34) NOT NULL COMMENT '收款地址',
  `payaddr` varchar(34) NOT NULL COMMENT '付款人地址',
  `txid` varchar(64) NOT NULL,
  `zt` int(1) NOT NULL COMMENT '状态',
  `tday` int(11) NOT NULL COMMENT '续费时长',
  `money` decimal(12,2) NOT NULL COMMENT '订单金额',
  `time` int(10) NOT NULL COMMENT '创建时间',
  `oktime` int(10) NOT NULL COMMENT '成功时间',
  PRIMARY KEY (`id`),
  KEY `bot` (`bot`),
  KEY `tgid` (`tgid`),
  KEY `zt` (`zt`),
  KEY `plugin` (`plugin`),
  KEY `txid` (`txid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bot_xufei_log`
--

LOCK TABLES `tb_bot_xufei_log` WRITE;
/*!40000 ALTER TABLE `tb_bot_xufei_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_bot_xufei_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_douyin`
--

DROP TABLE IF EXISTS `tb_douyin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_douyin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ddid` int(11) NOT NULL,
  `post` text NOT NULL,
  `data` varchar(50) NOT NULL,
  `sporder` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_douyin`
--

LOCK TABLES `tb_douyin` WRITE;
/*!40000 ALTER TABLE `tb_douyin` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_douyin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_err_order`
--

DROP TABLE IF EXISTS `tb_err_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_err_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(11) NOT NULL DEFAULT '0',
  `myid` int(11) NOT NULL DEFAULT '0',
  `upid` int(11) NOT NULL,
  `upname` varchar(16) NOT NULL,
  `errid` int(11) NOT NULL,
  `paycode` int(11) NOT NULL DEFAULT '0',
  `AA` varchar(64) DEFAULT NULL,
  `BB` varchar(64) DEFAULT NULL,
  `time` int(11) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_err_order`
--

LOCK TABLES `tb_err_order` WRITE;
/*!40000 ALTER TABLE `tb_err_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_err_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_ipsafe`
--

DROP TABLE IF EXISTS `tb_ipsafe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_ipsafe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `myid` int(11) NOT NULL COMMENT 'myid',
  `type` int(11) NOT NULL COMMENT '1登录2请求3代付',
  `ip` text NOT NULL COMMENT 'ip内容',
  `url` text NOT NULL COMMENT '白名单url',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `myid` (`myid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_ipsafe`
--

LOCK TABLES `tb_ipsafe` WRITE;
/*!40000 ALTER TABLE `tb_ipsafe` DISABLE KEYS */;
INSERT INTO `tb_ipsafe` VALUES (1,100011,1,'34.87.0.62#18.162.148.132#156.255.88.36#183.232.227.251#52.229.184.189#35.241.83.81#183.232.227.240',''),(2,100013,1,'223.119.193.154,103.243.180.140,203.168.226.130,203.168.226.2',''),(3,100020,1,'35.220.245.31#8.219.137.69',''),(4,100020,2,'34.81.26.140,175.100.205.123,103.148.147.1',''),(5,100020,3,'103.148.147.1#20.205.8.45#20.205.97.214',''),(6,100035,3,'16.163.37.5,#18.167.7.208,16.162.211.53,34.92.38.237,35.220.203.65,18.162.111.169,16.162.100.149,34.92.79.190,34.92.73.159,18.163.186.123,18.162.50.230,34.92.212.85,34.150.68.87\r\n\r\n','https://callback.jptxcallbackac.com/thirdwithdraw/withdraw/verify  https://callback.jptxcallbackab.com/thirdwithdraw/withdraw/verify  https://callback.jptxcallbackbc.com/thirdwithdraw/withdraw/verify  https://callback.jiantxcallbackac.com/thirdwithdraw/withdraw/verify https://callback.jiantxcallbackbc.com/thirdwithdraw/withdraw/verify https://callback.jiantxcallbackab.com/thirdwithdraw/withdraw/verify  https://callback.skgtxcallbackac.com/thirdwithdraw/withdraw/verify https://callback.skgtxcallbackbc.com/thirdwithdraw/withdraw/verify https://callback.skgtxcallbackab.com/thirdwithdraw/withdraw/verify  '),(7,100036,3,'16.163.37.5,#18.167.7.208,16.162.211.53,34.92.38.237,35.220.203.65,18.162.111.169,16.162.100.149,34.92.79.190,34.92.73.159,18.163.186.123,18.162.50.230,34.92.212.85,34.150.68.87\r\n\r\n',''),(8,100039,1,'*.*.*.*','');
/*!40000 ALTER TABLE `tb_ipsafe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_keep_log`
--

DROP TABLE IF EXISTS `tb_keep_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_keep_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(1) NOT NULL,
  `qunid` bigint(20) NOT NULL,
  `did` int(11) NOT NULL COMMENT '日记录ID',
  `huilv` decimal(10,2) NOT NULL,
  `feilv` decimal(10,2) NOT NULL,
  `def` decimal(12,2) NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `usdt` decimal(10,2) NOT NULL,
  `from` varchar(32) NOT NULL COMMENT '操作人',
  `reply` json NOT NULL,
  `time` int(11) NOT NULL,
  `date` int(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `qunid` (`qunid`),
  KEY `time` (`time`),
  KEY `del` (`del`),
  KEY `did` (`did`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_keep_log`
--

LOCK TABLES `tb_keep_log` WRITE;
/*!40000 ALTER TABLE `tb_keep_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_keep_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_keep_logc`
--

DROP TABLE IF EXISTS `tb_keep_logc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_keep_logc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(1) NOT NULL,
  `qunid` bigint(20) NOT NULL,
  `did` int(11) NOT NULL COMMENT '日记录ID',
  `type` int(1) NOT NULL COMMENT '出款类型0u 1人民币',
  `huilv` decimal(10,2) NOT NULL COMMENT '汇率',
  `usdt` decimal(12,2) NOT NULL COMMENT 'usdt数量',
  `money` decimal(12,2) NOT NULL COMMENT '人民币数量',
  `from` varchar(16) NOT NULL,
  `reply` json NOT NULL,
  `time` int(11) NOT NULL,
  `date` int(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `qunid` (`qunid`),
  KEY `time` (`time`),
  KEY `del` (`del`),
  KEY `did` (`did`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_keep_logc`
--

LOCK TABLES `tb_keep_logc` WRITE;
/*!40000 ALTER TABLE `tb_keep_logc` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_keep_logc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_keep_setup`
--

DROP TABLE IF EXISTS `tb_keep_setup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_keep_setup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bot` varchar(32) NOT NULL,
  `qunid` bigint(20) NOT NULL,
  `info` json DEFAULT NULL,
  `huilv` decimal(10,2) NOT NULL,
  `sshuilv` int(1) NOT NULL COMMENT '实时汇率',
  `dangwei` int(1) NOT NULL DEFAULT '1',
  `weitiao` decimal(4,2) NOT NULL COMMENT '微调',
  `feilv` decimal(10,2) NOT NULL,
  `rmb` int(1) NOT NULL DEFAULT '1' COMMENT '显示人民币',
  `decmoshi` int(1) NOT NULL COMMENT '出款模式0u 1人民币',
  `admin` varchar(255) NOT NULL COMMENT '管理员',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `bot` (`bot`),
  KEY `qunid` (`qunid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_keep_setup`
--

LOCK TABLES `tb_keep_setup` WRITE;
/*!40000 ALTER TABLE `tb_keep_setup` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_keep_setup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_keep_total`
--

DROP TABLE IF EXISTS `tb_keep_total`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_keep_total` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(1) NOT NULL,
  `save` int(1) NOT NULL DEFAULT '0' COMMENT '储存',
  `qunid` bigint(20) NOT NULL COMMENT '群ID',
  `info` json DEFAULT NULL,
  `date` int(8) NOT NULL COMMENT '时间表达',
  `incnum` int(11) NOT NULL COMMENT '入款笔数',
  `defmoney` decimal(12,2) NOT NULL,
  `incmoney` decimal(12,2) NOT NULL COMMENT '入款money',
  `incusdt` decimal(12,2) NOT NULL COMMENT '入款usdt',
  `decnum` int(11) NOT NULL,
  `decmoney` decimal(12,2) NOT NULL,
  `decusdt` decimal(12,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `qunid` (`qunid`),
  KEY `date` (`date`),
  KEY `del` (`del`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_keep_total`
--

LOCK TABLES `tb_keep_total` WRITE;
/*!40000 ALTER TABLE `tb_keep_total` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_keep_total` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_keep_totalz`
--

DROP TABLE IF EXISTS `tb_keep_totalz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_keep_totalz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(1) NOT NULL,
  `qunid` bigint(20) NOT NULL COMMENT '群ID',
  `info` json DEFAULT NULL,
  `def` decimal(12,2) NOT NULL COMMENT '总金额(原始)',
  `num` int(11) NOT NULL COMMENT '总入款笔数',
  `money` decimal(12,2) NOT NULL COMMENT '应下发金额',
  `usdt` decimal(12,2) NOT NULL COMMENT '应下发usdt',
  `decnum` int(11) NOT NULL COMMENT '出款笔数',
  `decmoney` decimal(12,2) NOT NULL COMMENT '已下发money',
  `decusdt` decimal(12,2) NOT NULL COMMENT '已下发usdt',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '日期',
  `deltime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `qunid` (`qunid`),
  KEY `del` (`del`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_keep_totalz`
--

LOCK TABLES `tb_keep_totalz` WRITE;
/*!40000 ALTER TABLE `tb_keep_totalz` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_keep_totalz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_keep_user`
--

DROP TABLE IF EXISTS `tb_keep_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_keep_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(1) NOT NULL,
  `type` int(1) NOT NULL COMMENT '1正常2回复',
  `qunid` bigint(20) NOT NULL,
  `userid` bigint(20) NOT NULL,
  `username` varchar(32) NOT NULL,
  `num1` int(11) NOT NULL,
  `money1` decimal(14,2) NOT NULL,
  `num2` int(11) NOT NULL,
  `money2` decimal(14,2) NOT NULL,
  `date` int(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_keep_user`
--

LOCK TABLES `tb_keep_user` WRITE;
/*!40000 ALTER TABLE `tb_keep_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_keep_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_log`
--

DROP TABLE IF EXISTS `tb_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(1) NOT NULL,
  `type` varchar(16) NOT NULL,
  `uid` int(6) NOT NULL,
  `username` varchar(16) NOT NULL,
  `money` decimal(10,2) NOT NULL COMMENT '金额',
  `remark` text NOT NULL,
  `y` int(6) NOT NULL COMMENT '操作人id',
  `z` varchar(16) NOT NULL COMMENT '操作手',
  `time` int(11) NOT NULL,
  `date` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `type` (`type`),
  KEY `y` (`y`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_log`
--

LOCK TABLES `tb_log` WRITE;
/*!40000 ALTER TABLE `tb_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_message`
--

DROP TABLE IF EXISTS `tb_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(11) NOT NULL DEFAULT '0' COMMENT '显示',
  `myid` int(11) NOT NULL COMMENT '商户id',
  `type` varchar(8) NOT NULL COMMENT '消息类型',
  `title` varchar(32) NOT NULL COMMENT '标题',
  `class` varchar(16) NOT NULL COMMENT '颜色calss',
  `icon` varchar(32) NOT NULL COMMENT 'icon',
  `content` text COMMENT '私信内容',
  `avatar` varchar(100) DEFAULT NULL COMMENT '私信头像',
  `status` int(11) NOT NULL DEFAULT '2' COMMENT '待办状态',
  `description` varchar(32) DEFAULT NULL COMMENT '待办日期',
  `time` int(11) NOT NULL COMMENT '时间',
  `read` int(11) NOT NULL DEFAULT '0' COMMENT '已阅',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `myid` (`myid`),
  KEY `type` (`type`),
  KEY `read` (`read`),
  KEY `show` (`del`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_message`
--

LOCK TABLES `tb_message` WRITE;
/*!40000 ALTER TABLE `tb_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_money_log`
--

DROP TABLE IF EXISTS `tb_money_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_money_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `myid` int(11) NOT NULL COMMENT '商户id',
  `upid` int(11) NOT NULL COMMENT '码商id',
  `upname` varchar(16) NOT NULL COMMENT '码商账号',
  `sub` varchar(16) NOT NULL COMMENT '操作员',
  `type` int(11) NOT NULL COMMENT '类型',
  `source` varchar(66) NOT NULL,
  `remark` varchar(88) NOT NULL COMMENT '说明',
  `end` decimal(10,2) NOT NULL COMMENT '变动后',
  `del` int(11) NOT NULL COMMENT '删除',
  `go` decimal(10,2) NOT NULL COMMENT '变动前',
  `money` decimal(10,2) NOT NULL COMMENT '变动金额',
  `sxf` decimal(10,2) NOT NULL,
  `time` int(11) NOT NULL COMMENT '时间戳',
  PRIMARY KEY (`id`),
  KEY `del` (`del`),
  KEY `myid` (`myid`),
  KEY `upid` (`upid`),
  KEY `upname` (`upname`),
  KEY `type` (`type`),
  KEY `time` (`time`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_money_log`
--

LOCK TABLES `tb_money_log` WRITE;
/*!40000 ALTER TABLE `tb_money_log` DISABLE KEYS */;
INSERT INTO `tb_money_log` VALUES (1,100016,100001,'111222','',3,'1_农业银行(王思聪*4555)','人工加款|无',100.00,0,0.00,100.00,0.00,1682338867),(2,100001,100016,'111222','',3,'加款通道|1_农业银行(王思聪*4555)','人工加款|无',5500.00,0,5400.00,100.00,1.38,1682338867),(3,100070,0,'','123456',1,'','补发订单|082713524923',3500.00,0,0.00,3500.00,48.30,1689865810),(4,100001,0,'','123456',1,'','补发订单|082713524923',9000.00,0,5500.00,3500.00,48.30,1689865810),(5,100070,0,'','123456',1,'','补发订单|212872770170',5000.00,0,3500.00,1500.00,20.70,1689865812),(6,100001,0,'','123456',1,'','补发订单|212872770170',10500.00,0,9000.00,1500.00,20.70,1689865812),(7,100070,0,'','123456',1,'','补发订单|955518566762',13000.00,0,5000.00,8000.00,110.40,1689865813),(8,100001,0,'','123456',1,'','补发订单|955518566762',18500.00,0,10500.00,8000.00,110.40,1689865813),(9,100070,0,'','123456',1,'','补发订单|073076634748',16200.00,0,13000.00,3200.00,44.16,1689865820),(10,100001,0,'','123456',1,'','补发订单|073076634748',21700.00,0,18500.00,3200.00,44.16,1689865820),(11,100070,0,'','123456',1,'','补发订单|183526634827',18500.00,0,16200.00,2300.00,31.74,1689865821),(12,100001,0,'','123456',1,'','补发订单|183526634827',24000.00,0,21700.00,2300.00,31.74,1689865821),(13,100070,0,'','123456',1,'','补发订单|050368873833',23000.00,0,18500.00,4500.00,62.10,1689865822),(14,100001,0,'','123456',1,'','补发订单|050368873833',28500.00,0,24000.00,4500.00,62.10,1689865822),(15,100070,0,'','123456',1,'','补发订单|848895213651',30500.00,0,23000.00,7500.00,103.50,1689865824),(16,100001,0,'','123456',1,'','补发订单|848895213651',36000.00,0,28500.00,7500.00,103.50,1689865824),(17,100070,0,'','123456',1,'','补发订单|911978157300',31388.00,0,30500.00,888.00,12.25,1689865825),(18,100001,0,'','123456',1,'','补发订单|911978157300',36888.00,0,36000.00,888.00,12.25,1689865825),(19,100070,0,'','123456',1,'','补发订单|887841113443',33288.00,0,31388.00,1900.00,26.22,1689865827),(20,100001,0,'','123456',1,'','补发订单|887841113443',38788.00,0,36888.00,1900.00,26.22,1689865827),(21,100070,0,'','123456',1,'','补发订单|824492741357',33289.00,0,33288.00,1.00,0.01,1689865830),(22,100001,0,'','123456',1,'','补发订单|824492741357',38789.00,0,38788.00,1.00,0.01,1689865830),(23,100070,0,'','123456',1,'','补发订单|246945516384',33290.00,0,33289.00,1.00,0.01,1689865832),(24,100001,0,'','123456',1,'','补发订单|246945516384',38790.00,0,38789.00,1.00,0.01,1689865832),(25,100070,0,'','123456',1,'','补发订单|087787653281',35178.00,0,33290.00,1888.00,26.05,1689865852),(26,100001,0,'','123456',1,'','补发订单|087787653281',40678.00,0,38790.00,1888.00,26.05,1689865852),(27,100070,0,'','123456',1,'','补发订单|665361398917',38066.00,0,35178.00,2888.00,39.85,1689865854),(28,100001,0,'','123456',1,'','补发订单|665361398917',43566.00,0,40678.00,2888.00,39.85,1689865854),(29,100070,0,'','123456',1,'','补发订单|851867459589',39266.00,0,38066.00,1200.00,16.56,1689865893),(30,100001,0,'','123456',1,'','补发订单|851867459589',44766.00,0,43566.00,1200.00,16.56,1689865893),(31,100070,0,'','123456',1,'','补发订单|568204002505',45768.00,0,39266.00,6502.00,89.73,1689865895),(32,100001,0,'','123456',1,'','补发订单|568204002505',51268.00,0,44766.00,6502.00,89.73,1689865895);
/*!40000 ALTER TABLE `tb_money_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pay_lei`
--

DROP TABLE IF EXISTS `tb_pay_lei`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pay_lei` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL COMMENT '名字',
  `expire` int(11) NOT NULL DEFAULT '60',
  `inte` int(11) NOT NULL COMMENT '订单整数金额',
  `only` int(11) NOT NULL DEFAULT '0' COMMENT '金额回调模式',
  `sxf` decimal(13,2) NOT NULL COMMENT '费率',
  `smoney` decimal(13,2) NOT NULL COMMENT '单笔最小金额',
  `mmoney` decimal(13,2) NOT NULL COMMENT '单笔最小金额',
  `lmoney` decimal(12,2) NOT NULL DEFAULT '100000.00' COMMENT '超额停止',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pay_lei`
--

LOCK TABLES `tb_pay_lei` WRITE;
/*!40000 ALTER TABLE `tb_pay_lei` DISABLE KEYS */;
INSERT INTO `tb_pay_lei` VALUES (100,0,'卡卡收付',600,0,1,0.40,0.01,200000.00,2000000.00),(101,0,'个码转账',600,0,1,0.40,0.01,100000.00,1000000.00),(102,0,'抖币充值',200,0,0,2.00,1.00,10000.00,2000000.00);
/*!40000 ALTER TABLE `tb_pay_lei` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pay_log`
--

DROP TABLE IF EXISTS `tb_pay_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pay_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '标识ID',
  `del` int(11) NOT NULL DEFAULT '0',
  `upid` int(11) NOT NULL DEFAULT '0',
  `myid` int(11) NOT NULL,
  `zt` int(11) NOT NULL DEFAULT '0',
  `saoma` int(11) DEFAULT '0',
  `paycode` int(11) NOT NULL COMMENT '通道编号',
  `qdid` int(11) NOT NULL,
  `qdname` varchar(32) NOT NULL,
  `qdmsg` varchar(16) NOT NULL,
  `shopname` char(50) NOT NULL COMMENT '商品名称',
  `dingdan` varchar(38) NOT NULL COMMENT '订单号',
  `mqdd` char(64) NOT NULL COMMENT '免签订单',
  `gfdd` varchar(66) NOT NULL COMMENT '官方流水号',
  `token` varchar(64) NOT NULL COMMENT '标识',
  `money` decimal(10,2) NOT NULL COMMENT '订单金额',
  `bakmoney` decimal(12,2) NOT NULL COMMENT '递减金额',
  `okmoney` decimal(13,2) NOT NULL COMMENT '成功金额',
  `sxfmoney` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '手续费',
  `time` int(11) NOT NULL COMMENT '日期time',
  `oktime` int(11) NOT NULL COMMENT '付款回调成功时间',
  `notifyzt` int(11) NOT NULL DEFAULT '0' COMMENT '回调商户状态',
  `notifymsg` varchar(188) NOT NULL,
  `payurl` varchar(100) NOT NULL COMMENT '支付链接',
  `remark` varchar(64) NOT NULL,
  `returnurl` varchar(100) NOT NULL COMMENT '同步跳转地址',
  `notifyurl` char(255) NOT NULL COMMENT '商户回调URL',
  `ip` varchar(16) NOT NULL COMMENT '付款人IP',
  `ip3` varchar(11) NOT NULL,
  `sheng` varchar(12) NOT NULL COMMENT '省',
  `shi` varchar(12) NOT NULL COMMENT '市区',
  `system` int(11) NOT NULL,
  `ua` varchar(255) NOT NULL COMMENT 'ua',
  `qr` int(11) NOT NULL COMMENT 'qrID',
  `code` text NOT NULL COMMENT '数据',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `dingdan` (`dingdan`) USING BTREE,
  KEY `gfdd` (`gfdd`),
  KEY `time` (`time`),
  KEY `zt` (`zt`),
  KEY `qdid` (`qdid`),
  KEY `token` (`token`),
  KEY `mqdd` (`mqdd`),
  KEY `myid` (`myid`),
  KEY `upid` (`upid`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pay_log`
--

LOCK TABLES `tb_pay_log` WRITE;
/*!40000 ALTER TABLE `tb_pay_log` DISABLE KEYS */;
INSERT INTO `tb_pay_log` VALUES (1,0,0,100001,0,0,102,0,'','抖币充值','','623628292764','','','',1.00,0.00,0.00,0.00,1689865615,0,0,'无可用通道','','王思聪','http://www.baidu.com','http://103.143.81.108:8686/gate/notify/ok','','','','',0,'',0,''),(2,0,0,100001,0,0,102,0,'','抖币充值','','730599094024','','','',1.00,0.00,0.00,0.00,1689865718,0,0,'无可用通道','','王思聪','http://www.baidu.com','http://103.143.81.108:8686/gate/notify/ok','','','','',0,'',0,''),(3,0,100070,100001,2,0,100,2,'测试卡','卡卡收付','','824492741357','农业银行','','',1.00,0.00,1.00,0.01,1689865746,1689865830,0,'鉴权失败','http://0.0.0.0:8686/p/100l5','王思聪','http://www.baidu.com','http://103.143.81.108:8686/gate/notify/ok','','','','',0,'',5233,''),(4,0,100070,100001,2,0,100,3,'测试2','卡卡收付','','246945516384','四川农信','','',1.00,0.00,1.00,0.01,1689865748,1689865832,2,'补发','http://0.0.0.0:8686/p/100mO','王思聪','http://www.baidu.com','http://103.143.81.108:8686/gate/notify/ok','','','','',0,'',2222,''),(5,0,100070,100001,1,0,100,2,'测试卡','卡卡收付','','082713524923','农业银行','','',3500.00,0.00,3500.00,48.30,1689865754,1689865810,2,'补发','http://0.0.0.0:8686/p/100nR','王思聪','http://www.baidu.com','http://103.143.81.108:8686/gate/notify/ok','','','','',0,'',5233,''),(6,0,100070,100001,1,0,100,3,'测试2','卡卡收付','','212872770170','四川农信','','',1500.00,0.00,1500.00,20.70,1689865758,1689865812,2,'补发','http://0.0.0.0:8686/p/100oj','王思聪','http://www.baidu.com','http://103.143.81.108:8686/gate/notify/ok','','','','',0,'',2222,''),(7,0,100070,100001,1,0,100,2,'测试卡','卡卡收付','','955518566762','农业银行','','',8000.00,0.00,8000.00,110.40,1689865763,1689865813,2,'补发','http://0.0.0.0:8686/p/100p2','王思聪','http://www.baidu.com','http://103.143.81.108:8686/gate/notify/ok','','','','',0,'',5233,''),(8,0,100070,100001,1,0,100,3,'测试2','卡卡收付','','073076634748','四川农信','','',3200.00,0.00,3200.00,44.16,1689865767,1689865820,2,'补发','http://0.0.0.0:8686/p/100q2','王思聪','http://www.baidu.com','http://103.143.81.108:8686/gate/notify/ok','','','','',0,'',2222,''),(9,0,100070,100001,1,0,100,2,'测试卡','卡卡收付','','887841113443','农业银行','','',1900.00,0.00,1900.00,26.22,1689865771,1689865827,2,'补发','http://0.0.0.0:8686/p/100rE','王思聪','http://www.baidu.com','http://103.143.81.108:8686/gate/notify/ok','','','','',0,'',5233,''),(10,0,100070,100001,1,0,100,3,'测试2','卡卡收付','','183526634827','四川农信','','',2300.00,0.00,2300.00,31.74,1689865777,1689865821,2,'补发','http://0.0.0.0:8686/p/100vm','诸葛亮','http://www.baidu.com','http://103.143.81.108:8686/gate/notify/ok','','','','',0,'',2222,''),(11,0,100070,100001,1,0,100,2,'测试卡','卡卡收付','','050368873833','农业银行','','',4500.00,0.00,4500.00,62.10,1689865783,1689865822,0,'补发','http://0.0.0.0:8686/p/100wR','赵云','http://www.baidu.com','http://103.143.81.108:8686/gate/notify/ok','','','','',0,'',5233,''),(12,0,100070,100001,1,0,100,3,'测试2','卡卡收付','','848895213651','四川农信','','',7500.00,0.00,7500.00,103.50,1689865790,1689865824,2,'补发','http://0.0.0.0:8686/p/100x9','刘备','http://www.baidu.com','http://103.143.81.108:8686/gate/notify/ok','','','','',0,'',2222,''),(13,0,100070,100001,1,0,100,2,'测试卡','卡卡收付','','911978157300','农业银行','','',888.00,0.00,888.00,12.25,1689865797,1689865825,1,'补发','http://0.0.0.0:8686/p/100y7','张三','http://www.baidu.com','http://103.143.81.108:8686/gate/notify/ok','','','','',0,'',5233,''),(14,0,100070,100001,2,0,100,3,'测试2','卡卡收付','','087787653281','四川农信','','',1888.00,0.00,1888.00,26.05,1689865841,1689865852,1,'补发','http://0.0.0.0:8686/p/100zY','马化腾','http://www.baidu.com','http://103.143.81.108:8686/gate/notify/ok','','','','',0,'',2222,''),(15,0,100070,100001,1,0,100,2,'测试卡','卡卡收付','','665361398917','农业银行','','',2888.00,0.00,2888.00,39.85,1689865845,1689865854,2,'补发','http://0.0.0.0:8686/p/100AO','马化腾','http://www.baidu.com','http://103.143.81.108:8686/gate/notify/ok','','','','',0,'',5233,''),(16,0,100070,100001,1,0,100,3,'测试2','卡卡收付','','851867459589','四川农信','','',1200.00,0.00,1200.00,16.56,1689865871,1689865893,2,'补发','http://0.0.0.0:8686/p/100BX','','http://www.baidu.com','http://103.143.81.108:8686/gate/notify/ok','','','','',0,'',2222,''),(17,0,100070,100001,1,0,100,2,'测试卡','卡卡收付','','568204002505','农业银行','','',6502.00,0.00,6502.00,89.73,1689865882,1689865895,1,'补发','http://0.0.0.0:8686/p/100Dx','王宝强','http://www.baidu.com','http://103.143.81.108:8686/gate/notify/ok','','','','',0,'',5233,''),(18,0,100070,100001,0,0,100,3,'测试2','卡卡收付','','545828199575','四川农信','','',1200.00,0.00,0.00,0.00,1689866051,0,0,'','http://0.0.0.0:8686/p/100Ev','王宝强','http://www.baidu.com','http://103.143.81.108:8686/gate/notify/ok','','','','',0,'',2222,'');
/*!40000 ALTER TABLE `tb_pay_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pay_qudao`
--

DROP TABLE IF EXISTS `tb_pay_qudao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pay_qudao` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `del` int(11) NOT NULL DEFAULT '0',
  `upid` int(11) NOT NULL DEFAULT '0',
  `upname` varchar(16) NOT NULL,
  `sub` varchar(16) NOT NULL,
  `zt` int(11) DEFAULT '0',
  `myid` int(11) DEFAULT '0',
  `name` varchar(32) NOT NULL,
  `mid` decimal(10,0) NOT NULL,
  `lv` int(11) DEFAULT '0',
  `paycode` int(11) NOT NULL DEFAULT '0' COMMENT '支付编码',
  `msg1` varchar(60) NOT NULL,
  `payname` varchar(18) NOT NULL,
  `payaccount` varchar(30) NOT NULL,
  `qrshow` int(11) NOT NULL DEFAULT '0' COMMENT '显',
  `qrcode` varchar(255) NOT NULL COMMENT '数据',
  `cookie` varchar(255) NOT NULL,
  `payrate` decimal(4,2) NOT NULL DEFAULT '0.00' COMMENT '额外',
  `auto` int(11) NOT NULL DEFAULT '0',
  `data1` varchar(16) NOT NULL,
  `data2` text NOT NULL,
  `smoney` decimal(8,2) NOT NULL DEFAULT '0.01',
  `mmoney` decimal(12,2) NOT NULL DEFAULT '8000.00',
  `lmoney` decimal(12,2) NOT NULL DEFAULT '100000.00',
  `ddnumber` int(11) NOT NULL,
  `oknumber` int(11) NOT NULL,
  `okmoney` decimal(13,2) NOT NULL,
  `tmoney` decimal(10,2) NOT NULL COMMENT '总收',
  `decmoney` decimal(10,2) NOT NULL COMMENT '已提',
  `sxf` decimal(10,2) NOT NULL,
  `date` int(11) NOT NULL,
  `time` bigint(20) NOT NULL,
  `zmoney` decimal(10,2) NOT NULL COMMENT '总',
  `etc` decimal(10,2) NOT NULL COMMENT '下发中',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `data1` (`data1`),
  KEY `myid` (`myid`),
  KEY `mid` (`mid`),
  KEY `lei` (`paycode`),
  KEY `auto` (`auto`),
  KEY `zt` (`zt`),
  KEY `del` (`del`),
  KEY `upid` (`upid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pay_qudao`
--

LOCK TABLES `tb_pay_qudao` WRITE;
/*!40000 ALTER TABLE `tb_pay_qudao` DISABLE KEYS */;
INSERT INTO `tb_pay_qudao` VALUES (1,0,100003,'111222','',0,100001,'测试',1682338851,0,100,'卡卡收付','王思聪','622454484444555',0,'4555','北京支行',0.00,0,'52E9C580','农业银行',0.01,200000.00,2000000.00,1,1,100.00,100.00,0.00,1.38,20230424,1682338851,100.00,0.00),(2,0,100004,'999888','',1,100001,'测试卡',1689865882,0,100,'卡卡收付','王健林','6228484212155145233',0,'5233','上海支行',0.00,0,'3595D47E','农业银行',0.01,200000.00,2000000.00,8,8,28179.00,27679.00,0.00,388.86,20230720,1689865895,28179.00,500.00),(3,0,100004,'999888','',1,100001,'测试2',1689866051,0,100,'卡卡收付','马云','5544112222222',0,'2222','四川支行',0.00,1,'10799BD5','四川农信',0.01,200000.00,2000000.00,8,7,17589.00,15189.00,0.00,242.72,20230720,1689865893,17589.00,2400.00);
/*!40000 ALTER TABLE `tb_pay_qudao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_timelog`
--

DROP TABLE IF EXISTS `tb_timelog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_timelog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(11) NOT NULL,
  `myid` int(11) NOT NULL,
  `YYYY` int(11) NOT NULL DEFAULT '0',
  `MM` int(11) NOT NULL DEFAULT '0',
  `DD` int(11) NOT NULL DEFAULT '0',
  `HH` int(11) NOT NULL DEFAULT '0',
  `num` int(11) NOT NULL DEFAULT '0',
  `oknum` int(11) NOT NULL DEFAULT '0',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `okmoney` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sxf` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `myid` (`myid`),
  KEY `HH` (`HH`),
  KEY `YYYY` (`YYYY`),
  KEY `MM` (`MM`),
  KEY `DD` (`DD`),
  KEY `YYYY_2` (`YYYY`,`MM`,`DD`,`HH`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_timelog`
--

LOCK TABLES `tb_timelog` WRITE;
/*!40000 ALTER TABLE `tb_timelog` DISABLE KEYS */;
INSERT INTO `tb_timelog` VALUES (1,0,100001,2023,4,24,20,1,1,100.00,0.00,1.38),(2,0,100016,2023,4,24,20,1,1,100.00,100.00,1.38),(3,0,100001,2023,7,20,23,16,15,46968.00,45768.00,631.58),(4,0,100070,2023,7,20,23,16,15,46968.00,45768.00,631.58);
/*!40000 ALTER TABLE `tb_timelog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_tixianlog`
--

DROP TABLE IF EXISTS `tb_tixianlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_tixianlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(11) NOT NULL,
  `myid` int(11) NOT NULL COMMENT '商户id',
  `upid` int(11) NOT NULL COMMENT '卡商id',
  `sub` varchar(16) NOT NULL COMMENT '操作员',
  `qdtext` varchar(30) NOT NULL,
  `dingdan` varchar(32) NOT NULL COMMENT '订单号',
  `num` int(11) NOT NULL DEFAULT '1' COMMENT '笔',
  `zt` int(11) NOT NULL COMMENT '状态',
  `okzt` int(11) NOT NULL,
  `dfset` int(11) NOT NULL,
  `qdname` varchar(12) NOT NULL,
  `qdbank` varchar(18) NOT NULL,
  `qdcard` int(11) NOT NULL,
  `bankname` varchar(32) NOT NULL COMMENT '开户行',
  `bankaddr` varchar(20) NOT NULL,
  `bankuser` varchar(16) NOT NULL COMMENT '收款人',
  `bankcard` varchar(32) NOT NULL COMMENT '卡号',
  `amoney` decimal(10,2) NOT NULL COMMENT '原余额',
  `money` decimal(10,2) NOT NULL COMMENT '金额',
  `sxf` decimal(10,2) NOT NULL,
  `time` int(11) NOT NULL COMMENT '时间',
  `oktime` int(11) NOT NULL COMMENT '成功时间',
  `icon` varchar(16) NOT NULL COMMENT '银行图标',
  `imgurl` varchar(64) NOT NULL COMMENT '凭证图',
  `sms` text NOT NULL COMMENT '出款短信',
  `qdid` int(11) NOT NULL COMMENT '出款通道',
  `notifyurl` varchar(100) NOT NULL,
  `orid` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dingdan` (`dingdan`),
  KEY `myid` (`myid`),
  KEY `upid` (`upid`),
  KEY `zt` (`zt`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_tixianlog`
--

LOCK TABLES `tb_tixianlog` WRITE;
/*!40000 ALTER TABLE `tb_tixianlog` DISABLE KEYS */;
INSERT INTO `tb_tixianlog` VALUES (1,0,100001,100004,'','农业银行(王健林*5233)','07240057078449',0,0,0,12,'王健林','农业银行',5233,'中国银行','深圳支行','王健林','6228485555555554',500.00,500.00,0.00,1690131427,0,'','','',2,'',''),(2,0,100001,100004,'','四川农信(马云*2222)','07240102185762',1,0,0,12,'马云','四川农信',2222,'中国银行','深圳','王健林','65645454545',1200.00,1200.00,0.00,1690131738,0,'','','',3,'',''),(3,0,100001,100004,'','四川农信(马云*2222)','07240103148964',1,0,0,12,'马云','四川农信',2222,'中国银行','深圳','王健林','656454545456',1200.00,1200.00,0.00,1690131794,0,'','','',3,'','');
/*!40000 ALTER TABLE `tb_tixianlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_today_log`
--

DROP TABLE IF EXISTS `tb_today_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_today_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(11) NOT NULL DEFAULT '0',
  `myid` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `num` int(11) NOT NULL DEFAULT '1',
  `oknum` int(11) NOT NULL DEFAULT '0',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `okmoney` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sxf` decimal(10,2) NOT NULL,
  `moneydf` int(11) NOT NULL,
  `okmoneydf` int(11) NOT NULL,
  `numdf` int(11) NOT NULL,
  `oknumdf` int(11) NOT NULL,
  `time` int(11) NOT NULL COMMENT '时间戳',
  `md` int(11) NOT NULL DEFAULT '0' COMMENT '1为月',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `myid` (`myid`),
  KEY `date` (`date`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_today_log`
--

LOCK TABLES `tb_today_log` WRITE;
/*!40000 ALTER TABLE `tb_today_log` DISABLE KEYS */;
INSERT INTO `tb_today_log` VALUES (1,0,100001,20230424,1,1,100.00,100.00,1.38,0,0,0,0,1682338851,0),(2,0,100001,202304,1,1,100.00,100.00,1.38,0,0,0,0,1682338851,1),(3,0,100016,20230424,1,1,100.00,100.00,1.38,0,0,0,0,1682338867,0),(4,0,100016,202304,1,1,100.00,100.00,1.38,0,0,0,0,1682338867,1),(5,0,100001,20230720,16,15,46968.00,45768.00,631.58,0,0,0,0,1689865657,0),(6,0,100001,202307,16,15,46968.00,45768.00,631.58,0,0,0,0,1689865657,1),(7,0,100070,20230720,16,15,46968.00,45768.00,631.58,0,0,0,0,1689865746,0),(8,0,100070,202307,16,15,46968.00,45768.00,631.58,0,0,0,0,1689865746,1),(9,0,100001,20230724,0,0,0.00,0.00,0.00,2900,0,3,0,1690131427,0);
/*!40000 ALTER TABLE `tb_today_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_today_qd_log`
--

DROP TABLE IF EXISTS `tb_today_qd_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_today_qd_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(11) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL COMMENT '日期',
  `myid` int(11) DEFAULT '0' COMMENT '商户ID',
  `qdid` int(11) DEFAULT '0' COMMENT '渠道ID',
  `paycode` int(11) NOT NULL COMMENT '支付编码',
  `codename` varchar(20) NOT NULL,
  `payaccount` varchar(20) DEFAULT '0' COMMENT '实际收款账号',
  `payname` varchar(20) DEFAULT NULL COMMENT '渠道收款人名',
  `num` int(11) NOT NULL DEFAULT '1' COMMENT '创建订单',
  `oknum` int(11) NOT NULL DEFAULT '0' COMMENT '成功订单',
  `money` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '创建总金额',
  `okmoney` decimal(10,2) DEFAULT '0.00' COMMENT '成功金额',
  `sxf` decimal(10,2) NOT NULL,
  `time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `date` (`date`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_today_qd_log`
--

LOCK TABLES `tb_today_qd_log` WRITE;
/*!40000 ALTER TABLE `tb_today_qd_log` DISABLE KEYS */;
INSERT INTO `tb_today_qd_log` VALUES (1,0,20230424,100001,1,100,'农业银行','622454484444555','王思聪',1,1,100.00,100.00,1.38,1682338867),(2,0,20230424,100016,1,100,'农业银行','622454484444555','王思聪',1,1,100.00,100.00,1.38,1682338867),(3,0,20230720,100001,2,100,'农业银行','6228484212155145233','王健林',8,8,28179.00,28179.00,388.86,1689865746),(4,0,20230720,100070,2,100,'农业银行','6228484212155145233','王健林',8,8,28179.00,28179.00,388.86,1689865746),(5,0,20230720,100001,3,100,'四川农信','5544112222222','马云',8,7,18789.00,17589.00,242.72,1689865748),(6,0,20230720,100070,3,100,'四川农信','5544112222222','马云',8,7,18789.00,17589.00,242.72,1689865748);
/*!40000 ALTER TABLE `tb_today_qd_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_trx_setup`
--

DROP TABLE IF EXISTS `tb_trx_setup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_trx_setup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin` varchar(32) NOT NULL,
  `bot` varchar(16) NOT NULL,
  `PrivateKey` varchar(64) NOT NULL COMMENT '钱包秘钥',
  `addr` varchar(34) NOT NULL,
  `TRON_API_KEY` varchar(48) NOT NULL COMMENT '波场APIKEY',
  `Ttime` int(5) NOT NULL DEFAULT '600' COMMENT '监听时间阈值',
  `maxusdt` decimal(5,2) NOT NULL DEFAULT '100.00' COMMENT '最大兑换U',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '兑换模式',
  `Rate` int(2) NOT NULL COMMENT '抽成比例',
  `Price` decimal(5,2) NOT NULL COMMENT '固定价格',
  `Minusdt` decimal(5,2) NOT NULL COMMENT '最小兑换',
  `fanli` int(2) NOT NULL,
  `yuzhi` json DEFAULT NULL,
  `shandui` bigint(20) NOT NULL,
  `okshandui` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bot` (`bot`),
  KEY `plugin` (`plugin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_trx_setup`
--

LOCK TABLES `tb_trx_setup` WRITE;
/*!40000 ALTER TABLE `tb_trx_setup` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_trx_setup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'ttt'
--

--
-- Dumping routines for database 'ttt'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-24 13:49:49
