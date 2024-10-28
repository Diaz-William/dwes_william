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
    // Función para tirar los dados de cada jugador.
	function tirarDados($jugadores, $cantDados) {
        foreach ($jugadores as $jugador => &$datos) {
            for ($i = 0; $i < $cantDados; $i++) {
                array_push($datos["resultados"], rand(1,6));
            }
            if (($cantDados > 2) && (comprobarDadosIguales($datos["resultados"]))) {
                $datos["suma"] = 100;
            }else {
                $datos["suma"] = array_sum($datos["resultados"]);
            }
        }

        return $jugadores;
    }
//--------------------------------------------------------------------------
	// Función para comprobar si todos los dados de un jugador son iguales.
	function comprobarDadosIguales($dados) {
		return count(array_unique($dados)) == 1;
	}
//--------------------------------------------------------------------------
	// Función para obtener todos los ganadores.
	function obtenerGanadores($jugadores) {
		$ganadores = array();
		$mayor = 0;
		
		foreach ($jugadores as $jugador => $datos) {
            if ($datos["suma"] > $mayor) {
                $mayor = $datos["suma"];
            }
        }
		
		foreach ($jugadores as $jugador => $datos) {
            if ($datos["suma"] == $mayor) {
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
            foreach ($datos["resultados"] as $num) {
                echo "<td><img src='images/$num.png' style='width: 50px; height: 50px; margin: 5px;'></td>";
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