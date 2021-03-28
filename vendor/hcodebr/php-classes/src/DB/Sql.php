<?php 

namespace Hcode\DB;

class Sql {

	const HOSTNAME = "sql136.main-hosting.eu";
	const USERNAME = "u877054759_root";
	const PASSWORD = "0155Gato";
	const DBNAME = "u877054759_ecommerce";

	private $conn;

	public function __construct()
	{
		try {
            $this->conn = new \PDO(
				"mysql:dbname=".Sql::DBNAME.";host=".Sql::HOSTNAME, 
				Sql::USERNAME,
				Sql::PASSWORD
			);
            echo "Conectado com sucesso.";
        } catch (PDOException $pe) {
            die("Não foi possível se conectar ao banco de dados" . $pe->getMessage());
        }

		

	}

	private function setParams($statement, $parameters = array())
	{

		foreach ($parameters as $key => $value) {
			
			$this->bindParam($statement, $key, $value);

		}

	}

	private function bindParam($statement, $key, $value)
	{

		$statement->bindParam($key, $value);

	}

	public function query($rawQuery, $params = array())
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

	}

	public function select($rawQuery, $params = array()):array
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);

	}

}

 ?>