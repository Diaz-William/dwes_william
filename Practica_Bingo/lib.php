<?php
    function rellenarCartones(&$jugadores) {
        foreach ($jugadores as $jugador => &$cartones) {
            foreach ($cartones as $carton => &$datosCarton) {
                $bolasCarton = range(1, 60);
                shuffle($bolasCarton);
                $datosCarton['numeros'] = array_slice($bolasCarton, 0, 15);
            }
        }
    }

    function contarAciertos(&$jugadores, $bolas) {
        $aciertos = 0;
        $cont = 1;
        $seguir = true;

        while ($cont < 61 && $seguir )
        {
            
            foreach ($jugadores as $jugador => &$cartones) {
                $aciertos = 0;
                foreach ($cartones as $carton => &$datosCarton) {
                    if (in_array($bolas[$cont-1], $datosCarton['numeros'])) {
                        $datosCarton['aciertos']++;
                    }
                    $aciertos = $datosCarton['aciertos'];
                }
            }
            if ($aciertos == 15) {
                visualizarGanadores($jugadores);
                $seguir = false;
            }
            $cont++;
        }
        
    }

    function visualizarGanadores($jugadores) {
        foreach ($jugadores as $jugador => &$cartones) {
            foreach ($cartones as $carton => &$datosCarton) {
                if ($datosCarton['aciertos'] == 15) {
                    echo "$jugador ha ganado con el $carton<br>";
                }
            }
        }
    }

    function mostrarBolas($bolas) {
        //Contenedor visual del bombo
        echo "<div name='contenedor' style='border: 1px solid black; border-radius: 25px; height:max-content; padding: 50px;'>";
        for ($i = 0; $i < count($bolas); $i++) {
            echo "<img src='imagenes/$bolas[$i].PNG'>";
        }
        echo "</div>";
        echo "<br><br>";
    }

    function visualizar($jugadores){
        echo "<div style='margin-bottom: 30px;'>";
        foreach ($jugadores as $jugador => $cartones) {
            echo "<h2 style='text-align: center;'>$jugador</h2>";
            echo "<div style='display: flex; flex-wrap: wrap; justify-content: space-between; gap: 10px; align-items: center;'>";
            foreach ($cartones as $carton => $datosCarton) {
                echo "<table border='1' style='border-collapse: collapse;'>";
                // Visualizar los cartones de cada jugador en una tabla 3x5
                $numeros = $datosCarton['numeros'];
                for ($fila = 0; $fila < 3; $fila++) {
                    echo "<tr>";
                    for ($columna = 0; $columna < 5; $columna++) {
                        // Calcular el índice correcto del array
                        $indice = $fila * 5 + $columna;
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