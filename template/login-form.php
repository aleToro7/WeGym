<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body>
<div class="container">
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
                <li>
                    <input type="submit" name="Login" value="Login" />
                </li>
            </ul>
        </form>
  </div>
</div>
</body>
</html>