<?php
//--------------------------------------------------------------------------
    // Función personalizada para manejar errores.
    function error_function($error_level, $error_message, $error_file, $error_line) {
        echo "<hr>";
        echo "Código de error: $error_level <br>";
        echo "Mensaje de error: $error_message <br>";
        echo "Archivo: $error_file <br>";
        echo "Línea: $error_line <br>";
        echo "<hr>";
    }
//--------------------------------------------------------------------------
    function error_function_bbdd($error_level, $error_message, $error_file, $error_line, $table = null){
        echo "<hr>";
        if (!empty($table)) {
            if ($error_level == '23000' && strpos($error_message, '1062 Duplicate entry') !== false) {
                switch ($table) {
                    case 'cliente':
                        echo "Error: Ya existe un cliente con el nif introducido.";
                        break;
                }
            }
        } else {
            echo "Código de error: $error_level <br>";
            echo "Mensaje de error: $error_message <br>";
            echo "Archivo: $error_file <br>";
            echo "Línea: $error_line <br>";
        }
        echo "<hr>";
    }
//--------------------------------------------------------------------------