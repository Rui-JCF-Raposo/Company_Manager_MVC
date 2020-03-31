<?php 


    if(isset($_GET["page"])) {
        if($_GET["page"] === "employees") {
            $departments = $CompanyManager->getDepartments();
            $roles = $CompanyManager->getRoles();
            $employees = $CompanyManager->getEmployees();
            require("Views/pages/employees.php");
        }
    }

    if(isset($_GET["action"])) {
        
        if($_GET["action"] === "contact") {
            if(isset($_GET["employeeId"]) && is_numeric($_GET["employeeId"])) {
                $person = $CompanyManager->getEmployee($_GET["employeeId"]);
            } 
            require("Views/pages/contact-person.php");
        }

        if($_GET["action"] === "createEmployee") {
            if(isset($_POST["send"])) {
                $employees = $CompanyManager->getEmployees();
                $CompanyManager->createEmployee($employees, $_POST, $_FILES);
                header("Location: ./?controller=employees&page=employees");
            }
        }
            
    }