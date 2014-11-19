<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="target-densitydpi=device-dpi, width=device-width, initial-scale=1.0, maximum-scale=1">
    <title>RESTORA APP</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <style>
    body {
        background-color: #1A4A4A;
        padding:10px;
    }

    h2 {
        color: #ddd;
    }

    p {
        color: #ccc;
    }

    .button {
    display:inline-block;
    border:1px solid transparent;
    border-radius: 4px;
    margin: 20px auto 20px;
    padding: 10px;
    color: #bbb;
    width: 150px;
    text-transform:uppercase ;   
    background: #2980b9; 
    -webkit-transition: all .5s ease-in-out;
    -moz-transition: all .5s ease-in-out;
    -o-transition: all .5s ease-in-out;
    transition: all .5s ease-in-out;
    text-align: center;
    
}
.button:hover {   
    border:1px solid #FFF;
    color:#fff;
    opacity: 0.8;
    text-decoration: none;
} 
    </style>
</head>
<body class="metro">
    <div style="padding-bottom:20px;">
        <h2 class="fg-white">Error de inicio de sesi&oacute;n</h2>
        <p class="fg-white">Los datos de usuario o clave proporcionados son incorrectos</p>
        <a href="login.php" class="button">Iniciar sesi&oacute;n</a>
        <a href="registro.php" class="button">Registrarse</a>
    </div>
</body>
</html>