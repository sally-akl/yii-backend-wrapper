<?php
ini_set('session.save_handler', 'files');
if(!isset($_SESSION)) 
	session_start();
	   
error_reporting(0);
//error_reporting(E_ALL | E_STRICT);
//date_default_timezone_set("Asia/Riyadh");

global $language;
global $content;
$language = "en";
if(isset($_GET["language"]))
	$language = $_GET["language"];



require_once(dirname(__FILE__) . '/backend/CClientScript.php');
require_once(dirname(__FILE__) . '/backend/ClientScript.php');
require_once(dirname(__FILE__) . '/backend/CHtml.php');
require_once(dirname(__FILE__) . '/backend/Request.php');
require_once(dirname(__FILE__) . '/backend/UserData.php');
require_once(dirname(__FILE__) . '/backend/App.php');
require_once(dirname(__FILE__) . '/backend/view.php');
require_once(dirname(__FILE__) . '/backend/Yii.php');
require_once(dirname(__FILE__) . '/backend/structure/MasterController.php');
require_once(dirname(__FILE__) . '/backend/structure/LoginController.php');


Yii::createWebApplication();

?>
