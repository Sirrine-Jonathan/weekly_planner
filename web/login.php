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
	function registerUser($db, $email, $pwHash, $display){
		
		$sql = 'INSERT INTO users (email, password, display_name, creation_date) VALUES (:email, :password, :display_name, CURRENT_TIMESTAMP) RETURNING user_id';
		$stmt = $db->prepare($sql);
		
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':password', $pwHash);
		$stmt->bindValue(':display_name', $display);
		
		try {
			$stmt->execute();
		} catch (PDOException $ex){
			$_SESSION['error'] = true;
			$_SESSION['err_msg'] = $ex->getMessage();
		}
		$lastIndex = $db->lastInsertId();
		
		$sql = 'INSERT INTO user_preferences (user_id, dark_theme, start_on_mon) VALUES (:user_id, :dark_theme, :start_on_mon)';
		$stmt = $db->prepare($sql);
		
		$stmt->bindValue(':user_id', $lastIndex);
		$stmt->bindValue(':dark_theme', 'f');
		$stmt->bindValue(':start_on_mon', 't');
		
		return $lastIndex;
	}
	
	// takes user info from form
	// finds index of user row that matches data
	function loginUser($db, $email, $pwHash, $display){
		
		$sql = 'SELECT user_id FROM users WHERE email=:email AND password=:password';
		$stmt = $db->prepare($sql);
		
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':password', $pwHash);
		
		$userId = NULL;
		try {
			$userId = $stmt->execute();
		} catch (PDOException $exp){
			$_SESSION['error'] = true;
			$_SESSION['err_msg'] = $ex->getMessage();
		}
		
		return $userId;
	}
	
	// determine if user wants to log in or register
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		
		// get form variables from login page
		$display = $_POST['displayName'];
		$email = $_POST['email'];
		$pwHash = password_hash($_POST['password'], PASSWORD_BCRYPT);
		
		if (isset($_POST['login'])) {
			try {
				$user_id = loginUser($db, $email, $pwHash, $display);
				$_SESSION["user_id"] = $user_id;
				echo "Logged in<br />";
			} catch (PDOException $exp) {
				$_SESSION['error'] = true;
				$_SESSION['err_msg'] = $ex->getMessage();
			}
		} else {
			try {
				$user_id = registerUser($db, $email, $pwHash, $display);
				echo "current user id: " . $user_id . "<br />";
				$_SESSION["user_id"] = $user_id;
				echo "Registered<br />";
			} catch (PDOException $exp) {
				$_SESSION['error'] = true;
				$_SESSION['err_msg'] = $ex->getMessage();
			}
		}
		if (isset($_SESSION['user_id']) && !$_SESSION['error'])
			header('location:index.php');
		else if ($_SESSION['error'])
			echo $_SESSION['err_msg'];
	} else {
		echo "what?";
	}
?>