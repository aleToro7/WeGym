function eventiHomePage(){
    waitForEl("input.cerca", function() {
        let valCercato = "";
        $("#cerca").keyup(function(){
            $(".user-list").empty();
            valCercato = $("#cerca").val();
            $("#risultatoRicerca").html("");
            $("#cerca").removeClass("focus-cerca");
            if(valCercato!="") {
                $.ajax({
                    type:'POST',
                    url:'../home.php',
                    data: 'cercaFromAjax=' + valCercato,
                    success: function(data) {
                        if(data == "Nessun utente trovato"){
                            $("#risultatoRicerca").html(data);
                            $("#cerca").removeClass("focus-cerca");
                        }else {
                            let users = JSON.parse(data);
                            let sub_ul = $('<ul class="less-points"/>');
                            let lastClass;
                            $("#cerca").addClass("focus-cerca");
                            $(users).each(function (val) {
                                if (val == $(users).length - 1){ 
                                    lastClass = "last-element";
                                }
                                if(users[val]["imgProfilo"]==null){
                                    users[val]["imgProfilo"] = "../altro/img_avatar.png";
                                }
                                let sub_li = $('<li id="'+users[val]["nomeUtente"]+'" class="search-result '+lastClass+'"><img class="profile-img-container-search" src="'+users[val]["imgProfilo"]+'"/> '+users[val]["nomeUtente"]+'</li>');
                                sub_ul.append(sub_li);
                            });
                            $(".user-list").append(sub_ul);
                        }
                    }
                });
            }
        });

        $(document).ready(function(){
            $.ajax({
                type:'POST',
                url:'../cercaPost.php',
                data: 'ottieniPostHome=' + true,
            });
        });

        $(".user-list").on('click', '.search-result', function() {
            let idCercato = this.id;
            $.ajax({
                type:'POST',
                url:'../home.php',
                data: 'idCercatoFromAjax=' + idCercato,
                success: function(data) {
                    if(data == idCercato){
                        $("#home").removeClass("bi-house-door-fill");
                        $("#home").addClass("bi-house-door");
                        $("#profile").toggleClass("bi-person bi-person-fill");
                        sessionStorage.setItem("load", "./profilo.php");
                        sessionStorage.setItem("id", "#profile");
                        sessionStorage.setItem("class", "bi-person bi-person-fill");
                    }
                    $("#load").empty();
                    $("#load").load('./profilo.php', eventiProfilo());
                },
                error: function() { }
            });
        });

        $("#cerca").focus(function(){
            if(!$("#cerca").val() != "") {
                $("#lente").toggleClass("hide");
                $("#cerca").removeClass("focus-cerca");
            }
        });

        $("#cerca").focusout(function(){
            if(!$("#cerca").val() != "") {
                $("#lente").toggleClass("hide");
                $("#cerca").removeClass("focus-cerca");
            }
        });
    });
}