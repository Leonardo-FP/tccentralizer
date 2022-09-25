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

        <label for="nomeGrupo">Nome do grupo</label>
        <input type="text" name="nomeGrupo">
        <br>

        <label for="senhaGrupo">Senha</label>
        <input type="password" name="senhaGrupo">
        <br>

        <input type="hidden" name="tipo_usuario" value="grupo">

        <button type="submit" name="submitGrupo">Entrar</button>
        <a href="../index.php">Cancelar</a>
    </form>

    <div >
        <a href="sair.php">Sair</a>
    </div>
    
</body>
</html>
