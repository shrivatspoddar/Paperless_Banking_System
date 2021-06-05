-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2021 at 04:54 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(5) NOT NULL,
  `branch_address` text NOT NULL,
  `branch_name` varchar(30) NOT NULL,
  `branch_mgr_contact` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch_address`, `branch_name`, `branch_mgr_contact`) VALUES
(10000, 'S-110/111, RRR building, L&T Rd, Burma Colony, Thiruvalluvar Nagar, Perungudi, Chennai, Tamil Nadu 600096', 'Perungudi branch', 9845630892),
(11000, 'A-2, First Floor, Ring Rd, Block C, South Extension I, New Delhi, Delhi 110049', 'South delhi branch', 9381543475),
(12000, '3/1, 4th Floor, RN Mukherjee Rd, Dal Housie, Lal Bazar, Kolkata, West Bengal 700001', 'Lal bazar branch', 8757391603),
(13452, '588, 2nd Main Rd, 2nd Phase, Hosakerehalli Layout, Banashankari 3rd Stage, Banashankari, Bengaluru, Karnataka 560085', 'Girinagar branch', 6875484849),
(13453, 'No 25, 1st East Main Road Gandhi Nagar, Katpadi, Vellore, Tamil Nadu 632006', 'Vellore branch', 7836657390);

-- --------------------------------------------------------

--
-- Table structure for table `current_account`
--

CREATE TABLE `current_account` (
  `c_account_number` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `branch_id` int(11) NOT NULL,
  `account_name` varchar(50) NOT NULL,
  `balance` int(11) NOT NULL,
  `company_name` varchar(30) NOT NULL,
  `max_od` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `current_account`
--

INSERT INTO `current_account` (`c_account_number`, `user_id`, `created_on`, `branch_id`, `account_name`, `balance`, `company_name`, `max_od`) VALUES
(150000000, 1000000049, '2020-10-05 15:32:48', 13453, 'current_acc', 10000, 'l and k logistics', 10000),
(150000001, 1000000050, '2020-10-05 15:34:53', 10000, 'current', 1000009150, 'accenture', 10000),
(150000002, 1000000048, '2020-10-05 15:35:58', 10000, 'current account', 32000, 'hcl ltd', 10000),
(150000011, 1000000053, '2020-10-13 05:55:21', 11000, 'current account john', 10100, 'accenture', 10000),
(150000014, 1000000060, '2020-10-24 17:56:39', 13452, 'current account', 9690, 'FIITJEE', 5000),
(150000019, 1000000055, '2020-10-25 05:32:22', 13453, 'current account', 67888, 'tata consultancy services', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `current_transactions`
--

CREATE TABLE `current_transactions` (
  `trans_id` int(10) NOT NULL,
  `account_number` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `amount` int(11) NOT NULL,
  `transaction_description` varchar(100) NOT NULL,
  `total_spendable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `current_transactions`
--

INSERT INTO `current_transactions` (`trans_id`, `account_number`, `timestamp`, `amount`, `transaction_description`, `total_spendable`) VALUES
(1, 150000000, '2020-10-05 15:38:16', 10000, '10000 opening balance', 20000),
(2, 150000001, '2020-10-05 15:38:53', 10000, '10000 opening balance', 20000),
(3, 150000002, '2020-10-05 15:39:48', 20000, '20000 opening balance', 30000),
(4, 150000001, '2020-10-05 15:41:19', -7000, '7000 withdrawal', 13000),
(5, 150000002, '2020-10-05 15:42:15', 12000, '12000 deposit', 42000),
(8, 150000011, '2020-10-13 05:55:21', 10000, '10000 opening balance ', 20000),
(11, 150000014, '2020-10-24 17:56:39', 10000, '10000 opening balance ', 15000),
(13, 150000014, '2020-10-24 18:24:58', 1000, '1000 deposit ', 16000),
(14, 150000014, '2020-10-24 18:26:27', 100, '100 deposit ', 16100),
(15, 150000014, '2020-10-24 18:26:47', -300, '300 withdrawal ', 15800),
(16, 150000014, '2020-10-24 18:28:37', -100, '100 bank transfer to 887248992 held by Gurbir Singh', 15700),
(17, 150000014, '2020-10-24 18:31:54', -100, '100 money transfer to 242000006', 15600),
(18, 150000014, '2020-10-24 18:32:50', -100, '100 money transfer to 1000000029', 15500),
(19, 150000014, '2020-10-24 18:37:48', -100, '100 money transfer to 1000000029', 15400),
(20, 150000014, '2020-10-24 18:38:11', -100, '100 money transfer to 1000000029', 15300),
(21, 150000014, '2020-10-24 18:38:37', -100, '100 money transfer to 1000000029', 15200),
(22, 150000014, '2020-10-24 18:39:15', -100, '100 money transfer to 1000000029', 15100),
(23, 150000014, '2020-10-24 18:39:49', -100, '100 money transfer to 1000000029', 15000),
(24, 150000014, '2020-10-24 18:44:30', -100, '100 money transfer to 1000000029', 14900),
(25, 150000014, '2020-10-24 18:50:30', -100, '100 money transfer to 1000000029', 14800),
(26, 150000014, '2020-10-24 18:52:24', -100, '100 money transfer to 1000000029', 14700),
(27, 150000014, '2020-10-24 18:53:46', -10, '10 money transfer to 1000000029', 14690),
(28, 150000014, '2020-10-24 18:55:46', 1000, '1000 deposit ', 15690),
(29, 150000014, '2020-10-24 18:55:57', -1000, '1000 withdrawal ', 14690),
(30, 150000014, '2020-10-24 19:19:18', 10000, '10000 opening balance ', 20000),
(31, 150000014, '2020-10-24 19:20:51', 10000, '10000 opening balance ', 20000),
(34, 150000014, '2020-10-25 05:28:34', 67688, '67688 opening balance ', 77688),
(35, 150000014, '2020-10-25 05:31:46', 67688, '67688 opening balance ', 77688),
(36, 150000019, '2020-10-25 05:32:22', 67688, '67688 opening balance ', 77688),
(37, 150000019, '2020-10-25 05:45:42', 100, '100 deposit', 77788),
(38, 150000019, '2020-10-25 05:48:19', 100, '100 deposit', 77888),
(39, 150000011, '2020-10-27 04:55:06', 100, '100 deposit', 20100),
(40, 150000001, '2020-10-27 04:56:15', -4000, '4000 money transfer to 242000001', 9000),
(41, 150000001, '2020-10-27 04:56:29', 10000, '10000 deposit ', 19000),
(42, 150000001, '2020-10-27 05:09:26', 1000000050, '1000000050 deposit', 1000019050),
(43, 150000001, '2020-10-27 05:09:52', 100, '100 deposit', 1000019150);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `userid` int(10) NOT NULL,
  `password` varchar(25) NOT NULL,
  `customer_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `branch_id` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`userid`, `password`, `customer_name`, `email`, `phone`, `address`, `date_of_birth`, `created_on`, `branch_id`) VALUES
(1000000048, 'Arshdeep123', 'ARSHDEEP SINGH BHATIA', 'arshdeepdgreat@gmail.com', '8754541603', 'A4-405,adora akshaya homes,padur,chennai', '1993-02-18', '2020-10-05 12:42:49', 10000),
(1000000049, '0000', 'IRENE JOHN', 'irene.john2019@vitstudent.ac.in', '9840849927', 'HOUSE-05,gandhi nagar NAGAR,vellore,640202', '1999-01-06', '2020-10-05 12:46:39', 13453),
(1000000050, '0000', 'RIYA', 'riya@vitstudent.ac.in', '8974652672', 'house 5,palm homes,Gandhi Nagar, Adyar, Chennai, Tamil Nadu 600020', '2001-05-13', '2020-10-05 12:45:54', 10000),
(1000000051, '0000', 'KARTIK', 'kartik@gmail.com', '8926647489', 'house 205,Mandakini Apartment,Pocket 2, Sector 2 Dwarka, Dwarka, New Delhi, Delhi 110075\r\n', '1997-06-11', '2020-10-05 12:50:16', 11000),
(1000000053, '0000', 'JOHN', 'john@vit.ac.in', '7399366492', 'A4-405,adora akshaya homes,padur,chennai', '1991-05-23', '2020-10-25 04:21:02', 11000),
(1000000054, '0000', 'TEJINDER KAUR BHATIA', 'gbtk@yahoo.com', '9840037871', 'A4-405,adora akshaya homes,padur,chennai', '1971-09-14', '2020-10-24 17:20:12', 10000),
(1000000055, '0000', 'SWASTIK DAS', 'swastik.d@yahoo.com', '9840037856', 'HOUSE 10,Palm homes,Adyar,chennai,600408 ', '2002-02-12', '2020-10-24 17:39:14', 10000),
(1000000060, '0000', 'AASHISH V', 'aashish.v@yahoo.com', '9848487856', 'HOUSE 10, Akshaya homes,VELACHERRY,chennai,600408 ', '2000-05-11', '2020-10-24 17:52:18', 10000),
(1000000061, '0000', 'AARTI', 'aarti@gmail.com', '6486694957', 'HOUSE 10,MANTRI homes,PADUR,chennai,600408 ', '1975-02-12', '2020-10-25 09:34:36', 10000),
(1000000062, '0000', 'PREETA', 'preeta@gmail.com', '8975645689', 'A4-405,adora akshaya homes,padur,chennai', '2000-09-01', '2020-10-25 10:00:55', 11000);

-- --------------------------------------------------------

--
-- Table structure for table `fixed_deposits`
--

CREATE TABLE `fixed_deposits` (
  `fd_account_number` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `account_name` varchar(30) NOT NULL,
  `bond_duration` int(2) NOT NULL,
  `rate_of_intrest` int(1) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `final_amount` int(11) NOT NULL,
  `branch_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fixed_deposits`
--

INSERT INTO `fixed_deposits` (`fd_account_number`, `user_id`, `account_name`, `bond_duration`, `rate_of_intrest`, `created_on`, `final_amount`, `branch_id`) VALUES
(65300000, 1000000051, 'fixed deposit(7yr)', 7, 15, '2020-10-05 15:46:46', 115000, 11000),
(65300001, 1000000050, 'fixed deposit', 10, 20, '2020-10-05 15:47:57', 240000, 10000),
(65300012, 1000000053, 'fixed deposit', 7, 17, '2020-10-15 04:58:18', 81900, 10000),
(65300015, 1000000060, 'fixed deposit', 5, 15, '2020-10-24 17:55:56', 57500, 10000),
(65300018, 1000000055, 'fixed deposit', 5, 15, '2020-10-25 05:38:17', 57500, 13453);

-- --------------------------------------------------------

--
-- Table structure for table `issued_cheques`
--

CREATE TABLE `issued_cheques` (
  `cheque_id` int(10) NOT NULL,
  `issue_ac_no` int(10) NOT NULL,
  `reciever_ac_no` int(10) NOT NULL,
  `amount` int(10) NOT NULL,
  `date_of_claim` date NOT NULL,
  `timestamp_of_issue` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issued_cheques`
--

INSERT INTO `issued_cheques` (`cheque_id`, `issue_ac_no`, `reciever_ac_no`, `amount`, `date_of_claim`, `timestamp_of_issue`, `status`) VALUES
(1, 1000000000, 1000000001, 500, '2021-05-09', '2021-05-10 11:32:55', 0),
(3, 1000000001, 1000000000, 500, '2021-05-09', '2021-05-10 14:26:29', 0),
(4, 1000000000, 1000000001, 1000, '2021-05-08', '2021-05-10 14:29:28', 0),
(5, 1000000000, 1000000001, 500, '2021-05-09', '2021-05-10 14:32:21', 0),
(6, 1000000001, 1000000000, 1500, '2021-05-09', '2021-05-10 14:45:52', 0),
(7, 1000000000, 1000000001, 1000, '2021-05-09', '2021-05-10 14:53:12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `loan_accounts`
--

CREATE TABLE `loan_accounts` (
  `loan_account_number` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(10) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `account_name` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `rate_of _intrest` int(2) NOT NULL,
  `duration_of_loan` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_accounts`
--

INSERT INTO `loan_accounts` (`loan_account_number`, `created_on`, `user_id`, `branch_id`, `account_name`, `amount`, `rate_of _intrest`, `duration_of_loan`) VALUES
(242000000, '2020-08-05 15:54:37', 1000000051, 11000, 'home loan', -1180000, 20, 7),
(242000001, '2020-08-05 15:54:37', 1000000050, 11000, 'education loan', -1066666, 15, 5),
(242000004, '2020-10-15 06:06:32', 1000000053, 10000, 'loan account', -57400, 15, 5),
(242000006, '2020-10-24 17:53:55', 1000000060, 10000, 'loan account', -48800, 20, 7),
(242000007, '2020-10-25 05:41:45', 1000000055, 13453, 'loan account', -53240, 15, 5),
(242000008, '2020-10-25 10:21:54', 1000000055, 10000, 'loan account', -60000, 20, 7);

-- --------------------------------------------------------

--
-- Table structure for table `loan_payments`
--

CREATE TABLE `loan_payments` (
  `pay_no` int(10) NOT NULL,
  `loan_account_number` int(10) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `timestamp_` timestamp NOT NULL DEFAULT current_timestamp(),
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_payments`
--

INSERT INTO `loan_payments` (`pay_no`, `loan_account_number`, `amount_paid`, `timestamp_`, `amount`) VALUES
(1, 242000000, 10000, '2020-09-01 16:03:30', -1190000),
(2, 242000001, 18334, '2020-10-01 16:03:30', -1081666),
(3, 242000000, 10000, '2020-10-01 16:03:30', -1180000),
(5, 242000004, 100, '2020-10-24 07:22:11', -57400),
(6, 242000006, 10000, '2020-10-24 17:54:42', -50000),
(7, 242000006, 100, '2020-10-24 18:31:54', -49900),
(8, 242000006, 1000, '2020-10-24 18:55:03', -48900),
(9, 242000006, 100, '2020-10-24 19:13:16', -48800),
(10, 242000007, 60, '2020-10-25 09:38:38', -57440),
(11, 242000007, 100, '2020-10-25 09:40:40', -57340),
(12, 242000007, 3000, '2020-10-25 10:15:55', -54340),
(13, 242000007, 1000, '2020-10-26 12:56:20', -53340),
(14, 242000007, 100, '2020-10-26 12:59:43', -53240),
(15, 242000001, 10000, '2020-10-27 04:55:35', -1071666),
(16, 242000001, 4000, '2020-10-27 04:56:15', -1067666),
(17, 242000001, 1000, '2020-10-27 07:08:11', -1066666);

-- --------------------------------------------------------

--
-- Table structure for table `product_master`
--

CREATE TABLE `product_master` (
  `product_id` int(4) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_master`
--

INSERT INTO `product_master` (`product_id`, `product_name`, `description`) VALUES
(100, 'fixed deposit', 'Fixed deposits will be offered with a given rate of interest and a duration of few years.\r\nusually 15% for 5 yrs   17% for 7 yrs and 20% for 10 years'),
(101, 'savings account', 'savings account provides an account for the holder with debit card for an amount of time(5yrs).'),
(120, 'Loan account', 'home loan,car loan,education loan can be provisioned on production of required documents.'),
(151, 'current account', 'current account can be provisioned for employees on company approval with bank.\r\naddon benefits will include a max overdraft amount that can be spent by holder. ');

-- --------------------------------------------------------

--
-- Table structure for table `savings_accounts`
--

CREATE TABLE `savings_accounts` (
  `userid` int(10) NOT NULL,
  `s_account_number` int(10) NOT NULL,
  `balance` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `branch_id` int(5) NOT NULL,
  `account_name` varchar(30) NOT NULL DEFAULT 'savings_account'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `savings_accounts`
--

INSERT INTO `savings_accounts` (`userid`, `s_account_number`, `balance`, `created_on`, `branch_id`, `account_name`) VALUES
(1000000048, 1000000000, 9000, '2020-10-01 12:09:09', 10000, 'savings account'),
(1000000048, 1000000001, 6000, '2020-10-05 13:16:08', 10000, 'savings account upi'),
(1000000049, 1000000002, 50000, '2020-10-05 13:16:08', 13453, 'savings debit_card'),
(1000000050, 1000000003, 6398, '2020-10-05 13:47:26', 10000, 'my_savings'),
(1000000051, 1000000004, 15000, '2020-10-05 13:48:35', 11000, 'savings_account'),
(1000000053, 1000000026, 7300, '2020-10-13 05:54:51', 10000, 'savings account john'),
(1000000060, 1000000029, 43210, '2020-10-24 17:53:05', 10000, 'savings account'),
(1000000055, 1000000038, 67789, '2020-10-25 05:26:10', 13452, 'savings account'),
(1000000062, 1000000040, 67899, '2020-10-25 10:07:02', 13452, 'savings account preeta');

-- --------------------------------------------------------

--
-- Table structure for table `savings_transactions`
--

CREATE TABLE `savings_transactions` (
  `trans_id` int(10) NOT NULL,
  `account_number` int(10) NOT NULL,
  `timestamp_` timestamp NULL DEFAULT current_timestamp(),
  `amount_` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `savings_transactions`
--

INSERT INTO `savings_transactions` (`trans_id`, `account_number`, `timestamp_`, `amount_`, `description`, `balance`) VALUES
(1, 1000000000, '2020-10-02 13:53:23', 100, '100 deposit', 10100),
(2, 1000000000, '2020-10-03 13:53:23', -150, '150 withdrawal', 9950),
(3, 1000000000, '2020-10-05 13:53:23', -320, '320 withdrawal', 9630),
(4, 1000000000, '2020-10-10 13:53:23', 370, '370 deposit', 10000),
(5, 1000000001, '2020-10-05 13:58:59', 10000, '10000 opening balance', 10000),
(6, 1000000002, '2020-10-05 14:00:35', 30000, '30000 opening balance', 30000),
(7, 1000000001, '2020-10-05 14:01:31', -5000, '5000 withdrawal', 5000),
(8, 1000000002, '2020-10-05 14:03:35', 20000, '20000 deposit', 50000),
(9, 1000000003, '2020-10-05 14:07:11', 8000, '8000 opening balance', 8000),
(10, 1000000004, '2020-10-05 14:08:30', 15000, '15000 opening balance', 15000),
(11, 1000000003, '2020-10-05 14:09:50', -302, '302 withdrawal', 7698),
(12, 1000000000, '2020-10-01 11:51:50', 10000, '10000 opening balance', 10000),
(18, 1000000026, '2020-10-13 05:54:51', 6000, '6000 opening balance ', 6000),
(21, 1000000026, '2020-10-23 04:27:51', -500, '500 withdrawal ', 5500),
(22, 1000000026, '2020-10-23 04:30:15', -500, '500 withdrawal ', 5000),
(23, 1000000026, '2020-10-23 04:30:47', 1000, '1000 deposit ', 6000),
(24, 1000000026, '2020-10-23 04:34:03', 3000, '3000 deposit ', 9000),
(25, 1000000026, '2020-10-23 04:41:59', -700, '700 withdrawal ', 8300),
(26, 1000000026, '2020-10-23 04:53:47', -400, '400 bank transfer to 1000303', 7900),
(27, 1000000026, '2020-10-23 05:00:08', 500, '500 deposit ', 8400),
(28, 1000000026, '2020-10-24 07:18:51', -1000, '1000 bank transfer to 1378490202 held by SARTHAK KHILLAN( IFSC: 789889  )', 7400),
(29, 1000000026, '2020-10-24 07:22:11', -100, '100 money transfer to 242000004', 7300),
(30, 1000000029, '2020-10-24 17:53:05', 54000, '54000 opening balance ', 54000),
(31, 1000000029, '2020-10-24 17:54:42', -10000, '10000 money transfer to 242000006', 44000),
(33, 1000000029, '2020-10-24 18:32:50', 100, '100 deposit', 44100),
(34, 1000000029, '2020-10-24 18:52:24', 100, '100 deposit', 44200),
(35, 1000000029, '2020-10-24 18:53:46', 10, '10 deposit', 44210),
(36, 1000000029, '2020-10-24 18:55:03', -1000, '1000 money transfer to 242000006', 43210),
(38, 1000000029, '2020-10-25 05:19:16', 500, '500 opening balance ', 500),
(39, 1000000029, '2020-10-25 05:19:37', 500, '500 opening balance ', 500),
(40, 1000000029, '2020-10-25 05:20:56', 500, '500 opening balance ', 500),
(41, 1000000029, '2020-10-25 05:22:53', 500, '500 opening balance ', 500),
(42, 1000000029, '2020-10-25 05:23:20', 52700, '52700 opening balance ', 52700),
(43, 1000000029, '2020-10-25 05:23:45', 52700, '52700 opening balance ', 52700),
(44, 1000000029, '2020-10-25 05:24:24', 500, '500 opening balance ', 500),
(45, 1000000038, '2020-10-25 05:26:10', 500, '500 opening balance ', 500),
(46, 1000000038, '2020-10-25 05:42:52', -100, '100 withdrawal ', 400),
(47, 1000000038, '2020-10-25 05:44:36', -100, '100 bank transfer to 6783930 held by Priya M( IFSC: 789889  )', 300),
(48, 1000000038, '2020-10-25 05:44:54', 1000, '1000 deposit ', 1300),
(49, 1000000038, '2020-10-25 05:45:42', -100, '100 money transfer to 150000019', 1200),
(50, 1000000038, '2020-10-25 05:48:19', -100, '100 money transfer to 150000019', 1100),
(51, 1000000038, '2020-10-25 09:36:59', 1000, '1000 deposit ', 2100),
(52, 1000000038, '2020-10-25 09:37:19', -100, '100 withdrawal ', 2000),
(53, 1000000038, '2020-10-25 09:37:54', -789, '789 bank transfer to 674893038 held by Gurbir Singh( IFSC: 789889  )', 1211),
(54, 1000000038, '2020-10-25 09:38:38', -60, '60 money transfer to 242000007', 1151),
(55, 1000000038, '2020-10-25 10:06:42', 67899, '67899 opening balance ', 67899),
(56, 1000000040, '2020-10-25 10:07:02', 67899, '67899 opening balance ', 67899),
(57, 1000000040, '2020-10-26 12:43:08', 6788, '6788 opening balance ', 6788),
(58, 1000000038, '2020-10-26 12:56:20', -1000, '1000 money transfer to 242000007', 66899),
(59, 1000000038, '2020-10-26 12:57:50', 1000, '1000 deposit ', 67899),
(60, 1000000038, '2020-10-26 12:58:12', -10, '10', 67889),
(61, 1000000038, '2020-10-26 12:58:20', -100, '100 withdrawal ', 67789),
(62, 1000000003, '2020-10-27 03:55:52', -100, '100 withdrawal ', 7598),
(63, 1000000003, '2020-10-27 04:55:06', -100, '100 money transfer to 150000011', 7498),
(64, 1000000003, '2020-10-27 05:09:31', -100, '100', 7398),
(65, 1000000003, '2020-10-27 05:09:52', -100, '100 money transfer to 150000001', 7298),
(66, 1000000003, '2020-10-27 05:10:04', 100, '100 deposit ', 7398),
(67, 1000000003, '2020-10-27 07:06:43', -100, '100 bank transfer to 66774839 held by Arshdeep( IFSC: 789889  )', 7298),
(68, 1000000003, '2020-10-27 07:08:11', -1000, '1000 money transfer to 242000001', 6298),
(69, 1000000003, '2020-10-27 07:08:47', 100, '100 deposit ', 6398),
(70, 1000000000, '2021-05-10 11:32:55', 500, 'Cheque transfer issue from 1000000000 to 1000000001', 9500),
(71, 1000000001, '2021-05-10 14:23:37', 500, 'Cheque claimed from 1000000000', 5500),
(72, 1000000001, '2021-05-10 14:26:29', 500, 'Cheque transfer issue from 1000000001 to 1000000000', 5000),
(73, 1000000000, '2021-05-10 14:26:46', 500, 'Cheque claimed from 1000000001', 10000),
(74, 1000000000, '2021-05-10 14:29:29', 1000, 'Cheque transfer issue from 1000000000 to 1000000001', 9000),
(75, 1000000000, '2021-05-10 14:32:21', 500, 'Cheque transfer issue from 1000000000 to 1000000001', 8500),
(76, 1000000001, '2021-05-10 14:32:32', 1000, 'Cheque claimed from 1000000000', 6000),
(77, 1000000001, '2021-05-10 14:42:56', 500, 'Cheque claimed from 1000000000', 6500),
(78, 1000000001, '2021-05-10 14:45:52', 1500, 'Cheque transfer issue from 1000000001 to 1000000000', 5000),
(79, 1000000000, '2021-05-10 14:47:56', 1500, 'Cheque claimed from 1000000001', 10000),
(80, 1000000000, '2021-05-10 14:53:12', 1000, 'Cheque transfer issue from 1000000000 to 1000000001', 9000),
(81, 1000000001, '2021-05-10 14:53:48', 1000, 'Cheque claimed from 1000000000', 6000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`),
  ADD UNIQUE KEY `branch_mgr_contact` (`branch_mgr_contact`);

--
-- Indexes for table `current_account`
--
ALTER TABLE `current_account`
  ADD PRIMARY KEY (`c_account_number`),
  ADD KEY `c_userid` (`user_id`),
  ADD KEY `ca_branch` (`branch_id`);

--
-- Indexes for table `current_transactions`
--
ALTER TABLE `current_transactions`
  ADD PRIMARY KEY (`trans_id`),
  ADD KEY `curfk` (`account_number`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `branchfk` (`branch_id`);

--
-- Indexes for table `fixed_deposits`
--
ALTER TABLE `fixed_deposits`
  ADD PRIMARY KEY (`fd_account_number`),
  ADD KEY `fd_userid` (`user_id`),
  ADD KEY `fd_branch` (`branch_id`);

--
-- Indexes for table `issued_cheques`
--
ALTER TABLE `issued_cheques`
  ADD PRIMARY KEY (`cheque_id`);

--
-- Indexes for table `loan_accounts`
--
ALTER TABLE `loan_accounts`
  ADD PRIMARY KEY (`loan_account_number`),
  ADD KEY `loan_userid` (`user_id`),
  ADD KEY `loan_branch` (`branch_id`);

--
-- Indexes for table `loan_payments`
--
ALTER TABLE `loan_payments`
  ADD PRIMARY KEY (`pay_no`),
  ADD KEY `loanfk` (`loan_account_number`);

--
-- Indexes for table `product_master`
--
ALTER TABLE `product_master`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `savings_accounts`
--
ALTER TABLE `savings_accounts`
  ADD PRIMARY KEY (`s_account_number`),
  ADD KEY `s_userid` (`userid`),
  ADD KEY `s_branch` (`branch_id`);

--
-- Indexes for table `savings_transactions`
--
ALTER TABLE `savings_transactions`
  ADD PRIMARY KEY (`trans_id`),
  ADD KEY `savfk` (`account_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13454;

--
-- AUTO_INCREMENT for table `current_account`
--
ALTER TABLE `current_account`
  MODIFY `c_account_number` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150000020;

--
-- AUTO_INCREMENT for table `current_transactions`
--
ALTER TABLE `current_transactions`
  MODIFY `trans_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `userid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000063;

--
-- AUTO_INCREMENT for table `fixed_deposits`
--
ALTER TABLE `fixed_deposits`
  MODIFY `fd_account_number` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65300020;

--
-- AUTO_INCREMENT for table `issued_cheques`
--
ALTER TABLE `issued_cheques`
  MODIFY `cheque_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `loan_accounts`
--
ALTER TABLE `loan_accounts`
  MODIFY `loan_account_number` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242000009;

--
-- AUTO_INCREMENT for table `loan_payments`
--
ALTER TABLE `loan_payments`
  MODIFY `pay_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_master`
--
ALTER TABLE `product_master`
  MODIFY `product_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `savings_accounts`
--
ALTER TABLE `savings_accounts`
  MODIFY `s_account_number` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000042;

--
-- AUTO_INCREMENT for table `savings_transactions`
--
ALTER TABLE `savings_transactions`
  MODIFY `trans_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `current_account`
--
ALTER TABLE `current_account`
  ADD CONSTRAINT `c_userid` FOREIGN KEY (`user_id`) REFERENCES `customers` (`userid`),
  ADD CONSTRAINT `ca_branch` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`);

--
-- Constraints for table `current_transactions`
--
ALTER TABLE `current_transactions`
  ADD CONSTRAINT `curfk` FOREIGN KEY (`account_number`) REFERENCES `current_account` (`c_account_number`) ON DELETE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `branchfk` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`);

--
-- Constraints for table `fixed_deposits`
--
ALTER TABLE `fixed_deposits`
  ADD CONSTRAINT `fd_branch` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`),
  ADD CONSTRAINT `fd_userid` FOREIGN KEY (`user_id`) REFERENCES `customers` (`userid`);

--
-- Constraints for table `loan_accounts`
--
ALTER TABLE `loan_accounts`
  ADD CONSTRAINT `loan_branch` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`),
  ADD CONSTRAINT `loan_userid` FOREIGN KEY (`user_id`) REFERENCES `customers` (`userid`);

--
-- Constraints for table `loan_payments`
--
ALTER TABLE `loan_payments`
  ADD CONSTRAINT `loanfk` FOREIGN KEY (`loan_account_number`) REFERENCES `loan_accounts` (`loan_account_number`) ON DELETE CASCADE;

--
-- Constraints for table `savings_accounts`
--
ALTER TABLE `savings_accounts`
  ADD CONSTRAINT `s_branch` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`),
  ADD CONSTRAINT `s_userid` FOREIGN KEY (`userid`) REFERENCES `customers` (`userid`);

--
-- Constraints for table `savings_transactions`
--
ALTER TABLE `savings_transactions`
  ADD CONSTRAINT `savfk` FOREIGN KEY (`account_number`) REFERENCES `savings_accounts` (`s_account_number`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
