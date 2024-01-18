let username = "";
let password = "";

$('#showPassword').click(function(){
    if($('#password').attr('type') == 'password') {
        $('#password').attr('type', 'text');
        $('#showPassword').toggleClass("bi-eye-slash bi-eye");
    }else {
        $('#password').attr('type', 'password');
        $('#showPassword').toggleClass("bi-eye bi-eye-slash");
    }
});

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
                $('#login-error').addClass("border-error-container");
            }
        },
        error: function() {}
    });
});