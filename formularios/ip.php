<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ip.php</title>
    </head>
    <body>
        <h1>IPs</h1>
        <?php
            $ip = "";
            $octetos = array();
            $octeto1 = $octeto2 = $octeto3 = $octeto4 = 0;

            $ip = test_input($_REQUEST["ip"]);

            if (validarIP($ip)) {
                $octetos = explode(".", $ip);

                $octeto1 = str_pad(decbin($octetos[0]), 8, "0", STR_PAD_LEFT);
                $octeto2 = str_pad(decbin($octetos[1]), 8, "0", STR_PAD_LEFT);
                $octeto3 = str_pad(decbin($octetos[2]), 8, "0", STR_PAD_LEFT);
                $octeto4 = str_pad(decbin($octetos[3]), 8, "0", STR_PAD_LEFT);

                echo "<label>IP notación decimal</label>&nbsp;";
                echo "<input type='text' name='num' value='$ip' readonly><br><br>";

                $ipBinaria = "$octeto1.$octeto2.$octeto3.$octeto4";
                echo "<label>IP Binario</label>&nbsp;";
                echo "<input type='text' name='num' value='$ipBinaria' size='50' readonly><br><br>";
            }else {
                echo "<p>Introduce una IP valida</p>";
            }

            function validarIP($ip) {
                return filter_var($ip, FILTER_VALIDATE_IP);
            }

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        ?>
    </body>
</html>