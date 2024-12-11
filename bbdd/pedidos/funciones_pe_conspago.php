<?php
//--------------------------------------------------------------------------
    // Incluir el archivo de funciones generales.
    include "funciones.php";
//--------------------------------------------------------------------------
    // Función para ver los pagos realizados de un cliente entre dos fechas.
    function verPagosFehcas($fecha_in, $fecha_fin) {
        try {
            $conn = realizarConexion("pedidos","localhost","root","rootroot");
            $stmt = $conn->prepare("SELECT checkNumber, paymentDate, amount FROM payments WHERE customerNumber = :customerNumber AND paymentDate BETWEEN :fecha_in AND :fecha_fin");
            $stmt->bindParam(':customerNumber', $_COOKIE["usuario"]);
            $stmt->bindParam(':fecha_in', $fecha_in);
            $stmt->bindParam(':fecha_fin', $fecha_fin);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $pagos = $stmt->fetchAll();
            cerrarConexion($conn);
            if ($pagos !== false) {
                visualizarPagos($pagos);
            }else {
                echo "<p>No hay compras</p>";
            }
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para ver todos los pagos realizados de un cliente.
    function verPagos() {
        try {
            $conn = realizarConexion("pedidos","localhost","root","rootroot");
            $stmt = $conn->prepare("SELECT checkNumber, paymentDate, amount FROM payments WHERE customerNumber = :customerNumber");
            $stmt->bindParam(':customerNumber', $_COOKIE["usuario"]);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $pagos = $stmt->fetchAll();
            cerrarConexion($conn);
            visualizarPagos($pagos);
        } catch (PDOException $e) {
            cerrarConexion($conn);
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
//--------------------------------------------------------------------------
    // Función para visualizar los datos de los pagos de un cliente.
    function visualizarPagos($pagos) {
        echo "<ul>";
        foreach ($pagos as $pago) {
            echo "<li>{$pago['checkNumber']} - {$pago['paymentDate']} - {$pago['amount']}</li>";
        }
        echo "</ul>";
    }
//--------------------------------------------------------------------------