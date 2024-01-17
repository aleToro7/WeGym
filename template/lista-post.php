<?php
    require_once '../posts.php';

    if(isset($templateParams["post"])){
        foreach($templateParams["post"] as $post){
            ?>
            <div class="posts-container">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col" name="profile-img">
                            <img class="profile-img-container-post" id="img-profile-post" src="<?php 
                                if($post["imgProfilo"]!='') {
                                    echo $post["imgProfilo"];
                                }else {
                                    echo "../altro/img_avatar.png";
                                }
                            ?>"/>
                            <span class="usrname" id="usrname"><?php echo $post["idUtente"];?></span><br>
                        </div>
                    </div>
                    <div class="row">
                        <img src="<?php echo $post["img"];?>" class="preview-post-image" id="postImage"/>
                    </div>
                    <div class="row">
                        <div name="text-post">
                            <span class="post-text" id="postText"><?php echo $post["testo"]; ?></span>
                        </div>
                    </div>
                </div>
                <div class="green-post"></div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col" name="likeandcomm">
                            <?php if(isset($_SESSION["location"]) && $_SESSION["location"] == "profilo"){
                                echo '<span class="like-value">'.$post["numMiPiace"].' like</span>';
                                echo '<span class="commento-value">'.$post["numCommenti"].' <i class="commento-icon-value bi bi-chat" id="'.$post["idPost"].'"></i></span>';
                            }else if(isset($_SESSION["location"]) && $_SESSION["location"] == "like"){
                                echo '<i class="liked-icon bi bi-heart-fill" id="like-'.$post["idPost"].'"></i>';
                                echo '<i class="commento-icon bi bi-chat" id="'.$post["idPost"].'"></i>';
                            }else{
                                if($post["messoLike"]){
                                    echo '<i class="liked-icon bi bi-heart-fill" id="like-'.$post["idPost"].'"></i>';
                                }else{
                                    echo '<i class="like-icon bi bi-heart" id="like-'.$post["idPost"].'"></i>';
                                }
                                echo '<i class="commento-icon bi bi-chat" id="'.$post["idPost"].'"></i>';
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    }
    
?>
<div id="last"></div>
