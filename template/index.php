<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../js/login.js"></script>

    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="../altro/favicon.PNG">
</head>
<body class="bgbody">
<div class="my-container">
  <div class="child">
    <form action="#" method="POST">
            <h1>WeGym</h1>
            <?php if(isset($templateParams["errorelogin"])): ?>
            <p><?php echo $templateParams["errorelogin"]; ?></p>
            <?php endif; ?>

            <ul>
                <li>
                    <input type="text" id="username" name="username" placeholder="Username:"/>
                </li>
                <li>
                    <input type="password" id="password" name="password" placeholder="Password:"/>
                </li>
                <div id="login-error"></div>
                <li>
                    <button class="btn-login" type="button" id="login">Login</button>
                </li>
            </ul>
            <div>
                <p>Non hai un account? <a href="../template/registrazione-form.php">Registrati</a></p>
            </div>
        </form>
  </div>
</div>
</body>
</html>

<?php
    require_once '../login.php';
?>