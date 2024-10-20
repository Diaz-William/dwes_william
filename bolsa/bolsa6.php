<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>bolsa6.php</title>
    </head>
    <body>
    <h1>Ibex 35</h1>
    <?php
        include 'funciones_bolsa.php';

        $datos = obtenerDatos();

        mostrarDatos($datos);
    ?>
    </body>
</html>