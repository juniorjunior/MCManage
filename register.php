<?php

require 'header.php';

require_anonymous();



includeHTMLHeaderBasic("Register");

?>
<div class='container'>
  <div class='row center-align'>
    <div class='col s12'><h1 class='blue-text text-darken-4'>Register</h1></div>
  </div>
  <div class='row center-align'>
    <form class='col s12'>
      <div class='row'>
        <div class='input-field col s4 offset-s4'>
          <input id='ign' type='text' class='validate'>
          <label for='ign'>In-Game Name</label>
        </div>
      </div>
      <div class='row' id='pwfield'>
        <div class='input-field col s4 offset-s4'>
          <input placeholder='DO NOT USE YOUR MC PASSWORD' id='password' type='password' class='validate'>
          <label for='password'>Password (not your MC password)</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s4 offset-s4'>
          <input id='password2' type='password' class='validate'>
          <label for='password2'>Confirm Password</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s4 offset-s4'>
          <a class='waves-effect waves-light btn' id='btn_register'><i class='material-icons right'>send</i>register</a>
        </div>
      </div>
    </form>
  </div>
</div>
<?php

includeHTMLFooterBasic('register.js');

?>
