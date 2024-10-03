<!DOCTYPE html>
<html>
    <body>
        <?php
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

                echo "<div name='contenedor' style='border: 1px solid black; border-radius: 25px; height:max-content; padding: 50px;'>";

                while ($cont < 61 && $seguir )
                {
                    mostrarBolas($bolas[$cont]);
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

                echo "</div>";
                echo "<br><br>";
                
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
            function mostrarBolas($bola) {
            	//Contenedor visual del bombo   
                    echo "<img src='imagenes/$bola.PNG'>";
            }
            rellenarCartones($jugadores);
            
            contarAciertos($jugadores, $bolas);
            visualizar($jugadores);
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
    </body>
</html>