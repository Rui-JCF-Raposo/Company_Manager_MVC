<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link type="text/css" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"> 
    <link type="text/css" rel="stylesheet" href="./00_Front-end/css/home.css">
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" defer></script>
    <scritp src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js" defer></script>
    <script type="module" src="./00_Front-end/js/main.js" defer></script>
</head>
<body id="home-page">
    <?php require("templates/main-nav.php"); ?>
    
    <main>
        <div>
            <img src="./Assets/imgs/showcase.jpg" alt="Showcase image">
        </div>
        
        <div class="showcase-slogan">
            <h1><?= $company["name"] ?></h1>
            <span>Manage your company here!</span>
        </div>

        <div class="container">
            <div class="manager-section">
                <div>
                    <ul class="manage-main-btns">
                        <li class="manage-departments mb-4">
                            <div>
                                <button class="form-btn add-departments-btn"><h2>Add Departments</h2></button>
                            </div>
                            <div class="departments-modal">
                                <div id="add-departments-form" class="p-5 rounded">
                                    <div>
                                        <form method="post" action="?controller=company&action=createDepartment">
                                            <div class="d-flex align-items-center">
                                                <div class="form-group d-flex align-items-center w-100 mb-0">
                                                    <label for="department-name" class="mr-4">Name: </label>
                                                    <input id="department-name" type="text" name="department" class="form-control p-4 font-weight-light">
                                                </div>
                                                <div class="ml-5">
                                                    <button type="submit" name="send">Add</button>
                                                </div>
                                            </div>
                                            <p class="m-empty-message empty-m-department d-none">Name Required...</p>
                                        </form>
                                        <p class="m-empty-message m-department-repeat d-none">Department already exist...</p>
                                    </div>
                                </div>
                                <?php if(!empty($departments)) { ?>
                                    <div id="departments-list">
                                        <ul>
                                            <?php foreach($departments as $department) { ?>
                                                <li class="position-relative">
                                                    <?=$department["name"]?>
                                                    <i class="far fa-trash-alt position-absolute" data-departemnt_id="<?=$department["department_id"]?>"></i>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                <?php } else { ?>
                                    <span class="m-empty-warning">There are no departments...</span>
                                <?php } ?>
                            </div>
                        </li>
                        <li class="manage-services mb-4">
                            <div>
                                <button class="form-btn add-services-btn"><h2>Add Services</h2></button>
                            </div>
                            <div class="services-modal">
                                <div id="add-services-form" class="p-5 rounded">
                                    <div>
                                        <form method="post" action="?controller=company&action=createCompanyService">
                                            <div class="d-flex align-items-center">
                                                <div class="form-group d-flex align-items-center w-100 mb-0">
                                                    <label for="service-name" class="mr-4">Name: </label>
                                                    <input id="service-name" type="text" name="service" class="form-control p-4 font-weight-light">
                                                </div>
                                                <div class="ml-5">
                                                    <button type="submit" name="send">Add</button>
                                                </div>
                                            </div>
                                            <p class="m-empty-message empty-m-service d-none">Name Required...</p>
                                        </form>
                                        <p class="m-empty-message m-service-repeat d-none">Service already exist...</p>
                                    </div>
                                </div>
                                <?php if(!empty($companyServices)) { ?>
                                    <div id="services-list">
                                        <ul>
                                            <?php foreach($companyServices as $companyService) { ?>
                                                <li class="position-relative">
                                                    <?=$companyService["name"]?>
                                                    <i class="far fa-trash-alt position-absolute" data-company_service_id="<?=$companyService["company_service_id"]?>"></i>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                <?php } else { ?>
                                    <span class="m-empty-warning">There are no services...</span>
                                <?php } ?>
                            </div>
                        </li>
                        <li class="manage-roles mb-4">
                            <div>
                                <button class="form-btn add-roles-btn"><h2>Add Roles</h2></button>
                            </div>
                            <div class="roles-modal">
                                <div id="add-roles-form" class="p-5 rounded">
                                    <div>
                                        <form method="post" action="?controller=company&action=createRole" class="d-block align-items-center">
                                        <div class="form-group d-flex align-items-center flex-column w-100 mb-0">
                                            <label for="role-name" class="mb-3 text-left w-100">Name: </label>
                                            <input id="role-name" type="text" name="role" class="form-control p-4 font-weight-light">
                                        </div>
                                        <div class="form-group d-flex align-items-center flex-column w-100 mb-0">
                                            <label for="role-name" class="mr-4 ml-3 mb-3 mt-4 text-left w-100">Department: </label>
                                            <select name="department_id" class="form-control">
                                                <?php 
                                                        if(!empty($departments)) {
                                                            foreach($departments as $department) {
                                                                echo "<option value='".$department["department_id"]."'>".$department["name"]."</option>";
                                                            }
                                                        } else {
                                                            echo "<option value='0'>N/A (Add at least one)</option>";
                                                        }
                                                        ?>
                                                </select>
                                            </div>
                                            <div class="mt-5">
                                                <?php if(!empty($departments)) { ?>
                                                    <button type="submit" name="send">Add</button>
                                                <?php } else { ?>
                                                    <button type="submit" name="send" disabled class="btn-disabled">Add</button>
                                                <?php } ?>
                                            </div>
                                        </form>
                                        <p class="m-empty-message empty-m-role w-100 d-none">Name Required...</p>
                                        <p class="m-empty-message m-role-repeat d-none">Role already exist...</p>
                                    </div>
                                </div>
                                <?php if(!empty($roles)) { ?>
                                    <div id="roles-list">
                                        <ul>
                                            <?php foreach($roles as $role) { ?>
                                                <li class="position-relative">
                                                    <?=$role["name"]?>
                                                    <i class="far fa-trash-alt position-absolute" data-role_id="<?=$role["role_id"]?>"></i>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                <?php } else { ?>
                                    <span class="m-empty-warning">There are no roles...</span>
                                <?php } ?>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <div id="add-services-form"></div>
                
                <div id="add-roles-form"></div>   
            </div>

        </div>
    </main>

</body>
</html>