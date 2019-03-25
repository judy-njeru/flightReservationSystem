-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 25, 2019 at 09:02 PM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flight_reservation_system`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllFlights` ()  NO SQL
SELECT id, flight_route_fk, ac.name, acr.aircraft_type, froc.origin_city, frdc.destination_city, froac.origin_airport_code AS from_airport_code, frdac.destination_airport_code AS to_airport_code, economy_price, business_price, economy_capacity, business_capacity, departure_time, arrival_time, departure_day FROM flight_instance 
INNER JOIN aircraft acr ON acr.aircraft_id = flight_instance.aircraft_fk 
INNER JOIN carrier ac ON ac.carrier_id = flight_instance.carrier_fk 
INNER JOIN flight_routes froc ON froc.flight_route_id = flight_instance.flight_route_fk 
INNER JOIN flight_routes frdc ON frdc.flight_route_id = flight_instance.flight_route_fk 
INNER JOIN flight_routes froac ON froac.flight_route_id = flight_instance.flight_route_fk 
INNER JOIN flight_routes frdac ON frdac.flight_route_id = flight_instance.flight_route_fk ORDER BY id ASC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getFlights` ()  SELECT * FROM flights$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `aircraft`
--

CREATE TABLE `aircraft` (
  `aircraft_id` bigint(20) UNSIGNED NOT NULL,
  `carrier_id` bigint(20) UNSIGNED NOT NULL,
  `aircraft_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tail_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aircraft`
--

INSERT INTO `aircraft` (`aircraft_id`, `carrier_id`, `aircraft_type`, `tail_number`) VALUES
(1, 1, 'boeing 737', 'BE-737'),
(2, 1, 'airbus 134', 'AB-134'),
(3, 1, 'boeing 739', 'BE-739'),
(4, 1, 'airbus-734', 'AB-134'),
(5, 1, 'boeing 457', 'BE-457');

-- --------------------------------------------------------

--
-- Table structure for table `airport`
--

CREATE TABLE `airport` (
  `airport_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `airport_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `airport`
--

INSERT INTO `airport` (`airport_id`, `name`, `airport_code`, `city`, `region`, `image_url`) VALUES
(1, 'Aalborg Airport', 'AAL', 'Aalborg', 'North Jutland (Nordjylland)', 'http://www.smilingglobe.com/imgattraction/utzon_center-aalborg2.jpg'),
(2, 'Aarhus Airport', 'AAR', 'Aarhus', 'Mid-Jutland (Midtjylland)', 'https://static1.squarespace.com/static/547c30ede4b053a861c9f311/t/5a4ccd47c8302599dbf45d1b/1514983001932/DJI_0811-Edit.jpg?format=500w'),
(3, 'Billund Airport', 'BLL', 'Billund', 'South Denmark (Syddanmark)', 'https://media-cdn.tripadvisor.com/media/photo-s/10/64/2b/36/legoland-billund.jpg'),
(4, 'Kastrup Airport', 'CPH', 'Copenhagen', 'Capital', 'https://chrisgermer.com/wp-content/uploads/2017/03/copenhagen.png');

-- --------------------------------------------------------

--
-- Stand-in structure for view `booked_reservations`
-- (See below for the actual view)
--
CREATE TABLE `booked_reservations` (
`flight_id` bigint(20) unsigned
,`destination` bigint(20) unsigned
,`city` varchar(50)
,`image_url` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `business_seats_available`
--

CREATE TABLE `business_seats_available` (
  `business_seat_id` bigint(20) UNSIGNED NOT NULL,
  `seat_class` bigint(20) UNSIGNED NOT NULL,
  `flight_id` bigint(20) UNSIGNED NOT NULL,
  `seats_available` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_seats_available`
--

INSERT INTO `business_seats_available` (`business_seat_id`, `seat_class`, `flight_id`, `seats_available`) VALUES
(2, 2, 2, 21),
(3, 2, 3, 25),
(6, 2, 8, 69),
(7, 2, 9, 69),
(8, 2, 10, 15),
(9, 2, 12, 34),
(10, 2, 13, 34);

--
-- Triggers `business_seats_available`
--
DELIMITER $$
CREATE TRIGGER `UpdateBusinessSeatsInFlightInstance` AFTER INSERT ON `business_seats_available` FOR EACH ROW update flight_instance 
inner join business_seats_available on
    business_seats_available.flight_id = flight_instance.id
set flight_instance.available_flight_seats_business = business_seats_available.business_seat_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `carrier`
--

CREATE TABLE `carrier` (
  `carrier_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carrier`
--

INSERT INTO `carrier` (`carrier_id`, `name`) VALUES
(1, 'aerova');

-- --------------------------------------------------------

--
-- Table structure for table `economy_seat_available`
--

CREATE TABLE `economy_seat_available` (
  `economy_seat_id` bigint(20) UNSIGNED NOT NULL,
  `seat_class` bigint(20) UNSIGNED NOT NULL,
  `flight_id` bigint(20) UNSIGNED NOT NULL,
  `seats_available` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `economy_seat_available`
--

INSERT INTO `economy_seat_available` (`economy_seat_id`, `seat_class`, `flight_id`, `seats_available`) VALUES
(2, 1, 2, 77),
(3, 1, 3, 77),
(6, 1, 8, 100),
(7, 1, 9, 100),
(8, 1, 10, 70),
(9, 1, 12, 90),
(10, 1, 13, 88);

--
-- Triggers `economy_seat_available`
--
DELIMITER $$
CREATE TRIGGER `UpdateEconomySeatsFlightInstance` AFTER INSERT ON `economy_seat_available` FOR EACH ROW update flight_instance 
inner join economy_seat_available on
    economy_seat_available.flight_id = flight_instance.id
set flight_instance.available_flight_seats_economy = economy_seat_available.economy_seat_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `flights`
-- (See below for the actual view)
--
CREATE TABLE `flights` (
`id` bigint(20) unsigned
,`flight_route_fk` bigint(20) unsigned
,`name` varchar(20)
,`aircraft_type` varchar(20)
,`origin_city` varchar(50)
,`destination_city_id` bigint(20) unsigned
,`destination_city` varchar(50)
,`from_airport_code` varchar(20)
,`to_airport_code` varchar(20)
,`economy_price` decimal(6,2)
,`business_price` decimal(6,2)
,`economy_capacity` int(200)
,`business_capacity` int(50)
,`economy_seats_available` int(250)
,`business_seats_available` int(250)
,`departure_time` time
,`arrival_time` time
,`departure_day` date
);

-- --------------------------------------------------------

--
-- Table structure for table `flight_instance`
--

CREATE TABLE `flight_instance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flight_route_fk` bigint(20) UNSIGNED NOT NULL,
  `aircraft_fk` bigint(20) UNSIGNED NOT NULL,
  `carrier_fk` bigint(20) UNSIGNED NOT NULL,
  `origin_city_fk` bigint(20) UNSIGNED NOT NULL,
  `destination_city_fk` bigint(20) UNSIGNED NOT NULL,
  `origin_airport_fk` bigint(20) UNSIGNED NOT NULL,
  `destination_airport_fk` bigint(20) UNSIGNED NOT NULL,
  `economy_price` decimal(6,2) NOT NULL,
  `business_price` decimal(6,2) NOT NULL,
  `economy_capacity` int(200) NOT NULL,
  `business_capacity` int(50) NOT NULL,
  `available_flight_seats_economy` bigint(20) UNSIGNED NOT NULL,
  `available_flight_seats_business` bigint(20) UNSIGNED NOT NULL,
  `departure_time` time NOT NULL,
  `arrival_time` time NOT NULL,
  `departure_day` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flight_instance`
--

INSERT INTO `flight_instance` (`id`, `flight_route_fk`, `aircraft_fk`, `carrier_fk`, `origin_city_fk`, `destination_city_fk`, `origin_airport_fk`, `destination_airport_fk`, `economy_price`, `business_price`, `economy_capacity`, `business_capacity`, `available_flight_seats_economy`, `available_flight_seats_business`, `departure_time`, `arrival_time`, `departure_day`) VALUES
(2, 2, 5, 1, 2, 1, 2, 1, '1500.00', '2500.00', 80, 25, 2, 2, '08:10:00', '09:10:00', '2019-01-17'),
(3, 1, 5, 1, 1, 2, 1, 2, '1500.00', '2500.00', 80, 25, 3, 3, '08:10:00', '09:10:00', '2019-01-20'),
(8, 4, 1, 1, 1, 4, 1, 4, '3000.00', '7000.00', 100, 70, 6, 6, '15:10:00', '18:10:00', '2019-01-20'),
(9, 6, 1, 1, 2, 4, 2, 4, '3000.00', '7000.00', 100, 70, 7, 7, '15:10:00', '18:10:00', '2019-01-20'),
(10, 3, 4, 1, 1, 3, 1, 3, '1700.00', '3200.00', 70, 15, 8, 8, '14:10:00', '15:10:00', '2019-01-17'),
(12, 1, 2, 1, 1, 2, 1, 2, '2400.00', '5600.00', 90, 34, 9, 9, '15:10:00', '17:10:00', '2019-05-20'),
(13, 8, 2, 1, 3, 2, 3, 2, '2400.00', '5600.00', 90, 34, 10, 10, '15:10:00', '17:10:00', '2019-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `flight_instance_route`
--

CREATE TABLE `flight_instance_route` (
  `flight_route_id` bigint(20) UNSIGNED NOT NULL,
  `origin_city_fk` bigint(20) UNSIGNED NOT NULL,
  `destination_city_fk` bigint(20) UNSIGNED NOT NULL,
  `origin_airport_code_fk` bigint(20) UNSIGNED NOT NULL,
  `destination_airport_code_fk` bigint(20) UNSIGNED NOT NULL,
  `flight_duration` time NOT NULL,
  `distance` decimal(4,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flight_instance_route`
--

INSERT INTO `flight_instance_route` (`flight_route_id`, `origin_city_fk`, `destination_city_fk`, `origin_airport_code_fk`, `destination_airport_code_fk`, `flight_duration`, `distance`) VALUES
(1, 1, 2, 1, 2, '01:55:00', '118.4'),
(2, 2, 1, 2, 1, '01:56:00', '120.4'),
(3, 1, 3, 1, 3, '03:50:00', '237.2'),
(4, 1, 4, 1, 4, '03:51:00', '237.5'),
(5, 2, 3, 2, 3, '03:00:00', '179.2'),
(6, 2, 4, 2, 4, '03:05:00', '190.7'),
(7, 3, 1, 3, 1, '03:06:00', '198.8'),
(8, 3, 2, 3, 2, '03:00:00', '200.0'),
(9, 3, 4, 3, 4, '06:00:00', '320.9'),
(10, 4, 1, 4, 1, '06:00:00', '450.2'),
(11, 4, 2, 4, 2, '05:00:00', '367.9'),
(12, 4, 3, 4, 3, '05:02:00', '379.9');

-- --------------------------------------------------------

--
-- Table structure for table `flight_reservations`
--

CREATE TABLE `flight_reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `passenger_id` bigint(20) UNSIGNED NOT NULL,
  `flight_id` bigint(20) UNSIGNED NOT NULL,
  `seat_class` bigint(20) UNSIGNED NOT NULL,
  `accompanying_passengers` int(100) NOT NULL,
  `origin` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination` bigint(20) UNSIGNED NOT NULL,
  `flight_date` date NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flight_reservations`
--

INSERT INTO `flight_reservations` (`id`, `passenger_id`, `flight_id`, `seat_class`, `accompanying_passengers`, `origin`, `destination`, `flight_date`, `price`) VALUES
(2, 1, 3, 1, 1, ' Aalborg', 2, '2019-01-20', '1500.00'),
(6, 1, 2, 1, 1, ' Aarhus', 1, '2019-01-17', '1500.00'),
(7, 1, 2, 2, 2, 'Aarhus', 1, '2019-01-17', '5000.00'),
(8, 1, 2, 1, 2, 'Aarhus', 1, '2019-01-17', '3000.00'),
(9, 1, 9, 2, 1, 'Aalborg', 4, '2019-01-20', '7000.00'),
(10, 1, 2, 2, 2, 'Aarhus', 1, '2019-01-17', '5000.00'),
(11, 1, 8, 2, 1, 'Aalborg', 4, '2019-01-20', '7000.00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `flight_routes`
-- (See below for the actual view)
--
CREATE TABLE `flight_routes` (
`flight_route_id` bigint(20) unsigned
,`origin_city` varchar(50)
,`destination_city` varchar(50)
,`origin_airport_code` varchar(20)
,`destination_airport_code` varchar(20)
,`flight_duration` time
,`distance` decimal(4,1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `flight_routes_airport`
-- (See below for the actual view)
--
CREATE TABLE `flight_routes_airport` (
`flight_route_id` bigint(20) unsigned
,`origin_airport_id` bigint(20) unsigned
,`origin_airport_code` varchar(20)
,`destination_airport_id` bigint(20) unsigned
,`destination_airport_code` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `passengers`
--

CREATE TABLE `passengers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varbinary(50) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `passengers`
--

INSERT INTO `passengers` (`id`, `first_name`, `last_name`, `email`, `password`, `active`, `date_created`) VALUES
(1, 'Judy', 'Njeru', 'j@gmail.com', 0x31323334353637, 1, '2019-01-11 10:03:57'),
(4, 'Kelly', 'Houston', 'k@gmail.com', 0x31323334353637, 1, '2019-01-11 11:59:01');

-- --------------------------------------------------------

--
-- Stand-in structure for view `reservations`
-- (See below for the actual view)
--
CREATE TABLE `reservations` (
`flight_id` bigint(20) unsigned
,`origin` varchar(20)
,`destination` bigint(20) unsigned
,`flight_date` date
);

-- --------------------------------------------------------

--
-- Table structure for table `seats_booked`
--

CREATE TABLE `seats_booked` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `passenger_id` bigint(20) UNSIGNED NOT NULL,
  `flight_id` bigint(20) UNSIGNED NOT NULL,
  `seat_class` bigint(20) UNSIGNED NOT NULL,
  `number_of_seats_booked` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seats_booked`
--

INSERT INTO `seats_booked` (`id`, `passenger_id`, `flight_id`, `seat_class`, `number_of_seats_booked`) VALUES
(1, 1, 7, 1, 1),
(2, 1, 3, 1, 1),
(3, 1, 3, 1, 2),
(4, 1, 13, 1, 1),
(5, 1, 13, 1, 1),
(6, 1, 2, 1, 1),
(7, 1, 2, 2, 2),
(8, 1, 2, 1, 2),
(9, 1, 9, 2, 1),
(10, 1, 2, 2, 2),
(11, 1, 8, 2, 1);

--
-- Triggers `seats_booked`
--
DELIMITER $$
CREATE TRIGGER `DecrementBusiness_Seats` AFTER INSERT ON `seats_booked` FOR EACH ROW UPDATE business_seats_available
SET seats_available = seats_available - NEW.number_of_seats_booked WHERE seat_class = NEW.seat_class AND flight_id = NEW.flight_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Decrement_EconomySeats` AFTER INSERT ON `seats_booked` FOR EACH ROW UPDATE economy_seat_available
SET seats_available = seats_available - NEW.number_of_seats_booked WHERE seat_class = NEW.seat_class AND flight_id = NEW.flight_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `seat_class`
--

CREATE TABLE `seat_class` (
  `seat_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seat_class`
--

INSERT INTO `seat_class` (`seat_id`, `name`) VALUES
(1, 'economy'),
(2, 'business');

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_reservations`
-- (See below for the actual view)
--
CREATE TABLE `user_reservations` (
`passenger_id` bigint(20) unsigned
,`flight_id` bigint(20) unsigned
,`class` varchar(20)
,`origin` varchar(20)
,`destination` varchar(50)
,`flight_date` date
);

-- --------------------------------------------------------

--
-- Structure for view `booked_reservations`
--
DROP TABLE IF EXISTS `booked_reservations`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `booked_reservations`  AS  select `flight_reservations`.`flight_id` AS `flight_id`,`flight_reservations`.`destination` AS `destination`,`airport`.`city` AS `city`,`airport`.`image_url` AS `image_url` from (`airport` join `flight_reservations` on((`flight_reservations`.`destination` = `airport`.`airport_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `flights`
--
DROP TABLE IF EXISTS `flights`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `flights`  AS  select `flight_instance`.`id` AS `id`,`flight_instance`.`flight_route_fk` AS `flight_route_fk`,`ac`.`name` AS `name`,`acr`.`aircraft_type` AS `aircraft_type`,`froc`.`origin_city` AS `origin_city`,`dci`.`airport_id` AS `destination_city_id`,`frdc`.`destination_city` AS `destination_city`,`froac`.`origin_airport_code` AS `from_airport_code`,`frdac`.`destination_airport_code` AS `to_airport_code`,`flight_instance`.`economy_price` AS `economy_price`,`flight_instance`.`business_price` AS `business_price`,`flight_instance`.`economy_capacity` AS `economy_capacity`,`flight_instance`.`business_capacity` AS `business_capacity`,`esa`.`seats_available` AS `economy_seats_available`,`bsa`.`seats_available` AS `business_seats_available`,`flight_instance`.`departure_time` AS `departure_time`,`flight_instance`.`arrival_time` AS `arrival_time`,`flight_instance`.`departure_day` AS `departure_day` from (((((((((`flight_instance` join `economy_seat_available` `esa` on((`esa`.`economy_seat_id` = `flight_instance`.`available_flight_seats_economy`))) join `business_seats_available` `bsa` on((`bsa`.`business_seat_id` = `flight_instance`.`available_flight_seats_business`))) join `aircraft` `acr` on((`acr`.`aircraft_id` = `flight_instance`.`aircraft_fk`))) join `carrier` `ac` on((`ac`.`carrier_id` = `flight_instance`.`carrier_fk`))) join `airport` `dci` on((`dci`.`airport_id` = `flight_instance`.`destination_city_fk`))) join `flight_routes` `froc` on((`froc`.`flight_route_id` = `flight_instance`.`flight_route_fk`))) join `flight_routes` `frdc` on((`frdc`.`flight_route_id` = `flight_instance`.`flight_route_fk`))) join `flight_routes` `froac` on((`froac`.`flight_route_id` = `flight_instance`.`flight_route_fk`))) join `flight_routes` `frdac` on((`frdac`.`flight_route_id` = `flight_instance`.`flight_route_fk`))) order by `flight_instance`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `flight_routes`
--
DROP TABLE IF EXISTS `flight_routes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `flight_routes`  AS  select `flight_instance_route`.`flight_route_id` AS `flight_route_id`,`ac`.`city` AS `origin_city`,`dc`.`city` AS `destination_city`,`roac`.`airport_code` AS `origin_airport_code`,`rdac`.`airport_code` AS `destination_airport_code`,`flight_instance_route`.`flight_duration` AS `flight_duration`,`flight_instance_route`.`distance` AS `distance` from ((((`flight_instance_route` join `airport` `ac` on((`ac`.`airport_id` = `flight_instance_route`.`origin_city_fk`))) join `airport` `dc` on((`dc`.`airport_id` = `flight_instance_route`.`destination_city_fk`))) join `airport` `roac` on((`roac`.`airport_id` = `flight_instance_route`.`origin_airport_code_fk`))) join `airport` `rdac` on((`rdac`.`airport_id` = `flight_instance_route`.`destination_airport_code_fk`))) ;

-- --------------------------------------------------------

--
-- Structure for view `flight_routes_airport`
--
DROP TABLE IF EXISTS `flight_routes_airport`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `flight_routes_airport`  AS  select `flight_instance_route`.`flight_route_id` AS `flight_route_id`,`roid`.`airport_id` AS `origin_airport_id`,`roac`.`airport_code` AS `origin_airport_code`,`rdid`.`airport_id` AS `destination_airport_id`,`rdac`.`airport_code` AS `destination_airport_code` from ((((`flight_instance_route` join `airport` `roid` on((`roid`.`airport_id` = `flight_instance_route`.`origin_airport_code_fk`))) join `airport` `rdid` on((`rdid`.`airport_id` = `flight_instance_route`.`destination_airport_code_fk`))) join `airport` `roac` on((`roac`.`airport_id` = `flight_instance_route`.`origin_airport_code_fk`))) join `airport` `rdac` on((`rdac`.`airport_id` = `flight_instance_route`.`destination_airport_code_fk`))) ;

-- --------------------------------------------------------

--
-- Structure for view `reservations`
--
DROP TABLE IF EXISTS `reservations`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `reservations`  AS  select `flight_reservations`.`flight_id` AS `flight_id`,`flight_reservations`.`origin` AS `origin`,`flight_reservations`.`destination` AS `destination`,`flight_reservations`.`flight_date` AS `flight_date` from (`flight_reservations` join `flight_instance` on((`flight_reservations`.`flight_id` = `flight_instance`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `user_reservations`
--
DROP TABLE IF EXISTS `user_reservations`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_reservations`  AS  select `flight_reservations`.`passenger_id` AS `passenger_id`,`flight_reservations`.`flight_id` AS `flight_id`,`sc`.`name` AS `class`,`flight_reservations`.`origin` AS `origin`,`ar`.`city` AS `destination`,`flight_reservations`.`flight_date` AS `flight_date` from ((`flight_reservations` join `airport` `ar` on((`ar`.`airport_id` = `flight_reservations`.`destination`))) join `seat_class` `sc` on((`sc`.`seat_id` = `flight_reservations`.`seat_class`))) where (`flight_reservations`.`passenger_id` = '1') ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aircraft`
--
ALTER TABLE `aircraft`
  ADD PRIMARY KEY (`aircraft_id`),
  ADD UNIQUE KEY `id` (`aircraft_id`);

--
-- Indexes for table `airport`
--
ALTER TABLE `airport`
  ADD PRIMARY KEY (`airport_id`),
  ADD UNIQUE KEY `id` (`airport_id`),
  ADD UNIQUE KEY `airport_code` (`airport_code`);

--
-- Indexes for table `business_seats_available`
--
ALTER TABLE `business_seats_available`
  ADD PRIMARY KEY (`business_seat_id`),
  ADD UNIQUE KEY `id` (`business_seat_id`),
  ADD KEY `seat_class` (`seat_class`),
  ADD KEY `business_seats_available_ibfk_3` (`flight_id`);

--
-- Indexes for table `carrier`
--
ALTER TABLE `carrier`
  ADD PRIMARY KEY (`carrier_id`),
  ADD UNIQUE KEY `id` (`carrier_id`),
  ADD UNIQUE KEY `aircraft_id` (`carrier_id`);

--
-- Indexes for table `economy_seat_available`
--
ALTER TABLE `economy_seat_available`
  ADD PRIMARY KEY (`economy_seat_id`),
  ADD UNIQUE KEY `id` (`economy_seat_id`),
  ADD KEY `seat_class` (`seat_class`),
  ADD KEY `economy_seat_available_ibfk_3` (`flight_id`);

--
-- Indexes for table `flight_instance`
--
ALTER TABLE `flight_instance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `aircraft_type` (`aircraft_fk`),
  ADD KEY `airline_information` (`carrier_fk`),
  ADD KEY `destination_airport_fk` (`destination_airport_fk`),
  ADD KEY `origin_airport_fk` (`origin_airport_fk`),
  ADD KEY `flight_instance_ibfk_3` (`origin_city_fk`),
  ADD KEY `destination_city_fk` (`destination_city_fk`),
  ADD KEY `flight_route_fk` (`flight_route_fk`),
  ADD KEY `flight_instance_ibfk_6` (`available_flight_seats_business`),
  ADD KEY `flight_instance_ibfk_7` (`available_flight_seats_economy`);

--
-- Indexes for table `flight_instance_route`
--
ALTER TABLE `flight_instance_route`
  ADD PRIMARY KEY (`flight_route_id`),
  ADD UNIQUE KEY `id` (`flight_route_id`),
  ADD KEY `origin_airport` (`origin_city_fk`),
  ADD KEY `to_airport_code` (`destination_airport_code_fk`),
  ADD KEY `from_airport_code` (`origin_airport_code_fk`),
  ADD KEY `to_city` (`destination_city_fk`);

--
-- Indexes for table `flight_reservations`
--
ALTER TABLE `flight_reservations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `passenger_id_fk` (`passenger_id`),
  ADD KEY `flight_id_fk` (`flight_id`),
  ADD KEY `seat_class_fk` (`seat_class`),
  ADD KEY `airport-look` (`destination`);

--
-- Indexes for table `passengers`
--
ALTER TABLE `passengers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `seats_booked`
--
ALTER TABLE `seats_booked`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `flight_id` (`flight_id`),
  ADD KEY `passenger_id` (`passenger_id`),
  ADD KEY `seat_class_type_fk` (`seat_class`);

--
-- Indexes for table `seat_class`
--
ALTER TABLE `seat_class`
  ADD PRIMARY KEY (`seat_id`),
  ADD UNIQUE KEY `id` (`seat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aircraft`
--
ALTER TABLE `aircraft`
  MODIFY `aircraft_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `airport`
--
ALTER TABLE `airport`
  MODIFY `airport_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `business_seats_available`
--
ALTER TABLE `business_seats_available`
  MODIFY `business_seat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `carrier`
--
ALTER TABLE `carrier`
  MODIFY `carrier_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `economy_seat_available`
--
ALTER TABLE `economy_seat_available`
  MODIFY `economy_seat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `flight_instance`
--
ALTER TABLE `flight_instance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `flight_instance_route`
--
ALTER TABLE `flight_instance_route`
  MODIFY `flight_route_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `flight_reservations`
--
ALTER TABLE `flight_reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `passengers`
--
ALTER TABLE `passengers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seats_booked`
--
ALTER TABLE `seats_booked`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `seat_class`
--
ALTER TABLE `seat_class`
  MODIFY `seat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `business_seats_available`
--
ALTER TABLE `business_seats_available`
  ADD CONSTRAINT `business_seats_available_ibfk_2` FOREIGN KEY (`seat_class`) REFERENCES `seat_class` (`seat_id`),
  ADD CONSTRAINT `business_seats_available_ibfk_3` FOREIGN KEY (`flight_id`) REFERENCES `flight_instance` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `economy_seat_available`
--
ALTER TABLE `economy_seat_available`
  ADD CONSTRAINT `economy_seat_available_ibfk_2` FOREIGN KEY (`seat_class`) REFERENCES `seat_class` (`seat_id`),
  ADD CONSTRAINT `economy_seat_available_ibfk_3` FOREIGN KEY (`flight_id`) REFERENCES `flight_instance` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `flight_instance`
--
ALTER TABLE `flight_instance`
  ADD CONSTRAINT `aircraft_type` FOREIGN KEY (`aircraft_fk`) REFERENCES `aircraft` (`aircraft_id`),
  ADD CONSTRAINT `airline_information` FOREIGN KEY (`carrier_fk`) REFERENCES `carrier` (`carrier_id`),
  ADD CONSTRAINT `flight_instance_ibfk_1` FOREIGN KEY (`destination_airport_fk`) REFERENCES `airport` (`airport_id`),
  ADD CONSTRAINT `flight_instance_ibfk_2` FOREIGN KEY (`origin_airport_fk`) REFERENCES `airport` (`airport_id`),
  ADD CONSTRAINT `flight_instance_ibfk_3` FOREIGN KEY (`origin_city_fk`) REFERENCES `airport` (`airport_id`),
  ADD CONSTRAINT `flight_instance_ibfk_4` FOREIGN KEY (`destination_city_fk`) REFERENCES `airport` (`airport_id`),
  ADD CONSTRAINT `flight_instance_ibfk_5` FOREIGN KEY (`flight_route_fk`) REFERENCES `flight_instance_route` (`flight_route_id`),
  ADD CONSTRAINT `flight_instance_ibfk_6` FOREIGN KEY (`available_flight_seats_business`) REFERENCES `business_seats_available` (`business_seat_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `flight_instance_ibfk_7` FOREIGN KEY (`available_flight_seats_economy`) REFERENCES `economy_seat_available` (`economy_seat_id`) ON DELETE CASCADE;

--
-- Constraints for table `flight_instance_route`
--
ALTER TABLE `flight_instance_route`
  ADD CONSTRAINT `from_airport_code` FOREIGN KEY (`origin_airport_code_fk`) REFERENCES `airport` (`airport_id`),
  ADD CONSTRAINT `from_city` FOREIGN KEY (`origin_city_fk`) REFERENCES `airport` (`airport_id`),
  ADD CONSTRAINT `to_airport_code` FOREIGN KEY (`destination_airport_code_fk`) REFERENCES `airport` (`airport_id`),
  ADD CONSTRAINT `to_city` FOREIGN KEY (`destination_city_fk`) REFERENCES `airport` (`airport_id`);

--
-- Constraints for table `flight_reservations`
--
ALTER TABLE `flight_reservations`
  ADD CONSTRAINT `airport-look` FOREIGN KEY (`destination`) REFERENCES `airport` (`airport_id`),
  ADD CONSTRAINT `passenger_id_fk` FOREIGN KEY (`passenger_id`) REFERENCES `passengers` (`id`),
  ADD CONSTRAINT `seat_class_fk` FOREIGN KEY (`seat_class`) REFERENCES `seat_class` (`seat_id`);

--
-- Constraints for table `seats_booked`
--
ALTER TABLE `seats_booked`
  ADD CONSTRAINT `passenger_id` FOREIGN KEY (`passenger_id`) REFERENCES `passengers` (`id`),
  ADD CONSTRAINT `seat_class_type_fk` FOREIGN KEY (`seat_class`) REFERENCES `seat_class` (`seat_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
