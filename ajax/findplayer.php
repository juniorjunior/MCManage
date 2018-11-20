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

$uuid = array_search(strtolower($_REQUEST['ign']), array_map("strtolower", $usercache));
if ( ($uuid === false) || !file_exists(WORLDFOLDER . "playerdata/" . $uuid . ".dat") ) {
   $data['error'] = true;
   $data['toast'] = "Player Does Not Exist on the server!";
   $data['toasttime'] = 4000;
   finishScript($data);
}
$ign = $usercache[$uuid];

/*
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
*/

$data['uuid'] = $uuid;
$data['username'] = $ign;
$playerfile = $data['uuid'] . ".dat";

if ( !file_exists(WORLDFOLDER . "playerdata/" . $playerfile) ) {
   $data['error'] = true;
   $data['toast'] = "No Player Data Exists For: {$data['username']}!";
   $data['toasttime'] = 4000;
   finishScript($data);
}

$data['firstLogin'] = "unknown";
$data['lastLogin'] = "unknown";
$data['lastLogout'] = "unknown";
$data['home'] = 'unset';
if ( file_exists(WORLDFOLDER . "FEData/json/PlayerInfo/" . $uuid . ".json") ) {
   $fedata = json_decode(file_get_contents(WORLDFOLDER . "FEData/json/PlayerInfo/" . $uuid . ".json"), true);
   $data['firstLogin'] = $fedata['firstLogin'];
   $data['lastLogin'] = $fedata['lastLogin'];
   $data['lastLogout'] = $fedata['lastLogout'];
   if ( array_key_exists("home", $fedata) ) {
      $home = $fedata['home'];
      $home['xd'] = intval($home['xd']);
      $home['yd'] = intval($home['yd']);
      $home['zd'] = intval($home['zd']);
      $data['home'] = $home['xd'] . ", " . $home['yd'] . ", " . $home['zd'] . " in DIM: " . $home['dim'] . " ({$home['xd']} {$home['yd']} {$home['zd']})";
   }
   $splayed = intval($fedata['timePlayed']/1000);
   $days = floor($splayed/86400);
   $splayed = $splayed % 86400;
   $hours = floor($splayed/3600);
   $splayed = $splayed % 3600;
   $minutes = floor($splayed/60);
   $splayed = $splayed % 60;
   $data['timePlayed'] = $days . (($days == 1) ? " Day, " : " Days, ") . $hours . (($hours == 1) ? " Hour, " : " Hours, ") . $minutes . (($minutes == 1) ? " Minute" : " Minutes");
}
$datafile = WORLDFOLDER . "playerdata/{$playerfile}";
$posparts = explode(" ", trim(`python3 ../pyscripts/getcurrentpos.py {$datafile}`));
$x = intval($posparts[0]);
$y = intval($posparts[1]);
$z = intval($posparts[2]);
$dim = intval($posparts[3]);
$data['pos'] = "{$x}, {$y}, {$z} in DIM: {$dim} ({$x} {$y} {$z})";

$findcmd = "find \"" . PDATABACKUPDIR . "\" -name {$playerfile} -print";
$files = explode("\n", trim(`{$findcmd}`));
$list = array();
foreach ( $files as $file ) {
   $mtime = filemtime($file);
   if ( !in_array($mtime, $list) ) {
      $list[substr($file, strlen(PDATABACKUPDIR))] = $mtime;
   }
}
arsort($list, SORT_NUMERIC);
$data["pdata"] = array();
foreach ( $list as $file => $mtime ) {
   $entry = array();
   $entry["file"] = $file;
   $entry["mtime"] = $mtime;
   $entry["mtime_pretty"] = date("M j, H:i", $mtime);
   $data["pdata"][] = $entry;
}


$data['toast'] = "Player Data Found! Starting Editor...";
$data['toasttime'] = 4000;
finishScript($data);

?>
