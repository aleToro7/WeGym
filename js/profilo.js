$(document).ready(function () {
    $("#nav-posted").click(function(){
        if(!$("#posted").hasClass("selected")) {
            $("#info").removeClass("selected filter-grey");
            $("#posted").addClass("selected");
            $("#load-profile-view").empty();
            $("#load-profile-view").load('./lista-post.php');
        }
    });

    $("#nav-info").click(function(){
        if(!$("#info").hasClass("selected")) {
            $("#posted").removeClass("selected");
            $("#info").addClass("selected filter-grey");
            $("#load-profile-view").empty();
            $("#load-profile-view").load('./info.php');
        }
    });
});

