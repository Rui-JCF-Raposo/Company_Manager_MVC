<?php   

    if(isset($_GET["page"])) {
        if($_GET["page"] === "services") {
            $clients = $CompanyManager->getClients();
            $employees = $CompanyManager->getEmployees();
            $departments = $CompanyManager->getDepartments();
            $companyServices = $CompanyManager->getCompanyServices();
            $servicesHistory = $CompanyManager->getServicesHistory();
            require("Views/pages/services.php");
        }
    }

    if(isset($_GET["action"])) {
        if($_GET["action"] === "createService") {
            if(isset($_POST["send"])) {
                $response = $CompanyManager->createService($_POST);
                if($response) {
                    header("Location: ?controller=services&page=services");
                }
            }
        }
    }
