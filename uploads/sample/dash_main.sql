-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 11, 2023 at 12:17 PM
-- Server version: 8.0.33-0ubuntu0.20.04.2
-- PHP Version: 8.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dash_main_1_4`
--

SET foreign_key_checks = 0;

DROP TABLE IF EXISTS `activity_logs`, `add_ons`, `allowances`, `allowance_options`, `announcements`, `announcement_employees`, `api_key_settings`, `attendances`, `awards`, `award_types`, `bank_accounts`, `bank_transfers`, `bank_transfer_payments`, `bills`, `bill_payments`, `bill_products`, `branches`, `bug_comments`, `bug_files`, `bug_reports`, `bug_stages`, `categories`, `ch_favorites`, `ch_messages`, `client_deals`, `client_permissions`, `client_projects`, `comments`, `commissions`, `company_policies`, `complaints`, `credit_notes`, `currency`, `customers`, `custom_fields_module_list`, `deals`, `deal_activity_logs`, `deal_calls`, `deal_discussions`, `deal_emails`, `deal_files`, `deal_stages`, `deal_tasks`, `debit_notes`, `deduction_options`, `departments`, `designations`, `documents`, `document_types`, `email_templates`, `email_template_langs`, `employees`, `employee_documents`, `events`, `event_employees`, `experience_certificates`, `failed_jobs`, `holidays`, `invoices`, `invoice_payments`, `invoice_products`, `ip_restricts`, `joining_letters`, `labels`, `leads`, `lead_activity_logs`, `lead_calls`, `lead_discussions`, `lead_emails`, `lead_files`, `lead_stages`, `leaves`, `leave_types`, `loans`, `loan_options`, `login_details`, `migrations`, `milestones`, `model_has_permissions`, `model_has_roles`, `noc_certificates`, `notifications`, `orders`, `other_payments`, `overtimes`, `password_resets`, `payments`, `payslip_types`, `pay_slips`, `permissions`, `personal_access_tokens`, `pipelines`, `plans`, `plan_fields`, `pos`, `pos_payments`, `pos_products`, `product_services`, `projects`, `project_files`, `promotions`, `proposals`, `proposal_products`, `purchases`, `purchase_payments`, `purchase_products`, `resignations`, `revenues`, `roles`, `role_has_permissions`, `saturation_deductions`, `settings`, `sidebar`, `sources`, `stages`, `stock_reports`, `sub_tasks`, `tasks`, `task_files`, `taxes`, `terminations`, `termination_types`, `time_sheets`, `transactions`, `transfers`, `travels`, `units`, `users`, `user_deals`, `user_leads`, `user_projects`, `vendors`, `warehouses`, `warehouse_products`, `warnings`, `work_spaces`;

SET foreign_key_checks = 1;
-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `user_type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `log_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `add_ons`
--

CREATE TABLE `add_ons` (
  `id` bigint UNSIGNED NOT NULL,
  `module` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monthly_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `yearly_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_ons`
--

INSERT INTO `add_ons` (`id`, `module`, `name`, `monthly_price`, `yearly_price`, `created_at`, `updated_at`) VALUES
(1, 'Account', 'Accounting', '0', '0', '2023-07-11 01:09:03', '2023-07-11 01:09:03'),
(2, 'Hrm', 'HRM', '0', '0', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(3, 'Lead', 'CRM', '0', '0', '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(4, 'Paypal', 'paypal', '0', '0', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(5, 'Pos', 'POS', '0', '0', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(6, 'ProductService', 'Product Service', '0', '0', '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(7, 'Stripe', 'stripe', '0', '0', '2023-07-11 01:09:31', '2023-07-11 01:09:31'),
(8, 'Taskly', 'project', '0', '0', '2023-07-11 01:09:32', '2023-07-11 01:09:32');

-- --------------------------------------------------------

--
-- Table structure for table `allowances`
--

CREATE TABLE `allowances` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int NOT NULL,
  `allowance_option` int NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` int NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `allowance_options`
--

CREATE TABLE `allowance_options` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `branch_id` int NOT NULL,
  `department_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `announcement_employees`
--

CREATE TABLE `announcement_employees` (
  `id` bigint UNSIGNED NOT NULL,
  `announcement_id` int NOT NULL,
  `employee_id` int NOT NULL,
  `created_by` int NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `api_key_settings`
--

CREATE TABLE `api_key_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` longtext COLLATE utf8mb4_unicode_ci,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int NOT NULL,
  `date` date NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clock_in` time DEFAULT NULL,
  `clock_out` time DEFAULT NULL,
  `late` time DEFAULT NULL,
  `early_leaving` time DEFAULT NULL,
  `overtime` time DEFAULT NULL,
  `total_rest` time DEFAULT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE `awards` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `award_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `gift` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `award_types`
--

CREATE TABLE `award_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` bigint UNSIGNED NOT NULL,
  `holder_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opening_balance` double(15,2) NOT NULL DEFAULT '0.00',
  `contact_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `holder_name`, `bank_name`, `account_number`, `opening_balance`, `contact_number`, `bank_address`, `workspace`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'cash', '', '-', 0.00, '-', '-', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `bank_transfers`
--

CREATE TABLE `bank_transfers` (
  `id` bigint UNSIGNED NOT NULL,
  `from_account` int NOT NULL DEFAULT '0',
  `to_account` int NOT NULL DEFAULT '0',
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `date` date NOT NULL,
  `payment_method` int NOT NULL DEFAULT '0',
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_transfer_payments`
--

CREATE TABLE `bank_transfer_payments` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `request` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL DEFAULT '0.00',
  `price_currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USD',
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int NOT NULL,
  `workspace` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` bigint UNSIGNED NOT NULL,
  `bill_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `vendor_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `bill_date` date NOT NULL,
  `due_date` date NOT NULL,
  `order_number` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '0',
  `bill_shipping_display` int NOT NULL DEFAULT '1',
  `send_date` date DEFAULT NULL,
  `discount_apply` int NOT NULL DEFAULT '0',
  `category_id` int NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill_payments`
--

CREATE TABLE `bill_payments` (
  `id` bigint UNSIGNED NOT NULL,
  `bill_id` int NOT NULL,
  `date` date NOT NULL,
  `amount` double(8,2) NOT NULL DEFAULT '0.00',
  `account_id` int NOT NULL,
  `payment_method` int NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_receipt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill_products`
--

CREATE TABLE `bill_products` (
  `id` bigint UNSIGNED NOT NULL,
  `bill_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `tax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` double(8,2) NOT NULL DEFAULT '0.00',
  `price` double(8,2) NOT NULL DEFAULT '0.00',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bug_comments`
--

CREATE TABLE `bug_comments` (
  `id` bigint UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bug_id` int NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bug_files`
--

CREATE TABLE `bug_files` (
  `id` bigint UNSIGNED NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bug_id` int NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bug_reports`
--

CREATE TABLE `bug_reports` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `assign_to` int NOT NULL,
  `project_id` int NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unconfirmed',
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bug_stages`
--

CREATE TABLE `bug_stages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#051c4b',
  `complete` tinyint(1) NOT NULL,
  `workspace_id` bigint UNSIGNED NOT NULL,
  `order` int NOT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bug_stages`
--

INSERT INTO `bug_stages` (`id`, `name`, `color`, `complete`, `workspace_id`, `order`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Unconfirmed', '#051c4b', 0, 1, 0, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(2, 'Confirmed', '#051c4b', 0, 1, 0, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(3, 'In Progress', '#051c4b', 0, 1, 0, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(4, 'Resolved', '#051c4b', 0, 1, 0, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(5, 'Verified', '#051c4b', 0, 1, 0, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#fc544b',
  `created_by` int NOT NULL DEFAULT '0',
  `workspace_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ch_favorites`
--

CREATE TABLE `ch_favorites` (
  `id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `favorite_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ch_messages`
--

CREATE TABLE `ch_messages` (
  `id` bigint NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint NOT NULL,
  `to_id` bigint NOT NULL,
  `body` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_deals`
--

CREATE TABLE `client_deals` (
  `id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `deal_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_permissions`
--

CREATE TABLE `client_permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `deal_id` bigint UNSIGNED NOT NULL,
  `permissions` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_projects`
--

CREATE TABLE `client_projects` (
  `id` bigint UNSIGNED NOT NULL,
  `client_id` int NOT NULL,
  `project_id` int NOT NULL,
  `is_active` int NOT NULL DEFAULT '1',
  `permission` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_id` int NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commissions`
--

CREATE TABLE `commissions` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` int NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_policies`
--

CREATE TABLE `company_policies` (
  `id` bigint UNSIGNED NOT NULL,
  `branch` int NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` bigint UNSIGNED NOT NULL,
  `complaint_from` int NOT NULL,
  `complaint_against` int NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `complaint_date` date NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credit_notes`
--

CREATE TABLE `credit_notes` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice` int NOT NULL DEFAULT '0',
  `customer` int NOT NULL DEFAULT '0',
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `date` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `name` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`name`, `code`, `symbol`) VALUES
('Leke', 'ALL', 'Lek'),
('Dollars', 'USD', '$'),
('Afghanis', 'AFN', '؋'),
('Pesos', 'ARS', '$'),
('Guilders', 'AWG', 'ƒ'),
('Dollars', 'AUD', '$'),
('New Manats', 'AZN', 'ман'),
('Dollars', 'BSD', '$'),
('Dollars', 'BBD', '$'),
('Rubles', 'BYR', 'p.'),
('Euro', 'EUR', '€'),
('Dollars', 'BZD', 'BZ$'),
('Dollars', 'BMD', '$'),
('Bolivianos', 'BOB', '$b'),
('Convertible Marka', 'BAM', 'KM'),
('Pula', 'BWP', 'P'),
('Leva', 'BGN', 'лв'),
('Reais', 'BRL', 'R$'),
('Pounds', 'GBP', '£'),
('Dollars', 'BND', '$'),
('Riels', 'KHR', '៛'),
('Dollars', 'CAD', '$'),
('Dollars', 'KYD', '$'),
('Pesos', 'CLP', '$'),
('Yuan Renminbi', 'CNY', '¥'),
('Pesos', 'COP', '$'),
('Colón', 'CRC', '₡'),
('Kuna', 'HRK', 'kn'),
('Pesos', 'CUP', '₱'),
('Koruny', 'CZK', 'Kč'),
('Kroner', 'DKK', 'kr'),
('Pesos', 'DOP', 'RD$'),
('Dollars', 'XCD', '$'),
('Pounds', 'EGP', '£'),
('Colones', 'SVC', '$'),
('Pounds', 'FKP', '£'),
('Dollars', 'FJD', '$'),
('Cedis', 'GHC', '¢'),
('Pounds', 'GIP', '£'),
('Quetzales', 'GTQ', 'Q'),
('Pounds', 'GGP', '£'),
('Dollars', 'GYD', '$'),
('Lempiras', 'HNL', 'L'),
('Dollars', 'HKD', '$'),
('Forint', 'HUF', 'Ft'),
('Kronur', 'ISK', 'kr'),
('Rupees', 'INR', 'Rp'),
('Rupiahs', 'IDR', 'Rp'),
('Rials', 'IRR', '﷼'),
('Pounds', 'IMP', '£'),
('New Shekels', 'ILS', '₪'),
('Dollars', 'JMD', 'J$'),
('Yen', 'JPY', '¥'),
('Pounds', 'JEP', '£'),
('Tenge', 'KZT', 'лв'),
('Won', 'KPW', '₩'),
('Won', 'KRW', '₩'),
('Soms', 'KGS', 'лв'),
('Kips', 'LAK', '₭'),
('Lati', 'LVL', 'Ls'),
('Pounds', 'LBP', '£'),
('Dollars', 'LRD', '$'),
('Switzerland Francs', 'CHF', 'CHF'),
('Litai', 'LTL', 'Lt'),
('Denars', 'MKD', 'ден'),
('Ringgits', 'MYR', 'RM'),
('Rupees', 'MUR', '₨'),
('Pesos', 'MXN', '$'),
('Tugriks', 'MNT', '₮'),
('Meticais', 'MZN', 'MT'),
('Dollars', 'NAD', '$'),
('Rupees', 'NPR', '₨'),
('Guilders', 'ANG', 'ƒ'),
('Dollars', 'NZD', '$'),
('Cordobas', 'NIO', 'C$'),
('Nairas', 'NGN', '₦'),
('Krone', 'NOK', 'kr'),
('Rials', 'OMR', '﷼'),
('Rupees', 'PKR', '₨'),
('Balboa', 'PAB', 'B/.'),
('Guarani', 'PYG', 'Gs'),
('Nuevos Soles', 'PEN', 'S/.'),
('Pesos', 'PHP', 'Php'),
('Zlotych', 'PLN', 'zł'),
('Rials', 'QAR', '﷼'),
('New Lei', 'RON', 'lei'),
('Rubles', 'RUB', 'руб'),
('Pounds', 'SHP', '£'),
('Riyals', 'SAR', '﷼'),
('Dinars', 'RSD', 'Дин.'),
('Rupees', 'SCR', '₨'),
('Dollars', 'SGD', '$'),
('Dollars', 'SBD', '$'),
('Shillings', 'SOS', 'S'),
('Rand', 'ZAR', 'R'),
('Rupees', 'LKR', '₨'),
('Kronor', 'SEK', 'kr'),
('Dollars', 'SRD', '$'),
('Pounds', 'SYP', '£'),
('New Dollars', 'TWD', 'NT$'),
('Baht', 'THB', '฿'),
('Dollars', 'TTD', 'TT$'),
('Lira', 'TRY', '₺'),
('Liras', 'TRL', '£'),
('Dollars', 'TVD', '$'),
('Hryvnia', 'UAH', '₴'),
('Pesos', 'UYU', '$U'),
('Sums', 'UZS', 'лв'),
('Bolivares Fuertes', 'VEF', 'Bs'),
('Dong', 'VND', '₫'),
('Rials', 'YER', '﷼'),
('Zimbabwe Dollars', 'ZWD', 'Z$');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_zip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_zip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` text COLLATE utf8mb4_unicode_ci,
  `lang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `balance` double(8,2) NOT NULL DEFAULT '0.00',
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields_module_list`
--

CREATE TABLE `custom_fields_module_list` (
  `id` bigint UNSIGNED NOT NULL,
  `module` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_module` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE `deals` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `pipeline_id` int NOT NULL,
  `stage_id` int NOT NULL,
  `sources` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `products` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `labels` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int NOT NULL,
  `is_active` int NOT NULL DEFAULT '1',
  `workspace_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deal_activity_logs`
--

CREATE TABLE `deal_activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `deal_id` bigint UNSIGNED NOT NULL,
  `log_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deal_calls`
--

CREATE TABLE `deal_calls` (
  `id` bigint UNSIGNED NOT NULL,
  `deal_id` bigint UNSIGNED NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `call_type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `call_result` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deal_discussions`
--

CREATE TABLE `deal_discussions` (
  `id` bigint UNSIGNED NOT NULL,
  `deal_id` bigint UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deal_emails`
--

CREATE TABLE `deal_emails` (
  `id` bigint UNSIGNED NOT NULL,
  `deal_id` bigint UNSIGNED NOT NULL,
  `to` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deal_files`
--

CREATE TABLE `deal_files` (
  `id` bigint UNSIGNED NOT NULL,
  `deal_id` bigint UNSIGNED NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deal_stages`
--

CREATE TABLE `deal_stages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pipeline_id` int NOT NULL,
  `created_by` int NOT NULL,
  `order` int NOT NULL DEFAULT '0',
  `workspace_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deal_stages`
--

INSERT INTO `deal_stages` (`id`, `name`, `pipeline_id`, `created_by`, `order`, `workspace_id`, `created_at`, `updated_at`) VALUES
(1, 'Initial Contact', 1, 2, 0, 1, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(2, 'Qualification', 1, 2, 0, 1, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(3, 'Meeting', 1, 2, 0, 1, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(4, 'Proposal', 1, 2, 0, 1, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(5, 'Close', 1, 2, 0, 1, '2023-07-11 01:09:40', '2023-07-11 01:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `deal_tasks`
--

CREATE TABLE `deal_tasks` (
  `id` bigint UNSIGNED NOT NULL,
  `deal_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `priority` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `debit_notes`
--

CREATE TABLE `debit_notes` (
  `id` bigint UNSIGNED NOT NULL,
  `bill` int NOT NULL DEFAULT '0',
  `vendor` int NOT NULL DEFAULT '0',
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `date` date NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deduction_options`
--

CREATE TABLE `deduction_options` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `branch_id` int NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint UNSIGNED NOT NULL,
  `branch_id` int DEFAULT NULL,
  `department_id` int NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `document_types`
--

CREATE TABLE `document_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_required` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `module_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `workspace_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `name`, `from`, `module_name`, `created_by`, `workspace_id`, `created_at`, `updated_at`) VALUES
(1, 'New User', 'WorkDo Dash', 'general', 1, 0, '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(2, 'Customer Invoice Send', 'WorkDo Dash', 'general', 1, 0, '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(3, 'Payment Reminder', 'WorkDo Dash', 'general', 1, 0, '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(4, 'Invoice Payment Create', 'WorkDo Dash', 'general', 1, 0, '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(5, 'Proposal Send', 'WorkDo Dash', 'general', 1, 0, '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(6, 'Bill Send', 'Account', 'Account', 1, 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(7, 'Bill Payment Create', 'Account', 'Account', 1, 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(8, 'Revenue Payment Create', 'Account', 'Account', 1, 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(9, 'Leave Status', 'HRM', 'Hrm', 1, 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(10, 'New Award', 'HRM', 'Hrm', 1, 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(11, 'Employee Transfer', 'HRM', 'Hrm', 1, 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(12, 'Employee Resignation', 'HRM', 'Hrm', 1, 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(13, 'Employee Trip', 'HRM', 'Hrm', 1, 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(14, 'Employee Promotion', 'HRM', 'Hrm', 1, 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(15, 'Employee Complaints', 'HRM', 'Hrm', 1, 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(16, 'Employee Warning', 'HRM', 'Hrm', 1, 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(17, 'Employee Termination', 'HRM', 'Hrm', 1, 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(18, 'New Payroll', 'HRM', 'Hrm', 1, 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(19, 'Deal Assigned', 'Lead', 'Lead', 1, 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(20, 'Deal Moved', 'Lead', 'Lead', 1, 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(21, 'New Task', 'Lead', 'Lead', 1, 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(22, 'Lead Assigned', 'Lead', 'Lead', 1, 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(23, 'Lead Moved', 'Lead', 'Lead', 1, 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(24, 'Purchase Send', 'Pos', 'Pos', 1, 0, '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(25, 'Purchase Payment Create', 'Pos', 'Pos', 1, 0, '2023-07-11 01:09:29', '2023-07-11 01:09:29');

-- --------------------------------------------------------

--
-- Table structure for table `email_template_langs`
--

CREATE TABLE `email_template_langs` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `lang` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `module_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `variables` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_template_langs`
--

INSERT INTO `email_template_langs` (`id`, `parent_id`, `lang`, `subject`, `content`, `module_name`, `variables`, `created_at`, `updated_at`) VALUES
(1, 1, 'ar', 'Login Detail', '<p>مرحبا،&nbsp;<br>مرحبا بك في {app_name}.</p><p><b>البريد الإلكتروني </b>: {email}<br><b>كلمه السر</b> : {password}</p><p>{app_url}</p><p>شكر،<br>{app_name}</p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(2, 1, 'da', 'Login Detail', '<p>Hej,&nbsp;<br>Velkommen til {app_name}.</p><p><b>E-mail </b>: {email}<br><b>Adgangskode</b> : {password}</p><p>{app_url}</p><p>Tak,<br>{app_name}</p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(3, 1, 'de', 'Login Detail', '<p>Hallo,&nbsp;<br>Willkommen zu {app_name}.</p><p><b>Email </b>: {email}<br><b>Passwort</b> : {password}</p><p>{app_url}</p><p>Vielen Dank,<br>{app_name}</p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(4, 1, 'en', 'Login Detail', '<p>Hello,&nbsp;<br />Welcome to {app_name}</p>\n                    <p><strong>Email </strong>: {email}<br /><strong>Password</strong> : {password}</p>\n                    <p>{app_url}</p>\n                    <p>Thanks,<br />{app_name}</p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(5, 1, 'es', 'Login Detail', '<p>Hola,&nbsp;<br>Bienvenido a {app_name}.</p><p><b>Correo electrónico </b>: {email}<br><b>Contraseña</b> : {password}</p><p>{app_url}</p><p>Gracias,<br>{app_name}</p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(6, 1, 'fr', 'Login Detail', '<p>Bonjour,&nbsp;<br>Bienvenue à {app_name}.</p><p><b>Email </b>: {email}<br><b>Mot de passe</b> : {password}</p><p>{app_url}</p><p>Merci,<br>{app_name}</p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(7, 1, 'it', 'Login Detail', '<p>Ciao,&nbsp;<br>Benvenuto a {app_name}.</p><p><b>E-mail </b>: {email}<br><b>Parola d\'ordine</b> : {password}</p><p>{app_url}</p><p>Grazie,<br>{app_name}</p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(8, 1, 'ja', 'Login Detail', '<p>こんにちは、&nbsp;<br>へようこそ {app_name}.</p><p><b>Eメール </b>: {email}<br><b>パスワード</b> : {password}</p><p>{app_url}</p><p>おかげで、<br>{app_name}</p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(9, 1, 'nl', 'Login Detail', '<p>Hallo,&nbsp;<br>Welkom bij {app_name}.</p><p><b>E-mail </b>: {email}<br><b>Wachtwoord</b> : {password}</p><p>{app_url}</p><p>Bedankt,<br>{app_name}</p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(10, 1, 'pl', 'Login Detail', '<p>Witaj,&nbsp;<br>Witamy w {app_name}.</p><p><b>E-mail </b>: {email}<br><b>Hasło</b> : {password}</p><p>{app_url}</p><p>Dzięki,<br>{app_name}</p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(11, 1, 'ru', 'Login Detail', '<p>Привет,&nbsp;<br>Добро пожаловать в {app_name}.</p><p><b>Электронное письмо </b>: {email}<br><b>пароль</b> : {password}</p><p>{app_url}</p><p>Спасибо,<br>{app_name}</p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(12, 1, 'pt', 'Login Detail', '<p>Ol&aacute;, Bem-vindo a {app_name}.</p>\n                    <p>E-mail: {email}</p>\n                    <p>Senha: {password}</p>\n                    <p>{app_url}</p>\n                    <p>&nbsp;</p>\n                    <p>Obrigado,</p>\n                    <p>{app_name}</p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(13, 2, 'ar', 'Customer Invoice Send', '<p>مرحبا ، { invoice_name }</p>\n                    <p>مرحبا بك في { app_name }</p>\n                    <p>أتمنى أن يجدك هذا البريد الإلكتروني جيدا برجاء الرجوع الى رقم الفاتورة الملحقة { invoice_number } للخدمة / الخدمة.</p>\n                    <p>ببساطة اضغط على الاختيار بأسفل.</p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{invoice_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">الفاتورة</strong> </a></span></p>\n                    <p>إشعر بالحرية للوصول إلى الخارج إذا عندك أي أسئلة.</p>\n                    <p>شكرا لك</p>\n                    <p>&nbsp;</p>\n                    <p>Regards,</p>\n                    <p>{ company_name }</p>\n                    <p>{ app_url }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Invoice Url\": \"invoice_url\", \"Company Name\": \"company_name\", \"Invoice Name\": \"invoice_name\", \"Invoice Number\": \"invoice_number\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(14, 2, 'da', 'Customer Invoice Send', '<p>Hej, { invoice_name }</p>\n                    <p>Velkommen til { app_name }</p>\n                    <p>H&aring;ber denne e-mail finder dig godt! Se vedlagte fakturanummer { invoice_number } for product/service.</p>\n                    <p>Klik p&aring; knappen nedenfor.</p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{invoice_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Faktura</strong> </a></span></p>\n                    <p>Du er velkommen til at r&aelig;kke ud, hvis du har nogen sp&oslash;rgsm&aring;l.</p>\n                    <p>Tak.</p>\n                    <p>&nbsp;</p>\n                    <p>Med venlig hilsen</p>\n                    <p>{ company_name }</p>\n                    <p>{ app_url }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Invoice Url\": \"invoice_url\", \"Company Name\": \"company_name\", \"Invoice Name\": \"invoice_name\", \"Invoice Number\": \"invoice_number\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(15, 2, 'de', 'Customer Invoice Send', '<p>Hi, {invoice_name}</p>\n                    <p>Willkommen bei {app_name}</p>\n                    <p>Hoffe, diese E-Mail findet dich gut! Bitte beachten Sie die beigef&uuml;gte Rechnungsnummer {invoice_number} f&uuml;r Produkt/Service.</p>\n                    <p>Klicken Sie einfach auf den Button unten.</p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{invoice_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Rechnung</strong> </a></span></p>\n                    <p>F&uuml;hlen Sie sich frei, wenn Sie Fragen haben.</p>\n                    <p>Vielen Dank,</p>\n                    <p>&nbsp;</p>\n                    <p>Betrachtet,</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>\n                    ', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Invoice Url\": \"invoice_url\", \"Company Name\": \"company_name\", \"Invoice Name\": \"invoice_name\", \"Invoice Number\": \"invoice_number\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(16, 2, 'en', 'Customer Invoice Send', '<p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif; font-size: 15px; font-variant-ligatures: common-ligatures; background-color: #f8f8f8;\">Hi, {invoice_name}</span></p>\n                    <p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif; font-size: 15px; font-variant-ligatures: common-ligatures; background-color: #f8f8f8;\">Welcome to {app_name}</span></p>\n                    <p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif; font-size: 15px; font-variant-ligatures: common-ligatures; background-color: #f8f8f8;\">Hope this email finds you well! Please see attached invoice number {invoice_number} for product/service.</span></p>\n                    <p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif; font-size: 15px; font-variant-ligatures: common-ligatures; background-color: #f8f8f8;\">Simply click on the button below.</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{invoice_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">invoice</strong> </a></span></p>\n                    <p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif; font-size: 15px; font-variant-ligatures: common-ligatures; background-color: #f8f8f8;\">Feel free to reach out if you have any questions.</span></p>\n                    <p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif; font-size: 15px; font-variant-ligatures: common-ligatures; background-color: #f8f8f8;\">Thank You,</span></p>\n                    <p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif; font-size: 15px; font-variant-ligatures: common-ligatures; background-color: #f8f8f8;\">Regards,</span></p>\n                    <p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif; font-size: 15px; font-variant-ligatures: common-ligatures; background-color: #f8f8f8;\">{company_name}</span></p>\n                    <p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif; font-size: 15px; font-variant-ligatures: common-ligatures; background-color: #f8f8f8;\">{app_url}</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Invoice Url\": \"invoice_url\", \"Company Name\": \"company_name\", \"Invoice Name\": \"invoice_name\", \"Invoice Number\": \"invoice_number\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(17, 2, 'es', 'Customer Invoice Send', '<p>Hi, {invoice_name}</p>\n                    <p>&nbsp;</p>\n                    <p>Bienvenido a {app_name}</p>+\n                    <p>&nbsp;</p>\n                    <p>&iexcl;Espero que este email le encuentre bien! Consulte el n&uacute;mero de factura adjunto {invoice_number} para el producto/servicio.</p>\n                    <p>&nbsp;</p>\n                    <p>Simplemente haga clic en el bot&oacute;n de abajo.</p>\n                    <p>&nbsp;</p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{invoice_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Factura</strong> </a></span></p>\n                    <p>&nbsp;</p>\n                    <p>Si&eacute;ntase libre de llegar si usted tiene alguna pregunta.</p>\n                    <p>&nbsp;</p>\n                    <p>Gracias,</p>\n                    <p>&nbsp;</p>\n                    <p>Considerando,</p>\n                    <p>&nbsp;</p>\n                    <p>{company_name}</p>\n                    <p>&nbsp;</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Invoice Url\": \"invoice_url\", \"Company Name\": \"company_name\", \"Invoice Name\": \"invoice_name\", \"Invoice Number\": \"invoice_number\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(18, 2, 'fr', 'Customer Invoice Send', '<p>Bonjour, { invoice_name }</p>\n                    <p>&nbsp;</p>\n                    <p>Bienvenue dans { app_name }</p>\n                    <p>&nbsp;</p>\n                    <p>Jesp&egrave;re que ce courriel vous trouve bien ! Voir le num&eacute;ro de facture { invoice_number } pour le produit/service.</p>\n                    <p>&nbsp;</p>\n                    <p>Cliquez simplement sur le bouton ci-dessous.</p>\n                    <p>&nbsp;</p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{invoice_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Facture</strong> </a></span></p>\n                    <p>&nbsp;</p>\n                    <p>Nh&eacute;sitez pas &agrave; nous contacter si vous avez des questions.</p>\n                    <p>&nbsp;</p>\n                    <p>Merci,</p>\n                    <p>&nbsp;</p>\n                    <p>Regards,</p>\n                    <p>&nbsp;</p>\n                    <p>{ company_name }</p>\n                    <p>&nbsp;</p>\n                    <p>{ app_url }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Invoice Url\": \"invoice_url\", \"Company Name\": \"company_name\", \"Invoice Name\": \"invoice_name\", \"Invoice Number\": \"invoice_number\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(19, 2, 'it', 'Customer Invoice Send', '<p>Ciao, {invoice_name}</p>\n                    <p>&nbsp;</p>\n                    <p>Benvenuti in {app_name}</p>\n                    <p>&nbsp;</p>\n                    <p>Spero che questa email ti trovi bene! Si prega di consultare il numero di fattura collegato {invoice_number} per il prodotto/servizio.</p>\n                    <p>&nbsp;</p>\n                    <p>Semplicemente clicca sul pulsante sottostante.</p>\n                    <p>&nbsp;</p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{invoice_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Fattura</strong> </a></span></p>\n                    <p>&nbsp;</p>\n                    <p>Sentiti libero di raggiungere se hai domande.</p>\n                    <p>&nbsp;</p>\n                    <p>Grazie,</p>\n                    <p>&nbsp;</p>\n                    <p>Riguardo,</p>\n                    <p>&nbsp;</p>\n                    <p>{company_name}</p>\n                    <p>&nbsp;</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Invoice Url\": \"invoice_url\", \"Company Name\": \"company_name\", \"Invoice Name\": \"invoice_name\", \"Invoice Number\": \"invoice_number\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(20, 2, 'ja', 'Customer Invoice Send', '<p>こんにちは、 {invoice_name}</p>\n                    <p>&nbsp;</p>\n                    <p>{app_name} へようこそ</p>\n                    <p>&nbsp;</p>\n                    <p>この E メールでよくご確認ください。 製品 / サービスについては、添付された請求書番号 {invoice_number} を参照してください。</p>\n                    <p>&nbsp;</p>\n                    <p>以下のボタンをクリックしてください。</p>\n                    <p>&nbsp;</p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{invoice_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">インボイス</strong> </a></span></p>\n                    <p>&nbsp;</p>\n                    <p>質問がある場合は、自由に連絡してください。</p>\n                    <p>&nbsp;</p>\n                    <p>ありがとうございます</p>\n                    <p>&nbsp;</p>\n                    <p>よろしく</p>\n                    <p>&nbsp;</p>\n                    <p>{ company_name}</p>\n                    <p>&nbsp;</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Invoice Url\": \"invoice_url\", \"Company Name\": \"company_name\", \"Invoice Name\": \"invoice_name\", \"Invoice Number\": \"invoice_number\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(21, 2, 'nl', 'Customer Invoice Send', '<p>Hallo, { invoice_name }</p>\n                    <p>Welkom bij { app_name }</p>\n                    <p>Hoop dat deze e-mail je goed vindt! Zie bijgevoegde factuurnummer { invoice_number } voor product/service.</p>\n                    <p>Klik gewoon op de knop hieronder.</p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{invoice_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Factuur</strong> </a></span></p>\n                    <p>Voel je vrij om uit te reiken als je vragen hebt.</p>\n                    <p>Dank U,</p>\n                    <p>Betreft:</p>\n                    <p>{ company_name }</p>\n                    <p>{ app_url }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Invoice Url\": \"invoice_url\", \"Company Name\": \"company_name\", \"Invoice Name\": \"invoice_name\", \"Invoice Number\": \"invoice_number\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(22, 2, 'pl', 'Customer Invoice Send', '<p>Witaj, {invoice_name }</p>\n                    <p>&nbsp;</p>\n                    <p>Witamy w aplikacji {app_name }</p>\n                    <p>&nbsp;</p>\n                    <p>Mam nadzieję, że ta wiadomość znajdzie Cię dobrze! Sprawdź załączoną fakturę numer {invoice_number } dla produktu/usługi.</p>\n                    <p>&nbsp;</p>\n                    <p>Wystarczy kliknąć na przycisk poniżej.</p>\n                    <p>&nbsp;</p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{invoice_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Faktura</strong> </a></span></p>\n                    <p>&nbsp;</p>\n                    <p>Czuj się swobodnie, jeśli masz jakieś pytania.</p>\n                    <p>&nbsp;</p>\n                    <p>Dziękuję,</p>\n                    <p>&nbsp;</p>\n                    <p>W odniesieniu do</p>\n                    <p>&nbsp;</p>\n                    <p>{company_name }</p>\n                    <p>&nbsp;</p>\n                    <p>{app_url }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Invoice Url\": \"invoice_url\", \"Company Name\": \"company_name\", \"Invoice Name\": \"invoice_name\", \"Invoice Number\": \"invoice_number\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(23, 2, 'ru', 'Customer Invoice Send', '<p>Привет, { invoice_name }</p>\n                    <p>&nbsp;</p>\n                    <p>Вас приветствует { app_name }</p>\n                    <p>&nbsp;</p>\n                    <p>Надеюсь, это электронное письмо найдет вас хорошо! См. вложенный номер счета-фактуры { invoice_number } для производства/услуги.</p>\n                    <p>&nbsp;</p>\n                    <p>Просто нажмите на кнопку внизу.</p>\n                    <p>&nbsp;</p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{invoice_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">счет</strong> </a></span></p>\n                    <p>&nbsp;</p>\n                    <p>Не стеснитесь, если у вас есть вопросы.</p>\n                    <p>&nbsp;</p>\n                    <p>Спасибо.</p>\n                    <p>&nbsp;</p>\n                    <p>С уважением,</p>\n                    <p>&nbsp;</p>\n                    <p>{ company_name }</p>\n                    <p>&nbsp;</p>\n                    <p>{ app_url }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Invoice Url\": \"invoice_url\", \"Company Name\": \"company_name\", \"Invoice Name\": \"invoice_name\", \"Invoice Number\": \"invoice_number\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(24, 2, 'pt', 'Customer Invoice Send', '<p>Oi, {invoice_name}</p>\n                    <p>&nbsp;</p>\n                    <p>Bem-vindo a {app_name}</p>\n                    <p>&nbsp;</p>\n                    <p>Espero que este e-mail encontre voc&ecirc; bem! Por favor, consulte o n&uacute;mero da fatura anexa {invoice_number} para produto/servi&ccedil;o.</p>\n                    <p>&nbsp;</p>\n                    <p>Basta clicar no bot&atilde;o abaixo.</p>\n                    <p>&nbsp;</p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{invoice_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Fatura</strong> </a></span></p>\n                    <p>&nbsp;</p>\n                    <p>Sinta-se &agrave; vontade para alcan&ccedil;ar fora se voc&ecirc; tiver alguma d&uacute;vida.</p>\n                    <p>&nbsp;</p>\n                    <p>Obrigado,</p>\n                    <p>&nbsp;</p>\n                    <p>Considera,</p>\n                    <p>&nbsp;</p>\n                    <p>{company_name}</p>\n                    <p>&nbsp;</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Invoice Url\": \"invoice_url\", \"Company Name\": \"company_name\", \"Invoice Name\": \"invoice_name\", \"Invoice Number\": \"invoice_number\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(25, 3, 'ar', 'Payment Reminder', '<p>عزيزي ، { payment_name }</p>\n                    <p>آمل أن تكون بخير. هذا مجرد تذكير بأن الدفع على الفاتورة { invoice_number } الاجمالي { payment_dueAmount } ، والتي قمنا بارسالها على { payment_date } مستحق اليوم.</p>\n                    <p>يمكنك دفع مبلغ لحساب البنك المحدد على الفاتورة.</p>\n                    <p>أنا متأكد أنت مشغول ، لكني أقدر إذا أنت يمكن أن تأخذ a لحظة ونظرة على الفاتورة عندما تحصل على فرصة.</p>\n                    <p>إذا كان لديك أي سؤال مهما يكن ، يرجى الرد وسأكون سعيدا لتوضيحها.</p>\n                    <p>&nbsp;</p>\n                    <p>شكرا&nbsp;</p>\n                    <p>{ company_name }</p>\n                    <p>{ app_url }</p>\n                    <p>&nbsp;</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Invoice Number\": \"invoice_number\", \"Payment Due Amount\": \"payment_dueAmount\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(26, 3, 'da', 'Payment Reminder', '<p>K&aelig;re, { payment_name }</p>\n                    <p>Dette er blot en p&aring;mindelse om, at betaling p&aring; faktura { invoice_number } i alt { payment_dueAmount}, som vi sendte til { payment_date }, er forfalden i dag.</p>\n                    <p>Du kan foretage betalinger til den bankkonto, der er angivet p&aring; fakturaen.</p>\n                    <p>Jeg er sikker p&aring; du har travlt, men jeg ville s&aelig;tte pris p&aring;, hvis du kunne tage et &oslash;jeblik og se p&aring; fakturaen, n&aring;r du f&aring;r en chance.</p>\n                    <p>Hvis De har nogen sp&oslash;rgsm&aring;l, s&aring; svar venligst, og jeg vil med gl&aelig;de tydeligg&oslash;re dem.</p>\n                    <p>&nbsp;</p>\n                    <p>Tak.&nbsp;</p>\n                    <p>{ company_name }</p>\n                    <p>{ app_url }</p>\n                    <p>&nbsp;</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Invoice Number\": \"invoice_number\", \"Payment Due Amount\": \"payment_dueAmount\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(27, 3, 'de', 'Payment Reminder', '<p>Sehr geehrte/r, {payment_name}</p>\n                    <p>Ich hoffe, Sie sind gut. Dies ist nur eine Erinnerung, dass die Zahlung auf Rechnung {invoice_number} total {payment_dueAmount}, die wir gesendet am {payment_date} ist heute f&auml;llig.</p>\n                    <p>Sie k&ouml;nnen die Zahlung auf das auf der Rechnung angegebene Bankkonto vornehmen.</p>\n                    <p>Ich bin sicher, Sie sind besch&auml;ftigt, aber ich w&uuml;rde es begr&uuml;&szlig;en, wenn Sie einen Moment nehmen und &uuml;ber die Rechnung schauen k&ouml;nnten, wenn Sie eine Chance bekommen.</p>\n                    <p>Wenn Sie irgendwelche Fragen haben, antworten Sie bitte und ich w&uuml;rde mich freuen, sie zu kl&auml;ren.</p>\n                    <p>&nbsp;</p>\n                    <p>Danke,&nbsp;</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>\n                    <p>&nbsp;</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Invoice Number\": \"invoice_number\", \"Payment Due Amount\": \"payment_dueAmount\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(28, 3, 'en', 'Payment Reminder', '<p>Dear, {payment_name}</p>\n                    <p>I hope you&rsquo;re well.This is just a reminder that payment on invoice {invoice_number} total dueAmount {payment_dueAmount} , which we sent on {payment_date} is due today.</p>\n                    <p>You can make payment to the bank account specified on the invoice.</p>\n                    <p>I&rsquo;m sure you&rsquo;re busy, but I&rsquo;d appreciate if you could take a moment and look over the invoice when you get a chance.</p>\n                    <p>If you have any questions whatever, please reply and I&rsquo;d be happy to clarify them.</p>\n                    <p>&nbsp;</p>\n                    <p>Thanks,&nbsp;</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>\n                    <p>&nbsp;</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Invoice Number\": \"invoice_number\", \"Payment Due Amount\": \"payment_dueAmount\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(29, 3, 'es', 'Payment Reminder', '<p>Estimado, {payment_name}</p>\n                    <p>Espero que est&eacute;s bien. Esto es s&oacute;lo un recordatorio de que el pago en la factura {invoice_number} total {payment_dueAmount}, que enviamos en {payment_date} se vence hoy.</p>\n                    <p>Puede realizar el pago a la cuenta bancaria especificada en la factura.</p>\n                    <p>Estoy seguro de que est&aacute;s ocupado, pero agradecer&iacute;a si podr&iacute;as tomar un momento y mirar sobre la factura cuando tienes una oportunidad.</p>\n                    <p>Si tiene alguna pregunta, por favor responda y me gustar&iacute;a aclararlas.</p>\n                    <p>&nbsp;</p>\n                    <p>Gracias,&nbsp;</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>\n                    <p>&nbsp;</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Invoice Number\": \"invoice_number\", \"Payment Due Amount\": \"payment_dueAmount\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(30, 3, 'fr', 'Payment Reminder', '<p>Cher, { payment_name }</p>\n                    <p>Jesp&egrave;re que vous &ecirc;tes bien, ce nest quun rappel que le paiement sur facture {invoice_number}total { payment_dueAmount }, que nous avons envoy&eacute; le {payment_date} est d&ucirc; aujourdhui.</p>\n                    <p>Vous pouvez effectuer le paiement sur le compte bancaire indiqu&eacute; sur la facture.</p>\n                    <p>Je suis s&ucirc;r que vous &ecirc;tes occup&eacute;, mais je vous serais reconnaissant de prendre un moment et de regarder la facture quand vous aurez une chance.</p>\n                    <p>Si vous avez des questions, veuillez r&eacute;pondre et je serais heureux de les clarifier.</p>\n                    <p>&nbsp;</p>\n                    <p>Merci,&nbsp;</p>\n                    <p>{ company_name }</p>\n                    <p>{ app_url }</p>\n                    <p>&nbsp;</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Invoice Number\": \"invoice_number\", \"Payment Due Amount\": \"payment_dueAmount\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(31, 3, 'it', 'Payment Reminder', '<p>Caro, {payment_name}</p>\n                    <p>Spero che tu stia bene, questo &egrave; solo un promemoria che il pagamento sulla fattura {invoice_number} totale {payment_dueAmount}, che abbiamo inviato su {payment_date} &egrave; dovuto oggi.</p>\n                    <p>&Egrave; possibile effettuare il pagamento al conto bancario specificato sulla fattura.</p>\n                    <p>Sono sicuro che sei impegnato, ma apprezzerei se potessi prenderti un momento e guardare la fattura quando avrai una chance.</p>\n                    <p>Se avete domande qualunque, vi prego di rispondere e sarei felice di chiarirle.</p>\n                    <p>&nbsp;</p>\n                    <p>Grazie,&nbsp;</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>\n                    <p>&nbsp;</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Invoice Number\": \"invoice_number\", \"Payment Due Amount\": \"payment_dueAmount\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(32, 3, 'ja', 'Payment Reminder', '<p>ID、 {payment_name}</p>\n                    <p>これは、 { payment_dueAmount} の合計 {payment_dueAmount } に対する支払いが今日予定されていることを思い出させていただきたいと思います。</p>\n                    <p>請求書に記載されている銀行口座に対して支払いを行うことができます。</p>\n                    <p>お忙しいのは確かですが、機会があれば、少し時間をかけてインボイスを見渡すことができればありがたいのですが。</p>\n                    <p>何か聞きたいことがあるなら、お返事をお願いしますが、喜んでお答えします。</p>\n                    <p>&nbsp;</p>\n                    <p>ありがとう。&nbsp;</p>\n                    <p>{ company_name}</p>\n                    <p>{app_url}</p>\n                    <p>&nbsp;</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Invoice Number\": \"invoice_number\", \"Payment Due Amount\": \"payment_dueAmount\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(33, 3, 'nl', 'Payment Reminder', '<p>Geachte, { payment_name }</p>\n                    <p>Ik hoop dat u goed bent. Dit is gewoon een herinnering dat betaling op factuur { invoice_number } totaal { payment_dueAmount }, die we verzonden op { payment_date } is vandaag verschuldigd.</p>\n                    <p>U kunt betaling doen aan de bankrekening op de factuur.</p>\n                    <p>Ik weet zeker dat je het druk hebt, maar ik zou het op prijs stellen als je even over de factuur kon kijken als je een kans krijgt.</p>\n                    <p>Als u vragen hebt, beantwoord dan uw antwoord en ik wil ze graag verduidelijken.</p>\n                    <p>&nbsp;</p>\n                    <p>Bedankt.&nbsp;</p>\n                    <p>{ company_name }</p>\n                    <p>{ app_url }</p>\n                    <p>&nbsp;</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Invoice Number\": \"invoice_number\", \"Payment Due Amount\": \"payment_dueAmount\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(34, 3, 'pl', 'Payment Reminder', '<p>Drogi, {payment_name }</p>\n                    <p>Mam nadzieję, że jesteś dobrze. To jest tylko przypomnienie, że płatność na fakturze {invoice_number } total {payment_dueAmount }, kt&oacute;re wysłaliśmy na {payment_date } jest dzisiaj.</p>\n                    <p>Płatność można dokonać na rachunek bankowy podany na fakturze.</p>\n                    <p>Jestem pewien, że jesteś zajęty, ale byłbym wdzięczny, gdybyś m&oacute;gł wziąć chwilę i spojrzeć na fakturę, kiedy masz szansę.</p>\n                    <p>Jeśli masz jakieś pytania, proszę o odpowiedź, a ja chętnie je wyjaśniam.</p>\n                    <p>&nbsp;</p>\n                    <p>Dziękuję,&nbsp;</p>\n                    <p>{company_name }</p>\n                    <p>{app_url }</p>\n                    <p>&nbsp;</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Invoice Number\": \"invoice_number\", \"Payment Due Amount\": \"payment_dueAmount\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(35, 3, 'ru', 'Payment Reminder', '<p>Уважаемый, { payment_name }</p>\n                    <p>Я надеюсь, что вы хорошо. Это просто напоминание о том, что оплата по счету { invoice_number } всего { payment_dueAmount }, которое мы отправили в { payment_date }, сегодня.</p>\n                    <p>Вы можете произвести платеж на банковский счет, указанный в счете-фактуре.</p>\n                    <p>Я уверена, что ты занята, но я была бы признательна, если бы ты смог бы поглядеться на счет, когда у тебя появится шанс.</p>\n                    <p>Если у вас есть вопросы, пожалуйста, ответьте, и я буду рад их прояснить.</p>\n                    <p>&nbsp;</p>\n                    <p>Спасибо.&nbsp;</p>\n                    <p>{ company_name }</p>\n                    <p>{ app_url }</p>\n                    <p>&nbsp;</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Invoice Number\": \"invoice_number\", \"Payment Due Amount\": \"payment_dueAmount\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(36, 3, 'pt', 'Payment Reminder', '<p>Querido, {payment_name}</p>\n                    <p>Espero que voc&ecirc; esteja bem. Este &eacute; apenas um lembrete de que o pagamento na fatura {invoice_number} total {payment_dueAmount}, que enviamos em {payment_date} &eacute; devido hoje.</p>\n                    <p>Voc&ecirc; pode fazer o pagamento &agrave; conta banc&aacute;ria especificada na fatura.</p>\n                    <p>Eu tenho certeza que voc&ecirc; est&aacute; ocupado, mas eu agradeceria se voc&ecirc; pudesse tirar um momento e olhar sobre a fatura quando tiver uma chance.</p>\n                    <p>Se voc&ecirc; tiver alguma d&uacute;vida o que for, por favor, responda e eu ficaria feliz em esclarec&ecirc;-las.</p>\n                    <p>&nbsp;</p>\n                    <p>Obrigado,&nbsp;</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>\n                    <p>&nbsp;</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Invoice Number\": \"invoice_number\", \"Payment Due Amount\": \"payment_dueAmount\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(37, 4, 'ar', 'Invoice Payment Create', '<p>مرحبا</p>\n                    <p>مرحبا بك في { app_name }</p>\n                    <p>عزيزي { payment_name }</p>\n                    <p>لقد قمت باستلام المبلغ الخاص بك {payment_amount}&nbsp; لبرنامج { invoice_number } الذي تم تقديمه في التاريخ { payment_date }</p>\n                    <p>مقدار الاستحقاق { invoice_number } الخاص بك هو {payment_dueAmount}</p>\n                    <p>ونحن نقدر الدفع الفوري لكم ونتطلع إلى استمرار العمل معكم في المستقبل.</p>\n                    <p>&nbsp;</p>\n                    <p>شكرا جزيلا لكم ويوم جيد ! !</p>\n                    <p>&nbsp;</p>\n                    <p>Regards,</p>\n                    <p>{ company_name }</p>\n                    <p>{ app_url }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Invoice Number\": \"invoice_number\", \"Payment Amount\": \"payment_amount\", \"Payment dueAmount\": \"payment_dueAmount\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(38, 4, 'da', 'Invoice Payment Create', '<p>Hej.</p>\n                    <p>Velkommen til { app_name }</p>\n                    <p>K&aelig;re { payment_name }</p>\n                    <p>Vi har modtaget din m&aelig;ngde { payment_amount } betaling for { invoice_number } undert.d. p&aring; dato { payment_date }</p>\n                    <p>Dit { invoice_number } Forfaldsbel&oslash;b er { payment_dueAmount }</p>\n                    <p>Vi s&aelig;tter pris p&aring; din hurtige betaling og ser frem til fortsatte forretninger med dig i fremtiden.</p>\n                    <p>Mange tak, og ha en god dag!</p>\n                    <p>&nbsp;</p>\n                    <p>Med venlig hilsen</p>\n                    <p>{ company_name }</p>\n                    <p>{ app_url }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Invoice Number\": \"invoice_number\", \"Payment Amount\": \"payment_amount\", \"Payment dueAmount\": \"payment_dueAmount\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(39, 4, 'de', 'Invoice Payment Create', '<p>Hi,</p>\n                    <p>Willkommen bei {app_name}</p>\n                    <p>Sehr geehrter {payment_name}</p>\n                    <p>Wir haben Ihre Zahlung {payment_amount} f&uuml;r {invoice_number}, die am Datum {payment_date} &uuml;bergeben wurde, erhalten.</p>\n                    <p>Ihr {invoice_number} -f&auml;lliger Betrag ist {payment_dueAmount}</p>\n                    <p>Wir freuen uns &uuml;ber Ihre prompte Bezahlung und freuen uns auf das weitere Gesch&auml;ft mit Ihnen in der Zukunft.</p>\n                    <p>Vielen Dank und habe einen guten Tag!!</p>\n                    <p>&nbsp;</p>\n                    <p>Betrachtet,</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Invoice Number\": \"invoice_number\", \"Payment Amount\": \"payment_amount\", \"Payment dueAmount\": \"payment_dueAmount\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(40, 4, 'en', 'Invoice Payment Create', '<p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif;\"><span style=\"font-size: 15px; font-variant-ligatures: common-ligatures;\">Hi,</span></span></p>\n                    <p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif;\"><span style=\"font-size: 15px; font-variant-ligatures: common-ligatures;\">Welcome to {app_name}</span></span></p>\n                    <p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif;\"><span style=\"font-size: 15px; font-variant-ligatures: common-ligatures;\">Dear {payment_name}</span></span></p>\n                    <p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif;\"><span style=\"font-size: 15px; font-variant-ligatures: common-ligatures;\">We have recieved your amount {payment_amount} payment for {invoice_number} submited on date {payment_date}</span></span></p>\n                    <p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif;\"><span style=\"font-size: 15px; font-variant-ligatures: common-ligatures;\">Your {invoice_number} Due amount is {payment_dueAmount}</span></span></p>\n                    <p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif;\"><span style=\"font-size: 15px; font-variant-ligatures: common-ligatures;\">We appreciate your prompt payment and look forward to continued business with you in the future.</span></span></p>\n                    <p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif;\"><span style=\"font-size: 15px; font-variant-ligatures: common-ligatures;\">Thank you very much and have a good day!!</span></span></p>\n                    <p>&nbsp;</p>\n                    <p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif;\"><span style=\"font-size: 15px; font-variant-ligatures: common-ligatures;\">Regards,</span></span></p>\n                    <p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif;\"><span style=\"font-size: 15px; font-variant-ligatures: common-ligatures;\">{company_name}</span></span></p>\n                    <p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif;\"><span style=\"font-size: 15px; font-variant-ligatures: common-ligatures;\">{app_url}</span></span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Invoice Number\": \"invoice_number\", \"Payment Amount\": \"payment_amount\", \"Payment dueAmount\": \"payment_dueAmount\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(41, 4, 'es', 'Invoice Payment Create', '<p>Hola,</p>\n                    <p>Bienvenido a {app_name}</p>\n                    <p>Estimado {payment_name}</p>\n                    <p>Hemos recibido su importe {payment_amount} pago para {invoice_number} submitado en la fecha {payment_date}</p>\n                    <p>El importe de {invoice_number} Due es {payment_dueAmount}</p>\n                    <p>Agradecemos su pronto pago y esperamos continuar con sus negocios con usted en el futuro.</p>\n                    <p>Muchas gracias y que tengan un buen d&iacute;a!!</p>\n                    <p>&nbsp;</p>\n                    <p>Considerando,</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Invoice Number\": \"invoice_number\", \"Payment Amount\": \"payment_amount\", \"Payment dueAmount\": \"payment_dueAmount\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(42, 4, 'fr', 'Invoice Payment Create', '<p>Salut,</p>\n                    <p>Bienvenue dans { app_name }</p>\n                    <p>Cher { payment_name }</p>\n                    <p>Nous avons re&ccedil;u votre montant { payment_amount } de paiement pour { invoice_number } soumis le { payment_date }</p>\n                    <p>Votre {invoice_number} Montant d&ucirc; est { payment_dueAmount }</p>\n                    <p>Nous appr&eacute;cions votre rapidit&eacute; de paiement et nous attendons avec impatience de poursuivre vos activit&eacute;s avec vous &agrave; lavenir.</p>\n                    <p>Merci beaucoup et avez une bonne journ&eacute;e ! !</p>\n                    <p>&nbsp;</p>\n                    <p>Regards,</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Invoice Number\": \"invoice_number\", \"Payment Amount\": \"payment_amount\", \"Payment dueAmount\": \"payment_dueAmount\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(43, 4, 'it', 'Invoice Payment Create', '<p>Ciao,</p>\n                    <p>Benvenuti in {app_name}</p>\n                    <p>Caro {payment_name}</p>\n                    <p>Abbiamo ricevuto la tua quantit&agrave; {payment_amount} pagamento per {invoice_number} subita alla data {payment_date}</p>\n                    <p>Il tuo {invoice_number} A somma cifra &egrave; {payment_dueAmount}</p>\n                    <p>Apprezziamo il tuo tempestoso pagamento e non vedo lora di continuare a fare affari con te in futuro.</p>\n                    <p>Grazie mille e buona giornata!!</p>\n                    <p>&nbsp;</p>\n                    <p>Riguardo,</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Invoice Number\": \"invoice_number\", \"Payment Amount\": \"payment_amount\", \"Payment dueAmount\": \"payment_dueAmount\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(44, 4, 'ja', 'Invoice Payment Create', '<p>こんにちは。</p>\n                    <p>{app_name} へようこそ</p>\n                    <p>{ payment_name} に出れます</p>\n                    <p>{ payment_date} 日付で提出された {請求書番号} の支払金額 } の金額を回収しました。 }</p>\n                    <p>お客様の {請求書番号} 予定額は {payment_dueAmount} です</p>\n                    <p>お客様の迅速な支払いを評価し、今後も継続してビジネスを継続することを期待しています。</p>\n                    <p>ありがとうございます。良い日をお願いします。</p>\n                    <p>&nbsp;</p>\n                    <p>よろしく</p>\n                    <p>{ company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Invoice Number\": \"invoice_number\", \"Payment Amount\": \"payment_amount\", \"Payment dueAmount\": \"payment_dueAmount\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(45, 4, 'nl', 'Invoice Payment Create', '<p>Hallo,</p>\n                    <p>Welkom bij { app_name }</p>\n                    <p>Beste { payment_name }</p>\n                    <p>We hebben uw bedrag ontvangen { payment_amount } betaling voor { invoice_number } ingediend op datum { payment_date }</p>\n                    <p>Uw { invoice_number } verschuldigde bedrag is { payment_dueAmount }</p>\n                    <p>Wij waarderen uw snelle betaling en kijken uit naar verdere zaken met u in de toekomst.</p>\n                    <p>Hartelijk dank en hebben een goede dag!!</p>\n                    <p>&nbsp;</p>\n                    <p>Betreft:</p>\n                    <p>{ company_name }</p>\n                    <p>{ app_url }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Invoice Number\": \"invoice_number\", \"Payment Amount\": \"payment_amount\", \"Payment dueAmount\": \"payment_dueAmount\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01');
INSERT INTO `email_template_langs` (`id`, `parent_id`, `lang`, `subject`, `content`, `module_name`, `variables`, `created_at`, `updated_at`) VALUES
(46, 4, 'pl', 'Invoice Payment Create', '<p>Witam,</p>\n                    <p>Witamy w aplikacji {app_name }</p>\n                    <p>Droga {payment_name }</p>\n                    <p>Odebrano kwotę {payment_amount } płatności za {invoice_number } w dniu {payment_date }, kt&oacute;ry został zastąpiony przez użytkownika.</p>\n                    <p>{invoice_number } Kwota należna: {payment_dueAmount }</p>\n                    <p>Doceniamy Twoją szybką płatność i czekamy na kontynuację działalności gospodarczej z Tobą w przyszłości.</p>\n                    <p>Dziękuję bardzo i mam dobry dzień!!</p>\n                    <p>&nbsp;</p>\n                    <p>W odniesieniu do</p>\n                    <p>{company_name }</p>\n                    <p>{app_url }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Invoice Number\": \"invoice_number\", \"Payment Amount\": \"payment_amount\", \"Payment dueAmount\": \"payment_dueAmount\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(47, 4, 'ru', 'Invoice Payment Create', '<p>Привет.</p>\n                    <p>Вас приветствует { app_name }</p>\n                    <p>Дорогая { payment_name }</p>\n                    <p>Мы получили вашу сумму оплаты {payment_amount} для { invoice_number }, подавшей на дату { payment_date }</p>\n                    <p>Ваша { invoice_number } Должная сумма-{ payment_dueAmount }</p>\n                    <p>Мы ценим вашу своевременную оплату и надеемся на продолжение бизнеса с вами в будущем.</p>\n                    <p>Большое спасибо и хорошего дня!!</p>\n                    <p>&nbsp;</p>\n                    <p>С уважением,</p>\n                    <p>{ company_name }</p>\n                    <p>{ app_url }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Invoice Number\": \"invoice_number\", \"Payment Amount\": \"payment_amount\", \"Payment dueAmount\": \"payment_dueAmount\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(48, 4, 'pt', 'Invoice Payment Create', '<p>Oi,</p>\n                    <p>Bem-vindo a {app_name}</p>\n                    <p>Querido {payment_name}</p>\n                    <p>N&oacute;s recibimos sua quantia {payment_amount} pagamento para {invoice_number} requisitado na data {payment_date}</p>\n                    <p>Sua quantia {invoice_number} Due &eacute; {payment_dueAmount}</p>\n                    <p>Agradecemos o seu pronto pagamento e estamos ansiosos para continuarmos os neg&oacute;cios com voc&ecirc; no futuro.</p>\n                    <p>Muito obrigado e tenha um bom dia!!</p>\n                    <p>&nbsp;</p>\n                    <p>Considera,</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Invoice Number\": \"invoice_number\", \"Payment Amount\": \"payment_amount\", \"Payment dueAmount\": \"payment_dueAmount\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(49, 5, 'ar', 'Proposal Send', '<p>مرحبا ، { proposal_name }</p>\n                    <p>أتمنى أن يجدك هذا البريد الإلكتروني جيدا برجاء الرجوع الى رقم الاقتراح المرفق { proposal_number } للمنتج / الخدمة.</p>\n                    <p>اضغط ببساطة على الاختيار بأسفل</p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{proposal_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">عرض</strong> </a></span></p>\n                    <p>إشعر بالحرية للوصول إلى الخارج إذا عندك أي أسئلة.</p>\n                    <p>شكرا لعملك ! !</p>\n                    <p>&nbsp;</p>\n                    <p>Regards,</p>\n                    <p>{ company_name }</p>\n                    <p>{ app_url }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"proposal Url\": \"proposal_url\", \"proposal Name\": \"proposal_name\", \"proposal Number\": \"proposal_number\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(50, 5, 'da', 'Proposal Send', '<p>Hej, {proposal_name }</p>\n                    <p>H&aring;ber denne e-mail finder dig godt! Se det vedh&aelig;ftede forslag nummer { proposal_number } for product/service.</p>\n                    <p>klik bare p&aring; knappen nedenfor</p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{proposal_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Forslag</strong> </a></span></p>\n                    <p>Du er velkommen til at r&aelig;kke ud, hvis du har nogen sp&oslash;rgsm&aring;l.</p>\n                    <p>Tak for din virksomhed!</p>\n                    <p>&nbsp;</p>\n                    <p>Med venlig hilsen</p>\n                    <p>{ company_name }</p>\n                    <p>{ app_url }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"proposal Url\": \"proposal_url\", \"proposal Name\": \"proposal_name\", \"proposal Number\": \"proposal_number\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(51, 5, 'de', 'Proposal Send', '<p>Hi, {proposal_name}</p>\n                    <p>Hoffe, diese E-Mail findet dich gut! Bitte sehen Sie die angeh&auml;ngte Vorschlagsnummer {proposal_number} f&uuml;r Produkt/Service an.</p>\n                    <p>Klicken Sie einfach auf den Button unten</p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{proposal_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Vorschlag</strong> </a></span></p>\n                    <p>F&uuml;hlen Sie sich frei, wenn Sie Fragen haben.</p>\n                    <p>Vielen Dank f&uuml;r Ihr Unternehmen!!</p>\n                    <p>&nbsp;</p>\n                    <p>Betrachtet,</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"proposal Url\": \"proposal_url\", \"proposal Name\": \"proposal_name\", \"proposal Number\": \"proposal_number\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(52, 5, 'en', 'Proposal Send', '<p>Hi, {proposal_name}</p>\n                    <p>Hope this email ﬁnds you well! Please see attached proposal number {proposal_number} for product/service.</p>\n                    <p>simply click on the button below</p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{proposal_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Proposal</strong> </a></span></p>\n                    <p>Feel free to reach out if you have any questions.</p>\n                    <p>Thank you for your business!!</p>\n                    <p>&nbsp;</p>\n                    <p>Regards,</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"proposal Url\": \"proposal_url\", \"proposal Name\": \"proposal_name\", \"proposal Number\": \"proposal_number\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(53, 5, 'es', 'Proposal Send', '<p>Hi, {proposal_name}</p>\n                    <p>&iexcl;Espero que este email le encuentre bien! Consulte el n&uacute;mero de propuesta adjunto {proposal_number} para el producto/servicio.</p>\n                    <p>simplemente haga clic en el bot&oacute;n de abajo</p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{proposal_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Propuesta</strong> </a></span></p>\n                    <p>Si&eacute;ntase libre de llegar si usted tiene alguna pregunta.</p>\n                    <p>&iexcl;Gracias por su negocio!!</p>\n                    <p>&nbsp;</p>\n                    <p>Considerando,</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"proposal Url\": \"proposal_url\", \"proposal Name\": \"proposal_name\", \"proposal Number\": \"proposal_number\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(54, 5, 'fr', 'Proposal Send', '<p>Salut, {proposal_name}</p>\n                    <p>Jesp&egrave;re que ce courriel vous trouve bien ! Veuillez consulter le num&eacute;ro de la proposition jointe {proposal_number} pour le produit/service.</p>\n                    <p>Il suffit de cliquer sur le bouton ci-dessous</p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{proposal_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Proposition</strong> </a></span></p>\n                    <p>Nh&eacute;sitez pas &agrave; nous contacter si vous avez des questions.</p>\n                    <p>Merci pour votre entreprise ! !</p>\n                    <p>&nbsp;</p>\n                    <p>Regards,</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"proposal Url\": \"proposal_url\", \"proposal Name\": \"proposal_name\", \"proposal Number\": \"proposal_number\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(55, 5, 'it', 'Proposal Send', '<p>Ciao, {proposal_name}</p>\n                    <p>Spero che questa email ti trovi bene! Si prega di consultare il numero di proposta allegato {proposal_number} per il prodotto/servizio.</p>\n                    <p>semplicemente clicca sul pulsante sottostante</p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{proposal_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Proposta</strong> </a></span></p>\n                    <p>Sentiti libero di raggiungere se hai domande.</p>\n                    <p>Grazie per il tuo business!!</p>\n                    <p>&nbsp;</p>\n                    <p>Riguardo,</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"proposal Url\": \"proposal_url\", \"proposal Name\": \"proposal_name\", \"proposal Number\": \"proposal_number\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(56, 5, 'ja', 'Proposal Send', '<p>こんにちは、 {proposal_name}</p>\n                    <p>この E メールでよくご確認ください。 製品 / サービスの添付されたプロポーザル番号 {proposal_number} を参照してください。</p>\n                    <p>下のボタンをクリックするだけで</p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{proposal_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">提案</strong> </a></span></p>\n                    <p>質問がある場合は、自由に連絡してください。</p>\n                    <p>お客様のビジネスに感謝します。</p>\n                    <p>&nbsp;</p>\n                    <p>よろしく</p>\n                    <p>{ company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"proposal Url\": \"proposal_url\", \"proposal Name\": \"proposal_name\", \"proposal Number\": \"proposal_number\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(57, 5, 'nl', 'Proposal Send', '<p>Hallo, {proposal_name}</p>\n                    <p>Hoop dat deze e-mail je goed vindt! Zie bijgevoegde nummer {proposal_number} voor product/service.</p>\n                    <p>gewoon klikken op de knop hieronder</p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{proposal_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Voorstel</strong> </a></span></p>\n                    <p>Voel je vrij om uit te reiken als je vragen hebt.</p>\n                    <p>Dank u voor uw bedrijf!!</p>\n                    <p>&nbsp;</p>\n                    <p>Betreft:</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"proposal Url\": \"proposal_url\", \"proposal Name\": \"proposal_name\", \"proposal Number\": \"proposal_number\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(58, 5, 'pl', 'Proposal Send', '<p>Witaj, {proposal_name}</p>\n                    <p>Mam nadzieję, że ta wiadomość znajdzie Cię dobrze! Proszę zapoznać się z załączonym numerem wniosku {proposal_number} dla produktu/usługi.</p>\n                    <p>po prostu kliknij na przycisk poniżej</p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{proposal_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Wniosek</strong> </a></span></p>\n                    <p>Czuj się swobodnie, jeśli masz jakieś pytania.</p>\n                    <p>Dziękujemy za prowadzenie działalności!!</p>\n                    <p>&nbsp;</p>\n                    <p>W odniesieniu do</p>\n                    <p>{company_name }</p>\n                    <p>{app_url }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"proposal Url\": \"proposal_url\", \"proposal Name\": \"proposal_name\", \"proposal Number\": \"proposal_number\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(59, 5, 'ru', 'Proposal Send', '<p>Здравствуйте, {proposal_name}</p>\n                    <p>Надеюсь, это электронное письмо найдет вас хорошо! См. вложенное предложение номер {proposal_number} для product/service.</p>\n                    <p>просто нажмите на кнопку внизу</p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{proposal_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Предложение</strong> </a></span></p>\n                    <p>Не стеснитесь, если у вас есть вопросы.</p>\n                    <p>Спасибо за ваше дело!</p>\n                    <p>&nbsp;</p>\n                    <p>С уважением,</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"proposal Url\": \"proposal_url\", \"proposal Name\": \"proposal_name\", \"proposal Number\": \"proposal_number\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(60, 5, 'pt', 'Proposal Send', '<p>Oi, {proposal_name}</p>\n                    <p>Espero que este e-mail encontre voc&ecirc; bem! Por favor, consulte o n&uacute;mero da proposta anexada {proposal_number} para produto/servi&ccedil;o.</p>\n                    <p>basta clicar no bot&atilde;o abaixo</p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{proposal_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Proposta</strong> </a></span></p>\n                    <p>Sinta-se &agrave; vontade para alcan&ccedil;ar fora se voc&ecirc; tiver alguma d&uacute;vida.</p>\n                    <p>Obrigado pelo seu neg&oacute;cio!!</p>\n                    <p>&nbsp;</p>\n                    <p>Considera,</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"proposal Url\": \"proposal_url\", \"proposal Name\": \"proposal_name\", \"proposal Number\": \"proposal_number\"}', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(61, 6, 'ar', 'Bill Send', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">مرحبا ، {bill_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">مرحبا بك في {app_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">أتمنى أن يجدك هذا البريد الإلكتروني جيدا ! ! برجاء الرجوع الى رقم الفاتورة الملحقة {bill_number} للحصول على المنتج / الخدمة.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">ببساطة اضغط على الاختيار بأسفل.</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{bill_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">فاتورة</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">إشعر بالحرية للوصول إلى الخارج إذا عندك أي أسئلة.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">شكرا لك</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Regards,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{company_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_url}</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"bill_url\": \"bill_url\", \"Bill Name\": \"bill_name\", \"Bill Number\": \"bill_number\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(62, 6, 'da', 'Bill Send', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Hej, {bill_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Velkommen til {app_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">H&aring;ber denne e-mail finder dig godt! Se vedlagte fakturanummer } {bill_number} for product/service.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Klik p&aring; knappen nedenfor.</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{bill_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Regning</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Du er velkommen til at r&aelig;kke ud, hvis du har nogen sp&oslash;rgsm&aring;l.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Tak.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Med venlig hilsen</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{company_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_url}</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"bill_url\": \"bill_url\", \"Bill Name\": \"bill_name\", \"Bill Number\": \"bill_number\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(63, 6, 'de', 'Bill Send', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Hi, {bill_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Willkommen bei {app_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Hoffe, diese E-Mail findet dich gut!! Sehen Sie sich die beigef&uuml;gte Rechnungsnummer {bill_number} f&uuml;r Produkt/Service an.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Klicken Sie einfach auf den Button unten.</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{bill_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Rechnung</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">F&uuml;hlen Sie sich frei, wenn Sie Fragen haben.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Vielen Dank,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Betrachtet,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{company_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_url}</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"bill_url\": \"bill_url\", \"Bill Name\": \"bill_name\", \"Bill Number\": \"bill_number\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(64, 6, 'en', 'Bill Send', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Hi, {bill_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Welcome to {app_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Hope this email finds you well!! Please see attached bill number {bill_number} for product/service.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Simply click on the button below.</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{bill_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Bill</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Feel free to reach out if you have any questions.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Thank You,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Regards,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{company_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_url}</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"bill_url\": \"bill_url\", \"Bill Name\": \"bill_name\", \"Bill Number\": \"bill_number\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(65, 6, 'es', 'Bill Send', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Hi,&nbsp;{bill_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Bienvenido a {app_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">&iexcl;Espero que este correo te encuentre bien!! Consulte el n&uacute;mero de factura adjunto {bill_number} para el producto/servicio.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Simplemente haga clic en el bot&oacute;n de abajo.</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{bill_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Cuenta</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Si&eacute;ntase libre de llegar si usted tiene alguna pregunta.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Gracias,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Considerando,</span></p>\n                    <p><span style=\"font-family: sans-serif;\">{company_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_url}</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"bill_url\": \"bill_url\", \"Bill Name\": \"bill_name\", \"Bill Number\": \"bill_number\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(66, 6, 'fr', 'Bill Send', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Salut,&nbsp;{bill_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Bienvenue dans {app_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Jesp&egrave;re que ce courriel vous trouve bien ! ! Veuillez consulter le num&eacute;ro de facture {bill_number}&nbsp;associ&eacute; au produit / service.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Cliquez simplement sur le bouton ci-dessous.</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{bill_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Facture</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Nh&eacute;sitez pas &agrave; nous contacter si vous avez des questions.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Merci,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Regards,</span></p>\n                    <p><span style=\"font-family: sans-serif;\">{company_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_url}</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"bill_url\": \"bill_url\", \"Bill Name\": \"bill_name\", \"Bill Number\": \"bill_number\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(67, 6, 'it', 'Bill Send', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Ciao, {bill_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Benvenuti in {app_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Spero che questa email ti trovi bene!! Si prega di consultare il numero di fattura allegato {bill_number} per il prodotto/servizio.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Semplicemente clicca sul pulsante sottostante.</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{bill_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Conto</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Sentiti libero di raggiungere se hai domande.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Grazie,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Riguardo,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{company_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_url}</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"bill_url\": \"bill_url\", \"Bill Name\": \"bill_name\", \"Bill Number\": \"bill_number\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(68, 6, 'ja', 'Bill Send', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">こんにちは、 {bill_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_name} へようこそ</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">この E メールによりよく検出されます !! 製品 / サービスの添付された請求番号 {bill_number} を参照してください。</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">以下のボタンをクリックしてください。</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{bill_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">明細書</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">質問がある場合は、自由に連絡してください。</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">ありがとうございます</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">よろしく</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{ company_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_url}</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"bill_url\": \"bill_url\", \"Bill Name\": \"bill_name\", \"Bill Number\": \"bill_number\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(69, 6, 'nl', 'Bill Send', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Hallo, {bill_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Welkom bij {app_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Hoop dat deze e-mail je goed vindt!! Zie bijgevoegde factuurnummer {bill_number} voor product/service.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Klik gewoon op de knop hieronder.</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{bill_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Rekening</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Voel je vrij om uit te reiken als je vragen hebt.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Dank U,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Betreft:</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{company_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_url}</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"bill_url\": \"bill_url\", \"Bill Name\": \"bill_name\", \"Bill Number\": \"bill_number\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(70, 6, 'pl', 'Bill Send', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Witaj,&nbsp;{bill_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Witamy w aplikacji {app_name }</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Mam nadzieję, że ta wiadomość e-mail znajduje Cię dobrze!! Zapoznaj się z załączonym numerem rachunku {bill_number } dla produktu/usługi.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Wystarczy kliknąć na przycisk poniżej.</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{bill_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Rachunek</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Czuj się swobodnie, jeśli masz jakieś pytania.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Dziękuję,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">W odniesieniu do</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{company_name }</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_url }</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"bill_url\": \"bill_url\", \"Bill Name\": \"bill_name\", \"Bill Number\": \"bill_number\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(71, 6, 'ru', 'Bill Send', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Привет, {bill_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Вас приветствует {app_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Надеюсь, это письмо найдет вас хорошо! См. прилагаемый номер счета {bill_number} для product/service.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Просто нажмите на кнопку внизу.</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{bill_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Счет</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Не стеснитесь, если у вас есть вопросы.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Спасибо.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">С уважением,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{company_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_url}</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"bill_url\": \"bill_url\", \"Bill Name\": \"bill_name\", \"Bill Number\": \"bill_number\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(72, 6, 'pt', 'Bill Send', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Oi, {bill_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Bem-vindo a {app_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Espero que este e-mail encontre voc&ecirc; bem!! Por favor, consulte o n&uacute;mero de faturamento conectado {bill_number} para produto/servi&ccedil;o.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Basta clicar no bot&atilde;o abaixo.</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{bill_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Conta</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Sinta-se &agrave; vontade para alcan&ccedil;ar fora se voc&ecirc; tiver alguma d&uacute;vida.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Obrigado,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Considera,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{company_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_url}</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"bill_url\": \"bill_url\", \"Bill Name\": \"bill_name\", \"Bill Number\": \"bill_number\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(73, 7, 'ar', 'Bill Payment Create', '<p>مرحبا ، { payment_name }</p>\n                    <p>&nbsp;</p>\n                    <p>مرحبا بك في {app_name}</p>\n                    <p>&nbsp;</p>\n                    <p>نحن نكتب لإبلاغكم بأننا قد أرسلنا مدفوعات (payment_bill) } الخاصة بك.</p>\n                    <p>&nbsp;</p>\n                    <p>لقد أرسلنا قيمتك { payment_amount } لأجل { payment_bill } قمت بالاحالة في التاريخ { payment_date } من خلال { payment_method }.</p>\n                    <p>&nbsp;</p>\n                    <p>شكرا جزيلا لك وطاب يومك ! !!!</p>\n                    <p>&nbsp;</p>\n                    <p>{company_name}</p>\n                    <p>&nbsp;</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Bill\": \"payment_bill\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Payment Amount\": \"payment_amount\", \"Payment Method\": \"payment_method\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(74, 7, 'da', 'Bill Payment Create', '<p>Hej, { payment_name }</p>\n                    <p>&nbsp;</p>\n                    <p>Velkommen til {app_name}</p>\n                    <p>&nbsp;</p>\n                    <p>Vi skriver for at informere dig om, at vi har sendt din { payment_bill }-betaling.</p>\n                    <p>&nbsp;</p>\n                    <p>Vi har sendt dit bel&oslash;b { payment_amount } betaling for { payment_bill } undertvist p&aring; dato { payment_date } via { payment_method }.</p>\n                    <p>&nbsp;</p>\n                    <p>Mange tak, og ha en god dag!</p>\n                    <p>&nbsp;</p>\n                    <p>{company_name}</p>\n                    <p>&nbsp;</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Bill\": \"payment_bill\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Payment Amount\": \"payment_amount\", \"Payment Method\": \"payment_method\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(75, 7, 'de', 'Bill Payment Create', '<p>Hi, {payment_name}</p>\n                    <p>&nbsp;</p>\n                    <p>Willkommen bei {app_name}</p>\n                    <p>&nbsp;</p>\n                    <p>Wir schreiben Ihnen mitzuteilen, dass wir Ihre Zahlung von {payment_bill} gesendet haben.</p>\n                    <p>&nbsp;</p>\n                    <p>Wir haben Ihre Zahlung {payment_amount} Zahlung f&uuml;r {payment_bill} am Datum {payment_date} &uuml;ber {payment_method} gesendet.</p>\n                    <p>&nbsp;</p>\n                    <p>Vielen Dank und haben einen guten Tag! !!!</p>\n                    <p>&nbsp;</p>\n                    <p>{company_name}</p>\n                    <p>&nbsp;</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Bill\": \"payment_bill\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Payment Amount\": \"payment_amount\", \"Payment Method\": \"payment_method\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(76, 7, 'en', 'Bill Payment Create', '<p>Hi, {payment_name}</p>\n                    <p>Welcome to {app_name}</p>\n                    <p>We are writing to inform you that we has sent your {payment_bill} payment.</p>\n                    <p>We has sent your amount {payment_amount} payment for {payment_bill} submited on date {payment_date} via {payment_method}.</p>\n                    <p>Thank You very much and have a good day !!!!</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Bill\": \"payment_bill\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Payment Amount\": \"payment_amount\", \"Payment Method\": \"payment_method\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05');
INSERT INTO `email_template_langs` (`id`, `parent_id`, `lang`, `subject`, `content`, `module_name`, `variables`, `created_at`, `updated_at`) VALUES
(77, 7, 'es', 'Bill Payment Create', '<p>Hi, {payment_name}</p>\n                    <p>&nbsp;</p>\n                    <p>Bienvenido a {app_name}</p>\n                    <p>&nbsp;</p>\n                    <p>Estamos escribiendo para informarle que hemos enviado su pago {payment_bill}.</p>\n                    <p>&nbsp;</p>\n                    <p>Hemos enviado su importe {payment_amount} pago para {payment_bill} submitado en la fecha {payment_date} a trav&eacute;s de {payment_method}.</p>\n                    <p>&nbsp;</p>\n                    <p>Thank You very much and have a good day! !!!</p>\n                    <p>&nbsp;</p>\n                    <p>{company_name}</p>\n                    <p>&nbsp;</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Bill\": \"payment_bill\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Payment Amount\": \"payment_amount\", \"Payment Method\": \"payment_method\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(78, 7, 'fr', 'Bill Payment Create', '<p>Salut, { payment_name }</p>\n                    <p>&nbsp;</p>\n                    <p>Bienvenue dans {app_name}</p>\n                    <p>&nbsp;</p>\n                    <p>Nous vous &eacute;crivons pour vous informer que nous avons envoy&eacute; votre paiement { payment_bill }.</p>\n                    <p>&nbsp;</p>\n                    <p>Nous avons envoy&eacute; votre paiement { payment_amount } pour { payment_bill } soumis &agrave; la date { payment_date } via { payment_method }.</p>\n                    <p>&nbsp;</p>\n                    <p>Merci beaucoup et avez un bon jour ! !!!</p>\n                    <p>&nbsp;</p>\n                    <p>{company_name}</p>\n                    <p>&nbsp;</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Bill\": \"payment_bill\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Payment Amount\": \"payment_amount\", \"Payment Method\": \"payment_method\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(79, 7, 'it', 'Bill Payment Create', '<p>Ciao, {payment_name}</p>\n                    <p>&nbsp;</p>\n                    <p>Benvenuti in {app_name}</p>\n                    <p>&nbsp;</p>\n                    <p>Scriviamo per informarti che abbiamo inviato il tuo pagamento {payment_bill}.</p>\n                    <p>&nbsp;</p>\n                    <p>Abbiamo inviato la tua quantit&agrave; {payment_amount} pagamento per {payment_bill} subita alla data {payment_date} tramite {payment_method}.</p>\n                    <p>&nbsp;</p>\n                    <p>Grazie mille e buona giornata! !!!</p>\n                    <p>&nbsp;</p>\n                    <p>{company_name}</p>\n                    <p>&nbsp;</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Bill\": \"payment_bill\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Payment Amount\": \"payment_amount\", \"Payment Method\": \"payment_method\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(80, 7, 'ja', 'Bill Payment Create', '<p>こんにちは、 {payment_name}</p>\n                    <p>&nbsp;</p>\n                    <p>{app_name} へようこそ</p>\n                    <p>&nbsp;</p>\n                    <p>{payment_bill} の支払いを送信したことをお知らせするために執筆しています。</p>\n                    <p>&nbsp;</p>\n                    <p>{payment_date } に提出された {payment_議案} に対する金額 {payment_date} の支払いは、 {payment_method}を介して送信されました。</p>\n                    <p>&nbsp;</p>\n                    <p>ありがとうございます。良い日をお願いします。</p>\n                    <p>&nbsp;</p>\n                    <p>{ company_name}</p>\n                    <p>&nbsp;</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Bill\": \"payment_bill\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Payment Amount\": \"payment_amount\", \"Payment Method\": \"payment_method\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(81, 7, 'nl', 'Bill Payment Create', '<p>Hallo, { payment_name }</p>\n                    <p>&nbsp;</p>\n                    <p>Welkom bij {app_name}</p>\n                    <p>&nbsp;</p>\n                    <p>Wij schrijven u om u te informeren dat wij uw betaling van { payment_bill } hebben verzonden.</p>\n                    <p>&nbsp;</p>\n                    <p>We hebben uw bedrag { payment_amount } betaling voor { payment_bill } verzonden op datum { payment_date } via { payment_method }.</p>\n                    <p>&nbsp;</p>\n                    <p>Hartelijk dank en hebben een goede dag! !!!</p>\n                    <p>&nbsp;</p>\n                    <p>{company_name}</p>\n                    <p>&nbsp;</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Bill\": \"payment_bill\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Payment Amount\": \"payment_amount\", \"Payment Method\": \"payment_method\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(82, 7, 'pl', 'Bill Payment Create', '<p>Witaj, {payment_name }</p>\n                    <p>&nbsp;</p>\n                    <p>Witamy w aplikacji {app_name }</p>\n                    <p>&nbsp;</p>\n                    <p>Piszemy, aby poinformować Cię, że wysłaliśmy Twoją płatność {payment_bill }.</p>\n                    <p>&nbsp;</p>\n                    <p>Twoja kwota {payment_amount } została wysłana przez użytkownika {payment_bill } w dniu {payment_date } za pomocą metody {payment_method }.</p>\n                    <p>&nbsp;</p>\n                    <p>Dziękuję bardzo i mam dobry dzień! !!!</p>\n                    <p>&nbsp;</p>\n                    <p>{company_name }</p>\n                    <p>&nbsp;</p>\n                    <p>{app_url }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Bill\": \"payment_bill\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Payment Amount\": \"payment_amount\", \"Payment Method\": \"payment_method\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(83, 7, 'ru', 'Bill Payment Create', '<p>Привет, { payment_name }</p>\n                    <p>&nbsp;</p>\n                    <p>Вас приветствует {app_name}</p>\n                    <p>&nbsp;</p>\n                    <p>Мы пишем, чтобы сообщить вам, что мы отправили вашу оплату { payment_bill }.</p>\n                    <p>&nbsp;</p>\n                    <p>Мы отправили вашу сумму оплаты { payment_amount } для { payment_bill }, подав на дату { payment_date } через { payment_method }.</p>\n                    <p>&nbsp;</p>\n                    <p>Большое спасибо и хорошего дня! !!!</p>\n                    <p>&nbsp;</p>\n                    <p>{company_name}</p>\n                    <p>&nbsp;</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Bill\": \"payment_bill\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Payment Amount\": \"payment_amount\", \"Payment Method\": \"payment_method\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(84, 7, 'pt', 'Bill Payment Create', '<p>Oi, {payment_name}</p>\n                    <p>&nbsp;</p>\n                    <p>Bem-vindo a {app_name}</p>\n                    <p>&nbsp;</p>\n                    <p>Estamos escrevendo para inform&aacute;-lo que enviamos o seu pagamento {payment_bill}.</p>\n                    <p>&nbsp;</p>\n                    <p>N&oacute;s enviamos sua quantia {payment_amount} pagamento por {payment_bill} requisitado na data {payment_date} via {payment_method}.</p>\n                    <p>&nbsp;</p>\n                    <p>Muito obrigado e tenha um bom dia! !!!</p>\n                    <p>&nbsp;</p>\n                    <p>{company_name}</p>\n                    <p>&nbsp;</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Bill\": \"payment_bill\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Payment Amount\": \"payment_amount\", \"Payment Method\": \"payment_method\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(85, 8, 'ar', 'Revenue Payment Create', '<p>مرحبا</p>\n                    <p>مرحبا بك في {app_name}</p>\n                    <p>عزيزي {payment_name}</p>\n                    <p>لقد قمت باستلام المبلغ الخاص بك {payment_amount}&nbsp; لبرنامج {revenue_type} الذي تم تقديمه في التاريخ {payment_date}</p>\n                    <p>ونحن نقدر الدفع الفوري لكم ونتطلع إلى استمرار العمل معكم في المستقبل.</p>\n                    <p>&nbsp;</p>\n                    <p>شكرا جزيلا لكم ويوم جيد ! !</p>\n                    <p>&nbsp;</p>\n                    <p>Regards,</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Revenue Type\": \"revenue_type\", \"Payment Amount\": \"payment_amount\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(86, 8, 'da', 'Revenue Payment Create', '<p>Hej.</p>\n                    <p>Velkommen til {app_name&nbsp;</p>\n                    <p>K&aelig;re {payment_name}</p>\n                    <p>Vi har modtaget din m&aelig;ngde {payment_amount} betaling for {revenue_type} undert.d. p&aring; dato {payment_date}</p>\n                    <p>Vi s&aelig;tter pris p&aring; din hurtige betaling og ser frem til fortsatte forretninger med dig i fremtiden.</p>\n                    <p>Mange tak, og ha en god dag!</p>\n                    <p>&nbsp;</p>\n                    <p>Med venlig hilsen</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Revenue Type\": \"revenue_type\", \"Payment Amount\": \"payment_amount\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(87, 8, 'de', 'Revenue Payment Create', '<p>Hi,</p>\n                    <p>Willkommen bei {app_name}</p>\n                    <p>Sehr geehrter {payment_name}</p>\n                    <p>Wir haben Ihre Zahlung {payment_amount} f&uuml;r {revenue_type}, die am Datum {payment_date} &uuml;bergeben wurde, erhalten.</p>\n                    <p>Wir freuen uns &uuml;ber Ihre prompte Bezahlung und freuen uns auf das weitere Gesch&auml;ft mit Ihnen in der Zukunft.</p>\n                    <p>Vielen Dank und habe einen guten Tag!!</p>\n                    <p>&nbsp;</p>\n                    <p>Betrachtet,</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Revenue Type\": \"revenue_type\", \"Payment Amount\": \"payment_amount\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(88, 8, 'en', 'Revenue Payment Create', '<p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif;\"><span style=\"font-size: 15px; font-variant-ligatures: common-ligatures;\">Hi,</span></span></p>\n                    <p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif;\"><span style=\"font-size: 15px; font-variant-ligatures: common-ligatures;\">Welcome to {app_name}</span></span></p>\n                    <p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif;\"><span style=\"font-size: 15px; font-variant-ligatures: common-ligatures;\">Dear {payment_name}</span></span></p>\n                    <p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif;\"><span style=\"font-size: 15px; font-variant-ligatures: common-ligatures;\">We have recieved your amount {payment_amount} payment for {revenue_type} submited on date {payment_date}</span></span></p>\n                    <p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif;\"><span style=\"font-size: 15px; font-variant-ligatures: common-ligatures;\">We appreciate your prompt payment and look forward to continued business with you in the future.</span></span></p>\n                    <p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif;\"><span style=\"font-size: 15px; font-variant-ligatures: common-ligatures;\">Thank you very much and have a good day!!</span></span></p>\n                    <p>&nbsp;</p>\n                    <p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif;\"><span style=\"font-size: 15px; font-variant-ligatures: common-ligatures;\">Regards,</span></span></p>\n                    <p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif;\"><span style=\"font-size: 15px; font-variant-ligatures: common-ligatures;\">{company_name}</span></span></p>\n                    <p><span style=\"color: #1d1c1d; font-family: Slack-Lato, Slack-Fractions, appleLogo, sans-serif;\"><span style=\"font-size: 15px; font-variant-ligatures: common-ligatures;\">{app_url}</span></span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Revenue Type\": \"revenue_type\", \"Payment Amount\": \"payment_amount\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(89, 8, 'es', 'Revenue Payment Create', '<p>Hola,</p>\n                    <p>Bienvenido a {app_name}</p>\n                    <p>Estimado {payment_name}</p>\n                    <p>Hemos recibido su importe {payment_amount} pago para {revenue_type} submitado en la fecha {payment_date}</p>\n                    <p>Agradecemos su pronto pago y esperamos continuar con sus negocios con usted en el futuro.</p>\n                    <p>Muchas gracias y que tengan un buen d&iacute;a!!</p>\n                    <p>&nbsp;</p>\n                    <p>Considerando,</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Revenue Type\": \"revenue_type\", \"Payment Amount\": \"payment_amount\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(90, 8, 'fr', 'Revenue Payment Create', '<p>Salut,</p>\n                    <p>Bienvenue dans {app_name}</p>\n                    <p>Cher {payment_name}</p>\n                    <p>Nous avons re&ccedil;u votre montant {payment_amount} de paiement pour {revenue_type} soumis le {payment_date}</p>\n                    <p>Nous appr&eacute;cions votre rapidit&eacute; de paiement et nous attendons avec impatience de poursuivre vos activit&eacute;s avec vous &agrave; lavenir.</p>\n                    <p>Merci beaucoup et avez une bonne journ&eacute;e ! !</p>\n                    <p>&nbsp;</p>\n                    <p>Regards,</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Revenue Type\": \"revenue_type\", \"Payment Amount\": \"payment_amount\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(91, 8, 'it', 'Revenue Payment Create', '<p>Ciao,</p>\n                    <p>Benvenuti in {app_name}</p>\n                    <p>Caro {payment_name}</p>\n                    <p>Abbiamo ricevuto la tua quantit&agrave; {payment_amount} pagamento per {revenue_type} subita alla data {payment_date}</p>\n                    <p>Apprezziamo il tuo tempestoso pagamento e non vedo lora di continuare a fare affari con te in futuro.</p>\n                    <p>Grazie mille e buona giornata!!</p>\n                    <p>&nbsp;</p>\n                    <p>Riguardo,</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Revenue Type\": \"revenue_type\", \"Payment Amount\": \"payment_amount\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(92, 8, 'ja', 'Revenue Payment Create', '<p>こんにちは。</p>\n                    <p>{app_name} へようこそ</p>\n                    <p>{ payment_name} に出れます</p>\n                    <p>{ payment_date} 日付で提出された {revenue_type} の金額を回収しました。{payment_date}</p>\n                    <p>お客様の迅速な支払いを評価し、今後も継続してビジネスを継続することを期待しています。</p>\n                    <p>ありがとうございます。良い日をお願いします。</p>\n                    <p>&nbsp;</p>\n                    <p>よろしく</p>\n                    <p>{ company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Revenue Type\": \"revenue_type\", \"Payment Amount\": \"payment_amount\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(93, 8, 'nl', 'Revenue Payment Create', '<p>Hallo,</p>\n                    <p>Welkom bij {app_name}</p>\n                    <p>Beste {payment_name}</p>\n                    <p>We hebben uw bedrag ontvangen {payment_amount} betaling voor {revenue_type} ingediend op datum {payment_date}</p>\n                    <p>Wij waarderen uw snelle betaling en kijken uit naar verdere zaken met u in de toekomst.</p>\n                    <p>Hartelijk dank en hebben een goede dag!!</p>\n                    <p>&nbsp;</p>\n                    <p>Betreft:</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Revenue Type\": \"revenue_type\", \"Payment Amount\": \"payment_amount\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(94, 8, 'pl', 'Revenue Payment Create', '<p>Witam,</p>\n                    <p>Witamy w aplikacji {app_name }</p>\n                    <p>Droga {payment_name }</p>\n                    <p>Odebrano kwotę {payment_amount } płatności za {revenue_type&nbsp;} w dniu {payment_date }, kt&oacute;ry został zastąpiony przez użytkownika.</p>\n                    <p>Doceniamy Twoją szybką płatność i czekamy na kontynuację działalności gospodarczej z Tobą w przyszłości.</p>\n                    <p>Dziękuję bardzo i mam dobry dzień!!</p>\n                    <p>&nbsp;</p>\n                    <p>W odniesieniu do</p>\n                    <p>{company_name }</p>\n                    <p>{app_url }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Revenue Type\": \"revenue_type\", \"Payment Amount\": \"payment_amount\"}', '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(95, 8, 'ru', 'Revenue Payment Create', '<p>Привет.</p>\n                    <p>Вас приветствует {app_name}</p>\n                    <p>Дорогая {payment_name}</p>\n                    <p>Мы получили вашу сумму оплаты {payment_amount} для {revenue_type}, подавшей на дату {payment_date}</p>\n                    <p>Мы ценим вашу своевременную оплату и надеемся на продолжение бизнеса с вами в будущем.</p>\n                    <p>Большое спасибо и хорошего дня!!</p>\n                    <p>&nbsp;</p>\n                    <p>С уважением,</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Revenue Type\": \"revenue_type\", \"Payment Amount\": \"payment_amount\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(96, 8, 'pt', 'Revenue Payment Create', '<p>Oi,</p>\n                    <p>Bem-vindo a {app_name}</p>\n                    <p>Querido {payment_name}</p>\n                    <p>N&oacute;s recibimos sua quantia {payment_amount} pagamento para {revenue_type} requisitado na data {payment_date}</p>\n                    <p>Agradecemos o seu pronto pagamento e estamos ansiosos para continuarmos os neg&oacute;cios com voc&ecirc; no futuro.</p>\n                    <p>Muito obrigado e tenha um bom dia!!</p>\n                    <p>&nbsp;</p>\n                    <p>Considera,</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Revenue Type\": \"revenue_type\", \"Payment Amount\": \"payment_amount\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(97, 9, 'ar', 'Leave Status', '<p style=\"text-align: left;\">Subject : -HR ادارة / شركة لارسال رسالة الموافقة الى { leave_status } اجازة أو ترك.</p>\n                    <p style=\"text-align: left;\">عزيزي { leave_status_name } ،</p>\n                    <p style=\"text-align: left;\">لدي { leave_status } طلب الخروج الخاص بك الى { leave_reason } من { leave_start_date } الى { leave_end_date }.</p>\n                    <p style=\"text-align: left;\">{ total_leave_days } أيام لدي { leave_status } طلب الخروج الخاص بك ل ـ { leave_reason }.</p>\n                    <p style=\"text-align: left;\">ونحن نطلب منكم أن تكملوا كل أعمالكم المعلقة أو أي قضية مهمة أخرى حتى لا تواجه الشركة أي خسارة أو مشكلة أثناء غيابكم. نحن نقدر لك مصداقيتك لإبلاغنا بوقت كاف مقدما</p>\n                    <p style=\"text-align: left;\">إشعر بالحرية للوصول إلى الخارج إذا عندك أي أسئلة.</p>\n                    <p style=\"text-align: left;\">شكرا لك</p>\n                    <p style=\"text-align: left;\">Regards,</p>\n                    <p style=\"text-align: left;\">إدارة الموارد البشرية ،</p>\n                    <p style=\"text-align: left;\">{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Leave Reason\": \"leave_reason\", \"Leave Status\": \"leave_status\", \"Leave End Date\": \"leave_end_date\", \"Leave Start Date\": \"leave_start_date\", \"Total Leave Days\": \"total_leave_days\", \"Leave Status Name\": \"leave_status_name\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(98, 9, 'da', 'Leave Status', '<p>Emne:-HR-afdelingen / Kompagniet for at sende godkendelsesbrev til { leave_status } en ferie eller orlov.</p>\n                    <p>K&aelig;re { leave_status_name },</p>\n                    <p>Jeg har { leave_status } din orlov-anmodning for { leave_reason } fra { leave_start_date } til { leave_end_date }.</p>\n                    <p>{ total_leave_days } dage Jeg har { leave_status } din anmodning om { leave_reason } for { leave_reason }.</p>\n                    <p>Vi beder dig om at f&aelig;rdigg&oslash;re alt dit udest&aring;ende arbejde eller andet vigtigt sp&oslash;rgsm&aring;l, s&aring; virksomheden ikke st&aring;r over for nogen tab eller problemer under dit frav&aelig;r. Vi s&aelig;tter pris p&aring; din bet&aelig;nksomhed at informere os godt p&aring; forh&aring;nd</p>\n                    <p>Du er velkommen til at r&aelig;kke ud, hvis du har nogen sp&oslash;rgsm&aring;l.</p>\n                    <p>Tak.</p>\n                    <p>Med venlig hilsen</p>\n                    <p>HR-afdelingen,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Leave Reason\": \"leave_reason\", \"Leave Status\": \"leave_status\", \"Leave End Date\": \"leave_end_date\", \"Leave Start Date\": \"leave_start_date\", \"Total Leave Days\": \"total_leave_days\", \"Leave Status Name\": \"leave_status_name\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(99, 9, 'de', 'Leave Status', '<p>Betreff: -Personalabteilung/Firma, um den Genehmigungsschreiben an {leave_status} einen Urlaub oder Urlaub zu schicken.</p>\n                    <p>Sehr geehrter {leave_status_name},</p>\n                    <p>Ich habe {leave_status} Ihre Urlaubsanforderung f&uuml;r {leave_reason} von {leave_start_date} bis {leave_end_date}.</p>\n                    <p>{total_leave_days} Tage Ich habe {leave_status} Ihre Urlaubs-Anfrage f&uuml;r {leave_reason}.</p>\n                    <p>Wir bitten Sie, Ihre gesamte anstehende Arbeit oder ein anderes wichtiges Thema abzuschlie&szlig;en, so dass das Unternehmen w&auml;hrend Ihrer Abwesenheit keinen Verlust oder kein Problem zu Gesicht bekommen hat. Wir sch&auml;tzen Ihre Nachdenklichkeit, um uns im Vorfeld gut zu informieren</p>\n                    <p>F&uuml;hlen Sie sich frei, wenn Sie Fragen haben.</p>\n                    <p>Danke.</p>\n                    <p>Betrachtet,</p>\n                    <p>Personalabteilung,</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Leave Reason\": \"leave_reason\", \"Leave Status\": \"leave_status\", \"Leave End Date\": \"leave_end_date\", \"Leave Start Date\": \"leave_start_date\", \"Total Leave Days\": \"total_leave_days\", \"Leave Status Name\": \"leave_status_name\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(100, 9, 'en', 'Leave Status', '<p><strong>Subject:-HR department/Company to send approval letter to {leave_status} a vacation or leave.</strong></p>\n                    <p><strong>Dear {leave_status_name},</strong></p>\n                    <p>I have {leave_status} your leave request for {leave_reason} from {leave_start_date} to {leave_end_date}.</p>\n                    <p>{total_leave_days} days I have {leave_status}&nbsp; your leave request for {leave_reason}.</p>\n                    <p>We request you to complete all your pending work or any other important issue so that the company does not face any loss or problem during your absence. We appreciate your thoughtfulness to inform us well in advance</p>\n                    <p>&nbsp;</p>\n                    <p>Feel free to reach out if you have any questions.</p>\n                    <p>Thank you</p>\n                    <p><strong>Regards,</strong></p>\n                    <p><strong>HR Department,</strong></p>\n                    <p><strong>{app_name}</strong></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Leave Reason\": \"leave_reason\", \"Leave Status\": \"leave_status\", \"Leave End Date\": \"leave_end_date\", \"Leave Start Date\": \"leave_start_date\", \"Total Leave Days\": \"total_leave_days\", \"Leave Status Name\": \"leave_status_name\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(101, 9, 'es', 'Leave Status', '<p>Asunto: -Departamento de RR.HH./Empresa para enviar la carta de aprobaci&oacute;n a {leave_status} unas vacaciones o permisos.</p>\n                    <p>Estimado {leave_status_name},</p>\n                    <p>Tengo {leave_status} la solicitud de licencia para {leave_reason} de {leave_start_date} a {leave_end_date}.</p>\n                    <p>{total_leave_days} d&iacute;as tengo {leave_status} la solicitud de licencia para {leave_reason}.</p>\n                    <p>Le solicitamos que complete todos sus trabajos pendientes o cualquier otro asunto importante para que la empresa no se enfrente a ninguna p&eacute;rdida o problema durante su ausencia. Agradecemos su atenci&oacute;n para informarnos con mucha antelaci&oacute;n</p>\n                    <p>Si&eacute;ntase libre de llegar si usted tiene alguna pregunta.</p>\n                    <p>&iexcl;Gracias!</p>\n                    <p>Considerando,</p>\n                    <p>Departamento de Recursos Humanos,</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Leave Reason\": \"leave_reason\", \"Leave Status\": \"leave_status\", \"Leave End Date\": \"leave_end_date\", \"Leave Start Date\": \"leave_start_date\", \"Total Leave Days\": \"total_leave_days\", \"Leave Status Name\": \"leave_status_name\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(102, 9, 'fr', 'Leave Status', '<p>Objet: -HR department / Company to send approval letter to { leave_status } a vacances or leave.</p>\n                    <p>Cher { leave_status_name },</p>\n                    <p>Jai { leave_statut } votre demande de cong&eacute; pour { leave_reason } de { leave_start_date } &agrave; { leave_date_fin }.</p>\n                    <p>{ total_leave_days } jours I have { leave_status } your leave request for { leave_reason }.</p>\n                    <p>Nous vous demandons de remplir tous vos travaux en cours ou toute autre question importante afin que lentreprise ne soit pas confront&eacute;e &agrave; une perte ou &agrave; un probl&egrave;me pendant votre absence. Nous appr&eacute;cions votre attention pour nous informer longtemps &agrave; lavance</p>\n                    <p>Nh&eacute;sitez pas &agrave; nous contacter si vous avez des questions.</p>\n                    <p>Je vous remercie</p>\n                    <p>Regards,</p>\n                    <p>D&eacute;partement des RH,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Leave Reason\": \"leave_reason\", \"Leave Status\": \"leave_status\", \"Leave End Date\": \"leave_end_date\", \"Leave Start Date\": \"leave_start_date\", \"Total Leave Days\": \"total_leave_days\", \"Leave Status Name\": \"leave_status_name\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(103, 9, 'it', 'Leave Status', '<p>Oggetto: - Dipartimento HR / Societ&agrave; per inviare lettera di approvazione a {leave_status} una vacanza o un congedo.</p>\n                    <p>Caro {leave_status_name},</p>\n                    <p>Ho {leave_status} la tua richiesta di permesso per {leave_reason} da {leave_start_date} a {leave_end_date}.</p>\n                    <p>{total_leave_days} giorni I ho {leave_status} la tua richiesta di permesso per {leave_reason}.</p>\n                    <p>Ti richiediamo di completare tutte le tue lavorazioni in sospeso o qualsiasi altra questione importante in modo che lazienda non faccia alcuna perdita o problema durante la tua assenza. Apprezziamo la vostra premura per informarci bene in anticipo</p>\n                    <p>Sentiti libero di raggiungere se hai domande.</p>\n                    <p>Grazie</p>\n                    <p>Riguardo,</p>\n                    <p>Dipartimento HR,</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Leave Reason\": \"leave_reason\", \"Leave Status\": \"leave_status\", \"Leave End Date\": \"leave_end_date\", \"Leave Start Date\": \"leave_start_date\", \"Total Leave Days\": \"total_leave_days\", \"Leave Status Name\": \"leave_status_name\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(104, 9, 'ja', 'Leave Status', '<p>件名: 承認レターを { leave_status} に送信するには、 -HR 部門/会社が休暇または休暇を入力します。</p>\n                    <p>{leave_status_name} を終了します。</p>\n                    <p>{ leave_reason } の { leave_start_date} から {leave_end_date}までの { leave_status} の終了要求を { leave_status} しています。</p>\n                    <p>{total_leave_days} 日に { leave_reason}{ leave_status} に対するあなたの休暇要求があります。</p>\n                    <p>お客様は、お客様の不在中に損失や問題が発生しないように、保留中のすべての作業またはその他の重要な問題を完了するよう要求します。 私たちは、前もってお知らせすることに感謝しています。</p>\n                    <p>質問がある場合は、自由に連絡してください。</p>\n                    <p>ありがとう</p>\n                    <p>よろしく</p>\n                    <p>HR 部門</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Leave Reason\": \"leave_reason\", \"Leave Status\": \"leave_status\", \"Leave End Date\": \"leave_end_date\", \"Leave Start Date\": \"leave_start_date\", \"Total Leave Days\": \"total_leave_days\", \"Leave Status Name\": \"leave_status_name\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(105, 9, 'nl', 'Leave Status', '<p>Betreft: -HR-afdeling/Bedrijf voor het verzenden van een goedkeuringsbrief aan { leave_status } een vakantie of verlof.</p>\n                    <p>Geachte { leave_status_name },</p>\n                    <p>Ik heb { leave_status } uw verzoek om verlof voor { leave_reason } van { leave_start_date } tot { leave_end_date }.</p>\n                    <p>{ total_leave_days } dagen Ik heb { leave_status } uw verzoek om verlof voor { leave_reason }.</p>\n                    <p>Wij vragen u om al uw lopende werk of een andere belangrijke kwestie, zodat het bedrijf geen verlies of probleem tijdens uw afwezigheid geconfronteerd. We waarderen uw bedachtzaamheid om ons van tevoren goed te informeren.</p>\n                    <p>Voel je vrij om uit te reiken als je vragen hebt.</p>\n                    <p>Dank u wel</p>\n                    <p>Betreft:</p>\n                    <p>HR-afdeling,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Leave Reason\": \"leave_reason\", \"Leave Status\": \"leave_status\", \"Leave End Date\": \"leave_end_date\", \"Leave Start Date\": \"leave_start_date\", \"Total Leave Days\": \"total_leave_days\", \"Leave Status Name\": \"leave_status_name\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(106, 9, 'pl', 'Leave Status', '<p>Temat: -Dział kadr/Firma wysyłająca list zatwierdzający do {leave_status } wakacji lub urlop&oacute;w.</p>\n                    <p>Drogi {leave_status_name },</p>\n                    <p>Mam {leave_status } żądanie pozostania dla {leave_reason } od {leave_start_date } do {leave_end_date }.</p>\n                    <p>{total_leave_days } dni Mam {leave_status } Twoje żądanie opuszczenia dla {leave_reason }.</p>\n                    <p>Prosimy o wypełnienie wszystkich oczekujących prac lub innych ważnych kwestii, tak aby firma nie borykała się z żadną stratą lub problemem w czasie Twojej nieobecności. Doceniamy Twoją przemyślność, aby poinformować nas dobrze z wyprzedzeniem</p>\n                    <p>Czuj się swobodnie, jeśli masz jakieś pytania.</p>\n                    <p>Dziękujemy</p>\n                    <p>W odniesieniu do</p>\n                    <p>Dział HR,</p>\n                    <p>{app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Leave Reason\": \"leave_reason\", \"Leave Status\": \"leave_status\", \"Leave End Date\": \"leave_end_date\", \"Leave Start Date\": \"leave_start_date\", \"Total Leave Days\": \"total_leave_days\", \"Leave Status Name\": \"leave_status_name\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(107, 9, 'ru', 'Leave Status', '<p>Тема: -HR отдел/Компания отправить письмо с утверждением на { leave_status } отпуск или отпуск.</p>\n                    <p>Уважаемый { leave_status_name },</p>\n                    <p>У меня { leave_status } ваш запрос на отпуск для { leave_reason } из { leave_start_date } в { leave_end_date }.</p>\n                    <p>{ total_leave_days } дней { leave_status } ваш запрос на отпуск для { leave_reason }.</p>\n                    <p>Мы просим вас завершить все ваши ожидающие работы или любой другой важный вопрос, чтобы компания не сталкивалась с потерей или проблемой во время вашего отсутствия. Мы ценим вашу задумчивость, чтобы заблаговременно информировать нас о</p>\n                    <p>Не стеснитесь, если у вас есть вопросы.</p>\n                    <p>Спасибо.</p>\n                    <p>С уважением,</p>\n                    <p>Отдел кадров,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Leave Reason\": \"leave_reason\", \"Leave Status\": \"leave_status\", \"Leave End Date\": \"leave_end_date\", \"Leave Start Date\": \"leave_start_date\", \"Total Leave Days\": \"total_leave_days\", \"Leave Status Name\": \"leave_status_name\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(108, 9, 'pt', 'Leave Status', '<p style=\"font-size: 14.4px;\">Assunto:-Departamento de RH / Empresa para enviar carta de aprova&ccedil;&atilde;o para {leave_status} f&eacute;rias ou licen&ccedil;a.</p>\n                    <p style=\"font-size: 14.4px;\">Querido {leave_status_name},</p>\n                    <p style=\"font-size: 14.4px;\">Eu tenho {leave_status} sua solicita&ccedil;&atilde;o de licen&ccedil;a para {leave_reason} de {leave_start_date} para {leave_end_date}.</p>\n                    <p style=\"font-size: 14.4px;\">{total_leave_days} dias eu tenho {leave_status} o seu pedido de licen&ccedil;a para {leave_reason}.</p>\n                    <p style=\"font-size: 14.4px;\">Solicitamos que voc&ecirc; complete todo o seu trabalho pendente ou qualquer outra quest&atilde;o importante para que a empresa n&atilde;o enfrente qualquer perda ou problema durante a sua aus&ecirc;ncia. Agradecemos a sua atenciosidade para nos informar com bastante anteced&ecirc;ncia</p>\n                    <p style=\"font-size: 14.4px;\">Sinta-se &agrave; vontade para alcan&ccedil;ar fora se voc&ecirc; tiver alguma d&uacute;vida.</p>\n                    <p style=\"font-size: 14.4px;\">Obrigado</p>\n                    <p style=\"font-size: 14.4px;\">Considera,</p>\n                    <p style=\"font-size: 14.4px;\">Departamento de RH,</p>\n                    <p style=\"font-size: 14.4px;\">{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Leave Reason\": \"leave_reason\", \"Leave Status\": \"leave_status\", \"Leave End Date\": \"leave_end_date\", \"Leave Start Date\": \"leave_start_date\", \"Total Leave Days\": \"total_leave_days\", \"Leave Status Name\": \"leave_status_name\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(109, 10, 'ar', 'New Award', '<p>Subject :-إدارة الموارد البشرية / الشركة المعنية بإرسال خطاب تحكيم للاعتراف بموظف</p>\n                    <p>مرحبا { award_name },</p>\n                    <p>ويسرني كثيرا أن أرشحها { award_name }</p>\n                    <p>وإنني مقتنع بأن (هي / هي) هي أفضل موظفة للحصول على الجائزة. وقد أدركت أنها شخصية موجهة نحو تحقيق الأهداف ، وتتسم بالكفاءة والفعالية في التقيد بالمواعيد. إنها دائما على استعداد لمشاركة معرفتها بالتفاصيل</p>\n                    <p>وبالإضافة إلى ذلك ، قامت (هي / هي) أحيانا بحل النزاعات والحالات الصعبة خلال ساعات العمل. (هي / هي) حصلت على بعض الجوائز من المنظمة غير الحكومية داخل البلد ؛ وكان ذلك بسبب المشاركة في أنشطة خيرية لمساعدة المحتاجين.</p>\n                    <p>وأعتقد أن هذه الصفات والصفات يجب أن تكون موضع تقدير. ولذلك ، فإن (هي / هي) تستحق أن تمنحها الجائزة بالتالي.</p>\n                    <p>إشعر بالحرية للوصول إلى الخارج إذا عندك أي أسئلة.</p>\n                    <p>شكرا لك</p>\n                    <p>Regards,</p>\n                    <p>إدارة الموارد البشرية ،</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Award Date\": \"award_date\", \"Award Name\": \"award_name\", \"Award Type\": \"award_type\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(110, 10, 'da', 'New Award', '<p>Om: HR-afdelingen / Kompagniet for at sende prisuddeling for at kunne genkende en medarbejder</p>\n                    <p>Hej { award_name },</p>\n                    <p>Jeg er meget glad for at nominere {award_name&nbsp;}</p>\n                    <p>Jeg er tilfreds med, at (hun) er den bedste medarbejder for prisen. Jeg har indset, at hun er en m&aring;lbevidst person, effektiv og meget punktlig. Hun er altid klar til at dele sin viden om detaljer.</p>\n                    <p>Desuden har (he/she) lejlighedsvist l&oslash;st konflikter og vanskelige situationer inden for arbejdstiden. (/hun) har modtaget nogle priser fra den ikkestatslige organisation i landet. Dette skyldes, at der skal v&aelig;re en del i velg&oslash;renhedsaktiviteter for at hj&aelig;lpe de tr&aelig;ngende.</p>\n                    <p>Jeg mener, at disse kvaliteter og egenskaber skal v&aelig;rds&aelig;tte. Derfor fortjener denne pris, at hun nominerer hende.</p>\n                    <p>Du er velkommen til at r&aelig;kke ud, hvis du har nogen sp&oslash;rgsm&aring;l.</p>\n                    <p>Tak.</p>\n                    <p>Med venlig hilsen</p>\n                    <p>HR-afdelingen,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Award Date\": \"award_date\", \"Award Name\": \"award_name\", \"Award Type\": \"award_type\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(111, 10, 'de', 'New Award', '<p>Betrifft: -Personalabteilung/Firma zum Versenden von Pr&auml;mienschreiben, um einen Mitarbeiter zu erkennen</p>\n                    <p>Hi {award_name},</p>\n                    <p>Ich freue mich sehr, {award_name} zu nominieren.</p>\n                    <p>Ich bin zufrieden, dass (he/she) der beste Mitarbeiter f&uuml;r die Auszeichnung ist. Ich habe erkannt, dass sie eine gottorientierte Person ist, effizient und sehr p&uuml;nktlich. Sie ist immer bereit, ihr Wissen &uuml;ber Details zu teilen.</p>\n                    <p>Dar&uuml;ber hinaus hat (he/she) gelegentlich Konflikte und schwierige Situationen innerhalb der Arbeitszeiten gel&ouml;st. (he/she) hat einige Auszeichnungen von der Nichtregierungsorganisation innerhalb des Landes erhalten; dies war wegen der Teilnahme an Wohlt&auml;tigkeitsaktivit&auml;ten, um den Bed&uuml;rftigen zu helfen.</p>\n                    <p>Ich glaube, diese Eigenschaften und Eigenschaften m&uuml;ssen gew&uuml;rdigt werden. Daher verdient (he/she) die Auszeichnung, die sie deshalb nominiert.</p>\n                    <p>F&uuml;hlen Sie sich frei, wenn Sie Fragen haben.</p>\n                    <p>Danke.</p>\n                    <p>Betrachtet,</p>\n                    <p>Personalabteilung,</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Award Date\": \"award_date\", \"Award Name\": \"award_name\", \"Award Type\": \"award_type\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(112, 10, 'en', 'New Award', '<p ><b>Subject:-HR department/Company to send award letter to recognize an employee</b></p>\n                    <p ><b>Hi {award_name},</b></p>\n                    <p >I am much pleased to nominate {award_name}  </p>\n                    <p >I am satisfied that (he/she) is the best employee for the award. I have realized that she is a goal-oriented person, efficient and very punctual. She is always ready to share her knowledge of details.</p>\n                    <p>Additionally, (he/she) has occasionally solved conflicts and difficult situations within working hours. (he/she) has received some awards from the non-governmental organization within the country; this was because of taking part in charity activities to help the needy.</p>\n                    <p>I believe these qualities and characteristics need to be appreciated. Therefore, (he/she) deserves the award hence nominating her.</p>\n                    <p>Feel free to reach out if you have any questions.</p>\n                    <p><b>Thank you</b></p>\n                    <p><b>Regards,</b></p>\n                    <p><b>HR Department,</b></p>\n                    <p><b>{app_name}</b></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Award Date\": \"award_date\", \"Award Name\": \"award_name\", \"Award Type\": \"award_type\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(113, 10, 'es', 'New Award', '<p>Asunto: -Departamento de RRHH/Empresa para enviar carta de premios para reconocer a un empleado</p>\n                    <p>Hi {award_name},</p>\n                    <p>Estoy muy satisfecho de nominar {award_name}</p>\n                    <p>Estoy satisfecho de que (ella) sea el mejor empleado para el premio. Me he dado cuenta de que es una persona orientada al objetivo, eficiente y muy puntual. Ella siempre est&aacute; lista para compartir su conocimiento de los detalles.</p>\n                    <p>Adicionalmente, (he/ella) ocasionalmente ha resuelto conflictos y situaciones dif&iacute;ciles dentro de las horas de trabajo. (h/ella) ha recibido algunos premios de la organizaci&oacute;n no gubernamental dentro del pa&iacute;s; esto fue debido a participar en actividades de caridad para ayudar a los necesitados.</p>\n                    <p>Creo que estas cualidades y caracter&iacute;sticas deben ser apreciadas. Por lo tanto, (h/ella) merece el premio por lo tanto nominarla.</p>\n                    <p>Si&eacute;ntase libre de llegar si usted tiene alguna pregunta.</p>\n                    <p>&iexcl;Gracias!</p>\n                    <p>Considerando,</p>\n                    <p>Departamento de Recursos Humanos,</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Award Date\": \"award_date\", \"Award Name\": \"award_name\", \"Award Type\": \"award_type\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(114, 10, 'fr', 'New Award', '<p>Objet: -Minist&egrave;re des RH / Soci&eacute;t&eacute; denvoi dune lettre dattribution pour reconna&icirc;tre un employ&eacute;</p>\n                    <p>Hi { award_name },</p>\n                    <p>Je suis tr&egrave;s heureux de nommer { award_name }</p>\n                    <p>Je suis convaincu que (he/elle) est le meilleur employ&eacute; pour ce prix. Jai r&eacute;alis&eacute; quelle est une personne orient&eacute;e vers lobjectif, efficace et tr&egrave;s ponctuelle. Elle est toujours pr&ecirc;te &agrave; partager sa connaissance des d&eacute;tails.</p>\n                    <p>De plus, (he/elle) a parfois r&eacute;solu des conflits et des situations difficiles dans les heures de travail. (he/elle) a re&ccedil;u des prix de lorganisation non gouvernementale &agrave; lint&eacute;rieur du pays, parce quelle a particip&eacute; &agrave; des activit&eacute;s de bienfaisance pour aider les n&eacute;cessiteux.</p>\n                    <p>Je crois que ces qualit&eacute;s et ces caract&eacute;ristiques doivent &ecirc;tre appr&eacute;ci&eacute;es. Par cons&eacute;quent, (he/elle) m&eacute;rite le prix donc nomin&eacute;.</p>\n                    <p>Nh&eacute;sitez pas &agrave; nous contacter si vous avez des questions.</p>\n                    <p>Je vous remercie</p>\n                    <p>Regards,</p>\n                    <p>D&eacute;partement des RH,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Award Date\": \"award_date\", \"Award Name\": \"award_name\", \"Award Type\": \"award_type\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(115, 10, 'it', 'New Award', '<p>Oggetto: - Dipartimento HR / Societ&agrave; per inviare lettera di premiazione per riconoscere un dipendente</p>\n                    <p>Ciao {award_name},</p>\n                    <p>Sono molto lieto di nominare {award_name}</p>\n                    <p>Sono soddisfatto che (he/lei) sia il miglior dipendente per il premio. Ho capito che &egrave; una persona orientata al goal-oriented, efficiente e molto puntuale. &Egrave; sempre pronta a condividere la sua conoscenza dei dettagli.</p>\n                    <p>Inoltre, (he/lei) ha occasionalmente risolto conflitti e situazioni difficili allinterno delle ore di lavoro. (he/lei) ha ricevuto alcuni premi dallorganizzazione non governativa allinterno del paese; questo perch&eacute; di prendere parte alle attivit&agrave; di beneficenza per aiutare i bisognosi.</p>\n                    <p>Credo che queste qualit&agrave; e caratteristiche debbano essere apprezzate. Pertanto, (he/lei) merita il premio da qui la nomina.</p>\n                    <p>Sentiti libero di raggiungere se hai domande.</p>\n                    <p>Grazie</p>\n                    <p>Riguardo,</p>\n                    <p>Dipartimento HR,</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Award Date\": \"award_date\", \"Award Name\": \"award_name\", \"Award Type\": \"award_type\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(116, 10, 'ja', 'New Award', '<p>件名: 従業員を認識するための表彰書を送信するための、人事部門/ 会社</p>\n                    <p>やあ {award_name }</p>\n                    <p>{award_name }をノミネートしたいと考えています。</p>\n                    <p>私は ( 彼女が ) 賞のための最高の従業員だと満足している。 私は彼女が、自分が目標指向の人間であり、効率的で、非常に時間厳守であることに気付きました。 彼女はいつも詳細についての知識を共有する準備ができている。</p>\n                    <p>また、時には労働時間内に紛争や困難な状況を解決することがある。 ( 彼女は ) 国内の非政府組織からいくつかの賞を受賞している。このことは、慈善活動に参加して、貧窮者を助けるためのものだった。</p>\n                    <p>これらの特性と特徴を評価する必要があると思います。 そのため、 ( 相続人は ) 賞に値するので彼女を指名することになる。</p>\n                    <p>質問がある場合は、自由に連絡してください。</p>\n                    <p>ありがとう</p>\n                    <p>よろしく</p>\n                    <p>HR 部門</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Award Date\": \"award_date\", \"Award Name\": \"award_name\", \"Award Type\": \"award_type\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06');
INSERT INTO `email_template_langs` (`id`, `parent_id`, `lang`, `subject`, `content`, `module_name`, `variables`, `created_at`, `updated_at`) VALUES
(117, 10, 'nl', 'New Award', '<p>Betreft: -HR-afdeling/Bedrijf om een gunningsbrief te sturen om een werknemer te herkennen</p>\n                    <p>Hallo { award_name },</p>\n                    <p>Ik ben erg blij om { award_name } te nomineren</p>\n                    <p>Ik ben tevreden dat (he/zij) de beste werknemer voor de prijs is. Ik heb me gerealiseerd dat ze een doelgericht persoon is, effici&euml;nt en punctueel. Ze is altijd klaar om haar kennis van details te delen.</p>\n                    <p>Daarnaast heeft (he/she) af en toe conflicten en moeilijke situaties binnen de werkuren opgelost. (he/zij) heeft een aantal prijzen ontvangen van de niet-gouvernementele organisatie binnen het land; dit was vanwege het deelnemen aan liefdadigheidsactiviteiten om de behoeftigen te helpen.</p>\n                    <p>Ik ben van mening dat deze kwaliteiten en eigenschappen moeten worden gewaardeerd. Daarom, (he/she) verdient de award dus nomineren haar.</p>\n                    <p>Voel je vrij om uit te reiken als je vragen hebt.</p>\n                    <p>Dank u wel</p>\n                    <p>Betreft:</p>\n                    <p>HR-afdeling,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Award Date\": \"award_date\", \"Award Name\": \"award_name\", \"Award Type\": \"award_type\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(118, 10, 'pl', 'New Award', '<p>Temat:-Dział HR/Firma do wysyłania list&oacute;w wyr&oacute;żnienia do rozpoznania pracownika</p>\n                    <p>Witaj {award_name },</p>\n                    <p>Jestem bardzo zadowolony z nominacji {award_name }</p>\n                    <p>Jestem zadowolony, że (he/she) jest najlepszym pracownikiem do nagrody. Zdałem sobie sprawę, że jest osobą zorientowaną na goły, sprawną i bardzo punktualną. Zawsze jest gotowa podzielić się swoją wiedzą na temat szczeg&oacute;ł&oacute;w.</p>\n                    <p>Dodatkowo, (he/she) od czasu do czasu rozwiązuje konflikty i trudne sytuacje w godzinach pracy. (he/she) otrzymała kilka nagr&oacute;d od organizacji pozarządowej w obrębie kraju; to z powodu wzięcia udziału w akcji charytatywnych, aby pom&oacute;c potrzebującym.</p>\n                    <p>Uważam, że te cechy i cechy muszą być docenione. Dlatego też, (he/she) zasługuje na nagrodę, stąd nominowanie jej.</p>\n                    <p>Czuj się swobodnie, jeśli masz jakieś pytania.</p>\n                    <p>Dziękujemy</p>\n                    <p>W odniesieniu do</p>\n                    <p>Dział HR,</p>\n                    <p>{app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Award Date\": \"award_date\", \"Award Name\": \"award_name\", \"Award Type\": \"award_type\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(119, 10, 'ru', 'New Award', '<p>Тема: -HR отдел/Компания отправить награда письмо о признании сотрудника</p>\n                    <p>Здравствуйте, { award_name },</p>\n                    <p>Мне очень приятно номинировать { award_name }</p>\n                    <p>Я удовлетворена тем, что (х/она) является лучшим работником премии. Я понял, что она ориентированная на цель человек, эффективная и очень пунктуальная. Она всегда готова поделиться своими знаниями о деталях.</p>\n                    <p>Кроме того, время от времени решались конфликты и сложные ситуации в рабочее время. (она) получила некоторые награды от неправительственной организации в стране; это было связано с тем, что они приняли участие в благотворительной деятельности, чтобы помочь нуждающимся.</p>\n                    <p>Я считаю, что эти качества и характеристики заслуживают высокой оценки. Таким образом, она заслуживает того, чтобы наградить ее таким образом.</p>\n                    <p>Не стеснитесь, если у вас есть вопросы.</p>\n                    <p>Спасибо.</p>\n                    <p>С уважением,</p>\n                    <p>Отдел кадров,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Award Date\": \"award_date\", \"Award Name\": \"award_name\", \"Award Type\": \"award_type\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(120, 10, 'pt', 'New Award', '<p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Assunto:-Departamento de RH / Empresa para enviar carta de premia&ccedil;&atilde;o para reconhecer um funcion&aacute;rio</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Oi {award_name},</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Estou muito satisfeito em nomear {award_name}</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Estou satisfeito que (he/she) &eacute; o melhor funcion&aacute;rio para o pr&ecirc;mio. Eu percebi que ela &eacute; uma pessoa orientada a goal, eficiente e muito pontual. Ela est&aacute; sempre pronta para compartilhar seu conhecimento de detalhes.</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Adicionalmente, (he/she) tem, ocasionalmente, resolvido conflitos e situa&ccedil;&otilde;es dif&iacute;ceis dentro do hor&aacute;rio de trabalho. (he/she) recebeu alguns pr&ecirc;mios da organiza&ccedil;&atilde;o n&atilde;o governamental dentro do pa&iacute;s; isso foi por ter participado de atividades de caridade para ajudar os necessitados.</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Eu acredito que essas qualidades e caracter&iacute;sticas precisam ser apreciadas. Por isso, (he/she) merece o pr&ecirc;mio da&iacute; nomeando-a.</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Sinta-se &agrave; vontade para alcan&ccedil;ar fora se voc&ecirc; tiver alguma d&uacute;vida.</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Obrigado</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Considera,</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Departamento de RH,</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">{app_name}</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Award Date\": \"award_date\", \"Award Name\": \"award_name\", \"Award Type\": \"award_type\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(121, 11, 'ar', 'Employee Transfer', '<p>Subject : -HR ادارة / شركة لارسال خطاب نقل الى موظف من مكان الى آخر.</p>\n                    <p>عزيزي { transfer_name },</p>\n                    <p>وفقا لتوجيهات الادارة ، يتم نقل الخدمات الخاصة بك w.e.f. { transfer_date }.</p>\n                    <p>مكان الادخال الجديد الخاص بك هو { transfer_department } قسم من فرع { transfer_branch } وتاريخ التحويل { transfer_date }.</p>\n                    <p>{ transfer_description }.</p>\n                    <p>إشعر بالحرية للوصول إلى الخارج إذا عندك أي أسئلة.</p>\n                    <p>شكرا لك</p>\n                    <p>Regards,</p>\n                    <p>إدارة الموارد البشرية ،</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Transfer Date\": \"transfer_date\", \"Transfer Name\": \"transfer_name\", \"Transfer Branch\": \"transfer_branch\", \"Transfer Department\": \"transfer_department\", \"Transfer Description\": \"transfer_description\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(122, 11, 'da', 'Employee Transfer', '<p>Emne:-HR-afdelingen / kompagniet om at sende overf&oslash;rsels brev til en medarbejder fra den ene lokalitet til den anden.</p>\n                    <p>K&aelig;re { transfer_name },</p>\n                    <p>Som Styring af direktiver overf&oslash;res dine serviceydelser w.e.f. { transfer_date }.</p>\n                    <p>Dit nye sted for postering er { transfer_departement } afdeling af { transfer_branch } gren og dato for overf&oslash;rsel { transfer_date }.</p>\n                    <p>{ transfer_description }.</p>\n                    <p>Du er velkommen til at r&aelig;kke ud, hvis du har nogen sp&oslash;rgsm&aring;l.</p>\n                    <p>Tak.</p>\n                    <p>Med venlig hilsen</p>\n                    <p>HR-afdelingen,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Transfer Date\": \"transfer_date\", \"Transfer Name\": \"transfer_name\", \"Transfer Branch\": \"transfer_branch\", \"Transfer Department\": \"transfer_department\", \"Transfer Description\": \"transfer_description\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(123, 11, 'de', 'Employee Transfer', '<p>Betreff: -Personalabteilung/Unternehmen, um einen &Uuml;berweisungsschreiben an einen Mitarbeiter von einem Standort an einen anderen zu senden.</p>\n                    <p>Sehr geehrter {transfer_name},</p>\n                    <p>Wie pro Management-Direktiven werden Ihre Dienste &uuml;ber w.e.f. {transfer_date} &uuml;bertragen.</p>\n                    <p>Ihr neuer Ort der Entsendung ist {transfer_department} Abteilung von {transfer_branch} Niederlassung und Datum der &Uuml;bertragung {transfer_date}.</p>\n                    <p>{transfer_description}.</p>\n                    <p>F&uuml;hlen Sie sich frei, wenn Sie Fragen haben.</p>\n                    <p>Danke.</p>\n                    <p>Betrachtet,</p>\n                    <p>Personalabteilung,</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Transfer Date\": \"transfer_date\", \"Transfer Name\": \"transfer_name\", \"Transfer Branch\": \"transfer_branch\", \"Transfer Department\": \"transfer_department\", \"Transfer Description\": \"transfer_description\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(124, 11, 'en', 'Employee Transfer', '<p ><b>Subject:-HR department/Company to send transfer letter to be issued to an employee from one location to another.</b></p>\n                    <p ><b>Dear {transfer_name},</b></p>\n                    <p >As per Management directives, your services are being transferred w.e.f.{transfer_date}. </p>\n                    <p >Your new place of posting is {transfer_department} department of {transfer_branch} branch and date of transfer {transfer_date}. </p>\n                    {transfer_description}.\n                    <p>Feel free to reach out if you have any questions.</p>\n                    <p><b>Thank you</b></p>\n                    <p><b>Regards,</b></p>\n                    <p><b>HR Department,</b></p>\n                    <p><b>{app_name}</b></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Transfer Date\": \"transfer_date\", \"Transfer Name\": \"transfer_name\", \"Transfer Branch\": \"transfer_branch\", \"Transfer Department\": \"transfer_department\", \"Transfer Description\": \"transfer_description\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(125, 11, 'es', 'Employee Transfer', '<p>Asunto: -Departamento de RR.HH./Empresa para enviar carta de transferencia a un empleado de un lugar a otro.</p>\n                    <p>Estimado {transfer_name},</p>\n                    <p>Seg&uacute;n las directivas de gesti&oacute;n, los servicios se transfieren w.e.f. {transfer_date}.</p>\n                    <p>El nuevo lugar de publicaci&oacute;n es el departamento {transfer_department} de la rama {transfer_branch} y la fecha de transferencia {transfer_date}.</p>\n                    <p>{transfer_description}.</p>\n                    <p>Si&eacute;ntase libre de llegar si usted tiene alguna pregunta.</p>\n                    <p>&iexcl;Gracias!</p>\n                    <p>Considerando,</p>\n                    <p>Departamento de Recursos Humanos,</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Transfer Date\": \"transfer_date\", \"Transfer Name\": \"transfer_name\", \"Transfer Branch\": \"transfer_branch\", \"Transfer Department\": \"transfer_department\", \"Transfer Description\": \"transfer_description\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(126, 11, 'fr', 'Employee Transfer', '<p>Objet: -Minist&egrave;re des RH / Soci&eacute;t&eacute; denvoi dune lettre de transfert &agrave; un employ&eacute; dun endroit &agrave; un autre.</p>\n                    <p>Cher { transfer_name },</p>\n                    <p>Selon les directives de gestion, vos services sont transf&eacute;r&eacute;s dans w.e.f. { transfer_date }.</p>\n                    <p>Votre nouveau lieu daffectation est le d&eacute;partement { transfer_department } de la branche { transfer_branch } et la date de transfert { transfer_date }.</p>\n                    <p>{ description_transfert }.</p>\n                    <p>Nh&eacute;sitez pas &agrave; nous contacter si vous avez des questions.</p>\n                    <p>Je vous remercie</p>\n                    <p>Regards,</p>\n                    <p>D&eacute;partement des RH,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Transfer Date\": \"transfer_date\", \"Transfer Name\": \"transfer_name\", \"Transfer Branch\": \"transfer_branch\", \"Transfer Department\": \"transfer_department\", \"Transfer Description\": \"transfer_description\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(127, 11, 'it', 'Employee Transfer', '<p>Oggetto: - Dipartimento HR / Societ&agrave; per inviare lettera di trasferimento da rilasciare a un dipendente da una localit&agrave; allaltra.</p>\n                    <p>Caro {transfer_name},</p>\n                    <p>Come per le direttive di Management, i tuoi servizi vengono trasferiti w.e.f. {transfer_date}.</p>\n                    <p>Il tuo nuovo luogo di distacco &egrave; {transfer_department} dipartimento di {transfer_branch} ramo e data di trasferimento {transfer_date}.</p>\n                    <p>{transfer_description}.</p>\n                    <p>Sentiti libero di raggiungere se hai domande.</p>\n                    <p>Grazie</p>\n                    <p>Riguardo,</p>\n                    <p>Dipartimento HR,</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Transfer Date\": \"transfer_date\", \"Transfer Name\": \"transfer_name\", \"Transfer Branch\": \"transfer_branch\", \"Transfer Department\": \"transfer_department\", \"Transfer Description\": \"transfer_description\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(128, 11, 'ja', 'Employee Transfer', '<p>Oggetto: - Dipartimento HR / Societ&agrave; per inviare lettera di trasferimento da rilasciare a un dipendente da una localit&agrave; allaltra.</p>\n                    <p>Caro {transfer_name},</p>\n                    <p>Come per le direttive di Management, i tuoi servizi vengono trasferiti w.e.f. {transfer_date}.</p>\n                    <p>Il tuo nuovo luogo di distacco &egrave; {transfer_department} dipartimento di {transfer_branch} ramo e data di trasferimento {transfer_date}.</p>\n                    <p>{transfer_description}.</p>\n                    <p>Sentiti libero di raggiungere se hai domande.</p>\n                    <p>Grazie</p>\n                    <p>Riguardo,</p>\n                    <p>Dipartimento HR,</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Transfer Date\": \"transfer_date\", \"Transfer Name\": \"transfer_name\", \"Transfer Branch\": \"transfer_branch\", \"Transfer Department\": \"transfer_department\", \"Transfer Description\": \"transfer_description\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(129, 11, 'nl', 'Employee Transfer', '<p>Betreft: -HR-afdeling/Bedrijf voor verzending van overdrachtsbrief aan een werknemer van de ene plaats naar de andere.</p>\n                    <p>Geachte { transfer_name },</p>\n                    <p>Als per beheerinstructie worden uw services overgebracht w.e.f. { transfer_date }.</p>\n                    <p>Uw nieuwe plaats van post is { transfer_department } van de afdeling { transfer_branch } en datum van overdracht { transfer_date }.</p>\n                    <p>{ transfer_description }.</p>\n                    <p>Voel je vrij om uit te reiken als je vragen hebt.</p>\n                    <p>Dank u wel</p>\n                    <p>Betreft:</p>\n                    <p>HR-afdeling,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Transfer Date\": \"transfer_date\", \"Transfer Name\": \"transfer_name\", \"Transfer Branch\": \"transfer_branch\", \"Transfer Department\": \"transfer_department\", \"Transfer Description\": \"transfer_description\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(130, 11, 'pl', 'Employee Transfer', '<p>Temat:-Dział HR/Firma do wysyłania listu przelewowego, kt&oacute;ry ma być wydany pracownikowi z jednego miejsca do drugiego.</p>\n                    <p>Droga {transfer_name },</p>\n                    <p>Zgodnie z dyrektywami zarządzania, Twoje usługi są przesyłane w.e.f. {transfer_date }.</p>\n                    <p>Twoje nowe miejsce delegowania to {transfer_department } dział {transfer_branch } gałąź i data transferu {transfer_date }.</p>\n                    <p>{transfer_description }.</p>\n                    <p>Czuj się swobodnie, jeśli masz jakieś pytania.</p>\n                    <p>Dziękujemy</p>\n                    <p>W odniesieniu do</p>\n                    <p>Dział HR,</p>\n                    <p>{app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Transfer Date\": \"transfer_date\", \"Transfer Name\": \"transfer_name\", \"Transfer Branch\": \"transfer_branch\", \"Transfer Department\": \"transfer_department\", \"Transfer Description\": \"transfer_description\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(131, 11, 'ru', 'Employee Transfer', '<p>Тема: -HR отдел/Компания для отправки трансферного письма сотруднику из одного места в другое.</p>\n                    <p>Уважаемый { transfer_name },</p>\n                    <p>В соответствии с директивами управления ваши службы передаются .ef. { transfer_date }.</p>\n                    <p>Новое место разноски: { transfer_department} подразделение { transfer_branch } и дата передачи { transfer_date }.</p>\n                    <p>{ transfer_description }.</p>\n                    <p>Не стеснитесь, если у вас есть вопросы.</p>\n                    <p>Спасибо.</p>\n                    <p>С уважением,</p>\n                    <p>Отдел кадров,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Transfer Date\": \"transfer_date\", \"Transfer Name\": \"transfer_name\", \"Transfer Branch\": \"transfer_branch\", \"Transfer Department\": \"transfer_department\", \"Transfer Description\": \"transfer_description\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(132, 11, 'pt', 'Employee Transfer', '<p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Assunto:-Departamento de RH / Empresa para enviar carta de transfer&ecirc;ncia para ser emitida para um funcion&aacute;rio de um local para outro.</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Querido {transfer_name},</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Conforme diretivas de Gerenciamento, seus servi&ccedil;os est&atilde;o sendo transferidos w.e.f. {transfer_date}.</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">O seu novo local de postagem &eacute; {transfer_departamento} departamento de {transfer_branch} ramo e data de transfer&ecirc;ncia {transfer_date}.</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">{transfer_description}.</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Sinta-se &agrave; vontade para alcan&ccedil;ar fora se voc&ecirc; tiver alguma d&uacute;vida.</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Obrigado</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Considera,</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Departamento de RH,</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">{app_name}</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Transfer Date\": \"transfer_date\", \"Transfer Name\": \"transfer_name\", \"Transfer Branch\": \"transfer_branch\", \"Transfer Department\": \"transfer_department\", \"Transfer Description\": \"transfer_description\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(133, 12, 'ar', 'Employee Resignation', '<p>Subject :-قسم الموارد البشرية / الشركة لإرسال خطاب استقالته.</p>\n                    <p>عزيزي { assign_user } ،</p>\n                    <p>إنه لمن دواعي الأسف الشديد أن أعترف رسميا باستلام إشعار استقالتك في { notice_date } الى { resignation_date } هو اليوم الأخير لعملك.</p>\n                    <p>لقد كان من دواعي سروري العمل معكم ، وبالنيابة عن الفريق ، أود أن أتمنى لكم أفضل جدا في جميع مساعيكم في المستقبل. ومن خلال هذه الرسالة ، يرجى العثور على حزمة معلومات تتضمن معلومات مفصلة عن عملية الاستقالة.</p>\n                    <p>شكرا لكم مرة أخرى على موقفكم الإيجابي والعمل الجاد كل هذه السنوات.</p>\n                    <p>إشعر بالحرية للوصول إلى الخارج إذا عندك أي أسئلة.</p>\n                    <p>شكرا لك</p>\n                    <p>Regards,</p>\n                    <p>إدارة الموارد البشرية ،</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Employee Name\": \"assign_user\", \"Resignation Date\": \"notice_date\", \"Last Working Date\": \"resignation_date\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(134, 12, 'da', 'Employee Resignation', '<p>Om: HR-afdelingen / Kompagniet, for at sende en opsigelse.</p>\n                    <p>K&aelig;re { assign_user },</p>\n                    <p>Det er med stor beklagelse, at jeg formelt anerkender modtagelsen af din opsigelsesmeddelelse p&aring; { notice_date } til { resignation_date } er din sidste arbejdsdag</p>\n                    <p>Det har v&aelig;ret en forn&oslash;jelse at arbejde sammen med Dem, og p&aring; vegne af teamet vil jeg &oslash;nske Dem det bedste i alle Deres fremtidige bestr&aelig;belser. Med dette brev kan du finde en informationspakke med detaljerede oplysninger om tilbagetr&aelig;delsesprocessen.</p>\n                    <p>Endnu en gang tak for Deres positive holdning og h&aring;rde arbejde i alle disse &aring;r.</p>\n                    <p>Du er velkommen til at r&aelig;kke ud, hvis du har nogen sp&oslash;rgsm&aring;l.</p>\n                    <p>Tak.</p>\n                    <p>Med venlig hilsen</p>\n                    <p>HR-afdelingen,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Employee Name\": \"assign_user\", \"Resignation Date\": \"notice_date\", \"Last Working Date\": \"resignation_date\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(135, 12, 'de', 'Employee Resignation', '<p>Betreff: -Personalabteilung/Firma, um R&uuml;ckmeldungsschreiben zu senden.</p>\n                    <p>Sehr geehrter {assign_user},</p>\n                    <p>Es ist mit gro&szlig;em Bedauern, dass ich den Eingang Ihrer R&uuml;cktrittshinweis auf {notice_date} an {resignation_date} offiziell best&auml;tige, ist Ihr letzter Arbeitstag.</p>\n                    <p>Es war eine Freude, mit Ihnen zu arbeiten, und im Namen des Teams m&ouml;chte ich Ihnen w&uuml;nschen, dass Sie in allen Ihren zuk&uuml;nftigen Bem&uuml;hungen am besten sind. In diesem Brief finden Sie ein Informationspaket mit detaillierten Informationen zum R&uuml;cktrittsprozess.</p>\n                    <p>Vielen Dank noch einmal f&uuml;r Ihre positive Einstellung und harte Arbeit all die Jahre.</p>\n                    <p>F&uuml;hlen Sie sich frei, wenn Sie Fragen haben.</p>\n                    <p>Danke.</p>\n                    <p>Betrachtet,</p>\n                    <p>Personalabteilung,</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Employee Name\": \"assign_user\", \"Resignation Date\": \"notice_date\", \"Last Working Date\": \"resignation_date\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(136, 12, 'en', 'Employee Resignation', '<p ><b>Subject:-HR department/Company to send resignation letter .</b></p>\n                    <p ><b>Dear {assign_user},</b></p>\n                    <p >It is with great regret that I formally acknowledge receipt of your resignation notice on {notice_date} to {resignation_date} is your final day of work. </p>\n                    <p >It has been a pleasure working with you, and on behalf of the team, I would like to wish you the very best in all your future endeavors. Included with this letter, please find an information packet with detailed information on the resignation process. </p>\n                    <p>Thank you again for your positive attitude and hard work all these years.</p>\n                    <p>Feel free to reach out if you have any questions.</p>\n                    <p>Thank you</p>\n                    <p><b>Regards,</b></p>\n                    <p><b>HR Department,</b></p>\n                    <p><b>{app_name}</b></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Employee Name\": \"assign_user\", \"Resignation Date\": \"notice_date\", \"Last Working Date\": \"resignation_date\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(137, 12, 'es', 'Employee Resignation', '<p>Asunto: -Departamento de RRHH/Empresa para enviar carta de renuncia.</p>\n                    <p>Estimado {assign_user},</p>\n                    <p>Es con gran pesar que recibo formalmente la recepci&oacute;n de su aviso de renuncia en {notice_date} a {resignation_date} es su &uacute;ltimo d&iacute;a de trabajo.</p>\n                    <p>Ha sido un placer trabajar con usted, y en nombre del equipo, me gustar&iacute;a desearle lo mejor en todos sus esfuerzos futuros. Incluido con esta carta, por favor encuentre un paquete de informaci&oacute;n con informaci&oacute;n detallada sobre el proceso de renuncia.</p>\n                    <p>Gracias de nuevo por su actitud positiva y trabajo duro todos estos a&ntilde;os.</p>\n                    <p>Si&eacute;ntase libre de llegar si usted tiene alguna pregunta.</p>\n                    <p>&iexcl;Gracias!</p>\n                    <p>Considerando,</p>\n                    <p>Departamento de Recursos Humanos,</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Employee Name\": \"assign_user\", \"Resignation Date\": \"notice_date\", \"Last Working Date\": \"resignation_date\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(138, 12, 'fr', 'Employee Resignation', '<p>Objet: -D&eacute;partement RH / Soci&eacute;t&eacute; denvoi dune lettre de d&eacute;mission.</p>\n                    <p>Cher { assign_user },</p>\n                    <p>Cest avec grand regret que je reconnais officiellement la r&eacute;ception de votre avis de d&eacute;mission sur { notice_date } &agrave; { resignation_date } est votre dernier jour de travail.</p>\n                    <p>Cest un plaisir de travailler avec vous, et au nom de l&eacute;quipe, jaimerais vous souhaiter le meilleur dans toutes vos activit&eacute;s futures. Inclus avec cette lettre, veuillez trouver un paquet dinformation contenant des informations d&eacute;taill&eacute;es sur le processus de d&eacute;mission.</p>\n                    <p>Je vous remercie encore de votre attitude positive et de votre travail acharne durant toutes ces ann&eacute;es.</p>\n                    <p>Nh&eacute;sitez pas &agrave; nous contacter si vous avez des questions.</p>\n                    <p>Je vous remercie</p>\n                    <p>Regards,</p>\n                    <p>D&eacute;partement des RH,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Employee Name\": \"assign_user\", \"Resignation Date\": \"notice_date\", \"Last Working Date\": \"resignation_date\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(139, 12, 'it', 'Employee Resignation', '<p>Oggetto: - Dipartimento HR / Societ&agrave; per inviare lettera di dimissioni.</p>\n                    <p>Caro {assign_user},</p>\n                    <p>&Egrave; con grande dispiacere che riconosca formalmente la ricezione del tuo avviso di dimissioni su {notice_date} a {resignation_date} &egrave; la tua giornata di lavoro finale.</p>\n                    <p>&Egrave; stato un piacere lavorare con voi, e a nome della squadra, vorrei augurarvi il massimo in tutti i vostri futuri sforzi. Incluso con questa lettera, si prega di trovare un pacchetto informativo con informazioni dettagliate sul processo di dimissioni.</p>\n                    <p>Grazie ancora per il vostro atteggiamento positivo e duro lavoro in tutti questi anni.</p>\n                    <p>Sentiti libero di raggiungere se hai domande.</p>\n                    <p>Grazie</p>\n                    <p>Riguardo,</p>\n                    <p>Dipartimento HR,</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Employee Name\": \"assign_user\", \"Resignation Date\": \"notice_date\", \"Last Working Date\": \"resignation_date\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(140, 12, 'ja', 'Employee Resignation', '<p>件名:-HR 部門/企業は辞表を送信します。</p>\n                    <p>{assign_user} の認証を解除します。</p>\n                    <p>{ notice_date} に対するあなたの辞任通知を { resignation_date} に正式に受理することを正式に確認することは、非常に残念です。</p>\n                    <p>あなたと一緒に仕事をしていて、チームのために、あなたの将来の努力において、あなたのことを最高のものにしたいと思っています。 このレターには、辞任プロセスに関する詳細な情報が記載されている情報パケットをご覧ください。</p>\n                    <p>これらの長年の前向きな姿勢と努力を重ねて感謝します。</p>\n                    <p>質問がある場合は、自由に連絡してください。</p>\n                    <p>ありがとう</p>\n                    <p>よろしく</p>\n                    <p>HR 部門</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Employee Name\": \"assign_user\", \"Resignation Date\": \"notice_date\", \"Last Working Date\": \"resignation_date\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(141, 12, 'nl', 'Employee Resignation', '<p>Betreft: -HR-afdeling/Bedrijf om ontslagbrief te sturen.</p>\n                    <p>Geachte { assign_user },</p>\n                    <p>Het is met grote spijt dat ik de ontvangst van uw ontslagbrief op { notice_date } tot { resignation_date } formeel de ontvangst van uw laatste dag van het werk bevestigt.</p>\n                    <p>Het was een genoegen om met u samen te werken, en namens het team zou ik u het allerbeste willen wensen in al uw toekomstige inspanningen. Vermeld bij deze brief een informatiepakket met gedetailleerde informatie over het ontslagproces.</p>\n                    <p>Nogmaals bedankt voor uw positieve houding en hard werken al die jaren.</p>\n                    <p>Voel je vrij om uit te reiken als je vragen hebt.</p>\n                    <p>Dank u wel</p>\n                    <p>Betreft:</p>\n                    <p>HR-afdeling,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Employee Name\": \"assign_user\", \"Resignation Date\": \"notice_date\", \"Last Working Date\": \"resignation_date\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(142, 12, 'pl', 'Employee Resignation', '<p>Temat: -Dział HR/Firma do wysyłania listu rezygnacyjnego.</p>\n                    <p>Drogi użytkownika {assign_user },</p>\n                    <p>Z wielkim żalem, że oficjalnie potwierdzam otrzymanie powiadomienia o rezygnacji w dniu {notice_date } to {resignation_date } to tw&oacute;j ostatni dzień pracy.</p>\n                    <p>Z przyjemnością wsp&oacute;łpracujemy z Tobą, a w imieniu zespołu chciałbym życzyć Wam wszystkiego najlepszego we wszystkich swoich przyszłych przedsięwzięciu. Dołączone do tego listu prosimy o znalezienie pakietu informacyjnego ze szczeg&oacute;łowymi informacjami na temat procesu dymisji.</p>\n                    <p>Jeszcze raz dziękuję za pozytywne nastawienie i ciężką pracę przez te wszystkie lata.</p>\n                    <p>Czuj się swobodnie, jeśli masz jakieś pytania.</p>\n                    <p>Dziękujemy</p>\n                    <p>W odniesieniu do</p>\n                    <p>Dział HR,</p>\n                    <p>{app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Employee Name\": \"assign_user\", \"Resignation Date\": \"notice_date\", \"Last Working Date\": \"resignation_date\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(143, 12, 'ru', 'Employee Resignation', '<p>Тема: -HR отдел/Компания отправить письмо об отставке.</p>\n                    <p>Уважаемый пользователь { assign_user },</p>\n                    <p>С большим сожалением я официально подтверждаю получение вашего уведомления об отставке { notice_date } в { resignation_date }-это ваш последний день работы.</p>\n                    <p>С Вами было приятно работать, и от имени команды я хотел бы по# желать вам самого лучшего во всех ваших будущих начинаниях. В этом письме Вы можете найти информационный пакет с подробной информацией об отставке.</p>\n                    <p>Еще раз спасибо за ваше позитивное отношение и трудолюбие все эти годы.</p>\n                    <p>Не стеснитесь, если у вас есть вопросы.</p>\n                    <p>Спасибо.</p>\n                    <p>С уважением,</p>\n                    <p>Отдел кадров,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Employee Name\": \"assign_user\", \"Resignation Date\": \"notice_date\", \"Last Working Date\": \"resignation_date\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(144, 12, 'pt', 'Employee Resignation', '<p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Assunto:-Departamento de RH / Empresa para enviar carta de demiss&atilde;o.</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Querido {assign_user},</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">&Eacute; com grande pesar que reconhe&ccedil;o formalmente o recebimento do seu aviso de demiss&atilde;o em {notice_date} a {resignation_date} &eacute; o seu dia final de trabalho.</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Foi um prazer trabalhar com voc&ecirc;, e em nome da equipe, gostaria de desej&aacute;-lo o melhor em todos os seus futuros empreendimentos. Inclu&iacute;dos com esta carta, por favor, encontre um pacote de informa&ccedil;&otilde;es com informa&ccedil;&otilde;es detalhadas sobre o processo de demiss&atilde;o.</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Obrigado novamente por sua atitude positiva e trabalho duro todos esses anos.</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Sinta-se &agrave; vontade para alcan&ccedil;ar fora se voc&ecirc; tiver alguma d&uacute;vida.</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Obrigado</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Considera,</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Departamento de RH,</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">{app_name}</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Employee Name\": \"assign_user\", \"Resignation Date\": \"notice_date\", \"Last Working Date\": \"resignation_date\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(145, 13, 'ar', 'Employee Trip', '<p>Subject : -HR ادارة / شركة لارسال رسالة رحلة.</p>\n                    <p>عزيزي { employee_trip_name },</p>\n                    <p>قمة الصباح إليك ! أكتب إلى مكتب إدارتكم بطلب متواضع للسفر من أجل زيارة إلى الخارج عن قصد.</p>\n                    <p>وسيكون هذا المنتدى هو المنتدى الرئيسي لأعمال المناخ في العام ، وقد كان محظوظا بما فيه الكفاية لكي يرشح لتمثيل شركتنا والمنطقة خلال الحلقة الدراسية.</p>\n                    <p>إن عضويتي التي دامت ثلاث سنوات كجزء من المجموعة والمساهمات التي قدمتها إلى الشركة ، ونتيجة لذلك ، كانت مفيدة من الناحية التكافلية. وفي هذا الصدد ، فإنني أطلب منكم بصفتي الرئيس المباشر لي أن يسمح لي بالحضور.</p>\n                    <p>مزيد من التفاصيل عن الرحلة :&nbsp;</p>\n                    <p>مدة الرحلة : { start_date } الى { end_date }</p>\n                    <p>الغرض من الزيارة : { purpose_of_visit }</p>\n                    <p>مكان الزيارة : { place_of_visit }</p>\n                    <p>الوصف : { trip_description }</p>\n                    <p>إشعر بالحرية للوصول إلى الخارج إذا عندك أي أسئلة.</p>\n                    <p>شكرا لك</p>\n                    <p>Regards,</p>\n                    <p>إدارة الموارد البشرية ،</p>\n                    <p>{ app_name }</p>', NULL, '{\"Place\": \"place_of_visit\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_trip_name\", \"End Date\": \"end_date\", \"Start Date\": \"start_date\", \"Description\": \"trip_description\", \"Company Name\": \"company_name\", \"Purpose of Trip\": \"purpose_of_visit\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(146, 13, 'da', 'Employee Trip', '<p>Om: HR-afdelingen / Kompagniet, der skal sende udflugten.</p>\n                    <p>K&aelig;re { employee_trip_name },</p>\n                    <p>Godmorgen til dig! Jeg skriver til dit kontor med en ydmyg anmodning om at rejse for en { purpose_of_visit } i udlandet.</p>\n                    <p>Det ville v&aelig;re &aring;rets f&oslash;rende klimaforum, og det ville v&aelig;re heldigt nok at blive nomineret til at repr&aelig;sentere vores virksomhed og regionen under seminaret.</p>\n                    <p>Mit tre&aring;rige medlemskab som en del af den gruppe og de bidrag, jeg har givet til virksomheden, har som f&oslash;lge heraf v&aelig;ret symbiotisk fordelagtigt. I den henseende anmoder jeg om, at De som min n&aelig;rmeste overordnede giver mig lov til at deltage.</p>\n                    <p>Flere oplysninger om turen:</p>\n                    <p>Trip Duration: { start_date } til { end_date }</p>\n                    <p>Form&aring;let med Bes&oslash;g: { purpose_of_visit }</p>\n                    <p>Plads af bes&oslash;g: { place_of_visit }</p>\n                    <p>Beskrivelse: { trip_description }</p>\n                    <p>Du er velkommen til at r&aelig;kke ud, hvis du har nogen sp&oslash;rgsm&aring;l.</p>\n                    <p>Tak.</p>\n                    <p>Med venlig hilsen</p>\n                    <p>HR-afdelingen,</p>\n                    <p>{ app_name }</p>', NULL, '{\"Place\": \"place_of_visit\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_trip_name\", \"End Date\": \"end_date\", \"Start Date\": \"start_date\", \"Description\": \"trip_description\", \"Company Name\": \"company_name\", \"Purpose of Trip\": \"purpose_of_visit\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(147, 13, 'de', 'Employee Trip', '<p>Betreff: -Personalabteilung/Firma, um Reisebrief zu schicken.</p>\n                    <p>Sehr geehrter {employee_trip_name},</p>\n                    <p>Top of the morning to you! Ich schreibe an Ihre Dienststelle mit dem&uuml;tiger Bitte um eine Reise nach einem {purpose_of_visit} im Ausland.</p>\n                    <p>Es w&auml;re das f&uuml;hrende Klima-Business-Forum des Jahres und hatte das Gl&uuml;ck, nominiert zu werden, um unser Unternehmen und die Region w&auml;hrend des Seminars zu vertreten.</p>\n                    <p>Meine dreij&auml;hrige Mitgliedschaft als Teil der Gruppe und die Beitr&auml;ge, die ich an das Unternehmen gemacht habe, sind dadurch symbiotisch vorteilhaft gewesen. In diesem Zusammenhang ersuche ich Sie als meinen unmittelbaren Vorgesetzten, mir zu gestatten, zu besuchen.</p>\n                    <p>Mehr Details zu Reise:</p>\n                    <p>Dauer der Fahrt: {start_date} bis {end_date}</p>\n                    <p>Zweck des Besuchs: {purpose_of_visit}</p>\n                    <p>Ort des Besuchs: {place_of_visit}</p>\n                    <p>Beschreibung: {trip_description}</p>\n                    <p>F&uuml;hlen Sie sich frei, wenn Sie Fragen haben.</p>\n                    <p>Danke.</p>\n                    <p>Betrachtet,</p>\n                    <p>Personalabteilung,</p>\n                    <p>{app_name}</p>', NULL, '{\"Place\": \"place_of_visit\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_trip_name\", \"End Date\": \"end_date\", \"Start Date\": \"start_date\", \"Description\": \"trip_description\", \"Company Name\": \"company_name\", \"Purpose of Trip\": \"purpose_of_visit\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(148, 13, 'en', 'Employee Trip', '<p><strong>Subject:-HR department/Company to send trip letter .</strong></p>\n                    <p><strong>Dear {employee_trip_name},</strong></p>\n                    <p>Top of the morning to you! I am writing to your department office with a humble request to travel for a {purpose_of_visit} abroad.</p>\n                    <p>It would be the leading climate business forum of the year and have been lucky enough to be nominated to represent our company and the region during the seminar.</p>\n                    <p>My three-year membership as part of the group and contributions I have made to the company, as a result, have been symbiotically beneficial. In that regard, I am requesting you as my immediate superior to permit me to attend.</p>\n                    <p>More detail about trip:{start_date} to {end_date}</p>\n                    <p>Trip Duration:{start_date} to {end_date}</p>\n                    <p>Purpose of Visit:{purpose_of_visit}</p>\n                    <p>Place of Visit:{place_of_visit}</p>\n                    <p>Description:{trip_description}</p>\n                    <p>Feel free to reach out if you have any questions.</p>\n                    <p>Thank you</p>\n                    <p><strong>Regards,</strong></p>\n                    <p><strong>HR Department,</strong></p>\n                    <p><strong>{app_name}</strong></p>', NULL, '{\"Place\": \"place_of_visit\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_trip_name\", \"End Date\": \"end_date\", \"Start Date\": \"start_date\", \"Description\": \"trip_description\", \"Company Name\": \"company_name\", \"Purpose of Trip\": \"purpose_of_visit\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(149, 13, 'es', 'Employee Trip', '<p>Asunto: -Departamento de RRHH/Empresa para enviar carta de viaje.</p>\n                    <p>Estimado {employee_trip_name},</p>\n                    <p>&iexcl;Top de la ma&ntilde;ana para ti! Estoy escribiendo a su oficina del departamento con una humilde petici&oacute;n de viajar para un {purpose_of_visit} en el extranjero.</p>\n                    <p>Ser&iacute;a el principal foro de negocios clim&aacute;ticos del a&ntilde;o y han tenido la suerte de ser nominados para representar a nuestra compa&ntilde;&iacute;a y a la regi&oacute;n durante el seminario.</p>\n                    <p>Mi membres&iacute;a de tres a&ntilde;os como parte del grupo y las contribuciones que he hecho a la compa&ntilde;&iacute;a, como resultado, han sido simb&oacute;ticamente beneficiosos. En ese sentido, le estoy solicitando como mi superior inmediato que me permita asistir.</p>\n                    <p>M&aacute;s detalles sobre el viaje:&nbsp;</p>\n                    <p>Duraci&oacute;n del viaje: {start_date} a {end_date}</p>\n                    <p>Finalidad de la visita: {purpose_of_visit}</p>\n                    <p>Lugar de visita: {place_of_visit}</p>\n                    <p>Descripci&oacute;n: {trip_description}</p>\n                    <p>Si&eacute;ntase libre de llegar si usted tiene alguna pregunta.</p>\n                    <p>&iexcl;Gracias!</p>\n                    <p>Considerando,</p>\n                    <p>Departamento de Recursos Humanos,</p>\n                    <p>{app_name}</p>', NULL, '{\"Place\": \"place_of_visit\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_trip_name\", \"End Date\": \"end_date\", \"Start Date\": \"start_date\", \"Description\": \"trip_description\", \"Company Name\": \"company_name\", \"Purpose of Trip\": \"purpose_of_visit\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(150, 13, 'fr', 'Employee Trip', '<p>Objet: -Service des RH / Compagnie pour envoyer une lettre de voyage.</p>\n                    <p>Cher { employee_trip_name },</p>\n                    <p>Top of the morning to you ! J&eacute;crai au bureau de votre minist&egrave;re avec une humble demande de voyage pour une {purpose_of_visit } &agrave; l&eacute;tranger.</p>\n                    <p>Il sagit du principal forum sur le climat de lann&eacute;e et a eu la chance d&ecirc;tre d&eacute;sign&eacute; pour repr&eacute;senter notre entreprise et la r&eacute;gion au cours du s&eacute;minaire.</p>\n                    <p>Mon adh&eacute;sion de trois ans au groupe et les contributions que jai faites &agrave; lentreprise, en cons&eacute;quence, ont &eacute;t&eacute; b&eacute;n&eacute;fiques sur le plan symbiotique. &Agrave; cet &eacute;gard, je vous demande d&ecirc;tre mon sup&eacute;rieur imm&eacute;diat pour me permettre dy assister.</p>\n                    <p>Plus de d&eacute;tails sur le voyage:</p>\n                    <p>Dur&eacute;e du voyage: { start_date } &agrave; { end_date }</p>\n                    <p>Objet de la visite: { purpose_of_visit}</p>\n                    <p>Lieu de visite: { place_of_visit }</p>\n                    <p>Description: { trip_description }</p>\n                    <p>Nh&eacute;sitez pas &agrave; nous contacter si vous avez des questions.</p>\n                    <p>Je vous remercie</p>\n                    <p>Regards,</p>\n                    <p>D&eacute;partement des RH,</p>\n                    <p>{ app_name }</p>', NULL, '{\"Place\": \"place_of_visit\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_trip_name\", \"End Date\": \"end_date\", \"Start Date\": \"start_date\", \"Description\": \"trip_description\", \"Company Name\": \"company_name\", \"Purpose of Trip\": \"purpose_of_visit\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(151, 13, 'it', 'Employee Trip', '<p>Oggetto: - Dipartimento HR / Societ&agrave; per inviare lettera di viaggio.</p>\n                    <p>Caro {employee_trip_name},</p>\n                    <p>In cima al mattino a te! Scrivo al tuo ufficio dipartimento con umile richiesta di viaggio per un {purpose_of_visit} allestero.</p>\n                    <p>Sarebbe il forum aziendale sul clima leader dellanno e sono stati abbastanza fortunati da essere nominati per rappresentare la nostra azienda e la regione durante il seminario.</p>\n                    <p>La mia adesione triennale come parte del gruppo e i contributi che ho apportato allazienda, di conseguenza, sono stati simbioticamente vantaggiosi. A tal proposito, vi chiedo come mio immediato superiore per consentirmi di partecipare.</p>\n                    <p>Pi&ugrave; dettagli sul viaggio:</p>\n                    <p>Trip Duration: {start_date} a {end_date}</p>\n                    <p>Finalit&agrave; di Visita: {purpose_of_visit}</p>\n                    <p>Luogo di Visita: {place_of_visit}</p>\n                    <p>Descrizione: {trip_description}</p>\n                    <p>Sentiti libero di raggiungere se hai domande.</p>\n                    <p>Grazie</p>\n                    <p>Riguardo,</p>\n                    <p>Dipartimento HR,</p>\n                    <p>{app_name}</p>', NULL, '{\"Place\": \"place_of_visit\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_trip_name\", \"End Date\": \"end_date\", \"Start Date\": \"start_date\", \"Description\": \"trip_description\", \"Company Name\": \"company_name\", \"Purpose of Trip\": \"purpose_of_visit\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06');
INSERT INTO `email_template_langs` (`id`, `parent_id`, `lang`, `subject`, `content`, `module_name`, `variables`, `created_at`, `updated_at`) VALUES
(152, 13, 'ja', 'Employee Trip', '<p>件名:-HR 部門/会社は出張レターを送信します。</p>\n                    <p>{ employee_trip_name} に出庫します。</p>\n                    <p>朝のトップだ ! 海外で {purpose_of_visit} をお願いしたいという謙虚な要求をもって、私はあなたの部署に手紙を書いています。</p>\n                    <p>これは、今年の主要な気候ビジネス・フォーラムとなり、セミナーの開催中に当社と地域を代表する候補になるほど幸運にも恵まれています。</p>\n                    <p>私が会社に対して行った 3 年間のメンバーシップは、その結果として、共生的に有益なものでした。 その点では、私は、私が出席することを許可することを、私の即座の上司として</p>\n                    <p>トリップについての詳細 :</p>\n                    <p>トリップ期間:{start_date} を {end_date} に設定します</p>\n                    <p>アクセスの目的 :{purpose_of_visit}</p>\n                    <p>訪問の場所 :{place_of_visit}</p>\n                    <p>説明:{trip_description}</p>\n                    <p>質問がある場合は、自由に連絡してください。</p>\n                    <p>ありがとう</p>\n                    <p>よろしく</p>\n                    <p>HR 部門</p>\n                    <p>{app_name}</p>', NULL, '{\"Place\": \"place_of_visit\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_trip_name\", \"End Date\": \"end_date\", \"Start Date\": \"start_date\", \"Description\": \"trip_description\", \"Company Name\": \"company_name\", \"Purpose of Trip\": \"purpose_of_visit\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(153, 13, 'nl', 'Employee Trip', '<p>Betreft: -HR-afdeling/Bedrijf om reisbrief te sturen.</p>\n                    <p>Geachte { employee_trip_name },</p>\n                    <p>Top van de ochtend aan u! Ik schrijf uw afdelingsbureau met een bescheiden verzoek om een { purpose_of_visit } in het buitenland te bezoeken.</p>\n                    <p>Het zou het toonaangevende klimaatforum van het jaar zijn en hebben het geluk gehad om genomineerd te worden om ons bedrijf en de regio te vertegenwoordigen tijdens het seminar.</p>\n                    <p>Mijn driejarige lidmaatschap als onderdeel van de groep en bijdragen die ik heb geleverd aan het bedrijf, als gevolg daarvan, zijn symbiotisch gunstig geweest. Wat dat betreft, verzoek ik u als mijn directe chef mij in staat te stellen aanwezig te zijn.</p>\n                    <p>Meer details over reis:</p>\n                    <p>Duur van reis: { start_date } tot { end_date }</p>\n                    <p>Doel van bezoek: { purpose_of_visit }</p>\n                    <p>Plaats van bezoek: { place_of_visit }</p>\n                    <p>Beschrijving: { trip_description }</p>\n                    <p>Voel je vrij om uit te reiken als je vragen hebt.</p>\n                    <p>Dank u we</p>\n                    <p>Betreft:</p>\n                    <p>HR-afdeling,</p>\n                    <p>{ app_name }</p>', NULL, '{\"Place\": \"place_of_visit\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_trip_name\", \"End Date\": \"end_date\", \"Start Date\": \"start_date\", \"Description\": \"trip_description\", \"Company Name\": \"company_name\", \"Purpose of Trip\": \"purpose_of_visit\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(154, 13, 'pl', 'Employee Trip', '<p>Temat:-Dział HR/Firma do wysyłania listu podr&oacute;ży.</p>\n                    <p>Szanowny {employee_trip_name },</p>\n                    <p>Od samego rana do Ciebie! Piszę do twojego biura, z pokornym prośbą o wyjazd na {purpose_of_visit&nbsp;} za granicą.</p>\n                    <p>Byłoby to wiodącym forum biznesowym w tym roku i miało szczęście być nominowane do reprezentowania naszej firmy i regionu podczas seminarium.</p>\n                    <p>Moje trzyletnie członkostwo w grupie i składkach, kt&oacute;re uczyniłem w firmie, w rezultacie, były symbiotycznie korzystne. W tym względzie, zwracam się do pana o m&oacute;j bezpośredni przełożony, kt&oacute;ry pozwoli mi na udział w tej sprawie.</p>\n                    <p>Więcej szczeg&oacute;ł&oacute;w na temat wyjazdu:</p>\n                    <p>Czas trwania rejsu: {start_date } do {end_date }</p>\n                    <p>Cel wizyty: {purpose_of_visit }</p>\n                    <p>Miejsce wizyty: {place_of_visit }</p>\n                    <p>Opis: {trip_description }</p>\n                    <p>Czuj się swobodnie, jeśli masz jakieś pytania.</p>\n                    <p>Dziękujemy</p>\n                    <p>W odniesieniu do</p>\n                    <p>Dział HR,</p>\n                    <p>{app_name }</p>', NULL, '{\"Place\": \"place_of_visit\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_trip_name\", \"End Date\": \"end_date\", \"Start Date\": \"start_date\", \"Description\": \"trip_description\", \"Company Name\": \"company_name\", \"Purpose of Trip\": \"purpose_of_visit\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(155, 13, 'ru', 'Employee Trip', '<p>Тема: -HR отдел/Компания для отправки письма на поездку.</p>\n                    <p>Уважаемый { employee_trip_name },</p>\n                    <p>С утра до тебя! Я пишу в ваш отдел с смиренным запросом на поездку за границу.</p>\n                    <p>Это был бы ведущий климатический бизнес-форум года и по везло, что в ходе семинара он будет представлять нашу компанию и регион.</p>\n                    <p>Мое трехлетнее членство в составе группы и взносы, которые я внес в компанию, в результате, были симбиотически выгодны. В этой связи я прошу вас как моего непосредственного начальника разрешить мне присутствовать.</p>\n                    <p>Подробнее о поездке:</p>\n                    <p>Длительность поездки: { start_date } в { end_date }</p>\n                    <p>Цель посещения: { purpose_of_visit }</p>\n                    <p>Место посещения: { place_of_visit }</p>\n                    <p>Описание: { trip_description }</p>\n                    <p>Не стеснитесь, если у вас есть вопросы.</p>\n                    <p>Спасибо.</p>\n                    <p>С уважением,</p>\n                    <p>Отдел кадров,</p>\n                    <p>{ app_name }</p>', NULL, '{\"Place\": \"place_of_visit\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_trip_name\", \"End Date\": \"end_date\", \"Start Date\": \"start_date\", \"Description\": \"trip_description\", \"Company Name\": \"company_name\", \"Purpose of Trip\": \"purpose_of_visit\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(156, 13, 'pt', 'Employee Trip', '<p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Assunto:-Departamento de RH / Empresa para enviar carta de viagem.</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Querido {employee_trip_name},</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Topo da manh&atilde; para voc&ecirc;! Estou escrevendo para o seu departamento de departamento com um humilde pedido para viajar por um {purpose_of_visit} no exterior.</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Seria o principal f&oacute;rum de neg&oacute;cios clim&aacute;tico do ano e teve a sorte de ser indicado para representar nossa empresa e a regi&atilde;o durante o semin&aacute;rio.</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">A minha filia&ccedil;&atilde;o de tr&ecirc;s anos como parte do grupo e contribui&ccedil;&otilde;es que fiz &agrave; empresa, como resultado, foram simbioticamente ben&eacute;fico. A esse respeito, solicito que voc&ecirc; seja meu superior imediato para me permitir comparecer.</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Mais detalhes sobre viagem:</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Trip Dura&ccedil;&atilde;o: {start_date} a {end_date}</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Objetivo da Visita: {purpose_of_visit}</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Local de Visita: {place_of_visit}</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Descri&ccedil;&atilde;o: {trip_description}</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Sinta-se &agrave; vontade para alcan&ccedil;ar fora se voc&ecirc; tiver alguma d&uacute;vida.</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Obrigado</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Considera,</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Departamento de RH,</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">{app_name}</span></p>', NULL, '{\"Place\": \"place_of_visit\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_trip_name\", \"End Date\": \"end_date\", \"Start Date\": \"start_date\", \"Description\": \"trip_description\", \"Company Name\": \"company_name\", \"Purpose of Trip\": \"purpose_of_visit\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(157, 14, 'ar', 'Employee Promotion', '<p>Subject : -HR القسم / الشركة لارسال رسالة تهنئة الى العمل للتهنئة بالعمل.</p>\n                    <p>عزيزي { employee_promotion_name },</p>\n                    <p>تهاني على ترقيتك الى { promotion_designation } { promotion_title } الفعال { promotion_date }.</p>\n                    <p>وسنواصل توقع تحقيق الاتساق وتحقيق نتائج عظيمة منكم في دوركم الجديد. ونأمل أن تكون قدوة للموظفين الآخرين في المنظمة.</p>\n                    <p>ونتمنى لكم التوفيق في أداءكم في المستقبل ، وتهانينا !</p>\n                    <p>ومرة أخرى ، تهانئي على الموقف الجديد.</p>\n                    <p>إشعر بالحرية للوصول إلى الخارج إذا عندك أي أسئلة.</p>\n                    <p>شكرا لك</p>\n                    <p>Regards,</p>\n                    <p>إدارة الموارد البشرية ،</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_promotion_name\", \"Designation\": \"promotion_designation\", \"Company Name\": \"company_name\", \"Promotion Date\": \"promotion_date\", \"Promotion Title\": \"promotion_title\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(158, 14, 'da', 'Employee Promotion', '<p>Om: HR-afdelingen / Virksomheden om at sende en lyk&oslash;nskning til jobfremst&oslash;d.</p>\n                    <p>K&aelig;re { employee_promotion_name },</p>\n                    <p>Tillykke med din forfremmelse til { promotion_designation } { promotion_title } effektiv { promotion_date }.</p>\n                    <p>Vi vil fortsat forvente konsekvens og store resultater fra Dem i Deres nye rolle. Vi h&aring;ber, at De vil foreg&aring; med et godt eksempel for de &oslash;vrige ansatte i organisationen.</p>\n                    <p>Vi &oslash;nsker Dem held og lykke med Deres fremtidige optr&aelig;den, og tillykke!</p>\n                    <p>Endnu en gang tillykke med den nye holdning.</p>\n                    <p>Du er velkommen til at r&aelig;kke ud, hvis du har nogen sp&oslash;rgsm&aring;l.</p>\n                    <p>Tak.</p>\n                    <p>Med venlig hilsen</p>\n                    <p>HR-afdelingen,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_promotion_name\", \"Designation\": \"promotion_designation\", \"Company Name\": \"company_name\", \"Promotion Date\": \"promotion_date\", \"Promotion Title\": \"promotion_title\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(159, 14, 'de', 'Employee Promotion', '<p>Betrifft: -Personalabteilung/Unternehmen, um einen Gl&uuml;ckwunschschreiben zu senden.</p>\n                    <p>Sehr geehrter {employee_promotion_name},</p>\n                    <p>Herzlichen Gl&uuml;ckwunsch zu Ihrer Werbeaktion an {promotion_designation} {promotion_title} wirksam {promotion_date}.</p>\n                    <p>Wir werden von Ihnen in Ihrer neuen Rolle weiterhin Konsistenz und gro&szlig;e Ergebnisse erwarten. Wir hoffen, dass Sie ein Beispiel f&uuml;r die anderen Mitarbeiter der Organisation setzen werden.</p>\n                    <p>Wir w&uuml;nschen Ihnen viel Gl&uuml;ck f&uuml;r Ihre zuk&uuml;nftige Leistung, und gratulieren!</p>\n                    <p>Nochmals herzlichen Gl&uuml;ckwunsch zu der neuen Position.</p>\n                    <p>F&uuml;hlen Sie sich frei, wenn Sie Fragen haben.</p>\n                    <p>Danke.</p>\n                    <p>Betrachtet,</p>\n                    <p>Personalabteilung,</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_promotion_name\", \"Designation\": \"promotion_designation\", \"Company Name\": \"company_name\", \"Promotion Date\": \"promotion_date\", \"Promotion Title\": \"promotion_title\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(160, 14, 'en', 'Employee Promotion', '<p>&nbsp;</p>\n                    <p><strong>Subject:-HR department/Company to send job promotion congratulation letter.</strong></p>\n                    <p><strong>Dear {employee_promotion_name},</strong></p>\n                    <p>Congratulations on your promotion to {promotion_designation} {promotion_title} effective {promotion_date}.</p>\n                    <p>We shall continue to expect consistency and great results from you in your new role. We hope that you will set an example for the other employees of the organization.</p>\n                    <p>We wish you luck for your future performance, and congratulations!.</p>\n                    <p>Again, congratulations on the new position.</p>\n                    <p>&nbsp;</p>\n                    <p>Feel free to reach out if you have any questions.</p>\n                    <p>Thank you</p>\n                    <p><strong>Regards,</strong></p>\n                    <p><strong>HR Department,</strong></p>\n                    <p><strong>{app_name}</strong></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_promotion_name\", \"Designation\": \"promotion_designation\", \"Company Name\": \"company_name\", \"Promotion Date\": \"promotion_date\", \"Promotion Title\": \"promotion_title\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(161, 14, 'es', 'Employee Promotion', '<p>Asunto: -Departamento de RRHH/Empresa para enviar carta de felicitaci&oacute;n de promoci&oacute;n de empleo.</p>\n                    <p>Estimado {employee_promotion_name},</p>\n                    <p>Felicidades por su promoci&oacute;n a {promotion_designation} {promotion_title} efectiva {promotion_date}.</p>\n                    <p>Seguiremos esperando la coherencia y los grandes resultados de ustedes en su nuevo papel. Esperamos que usted ponga un ejemplo para los otros empleados de la organizaci&oacute;n.</p>\n                    <p>Le deseamos suerte para su futuro rendimiento, y felicitaciones!.</p>\n                    <p>Una vez m&aacute;s, felicidades por la nueva posici&oacute;n.</p>\n                    <p>Si&eacute;ntase libre de llegar si usted tiene alguna pregunta.</p>\n                    <p>&iexcl;Gracias!</p>\n                    <p>Considerando,</p>\n                    <p>Departamento de Recursos Humanos,</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_promotion_name\", \"Designation\": \"promotion_designation\", \"Company Name\": \"company_name\", \"Promotion Date\": \"promotion_date\", \"Promotion Title\": \"promotion_title\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(162, 14, 'fr', 'Employee Promotion', '<p>Objet: -D&eacute;partement RH / Soci&eacute;t&eacute; denvoi dune lettre de f&eacute;licitations pour la promotion de lemploi.</p>\n                    <p>Cher { employee_promotion_name },</p>\n                    <p>F&eacute;licitations pour votre promotion &agrave; { promotion_d&eacute;signation } { promotion_title } effective { promotion_date }.</p>\n                    <p>Nous continuerons &agrave; vous attendre &agrave; une coh&eacute;rence et &agrave; de grands r&eacute;sultats de votre part dans votre nouveau r&ocirc;le. Nous esp&eacute;rons que vous trouverez un exemple pour les autres employ&eacute;s de lorganisation.</p>\n                    <p>Nous vous souhaitons bonne chance pour vos performances futures et f&eacute;licitations !</p>\n                    <p>Encore une fois, f&eacute;licitations pour le nouveau poste.</p>\n                    <p>Nh&eacute;sitez pas &agrave; nous contacter si vous avez des questions.</p>\n                    <p>Je vous remercie</p>\n                    <p>Regards,</p>\n                    <p>D&eacute;partement des RH,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_promotion_name\", \"Designation\": \"promotion_designation\", \"Company Name\": \"company_name\", \"Promotion Date\": \"promotion_date\", \"Promotion Title\": \"promotion_title\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(163, 14, 'it', 'Employee Promotion', '<p>Oggetto: - Dipartimento HR / Societ&agrave; per inviare la lettera di congratulazioni alla promozione del lavoro.</p>\n                    <p>Caro {employee_promotion_name},</p>\n                    <p>Complimenti per la tua promozione a {promotion_designation} {promotion_title} efficace {promotion_date}.</p>\n                    <p>Continueremo ad aspettarci coerenza e grandi risultati da te nel tuo nuovo ruolo. Ci auguriamo di impostare un esempio per gli altri dipendenti dellorganizzazione.</p>\n                    <p>Ti auguriamo fortuna per le tue prestazioni future, e complimenti!.</p>\n                    <p>Ancora, complimenti per la nuova posizione.</p>\n                    <p>Sentiti libero di raggiungere se hai domande.</p>\n                    <p>Grazie</p>\n                    <p>Riguardo,</p>\n                    <p>Dipartimento HR,</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_promotion_name\", \"Designation\": \"promotion_designation\", \"Company Name\": \"company_name\", \"Promotion Date\": \"promotion_date\", \"Promotion Title\": \"promotion_title\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(164, 14, 'ja', 'Employee Promotion', '<p>件名:-HR 部門/企業は、求人広告の祝賀状を送信します。</p>\n                    <p>{ employee_promotion_name} に出庫します。</p>\n                    <p>{promotion_designation } { promotion_title} {promotion_date} 販促に対するお祝いのお祝いがあります。</p>\n                    <p>今後とも、お客様の新しい役割において一貫性と大きな成果を期待します。 組織の他の従業員の例を設定したいと考えています。</p>\n                    <p>あなたの未来のパフォーマンスをお祈りします。おめでとうございます。</p>\n                    <p>また、新しい地位について祝意を表する。</p>\n                    <p>質問がある場合は、自由に連絡してください。</p>\n                    <p>ありがとう</p>\n                    <p>よろしく</p>\n                    <p>HR 部門</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_promotion_name\", \"Designation\": \"promotion_designation\", \"Company Name\": \"company_name\", \"Promotion Date\": \"promotion_date\", \"Promotion Title\": \"promotion_title\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(165, 14, 'nl', 'Employee Promotion', '<p>Betreft: -HR-afdeling/Bedrijf voor het versturen van de aanbevelingsbrief voor taakpromotie.</p>\n                    <p>Geachte { employee_promotion_name },</p>\n                    <p>Gefeliciteerd met uw promotie voor { promotion_designation } { promotion_title } effective { promotion_date }.</p>\n                    <p>Wij zullen de consistentie en de grote resultaten van u in uw nieuwe rol blijven verwachten. Wij hopen dat u een voorbeeld zult stellen voor de andere medewerkers van de organisatie.</p>\n                    <p>Wij wensen u geluk voor uw toekomstige prestaties, en gefeliciteerd!.</p>\n                    <p>Nogmaals, gefeliciteerd met de nieuwe positie.</p>\n                    <p>Voel je vrij om uit te reiken als je vragen hebt.</p>\n                    <p>Dank u wel</p>\n                    <p>Betreft:</p>\n                    <p>HR-afdeling,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_promotion_name\", \"Designation\": \"promotion_designation\", \"Company Name\": \"company_name\", \"Promotion Date\": \"promotion_date\", \"Promotion Title\": \"promotion_title\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(166, 14, 'pl', 'Employee Promotion', '<p>Temat: -Dział kadr/Firma w celu wysłania listu gratulacyjnego dla promocji zatrudnienia.</p>\n                    <p>Szanowny {employee_promotion_name },</p>\n                    <p>Gratulacje dla awansowania do {promotion_designation } {promotion_title } efektywnej {promotion_date }.</p>\n                    <p>W dalszym ciągu oczekujemy konsekwencji i wspaniałych wynik&oacute;w w Twojej nowej roli. Mamy nadzieję, że postawicie na przykład dla pozostałych pracownik&oacute;w organizacji.</p>\n                    <p>Życzymy powodzenia dla przyszłych wynik&oacute;w, gratulujemy!.</p>\n                    <p>Jeszcze raz gratulacje na nowej pozycji.</p>\n                    <p>Czuj się swobodnie, jeśli masz jakieś pytania.</p>\n                    <p>Dziękujemy</p>\n                    <p>W odniesieniu do</p>\n                    <p>Dział HR,</p>\n                    <p>{app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_promotion_name\", \"Designation\": \"promotion_designation\", \"Company Name\": \"company_name\", \"Promotion Date\": \"promotion_date\", \"Promotion Title\": \"promotion_title\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(167, 14, 'ru', 'Employee Promotion', '<p>Тема: -HR отдел/Компания для отправки письма с поздравлением.</p>\n                    <p>Уважаемый { employee_promotion_name },</p>\n                    <p>Поздравляем вас с продвижением в { promotion_designation } { promotion_title } эффективная { promotion_date }.</p>\n                    <p>Мы будем и впредь ожидать от вас соответствия и больших результатов в вашей новой роли. Мы надеемся, что вы станете примером для других сотрудников организации.</p>\n                    <p>Желаем вам удачи и поздравлений!</p>\n                    <p>Еще раз поздравляю с новой позицией.</p>\n                    <p>Не стеснитесь, если у вас есть вопросы.</p>\n                    <p>Спасибо.</p>\n                    <p>С уважением,</p>\n                    <p>Отдел кадров,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_promotion_name\", \"Designation\": \"promotion_designation\", \"Company Name\": \"company_name\", \"Promotion Date\": \"promotion_date\", \"Promotion Title\": \"promotion_title\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(168, 14, 'pt', 'Employee Promotion', '<p style=\"font-size: 14.4px;\">Assunto:-Departamento de RH / Empresa para enviar carta de felicita&ccedil;&atilde;o de promo&ccedil;&atilde;o de emprego.</p>\n                    <p style=\"font-size: 14.4px;\">Querido {employee_promotion_name},</p>\n                    <p style=\"font-size: 14.4px;\">Parab&eacute;ns pela sua promo&ccedil;&atilde;o para {promotion_designation} {promotion_title} efetivo {promotion_date}.</p>\n                    <p style=\"font-size: 14.4px;\">Continuaremos a esperar consist&ecirc;ncia e grandes resultados a partir de voc&ecirc; em seu novo papel. Esperamos que voc&ecirc; defina um exemplo para os demais funcion&aacute;rios da organiza&ccedil;&atilde;o.</p>\n                    <p style=\"font-size: 14.4px;\">Desejamos sorte para o seu desempenho futuro, e parab&eacute;ns!.</p>\n                    <p style=\"font-size: 14.4px;\">Novamente, parab&eacute;ns pela nova posi&ccedil;&atilde;o.</p>\n                    <p style=\"font-size: 14.4px;\">Sinta-se &agrave; vontade para alcan&ccedil;ar fora se voc&ecirc; tiver alguma d&uacute;vida.</p>\n                    <p style=\"font-size: 14.4px;\">Obrigado</p>\n                    <p style=\"font-size: 14.4px;\">Considera,</p>\n                    <p style=\"font-size: 14.4px;\">Departamento de RH,</p>\n                    <p style=\"font-size: 14.4px;\">{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_promotion_name\", \"Designation\": \"promotion_designation\", \"Company Name\": \"company_name\", \"Promotion Date\": \"promotion_date\", \"Promotion Title\": \"promotion_title\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(169, 15, 'ar', 'Employee Complaints', '<p>Subject :-قسم الموارد البشرية / الشركة لإرسال رسالة شكوى.</p>\n                    <p>عزيزي { employee_complaints_name },</p>\n                    <p>وأود أن أبلغ عن صراعا بينكم وبين الشخص الآخر. فقد وقعت عدة حوادث خلال الأيام القليلة الماضية ، وأشعر أن الوقت قد حان لتقديم شكوى رسمية ضده / لها.</p>\n                    <p>إشعر بالحرية للوصول إلى الخارج إذا عندك أي أسئلة.</p>\n                    <p>شكرا لك</p>\n                    <p>Regards,</p>\n                    <p>إدارة الموارد البشرية ،</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_complaints_name\", \"description\": \"complaints_description\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(170, 15, 'da', 'Employee Complaints', '<p>Om: HR-departementet / Kompagniet for at sende klager.</p>\n                    <p>K&aelig;re { employee_complaints_name },</p>\n                    <p>Jeg vil gerne anmelde en konflikt mellem Dem og den anden person, og der er sket flere episoder i de seneste dage, og jeg mener, at det er p&aring; tide at anmelde en formel klage over for ham.</p>\n                    <p>Du er velkommen til at r&aelig;kke ud, hvis du har nogen sp&oslash;rgsm&aring;l.</p>\n                    <p>Tak.</p>\n                    <p>Med venlig hilsen</p>\n                    <p>HR-afdelingen,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_complaints_name\", \"description\": \"complaints_description\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(171, 15, 'de', 'Employee Complaints', '<p>Betrifft: -Personalabteilung/Unternehmen zum Senden von Beschwerden.</p>\n                    <p>Sehr geehrter {employee_complaints_name},</p>\n                    <p>Ich m&ouml;chte einen Konflikt zwischen Ihnen und der anderen Person melden. Es hat in den letzten Tagen mehrere Zwischenf&auml;lle gegeben, und ich glaube, es ist an der Zeit, eine formelle Beschwerde gegen ihn zu erstatten.</p>\n                    <p>F&uuml;hlen Sie sich frei, wenn Sie Fragen haben.</p>\n                    <p>Danke.</p>\n                    <p>Betrachtet,</p>\n                    <p>Personalabteilung,</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_complaints_name\", \"description\": \"complaints_description\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(172, 15, 'en', 'Employee Complaints', '<p><strong>Subject:-HR department/Company to send complaints letter.</strong></p>\n                    <p><strong>Dear {employee_complaints_name},</strong></p>\n                    <p>I would like to report a conflict between you and the other person.There have been several incidents over the last few days, and I feel that it is time to report a formal complaint against him/her.</p>\n                    <p>&nbsp;</p>\n                    <p>Feel free to reach out if you have any questions.</p>\n                    <p>Thank you</p>\n                    <p><strong>Regards,</strong></p>\n                    <p><strong>HR Department,</strong></p>\n                    <p><strong>{app_name}</strong></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_complaints_name\", \"description\": \"complaints_description\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(173, 15, 'es', 'Employee Complaints', '<p>Asunto: -Departamento de RRHH/Empresa para enviar carta de quejas.</p>\n                    <p>Estimado {employee_complaints_name},</p>\n                    <p>Me gustar&iacute;a informar de un conflicto entre usted y la otra persona. Ha habido varios incidentes en los &uacute;ltimos d&iacute;as, y creo que es hora de denunciar una queja formal contra &eacute;l.</p>\n                    <p>Si&eacute;ntase libre de llegar si usted tiene alguna pregunta.</p>\n                    <p>&iexcl;Gracias!</p>\n                    <p>Considerando,</p>\n                    <p>Departamento de Recursos Humanos,</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_complaints_name\", \"description\": \"complaints_description\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(174, 15, 'fr', 'Employee Complaints', '<p>Objet: -Service des ressources humaines / Compagnie pour envoyer une lettre de plainte.</p>\n                    <p>Cher { employee_complaints_name },</p>\n                    <p>Je voudrais signaler un conflit entre vous et lautre personne. Il y a eu plusieurs incidents au cours des derniers jours, et je pense quil est temps de signaler une plainte officielle contre lui.</p>\n                    <p>Nh&eacute;sitez pas &agrave; nous contacter si vous avez des questions.</p>\n                    <p>Je vous remercie</p>\n                    <p>Regards,</p>\n                    <p>D&eacute;partement des RH,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_complaints_name\", \"description\": \"complaints_description\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(175, 15, 'it', 'Employee Complaints', '<p>Oggetto: - Dipartimento HR / Societ&agrave; per inviare lettera di reclamo.</p>\n                    <p>Caro {employee_complaints_name},</p>\n                    <p>Vorrei segnalare un conflitto tra lei e laltra persona Ci sono stati diversi incidenti negli ultimi giorni, e sento che &egrave; il momento di denunciare una denuncia formale contro di lui.</p>\n                    <p>Sentiti libero di raggiungere se hai domande.</p>\n                    <p>Grazie</p>\n                    <p>Riguardo,</p>\n                    <p>Dipartimento HR,</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_complaints_name\", \"description\": \"complaints_description\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(176, 15, 'ja', 'Employee Complaints', '<p>件名:-HR 部門/会社は、クレーム・レターを送信します。</p>\n                    <p>{ employee_complaints_name} の Dear&nbsp;</p>\n                    <p>あなたと他の人との間の葛藤を報告したいと思いますこの数日間でいくつかの事件が発生しています彼女に対する正式な申し立てをする時だと感じています</p>\n                    <p>質問がある場合は、自由に連絡してください。</p>\n                    <p>ありがとう</p>\n                    <p>よろしく</p>\n                    <p>HR 部門</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_complaints_name\", \"description\": \"complaints_description\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(177, 15, 'nl', 'Employee Complaints', '<p>Betreft: -HR-afdeling/Bedrijf voor het verzenden van klachtenbrief.</p>\n                    <p>Geachte { employee_complaints_name},</p>\n                    <p>Ik zou een conflict willen melden tussen u en de andere persoon. Er zijn de afgelopen dagen verschillende incidenten geweest en ik denk dat het tijd is om een formele klacht tegen hem/haar in te dienen.</p>\n                    <p>Voel je vrij om uit te reiken als je vragen hebt.</p>\n                    <p>Dank u wel</p>\n                    <p>Betreft:</p>\n                    <p>HR-afdeling,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_complaints_name\", \"description\": \"complaints_description\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(178, 15, 'pl', 'Employee Complaints', '<p>Temat:-Dział HR/Firma do wysyłania listu reklamowego.</p>\n                    <p>Szanowna {employee_complaints_name },</p>\n                    <p>Chciałbym zgłosić konflikt między tobą a drugą osobą. W ciągu ostatnich kilku dni było kilka incydent&oacute;w i czuję, że nadszedł czas, aby zgłosić oficjalną skargę przeciwko niej.</p>\n                    <p>Czuj się swobodnie, jeśli masz jakieś pytania.</p>\n                    <p>Dziękujemy</p>\n                    <p>W odniesieniu do</p>\n                    <p>Dział HR,</p>\n                    <p>{app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_complaints_name\", \"description\": \"complaints_description\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(179, 15, 'ru', 'Employee Complaints', '<p>Тема: -HR отдел/Компания отправить письмо с жалобами.</p>\n                    <p>Уважаемый { employee_complaints_name }</p>\n                    <p>Я хотел бы сообщить о конфликте между вами и другим человеком. За последние несколько дней произошло несколько инцидентов, и я считаю, что пришло время сообщить о своей официальной жалобе.</p>\n                    <p>Не стеснитесь, если у вас есть вопросы.</p>\n                    <p>Спасибо.</p>\n                    <p>С уважением,</p>\n                    <p>Отдел кадров,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_complaints_name\", \"description\": \"complaints_description\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(180, 15, 'pt', 'Employee Complaints', '<p>Assunto:-Departamento de RH / Empresa para enviar carta de reclama&ccedil;&otilde;es.</p>\n                    <p>Querido {employee_complaints_name},</p>\n                    <p>Eu gostaria de relatar um conflito entre voc&ecirc; e a outra pessoa. Houve v&aacute;rios incidentes ao longo dos &uacute;ltimos dias, e eu sinto que &eacute; hora de relatar uma den&uacute;ncia formal contra him/her.</p>\n                    <p>Sinta-se &agrave; vontade para alcan&ccedil;ar fora se voc&ecirc; tiver alguma d&uacute;vida.</p>\n                    <p>Obrigado</p>\n                    <p>Considera,</p>\n                    <p>Departamento de RH,</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_complaints_name\", \"description\": \"complaints_description\", \"Company Name\": \"company_name\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(181, 16, 'ar', 'Employee Warning', '<p style=\"text-align: left;\"><span style=\"font-size: 12pt;\"><span style=\"color: #222222;\"><span style=\"white-space: pre-wrap;\">Subject : -HR ادارة / شركة لارسال رسالة تحذير. عزيزي { employe_warning_name }, { warning_subject } { warning_description } إشعر بالحرية للوصول إلى الخارج إذا عندك أي أسئلة. شكرا لك Regards, إدارة الموارد البشرية ، { app_name }</span></span></span></p>', NULL, '{\"App Url\": \"app_url\", \"Subject\": \"warning_subject\", \"App Name\": \"app_name\", \"Employee\": \"employee_warning_name\", \"Description\": \"warning_description\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(182, 16, 'da', 'Employee Warning', '<p>Om: HR-afdelingen / kompagniet for at sende advarselsbrev.</p>\n                    <p>K&aelig;re { employee_warning_name },</p>\n                    <p>{ warning_subject }</p>\n                    <p>{ warning_description }</p>\n                    <p>Du er velkommen til at r&aelig;kke ud, hvis du har nogen sp&oslash;rgsm&aring;l.</p>\n                    <p>Tak.</p>\n                    <p>Med venlig hilsen</p>\n                    <p>HR-afdelingen,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"Subject\": \"warning_subject\", \"App Name\": \"app_name\", \"Employee\": \"employee_warning_name\", \"Description\": \"warning_description\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(183, 16, 'de', 'Employee Warning', '<p>Betreff: -Personalabteilung/Unternehmen zum Senden von Warnschreiben.</p>\n                    <p>Sehr geehrter {employee_warning_name},</p>\n                    <p>{warning_subject}</p>\n                    <p>{warning_description}</p>\n                    <p>F&uuml;hlen Sie sich frei, wenn Sie Fragen haben.</p>\n                    <p>Danke.</p>\n                    <p>Betrachtet,</p>\n                    <p>Personalabteilung,</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"Subject\": \"warning_subject\", \"App Name\": \"app_name\", \"Employee\": \"employee_warning_name\", \"Description\": \"warning_description\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(184, 16, 'en', 'Employee Warning', '<p><strong>Subject:-HR department/Company to send warning letter.</strong></p>\n                    <p><strong>Dear {employee_warning_name},</strong></p>\n                    <p>{warning_subject}</p>\n                    <p>{warning_description}</p>\n                    <p>Feel free to reach out if you have any questions.</p>\n                    <p>Thank you</p>\n                    <p><strong>Regards,</strong></p>\n                    <p><strong>HR Department,</strong></p>\n                    <p><strong>{app_name}</strong></p>', NULL, '{\"App Url\": \"app_url\", \"Subject\": \"warning_subject\", \"App Name\": \"app_name\", \"Employee\": \"employee_warning_name\", \"Description\": \"warning_description\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(185, 16, 'es', 'Employee Warning', '<p>Asunto: -Departamento de RR.HH./Empresa para enviar carta de advertencia.</p>\n                    <p>Estimado {employee_warning_name},</p>\n                    <p>{warning_subject}</p>\n                    <p>{warning_description}</p>\n                    <p>Si&eacute;ntase libre de llegar si usted tiene alguna pregunta.</p>\n                    <p>&iexcl;Gracias!</p>\n                    <p>Considerando,</p>\n                    <p>Departamento de Recursos Humanos,</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"Subject\": \"warning_subject\", \"App Name\": \"app_name\", \"Employee\": \"employee_warning_name\", \"Description\": \"warning_description\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(186, 16, 'fr', 'Employee Warning', '<p>Objet: -HR department / Company to send warning letter.</p>\n                    <p>Cher { employee_warning_name },</p>\n                    <p>{ warning_subject }</p>\n                    <p>{ warning_description }</p>\n                    <p>Nh&eacute;sitez pas &agrave; nous contacter si vous avez des questions.</p>\n                    <p>Je vous remercie</p>\n                    <p>Regards,</p>\n                    <p>D&eacute;partement des RH,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"Subject\": \"warning_subject\", \"App Name\": \"app_name\", \"Employee\": \"employee_warning_name\", \"Description\": \"warning_description\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(187, 16, 'it', 'Employee Warning', '<p>Oggetto: - Dipartimento HR / Societ&agrave; per inviare lettera di avvertimento.</p>\n                    <p>Caro {employee_warning_name},</p>\n                    <p>{warning_subject}</p>\n                    <p>{warning_description}</p>\n                    <p>Sentiti libero di raggiungere se hai domande.</p>\n                    <p>Grazie</p>\n                    <p>Riguardo,</p>\n                    <p>Dipartimento HR,</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"Subject\": \"warning_subject\", \"App Name\": \"app_name\", \"Employee\": \"employee_warning_name\", \"Description\": \"warning_description\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(188, 16, 'ja', 'Employee Warning', '<p><span style=\"font-size: 12pt;\"><span style=\"color: #222222;\"><span style=\"white-space: pre-wrap;\">件名:-HR 部門/企業は警告レターを送信します。 { employee_warning_name} を出庫します。 {warning_subject} {warning_description} 質問がある場合は、自由に連絡してください。 ありがとう よろしく HR 部門 {app_name}</span></span></span></p>', NULL, '{\"App Url\": \"app_url\", \"Subject\": \"warning_subject\", \"App Name\": \"app_name\", \"Employee\": \"employee_warning_name\", \"Description\": \"warning_description\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(189, 16, 'nl', 'Employee Warning', '<p>Betreft: -HR-afdeling/bedrijf om een waarschuwingsbrief te sturen.</p>\n                    <p>Geachte { employee_warning_name },</p>\n                    <p>{ warning_subject }</p>\n                    <p>{ warning_description }</p>\n                    <p>Voel je vrij om uit te reiken als je vragen hebt.</p>\n                    <p>Dank u wel</p>\n                    <p>Betreft:</p>\n                    <p>HR-afdeling,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"Subject\": \"warning_subject\", \"App Name\": \"app_name\", \"Employee\": \"employee_warning_name\", \"Description\": \"warning_description\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(190, 16, 'pl', 'Employee Warning', '<p>Temat: -Dział HR/Firma do wysyłania listu ostrzegawczego.</p>\n                    <p>Szanowny {employee_warning_name },</p>\n                    <p>{warning_subject }</p>\n                    <p>{warning_description }</p>\n                    <p>Czuj się swobodnie, jeśli masz jakieś pytania.</p>\n                    <p>Dziękujemy</p>\n                    <p>W odniesieniu do</p>\n                    <p>Dział HR,</p>\n                    <p>{app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"Subject\": \"warning_subject\", \"App Name\": \"app_name\", \"Employee\": \"employee_warning_name\", \"Description\": \"warning_description\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(191, 16, 'ru', 'Employee Warning', '<p>Тема: -HR отдел/Компания для отправки предупреждающего письма.</p>\n                    <p>Уважаемый { employee_warning_name },</p>\n                    <p>{ warning_subject }</p>\n                    <p>{ warning_description }</p>\n                    <p>Не стеснитесь, если у вас есть вопросы.</p>\n                    <p>Спасибо.</p>\n                    <p>С уважением,</p>\n                    <p>Отдел кадров,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"Subject\": \"warning_subject\", \"App Name\": \"app_name\", \"Employee\": \"employee_warning_name\", \"Description\": \"warning_description\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(192, 16, 'pt', 'Employee Warning', '<p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Assunto:-Departamento de RH / Empresa para enviar carta de advert&ecirc;ncia.</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Querido {employee_warning_name},</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">{warning_subject}</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">{warning_description}</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Sinta-se &agrave; vontade para alcan&ccedil;ar fora se voc&ecirc; tiver alguma d&uacute;vida.</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Obrigado</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Considera,</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">Departamento de RH,</span></p>\n                    <p style=\"font-size: 14.4px;\"><span style=\"font-size: 14.4px;\">{app_name}</span></p>', NULL, '{\"App Url\": \"app_url\", \"Subject\": \"warning_subject\", \"App Name\": \"app_name\", \"Employee\": \"employee_warning_name\", \"Description\": \"warning_description\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(193, 17, 'ar', 'Employee Termination', '<p style=\"text-align: left;\"><span style=\"font-size: 12pt;\"><span style=\"color: #222222;\"><span style=\"white-space: pre-wrap;\"><span style=\"font-size: 12pt; white-space: pre-wrap;\">Subject :-ادارة / شركة HR لارسال رسالة انهاء. عزيزي { </span><span style=\"white-space: pre-wrap;\">employee_termination_name</span><span style=\"font-size: 12pt; white-space: pre-wrap;\"> } ، هذه الرسالة مكتوبة لإعلامك بأن عملك مع شركتنا قد تم إنهاؤه مزيد من التفاصيل عن الانهاء : تاريخ الاشعار : { </span><span style=\"white-space: pre-wrap;\">notice_date</span><span style=\"font-size: 12pt; white-space: pre-wrap;\"> } تاريخ الانهاء : { </span><span style=\"white-space: pre-wrap;\">termination_date</span><span style=\"font-size: 12pt; white-space: pre-wrap;\"> } نوع الانهاء : { termination_type } إشعر بالحرية للوصول إلى الخارج إذا عندك أي أسئلة. شكرا لك Regards, إدارة الموارد البشرية ، { app_name }</span></span></span></span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_termination_name\", \"Notice Date\": \"notice_date\", \"Company Name\": \"company_name\", \"Termination Date\": \"termination_date\", \"Termination Type\": \"termination_type\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(194, 17, 'da', 'Employee Termination', '<p>Emne:-HR-afdelingen / Virksomheden om at sende afslutningstskrivelse.</p>\n                    <p>K&aelig;re { employee_termination_name },</p>\n                    <p>Dette brev er skrevet for at meddele dig, at dit arbejde med vores virksomhed er afsluttet.</p>\n                    <p>Flere oplysninger om oph&aelig;velse:</p>\n                    <p>Adviseringsdato: { notifice_date }</p>\n                    <p>Opsigelsesdato: { termination_date }</p>\n                    <p>Opsigelsestype: { termination_type }</p>\n                    <p>Du er velkommen til at r&aelig;kke ud, hvis du har nogen sp&oslash;rgsm&aring;l.</p>\n                    <p>Tak.</p>\n                    <p>Med venlig hilsen</p>\n                    <p>HR-afdelingen,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_termination_name\", \"Notice Date\": \"notice_date\", \"Company Name\": \"company_name\", \"Termination Date\": \"termination_date\", \"Termination Type\": \"termination_type\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(195, 17, 'de', 'Employee Termination', '<p>Betreff: -Personalabteilung/Firma zum Versenden von K&uuml;ndigungsschreiben.</p>\n                    <p>Sehr geehrter {employee_termination_name},</p>\n                    <p>Dieser Brief wird Ihnen schriftlich mitgeteilt, dass Ihre Besch&auml;ftigung mit unserem Unternehmen beendet ist.</p>\n                    <p>Weitere Details zur K&uuml;ndigung:</p>\n                    <p>K&uuml;ndigungsdatum: {notice_date}</p>\n                    <p>Beendigungsdatum: {termination_date}</p>\n                    <p>Abbruchstyp: {termination_type}</p>\n                    <p>F&uuml;hlen Sie sich frei, wenn Sie Fragen haben.</p>\n                    <p>Danke.</p>\n                    <p>Betrachtet,</p>\n                    <p>Personalabteilung,</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_termination_name\", \"Notice Date\": \"notice_date\", \"Company Name\": \"company_name\", \"Termination Date\": \"termination_date\", \"Termination Type\": \"termination_type\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(196, 17, 'en', 'Employee Termination', '<p><strong>Subject:-HR department/Company to send termination letter.</strong></p>\n                    <p><strong>Dear {employee_termination_name},</strong></p>\n                    <p>This letter is written to notify you that your employment with our company is terminated.</p>\n                    <p>More detail about termination:</p>\n                    <p>Notice Date :{notice_date}</p>\n                    <p>Termination Date:{termination_date}</p>\n                    <p>Termination Type:{termination_type}</p>\n                    <p>&nbsp;</p>\n                    <p>Feel free to reach out if you have any questions.</p>\n                    <p>Thank you</p>\n                    <p><strong>Regards,</strong></p>\n                    <p><strong>HR Department,</strong></p>\n                    <p><strong>{app_name}</strong></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_termination_name\", \"Notice Date\": \"notice_date\", \"Company Name\": \"company_name\", \"Termination Date\": \"termination_date\", \"Termination Type\": \"termination_type\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06');
INSERT INTO `email_template_langs` (`id`, `parent_id`, `lang`, `subject`, `content`, `module_name`, `variables`, `created_at`, `updated_at`) VALUES
(197, 17, 'es', 'Employee Termination', '<p>Asunto: -Departamento de RRHH/Empresa para enviar carta de rescisi&oacute;n.</p>\n                    <p>Estimado {employee_termination_name},</p>\n                    <p>Esta carta est&aacute; escrita para notificarle que su empleo con nuestra empresa ha terminado.</p>\n                    <p>M&aacute;s detalles sobre la terminaci&oacute;n:</p>\n                    <p>Fecha de aviso: {notice_date}</p>\n                    <p>Fecha de terminaci&oacute;n: {termination_date}</p>\n                    <p>Tipo de terminaci&oacute;n: {termination_type}</p>\n                    <p>Si&eacute;ntase libre de llegar si usted tiene alguna pregunta.</p>\n                    <p>&iexcl;Gracias!</p>\n                    <p>Considerando,</p>\n                    <p>Departamento de Recursos Humanos,</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_termination_name\", \"Notice Date\": \"notice_date\", \"Company Name\": \"company_name\", \"Termination Date\": \"termination_date\", \"Termination Type\": \"termination_type\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(198, 17, 'fr', 'Employee Termination', '<p>Objet: -HR department / Company to send termination letter.</p>\n                    <p>Cher { employee_termination_name },</p>\n                    <p>Cette lettre est r&eacute;dig&eacute;e pour vous aviser que votre emploi aupr&egrave;s de notre entreprise prend fin.</p>\n                    <p>Plus de d&eacute;tails sur larr&ecirc;t:</p>\n                    <p>Date de lavis: { notice_date }</p>\n                    <p>Date de fin: { termination_date}</p>\n                    <p>Type de terminaison: { termination_type }</p>\n                    <p>Nh&eacute;sitez pas &agrave; nous contacter si vous avez des questions.</p>\n                    <p>Je vous remercie</p>\n                    <p>Regards,</p>\n                    <p>D&eacute;partement des RH,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_termination_name\", \"Notice Date\": \"notice_date\", \"Company Name\": \"company_name\", \"Termination Date\": \"termination_date\", \"Termination Type\": \"termination_type\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(199, 17, 'it', 'Employee Termination', '<p>Oggetto: - Dipartimento HR / Societ&agrave; per inviare lettera di terminazione.</p>\n                    <p>Caro {employee_termination_name},</p>\n                    <p>Questa lettera &egrave; scritta per comunicarti che la tua occupazione con la nostra azienda &egrave; terminata.</p>\n                    <p>Pi&ugrave; dettagli sulla cessazione:</p>\n                    <p>Data avviso: {notice_data}</p>\n                    <p>Data di chiusura: {termination_date}</p>\n                    <p>Tipo di terminazione: {termination_type}</p>\n                    <p>Sentiti libero di raggiungere se hai domande.</p>\n                    <p>Grazie</p>\n                    <p>Riguardo,</p>\n                    <p>Dipartimento HR,</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_termination_name\", \"Notice Date\": \"notice_date\", \"Company Name\": \"company_name\", \"Termination Date\": \"termination_date\", \"Termination Type\": \"termination_type\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(200, 17, 'ja', 'Employee Termination', '<p>件名:-HR 部門/企業は終了文字を送信します。</p>\n                    <p>{ employee_termination_name} を終了します。</p>\n                    <p>この手紙は、当社の雇用が終了していることをあなたに通知するために書かれています。</p>\n                    <p>終了についての詳細 :</p>\n                    <p>通知日 :{notice_date}</p>\n                    <p>終了日:{termination_date}</p>\n                    <p>終了タイプ:{termination_type}</p>\n                    <p>質問がある場合は、自由に連絡してください。</p>\n                    <p>ありがとう</p>\n                    <p>よろしく</p>\n                    <p>HR 部門</p>\n                    <p>{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_termination_name\", \"Notice Date\": \"notice_date\", \"Company Name\": \"company_name\", \"Termination Date\": \"termination_date\", \"Termination Type\": \"termination_type\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(201, 17, 'nl', 'Employee Termination', '<p>Betreft: -HR-afdeling/Bedrijf voor verzending van afgiftebrief.</p>\n                    <p>Geachte { employee_termination_name },</p>\n                    <p>Deze brief is geschreven om u te melden dat uw werk met ons bedrijf wordt be&euml;indigd.</p>\n                    <p>Meer details over be&euml;indiging:</p>\n                    <p>Datum kennisgeving: { notice_date }</p>\n                    <p>Be&euml;indigingsdatum: { termination_date }</p>\n                    <p>Be&euml;indigingstype: { termination_type }</p>\n                    <p>Voel je vrij om uit te reiken als je vragen hebt.</p>\n                    <p>Dank u wel</p>\n                    <p>Betreft:</p>\n                    <p>HR-afdeling,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_termination_name\", \"Notice Date\": \"notice_date\", \"Company Name\": \"company_name\", \"Termination Date\": \"termination_date\", \"Termination Type\": \"termination_type\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(202, 17, 'pl', 'Employee Termination', '<p>Temat: -Dział kadr/Firma do wysyłania listu zakańczego.</p>\n                    <p>Droga {employee_termination_name },</p>\n                    <p>Ten list jest napisany, aby poinformować Cię, że Twoje zatrudnienie z naszą firmą zostaje zakończone.</p>\n                    <p>Więcej szczeg&oacute;ł&oacute;w na temat zakończenia pracy:</p>\n                    <p>Data ogłoszenia: {notice_date }</p>\n                    <p>Data zakończenia: {termination_date }</p>\n                    <p>Typ zakończenia: {termination_type }</p>\n                    <p>Czuj się swobodnie, jeśli masz jakieś pytania.</p>\n                    <p>Dziękujemy</p>\n                    <p>W odniesieniu do</p>\n                    <p>Dział HR,</p>\n                    <p>{app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_termination_name\", \"Notice Date\": \"notice_date\", \"Company Name\": \"company_name\", \"Termination Date\": \"termination_date\", \"Termination Type\": \"termination_type\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(203, 17, 'ru', 'Employee Termination', '<p>Тема: -HR отдел/Компания отправить письмо о прекращении.</p>\n                    <p>Уважаемый { employee_termination_name },</p>\n                    <p>Это письмо написано, чтобы уведомить вас о том, что ваше трудоустройство с нашей компанией прекратилось.</p>\n                    <p>Более подробная информация о завершении:</p>\n                    <p>Дата уведомления: { notice_date }</p>\n                    <p>Дата завершения: { termination_date }</p>\n                    <p>Тип завершения: { termination_type }</p>\n                    <p>Не стеснитесь, если у вас есть вопросы.</p>\n                    <p>Спасибо.</p>\n                    <p>С уважением,</p>\n                    <p>Отдел кадров,</p>\n                    <p>{ app_name }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_termination_name\", \"Notice Date\": \"notice_date\", \"Company Name\": \"company_name\", \"Termination Date\": \"termination_date\", \"Termination Type\": \"termination_type\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(204, 17, 'pt', 'Employee Termination', '<p style=\"font-size: 14.4px;\">Assunto:-Departamento de RH / Empresa para enviar carta de rescis&atilde;o.</p>\n                    <p style=\"font-size: 14.4px;\">Querido {employee_termination_name},</p>\n                    <p style=\"font-size: 14.4px;\">Esta carta &eacute; escrita para notific&aacute;-lo de que seu emprego com a nossa empresa est&aacute; finalizado.</p>\n                    <p style=\"font-size: 14.4px;\">Mais detalhes sobre a finaliza&ccedil;&atilde;o:</p>\n                    <p style=\"font-size: 14.4px;\">Data de Aviso: {notice_date}</p>\n                    <p style=\"font-size: 14.4px;\">Data de Finaliza&ccedil;&atilde;o: {termination_date}</p>\n                    <p style=\"font-size: 14.4px;\">Tipo de Rescis&atilde;o: {termination_type}</p>\n                    <p style=\"font-size: 14.4px;\">Sinta-se &agrave; vontade para alcan&ccedil;ar fora se voc&ecirc; tiver alguma d&uacute;vida.</p>\n                    <p style=\"font-size: 14.4px;\">Obrigado</p>\n                    <p style=\"font-size: 14.4px;\">Considera,</p>\n                    <p style=\"font-size: 14.4px;\">Departamento de RH,</p>\n                    <p style=\"font-size: 14.4px;\">{app_name}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"employee_termination_name\", \"Notice Date\": \"notice_date\", \"Company Name\": \"company_name\", \"Termination Date\": \"termination_date\", \"Termination Type\": \"termination_type\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(205, 18, 'ar', 'New Payroll', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Subject :-إدارة الموارد البشرية / الشركة المعنية بإرسال المدفوعات عن طريق البريد الإلكتروني في وقت تأكيد الدفع.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">مرحبا {name} ،</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">أتمنى أن يجدك هذا البريد الإلكتروني جيدا برجاء الرجوع الى الدفع المتصل الى { salary_month&nbsp;}.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">اضغط ببساطة على الاختيار بأسفل</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">كشوف المرتبات</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">إشعر بالحرية للوصول إلى الخارج إذا عندك أي أسئلة.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">شكرا لك</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Regards,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">إدارة الموارد البشرية ،</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{ app_name }</span></p>', NULL, '{\"URL\": \"url\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"name\", \"Company Name\": \"company_name\", \"Salary Month\": \"salary_month\", \"Employee Email\": \"payslip_email\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(206, 18, 'da', 'New Payroll', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Om: HR-departementet / Kompagniet til at sende l&oslash;nsedler via e-mail p&aring; tidspunktet for bekr&aelig;ftelsen af l&oslash;nsedlerne</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Hej {name},</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">H&aring;ber denne e-mail finder dig godt! Se vedh&aelig;ftet payseddel for { salary_month }.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">klik bare p&aring; knappen nedenfor</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">L&oslash;nseddel</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Du er velkommen til at r&aelig;kke ud, hvis du har nogen sp&oslash;rgsm&aring;l.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Tak.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Med venlig hilsen</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">HR-afdelingen,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{ app_name }</span></p>', NULL, '{\"URL\": \"url\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"name\", \"Company Name\": \"company_name\", \"Salary Month\": \"salary_month\", \"Employee Email\": \"payslip_email\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(207, 18, 'de', 'New Payroll', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Betrifft: -Personalabteilung/Firma, um Payslips per E-Mail zum Zeitpunkt der Best&auml;tigung des Auszahlungsscheins zu senden</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Hi {name},</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Hoffe, diese E-Mail findet dich gut! Bitte sehen Sie den angeh&auml;ngten payslip f&uuml;r {salary_month}.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Klicken Sie einfach auf den Button unten</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Payslip</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">F&uuml;hlen Sie sich frei, wenn Sie Fragen haben.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Danke.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Betrachtet,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Personalabteilung,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_name}</span></p>', NULL, '{\"URL\": \"url\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"name\", \"Company Name\": \"company_name\", \"Salary Month\": \"salary_month\", \"Employee Email\": \"payslip_email\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(208, 18, 'en', 'New Payroll', '<p><strong>Subjec</strong>t:-HR department/Company to send payslips by email at time of confirmation of payslip</p>\n                    <p>Hi {name},</p>\n                    <p>Hope this email ﬁnds you well! Please see attached payslip for {salary_month}.</p>\n                    <p style=\"text-align: center;\" align=\"center\"><strong>simply click on the button below </strong></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Payslip</strong> </a></span></p>\n                    <p style=\"text-align: left;\" align=\"center\">Feel free to reach out if you have any questions.</p>\n                    <p>Thank you</p>\n                    <p><strong>Regards,</strong></p>\n                    <p><strong>HR Department,</strong></p>\n                    <p><span style=\"color: #000000; font-family: \"Open Sans\", sans-serif; font-size: 14px; background-color: #ffffff;\">{<strong>app_name</strong>}</span></p>', NULL, '{\"URL\": \"url\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"name\", \"Company Name\": \"company_name\", \"Salary Month\": \"salary_month\", \"Employee Email\": \"payslip_email\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(209, 18, 'es', 'New Payroll', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Asunto: -Departamento de RRHH/Empresa para enviar n&oacute;minas por correo electr&oacute;nico en el momento de la confirmaci&oacute;n del pago</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Hi {name},</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">&iexcl;Espero que este email le encuentre bien! Consulte la ficha de pago adjunta para {salary_month}.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">simplemente haga clic en el bot&oacute;n de abajo</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Payslip</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Si&eacute;ntase libre de llegar si usted tiene alguna pregunta.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">&iexcl;Gracias!</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Considerando,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Departamento de Recursos Humanos,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_name}</span></p>', NULL, '{\"URL\": \"url\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"name\", \"Company Name\": \"company_name\", \"Salary Month\": \"salary_month\", \"Employee Email\": \"payslip_email\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(210, 18, 'fr', 'New Payroll', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Objet: -Ressources humaines / Entreprise pour envoyer des feuillets de paie par courriel au moment de la confirmation du paiement</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Salut {name},</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Jesp&egrave;re que ce courriel vous trouve bien ! Veuillez consulter le bordereau de paie ci-joint pour {salary_month}.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Il suffit de cliquer sur le bouton ci-dessous</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Feuillet de paiement</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Nh&eacute;sitez pas &agrave; nous contacter si vous avez des questions.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Je vous remercie</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Regards,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">D&eacute;partement des RH,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_name}</span></p>', NULL, '{\"URL\": \"url\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"name\", \"Company Name\": \"company_name\", \"Salary Month\": \"salary_month\", \"Employee Email\": \"payslip_email\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(211, 18, 'it', 'New Payroll', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Oggetto: - Dipartimento HR / Societ&agrave; per inviare busta paga via email al momento della conferma della busta paga</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Ciao {name},</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Spero che questa email ti trovi bene! Si prega di consultare la busta paga per {salary_month}.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">semplicemente clicca sul pulsante sottostante</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Busta paga</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Sentiti libero di raggiungere se hai domande.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Grazie</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Riguardo,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Dipartimento HR,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_name}</span></p>', NULL, '{\"URL\": \"url\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"name\", \"Company Name\": \"company_name\", \"Salary Month\": \"salary_month\", \"Employee Email\": \"payslip_email\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(212, 18, 'ja', 'New Payroll', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">件名:-HR 部門/企業は、給与明細書の確認時に電子メールで支払いを送信します。</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">こんにちは {name}、</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">この E メールでよくご確認ください。 {salary_month}の添付された payslip を参照してください。</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">下のボタンをクリックするだけで</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">給与明細書</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">質問がある場合は、自由に連絡してください。</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">ありがとう</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">よろしく</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">HR 部門</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_name}</span></p>', NULL, '{\"URL\": \"url\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"name\", \"Company Name\": \"company_name\", \"Salary Month\": \"salary_month\", \"Employee Email\": \"payslip_email\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(213, 18, 'nl', 'New Payroll', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Betreft: -HR-afdeling/Bedrijf om te betalen payslips per e-mail op het moment van bevestiging van de payslip</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Hallo {name},</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Hoop dat deze e-mail je goed vindt! Zie bijgevoegde payslip voor { salary_month }.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">gewoon klikken op de knop hieronder</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Loonstrook</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Voel je vrij om uit te reiken als je vragen hebt.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Dank u wel</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Betreft:</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">HR-afdeling,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{ app_name }</span></p>', NULL, '{\"URL\": \"url\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"name\", \"Company Name\": \"company_name\", \"Salary Month\": \"salary_month\", \"Employee Email\": \"payslip_email\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(214, 18, 'pl', 'New Payroll', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Temat:-Dział HR/Firma do wysyłania payslip&oacute;w drogą mailową w czasie potwierdzania payslipa</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Witaj {name },</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Mam nadzieję, że ta wiadomość znajdzie Cię dobrze! Patrz załączony payslip dla {salary_month }.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">po prostu kliknij na przycisk poniżej</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Payslip</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Czuj się swobodnie, jeśli masz jakieś pytania.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Dziękujemy</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">W odniesieniu do</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Dział HR,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_name }</span></p>', NULL, '{\"URL\": \"url\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"name\", \"Company Name\": \"company_name\", \"Salary Month\": \"salary_month\", \"Employee Email\": \"payslip_email\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(215, 18, 'ru', 'New Payroll', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Тема: -HR отдел/Компания для отправки паузу по электронной почте во время подтверждения паузли</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Привет {name},</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Надеюсь, это электронное письмо найдет вас хорошо! См. вложенный раздел для { salary_month }.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">просто нажмите на кнопку внизу</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Паушлип</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Не стеснитесь, если у вас есть вопросы.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Спасибо.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">С уважением,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Отдел кадров,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{ app_name }</span></p>', NULL, '{\"URL\": \"url\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"name\", \"Company Name\": \"company_name\", \"Salary Month\": \"salary_month\", \"Employee Email\": \"payslip_email\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(216, 18, 'pt', 'New Payroll', '<p>Assunto:-Departamento de RH / Empresa para enviar payslips por e-mail no momento da confirma&ccedil;&atilde;o do payslip</p>\n                    <p>Oi {name},</p>\n                    <p>Espero que este e-mail encontre voc&ecirc; bem! Por favor, consulte o payslip anexado por {salary_month}.</p>\n                    <p>basta clicar no bot&atilde;o abaixo</p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Payslip</strong> </a></span></p>\n                    <p>Sinta-se &agrave; vontade para alcan&ccedil;ar fora se voc&ecirc; tiver alguma d&uacute;vida.</p>\n                    <p>Obrigado</p>\n                    <p>Considera,</p>\n                    <p>Departamento de RH,</p>\n                    <p>{app_name}</p>', NULL, '{\"URL\": \"url\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Employee\": \"name\", \"Company Name\": \"company_name\", \"Salary Month\": \"salary_month\", \"Employee Email\": \"payslip_email\"}', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(217, 19, 'ar', 'New Deal Assign', '<p><span style=\"font-family: sans-serif;\">مرحبا،</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">تم تعيين صفقة جديدة لك.</span></p><p><span style=\"font-family: sans-serif;\"><b>اسم الصفقة</b> : {deal_name}<br><b>خط أنابيب الصفقة</b> : {deal_pipeline}<br><b>مرحلة الصفقة</b> : {deal_stage}<br><b>حالة الصفقة</b> : {deal_status}<br><b>سعر الصفقة</b> : {deal_price}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Deal Name\": \"deal_name\", \"Deal Price\": \"deal_price\", \"Deal Stage\": \"deal_stage\", \"Deal Status\": \"deal_status\", \"Company Name \": \"company_name\", \"Deal Pipeline\": \"deal_pipeline\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(218, 19, 'da', 'New Deal Assign', '<p><span style=\"font-family: sans-serif;\">Hej,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">New Deal er blevet tildelt til dig.</span></p><p><span style=\"font-family: sans-serif;\"><b>Deal Navn</b> : {deal_name}<br><b>Deal Pipeline</b> : {deal_pipeline}<br><b>Deal Fase</b> : {deal_stage}<br><b>Deal status</b> : {deal_status}<br><b>Deal pris</b> : {deal_price}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Deal Name\": \"deal_name\", \"Deal Price\": \"deal_price\", \"Deal Stage\": \"deal_stage\", \"Deal Status\": \"deal_status\", \"Company Name \": \"company_name\", \"Deal Pipeline\": \"deal_pipeline\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(219, 19, 'de', 'New Deal Assign', '<p><span style=\"font-family: sans-serif;\">Hallo,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">New Deal wurde Ihnen zugewiesen.</span></p><p><span style=\"font-family: sans-serif;\"><b>Geschäftsname</b> : {deal_name}<br><b>Deal Pipeline</b> : {deal_pipeline}<br><b>Deal Stage</b> : {deal_stage}<br><b>Deal Status</b> : {deal_status}<br><b>Ausgehandelter Preis</b> : {deal_price}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Deal Name\": \"deal_name\", \"Deal Price\": \"deal_price\", \"Deal Stage\": \"deal_stage\", \"Deal Status\": \"deal_status\", \"Company Name \": \"company_name\", \"Deal Pipeline\": \"deal_pipeline\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(220, 19, 'en', 'New Deal Assign', '<p><span style=\"font-family: sans-serif;\">Hello,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">New Deal has been Assign to you.</span></p><p><span style=\"font-family: sans-serif;\"><b>Deal Name</b> : {deal_name}<br><b>Deal Pipeline</b> : {deal_pipeline}<br><b>Deal Stage</b> : {deal_stage}<br><b>Deal Status</b> : {deal_status}<br><b>Deal Price</b> : {deal_price}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Deal Name\": \"deal_name\", \"Deal Price\": \"deal_price\", \"Deal Stage\": \"deal_stage\", \"Deal Status\": \"deal_status\", \"Company Name \": \"company_name\", \"Deal Pipeline\": \"deal_pipeline\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(221, 19, 'es', 'New Deal Assign', '<p><span style=\"font-family: sans-serif;\">Hola,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">New Deal ha sido asignado a usted.</span></p><p><span style=\"font-family: sans-serif;\"><b>Nombre del trato</b> : {deal_name}<br><b>Tubería de reparto</b> : {deal_pipeline}<br><b>Etapa de reparto</b> : {deal_stage}<br><b>Estado del acuerdo</b> : {deal_status}<br><b>Precio de oferta</b> : {deal_price}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Deal Name\": \"deal_name\", \"Deal Price\": \"deal_price\", \"Deal Stage\": \"deal_stage\", \"Deal Status\": \"deal_status\", \"Company Name \": \"company_name\", \"Deal Pipeline\": \"deal_pipeline\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(222, 19, 'fr', 'New Deal Assign', '<p><span style=\"font-family: sans-serif;\">Bonjour,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Le New Deal vous a été attribué.</span></p><p><span style=\"font-family: sans-serif;\"><b>Nom de l`accord</b> : {deal_name}<br><b>Pipeline de transactions</b> : {deal_pipeline}<br><b>Étape de l`opération</b> : {deal_stage}<br><b>Statut de l`accord</b> : {deal_status}<br><b>Prix ​​de l  offre</b> : {deal_price}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Deal Name\": \"deal_name\", \"Deal Price\": \"deal_price\", \"Deal Stage\": \"deal_stage\", \"Deal Status\": \"deal_status\", \"Company Name \": \"company_name\", \"Deal Pipeline\": \"deal_pipeline\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(223, 19, 'it', 'New Deal Assign', '<p><span style=\"font-family: sans-serif;\">Ciao,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">New Deal è stato assegnato a te.</span></p><p><span style=\"font-family: sans-serif;\"><b>Nome dell`affare</b> : {deal_name}<br><b>Pipeline di offerte</b> : {deal_pipeline}<br><b>Stage Deal</b> : {deal_stage}<br><b>Stato dell`affare</b> : {deal_status}<br><b>Prezzo dell`offerta</b> : {deal_price}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Deal Name\": \"deal_name\", \"Deal Price\": \"deal_price\", \"Deal Stage\": \"deal_stage\", \"Deal Status\": \"deal_status\", \"Company Name \": \"company_name\", \"Deal Pipeline\": \"deal_pipeline\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(224, 19, 'ja', 'New Deal Assign', '<p><span style=\"font-family: sans-serif;\">こんにちは、</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">新しい取引が割り当てられました。</span></p><p><span style=\"font-family: sans-serif;\"><b>取引名</b> : {deal_name}<br><b>取引パイプライン</b> : {deal_pipeline}<br><b>取引ステージ</b> : {deal_stage}<br><b>取引状況</b> : {deal_status}<br><b>取引価格</b> : {deal_price}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Deal Name\": \"deal_name\", \"Deal Price\": \"deal_price\", \"Deal Stage\": \"deal_stage\", \"Deal Status\": \"deal_status\", \"Company Name \": \"company_name\", \"Deal Pipeline\": \"deal_pipeline\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(225, 19, 'nl', 'New Deal Assign', '<p><span style=\"font-family: sans-serif;\">Hallo,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">New Deal is aan u toegewezen.</span></p><p><span style=\"font-family: sans-serif;\"><b>Dealnaam</b> : {deal_name}<br><b>Deal Pipeline</b> : {deal_pipeline}<br><b>Deal Stage</b> : {deal_stage}<br><b>Dealstatus</b> : {deal_status}<br><b>Deal prijs</b> : {deal_price}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Deal Name\": \"deal_name\", \"Deal Price\": \"deal_price\", \"Deal Stage\": \"deal_stage\", \"Deal Status\": \"deal_status\", \"Company Name \": \"company_name\", \"Deal Pipeline\": \"deal_pipeline\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(226, 19, 'pl', 'New Deal Assign', '<p><span style=\"font-family: sans-serif;\">Witaj,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Nowa oferta została Ci przypisana.</span></p><p><span style=\"font-family: sans-serif;\"><b>Nazwa oferty</b> : {deal_name}<br><b>Deal Pipeline</b> : {deal_pipeline}<br><b>Etap transakcji</b> : {deal_stage}<br><b>Status oferty</b> : {deal_status}<br><b>Cena oferty</b> : {deal_price}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Deal Name\": \"deal_name\", \"Deal Price\": \"deal_price\", \"Deal Stage\": \"deal_stage\", \"Deal Status\": \"deal_status\", \"Company Name \": \"company_name\", \"Deal Pipeline\": \"deal_pipeline\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(227, 19, 'ru', 'New Deal Assign', '<p><span style=\"font-family: sans-serif;\">Привет,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Новый курс был назначен вам.</span></p><p><span style=\"font-family: sans-serif;\"><b>Название сделки</b> : {deal_name}<br><b>Трубопровод сделки</b> : {deal_pipeline}<br><b>Этап сделки</b> : {deal_stage}<br><b>Статус сделки</b> : {deal_status}<br><b>Цена сделки</b> : {deal_price}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Deal Name\": \"deal_name\", \"Deal Price\": \"deal_price\", \"Deal Stage\": \"deal_stage\", \"Deal Status\": \"deal_status\", \"Company Name \": \"company_name\", \"Deal Pipeline\": \"deal_pipeline\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(228, 19, 'pt', 'New Deal Assign', '<p><span style=\"font-family: sans-serif;\">Hello,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">New Deal has been Assign to you.</span></p><p><span style=\"font-family: sans-serif;\"><b>Deal Name</b> : {deal_name}<br><b>Deal Pipeline</b> : {deal_pipeline}<br><b>Deal Stage</b> : {deal_stage}<br><b>Deal Status</b> : {deal_status}<br><b>Deal Price</b> : {deal_price}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Deal Name\": \"deal_name\", \"Deal Price\": \"deal_price\", \"Deal Stage\": \"deal_stage\", \"Deal Status\": \"deal_status\", \"Company Name \": \"company_name\", \"Deal Pipeline\": \"deal_pipeline\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(229, 20, 'ar', 'Deal has been Moved', '<p><span style=\"font-family: sans-serif;\">مرحبا،</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">تم نقل صفقة من {deal_old_stage} إلى&nbsp; {deal_new_stage}.</span></p><p><span style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder;\">اسم الصفقة</span>&nbsp;: {deal_name}<br><span style=\"font-weight: bolder;\">خط أنابيب الصفقة</span>&nbsp;: {deal_pipeline}<br><span style=\"font-weight: bolder;\">مرحلة الصفقة</span>&nbsp;: {deal_stage}<br><span style=\"font-weight: bolder;\">حالة الصفقة</span>&nbsp;: {deal_status}<br><span style=\"font-weight: bolder;\">سعر الصفقة</span>&nbsp;: {deal_price}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Deal Name\": \"deal_name\", \"Deal Price\": \"deal_price\", \"Deal Stage\": \"deal_stage\", \"Deal Status\": \"deal_status\", \"Company Name \": \"company_name\", \"Deal Pipeline\": \"deal_pipeline\", \"Deal New Stage\": \"deal_new_stage\", \"Deal Old Stage\": \"deal_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(230, 20, 'da', 'Deal has been Moved', '<p><span style=\"font-family: sans-serif;\">Hej,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">En aftale er flyttet fra {deal_old_stage} til&nbsp; {deal_new_stage}.</span></p><p><span style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder;\">Deal Navn</span>&nbsp;: {deal_name}<br><span style=\"font-weight: bolder;\">Deal Pipeline</span>&nbsp;: {deal_pipeline}<br><span style=\"font-weight: bolder;\">Deal Fase</span>&nbsp;: {deal_stage}<br><span style=\"font-weight: bolder;\">Deal status</span>&nbsp;: {deal_status}<br><span style=\"font-weight: bolder;\">Deal pris</span>&nbsp;: {deal_price}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Deal Name\": \"deal_name\", \"Deal Price\": \"deal_price\", \"Deal Stage\": \"deal_stage\", \"Deal Status\": \"deal_status\", \"Company Name \": \"company_name\", \"Deal Pipeline\": \"deal_pipeline\", \"Deal New Stage\": \"deal_new_stage\", \"Deal Old Stage\": \"deal_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(231, 20, 'de', 'Deal has been Moved', '<p><span style=\"font-family: sans-serif;\">Hallo,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Ein Deal wurde verschoben {deal_old_stage} zu&nbsp; {deal_new_stage}.</span></p><p><span style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder;\">Geschäftsname</span>&nbsp;: {deal_name}<br><span style=\"font-weight: bolder;\">Deal Pipeline</span>&nbsp;: {deal_pipeline}<br><span style=\"font-weight: bolder;\">Deal Stage</span>&nbsp;: {deal_stage}<br><span style=\"font-weight: bolder;\">Deal Status</span>&nbsp;: {deal_status}<br><span style=\"font-weight: bolder;\">Ausgehandelter Preis</span>&nbsp;: {deal_price}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Deal Name\": \"deal_name\", \"Deal Price\": \"deal_price\", \"Deal Stage\": \"deal_stage\", \"Deal Status\": \"deal_status\", \"Company Name \": \"company_name\", \"Deal Pipeline\": \"deal_pipeline\", \"Deal New Stage\": \"deal_new_stage\", \"Deal Old Stage\": \"deal_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(232, 20, 'en', 'Deal has been Moved', '<p><span style=\"font-family: sans-serif;\">Hello,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">A Deal has been move from {deal_old_stage} to&nbsp; {deal_new_stage}.</span></p><p><span style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder;\">Deal Name</span>&nbsp;: {deal_name}<br><span style=\"font-weight: bolder;\">Deal Pipeline</span>&nbsp;: {deal_pipeline}<br><span style=\"font-weight: bolder;\">Deal Stage</span>&nbsp;: {deal_stage}<br><span style=\"font-weight: bolder;\">Deal Status</span>&nbsp;: {deal_status}<br><span style=\"font-weight: bolder;\">Deal Price</span>&nbsp;: {deal_price}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Deal Name\": \"deal_name\", \"Deal Price\": \"deal_price\", \"Deal Stage\": \"deal_stage\", \"Deal Status\": \"deal_status\", \"Company Name \": \"company_name\", \"Deal Pipeline\": \"deal_pipeline\", \"Deal New Stage\": \"deal_new_stage\", \"Deal Old Stage\": \"deal_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26');
INSERT INTO `email_template_langs` (`id`, `parent_id`, `lang`, `subject`, `content`, `module_name`, `variables`, `created_at`, `updated_at`) VALUES
(233, 20, 'es', 'Deal has been Moved', '<p><span style=\"font-family: sans-serif;\">Hola,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Se ha movido un acuerdo de {deal_old_stage} a&nbsp; {deal_new_stage}.</span></p><p><span style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder;\">Nombre del trato</span>&nbsp;: {deal_name}<br><span style=\"font-weight: bolder;\">Tubería de reparto</span>&nbsp;: {deal_pipeline}<br><span style=\"font-weight: bolder;\">Etapa de reparto</span>&nbsp;: {deal_stage}<br><span style=\"font-weight: bolder;\">Estado del acuerdo</span>&nbsp;: {deal_status}<br><span style=\"font-weight: bolder;\">Precio de oferta</span>&nbsp;: {deal_price}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Deal Name\": \"deal_name\", \"Deal Price\": \"deal_price\", \"Deal Stage\": \"deal_stage\", \"Deal Status\": \"deal_status\", \"Company Name \": \"company_name\", \"Deal Pipeline\": \"deal_pipeline\", \"Deal New Stage\": \"deal_new_stage\", \"Deal Old Stage\": \"deal_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(234, 20, 'fr', 'Deal has been Moved', '<p><span style=\"font-family: sans-serif;\">Bonjour,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Un accord a été déplacé de {deal_old_stage} à&nbsp; {deal_new_stage}.</span></p><p><span style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder;\">Nom de l`accord</span>&nbsp;: {deal_name}<br><span style=\"font-weight: bolder;\">Pipeline de transactions</span>&nbsp;: {deal_pipeline}<br><span style=\"font-weight: bolder;\">Étape de l`opération</span>&nbsp;: {deal_stage}<br><span style=\"font-weight: bolder;\">Statut de l`accord</span>&nbsp;: {deal_status}<br><span style=\"font-weight: bolder;\">Prix ​​de l`offre</span>&nbsp;: {deal_price}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Deal Name\": \"deal_name\", \"Deal Price\": \"deal_price\", \"Deal Stage\": \"deal_stage\", \"Deal Status\": \"deal_status\", \"Company Name \": \"company_name\", \"Deal Pipeline\": \"deal_pipeline\", \"Deal New Stage\": \"deal_new_stage\", \"Deal Old Stage\": \"deal_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(235, 20, 'it', 'Deal has been Moved', '<p><span style=\"font-family: sans-serif;\">Ciao,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Un affare è stato spostato da {deal_old_stage} per&nbsp; {deal_new_stage}.</span></p><p><span style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder;\">Nome dell`affare</span>&nbsp;: {deal_name}<br><span style=\"font-weight: bolder;\">Pipeline di offerte</span>&nbsp;: {deal_pipeline}<br><span style=\"font-weight: bolder;\">Stage Deal</span>&nbsp;: {deal_stage}<br><span style=\"font-weight: bolder;\">Stato dell`affare</span>&nbsp;: {deal_status}<br><span style=\"font-weight: bolder;\">Prezzo dell`offerta</span>&nbsp;: {deal_price}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Deal Name\": \"deal_name\", \"Deal Price\": \"deal_price\", \"Deal Stage\": \"deal_stage\", \"Deal Status\": \"deal_status\", \"Company Name \": \"company_name\", \"Deal Pipeline\": \"deal_pipeline\", \"Deal New Stage\": \"deal_new_stage\", \"Deal Old Stage\": \"deal_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(236, 20, 'ja', 'Deal has been Moved', '<p><span style=\"font-family: sans-serif;\">こんにちは、</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">取引は {deal_old_stage} に&nbsp; {deal_new_stage}.</span></p><p><span style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder;\">取引名</span>&nbsp;: {deal_name}<br><span style=\"font-weight: bolder;\">取引パイプライン</span>&nbsp;: {deal_pipeline}<br><span style=\"font-weight: bolder;\">取引ステージ</span>&nbsp;: {deal_stage}<br><span style=\"font-weight: bolder;\">取引状況</span>&nbsp;: {deal_status}<br><span style=\"font-weight: bolder;\">取引価格</span>&nbsp;: {deal_price}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Deal Name\": \"deal_name\", \"Deal Price\": \"deal_price\", \"Deal Stage\": \"deal_stage\", \"Deal Status\": \"deal_status\", \"Company Name \": \"company_name\", \"Deal Pipeline\": \"deal_pipeline\", \"Deal New Stage\": \"deal_new_stage\", \"Deal Old Stage\": \"deal_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(237, 20, 'nl', 'Deal has been Moved', '<p><span style=\"font-family: sans-serif;\">Hallo,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Een deal is verplaatst van {deal_old_stage} naar&nbsp; {deal_new_stage}.</span></p><p><span style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder;\">Dealnaam</span>&nbsp;: {deal_name}<br><span style=\"font-weight: bolder;\">Deal Pipeline</span>&nbsp;: {deal_pipeline}<br><span style=\"font-weight: bolder;\">Deal Stage</span>&nbsp;: {deal_stage}<br><span style=\"font-weight: bolder;\">Dealstatus</span>&nbsp;: {deal_status}<br><span style=\"font-weight: bolder;\">Deal prijs</span>&nbsp;: {deal_price}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Deal Name\": \"deal_name\", \"Deal Price\": \"deal_price\", \"Deal Stage\": \"deal_stage\", \"Deal Status\": \"deal_status\", \"Company Name \": \"company_name\", \"Deal Pipeline\": \"deal_pipeline\", \"Deal New Stage\": \"deal_new_stage\", \"Deal Old Stage\": \"deal_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(238, 20, 'pl', 'Deal has been Moved', '<p><span style=\"font-family: sans-serif;\">Witaj,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Umowa została przeniesiona {deal_old_stage} do&nbsp; {deal_new_stage}.</span></p><p><span style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder;\">Nazwa oferty</span>&nbsp;: {deal_name}<br><span style=\"font-weight: bolder;\">Deal Pipeline</span>&nbsp;: {deal_pipeline}<br><span style=\"font-weight: bolder;\">Etap transakcji</span>&nbsp;: {deal_stage}<br><span style=\"font-weight: bolder;\">Status oferty</span>&nbsp;: {deal_status}<br><span style=\"font-weight: bolder;\">Cena oferty</span>&nbsp;: {deal_price}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Deal Name\": \"deal_name\", \"Deal Price\": \"deal_price\", \"Deal Stage\": \"deal_stage\", \"Deal Status\": \"deal_status\", \"Company Name \": \"company_name\", \"Deal Pipeline\": \"deal_pipeline\", \"Deal New Stage\": \"deal_new_stage\", \"Deal Old Stage\": \"deal_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(239, 20, 'ru', 'Deal has been Moved', '<p><span style=\"font-family: sans-serif;\">Привет,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Сделка была перемещена из {deal_old_stage} в&nbsp; {deal_new_stage}.</span></p><p><span style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder;\">Название сделки</span>&nbsp;: {deal_name}<br><span style=\"font-weight: bolder;\">Трубопровод сделки</span>&nbsp;: {deal_pipeline}<br><span style=\"font-weight: bolder;\">Этап сделки</span>&nbsp;: {deal_stage}<br><span style=\"font-weight: bolder;\">Статус сделки</span>&nbsp;: {deal_status}<br><span style=\"font-weight: bolder;\">Цена сделки</span>&nbsp;: {deal_price}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Deal Name\": \"deal_name\", \"Deal Price\": \"deal_price\", \"Deal Stage\": \"deal_stage\", \"Deal Status\": \"deal_status\", \"Company Name \": \"company_name\", \"Deal Pipeline\": \"deal_pipeline\", \"Deal New Stage\": \"deal_new_stage\", \"Deal Old Stage\": \"deal_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(240, 20, 'pt', 'Deal has been Moved', '<p><span style=\"font-family: sans-serif;\">Hello,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">A Deal has been move from {deal_old_stage} to&nbsp; {deal_new_stage}.</span></p><p><span style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder;\">Deal Name</span>&nbsp;: {deal_name}<br><span style=\"font-weight: bolder;\">Deal Pipeline</span>&nbsp;: {deal_pipeline}<br><span style=\"font-weight: bolder;\">Deal Stage</span>&nbsp;: {deal_stage}<br><span style=\"font-weight: bolder;\">Deal Status</span>&nbsp;: {deal_status}<br><span style=\"font-weight: bolder;\">Deal Price</span>&nbsp;: {deal_price}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Deal Name\": \"deal_name\", \"Deal Price\": \"deal_price\", \"Deal Stage\": \"deal_stage\", \"Deal Status\": \"deal_status\", \"Company Name \": \"company_name\", \"Deal Pipeline\": \"deal_pipeline\", \"Deal New Stage\": \"deal_new_stage\", \"Deal Old Stage\": \"deal_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(241, 21, 'ar', 'New Task Assign', '<p><span style=\"font-family: sans-serif;\">مرحبا،</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">تم تعيين مهمة جديدة لك.</span></p><p><span style=\"font-family: sans-serif;\"><b>اسم المهمة</b> : {task_name}<br><b>أولوية المهمة</b> : {task_priority}<br><b>حالة المهمة</b> : {task_status}<br><b>صفقة المهمة</b> : {deal_name}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Task Name\": \"task_name\", \"Task Status\": \"task_status\", \"Company Name \": \"company_name\", \"Task Priority\": \"task_priority\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(242, 21, 'da', 'New Task Assign', '<p><span style=\"font-family: sans-serif;\">Hej,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Ny opgave er blevet tildelt til dig.</span></p><p><span style=\"font-family: sans-serif;\"><b>Opgavens navn</b> : {task_name}<br><b>Opgaveprioritet</b> : {task_priority}<br><b>Opgavestatus</b> : {task_status}<br><b>Opgave</b> : {deal_name}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Task Name\": \"task_name\", \"Task Status\": \"task_status\", \"Company Name \": \"company_name\", \"Task Priority\": \"task_priority\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(243, 21, 'de', 'New Task Assign', '<p><span style=\"font-family: sans-serif;\">Hallo,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Neue Aufgabe wurde Ihnen zugewiesen.</span></p><p><span style=\"font-family: sans-serif;\"><b>Aufgabennname</b> : {task_name}<br><b>Aufgabenpriorität</b> : {task_priority}<br><b>Aufgabenstatus</b> : {task_status}<br><b>Task Deal</b> : {deal_name}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Task Name\": \"task_name\", \"Task Status\": \"task_status\", \"Company Name \": \"company_name\", \"Task Priority\": \"task_priority\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(244, 21, 'en', 'New Task Assign', '<p><span style=\"font-family: sans-serif;\">Hello,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">New Task has been Assign to you.</span></p><p><span style=\"font-family: sans-serif;\"><b>Task Name</b> : {task_name}<br><b>Task Priority</b> : {task_priority}<br><b>Task Status</b> : {task_status}<br><b>Task Deal</b> : {deal_name}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Task Name\": \"task_name\", \"Task Status\": \"task_status\", \"Company Name \": \"company_name\", \"Task Priority\": \"task_priority\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(245, 21, 'es', 'New Task Assign', '<p><span style=\"font-family: sans-serif;\">Hola,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Nueva tarea ha sido asignada a usted.</span></p><p><span style=\"font-family: sans-serif;\"><b>Nombre de la tarea</b> : {task_name}<br><b>Prioridad de tarea</b> : {task_priority}<br><b>Estado de la tarea</b> : {task_status}<br><b>Reparto de tarea</b> : {deal_name}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Task Name\": \"task_name\", \"Task Status\": \"task_status\", \"Company Name \": \"company_name\", \"Task Priority\": \"task_priority\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(246, 21, 'fr', 'New Task Assign', '<p><span style=\"font-family: sans-serif;\">Bonjour,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Une nouvelle tâche vous a été assignée.</span></p><p><span style=\"font-family: sans-serif;\"><b>Nom de la tâche</b> : {task_name}<br><b>Priorité des tâches</b> : {task_priority}<br><b>Statut de la tâche</b> : {task_status}<br><b>Deal Task</b> : {deal_name}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Task Name\": \"task_name\", \"Task Status\": \"task_status\", \"Company Name \": \"company_name\", \"Task Priority\": \"task_priority\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(247, 21, 'it', 'New Task Assign', '<p><span style=\"font-family: sans-serif;\">Ciao,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">La nuova attività è stata assegnata a te.</span></p><p><span style=\"font-family: sans-serif;\"><b>Nome dell`attività</b> : {task_name}<br><b>Priorità dell`attività</b> : {task_priority}<br><b>Stato dell`attività</b> : {task_status}<br><b>Affare</b> : {deal_name}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Task Name\": \"task_name\", \"Task Status\": \"task_status\", \"Company Name \": \"company_name\", \"Task Priority\": \"task_priority\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(248, 21, 'ja', 'New Task Assign', '<p><span style=\"font-family: sans-serif;\">こんにちは、</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">新しいタスクが割り当てられました。</span></p><p><span style=\"font-family: sans-serif;\"><b>タスク名</b> : {task_name}<br><b>タスクの優先度</b> : {task_priority}<br><b>タスクのステータス</b> : {task_status}<br><b>タスク取引</b> : {deal_name}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Task Name\": \"task_name\", \"Task Status\": \"task_status\", \"Company Name \": \"company_name\", \"Task Priority\": \"task_priority\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(249, 21, 'nl', 'New Task Assign', '<p><span style=\"font-family: sans-serif;\">Hallo,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Nieuwe taak is aan u toegewezen.</span></p><p><span style=\"font-family: sans-serif;\"><b>Opdrachtnaam</b> : {task_name}<br><b>Taakprioriteit</b> : {task_priority}<br><b>Taakstatus</b> : {task_status}<br><b>Task Deal</b> : {deal_name}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Task Name\": \"task_name\", \"Task Status\": \"task_status\", \"Company Name \": \"company_name\", \"Task Priority\": \"task_priority\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(250, 21, 'pl', 'New Task Assign', '<p><span style=\"font-family: sans-serif;\">Witaj,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Nowe zadanie zostało Ci przypisane.</span></p><p><span style=\"font-family: sans-serif;\"><b>Nazwa zadania</b> : {task_name}<br><b>Priorytet zadania</b> : {task_priority}<br><b>Status zadania</b> : {task_status}<br><b>Zadanie Deal</b> : {deal_name}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Task Name\": \"task_name\", \"Task Status\": \"task_status\", \"Company Name \": \"company_name\", \"Task Priority\": \"task_priority\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(251, 21, 'ru', 'New Task Assign', '<p><span style=\"font-family: sans-serif;\">Привет,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Новая задача была назначена вам.</span></p><p><span style=\"font-family: sans-serif;\"><b>Название задачи</b> : {task_name}<br><b>Приоритет задачи</b> : {task_priority}<br><b>Состояние задачи</b> : {task_status}<br><b>Задача</b> : {deal_name}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Task Name\": \"task_name\", \"Task Status\": \"task_status\", \"Company Name \": \"company_name\", \"Task Priority\": \"task_priority\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(252, 21, 'pt', 'New Task Assign', '<p><span style=\"font-family: sans-serif;\">Hello,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">New Task has been Assign to you.</span></p><p><span style=\"font-family: sans-serif;\"><b>Task Name</b> : {task_name}<br><b>Task Priority</b> : {task_priority}<br><b>Task Status</b> : {task_status}<br><b>Task Deal</b> : {deal_name}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Task Name\": \"task_name\", \"Task Status\": \"task_status\", \"Company Name \": \"company_name\", \"Task Priority\": \"task_priority\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(253, 22, 'ar', 'New Lead Assign', '<p><span style=\"font-family: sans-serif;\">مرحبا،</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">تم تعيين عميل جديد لك.</span></p><p><span style=\"font-family: sans-serif;\"><b>اسم العميل المحتمل</b> : {lead_name}<br><b>البريد الإلكتروني الرئيسي</b> : {lead_email}<br><b>خط أنابيب الرصاص</b> : {lead_pipeline}<br><b>مرحلة الرصاص</b> : {lead_stage}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Lead Name\": \"lead_name\", \"Lead Email\": \"lead_email\", \"Lead Stage\": \"lead_stage\", \"Company Name \": \"company_name\", \"Lead Pipeline\": \"lead_pipeline\", \"Lead New Stage\": \"lead_new_stage\", \"Lead Old Stage\": \"lead_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(254, 22, 'da', 'New Lead Assign', '<p><span style=\"font-family: sans-serif;\">Hej,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Ny bly er blevet tildelt dig.</span></p><p><span style=\"font-family: sans-serif;\"><b>Blynavn</b> : {lead_name}<br><b>Lead-e-mail</b> : {lead_email}<br><b>Blyrørledning</b> : {lead_pipeline}<br><b>Lead scenen</b> : {lead_stage}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Lead Name\": \"lead_name\", \"Lead Email\": \"lead_email\", \"Lead Stage\": \"lead_stage\", \"Company Name \": \"company_name\", \"Lead Pipeline\": \"lead_pipeline\", \"Lead New Stage\": \"lead_new_stage\", \"Lead Old Stage\": \"lead_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(255, 22, 'de', 'New Lead Assign', '<p><span style=\"font-family: sans-serif;\">Hallo,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Neuer Lead wurde Ihnen zugewiesen.</span></p><p><span style=\"font-family: sans-serif;\"><b>Lead Name</b> : {lead_name}<br><b>Lead-E-Mail</b> : {lead_email}<br><b>Lead Pipeline</b> : {lead_pipeline}<br><b>Lead Stage</b> : {lead_stage}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Lead Name\": \"lead_name\", \"Lead Email\": \"lead_email\", \"Lead Stage\": \"lead_stage\", \"Company Name \": \"company_name\", \"Lead Pipeline\": \"lead_pipeline\", \"Lead New Stage\": \"lead_new_stage\", \"Lead Old Stage\": \"lead_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(256, 22, 'en', 'New Lead Assign', '<p><span style=\"font-family: sans-serif;\">Hello,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">New Lead has been Assign to you.</span></p><p><span style=\"font-family: sans-serif;\"><b>Lead Name</b> : {lead_name}<br><b>Lead Email</b> : {lead_email}<br><b>Lead Pipeline</b> : {lead_pipeline}<br><b>Lead Stage</b> : {lead_stage}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Lead Name\": \"lead_name\", \"Lead Email\": \"lead_email\", \"Lead Stage\": \"lead_stage\", \"Company Name \": \"company_name\", \"Lead Pipeline\": \"lead_pipeline\", \"Lead New Stage\": \"lead_new_stage\", \"Lead Old Stage\": \"lead_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(257, 22, 'es', 'New Lead Assign', '<p><span style=\"font-family: sans-serif;\">Hola,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Se le ha asignado un nuevo plomo.</span></p><p><span style=\"font-family: sans-serif;\"><b>Nombre principal</b> : {lead_name}<br><b>Correo electrónico principal</b> : {lead_email}<br><b>Tubería de plomo</b> : {lead_pipeline}<br><b>Etapa de plomo</b> : {lead_stage}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Lead Name\": \"lead_name\", \"Lead Email\": \"lead_email\", \"Lead Stage\": \"lead_stage\", \"Company Name \": \"company_name\", \"Lead Pipeline\": \"lead_pipeline\", \"Lead New Stage\": \"lead_new_stage\", \"Lead Old Stage\": \"lead_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(258, 22, 'fr', 'New Lead Assign', '<p><span style=\"font-family: sans-serif;\">Bonjour,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Un nouveau prospect vous a été attribué.</span></p><p><span style=\"font-family: sans-serif;\"><b>Nom du responsable</b> : {lead_name}<br><b>Courriel principal</b> : {lead_email}<br><b>Pipeline de plomb</b> : {lead_pipeline}<br><b>Étape principale</b> : {lead_stage}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Lead Name\": \"lead_name\", \"Lead Email\": \"lead_email\", \"Lead Stage\": \"lead_stage\", \"Company Name \": \"company_name\", \"Lead Pipeline\": \"lead_pipeline\", \"Lead New Stage\": \"lead_new_stage\", \"Lead Old Stage\": \"lead_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(259, 22, 'it', 'New Lead Assign', '<p><span style=\"font-family: sans-serif;\">Ciao,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">New Lead è stato assegnato a te.</span></p><p><span style=\"font-family: sans-serif;\"><b>Nome del lead</b> : {lead_name}<br><b>Lead Email</b> : {lead_email}<br><b>Conduttura di piombo</b> : {lead_pipeline}<br><b>Lead Stage</b> : {lead_stage}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Lead Name\": \"lead_name\", \"Lead Email\": \"lead_email\", \"Lead Stage\": \"lead_stage\", \"Company Name \": \"company_name\", \"Lead Pipeline\": \"lead_pipeline\", \"Lead New Stage\": \"lead_new_stage\", \"Lead Old Stage\": \"lead_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(260, 22, 'ja', 'New Lead Assign', '<p><span style=\"font-family: sans-serif;\">こんにちは、</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">新しいリードが割り当てられました。</span></p><p><span style=\"font-family: sans-serif;\"><b>リード名</b> : {lead_name}<br><b>リードメール</b> : {lead_email}<br><b>リードパイプライン</b> : {lead_pipeline}<br><b>リードステージ</b> : {lead_stage}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Lead Name\": \"lead_name\", \"Lead Email\": \"lead_email\", \"Lead Stage\": \"lead_stage\", \"Company Name \": \"company_name\", \"Lead Pipeline\": \"lead_pipeline\", \"Lead New Stage\": \"lead_new_stage\", \"Lead Old Stage\": \"lead_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(261, 22, 'nl', 'New Lead Assign', '<p><span style=\"font-family: sans-serif;\">Hallo,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Nieuwe lead is aan u toegewezen.</span></p><p><span style=\"font-family: sans-serif;\"><b>Lead naam</b> : {lead_name}<br><b>E-mail leiden</b> : {lead_email}<br><b>Lead Pipeline</b> : {lead_pipeline}<br><b>Hoofdfase</b> : {lead_stage}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Lead Name\": \"lead_name\", \"Lead Email\": \"lead_email\", \"Lead Stage\": \"lead_stage\", \"Company Name \": \"company_name\", \"Lead Pipeline\": \"lead_pipeline\", \"Lead New Stage\": \"lead_new_stage\", \"Lead Old Stage\": \"lead_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(262, 22, 'pl', 'New Lead Assign', '<p><span style=\"font-family: sans-serif;\">Witaj,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Nowy potencjalny klient został do ciebie przypisany.</span></p><p><span style=\"font-family: sans-serif;\"><b>Imię i nazwisko</b> : {lead_name}<br><b>Główny adres e-mail</b> : {lead_email}<br><b>Ołów rurociągu</b> : {lead_pipeline}<br><b>Etap prowadzący</b> : {lead_stage}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Lead Name\": \"lead_name\", \"Lead Email\": \"lead_email\", \"Lead Stage\": \"lead_stage\", \"Company Name \": \"company_name\", \"Lead Pipeline\": \"lead_pipeline\", \"Lead New Stage\": \"lead_new_stage\", \"Lead Old Stage\": \"lead_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(263, 22, 'ru', 'New Lead Assign', '<p><span style=\"font-family: sans-serif;\">Привет,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Новый Лид был назначен вам.</span></p><p><span style=\"font-family: sans-serif;\"><b>Имя лидера</b> : {lead_name}<br><b>Ведущий Email</b> : {lead_email}<br><b>Ведущий трубопровод</b> : {lead_pipeline}<br><b>Ведущий этап</b> : {lead_stage}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Lead Name\": \"lead_name\", \"Lead Email\": \"lead_email\", \"Lead Stage\": \"lead_stage\", \"Company Name \": \"company_name\", \"Lead Pipeline\": \"lead_pipeline\", \"Lead New Stage\": \"lead_new_stage\", \"Lead Old Stage\": \"lead_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(264, 22, 'pt', 'New Lead Assign', '<p><span style=\"font-family: sans-serif;\">Hello,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">New Lead has been Assign to you.</span></p><p><span style=\"font-family: sans-serif;\"><b>Lead Name</b> : {lead_name}<br><b>Lead Email</b> : {lead_email}<br><b>Lead Pipeline</b> : {lead_pipeline}<br><b>Lead Stage</b> : {lead_stage}</span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Lead Name\": \"lead_name\", \"Lead Email\": \"lead_email\", \"Lead Stage\": \"lead_stage\", \"Company Name \": \"company_name\", \"Lead Pipeline\": \"lead_pipeline\", \"Lead New Stage\": \"lead_new_stage\", \"Lead Old Stage\": \"lead_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(265, 23, 'ar', 'Lead has been Moved', '<p><span style=\"font-family: sans-serif;\">مرحبا،</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">تم نقل العميل المحتمل من {lead_old_stage} إلى&nbsp; {lead_new_stage}.</span></p><p><span style=\"font-weight: bolder; font-family: sans-serif;\">اسم العميل المحتمل</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_name}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">البريد الإلكتروني الرئيسي</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_email}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">خط أنابيب الرصاص</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_pipeline}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">مرحلة الرصاص</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_stage}</span><span style=\"font-family: sans-serif;\"><br></span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Lead Name\": \"lead_name\", \"Lead Email\": \"lead_email\", \"Lead Stage\": \"lead_stage\", \"Company Name \": \"company_name\", \"Lead Pipeline\": \"lead_pipeline\", \"Lead New Stage\": \"lead_new_stage\", \"Lead Old Stage\": \"lead_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(266, 23, 'da', 'Lead has been Moved', '<p><span style=\"font-family: sans-serif;\">Hej,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">En leder er flyttet fra {lead_old_stage} til&nbsp; {lead_new_stage}.</span></p><p><span style=\"font-weight: bolder; font-family: sans-serif;\">Blynavn</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_name}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Lead-e-mail</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_email}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Blyrørledning</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_pipeline}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Lead scenen</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_stage}</span><span style=\"font-family: sans-serif;\"><br></span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Lead Name\": \"lead_name\", \"Lead Email\": \"lead_email\", \"Lead Stage\": \"lead_stage\", \"Company Name \": \"company_name\", \"Lead Pipeline\": \"lead_pipeline\", \"Lead New Stage\": \"lead_new_stage\", \"Lead Old Stage\": \"lead_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(267, 23, 'de', 'Lead has been Moved', '<p><span style=\"font-family: sans-serif;\">Hallo,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Ein Lead wurde verschoben von {lead_old_stage} zu&nbsp; {lead_new_stage}.</span></p><p><span style=\"font-weight: bolder; font-family: sans-serif;\">Lead Name</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_name}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Lead-E-Mail</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_email}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Lead Pipeline</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_pipeline}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Lead Stage</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_stage}</span><span style=\"font-family: sans-serif;\"><br></span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Lead Name\": \"lead_name\", \"Lead Email\": \"lead_email\", \"Lead Stage\": \"lead_stage\", \"Company Name \": \"company_name\", \"Lead Pipeline\": \"lead_pipeline\", \"Lead New Stage\": \"lead_new_stage\", \"Lead Old Stage\": \"lead_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(268, 23, 'en', 'Lead has been Moved', '<p><span style=\"font-family: sans-serif;\">Hello,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">A Lead has been move from {lead_old_stage} to&nbsp; {lead_new_stage}.</span></p><p><span style=\"font-weight: bolder; font-family: sans-serif;\">Lead Name</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_name}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Lead Email</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_email}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Lead Pipeline</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_pipeline}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Lead Stage</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_stage}</span><span style=\"font-family: sans-serif;\"><br></span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Lead Name\": \"lead_name\", \"Lead Email\": \"lead_email\", \"Lead Stage\": \"lead_stage\", \"Company Name \": \"company_name\", \"Lead Pipeline\": \"lead_pipeline\", \"Lead New Stage\": \"lead_new_stage\", \"Lead Old Stage\": \"lead_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(269, 23, 'es', 'Lead has been Moved', '<p><span style=\"font-family: sans-serif;\">Hola,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Un plomo ha sido movido de {lead_old_stage} a&nbsp; {lead_new_stage}.</span></p><p><span style=\"font-weight: bolder; font-family: sans-serif;\">Nombre principal</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_name}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Correo electrónico principal</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_email}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Tubería de plomo</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_pipeline}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Etapa de plomo</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_stage}</span><span style=\"font-family: sans-serif;\"><br></span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Lead Name\": \"lead_name\", \"Lead Email\": \"lead_email\", \"Lead Stage\": \"lead_stage\", \"Company Name \": \"company_name\", \"Lead Pipeline\": \"lead_pipeline\", \"Lead New Stage\": \"lead_new_stage\", \"Lead Old Stage\": \"lead_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(270, 23, 'fr', 'Lead has been Moved', '<p><span style=\"font-family: sans-serif;\">Bonjour,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Un lead a été déplacé de {lead_old_stage} à&nbsp; {lead_new_stage}.</span></p><p><span style=\"font-weight: bolder; font-family: sans-serif;\">Nom du responsable</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_name}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Courriel principal</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_email}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Pipeline de plomb</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_pipeline}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Étape principale</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_stage}</span><span style=\"font-family: sans-serif;\"><br></span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Lead Name\": \"lead_name\", \"Lead Email\": \"lead_email\", \"Lead Stage\": \"lead_stage\", \"Company Name \": \"company_name\", \"Lead Pipeline\": \"lead_pipeline\", \"Lead New Stage\": \"lead_new_stage\", \"Lead Old Stage\": \"lead_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(271, 23, 'it', 'Lead has been Moved', '<p><span style=\"font-family: sans-serif;\">Ciao,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">È stato spostato un lead {lead_old_stage} per&nbsp; {lead_new_stage}.</span></p><p><span style=\"font-weight: bolder; font-family: sans-serif;\">Nome del lead</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_name}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Lead Email</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_email}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Conduttura di piombo</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_pipeline}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Lead Stage</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_stage}</span><span style=\"font-family: sans-serif;\"><br></span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Lead Name\": \"lead_name\", \"Lead Email\": \"lead_email\", \"Lead Stage\": \"lead_stage\", \"Company Name \": \"company_name\", \"Lead Pipeline\": \"lead_pipeline\", \"Lead New Stage\": \"lead_new_stage\", \"Lead Old Stage\": \"lead_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(272, 23, 'ja', 'Lead has been Moved', '<p><span style=\"font-family: sans-serif;\">こんにちは、</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">リードが移動しました {lead_old_stage} に&nbsp; {lead_new_stage}.</span></p><p><span style=\"font-weight: bolder; font-family: sans-serif;\">リード名</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_name}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">リードメール</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_email}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">リードパイプライン</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_pipeline}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">リードステージ</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_stage}</span><span style=\"font-family: sans-serif;\"><br></span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Lead Name\": \"lead_name\", \"Lead Email\": \"lead_email\", \"Lead Stage\": \"lead_stage\", \"Company Name \": \"company_name\", \"Lead Pipeline\": \"lead_pipeline\", \"Lead New Stage\": \"lead_new_stage\", \"Lead Old Stage\": \"lead_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(273, 23, 'nl', 'Lead has been Moved', '<p><span style=\"font-family: sans-serif;\">Hallo,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Er is een lead verplaatst van {lead_old_stage} naar&nbsp; {lead_new_stage}.</span></p><p><span style=\"font-weight: bolder; font-family: sans-serif;\">Lead naam</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_name}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">E-mail leiden</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_email}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Lead Pipeline</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_pipeline}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Hoofdfase</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_stage}</span><span style=\"font-family: sans-serif;\"><br></span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Lead Name\": \"lead_name\", \"Lead Email\": \"lead_email\", \"Lead Stage\": \"lead_stage\", \"Company Name \": \"company_name\", \"Lead Pipeline\": \"lead_pipeline\", \"Lead New Stage\": \"lead_new_stage\", \"Lead Old Stage\": \"lead_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(274, 23, 'pl', 'Lead has been Moved', '<p><span style=\"font-family: sans-serif;\">Witaj,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Prowadzenie zostało przeniesione {lead_old_stage} do&nbsp; {lead_new_stage}.</span></p><p><span style=\"font-weight: bolder; font-family: sans-serif;\">Imię i nazwisko</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_name}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Główny adres e-mail</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_email}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Ołów rurociągu</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_pipeline}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Etap prowadzący</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_stage}</span><span style=\"font-family: sans-serif;\"><br></span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Lead Name\": \"lead_name\", \"Lead Email\": \"lead_email\", \"Lead Stage\": \"lead_stage\", \"Company Name \": \"company_name\", \"Lead Pipeline\": \"lead_pipeline\", \"Lead New Stage\": \"lead_new_stage\", \"Lead Old Stage\": \"lead_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(275, 23, 'ru', 'Lead has been Moved', '<p><span style=\"font-family: sans-serif;\">Привет,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">Свинец был двигаться от {lead_old_stage} в&nbsp; {lead_new_stage}.</span></p><p><span style=\"font-weight: bolder; font-family: sans-serif;\">Имя лидера</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_name}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Ведущий Email</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_email}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Ведущий трубопровод</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_pipeline}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Ведущий этап</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_stage}</span><span style=\"font-family: sans-serif;\"><br></span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Lead Name\": \"lead_name\", \"Lead Email\": \"lead_email\", \"Lead Stage\": \"lead_stage\", \"Company Name \": \"company_name\", \"Lead Pipeline\": \"lead_pipeline\", \"Lead New Stage\": \"lead_new_stage\", \"Lead Old Stage\": \"lead_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(276, 23, 'pt', 'Lead has been Moved', '<p><span style=\"font-family: sans-serif;\">Hello,</span><br style=\"font-family: sans-serif;\"><span style=\"font-family: sans-serif;\">A Lead has been move from {lead_old_stage} to&nbsp; {lead_new_stage}.</span></p><p><span style=\"font-weight: bolder; font-family: sans-serif;\">Lead Name</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_name}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Lead Email</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_email}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Lead Pipeline</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_pipeline}</span><br style=\"font-family: sans-serif;\"><span style=\"font-weight: bolder; font-family: sans-serif;\">Lead Stage</span><span style=\"font-family: sans-serif;\">&nbsp;: {lead_stage}</span><span style=\"font-family: sans-serif;\"><br></span></p>', NULL, '{\"Email\": \"email\", \"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Password\": \"password\", \"Lead Name\": \"lead_name\", \"Lead Email\": \"lead_email\", \"Lead Stage\": \"lead_stage\", \"Company Name \": \"company_name\", \"Lead Pipeline\": \"lead_pipeline\", \"Lead New Stage\": \"lead_new_stage\", \"Lead Old Stage\": \"lead_old_stage\"}', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(277, 24, 'ar', 'Purchase Send', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">مرحبا ، { purchase_name }</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">مرحبا بك في { app_name }</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">أتمنى أن يجدك هذا البريد الإلكتروني جيدا ! ! برجاء الرجوع الى رقم الفاتورة الملحقة { purchase_number } للحصول على المنتج / الخدمة.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">ببساطة اضغط على الاختيار بأسفل.</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{purchase_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">عملية الشراء</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">إشعر بالحرية للوصول إلى الخارج إذا عندك أي أسئلة.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">شكرا لك</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Regards,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{ company_name }</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{ app_url }</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"purchase_url\": \"purchase_url\", \"Purchase Name\": \"purchase_name\", \"Purchase Number\": \"purchase_number\"}', '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(278, 24, 'da', 'Purchase Send', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Hej, { purchase_name }</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Velkommen til { app_name }</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">H&aring;ber denne e-mail finder dig godt! Se vedlagte fakturanummer } { purchase_number } for product/service.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Klik p&aring; knappen nedenfor.</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{purchase_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">køb</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Du er velkommen til at r&aelig;kke ud, hvis du har nogen sp&oslash;rgsm&aring;l.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Tak.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Med venlig hilsen</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{ company_name }</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{ app_url }</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"purchase_url\": \"purchase_url\", \"Purchase Name\": \"purchase_name\", \"Purchase Number\": \"purchase_number\"}', '2023-07-11 01:09:29', '2023-07-11 01:09:29');
INSERT INTO `email_template_langs` (`id`, `parent_id`, `lang`, `subject`, `content`, `module_name`, `variables`, `created_at`, `updated_at`) VALUES
(279, 24, 'de', 'Purchase Send', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Hi, {purchase_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Willkommen bei {app_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Hoffe, diese E-Mail findet dich gut!! Sehen Sie sich die beigef&uuml;gte Rechnungsnummer {purchase_number} f&uuml;r Produkt/Service an.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Klicken Sie einfach auf den Button unten.</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{purchase_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Kauf</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">F&uuml;hlen Sie sich frei, wenn Sie Fragen haben.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Vielen Dank,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Betrachtet,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{company_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_url}</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"purchase_url\": \"purchase_url\", \"Purchase Name\": \"purchase_name\", \"Purchase Number\": \"purchase_number\"}', '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(280, 24, 'en', 'Purchase Send', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Hi, {purchase_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Welcome to {app_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Hope this email finds you well!! Please see attached Purchase number {purchase_number} for product/service.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Simply click on the button below.</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{purchase_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">purchase</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Feel free to reach out if you have any questions.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Thank You,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Regards,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{company_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_url}</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"purchase_url\": \"purchase_url\", \"Purchase Name\": \"purchase_name\", \"Purchase Number\": \"purchase_number\"}', '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(281, 24, 'es', 'Purchase Send', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Hi,&nbsp;{purchase_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Bienvenido a {app_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">&iexcl;Espero que este correo te encuentre bien!! Consulte el n&uacute;mero de factura adjunto {purchase_number} para el producto/servicio.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Simplemente haga clic en el bot&oacute;n de abajo.</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{purchase_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">compra</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Si&eacute;ntase libre de llegar si usted tiene alguna pregunta.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Gracias,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Considerando,</span></p>\n                    <p><span style=\"font-family: sans-serif;\">{company_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_url}</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"purchase_url\": \"purchase_url\", \"Purchase Name\": \"purchase_name\", \"Purchase Number\": \"purchase_number\"}', '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(282, 24, 'fr', 'Purchase Send', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Salut,&nbsp;{purchase_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Bienvenue dans { app_name }</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Jesp&egrave;re que ce courriel vous trouve bien ! ! Veuillez consulter le num&eacute;ro de facture {purchase_number}&nbsp;associ&eacute; au produit / service.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Cliquez simplement sur le bouton ci-dessous.</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{purchase_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Achat</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Nh&eacute;sitez pas &agrave; nous contacter si vous avez des questions.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Merci,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Regards,</span></p>\n                    <p><span style=\"font-family: sans-serif;\">{company_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_url}</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"purchase_url\": \"purchase_url\", \"Purchase Name\": \"purchase_name\", \"Purchase Number\": \"purchase_number\"}', '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(283, 24, 'it', 'Purchase Send', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Ciao, {purchase_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Benvenuti in {app_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Spero che questa email ti trovi bene!! Si prega di consultare il numero di fattura allegato {purchase_number} per il prodotto/servizio.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Semplicemente clicca sul pulsante sottostante.</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{purchase_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">acquisto</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Sentiti libero di raggiungere se hai domande.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Grazie,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Riguardo,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{company_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_url}</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"purchase_url\": \"purchase_url\", \"Purchase Name\": \"purchase_name\", \"Purchase Number\": \"purchase_number\"}', '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(284, 24, 'ja', 'Purchase Send', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">こんにちは、 {purchase_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_name} へようこそ</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">この E メールによりよく検出されます !! 製品 / サービスの添付された請求番号 {purchase_number} を参照してください。</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">以下のボタンをクリックしてください。</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{purchase_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">購入</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">質問がある場合は、自由に連絡してください。</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">ありがとうございます</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">よろしく</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{ company_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_url}</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"purchase_url\": \"purchase_url\", \"Purchase Name\": \"purchase_name\", \"Purchase Number\": \"purchase_number\"}', '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(285, 24, 'nl', 'Purchase Send', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Hallo, { purchase_name }</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Welkom bij { app_name }</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Hoop dat deze e-mail je goed vindt!! Zie bijgevoegde factuurnummer { purchase_number } voor product/service.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Klik gewoon op de knop hieronder.</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{purchase_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">Aankoop</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Voel je vrij om uit te reiken als je vragen hebt.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Dank U,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Betreft:</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{ company_name }</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{ app_url }</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"purchase_url\": \"purchase_url\", \"Purchase Name\": \"purchase_name\", \"Purchase Number\": \"purchase_number\"}', '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(286, 24, 'pl', 'Purchase Send', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Witaj,&nbsp;{purchase_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Witamy w aplikacji {app_name }</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Mam nadzieję, że ta wiadomość e-mail znajduje Cię dobrze!! Zapoznaj się z załączonym numerem rachunku {purchase_number } dla produktu/usługi.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Wystarczy kliknąć na przycisk poniżej.</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{purchase_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">zakup</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Czuj się swobodnie, jeśli masz jakieś pytania.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Dziękuję,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">W odniesieniu do</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{company_name }</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_url }</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"purchase_url\": \"purchase_url\", \"Purchase Name\": \"purchase_name\", \"Purchase Number\": \"purchase_number\"}', '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(287, 24, 'ru', 'Purchase Send', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Привет, { purchase_name }</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Вас приветствует { app_name }</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Надеюсь, это письмо найдет вас хорошо! См. прилагаемый номер счета { purchase_number } для product/service.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Просто нажмите на кнопку внизу.</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{purchase_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">покупка</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Не стеснитесь, если у вас есть вопросы.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Спасибо.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">С уважением,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{ company_name }</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{ app_url }</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"purchase_url\": \"purchase_url\", \"Purchase Name\": \"purchase_name\", \"Purchase Number\": \"purchase_number\"}', '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(288, 24, 'pt', 'Purchase Send', '<p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Oi, {purchase_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Bem-vindo a {app_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Espero que este e-mail encontre voc&ecirc; bem!! Por favor, consulte o n&uacute;mero de faturamento conectado {purchase_number} para produto/servi&ccedil;o.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Basta clicar no bot&atilde;o abaixo.</span></p>\n                    <p style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><a style=\"background: #6676ef; color: #ffffff; font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-weight: normal; line-height: 120%; margin: 0px; text-decoration: none; text-transform: none;\" href=\"{purchase_url}\" target=\"_blank\" rel=\"noopener\"> <strong style=\"color: white; font-weight: bold; text: white;\">compra</strong> </a></span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Sinta-se &agrave; vontade para alcan&ccedil;ar fora se voc&ecirc; tiver alguma d&uacute;vida.</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Obrigado,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">Considera,</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{company_name}</span></p>\n                    <p style=\"line-height: 28px; font-family: Nunito,;\"><span style=\"font-family: sans-serif;\">{app_url}</span></p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"purchase_url\": \"purchase_url\", \"Purchase Name\": \"purchase_name\", \"Purchase Number\": \"purchase_number\"}', '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(289, 25, 'ar', 'Purchase Payment Create', '<p>مرحبا ، { payment_name }</p>\n                    <p>&nbsp;</p>\n                    <p>مرحبا بك في { app_name }</p>\n                    <p>&nbsp;</p>\n                    <p>نحن نكتب لإبلاغكم بأننا قد أرسلنا مدفوعات (payment_bill) } الخاصة بك.</p>\n                    <p>&nbsp;</p>\n                    <p>لقد أرسلنا قيمتك { payment_amount } لأجل { payment_bill } قمت بالاحالة في التاريخ { payment_date } من خلال { payment_method }.</p>\n                    <p>&nbsp;</p>\n                    <p>شكرا جزيلا لك وطاب يومك ! !!!</p>\n                    <p>&nbsp;</p>\n                    <p>{ company_name }</p>\n                    <p>&nbsp;</p>\n                    <p>{ app_url }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Bill\": \"payment_bill\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Payment Amount\": \"payment_amount\", \"Payment Method\": \"payment_method\"}', '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(290, 25, 'da', 'Purchase Payment Create', '<p>Hej, { payment_name }</p>\n                    <p>&nbsp;</p>\n                    <p>Velkommen til { app_name }</p>\n                    <p>&nbsp;</p>\n                    <p>Vi skriver for at informere dig om, at vi har sendt din { payment_bill }-betaling.</p>\n                    <p>&nbsp;</p>\n                    <p>Vi har sendt dit bel&oslash;b { payment_amount } betaling for { payment_bill } undertvist p&aring; dato { payment_date } via { payment_method }.</p>\n                    <p>&nbsp;</p>\n                    <p>Mange tak, og ha en god dag!</p>\n                    <p>&nbsp;</p>\n                    <p>{ company_name }</p>\n                    <p>&nbsp;</p>\n                    <p>{ app_url }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Bill\": \"payment_bill\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Payment Amount\": \"payment_amount\", \"Payment Method\": \"payment_method\"}', '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(291, 25, 'de', 'Purchase Payment Create', '<p>Hi, {payment_name}</p>\n                    <p>&nbsp;</p>\n                    <p>Willkommen bei {app_name}</p>\n                    <p>&nbsp;</p>\n                    <p>Wir schreiben Ihnen mitzuteilen, dass wir Ihre Zahlung von {payment_bill} gesendet haben.</p>\n                    <p>&nbsp;</p>\n                    <p>Wir haben Ihre Zahlung {payment_amount} Zahlung f&uuml;r {payment_bill} am Datum {payment_date} &uuml;ber {payment_method} gesendet.</p>\n                    <p>&nbsp;</p>\n                    <p>Vielen Dank und haben einen guten Tag! !!!</p>\n                    <p>&nbsp;</p>\n                    <p>{company_name}</p>\n                    <p>&nbsp;</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Bill\": \"payment_bill\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Payment Amount\": \"payment_amount\", \"Payment Method\": \"payment_method\"}', '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(292, 25, 'en', 'Purchase Payment Create', '<p>Hi, {payment_name}</p>\n                    <p>Welcome to {app_name}</p>\n                    <p>We are writing to inform you that we has sent your {payment_bill} payment.</p>\n                    <p>We has sent your amount {payment_amount} payment for {payment_bill} submited on date {payment_date} via {payment_method}.</p>\n                    <p>Thank You very much and have a good day !!!!</p>\n                    <p>{company_name}</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Bill\": \"payment_bill\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Payment Amount\": \"payment_amount\", \"Payment Method\": \"payment_method\"}', '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(293, 25, 'es', 'Purchase Payment Create', '<p>Hi, {payment_name}</p>\n                    <p>&nbsp;</p>\n                    <p>Bienvenido a {app_name}</p>\n                    <p>&nbsp;</p>\n                    <p>Estamos escribiendo para informarle que hemos enviado su pago {payment_bill}.</p>\n                    <p>&nbsp;</p>\n                    <p>Hemos enviado su importe {payment_amount} pago para {payment_bill} submitado en la fecha {payment_date} a trav&eacute;s de {payment_method}.</p>\n                    <p>&nbsp;</p>\n                    <p>Thank You very much and have a good day! !!!</p>\n                    <p>&nbsp;</p>\n                    <p>{company_name}</p>\n                    <p>&nbsp;</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Bill\": \"payment_bill\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Payment Amount\": \"payment_amount\", \"Payment Method\": \"payment_method\"}', '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(294, 25, 'fr', 'Purchase Payment Create', '<p>Salut, { payment_name }</p>\n                    <p>&nbsp;</p>\n                    <p>Bienvenue dans { app_name }</p>\n                    <p>&nbsp;</p>\n                    <p>Nous vous &eacute;crivons pour vous informer que nous avons envoy&eacute; votre paiement { payment_bill }.</p>\n                    <p>&nbsp;</p>\n                    <p>Nous avons envoy&eacute; votre paiement { payment_amount } pour { payment_bill } soumis &agrave; la date { payment_date } via { payment_method }.</p>\n                    <p>&nbsp;</p>\n                    <p>Merci beaucoup et avez un bon jour ! !!!</p>\n                    <p>&nbsp;</p>\n                    <p>{ company_name }</p>\n                    <p>&nbsp;</p>\n                    <p>{ app_url }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Bill\": \"payment_bill\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Payment Amount\": \"payment_amount\", \"Payment Method\": \"payment_method\"}', '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(295, 25, 'it', 'Purchase Payment Create', '<p>Ciao, {payment_name}</p>\n                    <p>&nbsp;</p>\n                    <p>Benvenuti in {app_name}</p>\n                    <p>&nbsp;</p>\n                    <p>Scriviamo per informarti che abbiamo inviato il tuo pagamento {payment_bill}.</p>\n                    <p>&nbsp;</p>\n                    <p>Abbiamo inviato la tua quantit&agrave; {payment_amount} pagamento per {payment_bill} subita alla data {payment_date} tramite {payment_method}.</p>\n                    <p>&nbsp;</p>\n                    <p>Grazie mille e buona giornata! !!!</p>\n                    <p>&nbsp;</p>\n                    <p>{company_name}</p>\n                    <p>&nbsp;</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Bill\": \"payment_bill\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Payment Amount\": \"payment_amount\", \"Payment Method\": \"payment_method\"}', '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(296, 25, 'ja', 'Purchase Payment Create', '<p>こんにちは、 {payment_name}</p>\n                    <p>&nbsp;</p>\n                    <p>{app_name} へようこそ</p>\n                    <p>&nbsp;</p>\n                    <p>{payment_bill} の支払いを送信したことをお知らせするために執筆しています。</p>\n                    <p>&nbsp;</p>\n                    <p>{payment_date } に提出された {payment_議案} に対する金額 {payment_date} の支払いは、 {payment_method}を介して送信されました。</p>\n                    <p>&nbsp;</p>\n                    <p>ありがとうございます。良い日をお願いします。</p>\n                    <p>&nbsp;</p>\n                    <p>{ company_name}</p>\n                    <p>&nbsp;</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Bill\": \"payment_bill\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Payment Amount\": \"payment_amount\", \"Payment Method\": \"payment_method\"}', '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(297, 25, 'nl', 'Purchase Payment Create', '<p>Hallo, { payment_name }</p>\n                    <p>&nbsp;</p>\n                    <p>Welkom bij { app_name }</p>\n                    <p>&nbsp;</p>\n                    <p>Wij schrijven u om u te informeren dat wij uw betaling van { payment_bill } hebben verzonden.</p>\n                    <p>&nbsp;</p>\n                    <p>We hebben uw bedrag { payment_amount } betaling voor { payment_bill } verzonden op datum { payment_date } via { payment_method }.</p>\n                    <p>&nbsp;</p>\n                    <p>Hartelijk dank en hebben een goede dag! !!!</p>\n                    <p>&nbsp;</p>\n                    <p>{ company_name }</p>\n                    <p>&nbsp;</p>\n                    <p>{ app_url }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Bill\": \"payment_bill\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Payment Amount\": \"payment_amount\", \"Payment Method\": \"payment_method\"}', '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(298, 25, 'pl', 'Purchase Payment Create', '<p>Witaj, {payment_name }</p>\n                    <p>&nbsp;</p>\n                    <p>Witamy w aplikacji {app_name }</p>\n                    <p>&nbsp;</p>\n                    <p>Piszemy, aby poinformować Cię, że wysłaliśmy Twoją płatność {payment_bill }.</p>\n                    <p>&nbsp;</p>\n                    <p>Twoja kwota {payment_amount } została wysłana przez użytkownika {payment_bill } w dniu {payment_date } za pomocą metody {payment_method }.</p>\n                    <p>&nbsp;</p>\n                    <p>Dziękuję bardzo i mam dobry dzień! !!!</p>\n                    <p>&nbsp;</p>\n                    <p>{company_name }</p>\n                    <p>&nbsp;</p>\n                    <p>{app_url }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Bill\": \"payment_bill\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Payment Amount\": \"payment_amount\", \"Payment Method\": \"payment_method\"}', '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(299, 25, 'ru', 'Purchase Payment Create', '<p>Привет, { payment_name }</p>\n                    <p>&nbsp;</p>\n                    <p>Вас приветствует { app_name }</p>\n                    <p>&nbsp;</p>\n                    <p>Мы пишем, чтобы сообщить вам, что мы отправили вашу оплату { payment_bill }.</p>\n                    <p>&nbsp;</p>\n                    <p>Мы отправили вашу сумму оплаты { payment_amount } для { payment_bill }, подав на дату { payment_date } через { payment_method }.</p>\n                    <p>&nbsp;</p>\n                    <p>Большое спасибо и хорошего дня! !!!</p>\n                    <p>&nbsp;</p>\n                    <p>{ company_name }</p>\n                    <p>&nbsp;</p>\n                    <p>{ app_url }</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Bill\": \"payment_bill\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Payment Amount\": \"payment_amount\", \"Payment Method\": \"payment_method\"}', '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(300, 25, 'pt', 'Purchase Payment Create', '<p>Oi, {payment_name}</p>\n                    <p>&nbsp;</p>\n                    <p>Bem-vindo a {app_name}</p>\n                    <p>&nbsp;</p>\n                    <p>Estamos escrevendo para inform&aacute;-lo que enviamos o seu pagamento {payment_bill}.</p>\n                    <p>&nbsp;</p>\n                    <p>N&oacute;s enviamos sua quantia {payment_amount} pagamento por {payment_bill} requisitado na data {payment_date} via {payment_method}.</p>\n                    <p>&nbsp;</p>\n                    <p>Muito obrigado e tenha um bom dia! !!!</p>\n                    <p>&nbsp;</p>\n                    <p>{company_name}</p>\n                    <p>&nbsp;</p>\n                    <p>{app_url}</p>', NULL, '{\"App Url\": \"app_url\", \"App Name\": \"app_name\", \"Company Name\": \"company_name\", \"Payment Bill\": \"payment_bill\", \"Payment Date\": \"payment_date\", \"Payment Name\": \"payment_name\", \"Payment Amount\": \"payment_amount\", \"Payment Method\": \"payment_method\"}', '2023-07-11 01:09:29', '2023-07-11 01:09:29');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` int NOT NULL,
  `department_id` int NOT NULL,
  `designation_id` int NOT NULL,
  `company_doj` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documents` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_holder_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_identifier_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_payer_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary_type` int DEFAULT NULL,
  `salary` int DEFAULT NULL,
  `is_active` int NOT NULL DEFAULT '1',
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_documents`
--

CREATE TABLE `employee_documents` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int NOT NULL,
  `document_id` int NOT NULL,
  `document_value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint UNSIGNED NOT NULL,
  `branch_id` int NOT NULL,
  `department_id` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_by` int NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_employees`
--

CREATE TABLE `event_employees` (
  `id` bigint UNSIGNED NOT NULL,
  `event_id` int NOT NULL,
  `employee_id` int NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `experience_certificates`
--

CREATE TABLE `experience_certificates` (
  `id` bigint UNSIGNED NOT NULL,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experience_certificates`
--

INSERT INTO `experience_certificates` (`id`, `lang`, `content`, `workspace`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'ar', '<h3 style=\"text-align: center;\">بريد إلكتروني تجربة</h3>\n\n\n\n            <p>{app_name}</p>\n\n            <p>إلي من يهمه الامر</p>\n\n            <p>{date}</p>\n\n            <p>{employee_name}</p>\n\n            <p>مدة الخدمة {duration} في {app_name}.</p>\n\n            <p>{designation}</p>\n\n            <p>{payroll}</p>\n\n            <p>الادوار والمسؤوليات</p>\n\n\n\n            <p>وصف موجز لمسار عمل الموظف وبيان إيجابي من المدير أو المشرف.</p>\n\n\n\n            <p>بإخلاص،</p>\n\n            <p>{employee_name}</p>\n\n            <p>{designation}</p>\n\n            <p>التوقيع</p>\n\n            <p>{app_name}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(2, 'da', '<h3 style=\"text-align: center;\">Erfaringsbrev</h3>\n\n            <p>{app_name}</p>\n\n            <p>TIL HVEM DET M&Aring;TTE VEDR&Oslash;RE</p>\n\n            <p>{date}</p>\n\n            <p>{employee_name}</p>\n\n            <p>Tjenesteperiode {duration} i {app_name}.</p>\n\n            <p>{designation}</p>\n\n            <p>{payroll}</p>\n\n            <p>Roller og ansvar</p>\n\n\n\n            <p>Kort beskrivelse af medarbejderens ans&aelig;ttelsesforl&oslash;b og positiv udtalelse fra leder eller arbejdsleder.</p>\n\n\n\n            <p>Med venlig hilsen</p>\n\n            <p>{employee_name}</p>\n\n            <p>{designation}</p>\n\n            <p>Underskrift</p>\n\n            <p>{app_name}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(3, 'de', '<h3 style=\"text-align: center;\">Erfahrungsbrief</h3>\n\n\n\n            <p>{app_name}</p>\n\n            <p>WEN ES ANGEHT</p>\n\n            <p>{date}</p>\n\n            <p>{employee_name}</p>\n\n            <p>Dienstzeit {duration} in {app_name}.</p>\n\n            <p>{designation}</p>\n\n            <p>{payroll}</p>\n\n            <p>Rollen und Verantwortlichkeiten</p>\n\n\n\n            <p>Kurze Beschreibung des beruflichen Werdegangs des Mitarbeiters und eine positive Stellungnahme des Vorgesetzten oder Vorgesetzten.</p>\n\n\n\n            <p>Aufrichtig,</p>\n\n            <p>{employee_name}</p>\n\n            <p>{designation}</p>\n\n            <p>Unterschrift</p>\n\n            <p>{app_name}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(4, 'en', '<p lang=\"en-IN\" style=\"margin-bottom: 0cm; direction: ltr; line-height: 2; text-align: center;\" align=\"center\"><span style=\"font-size: 18pt;\"><strong>Experience Letter</strong></span></p>\n            <p>{app_name}</p>\n            <p>TO WHOM IT MAY CONCERN</p>\n            <p>{date}</p>\n            <p>{employee_name}</p>\n            <p>Tenure of Service {duration} in {app_name}.</p>\n            <p>{designation}</p>\n            <p>{payroll}</p>\n            <p>Roles and Responsibilities</p>\n            <p>Brief description of the employee&rsquo;s course of employment and a positive statement from the manager or supervisor.</p>\n            <p>Sincerely,</p>\n            <p>{employee_name}</p>\n            <p>{designation}</p>\n            <p>Signature</p>\n            <p>{app_name}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(5, 'es', '<h3 style=\"text-align: center;\">Carta de experiencia</h3>\n\n\n            <p>{app_name}</p>\n\n            <p>A QUIEN LE INTERESE</p>\n\n            <p>{date}</p>\n\n            <p>{employee_name}</p>\n\n            <p>Duraci&oacute;n del servicio {duration} en {app_name}.</p>\n\n            <p>{designation}</p>\n\n            <p>{payroll}</p>\n\n            <p>Funciones y responsabilidades</p>\n\n\n\n            <p>Breve descripci&oacute;n del curso de empleo del empleado y una declaraci&oacute;n positiva del gerente o supervisor.</p>\n\n\n\n            <p>Sinceramente,</p>\n\n            <p>{employee_name}</p>\n\n            <p>{designation}</p>\n\n            <p>Firma</p>\n\n            <p>{app_name}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(6, 'fr', '<h3 style=\"text-align: center;\">Lettre dexp&eacute;rience</h3>\n\n\n\n            <p>{app_name}</p>\n\n            <p>&Agrave; QUI DE DROIT</p>\n\n            <p>{date}</p>\n\n            <p>{employee_name}</p>\n\n            <p>Dur&eacute;e du service {duration} dans {app_name}.</p>\n\n            <p>{designation}</p>\n\n            <p>{payroll}</p>\n\n            <p>R&ocirc;les et responsabilit&eacute;s</p>\n\n\n\n            <p>Br&egrave;ve description de l&eacute;volution de lemploi de lemploy&eacute; et une d&eacute;claration positive du gestionnaire ou du superviseur.</p>\n\n\n\n            <p>Sinc&egrave;rement,</p>\n\n            <p>{employee_name}</p>\n\n            <p>{designation}</p>\n\n            <p>Signature</p>\n\n            <p>{app_name}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(7, 'id', '<h3 style=\"text-align: center;\">Surat Pengalaman</h3>\n\n\n\n            <p>{app_name}</p>\n\n            <p>UNTUK PERHATIAN</p>\n\n            <p>{date}</p>\n\n            <p>{employee_name}</p>\n\n            <p>Jangka Waktu Layanan {duration} di {app_name}.</p>\n\n            <p>{designation}</p>\n\n            <p>{payroll}</p>\n\n            <p>Peran dan Tanggung Jawab</p>\n\n\n\n            <p>Deskripsi singkat tentang pekerjaan karyawan dan pernyataan positif dari manajer atau supervisor.</p>\n\n\n\n            <p>Sungguh-sungguh,</p>\n\n            <p>{employee_name}</p>\n\n            <p>{designation}</p>\n\n            <p>Tanda tangan</p>\n\n            <p>{app_name}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(8, 'it', '<h3 style=\"text-align: center;\">Lettera di esperienza</h3>\n\n\n\n            <p>{app_name}</p>\n\n            <p>PER CHI &Egrave; COINVOLTO</p>\n\n            <p>{date}</p>\n\n            <p>{employee_name}</p>\n\n            <p>Durata del servizio {duration} in {app_name}.</p>\n\n            <p>{designation}</p>\n\n            <p>{payroll}</p>\n\n            <p>Ruoli e responsabilit&agrave;</p>\n\n\n\n            <p>Breve descrizione del percorso lavorativo del dipendente e dichiarazione positiva del manager o supervisore.</p>\n\n\n\n            <p>Cordiali saluti,</p>\n\n            <p>{employee_name}</p>\n\n            <p>{designation}</p>\n\n            <p>Firma</p>\n\n            <p>{app_name}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(9, 'ja', '\n            <h3 style=\"text-align: center;\">体験談</h3>\n\n\n\n            <p>{app_name}</p>\n\n            <p>ご担当者様</p>\n\n            <p>{date}</p>\n\n            <p>{employee_name}</p>\n\n            <p>{app_name} のサービス {duration} の保有期間。</p>\n\n            <p>{designation}</p>\n\n            <p>{payroll}</p>\n\n            <p>役割と責任</p>\n\n\n\n            <p>従業員の雇用コースの簡単な説明と、マネージャーまたはスーパーバイザーからの肯定的な声明。</p>\n\n\n\n            <p>心から、</p>\n\n            <p>{employee_name}</p>\n\n            <p>{designation}</p>\n\n            <p>サイン</p>\n\n            <p>{app_name}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(10, 'nl', '<h3 style=\"text-align: center;\">Ervaringsbrief</h3>\n\n\n            <p>{app_name}</p>\n\n            <p>VOOR WIE HET AANGAAT</p>\n\n            <p>{date}</p>\n\n            <p>{employee_name}</p>\n\n            <p>Diensttijd {duration} in {app_name}.</p>\n\n            <p>{designation}</p>\n\n            <p>{payroll}</p>\n\n            <p>Rollen en verantwoordelijkheden</p>\n\n\n\n            <p>Korte omschrijving van het dienstverband van de medewerker en een positieve verklaring van de leidinggevende of leidinggevende.</p>\n\n\n\n            <p>Eerlijk,</p>\n\n            <p>{employee_name}</p>\n\n            <p>{designation}</p>\n\n            <p>Handtekening</p>\n\n            <p>{app_name}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(11, 'pl', '<h3 style=\"text-align: center;\">Doświadczenie List</h3>\n\n\n\n            <p>{app_name}</p>\n\n            <p>DO TYCH KT&Oacute;RYCH MOŻE TO DOTYCZYĆ</p>\n\n            <p>{date}</p>\n\n            <p>{employee_name}</p>\n\n            <p>Okres świadczenia usług {duration} w aplikacji {app_name}.</p>\n\n            <p>{designation}</p>\n\n            <p>{payroll}</p>\n\n            <p>Role i obowiązki</p>\n\n\n\n            <p>Kr&oacute;tki opis przebiegu zatrudnienia pracownika oraz pozytywna opinia kierownika lub przełożonego.</p>\n\n\n\n            <p>Z poważaniem,</p>\n\n            <p>{employee_name}</p>\n\n            <p>{designation}</p>\n\n            <p>Podpis</p>\n\n            <p>{app_name}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(12, 'pt', '<h3 style=\"text-align: center;\">Carta de Experi&ecirc;ncia</h3>\n\n\n\n            <p>{app_name}</p>\n\n            <p>A QUEM POSSA INTERESSAR</p>\n\n            <p>{date}</p>\n\n            <p>{employee_name}</p>\n\n            <p>Tempo de servi&ccedil;o {duration} em {app_name}.</p>\n\n            <p>{designation}</p>\n\n            <p>{payroll}</p>\n\n            <p>Pap&eacute;is e responsabilidades</p>\n\n            <p>Breve descri&ccedil;&atilde;o do curso de emprego do funcion&aacute;rio e uma declara&ccedil;&atilde;o positiva do gerente ou supervisor.</p>\n\n            <p>Sinceramente,</p>\n\n            <p>{employee_name}</p>\n\n            <p>{designation}</p>\n\n            <p>Assinatura</p>\n\n            <p>{app_name}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(13, 'ru', '<h3 style=\"text-align: center;\">Письмо об опыте</h3>\n\n\n\n            <p>{app_name}</p>\n\n            <p>ДЛЯ ПРЕДЪЯВЛЕНИЯ ПО МЕСТУ ТРЕБОВАНИЯ</p>\n\n            <p>{date}</p>\n\n            <p>{employee_name}</p>\n\n            <p>Срок службы {duration} в {app_name}.</p>\n\n            <p>{designation}</p>\n\n            <p>{payroll}</p>\n\n            <p>Роли и обязанности</p>\n\n\n\n            <p>Краткое описание трудового стажа работника и положительное заключение руководителя или руководителя.</p>\n\n\n\n            <p>Искренне,</p>\n\n            <p>{employee_name}</p>\n\n            <p>{designation}</p>\n\n            <p>Подпись</p>\n\n            <p>{app_name}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` bigint UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `occasion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `send_date` date DEFAULT NULL,
  `category_id` int NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `invoice_module` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_display` int NOT NULL DEFAULT '1',
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_payments`
--

CREATE TABLE `invoice_payments` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_id` int NOT NULL,
  `date` date NOT NULL,
  `amount` double(8,2) NOT NULL DEFAULT '0.00',
  `account_id` int DEFAULT NULL,
  `payment_method` int NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `order_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `txn_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Manually',
  `receipt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `add_receipt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_products`
--

CREATE TABLE `invoice_products` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `tax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` double(8,2) NOT NULL DEFAULT '0.00',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `price` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ip_restricts`
--

CREATE TABLE `ip_restricts` (
  `id` bigint UNSIGNED NOT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `joining_letters`
--

CREATE TABLE `joining_letters` (
  `id` bigint UNSIGNED NOT NULL,
  `lang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `joining_letters`
--

INSERT INTO `joining_letters` (`id`, `lang`, `content`, `workspace`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'ar', '<h2 style=\"text-align: center;\"><strong>خطاب الانضمام</strong></h2>\n            <p>{date}</p>\n            <p>{employee_name}</p>\n            <p>{address}</p>\n            <p>الموضوع: موعد لوظيفة {designation}</p>\n            <p>عزيزي {employee_name} ،</p>\n            <p>يسعدنا أن نقدم لك منصب {designation} مع {app_name} \"الشركة\" وفقًا للشروط التالية و</p>\n            <p>الظروف:</p>\n            <p>1. بدء العمل</p>\n            <p>سيصبح عملك ساريًا اعتبارًا من {start_date}</p>\n            <p>2. المسمى الوظيفي</p>\n            <p>سيكون المسمى الوظيفي الخاص بك هو {designation}.</p>\n            <p>3. الراتب</p>\n            <p>سيكون راتبك والمزايا الأخرى على النحو المبين في الجدول 1 ، طيه.</p>\n            <p>4. مكان الإرسال</p>\n            <p>سيتم إرسالك إلى {branch}. ومع ذلك ، قد يُطلب منك العمل في أي مكان عمل تمتلكه الشركة ، أو</p>\n            <p>قد تحصل لاحقًا.</p>\n            <p>5. ساعات العمل</p>\n            <p>أيام العمل العادية هي من الاثنين إلى الجمعة. سيُطلب منك العمل لساعات حسب الضرورة لـ</p>\n            <p>أداء واجباتك على النحو الصحيح تجاه الشركة. ساعات العمل العادية من {start_time} إلى {end_time} وأنت</p>\n            <p>من المتوقع أن يعمل ما لا يقل عن {total_hours} ساعة كل أسبوع ، وإذا لزم الأمر لساعات إضافية اعتمادًا على</p>\n            <p>المسؤوليات.</p>\n            <p>6. الإجازة / العطل</p>\n            <p>6.1 يحق لك الحصول على إجازة غير رسمية مدتها 12 يومًا.</p>\n            <p>6.2 يحق لك الحصول على إجازة مرضية مدفوعة الأجر لمدة 12 يوم عمل.</p>\n            <p>6.3 تخطر الشركة بقائمة الإجازات المعلنة في بداية كل عام.</p>\n            <p>7. طبيعة الواجبات</p>\n            <p>ستقوم بأداء أفضل ما لديك من واجبات متأصلة في منصبك ومهام إضافية مثل الشركة</p>\n            <p>قد يدعوك لأداء ، من وقت لآخر. واجباتك المحددة منصوص عليها في الجدول الثاني بهذه الرسالة.</p>\n            <p>8. ممتلكات الشركة</p>\n            <p>ستحافظ دائمًا على ممتلكات الشركة في حالة جيدة ، والتي قد يتم تكليفك بها للاستخدام الرسمي خلال فترة عملها</p>\n            <p>عملك ، ويجب أن تعيد جميع هذه الممتلكات إلى الشركة قبل التخلي عن الرسوم الخاصة بك ، وإلا فإن التكلفة</p>\n            <p>نفس الشيء سوف تسترده منك الشركة.</p>\n            <p>9. الاقتراض / قبول الهدايا</p>\n            <p>لن تقترض أو تقبل أي أموال أو هدية أو مكافأة أو تعويض مقابل مكاسبك الشخصية من أو تضع نفسك بأي طريقة أخرى</p>\n            <p>بموجب التزام مالي تجاه أي شخص / عميل قد تكون لديك تعاملات رسمية معه.</p>\n            <p>10. الإنهاء</p>\n            <p>10.1 يمكن للشركة إنهاء موعدك ، دون أي سبب ، من خلال إعطائك ما لا يقل عن [إشعار] قبل أشهر</p>\n            <p>إشعار خطي أو راتب بدلاً منه. لغرض هذا البند ، يقصد بالراتب المرتب الأساسي.</p>\n            <p>10.2 إنهاء عملك مع الشركة ، دون أي سبب ، من خلال تقديم ما لا يقل عن إشعار الموظف</p>\n            <p>أشهر الإخطار أو الراتب عن الفترة غير المحفوظة ، المتبقية بعد تعديل الإجازات المعلقة ، كما في التاريخ.</p>\n            <p>10.3 تحتفظ الشركة بالحق في إنهاء عملك بإيجاز دون أي فترة إشعار أو مدفوعات إنهاء</p>\n            <p>إذا كان لديه سبب معقول للاعتقاد بأنك مذنب بسوء السلوك أو الإهمال ، أو ارتكبت أي خرق جوهري لـ</p>\n            <p>العقد ، أو تسبب في أي خسارة للشركة.</p>\n            <p>10. 4 عند إنهاء عملك لأي سبب من الأسباب ، ستعيد إلى الشركة جميع ممتلكاتك ؛ المستندات و</p>\n            <p>الأوراق الأصلية ونسخها ، بما في ذلك أي عينات ، وأدبيات ، وعقود ، وسجلات ، وقوائم ، ورسومات ، ومخططات ،</p>\n            <p>الرسائل والملاحظات والبيانات وما شابه ذلك ؛ والمعلومات السرية التي بحوزتك أو تحت سيطرتك والمتعلقة بك</p>\n            <p>التوظيف أو الشؤون التجارية للعملاء.</p>\n            <p>11. المعلومات السرية</p>\n            <p>11. 1 أثناء عملك في الشركة ، سوف تكرس وقتك واهتمامك ومهارتك كلها بأفضل ما لديك من قدرات</p>\n            <p>عملها. لا يجوز لك ، بشكل مباشر أو غير مباشر ، الانخراط أو الارتباط بنفسك ، أو الارتباط به ، أو القلق ، أو التوظيف ، أو</p>\n            <p>الوقت أو متابعة أي دورة دراسية على الإطلاق ، دون الحصول على إذن مسبق من الشركة أو الانخراط في أي عمل آخر أو</p>\n            <p>الأنشطة أو أي وظيفة أخرى أو العمل بدوام جزئي أو متابعة أي دورة دراسية على الإطلاق ، دون إذن مسبق من</p>\n            <p>شركة.</p>\n            <p>11. المعلومات السرية</p>\n            <p>11. 1 أثناء عملك في الشركة ، سوف تكرس وقتك واهتمامك ومهارتك كلها بأفضل ما لديك من قدرات</p>\n            <p>عملها. لا يجوز لك ، بشكل مباشر أو غير مباشر ، الانخراط أو الارتباط بنفسك ، أو الارتباط به ، أو القلق ، أو التوظيف ، أو</p>\n            <p>الوقت أو متابعة أي دورة دراسية على الإطلاق ، دون الحصول على إذن مسبق من الشركة أو الانخراط في أي عمل آخر أو</p>\n            <p>الأنشطة أو أي وظيفة أخرى أو العمل بدوام جزئي أو متابعة أي دورة دراسية على الإطلاق ، دون إذن مسبق من</p>\n            <p>شركة.</p>\n            <p>11.2 يجب عليك دائمًا الحفاظ على أعلى درجة من السرية والحفاظ على سرية السجلات والوثائق وغيرها</p>\n            <p>المعلومات السرية المتعلقة بأعمال الشركة والتي قد تكون معروفة لك أو مخولة لك بأي وسيلة</p>\n            <p>ولن تستخدم هذه السجلات والمستندات والمعلومات إلا بالطريقة المصرح بها حسب الأصول لصالح الشركة. إلى عن على</p>\n            <p>أغراض هذا البند \"المعلومات السرية\" تعني المعلومات المتعلقة بأعمال الشركة وعملائها</p>\n            <p>التي لا تتوفر لعامة الناس والتي قد تتعلمها أثناء عملك. هذا يشمل،</p>\n            <p>على سبيل المثال لا الحصر ، المعلومات المتعلقة بالمنظمة وقوائم العملاء وسياسات التوظيف والموظفين والمعلومات</p>\n            <p>حول منتجات الشركة وعملياتها بما في ذلك الأفكار والمفاهيم والإسقاطات والتكنولوجيا والكتيبات والرسم والتصاميم ،</p>\n            <p>المواصفات وجميع الأوراق والسير الذاتية والسجلات والمستندات الأخرى التي تحتوي على هذه المعلومات السرية.</p>\n            <p>11.3 لن تقوم في أي وقت بإزالة أي معلومات سرية من المكتب دون إذن.</p>\n\n            <p>11.4 واجبك في الحماية وعدم الإفشاء</p>\n\n            <p>تظل المعلومات السرية سارية بعد انتهاء أو إنهاء هذه الاتفاقية و / أو عملك مع الشركة.</p>\n\n            <p>11.5 سوف يجعلك خرق شروط هذا البند عرضة للفصل بإجراءات موجزة بموجب الفقرة أعلاه بالإضافة إلى أي</p>\n\n            <p>أي تعويض آخر قد يكون للشركة ضدك في القانون.</p>\n\n            <p>12. الإخطارات</p>\n\n            <p>يجوز لك إرسال إخطارات إلى الشركة على عنوان مكتبها المسجل. يمكن أن ترسل لك الشركة إشعارات على</p>\n\n            <p>العنوان الذي أشرت إليه في السجلات الرسمية.</p>\n\n\n\n            <p>13. تطبيق سياسة الشركة</p>\n\n            <p>يحق للشركة تقديم إعلانات السياسة من وقت لآخر فيما يتعلق بمسائل مثل استحقاق الإجازة والأمومة</p>\n\n            <p>الإجازة ، ومزايا الموظفين ، وساعات العمل ، وسياسات النقل ، وما إلى ذلك ، ويمكن تغييرها من وقت لآخر وفقًا لتقديرها الخاص.</p>\n\n            <p>جميع قرارات سياسة الشركة هذه ملزمة لك ويجب أن تلغي هذه الاتفاقية إلى هذا الحد.</p>\n\n\n\n            <p>14. القانون الحاكم / الاختصاص القضائي</p>\n\n            <p>يخضع عملك في الشركة لقوانين الدولة. تخضع جميع النزاعات للاختصاص القضائي للمحكمة العليا</p>\n\n            <p>غوجارات فقط.</p>\n\n\n\n            <p>15. قبول عرضنا</p>\n\n            <p>يرجى تأكيد قبولك لعقد العمل هذا من خلال التوقيع وإعادة النسخة المكررة.</p>\n\n\n\n            <p>نرحب بكم ونتطلع إلى تلقي موافقتكم والعمل معكم.</p>\n\n\n\n            <p>تفضلوا بقبول فائق الاحترام،</p>\n\n            <p>{app_name}</p>\n\n            <p>{date}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(2, 'da', '<h3 style=\"text-align: center;\"><strong>Tilslutningsbrev</strong></h3>\n\n\n            <p>{date}</p>\n\n            <p>{employee_name}</p>\n\n            <p>{address}</p>\n\n            <p>Emne: Udn&aelig;vnelse til stillingen som {designation}</p>\n\n\n\n\n\n\n\n            <p>K&aelig;re {employee_name}</p>\n\n\n\n            <p>Vi er glade for at kunne tilbyde dig stillingen som {designation} hos {app_name} \"Virksomheden\" p&aring; f&oslash;lgende vilk&aring;r og</p>\n\n            <p>betingelser:</p>\n\n\n            <p>1. P&aring;begyndelse af ans&aelig;ttelse</p>\n\n            <p>Din ans&aelig;ttelse tr&aelig;der i kraft fra {start_date}</p>\n\n\n\n            <p>2. Jobtitel</p>\n\n\n            <p>Din jobtitel vil v&aelig;re {designation}.</p>\n\n\n\n            <p>3. L&oslash;n</p>\n\n            <p>Din l&oslash;n og andre goder vil v&aelig;re som angivet i skema 1, hertil.</p>\n\n\n\n            <p>4. Udstationeringssted</p>\n\n            <p>Du vil blive sl&aring;et op p&aring; {branch}. Du kan dog blive bedt om at arbejde p&aring; ethvert forretningssted, som virksomheden har, eller</p>\n\n            <p>senere kan erhverve.</p>\n\n\n            <p>5. Arbejdstimer</p>\n\n            <p>De normale arbejdsdage er mandag til fredag. Du vil blive forpligtet til at arbejde i de timer, som er n&oslash;dvendige for</p>\n\n            <p>beh&oslash;rig varetagelse af dine pligter over for virksomheden. Den normale arbejdstid er fra {start_time} til {end_time}, og det er du</p>\n\n            <p>forventes at arbejde ikke mindre end {total_hours} timer hver uge, og om n&oslash;dvendigt yderligere timer afh&aelig;ngigt af din</p>\n\n            <p>ansvar.</p>\n\n\n\n            <p>6. Orlov/Ferie</p>\n\n            <p>6.1 Du har ret til tilf&aelig;ldig ferie p&aring; 12 dage.</p>\n\n            <p>6.2 Du har ret til 12 arbejdsdages sygefrav&aelig;r med l&oslash;n.</p>\n\n            <p>6.3 Virksomheden skal meddele en liste over erkl&aelig;rede helligdage i begyndelsen af ​​hvert &aring;r.</p>\n\n\n\n            <p>7. Arbejdsopgavernes art</p>\n\n            <p>Du vil efter bedste evne udf&oslash;re alle de opgaver, der er iboende i din stilling og s&aring;danne yderligere opgaver som virksomheden</p>\n\n            <p>kan opfordre dig til at optr&aelig;de, fra tid til anden. Dine specifikke pligter er beskrevet i skema II hertil.</p>\n\n\n            <p>8. Firmaejendom</p>\n\n            <p>Du vil altid vedligeholde virksomhedens ejendom i god stand, som kan blive overdraget til dig til officiel brug i l&oslash;bet af</p>\n\n            <p>din ans&aelig;ttelse, og skal returnere al s&aring;dan ejendom til virksomheden, f&oslash;r du opgiver din afgift, i modsat fald vil omkostningerne</p>\n\n            <p>af samme vil blive inddrevet fra dig af virksomheden.</p>\n\n\n\n            <p>9. L&aring;n/modtagelse af gaver</p>\n\n            <p>Du vil ikke l&aring;ne eller acceptere nogen penge, gave, bel&oslash;nning eller kompensation for dine personlige gevinster fra eller p&aring; anden m&aring;de placere dig selv</p>\n\n            <p>under en &oslash;konomisk forpligtelse over for enhver person/kunde, som du m&aring;tte have officielle forbindelser med.</p>\n\n            <p>10. Opsigelse</p>\n\n            <p>10.1 Din ans&aelig;ttelse kan opsiges af virksomheden uden nogen grund ved at give dig mindst [varsel] m&aring;neder f&oslash;r</p>\n\n            <p>skriftligt varsel eller l&oslash;n i stedet herfor. Ved l&oslash;n forst&aring;s i denne paragraf grundl&oslash;n.</p>\n\n            <p>10.2 Du kan opsige dit ans&aelig;ttelsesforhold i virksomheden uden nogen grund ved at give mindst [Medarbejdermeddelelse]</p>\n\n            <p>m&aring;neders forudg&aring;ende varsel eller l&oslash;n for den ikke-opsparede periode, tilbage efter regulering af afventende orlov, som p&aring; dato.</p>\n\n            <p>10.3 Virksomheden forbeholder sig retten til at opsige dit ans&aelig;ttelsesforhold midlertidigt uden opsigelsesfrist eller opsigelsesbetaling</p>\n\n            <p>hvis den har rimelig grund til at tro, at du er skyldig i forseelse eller uagtsomhed, eller har beg&aring;et et grundl&aelig;ggende brud p&aring;</p>\n\n            <p>kontrakt, eller for&aring;rsaget tab for virksomheden.</p>\n\n            <p>10. 4 Ved oph&oslash;r af din ans&aelig;ttelse uanset &aring;rsag, vil du returnere al ejendom til virksomheden; dokumenter, og</p>\n\n            <p>papir, b&aring;de originale og kopier heraf, inklusive pr&oslash;ver, litteratur, kontrakter, optegnelser, lister, tegninger, tegninger,</p>\n\n            <p>breve, notater, data og lignende; og fortrolige oplysninger, i din besiddelse eller under din kontrol vedr&oslash;rende din</p>\n\n            <p>ans&aelig;ttelse eller til kunders forretningsforhold.</p>\n            <p>11. Fortrolige oplysninger</p>\n\n            <p>11. 1 Under din ans&aelig;ttelse i virksomheden vil du bruge al din tid, opm&aelig;rksomhed og dygtighed efter bedste evne til</p>\n\n            <p>sin virksomhed. Du m&aring; ikke, direkte eller indirekte, engagere eller associere dig med, v&aelig;re forbundet med, bekymret, ansat eller</p>\n\n            <p>tid eller forf&oslash;lge et hvilket som helst studieforl&oslash;b uden forudg&aring;ende tilladelse fra virksomheden. involveret i anden virksomhed eller</p>\n\n            <p>aktiviteter eller enhver anden stilling eller arbejde p&aring; deltid eller forf&oslash;lge ethvert studieforl&oslash;b uden forudg&aring;ende tilladelse fra</p>\n\n            <p>Selskab.</p>\n            <p>11.2 Du skal altid opretholde den h&oslash;jeste grad af fortrolighed og opbevare optegnelser, dokumenter og andre fortrolige oplysninger.</p>\n\n            <p>Fortrolige oplysninger vedr&oslash;rende virksomhedens virksomhed, som kan v&aelig;re kendt af dig eller betroet dig p&aring; nogen m&aring;de</p>\n\n            <p>og du vil kun bruge s&aring;danne optegnelser, dokumenter og oplysninger p&aring; en beh&oslash;rigt autoriseret m&aring;de i virksomhedens interesse. Til</p>\n\n            <p>form&aring;lene med denne paragraf \"Fortrolige oplysninger\" betyder oplysninger om virksomhedens og dets kunders forretning</p>\n\n            <p>som ikke er tilg&aelig;ngelig for offentligheden, og som du kan l&aelig;re i l&oslash;bet af din ans&aelig;ttelse. Dette inkluderer,</p>\n\n            <p>men er ikke begr&aelig;nset til information vedr&oslash;rende organisationen, dens kundelister, ans&aelig;ttelsespolitikker, personale og information</p>\n\n            <p>om virksomhedens produkter, processer, herunder ideer, koncepter, projektioner, teknologi, manualer, tegning, design,</p>\n\n            <p>specifikationer og alle papirer, CVer, optegnelser og andre dokumenter, der indeholder s&aring;danne fortrolige oplysninger.</p>\n\n            <p>11.3 Du vil p&aring; intet tidspunkt fjerne fortrolige oplysninger fra kontoret uden tilladelse.</p>\n\n            <p>11.4 Din pligt til at beskytte og ikke oplyse</p>\n\n            <p>e Fortrolige oplysninger vil overleve udl&oslash;bet eller opsigelsen af ​​denne aftale og/eller din ans&aelig;ttelse hos virksomheden.</p>\n\n            <p>11.5 Overtr&aelig;delse af betingelserne i denne klausul vil g&oslash;re dig ansvarlig for midlertidig afskedigelse i henhold til klausulen ovenfor ud over evt.</p>\n\n            <p>andre retsmidler, som virksomheden m&aring;tte have mod dig i henhold til loven.</p>\n            <p>12. Meddelelser</p>\n\n            <p>Meddelelser kan gives af dig til virksomheden p&aring; dets registrerede kontoradresse. Meddelelser kan gives af virksomheden til dig p&aring;</p>\n\n            <p>den adresse, du har angivet i de officielle optegnelser.</p>\n\n\n\n            <p>13. Anvendelse af virksomhedens politik</p>\n\n            <p>Virksomheden er berettiget til fra tid til anden at afgive politiske erkl&aelig;ringer vedr&oslash;rende sager som ret til orlov, barsel</p>\n\n            <p>orlov, ansattes ydelser, arbejdstider, overf&oslash;rselspolitikker osv., og kan &aelig;ndre det samme fra tid til anden efter eget sk&oslash;n.</p>\n\n            <p>Alle s&aring;danne politiske beslutninger fra virksomheden er bindende for dig og tilsides&aelig;tter denne aftale i det omfang.</p>\n\n\n\n            <p>14. G&aelig;ldende lov/Jurisdiktion</p>\n\n            <p>Din ans&aelig;ttelse hos virksomheden er underlagt landets love. Alle tvister er underlagt High Courts jurisdiktion</p>\n\n            <p>Kun Gujarat.</p>\n\n\n\n            <p>15. Accept af vores tilbud</p>\n\n            <p>Bekr&aelig;ft venligst din accept af denne ans&aelig;ttelseskontrakt ved at underskrive og returnere kopien.</p>\n\n\n\n            <p>Vi byder dig velkommen og ser frem til at modtage din accept og til at arbejde sammen med dig.</p>\n\n\n\n            <p>Venlig hilsen,</p>\n\n            <p>{app_name}</p>\n\n            <p>{date}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(3, 'de', '<h3 style=\"text-align: center;\"><strong>Beitrittsbrief</strong></h3>\n\n            <p>{date}</p>\n            <p>{employee_name}</p>\n            <p>{address}</p>\n\n\n\n            <p>Betreff: Ernennung f&uuml;r die Stelle von {designation}</p>\n\n\n\n\n\n\n\n            <p>Sehr geehrter {employee_name},</p>\n\n\n\n            <p>Wir freuen uns, Ihnen die Position von {designation} bei {app_name} dem &bdquo;Unternehmen&ldquo; zu den folgenden Bedingungen anbieten zu k&ouml;nnen</p>\n\n            <p>Bedingungen:</p>\n\n\n            <p>1. Aufnahme des Arbeitsverh&auml;ltnisses</p>\n\n            <p>Ihre Anstellung gilt ab dem {start_date}</p>\n\n\n            <p>2. Berufsbezeichnung</p>\n\n            <p>Ihre Berufsbezeichnung lautet {designation}.</p>\n\n\n            <p>3. Gehalt</p>\n\n            <p>Ihr Gehalt und andere Leistungen sind in Anhang 1 zu diesem Dokument aufgef&uuml;hrt.</p>\n\n\n            <p>4. Postort</p>\n\n            <p>Sie werden bei {branch} eingestellt. Es kann jedoch erforderlich sein, dass Sie an jedem Gesch&auml;ftssitz arbeiten, den das Unternehmen hat, oder</p>\n\n            <p>sp&auml;ter erwerben kann.</p>\n\n\n            <p>5. Arbeitszeit</p>\n            <p>Die normalen Arbeitstage sind Montag bis Freitag. Sie m&uuml;ssen so viele Stunden arbeiten, wie es f&uuml;r die erforderlich ist</p>\n            <p>ordnungsgem&auml;&szlig;e Erf&uuml;llung Ihrer Pflichten gegen&uuml;ber dem Unternehmen. Die normalen Arbeitszeiten sind von {start_time} bis {end_time} und Sie sind es</p>\n            <p>voraussichtlich nicht weniger als {total_hours} Stunden pro Woche arbeiten, und falls erforderlich, abh&auml;ngig von Ihren zus&auml;tzlichen Stunden</p>\n            <p>Verantwortlichkeiten.</p>\n\n\n\n            <p>6. Urlaub/Urlaub</p>\n\n            <p>6.1 Sie haben Anspruch auf Freizeiturlaub von 12 Tagen.</p>\n\n            <p>6.2 Sie haben Anspruch auf 12 Arbeitstage bezahlten Krankenurlaub.</p>\n\n            <p>6.3 Das Unternehmen teilt zu Beginn jedes Jahres eine Liste der erkl&auml;rten Feiertage mit.</p>\n\n\n\n            <p>7. Art der Pflichten</p>\n\n            <p>Sie werden alle Aufgaben, die mit Ihrer Funktion verbunden sind, sowie alle zus&auml;tzlichen Aufgaben als Unternehmen nach besten Kr&auml;ften erf&uuml;llen</p>\n\n            <p>kann Sie von Zeit zu Zeit zur Leistung auffordern. Ihre spezifischen Pflichten sind in Anhang II zu diesem Dokument aufgef&uuml;hrt.</p>\n\n\n\n            <p>8. Firmeneigentum</p>\n\n            <p>Sie werden das Firmeneigentum, das Ihnen im Laufe der Zeit f&uuml;r offizielle Zwecke anvertraut werden kann, stets in gutem Zustand halten</p>\n\n            <p>Ihrer Anstellung und muss all dieses Eigentum an das Unternehmen zur&uuml;ckgeben, bevor Sie Ihre Geb&uuml;hr aufgeben, andernfalls die Kosten</p>\n\n            <p>derselben werden von der Gesellschaft von Ihnen zur&uuml;ckgefordert.</p>\n\n\n\n            <p>9. Leihen/Annehmen von Geschenken</p>\n\n            <p>Sie werden kein Geld, Geschenk, keine Belohnung oder Entsch&auml;digung f&uuml;r Ihre pers&ouml;nlichen Gewinne von sich leihen oder annehmen oder sich anderweitig platzieren</p>\n\n            <p>unter finanzieller Verpflichtung gegen&uuml;ber Personen/Kunden, mit denen Sie m&ouml;glicherweise dienstliche Beziehungen unterhalten.</p>\n\n            <p>10. K&uuml;ndigung</p>\n\n            <p>10.1 Ihre Ernennung kann vom Unternehmen ohne Angabe von Gr&uuml;nden gek&uuml;ndigt werden, indem es Ihnen mindestens [K&uuml;ndigung] Monate im Voraus mitteilt</p>\n\n            <p>schriftliche K&uuml;ndigung oder Gehalt statt dessen. Gehalt im Sinne dieser Klausel bedeutet Grundgehalt.</p>\n\n            <p>10.2 Sie k&ouml;nnen Ihre Anstellung beim Unternehmen ohne Angabe von Gr&uuml;nden k&uuml;ndigen, indem Sie mindestens [Mitarbeitermitteilung]</p>\n\n            <p>K&uuml;ndigungsfrist von Monaten oder Gehalt f&uuml;r den nicht angesparten Zeitraum, der nach Anpassung der anstehenden Urlaubstage &uuml;brig bleibt, zum Stichtag.</p>\n\n            <p>10.3 Das Unternehmen beh&auml;lt sich das Recht vor, Ihr Arbeitsverh&auml;ltnis ohne K&uuml;ndigungsfrist oder Abfindungszahlung fristlos zu k&uuml;ndigen</p>\n\n            <p>wenn es begr&uuml;ndeten Anlass zu der Annahme gibt, dass Sie sich eines Fehlverhaltens oder einer Fahrl&auml;ssigkeit schuldig gemacht haben oder einen wesentlichen Versto&szlig; begangen haben</p>\n\n            <p>oder dem Unternehmen Verluste verursacht haben.</p>\n\n            <p>10. 4 Bei Beendigung Ihres Besch&auml;ftigungsverh&auml;ltnisses, aus welchem ​​Grund auch immer, werden Sie s&auml;mtliches Eigentum an das Unternehmen zur&uuml;ckgeben; Dokumente und</p>\n\n            <p>Papier, sowohl Original als auch Kopien davon, einschlie&szlig;lich aller Muster, Literatur, Vertr&auml;ge, Aufzeichnungen, Listen, Zeichnungen, Blaupausen,</p>\n\n            <p>Briefe, Notizen, Daten und dergleichen; und vertrauliche Informationen, die sich in Ihrem Besitz oder unter Ihrer Kontrolle befinden und sich auf Sie beziehen</p>\n\n            <p>Besch&auml;ftigung oder f&uuml;r die gesch&auml;ftlichen Angelegenheiten der Kunden.</p>\n\n            <p>11. Confidential Information</p>\n\n            <p>11. 1 During your employment with the Company you will devote your whole time, attention, and skill to the best of your ability for</p>\n\n            <p>its business. You shall not, directly or indirectly, engage or associate yourself with, be connected with, concerned, employed, or</p>\n\n            <p>time or pursue any course of study whatsoever, without the prior permission of the Company.engaged in any other business or</p>\n\n            <p>activities or any other post or work part-time or pursue any course of study whatsoever, without the prior permission of the</p>\n\n            <p>Company.</p>\n\n            <p>11.2 You must always maintain the highest degree of confidentiality and keep as confidential the records, documents, and other&nbsp;</p>\n\n            <p>Confidential Information relating to the business of the Company which may be known to you or confided in you by any means</p>\n\n            <p>and you will use such records, documents and information only in a duly authorized manner in the interest of the Company. For</p>\n\n            <p>the purposes of this clause &lsquo;Confidential Information&rsquo; means information about the Company&rsquo;s business and that of its customers</p>\n\n            <p>which is not available to the general public and which may be learned by you in the course of your employment. This includes,</p>\n\n            <p>but is not limited to, information relating to the organization, its customer lists, employment policies, personnel, and information</p>\n\n            <p>about the Company&rsquo;s products, processes including ideas, concepts, projections, technology, manuals, drawing, designs,&nbsp;</p>\n\n            <p>specifications, and all papers, resumes, records and other documents containing such Confidential Information.</p>\n\n            <p>11.3 At no time, will you remove any Confidential Information from the office without permission.</p>\n\n            <p>11.4 Your duty to safeguard and not disclos</p>\n\n            <p>e Confidential Information will survive the expiration or termination of this Agreement and/or your employment with the Company.</p>\n\n            <p>11.5 Breach of the conditions of this clause will render you liable to summary dismissal under the clause above in addition to any</p>\n\n            <p>other remedy the Company may have against you in law.</p>\n            <p>12. Notices</p>\n\n            <p>Notices may be given by you to the Company at its registered office address. Notices may be given by the Company to you at</p>\n\n            <p>the address intimated by you in the official records.</p>\n\n\n\n            <p>13. Applicability of Company Policy</p>\n\n            <p>The Company shall be entitled to make policy declarations from time to time pertaining to matters like leave entitlement,maternity</p>\n\n            <p>leave, employees&rsquo; benefits, working hours, transfer policies, etc., and may alter the same from time to time at its sole discretion.</p>\n\n            <p>All such policy decisions of the Company shall be binding on you and shall override this Agreement to that&nbsp; extent.</p>\n\n\n\n            <p>14. Governing Law/Jurisdiction</p>\n\n            <p>Your employment with the Company is subject to Country laws. All disputes shall be subject to the jurisdiction of High Court</p>\n\n            <p>Gujarat only.</p>\n\n\n\n            <p>15. Acceptance of our offer</p>\n\n            <p>Please confirm your acceptance of this Contract of Employment by signing and returning the duplicate copy.</p>\n\n\n\n            <p>We welcome you and look forward to receiving your acceptance and to working with you.</p>\n\n\n\n            <p>Yours Sincerely,</p>\n\n            <p>{app_name}</p>\n\n            <p>{date}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(4, 'en', '<h3 style=\"text-align: center;\">Joining Letter</h3>\n            <p>{date}</p>\n            <p>{employee_name}</p>\n            <p>{address}</p>\n            <p>Subject: Appointment for the post of {designation}</p>\n            <p>Dear {employee_name},</p>\n            <p>We are pleased to offer you the position of {designation} with {app_name} theCompany on the following terms and</p>\n            <p>conditions:</p>\n            <p>1. Commencement of employment</p>\n            <p>Your employment will be effective, as of {start_date}</p>\n            <p>2. Job title</p>\n            <p>Your job title will be{designation}.</p>\n            <p>3. Salary</p>\n            <p>Your salary and other benefits will be as set out in Schedule 1, hereto.</p>\n            <p>4. Place of posting</p>\n            <p>You will be posted at {branch}. You may however be required to work at any place of business which the Company has, or</p>\n            <p>may later acquire.</p>\n            <p>5. Hours of Work</p>\n            <p>The normal working days are Monday through Friday. You will be required to work for such hours as necessary for the</p>\n            <p>proper discharge of your duties to the Company. The normal working hours are from {start_time} to {end_time} and you are</p>\n            <p>expected to work not less than {total_hours} hours each week, and if necessary for additional hours depending on your</p>\n            <p>responsibilities.</p>\n            <p>6. Leave/Holidays</p>\n            <p>6.1 You are entitled to casual leave of 12 days.</p>\n            <p>6.2 You are entitled to 12 working days of paid sick leave.</p>\n            <p>6.3 The Company shall notify a list of declared holidays at the beginning of each year.</p>\n            <p>7. Nature of duties</p>\n            <p>You will perform to the best of your ability all the duties as are inherent in your post and such additional duties as the company</p>\n            <p>may call upon you to perform, from time to time. Your specific duties are set out in Schedule II hereto.</p>\n            <p>8. Company property</p>\n            <p>You will always maintain in good condition Company property, which may be entrusted to you for official use during the course of</p>\n            <p>your employment, and shall return all such property to the Company prior to relinquishment of your charge, failing which the cost</p>\n            <p>of the same will be recovered from you by the Company.</p>\n            <p>9. Borrowing/accepting gifts</p>\n            <p>You will not borrow or accept any money, gift, reward, or compensation for your personal gains from or otherwise place yourself</p>\n            <p>under pecuniary obligation to any person/client with whom you may be having official dealings.</p>\n            <p>10. Termination</p>\n            <p>10.1 Your appointment can be terminated by the Company, without any reason, by giving you not less than [Notice] months prior</p>\n            <p>notice in writing or salary in lieu thereof. For the purpose of this clause, salary shall mean basic salary.</p>\n            <p>10.2 You may terminate your employment with the Company, without any cause, by giving no less than [Employee Notice]</p>\n            <p>months prior notice or salary for the unsaved period, left after adjustment of pending leaves, as on date.</p>\n            <p>10.3 The Company reserves the right to terminate your employment summarily without any notice period or termination payment</p>\n            <p>if it has reasonable ground to believe you are guilty of misconduct or negligence, or have committed any fundamental breach of</p>\n            <p>contract, or caused any loss to the Company.</p>\n            <p>10. 4 On the termination of your employment for whatever reason, you will return to the Company all property; documents, and</p>\n            <p>paper, both original and copies thereof, including any samples, literature, contracts, records, lists, drawings, blueprints,</p>\n            <p>letters, notes, data and the like; and Confidential Information, in your possession or under your control relating to your</p>\n            <p>employment or to clients business affairs.</p>\n            <p>11. Confidential Information</p>\n            <p>11. 1 During your employment with the Company you will devote your whole time, attention, and skill to the best of your ability for</p>\n            <p>its business. You shall not, directly or indirectly, engage or associate yourself with, be connected with, concerned, employed, or</p>\n            <p>time or pursue any course of study whatsoever, without the prior permission of the Company.engaged in any other business or</p>\n            <p>activities or any other post or work part-time or pursue any course of study whatsoever, without the prior permission of the</p>\n            <p>Company.</p>\n            <p>11.2 You must always maintain the highest degree of confidentiality and keep as confidential the records, documents, and other</p>\n            <p>Confidential Information relating to the business of the Company which may be known to you or confided in you by any means</p>\n            <p>and you will use such records, documents and information only in a duly authorized manner in the interest of the Company. For</p>\n            <p>the purposes of this clauseConfidential Information means information about the Companys business and that of its customers</p>\n            <p>which is not available to the general public and which may be learned by you in the course of your employment. This includes,</p>\n            <p>but is not limited to, information relating to the organization, its customer lists, employment policies, personnel, and information</p>\n            <p>about the Companys products, processes including ideas, concepts, projections, technology, manuals, drawing, designs,</p>\n            <p>specifications, and all papers, resumes, records and other documents containing such Confidential Information.</p>\n            <p>11.3 At no time, will you remove any Confidential Information from the office without permission.</p>\n            <p>11.4 Your duty to safeguard and not disclos</p>\n            <p>e Confidential Information will survive the expiration or termination of this Agreement and/or your employment with the Company.</p>\n            <p>11.5 Breach of the conditions of this clause will render you liable to summary dismissal under the clause above in addition to any</p>\n            <p>other remedy the Company may have against you in law.</p>\n            <p>12. Notices</p>\n            <p>Notices may be given by you to the Company at its registered office address. Notices may be given by the Company to you at</p>\n            <p>the address intimated by you in the official records.</p>\n            <p>13. Applicability of Company Policy</p>\n            <p>The Company shall be entitled to make policy declarations from time to time pertaining to matters like leave entitlement,maternity</p>\n            <p>leave, employees benefits, working hours, transfer policies, etc., and may alter the same from time to time at its sole discretion.</p>\n            <p>All such policy decisions of the Company shall be binding on you and shall override this Agreement to that extent.</p>\n            <p>14. Governing Law/Jurisdiction</p>\n            <p>Your employment with the Company is subject to Country laws. All disputes shall be subject to the jurisdiction of High Court</p>\n            <p>Gujarat only.</p>\n            <p>15. Acceptance of our offer</p>\n            <p>Please confirm your acceptance of this Contract of Employment by signing and returning the duplicate copy.</p>\n            <p>We welcome you and look forward to receiving your acceptance and to working with you.</p>\n            <p>Yours Sincerely,</p>\n            <p>{app_name}</p>\n            <p>{date}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(5, 'es', '<h3 style=\"text-align: center;\"><strong>Carta de uni&oacute;n</strong></h3>\n\n\n            <p>{date}</p>\n\n            <p>{employee_name}</p>\n\n            <p>{address}</p>\n\n\n\n            <p>Asunto: Nombramiento para el puesto de {designation}</p>\n\n\n\n            <p>Estimado {employee_name},</p>\n\n            <p>Nos complace ofrecerle el puesto de {designation} con {app_name}, la Compa&ntilde;&iacute;a en los siguientes t&eacute;rminos y</p>\n\n            <p>condiciones:</p>\n\n\n            <p>1. Comienzo del empleo</p>\n\n            <p>Su empleo ser&aacute; efectivo a partir del {start_date}</p>\n\n\n            <p>2. T&iacute;tulo del trabajo</p>\n            <p>El t&iacute;tulo de su trabajo ser&aacute; {designation}.</p>\n\n            <p>3. Salario</p>\n\n            <p>Su salario y otros beneficios ser&aacute;n los establecidos en el Anexo 1 del presente.</p>\n\n\n            <p>4. Lugar de destino</p>\n            <p>Se le publicar&aacute; en {branch}. Sin embargo, es posible que deba trabajar en cualquier lugar de negocios que tenga la Compa&ntilde;&iacute;a, o</p>\n\n            <p>puede adquirir posteriormente.</p>\n\n\n\n            <p>5. Horas de trabajo</p>\n\n            <p>Los d&iacute;as normales de trabajo son de lunes a viernes. Se le pedir&aacute; que trabaje las horas que sean necesarias para el</p>\n\n            <p>cumplimiento adecuado de sus deberes para con la Compa&ntilde;&iacute;a. El horario normal de trabajo es de {start_time} a {end_time} y usted est&aacute;</p>\n\n            <p>se espera que trabaje no menos de {total_hours} horas cada semana y, si es necesario, horas adicionales dependiendo de su</p>\n\n            <p>responsabilidades.</p>\n\n\n\n            <p>6. Licencia/Vacaciones</p>\n\n            <p>6.1 Tiene derecho a un permiso eventual de 12 d&iacute;as.</p>\n\n            <p>6.2 Tiene derecho a 12 d&iacute;as laborables de baja por enfermedad remunerada.</p>\n\n            <p>6.3 La Compa&ntilde;&iacute;a deber&aacute; notificar una lista de d&iacute;as festivos declarados al comienzo de cada a&ntilde;o.</p>\n\n\n\n            <p>7. Naturaleza de los deberes</p>\n\n            <p>Desempe&ntilde;ar&aacute; lo mejor que pueda todas las funciones inherentes a su puesto y aquellas funciones adicionales que la empresa</p>\n\n            <p>puede pedirte que act&uacute;es, de vez en cuando. Sus deberes espec&iacute;ficos se establecen en el Anexo II del presente.</p>\n\n\n\n            <p>8. Propiedad de la empresa</p>\n\n            <p>Siempre mantendr&aacute; en buenas condiciones la propiedad de la Compa&ntilde;&iacute;a, que se le puede confiar para uso oficial durante el curso de</p>\n\n            <p>su empleo, y devolver&aacute; todos esos bienes a la Compa&ntilde;&iacute;a antes de renunciar a su cargo, en caso contrario, el costo</p>\n\n            <p>de la misma ser&aacute; recuperada de usted por la Compa&ntilde;&iacute;a.</p>\n\n\n\n            <p>9. Tomar prestado/aceptar regalos</p>\n\n            <p>No pedir&aacute; prestado ni aceptar&aacute; dinero, obsequios, recompensas o compensaciones por sus ganancias personales o se colocar&aacute; de otra manera</p>\n\n            <p>bajo obligaci&oacute;n pecuniaria a cualquier persona/cliente con quien pueda tener tratos oficiales.</p>\n            <p>10. Terminaci&oacute;n</p>\n\n            <p>10.1 Su nombramiento puede ser rescindido por la Compa&ntilde;&iacute;a, sin ning&uacute;n motivo, al darle no menos de [Aviso] meses antes</p>\n\n            <p>aviso por escrito o salario en su lugar. Para los efectos de esta cl&aacute;usula, se entender&aacute; por salario el salario base.</p>\n\n            <p>10.2 Puede rescindir su empleo con la Compa&ntilde;&iacute;a, sin ninguna causa, dando no menos de [Aviso al empleado]</p>\n\n            <p>meses de preaviso o salario por el per&iacute;odo no ahorrado, remanente despu&eacute;s del ajuste de licencias pendientes, a la fecha.</p>\n\n            <p>10.3 La Compa&ntilde;&iacute;a se reserva el derecho de rescindir su empleo sumariamente sin ning&uacute;n per&iacute;odo de preaviso o pago por rescisi&oacute;n</p>\n\n            <p>si tiene motivos razonables para creer que usted es culpable de mala conducta o negligencia, o ha cometido una violaci&oacute;n fundamental de</p>\n\n            <p>contrato, o causado cualquier p&eacute;rdida a la Compa&ntilde;&iacute;a.</p>\n\n            <p>10. 4 A la terminaci&oacute;n de su empleo por cualquier motivo, devolver&aacute; a la Compa&ntilde;&iacute;a todos los bienes; documentos, y</p>\n\n            <p>papel, tanto en original como en copia del mismo, incluyendo cualquier muestra, literatura, contratos, registros, listas, dibujos, planos,</p>\n\n            <p>cartas, notas, datos y similares; e Informaci&oacute;n confidencial, en su posesi&oacute;n o bajo su control en relaci&oacute;n con su</p>\n\n            <p>empleo o a los asuntos comerciales de los clientes.</p>\n            <p>11. Informaci&oacute;n confidencial</p>\n\n            <p>11. 1 Durante su empleo en la Compa&ntilde;&iacute;a, dedicar&aacute; todo su tiempo, atenci&oacute;n y habilidad lo mejor que pueda para</p>\n\n            <p>son negocios. Usted no deber&aacute;, directa o indirectamente, comprometerse o asociarse con, estar conectado, interesado, empleado o</p>\n\n            <p>tiempo o seguir cualquier curso de estudio, sin el permiso previo de la Compa&ntilde;&iacute;a. participar en cualquier otro negocio o</p>\n\n            <p>actividades o cualquier otro puesto o trabajo a tiempo parcial o seguir cualquier curso de estudio, sin el permiso previo de la</p>\n\n            <p>Compa&ntilde;&iacute;a.</p>\n\n            <p>11.2 Siempre debe mantener el m&aacute;s alto grado de confidencialidad y mantener como confidenciales los registros, documentos y otros</p>\n\n            <p>Informaci&oacute;n confidencial relacionada con el negocio de la Compa&ntilde;&iacute;a que usted pueda conocer o confiarle por cualquier medio</p>\n\n            <p>y utilizar&aacute; dichos registros, documentos e informaci&oacute;n solo de manera debidamente autorizada en inter&eacute;s de la Compa&ntilde;&iacute;a. Para</p>\n\n            <p>A los efectos de esta cl&aacute;usula, \"Informaci&oacute;n confidencial\" significa informaci&oacute;n sobre el negocio de la Compa&ntilde;&iacute;a y el de sus clientes.</p>\n\n            <p>que no est&aacute; disponible para el p&uacute;blico en general y que usted puede aprender en el curso de su empleo. Esto incluye,</p>\n\n            <p>pero no se limita a, informaci&oacute;n relacionada con la organizaci&oacute;n, sus listas de clientes, pol&iacute;ticas de empleo, personal e informaci&oacute;n</p>\n\n            <p>sobre los productos de la Compa&ntilde;&iacute;a, procesos que incluyen ideas, conceptos, proyecciones, tecnolog&iacute;a, manuales, dibujos, dise&ntilde;os,</p>\n\n            <p>especificaciones, y todos los papeles, curr&iacute;culos, registros y otros documentos que contengan dicha Informaci&oacute;n Confidencial.</p>\n\n            <p>11.3 En ning&uacute;n momento, sacar&aacute; ninguna Informaci&oacute;n Confidencial de la oficina sin permiso.</p>\n\n            <p>11.4 Su deber de salvaguardar y no divulgar</p>\n\n            <p>La Informaci&oacute;n Confidencial sobrevivir&aacute; a la expiraci&oacute;n o terminaci&oacute;n de este Acuerdo y/o su empleo con la Compa&ntilde;&iacute;a.</p>\n\n            <p>11.5 El incumplimiento de las condiciones de esta cl&aacute;usula le har&aacute; pasible de despido sumario en virtud de la cl&aacute;usula anterior adem&aacute;s de cualquier</p>\n\n            <p>otro recurso que la Compa&ntilde;&iacute;a pueda tener contra usted por ley.</p>\n            <p>12. Avisos</p>\n\n            <p>Usted puede enviar notificaciones a la Compa&ntilde;&iacute;a a su domicilio social. La Compa&ntilde;&iacute;a puede enviarle notificaciones a usted en</p>\n\n            <p>la direcci&oacute;n indicada por usted en los registros oficiales.</p>\n\n\n\n            <p>13. Aplicabilidad de la pol&iacute;tica de la empresa</p>\n\n            <p>La Compa&ntilde;&iacute;a tendr&aacute; derecho a hacer declaraciones de pol&iacute;tica de vez en cuando relacionadas con asuntos como el derecho a licencia, maternidad</p>\n\n            <p>licencia, beneficios de los empleados, horas de trabajo, pol&iacute;ticas de transferencia, etc., y puede modificarlas de vez en cuando a su sola discreci&oacute;n.</p>\n\n            <p>Todas las decisiones pol&iacute;ticas de la Compa&ntilde;&iacute;a ser&aacute;n vinculantes para usted y anular&aacute;n este Acuerdo en esa medida.</p>\n\n\n\n            <p>14. Ley aplicable/Jurisdicci&oacute;n</p>\n\n            <p>Su empleo con la Compa&ntilde;&iacute;a est&aacute; sujeto a las leyes del Pa&iacute;s. Todas las disputas estar&aacute;n sujetas a la jurisdicci&oacute;n del Tribunal Superior</p>\n\n            <p>S&oacute;lo Gujarat.</p>\n\n\n\n            <p>15. Aceptaci&oacute;n de nuestra oferta</p>\n\n            <p>Por favor, confirme su aceptaci&oacute;n de este Contrato de Empleo firmando y devolviendo el duplicado.</p>\n\n\n\n            <p>Le damos la bienvenida y esperamos recibir su aceptaci&oacute;n y trabajar con usted.</p>\n\n\n\n            <p>Tuyo sinceramente,</p>\n\n            <p>{app_name}</p>\n\n            <p>{date}</p>\n            ', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40');
INSERT INTO `joining_letters` (`id`, `lang`, `content`, `workspace`, `created_by`, `created_at`, `updated_at`) VALUES
(6, 'fr', '<h3 style=\"text-align: center;\">Lettre dadh&eacute;sion</h3>\n\n\n            <p>{date}</p>\n\n            <p>{employee_name}</p>\n            <p>{address}</p>\n\n\n            <p>Objet : Nomination pour le poste de {designation}</p>\n\n\n\n            <p>Cher {employee_name},</p>\n\n\n            <p>Nous sommes heureux de vous proposer le poste de {designation} avec {app_name} la \"Soci&eacute;t&eacute;\" selon les conditions suivantes et</p>\n\n            <p>les conditions:</p>\n\n            <p>1. Entr&eacute;e en fonction</p>\n\n            <p>Votre emploi sera effectif &agrave; partir du {start_date}</p>\n\n\n\n            <p>2. Intitul&eacute; du poste</p>\n\n            <p>Votre titre de poste sera {designation}.</p>\n\n\n\n            <p>3. Salaire</p>\n\n            <p>Votre salaire et vos autres avantages seront tels quindiqu&eacute;s &agrave; lannexe 1 ci-jointe.</p>\n\n\n            <p>4. Lieu de d&eacute;tachement</p>\n            <p>Vous serez affect&eacute; &agrave; {branch}. Vous pouvez cependant &ecirc;tre tenu de travailler dans nimporte quel lieu daffaires que la Soci&eacute;t&eacute; a, ou</p>\n\n            <p>pourra acqu&eacute;rir plus tard.</p>\n\n\n\n            <p>5. Heures de travail</p>\n\n            <p>Les jours ouvrables normaux sont du lundi au vendredi. Vous devrez travailler les heures n&eacute;cessaires &agrave; la</p>\n\n            <p>lexercice correct de vos fonctions envers la Soci&eacute;t&eacute;. Les heures normales de travail vont de {start_time} &agrave; {end_time} et vous &ecirc;tes</p>\n\n            <p>devrait travailler au moins {total_hours} heures par semaine, et si n&eacute;cessaire des heures suppl&eacute;mentaires en fonction de votre</p>\n\n            <p>responsabilit&eacute;s.</p>\n\n            <p>6. Cong&eacute;s/Vacances</p>\n\n            <p>6.1 Vous avez droit &agrave; un cong&eacute; occasionnel de 12 jours.</p>\n\n            <p>6.2 Vous avez droit &agrave; 12 jours ouvrables de cong&eacute; de maladie pay&eacute;.</p>\n\n            <p>6.3 La Soci&eacute;t&eacute; communiquera une liste des jours f&eacute;ri&eacute;s d&eacute;clar&eacute;s au d&eacute;but de chaque ann&eacute;e.</p>\n\n\n\n            <p>7. Nature des fonctions</p>\n\n            <p>Vous ex&eacute;cuterez au mieux de vos capacit&eacute;s toutes les t&acirc;ches inh&eacute;rentes &agrave; votre poste et les t&acirc;ches suppl&eacute;mentaires que lentreprise</p>\n\n            <p>peut faire appel &agrave; vous pour effectuer, de temps &agrave; autre. Vos fonctions sp&eacute;cifiques sont &eacute;nonc&eacute;es &agrave; lannexe II ci-jointe.</p>\n\n\n\n            <p>8. Biens sociaux</p>\n\n            <p>Vous maintiendrez toujours en bon &eacute;tat les biens de la Soci&eacute;t&eacute;, qui peuvent vous &ecirc;tre confi&eacute;s pour un usage officiel au cours de votre</p>\n\n            <p>votre emploi, et doit restituer tous ces biens &agrave; la Soci&eacute;t&eacute; avant labandon de votre charge, &agrave; d&eacute;faut de quoi le co&ucirc;t</p>\n\n            <p>de m&ecirc;me seront r&eacute;cup&eacute;r&eacute;s aupr&egrave;s de vous par la Soci&eacute;t&eacute;.</p>\n\n\n\n            <p>9. Emprunter/accepter des cadeaux</p>\n\n            <p>Vous nemprunterez ni naccepterez dargent, de cadeau, de r&eacute;compense ou de compensation pour vos gains personnels ou vous placerez autrement</p>\n\n            <p>sous obligation p&eacute;cuniaire envers toute personne/client avec qui vous pourriez avoir des relations officielles.</p>\n            <p>10. R&eacute;siliation</p>\n\n            <p>10.1 Votre nomination peut &ecirc;tre r&eacute;sili&eacute;e par la Soci&eacute;t&eacute;, sans aucune raison, en vous donnant au moins [Pr&eacute;avis] mois avant</p>\n\n            <p>un pr&eacute;avis &eacute;crit ou un salaire en tenant lieu. Aux fins de la pr&eacute;sente clause, salaire sentend du salaire de base.</p>\n\n            <p>10.2 Vous pouvez r&eacute;silier votre emploi au sein de la Soci&eacute;t&eacute;, sans motif, en donnant au moins [Avis &agrave; lemploy&eacute;]</p>\n\n            <p>mois de pr&eacute;avis ou de salaire pour la p&eacute;riode non &eacute;pargn&eacute;e, restant apr&egrave;s r&eacute;gularisation des cong&eacute;s en attente, &agrave; la date.</p>\n\n            <p>10.3 La Soci&eacute;t&eacute; se r&eacute;serve le droit de r&eacute;silier votre emploi sans pr&eacute;avis ni indemnit&eacute; de licenciement.</p>\n\n            <p>sil a des motifs raisonnables de croire que vous &ecirc;tes coupable dinconduite ou de n&eacute;gligence, ou que vous avez commis une violation fondamentale de</p>\n\n            <p>contrat, ou caus&eacute; une perte &agrave; la Soci&eacute;t&eacute;.</p>\n\n            <p>10. 4 &Agrave; la fin de votre emploi pour quelque raison que ce soit, vous restituerez &agrave; la Soci&eacute;t&eacute; tous les biens ; document, et</p>\n\n            <p>papier, &agrave; la fois loriginal et les copies de celui-ci, y compris les &eacute;chantillons, la litt&eacute;rature, les contrats, les dossiers, les listes, les dessins, les plans,</p>\n\n            <p>lettres, notes, donn&eacute;es et similaires; et Informations confidentielles, en votre possession ou sous votre contr&ocirc;le relatives &agrave; votre</p>\n\n            <p>lemploi ou aux affaires commerciales des clients.</p>\n            <p>11. Informations confidentielles</p>\n\n            <p>11. 1 Au cours de votre emploi au sein de la Soci&eacute;t&eacute;, vous consacrerez tout votre temps, votre attention et vos comp&eacute;tences au mieux de vos capacit&eacute;s pour</p>\n\n            <p>son affaire. Vous ne devez pas, directement ou indirectement, vous engager ou vous associer &agrave;, &ecirc;tre li&eacute; &agrave;, concern&eacute;, employ&eacute; ou</p>\n\n            <p>temps ou poursuivre quelque programme d&eacute;tudes que ce soit, sans lautorisation pr&eacute;alable de la Soci&eacute;t&eacute;. engag&eacute; dans toute autre entreprise ou</p>\n\n            <p>activit&eacute;s ou tout autre poste ou travail &agrave; temps partiel ou poursuivre des &eacute;tudes quelconques, sans lautorisation pr&eacute;alable du</p>\n\n            <p>Compagnie.</p>\n\n            <p>11.2 Vous devez toujours maintenir le plus haut degr&eacute; de confidentialit&eacute; et garder confidentiels les dossiers, documents et autres</p>\n\n            <p>Informations confidentielles relatives &agrave; lactivit&eacute; de la Soci&eacute;t&eacute; dont vous pourriez avoir connaissance ou qui vous seraient confi&eacute;es par tout moyen</p>\n\n            <p>et vous nutiliserez ces registres, documents et informations que dune mani&egrave;re d&ucirc;ment autoris&eacute;e dans lint&eacute;r&ecirc;t de la Soci&eacute;t&eacute;. Pour</p>\n\n            <p>aux fins de la pr&eacute;sente clause &laquo; Informations confidentielles &raquo; d&eacute;signe les informations sur les activit&eacute;s de la Soci&eacute;t&eacute; et celles de ses clients</p>\n\n            <p>qui nest pas accessible au grand public et dont vous pourriez avoir connaissance dans le cadre de votre emploi. Ceci comprend,</p>\n\n            <p>mais sans sy limiter, les informations relatives &agrave; lorganisation, ses listes de clients, ses politiques demploi, son personnel et les informations</p>\n\n            <p>sur les produits, les processus de la Soci&eacute;t&eacute;, y compris les id&eacute;es, les concepts, les projections, la technologie, les manuels, les dessins, les conceptions,</p>\n\n            <p>sp&eacute;cifications, et tous les papiers, curriculum vitae, dossiers et autres documents contenant de telles informations confidentielles.</p>\n\n            <p>11.3 &Agrave; aucun moment, vous ne retirerez des informations confidentielles du bureau sans autorisation.</p>\n\n            <p>11.4 Votre devoir de prot&eacute;ger et de ne pas divulguer</p>\n\n            <p>Les Informations confidentielles survivront &agrave; lexpiration ou &agrave; la r&eacute;siliation du pr&eacute;sent Contrat et/ou &agrave; votre emploi au sein de la Soci&eacute;t&eacute;.</p>\n\n            <p>11.5 La violation des conditions de cette clause vous rendra passible dun renvoi sans pr&eacute;avis en vertu de la clause ci-dessus en plus de tout</p>\n\n            <p>autre recours que la Soci&eacute;t&eacute; peut avoir contre vous en droit.</p>\n            <p>12. Avis</p>\n\n            <p>Des avis peuvent &ecirc;tre donn&eacute;s par vous &agrave; la Soci&eacute;t&eacute; &agrave; ladresse de son si&egrave;ge social. Des avis peuvent vous &ecirc;tre donn&eacute;s par la Soci&eacute;t&eacute; &agrave;</p>\n\n            <p>ladresse que vous avez indiqu&eacute;e dans les registres officiels.</p>\n\n\n\n            <p>13. Applicabilit&eacute; de la politique de lentreprise</p>\n\n            <p>La Soci&eacute;t&eacute; est autoris&eacute;e &agrave; faire des d&eacute;clarations de politique de temps &agrave; autre concernant des questions telles que le droit aux cong&eacute;s, la maternit&eacute;</p>\n\n            <p>les cong&eacute;s, les avantages sociaux des employ&eacute;s, les heures de travail, les politiques de transfert, etc., et peut les modifier de temps &agrave; autre &agrave; sa seule discr&eacute;tion.</p>\n\n            <p>Toutes ces d&eacute;cisions politiques de la Soci&eacute;t&eacute; vous lieront et pr&eacute;vaudront sur le pr&eacute;sent Contrat dans cette mesure.</p>\n\n\n\n            <p>14. Droit applicable/juridiction</p>\n\n            <p>Votre emploi au sein de la Soci&eacute;t&eacute; est soumis aux lois du pays. Tous les litiges seront soumis &agrave; la comp&eacute;tence du tribunal de grande instance</p>\n\n            <p>Gujarat uniquement.</p>\n\n\n\n            <p>15. Acceptation de notre offre</p>\n\n            <p>Veuillez confirmer votre acceptation de ce contrat de travail en signant et en renvoyant le duplicata.</p>\n\n\n\n            <p>Nous vous souhaitons la bienvenue et nous nous r&eacute;jouissons de recevoir votre acceptation et de travailler avec vous.</p>\n\n\n\n            <p>Cordialement,</p>\n\n            <p>{app_name}</p>\n\n            <p>{date}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(7, 'id', '<h3 style=\"text-align: center;\">Surat Bergabung</h3>\n\n\n            <p>{date}</p>\n\n            <p>{employee_name}</p>\n\n            <p>{address}</p>\n\n\n\n            <p>Perihal: Pengangkatan untuk jabatan {designation}</p>\n\n\n            <p>{employee_name} yang terhormat,</p>\n\n            <p>Kami dengan senang hati menawarkan kepada Anda, posisi {designation} dengan {app_name} sebagai Perusahaan dengan persyaratan dan</p>\n\n            <p>kondisi:</p>\n\n\n\n            <p>1. Mulai bekerja</p>\n\n            <p>Pekerjaan Anda akan efektif, mulai {start_date}</p>\n\n\n            <p>2. Jabatan</p>\n            <p>Jabatan Anda adalah {designation}.</p>\n\n            <p>3. Gaji</p>\n            <p>Gaji Anda dan tunjangan lainnya akan diatur dalam Jadwal 1, di sini.</p>\n\n\n            <p>4. Tempat posting</p>\n\n            <p>Anda akan diposkan di {branch}. Namun Anda mungkin diminta untuk bekerja di tempat bisnis mana pun yang dimiliki Perusahaan, atau</p>\n\n            <p>nantinya dapat memperoleh.</p>\n\n\n\n            <p>5. Jam Kerja</p>\n\n            <p>Hari kerja normal adalah Senin sampai Jumat. Anda akan diminta untuk bekerja selama jam-jam yang diperlukan untuk</p>\n\n            <p>pelaksanaan tugas Anda dengan benar di Perusahaan. Jam kerja normal adalah dari {start_time} hingga {end_time} dan Anda</p>\n\n            <p>diharapkan bekerja tidak kurang dari {total_hours} jam setiap minggu, dan jika perlu untuk jam tambahan tergantung pada</p>\n\n            <p>tanggung jawab.</p>\n\n\n\n            <p>6. Cuti/Libur</p>\n\n            <p>6.1 Anda berhak atas cuti biasa selama 12 hari.</p>\n\n            <p>6.2 Anda berhak atas 12 hari kerja cuti sakit berbayar.</p>\n\n            <p>6.3 Perusahaan akan memberitahukan daftar hari libur yang diumumkan pada awal setiap tahun.</p>\n\n\n\n            <p>7. Sifat tugas</p>\n\n            <p>Anda akan melakukan yang terbaik dari kemampuan Anda semua tugas yang melekat pada jabatan Anda dan tugas tambahan seperti perusahaan</p>\n\n            <p>dapat memanggil Anda untuk tampil, dari waktu ke waktu. Tugas khusus Anda ditetapkan dalam Jadwal II di sini.</p>\n\n\n\n            <p>8. Properti perusahaan</p>\n\n            <p>Anda akan selalu menjaga properti Perusahaan dalam kondisi baik, yang dapat dipercayakan kepada Anda untuk penggunaan resmi selama</p>\n\n            <p>pekerjaan Anda, dan akan mengembalikan semua properti tersebut kepada Perusahaan sebelum melepaskan biaya Anda, jika tidak ada biayanya</p>\n\n            <p>yang sama akan dipulihkan dari Anda oleh Perusahaan.</p>\n\n\n\n            <p>9. Meminjam/menerima hadiah</p>\n\n            <p>Anda tidak akan meminjam atau menerima uang, hadiah, hadiah, atau kompensasi apa pun untuk keuntungan pribadi Anda dari atau dengan cara lain menempatkan diri Anda sendiri</p>\n\n            <p>di bawah kewajiban uang kepada setiap orang/klien dengan siapa Anda mungkin memiliki hubungan resmi.</p>\n            <p>10. Penghentian</p>\n\n            <p>10.1 Penunjukan Anda dapat diakhiri oleh Perusahaan, tanpa alasan apa pun, dengan memberi Anda tidak kurang dari [Pemberitahuan] bulan sebelumnya</p>\n\n            <p>pemberitahuan secara tertulis atau gaji sebagai penggantinya. Untuk maksud pasal ini, gaji berarti gaji pokok.</p>\n\n            <p>10.2 Anda dapat memutuskan hubungan kerja Anda dengan Perusahaan, tanpa alasan apa pun, dengan memberikan tidak kurang dari [Pemberitahuan Karyawan]</p>\n\n            <p>pemberitahuan atau gaji bulan sebelumnya untuk periode yang belum disimpan, yang tersisa setelah penyesuaian cuti yang tertunda, pada tanggal.</p>\n\n            <p>10.3 Perusahaan berhak untuk mengakhiri hubungan kerja Anda dengan segera tanpa pemberitahuan jangka waktu atau pembayaran pemutusan hubungan kerja</p>\n\n            <p>jika memiliki alasan yang masuk akal untuk meyakini bahwa Anda bersalah atas kesalahan atau kelalaian, atau telah melakukan pelanggaran mendasar apa pun terhadap</p>\n\n            <p>kontrak, atau menyebabkan kerugian bagi Perusahaan.</p>\n\n            <p>10. 4 Pada pemutusan hubungan kerja Anda karena alasan apa pun, Anda akan mengembalikan semua properti kepada Perusahaan; dokumen, dan</p>\n\n            <p>kertas, baik asli maupun salinannya, termasuk contoh, literatur, kontrak, catatan, daftar, gambar, cetak biru,</p>\n\n            <p>surat, catatan, data dan sejenisnya; dan Informasi Rahasia, yang Anda miliki atau di bawah kendali Anda terkait dengan</p>\n\n            <p>pekerjaan atau untuk urusan bisnis klien.</p>\n            <p>11. Informasi Rahasia</p>\n\n            <p>11. 1 Selama bekerja di Perusahaan, Anda akan mencurahkan seluruh waktu, perhatian, dan keterampilan Anda sebaik mungkin untuk</p>\n\n            <p>bisnisnya. Anda tidak boleh, secara langsung atau tidak langsung, terlibat atau mengasosiasikan diri Anda dengan, terhubung dengan, terkait, dipekerjakan, atau</p>\n\n            <p>waktu atau mengikuti program studi apapun, tanpa izin sebelumnya dari Perusahaan.terlibat dalam bisnis lain atau</p>\n\n            <p>kegiatan atau pos atau pekerjaan paruh waktu lainnya atau mengejar program studi apa pun, tanpa izin sebelumnya dari</p>\n\n            <p>Perusahaan.</p>\n\n            <p>11.2 Anda harus selalu menjaga tingkat kerahasiaan tertinggi dan merahasiakan catatan, dokumen, dan lainnya</p>\n\n            <p>Informasi Rahasia yang berkaitan dengan bisnis Perusahaan yang mungkin Anda ketahui atau rahasiakan kepada Anda dengan cara apa pun</p>\n\n            <p>dan Anda akan menggunakan catatan, dokumen, dan informasi tersebut hanya dengan cara yang sah untuk kepentingan Perusahaan. Untuk</p>\n\n            <p>tujuan klausul ini Informasi Rahasia berarti informasi tentang bisnis Perusahaan dan pelanggannya</p>\n\n            <p>yang tidak tersedia untuk masyarakat umum dan yang mungkin Anda pelajari selama masa kerja Anda. Ini termasuk,</p>\n\n            <p>tetapi tidak terbatas pada, informasi yang berkaitan dengan organisasi, daftar pelanggannya, kebijakan ketenagakerjaan, personel, dan informasi</p>\n\n            <p>tentang produk Perusahaan, proses termasuk ide, konsep, proyeksi, teknologi, manual, gambar, desain,</p>\n\n            <p>spesifikasi, dan semua makalah, resume, catatan dan dokumen lain yang berisi Informasi Rahasia tersebut.</p>\n\n            <p>11.3 Kapan pun Anda akan menghapus Informasi Rahasia apa pun dari kantor tanpa izin.</p>\n\n            <p>11.4 Kewajiban Anda untuk melindungi dan tidak mengungkapkan</p>\n\n            <p>e Informasi Rahasia akan tetap berlaku setelah berakhirnya atau pengakhiran Perjanjian ini dan/atau hubungan kerja Anda dengan Perusahaan.</p>\n\n            <p>11.5 Pelanggaran terhadap ketentuan klausul ini akan membuat Anda bertanggung jawab atas pemecatan singkat berdasarkan klausul di atas selain dari:</p>\n\n            <p>upaya hukum lain yang mungkin dimiliki Perusahaan terhadap Anda secara hukum.</p>\n            <p>12. Pemberitahuan</p>\n\n            <p>Pemberitahuan dapat diberikan oleh Anda kepada Perusahaan di alamat kantor terdaftarnya. Pemberitahuan dapat diberikan oleh Perusahaan kepada Anda di</p>\n\n            <p>alamat yang diberitahukan oleh Anda dalam catatan resmi.</p>\n\n\n\n            <p>13. Keberlakuan Kebijakan Perusahaan</p>\n\n            <p>Perusahaan berhak untuk membuat pernyataan kebijakan dari waktu ke waktu berkaitan dengan hal-hal seperti hak cuti, persalinan</p>\n\n            <p>cuti, tunjangan karyawan, jam kerja, kebijakan transfer, dll., dan dapat mengubahnya dari waktu ke waktu atas kebijakannya sendiri.</p>\n\n            <p>Semua keputusan kebijakan Perusahaan tersebut akan mengikat Anda dan akan mengesampingkan Perjanjian ini sejauh itu.</p>\n\n\n\n            <p>14. Hukum/Yurisdiksi yang Mengatur</p>\n\n            <p>Pekerjaan Anda dengan Perusahaan tunduk pada undang-undang Negara. Semua perselisihan akan tunduk pada yurisdiksi Pengadilan Tinggi</p>\n\n            <p>Gujarat saja.</p>\n\n\n\n            <p>15. Penerimaan penawaran kami</p>\n\n            <p>Harap konfirmasikan penerimaan Anda atas Kontrak Kerja ini dengan menandatangani dan mengembalikan salinan duplikatnya.</p>\n\n\n\n            <p>Kami menyambut Anda dan berharap untuk menerima penerimaan Anda dan bekerja sama dengan Anda.</p>\n\n\n\n            <p>Dengan hormat,</p>\n\n            <p>{app_name}</p>\n\n            <p>{date}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(8, 'it', '<h3 style=\"text-align: center;\">Lettera di adesione</h3>\n\n\n            <p>{date}</p>\n\n            <p>{employee_name}</p>\n\n            <p>{address}</p>\n\n            <p>Oggetto: Appuntamento alla carica di {designation}</p>\n\n\n            <p>Gentile {employee_name},</p>\n\n            <p>Siamo lieti di offrirti la posizione di {designation} con {app_name} la \"Societ&agrave;\" alle seguenti condizioni e</p>\n\n            <p>condizioni:</p>\n\n\n            <p>1. Inizio del rapporto di lavoro</p>\n\n            <p>Il tuo impiego sar&agrave; effettivo a partire da {start_date}</p>\n\n\n\n            <p>2. Titolo di lavoro</p>\n\n            <p>Il tuo titolo di lavoro sar&agrave; {designation}.</p>\n\n            <p>3. Stipendio</p>\n\n            <p>Il tuo stipendio e altri benefici saranno come indicato nellAllegato 1, qui di seguito.</p>\n\n\n\n            <p>4. Luogo di invio</p>\n\n            <p>Sarai inviato a {branch}. Tuttavia, potrebbe essere richiesto di lavorare in qualsiasi luogo di attivit&agrave; che la Societ&agrave; ha, o</p>\n\n            <p>potr&agrave; successivamente acquisire.</p>\n\n\n\n            <p>5. Orario di lavoro</p>\n\n            <p>I normali giorni lavorativi sono dal luned&igrave; al venerd&igrave;. Ti verr&agrave; richiesto di lavorare per le ore necessarie per il</p>\n\n            <p>corretto adempimento dei propri doveri nei confronti della Societ&agrave;. Lorario di lavoro normale va da {start_time} a {end_time} e tu lo sei</p>\n\n            <p>dovrebbe lavorare non meno di {total_hours} ore ogni settimana e, se necessario, per ore aggiuntive a seconda del tuo</p>\n\n            <p>responsabilit&agrave;.</p>\n\n\n\n            <p>6. Permessi/Festivit&agrave;</p>\n\n            <p>6.1 Hai diritto a un congedo occasionale di 12 giorni.</p>\n\n            <p>6.2 Hai diritto a 12 giorni lavorativi di congedo per malattia retribuito.</p>\n\n            <p>6.3 La Societ&agrave; comunica allinizio di ogni anno un elenco delle festivit&agrave; dichiarate.</p>\n\n\n\n            <p>7. Natura degli incarichi</p>\n\n            <p>Eseguirai al meglio delle tue capacit&agrave; tutti i compiti inerenti al tuo incarico e compiti aggiuntivi come lazienda</p>\n\n            <p>pu&ograve; invitarti a esibirti, di tanto in tanto. I tuoi doveri specifici sono stabiliti nellAllegato II del presente documento.</p>\n\n\n\n            <p>8. Propriet&agrave; aziendale</p>\n\n            <p>Manterrete sempre in buono stato i beni dellAzienda, che nel corso dellanno potrebbero esservi affidati per uso ufficiale</p>\n\n            <p>il tuo impiego, e restituir&agrave; tutte queste propriet&agrave; alla Societ&agrave; prima della rinuncia al tuo addebito, in caso contrario il costo</p>\n\n            <p>degli stessi saranno da voi recuperati dalla Societ&agrave;.</p>\n\n\n\n            <p>9. Prendere in prestito/accettare regali</p>\n\n            <p>Non prenderai in prestito n&eacute; accetterai denaro, dono, ricompensa o compenso per i tuoi guadagni personali da o altrimenti collocato te stesso</p>\n\n            <p>sotto obbligazione pecuniaria nei confronti di qualsiasi persona/cliente con cui potresti avere rapporti ufficiali.</p>\n            <p>10. Cessazione</p>\n\n            <p>10.1 Il tuo incarico pu&ograve; essere risolto dalla Societ&agrave;, senza alcun motivo, dandoti non meno di [Avviso] mesi prima</p>\n\n            <p>avviso scritto o stipendio in sostituzione di esso. Ai fini della presente clausola, per stipendio si intende lo stipendio base.</p>\n\n            <p>10.2 &Egrave; possibile terminare il proprio rapporto di lavoro con la Societ&agrave;, senza alcuna causa, fornendo non meno di [Avviso per il dipendente]</p>\n\n            <p>mesi di preavviso o stipendio per il periodo non risparmiato, lasciato dopo ladeguamento delle ferie pendenti, come alla data.</p>\n\n            <p>10.3 La Societ&agrave; si riserva il diritto di terminare il rapporto di lavoro sommariamente senza alcun periodo di preavviso o pagamento di cessazione</p>\n\n            <p>se ha fondati motivi per ritenere che tu sia colpevole di cattiva condotta o negligenza, o abbia commesso una violazione fondamentale</p>\n\n            <p>contratto, o ha causato danni alla Societ&agrave;.</p>\n\n            <p>10. 4 Alla cessazione del rapporto di lavoro per qualsiasi motivo, restituirete alla Societ&agrave; tutti i beni; documenti, e</p>\n\n            <p>carta, sia in originale che in copia, inclusi eventuali campioni, letteratura, contratti, registrazioni, elenchi, disegni, progetti,</p>\n\n            <p>lettere, note, dati e simili; e Informazioni Riservate, in tuo possesso o sotto il tuo controllo, relative alla tua</p>\n\n            <p>lavoro o agli affari dei clienti.</p>\n            <p>11. Confidential Information</p>\n\n            <p>11. 1 During your employment with the Company you will devote your whole time, attention, and skill to the best of your ability for</p>\n\n            <p>its business. You shall not, directly or indirectly, engage or associate yourself with, be connected with, concerned, employed, or</p>\n\n            <p>time or pursue any course of study whatsoever, without the prior permission of the Company.engaged in any other business or</p>\n\n            <p>activities or any other post or work part-time or pursue any course of study whatsoever, without the prior permission of the</p>\n\n            <p>Company.</p>\n\n            <p>11.2 You must always maintain the highest degree of confidentiality and keep as confidential the records, documents, and other&nbsp;</p>\n\n            <p>Confidential Information relating to the business of the Company which may be known to you or confided in you by any means</p>\n\n            <p>and you will use such records, documents and information only in a duly authorized manner in the interest of the Company. For</p>\n\n            <p>the purposes of this clause &lsquo;Confidential Information&rsquo; means information about the Company&rsquo;s business and that of its customers</p>\n\n            <p>which is not available to the general public and which may be learned by you in the course of your employment. This includes,</p>\n\n            <p>but is not limited to, information relating to the organization, its customer lists, employment policies, personnel, and information</p>\n\n            <p>about the Company&rsquo;s products, processes including ideas, concepts, projections, technology, manuals, drawing, designs,&nbsp;</p>\n\n            <p>specifications, and all papers, resumes, records and other documents containing such Confidential Information.</p>\n\n            <p>11.3 At no time, will you remove any Confidential Information from the office without permission.</p>\n\n            <p>11.4 Your duty to safeguard and not disclos</p>\n\n            <p>e Confidential Information will survive the expiration or termination of this Agreement and/or your employment with the Company.</p>\n\n            <p>11.5 Breach of the conditions of this clause will render you liable to summary dismissal under the clause above in addition to any</p>\n\n            <p>other remedy the Company may have against you in law.</p>\n            <p>12. Notices</p>\n\n            <p>Notices may be given by you to the Company at its registered office address. Notices may be given by the Company to you at</p>\n\n            <p>the address intimated by you in the official records.</p>\n\n\n\n            <p>13. Applicability of Company Policy</p>\n\n            <p>The Company shall be entitled to make policy declarations from time to time pertaining to matters like leave entitlement,maternity</p>\n\n            <p>leave, employees&rsquo; benefits, working hours, transfer policies, etc., and may alter the same from time to time at its sole discretion.</p>\n\n            <p>All such policy decisions of the Company shall be binding on you and shall override this Agreement to that&nbsp; extent.</p>\n\n\n\n            <p>14. Governing Law/Jurisdiction</p>\n\n            <p>Your employment with the Company is subject to Country laws. All disputes shall be subject to the jurisdiction of High Court</p>\n\n            <p>Gujarat only.</p>\n\n\n\n            <p>15. Acceptance of our offer</p>\n\n            <p>Please confirm your acceptance of this Contract of Employment by signing and returning the duplicate copy.</p>\n\n\n\n            <p>We welcome you and look forward to receiving your acceptance and to working with you.</p>\n\n\n\n            <p>Yours Sincerely,</p>\n\n            <p>{app_name}</p>\n\n            <p>{date}</p>\n            ', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(9, 'ja', '<h3 style=\"text-align: center;\">入会の手紙</h3>\n\n            <p>{date}</p>\n\n            <p>{employee_name}</p>\n\n            <p>{address}</p>\n\n\n\n            <p>件名: {designation} の役職への任命</p>\n\n\n\n            <p>{employee_name} 様</p>\n\n\n            <p>{app_name} の {designation} の地位を以下の条件で「会社」として提供できることをうれしく思います。</p>\n\n            <p>条件：</p>\n\n\n            <p>1. 雇用開始</p>\n\n            <p>あなたの雇用は {start_date} から有効になります</p>\n\n\n            <p>2. 役職</p>\n\n            <p>あなたの役職は{designation}になります。</p>\n\n\n            <p>3. 給与</p>\n\n            <p>あなたの給与およびその他の福利厚生は、本明細書のスケジュール 1 に記載されているとおりです。</p>\n\n\n            <p>4. 掲示場所</p>\n\n            <p>{branch} に掲載されます。ただし、会社が所有する事業所で働く必要がある場合があります。</p>\n\n            <p>後で取得する場合があります。</p>\n\n\n\n            <p>5. 労働時間</p>\n\n            <p>通常の営業日は月曜日から金曜日です。あなたは、そのために必要な時間働く必要があります。</p>\n\n            <p>会社に対するあなたの義務の適切な遂行。通常の勤務時間は {start_time} から {end_time} までで、あなたは</p>\n\n            <p>毎週 {total_hours} 時間以上の勤務が期待される</p>\n\n            <p>責任。</p>\n\n\n\n            <p>6.休暇・休日</p>\n\n            <p>6.1 12 日間の臨時休暇を取得する権利があります。</p>\n\n            <p>6.2 12 日間の有給病気休暇を取る権利があります。</p>\n\n            <p>6.3 当社は、毎年の初めに宣言された休日のリストを通知するものとします。</p>\n\n\n\n            <p>7. 職務内容</p>\n\n            <p>あなたは、自分のポストに固有のすべての義務と、会社としての追加の義務を最大限に遂行します。</p>\n\n            <p>時々あなたに演奏を依頼するかもしれません。あなたの特定の義務は、本明細書のスケジュール II に記載されています。</p>\n\n\n\n            <p>8. 会社財産</p>\n\n            <p>あなたは、会社の所有物を常に良好な状態に維持するものとします。</p>\n\n            <p>あなたの雇用を放棄し、あなたの料金を放棄する前に、そのようなすべての財産を会社に返還するものとします。</p>\n\n            <p>同じのは、会社によってあなたから回収されます。</p>\n\n\n\n            <p>9. 貸出・贈答品の受け取り</p>\n\n            <p>あなたは、あなた自身から、または他の方法であなた自身の場所から個人的な利益を得るための金銭、贈り物、報酬、または補償を借りたり、受け取ったりしません。</p>\n\n            <p>あなたが公式の取引をしている可能性のある人物/クライアントに対する金銭的義務の下で。</p>\n            <p>10. 終了</p>\n\n            <p>10.1 少なくとも [通知] か月前に通知することにより、理由のいかんを問わず、会社はあなたの任命を終了することができます。</p>\n\n            <p>書面による通知またはその代わりの給与。この条項の目的上、給与とは基本給を意味するものとします。</p>\n\n            <p>10.2 あなたは、少なくとも [従業員通知] を提出することにより、理由のいかんを問わず、会社での雇用を終了することができます。</p>\n\n            <p>保留中の休暇の調整後に残された、保存されていない期間の数か月前の通知または給与は、日付のとおりです。</p>\n\n            <p>10.3 当社は、通知期間や解雇補償金なしに、あなたの雇用を即座に終了させる権利を留保します。</p>\n\n            <p>あなたが不正行為または過失で有罪であると信じる合理的な根拠がある場合、または基本的な違反を犯した場合</p>\n\n            <p>契約、または当社に損害を与えた。</p>\n\n            <p>10. 4 何らかの理由で雇用が終了した場合、あなたは会社にすべての財産を返還するものとします。ドキュメント、および</p>\n\n            <p>サンプル、文献、契約書、記録、リスト、図面、青写真を含む、原本とコピーの両方の紙、</p>\n\n            <p>手紙、メモ、データなど。あなたが所有する、またはあなたの管理下にある機密情報。</p>\n\n            <p>雇用またはクライアントの業務に。</p>\n            <p>11. 機密情報</p>\n\n            <p>11. 1 当社での雇用期間中、あなたは自分の全時間、注意、およびスキルを、自分の能力の限りを尽くして捧げます。</p>\n\n            <p>そのビジネス。あなたは、直接的または間接的に、関与したり、関連付けたり、接続したり、関係したり、雇用したり、または</p>\n\n            <p>会社の事前の許可なしに、時間や学習コースを追求すること。他のビジネスに従事すること、または</p>\n\n            <p>の事前の許可なしに、活動またはその他の投稿またはアルバイトをしたり、何らかの研究コースを追求したりすること。</p>\n\n            <p>会社。</p>\n\n            <p>11.2 常に最高度の機密性を維持し、記録、文書、およびその他の情報を機密として保持する必要があります。</p>\n\n            <p>お客様が知っている、または何らかの方法でお客様に内密にされている可能性がある、当社の事業に関連する機密情報</p>\n\n            <p>また、あなたは、会社の利益のために正当に承認された方法でのみ、そのような記録、文書、および情報を使用するものとします。為に</p>\n\n            <p>この条項の目的 「機密情報」とは、会社の事業および顧客の事業に関する情報を意味します。</p>\n\n            <p>これは一般には公開されておらず、雇用の過程で学習する可能性があります。これも、</p>\n\n            <p>組織、その顧客リスト、雇用方針、人事、および情報に関連する情報に限定されません</p>\n\n            <p>当社の製品、アイデアを含むプロセス、コンセプト、予測、技術、マニュアル、図面、デザイン、</p>\n\n            <p>仕様、およびそのような機密情報を含むすべての書類、履歴書、記録、およびその他の文書。</p>\n\n            <p>11.3 いかなる時も、許可なくオフィスから機密情報を削除しないでください。</p>\n\n            <p>11.4 保護し、開示しないというあなたの義務</p>\n\n            <p>e 機密情報は、本契約および/または当社との雇用の満了または終了後も存続します。</p>\n\n            <p>11.5 この条項の条件に違反した場合、上記の条項に基づく略式解雇の対象となります。</p>\n\n            <p>会社が法律であなたに対して持つことができるその他の救済。</p>\n            <p>12. 通知</p>\n\n            <p>通知は、登録された事務所の住所で会社に提出することができます。通知は、当社からお客様に提供される場合があります。</p>\n\n            <p>公式記録であなたがほのめかした住所。</p>\n\n\n\n            <p>13. 会社方針の適用性</p>\n\n            <p>会社は、休暇の資格、出産などの事項に関して、随時方針を宣言する権利を有するものとします。</p>\n\n            <p>休暇、従業員の福利厚生、勤務時間、異動ポリシーなどであり、独自の裁量により随時変更される場合があります。</p>\n\n            <p>当社のそのようなポリシー決定はすべて、あなたを拘束し、その範囲で本契約を無効にするものとします。</p>\n\n\n\n            <p>14. 準拠法・裁判管轄</p>\n\n            <p>当社でのあなたの雇用は、国の法律の対象となります。すべての紛争は、高等裁判所の管轄に服するものとします</p>\n\n            <p>グジャラートのみ。</p>\n\n\n\n            <p>15. オファーの受諾</p>\n\n            <p>副本に署名して返送することにより、この雇用契約に同意したことを確認してください。</p>\n\n\n\n            <p>私たちはあなたを歓迎し、あなたの受け入れを受け取り、あなたと一緒に働くことを楽しみにしています.</p>\n\n\n\n            <p>敬具、</p>\n\n            <p>{app_name}</p>\n\n            <p>{date}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(10, 'nl', '<h3 style=\"text-align: center;\">Deelnemende brief</h3>\n\n            <p>{date}</p>\n\n            <p>{employee}</p>\n\n            <p>{address}</p>\n\n            <p>Onderwerp: Benoeming voor de functie van {designation}</p>\n\n            <p>Beste {employee_name},</p>\n\n            <p>We zijn verheugd u de positie van {designation} bij {app_name} het Bedrijf aan te bieden onder de volgende voorwaarden en</p>\n\n            <p>conditie:</p>\n\n\n            <p>1. Indiensttreding</p>\n            <p>Uw dienstverband gaat in op {start_date}</p>\n\n\n            <p>2. Functietitel</p>\n\n            <p>Uw functietitel wordt {designation}.</p>\n\n            <p>3. Salaris</p>\n\n            <p>Uw salaris en andere voordelen zijn zoals uiteengezet in Schema 1 hierbij.</p>\n\n            <p>4. Plaats van detachering</p>\n\n            <p>Je wordt geplaatst op {branch}. Het kan echter zijn dat u moet werken op een bedrijfslocatie die het Bedrijf heeft, of</p>\n\n            <p>later kan verwerven.</p>\n\n\n\n            <p>5. Werkuren</p>\n\n            <p>De normale werkdagen zijn van maandag tot en met vrijdag. Je zal de uren moeten werken die nodig zijn voor de</p>\n\n            <p>correcte uitvoering van uw taken jegens het bedrijf. De normale werkuren zijn van {start_time} tot {end_time} en jij bent</p>\n\n            <p>naar verwachting niet minder dan {total_hours} uur per week werken, en indien nodig voor extra uren, afhankelijk van uw</p>\n\n            <p>verantwoordelijkheden.</p>\n\n\n\n            <p>6. Verlof/Vakantie</p>\n\n            <p>6.1 Je hebt recht op tijdelijk verlof van 12 dagen.</p>\n\n            <p>6.2 U heeft recht op 12 werkdagen betaald ziekteverlof.</p>\n\n            <p>6.3 De Maatschappij stelt aan het begin van elk jaar een lijst van verklaarde feestdagen op.</p>\n\n\n\n            <p>7. Aard van de taken</p>\n\n            <p>Je voert alle taken die inherent zijn aan je functie en bijkomende taken zoals het bedrijf naar beste vermogen uit;</p>\n\n            <p>kan van tijd tot tijd een beroep op u doen om op te treden. Uw specifieke taken zijn uiteengezet in Bijlage II hierbij.</p>\n\n\n\n            <p>8. Bedrijfseigendommen</p>\n\n            <p>U onderhoudt bedrijfseigendommen, die u in de loop van</p>\n\n            <p>uw dienstverband, en zal al deze eigendommen aan het Bedrijf teruggeven voordat afstand wordt gedaan van uw kosten, bij gebreke waarvan de kosten</p>\n\n            <p>hiervan zal door het Bedrijf van u worden verhaald.</p>\n\n\n\n            <p>9. Geschenken lenen/aannemen</p>\n\n            <p>U zult geen geld, geschenken, beloningen of vergoedingen voor uw persoonlijk gewin lenen of accepteren van uzelf of uzelf op een andere manier plaatsen</p>\n\n            <p>onder geldelijke verplichting jegens een persoon/klant met wie u mogelijk offici&euml;le betrekkingen heeft.</p>\n            <p>10. Be&euml;indiging</p>\n\n            <p>10.1 Uw aanstelling kan door het Bedrijf zonder opgaaf van reden worden be&euml;indigd door u minimaal [Opzegging] maanden van tevoren</p>\n\n            <p>schriftelijke opzegging of daarvoor in de plaats komend salaris. In dit artikel wordt onder salaris verstaan ​​het basissalaris.</p>\n\n            <p>10.2 U kunt uw dienstverband bij het Bedrijf be&euml;indigen, zonder enige reden, door niet minder dan [Mededeling van de werknemer]</p>\n\n            <p>maanden opzegtermijn of salaris voor de niet gespaarde periode, overgebleven na aanpassing van hangende verlofdagen, zoals op datum.</p>\n\n            <p>10.3 Het bedrijf behoudt zich het recht voor om uw dienstverband op staande voet te be&euml;indigen zonder enige opzegtermijn of be&euml;indigingsvergoeding</p>\n\n            <p>als het redelijke grond heeft om aan te nemen dat u zich schuldig heeft gemaakt aan wangedrag of nalatigheid, of een fundamentele schending van</p>\n\n            <p>contract, of enig verlies voor het Bedrijf veroorzaakt.</p>\n\n            <p>10. 4 Bij be&euml;indiging van uw dienstverband om welke reden dan ook, geeft u alle eigendommen terug aan het Bedrijf; documenten, en</p>\n\n            <p>papier, zowel origineel als kopie&euml;n daarvan, inclusief eventuele monsters, literatuur, contracten, bescheiden, lijsten, tekeningen, blauwdrukken,</p>\n\n            <p>brieven, notities, gegevens en dergelijke; en Vertrouwelijke informatie, in uw bezit of onder uw controle met betrekking tot uw</p>\n\n            <p>werkgelegenheid of de zakelijke aangelegenheden van klanten.</p>\n            <p>11. Vertrouwelijke informatie</p>\n\n            <p>11. 1 Tijdens uw dienstverband bij het Bedrijf besteedt u al uw tijd, aandacht en vaardigheden naar uw beste vermogen aan:</p>\n\n            <p>zijn zaken. U mag zich niet, direct of indirect, inlaten met of verbonden zijn met, betrokken zijn bij, betrokken zijn bij, in dienst zijn van of</p>\n\n            <p>tijd doorbrengen of een studie volgen, zonder voorafgaande toestemming van het bedrijf.bezig met een ander bedrijf of</p>\n\n            <p>werkzaamheden of enige andere functie of werk in deeltijd of het volgen van welke opleiding dan ook, zonder voorafgaande toestemming van de</p>\n\n            <p>Bedrijf.</p>\n\n            <p>11.2 U moet altijd de hoogste graad van vertrouwelijkheid handhaven en de records, documenten en andere</p>\n\n            <p>Vertrouwelijke informatie met betrekking tot het bedrijf van het bedrijf die u op enigerlei wijze bekend is of in vertrouwen is genomen</p>\n\n            <p>en u zult dergelijke records, documenten en informatie alleen gebruiken op een naar behoren gemachtigde manier in het belang van het bedrijf. Voor</p>\n\n            <p>de doeleinden van deze clausule Vertrouwelijke informatiebetekent informatie over het bedrijf van het bedrijf en dat van zijn klanten</p>\n\n            <p>die niet beschikbaar is voor het grote publiek en die u tijdens uw dienstverband kunt leren. Dit bevat,</p>\n\n            <p>maar is niet beperkt tot informatie met betrekking tot de organisatie, haar klantenlijsten, werkgelegenheidsbeleid, personeel en informatie</p>\n\n            <p>over de producten, processen van het bedrijf, inclusief idee&euml;n, concepten, projecties, technologie, handleidingen, tekeningen, ontwerpen,</p>\n\n            <p>specificaties, en alle papieren, cvs, dossiers en andere documenten die dergelijke vertrouwelijke informatie bevatten.</p>\n\n            <p>11.3 U verwijdert nooit vertrouwelijke informatie van het kantoor zonder toestemming.</p>\n\n            <p>11.4 Uw plicht om te beschermen en niet openbaar te maken</p>\n\n            <p>e Vertrouwelijke informatie blijft van kracht na het verstrijken of be&euml;indigen van deze Overeenkomst en/of uw dienstverband bij het Bedrijf.</p>\n\n            <p>11.5 Schending van de voorwaarden van deze clausule maakt u aansprakelijk voor ontslag op staande voet op grond van de bovenstaande clausule, naast eventuele:</p>\n\n            <p>ander rechtsmiddel dat het Bedrijf volgens de wet tegen u heeft.</p>\n            <p>12. Kennisgevingen</p>\n\n            <p>Kennisgevingen kunnen door u aan het Bedrijf worden gedaan op het adres van de maatschappelijke zetel. Kennisgevingen kunnen door het bedrijf aan u worden gedaan op:</p>\n\n            <p>het door u opgegeven adres in de offici&euml;le administratie.</p>\n\n\n\n            <p>13. Toepasselijkheid van het bedrijfsbeleid</p>\n\n            <p>Het bedrijf heeft het recht om van tijd tot tijd beleidsverklaringen af ​​te leggen met betrekking tot zaken als verlofrecht, moederschap</p>\n\n            <p>verlof, werknemersvoordelen, werkuren, transferbeleid, enz., en kan deze van tijd tot tijd naar eigen goeddunken wijzigen.</p>\n\n            <p>Al dergelijke beleidsbeslissingen van het Bedrijf zijn bindend voor u en hebben voorrang op deze Overeenkomst in die mate.</p>\n\n\n\n            <p>14. Toepasselijk recht/jurisdictie</p>\n\n            <p>Uw dienstverband bij het bedrijf is onderworpen aan de landelijke wetgeving. Alle geschillen zijn onderworpen aan de jurisdictie van de High Court</p>\n\n            <p>Alleen Gujarat.</p>\n\n\n\n            <p>15. Aanvaarding van ons aanbod</p>\n\n            <p>Bevestig uw aanvaarding van deze arbeidsovereenkomst door het duplicaat te ondertekenen en terug te sturen.</p>\n\n\n\n            <p>Wij heten u van harte welkom en kijken ernaar uit uw acceptatie te ontvangen en met u samen te werken.</p>\n\n\n\n            <p>Hoogachtend,</p>\n\n            <p>{app_name}</p>\n\n            <p>{date}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(11, 'pl', '<h3 style=\"text-align: center;\">Dołączanie listu</h3>\n\n            <p>{date }</p>\n\n            <p>{employee_name }</p>\n\n            <p>{address }</p>\n\n\n            <p>Dotyczy: mianowania na stanowisko {designation}</p>\n\n            <p>Szanowny {employee_name },</p>\n\n            <p>Mamy przyjemność zaoferować Państwu, stanowisko {designation} z {app_name } \"Sp&oacute;łka\" na poniższych warunkach i</p>\n            <p>warunki:</p>\n\n            <p>1. Rozpoczęcie pracy</p>\n\n            <p>Twoje zatrudnienie będzie skuteczne, jak na {start_date }</p>\n\n            <p>2. Tytuł zadania</p>\n            <p>Tw&oacute;j tytuł pracy to {designation}.</p>\n\n            <p>3. Salary</p>\n\n            <p>Twoje wynagrodzenie i inne świadczenia będą określone w Zestawieniu 1, do niniejszego rozporządzenia.</p>\n\n\n            <p>4. Miejsce delegowania</p>\n            <p>Użytkownik zostanie opublikowany w {branch }. Użytkownik może jednak być zobowiązany do pracy w dowolnym miejscu prowadzenia działalności, kt&oacute;re Sp&oacute;łka posiada, lub może p&oacute;źniej nabyć.</p>\n\n            <p>5. Godziny pracy</p>\n            <p>Normalne dni robocze są od poniedziałku do piątku. Będziesz zobowiązany do pracy na takie godziny, jakie są niezbędne do prawidłowego wywiązania się ze swoich obowiązk&oacute;w wobec Sp&oacute;łki. Normalne godziny pracy to {start_time } do {end_time }, a użytkownik oczekuje, że będzie pracować nie mniej niż {total_hours } godzin tygodniowo, a jeśli to konieczne, przez dodatkowe godziny w zależności od Twojego</p>\n            <p>odpowiedzialności.</p>\n\n            <p>6. Urlop/Wakacje</p>\n\n            <p>6.1 Przysługuje prawo do urlopu dorywczego w ciągu 12 dni.</p>\n\n            <p>6.2 Użytkownik ma prawo do 12 dni roboczych od wypłatnego zwolnienia chorobowego.</p>\n\n            <p>6.3 Sp&oacute;łka powiadamia na początku każdego roku wykaz ogłoszonych świąt.&nbsp;</p>\n\n\n\n            <p>7. Rodzaj obowiązk&oacute;w</p>\n\n            <p>Będziesz wykonywać na najlepsze ze swojej zdolności wszystkie obowiązki, jak są one nieodłączne w swoim poście i takie dodatkowe obowiązki, jak firma może zadzwonić do wykonania, od czasu do czasu. Państwa szczeg&oacute;lne obowiązki są określone w załączniku II do niniejszego rozporządzenia.</p>\n\n\n\n            <p>8. Właściwość przedsiębiorstwa</p>\n\n            <p>Zawsze będziesz utrzymywać w dobrej kondycji Firmy, kt&oacute;ra może być powierzona do użytku służbowego w trakcie trwania</p>\n\n            <p>Twoje zatrudnienie, i zwr&oacute;ci wszystkie takie nieruchomości do Sp&oacute;łki przed zrzeczeniem się opłaty, w przeciwnym razie koszty te same będą odzyskane od Ciebie przez Sp&oacute;łkę.</p>\n\n            <p>9. Wypożyczanie/akceptowanie prezent&oacute;w</p>\n\n            <p>Nie będziesz pożyczał ani nie akceptować żadnych pieniędzy, dar&oacute;w, nagrody lub odszkodowania za swoje osobiste zyski z lub w inny spos&oacute;b złożyć się w ramach zobowiązania pieniężnego do jakiejkolwiek osoby/klienta, z kt&oacute;rym może być posiadanie oficjalne relacje.</p>\n            <p>10. Zakończenie</p>\n\n            <p>10.1 Powołanie może zostać wypowiedziane przez Sp&oacute;łkę, bez względu na przyczynę, poprzez podanie nie mniej niż [ Zawiadomienie] miesięcy uprzedniego wypowiedzenia na piśmie lub wynagrodzenia w miejsce jego wystąpienia. Dla cel&oacute;w niniejszej klauzuli, wynagrodzenie oznacza wynagrodzenie podstawowe.</p>\n\n            <p>10.2 Użytkownik może rozwiązać umowę o pracę ze Sp&oacute;łką, bez jakiejkolwiek przyczyny, podając nie mniej niż [ ogłoszenie o pracowniku] miesiące przed powiadomieniem lub wynagrodzeniem za niezaoszczędzony okres, pozostawiony po skorygowaniu oczekujących liści, jak na dzień.</p>\n\n            <p>10.3 Sp&oacute;łka zastrzega sobie prawo do wypowiedzenia umowy o pracę bez okresu wypowiedzenia lub wypłaty z tytułu rozwiązania umowy, jeżeli ma on uzasadnione podstawy, aby sądzić, że jesteś winny wykroczenia lub niedbalstwa, lub popełnił jakiekolwiek istotne naruszenie umowy lub spowodował jakiekolwiek straty w Sp&oacute;łce.&nbsp;</p>\n\n            <p>10. 4 W sprawie rozwiązania stosunku pracy z jakiegokolwiek powodu, powr&oacute;cisz do Sp&oacute;łki wszystkie nieruchomości; dokumenty, i&nbsp;</p>\n\n            <p>papieru, zar&oacute;wno oryginału, jak i jego kopii, w tym wszelkich pr&oacute;bek, literatury, um&oacute;w, zapis&oacute;w, wykaz&oacute;w, rysunk&oacute;w, konspekt&oacute;w,</p>\n\n            <p>listy, notatki, dane i podobne; informacje poufne, znajdujące się w posiadaniu lub pod Twoją kontrolą związane z zatrudnieniem lub sprawami biznesowymi klient&oacute;w.&nbsp; &nbsp;</p>\n\n\n\n            <p>11. Informacje poufne</p>\n\n            <p>11. 1 Podczas swojego zatrudnienia z Firmą poświęcisz cały czas, uwagę i umiejętności na najlepszą z Twoich możliwości</p>\n\n            <p>swojej działalności gospodarczej. Użytkownik nie może, bezpośrednio lub pośrednio, prowadzić lub wiązać się z, być związany z, dotyka, zatrudniony lub czas lub prowadzić jakikolwiek kierunek studi&oacute;w, bez uprzedniej zgody Company.zaangażował się w innej działalności gospodarczej lub działalności lub jakikolwiek inny post lub pracy w niepełnym wymiarze czasu lub prowadzić jakikolwiek kierunek studi&oacute;w, bez uprzedniej zgody</p>\n\n            <p>Firma.</p>\n\n            <p>11.2 Zawsze musisz zachować najwyższy stopień poufności i zachować jako poufny akt, dokumenty, i inne&nbsp;</p>\n\n            <p>Informacje poufne dotyczące działalności Sp&oacute;łki, kt&oacute;re mogą być znane Państwu lub w dowolny spos&oacute;b zwierzyny, a Użytkownik będzie posługiwać się takimi zapisami, dokumentami i informacjami tylko w spos&oacute;b należycie autoryzowany w interesie Sp&oacute;łki. Do cel&oacute;w niniejszej klauzuli \"Informacje poufne\" oznaczają informacje o działalności Sp&oacute;łki oraz o jej klientach, kt&oacute;re nie są dostępne dla og&oacute;łu społeczeństwa i kt&oacute;re mogą być przez Państwa w trakcie zatrudnienia dowiedzione przez Państwa. Obejmuje to,</p>\n\n            <p>ale nie ogranicza się do informacji związanych z organizacją, jej listami klient&oacute;w, politykami zatrudnienia, personelem oraz informacjami o produktach firmy, procesach, w tym pomysłach, koncepcjach, projekcjach, technikach, podręcznikach, rysunkach, projektach,&nbsp;</p>\n\n            <p>specyfikacje, a także wszystkie dokumenty, życiorysy, zapisy i inne dokumenty zawierające takie informacje poufne.</p>\n\n            <p>11.3 W żadnym momencie nie usunie Pan żadnych Informacji Poufnych z urzędu bez zezwolenia.</p>\n\n            <p>11.4 Tw&oacute;j obowiązek ochrony a nie disclos</p>\n\n            <p>Informacje poufne przetrwają wygaśnięcie lub rozwiązanie niniejszej Umowy i/lub Twoje zatrudnienie w Sp&oacute;łce.</p>\n\n            <p>11.5 Naruszenie warunk&oacute;w niniejszej klauzuli spowoduje, że Użytkownik będzie zobowiązany do skr&oacute;conej umowy w ramach klauzuli powyżej, opr&oacute;cz wszelkich innych środk&oacute;w zaradcze, jakie Sp&oacute;łka może mieć przeciwko Państwu w prawie.</p>\n\n\n\n            <p>12. Uwagi</p>\n\n            <p>Ogłoszenia mogą być podane przez Państwa do Sp&oacute;łki pod adresem jej siedziby. Ogłoszenia mogą być podane przez Sp&oacute;łkę do Państwa na adres intymniony przez Państwa w ewidencji urzędowej.</p>\n\n\n\n            <p>13. Stosowność polityki firmy</p>\n\n            <p>Sp&oacute;łka jest uprawniona do składania deklaracji politycznych od czasu do czasu dotyczących spraw takich jak prawo do urlopu macierzyńskiego, macierzyństwo</p>\n\n            <p>urlop&oacute;w, świadczeń pracowniczych, godzin pracy, polityki transferowej itp., a także mogą zmieniać to samo od czasu do czasu według własnego uznania.</p>\n\n            <p>Wszystkie takie decyzje polityczne Sp&oacute;łki są wiążące dla Państwa i przesłaniają niniejszą Umowę w tym zakresie.</p>\n\n\n\n            <p>14. Prawo właściwe/jurysdykcja</p>\n\n            <p>Twoje zatrudnienie ze Sp&oacute;łką podlega prawu krajowi. Wszelkie spory podlegają właściwości Sądu Najwyższego</p>\n\n            <p>Tylko Gujarat.</p>\n\n\n\n            <p>15. Akceptacja naszej oferty</p>\n\n            <p>Prosimy o potwierdzenie przyjęcia niniejszej Umowy o pracę poprzez podpisanie i zwr&oacute;cenie duplikatu.</p>\n\n\n\n            <p>Zapraszamy Państwa i czekamy na Państwa przyjęcie i wsp&oacute;łpracę z Tobą.</p>\n\n\n\n            <p>Z Państwa Sincerely,</p>\n\n            <p>{app_name }</p>\n\n            <p>{date }</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40');
INSERT INTO `joining_letters` (`id`, `lang`, `content`, `workspace`, `created_by`, `created_at`, `updated_at`) VALUES
(12, 'pt', '<h3 style=\"text-align: center;\">Carta De Ades&atilde;o</h3>\n\n            <p>{data}</p>\n\n            <p>{employee_name}</p>\n\n            <p>{address}</p>\n\n\n            <p>Assunto: Nomea&ccedil;&atilde;o para o cargo de {designation}</p>\n\n            <p>Querido {employee_name},</p>\n\n\n            <p>Temos o prazer de oferec&ecirc;-lo, a posi&ccedil;&atilde;o de {designation} com {app_name} a Empresa nos seguintes termos e</p>\n            <p>condi&ccedil;&otilde;es:</p>\n\n\n            <p>1. Comentamento do emprego</p>\n\n            <p>Seu emprego ser&aacute; efetivo, a partir de {start_date}</p>\n\n\n            <p>2. T&iacute;tulo do emprego</p>\n\n            <p>Seu cargo de trabalho ser&aacute; {designation}.</p>\n\n            <p>3. Sal&aacute;rio</p>\n\n            <p>Seu sal&aacute;rio e outros benef&iacute;cios ser&atilde;o conforme estabelecido no Planejamento 1, hereto.</p>\n\n            <p>4. Local de postagem</p>\n\n            <p>Voc&ecirc; ser&aacute; postado em {branch}. Voc&ecirc; pode, no entanto, ser obrigado a trabalhar em qualquer local de neg&oacute;cios que a Empresa tenha, ou possa posteriormente adquirir.</p>\n\n            <p>5. Horas de Trabalho</p>\n\n            <p>Os dias normais de trabalho s&atilde;o de segunda a sexta-feira. Voc&ecirc; ser&aacute; obrigado a trabalhar por tais horas, conforme necess&aacute;rio para a quita&ccedil;&atilde;o adequada de suas fun&ccedil;&otilde;es para a Companhia. As horas de trabalho normais s&atilde;o de {start_time} para {end_time} e voc&ecirc; deve trabalhar n&atilde;o menos de {total_horas} horas semanais, e se necess&aacute;rio para horas adicionais dependendo do seu</p>\n            <p>responsabilidades.</p>\n\n            <p>6. Leave / Holidays</p>\n\n            <p>6,1 Voc&ecirc; tem direito a licen&ccedil;a casual de 12 dias.</p>\n\n            <p>6,2 Voc&ecirc; tem direito a 12 dias &uacute;teis de licen&ccedil;a remunerada remunerada.</p>\n\n            <p>6,3 Companhia notificar&aacute; uma lista de feriados declarados no in&iacute;cio de cada ano.&nbsp;</p>\n\n\n\n            <p>7. Natureza dos deveres</p>\n\n            <p>Voc&ecirc; ir&aacute; executar ao melhor da sua habilidade todos os deveres como s&atilde;o inerentes ao seu cargo e tais deveres adicionais como a empresa pode ligar sobre voc&ecirc; para executar, de tempos em tempos. Os seus deveres espec&iacute;ficos s&atilde;o estabelecidos no Hereto do Planejamento II.</p>\n\n\n\n            <p>8. Propriedade da empresa</p>\n\n            <p>Voc&ecirc; sempre manter&aacute; em bom estado propriedade Empresa, que poder&aacute; ser confiada a voc&ecirc; para uso oficial durante o curso de</p>\n\n            <p>o seu emprego, e devolver&aacute; toda essa propriedade &agrave; Companhia antes de abdicar de sua acusa&ccedil;&atilde;o, falhando qual o custo do mesmo ser&aacute; recuperado de voc&ecirc; pela Companhia.</p>\n\n\n\n            <p>9. Borremir / aceitar presentes</p>\n\n            <p>Voc&ecirc; n&atilde;o vai pedir empr&eacute;stimo ou aceitar qualquer dinheiro, presente, recompensa ou indeniza&ccedil;&atilde;o por seus ganhos pessoais de ou de outra forma colocar-se sob obriga&ccedil;&atilde;o pecuni&aacute;ria a qualquer pessoa / cliente com quem voc&ecirc; pode estar tendo rela&ccedil;&otilde;es oficiais.</p>\n\n\n\n            <p>10. Termina&ccedil;&atilde;o</p>\n\n            <p>10,1 Sua nomea&ccedil;&atilde;o pode ser rescindida pela Companhia, sem qualquer raz&atilde;o, dando-lhe n&atilde;o menos do que [aviso] meses de aviso pr&eacute;vio por escrito ou de sal&aacute;rio em lieu deste. Para efeito da presente cl&aacute;usula, o sal&aacute;rio deve significar sal&aacute;rio base.</p>\n\n            <p>10,2 Voc&ecirc; pode rescindir seu emprego com a Companhia, sem qualquer causa, ao dar nada menos que [Aviso de contrata&ccedil;&atilde;o] meses de aviso pr&eacute;vio ou sal&aacute;rio para o per&iacute;odo n&atilde;o salvo, deixado ap&oacute;s ajuste de folhas pendentes, conforme data de encontro.</p>\n\n            <p>10,3 Empresa reserva-se o direito de rescindir o seu emprego sumariamente sem qualquer prazo de aviso ou de rescis&atilde;o se tiver terreno razo&aacute;vel para acreditar que voc&ecirc; &eacute; culpado de m&aacute; conduta ou neglig&ecirc;ncia, ou tenha cometido qualquer viola&ccedil;&atilde;o fundamental de contrato, ou tenha causado qualquer perda para a Empresa.&nbsp;</p>\n\n            <p>10. 4 Sobre a rescis&atilde;o do seu emprego por qualquer motivo, voc&ecirc; retornar&aacute; para a Empresa todos os bens; documentos e&nbsp;</p>\n\n            <p>papel, tanto originais como c&oacute;pias dos mesmos, incluindo quaisquer amostras, literatura, contratos, registros, listas, desenhos, plantas,</p>\n\n            <p>cartas, notas, dados e semelhantes; e Informa&ccedil;&otilde;es Confidenciais, em sua posse ou sob seu controle relacionado ao seu emprego ou aos neg&oacute;cios de neg&oacute;cios dos clientes.&nbsp; &nbsp;</p>\n\n\n\n            <p>11. Informa&ccedil;&otilde;es Confidenciais</p>\n\n            <p>11. 1 Durante o seu emprego com a Companhia voc&ecirc; ir&aacute; dedicar todo o seu tempo, aten&ccedil;&atilde;o e habilidade para o melhor de sua capacidade de</p>\n\n            <p>o seu neg&oacute;cio. Voc&ecirc; n&atilde;o deve, direta ou indiretamente, se envolver ou associar-se com, estar conectado com, preocupado, empregado, ou tempo ou prosseguir qualquer curso de estudo, sem a permiss&atilde;o pr&eacute;via do Company.engajado em qualquer outro neg&oacute;cio ou atividades ou qualquer outro cargo ou trabalho parcial ou prosseguir qualquer curso de estudo, sem a permiss&atilde;o pr&eacute;via do</p>\n\n            <p>Empresa.</p>\n\n            <p>11,2 &Eacute; preciso manter sempre o mais alto grau de confidencialidade e manter como confidenciais os registros, documentos e outros&nbsp;</p>\n\n            <p>Informa&ccedil;&otilde;es confidenciais relativas ao neg&oacute;cio da Companhia que possam ser conhecidas por voc&ecirc; ou confiadas em voc&ecirc; por qualquer meio e utilizar&atilde;o tais registros, documentos e informa&ccedil;&otilde;es apenas de forma devidamente autorizada no interesse da Companhia. Para efeitos da presente cl&aacute;usula \"Informa&ccedil;&otilde;es confidenciais\" significa informa&ccedil;&atilde;o sobre os neg&oacute;cios da Companhia e a dos seus clientes que n&atilde;o est&aacute; dispon&iacute;vel para o p&uacute;blico em geral e que poder&aacute; ser aprendida por voc&ecirc; no curso do seu emprego. Isso inclui,</p>\n\n            <p>mas n&atilde;o se limita a, informa&ccedil;&otilde;es relativas &agrave; organiza&ccedil;&atilde;o, suas listas de clientes, pol&iacute;ticas de emprego, pessoal, e informa&ccedil;&otilde;es sobre os produtos da Companhia, processos incluindo ideias, conceitos, proje&ccedil;&otilde;es, tecnologia, manuais, desenho, desenhos,&nbsp;</p>\n\n            <p>especifica&ccedil;&otilde;es, e todos os pap&eacute;is, curr&iacute;culos, registros e outros documentos que contenham tais Informa&ccedil;&otilde;es Confidenciais.</p>\n\n            <p>11,3 Em nenhum momento, voc&ecirc; remover&aacute; quaisquer Informa&ccedil;&otilde;es Confidenciais do escrit&oacute;rio sem permiss&atilde;o.</p>\n\n            <p>11,4 O seu dever de salvaguardar e n&atilde;o os desclos</p>\n\n            <p>Informa&ccedil;&otilde;es Confidenciais sobreviver&atilde;o &agrave; expira&ccedil;&atilde;o ou &agrave; rescis&atilde;o deste Contrato e / ou do seu emprego com a Companhia.</p>\n\n            <p>11,5 Viola&ccedil;&atilde;o das condi&ccedil;&otilde;es desta cl&aacute;usula ir&aacute; torn&aacute;-lo sujeito a demiss&atilde;o sum&aacute;ria sob a cl&aacute;usula acima, al&eacute;m de qualquer outro rem&eacute;dio que a Companhia possa ter contra voc&ecirc; em lei.</p>\n\n\n\n            <p>12. Notices</p>\n\n            <p>Os avisos podem ser conferidos por voc&ecirc; &agrave; Empresa em seu endere&ccedil;o de escrit&oacute;rio registrado. Os avisos podem ser conferidos pela Companhia a voc&ecirc; no endere&ccedil;o intimado por voc&ecirc; nos registros oficiais.</p>\n\n\n\n            <p>13. Aplicabilidade da Pol&iacute;tica da Empresa</p>\n\n            <p>A Companhia tem direito a fazer declara&ccedil;&otilde;es de pol&iacute;tica de tempos em tempos relativos a mat&eacute;rias como licen&ccedil;a de licen&ccedil;a, maternidade</p>\n\n            <p>sair, benef&iacute;cios dos empregados, horas de trabalho, pol&iacute;ticas de transfer&ecirc;ncia, etc., e pode alterar o mesmo de vez em quando a seu exclusivo crit&eacute;rio.</p>\n\n            <p>Todas essas decis&otilde;es de pol&iacute;tica da Companhia devem ser vinculativas para si e substituir&atilde;o este Acordo nessa medida.</p>\n\n\n\n            <p>14. Direito / Jurisdi&ccedil;&atilde;o</p>\n\n            <p>Seu emprego com a Companhia est&aacute; sujeito &agrave;s leis do Pa&iacute;s. Todas as disputas est&atilde;o sujeitas &agrave; jurisdi&ccedil;&atilde;o do Tribunal Superior</p>\n\n            <p>Gujarat apenas.</p>\n\n\n\n            <p>15. Aceita&ccedil;&atilde;o da nossa oferta</p>\n\n            <p>Por favor, confirme sua aceita&ccedil;&atilde;o deste Contrato de Emprego assinando e retornando a c&oacute;pia duplicada.</p>\n\n\n\n            <p>N&oacute;s acolhemos voc&ecirc; e estamos ansiosos para receber sua aceita&ccedil;&atilde;o e para trabalhar com voc&ecirc;.</p>\n\n\n\n            <p>Seu Sinceramente,</p>\n\n            <p>{app_name}</p>\n\n            <p>{data}</p>\n            ', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(13, 'ru', '<h3 style=\"text-align: center;\">Присоединение к письму</h3>\n\n            <p>{date}</p>\n\n            <p>{ employee_name }</p>\n            <p>{address}</p>\n\n            <p>Тема: Назначение на должность {designation}</p>\n\n            <p>Уважаемый { employee_name },</p>\n\n            <p>Мы рады предложить Вам, позицию {designation} с { app_name } Компания на следующих условиях и</p>\n\n            <p>условия:</p>\n\n\n            <p>1. Начало работы</p>\n\n            <p>Ваше трудоустройство будет эффективным, начиная с { start_date }</p>\n\n\n            <p>2. Название должности</p>\n            <p>Ваш заголовок задания будет {designation}.</p>\n\n            <p>3. Зарплата</p>\n            <p>Ваши оклады и другие пособия будут установлены в соответствии с расписанием, изложенным в приложении 1 к настоящему.</p>\n\n            <p>4. Место размещения</p>\n            <p>Вы будете работать в { branch }. Вы, однако, можете работать в любом месте, которое компания имеет или может впоследствии приобрести.</p>\n\n\n\n            <p>5. Часы работы</p>\n            <p>Обычные рабочие дни-с понедельника по пятницу. Вы должны будете работать в течение таких часов, как это необходимо для надлежащего выполнения Ваших обязанностей перед компанией. Обычные рабочие часы-от { start_time } до { end_time }, и вы, как ожидается, будут работать не менее { total_hours } часов каждую неделю, и при необходимости в течение дополнительных часов в зависимости от вашего</p>\n            <p>ответственности.</p>\n            <p>6. Отпуск/Праздники</p>\n\n            <p>6.1 Вы имеете право на случайный отпуск продолжительностью 12 дней.</p>\n\n            <p>6.2 Вы имеете право на 12 рабочих дней оплачиваемого отпуска по болезни.</p>\n\n            <p>6.3 Компания в начале каждого года уведомляет об объявленных праздниках.&nbsp;</p>\n\n\n\n            <p>7. Характер обязанностей</p>\n\n            <p>Вы будете выполнять все обязанности, присующие вам, и такие дополнительные обязанности, которые компания может призвать к вам, время от времени. Ваши конкретные обязанности изложены в приложении II к настоящему.</p>\n\n\n\n            <p>8. Свойство компании</p>\n\n            <p>Вы всегда будете поддерживать в хорошем состоянии имущество Компании, которое может быть доверено Вам для служебного пользования в течение</p>\n\n            <p>вашей занятости, и возвратит все это имущество Компании до отказа от вашего заряда, при отсутствии которого стоимость одного и того же имущества будет взыскана с Вас компанией.</p>\n\n\n\n            <p>9. Боровить/принять подарки</p>\n\n            <p>Вы не будете брать взаймы или принимать какие-либо деньги, подарки, вознаграждение или компенсацию за ваши личные доходы от или в ином месте под денежный долг любому лицу/клиенту, с которым у вас могут быть официальные сделки.</p>\n\n\n\n            <p>10. Прекращение</p>\n\n            <p>10.1 Ваше назначение может быть прекращено компанией без каких бы то ни было оснований, предоставляя Вам не менее [ Уведомление] месяцев, предшея уведомлению в письменной форме или окладе вместо них. Для целей этого положения заработная плата означает базовый оклад.</p>\n\n            <p>10.2 Вы можете прекратить свою трудовую деятельность с компанией без каких-либо причин, предоставляя не меньше, чем [ Employee Notice] months  предварительное уведомление или оклад за несохраненный период, оставатся после корректировки отложенных листьев, как на сегодняшний день.</p>\n\n            <p>10.3 Компания оставляет за собой право прекратить вашу работу в суммарном порядке без какого-либо уведомления о сроке или увольнении, если у нее есть достаточные основания полагать, что вы виновны в проступке или халатности, или совершили какое-либо существенное нарушение договора, или причинило убытки Компании.&nbsp;</p>\n\n            <p>10. 4 О прекращении вашей работы по какой бы то ни было причине вы вернетесь в Компании все имущество; документы, а&nbsp;</p>\n\n            <p>бумаги, как оригинальные, так и их копии, включая любые образцы, литературу, контракты, записи, списки, чертежи, чертежи,</p>\n\n            <p>письма, заметки, данные и тому подобное; и Конфиденциальная информация, в вашем распоряжении или под вашим контролем, связанным с вашей работой или деловыми делами клиентов.&nbsp; &nbsp;</p>\n\n\n\n            <p>11. Конфиденциальная информация</p>\n\n            <p>11. 1 Во время вашего трудоустройства с компанией Вы посвяте все свое время, внимание, умение максимально</p>\n\n            <p>Его бизнес. Вы не должны, прямо или косвенно, заниматься или ассоциировать себя с заинтересованными, занятым, занятым, или временем, или продолжать любой курс обучения, без предварительного разрешения Компани.заниматься каким-либо другим бизнесом или деятельностью или любой другой пост или работать неполный рабочий день или заниматься какой бы то ни было исследованием, без предварительного разрешения</p>\n\n            <p>Компания.</p>\n\n            <p>11.2 Вы всегда должны сохранять наивысшую степень конфиденциальности и хранить в качестве конфиденциальной записи, документы и другие&nbsp;</p>\n\n            <p>Конфиденциальная информация, касающаяся бизнеса Компании, которая может быть вам известна или конфиденциальна любым способом, и Вы будете использовать такие записи, документы и информацию только в установленном порядке в интересах Компании. Для целей настоящей статьи \"Конфиденциальная информация\" означает информацию о бизнесе Компании и о ее клиентах, которая недоступна для широкой общественности и которая может быть изучилась Вами в ходе вашей работы. Это включает в себя:</p>\n\n            <p>но не ограничивается информацией, касающейся организации, ее списков клиентов, политики в области занятости, персонала и информации о продуктах Компании, процессах, включая идеи, концепции, прогнозы, технологии, руководства, чертеж, чертеж,&nbsp;</p>\n\n            <p>спецификации, и все бумаги, резюме, записи и другие документы, содержащие такую Конфиденциальную Информацию.</p>\n\n            <p>11.3 В любое время вы не будете удалять конфиденциальную информацию из офиса без разрешения.</p>\n\n            <p>11.4 Ваш долг защищать и не отсосать</p>\n\n            <p>e Конфиденциальная информация выдержит срок действия или прекращения действия настоящего Соглашения и/или вашей работы с компанией.</p>\n\n            <p>11.5 Нарушение условий, изложенных в настоящем положении, приведет к тому, что в дополнение к любым другим средствам правовой защиты, которые компания может иметь против вас, в соответствии с вышеприведенным положением, вы можете получить краткое увольнение в соответствии с этим положением.</p>\n\n\n\n            <p>12. Замечания</p>\n\n            <p>Уведомления могут быть даны Вами Компании по адресу ее зарегистрированного офиса. Извещения могут быть даны компанией Вам по адресу, с которым вы в официальных отчетах.</p>\n\n\n\n            <p>13. Применимость политики компании</p>\n\n            <p>Компания вправе время от времени делать политические заявления по таким вопросам, как право на отпуск, материнство</p>\n\n            <p>отпуска, пособия для работников, продолжительность рабочего дня, трансферная политика и т.д. и время от времени могут изменяться исключительно по своему усмотрению.</p>\n\n            <p>Все такие принципиальные решения Компании являются обязательными для Вас и переопределяют это Соглашение в такой степени.</p>\n\n\n\n            <p>14. Регулирующий Право/юрисдикция</p>\n\n            <p>Ваше трудоустройство с компанией подпадает под действие законов страны. Все споры подлежат юрисдикции Высокого суда</p>\n\n            <p>Только Гуджарат.</p>\n\n\n\n            <p>15. Принятие нашего предложения</p>\n\n            <p>Пожалуйста, подтвердите свое согласие с этим Договором о занятости, подписав и возвращая дубликат копии.</p>\n\n\n\n            <p>Мы приветствуем Вас и надеемся на то, что Вы принимаете свое согласие и работаете с Вами.</p>\n\n\n\n            <p>Искренне Ваш,</p>\n\n            <p>{ app_name }</p>\n\n            <p>{date}</p>\n            ', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `labels`
--

CREATE TABLE `labels` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pipeline_id` int NOT NULL,
  `created_by` int NOT NULL,
  `workspace_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `pipeline_id` int NOT NULL,
  `stage_id` int NOT NULL,
  `sources` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `products` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `labels` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int NOT NULL,
  `workspace_id` int NOT NULL,
  `is_active` int NOT NULL DEFAULT '1',
  `is_converted` int NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lead_activity_logs`
--

CREATE TABLE `lead_activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `lead_id` bigint UNSIGNED NOT NULL,
  `log_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lead_calls`
--

CREATE TABLE `lead_calls` (
  `id` bigint UNSIGNED NOT NULL,
  `lead_id` bigint UNSIGNED NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `call_type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `call_result` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lead_discussions`
--

CREATE TABLE `lead_discussions` (
  `id` bigint UNSIGNED NOT NULL,
  `lead_id` bigint UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lead_emails`
--

CREATE TABLE `lead_emails` (
  `id` bigint UNSIGNED NOT NULL,
  `lead_id` bigint UNSIGNED NOT NULL,
  `to` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lead_files`
--

CREATE TABLE `lead_files` (
  `id` bigint UNSIGNED NOT NULL,
  `lead_id` bigint UNSIGNED NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lead_stages`
--

CREATE TABLE `lead_stages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pipeline_id` int NOT NULL,
  `created_by` int NOT NULL,
  `order` int NOT NULL DEFAULT '0',
  `workspace_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lead_stages`
--

INSERT INTO `lead_stages` (`id`, `name`, `pipeline_id`, `created_by`, `order`, `workspace_id`, `created_at`, `updated_at`) VALUES
(1, 'Draft', 1, 2, 0, 1, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(2, 'Sent', 1, 2, 0, 1, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(3, 'Open', 1, 2, 0, 1, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(4, 'Revised', 1, 2, 0, 1, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(5, 'Declined', 1, 2, 0, 1, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(6, 'Accepted', 1, 2, 0, 1, '2023-07-11 01:09:40', '2023-07-11 01:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int NOT NULL,
  `user_id` int NOT NULL,
  `leave_type_id` int NOT NULL,
  `applied_on` date NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_leave_days` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leave_reason` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `days` int NOT NULL,
  `created_by` int NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int NOT NULL,
  `loan_option` int NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reason` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_options`
--

CREATE TABLE `loan_options` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `workspace` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_05_08_094315_create_user_projects_table', 1),
(2, '2019_05_13_061456_create_tasks_table', 1),
(3, '2019_05_15_054812_create_task_files_table', 1),
(4, '2019_10_14_220244_create_milestones_table', 1),
(5, '2019_10_14_233948_create_sub_tasks_table', 1),
(6, '2019_10_18_114133_create_activity_logs_table', 1),
(7, '2020_03_23_153638_create_stages_table', 1),
(8, '2022_06_16_092727_create_product_services_table', 1),
(9, '2022_06_16_101208_create_categories_table', 1),
(10, '2022_06_16_105042_create_taxes_table', 1),
(11, '2022_06_21_104337_create_projects_table', 1),
(12, '2022_07_14_085216_create_bug_stages_table', 1),
(13, '2022_07_14_132351_create_comments_table', 1),
(14, '2022_07_18_065110_create_bug_reports_table', 1),
(15, '2022_07_18_084714_create_bug_comments_table', 1),
(16, '2022_07_18_085513_create_bug_files_table', 1),
(17, '2022_07_19_060243_create_project_files_table', 1),
(18, '2022_07_19_065033_create_client_projects_table', 1),
(19, '2022_07_29_053844_create_documents_table', 1),
(20, '2022_08_02_042432_create_branches_table', 1),
(21, '2022_08_02_042732_create_departments_table', 1),
(22, '2022_08_02_043045_create_designations_table', 1),
(23, '2022_08_03_033850_create_employees_table', 1),
(24, '2022_08_04_100645_create_document_types_table', 1),
(25, '2022_08_04_115317_create_employee_documents_table', 1),
(26, '2022_08_05_090145_create_company_policies_table', 1),
(27, '2022_08_08_035249_create_leave_types_table', 1),
(28, '2022_08_08_052322_create_leaves_table', 1),
(29, '2022_08_10_034706_create_award_types_table', 1),
(30, '2022_08_10_034916_create_awards_table', 1),
(31, '2022_08_10_062802_create_transfers_table', 1),
(32, '2022_08_10_095523_create_resignations_table', 1),
(33, '2022_08_10_095553_create_attendance_table', 1),
(34, '2022_08_12_034422_create_travels_table', 1),
(35, '2022_08_12_052346_create_promotions_table', 1),
(36, '2022_08_12_084444_create_complaints_table', 1),
(37, '2022_08_12_101620_create_warnings_table', 1),
(38, '2022_08_15_043757_create_terminations_table', 1),
(39, '2022_08_15_045640_create_termination_types_table', 1),
(40, '2022_08_15_063340_create_announcements_table', 1),
(41, '2022_08_15_063707_create_announcement_employees_table', 1),
(42, '2022_08_15_083906_create_holidays_table', 1),
(43, '2022_08_16_102132_create_time_sheets_table', 1),
(44, '2022_08_17_085828_create_payslip_types_table', 1),
(45, '2022_08_17_100022_create_allowance_options_table', 1),
(46, '2022_08_17_105340_create_loan_options_table', 1),
(47, '2022_08_17_114510_create_deduction_options_table', 1),
(48, '2022_08_18_042511_create_allowances_table', 1),
(49, '2022_08_18_042844_create_commissions_table', 1),
(50, '2022_08_18_044251_create_loans_table', 1),
(51, '2022_08_18_044602_create_saturation_deductions_table', 1),
(52, '2022_08_18_044811_create_other_payments_table', 1),
(53, '2022_08_18_045057_create_overtimes_table', 1),
(54, '2022_08_22_054305_create_pay_slips_table', 1),
(55, '2022_08_25_110944_create_bank_accounts_table', 1),
(56, '2022_08_26_050328_create_bank_transfers_table', 1),
(57, '2022_08_29_071056_create_units_table', 1),
(58, '2022_08_31_033838_create_customers_table', 1),
(59, '2022_09_01_040217_create_venders_table', 1),
(60, '2022_09_01_112521_create_revenues_table', 1),
(61, '2022_09_01_115012_create_currency_table', 1),
(62, '2022_09_01_115012_create_failed_jobs_table', 1),
(63, '2022_09_01_115012_create_model_has_permissions_table', 1),
(64, '2022_09_01_115012_create_model_has_roles_table', 1),
(65, '2022_09_01_115012_create_notifications_table', 1),
(66, '2022_09_01_115012_create_orders_table', 1),
(67, '2022_09_01_115012_create_password_resets_table', 1),
(68, '2022_09_01_115012_create_permissions_table', 1),
(69, '2022_09_01_115012_create_personal_access_tokens_table', 1),
(70, '2022_09_01_115012_create_plans_table', 1),
(71, '2022_09_01_115012_create_role_has_permissions_table', 1),
(72, '2022_09_01_115012_create_roles_table', 1),
(73, '2022_09_01_115012_create_settings_table', 1),
(74, '2022_09_01_115012_create_sidebar_table', 1),
(75, '2022_09_01_115012_create_users_table', 1),
(76, '2022_09_01_115013_add_foreign_keys_to_model_has_permissions_table', 1),
(77, '2022_09_01_115013_add_foreign_keys_to_model_has_roles_table', 1),
(78, '2022_09_01_115013_add_foreign_keys_to_role_has_permissions_table', 1),
(79, '2022_09_01_115013_create_plan_fields_table', 1),
(80, '2022_09_02_052135_create_stock_reports_table', 1),
(81, '2022_09_05_092207_create_transactions_table', 1),
(82, '2022_09_05_115417_create_leads_table', 1),
(83, '2022_09_05_125026_create_pipelines_table', 1),
(84, '2022_09_06_092036_add_fields_user_tables', 1),
(85, '2022_09_07_053233_create_lead_stages_table', 1),
(86, '2022_09_07_083901_create_deal_stages_table', 1),
(87, '2022_09_07_084035_create_deals_table', 1),
(88, '2022_09_07_095211_create_user_deals_table', 1),
(89, '2022_09_07_095417_create_user_leads_table', 1),
(90, '2022_09_07_110631_create_labels_table', 1),
(91, '2022_09_07_124424_create_bills_table', 1),
(92, '2022_09_07_125134_create_payments_table', 1),
(93, '2022_09_08_053530_create_lead_files_table', 1),
(94, '2022_09_08_053708_create_lead_calls_table', 1),
(95, '2022_09_08_053744_create_lead_emails_table', 1),
(96, '2022_09_08_054005_create_lead_activity_logs_table', 1),
(97, '2022_09_08_054051_create_lead_discussions_table', 1),
(98, '2022_09_08_060852_create_bill_products_table', 1),
(99, '2022_09_08_084653_create_client_deals_table', 1),
(100, '2022_09_08_084731_create_deal_discussions_table', 1),
(101, '2022_09_08_084757_create_deal_files_table', 1),
(102, '2022_09_08_084858_create_deal_calls_table', 1),
(103, '2022_09_08_084924_create_deal_emails_table', 1),
(104, '2022_09_12_095504_create_sources_table', 1),
(105, '2022_09_12_121817_create_debit_notes_table', 1),
(106, '2022_09_12_122223_create_bill_payments_table', 1),
(107, '2022_09_13_092723_create_work_spaces_table', 1),
(108, '2022_09_13_110539_create_email_templates_table', 1),
(109, '2022_09_13_110601_create_email_template_langs_table', 1),
(110, '2022_09_13_123608_create_deal_tasks_table', 1),
(111, '2022_09_13_123624_create_client_permissions_table', 1),
(112, '2022_09_14_060053_create_deal_activity_logs_table', 1),
(113, '2022_09_22_110515_create_invoices_table', 1),
(114, '2022_09_22_115114_create_invoice_products_table', 1),
(115, '2022_09_22_115757_create_invoice_payments_table', 1),
(116, '2022_09_22_120254_create_credit_notes_table', 1),
(117, '2022_10_17_035725_create_events_table', 1),
(118, '2022_10_17_051622_create_event_employees_table', 1),
(119, '2022_10_18_114457_create_warehouses_table', 1),
(120, '2022_10_19_052117_create_purchases_table', 1),
(121, '2022_10_19_052459_create_purchase_products_table', 1),
(122, '2022_10_19_052610_create_purchase_payments_table', 1),
(123, '2022_10_19_061337_create_custom_fields_module_list_table', 1),
(124, '2022_10_31_093524_create_warehouse_products_table', 1),
(125, '2022_11_02_070509_create_pos_table', 1),
(126, '2022_11_03_105649_create_pos_products_table', 1),
(127, '2022_11_03_112845_create_pos_payments_table', 1),
(128, '2022_11_29_033218_create_proposals_table', 1),
(129, '2022_11_29_033517_create_proposal_products_table', 1),
(130, '2022_12_23_093607_create_joining_letters_table', 1),
(131, '2022_12_23_093714_create_experience_certificates_table', 1),
(132, '2022_12_23_093737_create_noc_certificates_table', 1),
(133, '2023_01_10_99999_add_avatar_to_users', 1),
(134, '2023_01_10_99999_add_dark_mode_to_users', 1),
(135, '2023_01_10_99999_add_messenger_color_to_users', 1),
(136, '2023_01_10_99999_create_favorites_table', 1),
(137, '2023_01_10_99999_create_messages_table', 1),
(138, '2023_01_12_99999_add_active_status_to_users', 1),
(139, '2023_03_24_040418_create_ip_restricts_table', 1),
(140, '2023_05_01_071811_create_add_ons_table', 1),
(141, '2023_06_10_030606_create_api_key_settings_table', 1),
(142, '2023_06_12_045000_create_login_details_table', 1),
(143, '2023_06_21_122455_create_bank_transfer_payments_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `milestones`
--

CREATE TABLE `milestones` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` int NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` double(8,2) NOT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `progress` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `noc_certificates`
--

CREATE TABLE `noc_certificates` (
  `id` bigint UNSIGNED NOT NULL,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `noc_certificates`
--

INSERT INTO `noc_certificates` (`id`, `lang`, `content`, `workspace`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'ar', '<h3 style=\"text-align: center;\">شهادة عدم ممانعة</h3>\n\n\n\n            <p>التاريخ: {date}</p>\n\n\n\n            <p>إلى من يهمه الأمر</p>\n\n\n\n            <p>هذه الشهادة مخصصة للمطالبة بشهادة عدم ممانعة (NoC) للسيدة / السيد {employee_name} إذا انضمت إلى أي مؤسسة أخرى وقدمت خدماتها / خدماتها. يتم إبلاغه لأنه قام بتصفية جميع أرصدته واستلام أمانه من شركة {app_name}.</p>\n\n\n\n            <p>نتمنى لها / لها التوفيق في المستقبل.</p>\n\n\n\n            <p>بإخلاص،</p>\n\n            <p>{employee_name}</p>\n\n            <p>{designation}</p>\n\n            <p>التوقيع</p>\n\n            <p>{app_name}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(2, 'da', '<h3 style=\"text-align: center;\">Ingen indsigelsesattest</h3>\n\n\n\n            <p>Dato: {date}</p>\n\n\n\n            <p>Til hvem det m&aring;tte vedr&oslash;re</p>\n\n\n\n            <p>Dette certifikat er for at g&oslash;re krav p&aring; et No Objection Certificate (NoC) for Ms. / Mr. {employee_name}, hvis hun/han tilslutter sig og leverer sine tjenester til enhver anden organisation. Det informeres, da hun/han har udlignet alle sine saldi og modtaget sin sikkerhed fra {app_name}-virksomheden.</p>\n\n\n\n            <p>Vi &oslash;nsker hende/ham held og lykke i fremtiden.</p>\n\n\n\n            <p>Med venlig hilsen</p>\n\n            <p>{employee_name}</p>\n\n            <p>{designation}</p>\n\n            <p>Underskrift</p>\n\n            <p>{app_name}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(3, 'de', '<h3 style=\"text-align: center;\">Kein Einwand-Zertifikat</h3>\n\n\n\n            <p>Datum {date}</p>\n\n\n\n            <p>Wen auch immer es betrifft</p>\n\n\n\n            <p>Dieses Zertifikat soll ein Unbedenklichkeitszertifikat (NoC) f&uuml;r Frau / Herrn {employee_name} beanspruchen, wenn sie/er einer anderen Organisation beitritt und ihre/seine Dienste anbietet. Sie wird informiert, da sie/er alle ihre/seine Guthaben ausgeglichen und ihre/seine Sicherheit von der Firma {app_name} erhalten hat.</p>\n\n\n\n            <p>Wir w&uuml;nschen ihr/ihm viel Gl&uuml;ck f&uuml;r die Zukunft.</p>\n\n\n\n            <p>Aufrichtig,</p>\n\n            <p>{employee_name}</p>\n\n            <p>{designation}</p>\n\n            <p>Unterschrift</p>\n\n            <p>{app_name}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(4, 'en', '<p style=\"text-align: center;\"><span style=\"font-size: 18pt;\"><strong>No Objection Certificate</strong></span></p>\n\n            <p>Date: {date}</p>\n\n            <p>To Whomsoever It May Concern</p>\n\n            <p>This certificate is to claim a No Objection Certificate (NoC) for Ms. / Mr. {employee_name} if she/he joins and provides her/his services to any other organization. It is informed as she/he has cleared all her/his balances and received her/his security from {app_name} Company.</p>\n\n            <p>We wish her/him good luck in the future.</p>\n\n            <p>Sincerely,</p>\n            <p>{employee_name}</p>\n            <p>{designation}</p>\n            <p>Signature</p>\n            <p>{app_name}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(5, 'es', '<h3 style=\"text-align: center;\">Certificado de conformidad</h3>\n\n\n\n            <p>Fecha: {date}</p>\n\n\n\n            <p>A quien corresponda</p>\n\n\n\n            <p>Este certificado es para reclamar un Certificado de No Objeci&oacute;n (NoC) para la Sra. / Sr. {employee_name} si ella / &eacute;l se une y brinda sus servicios a cualquier otra organizaci&oacute;n. Se informa que &eacute;l/ella ha liquidado todos sus saldos y recibido su seguridad de {app_name} Company.</p>\n\n\n\n            <p>Le deseamos buena suerte en el futuro.</p>\n\n\n\n            <p>Sinceramente,</p>\n\n            <p>{employee_name}</p>\n\n            <p>{designation}</p>\n\n            <p>Firma</p>\n\n            <p>{app_name}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(6, 'fr', '<h3 style=\"text-align: center;\">Aucun certificat dopposition</h3>\n\n\n            <p>Date : {date}</p>\n\n\n            <p>&Agrave; toute personne concern&eacute;e</p>\n\n\n            <p>Ce certificat sert &agrave; r&eacute;clamer un certificat de non-objection (NoC) pour Mme / M. {employee_name} sil rejoint et fournit ses services &agrave; toute autre organisation. Il est inform&eacute; quil a sold&eacute; tous ses soldes et re&ccedil;u sa garantie de la part de la soci&eacute;t&eacute; {app_name}.</p>\n\n\n            <p>Nous lui souhaitons bonne chance pour lavenir.</p>\n\n\n            <p>Sinc&egrave;rement,</p>\n\n            <p>{employee_name}</p>\n\n            <p>{designation}</p>\n\n            <p>Signature</p>\n\n            <p>{app_name}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(7, 'id', '<h3 style=\"text-align: center;\">Sertifikat Tidak Keberatan</h3>\n\n\n\n            <p>Tanggal: {date}</p>\n\n\n\n            <p>Kepada Siapa Pun Yang Memprihatinkan</p>\n\n\n\n            <p>Sertifikat ini untuk mengklaim No Objection Certificate (NoC) untuk Ibu / Bapak {employee_name} jika dia bergabung dan memberikan layanannya ke organisasi lain mana pun. Diberitahukan karena dia telah melunasi semua saldonya dan menerima jaminannya dari Perusahaan {app_name}.</p>\n\n\n\n            <p>Kami berharap dia sukses di masa depan.</p>\n\n\n\n            <p>Sungguh-sungguh,</p>\n\n            <p>{employee_name}</p>\n\n            <p>{designation}</p>\n\n            <p>Tanda tangan</p>\n\n            <p>{app_name}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(8, 'it', '<h3 style=\"text-align: center;\">Certificato di nulla osta</h3>\n\n\n\n            <p>Data: {date}</p>\n\n\n\n            <p>A chi pu&ograve; interessare</p>\n\n\n\n            <p>Questo certificato serve a richiedere un certificato di non obiezione (NoC) per la signora / il signor {employee_name} se si unisce e fornisce i suoi servizi a qualsiasi altra organizzazione. Viene informato in quanto ha liquidato tutti i suoi saldi e ricevuto la sua sicurezza dalla societ&agrave; {app_name}.</p>\n\n\n\n            <p>Le auguriamo buona fortuna per il futuro.</p>\n\n\n\n            <p>Cordiali saluti,</p>\n\n            <p>{employee_name}</p>\n\n            <p>{designation}</p>\n\n            <p>Firma</p>\n\n            <p>{app_name}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(9, 'ja', '<h3 style=\"text-align: center;\">異議なし証明書</h3>\n\n\n\n            <p>日付: {date}</p>\n\n\n\n            <p>関係者各位</p>\n\n\n\n            <p>この証明書は、Ms. / Mr. {employee_name} が他の組織に参加してサービスを提供する場合に、異議なし証明書 (NoC) を請求するためのものです。彼女/彼/彼がすべての残高を清算し、{app_name} 会社から彼女/彼のセキュリティを受け取ったことが通知されます。</p>\n\n\n\n            <p>彼女/彼の今後の幸運を祈っています。</p>\n\n\n\n            <p>心から、</p>\n\n            <p>{employee_name}</p>\n\n            <p>{designation}</p>\n\n            <p>サイン</p>\n\n            <p>{app_name}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(10, 'nl', '<h3 style=\"text-align: center;\">Geen bezwaarcertificaat</h3>\n\n\n\n            <p>Datum: {date}</p>\n\n\n\n            <p>Aan wie het ook aangaat</p>\n\n\n\n            <p>Dit certificaat is bedoeld om aanspraak te maken op een Geen Bezwaarcertificaat (NoC) voor mevrouw/dhr. {employee_name} als zij/hij lid wordt en haar/zijn diensten verleent aan een andere organisatie. Het wordt ge&iuml;nformeerd als zij/hij al haar/zijn saldos heeft gewist en haar/zijn zekerheid heeft ontvangen van {app_name} Company.</p>\n\n\n\n            <p>We wensen haar/hem veel succes in de toekomst.</p>\n\n\n\n            <p>Eerlijk,</p>\n\n            <p>{employee_name}</p>\n\n            <p>{designation}</p>\n\n            <p>Handtekening</p>\n\n            <p>{app_name}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(11, 'pl', '<h3 style=\"text-align: center;\">Certyfikat braku sprzeciwu</h3>\n\n\n\n            <p>Data: {date}</p>\n\n\n\n            <p>Do kogo to może dotyczyć</p>\n\n\n\n            <p>Ten certyfikat służy do ubiegania się o Certyfikat No Objection Certificate (NoC) dla Pani/Pana {employee_name}, jeśli ona/ona dołącza i świadczy swoje usługi na rzecz jakiejkolwiek innej organizacji. Jest o tym informowany, ponieważ wyczyścił wszystkie swoje salda i otrzymał swoje zabezpieczenie od firmy {app_name}.</p>\n\n\n\n            <p>Życzymy jej/jej powodzenia w przyszłości.</p>\n\n\n\n            <p>Z poważaniem,</p>\n\n            <p>{employee_name}</p>\n\n            <p>{designation}</p>\n\n            <p>Podpis</p>\n\n            <p>{app_name}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(12, 'pt', '<h3 style=\"text-align: center;\">Certificado de n&atilde;o obje&ccedil;&atilde;o</h3>\n\n\n\n            <p>Data: {date}</p>\n\n\n\n            <p>A quem interessar</p>\n\n\n\n            <p>Este certificado &eacute; para reivindicar um Certificado de N&atilde;o Obje&ccedil;&atilde;o (NoC) para a Sra. / Sr. {employee_name} se ela ingressar e fornecer seus servi&ccedil;os a qualquer outra organiza&ccedil;&atilde;o. &Eacute; informado que ela cancelou todos os seus saldos e recebeu sua garantia da empresa {app_name}.</p>\n\n\n\n            <p>Desejamos-lhe boa sorte no futuro.</p>\n\n\n\n            <p>Sinceramente,</p>\n\n            <p>{employee_name}</p>\n\n            <p>{designation}</p>\n\n            <p>Assinatura</p>\n\n            <p>{app_name}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(13, 'ru', '<h3 style=\"text-align: center;\">Сертификат об отсутствии возражений</h3>\n\n\n\n            <p>Дата: {date}</p>\n\n\n\n            <p>Кого бы это ни касалось</p>\n\n\n\n            <p>Этот сертификат предназначен для получения Сертификата об отсутствии возражений (NoC) для г-жи / г-на {employee_name}, если она / он присоединяется и предоставляет свои услуги любой другой организации. Сообщается, что она/он очистила все свои балансы и получила свою безопасность от компании {app_name}.</p>\n\n\n\n            <p>Мы желаем ей/ему удачи в будущем.</p>\n\n\n\n            <p>Искренне,</p>\n\n            <p>{employee_name}</p>\n\n            <p>{designation}</p>\n\n            <p>Подпись</p>\n\n            <p>{app_name}</p>', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `module` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(188) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissions` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `workspace_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `module`, `type`, `action`, `status`, `permissions`, `workspace_id`, `created_at`, `updated_at`) VALUES
(1, 'general', 'mail', 'Create User', 'on', 'user manage', 0, '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(2, 'general', 'mail', 'Customer Invoice Send', 'on', 'invoice send', 0, '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(3, 'general', 'mail', 'Payment Reminder', 'on', 'invoice manage', 0, '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(4, 'general', 'mail', 'Invoice Payment Create', 'on', 'invoice payment create', 0, '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(5, 'general', 'mail', 'Proposal Status Updated', 'on', 'proposal send', 0, '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(6, 'general', 'slack', 'New Invoice', 'on', NULL, 0, '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(7, 'general', 'slack', 'Invoice Status Updated', 'on', NULL, 0, '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(8, 'general', 'slack', 'New Proposal', 'on', NULL, 0, '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(9, 'general', 'slack', 'Proposal Status Updated', 'on', NULL, 0, '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(10, 'general', 'telegram', 'New Invoice', 'on', NULL, 0, '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(11, 'general', 'telegram', 'Invoice Status Updated', 'on', NULL, 0, '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(12, 'general', 'telegram', 'New Proposal', 'on', NULL, 0, '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(13, 'general', 'telegram', 'Proposal Status Updated', 'on', NULL, 0, '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(14, 'general', 'twilio', 'New Invoice', 'on', NULL, 0, '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(15, 'general', 'twilio', 'Invoice Status Updated', 'on', NULL, 0, '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(16, 'general', 'twilio', 'New Proposal', 'on', NULL, 0, '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(17, 'general', 'twilio', 'Proposal Status Updated', 'on', NULL, 0, '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(18, 'Account', 'slack', 'New Customer', 'on', NULL, 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(19, 'Account', 'slack', 'New Bill', 'on', NULL, 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(20, 'Account', 'slack', 'New Vendor', 'on', NULL, 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(21, 'Account', 'slack', 'New Revenue', 'on', NULL, 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(22, 'Account', 'slack', 'New Payment', 'on', NULL, 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(23, 'Account', 'telegram', 'New Customer', 'on', NULL, 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(24, 'Account', 'telegram', 'New Bill', 'on', NULL, 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(25, 'Account', 'telegram', 'New Vendor', 'on', NULL, 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(26, 'Account', 'telegram', 'New Revenue', 'on', NULL, 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(27, 'Account', 'telegram', 'New Payment', 'on', NULL, 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(28, 'Account', 'twilio', 'New Customer', 'on', NULL, 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(29, 'Account', 'twilio', 'New Bill', 'on', NULL, 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(30, 'Account', 'twilio', 'New Vendor', 'on', NULL, 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(31, 'Account', 'twilio', 'New Revenue', 'on', NULL, 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(32, 'Account', 'twilio', 'New Payment', 'on', NULL, 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(33, 'Account', 'mail', 'Bill Send', 'on', 'bill send', 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(34, 'Account', 'mail', 'Bill Payment Create', 'on', 'bill payment create', 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(35, 'Account', 'mail', 'Revenue Payment Create', 'on', 'revenue create', 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(36, 'Hrm', 'slack', 'New Award', 'on', NULL, 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(37, 'Hrm', 'slack', 'New Announcement', 'on', NULL, 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(38, 'Hrm', 'slack', 'New Holidays', 'on', NULL, 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(39, 'Hrm', 'slack', 'New Monthly Payslip', 'on', NULL, 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(40, 'Hrm', 'slack', 'New Event', 'on', NULL, 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(41, 'Hrm', 'slack', 'New Company Policy', 'on', NULL, 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(42, 'Hrm', 'telegram', 'New Award', 'on', NULL, 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(43, 'Hrm', 'telegram', 'New Announcement', 'on', NULL, 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(44, 'Hrm', 'telegram', 'New Holidays', 'on', NULL, 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(45, 'Hrm', 'telegram', 'New Monthly Payslip', 'on', NULL, 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(46, 'Hrm', 'telegram', 'New Event', 'on', NULL, 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(47, 'Hrm', 'telegram', 'New Company Policy', 'on', NULL, 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(48, 'Hrm', 'twilio', 'New Monthly Payslip', 'on', NULL, 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(49, 'Hrm', 'twilio', 'New Award', 'on', NULL, 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(50, 'Hrm', 'twilio', 'New Event', 'on', NULL, 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(51, 'Hrm', 'twilio', 'Leave Approve/Reject', 'on', NULL, 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(52, 'Hrm', 'twilio', 'New Trip', 'on', NULL, 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(53, 'Hrm', 'twilio', 'New Announcement', 'on', NULL, 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(54, 'Hrm', 'mail', 'Leave Status', 'on', 'leave approver manage', 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(55, 'Hrm', 'mail', 'New Award', 'on', 'award manage', 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(56, 'Hrm', 'mail', 'Employee Complaints', 'on', 'complaint manage', 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(57, 'Hrm', 'mail', 'New Payroll', 'on', 'setsalary pay slip manage', 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(58, 'Hrm', 'mail', 'Employee Promotion', 'on', 'promotion manage', 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(59, 'Hrm', 'mail', 'Employee Resignation', 'on', 'resignation manage', 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(60, 'Hrm', 'mail', 'Employee Termination', 'on', 'termination manage', 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(61, 'Hrm', 'mail', 'Employee Transfer', 'on', 'transfer manage', 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(62, 'Hrm', 'mail', 'Employee Trip', 'on', 'travel manage', 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(63, 'Hrm', 'mail', 'Employee Warning', 'on', 'warning manage', 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(64, 'Lead', 'slack', 'New Lead', 'on', NULL, 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(65, 'Lead', 'slack', 'Lead to Deal Conversion', 'on', NULL, 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(66, 'Lead', 'slack', 'New Deal', 'on', NULL, 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(67, 'Lead', 'slack', 'Lead Moved', 'on', NULL, 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(68, 'Lead', 'slack', 'Deal Moved', 'on', NULL, 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(69, 'Lead', 'telegram', 'New Lead', 'on', NULL, 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(70, 'Lead', 'telegram', 'Lead to Deal Conversion', 'on', NULL, 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(71, 'Lead', 'telegram', 'New Deal', 'on', NULL, 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(72, 'Lead', 'telegram', 'Lead Moved', 'on', NULL, 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(73, 'Lead', 'telegram', 'Deal Moved', 'on', NULL, 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(74, 'Lead', 'twilio', 'New Lead', 'on', NULL, 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(75, 'Lead', 'twilio', 'Lead to Deal Conversion', 'on', NULL, 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(76, 'Lead', 'twilio', 'New Deal', 'on', NULL, 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(77, 'Lead', 'twilio', 'Lead Moved', 'on', NULL, 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(78, 'Lead', 'twilio', 'Deal Moved', 'on', NULL, 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(79, 'Lead', 'mail', 'Deal Assigned', 'on', 'deal manage', 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(80, 'Lead', 'mail', 'Deal Moved', 'on', 'deal move', 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(81, 'Lead', 'mail', 'New Task', 'on', 'deal task create', 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(82, 'Lead', 'mail', 'Lead Assigned', 'on', 'lead manage', 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(83, 'Lead', 'mail', 'Lead Moved', 'on', 'lead move', 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(84, 'Lead', 'mail', 'Lead Emails', 'on', 'lead email create', 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(85, 'Lead', 'mail', 'Deal Emails', 'on', 'deal email create', 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(86, 'Pos', 'slack', 'New Purchase', 'on', NULL, 0, '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(87, 'Pos', 'slack', 'New Warehouse', 'on', NULL, 0, '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(88, 'Pos', 'telegram', 'New Purchase', 'on', NULL, 0, '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(89, 'Pos', 'telegram', 'New Warehouse', 'on', NULL, 0, '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(90, 'Pos', 'twilio', 'New Purchase', 'on', NULL, 0, '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(91, 'Pos', 'mail', 'Purchase Send', 'on', 'purchase send', 0, '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(92, 'Pos', 'mail', 'Purchase Payment Create', 'on', 'purchase payment create', 0, '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(93, 'Taskly', 'slack', 'New Project', 'on', NULL, 0, '2023-07-11 01:09:32', '2023-07-11 01:09:32'),
(94, 'Taskly', 'slack', 'New Milestone', 'on', NULL, 0, '2023-07-11 01:09:32', '2023-07-11 01:09:32'),
(95, 'Taskly', 'slack', 'New Task', 'on', NULL, 0, '2023-07-11 01:09:32', '2023-07-11 01:09:32'),
(96, 'Taskly', 'slack', 'Task Stage Updated', 'on', NULL, 0, '2023-07-11 01:09:32', '2023-07-11 01:09:32'),
(97, 'Taskly', 'slack', 'New Task Comment', 'on', NULL, 0, '2023-07-11 01:09:32', '2023-07-11 01:09:32'),
(98, 'Taskly', 'telegram', 'New Project', 'on', NULL, 0, '2023-07-11 01:09:32', '2023-07-11 01:09:32'),
(99, 'Taskly', 'telegram', 'New Milestone', 'on', NULL, 0, '2023-07-11 01:09:32', '2023-07-11 01:09:32'),
(100, 'Taskly', 'telegram', 'New Task', 'on', NULL, 0, '2023-07-11 01:09:32', '2023-07-11 01:09:32'),
(101, 'Taskly', 'telegram', 'Task Stage Updated', 'on', NULL, 0, '2023-07-11 01:09:32', '2023-07-11 01:09:32'),
(102, 'Taskly', 'telegram', 'New Task Comment', 'on', NULL, 0, '2023-07-11 01:09:32', '2023-07-11 01:09:32'),
(103, 'Taskly', 'twilio', 'New Project', 'on', NULL, 0, '2023-07-11 01:09:32', '2023-07-11 01:09:32'),
(104, 'Taskly', 'twilio', 'New Task', 'on', NULL, 0, '2023-07-11 01:09:32', '2023-07-11 01:09:32'),
(105, 'Taskly', 'twilio', 'New Bug', 'on', NULL, 0, '2023-07-11 01:09:32', '2023-07-11 01:09:32'),
(106, 'Taskly', 'mail', 'User Invited', 'on', NULL, 0, '2023-07-11 01:09:32', '2023-07-11 01:09:32'),
(107, 'Taskly', 'mail', 'Project Assigned', 'on', NULL, 0, '2023-07-11 01:09:32', '2023-07-11 01:09:32');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_number` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_exp_month` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_exp_year` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_id` int NOT NULL,
  `price` double(8,2) NOT NULL,
  `price_currency` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `txn_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receipt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `other_payments`
--

CREATE TABLE `other_payments` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` int NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `overtimes`
--

CREATE TABLE `overtimes` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_days` int NOT NULL,
  `hours` int NOT NULL,
  `rate` int NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `account_id` int NOT NULL,
  `vendor_id` int NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int NOT NULL,
  `recurring` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` int NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_receipt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payslip_types`
--

CREATE TABLE `payslip_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pay_slips`
--

CREATE TABLE `pay_slips` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int NOT NULL,
  `net_payble` int NOT NULL,
  `salary_month` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `basic_salary` int NOT NULL,
  `allowance` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `commission` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `loan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `saturation_deduction` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_payment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `overtime` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Base',
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `module`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'user manage', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(2, 'user create', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(3, 'user edit', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(4, 'user delete', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(5, 'user profile manage', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(6, 'user reset password', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(7, 'user login manage', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(8, 'user import', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(9, 'user logs history', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(10, 'setting manage', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(11, 'setting logo manage', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(12, 'setting theme manage', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(13, 'setting storage manage', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(14, 'plan manage', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(15, 'plan create', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(16, 'plan edit', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(17, 'plan delete', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(18, 'plan orders', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(19, 'module manage', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(20, 'module add', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(21, 'module remove', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(22, 'module edit', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(23, 'email template manage', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(24, 'api key setting manage', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(25, 'api key setting create', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(26, 'api key setting edit', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(27, 'api key setting delete', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(28, 'user chat manage', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(29, 'workspace manage', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(30, 'workspace create', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(31, 'workspace edit', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(32, 'workspace delete', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(33, 'roles manage', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(34, 'roles create', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(35, 'roles edit', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(36, 'roles delete', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(37, 'plan purchase', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(38, 'plan subscribe', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(39, 'proposal manage', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(40, 'proposal create', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(41, 'proposal edit', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(42, 'proposal delete', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(43, 'proposal show', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(44, 'proposal send', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(45, 'proposal duplicate', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(46, 'proposal product delete', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(47, 'proposal convert invoice', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(48, 'invoice manage', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(49, 'invoice create', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(50, 'invoice edit', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(51, 'invoice delete', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(52, 'invoice show', 'web', 'General', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(53, 'invoice send', 'web', 'General', 1, '2023-07-11 01:09:03', '2023-07-11 01:09:03'),
(54, 'invoice duplicate', 'web', 'General', 1, '2023-07-11 01:09:03', '2023-07-11 01:09:03'),
(55, 'invoice product delete', 'web', 'General', 1, '2023-07-11 01:09:03', '2023-07-11 01:09:03'),
(56, 'invoice payment create', 'web', 'General', 1, '2023-07-11 01:09:03', '2023-07-11 01:09:03'),
(57, 'invoice payment delete', 'web', 'General', 1, '2023-07-11 01:09:03', '2023-07-11 01:09:03'),
(58, 'account dashboard manage', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(59, 'bank account manage', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(60, 'bank account create', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(61, 'bank account edit', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(62, 'bank account delete', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(63, 'bank transfer manage', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(64, 'bank transfer create', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(65, 'bank transfer edit', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(66, 'bank transfer delete', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(67, 'account manage', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(68, 'customer manage', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(69, 'customer create', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(70, 'customer edit', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(71, 'customer delete', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(72, 'customer show', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(73, 'customer import', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(74, 'vendor manage', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(75, 'vendor create', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(76, 'vendor edit', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(77, 'vendor delete', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(78, 'vendor show', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(79, 'vendor import', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(80, 'creditnote manage', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(81, 'creditnote create', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(82, 'creditnote edit', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(83, 'creditnote delete', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(84, 'revenue manage', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(85, 'revenue create', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(86, 'revenue edit', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(87, 'revenue delete', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(88, 'report manage', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(89, 'bill manage', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(90, 'bill create', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(91, 'bill edit', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(92, 'bill delete', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(93, 'bill payment manage', 'web', 'Account', 0, '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(94, 'bill payment create', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(95, 'bill payment edit', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(96, 'bill payment delete', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(97, 'bill show', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(98, 'bill duplicate', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(99, 'bill product delete', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(100, 'bill send', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(101, 'debitnote manage', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(102, 'debitnote create', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(103, 'debitnote edit', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(104, 'debitnote delete', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(105, 'expense payment manage', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(106, 'expense payment create', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(107, 'expense payment edit', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(108, 'expense payment delete', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(109, 'report transaction manage', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(110, 'report statement manage', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(111, 'report income manage', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(112, 'report expense', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(113, 'report income vs expense manage', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(114, 'report tax manage', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(115, 'report loss & profit  manage', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(116, 'report invoice manage', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(117, 'report bill manage', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(118, 'report stock manage', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(119, 'sidebar income manage', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(120, 'sidebar expanse manage', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(121, 'sidebar banking manage', 'web', 'Account', 0, '2023-07-11 01:09:05', '2023-07-11 01:09:05'),
(122, 'hrm manage', 'web', 'Hrm', 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(123, 'hrm dashboard manage', 'web', 'Hrm', 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(124, 'sidebar hrm report manage', 'web', 'Hrm', 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(125, 'document manage', 'web', 'Hrm', 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(126, 'document create', 'web', 'Hrm', 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(127, 'document edit', 'web', 'Hrm', 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(128, 'document delete', 'web', 'Hrm', 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(129, 'attendance manage', 'web', 'Hrm', 0, '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(130, 'attendance create', 'web', 'Hrm', 0, '2023-07-11 01:09:07', '2023-07-11 01:09:07'),
(131, 'attendance edit', 'web', 'Hrm', 0, '2023-07-11 01:09:07', '2023-07-11 01:09:07'),
(132, 'attendance delete', 'web', 'Hrm', 0, '2023-07-11 01:09:07', '2023-07-11 01:09:07'),
(133, 'attendance import', 'web', 'Hrm', 0, '2023-07-11 01:09:07', '2023-07-11 01:09:07'),
(134, 'branch manage', 'web', 'Hrm', 0, '2023-07-11 01:09:07', '2023-07-11 01:09:07'),
(135, 'branch create', 'web', 'Hrm', 0, '2023-07-11 01:09:07', '2023-07-11 01:09:07'),
(136, 'branch edit', 'web', 'Hrm', 0, '2023-07-11 01:09:07', '2023-07-11 01:09:07'),
(137, 'branch delete', 'web', 'Hrm', 0, '2023-07-11 01:09:07', '2023-07-11 01:09:07'),
(138, 'department manage', 'web', 'Hrm', 0, '2023-07-11 01:09:07', '2023-07-11 01:09:07'),
(139, 'department create', 'web', 'Hrm', 0, '2023-07-11 01:09:07', '2023-07-11 01:09:07'),
(140, 'department edit', 'web', 'Hrm', 0, '2023-07-11 01:09:07', '2023-07-11 01:09:07'),
(141, 'department delete', 'web', 'Hrm', 0, '2023-07-11 01:09:07', '2023-07-11 01:09:07'),
(142, 'designation manage', 'web', 'Hrm', 0, '2023-07-11 01:09:07', '2023-07-11 01:09:07'),
(143, 'designation create', 'web', 'Hrm', 0, '2023-07-11 01:09:07', '2023-07-11 01:09:07'),
(144, 'designation edit', 'web', 'Hrm', 0, '2023-07-11 01:09:07', '2023-07-11 01:09:07'),
(145, 'designation delete', 'web', 'Hrm', 0, '2023-07-11 01:09:07', '2023-07-11 01:09:07'),
(146, 'employee manage', 'web', 'Hrm', 0, '2023-07-11 01:09:08', '2023-07-11 01:09:08'),
(147, 'employee create', 'web', 'Hrm', 0, '2023-07-11 01:09:08', '2023-07-11 01:09:08'),
(148, 'employee edit', 'web', 'Hrm', 0, '2023-07-11 01:09:08', '2023-07-11 01:09:08'),
(149, 'employee delete', 'web', 'Hrm', 0, '2023-07-11 01:09:08', '2023-07-11 01:09:08'),
(150, 'employee show', 'web', 'Hrm', 0, '2023-07-11 01:09:08', '2023-07-11 01:09:08'),
(151, 'employee profile manage', 'web', 'Hrm', 0, '2023-07-11 01:09:08', '2023-07-11 01:09:08'),
(152, 'employee profile show', 'web', 'Hrm', 0, '2023-07-11 01:09:08', '2023-07-11 01:09:08'),
(153, 'employee import', 'web', 'Hrm', 0, '2023-07-11 01:09:08', '2023-07-11 01:09:08'),
(154, 'documenttype manage', 'web', 'Hrm', 0, '2023-07-11 01:09:08', '2023-07-11 01:09:08'),
(155, 'documenttype create', 'web', 'Hrm', 0, '2023-07-11 01:09:08', '2023-07-11 01:09:08'),
(156, 'documenttype edit', 'web', 'Hrm', 0, '2023-07-11 01:09:08', '2023-07-11 01:09:08'),
(157, 'documenttype delete', 'web', 'Hrm', 0, '2023-07-11 01:09:08', '2023-07-11 01:09:08'),
(158, 'companypolicy manage', 'web', 'Hrm', 0, '2023-07-11 01:09:08', '2023-07-11 01:09:08'),
(159, 'companypolicy create', 'web', 'Hrm', 0, '2023-07-11 01:09:08', '2023-07-11 01:09:08'),
(160, 'companypolicy edit', 'web', 'Hrm', 0, '2023-07-11 01:09:09', '2023-07-11 01:09:09'),
(161, 'companypolicy delete', 'web', 'Hrm', 0, '2023-07-11 01:09:09', '2023-07-11 01:09:09'),
(162, 'leave manage', 'web', 'Hrm', 0, '2023-07-11 01:09:09', '2023-07-11 01:09:09'),
(163, 'leave create', 'web', 'Hrm', 0, '2023-07-11 01:09:09', '2023-07-11 01:09:09'),
(164, 'leave edit', 'web', 'Hrm', 0, '2023-07-11 01:09:09', '2023-07-11 01:09:09'),
(165, 'leave delete', 'web', 'Hrm', 0, '2023-07-11 01:09:09', '2023-07-11 01:09:09'),
(166, 'leave approver manage', 'web', 'Hrm', 0, '2023-07-11 01:09:09', '2023-07-11 01:09:09'),
(167, 'leavetype manage', 'web', 'Hrm', 0, '2023-07-11 01:09:09', '2023-07-11 01:09:09'),
(168, 'leavetype create', 'web', 'Hrm', 0, '2023-07-11 01:09:09', '2023-07-11 01:09:09'),
(169, 'leavetype edit', 'web', 'Hrm', 0, '2023-07-11 01:09:09', '2023-07-11 01:09:09'),
(170, 'leavetype delete', 'web', 'Hrm', 0, '2023-07-11 01:09:09', '2023-07-11 01:09:09'),
(171, 'award manage', 'web', 'Hrm', 0, '2023-07-11 01:09:09', '2023-07-11 01:09:09'),
(172, 'award create', 'web', 'Hrm', 0, '2023-07-11 01:09:09', '2023-07-11 01:09:09'),
(173, 'award edit', 'web', 'Hrm', 0, '2023-07-11 01:09:09', '2023-07-11 01:09:09'),
(174, 'award delete', 'web', 'Hrm', 0, '2023-07-11 01:09:10', '2023-07-11 01:09:10'),
(175, 'awardtype manage', 'web', 'Hrm', 0, '2023-07-11 01:09:10', '2023-07-11 01:09:10'),
(176, 'awardtype create', 'web', 'Hrm', 0, '2023-07-11 01:09:10', '2023-07-11 01:09:10'),
(177, 'awardtype edit', 'web', 'Hrm', 0, '2023-07-11 01:09:10', '2023-07-11 01:09:10'),
(178, 'awardtype delete', 'web', 'Hrm', 0, '2023-07-11 01:09:10', '2023-07-11 01:09:10'),
(179, 'transfer manage', 'web', 'Hrm', 0, '2023-07-11 01:09:10', '2023-07-11 01:09:10'),
(180, 'transfer create', 'web', 'Hrm', 0, '2023-07-11 01:09:10', '2023-07-11 01:09:10'),
(181, 'transfer edit', 'web', 'Hrm', 0, '2023-07-11 01:09:10', '2023-07-11 01:09:10'),
(182, 'transfer delete', 'web', 'Hrm', 0, '2023-07-11 01:09:10', '2023-07-11 01:09:10'),
(183, 'resignation manage', 'web', 'Hrm', 0, '2023-07-11 01:09:10', '2023-07-11 01:09:10'),
(184, 'resignation create', 'web', 'Hrm', 0, '2023-07-11 01:09:10', '2023-07-11 01:09:10'),
(185, 'resignation edit', 'web', 'Hrm', 0, '2023-07-11 01:09:10', '2023-07-11 01:09:10'),
(186, 'resignation delete', 'web', 'Hrm', 0, '2023-07-11 01:09:10', '2023-07-11 01:09:10'),
(187, 'travel manage', 'web', 'Hrm', 0, '2023-07-11 01:09:11', '2023-07-11 01:09:11'),
(188, 'travel create', 'web', 'Hrm', 0, '2023-07-11 01:09:11', '2023-07-11 01:09:11'),
(189, 'travel edit', 'web', 'Hrm', 0, '2023-07-11 01:09:11', '2023-07-11 01:09:11'),
(190, 'travel delete', 'web', 'Hrm', 0, '2023-07-11 01:09:11', '2023-07-11 01:09:11'),
(191, 'promotion manage', 'web', 'Hrm', 0, '2023-07-11 01:09:11', '2023-07-11 01:09:11'),
(192, 'promotion create', 'web', 'Hrm', 0, '2023-07-11 01:09:11', '2023-07-11 01:09:11'),
(193, 'promotion edit', 'web', 'Hrm', 0, '2023-07-11 01:09:11', '2023-07-11 01:09:11'),
(194, 'promotion delete', 'web', 'Hrm', 0, '2023-07-11 01:09:11', '2023-07-11 01:09:11'),
(195, 'complaint manage', 'web', 'Hrm', 0, '2023-07-11 01:09:11', '2023-07-11 01:09:11'),
(196, 'complaint create', 'web', 'Hrm', 0, '2023-07-11 01:09:11', '2023-07-11 01:09:11'),
(197, 'complaint edit', 'web', 'Hrm', 0, '2023-07-11 01:09:11', '2023-07-11 01:09:11'),
(198, 'complaint delete', 'web', 'Hrm', 0, '2023-07-11 01:09:11', '2023-07-11 01:09:11'),
(199, 'warning manage', 'web', 'Hrm', 0, '2023-07-11 01:09:12', '2023-07-11 01:09:12'),
(200, 'warning create', 'web', 'Hrm', 0, '2023-07-11 01:09:12', '2023-07-11 01:09:12'),
(201, 'warning edit', 'web', 'Hrm', 0, '2023-07-11 01:09:12', '2023-07-11 01:09:12'),
(202, 'warning delete', 'web', 'Hrm', 0, '2023-07-11 01:09:12', '2023-07-11 01:09:12'),
(203, 'termination manage', 'web', 'Hrm', 0, '2023-07-11 01:09:12', '2023-07-11 01:09:12'),
(204, 'termination create', 'web', 'Hrm', 0, '2023-07-11 01:09:12', '2023-07-11 01:09:12'),
(205, 'termination edit', 'web', 'Hrm', 0, '2023-07-11 01:09:12', '2023-07-11 01:09:12'),
(206, 'termination delete', 'web', 'Hrm', 0, '2023-07-11 01:09:12', '2023-07-11 01:09:12'),
(207, 'termination description', 'web', 'Hrm', 0, '2023-07-11 01:09:12', '2023-07-11 01:09:12'),
(208, 'terminationtype manage', 'web', 'Hrm', 0, '2023-07-11 01:09:12', '2023-07-11 01:09:12'),
(209, 'terminationtype create', 'web', 'Hrm', 0, '2023-07-11 01:09:12', '2023-07-11 01:09:12'),
(210, 'terminationtype edit', 'web', 'Hrm', 0, '2023-07-11 01:09:12', '2023-07-11 01:09:12'),
(211, 'terminationtype delete', 'web', 'Hrm', 0, '2023-07-11 01:09:13', '2023-07-11 01:09:13'),
(212, 'announcement manage', 'web', 'Hrm', 0, '2023-07-11 01:09:13', '2023-07-11 01:09:13'),
(213, 'announcement create', 'web', 'Hrm', 0, '2023-07-11 01:09:13', '2023-07-11 01:09:13'),
(214, 'announcement edit', 'web', 'Hrm', 0, '2023-07-11 01:09:13', '2023-07-11 01:09:13'),
(215, 'announcement delete', 'web', 'Hrm', 0, '2023-07-11 01:09:13', '2023-07-11 01:09:13'),
(216, 'holiday manage', 'web', 'Hrm', 0, '2023-07-11 01:09:13', '2023-07-11 01:09:13'),
(217, 'holiday create', 'web', 'Hrm', 0, '2023-07-11 01:09:13', '2023-07-11 01:09:13'),
(218, 'holiday edit', 'web', 'Hrm', 0, '2023-07-11 01:09:13', '2023-07-11 01:09:13'),
(219, 'holiday delete', 'web', 'Hrm', 0, '2023-07-11 01:09:13', '2023-07-11 01:09:13'),
(220, 'holiday import', 'web', 'Hrm', 0, '2023-07-11 01:09:13', '2023-07-11 01:09:13'),
(221, 'attendance report manage', 'web', 'Hrm', 0, '2023-07-11 01:09:13', '2023-07-11 01:09:13'),
(222, 'leave report manage', 'web', 'Hrm', 0, '2023-07-11 01:09:14', '2023-07-11 01:09:14'),
(223, 'paysliptype manage', 'web', 'Hrm', 0, '2023-07-11 01:09:14', '2023-07-11 01:09:14'),
(224, 'paysliptype create', 'web', 'Hrm', 0, '2023-07-11 01:09:14', '2023-07-11 01:09:14'),
(225, 'paysliptype edit', 'web', 'Hrm', 0, '2023-07-11 01:09:14', '2023-07-11 01:09:14'),
(226, 'paysliptype delete', 'web', 'Hrm', 0, '2023-07-11 01:09:14', '2023-07-11 01:09:14'),
(227, 'allowanceoption manage', 'web', 'Hrm', 0, '2023-07-11 01:09:14', '2023-07-11 01:09:14'),
(228, 'allowanceoption create', 'web', 'Hrm', 0, '2023-07-11 01:09:14', '2023-07-11 01:09:14'),
(229, 'allowanceoption edit', 'web', 'Hrm', 0, '2023-07-11 01:09:14', '2023-07-11 01:09:14'),
(230, 'allowanceoption delete', 'web', 'Hrm', 0, '2023-07-11 01:09:14', '2023-07-11 01:09:14'),
(231, 'loanoption manage', 'web', 'Hrm', 0, '2023-07-11 01:09:14', '2023-07-11 01:09:14'),
(232, 'loanoption create', 'web', 'Hrm', 0, '2023-07-11 01:09:14', '2023-07-11 01:09:14'),
(233, 'loanoption edit', 'web', 'Hrm', 0, '2023-07-11 01:09:15', '2023-07-11 01:09:15'),
(234, 'loanoption delete', 'web', 'Hrm', 0, '2023-07-11 01:09:15', '2023-07-11 01:09:15'),
(235, 'deductionoption manage', 'web', 'Hrm', 0, '2023-07-11 01:09:15', '2023-07-11 01:09:15'),
(236, 'deductionoption create', 'web', 'Hrm', 0, '2023-07-11 01:09:15', '2023-07-11 01:09:15'),
(237, 'deductionoption edit', 'web', 'Hrm', 0, '2023-07-11 01:09:15', '2023-07-11 01:09:15'),
(238, 'deductionoption delete', 'web', 'Hrm', 0, '2023-07-11 01:09:15', '2023-07-11 01:09:15'),
(239, 'setsalary manage', 'web', 'Hrm', 0, '2023-07-11 01:09:15', '2023-07-11 01:09:15'),
(240, 'setsalary pay slip manage', 'web', 'Hrm', 0, '2023-07-11 01:09:15', '2023-07-11 01:09:15'),
(241, 'setsalary create', 'web', 'Hrm', 0, '2023-07-11 01:09:15', '2023-07-11 01:09:15'),
(242, 'setsalary edit', 'web', 'Hrm', 0, '2023-07-11 01:09:15', '2023-07-11 01:09:15'),
(243, 'setsalary show', 'web', 'Hrm', 0, '2023-07-11 01:09:15', '2023-07-11 01:09:15'),
(244, 'allowance manage', 'web', 'Hrm', 0, '2023-07-11 01:09:16', '2023-07-11 01:09:16'),
(245, 'allowance create', 'web', 'Hrm', 0, '2023-07-11 01:09:16', '2023-07-11 01:09:16'),
(246, 'allowance edit', 'web', 'Hrm', 0, '2023-07-11 01:09:16', '2023-07-11 01:09:16'),
(247, 'allowance delete', 'web', 'Hrm', 0, '2023-07-11 01:09:16', '2023-07-11 01:09:16'),
(248, 'commission manage', 'web', 'Hrm', 0, '2023-07-11 01:09:16', '2023-07-11 01:09:16'),
(249, 'commission create', 'web', 'Hrm', 0, '2023-07-11 01:09:16', '2023-07-11 01:09:16'),
(250, 'commission edit', 'web', 'Hrm', 0, '2023-07-11 01:09:16', '2023-07-11 01:09:16'),
(251, 'commission delete', 'web', 'Hrm', 0, '2023-07-11 01:09:16', '2023-07-11 01:09:16'),
(252, 'loan manage', 'web', 'Hrm', 0, '2023-07-11 01:09:16', '2023-07-11 01:09:16'),
(253, 'loan create', 'web', 'Hrm', 0, '2023-07-11 01:09:16', '2023-07-11 01:09:16'),
(254, 'loan edit', 'web', 'Hrm', 0, '2023-07-11 01:09:17', '2023-07-11 01:09:17'),
(255, 'loan delete', 'web', 'Hrm', 0, '2023-07-11 01:09:17', '2023-07-11 01:09:17'),
(256, 'saturation deduction manage', 'web', 'Hrm', 0, '2023-07-11 01:09:17', '2023-07-11 01:09:17'),
(257, 'saturation deduction create', 'web', 'Hrm', 0, '2023-07-11 01:09:17', '2023-07-11 01:09:17'),
(258, 'saturation deduction edit', 'web', 'Hrm', 0, '2023-07-11 01:09:17', '2023-07-11 01:09:17'),
(259, 'saturation deduction delete', 'web', 'Hrm', 0, '2023-07-11 01:09:17', '2023-07-11 01:09:17'),
(260, 'other payment manage', 'web', 'Hrm', 0, '2023-07-11 01:09:17', '2023-07-11 01:09:17'),
(261, 'other payment create', 'web', 'Hrm', 0, '2023-07-11 01:09:17', '2023-07-11 01:09:17'),
(262, 'other payment edit', 'web', 'Hrm', 0, '2023-07-11 01:09:17', '2023-07-11 01:09:17'),
(263, 'other payment delete', 'web', 'Hrm', 0, '2023-07-11 01:09:17', '2023-07-11 01:09:17'),
(264, 'overtime manage', 'web', 'Hrm', 0, '2023-07-11 01:09:18', '2023-07-11 01:09:18'),
(265, 'overtime create', 'web', 'Hrm', 0, '2023-07-11 01:09:18', '2023-07-11 01:09:18'),
(266, 'overtime edit', 'web', 'Hrm', 0, '2023-07-11 01:09:18', '2023-07-11 01:09:18'),
(267, 'overtime delete', 'web', 'Hrm', 0, '2023-07-11 01:09:18', '2023-07-11 01:09:18'),
(268, 'branch name edit', 'web', 'Hrm', 0, '2023-07-11 01:09:18', '2023-07-11 01:09:18'),
(269, 'department name edit', 'web', 'Hrm', 0, '2023-07-11 01:09:18', '2023-07-11 01:09:18'),
(270, 'designation name edit', 'web', 'Hrm', 0, '2023-07-11 01:09:18', '2023-07-11 01:09:18'),
(271, 'event manage', 'web', 'Hrm', 0, '2023-07-11 01:09:18', '2023-07-11 01:09:18'),
(272, 'event create', 'web', 'Hrm', 0, '2023-07-11 01:09:18', '2023-07-11 01:09:18'),
(273, 'event edit', 'web', 'Hrm', 0, '2023-07-11 01:09:18', '2023-07-11 01:09:18'),
(274, 'event delete', 'web', 'Hrm', 0, '2023-07-11 01:09:19', '2023-07-11 01:09:19'),
(275, 'sidebar payroll manage', 'web', 'Hrm', 0, '2023-07-11 01:09:19', '2023-07-11 01:09:19'),
(276, 'sidebar hr admin  manage', 'web', 'Hrm', 0, '2023-07-11 01:09:19', '2023-07-11 01:09:19'),
(277, 'letter joining manage', 'web', 'Hrm', 0, '2023-07-11 01:09:19', '2023-07-11 01:09:19'),
(278, 'letter certificate manage', 'web', 'Hrm', 0, '2023-07-11 01:09:19', '2023-07-11 01:09:19'),
(279, 'letter noc manage', 'web', 'Hrm', 0, '2023-07-11 01:09:19', '2023-07-11 01:09:19'),
(280, 'ip restrict manage', 'web', 'Hrm', 0, '2023-07-11 01:09:19', '2023-07-11 01:09:19'),
(281, 'ip restrict create', 'web', 'Hrm', 0, '2023-07-11 01:09:19', '2023-07-11 01:09:19'),
(282, 'ip restrict edit', 'web', 'Hrm', 0, '2023-07-11 01:09:19', '2023-07-11 01:09:19'),
(283, 'ip restrict delete', 'web', 'Hrm', 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(284, 'crm manage', 'web', 'Lead', 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(285, 'crm dashboard manage', 'web', 'Lead', 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(286, 'crm setup manage', 'web', 'Lead', 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(287, 'crm report manage', 'web', 'Lead', 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(288, 'lead manage', 'web', 'Lead', 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(289, 'lead create', 'web', 'Lead', 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(290, 'lead edit', 'web', 'Lead', 0, '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(291, 'lead delete', 'web', 'Lead', 0, '2023-07-11 01:09:21', '2023-07-11 01:09:21'),
(292, 'lead show', 'web', 'Lead', 0, '2023-07-11 01:09:21', '2023-07-11 01:09:21'),
(293, 'lead move', 'web', 'Lead', 0, '2023-07-11 01:09:21', '2023-07-11 01:09:21'),
(294, 'lead import', 'web', 'Lead', 0, '2023-07-11 01:09:21', '2023-07-11 01:09:21'),
(295, 'lead call create', 'web', 'Lead', 0, '2023-07-11 01:09:21', '2023-07-11 01:09:21'),
(296, 'lead call edit', 'web', 'Lead', 0, '2023-07-11 01:09:21', '2023-07-11 01:09:21'),
(297, 'lead call delete', 'web', 'Lead', 0, '2023-07-11 01:09:21', '2023-07-11 01:09:21'),
(298, 'lead email create', 'web', 'Lead', 0, '2023-07-11 01:09:21', '2023-07-11 01:09:21'),
(299, 'lead to deal convert', 'web', 'Lead', 0, '2023-07-11 01:09:21', '2023-07-11 01:09:21'),
(300, 'lead report', 'web', 'Lead', 0, '2023-07-11 01:09:22', '2023-07-11 01:09:22'),
(301, 'deal report', 'web', 'Lead', 0, '2023-07-11 01:09:22', '2023-07-11 01:09:22'),
(302, 'deal manage', 'web', 'Lead', 0, '2023-07-11 01:09:22', '2023-07-11 01:09:22'),
(303, 'deal create', 'web', 'Lead', 0, '2023-07-11 01:09:22', '2023-07-11 01:09:22'),
(304, 'deal edit', 'web', 'Lead', 0, '2023-07-11 01:09:22', '2023-07-11 01:09:22'),
(305, 'deal delete', 'web', 'Lead', 0, '2023-07-11 01:09:22', '2023-07-11 01:09:22'),
(306, 'deal show', 'web', 'Lead', 0, '2023-07-11 01:09:22', '2023-07-11 01:09:22'),
(307, 'deal move', 'web', 'Lead', 0, '2023-07-11 01:09:22', '2023-07-11 01:09:22'),
(308, 'deal import', 'web', 'Lead', 0, '2023-07-11 01:09:22', '2023-07-11 01:09:22'),
(309, 'deal task create', 'web', 'Lead', 0, '2023-07-11 01:09:23', '2023-07-11 01:09:23'),
(310, 'deal task edit', 'web', 'Lead', 0, '2023-07-11 01:09:23', '2023-07-11 01:09:23'),
(311, 'deal task delete', 'web', 'Lead', 0, '2023-07-11 01:09:23', '2023-07-11 01:09:23'),
(312, 'deal task show', 'web', 'Lead', 0, '2023-07-11 01:09:23', '2023-07-11 01:09:23'),
(313, 'deal call create', 'web', 'Lead', 0, '2023-07-11 01:09:23', '2023-07-11 01:09:23'),
(314, 'deal call edit', 'web', 'Lead', 0, '2023-07-11 01:09:23', '2023-07-11 01:09:23'),
(315, 'deal call delete', 'web', 'Lead', 0, '2023-07-11 01:09:23', '2023-07-11 01:09:23'),
(316, 'deal email create', 'web', 'Lead', 0, '2023-07-11 01:09:23', '2023-07-11 01:09:23'),
(317, 'pipeline manage', 'web', 'Lead', 0, '2023-07-11 01:09:23', '2023-07-11 01:09:23'),
(318, 'pipeline create', 'web', 'Lead', 0, '2023-07-11 01:09:24', '2023-07-11 01:09:24'),
(319, 'pipeline edit', 'web', 'Lead', 0, '2023-07-11 01:09:24', '2023-07-11 01:09:24'),
(320, 'pipeline delete', 'web', 'Lead', 0, '2023-07-11 01:09:24', '2023-07-11 01:09:24'),
(321, 'dealstages manage', 'web', 'Lead', 0, '2023-07-11 01:09:24', '2023-07-11 01:09:24'),
(322, 'dealstages create', 'web', 'Lead', 0, '2023-07-11 01:09:24', '2023-07-11 01:09:24'),
(323, 'dealstages edit', 'web', 'Lead', 0, '2023-07-11 01:09:24', '2023-07-11 01:09:24'),
(324, 'dealstages delete', 'web', 'Lead', 0, '2023-07-11 01:09:24', '2023-07-11 01:09:24'),
(325, 'leadstages manage', 'web', 'Lead', 0, '2023-07-11 01:09:24', '2023-07-11 01:09:24'),
(326, 'leadstages create', 'web', 'Lead', 0, '2023-07-11 01:09:25', '2023-07-11 01:09:25'),
(327, 'leadstages edit', 'web', 'Lead', 0, '2023-07-11 01:09:25', '2023-07-11 01:09:25'),
(328, 'leadstages delete', 'web', 'Lead', 0, '2023-07-11 01:09:25', '2023-07-11 01:09:25'),
(329, 'labels manage', 'web', 'Lead', 0, '2023-07-11 01:09:25', '2023-07-11 01:09:25'),
(330, 'labels create', 'web', 'Lead', 0, '2023-07-11 01:09:25', '2023-07-11 01:09:25'),
(331, 'labels edit', 'web', 'Lead', 0, '2023-07-11 01:09:25', '2023-07-11 01:09:25'),
(332, 'labels delete', 'web', 'Lead', 0, '2023-07-11 01:09:25', '2023-07-11 01:09:25'),
(333, 'source manage', 'web', 'Lead', 0, '2023-07-11 01:09:25', '2023-07-11 01:09:25'),
(334, 'source create', 'web', 'Lead', 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(335, 'source edit', 'web', 'Lead', 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(336, 'source delete', 'web', 'Lead', 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(337, 'paypal manage', 'web', 'Paypal', 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(338, 'pos manage', 'web', 'Pos', 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(339, 'pos show', 'web', 'Pos', 0, '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(340, 'pos dashboard manage', 'web', 'Pos', 0, '2023-07-11 01:09:27', '2023-07-11 01:09:27'),
(341, 'pos add manage', 'web', 'Pos', 0, '2023-07-11 01:09:27', '2023-07-11 01:09:27'),
(342, 'pos cart manage', 'web', 'Pos', 0, '2023-07-11 01:09:27', '2023-07-11 01:09:27'),
(343, 'warehouse manage', 'web', 'Pos', 0, '2023-07-11 01:09:27', '2023-07-11 01:09:27'),
(344, 'warehouse create', 'web', 'Pos', 0, '2023-07-11 01:09:27', '2023-07-11 01:09:27'),
(345, 'warehouse edit', 'web', 'Pos', 0, '2023-07-11 01:09:27', '2023-07-11 01:09:27'),
(346, 'warehouse delete', 'web', 'Pos', 0, '2023-07-11 01:09:27', '2023-07-11 01:09:27'),
(347, 'warehouse show', 'web', 'Pos', 0, '2023-07-11 01:09:28', '2023-07-11 01:09:28'),
(348, 'warehouse import', 'web', 'Pos', 0, '2023-07-11 01:09:28', '2023-07-11 01:09:28'),
(349, 'purchase manage', 'web', 'Pos', 0, '2023-07-11 01:09:28', '2023-07-11 01:09:28'),
(350, 'purchase create', 'web', 'Pos', 0, '2023-07-11 01:09:28', '2023-07-11 01:09:28'),
(351, 'purchase edit', 'web', 'Pos', 0, '2023-07-11 01:09:28', '2023-07-11 01:09:28'),
(352, 'purchase delete', 'web', 'Pos', 0, '2023-07-11 01:09:28', '2023-07-11 01:09:28'),
(353, 'purchase show', 'web', 'Pos', 0, '2023-07-11 01:09:28', '2023-07-11 01:09:28'),
(354, 'purchase send', 'web', 'Pos', 0, '2023-07-11 01:09:28', '2023-07-11 01:09:28'),
(355, 'purchase payment create', 'web', 'Pos', 0, '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(356, 'purchase payment delete', 'web', 'Pos', 0, '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(357, 'purchase product delete', 'web', 'Pos', 0, '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(358, 'product&service manage', 'web', 'ProductService', 0, '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(359, 'product&service create', 'web', 'ProductService', 0, '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(360, 'product&service edit', 'web', 'ProductService', 0, '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(361, 'product&service delete', 'web', 'ProductService', 0, '2023-07-11 01:09:30', '2023-07-11 01:09:30'),
(362, 'product&service import', 'web', 'ProductService', 0, '2023-07-11 01:09:30', '2023-07-11 01:09:30'),
(363, 'unit manage', 'web', 'ProductService', 0, '2023-07-11 01:09:30', '2023-07-11 01:09:30'),
(364, 'unit cerate', 'web', 'ProductService', 0, '2023-07-11 01:09:30', '2023-07-11 01:09:30'),
(365, 'unit edit', 'web', 'ProductService', 0, '2023-07-11 01:09:30', '2023-07-11 01:09:30'),
(366, 'unit delete', 'web', 'ProductService', 0, '2023-07-11 01:09:30', '2023-07-11 01:09:30'),
(367, 'tax manage', 'web', 'ProductService', 0, '2023-07-11 01:09:30', '2023-07-11 01:09:30'),
(368, 'tax create', 'web', 'ProductService', 0, '2023-07-11 01:09:30', '2023-07-11 01:09:30'),
(369, 'tax edit', 'web', 'ProductService', 0, '2023-07-11 01:09:31', '2023-07-11 01:09:31'),
(370, 'tax delete', 'web', 'ProductService', 0, '2023-07-11 01:09:31', '2023-07-11 01:09:31'),
(371, 'category manage', 'web', 'ProductService', 0, '2023-07-11 01:09:31', '2023-07-11 01:09:31'),
(372, 'category create', 'web', 'ProductService', 0, '2023-07-11 01:09:31', '2023-07-11 01:09:31'),
(373, 'category edit', 'web', 'ProductService', 0, '2023-07-11 01:09:31', '2023-07-11 01:09:31'),
(374, 'category delete', 'web', 'ProductService', 0, '2023-07-11 01:09:31', '2023-07-11 01:09:31'),
(375, 'stripe manage', 'web', 'Stripe', 0, '2023-07-11 01:09:31', '2023-07-11 01:09:31'),
(376, 'taskly manage', 'web', 'Taskly', 0, '2023-07-11 01:09:32', '2023-07-11 01:09:32'),
(377, 'taskly setup manage', 'web', 'Taskly', 0, '2023-07-11 01:09:32', '2023-07-11 01:09:32'),
(378, 'taskly dashboard manage', 'web', 'Taskly', 0, '2023-07-11 01:09:32', '2023-07-11 01:09:32'),
(379, 'project manage', 'web', 'Taskly', 0, '2023-07-11 01:09:32', '2023-07-11 01:09:32'),
(380, 'project create', 'web', 'Taskly', 0, '2023-07-11 01:09:32', '2023-07-11 01:09:32'),
(381, 'project edit', 'web', 'Taskly', 0, '2023-07-11 01:09:32', '2023-07-11 01:09:32'),
(382, 'project delete', 'web', 'Taskly', 0, '2023-07-11 01:09:32', '2023-07-11 01:09:32'),
(383, 'project show', 'web', 'Taskly', 0, '2023-07-11 01:09:33', '2023-07-11 01:09:33'),
(384, 'project invite user', 'web', 'Taskly', 0, '2023-07-11 01:09:33', '2023-07-11 01:09:33'),
(385, 'project report manage', 'web', 'Taskly', 0, '2023-07-11 01:09:33', '2023-07-11 01:09:33'),
(386, 'project import', 'web', 'Taskly', 0, '2023-07-11 01:09:33', '2023-07-11 01:09:33'),
(387, 'project setting', 'web', 'Taskly', 0, '2023-07-11 01:09:33', '2023-07-11 01:09:33'),
(388, 'team member remove', 'web', 'Taskly', 0, '2023-07-11 01:09:33', '2023-07-11 01:09:33'),
(389, 'team client remove', 'web', 'Taskly', 0, '2023-07-11 01:09:33', '2023-07-11 01:09:33'),
(390, 'bug manage', 'web', 'Taskly', 0, '2023-07-11 01:09:34', '2023-07-11 01:09:34'),
(391, 'bug create', 'web', 'Taskly', 0, '2023-07-11 01:09:34', '2023-07-11 01:09:34'),
(392, 'bug edit', 'web', 'Taskly', 0, '2023-07-11 01:09:34', '2023-07-11 01:09:34'),
(393, 'bug delete', 'web', 'Taskly', 0, '2023-07-11 01:09:34', '2023-07-11 01:09:34'),
(394, 'bug show', 'web', 'Taskly', 0, '2023-07-11 01:09:34', '2023-07-11 01:09:34'),
(395, 'bug move', 'web', 'Taskly', 0, '2023-07-11 01:09:34', '2023-07-11 01:09:34'),
(396, 'bug comments create', 'web', 'Taskly', 0, '2023-07-11 01:09:34', '2023-07-11 01:09:34'),
(397, 'bug comments delete', 'web', 'Taskly', 0, '2023-07-11 01:09:35', '2023-07-11 01:09:35'),
(398, 'bug file uploads', 'web', 'Taskly', 0, '2023-07-11 01:09:35', '2023-07-11 01:09:35'),
(399, 'bug file delete', 'web', 'Taskly', 0, '2023-07-11 01:09:35', '2023-07-11 01:09:35'),
(400, 'bugstage manage', 'web', 'Taskly', 0, '2023-07-11 01:09:35', '2023-07-11 01:09:35'),
(401, 'bugstage edit', 'web', 'Taskly', 0, '2023-07-11 01:09:35', '2023-07-11 01:09:35'),
(402, 'bugstage delete', 'web', 'Taskly', 0, '2023-07-11 01:09:35', '2023-07-11 01:09:35'),
(403, 'bugstage show', 'web', 'Taskly', 0, '2023-07-11 01:09:35', '2023-07-11 01:09:35'),
(404, 'milestone manage', 'web', 'Taskly', 0, '2023-07-11 01:09:36', '2023-07-11 01:09:36'),
(405, 'milestone create', 'web', 'Taskly', 0, '2023-07-11 01:09:36', '2023-07-11 01:09:36'),
(406, 'milestone edit', 'web', 'Taskly', 0, '2023-07-11 01:09:36', '2023-07-11 01:09:36'),
(407, 'milestone delete', 'web', 'Taskly', 0, '2023-07-11 01:09:36', '2023-07-11 01:09:36'),
(408, 'milestone show', 'web', 'Taskly', 0, '2023-07-11 01:09:36', '2023-07-11 01:09:36'),
(409, 'task manage', 'web', 'Taskly', 0, '2023-07-11 01:09:36', '2023-07-11 01:09:36'),
(410, 'task create', 'web', 'Taskly', 0, '2023-07-11 01:09:36', '2023-07-11 01:09:36'),
(411, 'task edit', 'web', 'Taskly', 0, '2023-07-11 01:09:37', '2023-07-11 01:09:37'),
(412, 'task delete', 'web', 'Taskly', 0, '2023-07-11 01:09:37', '2023-07-11 01:09:37'),
(413, 'task show', 'web', 'Taskly', 0, '2023-07-11 01:09:37', '2023-07-11 01:09:37'),
(414, 'task move', 'web', 'Taskly', 0, '2023-07-11 01:09:37', '2023-07-11 01:09:37'),
(415, 'task file manage', 'web', 'Taskly', 0, '2023-07-11 01:09:37', '2023-07-11 01:09:37'),
(416, 'task file uploads', 'web', 'Taskly', 0, '2023-07-11 01:09:37', '2023-07-11 01:09:37'),
(417, 'task file delete', 'web', 'Taskly', 0, '2023-07-11 01:09:38', '2023-07-11 01:09:38'),
(418, 'task file show', 'web', 'Taskly', 0, '2023-07-11 01:09:38', '2023-07-11 01:09:38'),
(419, 'task comment manage', 'web', 'Taskly', 0, '2023-07-11 01:09:38', '2023-07-11 01:09:38'),
(420, 'task comment create', 'web', 'Taskly', 0, '2023-07-11 01:09:38', '2023-07-11 01:09:38'),
(421, 'task comment edit', 'web', 'Taskly', 0, '2023-07-11 01:09:38', '2023-07-11 01:09:38'),
(422, 'task comment delete', 'web', 'Taskly', 0, '2023-07-11 01:09:38', '2023-07-11 01:09:38'),
(423, 'task comment show', 'web', 'Taskly', 0, '2023-07-11 01:09:38', '2023-07-11 01:09:38'),
(424, 'taskstage manage', 'web', 'Taskly', 0, '2023-07-11 01:09:39', '2023-07-11 01:09:39'),
(425, 'taskstage edit', 'web', 'Taskly', 0, '2023-07-11 01:09:39', '2023-07-11 01:09:39'),
(426, 'taskstage delete', 'web', 'Taskly', 0, '2023-07-11 01:09:39', '2023-07-11 01:09:39'),
(427, 'taskstage show', 'web', 'Taskly', 0, '2023-07-11 01:09:39', '2023-07-11 01:09:39'),
(428, 'sub-task manage', 'web', 'Taskly', 0, '2023-07-11 01:09:39', '2023-07-11 01:09:39'),
(429, 'sub-task create', 'web', 'Taskly', 0, '2023-07-11 01:09:39', '2023-07-11 01:09:39'),
(430, 'sub-task edit', 'web', 'Taskly', 0, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(431, 'sub-task delete', 'web', 'Taskly', 0, '2023-07-11 01:09:40', '2023-07-11 01:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pipelines`
--

CREATE TABLE `pipelines` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `workspace_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pipelines`
--

INSERT INTO `pipelines` (`id`, `name`, `created_by`, `workspace_id`, `created_at`, `updated_at`) VALUES
(1, 'Sales', 2, 1, '2023-07-11 01:09:40', '2023-07-11 01:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint UNSIGNED NOT NULL,
  `package_price_monthly` double NOT NULL DEFAULT '0',
  `package_price_yearly` double NOT NULL DEFAULT '0',
  `price_per_user_monthly` double NOT NULL DEFAULT '0',
  `price_per_user_yearly` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `package_price_monthly`, `package_price_yearly`, `price_per_user_monthly`, `price_per_user_yearly`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 0, 0, '2023-07-11 01:09:02', '2023-07-11 01:09:02');

-- --------------------------------------------------------

--
-- Table structure for table `plan_fields`
--

CREATE TABLE `plan_fields` (
  `id` bigint UNSIGNED NOT NULL,
  `plan_id` int NOT NULL,
  `max_users` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pos`
--

CREATE TABLE `pos` (
  `id` bigint UNSIGNED NOT NULL,
  `pos_id` bigint UNSIGNED NOT NULL DEFAULT '0',
  `customer_id` bigint UNSIGNED NOT NULL DEFAULT '0',
  `warehouse_id` int NOT NULL DEFAULT '0',
  `pos_date` date DEFAULT NULL,
  `category_id` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '0',
  `shipping_display` int NOT NULL DEFAULT '1',
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pos_payments`
--

CREATE TABLE `pos_payments` (
  `id` bigint UNSIGNED NOT NULL,
  `pos_id` int NOT NULL,
  `date` date DEFAULT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0.00',
  `discount_amount` double(8,2) DEFAULT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pos_products`
--

CREATE TABLE `pos_products` (
  `id` bigint UNSIGNED NOT NULL,
  `pos_id` int NOT NULL DEFAULT '0',
  `product_id` int NOT NULL DEFAULT '0',
  `quantity` int NOT NULL DEFAULT '0',
  `tax` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `discount` double(8,2) NOT NULL DEFAULT '0.00',
  `price` double(8,2) NOT NULL DEFAULT '0.00',
  `description` text COLLATE utf8mb4_unicode_ci,
  `workspace` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_services`
--

CREATE TABLE `product_services` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale_price` double(20,2) NOT NULL DEFAULT '0.00',
  `purchase_price` double(20,2) NOT NULL DEFAULT '0.00',
  `quantity` int NOT NULL DEFAULT '0',
  `tax_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int NOT NULL DEFAULT '0',
  `image` longtext COLLATE utf8mb4_unicode_ci,
  `unit_id` int NOT NULL DEFAULT '0',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_by` int NOT NULL DEFAULT '0',
  `workspace_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Ongoing','Finished','OnHold') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Ongoing',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `budget` int NOT NULL DEFAULT '0',
  `is_active` int NOT NULL DEFAULT '1',
  `currency` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '$',
  `project_progress` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'false',
  `progress` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `task_progress` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'true',
  `tags` text COLLATE utf8mb4_unicode_ci,
  `estimated_hrs` int NOT NULL DEFAULT '0',
  `copylinksetting` longtext COLLATE utf8mb4_unicode_ci,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `workspace` int NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_files`
--

CREATE TABLE `project_files` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `designation_id` int NOT NULL,
  `promotion_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promotion_date` date NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proposals`
--

CREATE TABLE `proposals` (
  `id` bigint UNSIGNED NOT NULL,
  `proposal_id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `issue_date` date NOT NULL,
  `send_date` date DEFAULT NULL,
  `category_id` int NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `proposal_module` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'account',
  `is_convert` int NOT NULL DEFAULT '0',
  `converted_invoice_id` int NOT NULL DEFAULT '0',
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proposal_products`
--

CREATE TABLE `proposal_products` (
  `id` bigint UNSIGNED NOT NULL,
  `proposal_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `tax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` double(8,2) NOT NULL DEFAULT '0.00',
  `price` double(8,2) NOT NULL DEFAULT '0.00',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint UNSIGNED NOT NULL,
  `purchase_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `user_id` int DEFAULT NULL,
  `vender_id` int DEFAULT NULL,
  `vender_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse_id` int NOT NULL,
  `purchase_date` date NOT NULL,
  `purchase_number` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '0',
  `shipping_display` int NOT NULL DEFAULT '1',
  `send_date` date DEFAULT NULL,
  `discount_apply` int NOT NULL DEFAULT '0',
  `category_id` int NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_payments`
--

CREATE TABLE `purchase_payments` (
  `id` bigint UNSIGNED NOT NULL,
  `purchase_id` int NOT NULL,
  `date` date NOT NULL,
  `amount` double(8,2) NOT NULL DEFAULT '0.00',
  `account_id` int DEFAULT NULL,
  `payment_method` int NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `add_receipt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `workspace` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_products`
--

CREATE TABLE `purchase_products` (
  `id` bigint UNSIGNED NOT NULL,
  `purchase_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `tax` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` double(8,2) NOT NULL DEFAULT '0.00',
  `price` double(8,2) NOT NULL DEFAULT '0.00',
  `description` text COLLATE utf8mb4_unicode_ci,
  `workspace` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resignations`
--

CREATE TABLE `resignations` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `resignation_date` date NOT NULL,
  `last_working_date` date NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `revenues`
--

CREATE TABLE `revenues` (
  `id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `account_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `user_id` int NOT NULL,
  `category_id` int NOT NULL,
  `payment_method` int NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_receipt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Base',
  `created_by` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `module`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'super admin', 'web', 'Base', 0, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(2, 'company', 'web', 'Base', 1, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(3, 'client', 'web', 'Base', 2, '2023-07-11 01:09:03', '2023-07-11 01:09:03'),
(4, 'staff', 'web', 'Base', 2, '2023-07-11 01:09:03', '2023-07-11 01:09:03'),
(5, 'vendor', 'web', 'Account', 2, '2023-07-11 01:09:05', '2023-07-11 01:09:05');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(337, 1),
(375, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(14, 2),
(18, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2),
(40, 2),
(41, 2),
(42, 2),
(43, 2),
(44, 2),
(45, 2),
(46, 2),
(47, 2),
(48, 2),
(49, 2),
(50, 2),
(51, 2),
(52, 2),
(53, 2),
(54, 2),
(55, 2),
(56, 2),
(57, 2),
(58, 2),
(59, 2),
(60, 2),
(61, 2),
(62, 2),
(63, 2),
(64, 2),
(65, 2),
(66, 2),
(67, 2),
(68, 2),
(69, 2),
(70, 2),
(71, 2),
(72, 2),
(73, 2),
(74, 2),
(75, 2),
(76, 2),
(77, 2),
(78, 2),
(79, 2),
(80, 2),
(81, 2),
(82, 2),
(83, 2),
(84, 2),
(85, 2),
(86, 2),
(87, 2),
(88, 2),
(89, 2),
(90, 2),
(91, 2),
(92, 2),
(93, 2),
(94, 2),
(95, 2),
(96, 2),
(97, 2),
(98, 2),
(99, 2),
(100, 2),
(101, 2),
(102, 2),
(103, 2),
(104, 2),
(105, 2),
(106, 2),
(107, 2),
(108, 2),
(109, 2),
(110, 2),
(111, 2),
(112, 2),
(113, 2),
(114, 2),
(115, 2),
(116, 2),
(117, 2),
(118, 2),
(119, 2),
(120, 2),
(121, 2),
(122, 2),
(123, 2),
(124, 2),
(125, 2),
(126, 2),
(127, 2),
(128, 2),
(129, 2),
(130, 2),
(131, 2),
(132, 2),
(133, 2),
(134, 2),
(135, 2),
(136, 2),
(137, 2),
(138, 2),
(139, 2),
(140, 2),
(141, 2),
(142, 2),
(143, 2),
(144, 2),
(145, 2),
(146, 2),
(147, 2),
(148, 2),
(149, 2),
(150, 2),
(151, 2),
(152, 2),
(153, 2),
(154, 2),
(155, 2),
(156, 2),
(157, 2),
(158, 2),
(159, 2),
(160, 2),
(161, 2),
(162, 2),
(163, 2),
(164, 2),
(165, 2),
(166, 2),
(167, 2),
(168, 2),
(169, 2),
(170, 2),
(171, 2),
(172, 2),
(173, 2),
(174, 2),
(175, 2),
(176, 2),
(177, 2),
(178, 2),
(179, 2),
(180, 2),
(181, 2),
(182, 2),
(183, 2),
(184, 2),
(185, 2),
(186, 2),
(187, 2),
(188, 2),
(189, 2),
(190, 2),
(191, 2),
(192, 2),
(193, 2),
(194, 2),
(195, 2),
(196, 2),
(197, 2),
(198, 2),
(199, 2),
(200, 2),
(201, 2),
(202, 2),
(203, 2),
(204, 2),
(205, 2),
(206, 2),
(207, 2),
(208, 2),
(209, 2),
(210, 2),
(211, 2),
(212, 2),
(213, 2),
(214, 2),
(215, 2),
(216, 2),
(217, 2),
(218, 2),
(219, 2),
(220, 2),
(221, 2),
(222, 2),
(223, 2),
(224, 2),
(225, 2),
(226, 2),
(227, 2),
(228, 2),
(229, 2),
(230, 2),
(231, 2),
(232, 2),
(233, 2),
(234, 2),
(235, 2),
(236, 2),
(237, 2),
(238, 2),
(239, 2),
(240, 2),
(241, 2),
(242, 2),
(243, 2),
(244, 2),
(245, 2),
(246, 2),
(247, 2),
(248, 2),
(249, 2),
(250, 2),
(251, 2),
(252, 2),
(253, 2),
(254, 2),
(255, 2),
(256, 2),
(257, 2),
(258, 2),
(259, 2),
(260, 2),
(261, 2),
(262, 2),
(263, 2),
(264, 2),
(265, 2),
(266, 2),
(267, 2),
(268, 2),
(269, 2),
(270, 2),
(271, 2),
(272, 2),
(273, 2),
(274, 2),
(275, 2),
(276, 2),
(277, 2),
(278, 2),
(279, 2),
(280, 2),
(281, 2),
(282, 2),
(283, 2),
(284, 2),
(285, 2),
(286, 2),
(287, 2),
(288, 2),
(289, 2),
(290, 2),
(291, 2),
(292, 2),
(293, 2),
(294, 2),
(295, 2),
(296, 2),
(297, 2),
(298, 2),
(299, 2),
(300, 2),
(301, 2),
(302, 2),
(303, 2),
(304, 2),
(305, 2),
(306, 2),
(307, 2),
(308, 2),
(309, 2),
(310, 2),
(311, 2),
(312, 2),
(313, 2),
(314, 2),
(315, 2),
(316, 2),
(317, 2),
(318, 2),
(319, 2),
(320, 2),
(321, 2),
(322, 2),
(323, 2),
(324, 2),
(325, 2),
(326, 2),
(327, 2),
(328, 2),
(329, 2),
(330, 2),
(331, 2),
(332, 2),
(333, 2),
(334, 2),
(335, 2),
(336, 2),
(337, 2),
(338, 2),
(339, 2),
(340, 2),
(341, 2),
(342, 2),
(343, 2),
(344, 2),
(345, 2),
(346, 2),
(347, 2),
(348, 2),
(349, 2),
(350, 2),
(351, 2),
(352, 2),
(353, 2),
(354, 2),
(355, 2),
(356, 2),
(357, 2),
(358, 2),
(359, 2),
(360, 2),
(361, 2),
(362, 2),
(363, 2),
(364, 2),
(365, 2),
(366, 2),
(367, 2),
(368, 2),
(369, 2),
(370, 2),
(371, 2),
(372, 2),
(373, 2),
(374, 2),
(375, 2),
(376, 2),
(377, 2),
(378, 2),
(379, 2),
(380, 2),
(381, 2),
(382, 2),
(383, 2),
(384, 2),
(385, 2),
(386, 2),
(387, 2),
(388, 2),
(389, 2),
(390, 2),
(391, 2),
(392, 2),
(393, 2),
(394, 2),
(395, 2),
(396, 2),
(397, 2),
(398, 2),
(399, 2),
(400, 2),
(401, 2),
(402, 2),
(403, 2),
(404, 2),
(405, 2),
(406, 2),
(407, 2),
(408, 2),
(409, 2),
(410, 2),
(411, 2),
(412, 2),
(413, 2),
(414, 2),
(415, 2),
(416, 2),
(417, 2),
(418, 2),
(419, 2),
(420, 2),
(421, 2),
(422, 2),
(423, 2),
(424, 2),
(425, 2),
(426, 2),
(427, 2),
(428, 2),
(429, 2),
(430, 2),
(431, 2),
(5, 3),
(9, 3),
(28, 3),
(39, 3),
(43, 3),
(48, 3),
(52, 3),
(67, 3),
(80, 3),
(84, 3),
(119, 3),
(284, 3),
(302, 3),
(306, 3),
(309, 3),
(310, 3),
(311, 3),
(312, 3),
(313, 3),
(314, 3),
(315, 3),
(316, 3),
(376, 3),
(378, 3),
(379, 3),
(380, 3),
(383, 3),
(390, 3),
(391, 3),
(392, 3),
(393, 3),
(394, 3),
(395, 3),
(396, 3),
(397, 3),
(398, 3),
(399, 3),
(404, 3),
(408, 3),
(409, 3),
(410, 3),
(411, 3),
(412, 3),
(413, 3),
(415, 3),
(416, 3),
(417, 3),
(418, 3),
(419, 3),
(420, 3),
(421, 3),
(422, 3),
(423, 3),
(428, 3),
(430, 3),
(431, 3),
(5, 4),
(9, 4),
(28, 4),
(122, 4),
(123, 4),
(125, 4),
(129, 4),
(146, 4),
(150, 4),
(151, 4),
(152, 4),
(158, 4),
(162, 4),
(163, 4),
(164, 4),
(171, 4),
(179, 4),
(183, 4),
(187, 4),
(191, 4),
(195, 4),
(196, 4),
(197, 4),
(198, 4),
(199, 4),
(203, 4),
(212, 4),
(216, 4),
(221, 4),
(222, 4),
(239, 4),
(240, 4),
(243, 4),
(244, 4),
(248, 4),
(252, 4),
(256, 4),
(260, 4),
(264, 4),
(275, 4),
(276, 4),
(284, 4),
(288, 4),
(292, 4),
(302, 4),
(306, 4),
(312, 4),
(376, 4),
(378, 4),
(379, 4),
(383, 4),
(390, 4),
(394, 4),
(395, 4),
(396, 4),
(398, 4),
(399, 4),
(409, 4),
(413, 4),
(415, 4),
(418, 4),
(419, 4),
(423, 4),
(428, 4),
(430, 4),
(5, 5),
(29, 5),
(67, 5),
(74, 5),
(78, 5),
(89, 5),
(93, 5),
(97, 5),
(120, 5);

-- --------------------------------------------------------

--
-- Table structure for table `saturation_deductions`
--

CREATE TABLE `saturation_deductions` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int NOT NULL,
  `deduction_option` int NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` int NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, '34ffd30384fae9dd5bfee427e90ed4ab', 's:1:\"1\";'),
(2, '3ed94381049af44fc6f69736f1c93a1a', 's:3:\"USD\";'),
(3, '14c77149fd7afd3296060c34abb994b2', 's:1:\"$\";'),
(4, 'f7336d388db4a4649c8fa70ec7872b64', 's:2:\"en\";'),
(5, '95a8b14f6bfdf6e6e460e7142845360c', 's:12:\"Asia/Kolkata\";'),
(6, 'fac9ac0e460a676bee37567080f9520a', 's:3:\"pre\";'),
(7, '6799ebc72318dc9f7f1a89fa98e4f8c4', 's:5:\"d-m-Y\";'),
(8, '56bc8c7234313bf5aac39c880c292489', 's:5:\"g:i A\";'),
(9, 'fa2486d671558e8a85f8a8d02fa5e502', 's:11:\"WorkDo Dash\";'),
(10, '45c9a243ad57f3cb6f248d73f199e1d8', 's:24:\"Copyright © WorkDo Dash\";'),
(11, '50e1456eea45d488399e8a7a03e5447b', 's:3:\"off\";'),
(12, 'a029c7344b6f147a6a25b415c741c677', 's:3:\"off\";'),
(13, '196c474a211507b6ecb263c421f5a725', 's:2:\"on\";'),
(14, '3f9d542db186f38f6bcc0d3d6e75098b', 's:7:\"theme-1\";'),
(15, 'eafc1cdad97f47d7a423116029a839c8', 's:5:\"#INVO\";'),
(16, '56f45547f6446cd4d6d555fb0f485bee', 's:1:\"1\";'),
(17, 'd9c2e442da5680146718bef8166f430f', 's:9:\"template1\";'),
(18, 'ba4ee25662c3bce07fc2e786cc21a8b5', 's:6:\"ffffff\";'),
(19, '8f78e895b530aad3cdde241148aab1f6', 's:2:\"on\";'),
(20, '8b15b2a26eb9071e9cf65537978b8784', 's:0:\"\";'),
(21, 'a5c2105a1b4d3926e37760f86ecd6b5c', 's:0:\"\";'),
(22, 'c6b8d006d227748ed5de2e33b0351710', 's:6:\"#PROP0\";'),
(23, '120b061fcf127174d48169c0ceec8150', 's:1:\"1\";'),
(24, '40f40d3bbfc9a766eeabd2e4a313f807', 's:9:\"template1\";'),
(25, '7d901acff58b71656032a97d8bc590b1', 's:6:\"ffffff\";'),
(26, '8f002a692dbf7c27275833f7b538807a', 's:2:\"on\";'),
(27, 'cae85839df7ef18d621d13a63e43da9f', 's:0:\"\";'),
(28, 'c322c99d0aa0e499d2eafcb30f0af43a', 's:0:\"\";'),
(29, '16fa8c5ae04ba4f9f42699e8959e4307', 's:1:\"1\";'),
(30, 'f3656c47217ee919c4a6c2c0bfeeb84c', 's:3:\"USD\";'),
(31, '60690cb04c4e7425bca81b81a04cf481', 's:1:\"$\";'),
(32, '7ab12fa6d6b4c1016e14192828a21b82', 's:2:\"en\";'),
(33, '5663795ca5a240511bcc09ee0019c19d', 's:12:\"Asia/Kolkata\";'),
(34, 'e601b2f903c85d1d0c4d011ad70dccad', 's:11:\"WorkDo Dash\";'),
(35, '75ac82979fc812f60e7efad69bada9e5', 's:24:\"Copyright © WorkDo Dash\";'),
(36, '2be4c78895a2114491dc20eb75924676', 's:2:\"on\";'),
(37, 'b17970027099f24fc21c128c8bdd38b1', 's:3:\"off\";'),
(38, 'e904f510360a1935d4a4ca931e6705e7', 's:3:\"off\";'),
(39, 'bbb64cb9d13f876989030c776f7b7712', 's:2:\"on\";'),
(40, 'f26a33811eb9ce291cef6ad187bba32a', 's:2:\"on\";'),
(41, 'b436bfa93dbf1ee8c50b7d6f00ca6a98', 's:7:\"theme-1\";'),
(42, 'a6467cbd7b39a125808c2b26fe88029e', 's:2:\"on\";'),
(43, 'c76b292b2ee6d6c74ae96e0e67e71b94', 's:2:\"on\";'),
(44, 'bb4b97ad2b73e4005d187292225fc3a7', 's:2:\"on\";'),
(45, '9e8d56193434170a3a054a8ec865d754', 's:2:\"on\";'),
(46, '9407117841d1b118d216d4e9a999678d', 's:15:\"We use cookies!\";'),
(47, 'b376e254f6851627e832561b17e891ab', 's:130:\"Hi, this website uses essential cookies to ensure its proper operation and tracking cookies to understand how you interact with it\";'),
(48, 'f55578c773d19e26cf757bf215b1a494', 's:26:\"Strictly necessary cookies\";'),
(49, 'd696f1b6d0fe34d6da990e9fa2e62304', 's:128:\"These cookies are essential for the proper functioning of my website. Without these cookies, the website would not work properly\";'),
(50, '7cbe88f6b6d686ea262c646305303ecf', 's:88:\"For any queries in relation to our policy on cookies and your choices, please contact us\";'),
(51, '6a76fdcd709643064c699d535635ea78', 's:1:\"#\";'),
(52, 'e6d4ea2d08b7c81f90b9be552da0ee06', 's:55:\"WorkDo Dash SaaS - Open Source ERP with Multi-Workspace\";'),
(53, 'f5242d0a5fc35a3bc348911d7d5f44c5', 's:183:\"WorkDo Dash,SaaS solution,Multi-workspace functionality, Cloud-based access,Scalability,Multi-addons,Collaboration tool,Data management,Business productivity,Operational effectiveness\";'),
(54, '16441b8db34781e2cc3bb8d458000056', 's:328:\"Discover the efficiency of Dash, a user-friendly web application by Rajodiya Apps. Streamline project management, organize tasks, collaborate seamlessly, and track progress effortlessly. Boost productivity with Dash\'s intuitive interface and comprehensive features. Revolutionize your project management process today. Try Dash!\";'),
(55, '03cb08ef9060f04a0bbf0b989737028c', 's:5:\"local\";'),
(56, 'e05ef2951378db6cde0006f24c9c0c69', 's:6:\"204800\";'),
(57, 'd8898a0ce79dd248a6bd6b8202b7014b', 'a:6:{i:0;s:4:\"jpeg\";i:1;s:3:\"jpg\";i:2;s:3:\"png\";i:3;s:3:\"pdf\";i:4;s:3:\"gif\";i:5;s:3:\"svg\";}'),
(58, 'bc52bf9adc79edc2585942612f0ab9c0', 's:5:\"#CUST\";'),
(59, '312e5622b62b1c3d05a5bf67fd1469d2', 's:5:\"#VEND\";'),
(60, 'aa8fb06897788ac285c743b6f12e0ece', 's:5:\"#BILL\";'),
(61, 'c09fc740323bedc0cbf7e9dba78170f7', 's:1:\"1\";'),
(62, '588a75c7e67277278eae59f2c3b1bc44', 's:9:\"template1\";'),
(63, '537e57d399e84a0cec2b5058e5c0385b', 's:4:\"#EMP\";'),
(64, '357fe9832dd896006f59c3623e8e7019', 's:5:\"09:00\";'),
(65, '1d2a9012da4effe238f807acb7cbf669', 's:5:\"18:00\";'),
(66, '16a389f17c9beada2f84aff8b86b2ab4', 's:4:\"#PUR\";'),
(67, '8080c2e065686e44b11317e0c3d389fb', 's:4:\"#POS\";'),
(68, 'a9b07f20ab0dfd3f21b341dcf9494c69', 's:1:\"1\";'),
(69, '38a54fd8f0db4ecf3ac144bb8df9aa70', 's:9:\"template1\";'),
(70, '45100e535b03466e5ec688e91adb9562', 's:9:\"template1\";');

-- --------------------------------------------------------

--
-- Table structure for table `sidebar`
--

CREATE TABLE `sidebar` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `sort_order` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `route` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_visible` int NOT NULL DEFAULT '1',
  `permissions` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `module` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Base',
  `dependency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disable_module` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'company',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sidebar`
--

INSERT INTO `sidebar` (`id`, `title`, `icon`, `parent_id`, `sort_order`, `route`, `is_visible`, `permissions`, `module`, `dependency`, `disable_module`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'ti ti-home', 0, '0', 'home', 1, NULL, 'Base', NULL, NULL, 'super admin', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(2, 'User', 'ti ti-users', 0, '100', 'users.index', 1, 'user manage', 'Base', NULL, NULL, 'super admin', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(3, 'Subscription', 'ti ti-trophy', 0, '200', '', 1, NULL, 'Base', NULL, NULL, 'super admin', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(4, 'Email Template', 'ti ti-template', 0, '300', 'email-templates.index', 1, 'email template manage', 'Base', NULL, NULL, 'super admin', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(5, 'Settings', 'ti ti-settings', 0, '700', 'settings.index', 1, 'setting manage', 'Base', NULL, NULL, 'super admin', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(6, 'Add-on Manager', 'ti ti-layout-2', 0, '800', 'module.index', 1, 'module manage', 'Base', NULL, NULL, 'super admin', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(7, 'Subscription Setting', '', 3, '10', 'plans.index', 1, 'plan manage', 'Base', NULL, NULL, 'super admin', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(8, 'Order', '', 3, '20', 'plan.order.index', 1, 'plan orders', 'Base', NULL, NULL, 'super admin', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(9, 'Bank Transfer Request', '', 3, '30', 'bank-transfer-request.index', 1, 'plan orders', 'Base', NULL, NULL, 'super admin', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(10, 'Dashboard', 'ti ti-home', 0, '0', '', 1, NULL, 'Base', NULL, NULL, 'company', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(11, 'User Management', 'ti ti-users', 0, '100', '', 1, 'user manage', 'Base', NULL, NULL, 'company', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(12, 'Proposal', 'ti ti-replace', 0, '200', 'proposal.index', 1, 'proposal manage', 'Base', 'Account,Taskly', NULL, 'company', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(13, 'Invoice', 'ti ti-file-invoice', 0, '300', 'invoice.index', 1, 'invoice manage', 'Base', 'Account,Taskly', NULL, 'company', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(14, 'Messenger', 'ti ti-brand-hipchat', 0, '460', 'chatify', 1, 'user chat manage', 'Base', NULL, NULL, 'company', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(15, 'Settings', 'ti ti-settings', 0, '900', '', 1, 'setting manage', 'Base', NULL, NULL, 'company', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(16, 'User', '', 11, '0', 'users.index', 1, 'user manage', 'Base', NULL, NULL, 'company', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(17, 'Role', '', 11, '10', 'roles.index', 1, 'roles manage', 'Base', NULL, NULL, 'company', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(18, 'System Settings', '', 15, '10', 'settings.index', 1, 'setting manage', 'Base', NULL, NULL, 'company', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(19, 'Setup Subscription Plan', '', 15, '30', 'plans.index', 1, 'plan manage', 'Base', NULL, NULL, 'company', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(20, 'Order', '', 15, '40', 'plan.order.index', 1, 'plan orders', 'Base', NULL, NULL, 'company', '2023-07-11 01:09:01', '2023-07-11 01:09:01'),
(21, 'Accounting Dashboard', '', 10, '20', 'dashboard.account', 1, 'account dashboard manage', 'Account', NULL, NULL, 'company', '2023-07-11 01:09:03', '2023-07-11 01:09:03'),
(22, 'Accounting', 'ti ti-layout-grid-add', 0, '320', NULL, 1, 'account manage', 'Account', NULL, NULL, 'company', '2023-07-11 01:09:03', '2023-07-11 01:09:03'),
(23, 'Customer', '', 22, '10', 'customer.index', 1, 'customer manage', 'Account', NULL, NULL, 'company', '2023-07-11 01:09:03', '2023-07-11 01:09:03'),
(24, 'Vendor', '', 22, '15', 'vendors.index', 1, 'vendor manage', 'Account', NULL, NULL, 'company', '2023-07-11 01:09:03', '2023-07-11 01:09:03'),
(25, 'Banking', '', 22, '20', '', 1, 'sidebar banking manage', 'Account', NULL, NULL, 'company', '2023-07-11 01:09:03', '2023-07-11 01:09:03'),
(26, 'Account', '', 25, '10', 'bank-account.index', 1, 'bank account manage', 'Account', NULL, NULL, 'company', '2023-07-11 01:09:03', '2023-07-11 01:09:03'),
(27, 'Transfer', '', 25, '15', 'bank-transfer.index', 1, 'bank transfer manage', 'Account', NULL, NULL, 'company', '2023-07-11 01:09:03', '2023-07-11 01:09:03'),
(28, 'Income', '', 22, '25', NULL, 1, 'sidebar income manage', 'Account', NULL, NULL, 'company', '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(29, 'Revenue', '', 28, '10', 'revenue.index', 1, 'revenue manage', 'Account', NULL, NULL, 'company', '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(30, 'Expense', '', 22, '30', '', 1, 'sidebar expanse manage', 'Account', NULL, NULL, 'company', '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(31, 'Bill', '', 30, '10', 'bill.index', 1, 'bill manage', 'Account', NULL, NULL, 'company', '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(32, 'Payment', '', 30, '15', 'payment.index', 1, 'bill payment manage', 'Account', NULL, NULL, 'company', '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(33, 'Report', '', 22, '50', NULL, 1, 'report manage', 'Account', NULL, NULL, 'company', '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(34, 'Transaction', '', 33, '10', 'transaction.index', 1, 'report transaction manage', 'Account', NULL, NULL, 'company', '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(35, 'Account Statement', '', 33, '15', 'report.account.statement', 1, 'report statement manage', 'Account', NULL, NULL, 'company', '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(36, 'Income Summary', '', 33, '20', 'report.income.summary', 1, 'report income manage', 'Account', NULL, NULL, 'company', '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(37, 'Expense Summary', '', 33, '25', 'report.expense.summary', 1, 'report expense', 'Account', NULL, NULL, 'company', '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(38, 'Income Vs Expense', '', 33, '30', 'report.income.vs.expense.summary', 1, 'report income vs expense manage', 'Account', NULL, NULL, 'company', '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(39, 'Tax Summary', '', 33, '35', 'report.tax.summary', 1, 'report tax manage', 'Account', NULL, NULL, 'company', '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(40, 'Profit & Loss', '', 33, '40', 'report.profit.loss.summary', 1, 'report loss & profit  manage', 'Account', NULL, NULL, 'company', '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(41, 'Invoice Summary', '', 33, '45', 'report.invoice.summary', 1, 'report invoice manage', 'Account', NULL, NULL, 'company', '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(42, 'Bill Summary', '', 33, '50', 'report.bill.summary', 1, 'report bill manage', 'Account', NULL, NULL, 'company', '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(43, 'Product Stock', '', 33, '55', 'report.product.stock.report', 1, 'report stock manage', 'Account', NULL, NULL, 'company', '2023-07-11 01:09:04', '2023-07-11 01:09:04'),
(44, 'HRM Dashboard', '', 10, '30', 'hrm.dashboard', 1, 'hrm dashboard manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(45, 'HRM', 'ti ti-3d-cube-sphere', 0, '330', NULL, 1, 'hrm manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(46, 'Employee', '', 45, '10', 'employee.index', 1, 'employee manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(47, 'Payroll', '', 45, '15', NULL, 1, 'sidebar payroll manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(48, 'Set salary', '', 47, '10', 'setsalary.index', 1, 'setsalary manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(49, 'Payslip', '', 47, '15', 'payslip.index', 1, 'setsalary pay slip manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(50, 'Leave Management', '', 45, '20', NULL, 1, 'leave manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(51, 'Manage Leave', '', 50, '10', 'leave.index', 1, 'leave manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(52, 'Attendance', '', 50, '15', NULL, 1, 'attendance manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(53, 'Mark Attendance', '', 52, '10', 'attendance.index', 1, NULL, 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(54, 'Bulk Attendance', '', 52, '15', 'attendance.bulkattendance', 1, NULL, 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(55, 'HR Admin', '', 45, '45', NULL, 1, 'sidebar hr admin  manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(56, 'Award', '', 55, '10', 'award.index', 1, 'award manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(57, 'Transfer', '', 55, '15', 'transfer.index', 1, 'transfer manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(58, 'Resignation', '', 55, '20', 'resignation.index', 1, 'resignation manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(59, 'Trip', '', 55, '25', 'trip.index', 1, 'travel manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(60, 'Promotion', '', 55, '30', 'promotion.index', 1, 'promotion manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(61, 'Complaints', '', 55, '35', 'complaint.index', 1, 'complaint manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(62, 'Warning', '', 55, '40', 'warning.index', 1, 'warning manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(63, 'Termination', '', 55, '45', 'termination.index', 1, 'termination manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(64, 'Announcement', '', 55, '50', 'announcement.index', 1, 'announcement manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(65, 'Holidays', '', 55, '50', 'holiday.index', 1, 'holiday manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(66, 'Event', '', 45, '50', 'event.index', 1, 'event manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(67, 'Document', '', 45, '55', 'document.index', 1, 'document manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(68, 'Company Policy', '', 45, '60', 'company-policy.index', 1, 'companypolicy manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(69, 'System Setup', '', 45, '65', 'branch.index', 1, 'branch manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(70, 'Report', '', 45, '70', NULL, 1, 'sidebar hrm report manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(71, 'Monthly Attendance', '', 70, '10', 'report.monthly.attendance', 1, 'attendance report manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(72, 'Leave', '', 70, '15', 'report.leave', 1, 'leave report manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(73, 'Payroll', '', 70, '20', 'report.payroll', 1, 'hrm payroll report manage', 'Hrm', NULL, NULL, 'company', '2023-07-11 01:09:06', '2023-07-11 01:09:06'),
(74, 'CRM Dashboard', '', 10, '40', 'lead.dashboard', 1, 'crm dashboard manage', 'Lead', NULL, NULL, 'company', '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(75, 'CRM', 'ti ti-layers-difference', 0, '340', '', 1, 'crm manage', 'Lead', NULL, NULL, 'company', '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(76, 'Lead', '', 75, '10', 'leads.index', 1, 'lead manage', 'Lead', NULL, NULL, 'company', '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(77, 'Deal', '', 75, '15', 'deals.index', 1, 'deal manage', 'Lead', NULL, NULL, 'company', '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(78, 'System Setup', '', 75, '30', 'pipelines.index', 1, 'crm setup manage', 'Lead', NULL, NULL, 'company', '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(79, 'Report', '', 75, '35', '', 1, 'crm report manage', 'Lead', NULL, NULL, 'company', '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(80, 'Lead', 'ti ti-file-invoice', 79, '10', 'report.lead', 1, 'lead report', 'Lead', NULL, NULL, 'company', '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(81, 'Deal', 'ti ti-file-invoice', 79, '15', 'report.deal', 1, 'deal report', 'Lead', NULL, NULL, 'company', '2023-07-11 01:09:20', '2023-07-11 01:09:20'),
(82, 'POS Dashboard', '', 10, '50', 'pos.dashboard', 1, 'pos dashboard manage', 'Pos', NULL, NULL, 'company', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(83, 'POS', 'ti ti-grid-dots', 0, '350', '', 1, 'pos manage', 'Pos', NULL, NULL, 'company', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(84, 'Warehouse', '', 83, '10', 'warehouse.index', 1, 'warehouse manage', 'Pos', NULL, NULL, 'company', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(85, 'Purchase', '', 83, '15', 'purchase.index', 1, 'purchase manage', 'Pos', NULL, NULL, 'company', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(86, 'Add POS', '', 83, '20', 'pos.index', 1, 'pos add manage', 'Pos', NULL, NULL, 'company', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(87, 'POS Order', '', 83, '25', 'pos.report', 1, 'pos add manage', 'Pos', NULL, NULL, 'company', '2023-07-11 01:09:26', '2023-07-11 01:09:26'),
(88, 'Product & Service', 'ti ti-shopping-cart', 0, '150', 'product-service.index', 1, 'product&service manage', 'ProductService', NULL, NULL, 'company', '2023-07-11 01:09:29', '2023-07-11 01:09:29'),
(89, 'Project Dashboard', '', 10, '10', 'taskly.dashboard', 1, 'taskly dashboard manage', 'Taskly', NULL, NULL, 'company', '2023-07-11 01:09:32', '2023-07-11 01:09:32'),
(90, 'Projects', 'ti ti-square-check', 0, '310', NULL, 1, 'project manage', 'Taskly', NULL, NULL, 'company', '2023-07-11 01:09:32', '2023-07-11 01:09:32'),
(91, 'Project', '', 90, '20', 'projects.index', 1, 'project manage', 'Taskly', NULL, NULL, 'company', '2023-07-11 01:09:32', '2023-07-11 01:09:32'),
(92, 'Project Report', '', 90, '30', 'project_report.index', 1, 'project report manage', 'Taskly', NULL, NULL, 'company', '2023-07-11 01:09:32', '2023-07-11 01:09:32'),
(93, 'System Setup', '', 90, '40', 'stages.index', 1, 'taskly setup manage', 'Taskly', NULL, NULL, 'company', '2023-07-11 01:09:32', '2023-07-11 01:09:32');

-- --------------------------------------------------------

--
-- Table structure for table `sources`
--

CREATE TABLE `sources` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `workspace_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

CREATE TABLE `stages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#051c4b',
  `complete` tinyint(1) NOT NULL,
  `workspace_id` bigint UNSIGNED NOT NULL,
  `order` int NOT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stages`
--

INSERT INTO `stages` (`id`, `name`, `color`, `complete`, `workspace_id`, `order`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Todo', '#051c4b', 0, 1, 0, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(2, 'In Progress', '#051c4b', 0, 1, 0, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(3, 'Review', '#051c4b', 0, 1, 0, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40'),
(4, 'Done', '#051c4b', 0, 1, 0, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `stock_reports`
--

CREATE TABLE `stock_reports` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` int NOT NULL DEFAULT '0',
  `quantity` int NOT NULL DEFAULT '0',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_id` int NOT NULL DEFAULT '0',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_tasks`
--

CREATE TABLE `sub_tasks` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_date` date NOT NULL,
  `task_id` int NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `assign_to` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` int NOT NULL,
  `milestone_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'todo',
  `order` int NOT NULL DEFAULT '0',
  `workspace` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_files`
--

CREATE TABLE `task_files` (
  `id` bigint UNSIGNED NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_id` int NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `workspace_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terminations`
--

CREATE TABLE `terminations` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `notice_date` date NOT NULL,
  `termination_date` date NOT NULL,
  `termination_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `termination_types`
--

CREATE TABLE `termination_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `time_sheets`
--

CREATE TABLE `time_sheets` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `hours` double(8,2) NOT NULL DEFAULT '0.00',
  `remark` text COLLATE utf8mb4_unicode_ci,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `vendor_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` int NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL DEFAULT '0.00',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `date` date NOT NULL,
  `payment_id` int NOT NULL DEFAULT '0',
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `department_id` int NOT NULL,
  `transfer_date` date NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `travels`
--

CREATE TABLE `travels` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `purpose_of_visit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_of_visit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `workspace_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'company',
  `active_status` tinyint(1) NOT NULL DEFAULT '0',
  `active_workspace` int NOT NULL DEFAULT '0',
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'uploads/users-avatar/avatar.png',
  `requested_plan` int NOT NULL DEFAULT '0',
  `dark_mode` tinyint(1) NOT NULL DEFAULT '0',
  `lang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `messenger_color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#2180f3',
  `workspace_id` int NOT NULL DEFAULT '0',
  `active_plan` int NOT NULL DEFAULT '0',
  `active_module` longtext COLLATE utf8mb4_unicode_ci,
  `plan_expire_date` date DEFAULT NULL,
  `billing_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_user` int NOT NULL DEFAULT '0',
  `seeder_run` int NOT NULL DEFAULT '0',
  `is_enable_login` int NOT NULL DEFAULT '1',
  `default_pipeline` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `type`, `active_status`, `active_workspace`, `avatar`, `requested_plan`, `dark_mode`, `lang`, `messenger_color`, `workspace_id`, `active_plan`, `active_module`, `plan_expire_date`, `billing_type`, `total_user`, `seeder_run`, `is_enable_login`, `default_pipeline`, `job_title`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@example.com', '2023-07-11 01:09:02', '$2y$10$bXR987HFwn6iPjbatZj/C.yb73knG3eOXBuE4ZJV.TOstftJLkXO6', NULL, 'super admin', 1, 0, 'uploads/users-avatar/avatar.png', 0, 0, 'en', '#2180f3', 0, 0, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, '2023-07-11 01:09:02', '2023-07-11 01:09:02'),
(2, 'Rajodiya infotech', 'company@example.com', '2023-07-11 01:09:03', '$2y$10$I2qb..ApG/BkcBkuxhR8AuYV3uzqUCxCcGh7rSWF.wNIK3uc6knaC', NULL, 'company', 1, 1, 'uploads/users-avatar/avatar.png', 0, 0, 'en', '#2180f3', 1, 1, 'Account,Hrm,Lead,Paypal,Pos,ProductService,Stripe,Taskly', '2023-08-11', NULL, 0, 0, 1, NULL, NULL, 1, '2023-07-11 01:09:03', '2023-07-11 01:09:41');

-- --------------------------------------------------------

--
-- Table structure for table `user_deals`
--

CREATE TABLE `user_deals` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `deal_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_leads`
--

CREATE TABLE `user_leads` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `lead_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_projects`
--

CREATE TABLE `user_projects` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `project_id` int NOT NULL,
  `is_active` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint UNSIGNED NOT NULL,
  `vendor_id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_zip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address` text COLLATE utf8mb4_unicode_ci,
  `shipping_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_zip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` text COLLATE utf8mb4_unicode_ci,
  `lang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `balance` double(8,2) NOT NULL DEFAULT '0.00',
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_zip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `address`, `city`, `city_zip`, `workspace`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'North Warehouse', '723 N. Tillamook Street Portland, OR Portland, United States', 'Portland', '97227', 1, 2, '2023-07-11 01:09:40', '2023-07-11 01:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_products`
--

CREATE TABLE `warehouse_products` (
  `id` bigint UNSIGNED NOT NULL,
  `warehouse_id` int NOT NULL DEFAULT '0',
  `product_id` int NOT NULL DEFAULT '0',
  `quantity` int NOT NULL DEFAULT '0',
  `workspace` int DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warnings`
--

CREATE TABLE `warnings` (
  `id` bigint UNSIGNED NOT NULL,
  `warning_to` int NOT NULL,
  `warning_by` int NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warning_date` date NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `work_spaces`
--

CREATE TABLE `work_spaces` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_spaces`
--

INSERT INTO `work_spaces` (`id`, `name`, `status`, `slug`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Rajodiya infotech', 'active', 'rajodiya-infotech-2', 2, '2023-07-11 01:09:03', '2023-07-11 01:09:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_ons`
--
ALTER TABLE `add_ons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allowances`
--
ALTER TABLE `allowances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allowance_options`
--
ALTER TABLE `allowance_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcement_employees`
--
ALTER TABLE `announcement_employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_key_settings`
--
ALTER TABLE `api_key_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `award_types`
--
ALTER TABLE `award_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_transfers`
--
ALTER TABLE `bank_transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_transfer_payments`
--
ALTER TABLE `bank_transfer_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_payments`
--
ALTER TABLE `bill_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_products`
--
ALTER TABLE `bill_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bug_comments`
--
ALTER TABLE `bug_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bug_files`
--
ALTER TABLE `bug_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bug_reports`
--
ALTER TABLE `bug_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bug_stages`
--
ALTER TABLE `bug_stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ch_favorites`
--
ALTER TABLE `ch_favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ch_messages`
--
ALTER TABLE `ch_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_deals`
--
ALTER TABLE `client_deals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_deals_client_id_foreign` (`client_id`),
  ADD KEY `client_deals_deal_id_foreign` (`deal_id`);

--
-- Indexes for table `client_permissions`
--
ALTER TABLE `client_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_permissions_client_id_foreign` (`client_id`),
  ADD KEY `client_permissions_deal_id_foreign` (`deal_id`);

--
-- Indexes for table `client_projects`
--
ALTER TABLE `client_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commissions`
--
ALTER TABLE `commissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_policies`
--
ALTER TABLE `company_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_notes`
--
ALTER TABLE `credit_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indexes for table `custom_fields_module_list`
--
ALTER TABLE `custom_fields_module_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deals`
--
ALTER TABLE `deals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deal_activity_logs`
--
ALTER TABLE `deal_activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deal_calls`
--
ALTER TABLE `deal_calls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deal_calls_deal_id_foreign` (`deal_id`);

--
-- Indexes for table `deal_discussions`
--
ALTER TABLE `deal_discussions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deal_discussions_deal_id_foreign` (`deal_id`);

--
-- Indexes for table `deal_emails`
--
ALTER TABLE `deal_emails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deal_emails_deal_id_foreign` (`deal_id`);

--
-- Indexes for table `deal_files`
--
ALTER TABLE `deal_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deal_files_deal_id_foreign` (`deal_id`);

--
-- Indexes for table `deal_stages`
--
ALTER TABLE `deal_stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deal_tasks`
--
ALTER TABLE `deal_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deal_tasks_deal_id_foreign` (`deal_id`);

--
-- Indexes for table `debit_notes`
--
ALTER TABLE `debit_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deduction_options`
--
ALTER TABLE `deduction_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_types`
--
ALTER TABLE `document_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_template_langs`
--
ALTER TABLE `email_template_langs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_documents`
--
ALTER TABLE `employee_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_employees`
--
ALTER TABLE `event_employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experience_certificates`
--
ALTER TABLE `experience_certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_payments`
--
ALTER TABLE `invoice_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_products`
--
ALTER TABLE `invoice_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ip_restricts`
--
ALTER TABLE `ip_restricts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `joining_letters`
--
ALTER TABLE `joining_letters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `labels`
--
ALTER TABLE `labels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `leads_email_unique` (`email`);

--
-- Indexes for table `lead_activity_logs`
--
ALTER TABLE `lead_activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_calls`
--
ALTER TABLE `lead_calls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lead_calls_lead_id_foreign` (`lead_id`);

--
-- Indexes for table `lead_discussions`
--
ALTER TABLE `lead_discussions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lead_discussions_lead_id_foreign` (`lead_id`);

--
-- Indexes for table `lead_emails`
--
ALTER TABLE `lead_emails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lead_emails_lead_id_foreign` (`lead_id`);

--
-- Indexes for table `lead_files`
--
ALTER TABLE `lead_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lead_files_lead_id_foreign` (`lead_id`);

--
-- Indexes for table `lead_stages`
--
ALTER TABLE `lead_stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_options`
--
ALTER TABLE `loan_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milestones`
--
ALTER TABLE `milestones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `noc_certificates`
--
ALTER TABLE `noc_certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_order_id_unique` (`order_id`);

--
-- Indexes for table `other_payments`
--
ALTER TABLE `other_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overtimes`
--
ALTER TABLE `overtimes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payslip_types`
--
ALTER TABLE `payslip_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay_slips`
--
ALTER TABLE `pay_slips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pipelines`
--
ALTER TABLE `pipelines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan_fields`
--
ALTER TABLE `plan_fields`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plan_fields_total_users_unique` (`max_users`);

--
-- Indexes for table `pos`
--
ALTER TABLE `pos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_payments`
--
ALTER TABLE `pos_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_products`
--
ALTER TABLE `pos_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_services`
--
ALTER TABLE `product_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_files`
--
ALTER TABLE `project_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proposal_products`
--
ALTER TABLE `proposal_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_payments`
--
ALTER TABLE `purchase_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_products`
--
ALTER TABLE `purchase_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resignations`
--
ALTER TABLE `resignations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `revenues`
--
ALTER TABLE `revenues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `saturation_deductions`
--
ALTER TABLE `saturation_deductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `sidebar`
--
ALTER TABLE `sidebar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sources`
--
ALTER TABLE `sources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stages`
--
ALTER TABLE `stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_reports`
--
ALTER TABLE `stock_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_tasks`
--
ALTER TABLE `sub_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_files`
--
ALTER TABLE `task_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terminations`
--
ALTER TABLE `terminations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `termination_types`
--
ALTER TABLE `termination_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_sheets`
--
ALTER TABLE `time_sheets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `travels`
--
ALTER TABLE `travels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_deals`
--
ALTER TABLE `user_deals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_deals_user_id_foreign` (`user_id`),
  ADD KEY `user_deals_deal_id_foreign` (`deal_id`);

--
-- Indexes for table `user_leads`
--
ALTER TABLE `user_leads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_leads_user_id_foreign` (`user_id`),
  ADD KEY `user_leads_lead_id_foreign` (`lead_id`);

--
-- Indexes for table `user_projects`
--
ALTER TABLE `user_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendors_email_unique` (`email`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_products`
--
ALTER TABLE `warehouse_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warnings`
--
ALTER TABLE `warnings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_spaces`
--
ALTER TABLE `work_spaces`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `add_ons`
--
ALTER TABLE `add_ons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `allowances`
--
ALTER TABLE `allowances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `allowance_options`
--
ALTER TABLE `allowance_options`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcement_employees`
--
ALTER TABLE `announcement_employees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `api_key_settings`
--
ALTER TABLE `api_key_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `award_types`
--
ALTER TABLE `award_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bank_transfers`
--
ALTER TABLE `bank_transfers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_transfer_payments`
--
ALTER TABLE `bank_transfer_payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_payments`
--
ALTER TABLE `bill_payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_products`
--
ALTER TABLE `bill_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bug_comments`
--
ALTER TABLE `bug_comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bug_files`
--
ALTER TABLE `bug_files`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bug_reports`
--
ALTER TABLE `bug_reports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bug_stages`
--
ALTER TABLE `bug_stages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_deals`
--
ALTER TABLE `client_deals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_permissions`
--
ALTER TABLE `client_permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_projects`
--
ALTER TABLE `client_projects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_policies`
--
ALTER TABLE `company_policies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_notes`
--
ALTER TABLE `credit_notes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_fields_module_list`
--
ALTER TABLE `custom_fields_module_list`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deals`
--
ALTER TABLE `deals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deal_activity_logs`
--
ALTER TABLE `deal_activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deal_calls`
--
ALTER TABLE `deal_calls`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deal_discussions`
--
ALTER TABLE `deal_discussions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deal_emails`
--
ALTER TABLE `deal_emails`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deal_files`
--
ALTER TABLE `deal_files`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deal_stages`
--
ALTER TABLE `deal_stages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `deal_tasks`
--
ALTER TABLE `deal_tasks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `debit_notes`
--
ALTER TABLE `debit_notes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deduction_options`
--
ALTER TABLE `deduction_options`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `document_types`
--
ALTER TABLE `document_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `email_template_langs`
--
ALTER TABLE `email_template_langs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_documents`
--
ALTER TABLE `employee_documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_employees`
--
ALTER TABLE `event_employees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `experience_certificates`
--
ALTER TABLE `experience_certificates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_payments`
--
ALTER TABLE `invoice_payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_products`
--
ALTER TABLE `invoice_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ip_restricts`
--
ALTER TABLE `ip_restricts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `joining_letters`
--
ALTER TABLE `joining_letters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `labels`
--
ALTER TABLE `labels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lead_activity_logs`
--
ALTER TABLE `lead_activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lead_calls`
--
ALTER TABLE `lead_calls`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lead_discussions`
--
ALTER TABLE `lead_discussions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lead_emails`
--
ALTER TABLE `lead_emails`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lead_files`
--
ALTER TABLE `lead_files`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lead_stages`
--
ALTER TABLE `lead_stages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_options`
--
ALTER TABLE `loan_options`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `milestones`
--
ALTER TABLE `milestones`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `noc_certificates`
--
ALTER TABLE `noc_certificates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `other_payments`
--
ALTER TABLE `other_payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `overtimes`
--
ALTER TABLE `overtimes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payslip_types`
--
ALTER TABLE `payslip_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pay_slips`
--
ALTER TABLE `pay_slips`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=432;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pipelines`
--
ALTER TABLE `pipelines`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `plan_fields`
--
ALTER TABLE `plan_fields`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos`
--
ALTER TABLE `pos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_payments`
--
ALTER TABLE `pos_payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_products`
--
ALTER TABLE `pos_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_services`
--
ALTER TABLE `product_services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_files`
--
ALTER TABLE `project_files`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proposals`
--
ALTER TABLE `proposals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proposal_products`
--
ALTER TABLE `proposal_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_payments`
--
ALTER TABLE `purchase_payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_products`
--
ALTER TABLE `purchase_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resignations`
--
ALTER TABLE `resignations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `revenues`
--
ALTER TABLE `revenues`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `saturation_deductions`
--
ALTER TABLE `saturation_deductions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `sidebar`
--
ALTER TABLE `sidebar`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `sources`
--
ALTER TABLE `sources`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stages`
--
ALTER TABLE `stages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock_reports`
--
ALTER TABLE `stock_reports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_tasks`
--
ALTER TABLE `sub_tasks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_files`
--
ALTER TABLE `task_files`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `terminations`
--
ALTER TABLE `terminations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `termination_types`
--
ALTER TABLE `termination_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `time_sheets`
--
ALTER TABLE `time_sheets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `travels`
--
ALTER TABLE `travels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_deals`
--
ALTER TABLE `user_deals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_leads`
--
ALTER TABLE `user_leads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_projects`
--
ALTER TABLE `user_projects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `warehouse_products`
--
ALTER TABLE `warehouse_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warnings`
--
ALTER TABLE `warnings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `work_spaces`
--
ALTER TABLE `work_spaces`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_deals`
--
ALTER TABLE `client_deals`
  ADD CONSTRAINT `client_deals_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_deals_deal_id_foreign` FOREIGN KEY (`deal_id`) REFERENCES `deals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `client_permissions`
--
ALTER TABLE `client_permissions`
  ADD CONSTRAINT `client_permissions_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_permissions_deal_id_foreign` FOREIGN KEY (`deal_id`) REFERENCES `deals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `deal_calls`
--
ALTER TABLE `deal_calls`
  ADD CONSTRAINT `deal_calls_deal_id_foreign` FOREIGN KEY (`deal_id`) REFERENCES `deals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `deal_discussions`
--
ALTER TABLE `deal_discussions`
  ADD CONSTRAINT `deal_discussions_deal_id_foreign` FOREIGN KEY (`deal_id`) REFERENCES `deals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `deal_emails`
--
ALTER TABLE `deal_emails`
  ADD CONSTRAINT `deal_emails_deal_id_foreign` FOREIGN KEY (`deal_id`) REFERENCES `deals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `deal_files`
--
ALTER TABLE `deal_files`
  ADD CONSTRAINT `deal_files_deal_id_foreign` FOREIGN KEY (`deal_id`) REFERENCES `deals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `deal_tasks`
--
ALTER TABLE `deal_tasks`
  ADD CONSTRAINT `deal_tasks_deal_id_foreign` FOREIGN KEY (`deal_id`) REFERENCES `deals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lead_calls`
--
ALTER TABLE `lead_calls`
  ADD CONSTRAINT `lead_calls_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lead_discussions`
--
ALTER TABLE `lead_discussions`
  ADD CONSTRAINT `lead_discussions_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lead_emails`
--
ALTER TABLE `lead_emails`
  ADD CONSTRAINT `lead_emails_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lead_files`
--
ALTER TABLE `lead_files`
  ADD CONSTRAINT `lead_files_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_deals`
--
ALTER TABLE `user_deals`
  ADD CONSTRAINT `user_deals_deal_id_foreign` FOREIGN KEY (`deal_id`) REFERENCES `deals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_deals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_leads`
--
ALTER TABLE `user_leads`
  ADD CONSTRAINT `user_leads_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_leads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
