<?php  

	define('DB_SERVER', 'localhost');
	define('DB_USERNAME','root');
	define('DB_PASSWORD','root');
	define('DB_DATABASE','student');


	class Database{
		private $conn;

		public function getConnection(){
			$this->conn=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	
			if ($this->conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			return $this->conn;
		}
	}


?>