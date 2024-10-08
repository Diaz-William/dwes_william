<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Calculadora.php</title>
    </head>
    <body>
        <h1>Calculadora</h1>
        <?php
            $resultado = $num1 = $num2 = 0;
            $operacion = "";

            $operacion = test_input($_REQUEST["operacion"]);
            $num1 = floatval(test_input($_REQUEST["num1"]));
            $num2 = floatval(test_input($_REQUEST["num2"]));

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
