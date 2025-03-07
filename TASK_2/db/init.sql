
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cars` (
  `make` varchar(100) DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  `year` int DEFAULT NULL,
  `value` decimal(10,2) DEFAULT NULL
);
/*!40101 SET character_set_client = @saved_cs_client */;

insert into cars (make, model , year, value) values
  ("Porsche", "356-A Roadster", "1948", 1), 
  ("Mercedes", "Tour Bus", "1999", 99),
  ("Mercedes", "cccc", "2199", 99),
  ("Mercedes", "Enzo", "1909", 2);


--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT into users (username, password) VALUES 
  ("admin", "@dm1n"), 
  ("guest", "123123123"), 
  ("hello", "locc"), 
  ("dng", "vng");

delimiter $$
CREATE Procedure searchCar(r_year int)
begin
select * from cars where year = r_year;

end
$$ 
delimiter ;

-- Dump completed on 2025-03-06 16:08:09
