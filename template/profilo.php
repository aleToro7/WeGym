<?php
    require_once '../profili.php';
?>


<div class="sticky-top bgbody">
    <div class="container-fluid">
        <div class="row">
            <div class="col-4 nome-utente">
                <img class="w" src="../altro/w.png" alt="w"><span class="w-text"><?php echo $templateParams["username"];?></span>
            </div>
            <div class="col">
                <?php if($templateParams["username"] != $_SESSION["username"]) {
                    echo '<i class="close bi bi-x" id="close"></i>';
                }else {
                    echo '<a href="../logout.php"><i class="bi bi-box-arrow-right logout-button"  title="Disconnetti" id="logout"></i></a>';
                } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-1 counter" name="stats">
                <span id="posts"><?php echo $templateParams["posts"];?></span><br>
                <span class="counter-text">Post</span>
            </div>
            <div class="col-1">
                <p></p>
            </div>
            <div class="col-1 counter" name="stats">
                <span id="follow"><?php echo $templateParams["follow"];?></span><br>
                <span class="counter-text">Seguiti</span>
            </div>
            <div class="col-1">
                <p></p>
            </div>
            <div class="col-1 counter" name="stats">
                <span id="follower"><?php echo $templateParams["follower"];?></span><br>
                <span class="counter-text">Follower</span>
            </div>
            <div class="col-1">
                <p></p>
            </div>
            <div class="col-3">
                <img class="profile-img-container" id="img-profile" src="<?php 
                    if($templateParams["imgProfilo"]!='') {
                        echo $templateParams["imgProfilo"];
                    }else {
                        echo "../altro/img_avatar.png";
                    }
                ?>"/>
            </div>
        </div>
        <?php
            if($templateParams["username"] == $_SESSION["username"]){
                echo '<div class="row">
                        <div class="col-1">   
                        </div>
                        <div class="col-6 d-grid gap-2">
                            <button type="button" class="modifica-profilo" id="modificaProfilo">Modifica profilo</button>  
                        </div>
                    </div>';
            }

        ?>
        <div class="row">
            <div class="col-1">   
            </div>
            <div class="col-6 bio">
                <span class="bio-title">BIOGRAFIA<br></span>
            </div>
            <?php
                if($templateParams["username"] != $_SESSION["username"]){
                    $templateParams['seguito'] == false ? $class = "Segui" : $class = "Seguito";
                    echo '<div class="col-4">
                    <button type="button" class="button '.$class.'" id="segui">'.$class.'</button>  
                    </div>';
                }
            ?>
        </div>
        <div class="row">
            <div class="col-1">   
            </div>
            <div class="col bio biobio">
                <span><?php  if(isset($templateParams["biografia"]) && $templateParams["biografia"]!= '') echo $templateParams["biografia"];?><br></span>
            </div>
        </div>
    </div>
    <div>
        <br>
        <nav class="d-flex bd-highlight" id="nav">
            <a class="nav middle-nav p-2 flex-fill bd-highlight" id="nav-lista-post">
                <i class="centra-icona bi bi-image fa-2x" id="lista-post"></i>
            </a>
            <?php
                if($templateParams["username"] == $_SESSION["username"]){
                    echo '<a class="nav middle-nav p-2 flex-fill bd-highlight" id="nav-lista-notifiche">
                            <i class="centra-icona bi bi-stopwatch-fill fa-2x" id="lista-notifiche"><span id="novita"></span></i>
                        </a>';
                }
                if($templateParams["username"] == $_SESSION["username"]){
                    echo '<a class="nav middle-nav p-2 flex-fill bd-highlight" id="nav-lista-post-liked">
                            <i class="centra-icona bi bi-heart-pulse-fill fa-2x" id="lista-post-liked"></i>
                        </a>';
                } else{
                    echo '<a class="middle-nav p-2 flex-fill bd-highlight" id="nav-my-info">
                            <img src="../altro/dumbbell-solid.svg" alt="" class="img-nav barrell filter-dark-grey" id="my-info"/>
                        </a>';
                }
            ?>
        </nav>
    </div>
    <div class="spacing"></div>
</div>
<div id="load-profile-view"></div>