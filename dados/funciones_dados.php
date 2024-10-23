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
            $jugadores[$nombres[$i]] = array();
            for ($j = 1; $j <= $cantDados; $j++) {
                $jugadores[$nombres[$i]]["Dado" . $j] = array("numeros" => array(1,2,3,4,5,6), "resultado" => 0);
            }
        }

        return $jugadores;
    }

    function tirarDados($jugadores) {
        foreach ($jugadores as $jugador => $dados) {
            foreach ($dados as $dado => $tiradaDado) {
                $aleatorio = range(0, 5);
                foreach ($tiradaDado["numeros"] as $x) {
                    var_dump($jugador);
                    var_dump($x[$aleatorio]);
                }

                //$tiradaDado["numeros"] = array_slice($bolasCarton, 0, 15);
            }
        }
    }