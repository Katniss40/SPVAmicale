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
$CAgent = $_POST['CAgent'];
$Adresse = $_POST['Adresse'];
$Telephone = $_POST['Telephone'];

// insere les données dans la base de données
//$sql = "UPDATE Users SET Adresse='$Adresse', Telephone='$Telephone' WHERE ID='$ID'";
$stmt = $conn->prepare("UPDATE Users SET Adresse = ?, Telephone = ? WHERE CAgent = ?");
$stmt->bind_param("ssi", $Adresse, $Telephone, $CAgent);
$stmt->execute();


if ($stmt->execute()) {
    header('Location: /account');
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
