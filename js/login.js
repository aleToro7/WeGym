$(document).ready(function(){

    var username = "";
    var password = "";

    $("#login").click(function(){
        username=$("#username").val();
        password=$("#password").val();

        $.ajax({
            type:'POST',
                url:'../login.php',
                data: {username: username, password: password},
                success: function(data) {
                    if(data == "Errore! Username o password non corretti."){
                        $("#login-error").html(data);
                    }
                },
                error: function() {
                    //da sistemare
                    window.location.reload();
                }
        });
    });


});