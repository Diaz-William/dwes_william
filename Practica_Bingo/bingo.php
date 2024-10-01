<!DOCTYPE html>
<html>
<body>
<?php
	//Contenedor visual del bombo
	echo "<div name='contenedor' style='border: 1px solid black; border-radius: 25px; height:50vh;'>";
	echo "<div id='bolaActual' style='height:37.5vh; font-size: 100pt; text-align:center;'></div>";
    // Bombo con bolas de 1 a 60
    $bolas = range(1, 60);
    shuffle($bolas);
    echo "<button id='boton'onclick='generarBola();' style='height:min-content; margin: 0 50vw; margin-top: 10px;'>Tirada</button>";
	echo "</div>";
    $contador = 1;
	$jugador1 = array("Carton1" => array(), "Carton2" => array(), "Carton3" => array());
    $jugador2 = array("Carton1" => array(), "Carton2" => array(), "Carton3" => array());
    $jugador3 = array("Carton1" => array(), "Carton2" => array(), "Carton3" => array());
    $jugador4 = array("Carton1" => array(), "Carton2" => array(), "Carton3" => array());
    $jugador1 = rellenar($jugador1);
    $jugador2 = rellenar($jugador2);
    $jugador3 = rellenar($jugador3);
    $jugador4 = rellenar($jugador4);
    visualizar($jugador1, 1, $contador);
    $contador += 3;
    visualizar($jugador2, 2, $contador);
    $contador += 3;
    visualizar($jugador3, 3, $contador);
    $contador += 3;
    visualizar($jugador4, 4, $contador);
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
        // Generar números únicos dentro de los rangos definidos
        $rango1 = range(1, 12);
        $rango2 = range(13, 24);
        $rango3 = range(25, 36);
        $rango4 = range(37, 48);
        $rango5 = range(49, 60);
        // Barajar cada rango para obtener números aleatorios
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
        function visualizar($jugador, $num, $contador)
        {
            echo "<div style='margin-bottom: 30px;'>";
            echo "<h2 style='text-align: center;'>Jugador $num</h2>";
            echo "<div style='display: flex; flex-wrap: wrap; justify-content: space-between; gap: 10px; align-items: center;'>";
            // Visualizar los cartones del jugador 1 en una tabla 3x5
            foreach ($jugador as $key => $valor) {
                echo "<div style='margin: 10px;'>";
                echo "<h3 style='text-align: center;'>$key</h3>";
                echo "<table id='$contador' border='1' style='border-collapse: collapse;'>";
                // Para formar 3 filas (5 columnas cada una)
                for ($fila = 0; $fila < 3; $fila++) {
                    echo "<tr>";
                    for ($columna = 0; $columna < 5; $columna++) {
                        // Calcular el índice correcto del array
                        $indice = $fila * 5 + $columna;
                        echo "<td class='$valor[$indice]'; style='padding: 10px; text-align: center;'>{$valor[$indice]}</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
                $contador++;
                echo "</div>";
            }
            echo "</div>";
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
            let ruta = "imagenes/" + bolas[cont] + ".PNG";
            let img = document.createElement('img');
            img.src = ruta;
            img.style.width = "250px";  // Ajustar tamaño de la imagen
            img.style.height = "250px"; // Ajustar tamaño de la imagen
            document.getElementById("bolaActual").innerHTML = ""; // Limpiar texto anterior
            document.getElementById("bolaActual").appendChild(img); // Añadir imagen al contenedor
            
            const arrayBolas = document.getElementsByClassName(bolas[cont]);
            for (let i=0 ; i<arrayBolas.length; i++)
            {
            	arrayBolas[i].style.backgroundColor = "#ADD8E6";
                arrayBolas[i].classList.toggle("tachado");
                for (let i=1 ; i<=12; i++)
                {
                	let contarTachados = 0;
                	let tabla = document.getElementById(i);
                    for (let j=0 ; j < tabla.rows.length ; j++)
                    {
                    	let fila = tabla.rows[j];
                    	for (let x=0 ; x < fila.cells.length ; x++)
                        {
                        	let celda = fila.cells[x];
                            if (celda.classList.contains("tachado"))
                            {
                            	contarTachados++;
                                if (contarTachados == 15)
                                {
                                	switch (i)
                                    {
                                    	case 1:
                                        case 2:
                                        case 3: 				document.getElementById("bolaActual").innerHTML = "Ha ganado el jugador 1";break;
                                        case 4:
                                        case 5:
                                        case 6: 				document.getElementById("bolaActual").innerHTML = "Ha ganado el jugador 2";break;
                                        case 7:
                                        case 8:
                                        case 9: 				document.getElementById("bolaActual").innerHTML = "Ha ganado el jugador 3";break;
                                        case 10:
                                        case 11:
                                        case 12: 				document.getElementById("bolaActual").innerHTML = "Ha ganado el jugador 4";break;
                                    }
                                    document.getElementById("boton").disabled = true;
                                	
                                }
                            }
                        }
                    }
                }
            }
            // Mostrar la bola actual
            /*let ruta = "imagenes/"+bolas[cont]+".png";
            let img = document.createElement('img');
            img.src = ruta;
            document.body.contenedor.appendChild(img);*/
            cont++;
        } else {
        	//let p = document.createElement('p');
            document.getElementById("bolaActual").innerHTML = "No hay más bolas";
            //document.body.bolaActual.appendChild(p);
        }
    }
</script>
</body>
</html>