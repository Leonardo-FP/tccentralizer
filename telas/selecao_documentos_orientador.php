<!DOCTYPE html>
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

    if(($_SESSION['usuario'] == "grupo"))  {
        echo "<script>alert('Essa tela é somente do professor !!!!!!')</script>";

        echo "<script>location.href='home.php';</script>";
    }

    $nome = $_SESSION['nome'];
    $senha = $_SESSION['senha'];

    $dados_professor = $u->infos_professor($nome, $senha);

    $turmas = $u->busca_todas_turmas($dados_professor['idProfessor']);

?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Seleção de Documentos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    
    <div>
        <a href="home.php" class="btn btn-primary">Voltar</a>
        <h1>Lista das suas turmas</h1>
        
        <div class="tela">
            <?php 
            if(!empty($turmas)){
                for($i = 0; $i < count($turmas); $i++){  
                    $grupos = $u->busca_todos_grupos($turmas[$i]['idTurma']); 
                    ?>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $turmas[$i]['idTurma']; ?>"><?php echo $turmas[$i]['nomeTurma']; ?></button>

                     <!-- MODAL -->
                    <div class="modal fade" id=<?php echo $turmas[$i]['idTurma']; ?> tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Informações da turma</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table">
                                        <tr>
                                            <th>ID da turma</th>
                                            <th>Nome da turma</th>
                                            <th>Professor responsável</th>
                                        </tr>
                                        <tr class="bg-secondary text-white">
                                            <td><?php echo $turmas[$i]['idTurma']; ?></td>
                                            <td><?php echo $turmas[$i]['nomeTurma']; ?></td>
                                            <td><?php echo $turmas[$i]['nomeProfessor']; ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="4" class="text-center pt-5">Grupos dessa turma</th>
                                        </tr>
                                        <tr>
                                            <th>Nome</th>
                                            <th>E-mail</th>
                                            <th>Data cadastro</th>
                                            <th>Entregas</th>
                                        </tr>
                                        <?php 
                                            if(!empty($grupos)){
                                                foreach($grupos as $grupo){
                                        ?>
                                                    <tr class="bg-secondary text-white">
                                                        <td><?php echo $grupo['nomeGrupo']; ?></td>
                                                        <td><?php echo $grupo['emailGrupo']; ?></td>
                                                        <td><?php echo date("d/m/Y", strtotime($grupo['dataCadastro'])); ?></td>
                                                        <td><a class="btn btn-primary" href="ver_documentos_prof.php?id_grupo=<?php echo $grupo['idGrupo']?>" target="_blank">Ver entregas</a></td>
                                                    </tr>
                                        <?php 
                                                }
                                            } else{ 
                                        ?>
                                                <tr class="bg-secondary text-white">Não existem grupos cadastrados nessa turma</tr>
                                        <?php 
                                            } 
                                        ?>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php 
                } 
            }else{
                echo "<h2>Você não possui nenhuma turma! Deseja criar alguma? </h2>";
                echo "<h2><a href='./cadastro_turma.php'>Criar turma</a></h2>";
            }
            ?>
        </div>
    </div>
</body>
</html>

