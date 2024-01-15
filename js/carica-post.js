function eventiCaricaPost(){
    waitForEl("#posta", function() {
        $("#close").click(function(){
            $("#load").empty();
            $("#load").load('./carica-post.php', eventiProfilo());
        });
    
        $("#close-crop").click(function(){
            bs_modal.modal('hide');
            $("#getImage").val('');
        });
    
        let bs_modal = $('#modal');
        let image = document.getElementById('image');
        let cropper,reader,file;
    
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
    });
    
}