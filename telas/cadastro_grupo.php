<?php 
    include_once('../conexao/conn.php');
    $u = new database;
    $u->conectar();

    $turmas = $u->busca_turmas();
?>
<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro Grupo</title>

    <link rel="stylesheet" href="../css/style.css">
    <title>Cadastro Aluno</title>

</head>
<body>
    <form action="../php/dados_grupo.php" method="POST">

        <label for="nomeGrupo">Nome do Grupo</label>
        <input required autofocus type="text" name="nomeGrupo" id="nomeGrupo" class="form-control">
        <br>

        <label for="nomeGrupo">Escolha uma turma para ingressar</label>
        
        <?php if(!empty($turmas)){ ?>
                <select class="form-control" name="nomeTurma" id="nomeTurma" required autofocus>
                            <option value="SELECIONE" selected>SELECIONE</option>
                    <?php foreach($turmas as $t){ ?>
                            <option value=<?php echo $t['idTurma']; ?>><?php echo $t['nomeTurma']; ?></option>
                    <?php } ?>
                </select>
        <?php  
            }else{
                echo "<h3>Não existem turmas cadastradas! Peça para seu professor criar uma. Até lá, não cadastre seu grupo.</h3>";
            }
        ?>
        <br>

        <label for="senhaGrupo">Senha</label>
        <input required type="password" name="senhaGrupo" id="senhaGrupo" class="form-control">
        <br>

        <label for="emailGrupo">Email</label>
        <input required type="emailGrupo" name="emailGrupo" id="emailGrupo" class="form-control">
        <br>

        <label for="dataCadastroGrupo">Data de Cadastro</label>
        <input readonly type="date" name="dataCadastroGrupo" id="dataCadastroGrupo" class="form-control" value=<?php echo date('Y-m-d H:i:s'); ?>>
        <br>

        <button class="btn btn-lg btn-primary btn-block" type="submit" name="btn-cadastrar">Cadastrar</button>
    
        <a class="btn btn-lg btn-primary btn-block" href="escolha_cadastro.php">Voltar</a>
        
    </form>
    
</body>
</html>