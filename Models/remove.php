<?php 
    class Remove {
        private $db;
        private $companyId;

        public function __construct($companyId) {
            $this->companyId = $companyId;
            $this->db = new PDO("mysql:host=localhost;dbname=Company_Manager;charset=utf8mb4", "root". "");
        }

        public function removeClient($clientId) {
            $clientId = (int)strip_tags($clientId);
            if(is_numeric($clientId) && !empty($clientId)) {
                $query = $this->db->prepare("DELETE FROM clients WHERE client_id = ?");
                $query->execute([$clientId]);
                return true;
            }
            return false;
        }

        public function removeEmployee($employeeId) {
            $employeeId = (int)strip_tags($employeeId);
            if(is_numeric($employeeId) && !empty($employeeId)) {
                $query = $this->db->prepare("DELETE FROM employees WHERE employee_id = ?");
                $query->execute([$employeeId]);
                return true;
            }
            return false;
        }

        public function removeDepartment($departmentId) {
            $departmentId = (int)strip_tags($departmentId);
            if(is_numeric($departmentId) && !empty($departmentId)) {
                $query = $this->db->prepare("DELETE FROM departments WHERE department_id = ?");
                $query->execute([$departmentId]);
                return true;
            }
            return false;
        }

        public function removeCompanyService($companyServiceId) {
            $companyServiceId = (int)strip_tags($companyServiceId);
            if(is_numeric($companyServiceId) && !empty($companyServiceId)) {
                $query = $this->db->prepare("DELETE FROM company_services WHERE company_service_id = ?");
                $query->execute([$companyServiceId]);
                return true;
            }
            return false;
        }

        public function removeRole($roleId) {
            $roleId = (int)strip_tags($roleId);
            if(is_numeric($roleId) && !empty($roleId)) {
                $query = $this->db->prepare("DELETE FROM roles WHERE role_id = ?");
                $query->execute([$roleId]);
                return true;
            }
            return false;
        }

        public function removeServiceFromHistory($serviceId) {
            echo "works";
            $serviceId = (int)strip_tags($serviceId);
            if(is_numeric($serviceId) && !empty($serviceId)) {
                $query = $this->db->prepare("DELETE FROM services_history WHERE service_id = ?");
                $query->execute([$serviceId]);
                return true;
            }
            return false;
        }
    }