<?php
    require_once '../profili.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <i class="close bi bi-x" id="close"></i>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <img class="profile-img-container" src="<?php 
                if($_SESSION["imgProfilo"]!='') {
                    echo $templateParams["imgProfilo"];
                }else {
                    echo "../altro/img_avatar.png";
                }
            ?>"/>
            <form method="post">
                <input type="file" name="button image" class="image" value="Scegli immagine profilo">
            </form>
        </div>
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Crop image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-8">  
                                    <!--  default image where we will set the src via jquery-->
                                    <img id="image" class="img-crop">
                                </div>
                                <div class="col-md-4">
                                    <div class="preview profile-img-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="crop">Crop</button>
                    </div>
                    <span><?php if(isset($templateParams['erroreImmagine'])) echo $templateParams['erroreImmagine'];?></span>
                </div>
            </div>
        </div>
    </div>
</div>