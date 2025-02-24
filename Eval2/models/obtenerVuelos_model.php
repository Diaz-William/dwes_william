<?php
    function obtenerVuelos() {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT id_vuelo, origen, fechahorasalida, destino, fechahorallegada, precio_asiento FROM vuelos WHERE asientos_disponibles > 0");
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