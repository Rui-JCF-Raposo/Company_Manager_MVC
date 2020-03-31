<?php 
require("base.php");
    class Company extends Base {

        public function getCompanyInfo() {
            $query = $this->db->prepare("
                SELECT name
                FROM company
                WHERE company_id = ?
            ");
            $query->execute([$this->companyId]);
            $company = $query->fetch(PDO::FETCH_ASSOC);
            return $company;
        }
    }