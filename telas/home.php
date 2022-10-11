<!--<?php 
    session_start();

    if((!isset($_SESSION['nome'])) and (!isset($_SESSION['senha'])))  {
        unset($_SESSION['nome']);
        unset($_SESSION['senha']);

        echo "<script>alert('Você não pode entrar aqui sem logar!!!!!!')</script>";

        echo "<script>location.href='escolha_login.php';</script>";
    }
    $logado = $_SESSION['nome'];
?>-->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Menu Principal</title>
</head>
<body>

    <div>
        <a class="btn btn-lg btn-primary btn-block" href="atualizacao_senha.php">Atualizar Senha</a>
        <br>

        <a class="btn btn-lg btn-primary btn-block" href="selecao_documento_aluno.php">Documentos</a>
        <br>
        
        <a class="btn btn-lg btn-primary btn-block" href="sair.php">Logout</a>
        
    </div>

</body>
</html>