<?php

require '../header.php';
require_anonymous();

if ( !isset($_POST['ign']) || !isset($_POST['password']) ) exit();
$ign = $_POST['ign'];
$password = $_POST['password'];

function sendResponse($data) {
   header('Content-Type: application/json');
   echo json_encode($data);
   exit();
}

$data = array();
$data['error'] = false;
$data['toast'] = "";

if ( !REGISTRATIONENABLED ) {
   $data['error'] = true;
   $data['toast'] = "Registrations are currently disabled!";
   $data['toasttime'] = 4000;
   sendResponse($data);
}

$uuid = $uuid = array_search($_REQUEST['ign'], $usercache);
if ( $uuid === false ) {
   $data['error'] = true;
   $data['toast'] = "Could not find your player name. IGN is case sensitive!";
   $data['toasttime'] = 4000;
   sendResponse($data);
}
$perms = json_decode(file_get_contents(WORLDFOLDER . "/FEData/permissions.json"), true);
if ( !in_array("Mod", $perms["playerGroups"]["({$uuid}|{$_REQUEST['ign']})"]) ) {
   $data['error'] = true;
   $data['toast'] = "You must be in in-game Mod to register here";
   $data['toasttime'] = 4000;
   sendResponse($data);
}

$query = "SELECT ign FROM " . TABLE_REGISTRATIONS . " WHERE ipaddress=:ipaddress AND createtime > SUBDATE(NOW(), INTERVAL 30 MINUTE)";
$fields = array();
$fields[':ipaddress'] = $_SERVER['REMOTE_ADDR'];
$sth = $globaldbh->prepare($query);
$sth->execute($fields);

if ( $row = $sth->fetch(PDO::FETCH_ASSOC) ) {
   $data['error'] = true;
   $data['toast'] = "Too many registration requests from this IP!";
   sendResponse($data);
}
User::logRegistration($ign, $_SERVER['REMOTE_ADDR']);

$existinguser = User::getUserByIGN($ign);
if ( $existinguser !== false ) {
   $data['error'] = true;
   $data['toast'] = "User already registered!";
   sendResponse($data);
}

$users = User::getList();
$admin = false;
if ( count($users) == 0 ) {
   $admin = true;
   $data['toast'] = "Administrator registration successful! You may now log in.";
} else {
   $data['toast'] = "Registration successful! You may now log in.";
}

$newuser = new User();
$newuser->setIGN($ign);
$newuser->setPassword($password);
$newuser->setAdmin($admin);
$newuser->save();

sendResponse($data);

?>
