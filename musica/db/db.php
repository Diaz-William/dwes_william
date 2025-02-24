<?php
    define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', 'rootroot');
	define('DB_DATABASE', 'musica');
    
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

<?php
    // Definir constantes para la configuración de la base de datos.
    define('DB_SERVER', 'localhost'); // Servidor de la base de datos.
    define('DB_USERNAME', 'root'); // Nombre de usuario para la conexión.
    define('DB_PASSWORD', 'rootroot'); // Contraseña del usuario.
    define('DB_DATABASE', 'musica'); // Nombre de la base de datos a utilizar.

    /**
     * Establece una conexión a la base de datos usando PDO.
     * 
     * @return PDO|void Objeto PDO si la conexión es exitosa, o imprime un mensaje de error en caso contrario.
     */
    /*function conectar() {
        try {
            // Crear una nueva instancia de PDO con los parámetros de conexión.
            $conexion = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
            
            // Configurar PDO para que lance excepciones en caso de error.
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $conexion; // Retornar el objeto de conexión.
        } catch (PDOException $e) {
            // Capturar y mostrar cualquier error de conexión.
            echo "Error de conexión: " . $e->getMessage();
        }
    }
?>