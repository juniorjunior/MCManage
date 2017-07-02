<?php

require 'header.php';

require_anonymous();



includeHTMLHeaderBasic("Login");

?>
<div class='container'>
  <div class='row center-align'>
    <div class='col s12'><h1 class='blue-text text-darken-4'>Login</h1></div>
  </div>
  <div class='row center-align'>
    <form class='col s12'>
      <div class='row'>
        <div class='input-field col s4 offset-s4'>
          <input id='ign' type='text'>
          <label for='ign'>In-Game Name</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s4 offset-s4'>
          <input placeholder='DO NOT USE YOUR MC PASSWORD!!' id='password' type='password'>
          <label for='password'>Password (not your MC password)</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s4 offset-s4'>
          <input id='remember' type='checkbox'>
          <label for='remember'>Remember Me</label>
        </div>
      </div>
      <div class='row'>
        <div class='input-field col s4 offset-s4'>
          <a class='waves-effect waves-light btn' id='btn_login'><i class='material-icons right'>send</i>login</a>
        </div>
      </div>
    </form>
  </div>
</div>
<?php

includeHTMLFooterBasic('login.js');

?>
