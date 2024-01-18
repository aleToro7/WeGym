
function eventiModificaProfilo() {
    waitForEl("#getImage", function() {

        $("#cambiaPassword").click(function(){
            $('[id*="newPassword"]').toggleClass("hide");
            $('[id*="oldPassword"]').toggleClass("hide");
            if($('#newPassword').hasClass("hide")) {
                $("#cambiaPassword").html('Cambia password');
            }else {
                $("#cambiaPassword").html('Annulla');
            }
        });

        $("#newPasswordUpdateBtn").click(function(){
            let oldPsw = $("#oldPassword").val();
            let newPsw = $("#newPassword").val()
            $.ajax({
                type:'POST',
                url:'../modificaProfilo.php',
                data: {aggiornaOldPswFromAjax: oldPsw, newPasswordFromAjax: newPsw},
                success: function(data){
                    if(data == 'ok') {
                        $("#newPasswordStatus").html('Password aggiornata con successo');
                    }else {
                        $("#newPasswordStatus").html('Password errata');
                    }
                }
            });
        });

        $("#oldPassword").keyup(function(){
            manageBtnAggiornaPsw();
        });
        
        $("#newPassword").keyup(function(){
            if(passwordIsValid($("#newPassword").val())) {
                $("#newPassword").removeClass("border border-2 border-danger");
                $("#newPassword").addClass("border border-2 border-success");
                $("#newPasswordStatus").removeClass("border-error-container");
                $("#newPasswordStatus").html('');
                
            }else {
                $("#newPassword").removeClass("border border-2 border-success");
                $("#newPassword").addClass("border border-2 border-danger");
                $("#newPasswordStatus").addClass("border-error-container");
                $("#newPasswordStatus").html('La password deve contenere almeno 8 caratteri di almeno: una lettera minuscola, una lettera maiuscola, un numero e un carattere speciale (@$!%*?&) &nbsp&nbsp');
            }
            manageBtnAggiornaPsw();
        });

        $('#oldPasswordEye').click(function(){
            if($('#oldPassword').attr('type') == 'password') {
                $('#oldPassword').attr('type', 'text');
                $('#oldPasswordEye').toggleClass("bi-eye-slash bi-eye");
            }else {
                $('#oldPassword').attr('type', 'password');
                $('#oldPasswordEye').toggleClass("bi-eye bi-eye-slash");
            }
        });

        $('#newPasswordEye').click(function(){
            if($('#newPassword').attr('type') == 'password') {
                $('#newPassword').attr('type', 'text');
                $('#newPasswordEye').toggleClass("bi-eye-slash bi-eye");
            }else {
                $('#newPassword').attr('type', 'password');
                $('#newPasswordEye').toggleClass("bi-eye bi-eye-slash");
            }
        });
        
        $("#close").click(function(){
            $('[id*="newPassword"]').addClass("hide");
            $('[id*="oldPassword"]').addClass("hide");
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
        let frequenza = $("#frequenzaAllenamenti").val();
        let obbiettivo = $("#obbiettivo").val();
        let esercizioPreferito = $("#esercizioPreferito").val();
        let muscoloPreferito = $("#muscoloPreferito").val();
        let alimentoPreferito = $("#alimentoPreferito").val();

        $("#salva").click(function(){
            username = $("#newUsername").val();
            biografia = $("#newBio").val();
            frequenza = $("#frequenzaAllenamenti").val();
            obbiettivo = $("#obbiettivo").val();
            esercizioPreferito = $("#esercizioPreferito").val();
            muscoloPreferito = $("#muscoloPreferito").val();
            alimentoPreferito = $("#alimentoPreferito").val();
            $.ajax({
                type: "POST",
                url: "../modificaProfilo.php",
                data: {usernameFromAjax: username, biografiaFromAjax: biografia, frequenzaFromAjax: frequenza, obbiettivoFromAjax: obbiettivo, esercizioPreferitoFromAjax: esercizioPreferito, muscoloPreferitoFromAjax: muscoloPreferito, alimentoPreferitoFromAjax: alimentoPreferito},
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
                            $("#newUsername").removeClass("border border-2 border-danger");
                            $("#newUsername").addClass("border border-2 border-success");
                            manageBtnSalva();
                        }else if(data == "Username not available" || $("#username").val() == ""){
                            $("#newUsername").removeClass("border border-2 border-success");
                            $("#newUsername").addClass("border border-2 border-danger");
                        }
                    },
                    error: function() { }
                });
            }else if(newUsername == username){
                $("#new-user-availability-status").html("");
                $("#newUsername").removeClass("border border-2 border-danger");
            }else{
                $("#user-availability-status").html("Il nome utente deve avere un numero di caratteri compreso tra 4 e 25");
                $("#newUsername").removeClass("border border-2 border-success");
                $("#newUsername").addClass("border border-2 border-danger");
            }
            manageBtnSalva();
        });

        $("#frequenzaAllenamenti").change(function(){
            manageBtnSalva();
        });

        $('input').each(function(){
            $(this).keyup(function(){
                manageBtnSalva();
            });
        })

        function manageBtnSalva() {
            if((!$("#newUsername").hasClass("border-danger") && $("#newUsername").val() != username) || (!$("#newUsername").hasClass("border-danger") && $("#newBio").val() != biografia) || ($("#frequenzaAllenamenti").val()!=frequenza) || ($("#obbiettivo").val()!=obbiettivo) || ($("#esercizioPreferito").val()!=esercizioPreferito) || ($("#muscoloPreferito").val()!=muscoloPreferito) || ($("#alimentoPreferito").val()!=alimentoPreferito)) {
                $("#salva").removeAttr("disabled");
            }else {
                $("#salva").attr('disabled','disabled');
            }
        }

        function manageBtnAggiornaPsw() {
            if($("#oldPassword").val()!='' && $("#newPassword").hasClass("border-success") && $("#newPassword").val()!=$("#oldPassword").val()) {
                $("#newPasswordUpdateBtn").removeAttr("disabled");
            }else {
                $("#newPasswordUpdateBtn").attr('disabled','disabled');
            }
        }
        
        function passwordIsValid(password) {
            let regex_password_valida = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            return regex_password_valida.test(password);
        }
    });
    
}