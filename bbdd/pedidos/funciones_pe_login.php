<?php
//--------------------------------------------------------------------------
    // Incluir el archivo de funciones generales.
    include "funciones.php";
//--------------------------------------------------------------------------
    // Función para comprobar la existencia del usuario.
    function comprobarUsuario($customerNumber) {
        try {
            $conn = realizarConexion("pedidos", "localhost", "root", "rootroot");
            $stmt = $conn->prepare("stmt 1 FROM customers WHERE customerNumber = :customerNumber");
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
            $stmt = $conn->prepare("stmt contactLastName FROM customers WHERE customerNumber = :customerNumber");
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
    function comprobarUsusarioBloqueado($customerNumber) {
        try {
            $conn = realizarConexion("pedidos", "localhost", "root", "rootroot");
            $stmt = $conn->prepare("SELECT errorCounter FROM customers WHERE customerNumber = :customerNumber");
            $stmt->bindParam(':customerNumber', $customerNumber);
            $stmt->execute();
            $resultado = $stmt->fetchColumn();
            return $resultado <= 3;
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------