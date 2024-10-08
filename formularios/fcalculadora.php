<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FCalculadora</title>
    </head>
    <body>
        <h1>Calculadora</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label>Número 1</label>
            <input type="text" name="num1"><br><br>
            <label>Número 2</label>
            <input type="text" name="num2">
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
            $resultado = $num1 = $num2 = 0;
            $operacion = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $operacion = test_input($_POST["operacion"]);
                $num1 = floatval(test_input($_POST["num1"]));
                $num2 = floatval (test_input($_POST["num2"]));

                switch ($operacion) {
                    case "suma":
                        $resultado = suma($num1, $num2);
                        echo "<p>Resultado de la operación: $num1 + $num2 = $resultado</p>";
                        break;
                    case "resta":
                        $resultado = resta($num1, $num2);
                        echo "<p>Resultado de la operación: $num1 - $num2 = $resultado</p>";
                        break;
                    case "producto":
                        $resultado = producto($num1, $num2);
                        echo "<p>Resultado de la operación: $num1 * $num2 = $resultado</p>";
                        break;
                    case "division":
                        $resultado = division($num1, $num2);
                        echo "<p>Resultado de la operación: $num1 / $num2 = $resultado</p>";
                        break;
                }
            }

            function suma($num1, $num2) {
                return $num1 + $num2;
            }

            function resta($num1, $num2) {
                return $num1 - $num2;
            }

            function producto($num1, $num2) {
                return $num1 * $num2;
            }

            function division($num1, $num2) {
                if ($num2 == 0) {
                    return "Error: división por cero";
                }else {
                    return $num1 / $num2;
                }
            }

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        ?>
    </body>
</html>