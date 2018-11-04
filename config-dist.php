<?php

define('SERVERNAME', 'YourServerNameHere'); // Only Alpha-numerics

define('SESSNAME', SERVERNAME); // Usually the name of the server
define('PAGETITLE', SERVERNAME . ' Manager'); // Browser tab title
define('COOKIENAME', SERVERNAME . 'Login'); // Name for the "remember me" cookie. Must not have anything but alphanumerics

// System Configuration
//
define('REGISTRATIONENABLED', false); // Are registrations enabled. This should normally be false after initial installation.
define('SYSTEMRAM', 10); // How much RAM is in the system running the MC server?
define('SYSTEMCPUS', 4); // How many CPUs/Cores are in the system running the MC server?
define('SERVERRAM', 6);  // How much RAM is allocated to the MC server process?
define('SERVERROOT', "/ssd/mcserver/"); // The full path to the folder containing the MC server. (include trailing slash)
define('WORLDFOLDER', "/ssd/mcserver/world/"); // The full path to the folder containing the "world". (include trailing slash)
define('CONSOLELOG', "/ssd/mcserver/logs/fml-server-latest.log"); // The full path to the "fml-server-latest.log" file.
define('LATESTLOG', "/ssd/mcserver/logs/latest.log"); // The full path to the "latest.log" file.
define('SCREENLOG', "/ssd/mcserver/screenlog.0"); // The Gnu Screen session log file. This must be enabled in the .screenrc!
define('SCREENNAME', "minecraft"); // The name of the Gnu Screen sesion for the MC server. Typically "minecraft".
define('FMTEMPDIR', "/ssd/mcserver/fmupload"); // The full path to the FileManager temp folder. No trailing slash! Writable by web server!

// RCON Configuration
//
define('RCONPORT', 25575);          // The RCON port configured in the server.properties file.
define('RCONPASS', 'RCONPassword'); // The RCON password configured in the server.properties file.

// General Configuration
//
define('MAXBADLOGINS', 3);        // The number of bad logins before the account is locked
define('BADLOGINEXPIRATION', 10); // The number of minutes the account will remain locked after MAXBADLOGINS

// Database Configuration
//
define('DBHOST', 'localhost'); // Host name of the database server
define('DBUSER', 'root');      // Username for the database connection
define('DBPASS', '');          // Password for the database connection
define('DBNAME', 'mcmanage');  // Database name for the application

?>
