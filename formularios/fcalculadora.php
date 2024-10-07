<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FCalculadora</title>
    </head>
    <body>
        <h1>Calculadora</h1>
        <form action=<?php $_SERVER["PHP_SELF"];?> method="post" name="formulario">
            <label>Número 1</label>
            <input type="number" name="num1"><br><br>
            <label>Número 2</label>
            <input type="number" name="num2">
            <br><br>
            <label>Selecciona operación:</label><br><br>
            <input type="radio" id="suma" name="operacion" value="suma">
            <label for="suma">Suma</label><br><br>
            <input type="radio" id="resta" name="operacion" value="resta">
            <label for="resta">Resta</label><br><br>
            <input type="radio" id="producto" name="operacion" value="producto">
            <label for="producto">Producto</label><br><br>
            <input type="radio" id="division" name="operacion" value="division">
            <label for="division">División</label><br><br>
            <input type="submit" value="Enviar">
            <input type="reset" value="Borrar">
        </form>
        <?php
            $resultado = 0;
            $operacion = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $operacion = $_REQUEST["operacion"];
                switch ($operacion) {
                    case "suma":
                        $resultado = $_REQUEST["num1"] + $_REQUEST["num2"];
                        echo "<p>Resultado de la operación: " . $_REQUEST["num1"] . " + " . $_REQUEST["num2"] . " = " . $resultado ."</p>";
                        break;
                    case "resta":
                        $resultado = $_REQUEST["num1"] - $_REQUEST["num2"];
                        echo "<p>Resultado de la operación: " . $_REQUEST["num1"] . " - " . $_REQUEST["num2"] . " = " . $resultado ."</p>";
                        break;
                    case "producto":
                        $resultado = $_REQUEST["num1"] * $_REQUEST["num2"];
                        echo "<p>Resultado de la operación: " . $_REQUEST["num1"] . " * " . $_REQUEST["num2"] . " = " . $resultado ."</p>";
                        break;
                    case "division":
                        $resultado = $_REQUEST["num1"] / $_REQUEST["num2"];
                        echo "<p>Resultado de la operación: " . $_REQUEST["num1"] . " / " . $_REQUEST["num2"] . " = " . $resultado ."</p>";
                        break;
                }
            }
        ?>
    </body>
</html>