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


        /*-----------------------Control Pages------------------------------*/
        /*------------------------------------------------------------------*/
        if(isset($_GET["page"]) &&  in_array($_GET["page"], $allowedPages)) {
            if($_GET["page"] === "home") {
                $company = $companyModel->getCompanyInfo();
                $departments = $companyModel->getDepartments();
                $companyServices = $companyModel->getCompanyServices();
                $roles = $companyModel->getRoles();
                require("Views/pages/home.php");
            } else if($_GET["page"] === "services") {
                $clients = $peopleModel->getClients();
                $employees = $peopleModel->getEmployees();
                $departments = $companyModel->getDepartments();
                $companyServices = $companyModel->getCompanyServices();
                $servicesHistory = $companyModel->getServicesHistory();
                require("Views/pages/services.php");
            }
        }

        /*-----------------------Control Actions----------------------------*/
        /*------------------------------------------------------------------*/
        if(isset($_GET["action"]) && in_array($_GET["action"], $allowedActions)) {

            if($_GET["action"] === "createDepartment") {   
                if(isset($_POST["send"])) {
                    $departments = $companyModel->getDepartments();
                    $response = $createModel->cretaeDepartment($departments, $_POST);
                    if($response) {
                        header("Location: ?controller=company&page=home");
                    }
                }
            } else if($_GET["action"] === "createCompanyService") {
                if(isset($_POST["send"])) {
                    $companyServices = $companyModel->getCompanyServices();
                    $response = $createModel->createCompanyService($companyServices, $_POST);
                    if($response) {
                        header("Location: ?controller=company&page=home");
                    }
                }
            } else if($_GET["action"] === "createRole") {
                if(isset($_POST["send"])) {
                    $roles = $companyModel->getRoles();
                    $response = $createModel->createRole($roles, $_POST);
                    if($response) {
                        header("Location: ?controller=company&page=home");
                    }
                }
            } else if($_GET["action"] === "createService") {
                if(isset($_POST["send"])) {
                    $response = $createModel->createService($_POST);
                    if($response) {
                        header("Location: ?controller=company&page=services");
                    }
                }
            }
        }

    }
    
    