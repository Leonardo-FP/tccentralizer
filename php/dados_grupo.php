<?php

include_once('../conexao/db_connect.php');

if(isset($_POST['btn-cadastrar'])){

    $connect = mysqli_connect($servername,$username,$password,$db_name);
    
            $nomeGrupo = mysqli_escape_string($connect, $_POST['nomeGrupo']);

            $nomeTurma = mysqli_escape_string($connect, $_POST['nomeTurma']);

            $senhaGrupo = mysqli_escape_string($connect, $_POST['senhaGrupo']);

            $emailGrupo = mysqli_escape_string($connect, $_POST['emailGrupo']);

            $dataCadastroGrupo = mysqli_escape_string($connect, $_POST['dataCadastroGrupo']);

        //Falta apenas ajustar o INSERT com as tabelas ESTRANGEIRAS

        $sql = "INSERT INTO grupo(idTurma, nomeGrupo, senhaGrupo, emailGrupo, dataCadastro) VALUES 
        (1,'$nomeGrupo', '$senhaGrupo', '$emailGrupo','$dataCadastroGrupo') ";

    if(mysqli_query($connect, $sql)){
        
       
            header('Location: ../index.php?sucesso');

        
    } else 
        header('Location: ../index.php?erro');

}

