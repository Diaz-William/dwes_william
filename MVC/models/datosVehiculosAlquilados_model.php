<?php
    function obtenerDatosVehiculos($matriculas) {
        try {
            $alquilados = array();
            $conn = conectar();
            $stmt = $conn->prepare("SELECT MARCA, MODELO FROM RVEHICULOS WHERE MATRICULA = :MATRICULA");

            foreach ($matriculas as $row) {
                $stmt->bindParam("MATRICULA", $row["MATRICULA"]);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $alquilados[$row["MATRICULA"]] = $result["MARCA"] . "#" . $result["MODELO"];
            }
            
            $conn = null;
            return $alquilados;
        } catch (PDOException $e) {
            $conn = null;
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }
?>