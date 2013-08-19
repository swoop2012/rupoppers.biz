DROP TABLE IF EXISTS `tbdeliverypayment`;
CREATE TABLE `tbdeliverypayment` (
  `id` INTEGER  NOT NULL PRIMARY KEY AUTOINCREMENT,
  `idOfferPayment` INTEGER  NOT NULL,
  `idOfferDelivery` INTEGER  NOT NULL,
  `Status` INTEGER NOT NULL DEFAULT '0'
);
DROP TABLE IF EXISTS `tbofferdelivery`;
CREATE TABLE `tbofferdelivery` (
  `id` INTEGER  NOT NULL PRIMARY KEY AUTOINCREMENT,
  `idOffer` INTEGER NOT NULL,
  `Name` varchar(100) NOT NULL DEFAULT '',
  `Instruction` text NOT NULL,
  `Price` double NOT NULL DEFAULT '0',
  `FreeIf` double DEFAULT NULL,
  `Type` VARCHAR(10) NOT NULL,
  `Active` INTEGER NOT NULL DEFAULT '0'
);
DROP TABLE IF EXISTS `tbofferpayment`;
CREATE TABLE `tbofferpayment` (
  `id` INTEGER  NOT NULL PRIMARY KEY AUTOINCREMENT,
  `idOffer` INTEGER  NOT NULL,
  `Name` varchar(100) NOT NULL DEFAULT '',
  `Description` text NOT NULL
);

DROP TABLE IF EXISTS `tbproduct`;
CREATE TABLE `tbproduct` (
  `id` INTEGER  NOT NULL PRIMARY KEY AUTOINCREMENT,
  `idOffer` INTEGER NOT NULL,
  `Name` varchar(100) NOT NULL,
  `ShortName` varchar(100) NOT NULL DEFAULT '',
  `PictureMain` varchar(100) DEFAULT NULL,
  `PictureProduct1` varchar(100) DEFAULT NULL,
  `PictureProduct2` varchar(100) DEFAULT NULL,
  `PictureProduct3` varchar(100) DEFAULT NULL,
  `Position` INTEGER  NOT NULL,
  `ShortDescription` text,
  `MiddleDescription` text,
  `Article` text
  );


DROP TABLE IF EXISTS `tbsubproduct`;
CREATE TABLE `tbsubproduct` (
  `id` INTEGER  NOT NULL PRIMARY KEY AUTOINCREMENT,
  `idProduct` INTEGER  NOT NULL,
  `Name` varchar(100) NOT NULL DEFAULT '',
  `Count` INTEGER  NOT NULL DEFAULT '0',
  `Measure` varchar(30) NOT NULL DEFAULT '',
  `Size` varchar(30) NOT NULL DEFAULT '',
  `Property` varchar(100) DEFAULT '',
  `Price` double NOT NULL DEFAULT '0',
  `Avaible` INTEGER NOT NULL DEFAULT '0',
  `Position` INTEGER  NOT NULL DEFAULT '0'
);

