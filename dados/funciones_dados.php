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
        foreach ($jugadores as $jugador => $dados) {
            foreach ($dados as $dado => $tiradaDado) {
                $aletorio = intval(rand(0,5));
                $tiradaDado["resultado"] = $tiradaDado["numeros"][$aletorio];
            }
        }

        return $jugadores;
    }