<!DOCTYPE html>

<?php

    session_start();

    if((!isset($_SESSION['nome'])) and (!isset($_SESSION['senha'])))  {
        unset($_SESSION['nome']);
        unset($_SESSION['senha']);

        echo "<script>alert('Você não pode entrar aqui sem logar!!!!!!')</script>";

        echo "<script>location.href='escolha_login.php';</script>";
    }
    $logado = $_SESSION['nome'];

?> 



<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Envio de Arquivo</title>
</head>
<body>

    
    <form action="">
        
        <h1>Envio de Arquivo</h1>

        
        <input class="form-control" type="file" name="" id="">
        <br>

        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Enviar">
        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Cancelar">


    </form>

    

    
    
</body>
</html>