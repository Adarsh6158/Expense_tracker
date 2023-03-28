<?php
error_reporting(0);
session_start();
header('Content-type: text/html; charset=UTF-8');
$params = $_POST;
ini_set("display_errors", 1);
error_reporting(E_ALL^E_NOTICE^E_DEPRECATED);

//For Cache
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.


if(isset($_GET)){
    foreach($_GET as $k=>$v){
	$params[$k]=$v;
	
	if(!isset($_SESSION['admin'])){
	    if(is_string($v) && (preg_match('/[\'^£%*()=}{~><>]/', $v) || preg_match('/[\'^£%*()=}{~><>]/', $k))){
		echo "Sorry, there was an error with your submission. If you're trying to setup a password, please avoid certain special characters.";
		die;
	    }
	}
	
    }
}


foreach($params as $k=>$v){
    if(is_string($v) && (preg_match('/[\'^£%*()=}{~><>]/', $v) || preg_match('/[\'^£%*()=}{~><>]/', $k))){
	echo "Sorry, there was an error with your submission. If you're trying to setup a password, please avoid certain special characters.";
	die;
    }
}


if(isset($_SERVER['SERVER_NAME']) && ($_SERVER['SERVER_NAME'] !== "www.localhost" && $_SERVER['SERVER_NAME'] !== "localhost")){
    if(php_sapi_name() !== 'cli' && (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off")){
	$redirect = 'https://' . str_replace("www.", "", $_SERVER['HTTP_HOST']) . $_SERVER['REQUEST_URI'];
	header('HTTP/1.1 301 Moved Permanently');
	header('Location: ' . $redirect);
	exit();
    }
}


$config = new stdClass();

use Doctrine\Common\ClassLoader;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Driver;

$sitepath = __DIR__;


if(isset($_SERVER['SERVER_NAME']) && ($_SERVER['SERVER_NAME'] == "www.localhost" || $_SERVER['SERVER_NAME'] == "localhost")){
    require "Doctrine/Common/ClassLoader.php";
    require "Doctrine/DBAL/DriverManager.php";

    require "Doctrine/DBAL/Configuration.php";
    require "Doctrine/Common/EventManager.php";
    require "Doctrine/DBAL/Driver.php";
}else{
    
    require "$sitepath/Doctrine/Common/ClassLoader.php";
    require "$sitepath/Doctrine/DBAL/DriverManager.php";

    require "$sitepath/Doctrine/DBAL/Configuration.php";
    require "$sitepath/Doctrine/Common/EventManager.php";
    require "$sitepath/Doctrine/DBAL/Driver.php";
}

if(isset($_SERVER['SERVER_NAME']) && ($_SERVER['SERVER_NAME'] == "www.localhost" || $_SERVER['SERVER_NAME'] == "localhost")){
    if(isset($level) && $level==2){
	$classLoader = new ClassLoader('Doctrine', "../../");
    }else if(isset($level) && $level==1){
	$classLoader = new ClassLoader('Doctrine', "../");
    }else{
	$classLoader = new ClassLoader('Doctrine', "./");
    }
}else{
    if(isset($level) && $level==2){
	$classLoader = new ClassLoader('Doctrine', "$sitepath/");
    }else if(isset($level) && $level==1){
	$classLoader = new ClassLoader('Doctrine', "$sitepath/");
    }else{
	$classLoader = new ClassLoader('Doctrine', "$sitepath/");
    }
}


$classLoader->register();

$d_config = new Configuration();


if(isset($_SERVER['SERVER_NAME']) && ($_SERVER['SERVER_NAME'] == "www.localhost" || $_SERVER['SERVER_NAME'] == "localhost")){
    $dbname = "Expense_Tracker";
    $connectionParams = array(
	'dbname' => $dbname,
	'user' => 'root',
	'password' => '',
	'host' => 'localhost',
	'port' => 3306,
	'charset' => 'utf8',
	'driver' => 'pdo_mysql',
    );
    
    
    if(isset($level) && $level==2){
	include '../../Utils/PHPMailer/PHPMailerAutoload.php';
	include '../../Utils/PHPMailer/class.phpmailer.php';
    }else if(isset($level) && $level==1){
	include '../Utils/PHPMailer/PHPMailerAutoload.php';
	include '../Utils/PHPMailer/class.phpmailer.php';
    }else{
	include './Utils/PHPMailer/PHPMailerAutoload.php';
	include './Utils/PHPMailer/class.phpmailer.php';
    }
}else{
    include "$sitepath/PHPMailerAutoload.php";
    include "$sitepath/class.phpmailer.php";
    
    
    
    $dbname = "Expense_Tracker";
    $connectionParams = array('dbname' => $dbname,'user' => 'root','password' => 'Eth@nPl@ss3!@#','host' => 'localhost','port' => 3306,'charset' => 'utf8','driver' => 'pdo_mysql');
}




if(isset($_SERVER['SERVER_NAME']) && ($_SERVER['SERVER_NAME'] == "www.localhost" || $_SERVER['SERVER_NAME'] == "localhost")){
    define('MAIN_URL', "http://localhost/Expense");
    $local = true;
}else{
    define('MAIN_URL', "https://appently.com/clients/zar");
    $local = false;
}

$config->site_url = MAIN_URL;
$config->fee_percent = 1;


$db = DriverManager::getConnection($connectionParams, $d_config);

function var_dump2($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}


//$preferences = get_preferences();
//function get_preferences(){
//    global $db;
//    $admin = $db->query("SELECT * FROM preferences")->fetchAll(PDO::FETCH_ASSOC);
//    
//    $preferences = array();
//    foreach($admin as $k=>$v){
//	$preferences[$v['attribute']] = $v['value'];
//    }
//    
//    return $preferences;
//}


function get_info($table, $id){
    global $db;
    if($table == "wp_users"){
	$column = "ID";
    }if($table == "sports"){
	$column = "sport_name";
    }else{
	$column = "id";
    }
    $result = $db->query("SELECT * FROM $table WHERE $column = '$id'")->fetch(PDO::FETCH_ASSOC);
    
    return $result;
}

function get_info2($table, $column, $value){
    global $db;
    
    $result = $db->query("SELECT * FROM $table WHERE $column = '$value'")->fetch(PDO::FETCH_ASSOC);
    
    return $result;
}
function get_attribute($table, $id, $attribute){
    global $db;
    if($table == "wp_users"){
	$column = "ID";
    }else{
	$column = "id";
    }
    
    
    $result = $db->query("SELECT $attribute FROM $table WHERE $column = $id")->fetchColumn();
    
    
    return $result;
}
function get_user_browser(){
    $broswer = $_SERVER['HTTP_USER_AGENT'];
    
    return $broswer;
}
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function ss() {
    if (isset($_SESSION['user'])) {
	return TRUE;
    } else {
	return FALSE;
    }
}

function su_($v) {
    return $_SESSION['user'][$v];
}

function get_datetime(){
    return date('Y-m-d H:i:s');
}


function get_random_code($length){
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
    }

    return $token;
}

function get_random_uc_code($length){
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
    }

    return $token;
}

function get_random_numeric_code($length){
    
    $token = "";
    $codeAlphabet = "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
    }

    return $token;
}
function crypto_rand_secure($min, $max){
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
}



function checkPassword($pwd, &$errors) {
    $errors_init = $errors;

    if (strlen($pwd) < 12) {
        $errors[] = "Password too short!";
    }

    if (!preg_match("#[0-9]+#", $pwd)) {
        $errors[] = "Password must include at least one number!";
    }

    if (!preg_match("#[a-z]+#", $pwd)) {
        $errors[] = "Password must include at least one lowercase letter!";
    }     
    
    if (!preg_match("#[A-Z]+#", $pwd)) {
        $errors[] = "Password must include at least one uppercase letter!";
    }     

    return ($errors == $errors_init);
}
