<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>bolsa5.php</title>
    </head>
    <body>
    <h1>Ibex 35</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label id="mostrar">Mostrar</label>
        <select id="mostrar" name="mostrar">
            <option value="volumen">Total Volumen</option>
            <option value="capital">Total Capitalización</option>
        </select>
        <br><br>
        <input type="submit" value="Visualizar">
        <input type="reset" value="Borrar">
    </form>
    <?php
        include 'funciones_bolsa.php';
        include 'errores_sistema.php';
        set_error_handler("error_function");
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $opcion = test_input($_POST["mostrar"]);
            $datos = obtenerDatos();
            sumaVolumenCapital($datos, $opcion);
        }
    ?>
    </body>
</html>