<!DOCTYPE html>
<html>
    <head>
        <title>Bingo</title>
    </head>
    <body>
        <?php
            $jugador1 = array(array(), array(), array());
            $jugador2 = array(array(), array(), array());
            $jugador3 = array(array(), array(), array());
            $jugador4 = array(array(), array(), array());

            $jugador1 = rellenarCartones($jugador1);
            $jugador2 = rellenarCartones($jugador2);
            $jugador3 = rellenarCartones($jugador3);
            $jugador4 = rellenarCartones($jugador4);

            for ($i = 0; $i < count($jugador1); $i++); {
                visualizarCarton($jugador1[$i], 1);
            }


            function rellenarCartones($jugador) {
                $numeros = range(1, 60);
                shuffle($numeros);
                $x = 0;
                $y = 0;

                for ($i = 0; $i < count($numeros); $i++) {
                    if ($i <= 14) {
                        $jugador[0][$i] = $numeros[$i];
                    }
                    if ($i > 14 && $i <= 29) {
                        $jugador[1][$x] = $numeros[$i];
                        $x += 1;
                    }
                    if ($i > 29 && $i <= 44) {
                        $jugador[2][$y] = $numeros[$i];
                        $y += 1;
                    }
                }

                return $jugador;
            }

            function visualizarCarton($jugador, $numJugador) {
                echo "<h1>Jugador - " . $numJugador . "</h1>";
                echo "<table border = 1; style = 'border-collapse: collapse'>";


                    
                    for ($j=0; $j < count($jugador); $j++) {
                        if ($j < 5) {
                            echo "<tr>";
                            echo "<td>" . $jugador[$j] . "</td>";
                            echo "</tr>";
                        }
                        if ($j >= 5 && $j < 10) {
                            echo "<tr>";
                            echo "<td>" . $jugador[$j] . "</td>";
                            echo "</tr>";
                        }
                        if ($j >= 10) {
                            echo "<tr>";
                            echo "<td>" . $jugador[$j] . "</td>";
                            echo "</tr>";
                        }
                    }
                    

                echo "</table>";
            }
        ?>
    </body>
</html>