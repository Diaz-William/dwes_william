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
                $jugadores[$nombres[$i]] = array();
                $jugadores[$nombres[$i]]["Datos"] = array("resultados" => array(), "suma" => 0);
            }
        }

        return $jugadores;
    }
//--------------------------------------------------------------------------
    // Función para tirar los dados de cada jugador.
	function tirarDados($jugadores, $cantDados) {
        foreach ($jugadores as $jugador => &$datos) {
            foreach ($datos as $dados => &$dado) {
				for ($i = 0; $i < $cantDados; $i++) {
					array_push($dado["resultados"], rand(1,6));
				}
				if (($cantDados > 2) && (comprobarDadosIguales($dado["resultados"]))) {
					$dado["suma"] = 100;
				}else {
					$dado["suma"] = array_sum($dado["resultados"]);
				}
            }
        }

        return $jugadores;
    }
//--------------------------------------------------------------------------
	// Función para comprobar si todos los dados de un jugador son iguales.
	function comprobarDadosIguales($dados) {
		$devolver = false;
		
		if (count(array_unique($dados)) == 1) {
			$devolver = true;
		}
		
		return $devolver;
	}
//--------------------------------------------------------------------------
	// Función para obtener todos los ganadores.
	function obtenerGanadores($jugadores) {
		$ganadores = array();
		$mayor = 0;
		
		foreach ($jugadores as $jugador => $datos) {
            foreach ($datos as $dados => $dado) {
				if ($dado["suma"] > $mayor) {
					$mayor = $dado["suma"];
				}
            }
        }
		
		foreach ($jugadores as $jugador => $datos) {
            foreach ($datos as $dados => $dado) {
				if ($dado["suma"] == $mayor) {
					$ganadores[$jugador] = $jugadores[$jugador];
				}
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
            foreach ($datos as $dados => $dado) {
				foreach ($dado["resultados"] as $num) {
					echo "<td><img src='images/$num.png' style='width: 50px; height: 50px; margin: 5px;'></td>";
				}
            }
			echo "</tr>";
        }
		
		echo "</table>";
		echo "<hr>";
		
		foreach ($jugadores as $jugador => $datos) {
            foreach ($datos as $dados => $dado) {
				echo "<p>$jugador --> " . $dado["suma"] . "</p>";
            }
        }
    }
//--------------------------------------------------------------------------
    // Función para mostrar los ganadores.
	function mostrarGanadores($ganadores) {
		echo "<hr>";
		foreach ($ganadores as $jugador => $datos) {
            foreach ($datos as $dados => $dado) {
				echo "<p>Ganador --> $jugador</p>";
            }
        }
				
		echo "<p>Total de ganadores --> " . count($ganadores) . "</p>";
	}
//--------------------------------------------------------------------------