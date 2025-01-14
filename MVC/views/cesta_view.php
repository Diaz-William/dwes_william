<?php
    function imprimirCesta() {
        if (isset($_COOKIE["cesta"])) {
            echo "<ul>";
            $cesta = unserialize($_COOKIE["cesta"]);
            foreach ($cesta as $matricula => $datos) {
                list($marca, $modelo) = explode("#", $datos);
                echo "<li>$matricula | $marca | $modelo</li>";
            }
            echo "</ul>";
        } 
    }
?>