<?php
session_start();

include_once('../conexao/db_connect.php');

if(isset($_POST['btn-cadastrar'])){
    $connect = mysqli_connect($servername,$username,$password,$db_name);
    
    $nomeOrientador = mysqli_escape_string($connect, trim($_POST['nomeOrientador']));
    $senhaOrientador = mysqli_escape_string($connect, trim($_POST['senhaOrientador']));
    $emailOrientador = mysqli_escape_string($connect, trim($_POST['emailOrientador']));
    $dataCadastroOrientador = mysqli_escape_string($connect, trim($_POST['dataCadastroOrientador']));

    $verificar = "SELECT nomeProfessor FROM professor WHERE nomeProfessor = '$nomeOrientador' AND senhaProfessor = '$senhaOrientador'";
    $result = mysqli_query($connect,$verificar);

    if(mysqli_num_rows($result) == 1){
        $_SESSION['usuario_existe'] = true;
        echo "<script>alert('Usuário já cadastrado no sistema!')</script>";
        echo "<script>location.href='../telas/escolha_login.php';</script>";
        exit;
    }else{
        $sql = "INSERT INTO professor(nomeProfessor, senhaProfessor, emailProfessor, dataCadastro) VALUES 
        ('$nomeOrientador', '$senhaOrientador', '$emailOrientador','$dataCadastroOrientador')";
        
        if($connect->query($sql) === true){

            $_SESSION['nome'] = $nomeOrientador;
            $_SESSION['senha'] = $senhaOrientador;
            $_SESSION['usuario'] = "orientador";
            $_SESSION['email_professor'] = $emailOrientador;
    
            header('Location: ../telas/home.php?sucesso');
        } else {
            header('Location: ../index.php?erro'); 
        }
    }
}

