<?php
    function consultarAlquileres($fechadesde, $fechahasta) {
        try {
            $id = explode("#", $_COOKIE["datos"]);
            $id = $id[1];
            $conn = conectar();
            $stmt = $conn->prepare("SELECT RA.MATRICULA, MARCA, MODELO, FECHA_ALQUILER, FECHA_DEVOLUCION, PRECIOTOTAL FROM RALQUILERES RA, RVEHICULOS RV WHERE RA.MATRICULA = RV.MATRICULA AND IDCLIENTE = :IDCLIENTE AND FECHA_ALQUILER BETWEEN :FECHADESDE AND :FECHAHASTA AND FECHA_DEVOLUCION IS NOT NULL AND PRECIOTOTAL IS NOT NULL AND FECHAHORAPAGO IS NOT NULL ORDER BY FECHA_ALQUILER");
            $stmt->bindParam(":IDCLIENTE", $id);
            $stmt->bindParam(":FECHADESDE", $fechadesde);
            $stmt->bindParam(":FECHAHASTA", $fechahasta);
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