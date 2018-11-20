<?php

// Constants derived from config file values:
define('SESSNAME', SERVERNAME); // The name of the server works. Alphanumerics only
define('PAGETITLE', SERVERNAME . ' Manager'); // Browser tab title
define('COOKIENAME', SERVERNAME . 'Login'); // Name for the "remember me" cookie. Must not have anything but alphanumerics
define('WORLDFOLDER', SERVERROOT . WORLDFOLDERNAME . "/"); // The full path to the world folder
define('CONSOLELOG', SERVERROOT . "logs/fml-server-latest.log"); // The full path to the "fml-server-latest.log" file.
define('LATESTLOG', SERVERROOT . "logs/latest.log"); // The full path to the "latest.log" file.
define('SCREENLOG', SERVERROOT . "screenlog.0"); // The full path to the Gnu Screen log

define("HTMLSAFE",     1000001);
define("HTMLFORMSAFE", 1000002);
define("ICONMENUSIZE", 1000003);

define("TIMESTAMP",    1000101);
define("PRETTY",       1000102);
define("SHORTDATE",    1000103);

define("BOOLEANDB",    1000201);

define("ACL_STATUS",   1000301);
define("ACL_CONSOLE",  1000302);
define("ACL_GRAVES",   1000303);
define("ACL_SCREEN",   1000304);
define("ACL_FILES",    1000305);
define("ACL_PLAYERS",    1000306);

define("PRETTYSIZE",   1000401);

define("REGISTRATION_EXISTS",       1000501);
define("REGISTRATION_FAILED_EMAIL", 1000502);
define("REGISTRATION_SUCCESS",      1000502);
define("REGISTRATION_MISSING",      1000502);

define("ADMIN", 1000601);

define("LOGININVALID", 1000801);
define("LOGINLOCKED", 1000802);

define("ACCOUNTTYPEPRETTY", 1000901);

define("REFRESH", 1001001);
define("BASICHTML", true);

define("NOLIMIT", 0);
define("NOFLAG", 0);

// Database table names
define("TABLE_USERS", "users");
define("TABLE_COOKIES", "cookies");
define("TABLE_REGISTRATIONS", "registrations");

?>
