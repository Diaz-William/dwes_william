<?php
//--------------------------------------------------------------------------
    // Función para limpiar la entrada de datos del usuario.
	function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
//--------------------------------------------------------------------------
    // Función para realizar la conexión con la base de datos.
    function realizarConexion($dbname,$servername,$username,$password) {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Conexión fallida: " . $e->getMessage();
        }
        return $conn;
    }
//--------------------------------------------------------------------------
    // Función para cerrar la conexión con la base de datos.
    function cerrarConexion(&$conn) {
        $conn = null;
    }
//--------------------------------------------------------------------------
    // Función para comprobar la existencia del usuario.
    function comprobarUsuario($usuario) {
        try {
            $conn = realizarConexion("cookies","localhost","root","rootroot");
            $select = $conn->prepare("SELECT usuario FROM usuarios WHERE usuario = :usuario");
            $select->bindParam(':usuario', $usuario);
            $select->execute();
            $resultado = $select->fetchColumn();
            $devolver = ($resultado !== false) ? true : false;
            cerrarConexion($conn);
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
        return $devolver;
    }
//--------------------------------------------------------------------------
    // Función para comprobar la contraseña del usuario.
    function comprobarContrasena($usuario, $contrasena) {
        try {
            $conn = realizarConexion("cookies","localhost","root","rootroot");
            $select = $conn->prepare("SELECT contrasena FROM usuarios WHERE usuario = :usuario AND contrasena = :contrasena");
            $select->bindParam(':usuario', $usuario);
            $select->bindParam(':contrasena', $contrasena);
            $select->execute();
            $resultado = $select->fetchColumn();
            $devolver = ($resultado !== false) ? true : false;
            cerrarConexion($conn);
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
        return $devolver;
    }
//--------------------------------------------------------------------------
    // Función para cerrar sesión.
    function cerrarSesion() {
        session_unset();
        session_destroy();
        //setcookie("PHPSESSID", "", time() - 3600, "/");
        header("Location: ./inicio_sesion.php");
    }
//--------------------------------------------------------------------------