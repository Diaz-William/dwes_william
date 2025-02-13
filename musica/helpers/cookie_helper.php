<?php
    function crearSesionCookie($userdata) {
        list($fullname, $id) = explode("#", $userdata);
        setcookie("usuario", $fullname."#".$id, time() + 86400, "/");
    }

    function cerrarSesionCookie() {
        setcookie("usuario", "", time() - 86400, "/");
        setcookie("basketEmp", "", time() - 86400, "/");
        header("Location: ../index.php");
    }

    function basketEmp($birthdate, $firstname, $lastname, $gender, $deptno, $salary, $title) {
        try {
            $basketEmp = isset($_COOKIE["basketEmp"]) ? unserialize($_COOKIE["basketEmp"]) : array();
            $index = count($basketEmp) !== 0 ? count($basketEmp) : 0;
            $basketEmp[$index] = $birthdate."#".$firstname."#". $lastname."#". $gender."#". $deptno."#". $salary."#". $title;
            setcookie("basketEmp", serialize($basketEmp), time() + 86400, "/");
            $_COOKIE["basketEmp"] = serialize($basketEmp);
            return true;
        } catch (Exception $e) {
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return false;
        }
    }
    
    function vaciarbasketEmp() {
        setcookie("basketEmp", "", time() - 86400, "/");
        $_COOKIE["basketEmp"] = "";
    }
?>