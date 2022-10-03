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
    <title>Envio de Arquivo</title>
</head>
<body>

    <h1>Envio de Arquivo</h1>
    <form action="">

        <label for=""></label>
        <input type="file" name="" id="">
        <br>

        <input type="submit" value="Enviar">
        <input type="submit" value="Cancelar">


    </form>

    

    
    
</body>
</html>