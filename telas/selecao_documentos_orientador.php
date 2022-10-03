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
    <title>Seleção de Documentos</title>
</head>
<body>
    
    <h1>Nome do grupo</h1>

    <div style="background-color: rgb(68, 64, 64);width: 500px;height: 300px;">

    </div>

    <input type="button" value="Baixar">

    <input type="button" value="Lançar">



</body>
</html>