<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro Turma</title>

    <link rel="stylesheet" href="../css/style.css">
    <title>Cadastro Turma</title>

</head>
<body>
    <form action="../php/dados_turma.php" method="POST">

        <label for="nomeTurma">Turma</label>
        <input require autofocus type="text" name="nomeGrupo" id="nomeTurma" class="form-control">
        <br>

        <label for="dataEntPrimeira">Primeira Entrega</label>
        <input require type="date" name="dataEntPrimeira" id="dataEntPrimeira" class="form-control">
        <br>

        <label for="dataEntSegunda">Segunda Entrega</label>
        <input require type="date" name="dataEntSegunda" id="dataEntSegunda" class="form-control">
        <br>

        <label for="dataEntTerceira">Terceira Entrega</label>
        <input require type="date" name="dataEntTerceira" id="dataEntTerceira" class="form-control">
        <br>

        <label for="dataEntQuarta">Quarta Entrega</label>
        <input require type="date" name="dataEntQuarta" id="dataEntQuarta" class="form-control">
        <br>

        <label for="dataEntQuinta">Quinta Entrega</label>
        <input require type="date" name="dataEntQuinta" id="dataEntQuinta" class="form-control">
        <br>

        <button class="btn btn-lg btn-primary btn-block" type="submit" name="btn-cadastrar">Cadastrar</button>
    
        <a class="btn btn-lg btn-primary btn-block" href="escolha_cadastro.php">Voltar</a>
        
    </form>
    
</body>
</html>