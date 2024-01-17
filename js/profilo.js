function eventiProfilo() {
    waitForEl("a.middle-nav", function() {
        setInterval(function(){
            loadNewNotifications();
        }, 5000);

        $(document).ready(function () {
            if(sessionStorage.getItem("load-profile-view")!=null) {
                if(sessionStorage.getItem("id-view")!="#lista-post") {
                    $("#lista-post").removeClass("selected");
                    $("#nav-lista-post").removeClass("bottom-selection");
                    if(sessionStorage.getItem("id-view")=="#lista-post-liked"){
                        $.ajax({
                            type:'POST',
                            url:'../cercaPost.php',
                            data: 'ottieniPostLike=' + true,
                            success: function(data) {
                            },
                            error: function() { }
                        });
                    }
                }
                $("#load-profile-view").load(sessionStorage.getItem("load-profile-view"));
                $(sessionStorage.getItem("id-view")).addClass("selected");
                $("#nav-"+sessionStorage.getItem("id-view").slice(1)).addClass("bottom-selection");
                if(sessionStorage.getItem("id-view")=="#lista-notifiche"){
                    eventiNotifiche();
                }else if(sessionStorage.getItem("id-view")=="#lista-post" || sessionStorage.getItem("id-view")=="#lista-post-liked") {
                    if(sessionStorage.getItem("id-view")=="#lista-post"){
                        $.ajax({
                            type:'POST',
                            url:'../cercaPost.php',
                            data: 'ottieniPostProfilo=' + true,
                            success: function(data) {
                            },
                            error: function() { }
                        });
                    }else{
                        $.ajax({
                            type:'POST',
                            url:'../cercaPost.php',
                            data: 'ottieniPostLike=' + true,
                            success: function(data) {
                            },
                            error: function() { }
                        });
                    }
                    eventiListaPost();
                }else {
                    $(sessionStorage.getItem("id-view")).addClass("filter-grey");
                }
            }else {
                $.ajax({
                    type:'POST',
                    url:'../cercaPost.php',
                    data: 'ottieniPostProfilo=' + true,
                    success: function(data) {
                    },
                    error: function() { }
                });
                sessionStorage.setItem("load-profile-view", "./lista-post.php");
                sessionStorage.setItem("id-view", "#lista-post");
                $("#lista-post").addClass("selected");
                $("#nav-lista-post").addClass("bottom-selection");
                $("#lista-post").toggleClass("bi-house-door bi-house-door-fill");
                $("#load-profile-view").load('./lista-post.php', eventiListaPost());
            }
            loadNewNotifications();
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
                        if(id == "lista-post"){
                            $.ajax({
                                type:'POST',
                                url:'../cercaPost.php',
                                data: 'ottieniPostProfilo=' + true,
                                success: function(data) {
                        
                                },
                                error: function() { }
                            });
                        }else{
                            $.ajax({
                                type:'POST',
                                url:'../cercaPost.php',
                                data: 'ottieniPostLike=' + true,
                                success: function(data) {
                        
                                },
                                error: function() { }
                            });
                        }
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
}