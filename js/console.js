var updateConsoleTimeout = null;

$(document).ready(function(){
   $('ul.tabs').tabs();
   $('#btn_cofhtps').click(function() { runCommand("cofhtps"); });
   $('#btn_forgetps').click(function() { runCommand("forgetps"); });
   $('#btn_profile_e').click(function() { runCommand("profile_e"); });
   $('#btn_listplayers').click(function() { runCommand("listplayers"); });
   $('#btn_killserver').click(function() { runCommand("killserver", true); });
   $('#btn_stopserver').click(function() { runCommand("stopserver", true); });
   $('#btn_startserver').click(function() { runCommand("startserver", true); });
   $('#btn_enter').click(function() { runCommand("enter"); });
   updateConsole();
//   $('#console').height($(window).height() - $('#navigator').height() - $('#consoletabs').height() - 120);
   var newHeight = $(window).height() - $('#navigator').height() - $('#consoletabs').height();
   $('#console').height(newHeight);
   $('#latestlog').height(newHeight);
   $('#screenlog').height(newHeight);
});

function startUpdateConsoleTimer() {
   if ( updateConsoleTimeout != null ) {
      clearTimeout(updateConsoleTimeout);
   }
   updateConsoleTimeout = setTimeout(updateConsole, 10000);
}

function runCommand(command, requireConfirm = false) {
   if ( ($(".active").attr('id') == "tab_commands") && requireConfirm && !$("#confirmcommand").prop("checked") ) {
      createFailToast("You must check the confirm box before using this command!");
      return;
   }
   $("#confirmcommand").prop("checked", false);
   $.ajax({
      type: 'GET',
      url: 'ajax/sendcommand.php',
      data: {command: command},
      dataTYpe: 'json',
      success: function(data, stat, jqo) {
         if ( data.error ) {
            createFailToast(data.message);
         } else {
            createDefaultToast(data.message);
         }
         if ( updateConsoleTimeout != null ) {
            clearTimeout(updateConsoleTimeout);
         }
         updateConsoleTimeout = setTimeout(updateConsole, 500);
      }
   });
}

function updateConsole() {
   if ( updateConsoleTimeout != null ) {
      clearTimeout(updateConsoleTimeout);
   }
   updateConsoleTimeout = null;
   $.ajax({
      type: 'GET',
      url: 'ajax/getconsole.php',
      dataType: 'json',
      success: function(data, stat, jqo) {
         $("#console").html(data.console);
         $("#console").scrollTop($('#console').prop("scrollHeight"));
         $("#latestlog").html(data.latestlog);
         $("#latestlog").scrollTop($('#latestlog').prop("scrollHeight"));
         $("#screenlog").html(data.screenlog);
         $("#screenlog").scrollTop($('#screenlog').prop("scrollHeight"));
         startUpdateConsoleTimer();
      }
   });
}
