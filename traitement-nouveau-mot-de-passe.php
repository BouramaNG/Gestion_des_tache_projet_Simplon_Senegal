<?php
require("configuration.php");
$nouveau_mot_de_passe = $_POST['nouveau_mot_de_passe'];
$nom_utilisateur = $_POST['nom_utilisateur'];




$query = $connection->prepare("UPDATE employe SET password = :nouveau_mot_de_passe WHERE utilisateur = :utilisateur");
$query->bindParam(':nouveau_mot_de_passe', $nouveau_mot_de_passe);
$query->bindParam(':utilisateur', $nom_utilisateur);
$query->execute();

echo "Mot de passe réinitialisé avec succès.";

$conn = null;
session_start();
session_destroy();

header("Location: inscription.php");
exit();
?>
