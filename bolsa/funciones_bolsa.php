<?php
    function mostrarDatos($datos) {
        $datosLinea = array();

        foreach ($datos as $x) {
            $datosLinea = explode(" ", $x);
            foreach ($datosLinea as $y) {
                echo $y . " ";
            }
            echo "<br>";
        }
    }
?>