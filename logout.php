<?php

require 'header.php';

require_login();

$currentuser->removeCookie();

session_destroy();
header('Location: login.php');
exit();

?>
