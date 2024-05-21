-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: Projekt
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `opinia`
--

DROP TABLE IF EXISTS `opinia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opinia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_uzytkownika` int(11) NOT NULL,
  `id_produktu` int(11) NOT NULL,
  `ocena` double DEFAULT NULL,
  `tekst` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_produktopinia` (`id_produktu`),
  KEY `FK_uzytkownikopinia` (`id_uzytkownika`),
  CONSTRAINT `FK_produktopinia` FOREIGN KEY (`id_produktu`) REFERENCES `produkty` (`id`),
  CONSTRAINT `FK_uzytkownikopinia` FOREIGN KEY (`id_uzytkownika`) REFERENCES `uzytkownik` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opinia`
--

LOCK TABLES `opinia` WRITE;
/*!40000 ALTER TABLE `opinia` DISABLE KEYS */;
/*!40000 ALTER TABLE `opinia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produkty`
--

DROP TABLE IF EXISTS `produkty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produkty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tytul` varchar(255) NOT NULL,
  `zdjecie` varchar(255) NOT NULL,
  `cena_bez` double DEFAULT NULL,
  `cena_z` double DEFAULT NULL,
  `opis` varchar(255) NOT NULL,
  `ilosc` int(11) NOT NULL,
  `opisDuzy` varchar(200) DEFAULT NULL,
  `rodzaj` varchar(30) DEFAULT NULL,
  `ocena` double DEFAULT NULL,
  `ilosc_ocen` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produkty`
--

LOCK TABLES `produkty` WRITE;
/*!40000 ALTER TABLE `produkty` DISABLE KEYS */;
INSERT INTO `produkty` VALUES (8,'Cukiernica','1.jpg',100,130,' Prawdziwa Chińska cukiernica',312,'Chińska cukiernica z najwyższej jakości porcelany. Można trzymać w niej cukier.','porcelana',NULL,0),(9,'Pułapka','2.jpg',15,20,' Chińska pułapka na palce',100,'Z tej chińskiej pułapki nie wyciągniesz nigdy palców. GROZI AMPUTACJĄ!','zabawka',NULL,0),(10,'Czapka','3.jpg',80,100,' Chińska czapka prawdziwego wojownika',15,'W tej czapce będziesz wyglądać jak prawdziwy chinol.','ubranie',NULL,0),(11,'Lalka','4.png',200,215,' Lalka chińska wykonana z najlepszych materiałów',200,'Lalka podobno chodzi sama w nocy. Jest trochę straszna dlatego sprzedajemy wszystkie.','zabawka',NULL,0),(12,'Huggy Wuggy','5.jpg',70,420,' Straszna lalka Huggy Wuggy dla dziecka',30,'Huggy Wuggy z gry Poppy Playtime może być już u ciebie za jedyne 70 zł + dostawa.','zabawka',NULL,0),(13,'Pop it!','6.jpg',50,65,' Pop it jest nudne troche nwm po co to komu?',200,'Nie no serio po co to twojemu dziecku?','zabawka',NULL,0),(14,'Krowa','7.jpg',15,20,' Pluszana krowa',200,'Krowa czerwona to znaczy chińska bo oni lubią ten kolor.','zabawka',NULL,0),(15,'Kiecka biało-czewona','8.jpg',100,120,' Prawie polska kiecka dla baby',28,'Polska a jednak Chińska taka na jakiś festyn czy festiwal albo jak chcesz coś chińskiego zjeść to fajnie.','ubranie',NULL,0),(16,'Kiecka czerwona ','9.jpg',130,135,' Kiecka czerwona cała fajna chińska',30,'Jak wybierasz się do Chin to jest najlepszy wybór! Będziesz wyglądać jak Chinka.','ubranie',NULL,0),(17,'Ubranie chińskie','10.jpg',80,100,' Dla faceta z chin to fajne ',30,'Dobre ubranie jak chcesz się wtopić w tłum w Chinach. Oni tak się tam ubierają tak?','ubranie',NULL,0),(18,'Buty ninja','11.jpg',1000,1200,' Buty cichobiegi do zabijania samurajów',20,'W tych butach nikt cię nie usłyszy, a ich ciemny kolor utrudni zlokalizowanie Cię w nocy.','ubranie',3,2),(19,'Filiżanka z podstawką','12.jpg',45,55,' Filiżanka i podstawka prosto z Chin',26,'Wykonane z najwyższej jakości porcelany, by móc parzyć sobie kawę najlepszej jakości','porcelana',NULL,0),(20,'Talerz','13.jpg',20,25,' Talerz do obiadu(najlepiej chińskiego)',23,'Wykonano z porcelany najlepszej jakości, by zadowolić nawet najbardziej surowych klientów.','porcelana',5,1),(21,'Waza','14.jpg',30,38,' Służy do trzymania w niej kwiatów',213,'Można znaleźć u babci na przykład takie podobne. Kup babci jak nie ma.','porcelana',NULL,0),(22,'Sajgonki','15.jpg',15,17,' Dobre sajgonki mniam!',30,'Są bardzo dobre i świeże super smakują z sosem jakimś.','jedzenie',NULL,0),(23,'Makaron','16.jpg',15,20,' Dobry makaron chiński do warzyw na przykład',38,'Makaron pasuje do wszystkiego. Biały zawsze będzie lepszy.','jedzenie',NULL,0),(24,'Ciasteczka z wróżbą','17.jpg',5,10,' W środku znajdziesz przepowiednie',18,'Gwarantujemy, że wróżba się spełni. Uwaga, w środku możesz poznać jak umrzesz!','jedzenie',3.5,2),(25,'Pierożki wonton','18.jpg',30,80,' W środku jest mienso i wgl',50,'Pierogi dobre na obiad ale i na kolacje. Byle nie na śniadanie!','jedzenie',NULL,0);
/*!40000 ALTER TABLE `produkty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uzytkownik`
--

DROP TABLE IF EXISTS `uzytkownik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uzytkownik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `haslo` varchar(50) NOT NULL,
  `czyadmin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uzytkownik`
--

LOCK TABLES `uzytkownik` WRITE;
/*!40000 ALTER TABLE `uzytkownik` DISABLE KEYS */;
INSERT INTO `uzytkownik` VALUES (2,'adison','adi123@gmail.com','81dc9bdb52d04dc20036dbd8313ed055',0),(3,'admin','admin@gmail.com','21232f297a57a5a743894a0e4a801fc3',1),(4,'kamil','kamil@kamil.pl','81dc9bdb52d04dc20036dbd8313ed055',0);
/*!40000 ALTER TABLE `uzytkownik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zamowienia`
--

DROP TABLE IF EXISTS `zamowienia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zamowienia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `koszt` float NOT NULL,
  `adres` varchar(50) NOT NULL,
  `miasto` varchar(50) NOT NULL,
  `metoda_p` varchar(20) NOT NULL,
  `metoda_d` varchar(20) NOT NULL,
  `numer` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `imie` varchar(25) NOT NULL,
  `nazwisko` varchar(25) NOT NULL,
  `kod` varchar(6) NOT NULL,
  `data` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zamowienia`
--

LOCK TABLES `zamowienia` WRITE;
/*!40000 ALTER TABLE `zamowienia` DISABLE KEYS */;
/*!40000 ALTER TABLE `zamowienia` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-27  1:53:17
