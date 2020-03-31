import { CompanyManager } from './company_manager.js';
import { Modal } from './modals.js';
import { FormsValidator, CleanFormMessages } from "./validations.js"


/*-------------------------------------------------------------------------------*/
/*-Checking Current Page and Applying HTTP Requests to show Data and Active Link-*/
/*-------------------------------------------------------------------------------*/
const company = new CompanyManager()
const modal = new Modal();
const currentPage = document.querySelector('body');

if(currentPage.id === 'clients-page') {
    company.showPageSystem('Clients').then(() => {
        company.movePageSystem('Clients');
        
    });

} else if(currentPage.id === 'employees-page') {
    company.showPageSystem('Employees').then(() => {
        company.movePageSystem("Employees");
    });
} 

// Change active link class when loads the page
if(currentPage.id !== "index-page") {
    company.activeLinkStatus();
}


/*-------------------------------------------------------------------------------*/
/*--------------------------------Events-----------------------------------------*/
/*-------------------------------------------------------------------------------*/
const allFormsBtns = document.querySelectorAll(".form-btn");
const addClientForm = document.querySelector("#add-client form");
const addEmployeeForm = document.querySelector("#add-employee form");
const registerForm = document.querySelector("#register form");
const loginForm = document.querySelector("#login form");
const departmentForm = document.querySelector("#add-departments-form form");
const companyServicesForm = document.querySelector("#add-services-form form");
const rolesForm = document.querySelector("#add-roles-form form");
const addServicesHistory = document.querySelector(".create-service-container form");

if(addClientForm){
    addClientForm.addEventListener("submit", (e) => {
        FormsValidator(e, "client");;
    });
}

if(addEmployeeForm) {
    addEmployeeForm.addEventListener("submit", (e) => {
        FormsValidator(e, "employee");
    });
}

if(registerForm) {
    registerForm.addEventListener("submit", (e) => {
        FormsValidator(e, "register");
    });
}

if(loginForm) {
    loginForm.addEventListener("submit", (e) => {
        FormsValidator(e, "login");
    });
}

if(departmentForm) {
    departmentForm.addEventListener("submit", (e) => {
        let repetitionFound = false;
        const departmentsList = document.querySelectorAll("#departments-list li");
        departmentsList.forEach((department) => {
            if(department.textContent.toLowerCase().includes(departmentForm.department.value.toLowerCase()) && departmentForm.department.value !== "") {
                repetitionFound = true;
                FormsValidator(e, "department-repeat");
            }
        });
        if(!repetitionFound) {
            FormsValidator(e, "department");
        }
    });
}

if(companyServicesForm) {
    companyServicesForm.addEventListener("submit", (e) => {
        let repetitionFound = false;
        const servicesList = document.querySelectorAll("#services-list li");
        servicesList.forEach((service) => {
            if(service.textContent.toLowerCase().includes(companyServicesForm.service.value.toLowerCase()) && companyServicesForm.service.value !== "") {
                repetitionFound = true;
                FormsValidator(e, "service-repeat");
            }
        });
        if(!repetitionFound) {
            FormsValidator(e, "companyService");
        }
    });
}

if(rolesForm) {
    rolesForm.addEventListener("submit", (e) => {
        let repetitionFound = false;
        const rolesList = document.querySelectorAll("#roles-list li");
        rolesList.forEach((role) => {
            if(role.textContent.toLowerCase().includes(rolesForm.role.value.toLowerCase()) && rolesForm.role.value !== "") {
                repetitionFound = true;
                FormsValidator(e, "role-repeat");
            }
        });
        if(!repetitionFound) {
            FormsValidator(e, "role");
        }
    });
}

if(addServicesHistory) {
    addServicesHistory.addEventListener("submit", (e) => {
        FormsValidator(e, "price");
    });
}

allFormsBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
        if(btn.classList.contains("btn-active") || btn.classList.contains("create-active")) {
            const allForms = document.querySelectorAll("form")
            CleanFormMessages(allForms);
        }  
    });
   
});


const manageButtons = document.querySelectorAll(".manage-main-btns button")
manageButtons.forEach((button) => {
    button.addEventListener("click", function(){
        if(this.classList.contains("add-departments-btn")) {
            let permission = true;
            manageButtons.forEach((button) => {
                if(!button.classList.contains("add-departments-btn") && button.classList.contains("btn-active")) {
                    permission = false;
                }
            });
            if(permission !== false) {
                modal.manageModal("departments");
            }
        } else if(this.classList.contains("add-services-btn")) {
            let permission = true;
            manageButtons.forEach((button) => {
                if(!button.classList.contains("add-services-btn") && button.classList.contains("btn-active")) {
                    permission = false;
                }
            });
            if(permission !== false) {
                modal.manageModal("services");
            }
        } else if(this.classList.contains("add-roles-btn")) {
            let permission = true;
            manageButtons.forEach((button) => {
                if(!button.classList.contains("add-roles-btn") && button.classList.contains("btn-active")) {
                    permission = false;
                }
            });
            if(permission !== false) {
                modal.manageModal("roles");
            }
        }
    });
});



/*---------------------Change Person Box Size------------------------------------*/
if(currentPage.id === "clients-page" || currentPage.id === "employees-page") {
    const cardsSize = document.querySelector(".cards-size");
    cardsSize.addEventListener("change", (e) => {
        if(currentPage.id === "clients-page") {
            company.changeViewQuantity(Number(e.target.value), "Clients");
        } else if(currentPage.id === "employees-page") {
            company.changeViewQuantity(Number(e.target.value), "Employees");
        }
    }); 
}

/*----------------------Show Toggle Modals-----------------------------------*/
/*---------------------------------------------------------------------------*/

/*----------------------Show add modal-----------------------------------*/
const createClientBtn = document.querySelector(".create-client button")
const createEmployeeBtn = document.querySelector(".create-employee button")
const createServiceBtn = document.querySelector(".add-service-btn")

if(createClientBtn) {
    createClientBtn.addEventListener("click", () => {
        modal.addModalToggle("Client")
    });

} else if(createEmployeeBtn) {
    createEmployeeBtn.addEventListener("click", () => {
        modal.addModalToggle("Employee");
    });
} else if(createServiceBtn) {
    createServiceBtn.addEventListener("click", () => {
        modal.addModalToggle("Service");
    });
}

/*----------------------Show filter modal-----------------------------------*/
const filterClientBtn = document.querySelector(".filter-client .filter-button");
const filterEmployeeBtn = document.querySelector(".filter-employee .filter-button");
const filterServiceBtn = document.querySelector(".filter-service-btn");

if(filterClientBtn) {
    filterClientBtn.addEventListener("click", () => {
        modal.addFilterToggle("Client");
    });
} else if(filterEmployeeBtn) {
    filterEmployeeBtn.addEventListener("click", () => {
        modal.addFilterToggle("Employee");
    });
} else if(filterServiceBtn) {
    filterServiceBtn.addEventListener("click", () => {
        modal.addFilterToggle("Service");
    });
}   




