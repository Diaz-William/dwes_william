<!DOCTYPE html>
  <html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="author" content="William Diaz">
    <title>media7.php</title>
  </head>
  <body>
    <?php
      // Incluir el archivo de funciones.
      include 'media7func.php';
      // Incluir el archivo de manejo de errores.
      include 'errores.php';
      // Establecer la función "error_function" para el manejo de errores.
      set_error_handler("error_function");

      // Comprobar si se han enviado los datos del formulario por el método POST.
      if ($_SERVER["REQUEST_METHOD"] == "POST") {}
    ?>
  </body>
</html>