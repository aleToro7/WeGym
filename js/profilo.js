$("a").click(function(){
    if(!$(this).hasClass("bottom-selection") && $(this).hasClass("middle-nav")){
        id = this.id.split("-")[1];
        $("#nav a[id]").map(function(){
            idR = this.id.split("-")[1];
            $(this).removeClass("bottom-selection");
            $('#'+idR).removeClass("selected filter-grey");
        });
        $(this).addClass("bottom-selection");
        if(id == "info") {
            $('#'+id).addClass("filter-grey");
        }else {
            $('#'+id).addClass("selected");
        }
    }
});

$("#segui").click(function(){
    esegui=$("#segui").val() == "seguito" ? "smetti di seguire" : "segui";
    $("#segui").toggleClass("segui seguito");
    $("#segui").hasClass("segui") ? $("#segui").html("Segui") : $("#segui").html("Seguito");
    $.ajax({
        type:'POST',
        url:'../segui.php',
        data: 'eseguiFromAjax=' + esegui,
        success: function(data) {

        }
    });
});

$("#logout").click(function(){
    sessionStorage.removeItem("load");
    sessionStorage.removeItem("id");
    sessionStorage.removeItem("class");
});

$("#modificaProfilo").click(function(){
    $("#load").empty();
    $("#load").load('./modifica-profilo.php');
});