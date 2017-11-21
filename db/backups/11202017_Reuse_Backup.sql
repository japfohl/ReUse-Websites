-- MySQL dump 10.13  Distrib 5.7.19, for macos10.12 (x86_64)
--
-- Host: localhost    Database: reuse
-- ------------------------------------------------------
-- Server version	5.7.19

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

DROP TABLE IF EXISTS `Resource_Type`;
DROP TABLE IF EXISTS `Reuse_Categories`;
DROP TABLE IF EXISTS `Reuse_Documents`;
DROP TABLE IF EXISTS `Reuse_Donors`;
DROP TABLE IF EXISTS `Reuse_Items`;
DROP TABLE IF EXISTS `Reuse_Locations`;
DROP TABLE IF EXISTS `Reuse_Locations_Items`;
DROP TABLE IF EXISTS `Reuse_User_Credentials`;
DROP TABLE IF EXISTS `States`;
DROP TABLE IF EXISTS `phinxlog`;
DROP TABLE IF EXISTS `Reuse_Items_Categories`;

--
-- Table structure for table `Resource_Type`

--
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Resource_Type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Resource_Type`
--

LOCK TABLES `Resource_Type` WRITE;
/*!40000 ALTER TABLE `Resource_Type` DISABLE KEYS */;
INSERT INTO `Resource_Type` VALUES (0,'reuse'),(1,'repair'),(2,'recycle');
/*!40000 ALTER TABLE `Resource_Type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Reuse_Categories`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Reuse_Categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Reuse_Categories`
--

LOCK TABLES `Reuse_Categories` WRITE;
/*!40000 ALTER TABLE `Reuse_Categories` DISABLE KEYS */;
INSERT INTO `Reuse_Categories` VALUES (1,'Household'),(2,'Bedding / Bath and beyond'),(3,'Children\'s Goods'),(4,'Appliances - Small'),(5,'Appliances - Large'),(6,'Building / Home Improvement'),(7,'Wearable Items'),(8,'Usable Electronics'),(9,'Sporting Equipment / Camping'),(10,'Garden'),(11,'Food'),(12,'Medical Supplies'),(13,'Office Equipment'),(14,'Packing Materials'),(15,'Miscellaneous'),(16,'Repair Items'),(18,'test'),(19,'Electronics');
/*!40000 ALTER TABLE `Reuse_Categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Reuse_Documents`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Reuse_Documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `URI` text NOT NULL,
  `location_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_location_id` (`location_id`),
  CONSTRAINT `fk_location_id` FOREIGN KEY (`location_id`) REFERENCES `Reuse_Locations` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Reuse_Documents`
--

LOCK TABLES `Reuse_Documents` WRITE;
/*!40000 ALTER TABLE `Reuse_Documents` DISABLE KEYS */;
INSERT INTO `Reuse_Documents` VALUES (1,'Recycle Depot','http://site.republicservices.com/site/corvallis-or/en/documents/corvallisrecycledepot.pdf',97),(2,'Recycling Guidelines','http://site.republicservices.com/site/corvallis-or/en/documents/detailedrecyclingguide.pdf',97),(3,'Curbside Recycling','http://site.republicservices.com/site/corvallis-or/en/documents/2013corvrecyclehandout.pdf',97),(4,'my_special_document','https://www.google.com',1);
/*!40000 ALTER TABLE `Reuse_Documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Reuse_Donors`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Reuse_Donors` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(90) NOT NULL,
  `WebsiteURL` text NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Reuse_Donors`
--

LOCK TABLES `Reuse_Donors` WRITE;
/*!40000 ALTER TABLE `Reuse_Donors` DISABLE KEYS */;
INSERT INTO `Reuse_Donors` VALUES (1,'Test Donor','www.example.com','Does something asesome!');
/*!40000 ALTER TABLE `Reuse_Donors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Reuse_Items`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Reuse_Items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_category_id` (`category_id`),
  CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `Reuse_Categories` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=199 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Reuse_Items`
--

LOCK TABLES `Reuse_Items` WRITE;
/*!40000 ALTER TABLE `Reuse_Items` DISABLE KEYS */;
INSERT INTO `Reuse_Items` VALUES (1,'Arts and Crafts',1),(2,'Barbeque Grills',1),(3,'Books',1),(4,'Canning Jars',1),(5,'Cleaning Supplies are in',1),(6,'Clothes Hangers',1),(7,'Cookware',1),(8,'Dishes',1),(9,'Fabric',1),(10,'Food Storage Containers',1),(11,'Furniture',1),(12,'Luggage',1),(13,'Mattresses',1),(14,'Ornaments',1),(15,'Toiletries',1),(16,'Utensils',1),(17,'Blankets',2),(18,'Comforters',2),(19,'Linens',2),(20,'Sheets',2),(21,'Small Rugs',2),(22,'Towels',2),(23,'Arts and Crafts',3),(24,'Baby Carriers',3),(25,'Baby Gates',3),(26,'Bike Trailers',3),(27,'Books',3),(28,'Child Car Seats',3),(29,'Clothes',3),(30,'Crayons',3),(31,'Cribs',3),(32,'Diapers',3),(33,'High Chairs',3),(34,'Maternity',3),(35,'Musical Instruments',3),(36,'Nursing Items',3),(37,'Playpens',3),(38,'School Supplies',3),(39,'Strollers',3),(40,'Toys',3),(41,'Blenders',4),(42,'Dehumidifiers',4),(43,'Fans',4),(44,'Microwaves',4),(45,'Space Heaters',4),(46,'Toasters',4),(47,'Vacuum Cleaners',4),(48,'Dishwashers',5),(49,'Freezers',5),(50,'Refridgerators',5),(51,'Stoves',5),(52,'Washers / Dryers',5),(53,'Bricks',6),(54,'Carpet Padding',6),(55,'Carpets',6),(56,'Ceramic Tiles',6),(57,'Doors',6),(58,'Drywall',6),(59,'Electrical Supplies',6),(60,'Hand Tools',6),(61,'Hardware',6),(62,'Insulation',6),(63,'Ladders',6),(64,'Light Fixtures',6),(65,'Lighting Ballasts',6),(66,'Lumber',6),(67,'Motors',6),(68,'Paint',6),(69,'Pipe',6),(70,'Plumbing',6),(71,'Power Tools',6),(72,'Reusable Metal Items',6),(73,'Roofing',6),(74,'Vinyl',6),(75,'Windows',6),(76,'Belts',7),(77,'Boots',7),(78,'Clothes',7),(79,'Coats',7),(80,'Hats',7),(81,'Rainwear',7),(82,'Sandals',7),(83,'Shoes',7),(84,'Calculators',8),(85,'Cameras',8),(86,'Cassette Players',8),(87,'CD Players',8),(88,'CDs',8),(89,'Cell Phones',8),(90,'Computers',8),(91,'Curling Irons',8),(92,'DVD Players',8),(93,'Game Consoles',8),(94,'GPS Systems',8),(95,'Hair Dryers',8),(96,'Monitors',8),(97,'MP3 Players',8),(98,'Printers',8),(99,'Projectors',8),(100,'Receivers',8),(101,'Scanners',8),(102,'Speakers',8),(103,'Tablets',8),(104,'Telephones',8),(105,'TVs',8),(106,'Backpacks',9),(107,'Balls',9),(108,'Barbells',9),(109,'Bicycles',9),(110,'Bike Tires',9),(111,'Camping Equipment',9),(112,'Day Packs',9),(113,'Dumbbells',9),(114,'Exercise Equipment',9),(115,'Golf Clubs',9),(116,'Helmets',9),(117,'Hiking Boots',9),(118,'Skateboards',9),(119,'Skis',9),(120,'Small Boats',9),(121,'Snowshoes',9),(122,'Sporting Goods',9),(123,'Tennis Rackets',9),(124,'Tents',9),(125,'Chain Saws',10),(126,'Fencing',10),(127,'Garden Pots',10),(128,'Garden Tools',10),(129,'Hand Clippers',10),(130,'Hoses',10),(131,'Lawn Furniture',10),(132,'Livestock Supplies',10),(133,'Loppers',10),(134,'Mowers',10),(135,'Seeders',10),(136,'Soil Amendment',10),(137,'Sprinklers',10),(138,'Wheelbarrows',10),(139,'Beverages',11),(140,'Surplus Garden Produce',11),(141,'Unopened Canned Goods',11),(142,'Unopened Packaged Goods',11),(143,'Adult Diapers',12),(144,'Blood Pressure Monitors',12),(145,'Canes',12),(146,'Crutches',12),(147,'Eye Glasses',12),(148,'Glucose Meters',12),(149,'Hearing Aids',12),(150,'Hospital Beds',12),(151,'Reach Extenders',12),(152,'Shower Chairs',12),(153,'Walkers',12),(154,'Wheelchairs',12),(155,'Calculators',13),(156,'Computers',13),(157,'Fax Machines',13),(158,'Headsets',13),(159,'Monitors',13),(160,'Office Furniture',13),(161,'Paper Shredder',13),(162,'Print Cartridge Refilling',13),(163,'Printers',13),(164,'Scanners',13),(165,'Telephones',13),(166,'Bubble Wrap',14),(167,'Clean Foam Peanuts',14),(168,'Foam Sheets',14),(169,'Egg Cartons',15),(170,'Firewood',15),(171,'Fabric',15),(172,'Paper Bags',15),(173,'Pet Supplies',15),(174,'Shopping Bags',15),(175,'Vehicles / Parts',15),(176,'Computer Paper',15),(177,'Reusable metal Items',15),(178,'Cell Phones',16),(179,'Small Appliances',16),(180,'Books',16),(181,'Clothes',16),(182,'Computers',16),(183,'Furniture',16),(184,'Lamps',16),(185,'Lawn Power Equipment',16),(186,'Outdoor Gear',16),(187,'Sandals',16),(188,'Shoes/Boots',16),(189,'Upholstery (Car)',16),(190,'Upholstery (Furniture)',16),(193,'Gray\'s Furniture Repair',1),(194,'Upholstery (Furniture)',1),(195,'Cell Phones',19),(196,'Computers',19),(197,'Lawn Power Equipment',10),(198,'Misc Small Appliances',4);
/*!40000 ALTER TABLE `Reuse_Items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Reuse_Locations`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Reuse_Locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address_line_1` varchar(255) DEFAULT NULL,
  `address_line_2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `zip_code` int(11) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `latitude` float(12,8) DEFAULT NULL,
  `longitude` float(12,8) DEFAULT NULL,
  `Recycle` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_state_id` (`state_id`),
  CONSTRAINT `fk_state_id` FOREIGN KEY (`state_id`) REFERENCES `States` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Reuse_Locations`
--

LOCK TABLES `Reuse_Locations` WRITE;
/*!40000 ALTER TABLE `Reuse_Locations` DISABLE KEYS */;
INSERT INTO `Reuse_Locations` VALUES (1,'Albany-Corvallis ReUseIt',NULL,NULL,NULL,NULL,NULL,NULL,'https://groups.yahoo.com/neo/groups/albanycorvallisReUseIt/info',NULL,NULL,0),(2,'Arc Thrift Stores (Corvallis)','928 NW Beca Ave',NULL,'Corvallis',37,97330,'5417549011','http://www.arcbenton.org/',44.57819366,-123.26132965,0),(3,'Arc Thrift Stores (Philomath)','936 Main St',NULL,'Philomath',37,97370,'5419293946','http://www.arcbenton.org/',44.54017639,-123.37325287,0),(5,'Benton County Extension / 4-H  Activities','1849 NW 9th',NULL,'Corvallis',37,97330,'5417666750','http://extension.oregonstate.edu/benton/',44.58611679,-123.25634003,0),(6,'Benton County Master Gardeners','1849 NW 9th St',NULL,'Corvallis',37,97330,'5417666750','http://extension.oregonstate.edu/benton/horticulture/mg',44.58611679,-123.25634003,0),(7,'Book Bin  ','215 SW 4th St',NULL,'Corvallis',37,97330,'5417520040','http://bookbin.com/',44.56326294,-123.26229858,0),(8,'Browser\'s Bookstore','121 NW 4th St',NULL,'Corvallis',37,97330,'8887581121','http://www.browsersbookstore.com/',44.56497955,-123.26142120,0),(9,'Boys & Girls Club / STARS (After School Program)','1112 NW Circle Blvd',NULL,'Corvallis',37,97330,'5417571909','http://www.bgccorvallis.org/',44.58867645,-123.26407623,0),(12,'CARDV (Center Against Rape / Domestic Violence)','4786 SW Philomath Blvd',NULL,'Corvallis',37,97330,'5417580219','http://cardv.org/',44.55294800,-123.30515289,0),(13,'Career Closet for Women (Drop-Off Location)',' 942 NW 9th, Ste.A',NULL,'Corvallis',37,97330,'5417546979','https://sicorvallis.wordpress.com/',44.57432175,-123.26340485,0),(14,'Cat\'s Meow Humane Society Thrift Shop','411 SW 3rd St',NULL,'Corvallis',37,97330,'5417570573','http://www.heartlandhumane.org/',44.56117249,-123.26249695,0),(15,'Children\'s Farm Home','4455 NE Hwy 20',NULL,'Corvallis',37,97330,'5417571852','http://www.trilliumfamily.org/',44.60430527,-123.21385956,0),(16,'Chintimini Wildlife Rehabilitation Ctr','311 Lewisburg Rd',NULL,'Corvallis',37,97330,'5417455324','http://www.chintiminiwildlife.org/',44.63098145,-123.24715424,0),(17,'Community Outreach (Homeless Shelter)','865 NW Reiman',NULL,'Corvallis',37,97330,'5417583000','http://www.communityoutreachinc.org/services/emergency-shelter-program/family-shelter/',44.57332611,-123.26248932,0),(18,'Corvallis Environmental Center','214 SW Monroe Ave',NULL,'Corvallis',37,97330,'5417539211','http://www.corvallisenvironmentalcenter.org/',44.56412888,-123.26015472,0),(19,'Corvallis Bicycle Collective','33900 SE Roche Ln/Hwy 34',NULL,'Corvallis',37,97330,'5412246885','http://corvallisbikes.org/',0.00000000,0.00000000,0),(20,'Corvallis Furniture','720 NE Granger Ave, Bldg J',NULL,'Corvallis',37,97330,'5412318103','http://corvallisfurniture.com/',44.62865448,-123.23441315,0),(23,'Corvallis.craigslist.org And Freecycle.org',NULL,NULL,'Corvallis',37,97330,NULL,'https://corvallis.craigslist.org/',NULL,NULL,0),(24,'First Alternative Co-op Recycling Center','1007 SE 3rd St',NULL,'Corvallis',37,97330,'5417533115','http://firstalt.coop/programs/recycling-center/',44.55381012,-123.26457214,0),(25,'First Alternative Co-op Store (South Store)','1007 SE 3rd St',NULL,'Corvallis',37,97330,'5417533115','http://firstalt.coop/',44.55381012,-123.26457214,0),(26,'First Alternative Co-op Store (North Store)','2855 NW Grant Ave',NULL,'Corvallis',37,97330,'5414523115','http://firstalt.coop/',44.57893372,-123.28259277,0),(27,'Furniture Exchange','210 NW 2nd St',NULL,'Corvallis',37,97330,'5418330183','http://www.furnitureexchange-usa.com/',44.56529236,-123.25929260,0),(28,'Furniture Share (Formerly Benton FS)','155 SE Lilly Ave',NULL,'Corvallis',37,97330,'5417549511','http://furnitureshare.org/',44.54851913,-123.26477814,0),(29,'Home Grown Gardens','4845 SE 3rd St',NULL,'Corvallis',37,97330,'5417582137','http://homegrowngardens77.vpweb.com/',44.51180267,-123.26898193,0),(31,'Goodwill Industries ','1325 NW 9th St',NULL,'Corvallis',37,97330,'5417528278','http://www.goodwill.org/locator/',44.57826233,-123.25963593,0),(32,'Habitat for Humanity ReStore','4840 SW Philomath Blvd',NULL,'Corvallis',37,97330,'5417526637','http://bentonhabitat.org/',44.55203247,-123.30587769,0),(33,'Happy Trails Records, Tapes & CDs','100 SW 3rd St',NULL,'Corvallis',37,97330,'5417529032','http://www.corvallisbusiness.com/happytrails.html',44.56425476,-123.26104736,0),(34,'Heartland Humane Society ','398 SW Twin Oaks Cir',NULL,'Corvallis',37,97330,'5417579000','http://www.heartlandhumane.org/',44.55315781,-123.26878357,0),(35,'Home Life Inc (For Developmentally Disabled Individuals)',' 2068 NW Fillmore',NULL,'Corvallis',37,97330,'5417539015','http://homelifeinc.org/',44.57542801,-123.27605438,0),(36,'Jackson Street Youth Shelter','555 NW Jackson St',NULL,'Corvallis',37,97330,'5417542404','http://www.jsysi.org/',44.56627274,-123.26304626,0),(37,'Linn Benton Food Share (For Large Food Donations)','545 SW 2nd',NULL,'Corvallis',37,97330,'5417521010','http://communityservices.us/nutrition/detail/category/linn-benton-food-share/',44.55927658,-123.26192474,0),(38,'Lions Club (Using A Box Inside Elks Lodge)','1400 NW 9th St',NULL,'Corvallis',37,97330,'5417580222','http://www.e-clubhouse.org/sites/midvalley/',44.58000946,-123.26043701,0),(39,'Love INC (For Low Income Citizens)','2330 NW Professional Dr #102',NULL,'Corvallis',37,97330,'5417578111','http://www.yourloveinc.org/',44.58998871,-123.27799988,0),(40,'Mario Pastega House (Good Samaritan Patient Family Housing)','3505 NW Samaritan Dr',NULL,'Corvallis',37,97330,'5417684650','http://www.samhealth.org/locations/mariopastegahouse/Pages/default.aspx',44.60397720,-123.25012970,0),(41,'Mary\'s River Gleaners (For Low Income Citizens)','Po Box 2309',NULL,'Corvallis',37,97330,'5417521010',NULL,44.63780975,-123.27503967,0),(42,'Midway Farms (On Hwy 20 Between Corvallis & Albany)','6980 US-20',NULL,'Albany',37,97370,'5417406141','http://www.midwayfarmsoregon.com/',0.00000000,0.00000000,0),(43,'Neighbor to Neighbor (Food Pantry)','1123 Main, Philomath',NULL,'Philomath',37,97370,'5419296614',NULL,44.54108429,-123.36985016,0),(45,'OSU Emergency Food Pantry','2150 SW Jefferson Way',NULL,'Corvallis',37,97330,'5417373473','http://studentlife.oregonstate.edu/hsrc/osu-emergency-food-pantry',0.00000000,0.00000000,0),(46,'OSU Folk Club Thrift Shop','144 NW 2nd St',NULL,'Corvallis',37,97330,'5417524733','http://oregonstate.edu/osufolk/hours',44.56499481,-123.25975037,0),(47,'OSU Organic Growers Club (Crop & Soil Science Dept)',NULL,NULL,'Corvallis',37,97330,'5417376810','http://cropandsoil.oregonstate.edu/organic_grower',NULL,NULL,0),(48,'Pak Mail (Timberhill Shopping Center)','2397 NW Kings Blvd',NULL,'Corvallis',37,97330,'5417548411','http://www.pakmail.com/stores/pak-mail-corvallis/',44.59074783,-123.27599335,0),(51,'Philomath Community Garden (Chris Shonnard)',NULL,NULL,'Corvallis',37,97330,'5419293524','http://philomathcommunityservices.org/',NULL,NULL,0),(52,'Philomath Community Services (Food And Kids Items)','360 S 9th',NULL,'Philomath',37,97370,'5419292499','http://philomathcommunityservices.org/',44.53768158,-123.37474060,0),(53,'Play It Again Sports ','1422 NW 9th St',NULL,'Corvallis',37,97330,'5417547529','http://www.playitagainsportscorvallis.com/',44.58074951,-123.26006317,0),(54,'Presbyterian Piecemakers (Cotton Quilts)','114 SW 8th St',NULL,'Corvallis',37,97330,'5417537516','http://1stpres.org/',44.56543350,-123.26696014,0),(55,'Friends of the Public Library Corvallis','645 NW Monroe Ave',NULL,'Corvallis',37,97330,'5417666928','http://cbcpubliclibrary.net/',44.56563568,-123.26441956,0),(56,'Quilts From Caring Hands (Cotton Quilts)','1495 NW 20th St,',NULL,'Corvallis',37,97330,'5417588161','http://www.quiltsfromcaringhands.com/',44.58114624,-123.27321625,0),(57,'Rapid Refill Ink ','254 SW Madison Ave',NULL,'Corvallis',37,97330,'5417588444','http://www.rapidinkandtoner.com/oregon/corvallis-store-0107',44.56321335,-123.26094055,0),(58,'Revolve (Women\'s Resale Boutique)','103 SW 2nd St',NULL,'Corvallis',37,97330,'5417541154','http://www.revolveresale.com/',44.56394196,-123.25986481,0),(59,'Schools (Public, Private, Charter)',NULL,NULL,'Corvallis',37,97330,'various','http://www.glanceagain.com/',NULL,NULL,0),(60,'Second Glance','312 SW 3rd Street',NULL,'Corvallis',37,97330,'5417589099','http://www.glanceagain.com/',44.56217575,-123.26210785,0),(61,'The Annex','214 SW Jefferson',NULL,'Corvallis',37,97330,'5417589099','http://www.glanceagain.com/',0.00000000,0.00000000,0),(62,'The Alley','312 SW Jefferson',NULL,'Corvallis',37,97330,'5417534069','http://www.glanceagain.com/2011/11/second-glance-alley/',0.00000000,0.00000000,0),(63,'Senior Center of Corvallis','2601 NW Tyler Ave',NULL,'Corvallis',37,97330,'5417666959','http://www.corvallisoregon.gov/index.aspx?page=257',44.57322311,-123.28006744,0),(64,'South Corvallis Food Bank','1798 SW 3rd St',NULL,'Corvallis',37,97330,'5417534263','http://www.southcorvallisfoodbank.org/',44.54801941,-123.26564789,0),(65,'St. Vincent de Paul Food Bank','501 NW 25 th Street',NULL,'Corvallis',37,97330,'5417571988',NULL,44.57316971,-123.27836609,0),(66,'Stone Soup  (St Mary\'s Church)','501 NW 25th Street',NULL,'Corvallis',37,97330,'5417571988','http://www.stonesoupcorvallis.org/about.html',44.57316971,-123.27836609,0),(67,'UPS Store ( Philomath)','5060 SW Philomath Blvd',NULL,'Corvallis',37,97330,'5417521830','https://corvallis-or-5088.theupsstorelocal.com/',44.55183411,-123.30871582,0),(68,'UPS Store (Corvallis)','922 NW Circle Blvd #160',NULL,'Corvallis',37,97330,'5417520056','https://corvallis-or-5088.theupsstorelocal.com/',44.58813477,-123.25729370,0),(69,'Vina Moses (For Low Income Citizens)','968 NW Garfield Ave',NULL,'Corvallis',37,97330,'5417531420','http://www.vinamoses.org/',44.58293152,-123.26055908,0),(70,'Spaeth Heritage House','135 N 13th St',NULL,'Philomath',37,97370,'5413070349','http://www.spaethlumber.com/main/home/main.aspx',44.54053116,-123.36775970,0),(71,'Book Binding','108 SW 3rd St',NULL,'Corvallis',37,97333,'5417579861','http://www.cornerstoneassociates.com/bj-bookbinding-about-us.html',44.56419754,-123.26107788,0),(72,'Cell Phone Sick Bay','252 SW Madison Ave Suite 110',NULL,'Corvallis',37,97333,'5412301785','http://www.cellsickbay.com/index.html',44.56320953,-123.26093292,0),(73,'Geeks \'N\' Nerds','950 SE Geary St Unit D',NULL,'Albany',37,97321,'5417530018','http://www.computergeeksnnerds.com/',44.63270569,-123.08404541,0),(74,'Specialty Sewing By Leslie','225 SW Madison Ave',NULL,'Corvallis',37,97333,'5417584556','http://www.specialtysewing.com/Leslie_Seamstress/Welcome.html',44.56323624,-123.26068115,0),(75,'Covallis Technical','966 NW Circle Blvd',NULL,'Corvallis',37,97333,'5417047009','http://www.corvallistechnical.com/',44.58808517,-123.25887299,0),(76,'Bellevue Computers','1865 NW 9th St',NULL,'Corvallis',37,97333,'5417573487','http://www.bellevuepc.com/',44.58635330,-123.25621033,0),(77,'OSU Repair Fair','644 SW 13th St',NULL,'Corvallis',37,97333,'5417375398','http://fa.oregonstate.edu/surplus/',44.56140518,-123.27258301,0),(78,'P.K. Furniture Repair & Refinishing','5270 Corvallis-Newport Hwy',NULL,'Corvallis',37,97333,'5412301727','http://www.pkfurniturerefinishing.net/',0.00000000,0.00000000,0),(79,'Furniture Restoration Center','1321 Main St',NULL,'Philomath',37,97370,'5419296681','http://restorationsupplies.com/',44.54015732,-123.36741638,0),(80,'Power Equipment','713 NE Circle Blvd',NULL,'Corvallis',37,97330,'5417578075','https://corvallispowerequipment.stihldealer.net/',44.58893585,-123.25012970,0),(81,'Footwise','301 SW Madison Ave #100',NULL,'Corvallis',37,97333,'5417570875','http://footwise.com/',44.56348038,-123.26158142,0),(82,'Robnett\'s','400 SW 2nd St',NULL,'Corvallis',37,97333,'5417535531','http://ww3.truevalue.com/robnetts/Home.aspx',44.56103134,-123.26177216,0),(83,'Sedlack','225 SW 2nd St',NULL,'Corvallis',37,97333,'5417521498','http://www.sedlaksshoes.net/',44.56277466,-123.26045227,0),(84,'Foam Man','2511 NW 9th St',NULL,'Corvallis',37,97333,'5417549378','http://www.thefoammancorvallis.com/',44.59328079,-123.25234222,0),(97,'Republic Services','110 NE Walnut Blvd',NULL,'Corvallis',37,97330,'5417540444','https://www.republicservices.com/residents/all-in-one-recycling',44.59219360,-123.25038147,1),(98,'First Alternative Coop South Store','1007 SE 3rd St',NULL,'Corvallis',37,97333,'5417533115','http://firstalt.coop/programs/recycling-center/',44.55381012,-123.26457214,1),(106,'Gray\'s Furniture Repair','834 Goldfish Farm Rd SE',NULL,'Albany',NULL,97321,'5419280455','http://www.graysfurniture.net/index.html',44.63470459,-123.04837799,0);
/*!40000 ALTER TABLE `Reuse_Locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Reuse_Locations_Items`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Reuse_Locations_Items` (
  `location_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `Type` int(11) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `fk_loc_id` (`location_id`),
  KEY `fk_type_id` (`Type`),
  KEY `fk_item_id` (`item_id`),
  CONSTRAINT `fk_item_id` FOREIGN KEY (`item_id`) REFERENCES `Reuse_Items` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_loc_id` FOREIGN KEY (`location_id`) REFERENCES `Reuse_Locations` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_type_id` FOREIGN KEY (`Type`) REFERENCES `Resource_Type` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1460 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Reuse_Locations_Items`
--

LOCK TABLES `Reuse_Locations_Items` WRITE;
/*!40000 ALTER TABLE `Reuse_Locations_Items` DISABLE KEYS */;
INSERT INTO `Reuse_Locations_Items` VALUES (1,1,0,NULL,1),(1,2,0,NULL,2),(1,3,0,NULL,3),(1,4,0,NULL,4),(1,5,0,NULL,5),(1,6,0,NULL,6),(1,7,0,NULL,7),(1,8,0,NULL,8),(1,9,0,NULL,9),(1,10,0,NULL,10),(1,11,0,NULL,11),(1,12,0,NULL,12),(1,13,0,NULL,13),(1,14,0,NULL,14),(1,15,0,NULL,15),(1,16,0,NULL,16),(1,17,0,NULL,17),(1,18,0,NULL,18),(1,19,0,NULL,19),(1,20,0,NULL,20),(1,21,0,NULL,21),(1,22,0,NULL,22),(1,23,0,NULL,23),(1,24,0,NULL,24),(1,25,0,NULL,25),(1,26,0,NULL,26),(1,27,0,NULL,27),(1,28,0,NULL,28),(1,29,0,NULL,29),(1,30,0,NULL,30),(1,31,0,NULL,31),(1,32,0,NULL,32),(1,33,0,NULL,33),(1,34,0,NULL,34),(1,35,0,NULL,35),(1,36,0,NULL,36),(1,37,0,NULL,37),(1,38,0,NULL,38),(1,39,0,NULL,39),(1,40,0,NULL,40),(1,41,0,NULL,41),(1,42,0,NULL,42),(1,43,0,NULL,43),(1,44,0,NULL,44),(1,45,0,NULL,45),(1,46,0,NULL,46),(1,47,0,NULL,47),(1,48,0,NULL,48),(1,49,0,NULL,49),(1,50,0,NULL,50),(1,51,0,NULL,51),(1,52,0,NULL,52),(1,53,0,NULL,53),(1,54,0,NULL,54),(1,55,0,NULL,55),(1,56,0,NULL,56),(1,57,0,NULL,57),(1,58,0,NULL,58),(1,59,0,NULL,59),(1,60,0,NULL,60),(1,61,0,NULL,61),(1,62,0,NULL,62),(1,63,0,NULL,63),(1,64,0,NULL,64),(1,65,0,NULL,65),(1,66,0,NULL,66),(1,67,0,NULL,67),(1,68,0,NULL,68),(1,69,0,NULL,69),(1,70,0,NULL,70),(1,71,0,NULL,71),(1,72,0,NULL,72),(1,73,0,NULL,73),(1,74,0,NULL,74),(1,75,0,NULL,75),(1,76,0,NULL,76),(1,77,0,NULL,77),(1,78,0,NULL,78),(1,79,0,NULL,79),(1,80,0,NULL,80),(1,81,0,NULL,81),(1,82,0,NULL,82),(1,83,0,NULL,83),(1,84,0,NULL,84),(1,85,0,NULL,85),(1,86,0,NULL,86),(1,87,0,NULL,87),(1,88,0,NULL,88),(1,89,0,NULL,89),(1,90,0,NULL,90),(1,91,0,NULL,91),(1,92,0,NULL,92),(1,93,0,NULL,93),(1,94,0,NULL,94),(1,95,0,NULL,95),(1,96,0,NULL,96),(1,97,0,NULL,97),(1,98,0,NULL,98),(1,99,0,NULL,99),(1,100,0,NULL,100),(1,101,0,NULL,101),(1,102,0,NULL,102),(1,103,0,NULL,103),(1,104,0,NULL,104),(1,105,0,NULL,105),(1,106,0,NULL,106),(1,107,0,NULL,107),(1,108,0,NULL,108),(1,109,0,NULL,109),(1,110,0,NULL,110),(1,111,0,NULL,111),(1,112,0,NULL,112),(1,113,0,NULL,113),(1,114,0,NULL,114),(1,115,0,NULL,115),(1,116,0,NULL,116),(1,117,0,NULL,117),(1,118,0,NULL,118),(1,119,0,NULL,119),(1,120,0,NULL,120),(1,121,0,NULL,121),(1,122,0,NULL,122),(1,123,0,NULL,123),(1,124,0,NULL,124),(1,125,0,NULL,125),(1,126,0,NULL,126),(1,127,0,NULL,127),(1,128,0,NULL,128),(1,129,0,NULL,129),(1,130,0,NULL,130),(1,131,0,NULL,131),(1,132,0,NULL,132),(1,133,0,NULL,133),(1,134,0,NULL,134),(1,135,0,NULL,135),(1,136,0,NULL,136),(1,137,0,NULL,137),(1,138,0,NULL,138),(1,139,0,NULL,139),(1,140,0,NULL,140),(1,141,0,NULL,141),(1,142,0,NULL,142),(1,143,0,NULL,143),(1,144,0,NULL,144),(1,145,0,NULL,145),(1,146,0,NULL,146),(1,147,0,NULL,147),(1,148,0,NULL,148),(1,149,0,NULL,149),(1,150,0,NULL,150),(1,151,0,NULL,151),(1,152,0,NULL,152),(1,153,0,NULL,153),(1,154,0,NULL,154),(1,155,0,NULL,155),(1,156,0,NULL,156),(1,157,0,NULL,157),(1,158,0,NULL,158),(1,159,0,NULL,159),(1,160,0,NULL,160),(1,161,0,NULL,161),(1,162,0,NULL,162),(1,163,0,NULL,163),(1,164,0,NULL,164),(1,165,0,NULL,165),(1,166,0,NULL,166),(1,167,0,NULL,167),(1,168,0,NULL,168),(1,169,0,NULL,169),(1,170,0,NULL,170),(1,171,0,NULL,171),(1,172,0,NULL,172),(1,173,0,NULL,173),(1,174,0,NULL,174),(1,175,0,NULL,175),(1,176,0,NULL,176),(1,177,0,NULL,177),(2,1,0,NULL,178),(2,2,0,NULL,179),(2,3,0,NULL,180),(2,4,0,NULL,181),(2,5,0,NULL,182),(2,6,0,NULL,183),(2,7,0,NULL,184),(2,8,0,NULL,185),(2,9,0,NULL,186),(2,11,0,NULL,187),(2,12,0,NULL,188),(2,13,0,NULL,189),(2,14,0,NULL,190),(2,16,0,NULL,191),(2,17,0,NULL,192),(2,18,0,NULL,193),(2,19,0,NULL,194),(2,20,0,NULL,195),(2,21,0,NULL,196),(2,22,0,NULL,197),(2,23,0,NULL,198),(2,24,0,NULL,199),(2,25,0,NULL,200),(2,26,0,NULL,201),(2,27,0,NULL,202),(2,28,0,NULL,203),(2,29,0,NULL,204),(2,30,0,NULL,205),(2,31,0,NULL,206),(2,32,0,NULL,207),(2,33,0,NULL,208),(2,34,0,NULL,209),(2,35,0,NULL,210),(2,36,0,NULL,211),(2,37,0,NULL,212),(2,38,0,NULL,213),(2,39,0,NULL,214),(2,40,0,NULL,215),(2,41,0,NULL,216),(2,42,0,NULL,217),(2,43,0,NULL,218),(2,44,0,NULL,219),(2,45,0,NULL,220),(2,46,0,NULL,221),(2,47,0,NULL,222),(2,76,0,NULL,223),(2,77,0,NULL,224),(2,78,0,NULL,225),(2,79,0,NULL,226),(2,80,0,NULL,227),(2,81,0,NULL,228),(2,82,0,NULL,229),(2,83,0,NULL,230),(2,84,0,NULL,231),(2,85,0,NULL,232),(2,86,0,NULL,233),(2,87,0,NULL,234),(2,88,0,NULL,235),(2,90,0,NULL,236),(2,91,0,NULL,237),(2,92,0,NULL,238),(2,93,0,NULL,239),(2,94,0,NULL,240),(2,95,0,NULL,241),(2,96,0,NULL,242),(2,97,0,NULL,243),(2,98,0,NULL,244),(2,99,0,NULL,245),(2,100,0,NULL,246),(2,101,0,NULL,247),(2,102,0,NULL,248),(2,103,0,NULL,249),(2,104,0,NULL,250),(2,105,0,NULL,251),(2,106,0,NULL,252),(2,107,0,NULL,253),(2,108,0,NULL,254),(2,109,0,NULL,255),(2,110,0,NULL,256),(2,111,0,NULL,257),(2,112,0,NULL,258),(2,113,0,NULL,259),(2,114,0,NULL,260),(2,115,0,NULL,261),(2,116,0,NULL,262),(2,117,0,NULL,263),(2,118,0,NULL,264),(2,119,0,NULL,265),(2,120,0,NULL,266),(2,121,0,NULL,267),(2,122,0,NULL,268),(2,123,0,NULL,269),(2,124,0,NULL,270),(2,125,0,NULL,271),(2,126,0,NULL,272),(2,127,0,NULL,273),(2,128,0,NULL,274),(2,129,0,NULL,275),(2,130,0,NULL,276),(2,131,0,NULL,277),(2,132,0,NULL,278),(2,133,0,NULL,279),(2,134,0,NULL,280),(2,135,0,NULL,281),(2,136,0,NULL,282),(2,137,0,NULL,283),(2,138,0,NULL,284),(2,143,0,NULL,285),(2,144,0,NULL,286),(2,145,0,NULL,287),(2,146,0,NULL,288),(2,148,0,NULL,289),(2,149,0,NULL,290),(2,150,0,NULL,291),(2,151,0,NULL,292),(2,152,0,NULL,293),(2,153,0,NULL,294),(2,154,0,NULL,295),(2,155,0,NULL,296),(2,156,0,NULL,297),(2,157,0,NULL,298),(2,158,0,NULL,299),(2,159,0,NULL,300),(2,160,0,NULL,301),(2,161,0,NULL,302),(2,163,0,NULL,303),(2,164,0,NULL,304),(2,165,0,NULL,305),(2,171,0,NULL,306),(2,172,0,NULL,307),(2,173,0,NULL,308),(2,174,0,NULL,309),(2,175,0,NULL,310),(2,177,0,NULL,311),(3,1,0,NULL,312),(3,2,0,NULL,313),(3,3,0,NULL,314),(3,4,0,NULL,315),(3,5,0,NULL,316),(3,6,0,NULL,317),(3,7,0,NULL,318),(3,8,0,NULL,319),(3,9,0,NULL,320),(3,11,0,NULL,321),(3,12,0,NULL,322),(3,13,0,NULL,323),(3,14,0,NULL,324),(3,16,0,NULL,325),(3,17,0,NULL,326),(3,18,0,NULL,327),(3,19,0,NULL,328),(3,20,0,NULL,329),(3,21,0,NULL,330),(3,22,0,NULL,331),(3,23,0,NULL,332),(3,24,0,NULL,333),(3,25,0,NULL,334),(3,26,0,NULL,335),(3,27,0,NULL,336),(3,28,0,NULL,337),(3,29,0,NULL,338),(3,30,0,NULL,339),(3,31,0,NULL,340),(3,32,0,NULL,341),(3,33,0,NULL,342),(3,34,0,NULL,343),(3,35,0,NULL,344),(3,36,0,NULL,345),(3,37,0,NULL,346),(3,38,0,NULL,347),(3,39,0,NULL,348),(3,40,0,NULL,349),(3,41,0,NULL,350),(3,42,0,NULL,351),(3,43,0,NULL,352),(3,44,0,NULL,353),(3,45,0,NULL,354),(3,46,0,NULL,355),(3,47,0,NULL,356),(3,76,0,NULL,357),(3,77,0,NULL,358),(3,78,0,NULL,359),(3,79,0,NULL,360),(3,80,0,NULL,361),(3,81,0,NULL,362),(3,82,0,NULL,363),(3,83,0,NULL,364),(3,84,0,NULL,365),(3,85,0,NULL,366),(3,86,0,NULL,367),(3,87,0,NULL,368),(3,88,0,NULL,369),(3,90,0,NULL,370),(3,91,0,NULL,371),(3,92,0,NULL,372),(3,93,0,NULL,373),(3,94,0,NULL,374),(3,95,0,NULL,375),(3,96,0,NULL,376),(3,97,0,NULL,377),(3,98,0,NULL,378),(3,99,0,NULL,379),(3,100,0,NULL,380),(3,101,0,NULL,381),(3,102,0,NULL,382),(3,103,0,NULL,383),(3,104,0,NULL,384),(3,105,0,NULL,385),(3,106,0,NULL,386),(3,107,0,NULL,387),(3,108,0,NULL,388),(3,109,0,NULL,389),(3,110,0,NULL,390),(3,111,0,NULL,391),(3,112,0,NULL,392),(3,113,0,NULL,393),(3,114,0,NULL,394),(3,115,0,NULL,395),(3,116,0,NULL,396),(3,117,0,NULL,397),(3,118,0,NULL,398),(3,119,0,NULL,399),(3,120,0,NULL,400),(3,121,0,NULL,401),(3,122,0,NULL,402),(3,123,0,NULL,403),(3,124,0,NULL,404),(3,125,0,NULL,405),(3,126,0,NULL,406),(3,127,0,NULL,407),(3,128,0,NULL,408),(3,129,0,NULL,409),(3,130,0,NULL,410),(3,131,0,NULL,411),(3,132,0,NULL,412),(3,133,0,NULL,413),(3,134,0,NULL,414),(3,135,0,NULL,415),(3,136,0,NULL,416),(3,137,0,NULL,417),(3,138,0,NULL,418),(3,143,0,NULL,419),(3,144,0,NULL,420),(3,145,0,NULL,421),(3,146,0,NULL,422),(3,148,0,NULL,423),(3,149,0,NULL,424),(3,150,0,NULL,425),(3,151,0,NULL,426),(3,152,0,NULL,427),(3,153,0,NULL,428),(3,154,0,NULL,429),(3,155,0,NULL,430),(3,156,0,NULL,431),(3,157,0,NULL,432),(3,158,0,NULL,433),(3,159,0,NULL,434),(3,160,0,NULL,435),(3,161,0,NULL,436),(3,163,0,NULL,437),(3,164,0,NULL,438),(3,165,0,NULL,439),(3,171,0,NULL,440),(3,172,0,NULL,441),(3,173,0,NULL,442),(3,174,0,NULL,443),(3,175,0,NULL,444),(3,177,0,NULL,445),(5,1,0,NULL,446),(5,9,0,NULL,447),(5,23,0,NULL,448),(5,30,0,NULL,449),(5,38,0,NULL,450),(6,3,0,NULL,451),(6,125,0,NULL,452),(6,126,0,NULL,453),(6,127,0,NULL,454),(6,128,0,NULL,455),(6,129,0,NULL,456),(6,130,0,NULL,457),(6,131,0,NULL,458),(6,132,0,NULL,459),(6,133,0,NULL,460),(6,134,0,NULL,461),(6,135,0,NULL,462),(6,136,0,NULL,463),(6,137,0,NULL,464),(6,138,0,NULL,465),(7,3,0,NULL,466),(7,27,0,NULL,467),(7,88,0,NULL,468),(9,1,0,NULL,469),(9,3,0,NULL,470),(9,9,0,NULL,471),(9,11,0,NULL,472),(9,23,0,NULL,473),(9,38,0,NULL,474),(9,90,0,NULL,475),(9,106,0,NULL,476),(9,107,0,NULL,477),(9,108,0,NULL,478),(9,109,0,NULL,479),(9,110,0,NULL,480),(9,111,0,NULL,481),(9,112,0,NULL,482),(9,113,0,NULL,483),(9,114,0,NULL,484),(9,115,0,NULL,485),(9,116,0,NULL,486),(9,117,0,NULL,487),(9,118,0,NULL,488),(9,119,0,NULL,489),(9,120,0,NULL,490),(9,121,0,NULL,491),(9,122,0,NULL,492),(9,123,0,NULL,493),(9,124,0,NULL,494),(9,156,0,NULL,495),(12,1,0,NULL,496),(12,2,0,NULL,497),(12,3,0,NULL,498),(12,4,0,NULL,499),(12,5,0,NULL,500),(12,6,0,NULL,501),(12,7,0,NULL,502),(12,8,0,NULL,503),(12,9,0,NULL,504),(12,12,0,NULL,505),(12,13,0,NULL,506),(12,14,0,NULL,507),(12,16,0,NULL,508),(12,41,0,NULL,509),(12,42,0,NULL,510),(12,43,0,NULL,511),(12,44,0,NULL,512),(12,45,0,NULL,513),(12,46,0,NULL,514),(12,47,0,NULL,515),(12,84,0,NULL,516),(12,85,0,NULL,517),(12,86,0,NULL,518),(12,87,0,NULL,519),(12,88,0,NULL,520),(12,89,0,NULL,521),(12,90,0,NULL,522),(12,91,0,NULL,523),(12,92,0,NULL,524),(12,93,0,NULL,525),(12,94,0,NULL,526),(12,95,0,NULL,527),(12,96,0,NULL,528),(12,97,0,NULL,529),(12,98,0,NULL,530),(12,99,0,NULL,531),(12,100,0,NULL,532),(12,101,0,NULL,533),(12,102,0,NULL,534),(12,103,0,NULL,535),(12,104,0,NULL,536),(12,105,0,NULL,537),(12,139,0,NULL,538),(12,140,0,NULL,539),(12,141,0,NULL,540),(12,142,0,NULL,541),(13,76,0,NULL,542),(13,77,0,NULL,543),(13,78,0,NULL,544),(13,79,0,NULL,545),(13,80,0,NULL,546),(13,81,0,NULL,547),(13,82,0,NULL,548),(13,83,0,NULL,549),(15,1,0,NULL,550),(15,11,0,NULL,551),(15,23,0,NULL,552),(15,24,0,NULL,553),(15,25,0,NULL,554),(15,26,0,NULL,555),(15,27,0,NULL,556),(15,28,0,NULL,557),(15,29,0,NULL,558),(15,30,0,NULL,559),(15,31,0,NULL,560),(15,32,0,NULL,561),(15,33,0,NULL,562),(15,34,0,NULL,563),(15,35,0,NULL,564),(15,36,0,NULL,565),(15,37,0,NULL,566),(15,38,0,NULL,567),(15,39,0,NULL,568),(15,40,0,NULL,569),(15,41,0,NULL,570),(15,42,0,NULL,571),(15,43,0,NULL,572),(15,44,0,NULL,573),(15,45,0,NULL,574),(15,46,0,NULL,575),(15,47,0,NULL,576),(15,53,0,NULL,577),(15,54,0,NULL,578),(15,55,0,NULL,579),(15,56,0,NULL,580),(15,57,0,NULL,581),(15,58,0,NULL,582),(15,59,0,NULL,583),(15,60,0,NULL,584),(15,61,0,NULL,585),(15,62,0,NULL,586),(15,63,0,NULL,587),(15,64,0,NULL,588),(15,65,0,NULL,589),(15,66,0,NULL,590),(15,67,0,NULL,591),(15,68,0,NULL,592),(15,69,0,NULL,593),(15,70,0,NULL,594),(15,71,0,NULL,595),(15,72,0,NULL,596),(15,73,0,NULL,597),(15,74,0,NULL,598),(15,75,0,NULL,599),(15,76,0,NULL,600),(15,77,0,NULL,601),(15,78,0,NULL,602),(15,79,0,NULL,603),(15,80,0,NULL,604),(15,81,0,NULL,605),(15,82,0,NULL,606),(15,83,0,NULL,607),(15,84,0,NULL,608),(15,85,0,NULL,609),(15,86,0,NULL,610),(15,87,0,NULL,611),(15,88,0,NULL,612),(15,89,0,NULL,613),(15,91,0,NULL,614),(15,92,0,NULL,615),(15,93,0,NULL,616),(15,94,0,NULL,617),(15,95,0,NULL,618),(15,96,0,NULL,619),(15,97,0,NULL,620),(15,98,0,NULL,621),(15,99,0,NULL,622),(15,100,0,NULL,623),(15,101,0,NULL,624),(15,102,0,NULL,625),(15,103,0,NULL,626),(15,104,0,NULL,627),(15,105,0,NULL,628),(15,106,0,NULL,629),(15,107,0,NULL,630),(15,108,0,NULL,631),(15,109,0,NULL,632),(15,110,0,NULL,633),(15,111,0,NULL,634),(15,112,0,NULL,635),(15,113,0,NULL,636),(15,114,0,NULL,637),(15,115,0,NULL,638),(15,116,0,NULL,639),(15,117,0,NULL,640),(15,118,0,NULL,641),(15,119,0,NULL,642),(15,120,0,NULL,643),(15,121,0,NULL,644),(15,122,0,NULL,645),(15,123,0,NULL,646),(15,124,0,NULL,647),(15,125,0,NULL,648),(15,126,0,NULL,649),(15,127,0,NULL,650),(15,128,0,NULL,651),(15,129,0,NULL,652),(15,130,0,NULL,653),(15,131,0,NULL,654),(15,132,0,NULL,655),(15,133,0,NULL,656),(15,134,0,NULL,657),(15,135,0,NULL,658),(15,136,0,NULL,659),(15,137,0,NULL,660),(15,138,0,NULL,661),(15,155,0,NULL,662),(15,158,0,NULL,663),(15,160,0,NULL,664),(15,161,0,NULL,665),(15,163,0,NULL,666),(15,164,0,NULL,667),(15,165,0,NULL,668),(16,17,0,NULL,669),(16,18,0,NULL,670),(16,19,0,NULL,671),(16,20,0,NULL,672),(16,21,0,NULL,673),(16,22,0,NULL,674),(16,53,0,NULL,675),(16,54,0,NULL,676),(16,55,0,NULL,677),(16,56,0,NULL,678),(16,57,0,NULL,679),(16,58,0,NULL,680),(16,59,0,NULL,681),(16,60,0,NULL,682),(16,61,0,NULL,683),(16,62,0,NULL,684),(16,63,0,NULL,685),(16,64,0,NULL,686),(16,65,0,NULL,687),(16,66,0,NULL,688),(16,67,0,NULL,689),(16,68,0,NULL,690),(16,69,0,NULL,691),(16,70,0,NULL,692),(16,71,0,NULL,693),(16,72,0,NULL,694),(16,73,0,NULL,695),(16,74,0,NULL,696),(16,75,0,NULL,697),(16,125,0,NULL,698),(16,126,0,NULL,699),(16,128,0,NULL,700),(16,129,0,NULL,701),(16,130,0,NULL,702),(16,131,0,NULL,703),(16,132,0,NULL,704),(16,133,0,NULL,705),(16,134,0,NULL,706),(16,135,0,NULL,707),(16,136,0,NULL,708),(16,137,0,NULL,709),(16,138,0,NULL,710),(16,140,0,NULL,711),(16,143,0,NULL,712),(16,144,0,NULL,713),(16,145,0,NULL,714),(16,146,0,NULL,715),(16,147,0,NULL,716),(16,148,0,NULL,717),(16,149,0,NULL,718),(16,150,0,NULL,719),(16,151,0,NULL,720),(16,152,0,NULL,721),(16,153,0,NULL,722),(16,154,0,NULL,723),(17,1,0,NULL,724),(17,15,0,NULL,725),(17,17,0,NULL,726),(17,18,0,NULL,727),(17,19,0,NULL,728),(17,20,0,NULL,729),(17,21,0,NULL,730),(17,22,0,NULL,731),(17,38,0,NULL,732),(17,139,0,NULL,733),(17,140,0,NULL,734),(17,141,0,NULL,735),(17,142,0,NULL,736),(18,1,0,NULL,737),(18,38,0,NULL,738),(18,89,0,NULL,739),(18,127,0,NULL,740),(18,155,0,NULL,741),(18,156,0,NULL,742),(18,157,0,NULL,743),(18,158,0,NULL,744),(18,159,0,NULL,745),(18,160,0,NULL,746),(18,161,0,NULL,747),(18,163,0,NULL,748),(18,164,0,NULL,749),(18,165,0,NULL,750),(19,109,0,NULL,751),(20,1,0,NULL,752),(20,2,0,NULL,753),(20,3,0,NULL,754),(20,4,0,NULL,755),(20,5,0,NULL,756),(20,6,0,NULL,757),(20,7,0,NULL,758),(20,8,0,NULL,759),(20,9,0,NULL,760),(20,10,0,NULL,761),(20,11,0,NULL,762),(20,12,0,NULL,763),(20,13,0,NULL,764),(20,14,0,NULL,765),(20,16,0,NULL,766),(20,160,0,NULL,767),(23,1,0,NULL,768),(23,2,0,NULL,769),(23,3,0,NULL,770),(23,4,0,NULL,771),(23,5,0,NULL,772),(23,6,0,NULL,773),(23,7,0,NULL,774),(23,8,0,NULL,775),(23,9,0,NULL,776),(23,10,0,NULL,777),(23,11,0,NULL,778),(23,12,0,NULL,779),(23,13,0,NULL,780),(23,14,0,NULL,781),(23,15,0,NULL,782),(23,16,0,NULL,783),(23,17,0,NULL,784),(23,18,0,NULL,785),(23,19,0,NULL,786),(23,20,0,NULL,787),(23,21,0,NULL,788),(23,22,0,NULL,789),(23,23,0,NULL,790),(23,24,0,NULL,791),(23,25,0,NULL,792),(23,26,0,NULL,793),(23,27,0,NULL,794),(23,28,0,NULL,795),(23,29,0,NULL,796),(23,30,0,NULL,797),(23,31,0,NULL,798),(23,32,0,NULL,799),(23,33,0,NULL,800),(23,34,0,NULL,801),(23,35,0,NULL,802),(23,36,0,NULL,803),(23,37,0,NULL,804),(23,38,0,NULL,805),(23,39,0,NULL,806),(23,40,0,NULL,807),(23,41,0,NULL,808),(23,42,0,NULL,809),(23,43,0,NULL,810),(23,44,0,NULL,811),(23,45,0,NULL,812),(23,46,0,NULL,813),(23,47,0,NULL,814),(23,48,0,NULL,815),(23,49,0,NULL,816),(23,50,0,NULL,817),(23,51,0,NULL,818),(23,52,0,NULL,819),(23,53,0,NULL,820),(23,54,0,NULL,821),(23,55,0,NULL,822),(23,56,0,NULL,823),(23,57,0,NULL,824),(23,58,0,NULL,825),(23,59,0,NULL,826),(23,60,0,NULL,827),(23,61,0,NULL,828),(23,62,0,NULL,829),(23,63,0,NULL,830),(23,64,0,NULL,831),(23,65,0,NULL,832),(23,66,0,NULL,833),(23,67,0,NULL,834),(23,68,0,NULL,835),(23,69,0,NULL,836),(23,70,0,NULL,837),(23,71,0,NULL,838),(23,72,0,NULL,839),(23,73,0,NULL,840),(23,74,0,NULL,841),(23,75,0,NULL,842),(23,76,0,NULL,843),(23,77,0,NULL,844),(23,78,0,NULL,845),(23,79,0,NULL,846),(23,80,0,NULL,847),(23,81,0,NULL,848),(23,82,0,NULL,849),(23,83,0,NULL,850),(23,84,0,NULL,851),(23,85,0,NULL,852),(23,86,0,NULL,853),(23,87,0,NULL,854),(23,88,0,NULL,855),(23,89,0,NULL,856),(23,90,0,NULL,857),(23,91,0,NULL,858),(23,92,0,NULL,859),(23,93,0,NULL,860),(23,94,0,NULL,861),(23,95,0,NULL,862),(23,96,0,NULL,863),(23,97,0,NULL,864),(23,98,0,NULL,865),(23,99,0,NULL,866),(23,100,0,NULL,867),(23,101,0,NULL,868),(23,102,0,NULL,869),(23,103,0,NULL,870),(23,104,0,NULL,871),(23,105,0,NULL,872),(23,106,0,NULL,873),(23,107,0,NULL,874),(23,108,0,NULL,875),(23,109,0,NULL,876),(23,110,0,NULL,877),(23,111,0,NULL,878),(23,112,0,NULL,879),(23,113,0,NULL,880),(23,114,0,NULL,881),(23,115,0,NULL,882),(23,116,0,NULL,883),(23,117,0,NULL,884),(23,118,0,NULL,885),(23,119,0,NULL,886),(23,120,0,NULL,887),(23,121,0,NULL,888),(23,122,0,NULL,889),(23,123,0,NULL,890),(23,124,0,NULL,891),(23,125,0,NULL,892),(23,126,0,NULL,893),(23,127,0,NULL,894),(23,128,0,NULL,895),(23,129,0,NULL,896),(23,130,0,NULL,897),(23,131,0,NULL,898),(23,132,0,NULL,899),(23,133,0,NULL,900),(23,134,0,NULL,901),(23,135,0,NULL,902),(23,136,0,NULL,903),(23,137,0,NULL,904),(23,138,0,NULL,905),(23,139,0,NULL,906),(23,140,0,NULL,907),(23,141,0,NULL,908),(23,142,0,NULL,909),(23,143,0,NULL,910),(23,144,0,NULL,911),(23,145,0,NULL,912),(23,146,0,NULL,913),(23,147,0,NULL,914),(23,148,0,NULL,915),(23,149,0,NULL,916),(23,150,0,NULL,917),(23,151,0,NULL,918),(23,152,0,NULL,919),(23,153,0,NULL,920),(23,154,0,NULL,921),(23,155,0,NULL,922),(23,156,0,NULL,923),(23,157,0,NULL,924),(23,158,0,NULL,925),(23,159,0,NULL,926),(23,160,0,NULL,927),(23,161,0,NULL,928),(23,163,0,NULL,929),(23,164,0,NULL,930),(23,165,0,NULL,931),(23,166,0,NULL,932),(23,167,0,NULL,933),(23,168,0,NULL,934),(23,169,0,NULL,935),(23,170,0,NULL,936),(23,171,0,NULL,937),(23,172,0,NULL,938),(23,173,0,NULL,939),(23,174,0,NULL,940),(23,175,0,NULL,941),(23,176,0,NULL,942),(23,177,0,NULL,943),(24,127,0,NULL,944),(25,10,0,NULL,945),(25,89,0,NULL,946),(25,141,0,NULL,947),(25,142,0,NULL,948),(25,147,0,NULL,949),(25,169,0,NULL,950),(25,172,0,NULL,951),(26,10,0,NULL,952),(26,89,0,NULL,953),(26,141,0,NULL,954),(26,142,0,NULL,955),(26,147,0,NULL,956),(26,169,0,NULL,957),(26,172,0,NULL,958),(27,2,0,NULL,959),(27,4,0,NULL,960),(27,5,0,NULL,961),(27,6,0,NULL,962),(27,7,0,NULL,963),(27,8,0,NULL,964),(27,9,0,NULL,965),(27,11,0,NULL,966),(27,12,0,NULL,967),(27,13,0,NULL,968),(27,14,0,NULL,969),(27,16,0,NULL,970),(27,160,0,NULL,971),(28,2,0,NULL,972),(28,4,0,NULL,973),(28,5,0,NULL,974),(28,6,0,NULL,975),(28,7,0,NULL,976),(28,8,0,NULL,977),(28,9,0,NULL,978),(28,11,0,NULL,979),(28,12,0,NULL,980),(28,13,0,NULL,981),(28,14,0,NULL,982),(28,16,0,NULL,983),(28,17,0,NULL,984),(28,18,0,NULL,985),(28,19,0,NULL,986),(28,20,0,NULL,987),(28,21,0,NULL,988),(28,22,0,NULL,989),(28,41,0,NULL,990),(28,42,0,NULL,991),(28,43,0,NULL,992),(28,44,0,NULL,993),(28,45,0,NULL,994),(28,46,0,NULL,995),(28,47,0,NULL,996),(28,48,0,NULL,997),(28,49,0,NULL,998),(28,50,0,NULL,999),(28,51,0,NULL,1000),(28,52,0,NULL,1001),(28,84,0,NULL,1002),(28,85,0,NULL,1003),(28,86,0,NULL,1004),(28,87,0,NULL,1005),(28,91,0,NULL,1006),(28,92,0,NULL,1007),(28,93,0,NULL,1008),(28,94,0,NULL,1009),(28,95,0,NULL,1010),(28,97,0,NULL,1011),(28,98,0,NULL,1012),(28,99,0,NULL,1013),(28,100,0,NULL,1014),(28,101,0,NULL,1015),(28,102,0,NULL,1016),(28,103,0,NULL,1017),(28,104,0,NULL,1018),(28,105,0,NULL,1019),(28,160,0,NULL,1020),(29,128,0,NULL,1021),(31,1,0,NULL,1022),(31,2,0,NULL,1023),(31,3,0,NULL,1024),(31,4,0,NULL,1025),(31,5,0,NULL,1026),(31,6,0,NULL,1027),(31,7,0,NULL,1028),(31,8,0,NULL,1029),(31,9,0,NULL,1030),(31,10,0,NULL,1031),(31,11,0,NULL,1032),(31,12,0,NULL,1033),(31,13,0,NULL,1034),(31,14,0,NULL,1035),(31,15,0,NULL,1036),(31,16,0,NULL,1037),(31,17,0,NULL,1038),(31,18,0,NULL,1039),(31,19,0,NULL,1040),(31,20,0,NULL,1041),(31,21,0,NULL,1042),(31,22,0,NULL,1043),(31,23,0,NULL,1044),(31,24,0,NULL,1045),(31,25,0,NULL,1046),(31,26,0,NULL,1047),(31,27,0,NULL,1048),(31,28,0,NULL,1049),(31,29,0,NULL,1050),(31,30,0,NULL,1051),(31,31,0,NULL,1052),(31,32,0,NULL,1053),(31,33,0,NULL,1054),(31,34,0,NULL,1055),(31,35,0,NULL,1056),(31,36,0,NULL,1057),(31,37,0,NULL,1058),(31,38,0,NULL,1059),(31,39,0,NULL,1060),(31,40,0,NULL,1061),(31,41,0,NULL,1062),(31,42,0,NULL,1063),(31,43,0,NULL,1064),(31,44,0,NULL,1065),(31,45,0,NULL,1066),(31,46,0,NULL,1067),(31,47,0,NULL,1068),(31,48,0,NULL,1069),(31,49,0,NULL,1070),(31,50,0,NULL,1071),(31,51,0,NULL,1072),(31,52,0,NULL,1073),(31,53,0,NULL,1074),(31,54,0,NULL,1075),(31,55,0,NULL,1076),(31,56,0,NULL,1077),(31,57,0,NULL,1078),(31,58,0,NULL,1079),(31,59,0,NULL,1080),(31,60,0,NULL,1081),(31,61,0,NULL,1082),(31,62,0,NULL,1083),(31,63,0,NULL,1084),(31,64,0,NULL,1085),(31,65,0,NULL,1086),(31,66,0,NULL,1087),(31,67,0,NULL,1088),(31,68,0,NULL,1089),(31,69,0,NULL,1090),(31,70,0,NULL,1091),(31,71,0,NULL,1092),(31,72,0,NULL,1093),(31,73,0,NULL,1094),(31,74,0,NULL,1095),(31,75,0,NULL,1096),(31,76,0,NULL,1097),(31,77,0,NULL,1098),(31,78,0,NULL,1099),(31,79,0,NULL,1100),(31,80,0,NULL,1101),(31,81,0,NULL,1102),(31,82,0,NULL,1103),(31,83,0,NULL,1104),(31,84,0,NULL,1105),(31,85,0,NULL,1106),(31,86,0,NULL,1107),(31,87,0,NULL,1108),(31,88,0,NULL,1109),(31,90,0,NULL,1110),(31,91,0,NULL,1111),(31,92,0,NULL,1112),(31,93,0,NULL,1113),(31,94,0,NULL,1114),(31,95,0,NULL,1115),(31,96,0,NULL,1116),(31,97,0,NULL,1117),(31,98,0,NULL,1118),(31,99,0,NULL,1119),(31,100,0,NULL,1120),(31,101,0,NULL,1121),(31,102,0,NULL,1122),(31,103,0,NULL,1123),(31,104,0,NULL,1124),(31,105,0,NULL,1125),(31,106,0,NULL,1126),(31,107,0,NULL,1127),(31,108,0,NULL,1128),(31,109,0,NULL,1129),(31,110,0,NULL,1130),(31,111,0,NULL,1131),(31,112,0,NULL,1132),(31,113,0,NULL,1133),(31,114,0,NULL,1134),(31,115,0,NULL,1135),(31,116,0,NULL,1136),(31,117,0,NULL,1137),(31,118,0,NULL,1138),(31,119,0,NULL,1139),(31,120,0,NULL,1140),(31,121,0,NULL,1141),(31,122,0,NULL,1142),(31,123,0,NULL,1143),(31,124,0,NULL,1144),(31,125,0,NULL,1145),(31,126,0,NULL,1146),(31,127,0,NULL,1147),(31,128,0,NULL,1148),(31,129,0,NULL,1149),(31,130,0,NULL,1150),(31,131,0,NULL,1151),(31,132,0,NULL,1152),(31,133,0,NULL,1153),(31,134,0,NULL,1154),(31,135,0,NULL,1155),(31,136,0,NULL,1156),(31,137,0,NULL,1157),(31,138,0,NULL,1158),(31,143,0,NULL,1159),(31,144,0,NULL,1160),(31,145,0,NULL,1161),(31,146,0,NULL,1162),(31,147,0,NULL,1163),(31,148,0,NULL,1164),(31,149,0,NULL,1165),(31,150,0,NULL,1166),(31,151,0,NULL,1167),(31,152,0,NULL,1168),(31,153,0,NULL,1169),(31,154,0,NULL,1170),(31,155,0,NULL,1171),(31,156,0,NULL,1172),(31,157,0,NULL,1173),(31,158,0,NULL,1174),(31,159,0,NULL,1175),(31,160,0,NULL,1176),(31,161,0,NULL,1177),(31,163,0,NULL,1178),(31,164,0,NULL,1179),(31,165,0,NULL,1180),(31,171,0,NULL,1181),(31,173,0,NULL,1182),(31,174,0,NULL,1183),(31,175,0,NULL,1184),(31,177,0,NULL,1185),(32,1,0,NULL,1186),(32,2,0,NULL,1187),(32,4,0,NULL,1188),(32,5,0,NULL,1189),(32,6,0,NULL,1190),(32,7,0,NULL,1191),(32,8,0,NULL,1192),(32,9,0,NULL,1193),(32,11,0,NULL,1194),(32,12,0,NULL,1195),(32,13,0,NULL,1196),(32,14,0,NULL,1197),(32,16,0,NULL,1198),(32,41,0,NULL,1199),(32,42,0,NULL,1200),(32,43,0,NULL,1201),(32,44,0,NULL,1202),(32,45,0,NULL,1203),(32,46,0,NULL,1204),(32,47,0,NULL,1205),(32,48,0,NULL,1206),(32,49,0,NULL,1207),(32,50,0,NULL,1208),(32,51,0,NULL,1209),(32,52,0,NULL,1210),(32,53,0,NULL,1211),(32,54,0,NULL,1212),(32,55,0,NULL,1213),(32,56,0,NULL,1214),(32,57,0,NULL,1215),(32,58,0,NULL,1216),(32,59,0,NULL,1217),(32,60,0,NULL,1218),(32,61,0,NULL,1219),(32,62,0,NULL,1220),(32,63,0,NULL,1221),(32,64,0,NULL,1222),(32,65,0,NULL,1223),(32,66,0,NULL,1224),(32,67,0,NULL,1225),(32,68,0,NULL,1226),(32,69,0,NULL,1227),(32,70,0,NULL,1228),(32,71,0,NULL,1229),(32,72,0,NULL,1230),(32,73,0,NULL,1231),(32,74,0,NULL,1232),(32,75,0,NULL,1233),(32,84,0,NULL,1234),(32,85,0,NULL,1235),(32,86,0,NULL,1236),(32,87,0,NULL,1237),(32,88,0,NULL,1238),(32,90,0,NULL,1239),(32,91,0,NULL,1240),(32,92,0,NULL,1241),(32,93,0,NULL,1242),(32,94,0,NULL,1243),(32,95,0,NULL,1244),(32,96,0,NULL,1245),(32,97,0,NULL,1246),(32,98,0,NULL,1247),(32,99,0,NULL,1248),(32,100,0,NULL,1249),(32,101,0,NULL,1250),(32,102,0,NULL,1251),(32,103,0,NULL,1252),(32,104,0,NULL,1253),(32,105,0,NULL,1254),(32,106,0,NULL,1255),(32,107,0,NULL,1256),(32,108,0,NULL,1257),(32,109,0,NULL,1258),(32,110,0,NULL,1259),(32,111,0,NULL,1260),(32,112,0,NULL,1261),(32,113,0,NULL,1262),(32,114,0,NULL,1263),(32,115,0,NULL,1264),(32,116,0,NULL,1265),(32,117,0,NULL,1266),(32,118,0,NULL,1267),(32,119,0,NULL,1268),(32,120,0,NULL,1269),(32,121,0,NULL,1270),(32,122,0,NULL,1271),(32,123,0,NULL,1272),(32,124,0,NULL,1273),(32,125,0,NULL,1274),(32,126,0,NULL,1275),(32,127,0,NULL,1276),(32,128,0,NULL,1277),(32,129,0,NULL,1278),(32,130,0,NULL,1279),(32,131,0,NULL,1280),(32,132,0,NULL,1281),(32,133,0,NULL,1282),(32,134,0,NULL,1283),(32,135,0,NULL,1284),(32,136,0,NULL,1285),(32,137,0,NULL,1286),(32,138,0,NULL,1287),(32,143,0,NULL,1288),(32,144,0,NULL,1289),(32,145,0,NULL,1290),(32,146,0,NULL,1291),(32,148,0,NULL,1292),(32,149,0,NULL,1293),(32,150,0,NULL,1294),(32,151,0,NULL,1295),(32,152,0,NULL,1296),(32,153,0,NULL,1297),(32,154,0,NULL,1298),(32,155,0,NULL,1299),(32,156,0,NULL,1300),(32,157,0,NULL,1301),(32,158,0,NULL,1302),(32,159,0,NULL,1303),(32,160,0,NULL,1304),(32,161,0,NULL,1305),(32,163,0,NULL,1306),(32,164,0,NULL,1307),(32,165,0,NULL,1308),(32,170,0,NULL,1309),(32,172,0,NULL,1310),(32,173,0,NULL,1311),(32,174,0,NULL,1312),(32,177,0,NULL,1313),(33,88,0,NULL,1314),(34,17,0,NULL,1315),(34,18,0,NULL,1316),(34,19,0,NULL,1317),(34,20,0,NULL,1318),(34,21,0,NULL,1319),(34,22,0,NULL,1320),(35,1,0,NULL,1321),(35,2,0,NULL,1322),(35,3,0,NULL,1323),(35,4,0,NULL,1324),(35,5,0,NULL,1325),(35,6,0,NULL,1326),(35,7,0,NULL,1327),(35,8,0,NULL,1328),(35,11,0,NULL,1329),(35,12,0,NULL,1330),(35,13,0,NULL,1331),(35,14,0,NULL,1332),(35,15,0,NULL,1333),(35,16,0,NULL,1334),(35,17,0,NULL,1335),(35,18,0,NULL,1336),(35,19,0,NULL,1337),(35,20,0,NULL,1338),(35,21,0,NULL,1339),(35,22,0,NULL,1340),(35,27,0,NULL,1341),(35,38,0,NULL,1342),(35,76,0,NULL,1343),(35,77,0,NULL,1344),(35,78,0,NULL,1345),(35,79,0,NULL,1346),(35,80,0,NULL,1347),(35,81,0,NULL,1348),(35,82,0,NULL,1349),(35,83,0,NULL,1350),(35,88,0,NULL,1351),(35,125,0,NULL,1352),(35,126,0,NULL,1353),(35,127,0,NULL,1354),(35,128,0,NULL,1355),(35,129,0,NULL,1356),(35,130,0,NULL,1357),(35,131,0,NULL,1358),(35,132,0,NULL,1359),(35,133,0,NULL,1360),(35,134,0,NULL,1361),(35,135,0,NULL,1362),(35,136,0,NULL,1363),(35,137,0,NULL,1364),(35,138,0,NULL,1365),(35,155,0,NULL,1366),(35,157,0,NULL,1367),(35,158,0,NULL,1368),(35,160,0,NULL,1369),(35,161,0,NULL,1370),(35,163,0,NULL,1371),(35,164,0,NULL,1372),(35,165,0,NULL,1373),(71,3,1,NULL,1374),(72,195,1,NULL,1375),(73,195,1,NULL,1376),(73,196,1,NULL,1377),(74,78,1,NULL,1378),(75,196,1,NULL,1379),(76,196,1,NULL,1380),(77,196,1,NULL,1381),(77,198,1,NULL,1382),(78,11,1,NULL,1383),(78,194,1,NULL,1384),(79,11,1,NULL,1385),(79,194,1,NULL,1386),(80,197,1,NULL,1387),(81,82,1,NULL,1388),(82,195,1,NULL,1389),(82,197,1,NULL,1390),(83,77,1,NULL,1391),(83,83,1,NULL,1392),(84,194,1,NULL,1393);
/*!40000 ALTER TABLE `Reuse_Locations_Items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Reuse_User_Credentials`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Reuse_User_Credentials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `pw_hash` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Reuse_User_Credentials`
--

LOCK TABLES `Reuse_User_Credentials` WRITE;
/*!40000 ALTER TABLE `Reuse_User_Credentials` DISABLE KEYS */;
INSERT INTO `Reuse_User_Credentials` VALUES (3,'REUSE','rlCsLWNqj7XcA');
/*!40000 ALTER TABLE `Reuse_User_Credentials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `States`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `States` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `abbreviation` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `abbreviation` (`abbreviation`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `States`
--

LOCK TABLES `States` WRITE;
/*!40000 ALTER TABLE `States` DISABLE KEYS */;
INSERT INTO `States` VALUES (1,'Alabama','AL'),(2,'Alaska','AK'),(3,'Arizona','AZ'),(4,'Arkansas','AR'),(5,'California','CA'),(6,'Colorado','CO'),(7,'Connecticut','CT'),(8,'Delaware','DE'),(9,'Florida','FL'),(10,'Georgia','GA'),(11,'Hawaii','HI'),(12,'Idaho','ID'),(13,'Illinois','IL'),(14,'Indiana','IN'),(15,'Iowa','IA'),(16,'Kansas','KS'),(17,'Kentucky','KY'),(18,'Louisiana','LA'),(19,'Maine','ME'),(20,'Maryland','MD'),(21,'Massachusetts','MA'),(22,'Michigan','MI'),(23,'Minnesota','MN'),(24,'Mississippi','MS'),(25,'Missouri','MO'),(26,'Montana','MT'),(27,'Nebraska','NE'),(28,'Nevada','NV'),(29,'New Hampshire','NH'),(30,'New Jersey','NJ'),(31,'New Mexico','NM'),(32,'New York','NY'),(33,'North Carolina','NC'),(34,'North Dakota','ND'),(35,'Ohio','OH'),(36,'Oklahoma','OK'),(37,'Oregon','OR'),(38,'Pennsylvania','PA'),(39,'Rhode Island','RI'),(40,'South Carolina','SC'),(41,'South Dakota','SD'),(42,'Tennessee','TN'),(43,'Texas','TX'),(44,'Utah','UT'),(45,'Vermont','VT'),(46,'Virginia','VA'),(47,'Washington','WA'),(48,'West Virginia','WV'),(49,'Wisconsin','WI'),(50,'Wyoming','WY');
/*!40000 ALTER TABLE `States` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phinxlog`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phinxlog`
--

LOCK TABLES `phinxlog` WRITE;
/*!40000 ALTER TABLE `phinxlog` DISABLE KEYS */;
INSERT INTO `phinxlog` VALUES (20171113135749,'AddLocationsForeignKey','2017-11-20 21:55:30','2017-11-20 21:55:30',0),(20171113150139,'AddDocumentsForeignKey','2017-11-20 21:55:30','2017-11-20 21:55:30',0),(20171113203157,'AddItemsForeignKey','2017-11-20 21:55:30','2017-11-20 21:55:30',0),(20171113210555,'AddLocationsItemsForeignKeys','2017-11-20 21:55:30','2017-11-20 21:55:30',0);
/*!40000 ALTER TABLE `phinxlog` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-20 14:24:26
