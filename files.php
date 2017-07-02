<?php

require 'header.php';
require_login();

includeHTMLHeader("Files");

require_ACL(ACL_FILES);

?>
<iframe id='filesframe' src='fm/filemanager.php' style='width: 100%; height: 100%;'></iframe>
<?php

includeHTMLFooter('files.js');

?>
