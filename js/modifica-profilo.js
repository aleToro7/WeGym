
function eventiModificaProfilo() {
    waitForEl("input.image", function() {
        /*
        $("#modificaImg").click(function(){
            $("#load").empty();
            $("#load").load('./crop-image.php');
        });*/
        $(document).ready(function () {
            $("#close").click(function(){
                $("#load").empty();
                $("#load").load('./profilo.php', eventiProfilo());
            });
        });

        var bs_modal = $('#modal');
        var image = document.getElementById('image');
        var cropper,reader,file;

        $("body").on("change", ".image", function(e) {
            var files = e.target.files;
            var done = function(url) {
                alert(url);
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
        });

        $("#crop").click(function() {
            alert("click");
            canvas = cropper.getCroppedCanvas({
                width: 160,
                height: 160,
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $.ajax({
                        type: "POST",
                        url: "../modificaProfilo.php",
                        data: {imageFromAjax: base64data},
                        success: function(data) {
                            if(data == "ok") {
                                bs_modal.modal('hide');
                                alert("success upload image");
                                $("#img-profile").attr('src', base64data); 
                            }
                        },
                    });
                };
            });
        });
    });
    
}