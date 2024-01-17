function eventiCommenti(){
    waitForEl("#invia", function() {
        $("#invia").click(function(){
            let testoCommento = $("#commento").val().trim();
            if(testoCommento!='') {
                $.ajax({
                    type:'POST',
                    url:'../commenti.php',
                    data: {testoCommentoFromAjax: testoCommento, idPostFromAjax: sessionStorage.getItem('idPost')},
                    success: function(data) {
                        if(data!=''){
                            let dati = JSON.parse(data)[0];
                            if(dati["imgProfilo"]=='') dati["imgProfilo"]="../altro/img_avatar.png";
                            $("#load-new-comment").prepend('<div class="row"><div class="col"><img class="profile-img-container-post" id="img-profile-comment" src="'+dati["imgProfilo"]+'"/><span class="usrname" id="usrnameCommento">'+dati["nomeUtente"]+'</span><br><span class="bio" id="testoComento">'+testoCommento+'</span></div></div>');
                            $("#commento").val('');
                        }
                    }
                });
            }
        });
    });
}