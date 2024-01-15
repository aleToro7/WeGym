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
    <div class="row  h-100">
        <div class="col d-flex align-items-center justify-content-center">
            <img class="preview-img-container" src="<?php 
                if($templateParams["imgProfilo"]!='') {
                    echo $templateParams["imgProfilo"];
                }else {
                    echo "../altro/img_avatar.png";
                }
            ?>"/>
        </div>

    <div class="row">
        <div class="col d-flex align-items-center justify-content-center">
            <form method="post">
                <input type="file" id="getImage" name="getImage" class="hide">
                <label for="getImage" class="input-file-label"><span class="text">Scegli immagine profilo</span></label>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-center">
            <span class="text input-label">Nome utente</span>
            <input type="text" class="campo" name="newUsername" id="newUsername" value="<?php echo $templateParams["username"];?>">
        </div>
        <br><div class="text d-flex justify-content-center" id="new-user-availability-status"></div>
    </div>
    <div class="row">
        <div class="col hide">
            <span class="text input-label">Nuova password</span>
            <input type="text" class="campo" name="newPassword" id="newPassword">
        </div>
    </div>    
    <div class="row">
        <div class="col d-flex justify-content-center">
            <span class="text input-label">Biografia</span>
            <textarea class="campo"  name="newBio" id="newBio" rows="5" required><?php echo $templateParams["biografia"];?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-center">
            <button type="button" id="salva" class="button" disabled>Salva</button>
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
                    <button type="button" class="button btn-primary" id="crop">Ritaglia</button>
                </div>
                <span><?php if(isset($templateParams['erroreImmagine'])) echo $templateParams['erroreImmagine'];?></span>
            </div>
        </div>
    </div>
    
</div>