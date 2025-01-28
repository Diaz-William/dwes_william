<?php
    function cambiarSalario($empno, $percentage, $currentsalary) {
        try {
            $conn = conectar();
            if ($currentsalary == 0) {
                return false;
            }else {
                $conn->beginTransaction();
                $stmt = $conn->prepare("UPDATE SALARIES SET SALARY = :SALARY WHERE EMP_NO = :EMP_NO");
                $newsalary = max(0, $currentsalary + ($currentsalary * $percentage));
                $stmt->bindParam(':EMP_NO', $empno);
                $stmt->bindParam(':SALARY', $newsalary);
                $stmt->execute();
                $conn->commit();
            }
            $conn = null;
            return $newsalary;
        } catch (PDOException $e) {
            if ($conn) {
                $conn->rollBack();
                $conn = null;
            }
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }

    function obtenerSalario($empno) {
        try {
            $conn = conectar();
            $select = $conn->prepare("SELECT IFNULL(SALARY, 0) AS 'SALARY' FROM SALARIES WHERE EMP_NO = :EMP_NO");
            $select->bindParam(':EMP_NO', $empno);
            $select->execute();
            $result = $select->fetchColumn();
            $conn = null;
            return $result;
        } catch (PDOException $e) {
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }
?>