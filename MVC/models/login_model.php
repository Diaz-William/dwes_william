<?php
    function comprobar($email, $password) {
        try {
            $conexion = conectar();
            $stmt = $conexion->prepare("SELECT 1 FROM RCLIENTES WHERE EMAIL = :EMAIL AND IDCLIENTE = :IDCLIENTE");
            $stmt->bindParam(':EMAIL', $email);
            $stmt->bindParam(':IDCLIENTE', $password);
            $stmt->execute();
            $result = $stmt->fetchColumn();
            $conexion = null;
            return $result !== false;
        } catch (PDOException $ex) {
            /*echo $ex->getMessage();
            return null;*/

            return $ex->getMessage();
        }
    }
?>