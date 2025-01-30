<?php
    function comprobarEngineer($empno) {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT 1 FROM TITLES WHERE EMP_NO = :EMP_NO AND UPPER(TITLE) LIKE '%ENGINEER%' AND TO_DATE IS NULL");
            $stmt->bindParam(":EMP_NO", $empno);
            $stmt->execute();
            $result = $stmt->fetchColumn();
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