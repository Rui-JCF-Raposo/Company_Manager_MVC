<?php
    session_start();
    if(isset($_SESSION["company_id"])) {
        
        require("Models/company.php");
        require("Models/people.php");
        require("Models/create.php");

        $allowedPages = ["home", "services"];
        $allowedActions = ["createDepartment", "createCompanyService", "createRole", "createService"];
        
        $companyModel = new Company($_SESSION["company_id"]);
        $peopleModel = new People($_SESSION["company_id"]);
        $createModel = new Create($_SESSION["company_id"]);


        if(isset($_GET["page"]) &&  in_array($_GET["page"], $allowedPages)) {
            if($_GET["page"] === "home") {
                $company = $companyModel->getCompanyInfo();
                $departments = $companyModel->getDepartments();
                $companyServices = $companyModel->getServices();
                $roles = $companyModel->getRoles();
                require("Views/pages/home.php");
            } else if($_GET["page"] === "services") {
                $clients = $peopleModel->getClients();
                $employees = $peopleModel->getEmployees();
                $companyServices = $companyModel->getServices();
                require("Views/pages/services.php");
            }
        }

        if(isset($_GET["action"]) && in_array($_GET["action"], $allowedActions)) {
            if($_GET["action"] === "createDepartment") {   
                $departments = $companyModel->getDepartments();
                $createModel->cretaeDepartment($departments, $_POST);
            } else if($_GET["action"] === "createCompanyService") {
                $companyServices = $companyModel->getServices();
                $createModel->createCompanyService($companyServices, $_POST);
            } else if($_GET["action"] === "createRole") {
                $roles = $companyModel->getRoles();
                $createModel->createRole($roles, $_POST);
            } else if($_GET["action"] === "createService") {
                echo "Create Service in History Worked";
            }
        }

    }
    
    