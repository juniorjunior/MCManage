var updateStatusTimeout = null;

$(document).ready(function(){
   updateStatus();
});

function startUpdateStatusTimer() {
   if ( updateStatusTimeout != null ) {
      clearTimeout(updateStatusTimeout);
   }
   updateStatusTimeout = setTimeout(updateStatus, 60000);
}

function updateStatus() {
   if ( updateStatusTimeout != null ) {
      clearTimeout(updateStatusTimeout);
   }
   updateStatusTimeout = null;
   $.ajax({
      type: 'GET',
      url: 'ajax/updatestatus.php',
      dataType: 'json',
      success: function(data, stat, jqo) {
         $('#systemuptime').html(data.systemuptime);
         $('#systemload').html(data.systemload);
         $('#networkusage').html(data.networkusage);
         $('#serveruptime').html(data.serveruptime);
         $('#servertps').html(data.servertps);
         $('#dimensiontps').html(data.dimensiontps);
         $('#players').html(data.players);
         startUpdateStatusTimer();
      }
   });
}
