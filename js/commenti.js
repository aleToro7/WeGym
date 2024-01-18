function eventiCommenti(){
    waitForEl("#invia", function() {
        $("#invia").click(function(){
            let testoCommento = $("#commento").val().trim();
            if(testoCommento!='') {
                $.ajax({
                    type:'POST',
                    url:'../commenti.php',
                    data: {testoCommentoFromAjax: testoCommento, idPostFromAjax: sessionStorage.getItem('idPost'), ownerPostFromAjax: sessionStorage.getItem('ownerPost')},
                    success: function(data) {
                        if(data!=''){
                            let dati = JSON.parse(data)[0];
                            if(dati["imgProfilo"]== null) dati["imgProfilo"]="../altro/img_avatar.png";
                            $("#load-new-comment").prepend('<div class="comment-container nuovo-commento"><div class="row"><div class="col"><img class="profile-img-container-post" id="img-profile-comment" src="'+dati["imgProfilo"]+'"/><span class="usrname" id="usrnameCommento">'+dati["nomeUtente"]+'</span><br><span class="testo-commento " id="testoComento">'+testoCommento+'</span></div></div></div>');
                            $("#commento").val('');
                        }
                    }
                });
            }
        });

        $("#closeCommenti").click(function(){
            if(sessionStorage.getItem('locationCommento') == 'home') {
                $("#load").empty();
                $("#load").load('./home-page.php', eventiHomePage());
            }else {
                $("#load").empty();
                $("#load").load('./profilo.php', eventiProfilo());
            }
        });
    });
}