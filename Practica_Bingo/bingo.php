<!DOCTYPE html>
<html>
    <body>
        <?php
            $jugadores = array(
                "Jugador1" => array(
                    "Carton1" => array("numeros" => array(), "aciertos" => 0),
                    "Carton2" => array("numeros" => array(), "aciertos" => 0),
                    "Carton3" => array("numeros" => array(), "aciertos" => 0)
                ),
                "Jugador2" => array(
                    "Carton1" => array("numeros" => array(), "aciertos" => 0),
                    "Carton2" => array("numeros" => array(), "aciertos" => 0),
                    "Carton3" => array("numeros" => array(), "aciertos" => 0)
                ),
                "Jugador3" => array(
                    "Carton1" => array("numeros" => array(), "aciertos" => 0),
                    "Carton2" => array("numeros" => array(), "aciertos" => 0),
                    "Carton3" => array("numeros" => array(), "aciertos" => 0)
                ),
                "Jugador4" => array(
                    "Carton1" => array("numeros" => array(), "aciertos" => 0),
                    "Carton2" => array("numeros" => array(), "aciertos" => 0),
                    "Carton3" => array("numeros" => array(), "aciertos" => 0)
                )
            );
            
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
                foreach ($jugadores as $jugador => &$cartones) {
                    foreach ($cartones as $carton => &$datosCarton) {
                        foreach ($datosCarton['numeros'] as $numero) {
                            foreach ($bolas as $bola) {
                                if ($numero == $bola) {
                                    $datosCarton['aciertos']++;
                                }
                            }
                        }

                        if ($datosCarton['aciertos'] == 15) {
                            echo "$jugador ha ganado con el $carton!<br>";
                        }
                    }
                }
            }

            function mostrarBolas($bolas) {
                for ($i = 0; $i < count($bolas); $i++) {
                    echo $bolas[$i];

                    if ($i < count($bolas) - 1) {
                        echo ", ";
                    }
                }
            }            

            rellenarCartones($jugadores);

            echo "Bolas sacadas: ";
            mostrarBolas($bolas);
            echo ".<br><br>";

            contarAciertos($jugadores, $bolas);

            //echo "<pre>";
            echo "Cartones después de contar aciertos:\n";
            print_r($jugadores);
            //echo "</pre>";
        ?>
    </body>
</html>
