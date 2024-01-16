function eventiProfilo() {
    waitForEl("a.middle-nav", function() {
        setInterval(function(){
            waitNewNotifications();
            $.get("../notifiche.php",function(data){
                let notifications = JSON.parse(data);
                $("#loadNotifications").empty();
                notifications.forEach(notification => {
                    let id = notification['tipo']+"-"+notification['idUtenteSeguente']+"-"+notification['idNotifica'];
                    let img, testo;
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
                    
                    $("#loadNotifications").append("<div class='notification-container' id='"+id+"'><img class='profile-img-container-post' id='img-profile-notification' src='"+img+"'/>"+testo+"<span class='new'></span></div>");
                });
            });
        }, 5000);
        $(document).ready(function () {
            if(sessionStorage.getItem("load-profile-view")!=null) {
                if(sessionStorage.getItem("id-view")!="#lista-post") {
                    $("#lista-post").removeClass("selected");
                    $("#nav-lista-post").removeClass("bottom-selection");
                }
                $("#load-profile-view").load(sessionStorage.getItem("load-profile-view"));
                $(sessionStorage.getItem("id-view")).addClass("selected");
                $("#nav-"+sessionStorage.getItem("id-view").slice(1)).addClass("bottom-selection");
                if(sessionStorage.getItem("id-view")=="#lista-notifiche"){
                    eventiNotifiche();
                }else if(sessionStorage.getItem("id-view")=="#lista-post" || sessionStorage.getItem("id-view")=="#lista-post-liked") {
                    eventiListaPost();
                }else {
                    $(sessionStorage.getItem("id-view")).addClass("filter-grey");
                }
            }else {
                sessionStorage.setItem("load-profile-view", "./lista-post.php");
                sessionStorage.setItem("id-view", "#lista-post");
                $("#lista-post").addClass("selected");
                $("#nav-lista-post").addClass("bottom-selection");
                $("#lista-post").toggleClass("bi-house-door bi-house-door-fill");
                $("#load-profile-view").load('./lista-post.php', eventiListaPost());
            }
        });

        $("a.middle-nav").click(function(){
            if(!$(this).hasClass("bottom-selection") ) {
                let id = $(this).children().attr("id");
                $("#nav a[id]").map(function(){
                    let idR = $(this).children().attr("id");
                    $(this).removeClass("bottom-selection");
                    $('#'+idR).removeClass("selected filter-grey");
                });
                $(this).addClass("bottom-selection");
                $("#load-profile-view").empty();
                if(id == "my-info") {
                    $('#'+id).addClass("filter-grey");
                    sessionStorage.setItem("load-profile-view", "./"+id+".php");
                    sessionStorage.setItem("id-view", "#"+id);
                    $("#load-profile-view").load('./'+id+'.php');
                }else {
                    $('#'+id).addClass("selected");
                    if(id == "lista-notifiche"){
                        sessionStorage.setItem("load-profile-view", "./"+id+".php");
                        sessionStorage.setItem("id-view", "#"+id);
                        $("#load-profile-view").load('./'+id+'.php', eventiNotifiche());
                    }else if(id == "lista-post" || id == "lista-post-liked") {
                        sessionStorage.setItem("load-profile-view", "./lista-post.php");
                        sessionStorage.setItem("id-view", "#"+id);
                        $("#load-profile-view").load('./lista-post.php', eventiListaPost());
                    }
                }
            }
        });
    
        $("#segui").click(function(){
            let esegui=$("#segui").text() == "Seguito" ? "smetti di seguire" : "segui";
            $("#segui").toggleClass("Segui Seguito");
            let utenteSeguito = $("#username").text().substr(3);
            $("#segui").hasClass("Segui") ? $("#segui").html("Segui") : $("#segui").html("Seguito");
            $.ajax({
                type:'POST',
                url:'../segui.php',
                data: {eseguiFromAjax: esegui, seguitoFromAjax: utenteSeguito},
                success: function(data) {
                    if(data!='') {
                        $("#follower").html(data);
                    }
                }
            });
        });
    
        $("#logout").click(function(){
            sessionStorage.removeItem("load");
            sessionStorage.removeItem("id");
            sessionStorage.removeItem("class");
        });
    
        $("#modificaProfilo").click(function(){
            $("#load").empty();
            $("#load").load('./modifica-profilo.php', eventiModificaProfilo());
        });

        $("#close").click(function(){
            $("#load").empty();
            $("#load").load('./home-page.php', eventiHomePage());
        });
    });

    function waitNewNotifications() {
        waitForEl(".notification-container", function() {
            $(".notification-container").click(function(){
                let idCercato = this.id.split("-")[1];
                let idNotifica = this.id.split("-")[2]
                $.ajax({
                    type:'POST',
                    url:'../home.php',
                    data: {idCercatoFromAjax: idCercato, idNotifica: idNotifica},
                    success: function() {
                        $("#home").removeClass("bi-house-door");
                        $("#home").addClass("bi-house-door-fill");
                        $("#profile").toggleClass("bi-person bi-person-fill");
                        $("#load").empty();
                        $("#load").load('./profilo.php', eventiProfilo());
                    }
                });
            });
        });
    }
}