<?php
    function realizarAlquiler($cesta) {
        try {
            $conn = conectar();
            $conn->beginTransaction();
            $id = explode("#", $_COOKIE["datos"]);
            $id = $id[1];
            foreach ($cesta as $matricula => $datos) {
                $stmt = $conn->prepare("UPDATE RVEHICULOS SET DISPONIBLE = 'N' WHERE MATRICULA = :MATRICULA");
                $stmt->bindParam(":MATRICULA", $matricula);
                $stmt->execute();
                $stmt = $conn->prepare("INSERT INTO RALQUILERES (IDCLIENTE, MATRICULA, FECHA_ALQUILER, FECHA_DEVOLUCION, PRECIOTOTAL, FECHAHORAPAGO) VALUES (:IDCLIENTE, :MATRICULA, :FECHA_ALQUILER, null, null, null)");
                $stmt->bindParam(':IDCLIENTE', $id);
                $stmt->bindParam(':MATRICULA', $matricula);
                $fecha_alquiler = date("Y-m-d H:i:s");
                $stmt->bindParam(':FECHA_ALQUILER', $fecha_alquiler);
                $stmt->execute();
            }
            $conn->commit();
            $conn = null;
            return true;
        } catch (PDOException $e) {
            if ($conn) {
                $conn->rollBack();
            }
            $conn = null;
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        } catch (Exception $e) {
            if ($conn) {
                $conn->rollBack();
            }
            $conn = null;
            error_function(0, $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        } finally {
            if ($conn) {
                $conn = null;
            }
        }
    }
?>