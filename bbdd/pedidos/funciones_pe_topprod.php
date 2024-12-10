<?php
//--------------------------------------------------------------------------
    // Incluir el archivo de funciones generales.
    include "funciones.php";
//--------------------------------------------------------------------------
    // Función para obtener las unidades totales de cada uno de los productos vendidos entre dos fechas.
    function obtenerProductosVendidos($fecha_in, $fecha_fin) {
        try {
            $conn = realizarConexion("pedidos","localhost","root","rootroot");
            $stmt = $conn->prepare("SELECT p.productName, SUM(od.quantityOrdered) AS 'totalQuantityOrdered' FROM orders o, products p, orderdetails od WHERE o.orderNumber = od.orderNumber AND p.productCode = od.productCode  AND orderDate BETWEEN :fecha_in AND :fecha_fin GROUP BY p.productCode ORDER BY o.orderDate");
            $stmt->bindParam(':fecha_in', $fecha_in);
            $stmt->bindParam(':fecha_fin', $fecha_fin);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $stmt->fetchAll();
            cerrarConexion($conn);
            echo "<ul>";
            foreach ($resultado as $row) {
                echo "<li>{$row['productName']} - {$row['totalQuantityOrdered']}</li>";
            }
            echo "</ul>";
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------