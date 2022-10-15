<!DOCTYPE html>
<?php
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


    $logado = $_SESSION['nome'];
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Seleção de Documentos</title>
</head>
<body>

    <div>
        <h1>Nome do Grupo</h1>

        <div class="tela">
        

        </div>
        
        <br>
        
    
        <input id="botao" class="btn btn-primary" type="button" value="Baixar">
    
        <input id="botao" class="btn btn-primary" type="button" value="Lançar">
    

    </div>
    
    

    


</body>
</html>