-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2014 at 06:10 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `collection`
--

-- --------------------------------------------------------

--
-- Table structure for table `ach_transactions`
--

CREATE TABLE IF NOT EXISTS `ach_transactions` (
  `id` char(36) NOT NULL,
  `transaction_id` char(36) NOT NULL,
  `transaction_type` enum('credit','debit') DEFAULT NULL,
  `company_entry_description` varchar(10) NOT NULL,
  `standard_entry_class_code` enum('ppd','ccd','web','tel','boc') NOT NULL,
  `check_number` mediumint(8) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_transaction_id_ach_trasactions` (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Contains Customers Ach Transactions';

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE IF NOT EXISTS `api_keys` (
  `id` varchar(36) NOT NULL,
  `merchant_id` int(9) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_merchant_id_api_keys` (`merchant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `api_keys`
--

INSERT INTO `api_keys` (`id`, `merchant_id`) VALUES
('5344bf07-4994-4a54-a02a-2c7c6aac1de6', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE IF NOT EXISTS `bank_accounts` (
  `id` char(36) NOT NULL,
  `payment_account_id` char(36) NOT NULL,
  `encrypted_data` char(36) NOT NULL,
  `routing_number` char(9) NOT NULL,
  `account_number_last_four_digits` char(4) NOT NULL,
  `account_type` enum('savings','checking') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_payment_accounts_id_bank_accounts` (`payment_account_id`),
  KEY `fk_bank_accounts_encrypted_id_bank_accounts` (`encrypted_data`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Contains Customers Payment Account.';

--
-- Triggers `bank_accounts`
--
DROP TRIGGER IF EXISTS `before_insert_bank_accounts`;
DELIMITER //
CREATE TRIGGER `before_insert_bank_accounts` BEFORE INSERT ON `bank_accounts`
 FOR EACH ROW BEGIN
	IF EXISTS (
		SELECT payment_account_id
		FROM debit_cards
		WHERE  payment_account_id = NEW.payment_account_id)
		THEN
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Error: payment_account_id already exists in `collection`.`debit_cards`';
	ELSEIF  EXISTS (
		SELECT payment_account_id
		FROM credit_cards
		WHERE payment_account_id= NEW.payment_account_id)
		THEN
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Error: Payment Account  already exists in `collection`.`credit_cards`';

	END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts_encrypted`
--

CREATE TABLE IF NOT EXISTS `bank_accounts_encrypted` (
  `id` char(36) NOT NULL,
  `datum` blob NOT NULL COMMENT 'json array with keys account_number, customer_name',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Contains Customers Payment Account.';

-- --------------------------------------------------------

--
-- Table structure for table `ccd`
--

CREATE TABLE IF NOT EXISTS `ccd` (
  `ach_transaction_id` char(36) NOT NULL,
  `transaction_code` char(2) NOT NULL,
  `routing_number` char(9) NOT NULL,
  `account_number` varchar(17) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `name` varchar(22) NOT NULL,
  `discretionary_data` char(2) DEFAULT NULL,
  PRIMARY KEY (`ach_transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Contains Customers Ach Transactions Type CCD';

-- --------------------------------------------------------

--
-- Table structure for table `credit_cards`
--

CREATE TABLE IF NOT EXISTS `credit_cards` (
  `id` char(36) NOT NULL,
  `payment_account_id` char(36) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_payment_accounts_id_credit_cards` (`payment_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Contains Customers Payment Account. Type Credit Card';

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` char(36) NOT NULL,
  `merchant_id` mediumint(9) unsigned NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'Encrypted',
  `email` varchar(255) DEFAULT NULL COMMENT 'Encrypted',
  `mobile_phone` varchar(255) DEFAULT NULL COMMENT 'Encrypted',
  `work_phone` varchar(255) DEFAULT NULL COMMENT 'Encrypted',
  `default_payment_account` varchar(255) DEFAULT NULL COMMENT 'Encrypted',
  `active` enum('yes','no') DEFAULT 'yes',
  `creation_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_merchant_id_customers` (`merchant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `merchant_id`, `name`, `email`, `mobile_phone`, `work_phone`, `default_payment_account`, `active`, `creation_time`) VALUES
('53b3c530-9cc0-495a-b1fd-32c06aac1de6', 1, 'Ashley', NULL, '9841374040', NULL, NULL, 'yes', NULL),
('53b674df-d600-4dbf-97d0-14806aac1de6', 1, 'Ashley', NULL, '9841374040', NULL, NULL, 'yes', NULL),
('53b678b5-a3f0-41dd-af25-14806aac1de6', 1, 'Ashley', NULL, '9841374040', NULL, NULL, 'yes', NULL),
('53b67915-7b64-4f1e-98d4-14806aac1de6', 1, 'Ashley', NULL, '9841374040', NULL, NULL, 'yes', NULL),
('53b67bda-7f90-4bc4-a45b-14806aac1de6', 1, 'Ashley', NULL, '9841374040', NULL, NULL, 'yes', NULL),
('53b8cc4e-5dec-43d1-8670-14806aac1de6', 1, 'Ashley', NULL, '9841374040', NULL, NULL, 'yes', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `debit_cards`
--

CREATE TABLE IF NOT EXISTS `debit_cards` (
  `id` char(36) NOT NULL,
  `payment_account_id` char(36) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_payment_accounts_id_debit_cards` (`payment_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Contains Customers Payment Account. Type Debit Card';

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE IF NOT EXISTS `holidays` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `holiday` date NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `holiday` (`holiday`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `merchants`
--

CREATE TABLE IF NOT EXISTS `merchants` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `merchants_data_id` mediumint(9) unsigned NOT NULL,
  `active` enum('yes','no') DEFAULT 'no',
  PRIMARY KEY (`id`),
  KEY `fk_merchants_data_id` (`merchants_data_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Contains Merchants ID' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `merchants`
--

INSERT INTO `merchants` (`id`, `merchants_data_id`, `active`) VALUES
(1, 1, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `merchants_data`
--

CREATE TABLE IF NOT EXISTS `merchants_data` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `active` enum('yes','no') DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Contains Merchants Information' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `merchants_data`
--

INSERT INTO `merchants_data` (`id`, `name`, `active`) VALUES
(1, 'Test', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `payment_accounts`
--

CREATE TABLE IF NOT EXISTS `payment_accounts` (
  `id` char(36) NOT NULL,
  `customer_id` char(36) NOT NULL,
  `subtype` enum('bank_accounts','credit_cards','debit_cards') DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_customer_id_payment_accounts` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Contains Customers Payment Account.';

-- --------------------------------------------------------

--
-- Table structure for table `pending_merchants`
--

CREATE TABLE IF NOT EXISTS `pending_merchants` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dba` varchar(255) DEFAULT NULL,
  `federal_tax_id` varchar(50) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `naics` varchar(255) DEFAULT NULL,
  `allow_customer_credit` enum('true','false') DEFAULT 'false',
  `expected_trans_per_month` mediumint(9) NOT NULL,
  `expected_average_amount` mediumint(9) NOT NULL,
  `lowest_amount_allowed` mediumint(9) NOT NULL,
  `highest_amount_allowed` mediumint(9) NOT NULL,
  `check_for_duplicates` enum('true','false') DEFAULT 'false',
  `partner_approved_tier` varchar(255) DEFAULT NULL,
  `routing` varchar(255) DEFAULT NULL,
  `account` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `support_contact_name` varchar(255) DEFAULT NULL,
  `support_contact_email` varchar(255) DEFAULT NULL,
  `support_contact_phone` varchar(255) DEFAULT NULL,
  `principal_name` varchar(255) DEFAULT NULL,
  `principal_address1` varchar(255) DEFAULT NULL,
  `principal_address2` varchar(255) DEFAULT NULL,
  `principal_city` varchar(255) DEFAULT NULL,
  `principal_state` varchar(255) DEFAULT NULL,
  `principal_zip` varchar(255) DEFAULT NULL,
  `principal_phone` varchar(255) DEFAULT NULL,
  `principal_email` varchar(255) DEFAULT NULL,
  `account_executive_name` varchar(255) DEFAULT NULL,
  `account_executive_phone` varchar(255) DEFAULT NULL,
  `account_executive_email` varchar(255) DEFAULT NULL,
  `standard_entry_classes` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pending_merchants`
--

INSERT INTO `pending_merchants` (`id`, `name`, `dba`, `federal_tax_id`, `phone`, `fax`, `website`, `naics`, `allow_customer_credit`, `expected_trans_per_month`, `expected_average_amount`, `lowest_amount_allowed`, `highest_amount_allowed`, `check_for_duplicates`, `partner_approved_tier`, `routing`, `account`, `type`, `address1`, `address2`, `city`, `state`, `zip`, `support_contact_name`, `support_contact_email`, `support_contact_phone`, `principal_name`, `principal_address1`, `principal_address2`, `principal_city`, `principal_state`, `principal_zip`, `principal_phone`, `principal_email`, `account_executive_name`, `account_executive_phone`, `account_executive_email`, `standard_entry_classes`) VALUES
('53ba27da-330c-4b54-a662-14806aac1de6', 'Acme Sportswear Inc', 'Acme Sports', '837273270', '532-623-7543', '254-235-4543', 'acmesportswear.com', '324632', '', 2000, 150, 1, 600, 'true', 'green', '143367854', '7384323245352', 'checking', '235 Coconut Drive', 'Suite 432', 'Atlanta', 'GA', '30308', 'Adam Smith', 'support@acmesportswear.com', '134-242-6342', 'Bob Damon', '352 Windy Drive', '', 'Dunwoody', 'GA', '30082', '342-253-4563', 'bob.damon@acmesportswear.com', 'Jack Davis', '432-635-1254', 'jack.davis@mercurypay.com', 'CCD'),
('53ba2b50-8a4c-4123-a739-14806aac1de6', 'Acme Sportswear Inc123', 'Acme Sports123', '837273270', '532-623-7543', '254-235-4543', 'acmesportswear.com', '324632', '', 2000, 150, 1, 600, 'true', 'green', '143367854', '7384323245352', 'checking', '235 Coconut Drive', 'Suite 432', 'Atlanta', 'GA', '30308', 'Adam Smith', 'support@acmesportswear.com', '134-242-6342', 'Bob Damon', '352 Windy Drive', '', 'Dunwoody', 'GA', '30082', '342-253-4563', 'bob.damon@acmesportswear.com', 'Jack Davis', '432-635-1254', 'jack.davis@mercurypay.com', 'CCD'),
('53ba2b92-0628-4cc6-93f6-14806aac1de6', 'Acme Sportswear Inc123', 'Acme Sports123', '837273270', '532-623-7543', '254-235-4543', 'acmesportswear.com', '324632', '', 2000, 150, 1, 600, 'true', 'green', '143367854', '7384323245352', 'checking', '235 Coconut Drive', 'Suite 432', 'Atlanta', 'GA', '30308', 'Adam Smith', 'support@acmesportswear.com', '134-242-6342', 'Bob Damon', '352 Windy Drive', '', 'Dunwoody', 'GA', '30082', '342-253-4563', 'bob.damon@acmesportswear.com', 'Jack Davis', '432-635-1254', 'jack.davis@mercurypay.com', 'CCD'),
('53ba2bac-7f24-4fae-9791-14806aac1de6', 'Acme Sportswear Inc123', 'Acme Sports123', '837273270', '532-623-7543', '254-235-4543', 'acmesportswear.com', '324632', '', 2000, 150, 1, 600, 'true', 'green', '143367854', '7384323245352', 'checking', '235 Coconut Drive', 'Suite 432', 'Atlanta', 'GA', '30308', 'Adam Smith', 'support@acmesportswear.com', '134-242-6342', 'Bob Damon', '352 Windy Drive', '', 'Dunwoody', 'GA', '30082', '342-253-4563', 'bob.damon@acmesportswear.com', 'Jack Davis', '432-635-1254', 'jack.davis@mercurypay.com', 'CCD'),
('53ba2bba-efcc-4cd2-adf2-14806aac1de6', 'Acme Sportswear Inc123', 'Acme Sports123', '837273270', '532-623-7543', '254-235-4543', 'acmesportswear.com', '324632', '', 2000, 150, 1, 600, 'true', 'green', '143367854', '7384323245352', 'checking', '235 Coconut Drive', 'Suite 432', 'Atlanta', 'GA', '30308', 'Adam Smith', 'support@acmesportswear.com', '134-242-6342', 'Bob Damon', '352 Windy Drive', '', 'Dunwoody', 'GA', '30082', '342-253-4563', 'bob.damon@acmesportswear.com', 'Jack Davis', '432-635-1254', 'jack.davis@mercurypay.com', 'CCD'),
('53ba2bc7-d5dc-4ea1-b0f1-14806aac1de6', 'Acme Sportswear Inc123', 'Acme Sports123', '837273270', '532-623-7543', '254-235-4543', 'acmesportswear.com', '324632', '', 2000, 150, 1, 600, 'true', 'green', '143367854', '7384323245352', 'checking', '235 Coconut Drive', 'Suite 432', 'Atlanta', 'GA', '30308', 'Adam Smith', 'support@acmesportswear.com', '134-242-6342', 'Bob Damon', '352 Windy Drive', '', 'Dunwoody', 'GA', '30082', '342-253-4563', 'bob.damon@acmesportswear.com', 'Jack Davis', '432-635-1254', 'jack.davis@mercurypay.com', 'CCD'),
('53ba2bff-d818-466a-8595-14806aac1de6', 'Acme Sportswear Inc123', 'Acme Sports123', '837273270', '532-623-7543', '254-235-4543', 'acmesportswear.com', '324632', '', 2000, 150, 1, 600, 'true', 'green', '143367854', '7384323245352', 'checking', '235 Coconut Drive', 'Suite 432', 'Atlanta', 'GA', '30308', 'Adam Smith', 'support@acmesportswear.com', '134-242-6342', 'Bob Damon', '352 Windy Drive', '', 'Dunwoody', 'GA', '30082', '342-253-4563', 'bob.damon@acmesportswear.com', 'Jack Davis', '432-635-1254', 'jack.davis@mercurypay.com', 'CCD'),
('53ba2c2c-6cc4-4118-ae0a-14806aac1de6', 'Acme Sportswear Inc123', 'Acme Sports123', '837273270', '532-623-7543', '254-235-4543', 'acmesportswear.com', '324632', '', 2000, 150, 1, 600, 'true', 'green', '143367854', '7384323245352', 'checking', '235 Coconut Drive', 'Suite 432', 'Atlanta', 'GA', '30308', 'Adam Smith', 'support@acmesportswear.com', '134-242-6342', 'Bob Damon', '352 Windy Drive', '', 'Dunwoody', 'GA', '30082', '342-253-4563', 'bob.damon@acmesportswear.com', 'Jack Davis', '432-635-1254', 'jack.davis@mercurypay.com', 'CCD'),
('53ba2c96-fefc-4bb4-860f-14806aac1de6', 'Acme Sportswear Inc123', 'Acme Sports123', '837273270', '532-623-7543', '254-235-4543', 'acmesportswear.com', '324632', '', 2000, 150, 1, 600, 'true', 'green', '143367854', '7384323245352', 'checking', '235 Coconut Drive', 'Suite 432', 'Atlanta', 'GA', '30308', 'Adam Smith', 'support@acmesportswear.com', '134-242-6342', 'Bob Damon', '352 Windy Drive', '', 'Dunwoody', 'GA', '30082', '342-253-4563', 'bob.damon@acmesportswear.com', 'Jack Davis', '432-635-1254', 'jack.davis@mercurypay.com', 'CCD'),
('53ba2cd9-5fc0-4de1-b0e0-14806aac1de6', 'Acme Sportswear Inc123', 'Acme Sports123', '837273270', '532-623-7543', '254-235-4543', 'acmesportswear.com', '324632', '', 2000, 150, 1, 600, 'true', 'green', '143367854', '7384323245352', 'checking', '235 Coconut Drive', 'Suite 432', 'Atlanta', 'GA', '30308', 'Adam Smith', 'support@acmesportswear.com', '134-242-6342', 'Bob Damon', '352 Windy Drive', '', 'Dunwoody', 'GA', '30082', '342-253-4563', 'bob.damon@acmesportswear.com', 'Jack Davis', '432-635-1254', 'jack.davis@mercurypay.com', 'CCD'),
('53ba2d08-3e34-4c77-a175-14806aac1de6', 'Acme Sportswear Inc123', 'Acme Sports123', '837273270', '532-623-7543', '254-235-4543', 'acmesportswear.com', '324632', '', 2000, 150, 1, 600, 'true', 'green', '143367854', '7384323245352', 'checking', '235 Coconut Drive', 'Suite 432', 'Atlanta', 'GA', '30308', 'Adam Smith', 'support@acmesportswear.com', '134-242-6342', 'Bob Damon', '352 Windy Drive', '', 'Dunwoody', 'GA', '30082', '342-253-4563', 'bob.damon@acmesportswear.com', 'Jack Davis', '432-635-1254', 'jack.davis@mercurypay.com', 'CCD'),
('53ba31b5-9190-47fe-bbad-14806aac1de6', 'Acme Sportswear Inc123', 'Acme Sports123', '837273270', '532-623-7543', '254-235-4543', 'acmesportswear.com', '324632', '', 2000, 150, 1, 600, 'true', 'green', '143367854', '7384323245352', 'checking', '235 Coconut Drive', 'Suite 432', 'Atlanta', 'GA', '30308', 'Adam Smith', 'support@acmesportswear.com', '134-242-6342', 'Bob Damon', '352 Windy Drive', '', 'Dunwoody', 'GA', '30082', '342-253-4563', 'bob.damon@acmesportswear.com', 'Jack Davis', '432-635-1254', 'jack.davis@mercurypay.com', 'CCD'),
('53ba320b-3e44-41b5-ab17-14806aac1de6', 'Acme Sportswear Inc123', 'Acme Sports123', '837273270', '532-623-7543', '254-235-4543', 'acmesportswear.com', '324632', 'false', 2000, 150, 1, 600, 'true', 'green', '143367854', '7384323245352', 'checking', '235 Coconut Drive', 'Suite 432', 'Atlanta', 'GA', '30308', 'Adam Smith', 'support@acmesportswear.com', '134-242-6342', 'Bob Damon', '352 Windy Drive', '', 'Dunwoody', 'GA', '30082', '342-253-4563', 'bob.damon@acmesportswear.com', 'Jack Davis', '432-635-1254', 'jack.davis@mercurypay.com', 'CCD'),
('53ba3226-5a24-4eaf-8e9a-14806aac1de6', 'Acme Sportswear Inc123', 'Acme Sports123', '837273270', '532-623-7543', '254-235-4543', 'acmesportswear.com', '324632', 'false', 2000, 150, 1, 600, 'true', 'green', '143367854', '7384323245352', 'checking', '235 Coconut Drive', 'Suite 432', 'Atlanta', 'GA', '30308', 'Adam Smith', 'support@acmesportswear.com', '134-242-6342', 'Bob Damon', '352 Windy Drive', '', 'Dunwoody', 'GA', '30082', '342-253-4563', 'bob.damon@acmesportswear.com', 'Jack Davis', '432-635-1254', 'jack.davis@mercurypay.com', 'CCD'),
('53e192ef-34d4-4083-9485-10a06aac1de6', 'Acme Sportswear Inc', 'Acme Sports', '837273270', '532-623-7543', '254-235-4543', 'acmesportswear.com', '324632', '', 2000, 150, 1, 600, 'true', 'green', '143367854', '7384323245352', 'checking', '235 Coconut Drive', 'Suite 432', 'Atlanta', 'GA', '30308', 'Adam Smith', 'support@acmesportswear.com', '134-242-6342', 'Bob Damon', '352 Windy Drive', '', 'Dunwoody', 'GA', '30082', '342-253-4563', 'bob.damon@acmesportswear.com', 'Jack Davis', '432-635-1254', 'jack.davis@mercurypay.com', 'CCD');

-- --------------------------------------------------------

--
-- Table structure for table `ppd`
--

CREATE TABLE IF NOT EXISTS `ppd` (
  `ach_transaction_id` char(36) NOT NULL,
  `transaction_code` char(2) NOT NULL,
  `routing_number` char(9) NOT NULL,
  `account_number` varchar(17) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `name` varchar(22) NOT NULL,
  `discretionary_data` char(2) DEFAULT NULL,
  PRIMARY KEY (`ach_transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Contains Customers Ach Transactions Type PPD';

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `id` char(36) NOT NULL,
  `elapsed_microtime` int(10) unsigned DEFAULT NULL COMMENT 'Microtime difference  before any action is performed and before control is passed to view',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `elapsed_microtime`) VALUES
('53b22fc3-46b4-4980-ab26-32c06aac1de6', 0),
('53b2305c-846c-4df4-bf79-32c06aac1de6', 0),
('53b3733d-fce0-4b7a-ba32-32c06aac1de6', 0),
('53b3735c-4438-4de8-ace6-32c06aac1de6', 0),
('53b378f5-fc44-4733-899f-32c06aac1de6', 0),
('53b38ddf-7e04-4501-92be-32c06aac1de6', 0),
('53b38eef-e7c0-4931-8bec-32c06aac1de6', 0),
('53b38f62-3f70-403d-961e-32c06aac1de6', 0),
('53b38f7b-0d5c-4981-afaa-32c06aac1de6', 0),
('53b38ffd-aca0-4cef-93d2-32c06aac1de6', 0),
('53b3908a-4044-4df7-b359-32c06aac1de6', 0),
('53b3909b-1184-47f7-9af8-32c06aac1de6', 0),
('53b392a7-b490-4407-a6c0-32c06aac1de6', 0),
('53b39312-2f38-4427-8915-32c06aac1de6', 0),
('53b39388-6828-4233-a11e-32c06aac1de6', 0),
('53b39462-2620-4ae8-b4f8-32c06aac1de6', 0),
('53b3961b-2198-44f5-9c1e-32c06aac1de6', 0),
('53b39634-7f0c-41ba-990f-32c06aac1de6', 0),
('53b396bd-f06c-4781-8f4f-32c06aac1de6', 0),
('53b3bced-dbbc-4e76-9746-32c06aac1de6', 0),
('53b3c010-32d8-4ca3-b1ac-32c06aac1de6', 0),
('53b3c03f-1120-4438-8ab7-32c06aac1de6', 0),
('53b3c04f-c948-4bfa-b10f-32c06aac1de6', 0),
('53b3c060-852c-4d92-a7d3-32c06aac1de6', 0),
('53b3c0a1-4054-47c0-a73b-32c06aac1de6', 0),
('53b3c0b6-0dd4-40d7-bf6e-32c06aac1de6', 0),
('53b3c0e5-7be4-4f4e-b2f9-32c06aac1de6', 0),
('53b3c143-d364-441d-aff1-32c06aac1de6', 0),
('53b3c14e-c9cc-4522-85b6-32c06aac1de6', 0),
('53b3c176-4ffc-4c89-8d41-32c06aac1de6', 0),
('53b3c198-1028-4926-a1a0-32c06aac1de6', 0),
('53b3c1a5-9610-416d-8521-32c06aac1de6', 0),
('53b3c1f6-e3c4-4d04-93dc-32c06aac1de6', 0),
('53b3c2a7-3150-40c6-b4d8-32c06aac1de6', 0),
('53b3c2a7-d534-45f3-a583-32c06aac1de6', 0),
('53b3c303-2bb0-4366-a693-32c06aac1de6', 0),
('53b3c303-4a5c-4d0d-b9eb-32c06aac1de6', 0),
('53b3c395-ec68-41a0-bd90-32c06aac1de6', 0),
('53b3c3c2-c38c-42ba-b0dd-32c06aac1de6', 0),
('53b3c3d0-23b8-4c72-9deb-32c06aac1de6', 0),
('53b3c3ec-d97c-4d0e-bd6e-32c06aac1de6', 0),
('53b3c3ed-034c-455e-b7e8-32c06aac1de6', 0),
('53b3c40f-06fc-4bd9-983d-32c06aac1de6', 0),
('53b3c410-a378-434a-abdd-32c06aac1de6', 0),
('53b3c435-6040-45e4-ab95-32c06aac1de6', 0),
('53b3c435-806c-45e7-b544-32c06aac1de6', 0),
('53b3c451-c6c0-4657-97f0-32c06aac1de6', 0),
('53b3c452-eb98-4e78-b94d-32c06aac1de6', 0),
('53b3c489-a674-4428-b965-32c06aac1de6', 0),
('53b3c48a-79ac-4638-ae8a-32c06aac1de6', 0),
('53b3c493-94e0-46a3-9d01-32c06aac1de6', 0),
('53b3c493-f438-4d95-8a77-32c06aac1de6', 0),
('53b3c4ef-1c6c-4901-a8e3-32c06aac1de6', 0),
('53b3c4f0-be1c-40e3-ac31-32c06aac1de6', 0),
('53b3c530-09e8-45e1-85f3-32c06aac1de6', 0),
('53b3c530-f19c-4340-aa74-32c06aac1de6', 0),
('53b3c54d-8cc0-4344-bc6c-32c06aac1de6', 0),
('53b3c720-ffdc-48cb-8f43-32c06aac1de6', 0),
('53b5283c-3174-460f-bad6-14806aac1de6', 0),
('53b528c6-3dec-4a8f-ad9d-14806aac1de6', 0),
('53b529df-b07c-45fc-a9d1-14806aac1de6', 0),
('53b52a6e-b384-45f6-96da-14806aac1de6', 0),
('53b52af9-67ec-47d4-b154-14806aac1de6', 0),
('53b52c55-eb94-46e1-9030-14806aac1de6', 0),
('53b65071-ee80-4aa2-bd69-14806aac1de6', 0),
('53b650aa-d5b4-4ac3-9484-14806aac1de6', 0),
('53b650f6-4eac-4c7d-b5c7-14806aac1de6', 0),
('53b65129-983c-459f-8b01-14806aac1de6', 0),
('53b65177-f370-4ebe-bbfc-14806aac1de6', 0),
('53b651bc-d700-4125-8c63-14806aac1de6', 0),
('53b651f4-b090-45b0-8475-14806aac1de6', 0),
('53b652eb-db74-4a3b-adfc-14806aac1de6', 0),
('53b65318-ddfc-4462-949e-14806aac1de6', 0),
('53b653b3-0e20-4d5c-8a6f-14806aac1de6', 0),
('53b65404-2800-489d-a6d5-14806aac1de6', 0),
('53b65636-f058-423d-818c-14806aac1de6', 0),
('53b65778-a928-4ca3-8af3-14806aac1de6', 0),
('53b65867-ace8-407f-a291-14806aac1de6', 0),
('53b65876-bc40-4d79-a89f-14806aac1de6', 0),
('53b65880-1018-45af-8927-14806aac1de6', 0),
('53b65887-9aec-4cd2-817e-14806aac1de6', 0),
('53b65946-9284-4d90-adc3-14806aac1de6', 0),
('53b65952-a298-4c16-ae78-14806aac1de6', 0),
('53b65970-ef70-4bef-b626-14806aac1de6', 0),
('53b65979-f56c-4469-849b-14806aac1de6', 0),
('53b65985-f14c-442d-b886-14806aac1de6', 0),
('53b6598c-b274-4261-81ea-14806aac1de6', 0),
('53b65993-f998-4db7-99aa-14806aac1de6', 0),
('53b659a3-a668-495a-96a6-14806aac1de6', 0),
('53b659d3-5514-4178-a35b-14806aac1de6', 0),
('53b65a95-a4dc-4f57-a36f-14806aac1de6', 0),
('53b65aed-e760-49b9-88c6-14806aac1de6', 0),
('53b65b2d-9258-40b7-8f9d-14806aac1de6', 0),
('53b65bb3-19e8-420e-8ee2-14806aac1de6', 0),
('53b65be8-8abc-4185-a54e-14806aac1de6', 0),
('53b65bfd-ddd0-4930-a83e-14806aac1de6', 0),
('53b65c0e-98ac-4b84-8798-14806aac1de6', 0),
('53b65cd1-60e8-4aca-beb2-14806aac1de6', 0),
('53b65ce6-7c64-4f91-ad08-14806aac1de6', 0),
('53b65cf6-f028-48a1-97f1-14806aac1de6', 0),
('53b65e63-fcb0-4694-9d62-14806aac1de6', 0),
('53b65e8a-ea54-4e42-94f9-14806aac1de6', 0),
('53b66491-c09c-4e02-9633-14806aac1de6', 0),
('53b6655e-7f88-4463-883c-14806aac1de6', 0),
('53b667bc-6ed0-4d95-933f-14806aac1de6', 0),
('53b6680f-01cc-4e8e-a723-14806aac1de6', 0),
('53b66831-1b04-4846-b626-14806aac1de6', 0),
('53b66841-ae04-4fdf-8659-14806aac1de6', 0),
('53b6685a-0b88-4923-a995-14806aac1de6', 0),
('53b66885-b270-4d22-8dbd-14806aac1de6', 0),
('53b668bc-3318-4bbf-9a9e-14806aac1de6', 0),
('53b668ee-d898-4609-a8f9-14806aac1de6', 0),
('53b6693b-5950-43b8-acb5-14806aac1de6', 0),
('53b66bff-5280-4c52-8307-14806aac1de6', 0),
('53b66c65-cb78-4d00-b291-14806aac1de6', 0),
('53b66cbc-2ac0-42d8-8a0a-14806aac1de6', 0),
('53b66cdf-e6c0-449b-9d14-14806aac1de6', 0),
('53b66cfb-a364-4de4-8dd6-14806aac1de6', 0),
('53b66d3c-b720-4b29-b6b9-14806aac1de6', 0),
('53b66d4a-0a1c-493d-807f-14806aac1de6', 0),
('53b66d62-1870-4829-ab98-14806aac1de6', 0),
('53b66dc9-bccc-4747-a607-14806aac1de6', 0),
('53b66ddf-1338-4574-b00e-14806aac1de6', 0),
('53b66e07-7b0c-445b-b531-14806aac1de6', 0),
('53b66e2b-15a4-459c-8a1c-14806aac1de6', 0),
('53b66e41-f5c4-4098-a316-14806aac1de6', 0),
('53b66e5a-548c-4353-bb1c-14806aac1de6', 0),
('53b66e73-5138-4afa-af5f-14806aac1de6', 0),
('53b66eb0-a02c-4e34-9f5a-14806aac1de6', 0),
('53b66ec9-a404-4bcb-98a2-14806aac1de6', 0),
('53b66ee1-af80-4df6-b7b3-14806aac1de6', 0),
('53b66ee9-a1a4-4268-a393-14806aac1de6', 0),
('53b66f46-27f8-4c71-8cb9-14806aac1de6', 0),
('53b66fa6-d668-4374-93a6-14806aac1de6', 0),
('53b66ffe-9c14-480b-a99c-14806aac1de6', 0),
('53b67006-19d4-4b77-812d-14806aac1de6', 0),
('53b6701d-3708-424b-86e6-14806aac1de6', 0),
('53b6702c-31b8-493b-ae16-14806aac1de6', 0),
('53b6712e-92fc-46b9-9d69-14806aac1de6', 0),
('53b67167-aa90-45af-b04c-14806aac1de6', 0),
('53b67187-edac-4754-96fa-14806aac1de6', 0),
('53b6722f-544c-4cf9-9ac1-14806aac1de6', 0),
('53b67249-bc90-406f-80ed-14806aac1de6', 0),
('53b67255-bb38-472f-a56b-14806aac1de6', 0),
('53b67294-8fcc-4d0e-b972-14806aac1de6', 0),
('53b672d0-6234-4e0e-bab9-14806aac1de6', 0),
('53b6731c-dcbc-4971-90eb-14806aac1de6', 0),
('53b6734e-472c-4175-b769-14806aac1de6', 0),
('53b67369-83b0-43a1-8884-14806aac1de6', 0),
('53b67382-b3c8-407e-afb2-14806aac1de6', 0),
('53b67392-1e2c-45c7-b7f3-14806aac1de6', 0),
('53b6739e-6758-44c8-8981-14806aac1de6', 0),
('53b673a8-69f4-4ea2-9644-14806aac1de6', 0),
('53b67466-ba6c-4ffe-a95f-14806aac1de6', 0),
('53b674df-9ea4-4a3c-b5e9-14806aac1de6', 0),
('53b674e0-b16c-47c7-a2cc-14806aac1de6', 0),
('53b67505-1c94-4cdb-814e-14806aac1de6', 0),
('53b678b6-4798-4776-a591-14806aac1de6', 0),
('53b678c3-a5b0-46b7-8ace-14806aac1de6', 0),
('53b678f4-0ad0-4e6a-953f-14806aac1de6', 0),
('53b67901-b8d0-4d52-9fe4-14806aac1de6', 0),
('53b67915-54c0-4075-85ed-14806aac1de6', 0),
('53b67916-e5b8-43d9-8eed-14806aac1de6', 0),
('53b67979-28fc-4334-a8f2-14806aac1de6', 0),
('53b67ad7-92c0-47a3-838f-14806aac1de6', 0),
('53b67b0d-ab94-4a9e-80d2-14806aac1de6', 0),
('53b67b21-b560-4542-bf3f-14806aac1de6', 0),
('53b67b3a-5d1c-4e95-bc38-14806aac1de6', 0),
('53b67b4c-ab14-4a51-82c8-14806aac1de6', 0),
('53b67b80-2b04-4bec-8a0c-14806aac1de6', 0),
('53b67b91-ead8-448e-aaeb-14806aac1de6', 0),
('53b67ba1-68cc-4fc8-b939-14806aac1de6', 0),
('53b67bda-fc2c-4572-b5d0-14806aac1de6', 0),
('53b67c84-a64c-4920-bef0-14806aac1de6', 0),
('53b67c91-88e0-4ef2-ab1a-14806aac1de6', 0),
('53b67ce3-b738-432d-afd5-14806aac1de6', 0),
('53b67d1e-493c-4c6a-8034-14806aac1de6', 0),
('53b67d25-3bb0-49b1-9ffc-14806aac1de6', 0),
('53b67dc4-5024-44d6-9cb4-14806aac1de6', 0),
('53b8b6c9-66f4-4bd5-a342-14806aac1de6', 0),
('53b8b6db-7b84-4960-b783-14806aac1de6', 0),
('53b8b78a-c914-4731-8723-14806aac1de6', 0),
('53b8b805-4f80-457e-9528-14806aac1de6', 0),
('53b8b818-9d54-4b46-b1e5-14806aac1de6', 0),
('53b8b824-46f4-45fd-a414-14806aac1de6', 0),
('53b8b83f-cb7c-4d82-b006-14806aac1de6', 0),
('53b8c3f8-c180-4125-8afc-14806aac1de6', 0),
('53b8c430-75fc-4d9f-a55f-14806aac1de6', 0),
('53b8c457-e284-4417-9e96-14806aac1de6', 0),
('53b8c460-e1f4-4aac-af5d-14806aac1de6', 0),
('53b8c4f6-8404-4690-b68f-14806aac1de6', 0),
('53b8c510-84e4-43f9-869e-14806aac1de6', 0),
('53b8c6ea-3be8-4240-b79b-14806aac1de6', 0),
('53b8c6f3-bb08-4b87-b37f-14806aac1de6', 0),
('53b8c6fa-4a6c-433c-9c59-14806aac1de6', 0),
('53b8c702-a6f8-4776-86dc-14806aac1de6', 0),
('53b8c756-6874-4a44-9d4c-14806aac1de6', 0),
('53b8c75f-fdcc-4189-9017-14806aac1de6', 0),
('53b8c777-5ed8-4572-b82d-14806aac1de6', 0),
('53b8c787-fe3c-417a-a31f-14806aac1de6', 0),
('53b8c87d-5270-4242-9343-14806aac1de6', 0),
('53b8c87d-79b8-4ec3-a0ef-14806aac1de6', 0),
('53b8c8a3-eefc-4be4-b24a-14806aac1de6', 0),
('53b8c8a4-a0c4-4c46-bf91-14806aac1de6', 0),
('53b8c90e-b3f0-4783-890f-14806aac1de6', 0),
('53b8c90e-de74-4e5e-a3e1-14806aac1de6', 0),
('53b8c931-5108-4f73-9e8d-14806aac1de6', 0),
('53b8c931-d6a0-4461-aa42-14806aac1de6', 0),
('53b8c9ce-28e4-4bf4-8f0a-14806aac1de6', 0),
('53b8c9cf-a0dc-4448-a8d5-14806aac1de6', 0),
('53b8c9d7-5c38-460c-939d-14806aac1de6', 0),
('53b8c9d7-ce40-4831-94bf-14806aac1de6', 0),
('53b8ca4d-6bf8-47e4-8660-14806aac1de6', 0),
('53b8ca4e-a680-4989-9bfc-14806aac1de6', 0),
('53b8caaf-6210-4cc0-8878-14806aac1de6', 0),
('53b8caaf-d3a4-40ce-ad83-14806aac1de6', 0),
('53b8cbfe-911c-4882-8ce6-14806aac1de6', 0),
('53b8cc35-98a0-4a38-8d93-14806aac1de6', 0),
('53b8cc4e-6cac-424f-b529-14806aac1de6', 0),
('53b8cc4f-14ac-4076-8f76-14806aac1de6', 0),
('53b8cc60-6514-4b19-948a-14806aac1de6', 0),
('53b8cc60-8db0-4b9e-95c0-14806aac1de6', 0),
('53b8cd37-0800-490f-a445-14806aac1de6', 0),
('53b8cd37-12a8-4e88-b350-14806aac1de6', 0),
('53b8cd83-5898-4546-9a86-14806aac1de6', 0),
('53b8cd84-f19c-4e5a-b819-14806aac1de6', 0),
('53b8cda0-853c-477f-8b75-14806aac1de6', 0),
('53b8cda0-d754-4e53-ab7a-14806aac1de6', 0),
('53b8cda9-ce54-4eef-b14d-14806aac1de6', 0),
('53b8cdaa-dc24-47e1-94ba-14806aac1de6', 0),
('53b8cdc1-3bc0-4b77-9ab0-14806aac1de6', 0),
('53b8cdc1-ea98-47a4-9e60-14806aac1de6', 0),
('53b8cdfc-c74c-4cf4-9b99-14806aac1de6', 0),
('53b8cdfd-aeb4-494f-8612-14806aac1de6', 0),
('53b8ce03-db30-400a-853a-14806aac1de6', 0),
('53b8ce04-f484-4eda-8fdf-14806aac1de6', 0),
('53b8ce15-1c24-42b8-bd3f-14806aac1de6', 0),
('53b8ce15-f4dc-40d8-9b63-14806aac1de6', 0),
('53b8ce47-6f24-4dd0-8efb-14806aac1de6', 0),
('53b8ce47-d3dc-418e-969c-14806aac1de6', 0),
('53b8ce5c-0a7c-4eef-b45a-14806aac1de6', 0),
('53b8ce5d-d5a8-4fa4-bddf-14806aac1de6', 0),
('53b8ce63-5f84-43f0-bede-14806aac1de6', 0),
('53b8ce64-ff3c-4b56-94a4-14806aac1de6', 0),
('53b8ce74-3d50-4e4d-a880-14806aac1de6', 0),
('53b8ce74-d898-4733-bd1a-14806aac1de6', 0),
('53b8ce7f-e2e4-42c7-a089-14806aac1de6', 0),
('53b8ce80-5cd4-459b-b32d-14806aac1de6', 0),
('53b8cec3-3b8c-49e5-9247-14806aac1de6', 0),
('53b8cec4-1578-444b-88c8-14806aac1de6', 0),
('53b8cecc-5160-4e0f-84f0-14806aac1de6', 0),
('53b8cecc-947c-450c-9120-14806aac1de6', 0),
('53b8cef3-eee4-48d1-a027-14806aac1de6', 0),
('53b8cef4-5cec-4885-bb18-14806aac1de6', 0),
('53b8d0e7-8248-44d4-9f49-14806aac1de6', 0),
('53b8d0e8-4724-409a-9330-14806aac1de6', 0),
('53b8d0f0-cb24-4dfc-8f93-14806aac1de6', 0),
('53b8d0f1-5410-49e5-8182-14806aac1de6', 0),
('53b8d10d-5fcc-4128-9a3d-14806aac1de6', 0),
('53b8d10d-e528-43a7-b09d-14806aac1de6', 0),
('53b8d120-64ec-4f64-92c6-14806aac1de6', 0),
('53b8d120-ee24-4472-9856-14806aac1de6', 0),
('53b8d4eb-797c-40f4-a30d-14806aac1de6', 0),
('53ba26b9-d12c-410d-9610-14806aac1de6', 0),
('53ba26d1-c46c-4f15-8599-14806aac1de6', 0),
('53ba2712-3018-4bdf-9550-14806aac1de6', 0),
('53ba2747-83fc-4ae2-97ad-14806aac1de6', 0),
('53ba278d-51e4-4e38-875d-14806aac1de6', 0),
('53ba27da-9290-41c3-ba68-14806aac1de6', 0),
('53ba27da-e2ec-479f-ae24-14806aac1de6', 0),
('53ba287d-7f10-4304-9ab7-14806aac1de6', 0),
('53ba28c1-ba8c-472e-b1ed-14806aac1de6', 0),
('53ba28da-37c4-45ec-9b51-14806aac1de6', 0),
('53ba2904-6c24-4545-bdc6-14806aac1de6', 0),
('53ba290e-e9dc-4972-abcf-14806aac1de6', 0),
('53ba2944-afb8-48d1-a83c-14806aac1de6', 0),
('53ba2959-bab8-4675-ba71-14806aac1de6', 0),
('53ba2aa0-575c-4d57-beb8-14806aac1de6', 0),
('53ba2ad9-1174-4fb5-912a-14806aac1de6', 0),
('53ba2b18-b70c-4459-aeae-14806aac1de6', 0),
('53ba2b29-8498-432e-86a2-14806aac1de6', 0),
('53ba2b29-e950-4565-9f62-14806aac1de6', 0),
('53ba2b51-ba6c-452c-80e4-14806aac1de6', 0),
('53ba2b51-f6d4-4263-b233-14806aac1de6', 0),
('53ba2b92-9498-4a0f-8e20-14806aac1de6', 0),
('53ba2b93-7e20-409e-a172-14806aac1de6', 0),
('53ba2bac-6f74-4e0e-9f7b-14806aac1de6', 0),
('53ba2bac-fa04-4449-9f6b-14806aac1de6', 0),
('53ba2bba-e564-4297-8386-14806aac1de6', 0),
('53ba2bbb-c304-4fe7-b5a6-14806aac1de6', 0),
('53ba2bc8-6ee0-48df-9a16-14806aac1de6', 0),
('53ba2bc8-7b40-430f-93a1-14806aac1de6', 0),
('53ba2bff-43fc-47f6-aadc-14806aac1de6', 0),
('53ba2bff-7b98-4e00-9779-14806aac1de6', 0),
('53ba2c2c-4cd4-4116-8d9a-14806aac1de6', 0),
('53ba2c2d-e4bc-4cd1-ab6a-14806aac1de6', 0),
('53ba2c96-b74c-4c9a-862d-14806aac1de6', 0),
('53ba2c97-69b4-489a-b972-14806aac1de6', 0),
('53ba2cd9-71f8-4de8-b059-14806aac1de6', 0),
('53ba2cda-a138-4b94-a03e-14806aac1de6', 0),
('53ba2d09-0234-47e0-8195-14806aac1de6', 0),
('53ba2d09-ed60-43c0-bffe-14806aac1de6', 0),
('53ba31b5-b6e0-4e6f-8067-14806aac1de6', 0),
('53ba31b5-d550-4aaf-b037-14806aac1de6', 0),
('53ba320b-cabc-483e-aedd-14806aac1de6', 0),
('53ba320b-e45c-4f35-a5ed-14806aac1de6', 0),
('53ba3226-62d4-427d-8825-14806aac1de6', 0),
('53ba3226-fcc4-4bdd-ada5-14806aac1de6', 0),
('53e061df-7488-47a1-832e-10a06aac1de6', 0),
('53e06341-58cc-42eb-9257-10a06aac1de6', 0),
('53e06359-5898-49f1-85c0-10a06aac1de6', 0),
('53e063e9-1264-4575-a4e8-10a06aac1de6', 0),
('53e063fc-6a2c-45b6-8fe6-10a06aac1de6', 0),
('53e06547-e494-4ed8-ac2f-10a06aac1de6', 0),
('53e06554-a970-4041-8b2a-10a06aac1de6', 0),
('53e06562-30b8-4a66-b3dc-10a06aac1de6', 0),
('53e0656b-60d0-44c7-a774-10a06aac1de6', 0),
('53e0657f-e464-42c6-830b-10a06aac1de6', 0),
('53e0659f-1974-4c54-9ab0-10a06aac1de6', 0),
('53e065d4-50b4-48ef-b87b-10a06aac1de6', 0),
('53e065e6-f168-4c1f-8068-10a06aac1de6', 0),
('53e0674e-6688-40b8-8f46-10a06aac1de6', 0),
('53e067c8-76a4-47f8-80ec-10a06aac1de6', 0),
('53e0685b-6244-4cd2-ae37-10a06aac1de6', 0),
('53e0686d-02bc-4961-8182-10a06aac1de6', 0),
('53e06884-6cd0-4a1f-b73e-10a06aac1de6', 0),
('53e06897-7c84-40a7-bd57-10a06aac1de6', 0),
('53e07cb8-e884-4af5-8fa9-10a06aac1de6', 0),
('53e07d13-9088-4c97-b0da-10a06aac1de6', 0),
('53e07d25-04c0-4549-88e5-10a06aac1de6', 0),
('53e07d38-6a14-4fd9-99e1-10a06aac1de6', 0),
('53e07d85-a0bc-462a-82ce-10a06aac1de6', 0),
('53e07d8e-c9a8-436d-9c4e-10a06aac1de6', 0),
('53e07db0-54a8-4aa6-be6a-10a06aac1de6', 0),
('53e07fdd-22cc-483e-9c79-10a06aac1de6', 0),
('53e08000-3d34-4aae-a329-10a06aac1de6', 0),
('53e08010-b7b0-41e0-b086-10a06aac1de6', 0),
('53e08148-f28c-4e11-83aa-10a06aac1de6', 0),
('53e08593-65a8-42b9-9c43-10a06aac1de6', 0),
('53e085a7-2d48-4203-81e8-10a06aac1de6', 0),
('53e08688-c04c-4230-8cd6-10a06aac1de6', 0),
('53e08698-6bac-41e1-927e-10a06aac1de6', 0),
('53e088f3-8c18-40ff-bb5e-10a06aac1de6', 0),
('53e0893e-5550-4a08-a7d1-10a06aac1de6', 0),
('53e08944-6340-439c-9aa1-10a06aac1de6', 0),
('53e0894b-f854-4783-8cb4-10a06aac1de6', 0),
('53e08c24-e7dc-419a-99c1-10a06aac1de6', 0),
('53e08c2b-ecb4-4281-bae4-10a06aac1de6', 0),
('53e08e70-77c0-4456-a8b0-10a06aac1de6', 0),
('53e09053-99b4-4933-a8e3-10a06aac1de6', 0),
('53e09678-0340-4ed0-8ee6-10a06aac1de6', 0),
('53e0968d-6240-4bd6-8a3d-10a06aac1de6', 0),
('53e09757-8894-4460-84f0-10a06aac1de6', 0),
('53e09777-37d4-40ce-8203-10a06aac1de6', 0),
('53e097ba-8f48-4409-b19e-10a06aac1de6', 0),
('53e097db-2040-481a-bdcd-10a06aac1de6', 0),
('53e097f3-2f44-46d8-b1f6-10a06aac1de6', 0),
('53e0b855-30e4-4256-9260-10a06aac1de6', 0),
('53e0b8fc-0158-4b56-a898-10a06aac1de6', 0),
('53e0b914-fd70-4d9e-b593-10a06aac1de6', 0),
('53e0b91b-722c-4760-8974-10a06aac1de6', 0),
('53e19091-30a8-423d-8e67-10a06aac1de6', 0),
('53e190c4-2b9c-4c26-b83a-10a06aac1de6', 0),
('53e19213-8bf0-4a0c-9480-10a06aac1de6', 0),
('53e19231-7c94-4ab9-b2cc-10a06aac1de6', 0),
('53e19284-9d78-4915-bf94-10a06aac1de6', 0),
('53e192ad-d768-4b51-8f15-10a06aac1de6', 0),
('53e192d0-335c-4717-a911-10a06aac1de6', 0),
('53e192ef-16a0-4644-a58a-10a06aac1de6', 1),
('53e1931d-3bcc-4406-a7b9-10a06aac1de6', 0),
('53e19335-82d0-4fd3-aa91-10a06aac1de6', 0),
('53e19345-ee8c-4b6d-bb44-10a06aac1de6', 0),
('53e1a4e4-ac90-46a3-85f4-10a06aac1de6', 0),
('53e1a516-51d4-4ee7-8b3a-10a06aac1de6', 0),
('53e1b337-c13c-4caa-9971-10a06aac1de6', 0),
('53e1b41f-f394-4d13-a362-10a06aac1de6', 0),
('53e1b43b-ede4-4204-b568-10a06aac1de6', 0),
('53e1b442-930c-48f9-9edf-10a06aac1de6', 0),
('53e1b490-e2cc-42bc-800a-10a06aac1de6', 0),
('53e1b532-5140-4b71-8b52-10a06aac1de6', 0),
('53e1b6a3-a30c-4d65-a6f0-10a06aac1de6', 0),
('53e1b6e2-85ac-49b1-b9b0-10a06aac1de6', 0),
('53e1b6fb-4d84-4f86-9ef0-10a06aac1de6', 0),
('53e1b751-4524-432f-a08f-10a06aac1de6', 0),
('53e1b7b6-1170-492d-982b-10a06aac1de6', 0),
('53e2f5c8-cfd0-4fd2-b82d-10a06aac1de6', 0),
('53e2f5ec-d8c0-4e99-95e8-10a06aac1de6', 0),
('53e2f613-9590-4dc5-b18b-10a06aac1de6', 0),
('53e2f624-4904-43bf-b69d-10a06aac1de6', 0),
('53e2f639-fbd8-496a-8f8f-10a06aac1de6', 0),
('53e2f6b6-1ec8-4f74-92a5-10a06aac1de6', 0),
('53e2f6cb-80dc-4615-b37d-10a06aac1de6', 0),
('53e2f77a-be18-47d7-bbdb-10a06aac1de6', 0),
('53e2f78d-499c-4a80-8283-10a06aac1de6', 0),
('53e2f7f9-4eb4-4467-b4c5-10a06aac1de6', 0),
('53e2f810-33e8-4365-91a6-10a06aac1de6', 0),
('53e2f874-9a0c-441f-9c42-10a06aac1de6', 0),
('53e2fc8f-4098-4223-99ea-10a06aac1de6', 0),
('53e2fd01-c210-4e74-b0c3-10a06aac1de6', 0),
('53e2fd32-6d88-4662-bca1-10a06aac1de6', 0),
('53e2fd44-5a40-4f42-825e-10a06aac1de6', 0),
('53e2fd87-9760-42c2-8dcf-10a06aac1de6', 0),
('53e2fe02-81b4-4ad3-b605-10a06aac1de6', 0),
('53e305e7-2964-42ce-b813-10a06aac1de6', 0),
('53e30be5-e04c-4b6a-a7b6-10a06aac1de6', 0),
('53e326e8-7868-40ba-9942-10a06aac1de6', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` char(36) NOT NULL,
  `payment_account_id` char(36) NOT NULL,
  `amount` decimal(15,2) unsigned NOT NULL,
  `subtype` enum('ach_transactions','credit_card_transactions','debit_card_transactions','icl_transactions') NOT NULL,
  `creation_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_payment_accounts_id_transactions` (`payment_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Contains Customers Transactions';

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ach_transactions`
--
ALTER TABLE `ach_transactions`
  ADD CONSTRAINT `fk_transaction_id_ach_trasactions` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD CONSTRAINT `fk_bank_accounts_encrypted_id_bank_accounts` FOREIGN KEY (`encrypted_data`) REFERENCES `bank_accounts_encrypted` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_payment_accounts_id_bank_accounts` FOREIGN KEY (`payment_account_id`) REFERENCES `payment_accounts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ccd`
--
ALTER TABLE `ccd`
  ADD CONSTRAINT `fk_ach_trasactions_id_ccd` FOREIGN KEY (`ach_transaction_id`) REFERENCES `ach_transactions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `credit_cards`
--
ALTER TABLE `credit_cards`
  ADD CONSTRAINT `fk_payment_accounts_id_credit_cards` FOREIGN KEY (`payment_account_id`) REFERENCES `payment_accounts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `fk_merchant_id_customers` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `debit_cards`
--
ALTER TABLE `debit_cards`
  ADD CONSTRAINT `fk_payment_accounts_id_debit_cards` FOREIGN KEY (`payment_account_id`) REFERENCES `payment_accounts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `merchants`
--
ALTER TABLE `merchants`
  ADD CONSTRAINT `fk_merchants_data_id` FOREIGN KEY (`merchants_data_id`) REFERENCES `merchants_data` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payment_accounts`
--
ALTER TABLE `payment_accounts`
  ADD CONSTRAINT `fk_customer_id_payment_accounts` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ppd`
--
ALTER TABLE `ppd`
  ADD CONSTRAINT `fk_ach_trasactions_id_ppd` FOREIGN KEY (`ach_transaction_id`) REFERENCES `ach_transactions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_payment_accounts_id_transactions` FOREIGN KEY (`payment_account_id`) REFERENCES `payment_accounts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
