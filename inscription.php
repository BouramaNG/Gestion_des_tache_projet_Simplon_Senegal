<?php
session_start();
require_once("configuration.php");
require_once("authentification.php");

$erreurUser = $erreurEmail = $erreurPassword = $erreurConfirmPassword = "";
$valueUser = $valueEmail = $valuePassword = $valueConfirmPassword = "";

check();

if (isset($_POST["inscription"])) {
    $nomutilisateur = $_POST["utilisateur"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmepassword = $_POST["confirmepassword"];

    $sql = "SELECT * FROM employe WHERE utilisateur = :utilisateur";
    $query = $connection->prepare($sql);
    $query->bindValue(":utilisateur", $nomutilisateur);
    $query->execute();
    $existingUser = $query->fetch();

    if ($existingUser) {
        $erreurUser = "Ce nom d'utilisateur est déjà utilisé. Veuillez en choisir un autre.";
    }


    $sql = "SELECT * FROM employe WHERE email = :email";
    $query = $connection->prepare($sql);
    $query->bindValue(":email", $email);
    $query->execute();
    $existingEmail = $query->fetch();

    if ($existingEmail) {
        $erreurEmail = "Cet email est déjà enregistré. Veuillez utiliser un autre email.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurEmail = "Adresse e-mail invalide.";
    }

    if (strlen($password) < 7 || !preg_match("/[A-Z]/", $password) || !preg_match("/[a-z]/", $password) || !preg_match("/[0-9]/", $password) || !preg_match("/[^a-zA-Z0-9]/", $password)) {
        $erreurPassword = "Le mot de passe doit contenir au moins 7 caractères, une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.";
    }

    if ($password !== $confirmepassword) {
        $erreurConfirmPassword = "Les mots de passe ne correspondent pas.";
    }

    if (empty($erreurUser) && empty($erreurEmail) && empty($erreurPassword) && empty($erreurConfirmPassword)) {
        $sql = "INSERT INTO employe (utilisateur, email, password) VALUES (:utilisateur, :email, :password)";
        $boura = $connection->prepare($sql);
        $boura->bindValue(":utilisateur", $nomutilisateur);
        $boura->bindValue(":email", $email);
        $boura->bindValue(":password", $password);

        if ($boura->execute()) {
            echo "Merci, l'inscription a été effectuée avec succès !";
        } else {
            echo "Oups, quelque chose s'est mal passé : " . $boura->errorInfo()[2];
        }
    }
}

if (isset($_POST["connexion"])) {
    $nomutilisateur = $_POST["utilisateur"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM employe WHERE utilisateur = :utilisateur";
    $boura = $connection->prepare($sql);
    $boura->bindValue(":utilisateur", $nomutilisateur);
    $boura->execute();
    $utilisateur = $boura->fetch();

    if ($utilisateur && $password ===$utilisateur['password']) {
        $_SESSION['utilisateur_id'] = $utilisateur['idE'];
        $_SESSION['utilisateur'] = $utilisateur['utilisateur'];

        header("location: GestionTache.php");
        exit();
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>




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
        .error{
            color: red;
            font-size: 10px;
        }
        .boura{
            display: flex;
            justify-content: space-between;
        }
        .container{
            width: 45%;
        }
    </style>

</head>

<body>
    <div class="boura">
    <div class="container">
        <div class="col1">
        </div>
        <div class="col2">
            <div class="row1">
                <h3>Bonjours</h3>
                <p>Bienvenue sur votre page inscription</p>
            </div>
            <div class="row2">
                <form action="" method="post">
                <div>
                        <span><i class="fas fa-user"></i></span>
                        <input type="text" id="email" name="utilisateur" placeholder="Entrer votre nom complete" required value=""/>
                        <p class="error"><?php echo $erreurUser?></p>
                    </div>
                    <div>
                        <span><i class="fas fa-envelope"></i></span>
                        <input type="email" id="email" name="email" placeholder=" Email Address" required value=""/>
                        <p class="error"><?php echo $erreurEmail?></p>
                    </div>
                    
                    <div>
                        <span><i class="fa-solid fa-lock"></i></span>
                        <input type="password" id="pass" name="password" placeholder=" Password" required value=""/>
                        <p class="error"><?php echo $erreurPassword?></p>
                    </div>
                    <div>
                        <span><i class="fa-solid fa-lock"></i></span>
                        <input type="password" id="pass" name="confirmepassword" placeholder=" Password" required value=""/>
                        <p class="error"><?php echo $erreurConfirmPassword?></p>
                    </div>
                    <input type="submit" value="Inscription" name="inscription">
                   
                </form>
            </div>
        </div>
    </div>




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
                        <input type="text" id="email" name="utilisateur" placeholder="Veuillez entre votre Nom utilisateur" required/>
                    </div>
                    <div>
                        <span><i class="fa-solid fa-lock"></i></span>
                        <input type="password" id="pass" name="password" placeholder=" Password" required/>
                    </div>
                    <input type="submit" value="Connexion" name="connexion">
                    <p class="hint-text"><a href="reinitialiser.php">Mot de passe oublie?</a></p>

                </form>
                
            </div>
        </div>
    </div>
    </div>
</body>
</html>