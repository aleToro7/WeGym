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
                    if(data == "ok"){
                        window.location.replace("./base.php");
                    }else {
                        $("#login-error").html(data);
                    }
                },
                error: function() {}
        });
    });


});