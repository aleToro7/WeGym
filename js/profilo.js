$(document).ready(function () {
    $("#nav-posted").click(function(){
        if(!$("#posted").hasClass("selected")) {
            $("#info").removeClass("selected filter-grey");
            $("#posted").addClass("selected");
            $("#nav-info").removeClass("bottom-selection");
            $("#nav-posted").addClass("bottom-selection");
            $("#load-profile-view").empty();
            $("#load-profile-view").load('./lista-post.php');
        }
    });

    $("#nav-info").click(function(){
        if(!$("#info").hasClass("selected")) {
            $("#posted").removeClass("selected");
            $("#info").addClass("selected filter-grey");
            $("#nav-posted").removeClass("bottom-selection");
            $("#nav-info").addClass("bottom-selection");
            $("#load-profile-view").empty();
            $("#load-profile-view").load('./info.php');
        }
    });

    $("#segui").click(function(){
        esegui=$("#segui").val() == "seguito" ? "smetti di seguire" : "segui";
        $("#segui").toggleClass("segui seguito");
        $.ajax({
            type:'POST',
            url:'../segui.php',
            data: 'eseguiFromAjax=' + esegui,
            success: function(data) {

            }
        });
    });
});

