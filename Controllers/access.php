<?php
    require("Models/access.php");
    $access = new Access();

    if(isset($_GET["action"])) {
        if($_GET["action"] === "login") {
            $access->login($_POST);
        } else if($_GET["action"] === "logout") {
            $access->logout();
        } else if($_GET["action"] === "register") {
            $access->register($_POST);
        } 
    } else {
        require("Views/pages/access.php");
    }
    