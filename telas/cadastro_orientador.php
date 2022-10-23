<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Cadastro Orientador</title>
</head>
<body>
    <form action="../php/dados_orientador.php" method="POST">

        <label for="nomeOrientador">Nome Completo</label>
        <input required autofocus type="text" name="nomeOrientador" id="nomeOrientador" class="form-control">
        <br>


        <label for="senhaOrientador">Senha</label>
        <input required type="password" name="senhaOrientador" id="senhaOrientador" class="form-control">
        <br>

        <label for="emailOrientador">Email</label>
        <input required autofocus type="email" name="emailOrientador" id="emailOrientador" class="form-control">
        <br>


        <label for="dataCadastroOrientador">Data de Cadastro</label>
        <input readonly type="date" name="dataCadastroOrientador" id="dataCadastroOrientador" class="form-control" value=<?php echo date('Y-m-d H:i:s'); ?>>
        <br>

        <button class="btn btn-lg btn-primary btn-block" name="btn-cadastrar">Cadastrar</button>
        <a class="btn btn-lg btn-primary btn-block" href="escolha_cadastro.php">Voltar</a>

    </form>

</body>
</html>