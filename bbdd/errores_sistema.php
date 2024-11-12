<?php
    function error_function($error_level, $error_message, $error_file, $error_line, $custom_error_message = null){
        echo "<hr>";
        if (!is_null($custom_error_message)) {
            echo "<p>$custom_error_message</p>";
        }else {
            echo "Código de error: $error_level <br>";
            echo "Mensaje de error: $error_message <br>";
            echo "Archivo: $error_file <br>";
            echo "Línea: $error_line <br>";
        }
        echo "<hr>";
    }