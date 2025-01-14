<?php
    function obtenerVehiculosDisponibles() {
        try {
            $conexion = conectar();
            $stmt = $conexion->prepare("SELECT MATRICULA, MARCA, MODELO FROM RVEHICULOS WHERE DISPONIBLE = 'S'");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            $conexion = null;
            return $result;
        } catch (PDOException $e) {
            $conexion = null;
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }
?>