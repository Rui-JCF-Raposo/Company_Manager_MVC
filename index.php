<?php 
    session_start();
    if(isset($_SESSION["company_id"])) {
        require("Models/CompanyManager.php");
        $CompanyManager = new CompanyManager($_SESSION["company_id"]);
    }
    // session_start();
    // session_destroy();
    $controller = "access";
    $controllers = ["access", "home", "clients", "employees", "services"];
    if(isset($_GET["controller"]) && in_array($_GET["controller"], $controllers)) {
        $controller = $_GET["controller"];
    }
    require("Controllers/".$controller.".php");