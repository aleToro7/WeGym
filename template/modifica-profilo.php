<?php
    require_once '../profili.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-2">
            <span class="cambia-password" id="cambiaPassword">Cambia password</span>
        </div>
        <div class="col">
            <i class="close bi bi-x" id="close"></i>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <img class="profile-img-container" src="<?php 
                if($templateParams["imgProfilo"]!='') {
                    echo $templateParams["imgProfilo"];
                }else {
                    echo "../altro/img_avatar.png";
                }
            ?>"/>
            <form method="post">
                <input type="file" name="button image" class="image" value="Scegli immagine profilo">
            </form>
        </div>
    <div class="row">
        <div class="col">
            <span>Nome utente</span>
            <input type="text" class="" name="newUsername" id="newUsername" value="<?php echo $templateParams["username"];?>">
        </div>
    </div>

    <div class="row">
        <div class="col hide">
            <span>Nuova password</span>
            <input type="text" class="" name="newPassword" id="newPassword">
        </div>
    </div>    
    <div class="row">
        <div class="col">
            <span>Biografia</span>
            <input type="text" class="" name="newBio" id="newBio" value="<?php echo $templateParams["biografia"];?>" multiple size="50"><br><br>
        </div>
    </div>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="background-color: #373737">
                <div class="modal-header">
                    <h5 class="modal-title nome-utente" id="modalLabel">Ritaglia immagine</h5>
                    <i class="close bi bi-x" id="close-crop"></i>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8"> 
                                <img id="image" class="img-crop">
                            </div>
                            <div class="col-md-4">
                                <div class="preview profile-img-container"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>-->
                    <button type="button" class="button btn-primary" id="crop">Ritaglia</button>
                </div>
                <span><?php if(isset($templateParams['erroreImmagine'])) echo $templateParams['erroreImmagine'];?></span>
            </div>
        </div>
    </div>
    
</div>