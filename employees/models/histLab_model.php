<?php
    function getEmpHistory($empno) {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT CONCAT(D.DEPT_NAME, ', desde ', DE.FROM_DATE, ', hasta ', COALESCE(DE.TO_DATE, 'la actualidad'), ', salario: ', S.SALARY, ' desde ', S.FROM_DATE, ' hasta ', COALESCE(S.TO_DATE, 'la actualidad')) AS INFO FROM DEPT_EMP DE, DEPARTMENTS D, SALARIES S WHERE DE.DEPT_NO = D.DEPT_NO AND DE.EMP_NO = S.EMP_NO AND DE.EMP_NO = :EMP_NO ORDER BY DE.FROM_DATE DESC, S.FROM_DATE DESC");
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
            return [];
        }
    }
?>