<?php

class database
{
	private $con;
	public $msgErro = "";
	public function conectar()
	{
		global $con;
		try {
			$con = new PDO("mysql:dbname=" . "" . ";host=" . "localhost", "root", "");
		} catch (PDOException $e) {
			$msgErro = $e->getMessage();
		}
	}

    public function verifica_login($nome, $senha, $usuario)
    {
        if($usuario == "grupo"){
            global $con;
            $sql = $con->prepare("SELECT * FROM tccentralizer.grupo WHERE nomeGrupo = :nomeGrupo AND senhaGrupo = :senhaGrupo");
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
            $sql = $con->prepare("SELECT * FROM tccentralizer.professor WHERE nomeProfessor = :nomeProfessor AND senhaProfessor = :senhaProfessor");
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
        $sql = $con->prepare("SELECT * FROM tccentralizer.grupo WHERE nomeGrupo = :nomeGrupo AND senhaGrupo = :senhaGrupo");
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

    public function busca_antiga_orientador($logado){
        global $con;

        $sql = $con->prepare("SELECT * FROM tccentralizer.professor WHERE nomeProfessor = :nomeProfessor");

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

        $sql = $con->prepare("SELECT * FROM tccentralizer.grupo WHERE nomeGrupo = :nomeGrupo");

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

        $sql = $con->prepare("UPDATE tccentralizer.professor
                            SET senhaProfessor = :nova_senha
                            WHERE nomeProfessor = :logado;");

        $sql->bindValue(":nova_senha", $nova_senha);
        $sql->bindValue(":logado", $logado);

        $sql->execute();

        return true;
    }

    public function muda_senha_grupo($nova_senha, $logado){
        global $con;

        $sql = $con->prepare("UPDATE tccentralizer.grupo
                            SET senhaGrupo = :nova_senha
                            WHERE nomeGrupo = :logado;");

        $sql->bindValue(":nova_senha", $nova_senha);
        $sql->bindValue(":logado", $logado);

        $sql->execute();

        return true;
    }

    public function busca_arquivos($id_grupo){
        global $con;

        $sql = $con->prepare("SELECT * FROM tccentralizer.entrega AS ent
        JOIN tccentralizer.documento AS doc ON ent.idDocumento = doc.idDocumento
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

        $sql = $con->prepare("INSERT INTO tccentralizer.entrega (idDocumento, idGrupo, usuarioResponsavel, dataEntrega, atraso, nomeArquivo, path) VALUES (:idDoc, :idGrupo, :responsavel, :dataEntrega, :atraso, :nomeArq, :path);");

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

        $sql = $con->prepare("SELECT * FROM tccentralizer.documento WHERE idTurma = :id_turma AND tipoDocumento = :tipo_doc");

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

        $sql = $con->prepare("SELECT * FROM tccentralizer.documento WHERE idTurma = :id_turma");

        $sql->bindValue(":id_turma", $id_turma);

        $sql->execute();

        $lista = $sql->fetchAll();

        if ($sql->rowCount() > 0) {
            return $lista;
        }else{
            return false;
        }
    }
    
}