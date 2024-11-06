<?php
    function realizarConexion($dbname,$servername,$username,$password) {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Conexión fallida: " . $e->getMessage();
        }

        return $conn;
    }
    function insertarDepartamneto($conn, $nombre) {
        try {
            $cod_dpto = obtenerPKDpto($conn);
            $stmt = $conn->prepare("INSERT INTO dpto (cod_dpto,nombre) VALUES ($cod_dpto,$nombre)");
            // insert a row
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function obtenerPKDpto($conn) {
        try {
            $stmt = $conn->prepare("SELECT count(cod_dpto) AS 'total' FROM dpto");
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $stmt->fetchAll();
            $siguiente = $resultado["total"] + 1;
            $pk = "D";
            $num = strlen($siguiente);
            $pk = str_pad($pk, (3 - $num), "0" , STR_PAD_RIGHT) . $siguiente;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return $pk;
    }