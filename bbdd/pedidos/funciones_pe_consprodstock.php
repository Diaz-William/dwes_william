<?php
//--------------------------------------------------------------------------
    // Incluir el archivo de funciones generales.
    include "funciones.php";
//--------------------------------------------------------------------------
    // Función para visualizar los producto en un desplegable.
    function imprimirSeleccionProductos() {
        try {
            $conn = realizarConexion("pedidos","localhost","root","rootroot");
            echo "<label for='producto'>Producto: </label>";
            echo "<select name='producto' id='producto'>";
            echo "<option value=''>--Seleccionar Producto--</option>";
            $stmt = $conn->prepare("SELECT productCode, productName FROM products");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $stmt->fetchAll();
            cerrarConexion($conn);
            foreach($resultado as $row) {
                echo "<option value='{$row['productCode']}'>{$row['productName']}</option>";
            }
            echo "</select>";
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para consultar stock de un producto.
    function consultarStockProducto($productCode) {
        try {
            $conn = realizarConexion("pedidos","localhost","root","rootroot");
            $stmt = $conn->prepare("SELECT quantityInStock FROM products WHERE productCode = :productCode");
            $stmt->bindParam(':productCode', $productCode);
            $stmt->execute();
            $resultado = $stmt->fetchColumn();
            cerrarConexion($conn);
            echo "<p>Hay $resultado unidades.</p>";
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------