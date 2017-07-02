$(document).ready(function(){
   var navheight = $('#navigator').height();
   var usable = $(window).height() - navheight;
   $('#filesframe').height(usable - 9);
});
