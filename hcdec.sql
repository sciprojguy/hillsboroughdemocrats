/*
 Navicat Premium Data Transfer

 Source Server         : mySQL
 Source Server Type    : MySQL
 Source Server Version : 50529
 Source Host           : localhost
 Source Database       : hcdec

 Target Server Type    : MySQL
 Target Server Version : 50529
 File Encoding         : utf-8

 Date: 03/17/2013 11:45:42 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `alerts`
-- ----------------------------
DROP TABLE IF EXISTS `alerts`;
CREATE TABLE `alerts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `short_title` varchar(64) NOT NULL,
  `type` char(16) NOT NULL,
  `action_url` varchar(255) NOT NULL,
  `start_date_time` datetime NOT NULL,
  `end_date_time` datetime NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` char(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `alerts`
-- ----------------------------
BEGIN;
INSERT INTO `alerts` VALUES ('1', 'Write JD Alexander and tell him to leave USF alone', 'news', 'http://www.tampabay.com/news/politics/legislature/article1216101.ece', '2012-02-18 20:38:51', '2012-02-25 20:38:55', '', 'cancel'), ('2', 'Obama 2012 Needs You!', 'alert', 'http://www.barackobama.com/obama-for-america-2012-campaign?source=OM2012_LB_G_Obama2012-search_bo-name-misspell_d1c&gclid=COnMlIr0qK4CFQPe4Aod8nz_QQ', '2012-02-18 20:40:23', '2012-02-29 20:40:27', '', 'cancel'), ('3', 'Keep an eye on the GOP in Tallahassee', 'note', 'http://www.tampabay.com/news/politics/capitol-buzz-5-things-to-watch-today-in-tallahassee/1215729', '2012-02-17 20:45:13', '2012-04-26 20:45:18', '', 'cancel'), ('8', 'testing', 'alert', 'testing.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'testing			', 'cancel'), ('7', 'Third Item', 'alert', 'http://www.yahoo.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'This will display again			', 'cancel'), ('6', 'Another one', 'alert', 'http://www.google.com', '2012-02-21 00:00:00', '2012-02-28 00:00:00', 'Another alert dude			', 'cancel'), ('11', 'New Flesh', 'alert', 'test.com', '2012-02-22 00:00:00', '2012-02-24 11:59:59', 'Unyielding corpse			', 'cancel'), ('12', 'first one from the form', 'alert', 'http://www.dailykos.com', '2012-02-23 00:00:00', '2012-02-29 11:59:59', 'this is the first one from the form			', 'cancel'), ('13', 'become a delegate', 'alert', '', '2012-02-23 00:00:00', '2012-05-02 11:59:59', '', 'active'), ('14', 'need phone banking', 'alert', 'none', '2012-02-29 00:00:00', '2012-03-16 11:59:59', 'we need phone banking			', 'cancel'), ('15', 'bounce your boobies', 'alert', '', '2012-02-23 00:00:00', '2012-02-24 11:59:59', 'rusty warren song', 'cancel'), ('16', 'need phone banking', 'alert', 'none', '2012-02-29 00:00:00', '2012-03-16 11:59:59', 'we need phone banking			', 'cancel'), ('17', 'need phone banking', 'alert', 'none', '2012-02-29 00:00:00', '2012-03-16 11:59:59', 'we need phone banking			', 'cancel'), ('18', 'Write JD Alexander and tell him to leave USF alone', 'news', 'http://www.tampabay.com/news/politics/legislature/article1216101.ece', '2012-02-24 00:00:00', '2012-02-25 20:38:55', '', 'cancel'), ('19', 'need phone banking', 'alert', 'none', '2012-02-29 00:00:00', '2012-03-16 11:59:59', 'we need phone banking			', 'cancel'), ('20', 'need phone banking', 'alert', 'none', '2012-02-23 00:00:00', '2012-03-16 11:59:59', 'we need phone banking			', 'cancel'), ('21', 'Support Larcenia Bullard', 'alert', 'none', '2012-02-24 00:00:00', '2012-03-02 11:59:59', 'Support Larcenia Bullard as she fights to stop prison privatization', 'cancel'), ('22', 'We need phone banking', 'alert', 'http://hcdec.local/home/index', '2012-02-25 00:00:00', '2012-02-28 11:59:59', '', 'cancel'), ('23', 'another alert', 'alert', 'nome', '2012-02-25 00:00:00', '2012-02-28 11:59:59', '', 'cancel'), ('24', 'test alert', 'alert', 'asdf', '2012-03-09 00:00:00', '2012-03-16 11:59:59', '', 'cancel'), ('25', 'don\'t get caught flat footed', 'alert', 'http://www.google.com', '2012-03-09 00:00:00', '2012-03-15 11:59:59', '', 'cancel');
COMMIT;

-- ----------------------------
--  Table structure for `boxItems`
-- ----------------------------
DROP TABLE IF EXISTS `boxItems`;
CREATE TABLE `boxItems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `lead` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `status` char(16) NOT NULL,
  `status_date` datetime NOT NULL,
  `status_who` varchar(255) NOT NULL,
  `status_notes` text NOT NULL,
  `pageName` varchar(32) NOT NULL,
  `priority` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `boxItems`
-- ----------------------------
BEGIN;
INSERT INTO `boxItems` VALUES ('1', '2012 Democratic National Convention', 'convention.jpg', 'The Road to the Convention starts in the Hillsborogh County DEC!', 'The Democratic National Convention is firmly held in American history as an historic event in the life of the nation. Nothing can compare to the thrill, excitement and exhilaration of witnessing our Democratic leaders share their vision, ideas and passion with fellow Democrats from all over the United States.', 'sciprojguy@gmail.com', 'new', '2012-02-18 14:33:51', 'sciprojguy@gmail.com', '', 'index', '1');
COMMIT;

-- ----------------------------
--  Table structure for `candidates`
-- ----------------------------
DROP TABLE IF EXISTS `candidates`;
CREATE TABLE `candidates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `office` int(11) NOT NULL,
  `lastName` varchar(48) NOT NULL,
  `firstName` varchar(32) NOT NULL,
  `middleName` varchar(32) NOT NULL,
  `filed` char(1) NOT NULL,
  `filedDate` date NOT NULL,
  `qualified` char(1) NOT NULL,
  `qualifiedDate` date NOT NULL,
  `qualifiedHow` varchar(16) NOT NULL,
  `webSite` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(48) NOT NULL,
  `contact_address` varchar(128) NOT NULL,
  `contact_phone` varchar(16) NOT NULL,
  `withdrawn` char(1) NOT NULL,
  `withdrawnDate` date NOT NULL,
  `picture` varchar(255) NOT NULL,
  `short_bio` varchar(1000) NOT NULL,
  `campaign_statement` varchar(1000) NOT NULL,
  `large_picture` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `candidates`
-- ----------------------------
BEGIN;
INSERT INTO `candidates` VALUES ('51', '30', 'Barnett', 'Bruce', '', 'Y', '0000-00-00', 'N', '0000-00-00', 'petition', 'http://www.brucebarnett.org/', 'brucebarnett.org@verizon.net', 'Bruce Barnett Campaign ', 'PO Box 369, Lithia, FL 33547', '813-340-8630', 'N', '0000-00-00', 'barnett.png', 'I am a Florida native, born in Tampa in 1963. A product of the Florida public school system, I graduated from Pinellas Park High School and attended St. Petersburg Junior College before entering the U.S. Army.  I graduated from the prestigious Defense Language Institute, and served as a Czech linguist with the 66th Military Intelligence Company of the 3rd Armored Cavalry Regiment.\n\nI am a Florida native, born in Tampa in 1963. A product of the Florida public school system, I graduated from Pinellas Park Hig', 'Like all parents in Florida, I have seen education budgets slashed while select legislators and private companies have pillaged our state.\n\nOur schools, health care (including Medicare / Medicaid), and quality of life are all threatened by the single-part', 'barnettLarge.png'), ('50', '1', 'Obama', 'Barack', '', 'Y', '0000-00-00', 'Y', '0000-00-00', 'fee', 'http://www.whitehouse.gov', 'info@barackobama.com', 'don\'t know', '1600 Pennsylvania Ave', '888 867 5309', 'N', '0000-00-00', 'obama.png', 'current president', 'relect me', ''), ('52', '36', 'Danish', 'Mark', 'Alan', 'Y', '0000-00-00', 'N', '0000-00-00', 'petition', 'http://markdanish.com/index.html', 'Info@markdanish.com ', 'Mark Danish Campaign', '18048 Arbor Crest Drive  Tampa, FL 33647', ' (813)732-4230', 'N', '0000-00-00', 'markDanishThumb.png', '', '', 'markDanish.png'), ('53', '31', 'Cruz', 'Janet', '', 'Y', '0000-00-00', 'N', '0000-00-00', 'petition', 'http://cruzforflorida.com/', 'info@cruzforflorida.com', 'Janet Cruz for Florida', 'PO Box 4544 Tampa, FL 33677', '', 'N', '0000-00-00', 'janetCruz.png', '', '', 'janetCruzLarge.png');
COMMIT;

-- ----------------------------
--  Table structure for `clubs`
-- ----------------------------
DROP TABLE IF EXISTS `clubs`;
CREATE TABLE `clubs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `president` varchar(48) NOT NULL,
  `meets` varchar(255) NOT NULL,
  `contact_phone` varchar(16) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `club_url` varchar(255) NOT NULL,
  `status` char(16) NOT NULL,
  `notes` text NOT NULL,
  `type` char(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `clubs`
-- ----------------------------
BEGIN;
INSERT INTO `clubs` VALUES ('1', 'Hillsborough County Young Democrats', '', 'Timothy Heberlein', '2nd Thursday at 7pm at Tahitian Inn - 601 S Dale Mabry, Tampa', '', 'tim_heber@yahoo.com', '', 'active', '', 'club'), ('2', 'South Shore Democratic Club', '', 'Arnie Frigeri', '2nd Tuesday of each month Sept-May at South Short Regional Library, 15816 Beth Shields Way, Ruskin FL', '', 'Afrigeri@tampabay.rr.com', 'http://southshoredemocraticclub.org', 'active', '', 'club'), ('3', 'Florida Democratic Lawyers Council', '', 'Sharon Samek', '', '', 'sharonsamek@gmail.com', '', 'active', '', 'caucus'), ('4', 'New Tampa Democratic Club', '', 'Sharon Samek', '', '', 'sharonsamek@gmail.com', 'http://www.newtampadems.com', 'active', '', 'club'), ('5', 'South Tampa Democratic Club', '', 'Jane Gibbons', '', '', 'gibbjane54@gmail.com', '', 'active', '', 'club'), ('6', 'Hillsborough Democratic Hispanic Caucus', '4925 Independence Parkway, Suite 195, Tampa FL 33634', 'Victor DiMaio', '3rd Thursday of each month at 6pm at La Teresita Restaurant, 3248 W Columbus Drive, Tampa FL', '(813) 361-1922', 'hillsboroughhispanicdems@gmail.com', '', 'active', '', 'caucus'), ('7', 'Hillsborough County Democratic Women\'s Club', '', 'Naomi Ryan', '1st Monday of the month at Mimi\'s Cafe, 11702 N. Dale Mabry (Carrollwood)', '', '', 'http://hcdwc.org', 'active', '', 'club'), ('8', 'East Hillsborough Democratic Club', '', 'Angie Angel', '2nd Tuesday of each month at 6:30 pm at Giordano\'s Restaurant, 11310 Causeway Blvd, Brandon', '', 'DemsInBrandon@aol.com', 'http://www.easthillsboroughdems.org', 'active', '', 'club'), ('9', 'Northwest HIllsborough Democratic Club', '', '', '4th Tuesday of each month 6:30pm', '', '', 'http://www.facebook.com/pages/Northwest-Hillsborough-Democrats/372320953274', 'active', '', 'club'), ('10', 'Central Tampa Democratic Club', 'Encompassing neighborhoods in East Tampa, Sulphur Springs and Seminole Heights', 'Kevin Wren', '', '', 'wren.kevin@gmail.com', '', 'active', '', 'club'), ('11', 'Temple Terrace Area Democrats', '', 'Lisa Monteleone', '', '', 'ljmfla@gmail.com', '', 'active', '', 'club'), ('12', 'Hillsborough County Democratic Black Caucus', '', 'Dr Bruce Miles', 'East Tampa Business & Civic Center - 2814 N 22nd St, Tampa', '(813) 237-3588', 'bhmilesdds@verizon.net', '', 'active', '', 'caucus'), ('13', 'Hillsborough County GLTBA Democratic Caucus', '', 'Sally Phillips', '2nd Wednesday of each month at the Blue Dog Bistro, 1600 E 8th Ave, Ybor City, FL. Social begins at 5:30pm, meeting begins at 7:00pm', '(813) 382-8172', 'katlvr952@aol.com', '', 'active', '', 'caucus'), ('14', 'Hillsborough Democratic Disability Caucus', 'PO Box 15174, Tampa, FL 33684', 'Jackie Bieiro', '', '(813) 412-6256', 'jdbeiro@gmail.com', '', 'active', '', 'caucus'), ('15', 'Imaginary Beings Caucus', 'Democratic Caucus for beings that do not exist', 'Tyrion Lanister', 'each blue moon', '(813) 222-3333', 'none@nowhere.net', 'http://noneatnowhere.net', 'active', '', ''), ('16', 'test club', '', '', '', '', '', '', 'suspend', '', '');
COMMIT;

-- ----------------------------
--  Table structure for `committee_memberships`
-- ----------------------------
DROP TABLE IF EXISTS `committee_memberships`;
CREATE TABLE `committee_memberships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `committee_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `role` char(16) NOT NULL,
  `term_began` date NOT NULL,
  `term_ended` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `committee_reports`
-- ----------------------------
DROP TABLE IF EXISTS `committee_reports`;
CREATE TABLE `committee_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `committee_id` int(11) NOT NULL,
  `authored_by` varchar(64) NOT NULL,
  `type` char(16) NOT NULL,
  `status` char(16) NOT NULL,
  `date` date NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `committees`
-- ----------------------------
DROP TABLE IF EXISTS `committees`;
CREATE TABLE `committees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` char(50) NOT NULL,
  `existence_begins` date DEFAULT NULL,
  `existence_ends` date DEFAULT NULL,
  `name` varchar(64) NOT NULL,
  `description` varchar(55) NOT NULL,
  `status` char(8) NOT NULL,
  `status_date` date DEFAULT NULL,
  `notes` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `eventTags`
-- ----------------------------
DROP TABLE IF EXISTS `eventTags`;
CREATE TABLE `eventTags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eventId` int(11) NOT NULL,
  `tag` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `events`
-- ----------------------------
DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` char(16) NOT NULL,
  `date` date NOT NULL,
  `startTime` char(10) NOT NULL,
  `endTime` char(10) NOT NULL,
  `title` varchar(64) NOT NULL,
  `description` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `contact` varchar(64) NOT NULL,
  `contact_phone` varchar(16) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `status` char(16) NOT NULL,
  `status_dt` datetime NOT NULL,
  `notes` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `maplink` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `events`
-- ----------------------------
BEGIN;
INSERT INTO `events` VALUES ('8', 'rally', '2012-05-05', '8:00 PM', '11:30 PM', 'Cinco De Mayo', '', 'La Teresita', 'Chris Mitchell', 'non', 'non', 'approved', '2012-05-04 11:15:22', '', 'fundraising', ''), ('9', 'general_meeting', '2012-05-17', '6:00 PM', '9:00 PM', 'Web Site Committee', 'Never expects to meet', 'You have to be kidding me.', 'Chris Woodard', '813 240 0792', 'none@nowhere.net', 'approved', '2012-05-05 01:55:07', '', 'IT', ''), ('10', 'general_meeting', '2012-05-06', '10:30 AM', '5:30 PM', 'Really long committee meeting', 'None given', 'My house', 'Chris woodard', 'none', 'none', 'approved', '2012-05-06 12:56:33', '', 'training', '');
COMMIT;

-- ----------------------------
--  Table structure for `fundraisers`
-- ----------------------------
DROP TABLE IF EXISTS `fundraisers`;
CREATE TABLE `fundraisers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` char(8) NOT NULL,
  `status` char(8) NOT NULL,
  `date` date NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `short_descr` varchar(64) NOT NULL,
  `long_descr` varchar(612) NOT NULL,
  `address` varchar(48) NOT NULL,
  `city` varchar(48) NOT NULL,
  `state` char(2) NOT NULL,
  `zip` char(10) DEFAULT NULL,
  `contact_name` varchar(48) DEFAULT NULL,
  `contact_phone` varchar(16) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `notes` text,
  `seating_limit` int(11) NOT NULL DEFAULT '9999',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `fundraising_reservations`
-- ----------------------------
DROP TABLE IF EXISTS `fundraising_reservations`;
CREATE TABLE `fundraising_reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fundraiser_id` int(11) NOT NULL,
  `confirmation` varchar(48) DEFAULT NULL,
  `confirmed` char(1) DEFAULT NULL,
  `date_made` date DEFAULT NULL,
  `date_confirmed` date DEFAULT NULL,
  `reservation_name` varchar(128) DEFAULT NULL,
  `address` varchar(48) DEFAULT NULL,
  `city` varchar(32) DEFAULT NULL,
  `state` char(2) DEFAULT NULL,
  `zip` char(10) DEFAULT NULL,
  `notes` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `fundraising_sponsorships`
-- ----------------------------
DROP TABLE IF EXISTS `fundraising_sponsorships`;
CREATE TABLE `fundraising_sponsorships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` char(16) DEFAULT NULL,
  `fundraiser_id` int(11) NOT NULL,
  `name` varchar(48) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `num_available` int(11) NOT NULL DEFAULT '9999',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `members`
-- ----------------------------
DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(32) NOT NULL,
  `middleName` varchar(32) NOT NULL,
  `lastName` varchar(48) NOT NULL,
  `salutation` varchar(32) NOT NULL,
  `type` varchar(32) NOT NULL,
  `street` varchar(48) NOT NULL,
  `city` varchar(32) NOT NULL,
  `state` char(3) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `precinct` int(11) NOT NULL,
  `dob` date NOT NULL,
  `sex` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `term_began` date NOT NULL,
  `status` varchar(16) NOT NULL,
  `status_date` date NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `members`
-- ----------------------------
BEGIN;
INSERT INTO `members` VALUES ('1', 'James', 'Christopher', 'Woodard', 'Chris', 'elected', '6013 N Dexter Ave', 'Tampa', 'FL', '33604', '237', '1959-11-06', 'male', 'sciprojguy@gmail.com', '(813) 240-0792', '0000-00-00', 'removed', '2012-02-25', ''), ('2', 'James', 'Christopher', 'Woodard', 'Mr Chairman', 'elected', '6013 N Dexter Ave', 'Tampa', 'FL', '33604', '237', '1959-11-06', 'male', 'sciprojguy@gmail.com', '(813) 240-0792', '2008-01-21', 'active', '2012-02-26', ''), ('3', 'Karleen', '', 'Kos', '', 'elected', '1600 Pennsylvania Ave', 'Tampa', 'FL', '33333', '201', '1987-02-26', '', 'karleen@gmail.com', '(813) 123-4567', '2010-02-03', 'current', '2012-02-05', ''), ('4', 'Megan', '', 'Gerkin', '', 'member', '1234 N 56th St', 'Tampa', 'FL', '33321', '666', '1988-02-23', '', 'meg.gerken16@gmail.com', '(800) 888-8888', '2012-02-01', 'current', '2012-02-27', ''), ('5', 'Kenya', '', 'Jenkins', '', 'nonmember', 'none given', 'tampa', '', '33333', '66', '1996-06-03', 'female', 'none@nowhere.net', 'none', '2012-06-01', 'active', '0000-00-00', 'intern'), ('6', 'Christopher', '', 'Mitchell', '', 'elected', '11', '11', '', '11', '119', '1989-06-01', 'male', '11', '11', '2007-11-05', 'active', '0000-00-00', 'current chair');
COMMIT;

-- ----------------------------
--  Table structure for `messages`
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` char(16) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `date_sent` datetime NOT NULL,
  `date_read` datetime NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `news`
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `link` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` char(16) NOT NULL,
  `front_page` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `news`
-- ----------------------------
BEGIN;
INSERT INTO `news` VALUES ('6', '2012-06-02 12:25:25', 'http://www.google.com', 'Special Announcement', 'active', '1'), ('5', '2012-06-01 12:28:44', 'http://us1.campaign-archive2.com/?u=bbf641b7b3417d834ef8dd1dc&id=4edae2b89e&e=[UNIQID]', 'May 3, 2012 - <strong>LATEST NEWS</strong> from the Hillsborough Democratic Party', 'active', '0');
COMMIT;

-- ----------------------------
--  Table structure for `offices`
-- ----------------------------
DROP TABLE IF EXISTS `offices`;
CREATE TABLE `offices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(32) NOT NULL,
  `title` varchar(96) NOT NULL,
  `district` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `sortOrder` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `offices`
-- ----------------------------
BEGIN;
INSERT INTO `offices` VALUES ('1', 'Presidential', 'President', '', '', '1'), ('12', 'Federal', 'US Senate', '', '', '2'), ('13', 'Federal', 'US House District 12', '', '', '2'), ('14', 'Federal', 'US House District 14', '', '', '2'), ('15', 'Federal', 'US House District 15', '', '', '2'), ('11', 'Presidential', 'Vice President', '', '', '1'), ('17', 'State', 'Governor', '', '', '3'), ('18', 'State', 'Lieutenant Governor', '', '', '3'), ('19', 'State', 'Attorney General', '', 'Cabinet', '3'), ('20', 'State', 'Commissioner of Agriculture', '', '', '3'), ('21', 'County', 'State Attorney', '', '', '7'), ('22', 'County', 'Public Defender', '', '', '7'), ('23', 'State', 'State Senate District 17', '', '', '4'), ('24', 'State', 'State Senate District 19', '', '', '4'), ('25', 'State', 'State Senate District 22', '', '', '4'), ('26', 'State', 'State Senate District 24', '', '', '4'), ('55', 'State', 'State House District 64', '64', '', '5'), ('54', 'Federal', 'US House District 17', '17', '', '2'), ('53', 'Federal', 'US House District 17', '17', '', '0'), ('30', 'State', 'State House District 57', '', '', '5'), ('31', 'State', 'State House District 58', '', '', '5'), ('32', 'State', 'State House District 59', '', '', '5'), ('33', 'State', 'State House District 60', '', '', '5'), ('34', 'State', 'State House District 61', '', '', '5'), ('35', 'State', 'State House District 62', '', '', '5'), ('36', 'State', 'State House District 63', '', '', '5'), ('37', 'State', 'State House District 67', '', '', '5'), ('38', 'State', 'State House District 70', '', '', '5'), ('39', 'County', 'Clerk of Circuit Court', '', '', '7'), ('40', 'County', 'Sheriff', '', '', '7'), ('41', 'County', 'Property Appraiser', '', '', '7'), ('42', 'County', 'Tax Collector', '', '', '7'), ('43', 'County', 'Supervisor of Elections', '', '', '7'), ('44', 'County', 'County Commission District 1', '', '', '7'), ('45', 'County', 'County Commission District 2', '', '', '7'), ('46', 'County', 'County Commission District 3', '', '', '7'), ('47', 'County', 'County Commission District 4', '', '', '7'), ('48', 'County', 'County Commission District 5', '', '', '7'), ('49', 'County', 'County Commission District 6', '', '', '7'), ('50', 'County', 'County Commission District 7', '', '', '7'), ('52', 'Federal', 'US House District 17', '', '', '2'), ('51', 'State', 'State Senate District 26', '', '', '4');
COMMIT;

-- ----------------------------
--  Table structure for `role_privs`
-- ----------------------------
DROP TABLE IF EXISTS `role_privs`;
CREATE TABLE `role_privs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `priv_name` varchar(32) NOT NULL,
  `status` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(48) NOT NULL,
  `role_description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `roles`
-- ----------------------------
BEGIN;
INSERT INTO `roles` VALUES ('1', 'manage_news', 'Add/edit/delete news items and promote items to appear on front page'), ('2', 'manage_alerts', 'Add/edit/delete news crawler alerts'), ('3', 'manage_clubs', 'add/edit information on clubs and caucuses'), ('4', 'manage_volunteers', 'fetch volunteers from volunteer page'), ('5', 'manage_calendar', 'Add/Edit/delete calendared events'), ('6', 'manage_candidates', 'add/edit/delete information on current Democratic candidates');
COMMIT;

-- ----------------------------
--  Table structure for `user_roles`
-- ----------------------------
DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `user_roles`
-- ----------------------------
BEGIN;
INSERT INTO `user_roles` VALUES ('1', '2', 'manage_members'), ('2', '2', 'manage_users'), ('4', '2', 'manage_alerts'), ('5', '2', 'manage_events'), ('13', '2', 'manage_volunteers'), ('12', '4', 'manage_volunteers'), ('8', '4', 'manage_alerts'), ('9', '2', 'manage_candidates'), ('10', '2', 'manage_officials'), ('11', '2', 'manage_clubs'), ('14', '2', 'manage_calendar'), ('15', '2', 'manage_news');
COMMIT;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `enc_passwd` varchar(48) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` char(16) NOT NULL,
  `status_dt` datetime NOT NULL,
  `type` char(8) NOT NULL,
  `member_id` int(11) NOT NULL,
  `failed_login_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('3', 'chris.mitchell', '8cc6cdba3bd6dd73b33f58e762a36d47', 'chris.mitchell@gmail.com', 'active', '2012-02-26 10:43:58', 'user', '2', '0'), ('2', 'chris.woodard', 'f7b331082fc5768460dd5eedefc37c5d', 'sciprojguy@gmail.com', 'new', '2012-02-18 10:24:40', 'admin', '1', '0'), ('4', 'karleen.kos', '0dc1f3b2873eac476003ae4d30492486', 'kkos1423@gmail.com', 'active', '2012-02-26 10:44:42', 'user', '3', '0'), ('7', 'megan.gerkin', '28116cbe67568f61263d22ea0b4c0e41', 'meg.gerken16@gmail.com', 'active', '2012-02-13 14:49:07', 'user', '4', '0');
COMMIT;

-- ----------------------------
--  Table structure for `volunteers`
-- ----------------------------
DROP TABLE IF EXISTS `volunteers`;
CREATE TABLE `volunteers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `street` varchar(48) NOT NULL,
  `city` varchar(32) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `best_contact_method` varchar(8) NOT NULL,
  `best_time_and_days` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `registered_dem_hillsborough` char(1) NOT NULL,
  `member_of_hillsborough_dec` char(1) NOT NULL,
  `volunteered_with_hillsborough_dec` char(1) NOT NULL,
  `volunteered_other_orgs` char(1) NOT NULL,
  `which_ones` varchar(255) NOT NULL,
  `ip` char(16) NOT NULL,
  `requestTimeStamp` datetime NOT NULL,
  `precinct` char(8) NOT NULL,
  `phone_banking` char(1) NOT NULL,
  `vol_recruitment` char(1) NOT NULL,
  `vol_scheduling` char(1) NOT NULL,
  `data_entry` char(1) NOT NULL,
  `fundraising_host` char(1) NOT NULL,
  `canvassing` char(1) NOT NULL,
  `event_coordinator` char(1) NOT NULL,
  `booth_volunteer` char(1) NOT NULL,
  `candidate_support` char(1) NOT NULL,
  `precinct_assistance` char(1) NOT NULL,
  `high_traffic_canvassing` char(1) NOT NULL,
  `neighborhood_team_leader` char(1) NOT NULL,
  `write_to_elected_officials` char(1) NOT NULL,
  `community_outreach` char(1) NOT NULL,
  `other` char(1) NOT NULL,
  `other_what` varchar(255) NOT NULL,
  `cmte_affirmative_action` char(1) NOT NULL,
  `cmte_campaign_precinct` char(1) NOT NULL,
  `cmte_bylaws` char(1) NOT NULL,
  `cmte_credentials` char(1) NOT NULL,
  `cmte_membership` char(1) NOT NULL,
  `cmte_finance` char(1) NOT NULL,
  `cmte_legislative` char(1) NOT NULL,
  `cmte_platform` char(1) NOT NULL,
  `cmte_publicity` char(1) NOT NULL,
  `cmte_it` char(1) NOT NULL,
  `cmte_legal` char(1) NOT NULL,
  `cmte_labor` char(1) NOT NULL,
  `dateandtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `volunteers`
-- ----------------------------
BEGIN;
INSERT INTO `volunteers` VALUES ('1', 'Chris Woodard', '6013 N Dexter Ave', 'Tampa', '33604', '', 'sciprojguy@gmail.com', 'email', 'any time by email', '', 'Y', 'Y', 'Y', 'Y', 'Russ Patterson\'s campaign, Pat Kemp\'s campaign', '127.0.0.1', '0000-00-00 00:00:00', '237', '', '', '', '', '', '', '', '', 'Y', '', '', '', '', '', 'Y', 'web site', '', '', '', '', '', '', '', '', 'Y', 'Y', '', '', '0000-00-00 00:00:00'), ('2', 'Holden MaGroyne', '1313 Mockingbird Lane', 'Tampa', '33333', '8132370000', '', 'phone', 'none', '', 'N', 'N', 'N', 'N', '', '127.0.0.1', '0000-00-00 00:00:00', '111', 'Y', 'Y', 'Y', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Y', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00'), ('3', 'Ben Dover', '6013 N Dexter Ave', 'Tampa', '33604', '(813) 237-6666', 'none@nowhere.net', 'phone', 'any time', '', 'Y', 'Y', 'Y', 'Y', 'russ patterson campaign', '127.0.0.1', '0000-00-00 00:00:00', '237', '', '', '', '', '', 'Y', 'Y', 'Y', '', '', '', '', '', '', 'Y', 'organize fishing trips', '', '', '', '', '', '', 'Y', '', '', '', '', '', '0000-00-00 00:00:00'), ('4', 'Chris Woodard', '6013 N Dexter Ave', 'Tampa', '33604', '813 240 0792', 'sciprojguy@gmail.com', 'phone', 'any evening', '', 'Y', 'Y', 'Y', 'Y', 'russ patterson campaign, pat kemp campaign', '127.0.0.1', '0000-00-00 00:00:00', '237', '', '', '', '', '', '', '', '', '', 'Y', '', '', 'Y', '', 'Y', 'web site', '', '', '', '', '', '', '', '', 'Y', 'Y', '', '', '0000-00-00 00:00:00');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
