<?php
    function error_function($error_level, $error_message, $error_file, $error_line, $custom_error_message = null){
        echo "<hr>";
        if (empty($custom_error_message)) {
            echo "<p>" . htmlspecialchars($custom_error_message) . "</p>";
        } else {
            echo "Código de error: " . htmlspecialchars($error_level) . "<br>";
            echo "Mensaje de error: " . htmlspecialchars($error_message) . "<br>";
            echo "Archivo: " . htmlspecialchars($error_file) . "<br>";
            echo "Línea: " . htmlspecialchars($error_line) . "<br>";
        }
        echo "<hr>";
    }