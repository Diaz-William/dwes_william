<?php
//--------------------------------------------------------------------------
    // Incluir el archivo de funciones generales.
    include "funciones.php";
//--------------------------------------------------------------------------
    // Función para obtener los productos disponibles.
    function obtenerProductosDisponibles() {
        try {
            $conn = realizarConexion("pedidos","localhost","root","rootroot");
            $stmt = $conn->prepare("SELECT productCode, productName, buyPrice FROM products WHERE quantityInStock > 0");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $stmt->fetchAll();
            cerrarConexion($conn);
            return $resultado;
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para visualizar los producto disponibles en un desplegable.
    function imprimirSeleccionProductosDisponibles() {
        $resultado = obtenerProductosDisponibles();
        echo "<label for='producto'>Producto: </label>";
        echo "<select name='producto' id='producto'>";
        echo "<option value=''>--Seleccionar Producto--</option>";
        foreach($resultado as $row) {
            echo "<option value='{$row['productCode']}#{$row['productName']}#{$row['buyPrice']}'>{$row['productCode']} - {$row['productName']}</option>";
        }
        echo "</select>";
    }
//--------------------------------------------------------------------------
    // Función para guardar producto.
    function guardarProductoCookies($productCode, $productName, $priceEach, $unidades) {
        $stockTotal = comprobarStockProducto($productCode);
        $correcto = true;
    
        if ($unidades > $stockTotal) {
            $correcto = false;
        } else {
            $cesta = isset($_COOKIE["cesta"]) ? unserialize($_COOKIE["cesta"]) : array();
            
            if (isset($cesta[$productCode])) {
                $cesta[$productCode]['unidades'] += $unidades;
            } else {
                $cesta[$productCode] = ['precio' => $priceEach, 'unidades' => $unidades, 'nombre' => $productName];
            }
    
            setcookie("cesta", serialize($cesta), time() + 86400, "/");
        }

        return $correcto;
    }    
//--------------------------------------------------------------------------
    // Función para comprobar stock por producto.
    function comprobarStockProducto($productCode) {
        try {
            $conn = realizarConexion("pedidos","localhost","root","rootroot");
            $stmt = $conn->prepare("SELECT quantityInStock FROM products WHERE productCode = :productCode");
            $stmt->bindParam(':productCode', $productCode);
            $stmt->execute();
            $resultado = $stmt->fetchColumn();
            cerrarConexion($conn);
            return $resultado;
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para imprimir la cesta en una lista.
    function imprimirCestaCookies() {
        if (isset($_COOKIE["cesta"])) {
            echo "<ul>";
            $cesta = unserialize($_COOKIE["cesta"]);
            foreach ($cesta as $productCode) {
                echo "<li>{$productCode['nombre']} - {$productCode['unidades']}</li>";
            }
            echo "</ul>";
        }
    }
//--------------------------------------------------------------------------
    // Función para comprar producto por sesión.
    function comprarProductoSesionCookies($checkNumber, $pagoRealizado) {
        try {
            $orderNumber = obtenerPkOrden();
            $conn = realizarConexion("pedidos","localhost","root","rootroot");

            $cesta = unserialize($_COOKIE["cesta"]);
            empezarTransaccion($conn);
            insertarOrden($conn, $_COOKIE["usuario"], $orderNumber, $pagoRealizado);
            if ($pagoRealizado) {
                insertarPago($conn, $checkNumber);
            }
            foreach ($cesta as $productCode => $productData) {
                actualizarCantidadProducto($conn, $productCode, $productData["unidades"]);
            }
            validar($conn);
            cerrarConexion($conn);
            setcookie("cesta", "", time() - 86400, "/");
        } catch (PDOException $e) {
            deshacer($conn);
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para obtener el checkNumber de un cliente.
    function obtenerCheckNumber($checkNumber) {
        try {
            $conn = realizarConexion("pedidos", "localhost", "root", "rootroot");
            $stmt = $conn->prepare("SELECT 1 FROM payments WHERE customerNumber = :customerNumber AND checkNumber = :checkNumber");
            $customerNumber = $_COOKIE["usuario"];
            $stmt->bindParam(':customerNumber', $customerNumber);
            $stmt->bindParam(':checkNumber', $checkNumber);
            $stmt->execute();
            $resultado = $stmt->fetchColumn();
            cerrarConexion($conn);
            return $resultado === false;
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para actualizar la cantidad de un producto.
    function actualizarCantidadProducto($conn, $productCode, $unidades) {
        $stockTotal = comprobarStockProducto($productCode);

        if ($unidades > $stockTotal) {
            trigger_error("No hay suficiente stock");
        }

        $stmt = $conn->prepare("UPDATE products SET quantityInStock = quantityInStock - :unidades WHERE productCode = :productCode");
        $stmt->bindParam(':unidades', $unidades);
        $stmt->bindParam(':productCode', $productCode);
        $stmt->execute();
    }
//--------------------------------------------------------------------------
    // Función para obtener el siguiente número de orden.
    function obtenerPkOrden() {
        try {
            $conn = realizarConexion("pedidos", "localhost", "root", "rootroot");
            $stmt = $conn->prepare("SELECT (MAX(orderNumber) + 1) FROM orders");
            $stmt->execute();
            $orderNumber = $stmt->fetchColumn();
            cerrarConexion($conn);
            return $orderNumber;
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para insertar la orden del pedido.
    function insertarOrden($conn, $customerNumber, $orderNumber, $pagoRealizado) {
        $fecha = date("Y-m-d");
        $null = null;
        $estado = $pagoRealizado ? "Shipped" : "In Proccess";

        $stmt = $conn->prepare("INSERT INTO orders (orderNumber, orderDate, requiredDate, status, comments, customerNumber) VALUES (:orderNumber, :orderDate, :requiredDate, :status, :comments, :customerNumber)");
        $stmt->bindParam(':orderNumber', $orderNumber);
        $stmt->bindParam(':orderDate', $fecha);
        $stmt->bindParam(':requiredDate', $fecha);
        $stmt->bindParam(':status', $estado);
        $stmt->bindParam(':comments', $null);
        $stmt->bindParam(':customerNumber', $customerNumber);
        $stmt->execute();
        insertarOrdenDetalles($conn, $orderNumber);
    }
//--------------------------------------------------------------------------
    // Función para insertar los detalles de la orden del pedido.
    function insertarOrdenDetalles($conn, $orderNumber) {
        $orderLineNumber = 0;
        $cesta = unserialize($_COOKIE["cesta"]);
        foreach ($cesta as $productCode => $productData) {
            $stmt = $conn->prepare("INSERT INTO orderdetails (orderNumber, productCode, quantityOrdered, priceEach, orderLineNumber) VALUES (:orderNumber, :productCode, :quantityOrdered, :priceEach, :orderLineNumber)");
            $stmt->bindParam(':orderNumber', $orderNumber);
            $stmt->bindParam(':productCode', $productCode);
            $stmt->bindParam(':quantityOrdered', $productData["unidades"]);
            $stmt->bindParam(':priceEach', $productData["precio"]);
            $orderLineNumber += 1;
            $stmt->bindParam(':orderLineNumber', $orderLineNumber);
            $stmt->execute();
        }
    }
//--------------------------------------------------------------------------
    // Función para insertar el pago.
    function insertarPago($conn, $checkNumber) {
        $fecha = date("Y-m-d");
        $amount = obtenerMonto();

        $stmt = $conn->prepare("INSERT INTO payments(customerNumber, checkNumber, paymentDate, amount) VALUES (:customerNumber, :checkNumber, :paymentDate, :amount)");
        $stmt->bindParam(':customerNumber', $_COOKIE["usuario"]);
        $stmt->bindParam(':checkNumber', $checkNumber);
        $stmt->bindParam(':paymentDate', $fecha);
        $stmt->bindParam(':amount', $amount);
        $stmt->execute();
    }
//--------------------------------------------------------------------------
    // Función para obtener el monto del pedido.
    function obtenerMonto() {
        $cesta = unserialize($_COOKIE["cesta"]);
        $amount = 0;
        foreach ($cesta as $productCode) {
            $amount += $productCode["precio"] * $productCode["unidades"];
        }
        return $amount;
    }
//--------------------------------------------------------------------------