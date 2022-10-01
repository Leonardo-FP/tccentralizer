<?php 
session_start();

include_once('../conexao/conn.php');
$u = new database;
$u->conectar();

if(isset($_POST['submitOrientador'])){   
    if(!empty($_POST['nomeOrientador']) && !empty($_POST['senhaOrientador'])){

        $nome = $_POST['nomeOrientador'];
        $senha = $_POST['senhaOrientador'];
        $usuario = "orientador";
        
        $existe_usuario = $u->verifica_login($nome, $senha, $usuario);
        
        if(!$existe_usuario){
            unset($_SESSION['nome']);
            unset($_SESSION['senha']);

            echo "<script>alert('Usuário não encontrado no banco de dados!')</script>";

            echo "<script>location.href='../telas/tela_login_orientador.php';</script>";
        }else{
            $_SESSION['nome'] = $nome;
            $_SESSION['senha'] = $senha;
            header('Location: ../telas/home.php');
        }
    }else{
        echo "Digite os campos corretamente";
    }
}else if(isset($_POST['submitGrupo'])){
    if(!empty($_POST['nomeGrupo']) && !empty($_POST['senhaGrupo'])){

        $nome = $_POST['nomeGrupo'];
        $senha = $_POST['senhaGrupo'];
        $usuario = "grupo";
        
        $existe_usuario = $u->verifica_login($nome, $senha, $usuario);
        
        if(!$existe_usuario){
            unset($_SESSION['nome']);
            unset($_SESSION['senha']);

            echo "<script>alert('Usuário não encontrado no banco de dados!')</script>";

            echo "<script>location.href='../telas/tela_login_grupo.php';</script>";
        }else{
            $_SESSION['nome'] = $nome;
            $_SESSION['senha'] = $senha;
            header('Location: ../telas/home.php');
        }
    }else{
        echo "Digite os campos corretamente";
    }
}else{
    header('Location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Grupo</title>
</head>
<body>

    <a href="../index.php">Sair</a>
    
</body>
</html>