<?php
    function mostrarDatos($datos) {
        $datosLinea = array();

        foreach ($datos as $x) {
            $datosLinea = explode(" ", $x);
            /*echo "<pre>";
            echo print_r( $datosLinea );
            echo "</pre>";*/
            foreach ($datosLinea as $y) {
                if ($y != " ") {
                    $aux = str_pad($y, 10, " ", STR_PAD_RIGHT);
                    echo $aux;
                }
            }
            echo "<br>";
        }
    }
?>