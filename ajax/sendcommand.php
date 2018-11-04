<?php

require '../header.php';
require_login();
require_ACL(ACL_CONSOLE, BASICHTML);

$commands = ["killserver" => "",
             "stopserver" => "stop",
             "startserver" => "./launch.sh",
             "enter" => "",
             "cofhtps" => "cofh tps",
             "forgetps" => "forge tps",
             "listplayers" => "list",
             "profile_e" => "profile e"];

if ( !isset($_REQUEST['command']) || !array_key_exists($_REQUEST['command'], $commands) ) exit();

$command = $_REQUEST['command'];

$data = array();
$data['error'] = false;

switch ($command) {
   case "killserver":
      $pid = getServerPID();
      if ( $pid === false ) {
         $data['error'] = true;
         $data['message'] = "Server does not appear to be running!";
      } else {
         $junk = `kill -9 {$pid}`;
         $data['message'] = "Tried to kill the server. Watch the console!";
      }
      break;
   case "stopserver":
      $pid = getServerPID();
      if ( $pid === false ) {
         $data['error'] = true;
         $data['message'] = "Server does not appear to be running!";
      } else {
         sendCommand($commands[$command]);
         $data['message'] = "Stopping the server...";
      }
      break;
   case "startserver":
      $pid = getServerPID();
      if ( $pid !== false ) {
         $data['error'] = true;
         $data['message'] = "Server appears to be running. Cannot start!";
      } else {
         sendCommand($commands[$command]);
         $data['message'] = "Starting the server...";
      }
      break;
   case "enter":
      sendCommand($commands[$command]);
      $data['message'] = "Pressing 'Enter'. Watch the console...";
      break;
   case "cofhtps":
      sendCommand($commands[$command]);
      $data['message'] = "Checking CoFH TPS...";
      break;
   case "forgetps":
      sendCommand($commands[$command]);
      $data['message'] = "Checking Forge TPS...";
      break;
   case "listplayers":
      sendCommand($commands[$command]);
      $data['message'] = "Listing Players...";
      break;
   case "profile_e":
      sendCommand($commands[$command]);
      $data['message'] = "Profiling Entities. Output in 30 seconds...";
      break;
}

header('Content-Type: application/json');
echo json_encode($data);
exit();

function getServerPID() {
   $fullcommand = 'ps -eaf | grep -i doNotBackup | grep -v grep | awk \'{print $2}\'';
   $pid = trim(`$fullcommand`);
   return ((strlen($pid) == 0) ? false : $pid);
}

function sendCommand($c) {
   $fullcommand = "screen -d -r " . SCREENNAME . " -p 0 -X stuff \"{$c} \$(printf '\\r')\"";
   $junk = `$fullcommand`;
}

?>
