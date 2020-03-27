<?php 
    class Create {
        
        private $db;
        private $companyId;

        public function __construct($companyId) {
            $this->db = new PDO("mysql:host=localhost;dbname=Company_Manager;charset=utf8mb4", "root", "");
            $this->companyId = $companyId;
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

        public function createClient($postData, $postFile) {
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
                filter_var($postData["email"], FILTER_VALIDATE_EMAIL) 
            ) {
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
                echo "Client Successfuly created!";
                echo "<a href='../pages/clients.php'>Go Back</a>";
            } else {
                die("Invalid Client Data");
            }
        }

        public function createEmployee($postData, $postFile) {
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
                $employeePicture = $this->genaratePicture($postFile);

                $query = $this->db->prepare("
                    INSERT INTO employees
                    (first_name, last_name, birth_date, email, phone, department_id, salary, country, city, street, picture, role_id, company_id)
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
                echo "Employee Successfuly created!";
                echo "<a href='../pages/employees.php'>Go Back</a>";
            } else {
                die("Invalid Employee Data");
            }
        }

        public function cretaeDepartment($departments, $postData) {
            if(!empty($postData["department"])){
                $departmentName = strip_tags($postData["department"]);
                if($departments) {
                    foreach($departments as $department) {
                        if(strtolower($department["name"]) === strtolower($departmentName)) {
                            echo "department-repeat";
                            return;
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
                echo "Department created";
            } else {
                die("Invalid Department Data");
            }
        } 

        public function createCompanyService($companyServices, $postData) {
            if(!empty($postData["service"])) {
                $serviceName = strip_tags($postData["service"]);
                if($companyServices) {
                    foreach($companyServices as $service) {
                        if(strtolower($service["name"]) === strtolower($serviceName)) {
                            echo "service-repeat";
                            return;
                        }
                    }
                }
                $query = $this->db->prepare("
                    INSERT INTO company_services
                    (name, company_id)
                    VALUES(?, ?)
                ");
                $query->execute([
                    $serviceName,
                    $this->companyId
                ]);
                echo "Service created";
            } else {
                die("Invalid Service Data");
            }
        }

        public function createRole($roles, $postData) {
            if(!empty($postData["role"]) && !empty($postData["department_id"]) && is_numeric($postData["department_id"])) {
                $roleName = strip_tags($postData["role"]);
                $departmentId = (int)strip_tags($postData["department_id"]);
                if($roles) {
                    foreach($roles as $role) {
                        if(strtolower($role["name"]) === strtolower($roleName)) { 
                            echo "role-repeat";  
                            return;
                        }
                    }
                }
                $query = $this->db->prepare("
                    INSERT INTO roles
                    (name, department_id, company_id)
                    VALUES(?, ?, ?)
                ");
                $query->execute([
                    $roleName,
                    $departmentId,
                    $this->companyId
                ]);
                echo "Role created";
            } else {
                echo "Invalid Role Data";
            }
        }

        public function createService($postData) {
            
        }

    }