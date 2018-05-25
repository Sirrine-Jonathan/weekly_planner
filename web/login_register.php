<?php
	function registerUser($email, $pwHash, $display){
		$sql = 'INSERT INTO users (email, password, display_name) VALUES (:email, :password, :display_name)';
		$stmt = pdo.prepare($sql);
		
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':password', $pwHash);
		$stmt->bindValue(':display_name', $display);
		
		$stmt->execute();
		
		return pdo.lastInsertId('user_id');
	}
	
	function loginUser($email, $pwHash, $display){
		
	}
?>