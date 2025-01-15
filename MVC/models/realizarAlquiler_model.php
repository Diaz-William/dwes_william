<?php
    function realizarAlquiler() {
        try {
            $cesta = unserialize($_COOKIE["cesta"]);
            foreach ($cesta as $matricula) {
                echo $matricula;
            }
            $conn = conectar();
            $conn->beginTransaction();
            $stmt = $conn->prepare("UPDATE RVEHICULOS SET DISPONIBLE = 'N' WHERE MATRICULA = :MATRICULA");
            $stmt->bindParam("MATRICULA", $matricula);
            $stmt->execute();
            $stmt = $conn->prepare("INSERT INTO RALQUILERES (IDCLIENTE, MATRICULA, FECHA_ALQUILER, FECHA_DEVOLUCION, PRECIOTOTAL, FECHAHORAPAGO) VALUES (:IDCLIENTE, :MATRICULA, :FECHA_ALQUILER, null, null, null)");
            $id = explode("#", $_COOKIE["datos"]);
            $id = $id[1];
            $stmt->bindParam(':IDCLIENTE', $id);
            $stmt->bindParam(':MATRICULA', $matricula);
            $fecha_alquiler = date("Y-m-d H:i:s");
            $stmt->bindParam(':FECHA_ALQUILER', $fecha_alquiler);
            $stmt->execute();
            $conn->commit();
        } catch (PDOException $e) {
            $conn->rollBack();
            $conn = null;
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }
?>