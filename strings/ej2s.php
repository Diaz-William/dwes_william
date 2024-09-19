<!DOCTYPE html>
<html>
    <head>
        <title>EJ2-Conversion IP Decimal a Binario</title>
    </head>
    <body>
        <?php
            $ip = "192.18.16.204";
            $octetos = explode(".", $ip);

            print("La ip " . $ip . " en binario es ");
            for ($i = 0; $i < count($octetos); $i++) {
                $octetos[$i] = decbin($octetos[$i]);
            }
            for ($i = 0; $i < count($octetos); $i++) {
                while (strlen($octetos[$i]) < 8) {
					$octetos[$i] = "0" . $octetos[$i];
                }
                print($octetos[$i]);
                if ($i < count($octetos) - 1) {
                    print(".");
                }
            }
        ?>
    </body>
</html>