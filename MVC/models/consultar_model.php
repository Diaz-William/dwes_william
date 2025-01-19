<?php
    function consultarAlquileres($fechadesde, $fechahasta) {
        try {
            $id = explode("#", $_COOKIE["datos"]);
            $id = $id[1];
            $conn = conectar();
            $stmt = $conn->prepare("SELECT RA.MATRICULA, RV.MARCA, RV.MODELO, RA.FECHA_ALQUILER, RA.FECHA_DEVOLUCION, RA.PRECIOTOTAL FROM RALQUILERES RA, RVEHICULOS RV WHERE RA.MATRICULA = RV.MATRICULA AND RA.IDCLIENTE = :IDCLIENTE AND RA.FECHA_ALQUILER BETWEEN :FECHADESDE AND :FECHAHASTA AND RA.FECHA_DEVOLUCION IS NOT NULL AND RA.PRECIOTOTAL IS NOT NULL AND RA.FECHAHORAPAGO IS NOT NULL ORDER BY RA.FECHA_ALQUILER");
            $stmt->bindParam(":IDCLIENTE", $id);
            $stmt->bindParam(":FECHADESDE", $fechadesde);
            $stmt->bindParam(":FECHAHASTA", $fechahasta);
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