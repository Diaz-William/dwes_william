<!DOCTYPE html>
<html>
    <head>
        <title> EJ2B - Conversor Decimal a base n</title>
    </head>
    <body>
        <?php
            $decimal = "48";
            $convertido = "";
            $base = "8";
            $copia = $decimal;

            while ($decimal > 0) {
                $resto = $decimal % $base;
                $convertido = $resto . $convertido;
                $decimal = floor($decimal / $base);
            }
            
            print("Número " . $copia . " en base " . $base . " = " . $convertido);
        ?>
    </body>
</html>