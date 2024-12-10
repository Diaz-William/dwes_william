<?php
//--------------------------------------------------------------------------
    // Incluir el archivo de funciones generales.
    include "funciones.php";
//--------------------------------------------------------------------------
    // Función para comprobar la existencia del usuario.
    function comprobarUsuario($customerNumber) {
        try {
            $conn = realizarConexion("pedidos", "localhost", "root", "rootroot");
            $stmt = $conn->prepare("SELECT 1 FROM customers WHERE customerNumber = :customerNumber");
            $stmt->bindParam(':customerNumber', $customerNumber);
            $stmt->execute();
            $resultado = $stmt->fetchColumn();
            cerrarConexion($conn);
            return $resultado !== false;
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para comprobar la contraseña del usuario.
    function comprobarClave($customerNumber, $hash) {
        try {
            $conn = realizarConexion("pedidos", "localhost", "root", "rootroot");
            $stmt = $conn->prepare("SELECT contactLastName FROM customers WHERE customerNumber = :customerNumber");
            $stmt->bindParam(':customerNumber', $customerNumber);
            $stmt->execute();
            $resultado = $stmt->fetchColumn();
            cerrarConexion($conn);
            return password_verify($resultado, $hash);
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para comprobar si un usuario no esta bloqueado.
    function comprobarUsuarioBloqueado($customerNumber) {
        try {
            $conn = realizarConexion("pedidos", "localhost", "root", "rootroot");
            $stmt = $conn->prepare("SELECT errorCounter FROM customers WHERE customerNumber = :customerNumber");
            $stmt->bindParam(':customerNumber', $customerNumber);
            $stmt->execute();
            $resultado = $stmt->fetchColumn();
            cerrarConexion($conn);
            var_dump($resultado);
            return $resultado >= 3;
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para aumentar un contador de errores de inicio de sesión.
    function aumentarErroresSesion($customerNumber) {
        try {
            $conn = realizarConexion("pedidos", "localhost", "root", "rootroot");
            $stmt = $conn->prepare("UPDATE customers SET errorCounter = errorCounter + 1 WHERE customerNumber = :customerNumber");
            $stmt->bindParam(':customerNumber', $customerNumber);
            $stmt->execute();
            $stmt = $conn->prepare("SELECT errorCounter FROM customers WHERE customerNumber = :customerNumber");
            $stmt->bindParam(':customerNumber', $customerNumber);
            $stmt->execute();
            $resultado = $stmt->fetchColumn();
            cerrarConexion($conn);
            trigger_error("El contactLastName es incorrecto, $resultado fallos");
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para reiniciar el contador de errores si la sesión es correcta.
    function reiniciarErroresSesion($customerNumber) {
        try {
            $conn = realizarConexion("pedidos", "localhost", "root", "rootroot");
            $stmt = $conn->prepare("UPDATE customers SET errorCounter = 0 WHERE customerNumber = :customerNumber");
            $stmt->bindParam(':customerNumber', $customerNumber);
            $stmt->execute();
            cerrarConexion($conn);
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------