<?php 
require("departments.php");
    class Services extends Departments {
        
        public function getCompanyServices() {
            $companyServicesQuery = $this->db->prepare("
                SELECT company_service_id, name
                FROM company_services
                WHERE company_id = ?
            ");
            $companyServicesQuery->execute([$this->companyId]);
            $companyServices = $companyServicesQuery->fetchAll(PDO::FETCH_ASSOC);
            return $companyServices;
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

        public function removeCompanyService($companyServiceId) {
            $companyServiceId = (int)strip_tags($companyServiceId);
            if(is_numeric($companyServiceId) && !empty($companyServiceId)) {
                $query = $this->db->prepare("DELETE FROM company_services WHERE company_service_id = ?");
                $query->execute([$companyServiceId]);
                return true;
            }
            return false;
        }

        public function getServicesHistory() {
            $servicesHistoryQuery = $this->db->prepare("
                SELECT 
                    service_id AS serviceId,
                    company_service_name AS name, 
                    price,
                    client_name AS clientName, 
                    employee_name AS employeeName, 
                    add_date AS addDate
                FROM 
                    services_history
                WHERE 
                    company_id = ?
                ORDER BY addDate DESC
            ");
            $servicesHistoryQuery ->execute([$_SESSION["company_id"]]);
            $servicesHistory = $servicesHistoryQuery ->fetchAll(PDO::FETCH_ASSOC);
            return $servicesHistory;
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