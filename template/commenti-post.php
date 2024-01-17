<?php
    require_once '../commenti.php';
?>

<div class="">
    <div class="container">
    <div id="load-new-comment"></div>
    <?php
    if(isset($templateParams["comment"])){
        foreach($templateParams["comment"] as $comment){
            ?>
            <div class="row">
                <div class="col">
                    <img class="profile-img-container-post" id="img-profile-comment" src="<?php 
                                        if($comment["imgProfilo"]!='') {
                                            echo $comment["imgProfilo"];
                                        }else {
                                            echo "../altro/img_avatar.png";
                                        }
                                    ?>"/>
                    <span class="usrname" id="usrnameCommento"><?php echo $comment["idUtente"];?></span><br>
                    <span class="bio" id="testoComento"><?php echo $comment["testo"];?></span>
                </div>
            </div>
            <?php
        }
    }
?>
    </div>
    <textarea class="commenta fixed-bottom" id="commento" placeholder="Commenta..."></textarea><i class="bi bi-send invia fixed-bottom" id="invia"></i>
</div>
