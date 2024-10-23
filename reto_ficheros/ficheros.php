<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            table, th, td {
                border:1px solid black;
            }
        </style>
    </head>
    <body>
        <?php
            include 'errores_sistema.php';
            set_error_handler("error_function");

            $xml = obtenerXML("pronosticotiempoLasRozas");

            $nombre = $xml->nombre;
            
            echo "<table>";

            echo "<tr>";
            echo "<td>$nombre</td>";
            foreach ($xml->prediccion->dia as $dia) {
                $fecha = $dia['fecha'];
                $num_periodos = count($dia->prob_precipitacion);
                echo "<td colspan='$num_periodos'>$fecha</td>";
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
                    $direccion = $v->$direccion;
                    $velocidad = $v->velocidad;
                    echo "<td>$direccion $velocidad</td>";
                }
            }
            echo "</tr>";
            
            echo "</table>";
        ?>
        
        <?php
            function obtenerXML($nombre) {
                $nombre .= ".xml";
                $xml = simplexml_load_file($nombre) or die("Error: No se puede cargar el archivo XML");
                return $xml;
            }
        ?>
    </body>
</html>