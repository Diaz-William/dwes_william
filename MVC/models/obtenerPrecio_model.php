<?php
    function obtenerPrecio($fecha_devolver, $matricula) {
        try {
            $id = explode("#", $_COOKIE["datos"]);
            $id = $id[1];
            $conn = conectar();
            $stmt = $conn->prepare("SELECT ROUND((TIMESTAMPDIFF(MINUTE, RA.FECHA_ALQUILER, :FECHA_DEVOLVER) * RV.PRECIOBASE), 2) AS TOTAL FROM RVEHICULOS RV, RALQUILERES RA WHERE RV.MATRICULA = RA.MATRICULA AND RV.MATRICULA = :MATRICULA AND RA.FECHA_DEVOLUCION IS NULL AND RA.PRECIOTOTAL IS NULL AND RA.FECHAHORAPAGO IS NULL AND RA.IDCLIENTE = :IDCLIENTE");
            $stmt->bindParam(":IDCLIENTE", $id);
            $stmt->bindParam(":FECHA_DEVOLVER", $fecha_devolver);
            $stmt->bindParam(":MATRICULA", $matricula);
            $stmt->execute();
            $result = $stmt->fetchColumn();

            var_dump($matricula);
            var_dump($fecha_devolver);
            var_dump($id);
            var_dump($result);

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