<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Autenticação</title>
</head>
<body>
    <form method="POST" action="../php/teste_login.php">

        <label for="nomeGrupo">Nome do grupo</label>
        <input autofocus required type="text" name="nomeGrupo" class="form-control">
        <br>

        <label for="senhaGrupo">Senha</label>
        <input required type="password" name="senhaGrupo" class="form-control">
        <br>

        <input type="hidden" name="tipo_usuario" value="grupo">

        <button type="submit" name="submitGrupo" class="btn btn-lg btn-primary btn-block">Entrar</button>
        <a href="../index.php">Cancelar</a>
    </form>
</body>
</html>
