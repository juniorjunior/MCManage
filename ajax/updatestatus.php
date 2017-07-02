<?php

require '../header.php';
require_login();
require_ACL(ACL_STATUS, BASICHTML);

use Thedudeguy\Rcon;

$data = array();
$unique = uniqid();

$procuptime = file_get_contents("/proc/uptime");
$uptimeparts = preg_split("/\s+/", $procuptime);
$systemstarted = time() - intval($uptimeparts[0]);
$ssdt = new DateTime(date("Y-m-d H:i:s", $systemstarted));
$interval = date_diff(new DateTime(), $ssdt);
$data['systemuptime'] = $interval->format("%d days, %h hours, %i minutes");

$procloadavg = file_get_contents("/proc/loadavg");
$parts = preg_split("/\s+/", $procloadavg);
if ( file_exists('images/cpu-day.png') ) {
   $data['systemload'] .= "<img src='images/cpu-day.png?r=" . $unique . "'><br />";
}
$data['systemload'] .= intval($parts[0] * 100)/SYSTEMCPUS . "%, ";
$data['systemload'] .= intval($parts[1] * 100)/SYSTEMCPUS . "%, ";
$data['systemload'] .= intval($parts[2] * 100)/SYSTEMCPUS . "%, (1m, 5m, 15m)";

if ( file_exists('images/external-day.png') ) {
   $data['networkusage'] = "<img src='images/external-day.png?r=" . $unique . "'><br />";
   $data['networkusage'] .= "Green: Inbound, Blue: Outbound";
} else {
   $data['networkusage'] = "No network usage status avaialble";
}

$psline = trim(exec("ps -eaf | grep forge | grep -v grep"));
$psparts = preg_split("/[\s,]+/", $psline);
$pid = $psparts[1];
$serverstarted = filemtime("/proc/" . $pid . "/net");
$started = new DateTime(date("Y-m-d H:i:s", $serverstarted));
$now = new DateTime();
$interval = date_diff($now, $started);
$data['serveruptime'] = $interval->format("%d days, %h hours, %i minutes");

$data['servertps'] = "";
$data['dimensiontps'] = "";
$rcon = new Rcon('127.0.0.1', RCONPORT, RCONPASS, 3);
$response = null;
if ( $rcon->connect() ) {
   $response = $rcon->sendCommand("cofh tps");
}
if ( !is_null($response) ) {
   $parts = explode(")", trim($response));
   $data['servertps'] = $parts[0] . ")";
   for ( $i=1; $i<(count($parts)-1); $i++ ) {
      $data['dimensiontps'] .= $parts[$i] . ")";
      if ( $i != (count($parts) - 2) ) $data['dimensiontps'] .= "<br />";
   }
}

$data['players'] = "";
$response = null;
if ( $rcon->isConnected() ) {
   $response = trim($rcon->sendCommand("list"));
}
if ( !is_null($response) ) {
   $parts = explode(":", $response);
   $data['players'] = $parts[0] . ":<br />" . $parts[1];
}


header('Content-Type: application/json');
echo json_encode($data);
exit();

?>
