<?php

// Utiliser le helper mysqli centralisé
require_once __DIR__ . '/../controleurs/db_mysqli.php';
$conn = $mysqli;

// Récuperer les données du formulaire
//$ID = $_POST['ID'];
$Code_Agent = $_POST['CAgent'];
$Firewall = $_POST['Firewall'];

// Mettre à jour
$stmt = $conn->prepare("UPDATE Users SET Firewall = ? WHERE CAgent = ?");
$stmt->bind_param("si", $Firewall, $Code_Agent);

if ($stmt->execute()) {
    header('Location: /forum/account.php?CAgent=' . urlencode($Code_Agent) . '&success=1');
    exit();
} else {
    echo "Erreur : " . htmlspecialchars($stmt->error);
}

//if($conn->query($sql) === TRUE) {
    //echo "Entrée enregistrée avec succés"
  // header('Location: /spv');
  //exit();
//} else {
   //  echo "Erreur : " .$sql."<br>" .$conn->error;
//}

// fermer la connexion
$conn->close();

?>

