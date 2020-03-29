const removeDepartmentBtns = document.querySelectorAll(".remove-department");
const removeCompanyServiceBtns = document.querySelectorAll(".remove-company-service");
const removeRolesBtns = document.querySelectorAll(".remove-role");
const removeServiceFromHistoryBtns = document.querySelectorAll(".remove-service-a");


removeDepartmentBtns.forEach((department) => {
    department.addEventListener("click", function() {
        fetch("./Controllers/requests.php?remove=department&departmentId=" + this.dataset.departmentid);
        this.parentNode.remove();
    });
});

removeCompanyServiceBtns.forEach((companyService) => {
    companyService.addEventListener("click", function() {
        fetch("./Controllers/requests.php?remove=companyService&companyServiceId=" + this.dataset.companyserviceid);
        this.parentNode.remove();
    });
});

removeRolesBtns.forEach((role) => {
    role.addEventListener("click", function() {
        fetch("./Controllers/requests.php?remove=role&roleId=" + this.dataset.roleid);
        this.parentNode.remove();
    });
});

removeServiceFromHistoryBtns.forEach((historyService) => {
    historyService.addEventListener("click", function() {
        fetch("./Controllers/requests.php?remove=serviceFromHistory&serviceId=" + this.dataset.serviceid);
        this.parentNode.parentNode.remove();
    });
});

// Giving time to JS genarte html output -----------------------------------------------------
setTimeout(() => {
    const removeClientBtns = document.querySelectorAll(".remove-client-a");
    const removeEmployeeBtns = document.querySelectorAll(".remove-employee-a");
    removeClientBtns.forEach((client) => {
        client.addEventListener("click", function() {
            fetch("./Controllers/requests.php?remove=client&clientId=" + this.dataset.clientid);
            this.parentNode.parentNode.parentNode.remove();
        });
    });

    removeEmployeeBtns.forEach((employee) => {
        employee.addEventListener("click", function() {
            //console.log(this.parentNode.parentNode.parentNode); return;
            fetch("./Controllers/requests.php?remove=employee&employeeId=" + this.dataset.employeeid);
            this.parentNode.parentNode.parentNode.remove();
        });
    });
}, 500);
// -------------------------------------------------------------------------------------------