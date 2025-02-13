<?php
    function comprobar($email, $lastname) {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT 1 FROM Customer WHERE Email = :Email AND LastName = :LastName");
            $stmt->bindParam(':Email', $email);
            $stmt->bindParam(':LastName', $lastname);
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