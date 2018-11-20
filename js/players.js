$(document).ready(function(){
    $("#btn_findplayer").click(function() { findPlayer(); });
    $("#btn_sendtospawn").click(function() { sendPlayerToSpawn(); });
    $("#btn_fixblobwand").click(function() { fixWandIndexes(); });
    $("#btn_impersonate").click(function() { impersonatePlayer(); });
    $("#btn_restoreadmin").click(function() { restoreAdminPData(); });
    $("#btn_copyuuid").click(function() { copyUUID(); });
    $("#btn_pdatarestore").click(function() { restorePData(); });
    $("#sel_pdataversions").change(function() { changePDataSelect(); });
});

function changePDataSelect() {
    $("#btn_pdatarestore").removeClass("red");
}

function restorePData() {
    if ( ($("#sel_pdataversions").val() == "") || ($("#sel_pdataversions").val() == null) ) return;
    if ( !$("#btn_pdatarestore").hasClass("red") ) {
        $("#btn_pdatarestore").addClass("red");
        return;
    }
    $("#btn_pdatarestore").removeClass("red");
    $.ajax({
        type: 'POST',
        url: 'ajax/pdatarestore.php',
        data: {ign: $("#ign").val(), uuid: $("#uuid").val(), file: $("#sel_pdataversions").val()},
        dataType: 'json',
        success: function(data, stat, jqo) {
            if ( data.error == true ) {
                createFailToast(data.toast, data.toasttime);
                return;
            }
            createDefaultToast(data.toast, data.toasttime);
        }
    });
}

function copyUUID() {
    if ( $("#uuid").val() == "" ) return;
    $("#uuid").select();
    document.execCommand("copy");
    $("#uuid").blur();
    createDefaultToast("UUID copied to clipboard!");
    return;
}

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
            createDefaultToast(data.toast, data.toasttime);
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
            createDefaultToast(data.toast, data.toasttime);
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
            createDefaultToast(data.toast, data.toasttime);
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
            createDefaultToast(data.toast, data.toasttime);
        }
    });
}

function findPlayer() {
    var ign = $("#ign").val();
    createDefaultToast("Searching for player data...", 2000);
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
            $("#sel_pdataversions").find('option').not(':first').remove();
            $("#sel_pdataversions").val('');
            $("#btn_pdatarestore").removeClass("red");
            $.each(data.pdata, function(index, value) {
                $("#sel_pdataversions").append(new Option(value.mtime_pretty, value.file));
            });
        }
    });
}
