<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Manager</title>
    <link type="text/css" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">    
    <link rel="stylesheet" href="./00_Front-end/css/register_login.css">
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" defer></script>
    <scritp src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js" defer></script>
    <script src="./00_Front-end/js/register_login.js" defer></script>
    <script type="module" src="./00_Front-end/js/main.js" defer></script>
</head>
<body id="index-page">
    <div class="container">
        <div class="enter-options mt-5 mb-5">
            <button class="form-btn register-btn btn">
                Register Company
                <i class="fas fa-plus"></i>
            </button>
            <button class="form-btn login-btn btn btn-active">
                Login
                <i class="fas fa-minus"></i>
            </button>
        </div>
        <div id="register" class="mt-3 mb-5 d-none">
            <h1>Register your company</h1>
            <form method="post" action="?controller=access&action=register">
                <div class="form-group">
                    <label for="r-name">Name <sup>*</sup></label>
                    <input type="text" name="name" id="r-name" class="form-control">
                    <p class="error-message empty-company-name d-none">Required Field...</p>
                </div>
                <div class="r-form-col-2">
                    <div class="form-group">
                        <label for="r-email">Email <sup>*</sup></label>
                        <input type="email" name="email" id="r-email" class="form-control">
                        <p class="error-message error-r-email d-none">Required Field...</p>
                    </div>
                    <div class="form-group">
                        <label for="r-password">Password <sup>*</sup></label>
                        <input type="password" name="password" id="r-password" class="form-control">
                        <p class="error-message empty-password d-none">Required Field...</p>
                    </div>
                    <div class="form-group">
                        <label for="r-password">Repeat your Password <sup>*</sup></label>
                        <input type="password" name="rep-password" id="r-rep-password" class="form-control">
                        <p class="error-message empty-rep-password d-none">Required Field...</p>
                        <p class="error-message error-passwword d-none">Passwords don't match...</p>
                    </div>
                </div>
                <div class="r-form-col-2">
                    <div class="form-group">
                        <label for="r-phone">Phone (Optional)</label>
                        <input type="text" name="phone" id="r-phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="r-industry">Industry <sup>*</sup></label>
                        <input type="text" name="industry" id="r-industry" class="form-control">
                        <p class="error-message empty-industry d-none">Required Field...</p>
                    </div>
                </div>
                <div class="r-form-col-2">
                    <div class="form-group">
                        <label for="r-security-question">Security Question? (Optional)</label>
                        <input type="text" name="question" id="r-security-question" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="r-security-answer">Security Answer (Optional)</label>
                        <input type="text" name="answer" id="r-security-answer" class="form-control">
                    </div>
                </div>
                <div>
                    <button type="submit" name="send" class="mt-3">Register</button>
                </div>
            </form>
        </div>
        <div id="login" class="mt-4">
            <h1>Login</h1>
            <form method="post" action="?controller=access&action=login" class="mt-4">
                <div class="form-group">
                    <label for="l-email">Email</label>
                    <input type="email" name="email" id="l-email" class="form-control">
                    <p class="error-message error-email d-none">Invalid email...</p>
                </div>
                <div class="form-group">
                    <label for="l-password">Password</label>
                    <input type="password" name="password"  id="l-password" class="form-control">
                    <p class="error-message empty-l-password d-none">Required Field....</p>
                </div>
                <div>
                    <p class="error-message user-inixistente <?= isset($_GET["loginInvalid"]) ? "":"d-none"?>">This account don't exist...</p>
                    <button type="submit" name="send" class="mt-4">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>