<?php
    function getEmpData($empno) {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT BIRTH_DATE, FIRST_NAME, LAST_NAME, IF(GENDER = 'M', 'Hombre', 'Mujer'), HIRE_DATE FROM EMPLOYEES WHERE EMP_NO = :EMP_NO");
            $stmt->bindParam(":EMP_NO", $empno);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
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