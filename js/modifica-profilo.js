/*
$("#modificaImg").click(function(){
    $("#load").empty();
    $("#load").load('./crop-image.php');
});*/
$(document).ready(function () {
    $("#close").click(function(){
        $("#load").empty();
        $("#load").load('./profilo.php');
    });
});