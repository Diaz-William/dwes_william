<?php
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("../helpers/cookie_helper.php");
    cerrarSesionCookie();
?>