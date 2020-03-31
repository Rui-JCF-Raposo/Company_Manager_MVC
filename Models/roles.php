<?php 
require("services.php");
    class Roles extends Services {

        public function getRoles() {
            $rolesQuery = $this->db->prepare("
                SELECT role_id, name, department_name
                FROM roles
                WHERE company_id = ?
            ");
            $rolesQuery->execute([$this->companyId]);
            $roles = $rolesQuery->fetchAll(PDO::FETCH_ASSOC);
            return $roles;
        }
        
        public function createRole($roles, $postData) {
            if(!empty($postData["role"]) && !empty($postData["department_name"])) {
                $roleName = strip_tags($postData["role"]);
                $departmentName = strip_tags($postData["department_name"]);
                //Check if role already exist
                if($roles) {
                    foreach($roles as $role) {
                        if(strtolower($role["name"]) === strtolower($roleName)) { 
                            echo "role-repeat";  
                            return false;
                        }
                    }
                }
                $query = $this->db->prepare("
                    INSERT INTO roles
                    (name, department_name, company_id)
                    VALUES(?, ?, ?)
                ");
                $query->execute([
                    $roleName,
                    $departmentName,
                    $this->companyId
                ]);
                return true;
            } else {
                return false;
            }
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
    }