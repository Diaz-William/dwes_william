<?php
//--------------------------------------------------------------------------
    // Incluir el archivo de funciones generales.
    include "funciones.php";
//--------------------------------------------------------------------------
    // Función para obtener todas las ordenes de los pedidos entre dos fechas.
    function obtenerOrdenes($fecha_in, $fecha_fin) {
        try {
            $conn = realizarConexion("pedidos","localhost","root","rootroot");
            $stmt = $conn->prepare("SELECT orderNumber FROM orders WHERE orderDate BETWEEN :fecha_in AND :fecha_fin ORDER BY orderDate");
            $stmt->bindParam(':fecha_in', $fecha_in);
            $stmt->bindParam(':fecha_fin', $fecha_fin);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $ordenes = $stmt->fetchAll();
            cerrarConexion($conn);
            foreach ($ordenes as $row => $orden) {
                var_dump($orden);
            }
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------