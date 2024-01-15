function eventiProfilo() {
    waitForEl("a.middle-nav", function() {
        setInterval(function(){
            $.get("../notifiche.php",function(data){
                let notifications = JSON.parse(data);
            })
        }, 5000);

        $("a.middle-nav").click(function(){
            if(!$(this).hasClass("bottom-selection") ) {
                let id = $(this).children().attr("id");
                $("#nav a[id]").map(function(){
                    let idR = $(this).children().attr("id");
                    $(this).removeClass("bottom-selection");
                    $('#'+idR).removeClass("selected filter-grey");
                });
                $(this).addClass("bottom-selection");
                if(id == "info") {
                    $('#'+id).addClass("filter-grey");
                }else {
                    $('#'+id).addClass("selected");
                }
                //aggiungere caricamento php in load-profile-view
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