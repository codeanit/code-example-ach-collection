-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2014 at 06:09 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `olap_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `notice_of_changes`
--

CREATE TABLE IF NOT EXISTS `notice_of_changes` (
  `code` int(11) NOT NULL COMMENT 'Corresponds with NOC code',
  `reason` varchar(100) NOT NULL,
  `description` varchar(150) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Contains Customers Ach Transactions Notice Of Change Code';

--
-- Dumping data for table `notice_of_changes`
--

INSERT INTO `notice_of_changes` (`code`, `reason`, `description`) VALUES
(1, 'Incorrect bank account number', 'Bank account number incorrect or formatted incorrectly'),
(2, 'Incorrect transit/routing number', 'Once valid transit/routing number must be changed'),
(3, 'Incorrect transit/routing number and bank account number', 'Once valid transit/routing number must be changed and causes a change to bank account number structure'),
(4, 'Bank account name change', 'Customer has changed name or ODFI submitted name incorrectly'),
(5, 'Incorrect payment code', 'Entry posted to demand account should contain savings payment codes or vice versa'),
(6, 'Incorrect bank account number and transit code', 'Bank account number must be changed and payment code should indicate posting to another account type (demand/savings)'),
(7, 'Incorrect transit/routing number, bank account number and payment code', 'Changes required in three fields indicated'),
(9, 'Incorrect individual ID number', 'Individual’s ID number is incorrect'),
(10, 'Incorrect company name', 'Company name is no longer valid and should be changed.'),
(11, 'Incorrect company identification', 'Company ID is no longer valid and should be changed'),
(12, 'Incorrect company name and company ID', 'Both the company name and company id are no longer valid and must be changed');

-- --------------------------------------------------------

--
-- Table structure for table `notice_of_change_transactions`
--

CREATE TABLE IF NOT EXISTS `notice_of_change_transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vericheck_transaction_id` char(36) NOT NULL,
  `gateway_transaction_id` char(36) NOT NULL,
  `merchant_id` mediumint(9) NOT NULL,
  `notice_of_change_id` int(11) NOT NULL,
  `return_date` date NOT NULL,
  `corrected_data` varchar(29) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_notice_of_change_transactions_code_notice_of_changes` (`notice_of_change_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Contains Customers Ach Transactions Notice Of Change Information' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `notice_of_change_transactions`
--

INSERT INTO `notice_of_change_transactions` (`id`, `vericheck_transaction_id`, `gateway_transaction_id`, `merchant_id`, `notice_of_change_id`, `return_date`, `corrected_data`) VALUES
(1, '534e3626-98f0-43a0-a654-91986aac1de6', '534e3626-98f0-43a0-a654-91986aac1de6', 1, 1, '2014-04-28', ''),
(2, '534e3626-98f0-43a0-a654-91986aac1de6', '534e3626-98f0-43a0-a654-91986aac1de6', 1, 2, '2014-04-28', '464647934');

-- --------------------------------------------------------

--
-- Table structure for table `status_changes`
--

CREATE TABLE IF NOT EXISTS `status_changes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(32) NOT NULL,
  `transaction_id` char(32) NOT NULL,
  `merchant_id` int(10) unsigned NOT NULL,
  `change_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `origination_date` date DEFAULT NULL,
  `effective_date` date DEFAULT NULL,
  `settlement_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `return_code` char(3) DEFAULT NULL,
  `status` char(1) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Contains ACH Transactions Status Change' AUTO_INCREMENT=5 ;

--
-- Dumping data for table `status_changes`
--

INSERT INTO `status_changes` (`id`, `uuid`, `transaction_id`, `merchant_id`, `change_timestamp`, `origination_date`, `effective_date`, `settlement_date`, `return_date`, `return_code`, `status`, `reason`) VALUES
(1, '537ae068309440d08da65ce06aac1de7', '537ae068309440d08da65ce06aac1df6', 1, '2014-04-05 07:00:12', '2014-04-05', '2014-04-06', '2014-04-07', '2014-04-07', 'R01', 'R', 'Insufficient fund'),
(2, '537ae068309440d08da65ce06aac1dg4', '537ae068309440d08da65ce06aac1df6', 1, '2014-04-07 00:48:11', '2014-04-05', '2014-04-06', '2014-04-07', '2014-04-07', '', 'S', ''),
(3, '537ae068309440d08da65ce06aac1dt3', '537ae068309440d08da65ce06aac1df6', 1, '2014-04-08 04:09:10', '2014-04-05', '2014-04-06', '2014-04-07', '2014-04-07', '', 'S', ''),
(4, '537ae068309440d08da65ce06aac1d2w', '537ae068309440d08da65ce06aac1df6', 1, '2014-04-09 04:58:19', '2014-04-05', '2014-04-06', '2014-04-07', '2014-04-07', '', 'S', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notice_of_change_transactions`
--
ALTER TABLE `notice_of_change_transactions`
  ADD CONSTRAINT `fk_notice_of_change_transactions_code_notice_of_changes` FOREIGN KEY (`notice_of_change_id`) REFERENCES `notice_of_changes` (`code`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
