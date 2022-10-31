<?php
session_start();

include_once('../conexao/db_connect.php');
include_once('../conexao/conn.php');

include_once('../conexao/conn.php');
$u = new database;
$u->conectar();

if(isset($_POST['btn-cadastrar'])){
    if($_POST['nomeTurma'] != "SELECIONE"){
        $connect = mysqli_connect($servername,$username,$password,$db_name);

        $id_turma = mysqli_escape_string($connect, $_POST['nomeTurma']);

        $nomeGrupo = mysqli_escape_string($connect, $_POST['nomeGrupo']);

        $senhaGrupo = mysqli_escape_string($connect, $_POST['senhaGrupo']);

        $emailGrupo = mysqli_escape_string($connect, $_POST['emailGrupo']);

        $dataCadastroGrupo = mysqli_escape_string($connect, $_POST['dataCadastroGrupo']);

$verificar = "SELECT nomeGrupo FROM grupo WHERE nomeGrupo = '$nomeGrupo' AND senhaGrupo = '$senhaGrupo'";

$result = mysqli_query($connect,$verificar);

        if(mysqli_num_rows($result) == 1){

            $_SESSION['grupo_existe'] = true;
            echo "<script>alert('Grupo já cadastrado no sistema!')</script>";
            echo "<script>location.href='../telas/escolha_login.php';</script>";
            exit;
        }   
        $sql = "INSERT INTO grupo(idTurma, nomeGrupo, senhaGrupo, emailGrupo, dataCadastro) VALUES 
        ('$id_turma','$nomeGrupo', '$senhaGrupo', '$emailGrupo','$dataCadastroGrupo')";


        if($connect->query($sql) === true){

            $_SESSION['nome'] = $nomeGrupo;
            $_SESSION['senha'] = $senhaGrupo;
            $_SESSION['usuario'] = "grupo";
            $_SESSION['email_grupo'] = $emailGrupo;

            $dados_grupo = $u->infos_grupo($nomeGrupo, $senhaGrupo);
            $_SESSION['id_grupo'] = $dados_grupo['idGrupo'];
            $_SESSION['id_turma'] = $dados_grupo['idTurma'];

            header('Location: ../telas/home.php?sucesso');
        }else{
            header('Location: ../telas/tela_de_erro.php?erro=sem_turma');
        }
    }else{
        header('Location: ../telas/tela_de_erro.php?erro=sem_turma');
    }
}