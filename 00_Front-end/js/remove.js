export function createRemoveEvents() {
    const removeDepartmentBtns = document.querySelectorAll(".remove-department");
    const removeCompanyServiceBtns = document.querySelectorAll(".remove-company-service");
    const removeRolesBtns = document.querySelectorAll(".remove-role");
    const removeServiceFromHistoryBtns = document.querySelectorAll(".remove-service-a");
    
    
    removeDepartmentBtns.forEach((department) => {
        department.addEventListener("click", function() {
            fetch("./Http/requests.php?remove=department&departmentId=" + this.dataset.departmentid);
            this.parentNode.remove();
        });
    });
    
    removeCompanyServiceBtns.forEach((companyService) => {
        companyService.addEventListener("click", function() {
            fetch("./Http/requests.php?remove=companyService&companyServiceId=" + this.dataset.companyserviceid);
            this.parentNode.remove();
        });
    });
    
    removeRolesBtns.forEach((role) => {
        role.addEventListener("click", function() {
            fetch("./Http/requests.php?remove=role&roleId=" + this.dataset.roleid);
            this.parentNode.remove();
        });
    });
    
    removeServiceFromHistoryBtns.forEach((historyService) => {
        historyService.addEventListener("click", function() {
            fetch("./Http/requests.php?remove=serviceFromHistory&serviceId=" + this.dataset.serviceid);
            this.parentNode.parentNode.remove();
        });
    });
    
    //Remove clients and employees is prense in company_manager.js, because there is a page system and the event need to constantly be created when move to new page. This because the html is lazy loaded

}