<?php

require '../header.php';
require_login();
require_ACL(ACL_PLAYERS, BASICHTML);

use Thedudeguy\Rcon;

if ( !isset($_REQUEST['ign']) || !isset($_REQUEST['uuid']) ) exit();

$data = array();
$data['error'] = false;

$rcon = new Rcon('127.0.0.1', RCONPORT, RCONPASS, 3);
$response = null;
if ( $rcon->connect() ) {
   $response = trim($rcon->sendCommand("list"));
}
if ( !is_null($response) ) {
   $parts = explode(":", strtolower($response));
   if ( strpos($parts[1], strtolower($_REQUEST['ign'])) !== false ) {
      $data['error'] = true;
      $data['toast'] = "Players must be offline before editing data!";
      $data['toasttime'] = 4000;
      pushData();
   }
}

$levelfile = WORLDFOLDER . "level.dat";
$datafile = WORLDFOLDER . "playerdata/{$_REQUEST['uuid']}.dat";
$response = `python3 ../pyscripts/fixwandindex.py {$levelfile} {$datafile}`;
$data['toast'] = $response;
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
