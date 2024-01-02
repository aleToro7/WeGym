<?php
    require_once '../profili.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-4 nome-utente">
            <p><span class="logo">W</span>&nbsp&nbsp<?php echo $_SESSION["username"];?></p>
        </div>
        <div class="col bg-primary">
            <i style="float: right;" class="bi bi-box-arrow-right"></i>
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
        <div class="col-1"  name="stats">
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
            <button type="button" class="button" id="segui">Segui</button>  
        </div>
    </div>
</div>
<div>
    <br>
    <nav class=" d-flex bd-highlight">
        <a class="middle-nav p-2 flex-fill bd-highlight " href="base.php">
            <i class="selected bi bi-house-door-fill fa-2x"></i>
        </a>
        <a class="middle-nav p-2 flex-fill bd-highlight" href="carica-post.php">
            <i class="bi bi-plus-square fa-2x"></i>
        </a>
    </nav>
</div>
