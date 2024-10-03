<!DOCTYPE html>
<html>
    <body>
        <?php
            include 'lib.php';
            $jugadores = array();
            $cantJugadores = 4;
            $cantCartones = 3;
            
            for ($i = 1; $i <= $cantJugadores; $i++) {
                $jugadores["Jugador" . $i] = array();
                for ($j = 1; $j <= $cantCartones; $j++) {
                    $jugadores["Jugador" . $i]["Carton" . $j] = array("numeros" => array(), "aciertos" => 0);
                }
            }
            //BOLAS BOMBO
            $bolas = range(1, 60);
            shuffle($bolas);

            rellenarCartones($jugadores);
            mostrarBolas($bolas);
            contarAciertos($jugadores, $bolas);
            visualizar($jugadores);
            
        ?>
    </body>
</html>