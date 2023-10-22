<?php
session_start();
require_once("configuration.php");
// Le reste de votre code pour récupérer les détails de la tâche

?>

<!DOCTYPE html>
<html>
<head>

    <style>
       .details {
    border: 1px solid #ccc;
    padding: 10px;
    margin: 10px;
    width: 30%;
    margin: 0 auto; /* Ajoutez cette ligne pour centrer horizontalement le conteneur */
    display: block; /* Assurez-vous que le conteneur est rendu en tant que bloc */
}

        .tache{
            background-color: green;
            color: white;
            text-align: center;
        }
        .terminer{
            background-color: red;
            color: white;
            padding: 10px;
            border: none;
        }
        .supprimer{
            background-color: green;
            color: white;
            margin-left: 10px;
            padding: 10px;
            border: none;
        }
        .button-container {
    display: flex;
    justify-content: center;
    margin-top: 10px;
    align-items: center;
}
.retour{
    text-align: center;
}
    </style>
</head>
<body>
    <?php
    $tache_id = $_GET['id'];

    $sql = "SELECT * FROM taches WHERE id = :id";
    $query = $connection->prepare($sql);
    $query->bindParam(':id', $tache_id, PDO::PARAM_INT);
    $query->execute();

    $tache = $query->fetch(PDO::FETCH_ASSOC);
    ?>
<div class="tache">
<h1>Detail : <?php echo $tache['nom']; ?></h1>
</div>
    <div class="details">
        <p>Titre : <?php echo $tache['nom']; ?></p>
        <p>Description : <?php echo $tache['description']; ?></p>
        <p>Priorité : <?php echo $tache['priorite']; ?></p>
        <p>État : <?php echo $tache['etat']; ?></p>

        <p>Connecté en tant que : <?php echo $_SESSION['utilisateur']; ?></p>

        <div class="button-container">
    <form method="post" action="marque_terminer.php">
        <input type="hidden" name="tache_id" value="<?php echo $tache_id; ?>">
        <input class="terminer" type="submit" name="marque_terminer" value="Marquer comme Terminé">
    </form>

    <form method="post" action="supprimertache.php">
        <input type="hidden" name="tache_id" value="<?php echo $tache_id; ?>">
        <input class="supprimer" type="submit" name="supprimer_tache" value="Supprimer">
       
    </form>
    
</div>
<div class="retour">
    <a href="GestionTache.php">Retour a la Gestion des tache</a>
    </div>
    </div>
</body>
</html>
