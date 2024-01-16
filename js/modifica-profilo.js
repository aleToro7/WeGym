
function eventiModificaProfilo() {
    waitForEl("#getImage", function() {
        
        $("#close").click(function(){
            $("#load").empty();
            $("#load").load('./profilo.php', eventiProfilo());
        });

        $("#close-crop").click(function(){
            bs_modal.modal('hide');
            $("#getImage").val('');
        });

        let bs_modal = $('#modal');
        let image = document.getElementById('image');
        let cropper,reader,file;

        $("#getImage").on("change", function(e) {
            let files = e.target.files;
            let done = function(url) {
                image.src = url;
                bs_modal.modal('show');
            };

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        bs_modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
            bs_modal.modal('hide');
            $("#getImage").val('');
        });

        $("#crop").click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 160,
                height: 160,
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                let reader = new FileReader();
                reader.readAsDataURL(blob);
                
                reader.onloadend = function() {
                    let base64data = reader.result;
                    $.ajax({
                        type: "POST",
                        url: "../modificaProfilo.php",
                        data: {imageFromAjax: base64data},
                        success: function(data) {
                            if(data == "ok") {
                                bs_modal.modal('hide');
                                $("#getImage").val('');
                                $("#img-profile").attr('src', base64data);
                                $(".preview-img-container").attr('src', base64data); 
                            }
                        }
                    });
                }
            });
        });

        $("#newBio").keyup(function(){
            manageBtnSalva();
        });

        let username = $("#newUsername").val();
        let biografia = $("#newBio").val();

        $("#salva").click(function(){
            username = $("#newUsername").val();
            biografia = $("#newBio").val();
            $.ajax({
                type: "POST",
                url: "../modificaProfilo.php",
                data: {usernameFromAjax: username, biografiaFromAjax: biografia},
                success: function(data) {
                    if(data == "ok") {
                        $("#salva").attr('disabled','disabled');
                    }
                }
            });
            
        });

        $("#newUsername").keyup(function() {
            let newUsername = $("#newUsername").val();
            if(newUsername.length > 3 && newUsername != username){
                $.ajax({
                    type:'POST',
                    url:'../registrazione.php',
                    data: 'usernameFromAjax=' + newUsername,
                    success: function(data) {
                        $("#new-user-availability-status").html(data);
                        if(data == "Username available"){
                            $("#newUsername").removeClass("border border-3 border-danger");
                            $("#newUsername").addClass("border border-3 border-success");
                            manageBtnSalva();
                        }else if(data == "Username not available" || $("#username").val() == ""){
                            $("#newUsername").removeClass("border border-3 border-success");
                            $("#newUsername").addClass("border border-3 border-danger");
                        }
                    },
                    error: function() { }
                });
            }else if(newUsername == username){
                $("#new-user-availability-status").html("");
                $("#newUsername").removeClass("border border-3 border-danger");
            }else{
                $("#user-availability-status").html("Il nome utente deve avere un numero di caratteri compreso tra 4 e 25");
                $("#newUsername").removeClass("border border-3 border-success");
                $("#newUsername").addClass("border border-3 border-danger");
            }
            manageBtnSalva();
        });

        function manageBtnSalva() {
            if(($("#newUsername").hasClass("border-success") && $("#newUsername").val() != username) || $("#newBio").val() != biografia) {
                $("#salva").removeAttr("disabled");
            }else {
                $("#salva").attr('disabled','disabled');
            }
        }
    });
    
}