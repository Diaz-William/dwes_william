<?php
//--------------------------------------------------------------------------
    // Incluir el archivo de funciones generales.
    include "funciones.php";
//--------------------------------------------------------------------------
    // Función para visualizar los producto disponibles en un desplegable.
    function imprimirSeleccionProductosDisponibles() {
        try {
            $conn = realizarConexion("pedidos","localhost","root","rootroot");
            echo "<label for='producto'>Producto: </label>";
            echo "<select name='producto' id='producto'>";
            echo "<option value=''>--Seleccionar Producto--</option>";
            $stmt = $conn->prepare("SELECT productCode, productName FROM products WHERE quantityInStock > 0");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $stmt->fetchAll();
            cerrarConexion($conn);
            foreach($resultado as $row) {
                echo "<option value='{$row['productCode']}'>{$row['productCode']} - {$row['productName']}</option>";
            }
            echo "</select>";
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para guardar producto.
    function guardarProductoCookies($productCode, $precio, $unidades) {
        $stockTotal = comprobarStockProducto($productCode);
    
        if ($unidades > $stockTotal) {
            trigger_error("No hay suficiente stock del producto para $unidades unidades solicitadas");
        } else {
            $cesta = isset($_COOKIE["cesta"]) ? unserialize($_COOKIE["cesta"]) : array();
            $cesta[$productCode] = ['precio' => $precio, 'unidades' => isset($cesta[$productCode]) ? $cesta[$productCode]['unidades'] + $unidades : $unidades];
            setcookie("cesta", serialize($cesta), time() + 86400, "/");
        }
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
    // Función para comprar producto por sesión.
    function comprarProductoSesionCookies() {
        try {
            $conn = realizarConexion("pedidos","localhost","root","rootroot");

            $cesta = unserialize($_COOKIE["cesta"]);
            empezarTransaccion($conn);
            foreach ($cesta as $productCode => $productData) {
                actualizarCantidadProducto($conn, $productCode, $productData["unidades"]);
            }
            insertarOrden($conn, $_COOKIE["usuario"]);
            validar($conn);
            cerrarConexion($conn);
            echo "<p>Ha realizado sus compras corrctamente.</p>";
            setcookie("cesta", "", time() + 86400, "/");
        } catch (PDOException $e) {
            deshacer($conn);
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
        $stmt->execute();
    }
//--------------------------------------------------------------------------
    // Función para insertar la orden del pedido.
    function insertarOrden($conn, $customerNumber) {
        $fecha = date("Y-m-d");

        $stmt = $conn->prepare("SELECT (MAX(orderNumber) + 1) FROM orders");
        $stmt->execute();
        $resultado = $stmt->fetchColumn();

        $stmt = $conn->prepare("INSERT INTO orders (orderNumber, orderDate, requiredDate, shippedDate, status, comments, customerNumber) VALUES (:orderNumber, :orderDate, :requiredDate, :shippedDate, :status, :comments, :customerNumber)");
        $stmt->bindParam(':orderNumber', $resultado);
        $stmt->bindParam(':orderDate', $fecha);
        $stmt->bindParam(':requiredDate', $fecha);
        $stmt->bindParam(':shippedDate', null);
        $stmt->bindParam(':status', "Shipped");
        $stmt->bindParam(':comments', null);
        $stmt->bindParam(':customerNumber', $customerNumber);
        $stmt->execute();
        insertarOrdenDetalles($conn, $resultado);
    }
//--------------------------------------------------------------------------
    // Función para insertar los detalles de la orden del pedido.
    function insertarOrdenDetalles($conn, $orderNumber) {
        $cesta = unserialize($_COOKIE["cesta"]);
        foreach ($cesta as $productCode => $productData) {
            $stmt = $conn->prepare("INSERT INTO orderdetails (orderNumber, productCode, quantityOrdered, priceEach, orderLineNumber) VALUES (:orderNumber, :productCode, :quantityOrdered, :priceEach, :orderLineNumber)");
            $stmt->bindParam(':orderNumber', $orderNumber);
            $stmt->bindParam(':productCode', $productCode);
            $stmt->bindParam(':quantityOrdered', $productData["unidades"]);
            $stmt->bindParam(':priceEach', $productData["precio"]);
            $stmt->bindParam(':orderLineNumber', 2);
            $stmt->execute();
        }
    }
//--------------------------------------------------------------------------