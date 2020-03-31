<?php 
    class Base  {
        
        protected $db;
        protected $companyId;

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
    }