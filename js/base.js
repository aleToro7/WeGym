$(document).ready(function () {
    var valCercato = "";
    $("#cerca").keyup(function(){
        $(".user-list").empty();
        valCercato = $("#cerca").val();
        if(valCercato!="") {
            $.ajax({
                type:'POST',
                url:'../home.php',
                data: 'cercaFromAjax=' + valCercato,
                success: function(data) {
                    if(data == "Nessun utente trovato"){
                        $("#risultatoRicerca").html(data);
                    }else {
                        users = JSON.parse(data);
                        var sub_ul = $('<ul/>');
                        $(users).each(function (val) {
                            var sub_li = $('<li/>').html(users[val]["nomeUtente"]);
                            sub_ul.append(sub_li);
                        });
                        $(".user-list").append(sub_ul);
                    }
                },
                error: function() { }
            });
        }
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