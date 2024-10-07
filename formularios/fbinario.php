<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FBinario</title>
    </head>
    <body>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <label>Número Decimal</label>
            <input type="number" name="num"><br><br>
            <input type="submit" value="Enviar">
            <input type="reset" value="Borrar">
        </form>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $num = $_REQUEST["num"];
                $binario = decbin($num);

                echo "<label>Número Decimal</label>";
                echo "<input type='text' value='$num' readonly><br><br>";
                echo "<label>Número Binario</label>";
                echo "<input type='text' value='$binario' readonly><br><br>";
            }
        ?>
    </body>
</html>