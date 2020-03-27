<?php
    session_start();
    if(isset($_SESSION["company_id"])) {
        
        require("../Models/people.php");
        $peopleModel = new People($_SESSION["company_id"]);
    
        //------------- Requests Coming From JavaScript--------
        //-----------------------------------------------------
    
        if(isset($_GET["type"])) {
            if($_GET["type"] === "clients") {
                $clients = $peopleModel->getClients();
                echo json_encode($clients);
            } else if($_GET["type"] === "employees") {
                $employees = $peopleModel->getEmployees();
                echo json_encode($employees);
            }
        }
    }