<?php
    function altaEmple($birthdate, $firstname, $lastname, $gender, $deptno, $salary, $title) {
        try {
            date_default_timezone_set('Europe/Madrid');
            $date = date("Y-m-d");
            $conn = conectar();
            $conn->beginTransaction();
            $empno = obtenerSigEmpNo($conn);
            // Insertar en employees.
            $stmt = $conn->prepare("INSERT INTO EMPLOYEES (EMP_NO, BIRTH_DATE, FIRST_NAME, LAST_NAME, GENDER, HIRE_DATE, BLOCKED) VALUES (:EMP_NO, :BIRTH_DATE, :FIRST_NAME, :LAST_NAME, :GENDER, :HIRE_DATE, FALSE)");
            $stmt->bindParam(":EMP_NO", $empno);
            $stmt->bindParam(":BIRTH_DATE", $birthdate);
            $stmt->bindParam(":FIRST_NAME", $firstname);
            $stmt->bindParam(":LAST_NAME", $lastname);
            $stmt->bindParam(":GENDER", $gender);
            $stmt->bindParam(":HIRE_DATE", $date);
            $stmt->execute();
            // Insertar en dept_emp.
            $stmt = $conn->prepare("INSERT INTO DEPT_EMP (EMP_NO, DEPT_NO, FROM_DATE, TO_DATE) VALUES (:EMP_NO, :DEPT_NO, :FROM_DATE, NULL)");
            $stmt->bindParam(":EMP_NO", $empno);
            $stmt->bindParam(":DEPT_NO", $deptno);
            $stmt->bindParam(":FROM_DATE", $date);
            $stmt->execute();
            // Insertar en salaries.
            $stmt = $conn->prepare("INSERT INTO SALARIES (EMP_NO, SALARY, FROM_DATE, TO_DATE) VALUES (:EMP_NO, :SALARY, :FROM_DATE, NULL)");
            $stmt->bindParam(":EMP_NO", $empno);
            $stmt->bindParam(":SALARY", $salary);
            $stmt->bindParam(":FROM_DATE", $date);
            $stmt->execute();
            // Insertar en titles.
            $stmt = $conn->prepare("INSERT INTO TITLES (EMP_NO, TITLE, FROM_DATE, TO_DATE) VALUES (:EMP_NO, :TITLE, :FROM_DATE, NULL)");
            $stmt->bindParam(":EMP_NO", $empno);
            $stmt->bindParam(":TITLE", $title);
            $stmt->bindParam(":FROM_DATE", $date);
            $stmt->execute();
            $conn->commit();
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

    function obtenerSigEmpNo($conn) {
        try {
            $stmt = $conn->prepare("SELECT MAX(EMP_NO) + 1 FROM EMPLOYEES");
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }
?>