<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticação</title>
</head>
<body>
    <form method="POST" action="../php/teste_login.php">

        <label for="nomeOrientador">Nome do orientador</label>
        <input type="text" name="nomeOrientador">
        <br>

        <label for="senhaOrientador">Senha</label>
        <input type="password" name="senhaOrientador">
        <br>

        <input type="hidden" name="tipo_usuario" value="orientador">

        <button type="submit" name="submitOrientador">Entrar</button>
        <a href="../index.php">Cancelar</a>
    </form>
</body>
</html>
