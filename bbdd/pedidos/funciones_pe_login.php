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
    function comprobarClave($customerNumber, $contactLastName) {
        try {
            $conn = realizarConexion("pedidos", "localhost", "root", "rootroot");
            $stmt = $conn->prepare("SELECT hashPassword FROM customers WHERE customerNumber = :customerNumber");
            $stmt->bindParam(':customerNumber', $customerNumber);
            $stmt->execute();
            $resultado = $stmt->fetchColumn();
            cerrarConexion($conn);
            return password_verify($contactLastName, $resultado);
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
            empezarTransaccion($conn);
            $stmt = $conn->prepare("UPDATE customers SET errorCounter = errorCounter + 1 WHERE customerNumber = :customerNumber");
            $stmt->bindParam(':customerNumber', $customerNumber);
            $stmt->execute();
            validar($conn);
            $stmt = $conn->prepare("SELECT errorCounter FROM customers WHERE customerNumber = :customerNumber");
            $stmt->bindParam(':customerNumber', $customerNumber);
            $stmt->execute();
            $resultado = $stmt->fetchColumn();
            cerrarConexion($conn);
            if ((3 - $resultado) != 0) {
                trigger_error("La clave es incorrecta, " . (3 - $resultado) . " intentos");
            }
        } catch (PDOException $e) {
            deshacer($conn);
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