<?php
    function error_function($error_level, $error_message, $error_file, $error_line, $name_table = null){
        echo "<hr>";
        if (!empty($name_table)) {
            var_dump("dentro por tabla");
            var_dump($name_table);
            var_dump(!empty($name_table));
            if ($error_level == '23000' && strpos($error_message, '1062 Duplicate entry') !== false) {
                var_dump("dentro por clave");
                switch ($name_table) {
                    case 'emple':
                        echo "Error: Ya existe un empleado con el dni introducido en la tabla $name_table.";
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