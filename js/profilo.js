$(document).ready(function () {
    /*$("#nav-posted").click(function(){
        if(!$("#posted").hasClass("selected")) {
            $("i[id], img[id]").map(function(){
                
                if(this.val() == "info") {
                    $(this).removeClass("selected filter-grey");
                }else {
                    $(this).removeClass("selected");
                }
            });
            $("#posted").addClass("selected");
            $("a[id]").hasClass("bottom-selection", function(){
                $(this).toggleClass("bottom-selection");
            });
        }
    });*/

    $("a").click(function(){
        if(!$(this).hasClass("bottom-selection")){
            id = this.id.split("-")[1];
            $("#nav a[id]").map(function(){
                idR = this.id.split("-")
                $(this).removeClass("bottom-selection");
                $(idR).removeClass("selected filter-grey")
            });
            $(this).addClass("bottom-selection");
            if(id == "info") {
                $(id).toggleClass("filter-dark-grey filter-grey");
            }else {
                $(id).addClass("selected");
            }
        }
    });

    /*
    $("#nav-info").click(function(){
        if(!$("#info").hasClass("selected")) {
            $("#posted").removeClass("selected");
            $("#info").addClass("selected filter-grey");
            $("#nav-posted").removeClass("bottom-selection");
            $("#nav-info").addClass("bottom-selection");
            $("#load-profile-view").empty();
            $("#load-profile-view").load('./info.php');
        }
    });*/

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

