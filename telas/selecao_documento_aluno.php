<!-- Somente os alunos têm acesso a essa página (comentário necessário após eu confundir isso duas vezes e perder tempo) -->
<!DOCTYPE html>
<?php
    date_default_timezone_set ("America/Sao_Paulo");

    include("../conexao/conn.php");    
    $u = new database;
    $u->conectar();

    session_start();
    if((!isset($_SESSION['nome'])) and (!isset($_SESSION['senha'])))  {
        unset($_SESSION['nome']);
        unset($_SESSION['senha']);

        echo "<script>alert('Você não pode entrar aqui sem logar!!!!!!')</script>";

        echo "<script>location.href='escolha_login.php';</script>";
    }
    $logado = $_SESSION['nome'];
    $id_turma = $_SESSION['id_turma'];
    $id_grupo = $_SESSION['id_grupo'];

    $arquivos_enviados = $u->busca_arquivos($id_grupo);
    $todos_docs = $u->busca_docs_a_entregar($id_turma);
    $informacoes_professor = $u->busca_prof($id_turma);

    $nome_grupo = $logado;
    $nome_professor = $informacoes_professor['nomeProfessor'];

    $email_grupo = $_SESSION['email_grupo'];
    $email_professor = $informacoes_professor['emailProfessor'];

    // IMPORTAÇÕES DO PHPMailer
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require('../lib/vendor/autoload.php');

    $mail = new PHPMailer(true);

    // COMEÇO LÓGICA DE ENVIO DE ARQUIVOS
    if(isset($_FILES['arquivo'])){
        $arquivo = $_FILES['arquivo'];

        if($arquivo['error']){
            die("Falha ao enviar arquivo");
        }
        
        if($arquivo['size'] > 2097152){
            die("Arquivo muito grande. Max: 2MB.");
            // multiplicar o $_FILES['size'] por 1.048.576 para obter o valor transformado em mega bytes
        }

        $pasta = "../arquivos/";
        $nomeDoArquivo = $arquivo['name'];
        $novoNomeDoArquivo = uniqid();
        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

        if($extensao != 'docx' && $extensao != 'pdf'){
            die("Tipo de arquivo não aceito");
        }
        
        $path = $pasta . $novoNomeDoArquivo . "." . $extensao;

        $deu_certo = move_uploaded_file($arquivo["tmp_name"], $path);

        if($deu_certo){         
            $tipo_doc = $_POST['tipo_arquivo'];

            $infos_tipo_documento = $u->busca_info_doc($id_turma, $tipo_doc);

            $idDoc = $infos_tipo_documento['idDocumento'];
            $responsavel = $logado; 

            $dataEntrega = date('Y-m-d H:i:s'); 
            $dataLimite = $infos_tipo_documento['prazoEntrega'];

            $atraso;
            if(strtotime($dataLimite) > strtotime($dataEntrega)){
                $atraso = 0; 
            }else{
                $atraso = 1; 
            }

            $nomeArq = $nomeDoArquivo; 

            $ja_foi_enviado = "n";

            if(!empty($arquivos_enviados)){
                for($i = 0; $i < count($arquivos_enviados); $i++){
                    if($arquivos_enviados[$i]['tipoDocumento'] == $tipo_doc){
                        $ja_foi_enviado = "s";
                    }
                }
            }
            
            if($ja_foi_enviado == "n"){
                if($u->registra_entrega($idDoc, $id_grupo, $responsavel, $dataEntrega, $atraso, $nomeArq, $path)){

                    // COMEÇO LÓGICA DE NOTIFICAÇÃO POR EMAIL
                    $título_email = "";
                    $corpo_email = "";
                    $corpo_alternativo = "";

                    if($tipo_doc != "final"){
                        $título_email = "Entrega do ".$tipo_doc." documento do projeto.";

                        $corpo_email = "Olá professor! Nós da TCCENTRALZIER notificamos que o grupo ".$nome_grupo." realizou a entrega do <b>".$tipo_doc."</b> documento do projeto!";

                        $corpo_alternativo = "Olá professor! Nós da TCCENTRALZIER notificamos que o grupo ".$nome_grupo." realizou a entrega do ".$tipo_doc." documento do projeto!";
                    }else{
                        $título_email = "Entrega do documento ".$tipo_doc." do projeto.";
                        $corpo_email = "Olá professor! Nós da TCCENTRALZIER notificamos que o grupo ".$nome_grupo." realizou a entrega do documento <b>".$tipo_doc."</b> do projeto! Agora você já pode corrigir.";
                        $corpo_alternativo = "Olá professor! Nós da TCCENTRALZIER notificamos que o grupo ".$nome_grupo." realizou a entrega do documento ".$tipo_doc." do projeto!";
                    }

                    try {
                        $mail->SMTPDebug = SMTP::DEBUG_SERVER; 
                        $mail->CharSet = 'UTF-8';                     
                        $mail->isSMTP();                                           
                        $mail->Host       = 'smtp.mailtrap.io';                     
                        $mail->SMTPAuth   = true;                                   
                        $mail->Username   = '07ce7b144095e4';                  
                        $mail->Password   = '53972c0ac66884';                               
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            
                        $mail->Port       = 2525;          
                        
                        $mail->setFrom("$email_grupo", "$nome_grupo");
                        $mail->addAddress("$email_professor", "$nome_professor");    
                        
                        $mail->isHTML(true);                                 
                        $mail->Subject = "$título_email";
                        $mail->Body    = "$corpo_email";
                        $mail->AltBody = "$corpo_alternativo";
                    
                        $mail->send();
                        echo 'E-mail enviado com sucesso!';
                    } catch (Exception $e) {
                        echo "Erro. Não foi possível enviar o e-mail. Error PHPMailer: {$mail->ErrorInfo}";
                        // echo "Erro. Não foi possível enviar o e-mail.";
                    }

                    header("Refresh: 0");
                    echo "<script>alert('Arquivo enviado com sucesso!')</script>";
                }else{
                    echo "<p>Falha ao salvar caminho do arquivo no banco de dados!</p>";
                }
            }else{
                header("Refresh: 0");
                echo "<script>alert('Esse tipo de documento já foi enviado anteriormente!')</script>";
            }
        }else{
            echo "<p>Falha ao enviar arquivo.</p>";
        }
    }
?>


<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../css/style.css"> -->
    <title>Seleção de Documento</title>
</head>
<body>
    <h1>Arquivos a entregar</h1>
    <table border="1" cellpadding="10">
        <thead>
            <th>Tipo de documento</th>
            <th>Prazo limite</th>
        </thead>
        <tbody>
            <?php 
            if(!empty($todos_docs)){
                for($i = 0; $i < count($todos_docs); $i++){
            ?>
            <tr>
                <td><?php echo $todos_docs[$i]['tipoDocumento']; ?></td>
            
                <td><?php echo date("d/m/Y H:i", strtotime($todos_docs[$i]['prazoEntrega']));
                ?></td>
            </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
    <br>
    <hr>
    <form method="POST" enctype="multipart/form-data">
        <p>
            <label for="tipo_arquivo">Selecione o tipo de arquivo que deseja enviar</label>
            <select name="tipo_arquivo" required>
                <option value="primeiro">Primeira entrega</option>
                <option value="segundo">Segunda entrega</option>
                <option value="terceiro">Terceira entrega</option>
                <option value="quarto">Quarta entrega</option>
                <option value="final">Entrega Final</option>
            </select>
        </p>
        <p>
            <label for="arquivo">Selecione o arquivo</label>
            <input name="arquivo" type="file">
        </p>
        <button type="submit">Enviar arquivo</button>
    </form>

    <h1>Arquivos enviados</h1>
    <table border="1" cellpadding="10">
        <thead>
            <th>Arquivo</th>
            <th>Data de envio</th>
            <th>Prazo limite</th>
            <th>Tipo de documento</th>
            <th>Entregue com atraso</th>
        </thead>
        <tbody>
            <?php 
            if(!empty($arquivos_enviados)){
                for($i = 0; $i < count($arquivos_enviados); $i++){
            ?>
            <tr>
                <td><a target="_blank" href="<?php echo $arquivos_enviados[$i]['path']; ?>"><?php echo $arquivos_enviados[$i]['nomeArquivo']; ?></a></td>

                <td><?php echo date("d/m/Y H:i", strtotime($arquivos_enviados[$i]['dataEntrega'])); ?></td>

                <td><?php echo date("d/m/Y H:i", strtotime($arquivos_enviados[$i]['prazoEntrega']));
                ?></td>

                <td><?php echo $arquivos_enviados[$i]['tipoDocumento']; ?></td>

                <td><?php if($arquivos_enviados[$i]['atraso'] == 1){echo "Sim";}else{echo "Não";} ?></td>
            </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</body>
</html>