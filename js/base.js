$(document).ready(function () {
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
                        users = JSON.parse(data);
                        var sub_ul = $('<ul/>');
                        $(users).each(function (val) {
                            var sub_li = $('<li id="'+users[val]["nomeUtente"]+'" class="prova"/>').html(users[val]["nomeUtente"]);
                            sub_ul.append(sub_li);
                        });
                        $(".user-list").append(sub_ul);
                    }
                },
                error: function() { }
            });
        }
    });

    $("#nav-upload").click(function(){
        if($("#upload").hasClass("bi-plus-square")) {
            $("#upload").toggleClass("bi-plus-square bi-plus-square-fill");
            $("#profile").removeClass("bi-person-fill");
            $("#profile").addClass("bi-person");
            $("#home").removeClass("bi-house-door-fill");
            $("#home").addClass("bi-house-door");
            $("#load").empty();
            $("#load").load('./carica-post.php');
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
            $("#load").load('./profilo.php');
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
            $("#load").load('./home-page.php');
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