<!DOCTYPE html>
<html>
    <head>
        <title>EJ2-Direccion Red - Broadcast y Rango</title>
    </head>
    <body>
        <?php
            $ipMascara = "192.168.16.100/16";
            $partes = explode("/", $ipMascara);
            $mascara = $partes[1];
            $ip = $partes[0];

            $direccion = explode(".", $ip);

            for ($i = 0; $i < ($mascara / 8); $i++) {
                $direccion[count($direccion) -1] = "0";
            }

        ?>
    </body>
</html>