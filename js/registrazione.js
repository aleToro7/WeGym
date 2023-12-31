$(document).ready(function () {
    var username = "";

    /*$("#form").submit(function(){
        $.ajax({
            type:'POST',
            url:''
        })
        

    });*/

    $("#nome").keyup(function() {
        manageBtnContinua();
    });

    $("#cognome").keyup(function() {
        manageBtnContinua();
    });

    $("#username").keyup(function() {
        username = $("#username").val();
        if(username.length > 3){
            jQuery.ajax({
                type:'POST',
                url:'../registrazione.php',
                data: 'username=' + username,
                success: function(data) {
                    $("#user-availability-status").html(data);
                    if(data == "Username available"){
                        $("#username").removeClass("border border-3 border-danger");
                        $("#username").addClass("border border-3 border-success");
                    }else if(data == "Username not available" || $("#username").val() == ""){
                        $("#username").removeClass("border border-3 border-success");
                        $("#username").addClass("border border-3 border-danger");
                    }
                    manageBtnContinua();
                },
                error: function() { }
            });
        }else{
            $("#user-availability-status").html("Il nome utente deve avere un numero di caratteri compreso tra 4 e 25");
            $("#username").removeClass("border border-3 border-success");
            $("#username").addClass("border border-3 border-danger");
        }
        
    });

    function manageBtnContinua(){
        if($("#username").hasClass("border-success") && $("#nome").val() != "" && $("#cognome").val() != ""){
            $("#continua").removeAttr("disabled");
        }else{
            $("#continua").attr('disabled','disabled');
        }
    }

});

