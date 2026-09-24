-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2026 at 04:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gaji`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-default_umk_paruh_waktu', 'd:2700926;', 2105494050);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-roster:project:v3:632ccbbd46abbcd565d4929a56e5d330', 'O:26:\"Laravel\\Roster\\ProjectScan\":8:{s:8:\"basePath\";s:18:\"D:\\App\\reksa-gaji\\\";s:3:\"php\";O:35:\"Laravel\\Roster\\Ecosystems\\Ecosystem\":2:{s:9:\"\0*\0byName\";a:137:{s:10:\"brick/math\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:10:\"brick/math\";s:10:\"\0*\0version\";s:6:\"0.14.8\";s:9:\"\0*\0source\";E:43:\"Laravel\\Roster\\Enums\\PackageSource:Composer\";s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:35:\"D:\\App\\reksa-gaji\\vendor\\brick\\math\";}s:31:\"carbonphp/carbon-doctrine-types\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:31:\"carbonphp/carbon-doctrine-types\";s:10:\"\0*\0version\";s:5:\"3.2.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:56:\"D:\\App\\reksa-gaji\\vendor\\carbonphp\\carbon-doctrine-types\";}s:13:\"composer/pcre\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:13:\"composer/pcre\";s:10:\"\0*\0version\";s:5:\"3.4.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:38:\"D:\\App\\reksa-gaji\\vendor\\composer\\pcre\";}s:15:\"composer/semver\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"composer/semver\";s:10:\"\0*\0version\";s:5:\"3.4.4\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:40:\"D:\\App\\reksa-gaji\\vendor\\composer\\semver\";}s:23:\"dflydev/dot-access-data\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"dflydev/dot-access-data\";s:10:\"\0*\0version\";s:5:\"3.0.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:48:\"D:\\App\\reksa-gaji\\vendor\\dflydev\\dot-access-data\";}s:18:\"doctrine/inflector\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:18:\"doctrine/inflector\";s:10:\"\0*\0version\";s:5:\"2.1.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:43:\"D:\\App\\reksa-gaji\\vendor\\doctrine\\inflector\";}s:14:\"doctrine/lexer\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"doctrine/lexer\";s:10:\"\0*\0version\";s:5:\"3.0.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:39:\"D:\\App\\reksa-gaji\\vendor\\doctrine\\lexer\";}s:29:\"dragonmantank/cron-expression\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:29:\"dragonmantank/cron-expression\";s:10:\"\0*\0version\";s:5:\"3.6.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:54:\"D:\\App\\reksa-gaji\\vendor\\dragonmantank\\cron-expression\";}s:23:\"egulias/email-validator\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"egulias/email-validator\";s:10:\"\0*\0version\";s:5:\"4.0.4\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:48:\"D:\\App\\reksa-gaji\\vendor\\egulias\\email-validator\";}s:19:\"ezyang/htmlpurifier\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"ezyang/htmlpurifier\";s:10:\"\0*\0version\";s:6:\"4.19.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:44:\"D:\\App\\reksa-gaji\\vendor\\ezyang\\htmlpurifier\";}s:18:\"fruitcake/php-cors\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:18:\"fruitcake/php-cors\";s:10:\"\0*\0version\";s:5:\"1.4.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:43:\"D:\\App\\reksa-gaji\\vendor\\fruitcake\\php-cors\";}s:27:\"graham-campbell/result-type\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:27:\"graham-campbell/result-type\";s:10:\"\0*\0version\";s:5:\"1.2.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:52:\"D:\\App\\reksa-gaji\\vendor\\graham-campbell\\result-type\";}s:17:\"guzzlehttp/guzzle\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"guzzlehttp/guzzle\";s:10:\"\0*\0version\";s:6:\"7.15.5\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:42:\"D:\\App\\reksa-gaji\\vendor\\guzzlehttp\\guzzle\";}s:19:\"guzzlehttp/promises\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"guzzlehttp/promises\";s:10:\"\0*\0version\";s:5:\"2.5.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:44:\"D:\\App\\reksa-gaji\\vendor\\guzzlehttp\\promises\";}s:15:\"guzzlehttp/psr7\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"guzzlehttp/psr7\";s:10:\"\0*\0version\";s:6:\"2.13.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:40:\"D:\\App\\reksa-gaji\\vendor\\guzzlehttp\\psr7\";}s:23:\"guzzlehttp/uri-template\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"guzzlehttp/uri-template\";s:10:\"\0*\0version\";s:6:\"1.0.11\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:48:\"D:\\App\\reksa-gaji\\vendor\\guzzlehttp\\uri-template\";}s:17:\"laravel/framework\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"laravel/framework\";s:10:\"\0*\0version\";s:7:\"12.69.2\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^12.0\";s:7:\"\0*\0path\";s:42:\"D:\\App\\reksa-gaji\\vendor\\laravel\\framework\";}s:15:\"laravel/prompts\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"laravel/prompts\";s:10:\"\0*\0version\";s:6:\"0.3.24\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:40:\"D:\\App\\reksa-gaji\\vendor\\laravel\\prompts\";}s:28:\"laravel/serializable-closure\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:28:\"laravel/serializable-closure\";s:10:\"\0*\0version\";s:6:\"2.0.16\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:53:\"D:\\App\\reksa-gaji\\vendor\\laravel\\serializable-closure\";}s:14:\"laravel/tinker\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"laravel/tinker\";s:10:\"\0*\0version\";s:6:\"2.11.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:7:\"^2.10.1\";s:7:\"\0*\0path\";s:39:\"D:\\App\\reksa-gaji\\vendor\\laravel\\tinker\";}s:17:\"league/commonmark\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"league/commonmark\";s:10:\"\0*\0version\";s:6:\"2.10.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:42:\"D:\\App\\reksa-gaji\\vendor\\league\\commonmark\";}s:13:\"league/config\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:13:\"league/config\";s:10:\"\0*\0version\";s:5:\"1.2.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:38:\"D:\\App\\reksa-gaji\\vendor\\league\\config\";}s:16:\"league/flysystem\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"league/flysystem\";s:10:\"\0*\0version\";s:6:\"3.36.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:41:\"D:\\App\\reksa-gaji\\vendor\\league\\flysystem\";}s:22:\"league/flysystem-local\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"league/flysystem-local\";s:10:\"\0*\0version\";s:6:\"3.35.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:47:\"D:\\App\\reksa-gaji\\vendor\\league\\flysystem-local\";}s:26:\"league/mime-type-detection\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:26:\"league/mime-type-detection\";s:10:\"\0*\0version\";s:6:\"1.17.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"D:\\App\\reksa-gaji\\vendor\\league\\mime-type-detection\";}s:10:\"league/uri\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:10:\"league/uri\";s:10:\"\0*\0version\";s:5:\"7.8.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:35:\"D:\\App\\reksa-gaji\\vendor\\league\\uri\";}s:21:\"league/uri-interfaces\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:21:\"league/uri-interfaces\";s:10:\"\0*\0version\";s:5:\"7.8.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:46:\"D:\\App\\reksa-gaji\\vendor\\league\\uri-interfaces\";}s:17:\"maatwebsite/excel\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"maatwebsite/excel\";s:10:\"\0*\0version\";s:6:\"3.1.70\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:1:\"*\";s:7:\"\0*\0path\";s:42:\"D:\\App\\reksa-gaji\\vendor\\maatwebsite\\excel\";}s:23:\"maennchen/zipstream-php\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"maennchen/zipstream-php\";s:10:\"\0*\0version\";s:5:\"3.1.2\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:48:\"D:\\App\\reksa-gaji\\vendor\\maennchen\\zipstream-php\";}s:17:\"markbaker/complex\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"markbaker/complex\";s:10:\"\0*\0version\";s:5:\"3.0.2\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:42:\"D:\\App\\reksa-gaji\\vendor\\markbaker\\complex\";}s:16:\"markbaker/matrix\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"markbaker/matrix\";s:10:\"\0*\0version\";s:5:\"3.0.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:41:\"D:\\App\\reksa-gaji\\vendor\\markbaker\\matrix\";}s:15:\"monolog/monolog\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"monolog/monolog\";s:10:\"\0*\0version\";s:6:\"3.12.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:40:\"D:\\App\\reksa-gaji\\vendor\\monolog\\monolog\";}s:13:\"nesbot/carbon\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:13:\"nesbot/carbon\";s:10:\"\0*\0version\";s:6:\"3.14.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:38:\"D:\\App\\reksa-gaji\\vendor\\nesbot\\carbon\";}s:12:\"nette/schema\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"nette/schema\";s:10:\"\0*\0version\";s:5:\"1.3.6\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:37:\"D:\\App\\reksa-gaji\\vendor\\nette\\schema\";}s:11:\"nette/utils\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"nette/utils\";s:10:\"\0*\0version\";s:5:\"4.1.5\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:36:\"D:\\App\\reksa-gaji\\vendor\\nette\\utils\";}s:16:\"nikic/php-parser\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"nikic/php-parser\";s:10:\"\0*\0version\";s:5:\"5.9.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:41:\"D:\\App\\reksa-gaji\\vendor\\nikic\\php-parser\";}s:19:\"nunomaduro/termwind\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"nunomaduro/termwind\";s:10:\"\0*\0version\";s:5:\"2.4.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:44:\"D:\\App\\reksa-gaji\\vendor\\nunomaduro\\termwind\";}s:24:\"phpoffice/phpspreadsheet\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:24:\"phpoffice/phpspreadsheet\";s:10:\"\0*\0version\";s:6:\"1.30.6\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:49:\"D:\\App\\reksa-gaji\\vendor\\phpoffice\\phpspreadsheet\";}s:19:\"phpoption/phpoption\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"phpoption/phpoption\";s:10:\"\0*\0version\";s:6:\"1.10.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:44:\"D:\\App\\reksa-gaji\\vendor\\phpoption\\phpoption\";}s:9:\"psr/clock\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:9:\"psr/clock\";s:10:\"\0*\0version\";s:5:\"1.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:34:\"D:\\App\\reksa-gaji\\vendor\\psr\\clock\";}s:13:\"psr/container\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:13:\"psr/container\";s:10:\"\0*\0version\";s:5:\"2.0.2\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:38:\"D:\\App\\reksa-gaji\\vendor\\psr\\container\";}s:20:\"psr/event-dispatcher\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"psr/event-dispatcher\";s:10:\"\0*\0version\";s:5:\"1.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:45:\"D:\\App\\reksa-gaji\\vendor\\psr\\event-dispatcher\";}s:15:\"psr/http-client\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"psr/http-client\";s:10:\"\0*\0version\";s:5:\"1.0.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:40:\"D:\\App\\reksa-gaji\\vendor\\psr\\http-client\";}s:16:\"psr/http-factory\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"psr/http-factory\";s:10:\"\0*\0version\";s:5:\"1.1.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:41:\"D:\\App\\reksa-gaji\\vendor\\psr\\http-factory\";}s:16:\"psr/http-message\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"psr/http-message\";s:10:\"\0*\0version\";s:3:\"2.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:41:\"D:\\App\\reksa-gaji\\vendor\\psr\\http-message\";}s:7:\"psr/log\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:7:\"psr/log\";s:10:\"\0*\0version\";s:5:\"3.0.2\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:32:\"D:\\App\\reksa-gaji\\vendor\\psr\\log\";}s:16:\"psr/simple-cache\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"psr/simple-cache\";s:10:\"\0*\0version\";s:5:\"3.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:41:\"D:\\App\\reksa-gaji\\vendor\\psr\\simple-cache\";}s:9:\"psy/psysh\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:9:\"psy/psysh\";s:10:\"\0*\0version\";s:7:\"0.12.24\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:34:\"D:\\App\\reksa-gaji\\vendor\\psy\\psysh\";}s:23:\"ralouphie/getallheaders\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"ralouphie/getallheaders\";s:10:\"\0*\0version\";s:5:\"3.0.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:48:\"D:\\App\\reksa-gaji\\vendor\\ralouphie\\getallheaders\";}s:17:\"ramsey/collection\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"ramsey/collection\";s:10:\"\0*\0version\";s:5:\"2.1.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:42:\"D:\\App\\reksa-gaji\\vendor\\ramsey\\collection\";}s:11:\"ramsey/uuid\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"ramsey/uuid\";s:10:\"\0*\0version\";s:5:\"4.9.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:36:\"D:\\App\\reksa-gaji\\vendor\\ramsey\\uuid\";}s:13:\"symfony/clock\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:13:\"symfony/clock\";s:10:\"\0*\0version\";s:5:\"7.4.8\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:38:\"D:\\App\\reksa-gaji\\vendor\\symfony\\clock\";}s:15:\"symfony/console\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"symfony/console\";s:10:\"\0*\0version\";s:6:\"7.4.19\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:40:\"D:\\App\\reksa-gaji\\vendor\\symfony\\console\";}s:20:\"symfony/css-selector\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"symfony/css-selector\";s:10:\"\0*\0version\";s:6:\"7.4.18\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:45:\"D:\\App\\reksa-gaji\\vendor\\symfony\\css-selector\";}s:29:\"symfony/deprecation-contracts\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:29:\"symfony/deprecation-contracts\";s:10:\"\0*\0version\";s:5:\"3.7.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:54:\"D:\\App\\reksa-gaji\\vendor\\symfony\\deprecation-contracts\";}s:21:\"symfony/error-handler\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:21:\"symfony/error-handler\";s:10:\"\0*\0version\";s:6:\"7.4.17\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:46:\"D:\\App\\reksa-gaji\\vendor\\symfony\\error-handler\";}s:24:\"symfony/event-dispatcher\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:24:\"symfony/event-dispatcher\";s:10:\"\0*\0version\";s:6:\"7.4.17\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:49:\"D:\\App\\reksa-gaji\\vendor\\symfony\\event-dispatcher\";}s:34:\"symfony/event-dispatcher-contracts\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:34:\"symfony/event-dispatcher-contracts\";s:10:\"\0*\0version\";s:5:\"3.7.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:59:\"D:\\App\\reksa-gaji\\vendor\\symfony\\event-dispatcher-contracts\";}s:14:\"symfony/finder\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"symfony/finder\";s:10:\"\0*\0version\";s:6:\"7.4.19\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:39:\"D:\\App\\reksa-gaji\\vendor\\symfony\\finder\";}s:23:\"symfony/http-foundation\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"symfony/http-foundation\";s:10:\"\0*\0version\";s:6:\"7.4.19\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:48:\"D:\\App\\reksa-gaji\\vendor\\symfony\\http-foundation\";}s:19:\"symfony/http-kernel\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"symfony/http-kernel\";s:10:\"\0*\0version\";s:6:\"7.4.19\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:44:\"D:\\App\\reksa-gaji\\vendor\\symfony\\http-kernel\";}s:14:\"symfony/mailer\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"symfony/mailer\";s:10:\"\0*\0version\";s:6:\"7.4.19\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:39:\"D:\\App\\reksa-gaji\\vendor\\symfony\\mailer\";}s:12:\"symfony/mime\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"symfony/mime\";s:10:\"\0*\0version\";s:6:\"7.4.19\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:37:\"D:\\App\\reksa-gaji\\vendor\\symfony\\mime\";}s:22:\"symfony/polyfill-ctype\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"symfony/polyfill-ctype\";s:10:\"\0*\0version\";s:6:\"1.37.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:47:\"D:\\App\\reksa-gaji\\vendor\\symfony\\polyfill-ctype\";}s:30:\"symfony/polyfill-intl-grapheme\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:30:\"symfony/polyfill-intl-grapheme\";s:10:\"\0*\0version\";s:6:\"1.41.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:55:\"D:\\App\\reksa-gaji\\vendor\\symfony\\polyfill-intl-grapheme\";}s:25:\"symfony/polyfill-intl-idn\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:25:\"symfony/polyfill-intl-idn\";s:10:\"\0*\0version\";s:6:\"1.42.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"D:\\App\\reksa-gaji\\vendor\\symfony\\polyfill-intl-idn\";}s:32:\"symfony/polyfill-intl-normalizer\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:32:\"symfony/polyfill-intl-normalizer\";s:10:\"\0*\0version\";s:6:\"1.42.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"D:\\App\\reksa-gaji\\vendor\\symfony\\polyfill-intl-normalizer\";}s:25:\"symfony/polyfill-mbstring\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:25:\"symfony/polyfill-mbstring\";s:10:\"\0*\0version\";s:6:\"1.38.2\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"D:\\App\\reksa-gaji\\vendor\\symfony\\polyfill-mbstring\";}s:22:\"symfony/polyfill-php80\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"symfony/polyfill-php80\";s:10:\"\0*\0version\";s:6:\"1.37.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:47:\"D:\\App\\reksa-gaji\\vendor\\symfony\\polyfill-php80\";}s:22:\"symfony/polyfill-php83\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"symfony/polyfill-php83\";s:10:\"\0*\0version\";s:6:\"1.41.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:47:\"D:\\App\\reksa-gaji\\vendor\\symfony\\polyfill-php83\";}s:22:\"symfony/polyfill-php84\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"symfony/polyfill-php84\";s:10:\"\0*\0version\";s:6:\"1.38.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:47:\"D:\\App\\reksa-gaji\\vendor\\symfony\\polyfill-php84\";}s:22:\"symfony/polyfill-php85\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"symfony/polyfill-php85\";s:10:\"\0*\0version\";s:6:\"1.41.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:47:\"D:\\App\\reksa-gaji\\vendor\\symfony\\polyfill-php85\";}s:21:\"symfony/polyfill-uuid\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:21:\"symfony/polyfill-uuid\";s:10:\"\0*\0version\";s:6:\"1.37.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:46:\"D:\\App\\reksa-gaji\\vendor\\symfony\\polyfill-uuid\";}s:15:\"symfony/process\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"symfony/process\";s:10:\"\0*\0version\";s:6:\"7.4.19\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:40:\"D:\\App\\reksa-gaji\\vendor\\symfony\\process\";}s:15:\"symfony/routing\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"symfony/routing\";s:10:\"\0*\0version\";s:6:\"7.4.18\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:40:\"D:\\App\\reksa-gaji\\vendor\\symfony\\routing\";}s:25:\"symfony/service-contracts\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:25:\"symfony/service-contracts\";s:10:\"\0*\0version\";s:5:\"3.7.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"D:\\App\\reksa-gaji\\vendor\\symfony\\service-contracts\";}s:14:\"symfony/string\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"symfony/string\";s:10:\"\0*\0version\";s:6:\"7.4.19\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:39:\"D:\\App\\reksa-gaji\\vendor\\symfony\\string\";}s:19:\"symfony/translation\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"symfony/translation\";s:10:\"\0*\0version\";s:6:\"7.4.17\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:44:\"D:\\App\\reksa-gaji\\vendor\\symfony\\translation\";}s:29:\"symfony/translation-contracts\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:29:\"symfony/translation-contracts\";s:10:\"\0*\0version\";s:5:\"3.7.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:54:\"D:\\App\\reksa-gaji\\vendor\\symfony\\translation-contracts\";}s:11:\"symfony/uid\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"symfony/uid\";s:10:\"\0*\0version\";s:6:\"7.4.17\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:36:\"D:\\App\\reksa-gaji\\vendor\\symfony\\uid\";}s:18:\"symfony/var-dumper\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:18:\"symfony/var-dumper\";s:10:\"\0*\0version\";s:6:\"7.4.18\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:43:\"D:\\App\\reksa-gaji\\vendor\\symfony\\var-dumper\";}s:33:\"tijsverkoyen/css-to-inline-styles\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:33:\"tijsverkoyen/css-to-inline-styles\";s:10:\"\0*\0version\";s:5:\"2.4.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:58:\"D:\\App\\reksa-gaji\\vendor\\tijsverkoyen\\css-to-inline-styles\";}s:16:\"vlucas/phpdotenv\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"vlucas/phpdotenv\";s:10:\"\0*\0version\";s:5:\"5.7.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:41:\"D:\\App\\reksa-gaji\\vendor\\vlucas\\phpdotenv\";}s:19:\"voku/portable-ascii\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"voku/portable-ascii\";s:10:\"\0*\0version\";s:5:\"2.1.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:44:\"D:\\App\\reksa-gaji\\vendor\\voku\\portable-ascii\";}s:17:\"brianium/paratest\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"brianium/paratest\";s:10:\"\0*\0version\";s:5:\"7.8.5\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:42:\"D:\\App\\reksa-gaji\\vendor\\brianium\\paratest\";}s:21:\"doctrine/deprecations\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:21:\"doctrine/deprecations\";s:10:\"\0*\0version\";s:5:\"1.1.6\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:46:\"D:\\App\\reksa-gaji\\vendor\\doctrine\\deprecations\";}s:14:\"fakerphp/faker\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"fakerphp/faker\";s:10:\"\0*\0version\";s:6:\"1.24.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.23\";s:7:\"\0*\0path\";s:39:\"D:\\App\\reksa-gaji\\vendor\\fakerphp\\faker\";}s:22:\"fidry/cpu-core-counter\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"fidry/cpu-core-counter\";s:10:\"\0*\0version\";s:5:\"1.3.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:47:\"D:\\App\\reksa-gaji\\vendor\\fidry\\cpu-core-counter\";}s:11:\"filp/whoops\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"filp/whoops\";s:10:\"\0*\0version\";s:6:\"2.18.4\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:36:\"D:\\App\\reksa-gaji\\vendor\\filp\\whoops\";}s:21:\"hamcrest/hamcrest-php\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:21:\"hamcrest/hamcrest-php\";s:10:\"\0*\0version\";s:5:\"3.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:46:\"D:\\App\\reksa-gaji\\vendor\\hamcrest\\hamcrest-php\";}s:30:\"jean85/pretty-package-versions\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:30:\"jean85/pretty-package-versions\";s:10:\"\0*\0version\";s:5:\"2.1.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:55:\"D:\\App\\reksa-gaji\\vendor\\jean85\\pretty-package-versions\";}s:13:\"laravel/boost\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:13:\"laravel/boost\";s:10:\"\0*\0version\";s:5:\"2.9.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^2.2\";s:7:\"\0*\0path\";s:38:\"D:\\App\\reksa-gaji\\vendor\\laravel\\boost\";}s:11:\"laravel/mcp\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"laravel/mcp\";s:10:\"\0*\0version\";s:5:\"1.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:36:\"D:\\App\\reksa-gaji\\vendor\\laravel\\mcp\";}s:12:\"laravel/pail\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"laravel/pail\";s:10:\"\0*\0version\";s:5:\"1.2.7\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^1.2.2\";s:7:\"\0*\0path\";s:37:\"D:\\App\\reksa-gaji\\vendor\\laravel\\pail\";}s:12:\"laravel/pint\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"laravel/pint\";s:10:\"\0*\0version\";s:6:\"1.30.4\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.24\";s:7:\"\0*\0path\";s:37:\"D:\\App\\reksa-gaji\\vendor\\laravel\\pint\";}s:14:\"laravel/roster\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"laravel/roster\";s:10:\"\0*\0version\";s:5:\"1.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:39:\"D:\\App\\reksa-gaji\\vendor\\laravel\\roster\";}s:12:\"laravel/sail\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"laravel/sail\";s:10:\"\0*\0version\";s:6:\"1.67.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.41\";s:7:\"\0*\0path\";s:37:\"D:\\App\\reksa-gaji\\vendor\\laravel\\sail\";}s:15:\"mockery/mockery\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"mockery/mockery\";s:10:\"\0*\0version\";s:6:\"1.6.15\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^1.6\";s:7:\"\0*\0path\";s:40:\"D:\\App\\reksa-gaji\\vendor\\mockery\\mockery\";}s:17:\"myclabs/deep-copy\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"myclabs/deep-copy\";s:10:\"\0*\0version\";s:6:\"1.14.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:42:\"D:\\App\\reksa-gaji\\vendor\\myclabs\\deep-copy\";}s:20:\"nunomaduro/collision\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"nunomaduro/collision\";s:10:\"\0*\0version\";s:5:\"8.9.5\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^8.6\";s:7:\"\0*\0path\";s:45:\"D:\\App\\reksa-gaji\\vendor\\nunomaduro\\collision\";}s:12:\"pestphp/pest\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"pestphp/pest\";s:10:\"\0*\0version\";s:5:\"3.8.7\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^3.8\";s:7:\"\0*\0path\";s:37:\"D:\\App\\reksa-gaji\\vendor\\pestphp\\pest\";}s:19:\"pestphp/pest-plugin\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"pestphp/pest-plugin\";s:10:\"\0*\0version\";s:5:\"3.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:44:\"D:\\App\\reksa-gaji\\vendor\\pestphp\\pest-plugin\";}s:24:\"pestphp/pest-plugin-arch\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:24:\"pestphp/pest-plugin-arch\";s:10:\"\0*\0version\";s:5:\"3.1.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:49:\"D:\\App\\reksa-gaji\\vendor\\pestphp\\pest-plugin-arch\";}s:27:\"pestphp/pest-plugin-laravel\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:27:\"pestphp/pest-plugin-laravel\";s:10:\"\0*\0version\";s:5:\"3.2.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^3.2\";s:7:\"\0*\0path\";s:52:\"D:\\App\\reksa-gaji\\vendor\\pestphp\\pest-plugin-laravel\";}s:26:\"pestphp/pest-plugin-mutate\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:26:\"pestphp/pest-plugin-mutate\";s:10:\"\0*\0version\";s:5:\"3.0.5\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"D:\\App\\reksa-gaji\\vendor\\pestphp\\pest-plugin-mutate\";}s:16:\"phar-io/manifest\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"phar-io/manifest\";s:10:\"\0*\0version\";s:5:\"2.0.4\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:41:\"D:\\App\\reksa-gaji\\vendor\\phar-io\\manifest\";}s:15:\"phar-io/version\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"phar-io/version\";s:10:\"\0*\0version\";s:5:\"3.2.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:40:\"D:\\App\\reksa-gaji\\vendor\\phar-io\\version\";}s:31:\"phpdocumentor/reflection-common\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:31:\"phpdocumentor/reflection-common\";s:10:\"\0*\0version\";s:5:\"2.2.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:56:\"D:\\App\\reksa-gaji\\vendor\\phpdocumentor\\reflection-common\";}s:33:\"phpdocumentor/reflection-docblock\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:33:\"phpdocumentor/reflection-docblock\";s:10:\"\0*\0version\";s:5:\"6.0.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:58:\"D:\\App\\reksa-gaji\\vendor\\phpdocumentor\\reflection-docblock\";}s:27:\"phpdocumentor/type-resolver\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:27:\"phpdocumentor/type-resolver\";s:10:\"\0*\0version\";s:5:\"2.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:52:\"D:\\App\\reksa-gaji\\vendor\\phpdocumentor\\type-resolver\";}s:21:\"phpstan/phpdoc-parser\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:21:\"phpstan/phpdoc-parser\";s:10:\"\0*\0version\";s:5:\"2.3.5\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:46:\"D:\\App\\reksa-gaji\\vendor\\phpstan\\phpdoc-parser\";}s:25:\"phpunit/php-code-coverage\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:25:\"phpunit/php-code-coverage\";s:10:\"\0*\0version\";s:7:\"11.0.12\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"D:\\App\\reksa-gaji\\vendor\\phpunit\\php-code-coverage\";}s:25:\"phpunit/php-file-iterator\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:25:\"phpunit/php-file-iterator\";s:10:\"\0*\0version\";s:5:\"5.1.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"D:\\App\\reksa-gaji\\vendor\\phpunit\\php-file-iterator\";}s:19:\"phpunit/php-invoker\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"phpunit/php-invoker\";s:10:\"\0*\0version\";s:5:\"5.0.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:44:\"D:\\App\\reksa-gaji\\vendor\\phpunit\\php-invoker\";}s:25:\"phpunit/php-text-template\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:25:\"phpunit/php-text-template\";s:10:\"\0*\0version\";s:5:\"4.0.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"D:\\App\\reksa-gaji\\vendor\\phpunit\\php-text-template\";}s:17:\"phpunit/php-timer\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"phpunit/php-timer\";s:10:\"\0*\0version\";s:5:\"7.0.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:42:\"D:\\App\\reksa-gaji\\vendor\\phpunit\\php-timer\";}s:15:\"phpunit/phpunit\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"phpunit/phpunit\";s:10:\"\0*\0version\";s:7:\"11.5.56\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:40:\"D:\\App\\reksa-gaji\\vendor\\phpunit\\phpunit\";}s:20:\"sebastian/cli-parser\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"sebastian/cli-parser\";s:10:\"\0*\0version\";s:5:\"3.0.2\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:45:\"D:\\App\\reksa-gaji\\vendor\\sebastian\\cli-parser\";}s:19:\"sebastian/code-unit\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"sebastian/code-unit\";s:10:\"\0*\0version\";s:5:\"3.0.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:44:\"D:\\App\\reksa-gaji\\vendor\\sebastian\\code-unit\";}s:34:\"sebastian/code-unit-reverse-lookup\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:34:\"sebastian/code-unit-reverse-lookup\";s:10:\"\0*\0version\";s:5:\"4.0.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:59:\"D:\\App\\reksa-gaji\\vendor\\sebastian\\code-unit-reverse-lookup\";}s:20:\"sebastian/comparator\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"sebastian/comparator\";s:10:\"\0*\0version\";s:5:\"6.3.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:45:\"D:\\App\\reksa-gaji\\vendor\\sebastian\\comparator\";}s:20:\"sebastian/complexity\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"sebastian/complexity\";s:10:\"\0*\0version\";s:5:\"4.0.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:45:\"D:\\App\\reksa-gaji\\vendor\\sebastian\\complexity\";}s:14:\"sebastian/diff\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"sebastian/diff\";s:10:\"\0*\0version\";s:5:\"6.0.2\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:39:\"D:\\App\\reksa-gaji\\vendor\\sebastian\\diff\";}s:21:\"sebastian/environment\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:21:\"sebastian/environment\";s:10:\"\0*\0version\";s:5:\"7.2.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:46:\"D:\\App\\reksa-gaji\\vendor\\sebastian\\environment\";}s:18:\"sebastian/exporter\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:18:\"sebastian/exporter\";s:10:\"\0*\0version\";s:5:\"6.3.2\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:43:\"D:\\App\\reksa-gaji\\vendor\\sebastian\\exporter\";}s:22:\"sebastian/global-state\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"sebastian/global-state\";s:10:\"\0*\0version\";s:5:\"7.0.2\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:47:\"D:\\App\\reksa-gaji\\vendor\\sebastian\\global-state\";}s:23:\"sebastian/lines-of-code\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"sebastian/lines-of-code\";s:10:\"\0*\0version\";s:5:\"3.0.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:48:\"D:\\App\\reksa-gaji\\vendor\\sebastian\\lines-of-code\";}s:27:\"sebastian/object-enumerator\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:27:\"sebastian/object-enumerator\";s:10:\"\0*\0version\";s:5:\"6.0.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:52:\"D:\\App\\reksa-gaji\\vendor\\sebastian\\object-enumerator\";}s:26:\"sebastian/object-reflector\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:26:\"sebastian/object-reflector\";s:10:\"\0*\0version\";s:5:\"4.0.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"D:\\App\\reksa-gaji\\vendor\\sebastian\\object-reflector\";}s:27:\"sebastian/recursion-context\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:27:\"sebastian/recursion-context\";s:10:\"\0*\0version\";s:5:\"6.0.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:52:\"D:\\App\\reksa-gaji\\vendor\\sebastian\\recursion-context\";}s:14:\"sebastian/type\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"sebastian/type\";s:10:\"\0*\0version\";s:5:\"5.1.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:39:\"D:\\App\\reksa-gaji\\vendor\\sebastian\\type\";}s:17:\"sebastian/version\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"sebastian/version\";s:10:\"\0*\0version\";s:5:\"5.0.2\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:42:\"D:\\App\\reksa-gaji\\vendor\\sebastian\\version\";}s:28:\"staabm/side-effects-detector\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:28:\"staabm/side-effects-detector\";s:10:\"\0*\0version\";s:5:\"1.0.5\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:53:\"D:\\App\\reksa-gaji\\vendor\\staabm\\side-effects-detector\";}s:12:\"symfony/yaml\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"symfony/yaml\";s:10:\"\0*\0version\";s:6:\"7.4.18\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:37:\"D:\\App\\reksa-gaji\\vendor\\symfony\\yaml\";}s:35:\"ta-tikoma/phpunit-architecture-test\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:35:\"ta-tikoma/phpunit-architecture-test\";s:10:\"\0*\0version\";s:5:\"0.8.7\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:60:\"D:\\App\\reksa-gaji\\vendor\\ta-tikoma\\phpunit-architecture-test\";}s:17:\"theseer/tokenizer\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"theseer/tokenizer\";s:10:\"\0*\0version\";s:5:\"1.3.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:42:\"D:\\App\\reksa-gaji\\vendor\\theseer\\tokenizer\";}s:16:\"webmozart/assert\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"webmozart/assert\";s:10:\"\0*\0version\";s:5:\"2.4.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:41:\"D:\\App\\reksa-gaji\\vendor\\webmozart\\assert\";}}s:11:\"\0*\0packages\";O:32:\"Laravel\\Roster\\PackageCollection\":2:{s:8:\"\0*\0items\";a:137:{i:0;r:5;i:1;r:13;i:2;r:21;i:3;r:29;i:4;r:37;i:5;r:45;i:6;r:53;i:7;r:61;i:8;r:69;i:9;r:77;i:10;r:85;i:11;r:93;i:12;r:101;i:13;r:109;i:14;r:117;i:15;r:125;i:16;r:133;i:17;r:141;i:18;r:149;i:19;r:157;i:20;r:165;i:21;r:173;i:22;r:181;i:23;r:189;i:24;r:197;i:25;r:205;i:26;r:213;i:27;r:221;i:28;r:229;i:29;r:237;i:30;r:245;i:31;r:253;i:32;r:261;i:33;r:269;i:34;r:277;i:35;r:285;i:36;r:293;i:37;r:301;i:38;r:309;i:39;r:317;i:40;r:325;i:41;r:333;i:42;r:341;i:43;r:349;i:44;r:357;i:45;r:365;i:46;r:373;i:47;r:381;i:48;r:389;i:49;r:397;i:50;r:405;i:51;r:413;i:52;r:421;i:53;r:429;i:54;r:437;i:55;r:445;i:56;r:453;i:57;r:461;i:58;r:469;i:59;r:477;i:60;r:485;i:61;r:493;i:62;r:501;i:63;r:509;i:64;r:517;i:65;r:525;i:66;r:533;i:67;r:541;i:68;r:549;i:69;r:557;i:70;r:565;i:71;r:573;i:72;r:581;i:73;r:589;i:74;r:597;i:75;r:605;i:76;r:613;i:77;r:621;i:78;r:629;i:79;r:637;i:80;r:645;i:81;r:653;i:82;r:661;i:83;r:669;i:84;r:677;i:85;r:685;i:86;r:693;i:87;r:701;i:88;r:709;i:89;r:717;i:90;r:725;i:91;r:733;i:92;r:741;i:93;r:749;i:94;r:757;i:95;r:765;i:96;r:773;i:97;r:781;i:98;r:789;i:99;r:797;i:100;r:805;i:101;r:813;i:102;r:821;i:103;r:829;i:104;r:837;i:105;r:845;i:106;r:853;i:107;r:861;i:108;r:869;i:109;r:877;i:110;r:885;i:111;r:893;i:112;r:901;i:113;r:909;i:114;r:917;i:115;r:925;i:116;r:933;i:117;r:941;i:118;r:949;i:119;r:957;i:120;r:965;i:121;r:973;i:122;r:981;i:123;r:989;i:124;r:997;i:125;r:1005;i:126;r:1013;i:127;r:1021;i:128;r:1029;i:129;r:1037;i:130;r:1045;i:131;r:1053;i:132;r:1061;i:133;r:1069;i:134;r:1077;i:135;r:1085;i:136;r:1093;}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:2:\"js\";O:37:\"Laravel\\Roster\\Ecosystems\\JsEcosystem\":3:{s:9:\"\0*\0byName\";a:160:{s:17:\"@fontsource/inter\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"@fontsource/inter\";s:10:\"\0*\0version\";s:5:\"5.3.0\";s:9:\"\0*\0source\";E:38:\"Laravel\\Roster\\Enums\\PackageSource:Npm\";s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^5.3.0\";s:7:\"\0*\0path\";s:48:\"D:\\App\\reksa-gaji\\node_modules\\@fontsource\\inter\";}s:29:\"@fortawesome/fontawesome-free\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:29:\"@fortawesome/fontawesome-free\";s:10:\"\0*\0version\";s:5:\"7.3.1\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^7.3.1\";s:7:\"\0*\0path\";s:60:\"D:\\App\\reksa-gaji\\node_modules\\@fortawesome\\fontawesome-free\";}s:14:\"@popperjs/core\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"@popperjs/core\";s:10:\"\0*\0version\";s:6:\"2.11.8\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:45:\"D:\\App\\reksa-gaji\\node_modules\\@popperjs\\core\";}s:9:\"bootstrap\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:9:\"bootstrap\";s:10:\"\0*\0version\";s:5:\"5.3.8\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^5.3.8\";s:7:\"\0*\0path\";s:40:\"D:\\App\\reksa-gaji\\node_modules\\bootstrap\";}s:18:\"@esbuild/aix-ppc64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:18:\"@esbuild/aix-ppc64\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:49:\"D:\\App\\reksa-gaji\\node_modules\\@esbuild\\aix-ppc64\";}s:20:\"@esbuild/android-arm\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"@esbuild/android-arm\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"D:\\App\\reksa-gaji\\node_modules\\@esbuild\\android-arm\";}s:22:\"@esbuild/android-arm64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"@esbuild/android-arm64\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:53:\"D:\\App\\reksa-gaji\\node_modules\\@esbuild\\android-arm64\";}s:20:\"@esbuild/android-x64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"@esbuild/android-x64\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"D:\\App\\reksa-gaji\\node_modules\\@esbuild\\android-x64\";}s:21:\"@esbuild/darwin-arm64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:21:\"@esbuild/darwin-arm64\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:52:\"D:\\App\\reksa-gaji\\node_modules\\@esbuild\\darwin-arm64\";}s:19:\"@esbuild/darwin-x64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"@esbuild/darwin-x64\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"D:\\App\\reksa-gaji\\node_modules\\@esbuild\\darwin-x64\";}s:22:\"@esbuild/freebsd-arm64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"@esbuild/freebsd-arm64\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:53:\"D:\\App\\reksa-gaji\\node_modules\\@esbuild\\freebsd-arm64\";}s:20:\"@esbuild/freebsd-x64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"@esbuild/freebsd-x64\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"D:\\App\\reksa-gaji\\node_modules\\@esbuild\\freebsd-x64\";}s:18:\"@esbuild/linux-arm\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:18:\"@esbuild/linux-arm\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:49:\"D:\\App\\reksa-gaji\\node_modules\\@esbuild\\linux-arm\";}s:20:\"@esbuild/linux-arm64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"@esbuild/linux-arm64\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"D:\\App\\reksa-gaji\\node_modules\\@esbuild\\linux-arm64\";}s:19:\"@esbuild/linux-ia32\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"@esbuild/linux-ia32\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"D:\\App\\reksa-gaji\\node_modules\\@esbuild\\linux-ia32\";}s:22:\"@esbuild/linux-loong64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"@esbuild/linux-loong64\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:53:\"D:\\App\\reksa-gaji\\node_modules\\@esbuild\\linux-loong64\";}s:23:\"@esbuild/linux-mips64el\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"@esbuild/linux-mips64el\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:54:\"D:\\App\\reksa-gaji\\node_modules\\@esbuild\\linux-mips64el\";}s:20:\"@esbuild/linux-ppc64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"@esbuild/linux-ppc64\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"D:\\App\\reksa-gaji\\node_modules\\@esbuild\\linux-ppc64\";}s:22:\"@esbuild/linux-riscv64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"@esbuild/linux-riscv64\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:53:\"D:\\App\\reksa-gaji\\node_modules\\@esbuild\\linux-riscv64\";}s:20:\"@esbuild/linux-s390x\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"@esbuild/linux-s390x\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"D:\\App\\reksa-gaji\\node_modules\\@esbuild\\linux-s390x\";}s:18:\"@esbuild/linux-x64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:18:\"@esbuild/linux-x64\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:49:\"D:\\App\\reksa-gaji\\node_modules\\@esbuild\\linux-x64\";}s:21:\"@esbuild/netbsd-arm64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:21:\"@esbuild/netbsd-arm64\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:52:\"D:\\App\\reksa-gaji\\node_modules\\@esbuild\\netbsd-arm64\";}s:19:\"@esbuild/netbsd-x64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"@esbuild/netbsd-x64\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"D:\\App\\reksa-gaji\\node_modules\\@esbuild\\netbsd-x64\";}s:22:\"@esbuild/openbsd-arm64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"@esbuild/openbsd-arm64\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:53:\"D:\\App\\reksa-gaji\\node_modules\\@esbuild\\openbsd-arm64\";}s:20:\"@esbuild/openbsd-x64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"@esbuild/openbsd-x64\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"D:\\App\\reksa-gaji\\node_modules\\@esbuild\\openbsd-x64\";}s:26:\"@esbuild/openharmony-arm64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:26:\"@esbuild/openharmony-arm64\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"D:\\App\\reksa-gaji\\node_modules\\@esbuild\\openharmony-arm64\";}s:18:\"@esbuild/sunos-x64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:18:\"@esbuild/sunos-x64\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:49:\"D:\\App\\reksa-gaji\\node_modules\\@esbuild\\sunos-x64\";}s:20:\"@esbuild/win32-arm64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"@esbuild/win32-arm64\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"D:\\App\\reksa-gaji\\node_modules\\@esbuild\\win32-arm64\";}s:19:\"@esbuild/win32-ia32\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"@esbuild/win32-ia32\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"D:\\App\\reksa-gaji\\node_modules\\@esbuild\\win32-ia32\";}s:18:\"@esbuild/win32-x64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:18:\"@esbuild/win32-x64\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:49:\"D:\\App\\reksa-gaji\\node_modules\\@esbuild\\win32-x64\";}s:23:\"@jridgewell/gen-mapping\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"@jridgewell/gen-mapping\";s:10:\"\0*\0version\";s:6:\"0.3.13\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:54:\"D:\\App\\reksa-gaji\\node_modules\\@jridgewell\\gen-mapping\";}s:21:\"@jridgewell/remapping\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:21:\"@jridgewell/remapping\";s:10:\"\0*\0version\";s:5:\"2.3.5\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:52:\"D:\\App\\reksa-gaji\\node_modules\\@jridgewell\\remapping\";}s:23:\"@jridgewell/resolve-uri\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"@jridgewell/resolve-uri\";s:10:\"\0*\0version\";s:5:\"3.1.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:54:\"D:\\App\\reksa-gaji\\node_modules\\@jridgewell\\resolve-uri\";}s:27:\"@jridgewell/sourcemap-codec\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:27:\"@jridgewell/sourcemap-codec\";s:10:\"\0*\0version\";s:5:\"1.6.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:58:\"D:\\App\\reksa-gaji\\node_modules\\@jridgewell\\sourcemap-codec\";}s:25:\"@jridgewell/trace-mapping\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:25:\"@jridgewell/trace-mapping\";s:10:\"\0*\0version\";s:6:\"0.3.31\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:56:\"D:\\App\\reksa-gaji\\node_modules\\@jridgewell\\trace-mapping\";}s:27:\"@napi-rs/lzma-linux-x64-gnu\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:27:\"@napi-rs/lzma-linux-x64-gnu\";s:10:\"\0*\0version\";s:5:\"1.5.1\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:58:\"D:\\App\\reksa-gaji\\node_modules\\@napi-rs\\lzma-linux-x64-gnu\";}s:31:\"@rollup/rollup-android-arm-eabi\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:31:\"@rollup/rollup-android-arm-eabi\";s:10:\"\0*\0version\";s:6:\"4.63.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:62:\"D:\\App\\reksa-gaji\\node_modules\\@rollup\\rollup-android-arm-eabi\";}s:28:\"@rollup/rollup-android-arm64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:28:\"@rollup/rollup-android-arm64\";s:10:\"\0*\0version\";s:6:\"4.63.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:59:\"D:\\App\\reksa-gaji\\node_modules\\@rollup\\rollup-android-arm64\";}s:27:\"@rollup/rollup-darwin-arm64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:27:\"@rollup/rollup-darwin-arm64\";s:10:\"\0*\0version\";s:6:\"4.63.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:58:\"D:\\App\\reksa-gaji\\node_modules\\@rollup\\rollup-darwin-arm64\";}s:25:\"@rollup/rollup-darwin-x64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:25:\"@rollup/rollup-darwin-x64\";s:10:\"\0*\0version\";s:6:\"4.63.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:56:\"D:\\App\\reksa-gaji\\node_modules\\@rollup\\rollup-darwin-x64\";}s:28:\"@rollup/rollup-freebsd-arm64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:28:\"@rollup/rollup-freebsd-arm64\";s:10:\"\0*\0version\";s:6:\"4.63.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:59:\"D:\\App\\reksa-gaji\\node_modules\\@rollup\\rollup-freebsd-arm64\";}s:26:\"@rollup/rollup-freebsd-x64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:26:\"@rollup/rollup-freebsd-x64\";s:10:\"\0*\0version\";s:6:\"4.63.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"D:\\App\\reksa-gaji\\node_modules\\@rollup\\rollup-freebsd-x64\";}s:34:\"@rollup/rollup-linux-arm-gnueabihf\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:34:\"@rollup/rollup-linux-arm-gnueabihf\";s:10:\"\0*\0version\";s:6:\"4.63.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:65:\"D:\\App\\reksa-gaji\\node_modules\\@rollup\\rollup-linux-arm-gnueabihf\";}s:35:\"@rollup/rollup-linux-arm-musleabihf\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:35:\"@rollup/rollup-linux-arm-musleabihf\";s:10:\"\0*\0version\";s:6:\"4.63.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:66:\"D:\\App\\reksa-gaji\\node_modules\\@rollup\\rollup-linux-arm-musleabihf\";}s:30:\"@rollup/rollup-linux-arm64-gnu\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:30:\"@rollup/rollup-linux-arm64-gnu\";s:10:\"\0*\0version\";s:6:\"4.63.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:61:\"D:\\App\\reksa-gaji\\node_modules\\@rollup\\rollup-linux-arm64-gnu\";}s:31:\"@rollup/rollup-linux-arm64-musl\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:31:\"@rollup/rollup-linux-arm64-musl\";s:10:\"\0*\0version\";s:6:\"4.63.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:62:\"D:\\App\\reksa-gaji\\node_modules\\@rollup\\rollup-linux-arm64-musl\";}s:32:\"@rollup/rollup-linux-loong64-gnu\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:32:\"@rollup/rollup-linux-loong64-gnu\";s:10:\"\0*\0version\";s:6:\"4.63.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:63:\"D:\\App\\reksa-gaji\\node_modules\\@rollup\\rollup-linux-loong64-gnu\";}s:33:\"@rollup/rollup-linux-loong64-musl\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:33:\"@rollup/rollup-linux-loong64-musl\";s:10:\"\0*\0version\";s:6:\"4.63.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:64:\"D:\\App\\reksa-gaji\\node_modules\\@rollup\\rollup-linux-loong64-musl\";}s:30:\"@rollup/rollup-linux-ppc64-gnu\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:30:\"@rollup/rollup-linux-ppc64-gnu\";s:10:\"\0*\0version\";s:6:\"4.63.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:61:\"D:\\App\\reksa-gaji\\node_modules\\@rollup\\rollup-linux-ppc64-gnu\";}s:31:\"@rollup/rollup-linux-ppc64-musl\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:31:\"@rollup/rollup-linux-ppc64-musl\";s:10:\"\0*\0version\";s:6:\"4.63.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:62:\"D:\\App\\reksa-gaji\\node_modules\\@rollup\\rollup-linux-ppc64-musl\";}s:32:\"@rollup/rollup-linux-riscv64-gnu\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:32:\"@rollup/rollup-linux-riscv64-gnu\";s:10:\"\0*\0version\";s:6:\"4.63.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:63:\"D:\\App\\reksa-gaji\\node_modules\\@rollup\\rollup-linux-riscv64-gnu\";}s:33:\"@rollup/rollup-linux-riscv64-musl\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:33:\"@rollup/rollup-linux-riscv64-musl\";s:10:\"\0*\0version\";s:6:\"4.63.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:64:\"D:\\App\\reksa-gaji\\node_modules\\@rollup\\rollup-linux-riscv64-musl\";}s:30:\"@rollup/rollup-linux-s390x-gnu\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:30:\"@rollup/rollup-linux-s390x-gnu\";s:10:\"\0*\0version\";s:6:\"4.63.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:61:\"D:\\App\\reksa-gaji\\node_modules\\@rollup\\rollup-linux-s390x-gnu\";}s:28:\"@rollup/rollup-linux-x64-gnu\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:28:\"@rollup/rollup-linux-x64-gnu\";s:10:\"\0*\0version\";s:6:\"4.63.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:59:\"D:\\App\\reksa-gaji\\node_modules\\@rollup\\rollup-linux-x64-gnu\";}s:29:\"@rollup/rollup-linux-x64-musl\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:29:\"@rollup/rollup-linux-x64-musl\";s:10:\"\0*\0version\";s:6:\"4.63.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:60:\"D:\\App\\reksa-gaji\\node_modules\\@rollup\\rollup-linux-x64-musl\";}s:26:\"@rollup/rollup-openbsd-x64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:26:\"@rollup/rollup-openbsd-x64\";s:10:\"\0*\0version\";s:6:\"4.63.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"D:\\App\\reksa-gaji\\node_modules\\@rollup\\rollup-openbsd-x64\";}s:32:\"@rollup/rollup-openharmony-arm64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:32:\"@rollup/rollup-openharmony-arm64\";s:10:\"\0*\0version\";s:6:\"4.63.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:63:\"D:\\App\\reksa-gaji\\node_modules\\@rollup\\rollup-openharmony-arm64\";}s:31:\"@rollup/rollup-win32-arm64-msvc\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:31:\"@rollup/rollup-win32-arm64-msvc\";s:10:\"\0*\0version\";s:6:\"4.63.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:62:\"D:\\App\\reksa-gaji\\node_modules\\@rollup\\rollup-win32-arm64-msvc\";}s:30:\"@rollup/rollup-win32-ia32-msvc\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:30:\"@rollup/rollup-win32-ia32-msvc\";s:10:\"\0*\0version\";s:6:\"4.63.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:61:\"D:\\App\\reksa-gaji\\node_modules\\@rollup\\rollup-win32-ia32-msvc\";}s:28:\"@rollup/rollup-win32-x64-gnu\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:28:\"@rollup/rollup-win32-x64-gnu\";s:10:\"\0*\0version\";s:6:\"4.63.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:59:\"D:\\App\\reksa-gaji\\node_modules\\@rollup\\rollup-win32-x64-gnu\";}s:29:\"@rollup/rollup-win32-x64-msvc\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:29:\"@rollup/rollup-win32-x64-msvc\";s:10:\"\0*\0version\";s:6:\"4.63.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:60:\"D:\\App\\reksa-gaji\\node_modules\\@rollup\\rollup-win32-x64-msvc\";}s:17:\"@tailwindcss/node\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"@tailwindcss/node\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:48:\"D:\\App\\reksa-gaji\\node_modules\\@tailwindcss\\node\";}s:18:\"@tailwindcss/oxide\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:18:\"@tailwindcss/oxide\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:49:\"D:\\App\\reksa-gaji\\node_modules\\@tailwindcss\\oxide\";}s:32:\"@tailwindcss/oxide-android-arm64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:32:\"@tailwindcss/oxide-android-arm64\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:63:\"D:\\App\\reksa-gaji\\node_modules\\@tailwindcss\\oxide-android-arm64\";}s:31:\"@tailwindcss/oxide-darwin-arm64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:31:\"@tailwindcss/oxide-darwin-arm64\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:62:\"D:\\App\\reksa-gaji\\node_modules\\@tailwindcss\\oxide-darwin-arm64\";}s:29:\"@tailwindcss/oxide-darwin-x64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:29:\"@tailwindcss/oxide-darwin-x64\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:60:\"D:\\App\\reksa-gaji\\node_modules\\@tailwindcss\\oxide-darwin-x64\";}s:30:\"@tailwindcss/oxide-freebsd-x64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:30:\"@tailwindcss/oxide-freebsd-x64\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:61:\"D:\\App\\reksa-gaji\\node_modules\\@tailwindcss\\oxide-freebsd-x64\";}s:38:\"@tailwindcss/oxide-linux-arm-gnueabihf\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:38:\"@tailwindcss/oxide-linux-arm-gnueabihf\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:69:\"D:\\App\\reksa-gaji\\node_modules\\@tailwindcss\\oxide-linux-arm-gnueabihf\";}s:34:\"@tailwindcss/oxide-linux-arm64-gnu\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:34:\"@tailwindcss/oxide-linux-arm64-gnu\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:65:\"D:\\App\\reksa-gaji\\node_modules\\@tailwindcss\\oxide-linux-arm64-gnu\";}s:35:\"@tailwindcss/oxide-linux-arm64-musl\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:35:\"@tailwindcss/oxide-linux-arm64-musl\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:66:\"D:\\App\\reksa-gaji\\node_modules\\@tailwindcss\\oxide-linux-arm64-musl\";}s:32:\"@tailwindcss/oxide-linux-x64-gnu\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:32:\"@tailwindcss/oxide-linux-x64-gnu\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:63:\"D:\\App\\reksa-gaji\\node_modules\\@tailwindcss\\oxide-linux-x64-gnu\";}s:33:\"@tailwindcss/oxide-linux-x64-musl\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:33:\"@tailwindcss/oxide-linux-x64-musl\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:64:\"D:\\App\\reksa-gaji\\node_modules\\@tailwindcss\\oxide-linux-x64-musl\";}s:30:\"@tailwindcss/oxide-wasm32-wasi\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:30:\"@tailwindcss/oxide-wasm32-wasi\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:61:\"D:\\App\\reksa-gaji\\node_modules\\@tailwindcss\\oxide-wasm32-wasi\";}s:35:\"@tailwindcss/oxide-win32-arm64-msvc\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:35:\"@tailwindcss/oxide-win32-arm64-msvc\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:66:\"D:\\App\\reksa-gaji\\node_modules\\@tailwindcss\\oxide-win32-arm64-msvc\";}s:33:\"@tailwindcss/oxide-win32-x64-msvc\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:33:\"@tailwindcss/oxide-win32-x64-msvc\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:64:\"D:\\App\\reksa-gaji\\node_modules\\@tailwindcss\\oxide-win32-x64-msvc\";}s:17:\"@tailwindcss/vite\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"@tailwindcss/vite\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^4.0.0\";s:7:\"\0*\0path\";s:48:\"D:\\App\\reksa-gaji\\node_modules\\@tailwindcss\\vite\";}s:13:\"@types/estree\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:13:\"@types/estree\";s:10:\"\0*\0version\";s:5:\"1.0.9\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:44:\"D:\\App\\reksa-gaji\\node_modules\\@types\\estree\";}s:10:\"agent-base\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:10:\"agent-base\";s:10:\"\0*\0version\";s:5:\"6.0.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:41:\"D:\\App\\reksa-gaji\\node_modules\\agent-base\";}s:10:\"ansi-regex\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:10:\"ansi-regex\";s:10:\"\0*\0version\";s:5:\"5.0.1\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:41:\"D:\\App\\reksa-gaji\\node_modules\\ansi-regex\";}s:11:\"ansi-styles\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"ansi-styles\";s:10:\"\0*\0version\";s:5:\"4.3.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:42:\"D:\\App\\reksa-gaji\\node_modules\\ansi-styles\";}s:8:\"asynckit\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:8:\"asynckit\";s:10:\"\0*\0version\";s:5:\"0.4.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:39:\"D:\\App\\reksa-gaji\\node_modules\\asynckit\";}s:5:\"axios\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:5:\"axios\";s:10:\"\0*\0version\";s:6:\"1.20.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:7:\"^1.11.0\";s:7:\"\0*\0path\";s:36:\"D:\\App\\reksa-gaji\\node_modules\\axios\";}s:23:\"call-bind-apply-helpers\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"call-bind-apply-helpers\";s:10:\"\0*\0version\";s:5:\"1.0.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:54:\"D:\\App\\reksa-gaji\\node_modules\\call-bind-apply-helpers\";}s:5:\"chalk\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:5:\"chalk\";s:10:\"\0*\0version\";s:5:\"4.1.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:36:\"D:\\App\\reksa-gaji\\node_modules\\chalk\";}s:5:\"cliui\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:5:\"cliui\";s:10:\"\0*\0version\";s:5:\"8.0.1\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:36:\"D:\\App\\reksa-gaji\\node_modules\\cliui\";}s:13:\"color-convert\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:13:\"color-convert\";s:10:\"\0*\0version\";s:5:\"2.0.1\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:44:\"D:\\App\\reksa-gaji\\node_modules\\color-convert\";}s:10:\"color-name\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:10:\"color-name\";s:10:\"\0*\0version\";s:5:\"1.1.4\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:41:\"D:\\App\\reksa-gaji\\node_modules\\color-name\";}s:15:\"combined-stream\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"combined-stream\";s:10:\"\0*\0version\";s:5:\"1.0.8\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:46:\"D:\\App\\reksa-gaji\\node_modules\\combined-stream\";}s:12:\"concurrently\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"concurrently\";s:10:\"\0*\0version\";s:5:\"9.2.4\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^9.0.1\";s:7:\"\0*\0path\";s:43:\"D:\\App\\reksa-gaji\\node_modules\\concurrently\";}s:5:\"debug\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:5:\"debug\";s:10:\"\0*\0version\";s:5:\"4.4.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:36:\"D:\\App\\reksa-gaji\\node_modules\\debug\";}s:14:\"delayed-stream\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"delayed-stream\";s:10:\"\0*\0version\";s:5:\"1.0.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:45:\"D:\\App\\reksa-gaji\\node_modules\\delayed-stream\";}s:11:\"detect-libc\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"detect-libc\";s:10:\"\0*\0version\";s:5:\"2.1.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:42:\"D:\\App\\reksa-gaji\\node_modules\\detect-libc\";}s:12:\"dunder-proto\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"dunder-proto\";s:10:\"\0*\0version\";s:5:\"1.0.1\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:43:\"D:\\App\\reksa-gaji\\node_modules\\dunder-proto\";}s:11:\"emoji-regex\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"emoji-regex\";s:10:\"\0*\0version\";s:5:\"8.0.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:42:\"D:\\App\\reksa-gaji\\node_modules\\emoji-regex\";}s:16:\"enhanced-resolve\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"enhanced-resolve\";s:10:\"\0*\0version\";s:6:\"5.25.1\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:47:\"D:\\App\\reksa-gaji\\node_modules\\enhanced-resolve\";}s:18:\"es-define-property\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:18:\"es-define-property\";s:10:\"\0*\0version\";s:5:\"1.0.1\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:49:\"D:\\App\\reksa-gaji\\node_modules\\es-define-property\";}s:9:\"es-errors\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:9:\"es-errors\";s:10:\"\0*\0version\";s:5:\"1.3.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:40:\"D:\\App\\reksa-gaji\\node_modules\\es-errors\";}s:15:\"es-object-atoms\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"es-object-atoms\";s:10:\"\0*\0version\";s:5:\"1.1.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:46:\"D:\\App\\reksa-gaji\\node_modules\\es-object-atoms\";}s:18:\"es-set-tostringtag\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:18:\"es-set-tostringtag\";s:10:\"\0*\0version\";s:5:\"2.1.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:49:\"D:\\App\\reksa-gaji\\node_modules\\es-set-tostringtag\";}s:7:\"esbuild\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:7:\"esbuild\";s:10:\"\0*\0version\";s:6:\"0.28.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:38:\"D:\\App\\reksa-gaji\\node_modules\\esbuild\";}s:8:\"escalade\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:8:\"escalade\";s:10:\"\0*\0version\";s:5:\"3.2.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:39:\"D:\\App\\reksa-gaji\\node_modules\\escalade\";}s:4:\"fdir\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:4:\"fdir\";s:10:\"\0*\0version\";s:5:\"6.5.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:35:\"D:\\App\\reksa-gaji\\node_modules\\fdir\";}s:16:\"follow-redirects\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"follow-redirects\";s:10:\"\0*\0version\";s:6:\"1.16.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:47:\"D:\\App\\reksa-gaji\\node_modules\\follow-redirects\";}s:9:\"form-data\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:9:\"form-data\";s:10:\"\0*\0version\";s:5:\"4.0.6\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:40:\"D:\\App\\reksa-gaji\\node_modules\\form-data\";}s:8:\"fsevents\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:8:\"fsevents\";s:10:\"\0*\0version\";s:5:\"2.3.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:39:\"D:\\App\\reksa-gaji\\node_modules\\fsevents\";}s:13:\"function-bind\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:13:\"function-bind\";s:10:\"\0*\0version\";s:5:\"1.1.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:44:\"D:\\App\\reksa-gaji\\node_modules\\function-bind\";}s:15:\"get-caller-file\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"get-caller-file\";s:10:\"\0*\0version\";s:5:\"2.0.5\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:46:\"D:\\App\\reksa-gaji\\node_modules\\get-caller-file\";}s:13:\"get-intrinsic\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:13:\"get-intrinsic\";s:10:\"\0*\0version\";s:5:\"1.3.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:44:\"D:\\App\\reksa-gaji\\node_modules\\get-intrinsic\";}s:9:\"get-proto\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:9:\"get-proto\";s:10:\"\0*\0version\";s:5:\"1.0.1\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:40:\"D:\\App\\reksa-gaji\\node_modules\\get-proto\";}s:4:\"gopd\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:4:\"gopd\";s:10:\"\0*\0version\";s:5:\"1.2.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:35:\"D:\\App\\reksa-gaji\\node_modules\\gopd\";}s:11:\"graceful-fs\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"graceful-fs\";s:10:\"\0*\0version\";s:6:\"4.2.11\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:42:\"D:\\App\\reksa-gaji\\node_modules\\graceful-fs\";}s:8:\"has-flag\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:8:\"has-flag\";s:10:\"\0*\0version\";s:5:\"4.0.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:39:\"D:\\App\\reksa-gaji\\node_modules\\has-flag\";}s:11:\"has-symbols\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"has-symbols\";s:10:\"\0*\0version\";s:5:\"1.1.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:42:\"D:\\App\\reksa-gaji\\node_modules\\has-symbols\";}s:15:\"has-tostringtag\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"has-tostringtag\";s:10:\"\0*\0version\";s:5:\"1.0.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:46:\"D:\\App\\reksa-gaji\\node_modules\\has-tostringtag\";}s:6:\"hasown\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:6:\"hasown\";s:10:\"\0*\0version\";s:5:\"2.0.4\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:37:\"D:\\App\\reksa-gaji\\node_modules\\hasown\";}s:17:\"https-proxy-agent\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"https-proxy-agent\";s:10:\"\0*\0version\";s:5:\"5.0.1\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:48:\"D:\\App\\reksa-gaji\\node_modules\\https-proxy-agent\";}s:23:\"is-fullwidth-code-point\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"is-fullwidth-code-point\";s:10:\"\0*\0version\";s:5:\"3.0.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:54:\"D:\\App\\reksa-gaji\\node_modules\\is-fullwidth-code-point\";}s:4:\"jiti\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:4:\"jiti\";s:10:\"\0*\0version\";s:5:\"2.7.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:35:\"D:\\App\\reksa-gaji\\node_modules\\jiti\";}s:19:\"laravel-vite-plugin\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"laravel-vite-plugin\";s:10:\"\0*\0version\";s:5:\"2.1.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^2.0.0\";s:7:\"\0*\0path\";s:50:\"D:\\App\\reksa-gaji\\node_modules\\laravel-vite-plugin\";}s:12:\"lightningcss\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"lightningcss\";s:10:\"\0*\0version\";s:6:\"1.32.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:43:\"D:\\App\\reksa-gaji\\node_modules\\lightningcss\";}s:26:\"lightningcss-android-arm64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:26:\"lightningcss-android-arm64\";s:10:\"\0*\0version\";s:6:\"1.32.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"D:\\App\\reksa-gaji\\node_modules\\lightningcss-android-arm64\";}s:25:\"lightningcss-darwin-arm64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:25:\"lightningcss-darwin-arm64\";s:10:\"\0*\0version\";s:6:\"1.32.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:56:\"D:\\App\\reksa-gaji\\node_modules\\lightningcss-darwin-arm64\";}s:23:\"lightningcss-darwin-x64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"lightningcss-darwin-x64\";s:10:\"\0*\0version\";s:6:\"1.32.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:54:\"D:\\App\\reksa-gaji\\node_modules\\lightningcss-darwin-x64\";}s:24:\"lightningcss-freebsd-x64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:24:\"lightningcss-freebsd-x64\";s:10:\"\0*\0version\";s:6:\"1.32.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:55:\"D:\\App\\reksa-gaji\\node_modules\\lightningcss-freebsd-x64\";}s:32:\"lightningcss-linux-arm-gnueabihf\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:32:\"lightningcss-linux-arm-gnueabihf\";s:10:\"\0*\0version\";s:6:\"1.32.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:63:\"D:\\App\\reksa-gaji\\node_modules\\lightningcss-linux-arm-gnueabihf\";}s:28:\"lightningcss-linux-arm64-gnu\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:28:\"lightningcss-linux-arm64-gnu\";s:10:\"\0*\0version\";s:6:\"1.32.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:59:\"D:\\App\\reksa-gaji\\node_modules\\lightningcss-linux-arm64-gnu\";}s:29:\"lightningcss-linux-arm64-musl\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:29:\"lightningcss-linux-arm64-musl\";s:10:\"\0*\0version\";s:6:\"1.32.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:60:\"D:\\App\\reksa-gaji\\node_modules\\lightningcss-linux-arm64-musl\";}s:26:\"lightningcss-linux-x64-gnu\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:26:\"lightningcss-linux-x64-gnu\";s:10:\"\0*\0version\";s:6:\"1.32.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"D:\\App\\reksa-gaji\\node_modules\\lightningcss-linux-x64-gnu\";}s:27:\"lightningcss-linux-x64-musl\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:27:\"lightningcss-linux-x64-musl\";s:10:\"\0*\0version\";s:6:\"1.32.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:58:\"D:\\App\\reksa-gaji\\node_modules\\lightningcss-linux-x64-musl\";}s:29:\"lightningcss-win32-arm64-msvc\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:29:\"lightningcss-win32-arm64-msvc\";s:10:\"\0*\0version\";s:6:\"1.32.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:60:\"D:\\App\\reksa-gaji\\node_modules\\lightningcss-win32-arm64-msvc\";}s:27:\"lightningcss-win32-x64-msvc\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:27:\"lightningcss-win32-x64-msvc\";s:10:\"\0*\0version\";s:6:\"1.32.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:58:\"D:\\App\\reksa-gaji\\node_modules\\lightningcss-win32-x64-msvc\";}s:12:\"magic-string\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"magic-string\";s:10:\"\0*\0version\";s:7:\"0.30.21\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:43:\"D:\\App\\reksa-gaji\\node_modules\\magic-string\";}s:15:\"math-intrinsics\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"math-intrinsics\";s:10:\"\0*\0version\";s:5:\"1.1.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:46:\"D:\\App\\reksa-gaji\\node_modules\\math-intrinsics\";}s:7:\"mime-db\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:7:\"mime-db\";s:10:\"\0*\0version\";s:6:\"1.52.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:38:\"D:\\App\\reksa-gaji\\node_modules\\mime-db\";}s:10:\"mime-types\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:10:\"mime-types\";s:10:\"\0*\0version\";s:6:\"2.1.35\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:41:\"D:\\App\\reksa-gaji\\node_modules\\mime-types\";}s:2:\"ms\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:2:\"ms\";s:10:\"\0*\0version\";s:5:\"2.1.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:33:\"D:\\App\\reksa-gaji\\node_modules\\ms\";}s:6:\"nanoid\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:6:\"nanoid\";s:10:\"\0*\0version\";s:6:\"3.3.19\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:37:\"D:\\App\\reksa-gaji\\node_modules\\nanoid\";}s:10:\"picocolors\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:10:\"picocolors\";s:10:\"\0*\0version\";s:5:\"1.1.1\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:41:\"D:\\App\\reksa-gaji\\node_modules\\picocolors\";}s:9:\"picomatch\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:9:\"picomatch\";s:10:\"\0*\0version\";s:5:\"4.0.7\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:40:\"D:\\App\\reksa-gaji\\node_modules\\picomatch\";}s:7:\"postcss\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:7:\"postcss\";s:10:\"\0*\0version\";s:6:\"8.5.28\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:38:\"D:\\App\\reksa-gaji\\node_modules\\postcss\";}s:14:\"proxy-from-env\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"proxy-from-env\";s:10:\"\0*\0version\";s:5:\"2.1.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:45:\"D:\\App\\reksa-gaji\\node_modules\\proxy-from-env\";}s:17:\"require-directory\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"require-directory\";s:10:\"\0*\0version\";s:5:\"2.1.1\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:48:\"D:\\App\\reksa-gaji\\node_modules\\require-directory\";}s:6:\"rollup\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:6:\"rollup\";s:10:\"\0*\0version\";s:6:\"4.63.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:37:\"D:\\App\\reksa-gaji\\node_modules\\rollup\";}s:4:\"rxjs\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:4:\"rxjs\";s:10:\"\0*\0version\";s:5:\"7.8.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:35:\"D:\\App\\reksa-gaji\\node_modules\\rxjs\";}s:11:\"shell-quote\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"shell-quote\";s:10:\"\0*\0version\";s:5:\"1.9.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:42:\"D:\\App\\reksa-gaji\\node_modules\\shell-quote\";}s:13:\"source-map-js\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:13:\"source-map-js\";s:10:\"\0*\0version\";s:5:\"1.2.1\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:44:\"D:\\App\\reksa-gaji\\node_modules\\source-map-js\";}s:12:\"string-width\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"string-width\";s:10:\"\0*\0version\";s:5:\"4.2.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:43:\"D:\\App\\reksa-gaji\\node_modules\\string-width\";}s:10:\"strip-ansi\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:10:\"strip-ansi\";s:10:\"\0*\0version\";s:5:\"6.0.1\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:41:\"D:\\App\\reksa-gaji\\node_modules\\strip-ansi\";}s:14:\"supports-color\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"supports-color\";s:10:\"\0*\0version\";s:5:\"8.1.1\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:45:\"D:\\App\\reksa-gaji\\node_modules\\supports-color\";}s:11:\"tailwindcss\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"tailwindcss\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^4.0.0\";s:7:\"\0*\0path\";s:42:\"D:\\App\\reksa-gaji\\node_modules\\tailwindcss\";}s:7:\"tapable\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:7:\"tapable\";s:10:\"\0*\0version\";s:5:\"2.3.3\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:38:\"D:\\App\\reksa-gaji\\node_modules\\tapable\";}s:10:\"tinyglobby\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:10:\"tinyglobby\";s:10:\"\0*\0version\";s:6:\"0.2.17\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:41:\"D:\\App\\reksa-gaji\\node_modules\\tinyglobby\";}s:9:\"tree-kill\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:9:\"tree-kill\";s:10:\"\0*\0version\";s:5:\"1.2.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:40:\"D:\\App\\reksa-gaji\\node_modules\\tree-kill\";}s:5:\"tslib\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:5:\"tslib\";s:10:\"\0*\0version\";s:5:\"2.8.1\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:36:\"D:\\App\\reksa-gaji\\node_modules\\tslib\";}s:4:\"vite\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:4:\"vite\";s:10:\"\0*\0version\";s:5:\"7.3.6\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^7.0.7\";s:7:\"\0*\0path\";s:35:\"D:\\App\\reksa-gaji\\node_modules\\vite\";}s:23:\"vite-plugin-full-reload\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"vite-plugin-full-reload\";s:10:\"\0*\0version\";s:5:\"1.2.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:54:\"D:\\App\\reksa-gaji\\node_modules\\vite-plugin-full-reload\";}s:9:\"wrap-ansi\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:9:\"wrap-ansi\";s:10:\"\0*\0version\";s:5:\"7.0.0\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:40:\"D:\\App\\reksa-gaji\\node_modules\\wrap-ansi\";}s:4:\"y18n\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:4:\"y18n\";s:10:\"\0*\0version\";s:5:\"5.0.8\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:35:\"D:\\App\\reksa-gaji\\node_modules\\y18n\";}s:5:\"yargs\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:5:\"yargs\";s:10:\"\0*\0version\";s:6:\"17.7.2\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:36:\"D:\\App\\reksa-gaji\\node_modules\\yargs\";}s:12:\"yargs-parser\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"yargs-parser\";s:10:\"\0*\0version\";s:6:\"21.1.1\";s:9:\"\0*\0source\";r:1246;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:43:\"D:\\App\\reksa-gaji\\node_modules\\yargs-parser\";}}s:11:\"\0*\0packages\";O:32:\"Laravel\\Roster\\PackageCollection\":2:{s:8:\"\0*\0items\";a:160:{i:0;r:1243;i:1;r:1251;i:2;r:1259;i:3;r:1267;i:4;r:1275;i:5;r:1283;i:6;r:1291;i:7;r:1299;i:8;r:1307;i:9;r:1315;i:10;r:1323;i:11;r:1331;i:12;r:1339;i:13;r:1347;i:14;r:1355;i:15;r:1363;i:16;r:1371;i:17;r:1379;i:18;r:1387;i:19;r:1395;i:20;r:1403;i:21;r:1411;i:22;r:1419;i:23;r:1427;i:24;r:1435;i:25;r:1443;i:26;r:1451;i:27;r:1459;i:28;r:1467;i:29;r:1475;i:30;r:1483;i:31;r:1491;i:32;r:1499;i:33;r:1507;i:34;r:1515;i:35;r:1523;i:36;r:1531;i:37;r:1539;i:38;r:1547;i:39;r:1555;i:40;r:1563;i:41;r:1571;i:42;r:1579;i:43;r:1587;i:44;r:1595;i:45;r:1603;i:46;r:1611;i:47;r:1619;i:48;r:1627;i:49;r:1635;i:50;r:1643;i:51;r:1651;i:52;r:1659;i:53;r:1667;i:54;r:1675;i:55;r:1683;i:56;r:1691;i:57;r:1699;i:58;r:1707;i:59;r:1715;i:60;r:1723;i:61;r:1731;i:62;r:1739;i:63;r:1747;i:64;r:1755;i:65;r:1763;i:66;r:1771;i:67;r:1779;i:68;r:1787;i:69;r:1795;i:70;r:1803;i:71;r:1811;i:72;r:1819;i:73;r:1827;i:74;r:1835;i:75;r:1843;i:76;r:1851;i:77;r:1859;i:78;r:1867;i:79;r:1875;i:80;r:1883;i:81;r:1891;i:82;r:1899;i:83;r:1907;i:84;r:1915;i:85;r:1923;i:86;r:1931;i:87;r:1939;i:88;r:1947;i:89;r:1955;i:90;r:1963;i:91;r:1971;i:92;r:1979;i:93;r:1987;i:94;r:1995;i:95;r:2003;i:96;r:2011;i:97;r:2019;i:98;r:2027;i:99;r:2035;i:100;r:2043;i:101;r:2051;i:102;r:2059;i:103;r:2067;i:104;r:2075;i:105;r:2083;i:106;r:2091;i:107;r:2099;i:108;r:2107;i:109;r:2115;i:110;r:2123;i:111;r:2131;i:112;r:2139;i:113;r:2147;i:114;r:2155;i:115;r:2163;i:116;r:2171;i:117;r:2179;i:118;r:2187;i:119;r:2195;i:120;r:2203;i:121;r:2211;i:122;r:2219;i:123;r:2227;i:124;r:2235;i:125;r:2243;i:126;r:2251;i:127;r:2259;i:128;r:2267;i:129;r:2275;i:130;r:2283;i:131;r:2291;i:132;r:2299;i:133;r:2307;i:134;r:2315;i:135;r:2323;i:136;r:2331;i:137;r:2339;i:138;r:2347;i:139;r:2355;i:140;r:2363;i:141;r:2371;i:142;r:2379;i:143;r:2387;i:144;r:2395;i:145;r:2403;i:146;r:2411;i:147;r:2419;i:148;r:2427;i:149;r:2435;i:150;r:2443;i:151;r:2451;i:152;r:2459;i:153;r:2467;i:154;r:2475;i:155;r:2483;i:156;r:2491;i:157;r:2499;i:158;r:2507;i:159;r:2515;}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:17:\"\0*\0packageManager\";E:41:\"Laravel\\Roster\\Enums\\JsPackageManager:Npm\";}s:6:\"stacks\";O:30:\"Laravel\\Roster\\Support\\EnumSet\":1:{s:8:\"\0*\0cases\";a:1:{i:0;E:32:\"Laravel\\Roster\\Enums\\Stack:Blade\";}}s:21:\"browserTestFrameworks\";O:30:\"Laravel\\Roster\\Support\\EnumSet\":1:{s:8:\"\0*\0cases\";a:0:{}}s:9:\"frontends\";O:30:\"Laravel\\Roster\\Support\\EnumSet\":1:{s:8:\"\0*\0cases\";a:0:{}}s:6:\"agents\";O:30:\"Laravel\\Roster\\Support\\EnumSet\":1:{s:8:\"\0*\0cases\";a:1:{i:0;E:32:\"Laravel\\Roster\\Enums\\Agent:Codex\";}}s:7:\"editors\";O:30:\"Laravel\\Roster\\Support\\EnumSet\":1:{s:8:\"\0*\0cases\";a:0:{}}}', 1789537321);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `gaji_induk_pns`
--

CREATE TABLE `gaji_induk_pns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `golongan` varchar(255) DEFAULT NULL,
  `gaji_pokok` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_suami_istri` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_anak` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_jabatan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_fungsional` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_umum` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_beras` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_pph` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_bpjs` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_jkk` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_jkm` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_pembulatan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `kotor_sementara` decimal(15,2) NOT NULL DEFAULT 0.00,
  `kotor_resmi` decimal(15,2) NOT NULL DEFAULT 0.00,
  `potongan_iwp_1` decimal(15,2) NOT NULL DEFAULT 0.00,
  `potongan_iwp_8` decimal(15,2) NOT NULL DEFAULT 0.00,
  `potongan_bpjs` decimal(15,2) NOT NULL DEFAULT 0.00,
  `potongan_jkk` decimal(15,2) NOT NULL DEFAULT 0.00,
  `potongan_jkm` decimal(15,2) NOT NULL DEFAULT 0.00,
  `potongan_pph` decimal(15,2) NOT NULL DEFAULT 0.00,
  `jumlah_potongan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `bersih_sementara` decimal(15,2) NOT NULL DEFAULT 0.00,
  `bersih_resmi` decimal(15,2) NOT NULL DEFAULT 0.00,
  `is_locked` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gaji_induk_pns`
--

INSERT INTO `gaji_induk_pns` (`id`, `bulan`, `tahun`, `pegawai_id`, `nip`, `nama`, `golongan`, `gaji_pokok`, `tunjangan_suami_istri`, `tunjangan_anak`, `tunjangan_jabatan`, `tunjangan_fungsional`, `tunjangan_umum`, `tunjangan_beras`, `tunjangan_pph`, `tunjangan_bpjs`, `tunjangan_jkk`, `tunjangan_jkm`, `tunjangan_pembulatan`, `kotor_sementara`, `kotor_resmi`, `potongan_iwp_1`, `potongan_iwp_8`, `potongan_bpjs`, `potongan_jkk`, `potongan_jkm`, `potongan_pph`, `jumlah_potongan`, `bersih_sementara`, `bersih_resmi`, `is_locked`, `created_at`, `updated_at`) VALUES
(248, '01', '2026', 2, '197202051992031010', 'Amat Muslich, S.A.P', 'IV/a', 5075200.00, 507520.00, 101504.00, 980000.00, 0.00, 0.00, 217260.00, 53976.00, 266569.00, 12180.00, 36541.00, 96.00, 7250750.00, 7250846.00, 66642.00, 454738.00, 266569.00, 12180.00, 36541.00, 53976.00, 890646.00, 6360104.00, 6360200.00, 1, '2026-09-21 21:08:48', '2026-09-21 21:22:34'),
(249, '01', '2026', 3, '197311171999031006', 'Harry Rudiyanto, S.Kom, M.M', 'IV/b', 4971700.00, 497170.00, 198868.00, 980000.00, 0.00, 0.00, 289680.00, 54383.00, 265910.00, 11932.00, 35796.00, 78.00, 7305439.00, 7305517.00, 66477.00, 453419.00, 265910.00, 11932.00, 35796.00, 54383.00, 887917.00, 6417522.00, 6417600.00, 1, '2026-09-21 21:08:48', '2026-09-21 21:22:34'),
(250, '01', '2026', 4, '197406072007011008', 'Purnomo, S.H.', 'III/c', 4528900.00, 452890.00, 90578.00, 0.00, 0.00, 0.00, 217260.00, 0.00, 202895.00, 10869.00, 32608.00, 85.00, 5728400.00, 5536085.00, 50724.00, 405789.00, 202895.00, 10869.00, 32608.00, 0.00, 702885.00, 5016265.00, 4833200.00, 1, '2026-09-21 21:08:48', '2026-09-21 21:22:34'),
(251, '01', '2026', 5, '197407041997031004', 'Abdullah Yulianto', 'III/b', 4083900.00, 408390.00, 163356.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 193626.00, 9801.00, 29404.00, 32.00, 5363157.00, 5363189.00, 48406.00, 372452.00, 193626.00, 9801.00, 29404.00, 0.00, 653689.00, 4709468.00, 4709500.00, 1, '2026-09-21 21:08:48', '2026-09-21 21:22:34'),
(252, '01', '2026', 6, '197408122014062001', 'Vitta Adi Rosewaty Jengkar', 'II/c', 3606500.00, 360650.00, 0.00, 0.00, 0.00, 180000.00, 144840.00, 0.00, 165886.00, 8656.00, 25967.00, 54.00, 4492499.00, 4492553.00, 41472.00, 317372.00, 165886.00, 8656.00, 25967.00, 0.00, 559353.00, 3933146.00, 3933200.00, 1, '2026-09-21 21:08:48', '2026-09-21 21:22:34'),
(253, '01', '2026', 7, '198102232006042012', 'Riski Tessa Malela, S.E., MA', 'IV/b', 4819900.00, 481990.00, 192796.00, 0.00, 0.00, 190000.00, 289680.00, 46861.00, 227387.00, 11568.00, 34703.00, 56.00, 6294885.00, 6294941.00, 56847.00, 439575.00, 227387.00, 11568.00, 34703.00, 46861.00, 816941.00, 5477944.00, 5478000.00, 1, '2026-09-21 21:08:48', '2026-09-21 21:22:34'),
(254, '01', '2026', 8, '198102232009021003', 'Muhammad Muzni Kharis, A.Md', 'III/c', 3760100.00, 376010.00, 75202.00, 540000.00, 0.00, 0.00, 217260.00, 0.00, 190052.00, 9024.00, 27073.00, 46.00, 5194721.00, 5194767.00, 47513.00, 336905.00, 190052.00, 9024.00, 27073.00, 0.00, 610567.00, 4584154.00, 4584200.00, 1, '2026-09-21 21:08:48', '2026-09-21 21:22:34'),
(255, '01', '2026', 9, '198409272003121001', 'Sukirno, S.STP, M.M', 'IV/b', 4530100.00, 453010.00, 181204.00, 1260000.00, 0.00, 0.00, 289680.00, 52609.00, 256973.00, 10872.00, 32617.00, 94.00, 7067065.00, 7067159.00, 64243.00, 413145.00, 256973.00, 10872.00, 32617.00, 52609.00, 830459.00, 6236606.00, 6236700.00, 1, '2026-09-21 21:08:48', '2026-09-21 21:22:34'),
(256, '01', '2026', 10, '198612162020122008', 'Ratih Prasastianila Muna, A.Md', 'II/d', 2756800.00, 275680.00, 110272.00, 0.00, 0.00, 180000.00, 289680.00, 0.00, 132910.00, 6616.00, 19849.00, 16.00, 3771807.00, 3771823.00, 33228.00, 251420.00, 132910.00, 6616.00, 19849.00, 0.00, 444023.00, 3327784.00, 3327800.00, 1, '2026-09-21 21:08:48', '2026-09-21 21:22:34'),
(257, '01', '2026', 11, '198901092022031007', 'Yanuar Albab Baihaqi, S.E.Sy', 'III/a', 2873500.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 122340.00, 6896.00, 20689.00, 45.00, 3280845.00, 3280890.00, 30585.00, 229880.00, 122340.00, 6896.00, 20689.00, 0.00, 410390.00, 2870455.00, 2870500.00, 1, '2026-09-21 21:08:48', '2026-09-21 21:22:34'),
(258, '01', '2026', 12, '198910192020122011', 'Istikomah, S.E.', 'III/b', 3089300.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 130972.00, 7414.00, 22243.00, 67.00, 3507349.00, 3507416.00, 32743.00, 247144.00, 130972.00, 7414.00, 22243.00, 0.00, 440516.00, 3066833.00, 3066900.00, 1, '2026-09-21 21:08:48', '2026-09-21 21:22:34'),
(259, '01', '2026', 13, '199102052022031003', 'Ahmad Rozi, S.E.', 'III/a', 2873500.00, 287350.00, 57470.00, 0.00, 0.00, 185000.00, 217260.00, 0.00, 136133.00, 6896.00, 20689.00, 19.00, 3784298.00, 3784317.00, 34033.00, 257466.00, 136133.00, 6896.00, 20689.00, 0.00, 455217.00, 3329081.00, 3329100.00, 1, '2026-09-21 21:08:48', '2026-09-21 21:22:34'),
(260, '01', '2026', 14, '199210012020122013', 'Millatina Hanifah, S.E.Sy.', 'III/b', 3089300.00, 308930.00, 123572.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 148272.00, 7414.00, 22243.00, 30.00, 4174411.00, 4174441.00, 37068.00, 281744.00, 148272.00, 7414.00, 22243.00, 0.00, 496741.00, 3677670.00, 3677700.00, 1, '2026-09-21 21:08:48', '2026-09-21 21:22:34'),
(261, '01', '2026', 15, '199401252022032008', 'Wulan Suryani, A.Md.Kom', 'II/c', 2564200.00, 256420.00, 51284.00, 0.00, 0.00, 180000.00, 217260.00, 0.00, 122076.00, 6154.00, 18462.00, 7.00, 3415856.00, 3415863.00, 30519.00, 229752.00, 122076.00, 6154.00, 18462.00, 0.00, 406963.00, 3008893.00, 3008900.00, 1, '2026-09-21 21:08:48', '2026-09-21 21:22:34'),
(262, '01', '2026', 16, '199608132022032018', 'Noor Falaisifa, A.Md', 'II/c', 2564200.00, 0.00, 0.00, 0.00, 0.00, 180000.00, 72420.00, 0.00, 109768.00, 6154.00, 18462.00, 58.00, 2951004.00, 2951062.00, 27442.00, 205136.00, 109768.00, 6154.00, 18462.00, 0.00, 366962.00, 2584042.00, 2584100.00, 1, '2026-09-21 21:08:48', '2026-09-21 21:22:34'),
(263, '01', '2026', 17, '199609172022032021', 'Nur Hanifah, A.Md', 'II/c', 2564200.00, 256420.00, 51284.00, 0.00, 0.00, 180000.00, 217260.00, 0.00, 122076.00, 6154.00, 18462.00, 7.00, 3415856.00, 3415863.00, 30519.00, 229752.00, 122076.00, 6154.00, 18462.00, 0.00, 406963.00, 3008893.00, 3008900.00, 1, '2026-09-21 21:08:48', '2026-09-21 21:22:34'),
(264, '01', '2026', 18, '199610212025042002', 'Aqilatul Ulya, S.E', 'III/a', 2228560.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 96542.00, 5349.00, 16046.00, 41.00, 2603917.00, 2603958.00, 24136.00, 178285.00, 96542.00, 5349.00, 16046.00, 0.00, 320358.00, 2283559.00, 2283600.00, 1, '2026-09-21 21:08:48', '2026-09-21 21:22:34'),
(265, '01', '2026', 19, '199611152020122016', 'Nadya Ayu Popi Haluansa, S.E', 'III/b', 3089300.00, 308930.00, 123572.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 148272.00, 7414.00, 22243.00, 30.00, 4174411.00, 4174441.00, 37068.00, 281744.00, 148272.00, 7414.00, 22243.00, 0.00, 496741.00, 3677670.00, 3677700.00, 1, '2026-09-21 21:08:48', '2026-09-21 21:22:34'),
(266, '01', '2026', 20, '199801092022031007', 'Didik Yogo Suro Prasojo, S.Kom', 'III/a', 2873500.00, 287350.00, 0.00, 0.00, 540000.00, 0.00, 144840.00, 0.00, 148034.00, 6896.00, 20689.00, 87.00, 4021309.00, 4021396.00, 37009.00, 252868.00, 148034.00, 6896.00, 20689.00, 0.00, 465496.00, 3555813.00, 3555900.00, 1, '2026-09-21 21:08:48', '2026-09-21 21:22:34'),
(307, '02', '2026', 3, '197311171999031006', 'Harry Rudiyanto, S.Kom, M.M', 'IV/b', 4971700.00, 497170.00, 198868.00, 980000.00, 0.00, 0.00, 289680.00, 54383.00, 265910.00, 11932.00, 35796.00, 78.00, 7305439.00, 7305517.00, 66477.00, 453419.00, 265910.00, 11932.00, 35796.00, 54383.00, 887917.00, 6417522.00, 6417600.00, 1, '2026-09-21 21:36:02', '2026-09-21 21:36:19'),
(308, '02', '2026', 4, '197406072007011008', 'Purnomo, S.H.', 'III/c', 4528900.00, 452890.00, 90578.00, 0.00, 0.00, 185000.00, 217260.00, 0.00, 210295.00, 10869.00, 32608.00, 35.00, 5728400.00, 5728435.00, 52574.00, 405789.00, 210295.00, 10869.00, 32608.00, 0.00, 712135.00, 5016265.00, 5016300.00, 1, '2026-09-21 21:36:02', '2026-09-21 21:36:19'),
(309, '02', '2026', 5, '197407041997031004', 'Abdullah Yulianto', 'III/b', 4083900.00, 408390.00, 163356.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 193626.00, 9801.00, 29404.00, 32.00, 5363157.00, 5363189.00, 48406.00, 372452.00, 193626.00, 9801.00, 29404.00, 0.00, 653689.00, 4709468.00, 4709500.00, 1, '2026-09-21 21:36:02', '2026-09-21 21:36:19'),
(310, '02', '2026', 6, '197408122014062001', 'Vitta Adi Rosewaty Jengkar', 'II/c', 3606500.00, 360650.00, 0.00, 0.00, 0.00, 180000.00, 144840.00, 0.00, 165886.00, 8656.00, 25967.00, 54.00, 4492499.00, 4492553.00, 41472.00, 317372.00, 165886.00, 8656.00, 25967.00, 0.00, 559353.00, 3933146.00, 3933200.00, 1, '2026-09-21 21:36:02', '2026-09-21 21:36:19'),
(311, '02', '2026', 7, '198102232006042012', 'Riski Tessa Malela, S.E., MA', 'IV/b', 4819900.00, 481990.00, 192796.00, 0.00, 0.00, 190000.00, 289680.00, 46861.00, 227387.00, 11568.00, 34703.00, 56.00, 6294885.00, 6294941.00, 56847.00, 439575.00, 227387.00, 11568.00, 34703.00, 46861.00, 816941.00, 5477944.00, 5478000.00, 1, '2026-09-21 21:36:02', '2026-09-21 21:36:19'),
(312, '02', '2026', 8, '198102232009021003', 'Muhammad Muzni Kharis, A.Md', 'III/c', 3760100.00, 376010.00, 75202.00, 540000.00, 0.00, 0.00, 217260.00, 0.00, 190052.00, 9024.00, 27073.00, 46.00, 5194721.00, 5194767.00, 47513.00, 336905.00, 190052.00, 9024.00, 27073.00, 0.00, 610567.00, 4584154.00, 4584200.00, 1, '2026-09-21 21:36:02', '2026-09-21 21:36:19'),
(313, '02', '2026', 9, '198409272003121001', 'Sukirno, S.STP, M.M', 'IV/b', 4530100.00, 453010.00, 181204.00, 1260000.00, 0.00, 0.00, 289680.00, 52609.00, 256973.00, 10872.00, 32617.00, 94.00, 7067065.00, 7067159.00, 64243.00, 413145.00, 256973.00, 10872.00, 32617.00, 52609.00, 830459.00, 6236606.00, 6236700.00, 1, '2026-09-21 21:36:02', '2026-09-21 21:36:19'),
(314, '02', '2026', 10, '198612162020122008', 'Ratih Prasastianila Muna, A.Md', 'II/d', 2756800.00, 275680.00, 110272.00, 0.00, 0.00, 180000.00, 289680.00, 0.00, 132910.00, 6616.00, 19849.00, 16.00, 3771807.00, 3771823.00, 33228.00, 251420.00, 132910.00, 6616.00, 19849.00, 0.00, 444023.00, 3327784.00, 3327800.00, 1, '2026-09-21 21:36:02', '2026-09-21 21:36:19'),
(315, '02', '2026', 11, '198901092022031007', 'Yanuar Albab Baihaqi, S.E.Sy', 'III/a', 2873500.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 122340.00, 6896.00, 20689.00, 45.00, 3280845.00, 3280890.00, 30585.00, 229880.00, 122340.00, 6896.00, 20689.00, 0.00, 410390.00, 2870455.00, 2870500.00, 1, '2026-09-21 21:36:02', '2026-09-21 21:36:19'),
(316, '02', '2026', 12, '198910192020122011', 'Istikomah, S.E.', 'III/b', 3089300.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 130972.00, 7414.00, 22243.00, 67.00, 3507349.00, 3507416.00, 32743.00, 247144.00, 130972.00, 7414.00, 22243.00, 0.00, 440516.00, 3066833.00, 3066900.00, 1, '2026-09-21 21:36:02', '2026-09-21 21:36:19'),
(317, '02', '2026', 13, '199102052022031003', 'Ahmad Rozi, S.E.', 'III/a', 2873500.00, 287350.00, 57470.00, 0.00, 0.00, 185000.00, 217260.00, 0.00, 136133.00, 6896.00, 20689.00, 19.00, 3784298.00, 3784317.00, 34033.00, 257466.00, 136133.00, 6896.00, 20689.00, 0.00, 455217.00, 3329081.00, 3329100.00, 1, '2026-09-21 21:36:02', '2026-09-21 21:36:19'),
(318, '02', '2026', 14, '199210012020122013', 'Millatina Hanifah, S.E.Sy.', 'III/b', 3089300.00, 308930.00, 123572.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 148272.00, 7414.00, 22243.00, 30.00, 4174411.00, 4174441.00, 37068.00, 281744.00, 148272.00, 7414.00, 22243.00, 0.00, 496741.00, 3677670.00, 3677700.00, 1, '2026-09-21 21:36:02', '2026-09-21 21:36:19'),
(319, '02', '2026', 15, '199401252022032008', 'Wulan Suryani, A.Md.Kom', 'II/c', 2564200.00, 256420.00, 51284.00, 0.00, 0.00, 180000.00, 217260.00, 0.00, 122076.00, 6154.00, 18462.00, 7.00, 3415856.00, 3415863.00, 30519.00, 229752.00, 122076.00, 6154.00, 18462.00, 0.00, 406963.00, 3008893.00, 3008900.00, 1, '2026-09-21 21:36:02', '2026-09-21 21:36:19'),
(320, '02', '2026', 16, '199608132022032018', 'Noor Falaisifa, A.Md', 'II/c', 2564200.00, 0.00, 0.00, 0.00, 0.00, 180000.00, 72420.00, 0.00, 109768.00, 6154.00, 18462.00, 58.00, 2951004.00, 2951062.00, 27442.00, 205136.00, 109768.00, 6154.00, 18462.00, 0.00, 366962.00, 2584042.00, 2584100.00, 1, '2026-09-21 21:36:02', '2026-09-21 21:36:19'),
(321, '02', '2026', 17, '199609172022032021', 'Nur Hanifah, A.Md', 'II/c', 2564200.00, 256420.00, 51284.00, 0.00, 0.00, 180000.00, 217260.00, 0.00, 122076.00, 6154.00, 18462.00, 7.00, 3415856.00, 3415863.00, 30519.00, 229752.00, 122076.00, 6154.00, 18462.00, 0.00, 406963.00, 3008893.00, 3008900.00, 1, '2026-09-21 21:36:02', '2026-09-21 21:36:19'),
(322, '02', '2026', 18, '199610212025042002', 'Aqilatul Ulya, S.E', 'III/a', 2228560.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 96542.00, 5349.00, 16046.00, 41.00, 2603917.00, 2603958.00, 24136.00, 178285.00, 96542.00, 5349.00, 16046.00, 0.00, 320358.00, 2283559.00, 2283600.00, 1, '2026-09-21 21:36:02', '2026-09-21 21:36:19'),
(323, '02', '2026', 19, '199611152020122016', 'Nadya Ayu Popi Haluansa, S.E', 'III/b', 3089300.00, 308930.00, 123572.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 148272.00, 7414.00, 22243.00, 30.00, 4174411.00, 4174441.00, 37068.00, 281744.00, 148272.00, 7414.00, 22243.00, 0.00, 496741.00, 3677670.00, 3677700.00, 1, '2026-09-21 21:36:02', '2026-09-21 21:36:19'),
(324, '02', '2026', 20, '199801092022031007', 'Didik Yogo Suro Prasojo, S.Kom', 'III/a', 2873500.00, 287350.00, 0.00, 0.00, 540000.00, 0.00, 144840.00, 0.00, 148034.00, 6896.00, 20689.00, 87.00, 4021309.00, 4021396.00, 37009.00, 252868.00, 148034.00, 6896.00, 20689.00, 0.00, 465496.00, 3555813.00, 3555900.00, 1, '2026-09-21 21:36:02', '2026-09-21 21:36:19'),
(325, '02', '2026', 24, '197006161989031001', 'Ade Suangkat, S.E', 'IV/b', 5289800.00, 528980.00, 105796.00, 2025000.00, 0.00, 0.00, 217260.00, 85357.00, 317983.00, 12696.00, 38087.00, 26.00, 8620959.00, 8620985.00, 79496.00, 473966.00, 317983.00, 12696.00, 38087.00, 85357.00, 1007585.00, 7613374.00, 7613400.00, 1, '2026-09-21 21:36:02', '2026-09-21 21:36:19'),
(326, '03', '2026', 3, '197311171999031006', 'Harry Rudiyanto, S.Kom, M.M', 'IV/b', 4971700.00, 497170.00, 198868.00, 980000.00, 0.00, 0.00, 289680.00, 54383.00, 265910.00, 11932.00, 35796.00, 78.00, 7305439.00, 7305517.00, 66477.00, 453419.00, 265910.00, 11932.00, 35796.00, 54383.00, 887917.00, 6417522.00, 6417600.00, 1, '2026-09-21 21:40:56', '2026-09-21 21:41:53'),
(327, '03', '2026', 4, '197406072007011008', 'Purnomo, S.H.', 'III/c', 4528900.00, 452890.00, 90578.00, 0.00, 0.00, 185000.00, 217260.00, 0.00, 210295.00, 10869.00, 32608.00, 35.00, 5728400.00, 5728435.00, 52574.00, 405789.00, 210295.00, 10869.00, 32608.00, 0.00, 712135.00, 5016265.00, 5016300.00, 1, '2026-09-21 21:40:56', '2026-09-21 21:41:53'),
(328, '03', '2026', 6, '197408122014062001', 'Vitta Adi Rosewaty Jengkar', 'II/c', 3606500.00, 360650.00, 0.00, 0.00, 0.00, 180000.00, 144840.00, 0.00, 165886.00, 8656.00, 25967.00, 54.00, 4492499.00, 4492553.00, 41472.00, 317372.00, 165886.00, 8656.00, 25967.00, 0.00, 559353.00, 3933146.00, 3933200.00, 1, '2026-09-21 21:40:56', '2026-09-21 21:41:53'),
(329, '03', '2026', 7, '198102232006042012', 'Riski Tessa Malela, S.E., MA', 'IV/b', 4819900.00, 481990.00, 192796.00, 0.00, 0.00, 190000.00, 289680.00, 46861.00, 227387.00, 11568.00, 34703.00, 56.00, 6294885.00, 6294941.00, 56847.00, 439575.00, 227387.00, 11568.00, 34703.00, 46861.00, 816941.00, 5477944.00, 5478000.00, 1, '2026-09-21 21:40:56', '2026-09-21 21:41:53'),
(330, '03', '2026', 8, '198102232009021003', 'Muhammad Muzni Kharis, A.Md', 'III/c', 3760100.00, 376010.00, 75202.00, 540000.00, 0.00, 0.00, 217260.00, 0.00, 190052.00, 9024.00, 27073.00, 46.00, 5194721.00, 5194767.00, 47513.00, 336905.00, 190052.00, 9024.00, 27073.00, 0.00, 610567.00, 4584154.00, 4584200.00, 1, '2026-09-21 21:40:56', '2026-09-21 21:41:53'),
(331, '03', '2026', 9, '198409272003121001', 'Sukirno, S.STP, M.M', 'IV/b', 4530100.00, 453010.00, 181204.00, 1260000.00, 0.00, 0.00, 289680.00, 52609.00, 256973.00, 10872.00, 32617.00, 94.00, 7067065.00, 7067159.00, 64243.00, 413145.00, 256973.00, 10872.00, 32617.00, 52609.00, 830459.00, 6236606.00, 6236700.00, 1, '2026-09-21 21:40:56', '2026-09-21 21:41:53'),
(332, '03', '2026', 10, '198612162020122008', 'Ratih Prasastianila Muna, A.Md', 'II/d', 2756800.00, 275680.00, 110272.00, 0.00, 0.00, 180000.00, 289680.00, 0.00, 132910.00, 6616.00, 19849.00, 16.00, 3771807.00, 3771823.00, 33228.00, 251420.00, 132910.00, 6616.00, 19849.00, 0.00, 444023.00, 3327784.00, 3327800.00, 1, '2026-09-21 21:40:56', '2026-09-21 21:41:53'),
(333, '03', '2026', 11, '198901092022031007', 'Yanuar Albab Baihaqi, S.E.Sy', 'III/a', 2873500.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 122340.00, 6896.00, 20689.00, 45.00, 3280845.00, 3280890.00, 30585.00, 229880.00, 122340.00, 6896.00, 20689.00, 0.00, 410390.00, 2870455.00, 2870500.00, 1, '2026-09-21 21:40:56', '2026-09-21 21:41:53'),
(334, '03', '2026', 12, '198910192020122011', 'Istikomah, S.E.', 'III/b', 3089300.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 130972.00, 7414.00, 22243.00, 67.00, 3507349.00, 3507416.00, 32743.00, 247144.00, 130972.00, 7414.00, 22243.00, 0.00, 440516.00, 3066833.00, 3066900.00, 1, '2026-09-21 21:40:56', '2026-09-21 21:41:53'),
(335, '03', '2026', 13, '199102052022031003', 'Ahmad Rozi, S.E.', 'III/a', 2964000.00, 296400.00, 59280.00, 0.00, 0.00, 185000.00, 217260.00, 0.00, 140187.00, 7114.00, 21341.00, 81.00, 3890582.00, 3890663.00, 35047.00, 265574.00, 140187.00, 7114.00, 21341.00, 0.00, 469263.00, 3421319.00, 3421400.00, 1, '2026-09-21 21:40:56', '2026-09-21 21:41:53'),
(336, '03', '2026', 14, '199210012020122013', 'Millatina Hanifah, S.E.Sy.', 'III/b', 3089300.00, 308930.00, 123572.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 148272.00, 7414.00, 22243.00, 30.00, 4174411.00, 4174441.00, 37068.00, 281744.00, 148272.00, 7414.00, 22243.00, 0.00, 496741.00, 3677670.00, 3677700.00, 1, '2026-09-21 21:40:56', '2026-09-21 21:41:53'),
(337, '03', '2026', 15, '199401252022032008', 'Wulan Suryani, A.Md.Kom', 'II/c', 2564200.00, 256420.00, 51284.00, 0.00, 0.00, 180000.00, 217260.00, 0.00, 122076.00, 6154.00, 18462.00, 7.00, 3415856.00, 3415863.00, 30519.00, 229752.00, 122076.00, 6154.00, 18462.00, 0.00, 406963.00, 3008893.00, 3008900.00, 1, '2026-09-21 21:40:56', '2026-09-21 21:41:53'),
(338, '03', '2026', 16, '199608132022032018', 'Noor Falaisifa, A.Md', 'II/c', 2564200.00, 0.00, 0.00, 0.00, 0.00, 180000.00, 72420.00, 0.00, 109768.00, 6154.00, 18462.00, 58.00, 2951004.00, 2951062.00, 27442.00, 205136.00, 109768.00, 6154.00, 18462.00, 0.00, 366962.00, 2584042.00, 2584100.00, 1, '2026-09-21 21:40:56', '2026-09-21 21:41:53'),
(339, '03', '2026', 17, '199609172022032021', 'Nur Hanifah, A.Md', 'II/c', 2564200.00, 256420.00, 51284.00, 0.00, 0.00, 180000.00, 217260.00, 0.00, 122076.00, 6154.00, 18462.00, 7.00, 3415856.00, 3415863.00, 30519.00, 229752.00, 122076.00, 6154.00, 18462.00, 0.00, 406963.00, 3008893.00, 3008900.00, 1, '2026-09-21 21:40:56', '2026-09-21 21:41:53'),
(340, '03', '2026', 18, '199610212025042002', 'Aqilatul Ulya, S.E', 'III/a', 2228560.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 96542.00, 5349.00, 16046.00, 41.00, 2603917.00, 2603958.00, 24136.00, 178285.00, 96542.00, 5349.00, 16046.00, 0.00, 320358.00, 2283559.00, 2283600.00, 1, '2026-09-21 21:40:56', '2026-09-21 21:41:53'),
(341, '03', '2026', 19, '199611152020122016', 'Nadya Ayu Popi Haluansa, S.E', 'III/b', 3089300.00, 308930.00, 123572.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 148272.00, 7414.00, 22243.00, 30.00, 4174411.00, 4174441.00, 37068.00, 281744.00, 148272.00, 7414.00, 22243.00, 0.00, 496741.00, 3677670.00, 3677700.00, 1, '2026-09-21 21:40:56', '2026-09-21 21:41:53'),
(342, '03', '2026', 20, '199801092022031007', 'Didik Yogo Suro Prasojo, S.Kom', 'III/a', 2964000.00, 296400.00, 0.00, 0.00, 540000.00, 0.00, 144840.00, 0.00, 152016.00, 7114.00, 21341.00, 96.00, 4125711.00, 4125807.00, 38004.00, 260832.00, 152016.00, 7114.00, 21341.00, 0.00, 479307.00, 3646404.00, 3646500.00, 1, '2026-09-21 21:40:56', '2026-09-21 21:41:53'),
(343, '03', '2026', 24, '197006161989031001', 'Ade Suangkat, S.E', 'IV/b', 5289800.00, 528980.00, 105796.00, 2025000.00, 0.00, 0.00, 217260.00, 85357.00, 317983.00, 12696.00, 38087.00, 26.00, 8620959.00, 8620985.00, 79496.00, 473966.00, 317983.00, 12696.00, 38087.00, 85357.00, 1007585.00, 7613374.00, 7613400.00, 1, '2026-09-21 21:40:56', '2026-09-21 21:41:53'),
(362, '04', '2026', 3, '197311171999031006', 'Harry Rudiyanto, S.Kom, M.M', 'IV/b', 4971700.00, 497170.00, 198868.00, 980000.00, 0.00, 0.00, 289680.00, 54383.00, 265910.00, 11932.00, 35796.00, 78.00, 7305439.00, 7305517.00, 66477.00, 453419.00, 265910.00, 11932.00, 35796.00, 54383.00, 887917.00, 6417522.00, 6417600.00, 1, '2026-09-21 21:47:06', '2026-09-21 21:47:25'),
(363, '04', '2026', 4, '197406072007011008', 'Purnomo, S.H.', 'III/c', 4528900.00, 452890.00, 90578.00, 0.00, 0.00, 185000.00, 217260.00, 0.00, 210295.00, 10869.00, 32608.00, 35.00, 5728400.00, 5728435.00, 52574.00, 405789.00, 210295.00, 10869.00, 32608.00, 0.00, 712135.00, 5016265.00, 5016300.00, 1, '2026-09-21 21:47:06', '2026-09-21 21:47:25'),
(364, '04', '2026', 6, '197408122014062001', 'Vitta Adi Rosewaty Jengkar', 'II/c', 3606500.00, 360650.00, 0.00, 0.00, 0.00, 180000.00, 144840.00, 0.00, 165886.00, 8656.00, 25967.00, 54.00, 4492499.00, 4492553.00, 41472.00, 317372.00, 165886.00, 8656.00, 25967.00, 0.00, 559353.00, 3933146.00, 3933200.00, 1, '2026-09-21 21:47:06', '2026-09-21 21:47:25'),
(365, '04', '2026', 7, '198102232006042012', 'Riski Tessa Malela, S.E., MA', 'IV/b', 4819900.00, 481990.00, 192796.00, 0.00, 0.00, 190000.00, 289680.00, 46861.00, 227387.00, 11568.00, 34703.00, 56.00, 6294885.00, 6294941.00, 56847.00, 439575.00, 227387.00, 11568.00, 34703.00, 46861.00, 816941.00, 5477944.00, 5478000.00, 1, '2026-09-21 21:47:06', '2026-09-21 21:47:25'),
(366, '04', '2026', 8, '198102232009021003', 'Muhammad Muzni Kharis, A.Md', 'III/c', 3760100.00, 376010.00, 75202.00, 540000.00, 0.00, 0.00, 217260.00, 0.00, 190052.00, 9024.00, 27073.00, 46.00, 5194721.00, 5194767.00, 47513.00, 336905.00, 190052.00, 9024.00, 27073.00, 0.00, 610567.00, 4584154.00, 4584200.00, 1, '2026-09-21 21:47:06', '2026-09-21 21:47:25'),
(367, '04', '2026', 9, '198409272003121001', 'Sukirno, S.STP, M.M', 'IV/b', 4530100.00, 453010.00, 181204.00, 1260000.00, 0.00, 0.00, 289680.00, 52609.00, 256973.00, 10872.00, 32617.00, 94.00, 7067065.00, 7067159.00, 64243.00, 413145.00, 256973.00, 10872.00, 32617.00, 52609.00, 830459.00, 6236606.00, 6236700.00, 1, '2026-09-21 21:47:06', '2026-09-21 21:47:25'),
(368, '04', '2026', 10, '198612162020122008', 'Ratih Prasastianila Muna, A.Md', 'II/d', 2756800.00, 275680.00, 110272.00, 0.00, 0.00, 180000.00, 289680.00, 0.00, 132910.00, 6616.00, 19849.00, 16.00, 3771807.00, 3771823.00, 33228.00, 251420.00, 132910.00, 6616.00, 19849.00, 0.00, 444023.00, 3327784.00, 3327800.00, 1, '2026-09-21 21:47:06', '2026-09-21 21:47:25'),
(369, '04', '2026', 11, '198901092022031007', 'Yanuar Albab Baihaqi, S.E.Sy', 'III/b', 3089300.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 130972.00, 7414.00, 22243.00, 67.00, 3507349.00, 3507416.00, 32743.00, 247144.00, 130972.00, 7414.00, 22243.00, 0.00, 440516.00, 3066833.00, 3066900.00, 1, '2026-09-21 21:47:06', '2026-09-21 21:47:25'),
(370, '04', '2026', 12, '198910192020122011', 'Istikomah, S.E.', 'III/b', 3089300.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 130972.00, 7414.00, 22243.00, 67.00, 3507349.00, 3507416.00, 32743.00, 247144.00, 130972.00, 7414.00, 22243.00, 0.00, 440516.00, 3066833.00, 3066900.00, 1, '2026-09-21 21:47:06', '2026-09-21 21:47:25'),
(371, '04', '2026', 13, '199102052022031003', 'Ahmad Rozi, S.E.', 'III/a', 2964000.00, 296400.00, 59280.00, 0.00, 0.00, 185000.00, 217260.00, 0.00, 140187.00, 7114.00, 21341.00, 81.00, 3890582.00, 3890663.00, 35047.00, 265574.00, 140187.00, 7114.00, 21341.00, 0.00, 469263.00, 3421319.00, 3421400.00, 1, '2026-09-21 21:47:06', '2026-09-21 21:47:25'),
(372, '04', '2026', 14, '199210012020122013', 'Millatina Hanifah, S.E.Sy.', 'III/b', 3089300.00, 308930.00, 123572.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 148272.00, 7414.00, 22243.00, 30.00, 4174411.00, 4174441.00, 37068.00, 281744.00, 148272.00, 7414.00, 22243.00, 0.00, 496741.00, 3677670.00, 3677700.00, 1, '2026-09-21 21:47:06', '2026-09-21 21:47:25'),
(373, '04', '2026', 15, '199401252022032008', 'Wulan Suryani, A.Md.Kom', 'II/d', 2756800.00, 275680.00, 55136.00, 0.00, 0.00, 180000.00, 217260.00, 0.00, 130705.00, 6616.00, 19849.00, 9.00, 3642046.00, 3642055.00, 32676.00, 247009.00, 130705.00, 6616.00, 19849.00, 0.00, 436855.00, 3205191.00, 3205200.00, 1, '2026-09-21 21:47:06', '2026-09-21 21:47:25'),
(374, '04', '2026', 16, '199608132022032018', 'Noor Falaisifa, A.Md', 'II/d', 2756800.00, 0.00, 0.00, 0.00, 0.00, 180000.00, 72420.00, 0.00, 117472.00, 6616.00, 19849.00, 92.00, 3153157.00, 3153249.00, 29368.00, 220544.00, 117472.00, 6616.00, 19849.00, 0.00, 393849.00, 2759308.00, 2759400.00, 1, '2026-09-21 21:47:06', '2026-09-21 21:47:25'),
(375, '04', '2026', 17, '199609172022032021', 'Nur Hanifah, A.Md', 'II/d', 2756800.00, 275680.00, 55136.00, 0.00, 0.00, 180000.00, 217260.00, 0.00, 130705.00, 6616.00, 19849.00, 9.00, 3642046.00, 3642055.00, 32676.00, 247009.00, 130705.00, 6616.00, 19849.00, 0.00, 436855.00, 3205191.00, 3205200.00, 1, '2026-09-21 21:47:06', '2026-09-21 21:47:25'),
(376, '04', '2026', 18, '199610212025042002', 'Aqilatul Ulya, S.E', 'III/a', 2228560.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 96542.00, 5349.00, 16046.00, 41.00, 2603917.00, 2603958.00, 24136.00, 178285.00, 96542.00, 5349.00, 16046.00, 0.00, 320358.00, 2283559.00, 2283600.00, 1, '2026-09-21 21:47:06', '2026-09-21 21:47:25'),
(377, '04', '2026', 19, '199611152020122016', 'Nadya Ayu Popi Haluansa, S.E', 'III/b', 3089300.00, 308930.00, 123572.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 148272.00, 7414.00, 22243.00, 30.00, 4174411.00, 4174441.00, 37068.00, 281744.00, 148272.00, 7414.00, 22243.00, 0.00, 496741.00, 3677670.00, 3677700.00, 1, '2026-09-21 21:47:06', '2026-09-21 21:47:25'),
(378, '04', '2026', 20, '199801092022031007', 'Didik Yogo Suro Prasojo, S.Kom', 'III/a', 2964000.00, 296400.00, 0.00, 0.00, 540000.00, 0.00, 144840.00, 0.00, 152016.00, 7114.00, 21341.00, 96.00, 4125711.00, 4125807.00, 38004.00, 260832.00, 152016.00, 7114.00, 21341.00, 0.00, 479307.00, 3646404.00, 3646500.00, 1, '2026-09-21 21:47:06', '2026-09-21 21:47:25'),
(379, '04', '2026', 24, '197006161989031001', 'Ade Suangkat, S.E', 'IV/b', 5289800.00, 528980.00, 105796.00, 2025000.00, 0.00, 0.00, 217260.00, 85357.00, 317983.00, 12696.00, 38087.00, 26.00, 8620959.00, 8620985.00, 79496.00, 473966.00, 317983.00, 12696.00, 38087.00, 85357.00, 1007585.00, 7613374.00, 7613400.00, 1, '2026-09-21 21:47:06', '2026-09-21 21:47:25'),
(398, '05', '2026', 3, '197311171999031006', 'Harry Rudiyanto, S.Kom, M.M', 'IV/c', 5182000.00, 518200.00, 207280.00, 980000.00, 0.00, 0.00, 289680.00, 75024.00, 275499.00, 12437.00, 37310.00, 13.00, 7577430.00, 7577443.00, 68875.00, 472598.00, 275499.00, 12437.00, 37310.00, 75024.00, 941743.00, 6635687.00, 6635700.00, 1, '2026-09-21 22:00:04', '2026-09-21 22:03:06'),
(399, '05', '2026', 4, '197406072007011008', 'Purnomo, S.H.', 'III/c', 4528900.00, 452890.00, 90578.00, 0.00, 0.00, 185000.00, 217260.00, 0.00, 210295.00, 10869.00, 32608.00, 35.00, 5728400.00, 5728435.00, 52574.00, 405789.00, 210295.00, 10869.00, 32608.00, 0.00, 712135.00, 5016265.00, 5016300.00, 1, '2026-09-21 22:00:04', '2026-09-21 22:03:06'),
(400, '05', '2026', 6, '197408122014062001', 'Vitta Adi Rosewaty Jengkar', 'II/c', 3606500.00, 360650.00, 0.00, 0.00, 0.00, 180000.00, 144840.00, 0.00, 165886.00, 8656.00, 25967.00, 54.00, 4492499.00, 4492553.00, 41472.00, 317372.00, 165886.00, 8656.00, 25967.00, 0.00, 559353.00, 3933146.00, 3933200.00, 1, '2026-09-21 22:00:04', '2026-09-21 22:03:06'),
(401, '05', '2026', 7, '198102232006042012', 'Riski Tessa Malela, S.E., MA', 'IV/b', 4819900.00, 481990.00, 192796.00, 0.00, 0.00, 190000.00, 289680.00, 46860.00, 227387.00, 11568.00, 34703.00, 56.00, 6294884.00, 6294940.00, 56847.00, 439575.00, 227387.00, 11568.00, 34703.00, 46860.00, 816940.00, 5477944.00, 5478000.00, 1, '2026-09-21 22:00:04', '2026-09-21 22:03:06'),
(402, '05', '2026', 8, '198102232009021003', 'Muhammad Muzni Kharis, A.Md', 'III/c', 3760100.00, 376010.00, 75202.00, 540000.00, 0.00, 0.00, 217260.00, 0.00, 190052.00, 9024.00, 27073.00, 46.00, 5194721.00, 5194767.00, 47513.00, 336905.00, 190052.00, 9024.00, 27073.00, 0.00, 610567.00, 4584154.00, 4584200.00, 1, '2026-09-21 22:00:04', '2026-09-21 22:03:06'),
(403, '05', '2026', 9, '198409272003121001', 'Sukirno, S.STP, M.M', 'IV/b', 4530100.00, 453010.00, 181204.00, 1260000.00, 0.00, 0.00, 289680.00, 52608.00, 256973.00, 10872.00, 32617.00, 94.00, 7067064.00, 7067158.00, 64243.00, 413145.00, 256973.00, 10872.00, 32617.00, 52608.00, 830458.00, 6236606.00, 6236700.00, 1, '2026-09-21 22:00:04', '2026-09-21 22:03:06'),
(404, '05', '2026', 10, '198612162020122008', 'Ratih Prasastianila Muna, A.Md', 'II/d', 2756800.00, 275680.00, 110272.00, 0.00, 0.00, 180000.00, 289680.00, 0.00, 132910.00, 6616.00, 19849.00, 16.00, 3771807.00, 3771823.00, 33228.00, 251420.00, 132910.00, 6616.00, 19849.00, 0.00, 444023.00, 3327784.00, 3327800.00, 1, '2026-09-21 22:00:04', '2026-09-21 22:03:06'),
(405, '05', '2026', 11, '198901092022031007', 'Yanuar Albab Baihaqi, S.E.Sy', 'III/b', 3089300.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 130972.00, 7414.00, 22243.00, 67.00, 3507349.00, 3507416.00, 32743.00, 247144.00, 130972.00, 7414.00, 22243.00, 0.00, 440516.00, 3066833.00, 3066900.00, 1, '2026-09-21 22:00:04', '2026-09-21 22:03:06'),
(406, '05', '2026', 12, '198910192020122011', 'Istikomah, S.E.', 'III/b', 3089300.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 130972.00, 7414.00, 22243.00, 67.00, 3507349.00, 3507416.00, 32743.00, 247144.00, 130972.00, 7414.00, 22243.00, 0.00, 440516.00, 3066833.00, 3066900.00, 1, '2026-09-21 22:00:04', '2026-09-21 22:03:06'),
(407, '05', '2026', 13, '199102052022031003', 'Ahmad Rozi, S.E.', 'III/a', 2964000.00, 296400.00, 118560.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 142558.00, 7114.00, 21341.00, 17.00, 4024653.00, 4024670.00, 35640.00, 270317.00, 142558.00, 7114.00, 21341.00, 0.00, 476970.00, 3547683.00, 3547700.00, 1, '2026-09-21 22:00:04', '2026-09-21 22:03:06'),
(408, '05', '2026', 14, '199210012020122013', 'Millatina Hanifah, S.E.Sy.', 'III/b', 3089300.00, 308930.00, 123572.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 148272.00, 7414.00, 22243.00, 30.00, 4174411.00, 4174441.00, 37068.00, 281744.00, 148272.00, 7414.00, 22243.00, 0.00, 496741.00, 3677670.00, 3677700.00, 1, '2026-09-21 22:00:04', '2026-09-21 22:03:06'),
(409, '05', '2026', 15, '199401252022032008', 'Wulan Suryani, A.Md.Kom', 'II/d', 2756800.00, 275680.00, 55136.00, 0.00, 0.00, 180000.00, 217260.00, 0.00, 130705.00, 6616.00, 19849.00, 9.00, 3642046.00, 3642055.00, 32676.00, 247009.00, 130705.00, 6616.00, 19849.00, 0.00, 436855.00, 3205191.00, 3205200.00, 1, '2026-09-21 22:00:04', '2026-09-21 22:03:06'),
(410, '05', '2026', 16, '199608132022032018', 'Noor Falaisifa, A.Md', 'II/d', 2756800.00, 0.00, 0.00, 0.00, 0.00, 180000.00, 72420.00, 0.00, 117472.00, 6616.00, 19849.00, 92.00, 3153157.00, 3153249.00, 29368.00, 220544.00, 117472.00, 6616.00, 19849.00, 0.00, 393849.00, 2759308.00, 2759400.00, 1, '2026-09-21 22:00:04', '2026-09-21 22:03:06'),
(411, '05', '2026', 17, '199609172022032021', 'Nur Hanifah, A.Md', 'II/d', 2756800.00, 275680.00, 55136.00, 0.00, 0.00, 180000.00, 217260.00, 0.00, 130705.00, 6616.00, 19849.00, 9.00, 3642046.00, 3642055.00, 32676.00, 247009.00, 130705.00, 6616.00, 19849.00, 0.00, 436855.00, 3205191.00, 3205200.00, 1, '2026-09-21 22:00:04', '2026-09-21 22:03:06'),
(412, '05', '2026', 18, '199610212025042002', 'Aqilatul Ulya, S.E', 'III/a', 2785700.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 118828.00, 6686.00, 20057.00, 43.00, 3188691.00, 3188734.00, 29707.00, 222856.00, 118828.00, 6686.00, 20057.00, 0.00, 398134.00, 2790557.00, 2790600.00, 1, '2026-09-21 22:00:04', '2026-09-21 22:03:06'),
(413, '05', '2026', 19, '199611152020122016', 'Nadya Ayu Popi Haluansa, S.E', 'III/b', 3089300.00, 308930.00, 123572.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 148272.00, 7414.00, 22243.00, 30.00, 4174411.00, 4174441.00, 37068.00, 281744.00, 148272.00, 7414.00, 22243.00, 0.00, 496741.00, 3677670.00, 3677700.00, 1, '2026-09-21 22:00:04', '2026-09-21 22:03:06'),
(414, '05', '2026', 20, '199801092022031007', 'Didik Yogo Suro Prasojo, S.Kom', 'III/a', 2964000.00, 296400.00, 0.00, 0.00, 540000.00, 0.00, 144840.00, 0.00, 152016.00, 7114.00, 21341.00, 96.00, 4125711.00, 4125807.00, 38004.00, 260832.00, 152016.00, 7114.00, 21341.00, 0.00, 479307.00, 3646404.00, 3646500.00, 1, '2026-09-21 22:00:04', '2026-09-21 22:03:06'),
(415, '05', '2026', 24, '197006161989031001', 'Ade Suangkat, S.E', 'IV/b', 5289800.00, 528980.00, 105796.00, 2025000.00, 0.00, 0.00, 217260.00, 85356.00, 317983.00, 12696.00, 38087.00, 26.00, 8620958.00, 8620984.00, 79496.00, 473966.00, 317983.00, 12696.00, 38087.00, 85356.00, 1007584.00, 7613374.00, 7613400.00, 1, '2026-09-21 22:00:04', '2026-09-21 22:03:06'),
(450, '06', '2026', 3, '197311171999031006', 'Harry Rudiyanto, S.Kom, M.M', 'IV/c', 5182000.00, 518200.00, 207280.00, 1260000.00, 0.00, 0.00, 289680.00, 77937.00, 286699.00, 12437.00, 37310.00, 13.00, 7871543.00, 7871556.00, 71675.00, 472598.00, 286699.00, 12437.00, 37310.00, 77937.00, 958656.00, 6912887.00, 6912900.00, 1, '2026-09-21 22:18:58', '2026-09-21 22:19:16'),
(451, '06', '2026', 4, '197406072007011008', 'Purnomo, S.H.', 'III/c', 4528900.00, 452890.00, 90578.00, 0.00, 0.00, 185000.00, 217260.00, 0.00, 210295.00, 10869.00, 32608.00, 35.00, 5728400.00, 5728435.00, 52574.00, 405789.00, 210295.00, 10869.00, 32608.00, 0.00, 712135.00, 5016265.00, 5016300.00, 1, '2026-09-21 22:18:58', '2026-09-21 22:19:16'),
(452, '06', '2026', 6, '197408122014062001', 'Vitta Adi Rosewaty Jengkar', 'II/c', 3606500.00, 360650.00, 0.00, 0.00, 0.00, 180000.00, 144840.00, 0.00, 165886.00, 8656.00, 25967.00, 54.00, 4492499.00, 4492553.00, 41472.00, 317372.00, 165886.00, 8656.00, 25967.00, 0.00, 559353.00, 3933146.00, 3933200.00, 1, '2026-09-21 22:18:58', '2026-09-21 22:19:16'),
(453, '06', '2026', 7, '198102232006042012', 'Riski Tessa Malela, S.E., MA', 'IV/b', 4819900.00, 481990.00, 192796.00, 0.00, 0.00, 190000.00, 289680.00, 46861.00, 227387.00, 11568.00, 34703.00, 56.00, 6294885.00, 6294941.00, 56847.00, 439575.00, 227387.00, 11568.00, 34703.00, 46861.00, 816941.00, 5477944.00, 5478000.00, 1, '2026-09-21 22:18:58', '2026-09-21 22:19:16'),
(454, '06', '2026', 8, '198102232009021003', 'Muhammad Muzni Kharis, A.Md', 'III/c', 3760100.00, 376010.00, 75202.00, 540000.00, 0.00, 0.00, 217260.00, 0.00, 190052.00, 9024.00, 27073.00, 46.00, 5194721.00, 5194767.00, 47513.00, 336905.00, 190052.00, 9024.00, 27073.00, 0.00, 610567.00, 4584154.00, 4584200.00, 1, '2026-09-21 22:18:58', '2026-09-21 22:19:16'),
(455, '06', '2026', 10, '198612162020122008', 'Ratih Prasastianila Muna, A.Md', 'II/d', 2756800.00, 275680.00, 110272.00, 0.00, 0.00, 180000.00, 289680.00, 0.00, 132910.00, 6616.00, 19849.00, 16.00, 3771807.00, 3771823.00, 33228.00, 251420.00, 132910.00, 6616.00, 19849.00, 0.00, 444023.00, 3327784.00, 3327800.00, 1, '2026-09-21 22:18:58', '2026-09-21 22:19:16'),
(456, '06', '2026', 11, '198901092022031007', 'Yanuar Albab Baihaqi, S.E.Sy', 'III/b', 3089300.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 130972.00, 7414.00, 22243.00, 67.00, 3507349.00, 3507416.00, 32743.00, 247144.00, 130972.00, 7414.00, 22243.00, 0.00, 440516.00, 3066833.00, 3066900.00, 1, '2026-09-21 22:18:58', '2026-09-21 22:19:16'),
(457, '06', '2026', 12, '198910192020122011', 'Istikomah, S.E.', 'III/b', 3089300.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 130972.00, 7414.00, 22243.00, 67.00, 3507349.00, 3507416.00, 32743.00, 247144.00, 130972.00, 7414.00, 22243.00, 0.00, 440516.00, 3066833.00, 3066900.00, 1, '2026-09-21 22:18:58', '2026-09-21 22:19:16'),
(458, '06', '2026', 13, '199102052022031003', 'Ahmad Rozi, S.E.', 'III/a', 2964000.00, 296400.00, 118560.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 142558.00, 7114.00, 21341.00, 17.00, 4024653.00, 4024670.00, 35640.00, 270317.00, 142558.00, 7114.00, 21341.00, 0.00, 476970.00, 3547683.00, 3547700.00, 1, '2026-09-21 22:18:58', '2026-09-21 22:19:16'),
(459, '06', '2026', 14, '199210012020122013', 'Millatina Hanifah, S.E.Sy.', 'III/b', 3089300.00, 308930.00, 123572.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 148272.00, 7414.00, 22243.00, 30.00, 4174411.00, 4174441.00, 37068.00, 281744.00, 148272.00, 7414.00, 22243.00, 0.00, 496741.00, 3677670.00, 3677700.00, 1, '2026-09-21 22:18:58', '2026-09-21 22:19:16'),
(460, '06', '2026', 15, '199401252022032008', 'Wulan Suryani, A.Md.Kom', 'II/d', 2756800.00, 275680.00, 55136.00, 0.00, 0.00, 180000.00, 217260.00, 0.00, 130705.00, 6616.00, 19849.00, 9.00, 3642046.00, 3642055.00, 32676.00, 247009.00, 130705.00, 6616.00, 19849.00, 0.00, 436855.00, 3205191.00, 3205200.00, 1, '2026-09-21 22:18:58', '2026-09-21 22:19:16'),
(461, '06', '2026', 16, '199608132022032018', 'Noor Falaisifa, A.Md', 'II/d', 2756800.00, 0.00, 0.00, 0.00, 0.00, 180000.00, 72420.00, 0.00, 117472.00, 6616.00, 19849.00, 92.00, 3153157.00, 3153249.00, 29368.00, 220544.00, 117472.00, 6616.00, 19849.00, 0.00, 393849.00, 2759308.00, 2759400.00, 1, '2026-09-21 22:18:58', '2026-09-21 22:19:16'),
(462, '06', '2026', 17, '199609172022032021', 'Nur Hanifah, A.Md', 'II/d', 2756800.00, 275680.00, 55136.00, 0.00, 0.00, 180000.00, 217260.00, 0.00, 130705.00, 6616.00, 19849.00, 9.00, 3642046.00, 3642055.00, 32676.00, 247009.00, 130705.00, 6616.00, 19849.00, 0.00, 436855.00, 3205191.00, 3205200.00, 1, '2026-09-21 22:18:58', '2026-09-21 22:19:16'),
(463, '06', '2026', 18, '199610212025042002', 'Aqilatul Ulya, S.E', 'III/a', 2785700.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 118828.00, 6686.00, 20057.00, 43.00, 3188691.00, 3188734.00, 29707.00, 222856.00, 118828.00, 6686.00, 20057.00, 0.00, 398134.00, 2790557.00, 2790600.00, 1, '2026-09-21 22:18:58', '2026-09-21 22:19:16'),
(464, '06', '2026', 19, '199611152020122016', 'Nadya Ayu Popi Haluansa, S.E', 'III/b', 3089300.00, 308930.00, 123572.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 148272.00, 7414.00, 22243.00, 30.00, 4174411.00, 4174441.00, 37068.00, 281744.00, 148272.00, 7414.00, 22243.00, 0.00, 496741.00, 3677670.00, 3677700.00, 1, '2026-09-21 22:18:58', '2026-09-21 22:19:16'),
(465, '06', '2026', 20, '199801092022031007', 'Didik Yogo Suro Prasojo, S.Kom', 'III/b', 3089300.00, 308930.00, 0.00, 0.00, 540000.00, 0.00, 144840.00, 0.00, 157529.00, 7414.00, 22243.00, 70.00, 4270256.00, 4270326.00, 39382.00, 271858.00, 157529.00, 7414.00, 22243.00, 0.00, 498426.00, 3771830.00, 3771900.00, 1, '2026-09-21 22:18:58', '2026-09-21 22:19:16'),
(466, '06', '2026', 24, '197006161989031001', 'Ade Suangkat, S.E', 'IV/b', 5289800.00, 528980.00, 105796.00, 2025000.00, 0.00, 0.00, 217260.00, 85357.00, 317983.00, 12696.00, 38087.00, 26.00, 8620959.00, 8620985.00, 79496.00, 473966.00, 317983.00, 12696.00, 38087.00, 85357.00, 1007585.00, 7613374.00, 7613400.00, 1, '2026-09-21 22:18:58', '2026-09-21 22:19:16'),
(467, '07', '2026', 3, '197311171999031006', 'Harry Rudiyanto, S.Kom, M.M', 'IV/c', 5182000.00, 518200.00, 207280.00, 1260000.00, 0.00, 0.00, 289680.00, 77937.00, 286699.00, 12437.00, 37310.00, 13.00, 7871543.00, 7871556.00, 71675.00, 472598.00, 286699.00, 12437.00, 37310.00, 77937.00, 958656.00, 6912887.00, 6912900.00, 1, '2026-09-21 22:24:02', '2026-09-21 22:24:48'),
(468, '07', '2026', 4, '197406072007011008', 'Purnomo, S.H.', 'III/c', 4528900.00, 452890.00, 90578.00, 0.00, 0.00, 185000.00, 217260.00, 0.00, 210295.00, 10869.00, 32608.00, 35.00, 5728400.00, 5728435.00, 52574.00, 405789.00, 210295.00, 10869.00, 32608.00, 0.00, 712135.00, 5016265.00, 5016300.00, 1, '2026-09-21 22:24:02', '2026-09-21 22:24:48'),
(469, '07', '2026', 6, '197408122014062001', 'Vitta Adi Rosewaty Jengkar', 'II/c', 3606500.00, 360650.00, 0.00, 0.00, 0.00, 180000.00, 144840.00, 0.00, 165886.00, 8656.00, 25967.00, 54.00, 4492499.00, 4492553.00, 41472.00, 317372.00, 165886.00, 8656.00, 25967.00, 0.00, 559353.00, 3933146.00, 3933200.00, 1, '2026-09-21 22:24:02', '2026-09-21 22:24:48'),
(470, '07', '2026', 7, '198102232006042012', 'Riski Tessa Malela, S.E., MA', 'IV/b', 4819900.00, 481990.00, 192796.00, 0.00, 0.00, 190000.00, 289680.00, 46861.00, 227387.00, 11568.00, 34703.00, 56.00, 6294885.00, 6294941.00, 56847.00, 439575.00, 227387.00, 11568.00, 34703.00, 46861.00, 816941.00, 5477944.00, 5478000.00, 1, '2026-09-21 22:24:02', '2026-09-21 22:24:48'),
(471, '07', '2026', 8, '198102232009021003', 'Muhammad Muzni Kharis, A.Md', 'III/c', 3760100.00, 376010.00, 75202.00, 540000.00, 0.00, 0.00, 217260.00, 0.00, 190052.00, 9024.00, 27073.00, 46.00, 5194721.00, 5194767.00, 47513.00, 336905.00, 190052.00, 9024.00, 27073.00, 0.00, 610567.00, 4584154.00, 4584200.00, 1, '2026-09-21 22:24:02', '2026-09-21 22:24:48'),
(472, '07', '2026', 10, '198612162020122008', 'Ratih Prasastianila Muna, A.Md', 'II/d', 2756800.00, 275680.00, 110272.00, 0.00, 0.00, 180000.00, 289680.00, 0.00, 132910.00, 6616.00, 19849.00, 16.00, 3771807.00, 3771823.00, 33228.00, 251420.00, 132910.00, 6616.00, 19849.00, 0.00, 444023.00, 3327784.00, 3327800.00, 1, '2026-09-21 22:24:02', '2026-09-21 22:24:48'),
(473, '07', '2026', 11, '198901092022031007', 'Yanuar Albab Baihaqi, S.E.Sy', 'III/b', 3089300.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 130972.00, 7414.00, 22243.00, 67.00, 3507349.00, 3507416.00, 32743.00, 247144.00, 130972.00, 7414.00, 22243.00, 0.00, 440516.00, 3066833.00, 3066900.00, 1, '2026-09-21 22:24:02', '2026-09-21 22:24:48'),
(474, '07', '2026', 12, '198910192020122011', 'Istikomah, S.E.', 'III/b', 3089300.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 130972.00, 7414.00, 22243.00, 67.00, 3507349.00, 3507416.00, 32743.00, 247144.00, 130972.00, 7414.00, 22243.00, 0.00, 440516.00, 3066833.00, 3066900.00, 1, '2026-09-21 22:24:02', '2026-09-21 22:24:48'),
(475, '07', '2026', 13, '199102052022031003', 'Ahmad Rozi, S.E.', 'III/a', 2964000.00, 296400.00, 118560.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 142558.00, 7114.00, 21341.00, 17.00, 4024653.00, 4024670.00, 35640.00, 270317.00, 142558.00, 7114.00, 21341.00, 0.00, 476970.00, 3547683.00, 3547700.00, 1, '2026-09-21 22:24:02', '2026-09-21 22:24:48'),
(476, '07', '2026', 14, '199210012020122013', 'Millatina Hanifah, S.E.Sy.', 'III/b', 3089300.00, 308930.00, 123572.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 148272.00, 7414.00, 22243.00, 30.00, 4174411.00, 4174441.00, 37068.00, 281744.00, 148272.00, 7414.00, 22243.00, 0.00, 496741.00, 3677670.00, 3677700.00, 1, '2026-09-21 22:24:02', '2026-09-21 22:24:48'),
(477, '07', '2026', 15, '199401252022032008', 'Wulan Suryani, A.Md.Kom', 'II/d', 2756800.00, 275680.00, 55136.00, 0.00, 0.00, 180000.00, 217260.00, 0.00, 130705.00, 6616.00, 19849.00, 9.00, 3642046.00, 3642055.00, 32676.00, 247009.00, 130705.00, 6616.00, 19849.00, 0.00, 436855.00, 3205191.00, 3205200.00, 1, '2026-09-21 22:24:02', '2026-09-21 22:24:48'),
(478, '07', '2026', 16, '199608132022032018', 'Noor Falaisifa, A.Md', 'II/d', 2756800.00, 0.00, 0.00, 0.00, 0.00, 180000.00, 72420.00, 0.00, 117472.00, 6616.00, 19849.00, 92.00, 3153157.00, 3153249.00, 29368.00, 220544.00, 117472.00, 6616.00, 19849.00, 0.00, 393849.00, 2759308.00, 2759400.00, 1, '2026-09-21 22:24:02', '2026-09-21 22:24:48'),
(479, '07', '2026', 17, '199609172022032021', 'Nur Hanifah, A.Md', 'II/d', 2756800.00, 275680.00, 55136.00, 0.00, 0.00, 180000.00, 217260.00, 0.00, 130705.00, 6616.00, 19849.00, 9.00, 3642046.00, 3642055.00, 32676.00, 247009.00, 130705.00, 6616.00, 19849.00, 0.00, 436855.00, 3205191.00, 3205200.00, 1, '2026-09-21 22:24:02', '2026-09-21 22:24:48'),
(480, '07', '2026', 18, '199610212025042002', 'Aqilatul Ulya, S.E', 'III/a', 2785700.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 118828.00, 6686.00, 20057.00, 43.00, 3188691.00, 3188734.00, 29707.00, 222856.00, 118828.00, 6686.00, 20057.00, 0.00, 398134.00, 2790557.00, 2790600.00, 1, '2026-09-21 22:24:02', '2026-09-21 22:24:48'),
(481, '07', '2026', 19, '199611152020122016', 'Nadya Ayu Popi Haluansa, S.E', 'III/b', 3089300.00, 308930.00, 123572.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 148272.00, 7414.00, 22243.00, 30.00, 4174411.00, 4174441.00, 37068.00, 281744.00, 148272.00, 7414.00, 22243.00, 0.00, 496741.00, 3677670.00, 3677700.00, 1, '2026-09-21 22:24:02', '2026-09-21 22:24:48'),
(482, '07', '2026', 20, '199801092022031007', 'Didik Yogo Suro Prasojo, S.Kom', 'III/b', 3089300.00, 308930.00, 0.00, 0.00, 540000.00, 0.00, 144840.00, 0.00, 157529.00, 7414.00, 22243.00, 70.00, 4270256.00, 4270326.00, 39382.00, 271858.00, 157529.00, 7414.00, 22243.00, 0.00, 498426.00, 3771830.00, 3771900.00, 1, '2026-09-21 22:24:02', '2026-09-21 22:24:48'),
(483, '07', '2026', 24, '197006161989031001', 'Ade Suangkat, S.E', 'IV/b', 5289800.00, 528980.00, 105796.00, 2025000.00, 0.00, 0.00, 217260.00, 85357.00, 317983.00, 12696.00, 38087.00, 26.00, 8620959.00, 8620985.00, 79496.00, 473966.00, 317983.00, 12696.00, 38087.00, 85357.00, 1007585.00, 7613374.00, 7613400.00, 1, '2026-09-21 22:24:02', '2026-09-21 22:24:48'),
(484, '08', '2026', 3, '197311171999031006', 'Harry Rudiyanto, S.Kom, M.M', 'IV/c', 5182000.00, 518200.00, 207280.00, 1260000.00, 0.00, 0.00, 289680.00, 77937.00, 286699.00, 12437.00, 37310.00, 13.00, 7871543.00, 7871556.00, 71675.00, 472598.00, 286699.00, 12437.00, 37310.00, 77937.00, 958656.00, 6912887.00, 6912900.00, 1, '2026-09-21 22:24:54', '2026-09-21 22:25:31'),
(485, '08', '2026', 4, '197406072007011008', 'Purnomo, S.H.', 'III/c', 4528900.00, 452890.00, 90578.00, 0.00, 0.00, 185000.00, 217260.00, 0.00, 210295.00, 10869.00, 32608.00, 35.00, 5728400.00, 5728435.00, 52574.00, 405789.00, 210295.00, 10869.00, 32608.00, 0.00, 712135.00, 5016265.00, 5016300.00, 1, '2026-09-21 22:24:54', '2026-09-21 22:25:31'),
(486, '08', '2026', 6, '197408122014062001', 'Vitta Adi Rosewaty Jengkar', 'II/c', 3606500.00, 360650.00, 0.00, 0.00, 0.00, 180000.00, 144840.00, 0.00, 165886.00, 8656.00, 25967.00, 54.00, 4492499.00, 4492553.00, 41472.00, 317372.00, 165886.00, 8656.00, 25967.00, 0.00, 559353.00, 3933146.00, 3933200.00, 1, '2026-09-21 22:24:54', '2026-09-21 22:25:31'),
(487, '08', '2026', 7, '198102232006042012', 'Riski Tessa Malela, S.E., MA', 'IV/b', 4819900.00, 481990.00, 192796.00, 0.00, 0.00, 190000.00, 289680.00, 46861.00, 227387.00, 11568.00, 34703.00, 56.00, 6294885.00, 6294941.00, 56847.00, 439575.00, 227387.00, 11568.00, 34703.00, 46861.00, 816941.00, 5477944.00, 5478000.00, 1, '2026-09-21 22:24:54', '2026-09-21 22:25:31'),
(488, '08', '2026', 8, '198102232009021003', 'Muhammad Muzni Kharis, A.Md', 'III/c', 3760100.00, 376010.00, 75202.00, 540000.00, 0.00, 0.00, 217260.00, 0.00, 190052.00, 9024.00, 27073.00, 46.00, 5194721.00, 5194767.00, 47513.00, 336905.00, 190052.00, 9024.00, 27073.00, 0.00, 610567.00, 4584154.00, 4584200.00, 1, '2026-09-21 22:24:54', '2026-09-21 22:25:31'),
(489, '08', '2026', 10, '198612162020122008', 'Ratih Prasastianila Muna, A.Md', 'II/d', 2756800.00, 275680.00, 110272.00, 0.00, 0.00, 180000.00, 289680.00, 0.00, 132910.00, 6616.00, 19849.00, 16.00, 3771807.00, 3771823.00, 33228.00, 251420.00, 132910.00, 6616.00, 19849.00, 0.00, 444023.00, 3327784.00, 3327800.00, 1, '2026-09-21 22:24:54', '2026-09-21 22:25:31'),
(490, '08', '2026', 11, '198901092022031007', 'Yanuar Albab Baihaqi, S.E.Sy', 'III/b', 3089300.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 130972.00, 7414.00, 22243.00, 67.00, 3507349.00, 3507416.00, 32743.00, 247144.00, 130972.00, 7414.00, 22243.00, 0.00, 440516.00, 3066833.00, 3066900.00, 1, '2026-09-21 22:24:54', '2026-09-21 22:25:31'),
(491, '08', '2026', 12, '198910192020122011', 'Istikomah, S.E.', 'III/b', 3089300.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 130972.00, 7414.00, 22243.00, 67.00, 3507349.00, 3507416.00, 32743.00, 247144.00, 130972.00, 7414.00, 22243.00, 0.00, 440516.00, 3066833.00, 3066900.00, 1, '2026-09-21 22:24:54', '2026-09-21 22:25:31'),
(492, '08', '2026', 13, '199102052022031003', 'Ahmad Rozi, S.E.', 'III/a', 2964000.00, 296400.00, 118560.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 142558.00, 7114.00, 21341.00, 17.00, 4024653.00, 4024670.00, 35640.00, 270317.00, 142558.00, 7114.00, 21341.00, 0.00, 476970.00, 3547683.00, 3547700.00, 1, '2026-09-21 22:24:54', '2026-09-21 22:25:31'),
(493, '08', '2026', 14, '199210012020122013', 'Millatina Hanifah, S.E.Sy.', 'III/b', 3089300.00, 308930.00, 123572.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 148272.00, 7414.00, 22243.00, 30.00, 4174411.00, 4174441.00, 37068.00, 281744.00, 148272.00, 7414.00, 22243.00, 0.00, 496741.00, 3677670.00, 3677700.00, 1, '2026-09-21 22:24:54', '2026-09-21 22:25:31'),
(494, '08', '2026', 15, '199401252022032008', 'Wulan Suryani, A.Md.Kom', 'II/d', 2756800.00, 275680.00, 55136.00, 0.00, 0.00, 180000.00, 217260.00, 0.00, 130705.00, 6616.00, 19849.00, 9.00, 3642046.00, 3642055.00, 32676.00, 247009.00, 130705.00, 6616.00, 19849.00, 0.00, 436855.00, 3205191.00, 3205200.00, 1, '2026-09-21 22:24:54', '2026-09-21 22:25:31'),
(495, '08', '2026', 16, '199608132022032018', 'Noor Falaisifa, A.Md', 'II/d', 2756800.00, 0.00, 0.00, 0.00, 0.00, 180000.00, 72420.00, 0.00, 117472.00, 6616.00, 19849.00, 92.00, 3153157.00, 3153249.00, 29368.00, 220544.00, 117472.00, 6616.00, 19849.00, 0.00, 393849.00, 2759308.00, 2759400.00, 1, '2026-09-21 22:24:54', '2026-09-21 22:25:31'),
(496, '08', '2026', 17, '199609172022032021', 'Nur Hanifah, A.Md', 'II/d', 2756800.00, 275680.00, 55136.00, 0.00, 0.00, 180000.00, 217260.00, 0.00, 130705.00, 6616.00, 19849.00, 9.00, 3642046.00, 3642055.00, 32676.00, 247009.00, 130705.00, 6616.00, 19849.00, 0.00, 436855.00, 3205191.00, 3205200.00, 1, '2026-09-21 22:24:54', '2026-09-21 22:25:31');
INSERT INTO `gaji_induk_pns` (`id`, `bulan`, `tahun`, `pegawai_id`, `nip`, `nama`, `golongan`, `gaji_pokok`, `tunjangan_suami_istri`, `tunjangan_anak`, `tunjangan_jabatan`, `tunjangan_fungsional`, `tunjangan_umum`, `tunjangan_beras`, `tunjangan_pph`, `tunjangan_bpjs`, `tunjangan_jkk`, `tunjangan_jkm`, `tunjangan_pembulatan`, `kotor_sementara`, `kotor_resmi`, `potongan_iwp_1`, `potongan_iwp_8`, `potongan_bpjs`, `potongan_jkk`, `potongan_jkm`, `potongan_pph`, `jumlah_potongan`, `bersih_sementara`, `bersih_resmi`, `is_locked`, `created_at`, `updated_at`) VALUES
(497, '08', '2026', 18, '199610212025042002', 'Aqilatul Ulya, S.E', 'III/a', 2785700.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 118828.00, 6686.00, 20057.00, 43.00, 3188691.00, 3188734.00, 29707.00, 222856.00, 118828.00, 6686.00, 20057.00, 0.00, 398134.00, 2790557.00, 2790600.00, 1, '2026-09-21 22:24:54', '2026-09-21 22:25:31'),
(498, '08', '2026', 19, '199611152020122016', 'Nadya Ayu Popi Haluansa, S.E', 'III/b', 3089300.00, 308930.00, 123572.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 148272.00, 7414.00, 22243.00, 30.00, 4174411.00, 4174441.00, 37068.00, 281744.00, 148272.00, 7414.00, 22243.00, 0.00, 496741.00, 3677670.00, 3677700.00, 1, '2026-09-21 22:24:54', '2026-09-21 22:25:31'),
(499, '08', '2026', 20, '199801092022031007', 'Didik Yogo Suro Prasojo, S.Kom', 'III/b', 3089300.00, 308930.00, 0.00, 0.00, 540000.00, 0.00, 144840.00, 0.00, 157529.00, 7414.00, 22243.00, 70.00, 4270256.00, 4270326.00, 39382.00, 271858.00, 157529.00, 7414.00, 22243.00, 0.00, 498426.00, 3771830.00, 3771900.00, 1, '2026-09-21 22:24:54', '2026-09-21 22:25:31'),
(500, '08', '2026', 24, '197006161989031001', 'Ade Suangkat, S.E', 'IV/b', 5289800.00, 528980.00, 105796.00, 2025000.00, 0.00, 0.00, 217260.00, 85357.00, 317983.00, 12696.00, 38087.00, 26.00, 8620959.00, 8620985.00, 79496.00, 473966.00, 317983.00, 12696.00, 38087.00, 85357.00, 1007585.00, 7613374.00, 7613400.00, 1, '2026-09-21 22:24:54', '2026-09-21 22:25:31'),
(501, '09', '2026', 3, '197311171999031006', 'Harry Rudiyanto, S.Kom, M.M', 'IV/c', 5182000.00, 518200.00, 207280.00, 1260000.00, 0.00, 0.00, 289680.00, 77937.00, 286699.00, 12437.00, 37310.00, 13.00, 7871543.00, 7871556.00, 71675.00, 472598.00, 286699.00, 12437.00, 37310.00, 77937.00, 958656.00, 6912887.00, 6912900.00, 1, '2026-09-21 22:25:47', '2026-09-22 20:28:59'),
(502, '09', '2026', 4, '197406072007011008', 'Purnomo, S.H.', 'III/c', 4528900.00, 452890.00, 90578.00, 0.00, 0.00, 185000.00, 217260.00, 0.00, 210295.00, 10869.00, 32608.00, 35.00, 5728400.00, 5728435.00, 52574.00, 405789.00, 210295.00, 10869.00, 32608.00, 0.00, 712135.00, 5016265.00, 5016300.00, 1, '2026-09-21 22:25:47', '2026-09-22 20:28:59'),
(503, '09', '2026', 6, '197408122014062001', 'Vitta Adi Rosewaty Jengkar', 'II/c', 3606500.00, 360650.00, 0.00, 0.00, 0.00, 180000.00, 144840.00, 0.00, 165886.00, 8656.00, 25967.00, 54.00, 4492499.00, 4492553.00, 41472.00, 317372.00, 165886.00, 8656.00, 25967.00, 0.00, 559353.00, 3933146.00, 3933200.00, 1, '2026-09-21 22:25:47', '2026-09-22 20:28:59'),
(504, '09', '2026', 7, '198102232006042012', 'Riski Tessa Malela, S.E., MA', 'IV/b', 4819900.00, 481990.00, 192796.00, 0.00, 0.00, 190000.00, 289680.00, 46861.00, 227387.00, 11568.00, 34703.00, 56.00, 6294885.00, 6294941.00, 56847.00, 439575.00, 227387.00, 11568.00, 34703.00, 46861.00, 816941.00, 5477944.00, 5478000.00, 1, '2026-09-21 22:25:47', '2026-09-22 20:28:59'),
(505, '09', '2026', 8, '198102232009021003', 'Muhammad Muzni Kharis, A.Md', 'III/c', 3760100.00, 376010.00, 75202.00, 540000.00, 0.00, 0.00, 217260.00, 0.00, 190052.00, 9024.00, 27073.00, 46.00, 5194721.00, 5194767.00, 47513.00, 336905.00, 190052.00, 9024.00, 27073.00, 0.00, 610567.00, 4584154.00, 4584200.00, 1, '2026-09-21 22:25:47', '2026-09-22 20:28:59'),
(506, '09', '2026', 10, '198612162020122008', 'Ratih Prasastianila Muna, A.Md', 'II/d', 2756800.00, 275680.00, 110272.00, 0.00, 0.00, 180000.00, 289680.00, 0.00, 132910.00, 6616.00, 19849.00, 16.00, 3771807.00, 3771823.00, 33228.00, 251420.00, 132910.00, 6616.00, 19849.00, 0.00, 444023.00, 3327784.00, 3327800.00, 1, '2026-09-21 22:25:47', '2026-09-22 20:28:59'),
(507, '09', '2026', 11, '198901092022031007', 'Yanuar Albab Baihaqi, S.E.Sy', 'III/b', 3089300.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 130972.00, 7414.00, 22243.00, 67.00, 3507349.00, 3507416.00, 32743.00, 247144.00, 130972.00, 7414.00, 22243.00, 0.00, 440516.00, 3066833.00, 3066900.00, 1, '2026-09-21 22:25:47', '2026-09-22 20:28:59'),
(508, '09', '2026', 12, '198910192020122011', 'Istikomah, S.E.', 'III/b', 3089300.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 130972.00, 7414.00, 22243.00, 67.00, 3507349.00, 3507416.00, 32743.00, 247144.00, 130972.00, 7414.00, 22243.00, 0.00, 440516.00, 3066833.00, 3066900.00, 1, '2026-09-21 22:25:47', '2026-09-22 20:28:59'),
(509, '09', '2026', 13, '199102052022031003', 'Ahmad Rozi, S.E.', 'III/a', 2964000.00, 296400.00, 118560.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 142558.00, 7114.00, 21341.00, 17.00, 4024653.00, 4024670.00, 35640.00, 270317.00, 142558.00, 7114.00, 21341.00, 0.00, 476970.00, 3547683.00, 3547700.00, 1, '2026-09-21 22:25:47', '2026-09-22 20:28:59'),
(510, '09', '2026', 14, '199210012020122013', 'Millatina Hanifah, S.E.Sy.', 'III/b', 3089300.00, 308930.00, 123572.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 148272.00, 7414.00, 22243.00, 30.00, 4174411.00, 4174441.00, 37068.00, 281744.00, 148272.00, 7414.00, 22243.00, 0.00, 496741.00, 3677670.00, 3677700.00, 1, '2026-09-21 22:25:47', '2026-09-22 20:28:59'),
(511, '09', '2026', 15, '199401252022032008', 'Wulan Suryani, A.Md.Kom', 'II/d', 2756800.00, 275680.00, 55136.00, 0.00, 0.00, 180000.00, 217260.00, 0.00, 130705.00, 6616.00, 19849.00, 9.00, 3642046.00, 3642055.00, 32676.00, 247009.00, 130705.00, 6616.00, 19849.00, 0.00, 436855.00, 3205191.00, 3205200.00, 1, '2026-09-21 22:25:47', '2026-09-22 20:28:59'),
(512, '09', '2026', 16, '199608132022032018', 'Noor Falaisifa, A.Md', 'II/d', 2756800.00, 0.00, 0.00, 0.00, 0.00, 180000.00, 72420.00, 0.00, 117472.00, 6616.00, 19849.00, 92.00, 3153157.00, 3153249.00, 29368.00, 220544.00, 117472.00, 6616.00, 19849.00, 0.00, 393849.00, 2759308.00, 2759400.00, 1, '2026-09-21 22:25:47', '2026-09-22 20:28:59'),
(513, '09', '2026', 17, '199609172022032021', 'Nur Hanifah, A.Md', 'II/d', 2756800.00, 275680.00, 55136.00, 0.00, 0.00, 180000.00, 217260.00, 0.00, 130705.00, 6616.00, 19849.00, 9.00, 3642046.00, 3642055.00, 32676.00, 247009.00, 130705.00, 6616.00, 19849.00, 0.00, 436855.00, 3205191.00, 3205200.00, 1, '2026-09-21 22:25:47', '2026-09-22 20:28:59'),
(514, '09', '2026', 18, '199610212025042002', 'Aqilatul Ulya, S.E', 'III/a', 2785700.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 118828.00, 6686.00, 20057.00, 43.00, 3188691.00, 3188734.00, 29707.00, 222856.00, 118828.00, 6686.00, 20057.00, 0.00, 398134.00, 2790557.00, 2790600.00, 1, '2026-09-21 22:25:47', '2026-09-22 20:28:59'),
(515, '09', '2026', 19, '199611152020122016', 'Nadya Ayu Popi Haluansa, S.E', 'III/b', 3089300.00, 308930.00, 123572.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 148272.00, 7414.00, 22243.00, 30.00, 4174411.00, 4174441.00, 37068.00, 281744.00, 148272.00, 7414.00, 22243.00, 0.00, 496741.00, 3677670.00, 3677700.00, 1, '2026-09-21 22:25:47', '2026-09-22 20:28:59'),
(516, '09', '2026', 20, '199801092022031007', 'Didik Yogo Suro Prasojo, S.Kom', 'III/b', 3089300.00, 308930.00, 0.00, 0.00, 540000.00, 0.00, 144840.00, 0.00, 157529.00, 7414.00, 22243.00, 70.00, 4270256.00, 4270326.00, 39382.00, 271858.00, 157529.00, 7414.00, 22243.00, 0.00, 498426.00, 3771830.00, 3771900.00, 1, '2026-09-21 22:25:47', '2026-09-22 20:28:59'),
(517, '09', '2026', 24, '197006161989031001', 'Ade Suangkat, S.E', 'IV/b', 5289800.00, 528980.00, 105796.00, 2025000.00, 0.00, 0.00, 217260.00, 85357.00, 317983.00, 12696.00, 38087.00, 26.00, 8620959.00, 8620985.00, 79496.00, 473966.00, 317983.00, 12696.00, 38087.00, 85357.00, 1007585.00, 7613374.00, 7613400.00, 1, '2026-09-21 22:25:47', '2026-09-22 20:28:59'),
(518, '10', '2026', 3, '197311171999031006', 'Harry Rudiyanto, S.Kom, M.M', 'IV/c', 5182000.00, 518200.00, 207280.00, 1260000.00, 0.00, 0.00, 289680.00, 77937.00, 286699.00, 12437.00, 37310.00, 13.00, 7871543.00, 7871556.00, 71675.00, 472598.00, 286699.00, 12437.00, 37310.00, 77937.00, 958656.00, 6912887.00, 6912900.00, 1, '2026-09-21 22:26:18', '2026-09-21 22:26:32'),
(519, '10', '2026', 4, '197406072007011008', 'Purnomo, S.H.', 'III/c', 4528900.00, 452890.00, 90578.00, 0.00, 0.00, 185000.00, 217260.00, 0.00, 210295.00, 10869.00, 32608.00, 35.00, 5728400.00, 5728435.00, 52574.00, 405789.00, 210295.00, 10869.00, 32608.00, 0.00, 712135.00, 5016265.00, 5016300.00, 1, '2026-09-21 22:26:18', '2026-09-21 22:26:32'),
(520, '10', '2026', 6, '197408122014062001', 'Vitta Adi Rosewaty Jengkar', 'II/c', 3606500.00, 360650.00, 0.00, 0.00, 0.00, 180000.00, 144840.00, 0.00, 165886.00, 8656.00, 25967.00, 54.00, 4492499.00, 4492553.00, 41472.00, 317372.00, 165886.00, 8656.00, 25967.00, 0.00, 559353.00, 3933146.00, 3933200.00, 1, '2026-09-21 22:26:18', '2026-09-21 22:26:32'),
(521, '10', '2026', 7, '198102232006042012', 'Riski Tessa Malela, S.E., MA', 'IV/b', 4819900.00, 481990.00, 192796.00, 0.00, 0.00, 190000.00, 289680.00, 46861.00, 227387.00, 11568.00, 34703.00, 56.00, 6294885.00, 6294941.00, 56847.00, 439575.00, 227387.00, 11568.00, 34703.00, 46861.00, 816941.00, 5477944.00, 5478000.00, 1, '2026-09-21 22:26:18', '2026-09-21 22:26:32'),
(522, '10', '2026', 8, '198102232009021003', 'Muhammad Muzni Kharis, A.Md', 'III/c', 3760100.00, 376010.00, 75202.00, 540000.00, 0.00, 0.00, 217260.00, 0.00, 190052.00, 9024.00, 27073.00, 46.00, 5194721.00, 5194767.00, 47513.00, 336905.00, 190052.00, 9024.00, 27073.00, 0.00, 610567.00, 4584154.00, 4584200.00, 1, '2026-09-21 22:26:18', '2026-09-21 22:26:32'),
(523, '10', '2026', 10, '198612162020122008', 'Ratih Prasastianila Muna, A.Md', 'II/d', 2756800.00, 275680.00, 110272.00, 0.00, 0.00, 180000.00, 289680.00, 0.00, 132910.00, 6616.00, 19849.00, 16.00, 3771807.00, 3771823.00, 33228.00, 251420.00, 132910.00, 6616.00, 19849.00, 0.00, 444023.00, 3327784.00, 3327800.00, 1, '2026-09-21 22:26:18', '2026-09-21 22:26:32'),
(524, '10', '2026', 11, '198901092022031007', 'Yanuar Albab Baihaqi, S.E.Sy', 'III/b', 3089300.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 130972.00, 7414.00, 22243.00, 67.00, 3507349.00, 3507416.00, 32743.00, 247144.00, 130972.00, 7414.00, 22243.00, 0.00, 440516.00, 3066833.00, 3066900.00, 1, '2026-09-21 22:26:18', '2026-09-21 22:26:32'),
(525, '10', '2026', 12, '198910192020122011', 'Istikomah, S.E.', 'III/b', 3089300.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 130972.00, 7414.00, 22243.00, 67.00, 3507349.00, 3507416.00, 32743.00, 247144.00, 130972.00, 7414.00, 22243.00, 0.00, 440516.00, 3066833.00, 3066900.00, 1, '2026-09-21 22:26:18', '2026-09-21 22:26:32'),
(526, '10', '2026', 13, '199102052022031003', 'Ahmad Rozi, S.E.', 'III/a', 2964000.00, 296400.00, 118560.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 142558.00, 7114.00, 21341.00, 17.00, 4024653.00, 4024670.00, 35640.00, 270317.00, 142558.00, 7114.00, 21341.00, 0.00, 476970.00, 3547683.00, 3547700.00, 1, '2026-09-21 22:26:18', '2026-09-21 22:26:32'),
(527, '10', '2026', 14, '199210012020122013', 'Millatina Hanifah, S.E.Sy.', 'III/b', 3089300.00, 308930.00, 123572.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 148272.00, 7414.00, 22243.00, 30.00, 4174411.00, 4174441.00, 37068.00, 281744.00, 148272.00, 7414.00, 22243.00, 0.00, 496741.00, 3677670.00, 3677700.00, 1, '2026-09-21 22:26:18', '2026-09-21 22:26:32'),
(528, '10', '2026', 15, '199401252022032008', 'Wulan Suryani, A.Md.Kom', 'II/d', 2756800.00, 275680.00, 55136.00, 0.00, 0.00, 180000.00, 217260.00, 0.00, 130705.00, 6616.00, 19849.00, 9.00, 3642046.00, 3642055.00, 32676.00, 247009.00, 130705.00, 6616.00, 19849.00, 0.00, 436855.00, 3205191.00, 3205200.00, 1, '2026-09-21 22:26:18', '2026-09-21 22:26:32'),
(529, '10', '2026', 16, '199608132022032018', 'Noor Falaisifa, A.Md', 'II/d', 2756800.00, 0.00, 0.00, 0.00, 0.00, 180000.00, 72420.00, 0.00, 117472.00, 6616.00, 19849.00, 92.00, 3153157.00, 3153249.00, 29368.00, 220544.00, 117472.00, 6616.00, 19849.00, 0.00, 393849.00, 2759308.00, 2759400.00, 1, '2026-09-21 22:26:18', '2026-09-21 22:26:32'),
(530, '10', '2026', 17, '199609172022032021', 'Nur Hanifah, A.Md', 'II/d', 2756800.00, 275680.00, 55136.00, 0.00, 0.00, 180000.00, 217260.00, 0.00, 130705.00, 6616.00, 19849.00, 9.00, 3642046.00, 3642055.00, 32676.00, 247009.00, 130705.00, 6616.00, 19849.00, 0.00, 436855.00, 3205191.00, 3205200.00, 1, '2026-09-21 22:26:18', '2026-09-21 22:26:32'),
(531, '10', '2026', 18, '199610212025042002', 'Aqilatul Ulya, S.E', 'III/a', 2785700.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 118828.00, 6686.00, 20057.00, 43.00, 3188691.00, 3188734.00, 29707.00, 222856.00, 118828.00, 6686.00, 20057.00, 0.00, 398134.00, 2790557.00, 2790600.00, 1, '2026-09-21 22:26:18', '2026-09-21 22:26:32'),
(532, '10', '2026', 19, '199611152020122016', 'Nadya Ayu Popi Haluansa, S.E', 'III/b', 3089300.00, 308930.00, 123572.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 148272.00, 7414.00, 22243.00, 30.00, 4174411.00, 4174441.00, 37068.00, 281744.00, 148272.00, 7414.00, 22243.00, 0.00, 496741.00, 3677670.00, 3677700.00, 1, '2026-09-21 22:26:18', '2026-09-21 22:26:32'),
(533, '10', '2026', 20, '199801092022031007', 'Didik Yogo Suro Prasojo, S.Kom', 'III/b', 3089300.00, 308930.00, 0.00, 0.00, 540000.00, 0.00, 144840.00, 0.00, 157529.00, 7414.00, 22243.00, 70.00, 4270256.00, 4270326.00, 39382.00, 271858.00, 157529.00, 7414.00, 22243.00, 0.00, 498426.00, 3771830.00, 3771900.00, 1, '2026-09-21 22:26:18', '2026-09-21 22:26:32'),
(534, '10', '2026', 24, '197006161989031001', 'Ade Suangkat, S.E', 'IV/b', 5289800.00, 528980.00, 105796.00, 2025000.00, 0.00, 0.00, 217260.00, 85357.00, 317983.00, 12696.00, 38087.00, 26.00, 8620959.00, 8620985.00, 79496.00, 473966.00, 317983.00, 12696.00, 38087.00, 85357.00, 1007585.00, 7613374.00, 7613400.00, 1, '2026-09-21 22:26:18', '2026-09-21 22:26:32'),
(535, '11', '2026', 3, '197311171999031006', 'Harry Rudiyanto, S.Kom, M.M', 'IV/c', 5182000.00, 518200.00, 207280.00, 1260000.00, 0.00, 0.00, 289680.00, 77937.00, 286699.00, 12437.00, 37310.00, 13.00, 7871543.00, 7871556.00, 71675.00, 472598.00, 286699.00, 12437.00, 37310.00, 77937.00, 958656.00, 6912887.00, 6912900.00, 0, '2026-09-22 00:09:48', '2026-09-22 00:09:48'),
(536, '11', '2026', 4, '197406072007011008', 'Purnomo, S.H.', 'III/c', 4528900.00, 452890.00, 90578.00, 0.00, 0.00, 185000.00, 217260.00, 0.00, 210295.00, 10869.00, 32608.00, 35.00, 5728400.00, 5728435.00, 52574.00, 405789.00, 210295.00, 10869.00, 32608.00, 0.00, 712135.00, 5016265.00, 5016300.00, 0, '2026-09-22 00:09:48', '2026-09-22 00:09:48'),
(537, '11', '2026', 6, '197408122014062001', 'Vitta Adi Rosewaty Jengkar', 'II/c', 3606500.00, 360650.00, 0.00, 0.00, 0.00, 180000.00, 144840.00, 0.00, 165886.00, 8656.00, 25967.00, 54.00, 4492499.00, 4492553.00, 41472.00, 317372.00, 165886.00, 8656.00, 25967.00, 0.00, 559353.00, 3933146.00, 3933200.00, 0, '2026-09-22 00:09:48', '2026-09-22 00:09:48'),
(538, '11', '2026', 7, '198102232006042012', 'Riski Tessa Malela, S.E., MA', 'IV/b', 4819900.00, 481990.00, 192796.00, 0.00, 0.00, 190000.00, 289680.00, 46861.00, 227387.00, 11568.00, 34703.00, 56.00, 6294885.00, 6294941.00, 56847.00, 439575.00, 227387.00, 11568.00, 34703.00, 46861.00, 816941.00, 5477944.00, 5478000.00, 0, '2026-09-22 00:09:48', '2026-09-22 00:09:48'),
(539, '11', '2026', 8, '198102232009021003', 'Muhammad Muzni Kharis, A.Md', 'III/c', 3760100.00, 376010.00, 75202.00, 540000.00, 0.00, 0.00, 217260.00, 0.00, 190052.00, 9024.00, 27073.00, 46.00, 5194721.00, 5194767.00, 47513.00, 336905.00, 190052.00, 9024.00, 27073.00, 0.00, 610567.00, 4584154.00, 4584200.00, 0, '2026-09-22 00:09:48', '2026-09-22 00:09:48'),
(540, '11', '2026', 10, '198612162020122008', 'Ratih Prasastianila Muna, A.Md', 'II/d', 2756800.00, 275680.00, 110272.00, 0.00, 0.00, 180000.00, 289680.00, 0.00, 132910.00, 6616.00, 19849.00, 16.00, 3771807.00, 3771823.00, 33228.00, 251420.00, 132910.00, 6616.00, 19849.00, 0.00, 444023.00, 3327784.00, 3327800.00, 0, '2026-09-22 00:09:48', '2026-09-22 00:09:48'),
(541, '11', '2026', 11, '198901092022031007', 'Yanuar Albab Baihaqi, S.E.Sy', 'III/b', 3089300.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 130972.00, 7414.00, 22243.00, 67.00, 3507349.00, 3507416.00, 32743.00, 247144.00, 130972.00, 7414.00, 22243.00, 0.00, 440516.00, 3066833.00, 3066900.00, 0, '2026-09-22 00:09:48', '2026-09-22 00:09:48'),
(542, '11', '2026', 12, '198910192020122011', 'Istikomah, S.E.', 'III/b', 3089300.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 130972.00, 7414.00, 22243.00, 67.00, 3507349.00, 3507416.00, 32743.00, 247144.00, 130972.00, 7414.00, 22243.00, 0.00, 440516.00, 3066833.00, 3066900.00, 0, '2026-09-22 00:09:48', '2026-09-22 00:09:48'),
(543, '11', '2026', 13, '199102052022031003', 'Ahmad Rozi, S.E.', 'III/a', 2964000.00, 296400.00, 118560.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 142558.00, 7114.00, 21341.00, 17.00, 4024653.00, 4024670.00, 35640.00, 270317.00, 142558.00, 7114.00, 21341.00, 0.00, 476970.00, 3547683.00, 3547700.00, 0, '2026-09-22 00:09:48', '2026-09-22 00:09:48'),
(544, '11', '2026', 14, '199210012020122013', 'Millatina Hanifah, S.E.Sy.', 'III/b', 3089300.00, 308930.00, 123572.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 148272.00, 7414.00, 22243.00, 30.00, 4174411.00, 4174441.00, 37068.00, 281744.00, 148272.00, 7414.00, 22243.00, 0.00, 496741.00, 3677670.00, 3677700.00, 0, '2026-09-22 00:09:48', '2026-09-22 00:09:48'),
(545, '11', '2026', 15, '199401252022032008', 'Wulan Suryani, A.Md.Kom', 'II/d', 2756800.00, 275680.00, 55136.00, 0.00, 0.00, 180000.00, 217260.00, 0.00, 130705.00, 6616.00, 19849.00, 9.00, 3642046.00, 3642055.00, 32676.00, 247009.00, 130705.00, 6616.00, 19849.00, 0.00, 436855.00, 3205191.00, 3205200.00, 0, '2026-09-22 00:09:48', '2026-09-22 00:09:48'),
(546, '11', '2026', 16, '199608132022032018', 'Noor Falaisifa, A.Md', 'II/d', 2756800.00, 0.00, 0.00, 0.00, 0.00, 180000.00, 72420.00, 0.00, 117472.00, 6616.00, 19849.00, 92.00, 3153157.00, 3153249.00, 29368.00, 220544.00, 117472.00, 6616.00, 19849.00, 0.00, 393849.00, 2759308.00, 2759400.00, 0, '2026-09-22 00:09:48', '2026-09-22 00:09:48'),
(547, '11', '2026', 17, '199609172022032021', 'Nur Hanifah, A.Md', 'II/d', 2756800.00, 275680.00, 55136.00, 0.00, 0.00, 180000.00, 217260.00, 0.00, 130705.00, 6616.00, 19849.00, 9.00, 3642046.00, 3642055.00, 32676.00, 247009.00, 130705.00, 6616.00, 19849.00, 0.00, 436855.00, 3205191.00, 3205200.00, 0, '2026-09-22 00:09:48', '2026-09-22 00:09:48'),
(548, '11', '2026', 18, '199610212025042002', 'Aqilatul Ulya, S.E', 'III/a', 2785700.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 118828.00, 6686.00, 20057.00, 43.00, 3188691.00, 3188734.00, 29707.00, 222856.00, 118828.00, 6686.00, 20057.00, 0.00, 398134.00, 2790557.00, 2790600.00, 0, '2026-09-22 00:09:48', '2026-09-22 00:09:48'),
(549, '11', '2026', 19, '199611152020122016', 'Nadya Ayu Popi Haluansa, S.E', 'III/b', 3089300.00, 308930.00, 123572.00, 0.00, 0.00, 185000.00, 289680.00, 0.00, 148272.00, 7414.00, 22243.00, 30.00, 4174411.00, 4174441.00, 37068.00, 281744.00, 148272.00, 7414.00, 22243.00, 0.00, 496741.00, 3677670.00, 3677700.00, 0, '2026-09-22 00:09:48', '2026-09-22 00:09:48'),
(550, '11', '2026', 20, '199801092022031007', 'Didik Yogo Suro Prasojo, S.Kom', 'III/b', 3089300.00, 308930.00, 0.00, 0.00, 540000.00, 0.00, 144840.00, 0.00, 157529.00, 7414.00, 22243.00, 70.00, 4270256.00, 4270326.00, 39382.00, 271858.00, 157529.00, 7414.00, 22243.00, 0.00, 498426.00, 3771830.00, 3771900.00, 0, '2026-09-22 00:09:48', '2026-09-22 00:09:48'),
(551, '11', '2026', 24, '197006161989031001', 'Ade Suangkat, S.E', 'IV/b', 5289800.00, 528980.00, 105796.00, 2025000.00, 0.00, 0.00, 217260.00, 85357.00, 317983.00, 12696.00, 38087.00, 26.00, 8620959.00, 8620985.00, 79496.00, 473966.00, 317983.00, 12696.00, 38087.00, 85357.00, 1007585.00, 7613374.00, 7613400.00, 0, '2026-09-22 00:09:48', '2026-09-22 00:09:48');

-- --------------------------------------------------------

--
-- Table structure for table `gaji_induk_pppk`
--

CREATE TABLE `gaji_induk_pppk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `golongan` varchar(255) DEFAULT NULL,
  `gaji_pokok` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_suami_istri` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_anak` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_jabatan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_fungsional` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_umum` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_beras` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_bpjs` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_jkk` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_jkm` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_pembulatan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `kotor_sementara` decimal(15,2) NOT NULL DEFAULT 0.00,
  `kotor_resmi` decimal(15,2) NOT NULL DEFAULT 0.00,
  `potongan_iwp_1` decimal(15,2) NOT NULL DEFAULT 0.00,
  `potongan_iwp_3_25` decimal(15,2) NOT NULL DEFAULT 0.00,
  `potongan_bpjs` decimal(15,2) NOT NULL DEFAULT 0.00,
  `potongan_jkk` decimal(15,2) NOT NULL DEFAULT 0.00,
  `potongan_jkm` decimal(15,2) NOT NULL DEFAULT 0.00,
  `potongan_pph` decimal(15,2) NOT NULL DEFAULT 0.00,
  `jumlah_potongan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `bersih_sementara` decimal(15,2) NOT NULL DEFAULT 0.00,
  `bersih_resmi` decimal(15,2) NOT NULL DEFAULT 0.00,
  `is_locked` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gaji_induk_pppk`
--

INSERT INTO `gaji_induk_pppk` (`id`, `bulan`, `tahun`, `pegawai_id`, `nip`, `nama`, `golongan`, `gaji_pokok`, `tunjangan_suami_istri`, `tunjangan_anak`, `tunjangan_jabatan`, `tunjangan_fungsional`, `tunjangan_umum`, `tunjangan_beras`, `tunjangan_bpjs`, `tunjangan_jkk`, `tunjangan_jkm`, `tunjangan_pembulatan`, `kotor_sementara`, `kotor_resmi`, `potongan_iwp_1`, `potongan_iwp_3_25`, `potongan_bpjs`, `potongan_jkk`, `potongan_jkm`, `potongan_pph`, `jumlah_potongan`, `bersih_sementara`, `bersih_resmi`, `is_locked`, `created_at`, `updated_at`) VALUES
(4, '01', '2026', 21, '199305262025211041', 'Achmad Adi Kusuma, S.Kom', 'IX', 3203600.00, 320360.00, 64072.00, 0.00, 0.00, 185000.00, 217260.00, 150921.00, 7689.00, 23066.00, 49.00, 4171968.00, 4172017.00, 37730.00, 116611.00, 150921.00, 7689.00, 23066.00, 0.00, 336017.00, 3835951.00, 3836000.00, 1, '2026-09-21 22:47:02', '2026-09-21 22:59:35'),
(5, '01', '2026', 22, '199605222025211019', 'Muhammad Ilham Insani, S.Kom', 'IX', 3203600.00, 320360.00, 0.00, 0.00, 0.00, 185000.00, 144840.00, 148358.00, 7689.00, 23066.00, 19.00, 4032913.00, 4032932.00, 37090.00, 114529.00, 148358.00, 7689.00, 23066.00, 0.00, 330732.00, 3702181.00, 3702200.00, 1, '2026-09-21 22:47:02', '2026-09-21 22:59:35'),
(6, '01', '2026', 23, '199610092024211003', 'Fajariawan Prabowo, A.Md.Kom', 'VII', 2858800.00, 285880.00, 114352.00, 0.00, 360000.00, 0.00, 289680.00, 144761.00, 6861.00, 20583.00, 97.00, 4080917.00, 4081014.00, 36190.00, 105919.00, 144761.00, 6861.00, 20583.00, 0.00, 314314.00, 3766603.00, 3766700.00, 1, '2026-09-21 22:47:02', '2026-09-21 22:59:35'),
(7, '02', '2026', 21, '199305262025211041', 'Achmad Adi Kusuma, S.Kom', 'IX', 3203600.00, 320360.00, 64072.00, 0.00, 0.00, 185000.00, 217260.00, 150921.00, 7689.00, 23066.00, 49.00, 4171968.00, 4172017.00, 37730.00, 116611.00, 150921.00, 7689.00, 23066.00, 0.00, 336017.00, 3835951.00, 3836000.00, 1, '2026-09-21 22:59:41', '2026-09-21 22:59:46'),
(8, '02', '2026', 22, '199605222025211019', 'Muhammad Ilham Insani, S.Kom', 'IX', 3203600.00, 320360.00, 0.00, 0.00, 0.00, 185000.00, 144840.00, 148358.00, 7689.00, 23066.00, 19.00, 4032913.00, 4032932.00, 37090.00, 114529.00, 148358.00, 7689.00, 23066.00, 0.00, 330732.00, 3702181.00, 3702200.00, 1, '2026-09-21 22:59:41', '2026-09-21 22:59:46'),
(9, '02', '2026', 23, '199610092024211003', 'Fajariawan Prabowo, A.Md.Kom', 'VII', 2858800.00, 285880.00, 114352.00, 0.00, 360000.00, 0.00, 289680.00, 144761.00, 6861.00, 20583.00, 97.00, 4080917.00, 4081014.00, 36190.00, 105919.00, 144761.00, 6861.00, 20583.00, 0.00, 314314.00, 3766603.00, 3766700.00, 1, '2026-09-21 22:59:41', '2026-09-21 22:59:46'),
(10, '03', '2026', 21, '199305262025211041', 'Achmad Adi Kusuma, S.Kom', 'IX', 3203600.00, 320360.00, 64072.00, 0.00, 0.00, 185000.00, 217260.00, 150921.00, 7689.00, 23066.00, 49.00, 4171968.00, 4172017.00, 37730.00, 116611.00, 150921.00, 7689.00, 23066.00, 0.00, 336017.00, 3835951.00, 3836000.00, 1, '2026-09-21 23:07:56', '2026-09-21 23:08:25'),
(11, '03', '2026', 22, '199605222025211019', 'Muhammad Ilham Insani, S.Kom', 'IX', 3203600.00, 320360.00, 0.00, 0.00, 0.00, 185000.00, 144840.00, 148358.00, 7689.00, 23066.00, 19.00, 4032913.00, 4032932.00, 37090.00, 114529.00, 148358.00, 7689.00, 23066.00, 0.00, 330732.00, 3702181.00, 3702200.00, 1, '2026-09-21 23:07:56', '2026-09-21 23:08:25'),
(12, '03', '2026', 23, '199610092024211003', 'Fajariawan Prabowo, A.Md.Kom', 'VII', 2948800.00, 294880.00, 117952.00, 0.00, 360000.00, 0.00, 289680.00, 148865.00, 7077.00, 21231.00, 57.00, 4188485.00, 4188542.00, 37216.00, 109253.00, 148865.00, 7077.00, 21231.00, 0.00, 323642.00, 3864843.00, 3864900.00, 1, '2026-09-21 23:07:56', '2026-09-21 23:08:25'),
(13, '04', '2026', 21, '199305262025211041', 'Achmad Adi Kusuma, S.Kom', 'IX', 3203600.00, 320360.00, 64072.00, 0.00, 0.00, 185000.00, 217260.00, 150921.00, 7689.00, 23066.00, 49.00, 4171968.00, 4172017.00, 37730.00, 116611.00, 150921.00, 7689.00, 23066.00, 0.00, 336017.00, 3835951.00, 3836000.00, 1, '2026-09-21 23:08:32', '2026-09-21 23:08:36'),
(14, '04', '2026', 22, '199605222025211019', 'Muhammad Ilham Insani, S.Kom', 'IX', 3203600.00, 320360.00, 0.00, 0.00, 0.00, 185000.00, 144840.00, 148358.00, 7689.00, 23066.00, 19.00, 4032913.00, 4032932.00, 37090.00, 114529.00, 148358.00, 7689.00, 23066.00, 0.00, 330732.00, 3702181.00, 3702200.00, 1, '2026-09-21 23:08:32', '2026-09-21 23:08:36'),
(15, '04', '2026', 23, '199610092024211003', 'Fajariawan Prabowo, A.Md.Kom', 'VII', 2948800.00, 294880.00, 117952.00, 0.00, 360000.00, 0.00, 289680.00, 148865.00, 7077.00, 21231.00, 57.00, 4188485.00, 4188542.00, 37216.00, 109253.00, 148865.00, 7077.00, 21231.00, 0.00, 323642.00, 3864843.00, 3864900.00, 1, '2026-09-21 23:08:32', '2026-09-21 23:08:36'),
(16, '05', '2026', 21, '199305262025211041', 'Achmad Adi Kusuma, S.Kom', 'IX', 3203600.00, 320360.00, 64072.00, 0.00, 0.00, 185000.00, 217260.00, 150921.00, 7689.00, 23066.00, 49.00, 4171968.00, 4172017.00, 37730.00, 116611.00, 150921.00, 7689.00, 23066.00, 0.00, 336017.00, 3835951.00, 3836000.00, 1, '2026-09-21 23:08:41', '2026-09-21 23:08:45'),
(17, '05', '2026', 22, '199605222025211019', 'Muhammad Ilham Insani, S.Kom', 'IX', 3203600.00, 320360.00, 0.00, 0.00, 0.00, 185000.00, 144840.00, 148358.00, 7689.00, 23066.00, 19.00, 4032913.00, 4032932.00, 37090.00, 114529.00, 148358.00, 7689.00, 23066.00, 0.00, 330732.00, 3702181.00, 3702200.00, 1, '2026-09-21 23:08:41', '2026-09-21 23:08:45'),
(18, '05', '2026', 23, '199610092024211003', 'Fajariawan Prabowo, A.Md.Kom', 'VII', 2948800.00, 294880.00, 117952.00, 0.00, 360000.00, 0.00, 289680.00, 148865.00, 7077.00, 21231.00, 57.00, 4188485.00, 4188542.00, 37216.00, 109253.00, 148865.00, 7077.00, 21231.00, 0.00, 323642.00, 3864843.00, 3864900.00, 1, '2026-09-21 23:08:41', '2026-09-21 23:08:45'),
(19, '06', '2026', 21, '199305262025211041', 'Achmad Adi Kusuma, S.Kom', 'IX', 3203600.00, 320360.00, 64072.00, 0.00, 0.00, 185000.00, 217260.00, 150921.00, 7689.00, 23066.00, 49.00, 4171968.00, 4172017.00, 37730.00, 116611.00, 150921.00, 7689.00, 23066.00, 0.00, 336017.00, 3835951.00, 3836000.00, 1, '2026-09-21 23:08:51', '2026-09-21 23:08:54'),
(20, '06', '2026', 22, '199605222025211019', 'Muhammad Ilham Insani, S.Kom', 'IX', 3203600.00, 320360.00, 0.00, 0.00, 0.00, 185000.00, 144840.00, 148358.00, 7689.00, 23066.00, 19.00, 4032913.00, 4032932.00, 37090.00, 114529.00, 148358.00, 7689.00, 23066.00, 0.00, 330732.00, 3702181.00, 3702200.00, 1, '2026-09-21 23:08:51', '2026-09-21 23:08:54'),
(21, '06', '2026', 23, '199610092024211003', 'Fajariawan Prabowo, A.Md.Kom', 'VII', 2948800.00, 294880.00, 117952.00, 0.00, 360000.00, 0.00, 289680.00, 148865.00, 7077.00, 21231.00, 57.00, 4188485.00, 4188542.00, 37216.00, 109253.00, 148865.00, 7077.00, 21231.00, 0.00, 323642.00, 3864843.00, 3864900.00, 1, '2026-09-21 23:08:51', '2026-09-21 23:08:54'),
(22, '07', '2026', 21, '199305262025211041', 'Achmad Adi Kusuma, S.Kom', 'IX', 3203600.00, 320360.00, 64072.00, 0.00, 0.00, 185000.00, 217260.00, 150921.00, 7689.00, 23066.00, 49.00, 4171968.00, 4172017.00, 37730.00, 116611.00, 150921.00, 7689.00, 23066.00, 0.00, 336017.00, 3835951.00, 3836000.00, 1, '2026-09-21 23:09:03', '2026-09-21 23:09:06'),
(23, '07', '2026', 22, '199605222025211019', 'Muhammad Ilham Insani, S.Kom', 'IX', 3203600.00, 320360.00, 0.00, 0.00, 0.00, 185000.00, 144840.00, 148358.00, 7689.00, 23066.00, 19.00, 4032913.00, 4032932.00, 37090.00, 114529.00, 148358.00, 7689.00, 23066.00, 0.00, 330732.00, 3702181.00, 3702200.00, 1, '2026-09-21 23:09:03', '2026-09-21 23:09:06'),
(24, '07', '2026', 23, '199610092024211003', 'Fajariawan Prabowo, A.Md.Kom', 'VII', 2948800.00, 294880.00, 117952.00, 0.00, 360000.00, 0.00, 289680.00, 148865.00, 7077.00, 21231.00, 57.00, 4188485.00, 4188542.00, 37216.00, 109253.00, 148865.00, 7077.00, 21231.00, 0.00, 323642.00, 3864843.00, 3864900.00, 1, '2026-09-21 23:09:03', '2026-09-21 23:09:06'),
(25, '08', '2026', 21, '199305262025211041', 'Achmad Adi Kusuma, S.Kom', 'IX', 3203600.00, 320360.00, 64072.00, 0.00, 0.00, 185000.00, 217260.00, 150921.00, 7689.00, 23066.00, 49.00, 4171968.00, 4172017.00, 37730.00, 116611.00, 150921.00, 7689.00, 23066.00, 0.00, 336017.00, 3835951.00, 3836000.00, 1, '2026-09-21 23:11:03', '2026-09-21 23:11:16'),
(26, '08', '2026', 22, '199605222025211019', 'Muhammad Ilham Insani, S.Kom', 'IX', 3203600.00, 320360.00, 0.00, 0.00, 0.00, 185000.00, 144840.00, 148358.00, 7689.00, 23066.00, 19.00, 4032913.00, 4032932.00, 37090.00, 114529.00, 148358.00, 7689.00, 23066.00, 0.00, 330732.00, 3702181.00, 3702200.00, 1, '2026-09-21 23:11:03', '2026-09-21 23:11:16'),
(27, '08', '2026', 23, '199610092024211003', 'Fajariawan Prabowo, A.Md.Kom', 'VII', 2948800.00, 294880.00, 117952.00, 0.00, 360000.00, 0.00, 289680.00, 148865.00, 7077.00, 21231.00, 57.00, 4188485.00, 4188542.00, 37216.00, 109253.00, 148865.00, 7077.00, 21231.00, 0.00, 323642.00, 3864843.00, 3864900.00, 1, '2026-09-21 23:11:03', '2026-09-21 23:11:16'),
(28, '09', '2026', 21, '199305262025211041', 'Achmad Adi Kusuma, S.Kom', 'IX', 3203600.00, 320360.00, 64072.00, 0.00, 0.00, 185000.00, 217260.00, 150921.00, 7689.00, 23066.00, 49.00, 4171968.00, 4172017.00, 37730.00, 116611.00, 150921.00, 7689.00, 23066.00, 0.00, 336017.00, 3835951.00, 3836000.00, 1, '2026-09-21 23:11:21', '2026-09-21 23:11:24'),
(29, '09', '2026', 22, '199605222025211019', 'Muhammad Ilham Insani, S.Kom', 'IX', 3203600.00, 320360.00, 0.00, 0.00, 0.00, 185000.00, 144840.00, 148358.00, 7689.00, 23066.00, 19.00, 4032913.00, 4032932.00, 37090.00, 114529.00, 148358.00, 7689.00, 23066.00, 0.00, 330732.00, 3702181.00, 3702200.00, 1, '2026-09-21 23:11:21', '2026-09-21 23:11:24'),
(30, '09', '2026', 23, '199610092024211003', 'Fajariawan Prabowo, A.Md.Kom', 'VII', 2948800.00, 294880.00, 117952.00, 0.00, 360000.00, 0.00, 289680.00, 148865.00, 7077.00, 21231.00, 57.00, 4188485.00, 4188542.00, 37216.00, 109253.00, 148865.00, 7077.00, 21231.00, 0.00, 323642.00, 3864843.00, 3864900.00, 1, '2026-09-21 23:11:21', '2026-09-21 23:11:24'),
(31, '10', '2026', 21, '199305262025211041', 'Achmad Adi Kusuma, S.Kom', 'IX', 3203600.00, 320360.00, 64072.00, 0.00, 0.00, 185000.00, 217260.00, 150921.00, 7689.00, 23066.00, 49.00, 4171968.00, 4172017.00, 37730.00, 116611.00, 150921.00, 7689.00, 23066.00, 0.00, 336017.00, 3835951.00, 3836000.00, 1, '2026-09-21 23:11:29', '2026-09-21 23:11:32'),
(32, '10', '2026', 22, '199605222025211019', 'Muhammad Ilham Insani, S.Kom', 'IX', 3203600.00, 320360.00, 0.00, 0.00, 0.00, 185000.00, 144840.00, 148358.00, 7689.00, 23066.00, 19.00, 4032913.00, 4032932.00, 37090.00, 114529.00, 148358.00, 7689.00, 23066.00, 0.00, 330732.00, 3702181.00, 3702200.00, 1, '2026-09-21 23:11:29', '2026-09-21 23:11:32'),
(33, '10', '2026', 23, '199610092024211003', 'Fajariawan Prabowo, A.Md.Kom', 'VII', 2948800.00, 294880.00, 117952.00, 0.00, 360000.00, 0.00, 289680.00, 148865.00, 7077.00, 21231.00, 57.00, 4188485.00, 4188542.00, 37216.00, 109253.00, 148865.00, 7077.00, 21231.00, 0.00, 323642.00, 3864843.00, 3864900.00, 1, '2026-09-21 23:11:29', '2026-09-21 23:11:32');

-- --------------------------------------------------------

--
-- Table structure for table `gaji_induk_pppk_paruh_waktu`
--

CREATE TABLE `gaji_induk_pppk_paruh_waktu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `no_rekening` varchar(255) DEFAULT NULL,
  `upah_pokok` decimal(15,2) NOT NULL DEFAULT 0.00,
  `dasar_bpjs` decimal(15,2) NOT NULL DEFAULT 0.00,
  `dasar_jkk_jkm` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_bpjs` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_jkk` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_jkm` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_pembulatan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `bruto` decimal(15,2) NOT NULL DEFAULT 0.00,
  `potongan_bpjs_4` decimal(15,2) NOT NULL DEFAULT 0.00,
  `potongan_bpjs_1` decimal(15,2) NOT NULL DEFAULT 0.00,
  `potongan_jkk` decimal(15,2) NOT NULL DEFAULT 0.00,
  `potongan_jkm` decimal(15,2) NOT NULL DEFAULT 0.00,
  `potongan_pph` decimal(15,2) NOT NULL DEFAULT 0.00,
  `jumlah_potongan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `bersih` decimal(15,2) NOT NULL DEFAULT 0.00,
  `is_locked` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gaji_induk_pppk_paruh_waktu`
--

INSERT INTO `gaji_induk_pppk_paruh_waktu` (`id`, `bulan`, `tahun`, `pegawai_id`, `nip`, `nama`, `jabatan`, `no_rekening`, `upah_pokok`, `dasar_bpjs`, `dasar_jkk_jkm`, `tunjangan_bpjs`, `tunjangan_jkk`, `tunjangan_jkm`, `tunjangan_pembulatan`, `bruto`, `potongan_bpjs_4`, `potongan_bpjs_1`, `potongan_jkk`, `potongan_jkm`, `potongan_pph`, `jumlah_potongan`, `bersih`, `is_locked`, `created_at`, `updated_at`) VALUES
(1, '01', '2026', 26, '197202162025211017', 'Abdul Kholis, A.Md', 'Pengelola Layanan Operasional', '01.103.06072', 2691000.00, 2700926.00, 2691000.00, 108037.00, 6458.00, 19375.00, 0.00, 2824870.00, 108037.00, 27009.00, 6458.00, 19375.00, 0.00, 160879.00, 2663991.00, 0, '2026-09-22 20:18:09', '2026-09-22 20:18:09'),
(2, '01', '2026', 27, '199408272025211064', 'Agus Priyanto, S.Kom', 'Penata Layanan Operasional', '01.103.06052', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 0, '2026-09-22 20:18:09', '2026-09-22 20:18:09'),
(3, '01', '2026', 28, '198108042025211043', 'Dwi Imam Fitriono', 'Operator Layanan Operasional', '01.103.06053', 2050000.00, 2700926.00, 2050000.00, 108037.00, 4920.00, 14760.00, 0.00, 2177717.00, 108037.00, 27009.00, 4920.00, 14760.00, 0.00, 154726.00, 2022991.00, 0, '2026-09-22 20:18:09', '2026-09-22 20:18:09'),
(4, '01', '2026', 29, '199704252025212053', 'Dwita Gladea, S.Pd', 'Penata Layanan Operasional', '01.103.06076', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 0, '2026-09-22 20:18:09', '2026-09-22 20:18:09'),
(5, '01', '2026', 30, '199009282025212070', 'Ermi Susanti, S.Pd.', 'Penata Layanan Operasional', '01.103.06074', 2500000.00, 2700926.00, 2500000.00, 108037.00, 6000.00, 18000.00, 0.00, 2632037.00, 108037.00, 27009.00, 6000.00, 18000.00, 0.00, 159046.00, 2472991.00, 0, '2026-09-22 20:18:09', '2026-09-22 20:18:09'),
(6, '01', '2026', 31, '198511242025212055', 'Iis Sugiarti, A.Md.', 'Pengelola Layanan Operasional', '01.103.06099', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 0, '2026-09-22 20:18:09', '2026-09-22 20:18:09'),
(7, '01', '2026', 32, '199407152025211056', 'Julio Odi Ardika, A.Md', 'Pengelola Layanan Operasional', '01.103.06033', 3600000.00, 3600000.00, 3600000.00, 144000.00, 8640.00, 25920.00, 0.00, 3778560.00, 144000.00, 36000.00, 8640.00, 25920.00, 0.00, 214560.00, 3564000.00, 0, '2026-09-22 20:18:09', '2026-09-22 20:18:09'),
(8, '01', '2026', 33, '199811062025211036', 'Moch. Dany Rozid Wafa', 'Operator Layanan Operasional', '01.103.06067', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 0, '2026-09-22 20:18:09', '2026-09-22 20:18:09'),
(9, '01', '2026', 34, '198903222025211056', 'Moh. Marlan Saibani', 'Operator Layanan Operasional', '01.103.06061', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 0, '2026-09-22 20:18:09', '2026-09-22 20:18:09'),
(10, '01', '2026', 35, '197801082025211038', 'Muhammad Bahir', 'Pengelola Umum Operasional', '01.103.06068', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 0, '2026-09-22 20:18:09', '2026-09-22 20:18:09'),
(11, '01', '2026', 36, '199602142025211073', 'Muhammad Faqih Iqbal, S.Kom', 'Penata Layanan Operasional', '01.103.05793', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 0, '2026-09-22 20:18:09', '2026-09-22 20:18:09'),
(12, '01', '2026', 37, '199207172025211070', 'Muhammad Rifqil Anam, S.Kom', 'Penata Layanan Operasional', '01.103.06050', 3700000.00, 3700000.00, 3700000.00, 148000.00, 8880.00, 26640.00, 0.00, 3883520.00, 148000.00, 37000.00, 8880.00, 26640.00, 0.00, 220520.00, 3663000.00, 0, '2026-09-22 20:18:09', '2026-09-22 20:18:09'),
(13, '01', '2026', 38, '198705202025212059', 'Nur Handayani', 'Operator Layanan Operasional', '01.103.06073', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 0, '2026-09-22 20:18:09', '2026-09-22 20:18:09'),
(14, '01', '2026', 39, '198708182025212094', 'Sulistiyowati', 'Operator Layanan Operasional', '01.103.06071', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 0, '2026-09-22 20:18:09', '2026-09-22 20:18:09'),
(15, '01', '2026', 40, '198504162025211050', 'Wahyu Indra Kusuma', 'Operator Layanan Operasional', '01.103.06064', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 0, '2026-09-22 20:18:09', '2026-09-22 20:18:09'),
(16, '01', '2026', 41, '197808152025211058', 'Whinnaryo', 'Operator Layanan Operasional', '01.103.06062', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 0, '2026-09-22 20:18:09', '2026-09-22 20:18:09'),
(17, '01', '2026', 42, '199501262025212064', 'Yania Noviantika Ls, S.E', 'Penata Layanan Operasional', '01.103.06043', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 0, '2026-09-22 20:18:09', '2026-09-22 20:18:09'),
(18, '01', '2026', 43, '199506132025212082', 'Yuniar Hana Pratiwi, S.Kom', 'Penata Layanan Operasional', '01.103.06089', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 0, '2026-09-22 20:18:09', '2026-09-22 20:18:09'),
(19, '02', '2026', 26, '197202162025211017', 'Abdul Kholis, A.Md', 'Pengelola Layanan Operasional', '01.103.06072', 2691000.00, 2700926.00, 2691000.00, 108037.00, 6458.00, 19375.00, 0.00, 2824870.00, 108037.00, 27009.00, 6458.00, 19375.00, 0.00, 160879.00, 2663991.00, 1, '2026-09-22 20:26:11', '2026-09-22 20:26:16'),
(20, '02', '2026', 27, '199408272025211064', 'Agus Priyanto, S.Kom', 'Penata Layanan Operasional', '01.103.06052', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:26:11', '2026-09-22 20:26:16'),
(21, '02', '2026', 28, '198108042025211043', 'Dwi Imam Fitriono', 'Operator Layanan Operasional', '01.103.06053', 2050000.00, 2700926.00, 2050000.00, 108037.00, 4920.00, 14760.00, 0.00, 2177717.00, 108037.00, 27009.00, 4920.00, 14760.00, 0.00, 154726.00, 2022991.00, 1, '2026-09-22 20:26:11', '2026-09-22 20:26:16'),
(22, '02', '2026', 29, '199704252025212053', 'Dwita Gladea, S.Pd', 'Penata Layanan Operasional', '01.103.06076', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:26:11', '2026-09-22 20:26:16'),
(23, '02', '2026', 30, '199009282025212070', 'Ermi Susanti, S.Pd.', 'Penata Layanan Operasional', '01.103.06074', 2500000.00, 2700926.00, 2500000.00, 108037.00, 6000.00, 18000.00, 0.00, 2632037.00, 108037.00, 27009.00, 6000.00, 18000.00, 0.00, 159046.00, 2472991.00, 1, '2026-09-22 20:26:11', '2026-09-22 20:26:16'),
(24, '02', '2026', 31, '198511242025212055', 'Iis Sugiarti, A.Md.', 'Pengelola Layanan Operasional', '01.103.06099', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:26:11', '2026-09-22 20:26:16'),
(25, '02', '2026', 32, '199407152025211056', 'Julio Odi Ardika, A.Md', 'Pengelola Layanan Operasional', '01.103.06033', 3600000.00, 3600000.00, 3600000.00, 144000.00, 8640.00, 25920.00, 0.00, 3778560.00, 144000.00, 36000.00, 8640.00, 25920.00, 0.00, 214560.00, 3564000.00, 1, '2026-09-22 20:26:11', '2026-09-22 20:26:16'),
(26, '02', '2026', 33, '199811062025211036', 'Moch. Dany Rozid Wafa', 'Operator Layanan Operasional', '01.103.06067', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:26:11', '2026-09-22 20:26:16'),
(27, '02', '2026', 34, '198903222025211056', 'Moh. Marlan Saibani', 'Operator Layanan Operasional', '01.103.06061', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:26:11', '2026-09-22 20:26:16'),
(28, '02', '2026', 35, '197801082025211038', 'Muhammad Bahir', 'Pengelola Umum Operasional', '01.103.06068', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:26:11', '2026-09-22 20:26:16'),
(29, '02', '2026', 36, '199602142025211073', 'Muhammad Faqih Iqbal, S.Kom', 'Penata Layanan Operasional', '01.103.05793', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:26:11', '2026-09-22 20:26:16'),
(30, '02', '2026', 37, '199207172025211070', 'Muhammad Rifqil Anam, S.Kom', 'Penata Layanan Operasional', '01.103.06050', 3700000.00, 3700000.00, 3700000.00, 148000.00, 8880.00, 26640.00, 0.00, 3883520.00, 148000.00, 37000.00, 8880.00, 26640.00, 0.00, 220520.00, 3663000.00, 1, '2026-09-22 20:26:11', '2026-09-22 20:26:16'),
(31, '02', '2026', 38, '198705202025212059', 'Nur Handayani', 'Operator Layanan Operasional', '01.103.06073', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:26:11', '2026-09-22 20:26:16'),
(32, '02', '2026', 39, '198708182025212094', 'Sulistiyowati', 'Operator Layanan Operasional', '01.103.06071', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:26:11', '2026-09-22 20:26:16'),
(33, '02', '2026', 40, '198504162025211050', 'Wahyu Indra Kusuma', 'Operator Layanan Operasional', '01.103.06064', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:26:11', '2026-09-22 20:26:16'),
(34, '02', '2026', 41, '197808152025211058', 'Whinnaryo', 'Operator Layanan Operasional', '01.103.06062', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:26:11', '2026-09-22 20:26:16'),
(35, '02', '2026', 42, '199501262025212064', 'Yania Noviantika Ls, S.E', 'Penata Layanan Operasional', '01.103.06043', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:26:11', '2026-09-22 20:26:16'),
(36, '02', '2026', 43, '199506132025212082', 'Yuniar Hana Pratiwi, S.Kom', 'Penata Layanan Operasional', '01.103.06089', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:26:11', '2026-09-22 20:26:16'),
(37, '03', '2026', 26, '197202162025211017', 'Abdul Kholis, A.Md', 'Pengelola Layanan Operasional', '01.103.06072', 2691000.00, 2700926.00, 2691000.00, 108037.00, 6458.00, 19375.00, 0.00, 2824870.00, 108037.00, 27009.00, 6458.00, 19375.00, 0.00, 160879.00, 2663991.00, 1, '2026-09-22 20:26:30', '2026-09-22 20:26:33'),
(38, '03', '2026', 27, '199408272025211064', 'Agus Priyanto, S.Kom', 'Penata Layanan Operasional', '01.103.06052', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:26:30', '2026-09-22 20:26:33'),
(39, '03', '2026', 28, '198108042025211043', 'Dwi Imam Fitriono', 'Operator Layanan Operasional', '01.103.06053', 2050000.00, 2700926.00, 2050000.00, 108037.00, 4920.00, 14760.00, 0.00, 2177717.00, 108037.00, 27009.00, 4920.00, 14760.00, 0.00, 154726.00, 2022991.00, 1, '2026-09-22 20:26:30', '2026-09-22 20:26:33'),
(40, '03', '2026', 29, '199704252025212053', 'Dwita Gladea, S.Pd', 'Penata Layanan Operasional', '01.103.06076', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:26:30', '2026-09-22 20:26:33'),
(41, '03', '2026', 30, '199009282025212070', 'Ermi Susanti, S.Pd.', 'Penata Layanan Operasional', '01.103.06074', 2500000.00, 2700926.00, 2500000.00, 108037.00, 6000.00, 18000.00, 0.00, 2632037.00, 108037.00, 27009.00, 6000.00, 18000.00, 0.00, 159046.00, 2472991.00, 1, '2026-09-22 20:26:30', '2026-09-22 20:26:33'),
(42, '03', '2026', 31, '198511242025212055', 'Iis Sugiarti, A.Md.', 'Pengelola Layanan Operasional', '01.103.06099', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:26:30', '2026-09-22 20:26:33'),
(43, '03', '2026', 32, '199407152025211056', 'Julio Odi Ardika, A.Md', 'Pengelola Layanan Operasional', '01.103.06033', 3600000.00, 3600000.00, 3600000.00, 144000.00, 8640.00, 25920.00, 0.00, 3778560.00, 144000.00, 36000.00, 8640.00, 25920.00, 0.00, 214560.00, 3564000.00, 1, '2026-09-22 20:26:30', '2026-09-22 20:26:33'),
(44, '03', '2026', 33, '199811062025211036', 'Moch. Dany Rozid Wafa', 'Operator Layanan Operasional', '01.103.06067', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:26:30', '2026-09-22 20:26:33'),
(45, '03', '2026', 34, '198903222025211056', 'Moh. Marlan Saibani', 'Operator Layanan Operasional', '01.103.06061', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:26:30', '2026-09-22 20:26:33'),
(46, '03', '2026', 35, '197801082025211038', 'Muhammad Bahir', 'Pengelola Umum Operasional', '01.103.06068', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:26:30', '2026-09-22 20:26:33'),
(47, '03', '2026', 36, '199602142025211073', 'Muhammad Faqih Iqbal, S.Kom', 'Penata Layanan Operasional', '01.103.05793', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:26:30', '2026-09-22 20:26:33'),
(48, '03', '2026', 37, '199207172025211070', 'Muhammad Rifqil Anam, S.Kom', 'Penata Layanan Operasional', '01.103.06050', 3700000.00, 3700000.00, 3700000.00, 148000.00, 8880.00, 26640.00, 0.00, 3883520.00, 148000.00, 37000.00, 8880.00, 26640.00, 0.00, 220520.00, 3663000.00, 1, '2026-09-22 20:26:30', '2026-09-22 20:26:33'),
(49, '03', '2026', 38, '198705202025212059', 'Nur Handayani', 'Operator Layanan Operasional', '01.103.06073', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:26:30', '2026-09-22 20:26:33'),
(50, '03', '2026', 39, '198708182025212094', 'Sulistiyowati', 'Operator Layanan Operasional', '01.103.06071', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:26:30', '2026-09-22 20:26:33'),
(51, '03', '2026', 40, '198504162025211050', 'Wahyu Indra Kusuma', 'Operator Layanan Operasional', '01.103.06064', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:26:30', '2026-09-22 20:26:33'),
(52, '03', '2026', 41, '197808152025211058', 'Whinnaryo', 'Operator Layanan Operasional', '01.103.06062', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:26:30', '2026-09-22 20:26:33'),
(53, '03', '2026', 42, '199501262025212064', 'Yania Noviantika Ls, S.E', 'Penata Layanan Operasional', '01.103.06043', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:26:30', '2026-09-22 20:26:33'),
(54, '03', '2026', 43, '199506132025212082', 'Yuniar Hana Pratiwi, S.Kom', 'Penata Layanan Operasional', '01.103.06089', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:26:30', '2026-09-22 20:26:33'),
(55, '04', '2026', 26, '197202162025211017', 'Abdul Kholis, A.Md', 'Pengelola Layanan Operasional', '01.103.06072', 2691000.00, 2700926.00, 2691000.00, 108037.00, 6458.00, 19375.00, 0.00, 2824870.00, 108037.00, 27009.00, 6458.00, 19375.00, 0.00, 160879.00, 2663991.00, 1, '2026-09-22 20:26:39', '2026-09-22 20:26:42'),
(56, '04', '2026', 27, '199408272025211064', 'Agus Priyanto, S.Kom', 'Penata Layanan Operasional', '01.103.06052', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:26:39', '2026-09-22 20:26:42'),
(57, '04', '2026', 28, '198108042025211043', 'Dwi Imam Fitriono', 'Operator Layanan Operasional', '01.103.06053', 2050000.00, 2700926.00, 2050000.00, 108037.00, 4920.00, 14760.00, 0.00, 2177717.00, 108037.00, 27009.00, 4920.00, 14760.00, 0.00, 154726.00, 2022991.00, 1, '2026-09-22 20:26:39', '2026-09-22 20:26:42'),
(58, '04', '2026', 29, '199704252025212053', 'Dwita Gladea, S.Pd', 'Penata Layanan Operasional', '01.103.06076', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:26:39', '2026-09-22 20:26:42'),
(59, '04', '2026', 30, '199009282025212070', 'Ermi Susanti, S.Pd.', 'Penata Layanan Operasional', '01.103.06074', 2500000.00, 2700926.00, 2500000.00, 108037.00, 6000.00, 18000.00, 0.00, 2632037.00, 108037.00, 27009.00, 6000.00, 18000.00, 0.00, 159046.00, 2472991.00, 1, '2026-09-22 20:26:39', '2026-09-22 20:26:42'),
(60, '04', '2026', 31, '198511242025212055', 'Iis Sugiarti, A.Md.', 'Pengelola Layanan Operasional', '01.103.06099', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:26:39', '2026-09-22 20:26:42'),
(61, '04', '2026', 32, '199407152025211056', 'Julio Odi Ardika, A.Md', 'Pengelola Layanan Operasional', '01.103.06033', 3600000.00, 3600000.00, 3600000.00, 144000.00, 8640.00, 25920.00, 0.00, 3778560.00, 144000.00, 36000.00, 8640.00, 25920.00, 0.00, 214560.00, 3564000.00, 1, '2026-09-22 20:26:39', '2026-09-22 20:26:42'),
(62, '04', '2026', 33, '199811062025211036', 'Moch. Dany Rozid Wafa', 'Operator Layanan Operasional', '01.103.06067', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:26:39', '2026-09-22 20:26:42'),
(63, '04', '2026', 34, '198903222025211056', 'Moh. Marlan Saibani', 'Operator Layanan Operasional', '01.103.06061', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:26:39', '2026-09-22 20:26:42'),
(64, '04', '2026', 35, '197801082025211038', 'Muhammad Bahir', 'Pengelola Umum Operasional', '01.103.06068', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:26:39', '2026-09-22 20:26:42'),
(65, '04', '2026', 36, '199602142025211073', 'Muhammad Faqih Iqbal, S.Kom', 'Penata Layanan Operasional', '01.103.05793', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:26:39', '2026-09-22 20:26:42'),
(66, '04', '2026', 37, '199207172025211070', 'Muhammad Rifqil Anam, S.Kom', 'Penata Layanan Operasional', '01.103.06050', 3700000.00, 3700000.00, 3700000.00, 148000.00, 8880.00, 26640.00, 0.00, 3883520.00, 148000.00, 37000.00, 8880.00, 26640.00, 0.00, 220520.00, 3663000.00, 1, '2026-09-22 20:26:39', '2026-09-22 20:26:42'),
(67, '04', '2026', 38, '198705202025212059', 'Nur Handayani', 'Operator Layanan Operasional', '01.103.06073', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:26:39', '2026-09-22 20:26:42'),
(68, '04', '2026', 39, '198708182025212094', 'Sulistiyowati', 'Operator Layanan Operasional', '01.103.06071', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:26:39', '2026-09-22 20:26:42'),
(69, '04', '2026', 40, '198504162025211050', 'Wahyu Indra Kusuma', 'Operator Layanan Operasional', '01.103.06064', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:26:39', '2026-09-22 20:26:42'),
(70, '04', '2026', 41, '197808152025211058', 'Whinnaryo', 'Operator Layanan Operasional', '01.103.06062', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:26:39', '2026-09-22 20:26:42'),
(71, '04', '2026', 42, '199501262025212064', 'Yania Noviantika Ls, S.E', 'Penata Layanan Operasional', '01.103.06043', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:26:39', '2026-09-22 20:26:42'),
(72, '04', '2026', 43, '199506132025212082', 'Yuniar Hana Pratiwi, S.Kom', 'Penata Layanan Operasional', '01.103.06089', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:26:39', '2026-09-22 20:26:42'),
(73, '05', '2026', 26, '197202162025211017', 'Abdul Kholis, A.Md', 'Pengelola Layanan Operasional', '01.103.06072', 2691000.00, 2700926.00, 2691000.00, 108037.00, 6458.00, 19375.00, 0.00, 2824870.00, 108037.00, 27009.00, 6458.00, 19375.00, 0.00, 160879.00, 2663991.00, 1, '2026-09-22 20:26:49', '2026-09-22 20:26:54'),
(74, '05', '2026', 27, '199408272025211064', 'Agus Priyanto, S.Kom', 'Penata Layanan Operasional', '01.103.06052', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:26:49', '2026-09-22 20:26:54'),
(75, '05', '2026', 28, '198108042025211043', 'Dwi Imam Fitriono', 'Operator Layanan Operasional', '01.103.06053', 2050000.00, 2700926.00, 2050000.00, 108037.00, 4920.00, 14760.00, 0.00, 2177717.00, 108037.00, 27009.00, 4920.00, 14760.00, 0.00, 154726.00, 2022991.00, 1, '2026-09-22 20:26:49', '2026-09-22 20:26:54'),
(76, '05', '2026', 29, '199704252025212053', 'Dwita Gladea, S.Pd', 'Penata Layanan Operasional', '01.103.06076', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:26:49', '2026-09-22 20:26:54'),
(77, '05', '2026', 30, '199009282025212070', 'Ermi Susanti, S.Pd.', 'Penata Layanan Operasional', '01.103.06074', 2500000.00, 2700926.00, 2500000.00, 108037.00, 6000.00, 18000.00, 0.00, 2632037.00, 108037.00, 27009.00, 6000.00, 18000.00, 0.00, 159046.00, 2472991.00, 1, '2026-09-22 20:26:49', '2026-09-22 20:26:54'),
(78, '05', '2026', 31, '198511242025212055', 'Iis Sugiarti, A.Md.', 'Pengelola Layanan Operasional', '01.103.06099', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:26:49', '2026-09-22 20:26:54'),
(79, '05', '2026', 32, '199407152025211056', 'Julio Odi Ardika, A.Md', 'Pengelola Layanan Operasional', '01.103.06033', 3600000.00, 3600000.00, 3600000.00, 144000.00, 8640.00, 25920.00, 0.00, 3778560.00, 144000.00, 36000.00, 8640.00, 25920.00, 0.00, 214560.00, 3564000.00, 1, '2026-09-22 20:26:49', '2026-09-22 20:26:54'),
(80, '05', '2026', 33, '199811062025211036', 'Moch. Dany Rozid Wafa', 'Operator Layanan Operasional', '01.103.06067', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:26:49', '2026-09-22 20:26:54'),
(81, '05', '2026', 34, '198903222025211056', 'Moh. Marlan Saibani', 'Operator Layanan Operasional', '01.103.06061', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:26:49', '2026-09-22 20:26:54'),
(82, '05', '2026', 35, '197801082025211038', 'Muhammad Bahir', 'Pengelola Umum Operasional', '01.103.06068', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:26:49', '2026-09-22 20:26:54'),
(83, '05', '2026', 36, '199602142025211073', 'Muhammad Faqih Iqbal, S.Kom', 'Penata Layanan Operasional', '01.103.05793', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:26:49', '2026-09-22 20:26:54'),
(84, '05', '2026', 37, '199207172025211070', 'Muhammad Rifqil Anam, S.Kom', 'Penata Layanan Operasional', '01.103.06050', 3700000.00, 3700000.00, 3700000.00, 148000.00, 8880.00, 26640.00, 0.00, 3883520.00, 148000.00, 37000.00, 8880.00, 26640.00, 0.00, 220520.00, 3663000.00, 1, '2026-09-22 20:26:49', '2026-09-22 20:26:54'),
(85, '05', '2026', 38, '198705202025212059', 'Nur Handayani', 'Operator Layanan Operasional', '01.103.06073', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:26:49', '2026-09-22 20:26:54'),
(86, '05', '2026', 39, '198708182025212094', 'Sulistiyowati', 'Operator Layanan Operasional', '01.103.06071', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:26:49', '2026-09-22 20:26:54'),
(87, '05', '2026', 40, '198504162025211050', 'Wahyu Indra Kusuma', 'Operator Layanan Operasional', '01.103.06064', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:26:49', '2026-09-22 20:26:54'),
(88, '05', '2026', 41, '197808152025211058', 'Whinnaryo', 'Operator Layanan Operasional', '01.103.06062', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:26:49', '2026-09-22 20:26:54'),
(89, '05', '2026', 42, '199501262025212064', 'Yania Noviantika Ls, S.E', 'Penata Layanan Operasional', '01.103.06043', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:26:49', '2026-09-22 20:26:54'),
(90, '05', '2026', 43, '199506132025212082', 'Yuniar Hana Pratiwi, S.Kom', 'Penata Layanan Operasional', '01.103.06089', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:26:49', '2026-09-22 20:26:54'),
(91, '06', '2026', 26, '197202162025211017', 'Abdul Kholis, A.Md', 'Pengelola Layanan Operasional', '01.103.06072', 2691000.00, 2700926.00, 2691000.00, 108037.00, 6458.00, 19375.00, 0.00, 2824870.00, 108037.00, 27009.00, 6458.00, 19375.00, 0.00, 160879.00, 2663991.00, 1, '2026-09-22 20:27:03', '2026-09-22 20:27:06'),
(92, '06', '2026', 27, '199408272025211064', 'Agus Priyanto, S.Kom', 'Penata Layanan Operasional', '01.103.06052', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:27:03', '2026-09-22 20:27:06'),
(93, '06', '2026', 28, '198108042025211043', 'Dwi Imam Fitriono', 'Operator Layanan Operasional', '01.103.06053', 2050000.00, 2700926.00, 2050000.00, 108037.00, 4920.00, 14760.00, 0.00, 2177717.00, 108037.00, 27009.00, 4920.00, 14760.00, 0.00, 154726.00, 2022991.00, 1, '2026-09-22 20:27:03', '2026-09-22 20:27:06'),
(94, '06', '2026', 29, '199704252025212053', 'Dwita Gladea, S.Pd', 'Penata Layanan Operasional', '01.103.06076', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:27:03', '2026-09-22 20:27:06'),
(95, '06', '2026', 30, '199009282025212070', 'Ermi Susanti, S.Pd.', 'Penata Layanan Operasional', '01.103.06074', 2500000.00, 2700926.00, 2500000.00, 108037.00, 6000.00, 18000.00, 0.00, 2632037.00, 108037.00, 27009.00, 6000.00, 18000.00, 0.00, 159046.00, 2472991.00, 1, '2026-09-22 20:27:03', '2026-09-22 20:27:06'),
(96, '06', '2026', 31, '198511242025212055', 'Iis Sugiarti, A.Md.', 'Pengelola Layanan Operasional', '01.103.06099', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:27:03', '2026-09-22 20:27:06'),
(97, '06', '2026', 32, '199407152025211056', 'Julio Odi Ardika, A.Md', 'Pengelola Layanan Operasional', '01.103.06033', 3600000.00, 3600000.00, 3600000.00, 144000.00, 8640.00, 25920.00, 0.00, 3778560.00, 144000.00, 36000.00, 8640.00, 25920.00, 0.00, 214560.00, 3564000.00, 1, '2026-09-22 20:27:03', '2026-09-22 20:27:06'),
(98, '06', '2026', 33, '199811062025211036', 'Moch. Dany Rozid Wafa', 'Operator Layanan Operasional', '01.103.06067', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:27:03', '2026-09-22 20:27:06'),
(99, '06', '2026', 34, '198903222025211056', 'Moh. Marlan Saibani', 'Operator Layanan Operasional', '01.103.06061', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:27:03', '2026-09-22 20:27:06'),
(100, '06', '2026', 35, '197801082025211038', 'Muhammad Bahir', 'Pengelola Umum Operasional', '01.103.06068', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:27:03', '2026-09-22 20:27:06'),
(101, '06', '2026', 36, '199602142025211073', 'Muhammad Faqih Iqbal, S.Kom', 'Penata Layanan Operasional', '01.103.05793', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:27:03', '2026-09-22 20:27:06'),
(102, '06', '2026', 37, '199207172025211070', 'Muhammad Rifqil Anam, S.Kom', 'Penata Layanan Operasional', '01.103.06050', 3700000.00, 3700000.00, 3700000.00, 148000.00, 8880.00, 26640.00, 0.00, 3883520.00, 148000.00, 37000.00, 8880.00, 26640.00, 0.00, 220520.00, 3663000.00, 1, '2026-09-22 20:27:03', '2026-09-22 20:27:06'),
(103, '06', '2026', 38, '198705202025212059', 'Nur Handayani', 'Operator Layanan Operasional', '01.103.06073', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:27:03', '2026-09-22 20:27:06'),
(104, '06', '2026', 39, '198708182025212094', 'Sulistiyowati', 'Operator Layanan Operasional', '01.103.06071', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:27:03', '2026-09-22 20:27:06'),
(105, '06', '2026', 40, '198504162025211050', 'Wahyu Indra Kusuma', 'Operator Layanan Operasional', '01.103.06064', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:27:03', '2026-09-22 20:27:06'),
(106, '06', '2026', 41, '197808152025211058', 'Whinnaryo', 'Operator Layanan Operasional', '01.103.06062', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:27:03', '2026-09-22 20:27:06'),
(107, '06', '2026', 42, '199501262025212064', 'Yania Noviantika Ls, S.E', 'Penata Layanan Operasional', '01.103.06043', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:27:03', '2026-09-22 20:27:06'),
(108, '06', '2026', 43, '199506132025212082', 'Yuniar Hana Pratiwi, S.Kom', 'Penata Layanan Operasional', '01.103.06089', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:27:03', '2026-09-22 20:27:06'),
(109, '07', '2026', 26, '197202162025211017', 'Abdul Kholis, A.Md', 'Pengelola Layanan Operasional', '01.103.06072', 2691000.00, 2700926.00, 2691000.00, 108037.00, 6458.00, 19375.00, 0.00, 2824870.00, 108037.00, 27009.00, 6458.00, 19375.00, 0.00, 160879.00, 2663991.00, 1, '2026-09-22 20:27:12', '2026-09-22 20:27:15'),
(110, '07', '2026', 27, '199408272025211064', 'Agus Priyanto, S.Kom', 'Penata Layanan Operasional', '01.103.06052', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:27:12', '2026-09-22 20:27:15'),
(111, '07', '2026', 28, '198108042025211043', 'Dwi Imam Fitriono', 'Operator Layanan Operasional', '01.103.06053', 2050000.00, 2700926.00, 2050000.00, 108037.00, 4920.00, 14760.00, 0.00, 2177717.00, 108037.00, 27009.00, 4920.00, 14760.00, 0.00, 154726.00, 2022991.00, 1, '2026-09-22 20:27:12', '2026-09-22 20:27:15'),
(112, '07', '2026', 29, '199704252025212053', 'Dwita Gladea, S.Pd', 'Penata Layanan Operasional', '01.103.06076', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:27:12', '2026-09-22 20:27:15'),
(113, '07', '2026', 30, '199009282025212070', 'Ermi Susanti, S.Pd.', 'Penata Layanan Operasional', '01.103.06074', 2500000.00, 2700926.00, 2500000.00, 108037.00, 6000.00, 18000.00, 0.00, 2632037.00, 108037.00, 27009.00, 6000.00, 18000.00, 0.00, 159046.00, 2472991.00, 1, '2026-09-22 20:27:12', '2026-09-22 20:27:15'),
(114, '07', '2026', 31, '198511242025212055', 'Iis Sugiarti, A.Md.', 'Pengelola Layanan Operasional', '01.103.06099', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:27:12', '2026-09-22 20:27:15'),
(115, '07', '2026', 32, '199407152025211056', 'Julio Odi Ardika, A.Md', 'Pengelola Layanan Operasional', '01.103.06033', 3600000.00, 3600000.00, 3600000.00, 144000.00, 8640.00, 25920.00, 0.00, 3778560.00, 144000.00, 36000.00, 8640.00, 25920.00, 0.00, 214560.00, 3564000.00, 1, '2026-09-22 20:27:12', '2026-09-22 20:27:15'),
(116, '07', '2026', 33, '199811062025211036', 'Moch. Dany Rozid Wafa', 'Operator Layanan Operasional', '01.103.06067', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:27:12', '2026-09-22 20:27:15'),
(117, '07', '2026', 34, '198903222025211056', 'Moh. Marlan Saibani', 'Operator Layanan Operasional', '01.103.06061', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:27:12', '2026-09-22 20:27:15'),
(118, '07', '2026', 35, '197801082025211038', 'Muhammad Bahir', 'Pengelola Umum Operasional', '01.103.06068', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:27:12', '2026-09-22 20:27:15'),
(119, '07', '2026', 36, '199602142025211073', 'Muhammad Faqih Iqbal, S.Kom', 'Penata Layanan Operasional', '01.103.05793', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:27:12', '2026-09-22 20:27:15'),
(120, '07', '2026', 37, '199207172025211070', 'Muhammad Rifqil Anam, S.Kom', 'Penata Layanan Operasional', '01.103.06050', 3700000.00, 3700000.00, 3700000.00, 148000.00, 8880.00, 26640.00, 0.00, 3883520.00, 148000.00, 37000.00, 8880.00, 26640.00, 0.00, 220520.00, 3663000.00, 1, '2026-09-22 20:27:12', '2026-09-22 20:27:15'),
(121, '07', '2026', 38, '198705202025212059', 'Nur Handayani', 'Operator Layanan Operasional', '01.103.06073', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:27:12', '2026-09-22 20:27:15'),
(122, '07', '2026', 39, '198708182025212094', 'Sulistiyowati', 'Operator Layanan Operasional', '01.103.06071', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:27:12', '2026-09-22 20:27:15'),
(123, '07', '2026', 40, '198504162025211050', 'Wahyu Indra Kusuma', 'Operator Layanan Operasional', '01.103.06064', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:27:12', '2026-09-22 20:27:15'),
(124, '07', '2026', 41, '197808152025211058', 'Whinnaryo', 'Operator Layanan Operasional', '01.103.06062', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:27:12', '2026-09-22 20:27:15'),
(125, '07', '2026', 42, '199501262025212064', 'Yania Noviantika Ls, S.E', 'Penata Layanan Operasional', '01.103.06043', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:27:12', '2026-09-22 20:27:15'),
(126, '07', '2026', 43, '199506132025212082', 'Yuniar Hana Pratiwi, S.Kom', 'Penata Layanan Operasional', '01.103.06089', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:27:12', '2026-09-22 20:27:15'),
(127, '08', '2026', 26, '197202162025211017', 'Abdul Kholis, A.Md', 'Pengelola Layanan Operasional', '01.103.06072', 2691000.00, 2700926.00, 2691000.00, 108037.00, 6458.00, 19375.00, 0.00, 2824870.00, 108037.00, 27009.00, 6458.00, 19375.00, 0.00, 160879.00, 2663991.00, 1, '2026-09-22 20:27:22', '2026-09-22 20:27:24'),
(128, '08', '2026', 27, '199408272025211064', 'Agus Priyanto, S.Kom', 'Penata Layanan Operasional', '01.103.06052', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:27:22', '2026-09-22 20:27:24'),
(129, '08', '2026', 28, '198108042025211043', 'Dwi Imam Fitriono', 'Operator Layanan Operasional', '01.103.06053', 2050000.00, 2700926.00, 2050000.00, 108037.00, 4920.00, 14760.00, 0.00, 2177717.00, 108037.00, 27009.00, 4920.00, 14760.00, 0.00, 154726.00, 2022991.00, 1, '2026-09-22 20:27:22', '2026-09-22 20:27:24'),
(130, '08', '2026', 29, '199704252025212053', 'Dwita Gladea, S.Pd', 'Penata Layanan Operasional', '01.103.06076', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:27:22', '2026-09-22 20:27:24'),
(131, '08', '2026', 30, '199009282025212070', 'Ermi Susanti, S.Pd.', 'Penata Layanan Operasional', '01.103.06074', 2500000.00, 2700926.00, 2500000.00, 108037.00, 6000.00, 18000.00, 0.00, 2632037.00, 108037.00, 27009.00, 6000.00, 18000.00, 0.00, 159046.00, 2472991.00, 1, '2026-09-22 20:27:22', '2026-09-22 20:27:24'),
(132, '08', '2026', 31, '198511242025212055', 'Iis Sugiarti, A.Md.', 'Pengelola Layanan Operasional', '01.103.06099', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:27:22', '2026-09-22 20:27:24'),
(133, '08', '2026', 32, '199407152025211056', 'Julio Odi Ardika, A.Md', 'Pengelola Layanan Operasional', '01.103.06033', 3600000.00, 3600000.00, 3600000.00, 144000.00, 8640.00, 25920.00, 0.00, 3778560.00, 144000.00, 36000.00, 8640.00, 25920.00, 0.00, 214560.00, 3564000.00, 1, '2026-09-22 20:27:22', '2026-09-22 20:27:24'),
(134, '08', '2026', 33, '199811062025211036', 'Moch. Dany Rozid Wafa', 'Operator Layanan Operasional', '01.103.06067', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:27:22', '2026-09-22 20:27:24'),
(135, '08', '2026', 34, '198903222025211056', 'Moh. Marlan Saibani', 'Operator Layanan Operasional', '01.103.06061', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:27:22', '2026-09-22 20:27:24'),
(136, '08', '2026', 35, '197801082025211038', 'Muhammad Bahir', 'Pengelola Umum Operasional', '01.103.06068', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:27:22', '2026-09-22 20:27:24'),
(137, '08', '2026', 36, '199602142025211073', 'Muhammad Faqih Iqbal, S.Kom', 'Penata Layanan Operasional', '01.103.05793', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:27:22', '2026-09-22 20:27:24'),
(138, '08', '2026', 37, '199207172025211070', 'Muhammad Rifqil Anam, S.Kom', 'Penata Layanan Operasional', '01.103.06050', 3700000.00, 3700000.00, 3700000.00, 148000.00, 8880.00, 26640.00, 0.00, 3883520.00, 148000.00, 37000.00, 8880.00, 26640.00, 0.00, 220520.00, 3663000.00, 1, '2026-09-22 20:27:22', '2026-09-22 20:27:24'),
(139, '08', '2026', 38, '198705202025212059', 'Nur Handayani', 'Operator Layanan Operasional', '01.103.06073', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:27:22', '2026-09-22 20:27:24'),
(140, '08', '2026', 39, '198708182025212094', 'Sulistiyowati', 'Operator Layanan Operasional', '01.103.06071', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:27:22', '2026-09-22 20:27:24'),
(141, '08', '2026', 40, '198504162025211050', 'Wahyu Indra Kusuma', 'Operator Layanan Operasional', '01.103.06064', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:27:22', '2026-09-22 20:27:24'),
(142, '08', '2026', 41, '197808152025211058', 'Whinnaryo', 'Operator Layanan Operasional', '01.103.06062', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:27:22', '2026-09-22 20:27:24'),
(143, '08', '2026', 42, '199501262025212064', 'Yania Noviantika Ls, S.E', 'Penata Layanan Operasional', '01.103.06043', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:27:22', '2026-09-22 20:27:24'),
(144, '08', '2026', 43, '199506132025212082', 'Yuniar Hana Pratiwi, S.Kom', 'Penata Layanan Operasional', '01.103.06089', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:27:22', '2026-09-22 20:27:24'),
(145, '09', '2026', 26, '197202162025211017', 'Abdul Kholis, A.Md', 'Pengelola Layanan Operasional', '01.103.06072', 2691000.00, 2700926.00, 2691000.00, 108037.00, 6458.00, 19375.00, 0.00, 2824870.00, 108037.00, 27009.00, 6458.00, 19375.00, 0.00, 160879.00, 2663991.00, 1, '2026-09-22 20:27:30', '2026-09-22 20:27:32'),
(146, '09', '2026', 27, '199408272025211064', 'Agus Priyanto, S.Kom', 'Penata Layanan Operasional', '01.103.06052', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:27:30', '2026-09-22 20:27:32'),
(147, '09', '2026', 28, '198108042025211043', 'Dwi Imam Fitriono', 'Operator Layanan Operasional', '01.103.06053', 2050000.00, 2700926.00, 2050000.00, 108037.00, 4920.00, 14760.00, 0.00, 2177717.00, 108037.00, 27009.00, 4920.00, 14760.00, 0.00, 154726.00, 2022991.00, 1, '2026-09-22 20:27:30', '2026-09-22 20:27:32'),
(148, '09', '2026', 29, '199704252025212053', 'Dwita Gladea, S.Pd', 'Penata Layanan Operasional', '01.103.06076', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:27:30', '2026-09-22 20:27:32'),
(149, '09', '2026', 30, '199009282025212070', 'Ermi Susanti, S.Pd.', 'Penata Layanan Operasional', '01.103.06074', 2500000.00, 2700926.00, 2500000.00, 108037.00, 6000.00, 18000.00, 0.00, 2632037.00, 108037.00, 27009.00, 6000.00, 18000.00, 0.00, 159046.00, 2472991.00, 1, '2026-09-22 20:27:30', '2026-09-22 20:27:32'),
(150, '09', '2026', 31, '198511242025212055', 'Iis Sugiarti, A.Md.', 'Pengelola Layanan Operasional', '01.103.06099', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:27:30', '2026-09-22 20:27:32'),
(151, '09', '2026', 32, '199407152025211056', 'Julio Odi Ardika, A.Md', 'Pengelola Layanan Operasional', '01.103.06033', 3600000.00, 3600000.00, 3600000.00, 144000.00, 8640.00, 25920.00, 0.00, 3778560.00, 144000.00, 36000.00, 8640.00, 25920.00, 0.00, 214560.00, 3564000.00, 1, '2026-09-22 20:27:30', '2026-09-22 20:27:32'),
(152, '09', '2026', 33, '199811062025211036', 'Moch. Dany Rozid Wafa', 'Operator Layanan Operasional', '01.103.06067', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:27:30', '2026-09-22 20:27:32'),
(153, '09', '2026', 34, '198903222025211056', 'Moh. Marlan Saibani', 'Operator Layanan Operasional', '01.103.06061', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:27:30', '2026-09-22 20:27:32'),
(154, '09', '2026', 35, '197801082025211038', 'Muhammad Bahir', 'Pengelola Umum Operasional', '01.103.06068', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:27:30', '2026-09-22 20:27:32'),
(155, '09', '2026', 36, '199602142025211073', 'Muhammad Faqih Iqbal, S.Kom', 'Penata Layanan Operasional', '01.103.05793', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:27:30', '2026-09-22 20:27:32'),
(156, '09', '2026', 37, '199207172025211070', 'Muhammad Rifqil Anam, S.Kom', 'Penata Layanan Operasional', '01.103.06050', 3700000.00, 3700000.00, 3700000.00, 148000.00, 8880.00, 26640.00, 0.00, 3883520.00, 148000.00, 37000.00, 8880.00, 26640.00, 0.00, 220520.00, 3663000.00, 1, '2026-09-22 20:27:30', '2026-09-22 20:27:32');
INSERT INTO `gaji_induk_pppk_paruh_waktu` (`id`, `bulan`, `tahun`, `pegawai_id`, `nip`, `nama`, `jabatan`, `no_rekening`, `upah_pokok`, `dasar_bpjs`, `dasar_jkk_jkm`, `tunjangan_bpjs`, `tunjangan_jkk`, `tunjangan_jkm`, `tunjangan_pembulatan`, `bruto`, `potongan_bpjs_4`, `potongan_bpjs_1`, `potongan_jkk`, `potongan_jkm`, `potongan_pph`, `jumlah_potongan`, `bersih`, `is_locked`, `created_at`, `updated_at`) VALUES
(157, '09', '2026', 38, '198705202025212059', 'Nur Handayani', 'Operator Layanan Operasional', '01.103.06073', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:27:30', '2026-09-22 20:27:32'),
(158, '09', '2026', 39, '198708182025212094', 'Sulistiyowati', 'Operator Layanan Operasional', '01.103.06071', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:27:30', '2026-09-22 20:27:32'),
(159, '09', '2026', 40, '198504162025211050', 'Wahyu Indra Kusuma', 'Operator Layanan Operasional', '01.103.06064', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:27:30', '2026-09-22 20:27:32'),
(160, '09', '2026', 41, '197808152025211058', 'Whinnaryo', 'Operator Layanan Operasional', '01.103.06062', 2000000.00, 2700926.00, 2000000.00, 108037.00, 4800.00, 14400.00, 0.00, 2127237.00, 108037.00, 27009.00, 4800.00, 14400.00, 0.00, 154246.00, 1972991.00, 1, '2026-09-22 20:27:30', '2026-09-22 20:27:32'),
(161, '09', '2026', 42, '199501262025212064', 'Yania Noviantika Ls, S.E', 'Penata Layanan Operasional', '01.103.06043', 2400000.00, 2700926.00, 2400000.00, 108037.00, 5760.00, 17280.00, 0.00, 2531077.00, 108037.00, 27009.00, 5760.00, 17280.00, 0.00, 158086.00, 2372991.00, 1, '2026-09-22 20:27:30', '2026-09-22 20:27:32'),
(162, '09', '2026', 43, '199506132025212082', 'Yuniar Hana Pratiwi, S.Kom', 'Penata Layanan Operasional', '01.103.06089', 2300000.00, 2700926.00, 2300000.00, 108037.00, 5520.00, 16560.00, 0.00, 2430117.00, 108037.00, 27009.00, 5520.00, 16560.00, 0.00, 157126.00, 2272991.00, 1, '2026-09-22 20:27:30', '2026-09-22 20:27:32');

-- --------------------------------------------------------

--
-- Table structure for table `gaji_tambahan_pns`
--

CREATE TABLE `gaji_tambahan_pns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis` varchar(20) NOT NULL DEFAULT 'thr',
  `bulan_cair` varchar(2) NOT NULL,
  `tahun_cair` varchar(4) NOT NULL,
  `bulan_dasar` varchar(2) NOT NULL,
  `tahun_dasar` varchar(4) NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `golongan` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `gaji_pokok` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_suami_istri` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_anak` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_jabatan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_fungsional` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_umum` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_beras` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_pph` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_pembulatan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `kotor_sementara` decimal(15,2) NOT NULL DEFAULT 0.00,
  `kotor_resmi` decimal(15,2) NOT NULL DEFAULT 0.00,
  `potongan_pph` decimal(15,2) NOT NULL DEFAULT 0.00,
  `jumlah_potongan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `bersih_sementara` decimal(15,2) NOT NULL DEFAULT 0.00,
  `bersih_resmi` decimal(15,2) NOT NULL DEFAULT 0.00,
  `bruto_dasar_pph` decimal(15,2) NOT NULL DEFAULT 0.00,
  `bruto_gaji_induk` decimal(15,2) NOT NULL DEFAULT 0.00,
  `pph_gaji_induk` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_bruto_akumulasi` decimal(15,2) NOT NULL DEFAULT 0.00,
  `kategori_ter` varchar(5) DEFAULT NULL,
  `tarif_ter_persen` decimal(5,2) NOT NULL DEFAULT 0.00,
  `is_locked` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gaji_tambahan_pns`
--

INSERT INTO `gaji_tambahan_pns` (`id`, `jenis`, `bulan_cair`, `tahun_cair`, `bulan_dasar`, `tahun_dasar`, `pegawai_id`, `nip`, `nama`, `golongan`, `jabatan`, `gaji_pokok`, `tunjangan_suami_istri`, `tunjangan_anak`, `tunjangan_jabatan`, `tunjangan_fungsional`, `tunjangan_umum`, `tunjangan_beras`, `tunjangan_pph`, `tunjangan_pembulatan`, `kotor_sementara`, `kotor_resmi`, `potongan_pph`, `jumlah_potongan`, `bersih_sementara`, `bersih_resmi`, `bruto_dasar_pph`, `bruto_gaji_induk`, `pph_gaji_induk`, `total_bruto_akumulasi`, `kategori_ter`, `tarif_ter_persen`, `is_locked`, `created_at`, `updated_at`) VALUES
(37, 'thr', '03', '2026', '02', '2026', 3, '197311171999031006', 'Harry Rudiyanto, S.Kom, M.M', 'IV/b', 'Sekretaris', 4971700.00, 497170.00, 198868.00, 980000.00, 0.00, 0.00, 289680.00, 655041.00, 82.00, 7592459.00, 7592541.00, 655041.00, 655041.00, 6937418.00, 6937500.00, 6937418.00, 7251056.00, 54383.00, 14188474.00, 'B', 5.00, 1, '2026-09-23 18:51:12', '2026-09-23 18:53:46'),
(38, 'thr', '03', '2026', '02', '2026', 4, '197406072007011008', 'Purnomo, S.H.', 'III/c', 'JF Penata Perizinan Ahli Muda', 4528900.00, 452890.00, 90578.00, 0.00, 0.00, 185000.00, 217260.00, 224061.00, 72.00, 5698689.00, 5698761.00, 224061.00, 224061.00, 5474628.00, 5474700.00, 5474628.00, 5728400.00, 0.00, 11203028.00, 'B', 2.00, 1, '2026-09-23 18:51:12', '2026-09-23 18:53:46'),
(40, 'thr', '03', '2026', '02', '2026', 6, '197408122014062001', 'Vitta Adi Rosewaty Jengkar', 'II/c', 'Pengadministrasi Perkantoran', 3606500.00, 360650.00, 0.00, 0.00, 0.00, 180000.00, 144840.00, 153729.00, 10.00, 4445719.00, 4445729.00, 153729.00, 153729.00, 4291990.00, 4292000.00, 4291990.00, 4492499.00, 0.00, 8784489.00, 'A', 1.75, 1, '2026-09-23 18:51:12', '2026-09-23 18:53:46'),
(41, 'thr', '03', '2026', '02', '2026', 7, '198102232006042012', 'Riski Tessa Malela, S.E., MA', 'IV/b', 'Penelaah Teknis Kebijakan', 4819900.00, 481990.00, 192796.00, 0.00, 0.00, 190000.00, 289680.00, 442035.00, 34.00, 6416401.00, 6416435.00, 442035.00, 442035.00, 5974366.00, 5974400.00, 5974366.00, 6248024.00, 46861.00, 12222390.00, 'A', 4.00, 1, '2026-09-23 18:51:12', '2026-09-23 18:53:46'),
(42, 'thr', '03', '2026', '02', '2026', 8, '198102232009021003', 'Muhammad Muzni Kharis, A.Md', 'III/c', 'Kasubbag Umum dan Kepegawaian', 3760100.00, 376010.00, 75202.00, 540000.00, 0.00, 0.00, 217260.00, 152449.00, 28.00, 5121021.00, 5121049.00, 152449.00, 152449.00, 4968572.00, 4968600.00, 4968572.00, 5194721.00, 0.00, 10163293.00, 'B', 1.50, 1, '2026-09-23 18:51:12', '2026-09-23 18:53:46'),
(43, 'thr', '03', '2026', '02', '2026', 9, '198409272003121001', 'Sukirno, S.STP, M.M', 'IV/b', 'Sekretaris', 4530100.00, 453010.00, 181204.00, 1260000.00, 0.00, 0.00, 289680.00, 633814.00, 6.00, 7347808.00, 7347814.00, 633814.00, 633814.00, 6713994.00, 6714000.00, 6713994.00, 7014456.00, 52609.00, 13728450.00, 'B', 5.00, 1, '2026-09-23 18:51:12', '2026-09-23 18:53:46'),
(44, 'thr', '03', '2026', '02', '2026', 10, '198612162020122008', 'Ratih Prasastianila Muna, A.Md', 'II/d', 'Pengolah Data dan Informasi', 2756800.00, 275680.00, 110272.00, 0.00, 0.00, 180000.00, 289680.00, 92303.00, 68.00, 3704735.00, 3704803.00, 92303.00, 92303.00, 3612432.00, 3612500.00, 3612432.00, 3771807.00, 0.00, 7384239.00, 'A', 1.25, 1, '2026-09-23 18:51:12', '2026-09-23 18:53:46'),
(45, 'thr', '03', '2026', '02', '2026', 11, '198901092022031007', 'Yanuar Albab Baihaqi, S.E.Sy', 'III/a', 'Penelaah Teknis Kebijakan', 2873500.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 64118.00, 80.00, 3195038.00, 3195118.00, 64118.00, 64118.00, 3130920.00, 3131000.00, 3130920.00, 3280845.00, 0.00, 6411765.00, 'A', 1.00, 1, '2026-09-23 18:51:12', '2026-09-23 18:53:46'),
(46, 'thr', '03', '2026', '02', '2026', 12, '198910192020122011', 'Istikomah, S.E.', 'III/b', 'Penelaah Teknis Kebijakan', 3089300.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 85676.00, 80.00, 3432396.00, 3432476.00, 85676.00, 85676.00, 3346720.00, 3346800.00, 3346720.00, 3507349.00, 0.00, 6854069.00, 'A', 1.25, 1, '2026-09-23 18:51:12', '2026-09-23 18:53:46'),
(47, 'thr', '03', '2026', '02', '2026', 13, '199102052022031003', 'Ahmad Rozi, S.E.', 'III/a', 'JF Penata Kelola Penanaman Modal Ahli Pertama', 2873500.00, 287350.00, 57470.00, 0.00, 0.00, 185000.00, 217260.00, 75112.00, 20.00, 3695692.00, 3695712.00, 75112.00, 75112.00, 3620580.00, 3620600.00, 3620580.00, 3890582.00, 0.00, 7511162.00, 'B', 1.00, 1, '2026-09-23 18:51:12', '2026-09-23 18:53:46'),
(48, 'thr', '03', '2026', '02', '2026', 14, '199210012020122013', 'Millatina Hanifah, S.E.Sy.', 'III/b', 'JF Penata Kelola Penanaman Modal Ahli Pertama', 3089300.00, 308930.00, 123572.00, 0.00, 0.00, 185000.00, 289680.00, 122563.00, 18.00, 4119045.00, 4119063.00, 122563.00, 122563.00, 3996482.00, 3996500.00, 3996482.00, 4174411.00, 0.00, 8170893.00, 'A', 1.50, 1, '2026-09-23 18:51:12', '2026-09-23 18:53:46'),
(49, 'thr', '03', '2026', '02', '2026', 15, '199401252022032008', 'Wulan Suryani, A.Md.Kom', 'II/c', 'Pengolah Data dan Informasi', 2564200.00, 256420.00, 51284.00, 0.00, 0.00, 180000.00, 217260.00, 66850.00, 36.00, 3336014.00, 3336050.00, 66850.00, 66850.00, 3269164.00, 3269200.00, 3269164.00, 3415856.00, 0.00, 6685020.00, 'A', 1.00, 1, '2026-09-23 18:51:12', '2026-09-23 18:53:46'),
(50, 'thr', '03', '2026', '02', '2026', 16, '199608132022032018', 'Noor Falaisifa, A.Md', 'II/c', 'Pengolah Data dan Informasi', 2564200.00, 0.00, 0.00, 0.00, 0.00, 180000.00, 72420.00, 28838.00, 80.00, 2845458.00, 2845538.00, 28838.00, 28838.00, 2816620.00, 2816700.00, 2816620.00, 2951004.00, 0.00, 5767624.00, 'A', 0.50, 1, '2026-09-23 18:51:12', '2026-09-23 18:53:46'),
(51, 'thr', '03', '2026', '02', '2026', 17, '199609172022032021', 'Nur Hanifah, A.Md', 'II/c', 'Pengolah Data dan Informasi', 2564200.00, 256420.00, 51284.00, 0.00, 0.00, 180000.00, 217260.00, 66850.00, 36.00, 3336014.00, 3336050.00, 66850.00, 66850.00, 3269164.00, 3269200.00, 3269164.00, 3415856.00, 0.00, 6685020.00, 'A', 1.00, 1, '2026-09-23 18:51:12', '2026-09-23 18:53:46'),
(52, 'thr', '03', '2026', '02', '2026', 18, '199610212025042002', 'Aqilatul Ulya, S.E', 'III/a', 'JF Penata Perizinan Ahli Pertama', 2228560.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 0.00, 20.00, 2485980.00, 2486000.00, 0.00, 0.00, 2485980.00, 2486000.00, 2485980.00, 2603917.00, 0.00, 5089897.00, 'A', 0.00, 1, '2026-09-23 18:51:12', '2026-09-23 18:53:46'),
(53, 'thr', '03', '2026', '02', '2026', 19, '199611152020122016', 'Nadya Ayu Popi Haluansa, S.E', 'III/b', 'JF Penata Kelola Penanaman Modal Ahli Pertama', 3089300.00, 308930.00, 123572.00, 0.00, 0.00, 185000.00, 289680.00, 122563.00, 18.00, 4119045.00, 4119063.00, 122563.00, 122563.00, 3996482.00, 3996500.00, 3996482.00, 4174411.00, 0.00, 8170893.00, 'A', 1.50, 1, '2026-09-23 18:51:12', '2026-09-23 18:53:46'),
(54, 'thr', '03', '2026', '02', '2026', 20, '199801092022031007', 'Didik Yogo Suro Prasojo, S.Kom', 'III/a', 'JF Pranata Komputer Ahli Pertama', 2873500.00, 287350.00, 0.00, 0.00, 540000.00, 0.00, 144840.00, 119571.00, 10.00, 3965261.00, 3965271.00, 119571.00, 119571.00, 3845690.00, 3845700.00, 3845690.00, 4125711.00, 0.00, 7971401.00, 'A', 1.50, 1, '2026-09-23 18:51:12', '2026-09-23 18:53:46'),
(55, 'thr', '03', '2026', '02', '2026', 24, '197006161989031001', 'Ade Suangkat, S.E', 'IV/b', 'Kepala Dinas', 5289800.00, 528980.00, 105796.00, 2025000.00, 0.00, 0.00, 217260.00, 1083815.00, 64.00, 9250650.00, 9250715.00, 1083815.00, 1083815.00, 8166836.00, 8166900.00, 8166836.00, 8535602.00, 85357.00, 16702438.00, 'B', 7.00, 1, '2026-09-23 18:51:12', '2026-09-23 18:53:46'),
(56, 'gaji_13', '06', '2026', '05', '2026', 3, '197311171999031006', 'Harry Rudiyanto, S.Kom, M.M', 'IV/c', 'Sekretaris', 5182000.00, 518200.00, 207280.00, 980000.00, 0.00, 0.00, 289680.00, 820309.00, 40.00, 7997469.00, 7997509.00, 820309.00, 820309.00, 7177160.00, 7177200.00, 7177160.00, 7793606.00, 77937.00, 14970766.00, 'B', 6.00, 1, '2026-09-23 18:54:08', '2026-09-23 18:56:51'),
(57, 'gaji_13', '06', '2026', '05', '2026', 4, '197406072007011008', 'Purnomo, S.H.', 'III/c', 'JF Penata Perizinan Ahli Muda', 4528900.00, 452890.00, 90578.00, 0.00, 0.00, 185000.00, 217260.00, 224061.00, 72.00, 5698689.00, 5698761.00, 224061.00, 224061.00, 5474628.00, 5474700.00, 5474628.00, 5728400.00, 0.00, 11203028.00, 'B', 2.00, 1, '2026-09-23 18:54:08', '2026-09-23 18:56:51'),
(58, 'gaji_13', '06', '2026', '05', '2026', 6, '197408122014062001', 'Vitta Adi Rosewaty Jengkar', 'II/c', 'Pengadministrasi Perkantoran', 3606500.00, 360650.00, 0.00, 0.00, 0.00, 180000.00, 144840.00, 153729.00, 10.00, 4445719.00, 4445729.00, 153729.00, 153729.00, 4291990.00, 4292000.00, 4291990.00, 4492499.00, 0.00, 8784489.00, 'A', 1.75, 1, '2026-09-23 18:54:08', '2026-09-23 18:56:51'),
(59, 'gaji_13', '06', '2026', '05', '2026', 7, '198102232006042012', 'Riski Tessa Malela, S.E., MA', 'IV/b', 'Penelaah Teknis Kebijakan', 4819900.00, 481990.00, 192796.00, 0.00, 0.00, 190000.00, 289680.00, 442035.00, 34.00, 6416401.00, 6416435.00, 442035.00, 442035.00, 5974366.00, 5974400.00, 5974366.00, 6248024.00, 46861.00, 12222390.00, 'A', 4.00, 1, '2026-09-23 18:54:08', '2026-09-23 18:56:51'),
(60, 'gaji_13', '06', '2026', '05', '2026', 8, '198102232009021003', 'Muhammad Muzni Kharis, A.Md', 'III/c', 'Kasubbag Umum dan Kepegawaian', 3760100.00, 376010.00, 75202.00, 540000.00, 0.00, 0.00, 217260.00, 152449.00, 28.00, 5121021.00, 5121049.00, 152449.00, 152449.00, 4968572.00, 4968600.00, 4968572.00, 5194721.00, 0.00, 10163293.00, 'B', 1.50, 1, '2026-09-23 18:54:08', '2026-09-23 18:56:51'),
(62, 'gaji_13', '06', '2026', '05', '2026', 10, '198612162020122008', 'Ratih Prasastianila Muna, A.Md', 'II/d', 'Pengolah Data dan Informasi', 2756800.00, 275680.00, 110272.00, 0.00, 0.00, 180000.00, 289680.00, 92303.00, 68.00, 3704735.00, 3704803.00, 92303.00, 92303.00, 3612432.00, 3612500.00, 3612432.00, 3771807.00, 0.00, 7384239.00, 'A', 1.25, 1, '2026-09-23 18:54:08', '2026-09-23 18:56:51'),
(63, 'gaji_13', '06', '2026', '05', '2026', 11, '198901092022031007', 'Yanuar Albab Baihaqi, S.E.Sy', 'III/b', 'Penelaah Teknis Kebijakan', 3089300.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 85676.00, 80.00, 3432396.00, 3432476.00, 85676.00, 85676.00, 3346720.00, 3346800.00, 3346720.00, 3507349.00, 0.00, 6854069.00, 'A', 1.25, 1, '2026-09-23 18:54:08', '2026-09-23 18:56:51'),
(64, 'gaji_13', '06', '2026', '05', '2026', 12, '198910192020122011', 'Istikomah, S.E.', 'III/b', 'Penelaah Teknis Kebijakan', 3089300.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 85676.00, 80.00, 3432396.00, 3432476.00, 85676.00, 85676.00, 3346720.00, 3346800.00, 3346720.00, 3507349.00, 0.00, 6854069.00, 'A', 1.25, 1, '2026-09-23 18:54:08', '2026-09-23 18:56:51'),
(65, 'gaji_13', '06', '2026', '05', '2026', 13, '199102052022031003', 'Ahmad Rozi, S.E.', 'III/a', 'JF Penata Kelola Penanaman Modal Ahli Pertama', 2964000.00, 296400.00, 118560.00, 0.00, 0.00, 185000.00, 289680.00, 78783.00, 60.00, 3932423.00, 3932483.00, 78783.00, 78783.00, 3853640.00, 3853700.00, 3853640.00, 4024653.00, 0.00, 7878293.00, 'B', 1.00, 1, '2026-09-23 18:54:08', '2026-09-23 18:56:51'),
(66, 'gaji_13', '06', '2026', '05', '2026', 14, '199210012020122013', 'Millatina Hanifah, S.E.Sy.', 'III/b', 'JF Penata Kelola Penanaman Modal Ahli Pertama', 3089300.00, 308930.00, 123572.00, 0.00, 0.00, 185000.00, 289680.00, 122563.00, 18.00, 4119045.00, 4119063.00, 122563.00, 122563.00, 3996482.00, 3996500.00, 3996482.00, 4174411.00, 0.00, 8170893.00, 'A', 1.50, 1, '2026-09-23 18:54:08', '2026-09-23 18:56:51'),
(67, 'gaji_13', '06', '2026', '05', '2026', 15, '199401252022032008', 'Wulan Suryani, A.Md.Kom', 'II/d', 'Pengolah Data dan Informasi', 2756800.00, 275680.00, 55136.00, 0.00, 0.00, 180000.00, 217260.00, 89087.00, 24.00, 3573963.00, 3573987.00, 89087.00, 89087.00, 3484876.00, 3484900.00, 3484876.00, 3642046.00, 0.00, 7126922.00, 'A', 1.25, 1, '2026-09-23 18:54:08', '2026-09-23 18:56:51'),
(68, 'gaji_13', '06', '2026', '05', '2026', 16, '199608132022032018', 'Noor Falaisifa, A.Md', 'II/d', 'Pengolah Data dan Informasi', 2756800.00, 0.00, 0.00, 0.00, 0.00, 180000.00, 72420.00, 46218.00, 80.00, 3055438.00, 3055518.00, 46218.00, 46218.00, 3009220.00, 3009300.00, 3009220.00, 3153157.00, 0.00, 6162377.00, 'A', 0.75, 1, '2026-09-23 18:54:08', '2026-09-23 18:56:51'),
(69, 'gaji_13', '06', '2026', '05', '2026', 17, '199609172022032021', 'Nur Hanifah, A.Md', 'II/d', 'Pengolah Data dan Informasi', 2756800.00, 275680.00, 55136.00, 0.00, 0.00, 180000.00, 217260.00, 89087.00, 24.00, 3573963.00, 3573987.00, 89087.00, 89087.00, 3484876.00, 3484900.00, 3484876.00, 3642046.00, 0.00, 7126922.00, 'A', 1.25, 1, '2026-09-23 18:54:08', '2026-09-23 18:56:51'),
(70, 'gaji_13', '06', '2026', '05', '2026', 18, '199610212025042002', 'Aqilatul Ulya, S.E', 'III/a', 'JF Penata Perizinan Ahli Pertama', 2785700.00, 0.00, 0.00, 0.00, 0.00, 185000.00, 72420.00, 46739.00, 80.00, 3089859.00, 3089939.00, 46739.00, 46739.00, 3043120.00, 3043200.00, 3043120.00, 3188691.00, 0.00, 6231811.00, 'A', 0.75, 1, '2026-09-23 18:54:08', '2026-09-23 18:56:51'),
(71, 'gaji_13', '06', '2026', '05', '2026', 19, '199611152020122016', 'Nadya Ayu Popi Haluansa, S.E', 'III/b', 'JF Penata Kelola Penanaman Modal Ahli Pertama', 3089300.00, 308930.00, 123572.00, 0.00, 0.00, 185000.00, 289680.00, 122563.00, 18.00, 4119045.00, 4119063.00, 122563.00, 122563.00, 3996482.00, 3996500.00, 3996482.00, 4174411.00, 0.00, 8170893.00, 'A', 1.50, 1, '2026-09-23 18:54:08', '2026-09-23 18:56:51'),
(72, 'gaji_13', '06', '2026', '05', '2026', 20, '199801092022031007', 'Didik Yogo Suro Prasojo, S.Kom', 'III/a', 'JF Pranata Komputer Ahli Pertama', 2964000.00, 296400.00, 0.00, 0.00, 540000.00, 0.00, 144840.00, 123232.00, 60.00, 4068472.00, 4068532.00, 123232.00, 123232.00, 3945240.00, 3945300.00, 3945240.00, 4270256.00, 0.00, 8215496.00, 'A', 1.50, 1, '2026-09-23 18:54:08', '2026-09-23 18:56:51'),
(73, 'gaji_13', '06', '2026', '05', '2026', 24, '197006161989031001', 'Ade Suangkat, S.E', 'IV/b', 'Kepala Dinas', 5289800.00, 528980.00, 105796.00, 2025000.00, 0.00, 0.00, 217260.00, 1083814.00, 64.00, 9250650.00, 9250714.00, 1083814.00, 1083814.00, 8166836.00, 8166900.00, 8166836.00, 8535602.00, 85357.00, 16702438.00, 'B', 7.00, 1, '2026-09-23 18:54:08', '2026-09-23 18:56:51');

-- --------------------------------------------------------

--
-- Table structure for table `gaji_tambahan_pppk`
--

CREATE TABLE `gaji_tambahan_pppk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis` varchar(20) NOT NULL DEFAULT 'thr',
  `bulan_cair` varchar(2) NOT NULL,
  `tahun_cair` varchar(4) NOT NULL,
  `bulan_dasar` varchar(2) NOT NULL,
  `tahun_dasar` varchar(4) NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `golongan` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `tmt` date DEFAULT NULL,
  `masa_kerja_bulan` int(11) NOT NULL DEFAULT 12,
  `persen_proporsional` decimal(5,2) NOT NULL DEFAULT 100.00,
  `gaji_pokok_dasar` decimal(15,2) NOT NULL DEFAULT 0.00,
  `gaji_pokok` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_suami_istri` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_anak` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_jabatan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_fungsional` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_umum` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_beras` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_pph` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_pembulatan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `kotor_sementara` decimal(15,2) NOT NULL DEFAULT 0.00,
  `kotor_resmi` decimal(15,2) NOT NULL DEFAULT 0.00,
  `potongan_pph` decimal(15,2) NOT NULL DEFAULT 0.00,
  `jumlah_potongan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `bersih_sementara` decimal(15,2) NOT NULL DEFAULT 0.00,
  `bersih_resmi` decimal(15,2) NOT NULL DEFAULT 0.00,
  `bruto_dasar_pph` decimal(15,2) NOT NULL DEFAULT 0.00,
  `bruto_gaji_induk` decimal(15,2) NOT NULL DEFAULT 0.00,
  `pph_gaji_induk` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_bruto_akumulasi` decimal(15,2) NOT NULL DEFAULT 0.00,
  `kategori_ter` varchar(5) DEFAULT NULL,
  `tarif_ter_persen` decimal(5,2) NOT NULL DEFAULT 0.00,
  `is_locked` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gaji_tambahan_pppk`
--

INSERT INTO `gaji_tambahan_pppk` (`id`, `jenis`, `bulan_cair`, `tahun_cair`, `bulan_dasar`, `tahun_dasar`, `pegawai_id`, `nip`, `nama`, `golongan`, `jabatan`, `tmt`, `masa_kerja_bulan`, `persen_proporsional`, `gaji_pokok_dasar`, `gaji_pokok`, `tunjangan_suami_istri`, `tunjangan_anak`, `tunjangan_jabatan`, `tunjangan_fungsional`, `tunjangan_umum`, `tunjangan_beras`, `tunjangan_pph`, `tunjangan_pembulatan`, `kotor_sementara`, `kotor_resmi`, `potongan_pph`, `jumlah_potongan`, `bersih_sementara`, `bersih_resmi`, `bruto_dasar_pph`, `bruto_gaji_induk`, `pph_gaji_induk`, `total_bruto_akumulasi`, `kategori_ter`, `tarif_ter_persen`, `is_locked`, `created_at`, `updated_at`) VALUES
(22, 'thr', '03', '2026', '02', '2026', 21, '199305262025211041', 'Achmad Adi Kusuma, S.Kom', 'IX', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '2025-07-01', 8, 66.67, 3203600.00, 2135733.00, 213573.00, 42714.00, 0.00, 0.00, 123333.00, 144840.00, 0.00, 68.00, 2660193.00, 2660261.00, 34161.00, 34161.00, 2626032.00, 2626100.00, 2660193.00, 4171968.00, 0.00, 6832161.00, 'B', 0.50, 1, '2026-09-23 19:22:56', '2026-09-23 19:23:30'),
(23, 'thr', '03', '2026', '02', '2026', 22, '199605222025211019', 'Muhammad Ilham Insani, S.Kom', 'IX', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '2025-07-01', 8, 66.67, 3203600.00, 2135733.00, 213573.00, 0.00, 0.00, 0.00, 123333.00, 96560.00, 0.00, 22.00, 2569199.00, 2569221.00, 66021.00, 66021.00, 2503178.00, 2503200.00, 2569199.00, 4032913.00, 0.00, 6602112.00, 'A', 1.00, 1, '2026-09-23 19:22:56', '2026-09-23 19:23:30'),
(24, 'thr', '03', '2026', '02', '2026', 23, '199610092024211003', 'Fajariawan Prabowo, A.Md.Kom', 'VII', 'JF Pranata Komputer Pelaksana', '2024-03-01', 12, 100.00, 2858800.00, 2858800.00, 285880.00, 114352.00, 0.00, 360000.00, 0.00, 289680.00, 0.00, 60.00, 3908712.00, 3908772.00, 80972.00, 80972.00, 3827740.00, 3827800.00, 3908712.00, 4188485.00, 0.00, 8097197.00, 'B', 1.00, 1, '2026-09-23 19:22:56', '2026-09-23 19:23:30'),
(25, 'gaji_13', '06', '2026', '05', '2026', 21, '199305262025211041', 'Achmad Adi Kusuma, S.Kom', 'IX', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '2025-07-01', 11, 91.67, 3203600.00, 2936633.00, 293663.00, 58732.00, 0.00, 0.00, 169583.00, 199155.00, 0.00, 31.00, 3657766.00, 3657797.00, 78297.00, 78297.00, 3579469.00, 3579500.00, 3657766.00, 4171968.00, 0.00, 7829734.00, 'B', 1.00, 1, '2026-09-23 19:23:48', '2026-09-23 19:24:37'),
(26, 'gaji_13', '06', '2026', '05', '2026', 22, '199605222025211019', 'Muhammad Ilham Insani, S.Kom', 'IX', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '2025-07-01', 11, 91.67, 3203600.00, 2936633.00, 293663.00, 0.00, 0.00, 0.00, 169583.00, 132770.00, 0.00, 34.00, 3532649.00, 3532683.00, 113483.00, 113483.00, 3419166.00, 3419200.00, 3532649.00, 4032913.00, 0.00, 7565562.00, 'A', 1.50, 1, '2026-09-23 19:23:48', '2026-09-23 19:24:37'),
(27, 'gaji_13', '06', '2026', '05', '2026', 23, '199610092024211003', 'Fajariawan Prabowo, A.Md.Kom', 'VII', 'JF Pranata Komputer Pelaksana', '2024-03-01', 12, 100.00, 2948800.00, 2948800.00, 294880.00, 117952.00, 0.00, 360000.00, 0.00, 289680.00, 0.00, 86.00, 4011312.00, 4011398.00, 81998.00, 81998.00, 3929314.00, 3929400.00, 4011312.00, 4188485.00, 0.00, 8199797.00, 'B', 1.00, 1, '2026-09-23 19:23:48', '2026-09-23 19:24:37');

-- --------------------------------------------------------

--
-- Table structure for table `gaji_tambahan_pppk_paruh_waktu`
--

CREATE TABLE `gaji_tambahan_pppk_paruh_waktu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis` varchar(20) NOT NULL DEFAULT 'thr',
  `bulan_cair` varchar(2) NOT NULL DEFAULT '03',
  `tahun_cair` varchar(4) NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `nomor_rekening` varchar(255) DEFAULT NULL,
  `nama_bank` varchar(255) DEFAULT NULL,
  `nama_pada_rekening` varchar(255) DEFAULT NULL,
  `nominal` decimal(15,2) NOT NULL DEFAULT 0.00,
  `potongan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `bersih` decimal(15,2) NOT NULL DEFAULT 0.00,
  `is_locked` tinyint(1) NOT NULL DEFAULT 0,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gaji_tambahan_pppk_paruh_waktu`
--

INSERT INTO `gaji_tambahan_pppk_paruh_waktu` (`id`, `jenis`, `bulan_cair`, `tahun_cair`, `pegawai_id`, `nip`, `nama`, `jabatan`, `nomor_rekening`, `nama_bank`, `nama_pada_rekening`, `nominal`, `potongan`, `bersih`, `is_locked`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'thr', '09', '2026', 26, '197202162025211017', 'Abdul Kholis, A.Md', 'Pengelola Layanan Operasional', '01.103.06072', 'Bank Pekalongan', 'Abdul Kholis', 500000.00, 0.00, 500000.00, 1, 'THR PPPK Paruh Waktu Bulan Maret 2026', '2026-09-23 19:32:30', '2026-09-23 19:32:43'),
(2, 'thr', '09', '2026', 27, '199408272025211064', 'Agus Priyanto, S.Kom', 'Penata Layanan Operasional', '01.103.06052', 'Bank Pekalongan', 'Agus Priyanto', 500000.00, 0.00, 500000.00, 1, 'THR PPPK Paruh Waktu Bulan Maret 2026', '2026-09-23 19:32:30', '2026-09-23 19:32:43'),
(3, 'thr', '09', '2026', 28, '198108042025211043', 'Dwi Imam Fitriono', 'Operator Layanan Operasional', '01.103.06053', 'Bank Pekalongan', 'Dwi Imam Fitriono', 500000.00, 0.00, 500000.00, 1, 'THR PPPK Paruh Waktu Bulan Maret 2026', '2026-09-23 19:32:30', '2026-09-23 19:32:43'),
(4, 'thr', '09', '2026', 29, '199704252025212053', 'Dwita Gladea, S.Pd', 'Penata Layanan Operasional', '01.103.06076', 'Bank Pekalongan', 'Dwita Gladea', 500000.00, 0.00, 500000.00, 1, 'THR PPPK Paruh Waktu Bulan Maret 2026', '2026-09-23 19:32:30', '2026-09-23 19:32:43'),
(5, 'thr', '09', '2026', 30, '199009282025212070', 'Ermi Susanti, S.Pd.', 'Penata Layanan Operasional', '01.103.06074', 'Bank Pekalongan', 'Ermi Susanti', 500000.00, 0.00, 500000.00, 1, 'THR PPPK Paruh Waktu Bulan Maret 2026', '2026-09-23 19:32:30', '2026-09-23 19:32:43'),
(6, 'thr', '09', '2026', 31, '198511242025212055', 'Iis Sugiarti, A.Md.', 'Pengelola Layanan Operasional', '01.103.06099', 'Bank Pekalongan', 'Iis Sugiarti', 500000.00, 0.00, 500000.00, 1, 'THR PPPK Paruh Waktu Bulan Maret 2026', '2026-09-23 19:32:30', '2026-09-23 19:32:43'),
(7, 'thr', '09', '2026', 32, '199407152025211056', 'Julio Odi Ardika, A.Md', 'Pengelola Layanan Operasional', '01.103.06033', 'Bank Pekalongan', 'Julio Odi Ardika', 500000.00, 0.00, 500000.00, 1, 'THR PPPK Paruh Waktu Bulan Maret 2026', '2026-09-23 19:32:30', '2026-09-23 19:32:43'),
(8, 'thr', '09', '2026', 33, '199811062025211036', 'Moch. Dany Rozid Wafa', 'Operator Layanan Operasional', '01.103.06067', 'Bank Pekalongan', 'Moch. Dany Rozid Wafa', 500000.00, 0.00, 500000.00, 1, 'THR PPPK Paruh Waktu Bulan Maret 2026', '2026-09-23 19:32:30', '2026-09-23 19:32:43'),
(9, 'thr', '09', '2026', 34, '198903222025211056', 'Moh. Marlan Saibani', 'Operator Layanan Operasional', '01.103.06061', 'Bank Pekalongan', 'Moh. Marlan Saibani', 500000.00, 0.00, 500000.00, 1, 'THR PPPK Paruh Waktu Bulan Maret 2026', '2026-09-23 19:32:30', '2026-09-23 19:32:43'),
(10, 'thr', '09', '2026', 35, '197801082025211038', 'Muhammad Bahir', 'Pengelola Umum Operasional', '01.103.06068', 'Bank Pekalongan', 'Muhammad Bahir', 500000.00, 0.00, 500000.00, 1, 'THR PPPK Paruh Waktu Bulan Maret 2026', '2026-09-23 19:32:30', '2026-09-23 19:32:43'),
(11, 'thr', '09', '2026', 36, '199602142025211073', 'Muhammad Faqih Iqbal, S.Kom', 'Penata Layanan Operasional', '01.103.05793', 'Bank Pekalongan', 'Muhammad Faqih Iqbal', 500000.00, 0.00, 500000.00, 1, 'THR PPPK Paruh Waktu Bulan Maret 2026', '2026-09-23 19:32:30', '2026-09-23 19:32:43'),
(12, 'thr', '09', '2026', 37, '199207172025211070', 'Muhammad Rifqil Anam, S.Kom', 'Penata Layanan Operasional', '01.103.06050', 'Bank Pekalongan', 'Muhammad Rifqil Anam', 500000.00, 0.00, 500000.00, 1, 'THR PPPK Paruh Waktu Bulan Maret 2026', '2026-09-23 19:32:30', '2026-09-23 19:32:43'),
(13, 'thr', '09', '2026', 38, '198705202025212059', 'Nur Handayani', 'Operator Layanan Operasional', '01.103.06073', 'Bank Pekalongan', 'Nur Handayani', 500000.00, 0.00, 500000.00, 1, 'THR PPPK Paruh Waktu Bulan Maret 2026', '2026-09-23 19:32:30', '2026-09-23 19:32:43'),
(14, 'thr', '09', '2026', 39, '198708182025212094', 'Sulistiyowati', 'Operator Layanan Operasional', '01.103.06071', 'Bank Pekalongan', 'Sulistiyowati', 500000.00, 0.00, 500000.00, 1, 'THR PPPK Paruh Waktu Bulan Maret 2026', '2026-09-23 19:32:30', '2026-09-23 19:32:43'),
(15, 'thr', '09', '2026', 40, '198504162025211050', 'Wahyu Indra Kusuma', 'Operator Layanan Operasional', '01.103.06064', 'Bank Pekalongan', 'Wahyu Indra Kusuma', 500000.00, 0.00, 500000.00, 1, 'THR PPPK Paruh Waktu Bulan Maret 2026', '2026-09-23 19:32:30', '2026-09-23 19:32:43'),
(16, 'thr', '09', '2026', 41, '197808152025211058', 'Whinnaryo', 'Operator Layanan Operasional', '01.103.06062', 'Bank Pekalongan', 'Whinnaryo', 500000.00, 0.00, 500000.00, 1, 'THR PPPK Paruh Waktu Bulan Maret 2026', '2026-09-23 19:32:30', '2026-09-23 19:32:43'),
(17, 'thr', '09', '2026', 42, '199501262025212064', 'Yania Noviantika Ls, S.E', 'Penata Layanan Operasional', '01.103.06043', 'Bank Pekalongan', 'Yania Noviantika Ls', 500000.00, 0.00, 500000.00, 1, 'THR PPPK Paruh Waktu Bulan Maret 2026', '2026-09-23 19:32:30', '2026-09-23 19:32:43'),
(18, 'thr', '09', '2026', 43, '199506132025212082', 'Yuniar Hana Pratiwi, S.Kom', 'Penata Layanan Operasional', '01.103.06089', 'Bank Pekalongan', 'Yuniar Hana Pratiwi', 500000.00, 0.00, 500000.00, 1, 'THR PPPK Paruh Waktu Bulan Maret 2026', '2026-09-23 19:32:30', '2026-09-23 19:32:43'),
(19, 'gaji_13', '09', '2026', 26, '197202162025211017', 'Abdul Kholis, A.Md', 'Pengelola Layanan Operasional', '01.103.06072', 'Bank Pekalongan', 'Abdul Kholis', 500000.00, 0.00, 500000.00, 1, NULL, '2026-09-23 19:32:53', '2026-09-23 19:33:01'),
(20, 'gaji_13', '09', '2026', 27, '199408272025211064', 'Agus Priyanto, S.Kom', 'Penata Layanan Operasional', '01.103.06052', 'Bank Pekalongan', 'Agus Priyanto', 500000.00, 0.00, 500000.00, 1, NULL, '2026-09-23 19:32:53', '2026-09-23 19:33:01'),
(21, 'gaji_13', '09', '2026', 28, '198108042025211043', 'Dwi Imam Fitriono', 'Operator Layanan Operasional', '01.103.06053', 'Bank Pekalongan', 'Dwi Imam Fitriono', 500000.00, 0.00, 500000.00, 1, NULL, '2026-09-23 19:32:53', '2026-09-23 19:33:01'),
(22, 'gaji_13', '09', '2026', 29, '199704252025212053', 'Dwita Gladea, S.Pd', 'Penata Layanan Operasional', '01.103.06076', 'Bank Pekalongan', 'Dwita Gladea', 500000.00, 0.00, 500000.00, 1, NULL, '2026-09-23 19:32:53', '2026-09-23 19:33:01'),
(23, 'gaji_13', '09', '2026', 30, '199009282025212070', 'Ermi Susanti, S.Pd.', 'Penata Layanan Operasional', '01.103.06074', 'Bank Pekalongan', 'Ermi Susanti', 500000.00, 0.00, 500000.00, 1, NULL, '2026-09-23 19:32:53', '2026-09-23 19:33:01'),
(24, 'gaji_13', '09', '2026', 31, '198511242025212055', 'Iis Sugiarti, A.Md.', 'Pengelola Layanan Operasional', '01.103.06099', 'Bank Pekalongan', 'Iis Sugiarti', 500000.00, 0.00, 500000.00, 1, NULL, '2026-09-23 19:32:53', '2026-09-23 19:33:01'),
(25, 'gaji_13', '09', '2026', 32, '199407152025211056', 'Julio Odi Ardika, A.Md', 'Pengelola Layanan Operasional', '01.103.06033', 'Bank Pekalongan', 'Julio Odi Ardika', 500000.00, 0.00, 500000.00, 1, NULL, '2026-09-23 19:32:53', '2026-09-23 19:33:01'),
(26, 'gaji_13', '09', '2026', 33, '199811062025211036', 'Moch. Dany Rozid Wafa', 'Operator Layanan Operasional', '01.103.06067', 'Bank Pekalongan', 'Moch. Dany Rozid Wafa', 500000.00, 0.00, 500000.00, 1, NULL, '2026-09-23 19:32:53', '2026-09-23 19:33:01'),
(27, 'gaji_13', '09', '2026', 34, '198903222025211056', 'Moh. Marlan Saibani', 'Operator Layanan Operasional', '01.103.06061', 'Bank Pekalongan', 'Moh. Marlan Saibani', 500000.00, 0.00, 500000.00, 1, NULL, '2026-09-23 19:32:53', '2026-09-23 19:33:01'),
(28, 'gaji_13', '09', '2026', 35, '197801082025211038', 'Muhammad Bahir', 'Pengelola Umum Operasional', '01.103.06068', 'Bank Pekalongan', 'Muhammad Bahir', 500000.00, 0.00, 500000.00, 1, NULL, '2026-09-23 19:32:53', '2026-09-23 19:33:01'),
(29, 'gaji_13', '09', '2026', 36, '199602142025211073', 'Muhammad Faqih Iqbal, S.Kom', 'Penata Layanan Operasional', '01.103.05793', 'Bank Pekalongan', 'Muhammad Faqih Iqbal', 500000.00, 0.00, 500000.00, 1, NULL, '2026-09-23 19:32:53', '2026-09-23 19:33:01'),
(30, 'gaji_13', '09', '2026', 37, '199207172025211070', 'Muhammad Rifqil Anam, S.Kom', 'Penata Layanan Operasional', '01.103.06050', 'Bank Pekalongan', 'Muhammad Rifqil Anam', 500000.00, 0.00, 500000.00, 1, NULL, '2026-09-23 19:32:53', '2026-09-23 19:33:01'),
(31, 'gaji_13', '09', '2026', 38, '198705202025212059', 'Nur Handayani', 'Operator Layanan Operasional', '01.103.06073', 'Bank Pekalongan', 'Nur Handayani', 500000.00, 0.00, 500000.00, 1, NULL, '2026-09-23 19:32:53', '2026-09-23 19:33:01'),
(32, 'gaji_13', '09', '2026', 39, '198708182025212094', 'Sulistiyowati', 'Operator Layanan Operasional', '01.103.06071', 'Bank Pekalongan', 'Sulistiyowati', 500000.00, 0.00, 500000.00, 1, NULL, '2026-09-23 19:32:53', '2026-09-23 19:33:01'),
(33, 'gaji_13', '09', '2026', 40, '198504162025211050', 'Wahyu Indra Kusuma', 'Operator Layanan Operasional', '01.103.06064', 'Bank Pekalongan', 'Wahyu Indra Kusuma', 500000.00, 0.00, 500000.00, 1, NULL, '2026-09-23 19:32:53', '2026-09-23 19:33:01'),
(34, 'gaji_13', '09', '2026', 41, '197808152025211058', 'Whinnaryo', 'Operator Layanan Operasional', '01.103.06062', 'Bank Pekalongan', 'Whinnaryo', 500000.00, 0.00, 500000.00, 1, NULL, '2026-09-23 19:32:53', '2026-09-23 19:33:01'),
(35, 'gaji_13', '09', '2026', 42, '199501262025212064', 'Yania Noviantika Ls, S.E', 'Penata Layanan Operasional', '01.103.06043', 'Bank Pekalongan', 'Yania Noviantika Ls', 500000.00, 0.00, 500000.00, 1, NULL, '2026-09-23 19:32:53', '2026-09-23 19:33:01'),
(36, 'gaji_13', '09', '2026', 43, '199506132025212082', 'Yuniar Hana Pratiwi, S.Kom', 'Penata Layanan Operasional', '01.103.06089', 'Bank Pekalongan', 'Yuniar Hana Pratiwi', 500000.00, 0.00, 500000.00, 1, NULL, '2026-09-23 19:32:53', '2026-09-23 19:33:01');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_09_16_000001_create_ref_gaji_pokok_pns_table', 1),
(5, '2026_09_16_000002_create_ref_gaji_pokok_pppk_table', 1),
(6, '2026_09_16_000003_create_ref_tunjangan_umum_table', 1),
(7, '2026_09_16_000004_create_ref_kelas_jabatan_table', 1),
(8, '2026_09_16_000005_create_ref_jabatan_table', 1),
(9, '2026_09_16_000006_create_pegawai_table', 1),
(10, '2026_09_16_000007_create_pegawai_pasangan_table', 1),
(11, '2026_09_16_000008_create_pegawai_anak_table', 1),
(12, '2026_09_16_000009_create_payroll_periode_table', 1),
(13, '2026_09_16_000010_create_payroll_gaji_induk_table', 1),
(14, '2026_09_16_000011_create_payroll_tpp_table', 1),
(15, '2026_09_16_000012_create_payroll_rapel_table', 1),
(16, '2026_09_16_000013_create_payroll_rapel_detail_table', 1),
(17, '2026_09_16_045223_add_gaji_kontrak_to_pegawai_table', 2),
(18, '2026_09_16_050519_rename_rekening_columns_in_pegawai_table', 3),
(19, '2026_09_16_063420_add_kp4_fields_to_pegawai_and_keluarga', 4),
(20, '2026_09_21_032340_add_tpp_columns_to_ref_jabatan_table', 5),
(21, '2026_09_21_035246_add_tpp_penyetaraan_to_ref_jabatan_and_pegawai_table', 6),
(22, '2026_09_21_060930_create_pagu_anggarans_table', 7),
(23, '2026_09_22_015459_create_gaji_induk_pns_table', 8),
(24, '2026_09_22_024105_add_is_locked_to_gaji_induk_pns_table', 9),
(25, '2026_09_22_032210_add_tunjangan_columns_to_gaji_induk_pns_table', 10),
(26, '2026_09_22_053225_create_gaji_induk_pppk_table', 11),
(27, '2026_09_22_062939_create_gaji_induk_pppk_paruh_waktu_table', 12),
(28, '2026_09_22_070237_modify_status_kepegawaian_on_pegawai_table', 13),
(29, '2026_09_23_110000_create_tpp_table', 14),
(30, '2026_09_23_120000_create_pegawai_riwayat_table', 15),
(31, '2026_09_24_011450_create_gaji_tambahan_pns_table', 16),
(32, '2026_09_24_015814_create_gaji_tambahan_pppk_table', 17),
(33, '2026_09_24_022638_create_gaji_tambahan_pppk_paruh_waktu_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `pagu_anggarans`
--

CREATE TABLE `pagu_anggarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `kode_rekening` varchar(255) NOT NULL,
  `uraian` varchar(255) NOT NULL,
  `pagu_penetapan` bigint(20) NOT NULL DEFAULT 0,
  `pagu_pergeseran` bigint(20) NOT NULL DEFAULT 0,
  `pagu_perubahan` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pagu_anggarans`
--

INSERT INTO `pagu_anggarans` (`id`, `tahun`, `kode_rekening`, `uraian`, `pagu_penetapan`, `pagu_pergeseran`, `pagu_perubahan`, `created_at`, `updated_at`) VALUES
(1, '2026', '5.1.01.01.001.00001', 'Belanja Gaji Pokok PNS', 1059349000, 0, 0, '2026-09-21 18:19:22', '2026-09-21 18:19:48'),
(2, '2026', '5.1.01.01.001.00002', 'Belanja Gaji Pokok PPPK', 132967000, 0, 0, '2026-09-21 18:20:13', '2026-09-21 18:20:13'),
(3, '2026', '5.1.01.01.002.00001', 'Belanja Tunjangan Keluarga PNS', 119734000, 0, 0, '2026-09-21 18:20:37', '2026-09-21 18:20:37'),
(4, '2026', '5.1.01.01.002.00002', 'Belanja Tunjangan Keluarga PPPK', 15857000, 0, 0, '2026-09-21 18:21:01', '2026-09-21 18:21:01'),
(5, '2026', '5.1.01.01.003.00001', 'Belanja Tunjangan Jabatan PNS', 90764000, 0, 0, '2026-09-21 18:21:28', '2026-09-21 18:21:28'),
(6, '2026', '5.1.01.01.004.00001', 'Belanja Tunjangan Fungsional PNS', 34916000, 0, 0, '2026-09-21 18:21:52', '2026-09-21 18:21:52'),
(7, '2026', '5.1.01.01.004.00002', 'Belanja Tunjangan Fungsional PPPK', 17435000, 0, 0, '2026-09-21 18:22:13', '2026-09-21 18:22:13'),
(8, '2026', '5.1.01.01.005.00001', 'Belanja Tunjangan Fungsional Umum PNS', 35153000, 0, 0, '2026-09-21 18:22:40', '2026-09-21 18:22:40'),
(9, '2026', '5.1.01.01.005.00002', 'Belanja Tunjangan Fungsional Umum PPPK', 5310000, 0, 0, '2026-09-21 18:23:03', '2026-09-21 18:23:03'),
(10, '2026', '5.1.01.01.006.00001', 'Belanja Tunjangan Beras PNS', 69913000, 0, 0, '2026-09-21 18:23:24', '2026-09-21 18:23:24'),
(11, '2026', '5.1.01.01.006.00002', 'Belanja Tunjangan Beras PPPK', 9353000, 0, 0, '2026-09-21 18:23:50', '2026-09-21 18:23:50'),
(12, '2026', '5.1.01.01.007.00001', 'Belanja Tunjangan PPh/Tunjangan Khusus PNS', 16937000, 0, 0, '2026-09-21 18:24:24', '2026-09-21 18:24:24'),
(13, '2026', '5.1.01.01.008.00001', 'Belanja Pembulatan Gaji PNS', 620000, 0, 0, '2026-09-21 18:24:52', '2026-09-21 18:24:52'),
(14, '2026', '5.1.01.01.008.00002', 'Belanja Pembulatan Gaji PPPK', 7000, 0, 0, '2026-09-21 18:25:10', '2026-09-21 18:25:10'),
(15, '2026', '5.1.01.01.009.00001', 'Belanja Iuran Jaminan Kesehatan PNS', 78321000, 0, 0, '2026-09-21 18:25:27', '2026-09-21 18:25:27'),
(16, '2026', '5.1.01.01.009.00002', 'Belanja Iuran Jaminan Kesehatan PPPK', 10879000, 0, 0, '2026-09-21 18:25:50', '2026-09-21 18:25:50'),
(17, '2026', '5.1.01.01.010.00001', 'Belanja Iuran Jaminan Kecelakaan Kerja PNS', 2601000, 0, 0, '2026-09-21 18:26:08', '2026-09-21 18:26:08'),
(18, '2026', '5.1.01.01.010.00002', 'Belanja Iuran Jaminan Kecelakaan Kerja PPPK', 773000, 0, 0, '2026-09-21 18:26:25', '2026-09-21 18:26:25'),
(19, '2026', '5.1.01.01.011.00001', 'Belanja Iuran Jaminan Kematian PNS', 7287000, 0, 0, '2026-09-21 18:26:45', '2026-09-21 18:26:45'),
(20, '2026', '5.1.01.01.011.00002', 'Belanja Iuran Jaminan Kematian PPPK', 1566000, 0, 0, '2026-09-21 18:27:09', '2026-09-21 18:27:09'),
(21, '2026', '5.1.01.02.001.00001', 'Tambahan Penghasilan berdasarkan Beban Kerja PNS', 375915000, 0, 0, '2026-09-21 18:28:06', '2026-09-21 18:28:06'),
(22, '2026', '5.1.01.02.001.00002', 'Tambahan Penghasilan berdasarkan Beban Kerja PPPK', 7387000, 0, 0, '2026-09-21 18:28:26', '2026-09-21 18:28:26'),
(23, '2026', '5.1.01.02.005.00001', 'Tambahan Penghasilan berdasarkan Prestasi Kerja PNS', 566291000, 0, 0, '2026-09-21 18:28:46', '2026-09-21 18:28:46'),
(24, '2026', '5.1.01.02.005.00002', 'Tambahan Penghasilan berdasarkan Prestasi Kerja PPPK', 11081000, 0, 0, '2026-09-21 18:29:05', '2026-09-21 18:29:05');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_gaji_induk`
--

CREATE TABLE `payroll_gaji_induk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payroll_periode_id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `golongan_snapshot` varchar(10) NOT NULL,
  `mkg_snapshot` int(11) NOT NULL,
  `jumlah_tertanggung_keluarga` int(11) NOT NULL,
  `gaji_pokok` decimal(15,2) NOT NULL,
  `tunjangan_suami_istri` decimal(15,2) NOT NULL,
  `tunjangan_anak` decimal(15,2) NOT NULL,
  `tunjangan_jabatan` decimal(15,2) NOT NULL,
  `tunjangan_beras` decimal(15,2) NOT NULL,
  `tunjangan_pph` decimal(15,2) NOT NULL,
  `tunjangan_pembulatan` decimal(15,2) NOT NULL,
  `tpp_tambahan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `persen_tpp_kebijakan` decimal(5,2) NOT NULL DEFAULT 0.00,
  `penghasilan_bruto` decimal(15,2) NOT NULL,
  `potongan_iwp_8` decimal(15,2) NOT NULL,
  `potongan_bpjs_kesehatan` decimal(15,2) NOT NULL,
  `potongan_pph21` decimal(15,2) NOT NULL,
  `potongan_lainnya` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_potongan` decimal(15,2) NOT NULL,
  `penghasilan_netto` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_periode`
--

CREATE TABLE `payroll_periode` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bulan` tinyint(4) NOT NULL,
  `tahun` smallint(6) NOT NULL,
  `jenis` enum('gaji_induk','tpp','gaji_13','gaji_14_thr','rapel') NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `is_locked` tinyint(1) NOT NULL DEFAULT 0,
  `locked_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_rapel`
--

CREATE TABLE `payroll_rapel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `nomor_sk` varchar(255) NOT NULL,
  `tmt_sk` date NOT NULL,
  `bulan_bayar` tinyint(4) NOT NULL,
  `tahun_bayar` smallint(6) NOT NULL,
  `total_rapel_netto` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_rapel_detail`
--

CREATE TABLE `payroll_rapel_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payroll_rapel_id` bigint(20) UNSIGNED NOT NULL,
  `bulan` tinyint(4) NOT NULL,
  `tahun` smallint(6) NOT NULL,
  `gaji_lama` decimal(15,2) NOT NULL,
  `gaji_baru` decimal(15,2) NOT NULL,
  `selisih_bruto` decimal(15,2) NOT NULL,
  `selisih_iwp` decimal(15,2) NOT NULL,
  `selisih_netto` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_tpp`
--

CREATE TABLE `payroll_tpp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payroll_periode_id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `kelas_jabatan_snapshot` int(11) NOT NULL,
  `basic_tpp` decimal(15,2) NOT NULL,
  `persen_kehadiran` decimal(5,2) NOT NULL,
  `persen_kinerja` decimal(5,2) NOT NULL,
  `potongan_absensi_nominal` decimal(15,2) NOT NULL,
  `tpp_kotor` decimal(15,2) NOT NULL,
  `tarif_pajak_persen` decimal(5,2) NOT NULL,
  `potongan_pph21` decimal(15,2) NOT NULL,
  `tpp_netto` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(50) NOT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `gelar_depan` varchar(20) DEFAULT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `gelar_belakang` varchar(20) DEFAULT NULL,
  `nik` varchar(16) NOT NULL,
  `npwp` varchar(20) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `status_kepegawaian` enum('pns','cpns','pppk','pppk_paruh_waktu') NOT NULL,
  `status_pernikahan` varchar(255) NOT NULL,
  `golongan` varchar(10) NOT NULL,
  `mkg_tahun` int(11) NOT NULL,
  `mkg_bulan` int(11) NOT NULL,
  `ref_jabatan_id` bigint(20) UNSIGNED NOT NULL,
  `is_penyetaraan` tinyint(1) NOT NULL DEFAULT 0,
  `tmt_cpns` date DEFAULT NULL,
  `tmt_pns` date DEFAULT NULL,
  `tmt_pangkat_terakhir` date NOT NULL,
  `tmt_kgb_terakhir` date NOT NULL,
  `nomor_rekening` varchar(50) NOT NULL,
  `nama_pada_rekening` varchar(255) NOT NULL,
  `ptkp_status` varchar(10) NOT NULL,
  `alamat` text DEFAULT NULL,
  `gaji_kontrak` decimal(15,2) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nama_bank` varchar(100) NOT NULL DEFAULT 'Bank Jateng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `nip`, `tempat_lahir`, `tanggal_lahir`, `gelar_depan`, `nama_lengkap`, `gelar_belakang`, `nik`, `npwp`, `jenis_kelamin`, `agama`, `status_kepegawaian`, `status_pernikahan`, `golongan`, `mkg_tahun`, `mkg_bulan`, `ref_jabatan_id`, `is_penyetaraan`, `tmt_cpns`, `tmt_pns`, `tmt_pangkat_terakhir`, `tmt_kgb_terakhir`, `nomor_rekening`, `nama_pada_rekening`, `ptkp_status`, `alamat`, `gaji_kontrak`, `is_active`, `created_at`, `updated_at`, `nama_bank`) VALUES
(2, '197202051992031010', 'Pekalongan', '1972-02-05', NULL, 'Amat Muslich', 'S.A.P', '3375010502720005', '3375010502720005', 'L', 'Islam', 'pns', 'K/1', 'IV/a', 28, 0, 7, 1, '1992-03-01', NULL, '2024-04-01', '2025-03-01', '3.007.08692.9', 'Amat Muslich', 'K/1', 'JI. Lestari Kaplingan Pringlangu Indah RT.5 RW.2, Pringrejo, Pekalongan', NULL, 0, '2026-09-20 19:15:32', '2026-09-21 21:16:53', 'Bank Jateng'),
(3, '197311171999031006', 'Pontianak', '1973-11-17', NULL, 'Harry Rudiyanto', 'S.Kom, M.M', '3375011711730010', '3375011711730010', 'L', 'Islam', 'pns', 'K/2', 'IV/c', 25, 1, 25, 0, '1999-03-01', NULL, '2026-04-01', '2025-03-01', '3.007.19462.4', 'Harry Rudiyanto', 'K/2', 'Binagriya B.V/217 PEKALONGAN BARAT', NULL, 1, '2026-09-20 19:15:32', '2026-09-21 22:04:29', 'Bank Jateng'),
(4, '197406072007011008', 'Pekalongan', '1974-06-07', NULL, 'Purnomo', 'S.H.', '3326160706740001', '3326160706740001', 'L', 'Islam', 'pns', 'K/1', 'III/c', 26, 6, 8, 0, '2007-01-01', NULL, '2025-10-01', '2025-10-01', '3.007.05968.9', 'Purnomo', 'K/1', 'Kel Bener Perum Wirabaru III / 13 Wiradesa', NULL, 1, '2026-09-20 19:15:32', '2026-09-20 21:07:06', 'Bank Jateng'),
(5, '197407041997031004', 'Pekalongan', '1974-07-04', NULL, 'Abdullah Yulianto', NULL, '3375030407740005', '3375030407740005', 'L', 'Islam', 'pns', 'K/2', 'III/b', 22, 0, 17, 0, '1997-03-01', NULL, '2017-04-01', '2024-03-01', '3.007.04961.6', 'Abdullah Yulianto', 'K/3', 'KRAPYAK KIDUL GG.2 NO.13 RT.03 / 04 PEKALONGAN UTARA', NULL, 0, '2026-09-20 19:15:32', '2026-09-21 21:38:30', 'Bank Jateng'),
(6, '197408122014062001', 'Pekalongan', '1974-08-12', NULL, 'Vitta Adi Rosewaty Jengkar', NULL, '3375035208740005', '3375035208740005', 'P', 'Islam', 'pns', 'K/0', 'II/c', 27, 0, 17, 0, '2014-06-01', NULL, '2022-10-01', '2025-06-01', '300.718.396.7', 'Vitta Adi Rosewaty Jengkar', 'TK/0', 'Jl. Jawa Gg. 15 No. 6 Bendan Kergon Pekalongan Barat', NULL, 1, '2026-09-20 19:15:32', '2026-09-20 22:56:52', 'Bank Jateng'),
(7, '198102232006042012', NULL, '1981-02-23', NULL, 'Riski Tessa Malela', 'S.E., MA', '3325116302810004', '3325116302810004', 'P', 'Islam', 'pns', 'K/2', 'IV/b', 22, 0, 15, 0, '2006-04-01', NULL, '2023-10-01', '2025-12-01', '3.007.08196.0', 'Riski Tessa Malela', 'TK/0', 'Perum Prima Asri 1 No 27 Sambong Batang', NULL, 1, '2026-09-20 19:15:32', '2026-09-20 22:53:30', 'Bank Jateng'),
(8, '198102232009021003', 'ADIWERNA', '1981-02-23', NULL, 'Muhammad Muzni Kharis', 'A.Md', '3328112302810004', '3328112302810004', 'L', 'Islam', 'pns', 'K/1', 'III/c', 14, 0, 3, 0, '2009-02-01', NULL, '2024-10-01', '2025-02-01', '3.007.17826.2', 'Muhammad Muzni Kharis', 'K/1', 'DK. MLATEN I, DESA KARANGSARI, KARANGANYAR', NULL, 1, '2026-09-20 19:15:32', '2026-09-20 21:06:36', 'Bank Jateng'),
(9, '198409272003121001', 'Pekalongan', '1984-09-27', NULL, 'Sukirno', 'S.STP, M.M', '3375012709840006', '3375012709840006', 'L', 'Islam', 'pns', 'K/2', 'IV/b', 18, 0, 25, 0, '2003-12-01', NULL, '2023-10-01', '2025-10-01', '3.007.18506.4', 'Sukirno', 'K/3', 'PERUM PURI SIDOMUKTI BLOK G NO. 24 PRINGREJO PEKALONGAN BARAT', NULL, 0, '2026-09-20 19:15:32', '2026-09-21 22:03:31', 'Bank Jateng'),
(10, '198612162020122008', 'Bandung', '1986-12-16', NULL, 'Ratih Prasastianila Muna', 'A.Md', '3325115612860002', '3325115612860002', 'P', 'Islam', 'pns', 'K/2', 'II/d', 7, 0, 16, 0, '2020-12-01', NULL, '2024-12-01', '2024-12-01', '3.007.27013.4', 'Ratih Prasastianila Muna', 'TK/0', 'Jl. A. Yani Gg. Melati No 14 Kauman Batang', NULL, 1, '2026-09-20 19:15:32', '2026-09-20 22:55:15', 'Bank Jateng'),
(11, '198901092022031007', 'Pekalongan', '1998-01-09', NULL, 'Yanuar Albab Baihaqi', 'S.E.Sy', '3326130901890001', '3326130901890001', 'L', 'Islam', 'pns', 'K/0', 'III/b', 4, 0, 15, 0, '2022-03-01', NULL, '2026-03-01', '2026-03-01', '3.007.29219.7', 'Yanuar Albab Baihaqi', 'K/0', 'DK PESANTREN RT 004 RW 001 PAKIS PUTIH KECAMATAN KEDUNGWUNI', NULL, 1, '2026-09-20 19:15:32', '2026-09-21 21:43:05', 'Bank Jateng'),
(12, '198910192020122011', 'Batang', '1989-10-19', NULL, 'Istikomah', 'S.E.', '3325025910890002', '3325025910890002', 'P', NULL, 'pns', 'K/1', 'III/b', 4, 0, 15, 0, '2020-12-01', NULL, '2024-12-01', '2024-12-01', '3.007.27012.6', 'Istikomah', 'TK/0', 'Jl. Wan Agung Perum. Cahaya Pegaden Asri Blok A No.3 Wonopringgo Pekalongan', NULL, 1, '2026-09-20 19:15:32', '2026-09-20 21:13:23', 'Bank Jateng'),
(13, '199102052022031003', 'Pekalongan', '1991-02-05', NULL, 'Ahmad Rozi', 'S.E.', '3326140502910001', '3326140502910001', 'L', 'Islam', 'pns', 'K/1', 'III/a', 4, 0, 6, 0, '2022-03-01', NULL, '2022-03-01', '2026-03-01', '3.007.28950.1', 'Ahmad Rozi', 'K/1', 'DUKUH KARANGANYAR LOR KARANGDADAP', NULL, 1, '2026-09-20 19:15:32', '2026-09-21 21:37:59', 'Bank Jateng'),
(14, '199210012020122013', 'Pekalongan', '1992-10-01', NULL, 'Millatina Hanifah', 'S.E.Sy.', '3375024110920001', '3375024110920001', 'P', 'Islam', 'pns', 'K/2', 'III/b', 4, 2, 6, 0, '2020-12-01', NULL, '2025-02-01', '2025-02-01', '3.007.27118.1', 'Millatina Hanifah', 'TK/0', 'Setono Gg.8 RT.003/007 Kel. Setono Pekalongan', NULL, 1, '2026-09-20 19:15:32', '2026-09-20 21:09:41', 'Bank Jateng'),
(15, '199401252022032008', 'Bandung', '1994-01-25', NULL, 'Wulan Suryani', 'A.Md.Kom', '3204286501940002', '3204286501940002', 'P', 'Islam', 'pns', 'K/1', 'II/d', 7, 0, 16, 0, '2022-03-01', NULL, '2026-03-01', '2026-03-01', '3.007.28949.8', 'Wulan Suryani', 'TK/0', 'KP. BOJONG KONENG, RANCAEKEK, BANDUNG', NULL, 1, '2026-09-20 19:15:32', '2026-09-21 21:44:06', 'Bank Jateng'),
(16, '199608132022032018', 'Pekalongan', '1996-08-13', NULL, 'Noor Falaisifa', 'A.Md', '3326135308960001', '3326135308960001', 'P', 'Islam', 'pns', 'TK', 'II/d', 7, 0, 16, 0, '2022-03-01', NULL, '2026-03-01', '2026-03-01', '3.007.21476.5', 'Noor Falaisifa', 'TK/0', 'DK PENCIRAN, DS PODO, KEDUNGWUNI', NULL, 1, '2026-09-20 19:15:32', '2026-09-21 21:46:47', 'Bank Jateng'),
(17, '199609172022032021', 'Purbalingga', '1996-09-17', NULL, 'Nur Hanifah', 'A.Md', '3303115709960003', '3303115709960003', 'P', NULL, 'pns', 'K/1', 'II/d', 7, 0, 16, 0, '2022-03-01', NULL, '2026-03-01', '2026-03-01', '3.007.28947.1', 'Nur Hanifah', 'TK/0', 'Bumisari RT 013 RW 006, Bojongsari, Purbalingga', NULL, 1, '2026-09-20 19:15:32', '2026-09-21 21:46:58', 'Bank Jateng'),
(18, '199610212025042002', 'Pekalongan', '1996-10-21', NULL, 'Aqilatul Ulya', 'S.E', '3375026110960003', '3375026110960003', 'P', 'Islam', 'pns', 'TK', 'III/a', 1, 0, 9, 0, '2025-04-01', '2026-04-01', '2025-04-01', '2025-04-01', '3.007.32945.7', 'Aqilatul Ulya', 'TK/0', 'Jl. R.A. Kartini, Keputran Gang 7 No. 21, Kauman, Pekalongan Timur', NULL, 1, '2026-09-20 19:15:32', '2026-09-21 21:49:44', 'Bank Jateng'),
(19, '199611152020122016', 'Pemalang', '1996-11-15', NULL, 'Nadya Ayu Popi Haluansa', 'S.E', '3327115511960001', '3327115511960001', 'P', 'Islam', 'pns', 'K/2', 'III/b', 4, 2, 6, 0, '2020-12-01', NULL, '2025-02-01', '2025-02-01', '3.007.25566.6', 'Nadya Ayu Popi Haluansa', 'TK/0', 'Desa Blimbing, Ampelgading, Pemalang', NULL, 1, '2026-09-20 19:15:32', '2026-09-20 21:11:13', 'Bank Jateng'),
(20, '199801092022031007', 'Pekalongan', '1998-01-09', NULL, 'Didik Yogo Suro Prasojo', 'S.Kom', '3326070901980001', '3326070901980001', 'L', 'Islam', 'pns', 'K/0', 'III/b', 4, 2, 11, 0, '2022-03-01', NULL, '2026-05-01', '2026-03-01', '3.007.28951.0', 'Didik Yogo Suro Prasojo', 'K/0', 'Desa Legokkalong, Kec Karanganyar Kab Pekalongan', NULL, 1, '2026-09-20 19:15:32', '2026-09-21 22:05:10', 'Bank Jateng'),
(21, '199305262025211041', 'Blora', '1993-05-26', NULL, 'Achmad Adi Kusuma', 'S.Kom', '3327052605930002', '3327052605930002', 'L', 'Islam', 'pppk', 'K/1', 'IX', 0, 0, 6, 0, NULL, NULL, '2025-07-01', '2025-07-01', '3.007.33016.1', 'Achmad Adi Kusuma', 'K/1', 'JL. KURINCI GG. RAJAWALI I NO. 27 RT 007 RW 001 KEL. PODOSUGIH PEKALONGAN BARAT KOTA PEKALONGAN', NULL, 1, '2026-09-20 20:09:41', '2026-09-20 21:07:44', 'Bank Jateng'),
(22, '199605222025211019', 'Pekalongan', '1996-05-22', NULL, 'Muhammad Ilham Insani', 'S.Kom', '3326132205960005', '3326132205960005', 'L', 'Islam', 'pppk', 'K/0', 'IX', 0, 0, 6, 0, NULL, NULL, '2025-07-01', '2025-07-01', '3.007.33027.7', 'Muhammad Ilham Insani', 'K/0', 'Pekajangan, RT. 19/RW. 07, Pekajangan, Kabupaten Pekalongan', NULL, 1, '2026-09-20 20:09:41', '2026-09-20 21:10:05', 'Bank Jateng'),
(23, '199610092024211003', 'Kab. Pemalang', '1996-10-09', NULL, 'Fajariawan Prabowo', 'A.Md.Kom', '3327080910960002', '3327080910960002', 'L', 'Islam', 'pppk', 'K/2', 'VII', 5, 0, 14, 0, NULL, NULL, '2024-03-01', '2026-03-01', '3.007.01834.4', 'Fajariawan Prabowo', 'K/2', 'Dusun Gayang, Kel. Serang, Petarukan, Pemalang', NULL, 1, '2026-09-20 20:09:41', '2026-09-21 23:07:44', 'Bank Jateng'),
(24, '197006161989031001', 'Pemalang', '1970-06-16', NULL, 'Ade Suangkat', 'S.E', '3326131606700005', '3326131606700005', 'L', 'Islam', 'pns', 'K/1', 'IV/b', 28, 0, 1, 0, '1989-03-01', NULL, '2024-04-01', '2025-03-01', '3.007.08672.4', 'Ade Suangkat', 'K/1', 'PERUM PURI UTARA III A NO 87 KEDUNGWUNI', NULL, 1, '2026-09-21 21:20:55', '2026-09-21 21:33:33', 'Bank Jateng'),
(26, '197202162025211017', '-', NULL, NULL, 'Abdul Kholis', 'A.Md', '3375011602720003', '3375011602720003', 'L', 'Islam', 'pppk_paruh_waktu', 'K/2', '-', 0, 0, 32, 0, NULL, NULL, '1970-01-01', '1970-01-01', '01.103.06072', 'Abdul Kholis', 'K/2', '-', 2691000.00, 1, '2026-09-22 00:05:55', '2026-09-22 00:05:55', 'Bank Pekalongan'),
(27, '199408272025211064', '-', NULL, NULL, 'Agus Priyanto', 'S.Kom', '3375032708940003', '3375032708940003', 'L', 'Islam', 'pppk_paruh_waktu', 'K/2', '-', 0, 0, 31, 0, NULL, NULL, '1970-01-01', '1970-01-01', '01.103.06052', 'Agus Priyanto', 'K/2', '-', 2400000.00, 1, '2026-09-22 00:05:55', '2026-09-22 00:05:55', 'Bank Pekalongan'),
(28, '198108042025211043', '-', NULL, NULL, 'Dwi Imam Fitriono', NULL, '3375020408810003', '3375020408810003', 'L', 'Islam', 'pppk_paruh_waktu', 'K/1', '-', 0, 0, 33, 0, NULL, NULL, '1970-01-01', '1970-01-01', '01.103.06053', 'Dwi Imam Fitriono', 'K/1', '-', 2050000.00, 1, '2026-09-22 00:05:55', '2026-09-22 00:05:55', 'Bank Pekalongan'),
(29, '199704252025212053', '-', NULL, NULL, 'Dwita Gladea', 'S.Pd', '3375046504970006', '3375046504970006', 'P', 'Islam', 'pppk_paruh_waktu', 'TK/0', '-', 0, 0, 31, 0, NULL, NULL, '1970-01-01', '1970-01-01', '01.103.06076', 'Dwita Gladea', 'TK/0', '-', 2300000.00, 1, '2026-09-22 00:05:55', '2026-09-22 00:05:55', 'Bank Pekalongan'),
(30, '199009282025212070', '-', NULL, NULL, 'Ermi Susanti', 'S.Pd.', '3326186809900001', '3326186809900001', 'P', 'Islam', 'pppk_paruh_waktu', 'TK/0', '-', 0, 0, 31, 0, NULL, NULL, '1970-01-01', '1970-01-01', '01.103.06074', 'Ermi Susanti', 'TK/0', '-', 2500000.00, 1, '2026-09-22 00:05:55', '2026-09-22 00:05:55', 'Bank Pekalongan'),
(31, '198511242025212055', '-', NULL, NULL, 'Iis Sugiarti', 'A.Md.', '3375016411850001', '3375016411850001', 'P', 'Islam', 'pppk_paruh_waktu', 'TK/0', '-', 0, 0, 32, 0, NULL, NULL, '1970-01-01', '1970-01-01', '01.103.06099', 'Iis Sugiarti', 'TK/0', '-', 2300000.00, 1, '2026-09-22 00:05:55', '2026-09-22 00:05:55', 'Bank Pekalongan'),
(32, '199407152025211056', '-', NULL, NULL, 'Julio Odi Ardika', 'A.Md', '3375021507940003', '3375021507940003', 'L', 'Islam', 'pppk_paruh_waktu', 'TK/0', '-', 0, 0, 32, 0, NULL, NULL, '1970-01-01', '1970-01-01', '01.103.06033', 'Julio Odi Ardika', 'TK/0', '-', 3600000.00, 1, '2026-09-22 00:05:55', '2026-09-22 00:05:55', 'Bank Pekalongan'),
(33, '199811062025211036', '-', NULL, NULL, 'Moch. Dany Rozid Wafa', NULL, '3375010611980003', '3375010611980003', 'L', 'Islam', 'pppk_paruh_waktu', 'TK/0', '-', 0, 0, 33, 0, NULL, NULL, '1970-01-01', '1970-01-01', '01.103.06067', 'Moch. Dany Rozid Wafa', 'TK/0', '-', 2400000.00, 1, '2026-09-22 00:05:55', '2026-09-22 00:05:55', 'Bank Pekalongan'),
(34, '198903222025211056', '-', NULL, NULL, 'Moh. Marlan Saibani', NULL, '3375012203890009', '3375012203890009', 'L', 'Islam', 'pppk_paruh_waktu', 'TK/0', '-', 0, 0, 33, 0, NULL, NULL, '1970-01-01', '1970-01-01', '01.103.06061', 'Moh. Marlan Saibani', 'TK/0', '-', 2000000.00, 1, '2026-09-22 00:05:55', '2026-09-22 00:05:55', 'Bank Pekalongan'),
(35, '197801082025211038', '-', NULL, NULL, 'Muhammad Bahir', NULL, '3375010801780010', '3375010801780010', 'L', 'Islam', 'pppk_paruh_waktu', 'K/0', '-', 0, 0, 34, 0, NULL, NULL, '1970-01-01', '1970-01-01', '01.103.06068', 'Muhammad Bahir', 'K/0', '-', 2000000.00, 1, '2026-09-22 00:05:55', '2026-09-22 00:05:55', 'Bank Pekalongan'),
(36, '199602142025211073', '-', NULL, NULL, 'Muhammad Faqih Iqbal', 'S.Kom', '3375031402960006', '3375031402960006', 'L', 'Islam', 'pppk_paruh_waktu', 'K/1', '-', 0, 0, 31, 0, NULL, NULL, '1970-01-01', '1970-01-01', '01.103.05793', 'Muhammad Faqih Iqbal', 'K/1', '-', 2400000.00, 1, '2026-09-22 00:05:55', '2026-09-22 00:05:55', 'Bank Pekalongan'),
(37, '199207172025211070', '-', NULL, NULL, 'Muhammad Rifqil Anam', 'S.Kom', '3325121707920002', '3325121707920002', 'L', 'Islam', 'pppk_paruh_waktu', 'K/2', '-', 0, 0, 31, 0, NULL, NULL, '1970-01-01', '1970-01-01', '01.103.06050', 'Muhammad Rifqil Anam', 'K/2', '-', 3700000.00, 1, '2026-09-22 00:05:55', '2026-09-22 00:05:55', 'Bank Pekalongan'),
(38, '198705202025212059', '-', NULL, NULL, 'Nur Handayani', NULL, '3375026005870004', '3375026005870004', 'P', 'Islam', 'pppk_paruh_waktu', 'TK/0', '-', 0, 0, 33, 0, NULL, NULL, '1970-01-01', '1970-01-01', '01.103.06073', 'Nur Handayani', 'TK/0', '-', 2300000.00, 1, '2026-09-22 00:05:55', '2026-09-22 00:05:55', 'Bank Pekalongan'),
(39, '198708182025212094', '-', NULL, NULL, 'Sulistiyowati', NULL, '3375015808870004', '3375015808870004', 'P', 'Islam', 'pppk_paruh_waktu', 'TK/0', '-', 0, 0, 33, 0, NULL, NULL, '1970-01-01', '1970-01-01', '01.103.06071', 'Sulistiyowati', 'TK/0', '-', 2000000.00, 1, '2026-09-22 00:05:55', '2026-09-22 00:05:55', 'Bank Pekalongan'),
(40, '198504162025211050', '-', NULL, NULL, 'Wahyu Indra Kusuma', NULL, '3375011604850008', '3375011604850008', 'L', 'Islam', 'pppk_paruh_waktu', 'K/3', '-', 0, 0, 33, 0, NULL, NULL, '1970-01-01', '1970-01-01', '01.103.06064', 'Wahyu Indra Kusuma', 'K/3', '-', 2000000.00, 1, '2026-09-22 00:05:55', '2026-09-22 00:05:55', 'Bank Pekalongan'),
(41, '197808152025211058', '-', NULL, NULL, 'Whinnaryo', NULL, '3325111508780007', '3325111508780007', 'L', 'Islam', 'pppk_paruh_waktu', 'K/2', '-', 0, 0, 33, 0, NULL, NULL, '1970-01-01', '1970-01-01', '01.103.06062', 'Whinnaryo', 'K/2', '-', 2000000.00, 1, '2026-09-22 00:05:55', '2026-09-22 00:05:55', 'Bank Pekalongan'),
(42, '199501262025212064', '-', NULL, NULL, 'Yania Noviantika Ls', 'S.E', '3375036601950001', '3375036601950001', 'P', 'Islam', 'pppk_paruh_waktu', 'TK/0', '-', 0, 0, 31, 0, NULL, NULL, '1970-01-01', '1970-01-01', '01.103.06043', 'Yania Noviantika Ls', 'TK/0', '-', 2400000.00, 1, '2026-09-22 00:05:55', '2026-09-22 00:05:55', 'Bank Pekalongan'),
(43, '199506132025212082', '-', NULL, NULL, 'Yuniar Hana Pratiwi', 'S.Kom', '3326115306950001', '3326115306950001', 'P', 'Islam', 'pppk_paruh_waktu', 'TK/0', '-', 0, 0, 31, 0, NULL, NULL, '1970-01-01', '1970-01-01', '01.103.06089', 'Yuniar Hana Pratiwi', 'TK/0', '-', 2300000.00, 1, '2026-09-22 00:05:55', '2026-09-22 00:05:55', 'Bank Pekalongan');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai_anak`
--

CREATE TABLE `pegawai_anak` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `nama_anak` varchar(255) NOT NULL,
  `status_anak` enum('kandung','tiri','angkat') NOT NULL,
  `anak_ke` int(11) NOT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `status_pernikahan` tinyint(1) NOT NULL DEFAULT 0,
  `status_bekerja` tinyint(1) NOT NULL DEFAULT 0,
  `masih_kuliah` tinyint(1) NOT NULL DEFAULT 0,
  `nama_kampus_sekolah` varchar(255) DEFAULT NULL,
  `tgl_surat_kuliah_expired` date DEFAULT NULL,
  `dapat_tunjangan` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawai_anak`
--

INSERT INTO `pegawai_anak` (`id`, `pegawai_id`, `nama_anak`, `status_anak`, `anak_ke`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `status_pernikahan`, `status_bekerja`, `masih_kuliah`, `nama_kampus_sekolah`, `tgl_surat_kuliah_expired`, `dapat_tunjangan`, `created_at`, `updated_at`) VALUES
(1, 5, 'Dzaky Nabil Abdullah', 'kandung', 1, 'Pekalongan', '2007-05-28', 'L', 0, 0, 0, NULL, NULL, 1, '2026-09-20 19:23:10', '2026-09-20 19:23:10'),
(2, 5, 'Salwa Nabila Putri', 'kandung', 2, 'Pekalongan', '2011-03-18', 'P', 0, 0, 0, NULL, NULL, 1, '2026-09-20 19:23:33', '2026-09-20 19:23:33'),
(3, 5, 'Nayla Syakira Putri', 'kandung', 3, 'Pekalongan', '2016-07-25', 'P', 0, 0, 0, NULL, NULL, 0, '2026-09-20 19:24:01', '2026-09-20 19:24:01'),
(4, 13, 'Syahna Almayra Maheswari', 'kandung', 1, 'Pekalongan', '2021-11-19', 'P', 0, 0, 0, NULL, NULL, 1, '2026-09-20 19:25:30', '2026-09-20 19:25:30'),
(5, 2, 'M.Farhan Haqiqi', 'kandung', 2, 'Pekalongan', '2004-12-29', 'L', 0, 0, 1, 'Universitas', '2026-12-31', 1, '2026-09-20 19:26:44', '2026-09-20 19:26:44'),
(6, 3, 'Muhammad Raihan Harsaputra', 'kandung', 1, 'Pekalongan', '2004-12-12', 'L', 0, 0, 1, 'Universitas', '2026-12-31', 1, '2026-09-20 19:28:31', '2026-09-20 19:28:31'),
(7, 3, 'Fakhri Muhammad Harsaputra', 'kandung', 2, 'Pekalongan', '2008-12-12', 'L', 0, 0, 0, NULL, NULL, 1, '2026-09-20 19:28:51', '2026-09-20 19:28:51'),
(8, 12, 'Kenizia Ayumi Zahara', 'kandung', 1, 'Batang', '2016-06-11', 'P', 0, 0, 0, NULL, NULL, 0, '2026-09-20 19:29:54', '2026-09-20 19:29:54'),
(9, 14, 'Muhammad Bilal Rajif Amr', 'kandung', 1, 'Pekalongan', '2021-06-08', 'L', 0, 0, 0, NULL, NULL, 1, '2026-09-20 19:30:51', '2026-09-20 19:30:51'),
(10, 14, 'Muhammad Hanan Rasyid Amr', 'kandung', 2, 'Pekalongan', '2022-12-13', 'L', 0, 0, 0, NULL, NULL, 1, '2026-09-20 19:31:15', '2026-09-20 19:31:15'),
(11, 8, 'Zaheera Nursen', 'kandung', 1, 'Pekalongan', '2024-03-16', 'P', 0, 0, 0, NULL, NULL, 1, '2026-09-20 19:31:56', '2026-09-20 19:31:56'),
(12, 19, 'Aqmanina Meida Izzati', 'kandung', 1, 'Pemalang', '2022-10-30', 'P', 0, 0, 0, NULL, NULL, 1, '2026-09-20 19:33:00', '2026-09-20 19:33:00'),
(13, 19, 'Nadira Adzra Finesty', 'kandung', 2, 'Pemalang', '2024-10-02', 'P', 0, 0, 0, NULL, NULL, 1, '2026-09-20 19:33:19', '2026-09-20 19:33:26'),
(14, 17, 'Nun Shovia Alashma', 'kandung', 1, 'Purbalingga', '2023-11-01', 'P', 0, 0, 0, NULL, NULL, 1, '2026-09-20 19:34:31', '2026-09-20 19:34:31'),
(15, 4, 'Muhammad Wisnu Pratama', 'kandung', 1, 'Pekalongan', '2022-01-04', 'L', 0, 0, 1, 'Universitas', '2026-12-31', 1, '2026-09-20 19:35:26', '2026-09-20 19:35:26'),
(16, 10, 'Elmira Zhafira Khairully', 'kandung', 1, 'Batang', '2012-10-06', 'P', 0, 0, 0, NULL, NULL, 1, '2026-09-20 19:36:43', '2026-09-20 19:36:43'),
(17, 10, 'Elham Alfarizqi Khairully', 'kandung', 2, 'Batang', '2016-04-24', 'L', 0, 0, 0, NULL, NULL, 1, '2026-09-20 19:36:59', '2026-09-20 19:36:59'),
(18, 10, 'Elzar Alfarizi Khairully', 'kandung', 3, 'Batang', '2019-05-02', 'L', 0, 0, 0, NULL, NULL, 0, '2026-09-20 19:37:21', '2026-09-20 19:37:21'),
(19, 10, 'Elzara Amira Khairully', 'kandung', 4, 'Batang', '2022-04-23', 'P', 0, 0, 0, NULL, NULL, 0, '2026-09-20 19:37:42', '2026-09-20 19:37:42'),
(20, 7, 'Gaza Eira Prasetyo', 'kandung', 1, 'Batang', '2009-05-15', 'P', 0, 0, 0, NULL, NULL, 1, '2026-09-20 19:38:34', '2026-09-20 19:38:34'),
(21, 7, 'Aisha Azzahra Prasetyo', 'kandung', 2, 'Batang', '2012-04-18', 'P', 0, 0, 0, NULL, NULL, 1, '2026-09-20 19:38:56', '2026-09-20 19:38:56'),
(22, 9, 'Kirana Haifa Saraswati', 'kandung', 1, 'Surakarta', '2011-02-18', 'P', 0, 0, 0, NULL, NULL, 1, '2026-09-20 19:41:48', '2026-09-20 19:41:48'),
(23, 9, 'Areta Vega Larasati', 'kandung', 2, 'Pekalongan', '2013-01-28', 'P', 0, 0, 0, NULL, NULL, 1, '2026-09-20 19:42:25', '2026-09-20 19:42:25'),
(25, 9, 'Dhanurendra Barru Airlangga', 'kandung', 3, 'Pekalongan', '2019-06-07', 'L', 0, 0, 0, NULL, NULL, 0, '2026-09-20 19:42:58', '2026-09-20 19:42:58'),
(26, 6, 'Iqbal Adi Permana', 'kandung', 2, 'Pekalongan', '1996-04-03', 'L', 0, 0, 0, NULL, NULL, 0, '2026-09-20 19:44:40', '2026-09-20 19:45:14'),
(27, 6, 'Ayu Adi Purnama Dewi', 'kandung', 1, 'Pekalongan', '1993-06-04', 'P', 0, 0, 0, NULL, NULL, 0, '2026-09-20 19:45:07', '2026-09-20 19:45:07'),
(28, 15, 'Adila Azzahra', 'kandung', 1, 'Bandung', '2021-01-05', 'P', 0, 0, 0, NULL, NULL, 1, '2026-09-20 19:45:58', '2026-09-20 19:45:58'),
(29, 21, 'Nashwa Azzahra Achmad', 'kandung', 1, 'Pekalongan', '2020-07-29', 'P', 0, 0, 0, NULL, NULL, 1, '2026-09-20 20:09:41', '2026-09-20 20:15:26'),
(30, 23, 'Tsabina Neima Laksita', 'kandung', 1, 'Pemalang', '2023-09-10', 'L', 0, 0, 0, NULL, NULL, 1, '2026-09-20 20:09:41', '2026-09-20 20:10:43'),
(31, 23, 'Tsabitha Neima Lidwina', 'kandung', 2, 'Pemalang', '2023-09-10', 'L', 0, 0, 0, NULL, NULL, 1, '2026-09-20 20:09:41', '2026-09-20 20:10:50'),
(32, 24, 'MUHAMMAD ZAIDAN ILMAN', 'kandung', 3, 'PEKALONGAN', '2009-05-09', 'L', 0, 0, 0, NULL, NULL, 1, '2026-09-21 21:22:12', '2026-09-21 21:22:12'),
(33, 13, 'Aryan Malik Ahmad', 'kandung', 2, 'Pekalongan', '2026-03-06', 'L', 0, 0, 0, NULL, NULL, 1, '2026-09-21 21:50:22', '2026-09-21 21:50:22');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai_pasangan`
--

CREATE TABLE `pegawai_pasangan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `nama_pasangan` varchar(255) NOT NULL,
  `nik_pasangan` varchar(16) NOT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date NOT NULL,
  `tanggal_menikah` date NOT NULL,
  `nomor_buku_nikah` varchar(255) DEFAULT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `nip_pasangan` varchar(50) DEFAULT NULL,
  `dapat_tunjangan` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawai_pasangan`
--

INSERT INTO `pegawai_pasangan` (`id`, `pegawai_id`, `nama_pasangan`, `nik_pasangan`, `tempat_lahir`, `tanggal_lahir`, `tanggal_menikah`, `nomor_buku_nikah`, `pekerjaan`, `nip_pasangan`, `dapat_tunjangan`, `created_at`, `updated_at`) VALUES
(2, 2, 'Wiwin Rusdianti', '-', NULL, '1971-05-01', '1996-09-06', NULL, 'PNS', NULL, 1, '2026-09-20 19:15:32', '2026-09-20 19:15:32'),
(3, 3, 'Sari Yuliastuti', '-', 'Pekalongan', '1977-02-27', '2003-10-11', NULL, 'PNS', NULL, 1, '2026-09-20 19:15:32', '2026-09-20 19:27:47'),
(4, 4, 'Ida Ukiyanah', '-', 'Pekalongan', '1979-03-04', '2000-09-04', NULL, 'Ibu Rumah Tangga', NULL, 1, '2026-09-20 19:15:32', '2026-09-20 19:34:52'),
(5, 5, 'Ririn Indah Sari', '-', 'Jakarta', '1978-09-28', '2025-11-12', NULL, 'PNS', NULL, 1, '2026-09-20 19:15:32', '2026-09-20 19:20:15'),
(6, 6, 'Slamet Maafi', '-', 'Pekalongan', '1996-06-10', '1993-04-14', NULL, 'Swasta', NULL, 1, '2026-09-20 19:15:32', '2026-09-20 19:44:12'),
(7, 7, 'Andry Imam Prasetyo', '-', 'Batang', '1979-05-06', '2007-11-14', NULL, 'POLRI', NULL, 1, '2026-09-20 19:15:32', '2026-09-20 19:38:06'),
(8, 8, 'Retno Sulistyorini, A.Md.', '-', 'Pekalongan', '1989-02-12', '2015-10-04', NULL, 'Swasta', NULL, 1, '2026-09-20 19:15:32', '2026-09-20 19:31:25'),
(9, 9, 'Rini Purwaningsih', '-', 'Wonogiri', '1984-04-22', '2009-12-10', NULL, 'Swasta', NULL, 1, '2026-09-20 19:15:32', '2026-09-20 19:39:39'),
(10, 10, 'Mirham Khairully', '-', 'Batang', '1986-01-21', '2011-07-23', NULL, 'Wiraswasta', NULL, 1, '2026-09-20 19:15:32', '2026-09-20 19:36:10'),
(11, 11, 'Siska Probo Wati', '-', 'Pekalongan', '1989-07-04', '2020-06-17', NULL, 'PNS', NULL, 0, '2026-09-20 19:15:32', '2026-09-20 19:46:18'),
(12, 12, 'M. Rizqon Faza', '-', 'Pekalongan', '1988-05-17', '2015-04-25', NULL, 'PNS', NULL, 0, '2026-09-20 19:15:32', '2026-09-20 19:29:22'),
(13, 13, 'Ida Fitriyani', '-', 'Pekalongan', '1995-02-23', '2020-12-11', NULL, 'Ibu Rumah Tangga', NULL, 1, '2026-09-20 19:15:32', '2026-09-20 19:25:00'),
(14, 14, 'Mu\'Ammar', '-', 'Pekalongan', '1990-07-15', '2020-08-14', NULL, 'Wiraswasta', NULL, 1, '2026-09-20 19:15:32', '2026-09-20 19:30:19'),
(15, 15, 'Andi Widianto', '-', 'Bandung', '1989-11-27', '2020-02-20', NULL, 'Swasta', NULL, 1, '2026-09-20 19:15:32', '2026-09-20 19:45:36'),
(16, 16, '-', '-', NULL, '2026-09-21', '2026-09-21', NULL, '-', NULL, 0, '2026-09-20 19:15:32', '2026-09-20 19:15:32'),
(17, 17, 'Istio Setiawan', '-', 'Purbalingga', '1992-09-19', '2023-01-29', NULL, 'Wiraswasta', NULL, 1, '2026-09-20 19:15:32', '2026-09-20 19:34:03'),
(18, 19, 'Rendi Yuliawan', '-', 'Pemalang', '1995-07-24', '2021-05-24', NULL, 'Swasta', NULL, 1, '2026-09-20 19:15:32', '2026-09-20 19:32:24'),
(19, 20, 'Aulia Rachma Katry', '-', 'Serui', '1999-06-02', '2025-08-05', NULL, 'PNS', NULL, 1, '2026-09-20 19:15:32', '2026-09-20 19:27:24'),
(20, 21, 'Nani Indriyanti', '-', 'Pekalongan', '1995-12-16', '2019-10-26', NULL, 'Ibu Rumah Tangga', NULL, 1, '2026-09-20 20:09:41', '2026-09-20 20:15:19'),
(21, 22, 'Hilda Meliana', '-', 'Pekalongan', '1997-05-18', '2022-02-04', NULL, 'Karyawan Swasta', NULL, 1, '2026-09-20 20:09:41', '2026-09-20 20:15:52'),
(22, 23, 'Tisah Apriati', '-', 'Pemalang', '1997-07-16', '2022-10-26', NULL, 'Ibu Rumah Tangga', NULL, 1, '2026-09-20 20:09:41', '2026-09-20 20:10:17'),
(23, 24, 'LINA NURDIANA', '-', 'PEKALONGAN', '1976-03-05', '1999-08-08', NULL, 'Ibu Rumah Tangga', NULL, 1, '2026-09-21 21:21:46', '2026-09-21 21:21:46');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai_riwayat`
--

CREATE TABLE `pegawai_riwayat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `ref_jabatan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status_kepegawaian` varchar(50) NOT NULL DEFAULT 'pns',
  `golongan` varchar(20) DEFAULT NULL,
  `is_penyetaraan` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `status_keaktifan` varchar(50) NOT NULL DEFAULT 'aktif',
  `gaji_pokok_custom` decimal(15,2) DEFAULT NULL,
  `gaji_kontrak` decimal(15,2) DEFAULT NULL,
  `tmt_berlaku` date NOT NULL,
  `nomor_sk` varchar(100) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawai_riwayat`
--

INSERT INTO `pegawai_riwayat` (`id`, `pegawai_id`, `ref_jabatan_id`, `status_kepegawaian`, `golongan`, `is_penyetaraan`, `is_active`, `status_keaktifan`, `gaji_pokok_custom`, `gaji_kontrak`, `tmt_berlaku`, `nomor_sk`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 2, 7, 'pns', 'IV/a', 1, 0, 'nonaktif', NULL, NULL, '2026-01-14', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:45:37'),
(2, 3, 25, 'pns', 'IV/c', 0, 1, 'aktif', NULL, NULL, '2026-04-24', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:43:29'),
(3, 4, 8, 'pns', 'III/c', 0, 1, 'aktif', NULL, NULL, '2007-01-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(5, 6, 17, 'pns', 'II/c', 0, 1, 'aktif', NULL, NULL, '2014-06-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(6, 7, 15, 'pns', 'IV/b', 0, 1, 'aktif', NULL, NULL, '2006-04-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(7, 8, 3, 'pns', 'III/c', 0, 1, 'aktif', NULL, NULL, '2009-02-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(8, 9, 25, 'pns', 'IV/b', 0, 0, 'nonaktif', NULL, NULL, '2026-04-24', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-23 01:48:11'),
(9, 10, 16, 'pns', 'II/d', 0, 1, 'aktif', NULL, NULL, '2020-12-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(10, 11, 15, 'pns', 'III/b', 0, 1, 'aktif', NULL, NULL, '2022-03-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(11, 12, 15, 'pns', 'III/b', 0, 1, 'aktif', NULL, NULL, '2020-12-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(12, 13, 6, 'pns', 'III/a', 0, 1, 'aktif', NULL, NULL, '2022-03-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(13, 14, 6, 'pns', 'III/b', 0, 1, 'aktif', NULL, NULL, '2020-12-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(14, 15, 16, 'pns', 'II/d', 0, 1, 'aktif', NULL, NULL, '2022-03-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(15, 16, 16, 'pns', 'II/d', 0, 1, 'aktif', NULL, NULL, '2022-03-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(16, 17, 16, 'pns', 'II/d', 0, 1, 'aktif', NULL, NULL, '2022-03-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(17, 18, 9, 'pns', 'III/a', 0, 1, 'aktif', NULL, NULL, '2026-04-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(18, 19, 6, 'pns', 'III/b', 0, 1, 'aktif', NULL, NULL, '2020-12-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(19, 20, 11, 'pns', 'III/b', 0, 1, 'aktif', NULL, NULL, '2022-03-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(20, 21, 6, 'pppk', 'IX', 0, 1, 'aktif', NULL, NULL, '2025-07-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(21, 22, 6, 'pppk', 'IX', 0, 1, 'aktif', NULL, NULL, '2025-07-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(22, 23, 14, 'pppk', 'VII', 0, 1, 'aktif', NULL, NULL, '2024-03-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(23, 24, 1, 'pns', 'IV/b', 0, 1, 'aktif', NULL, NULL, '2026-01-14', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:43:04'),
(24, 26, 32, 'pppk_paruh_waktu', '-', 0, 1, 'aktif', NULL, 2691000.00, '1970-01-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(25, 27, 31, 'pppk_paruh_waktu', '-', 0, 1, 'aktif', NULL, 2400000.00, '1970-01-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(26, 28, 33, 'pppk_paruh_waktu', '-', 0, 1, 'aktif', NULL, 2050000.00, '1970-01-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(27, 29, 31, 'pppk_paruh_waktu', '-', 0, 1, 'aktif', NULL, 2300000.00, '1970-01-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(28, 30, 31, 'pppk_paruh_waktu', '-', 0, 1, 'aktif', NULL, 2500000.00, '1970-01-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(29, 31, 32, 'pppk_paruh_waktu', '-', 0, 1, 'aktif', NULL, 2300000.00, '1970-01-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(30, 32, 32, 'pppk_paruh_waktu', '-', 0, 1, 'aktif', NULL, 3600000.00, '1970-01-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(31, 33, 33, 'pppk_paruh_waktu', '-', 0, 1, 'aktif', NULL, 2400000.00, '1970-01-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(32, 34, 33, 'pppk_paruh_waktu', '-', 0, 1, 'aktif', NULL, 2000000.00, '1970-01-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(33, 35, 34, 'pppk_paruh_waktu', '-', 0, 1, 'aktif', NULL, 2000000.00, '1970-01-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(34, 36, 31, 'pppk_paruh_waktu', '-', 0, 1, 'aktif', NULL, 2400000.00, '1970-01-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(35, 37, 31, 'pppk_paruh_waktu', '-', 0, 1, 'aktif', NULL, 3700000.00, '1970-01-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(36, 38, 33, 'pppk_paruh_waktu', '-', 0, 1, 'aktif', NULL, 2300000.00, '1970-01-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(37, 39, 33, 'pppk_paruh_waktu', '-', 0, 1, 'aktif', NULL, 2000000.00, '1970-01-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(38, 40, 33, 'pppk_paruh_waktu', '-', 0, 1, 'aktif', NULL, 2000000.00, '1970-01-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(39, 41, 33, 'pppk_paruh_waktu', '-', 0, 1, 'aktif', NULL, 2000000.00, '1970-01-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(40, 42, 31, 'pppk_paruh_waktu', '-', 0, 1, 'aktif', NULL, 2400000.00, '1970-01-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(41, 43, 31, 'pppk_paruh_waktu', '-', 0, 1, 'aktif', NULL, 2300000.00, '1970-01-01', NULL, 'Riwayat Awal Master Pegawai', '2026-09-22 21:31:34', '2026-09-22 21:31:34'),
(42, 3, 4, 'pns', 'IV/b', 1, 1, 'aktif', NULL, NULL, '2026-01-01', NULL, NULL, '2026-09-22 21:43:52', '2026-09-22 21:43:52'),
(43, 3, 4, 'pns', 'IV/c', 1, 1, 'aktif', NULL, NULL, '2026-04-01', NULL, NULL, '2026-09-22 21:44:14', '2026-09-22 21:44:14'),
(44, 18, 9, 'cpns', 'III/a', 0, 1, 'aktif', NULL, NULL, '2026-01-01', NULL, NULL, '2026-09-22 21:47:05', '2026-09-22 23:59:14'),
(45, 5, 17, 'pns', 'III/b', 0, 0, 'nonaktif', NULL, NULL, '2026-02-01', NULL, 'Mutasi ke BPKAD', '2026-09-23 01:39:09', '2026-09-23 01:40:59'),
(46, 9, 25, 'pns', 'IV/b', 0, 1, 'aktif', NULL, NULL, '2023-01-01', NULL, NULL, '2026-09-23 01:48:54', '2026-09-23 01:48:54');

-- --------------------------------------------------------

--
-- Table structure for table `ref_gaji_pokok_pns`
--

CREATE TABLE `ref_gaji_pokok_pns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `golongan` varchar(5) NOT NULL,
  `mkg` int(11) NOT NULL,
  `nominal` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ref_gaji_pokok_pns`
--

INSERT INTO `ref_gaji_pokok_pns` (`id`, `golongan`, `mkg`, `nominal`, `created_at`, `updated_at`) VALUES
(1, 'I/a', 0, 1685700.00, NULL, NULL),
(2, 'I/a', 1, 1685700.00, NULL, NULL),
(3, 'I/a', 2, 1738800.00, NULL, NULL),
(4, 'I/a', 3, 1738800.00, NULL, NULL),
(5, 'I/a', 4, 1793500.00, NULL, NULL),
(6, 'I/a', 5, 1793500.00, NULL, NULL),
(7, 'I/a', 6, 1850000.00, NULL, NULL),
(8, 'I/a', 7, 1850000.00, NULL, NULL),
(9, 'I/a', 8, 1908300.00, NULL, NULL),
(10, 'I/a', 9, 1908300.00, NULL, NULL),
(11, 'I/a', 10, 1968400.00, NULL, NULL),
(12, 'I/a', 11, 1968400.00, NULL, NULL),
(13, 'I/a', 12, 2030400.00, NULL, NULL),
(14, 'I/a', 13, 2030400.00, NULL, NULL),
(15, 'I/a', 14, 2094300.00, NULL, NULL),
(16, 'I/a', 15, 2094300.00, NULL, NULL),
(17, 'I/a', 16, 2160300.00, NULL, NULL),
(18, 'I/a', 17, 2160300.00, NULL, NULL),
(19, 'I/a', 18, 2228300.00, NULL, NULL),
(20, 'I/a', 19, 2228300.00, NULL, NULL),
(21, 'I/a', 20, 2298500.00, NULL, NULL),
(22, 'I/a', 21, 2298500.00, NULL, NULL),
(23, 'I/a', 22, 2370900.00, NULL, NULL),
(24, 'I/a', 23, 2370900.00, NULL, NULL),
(25, 'I/a', 24, 2445500.00, NULL, NULL),
(26, 'I/a', 25, 2445500.00, NULL, NULL),
(27, 'I/a', 26, 2522600.00, NULL, NULL),
(28, 'I/a', 27, 2522600.00, NULL, NULL),
(29, 'I/b', 3, 1840800.00, NULL, NULL),
(30, 'I/b', 4, 1840800.00, NULL, NULL),
(31, 'I/b', 5, 1898800.00, NULL, NULL),
(32, 'I/b', 6, 1898800.00, NULL, NULL),
(33, 'I/b', 7, 1958600.00, NULL, NULL),
(34, 'I/b', 8, 1958600.00, NULL, NULL),
(35, 'I/b', 9, 2020300.00, NULL, NULL),
(36, 'I/b', 10, 2020300.00, NULL, NULL),
(37, 'I/b', 11, 2083900.00, NULL, NULL),
(38, 'I/b', 12, 2083900.00, NULL, NULL),
(39, 'I/b', 13, 2149600.00, NULL, NULL),
(40, 'I/b', 14, 2149600.00, NULL, NULL),
(41, 'I/b', 15, 2217300.00, NULL, NULL),
(42, 'I/b', 16, 2217300.00, NULL, NULL),
(43, 'I/b', 17, 2287100.00, NULL, NULL),
(44, 'I/b', 18, 2287100.00, NULL, NULL),
(45, 'I/b', 19, 2359100.00, NULL, NULL),
(46, 'I/b', 20, 2359100.00, NULL, NULL),
(47, 'I/b', 21, 2433400.00, NULL, NULL),
(48, 'I/b', 22, 2433400.00, NULL, NULL),
(49, 'I/b', 23, 2510100.00, NULL, NULL),
(50, 'I/b', 24, 2510100.00, NULL, NULL),
(51, 'I/b', 25, 2589100.00, NULL, NULL),
(52, 'I/b', 26, 2589100.00, NULL, NULL),
(53, 'I/b', 27, 2670700.00, NULL, NULL),
(54, 'I/c', 3, 1918700.00, NULL, NULL),
(55, 'I/c', 4, 1918700.00, NULL, NULL),
(56, 'I/c', 5, 1979100.00, NULL, NULL),
(57, 'I/c', 6, 1979100.00, NULL, NULL),
(58, 'I/c', 7, 2041500.00, NULL, NULL),
(59, 'I/c', 8, 2041500.00, NULL, NULL),
(60, 'I/c', 9, 2105800.00, NULL, NULL),
(61, 'I/c', 10, 2105800.00, NULL, NULL),
(62, 'I/c', 11, 2172100.00, NULL, NULL),
(63, 'I/c', 12, 2172100.00, NULL, NULL),
(64, 'I/c', 13, 2240500.00, NULL, NULL),
(65, 'I/c', 14, 2240500.00, NULL, NULL),
(66, 'I/c', 15, 2311100.00, NULL, NULL),
(67, 'I/c', 16, 2311100.00, NULL, NULL),
(68, 'I/c', 17, 2383900.00, NULL, NULL),
(69, 'I/c', 18, 2383900.00, NULL, NULL),
(70, 'I/c', 19, 2458900.00, NULL, NULL),
(71, 'I/c', 20, 2458900.00, NULL, NULL),
(72, 'I/c', 21, 2536400.00, NULL, NULL),
(73, 'I/c', 22, 2536400.00, NULL, NULL),
(74, 'I/c', 23, 2616300.00, NULL, NULL),
(75, 'I/c', 24, 2616300.00, NULL, NULL),
(76, 'I/c', 25, 2698700.00, NULL, NULL),
(77, 'I/c', 26, 2698700.00, NULL, NULL),
(78, 'I/c', 27, 2783700.00, NULL, NULL),
(79, 'I/d', 3, 1999900.00, NULL, NULL),
(80, 'I/d', 4, 1999900.00, NULL, NULL),
(81, 'I/d', 5, 2062900.00, NULL, NULL),
(82, 'I/d', 6, 2062900.00, NULL, NULL),
(83, 'I/d', 7, 2127800.00, NULL, NULL),
(84, 'I/d', 8, 2127800.00, NULL, NULL),
(85, 'I/d', 9, 2194800.00, NULL, NULL),
(86, 'I/d', 10, 2194800.00, NULL, NULL),
(87, 'I/d', 11, 2264000.00, NULL, NULL),
(88, 'I/d', 12, 2264000.00, NULL, NULL),
(89, 'I/d', 13, 2335300.00, NULL, NULL),
(90, 'I/d', 14, 2335300.00, NULL, NULL),
(91, 'I/d', 15, 2408800.00, NULL, NULL),
(92, 'I/d', 16, 2408800.00, NULL, NULL),
(93, 'I/d', 17, 2484700.00, NULL, NULL),
(94, 'I/d', 18, 2484700.00, NULL, NULL),
(95, 'I/d', 19, 2562900.00, NULL, NULL),
(96, 'I/d', 20, 2562900.00, NULL, NULL),
(97, 'I/d', 21, 2643700.00, NULL, NULL),
(98, 'I/d', 22, 2643700.00, NULL, NULL),
(99, 'I/d', 23, 2726900.00, NULL, NULL),
(100, 'I/d', 24, 2726900.00, NULL, NULL),
(101, 'I/d', 25, 2812800.00, NULL, NULL),
(102, 'I/d', 26, 2812800.00, NULL, NULL),
(103, 'I/d', 27, 2901400.00, NULL, NULL),
(104, 'II/a', 0, 2184000.00, NULL, NULL),
(105, 'II/a', 1, 2218400.00, NULL, NULL),
(106, 'II/a', 2, 2218400.00, NULL, NULL),
(107, 'II/a', 3, 2288200.00, NULL, NULL),
(108, 'II/a', 4, 2288200.00, NULL, NULL),
(109, 'II/a', 5, 2360300.00, NULL, NULL),
(110, 'II/a', 6, 2360300.00, NULL, NULL),
(111, 'II/a', 7, 2434600.00, NULL, NULL),
(112, 'II/a', 8, 2434600.00, NULL, NULL),
(113, 'II/a', 9, 2511300.00, NULL, NULL),
(114, 'II/a', 10, 2511300.00, NULL, NULL),
(115, 'II/a', 11, 2590400.00, NULL, NULL),
(116, 'II/a', 12, 2590400.00, NULL, NULL),
(117, 'II/a', 13, 2672000.00, NULL, NULL),
(118, 'II/a', 14, 2672000.00, NULL, NULL),
(119, 'II/a', 15, 2756200.00, NULL, NULL),
(120, 'II/a', 16, 2756200.00, NULL, NULL),
(121, 'II/a', 17, 2843000.00, NULL, NULL),
(122, 'II/a', 18, 2843000.00, NULL, NULL),
(123, 'II/a', 19, 2932500.00, NULL, NULL),
(124, 'II/a', 20, 2932500.00, NULL, NULL),
(125, 'II/a', 21, 3024900.00, NULL, NULL),
(126, 'II/a', 22, 3024900.00, NULL, NULL),
(127, 'II/a', 23, 3120100.00, NULL, NULL),
(128, 'II/a', 24, 3120100.00, NULL, NULL),
(129, 'II/a', 25, 3218400.00, NULL, NULL),
(130, 'II/a', 26, 3218400.00, NULL, NULL),
(131, 'II/a', 27, 3319800.00, NULL, NULL),
(132, 'II/a', 28, 3319800.00, NULL, NULL),
(133, 'II/a', 29, 3424300.00, NULL, NULL),
(134, 'II/a', 30, 3424300.00, NULL, NULL),
(135, 'II/a', 31, 3532200.00, NULL, NULL),
(136, 'II/a', 32, 3532200.00, NULL, NULL),
(137, 'II/a', 33, 3643400.00, NULL, NULL),
(138, 'II/b', 3, 2385000.00, NULL, NULL),
(139, 'II/b', 4, 2385000.00, NULL, NULL),
(140, 'II/b', 5, 2460100.00, NULL, NULL),
(141, 'II/b', 6, 2460100.00, NULL, NULL),
(142, 'II/b', 7, 2537600.00, NULL, NULL),
(143, 'II/b', 8, 2537600.00, NULL, NULL),
(144, 'II/b', 9, 2617500.00, NULL, NULL),
(145, 'II/b', 10, 2617500.00, NULL, NULL),
(146, 'II/b', 11, 2700000.00, NULL, NULL),
(147, 'II/b', 12, 2700000.00, NULL, NULL),
(148, 'II/b', 13, 2785000.00, NULL, NULL),
(149, 'II/b', 14, 2785000.00, NULL, NULL),
(150, 'II/b', 15, 2872700.00, NULL, NULL),
(151, 'II/b', 16, 2872700.00, NULL, NULL),
(152, 'II/b', 17, 2963200.00, NULL, NULL),
(153, 'II/b', 18, 2963200.00, NULL, NULL),
(154, 'II/b', 19, 3056500.00, NULL, NULL),
(155, 'II/b', 20, 3056500.00, NULL, NULL),
(156, 'II/b', 21, 3152800.00, NULL, NULL),
(157, 'II/b', 22, 3152800.00, NULL, NULL),
(158, 'II/b', 23, 3252100.00, NULL, NULL),
(159, 'II/b', 24, 3252100.00, NULL, NULL),
(160, 'II/b', 25, 3354500.00, NULL, NULL),
(161, 'II/b', 26, 3354500.00, NULL, NULL),
(162, 'II/b', 27, 3460200.00, NULL, NULL),
(163, 'II/b', 28, 3460200.00, NULL, NULL),
(164, 'II/b', 29, 3569200.00, NULL, NULL),
(165, 'II/b', 30, 3569200.00, NULL, NULL),
(166, 'II/b', 31, 3681600.00, NULL, NULL),
(167, 'II/b', 32, 3681600.00, NULL, NULL),
(168, 'II/b', 33, 3797500.00, NULL, NULL),
(169, 'II/c', 3, 2485900.00, NULL, NULL),
(170, 'II/c', 4, 2485900.00, NULL, NULL),
(171, 'II/c', 5, 2564200.00, NULL, NULL),
(172, 'II/c', 6, 2564200.00, NULL, NULL),
(173, 'II/c', 7, 2645000.00, NULL, NULL),
(174, 'II/c', 8, 2645000.00, NULL, NULL),
(175, 'II/c', 9, 2728300.00, NULL, NULL),
(176, 'II/c', 10, 2728300.00, NULL, NULL),
(177, 'II/c', 11, 2814200.00, NULL, NULL),
(178, 'II/c', 12, 2814200.00, NULL, NULL),
(179, 'II/c', 13, 2902800.00, NULL, NULL),
(180, 'II/c', 14, 2902800.00, NULL, NULL),
(181, 'II/c', 15, 2994300.00, NULL, NULL),
(182, 'II/c', 16, 2994300.00, NULL, NULL),
(183, 'II/c', 17, 3088600.00, NULL, NULL),
(184, 'II/c', 18, 3088600.00, NULL, NULL),
(185, 'II/c', 19, 3185800.00, NULL, NULL),
(186, 'II/c', 20, 3185800.00, NULL, NULL),
(187, 'II/c', 21, 3286200.00, NULL, NULL),
(188, 'II/c', 22, 3286200.00, NULL, NULL),
(189, 'II/c', 23, 3389700.00, NULL, NULL),
(190, 'II/c', 24, 3389700.00, NULL, NULL),
(191, 'II/c', 25, 3496400.00, NULL, NULL),
(192, 'II/c', 26, 3496400.00, NULL, NULL),
(193, 'II/c', 27, 3606500.00, NULL, NULL),
(194, 'II/c', 28, 3606500.00, NULL, NULL),
(195, 'II/c', 29, 3720100.00, NULL, NULL),
(196, 'II/c', 30, 3720100.00, NULL, NULL),
(197, 'II/c', 31, 3837300.00, NULL, NULL),
(198, 'II/c', 32, 3837300.00, NULL, NULL),
(199, 'II/c', 33, 3958200.00, NULL, NULL),
(200, 'II/d', 3, 2591100.00, NULL, NULL),
(201, 'II/d', 4, 2591100.00, NULL, NULL),
(202, 'II/d', 5, 2672700.00, NULL, NULL),
(203, 'II/d', 6, 2672700.00, NULL, NULL),
(204, 'II/d', 7, 2756800.00, NULL, NULL),
(205, 'II/d', 8, 2756800.00, NULL, NULL),
(206, 'II/d', 9, 2843700.00, NULL, NULL),
(207, 'II/d', 10, 2843700.00, NULL, NULL),
(208, 'II/d', 11, 2933100.00, NULL, NULL),
(209, 'II/d', 12, 2933100.00, NULL, NULL),
(210, 'II/d', 13, 3025600.00, NULL, NULL),
(211, 'II/d', 14, 3025600.00, NULL, NULL),
(212, 'II/d', 15, 3120900.00, NULL, NULL),
(213, 'II/d', 16, 3120900.00, NULL, NULL),
(214, 'II/d', 17, 3219200.00, NULL, NULL),
(215, 'II/d', 18, 3219200.00, NULL, NULL),
(216, 'II/d', 19, 3320600.00, NULL, NULL),
(217, 'II/d', 20, 3320600.00, NULL, NULL),
(218, 'II/d', 21, 3425200.00, NULL, NULL),
(219, 'II/d', 22, 3425200.00, NULL, NULL),
(220, 'II/d', 23, 3533100.00, NULL, NULL),
(221, 'II/d', 24, 3533100.00, NULL, NULL),
(222, 'II/d', 25, 3644300.00, NULL, NULL),
(223, 'II/d', 26, 3644300.00, NULL, NULL),
(224, 'II/d', 27, 3759100.00, NULL, NULL),
(225, 'II/d', 28, 3759100.00, NULL, NULL),
(226, 'II/d', 29, 3877500.00, NULL, NULL),
(227, 'II/d', 30, 3877500.00, NULL, NULL),
(228, 'II/d', 31, 3999600.00, NULL, NULL),
(229, 'II/d', 32, 3999600.00, NULL, NULL),
(230, 'II/d', 33, 4125600.00, NULL, NULL),
(231, 'III/a', 0, 2785700.00, NULL, NULL),
(232, 'III/a', 1, 2785700.00, NULL, NULL),
(233, 'III/a', 2, 2873500.00, NULL, NULL),
(234, 'III/a', 3, 2873500.00, NULL, NULL),
(235, 'III/a', 4, 2964000.00, NULL, NULL),
(236, 'III/a', 5, 2964000.00, NULL, NULL),
(237, 'III/a', 6, 3057300.00, NULL, NULL),
(238, 'III/a', 7, 3057300.00, NULL, NULL),
(239, 'III/a', 8, 3153600.00, NULL, NULL),
(240, 'III/a', 9, 3153600.00, NULL, NULL),
(241, 'III/a', 10, 3252900.00, NULL, NULL),
(242, 'III/a', 11, 3252900.00, NULL, NULL),
(243, 'III/a', 12, 3355400.00, NULL, NULL),
(244, 'III/a', 13, 3355400.00, NULL, NULL),
(245, 'III/a', 14, 3461100.00, NULL, NULL),
(246, 'III/a', 15, 3461100.00, NULL, NULL),
(247, 'III/a', 16, 3570100.00, NULL, NULL),
(248, 'III/a', 17, 3570100.00, NULL, NULL),
(249, 'III/a', 18, 3682500.00, NULL, NULL),
(250, 'III/a', 19, 3682500.00, NULL, NULL),
(251, 'III/a', 20, 3798500.00, NULL, NULL),
(252, 'III/a', 21, 3798500.00, NULL, NULL),
(253, 'III/a', 22, 3918100.00, NULL, NULL),
(254, 'III/a', 23, 3918100.00, NULL, NULL),
(255, 'III/a', 24, 4041500.00, NULL, NULL),
(256, 'III/a', 25, 4041500.00, NULL, NULL),
(257, 'III/a', 26, 4168800.00, NULL, NULL),
(258, 'III/a', 27, 4168800.00, NULL, NULL),
(259, 'III/a', 28, 4300100.00, NULL, NULL),
(260, 'III/a', 29, 4300100.00, NULL, NULL),
(261, 'III/a', 30, 4435500.00, NULL, NULL),
(262, 'III/a', 31, 4435500.00, NULL, NULL),
(263, 'III/a', 32, 4575200.00, NULL, NULL),
(264, 'III/a', 33, 4575200.00, NULL, NULL),
(265, 'III/b', 0, 2903600.00, NULL, NULL),
(266, 'III/b', 1, 2903600.00, NULL, NULL),
(267, 'III/b', 2, 2995100.00, NULL, NULL),
(268, 'III/b', 3, 2995100.00, NULL, NULL),
(269, 'III/b', 4, 3089300.00, NULL, NULL),
(270, 'III/b', 5, 3089300.00, NULL, NULL),
(271, 'III/b', 6, 3186600.00, NULL, NULL),
(272, 'III/b', 7, 3186600.00, NULL, NULL),
(273, 'III/b', 8, 3287000.00, NULL, NULL),
(274, 'III/b', 9, 3287000.00, NULL, NULL),
(275, 'III/b', 10, 3390500.00, NULL, NULL),
(276, 'III/b', 11, 3390500.00, NULL, NULL),
(277, 'III/b', 12, 3497300.00, NULL, NULL),
(278, 'III/b', 13, 3497300.00, NULL, NULL),
(279, 'III/b', 14, 3607500.00, NULL, NULL),
(280, 'III/b', 15, 3607500.00, NULL, NULL),
(281, 'III/b', 16, 3721100.00, NULL, NULL),
(282, 'III/b', 17, 3721100.00, NULL, NULL),
(283, 'III/b', 18, 3838300.00, NULL, NULL),
(284, 'III/b', 19, 3838300.00, NULL, NULL),
(285, 'III/b', 20, 3959200.00, NULL, NULL),
(286, 'III/b', 21, 3959200.00, NULL, NULL),
(287, 'III/b', 22, 4083900.00, NULL, NULL),
(288, 'III/b', 23, 4083900.00, NULL, NULL),
(289, 'III/b', 24, 4212500.00, NULL, NULL),
(290, 'III/b', 25, 4212500.00, NULL, NULL),
(291, 'III/b', 26, 4345100.00, NULL, NULL),
(292, 'III/b', 27, 4345100.00, NULL, NULL),
(293, 'III/b', 28, 4482000.00, NULL, NULL),
(294, 'III/b', 29, 4482000.00, NULL, NULL),
(295, 'III/b', 30, 4623200.00, NULL, NULL),
(296, 'III/b', 31, 4623200.00, NULL, NULL),
(297, 'III/b', 32, 4768800.00, NULL, NULL),
(298, 'III/b', 33, 4768800.00, NULL, NULL),
(299, 'III/c', 0, 3026400.00, NULL, NULL),
(300, 'III/c', 1, 3026400.00, NULL, NULL),
(301, 'III/c', 2, 3121700.00, NULL, NULL),
(302, 'III/c', 3, 3121700.00, NULL, NULL),
(303, 'III/c', 4, 3220000.00, NULL, NULL),
(304, 'III/c', 5, 3220000.00, NULL, NULL),
(305, 'III/c', 6, 3321400.00, NULL, NULL),
(306, 'III/c', 7, 3321400.00, NULL, NULL),
(307, 'III/c', 8, 3426000.00, NULL, NULL),
(308, 'III/c', 9, 3426000.00, NULL, NULL),
(309, 'III/c', 10, 3533900.00, NULL, NULL),
(310, 'III/c', 11, 3533900.00, NULL, NULL),
(311, 'III/c', 12, 3645200.00, NULL, NULL),
(312, 'III/c', 13, 3645200.00, NULL, NULL),
(313, 'III/c', 14, 3760100.00, NULL, NULL),
(314, 'III/c', 15, 3760100.00, NULL, NULL),
(315, 'III/c', 16, 3878500.00, NULL, NULL),
(316, 'III/c', 17, 3878500.00, NULL, NULL),
(317, 'III/c', 18, 4000600.00, NULL, NULL),
(318, 'III/c', 19, 4000600.00, NULL, NULL),
(319, 'III/c', 20, 4126500.00, NULL, NULL),
(320, 'III/c', 21, 4126500.00, NULL, NULL),
(321, 'III/c', 22, 4256600.00, NULL, NULL),
(322, 'III/c', 23, 4256600.00, NULL, NULL),
(323, 'III/c', 24, 4390700.00, NULL, NULL),
(324, 'III/c', 25, 4390700.00, NULL, NULL),
(325, 'III/c', 26, 4528900.00, NULL, NULL),
(326, 'III/c', 27, 4528900.00, NULL, NULL),
(327, 'III/c', 28, 4671600.00, NULL, NULL),
(328, 'III/c', 29, 4671600.00, NULL, NULL),
(329, 'III/c', 30, 4818700.00, NULL, NULL),
(330, 'III/c', 31, 4818700.00, NULL, NULL),
(331, 'III/c', 32, 4970500.00, NULL, NULL),
(332, 'III/c', 33, 4970500.00, NULL, NULL),
(333, 'III/d', 0, 3154400.00, NULL, NULL),
(334, 'III/d', 1, 3154400.00, NULL, NULL),
(335, 'III/d', 2, 3253700.00, NULL, NULL),
(336, 'III/d', 3, 3253700.00, NULL, NULL),
(337, 'III/d', 4, 3356200.00, NULL, NULL),
(338, 'III/d', 5, 3356200.00, NULL, NULL),
(339, 'III/d', 6, 3461900.00, NULL, NULL),
(340, 'III/d', 7, 3461900.00, NULL, NULL),
(341, 'III/d', 8, 3571000.00, NULL, NULL),
(342, 'III/d', 9, 3571000.00, NULL, NULL),
(343, 'III/d', 10, 3683400.00, NULL, NULL),
(344, 'III/d', 11, 3683400.00, NULL, NULL),
(345, 'III/d', 12, 3799400.00, NULL, NULL),
(346, 'III/d', 13, 3799400.00, NULL, NULL),
(347, 'III/d', 14, 3919100.00, NULL, NULL),
(348, 'III/d', 15, 3919100.00, NULL, NULL),
(349, 'III/d', 16, 4042500.00, NULL, NULL),
(350, 'III/d', 17, 4042500.00, NULL, NULL),
(351, 'III/d', 18, 4169900.00, NULL, NULL),
(352, 'III/d', 19, 4169900.00, NULL, NULL),
(353, 'III/d', 20, 4301200.00, NULL, NULL),
(354, 'III/d', 21, 4301200.00, NULL, NULL),
(355, 'III/d', 22, 4436700.00, NULL, NULL),
(356, 'III/d', 23, 4436700.00, NULL, NULL),
(357, 'III/d', 24, 4576400.00, NULL, NULL),
(358, 'III/d', 25, 4576400.00, NULL, NULL),
(359, 'III/d', 26, 4720500.00, NULL, NULL),
(360, 'III/d', 27, 4720500.00, NULL, NULL),
(361, 'III/d', 28, 4869200.00, NULL, NULL),
(362, 'III/d', 29, 4869200.00, NULL, NULL),
(363, 'III/d', 30, 5022500.00, NULL, NULL),
(364, 'III/d', 31, 5022500.00, NULL, NULL),
(365, 'III/d', 32, 5180700.00, NULL, NULL),
(366, 'III/d', 33, 5180700.00, NULL, NULL),
(367, 'IV/a', 0, 3287800.00, NULL, NULL),
(368, 'IV/a', 1, 3287800.00, NULL, NULL),
(369, 'IV/a', 2, 3391400.00, NULL, NULL),
(370, 'IV/a', 3, 3391400.00, NULL, NULL),
(371, 'IV/a', 4, 3498200.00, NULL, NULL),
(372, 'IV/a', 5, 3498200.00, NULL, NULL),
(373, 'IV/a', 6, 3608400.00, NULL, NULL),
(374, 'IV/a', 7, 3608400.00, NULL, NULL),
(375, 'IV/a', 8, 3722000.00, NULL, NULL),
(376, 'IV/a', 9, 3722000.00, NULL, NULL),
(377, 'IV/a', 10, 3839200.00, NULL, NULL),
(378, 'IV/a', 11, 3839200.00, NULL, NULL),
(379, 'IV/a', 12, 3960200.00, NULL, NULL),
(380, 'IV/a', 13, 3960200.00, NULL, NULL),
(381, 'IV/a', 14, 4084900.00, NULL, NULL),
(382, 'IV/a', 15, 4084900.00, NULL, NULL),
(383, 'IV/a', 16, 4213500.00, NULL, NULL),
(384, 'IV/a', 17, 4213500.00, NULL, NULL),
(385, 'IV/a', 18, 4346200.00, NULL, NULL),
(386, 'IV/a', 19, 4346200.00, NULL, NULL),
(387, 'IV/a', 20, 4483100.00, NULL, NULL),
(388, 'IV/a', 21, 4483100.00, NULL, NULL),
(389, 'IV/a', 22, 4624300.00, NULL, NULL),
(390, 'IV/a', 23, 4624300.00, NULL, NULL),
(391, 'IV/a', 24, 4770000.00, NULL, NULL),
(392, 'IV/a', 25, 4770000.00, NULL, NULL),
(393, 'IV/a', 26, 4920200.00, NULL, NULL),
(394, 'IV/a', 27, 4920200.00, NULL, NULL),
(395, 'IV/a', 28, 5075200.00, NULL, NULL),
(396, 'IV/a', 29, 5075200.00, NULL, NULL),
(397, 'IV/a', 30, 5235000.00, NULL, NULL),
(398, 'IV/a', 31, 5235000.00, NULL, NULL),
(399, 'IV/a', 32, 5399900.00, NULL, NULL),
(400, 'IV/a', 33, 5399900.00, NULL, NULL),
(401, 'IV/b', 0, 3426900.00, NULL, NULL),
(402, 'IV/b', 1, 3426900.00, NULL, NULL),
(403, 'IV/b', 2, 3534800.00, NULL, NULL),
(404, 'IV/b', 3, 3534800.00, NULL, NULL),
(405, 'IV/b', 4, 3646200.00, NULL, NULL),
(406, 'IV/b', 5, 3646200.00, NULL, NULL),
(407, 'IV/b', 6, 3761000.00, NULL, NULL),
(408, 'IV/b', 7, 3761000.00, NULL, NULL),
(409, 'IV/b', 8, 3879500.00, NULL, NULL),
(410, 'IV/b', 9, 3879500.00, NULL, NULL),
(411, 'IV/b', 10, 4001600.00, NULL, NULL),
(412, 'IV/b', 11, 4001600.00, NULL, NULL),
(413, 'IV/b', 12, 4127700.00, NULL, NULL),
(414, 'IV/b', 13, 4127700.00, NULL, NULL),
(415, 'IV/b', 14, 4257700.00, NULL, NULL),
(416, 'IV/b', 15, 4257700.00, NULL, NULL),
(417, 'IV/b', 16, 4391800.00, NULL, NULL),
(418, 'IV/b', 17, 4391800.00, NULL, NULL),
(419, 'IV/b', 18, 4530100.00, NULL, NULL),
(420, 'IV/b', 19, 4530100.00, NULL, NULL),
(421, 'IV/b', 20, 4672800.00, NULL, NULL),
(422, 'IV/b', 21, 4672800.00, NULL, NULL),
(423, 'IV/b', 22, 4819900.00, NULL, NULL),
(424, 'IV/b', 23, 4819900.00, NULL, NULL),
(425, 'IV/b', 24, 4971700.00, NULL, NULL),
(426, 'IV/b', 25, 4971700.00, NULL, NULL),
(427, 'IV/b', 26, 5128300.00, NULL, NULL),
(428, 'IV/b', 27, 5128300.00, NULL, NULL),
(429, 'IV/b', 28, 5289800.00, NULL, NULL),
(430, 'IV/b', 29, 5289800.00, NULL, NULL),
(431, 'IV/b', 30, 5456400.00, NULL, NULL),
(432, 'IV/b', 31, 5456400.00, NULL, NULL),
(433, 'IV/b', 32, 5628300.00, NULL, NULL),
(434, 'IV/b', 33, 5628300.00, NULL, NULL),
(435, 'IV/c', 0, 3571900.00, NULL, NULL),
(436, 'IV/c', 1, 3571900.00, NULL, NULL),
(437, 'IV/c', 2, 3684400.00, NULL, NULL),
(438, 'IV/c', 3, 3684400.00, NULL, NULL),
(439, 'IV/c', 4, 3800400.00, NULL, NULL),
(440, 'IV/c', 5, 3800400.00, NULL, NULL),
(441, 'IV/c', 6, 3920100.00, NULL, NULL),
(442, 'IV/c', 7, 3920100.00, NULL, NULL),
(443, 'IV/c', 8, 4043600.00, NULL, NULL),
(444, 'IV/c', 9, 4043600.00, NULL, NULL),
(445, 'IV/c', 10, 4170900.00, NULL, NULL),
(446, 'IV/c', 11, 4170900.00, NULL, NULL),
(447, 'IV/c', 12, 4302300.00, NULL, NULL),
(448, 'IV/c', 13, 4302300.00, NULL, NULL),
(449, 'IV/c', 14, 4437800.00, NULL, NULL),
(450, 'IV/c', 15, 4437800.00, NULL, NULL),
(451, 'IV/c', 16, 4577500.00, NULL, NULL),
(452, 'IV/c', 17, 4577500.00, NULL, NULL),
(453, 'IV/c', 18, 4721700.00, NULL, NULL),
(454, 'IV/c', 19, 4721700.00, NULL, NULL),
(455, 'IV/c', 20, 4870400.00, NULL, NULL),
(456, 'IV/c', 21, 4870400.00, NULL, NULL),
(457, 'IV/c', 22, 5023800.00, NULL, NULL),
(458, 'IV/c', 23, 5023800.00, NULL, NULL),
(459, 'IV/c', 24, 5182000.00, NULL, NULL),
(460, 'IV/c', 25, 5182000.00, NULL, NULL),
(461, 'IV/c', 26, 5345200.00, NULL, NULL),
(462, 'IV/c', 27, 5345200.00, NULL, NULL),
(463, 'IV/c', 28, 5513600.00, NULL, NULL),
(464, 'IV/c', 29, 5513600.00, NULL, NULL),
(465, 'IV/c', 30, 5687200.00, NULL, NULL),
(466, 'IV/c', 31, 5687200.00, NULL, NULL),
(467, 'IV/c', 32, 5866400.00, NULL, NULL),
(468, 'IV/c', 33, 5866400.00, NULL, NULL),
(469, 'IV/d', 0, 3723000.00, NULL, NULL),
(470, 'IV/d', 1, 3723000.00, NULL, NULL),
(471, 'IV/d', 2, 3840200.00, NULL, NULL),
(472, 'IV/d', 3, 3840200.00, NULL, NULL),
(473, 'IV/d', 4, 3961200.00, NULL, NULL),
(474, 'IV/d', 5, 3961200.00, NULL, NULL),
(475, 'IV/d', 6, 4085900.00, NULL, NULL),
(476, 'IV/d', 7, 4085900.00, NULL, NULL),
(477, 'IV/d', 8, 4214600.00, NULL, NULL),
(478, 'IV/d', 9, 4214600.00, NULL, NULL),
(479, 'IV/d', 10, 4347300.00, NULL, NULL),
(480, 'IV/d', 11, 4347300.00, NULL, NULL),
(481, 'IV/d', 12, 4484300.00, NULL, NULL),
(482, 'IV/d', 13, 4484300.00, NULL, NULL),
(483, 'IV/d', 14, 4625500.00, NULL, NULL),
(484, 'IV/d', 15, 4625500.00, NULL, NULL),
(485, 'IV/d', 16, 4771200.00, NULL, NULL),
(486, 'IV/d', 17, 4771200.00, NULL, NULL),
(487, 'IV/d', 18, 4921400.00, NULL, NULL),
(488, 'IV/d', 19, 4921400.00, NULL, NULL),
(489, 'IV/d', 20, 5076400.00, NULL, NULL),
(490, 'IV/d', 21, 5076400.00, NULL, NULL),
(491, 'IV/d', 22, 5236300.00, NULL, NULL),
(492, 'IV/d', 23, 5236300.00, NULL, NULL),
(493, 'IV/d', 24, 5401200.00, NULL, NULL),
(494, 'IV/d', 25, 5401200.00, NULL, NULL),
(495, 'IV/d', 26, 5571400.00, NULL, NULL),
(496, 'IV/d', 27, 5571400.00, NULL, NULL),
(497, 'IV/d', 28, 5746800.00, NULL, NULL),
(498, 'IV/d', 29, 5746800.00, NULL, NULL),
(499, 'IV/d', 30, 5927800.00, NULL, NULL),
(500, 'IV/d', 31, 5927800.00, NULL, NULL),
(501, 'IV/d', 32, 6114500.00, NULL, NULL),
(502, 'IV/d', 33, 6114500.00, NULL, NULL),
(503, 'IV/e', 0, 3880400.00, NULL, NULL),
(504, 'IV/e', 1, 3880400.00, NULL, NULL),
(505, 'IV/e', 2, 4002700.00, NULL, NULL),
(506, 'IV/e', 3, 4002700.00, NULL, NULL),
(507, 'IV/e', 4, 4128700.00, NULL, NULL),
(508, 'IV/e', 5, 4128700.00, NULL, NULL),
(509, 'IV/e', 6, 4258700.00, NULL, NULL),
(510, 'IV/e', 7, 4258700.00, NULL, NULL),
(511, 'IV/e', 8, 4392900.00, NULL, NULL),
(512, 'IV/e', 9, 4392900.00, NULL, NULL),
(513, 'IV/e', 10, 4531200.00, NULL, NULL),
(514, 'IV/e', 11, 4531200.00, NULL, NULL),
(515, 'IV/e', 12, 4673900.00, NULL, NULL),
(516, 'IV/e', 13, 4673900.00, NULL, NULL),
(517, 'IV/e', 14, 4821100.00, NULL, NULL),
(518, 'IV/e', 15, 4821100.00, NULL, NULL),
(519, 'IV/e', 16, 4973000.00, NULL, NULL),
(520, 'IV/e', 17, 4973000.00, NULL, NULL),
(521, 'IV/e', 18, 5129600.00, NULL, NULL),
(522, 'IV/e', 19, 5129600.00, NULL, NULL),
(523, 'IV/e', 20, 5291200.00, NULL, NULL),
(524, 'IV/e', 21, 5291200.00, NULL, NULL),
(525, 'IV/e', 22, 5457800.00, NULL, NULL),
(526, 'IV/e', 23, 5457800.00, NULL, NULL),
(527, 'IV/e', 24, 5629700.00, NULL, NULL),
(528, 'IV/e', 25, 5629700.00, NULL, NULL),
(529, 'IV/e', 26, 5807000.00, NULL, NULL),
(530, 'IV/e', 27, 5807000.00, NULL, NULL),
(531, 'IV/e', 28, 5989900.00, NULL, NULL),
(532, 'IV/e', 29, 5989900.00, NULL, NULL),
(533, 'IV/e', 30, 6178600.00, NULL, NULL),
(534, 'IV/e', 31, 6178600.00, NULL, NULL),
(535, 'IV/e', 32, 6373200.00, NULL, NULL),
(536, 'IV/e', 33, 6373200.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ref_gaji_pokok_pppk`
--

CREATE TABLE `ref_gaji_pokok_pppk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `golongan` varchar(10) NOT NULL,
  `mkg` int(11) NOT NULL,
  `nominal` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ref_gaji_pokok_pppk`
--

INSERT INTO `ref_gaji_pokok_pppk` (`id`, `golongan`, `mkg`, `nominal`, `created_at`, `updated_at`) VALUES
(1, 'I', 0, 1938500.00, NULL, NULL),
(2, 'I', 1, 1938500.00, NULL, NULL),
(3, 'I', 2, 1999500.00, NULL, NULL),
(4, 'I', 3, 1999500.00, NULL, NULL),
(5, 'I', 4, 2062500.00, NULL, NULL),
(6, 'I', 5, 2062500.00, NULL, NULL),
(7, 'I', 6, 2127500.00, NULL, NULL),
(8, 'I', 7, 2127500.00, NULL, NULL),
(9, 'I', 8, 2194500.00, NULL, NULL),
(10, 'I', 9, 2194500.00, NULL, NULL),
(11, 'I', 10, 2263600.00, NULL, NULL),
(12, 'I', 11, 2263600.00, NULL, NULL),
(13, 'I', 12, 2334900.00, NULL, NULL),
(14, 'I', 13, 2334900.00, NULL, NULL),
(15, 'I', 14, 2408400.00, NULL, NULL),
(16, 'I', 15, 2408400.00, NULL, NULL),
(17, 'I', 16, 2484300.00, NULL, NULL),
(18, 'I', 17, 2484300.00, NULL, NULL),
(19, 'I', 18, 2562500.00, NULL, NULL),
(20, 'I', 19, 2562500.00, NULL, NULL),
(21, 'I', 20, 2643200.00, NULL, NULL),
(22, 'I', 21, 2643200.00, NULL, NULL),
(23, 'I', 22, 2726500.00, NULL, NULL),
(24, 'I', 23, 2726500.00, NULL, NULL),
(25, 'I', 24, 2812400.00, NULL, NULL),
(26, 'I', 25, 2812400.00, NULL, NULL),
(27, 'I', 26, 2900900.00, NULL, NULL),
(28, 'I', 27, 2900900.00, NULL, NULL),
(29, 'II', 3, 2116900.00, NULL, NULL),
(30, 'II', 4, 2116900.00, NULL, NULL),
(31, 'II', 5, 2183600.00, NULL, NULL),
(32, 'II', 6, 2183600.00, NULL, NULL),
(33, 'II', 7, 2252400.00, NULL, NULL),
(34, 'II', 8, 2252400.00, NULL, NULL),
(35, 'II', 9, 2323300.00, NULL, NULL),
(36, 'II', 10, 2323300.00, NULL, NULL),
(37, 'II', 11, 2396500.00, NULL, NULL),
(38, 'II', 12, 2396500.00, NULL, NULL),
(39, 'II', 13, 2472000.00, NULL, NULL),
(40, 'II', 14, 2472000.00, NULL, NULL),
(41, 'II', 15, 2549800.00, NULL, NULL),
(42, 'II', 16, 2549800.00, NULL, NULL),
(43, 'II', 17, 2630100.00, NULL, NULL),
(44, 'II', 18, 2630100.00, NULL, NULL),
(45, 'II', 19, 2713000.00, NULL, NULL),
(46, 'II', 20, 2713000.00, NULL, NULL),
(47, 'II', 21, 2798400.00, NULL, NULL),
(48, 'II', 22, 2798400.00, NULL, NULL),
(49, 'II', 23, 2886600.00, NULL, NULL),
(50, 'II', 24, 2886600.00, NULL, NULL),
(51, 'II', 25, 2977500.00, NULL, NULL),
(52, 'II', 26, 2977500.00, NULL, NULL),
(53, 'II', 27, 3071200.00, NULL, NULL),
(54, 'III', 3, 2206500.00, NULL, NULL),
(55, 'III', 4, 2206500.00, NULL, NULL),
(56, 'III', 5, 2276000.00, NULL, NULL),
(57, 'III', 6, 2276000.00, NULL, NULL),
(58, 'III', 7, 2347700.00, NULL, NULL),
(59, 'III', 8, 2347700.00, NULL, NULL),
(60, 'III', 9, 2421600.00, NULL, NULL),
(61, 'III', 10, 2421600.00, NULL, NULL),
(62, 'III', 11, 2497900.00, NULL, NULL),
(63, 'III', 12, 2497900.00, NULL, NULL),
(64, 'III', 13, 2576500.00, NULL, NULL),
(65, 'III', 14, 2576500.00, NULL, NULL),
(66, 'III', 15, 2657700.00, NULL, NULL),
(67, 'III', 16, 2657700.00, NULL, NULL),
(68, 'III', 17, 2741400.00, NULL, NULL),
(69, 'III', 18, 2741400.00, NULL, NULL),
(70, 'III', 19, 2827700.00, NULL, NULL),
(71, 'III', 20, 2827700.00, NULL, NULL),
(72, 'III', 21, 2916800.00, NULL, NULL),
(73, 'III', 22, 2916800.00, NULL, NULL),
(74, 'III', 23, 3008700.00, NULL, NULL),
(75, 'III', 24, 3008700.00, NULL, NULL),
(76, 'III', 25, 3103400.00, NULL, NULL),
(77, 'III', 26, 3103400.00, NULL, NULL),
(78, 'III', 27, 3201200.00, NULL, NULL),
(79, 'IV', 3, 2299800.00, NULL, NULL),
(80, 'IV', 4, 2299800.00, NULL, NULL),
(81, 'IV', 5, 2372300.00, NULL, NULL),
(82, 'IV', 6, 2372300.00, NULL, NULL),
(83, 'IV', 7, 2447000.00, NULL, NULL),
(84, 'IV', 8, 2447000.00, NULL, NULL),
(85, 'IV', 9, 2524000.00, NULL, NULL),
(86, 'IV', 10, 2524000.00, NULL, NULL),
(87, 'IV', 11, 2603500.00, NULL, NULL),
(88, 'IV', 12, 2603500.00, NULL, NULL),
(89, 'IV', 13, 2685500.00, NULL, NULL),
(90, 'IV', 14, 2685500.00, NULL, NULL),
(91, 'IV', 15, 2770100.00, NULL, NULL),
(92, 'IV', 16, 2770100.00, NULL, NULL),
(93, 'IV', 17, 2857400.00, NULL, NULL),
(94, 'IV', 18, 2857400.00, NULL, NULL),
(95, 'IV', 19, 2947400.00, NULL, NULL),
(96, 'IV', 20, 2947400.00, NULL, NULL),
(97, 'IV', 21, 3040200.00, NULL, NULL),
(98, 'IV', 22, 3040200.00, NULL, NULL),
(99, 'IV', 23, 3135900.00, NULL, NULL),
(100, 'IV', 24, 3135900.00, NULL, NULL),
(101, 'IV', 25, 3234700.00, NULL, NULL),
(102, 'IV', 26, 3234700.00, NULL, NULL),
(103, 'IV', 27, 3336600.00, NULL, NULL),
(104, 'V', 0, 2511500.00, NULL, NULL),
(105, 'V', 1, 2551100.00, NULL, NULL),
(106, 'V', 2, 2551100.00, NULL, NULL),
(107, 'V', 3, 2631400.00, NULL, NULL),
(108, 'V', 4, 2631400.00, NULL, NULL),
(109, 'V', 5, 2714300.00, NULL, NULL),
(110, 'V', 6, 2714300.00, NULL, NULL),
(111, 'V', 7, 2799800.00, NULL, NULL),
(112, 'V', 8, 2799800.00, NULL, NULL),
(113, 'V', 9, 2888000.00, NULL, NULL),
(114, 'V', 10, 2888000.00, NULL, NULL),
(115, 'V', 11, 2978900.00, NULL, NULL),
(116, 'V', 12, 2978900.00, NULL, NULL),
(117, 'V', 13, 3072800.00, NULL, NULL),
(118, 'V', 14, 3072800.00, NULL, NULL),
(119, 'V', 15, 3169500.00, NULL, NULL),
(120, 'V', 16, 3169500.00, NULL, NULL),
(121, 'V', 17, 3269400.00, NULL, NULL),
(122, 'V', 18, 3269400.00, NULL, NULL),
(123, 'V', 19, 3372300.00, NULL, NULL),
(124, 'V', 20, 3372300.00, NULL, NULL),
(125, 'V', 21, 3478500.00, NULL, NULL),
(126, 'V', 22, 3478500.00, NULL, NULL),
(127, 'V', 23, 3588100.00, NULL, NULL),
(128, 'V', 24, 3588100.00, NULL, NULL),
(129, 'V', 25, 3701100.00, NULL, NULL),
(130, 'V', 26, 3701100.00, NULL, NULL),
(131, 'V', 27, 3817700.00, NULL, NULL),
(132, 'V', 28, 3817700.00, NULL, NULL),
(133, 'V', 29, 3937900.00, NULL, NULL),
(134, 'V', 30, 3937900.00, NULL, NULL),
(135, 'V', 31, 4061900.00, NULL, NULL),
(136, 'V', 32, 4061900.00, NULL, NULL),
(137, 'V', 33, 4189900.00, NULL, NULL),
(138, 'VI', 3, 2742800.00, NULL, NULL),
(139, 'VI', 4, 2742800.00, NULL, NULL),
(140, 'VI', 5, 2829100.00, NULL, NULL),
(141, 'VI', 6, 2829100.00, NULL, NULL),
(142, 'VI', 7, 2918200.00, NULL, NULL),
(143, 'VI', 8, 2918200.00, NULL, NULL),
(144, 'VI', 9, 3010100.00, NULL, NULL),
(145, 'VI', 10, 3010100.00, NULL, NULL),
(146, 'VI', 11, 3105000.00, NULL, NULL),
(147, 'VI', 12, 3105000.00, NULL, NULL),
(148, 'VI', 13, 3202700.00, NULL, NULL),
(149, 'VI', 14, 3202700.00, NULL, NULL),
(150, 'VI', 15, 3303600.00, NULL, NULL),
(151, 'VI', 16, 3303600.00, NULL, NULL),
(152, 'VI', 17, 3407700.00, NULL, NULL),
(153, 'VI', 18, 3407700.00, NULL, NULL),
(154, 'VI', 19, 3515000.00, NULL, NULL),
(155, 'VI', 20, 3515000.00, NULL, NULL),
(156, 'VI', 21, 3625700.00, NULL, NULL),
(157, 'VI', 22, 3625700.00, NULL, NULL),
(158, 'VI', 23, 3739900.00, NULL, NULL),
(159, 'VI', 24, 3739900.00, NULL, NULL),
(160, 'VI', 25, 3857700.00, NULL, NULL),
(161, 'VI', 26, 3857700.00, NULL, NULL),
(162, 'VI', 27, 3979200.00, NULL, NULL),
(163, 'VI', 28, 3979200.00, NULL, NULL),
(164, 'VI', 29, 4104500.00, NULL, NULL),
(165, 'VI', 30, 4104500.00, NULL, NULL),
(166, 'VI', 31, 4233800.00, NULL, NULL),
(167, 'VI', 32, 4233800.00, NULL, NULL),
(168, 'VI', 33, 4367100.00, NULL, NULL),
(169, 'VII', 3, 2858800.00, NULL, NULL),
(170, 'VII', 4, 2858800.00, NULL, NULL),
(171, 'VII', 5, 2948800.00, NULL, NULL),
(172, 'VII', 6, 2948800.00, NULL, NULL),
(173, 'VII', 7, 3041700.00, NULL, NULL),
(174, 'VII', 8, 3041700.00, NULL, NULL),
(175, 'VII', 9, 3137500.00, NULL, NULL),
(176, 'VII', 10, 3137500.00, NULL, NULL),
(177, 'VII', 11, 3236300.00, NULL, NULL),
(178, 'VII', 12, 3236300.00, NULL, NULL),
(179, 'VII', 13, 3338200.00, NULL, NULL),
(180, 'VII', 14, 3338200.00, NULL, NULL),
(181, 'VII', 15, 3443400.00, NULL, NULL),
(182, 'VII', 16, 3443400.00, NULL, NULL),
(183, 'VII', 17, 3551800.00, NULL, NULL),
(184, 'VII', 18, 3551800.00, NULL, NULL),
(185, 'VII', 19, 3663700.00, NULL, NULL),
(186, 'VII', 20, 3663700.00, NULL, NULL),
(187, 'VII', 21, 3779100.00, NULL, NULL),
(188, 'VII', 22, 3779100.00, NULL, NULL),
(189, 'VII', 23, 3898100.00, NULL, NULL),
(190, 'VII', 24, 3898100.00, NULL, NULL),
(191, 'VII', 25, 4020800.00, NULL, NULL),
(192, 'VII', 26, 4020800.00, NULL, NULL),
(193, 'VII', 27, 4147500.00, NULL, NULL),
(194, 'VII', 28, 4147500.00, NULL, NULL),
(195, 'VII', 29, 4278100.00, NULL, NULL),
(196, 'VII', 30, 4278100.00, NULL, NULL),
(197, 'VII', 31, 4412800.00, NULL, NULL),
(198, 'VII', 32, 4412800.00, NULL, NULL),
(199, 'VII', 33, 4551800.00, NULL, NULL),
(200, 'VIII', 3, 2979700.00, NULL, NULL),
(201, 'VIII', 4, 2979700.00, NULL, NULL),
(202, 'VIII', 5, 3073500.00, NULL, NULL),
(203, 'VIII', 6, 3073500.00, NULL, NULL),
(204, 'VIII', 7, 3170300.00, NULL, NULL),
(205, 'VIII', 8, 3170300.00, NULL, NULL),
(206, 'VIII', 9, 3270200.00, NULL, NULL),
(207, 'VIII', 10, 3270200.00, NULL, NULL),
(208, 'VIII', 11, 3373200.00, NULL, NULL),
(209, 'VIII', 12, 3373200.00, NULL, NULL),
(210, 'VIII', 13, 3479400.00, NULL, NULL),
(211, 'VIII', 14, 3479400.00, NULL, NULL),
(212, 'VIII', 15, 3589000.00, NULL, NULL),
(213, 'VIII', 16, 3589000.00, NULL, NULL),
(214, 'VIII', 17, 3702000.00, NULL, NULL),
(215, 'VIII', 18, 3702000.00, NULL, NULL),
(216, 'VIII', 19, 3818600.00, NULL, NULL),
(217, 'VIII', 20, 3818600.00, NULL, NULL),
(218, 'VIII', 21, 3938900.00, NULL, NULL),
(219, 'VIII', 22, 3938900.00, NULL, NULL),
(220, 'VIII', 23, 4063000.00, NULL, NULL),
(221, 'VIII', 24, 4063000.00, NULL, NULL),
(222, 'VIII', 25, 4190900.00, NULL, NULL),
(223, 'VIII', 26, 4190900.00, NULL, NULL),
(224, 'VIII', 27, 4322900.00, NULL, NULL),
(225, 'VIII', 28, 4322900.00, NULL, NULL),
(226, 'VIII', 29, 4459100.00, NULL, NULL),
(227, 'VIII', 30, 4459100.00, NULL, NULL),
(228, 'VIII', 31, 4599500.00, NULL, NULL),
(229, 'VIII', 32, 4599500.00, NULL, NULL),
(230, 'VIII', 33, 4744400.00, NULL, NULL),
(231, 'IX', 0, 3203600.00, NULL, NULL),
(232, 'IX', 1, 3203600.00, NULL, NULL),
(233, 'IX', 2, 3304400.00, NULL, NULL),
(234, 'IX', 3, 3304400.00, NULL, NULL),
(235, 'IX', 4, 3408500.00, NULL, NULL),
(236, 'IX', 5, 3408500.00, NULL, NULL),
(237, 'IX', 6, 3515900.00, NULL, NULL),
(238, 'IX', 7, 3515900.00, NULL, NULL),
(239, 'IX', 8, 3626600.00, NULL, NULL),
(240, 'IX', 9, 3626600.00, NULL, NULL),
(241, 'IX', 10, 3740800.00, NULL, NULL),
(242, 'IX', 11, 3740800.00, NULL, NULL),
(243, 'IX', 12, 3858600.00, NULL, NULL),
(244, 'IX', 13, 3858600.00, NULL, NULL),
(245, 'IX', 14, 3980200.00, NULL, NULL),
(246, 'IX', 15, 3980200.00, NULL, NULL),
(247, 'IX', 16, 4105500.00, NULL, NULL),
(248, 'IX', 17, 4105500.00, NULL, NULL),
(249, 'IX', 18, 4234800.00, NULL, NULL),
(250, 'IX', 19, 4234800.00, NULL, NULL),
(251, 'IX', 20, 4368200.00, NULL, NULL),
(252, 'IX', 21, 4368200.00, NULL, NULL),
(253, 'IX', 22, 4505800.00, NULL, NULL),
(254, 'IX', 23, 4505800.00, NULL, NULL),
(255, 'IX', 24, 4647700.00, NULL, NULL),
(256, 'IX', 25, 4647700.00, NULL, NULL),
(257, 'IX', 26, 4794100.00, NULL, NULL),
(258, 'IX', 27, 4794100.00, NULL, NULL),
(259, 'IX', 28, 4945100.00, NULL, NULL),
(260, 'IX', 29, 4945100.00, NULL, NULL),
(261, 'IX', 30, 5100800.00, NULL, NULL),
(262, 'IX', 31, 5100800.00, NULL, NULL),
(263, 'IX', 32, 5261500.00, NULL, NULL),
(264, 'IX', 33, 5261500.00, NULL, NULL),
(265, 'X', 0, 3339100.00, NULL, NULL),
(266, 'X', 1, 3339100.00, NULL, NULL),
(267, 'X', 2, 3444200.00, NULL, NULL),
(268, 'X', 3, 3444200.00, NULL, NULL),
(269, 'X', 4, 3552700.00, NULL, NULL),
(270, 'X', 5, 3552700.00, NULL, NULL),
(271, 'X', 6, 3664600.00, NULL, NULL),
(272, 'X', 7, 3664600.00, NULL, NULL),
(273, 'X', 8, 3780000.00, NULL, NULL),
(274, 'X', 9, 3780000.00, NULL, NULL),
(275, 'X', 10, 3899100.00, NULL, NULL),
(276, 'X', 11, 3899100.00, NULL, NULL),
(277, 'X', 12, 4021900.00, NULL, NULL),
(278, 'X', 13, 4021900.00, NULL, NULL),
(279, 'X', 14, 4148500.00, NULL, NULL),
(280, 'X', 15, 4148500.00, NULL, NULL),
(281, 'X', 16, 4279200.00, NULL, NULL),
(282, 'X', 17, 4279200.00, NULL, NULL),
(283, 'X', 18, 4414000.00, NULL, NULL),
(284, 'X', 19, 4414000.00, NULL, NULL),
(285, 'X', 20, 4553000.00, NULL, NULL),
(286, 'X', 21, 4553000.00, NULL, NULL),
(287, 'X', 22, 4696400.00, NULL, NULL),
(288, 'X', 23, 4696400.00, NULL, NULL),
(289, 'X', 24, 4844300.00, NULL, NULL),
(290, 'X', 25, 4844300.00, NULL, NULL),
(291, 'X', 26, 4996900.00, NULL, NULL),
(292, 'X', 27, 4996900.00, NULL, NULL),
(293, 'X', 28, 5154200.00, NULL, NULL),
(294, 'X', 29, 5154200.00, NULL, NULL),
(295, 'X', 30, 5316500.00, NULL, NULL),
(296, 'X', 31, 5316500.00, NULL, NULL),
(297, 'X', 32, 5484000.00, NULL, NULL),
(298, 'X', 33, 5484000.00, NULL, NULL),
(299, 'XI', 0, 3480300.00, NULL, NULL),
(300, 'XI', 1, 3480300.00, NULL, NULL),
(301, 'XI', 2, 3589900.00, NULL, NULL),
(302, 'XI', 3, 3589900.00, NULL, NULL),
(303, 'XI', 4, 3703000.00, NULL, NULL),
(304, 'XI', 5, 3703000.00, NULL, NULL),
(305, 'XI', 6, 3819600.00, NULL, NULL),
(306, 'XI', 7, 3819600.00, NULL, NULL),
(307, 'XI', 8, 3939900.00, NULL, NULL),
(308, 'XI', 9, 3939900.00, NULL, NULL),
(309, 'XI', 10, 4064000.00, NULL, NULL),
(310, 'XI', 11, 4064000.00, NULL, NULL),
(311, 'XI', 12, 4192100.00, NULL, NULL),
(312, 'XI', 13, 4192100.00, NULL, NULL),
(313, 'XI', 14, 4324000.00, NULL, NULL),
(314, 'XI', 15, 4324000.00, NULL, NULL),
(315, 'XI', 16, 4460200.00, NULL, NULL),
(316, 'XI', 17, 4460200.00, NULL, NULL),
(317, 'XI', 18, 4600700.00, NULL, NULL),
(318, 'XI', 19, 4600700.00, NULL, NULL),
(319, 'XI', 20, 4745600.00, NULL, NULL),
(320, 'XI', 21, 4745600.00, NULL, NULL),
(321, 'XI', 22, 4895000.00, NULL, NULL),
(322, 'XI', 23, 4895000.00, NULL, NULL),
(323, 'XI', 24, 5049200.00, NULL, NULL),
(324, 'XI', 25, 5049200.00, NULL, NULL),
(325, 'XI', 26, 5208200.00, NULL, NULL),
(326, 'XI', 27, 5208200.00, NULL, NULL),
(327, 'XI', 28, 5372300.00, NULL, NULL),
(328, 'XI', 29, 5372300.00, NULL, NULL),
(329, 'XI', 30, 5541500.00, NULL, NULL),
(330, 'XI', 31, 5541500.00, NULL, NULL),
(331, 'XI', 32, 5716000.00, NULL, NULL),
(332, 'XI', 33, 5716000.00, NULL, NULL),
(333, 'XII', 0, 3627500.00, NULL, NULL),
(334, 'XII', 1, 3627500.00, NULL, NULL),
(335, 'XII', 2, 3741800.00, NULL, NULL),
(336, 'XII', 3, 3741800.00, NULL, NULL),
(337, 'XII', 4, 3859600.00, NULL, NULL),
(338, 'XII', 5, 3859600.00, NULL, NULL),
(339, 'XII', 6, 3981200.00, NULL, NULL),
(340, 'XII', 7, 3981200.00, NULL, NULL),
(341, 'XII', 8, 4106600.00, NULL, NULL),
(342, 'XII', 9, 4106600.00, NULL, NULL),
(343, 'XII', 10, 4235900.00, NULL, NULL),
(344, 'XII', 11, 4235900.00, NULL, NULL),
(345, 'XII', 12, 4369300.00, NULL, NULL),
(346, 'XII', 13, 4369300.00, NULL, NULL),
(347, 'XII', 14, 4506900.00, NULL, NULL),
(348, 'XII', 15, 4506900.00, NULL, NULL),
(349, 'XII', 16, 4648900.00, NULL, NULL),
(350, 'XII', 17, 4648900.00, NULL, NULL),
(351, 'XII', 18, 4795300.00, NULL, NULL),
(352, 'XII', 19, 4795300.00, NULL, NULL),
(353, 'XII', 20, 4946300.00, NULL, NULL),
(354, 'XII', 21, 4946300.00, NULL, NULL),
(355, 'XII', 22, 5102100.00, NULL, NULL),
(356, 'XII', 23, 5102100.00, NULL, NULL),
(357, 'XII', 24, 5262800.00, NULL, NULL),
(358, 'XII', 25, 5262800.00, NULL, NULL),
(359, 'XII', 26, 5428500.00, NULL, NULL),
(360, 'XII', 27, 5428500.00, NULL, NULL),
(361, 'XII', 28, 5599500.00, NULL, NULL),
(362, 'XII', 29, 5599500.00, NULL, NULL),
(363, 'XII', 30, 5775900.00, NULL, NULL),
(364, 'XII', 31, 5775900.00, NULL, NULL),
(365, 'XII', 32, 5957800.00, NULL, NULL),
(366, 'XII', 33, 5957800.00, NULL, NULL),
(367, 'XIII', 0, 3781000.00, NULL, NULL),
(368, 'XIII', 1, 3781000.00, NULL, NULL),
(369, 'XIII', 2, 3900000.00, NULL, NULL),
(370, 'XIII', 3, 3900000.00, NULL, NULL),
(371, 'XIII', 4, 4022900.00, NULL, NULL),
(372, 'XIII', 5, 4022900.00, NULL, NULL),
(373, 'XIII', 6, 4149600.00, NULL, NULL),
(374, 'XIII', 7, 4149600.00, NULL, NULL),
(375, 'XIII', 8, 4280300.00, NULL, NULL),
(376, 'XIII', 9, 4280300.00, NULL, NULL),
(377, 'XIII', 10, 4415100.00, NULL, NULL),
(378, 'XIII', 11, 4415100.00, NULL, NULL),
(379, 'XIII', 12, 4554100.00, NULL, NULL),
(380, 'XIII', 13, 4554100.00, NULL, NULL),
(381, 'XIII', 14, 4697600.00, NULL, NULL),
(382, 'XIII', 15, 4697600.00, NULL, NULL),
(383, 'XIII', 16, 4845500.00, NULL, NULL),
(384, 'XIII', 17, 4845500.00, NULL, NULL),
(385, 'XIII', 18, 4998100.00, NULL, NULL),
(386, 'XIII', 19, 4998100.00, NULL, NULL),
(387, 'XIII', 20, 5155500.00, NULL, NULL),
(388, 'XIII', 21, 5155500.00, NULL, NULL),
(389, 'XIII', 22, 5317900.00, NULL, NULL),
(390, 'XIII', 23, 5317900.00, NULL, NULL),
(391, 'XIII', 24, 5485400.00, NULL, NULL),
(392, 'XIII', 25, 5485400.00, NULL, NULL),
(393, 'XIII', 26, 5658200.00, NULL, NULL),
(394, 'XIII', 27, 5658200.00, NULL, NULL),
(395, 'XIII', 28, 5836400.00, NULL, NULL),
(396, 'XIII', 29, 5836400.00, NULL, NULL),
(397, 'XIII', 30, 6020200.00, NULL, NULL),
(398, 'XIII', 31, 6020200.00, NULL, NULL),
(399, 'XIII', 32, 6209800.00, NULL, NULL),
(400, 'XIII', 33, 6209800.00, NULL, NULL),
(401, 'XIV', 0, 3940900.00, NULL, NULL),
(402, 'XIV', 1, 3940900.00, NULL, NULL),
(403, 'XIV', 2, 4065000.00, NULL, NULL),
(404, 'XIV', 3, 4065000.00, NULL, NULL),
(405, 'XIV', 4, 4193000.00, NULL, NULL),
(406, 'XIV', 5, 4193000.00, NULL, NULL),
(407, 'XIV', 6, 4325100.00, NULL, NULL),
(408, 'XIV', 7, 4325100.00, NULL, NULL),
(409, 'XIV', 8, 4461300.00, NULL, NULL),
(410, 'XIV', 9, 4461300.00, NULL, NULL),
(411, 'XIV', 10, 4601800.00, NULL, NULL),
(412, 'XIV', 11, 4601800.00, NULL, NULL),
(413, 'XIV', 12, 4746800.00, NULL, NULL),
(414, 'XIV', 13, 4746800.00, NULL, NULL),
(415, 'XIV', 14, 4896300.00, NULL, NULL),
(416, 'XIV', 15, 4896300.00, NULL, NULL),
(417, 'XIV', 16, 5050500.00, NULL, NULL),
(418, 'XIV', 17, 5050500.00, NULL, NULL),
(419, 'XIV', 18, 5209500.00, NULL, NULL),
(420, 'XIV', 19, 5209500.00, NULL, NULL),
(421, 'XIV', 20, 5373600.00, NULL, NULL),
(422, 'XIV', 21, 5373600.00, NULL, NULL),
(423, 'XIV', 22, 5542900.00, NULL, NULL),
(424, 'XIV', 23, 5542900.00, NULL, NULL),
(425, 'XIV', 24, 5717400.00, NULL, NULL),
(426, 'XIV', 25, 5717400.00, NULL, NULL),
(427, 'XIV', 26, 5897500.00, NULL, NULL),
(428, 'XIV', 27, 5897500.00, NULL, NULL),
(429, 'XIV', 28, 6083200.00, NULL, NULL),
(430, 'XIV', 29, 6083200.00, NULL, NULL),
(431, 'XIV', 30, 6274800.00, NULL, NULL),
(432, 'XIV', 31, 6274800.00, NULL, NULL),
(433, 'XIV', 32, 6472500.00, NULL, NULL),
(434, 'XIV', 33, 6472500.00, NULL, NULL),
(435, 'XV', 0, 4107600.00, NULL, NULL),
(436, 'XV', 1, 4107600.00, NULL, NULL),
(437, 'XV', 2, 4237000.00, NULL, NULL),
(438, 'XV', 3, 4237000.00, NULL, NULL),
(439, 'XV', 4, 4370400.00, NULL, NULL),
(440, 'XV', 5, 4370400.00, NULL, NULL),
(441, 'XV', 6, 4508100.00, NULL, NULL),
(442, 'XV', 7, 4508100.00, NULL, NULL),
(443, 'XV', 8, 4650000.00, NULL, NULL),
(444, 'XV', 9, 4650000.00, NULL, NULL),
(445, 'XV', 10, 4796500.00, NULL, NULL),
(446, 'XV', 11, 4796500.00, NULL, NULL),
(447, 'XV', 12, 4947500.00, NULL, NULL),
(448, 'XV', 13, 4947500.00, NULL, NULL),
(449, 'XV', 14, 5103400.00, NULL, NULL),
(450, 'XV', 15, 5103400.00, NULL, NULL),
(451, 'XV', 16, 5264100.00, NULL, NULL),
(452, 'XV', 17, 5264100.00, NULL, NULL),
(453, 'XV', 18, 5429900.00, NULL, NULL),
(454, 'XV', 19, 5429900.00, NULL, NULL),
(455, 'XV', 20, 5600900.00, NULL, NULL),
(456, 'XV', 21, 5600900.00, NULL, NULL),
(457, 'XV', 22, 5777300.00, NULL, NULL),
(458, 'XV', 23, 5777300.00, NULL, NULL),
(459, 'XV', 24, 5959300.00, NULL, NULL),
(460, 'XV', 25, 5959300.00, NULL, NULL),
(461, 'XV', 26, 6147000.00, NULL, NULL),
(462, 'XV', 27, 6147000.00, NULL, NULL),
(463, 'XV', 28, 6340600.00, NULL, NULL),
(464, 'XV', 29, 6340600.00, NULL, NULL),
(465, 'XV', 30, 6540300.00, NULL, NULL),
(466, 'XV', 31, 6540300.00, NULL, NULL),
(467, 'XV', 32, 6746200.00, NULL, NULL),
(468, 'XV', 33, 6746200.00, NULL, NULL),
(469, 'XVI', 0, 4281400.00, NULL, NULL),
(470, 'XVI', 1, 4281400.00, NULL, NULL),
(471, 'XVI', 2, 4416200.00, NULL, NULL),
(472, 'XVI', 3, 4416200.00, NULL, NULL),
(473, 'XVI', 4, 4555300.00, NULL, NULL),
(474, 'XVI', 5, 4555300.00, NULL, NULL),
(475, 'XVI', 6, 4698700.00, NULL, NULL),
(476, 'XVI', 7, 4698700.00, NULL, NULL),
(477, 'XVI', 8, 4846700.00, NULL, NULL),
(478, 'XVI', 9, 4846700.00, NULL, NULL),
(479, 'XVI', 10, 4999400.00, NULL, NULL),
(480, 'XVI', 11, 4999400.00, NULL, NULL),
(481, 'XVI', 12, 5156800.00, NULL, NULL),
(482, 'XVI', 13, 5156800.00, NULL, NULL),
(483, 'XVI', 14, 5319300.00, NULL, NULL),
(484, 'XVI', 15, 5319300.00, NULL, NULL),
(485, 'XVI', 16, 5486800.00, NULL, NULL),
(486, 'XVI', 17, 5486800.00, NULL, NULL),
(487, 'XVI', 18, 5659700.00, NULL, NULL),
(488, 'XVI', 19, 5659700.00, NULL, NULL),
(489, 'XVI', 20, 5837800.00, NULL, NULL),
(490, 'XVI', 21, 5837800.00, NULL, NULL),
(491, 'XVI', 22, 6021700.00, NULL, NULL),
(492, 'XVI', 23, 6021700.00, NULL, NULL),
(493, 'XVI', 24, 6211400.00, NULL, NULL),
(494, 'XVI', 25, 6211400.00, NULL, NULL),
(495, 'XVI', 26, 6407000.00, NULL, NULL),
(496, 'XVI', 27, 6407000.00, NULL, NULL),
(497, 'XVI', 28, 6608800.00, NULL, NULL),
(498, 'XVI', 29, 6608800.00, NULL, NULL),
(499, 'XVI', 30, 6816900.00, NULL, NULL),
(500, 'XVI', 31, 6816900.00, NULL, NULL),
(501, 'XVI', 32, 7031600.00, NULL, NULL),
(502, 'XVI', 33, 7031600.00, NULL, NULL),
(503, 'XVII', 0, 4462500.00, NULL, NULL),
(504, 'XVII', 1, 4462500.00, NULL, NULL),
(505, 'XVII', 2, 4603000.00, NULL, NULL),
(506, 'XVII', 3, 4603000.00, NULL, NULL),
(507, 'XVII', 4, 4748000.00, NULL, NULL),
(508, 'XVII', 5, 4748000.00, NULL, NULL),
(509, 'XVII', 6, 4897500.00, NULL, NULL),
(510, 'XVII', 7, 4897500.00, NULL, NULL),
(511, 'XVII', 8, 5051800.00, NULL, NULL),
(512, 'XVII', 9, 5051800.00, NULL, NULL),
(513, 'XVII', 10, 5210900.00, NULL, NULL),
(514, 'XVII', 11, 5210900.00, NULL, NULL),
(515, 'XVII', 12, 5375000.00, NULL, NULL),
(516, 'XVII', 13, 5375000.00, NULL, NULL),
(517, 'XVII', 14, 5544300.00, NULL, NULL),
(518, 'XVII', 15, 5544300.00, NULL, NULL),
(519, 'XVII', 16, 5718900.00, NULL, NULL),
(520, 'XVII', 17, 5718900.00, NULL, NULL),
(521, 'XVII', 18, 5899000.00, NULL, NULL),
(522, 'XVII', 19, 5899000.00, NULL, NULL),
(523, 'XVII', 20, 6084800.00, NULL, NULL),
(524, 'XVII', 21, 6084800.00, NULL, NULL),
(525, 'XVII', 22, 6276400.00, NULL, NULL),
(526, 'XVII', 23, 6276400.00, NULL, NULL),
(527, 'XVII', 24, 6474000.00, NULL, NULL),
(528, 'XVII', 25, 6474000.00, NULL, NULL),
(529, 'XVII', 26, 6678000.00, NULL, NULL),
(530, 'XVII', 27, 6678000.00, NULL, NULL),
(531, 'XVII', 28, 6888300.00, NULL, NULL),
(532, 'XVII', 29, 6888300.00, NULL, NULL),
(533, 'XVII', 30, 7105300.00, NULL, NULL),
(534, 'XVII', 31, 7105300.00, NULL, NULL),
(535, 'XVII', 32, 7329000.00, NULL, NULL),
(536, 'XVII', 33, 7329000.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ref_jabatan`
--

CREATE TABLE `ref_jabatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_jabatan` varchar(255) NOT NULL,
  `jenis_jabatan` enum('struktural','fungsional','pelaksana') NOT NULL,
  `ref_kelas_jabatan_id` bigint(20) UNSIGNED NOT NULL,
  `tunjangan_resmi` decimal(15,2) DEFAULT NULL,
  `tpp_pns` decimal(15,2) DEFAULT 0.00,
  `tpp_penyetaraan` decimal(15,2) DEFAULT NULL,
  `tpp_pppk` decimal(15,2) NOT NULL DEFAULT 250000.00,
  `tpp_cpns` decimal(15,2) NOT NULL DEFAULT 250000.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ref_jabatan`
--

INSERT INTO `ref_jabatan` (`id`, `nama_jabatan`, `jenis_jabatan`, `ref_kelas_jabatan_id`, `tunjangan_resmi`, `tpp_pns`, `tpp_penyetaraan`, `tpp_pppk`, `tpp_cpns`, `created_at`, `updated_at`) VALUES
(1, 'Kepala Dinas', 'struktural', 14, 2025000.00, 0.00, NULL, 250000.00, 250000.00, '2026-09-15 21:21:13', '2026-09-21 20:56:30'),
(3, 'Kasubbag Umum dan Kepegawaian', 'struktural', 9, 540000.00, 0.00, NULL, 250000.00, 250000.00, '2026-09-15 21:21:13', '2026-09-21 20:56:56'),
(4, 'JF Penata Kelola Penanaman Modal Ahli Madya', 'fungsional', 12, 980000.00, 0.00, 5881004.00, 0.00, 0.00, '2026-09-15 21:21:13', '2026-09-22 21:51:26'),
(5, 'JF Penata Kelola Penanaman Modal Ahli Muda', 'fungsional', 9, 0.00, 2528387.00, NULL, 250000.00, 250000.00, '2026-09-15 21:21:13', '2026-09-20 20:59:03'),
(6, 'JF Penata Kelola Penanaman Modal Ahli Pertama', 'fungsional', 8, 0.00, 0.00, NULL, 250383.00, 250000.00, '2026-09-15 21:21:13', '2026-09-22 23:54:32'),
(7, 'JF Penata Perizinan Ahli Madya', 'fungsional', 12, 980000.00, 0.00, 7464950.00, 0.00, 0.00, '2026-09-15 21:21:13', '2026-09-21 20:56:43'),
(8, 'JF Penata Perizinan Ahli Muda', 'fungsional', 10, 0.00, 2528387.00, NULL, 250000.00, 250000.00, '2026-09-15 21:21:13', '2026-09-22 21:13:30'),
(9, 'JF Penata Perizinan Ahli Pertama', 'fungsional', 8, 0.00, 0.00, NULL, 250000.00, 250383.00, '2026-09-15 21:21:13', '2026-09-22 23:58:43'),
(10, 'JF Pranata Komputer Ahli Muda', 'fungsional', 9, 0.00, 0.00, NULL, 250000.00, 250000.00, '2026-09-15 21:21:13', '2026-09-15 21:21:13'),
(11, 'JF Pranata Komputer Ahli Pertama', 'fungsional', 8, 540000.00, 0.00, NULL, 250000.00, 250000.00, '2026-09-15 21:21:13', '2026-09-21 20:57:05'),
(12, 'JF Pranata Komputer Penyelia', 'fungsional', 8, 0.00, 0.00, NULL, 250000.00, 250000.00, '2026-09-15 21:21:13', '2026-09-15 21:21:13'),
(13, 'JF Pranata Komputer Pelaksana Lanjutan', 'fungsional', 7, 0.00, 0.00, NULL, 250000.00, 250000.00, '2026-09-15 21:21:13', '2026-09-15 21:21:13'),
(14, 'JF Pranata Komputer Pelaksana', 'fungsional', 6, 360000.00, 0.00, NULL, 249951.00, 250000.00, '2026-09-15 21:21:13', '2026-09-22 23:54:57'),
(15, 'Penelaah Teknis Kebijakan', 'pelaksana', 7, 0.00, 0.00, NULL, 250000.00, 250000.00, '2026-09-15 21:21:13', '2026-09-15 21:21:13'),
(16, 'Pengolah Data dan Informasi', 'pelaksana', 6, 0.00, 0.00, NULL, 250000.00, 250000.00, '2026-09-15 21:21:13', '2026-09-15 21:21:13'),
(17, 'Pengadministrasi Perkantoran', 'pelaksana', 5, 0.00, 0.00, NULL, 250000.00, 250000.00, '2026-09-15 21:21:13', '2026-09-15 21:21:13'),
(25, 'Sekretaris', 'struktural', 12, 1260000.00, 0.00, NULL, 250000.00, 250000.00, '2026-09-20 19:14:12', '2026-09-21 20:43:17'),
(31, 'Penata Layanan Operasional', 'pelaksana', 7, 0.00, 0.00, NULL, 250000.00, 250000.00, '2026-09-20 22:57:37', '2026-09-20 22:57:37'),
(32, 'Pengelola Layanan Operasional', 'pelaksana', 6, 0.00, 0.00, NULL, 250000.00, 250000.00, '2026-09-21 23:47:46', '2026-09-21 23:47:46'),
(33, 'Operator Layanan Operasional', 'pelaksana', 5, 0.00, 0.00, NULL, 250000.00, 250000.00, '2026-09-21 23:48:11', '2026-09-21 23:48:11'),
(34, 'Pengelola Umum Operasional', 'pelaksana', 4, 0.00, 0.00, NULL, 250000.00, 250000.00, '2026-09-21 23:48:31', '2026-09-21 23:48:31'),
(35, 'Calon Penata Perizinan Ahli Pertama', 'pelaksana', 7, 0.00, 0.00, NULL, 250000.00, 250000.00, '2026-09-22 21:47:59', '2026-09-22 21:47:59');

-- --------------------------------------------------------

--
-- Table structure for table `ref_kelas_jabatan`
--

CREATE TABLE `ref_kelas_jabatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelas` int(11) NOT NULL,
  `nama_kelas` varchar(255) DEFAULT NULL,
  `basic_tpp` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ref_kelas_jabatan`
--

INSERT INTO `ref_kelas_jabatan` (`id`, `kelas`, `nama_kelas`, `basic_tpp`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kelas 1', 1250000.00, '2026-09-15 21:21:13', '2026-09-15 21:21:13'),
(2, 2, 'Kelas 2', 1500000.00, '2026-09-15 21:21:13', '2026-09-15 21:21:13'),
(3, 3, 'Kelas 3', 1750000.00, '2026-09-15 21:21:13', '2026-09-15 21:21:13'),
(4, 4, 'Kelas 4', 2000000.00, '2026-09-15 21:21:13', '2026-09-15 21:21:13'),
(5, 5, 'Kelas 5', 1809207.00, '2026-09-15 21:21:13', '2026-09-20 20:32:02'),
(6, 6, 'Kelas 6', 1968101.00, '2026-09-15 21:21:13', '2026-09-20 20:31:44'),
(7, 7, 'Kelas 7', 2128253.00, '2026-09-15 21:21:13', '2026-09-23 00:08:28'),
(8, 8, 'Kelas 8', 2274918.00, '2026-09-15 21:21:13', '2026-09-20 20:31:06'),
(9, 9, 'Kelas 9', 3537596.00, '2026-09-15 21:21:13', '2026-09-22 22:08:12'),
(10, 10, 'Kelas 10', 2527022.00, '2026-09-15 21:21:13', '2026-09-20 20:30:01'),
(11, 11, 'Kelas 11', 3750000.00, '2026-09-15 21:21:13', '2026-09-15 21:21:13'),
(12, 12, 'Kelas 12', 7464950.00, '2026-09-15 21:21:13', '2026-09-20 20:29:39'),
(13, 13, 'Kelas 13', 4250000.00, '2026-09-15 21:21:13', '2026-09-15 21:21:13'),
(14, 14, 'Kelas 14', 10001137.00, '2026-09-15 21:21:13', '2026-09-20 20:28:57'),
(15, 15, 'Kelas 15', 4750000.00, '2026-09-15 21:21:13', '2026-09-15 21:21:13');

-- --------------------------------------------------------

--
-- Table structure for table `ref_tunjangan_umum`
--

CREATE TABLE `ref_tunjangan_umum` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tingkat_golongan` enum('I','II','III','IV') NOT NULL,
  `nominal` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('NTkE2mjmL6zhTAVRbGj4JO8NmchkJrmnhp956iBu', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid1FOQnZVOFdrZHNKSDVqbDJYYjJkRUdCajFuMVR4YXp0c0pnZkVJZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9hcHBnYWppLXB0c3AvZ2FqaS10YW1iYWhhbi1wbnMiO3M6NToicm91dGUiO3M6MjM6ImdhamktdGFtYmFoYW4tcG5zLmluZGV4Ijt9fQ==', 1790217261);

-- --------------------------------------------------------

--
-- Table structure for table `tpp`
--

CREATE TABLE `tpp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `kelas_jabatan` varchar(255) DEFAULT NULL,
  `golongan` varchar(255) DEFAULT NULL,
  `status_kepegawaian` varchar(255) DEFAULT NULL,
  `kondisi_khusus` varchar(255) NOT NULL DEFAULT 'Normal',
  `persen_tpp_diterima` decimal(5,2) NOT NULL DEFAULT 100.00,
  `basic_tpp` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tpp_efektif` decimal(15,2) NOT NULL DEFAULT 0.00,
  `beban_kerja` decimal(15,2) NOT NULL DEFAULT 0.00,
  `prestasi_kerja` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tpp_presensi` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tpp_kinerja` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tpp_seksama` decimal(15,2) NOT NULL DEFAULT 0.00,
  `persen_potongan_presensi` decimal(5,2) NOT NULL DEFAULT 0.00,
  `persen_potongan_kinerja` decimal(5,2) NOT NULL DEFAULT 0.00,
  `persen_potongan_seksama` decimal(5,2) NOT NULL DEFAULT 0.00,
  `nominal_potongan_presensi` decimal(15,2) NOT NULL DEFAULT 0.00,
  `nominal_potongan_kinerja` decimal(15,2) NOT NULL DEFAULT 0.00,
  `nominal_potongan_seksama` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_potongan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tpp_kotor` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tarif_pajak` decimal(5,2) NOT NULL DEFAULT 0.00,
  `potongan_pajak` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tpp_bersih` decimal(15,2) NOT NULL DEFAULT 0.00,
  `gaji_induk_bpjs` decimal(15,2) NOT NULL DEFAULT 0.00,
  `potongan_bpjs` decimal(15,2) NOT NULL DEFAULT 0.00,
  `diterimakan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `is_locked` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tpp`
--

INSERT INTO `tpp` (`id`, `bulan`, `tahun`, `pegawai_id`, `nip`, `nama`, `nik`, `jabatan`, `kelas_jabatan`, `golongan`, `status_kepegawaian`, `kondisi_khusus`, `persen_tpp_diterima`, `basic_tpp`, `tpp_efektif`, `beban_kerja`, `prestasi_kerja`, `tpp_presensi`, `tpp_kinerja`, `tpp_seksama`, `persen_potongan_presensi`, `persen_potongan_kinerja`, `persen_potongan_seksama`, `nominal_potongan_presensi`, `nominal_potongan_kinerja`, `nominal_potongan_seksama`, `total_potongan`, `tpp_kotor`, `tarif_pajak`, `potongan_pajak`, `tpp_bersih`, `gaji_induk_bpjs`, `potongan_bpjs`, `diterimakan`, `is_locked`, `created_at`, `updated_at`) VALUES
(573, '01', '2026', 24, '197006161989031001', 'Ade Suangkat, S.E', '3326131606700005', 'Kepala Dinas', '14', 'IV/b', 'pns', 'Normal', 100.00, 10001137.00, 10001137.00, 4000454.00, 6000683.00, 1800204.00, 3000341.00, 1200138.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10001137.00, 15.00, 1500171.00, 8500966.00, 4000000.00, 48154.00, 8452812.00, 1, '2026-09-23 01:05:13', '2026-09-23 01:36:13'),
(575, '01', '2026', 3, '197311171999031006', 'Harry Rudiyanto, S.Kom, M.M', '3375011711730010', 'JF Penata Kelola Penanaman Modal Ahli Madya', '12', 'IV/b', 'pns', 'Normal', 100.00, 5881004.00, 5881004.00, 2352401.00, 3528603.00, 1058580.00, 1764301.00, 705722.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 5881004.00, 15.00, 882151.00, 4998853.00, 6647738.00, 53523.00, 4945330.00, 1, '2026-09-23 01:05:13', '2026-09-23 01:36:13'),
(576, '01', '2026', 9, '198409272003121001', 'Sukirno, S.STP, M.M', '3375012709840006', 'Sekretaris', '12', 'IV/b', 'pns', 'Normal', 100.00, 7464950.00, 7464950.00, 2985980.00, 4478970.00, 1343691.00, 2239485.00, 895794.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 7464950.00, 15.00, 1119743.00, 6345207.00, 6424314.00, 55757.00, 6289450.00, 1, '2026-09-23 01:05:13', '2026-09-23 01:36:13'),
(577, '01', '2026', 4, '197406072007011008', 'Purnomo, S.H.', '3326160706740001', 'JF Penata Perizinan Ahli Muda', '10', 'III/c', 'pns', 'Normal', 100.00, 2528387.00, 2528387.00, 1011354.00, 1517033.00, 455109.00, 758516.00, 303408.00, 4.00, 0.00, 0.00, 18204.00, 0.00, 0.00, 18204.00, 2510183.00, 5.00, 125509.00, 2384674.00, 5072368.00, 25284.00, 2359390.00, 1, '2026-09-23 01:05:13', '2026-09-23 01:36:13'),
(578, '01', '2026', 8, '198102232009021003', 'Muhammad Muzni Kharis, A.Md', '3328112302810004', 'Kasubbag Umum dan Kepegawaian', '9', 'III/c', 'pns', 'Normal', 100.00, 3537596.00, 3537596.00, 1415038.00, 2122558.00, 636767.00, 1061278.00, 424513.00, 0.30, 0.00, 0.00, 1910.00, 0.00, 0.00, 1910.00, 3535686.00, 5.00, 176784.00, 3358902.00, 4751312.00, 35376.00, 3323526.00, 1, '2026-09-23 01:05:13', '2026-09-23 01:36:13'),
(579, '01', '2026', 21, '199305262025211041', 'Achmad Adi Kusuma, S.Kom', '3327052605930002', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'IX', 'pppk', 'Normal', 100.00, 250383.00, 250383.00, 100153.00, 150230.00, 45068.00, 75114.00, 30048.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 250383.00, 5.00, 12519.00, 237864.00, 3773032.00, 2504.00, 235360.00, 1, '2026-09-23 01:05:13', '2026-09-23 01:36:13'),
(580, '01', '2026', 13, '199102052022031003', 'Ahmad Rozi, S.E.', '3326140502910001', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'III/a', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2274918.00, 5.00, 113746.00, 2161172.00, 3403320.00, 22749.00, 2138423.00, 1, '2026-09-23 01:05:13', '2026-09-23 01:36:13'),
(581, '01', '2026', 18, '199610212025042002', 'Aqilatul Ulya, S.E', '3375026110960003', 'JF Penata Perizinan Ahli Pertama', '8', 'III/a', 'cpns', 'Normal', 100.00, 250383.00, 250383.00, 100153.00, 150230.00, 45068.00, 75114.00, 30048.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 250383.00, 5.00, 12519.00, 237864.00, 2413560.00, 2504.00, 235360.00, 1, '2026-09-23 01:05:13', '2026-09-23 01:36:13'),
(582, '01', '2026', 20, '199801092022031007', 'Didik Yogo Suro Prasojo, S.Kom', '3326070901980001', 'JF Pranata Komputer Ahli Pertama', '8', 'III/b', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 0.90, 0.00, 0.00, 3685.00, 0.00, 0.00, 3685.00, 2271233.00, 5.00, 113562.00, 2157671.00, 3700850.00, 22749.00, 2134922.00, 1, '2026-09-23 01:05:13', '2026-09-23 01:36:13'),
(583, '01', '2026', 14, '199210012020122013', 'Millatina Hanifah, S.E.Sy.', '3375024110920001', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'III/b', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 2.70, 0.00, 0.00, 11056.00, 0.00, 0.00, 11056.00, 2263862.00, 5.00, 113193.00, 2150669.00, 3706802.00, 22749.00, 2127920.00, 1, '2026-09-23 01:05:13', '2026-09-23 01:36:13'),
(584, '01', '2026', 22, '199605222025211019', 'Muhammad Ilham Insani, S.Kom', '3326132205960005', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'IX', 'pppk', 'Normal', 100.00, 250383.00, 250383.00, 100153.00, 150230.00, 45068.00, 75114.00, 30048.00, 1.20, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 250383.00, 5.00, 12519.00, 237864.00, 3708960.00, 2504.00, 235360.00, 1, '2026-09-23 01:05:13', '2026-09-23 01:36:13'),
(585, '01', '2026', 19, '199611152020122016', 'Nadya Ayu Popi Haluansa, S.E', '3327115511960001', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'III/b', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 1.50, 0.00, 0.00, 6142.00, 0.00, 0.00, 6142.00, 2268776.00, 5.00, 113439.00, 2155337.00, 3706802.00, 22749.00, 2132588.00, 1, '2026-09-23 01:05:13', '2026-09-23 01:36:13'),
(586, '01', '2026', 12, '198910192020122011', 'Istikomah, S.E.', '3325025910890002', 'Penelaah Teknis Kebijakan', '7', 'III/b', 'pns', 'Normal', 100.00, 2128253.00, 2128253.00, 851301.00, 1276952.00, 383085.00, 638475.00, 255392.00, 0.60, 0.00, 0.00, 2299.00, 0.00, 0.00, 2299.00, 2125954.00, 5.00, 106298.00, 2019656.00, 3274300.00, 21283.00, 1998373.00, 1, '2026-09-23 01:05:13', '2026-09-23 01:36:13'),
(587, '01', '2026', 7, '198102232006042012', 'Riski Tessa Malela, S.E., MA', '3325116302810004', 'Penelaah Teknis Kebijakan', '7', 'IV/b', 'pns', 'Mutasi Masuk Pemda Lain', 50.00, 2128253.00, 1064127.00, 425650.00, 638477.00, 191542.00, 319238.00, 127697.00, 0.60, 0.00, 0.00, 1149.00, 0.00, 0.00, 1149.00, 1062978.00, 15.00, 159447.00, 903531.00, 5684686.00, 10641.00, 892890.00, 1, '2026-09-23 01:05:13', '2026-09-23 01:36:13'),
(588, '01', '2026', 11, '198901092022031007', 'Yanuar Albab Baihaqi, S.E.Sy', '3326130901890001', 'Penelaah Teknis Kebijakan', '7', 'III/b', 'pns', 'Normal', 100.00, 2128253.00, 2128253.00, 851301.00, 1276952.00, 383085.00, 638475.00, 255392.00, 0.60, 0.00, 0.00, 2299.00, 0.00, 0.00, 2299.00, 2125954.00, 5.00, 106298.00, 2019656.00, 3058500.00, 21283.00, 1998373.00, 1, '2026-09-23 01:05:13', '2026-09-23 01:36:13'),
(589, '01', '2026', 23, '199610092024211003', 'Fajariawan Prabowo, A.Md.Kom', '3327080910960002', 'JF Pranata Komputer Pelaksana', '6', 'VII', 'pppk', 'Normal', 100.00, 249951.00, 249951.00, 99980.00, 149971.00, 44991.00, 74985.00, 29995.00, 2.70, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 249951.00, 0.00, 0.00, 249951.00, 3619032.00, 2500.00, 247451.00, 1, '2026-09-23 01:05:13', '2026-09-23 01:36:13'),
(590, '01', '2026', 16, '199608132022032018', 'Noor Falaisifa, A.Md', '3326135308960001', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.30, 0.00, 0.00, 1063.00, 0.00, 0.00, 1063.00, 1967038.00, 0.00, 0.00, 1967038.00, 2744200.00, 19681.00, 1947357.00, 1, '2026-09-23 01:05:13', '2026-09-23 01:36:13'),
(591, '01', '2026', 17, '199609172022032021', 'Nur Hanifah, A.Md', '3303115709960003', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1968101.00, 0.00, 0.00, 1968101.00, 3051904.00, 19681.00, 1948420.00, 1, '2026-09-23 01:05:13', '2026-09-23 01:36:13'),
(592, '01', '2026', 10, '198612162020122008', 'Ratih Prasastianila Muna, A.Md', '3325115612860002', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 1.20, 0.00, 0.00, 4251.00, 0.00, 0.00, 4251.00, 1963850.00, 0.00, 0.00, 1963850.00, 3322752.00, 19681.00, 1944169.00, 1, '2026-09-23 01:05:13', '2026-09-23 01:36:13'),
(593, '01', '2026', 15, '199401252022032008', 'Wulan Suryani, A.Md.Kom', '3204286501940002', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.30, 0.00, 0.00, 1063.00, 0.00, 0.00, 1063.00, 1967038.00, 0.00, 0.00, 1967038.00, 3051904.00, 19681.00, 1947357.00, 1, '2026-09-23 01:05:13', '2026-09-23 01:36:13'),
(594, '01', '2026', 5, '197407041997031004', 'Abdullah Yulianto', '3375030407740005', 'Pengadministrasi Perkantoran', '5', 'III/b', 'pns', 'Normal', 100.00, 1809207.00, 1809207.00, 723682.00, 1085525.00, 325657.00, 542762.00, 217106.00, 1.10, 0.00, 0.00, 3582.00, 0.00, 0.00, 3582.00, 1805625.00, 5.00, 90281.00, 1715344.00, 4840646.00, 18092.00, 1697252.00, 1, '2026-09-23 01:05:13', '2026-09-23 01:36:13'),
(595, '01', '2026', 6, '197408122014062001', 'Vitta Adi Rosewaty Jengkar', '3375035208740005', 'Pengadministrasi Perkantoran', '5', 'II/c', 'pns', 'Normal', 100.00, 1809207.00, 1809207.00, 723682.00, 1085525.00, 325657.00, 542762.00, 217106.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1809207.00, 0.00, 0.00, 1809207.00, 4147150.00, 18092.00, 1791115.00, 1, '2026-09-23 01:05:13', '2026-09-23 01:36:13'),
(702, '02', '2026', 24, '197006161989031001', 'Ade Suangkat, S.E', '3326131606700005', 'Kepala Dinas', '14', 'IV/b', 'pns', 'Normal', 100.00, 10001137.00, 10001137.00, 4000454.00, 6000683.00, 1800204.00, 3000341.00, 1200138.00, 0.30, 0.00, 0.00, 5401.00, 0.00, 0.00, 5401.00, 9995736.00, 15.00, 1499360.00, 8496376.00, 7949576.00, 40504.00, 8455872.00, 1, '2026-09-23 01:49:01', '2026-09-23 17:37:15'),
(703, '02', '2026', 3, '197311171999031006', 'Harry Rudiyanto, S.Kom, M.M', '3375011711730010', 'JF Penata Kelola Penanaman Modal Ahli Madya', '12', 'IV/b', 'pns', 'Normal', 100.00, 5881004.00, 5881004.00, 2352401.00, 3528603.00, 1058580.00, 1764301.00, 705722.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 5881004.00, 15.00, 882151.00, 4998853.00, 6647738.00, 53523.00, 4945330.00, 1, '2026-09-23 01:49:01', '2026-09-23 17:37:15'),
(704, '02', '2026', 9, '198409272003121001', 'Sukirno, S.STP, M.M', '3375012709840006', 'Sekretaris', '12', 'IV/b', 'pns', 'Normal', 100.00, 7464950.00, 7464950.00, 2985980.00, 4478970.00, 1343691.00, 2239485.00, 895794.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 7464950.00, 15.00, 1119743.00, 6345207.00, 6424314.00, 55757.00, 6289450.00, 1, '2026-09-23 01:49:01', '2026-09-23 17:37:15'),
(705, '02', '2026', 4, '197406072007011008', 'Purnomo, S.H.', '3326160706740001', 'JF Penata Perizinan Ahli Muda', '10', 'III/c', 'pns', 'Normal', 100.00, 2528387.00, 2528387.00, 1011354.00, 1517033.00, 455109.00, 758516.00, 303408.00, 2.30, 0.00, 0.00, 10468.00, 0.00, 0.00, 10468.00, 2517919.00, 5.00, 125896.00, 2392023.00, 5257368.00, 25284.00, 2366739.00, 1, '2026-09-23 01:49:01', '2026-09-23 17:37:15'),
(706, '02', '2026', 8, '198102232009021003', 'Muhammad Muzni Kharis, A.Md', '3328112302810004', 'Kasubbag Umum dan Kepegawaian', '9', 'III/c', 'pns', 'Normal', 100.00, 3537596.00, 3537596.00, 1415038.00, 2122558.00, 636767.00, 1061278.00, 424513.00, 0.90, 0.00, 0.00, 5731.00, 0.00, 0.00, 5731.00, 3531865.00, 5.00, 176593.00, 3355272.00, 4751312.00, 35376.00, 3319896.00, 1, '2026-09-23 01:49:01', '2026-09-23 17:37:15'),
(707, '02', '2026', 21, '199305262025211041', 'Achmad Adi Kusuma, S.Kom', '3327052605930002', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'IX', 'pppk', 'Normal', 100.00, 250383.00, 250383.00, 100153.00, 150230.00, 45068.00, 75114.00, 30048.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 250383.00, 5.00, 12519.00, 237864.00, 3773032.00, 2504.00, 235360.00, 1, '2026-09-23 01:49:01', '2026-09-23 17:37:15'),
(708, '02', '2026', 13, '199102052022031003', 'Ahmad Rozi, S.E.', '3326140502910001', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'III/a', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2274918.00, 5.00, 113746.00, 2161172.00, 3403320.00, 22749.00, 2138423.00, 1, '2026-09-23 01:49:01', '2026-09-23 17:37:15'),
(709, '02', '2026', 18, '199610212025042002', 'Aqilatul Ulya, S.E', '3375026110960003', 'JF Penata Perizinan Ahli Pertama', '8', 'III/a', 'cpns', 'Normal', 100.00, 250383.00, 250383.00, 100153.00, 150230.00, 45068.00, 75114.00, 30048.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 250383.00, 5.00, 12519.00, 237864.00, 2413560.00, 2504.00, 235360.00, 1, '2026-09-23 01:49:01', '2026-09-23 17:37:15'),
(710, '02', '2026', 20, '199801092022031007', 'Didik Yogo Suro Prasojo, S.Kom', '3326070901980001', 'JF Pranata Komputer Ahli Pertama', '8', 'III/b', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 0.30, 0.00, 0.00, 1228.00, 0.00, 0.00, 1228.00, 2273690.00, 5.00, 113685.00, 2160005.00, 3700850.00, 22749.00, 2137256.00, 1, '2026-09-23 01:49:01', '2026-09-23 17:37:15'),
(711, '02', '2026', 14, '199210012020122013', 'Millatina Hanifah, S.E.Sy.', '3375024110920001', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'III/b', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 1.50, 0.00, 0.00, 6142.00, 0.00, 0.00, 6142.00, 2268776.00, 5.00, 113439.00, 2155337.00, 3706802.00, 22749.00, 2132588.00, 1, '2026-09-23 01:49:01', '2026-09-23 17:37:15'),
(712, '02', '2026', 22, '199605222025211019', 'Muhammad Ilham Insani, S.Kom', '3326132205960005', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'IX', 'pppk', 'Normal', 100.00, 250383.00, 250383.00, 100153.00, 150230.00, 45068.00, 75114.00, 30048.00, 0.90, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 250383.00, 5.00, 12519.00, 237864.00, 3708960.00, 2504.00, 235360.00, 1, '2026-09-23 01:49:01', '2026-09-23 17:37:15'),
(713, '02', '2026', 19, '199611152020122016', 'Nadya Ayu Popi Haluansa, S.E', '3327115511960001', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'III/b', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 7.80, 0.00, 0.00, 31940.00, 0.00, 0.00, 31940.00, 2242978.00, 5.00, 112149.00, 2130829.00, 3706802.00, 22749.00, 2108080.00, 1, '2026-09-23 01:49:01', '2026-09-23 17:37:15'),
(714, '02', '2026', 12, '198910192020122011', 'Istikomah, S.E.', '3325025910890002', 'Penelaah Teknis Kebijakan', '7', 'III/b', 'pns', 'Normal', 100.00, 2128253.00, 2128253.00, 851301.00, 1276952.00, 383085.00, 638475.00, 255392.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2128253.00, 5.00, 106413.00, 2021840.00, 3274300.00, 21283.00, 2000557.00, 1, '2026-09-23 01:49:01', '2026-09-23 17:37:15'),
(715, '02', '2026', 7, '198102232006042012', 'Riski Tessa Malela, S.E., MA', '3325116302810004', 'Penelaah Teknis Kebijakan', '7', 'IV/b', 'pns', 'Mutasi Masuk Pemda Lain', 50.00, 2128253.00, 1064127.00, 425650.00, 638477.00, 191542.00, 319238.00, 127697.00, 3.30, 0.00, 0.00, 6321.00, 0.00, 0.00, 6321.00, 1057806.00, 15.00, 158671.00, 899135.00, 5684686.00, 10641.00, 888494.00, 1, '2026-09-23 01:49:01', '2026-09-23 17:37:15'),
(716, '02', '2026', 11, '198901092022031007', 'Yanuar Albab Baihaqi, S.E.Sy', '3326130901890001', 'Penelaah Teknis Kebijakan', '7', 'III/b', 'pns', 'Normal', 100.00, 2128253.00, 2128253.00, 851301.00, 1276952.00, 383085.00, 638475.00, 255392.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2128253.00, 5.00, 106413.00, 2021840.00, 3058500.00, 21283.00, 2000557.00, 1, '2026-09-23 01:49:01', '2026-09-23 17:37:15'),
(717, '02', '2026', 23, '199610092024211003', 'Fajariawan Prabowo, A.Md.Kom', '3327080910960002', 'JF Pranata Komputer Pelaksana', '6', 'VII', 'pppk', 'Normal', 100.00, 249951.00, 249951.00, 99980.00, 149971.00, 44991.00, 74985.00, 29995.00, 2.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 249951.00, 0.00, 0.00, 249951.00, 3619032.00, 2500.00, 247451.00, 1, '2026-09-23 01:49:01', '2026-09-23 17:37:15'),
(718, '02', '2026', 16, '199608132022032018', 'Noor Falaisifa, A.Md', '3326135308960001', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1968101.00, 0.00, 0.00, 1968101.00, 2744200.00, 19681.00, 1948420.00, 1, '2026-09-23 01:49:01', '2026-09-23 17:37:15'),
(719, '02', '2026', 17, '199609172022032021', 'Nur Hanifah, A.Md', '3303115709960003', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1968101.00, 0.00, 0.00, 1968101.00, 3051904.00, 19681.00, 1948420.00, 1, '2026-09-23 01:49:01', '2026-09-23 17:37:15'),
(720, '02', '2026', 10, '198612162020122008', 'Ratih Prasastianila Muna, A.Md', '3325115612860002', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 1.00, 0.00, 0.00, 3543.00, 0.00, 0.00, 3543.00, 1964558.00, 0.00, 0.00, 1964558.00, 3322752.00, 19681.00, 1944877.00, 1, '2026-09-23 01:49:01', '2026-09-23 17:37:15'),
(721, '02', '2026', 15, '199401252022032008', 'Wulan Suryani, A.Md.Kom', '3204286501940002', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1968101.00, 0.00, 0.00, 1968101.00, 3051904.00, 19681.00, 1948420.00, 1, '2026-09-23 01:49:01', '2026-09-23 17:37:15'),
(722, '02', '2026', 6, '197408122014062001', 'Vitta Adi Rosewaty Jengkar', '3375035208740005', 'Pengadministrasi Perkantoran', '5', 'II/c', 'pns', 'Normal', 100.00, 1809207.00, 1809207.00, 723682.00, 1085525.00, 325657.00, 542762.00, 217106.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1809207.00, 0.00, 0.00, 1809207.00, 4147150.00, 18092.00, 1791115.00, 1, '2026-09-23 01:49:01', '2026-09-23 17:37:15'),
(723, '03', '2026', 24, '197006161989031001', 'Ade Suangkat, S.E', '3326131606700005', 'Kepala Dinas', '14', 'IV/b', 'pns', 'Normal', 100.00, 10001137.00, 10001137.00, 4000454.00, 6000683.00, 1800204.00, 3000341.00, 1200138.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10001137.00, 15.00, 1500171.00, 8500966.00, 7949576.00, 40504.00, 8460462.00, 1, '2026-09-23 17:37:26', '2026-09-23 17:40:48'),
(724, '03', '2026', 3, '197311171999031006', 'Harry Rudiyanto, S.Kom, M.M', '3375011711730010', 'JF Penata Kelola Penanaman Modal Ahli Madya', '12', 'IV/b', 'pns', 'Normal', 100.00, 5881004.00, 5881004.00, 2352401.00, 3528603.00, 1058580.00, 1764301.00, 705722.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 5881004.00, 15.00, 882151.00, 4998853.00, 6647738.00, 53523.00, 4945330.00, 1, '2026-09-23 17:37:26', '2026-09-23 17:40:48'),
(725, '03', '2026', 9, '198409272003121001', 'Sukirno, S.STP, M.M', '3375012709840006', 'Sekretaris', '12', 'IV/b', 'pns', 'Normal', 100.00, 7464950.00, 7464950.00, 2985980.00, 4478970.00, 1343691.00, 2239485.00, 895794.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 7464950.00, 15.00, 1119743.00, 6345207.00, 6424314.00, 55757.00, 6289450.00, 1, '2026-09-23 17:37:26', '2026-09-23 17:40:48'),
(726, '03', '2026', 4, '197406072007011008', 'Purnomo, S.H.', '3326160706740001', 'JF Penata Perizinan Ahli Muda', '10', 'III/c', 'pns', 'Normal', 100.00, 2528387.00, 2528387.00, 1011354.00, 1517033.00, 455109.00, 758516.00, 303408.00, 3.70, 0.00, 0.00, 16839.00, 0.00, 0.00, 16839.00, 2511548.00, 5.00, 125577.00, 2385971.00, 5257368.00, 25284.00, 2360687.00, 1, '2026-09-23 17:37:26', '2026-09-23 17:40:48'),
(727, '03', '2026', 8, '198102232009021003', 'Muhammad Muzni Kharis, A.Md', '3328112302810004', 'Kasubbag Umum dan Kepegawaian', '9', 'III/c', 'pns', 'Normal', 100.00, 3537596.00, 3537596.00, 1415038.00, 2122558.00, 636767.00, 1061278.00, 424513.00, 0.30, 0.00, 0.00, 1910.00, 0.00, 0.00, 1910.00, 3535686.00, 5.00, 176784.00, 3358902.00, 4751312.00, 35376.00, 3323526.00, 1, '2026-09-23 17:37:26', '2026-09-23 17:40:48'),
(728, '03', '2026', 21, '199305262025211041', 'Achmad Adi Kusuma, S.Kom', '3327052605930002', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'IX', 'pppk', 'Normal', 100.00, 250383.00, 250383.00, 100153.00, 150230.00, 45068.00, 75114.00, 30048.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 250383.00, 5.00, 12519.00, 237864.00, 3773032.00, 2504.00, 235360.00, 1, '2026-09-23 17:37:26', '2026-09-23 17:40:48'),
(729, '03', '2026', 13, '199102052022031003', 'Ahmad Rozi, S.E.', '3326140502910001', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'III/a', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2274918.00, 5.00, 113746.00, 2161172.00, 3504680.00, 22749.00, 2138423.00, 1, '2026-09-23 17:37:26', '2026-09-23 17:40:48'),
(730, '03', '2026', 18, '199610212025042002', 'Aqilatul Ulya, S.E', '3375026110960003', 'JF Penata Perizinan Ahli Pertama', '8', 'III/a', 'cpns', 'Normal', 100.00, 250383.00, 250383.00, 100153.00, 150230.00, 45068.00, 75114.00, 30048.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 250383.00, 5.00, 12519.00, 237864.00, 2413560.00, 2504.00, 235360.00, 1, '2026-09-23 17:37:26', '2026-09-23 17:40:48'),
(731, '03', '2026', 20, '199801092022031007', 'Didik Yogo Suro Prasojo, S.Kom', '3326070901980001', 'JF Pranata Komputer Ahli Pertama', '8', 'III/b', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 0.60, 0.00, 0.00, 2457.00, 0.00, 0.00, 2457.00, 2272461.00, 5.00, 113623.00, 2158838.00, 3800400.00, 22749.00, 2136089.00, 1, '2026-09-23 17:37:26', '2026-09-23 17:40:48'),
(732, '03', '2026', 14, '199210012020122013', 'Millatina Hanifah, S.E.Sy.', '3375024110920001', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'III/b', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 1.80, 0.00, 0.00, 7371.00, 0.00, 0.00, 7371.00, 2267547.00, 5.00, 113377.00, 2154170.00, 3706802.00, 22749.00, 2131421.00, 1, '2026-09-23 17:37:26', '2026-09-23 17:40:48'),
(733, '03', '2026', 22, '199605222025211019', 'Muhammad Ilham Insani, S.Kom', '3326132205960005', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'IX', 'pppk', 'Normal', 100.00, 250383.00, 250383.00, 100153.00, 150230.00, 45068.00, 75114.00, 30048.00, 0.90, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 250383.00, 5.00, 12519.00, 237864.00, 3708960.00, 2504.00, 235360.00, 1, '2026-09-23 17:37:26', '2026-09-23 17:40:48'),
(734, '03', '2026', 19, '199611152020122016', 'Nadya Ayu Popi Haluansa, S.E', '3327115511960001', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'III/b', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 2.10, 0.00, 0.00, 8599.00, 0.00, 0.00, 8599.00, 2266319.00, 5.00, 113316.00, 2153003.00, 3706802.00, 22749.00, 2130254.00, 1, '2026-09-23 17:37:26', '2026-09-23 17:40:48'),
(735, '03', '2026', 12, '198910192020122011', 'Istikomah, S.E.', '3325025910890002', 'Penelaah Teknis Kebijakan', '7', 'III/b', 'pns', 'Normal', 100.00, 2128253.00, 2128253.00, 851301.00, 1276952.00, 383085.00, 638475.00, 255392.00, 0.60, 0.00, 0.00, 2299.00, 0.00, 0.00, 2299.00, 2125954.00, 5.00, 106298.00, 2019656.00, 3274300.00, 21283.00, 1998373.00, 1, '2026-09-23 17:37:26', '2026-09-23 17:40:48'),
(736, '03', '2026', 7, '198102232006042012', 'Riski Tessa Malela, S.E., MA', '3325116302810004', 'Penelaah Teknis Kebijakan', '7', 'IV/b', 'pns', 'Mutasi Masuk Pemda Lain', 50.00, 2128253.00, 1064127.00, 425650.00, 638477.00, 191542.00, 319238.00, 127697.00, 0.30, 0.00, 0.00, 575.00, 0.00, 0.00, 575.00, 1063552.00, 15.00, 159533.00, 904019.00, 5684686.00, 10641.00, 893378.00, 1, '2026-09-23 17:37:26', '2026-09-23 17:40:48'),
(737, '03', '2026', 11, '198901092022031007', 'Yanuar Albab Baihaqi, S.E.Sy', '3326130901890001', 'Penelaah Teknis Kebijakan', '7', 'III/b', 'pns', 'Normal', 100.00, 2128253.00, 2128253.00, 851301.00, 1276952.00, 383085.00, 638475.00, 255392.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2128253.00, 5.00, 106413.00, 2021840.00, 3058500.00, 21283.00, 2000557.00, 1, '2026-09-23 17:37:26', '2026-09-23 17:40:48'),
(738, '03', '2026', 23, '199610092024211003', 'Fajariawan Prabowo, A.Md.Kom', '3327080910960002', 'JF Pranata Komputer Pelaksana', '6', 'VII', 'pppk', 'Normal', 100.00, 249951.00, 249951.00, 99980.00, 149971.00, 44991.00, 74985.00, 29995.00, 0.60, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 249951.00, 0.00, 0.00, 249951.00, 3721632.00, 2500.00, 247451.00, 1, '2026-09-23 17:37:26', '2026-09-23 17:40:48'),
(739, '03', '2026', 16, '199608132022032018', 'Noor Falaisifa, A.Md', '3326135308960001', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.30, 0.00, 0.00, 1063.00, 0.00, 0.00, 1063.00, 1967038.00, 0.00, 0.00, 1967038.00, 2744200.00, 19681.00, 1947357.00, 1, '2026-09-23 17:37:26', '2026-09-23 17:40:48'),
(740, '03', '2026', 17, '199609172022032021', 'Nur Hanifah, A.Md', '3303115709960003', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1968101.00, 0.00, 0.00, 1968101.00, 3051904.00, 19681.00, 1948420.00, 1, '2026-09-23 17:37:26', '2026-09-23 17:40:48'),
(741, '03', '2026', 10, '198612162020122008', 'Ratih Prasastianila Muna, A.Md', '3325115612860002', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1968101.00, 0.00, 0.00, 1968101.00, 3322752.00, 19681.00, 1948420.00, 1, '2026-09-23 17:37:26', '2026-09-23 17:40:48'),
(742, '03', '2026', 15, '199401252022032008', 'Wulan Suryani, A.Md.Kom', '3204286501940002', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1968101.00, 0.00, 0.00, 1968101.00, 3051904.00, 19681.00, 1948420.00, 1, '2026-09-23 17:37:26', '2026-09-23 17:40:48'),
(743, '03', '2026', 6, '197408122014062001', 'Vitta Adi Rosewaty Jengkar', '3375035208740005', 'Pengadministrasi Perkantoran', '5', 'II/c', 'pns', 'Normal', 100.00, 1809207.00, 1809207.00, 723682.00, 1085525.00, 325657.00, 542762.00, 217106.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1809207.00, 0.00, 0.00, 1809207.00, 4147150.00, 18092.00, 1791115.00, 1, '2026-09-23 17:37:26', '2026-09-23 17:40:48'),
(744, '04', '2026', 24, '197006161989031001', 'Ade Suangkat, S.E', '3326131606700005', 'Kepala Dinas', '14', 'IV/b', 'pns', 'Normal', 100.00, 10001137.00, 10001137.00, 4000454.00, 6000683.00, 1800204.00, 3000341.00, 1200138.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10001137.00, 15.00, 1500171.00, 8500966.00, 7949576.00, 40504.00, 8460462.00, 1, '2026-09-23 17:41:04', '2026-09-23 17:43:47'),
(745, '04', '2026', 3, '197311171999031006', 'Harry Rudiyanto, S.Kom, M.M', '3375011711730010', 'JF Penata Kelola Penanaman Modal Ahli Madya', '12', 'IV/c', 'pns', 'Normal', 100.00, 5881004.00, 5881004.00, 2352401.00, 3528603.00, 1058580.00, 1764301.00, 705722.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 5881004.00, 15.00, 882151.00, 4998853.00, 6647738.00, 53523.00, 4945330.00, 1, '2026-09-23 17:41:04', '2026-09-23 17:43:47'),
(746, '04', '2026', 9, '198409272003121001', 'Sukirno, S.STP, M.M', '3375012709840006', 'Sekretaris', '12', 'IV/b', 'pns', 'Normal', 100.00, 7464950.00, 7464950.00, 2985980.00, 4478970.00, 1343691.00, 2239485.00, 895794.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 7464950.00, 15.00, 1119743.00, 6345207.00, 6424314.00, 55757.00, 6289450.00, 1, '2026-09-23 17:41:04', '2026-09-23 17:43:47'),
(747, '04', '2026', 4, '197406072007011008', 'Purnomo, S.H.', '3326160706740001', 'JF Penata Perizinan Ahli Muda', '10', 'III/c', 'pns', 'Normal', 100.00, 2528387.00, 2528387.00, 1011354.00, 1517033.00, 455109.00, 758516.00, 303408.00, 0.60, 0.00, 0.00, 2731.00, 0.00, 0.00, 2731.00, 2525656.00, 5.00, 126283.00, 2399373.00, 5257368.00, 25284.00, 2374089.00, 1, '2026-09-23 17:41:04', '2026-09-23 17:43:47'),
(748, '04', '2026', 8, '198102232009021003', 'Muhammad Muzni Kharis, A.Md', '3328112302810004', 'Kasubbag Umum dan Kepegawaian', '9', 'III/c', 'pns', 'Normal', 100.00, 3537596.00, 3537596.00, 1415038.00, 2122558.00, 636767.00, 1061278.00, 424513.00, 1.30, 0.00, 0.00, 8278.00, 0.00, 0.00, 8278.00, 3529318.00, 5.00, 176466.00, 3352852.00, 4751312.00, 35376.00, 3317476.00, 1, '2026-09-23 17:41:04', '2026-09-23 17:43:47'),
(749, '04', '2026', 21, '199305262025211041', 'Achmad Adi Kusuma, S.Kom', '3327052605930002', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'IX', 'pppk', 'Normal', 100.00, 250383.00, 250383.00, 100153.00, 150230.00, 45068.00, 75114.00, 30048.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 250383.00, 5.00, 12519.00, 237864.00, 3773032.00, 2504.00, 235360.00, 1, '2026-09-23 17:41:04', '2026-09-23 17:43:47'),
(750, '04', '2026', 13, '199102052022031003', 'Ahmad Rozi, S.E.', '3326140502910001', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'III/a', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2274918.00, 5.00, 113746.00, 2161172.00, 3504680.00, 22749.00, 2138423.00, 1, '2026-09-23 17:41:04', '2026-09-23 17:43:47'),
(751, '04', '2026', 18, '199610212025042002', 'Aqilatul Ulya, S.E', '3375026110960003', 'JF Penata Perizinan Ahli Pertama', '8', 'III/a', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2274918.00, 5.00, 113746.00, 2161172.00, 2413560.00, 22749.00, 2138423.00, 1, '2026-09-23 17:41:04', '2026-09-23 17:43:47'),
(752, '04', '2026', 20, '199801092022031007', 'Didik Yogo Suro Prasojo, S.Kom', '3326070901980001', 'JF Pranata Komputer Ahli Pertama', '8', 'III/b', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 0.60, 0.00, 0.00, 2457.00, 0.00, 0.00, 2457.00, 2272461.00, 5.00, 113623.00, 2158838.00, 3800400.00, 22749.00, 2136089.00, 1, '2026-09-23 17:41:04', '2026-09-23 17:43:47'),
(753, '04', '2026', 14, '199210012020122013', 'Millatina Hanifah, S.E.Sy.', '3375024110920001', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'III/b', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 2.60, 0.00, 0.00, 10647.00, 0.00, 0.00, 10647.00, 2264271.00, 5.00, 113214.00, 2151057.00, 3706802.00, 22749.00, 2128308.00, 1, '2026-09-23 17:41:04', '2026-09-23 17:43:47'),
(754, '04', '2026', 22, '199605222025211019', 'Muhammad Ilham Insani, S.Kom', '3326132205960005', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'IX', 'pppk', 'Normal', 100.00, 250383.00, 250383.00, 100153.00, 150230.00, 45068.00, 75114.00, 30048.00, 1.50, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 250383.00, 5.00, 12519.00, 237864.00, 3708960.00, 2504.00, 235360.00, 1, '2026-09-23 17:41:04', '2026-09-23 17:43:47'),
(755, '04', '2026', 19, '199611152020122016', 'Nadya Ayu Popi Haluansa, S.E', '3327115511960001', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'III/b', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 1.50, 0.00, 0.00, 6142.00, 0.00, 0.00, 6142.00, 2268776.00, 5.00, 113439.00, 2155337.00, 3706802.00, 22749.00, 2132588.00, 1, '2026-09-23 17:41:04', '2026-09-23 17:43:47'),
(756, '04', '2026', 12, '198910192020122011', 'Istikomah, S.E.', '3325025910890002', 'Penelaah Teknis Kebijakan', '7', 'III/b', 'pns', 'Normal', 100.00, 2128253.00, 2128253.00, 851301.00, 1276952.00, 383085.00, 638475.00, 255392.00, 0.60, 0.00, 0.00, 2299.00, 0.00, 0.00, 2299.00, 2125954.00, 5.00, 106298.00, 2019656.00, 3274300.00, 21283.00, 1998373.00, 1, '2026-09-23 17:41:04', '2026-09-23 17:43:47'),
(757, '04', '2026', 7, '198102232006042012', 'Riski Tessa Malela, S.E., MA', '3325116302810004', 'Penelaah Teknis Kebijakan', '7', 'IV/b', 'pns', 'Normal', 100.00, 2128253.00, 2128253.00, 851301.00, 1276952.00, 383085.00, 638475.00, 255392.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2128253.00, 15.00, 319238.00, 1809015.00, 5684686.00, 21283.00, 1787732.00, 1, '2026-09-23 17:41:04', '2026-09-23 17:43:47'),
(758, '04', '2026', 11, '198901092022031007', 'Yanuar Albab Baihaqi, S.E.Sy', '3326130901890001', 'Penelaah Teknis Kebijakan', '7', 'III/b', 'pns', 'Normal', 100.00, 2128253.00, 2128253.00, 851301.00, 1276952.00, 383085.00, 638475.00, 255392.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2128253.00, 5.00, 106413.00, 2021840.00, 3274300.00, 21283.00, 2000557.00, 1, '2026-09-23 17:41:04', '2026-09-23 17:43:47'),
(759, '04', '2026', 23, '199610092024211003', 'Fajariawan Prabowo, A.Md.Kom', '3327080910960002', 'JF Pranata Komputer Pelaksana', '6', 'VII', 'pppk', 'Normal', 100.00, 249951.00, 249951.00, 99980.00, 149971.00, 44991.00, 74985.00, 29995.00, 1.50, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 249951.00, 0.00, 0.00, 249951.00, 3721632.00, 2500.00, 247451.00, 1, '2026-09-23 17:41:04', '2026-09-23 17:43:47'),
(760, '04', '2026', 16, '199608132022032018', 'Noor Falaisifa, A.Md', '3326135308960001', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.60, 0.00, 0.00, 2126.00, 0.00, 0.00, 2126.00, 1965975.00, 0.00, 0.00, 1965975.00, 2936800.00, 19681.00, 1946294.00, 1, '2026-09-23 17:41:04', '2026-09-23 17:43:47'),
(761, '04', '2026', 17, '199609172022032021', 'Nur Hanifah, A.Md', '3303115709960003', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1968101.00, 0.00, 0.00, 1968101.00, 3267616.00, 19681.00, 1948420.00, 1, '2026-09-23 17:41:04', '2026-09-23 17:43:47'),
(762, '04', '2026', 10, '198612162020122008', 'Ratih Prasastianila Muna, A.Md', '3325115612860002', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1968101.00, 0.00, 0.00, 1968101.00, 3322752.00, 19681.00, 1948420.00, 1, '2026-09-23 17:41:04', '2026-09-23 17:43:47'),
(763, '04', '2026', 15, '199401252022032008', 'Wulan Suryani, A.Md.Kom', '3204286501940002', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1968101.00, 0.00, 0.00, 1968101.00, 3267616.00, 19681.00, 1948420.00, 1, '2026-09-23 17:41:04', '2026-09-23 17:43:47'),
(764, '04', '2026', 6, '197408122014062001', 'Vitta Adi Rosewaty Jengkar', '3375035208740005', 'Pengadministrasi Perkantoran', '5', 'II/c', 'pns', 'Normal', 100.00, 1809207.00, 1809207.00, 723682.00, 1085525.00, 325657.00, 542762.00, 217106.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1809207.00, 0.00, 0.00, 1809207.00, 4147150.00, 18092.00, 1791115.00, 1, '2026-09-23 17:41:04', '2026-09-23 17:43:47'),
(765, '05', '2026', 24, '197006161989031001', 'Ade Suangkat, S.E', '3326131606700005', 'Kepala Dinas', '14', 'IV/b', 'pns', 'Normal', 100.00, 10001137.00, 10001137.00, 4000454.00, 6000683.00, 1800204.00, 3000341.00, 1200138.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10001137.00, 15.00, 1500171.00, 8500966.00, 7949576.00, 40504.00, 8460462.00, 1, '2026-09-23 17:43:52', '2026-09-23 17:45:31'),
(766, '05', '2026', 3, '197311171999031006', 'Harry Rudiyanto, S.Kom, M.M', '3375011711730010', 'Sekretaris', '12', 'IV/c', 'pns', 'Normal', 100.00, 7464950.00, 7464950.00, 2985980.00, 4478970.00, 1343691.00, 2239485.00, 895794.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 7464950.00, 15.00, 1119743.00, 6345207.00, 6887480.00, 51125.00, 6294082.00, 1, '2026-09-23 17:43:52', '2026-09-23 17:45:31'),
(767, '05', '2026', 4, '197406072007011008', 'Purnomo, S.H.', '3326160706740001', 'JF Penata Perizinan Ahli Muda', '10', 'III/c', 'pns', 'Normal', 100.00, 2528387.00, 2528387.00, 1011354.00, 1517033.00, 455109.00, 758516.00, 303408.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2528387.00, 5.00, 126419.00, 2401968.00, 5257368.00, 25284.00, 2376684.00, 1, '2026-09-23 17:43:52', '2026-09-23 17:45:31'),
(768, '05', '2026', 8, '198102232009021003', 'Muhammad Muzni Kharis, A.Md', '3328112302810004', 'Kasubbag Umum dan Kepegawaian', '9', 'III/c', 'pns', 'Normal', 100.00, 3537596.00, 3537596.00, 1415038.00, 2122558.00, 636767.00, 1061278.00, 424513.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 3537596.00, 5.00, 176880.00, 3360716.00, 4751312.00, 35376.00, 3325340.00, 1, '2026-09-23 17:43:52', '2026-09-23 17:45:31'),
(769, '05', '2026', 21, '199305262025211041', 'Achmad Adi Kusuma, S.Kom', '3327052605930002', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'IX', 'pppk', 'Normal', 100.00, 250383.00, 250383.00, 100153.00, 150230.00, 45068.00, 75114.00, 30048.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 250383.00, 5.00, 12519.00, 237864.00, 3773032.00, 2504.00, 235360.00, 1, '2026-09-23 17:43:52', '2026-09-23 17:45:31'),
(770, '05', '2026', 13, '199102052022031003', 'Ahmad Rozi, S.E.', '3326140502910001', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'III/a', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2274918.00, 5.00, 113746.00, 2161172.00, 3563960.00, 22749.00, 2138423.00, 1, '2026-09-23 17:43:52', '2026-09-23 17:45:31'),
(771, '05', '2026', 18, '199610212025042002', 'Aqilatul Ulya, S.E', '3375026110960003', 'JF Penata Perizinan Ahli Pertama', '8', 'III/a', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2274918.00, 5.00, 113746.00, 2161172.00, 2970700.00, 22749.00, 2138423.00, 1, '2026-09-23 17:43:52', '2026-09-23 17:45:31'),
(772, '05', '2026', 20, '199801092022031007', 'Didik Yogo Suro Prasojo, S.Kom', '3326070901980001', 'JF Pranata Komputer Ahli Pertama', '8', 'III/b', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2274918.00, 5.00, 113746.00, 2161172.00, 3800400.00, 22749.00, 2138423.00, 1, '2026-09-23 17:43:52', '2026-09-23 17:45:31'),
(773, '05', '2026', 14, '199210012020122013', 'Millatina Hanifah, S.E.Sy.', '3375024110920001', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'III/b', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 2.10, 0.00, 0.00, 8599.00, 0.00, 0.00, 8599.00, 2266319.00, 5.00, 113316.00, 2153003.00, 3706802.00, 22749.00, 2130254.00, 1, '2026-09-23 17:43:52', '2026-09-23 17:45:31'),
(774, '05', '2026', 22, '199605222025211019', 'Muhammad Ilham Insani, S.Kom', '3326132205960005', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'IX', 'pppk', 'Normal', 100.00, 250383.00, 250383.00, 100153.00, 150230.00, 45068.00, 75114.00, 30048.00, 0.90, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 250383.00, 5.00, 12519.00, 237864.00, 3708960.00, 2504.00, 235360.00, 1, '2026-09-23 17:43:52', '2026-09-23 17:45:31'),
(775, '05', '2026', 19, '199611152020122016', 'Nadya Ayu Popi Haluansa, S.E', '3327115511960001', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'III/b', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 1.20, 0.00, 0.00, 4914.00, 0.00, 0.00, 4914.00, 2270004.00, 5.00, 113500.00, 2156504.00, 3706802.00, 22749.00, 2133755.00, 1, '2026-09-23 17:43:52', '2026-09-23 17:45:31'),
(776, '05', '2026', 12, '198910192020122011', 'Istikomah, S.E.', '3325025910890002', 'Penelaah Teknis Kebijakan', '7', 'III/b', 'pns', 'Normal', 100.00, 2128253.00, 2128253.00, 851301.00, 1276952.00, 383085.00, 638475.00, 255392.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2128253.00, 5.00, 106413.00, 2021840.00, 3274300.00, 21283.00, 2000557.00, 1, '2026-09-23 17:43:52', '2026-09-23 17:45:31'),
(777, '05', '2026', 7, '198102232006042012', 'Riski Tessa Malela, S.E., MA', '3325116302810004', 'Penelaah Teknis Kebijakan', '7', 'IV/b', 'pns', 'Normal', 100.00, 2128253.00, 2128253.00, 851301.00, 1276952.00, 383085.00, 638475.00, 255392.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2128253.00, 15.00, 319238.00, 1809015.00, 5684686.00, 21283.00, 1787732.00, 1, '2026-09-23 17:43:52', '2026-09-23 17:45:31'),
(778, '05', '2026', 11, '198901092022031007', 'Yanuar Albab Baihaqi, S.E.Sy', '3326130901890001', 'Penelaah Teknis Kebijakan', '7', 'III/b', 'pns', 'Normal', 100.00, 2128253.00, 2128253.00, 851301.00, 1276952.00, 383085.00, 638475.00, 255392.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2128253.00, 5.00, 106413.00, 2021840.00, 3274300.00, 21283.00, 2000557.00, 1, '2026-09-23 17:43:52', '2026-09-23 17:45:31'),
(779, '05', '2026', 23, '199610092024211003', 'Fajariawan Prabowo, A.Md.Kom', '3327080910960002', 'JF Pranata Komputer Pelaksana', '6', 'VII', 'pppk', 'Normal', 100.00, 249951.00, 249951.00, 99980.00, 149971.00, 44991.00, 74985.00, 29995.00, 1.50, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 249951.00, 0.00, 0.00, 249951.00, 3721632.00, 2500.00, 247451.00, 1, '2026-09-23 17:43:52', '2026-09-23 17:45:31'),
(780, '05', '2026', 16, '199608132022032018', 'Noor Falaisifa, A.Md', '3326135308960001', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1968101.00, 0.00, 0.00, 1968101.00, 2936800.00, 19681.00, 1948420.00, 1, '2026-09-23 17:43:52', '2026-09-23 17:45:31'),
(781, '05', '2026', 17, '199609172022032021', 'Nur Hanifah, A.Md', '3303115709960003', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1968101.00, 0.00, 0.00, 1968101.00, 3267616.00, 19681.00, 1948420.00, 1, '2026-09-23 17:43:52', '2026-09-23 17:45:31'),
(782, '05', '2026', 10, '198612162020122008', 'Ratih Prasastianila Muna, A.Md', '3325115612860002', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1968101.00, 0.00, 0.00, 1968101.00, 3322752.00, 19681.00, 1948420.00, 1, '2026-09-23 17:43:52', '2026-09-23 17:45:31'),
(783, '05', '2026', 15, '199401252022032008', 'Wulan Suryani, A.Md.Kom', '3204286501940002', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1968101.00, 0.00, 0.00, 1968101.00, 3267616.00, 19681.00, 1948420.00, 1, '2026-09-23 17:43:52', '2026-09-23 17:45:31'),
(784, '05', '2026', 6, '197408122014062001', 'Vitta Adi Rosewaty Jengkar', '3375035208740005', 'Pengadministrasi Perkantoran', '5', 'II/c', 'pns', 'Normal', 100.00, 1809207.00, 1809207.00, 723682.00, 1085525.00, 325657.00, 542762.00, 217106.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1809207.00, 0.00, 0.00, 1809207.00, 4147150.00, 18092.00, 1791115.00, 1, '2026-09-23 17:43:52', '2026-09-23 17:45:31'),
(785, '06', '2026', 24, '197006161989031001', 'Ade Suangkat, S.E', '3326131606700005', 'Kepala Dinas', '14', 'IV/b', 'pns', 'Normal', 100.00, 10001137.00, 10001137.00, 4000454.00, 6000683.00, 1800204.00, 3000341.00, 1200138.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10001137.00, 15.00, 1500171.00, 8500966.00, 7949576.00, 40504.00, 8460462.00, 1, '2026-09-23 17:45:43', '2026-09-23 17:47:54'),
(786, '06', '2026', 3, '197311171999031006', 'Harry Rudiyanto, S.Kom, M.M', '3375011711730010', 'Sekretaris', '12', 'IV/c', 'pns', 'Normal', 100.00, 7464950.00, 7464950.00, 2985980.00, 4478970.00, 1343691.00, 2239485.00, 895794.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 7464950.00, 15.00, 1119743.00, 6345207.00, 7167480.00, 48325.00, 6296882.00, 1, '2026-09-23 17:45:43', '2026-09-23 17:47:54'),
(787, '06', '2026', 4, '197406072007011008', 'Purnomo, S.H.', '3326160706740001', 'JF Penata Perizinan Ahli Muda', '10', 'III/c', 'pns', 'Normal', 100.00, 2528387.00, 2528387.00, 1011354.00, 1517033.00, 455109.00, 758516.00, 303408.00, 6.00, 0.00, 0.00, 27307.00, 0.00, 0.00, 27307.00, 2501080.00, 5.00, 125054.00, 2376026.00, 5257368.00, 25284.00, 2350742.00, 1, '2026-09-23 17:45:43', '2026-09-23 17:47:54'),
(788, '06', '2026', 8, '198102232009021003', 'Muhammad Muzni Kharis, A.Md', '3328112302810004', 'Kasubbag Umum dan Kepegawaian', '9', 'III/c', 'pns', 'Normal', 100.00, 3537596.00, 3537596.00, 1415038.00, 2122558.00, 636767.00, 1061278.00, 424513.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 3537596.00, 5.00, 176880.00, 3360716.00, 4751312.00, 35376.00, 3325340.00, 1, '2026-09-23 17:45:43', '2026-09-23 17:47:54'),
(789, '06', '2026', 21, '199305262025211041', 'Achmad Adi Kusuma, S.Kom', '3327052605930002', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'IX', 'pppk', 'Normal', 100.00, 250383.00, 250383.00, 100153.00, 150230.00, 45068.00, 75114.00, 30048.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 250383.00, 5.00, 12519.00, 237864.00, 3773032.00, 2504.00, 235360.00, 1, '2026-09-23 17:45:43', '2026-09-23 17:47:54'),
(790, '06', '2026', 13, '199102052022031003', 'Ahmad Rozi, S.E.', '3326140502910001', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'III/a', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2274918.00, 5.00, 113746.00, 2161172.00, 3563960.00, 22749.00, 2138423.00, 1, '2026-09-23 17:45:43', '2026-09-23 17:47:54'),
(791, '06', '2026', 18, '199610212025042002', 'Aqilatul Ulya, S.E', '3375026110960003', 'JF Penata Perizinan Ahli Pertama', '8', 'III/a', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2274918.00, 5.00, 113746.00, 2161172.00, 2970700.00, 22749.00, 2138423.00, 1, '2026-09-23 17:45:43', '2026-09-23 17:47:54'),
(792, '06', '2026', 20, '199801092022031007', 'Didik Yogo Suro Prasojo, S.Kom', '3326070901980001', 'JF Pranata Komputer Ahli Pertama', '8', 'III/b', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 0.90, 0.00, 0.00, 3685.00, 0.00, 0.00, 3685.00, 2271233.00, 5.00, 113562.00, 2157671.00, 3938230.00, 22749.00, 2134922.00, 1, '2026-09-23 17:45:43', '2026-09-23 17:47:54'),
(793, '06', '2026', 14, '199210012020122013', 'Millatina Hanifah, S.E.Sy.', '3375024110920001', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'III/b', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 2.40, 0.00, 0.00, 9828.00, 0.00, 0.00, 9828.00, 2265090.00, 5.00, 113255.00, 2151835.00, 3706802.00, 22749.00, 2129086.00, 1, '2026-09-23 17:45:43', '2026-09-23 17:47:54'),
(794, '06', '2026', 22, '199605222025211019', 'Muhammad Ilham Insani, S.Kom', '3326132205960005', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'IX', 'pppk', 'Normal', 100.00, 250383.00, 250383.00, 100153.00, 150230.00, 45068.00, 75114.00, 30048.00, 0.90, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 250383.00, 5.00, 12519.00, 237864.00, 3708960.00, 2504.00, 235360.00, 1, '2026-09-23 17:45:43', '2026-09-23 17:47:54'),
(795, '06', '2026', 19, '199611152020122016', 'Nadya Ayu Popi Haluansa, S.E', '3327115511960001', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'III/b', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 1.60, 0.00, 0.00, 6552.00, 0.00, 0.00, 6552.00, 2268366.00, 5.00, 113418.00, 2154948.00, 3706802.00, 22749.00, 2132199.00, 1, '2026-09-23 17:45:43', '2026-09-23 17:47:54'),
(796, '06', '2026', 12, '198910192020122011', 'Istikomah, S.E.', '3325025910890002', 'Penelaah Teknis Kebijakan', '7', 'III/b', 'pns', 'Normal', 100.00, 2128253.00, 2128253.00, 851301.00, 1276952.00, 383085.00, 638475.00, 255392.00, 0.30, 0.00, 0.00, 1149.00, 0.00, 0.00, 1149.00, 2127104.00, 5.00, 106355.00, 2020749.00, 3274300.00, 21283.00, 1999466.00, 1, '2026-09-23 17:45:43', '2026-09-23 17:47:54'),
(797, '06', '2026', 7, '198102232006042012', 'Riski Tessa Malela, S.E., MA', '3325116302810004', 'Penelaah Teknis Kebijakan', '7', 'IV/b', 'pns', 'Normal', 100.00, 2128253.00, 2128253.00, 851301.00, 1276952.00, 383085.00, 638475.00, 255392.00, 3.30, 0.00, 0.00, 12642.00, 0.00, 0.00, 12642.00, 2115611.00, 15.00, 317342.00, 1798269.00, 5684686.00, 21283.00, 1776986.00, 1, '2026-09-23 17:45:43', '2026-09-23 17:47:54'),
(798, '06', '2026', 11, '198901092022031007', 'Yanuar Albab Baihaqi, S.E.Sy', '3326130901890001', 'Penelaah Teknis Kebijakan', '7', 'III/b', 'pns', 'Normal', 100.00, 2128253.00, 2128253.00, 851301.00, 1276952.00, 383085.00, 638475.00, 255392.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2128253.00, 5.00, 106413.00, 2021840.00, 3274300.00, 21283.00, 2000557.00, 1, '2026-09-23 17:45:43', '2026-09-23 17:47:54');
INSERT INTO `tpp` (`id`, `bulan`, `tahun`, `pegawai_id`, `nip`, `nama`, `nik`, `jabatan`, `kelas_jabatan`, `golongan`, `status_kepegawaian`, `kondisi_khusus`, `persen_tpp_diterima`, `basic_tpp`, `tpp_efektif`, `beban_kerja`, `prestasi_kerja`, `tpp_presensi`, `tpp_kinerja`, `tpp_seksama`, `persen_potongan_presensi`, `persen_potongan_kinerja`, `persen_potongan_seksama`, `nominal_potongan_presensi`, `nominal_potongan_kinerja`, `nominal_potongan_seksama`, `total_potongan`, `tpp_kotor`, `tarif_pajak`, `potongan_pajak`, `tpp_bersih`, `gaji_induk_bpjs`, `potongan_bpjs`, `diterimakan`, `is_locked`, `created_at`, `updated_at`) VALUES
(799, '06', '2026', 23, '199610092024211003', 'Fajariawan Prabowo, A.Md.Kom', '3327080910960002', 'JF Pranata Komputer Pelaksana', '6', 'VII', 'pppk', 'Normal', 100.00, 249951.00, 249951.00, 99980.00, 149971.00, 44991.00, 74985.00, 29995.00, 0.90, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 249951.00, 0.00, 0.00, 249951.00, 3721632.00, 2500.00, 247451.00, 1, '2026-09-23 17:45:43', '2026-09-23 17:47:54'),
(800, '06', '2026', 16, '199608132022032018', 'Noor Falaisifa, A.Md', '3326135308960001', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.90, 0.00, 0.00, 3188.00, 0.00, 0.00, 3188.00, 1964913.00, 0.00, 0.00, 1964913.00, 2936800.00, 19681.00, 1945232.00, 1, '2026-09-23 17:45:43', '2026-09-23 17:47:54'),
(801, '06', '2026', 17, '199609172022032021', 'Nur Hanifah, A.Md', '3303115709960003', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1968101.00, 0.00, 0.00, 1968101.00, 3267616.00, 19681.00, 1948420.00, 1, '2026-09-23 17:45:43', '2026-09-23 17:47:54'),
(802, '06', '2026', 10, '198612162020122008', 'Ratih Prasastianila Muna, A.Md', '3325115612860002', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1968101.00, 0.00, 0.00, 1968101.00, 3322752.00, 19681.00, 1948420.00, 1, '2026-09-23 17:45:43', '2026-09-23 17:47:54'),
(803, '06', '2026', 15, '199401252022032008', 'Wulan Suryani, A.Md.Kom', '3204286501940002', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1968101.00, 0.00, 0.00, 1968101.00, 3267616.00, 19681.00, 1948420.00, 1, '2026-09-23 17:45:43', '2026-09-23 17:47:54'),
(804, '06', '2026', 6, '197408122014062001', 'Vitta Adi Rosewaty Jengkar', '3375035208740005', 'Pengadministrasi Perkantoran', '5', 'II/c', 'pns', 'Normal', 100.00, 1809207.00, 1809207.00, 723682.00, 1085525.00, 325657.00, 542762.00, 217106.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1809207.00, 0.00, 0.00, 1809207.00, 4147150.00, 18092.00, 1791115.00, 1, '2026-09-23 17:45:43', '2026-09-23 17:47:54'),
(805, '07', '2026', 24, '197006161989031001', 'Ade Suangkat, S.E', '3326131606700005', 'Kepala Dinas', '14', 'IV/b', 'pns', 'Normal', 100.00, 10001137.00, 10001137.00, 4000454.00, 6000683.00, 1800204.00, 3000341.00, 1200138.00, 0.30, 0.00, 0.00, 5401.00, 0.00, 0.00, 5401.00, 9995736.00, 15.00, 1499360.00, 8496376.00, 7949576.00, 40504.00, 8455872.00, 1, '2026-09-23 17:48:24', '2026-09-23 17:50:34'),
(806, '07', '2026', 3, '197311171999031006', 'Harry Rudiyanto, S.Kom, M.M', '3375011711730010', 'Sekretaris', '12', 'IV/c', 'pns', 'Normal', 100.00, 7464950.00, 7464950.00, 2985980.00, 4478970.00, 1343691.00, 2239485.00, 895794.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 7464950.00, 15.00, 1119743.00, 6345207.00, 7167480.00, 48325.00, 6296882.00, 1, '2026-09-23 17:48:24', '2026-09-23 17:50:34'),
(807, '07', '2026', 4, '197406072007011008', 'Purnomo, S.H.', '3326160706740001', 'JF Penata Perizinan Ahli Muda', '10', 'III/c', 'pns', 'Normal', 100.00, 2528387.00, 2528387.00, 1011354.00, 1517033.00, 455109.00, 758516.00, 303408.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2528387.00, 5.00, 126419.00, 2401968.00, 5257368.00, 25284.00, 2376684.00, 1, '2026-09-23 17:48:24', '2026-09-23 17:50:34'),
(808, '07', '2026', 8, '198102232009021003', 'Muhammad Muzni Kharis, A.Md', '3328112302810004', 'Kasubbag Umum dan Kepegawaian', '9', 'III/c', 'pns', 'Normal', 100.00, 3537596.00, 3537596.00, 1415038.00, 2122558.00, 636767.00, 1061278.00, 424513.00, 0.30, 0.00, 0.00, 1910.00, 0.00, 0.00, 1910.00, 3535686.00, 5.00, 176784.00, 3358902.00, 4751312.00, 35376.00, 3323526.00, 1, '2026-09-23 17:48:24', '2026-09-23 17:50:34'),
(809, '07', '2026', 21, '199305262025211041', 'Achmad Adi Kusuma, S.Kom', '3327052605930002', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'IX', 'pppk', 'Normal', 100.00, 250383.00, 250383.00, 100153.00, 150230.00, 45068.00, 75114.00, 30048.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 250383.00, 5.00, 12519.00, 237864.00, 3773032.00, 2504.00, 235360.00, 1, '2026-09-23 17:48:24', '2026-09-23 17:50:34'),
(810, '07', '2026', 13, '199102052022031003', 'Ahmad Rozi, S.E.', '3326140502910001', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'III/a', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2274918.00, 5.00, 113746.00, 2161172.00, 3563960.00, 22749.00, 2138423.00, 1, '2026-09-23 17:48:24', '2026-09-23 17:50:34'),
(811, '07', '2026', 18, '199610212025042002', 'Aqilatul Ulya, S.E', '3375026110960003', 'JF Penata Perizinan Ahli Pertama', '8', 'III/a', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2274918.00, 5.00, 113746.00, 2161172.00, 2970700.00, 22749.00, 2138423.00, 1, '2026-09-23 17:48:24', '2026-09-23 17:50:34'),
(812, '07', '2026', 20, '199801092022031007', 'Didik Yogo Suro Prasojo, S.Kom', '3326070901980001', 'JF Pranata Komputer Ahli Pertama', '8', 'III/b', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 0.30, 0.00, 0.00, 1228.00, 0.00, 0.00, 1228.00, 2273690.00, 5.00, 113685.00, 2160005.00, 3938230.00, 22749.00, 2137256.00, 1, '2026-09-23 17:48:24', '2026-09-23 17:50:34'),
(813, '07', '2026', 14, '199210012020122013', 'Millatina Hanifah, S.E.Sy.', '3375024110920001', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'III/b', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 2.40, 0.00, 0.00, 9828.00, 0.00, 0.00, 9828.00, 2265090.00, 5.00, 113255.00, 2151835.00, 3706802.00, 22749.00, 2129086.00, 1, '2026-09-23 17:48:24', '2026-09-23 17:50:34'),
(814, '07', '2026', 22, '199605222025211019', 'Muhammad Ilham Insani, S.Kom', '3326132205960005', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'IX', 'pppk', 'Normal', 100.00, 250383.00, 250383.00, 100153.00, 150230.00, 45068.00, 75114.00, 30048.00, 0.60, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 250383.00, 5.00, 12519.00, 237864.00, 3708960.00, 2504.00, 235360.00, 1, '2026-09-23 17:48:24', '2026-09-23 17:50:34'),
(815, '07', '2026', 19, '199611152020122016', 'Nadya Ayu Popi Haluansa, S.E', '3327115511960001', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'III/b', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 2.10, 0.00, 0.00, 8599.00, 0.00, 0.00, 8599.00, 2266319.00, 5.00, 113316.00, 2153003.00, 3706802.00, 22749.00, 2130254.00, 1, '2026-09-23 17:48:24', '2026-09-23 17:50:34'),
(816, '07', '2026', 12, '198910192020122011', 'Istikomah, S.E.', '3325025910890002', 'Penelaah Teknis Kebijakan', '7', 'III/b', 'pns', 'Normal', 100.00, 2128253.00, 2128253.00, 851301.00, 1276952.00, 383085.00, 638475.00, 255392.00, 0.90, 0.00, 0.00, 3448.00, 0.00, 0.00, 3448.00, 2124805.00, 5.00, 106240.00, 2018565.00, 3274300.00, 21283.00, 1997282.00, 1, '2026-09-23 17:48:24', '2026-09-23 17:50:34'),
(817, '07', '2026', 7, '198102232006042012', 'Riski Tessa Malela, S.E., MA', '3325116302810004', 'Penelaah Teknis Kebijakan', '7', 'IV/b', 'pns', 'Normal', 100.00, 2128253.00, 2128253.00, 851301.00, 1276952.00, 383085.00, 638475.00, 255392.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2128253.00, 15.00, 319238.00, 1809015.00, 5684686.00, 21283.00, 1787732.00, 1, '2026-09-23 17:48:24', '2026-09-23 17:50:34'),
(818, '07', '2026', 11, '198901092022031007', 'Yanuar Albab Baihaqi, S.E.Sy', '3326130901890001', 'Penelaah Teknis Kebijakan', '7', 'III/b', 'pns', 'Normal', 100.00, 2128253.00, 2128253.00, 851301.00, 1276952.00, 383085.00, 638475.00, 255392.00, 0.60, 0.00, 0.00, 2299.00, 0.00, 0.00, 2299.00, 2125954.00, 5.00, 106298.00, 2019656.00, 3274300.00, 21283.00, 1998373.00, 1, '2026-09-23 17:48:24', '2026-09-23 17:50:34'),
(819, '07', '2026', 23, '199610092024211003', 'Fajariawan Prabowo, A.Md.Kom', '3327080910960002', 'JF Pranata Komputer Pelaksana', '6', 'VII', 'pppk', 'Normal', 100.00, 249951.00, 249951.00, 99980.00, 149971.00, 44991.00, 74985.00, 29995.00, 1.80, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 249951.00, 0.00, 0.00, 249951.00, 3721632.00, 2500.00, 247451.00, 1, '2026-09-23 17:48:24', '2026-09-23 17:50:34'),
(820, '07', '2026', 16, '199608132022032018', 'Noor Falaisifa, A.Md', '3326135308960001', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1968101.00, 0.00, 0.00, 1968101.00, 2936800.00, 19681.00, 1948420.00, 1, '2026-09-23 17:48:24', '2026-09-23 17:50:34'),
(821, '07', '2026', 17, '199609172022032021', 'Nur Hanifah, A.Md', '3303115709960003', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1968101.00, 0.00, 0.00, 1968101.00, 3267616.00, 19681.00, 1948420.00, 1, '2026-09-23 17:48:24', '2026-09-23 17:50:34'),
(822, '07', '2026', 10, '198612162020122008', 'Ratih Prasastianila Muna, A.Md', '3325115612860002', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1968101.00, 0.00, 0.00, 1968101.00, 3322752.00, 19681.00, 1948420.00, 1, '2026-09-23 17:48:24', '2026-09-23 17:50:34'),
(823, '07', '2026', 15, '199401252022032008', 'Wulan Suryani, A.Md.Kom', '3204286501940002', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1968101.00, 0.00, 0.00, 1968101.00, 3267616.00, 19681.00, 1948420.00, 1, '2026-09-23 17:48:24', '2026-09-23 17:50:34'),
(824, '07', '2026', 6, '197408122014062001', 'Vitta Adi Rosewaty Jengkar', '3375035208740005', 'Pengadministrasi Perkantoran', '5', 'II/c', 'pns', 'Normal', 100.00, 1809207.00, 1809207.00, 723682.00, 1085525.00, 325657.00, 542762.00, 217106.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1809207.00, 0.00, 0.00, 1809207.00, 4147150.00, 18092.00, 1791115.00, 1, '2026-09-23 17:48:24', '2026-09-23 17:50:34'),
(825, '08', '2026', 24, '197006161989031001', 'Ade Suangkat, S.E', '3326131606700005', 'Kepala Dinas', '14', 'IV/b', 'pns', 'Normal', 100.00, 10001137.00, 10001137.00, 4000454.00, 6000683.00, 1800204.00, 3000341.00, 1200138.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10001137.00, 15.00, 1500171.00, 8500966.00, 7949576.00, 40504.00, 8460462.00, 1, '2026-09-23 17:51:20', '2026-09-23 17:53:39'),
(826, '08', '2026', 3, '197311171999031006', 'Harry Rudiyanto, S.Kom, M.M', '3375011711730010', 'Sekretaris', '12', 'IV/c', 'pns', 'Normal', 100.00, 7464950.00, 7464950.00, 2985980.00, 4478970.00, 1343691.00, 2239485.00, 895794.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 7464950.00, 15.00, 1119743.00, 6345207.00, 7167480.00, 48325.00, 6296882.00, 1, '2026-09-23 17:51:20', '2026-09-23 17:53:39'),
(827, '08', '2026', 4, '197406072007011008', 'Purnomo, S.H.', '3326160706740001', 'JF Penata Perizinan Ahli Muda', '10', 'III/c', 'pns', 'Normal', 100.00, 2528387.00, 2528387.00, 1011354.00, 1517033.00, 455109.00, 758516.00, 303408.00, 0.30, 0.00, 0.00, 1365.00, 0.00, 0.00, 1365.00, 2527022.00, 5.00, 126351.00, 2400671.00, 5257368.00, 25284.00, 2375387.00, 1, '2026-09-23 17:51:20', '2026-09-23 17:53:39'),
(828, '08', '2026', 8, '198102232009021003', 'Muhammad Muzni Kharis, A.Md', '3328112302810004', 'Kasubbag Umum dan Kepegawaian', '9', 'III/c', 'pns', 'Normal', 100.00, 3537596.00, 3537596.00, 1415038.00, 2122558.00, 636767.00, 1061278.00, 424513.00, 0.60, 0.00, 0.00, 3821.00, 0.00, 0.00, 3821.00, 3533775.00, 5.00, 176689.00, 3357086.00, 4751312.00, 35376.00, 3321710.00, 1, '2026-09-23 17:51:20', '2026-09-23 17:53:39'),
(829, '08', '2026', 21, '199305262025211041', 'Achmad Adi Kusuma, S.Kom', '3327052605930002', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'IX', 'pppk', 'Normal', 100.00, 250383.00, 250383.00, 100153.00, 150230.00, 45068.00, 75114.00, 30048.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 250383.00, 5.00, 12519.00, 237864.00, 3773032.00, 2504.00, 235360.00, 1, '2026-09-23 17:51:20', '2026-09-23 17:53:39'),
(830, '08', '2026', 13, '199102052022031003', 'Ahmad Rozi, S.E.', '3326140502910001', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'III/a', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2274918.00, 5.00, 113746.00, 2161172.00, 3563960.00, 22749.00, 2138423.00, 1, '2026-09-23 17:51:20', '2026-09-23 17:53:39'),
(831, '08', '2026', 18, '199610212025042002', 'Aqilatul Ulya, S.E', '3375026110960003', 'JF Penata Perizinan Ahli Pertama', '8', 'III/a', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2274918.00, 5.00, 113746.00, 2161172.00, 2970700.00, 22749.00, 2138423.00, 1, '2026-09-23 17:51:20', '2026-09-23 17:53:39'),
(832, '08', '2026', 20, '199801092022031007', 'Didik Yogo Suro Prasojo, S.Kom', '3326070901980001', 'JF Pranata Komputer Ahli Pertama', '8', 'III/b', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 0.90, 0.00, 0.00, 3685.00, 0.00, 0.00, 3685.00, 2271233.00, 5.00, 113562.00, 2157671.00, 3938230.00, 22749.00, 2134922.00, 1, '2026-09-23 17:51:20', '2026-09-23 17:53:39'),
(833, '08', '2026', 14, '199210012020122013', 'Millatina Hanifah, S.E.Sy.', '3375024110920001', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'III/b', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 1.50, 0.00, 0.00, 6142.00, 0.00, 0.00, 6142.00, 2268776.00, 5.00, 113439.00, 2155337.00, 3706802.00, 22749.00, 2132588.00, 1, '2026-09-23 17:51:20', '2026-09-23 17:53:39'),
(834, '08', '2026', 22, '199605222025211019', 'Muhammad Ilham Insani, S.Kom', '3326132205960005', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'IX', 'pppk', 'Normal', 100.00, 250383.00, 250383.00, 100153.00, 150230.00, 45068.00, 75114.00, 30048.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 250383.00, 5.00, 12519.00, 237864.00, 3708960.00, 2504.00, 235360.00, 1, '2026-09-23 17:51:20', '2026-09-23 17:53:39'),
(835, '08', '2026', 19, '199611152020122016', 'Nadya Ayu Popi Haluansa, S.E', '3327115511960001', 'JF Penata Kelola Penanaman Modal Ahli Pertama', '8', 'III/b', 'pns', 'Normal', 100.00, 2274918.00, 2274918.00, 909967.00, 1364951.00, 409485.00, 682475.00, 272991.00, 2.40, 0.00, 0.00, 9828.00, 0.00, 0.00, 9828.00, 2265090.00, 5.00, 113255.00, 2151835.00, 3706802.00, 22749.00, 2129086.00, 1, '2026-09-23 17:51:20', '2026-09-23 17:53:39'),
(836, '08', '2026', 12, '198910192020122011', 'Istikomah, S.E.', '3325025910890002', 'Penelaah Teknis Kebijakan', '7', 'III/b', 'pns', 'Normal', 100.00, 2128253.00, 2128253.00, 851301.00, 1276952.00, 383085.00, 638475.00, 255392.00, 0.60, 0.00, 0.00, 2299.00, 0.00, 0.00, 2299.00, 2125954.00, 5.00, 106298.00, 2019656.00, 3274300.00, 21283.00, 1998373.00, 1, '2026-09-23 17:51:20', '2026-09-23 17:53:39'),
(837, '08', '2026', 7, '198102232006042012', 'Riski Tessa Malela, S.E., MA', '3325116302810004', 'Penelaah Teknis Kebijakan', '7', 'IV/b', 'pns', 'Normal', 100.00, 2128253.00, 2128253.00, 851301.00, 1276952.00, 383085.00, 638475.00, 255392.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2128253.00, 15.00, 319238.00, 1809015.00, 5684686.00, 21283.00, 1787732.00, 1, '2026-09-23 17:51:20', '2026-09-23 17:53:39'),
(838, '08', '2026', 11, '198901092022031007', 'Yanuar Albab Baihaqi, S.E.Sy', '3326130901890001', 'Penelaah Teknis Kebijakan', '7', 'III/b', 'pns', 'Normal', 100.00, 2128253.00, 2128253.00, 851301.00, 1276952.00, 383085.00, 638475.00, 255392.00, 0.30, 0.00, 0.00, 1149.00, 0.00, 0.00, 1149.00, 2127104.00, 5.00, 106355.00, 2020749.00, 3274300.00, 21283.00, 1999466.00, 1, '2026-09-23 17:51:20', '2026-09-23 17:53:39'),
(839, '08', '2026', 23, '199610092024211003', 'Fajariawan Prabowo, A.Md.Kom', '3327080910960002', 'JF Pranata Komputer Pelaksana', '6', 'VII', 'pppk', 'Normal', 100.00, 249951.00, 249951.00, 99980.00, 149971.00, 44991.00, 74985.00, 29995.00, 1.50, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 249951.00, 0.00, 0.00, 249951.00, 3721632.00, 2500.00, 247451.00, 1, '2026-09-23 17:51:20', '2026-09-23 17:53:39'),
(840, '08', '2026', 16, '199608132022032018', 'Noor Falaisifa, A.Md', '3326135308960001', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1968101.00, 0.00, 0.00, 1968101.00, 2936800.00, 19681.00, 1948420.00, 1, '2026-09-23 17:51:20', '2026-09-23 17:53:39'),
(841, '08', '2026', 17, '199609172022032021', 'Nur Hanifah, A.Md', '3303115709960003', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1968101.00, 0.00, 0.00, 1968101.00, 3267616.00, 19681.00, 1948420.00, 1, '2026-09-23 17:51:20', '2026-09-23 17:53:39'),
(842, '08', '2026', 10, '198612162020122008', 'Ratih Prasastianila Muna, A.Md', '3325115612860002', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 1.30, 0.00, 0.00, 4605.00, 0.00, 0.00, 4605.00, 1963496.00, 0.00, 0.00, 1963496.00, 3322752.00, 19681.00, 1943815.00, 1, '2026-09-23 17:51:20', '2026-09-23 17:53:39'),
(843, '08', '2026', 15, '199401252022032008', 'Wulan Suryani, A.Md.Kom', '3204286501940002', 'Pengolah Data dan Informasi', '6', 'II/d', 'pns', 'Normal', 100.00, 1968101.00, 1968101.00, 787240.00, 1180861.00, 354258.00, 590430.00, 236173.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1968101.00, 0.00, 0.00, 1968101.00, 3267616.00, 19681.00, 1948420.00, 1, '2026-09-23 17:51:20', '2026-09-23 17:53:39'),
(844, '08', '2026', 6, '197408122014062001', 'Vitta Adi Rosewaty Jengkar', '3375035208740005', 'Pengadministrasi Perkantoran', '5', 'II/c', 'pns', 'Normal', 100.00, 1809207.00, 1809207.00, 723682.00, 1085525.00, 325657.00, 542762.00, 217106.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1809207.00, 0.00, 0.00, 1809207.00, 4147150.00, 18092.00, 1791115.00, 1, '2026-09-23 17:51:20', '2026-09-23 17:53:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gaji_induk_pns`
--
ALTER TABLE `gaji_induk_pns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gaji_induk_pns_pegawai_id_foreign` (`pegawai_id`);

--
-- Indexes for table `gaji_induk_pppk`
--
ALTER TABLE `gaji_induk_pppk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gaji_induk_pppk_pegawai_id_foreign` (`pegawai_id`);

--
-- Indexes for table `gaji_induk_pppk_paruh_waktu`
--
ALTER TABLE `gaji_induk_pppk_paruh_waktu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gaji_induk_pppk_paruh_waktu_pegawai_id_foreign` (`pegawai_id`);

--
-- Indexes for table `gaji_tambahan_pns`
--
ALTER TABLE `gaji_tambahan_pns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gaji_tambahan_pns_pegawai_id_foreign` (`pegawai_id`);

--
-- Indexes for table `gaji_tambahan_pppk`
--
ALTER TABLE `gaji_tambahan_pppk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gaji_tambahan_pppk_pegawai_id_foreign` (`pegawai_id`);

--
-- Indexes for table `gaji_tambahan_pppk_paruh_waktu`
--
ALTER TABLE `gaji_tambahan_pppk_paruh_waktu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gaji_tambahan_pppk_paruh_waktu_pegawai_id_foreign` (`pegawai_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagu_anggarans`
--
ALTER TABLE `pagu_anggarans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payroll_gaji_induk`
--
ALTER TABLE `payroll_gaji_induk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payroll_gaji_induk_payroll_periode_id_foreign` (`payroll_periode_id`),
  ADD KEY `payroll_gaji_induk_pegawai_id_foreign` (`pegawai_id`);

--
-- Indexes for table `payroll_periode`
--
ALTER TABLE `payroll_periode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll_rapel`
--
ALTER TABLE `payroll_rapel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payroll_rapel_pegawai_id_foreign` (`pegawai_id`);

--
-- Indexes for table `payroll_rapel_detail`
--
ALTER TABLE `payroll_rapel_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payroll_rapel_detail_payroll_rapel_id_foreign` (`payroll_rapel_id`);

--
-- Indexes for table `payroll_tpp`
--
ALTER TABLE `payroll_tpp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payroll_tpp_payroll_periode_id_foreign` (`payroll_periode_id`),
  ADD KEY `payroll_tpp_pegawai_id_foreign` (`pegawai_id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pegawai_nip_unique` (`nip`),
  ADD KEY `pegawai_ref_jabatan_id_foreign` (`ref_jabatan_id`);

--
-- Indexes for table `pegawai_anak`
--
ALTER TABLE `pegawai_anak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pegawai_anak_pegawai_id_foreign` (`pegawai_id`);

--
-- Indexes for table `pegawai_pasangan`
--
ALTER TABLE `pegawai_pasangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pegawai_pasangan_pegawai_id_foreign` (`pegawai_id`);

--
-- Indexes for table `pegawai_riwayat`
--
ALTER TABLE `pegawai_riwayat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pegawai_riwayat_ref_jabatan_id_foreign` (`ref_jabatan_id`),
  ADD KEY `pegawai_riwayat_pegawai_id_tmt_berlaku_index` (`pegawai_id`,`tmt_berlaku`);

--
-- Indexes for table `ref_gaji_pokok_pns`
--
ALTER TABLE `ref_gaji_pokok_pns`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ref_gaji_pokok_pns_golongan_mkg_unique` (`golongan`,`mkg`);

--
-- Indexes for table `ref_gaji_pokok_pppk`
--
ALTER TABLE `ref_gaji_pokok_pppk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ref_gaji_pokok_pppk_golongan_mkg_unique` (`golongan`,`mkg`);

--
-- Indexes for table `ref_jabatan`
--
ALTER TABLE `ref_jabatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ref_jabatan_ref_kelas_jabatan_id_foreign` (`ref_kelas_jabatan_id`);

--
-- Indexes for table `ref_kelas_jabatan`
--
ALTER TABLE `ref_kelas_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_tunjangan_umum`
--
ALTER TABLE `ref_tunjangan_umum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tpp`
--
ALTER TABLE `tpp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tpp_pegawai_id_foreign` (`pegawai_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gaji_induk_pns`
--
ALTER TABLE `gaji_induk_pns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=552;

--
-- AUTO_INCREMENT for table `gaji_induk_pppk`
--
ALTER TABLE `gaji_induk_pppk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `gaji_induk_pppk_paruh_waktu`
--
ALTER TABLE `gaji_induk_pppk_paruh_waktu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `gaji_tambahan_pns`
--
ALTER TABLE `gaji_tambahan_pns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `gaji_tambahan_pppk`
--
ALTER TABLE `gaji_tambahan_pppk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `gaji_tambahan_pppk_paruh_waktu`
--
ALTER TABLE `gaji_tambahan_pppk_paruh_waktu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `pagu_anggarans`
--
ALTER TABLE `pagu_anggarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `payroll_gaji_induk`
--
ALTER TABLE `payroll_gaji_induk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll_periode`
--
ALTER TABLE `payroll_periode`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll_rapel`
--
ALTER TABLE `payroll_rapel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll_rapel_detail`
--
ALTER TABLE `payroll_rapel_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll_tpp`
--
ALTER TABLE `payroll_tpp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `pegawai_anak`
--
ALTER TABLE `pegawai_anak`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `pegawai_pasangan`
--
ALTER TABLE `pegawai_pasangan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pegawai_riwayat`
--
ALTER TABLE `pegawai_riwayat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `ref_gaji_pokok_pns`
--
ALTER TABLE `ref_gaji_pokok_pns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=537;

--
-- AUTO_INCREMENT for table `ref_gaji_pokok_pppk`
--
ALTER TABLE `ref_gaji_pokok_pppk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=537;

--
-- AUTO_INCREMENT for table `ref_jabatan`
--
ALTER TABLE `ref_jabatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `ref_kelas_jabatan`
--
ALTER TABLE `ref_kelas_jabatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ref_tunjangan_umum`
--
ALTER TABLE `ref_tunjangan_umum`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tpp`
--
ALTER TABLE `tpp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=845;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gaji_induk_pns`
--
ALTER TABLE `gaji_induk_pns`
  ADD CONSTRAINT `gaji_induk_pns_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gaji_induk_pppk`
--
ALTER TABLE `gaji_induk_pppk`
  ADD CONSTRAINT `gaji_induk_pppk_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gaji_induk_pppk_paruh_waktu`
--
ALTER TABLE `gaji_induk_pppk_paruh_waktu`
  ADD CONSTRAINT `gaji_induk_pppk_paruh_waktu_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gaji_tambahan_pns`
--
ALTER TABLE `gaji_tambahan_pns`
  ADD CONSTRAINT `gaji_tambahan_pns_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gaji_tambahan_pppk`
--
ALTER TABLE `gaji_tambahan_pppk`
  ADD CONSTRAINT `gaji_tambahan_pppk_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gaji_tambahan_pppk_paruh_waktu`
--
ALTER TABLE `gaji_tambahan_pppk_paruh_waktu`
  ADD CONSTRAINT `gaji_tambahan_pppk_paruh_waktu_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payroll_gaji_induk`
--
ALTER TABLE `payroll_gaji_induk`
  ADD CONSTRAINT `payroll_gaji_induk_payroll_periode_id_foreign` FOREIGN KEY (`payroll_periode_id`) REFERENCES `payroll_periode` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payroll_gaji_induk_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payroll_rapel`
--
ALTER TABLE `payroll_rapel`
  ADD CONSTRAINT `payroll_rapel_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payroll_rapel_detail`
--
ALTER TABLE `payroll_rapel_detail`
  ADD CONSTRAINT `payroll_rapel_detail_payroll_rapel_id_foreign` FOREIGN KEY (`payroll_rapel_id`) REFERENCES `payroll_rapel` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payroll_tpp`
--
ALTER TABLE `payroll_tpp`
  ADD CONSTRAINT `payroll_tpp_payroll_periode_id_foreign` FOREIGN KEY (`payroll_periode_id`) REFERENCES `payroll_periode` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payroll_tpp_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ref_jabatan_id_foreign` FOREIGN KEY (`ref_jabatan_id`) REFERENCES `ref_jabatan` (`id`);

--
-- Constraints for table `pegawai_anak`
--
ALTER TABLE `pegawai_anak`
  ADD CONSTRAINT `pegawai_anak_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pegawai_pasangan`
--
ALTER TABLE `pegawai_pasangan`
  ADD CONSTRAINT `pegawai_pasangan_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pegawai_riwayat`
--
ALTER TABLE `pegawai_riwayat`
  ADD CONSTRAINT `pegawai_riwayat_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pegawai_riwayat_ref_jabatan_id_foreign` FOREIGN KEY (`ref_jabatan_id`) REFERENCES `ref_jabatan` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `ref_jabatan`
--
ALTER TABLE `ref_jabatan`
  ADD CONSTRAINT `ref_jabatan_ref_kelas_jabatan_id_foreign` FOREIGN KEY (`ref_kelas_jabatan_id`) REFERENCES `ref_kelas_jabatan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tpp`
--
ALTER TABLE `tpp`
  ADD CONSTRAINT `tpp_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
