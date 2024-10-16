<?php
    function obtenerDatos() {
        $fichero = fopen("ibex35.txt", "r") or die("No se ha podido abrir el archivo");
        $datos = file("ibex35.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        fclose($fichero);
        return $datos;
    }
    function mostrarDatos($datos) {
        foreach ($datos as $x) {
            echo "$x<br>";
        }
    }

    function datosCotizacion($datos, $valor) {
        $indice = 0;
        $seguir = true;
        $aux = "";

        while ($seguir && $indice < count($datos)) {
            $aux = strtolower($datos[$indice]);
            if (str_contains($aux, strtolower($valor))) {
                echo $aux;
                $seguir = false;
            }
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }