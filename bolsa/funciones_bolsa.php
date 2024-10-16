<?php
    function mostrarDatos($datos) {
        $datosLinea = array();

        foreach ($datos as $x) {
            $datosLinea = explode(" ", $x);
            foreach ($datosLinea as $y) {
                echo str_pad($y, 10, " ", STR_PAD_RIGHT);
            }
            echo "<br>";
        }
    }
?>