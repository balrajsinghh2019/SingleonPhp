<?php

// Singleton to connect db.
class Connection {
  // Hold the class instance.
  private static $instance = null;
  private $conn;
  
	private $dbPort = '3307';
  private $dbhost = 'localhost';
  private $user = 'root';
  private $pass = 'root';
  private $dbName = 'lab71';
  private $dbTable = 'students';
     
  // The db connection is established in the private constructor.
  private function __construct()
  {
		try {
			$this->conn = new PDO(
				"mysql:host={$this->dbhost}:{$this->dbPort}",
				$this->user,
				$this->pass
			);

		  // set the PDO error mode to exception
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// creating DB if not exist.
			$this->conn->exec("CREATE DATABASE IF NOT EXISTS `{$this->dbName}`;");

			// using created DB
			$this->conn->exec("USE `{$this->dbName}`;");

			// creating student table.
			$this->conn->exec("CREATE TABLE IF NOT EXISTS `{$this->dbTable}` (
				student_id INT AUTO_INCREMENT,
				student_name VARCHAR(255) NOT NULL,
				student_phone VARCHAR(255) NOT NULL,
				PRIMARY KEY (student_id));
			");
		}
		catch(PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
		}
  }
    
  public static function getInstance()
  {
    if(!self::$instance)
    {
      self::$instance = new Connection();
    }
   
    return self::$instance;
  }
    
  public function getConnection()
  {
    return $this->conn;
  }
}
  