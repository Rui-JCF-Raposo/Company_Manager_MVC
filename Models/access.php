<?php
    class Access {

        private $db;

        public function __construct() {
            $this->db = new PDO("mysql:host=localhost;dbname=Company_Manager;charset=utf8mb4", "root". ""); 
        }

        public function login($data){
            if(isset($data["send"])) {
                foreach($data as $key => $value) {
                    $data[$key] = strip_tags(trim($value));
                }
                if(filter_var($data["email"], FILTER_VALIDATE_EMAIL) && !empty($data["password"])){
                    if(filter_var($data["email"], FILTER_VALIDATE_EMAIL)){

                        $email = $data["email"];
                        
                        $query= $this->db->prepare("
                            SELECT company_id, password
                            FROM company
                            WHERE email = ?
                        ");
                        $query->execute([$email]);
                        $company = $query->fetch(PDO::FETCH_ASSOC);
                        
                        if(
                            password_verify($data["password"], $company["password"])
                        ) {
                            session_start();
                            $_SESSION["login"] = "true";
                            $_SESSION["company_id"] = $company["company_id"];
                            header("Location: ?controller=company&page=home");
                        } else {
                            header("Location: ?controller=access&loginInvalid");
                        }
                    }  
                }
            }
        }

        public function logout() {
            session_start();
            session_destroy();
            header("Location: ?controller=acess");
        }

        public function register($data) {
            foreach($data as $key => $value) {
                $data[$key] = strip_tags(trim($value));
            }
            if(
                !empty($data["name"]) &&
                filter_var($data["email"], FILTER_VALIDATE_EMAIL) &&
                !empty($data["password"]) &&
                !empty($data["rep-password"]) &&
                $data["password"] === $data["rep-password"] &&
                !empty($data["industry"])
            ) {
                $query = $this->db->prepare("
                    INSERT INTO company
                    (name, email, password, phone, industry, security_question, security_answer)
                    VALUES(?,?,?,?,?,?,?)
                ");
                $query->execute([
                    $data["name"],
                    $data["email"],
                    password_hash($data["password"], PASSWORD_DEFAULT),
                    $data["phone"],
                    $data["industry"],
                    $data["question"],
                    $data["answer"]
                ]);
                header("Location: ?controller=access");
            } else {
                die("Invalid Registration");
            }
        }
    }