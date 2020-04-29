<?php

include "Crud.php";
include "authenticator.php";
include_once 'DBConnector.php';
class User implements Crud{
	private $user_id;
	private $first_name;
	private $last_name;
	private $city_name;

	private $username;
	private $password;

	function __construct($first_name,$last_name,$city_name,$username,$password) {
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->city_name = $city_name;
		$this->username = $username;
		$this->password = $password;

	}

	public static function create(){
		$instance = new self();
		return $instance;
	}

	public function setUsername ($username){

		$this->username;
	}

	public function getUsername ($username){

		$this->username;
	}

	public function setPassword ($password){

		$this->password;
	}

	public function getPassword ($password){

		$this->password;
	}


	public function setUserId($user_id){
		$this->user_id = $user_id;
	}

	public function getUserId($user_id){
		$this->user_id = $user_id;
	}
	public function openConnection(){
		$conn = new DBConnector;
		return $conn->__construct();
	}
	public function closeConnection(){
		$conn = new DBConnector;
		return $conn->closeDatabase();
	}
	

	public function save ()
	{
		$fn = $this->first_name;
		$ln = $this->last_name;
		$city = $this->city_name;
		$uname = $this->username;
		$this->hashPassword();
		$pass = $this->password;
		$link= $this->openConnection();
		$res = mysqli_query($link,"INSERT INTO user(first_name,last_name,user_city, username, password) VALUES('$fn','$ln','$city', '$uname', '$pass')") or die("Error: " .mysqli_error($link));
		$this->closeConnection();
		return $res;

	}

	public function isUserExist(){

			$uname = $this->username;

			$conn = new DBConnector;

			$found = false;

			$res = mysqli_query($conn->conn,"SELECT * FROM user") or die ("Error" .mysqli_error());



			while($row = mysqli_fetch_array($res)){

				if($row['username'] == $uname){

					$found = true;

				}

			}

			$conn -> closeDatabase();

			return $found;

		}
		public function readAll(){
			
			return null;
		}
		public function readUnique(){
			
			return null;
			
		}
		public function search(){
			return null;
		}
		public function update(){
			return null;
		}
		public function removeOne(){
			return null;
		}
		public function removeAll(){
			return null;
		}

		public function validateForm(){
			$fn = $this->first_name;
		$ln = $this->last_name;
		$city = $this->city_name;

		if($fn =="" || $ln == "" || $city == ""){
			return false;
		}
		return true;
		}
		public function createFormErrorSessions(){

		session_start();
		$_SESSION['form_errors'] = "All fields are required";
		}

		public function hashPassword(){

		$this->password = password_hash($this->password, PASSWORD_DEFAULT);
	}
	public function isPasswordCorrect(){

		$con = new DBConnector;
		$found = false ;
		$res = mysqli_query("SELECT * FROM user") or die("Error" .mysqli_error());
		while  ($row = mysqli_fetch_array($res))
		{

			if(password_verify($this->getPassword(), $row['password']) && $this->getUsername() == $row ['username']){
				$found == true;

			}
		}
		$con->closeDatabase();
				//return $found;
			
				
				return $true;
		
	
	}

	public function login(){
		if ($this->isPasswordCorrect()){
			header ("Location:private_page.php");
		}
	}

	public function createUserSession(){
		session_start();
		$_SESSION['username'] =$this->getUsername();
	}

	public function logout(){

		session_start();
		unset($_SESSION['username']);
		session_destroy();
		header("Location:lab1.php");
	}
}
?>