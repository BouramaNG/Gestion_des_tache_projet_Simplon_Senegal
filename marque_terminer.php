<?php
session_start();
require_once("configuration.php");

if (isset($_POST['marque_terminer'])) {
    $tache_id = $_POST['tache_id'];

    $sql = "UPDATE taches SET etat = 'Terminé' WHERE id = :id";
    $query = $connection->prepare($sql);
    $query->bindParam(':id', $tache_id, PDO::PARAM_INT);

    if ($query->execute()) {

        header("Location: GestionTache.php?id=$tache_id");
        exit();
    } else {
        echo "Erreur lors de la mise à jour de la tâche.";
    }
}
