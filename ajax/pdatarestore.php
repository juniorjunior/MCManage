<?php

require '../header.php';
require_login();
require_ACL(ACL_PLAYERS, BASICHTML);

use Thedudeguy\Rcon;

if ( !isset($_REQUEST['ign']) || !isset($_REQUEST['uuid']) || !isset($_REQUEST['file']) ) exit();

$data = array();
$data['error'] = false;

$sourcefolder = realpath(PDATABACKUPDIR . dirname($_REQUEST['file']));
if ( $sourcefolder === false ) exit();
$sourcefolder .= "/";
$file = basename($_REQUEST['file']);
if ( !file_exists($sourcefolder . $file) ) {
   $data['error'] = true;
   $data['toast'] = "Could not find player data file!";
   $data['toasttime'] = 4000;
   pushData();
}

$ign = $_REQUEST['ign'];
$uuid = $_REQUEST['uuid'];

$rcon = new Rcon('127.0.0.1', RCONPORT, RCONPASS, 3);
$response = null;
if ( $rcon->connect() ) {
   $response = trim($rcon->sendCommand("list"));
}
if ( !is_null($response) ) {
   $parts = explode(":", strtolower($response));
   if ( strpos($parts[1], strtolower($_REQUEST['ign'])) !== false ) {
      $data['error'] = true;
      $data['toast'] = "Player must be offline before restoring data!";
      $data['toasttime'] = 4000;
      pushData();
   }
}

$targetfolder = WORLDFOLDER . "playerdata/";
copy($sourcefolder . $uuid . ".dat", $targetfolder . $uuid . ".dat");
if ( file_exists($sourcefolder . $ign . ".baub") ) copy($sourcefolder . $ign . ".baub", $targetfolder . $ign . ".baub");
if ( file_exists($sourcefolder . $ign . ".baubback") ) copy($sourcefolder . $ign . ".baubback", $targetfolder . $ign . ".baubback");
if ( file_exists($sourcefolder . $ign . ".thaum") ) copy($sourcefolder . $ign . ".thaum", $targetfolder . $ign . ".thaum");
if ( file_exists($sourcefolder . $ign . ".thaumback") ) copy($sourcefolder . $ign . ".thaumback", $targetfolder . $ign . ".thaumback");

$data['toast'] = "Restored {$ign}'s data from " . date("M j, H:i", filemtime($sourcefolder . $uuid . ".dat"));
$data['toasttime'] = 4000;
pushData();

function pushData() {
   global $data;

   header('Content-Type: application/json');
   echo json_encode($data);
   exit();
}

exit();

?>
