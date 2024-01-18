<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Registrati</title>
</head>
<body class="bgbody">
<div class="my-container">
    <div>
        <ol class="carousel-indicators">
            <li id="firstIndicator" class="active"></li>
            <li id="secondIndicator"></li>
        </ol>
    </div>
    <div class="child">
        <form action="#" method="POST" id="form-registrazione">
            <h1 class="logo-centrato">WeGym</h1>
            <ul class="less-points">
                <li>
                    <input type="text" id="nome" name="nome" placeholder="Nome"/>
                </li>
                <li>
                    <input type="text" id="cognome" name="cognome" placeholder="Cognome"/>
                </li>
                <li>
                    <input type="date" id="dataNascita" name="dataNascita"/>
                </li>
                <li>
                    <input class="hide" type="text" id="mail" name="mail" placeholder="Mail"/>
                </li>
                <li class="max-errore">
                    <div class="container error-container hide" id="mail-availability-status"></div>
                </li>
                <li>
                    <input class="hide" type="text" id="username" name="username" placeholder="Username"/>
                </li>
                <li class="max-errore">
                    <div class="container error-container hide" id="user-availability-status"></div>
                </li>
                <li>
                    <input class="hide" type="password" id="pwd" name="pwd" placeholder="Password"/>
                    <i class="occhi hide bi bi-eye-slash" id="showPwd"></i>
                </li>
                <li class="max-errore">
                    <div class="container error-container hide" id="pwdStatus"></div>
                </li>
                <li>
                    <input class="hide" type="password" id="confermaPwd" name="confermaPwd" placeholder="Conferma password"/>
                    <i class="occhi hide bi bi-eye-slash" id="showConfermaPwd"></i>
                </li>
                <li>
                    <button type="button" class="hide" id="indietro">Indietro</button>
                    <button type="button" class="btn-continua" id="continua" disabled>Continua</button>
                    <button type="submit" class="hide" id="registrati" name="registrati" disabled>Registrati</button>
                    <span><?php if(isset($templateParams['erroreRegistrazione'])) echo $templateParams['erroreRegistrazione'];?></span>
                </li>
            </ul>
        </form>
    </div>
    <div><a href="index.php"><i class="bi bi-arrow-bar-left back-arrow" id="backLogin"></i></a></div>
</div>
</body>
<script src="../js/registrazione.js"></script>
</html>
<?php 
    require_once '../registrazione.php';
?>