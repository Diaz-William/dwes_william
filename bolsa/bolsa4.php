<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>bolsa4.php</title>
    </head>
    <body>
    <h1>Ibex 35</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <?php
        include 'funciones_bolsa.php';
        $nombre = obtenerNombre();
        imprimirFormulario($nombre);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $valor = test_input($_POST["valores"]);
            $datos = obtenerDatos();
            datosCotizacion($datos, $valor, $nombre);
        }
    ?>
    </body>
</html>