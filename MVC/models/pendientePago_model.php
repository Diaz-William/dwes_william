<?php
    function pendientePago($precio) {
        try {
            $id = explode("#", $_COOKIE["datos"]);
            $id = $id[1];
            $conn = conectar();
            $conn->beginTransaction();
            $stmt = $conn->prepare("UPDATE RCLIENTES SET PENDIENTE_PAGO = :PRECIO WHERE IDCLIENTE = :IDCLIENTE");
            $stmt->bindParam("PRECIO", $precio);
            $stmt->bindParam("IDCLIENTE", $id);
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
?>