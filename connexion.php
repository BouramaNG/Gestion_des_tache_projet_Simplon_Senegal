<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        $pageTitle = "Employee Login"; // Set the custom title for this page
        $cssFileName = "css/login.css";
        include "head.php"; // Include the common head section
    ?>
    <style>
        .container .col1 {
            background-image: url("images/employeeLogin.png");
        }
    </style>
</head>

<body>
    
    <div class="container">
        <div class="col1">
        </div>
        <div class="col2">
            <div class="row1">
                <h3>Bonjours</h3>
                <p>Veuillez vous connecter sur votre compte</p>
            </div>
            <div class="row2">
                <form action="" method="post">
                    <div>
                        <span><i class="fas fa-envelope"></i></span>
                        <input type="email" id="email" name="email" placeholder=" Email Address" required/>
                    </div>
                    <div>
                        <span><i class="fa-solid fa-lock"></i></span>
                        <input type="password" id="pass" name="password" placeholder=" Password" required/>
                    </div>
                    <input type="submit" value="Connexion" name="connexion">
                    <p class="hint-text"><a href="#">Mot de passe oublie?</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>