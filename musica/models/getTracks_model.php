<?php
    function getTracks() {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT TrackId, Name, IFNULL(Composer, 'N/A') AS Composer, UnitPrice FROM Track LIMIT 15");
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