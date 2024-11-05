<?php
/*Inserción en tabla - mysql PDO*/

$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "empleadosmn";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO dpto (cod_dpto, nombre) VALUES ('D003', 'VENTAS')";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>