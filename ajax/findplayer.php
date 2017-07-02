<?php

require '../header.php';
require '../MinecraftUUID.php';
require_login();
require_ACL(ACL_PLAYERS, BASICHTML);

if ( !isset($_REQUEST['ign']) ) exit();

$data = array();
$data['error'] = false;
$data['uuid'] = "";

function finishScript($data) {
   header('Content-Type: application/json');
   echo json_encode($data);
   exit();
}

$profile = ProfileUtils::getProfile($_REQUEST['ign']);

// raw: 39219b8f01b64b2d8e2f3d86b2a58764
// playerdata: 39219b8f-01b6-4b2d-8e2f-3d86b2a58764

if ( !is_null($profile) ) {
   $result = $profile->getProfileAsArray();
   $ru = $result['uuid'];
   $data['uuid'] = substr($ru, 0, 8) . "-" . substr($ru, 8, 4) . "-" . substr($ru, 12, 4) . "-" . substr($ru, 16, 4) . "-" . substr($ru, 20);
   $data['username'] = $result['username'];
} else {
   $data['error'] = true;
   $data['toast'] = "IGN Does Not Exist!";
   $data['toasttime'] = 4000;
   finishScript($data);
}

$playerfile = $data['uuid'] . ".dat";

if ( !file_exists(WORLDFOLDER . "playerdata/" . $playerfile) ) {
   $data['error'] = true;
   $data['toast'] = "No Player Data Exists For: {$data['username']}!";
   $data['toasttime'] = 4000;
   finishScript($data);
}

$data['toast'] = "Player Data Found! Starting Editor...";
$data['toasttime'] = 4000;
finishScript($data);

?>
