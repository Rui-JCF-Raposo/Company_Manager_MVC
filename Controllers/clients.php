<?php 


if(isset($_GET["page"])) {
        if($_GET["page"] === "clients") {
            $clients  = $CompanyManager->getClients();
            require("Views/pages/clients.php");
        }
    }

    if(isset($_GET["action"])) {
        
        if($_GET["action"] === "contact") {
            if(isset($_GET["clientId"]) && is_numeric($_GET["clientId"])) {
                $person = $CompanyManager->getClient($_GET["clientId"]);
            } 
            require("Views/pages/contact-person.php");
        }

        if($_GET["action"] === "createClient") {
            if(isset($_POST["send"])) {
                $clients = $CompanyManager->getClients();
                $CompanyManager->createClient($clients, $_POST, $_FILES);
                header("Location: ./?controller=clients&page=clients");
            }
        } 
            
    }