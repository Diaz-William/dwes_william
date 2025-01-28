<?php
    function getDataEmp($empno) {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT CONCAT('Nacido el ', BIRTH_DATE, ', ', IF(gender = 'M', 'Hombre', 'Mujer'), ', contratado el ', HIRE_DATE) AS INFO FROM EMPLOYEES WHERE EMP_NO = :EMP_NO");
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