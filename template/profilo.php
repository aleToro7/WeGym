<?php
    require_once '../profili.php';
?>
<script src="../js/profilo.js"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col-4 nome-utente">
            <p><span class="logo">W</span>&nbsp&nbsp<?php echo $_SESSION["username"];?></p>
        </div>
        <div class="col">
            <a href="../logout.php"><i class="bi bi-box-arrow-right logout-button"  title="Disconnetti"></i></a>
        </div>
    </div>
    <div class="row">
        <div class="col-1">   
        </div>
        <div class="col-1" name="stats">
            <span>13</span><br>
            <span>Post</span>
        </div>
        <div class="col-2">
            <p></p>
        </div>
        <div class="col-1" name="stats">
            <span>10K</span><br>
            <span>Follower</span>
        </div>
        <div class="col-2">
            <p></p>
        </div>
        <div class="col-4">
            <div class="img-container"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-1">   
        </div>
        <div class="col-6 bio">
            <span class="bio-title">BIOGRAFIA<br></span>
            <span><?php  if(isset($_SESSION["biografia"])) echo $_SESSION["biografia"];?><br></span>
        </div>
        <div class="col-4">
            <button type="button" class="button segui" id="segui">Segui</button>  
        </div>
    </div>
</div>
<div>
    <br>
    <nav class=" d-flex bd-highlight">
        <a class="middle-nav p-2 flex-fill bd-highlight" id="nav-posted">
            <i class="selected bi bi-image fa-2x" id="posted"></i>
        </a>
        <?php ?>
        <a class="middle-nav p-2 flex-fill bd-highlight" id="nav-info">
            <img src="../altro/dumbbell-solid.svg" alt="" class="barrell filter-dark-grey" id="info"/>
        </a>
    </nav>
    <div id="load-profile-view"></div>
</div>
