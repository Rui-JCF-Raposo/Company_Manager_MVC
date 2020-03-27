<?php 
    class People {
        
        private $db;
        private $companyId;

        public function __construct($companyId) {
            $this->db = new PDO("mysql:host=localhost;dbname=Company_Manager;charset=utf8mb4", "root". ""); 
            $this->companyId = $companyId;
        }

        public function getClients() {
            $clientsQuery = $this->db->prepare("
                SELECT 
                client_id, first_name AS firstName, last_name as lastName, picture,
                email, country, city
                FROM 
                    clients
                WHERE 
                    company_id = ?
            ");
            $clientsQuery->execute([$this->companyId]);
            $clients = $clientsQuery->fetchAll(PDO::FETCH_ASSOC);
            return $clients;
        }

        public function getEmployees() {
            $employeesQuery = $this->db->prepare("
                SELECT 
                    e.employee_id, e.first_name AS firstName, e.last_name AS lastName, e.picture, 
                    e.email, e.salary, d.name AS department, r.name AS role
                FROM 
                    employees AS e
                INNER JOIN 
                    departments AS d USING(department_id)
                INNER JOIN 
                    roles AS r USING(department_id)
                WHERE
                    e.company_id = ?
            ");
            $employeesQuery->execute([$this->companyId]);
            $employees = $employeesQuery->fetchAll(PDO::FETCH_ASSOC);
            return $employees;
        }

        public function getClient($clientId) {
            if(!empty($clientId) && is_numeric($clientId)) {
                $clientQuery = $this->db->prepare("
                    SELECT client_id AS person_id, CONCAT(first_name, ' ', last_name) AS name, picture
                    FROM clients
                    WHERE client_id = ?
                ");
                $clientQuery->execute([$clientId]);
                $client = $clientQuery->fetch(PDO::FETCH_ASSOC);
                return $client;
            }
        }

        public function getEmployee($employeeId) {
            if(!empty($employeeId) && is_numeric($employeeId)) {
                $employeeQuery = $this->db->prepare("
                    SELECT employee_id AS person_id, CONCAT(first_name, ' ', last_name) AS name, picture
                    FROM employees
                    WHERE employee_id = ?
                ");
                $employeeQuery->execute([$employeeId]);
                $employee= $employeeQuery->fetch(PDO::FETCH_ASSOC);
                return $employee;
            }
        }
    }