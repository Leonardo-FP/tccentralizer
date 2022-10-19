<?php

class database
{
	private $con;
	public $msgErro = "";
	public function conectar()
	{
		global $con;
		try {
			$con = new PDO('mysql:host=109.106.251.136:3306;dbname=tccentra_tccentralizer', 'tccentra_leo', '12345');
		} catch (PDOException $e) {
			$msgErro = $e->getMessage();
		}
	}

    public function verifica_login($nome, $senha, $usuario)
    {
        if($usuario == "grupo"){
            global $con;
            $sql = $con->prepare("SELECT * FROM tccentra_tccentralizer.grupo WHERE nomeGrupo = :nomeGrupo AND senhaGrupo = :senhaGrupo");
            $sql->bindValue(":nomeGrupo", $nome);
            $sql->bindValue(":senhaGrupo", $senha);
            $sql->execute();
    
            if ($sql->rowCount() == 0) {
                return false;
            }else{
                return true;
            }
        }else if($usuario == "orientador"){
            global $con;
            $sql = $con->prepare("SELECT * FROM tccentra_tccentralizer.professor WHERE nomeProfessor = :nomeProfessor AND senhaProfessor = :senhaProfessor");
            $sql->bindValue(":nomeProfessor", $nome);
            $sql->bindValue(":senhaProfessor", $senha);
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
        $sql = $con->prepare("SELECT * FROM tccentra_tccentralizer.grupo WHERE nomeGrupo = :nomeGrupo AND senhaGrupo = :senhaGrupo");
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
        $sql = $con->prepare("SELECT * FROM tccentra_tccentralizer.professor WHERE nomeProfessor = :nomeProfessor AND senhaProfessor = :senhaProfessor");
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

    public function busca_antiga_orientador($logado){
        global $con;

        $sql = $con->prepare("SELECT * FROM tccentra_tccentralizer.professor WHERE nomeProfessor = :nomeProfessor");

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

        $sql = $con->prepare("SELECT * FROM tccentra_tccentralizer.grupo WHERE nomeGrupo = :nomeGrupo");

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

        $sql = $con->prepare("UPDATE tccentra_tccentralizer.professor
                            SET senhaProfessor = :nova_senha
                            WHERE nomeProfessor = :logado;");

        $sql->bindValue(":nova_senha", $nova_senha);
        $sql->bindValue(":logado", $logado);

        $sql->execute();

        return true;
    }

    public function muda_senha_grupo($nova_senha, $logado){
        global $con;

        $sql = $con->prepare("UPDATE tccentra_tccentralizer.grupo
                            SET senhaGrupo = :nova_senha
                            WHERE nomeGrupo = :logado;");

        $sql->bindValue(":nova_senha", $nova_senha);
        $sql->bindValue(":logado", $logado);

        $sql->execute();

        return true;
    }

    public function busca_arquivos($id_grupo){
        global $con;

        $sql = $con->prepare("SELECT * FROM tccentra_tccentralizer.entrega AS ent
                                JOIN tccentra_tccentralizer.documento AS doc ON ent.idDocumento = doc.idDocumento
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

        $sql = $con->prepare("INSERT INTO tccentra_tccentralizer.entrega (idDocumento, idGrupo, usuarioResponsavel, dataEntrega, atraso, nomeArquivo, path) VALUES (:idDoc, :idGrupo, :responsavel, :dataEntrega, :atraso, :nomeArq, :path);");

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

        $sql = $con->prepare("SELECT * FROM tccentra_tccentralizer.documento WHERE idTurma = :id_turma AND tipoDocumento = :tipo_doc");

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

        $sql = $con->prepare("SELECT * FROM tccentra_tccentralizer.documento WHERE idTurma = :id_turma");

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
                                FROM tccentra_tccentralizer.professor AS prof
                                JOIN tccentra_tccentralizer.turma AS turm ON (prof.idProfessor = turm.fk_idProfessor)
                                JOIN tccentra_tccentralizer.grupo AS grup ON (turm.idTurma = grup.idTurma)
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

        $sql = $con->prepare("SELECT turm.idTurma, turm.nomeTurma, prof.nomeProfessor FROM tccentra_tccentralizer.turma turm
                            JOIN tccentra_tccentralizer.professor AS prof ON turm.fk_idProfessor = prof.idProfessor
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
                                FROM tccentra_tccentralizer.grupo
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
    
}