$(document).ready(function(){
    getPlayerData();
});

function getPlayerData() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'ajax/getplayerdata.php', true);
    xhr.responseType = 'blob';

    xhr.onload = function(e) {
        if ( this.status == 200 ) {
            var blob = this.response;
            var reader = new FileReader();
            reader.readAsBinaryString(blob);
        }
    }
}
