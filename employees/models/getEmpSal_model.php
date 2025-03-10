<?php
    function getEmpSal($empno) {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT SALARY FROM SALARIES WHERE EMP_NO = :EMP_NO AND TO_DATE IS NULL");
            $stmt->bindParam(":EMP_NO", $empno);
            $stmt->execute();
            $result = $stmt->fetchColumn();
            $conn = null;
            return intval($result);
        } catch (PDOException $e) {
            if ($conn) {
                $conn = null;
            }
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }
?>