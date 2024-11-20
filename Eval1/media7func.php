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
                $jugadores[$nombres[$i]] = array("resultados" => array(), "suma" => 0);
            }
        }

        return $jugadores;
    }
//--------------------------------------------------------------------------
    // Función para repartir las cartas de los jugadores y realizar la suma.
	function repartirCartas($jugadores, $numcartas) {
        $cartas = obtenerCartas();
        var_dump($cartas);
        foreach ($jugadores as $jugador => &$datos) {
            for ($i = 0; $i < $numcartas; $i++) {
                $aleatorio = rand(0, (count($cartas) - 1));
                array_push($datos["resultados"], $cartas[$aleatorio]);
            }

            $valor = substr($cartas[$aleatorio],0, 1);

            if ($valor != "S" && $valor != "C" && $valor != "R") {
                $valor = intval($valor);
            }else {
                $valor = 0.5;
            }

            $datos["suma"] += $valor;
        }

        return $jugadores;
    }
//--------------------------------------------------------------------------
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
	// Función para obtener todos los ganadores.
	function obtenerGanadores($jugadores) {
		$ganadores = array();
		
		foreach ($jugadores as $jugador => $datos) {
            if ($datos["suma"] === 7.5) {
                $ganadores[$jugador] = $jugadores[$jugador];
            }
        }
		
		return $ganadores;
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
            echo "<p>$jugador --> " . $datos["suma"] . "</p>";
        }
    }
//--------------------------------------------------------------------------
    // Función para mostrar los ganadores.
	function mostrarGanadores($ganadores) {
		echo "<hr>";
		foreach ($ganadores as $jugador => $datos) {
            echo "<p>Ganador --> $jugador</p>";
        }
				
		echo "<p>Total de ganadores --> " . count($ganadores) . "</p>";
	}
//--------------------------------------------------------------------------