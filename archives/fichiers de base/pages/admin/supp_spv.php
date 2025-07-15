<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'nom_de_la_base';
$username = 'utilisateur';
$password = 'mot_de_passe';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ID de l'entrée à supprimer
    $id = 123; // Remplacez par l'ID réel ou une variable dynamique

    // Requête SQL préparée
    $sql = "DELETE FROM nom_de_la_table WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    // Liaison des paramètres
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Exécution de la requête
    if ($stmt->execute()) {
        echo "L'entrée a été supprimée avec succès.";
    } else {
        echo "Erreur lors de la suppression de l'entrée.";
    }
} catch (PDOException $e) {
    echo "Erreur de connexion ou d'exécution : " . $e->getMessage();
}
?>