<!DOCTYPE html>
<html>
    <head>
        <title>EJ3B - Conversor Decimal a base 16</title>
    </head>
    <body>
        <?php
            $decimal = "15";
            $convertido = "";
            $base = "16";
            $letras = array("A", "B", "C", "D", "E", "F");

            while ($decimal > 0) {
                $resto = $decimal % $base;
                
                if ($resto > 9) {
                	$aux = $resto - 10;
                    $resto = $letras[$aux];
                }
                
                $convertido = $resto . $convertido;
                $decimal = floor($decimal / $base);
            }
            
            print($convertido);
        ?>
    </body>
</html>