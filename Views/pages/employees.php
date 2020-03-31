<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">    
    <link rel="stylesheet" href="./00_Front-end/css/home.css">
    <link rel="stylesheet" href="./00_Front-end/css/clients_employees_geral.css">
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" defer></script>
    <scritp src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js" defer></script>
    <script src="./00_Front-end/js/remove.js" defer></script>
    <script type="module" src="./00_Front-end/js/main.js" defer></script>
</head>
<body id="employees-page">
    <?php require("templates/main-nav.php"); ?>
    <header>
        <div class="container">
            <div>
                <form class="search-engine" method="POST" action="#">
                    <div>
                        <input type="text" name="search" placeholder="Search for employee...">
                        <button type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="option-buttons">
                <div class="create-employee">
                    <button class="form-btn">
                        Add Employee
                        <i class="fas fa-plus"></i>
                    </button>
                    <div id="add-employee" class="d-none">
                        <div class="container">
                            <header class="company-logo">
                                <h1>
                                    <a href="#">
                                        <img src="./Assets/imgs/logo.png" alt="Company Logo">
                                    </a>
                                    <span>Add your employee</span>
                                </h1>
                            </header>
                            <form method="POST" action="?controller=employees&action=createEmployee" enctype="multipart/form-data">
                                <div class="form-col-2">
                                    <div class="form-group">
                                        <label for="e-first-name">First name <sup>*</sup></label>
                                        <input type="text" class="form-control" name="firstName" id="e-first-name"/>
                                        <p class="empty-error-message empty-fname d-none">Required field...</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="e-last-name">Last name <sup>*</sup></label>
                                        <input type="text" class="form-control" name="lastName" id="e-last-name"/>
                                        <p class="empty-error-message empty-lname d-none">Required field...</p>
                                    </div>
                                </div>
                                <div class="form-email">
                                    <label for="e-email">Email <sup>*</sup></label>
                                    <input type="text" class="form-control" name="email" id="e-email"/>
                                    <p class="empty-error-message error-email d-none">Invalid Email...</p>
                                </div>
                                <div class="form-col-2">
                                    <div class="form-group">
                                        <label for="e-phone">Phone:</label>
                                        <input type="text" class="form-control" name="phone" id="e-phone"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="e-country">Country <sup>*</sup></label>
                                        <input type="text" class="form-control" name="country" id="e-country"/>
                                        <p class="empty-error-message empty-country d-none">Required field...</p>
                                    </div>
                                </div>
                                <div class="form-col-2">
                                    <div class="form-group">
                                        <label for="e-city">City <sup>*</sup></label>
                                        <input type="text" class="form-control" name="city" id="e-city" />
                                        <p class="empty-error-message empty-city d-none">Required field...</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="e-street">Street <sup>*</sup></label>
                                        <input type="text" class="form-control" name="street" id="e-street"/>
                                        <p class="empty-error-message empty-street d-none">Required field...</p>
                                    </div>
                                </div>
                                <div class="form-group form-date">
                                    <label for="e-birth-date">Birth Date</label>
                                    <select name="birth_day" class="b-day" aria-label="Day">
                                        <?php for($i = 1; $i <= 31; $i++) { ?>
                                            <option value="<?=$i?>"><?= $i < 10 ? "0".$i:$i ?></option>
                                        <?php } ?>
                                    </select>
                                    <select name="birth_month" class="b-month" aria-label="Month">
                                        <?php for($i = 1; $i <= 12; $i++) {?>
                                            <option value="<?=$i?>"><?= $i < 10 ? "0".$i:$i ?></option>
                                        <?php } ?>
                                    </select>
                                    <select name="birth_year" class="b-year" aria-label="Year">
                                        <?php for($i = date("Y")-100; $i <= date("Y"); $i++) {?>
                                            <option value="<?=$i?>"><?=$i?></option>
                                        <?php } ?>
                                    </select>
                                    <p class="empty-error-message error-birth-date d-none">Required field...</p>
                                </div>
                                <div class="form-col-2 employee-position-details">
                                    <div class="form-group">
                                        <label for="e-department">Department</label>
                                        <select name="department" id="e-department">
                                            <?php 
                                                if(!empty($departments)) {
                                                    foreach($departments as $department) {
                                                        echo "
                                                            <option value='".$department["name"]."'>".$department["name"]."</option>
                                                        ";
                                                    }
                                                } else {
                                                    echo "
                                                        <option value='Null'>N/A</option>
                                                    ";
                                                }
                                            ?>
                                        </select>
                                        <p class="empty-error-message empty-department d-none">Required field...</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="e-role">Role </label>
                                        <select name="role" id="e-role">
                                            <?php 
                                                if(!empty($roles)) {
                                                    foreach($roles as $role) {
                                                        echo "
                                                            <option value='".$role["name"]."'>".$role["name"]."</option>
                                                        ";
                                                    }
                                                } else {
                                                    echo "
                                                        <option value='Null'>N/A</option>
                                                    ";
                                                }
                                            ?>
                                        </select>
                                        <p class="empty-error-message empty-role d-none">Required field...</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="e-salary">Salary <sup>*</sup></label>
                                        <input type="text" class="form-control" name="salary" id="e-salary"/>
                                        <p class="empty-error-message empty-salary d-none">Required field...</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="e-picture">Foto de cliente:</label>
                                    <input type="file" class="" name="picture" id ="e-picture"/>
                                </div>
                                <div>
                                    <input type="hidden" name="employee"/>
                                    <?php if (empty($departments) || empty($roles)) { ?>
                                        <button type="submit" name="send" disabled="true" class="buttons-diabled">Create</button>
                                    <?php } else { ?>
                                        <button type="submit" name="send">Create</button>
                                    <?php } ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="filter-employee">
                    <button class="form-btn filter-button"> 
                        Filters
                        <img src="./Assets/imgs/filter-icon.png" alt="Filter icon">
                    </button>
                    <div id="filter-employee-form" class="d-none">
                        <form method="POST" action="#">
                            <div class="form-group">
                                <label for="department">Department</label>
                                <input type="text" name="department" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <input type="text" name="role" class="form-control">
                            </div>
                            <div class="form-group form-age">
                                <label for="salary">Salary</label>
                                <input type="number" name="salary" class="form-control" min="0" max= "120">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger btn-lg w-100 ml-2 mt-4 border-0 text-uppercase">Apply</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="change-cards-view">
                    <i class="fas fa-ruler-vertical"></i>
                    <select class="cards-size">
                        <option value="4">4</option>
                        <option value="6">6</option>
                        <option value="8">8</option>
                    </select>
                </div>
            </div>
        </div>
    </header>


    <main>
        <div class="container">
            
            <div id="employees" class="employee-6"></div> <!-- end emplyees -->


            <?php if(!empty($employees)) { ?>
                <div class="page-nav">
                    <i class="fas fa-arrow-circle-left previous-page"></i>
                    <div class="number-of-pages"></div>
                    <i class="fas fa-arrow-circle-right next-page"></i>
                </div>
            <?php } ?>
        </div> <!-- end container -->
    </main>
    
    <main>
    </main>    
</body>
</html>