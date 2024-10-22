<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
            include 'errores_sistema.php';
            set_error_handler("error_function");

            $xml = simplexml_load_file('pronosticotiempoLasRozas.xml') or die("Error: No se puede crear el objeto");

            $nombre = $xml -> nombre;
            $fechas = array();


            foreach ($xml -> prediccion -> dia as $x) {
                array_push($fechas, $x['fecha']);
            }

            var_dump($fechas);

        ?>
    </body>
</html>