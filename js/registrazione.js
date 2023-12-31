$(document).ready(function () {
    var username = "";

    $("#form").submit(function(){
        $.ajax({
            type:'POST',
            url:''
        })
        

    });

    $("#username").keyup(function() {
        username = $("#username").val();

        jQuery.ajax({
            type:'POST',
            url:'../registrazione.php',
            data: 'username=' + username,
            success: function(data) {
                $("#user-availability-status").html(data);
                if(data == "Username available"){
                    $("#continua").removeAttr("disabled");
                }else if(data == "Username not available" || $("#username").val() == ""){
                    $("#continua").attr("disabled","disabled");
                }
            },
            error: function() { }
        });

        /*$.post("check.php", { user: $("#nomeUtente").val() }, function (data) {
            if (data == '1') {
                //do 1
            }
            else if(data == '0') {
                //do 0
            }
        });*/

    });

});

