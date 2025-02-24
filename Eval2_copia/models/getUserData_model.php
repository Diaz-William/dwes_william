<?php
    function getUserData($email) {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT CONCAT(nombre, ' ', apellidos, '#', email) FROM clientes WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $result = $stmt->fetchColumn();
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