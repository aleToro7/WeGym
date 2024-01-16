function eventiCaricaPost(){
    waitForEl("#posta", function() {
        $("#close").click(function(){
            $("#load").empty();
            $("#load").load('./carica-post.php', eventiCaricaPost());
        });
    
        $("#close-crop").click(function(){
            bs_modal.modal('hide');
            $("#getPostImage").val('');
        });
    
        let bs_modal = $('#modal');
        let image = document.getElementById('image');
        let cropper,reader,file, base64data;
    
        $("#getPostImage").on("change", function(e) {
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
            $("#getPostImage").val('');
        });
    
        $("#crop").click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 600,
                height: 600,
            });
    
            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                let reader = new FileReader();
                reader.readAsDataURL(blob);
                
                reader.onloadend = function() {
                    base64data = reader.result;
                    $("#getPostImage").val('');
                    $("#postImage").removeClass("hidden");
                    manageBtnPost();
                    $("#postImage").attr('src', base64data);
                    bs_modal.modal('hide');
                }
            });
        });

        $("#postText").keyup(function(){
            manageBtnPost();
        });

        $("#posta").click(function(){
            let testo = $("#postText").val().trim();
            $.ajax({
                type:'POST',
                url:'../caricaPost.php',
                data: {testoFromAjax: testo, imgFromAjax: base64data},
                success: function(data) {
                    $("#load").empty();
                    $("#upload").toggleClass("bi-plus-square-fill bi-plus-square");
                    $("#profile").toggleClass("bi-person bi-person-fill");
                    sessionStorage.removeItem("load-profile-view");
                    sessionStorage.setItem("load", "./profilo.php");
                    sessionStorage.setItem("id", "#profile");
                    sessionStorage.setItem("class", "bi-person bi-person-fill");
                    $("#load").load('./profilo.php', eventiProfilo());
                }
            });
        });

        function manageBtnPost() {
            if($("#postText").val().trim() != '' || !$("#postImage").hasClass("hidden")){
                $("#posta").removeAttr("disabled");
            }else{
                $("#posta").attr('disabled','disabled');
            }
        }

    });
}