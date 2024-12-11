<?php
//--------------------------------------------------------------------------
    // Función para limpiar la entrada de datos del usuario.
	function test_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }
//--------------------------------------------------------------------------
    // Función para realizar la conexión con la base de datos.
    function realizarConexion($dbname, $servername, $username, $password) {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            exit("No se pudo conectar a la base de datos.");
        }
    }
//--------------------------------------------------------------------------
    // Función para cerrar la conexión con la base de datos.
    function cerrarConexion(&$conn) {
        $conn = null;
    }
//--------------------------------------------------------------------------
    // Función para empezar la transacción.
    function empezarTransaccion($conn) {
        try {
            if ($conn) {
                $conn->beginTransaction();
            }
        } catch (PDOException $e) {
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para realizar un commit o validar los cambios de la base de datos.
    function validar($conn) {
        try {
            if ($conn) {
                $conn->commit();
            }
        } catch (PDOException $e) {
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para realizar un rollback o revirtir los cambios realizados en la base de datos.
    function deshacer($conn) {
        try {
            if ($conn) {
                $conn->rollBack();
            }
        } catch (PDOException $e) {
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para crear la sesión.
    function crearSesion($usuario) {
        session_start();
        $_SESSION["usuario"] = $usuario;
        header("Location: ./pe_inicio.php");
    }
//--------------------------------------------------------------------------
    // Función para cerrar sesión.
    function cerrarSesion() {
        session_unset();
        session_destroy();
        setcookie("PHPSESSID", "", time() - 3600, "/");
        header("Location: ./pe_login.php");
    }
//--------------------------------------------------------------------------
    // Función para crear una sesión con cookies.
    function crearSesionCookies($usuario) {
        setcookie("usuario", $usuario, time() + 86400, "/");
        setcookie("cesta", "", time() + 3600, "/");
        header("Location: ./pe_inicio.php");
    }
//--------------------------------------------------------------------------
    // Función para cerrar sesión eliminando cookies.
    function cerrarSesionCookies() {
        setcookie("usuario", "", time() - 3600, "/");
        setcookie("cesta", "", time() - 3600, "/");
        header("Location: ./pe_login.php");
    }
//--------------------------------------------------------------------------