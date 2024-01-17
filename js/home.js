function eventiHomePage(){
    waitForEl("input.cerca", function() {
        let valCercato = "";
        $("#cerca").keyup(function(){
            $(".user-list").empty();
            valCercato = $("#cerca").val();
            $("#risultatoRicerca").html("");
            if(valCercato!="") {
                $.ajax({
                    type:'POST',
                    url:'../home.php',
                    data: 'cercaFromAjax=' + valCercato,
                    success: function(data) {
                        if(data == "Nessun utente trovato"){
                            $("#risultatoRicerca").html(data);
                        }else {
                            let users = JSON.parse(data);
                            let sub_ul = $('<ul/>');
                            $(users).each(function (val) {
                                let sub_li = $('<li id="'+users[val]["nomeUtente"]+'" class="search-result"/>').html(users[val]["nomeUtente"]);
                                sub_ul.append(sub_li);
                            });
                            $(".user-list").append(sub_ul);
                        }
                    },
                    error: function() { }
                });
            }
        });

        $(document).ready(function(){
            $.ajax({
                type:'POST',
                url:'../cercaPost.php',
                data: 'ottieniPostHome=' + true,
                success: function(data) {
                },
                error: function() { }
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
            }
        });

        $("#cerca").focusout(function(){
            if(!$("#cerca").val() != "") {
                $("#lente").toggleClass("hide");
            }
        });
    });
    
}