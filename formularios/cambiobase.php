<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            table, th, td {
                border:1px solid black;
            }
        </style>
    </head>
    <body>
        <h1>Conversor Númerico</h1>

        <?php
            $convertido = $num = 0;
            $base = "";

            $base = test_input($_REQUEST["base"]);
            $num = intval(test_input($_REQUEST["num"]));

            echo "<label>Número Decimal</label>&nbsp;";
            echo "<input type='text' name='num' value='$num' readonly><br><br>";

            switch ($base) {
                case "binario":
                    $convertido = convertir($num, 2);
                    escribir($base, $convertido);
                    break;
                case "octal":
                    $convertido = convertir($num, 8);
                    escribir($base, $convertido);
                    break;
                case "hexadecimal":
                    $convertido = strtoupper(convertir($num, 16));
                    escribir($base, $convertido);
                    break;
                case "todas":
                    tablaTodas($num);
                    break;
            }

            function convertir($num, $base) {
                return base_convert($num, 10, $base);
            }

            function escribir($base, $convertido) {
                $base = ucfirst($base);
                echo "<label>$base</label>&nbsp;";
                echo "<input type='text' name='num' value='$convertido' readonly><br><br>";
            }

            function tablaTodas($num) {
                $convertido = 0;

                echo "<table>";
                echo "<tr>";
                $convertido = convertir($num, 2);
                echo "<th>Binario</th><td>$convertido</td>";
                echo "</tr>";
                echo "<tr>";
                $convertido = convertir($num, 8);
                echo "<th>Octal</th><td>$convertido</td>";
                echo "</tr>";
                echo "<tr>";
                $convertido = strtoupper(convertir($num, 16));
                echo "<th>Hexadecimal</th><td>$convertido</td>";
                echo "</tr>";
                echo "</table>";
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