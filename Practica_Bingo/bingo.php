<!DOCTYPE html>
<html>
    <body>
        <?php
            $jugador1 = array("Carton1" => array(), "Carton2" => array(), "Carton3" => array());
            $jugador2 = array("Carton1" => array(), "Carton2" => array(), "Carton3" => array());
            $jugador3 = array("Carton1" => array(), "Carton2" => array(), "Carton3" => array());
            $jugador4 = array("Carton1" => array(), "Carton2" => array(), "Carton3" => array());
            $bolas = range(1, 60);
            shuffle($bolas);

            $jugador1 = rellenar($jugador1);
            $jugador2 = rellenar($jugador2);
            $jugador3 = rellenar($jugador3);
            $jugador4 = rellenar($jugador4);

            visualizar($jugador1, 1);
            visualizar($jugador2, 2);
            visualizar($jugador3, 3);
            visualizar($jugador4, 4);
            
            function rellenar($jugador)
            {
                foreach ($jugador as $key => $valor)
                {
                    $jugador[$key] = rellenarCarton();
                }
                return $jugador;
            }
            function rellenarCarton()
            {
                $numeros = array();

                $rango1 = range(1, 12);
                $rango2 = range(13, 24);
                $rango3 = range(25, 36);
                $rango4 = range(37, 48);
                $rango5 = range(49, 60);

                shuffle($rango1);
                shuffle($rango2);
                shuffle($rango3);
                shuffle($rango4);
                shuffle($rango5);

                $rango1= array_slice($rango1,0,3);
                $rango2= array_slice($rango2,0,3);
                $rango3= array_slice($rango3,0,3);
                $rango4= array_slice($rango4,0,3);
                $rango5= array_slice($rango5,0,3);

                sort($rango1);
                sort($rango2);
                sort($rango3);
                sort($rango4);
                sort($rango5);

                for($i =0;$i<3;$i++)
                {
                    $numeros[]=$rango1[$i];
                    $numeros[]=$rango2[$i];
                    $numeros[]=$rango3[$i];
                    $numeros[]=$rango4[$i];
                    $numeros[]=$rango5[$i];
                }

                return ($numeros);
            }

            function visualizar($jugador, $num)
            {
                echo "<div style='display: flex; gap: 20px; justify-content: space-around;'>";
                echo "<div><h2>Jugador $num</h2></br>";
                // Visualizar los cartones del jugador 1 en una tabla 3x5
                foreach ($jugador as $key => $valor) {
                    echo "<div style='margin: 10px;'>";
                    echo "<h3>$key</h3>";
                    echo "<table border='1' style='border-collapse: collapse;'>";
                    // Para formar 3 filas (5 columnas cada una)
                    for ($fila = 0; $fila < 3; $fila++) {
                        echo "<tr>";
                        for ($columna = 0; $columna < 5; $columna++) {
                            // Calcular el índice correcto del array
                            $indice = $fila * 5 + $columna;
                            echo "<td style='padding: 10px; text-align: center;'>{$valor[$indice]}</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "</div>";
                }
                echo "</div>";
            }
        ?>
        <script>
            // Creamos un array en JavaScript a partir de los datos que genera PHP
            let bolas = [
                <?php
                    // Generamos la lista de bolas en formato de array de JavaScript
                    echo implode(',', $bolas);
                ?>
            ];
            let cont = 0;
            function generarBola()
            {
                if (cont < bolas.length)
                {
                    // Mostrar la bola actual
                    let ruta = "imagenes/"+bolas[cont]+".png";
                    let img = document.createElement('img');
                    img.src = ruta;
                    document.body.contenedor.appendChild(img);
                    cont++;
                } else {
                    let p = document.createElement('p');
                    p = "No hay más bolas";
                    document.body.contenedor.appendChild(p);
                }
            }
        </script>
    </body>
    <div name="contenedor" style="border: 1px solid black; border-radius: 25px; height:50vh;">
        <button onclick="generarBola();" style="height:min-content; margin: 0 45vw; margin-top: 10px;">Tirada</button>
    </div>
</html>