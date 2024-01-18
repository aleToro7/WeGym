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
                                <h6 class="myinfo-text">Il mio obbiettivo: </h6>
                                <span><?php echo $myinfo["obbiettivo"]; ?></span>
                            </li>
                            <li>
                                <h6 class="myinfo-text">Il mio esercizio preferito: </h6>
                                <span><?php echo $myinfo["esercizioPreferito"]; ?></span>
                            </li>
                            <li>
                                <h6 class="myinfo-text">Il mio muscolo preferito: </h6>
                                <span><?php echo $myinfo["muscoloPreferito"]; ?></span>
                            </li>
                            <li>
                                <h6 class="myinfo-text">Il alimento preferito: </h6>
                                <span><?php echo $myinfo["alimentoPreferito"]; ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php
        }
    }
?>