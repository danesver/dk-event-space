<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_start();
date_default_timezone_set('Asia/Manila');

// Define the root path (this should be the path to your cPanel's public_html directory)
$webroot = "/home/zenitiq.com/qaca.asia/public";

// Define directory separators and constants based on the cPanel structure
define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', $webroot.DS.'admin');  // 'admin' is the folder within 'ultratesting'
define('INCLUDES_PATH', SITE_ROOT.DS.'include');

// Include the necessary files
require_once(INCLUDES_PATH.DS."Helper.php");
require_once(INCLUDES_PATH.DS."config.php");
require_once(INCLUDES_PATH.DS."database.php");
require_once(INCLUDES_PATH.DS."db_object.php");
require_once(INCLUDES_PATH.DS."Session.php");
require_once(INCLUDES_PATH.DS."Accounts.php");
require_once(INCLUDES_PATH.DS."Account_Details.php");
require_once(INCLUDES_PATH.DS."Booking.php");
require_once(INCLUDES_PATH.DS."Guest.php");
require_once(INCLUDES_PATH.DS."Quotation.php");
require_once(INCLUDES_PATH.DS."Availability.php");
require_once(INCLUDES_PATH.DS."Categories.php");
require_once(INCLUDES_PATH.DS."Features.php");
require_once(INCLUDES_PATH.DS."EventWedding.php");
require_once(INCLUDES_PATH.DS."Gallery.php");
require_once(INCLUDES_PATH.DS."Users.php");
require_once(INCLUDES_PATH.DS."Events.php");
require_once(INCLUDES_PATH.DS."Liquidation.php");

?>
