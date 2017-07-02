<?php

if ( php_sapi_name() == "cli" ) exit();

// Start the session
session_name(SESSNAME);
session_start();

// The session variable for the current user
if ( !isset($_SESSION['userid']) ) $_SESSION['userid'] = 0;

// Validate the user from a valid cookie if one exists
if ( isset($_COOKIE[COOKIENAME]) && ($_SESSION['userid'] == 0) ) {
   $cid = User::validateUserCookie($_COOKIE[COOKIENAME]);
   if ( $cid != 0 ) {
      $_SESSION['userid'] = $cid;
   } else {
      setcookie(COOKIENAME, "", time() - 3600, "/", $_SERVER['SERVER_NAME']);
   }
}

?>
