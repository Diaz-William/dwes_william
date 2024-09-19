<!DOCTYPE html>
<html>
    <head>
        <title>EJ4B - Tabla Multiplicar</title>
    </head>
    <body>
        <?php
            $num = "8";
            
            for ($i = 1; $i <= 10; $i++) {
            	$aux = $num * $i;
            	print($num . " x " . $i . " = " . $aux . "<br>");
            }
        ?>
    </body>
</html>