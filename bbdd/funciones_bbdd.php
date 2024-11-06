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
    function cerrarConexion(&$conn) {
        $conn = null;
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
        $cont = 0;
        $select = $conn->prepare("SELECT nombre FROM dpto");
        $select->execute();
        $select->setFetchMode(PDO::FETCH_ASSOC);
        $resultado = $select->fetchAll();

        while (!$repetido && $cont < count($resultado)) {
            if (strcmp(strtoupper($resultado[$cont]["nombre"]), strtoupper($nombre)) === 0) {
                $repetido = true;
            }
            $cont += 1;
        }

        return $repetido;
    }
//--------------------------------------------------------------------------
    function imprimirSeleccionDepartamento($conn) {
        echo "<select>";
        $select = $conn->prepare("SELECT cod_dpto, nombre FROM dpto");
        $select->execute();

        // set the resulting array to associative
        $select->setFetchMode(PDO::FETCH_ASSOC);
        $resultado = $select->fetchAll();
        foreach($resultado as $row) {
            echo "<option value='{$row["cod_dpto"]}'>{$row["cod_dpto"]} - {$row["nombre"]}</option>";
        }
        echo "</select>";
        echo "<br><br>";
        echo "<input type='submit' value='Insetar'>";
        echo "</form>";
    }
//--------------------------------------------------------------------------
    function comprobarDniRepetido($conn, $dni) {
        $repetido = false;
        $cont = 0;
        $select = $conn->prepare("SELECT dni FROM emple");
        $select->execute();
        $select->setFetchMode(PDO::FETCH_ASSOC);
        $resultado = $select->fetchAll();

        while (!$repetido && $cont < count($resultado)) {
            if (strcmp(strtoupper($resultado[$cont]["dni"]), strtoupper($dni)) === 0) {
                $repetido = true;
            }
            $cont += 1;
        }

        return $repetido;
    }
//--------------------------------------------------------------------------
    function insertarEmpleado($conn, $dni, $nombre, $apellidos, $salario, $fecha, $dpto) {
        // prepare sql and bind parameters
        $insert = $conn->prepare("INSERT INTO emple (dni,nombre,apellidos,salario,fecha_nac) VALUES (:dni,:nombre,:apellidos,:salario,:fecha)");
        $insert->bindParam(':dni', $dni);
        $insert->bindParam(':nombre', $nombre);
        $insert->bindParam(':apellidos', $apellidos);
        $insert->bindParam(':salario', $salario);
        $insert->bindParam(':fecha', $fecha);
    
        // insert a row
        $insert->execute();
    }
//--------------------------------------------------------------------------
    function insertarEmple_Dpto($conn, $dni, $dpto) {
        $insert = $conn->prepare("INSERT INTO emple_dpto (dni,cod_dpto,fecha_in) VALUES (:dni,:dpto,:fecha_in)");
        $insert->bindParam(':dni', $dni);
        $insert->bindParam(':dpto', $dpto);
        $insert->bindParam(':fehca_in', date("Y-m-d"));
        $insert->execute();
    }
//--------------------------------------------------------------------------