<?php
class Contato{

	private $pdo;

	public function __construct(){

			$this->pdo =new PDO("mysql:dbname=blog;host=localhost", "root","");
	}

//CREATE
	public function adicionar($email, $nome = ''){

		//1 passo = verificar se o email já existe
		// 2 passo = adicionar

		if($this->existeEmail($email) == false){
			$sql = "INSERT INTO usuario (nome, email) VALUES (:nome , :email)";
			$sql = $this->pdo->prepare($sql);
			$sql->bindvalue(':nome', $nome);
			$sql->bindvalue(':email', $email);

			$sql->execute();
			return true;

		}else {
			return false;
		}

	}

	//READE
	public function getInfo($id){
		$sql = "SELECT * FROM usuario WHERE id = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindvalue(':id', $id);
		$sql->execute();

		if($sql->rowCount() > 0){
			return $sql->fetch();

		}else{
			return array();
		}


	}


	//READE
	public function getAll(){

		$sql = "SELECT * FROM usuario";
		$sql = $this->pdo->query($sql);

		if($sql->rowCount() > 0){
			return $sql->fetchAll();

		}else{
			return array();
		}


	}


			//UPDATE
	public function editar($nome, $email,$id){
		
			if($this->existeEmail($email) == false){
			$sql = "UPDATE usuario SET nome = :nome, email = :email WHERE id = :id";
			$sql = $this->pdo->prepare($sql);
			$sql->bindvalue(':nome', $nome);
			$sql->bindvalue(':email', $email);
			$sql->bindvalue(':id', $id);
			$sql->execute();
		return true;
}else{
		return false;
}

	}

	//DELETE
	public function excluirPeloEmail($email){
		
			$sql = "DELETE FROM usuario WHERE email = :email";
			$sql = $this->pdo->prepare($sql);
			$sql->bindvalue(':email', $email);
			$sql->execute();

	}


	public function excluirPeloId($id){
		
			$sql = "DELETE FROM usuario WHERE id = :id";
			$sql = $this->pdo->prepare($sql);
			$sql->bindvalue(':id', $id);
			$sql->execute();

	}
	private function existeEmail($email){

		$sql = "SELECT * FROM usuario WHERE email = :email";
		$sql = $this->pdo->prepare($sql);
		$sql->bindvalue(':email', $email);
		$sql->execute();

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}



}

?>