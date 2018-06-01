<?php
	function db_connect(){
		$db = NULL;
		

		$dbUrl = getenv('DATABASE_URL');
			
		if (!isset($dbUrl) || empty($dbUrl)){
			echo "in local database<br />";
			$dbUrl = "postgres://postgres:Milk Ham Postgres@localhost:5432/next_due_date"; 
		}

		// setup db
		$dbopts = parse_url($dbUrl);	
		$dbHost = $dbopts["host"];
		$dbPort = $dbopts["port"];
		$dbUser = $dbopts["user"];
		
		$dbPassword = $dbopts["pass"];
		$dbName = ltrim($dbopts["path"],'/');
		$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $db;
	}
?>	