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
        <li class='tab col s3'><a id='tab_fml' href='#fml'>FML Log</a></li>
        <li class='tab col s3'><a id='tab_latest' href='#latest'>Latest Log</a></li>
        <li class='tab col s3'><a id='tab_commands' href='#commands'>Server Console</a></li>
        <li class='tab col s3'><a id='tab_crashreports' href='#crashreports'>Crash Reports</a></li>
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
      <div class='input-field col s12 center-align'>
        <a class='waves-effect waves-light btn' id='btn_cofhtps'>CoFH TPS</a>
        <a class='waves-effect waves-light btn' id='btn_forgetps'>Forge TPS</a>
        <a class='waves-effect waves-light btn' id='btn_listplayers'>List Players</a>
        <a class='waves-effect waves-light btn' id='btn_profile'>Profile Entities</a>
      </div>
    </div>
    <div id='commands' class='col s12'>
      <div class='row col s12 console' id='screenlog'></div>
      <div class='row col s12 m4 offset-m4 center-align'>
        <label>
          <input type='checkbox' id='confirmcommand' value='1' />
          <span>Check this box to confirm before each command!</span>
        </label>
      </div>
      <div class='input-field col s12 center-align'>
        <a class='waves-effect waves-light btn red' id='btn_killserver'>Kill Server</a>
        <a class='waves-effect waves-light btn orange' id='btn_stopserver'>Stop Server</a>
        <a class='waves-effect waves-light btn green' id='btn_startserver'>Start Server</a>
        <a class='waves-effect waves-light btn' id='btn_enter'>Press 'Enter'</a>
      </div>
    </div>
    <div id='crashreports' class='col s12'>
      <div class='input-field col s11'>
        <select id='sel_crashreports' class='browser-default'>
          <option value="" disabled selected>Select A Crash Report</option>
        </select>
      </div>
      <div class='col s1'>
        <a class='waves-effect waves-light btn pushdown' id='btn_getcrashreports'>Refresh</a>
      </div>
      <div class='row col s12 console' id='activereport'></div>
    </div>
  </div>
</div>
<?php

includeHTMLFooter('console.js');

?>
