<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link type="text/css" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"> 
    <link type="text/css" rel="stylesheet" href="./00_Front-end/css/home.css">
    <link rel="stylesheet" href="./00_Front-end/css/clients_employees_geral.css">
    <link rel="stylesheet" href="./00_Front-end/css/services.css">
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" defer></script>
    <scritp src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js" defer></script>
    <script type="module" src="./00_Front-end/js/main.js" defer></script>
</head>
<body id="services-page">
    <?php require("templates/main-nav.php");?>

    <div class="container">

        <header class="services-header">
            <div>
                <button class="form-btn add-service-btn">
                    Add Service
                    <i class="fas fa-plus"></i>
                    <i class="fas fa-briefcase"></i>
                </button>
                <div class="create-service-container d-none">
                    <form method="post" action="?controller=company&action=createService">
                        <div class="form-col-2">
                            <div>
                                <label for="client">Client</label>
                                <select name="client">
                                    <?php 
                                        if(!empty($clients)) {
                                            foreach($clients as $client) {
                                                echo "
                                                    <option value='".$client["client_id"]."'>".$client["firstName"]." ".$client["lastName"]."</option>
                                                ";
                                            }
                                        } else {
                                            echo "
                                                <option value='Null'>N/A</option>
                                            ";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label for="employee">Sales Employee</label>
                                <select name="employee">
                                    <?php 
                                        if(!empty($employees)) {
                                            foreach($employees as $employee) {
                                                echo "
                                                    <option value='".$employee["employee_id"]."'>".$employee["firstName"]."".$employee["lastName"]."</option>
                                                ";
                                            }
                                        } else {
                                            echo "
                                                <option value='Null'>N/A</option>
                                            ";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-col-2">
                            <div>
                                <label for="service">Service</label>
                                <select name="service">
                                    <?php 
                                        if(!empty($companyServices)) {
                                            foreach($companyServices as $companyService) {
                                                echo "
                                                    <option value='".$companyService["company_service_id"]."'>".$companyService["name"]."</option>
                                                ";
                                            }
                                        } else {
                                            echo "
                                                <option value='Null'>N/A</option>
                                            ";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label for="service-date">Service Start Date</label>
                                <input type="date" name="service-date">
                            </div>
                        </div>
                        <div class="form-col-2">
                            <div class="form-price">
                                <label for="service-price">Service Price</label>
                                <input type="number" name="service-price" min="1">
                            </div>
                            <div>
                                <?php if(empty($companyServices) || empty($clients) || empty($employees)) { ?>
                                    <button class="add-service buttons-diabled" disabled="true">Add</button>
                                <?php } else { ?>
                                    <button class="add-service">Add</button>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div id="filter-service">
                <button class="filter-service-btn">
                    Filter Service
                    <img src="./Assets/imgs/filter-icon.png" alt="Filter icon">
                </button>
                <div class="form-btn filter-service-container d-none">
                    <form id="filter-service-form" method="post" action="orders.php">
                        <div class="form-group">
                            <label for="client-name">Client Name</label>
                            <input type="text" name="client-name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="employee-name">Employee Name</label>
                            <input type="text" name="employee-name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="service">Service</label>
                            <select name="service" class="form-control">
                                <option value="">Repair Computer</option>
                                <option value="">Repair Mobile Phone</option>
                                <option value="">Home Service</option>
                                <option value="">Create Website</option>
                                <option value="">Create Desktop App</option>
                                <option value="">Create Mobile App</option>
                            </select>
                        </div>
                        <div>
                            <button type="button" class="apply-service-btn">Apply</button>
                        </div>
                    </form>
                </div>
            </div>
        </header>

        <main>
            <div class="services">
                <table id="services-table">
                    <tr>
                        <th>Client</th>
                        <th class="employee-col">Sales Employee</th>
                        <th>Service</th>
                        <th>Service Start Date</th>   
                        <th>Service Price</th>
                        <th>Remove Service</th>
                    </tr>
                    <tr>
                        <td>Maria Benevides</td>
                        <td class="employee-col">Tiago Mendonça</td>
                        <td>Repair Desktop</td>
                        <td>2020-3-2</td>
                        <td>150€</td>
                        <td>
                            <i class="fas fa-trash-alt remove-service"></i>    
                        </td>
                    </tr>
                    <tr>
                        <td>Rui Raposo</td>
                        <td class="employee-col">José Martins</td>
                        <td>Repair Computer</td>
                        <td>2020-02-10</td>
                        <td>400€</td>
                        <td>
                            <i class="fas fa-trash-alt remove-service"></i>    
                        </td>
                    </tr>
                    <tr>
                        <td>José Afonso</td>
                        <td class="employee-col">José Martins</td>
                        <td>Repair Computer</td>
                        <td>2020-02-10</td>
                        <td>320€</td>
                        <td>
                            <i class="fas fa-trash-alt remove-service"></i>    
                        </td>
                    </tr>
                    <tr>
                        <td>Cristiano Almeida</td>
                        <td class="employee-col">Tiago Mendonça</td>
                        <td>Create Website</td>
                        <td>2020-02-7</td>
                        <td>3400€</td>
                        <td>
                            <i class="fas fa-trash-alt remove-service"></i>    
                        </td>
                    </tr>
                </table>
            </div>
        </main>

    </div>
</body>
</html>