<nav>
    <div class="container">
        <div class="company-logo">
            <h1>
                <a href="?controller=company&page=home">
                    <img src="./Assets/imgs/logo.png" alt="Company Logo">
                </a>
            </h1>
        </div>
        <input type="checkbox" class="hamburguer-menu-btn">
        <div class="hamburguer-menu">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <div class="nav-menu">
            <ul>
                <li><a class="home" href="?controller=company&page=home">Home</a></li>
                <li><a class="clients" href="?controller=people&page=clients">Clients</a></li>
                <li><a class="employees" href="?controller=people&page=employees">Employees</a></li>
                <li><a class="services" href="?controller=company&page=services">Services</a></li>
                <li>
                    <a class="settings" href="#">
                        <i class="fas fa-cogs"></i>
                    </a>
                </li>
                <li>
                    <a class="settings logout" href="?controller=access&action=logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>