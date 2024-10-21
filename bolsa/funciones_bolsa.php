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

    function imprimirFormulario($nombre) {
        $datos = obtenerDatos();
        $linea = array();

        echo '<label id="valores">Valores</label>&nbsp;';
        echo '<select id="valores" name="valores">';

        foreach ($datos as $i => $x) {
            if ($i != 0) {
                $linea = obtenerLinea($x);
                echo '<option value="'.$linea[0].'">'.$linea[0].'</option>';
            }
        }

        /*for ($i = 1; $i < count($datos); $i++) { 
            $linea = obtenerLinea($datos[$i]);
            echo '<option value="'.$linea[0].'">'.$linea[0].'</option>';
        }*/


        echo '</select>';
        echo '<br><br>';

        if ($nombre == "bolsa4.php") {
            $linea = obtenerLinea($datos[0]);

            echo '<label id="mostrar">Mostrar</label>&nbsp;';
            echo '<select id="mostrar" name="mostrar">';

            foreach ($linea as $x) {
                if ($x != "Valor") {
                    echo '<option value="'.$x.'">'.$x.'</option>';
                }
            }

            echo '</select>';
        }
        
        echo '<br><br>';
        echo '<input type="submit" value="Visualizar">&nbsp;';
        echo '<input type="reset" value="borrar">';
        echo '</form>';
    }

    function imprimirCotizaciones($linea) {
        $linea = obtenerLinea( $linea );
        $valor = $linea[0];
        $cotizacion = $linea[1];
        $max = $linea[5];
        $min = $linea[6];
        echo "<br><br>";
        echo "El valor cotización de $valor es $cotizacion";
        echo "<br><br>";
        echo "Cotización Máxima de $valor es $max";
        echo "<br><br>";
        echo "Cotización Mínima de $valor es $min";
    }

    function mostrarValor($datos, $valor, $mostrar) {
        $indice = 1;
        $seguir = true;
        $linea = array();
        $numMostrar = 0;
        $aux = "";

        $linea = obtenerLinea($datos[0]);

        while ($seguir && $indice < count($linea)) {
            if (strtolower($linea[$indice]) == strtolower($mostrar)) {
                $numMostrar = $indice;
                $seguir = false;
            }
            $indice += 1;
        }

        $indice = 1;
        $seguir = true;

        while ($seguir && $indice < count($datos)) {
            $linea = obtenerLinea($datos[$indice]);
            if (strtolower($linea[0]) == strtolower($valor)) {
                $aux = $linea[$numMostrar];
                echo "<p>El valor $mostrar de $valor es $aux</p>";
                $seguir = false;
            }
            $indice += 1;
        }
    }

    function sumaVolumenCapital($datos, $opcion) {
        $suma = 0;
        $posicion = 0;
        $linea = array();

        if ($opcion == "volumen") {
            $posicion = 7;
        }else if ($opcion == "capital") {
            $posicion = 8;
        }

        for ($i = 1; $i < count($datos); $i++) {
            $linea = obtenerLinea($datos[$i]);
            $suma += intval(str_replace('.', '', $linea[$posicion]));
        }

        if ($opcion == "volumen") {
            echo "<p>Total Volumen: $suma</p>";
        }else if ($opcion == "capital") {
            echo "<p>Total Capitalización: $suma</p>";
        }
    }

    function mostrarTodosLosValores($datos) {
        $maxCot = 0;
        $minCot = 999;
        $maxVol = 0;
        $minVol = 999999999;
        $maxCap = 0;
        $minCap = 999;
        $valorMaxCot = $valorMinCot = $valorMaxVol = $valorMinVol = $valorMaxCap = $valorMinCap = "";
        $linea = array();

        for ($i = 1; $i < count($datos); $i++) {
            $linea = obtenerLinea($datos[$i]);
            
            if (intval(str_replace('.', '', $linea[1])) > intval(str_replace('.', '', $maxCot))) {
                $maxCot = $linea[1];
                $valorMaxCot = $linea[0];
            }
            if (intval(str_replace('.', '', $linea[1])) < intval(str_replace('.', '', $minCot))) {
                $minCot = $linea[1];
                $valorMinCot = $linea[0];
            }
            if (intval(str_replace('.', '', $linea[7])) > intval(str_replace('.', '', $maxVol))) {
                $maxVol = $linea[7];
                $valorMaxVol = $linea[0];
            }
            if (intval(str_replace('.', '', $linea[7])) < intval(str_replace('.', '', $minVol))) {
                $minVol = $linea[7];
                $valorMinVol = $linea[0];
            }
            if (intval(str_replace('.', '', $linea[8])) > intval(str_replace('.', '', $maxCap))) {
                $maxCap = $linea[8];
                $valorMaxCap = $linea[0];
            }
            if (intval(str_replace('.', '', $linea[8])) < intval(str_replace('.', '', $minCap))) {
                $minCap = $linea[8];
                $valorMinCap = $linea[0];
            }
        }

        echo "<p>$valorMaxCot tiene la máxima cotización con $maxCot</p>";
        echo "<p>$valorMinCot tiene la mínima cotización con $minCot</p>";
        echo "<p>$valorMaxVol tiene el máximo volumen con $maxVol</p>";
        echo "<p>$valorMinVol tiene el mínimo volumen con $minVol</p>";
        echo "<p>$valorMaxCap tiene el máximo capital con $maxCap</p>";
        echo "<p>$valorMinCap tiene el mínimo capital con $minCap</p>";
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

    function obtenerNombre() {
        $aux1 = htmlspecialchars($_SERVER["PHP_SELF"]);
        $aux2 = explode("/", $aux1);
        $nombre = $aux2[(count($aux2) -1)];
        return $nombre;
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }