<?php 
    date_default_timezone_set ("America/Sao_Paulo");

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

    $id_grupo = $_GET['id_grupo']; 
    $infos_entrega = $u->busca_arquivos($id_grupo);
    $correcoes_feitas = $u->busca_correcoes();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentos do grupo</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    <div><a href="home.php" class="btn btn-primary">Voltar</a></div>
    <div style="padding: 10px;">
    <?php 
        if(!empty($infos_entrega)){ ?>
            <h1>Arquivos enviados pelo grupo '<?php echo $infos_entrega[0]['usuarioResponsavel']; ?>'</h1>
            <table class="table">
                <thead>
                   <th>Tipo de documento</th>
                    <th>Arquivo</th>
                    <th>Data de envio</th>
                    <th>Prazo limite</th>
                    <th>Entregue com atraso</th>
                    <th>Atribuir nota</th>
                    <th>Notas atribuídas</th>
                </thead>
                <tbody>
                    <?php 
                    if(!empty($infos_entrega)){
                        for($i = 0; $i < count($infos_entrega); $i++){
                            if(!empty($correcoes_feitas)){
                                foreach($correcoes_feitas as $correcao){
                                    if($correcao['idEntrega'] == $infos_entrega[$i]['idEntrega']){
                                        $nota_atribuida = $correcao['nota'];
                                    }
                                }
                            }
                    ?>
                    <tr>
                        <td><?php echo $infos_entrega[$i]['tipoDocumento']; ?></td>

                        <td><a target="_blank" href="<?php echo $infos_entrega[$i]['path']; ?>">Baixar</a></td>

                        <td><?php echo date("d/m/Y", strtotime($infos_entrega[$i]['dataEntrega'])); ?></td>

                        <td><?php echo date("d/m/Y", strtotime($infos_entrega[$i]['prazoEntrega']));
                        ?></td>

                        <td><?php if($infos_entrega[$i]['atraso'] == 1){echo "Sim";}else{echo "Não";} ?></td>

                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $infos_entrega[$i]['idEntrega']; ?>">Abrir</button></td>
                        
                        <form method="POST">
                            <div class="modal fade" id=<?php echo $infos_entrega[$i]['idEntrega']; ?> tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Dê uma nota para essa entrega</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                <input type="hidden" name='dar_nota' readonly>
                                                <input type="hidden" name="id_entrega" value=<?php echo $infos_entrega[$i]['idEntrega']; ?> readonly>

                                                <label for="nota"></label>                                            
                                                <input class="form-control" name="nota" type="number" placeholder="Digite a nota">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="submit" class="btn btn-primary">Salvar</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <td>
                            <?php 
                                if(!empty($nota_atribuida)){
                                    echo number_format($nota_atribuida, 2, '.'); 
                                }else{
                                    echo "Nenhuma nota atribúida";
                                }
                                
                            ?>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        <?php }else{
            echo "O grupo ainda não realizou nenhuma entrega";
        }
    ?>
    </div>
</body>
</html>
<?php 
    if(isset($_POST['dar_nota'])){
        if(!empty($_POST['id_entrega']) && !empty($_POST['nota'])){
            $id_entrega = $_POST['id_entrega'];
            $nota_entrega = $_POST['nota'];

            if($u->nova_correcao($id_entrega, $nota_entrega)){
                echo "<script>alert('Nota enviada com sucesso!')</script>";
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
            }else{
                echo "<script>alert('Não foi possível enviar a nota!')</script>";
            }
        }else{
            echo "Não foi possível capturar os campos necessários.";
        }
    }
?>