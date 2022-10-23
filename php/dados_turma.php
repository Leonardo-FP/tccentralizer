<?php
    session_start();
    if((!isset($_SESSION['nome'])) and (!isset($_SESSION['senha'])))  {
        unset($_SESSION['nome']);
        unset($_SESSION['senha']);

        echo "<script>alert('Você não pode entrar aqui sem logar!!!!!!')</script>";
        echo "<script>location.href='../escolha_login.php';</script>";
    }

    if(($_SESSION['usuario'] == "grupo"))  {
        echo "<script>alert('Essa tela é somente do professor !!!!!!')</script>";
        echo "<script>location.href='home.php';</script>";
    }

    include_once('../conexao/conn.php');
    $u = new database;
    $u->conectar();

    if(isset($_POST['btn-cadastrar'])){
        if(!empty($_POST['nomeTurma']) && !empty($_POST['dataEntPrimeira']) && !empty($_POST['dataEntSegunda']) && !empty($_POST['dataEntTerceira']) && !empty($_POST['dataEntQuarta']) && !empty($_POST['dataEntQuinta'])){

            $nome = $_SESSION['nome'];
            $senha = $_SESSION['senha'];
            $dados_professor = $u->infos_professor($nome, $senha);
            
            $id_professor = $dados_professor['idProfessor'];

            $nome_turma = $_POST['nomeTurma'];

            if($u->cria_nova_turma($nome_turma, $id_professor)){

                $dados_turma = $u->infos_turma($nome_turma, $id_professor);
                $id_turma = $dados_turma['idTurma'];

                $data_primeiro = $_POST['dataEntPrimeira'];
                $data_segundo = $_POST['dataEntSegunda'];
                $data_terceiro = $_POST['dataEntTerceira'];
                $data_quarto = $_POST['dataEntQuarta'];
                $data_final = $_POST['dataEntQuinta'];

                $data_documentos = [
                    0 => $data_primeiro,
                    1 => $data_segundo,
                    2 => $data_terceiro,
                    3 => $data_quarto,
                    4 => $data_final
                ];

                for($i = 0; $i < count($data_documentos); $i++){
                    if($i==0){
                        $tipo_doc = "primeiro";
                    }else if($i==1){
                        $tipo_doc = "segundo";
                    }else if($i==2){
                        $tipo_doc = "terceiro";
                    }else if($i==3){
                        $tipo_doc = "quarto";
                    }else{
                        $tipo_doc = "final";
                    }

                    if(!($u->insere_documentos($id_turma, $id_professor, $tipo_doc, $data_documentos[$i]))){
                        echo "Erro ao inserir o documento na posição ".$i;
                    }
                }

                echo "<script>alert('Turma cadastrada com sucesso!')</script>";
                echo "<script>location.href='../telas/home.php';</script>";
            }
        }
    }
?>