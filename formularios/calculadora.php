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
            $resultado = 0;
            $operacion = $_REQUEST["operacion"];
            $num1 = $_REQUEST["num1"];
            $num2 = $_REQUEST["num2"];

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
        ?>
    </body>
</html>
