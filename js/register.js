$(document).ready(function(){
   $("#btn_register").click(function() { registerUser(); });
});

var anUpperCase = /[A-Z]/;
var aLowerCase = /[a-z]/;
var aNumber = /[0-9]/;
var aSpecial = /[!|@|#|$|%|^|&|*|(|)|-|_]/;

function registerUser() {
   var ign = $('#ign').val();
   var password = $('#password').val();
   var password2 = $('#password2').val();
   if ( ign.length == 0 ) {
      createFailToast("In-Game Name cannot be blank!")
      return false;
   }
   if ( password != password2 ) {
      createFailToast("Passwords do not match!");
      return false;
   }
   if ( (password.search(anUpperCase) == -1) || (password.search(aLowerCase) == -1) || (password.search(aNumber) == -1) || (password.search(aSpecial) == -1) ) {
      createFailToast("Passwords must contain at least one upper,<br /> one lower, one number, and one special!");
      return false;
   }
   if ( password.length < 10 ) {
      createFailToast("Passwords must be at least 10 characters in length!");
      return false;
   }
   $.ajax({
      type: 'POST',
      url: 'ajax/register.php',
      data: {ign: ign, password: password},
      dataType: 'json',
      success: function(data, stat, jqo) {
         if ( data.error == true ) {
            createFailToast(data.toast);
            return;
         }
         $('#ign').val("");
         $('#password').val("");
         $('#password2').val("");
         Materialize.toast(data.toast);
      }
   });
}
