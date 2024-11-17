<?php

	include 'db.php';


	if($_SERVER['REQUEST_METHOD'] == 'GET') {
		// ligação à base de dados
		$db = dbconnect($hostname,$db_name,$db_user,$db_passwd);
		if($db) {	   
			// criar query numa string
			  $query  = "SELECT  * FROM categories";
		 
			// executar a query
			if(!($result = @ mysqli_query($db, $query)))
				showerror($db);
			
			// vai buscar o resultado da query

			$nrows  = mysqli_num_rows($result);
			$categories = [];
			for($i=0; $i<$nrows; $i++)
				$categories[$i] = mysqli_fetch_assoc($result);

			
			// allow cross-origin requests (CORS)
			header('Access-Control-Allow-Origin: *');
			header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
			header("Access-Control-Allow-Headers: Authorization, Origin, User-Token, X-Requested-With, Content-Type");
			// convert to JSON
			$categoriesJSON = json_encode(utf8ize($categories));
			echo $categoriesJSON;
			// fechar a ligaçãbase de dados
			mysqli_close($db);
		}	 
	}

	// allow cross-origin requests (CORS)
	if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Authorization, Origin, User-Token, X-Requested-With, Content-Type");	
	}

	function utf8ize($d) {
		if (is_array($d)) {
			foreach ($d as $k => $v) {
				$d[$k] = utf8ize($v);
			}
		} 
		else if (is_object($d)) {
			foreach ($d as $k => $v) {
				$d->$k = utf8ize($v);
			}
		} 	
		else if (is_string ($d)) {
			return utf8_encode($d);
		}
		return $d;
	}



?>

