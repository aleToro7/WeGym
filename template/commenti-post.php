<?php
    require_once '../commenti.php';
?>


<div class="container ">
    <div class="container-commenti">
        <div class="row">
            <div class="col">
                <i class="close bi bi-x" id="closeCommenti"></i>
            </div>
        </div>
        <div id="load-new-comment"></div>
        <?php
        if(isset($templateParams["comment"])){
            foreach($templateParams["comment"] as $comment){
                ?>
                <div class="comment-container">
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
                            
                        </div>
                    </div>
                    <div class="row"><span class="testo-commento" id="testoComento"><?php echo $comment["testo"];?></span></div>
                </div>
                <?php
            }
        }
    ?>
    </div>
</div>
<div class="bottom-pad-commenti"></div>
<div class="bgbody fixed-bottom">
    <div class="spacing"></div>
    <textarea class="commenta" id="commento" rows="2" placeholder="Commenta..."></textarea><i class="bi bi-send invia fixed-bottom" id="invia"></i>
</div>

