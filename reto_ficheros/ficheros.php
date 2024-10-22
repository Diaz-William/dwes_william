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

            $xml = obtenerXML("pronosticotiempoLasRozas");

            $nombre = $xml -> nombre;
            $fechas = array();
            $probPrecipitacion = array();


            foreach ($xml -> prediccion -> dia as $x) {
                array_push($fechas, $x['fecha']);
            }

            imprimirTabla($nombre);
            
        ?>
    </body>
</html>