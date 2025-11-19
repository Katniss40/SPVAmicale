<?php

// Connexion a la base de données
$servername = 'mysql-pompiers-leon.alwaysdata.net';
$username = '408942';
$password =  '@Admin-2025@';
$dbname = 'pompiers-leon_admin';

// créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if($conn->connect_error) {
    die("erreur de connexion: " .$conn->connect_error);
} 
echo "Connexion réussi!";

// Récuperer les données du formulaire
//$ID = $_POST['ID'];
$CAgent = $_POST['CAgent'];
$Outlook = $_POST['Outlook'];

// insere les données dans la base de données
//$sql = "UPDATE Users SET Adresse='$Adresse', Telephone='$Telephone' WHERE ID='$ID'";
$stmt = $conn->prepare("UPDATE Users SET Outlook = ? WHERE CAgent = ?");
$stmt->bind_param("si", $Outlook, $CAgent);
$stmt->execute();




if ($stmt->execute()) {
    header('Location: /forum/account.php');
    exit();
} else {
    echo "Erreur : " . $stmt->error;
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

