<?php
//--------------------------------------------------------------------------
    // Incluir el archivo de funciones generales.
    include "funciones.php";
//--------------------------------------------------------------------------
    // Función para obtener todas las ordenes de los pedidos entre dos fechas.
    function obtenerOrdenes($fecha_in, $fecha_fin) {
        try {
            $conn = realizarConexion("pedidos","localhost","root","rootroot");
            $stmt = $conn->prepare("SELECT orderNumber FROM orders WHERE orderDate BETWEEN :fecha_in AND :fecha_fin ORDER BY orderDate");
            $stmt->bindParam(':fecha_in', $fecha_in);
            $stmt->bindParam(':fecha_fin', $fecha_fin);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $ordenes = $stmt->fetchAll();
            cerrarConexion($conn);
            calcularProductosVendidos($ordenes);
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para calcular las unidades totales de cada uno de los productos vendidos entre dos fechas.
    function calcularProductosVendidos($ordenes) {
        try {
            $productos = array();
            $conn = realizarConexion("pedidos","localhost","root","rootroot");
            foreach ($ordenes as $order) {
                $stmt = $conn->prepare("SELECT p.productCode, od.quantityOrdered from products p, orderdetails od WHERE p.productCode = od.productCode AND od.orderNumber = :orderNumber");
                $stmt->bindParam(':orderNumber', $order["orderNumber"]);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $resultado = $stmt->fetchAll();
                foreach ($resultado as $row) {
                    $productos[$row["productCode"]] = isset($productos[$row["productCode"]]) ? $productos[$row["productCode"]] + $row["quantityOrdered"] : $row["quantityOrdered"];
                }
            }
            cerrarConexion($conn);
            foreach ($productos as $productCode => $quantityOrdered) {
                var_dump("$productCode -- $quantityOrdered");
            }
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------