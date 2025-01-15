<?php
    function comprobar($email, $password) {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT NOMBRE, APELLIDO FROM RCLIENTES WHERE EMAIL = :EMAIL AND IDCLIENTE = :IDCLIENTE");
            $stmt->bindParam(':EMAIL', $email);
            $stmt->bindParam(':IDCLIENTE', $password);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result !== false) {
                $result = $result["NOMBRE"] . " " . $result["APELLIDO"];
            }
            
            if (comprobarPendientePago($email, $password, $conn) && $result !== false) {
                $result = "Pendiente de pago";
            } else if (comprobarBaja($email, $password, $conn) && $result !== false) {
                $result = "La cuenta ha sido dada de baja";
            }

            $conn = null;

            return $result;
        } catch (PDOException $e) {
            $conn = null;
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }

    function comprobarPendientePago($email, $password, $conn) {
        try {
            $stmt = $conn->prepare("SELECT 1 FROM RCLIENTES WHERE EMAIL = :EMAIL AND IDCLIENTE = :IDCLIENTE AND PENDIENTE_PAGO = 0");
            $stmt->bindParam(':EMAIL', $email);
            $stmt->bindParam(':IDCLIENTE', $password);
            $stmt->execute();
            return $stmt->fetchColumn() === false;
        } catch (PDOException $e) {
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }

    function comprobarBaja($email, $password, $conn) {
        try {
            $stmt = $conn->prepare("SELECT 1 FROM RCLIENTES WHERE EMAIL = :EMAIL AND IDCLIENTE = :IDCLIENTE AND FECHA_BAJA IS NULL");
            $stmt->bindParam(':EMAIL', $email);
            $stmt->bindParam(':IDCLIENTE', $password);
            $stmt->execute();
            return $stmt->fetchColumn() === false;
        } catch (PDOException $e) {
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }
?>