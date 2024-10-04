<!DOCTYPE html>
<html>
    <body>
        <?php
            // Incluir el archivo de funciones "lib.php"
            include 'lib.php';

            // Declaración de las variables iniciales
            $jugadores = array(); // Almacenará la información de los jugadores y sus cartones
            $bolas = array();     // Almacenará las bolas del sorteo
            $cantJugadores = 4;   // Número de jugadores
            $cantCartones = 3;    // Número de cartones por jugador

            // Llamada a las funciones necesarias para ejecutar el bingo

            // Inicializa la estructura de jugadores y sus cartones
            rellenarJugadores($jugadores, $cantJugadores, $cantCartones);

            // Llena el array de bolas sorteadas con números aleatorios del 1 al 60
            bombo($bolas);

            // Rellena los cartones de los jugadores con 15 números aleatorios del 1 al 60
            rellenarCartones($jugadores);

            // Cuenta los aciertos en los cartones en función de las bolas sorteadas
            contarAciertos($jugadores, $bolas);

            // Visualiza los ganadores
            visualizarGanadores($jugadores);

            // Muestra los cartones de cada jugador
            visualizar($jugadores);
        ?>
    </body>
</html>
