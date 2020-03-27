export class CompanyManager {

    constructor() {
        this.clientNumberOfPages = 0;
        this.employeesNumberOfPages = 0;
        this.clientCurrentPage = 1;
        this.employeeCurrentPage = 1;
        this.htmlOutput = "";
        this.peopleArr = [];
        this.pageLimit = 4; //Don't change
        this.viewQuantity = 4;
    }
    

    showPageSystem = function(typeOfPeople) {
        return new Promise((resolve, reject) => {
            if(typeOfPeople === "Clients") {
                this.getClients().then(data => {
                    this.clientsHtmlOutput(data, this.clientCurrentPage, this.pageLimit);
                    this.calculateNumberOfPages(data, "Clients");
                    resolve();
                });
            } else if(typeOfPeople === "Employees") {
                this.getEmployees().then(data => {
                    this.employeesHtmlOuput(data, this.employeeCurrentPage, this.pageLimit);
                    this.calculateNumberOfPages(data, "Employees");
                    resolve();
                })
            }
        });
    }

    getClients = function() {
        return new Promise(function(resolve, reject) {
            fetch("./Controllers/requests.php?type=clients")
                .then(response => response.json())
                .then(data => {
                    resolve(data)
                });
        });
    }

    getEmployees = function(){
        return new Promise(function(resolve, reject) {
            fetch("./Controllers/requests.php?type=employees")
                .then(response => response.json())
                .then(data => {
                    resolve(data)
                });
        });
    }

    clientsHtmlOutput(data, currentPage, pageLimit) {
        const output = document.getElementById("clients");
        output.innerHTML = "";
        let boxClasses = {};
        if(this.viewQuantity === 4) {
            boxClasses = {
                box: "client-box",
                avatar: "client-avatar",
                picture: "client-picture",
                info: "client-info"
            }
            this.pageLimit = 4;
            pageLimit = this.pageLimit;
            output.classList.remove("d-flex-start");
        } else if(this.viewQuantity === 6) {
            boxClasses = {
                box: "client-box-view-6",
                avatar: "client-avatar-view-6",
                picture: "client-picture-view-6",
                info: "client-info-view-6"
            }
            this.pageLimit = 6;
            pageLimit = this.pageLimit;
            output.classList.add("d-flex-start");
        } else if(this.viewQuantity === 8) {
            boxClasses = {
                box: "client-box-view-8",
                avatar: "client-avatar-view-8",
                picture: "client-picture",
                info: "client-info-view-8"
            }
            this.pageLimit = 8;
            pageLimit = this.pageLimit;
            output.classList.add("d-flex-start");
        }

        const currentClient = (currentPage * pageLimit) - pageLimit;
        const clientsPerPage = currentPage * pageLimit;

        for (let i = currentClient; i < clientsPerPage; i++) {
            if(data[i] !== undefined) {
                output.innerHTML += `
                    <div class="${boxClasses.box}" data-id="${data[i].client_id}">
                        <div>
                            <div class="${boxClasses.avatar}">
                                <div class="title">
                                    <h2>${data[i].firstName} ${data[i].lastName}</h2>
                                </div>
                                <div class="${boxClasses.picture}">
                                    <img src="./Assets/imgs/uploads/profilePictures/${data[i].picture}" alt="Client Picture">
                                </div>
                            </div>
                            <div class="${boxClasses.info}">
                                <p><span>Email:</span> ${data[i].email}</p>
                                <p><span>Country:</span> ${data[i].country}</p>
                                <p><span>City:</span> ${data[i].city}</p>
                            </div>
                        </div>
                        <a href="?controller=people&action=contact&origin=clients&clientId=${data[i].client_id}">
                            <button class="contact-client">Contact</button>
                        </a>
                    </div> 
                `;
            }
        }
    }

    employeesHtmlOuput(data, currentPage, pageLimit) {
        const output = document.getElementById("employees");
        output.innerHTML = "";
        let boxClasses = {};
        if(this.viewQuantity === 4) {
            boxClasses = {
                box: "employee-box",
                avatar: "employee-avatar",
                picture: "employee-picture",
                info: "employee-info"
            }
            this.pageLimit = 4;
            pageLimit = this.pageLimit;
            output.classList.remove("d-flex-start");
        } else if(this.viewQuantity === 6) {
            boxClasses = {
                box: "employee-box-view-6",
                avatar: "employee-avatar-view-6",
                picture: "employee-picture-view-6",
                info: "employee-info-view-6"
            }
            this.pageLimit = 6;
            pageLimit = this.pageLimit;
            output.classList.remove("d-flex-start");
        } else if(this.viewQuantity === 8) {
            boxClasses = {
                box: "employee-box-view-8",
                avatar: "employee-avatar-view-8",
                picture: "employee-picture",
                info: "employee-info-view-8"
            }
            this.pageLimit = 8;
            pageLimit = this.pageLimit;
            output.classList.add("d-flex-start");
        }
        const currentEmployee = (currentPage * pageLimit) - pageLimit;
        const employeesPerPage = currentPage * pageLimit;
        for (let i = currentEmployee; i < employeesPerPage; i++) {
            if(data[i] !== undefined) {
                output.innerHTML += `
                    <div class="${boxClasses.box}" data-id=${data[i].employee_id}>
                        <div>
                            <div class="${boxClasses.avatar}">
                                <div class="title">
                                    <h2>${data[i].firstName} ${data[i].lastName}</h2>
                                </div>
                                <div class="${boxClasses.picture}">
                                    <img src="./Assets/imgs/uploads/profilePictures/${data[i].picture}" alt="employee Picture">
                                </div>
                            </div>
                            <div class="${boxClasses.info}">
                                <p><span>Phone:</span> ${data[i].email}</p>
                                <p><span>Department:</span> ${data[i].department}</p>
                                <p><span>Role:</span> ${data[i].role}</p>
                                <p><span>Salary:</span> ${data[i].salary}</p>
                            </div>
                        </div>
                        <a href="?controller=people&action=contact&origin=employees&employeeId=${data[i].employee_id}">
                            <button class="contact-employee">Contact</button>
                        </a>
                    </div> 
                `
            }
        }
    }

    calculateNumberOfPages(data, type) {
        this.clientNumberOfPages = 0;
        this.employeesNumberOfPages = 0;
        const numberOfPagesHtmlOutput = document.querySelector(".number-of-pages");
        for(let i = 0; i < data.length; i += this.pageLimit) {
            if(type === "Clients") {
                this.clientNumberOfPages++;
                numberOfPagesHtmlOutput.textContent = this.clientCurrentPage + " in " + this.clientNumberOfPages + " pages";
            } else if(type === "Employees"){
                this.employeesNumberOfPages++;
                numberOfPagesHtmlOutput.textContent = this.employeeCurrentPage + " in " + this.employeesNumberOfPages + " pages";
            }
        }
    }

    movePageSystem(type) {
        const previousPage = document.querySelector(".previous-page");
        const nextPage = document.querySelector(".next-page");
        previousPage.addEventListener("click", () => {
            if(type === "Clients" && this.clientCurrentPage > 1) {
                this.clientCurrentPage--;
                this.showPageSystem("Clients");
            } else if(type === "Employees" && this.employeeCurrentPage > 1) {
                this.employeeCurrentPage--;
                this.showPageSystem("Employees");
            }
        });
        nextPage.addEventListener("click", () => {
            if(type === "Clients" && this.clientCurrentPage < this.clientNumberOfPages) {
                this.clientCurrentPage++;
                this.showPageSystem("Clients");
            } else if(type === "Employees" && this.employeeCurrentPage < this.employeesNumberOfPages) {
                this.employeeCurrentPage++;
                this.showPageSystem("Employees");
            }
        })
    }

    changeViewQuantity(quantity, type) {
        this.viewQuantity = quantity;
        if(type === "Clients") {
            this.clientCurrentPage = 1;
            this.showPageSystem("Clients")
        } else if(type === "Employees") {
            this.employeeCurrentPage = 1;
            this.showPageSystem("Employees")
        }
    }

    activeLinkStatus() {
        const currentPage = document.querySelector("body");
        const home = document.querySelector(".home");
        const clients = document.querySelector(".clients");
        const employees = document.querySelector(".employees");
        const services = document.querySelector(".services");
        const settings = document.querySelector(".settings");
 
            home.classList.remove("active-page");
            clients.classList.remove("active-page");
            employees.classList.remove("active-page");
            services.classList.remove("active-page");
            settings.classList.remove("active-page");
    
            if(currentPage.id === "home-page") {
                home.classList.add("active-page");
            } else if(currentPage.id === "clients-page") {
                clients.classList.add("active-page");
            } else if(currentPage.id === "employees-page") {
                employees.classList.add("active-page");
            } else if(currentPage.id === "services-page") {
                services.classList.add("active-page");
            } else if(currentPage.id === "settings-page") {
                settings.classList.add("active-page");
            }
        }
}

