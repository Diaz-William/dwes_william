<?php
//--------------------------------------------------------------------------
    // Función para limpiar la entrada de datos del usuario.
	function test_input($data) {
        // Elimina espacios en blanco al inicio y final de la cadena.
        $data = trim($data);
        // Elimina barras invertidas escapadas.
        $data = stripslashes($data);
        // Convierte caracteres especiales en entidades HTML.
        $data = htmlspecialchars($data);
        // Devuelve la cadena limpia.
        return $data;
    }
//--------------------------------------------------------------------------
    // Función para rellenar los jugadores con sus nombres y sus datos.
	function rellenarJugadores($nombres) {
        // Inicializa un array vacío para almacenar a los jugadores.
        $jugadores = array();

        // Recorre la lista de nombres recibidos.
        foreach ($nombres as $nombre) {
            // Si el nombre no está vacío:
            if (!empty($nombre)) {
                // Añade el jugador con sus datos iniciales (resultados vacíos, suma 0, sin premio, no ganador).
                $jugadores[$nombre] = array("resultados" => array(), "suma" => 0, "premio" => 0, "ganador" => false);
            }
        }

        // Devuelve el array de jugadores con sus datos iniciales.
        return $jugadores;
    }
//--------------------------------------------------------------------------
    // Función para repartir las cartas de los jugadores y realizar la suma.
	function repartirCartas($jugadores, $numcartas) {
        // Obtiene el mazo completo de cartas españolas.
        $cartas = obtenerCartas();
        // Mezcla las cartas aleatoriamente.
        shuffle($cartas);
        
        // Recorre los jugadores por referencia.
        foreach ($jugadores as $jugador => &$datos) {
            // Asigna el número de cartas especificado.
            for ($i = 0; $i < $numcartas; $i++) {
                // Saca una carta del final del mazo.
                $carta = array_pop($cartas);
                // Añade la carta a los resultados del jugador.
                array_push($datos["resultados"], $carta);
                // Obtiene el primer carácter (valor de la carta).
                $valor = substr($carta, 0, 1);
                // Cartas S (sota), C (caballo), R (rey) valen 0.5; las demás son valores numéricos.
                $datos["suma"] += ($valor === "S" || $valor === "C" || $valor === "R") ? 0.5 : intval($valor);
            }
        }

        // Devuelve los jugadores con sus cartas y suma actualizadas.
        return $jugadores;
    }
//--------------------------------------------------------------------------
    // Función para obtener las cartas de la baraja española.
    function obtenerCartas() {
        // Inicializa un array vacío para las cartas.
        $cartas = array();
        // Los palos: Bastos, Copas, Espadas, Oros.
        $palos = array("B", "C", "E", "O");
        // Los valores de las cartas.
        $valores = array("1", "2", "3", "4", "5", "6", "7", "C", "R", "S");

        // Para cada palo:
        foreach ($palos as $palo) {
            // Para cada valor:
            foreach ($valores as $valor) {
                // Crea la carta combinando palo y valor.
                array_push( $cartas, $palo . $valor);
            }
        }

        // Devuelve el mazo completo.
        return $cartas;
    }
//--------------------------------------------------------------------------
	// Función para obtener todos los ganadores y repartir el premio.
	function obtenerGanadores(&$jugadores, $apuesta) {
        // Booleano para determinar si hay algún ganador exacto.
		$seguir = true;
        // Booleano para verificar si existen ganadores.
        $hayGanadores = true;

        // Recorre los jugadores por referencia.
		foreach ($jugadores as $jugador => &$datos) {
            // Si algún jugador tiene exactamente 7.5 puntos:
            if ($datos["suma"] === 7.5) {
                // Marca como ganador.
                $datos["ganador"] = true;
                // No se necesita buscar aproximaciones.
                $seguir = false;
            }
        }

        // Si no hay ganadores exactos:
        if ($seguir) {
            // Inicializa el mínimo como infinito.
            $minimo = INF;

            // Busca la mejor aproximación (menor diferencia con 7.5).
            foreach ($jugadores as $jugador => $datos) {
                // Si la suma de puntos del jugador es menor que 7.5:
                if ($datos["suma"] < 7.5) {
                    // Gurdar como mínimo el resultado de la resta.
                    $minimo = min($minimo, 7.5 - $datos["suma"]);
                }
            }

            // Si se encontró una aproximación válida:
            if ($minimo != INF) {
                // Recorre los jugadores por referencia.
                foreach ($jugadores as $jugador => &$datos) {
                    // Si alguna resta es exactamente el mínimo:
                    if ((7.5 - $datos["suma"]) == $minimo) {
                        // Marca como ganadores a quienes tienen esa aproximación.
                        $datos["ganador"] = true;
                    }
                }
            }else {
                // Si no hay ganadores posibles.
                $hayGanadores = false;
            }
        }

        // Si hay ganadores:
        if ($hayGanadores) {
            // Inicializa un contador para los ganadores.
            $contador = 0;

            // Recorre los jugadores.
            foreach ($jugadores as $jugador => $datos) {
                // Si el jugador es ganador:
                if ($datos["ganador"]) {
                    // Aumenta el contador en 1.
                    $contador += 1;
                }
            }

            // Calcula el premio por ganador.
            $premio = floatval($apuesta / $contador);
            
            // Recorre los jugadores por referencia.
            foreach ($jugadores as $jugador => &$datos) {
                // Si el jugador es ganador:
                if ($datos["ganador"]) {
                    // Asigna el premio a cada ganador.
                    $datos["premio"] = $premio;
                }
            }
        }
	}
//--------------------------------------------------------------------------
    // Función para mostrar los resultados de los jugadores.
	function mostrarResultados($jugadores) {
		echo "<hr>";
		echo "<table>";
		
        // Recorre los jugadores.
        foreach ($jugadores as $jugador => $datos) {
			echo "<tr>";
            // Muestra el nombre del jugador.
			echo "<td>$jugador</td>";
            // Recorre los resultados del jugador.
            foreach ($datos["resultados"] as $carta) {
                // Muestra sus cartas como imágenes.
                echo "<td><img src='images/$carta.PNG' style='width: 50px; height: 50px; margin: 5px;'></td>";
            }
			echo "</tr>";
        }
		
		echo "</table>";
		echo "<hr>";
		
        // Recorre los jugadores.
		foreach ($jugadores as $jugador => $datos) {
            // Muestra la suma de cada jugador.
            echo "<p>$jugador: " . $datos["suma"] . "</p>";
        }
    }
//--------------------------------------------------------------------------
    // Función para mostrar los ganadores o el bote.
	function mostrarGanadores($jugadores, $apuesta) {
        // Booleano para verificar si hay ganadores.
        $noGanadores = true;

		echo "<hr>";

        // Recorre los jugadores.
        foreach ($jugadores as $jugador => $datos) {
            // Si el jugador es ganador:
            if ($datos["ganador"]) {
                // Muestra su nombre.
                echo "<p>Ganador: $jugador</p>";
                // Muestra su premio.
                echo "<p>Premio: $jugador => " . $datos["premio"] ."</p>";
                // Indica que hay ganadores.
                $noGanadores = false;
            }
        }

        // Si no hay ganadores:
        if ($noGanadores) {
            echo "<p>No hay ganadores</p>";
            // Muestra el bote acumulado.
            echo "<p>Bote: $apuesta</p>";
        }

        echo "<hr>";
	}
//--------------------------------------------------------------------------
    // Función para guardar las apuestas en el archivo apuestas.txt.
    function guardarApuestas($jugadores) {
        // Abre el archivo en modo escritura.
        $fichero = fopen("apuestas.txt", "w+");

        // Si no se puede abrir:
        if (!$fichero) {
            // Lanza un error.
            trigger_error("No se ha podido abrir el archivo apuestas.txt");
        }else {
            // Recorre los jugadores.
            foreach ($jugadores as $jugador => $datos) {
                // Guarda los datos de cada jugador en el archivo.
                fwrite($fichero, $jugador . "***" . $datos["suma"] . "***" . $datos["premio"] . "\n");
            }

            // Cierra el archivo.
            fclose($fichero);
        }
    }    
//--------------------------------------------------------------------------