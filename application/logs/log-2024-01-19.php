<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-01-19 06:39:54 --> Severity: error --> Exception: syntax error, unexpected 'echo' (T_ECHO) C:\xampp\htdocs\AutomHRPrefex\application\controllers\admin\Entity_transfer.php 111
ERROR - 2024-01-19 06:40:18 --> Severity: error --> Exception: syntax error, unexpected 'echo' (T_ECHO) C:\xampp\htdocs\AutomHRPrefex\application\controllers\admin\Entity_transfer.php 112
ERROR - 2024-01-19 11:10:29 --> Severity: User Notice --> Hook after_render_top_search is <strong>deprecated</strong> since version 3.0.0! Use admin_navbar_start instead. C:\xampp\htdocs\AutomHRPrefex\application\helpers\deprecated_helper.php 48
ERROR - 2024-01-19 11:13:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\AutomHRPrefex\application\controllers\admin\Entity_transfer.php 25
ERROR - 2024-01-19 11:13:06 --> Severity: Notice --> Undefined index: new_employee_id C:\xampp\htdocs\AutomHRPrefex\application\controllers\admin\Entity_transfer.php 99
ERROR - 2024-01-19 11:13:06 --> Severity: Notice --> Undefined index: new_employee_id C:\xampp\htdocs\AutomHRPrefex\application\controllers\admin\Entity_transfer.php 99
ERROR - 2024-01-19 11:45:27 --> Severity: Notice --> Undefined property: Databasequeryexecution::$dbutil C:\xampp\htdocs\AutomHRPrefex\application\controllers\admin\Databasequeryexecution.php 19
ERROR - 2024-01-19 11:45:27 --> Severity: error --> Exception: Call to a member function list_tables() on null C:\xampp\htdocs\AutomHRPrefex\application\controllers\admin\Databasequeryexecution.php 19
ERROR - 2024-01-19 11:46:26 --> Severity: error --> Exception: Call to undefined method CI_DB_mysqli_utility::list_tables() C:\xampp\htdocs\AutomHRPrefex\application\controllers\admin\Databasequeryexecution.php 77
ERROR - 2024-01-19 11:47:02 --> Severity: error --> Exception: Call to undefined method CI_DB_mysqli_forge::list_tables() C:\xampp\htdocs\AutomHRPrefex\application\controllers\admin\Databasequeryexecution.php 76
ERROR - 2024-01-19 12:07:59 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'DEFAULT 0' at line 1 - Invalid query: ALTER TABLE tblactivity_log ADD COLUMN branch_id enum DEFAULT 0
ERROR - 2024-01-19 12:08:16 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'DEFAULT '0'' at line 1 - Invalid query: ALTER TABLE tblactivity_log ADD COLUMN branch_id enum DEFAULT '0'
ERROR - 2024-01-19 12:08:34 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'DEFAULT 0' at line 1 - Invalid query: ALTER TABLE tblactivity_log ADD COLUMN branch_id enum DEFAULT 0
ERROR - 2024-01-19 12:10:47 --> Query error: Duplicate column name 'branch_id' - Invalid query: ALTER TABLE tblbranches ADD COLUMN branch_id enum("1") DEFAULT 1
ERROR - 2024-01-19 12:11:42 --> Query error: Duplicate column name 'branch_id' - Invalid query: ALTER TABLE tblactivity_log ADD COLUMN branch_id enum("1") DEFAULT 1
ERROR - 2024-01-19 12:15:31 --> Query error: Duplicate column name 'branch_id' - Invalid query: ALTER TABLE tblactivity_log ADD COLUMN branch_id enum("1") DEFAULT 1
ERROR - 2024-01-19 12:15:33 --> Severity: error --> Exception: Too few arguments to function Databasequeryexecution::drop_column(), 0 passed in C:\xampp\htdocs\AutomHRPrefex\system\core\CodeIgniter.php on line 532 and exactly 2 expected C:\xampp\htdocs\AutomHRPrefex\application\controllers\admin\Databasequeryexecution.php 51
ERROR - 2024-01-19 12:16:11 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 1 - Invalid query: ALTER TABLE branch_id DROP COLUMN 
ERROR - 2024-01-19 12:17:00 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ''branch_id'' at line 1 - Invalid query: ALTER TABLE tblactivity_log DROP COLUMN 'branch_id'
ERROR - 2024-01-19 12:18:06 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ''branch_id'' at line 1 - Invalid query: ALTER TABLE tblactivity_log DROP 'branch_id'
ERROR - 2024-01-19 12:18:17 --> Query error: Can't DROP COLUMN `'branch_id'`; check that it exists - Invalid query: ALTER TABLE tblactivity_log DROP `'branch_id'`
ERROR - 2024-01-19 12:18:45 --> Query error: Can't DROP COLUMN `'branch_id'`; check that it exists - Invalid query: ALTER TABLE tblactivity_log DROP `'branch_id'`
ERROR - 2024-01-19 12:19:10 --> Query error: Can't DROP COLUMN `branch_id`; check that it exists - Invalid query: ALTER TABLE tblbreak_in_out DROP branch_id
ERROR - 2024-01-19 12:19:34 --> Query error: Duplicate column name 'branch_id' - Invalid query: ALTER TABLE tbltransfer_history ADD COLUMN branch_id enum("1") DEFAULT 1
ERROR - 2024-01-19 16:01:14 --> Severity: Notice --> Undefined property: Entity_transfer::$timesheets_model C:\xampp\htdocs\AutomHRPrefex\application\controllers\admin\Entity_transfer.php 118
ERROR - 2024-01-19 16:01:14 --> Severity: error --> Exception: Call to a member function get_staff_list() on null C:\xampp\htdocs\AutomHRPrefex\application\controllers\admin\Entity_transfer.php 118
ERROR - 2024-01-19 16:20:35 --> Query error: Unknown column 'id' in 'field list' - Invalid query: SELECT `id`, `branch_name`, `branch_prefix`
FROM `tblbranches`
WHERE `status` = '1'
ERROR - 2024-01-19 16:20:48 --> Query error: Unknown column 'status' in 'where clause' - Invalid query: SELECT `branch_id` as `id`, `branch_name`, `branch_prefix`
FROM `tblbranches`
WHERE `status` = '1'
ERROR - 2024-01-19 16:21:09 --> Severity: User Notice --> Hook after_render_top_search is <strong>deprecated</strong> since version 3.0.0! Use admin_navbar_start instead. C:\xampp\htdocs\AutomHRPrefex\application\helpers\deprecated_helper.php 48
