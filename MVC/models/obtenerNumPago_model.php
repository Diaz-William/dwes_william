<?php
    function sigNumPago() {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT (MAX(NUM_PAGO) + 1) AS NUM_PAGO FROM RALQUILERES");
            $stmt->execute();
            $result = $stmt->fetchColumn();
            $conn = null;
            return "00000000000" . $result;
        } catch (PDOException $e) {
            if ($conn) {
                $conn = null;
            }
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }
?>