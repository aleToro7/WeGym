function eventiProfilo() {
    waitForEl("a.middle-nav", function() {
        $("a.middle-nav").click(function(){
            if(!$(this).hasClass("bottom-selection") ) {
                var id = $(this).children().attr("id");
                $("#nav a[id]").map(function(){
                    var idR = $(this).children().attr("id");
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
            /*$.ajax({
                type:'POST',
                url:'../segui.php',
                data: 'eseguiFromAjax=' + esegui,
                success: function(data) {
    
                }
            });*/
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
    });
}