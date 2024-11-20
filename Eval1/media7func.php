<?php
//--------------------------------------------------------------------------
    // Función para limpiar la entrada de datos del usuario.
	function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
//--------------------------------------------------------------------------
    // Función para rellenar los jugadores con sus nombres y sus datos.
	function rellenarJugadores($nombres) {
        $jugadores = array();

        for ($i = 0; $i < count($nombres); $i++) { 
            if (!empty($nombres[$i])) {
                $jugadores[$nombres[$i]] = array("resultados" => array(), "suma" => 0, "premio" => 0, "ganador" => false);
            }
        }

        return $jugadores;
    }
//--------------------------------------------------------------------------
    // Función para repartir las cartas de los jugadores y realizar la suma.
	function repartirCartas($jugadores, $numcartas) {
        $cartas = obtenerCartas();
        
        foreach ($jugadores as $jugador => &$datos) {
            for ($i = 0; $i < $numcartas; $i++) {
                $aleatorio = rand(0, (count($cartas) - 1));
                array_push($datos["resultados"], $cartas[$aleatorio]);
            }

            foreach ($datos["resultados"] as $carta) {
                $valor = substr($carta,0, 1);

                if ($valor != "S" && $valor != "C" && $valor != "R") {
                    $valor = intval($valor);
                }else {
                    $valor = 0.5;
                }

                $datos["suma"] += $valor;
            }
        }

        return $jugadores;
    }
//--------------------------------------------------------------------------
    // Función para obtener las cartas de la baraja española.
    function obtenerCartas() {
        $cartas = array();
        $valores = array("B", "C", "E", "O");
        $valoresNum = array("1", "2", "3", "4", "5", "6", "7", "C", "R", "S");

        foreach ($valores as $x) {
            foreach ($valoresNum as $y) {
                $carta = $y . $x;
                array_push( $cartas, $carta);
            }
        }

        return $cartas;
    }
//--------------------------------------------------------------------------
	// Función para obtener todos los ganadores y repartir el premio.
	function obtenerGanadores(&$jugadores, $apuesta) {
		$seguir = true;

		foreach ($jugadores as $jugador => &$datos) {
            if ($datos["suma"] === 7.5) {
                $datos["ganador"] = true;
                $seguir = false;
            }
        }

        
        
        if ($seguir) {
            $aproximaciones = array();

            foreach ($jugadores as $jugador => $datos) {
                if ($datos["suma"] < 7.5) {
                    array_push($aproximaciones, (7.5 - $datos["suma"]));
                }
            }

            if (count($aproximaciones) > 0) {
                $minimo = min($aproximaciones);
                $contador = 0;

                foreach ($jugadores as $jugador => &$datos) {
                    if ((7.5 - $datos["suma"]) == $minimo && (7.5 - $datos["suma"]) > 0) {
                        $datos["ganador"] = true;
                        $contador += 1;
                    }
                }

                $premio = floatval($apuesta / $contador);
                
                foreach ($jugadores as $jugador => &$datos) {
                    if ($datos["ganador"]) {
                        $datos["premio"] = $premio;
                    }
                }
            }
        }else {
            $contador = 0;

            foreach ($jugadores as $jugador => $datos) {
                if ($datos["ganador"]) {
                    $contador += 1;
                }
            }

            $premio = floatval($apuesta / $contador);
            
            foreach ($jugadores as $jugador => &$datos) {
                if ($datos["ganador"]) {
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
		
        foreach ($jugadores as $jugador => $datos) {
			echo "<tr>";
			echo "<td>$jugador</td>";
            foreach ($datos["resultados"] as $carta) {
                echo "<td><img src='images/$carta.PNG' style='width: 50px; height: 50px; margin: 5px;'></td>";
            }
			echo "</tr>";
        }
		
		echo "</table>";
		echo "<hr>";
		
		foreach ($jugadores as $jugador => $datos) {
            echo "<p>$jugador: " . $datos["suma"] . "</p>";
        }
    }
//--------------------------------------------------------------------------
    // Función para mostrar los ganadores o el bote.
	function mostrarGanadores($jugadores, $apuesta) {
        $noGanadores = true;
		echo "<hr>";
        foreach ($jugadores as $jugador => $datos) {
            if ($datos["ganador"]) {
                echo "<p>Ganador: $jugador</p>";
                $premio = $datos["premio"];
                echo "<p>Premio: $jugador => $premio</p>";
                $noGanadores = false;
            }
        }
        if ($noGanadores) {
            echo "<p>No hay ganadores</p>";
            echo "<p>Bote: $apuesta</p>";
        }
        echo "<hr>";
	}
//--------------------------------------------------------------------------
    // Función para guardar las apuestas en el archivo apuestas.txt.
    function guardarApuestas($jugadores) {
        $fichero = fopen("apuestas.txt", "w+");

        if (!$fichero) {
            trigger_error("No se ha podido abrir el archivo apuestas.txt");
        }else {
            foreach ($jugadores as $jugador => $datos) {
                fwrite($fichero, $jugador . "***" . $datos["suma"] . "***" . $datos["premio"] . "\n");
            }
            fclose($fichero);
        }
    }    
//--------------------------------------------------------------------------