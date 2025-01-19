<?php
    function consultarAlquileres($fechadesde, $fechahasta) {
        try {
            $id = explode("#", $_COOKIE["datos"]);
            $id = $id[1];
            $conn = conectar();
            $stmt = $conn->prepare("SELECT MATRICULA FROM RALQUILERES WHERE IDCLIENTE = :IDCLIENTE AND FECHA_ALQUILER BETWEEN :FECHADESDE AND :FECHAHASTA");
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