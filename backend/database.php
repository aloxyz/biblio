<?php
class Database
	{
	private $host = "mariadb";
	private $db_name = "biblio";
	private $username = "biblio";
	private $password = "biblio";
	public $conn;

	public function getConnection()
		{
		$this->conn = null;
		try
			{
			$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->exec("set names utf8");
			}
		catch(PDOException $exception)
			{
			echo "Errore di connessione: " . $exception->getMessage();
			}
		return $this->conn;
		}
	}
?>