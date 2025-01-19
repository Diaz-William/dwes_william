<?php
    function obtenerDatosVehiculos($matriculas) {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT MATRICULA, MARCA, MODELO FROM RVEHICULOS WHERE MATRICULA = :MATRICULA");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            $conn = null;
            return $result;
        } catch (PDOException $e) {
            $conn = null;
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }
?>