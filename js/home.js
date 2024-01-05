function eventiHomePage(){
    waitForEl("input.cerca", function() {
        var valCercato = "";
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
                            var users = JSON.parse(data);
                            var sub_ul = $('<ul/>');
                            $(users).each(function (val) {
                                var sub_li = $('<li id="'+users[val]["nomeUtente"]+'" class="search-result"/>').html(users[val]["nomeUtente"]);
                                sub_ul.append(sub_li);
                            });
                            $(".user-list").append(sub_ul);
                        }
                    },
                    error: function() { }
                });
            }
        });

        $(".user-list").on('click', '.search-result', function() {
            
            $.ajax({
                type:'POST',
                url:'../home.php',
                data: 'idCercatoFromAjax=' + this.id,
                success: function(data) {
                    if(data == "ok"){
                        $("#load").empty();
                        $("#load").load('./profilo.php', eventiProfilo());
                    }
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