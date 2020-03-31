<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send message</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">    
    <link rel="stylesheet" href="./00_Front-end/css/home.css">
    <link rel="stylesheet" href="./00_Front-end/css/clients_employees_geral.css">
    <link rel="stylesheet" href="./00_Front-end/css/contact.css">
</head>
<body id="contact-page">
    <main>
        <div class="contact-person">
            <div class="contact-info">
                <div>
                    <div class="contact-name"><?=$person["name"]?></div>        
                    <div class="contact-picture">
                        <img src="./Assets/imgs/uploads/profilePictures/<?=$person["picture"]?>" alt="contact picture">
                    </div>        
                </div>
                <div class="close-message-modal">
                    <a href="?controller=<?=$_GET["origin"] === "clients" ? "clients":"employees"?>&page=<?php echo $_GET["origin"]?>"><i class="fas fa-times"></a></i>
                </div>
            </div>
            <div id="contact-person-form">
                <form method="post" action="contact-client.php">
                    <div>
                        <label for="m-title">Title</label>
                        <input type="text" name="title" id="m-title" required>
                    </div>
                    <div>
                        <label for="m-subject">Subject</label>
                        <input type="text" name="subject" id="m-subject" required>
                    </div>
                    <div>
                        <label for="m-message">Message</label>
                        <textarea name="message" id="m-message" required></textarea>
                    </div>
                    <div>
                        <input type="hidden" name="person_id" type="<?=$_GET["origin"]?>" value="<?=$person["person_id"]?>">
                        <button type="submit" name="send">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>