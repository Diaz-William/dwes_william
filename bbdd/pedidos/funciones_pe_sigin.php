<?php
//--------------------------------------------------------------------------
    // Incluir el archivo de funciones generales.
    include "funciones.php";
//--------------------------------------------------------------------------
    // Función para insertar un cliente.
    function insertarCliente($contactFirstName, $contactLastName, $addressLine1, $city, $country, $hashPassword) {
        try {
            $customerNumber = siguienteNumeroCliente();
            $customerName = "Atelier graphique";

            $conn = realizarConexion("pedidos", "localhost", "root", "rootroot");
            empezarTransaccion($conn);
            $stmt = $conn->prepare("INSERT INTO customers (customerNumber, customerName, contactLastName, contactFirstName, addressLine1, city, country, hashPassword) VALUES (:customerNumber, :customerName, :contactLastName, :contactFirstName, :addressLine1, :city, :country, :hashPassword)");
            $stmt->bindParam(':customerNumber', $customerNumber);
            $stmt->bindParam(':customerName', $customerName);
            $stmt->bindParam(':contactLastName', $contactLastName);
            $stmt->bindParam(':contactFirstName', $contactFirstName);
            $stmt->bindParam(':addressLine1', $addressLine1);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':country', $country);
            $stmt->bindParam(':hashPassword', $hashPassword);
            $stmt->execute();
            validar($conn);
            cerrarConexion($conn);
        } catch (PDOException $e) {
            deshacer($conn);
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para obtener el siguiente número de cliente.
    function siguienteNumeroCliente() {
        try {
            $conn = realizarConexion("pedidos", "localhost", "root", "rootroot");
            $stmt = $conn->prepare("SELECT (MAX(customerNumber) + 1) FROM customers");
            $stmt->execute();
            $resultado = $stmt->fetchColumn();
            cerrarConexion($conn);
            return $resultado;
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------