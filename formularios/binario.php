<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>binario.php</title>
    </head>
    <body>
        <?php
            $num = $_REQUEST["num"];
            $binario = decbin($num);

            echo "<label>Número Decimal</label>&nbsp;";
            echo "<input type='text' value='$num' readonly><br><br>";
            echo "<label>Número Binario</label>&nbsp;";
            echo "<input type='text' value='$binario' readonly><br><br>";
        ?>
    </body>
</html>