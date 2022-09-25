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
}