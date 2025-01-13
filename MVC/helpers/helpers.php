<?php
    // Función para sanitizar entradas de usuario
    function test_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    // Función para manejar errores
    function error_function($error_level, $error_message, $error_file, $error_line) {
        echo "<hr>";
        echo "Código de error: $error_level <br>";
        echo "Mensaje de error: $error_message <br>";
        echo "Archivo: $error_file <br>";
        echo "Línea: $error_line <br>";
        echo "<hr>";
    }
?>