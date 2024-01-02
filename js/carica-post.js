$(document).ready(function () {
    if($(location).attr('href').split("/")[$(location).attr('href').split("/").length-1]=="carica-post.php") {
        $("#upload").toggleClass("bi-plus-square bi-plus-square-fill");
        $("#profile").removeClass("bi-person-fill");
        $("#profile").addClass("bi-person");
        $("#home").removeClass("bi-house-door-fill");
        $("#home").addClass("bi-house-door");
    }
});