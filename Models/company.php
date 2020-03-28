<?php 

    class Company {
        
        private $db;
        private $companyId;

        public function __construct($companyId) {
            $this->companyId = $companyId;
            $this->db = new PDO("mysql:host=localhost;dbname=Company_Manager;charset=utf8mb4", "root". "");
        }

        public function getCompanyInfo() {
            $query = $this->db->prepare("
                SELECT name
                FROM company
                WHERE company_id = ?
            ");
            $query->execute([$this->companyId]);
            $company = $query->fetch(PDO::FETCH_ASSOC);
            return $company;
        }

        public function getDepartments() {
            $departmentsQuery = $this->db->prepare("
                SELECT department_id, name
                FROM departments
                WHERE company_id = ?
            ");
            $departmentsQuery->execute([$this->companyId]);
            $departments = $departmentsQuery->fetchAll(PDO::FETCH_ASSOC);
            return $departments;
        }

        public function getCompanyServices() {
            $companyServicesQuery = $this->db->prepare("
                SELECT company_service_id, name
                FROM company_services
                WHERE company_id = ?
            ");
            $companyServicesQuery->execute([$this->companyId]);
            $companyServices = $companyServicesQuery->fetchAll(PDO::FETCH_ASSOC);
            return $companyServices;
        }

        public function getRoles() {
            $rolesQuery = $this->db->prepare("
                SELECT role_id, name, department_id
                FROM roles
                WHERE company_id = ?
            ");
            $rolesQuery->execute([$this->companyId]);
            $roles = $rolesQuery->fetchAll(PDO::FETCH_ASSOC);
            return $roles;
        }

        public function getServicesHistory() {
            $servicesHistoryQuery = $this->db->prepare("
                SELECT 
                    cs.name, 
                    sh.price,
                    CONCAT(c.first_name, ' ', c.last_name) AS clientName, 
                    CONCAT(e.first_name, ' ', e.last_name) AS employeeName, 
                    sh.add_date AS addDate
                FROM 
                    services_history AS sh
                INNER JOIN
                    company_services AS cs USING(company_service_id)
                INNER JOIN 
                    clients AS c USING(client_id)
                INNER JOIN 
                    employees AS e USING(employee_id)
                WHERE 
                    sh.company_id = ?
                ORDER BY addDate DESC
            ");
            $servicesHistoryQuery ->execute([$_SESSION["company_id"]]);
            $servicesHistory = $servicesHistoryQuery ->fetchAll(PDO::FETCH_ASSOC);
            return $servicesHistory;
        }
    }