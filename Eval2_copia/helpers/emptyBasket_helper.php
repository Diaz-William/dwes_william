<?php
    function vaciarCesta() {
        setcookie("cesta", "", time() - 86400, "/");
        $_COOKIE["cesta"] = "";
    }
?>