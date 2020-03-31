<?php 
require("company.php");
    class Departments extends Company {

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

        public function cretaeDepartment($departments, $postData) {
            //Check if department already exist
            if(!empty($postData["department"])){
                $departmentName = strip_tags($postData["department"]);
                if($departments) {
                    foreach($departments as $department) {
                        if(strtolower($department["name"]) === strtolower($departmentName)) {
                            echo "department-repeat";
                            return false;
                        }
                    }
                }
                $query = $this->db->prepare("
                    INSERT INTO departments
                    (name, company_id)
                    VALUES(?, ?)
                ");
                $query->execute([
                    $departmentName,
                    $this->companyId
                ]);
                return true;
            } else {
                return false;
            }
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
    }