<?php
    function obtenerDatosVehiculos($matriculas) {
        try {
            $alquilados = array();
            $conn = conectar();

            foreach ($matriculas as $i) {
                var_dump($i);
            }

            $stmt = $conn->prepare("SELECT MATRICULA, MARCA, MODELO FROM RVEHICULOS WHERE MATRICULA = :MATRICULA");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $conn = null;
            return $result;
        } catch (PDOException $e) {
            $conn = null;
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }
?>