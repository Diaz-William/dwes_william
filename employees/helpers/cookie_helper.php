<?php
    function crearSesionCookie($nombre, $id) {
        setcookie("datos", $nombre."#".$id, time() + 86400, "/");
    }

    function cerrarSesionCookie() {
        setcookie("datos", "", time() - 86400, "/");
        setcookie("cesta", "", time() - 86400, "/");
        setcookie("datosPago", "", time() - 86400, "/");
        header("Location: ../index.php");
    }

    function cesta($birthdate, $firstname, $lastname, $gender, $deptno, $salary, $title) {
        try {
            $cesta = isset($_COOKIE["cesta"]) ? unserialize($_COOKIE["cesta"]) : array();
            $index = count($cesta) !== 0 ? count($cesta) : 0;
            $cesta[$index] = $birthdate."#".$firstname."#". $lastname."#". $gender."#". $deptno."#". $salary."#". $title;
            setcookie("cesta", serialize($cesta), time() + 86400, "/");
            $_COOKIE["cesta"] = serialize($cesta);
            return true;
        } catch (Exception $e) {
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return false;
        }
    }
    
    function vaciarCesta() {
        setcookie("cesta", "", time() - 86400, "/");
        $_COOKIE["cesta"] = "";
    }
?>