<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients</title>
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
<body id="clients-page">
    <?php require("templates/main-nav.php"); ?>
    <header>
        <div class="container">
            <div>
                <form class="search-engine se-client">
                    <div>
                        <input id="c-search" type="text" name="search" placeholder="Search for client...">
                        <input type="hidden" name="type" value="clientName">
                        <button type="button" id="c-search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="option-buttons">
                <div class="create-client">
                    <button class="form-btn">
                        Add Client
                        <i class="fas fa-plus"></i>
                    </button>
                    <div id="add-client" class="d-none">
                        <div class="container">
                            <header class="company-logo">
                                <h1>
                                    <a href="#">
                                        <img src="./Assets/imgs/logo.png" alt="Company Logo">
                                    </a>
                                    <span>Client Info</span>
                                </h1>
                            </header>
                            <form method="POST" action="?controller=clients&action=createClient" enctype="multipart/form-data">
                                <div class="form-col-2">
                                    <div class="form-group">
                                        <label for="c-first-name">First name <sup>*</sup></label>
                                        <input type="text" class="form-control" name="firstName" id="c-first-name"/>
                                        <p class="empty-error-message empty-fname d-none">Required field...</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="c-last-name">Last name <sup>*</sup></label>
                                        <input type="text" class="form-control" name="lastName" id="c-last-name"/>
                                        <p class="empty-error-message empty-lname d-none">Required field...</p>
                                    </div>
                                </div>
                                <div class="form-email">
                                    <label for="c-email">Email <sup>*</sup></label>
                                    <input type="email" class="form-control" name="email" id="c-email"/>
                                    <p class="empty-error-message error-email d-none">Invalid email...</p>
                                </div>
                                <div class="form-col-2">
                                    <div class="form-group">
                                        <label for="c-phone">Phone:</label>
                                        <input type="text" class="form-control" name="phone" id="c-phone"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="c-country">Country <sup>*</sup></label>
                                        <input type="text" class="form-control" name="country" id="c-country"/>
                                        <p class="empty-error-message empty-country d-none">Required field...</p>
                                    </div>
                                </div>
                                <div class="form-col-2">
                                    <div class="form-group">
                                        <label for="c-city">City <sup>*</sup></label>
                                        <input type="text" class="form-control" name="city" id="c-city"/>
                                        <p class="empty-error-message empty-city d-none">Required field...</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="c-street">Street <sup>*</sup></label>
                                        <input type="text" class="form-control" name="street" id="c-street"/>
                                        <p class="empty-error-message empty-street d-none">Required field...</p>
                                    </div>
                                </div>
                                <div class="form-group form-date">
                                        <label for="c-birthDate">Birth Date <sup>*</sup></label>
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
                                <div class="form-group">
                                    <label for="c-picture">Foto de cliente:</label>
                                    <input type="file" name="picture" id="c-picture"/>
                                </div>
                                <div>
                                    <input type="hidden" name="client">
                                    <button type="submit" name="send">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="filter-client">
                    <button class="form-btn filter-button">
                        Filters
                        <img src="./Assets/imgs/filter-icon.png" alt="Filter icon">
                    </button>
                    <div id="filter-client-form" class="d-none">
                        <form>
                            <div class="form-group">
                                <label for="c-f-country">Country</label>
                                <input type="text" name="country" class="form-control" id="c-f-contry">
                            </div>
                            <div class="form-group">
                                <label for="c-f-city">City</label>
                                <input type="text" name="city" class="form-control" id="c-f-city">
                            </div>
                            <div class="form-group">
                                <button type="button" id="c-filter-btn" class="btn btn-danger btn-lg w-100 ml-2 mt-4 border-0 text-uppercase">Apply</button>
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
    </header>


    <main>
        <div class="container">
            
            <div id="clients">
            </div><!-- end clients-->


            <?php if(!empty($clients)) { ?>
                <div class="page-nav">
                    <i class="fas fa-arrow-circle-left previous-page"></i>
                    <div class="number-of-pages"></div>
                    <i class="fas fa-arrow-circle-right next-page"></i>
                </div>
            <?php } ?>
        </div> <!-- end container -->
    </main>
     
</body>
</html>