<?php
    require_once '../info.php';
    if(isset($templateParams["myinfo"])){
        foreach($templateParams["myinfo"] as $myinfo){
        ?>
            <div class="info-container">
                <img class="my-info-profilo" src="../altro/myinfo-gray.png" alt="MyInfo">
                <div class="row">
                    <div>
                        <ul class="less-points">
                            <li>
                                <h6>Quanti giorni alla settimana mi alleno: </h6>
                                <span><?php echo $myinfo["frequenzaAllenamenti"]; ?></span>
                            </li>
                            <li>
                                <span>a</span>
                                <span><?php echo $myinfo["obbiettivo"]; ?></span>
                            </li>
                            <li>
                                <span></span>
                                <span><?php echo $myinfo["esercizioPreferito"]; ?></span>
                            </li>
                            <li>
                                <span></span>
                                <span></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php
        }
    }
?>