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
                            </tr>
                        </thead>                    
                      <?php
//include("connexion.php");
$conn = new mysqli("mysql-pompiers-leon.alwaysdata.net", "408942", "@Admin-2025@", "pompiers-leon_admin");



ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $CAgent = htmlspecialchars(trim($_POST["CAgent"]));

    $stmt = $conn->prepare("SELECT CAgent, NomInput, PrenomInput FROM Users WHERE CAgent = ?");
    $stmt->bind_param("s", $CAgent);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<p class='mt-3'>Code Agent recherché : <strong>" . htmlspecialchars($CAgent) . "</strong></p>";

    if ($result && $result->num_rows > 0) {
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['CAgent']) . "</td>";
            echo "<td>" . htmlspecialchars($row['NomInput']) . "</td>";
            echo "<td>" . htmlspecialchars($row['PrenomInput']) . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
    } else {
        echo "<tbody><tr><td colspan='3'>Aucun résultat trouvé pour ce code agent.</td></tr></tbody>";
    }

    $stmt->close();
}
$conn->close();
?>
                    
                </table>
            </div>




            <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Adresse</th>
                                <th>Téléphone</th>
                                                                                   
                            </tr>
                        </thead>                    
                      <?php
//include("connexion.php");
$conn = new mysqli("mysql-pompiers-leon.alwaysdata.net", "408942", "@Admin-2025@", "pompiers-leon_admin");

               

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $CAgent = htmlspecialchars(trim($_POST["CAgent"]));

    $stmt = $conn->prepare("SELECT Adresse, Telephone FROM Users WHERE CAgent = ?");
    $stmt->bind_param("s", $CAgent);
    $stmt->execute();
    $result = $stmt->get_result();

   // echo "<p class='mt-3'>Code Agent recherché : <strong>" . htmlspecialchars($CAgent) . "</strong></p>";

    if ($result && $result->num_rows > 0) {
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['Adresse']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Telephone']) . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
    } else {
        echo "<tbody><tr><td colspan='3'>Aucun résultat trouvé pour ce code agent.</td></tr></tbody>";
    }

    $stmt->close();
}
$conn->close();
?>
                    
                </table>
            </div>


            <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>MDP Site Amicale</th>
                                <th>MDP Apis</th>
                                <th>MDP Firewall</th>
                                <th>MDP Outlook</th>
                                                                                   
                            </tr>
                        </thead>                    
                      <?php
//include("connexion.php");
$conn = new mysqli("mysql-pompiers-leon.alwaysdata.net", "408942", "@Admin-2025@", "pompiers-leon_admin");

               

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $CAgent = htmlspecialchars(trim($_POST["CAgent"]));

    $stmt = $conn->prepare("SELECT PasswordInput, Apis, outlook, Firewall FROM Users WHERE CAgent = ?");
    $stmt->bind_param("s", $CAgent);
    $stmt->execute();
    $result = $stmt->get_result();

  //  echo "<p class='mt-3'>Code Agent recherché : <strong>" . htmlspecialchars($CAgent) . "</strong></p>";

    if ($result && $result->num_rows > 0) {
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['PasswordInput']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Apis']) . "</td>";
            echo "<td>" . htmlspecialchars($row['outlook']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Firewall']) . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
    } else {
        echo "<tbody><tr><td colspan='3'>Aucun résultat trouvé pour ce code agent.</td></tr></tbody>";
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







<!-- Liste des Mots de passe enregistrés-->
<section class="container">    
    <div class="row bg-arc-mint-green-light-staff py-3">
        <div class="card-list-employe mt-3">
            <h2 class="text-center text-primary admin">Vos Coordonnées</h2>
        <br><br>
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
                            </tr>
                        </thead>                    
                      <?php
//include("connexion.php");
$conn = new mysqli("mysql-pompiers-leon.alwaysdata.net", "408942", "@Admin-2025@", "pompiers-leon_admin");



ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $CAgent = htmlspecialchars(trim($_POST["CAgent"]));

    $stmt = $conn->prepare("SELECT CAgent, NomInput, PrenomInput FROM Users WHERE CAgent = ?");
    $stmt->bind_param("s", $CAgent);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<p class='mt-3'>Code Agent recherché : <strong>" . htmlspecialchars($CAgent) . "</strong></p>";

    if ($result && $result->num_rows > 0) {
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['CAgent']) . "</td>";
            echo "<td>" . htmlspecialchars($row['NomInput']) . "</td>";
            echo "<td>" . htmlspecialchars($row['PrenomInput']) . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
    } else {
        echo "<tbody><tr><td colspan='3'>Aucun résultat trouvé pour ce code agent.</td></tr></tbody>";
    }

    $stmt->close();
}
$conn->close();
?>
                    
                </table>
            </div>


<br><br><br>

            <div class="card-body">
                <h2 class="text-center text-primary admin">Informations Personnelles</h2>
                    <table class="table table-bordered">
                        <br><br>
                        <thead>
                            <tr>
                                <th>Adresse</th>
                                <th>Téléphone</th>
                                <th>Adresse mail</th>
                                                                                   
                            </tr>
                        </thead>                    
                      <?php
//include("connexion.php");
$conn = new mysqli("mysql-pompiers-leon.alwaysdata.net", "408942", "@Admin-2025@", "pompiers-leon_admin");

               

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $CAgent = htmlspecialchars(trim($_POST["CAgent"]));

    $stmt = $conn->prepare("SELECT Adresse, Telephone, EmailInput FROM Users WHERE CAgent = ?");
    $stmt->bind_param("s", $CAgent);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<p class='mt-3'>Code Agent recherché : <strong>" . htmlspecialchars($CAgent) . "</strong></p>";

    if ($result && $result->num_rows > 0) {
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['Adresse']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Telephone']) . "</td>";
            echo "<td>" . htmlspecialchars($row['EmailInput']) . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
    } else {
        echo "<tbody><tr><td colspan='3'>Aucun résultat trouvé pour ce code agent.</td></tr></tbody>";
    }

    $stmt->close();
}
$conn->close();
?>
                    
                </table>
            </div>

<br><br><br>
            <div class="card-body">
                <h2 class="text-center text-primary admin">Vos mots de passes</h2>
                    <table class="table table-bordered">
                        <br><br>
                        <thead>
                            <tr>
                                <th>MDP Site Amicale</th>
                                <th>MDP Apis</th>
                                <th>MDP Firewall</th>
                                <th>MDP Outlook</th>
                                                                                   
                            </tr>
                        </thead>                    
                      <?php
//include("connexion.php");
$conn = new mysqli("mysql-pompiers-leon.alwaysdata.net", "408942", "@Admin-2025@", "pompiers-leon_admin");

               

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $CAgent = htmlspecialchars(trim($_POST["CAgent"]));

    $stmt = $conn->prepare("SELECT PasswordInput, Apis, outlook, Firewall FROM Users WHERE CAgent = ?");
    $stmt->bind_param("s", $CAgent);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<p class='mt-3'>Code Agent recherché : <strong>" . htmlspecialchars($CAgent) . "</strong></p>";

    if ($result && $result->num_rows > 0) {
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['PasswordInput']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Apis']) . "</td>";
            echo "<td>" . htmlspecialchars($row['outlook']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Firewall']) . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
    } else {
        echo "<tbody><tr><td colspan='3'>Aucun résultat trouvé pour ce code agent.</td></tr></tbody>";
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

<br><br><br>
<section>
<!-- Modification Adresse/Telephone  Ca fonctionne-->
    <div class="container"> <!-- Ca fonctionne-->
        <br>
        <h2 class="text-center text-primary admin"> Modification uniquement adresse et/ou numéro de téléphone</h2> <!-- Ca fonctionne-->
        <br><br><br>
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
                <br><br><br>                 
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