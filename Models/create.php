<?php 

    class Create {
        
        private $db;
        private $companyId;

        public function __construct($companyId) {
            $this->companyId = $companyId;
            $this->db = new PDO("mysql:host=localhost;dbname=Company_Manager;charset=utf8mb4", "root". "");
        }

        public function genaratePicture($file) {
            if(
                $file["picture"]["type"] === "image/jpeg" ||
                $file["picture"]["type"] === "image/png" 
            ) {
                //Genarete hash for picture name
                if($file["picture"]["type"] === "image/jpeg"){
                    $genaratePicName = substr(sha1(mt_rand(100000000000000, 999999999999999)), 1, 20).".jpg";  
                } else if($file["picture"]["type"] === "image/png") {
                    $genaratePicName = substr(sha1(mt_rand(1000000000000, 9999999999999)), 1, 30).".png";
                }
                //-------------------------------
                //saving image in uploads folder
                $tmpFile = $file['picture']['tmp_name'];
                $newFile = "../assets/imgs/uploads/profilePictures/".$genaratePicName."";
                move_uploaded_file($tmpFile, $newFile);
                //---------------------------------------
                return $genaratePicName;
            } else {
                return "profile-pic-default.png";
            } // end profile picture logic -------------------------------------------------
        }

        public function createClient($clients, $postData, $postFile) { 
        
            foreach($postData as $key => $value) {
                $postData[$key] = strip_tags(trim($value));
            }

            if(
                !empty($postData["firstName"]) &&
                !empty($postData["lastName"]) &&
                !empty($postData["email"]) &&
                !empty($postData["country"]) &&
                !empty($postData["city"]) &&
                !empty($postData["street"]) &&
                checkdate($postData["birth_month"], $postData["birth_day"], $postData["birth_year"]) &&
                filter_var($postData["email"], FILTER_VALIDATE_EMAIL) 
            ) {

                //Check if client already exists
                foreach($clients as $client) {
                    if(
                        strtolower($postData["firstName"]) === strtolower($client["firstName"]) &&
                        strtolower($postData["lastName"]) === strtolower($client["lastName"]) &&
                        strtolower($postData["email"]) === strtolower($client["email"])
                    ) {
                        return false;
                    }
                }   

                $clientPicture = $this->genaratePicture($postFile);
                $query = $this->db->prepare("
                INSERT INTO clients
                (first_name, last_name, birth_date, email, phone, country, city, street, picture, company_id)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ");
                $query->execute([
                    $postData["firstName"],
                    $postData["lastName"],
                    $postData["birth_year"]."-".$postData["birth_month"]."-".$postData["birth_day"],
                    $postData["email"],
                    $postData["phone"],
                    $postData["country"],
                    $postData["city"],
                    $postData["street"],
                    $clientPicture,
                    $this->companyId
                ]);
                return true;
            } else {
                return false;
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

        public function createCompanyService($companyServices, $postData) {
            if(!empty($postData["service"]) && !empty($postData["s-department-name"])) {
                $serviceName = strip_tags($postData["service"]);
                $departmentName = strip_tags($postData["s-department-name"]);
                //Check if service already exist
                if($companyServices) {
                    foreach($companyServices as $service) {
                        if(strtolower($service["name"]) === strtolower($serviceName)) {
                            echo "service-repeat";
                            return false;
                        }
                    }
                }

                $query = $this->db->prepare("
                    INSERT INTO company_services
                    (name, department_name, company_id)
                    VALUES(?, ?, ?)
                ");
                $query->execute([
                    $serviceName,
                    $departmentName,
                    $this->companyId
                ]);
                return true;
            } else {
                return false;
            }
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

        public function createService($postData) {

            foreach($postData as $key => $value) {
                $postData[$key] = strip_tags(trim($value));
            }
            if(
                !empty($postData["client-name"]) &&
                !empty($postData["employee-name"])  &&
                !empty($postData["service-name"]) &&
                !empty($postData["department-name"]) &&
                (is_numeric($postData["service-price"]) && $postData["service-price"] > 0) 
            ) {

                /*-----------------------Add Service To DB-------------------------------*/
                $query = $this->db->prepare("
                INSERT INTO services_history
                (company_service_name, client_name, employee_name, department_name, price, add_date, company_id)
                VALUES(?, ?, ?, ?, ?, NOW(), ?)
                ");

                $query->execute([
                    $postData["service-name"],
                    $postData["client-name"],
                    $postData["employee-name"],
                    $postData["department-name"],
                    $postData["service-price"],
                    $this->companyId
                ]);
                    
                echo "All validations worked"; 
                return true;
        

            } else {
                return false;
            }
            
        }

    }