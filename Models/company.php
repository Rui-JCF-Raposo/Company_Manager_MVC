<?php 
    class Company {
        private $db;
        private $companyId;

        public function __construct($companyId) {
            $this->db = new PDO("mysql:host=localhost;dbname=Company_Manager;charset=utf8mb4", "root". ""); 
            $this->companyId = $companyId;
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

        public function getServices() {
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
                SELECT service_id, name
                FROM services_history
                WHERE company_id = ?
            ");
            $servicesHistoryQuery ->execute([$_SESSION["company_id"]]);
            $servicesHistory = $servicesHistoryQuery ->fetchAll(PDO::FETCH_ASSOC);
            return $servicesHistory;
        }
    }