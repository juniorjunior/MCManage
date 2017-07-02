<?php

require 'header.php';
require_login();

includeHTMLHeader("Players");

require_ACL(ACL_PLAYERS);

?>
<div class='container'>
  <div class='row center-align'>
    <form class='col s12'>
      <div class='row'>
        <div class='input-field col s2 offset-s1'>
          <input id='ign' type='text'>
          <label for='ign'>In-Game Name</label>
        </div>
        <div class='input-field col s2 left-align'>
          <a class='waves-effect waves-light btn' id='btn_findplayer'>Search</a>
        </div>
        <div class='input-field col s4 left-align'>
          <input placeholder='Enter an IGN' id='uuid' type='text' readonly>
          <label for='ign'>UUID:</label>
        </div>
        <div class='input-field col s3 left-align'>
          <a class='waves-effect waves-light btn disabled' id='btn_editplayer'><i class='material-icons right'>send</i>Edit Player</a>
        </div>
        </div>
      </div>
    </form>
  </div>
  <div class='row center-align'>
    Player NBT editor frame goes here
  </div>
</div>
<?php

includeHTMLFooter("players.js");

?>
