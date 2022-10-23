<?php
    include_once('../conexao/conn.php');
    $u = new database;
    $u->conectar();

    session_start();
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
    <link rel="stylesheet" href="../css/style.css">
    <title>Atualização de senha</title>
</head>
<body>

    <form method="POST">
        
        <label for="senha_antiga">Senha antiga:</label>
        <input class="form-control" type="password" name="senha_antiga" required autofocus>
        <br>

        <label for="nova_senha">Nova senha:</label>
        <input class="form-control" type="password" name="nova_senha" required>
        <br>

        <label for="confirma_nova_senha">Confirmar nova senha</label>
        <input class="form-control" type="password" name="confirma_nova_senha" required>
        <br>

        <input class="btn btn-lg btn-primary btn-block" type="submit" name="alterar">

        <a  class="btn btn-lg btn-primary btn-block" href="home.php">Voltar</a>

    </form>

    
</body>
</html>

<?php 
    if(isset($_POST['alterar'])){

        if(isset($_POST['senha_antiga']) && isset($_POST['nova_senha']) && isset($_POST['confirma_nova_senha'])){
        
            $senha_antiga = $_POST['senha_antiga'];
            $nova_senha = $_POST['nova_senha'];
            $confirmacao = $_POST['confirma_nova_senha'];

            if($nova_senha == $confirmacao){
                if($_SESSION['usuario'] == "orientador"){
                    
                    $antiga_orientador = $u->busca_antiga_orientador($logado); 

                    if(!empty($antiga_orientador)){
                        if($senha_antiga == $antiga_orientador['senhaProfessor']){
                            if($u->muda_senha_orientador($nova_senha, $logado)){
                                $_SESSION['senha'] = $nova_senha;
                                echo "<script>alert('Senha atualizada com sucesso!')</script>";
                                echo "<script>location.href='home.php';</script>";
    
                            }else{
    
                                echo "<script>alert('Erro ao atualizar senha!')</script>";
                                echo "<script>location.href='home.php';</script>";
    
                            }
                                                    
                        }else{
                            echo "<script>alert('A senha antiga digitada está incorreta!')</script>";
                            echo "<script>location.href='home.php';</script>";
                        }
                    }
                    
                }else{
                    $antiga_grupo = $u->busca_antiga_grupo($logado); 
                    
                    if(!empty($antiga_grupo)){
                        if($senha_antiga == $antiga_grupo['senhaGrupo']){
                            if($u->muda_senha_grupo($nova_senha, $logado)){
                                $_SESSION['senha'] = $nova_senha;
                                echo "<script>alert('Senha atualizada com sucesso!')</script>";
                                echo "<script>location.href='home.php';</script>";
    
                            }else{
    
                                echo "<script>alert('Erro ao atualizar senha!')</script>";
                                echo "<script>location.href='home.php';</script>";
    
                            }
                                                    
                        }else{
                            echo "<script>alert('A senha antiga digitada está incorreta!')</script>";
                            echo "<script>location.href='home.php';</script>";
                        }
                    }
                    
                }
            }else{
                echo "<script>alert('As senhas digitadas não coincidem!')</script>";
            }

        }else{
            echo "<script>alert('Campos obrigatórios não preenchidos!')</script>";
        }
        

    }
?>

