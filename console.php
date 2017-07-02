<?php

require 'header.php';
require_login();

includeHTMLHeader();

require_ACL(ACL_CONSOLE);

?>
<div class='container'>
  <div class='row' id='consoletabs'>
    <div class='col s12'>
      <ul class='tabs'>
        <li class='tab col s4'><a href='#fml'>FML Log</a></li>
        <li class='tab col s4'><a href='#latest'>Latest Log</a></li>
        <li class='tab col s4'><a href='#commands'>Commands</a></li>
      </ul>
    </div>
    <div id='fml' class='col s12'>
      <div class='row col s12 console' id='console'></div>
      <div class='row'>
        <div class='input-field col s10 left-align'>
          <input type='text' id='filter'>
          <label for='filter'>Console Filter</label>
        </div>
        <div class='col s2'>
          <a class='waves-effect waves-light btn' id='btn_filter'>filter</a>
        </div>
      </div>
    </div>
    <div id='latest' class='col s12'>
      <div class='row col s12 console' id='latestlog'></div>
    </div>
    <div id='commands' class='col s12'>Commands</div>
  </div>
</div>
<?php

includeHTMLFooter('console.js');

?>
