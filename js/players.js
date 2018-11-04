$(document).ready(function(){
    $("#btn_findplayer").click(function() { findPlayer(); });
    $("#btn_sendtospawn").click(function() { sendPlayerToSpawn(); });
    $("#btn_fixblobwand").click(function() { fixWandIndexes(); });
    $("#btn_impersonate").click(function() { impersonatePlayer(); });
    $("#btn_restoreadmin").click(function() { restoreAdminPData(); });
});

function restoreAdminPData() {
    $.ajax({
        type: 'POST',
        url: 'ajax/pl_impersonate.php',
        data: {restore: 1},
        dataType: 'json',
        success: function(data, stat, jqo) {
            if ( data.error == true ) {
                createFailToast(data.toast, data.toasttime);
                return;
            }
            Materialize.toast(data.toast, data.toasttime);
        }
    });
}

function impersonatePlayer() {
    var ign = $("#ign").val();
    var uuid = $("#uuid").val();
    if ( uuid == "" ) {
        createFailToast("You must select a player first!", 4000);
        return;
    }
    $.ajax({
        type: 'POST',
        url: 'ajax/pl_impersonate.php',
        data: {ign: ign, uuid: uuid},
        dataType: 'json',
        success: function(data, stat, jqo) {
            if ( data.error == true ) {
                createFailToast(data.toast, data.toasttime);
                return;
            }
            Materialize.toast(data.toast, data.toasttime);
        }
    });
}

function fixWandIndexes() {
    var ign = $("#ign").val();
    var uuid = $("#uuid").val();
    if ( uuid == "" ) {
        createFailToast("You must select a player first!", 4000);
        return;
    }
    $.ajax({
        type: 'POST',
        url: 'ajax/pl_fixwandindex.php',
        data: {ign: ign, uuid: uuid},
        dataType: 'json',
        success: function(data, stat, jqo) {
            if ( data.error == true ) {
                createFailToast(data.toast, data.toasttime);
                return;
            }
            Materialize.toast(data.toast, data.toasttime);
        }
    });
}

function sendPlayerToSpawn() {
    var ign = $("#ign").val();
    var uuid = $("#uuid").val();
    if ( uuid == "" ) {
        createFailToast("You must select a player first!", 4000);
        return;
    }
    $.ajax({
        type: 'POST',
        url: 'ajax/pl_sendtospawn.php',
        data: {ign: ign, uuid: uuid},
        dataType: 'json',
        success: function(data, stat, jqo) {
            if ( data.error == true ) {
                createFailToast(data.toast, data.toasttime);
                return;
            }
            findPlayer();
            Materialize.toast(data.toast, data.toasttime);
        }
    });
}

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
            $("#ign").val(data.username);
            $("#btn_editplayer").removeClass("disabled");
            $("#firstLogin").html(data.firstLogin);
            $("#lastLogin").html(data.lastLogin);
            $("#lastLogout").html(data.lastLogout);
            $("#home").html(data.home);
            $("#pos").html(data.pos);
            $("#timePlayed").html(data.timePlayed);
        }
    });
}
