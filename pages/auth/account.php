<div class="hero-scene text-center text-white">
    <div class="hero-scene-content">
        <h1 class="hero-scene-text">Mon compte</h1>
    </div>
</div>


<section>
    <nav class="navbar navbar-expand-lg bg-primary " data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin" data-show="admin">Tableau de bord Administrateur</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <a class="navbar-brand" href="/Blog" data-show="actif" >Tableau de bord </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item" data-show="admin">
                            <a class="nav-link" href="/spv">Liste des membres</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/liens">Liens Utiles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/calendrier">Calendrier des Gardes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/VideGrenier">Vide grenier</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/GalerieSPV">Gestion des Photos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Blog">Discussions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/pages/auth/reservation.php">Réservation fendeuse</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/forum/account.php">Mon Compte</a>
                        </li>
                    </ul>
                </div>
        </div>
    </nav>

</section>
<section class="admin-page">
    <article class="bg-white text-black">
        <div class="container p-4">
            <div class="page-title-container text-center">
                <h1 class="page-title"><i class="bi bi-person-badge me-3"></i>Mon Compte</h1>
                <div class="page-title-underline"></div>
            </div>
        </div>
    </article>
</section>
<br>

<!-- Liste des Mots de passe enregistrés-->
<section class="container">    
    <div class="row bg-arc-mint-green-light-staff py-3">
        <div class="card-list-employe mt-3">
            <h2 class="text-center text-primary admin">Vos Coordonnées</h2>

<br>
<form method="post">
    <label for="CAgent">Entrez votre Code Agent :</label>
    <input type="text" name="CAgent" id="CAgent" required>
    <button type="submit">Afficher les données</button>
</form>

            <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Code Agent</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                              <!--  <th>Code Agent</th> -->                                                   
                            </tr>
                        </thead>

                        
                       
<?php

include("connexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $CAgent = trim($_POST["CAgent"]);

    $stmt = $conn->prepare("SELECT NomInput, PrenomInput FROM Users WHERE CAgent = ?");
    $stmt->bind_param("s", $CAgent);
    $stmt->execute();
    $result = $stmt->get_result();



    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<p>CAgent reçu : $CAgent</p>";
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['CAgent']) . "</td>";
            echo "<td>" . htmlspecialchars($row['NomInput']) . "</td>";
            echo "<td>" . htmlspecialchars($row['PrenomInput']) . "</td>";
            //echo "<td>" . htmlspecialchars($row['CAgent']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Aucun résultat trouvé pour ce code agent.</td></tr>";
    }

    $stmt->close();
}
$conn->close();
?>

                    </table>
            </div>
        </div>
    </div>
</section>



<!-- Modification Adresse/Telephone  Ca fonctionne-->
    <div class="container"> <!-- Ca fonctionne-->
        <br>
        <h2 class="text-center text-primary admin"> Modification uniquement adresse et/ou numéro de téléphone</h2> <!-- Ca fonctionne-->
        <br>
        <form action="/pages/auth/modif_account.php" method="POST">
            <!--<div class="mb-3">
                <label for="ID">ID</label>
                <input type="text" class="form-control" id="ID" name="ID" placeholder="" required> 
            </div>-->
            <div class="mb-3">
                <label for="CAgent">Code Agent</label>
                <input type="text" class="form-control" id="CAgent" name="CAgent" placeholder="" required> 
            </div>
            <div class="mb-3">
              <label for="Adresse" class="form-label">Adresse</label>
              <input type="text" class="form-control" id="Adresse" placeholder="Adresse"  value="" name="Adresse">  
            </div>
            <div class="mb-3">
                <label for="Telephone" class="form-label">Téléphone</label>
                <input type="number" class="form-control" id="Telephone" placeholder="01.02.03.04.05"  value="" name="Telephone"> 
              </div>
              <!--<a> * non modifiable.</a>-->
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Valider vos informations</button>
            </div>
        </form>
        <!--<div class="text-center pt-3">
            <a href="/editPassword">Cliquez ici pour modifier votre mot de passe</a>
         </div>
         <div class="text-center pt-3">
            <a href="/infosPerso">Cliquez ici pour retrouver vos informations personnelles</a>
         </div>-->
    </div>
</section>


<!-- Ajout d'un nouveau Mot de Passe Ca Fonctionne-->
<section class="container">  <!-- Ca fonctionne -->               
            <div class="container mt-5 bg-arc-mint-green-light">
                <div class="card-header bg-arc-mint-green text-light">
                    <h2 class="text-center text-primary admin">Ajouter / modifier Vos Mots de passe</h2>  
                </div>                    
                    <form action="/pages/auth/gestion_AOutlook.php" method="POST">
                        <div class="row">
                           <!-- <div class="form-group">
                                    <label for="ID">ID</label>
                                    <input type="text" class="form-control" id="ID" name="ID" placeholder="" required>
                                </div>-->
                            <div class="col-md-4"> 
                                <div class="form-group">
                                    <label for="CAgent">Code Agent</label>
                                    <input type="text" class="form-control" id="CAgent" name="CAgent" placeholder="" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="Outlook" class="form-label">Outlook</label>
                                    <input type="text" class="form-control" id="Outlook" name="Outlook" value="" >                              
                                </div>                                                                                                                                                   
                            </div>
                        </div> 
                        <br>
                    
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                    <br><br>                               
                    </form>

                    

                    <form action="/pages/auth/gestion_AFirewall.php" method="POST">
                        <div class="row">
                            <!--<div class="form-group">
                                    <label for="ID">ID</label>
                                    <input type="text" class="form-control" id="ID" name="ID" placeholder="" required>
                                </div>-->
                            <div class="col-md-4"> 
                                <div class="form-group">
                                    <label for="CAgent">Code Agent</label>
                                    <input type="text" class="form-control" id="CAgent" name="CAgent" value="" >
                                </div>                               
                                <div class="form-group">
                                    <label for="Firewall" class="form-label">Firewall</label>
                                    <input type="text" class="form-control" id="Firewall" name="Firewall" value="" >
                                </div>                                                                                                                                                  
                            </div>
                        </div>  
                        <br>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                    <br><br>                                
                    </form>

                    

                    <form action="/pages/auth/gestion_AApis.php" method="POST">
                        <div class="row">
                           <!-- <div class="form-group">
                                    <label for="ID">ID</label>
                                    <input type="text" class="form-control" id="ID" name="ID" placeholder="" required>
                                </div>-->
                            <div class="col-md-4"> 
                                <div class="form-group">
                                    <label for="CAgent">Code Agent</label>
                                    <input type="text" class="form-control" id="CAgent" name="CAgent" value="" >
                                </div>
                                 <div class="form-group">
                                    <label for="Apis" class="form-label">Apis</label>
                                    <input type="text" class="form-control" id="Apis" name="Apis" value="" >
                                </div>                                                                                                                                                     
                            </div>
                        </div> 
                        <br>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        <br><br>                               
                    </form>                  
                                
                        
            </div>
            
                                  
                          
            
            
</section>



<section>
    <div class="container">
    <h2 class="text-center text-primary admin">Informations Personnelles</h2>
    <table>
        <tr>
            <th>Adresse</th>
            <th>Téléphone</th>
            <th>Adresse mail</th>
        </tr>
        <?php
        // Exemple de données personnelles
        include("connexion.php");

                $sql = "SELECT * FROM Users";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {

        // Affichage des données dans le tableau
        
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['Adresse']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Telephone']) . "</td>";
            echo "<td>" . htmlspecialchars($row['EmailInput']) . "</td>";
            echo "</tr>";
        }
    }
        ?>
    </table>

    <table>
        <tr>
            <th>Mot de passe Site web</th>
            <th>Mot de passe APIS</th>
            <th>Mot de passe FIREWALL</th>
            <th>Mot de passe OUTLOOK</th>
        </tr>

        <?php

        include("connexion.php");

                $sql = "SELECT * FROM securite_acces";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {

        // Affichage des données dans le tableau
        
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['PasswordInput']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Apis']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Firewall']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Outlook']) . "</td>";
            echo "</tr>";
                    }
                }
                $conn->close();
        ?>
</section>
    <br>
    <br>
    
        <h2 class="text-center text-primary admin">Vos mots de passes</h2>
    </div>



    