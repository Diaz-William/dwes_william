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

            if (empty($resultado)) {
                $resultado = "C-001";
            }else {
                $resultado = substr($resultado, 0, 2) . str_pad((intval(substr($resultado, 2)) + 1), 3, '0', STR_PAD_LEFT);
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
            if (empty($resultado)) {
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
            $select = $conn->prepare("SELECT cantidad FROM almacena WHERE num_almacen = :num_almacen AND id_producto = :id_producto");
            $select->bindParam(':num_almacen', $num_almacen);
            $select->bindParam(':id_producto', $id_producto);
            $select->execute();
            $resultado = $select->fetchColumn();

            empezarTransaccion($conn);
            if (!empty($resultado)) {
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
    // Función para visualizar las compras de un cliente entre dos fechas.
    function visualizarComprasCliente($conn, $nif, $fecha_in, $fecha_fin) {
        try {
            $select = $conn->prepare("SELECT cli.nif, p.id_producto, p.nombre AS 'producto', c.unidades, (c.unidades * p.precio) AS 'precio compra' FROM cliente cli, producto p, compra c WHERE cli.nif = c.nif AND p.id_producto = c.id_producto AND cli.nif = :nif AND fecha_compra BETWEEN :fecha_in AND :fecha_fin ORDER BY fecha_compra");
            $select->bindParam(':nif', $nif);
            $select->bindParam(':fecha_in', $fecha_in);
            $select->bindParam(':fecha_fin', $fecha_fin);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $select->fetchAll();
            if (empty($resultado)) { 
                echo "<p>No se encontraron compras para el cliente $nif entre las fechas $fecha_in y $fecha_fin.</p>";
            }else {
                echo "<h2>Compras del cliente {$resultado[0]['nif']} entre $fecha_in y $fecha_fin</h2>";
                echo "<ul>";
                $total = 0;
                foreach ($resultado as $row) {
                    echo "<li>{$row['id_producto']} - {$row['producto']}, {$row['unidades']} unidades, precio compra {$row['precio compra']}</li>";
                    $total += $row['precio compra'];
                }
                echo "</ul>";
                echo "<p>El monto total de las " . count($resultado) . " compras es $total</p>";
            }
        } catch (PDOException $e) {
            error_function_bbdd($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para visualizar los nif de los clientes en un desplegable.
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
                echo "<option value='{$row['nif']}'>{$row['nif']} - {$row['nombre']} {$row['apellido']}</option>";
            }
            echo "</select>";
        } catch (PDOException $e) {
            error_function_bbdd($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para insertar un cliente.
    function insertarCliente(&$conn, $nif, $nombre, $apellido, $cp, $direccion, $ciudad) {
        try {
            empezarTransaccion($conn);
            $insert = $conn->prepare("INSERT INTO cliente (nif, nombre, apellido, cp, direccion, ciudad) VALUES (:nif, :nombre, :apellido, :cp, :direccion, :ciudad)");
            $insert->bindParam(':nif', $nif);
            $insert->bindParam(':nombre', $nombre);
            $insert->bindParam(':apellido', $apellido);
            $insert->bindParam(':cp', $cp);
            $insert->bindParam(':direccion', $direccion);
            $insert->bindParam(':ciudad', $ciudad);
            $insert->execute();
            insertarUsuario($conn, $nif, $nombre, $apellido);
            validar($conn);
            echo "<p>Se ha introducido al cliente con el nif $nif</p>";
        } catch (PDOException $e) {
            deshacer($conn);
            error_function_bbdd($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine(), "cliente");
        }
    }
//--------------------------------------------------------------------------
    // Función para insertar un usuario del cliente.
    function insertarUsuario(&$conn, $nif, $nombre, $apellido) {
        try {
            $select = $conn->prepare("SELECT MAX(usuario) FROM usuarios WHERE usuario LIKE :nombre");
            $aux = $nombre . "%";
            $select->bindParam(':nombre', $aux);
            $select->execute();
            $resultado = $select->fetchColumn();

            if (!empty($resultado)) {
                if (preg_match('/\d+/', $resultado, $coincidencias, PREG_OFFSET_CAPTURE)) {
                    $nombreBase = substr($resultado, 0, $coincidencias[0][1]);
                    $numero = intval(substr($resultado, $coincidencias[0][1])) + 1;
                    $nombre = $nombreBase . $numero;
                } else {
                    $nombre .= "0";
                }
            }

            $insert = $conn->prepare("INSERT INTO usuarios (nif, usuario, clave) VALUES (:nif, :usuario, :clave)");
            $insert->bindParam(':nif', $nif);
            $insert->bindParam(':usuario', $nombre);
            $clave = strrev($apellido);
            $insert->bindParam(':clave', $clave);
            $insert->execute();
            echo "<p>Su usuario es $nombre y su clave es $clave</p>";
        } catch (PDOException $e) {
            deshacer($conn);
            error_function_bbdd($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para visualizar los producto disponibles en un desplegable
    function imprimirSeleccionProductosDisponibles() {
        try {
            $conn = realizarConexion("comprasweb","localhost","root","rootroot");
            echo "<label for='producto'>Producto: </label>";
            echo "<select name='producto' id='producto'>";
            echo "<option value=''>--Seleccionar Producto--</option>";
            $select = $conn->prepare("SELECT al.num_almacen, al.id_producto, p.nombre, al.cantidad FROM almacena al, producto p WHERE al.id_producto = p.id_producto AND al.cantidad > 0 ORDER BY al.num_almacen");
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $select->fetchAll();
            foreach($resultado as $row) {
                echo "<option value='{$row['id_producto']}'>{$row['id_producto']} - {$row['nombre']}</option>";
            }
            echo "</select>";
            cerrarConexion($conn);
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function_bbdd($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para comprar un producto
    function comprarProducto(&$conn, $id_producto, $nif, $unidades) {
        try {
            $select = $conn->prepare("SELECT al.num_almacen, al.id_producto, al.cantidad FROM almacena al, producto p WHERE al.id_producto = p.id_producto AND al.id_producto = :id_producto ORDER BY al.num_almacen");
            $select->bindParam(':id_producto', $id_producto);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $select->fetchAll();

            $stockTotal = array_sum(array_column($resultado, 'cantidad'));

            if ($unidades > $stockTotal) {
                echo "<p>No hay suficiente stock del producto para $unidades unidades solicitadas</p>";
            }else {
                //empezarTransaccion($conn);
                $resto = $unidades;
                $indice = 0;
                $salir = false;
                $update = $conn->prepare("UPDATE almacena SET cantidad = :nueva_cantidad WHERE num_almacen = :num_almacen AND id_producto = :id_producto");

                while (!$salir && $indice < count($resultado)) {
                    $resto -= $resultado[$indice]["cantidad"];
                    $nueva_cantidad = ($resto > 0) ? 0 : abs($resto);
                    $update->bindParam(':nueva_cantidad', $nueva_cantidad);
                    $num_almacen = $resultado[$indice]["num_almacen"];
                    $update->bindParam(':num_almacen', $num_almacen);
                    $update->bindParam(':id_producto', $id_producto);
                    $update->execute();
                    $salir = ($resto <= 0) ? true : false;
                    $indice += 1;
                }
                
                insertarCompra($conn, $nif, $id_producto, $unidades);
                //validar($conn);
                //echo "<p>Su compra de $unidades unidades del producto $id_producto se realizó correctamente.</p>";
            }
        } catch (PDOException $e) {
            deshacer($conn);
            error_function_bbdd($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para insertar en la tabla compra. Prueba máquina virtual
    function insertarCompra(&$conn, $nif, $id_producto, $unidades) {
        try {
            $select = $conn->prepare("SELECT unidades FROM compra WHERE nif = :nif AND id_producto = :id_producto AND fecha_compra = :fecha_compra");
            $select->bindParam(':nif', $nif);
            $select->bindParam(':id_producto', $id_producto);
            $fecha_compra = date("Y-m-d");
            $select->bindParam(':fecha_compra', $fecha_compra);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $select->fetchAll();

            if (!empty($resultado)) {
                $update = $conn->prepare("UPDATE compra SET unidades = unidades + :unidades WHERE nif = :nif AND id_producto = :id_producto AND fecha_compra = :fecha_compra");
                $update->bindParam(':unidades', $unidades);
                $update->bindParam(':nif', $nif);
                $update->bindParam(':id_producto', $id_producto);
                $fecha_compra = date("Y-m-d");
                $update->bindParam(':fecha_compra', $fecha_compra);
                $update->execute();
            }else {
                $insert = $conn->prepare("INSERT INTO compra (nif, id_producto, fecha_compra, unidades) VALUES (:nif, :id_producto, :fecha_compra, :unidades)");
                $insert->bindParam(':nif', $nif);
                $insert->bindParam(':id_producto', $id_producto);
                $insert->bindParam(':fecha_compra', $fecha_compra);
                $insert->bindParam(':unidades', $unidades);
                $insert->execute();
            }
        } catch (PDOException $e) {
            deshacer($conn);
            error_function_bbdd($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para comprobar la existencia del usuario.
    function comprobarUsuario($usuario) {
        try {
            $conn = realizarConexion("comprasweb","localhost","root","rootroot");
            $select = $conn->prepare("SELECT usuario FROM usuarios WHERE usuario = :usuario");
            $select->bindParam(':usuario', $usuario);
            $select->execute();
            $resultado = $select->fetchColumn();
            $devolver = ($resultado !== false) ? true : false;
            cerrarConexion($conn);
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
        return $devolver;
    }
//--------------------------------------------------------------------------
    // Función para comprobar la contraseña del usuario.
    function comprobarClave($usuario, $clave) {
        try {
            $conn = realizarConexion("comprasweb","localhost","root","rootroot");
            $select = $conn->prepare("SELECT clave FROM usuarios WHERE usuario = :usuario AND clave = :clave");
            $select->bindParam(':usuario', $usuario);
            $select->bindParam(':clave', $clave);
            $select->execute();
            $resultado = $select->fetchColumn();
            $devolver = ($resultado !== false) ? true : false;
            cerrarConexion($conn);
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
        return $devolver;
    }
//--------------------------------------------------------------------------
    // Función para crear la sesión.
    function crearSesion($usuario, $clave) {
        session_start();
        $_SESSION["usuario"] = $usuario;
        $_SESSION["clave"] = $clave;
        header("Location: ./menu.php");
    }
//--------------------------------------------------------------------------
    // Función para cerrar sesión.
    function cerrarSesion() {
        session_unset();
        session_destroy();
        setcookie("PHPSESSID", "", time() - 3600, "/");
        header("Location: ./comlogincli.php");
    }
//--------------------------------------------------------------------------
    // Función para guardar producto.
    function guardarProducto($id_producto, $unidades) {
        try {
            $stockTotal = comprobarStockProducto($id_producto);

            if ($unidades > $stockTotal) {
                echo "<p>No hay suficiente stock del producto para $unidades unidades solicitadas</p>";
            }else {
                if (!isset($_SESSION["cesta"])) {
                    $_SESSION["cesta"] = "$id_producto,$unidades";
                }else if (strpos($_SESSION["cesta"], $id_producto) !== false) {
                    $productos = explode(";", $_SESSION["cesta"]);
                    $productoEncontrado = false;
                    $indice = 0;
                
                    while (!$productoEncontrado && $indice < count($productos)) {
                        $datos = explode(",", $productos[$indice]);
                        if ($datos[0] === $id_producto) {
                            $datos[1] = $unidades;
                            $productos[$indice] = implode(",", $datos);
                            $productoEncontrado = true;
                        }
                        $indice += 1;
                    }
                
                    $_SESSION["cesta"] = implode(";", $productos);
                }else {
                    $_SESSION["cesta"] .= ";$id_producto,$unidades";
                }
            }
        } catch (PDOException $e) {
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para imprimir la cesta en una lista.
    function imprimirCesta() {
        echo "<ul>";
        $productos = explode(";", $_SESSION["cesta"]);
        foreach ($productos as $producto) {
            list($id_producto, $unidades) = explode(",", $producto);
            echo "<li>$id_producto - $unidades</li>";
        }
        echo "</ul>";
    }
//--------------------------------------------------------------------------
    // Función para comprobar stock por producto.
    function comprobarStockProducto($id_producto) {
        try {
            $conn = realizarConexion("comprasweb","localhost","root","rootroot");
            $select = $conn->prepare("SELECT al.cantidad FROM almacena al, producto p WHERE al.id_producto = p.id_producto AND al.id_producto = :id_producto ORDER BY al.num_almacen");
            $select->bindParam(':id_producto', $id_producto);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $select->fetchAll();
            cerrarConexion($conn);

            $stockTotal = array_sum(array_column($resultado, 'cantidad'));
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
        return $stockTotal;
    }
//--------------------------------------------------------------------------
    // Función para obtener el nif del usuario
    function obtenerNifUsuario($usuario) {
        try {
            $conn = realizarConexion("comprasweb","localhost","root","rootroot");
            $select = $conn->prepare("SELECT nif FROM usuarios WHERE usuario = :usuario");
            $select->bindParam(':usuario', $usuario);
            $select->execute();
            $resultado = $select->fetchColumn();
            cerrarConexion($conn);
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
        return $resultado;
    }
//--------------------------------------------------------------------------
    // Función para comprar producto por sesión.
    function comprarProductoSesion() {
        try {
            $conn = realizarConexion("comprasweb","localhost","root","rootroot");
            $nif = obtenerNifUsuario($_SESSION["usuario"]);

            $compras = explode(";", $_SESSION["cesta"]);
            empezarTransaccion($conn);
            foreach ($compras as $compra) {
                list($id_producto, $unidades) = explode(",", $compra);
                $stockTotal = comprobarStockProducto($id_producto);
                if ($unidades > $stockTotal) {
                    throw new Exception("No hay suficiente stock del producto $id_producto actualmente.");
                }
                comprarProducto($conn, $id_producto, $nif, $unidades);
            }
            validar($conn);
            echo "<p>Ha realizado sus compras corrctamente.</p>";
            $_SESSION["cesta"] = null;
        } catch (PDOException $e) {
            deshacer($conn);
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        } catch (Exception $e) {
            deshacer($conn);
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para visualizar las compras de un cliente entre dos fechas por sesión.
    function visualizarComprasClienteSesion($fecha_in, $fecha_fin, $usuario) {
        try {
            $conn = realizarConexion("comprasweb","localhost","root","rootroot");
            $nif = obtenerNifUsuario($usuario);
            $select = $conn->prepare("SELECT cli.nif, p.id_producto, p.nombre AS 'producto', c.unidades, (c.unidades * p.precio) AS 'precio compra' FROM cliente cli, producto p, compra c WHERE cli.nif = c.nif AND p.id_producto = c.id_producto AND cli.nif = :nif AND fecha_compra BETWEEN :fecha_in AND :fecha_fin ORDER BY fecha_compra");
            $select->bindParam(':nif', $nif);
            $select->bindParam(':fecha_in', $fecha_in);
            $select->bindParam(':fecha_fin', $fecha_fin);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $select->fetchAll();
            cerrarConexion($conn);
            if (empty($resultado)) { 
                echo "<p>No se encontraron compras para el cliente $nif entre las fechas $fecha_in y $fecha_fin.</p>";
            }else {
                echo "<h2>Compras del cliente {$resultado[0]['nif']} entre $fecha_in y $fecha_fin</h2>";
                echo "<ul>";
                $total = 0;
                foreach ($resultado as $row) {
                    echo "<li>{$row['id_producto']} - {$row['producto']}, {$row['unidades']} unidades, precio compra {$row['precio compra']}</li>";
                    $total += $row['precio compra'];
                }
                echo "</ul>";
                echo "<p>El monto total de las " . count($resultado) . " compras es $total</p>";
            }
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
    // Función para crear una sesión con cookies.
    function crearSesionCookies($usuario, $clave) {
        setcookie("usuario", $usuario, time() + 86400, "/");
        setcookie("clave", $clave, time() + 86400, "/");
        header("Location: ./menu_cookies.php");
    }
//--------------------------------------------------------------------------
    // Función para cerrar sesión eliminando cookies.
    function cerrarSesionCookies() {
        setcookie("usuario", "", time() - 3600, "/");
        setcookie("clave", "", time() - 3600, "/");
        header("Location: ./comlogincli_cookies.php");
    }
//--------------------------------------------------------------------------
    // Función para guardar producto.
    function guardarProductoCookies($id_producto, $unidades) {
        try {
            $stockTotal = comprobarStockProducto($id_producto);

            if ($unidades > $stockTotal) {
                echo "<p>No hay suficiente stock del producto para $unidades unidades solicitadas</p>";
            }else {
                if (!isset($_COOKIE["cesta"])) {
                    $_COOKIE["cesta"] = "$id_producto,$unidades";
                }else if (strpos($_COOKIE["cesta"], $id_producto) !== false) {
                    $productos = explode(";", $_COOKIE["cesta"]);
                    $productoEncontrado = false;
                    $indice = 0;
                
                    while (!$productoEncontrado && $indice < count($productos)) {
                        $datos = explode(",", $productos[$indice]);
                        if ($datos[0] === $id_producto) {
                            $datos[1] = $unidades;
                            $productos[$indice] = implode(",", $datos);
                            $productoEncontrado = true;
                        }
                        $indice += 1;
                    }
                
                    $_COOKIE["cesta"] = implode(";", $productos);
                }else {
                    $_COOKIE["cesta"] .= ";$id_producto,$unidades";
                }
            }
        } catch (PDOException $e) {
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para imprimir la cesta en una lista.
    function imprimirCestaCookies() {
        echo "<ul>";
        $productos = explode(";", $_COOKIE["cesta"]);
        foreach ($productos as $producto) {
            list($id_producto, $unidades) = explode(",", $producto);
            echo "<li>$id_producto - $unidades</li>";
        }
        echo "</ul>";
    }
//--------------------------------------------------------------------------
// Función para comprar producto por sesión.
function comprarProductoSesionCookies() {
    try {
        $conn = realizarConexion("comprasweb","localhost","root","rootroot");
        $nif = obtenerNifUsuario($_COOKIE["usuario"]);

        $compras = explode(";", $_COOKIE["cesta"]);
        empezarTransaccion($conn);
        foreach ($compras as $compra) {
            list($id_producto, $unidades) = explode(",", $compra);
            $stockTotal = comprobarStockProducto($id_producto);
            if ($unidades > $stockTotal) {
                throw new Exception("No hay suficiente stock del producto $id_producto actualmente.");
            }
            comprarProducto($conn, $id_producto, $nif, $unidades);
        }
        validar($conn);
        echo "<p>Ha realizado sus compras corrctamente.</p>";
        $_COOKIE["cesta"] = null;
    } catch (PDOException $e) {
        deshacer($conn);
        cerrarConexion($conn);
        error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
    } catch (Exception $e) {
        deshacer($conn);
        cerrarConexion($conn);
        error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
    }
}
//--------------------------------------------------------------------------
    // Función para visualizar las compras de un cliente entre dos fechas por sesión.
    function visualizarComprasClienteSesionCookies($fecha_in, $fecha_fin, $usuario) {
        try {
            $conn = realizarConexion("comprasweb","localhost","root","rootroot");
            $nif = obtenerNifUsuario($usuario);
            $select = $conn->prepare("SELECT cli.nif, p.id_producto, p.nombre AS 'producto', c.unidades, (c.unidades * p.precio) AS 'precio compra' FROM cliente cli, producto p, compra c WHERE cli.nif = c.nif AND p.id_producto = c.id_producto AND cli.nif = :nif AND fecha_compra BETWEEN :fecha_in AND :fecha_fin ORDER BY fecha_compra");
            $select->bindParam(':nif', $nif);
            $select->bindParam(':fecha_in', $fecha_in);
            $select->bindParam(':fecha_fin', $fecha_fin);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $select->fetchAll();
            cerrarConexion($conn);
            if (empty($resultado)) { 
                echo "<p>No se encontraron compras para el cliente $nif entre las fechas $fecha_in y $fecha_fin.</p>";
            }else {
                echo "<h2>Compras del cliente {$resultado[0]['nif']} entre $fecha_in y $fecha_fin</h2>";
                echo "<ul>";
                $total = 0;
                foreach ($resultado as $row) {
                    echo "<li>{$row['id_producto']} - {$row['producto']}, {$row['unidades']} unidades, precio compra {$row['precio compra']}</li>";
                    $total += $row['precio compra'];
                }
                echo "</ul>";
                echo "<p>El monto total de las " . count($resultado) . " compras es $total</p>";
            }
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------