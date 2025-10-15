<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Notre Forum de discussion</title>
	<style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    .navbar {
      background-color: #333;
      overflow: hidden;
    }

    .navbar a {
      float: left;
      display: block;
      color: #f2f2f2;
      text-align: center;
      padding: 14px 20px;
      text-decoration: none;
    }

    .navbar a:hover {
      background-color: #ddd;
      color: black;
    }

	.hero-scene{
      position: relative;
      &::before{
          content:"";
          position: absolute;
          top:-80px;
          left:0;
          width:100%;
          height:170%;
          background-image: url(../Images/groupe2023.jpg);
          background-size: cover;
          filter: brightness(0.6);
      }

      *{

          position:relative;
      }

      .hero-scene-text{
        align-items: center;
        margin-top: 90px;
      }
      
.hero-scene-content{
          height: 300px;
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;
      }
  }

footer.footer{
  padding-top: 50px;
  height: 50px;  

  bottom: 0;
  width: 100%;  
}

table {
  width: 50%;
  border-collapse: collapse;
  margin: 20px auto;
}

th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #f2f2f2;
}

.form-label{
  color: #2E7D32;
}

label {
    display: inline-block;
}
.mt-3 {
    color: #2E7D32; 
    text-align: left; 
    width: 1300px;
    margin: 20px 175px; 
    border-collapse: collapse;
    }

h2 {
    font-size: 30px;;
}

.btn {
    border-radius: 5px; 
    background-color: #2E7D32; 
    color: #F5E6CC; 
    padding: 10px 15px; 
    text-decoration: none; 
    width: 100px; 
    margin: auto  175px;
}

	</style>
</head>


<body style="background-color: #F5E6CC"></body>

<header>
<div class="hero-scene text-center text-white">
    <div class="hero-scene-content">
        <h1 style="color: white;" class="hero-scene-text">Mon compte</h1>
    </div>
</div>
<br><br><br><br><br><br><br>

    <nav>
        
        <div class="navbar" style="background-color: #2E7D32;">  
            <a class="navbar-brand" href="/Blog" >Tableau de bord </a>
            
                <span class="navbar-toggler-icon"></span>
            </button>          
                            <a class="nav-link" href="/liens">Liens Utiles</a>
                            <a class="nav-link" href="/calendrier">Calendrier des Gardes</a>
                            <a class="nav-link" href="/VideGrenier">Vide grenier</a>
                            <a class="nav-link" href="/GalerieSPV">Gestion des Photos</a>
                            <a class="nav-link" href="/Blog">Discussions</a>
                            <a class="nav-link" href="/forum/account.php">Mon Compte</a>                
        </div>
    </nav>


<br><br>
</header>


<!-- Liste des Mots de passe enregistrés-->
<section class="container">    
    <div class="row bg-arc-mint-green-light-staff py-3">
        <div class="card-list-employe mt-3">
            <h2 style="color: #2E7D32; text-align: center; border-width: 2px; border-style: solid; border-color: rgb(196, 29, 29); background-color: rgb(227, 227, 227);width: 1300px; border-collapse: collapse;" class="text-center text-primary admin">Vos Coordonnées</h2>
        <br><br>
            <div style="color: #2E7D32; text-align: left; width: 1300px;margin: 20px 175px; border-collapse: collapse;" class="text-center text-primary admin">
            <form method="post">
                <label for="CAgent">Entrez votre Code Agent :</label>
                <input type="text" name="CAgent" id="CAgent" required>
                <button type="submit">Afficher les données</button>
            </form>
            </div>
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

        <div class="container">
            <div class="card-body">
                <h2 style="color: #2E7D32; text-align: center; border-width: 2px; border-style: solid; border-color: rgb(196, 29, 29); background-color: rgb(227, 227, 227);width: 1300px; border-collapse: collapse;" class="text-center text-primary admin">Informations Personnelles</h2>
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

    //echo "<p class='mt-3'>Code Agent recherché : <strong>" . htmlspecialchars($CAgent) . "</strong></p>";

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
        </div>

<br><br><br>

        <div class="container">
            <div class="card-body">
                <h2 style="color: #2E7D32; text-align: center; border-width: 2px; border-style: solid; border-color: rgb(196, 29, 29); background-color: rgb(227, 227, 227);width: 1300px; border-collapse: collapse;" class="text-center text-primary admin">Vos mots de passes</h2>
                    <table class="table table-bordered">
                        <br><br>
                        <thead>
                            <tr>
                                <th>MDP Site Amicale</th>
                                <th>MDP Apis</th>
                                <th>MDP Outlook</th>
                                <th>MDP Firewall</th>
                                                                                   
                            </tr>
                        </thead>                    
                    <?php
                        include("connexion.php");
                        //$conn = new mysqli("mysql-pompiers-leon.alwaysdata.net", "408942", "@Admin-2025@", "pompiers-leon_admin");
                                    

                        ini_set('display_errors', 1);
                        error_reporting(E_ALL);

                        if ($_SERVER["REQUEST_METHOD"] === "POST") {
                            $CAgent = htmlspecialchars(trim($_POST["CAgent"]));

                            $stmt = $conn->prepare("SELECT PasswordInput, Apis, Outlook, Firewall FROM Users WHERE CAgent = ?");
                            $stmt->bind_param("s", $CAgent);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            //echo "<p class='mt-3'>Code Agent recherché : <strong>" . htmlspecialchars($CAgent) . "</strong></p>";

                            if ($result && $result->num_rows > 0) {
                                echo "<tbody>";
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['PasswordInput']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['Apis']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['Outlook']) . "</td>";
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
</div>
</section>

<br><br><br>
<section>

<!-- Modification Adresse/Telephone  Ca fonctionne-->
    <div class="container"> <!-- Ca fonctionne-->
        <br>
        <h2 style="color: #2E7D32; text-align: center; border-width: 2px; border-style: solid; border-color: rgb(196, 29, 29); background-color: rgb(227, 227, 227);width: 1300px;margin: 20px 175px; border-collapse: collapse;" class="text-center text-primary admin"> Modification uniquement adresse et/ou numéro de téléphone</h2> <!-- Ca fonctionne-->
        <br><br><br>
        <form action="/pages/auth/modif_account.php" method="POST">
            <div style="color: #2E7D32; text-align: left; width: 1300px;margin: 20px 175px; border-collapse: collapse;" class="text-center text-primary admin" class="mb-3">
                <label for="CAgent">Code Agent :</label>
                <input type="text" class="form-control" id="CAgent" name="CAgent" placeholder="" required> 
            </div>
            <div style="color: #2E7D32; text-align: left; width: 1300px;margin: 20px 175px; border-collapse: collapse;" class="text-center text-primary admin" class="mb-3">
              <label for="Adresse" class="form-label">Adresse :</label>
              <input type="text" class="form-control" id="Adresse" placeholder="Adresse"  value="" name="Adresse">  
            </div>
            <div style="color: #2E7D32; text-align: left; width: 1300px;margin: 20px 175px; border-collapse: collapse;" class="text-center text-primary admin" class="mb-3">
                <label for="Telephone" class="form-label">Téléphone :</label>
                <input type="number" class="form-control" id="Telephone" placeholder="01.02.03.04.05"  value="" name="Telephone"> 
              </div>
              <!--<a> * non modifiable.</a>-->
            <div style="color: #2E7D32; text-align: left; width: 1300px;margin: 20px 175px; border-collapse: collapse;" class="text-center text-primary admin" class="text-center">
                <button type="submit" class="btn btn-primary">Valider</button>
            </div>
        </form>

    </div>
</section>

<!-- Ajout d'un nouveau Mot de Passe Ca Fonctionne-->
<section class="container">  <!-- Ca fonctionne -->               
            <div class="container mt-5 bg-arc-mint-green-light">
                <div class="card-header bg-arc-mint-green text-light">
                    <h2 style="color: #2E7D32; text-align: center; border-width: 2px; border-style: solid; border-color: rgb(196, 29, 29); background-color: rgb(227, 227, 227);width: 1300px;margin: 20px 175px; border-collapse: collapse;" class="text-center text-primary admin">Ajouter / modifier Vos Mots de passe</h2>  
                </div>   
                <br><br><br>                 
                    <form action="/pages/auth/gestion_AOutlook.php" method="POST">
                        <div class="row">
                            <div class="col-md-4"> 
                                <div style="color: #2E7D32; text-align: left; width: 1300px;margin: 20px 175px; border-collapse: collapse;" class="text-center text-primary admin" class="form-group">
                                    <label for="CAgent">Code Agent :  </label>
                                    <input type="text" class="form-control" id="CAgent" name="CAgent" placeholder="" value="" required>
                                </div>
                                <div style="color: #2E7D32; text-align: left; width: 1300px;margin: 20px 175px; border-collapse: collapse;" class="text-center text-primary admin" class="form-group">
                                    <label for="Outlook" class="form-label">Outlook :</label>
                                    <input type="text" class="form-control" id="Outlook" name="Outlook" value="" >                              
                                </div>                                                                                                                                                   
                            </div>
                        </div> 
                        <br>
                        <div style="color: #2E7D32; text-align: left; width: 1300px;margin: 20px 175px; border-collapse: collapse;" class="text-center text-primary admin" class="text-center">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                                
                            
                    <br><br>  
                    <hr style="border: 1px solid black; width: 50%;">
                    <br><br>
                             
                    </form>

                    <form action="/pages/auth/gestion_AFirewall.php" method="POST">
                        <div class="row">
                            <div class="col-md-4"> 
                                <div style="color: #2E7D32; text-align: left; width: 1300px;margin: 20px 175px; border-collapse: collapse;" class="text-center text-primary admin" class="form-group">
                                    <label for="CAgent">Code Agent :  </label>
                                    <input type="text" class="form-control" id="CAgent" name="CAgent" value="" >
                                </div>                               
                                <div style="color: #2E7D32; text-align: left; width: 1300px;margin: 20px 175px; border-collapse: collapse;" class="text-center text-primary admin" class="form-group">
                                    <label for="Firewall" class="form-label">Firewall :</label>
                                    <input type="text" class="form-control" id="Firewall" name="Firewall" value="" >
                                </div>                                                                                                                                                  
                            </div>
                        </div>  
                        <br>
                            <div style="color: #2E7D32; text-align: left; width: 1300px;margin: 20px 175px; border-collapse: collapse;" class="text-center text-primary admin" class="text-center">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                    
                    <br><br>  
                    <hr style="border: 1px solid black; width: 50%;">
                    <br><br>
                    
                    </form>

                    <form action="/pages/auth/gestion_AApis.php" method="POST">
                        <div class="row">
                            <div class="col-md-4"> 
                                <div style="color: #2E7D32; text-align: left; width: 1300px;margin: 20px 175px; border-collapse: collapse;" class="text-center text-primary admin" class="form-group">
                                    <label for="CAgent">Code Agent :  </label>
                                    <input type="text" class="form-control" id="CAgent" name="CAgent" value="" >
                                </div>
                                 <div style="color: #2E7D32; text-align: left; width: 1300px;margin: 20px 175px; border-collapse: collapse;" class="text-center text-primary admin" class="form-group">
                                    <label for="Apis" class="form-label">Apis :</label>
                                    <input type="text" class="form-control" id="Apis" name="Apis" value="" >
                                </div>                                                                                                                                                     
                            </div>
                        </div> 
                        <br>
                            <div style="color: #2E7D32; text-align: left; width: 1300px;margin: 20px 175px; border-collapse: collapse;" class="text-center text-primary admin" class="text-center">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                            </div>

                        <br><br>  
                    <hr style="border: 1px solid black; width: 50%;">
                    <br><br>    
                                                       
                    </form> 
                    
                    <form action="/pages/auth/gestion_AMDP.php" method="POST">
                        <div class="row">
                            <div class="col-md-4"> 
                                <div style="color: #2E7D32; text-align: left; width: 1300px;margin: 20px 175px; border-collapse: collapse;" class="text-center text-primary admin" class="form-group">
                                    <label for="CAgent">Code Agent :  </label>
                                    <input type="text" class="form-control" id="CAgent" name="CAgent" placeholder="" value="" required>
                                </div>
                                <div style="color: #2E7D32; text-align: left; width: 1300px;margin: 20px 175px; border-collapse: collapse;" class="text-center text-primary admin" class="form-group">
                                    <label for="PasswordInput" class="form-label">Mot de passe Appli :</label>
                                    <input type="text" class="form-control" id="PasswordInput" name="PasswordInput" value="" >                              
                                </div>                                                                                                                                                   
                            </div>
                        </div> 
                        <br>
                    
                            <div style="color: #2E7D32; text-align: left; width: 1300px;margin: 20px 175px; border-collapse: collapse;" class="text-center text-primary admin" class="text-center">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                    
                            <br><br>  
                    <hr style="border: 1px solid black; width: 50%;">
                    <br><br>
                            
                    </form>

           
            </div>
</section>
