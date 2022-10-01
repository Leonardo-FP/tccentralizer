<!DOCTYPE html>
<?php
    //Botão Cadastrar
if(isset($_POST['btn-cadastrar'])){
    echo 'clicou';
}

?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Grupo</title>
</head>
<body>
    <form action="../php/dados_grupo.php" method="POST">

        <label for="nomeGrupo">Grupo</label>
        <input type="text" name="nomeGrupo" id="nomeGrupo">
        <br>

        <label for="senhaGrupo">Senha</label>
        <input type="password" name="senhaGrupo" id="senhaGrupo">
        <br>

        <label for="emailGrupo">Email</label>
        <input type="emailGrupo" name="emailGrupo" id="emailGrupo">
        <br>

        <label for="dataCadastro">Data de Cadastro</label>
        <input type="date" name="dataCadastro" id="dataCadastro">
        <br>

        <button type="submit" name="btn-cadastrar">Cadastrar</button>
    
        <a href="escolha_cadastro.php"><button>voltar</button></a>
</body>
</html>