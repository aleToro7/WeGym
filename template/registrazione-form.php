<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../js/registrazione.js"></script>
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
            <h1>WeGym</h1>
            <ul>
                <li>
                    <input type="text" id="username" name="username" placeholder="Username:"/>
                </li>
                <div id="user-availability-status"></div>
                <li>
                    <input type="text" id="nome" name="nome" placeholder="Nome:"/>
                </li>
                <li>
                    <input type="text" id="cognome" name="cognome" placeholder="Cognome:"/>
                </li>
                <li>
                    <input class="hide" type="date" id="dataNascita" name="dataNascita"/>
                </li>
                <li>
                    <input class="hide" type="text" id="mail" name="mail" placeholder="Mail:"/>
                </li>
                <li>
                    <input class="hide" type="text" id="pwd" name="pwd" placeholder="Password:"/>
                </li>
                <li>
                    <input class="hide" type="text" id="confermaPwd" name="confermaPwd" placeholder="Conferma password:"/>
                </li>
                <li>
                    <button type="button" class="hide" id="indietro">Indietro</button>
                    <button type="button" class="btn-continua" id="continua" disabled>Continua</button>
                    <button type="button" class="hide" id="registrati" disabled>Registrati</button>
                </li>
            </ul>
        </form>
  </div>
</div>
</body>
</html>