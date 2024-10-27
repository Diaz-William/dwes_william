<?php
    function obtenerXML($nombre) {
        $xml = simplexml_load_file($nombre) or die("Error: No se puede crear el objeto");
        return $xml;
    }

    function imprimirTablaXml($xml) {
        $nombre = $xml->nombre;
            echo "<br><br>";
            echo "<table>";

            echo "<tr>";
            echo "<td>$nombre</td>";
            foreach ($xml->prediccion->dia as $dia) {
                $fecha = $dia['fecha'];
                $numPeriodos = count($dia->prob_precipitacion);
                echo "<td colspan='$numPeriodos'>$fecha</td>";
            }
            echo "</tr>";
            
            echo "<tr>";
            echo "<td>Periodo</td>";
            foreach ($xml->prediccion->dia as $dia) {
                foreach ($dia->prob_precipitacion as $peri) {
                    $periodo = $peri['periodo'];
                    echo "<td>$periodo</td>";
                }
            }
            echo "</tr>";

            echo "<tr>";
            echo "<td>Prob. Precipitación</td>";
            foreach ($xml->prediccion->dia as $dia) {
                foreach ($dia->prob_precipitacion as $prob) {
                    echo "<td>$prob</td>";
                }
            }
            echo "</tr>";

            echo "<tr>";
            echo "<td>Viento (km/h)</td>";
            foreach ($xml->prediccion->dia as $dia) {
                foreach ($dia->viento as $v) {
                    $direccion = $v->direccion;
                    $velocidad = $v->velocidad;
                    echo "<td>$direccion $velocidad</td>";
                }
            }
            echo "</tr>";

            echo "<tr>";
            echo "<td>Sensación Térmica (ºC)</td>";
            foreach ($xml->prediccion->dia as $dia) {
                foreach ($dia->sens_termica->dato as $d) {
                    echo "<td>$d</td>";
                }
            }
            echo "</tr>";

            echo "<tr>";
            echo "<td>Temp. Max - Min (ºC)</td>";
            foreach ($xml->prediccion->dia as $dia) {
                $numPeriodos = count($dia->prob_precipitacion);
                foreach ($dia->temperatura as $t) {
                    $max = $t->maxima;
                    $min = $t->minima;
                    echo "<td colspan='$numPeriodos'>$min/$max</td>";
                }
            }
            echo "</tr>";
            
            echo "</table>";
    }

    function obtenerDatos($nombre) {
        $fichero = fopen($nombre, "r") or die("No se ha podido abrir el archivo");
        $datos = file($nombre, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        fclose($fichero);
        return $datos;
    }

    function obtenerLinea($dato, $separador) {
        $linea = explode($separador, $dato);
        return $linea;
    }

    function imprimirTablaCsv($censo) {
        echo "<br><br>";
        echo "<table>";

        echo "<tr>";
        $linea = obtenerLinea($censo[1], ";");
        echo "<td></td>";
        $anio = $linea[2];
        echo "<td colspan='2'>$anio</td>";
        $linea = obtenerLinea($censo[2], ";");
        $anio = $linea[2];
        echo "<td colspan='2'>$anio</td>";
        echo "</tr>";
        
        echo "<tr>";
        echo "<td></td>";
        $linea = obtenerLinea($censo[1], ";");
        $hombre = $linea[1];
        $linea = obtenerLinea($censo[3], ";");
        $mujer = $linea[1];
        echo "<td>$hombre</td>";
        echo "<td>$mujer</td>";
        echo "<td>$hombre</td>";
        echo "<td>$mujer</td>";
        echo "</tr>";

        echo "<tr>";
        $linea = obtenerLinea($censo[1], ";");
        $total = $linea[0];
        echo "<td>$total</td>";
        $linea = obtenerLinea($censo[1], ";");
        $totalH23 = $linea[3];
        echo "<td>$totalH23</td>";
        $linea = obtenerLinea($censo[3], ";");
        $totalM23 = $linea[3];
        echo "<td>$totalM23</td>";
        $linea = obtenerLinea($censo[2], ";");
        $totalH22 = $linea[3];
        echo "<td>$totalH22</td>";
        $linea = obtenerLinea($censo[4], ";");
        $totalM22 = $linea[3];
        echo "<td>$totalM22</td>";
        echo "</tr>";

        $datos = array();
        $cont = 0;

        foreach ($censo as $i => $dato) {
            if ($i >= 5) {
                if ($cont != 4) {
                    array_push($datos, $dato);
                    $cont += 1;
                    if ($cont == 4) {
                        imprimirCeldasProvincia($datos);
                        unset($datos);
                        $datos = array();
                        $cont = 0;
                    }
                }
            }
        }

        echo "</table>";
    }

    function imprimirCeldasProvincia($datos) {
        $cadena = "";
        foreach ($datos as $i => $dato) {
            if ($i < (count($datos) - 1)) {
                $cadena .= $dato . ";";
            }else {
                $cadena .= $dato;
            }
        }

        $array = explode(";", $cadena);
        $array = array_unique($array);

        $eliminar = array('Hombre', '2023', '2022', 'Mujer');

        foreach ($eliminar as $x) {
            if (($key = array_search($x, $array)) !== false) {
                unset($array[$key]);
            }
        }

        $array = array_values($array);

        $provincia = $array[0];
        $numH23 = $array[1];
        $numH22 = $array[2];
        $numM23 = $array[3];
        $numM22 = $array[4];

        echo "<tr>";
        echo "<td>$provincia</td>";
        echo "<td>$numH23</td>";
        echo "<td>$numM23</td>";
        echo "<td>$numH22</td>";
        echo "<td>$numM22</td>";
        echo "</tr>";
    }

    function imprimirTablaTxt($censo) {
        echo "<br><br>";
        echo "<table>";

        echo "<tr>";
        echo "<td></td>";
        $linea = obtenerLinea($censo[4], ",");
        $anio = $linea[1];
        echo "<td colspan='2'>$anio</td>";
        $anio = $linea[3];
        echo "<td colspan='2'>$anio</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td></td>";
        $linea = obtenerLinea($censo[5], ",");
        $hombre = $linea[1];
        $mujer = $linea[2];
        echo "<td>$hombre</td>";
        echo "<td>$mujer</td>";
        echo "<td>$hombre</td>";
        echo "<td>$mujer</td>";
        echo "</tr>";

        echo "<tr>";
        $linea = obtenerLinea($censo[6], ",");
        foreach ($linea as $x) {
            if (!empty($x)) {
                echo "<td>$x</td>";
            }
        }
        echo "</tr>";

        $mostrado = false;
        foreach ($censo as $i => $dato) {
            if ($i >= 7 && $i < count($censo) -2) {
                echo "<tr>";
                $linea = obtenerLinea($dato, ",");
                
                foreach ($linea as $i => $x) {
                    if (!empty($x)) {
                        if (count($linea) == 7) {
                            if (!$mostrado) {
                                $provincia = $linea[0] . "," . $linea[1];
                                echo "<td>$provincia</td>";
                                $mostrado = true;
                            }
                            if ($i != 0 && $i != 1) {
                                echo "<td>$x</td>";
                            }
                        }else {
                            echo "<td>$x</td>";
                        }
                    }
                }
                echo "</tr>";
                $mostrado = false;
            }
        }

        echo "</table>";
    }