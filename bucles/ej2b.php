<!DOCTYPE html>
<html>
    <head>
        <title> EJ2B - Conversor Decimal a base n</title>
    </head>
    <body>
        <?php
            $decimal = "48";
            $convertido = "";
            $base = "2";

            while ($decimal > 0) {
                $resto = $decimal % $base;
                $convertido = $resto . $convertido;
                $decimal = floor($decimal / $base);
            }
            
            print($convertido);
        ?>
    </body>
</html>