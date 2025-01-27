<?php
    define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', 'rootroot');
	define('DB_DATABASE', 'employees');
    
    function conectar() {
		try {
			$conexion = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_DATABASE, DB_USERNAME,DB_PASSWORD); 	 	 	 	 	
			$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 	 	 	 	 	 	
			return $conexion;
		} catch (PDOException $e) {
			echo $e->getMessage(); 	 	 	 	 	 	
		}
	}
?>