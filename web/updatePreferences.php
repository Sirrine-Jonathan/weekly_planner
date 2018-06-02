<?php
	
	function updatePreferences($db, $dark_theme, $start_on_mon){
		
		$sql = 'UPDATE user_preferences SET start_on_mon = :start_on_mon, dark_theme = :dark_theme WHERE user_id=:user_id';
		$stmt = $db->prepare($sql);
		
		$stmt->bindValue(':start_on_mon', $start_on_mon);
		$stmt->bindValue(':dark_theme', $dark_theme);
		$stmt->bindValue(':user_id', $_SESSION['user_id']);
		$stmt->execute();
	}
?>