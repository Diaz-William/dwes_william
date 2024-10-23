<?php
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function rellenarJugadores($nombres, $cantDados) {
        $jugadores = array();

        for ($i = 0; $i < count($nombres); $i++) { 
            if ($nombres[$i] != "") {
                $jugadores[$nombres[$i]] = array();
                for ($j = 1; $j <= $cantDados; $j++) {
                    $jugadores[$nombres[$i]]["Dado" . $j] = array("numeros" => array(1,2,3,4,5,6), "resultado" => 0);
                }
            }
        }

        return $jugadores;
    }

    function tirarDados($jugadores) {
        foreach ($jugadores as $jugador => &$dados) {
            foreach ($dados as $dado => &$tiradaDado) {
                $aletorio = intval(rand(0,5));
                $tiradaDado["resultado"] = $tiradaDado["numeros"][$aletorio];
            }
        }

        return $jugadores;
    }

    function mostrarResultados($jugadores) {
        $suma = 0;

        foreach ($jugadores as $jugador => &$dados) {
            echo "<h1>$jugador</h1>";
            foreach ($dados as $dado => &$tiradaDado) {
                $suma += $tiradaDado["resultado"];
            }
            echo "<p>$suma</p>";
        }
    }

    function comprobarGanadores($jugadores) {
        $resultados = array();
        $suma = 0;
        $posiciones = array();
        $max = 0;
        $nombre = array();
        $cont = 0;

        foreach ($jugadores as $jugador => $dados) {
            foreach ($dados as $dado => $tiradaDado) {
                $suma += $tiradaDado["resultado"];
            }
            array_push($resultados, $suma);
            $suma = 0;
        }


        $max = max($resultados);


        foreach ($resultados as $i => $x) {
            if ($x == $max) {
                array_push($posiciones, $i);
            }
        }


        foreach ($jugadores as $jugador => $valor) {
            foreach ($posiciones as $p) {
                if ($p == $cont) {
                    $nombre = $jugador;
                    echo "<p>Ganador: $jugador</p>";
                }
            }
            $cont += 1;
        }
    }