<?php
    function getEmpHistory($empno) {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT D.DEPT_NAME, DE.FROM_DATE AS DEPT_FROM, DE.TO_DATE AS DEPT_TO, S.SALARY, S.FROM_DATE AS SAL_FROM, S.TO_DATE AS SAL_TO FROM DEPT_EMP DE, DEPARTMENTS D, SALARIES S WHERE DE.DEPT_NO = D.DEPT_NO AND DE.EMP_NO = S.EMP_NO AND DE.EMP_NO = :EMP_NO ORDER BY DE.FROM_DATE DESC, S.FROM_DATE DESC");
            $stmt->bindParam(":EMP_NO", $empno);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
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