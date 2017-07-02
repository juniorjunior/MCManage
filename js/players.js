$(document).ready(function(){
    $("#btn_findplayer").click(function() { findPlayer(); });
});

function findPlayer() {
    var ign = $("#ign").val();
    Materialize.toast("Searching for player data...", 2000);
    $.ajax({
        type: 'POST',
        url: 'ajax/findplayer.php',
        data: {ign: ign},
        dataType: 'json',
        success: function(data, stat, jqo) {
            if ( data.error == true ) {
                $("#uuid").val("");
                $("#btn_editplayer").addClass("disabled");
                createFailToast(data.toast, data.toasttime);
                return;
            }
            $("#uuid").val(data.uuid);
            $("#btn_editplayer").removeClass("disabled");
        }
    });
}
