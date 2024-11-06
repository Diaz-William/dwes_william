<?php
//--------------------------------------------------------------------------
    function realizarConexion($dbname,$servername,$username,$password) {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Conexión fallida: " . $e->getMessage();
        }

        return $conn;
    }
//--------------------------------------------------------------------------
    function insertarDepartamneto($conn, $nombre) {
        try {
            $cod_dpto = obtenerPKDpto($conn);
            $insert = $conn->prepare("INSERT INTO dpto (cod_dpto,nombre) VALUES ('$cod_dpto','$nombre')");
            // insert a row
            $insert->execute();
            echo "<p>Se ha insertado correctamente el nuevo departamento $nombre</p>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
//--------------------------------------------------------------------------
    function obtenerPKDpto($conn) {
        try {
            $select = $conn->prepare("SELECT count(cod_dpto) AS 'total' FROM dpto");
            $select->execute();
            // set the resulting array to associative
            //$select->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $select->fetchColumn();
            $siguiente = $resultado + 1;
            $pk = "D";
            $cantidad = strlen($siguiente);
            $pk = str_pad($pk, (4 - $cantidad), "0" , STR_PAD_RIGHT) . $siguiente;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        var_dump($cantidad);
        var_dump($siguiente);
        var_dump($pk);
        return $pk;
    }
//--------------------------------------------------------------------------
    function comprobarExistenciaDepartamento($conn, $nombre) {
        $repetido = false;
        $select = $conn->prepare("SELECT nombre FROM dpto");
        $select->execute();
        $select->setFetchMode(PDO::FETCH_ASSOC);
        $resultado = $select->fetchAll();
        foreach ($resultado as $dpto) {
            var_dump($dpto);
            var_dump($nombre);
            if (strcmp(strtoupper($dpto["nombre"]), strtoupper($nombre)) !== 0) {
                $repetido = true;
            }
        }
        return $repetido;
    }
//--------------------------------------------------------------------------
    // Función para limpiar la entrada de datos del usuario.
	function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
//--------------------------------------------------------------------------