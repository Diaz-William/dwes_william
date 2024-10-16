<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>bolsa1.php</title>
    </head>
    <body>
    <h1>Ibex 35</h1>
    <?php
        include 'funciones_bolsa.php';

        $fichero = fopen("ibex35.txt", "r") or die("No se ha podido abrir el archivo");
        $datos = file("ibex35.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        fclose($fichero);

        mostrarDatos($datos);
    ?>
    </body>
</html>