export class Modal{
    
    addModalToggle(type) {
        this.responsiveModalBtnsStatus("Add");
        let personModal;
        let createBtn;
        let createOpenCloseSign; 
        if(type === "Client") {
            personModal = document.getElementById("add-client");
            createBtn = document.querySelector(".create-client button");
            createOpenCloseSign = document.querySelector(".create-client i");
        } else if(type === "Employee"){
            personModal = document.getElementById("add-employee");
            createBtn = document.querySelector(".create-employee button");
            createOpenCloseSign = document.querySelector(".create-employee i");
        } else if(type === "Service") {
            personModal = document.querySelector(".create-service-container");
            createBtn = document.querySelector(".add-service-btn");
            createOpenCloseSign = document.querySelector(".add-service-btn i");
            createOpenCloseSign = document.querySelector(".add-service-btn i");
            personModal.classList.remove("d-none");
            if(createBtn.className !== "form-btn add-service-btn create-active") {
                personModal.classList.remove("close-service-modal");
                personModal.querySelector("form").classList.remove("close-service-content-opacity");
                personModal.classList.add("open-service-modal");
                createBtn.classList.add("create-active");
                personModal.querySelector("form").classList.add("open-service-content-opacity");
                createOpenCloseSign.className = "fas fa-minus";
            } else {
                createBtn.classList.remove("create-active");
                personModal.classList.remove("open-service-modal");
                personModal.querySelector("form").classList.remove("open-service-content-opacity");
                personModal.classList.add("close-service-modal");
                personModal.querySelector("form").classList.add("close-service-content-opacity");
                createOpenCloseSign.className = "fas fa-plus";
            }
            return;
        }
        personModal.classList.remove('d-none');
        createBtn.classList.toggle("create-active");
        if(createBtn.className !== "form-btn create-active"){
            createOpenCloseSign.className = "fas fa-plus";
            personModal.classList.remove('modal-open')
            personModal.querySelector("header").classList.remove('modal-content-open');
            personModal.querySelector("form").classList.remove('modal-content-open');
            personModal.querySelector("header").classList.add('modal-content-close');
            personModal.querySelector("form").classList.add('modal-content-close');
            personModal.classList.add('modal-close')
            
        } else {
            createOpenCloseSign.className = "fas fa-minus";
            personModal.classList.remove('modal-close');
            personModal.classList.add('modal-open');
            personModal.querySelector("header").classList.remove('modal-content-close');
            personModal.querySelector("form").classList.remove('modal-content-close');
            personModal.querySelector("header").classList.add('modal-content-open');
            personModal.querySelector("form").classList.add('modal-content-open');
        }
    }

    addFilterToggle(type) {
        this.responsiveModalBtnsStatus("Filter");
        let filterBody;
        let filterBtn;
        if(type === "Client") {
            filterBody = document.querySelector("#filter-client-form");
            filterBtn = document.querySelector(".filter-client .filter-button");
        } else if(type === "Employee"){
            filterBody = document.querySelector("#filter-employee-form");
            filterBtn = document.querySelector(".filter-employee .filter-button");
        } else if(type === "Service") {
            const filterForm = document.querySelector(".filter-service-container form");
            filterBody = document.querySelector(".filter-service-container");
            filterBtn = document.querySelector(".filter-service-btn");
            filterBody.classList.remove("d-none");
            if(filterBtn.className !== "filter-service-btn filter-active") {
                filterForm.classList.remove("close-service-filter-content")
                filterForm.classList.add("open-service-filter-content")
                filterBody.classList.remove("close-service-filter");
                filterBody.classList.add("open-service-filter");
                filterBtn.classList.add("filter-active");
            } else {
                filterForm.classList.remove("open-service-filter-content")
                filterForm.classList.add("close-service-filter-content")
                filterBody.classList.remove("open-service-filter");
                filterBody.classList.add("close-service-filter");
                filterBtn.classList.remove("filter-active");
            }
            return;
        }

        filterBody.classList.remove("d-none");
        if(filterBtn.className !== "form-btn filter-button filter-active") {
            filterBody.classList.remove("filter-anime-close");
            filterBody.classList.add("filter-anime-open");
            filterBtn.classList.add("filter-active");
        } else {
            filterBody.classList.remove("filter-anime-open");
            filterBody.classList.add("filter-anime-close");
            filterBtn.classList.remove("filter-active");
        }
    }

    responsiveModalBtnsStatus(type) {
        const body = document.querySelector("body");
        const clientModal = document.getElementById("add-client");
        const employeeModal = document.getElementById("add-employee");
        const serviceModal = document.querySelector(".create-service-container");
        const filterEmployeeBtn = document.querySelector(".filter-employee .filter-button");
        const filterClientBtn = document.querySelector(".filter-client .filter-button");
        const filterServiceBtn = document.querySelector(".filter-service-btn");
        const createServiceBtn = document.querySelector(".add-service-btn");
        const createClientBtn = document.querySelector(".create-client button");
        const createEmployeeBtn = document.querySelector(".create-employee button");
        if(window.innerWidth < 995) {
            if(type === "Add") {
                if(body.id === "clients-page") {
                    if(clientModal.className !== "modal-open") {
                        filterClientBtn.disabled = "true";
                    } else {
                        filterClientBtn.removeAttribute("disabled");
                    }
                } else if(body.id === "employees-page") {
                    if(employeeModal.className !== "modal-open") {
                        filterEmployeeBtn.disabled = "true";
                    } else {
                        filterEmployeeBtn.removeAttribute("disabled");
                    }
                } else if(body.id === "services-page") {
                    if(serviceModal.className !== "create-service-container open-service-modal") {
                        filterServiceBtn.disabled = "true";
                    } else {
                        filterServiceBtn.removeAttribute("disabled");
                    }
                }
            } else if(type === "Filter") {
                if(body.id === "clients-page") {
                    if(!filterClientBtn.classList.contains("filter-active")) {
                        createClientBtn.disabled = "true";
                    } else {
                        createClientBtn.removeAttribute("disabled");
                    }
                } else if(body.id === "employees-page") {
                    if(!filterEmployeeBtn.classList.contains("filter-active")) {
                        createEmployeeBtn.disabled = "true";
                    } else {
                        createEmployeeBtn.removeAttribute("disabled");
                    }
                } else if(body.id === "services-page") {
                    if(filterServiceBtn.className !== "filter-service-btn filter-active") {
                        createServiceBtn.disabled = "true";
                    } else {
                        createServiceBtn.removeAttribute("disabled");
                    }
                }
            }
        }
    }

    manageModal(type){
        let modalContainer;
        let showButton;
        let list;
        if(type === "departments") {
            modalContainer = document.querySelector(".departments-modal");
            showButton = document.querySelector(".add-departments-btn");
        } else if(type === "services") {
            modalContainer = document.querySelector(".services-modal");
            showButton = document.querySelector(".add-services-btn");
            list = document.querySelector("#services-list");
        } else if(type === "roles") {
            modalContainer = document.querySelector(".roles-modal");
            showButton = document.querySelector(".add-roles-btn");
            list = document.querySelector("#roles-list");
        }

        showButton.classList.toggle("btn-active");
        
        if(showButton.classList.contains("btn-active")) {
            modalContainer.classList.remove("close-manage-modal")
            modalContainer.classList.add("open-manage-modal");
        } else {
            modalContainer.classList.remove("open-manage-modal")
            modalContainer.classList.add("close-manage-modal")
        }
    }
}
