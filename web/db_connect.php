<?php
	function db_connect(){
		$db = NULL:
		
		try {
		
			$dbUrl = getenv('DATABASE_URL');
				
			if (!isset($dbUrl) || empty($dbURL)){
				$dbUrl = ""; //local url (i.e. postgres://ta_user:ta_pass@localhost:5432/scripture_ta)
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
		
		}
		catch (PDOException $ex) {
			echo "Error connecting to DB. Details: $ex";
			die();
		}
		
		return $db;
	}
?>	