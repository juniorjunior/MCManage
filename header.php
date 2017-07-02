<?php

require 'constants.php';
require 'config.php';
require 'functions.php';
require 'class_user.php';
require 'vendor/PHP-Minecraft-Rcon/Rcon.php';

// Make our PDO database connection which will be used in all scripts
try {
   $globaldbh = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
} catch (PDOException $e) {
   header('Location: error.html');
   exit(); 
}

if ( php_sapi_name() != "cli" ) {
   require 'startsession.php';
}

$currentuser = new User($_SESSION['userid']);

?>
