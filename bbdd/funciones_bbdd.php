<?php
    function realizarConexion($dbname,$servername,$username,$password) {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $conn;
    }
    function insertarDepartamneto($conn, $nombre) {
        try {
            //code...
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function obtenerPKEmple($conn) {
        try {
            $stmt = $conn->prepare("SELECT count(cod_dpto) AS 'total' FROM dpto");
            $stmt->execute();

            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $stmt->fetchAll();
            $siguiente = $resultado["total"] + 1;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return $siguiente;
    }