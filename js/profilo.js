$(document).ready(function () {
    if($(location).attr('href').split("/")[$(location).attr('href').split("/").length-1]=="profilo.php") {
        $("#profile").toggleClass("bi-person bi-person-fill");
        $("#upload").removeClass("bi-plus-square-fill");
        $("#upload").addClass("bi-plus-square");
        $("#home").removeClass("bi-house-door-fill");
        $("#home").addClass("bi-house-door");
    }
});

