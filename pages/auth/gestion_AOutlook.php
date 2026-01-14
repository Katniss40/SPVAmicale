<?php

// Utiliser le helper mysqli centralisé
require_once __DIR__ . '/../controleurs/db_mysqli.php';
$conn = $mysqli;

// Récuperer les données du formulaire
$CAgent = $_POST['CAgent'];
$Outlook = $_POST['Outlook'];

// Mettre à jour
$stmt = $conn->prepare("UPDATE Users SET Outlook = ? WHERE CAgent = ?");
$stmt->bind_param("si", $Outlook, $CAgent);

if ($stmt->execute()) {
    header('Location: /forum/account.php?CAgent=' . urlencode($CAgent) . '&success=1');
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

