<?php
	public function registerUser($email, $pwHash, $display){
		$sql = 'INSERT INTO users (email, password, display_name) VALUES (:email, :password, :display_name)';
		$stmt = $this->pdo->prepare($sql);
		
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':password', $pwHash);
		$stmt->bindValue(':display_name', $display);
		
		$stmt->execute();
		
		return $this->pdo->lastInsertId('user_id');
	}
	
	public function loginUser($email, $pwHash, $display){
		
	}
?>