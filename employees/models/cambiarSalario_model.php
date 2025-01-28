<?php
    function cambiarSalario($empno, $percentage) {
        try {
            $conn = conectar();
            $salarioAntiguo = obtenerSalario($conn, $empno);
            if ($salarioAntiguo == 0) {
                echo "<p>No se puede actualizar el salario del empleado con el número $empno porque es 0.</p>";
            }else {
                $conn->beginTransaction();
                $stmt = $conn->prepare("UPDATE SALARIES SET SALARY = :SALARY WHERE EMP_NO = :EMP_NO");
                $salarioNuevo = max(0, round(($salarioAntiguo + ($salarioAntiguo * $percentage)), 2, PHP_ROUND_HALF_DOWN));
                $stmt->bindParam(':EMP_NO', $empno);
                $stmt->bindParam(':SALARY', $salarioNuevo);
                $stmt->execute();
                $conn->commit();
                echo "<p>Se ha actualizado el salario del empleado con el número $empno de $salarioAntiguo a $salarioNuevo</p>";
            }
            $conn = null;
            return true;
        } catch (PDOException $e) {
            if ($conn) {
                $conn->rollBack();
                $conn = null;
            }
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }

    function obtenerSalario($conn, $empno) {
        try {
            $select = $conn->prepare("SELECT IFNULL(SALARY, 0) AS 'SALARY' FROM SALARIES WHERE EMP_NO = :EMP_NO");
            $select->bindParam(':EMP_NO', $empno);
            $select->execute();
            return $select->fetchColumn();
        } catch (PDOException $e) {
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }
?>