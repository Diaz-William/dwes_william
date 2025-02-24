<?php
    function comprobar($email, $dni) {
        try {
            $conn = conectar();
            $dni = $dni . "%";
            $stmt = $conn->prepare("SELECT 1 FROM clientes WHERE email = :email AND dni like :dni");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':dni', $dni);
            $stmt->execute();
            $result = $stmt->fetchColumn();
            $conn = null;
            return $result !== false;
        } catch (PDOException $e) {
            if ($conn) {
                $conn = null;
            }
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }
?>