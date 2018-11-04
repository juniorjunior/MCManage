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
        <div class='input-field col s3 offset-s1'>
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
        <!-- <div class='input-field col s3 left-align'>
          <a class='waves-effect waves-light btn disabled' id='btn_editplayer'><i class='material-icons right'>send</i>Edit Player</a>
        </div> -->
      </div>
    </form>
  </div>
    <div class='row tight'>
      <div class='col s6 right-align'>First Login:</div>
      <div class='col s6 left-align' id='firstLogin'></div>
    </div>
    <div class='row tight'>
      <div class='col s6 right-align'>Last Login:</div>
      <div class='col s6 left-align' id='lastLogin'></div>
    </div>
    <div class='row tight'>
      <div class='col s6 right-align'>Last Logout:</div>
      <div class='col s6 left-align' id='lastLogout'></div>
    </div>
    <div class='row tight'>
      <div class='col s6 right-align'>Home Location:</div>
      <div class='col s6 left-align' id='home'></div>
    </div>
    <div class='row tight'>
      <div class='col s6 right-align'>Current Location:</div>
      <div class='col s6 left-align' id='pos'></div>
    </div>
    <div class='row'>
      <div class='col s6 right-align'>Time Played:</div>
      <div class='col s6 left-align' id='timePlayed'></div>
    </div>
  <div class='row center-align'>
    <a class='waves-effect waves-light btn' id='btn_sendtospawn'>Send Player To Spawn</a>
    <a class='waves-effect waves-light btn' id='btn_fixblobwand'>Fix Bad Wand Index</a>
    <a class='waves-effect waves-light btn' id='btn_impersonate'>Impersonate This Player</a>
  </div>
  <div class='row center-align'>
    <a class='waves-effect waves-light btn red' id='btn_restoreadmin'>Restore Your PData</a>
  </div>
</div>
<?php

includeHTMLFooter("players.js");

?>
