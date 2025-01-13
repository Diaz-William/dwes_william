<?php
    function comprobar($email, $password) {
        try {
            $conexion = conectar();
            var_dump($conexion);
            $stmt = $conexion->prepare("SELECT 1 FROM RCLIENTES WHERE EMAIL = :EMAIL AND IDCLIENTE = :IDCLIENTE");
            $stmt->bindParam(':EMAIL', $email);
            $stmt->bindParam(':IDCLIENTE', $password);
            $stmt->execute();
            $result = $stmt->fetchColumn();
            $conexion = null;
            var_dump($result);
            return $result !== false;
        } catch (PDOException $ex) {
            echo "Error: ". $ex->getMessage();
            return null;
        }
    }
?>