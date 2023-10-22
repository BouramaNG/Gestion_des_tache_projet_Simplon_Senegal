<?php
require_once("configuration.php");
session_start();
if ($_SERVER["REQUEST_METHOD"] === 'POST' && isset($_POST['ajouter_tache'])) {
    $titre = $_POST['titre'];
    $priorite = $_POST['priorite'];
    $etat = $_POST['etat'];
    $description = $_POST['description'];

    $id_utilisateur = $_SESSION['utilisateur_id'];
    $sql = "INSERT INTO taches (nom,description, priorite, etat, id_utilisateur,date_echeance) VALUES (:nom,:description, :priorite, :etat, :id_utilisateur,NOW())";
    $query = $connection->prepare($sql);
    $query->bindParam(':nom', $titre, PDO::PARAM_STR);
    $query->bindParam(':description', $description, PDO::PARAM_STR);
    $query->bindParam(':priorite', $priorite, PDO::PARAM_STR);
    $query->bindParam(':etat', $etat, PDO::PARAM_STR);
 
    $query->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);

    if ($query->execute()) {
        // header("Location: tableau_de_bord.php");
        echo "tache ajouter avec sucee";
    } else {
        $errorInfo = $query->errorInfo();
        echo "Une erreur s'est produite lors de l'ajout de la tâche.";
    }

}
$id_utilisateur = $_SESSION['utilisateur_id'];

$sql = "SELECT * FROM taches WHERE id_utilisateur = :id_utilisateur";
$query = $connection->prepare($sql);
$query->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
$query->execute();

$taches = $query->fetchAll(PDO::FETCH_ASSOC);
?>






<!DOCTYPE html>
<html>
<head>
    <!-- Styles CSS pour les cartes -->
    <style>
        .card {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
        }
        .tache{
            background-color: green;
            color: white;
            text-align: center;
        } 
        .body{  
        font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 500px;
            background-color: #fff;
          
            
            padding: 20px;
            margin: 0 auto;
            margin-top: 50px;
        }
        h2 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: bold;
            margin-bottom: 8px;
        }
        input[type="text"],
        select,
        textarea {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        select {
            width: 100%;
        }
        textarea {
            resize: none;
        }
        input[type="submit"] {
            background-color: green;
            color: #fff;
            border: none;
            padding: 10px 20px;
            width: 100px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .deconnexion {
            text-align: center;
            margin-top: 20px;
        }
        .deconnexion button {
            background-color: red;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        .deconnexion button:hover {
            background-color: #ff0000;
        }
    </style>
</head>
<body>
 
    <div class="tache">
    <h1>Gestions de mes taches</h1>
    <p><?php echo $_SESSION["utilisateur"]; ?></p>
    </div>
    
<div class="container">
<div class="deconnexion">
    <a href="deconnection.php">
        <button>Déconnexion</button>
    </a>
</div>
        <?php
   foreach ($taches as $tache) {
    echo '<div class="card">';
    echo '<h3>' . $tache['nom'] . '</h3>';
    echo '<p>' . $tache['description'] . '</p>';
    
    echo '<div style="display: flex; justify-content: space-between;">';
    echo '<p style="color: red;">Priorité : ' . $tache['priorite'] . '</p>';

    echo '<p style="color: green;">État : ' . $tache['etat'] . '</p>';

    echo '<a href="detail.php?id=' . $tache['id'] . '" style="background-color: green; color: white; padding: 5px 10px; text-decoration: none;">Voir Détails</a>';
    
    echo '</div>'; 
    
    echo '</div>';
}

    
        ?>


    <h2>Ajouter une Tâche</h2>
  
    <form method="post" action="">
        <label for="titre">Titre de la Tâche :</label>
        <input type="text" name="titre" required><br>
        
        <label for="priorite">Priorité :</label>
        <select name="priorite">
            <option value="basse">Basse</option>
            <option value="moyenne">Moyenne</option>
            <option value="haute">Haute</option>
        </select><br>

        <label for="etat">État :</label>
        <select name="etat">
            <option value="à faire">À Faire</option>
            <option value="en cours">En Cours</option>
            <option value="terminée">Terminée</option>
        </select><br>

        <label for="description">Description :</label>
        <textarea name="description" required></textarea><br>

        <input type="submit" name="ajouter_tache" value="Ajouter">
 
    </form>
    </div>
</body>
</html>
