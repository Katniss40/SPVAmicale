<?php
session_start();
    include("connexion.php");

    $sql= "INSERT INTO `Users`(`NomInput`, `PasswordInput`, `PrenomInput`, `Role`, `Adresse`, `Telephone`, `email`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]')";
    //$result = $conn->query($sql);

    // Redirection vers une autre page
        header("Location: /admin");
        exit();// Toujours utiliser exit après un header pour arrêter l'exécution du script




        try{
                $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $donnees = [
                    'id' => 0, 
                    'prenom' => 'Anna',
                    'nom' => 'Giraud', 
                    'age' => 16, 
                    'mail' => 'agird@gmail.com', 
                    //Retourne la date actuelle pour moi (GMT+2)
                    'date_ins' => date('Y-m-d G:i:s', time()+3600*2),
                ];
                //On utilise les requêtes préparées et des marqueurs nommés 
                $sth = $dbco->prepare(
                    "INSERT INTO users VALUES (:id, :prenom, :nom, :age, :mail, :date_ins)"
                );
                $sth->execute($donnees);
                echo 'Entrée ajoutée dans la table';
            }
                  
            catch(PDOException $e){
                echo "Erreur : " . $e->getMessage();
            }
?>
