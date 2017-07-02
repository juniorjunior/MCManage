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
<nav>
  <div class='nav-wrapper'>
    <a href='#!' class='brand-logo'><?php echo SERVERNAME; ?> Server Manager"</a>
    <a href='#' data-activates='skinny-menu' class='button-collapse'><i class='material-icons'>menu</i></a>
    <ul class='right hide-on-med-and-down'>
      <li <?php checkActive('login.php'); ?>><a href='login.php'>Login</a></li>
      <li <?php checkActive('register.php'); ?>><a href='register.php'>Register</a></li>
    </ul>
    <ul class='side-nav' id='skinny-menu'>
      <li <?php checkActive('login.php'); ?>><a href='login.php'>Login</a></li>
      <li <?php checkActive('register.php'); ?>><a href='register.php'>Register</a></li>
    </ul>
  </div>
</nav>
