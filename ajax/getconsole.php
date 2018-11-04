<?php

require '../header.php';
require_login();
require_ACL(ACL_CONSOLE, BASICHTML);

function colorize($string) {
   $splitchar = '§';
   $parts = explode('§', $string);
   $colorized = "";
   foreach ( $parts as $part ) {
      if ( $part == "" ) continue;
      $class = "mc_" . substr($part, 0, 1);
      $colorized .= "<span class='{$class}'>" . htmlspecialchars(substr($part, 1)) . "</span>";
   }
   return $colorized;
}

$console = tailCustom(CONSOLELOG, 100);
$lines = preg_split("/\n/", $console);

$data = array();
$data['console'] = "";
for ( $i=0; $i<count($lines); $i++ ) {
   $data['console'] .= "<div class='" . ((($i % 2) == 0) ? "crow" : "lightcrow") . "'>" . htmlspecialchars(trim($lines[$i])) . "</div>";
}

$latestlog = tailCustom(LATESTLOG, 100);
$lines = preg_split("/\n/", $latestlog);

$data['latestlog'] = "";
for ( $i=0; $i<count($lines); $i++ ) {
   $data['latestlog'] .= "<div class='" . ((($i % 2) == 0) ? "crow" : "lightcrow") . "'>" . colorize(trim($lines[$i])) . "</div>";
}

$screenlog = tailCustom(SCREENLOG, 100);
$lines = preg_split("/\n/", $screenlog);

$data['screenlog'] = "";
for ( $i=0; $i<count($lines); $i++ ) {
   $data['screenlog'] .= "<div class='" . ((($i % 2) == 0) ? "crow" : "lightcrow") . "'>" . colorize(trim($lines[$i])) . "</div>";
}

$data['console'] = utf8_encode($data['console']);
$data['latestlog'] = utf8_encode($data['latestlog']);
$data['screenlog'] = utf8_encode($data['screenlog']);

header('Content-Type: application/json');
echo json_encode($data);
exit();

?>
