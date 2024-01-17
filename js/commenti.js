function eventiCommenti(){
    waitForEl("#load-commenti", function() {
        $("#invia").click(function(){
            let testoCommento = $("#commento").val().trim();
            if(testoCommento!='') {
                $.ajax({
                    type:'POST',
                    url:'../commenti.php',
                    data: {testoCommentoFromAjax: testoCommento, idPostFromAjax: sessionStorage.getItem('idPost')},
                    success: function(data) {
                        if(data==''){
                            $("#commento").val('');
                        }
                    }
                });
            }
        });
    });
}