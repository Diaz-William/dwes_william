<!DOCTYPE html>
<html>
    <head>
        <title>EJ1-Conversion IP Decimal a Binario</title>
    </head>
    <body>
        <?php
            $ip="192.18.16.204";
            printf("<p>La ip " . $ip ." en binario es %b.</p>" . PHP_EOL, $ip);

            $txt = sprintf("La ip " . $ip ." en binario es %b.", $ip);
            echo $txt;
        ?>
    </body>
</html>