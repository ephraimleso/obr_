CREATE DATABASE `onlinebusregistration` /*!40100 DEFAULT CHARACTER SET latin1 */;

CREATE TABLE `administrators` (
  `ID` int(11) NOT NULL,
  `InitialsAndSurname` varchar(255) NOT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `EmailAddress` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ;
CREATE TABLE `grades` (
  `ID` int(11) NOT NULL,
  `Grade` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ;

CREATE TABLE `buses` (
  `ID` int(11) NOT NULL,
  `Number` int(11) DEFAULT NULL,
  `Capacity` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ;

CREATE TABLE `learners` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `NameAndSurname` varchar(255) NOT NULL,
  `EmailAddress` varchar(255) DEFAULT NULL,
  `Grade` int DEFAULT NULL,
  `ParentID` int DEFAULT NULL,
  `Cellnumber` varchar(20) NOT NULL,
  `CreatedBy` varchar(45) DEFAULT NULL,
  `CreatedDate` date DEFAULT NULL,
  PRIMARY KEY (`ID`)
);

CREATE TABLE `parents` (
  `Id` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Surname` text NOT NULL,
  `Cellnumber` text NOT NULL,
  `EmailAddress` text NOT NULL,
  `Password` text NOT NULL,
  PRIMARY KEY (`Id`)
) ;

CREATE TABLE `routes` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Number` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ;

CREATE TABLE `statuses` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
);

CREATE TABLE `subroutes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BusNumber` varchar(10) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Time` varchar(10) NOT NULL,
  `TripTypeId` int(11) NOT NULL,
  `BusId` int(11) NOT NULL,
  `RouteId` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
);

CREATE TABLE `transportapplications` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `RouteId_pickup` int NOT NULL,
  `SubRouteId_pickup` int NOT NULL,
  `BusNumber_pickup` varchar(10) NOT NULL,
  `RouteId_dropoff` int NOT NULL,
  `SubRouteId_dropoff` int NOT NULL,
  `BusNumber_dropoff` varchar(10) NOT NULL,
  `LearnerId` int NOT NULL,
  `NewLearner` varchar(10) NOT NULL,
  `NextYearGrade` int NOT NULL,
  `StatusId` int NOT NULL,
  `ApplicationDate` date NOT NULL,
  `ApplicationYear` int NOT NULL,
  `ParentId` int NOT NULL,
  `CreatedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ;



CREATE TABLE `triptypes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ;


DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_applications`(IN `parentId` INT)
BEGIN
	SELECT 
	l.NameAndSurname, s.Description as Status_description, r1.Name as Pickup, r2.Name as DropOff,
	sr1.Name as Pickup_bus_route_number,sr2.Name as Dropoff_bus_route_number, t.*
	FROM transportapplications t
		inner join learners l on l.ID = t.LearnerId
        inner join statuses s on s.ID = t.StatusId 
	left join (select * from routes) r1 on r1.ID = t.RouteId_pickup
    left join (select * from routes) r2 on r2.ID = t.RouteId_dropoff
	left join (select * from subroutes where TripTypeId = 1) sr1 on sr1.ID = t.SubRouteId_pickup 
	left join(select * from subroutes where TripTypeId = 2) sr2 on sr2.ID = t.SubRouteId_dropoff
	Where t.ParentId = parentId;
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_admin_applications_v2`()
BEGIN
	SELECT 
	l.NameAndSurname, s.Description as Status_description, r1.Name as Pickup, r2.Name as DropOff,
	sr1.Name as Pickup_bus_route_number,sr2.Name as Dropoff_bus_route_number, t.*
	FROM transportapplications t 
		inner join learners l on l.ID = t.LearnerId
        inner join statuses s on s.ID = t.StatusId 
	left join (select * from routes) r1 on r1.ID = t.RouteId_pickup
    left join (select * from routes) r2 on r2.ID = t.RouteId_dropoff
	left join (select * from subroutes where TripTypeId = 1) sr1 on sr1.ID = t.SubRouteId_pickup 
	left join(select * from subroutes where TripTypeId = 2) sr2 on sr2.ID = t.SubRouteId_dropoff;
END$$
DELIMITER ;


