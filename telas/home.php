<?php 
    session_start();
    print_r($_SESSION);
    if((!isset($_SESSION['nome'])) and (!isset($_SESSION['senha'])))  {
        unset($_SESSION['nome']);
        unset($_SESSION['senha']);

        echo "<script>alert('Você não pode entrar aqui sem logar!!!!!!')</script>";

        echo "<script>location.href='escolha_login.php';</script>";
    }
    $logado = $_SESSION['nome'];
?> 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Principal</title>
</head>
<body>
    <div>
        <a href="atualizacao_senha.php"><button>Atualização de senha</button></a>
        <br>

        <a href="selecao_documento_aluno.php"><button>Documentos</button></a>
        <br>
        
        <a href="./sair.php"><button>Sair</button></a>
    </div>
</body>
</html>