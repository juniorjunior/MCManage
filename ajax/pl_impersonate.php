<?php

require '../header.php';
require_login();
require_ACL(ACL_PLAYERS, BASICHTML);

use Thedudeguy\Rcon;

$rcon = new Rcon('127.0.0.1', RCONPORT, RCONPASS, 3);
$response = null;
if ( $rcon->connect() ) {
   $response = trim($rcon->sendCommand("list"));
}
if ( !is_null($response) ) {
   $parts = explode(":", strtolower($response));
   if ( strpos($parts[1], strtolower($currentuser->getIGN())) !== false ) {
      $data['error'] = true;
      $data['toast'] = "You must be offline before altering your player data!";
      $data['toasttime'] = 4000;
      pushData();
   }
}

$data = array();
$data['error'] = false;

$admin_ign = $currentuser->getIGN();
$admin_uuid = $currentuser->getUUID();

if ( $currentuser->getUUID() === false ) {
   $data['error'] = true;
   $data['toast'] = "Could not find your player data on the server!";
   $data['toasttime'] = 4000;
   pushData();
}

$backup_folder = WORLDFOLDER . "adminbackup/";
$pdata_folder = WORLDFOLDER . "playerdata/";

$admin_files = array("{$admin_uuid}.dat",
                     "{$admin_ign}.baub",
                     "{$admin_ign}.baubback",
                     "{$admin_ign}.thaum",
                     "{$admin_ign}.thaumback");

if ( isset($_REQUEST['restore']) ) {
   $restored = restoreAdminFiles();
   if ( $restored ) {
      $data['toast'] = "Your player data files have been restored.";
      $data['toasttime'] = 4000;
   } else {
      $data['error'] = true;
      $data['toast'] = "Error restoring your data files. Contact owner!";
      $data['toasttime'] = 4000;
   }
   pushData();
}

if ( !isset($_REQUEST['ign']) ) exit();

$pdata_ign = $_REQUEST['ign'];
$pdata_uuid = array_search($pdata_ign, $usercache);

$pdata_files = array("{$pdata_uuid}.dat",
                     "{$pdata_ign}.baub",
                     "{$pdata_ign}.baubback",
                     "{$pdata_ign}.thaum",
                     "{$pdata_ign}.thaumback");

if ( isset($_REQUEST['restore']) ) {
   $restored = restoreAdminFiles();
   if ( $restored ) {
      $data['toast'] = "Your player data has been restored from backup!";
      $data['toasttime'] = 4000;
   } else {
      $data['error'] = true;
      $data['toast'] = "Could not restore playere data. Contact owner!";
      $data['toasttime'] = 4000;
   }
   pushData();
}

if ( !file_exists(WORLDFOLDER . "adminbackup") ) {
   $data['error'] = true;
   $data['toast'] = "Admin backup folder does not exist. Contact owner!";
   $data['toasttime'] = 4000;
   pushData();
}

# Backup the admin player data to the adminbackup folder
$success = true;
foreach ( $admin_files as $pdata_file ) {
   $goodcopy = copy($pdata_folder . $pdata_file, $backup_folder . $pdata_file);
   if ( !$goodcopy ) $success = false;
}
if ( !$success ) {
   $data['error'] = true;
   $data['toast'] = "Error backing up admin player data!";
   $data['toasttime'] = 4000;
   pushData();
}

# Copy the player's data files over the admin player files
$success = true;
for ( $i=0; $i<count($pdata_files); $i++ ) {
   $pdata_file = $pdata_folder . $pdata_files[$i];
   $admin_file = $pdata_folder . $admin_files[$i];
   $goodcopy = copy($pdata_file, $admin_file);
   if ( !$goodcopy ) $success = false;
}

if ( $success ) {
   $data['toast'] = "You are now using {$_REQUEST['ign']}'s player data!";
   $data['toasttime'] = 4000;
} else {
   restoreAdminFiles();
   $data['error'] = true;
   $data['toast'] = "Could not copy from {$_REQUEST['ign']}'s playere data! Contact owner!";
}
pushData();

function pushData() {
   global $data;

   header('Content-Type: application/json');
   echo json_encode($data);
   exit();
}

function restoreAdminFiles() {
   global $admin_files, $backup_folder, $pdata_folder;
   $success = true;
   foreach ( $admin_files as $pdata_file ) {
      $goodcopy = copy($backup_folder . $pdata_file, $pdata_folder . $pdata_file);
      if ( !$goodcopy ) $success = false;
   }
   return $success;
}

exit();

?>
