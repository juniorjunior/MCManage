$(document).ready(function(){
   $("#btn_login").click(function() { validateLogin(); });
});

function validateLogin() {
   var ign = $('#ign').val();
   var password = $('#password').val();
   var remember = ($('#remember').prop('checked')) ? 1 : 0;
   $.ajax({
      type: 'POST',
      url: 'ajax/validatelogin.php',
      data: {ign: ign, password: password, remember: remember},
      dataType: 'json',
      success: function(data, stat, jqo) {
         if ( data.error == true ) {
            createFailToast(data.toast, data.toasttime);
            return;
         }
         window.location.href = "index.php";
      }
   });
}
