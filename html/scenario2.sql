# Gabe Marcus (C00058952)
# I certify that this assignment has completely been done by myself.

-- MySQL dump 10.13  Distrib 5.7.19, for Win64 (x86_64)
--
-- Host: localhost    Database: GYMDB
-- ------------------------------------------------------
-- Server version	5.7.19-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `teacher`
--

DROP DATABASE IF EXISTS GYMDB;
CREATE DATABASE GYMDB;
USE GYMDB;

DROP TABLE IF EXISTS `teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacher` (
  `emp_ID` int(4) NOT NULL,
  `emp_fname` varchar(20) DEFAULT NULL,
  `emp_lname` varchar(20) DEFAULT NULL,
  `emp_section` varchar(20) DEFAULT NULL,
  `salary` int(6) DEFAULT NULL,
  PRIMARY KEY (`emp_ID`),
  CONSTRAINT `tch_section` CHECK (`emp_section`=`Classrooms`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher`
--

LOCK TABLES `teacher` WRITE;
/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;
INSERT INTO `teacher` VALUES ('1','Jacques','Commanderson','Classrooms','57000'),('2','Dire','Straits','Classrooms','65536'),('3','Kevin','Pikachu','Classrooms','77000');
/*!40000 ALTER TABLE `teacher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deskworker`
--

DROP TABLE IF EXISTS `deskworker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deskworker` (
  `emp_ID` int(4) NOT NULL,
  `emp_fname` varchar(20) DEFAULT NULL,
  `emp_lname` varchar(20) DEFAULT NULL,
  `emp_section` varchar(20) DEFAULT NULL,
  `hourlyRate` int(3) DEFAULT NULL,
  PRIMARY KEY (`emp_ID`),
  CONSTRAINT `dw_section` CHECK (`emp_section` IN (`Classrooms`,`Front Desk`,`Racquetball Court`,`Basketball Court`,`Martial Arts Room`,`Weightlifting Room`,`Tennis Court`,`Swimming Pool`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deskworker`
--

LOCK TABLES `deskworker` WRITE;
/*!40000 ALTER TABLE `deskworker` DISABLE KEYS */;
INSERT INTO `deskworker` VALUES ('4','Star','Butterfly','Front Desk','10'),('5','Pablo','Sanchez','Weightlifting Room','12'),('6','Professor','Emeritus','Racquetball Court','15'),('10','Windows','Millennium','Basketball Court','15'),('11','Mister','Miyagi','Martial Arts Room','15'),('12','Professor','Codex','Classrooms','15');
/*!40000 ALTER TABLE `deskworker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trainer`
--

DROP TABLE IF EXISTS `trainer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trainer` (
  `emp_ID` int(4) NOT NULL,
  `emp_fname` varchar(20) DEFAULT NULL,
  `emp_lname` varchar(20) DEFAULT NULL,
  `emp_section` varchar(20) DEFAULT NULL,
  `hourlyTrainingRate` int(3) DEFAULT NULL,
  PRIMARY KEY (`emp_ID`),
  CONSTRAINT `trn_section` CHECK (`emp_section` IN (`Classrooms`,`Front Desk`,`Racquetball Court`,`Basketball Court`,`Martial Arts Room`,`Weightlifting Room`,`Tennis Court`,`Swimming Pool`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trainee`
--

LOCK TABLES `trainer` WRITE;
/*!40000 ALTER TABLE `trainer` DISABLE KEYS */;
INSERT INTO `trainer` VALUES ('7','Superjail','Warden','Weightlifting Room','20'),('8','Mas y','Menos','Racquetball Court','22'),('9','Tor','Coolguy','Martial Arts Room','25');
/*!40000 ALTER TABLE `trainer` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `scanin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scanin` (
  `emp_ID` int(4) NOT NULL,
  `ULID` int(9) NOT NULL,
  `time` int(4) DEFAULT NULL,
  CONSTRAINT `si_emp_ID` FOREIGN KEY (`emp_ID`) REFERENCES `deskworker` (`emp_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `si_ULID` FOREIGN KEY (`ULID`) REFERENCES `visitor` (`ULID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deskworker`
--

LOCK TABLES `scanin` WRITE;
/*!40000 ALTER TABLE `scanin` DISABLE KEYS */;
INSERT INTO `scanin` VALUES ('4','300058952','1027'),('5','300058952','1122'),('6','300058952','1228'),('4','311111111','1300'),('5','311111111','1439'),('6','311111111','1545'),('4','344444444','1111'),('5','344444444','1657'),('6','344444444','1711'),('6','322222222','1600'),('6','333333333','1700'),('5','355555555','1800');
/*!40000 ALTER TABLE `scanin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitor`
--

DROP TABLE IF EXISTS `visitor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visitor` (
  `ULID` int(9) NOT NULL,
  `vis_fname` varchar(20) DEFAULT NULL,
  `vis_lname` varchar(20) DEFAULT NULL,
  `trn_ID` int(4) DEFAULT NULL,
  PRIMARY KEY (`ULID`),
  CONSTRAINT `check_train_ID` FOREIGN KEY (`trn_ID`) REFERENCES `trainer` (`emp_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visitor`
--

LOCK TABLES `visitor` WRITE;
/*!40000 ALTER TABLE `visitor` DISABLE KEYS */;
INSERT INTO `visitor` VALUES (300058952,'Gabe','Marcus','7'),(344444444,'Carson','Palmer','8'),(311111111,'Odell','LeagueOfLegends','9'),(322222222,'Brother','Blood','7'),(333333333,'Phillium','Benedict','7'),(355555555,'Interplanet','Janet','8'),(366666666,'Homeschool','Winner','8'),(377777777,'Yakety','Sax','9'),(388888888,'Hasbro','Interactive','9'),(399999999,'Ryan','Sterritt','9');
/*!40000 ALTER TABLE `visitor` ENABLE KEYS */;
UNLOCK TABLES;




DROP TABLE IF EXISTS `class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class` (
  `classID` varchar(12) NOT NULL,
  `className` varchar(20) NOT NULL,
  PRIMARY KEY (`classID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class`
--

LOCK TABLES `class` WRITE;
/*!40000 ALTER TABLE `class` DISABLE KEYS */;
INSERT INTO `class` VALUES ('EVIL 107','Theory of Mayhem'),('CAPER 5700','Jumble Capers'),('FLUBS 2121','Suck it Flubs');
/*!40000 ALTER TABLE `class` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `clubs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clubs` (
  `clubNo` int(3) NOT NULL,
  `club_name` varchar(20) NOT NULL,
  `SSName` varchar(20) NOT NULL,
  `practiceTime` varchar(8) NOT NULL,
  PRIMARY KEY (`clubNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clubs`
--

LOCK TABLES `clubs` WRITE;
/*!40000 ALTER TABLE `clubs` DISABLE KEYS */;
INSERT INTO `clubs` VALUES ('11','Kavo Club','Martial Arts Room','1:00 PM'),('22','Kronk Club','Martial Arts Room','2:30 PM'),('33','Kuzco Club','Racquetball Court','2:30 PM'),('44','Malina Club','Basketball Court','4:00 PM'),('55','Pacha Club','Basketball Court','10:30 AM');
/*!40000 ALTER TABLE `clubs` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `clubmem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clubmem` (
  `ULID` int(9) NOT NULL,
  `clubNo` int(3) NOT NULL,
  PRIMARY KEY (`ULID`,`clubNo`),
  CONSTRAINT `cm_ULID` FOREIGN KEY (`ULID`) REFERENCES `visitor` (`ULID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cm_clubNo` FOREIGN KEY (`clubNo`) REFERENCES `clubs` (`clubNo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clubmem`
--

LOCK TABLES `clubmem` WRITE;
/*!40000 ALTER TABLE `clubmem` DISABLE KEYS */;
INSERT INTO `clubmem` VALUES ('300058952','11'),('300058952','22'),('300058952','33'),('344444444','33'),('344444444','44'),('311111111','55'),('322222222','55'),('333333333','55'),('355555555','22'),('366666666','11'),('377777777','22'),('388888888','44'),('399999999','11'),('311111111','11');
/*!40000 ALTER TABLE `clubmem` ENABLE KEYS */;
UNLOCK TABLES;


DROP TABLE IF EXISTS `enroll`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enroll` (
  `ULID` int(9) NOT NULL,
  `sectionNo` int(5) NOT NULL,
  PRIMARY KEY (`ULID`,`sectionNo`),
  CONSTRAINT `en_section` FOREIGN KEY (`sectionNo`) REFERENCES `csection` (`sectionNo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `en_visULID` FOREIGN KEY (`ULID`) REFERENCES `visitor` (`ULID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enroll`
--

LOCK TABLES `enroll` WRITE;
/*!40000 ALTER TABLE `enroll` DISABLE KEYS */;
INSERT INTO `enroll` VALUES (300058952,12345),(311111111,12345),(311111111,45555),(344444444,39762),(344444444,24680),(322222222,12345),(333333333,12345),(355555555,39762),(366666666,39762),(377777777,45555),(388888888,45555),(399999999,45555),(399999999,12345);
/*!40000 ALTER TABLE `enroll` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `csection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `csection` (
  `sectionNo` int(5) NOT NULL,
  `emp_ID` int(4) NOT NULL,
  `classID` varchar(12) NOT NULL,
  `classTime` varchar(8) NOT NULL,
  PRIMARY KEY (`sectionNo`),
  CONSTRAINT `cs_tch_ID` FOREIGN KEY (`emp_ID`) REFERENCES `teacher` (`emp_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cs_class_ID` FOREIGN KEY (`classID`) REFERENCES `class` (`classID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `csection`
--

LOCK TABLES `csection` WRITE;
/*!40000 ALTER TABLE `csection` DISABLE KEYS */;
INSERT INTO `csection` VALUES (12345,1,'EVIL 107','10:00 AM'),(24680,3,'EVIL 107','11:00 AM'),(45555,2,'CAPER 5700','12:00 PM'),(39762,3,'FLUBS 2121','1:00 PM');
/*!40000 ALTER TABLE `csection` ENABLE KEYS */;
UNLOCK TABLES;


CREATE INDEX classNames ON class(class_name);

CREATE VIEW vwA AS SELECT * FROM csection WHERE classID='EVIL 107';
CREATE VIEW vwB AS SELECT * FROM clubmem WHERE ULID='300058952';
CREATE VIEW vwC AS SELECT * FROM teacher WHERE salary>60000;

\! echo "Nested Query #1: First and last name of all people enrolled in at least 1 section of EVIL 107";
SELECT vis_fname, vis_lname FROM visitor WHERE ULID in (SELECT ULID FROM enroll WHERE sectionNo IN (SELECT sectionNo FROM csection WHERE classID='EVIL 107'));

\! echo "Nested Query #2: First and last name of all people trained by 'Superjail Warden'";
SELECT vis_fname, vis_lname FROM visitor WHERE trn_ID in (SELECT emp_ID FROM trainer WHERE emp_fname='Superjail' AND emp_lname='Warden');

\! echo "Nested Query #3: First and last name of all people checked into 'Weightlifting Room'";
SELECT vis_fname, vis_lname FROM visitor WHERE ULID in (SELECT ULID FROM scanin WHERE emp_ID IN (SELECT emp_ID FROM deskworker WHERE emp_section='Weightlifting Room'));


\! echo "Group By Query #1: First and last names of all trainers training more than 3 people";
SELECT emp_fname, emp_lname FROM trainer WHERE emp_ID in (SELECT trn_ID FROM visitor GROUP BY trn_ID HAVING COUNT(trn_ID)>3 ORDER BY trn_ID);

\! echo "Group By Query #2: First and last names of students enrolled in more than 1 class";
SELECT vis_fname, vis_lname FROM visitor WHERE ULID in (SELECT ULID FROM enroll GROUP BY ULID HAVING COUNT(ULID)>1 ORDER BY ULID);

\! echo "Join Query #1: First and Last names of all teachers and the names of the classes they teach";
SELECT t.emp_fname, t.emp_lname, c.className FROM teacher t, class c, csection cs WHERE t.emp_ID=cs.emp_ID AND cs.classID=c.classID;

\! echo "Join Query #2: First and Last names of all visitors and the names of the clubs they are in";
SELECT v.vis_fname, v.vis_lname, c.club_name FROM visitor v, clubmem cm, clubs c WHERE v.ULID=cm.ULID AND cm.clubNo=c.clubNo;

\! echo "Join Query #3: All ULID pairs of visitors who share at least one club";
SELECT cm1.ULID, cm2.ULID FROM clubmem cm1, clubmem cm2 WHERE cm1.ULID!=cm2.ULID AND cm1.clubNo=cm2.clubNo;

\! echo "Stored Procedure: Given a ULID, list the names of all the clubs that person is in";
DELIMITER $$
CREATE PROCEDURE s2stored (IN vULID INT)
BEGIN
SELECT club_name FROM clubs WHERE clubNo IN (SELECT clubNo FROM clubmem WHERE ULID=vULID);
END$$
DELIMITER ;

\! echo "Transaction: Given a ULID, register a new visitor named 'Kevin DuBrow', assign them trainer with trn_id '7', and register them in club with clubNo '11'";
DELIMITER $$

CREATE PROCEDURE s2trans(IN vULID INT)
BEGIN

DECLARE EXIT HANDLER FOR SQLEXCEPTION
BEGIN

ROLLBACK;

END;

set autocommit=0;

start transaction;

INSERT INTO visitor VALUES (vULID,'Kevin','DuBrow','7');
INSERT INTO clubmem VALUES (vULID,'11');

COMMIT;

END$$
DELIMITER ;

\! echo "Trigger #1: When a new visitor is inserted, enroll them in class section 45555";
DELIMITER $$
create trigger t1
after insert
on visitor
for each row
Begin
insert into enroll
values (new.ULID,45555);
end$$
DELIMITER ;

\! echo "Trigger #2: When a new course section is added, raise that sections teachers salary by 50 dollars";
DELIMITER $$
create trigger t2
after insert
on csection
for each row
Begin
update teacher
set salary=salary+50
where emp_ID in (select emp_ID from csection where sectionNo=new.sectionNo);
end$$
DELIMITER ;








/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-13 14:12:20
