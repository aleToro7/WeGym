$("#continua, #indietro").click(function(){
    $("#form-registrazione input[id], div[id], button[id], i").map(function(){
        $(this).toggleClass("hide");
    });
});

let username = "";
$("#username").keyup(function() {
    let username = $("#username").val();
    if(username.length > 3){
        $.ajax({
            type:'POST',
            url:'../registrazione.php',
            data: 'usernameFromAjax=' + username,
            success: function(data) {
                $("#user-availability-status").html(data);
                if(data == "Username available"){
                    $("#username").removeClass("border border-2 border-danger");
                    $("#username").addClass("border border-2 border-success");
                }else if(data == "Username not available" || $("#username").val() == ""){
                    $("#username").removeClass("border border-2 border-success");
                    $("#username").addClass("border border-2 border-danger");
                }
            },
            error: function() { }
        });
    }else if(username.length == 0){
        $("#user-availability-status").html("");
        $("#username").removeClass("border border-2 border-danger");
    }else{
        $("#user-availability-status").html("Il nome utente deve avere un numero di caratteri compreso tra 4 e 25");
        $("#username").removeClass("border border-2 border-success");
        $("#username").addClass("border border-2 border-danger");
    }
});

$("#mail").focusout(function() {
    let mail = $("#mail").val();
    if(emailIsValid(mail)){
        $.ajax({
            type:'POST',
            url:'../registrazione.php',
            data: 'mailFromAjax=' + mail,
            success: function(data) {
                $("#mail-availability-status").html(data);
                if(data == "Mail available"){
                    $("#mail").removeClass("border border-2 border-danger");
                    $("#mail").addClass("border border-2 border-success");
                }else if(data == "Mail not available" || $("#mail").val() == ""){
                    $("#mail").removeClass("border border-2 border-success");
                    $("#mail").addClass("border border-2 border-danger");
                }
            },
            error: function() { }
        });
    }else{
        $("#mail-availability-status").html("Formato mail non valido");
        $("#mail").removeClass("border border-2 border-success");
        $("#mail").addClass("border border-2 border-danger");
    }
});

$("input").keyup(function(){
    if(!$(this).hasClass("hide")){
        if($("#continua").hasClass("hide")) {
            manageBtnRegistrati();
        }else{
            manageBtnContinua();
        }
    }
});

$("#dataNascita").change(function(){
    manageBtnContinua();
});

$('#showPwd').click(function(){
    if($('#pwd').attr('type') == 'password') {
        $('#pwd').attr('type', 'text');
        $('#showPwd').toggleClass("bi-eye-slash bi-eye");
    }else {
        $('#pwd').attr('type', 'password');
        $('#showPwd').toggleClass("bi-eye bi-eye-slash");
    }
});

$('#showConfermaPwd').click(function(){
    if($('#confermaPwd').attr('type') == 'password') {
        $('#confermaPwd').attr('type', 'text');
        $('#showConfermaPwd').toggleClass("bi-eye-slash bi-eye");
    }else {
        $('#confermaPwd').attr('type', 'password');
        $('#showConfermaPwd').toggleClass("bi-eye bi-eye-slash");
    }
});

$("#backLogin").click(function(){
    
});


function manageBtnContinua() {
    if($("#nome").val() != "" && $("#cognome").val() != "" && $("#dataNascita").val() != ""){
        $("#continua").removeAttr("disabled");
    }else{
        $("#continua").attr('disabled','disabled');
    }
}

function manageBtnRegistrati() {
    if($("#mail").hasClass("border-success") && $("#username").hasClass("border-success") && $("#pwd").val() != "" && $("#confermaPwd").val() != "" && $("#pwd").val() == $("#confermaPwd").val()) {
        $("#registrati").removeAttr("disabled");
    }else{
        $("#registrati").attr('disabled','disabled');
    }
}

function emailIsValid(email) {
    let regex_email_valida = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return regex_email_valida.test(email);
}