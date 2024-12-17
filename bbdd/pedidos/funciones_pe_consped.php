<?php
//--------------------------------------------------------------------------
    // Incluir el archivo de funciones generales.
    include "funciones.php";
//--------------------------------------------------------------------------
    // Función para obtener todos los pedidos y sus detalles.
    function obtenerPedidosYDetalles($customerNumber) {
        try {
            $conn = realizarConexion("pedidos", "localhost", "root", "rootroot");
            $stmt = $conn->prepare("SELECT o.orderNumber, o.orderDate, o.status, od.orderLineNumber, p.productName, od.quantityOrdered, od.priceEach FROM orders o, orderdetails od, products p WHERE o.orderNumber = od.orderNumber AND od.productCode = p.productCode AND o.customerNumber = :customerNumber ORDER BY o.orderNumber, od.orderLineNumber");
            $stmt->bindParam(':customerNumber', $customerNumber);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $stmt->fetchAll();
            cerrarConexion($conn);
            mostrarPedidosYDetalles($resultado);
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para mostrar todos los pedidos y sus detalles.
    function mostrarPedidosYDetalles($resultado) {
        echo "<ul>";
        foreach ($resultado as $row) {
            echo "<li>{$row['orderNumber']} - {$row['orderDate']} - {$row['status']}</li>";
            echo "<ul>";
                echo "<li>{$row['orderLineNumber']} - {$row['productName']} - {$row['quantityOrdered']} - {$row['priceEach']}</li>";
            echo "</ul>";
        }
        echo "</ul>";
    }
//--------------------------------------------------------------------------