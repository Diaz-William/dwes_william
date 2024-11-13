<?php
    function error_function($error_level, $error_message, $error_file, $error_line, $table = null){
        echo "<hr>";
        if (!empty($table)) {
            if ($error_level == '23000' && strpos($error_message, '1062 Duplicate entry') !== false) {
                switch ($table) {
                    case 'emple':
                        echo "Error: Ya existe un empleado con el dni introducido en la tabla $table.";
                        break;
                    default:
                        # code...
                        break;
                }
            }
        } else {
            echo "Código de error: " . htmlspecialchars($error_level) . "<br>";
            echo "Mensaje de error: " . htmlspecialchars($error_message) . "<br>";
            echo "Archivo: " . htmlspecialchars($error_file) . "<br>";
            echo "Línea: " . htmlspecialchars($error_line) . "<br>";
        }
        echo "<hr>";
    }