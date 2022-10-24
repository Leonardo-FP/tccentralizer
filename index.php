<?php
    require_once 'conexao/conn.php';

    $u = new database;
    $u->conectar();
?> 

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Tela Inicial</title>
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">TCCentralizer</a></li>
                <li><a href="telas/escolha_login.php">Login</a></li>
                <li><a href="telas/escolha_cadastro.php">Cadastro</a></li>
            </ul>
        </div>
    </nav>
    <div class="home">
        
        <h1><u>Controle de Trabalhos de Conclusão de Curso</u></h1>

        <h2>Bem vindo(a)</h2>
        <br>
        
        <div style="display:block; text-align: center; font-size: 25px;">
            <h2>Autores</h2>
            <p>Leonardo - <a href="https://github.com/Leonardo-FP" target="blank">GitHub</a> <ion-icon name="logo-github"></ion-icon></p>
            <p>Yago - <a href="https://github.com/yagoalvess" target="blank">GitHub</a> <ion-icon name="logo-github"></ion-icon></p>
            <p>Rafael - <a href="https://github.com/rac0711" target="blank">GitHub</a> <ion-icon name="logo-github"></ion-icon></p>
            <p> Kayke - <a href="https://github.com/KaykeMatiasS" target="blank">GitHub</a> <ion-icon name="logo-github"></ion-icon></p>
        </div>
    </div>
    <script  type = "module"  src = "https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js" ></script> 
    <script  nomodule  src = "https://unpkg .com/ionicons@5.5.2/dist/ionicons/ionicons.js" ></script>
</body>
</html>