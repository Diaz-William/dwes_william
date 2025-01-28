<?php
    function getSalEmp($empno) {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT CONCAT('Salario de ', SALARY, ' desde ', FROM_DATE, ' hasta ', COALESCE(TO_DATE,'la actualidad')) AS INFO FROM SALARIES WHERE EMP_NO = :EMP_NO");
            $stmt->bindParam(":EMP_NO", $empno);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
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