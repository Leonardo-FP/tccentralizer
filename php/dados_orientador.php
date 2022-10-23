<?php
session_start();

include_once('../conexao/db_connect.php');
include_once('../conexao/conn.php');

if(isset($_POST['btn-cadastrar'])){
    $connect = mysqli_connect($servername,$username,$password,$db_name);
    
            $nomeOrientador = mysqli_escape_string($connect, $_POST['nomeOrientador']);

            $senhaOrientador = mysqli_escape_string($connect, $_POST['senhaOrientador']);

            $emailOrientador = mysqli_escape_string($connect, $_POST['emailOrientador']);

            $dataCadastroOrientador = mysqli_escape_string($connect, $_POST['dataCadastroOrientador']);

        $sql = "INSERT INTO professor(nomeProfessor, senhaProfessor, emailProfessor, dataCadastro) VALUES 
        ('$nomeOrientador', '$senhaOrientador', '$emailOrientador','$dataCadastroOrientador')";

    if(mysqli_query($connect, $sql)){
        $_SESSION['nome'] = $nomeOrientador;
        $_SESSION['senha'] = $senhaOrientador;
        $_SESSION['usuario'] = "orientador";
        $_SESSION['email_professor'] = $emailOrientador;

        header('Location: ../telas/home.php?sucesso');
    } else 
        header('Location: ../index.php?erro');
}

