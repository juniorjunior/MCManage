<?php

require '../header.php';
require_anonymous();

if ( !isset($_POST['ign']) || !isset($_POST['password']) || !isset($_POST['remember']) ) exit();

$user = User::getUserFromLogin($_POST['ign'], $_POST['password']);

$data = array();
$data['error'] = false;

if ( $user === LOGININVALID ) {
   $data['error'] = true;
   $data['toast'] = "Invalid username or password!";
   $data['toasttime'] = 4000;
} elseif ( $user === LOGINLOCKED ) {
   $data['error'] = true;
   $data['toast'] = "Account is locked! Try again in " . BADLOGINEXPIRATION . " minutes.";
   $data['toasttime'] = 28000;
} else {
   $_SESSION['userid'] = $user->getID();
   $user->saveLastLogin();
   if ( $_REQUEST['remember'] == "1" ) {
      $user->setCookie($_SERVER['REMOTE_ADDR']);
   }
   $data['status'] = "valid";
}

header('Content-Type: application/json');
echo json_encode($data);
exit();

?>
