<?php
    // Función que inicializa a los jugadores y asigna cartones vacíos
    // Cada jugador tiene una estructura que contiene varios cartones con sus números y aciertos
    function rellenarJugadores(&$jugadores, $cantJugadores, $cantCartones) {
        for ($i = 1; $i <= $cantJugadores; $i++) {
            // Crear un array para cada jugador
            $jugadores["Jugador" . $i] = array();

            // Para cada jugador, asignamos el número de cartones especificado
            for ($j = 1; $j <= $cantCartones; $j++) {
                // Cada cartón contiene un array de números y un contador de aciertos
                $jugadores["Jugador" . $i]["Carton" . $j] = array("numeros" => array(), "aciertos" => 0);
            }
        }
    }
//--------------------------------------------------------------------------
    // Función que simula el bombo con números aleatorios del 1 al 60
    function bombo(&$bolas) {
        $bolas = range(1, 60);  // Rango de números del 1 al 60
        shuffle($bolas);        // Mezclar las bolas para que estén en orden aleatorio
    }
//--------------------------------------------------------------------------
    // Función que rellena los cartones de cada jugador con 15 números aleatorios del 1 al 60
    function rellenarCartones(&$jugadores) {
        foreach ($jugadores as $jugador => &$cartones) {
            foreach ($cartones as $carton => &$datosCarton) {
                // Crea un array con números del 1 al 60 y los mezcla
                $bolasCarton = range(1, 60);
                shuffle($bolasCarton);

                // Asigna los primeros 15 números aleatorios al cartón
                $datosCarton['numeros'] = array_slice($bolasCarton, 0, 15);
            }
        }
    }
//--------------------------------------------------------------------------
    // Función que cuenta los aciertos en cada cartón a medida que se sortean las bolas
    // También verifica si hay algún ganador después de cada bola sorteada
    function contarAciertos(&$jugadores, $bolas) {
        echo "<div name='contenedor' style='border: 1px solid black; border-radius: 25px; height:max-content; padding: 50px;'>";

        // Variable para detener el sorteo si hay un ganador
        $ganadores = false;

        // Recorremos las bolas sorteadas
        foreach ($bolas as $bola) {
            // Mostrar la bola sorteada como imagen
            mostrarBola($bola);

            // Recorremos los jugadores para verificar si algún cartón tiene el número sorteado
            foreach ($jugadores as $jugador => &$cartones) {
                foreach ($cartones as $carton => &$datosCarton) {
                    // Si la bola está en el cartón, incrementamos el contador de aciertos
                    if (in_array($bola, $datosCarton['numeros'])) {
                        $datosCarton['aciertos']++;
                    }
                }
            }

            // Verificar si hay ganadores después de cada bola
            $ganadores = verificarGanadores($jugadores);
            if ($ganadores) {
                break;  // Si hay ganadores, terminamos el sorteo
            }
        }

        echo "</div>";
        echo "<br><br>";
    }
//--------------------------------------------------------------------------
    // Función que muestra la imagen de la bola sorteada
    function mostrarBola($bola) {
        echo "<img src='imagenes/$bola.png' alt='Bola $bola' style='width: 50px; height: 50px; margin: 5px;'>";
    }
//--------------------------------------------------------------------------
    // Función que verifica si hay algún jugador con 15 aciertos en un cartón
    function verificarGanadores($jugadores) {
        $ganadores = false;

        // Recorremos los jugadores y sus cartones para verificar los aciertos
        foreach ($jugadores as $jugador => &$cartones) {
            foreach ($cartones as $carton => &$datosCarton) {
                // Si un cartón tiene 15 aciertos, hay un ganador
                if ($datosCarton['aciertos'] == 15) {
                    $ganadores = true;
                }
            }
        }

        return $ganadores; // Retorna true si hay ganadores, false si no hay ganadores
    }
//--------------------------------------------------------------------------
    // Función que visualiza los ganadores
    function visualizarGanadores($jugadores) {
        foreach ($jugadores as $jugador => &$cartones) {
            foreach ($cartones as $carton => &$datosCarton) {
                // Si un cartón tiene 15 aciertos, se muestra que jugador ha ganado y el número del cartón
                if ($datosCarton['aciertos'] == 15) {
                    echo "$jugador ha ganado con el $carton<br>";
                }
            }
        }
    }
//--------------------------------------------------------------------------
    // Función que visualiza los cartones de todos los jugadores
    function visualizar($jugadores) {
        echo "<div style='margin-bottom: 30px;'>";

        // Recorre cada jugador y sus cartones
        foreach ($jugadores as $jugador => $cartones) {
            echo "<h2 style='text-align: center;'>$jugador</h2>";

            echo "<div style='display: flex; flex-wrap: wrap; justify-content: space-between; gap: 10px; align-items: center;'>";

            // Para cada cartón, muestra los 15 números en una tabla de 3x5
            foreach ($cartones as $carton => $datosCarton) {
                echo "<table border='1' style='border-collapse: collapse;'>";

                $numeros = $datosCarton['numeros'];

                for ($fila = 0; $fila < 3; $fila++) {
                    echo "<tr>";
                    for ($columna = 0; $columna < 5; $columna++) {
                        $indice = $fila * 5 + $columna; // Cálculo del índice para obtener el número correcto
                        echo "<td style='padding: 10px; text-align: center;'>{$numeros[$indice]}</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            }
            echo "</div>";
        }
        echo "</div>";
    }
?>