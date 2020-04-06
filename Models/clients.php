<?php 
require("employees.php");
    class Clients extends Employees {

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

        public function removeClient($clientId) {
            $clientId = (int)strip_tags($clientId);
            if(is_numeric($clientId) && !empty($clientId)) {
                $query = $this->db->prepare("DELETE FROM clients WHERE client_id = ?");
                $query->execute([$clientId]);
                return true;
            }
            return false;
        }

        public function getClientByName($name) {
            $query = $this->db->prepare("
                SELECT 
                    client_id, first_name AS firstName, last_name as lastName, picture,
                    email, country, city
                FROM 
                    clients
                WHERE 
                    first_name = ? AND company_id = ?
            ");
            $query->execute([$name, $this->companyId]);
            $clients = $query->fetchAll(PDO::FETCH_ASSOC);
            return $clients;     
        }

        public function getClientByCountry($country) {
            $country = strip_tags(trim($country));
            $query = $this->db->prepare("
                SELECT 
                    client_id, first_name AS firstName, last_name as lastName, picture,
                    email, country, city
                FROM 
                    clients
                WHERE 
                    country = ? AND company_id = ?
            ");
            $query->execute([$country, $this->companyId]);
            $clients = $query->fetchAll(PDO::FETCH_ASSOC);
            return $clients;
        }

        public function getClientByCity($city) {
            $city = strip_tags(trim($city));
            $query = $this->db->prepare("
                SELECT 
                    client_id, first_name AS firstName, last_name as lastName, picture,
                    email, country, city
                FROM 
                    clients
                WHERE 
                    city = ? AND company_id = ?
            ");
            $query->execute([$city, $this->companyId]);
            $clients = $query->fetchAll(PDO::FETCH_ASSOC);
            return $clients;
        }


        public function getClientByCountryAndCity($country, $city) {
            $country = strip_tags(trim($country));
            $city = strip_tags(trim($city));
            $query = $this->db->prepare("
                SELECT 
                    client_id, first_name AS firstName, last_name as lastName, picture,
                    email, country, city
                FROM 
                    clients
                WHERE 
                    country = ? AND city = ? AND company_id = ?
            "); 
            $query->execute([$country, $city, $this->companyId]);
            $clients = $query->fetchAll(PDO::FETCH_ASSOC);
            return $clients;
        }
    }