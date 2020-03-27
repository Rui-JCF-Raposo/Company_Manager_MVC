const registerBtn = document.querySelector(".register-btn");
const loginBtn = document.querySelector(".login-btn");
const registerContainer = document.getElementById("register");
const loginContainer = document.getElementById("login");
const registerSign = registerBtn.querySelector("i");
const loginSign = loginBtn.querySelector("i");

registerBtn.addEventListener("click", () => {
    if(loginContainer.className === "mt-4 d-none") {
        registerContainer.classList.toggle("d-none")
        registerBtn.classList.toggle("btn-active");
        if(registerSign.className === "fas fa-plus") {
            registerSign.className = "fas fa-minus";
            registerContainer.classList.add("show-form-anime");
        } else {
            registerSign.className = "fas fa-plus";
            registerContainer.classList.remove("show-form-anime");
        }
    } 
});

loginBtn.addEventListener("click", () => {
    if(registerContainer.className === "mt-3 mb-5 d-none") {
        loginContainer.classList.toggle("d-none");
        loginBtn.classList.toggle("btn-active");
        if(loginSign.className === "fas fa-plus") {
            loginSign.className = "fas fa-minus";
            loginContainer.classList.add("show-form-anime");
        } else {
            loginSign.className = "fas fa-plus";
            loginContainer.classList.remove("show-form-anime");
        }
    }
});

const loginInputs = document.querySelectorAll("#login input");
loginInputs.forEach((input) => {
    input.addEventListener("change", () => {
        const errorMessage = document.querySelector(".user-inixistente");
        errorMessage.classList.add("d-none");
    });
});