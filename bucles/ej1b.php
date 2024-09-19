<!DOCTYPE html>
<html>
    <head>
        <title>EJ1B - Conversor decimal a binario</title>
    </head>
    <body>
        <?php
            $decimal = "1";
            $binario = "";

            while ($decimal > 0) {
                $resto = $decimal % 2;
                $binario = $resto . $binario;
                $decimal = floor($decimal / 2);
            }
            
            print($binario);
        ?>
    </body>
</html>