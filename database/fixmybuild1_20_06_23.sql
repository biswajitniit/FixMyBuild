-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2023 at 11:22 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fixmybuild1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_super` tinyint(1) NOT NULL DEFAULT 0,
  `type` enum('superadmin','reviewer','helpdesk') NOT NULL DEFAULT 'superadmin',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `is_super`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$9c4/3snzvsSVT.IuMbddLe0IoCf2JCt8kXCpxh..DwPcqnNNmqjLW', 0, 'superadmin', 'VzuEj1PfamTRCqvYCCSpCxqYJJx43bvlPAIU2k2gMe5D3BxeCH0AodOPQow0', '2023-05-18 00:34:53', '2023-05-18 00:34:53'),
(2, 'reviewer', 'reviewer@gmail.com', '$2y$10$9c4/3snzvsSVT.IuMbddLe0IoCf2JCt8kXCpxh..DwPcqnNNmqjLW', 0, 'reviewer', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `area_covers`
--

CREATE TABLE `area_covers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `area_type` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `area_covers`
--

INSERT INTO `area_covers` (`id`, `area_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Aberdeenshire', 1, NULL, NULL),
(2, 'Angus', 1, NULL, NULL),
(3, 'Argyll and Bute', 1, NULL, NULL),
(4, 'Ayrshire and Arran', 1, NULL, NULL),
(5, 'Banffshire', 1, NULL, NULL),
(6, 'Caithness', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `buildercategories`
--

CREATE TABLE `buildercategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `builder_category_name` varchar(255) NOT NULL,
  `status` enum('Active','InActive') NOT NULL DEFAULT 'Active' COMMENT 'Active,InActive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buildercategories`
--

INSERT INTO `buildercategories` (`id`, `builder_category_name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Air Conditioning', 'Active', NULL, NULL, NULL),
(2, 'Alarms / Security', 'Active', NULL, NULL, NULL),
(3, 'Appliance Services / Repair', 'Active', NULL, NULL, NULL),
(4, 'Aquariums', 'Active', NULL, NULL, NULL),
(5, 'Architectural Services', 'Active', NULL, NULL, NULL),
(6, 'Asbestos Services', 'Active', NULL, NULL, NULL),
(7, 'Bathrooms', 'Active', NULL, NULL, NULL),
(8, 'Bedrooms', 'Active', NULL, NULL, NULL),
(9, 'Bricklayer', 'Active', NULL, NULL, NULL),
(10, 'Builder', 'Active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `buildersubcategories`
--

CREATE TABLE `buildersubcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `builder_category_id` bigint(20) UNSIGNED NOT NULL,
  `builder_subcategory_name` varchar(255) NOT NULL,
  `status` enum('Active','InActive') NOT NULL DEFAULT 'Active' COMMENT 'Active,InActive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buildersubcategories`
--

INSERT INTO `buildersubcategories` (`id`, `builder_category_id`, `builder_subcategory_name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Air Conditioning Installation', 'Active', NULL, NULL, NULL),
(2, 1, 'Air Conditioning Repair', 'Active', NULL, NULL, NULL),
(3, 1, 'Air Conditioning Servicing', 'Active', NULL, NULL, NULL),
(4, 1, 'Emergency Air Conditioning Services', 'Active', NULL, NULL, NULL),
(5, 2, 'Alarm Response', 'Active', NULL, NULL, NULL),
(6, 2, 'Biometric Security Systems', 'Active', NULL, NULL, NULL),
(7, 2, 'Burglar Alarm - Installation', 'Active', NULL, NULL, NULL),
(8, 2, 'Burglar Alarm - Supply & Installation', 'Active', NULL, NULL, NULL),
(9, 2, 'Burglar Alarm - Supply Only', 'Active', NULL, NULL, NULL),
(10, 2, 'Call / Door Entry Systems', 'Active', NULL, NULL, NULL),
(11, 2, 'CCTV - Installation', 'Active', NULL, NULL, NULL),
(12, 2, 'CCTV - Supply & Installation', 'Active', NULL, NULL, NULL),
(13, 2, 'CCTV - Supply Only', 'Active', NULL, NULL, NULL),
(14, 2, 'Electric Gate Installation', 'Active', NULL, NULL, NULL),
(15, 2, 'Electric Gate Repair', 'Active', NULL, NULL, NULL),
(16, 2, 'Fire Alarm Installation', 'Active', NULL, NULL, NULL),
(17, 2, 'Fire Alarm Servicing', 'Active', NULL, NULL, NULL),
(18, 2, 'Fire Extinguishers', 'Active', NULL, NULL, NULL),
(19, 2, 'Fire Risk Assessment', 'Active', NULL, NULL, NULL),
(20, 2, 'Gate Automation', 'Active', NULL, NULL, NULL),
(21, 2, 'Industrial Doors', 'Active', NULL, NULL, NULL),
(22, 2, 'Intercom Entry Systems', 'Active', NULL, NULL, NULL),
(23, 2, 'Intruder Alarms', 'Active', NULL, NULL, NULL),
(24, 2, 'Safes', 'Active', NULL, NULL, NULL),
(25, 2, 'Scaffold Alarms', 'Active', NULL, NULL, NULL),
(26, 2, 'Security Assessment', 'Active', NULL, NULL, NULL),
(27, 2, 'Security Barriers', 'Active', NULL, NULL, NULL),
(28, 2, 'Security Fencing', 'Active', NULL, NULL, NULL),
(29, 2, 'Security Shutters / Grilles', 'Active', NULL, NULL, NULL),
(30, 2, 'Security Solutions / Access Control', 'Active', NULL, NULL, NULL),
(31, 3, 'Industrial Doors', 'Active', NULL, NULL, NULL),
(32, 3, 'Intercom Entry Systems', 'Active', NULL, NULL, NULL),
(33, 3, 'Intruder Alarms', 'Active', NULL, NULL, NULL),
(34, 3, 'Safes', 'Active', NULL, NULL, NULL),
(35, 3, 'Scaffold Alarms', 'Active', NULL, NULL, NULL),
(36, 3, 'Security Assessment', 'Active', NULL, NULL, NULL),
(37, 3, 'Security Barriers', 'Active', NULL, NULL, NULL),
(38, 3, 'Security Fencing', 'Active', NULL, NULL, NULL),
(39, 3, 'Security Shutters / Grilles', 'Active', NULL, NULL, NULL),
(40, 3, 'Security Solutions / Access Control', 'Active', NULL, NULL, NULL),
(41, 4, 'Aquariums', 'Active', NULL, NULL, NULL),
(42, 5, '3D Architectural Models', 'Active', NULL, NULL, NULL),
(43, 5, 'Architect', 'Active', NULL, NULL, NULL),
(44, 5, 'Architectural Drawings', 'Active', NULL, NULL, NULL),
(45, 5, 'Architectural Technician', 'Active', NULL, NULL, NULL),
(46, 5, 'Planning / Design', 'Active', NULL, NULL, NULL),
(47, 5, 'Planning Consultants', 'Active', NULL, NULL, NULL),
(48, 5, 'Technical Drawing', 'Active', NULL, NULL, NULL),
(49, 6, 'Asbestos Removal - License', 'Active', NULL, NULL, NULL),
(50, 6, 'Asbestos Removal - Non License', 'Active', NULL, NULL, NULL),
(51, 6, 'Asbestos Surveys', 'Active', NULL, NULL, NULL),
(52, 6, 'Asbestos Testing', 'Active', NULL, NULL, NULL),
(53, 6, 'Emergency Asbestos Service', 'Active', NULL, NULL, NULL),
(54, 7, 'Bath Resurfacing', 'Active', NULL, NULL, NULL),
(55, 7, 'Bathroom Cladding', 'Active', NULL, NULL, NULL),
(56, 7, 'Bathroom Designer', 'Active', NULL, NULL, NULL),
(57, 7, 'Bathroom Fitter', 'Active', NULL, NULL, NULL),
(58, 7, 'Bathroom Showroom', 'Active', NULL, NULL, NULL),
(59, 7, 'Bathroom Supplier', 'Active', NULL, NULL, NULL),
(60, 7, 'Disabled Bathrooms / Showers', 'Active', NULL, NULL, NULL),
(61, 7, 'Emergency Bathroom Service', 'Active', NULL, NULL, NULL),
(62, 7, 'Mastic Sealant', 'Active', NULL, NULL, NULL),
(63, 7, 'Wet Rooms', 'Active', NULL, NULL, NULL),
(64, 8, 'Bedroom Planner / Designer', 'Active', NULL, NULL, NULL),
(65, 8, 'Bedroom Showroom', 'Active', NULL, NULL, NULL),
(66, 8, 'Bedroom Supplier / Installer', 'Active', NULL, NULL, NULL),
(67, 8, 'Fitted Wardrobes', 'Active', NULL, NULL, NULL),
(68, 8, 'Home Offices', 'Active', NULL, NULL, NULL),
(69, 8, 'Wardrobe Sliding Doors', 'Active', NULL, NULL, NULL),
(70, 9, 'Brickwork', 'Active', NULL, NULL, NULL),
(71, 9, 'Dry Stone Walling', 'Active', NULL, NULL, NULL),
(72, 9, 'Emergency Bricklayer Service', 'Active', NULL, NULL, NULL),
(73, 9, 'Flint / Stonework', 'Active', NULL, NULL, NULL),
(74, 9, 'Repointing', 'Active', NULL, NULL, NULL),
(75, 10, 'Agricultural Building', 'Active', NULL, NULL, NULL),
(76, 10, 'Basement / Cellar Conversions', 'Active', NULL, NULL, NULL),
(77, 10, 'Brick / Concrete Structural Repairs', 'Active', NULL, NULL, NULL),
(78, 10, 'Building Merchants', 'Active', NULL, NULL, NULL),
(79, 10, 'Car Ports', 'Active', NULL, NULL, NULL),
(80, 10, 'Cladding', 'Active', NULL, NULL, NULL),
(81, 10, 'Concrete Garages', 'Active', NULL, NULL, NULL),
(82, 10, 'Concreting', 'Active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cms_pagename` varchar(255) NOT NULL,
  `cms_heading` varchar(255) DEFAULT NULL,
  `cms_description` longtext DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL COMMENT 'Active,Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `cms_pagename`, `cms_heading`, `cms_description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'about-us', 'ABOUT US', '<div class=\"container\">\r\n<div class=\"mb-5 row\">\r\n<div class=\"col-md-12\">\r\n<div class=\"mb-5 our-story\">\r\n<div class=\"row\">\r\n<div class=\"col-md-12\">\r\n<h5>Our story</h5>\r\n\r\n<p>Our story starts with our founder waking up one morning, realising that life is too short to live with regrets and wanting to make more of a positive difference in our world while he&#39;s still alive.</p>\r\n\r\n<p>He decided to leave his safe job and started to aim to help to our society as much as possible while he is still alive, tackling every challenge that he&#39;s faced in his life so far.</p>\r\n\r\n<p>Up until his life until then, whenever he needed help with finding the right person for general renovation, he spent a lot of time trying to find people he can trust and are available. Sometimes he found the right person at the right time and price, and other times he struggled, often spending a lot of time discussing requirements with a lot of people, taking risks by giving work to people he didn&rsquo;t know and ending up paying more than his original budget.</p>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"good-quality mb-5\">\r\n<div class=\"row\">\r\n<div class=\"col-md-12\">\r\n<h4>We can find people through other websites, but how do we know if they are <span>available</span>, and they can deliver a <span>good quality</span> of work while not <span>overcharging</span> us?</h4>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"row\">\r\n<div class=\"col-md-12 fmb_titel mb-5 text-center\">\r\n<h2>Our mission</h2>\r\n</div>\r\n</div>\r\n\r\n<div class=\"our-missoin white_bg\">\r\n<div class=\"row\">\r\n<div class=\"col-12\">\r\n<h2>Through our platform we aim to solve these challenges while saving your time and money.</h2>\r\n\r\n<h5>How do we achieve this?</h5>\r\n</div>\r\n\r\n<div class=\"row\">\r\n<div class=\"col-md-9\">\r\n<div class=\"row\">\r\n<div class=\"col-2 col-md-1\"><span>1</span></div>\r\n\r\n<div class=\"col-10 col-md-11\">\r\n<p>We review each of your projects for free, identifying areas that might require further thought and, when necessary, providing feedback accordingly before tradespeople are engaged. By doing this, we help to reduce differences in understanding between yourself and tradespeople, which could otherwise cause disputes, while giving you a heads&rsquo; up of potential additional work that might be required.</p>\r\n</div>\r\n\r\n<div class=\"col-2 col-md-1\"><span>2</span></div>\r\n\r\n<div class=\"col-10 col-md-11\">\r\n<p>After your project request has been approved, multiple tradespeople are engaged right away and receive the same requirements from you. This means you don&rsquo;t have to call people up individually while making sure you&rsquo;re informing them the same requirements each time.</p>\r\n</div>\r\n\r\n<div class=\"col-2 col-md-1\"><span>3</span></div>\r\n\r\n<div class=\"col-10 col-md-11\">\r\n<p>Tradespeople who are available usually respond to your project requests quickly, so you don&rsquo;t need to spend time finding someone who is available to start right away.</p>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-3 text-center\"><img alt=\"\" src=\"assets/img/5 1 (1).png\" /></div>\r\n\r\n<div class=\"bottom_text col-12\">\r\n<div class=\"row\">\r\n<div class=\"col-2 col-md-1\"><span>4</span></div>\r\n\r\n<div class=\"col-10 col-md-11\">\r\n<p>The tradespeople whom you desire can inform you when they are available, so at least you&rsquo;ll know how long you&rsquo;ll need to wait before they are ready to start on your project.</p>\r\n</div>\r\n\r\n<div class=\"col-2 col-md-1\"><span>5</span></div>\r\n\r\n<div class=\"col-10 col-md-11\">\r\n<p>To gauge if an estimate is fair you can compare the products and services with other estimates received from other tradespeople on this website.</p>\r\n</div>\r\n\r\n<div class=\"col-2 col-md-1\"><span>6</span></div>\r\n\r\n<div class=\"col-10 col-md-11\">\r\n<p>Whilst unplanned costs cannot always be determined in advance, tradespeople on our platform try to give as much advance notice of unexpected costs as possible by including &lsquo;contingency&rsquo; in their estimates. This allows you to set a more accurate budget in advance, and therefore reduce the likelihood of disappointment and delays later on</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"row\">\r\n<div class=\"col-md-12 fmb_titel mb-4 mt-5 text-center\">\r\n<h2>Our values</h2>\r\n</div>\r\n</div>\r\n\r\n<div class=\"our-missoin white_bg\">\r\n<div class=\"row\">\r\n<div class=\"col-md-3 text-center\"><img alt=\"\" src=\"assets/img/5 1 (1).png\" /></div>\r\n\r\n<div class=\"col-md-9 our-values\">\r\n<div class=\"row\">\r\n<div class=\"col-2 col-md-1\"><span>1</span></div>\r\n\r\n<div class=\"col-10 col-md-11\">\r\n<h5>Kindness and fairness</h5>\r\n\r\n<p>We try to be kind and fair to everyone in our ecosystem, including people wanting projects to be undertaken, tradespeople, suppliers, etc. We believe that kindness goes a long way towards building a better society.</p>\r\n</div>\r\n\r\n<div class=\"col-2 col-md-1\"><span>1</span></div>\r\n\r\n<div class=\"col-10 col-md-11\">\r\n<h5>Empowering women</h5>\r\n\r\n<p>Most of our tradespeople are in the construction industry, which is currently very heavily male-dominated. We try to encourage more women into the industry to create a more representative community.</p>\r\n</div>\r\n\r\n<div class=\"col-2 col-md-1\"><span>1</span></div>\r\n\r\n<div class=\"col-10 col-md-11\">\r\n<h5>Data Privacy</h5>\r\n\r\n<p>We respect your privacy, and this respect underpins how we use, store and process data. For more information feel free to read our Privacy Policy.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-12 fmb_titel mt-5 text-center\">\r\n<div class=\"mt-4\">\r\n<h2>Thank you for reading and have a lovely day</h2>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<!--// END--></div>', 'Active', '2023-04-13 02:00:02', '2023-04-13 07:21:48', NULL),
(2, 'contact-us', 'Contact us', '<div class=\"mb-5 row\">\r\n<div class=\"col-md-10 offset-md-1\">\r\n<div class=\"contact-us-top\">\r\n<div class=\"row\">\r\n<div class=\"col-md-3 text-center\"><img alt=\"\" src=\"assets/img/5 1.png\" /></div>\r\n\r\n<div class=\"col-md-9\">\r\n<h5>Our telephone number is 0208 145 5102 and our normal business hours are 9 am to 5 pm UK time excluding Bank Holidays.</h5>\r\n\r\n<h6>Outside of these times you can leave a voice message with us and we will contact you when we&#39;re next online.</h6>\r\n\r\n<h5>Our email is: <a href=\"tel:support@fixmybuild.com\">support@fixmybuild.com</a></h5>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"contact-us-bottom mt-5\">\r\n<div class=\"row\">\r\n<div class=\"col-md-6\">\r\n<h5>Our company address is</h5>\r\n\r\n<h6>Our team work from our homes or remotely.</h6>\r\n</div>\r\n\r\n<div class=\"col-md-6\">\r\n<h3>88 Riverside Drive, Mitcham CR4 4BW</h3>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<!--// END-->', 'Active', '2023-04-13 08:56:31', '2023-04-13 08:56:31', NULL),
(3, 'privacy-policy', 'Privacy policy', '<div class=\"mb-5 row\">\r\n<div class=\"col-md-10 offset-md-1\">\r\n<div class=\"content-wrap white_bg\">\r\n<div class=\"row\">\r\n<div class=\"col-12\">\r\n<h5>Amet minim mollit non deserunt ullamco est sit aliqua dolor sint.</h5>\r\n\r\n<p>Amet minim mollit non deserunt ullamco est sit aliqua dolor sint.<br />\r\nExercitation veniam <a href=\"#\">enim-velit@fixmybuild.com</a></p>\r\n\r\n<p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet. Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet. Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>\r\n\r\n<ul>\r\n	<li>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint.</li>\r\n	<li>Amet minim mollit non deserunt.</li>\r\n	<li>Amet minim mollit non deserunt ullamco est sit aliqua.</li>\r\n	<li>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit.</li>\r\n	<li>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint.</li>\r\n	<li>Amet minim mollit non deserunt.</li>\r\n	<li>Amet minim mollit non deserunt ullamco est sit aliqua.</li>\r\n	<li>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit.</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<!--// END-->', 'Active', '2023-04-13 09:03:39', '2023-04-13 09:03:39', NULL),
(4, 'terms-of-service', 'Terms of Service', '<div class=\"mb-5 row\">\r\n<div class=\"col-md-10 offset-md-1\">\r\n<div class=\"content-wrap white_bg\">\r\n<div class=\"row\">\r\n<div class=\"col-12\">\r\n<h5>Amet minim mollit non deserunt ullamco est sit aliqua dolor sint.</h5>\r\n\r\n<p>Amet minim mollit non deserunt ullamco est sit aliqua dolor sint.<br />\r\nExercitation veniam <a href=\"#\">enim-velit@fixmybuild.com</a></p>\r\n\r\n<p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet. Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet. Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>\r\n\r\n<ul>\r\n	<li>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint.</li>\r\n	<li>Amet minim mollit non deserunt.</li>\r\n	<li>Amet minim mollit non deserunt ullamco est sit aliqua.</li>\r\n	<li>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit.</li>\r\n	<li>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint.</li>\r\n	<li>Amet minim mollit non deserunt.</li>\r\n	<li>Amet minim mollit non deserunt ullamco est sit aliqua.</li>\r\n	<li>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit.</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<!--// END-->', 'Active', '2023-04-13 09:12:21', '2023-05-09 08:22:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cookies`
--

CREATE TABLE `cookies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `length` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `home_phone` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_id`, `profile_picture`, `home_phone`, `mobile`, `email`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '8768624650', '8170915403', 'biswajitmaityniit@gmail.com', '2023-05-18 00:34:53', '2023-05-18 00:34:53');

-- --------------------------------------------------------

--
-- Table structure for table `estimates`
--

CREATE TABLE `estimates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `tradesperson_id` bigint(20) UNSIGNED NOT NULL,
  `project_awarded` tinyint(1) NOT NULL DEFAULT 0,
  `describe_mode` varchar(50) NOT NULL COMMENT 'Fully_describe,Unable_to_describe',
  `unable_to_describe_type` varchar(50) DEFAULT NULL COMMENT 'Need_more_info,Do_not_undertake_project_type,Do_not_cover_location',
  `more_info` text DEFAULT NULL,
  `covers_customers_all_needs` tinyint(1) NOT NULL DEFAULT 0,
  `payment_required_upfront` tinyint(1) NOT NULL DEFAULT 0,
  `apply_vat` tinyint(1) NOT NULL DEFAULT 0,
  `contingency` varchar(3) NOT NULL,
  `initial_payment` varchar(10) NOT NULL,
  `initial_payment_type` varchar(20) DEFAULT NULL COMMENT 'Fixed,Percentage',
  `project_start_date` date DEFAULT NULL,
  `total_time` varchar(10) NOT NULL,
  `total_time_type` varchar(10) NOT NULL,
  `terms_and_conditions` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `estimates`
--

INSERT INTO `estimates` (`id`, `project_id`, `tradesperson_id`, `project_awarded`, `describe_mode`, `unable_to_describe_type`, `more_info`, `covers_customers_all_needs`, `payment_required_upfront`, `apply_vat`, `contingency`, `initial_payment`, `initial_payment_type`, `project_start_date`, `total_time`, `total_time_type`, `terms_and_conditions`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 2, 0, 'Fully_describe', NULL, NULL, 1, 0, 1, '20', '15', NULL, '2023-05-31', '40', 'Hours', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius sapiente libero repudiandae architecto doloribus a, autem officiis ea minus. Corporis excepturi, culpa consectetur a maiores quibusdam temporibus unde placeat repudiandae officiis eveniet. Voluptatibus sed eius, provident dignissimos esse harum ad culpa, aliquid minus beatae necessitatibus, hic cumque molestiae sapiente.', NULL, NULL, NULL),
(2, 3, 6, 1, 'Fully_describe', NULL, NULL, 1, 0, 0, '12', '20', NULL, '2023-06-08', '50', 'Hours', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores laudantium quo soluta et odio libero! Dolores fuga, nemo doloribus deserunt repellendus expedita. Iusto doloremque necessitatibus autem aspernatur excepturi laborum consectetur consequatur ab. Corrupti fuga, nam voluptatum assumenda cum ducimus fugit ratione nulla vero at. Id sed, aut facere officia accusamus nisi fugit eligendi, architecto maiores doloremque excepturi eum minus voluptates iure sequi? Repellat beatae rerum, optio necessitatibus harum eos tenetur.', NULL, NULL, NULL),
(4, 9, 6, 1, 'Fully_describe', NULL, NULL, 1, 0, 1, '12', '50', NULL, '2023-06-08', '50', 'Hours', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores laudantium quo soluta et odio libero! Dolores fuga, nemo doloribus deserunt repellendus expedita. Iusto doloremque necessitatibus autem aspernatur excepturi laborum consectetur consequatur ab. Corrupti fuga, nam voluptatum assumenda cum ducimus fugit ratione nulla vero at. Id sed, aut facere officia accusamus nisi fugit eligendi, architecto maiores doloremque excepturi eum minus voluptates iure sequi? Repellat beatae rerum, optio necessitatibus harum eos tenetur.', NULL, NULL, NULL),
(6, 10, 6, 1, 'Fully_describe', NULL, NULL, 1, 0, 1, '12', '50', NULL, '2023-06-08', '50', 'Hours', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores laudantium quo soluta et odio libero! Dolores fuga, nemo doloribus deserunt repellendus expedita. Iusto doloremque necessitatibus autem aspernatur excepturi laborum consectetur consequatur ab. Corrupti fuga, nam voluptatum assumenda cum ducimus fugit ratione nulla vero at. Id sed, aut facere officia accusamus nisi fugit eligendi, architecto maiores doloremque excepturi eum minus voluptates iure sequi? Repellat beatae rerum, optio necessitatibus harum eos tenetur.', NULL, NULL, NULL),
(7, 10, 2, 0, 'Fully_describe', NULL, NULL, 1, 0, 1, '12', '50', NULL, '2023-06-08', '50', 'Hours', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores laudantium quo soluta et odio libero! Dolores fuga, nemo doloribus deserunt repellendus expedita. Iusto doloremque necessitatibus autem aspernatur excepturi laborum consectetur consequatur ab. Corrupti fuga, nam voluptatum assumenda cum ducimus fugit ratione nulla vero at. Id sed, aut facere officia accusamus nisi fugit eligendi, architecto maiores doloremque excepturi eum minus voluptates iure sequi? Repellat beatae rerum, optio necessitatibus harum eos tenetur.', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_12_31_065159_create_admins_table', 1),
(6, '2023_01_30_050935_create_customers_table', 1),
(7, '2023_02_04_064709_create_trader_details_table', 1),
(8, '2023_02_04_070125_create_work_types_table', 1),
(9, '2023_02_04_070239_create_sub_work_types_table', 1),
(10, '2023_02_04_070456_create_area_covers_table', 1),
(11, '2023_02_04_070541_create_sub_area_covers_table', 1),
(12, '2023_02_04_080645_alter_registration_status_to_users', 1),
(13, '2023_02_05_154822_create_projects_table', 1),
(14, '2023_02_05_154823_create_projectaddresses_table', 1),
(15, '2023_02_05_154935_create_projectfiles_table', 1),
(16, '2023_02_05_155006_create_tempmedia_table', 1),
(17, '2023_03_02_054847_create_buildercategories_table', 1),
(18, '2023_03_02_055424_create_buildersubcategories_table', 1),
(19, '2023_03_27_102609_create_projectnotesandcommends_table', 1),
(20, '2023_04_10_141146_create_traderworks_table', 1),
(21, '2023_04_10_141534_create_traderareas_table', 1),
(22, '2023_04_12_081554_create_cms_table', 1),
(23, '2023_04_26_135552_create_terms_table', 1),
(24, '2023_05_09_094547_create_cookies_table', 1),
(25, '2023_05_09_114023_create_notifications_table', 1),
(26, '2023_05_10_052559_create_users_verify_table', 1),
(33, '2023_05_29_100548_create_estimates_table', 2),
(34, '2023_05_29_103305_create_tasks_table', 2),
(35, '2023_05_29_103804_create_project_estimate_files_table', 2),
(36, '2023_05_30_061130_create_project_reviews_table', 3),
(38, '2023_06_09_095935_create_tradesperson_files_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`settings`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `settings`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, '{\"reviewed\":\"0\",\"paused\":\"0\",\"project_milestone_complete\":\"0\",\"project_complete\":\"0\",\"project_new_message\":\"0\"}', '2023-05-18 00:53:36', '2023-05-18 00:53:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projectaddresses`
--

CREATE TABLE `projectaddresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `address_line_one` varchar(255) DEFAULT NULL,
  `address_line_two` varchar(255) DEFAULT NULL,
  `town_city` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projectaddresses`
--

INSERT INTO `projectaddresses` (`id`, `project_id`, `address_line_one`, `address_line_two`, `town_city`, `postcode`, `created_at`, `updated_at`) VALUES
(1, 1, '6Burgerz', 'Thames Road', 'Barking', 'England', '2023-05-19 02:24:23', '2023-05-19 02:24:23'),
(2, 2, 'Ace Wound Products', 'Unit 1f-1g', 'Barking', 'England', '2023-05-19 04:50:45', '2023-05-19 04:50:45'),
(3, 3, 'Blind Galleries Uk', 'Unit 6g', 'Barking', 'England', '2023-05-19 04:51:41', '2023-05-19 04:51:41'),
(4, 4, 'Bml Bs Itorizin Ltd', 'Unit 9C', 'Barking', 'England', '2023-05-19 04:52:28', '2023-05-19 04:52:28'),
(5, 5, 'Home & Away', 'Unit 1e', 'Barking', 'England', '2023-05-19 04:53:49', '2023-05-19 04:53:49'),
(6, 6, 'Riverside Doner House', '25 Thames Road', 'Barking, England', 'ig11 0jp', '2023-05-26 05:31:32', '2023-05-26 05:31:32'),
(7, 7, 'Bml World Ltd', 'Unit 9C Barking Business Centre', 'Barking, England', 'ig11 0jp', '2023-05-26 08:44:01', '2023-05-26 08:44:01'),
(8, 8, 'Bml Bs Itorizin Ltd', 'Unit 9C', 'Barking, England', 'ig11 0jp', '2023-05-29 08:21:31', '2023-05-29 08:21:31');

-- --------------------------------------------------------

--
-- Table structure for table `projectfiles`
--

CREATE TABLE `projectfiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `file_type` varchar(10) NOT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `file_original_name` varchar(255) DEFAULT NULL,
  `file_extension` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projectfiles`
--

INSERT INTO `projectfiles` (`id`, `project_id`, `file_type`, `filename`, `file_original_name`, `file_extension`, `url`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'image', '64672b0bde2a7.png', NULL, 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/64672b0bde2a7.png', '2023-05-19 02:24:23', '2023-05-19 02:24:23', NULL),
(2, 2, 'Document', 'bird_2.jpg', NULL, 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_2.jpg', '2023-05-19 04:50:45', '2023-05-19 04:50:45', NULL),
(3, 3, 'Document', 'user.png', NULL, 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/user.png', '2023-05-19 04:51:41', '2023-05-19 04:51:41', NULL),
(4, 4, 'image', 'sita-denis-8RKnsIiH4HM-unsplash.jpg', NULL, 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_2.jpg', '2023-05-19 04:52:28', '2023-05-19 04:52:28', NULL),
(5, 1, 'image', 'bird_2.jpg', NULL, 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_2.jpg', '2023-05-19 04:53:49', '2023-05-19 04:53:49', NULL),
(6, 1, 'video', 'pexels-roman-odintsov-5667416-426x226-30fps.mp4', NULL, 'mp4', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/pexels-roman-odintsov-5667416-426x226-30fps.mp4', '2023-05-26 05:31:33', '2023-05-26 05:31:33', NULL),
(7, 2, 'video', 'pexels-roman-odintsov-5667416-426x226-30fps.mp4', NULL, 'mp4', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/pexels-roman-odintsov-5667416-426x226-30fps.mp4', '2023-05-26 05:31:33', '2023-05-26 05:31:33', NULL),
(8, 1, 'video', 'pexels-erhan-dayı-14058189-426x240-24fps.mp4', NULL, 'mp4', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/pexels-erhan-day%C4%B1-14058189-426x240-24fps.mp4', '2023-05-26 08:44:01', '2023-05-26 08:44:01', NULL),
(9, 8, 'Document', 'pexels-erhan-dayı-14058189-426x240-24fps.mp4', NULL, 'mp4', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/pexels-erhan-day%C4%B1-14058189-426x240-24fps.mp4', '2023-05-29 08:21:31', '2023-05-29 08:21:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projectnotesandcommends`
--

CREATE TABLE `projectnotesandcommends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reviewer_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `notes_for` varchar(255) DEFAULT NULL,
  `notes` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projectnotesandcommends`
--

INSERT INTO `projectnotesandcommends` (`id`, `reviewer_id`, `project_id`, `notes_for`, `notes`, `created_at`, `updated_at`) VALUES
(4, 2, 1, 'internal', 'sdhsgda', '2023-05-19 04:00:15', '2023-05-19 04:00:15'),
(5, 2, 1, 'customer', 'asdasd', '2023-05-19 04:00:15', '2023-05-19 04:00:15'),
(6, 2, 1, 'tradespeople', 'dfsds', '2023-05-19 04:00:15', '2023-05-19 04:00:15');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `builder_category_id` varchar(255) DEFAULT NULL,
  `builder_subcategory_id` varchar(255) DEFAULT NULL,
  `forename` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `contact_mobile_no` varchar(255) DEFAULT NULL,
  `contact_home_phone` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `categories` varchar(255) DEFAULT NULL,
  `subcategories` varchar(255) DEFAULT NULL,
  `status` enum('submitted_for_review','returned_for_review','estimation','project_started','awaiting_your_review') NOT NULL DEFAULT 'submitted_for_review',
  `reviewer_status` varchar(255) DEFAULT NULL,
  `reviewer_status_updated_at` datetime DEFAULT NULL,
  `notes` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `user_id`, `builder_category_id`, `builder_subcategory_id`, `forename`, `surname`, `project_name`, `description`, `contact_mobile_no`, `contact_home_phone`, `contact_email`, `categories`, `subcategories`, `status`, `reviewer_status`, `reviewer_status_updated_at`, `notes`, `created_at`, `updated_at`) VALUES
(1, 5, NULL, NULL, 'asadsa', 'sdasa', 'asdasdasa', '<p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet. Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>\n                                 \n                                    <p>1. Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. </p>\n                                    <p>2. Amet minim mollit non deserunt ullamco amet sint. </p>\n                                    <p>3. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>', '1234567890', '1234567890', 'sankalan0@gmail.com', '1,2', '3,7', 'submitted_for_review', 'Approve', NULL, NULL, '2023-05-19 02:24:23', '2023-05-19 04:00:27'),
(2, 5, NULL, NULL, 'as', 'sa', 'sa', '<p>sa</p>', '1234567890', '1234567890', 'sankalan0@gmail.com', NULL, NULL, 'returned_for_review', NULL, NULL, NULL, '2023-05-19 04:50:45', '2023-05-19 04:50:45'),
(3, 5, NULL, NULL, 'ss', 'ds', 'fd', '<p>sdf</p>', '1234567890', '1234567890', 'sankalan0@gmail.com', NULL, NULL, 'estimation', NULL, NULL, NULL, '2023-05-19 04:51:41', '2023-05-19 04:51:41'),
(4, 5, NULL, NULL, 'gh', 'hg', 'dd', '<p>sd</p>', '1234567890', '1234567890', 'sankalan0@gmail.com', NULL, NULL, 'project_started', NULL, NULL, NULL, '2023-05-19 04:52:28', '2023-05-19 04:52:28'),
(5, 5, NULL, NULL, 'gf', 'df', 'fd', '<p>asdf</p>', '1234567890', '1234567890', 'sankalan0@gmail.com', NULL, NULL, 'awaiting_your_review', NULL, NULL, NULL, '2023-05-19 04:53:49', '2023-05-19 04:53:49'),
(6, 5, NULL, NULL, 'Video', 'Upload', 'Video Upload', '<p>Uploaded Video</p>', '1234567890', '1234567890', 'sankalan0@gmail.com', NULL, NULL, 'submitted_for_review', NULL, NULL, NULL, '2023-05-26 05:31:32', '2023-05-26 05:31:32'),
(7, 5, NULL, NULL, 'Video', 'Upload_2', 'Video Upload_2', '<p><b>Video Upload_2</b><br></p>', '1234567890', '1234567890', 'sankalan0@gmail.com', NULL, NULL, 'submitted_for_review', NULL, NULL, NULL, '2023-05-26 08:44:01', '2023-05-26 08:44:01'),
(8, 5, NULL, NULL, 'Proj', 'Comp', 'Proj_Comp', '<p>Proj Has Been Completed.</p>', '1234567890', '1234567890', 'sankalan0@gmail.com', NULL, NULL, 'awaiting_your_review', NULL, NULL, NULL, '2023-05-29 08:21:31', '2023-05-29 08:21:31'),
(9, 5, NULL, NULL, 'Proj', 'Comp2', 'Proj_Comp2', '<p>Proj Has Been Completed.</p>', '1234567890', '1234567890', 'sankalan0@gmail.com', NULL, NULL, 'awaiting_your_review', NULL, NULL, NULL, '2023-05-29 08:21:31', '2023-05-29 08:21:31'),
(10, 1, NULL, NULL, 'Proj', 'Comp3', 'Proj_Comp3', '<p>Proj Has Been Completed.3</p>', '1234567890', '1234567890', 'biswajitmaityniit@gmail.com', NULL, NULL, 'awaiting_your_review', NULL, NULL, NULL, '2023-05-29 08:21:31', '2023-05-29 08:21:31'),
(11, 1, NULL, NULL, 'Proj', 'Comp4', 'Proj_Comp4', '<p>Proj Has Been Completed. 4</p>', '1234567890', '1234567890', 'biswajitmaityniit@gmail.com', NULL, NULL, 'awaiting_your_review', NULL, NULL, NULL, '2023-05-29 08:21:31', '2023-05-29 08:21:31');

-- --------------------------------------------------------

--
-- Table structure for table `project_estimate_files`
--

CREATE TABLE `project_estimate_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `estimate_id` bigint(20) UNSIGNED NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_original_name` varchar(255) NOT NULL,
  `file_extension` varchar(10) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_reviews`
--

CREATE TABLE `project_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `tradesperson_id` bigint(20) UNSIGNED NOT NULL,
  `punctuality` tinyint(4) NOT NULL,
  `workmanship` tinyint(4) NOT NULL,
  `tidiness` tinyint(4) NOT NULL,
  `price_accuracy` tinyint(4) NOT NULL,
  `detailed_review` tinyint(4) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_reviews`
--

INSERT INTO `project_reviews` (`id`, `user_id`, `project_id`, `tradesperson_id`, `punctuality`, `workmanship`, `tidiness`, `price_accuracy`, `detailed_review`, `description`, `created_at`, `updated_at`) VALUES
(1, 5, 9, 6, 1, 2, 1, 0, 0, NULL, NULL, NULL),
(2, 1, 10, 6, 0, 2, 1, 1, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_area_covers`
--

CREATE TABLE `sub_area_covers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `area_type_id` bigint(20) UNSIGNED NOT NULL,
  `sub_area_type` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_area_covers`
--

INSERT INTO `sub_area_covers` (`id`, `area_type_id`, `sub_area_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Abergeldie', 1, NULL, NULL),
(2, 1, 'Aboyne', 1, NULL, NULL),
(3, 1, 'Affleck', 1, NULL, NULL),
(4, 2, 'Aberlemno', 1, NULL, NULL),
(5, 3, 'Acha', 1, NULL, NULL),
(6, 3, 'Achahoish', 1, NULL, NULL),
(7, 3, 'Achaleven', 1, NULL, NULL),
(8, 3, 'Achanelid', 1, NULL, NULL),
(9, 3, 'Achleck', 1, NULL, NULL),
(10, 3, 'Achlonan', 1, NULL, NULL),
(11, 3, 'Achnacroish', 1, NULL, NULL),
(12, 3, 'Achnagoul', 1, NULL, NULL),
(13, 3, 'Achnahard', 1, NULL, NULL),
(14, 3, 'Achnamara', 1, NULL, NULL),
(15, 3, 'Aird', 1, NULL, NULL),
(16, 3, 'Airds', 1, NULL, NULL),
(17, 3, 'Airds Bay', 1, NULL, NULL),
(18, 4, 'Afton Bridgend', 1, NULL, NULL),
(19, 5, 'Aberchirder', 1, NULL, NULL),
(20, 6, 'Achalone', 1, NULL, NULL),
(21, 6, 'Achastle', 1, NULL, NULL),
(22, 6, 'Achavanich', 1, NULL, NULL),
(23, 6, 'Achavar', 1, NULL, NULL),
(24, 6, 'Achingills', 1, NULL, NULL),
(25, 6, 'Achnavast', 1, NULL, NULL),
(26, 6, 'Achow', 1, NULL, NULL),
(27, 6, 'Achreamie', 1, NULL, NULL),
(28, 6, 'Achscrabster', 1, NULL, NULL),
(29, 6, 'Ackergill', 1, NULL, NULL),
(30, 6, 'Ackergillshore', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_work_types`
--

CREATE TABLE `sub_work_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `work_type_id` bigint(20) UNSIGNED NOT NULL,
  `sub_work_type` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_work_types`
--

INSERT INTO `sub_work_types` (`id`, `work_type_id`, `sub_work_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Architraves', 1, '2023-05-18 00:34:53', '2023-05-18 00:34:53'),
(2, 1, 'Barn Conversions', 1, '2023-05-18 00:34:53', '2023-05-18 00:34:53'),
(3, 1, 'Cupboards', 1, '2023-05-18 00:34:53', '2023-05-18 00:34:53'),
(4, 2, 'Skirting', 1, '2023-05-18 00:34:53', '2023-05-18 00:34:53'),
(5, 2, 'Staircases', 1, '2023-05-18 00:34:53', '2023-05-18 00:34:53'),
(6, 2, 'Truss Roofing', 1, '2023-05-18 00:34:53', '2023-05-18 00:34:53'),
(7, 3, 'Bespoke Furniture', 1, '2023-05-18 00:34:53', '2023-05-18 00:34:53'),
(8, 3, 'Bespoke Windows / Doors', 1, '2023-05-18 00:34:53', '2023-05-18 00:34:53'),
(9, 3, 'Cupboards', 1, '2023-05-18 00:34:53', '2023-05-18 00:34:53');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `estimate_id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `price` double(10,2) DEFAULT NULL,
  `contingency` double(10,2) DEFAULT NULL,
  `max_contingency` double(10,2) DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `payment_type` varchar(20) DEFAULT NULL,
  `payment_transaction_id` varchar(30) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `estimate_id`, `description`, `price`, `contingency`, `max_contingency`, `payment_status`, `status`, `payment_type`, `payment_transaction_id`, `payment_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores laudantium quo soluta et odio libero! Dolores fuga, nemo doloribus deserunt repellendus expedita. Iusto doloremque necessitatibus autem aspernatur excepturi laborum consectetur consequatur ab. Corrupti fuga, nam voluptatum assumenda cum ducimus fugit ratione nulla vero at. Id sed, aut facere officia accusamus nisi fugit eligendi, architecto maiores doloremque excepturi eum minus voluptates iure sequi? Repellat beatae rerum, optio necessitatibus harum eos tenetur.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius sapiente libero repudiandae architecto doloribus a, autem officiis ea minus. Corporis excepturi, culpa consectetur a maiores quibusdam temporibus unde placeat repudiandae officiis eveniet. Voluptatibus sed eius, provident dignissimos esse harum ad culpa, aliquid minus beatae necessitatibus, hic cumque molestiae sapiente.', 1500.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores laudantium quo soluta et odio libero! Dolores fuga, nemo doloribus deserunt repellendus expedita. Iusto doloremque necessitatibus autem aspernatur excepturi laborum consectetur consequatur ab. Corrupti fuga, nam voluptatum assumenda cum ducimus fugit ratione nulla vero at. Id sed, aut facere officia accusamus nisi fugit eligendi, architecto maiores doloremque excepturi eum minus voluptates iure sequi? Repellat beatae rerum, optio necessitatibus harum eos tenetur.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius sapiente libero repudiandae architecto doloribus a, autem officiis ea minus. Corporis excepturi, culpa consectetur a maiores quibusdam temporibus unde placeat repudiandae officiis eveniet. Voluptatibus sed eius, provident dignissimos esse harum ad culpa, aliquid minus beatae necessitatibus, hic cumque molestiae sapiente.', 800.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius sapiente libero repudiandae architecto doloribus a, autem officiis ea minus. Corporis excepturi, culpa consectetur a maiores quibusdam temporibus unde placeat repudiandae officiis eveniet. Voluptatibus sed eius, provident dignissimos esse harum ad culpa, aliquid minus beatae necessitatibus, hic cumque molestiae sapiente.', 2000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius sapiente libero repudiandae architecto doloribus a, autem officiis ea minus. Corporis excepturi, culpa consectetur a maiores quibusdam temporibus unde placeat repudiandae officiis eveniet. Voluptatibus sed eius, provident dignissimos esse harum ad culpa, aliquid minus beatae necessitatibus, hic cumque molestiae sapiente.', 700.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 4, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius sapiente libero repudiandae architecto doloribus a, autem officiis ea minus. Corporis excepturi, culpa consectetur a maiores quibusdam temporibus unde placeat repudiandae officiis eveniet. Voluptatibus sed eius, provident dignissimos esse harum ad culpa, aliquid minus beatae necessitatibus, hic cumque molestiae sapiente.', 1200.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 4, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius sapiente libero repudiandae architecto doloribus a, autem officiis ea minus. Corporis excepturi, culpa consectetur a maiores quibusdam temporibus unde placeat repudiandae officiis eveniet. Voluptatibus sed eius, provident dignissimos esse harum ad culpa, aliquid minus beatae necessitatibus, hic cumque molestiae sapiente.', 800.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tempmedia`
--

CREATE TABLE `tempmedia` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `sessionid` varchar(255) DEFAULT NULL,
  `file_type` varchar(10) NOT NULL,
  `media_type` varchar(30) DEFAULT 'customer' COMMENT 'customer,tradesperson,project,null',
  `file_related_to` varchar(50) DEFAULT NULL COMMENT 'company_logo,public_liability_insurance,trader_img,company_address,team_img,prev_project_img',
  `file_original_name` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `file_extension` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `file_created_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tempmedia`
--

INSERT INTO `tempmedia` (`id`, `user_id`, `sessionid`, `file_type`, `media_type`, `file_related_to`, `file_original_name`, `filename`, `file_extension`, `url`, `file_created_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(29, 10, 'hTTMokactUMjRl5MNZOdYCxzP8Rr3i07bMB5Pj7r', 'image', 'tradesperson', 'team_img', NULL, 'Ultra hd! realistic.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/Ultra%20hd%21%20realistic_2023_06_13_11_50_12_5390.jpg', '2023-06-13', '2023-06-13 06:20:14', '2023-06-13 06:20:14', NULL),
(30, 10, 'hTTMokactUMjRl5MNZOdYCxzP8Rr3i07bMB5Pj7r', 'image', 'tradesperson', 'prev_project_img', NULL, 'user.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/user_2023_06_13_11_50_33_7830.png', '2023-06-13', '2023-06-13 06:20:34', '2023-06-13 06:20:34', NULL),
(31, 10, 'hTTMokactUMjRl5MNZOdYCxzP8Rr3i07bMB5Pj7r', 'image', 'tradesperson', 'prev_project_img', NULL, 'bird_1.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_1_2023_06_13_11_51_02_9327.jpg', '2023-06-13', '2023-06-13 06:21:04', '2023-06-13 06:21:04', NULL),
(84, 10, 'efItnYrbJCYb6sXsNDGFfomS0LiYQmuzEBiPz8CD', 'image', 'tradesperson', 'public_liability_insurance', NULL, 'bird_1.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_1_2023_06_16_12_16_00_1177.jpg', '2023-06-16', '2023-06-16 06:46:01', '2023-06-16 06:46:01', NULL),
(87, 9, '3wuBqvvsCR7RfcsJPVQNbop5JxY00DGWJsA4qlfT', 'image', 'tradesperson', 'public_liability_insurance', NULL, 'user.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/user_2023_06_19_12_11_28_8480.png', '2023-06-19', '2023-06-19 06:41:29', '2023-06-19 06:41:29', NULL),
(88, 9, '3wuBqvvsCR7RfcsJPVQNbop5JxY00DGWJsA4qlfT', 'image', 'tradesperson', 'company_logo', NULL, 'sammy-line-online-meeting.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/sammy-line-online-meeting_2023_06_19_12_12_13_2114.png', '2023-06-19', '2023-06-19 06:42:14', '2023-06-19 06:42:14', NULL),
(89, 9, '3wuBqvvsCR7RfcsJPVQNbop5JxY00DGWJsA4qlfT', 'image', 'tradesperson', 'company_address', NULL, 'user.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/user_2023_06_19_12_12_24_6075.png', '2023-06-19', '2023-06-19 06:42:24', '2023-06-19 06:42:24', NULL),
(90, 9, '3wuBqvvsCR7RfcsJPVQNbop5JxY00DGWJsA4qlfT', 'image', 'tradesperson', 'team_img', NULL, 'user.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/user_2023_06_19_12_12_34_1846.png', '2023-06-19', '2023-06-19 06:42:35', '2023-06-19 06:42:35', NULL),
(91, 9, '3wuBqvvsCR7RfcsJPVQNbop5JxY00DGWJsA4qlfT', 'image', 'tradesperson', 'prev_project_img', NULL, 'bird_2.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_2_2023_06_19_12_12_40_1505.jpg', '2023-06-19', '2023-06-19 06:42:42', '2023-06-19 06:42:42', NULL),
(92, 9, '3wuBqvvsCR7RfcsJPVQNbop5JxY00DGWJsA4qlfT', 'image', 'tradesperson', 'prev_project_img', NULL, 'bird_1.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_1_2023_06_19_12_12_42_2616.jpg', '2023-06-19', '2023-06-19 06:42:43', '2023-06-19 06:42:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `terms_order` int(11) NOT NULL,
  `terms_description` longtext DEFAULT NULL,
  `status` enum('Active','InActive') NOT NULL DEFAULT 'Active' COMMENT 'Active,InActive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `traderareas`
--

CREATE TABLE `traderareas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `sub_area_cover_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `traderareas`
--

INSERT INTO `traderareas` (`id`, `user_id`, `sub_area_cover_id`, `created_at`, `updated_at`) VALUES
(25, 10, 1, '2023-06-16 04:09:31', '2023-06-16 04:09:31'),
(26, 10, 3, '2023-06-16 04:09:31', '2023-06-16 04:09:31'),
(27, 10, 18, '2023-06-16 04:09:31', '2023-06-16 04:09:31'),
(28, 9, 3, '2023-06-19 06:33:07', '2023-06-19 06:33:07');

-- --------------------------------------------------------

--
-- Table structure for table `traderworks`
--

CREATE TABLE `traderworks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `buildersubcategory_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `traderworks`
--

INSERT INTO `traderworks` (`id`, `user_id`, `buildersubcategory_id`, `created_at`, `updated_at`) VALUES
(38, 10, 1, '2023-06-16 04:09:31', '2023-06-16 04:09:31'),
(39, 10, 3, '2023-06-16 04:09:31', '2023-06-16 04:09:31'),
(40, 10, 43, '2023-06-16 04:09:31', '2023-06-16 04:09:31'),
(41, 10, 44, '2023-06-16 04:09:31', '2023-06-16 04:09:31'),
(42, 9, 1, '2023-06-19 06:33:07', '2023-06-19 06:33:07');

-- --------------------------------------------------------

--
-- Table structure for table `trader_details`
--

CREATE TABLE `trader_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comp_reg_no` varchar(255) DEFAULT NULL,
  `txt_comp_name` varchar(255) DEFAULT NULL,
  `comp_name` varchar(255) DEFAULT NULL,
  `comp_address` text DEFAULT NULL,
  `trader_name` varchar(255) DEFAULT NULL,
  `comp_description` longtext DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone_code` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `phone_office` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `company_role` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `vat_reg` tinyint(1) DEFAULT NULL,
  `vat_no` varchar(255) DEFAULT NULL,
  `vat_comp_name` varchar(255) DEFAULT NULL,
  `vat_comp_address` text DEFAULT NULL,
  `contingency` double(8,2) DEFAULT NULL,
  `bnk_account_type` varchar(255) DEFAULT NULL,
  `bnk_account_name` varchar(255) DEFAULT NULL,
  `bnk_sort_code` varchar(255) DEFAULT NULL,
  `bnk_account_number` varchar(255) DEFAULT NULL,
  `builder_amendment` tinyint(1) NOT NULL DEFAULT 0,
  `email_notification` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`email_notification`)),
  `insurance_policy_name` varchar(255) DEFAULT NULL,
  `insurance_policy_exp_date` date DEFAULT NULL,
  `approval_status` varchar(20) NOT NULL DEFAULT 'Pending' COMMENT 'Pending,Rejected,Approved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trader_details`
--

INSERT INTO `trader_details` (`id`, `user_id`, `comp_reg_no`, `txt_comp_name`, `comp_name`, `comp_address`, `trader_name`, `comp_description`, `name`, `phone_code`, `phone_number`, `phone_office`, `email`, `company_role`, `designation`, `vat_reg`, `vat_no`, `vat_comp_name`, `vat_comp_address`, `contingency`, `bnk_account_type`, `bnk_account_name`, `bnk_sort_code`, `bnk_account_number`, `builder_amendment`, `email_notification`, `insurance_policy_name`, `insurance_policy_exp_date`, `approval_status`, `created_at`, `updated_at`) VALUES
(1, 10, '14494825', NULL, 'FIX MY BUILD LTD', '88 Riverside Drive, Mitcham, England, CR4 4BW', 'FIX MY BUILD LTD', '<p>Hello World!!</p>', 'FIX MY BUILD', 'bs', '8765432344', '8765432344', 'admin@gil.com', 'Other', 'Trader', 1, 'GB434733202', 'FIX MY BUILD LTD', '88 RIVERSIDE DRIVE, MITCHAM, CR4 4BW', 20.00, 'Personal', 'Fix My Builds', '12342', '1243422', 0, NULL, NULL, NULL, 'Rejected', '2023-06-16 04:07:48', '2023-06-20 03:25:31'),
(4, 9, '14494824', NULL, 'FIX MY BUILD LTD', '88 Riverside Drive, Mitcham, England, CR4 4BW', 'FIX MY BUILD', '<p><b>!!Hello World!!</b></p>', 'FIX MY BUILD', 'gb', '8765432344', '8765432344', 'admin@gil.com', 'Other', 'Trader', 1, 'GB434733202', 'FIX MY BUILD LTD', '88 RIVERSIDE DRIVE, MITCHAM, CR4 4BW', 25.00, 'Personal', 'Fix My Build', '1234', '1243423', 1, '{\"new_quotes\":\"1\",\"quote_accepted\":\"1\",\"project_stopped\":\"1\",\"quote_rejected\":\"1\",\"project_cancelled\":\"1\"}', NULL, NULL, 'Pending', '2023-06-19 06:42:54', '2023-06-19 06:45:41');

-- --------------------------------------------------------

--
-- Table structure for table `tradesperson_files`
--

CREATE TABLE `tradesperson_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tradesperson_id` bigint(20) UNSIGNED NOT NULL,
  `file_related_to` varchar(50) NOT NULL COMMENT 'company_logo,public_liability_insurance,trader_img,company_address,team_img,prev_project_img',
  `file_type` varchar(10) NOT NULL COMMENT 'document,image',
  `file_name` varchar(255) NOT NULL,
  `file_extension` varchar(10) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tradesperson_files`
--

INSERT INTO `tradesperson_files` (`id`, `tradesperson_id`, `file_related_to`, `file_type`, `file_name`, `file_extension`, `url`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 10, 'company_logo', 'image', 'Ultra hd! realistic.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/Ultra%20hd%21%20realistic_2023_06_15_14_15_43_3106.jpg', '2023-06-15 08:47:03', '2023-06-15 08:52:29', '2023-06-15 08:52:29'),
(2, 10, 'public_liability_insurance', 'image', 'bird_1.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_1_2023_06_15_14_15_56_3147.jpg', '2023-06-15 08:47:03', '2023-06-16 06:19:08', '2023-06-16 06:19:08'),
(3, 10, 'trader_img', 'image', 'bird_2.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_2_2023_06_15_14_16_20_5867.jpg', '2023-06-15 08:47:03', '2023-06-15 08:47:03', '2023-06-15 08:47:03'),
(4, 10, 'company_address', 'image', 'user.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/user_2023_06_15_14_16_29_7117.png', '2023-06-15 08:47:03', '2023-06-15 08:47:03', '2023-06-15 08:47:03'),
(5, 10, 'team_img', 'image', 'Ultra hd! realistic.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/Ultra%20hd%21%20realistic_2023_06_15_14_16_38_7317.jpg', '2023-06-15 08:47:03', '2023-06-16 05:36:19', NULL),
(6, 10, 'prev_project_img', 'image', 'bird_1.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_1_2023_06_15_14_16_44_2994.jpg', '2023-06-15 08:47:03', '2023-06-15 08:47:03', NULL),
(7, 10, 'prev_project_img', 'image', 'bird_2.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_2_2023_06_15_14_16_46_3295.jpg', '2023-06-15 08:47:03', '2023-06-16 05:55:49', '2023-06-16 05:55:49'),
(8, 10, 'prev_project_img', 'image', 'user.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/user_2023_06_15_14_16_48_6958.png', '2023-06-15 08:47:03', '2023-06-16 05:54:56', '2023-06-16 05:54:56'),
(9, 10, 'company_logo', 'image', 'Earphone-PNG-Cutout.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/Earphone-PNG-Cutout_2023_06_15_14_19_11_3232.png', '2023-06-15 08:50:17', '2023-06-15 08:52:29', '2023-06-15 08:52:29'),
(10, 10, 'company_logo', 'image', 'Earphone-PNG-Cutout.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/Earphone-PNG-Cutout_2023_06_15_14_19_11_3232.png', '2023-06-15 08:50:48', '2023-06-15 08:52:29', '2023-06-15 08:52:29'),
(11, 10, 'company_logo', 'image', 'Earphone-PNG-Cutout.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/Earphone-PNG-Cutout_2023_06_15_14_19_11_3232.png', '2023-06-15 08:51:45', '2023-06-15 08:52:29', '2023-06-15 08:52:29'),
(12, 10, 'company_logo', 'image', 'Earphone-PNG-Cutout.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/Earphone-PNG-Cutout_2023_06_15_14_19_11_3232.png', '2023-06-15 08:52:29', '2023-06-15 08:57:59', '2023-06-15 08:57:59'),
(13, 10, 'company_logo', 'image', 'david-clode-M-ieI7e9rwg-unsplash (1).jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/david-clode-M-ieI7e9rwg-unsplash%20%281%29_2023_06_15_14_26_45_8224.jpg', '2023-06-15 08:57:59', '2023-06-16 01:05:06', '2023-06-16 01:05:06'),
(14, 10, 'public_liability_insurance', 'image', 'david-clode-tv1qF5LkUnQ-unsplash.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/david-clode-tv1qF5LkUnQ-unsplash_2023_06_15_14_26_53_1453.jpg', '2023-06-15 08:57:59', '2023-06-15 08:57:59', NULL),
(15, 10, 'trader_img', 'image', 'sammy-line-online-meeting.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/sammy-line-online-meeting_2023_06_15_14_27_11_3693.png', '2023-06-15 08:57:59', '2023-06-15 08:57:59', NULL),
(16, 10, 'company_address', 'image', 'bird_1.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_1_2023_06_15_14_27_26_9350.jpg', '2023-06-15 08:57:59', '2023-06-15 08:57:59', NULL),
(17, 10, 'team_img', 'image', 'bird_1.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_1_2023_06_15_14_27_37_9717.jpg', '2023-06-15 08:57:59', '2023-06-16 05:36:02', NULL),
(18, 10, 'team_img', 'image', 'bird_2.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_2_2023_06_15_14_27_43_6082.jpg', '2023-06-15 08:57:59', '2023-06-16 05:54:30', '2023-06-16 05:54:30'),
(19, 10, 'prev_project_img', 'image', 'sammy-line-online-meeting.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/sammy-line-online-meeting_2023_06_15_14_27_47_5603.png', '2023-06-15 08:57:59', '2023-06-16 05:54:33', '2023-06-16 05:54:33'),
(20, 10, 'prev_project_img', 'image', 'Ultra hd! realistic.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/Ultra%20hd%21%20realistic_2023_06_15_14_27_49_8525.jpg', '2023-06-15 08:57:59', '2023-06-16 05:37:19', '2023-06-16 05:37:19'),
(21, 10, 'company_logo', 'image', 'Ultra hd! realistic.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/Ultra%20hd%21%20realistic_2023_06_16_06_35_04_2356.jpg', '2023-06-16 01:05:06', '2023-06-16 01:12:34', '2023-06-16 01:12:34'),
(22, 10, 'company_logo', 'image', 'bird_1.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_1_2023_06_16_06_42_33_6905.jpg', '2023-06-16 01:12:34', '2023-06-16 02:19:51', '2023-06-16 02:19:51'),
(23, 10, 'company_logo', 'image', 'Ultra hd! realistic.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/Ultra%20hd%21%20realistic_2023_06_16_07_49_47_6131.jpg', '2023-06-16 02:19:51', '2023-06-16 02:19:51', NULL),
(24, 10, 'public_liability_insurance', 'document', 'bird_2.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_2_2023_06_16_12_50_28_2646.jpg', '2023-06-16 07:20:30', '2023-06-16 08:02:07', '2023-06-16 08:02:07'),
(25, 10, 'team_img', 'image', 'bird_2.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_2_2023_06_16_12_55_35_9384.jpg', '2023-06-16 07:25:36', '2023-06-16 07:25:36', NULL),
(26, 10, 'team_img', 'image', 'bird_1.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_1_2023_06_16_12_55_36_2717.jpg', '2023-06-16 07:25:38', '2023-06-16 07:49:26', '2023-06-16 07:49:26'),
(27, 10, 'team_img', 'image', 'user.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/user_2023_06_16_12_55_38_9423.png', '2023-06-16 07:25:39', '2023-06-16 07:49:23', '2023-06-16 07:49:23'),
(28, 10, 'team_img', 'image', 'sammy-line-online-meeting.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/sammy-line-online-meeting_2023_06_16_12_57_07_8892.png', '2023-06-16 07:27:09', '2023-06-16 07:49:21', '2023-06-16 07:49:21'),
(29, 10, 'team_img', 'image', 'Ultra hd! realistic.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/Ultra%20hd%21%20realistic_2023_06_16_12_57_09_4944.jpg', '2023-06-16 07:27:11', '2023-06-16 07:49:18', '2023-06-16 07:49:18'),
(30, 10, 'team_img', 'image', 'user.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/user_2023_06_16_13_06_43_8840.png', '2023-06-16 07:36:47', '2023-06-16 07:49:16', '2023-06-16 07:49:16'),
(31, 10, 'team_img', 'image', 'sammy-line-online-meeting.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/sammy-line-online-meeting_2023_06_16_13_08_52_8891.png', '2023-06-16 07:38:53', '2023-06-16 07:49:14', '2023-06-16 07:49:14'),
(32, 10, 'team_img', 'image', 'Ultra hd! realistic.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/Ultra%20hd%21%20realistic_2023_06_16_13_10_09_9433.jpg', '2023-06-16 07:40:11', '2023-06-16 07:49:11', '2023-06-16 07:49:11'),
(33, 10, 'team_img', 'image', 'Earphone-PNG-Cutout.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/Earphone-PNG-Cutout_2023_06_16_13_10_29_1111.png', '2023-06-16 07:40:31', '2023-06-16 07:40:44', '2023-06-16 07:40:44'),
(34, 10, 'team_img', 'image', 'Earphone-PNG-Cutout.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/Earphone-PNG-Cutout_2023_06_16_13_11_20_9667.png', '2023-06-16 07:41:22', '2023-06-16 07:49:09', '2023-06-16 07:49:09'),
(35, 10, 'team_img', 'image', 'sammy-line-online-meeting.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/sammy-line-online-meeting_2023_06_16_13_19_40_2832.png', '2023-06-16 07:49:41', '2023-06-16 07:50:46', '2023-06-16 07:50:46'),
(36, 10, 'team_img', 'image', 'bird_1.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_1_2023_06_16_13_19_41_9922.jpg', '2023-06-16 07:49:42', '2023-06-16 07:56:05', '2023-06-16 07:56:05'),
(37, 10, 'team_img', 'image', 'Ultra hd! realistic.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/Ultra%20hd%21%20realistic_2023_06_16_13_19_43_9362.jpg', '2023-06-16 07:49:45', '2023-06-16 07:55:59', '2023-06-16 07:55:59'),
(38, 10, 'team_img', 'image', 'bird_2.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_2_2023_06_16_13_21_42_5501.jpg', '2023-06-16 07:51:44', '2023-06-16 07:56:01', '2023-06-16 07:56:01'),
(39, 10, 'team_img', 'image', 'bird_1.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_1_2023_06_16_13_21_44_6974.jpg', '2023-06-16 07:51:46', '2023-06-16 07:55:57', '2023-06-16 07:55:57'),
(40, 10, 'team_img', 'image', 'user.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/user_2023_06_16_13_21_46_8386.png', '2023-06-16 07:51:47', '2023-06-16 07:56:03', '2023-06-16 07:56:03'),
(41, 10, 'team_img', 'image', 'user.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/user_2023_06_16_13_23_04_5164.png', '2023-06-16 07:53:05', '2023-06-16 07:53:05', NULL),
(42, 10, 'team_img', 'image', 'sammy-line-online-meeting.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/sammy-line-online-meeting_2023_06_16_13_23_06_3500.png', '2023-06-16 07:53:07', '2023-06-16 07:55:54', '2023-06-16 07:55:54'),
(43, 10, 'team_img', 'image', 'Ultra hd! realistic.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/Ultra%20hd%21%20realistic_2023_06_16_13_23_07_2853.jpg', '2023-06-16 07:53:09', '2023-06-16 07:56:07', '2023-06-16 07:56:07'),
(44, 10, 'team_img', 'image', 'bird_1.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_1_2023_06_16_13_25_31_4176.jpg', '2023-06-16 07:55:32', '2023-06-16 07:56:09', '2023-06-16 07:56:09'),
(45, 10, 'team_img', 'image', 'bird_2.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_2_2023_06_16_13_25_33_5760.jpg', '2023-06-16 07:55:34', '2023-06-16 07:55:47', '2023-06-16 07:55:47'),
(46, 10, 'prev_project_img', 'image', 'bird_1.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_1_2023_06_16_13_30_56_3062.jpg', '2023-06-16 08:00:58', '2023-06-16 08:01:12', '2023-06-16 08:01:12'),
(47, 10, 'prev_project_img', 'image', 'bird_2.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_2_2023_06_16_13_30_58_2693.jpg', '2023-06-16 08:00:59', '2023-06-16 08:00:59', NULL),
(48, 10, 'prev_project_img', 'image', 'user.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/user_2023_06_16_13_30_59_1005.png', '2023-06-16 08:01:00', '2023-06-16 08:01:00', NULL),
(49, 10, 'prev_project_img', 'image', 'bird_2.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_2_2023_06_16_13_38_56_2277.jpg', '2023-06-16 08:08:57', '2023-06-16 08:08:57', NULL),
(50, 10, 'prev_project_img', 'image', 'sammy-line-online-meeting.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/sammy-line-online-meeting_2023_06_16_13_38_57_6195.png', '2023-06-16 08:08:58', '2023-06-16 08:08:58', NULL),
(51, 10, 'prev_project_img', 'image', 'Ultra hd! realistic.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/Ultra%20hd%21%20realistic_2023_06_16_13_38_58_2997.jpg', '2023-06-16 08:09:00', '2023-06-16 08:09:00', NULL),
(52, 10, 'prev_project_img', 'image', 'bird_2.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_2_2023_06_16_13_39_20_3873.jpg', '2023-06-16 08:09:21', '2023-06-16 08:09:34', '2023-06-16 08:09:34'),
(53, 10, 'prev_project_img', 'image', 'bird_1.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_1_2023_06_16_13_39_21_1811.jpg', '2023-06-16 08:09:23', '2023-06-16 08:09:23', NULL),
(54, 10, 'prev_project_img', 'image', 'user.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/user_2023_06_16_13_39_23_9637.png', '2023-06-16 08:09:24', '2023-06-16 08:09:24', NULL),
(55, 10, 'team_img', 'image', 'bird_1.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_1_2023_06_16_13_40_54_2643.jpg', '2023-06-16 08:10:55', '2023-06-16 08:10:55', NULL),
(56, 10, 'team_img', 'image', 'sammy-line-online-meeting.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/sammy-line-online-meeting_2023_06_16_13_40_56_7013.png', '2023-06-16 08:10:57', '2023-06-16 08:10:57', NULL),
(57, 10, 'team_img', 'image', 'Ultra hd! realistic.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/Ultra%20hd%21%20realistic_2023_06_16_13_40_57_1245.jpg', '2023-06-16 08:11:01', '2023-06-16 08:11:01', NULL),
(58, 10, 'public_liability_insurance', 'document', 'sammy-line-online-meeting.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/sammy-line-online-meeting_2023_06_16_13_41_33_5839.png', '2023-06-16 08:11:34', '2023-06-16 08:11:34', NULL),
(59, 10, 'public_liability_insurance', 'document', 'bird_2.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_2_2023_06_16_13_51_56_6448.jpg', '2023-06-16 08:21:57', '2023-06-16 08:23:07', '2023-06-16 08:23:07'),
(60, 10, 'public_liability_insurance', 'document', 'bird_1.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_1_2023_06_16_13_51_57_5846.jpg', '2023-06-16 08:21:59', '2023-06-16 08:23:04', '2023-06-16 08:23:04'),
(61, 10, 'public_liability_insurance', 'document', 'Ultra hd! realistic.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/Ultra%20hd%21%20realistic_2023_06_16_13_51_59_1610.jpg', '2023-06-16 08:22:01', '2023-06-16 08:23:02', '2023-06-16 08:23:02'),
(62, 10, 'public_liability_insurance', 'document', 'bird_1.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_1_2023_06_16_13_53_13_9826.jpg', '2023-06-16 08:23:15', '2023-06-16 08:23:15', NULL),
(63, 10, 'public_liability_insurance', 'document', 'bird_2.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_2_2023_06_16_13_53_15_8318.jpg', '2023-06-16 08:23:16', '2023-06-16 08:23:16', NULL),
(64, 10, 'public_liability_insurance', 'document', 'user.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/user_2023_06_16_13_53_16_9297.png', '2023-06-16 08:23:17', '2023-06-16 08:23:26', '2023-06-16 08:23:26'),
(65, 10, 'public_liability_insurance', 'document', 'user.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/user_2023_06_16_14_15_59_6277.png', '2023-06-16 08:46:00', '2023-06-16 08:46:09', '2023-06-16 08:46:09'),
(66, 10, 'public_liability_insurance', 'document', 'Ultra hd! realistic.jpg', 'jpg', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/Ultra%20hd%21%20realistic_2023_06_16_14_16_00_6500.jpg', '2023-06-16 08:46:02', '2023-06-16 08:46:02', NULL),
(67, 9, 'company_logo', 'image', 'sammy-line-online-meeting.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/sammy-line-online-meeting_2023_06_19_12_02_35_8984.png', '2023-06-19 06:33:07', '2023-06-19 06:33:07', NULL),
(68, 9, 'public_liability_insurance', 'image', 'user.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/user_2023_06_19_12_02_42_9236.png', '2023-06-19 06:33:07', '2023-06-19 06:33:07', NULL),
(69, 9, 'public_liability_insurance', 'image', 'user.png', 'png', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/user_2023_06_19_12_11_28_8480.png', '2023-06-19 06:42:54', '2023-06-19 06:42:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `verified` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 = not verified, 1= its verified',
  `verification_code` varchar(255) DEFAULT NULL,
  `locked` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 = not verified, 1= its verified',
  `customer_or_tradesperson` enum('Customer','Tradesperson') NOT NULL COMMENT 'Customer,Tradesperson',
  `terms_of_service` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=not read,1=Read',
  `profile_image` varchar(255) DEFAULT NULL,
  `account_deletion_reason` varchar(255) DEFAULT NULL,
  `delete_permanently` tinyint(4) NOT NULL DEFAULT 0,
  `status` enum('Active','InActive') NOT NULL COMMENT 'Active,InActive',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `steps_completed` tinyint(4) DEFAULT NULL,
  `is_email_verified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `google_id`, `email`, `email_verified_at`, `password`, `phone`, `verified`, `verification_code`, `locked`, `customer_or_tradesperson`, `terms_of_service`, `profile_image`, `account_deletion_reason`, `delete_permanently`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `steps_completed`, `is_email_verified`) VALUES
(1, 'Biswajit Maity', NULL, 'biswajitmaityniit@gmail.com', NULL, '$2y$10$9c4/3snzvsSVT.IuMbddLe0IoCf2JCt8kXCpxh..DwPcqnNNmqjLW', '8768624650', '0', NULL, '0', 'Customer', '1', NULL, NULL, 0, 'Active', 'nZSz8mqVzR4CeCpal6vzw0lnqOO1sYvMayKgItHI7e9RfavsBAs2PcWvUtDb', '2023-05-18 00:34:53', '2023-05-18 00:34:53', NULL, NULL, 0),
(2, 'Himanshu Kumar', NULL, 'tradeperson@fixmybuild.com', NULL, '$2y$10$9c4/3snzvsSVT.IuMbddLe0IoCf2JCt8kXCpxh..DwPcqnNNmqjLW', '9513103478', '0', NULL, '0', 'Tradesperson', '1', NULL, NULL, 0, 'Active', 'nZSz8mqVzR4CeCpal6vzw0lnqOO1sYvMayKgItHI7e9RfavsBAs2PcWvUtDb', '2023-05-18 00:34:53', '2023-05-18 00:34:53', NULL, NULL, 0),
(5, 'Sankalan Saha', NULL, 'sankalan0@gmail.com', NULL, '$2y$10$AC3CSBj0S0SJrE3hpiir9e81t0siGUd6xG/kDZxwGGwNseMAR7GxS', '+919834567841', '0', NULL, '0', 'Customer', '1', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/bird_2_5.jpg', NULL, 0, 'Active', NULL, '2023-05-18 00:44:52', '2023-05-18 01:46:38', NULL, 1, 1),
(6, 'Tradesperson', NULL, 'my_tradeperson@fixmybuild.com', NULL, '$2y$10$9c4/3snzvsSVT.IuMbddLe0IoCf2JCt8kXCpxh..DwPcqnNNmqjLW', '+919243126645', '1', NULL, '0', 'Tradesperson', '1', NULL, NULL, 0, 'Active', 'nZSz8mqVzR4CeCpal6vzw0lnqOO1sYvMayKgItHI7e9RfavsBAs2PcWvUtDb', '2023-05-18 00:34:53', '2023-05-18 00:34:53', NULL, NULL, 0),
(9, 'Sankalan Saha Tradesperson', NULL, 'sankalan.saha@ebestsolutions.net', NULL, '$2y$10$YCLX/kxnGf2cZyPLK304zOjug4eYs2JGjHsmYCG069b4h7aK0chEK', '7543123489', '0', NULL, '0', 'Tradesperson', '1', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/sammy-line-online-meeting_2023_06_19_12_02_35_8984.png', NULL, 0, 'Active', NULL, '2023-06-08 01:20:55', '2023-06-19 06:45:41', NULL, 3, 1),
(10, 'Sankalan Saha', NULL, 'sankalanfsdsaha@ebestsolutions.net', NULL, '$2y$10$KKY16gd3K7UcjcyWNfSmWucUtHRbDSFPtlrmHmbYxD6k24iAXO3S.', '1234567890', '0', NULL, '0', 'Tradesperson', '1', 'https://fmbstaging.s3.eu-west-2.amazonaws.com/Testfolder/Ultra%20hd%21%20realistic_2023_06_16_07_49_47_6131.jpg', NULL, 0, 'Active', NULL, '2023-06-08 03:16:09', '2023-06-16 04:09:31', NULL, 2, 0),
(11, 'S Tradesperson', NULL, 'sankalansaha000@gmail.com', NULL, '$2y$10$U9EPtredug9YDHAIHmWCe.PiitaEW2Qj7Ni5MYy1mtkftFkhehfEa', '7809988932', '0', NULL, '0', 'Tradesperson', '1', NULL, NULL, 0, 'InActive', NULL, '2023-06-13 21:23:02', '2023-06-13 21:23:02', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_verify`
--

CREATE TABLE `users_verify` (
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_verify`
--

INSERT INTO `users_verify` (`user_id`, `token`, `created_at`, `updated_at`) VALUES
(3, 'Zhl6MkgyeUiROycahk1yK6EhDbnnFoQhmUsNDf3Smj33FMnmrRpYbrvzFrBV6CKU', '2023-05-18 00:39:29', '2023-05-18 00:39:29'),
(4, '07qoDLwArcFBWCE1FkwkqsCg9kmMgnC1YNAvJGyAjnAqPyr1k4zwhabj0ez4Liif', '2023-05-18 00:42:43', '2023-05-18 00:42:43'),
(5, 'VzJ0O42LlRT1QldkTVkup1YBsnfy8ITah8dOkmpAqTgTOXwdoDXKJX3VYwP7Xef1', '2023-05-18 00:44:52', '2023-05-18 00:44:52'),
(7, 'KxAR6HsbyflUDDr2xQWMdxPPZl0aLQrKXOi3xllptzo7a2Te6w4c2ZZ9BYaRcx05', '2023-06-08 01:08:34', '2023-06-08 01:08:34'),
(8, 'Nkg955jK4mReIjJfj8M0y9RH3eIW5St9fG0r2YHzt6ZUaBaQVFBKKtkI85TLDvk8', '2023-06-08 01:17:24', '2023-06-08 01:17:24'),
(9, 'JJtfGy7f4N6N80O2dicesLOjVRJMwDomn8JZHnFhBrIjqPdOx3ioIDMQs4RwnfDz', '2023-06-08 01:20:55', '2023-06-08 01:20:55'),
(10, 'PGTx71qk9wPgZ8EsTgnbwRX3mfPIVmZ2p77VVIzWZdQ1PcIY6I00RXkSqubi35JT', '2023-06-08 03:16:09', '2023-06-08 03:16:09'),
(11, 'El6gNiPW4RWvOotAuSxILz0YtT07rQ1BSTBuyHfPU0xWJwsHUOmhVDycmffUCnmx', '2023-06-13 21:23:02', '2023-06-13 21:23:02');

-- --------------------------------------------------------

--
-- Table structure for table `work_types`
--

CREATE TABLE `work_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `work_type` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_types`
--

INSERT INTO `work_types` (`id`, `work_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bathroom', 1, '2023-05-18 00:34:53', '2023-05-18 00:34:53'),
(2, 'Builder', 1, '2023-05-18 00:34:53', '2023-05-18 00:34:53'),
(3, 'Carpenter', 1, '2023-05-18 00:34:53', '2023-05-18 00:34:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `area_covers`
--
ALTER TABLE `area_covers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buildercategories`
--
ALTER TABLE `buildercategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `buildercategories_builder_category_name_unique` (`builder_category_name`);

--
-- Indexes for table `buildersubcategories`
--
ALTER TABLE `buildersubcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buildersubcategories_builder_category_id_foreign` (`builder_category_id`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cookies`
--
ALTER TABLE `cookies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `estimates`
--
ALTER TABLE `estimates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estimates_tradesperson_id_foreign` (`tradesperson_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `projectaddresses`
--
ALTER TABLE `projectaddresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projectaddresses_project_id_foreign` (`project_id`);

--
-- Indexes for table `projectfiles`
--
ALTER TABLE `projectfiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projectfiles_project_id_foreign` (`project_id`);

--
-- Indexes for table `projectnotesandcommends`
--
ALTER TABLE `projectnotesandcommends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projectnotesandcommends_reviewer_id_foreign` (`reviewer_id`),
  ADD KEY `projectnotesandcommends_project_id_foreign` (`project_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_user_id_foreign` (`user_id`);

--
-- Indexes for table `project_estimate_files`
--
ALTER TABLE `project_estimate_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_estimate_files_estimate_id_foreign` (`estimate_id`);

--
-- Indexes for table `project_reviews`
--
ALTER TABLE `project_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_reviews_user_id_foreign` (`user_id`),
  ADD KEY `project_reviews_project_id_foreign` (`project_id`),
  ADD KEY `project_reviews_tradesperson_id_foreign` (`tradesperson_id`);

--
-- Indexes for table `sub_area_covers`
--
ALTER TABLE `sub_area_covers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_area_covers_area_type_id_foreign` (`area_type_id`);

--
-- Indexes for table `sub_work_types`
--
ALTER TABLE `sub_work_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_work_types_work_type_id_foreign` (`work_type_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_estimate_id_foreign` (`estimate_id`);

--
-- Indexes for table `tempmedia`
--
ALTER TABLE `tempmedia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tempmedia_user_id_foreign` (`user_id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `terms_name_unique` (`name`);

--
-- Indexes for table `traderareas`
--
ALTER TABLE `traderareas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `traderareas_user_id_foreign` (`user_id`),
  ADD KEY `traderareas_sub_area_cover_id_foreign` (`sub_area_cover_id`);

--
-- Indexes for table `traderworks`
--
ALTER TABLE `traderworks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `traderworks_user_id_foreign` (`user_id`),
  ADD KEY `traderworks_buildersubcategory_id_foreign` (`buildersubcategory_id`);

--
-- Indexes for table `trader_details`
--
ALTER TABLE `trader_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `comp_reg_no` (`comp_reg_no`);

--
-- Indexes for table `tradesperson_files`
--
ALTER TABLE `tradesperson_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tradesperson_files_tradesperson_id_foreign` (`tradesperson_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `work_types`
--
ALTER TABLE `work_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `area_covers`
--
ALTER TABLE `area_covers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `buildercategories`
--
ALTER TABLE `buildercategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `buildersubcategories`
--
ALTER TABLE `buildersubcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cookies`
--
ALTER TABLE `cookies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `estimates`
--
ALTER TABLE `estimates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projectaddresses`
--
ALTER TABLE `projectaddresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `projectfiles`
--
ALTER TABLE `projectfiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `projectnotesandcommends`
--
ALTER TABLE `projectnotesandcommends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `project_estimate_files`
--
ALTER TABLE `project_estimate_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_reviews`
--
ALTER TABLE `project_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sub_area_covers`
--
ALTER TABLE `sub_area_covers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sub_work_types`
--
ALTER TABLE `sub_work_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tempmedia`
--
ALTER TABLE `tempmedia`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `traderareas`
--
ALTER TABLE `traderareas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `traderworks`
--
ALTER TABLE `traderworks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `trader_details`
--
ALTER TABLE `trader_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tradesperson_files`
--
ALTER TABLE `tradesperson_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `work_types`
--
ALTER TABLE `work_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buildersubcategories`
--
ALTER TABLE `buildersubcategories`
  ADD CONSTRAINT `buildersubcategories_builder_category_id_foreign` FOREIGN KEY (`builder_category_id`) REFERENCES `buildercategories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `estimates`
--
ALTER TABLE `estimates`
  ADD CONSTRAINT `estimates_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `estimates_tradesperson_id_foreign` FOREIGN KEY (`tradesperson_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `projectaddresses`
--
ALTER TABLE `projectaddresses`
  ADD CONSTRAINT `projectaddresses_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projectfiles`
--
ALTER TABLE `projectfiles`
  ADD CONSTRAINT `projectfiles_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projectnotesandcommends`
--
ALTER TABLE `projectnotesandcommends`
  ADD CONSTRAINT `projectnotesandcommends_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `projectnotesandcommends_reviewer_id_foreign` FOREIGN KEY (`reviewer_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_estimate_files`
--
ALTER TABLE `project_estimate_files`
  ADD CONSTRAINT `project_estimate_files_estimate_id_foreign` FOREIGN KEY (`estimate_id`) REFERENCES `estimates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_reviews`
--
ALTER TABLE `project_reviews`
  ADD CONSTRAINT `project_reviews_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_reviews_tradesperson_id_foreign` FOREIGN KEY (`tradesperson_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_area_covers`
--
ALTER TABLE `sub_area_covers`
  ADD CONSTRAINT `sub_area_covers_area_type_id_foreign` FOREIGN KEY (`area_type_id`) REFERENCES `area_covers` (`id`);

--
-- Constraints for table `sub_work_types`
--
ALTER TABLE `sub_work_types`
  ADD CONSTRAINT `sub_work_types_work_type_id_foreign` FOREIGN KEY (`work_type_id`) REFERENCES `work_types` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_estimate_id_foreign` FOREIGN KEY (`estimate_id`) REFERENCES `estimates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tempmedia`
--
ALTER TABLE `tempmedia`
  ADD CONSTRAINT `tempmedia_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `traderareas`
--
ALTER TABLE `traderareas`
  ADD CONSTRAINT `traderareas_sub_area_cover_id_foreign` FOREIGN KEY (`sub_area_cover_id`) REFERENCES `sub_area_covers` (`id`),
  ADD CONSTRAINT `traderareas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `traderworks`
--
ALTER TABLE `traderworks`
  ADD CONSTRAINT `traderworks_buildersubcategory_id_foreign` FOREIGN KEY (`buildersubcategory_id`) REFERENCES `buildersubcategories` (`id`),
  ADD CONSTRAINT `traderworks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `trader_details`
--
ALTER TABLE `trader_details`
  ADD CONSTRAINT `trader_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tradesperson_files`
--
ALTER TABLE `tradesperson_files`
  ADD CONSTRAINT `tradesperson_files_tradesperson_id_foreign` FOREIGN KEY (`tradesperson_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
