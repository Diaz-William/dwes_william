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
            $resultado = $select->fetchColumn();
            $siguiente = $resultado + 1;
            $pk = "D";
            $cantidad = strlen($siguiente);
            $pk = str_pad($pk, (4 - $cantidad), "0" , STR_PAD_RIGHT) . $siguiente;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
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
        echo "<label for='dpto'>Departamento: </label>";
        echo "<select name='dpto' id='dpto'>";
        echo "<option value=''>--Seleccionar Departamento--</option>";
        $select = $conn->prepare("SELECT cod_dpto, nombre FROM dpto");
        $select->execute();

        $select->setFetchMode(PDO::FETCH_ASSOC);
        $resultado = $select->fetchAll();
        foreach($resultado as $row) {
            echo "<option value='{$row['cod_dpto']}'>{$row['cod_dpto']} - {$row['nombre']}</option>";
        }
        echo "</select>";
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
        $insert = $conn->prepare("INSERT INTO emple (dni,nombre,apellidos,salario,fecha_nac) VALUES (:dni,:nombre,:apellidos,:salario,:fecha)");
        $insert->bindParam(':dni', $dni);
        $insert->bindParam(':nombre', $nombre);
        $insert->bindParam(':apellidos', $apellidos);
        $insert->bindParam(':salario', $salario);
        $insert->bindParam(':fecha', $fecha);
        $insert->execute();
        insertarEmple_Dpto($conn, $dni, $dpto);
    }
//--------------------------------------------------------------------------
    function insertarEmple_Dpto($conn, $dni, $dpto) {
        $insert = $conn->prepare("INSERT INTO emple_dpto (dni, cod_dpto, fecha_in) VALUES (:dni, :dpto, :fecha_in)");
        $insert->bindParam(':dni', $dni);
        $insert->bindParam(':dpto', $dpto);
        $fecha_in = date("Y-m-d");
        $insert->bindParam(':fecha_in', $fecha_in);
        $insert->execute();
    }
//--------------------------------------------------------------------------
    function imprimirSeleccionDni($conn) {
        echo "<label for='dni'>DNI: </label>";
        echo "<select name='dni' id='dni'>";
        echo "<option value=''>--Seleccionar DNI--</option>";
        $select = $conn->prepare("SELECT dni, nombre FROM emple");
        $select->execute();

        $select->setFetchMode(PDO::FETCH_ASSOC);
        $resultado = $select->fetchAll();
        foreach($resultado as $row) {
            echo "<option value='{$row['dni']}'>{$row['dni']} - {$row['nombre']}</option>";
        }
        echo "</select>";        
    }
//--------------------------------------------------------------------------
    function cerrarFormulario() {
        echo "<br><br>";
        echo "<input type='submit' value='Enviar'>";
        echo "</form>";
    }
//--------------------------------------------------------------------------
    function actualizarEmple_Dpto($conn, $dni, $dpto) {
        $update = $conn->prepare("UPDATE emple_dpto SET fecha_fin = :fecha_fin WHERE dni = :dni AND fecha_fin IS NULL");
        $fecha_fin = date("Y-m-d");
        $update->bindParam(':fecha_fin', $fecha_fin);
        $update->bindParam(':dni', $dni);
        $update->execute();
        insertarEmple_Dpto($conn, $dni, $dpto);
    }
//--------------------------------------------------------------------------
    function comprobarCambioDpto($conn, $dni) {
        $select = $conn->prepare("SELECT dni, fecha_in FROM emple_dpto WHERE dni = :dni AND fecha_in = :fecha_in AND fecha_fin IS NULL");
        $select->bindParam(':dni', $dni);
        $fecha_in = date("Y-m-d");
        $select->bindParam(':fecha_in', $fecha_in);
        $select->execute();
        $select->setFetchMode(PDO::FETCH_ASSOC);
        $resultado = $select->fetchAll();
        return count($resultado) > 0;
    }
//--------------------------------------------------------------------------
    function listarEmpleadosDepartamento($conn, $dpto) {
        $select = $conn->prepare("SELECT e.dni, e.nombre, d.nombre AS 'dpto' FROM emple e, dpto d, emple_dpto ed WHERE e.dni = ed.dni AND d.cod_dpto = ed.cod_dpto AND ed.cod_dpto = :dpto AND fecha_fin IS NULL");
        $select->bindParam(':dpto', $dpto);
        $select->execute();
        $select->setFetchMode(PDO::FETCH_ASSOC);
        $resultado = $select->fetchAll();
        if (count($resultado) > 0) {
            echo "<h2>Empleados del departamento $dpto - {$resultado[0]['dpto']}</h2>";
            echo "<ul>";
            foreach ($resultado as $row) {
                echo "<li>{$row['dni']} - {$row['nombre']}</li>";
            }
            echo "</ul>";
        } else {
            $select = $conn->prepare("SELECT nombre FROM dpto WHERE cod_dpto = :dpto");
            $select->bindParam(':dpto', $dpto);
            $select->execute();
            $resultado = $select->fetchColumn();
            echo "<p>No hay empleados en el departamento $dpto - $resultado actualmente.</p>";
        }
    }
//--------------------------------------------------------------------------
    function listarEmpleadosAntiguosDepartamento($conn, $dpto) {
        $select = $conn->prepare("SELECT e.dni, e.nombre, d.nombre AS 'dpto' FROM emple e, dpto d, emple_dpto ed WHERE e.dni = ed.dni AND d.cod_dpto = ed.cod_dpto AND ed.cod_dpto = :dpto AND fecha_fin IS NOT NULL");
        $select->bindParam(':dpto', $dpto);
        $select->execute();
        $select->setFetchMode(PDO::FETCH_ASSOC);
        $resultado = $select->fetchAll();
        if (count($resultado) > 0) {
            echo "<h2>Empleados Antiguos del departamento $dpto - {$resultado[0]['dpto']}</h2>";
            echo "<ul>";
            foreach ($resultado as $row) {
                echo "<li>{$row['dni']} - {$row['nombre']}</li>";
            }
            echo "</ul>";
        } else {
            $select = $conn->prepare("SELECT nombre FROM dpto WHERE cod_dpto = :dpto");
            $select->bindParam(':dpto', $dpto);
            $select->execute();
            $resultado = $select->fetchColumn();
            echo "<p>No ha habido bajas de empleados en el departamento $dpto - $resultado.</p>";
        }
    }
//--------------------------------------------------------------------------
    function actualizarSalarioEmpleado($conn, $dni, $porcentaje) {
        $salarioAntiguo = obtenerSalarioEmpleado($conn, $dni);
        if ($salarioAntiguo == 0) {
            echo "<p>No se puede actualizar el salario del empleado con el dni $dni porque es 0.</p>";
        }else {
            $update = $conn->prepare("UPDATE emple SET salario = :salario WHERE dni = :dni");
            $salarioNuevo = max(0, ($salarioAntiguo + ($salarioAntiguo * $porcentaje)));
            $update->bindParam(':dni', $dni);
            $update->bindParam(':salario', $salarioNuevo);
            $update->execute();
            echo "<p>Se ha actualizado el salario del empleado con el dni $dni de $salarioAntiguo a $salarioNuevo</p>";
        }
    }
//--------------------------------------------------------------------------
    function obtenerSalarioEmpleado($conn, $dni) {
        $select = $conn->prepare("SELECT IFNULL(salario, 0) AS 'salario' FROM emple WHERE dni = :dni");
        $select->bindParam(':dni', $dni);
        $select->execute();
        $resultado = $select->fetchColumn();
        return floatval($resultado);
    }
//--------------------------------------------------------------------------
    function empleadosFecha($conn, $fecha) {
        $select = $conn->prepare("SELECT e.dni, e.nombre, d.cod_dpto, d.nombre AS 'dpto' FROM emple e, dpto d, emple_dpto ed WHERE e.dni = ed.dni AND d.cod_dpto = ed.cod_dpto AND :fecha BETWEEN ed.fecha_in AND IFNULL(ed.fecha_fin, :fecha)");
        $select->bindParam(':fecha', $fecha);
        $select->execute();
        $select->setFetchMode(PDO::FETCH_ASSOC);
        $resultado = $select->fetchAll();
        echo "<h2>Empleados del $fecha</h2>";
        echo "<ul>";
        foreach ($resultado as $row) {
            echo "<li>{$row['dni']} - {$row['nombre']} - {$row['cod_dpto']} - {$row['dpto']}</li>";
        }
        echo "</ul>";
    }
//--------------------------------------------------------------------------