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
    // Función para realizar la conexión con la base de datos.
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
    // Función para cerrar la conexión con la base de datos.
    function cerrarConexion(&$conn) {
        $conn = null;
    }
//--------------------------------------------------------------------------
    function empezarTransaccion(&$conn) {
        $conn->beginTransaction();
    }
//--------------------------------------------------------------------------
    function validar(&$conn) {
        $conn->commit();
    }
//--------------------------------------------------------------------------
    function deshacer(&$conn) {
        $conn->rollBack();
    }
//--------------------------------------------------------------------------
    // Función para insertar un nuevo departamento.
    function insertarDepartamneto(&$conn, $nombre) {
        try {
            empezarTransaccion($conn);
            $cod_dpto = obtenerPKDpto($conn);
            $insert = $conn->prepare("INSERT INTO dpto (cod_dpto,nombre) VALUES ('$cod_dpto','$nombre')");
            $insert->execute();
            validar($conn);
            echo "<p>Se ha insertado correctamente el nuevo departamento $nombre</p>";
        } catch (PDOException $e) {
            deshacer($conn);
            echo "Error: " . $e->getMessage();
        }
    }
//--------------------------------------------------------------------------
    // Función para obtener la siguiente clave primaria para un nuevo departamento.
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
    // Función para comprobar que existe un departamento mediante el nombre.
    function comprobarExistenciaDepartamento($conn, $nombre) {
        try {
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
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return $repetido;
    }
//--------------------------------------------------------------------------
    // Función para visualizar los departamentos en un desplegable.
    function imprimirSeleccionDepartamento($conn) {
        try {
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
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
//--------------------------------------------------------------------------
    // Función para comprobar que existe un dni.
    function comprobarDniRepetido($conn, $dni) {
        try {
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
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return $repetido;
    }
//--------------------------------------------------------------------------
    // Función para insertar un nuevo empleado.
    function insertarEmpleado(&$conn, $dni, $nombre, $apellidos, $salario, $fecha, $dpto) {
        try {
            empezarTransaccion($conn);
            $insert = $conn->prepare("INSERT INTO emple (dni,nombre,apellidos,salario,fecha_nac) VALUES (:dni,:nombre,:apellidos,:salario,:fecha)");
            $insert->bindParam(':dni', $dni);
            $insert->bindParam(':nombre', $nombre);
            $insert->bindParam(':apellidos', $apellidos);
            $insert->bindParam(':salario', $salario);
            $insert->bindParam(':fecha', $fecha);
            $insert->execute();
            validar($conn);
            insertarEmple_Dpto($conn, $dni, $dpto);
        } catch (PDOException $e) {
            deshacer($conn);
            echo "Error: " . $e->getMessage();
        }
    }
//--------------------------------------------------------------------------
    // Función para asignar un departamento a un empleado.
    function insertarEmple_Dpto(&$conn, $dni, $dpto) {
        try {
            empezarTransaccion($conn);
            $insert = $conn->prepare("INSERT INTO emple_dpto (dni, cod_dpto, fecha_in) VALUES (:dni, :dpto, :fecha_in)");
            $insert->bindParam(':dni', $dni);
            $insert->bindParam(':dpto', $dpto);
            $fecha_in = date("Y-m-d");
            $insert->bindParam(':fecha_in', $fecha_in);
            $insert->execute();
            validar($conn);
        } catch (PDOException $e) {
            deshacer($conn);
            echo "Error: " . $e->getMessage();
        }
    }
//--------------------------------------------------------------------------
    // Función para visualizar los dni en un desplegable.
    function imprimirSeleccionDni($conn) {
        try {
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
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }        
    }
//--------------------------------------------------------------------------
    // Función para visualizar un botón de envío y cerrar el formulario.
    function cerrarFormulario() {
        echo "<br><br>";
        echo "<input type='submit' value='Enviar'>";
        echo "</form>";
    }
//--------------------------------------------------------------------------
    // Función para cambiar de departamento a un empleado.
    function actualizarEmple_Dpto(&$conn, $dni, $dpto) {
        try {
            empezarTransaccion($conn);
            $update = $conn->prepare("UPDATE emple_dpto SET fecha_fin = :fecha_fin WHERE dni = :dni AND fecha_fin IS NULL");
            $fecha_fin = date("Y-m-d");
            $update->bindParam(':fecha_fin', $fecha_fin);
            $update->bindParam(':dni', $dni);
            $update->execute();
            validar($conn);
            insertarEmple_Dpto($conn, $dni, $dpto);
        } catch (PDOException $e) {
            deshacer($conn);
            echo "Error: " . $e->getMessage();
        }
    }
//--------------------------------------------------------------------------
    // Función para evitar que un empleado se cambie de departamento más de una vez al día.
    function comprobarCambioDpto($conn, $dni) {
        try {
            $select = $conn->prepare("SELECT dni, fecha_in FROM emple_dpto WHERE dni = :dni AND fecha_in = :fecha_in AND fecha_fin IS NULL");
            $select->bindParam(':dni', $dni);
            $fecha_in = date("Y-m-d");
            $select->bindParam(':fecha_in', $fecha_in);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $select->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return count($resultado) > 0;
    }
//--------------------------------------------------------------------------
    // Función visualizar una lista de empleados por departamento.
    function listarEmpleadosDepartamento($conn, $dpto) {
        try {
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
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
//--------------------------------------------------------------------------
    // Función para listar los empleados antiguos por departamento.
    function listarEmpleadosAntiguosDepartamento($conn, $dpto) {
        try {
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
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
//--------------------------------------------------------------------------
    // Función para actualizar el salario de un empleado.
    function actualizarSalarioEmpleado(&$conn, $dni, $porcentaje) {
        try {
            $salarioAntiguo = obtenerSalarioEmpleado($conn, $dni);
            if ($salarioAntiguo == 0) {
                echo "<p>No se puede actualizar el salario del empleado con el dni $dni porque es 0.</p>";
            }else {
                empezarTransaccion($conn);
                $update = $conn->prepare("UPDATE emple SET salario = :salario WHERE dni = :dni");
                $salarioNuevo = max(0, round(($salarioAntiguo + ($salarioAntiguo * $porcentaje)), 2, PHP_ROUND_HALF_DOWN));
                $update->bindParam(':dni', $dni);
                $update->bindParam(':salario', $salarioNuevo);
                $update->execute();
                validar($conn);
                echo "<p>Se ha actualizado el salario del empleado con el dni $dni de $salarioAntiguo a $salarioNuevo</p>";
            }
        } catch (PDOException $e) {
            deshacer($conn);
            echo "Error: " . $e->getMessage();
        }
    }
//--------------------------------------------------------------------------
    // Función para obtener el salario actual de un empleado.
    function obtenerSalarioEmpleado($conn, $dni) {
        try {
            $select = $conn->prepare("SELECT IFNULL(salario, 0) AS 'salario' FROM emple WHERE dni = :dni");
            $select->bindParam(':dni', $dni);
            $select->execute();
            $resultado = $select->fetchColumn();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return floatval($resultado);
    }
//--------------------------------------------------------------------------
    // Función para mostrar los empleados y sus departamento por fecha.
    function empleadosFecha($conn, $fecha) {
        try {
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
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
//--------------------------------------------------------------------------