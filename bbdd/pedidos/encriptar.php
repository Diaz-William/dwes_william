<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>Encriptar</title>
    </head>
    <body>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="submit" name="encriptar" id="encriptar" value="Encriptar">
        </form>
        <?php
            // Incluir el archivo de funciones.
            include "funciones.php";
            // Incluir el archivo de manejo de errores.
            include "errores.php";
            // Establecer la función "error_function" para el manejo de errores.
            set_error_handler("error_function");

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                function encriptar() {
                    try {
                        $conn = realizarConexion("pedidos", "localhost", "root", "rootroot");
                        $stmt = $conn->prepare("SELECT customerNumber, contactLastName FROM customers");
                        $stmt->execute();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $resultado = $stmt->fetchAll();
                        empezarTransaccion($conn);
                        foreach ($resultado as $row) {
                            $stmt = $conn->prepare("UPDATE customers SET hashPassword = :hashPassword WHERE customerNumber = :customerNumber");
                            $hashPassword = password_hash($row["contactLastName"], PASSWORD_DEFAULT);
                            $stmt->bindParam(':hashPassword', $hashPassword);
                            $customerNumber = $row["customerNumber"];
                            $stmt->bindParam(':customerNumber', $customerNumber);
                            $stmt->execute();
                        }
                        validar($conn);
                        echo "<p>¡ENCRIPTADO!</p>";
                    } catch (PDOException $e) {
                        deshacer($conn);
                        cerrarConexion($conn);
                        error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
                    }
                }
                encriptar();
            }
        ?>
    </body>
</html>