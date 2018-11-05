<?php

require '../header.php';
require_login();
require_ACL(ACL_CONSOLE, BASICHTML);

$data = array();
$data['error'] = false;

if ( isset($_REQUEST['report']) && file_exists(SERVERROOT . "crash-reports/" . basename($_REQUEST['report'])) ) {
   $data['report'] = htmlspecialchars(file_get_contents(SERVERROOT . "crash-reports/" . basename($_REQUEST['report'])));
   $data['message'] = "Displaying report: " . basename($_REQUEST['report']);
   pushData($data);
}

$files = glob(SERVERROOT . "crash-reports/crash*.txt");
rsort($files);
$data['crashreports'] = array_map("basename", $files);

if ( count($data['crashreports']) == 0 ) {
   $data['error'] = true;
   $data['message'] = "No crash reports available.";
} else {
   $data['message'] = "Found " . count($data['crashreports']) . " crash report" . ((count($data['crashreports']) != 1)?"s":"") . ".";
}

pushData($data);

function pushData($data) {
   header('Content-Type: application/json');
   echo json_encode($data);
   exit();
}

?>
