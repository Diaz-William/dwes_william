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
            include 'funciones.php';
            include 'errores_sistema.php';
            set_error_handler("error_function");

            $xml1 = obtenerXML("pronosticotiempoLasRozas");

            $nombre = $xml1 -> nombre;
            $fechas = array();
            $periodos = array();


            foreach ($xml1 -> prediccion -> dia as $x) {
                array_push($fechas, $x['fecha']);
            }

            foreach ($xml1 -> prediccion -> dia as $x) {
                array_push($periodos, $x -> prob_precipitacion['periodo']);
            }

            imprimirTabla($nombre, $fechas);
            var_dump($periodos);
        ?>
    </body>
</html>