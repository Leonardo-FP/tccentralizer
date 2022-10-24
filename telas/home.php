<?php 
    session_start();

    if((!isset($_SESSION['nome'])) and (!isset($_SESSION['senha'])))  {
        unset($_SESSION['nome']);
        unset($_SESSION['senha']);

        echo "<script>alert('Você não pode entrar aqui sem logar!!!!!!')</script>";

        echo "<script>location.href='escolha_login.php';</script>";
    }

    if(isset($_GET['sucesso'])){
        echo "<script>alert('Cadastro efetuado com sucesso! Você agora já está logado.')</script>";
    }

    // print_r($_SESSION);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.css">
    <title>Menu Principal</title>
</head>
<body>
<nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/tccentralizer/index.php">TCCentralizer</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="Home.php">Home</a></li>
                <li><a href="sair.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="align">
        <a class="btn btn-lg btn-primary btn-block" href="atualizacao_senha.php">Atualizar Senha</a>
        <br>

        <?php 
            if(isset($_SESSION['usuario'])){
                if($_SESSION['usuario'] == "orientador"){ ?>
                <a class="btn btn-lg btn-primary btn-block" href="selecao_documentos_orientador.php">Documentos</a>
                <br>
                <a class="btn btn-lg btn-primary btn-block" href="cadastro_turma.php">Criar nova turma</a>
                <br>
            <?php }else{ ?>
                <a class="btn btn-lg btn-primary btn-block" href="selecao_documento_aluno.php">Documentos</a>
                <br>
            <?php }
            }
            
        ?>
        
    </div>

</body>
</html>