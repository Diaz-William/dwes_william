<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Calculadora.php</title>
    </head>
    <body>
        <?php
            $resultado = 0;

            if ($_REQUEST["operacion"] == "suma") {
                $resultado = $_REQUEST["num1"] + $_REQUEST["num2"];
                echo "<p>Resultado de la operación: " . $_REQUEST["num1"] . " + " . $_REQUEST["num2"] . " = " . $resultado ."</p>";;
            }

            if ($_REQUEST["operacion"] == "resta") {
                $resultado = $_REQUEST["num1"] - $_REQUEST["num2"];
                echo "<p>Resultado de la operación: " . $_REQUEST["num1"] . " - " . $_REQUEST["num2"] . " = " . $resultado ."</p>";;
            }

            if ($_REQUEST["operacion"] == "producto") {
                $resultado = $_REQUEST["num1"] * $_REQUEST["num2"];
                echo "<p>Resultado de la operación: " . $_REQUEST["num1"] . " * " . $_REQUEST["num2"] . " = " . $resultado ."</p>";;
            }

            if ($_REQUEST["operacion"] == "division") {
                $resultado = $_REQUEST["num1"] / $_REQUEST["num2"];
                echo "<p>Resultado de la operación: " . $_REQUEST["num1"] . " / " . $_REQUEST["num2"] . " = " . $resultado ."</p>";;
            }
        ?>
    </body>
</html>