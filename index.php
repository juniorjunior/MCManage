<?php

require 'header.php';

require_login();

includeHTMLHeader("CC Server Manager");

require_ACL(ACL_STATUS);

?>
<div class='container blue-text text-darken-4'>
   <div class='row'>
     <div class='col s5 right-align'>System Uptime:</div>
     <div class='col s7 left-align' id='systemuptime'></div>
   </div>
   <div class='row'>
     <div class='col s5 right-align'>System Load:</div>
     <div class='col s7 left-align' id='systemload'></div>
   </div>
   <div class='row'>
     <div class='col s5 right-align'>Network Usage:</div>
     <div class='col s7 left-align' id='networkusage'></div>
   </div>
   <div class='row'>
     <div class='col s5 right-align'>Server Uptime:</div>
     <div class='col s7 left-align' id='serveruptime'></div>
   </div>
   <div class='row'>
     <div class='col s5 right-align'>Server TPS:</div>
     <div class='col s7 left-align' id='servertps'></div>
   </div>
   <div class='row'>
     <div class='col s5 right-align'>Dimension TPS:</div>
     <div class='col s7 left-align' id='dimensiontps'></div>
   </div>
   <div class='row'>
     <div class='col s5 right-align'>Players:</div>
     <div class='col s7 left-align' id='players'></div>
   </div>
</div>

<?php

includeHTMLFooter('status.js');

?>
