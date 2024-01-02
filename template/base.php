<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>WeGym</title>
    <link rel="icon" type="image/x-icon" href="../altro/favicon.png">
</head>
<body class="bgbody">
    <div id="load"><?php require 'profilo.php';?></div>
    <div>
        <nav class=" d-flex bd-highlight fixed-bottom">
            <a class="nav p-2 flex-fill bd-highlight" id="nav-home">
                <i class="bi bi-house-door-fill fa-2x" id="home"></i>
            </a>
            <a class="nav p-2 flex-fill bd-highlight" id="nav-upload">
                <i class="bi bi-plus-square fa-2x" id="upload"></i>
            </a>
            <a class="nav p-2 flex-fill bd-highlight" id="nav-profile">
                <i class="bi bi-person fa-2x" id="profile"></i>
            </a>
        </nav>
    </div>
</body>
</html>