<?php
    require_once '../profili.php';
?>

<div class="upload-post">
    <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col" name="profile-img">
                <img class="profile-img-container-upload" id="img-profile-upload-post" src="<?php 
                    if($templateParams["imgProfilo"]!='') {
                        echo $templateParams["imgProfilo"];
                    }else {
                        echo "../altro/img_avatar.png";
                    }
                ?>"/>
                <span class="usrname" id="usrname"><?php echo $templateParams["username"];?></span><br>
            </div>
        </div>
        <div class="row">
            
        </div>
        <div class="row">
            <div name="text-post">
                <textarea class="post-text" rows="8" placeholder="Scrivi.." required></textarea>
            </div>
        </div>
    </div>
    <div class="green-upload"></div>    
    <div>
        <i class="upload-icon bi bi-image"></i>
        <button type="button" class="button button-post" id="posta">Post <i class="bi bi-arrow-right"></i></button> 
    </div>
</div>
<?php

?>