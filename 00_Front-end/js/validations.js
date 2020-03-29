export function FormsValidator(e, type) {

    const emailRegex = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
    const date = new Date();

    const fields = {
        birthDay: document.querySelector(".b-day"),
        birthMonth: document.querySelector(".b-month"),
        birthYear: document.querySelector(".b-year")
    };
    const errorMessages = {
        firstName: document.querySelector(".empty-fname"),
        lastName:  document.querySelector(".empty-lname"),
        email: document.querySelector(".error-email"),
        country: document.querySelector(".empty-country"),
        city: document.querySelector(".empty-city"),
        street: document.querySelector(".empty-street"),
        birthDate: document.querySelector(".error-birth-date"),
        department: document.querySelector(".empty-department"),
        role: document.querySelector(".empty-role"),
        salary: document.querySelector(".empty-salary"),
        comanyName: document.querySelector(".empty-company-name"),
        registerEmail: document.querySelector(".error-r-email"),
        emptyPassword: document.querySelector(".empty-password"),
        passwordRepeat: document.querySelector(".empty-rep-password"),
        industry: document.querySelector(".empty-industry"),
        passwordError: document.querySelector(".error-passwword"),
        loginPassword: document.querySelector(".empty-l-password"),
        inixistenteUser: document.querySelector(".user-inixistente"),
        emptyAddDepartment: document.querySelector(".empty-m-department"),
        emptyAddCompanyService: document.querySelector(".empty-m-service"),
        emptyAddRole: document.querySelector(".empty-m-role"),
        departmentRepeat:  document.querySelector(".m-department-repeat"),
        companyServiceRepeat: document.querySelector(".m-service-repeat"),
        roleRepeat: document.querySelector(".m-role-repeat")
    }

    if(type === "client") {
        fields.firstName = document.getElementById("c-first-name");
        fields.lastName = document.getElementById("c-last-name");
        fields.email = document.getElementById("c-email");
        fields.country = document.getElementById("c-country");
        fields.city = document.getElementById("c-city");
        fields.street = document.getElementById("c-street");
        fields.birthDate = document.getElementById("c-birthDate");

    } else if(type === "employee") {
        fields.firstName = document.getElementById("e-first-name");
        fields.lastName = document.getElementById("e-last-name");
        fields.email = document.getElementById("e-email");
        fields.country = document.getElementById("e-country");
        fields.city = document.getElementById("e-city");
        fields.street = document.getElementById("e-street");
        fields.department = document.getElementById("e-department");
        fields.role = document.getElementById("e-role");
        fields.salary = document.getElementById("e-salary");
    } else if(type === "register") {
        fields.companyName = document.getElementById("r-name");
        fields.registerEmail = document.getElementById("r-email");
        fields.password = document.getElementById("r-password");
        fields.passwordRepeat = document.getElementById("r-rep-password");
        fields.industry = document.getElementById("r-industry");
    } else if(type === "login") { 
        fields.loginEmail = document.getElementById("l-email");
        fields.loginPassword = document.getElementById("l-password");
        fields.loginInvalid = document.querySelector(".login-status");
    } else if(type ==="department") {
        fields.addDepartmentName =  document.getElementById("department-name");
    } else if(type === "companyService") {
        fields.addCompanyServiceName =  document.getElementById("service-name");
    } else if (type === "role") {
        fields.addRole = document.getElementById("role-name");
    } else if(type === "department-repeat") {
        fields.departmentName = document.getElementById("department-name");
    } else if(type === "service-repeat") {
        fields.companyServiceName =  document.getElementById("service-name");
    } else if(type === "role-repeat") {
        fields.roleName =  document.getElementById("role-name");
    } else if(type === "cleanForms") {
        cleanAllForms(fields);
    } 

    if(fields.firstName) {

        if(
            fields.firstName.value === "" ||
            fields.lastName.value === "" ||
            fields.email.value === "" ||
            fields.country.value === "" ||
            fields.city.value === "" ||
            fields.street.value === "" ||
            emailRegex.test(fields.email.value) === false
        ) {
            e.preventDefault();
        }

        if(fields.firstName.value === "") {
            errorMessages.firstName.classList.remove("d-none");
        } 
    
        if(fields.lastName.value === "") {
            errorMessages.lastName.classList.remove("d-none");
        } 
    
        if(emailRegex.test(fields.email.value) === false) {
            errorMessages.email.classList.remove("d-none");
        }
    
        if(fields.country.value === "") {
            errorMessages.country.classList.remove("d-none")
        } 
    
        if(fields.city.value === "") {
            errorMessages.city.classList.remove("d-none");
        } 
    
        if(fields.street.value === "") {
            errorMessages.street.classList.remove("d-none");
        } 

        if(
            (fields.birthDay.value < 1 || fields.birthDay.value > 31) || 
            (fields.birthMonth.value < 1 || fields.birthMonth.value > 12 ) ||
            (fields.birthYear.value < 1920 || fields.birthYear.value > date.getFullYear()) 
        ) {
            errorMessages.birthDate.classList.remove("d-none");
        }
    }

    if(fields.department && fields.role && fields.salary) {

        if(
            fields.department.value === "" ||
            fields.role.value === "" ||
            fields.salary.value === ""
        ) {
            e.preventDefault();
        }

        if(fields.department.value === "") {
            errorMessages.department.classList.remove("d-none");
        }
        if(fields.role.value === "") {
            errorMessages.role.classList.remove("d-none");
        }
        if(fields.salary.value === "") {
            errorMessages.salary.classList.remove("d-none");
        }
    }

    if(fields.companyName) {

        if(
            fields.companyName.value === "" ||
            fields.registerEmail.value === "" ||
            fields.password.value === "" ||
            fields.passwordRepeat.value === "" ||
            fields.industry.value === "" ||
            fields.password.value !== fields.passwordRepeat.value 
        ) {
            e.preventDefault();
        }

        if(fields.companyName.value === "") {
            errorMessages.comanyName.classList.remove("d-none");
        }

        if(fields.registerEmail.value === ""){
            errorMessages.registerEmail.classList.remove("d-none");
        }

        if(fields.password.value === "") {
            errorMessages.emptyPassword.classList.remove("d-none");
        }
        if(fields.passwordRepeat.value === "") {
            errorMessages.passwordRepeat.classList.remove("d-none");
        }
        if(fields.industry.value === "") {
            errorMessages.industry.classList.remove("d-none");
        }

        if(fields.password.value !== fields.passwordRepeat.value) {
            errorMessages.passwordError.classList.remove("d-none"); 
        }
    }

    if(fields.loginEmail) {
        
        if(
            emailRegex.test(fields.loginEmail.value) === false ||
            fields.loginPassword.value === ""
        ) {
            e.preventDefault();
        }

        if(emailRegex.test(fields.loginEmail.value) === false) {
            errorMessages.email.classList.remove("d-none");
        }
        if(fields.loginPassword.value === "") {
            errorMessages.loginPassword.classList.remove("d-none");
        }
    }

    if(fields.addDepartmentName) {
        if(fields.addDepartmentName.value === "") {
            errorMessages.emptyAddDepartment.classList.remove("d-none");
            e.preventDefault();
        }
    }

    if(fields.addCompanyServiceName) {
        if(fields.addCompanyServiceName.value === "") {
            errorMessages.emptyAddCompanyService.classList.remove("d-none");
            e.preventDefault();
        }
    }

    if(fields.addRole) {
        if(fields.addRole.value === "") {
            errorMessages.emptyAddRole.classList.remove("d-none");
            e.preventDefault();
        }
    }

    if(fields.departmentName) {
        errorMessages.departmentRepeat.classList.remove("d-none");
        e.preventDefault();
    }

    if(fields.companyServiceName) {
        errorMessages.companyServiceRepeat.classList.remove("d-none");
        e.preventDefault();
    }

    if(fields.roleName) {
        errorMessages.roleRepeat.classList.remove("d-none");
        e.preventDefault();
    }
    
    cleanFieldsEvents(fields, errorMessages);
    
};

function cleanFieldsEvents(fields, errorMessages) {

    if(fields.firstName || fields.lastName || fields.email || fields.country || fields.city || fields.street || fields.birthDate){
        fields.firstName.addEventListener("change", function(){
            if(this.value !== "") {
                errorMessages.firstName.classList.add("d-none");
            }
        });

        fields.lastName.addEventListener("change", function(){
            if(this.value !== "") {
                errorMessages.lastName.classList.add("d-none");
            }
        });


        fields.email.addEventListener("change", function(){
            if(this.value !== "") {
                errorMessages.email.classList.add("d-none");
            }
        });

        fields.country.addEventListener("change", function(){
            if(this.value !== "") {
                errorMessages.country.classList.add("d-none");
            }
        });

        fields.city.addEventListener("change", function(){
            if(this.value !== "") {
                errorMessages.city.classList.add("d-none");
            }
        });

        fields.street.addEventListener("change", function(){
            if(this.value !== "") {
                errorMessages.street.classList.add("d-none");
            }
        });

        fields.birthDay.addEventListener("change", function() {
            if(this.value !== "") {
                errorMessages.birthDate.classList.add("d-none");
            }
        });

        fields.birthMonth.addEventListener("change", function() {
            if(this.value !== "") {
                errorMessages.birthDate.classList.add("d-none");
            }
        });

        fields.birthYear.addEventListener("change", function(){
            if(this.value !== "") {
                errorMessages.birthDate.classList.add("d-none");
            }
        });
    }

    if(fields.department) {
        fields.department.addEventListener("change", function(){
            if(this.value !== "") {
                errorMessages.department.classList.add("d-none");
            }
        });
    
        fields.role.addEventListener("change", function(){
            if(this.value !== "") {
                errorMessages.role.classList.add("d-none");
            }
        });
    
        fields.salary.addEventListener("change", function(){
            if(this.value !== "") {
                errorMessages.salary.classList.add("d-none");
            }
        });
    }

    if(fields.companyName) {
        fields.companyName.addEventListener("change", () => {
            errorMessages.comanyName.classList.add("d-none");
        });

        fields.registerEmail.addEventListener("change", () => {
            errorMessages.registerEmail.classList.add("d-none");
        });

        fields.password.addEventListener("change", () => {
            errorMessages.emptyPassword.classList.add("d-none");
        });

        fields.passwordRepeat.addEventListener("change", () => {
            errorMessages.passwordRepeat.classList.add("d-none");
            if(fields.password.value !== fields.passwordRepeat.value) {
                errorMessages.passwordError.classList.remove("d-none");
            } else {
                errorMessages.passwordError.classList.add("d-none");
            }
        });

        fields.industry.addEventListener("change", () => {
            errorMessages.industry.classList.add("d-none");
        });
    }

    if(fields.loginEmail) {
        fields.loginEmail.addEventListener("change", () => {
            errorMessages.email.classList.add("d-none");
            errorMessages.inixistenteUser.classList.add("d-none");
        });

        fields.loginPassword.addEventListener("change", () => {
            errorMessages.loginPassword.classList.add("d-none");
            errorMessages.inixistenteUser.classList.add("d-none");
        });
    }

    if(fields.addDepartmentName) {
        fields.addDepartmentName.addEventListener("change", () => {
            errorMessages.emptyAddDepartment.classList.add("d-none");
            errorMessages.departmentRepeat.classList.add("d-none");
        });
    }

    if(fields.addCompanyServiceName) {
        fields.addCompanyServiceName.addEventListener("change", () => {
            errorMessages.emptyAddCompanyService.classList.add("d-none");
            errorMessages.companyServiceRepeat.classList.add("d-none")
        });
    }

    if(fields.addRole) {
        fields.addRole.addEventListener("change", () => {
            errorMessages.emptyAddRole.classList.add("d-none");
            errorMessages.roleRepeat.classList.add("d-none");
        });
    }
}

export function CleanFormMessages(allForms) {
    allForms.forEach((form) => {
        const formFields = document.querySelectorAll("form input");
        formFields.forEach((input) => {
            input.value = "";
        });
        const homeFormMessages = document.querySelectorAll("#home-page p");
        homeFormMessages.forEach((message) => {
            message.classList.add("d-none");
        });
        const formMessages = form.querySelectorAll("form p");
        formMessages.forEach((message) => {
            message.classList.add("d-none");
        });
    });
}


