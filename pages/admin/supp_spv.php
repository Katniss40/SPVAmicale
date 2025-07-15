<?php
// Connexion à la base de données

$servername = 'mysql-pompiers-leon.alwaysdata.net';
$username = '408942';
$password =  '@Admin-2025@';
$dbname = 'pompiers-leon_admin';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifier si un ID est fourni
if (isset($_GET['ID']) && is_numeric($_GET['ID'])) {
    $id = $_GET['ID'];

    // Préparer et exécuter la requête
    $stmt = $pdo->prepare("SELECT * FROM Users WHERE ID = :ID");
    $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);
    $stmt->execute();

    // Récupérer les résultats
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo "Informations trouvées :<br>";
        foreach ($result as $key => $value) {
            echo htmlspecialchars($key) . ": " . htmlspecialchars($value) . "<br>";
        }
    } else {
        echo "Aucune information trouvée pour l'ID fourni.";
    }
} else {
    echo "Veuillez fournir un ID valide.";
}


try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ID de l'entrée à supprimer
    $ID = $ID; // Remplacez par l'ID réel ou une variable dynamique

    // Requête SQL préparée
    $sql = "DELETE FROM Users WHERE ID = :ID";
    $stmt = $pdo->prepare($sql);

    // Liaison des paramètres
    $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);

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