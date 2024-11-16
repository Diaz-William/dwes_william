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
    // Función para empezar la transacción.
    function empezarTransaccion(&$conn) {
        $conn->beginTransaction();
    }
//--------------------------------------------------------------------------
    // Función para realizar un commit o validar los cambios de la base de datos.
    function validar(&$conn) {
        $conn->commit();
    }
//--------------------------------------------------------------------------
    // Función para realizar un rollback o revirtir los cambios realizados en la base de datos.
    function deshacer(&$conn) {
        $conn->rollBack();
    }
//--------------------------------------------------------------------------
    // Función para visualizar un botón de envío y cerrar el formulario.
    function cerrarFormulario() {
        echo "<br><br>";
        echo "<input type='submit' value='Enviar'>";
        echo "</form>";
    }
//--------------------------------------------------------------------------
    // Función para insertar una nueva categoría.
    function insertarCategoria(&$conn, $nombre) {
        try {
            empezarTransaccion($conn);
            $id_categoria = obtenerPKCategoria($conn);
            $insert = $conn->prepare("INSERT INTO categoria (id_categoria,nombre) VALUES (:id_categoria, :nombre)");
            $insert->bindParam(':id_categoria', $id_categoria);
            $insert->bindParam(':nombre', $nombre);
            $insert->execute();
            validar($conn);
            echo "<p>Se ha insertado correctamente la nueva categoría $nombre.</p>";
        } catch (PDOException $e) {
            deshacer($conn);
            error_function_bbdd($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para obtener la siguiente clave primaria para una nueva categoría.
    function obtenerPKCategoria($conn) {
        try {
            $select = $conn->prepare("SELECT IFNULL(MAX(id_categoria),0) AS 'max' FROM categoria");
            $select->execute();
            $resultado = $select->fetchColumn();

            if ($resultado === 0) {
                $resultado = "C001";
            }else {
                $resultado = substr($resultado, 0, 1) . str_pad((intval(substr($resultado, 1)) + 1), 3, '0', STR_PAD_LEFT);
            }
        } catch (PDOException $e) {
            error_function_bbdd($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
        return $resultado;
    }
//--------------------------------------------------------------------------
    // Función para comprobar que existe una categoría mediante el nombre.
    function comprobarExistenciaCategoria($conn, $nombre) {
        try {
            $repetido = false;
            $cont = 0;
            $select = $conn->prepare("SELECT nombre FROM categoria");
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $select->fetchAll();

            while (!$repetido && $cont < count($resultado)) {
                if (strcasecmp($resultado[$cont]["nombre"], $nombre) == 0) {
                    $repetido = true;
                }
                $cont += 1;
            }
        } catch (PDOException $e) {
            error_function_bbdd($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }

        return $repetido;
    }
//--------------------------------------------------------------------------
    // Función para insertar un producto.
    function insertarProducto(&$conn, $nombre, $precio, $id_categoria) {
        try {
            empezarTransaccion($conn);
            $id_producto = obtenerPKProducto($conn);
            $insert = $conn->prepare("INSERT INTO producto (id_producto,nombre,precio,id_categoria) VALUES (:id_producto, :nombre, :precio, :id_categoria)");
            $insert->bindParam(':id_producto', $id_producto);
            $insert->bindParam(':nombre', $nombre);
            $insert->bindParam(':precio', $precio);
            $insert->bindParam(':id_categoria', $id_categoria);
            $insert->execute();
            validar($conn);
            echo "<p>Se ha insertado correctamente el nuevo producto $nombre.</p>";
        } catch (PDOException $e) {
            deshacer($conn);
            error_function_bbdd($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para obtener la siguiente clave primaria para un producto.
    function obtenerPKProducto($conn) {
        try {
            $select = $conn->prepare("SELECT IFNULL(MAX(id_producto),0) AS 'max' FROM producto");
            $select->execute();
            $resultado = $select->fetchColumn();
            if ($resultado === 0) {
                $resultado = "P0001";
            }else {
                $resultado = substr($resultado, 0, 1) . str_pad((intval(substr($resultado, 1)) + 1), 4, '0', STR_PAD_LEFT);
            }
        } catch (PDOException $e) {
            error_function_bbdd($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
        return $resultado;
    }
//--------------------------------------------------------------------------
    // Función para visualizar las categorías en un desplegable.
    function imprimirSeleccionCategoria($conn) {
        try {
            echo "<label for='categoria'>Categoría: </label>";
            echo "<select name='categoria' id='categoria'>";
            echo "<option value=''>--Seleccionar Categoría--</option>";
            $select = $conn->prepare("SELECT id_categoria, nombre FROM categoria");
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $select->fetchAll();
            foreach($resultado as $row) {
                echo "<option value='{$row['id_categoria']}'>{$row['id_categoria']} - {$row['nombre']}</option>";
            }
            echo "</select>";
        } catch (PDOException $e) {
            error_function_bbdd($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para insertar un nuevo almacén.
    function insertarAlmacen(&$conn, $localidad) {
        try {
            empezarTransaccion($conn);
            $insert = $conn->prepare("INSERT INTO almacen (localidad) VALUES (:localidad)");
            $insert->bindParam(':localidad', $localidad);
            $insert->execute();
            validar($conn);
            echo "<p>Se ha insertado correctamente un nuevo almacen en la localidad de $localidad.</p>";
        } catch (PDOException $e) {
            deshacer($conn);
            error_function_bbdd($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para aprovisionar almacenes con productos.
    function aprovisionarAlmacena(&$conn, $num_almacen, $id_producto, $cantidad) {
        try {
            empezarTransaccion($conn);
            $select = $conn->prepare("SELECT cantidad FROM almacena WHERE num_almacen = :num_almacen AND id_producto = :id_producto");
            $select->bindParam(':num_almacen', $num_almacen);
            $select->bindParam(':id_producto', $id_producto);
            $select->execute();
            $resultado = $select->fetchColumn();
            
            if ($resultado !== false) {
                $cantidad += intval($resultado);
                $update = $conn->prepare("UPDATE almacena SET cantidad = :cantidad WHERE num_almacen = :num_almacen AND id_producto = :id_producto");
                $update->bindParam(':cantidad', $cantidad);
                $update->bindParam(':num_almacen', $num_almacen);
                $update->bindParam(':id_producto', $id_producto);
                $update->execute();
                echo "<p>Se ha aprovisionado correctamente el almacén $num_almacen con $resultado productos más con el id $id_producto.</p>";
            }else {
                $insert = $conn->prepare("INSERT INTO almacena (num_almacen, id_producto, cantidad) VALUES (:num_almacen, :id_producto, :cantidad)");
                $insert->bindParam(':num_almacen', $num_almacen);
                $insert->bindParam(':id_producto', $id_producto);
                $insert->bindParam(':cantidad', $cantidad);
                $insert->execute();
                echo "<p>Se ha aprovisionado correctamente el almacén $num_almacen con $cantidad productos con el id $id_producto.</p>";
            }
            validar($conn);
        } catch (PDOException $e) {
            deshacer($conn);
            error_function_bbdd($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }    
//--------------------------------------------------------------------------
    // Función para visualizar los productos en un desplegable.
    function imprimirSeleccionProductos($conn) {
        try {
            echo "<label for='producto'>Producto: </label>";
            echo "<select name='producto' id='producto'>";
            echo "<option value=''>--Seleccionar Producto--</option>";
            $select = $conn->prepare("SELECT id_producto, nombre FROM producto");
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $select->fetchAll();
            foreach($resultado as $row) {
                echo "<option value='{$row['id_producto']}'>{$row['id_producto']} - {$row['nombre']}</option>";
            }
            echo "</select>";
        } catch (PDOException $e) {
            error_function_bbdd($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para visualizar los almacenes en un desplegable.
    function imprimirSeleccionAlmacenes($conn) {
        try {
            echo "<label for='almacen'>Almacen: </label>";
            echo "<select name='almacen' id='almacen'>";
            echo "<option value=''>--Seleccionar Almacen--</option>";
            $select = $conn->prepare("SELECT num_almacen, localidad FROM almacen");
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $select->fetchAll();
            foreach($resultado as $row) {
                echo "<option value='{$row['num_almacen']}'>{$row['num_almacen']} - {$row['localidad']}</option>";
            }
            echo "</select>";
        } catch (PDOException $e) {
            error_function_bbdd($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para visualizar la cantidad de un producto en todos los almacenes.
    function visualizarStockProducto($conn, $id_producto) {
        try {
            $select = $conn->prepare("SELECT p.id_producto, p.nombre, a.num_almacen, a.localidad, IFNULL(al.cantidad, 0) AS cantidad FROM almacen a LEFT JOIN almacena al ON a.num_almacen = al.num_almacen AND al.id_producto = :id_producto LEFT JOIN producto p ON p.id_producto = :id_producto ORDER BY a.num_almacen;");
            $select->bindParam(':id_producto', $id_producto);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $select->fetchAll();
            echo "<h2>Cantidad del producto {$resultado[0]['id_producto']} - {$resultado[0]['nombre']}</h2>";
            echo "<ul>";
            foreach ($resultado as $row) {
                echo "<li>Almacen {$row['num_almacen']} - {$row['localidad']} tiene {$row['cantidad']}</li>";
            }
            echo "</ul>";
        } catch (PDOException $e) {
            error_function_bbdd($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para visualizar la cantidad de productos en un almacen.
    function visualizarStockAlmacen($conn, $num_almacen) {
        try {
            $select = $conn->prepare("SELECT p.id_producto, p.nombre, a.num_almacen, a.localidad, al.cantidad FROM producto p, almacen a, almacena al WHERE p.id_producto = al.id_producto AND a.num_almacen = al.num_almacen AND a.num_almacen = :num_almacen");
            $select->bindParam(':num_almacen', $num_almacen);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $select->fetchAll();
            echo "<h2>Cantidad de productos del almacen {$resultado[0]['num_almacen']} - {$resultado[0]['localidad']}</h2>";
            echo "<ul>";
            foreach ($resultado as $row) {
                echo "<li>{$row['id_producto']} - {$row['nombre']} hay {$row['cantidad']} unidades</li>";
            }
            echo "</ul>";
        } catch (PDOException $e) {
            error_function_bbdd($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Funcción para visualizar las compras de un cliente entre dos fechas.
    function visualizarComprasCliente($conn, $nif, $fecha_in, $fecha_fin) {
        try {
            $select = $conn->prepare("SELECT cli.nif, cli.nombre, cli.apellido, p.id_producto, p.nombre, (c.unidades * p.precio) AS 'precio compra' FROM cliente cli, producto p, compra c WHERE cli.nif = c.nif AND p.id_producto = c.id_producto AND cli.nif = :nif AND fecha_compra BETWEEN :fecha_in AND :fecha_fin ORDER BY fecha_compra");
            $select->bindParam(':nif', $nif);
            $select->bindParam(':fecha_in', $fecha_in);
            $select->bindParam(':fecha_fin', $fecha_fin);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $select->fetchAll();
            foreach ($resultado as $row) {
                # code...
            }
        } catch (PDOException $e) {
            error_function_bbdd($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para visualizar los nif de los clientes.
    function imprimirSeleccionNif($conn) {
        try {
            echo "<label for='nif'>NIF: </label>";
            echo "<select name='nif' id='nif'>";
            echo "<option value=''>--Seleccionar NIF--</option>";
            $select = $conn->prepare("SELECT nif,nombre,apellido FROM cliente");
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $select->fetchAll();
            foreach($resultado as $row) {
                echo "<option value='{$row['nif']}'>{$row['nif']} - {$row['nombre']} - {$row['apellido']}</option>";
            }
            echo "</select>";
        } catch (PDOException $e) {
            error_function_bbdd($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------