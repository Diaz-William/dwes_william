<?php
    function getUserData($empno) {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT CONCAT(FIRST_NAME, ' ', LAST_NAME) FROM EMPLOYEES WHERE EMP_NO = :EMP_NO");
            $stmt->bindParam(":EMP_NO", $empno);
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