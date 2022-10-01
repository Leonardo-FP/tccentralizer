<?php

include_once('../conexao/conn.php');

if(isset($_POST['btn-cadastrar'])){

    global $con;
    
            $nomeGrupo = mysqli_escape_string($con, $_POST['nomeGrupo']);

            $senhaGrupo = mysqli_escape_string($con, $_POST['senhaGrupo']);

            $emailGrupo = mysqli_escape_string($con, $_POST['emailGrupo']);

            $dataCadastro = mysqli_escape_string($con, $_POST['dataCadastro']);


        $sql = "INSERT INTO tccentralizer.grupo(:nomeGrupo, :senhaGrupo, :emailGrupo, :dataCadastro) VALUES 
        ('$nomeGrupo', '$senhaGrupo', '$emailGrupo','$dataCadastro')";

    if(mysqli_query($con, $sql)){
        
        header('Location: ../index.php?sucesso');

    } else{ 
        header('Location: ../index.php?erro');

    }

}

