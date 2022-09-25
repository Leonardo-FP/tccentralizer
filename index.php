<?php
    require_once 'conexao/conn.php';

    $u = new database;
    $u->conectar();

    if($u->msgErro == ""){
        
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Inicial</title>
</head>
<body>
    <h1>Controle de Trabalhos de Conclusão de Curso</h1>

    <h2>Bem vindo</h2>
    <br>

    <h2>Autores:
        <br>
        black
        <br>
        leo
        <br>
        rafael
        <br>
        draken
        <br>
        kaique
    </h2>

    <a href="telas/escolha_login.php">Login</a>
    
    <a href="telas/escolha_cadastro.php">Cadastro</a>

</body>
</html>