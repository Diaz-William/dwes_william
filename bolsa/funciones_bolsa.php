<?php
    function obtenerDatos() {
        $fichero = fopen("ibex35.txt", "r") or die("No se ha podido abrir el archivo");
        $datos = file("ibex35.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        fclose($fichero);
        return $datos;
    }
    function mostrarDatos($datos) {
        foreach ($datos as $x) {
            echo "<pre>";
            echo $x;
            echo "</pre>";
        }
        
    }

    function datosCotizacion($datos, $valor, $nombre) {
        $indice = 0;
        $seguir = true;
        $datosValor = "";
        $linea = array();
        
        while ($seguir && $indice < count($datos)) {
            $linea = obtenerLinea($datos[$indice]);
            if (strtolower($linea[0]) == strtolower($valor)) {
                $datosValor = $datos[$indice];
                $seguir = false;
            }
            $indice += 1;
        }
        
        if ($nombre == "bolsa2.php") {
            imprimirDatosCotizacion($datosValor,$datos[0], $valor);
        }else if ($nombre == "bolsa3.php") {
            imprimirCotizaciones($datosValor);
        }
    }
    
    function imprimirDatosCotizacion($datosValor,$datos, $valor) {
        if ($datosValor != "") {
            echo "<br><br>";
            echo $datos . "<br><br>";
            echo $datosValor;
        }else {
            echo "<br><br>";
            echo "No se ha encontrado un valor con el nombre $valor";
        }
    }

    function imprimirFormulario() {
        $datos = obtenerDatos();
        $linea = array();

        echo '<label id="valores">Valores</label>';
        echo '<select id="valores">';

        for ($i = 1; $i < count($datos); $i++) { 
            $linea = obtenerLinea($datos[$i]);
            echo '<option value="'.$linea[0].'">'.$linea[0].'</option>';
        }

        echo '</select>';
        echo '<br><br>';
        echo '<input type="submit" value="Visualizar">';
        echo '<input type="reset" value="borrar">';
        echo '</form>';
    }

    function imprimirCotizaciones($linea) {
        $valor = $linea[0];
        $cotizacion = $linea[1];
        $max = $linea[5];
        $min = $linea[6];
        echo "<br><br>";
        echo "El valor cotización de $valor es $cotizacion";
        echo "Cotización Máxima de $valor es $max";
        echo "Cotización Mínima de $valor es $min";
    }

    function obtenerLinea($linea) {
        $data = array();
        if($linea != "") {
            $data[0] = test_input(substr($linea,0,23));
            $data[1] = test_input(substr($linea,23,8));
            $data[2] = test_input(substr($linea,32,8));
            $data[3] = test_input(substr($linea,40,8));
            $data[4] = test_input(substr($linea,48,11));
            $data[5] = test_input(substr($linea,60,8));
            $data[6] = test_input(substr($linea,69,8));
            $data[7] = test_input(substr($linea,78,12));
            $data[8] = test_input(substr($linea,91,8));
        }
        return $data;
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }