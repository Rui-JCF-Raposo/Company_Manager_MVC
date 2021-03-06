<?php
    session_start();
    require("../Models/CompanyManager.php");
    $CompanyManager = new CompanyManager($_SESSION["company_id"]);

    //------------- Requests Coming From JavaScript--------
    //-----------------------------------------------------

    // Get Info ---------------------------------------
    if(isset($_GET["type"])) {
        if($_GET["type"] === "clients") {
            $clients = $CompanyManager->getClients();
            echo json_encode($clients);
        } else if($_GET["type"] === "employees") {
            $employees = $CompanyManager->getEmployees();
            echo json_encode($employees);
        }
    }

    // Get Info By Filter ------------------------------

    if(isset($_GET["type"]) && $_GET["type"] === "search") {
        if(isset($_GET["clientName"])) {
            
            if(!empty($_GET["clientName"])) {
                $clients = $CompanyManager->getClientByName($_GET["clientName"]);
            } else {
                $clients = $CompanyManager->getClients();
            }
            echo json_encode($clients);

        } else if(isset($_GET["employeeName"])) {
            
            if(!empty($_GET["employeeName"])) {
                $employees = $CompanyManager->getEmployeeByName($_GET["employeeName"]);
            } else {
                $employees = $CompanyManager->getEmployees();
            }
            echo json_encode($employees);
        }

        if(isset($_GET["clientFilters"]) && $_GET["clientFilters"] === "true") {
            if(empty($_GET["country"]) && empty($_GET["city"])) {
                $clients = $CompanyManager->getClients();
            } else if(!empty($_GET["country"]) !== "" && empty($_GET["city"])) {
                $clients = $CompanyManager->getClientByCountry($_GET["country"]);
            } else if(!empty($_GET["city"]) && empty($_GET["country"])) {
                $clients = $CompanyManager->getClientByCity($_GET["city"]);
            } else if(!empty($_GET["country"]) && !empty($_GET["city"])) {
                $clients = $CompanyManager->getClientByCountryAndCity($_GET["country"], $_GET["city"]);
            }
            echo json_encode($clients);
        }
    }
    
    // Remove Info --------------------------------------
    if(isset($_GET["remove"])) {
        if($_GET["remove"] === "department") {
            if($_GET["departmentId"]) {
                $CompanyManager->removeDepartment($_GET["departmentId"]);
            }
        }
        if($_GET["remove"] === "companyService") {
            if($_GET["companyServiceId"]) {
                $CompanyManager->removeCompanyService($_GET["companyServiceId"]);
            }
        }
        if($_GET["remove"] === "role") {
            if($_GET["roleId"]) {
                $CompanyManager->removeRole($_GET["roleId"]);
            }
        }
        if($_GET["remove"] === "serviceFromHistory") {
            if($_GET["serviceId"]) {
                $CompanyManager->removeServiceFromHistory($_GET["serviceId"]);
            }
        }
        if($_GET["remove"] === "client") {
            if($_GET["clientId"]) {
                $CompanyManager->removeClient($_GET["clientId"]);
            }
        }
        if($_GET["remove"] === "employee") {
            if($_GET["employeeId"]) {
                $CompanyManager->removeemployee($_GET["employeeId"]);
            }
        }
    }
