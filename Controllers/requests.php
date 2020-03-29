<?php
    session_start();
    if(isset($_SESSION["company_id"])) {
        
        require("../Models/people.php");
        require("../Models/remove.php");
        $peopleModel = new People($_SESSION["company_id"]);
        $removeModel = new Remove($_SESSION["company_id"]);
    
        //------------- Requests Coming From JavaScript--------
        //-----------------------------------------------------

        // Get Info ---------------------------------------
        if(isset($_GET["type"])) {
            if($_GET["type"] === "clients") {
                $clients = $peopleModel->getClients();
                echo json_encode($clients);
            } else if($_GET["type"] === "employees") {
                $employees = $peopleModel->getEmployees();
                echo json_encode($employees);
            }
        }

        // Remove Info
        if(isset($_GET["remove"])) {
            if($_GET["remove"] === "department") {
                if($_GET["departmentId"]) {
                    $removeModel->removeDepartment($_GET["departmentId"]);
                }
            }
            if($_GET["remove"] === "companyService") {
                if($_GET["companyServiceId"]) {
                    $removeModel->removeCompanyService($_GET["companyServiceId"]);
                }
            }
            if($_GET["remove"] === "role") {
                if($_GET["roleId"]) {
                    $removeModel->removeRole($_GET["roleId"]);
                }
            }
            if($_GET["remove"] === "serviceFromHistory") {
                if($_GET["serviceId"]) {
                    $removeModel->removeServiceFromHistory($_GET["serviceId"]);
                }
            }
            if($_GET["remove"] === "client") {
                if($_GET["clientId"]) {
                    $removeModel->removeClient($_GET["clientId"]);
                }
            }
            if($_GET["remove"] === "employee") {
                if($_GET["employeeId"]) {
                    $removeModel->removeemployee($_GET["employeeId"]);
                }
            }
        }
    }