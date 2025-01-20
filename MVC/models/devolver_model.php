<?php
    function obtenerVehiculosAlquilados() {
        try {
            $id = explode("#", $_COOKIE["datos"]);
            $id = $id[1];
            $conn = conectar();
            $stmt = $conn->prepare("SELECT RA.MATRICULA, RV.MARCA, RV.MODELO FROM RALQUILERES RA, RVEHICULOS RV WHERE RA.MATRICULA = RV.MATRICULA AND RA.IDCLIENTE = :IDCLIENTE AND RA.FECHA_DEVOLUCION IS NULL AND RA.PRECIOTOTAL IS NULL AND RA.FECHAHORAPAGO IS NULL ORDER BY RA.FECHA_ALQUILER");
            $stmt->bindParam(":IDCLIENTE", $id);
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