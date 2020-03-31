<?php 


    if(isset($_GET["page"])) {
        if($_GET["page"] === "home") {
            $company = $CompanyManager->getCompanyInfo();
            $departments = $CompanyManager->getDepartments();
            $companyServices = $CompanyManager->getCompanyServices();
            $roles = $CompanyManager->getRoles();
            require("Views/pages/home.php");
        } 
    }

    if(isset($_GET["action"])) {

        // ----------------------Create--------------------------------------

        if($_GET["action"] === "createDepartment") {   
            if(isset($_POST["send"])) {
                $CompanyManager->getDepartments();
                $response = $CompanyManager->cretaeDepartment($departments, $_POST);
                if($response) {
                    header("Location: ?controller=home&page=home");
                }
            }
        } else if($_GET["action"] === "createCompanyService") {
            if(isset($_POST["send"])) {
                $companyServices = $CompanyManager->getCompanyServices();
                $response = $CompanyManager->createCompanyService($companyServices, $_POST);
                if($response) {
                    header("Location: ?controller=home&page=home");
                }
            }
        } else if($_GET["action"] === "createRole") {
            if(isset($_POST["send"])) {
                $roles = $CompanyManager->getRoles();
                $response = $CompanyManager->createRole($roles, $_POST);
                if($response) {
                    header("Location: ?controller=home&page=home");
                }
            }
        } 
    }