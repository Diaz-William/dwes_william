<?php
//--------------------------------------------------------------------------
    // Incluir el archivo de funciones generales.
    include "funciones.php";
//--------------------------------------------------------------------------
    // Función para mostrar todos los pedidos de un cliente.
    function mostrarPedidos($customerNumber) {
        try {
            $conn = realizarConexion("pedidos","localhost","root","rootroot");
            $stmt = $conn->prepare("SELECT orderNumber, orderDate, status FROM orders WHERE customerNumber = :customerNumber");
            $stmt->bindParam(':customerNumber', $customerNumber);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $stmt->fetchAll();
            cerrarConexion($conn);
            if (!empty($resultado)) {
                echo "<ul>";
                foreach ($resultado as $row) {
                    echo "<li>{$row['orderNumber']} - {$row['orderDate']} - {$row['status']}</li>";
                    mostrarDetallesPedido($row["orderNumber"]);
                }
                echo "</ul>";
            }else {
                echo "<p>No se han realizado pedidos</p>";
            }
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para mostrar los detalles de un pedido.
    function mostrarDetallesPedido($orderNumber) {
        try {
            $conn = realizarConexion("pedidos","localhost","root","rootroot");
            $stmt = $conn->prepare("SELECT od.orderLineNumber, p.productName, od.quantityOrdered, od.priceEach FROM orderdetails od, products p WHERE p.productCode = od.productCode AND od.orderNumber = :orderNumber ORDER BY od.orderLineNumber");
            $stmt->bindParam(':orderNumber', $orderNumber);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $stmt->fetchAll();
            cerrarConexion($conn);
            echo "<ul>";
            foreach ($resultado as $row) {
                echo "<li>{$row['orderLineNumber']} - {$row['productName']} - {$row['quantityOrdered']} - {$row['priceEach']}</li>";
            }
            echo "</ul>";
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------