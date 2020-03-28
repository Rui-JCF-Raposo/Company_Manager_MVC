<?php
    session_start();
    if(isset($_SESSION["company_id"])) {
        
        require("Models/company.php");
        require("Models/people.php");
        require("Models/create.php");
        
        $companyModel = new Company($_SESSION["company_id"]);
        $peopleModel = new People($_SESSION["company_id"]);
        $createModel = new Create($_SESSION["company_id"]);

        $allowedPages = ["clients", "employees", "contact"];
        $allowedActions = ["contact", "createEmployee", "createClient"];

        /*-----------------------Control Pages------------------------------*/
        /*------------------------------------------------------------------*/
        if(isset($_GET["page"]) && in_array($_GET["page"], $allowedPages)) {
            if($_GET["page"] === "clients") {
                $clients = $peopleModel->getClients();
                require("Views/pages/clients.php");
            } else if($_GET["page"] === "employees") {
                $departments = $companyModel->getDepartments();
                $roles = $companyModel->getRoles();
                $employees = $peopleModel->getEmployees();
                require("Views/pages/employees.php");
            }
        }


        /*-----------------------Control Actions----------------------------*/
        /*------------------------------------------------------------------*/
        if(isset($_GET["action"]) && in_array($_GET["action"], $allowedActions)) {
            
            //------------Contact Action -----------------------------
            if($_GET["action"] === "contact") {
                if(isset($_GET["clientId"]) && is_numeric($_GET["clientId"])) {
                    $person = $peopleModel->getClient($_GET["clientId"]);
                } else if(isset($_GET["employeeId"]) && is_numeric($_GET["employeeId"])) {
                    $person = $peopleModel->getEmployee($_GET["employeeId"]);
                } 
                require("Views/pages/contact-person.php");
            }

            //---------------Create Action-----------------------------
            if(isset($_GET["action"])) {
                if($_GET["action"] === "createClient") {
                    if(isset($_POST["send"])) {
                        $clients = $peopleModel->getClients();
                        $createModel->createClient($clients, $_POST, $_FILES);
                        header("Location: ./?controller=people&page=clients");
                    }
                } else if($_GET["action"] === "createEmployee") {
                    if(isset($_POST["send"])) {
                        $employees = $peopleModel->getEmployees();
                        $createModel->createEmployee($employees, $_POST, $_FILES);
                        header("Location: ./?controller=people&page=employees");
                    }
                }   
            }
        }
    }



