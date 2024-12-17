<?php
//--------------------------------------------------------------------------
    // Incluir el archivo de funciones generales.
    include "funciones.php";
//--------------------------------------------------------------------------
    // Función para obtener los productos.
    function obtenerProductos() {
        try {
            $conn = realizarConexion("pedidos","localhost","root","rootroot");
            $stmt = $conn->prepare("SELECT productCode, productName FROM products");
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
    // Función para visualizar los producto en un desplegable.
    function imprimirSeleccionProductos() {
        $resultado = obtenerProductos();
        echo "<label for='producto'>Producto: </label>";
        echo "<select name='producto' id='producto'>";
        echo "<option value=''>--Seleccionar Producto--</option>";
        foreach($resultado as $row) {
            echo "<option value='{$row['productCode']}'>{$row['productName']}</option>";
        }
        echo "</select>";
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
            visualizarStock($resultado);
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para visualizar el stock.
    function visualizarStock($resultado) {
        echo "<p>Hay $resultado unidades.</p>";
    }
//--------------------------------------------------------------------------