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
        <div class="container-modifica-profilo">
            <div class="flexible-div">
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
            </div>
        </div>
    </div>
    <div class="container-modifica-profilo">
        <div class="row">
            <div class="flexible-div">
                <div class="row">
                    <div class="col">
                        <span class="hide text input-label" id="oldPasswordLabel">Vecchia password</span>
                        <input type="password" class="hide campo" name="oldPassword" id="oldPassword">
                        <i class="hide occhi-modifica bi bi-eye-slash" id="oldPasswordEye"></i>
                    </div>
                    <div class="row"><span class="hide" id="oldPasswordStatus"></span></div>
                </div>
                <div class="row">
                    <div class="col">
                        <span class="hide text input-label" id="newPasswordLabel">Nuova password</span>
                        <input type="password" class="hide campo" name="newPassword" id="newPassword">
                        <i class="hide occhi-modifica bi bi-eye-slash" id="newPasswordEye"></i>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="max-errore error-container-modifica hide" id="newPasswordStatus"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="button" id="newPasswordUpdateBtn" class="hide button-modifica" disabled>Aggiorna password</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <span class="text input-label">Nome utente</span>
                        <input type="text" class="campo" name="newUsername" id="newUsername" value="<?php echo $templateParams["username"];?>">
                    </div>
                    <br><div class="text" id="new-user-availability-status"></div>
                </div>  
                <div class="row">
                    <div class="col">
                        <span class="text input-label">Biografia</span>
                        <textarea class="modifica-bio campo" name="newBio" id="newBio" rows="5" required><?php echo $templateParams["biografia"];?></textarea>
                    </div>
                </div>
                <img class="my-info" src="../altro/myinfo-gray.png" alt="MyInfo">
                <div class="row">
                    <div class="col">
                        <span class="text input-label">Frequenza allenamenti</span>
                        <select class="campo" name="frequenzaAllenamenti" id="frequenzaAllenamenti">
                            <option value="">--scegli frequenza allenamenti--</option>
                            <option value="0">0 a settimana</option>
                            <option value="1">1 a settimana</option>
                            <option value="2">2 a settimana</option>
                            <option value="3">3 a settimana</option>
                            <option value="4">4 a settimana</option>
                            <option value="5">5 a settimana</option>
                            <option value="6">6 a settimana</option>
                            <option value="7">7 a settimana</option>
                        </select>
                    </div>
                    <br><div class="text" id="new-user-availability-status"></div>
                </div> 
                <div class="row">
                    <div class="col">
                        <span class="text input-label">Obbiettivo</span>
                        <input type="text" class="campo" name="obbiettivo" id="obbiettivo" value="<?php if(isset($templateParams["obbiettivo"])) echo $templateParams["obbiettivo"];?>">
                    </div>
                    <br><div class="text" id="new-user-availability-status"></div>
                </div> 
                <div class="row">
                    <div class="col">
                        <span class="text input-label">Esercizio preferito</span>
                        <input type="text" class="campo" name="esercizioPreferito" id="esercizioPreferito" value="<?php if(isset($templateParams["esercizioPreferito"])) echo $templateParams["esercizioPreferito"];?>">
                    </div>
                    <br><div class="text" id="new-user-availability-status"></div>
                </div> 
                <div class="row">
                    <div class="col">
                        <span class="text input-label">Muscolo preferito</span>
                        <input type="text" class="campo" name="muscoloPreferito" id="muscoloPreferito" value="<?php if(isset($templateParams["muscoloPreferito"])) echo $templateParams["muscoloPreferito"];?>">
                    </div>
                    <br><div class="text" id="new-user-availability-status"></div>
                </div> 
                <div class="row">
                    <div class="col">
                        <span class="text input-label">Alimento preferito</span>
                        <input type="text" class="campo" name="alimentoPreferito" id="alimentoPreferito" value="<?php if(isset($templateParams["alimentoPreferito"])) echo $templateParams["alimentoPreferito"];?>">
                    </div>
                    <br><div class="text" id="new-user-availability-status"></div>
                </div> 
                <div class="row">
                    <div class="col">
                        <button type="button" id="salva" class="button-modifica" disabled>Salva</button>
                    </div>
                </div>
            </div>
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