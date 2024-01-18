<!DOCTYPE html>
<html lang="it">
<?php
    //tenere qui o mettere i file separato?
    require_once '../bootstrap.php';
    if(isUserLoggedIn()){
        header("location: base.php");
        exit;
    }
?>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="../altro/favicon.png">
</head>
<body class="bgbody">
  <div class="child">
    <form action="#" method="POST">
        <div class="row">
            <div>
                <h1 class="logo-centrato">WeGym</h1>
                <ul class="less-points">
                    <li>
                        <input type="text" id="username" name="username" placeholder="Username"/>
                    </li>
                    <li>
                        <input type="password" id="password" name="password" placeholder="Password"/>
                        <i class="occhio bi bi-eye-slash" id="showPassword"></i>
                    </li>
                    <li class="max-errore">
                        <div class="container error-container" id="login-error"></div>
                    </li>
                    <li>
                        <button class="btn-login" type="button" id="login" name="login">Login</button>
                    </li>
                </ul>
                <div>
                    <div class="green-row"></div>
                    <p class="text">Non hai un account? <a href="../template/registrazione-form.php">Registrati</a></p>
                </div>
            </div>
            
        </div>
            
        </form>
  </div>
</body>
<script src="../js/login.js"></script>
</html>
