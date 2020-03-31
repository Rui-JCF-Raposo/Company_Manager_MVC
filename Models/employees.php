<?php
    require("roles.php");
    class Employees extends Roles {

        public function getEmployees() {
            $employeesQuery = $this->db->prepare("
                SELECT 
                    e.employee_id, e.first_name AS firstName, e.last_name AS lastName, e.picture, 
                    e.email, e.phone, e.salary, e.department_name AS department, e.role_name AS role
                FROM 
                    employees AS e
                WHERE
                    e.company_id = ?
                GROUP BY e.employee_id
            ");
            $employeesQuery->execute([$this->companyId]);
            $employees = $employeesQuery->fetchAll(PDO::FETCH_ASSOC);
            return $employees;
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

        public function createEmployee($employees, $postData, $postFile) {
         
            foreach($postData as $key => $value) {
                $postData[$key] = strip_tags($value);
            }

            if(
                !empty($postData["firstName"]) &&
                !empty($postData["lastName"]) &&
                !empty($postData["email"]) &&
                !empty($postData["country"]) &&
                !empty($postData["city"]) &&
                !empty($postData["street"]) &&
                checkdate($postData["birth_month"], $postData["birth_day"], $postData["birth_year"]) &&
                !empty($postData["department"]) &&
                !empty($postData["role"]) &&
                !empty($postData["salary"]) &&
                filter_var($postData["email"], FILTER_VALIDATE_EMAIL) 
            ) {

                //Check if employee already exists
                foreach($employees as $employee) {
                    if(
                        strtolower($postData["firstName"]) === strtolower($employee["firstName"]) &&
                        strtolower($postData["lastName"]) === strtolower($employee["lastName"]) &&
                        strtolower($postData["email"]) === strtolower($employee["email"])
                        ) {
                            return false;
                        }
                    }  
                
                $employeePicture = $this->genaratePicture($postFile);

                $query = $this->db->prepare("
                    INSERT INTO employees
                    (first_name, last_name, birth_date, email, phone, department_name, salary, country, city, street, picture, role_name, company_id)
                    VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)
                ");
                $query->execute([
                    $postData["firstName"],
                    $postData["lastName"],
                    $postData["birth_year"]."-".$postData["birth_month"]."-".$postData["birth_day"],
                    $postData["email"],
                    $postData["phone"],
                    $postData["department"],
                    $postData["salary"],
                    $postData["country"],
                    $postData["city"],
                    $postData["street"],
                    $employeePicture,
                    $postData["role"],
                    $this->companyId
                ]);
                return true;
            } else {
                return false;
            }
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

    }