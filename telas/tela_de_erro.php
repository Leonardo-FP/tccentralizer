<?php 
    $texto = "";
    $redirecionamento = "";
    if($_GET['erro'] == "sem_turma"){
        $texto = "Você precisa escolher uma turma para poder cadastrar seu grupo!";
        $redirecionamento = "<a href='cadastro_grupo.php'>Clique aqui para tentar novamente</a>";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Erro</title>
</head>
<body>
    <h1>ERRO!</h1>
    <h2><?php echo $texto; ?></h1>
    <h3><?php echo $redirecionamento; ?></h2>
</body>
</html>