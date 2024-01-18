<?php
    require_once '../info.php';
    if(isset($templateParams["myinfo"])){
        foreach($templateParams["myinfo"] as $myinfo){
        ?>
            <div class="info-container">
                <p>ciao</p>
            </div>
        <?php
        }
    }
?>