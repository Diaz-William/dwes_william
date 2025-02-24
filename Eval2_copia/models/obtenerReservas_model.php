<?php
    function obtenerVuelos() {
        try {
            require_once("../models/obtenerDNI_model.php");
            $dni = obtenerDNI();
            $conn = conectar();
            $stmt = $conn->prepare("SELECT id_reserva , id_vuelo , dni_cliente , fecha_reserva, num_asientos , preciototal FROM reservas WHERE dni_cliente = :dni");
            $stmt->bindParam(":dni", $dni);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            $conn = null;
            return $result;
        } catch (PDOException $e) {
            if ($conn) {
                $conn = null;
            }
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }
?>