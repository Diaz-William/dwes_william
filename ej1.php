<!DOCTYPE html>
<html>
    <head>
        <title>EJ1-Conversion IP Decimal a Binario</title>
    </head>
    <body>
        <?php
            $ip="192.18.16.204";
            $octetos = explode(".", $ip);

            print("La ip " . $ip . " en binario es ");

            for ($i = 0; $i < count($octetos); $i++) {
                printf("%b", $octetos[$i]);
                if ($i < count($octetos)) {
                    print(".");
                }
            }
            
        ?>
    </body>
</html>