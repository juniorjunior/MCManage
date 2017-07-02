<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title id="pagetitle"><?php echo $fullpagetitle; ?></title>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Let browser know website is optimized for mobile-->
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <!-- Favicon -->
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="css/materialize.css">
  <!--Main CSS-->
  <link rel="stylesheet" href="css/main.css">
  <!--Page Specific CSS-->
<?php
// This is where dynamically added stylesheets will show up
echo $extrasheets;
?>
</head>
<body>
<ul id='tools-dropdown' class='dropdown-content'>
  <?php if ( $currentuser->hasACL(ACL_STATUS) ) { ?><li><a href='index.php'>Status</a></li><?php } ?>
  <?php if ( $currentuser->hasACL(ACL_CONSOLE) ) { ?><li><a href='console.php'>Console</a></li><?php } ?>
  <?php if ( $currentuser->hasACL(ACL_GRAVES) ) { ?><li><a href='graves.php'>Graves</a></li><?php } ?>
  <?php if ( $currentuser->hasACL(ACL_SCREEN) ) { ?><li><a href='screen.php'>Screen</a></li><?php } ?>
  <?php if ( $currentuser->hasACL(ACL_FILES) ) { ?><li><a href='files.php'>Files</a></li><?php } ?>
  <?php if ( $currentuser->hasACL(ACL_PLAYERS) ) { ?><li><a href='players.php'>Players</a></li><?php } ?>
</ul>
<nav id='navigator'>
  <div class='nav-wrapper'>
    <a href='#!' class='brand-logo'><?php echo SERVERNAME; ?> Server Manager</a>
    <a href='#' data-activates='skinny-menu' class='button-collapse'><i class='material-icons'>menu</i></a>
    <ul class='right hide-on-med-and-down'>
      <li><a class='dropdown-button' href='#!' data-activates='tools-dropdown'>Tools<i class='material-icons right'>arrow_drop_down</i></a></li>
      <li><a href='logout.php'>Log Out</a></li>
    </ul>
    <ul class='side-nav' id='skinny-menu'>
      <?php if ( $currentuser->getACL(ACL_STATUS) ) { ?><li><a href='index.php'>Status</a></li><?php } ?>
      <?php if ( $currentuser->getACL(ACL_CONSOLE) ) { ?><li><a href='console.php'>Console</a></li><?php } ?>
      <?php if ( $currentuser->getACL(ACL_GRAVES) ) { ?><li><a href='graves.php'>Graves</a></li><?php } ?>
      <?php if ( $currentuser->getACL(ACL_SCREEN) ) { ?><li><a href='screen.php'>Screen</a></li><?php } ?>
      <?php if ( $currentuser->getACL(ACL_FILES) ) { ?><li><a href='files.php'>Files</a></li><?php } ?>
      <?php if ( $currentuser->hasACL(ACL_PLAYERS) ) { ?><li><a href='players.php'>Players</a></li><?php } ?>
      <li class='divider'></li>
      <li><a href='logout.php'>Log Out</a></li>
    </ul>
  </div>
</nav>
