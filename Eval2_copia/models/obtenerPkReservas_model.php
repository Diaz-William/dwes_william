<?php
    function obtenerPkReservas() {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT MAX(id_reserva) FROM reservas");
            $stmt->execute();
            $result = $stmt->fetchColumn();
            $conn = null;
            $result = substr($result, 0, 1) . str_pad((intval(substr($result, 1)) + 1), 4, '0', STR_PAD_LEFT);
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