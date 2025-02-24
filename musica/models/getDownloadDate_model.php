<?php
    function getDownloadDate($fechadesde, $fechahasta) {
        try {
            require_once("../models/getCustomerId_model.php");
            $customerid = getCustomerId();
            $conn = conectar();
            $stmt = $conn->prepare("SELECT t.Name, IFNULL(t.Composer, 'N/A') AS Composer, i.InvoiceDate, il.Quantity FROM Track t, InvoiceLine il, Invoice i WHERE i.CustomerId = :CustomerId AND il.InvoiceId = i.InvoiceId AND t.TrackId = il.TrackId AND i.InvoiceDate BETWEEN :FechaDesde AND :FechaHasta ORDER BY il.Quantity DESC");
            $stmt->bindParam(":CustomerId", $customerid);
            $stmt->bindParam(":FechaDesde", $fechadesde);
            $stmt->bindParam(":FechaHasta", $fechahasta);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            $conn = null;
            return $result;
        } catch (PDOException $e) {
            if ($conn) {
                $conn = null;
            }
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }
?>

<?php
    /**
     * Obtiene la lista de pistas descargadas por un cliente en un rango de fechas.
     *
     * @param string $fechadesde Fecha de inicio del rango en formato 'YYYY-MM-DD'.
     * @param string $fechahasta Fecha de fin del rango en formato 'YYYY-MM-DD'.
     * @return array|null Retorna un array asociativo con los datos de las pistas descargadas o null en caso de error.
     */
    /*function getDownloadDate($fechadesde, $fechahasta) {
        try {
            // Importa el modelo para obtener el ID del cliente
            require_once("../models/getCustomerId_model.php");

            // Obtiene el ID del cliente
            $customerid = getCustomerId();

            // Establece la conexión con la base de datos
            $conn = conectar();

            // Prepara la consulta SQL para obtener la lista de pistas descargadas por el cliente en el rango de fechas
            $stmt = $conn->prepare("SELECT 
                                        t.Name, 
                                        IFNULL(t.Composer, 'N/A') AS Composer, 
                                        i.InvoiceDate, 
                                        il.Quantity 
                                    FROM Track t, InvoiceLine il, Invoice i 
                                    WHERE i.CustomerId = :CustomerId 
                                        AND il.InvoiceId = i.InvoiceId 
                                        AND t.TrackId = il.TrackId 
                                        AND i.InvoiceDate BETWEEN :FechaDesde AND :FechaHasta 
                                    ORDER BY il.Quantity DESC");

            // Asigna los valores a los parámetros de la consulta
            $stmt->bindParam(":CustomerId", $customerid);
            $stmt->bindParam(":FechaDesde", $fechadesde);
            $stmt->bindParam(":FechaHasta", $fechahasta);

            // Ejecuta la consulta
            $stmt->execute();

            // Establece el modo de obtención de resultados como un array asociativo
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            // Obtiene todos los resultados
            $result = $stmt->fetchAll();

            // Cierra la conexión con la base de datos
            $conn = null;

            // Retorna el resultado obtenido
            return $result;
        } catch (PDOException $e) {
            // En caso de error, cierra la conexión si está abierta
            if ($conn) {
                $conn = null;
            }

            // Llama a una función personalizada para manejar el error
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());

            // Retorna null en caso de error
            return null;
        }
    }
?>
