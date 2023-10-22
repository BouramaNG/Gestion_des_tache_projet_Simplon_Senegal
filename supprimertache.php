<?php
session_start();
require_once("configuration.php");

if (isset($_POST['supprimer_tache'])) {
    $tache_id = $_POST['tache_id'];

    $sql = "DELETE FROM taches WHERE id = :id";
    $query = $connection->prepare($sql);
    $query->bindParam(':id', $tache_id, PDO::PARAM_INT);

    if ($query->execute()) {
        header("Location: GestionTache.php");
        exit();
    } else {
        echo "Erreur lors de la suppression de la tâche.";
    }
}
