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
                            <i class="like-icon bi bi-heart"></i>
                            <i class="commento-icon bi bi-chat"></i>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    }
    
?>

