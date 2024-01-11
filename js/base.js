$(document).ready(function () {
    if(sessionStorage.getItem("load")!=null) {
        $("#load").load(sessionStorage.getItem("load"));
        $(sessionStorage.getItem("id")).toggleClass(sessionStorage.getItem("class"));
        if(sessionStorage.getItem("id")=="#upload"){
            eventiCaricaPost();
        }else if(sessionStorage.getItem("id")=="#profile") {
            eventiProfilo();
        }else {
            eventiHomePage();
        }
    }else {
        sessionStorage.setItem("load", "./home-page.php");
        sessionStorage.setItem("id", "#home");
        sessionStorage.setItem("class", "bi-house-door bi-house-door-fill");
        $("#home").toggleClass("bi-house-door bi-house-door-fill");
        $("#load").load('./home-page.php', eventiHomePage());
    }
});

let waitForEl = function(selector, callback) {
    if (jQuery(selector).length) {
      callback();
    } else {
      setTimeout(function() {
        waitForEl(selector, callback);
      }, 100);
    }
};

$("#nav-upload").click(function(){
    if($("#upload").hasClass("bi-plus-square")) {
        $("#upload").toggleClass("bi-plus-square bi-plus-square-fill");
        $("#profile").removeClass("bi-person-fill");
        $("#profile").addClass("bi-person");
        $("#home").removeClass("bi-house-door-fill");
        $("#home").addClass("bi-house-door");
        $("#load").empty();
        sessionStorage.setItem("load", "./carica-post.php");
        sessionStorage.setItem("id", "#upload");
        sessionStorage.setItem("class", "bi-plus-square bi-plus-square-fill");
        $("#load").load('./carica-post.php', eventiCaricaPost());
    }
});

$("#nav-profile").click(function(){
    if($("#profile").hasClass("bi-person")) {
        $("#profile").toggleClass("bi-person bi-person-fill");
        $("#upload").removeClass("bi-plus-square-fill");
        $("#upload").addClass("bi-plus-square");
        $("#home").removeClass("bi-house-door-fill");
        $("#home").addClass("bi-house-door");
        $("#load").empty();
        sessionStorage.setItem("load", "./profilo.php");
        sessionStorage.setItem("id", "#profile");
        sessionStorage.setItem("class", "bi-person bi-person-fill");
        $("#load").load('./profilo.php', eventiProfilo());
    }
});

$("#nav-home").click(function(){
    if($("#home").hasClass("bi-house-door")) {
        $("#home").toggleClass("bi-house-door bi-house-door-fill");
        $("#upload").removeClass("bi-plus-square-fill");
        $("#upload").addClass("bi-plus-square");
        $("#profile").removeClass("bi-person-fill");
        $("#profile").addClass("bi-person");
        $("#load").empty();
        sessionStorage.setItem("load", "./home-page.php");
        sessionStorage.setItem("id", "#home");
        sessionStorage.setItem("class", "bi-house-door bi-house-door-fill");
        $("#load").load('./home-page.php', eventiHomePage());
    }
});
