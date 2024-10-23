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
            //include 'funciones.php';
            include 'errores_sistema.php';
            set_error_handler("error_function");

            $xml = obtenerXML("pronosticotiempoLasRozas");

            $nombre = $xml -> nombre;
            $fechas = array();
            $periodos = array();


            /*foreach ($xml -> prediccion -> dia as $x) {
                array_push($fechas, $x['fecha']);
            }

            foreach ($xml -> prediccion -> dia as $x) {
                array_push($periodos, $x -> prob_precipitacion['periodo']);
            }*/

            echo "<table>";
            echo "<tr>";
            echo "<td>$xml -> nombre</td>";
            foreach ($xml -> prediccion -> dia as $x) {
                $fecha = $x['fecha'];
                foreach ($x as $y) {
                    array_push($periodos, $y -> prob_precipitacion['periodo']);
                }
                $num = count($periodos);
                echo "<td colspan='$num'>$fecha</td>";
            }
            echo "</tr>";
            echo "<tr>";
            echo "<td>Periodo</td>";
            echo "</tr>";
            echo "</table>";
        ?>
    </body>
</html>