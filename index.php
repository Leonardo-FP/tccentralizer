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
    <title>Tela Inicial</title>
</head>
<body>

    <div class="home">
    
        <h1>Controle de Trabalhos de Conclusão de Curso</h1>

        <h2>Bem vindo</h2>
        <br>

        <h2 >Autores:
            <br>
            Leo
            <br>
            Yago
            <br>
            Rafael
            <br>
            Kaique
        </h2>

        <div>
            <a id="botao" class="btn btn-primary" href="telas/escolha_login.php">Login</a>
            
        
            <a id="botao" class="btn btn-primary" href="telas/escolha_cadastro.php">Cadastro</a>
        </div>
        

        

    </div>

    
    



</body>
</html>