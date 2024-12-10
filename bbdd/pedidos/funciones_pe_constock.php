<?php
//--------------------------------------------------------------------------
    // Incluir el archivo de funciones generales.
    include "funciones.php";
//--------------------------------------------------------------------------
    // Función para visualizar los producto disponibles en un desplegable.
    function imprimirSeleccionLineaProducto() {
        try {
            $conn = realizarConexion("pedidos","localhost","root","rootroot");
            echo "<label for='productLine'>productLine: </label>";
            echo "<select name='productLine' id='productLine'>";
            echo "<option value=''>--Seleccionar productLine--</option>";
            $stmt = $conn->prepare("SELECT productLine FROM productLines");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $stmt->fetchAll();
            cerrarConexion($conn);
            foreach($resultado as $row) {
                echo "<option value='{$row['productLine']}'>{$row['productLine']}</option>";
            }
            echo "</select>";
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para consultar stock de un producto.
    function consultarStockProducto($productLine) {
        try {
            $conn = realizarConexion("pedidos","localhost","root","rootroot");
            $stmt = $conn->prepare("SELECT productName, quantityInStock FROM products WHERE productLine = :productLine ORDER BY quantityInStock DESC");
            $stmt->bindParam(':productLine', $productLine);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $stmt->fetchAll();
            cerrarConexion($conn);
            echo "<ul>";
            foreach ($resultado as $row) {
                echo "<li>{$row['productName']} - {$row['quantityInStock']}</li>";
            }
            echo "</ul>";
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------