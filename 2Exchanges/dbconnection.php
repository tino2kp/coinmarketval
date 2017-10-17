<?php
	class PDOconnectionMVC{
	public function connectionDB(){
		$user='root';
		$password='';
		try{
			$conn = new PDO('mysql:host=localhost;dbname=coinmarketval', $user, $password);

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return $conn;

			}catch(PDOException $e){
				echo "ERROR: " . $e->getMessage();
			}
		}
	}
?>