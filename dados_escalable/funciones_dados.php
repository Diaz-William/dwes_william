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
    // Función para guardar los nombres en el archivo.
    function guardarNombresFichero($nomFichero, $nombre, $apellido) {
        $fichero = fopen($nomFichero, "a+");

        if (!$fichero) {
            trigger_error("No se ha podido abrir el archivo $nomFichero");
        }else {
            if (filesize($nomFichero) == 0) {
                fwrite($fichero, "Nombre,Apellido\n");
            }
        
            fwrite($fichero, $nombre . "," . $apellido . "\n");
            fclose($fichero);
        }
    }    
//--------------------------------------------------------------------------
    // Función para obtener los datos de los jugadores de un archivo de texto plano.
    function obtenerDatos($nombre) {
        $fichero = fopen($nombre, "r");

        if (!$fichero) {
            trigger_error("No se ha podido abrir el archivo $nombre");
        }else {
            $datos = file($nombre, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            fclose($fichero);
        }
        
        return $datos;
    }
//--------------------------------------------------------------------------
    // Función para obtener el nombre completo por línea.
    function obtenerNombreLinea($linea) {
        $linea = explode(",", $linea);
        return $linea[0] . " " . $linea[1];
    }
//--------------------------------------------------------------------------
    // Función para rellenar los jugadores con sus nombres y sus datos.
	function rellenarJugadores($nombres) {
        $jugadores = array();

        foreach ($nombres as $indice => $linea) {
            if ($indice > 0) {
                $nombre = obtenerNombreLinea($linea);
                $jugadores[$nombre] = array("resultados" => array(), "suma" => 0);
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