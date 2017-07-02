<?php

require '../header.php';
require_login();
require_ACL(ACL_CONSOLE, BASICHTML);

$console = tailCustom(CONSOLELOG, 100);
$lines = preg_split("/\n/", $console);

$data = array();
$data['console'] = "";
for ( $i=0; $i<count($lines); $i++ ) {
   if ( ($i % 2) == 0 ) {
      $class = "crow";
   } else {
      $class = "lightcrow";
   }
   $data['console'] .= "<div class='{$class}'>" . trim($lines[$i]) . "</div>";
}

$latestlog = tailCustom(LATESTLOG, 100);
$lines = preg_split("/\n/", $latestlog);

$data['latestlog'] = "";
for ( $i=0; $i<count($lines); $i++ ) {
   if ( ($i % 2) == 0 ) {
      $class = "crow";
   } else {
      $class = "lightcrow";
   }
   $data['latestlog'] .= "<div class='{$class}'>" . trim($lines[$i]) . "</div>";
}

$data['console'] = utf8_encode($data['console']);
$data['latestlog'] = utf8_encode($data['latestlog']);

header('Content-Type: application/json');
echo json_encode($data);
exit();

?>
