<?php
	require "db_connect.php";
	$db = db_connect();
	session_start();
	$_SESSION['error'] = false;
	$_SESSION['err_msg'] = NULL;
	unset($_SESSION['user_id']);
	
	
	// takes user info from form
	// creates a new row if constraints are met
	// returns index of new row
	function registerUser($db, $email, $pwHash){
		
		$sql = 'INSERT INTO users (email, password, creation_date) VALUES (:email, :password, CURRENT_TIMESTAMP) RETURNING user_id';
		$stmt = $db->prepare($sql);
		
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':password', $pwHash);
		
		try {
			$stmt->execute();
		} catch (PDOException $ex){
			$_SESSION['error'] = true;
			$_SESSION['err_msg'] = $ex->getMessage();
			throw $ex;
		}
		$lastIndex = $db->lastInsertId();
		
		$sql = 'INSERT INTO user_preferences (user_id, dark_theme, start_on_mon) VALUES (:user_id, :dark_theme, :start_on_mon)';
		$stmt = $db->prepare($sql);
		
		$stmt->bindValue(':user_id', $lastIndex);
		$stmt->bindValue(':dark_theme', 'f');
		$stmt->bindValue(':start_on_mon', 't');
		$stmt->execute();
		
		return $lastIndex;
	}
	
	// takes user info from form
	// finds index of user row that matches data
	function loginUser($db, $email, $password){
		
		// get the row id where it exists
		$sql = 'SELECT user_id,password FROM users WHERE email=:email';
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':email', $email);
		$stmt->execute();
		$row = $stmt->fetch();
		
		if ($row && password_verify($password, $row['password'])){
			$userId = $row['user_id'];
			echo "User Id: " . $userId . "<br />";
			$_SESSION['error'] = false;
			return $userId;
		} else {
			
			//debug 
			var_dump($row);
			
			$_SESSION['error'] = true;
			$_SESSION['err_msg'] = "invalid password or username";
			throw new Exception("invalid password or username");
		}
	}
	
	// determine if user wants to log in or register
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		
		// get form variables from login page
		$email = $_POST['email'];
		$password = $_POST['password'];
		$pwHash = password_hash($password, PASSWORD_DEFAULT);
		
		if (isset($_POST['login'])) {
			try {
				$user_id = loginUser($db, $email, $password);
				$_SESSION["user_id"] = $user_id;
			} catch (PDOException $ex) {
				$_SESSION['error'] = true;
				$_SESSION['err_msg'] = $ex->getMessage();
			} catch (Exception $ex) {
				$_SESSION['error'] = true;
				$_SESSION['err_msg'] = $ex->getMessage();
			}
		} else {
			try {
				$user_id = registerUser($db, $email, $pwHash);
				$_SESSION["user_id"] = $user_id;
			} catch (PDOException $ex) {
				$_SESSION['error'] = true;
				$_SESSION['err_msg'] = $ex->getMessage();
			}
		}
		header('location:index.php');
	} else {
		header('location:index.php');
	}
?>