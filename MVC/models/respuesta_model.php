<?php
    function actualizarAlquileres($num_pago, $matricula, $fecha_devolver, $precio) {
        try {
            $id = explode("#", $_COOKIE["datos"]);
            $id = $id[1];
            date_default_timezone_set('Europe/Madrid');

            $conn = conectar();
            $conn->beginTransaction();

            $fecha_alquiler = obtenerFechaAlquiler($conn, $matricula, $id);

            $stmt = $conn->prepare("UPDATE RALQUILERES SET FECHA_DEVOLUCION = :FECHA_DEVOLUCION, PRECIOTOTAL = :PRECIOTOTAL, FECHAHORAPAGO = :FECHAHORAPAGO, NUM_PAGO = :NUM_PAGO WHERE MATRICULA = :MATRICULA AND IDCLIENTE = :IDCLIENTE AND FECHA_ALQUILER = :FECHA_ALQUILER AND FECHA_DEVOLUCION IS NULL AND PRECIOTOTAL IS NULL AND FECHAHORAPAGO IS NULL AND NUM_PAGO IS NULL");
            $stmt->bindParam(":FECHA_DEVOLUCION", $fecha_devolver);
            $stmt->bindParam(":PRECIOTOTAL", $precio);
            $fechahorapago = date("Y-m-d H:i:s");
            $stmt->bindParam(":FECHAHORAPAGO", $fechahorapago);
            $stmt->bindParam(":NUM_PAGO", $num_pago);
            $stmt->bindParam(":MATRICULA", $matricula);
            $stmt->bindParam(":IDCLIENTE", $id);
            $stmt->bindParam(":FECHA_ALQUILER", $fecha_alquiler);

            $stmt->execute();

            $stmt = $conn->prepare("UPDATE RVEHICULOS SET DISPONIBLE = 'S' WHERE MATRICULA = :MATRICULA");
            $stmt->bindParam(":MATRICULA", $matricula);
            $stmt->execute();

            $conn->commit();
        } catch (PDOException $e) {
            if ($conn) {
                $conn->rollBack();
                $conn = null;
            }
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        } catch (Exception $e) {
            if ($conn) {
                $conn->rollBack();
                $conn = null;
            }
            error_log("Error en actualizarAlquileres: " . $e->getMessage());
            return null;
        }
    }

    function obtenerFechaAlquiler($conn, $matricula, $id) {
        try {
            $stmt = $conn->prepare("SELECT FECHA_ALQUILER FROM RALQUILERES WHERE MATRICULA = :MATRICULA AND IDCLIENTE = :IDCLIENTE AND FECHA_DEVOLUCION IS NULL AND PRECIOTOTAL IS NULL AND FECHAHORAPAGO IS NULL AND NUM_PAGO IS NULL");
            $stmt->bindParam(":MATRICULA", $matricula);
            $stmt->bindParam(":IDCLIENTE", $id);
            $stmt->execute();

            $result = $stmt->fetchColumn();
            return $result !== false ? $result : null;
        } catch (PDOException $e) {
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        } catch (Exception $e) {
            error_log("Error en obtenerFechaAlquiler: " . $e->getMessage());
            return null;
        }
    }
?>