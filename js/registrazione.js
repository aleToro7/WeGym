$(document).ready(function () {
    var username = "";

    $("#continua, #indietro").click(function(){
        $("#form-registrazione input[id], div[id], button[id]").map(function(){
            if($('#'+this.id).hasClass("hide")){
                $('#'+this.id).removeClass("hide");
            }else{
                $('#'+this.id).addClass("hide");
            }
        });
        $("li[id]").map(function(){
            if($('#'+this.id).hasClass("active")){
                $('#'+this.id).removeClass("active");
            }else{
                $('#'+this.id).addClass("active");
            }
        });
    });

    $("#nome").keyup(function() {
        manageBtnContinua();
    });

    $("#cognome").keyup(function() {
        manageBtnContinua();
    });

    $("#username").keyup(function() {
        username = $("#username").val();
        if(username.length > 3){
            $.ajax({
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
        }else if(username.length == 0){
            $("#user-availability-status").html("");
            $("#username").removeClass("border border-3 border-danger");
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

