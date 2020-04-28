<?php 
	define('DB_SERVER', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'btc3205');
	/**
	 * 
	 */
	class DBConnector
	{

		public $link;
		public $conn;
		function __construct()
		{

			$this->conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die("Error:" .mysqli_error($this->conn));
			
			return $this->conn;
		}
		   function closeDatabase(){
			return mysqli_close($this->conn);
			}
		}
	
 ?>