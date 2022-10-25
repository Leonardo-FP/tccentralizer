<?php
date_default_timezone_set ("America/Sao_Paulo");

class database
{
	private $con;
	public $msgErro = "";
	public function conectar()
	{
		global $con;
		try {
            $con = new PDO("mysql:host=109.106.251.136;dbname=tccentra_tccentralizer;","tccentra_leo","12345");
		} catch (PDOException $e) {
			throw new PDOException($e);
		}
	}

    public function verifica_login($nome, $senha, $usuario)
    {
        if($usuario == "grupo"){
            global $con;
            $sql = $con->prepare("SELECT * FROM grupo WHERE nomeGrupo = '". $nome. "' AND senhaGrupo = '". $senha ."'");
            $sql->execute();
    
            if ($sql->rowCount() == 0) {
                return false;
            }else{
                return true;
            }
        }else if($usuario == "orientador"){
            global $con;
            $sql = $con->prepare("SELECT * FROM professor WHERE nomeProfessor = '". $nome. "' AND senhaProfessor = '". $senha ."'");
            $sql->execute();
    
            if ($sql->rowCount() == 0) {
                return false;
            }else{
                return true;
            }
        }
    }

    public function infos_grupo($nome, $senha)
    {
        global $con;
        $sql = $con->prepare("SELECT * FROM grupo WHERE nomeGrupo = :nomeGrupo AND senhaGrupo = :senhaGrupo");
        $sql->bindValue(":nomeGrupo", $nome);
        $sql->bindValue(":senhaGrupo", $senha);
        $sql->execute();

        $lista = $sql->fetch();

        if ($sql->rowCount() > 0) {
            return $lista;
        }else{
            return false;
        }
    }

    public function infos_professor($nome, $senha)
    {
        global $con;
        $sql = $con->prepare("SELECT * FROM professor WHERE nomeProfessor = :nomeProfessor AND senhaProfessor = :senhaProfessor");
        $sql->bindValue(":nomeProfessor", $nome);
        $sql->bindValue(":senhaProfessor", $senha);
        $sql->execute();

        $lista = $sql->fetch();

        if ($sql->rowCount() > 0) {
            return $lista;
        }else{
            return false;
        }
    }

    public function infos_turma($nome_turma, $id_prof)
    {
        global $con;
        $sql = $con->prepare("SELECT * FROM turma WHERE nomeTurma = :nomeTurma AND fk_idProfessor = :idProf");
        $sql->bindValue(":nomeTurma", $nome_turma);
        $sql->bindValue(":idProf", $id_prof);
        $sql->execute();

        $lista = $sql->fetch();

        if ($sql->rowCount() > 0) {
            return $lista;
        }else{
            return false;
        }
    }
    
    public function busca_turmas()
    {
        global $con;
        $sql = $con->prepare("SELECT * FROM turma");
        $sql->execute();

        $lista = $sql->fetchAll();

        if ($sql->rowCount() > 0) {
            return $lista;
        }else{
            return false;
        }
    }

    public function busca_id_turma($nomeTurma)
    {
        global $con;
        $sql = $con->prepare("SELECT idTurma FROM turma WHERE nomeTurma = :nomeTurma");
        $sql->bindValue(":nomeTurma", $nomeTurma);

        $sql->execute();

        $lista = $sql->fetch();

        if ($sql->rowCount() > 0) {
            return $lista;
        }else{
            return false;
        }
    }

    public function busca_antiga_orientador($logado){
        global $con;

        $sql = $con->prepare("SELECT * FROM professor WHERE nomeProfessor = :nomeProfessor");

        $sql->bindValue(":nomeProfessor", $logado);

        $sql->execute();

        $lista = $sql->fetch();

        if ($sql->rowCount() > 0) {
            return $lista;
        }else{
            return false;
        }
    }

    public function busca_antiga_grupo($logado){
        global $con;

        $sql = $con->prepare("SELECT * FROM grupo WHERE nomeGrupo = :nomeGrupo");

        $sql->bindValue(":nomeGrupo", $logado);

        $sql->execute();

        $lista = $sql->fetch();

        if ($sql->rowCount() > 0) {
            return $lista;
        }else{
            return false;
        }
    }

    public function muda_senha_orientador($nova_senha, $logado){
        global $con;

        $sql = $con->prepare("UPDATE professor
                            SET senhaProfessor = :nova_senha
                            WHERE nomeProfessor = :logado;");

        $sql->bindValue(":nova_senha", $nova_senha);
        $sql->bindValue(":logado", $logado);

        $sql->execute();

        return true;
    }

    public function muda_senha_grupo($nova_senha, $logado){
        global $con;

        $sql = $con->prepare("UPDATE grupo
                            SET senhaGrupo = :nova_senha
                            WHERE nomeGrupo = :logado;");

        $sql->bindValue(":nova_senha", $nova_senha);
        $sql->bindValue(":logado", $logado);

        $sql->execute();

        return true;
    }

    public function busca_arquivos($id_grupo){
        global $con;

        $sql = $con->prepare("SELECT * FROM entrega AS ent
                                JOIN documento AS doc ON ent.idDocumento = doc.idDocumento
                                WHERE ent.idGrupo = :idGrupo;");

        $sql->bindValue(":idGrupo", $id_grupo);

        $sql->execute();

        $lista = $sql->fetchAll();

        if ($sql->rowCount() > 0) {
            return $lista;
        }else{
            return false;
        }
    }

    public function registra_entrega($idDoc, $idGrupo, $responsavel, $dataEntrega, $atraso, $nomeArq, $path){
        global $con;

        $sql = $con->prepare("INSERT INTO entrega (idDocumento, idGrupo, usuarioResponsavel, dataEntrega, atraso, nomeArquivo, path) VALUES (:idDoc, :idGrupo, :responsavel, :dataEntrega, :atraso, :nomeArq, :path);");

        $sql->bindValue(":idDoc", $idDoc);
        $sql->bindValue(":idGrupo", $idGrupo);
        $sql->bindValue(":responsavel", $responsavel);
        $sql->bindValue(":dataEntrega", $dataEntrega);
        $sql->bindValue(":atraso", $atraso);
        $sql->bindValue(":nomeArq", $nomeArq);
        $sql->bindValue(":path", $path);

        $sql->execute();

        return true;
    }

    public function busca_info_doc($id_turma, $tipo_doc){
        global $con;

        $sql = $con->prepare("SELECT * FROM documento WHERE idTurma = :id_turma AND tipoDocumento = :tipo_doc");

        $sql->bindValue(":id_turma", $id_turma);
        $sql->bindValue(":tipo_doc", $tipo_doc);

        $sql->execute();

        $lista = $sql->fetch();

        if ($sql->rowCount() > 0) {
            return $lista;
        }else{
            return false;
        }
    }

    public function busca_docs_a_entregar($id_turma){
        global $con;

        $sql = $con->prepare("SELECT * FROM documento WHERE idTurma = :id_turma");

        $sql->bindValue(":id_turma", $id_turma);

        $sql->execute();

        $lista = $sql->fetchAll();

        if ($sql->rowCount() > 0) {
            return $lista;
        }else{
            return false;
        }
    }

    public function busca_prof($id_turma){
        global $con;

        $sql = $con->prepare("SELECT nomeProfessor, emailProfessor 
                                FROM professor AS prof
                                JOIN turma AS turm ON (prof.idProfessor = turm.fk_idProfessor)
                                JOIN grupo AS grup ON (turm.idTurma = grup.idTurma)
                                WHERE grup.idTurma = :id_turm;");

        $sql->bindValue(":id_turm", $id_turma);

        $sql->execute();

        $lista = $sql->fetch();

        if ($sql->rowCount() > 0) {
            return $lista;
        }else{
            return false;
        }
    }

    public function busca_todas_turmas($id_professor){
        global $con;

        $sql = $con->prepare("SELECT turm.idTurma, turm.nomeTurma, prof.nomeProfessor FROM turma turm
                            JOIN professor AS prof ON turm.fk_idProfessor = prof.idProfessor
                            WHERE fk_idProfessor = :id_prof;");

        $sql->bindValue(":id_prof", $id_professor);

        $sql->execute();

        $lista = $sql->fetchAll();

        if ($sql->rowCount() > 0) {
            return $lista;
        }else{
            return false;
        }
    }
    
    public function busca_todos_grupos($id_turma){
        global $con;

        $sql = $con->prepare("SELECT idGrupo, nomeGrupo, emailGrupo, dataCadastro 
                                FROM grupo
                                WHERE idTurma = :id_turm;");

        $sql->bindValue(":id_turm", $id_turma);

        $sql->execute();

        $lista = $sql->fetchAll();

        if ($sql->rowCount() > 0) {
            return $lista;
        }else{
            return false;
        }
    }

    public function nova_correcao($id_entrega, $nota_entrega){
        global $con;
        $data_correcao = date('Y-m-d H:i:s');

        $sqlSelect = $con->prepare("SELECT * FROM correcao WHERE idEntrega = :id_entrega;");
        $sqlSelect->bindValue(":id_entrega", $id_entrega);
        
        if($sqlSelect->rowCount() > 0) {
            $sql = $con->prepare("UPDATE correcao SET dataAtualizacao = :dataAtt, nota = :nota WHERE idEntrega = :id_entrega;");

            $sql->bindValue(":id_entrega", $id_entrega);
            $sql->bindValue(":nota_entrega", $nota_entrega);
            $sql->bindValue(":data_correcao", $data_correcao);

            $sql->execute();

            return true;
        }else{
            $sql = $con->prepare("INSERT INTO correcao (idEntrega, dataCorrecao, nota) VALUES (:id_entrega, :data_correcao, :nota_entrega);");

            $sql->bindValue(":id_entrega", $id_entrega);
            $sql->bindValue(":nota_entrega", $nota_entrega);
            $sql->bindValue(":data_correcao", $data_correcao);
    
            $sql->execute();

            return true;
        }
    }

    public function busca_correcoes(){
        global $con;

        $sql = $con->prepare("SELECT * FROM correcao;");

        $sql->execute();

        $lista = $sql->fetchAll();

        if ($sql->rowCount() > 0) {
            return $lista;
        }else{
            return false;
        }
    }

    public function cria_nova_turma($nome_turma, $id_professor){
        global $con;

        $sql = $con->prepare("INSERT INTO turma (nomeTurma, fk_idProfessor) VALUES (:nome_turma, :id_prof);");

        $sql->bindValue(":nome_turma", $nome_turma);
        $sql->bindValue(":id_prof", $id_professor);

        $sql->execute();

        return true;
    }

    public function insere_documentos($id_turma, $id_professor, $tipo_doc, $data_documento){
        global $con;

        $sql = $con->prepare("INSERT INTO documento (idTurma, idProfessor, tipoDocumento, prazoEntrega) VALUES (:idTurma, :id_prof, :tipoDoc, :prazoEntrega);");

        $sql->bindValue(":idTurma", $id_turma);
        $sql->bindValue(":id_prof", $id_professor);
        $sql->bindValue(":tipoDoc", $tipo_doc);
        $sql->bindValue(":prazoEntrega", $data_documento);

        $sql->execute();

        return true;
    }

    public function busca_todas_entregas($id_grupo){
        global $con;

        $sql = $con->prepare("SELECT * FROM entrega AS ent
                                LEFT JOIN correcao AS corr ON ent.idEntrega = corr.idEntrega
                                WHERE idGrupo = :id_grupo;");

        $sql->bindValue(":id_grupo", $id_grupo);

        $sql->execute();

        $lista = $sql->fetchAll();

        if ($sql->rowCount() > 0) {
            return $lista;
        }else{
            return false;
        }
    }
    
}