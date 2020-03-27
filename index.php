<?php 
    // session_start();
    // session_destroy();
    $controller = "access";
    $controllers = ["access", "company", "people", "services"];
    if(isset($_GET["controller"]) && in_array($_GET["controller"], $controllers)) {
        $controller = $_GET["controller"];
    }
    require("Controllers/".$controller.".php");