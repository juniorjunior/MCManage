var updateConsoleTimeout = null;

$(document).ready(function(){
   $('ul.tabs').tabs();
   $('#btn_run').click(function() { runCommand(); });
   updateConsole();
//   $('#console').height($(window).height() - $('#navigator').height() - $('#consoletabs').height() - 120);
   var newHeight = $(window).height() - $('#navigator').height() - $('#consoletabs').height();
   $('#console').height(newHeight);
   $('#latestlog').height(newHeight);
});

function startUpdateConsoleTimer() {
   if ( updateConsoleTimeout != null ) {
      clearTimeout(updateConsoleTimeout);
   }
   updateConsoleTimeout = setTimeout(updateConsole, 10000);
}

function runCommand() {
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
         startUpdateConsoleTimer();
      }
   });
}
