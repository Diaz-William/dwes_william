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
        $devolver = "";
        //simulo la función str_contains(), disponible en php 8
        while ($seguir && $indice < count($datos)) {
            if (strpos(strtolower($datos[$indice]), strtolower($valor)) !== false) {
                $devolver = $datos[$indice];
                $seguir = false;
            }
            $indice++;
        }
        return $devolver;
    }
    

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }