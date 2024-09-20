<!DOCTYPE html>
<html>
    <head>
        <title>EJ1B - Conversor decimal a binario</title>
    </head>
    <body>
        <?php
            $decimal = "168";
            $binario = "";
            $copia = $decimal;

            while ($decimal > 0) {
                $resto = $decimal % 2;
                $binario = $resto . $binario;
                $decimal = floor($decimal / 2);
            }
            
            print("Número " . $copia . " en binario = " . $binario);
        ?>
    </body>
</html>