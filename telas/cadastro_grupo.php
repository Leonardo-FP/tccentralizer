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

        <label for="nomeGrupo">Grupo</label>
        <input require autofocus type="text" name="nomeGrupo" id="nomeGrupo" class="form-control">
        <br>

        <label for="senhaGrupo">Senha</label>
        <input require type="password" name="senhaGrupo" id="senhaGrupo" class="form-control">
        <br>

        <label for="emailGrupo">Email</label>
        <input require type="emailGrupo" name="emailGrupo" id="emailGrupo" class="form-control">
        <br>

        <label for="dataCadastroGrupo">Data de Cadastro</label>
        <input require type="date" name="dataCadastroGrupo" id="dataCadastroGrupo" class="form-control">
        <br>

        <button class="btn btn-lg btn-primary btn-block" type="submit" name="btn-cadastrar">Cadastrar</button>
    
        <a class="btn btn-lg btn-primary btn-block" href="escolha_cadastro.php">Voltar</a>
        
    </form>
    
</body>
</html>