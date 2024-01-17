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
    $.ajax({
        type:'POST',
        url:'../cercaPost.php',
        data: 'ottieniPostMioProfilo=' + true
    });
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
        $.ajax({
            type:'POST',
            url:'../profili.php',
            data: 'unsetFromAjax=' + true
        });
        sessionStorage.removeItem("load-search-profile-view");
        sessionStorage.removeItem("id-search-view");
        $("#load").load('./profilo.php', eventiProfilo());
    }
});

$("#nav-home").click(function(){
    $.ajax({
        type:'POST',
        url:'../cercaPost.php',
        data: 'ottieniPostHome=' + true,
        success: function(data) {
        },
        error: function() { }
    });
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

function loadNewNotifications() {
    $.get("../nuoveNotifiche.php",function(data){
        if(data!=''){
            let novita=false, count=0;
            let notifications = JSON.parse(data);
            $("#loadNotifications").empty();
            notifications.forEach(notification => {
                let id = notification['tipo']+"-"+notification['idUtenteSeguente']+"-"+notification['idNotifica'];
                let img, testo, attr='';
                
                if(notification['imgProfilo']!= null) {
                    img = notification['imgProfilo']
                }else {
                    img = "../altro/img_avatar.png";
                }
                if(notification['tipo'] == 'follow') {
                    testo = notification['idUtenteSeguente'] + " ha iniziato a seguirti";
                }else if(notification['tipo'] == 'like') {
                    testo = notification['idUtenteSeguente'] + " ha messo like a un tuo post";
                }else {
                    testo = notification['idUtenteSeguente'] + " ha commentato a un tuo post";
                }
                if(notification['visto']==0){
                    attr='new';
                    novita=true;
                    count++;
                }
                $("#loadNotifications").append("<div class='notification-container' id='"+id+"'><img class='profile-img-container-post' id='img-profile-notification' src='"+img+"'/> &nbsp&nbsp"+testo+"<span class='"+attr+"'></span></div>");
                $("#"+CSS.escape(id)).click(function(){
                    let idCercato = this.id.split("-")[1];
                    let idNotifica = this.id.split("-")[2];
                    $.ajax({
                        type:'POST',
                        url:'../home.php',
                        data: {idCercatoFromAjax: idCercato, idNotifica: idNotifica},
                        success: function() {
                            $("#home").removeClass("bi-house-door");
                            $("#home").addClass("bi-house-door-fill");
                            $("#profile").toggleClass("bi-person bi-person-fill");
                            sessionStorage.removeItem("load-profile-view");
                            $("#load").empty();
                            $("#load").load('./profilo.php', eventiProfilo());
                        }
                    });
                });
            });
            if(novita==true) {
                $("#novita").addClass("new-general");
                $("#novita").html(count);
            }else { 
                $("#novita").removeClass("new-general");
            }
        }
        
    });
}
