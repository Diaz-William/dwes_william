<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>bolsa2.php</title>
    </head>
    <body>
    <h1>Ibex 35</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label id="valor">Valor</label>
        <input type="text" name="valor" id="valor">
        <br><br>
        <input type="submit" value="Visualizar">
        <input type="reset" value="Borrar">
    </form>
    <?php
        include 'funciones_bolsa.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $datos = obtenerDatos();
            $valor = test_input($_POST["valor"]);
            datosCotizacion($datos, $valor);
        }
    ?>
    </body>
</html>