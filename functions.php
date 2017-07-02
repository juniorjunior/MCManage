<?php

//
// This function is called at the beginning of any pages where
// user login is required. Feel free to change the logic between
// the lines indicated below.
//
function require_login($flag = 0) {
   global $currentuser;
   if ( basename($_SERVER['SCRIPT_NAME']) == "login.php" ) return true;
   //                         ******** START OF AUTH LOGIC ********
   if ( $_SESSION['userid'] == 0 ) {
      if ( substr(dirname($self), -5) != "/ajax" ) header('Location: login.php');
      exit();
   }
   if ( (($flag == ADMIN) && !$currentuser->isAdmin()) ) {
      if ( substr(dirname($self), -5) != "/ajax" ) header('Location: index.php');
      exit();
   } else {
      return true;
   }
   //                         ********* END OF AUTH LOGIC *********
}

//
// This function will redirect to the home page if the current session
// has a validated user (i.e. userid != 0).
//
function require_anonymous() {
   if ( $_SESSION['userid'] != 0 ) {
      header('Location: index.php');
      exit();
   }
}

//
// Check for ACL or Admin and stop the page if not.
//
function require_ACL($type = null, $flag = 0) {
   global $currentuser;

   if ( $flag === BASICHTML ) return $currentuser->hasACL($type);
   if ( !$currentuser->hasACL($type) ) {
      if ( $flag === BASICHTML ) exit();
      echo "<div class='row'><div class='col s12'><h1 class='center-align'>You do not have access rights to this page</h1></div></div>";
      require 'htmlfooter.php';
      exit();
   }
}

function isLoggedIn($flag = 0) {
   global $currentuser;
   if ( $_SESSION['userid'] == 0 ) return false;
   if ( (($flag == ADMIN) && !$currentuser->isAdmin()) ) {
      return false;
   } else {
      return true;
   }
}

//
// A simple function to redirect a page while still in the header
//
function redirectPage($page = null) {
   if ( is_null($page) ) $page = "index.php";
   header("Location: {$page}");
   exit();
}

//
// This function outputs the HTML header along with adding a string
// of text to the page title.
//
function includeHTMLHeader($headertext = "", ...$sheets) {
   global $currentuser;
   if ($headertext != "") $fullpagetitle = htmlspecialchars($headertext);
   $extrasheets = "      <!-- Extra CSS included by the current page -->\n";
   foreach ( $sheets as $sheet ) {
      $extrasheets .= "      <link type='text/css' rel='stylesheet' href='css/{$sheet}'/>\n";
   }
   require 'htmlheader.php';
}

//
// This function outputs the HTML header along with adding a string
// of text to the page title. This is for pages without side navigation.
//
function includeHTMLHeaderBasic($headertext = "", ...$sheets) {
   global $currentuser;
   if ($headertext != "") $fullpagetitle = htmlspecialchars($headertext);
   $extrasheets = "      <!-- Extra CSS included by the current page -->\n";
   foreach ( $sheets as $sheet ) {
      $extrasheets .= "      <link type='text/css' rel='stylesheet' href='css/{$sheet}'/>\n";
   }
   require 'htmlheader-basic.php';
}

//
// This function outputs the HTML footer along with adding script tags
// for any script files passed to the function. These files are assumed
// to be in the js/ folder.
//
function includeHTMLFooter(...$scripts) {
   require 'htmlfooter.php';
   foreach ( $scripts as $script ) {
      echo "<script type='text/javascript' src='js/", trim($script), "'></script>\n";
   }
   echo "    </body>\n";
   echo "  </html>\n";
}

//
// This function outputs the HTML footer along with adding script tags
// for any script files passed to the function. These files are assumed
// to be in the js/ folder. This is for pages without side navigation.
//
function includeHTMLFooterBasic(...$scripts) {
   require 'htmlfooter-basic.php';
   foreach ( $scripts as $script ) {
      echo "<script type='text/javascript' src='js/", trim($script), "'></script>\n";
   }
   echo "    </body>\n";
   echo "  </html>\n";
}

//
// If the current page matches the page passed to the function then
// print out the active class.
function checkActive($file = null) {
   if ( is_null($file) ) return;
   if ( $file == basename($_SERVER['PHP_SELF']) ) echo "class='active'";
   return;
}

function tailCustom($filepath, $lines = 1, $adaptive = true) {

   // Open file
   $f = @fopen($filepath, "rb");
   if ($f === false) return false;

   // Sets buffer size, according to the number of lines to retrieve.
   // This gives a performance boost when reading a few lines from the file.
   if (!$adaptive) $buffer = 4096;
      else $buffer = ($lines < 2 ? 64 : ($lines < 10 ? 512 : 4096));

   // Jump to last character
   fseek($f, -1, SEEK_END);

   // Read it and adjust line number if necessary
   // (Otherwise the result would be wrong if file doesn't end with a blank line)
   if (fread($f, 1) != "\n") $lines -= 1;
      
   // Start reading
   $output = '';
   $chunk = '';

   // While we would like more
   while (ftell($f) > 0 && $lines >= 0) {

      // Figure out how far back we should jump
      $seek = min(ftell($f), $buffer);

      // Do the jump (backwards, relative to where we are)
      fseek($f, -$seek, SEEK_CUR);

      // Read a chunk and prepend it to our output
      $output = ($chunk = fread($f, $seek)) . $output;

      // Jump back to where we started reading
      fseek($f, -mb_strlen($chunk, '8bit'), SEEK_CUR);

      // Decrease our line counter
      $lines -= substr_count($chunk, "\n");

   }

   // While we have too many lines
   // (Because of buffer size we might have read too many)
   while ($lines++ < 0) {

      // Find first newline and remove all text before that
      $output = substr($output, strpos($output, "\n") + 1);

   }

   // Close file and return
   fclose($f);
   return trim($output);

}


?>
