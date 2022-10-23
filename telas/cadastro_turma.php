<?php
    session_start();
    if((!isset($_SESSION['nome'])) and (!isset($_SESSION['senha'])))  {
        unset($_SESSION['nome']);
        unset($_SESSION['senha']);

        echo "<script>alert('Você não pode entrar aqui sem logar!!!!!!')</script>";

        echo "<script>location.href='escolha_login.php';</script>";
    }

    if(($_SESSION['usuario'] == "grupo"))  {
        echo "<script>alert('Essa tela é somente do professor !!!!!!')</script>";

        echo "<script>location.href='home.php';</script>";
    }

    // print_r($_SESSION);
?>
<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro Turma</title>

    <link rel="stylesheet" href="../css/style.css">
    <title>Cadastro Turma</title>

</head>
<body>
    <form action="../php/dados_turma.php" method="POST">

        <label for="nomeTurma">Turma</label>
        <input required autofocus type="text" name="nomeTurma" id="nomeTurma" class="form-control">
        <br>

        <label for="dataEntPrimeira">Primeira Entrega</label>
        <input required type="date" name="dataEntPrimeira" id="dataEntPrimeira" class="form-control">
        <br>

        <label for="dataEntSegunda">Segunda Entrega</label>
        <input required type="date" name="dataEntSegunda" id="dataEntSegunda" class="form-control">
        <br>

        <label for="dataEntTerceira">Terceira Entrega</label>
        <input required type="date" name="dataEntTerceira" id="dataEntTerceira" class="form-control">
        <br>

        <label for="dataEntQuarta">Quarta Entrega</label>
        <input required type="date" name="dataEntQuarta" id="dataEntQuarta" class="form-control">
        <br>

        <label for="dataEntQuinta">Entrega Final</label>
        <input required type="date" name="dataEntQuinta" id="dataEntQuinta" class="form-control">
        <br>

        <button class="btn btn-lg btn-primary btn-block" type="submit" name="btn-cadastrar">Cadastrar</button>
    
        <a class="btn btn-lg btn-primary btn-block" href="home.php">Voltar</a>
        
    </form>
    
</body>
</html>