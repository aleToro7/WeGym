<?php
    require_once '../profili.php';
?>

<div class="upload-post">
    <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col" id="profile-img">
                <img class="profile-img-container-upload" id="img-profile-upload-post" src="<?php 
                    if(isset($_SESSION["imgProfilo"])) {
                        echo $_SESSION["imgProfilo"];
                    }else {
                        echo "../altro/img_avatar.png";
                    }
                ?>"/>
                <span class="usrname" id="usrname"><?php echo $_SESSION["username"];?></span><br>
            </div>
        </div>
        <div class="row">
            <img class="hidden preview-post-image" id="postImage"/>
        </div>
        <div class="row">
            <div name="text-post">
                <textarea class="upload-post-text" id="postText" rows="8" placeholder="Scrivi.." required></textarea>
            </div>
        </div>
    </div>
    <div class="green-upload"></div>    
    <div>
        <input type="file" class="hide" id="getPostImage">
        <label for="getPostImage" class="upload-icon bi bi-image "></label>
        <button type="button" class="button button-post" id="posta" disabled>Post <i class="bi bi-arrow-right"></i></button> 
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
                            <div class="preview post-img-container"></div>
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