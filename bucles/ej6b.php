<!DOCTYPE html>
<html>
    <head>
        <title>EJ6B - Factorial</title>
    </head>
    <body>
        <?php
            $num = "5";
            $aux = "1";
            
            for ($i = 1; $i <= $num; $i++) {
				$aux = $aux * $i;
            }
            
            print($aux);
        ?>
    </body>
</html>