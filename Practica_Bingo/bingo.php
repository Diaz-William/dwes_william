<!DOCTYPE html>
<html>
    <body>
        <?php
            include 'lib.php';
            $jugadores = array();
            $bolas = array();
            $cantJugadores = 4;
            $cantCartones = 3;
            $jugadores = rellenarJugadores($jugadores, $cantJugadores, $cantCartones);
            $bolas = bombo($bolas);            
            $jugadores = rellenarCartones($jugadores);
            mostrarBolas($bolas);
            $jugadores = contarAciertos($jugadores, $bolas);
            visualizar($jugadores);
        ?>
    </body>
</html>