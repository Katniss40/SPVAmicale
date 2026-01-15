
<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
// Normalisation défensive des clés de session
$user_role = $_SESSION['Role'] ?? $_SESSION['role'] ?? '';
$prenom_connected = $_SESSION['PrenomInput'] ?? $_SESSION['prenomInput'] ?? $_SESSION['NomInput'] ?? $_SESSION['nomInput'] ?? '';

// Debug temporaire: affiche la session si on passe ?debug_session=1
if (isset($_GET['debug_session']) && $_GET['debug_session'] === '1') {
  echo '<pre style="background:#fff;color:#000;padding:1rem;">';
  var_dump($_SESSION);
  echo '</pre>';
  exit;
}
?>
<!-- --- Interface HTML --- -->

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Mon compte</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/global.css">
<link rel="stylesheet" href="/assets/css/reservation.css">
<!--arrive du index.html-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Emilys+Candy&family=Happy+Monkey&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.0/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Hind+Madurai:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
</head>

<body>
<header>
<nav class="navbar navbar-expand-lg fixed-top bg-pompier admin-subnav" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand policeNav" href="/">
      <img src="/Images/Logo_SPleon3.png" alt="Logo" width="70" height="50" class="d-inline-block align-text-top"><span style="color:    color: rgb(196, 29, 29); font-weight:bold; font-size:1.5rem; margin-left:8px;">Amicale des Sapeurs-Pompiers de Léon</span></a>
      <?php if(isset($_SESSION['PrenomInput'])): ?>
        <span class="navbar-welcome" style="margin-left:24px; font-size:1.1rem; color:#2E7D32; font-weight:bold;">Bienvenue, <?php echo htmlspecialchars($_SESSION['PrenomInput']); ?></span>
      <?php endif; ?>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="#navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link policeNav" href="/">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link policeNav" href="/galerie">Galerie</a>
        </li>
        <li class="nav-item">
          <a class="nav-link policeNav" href="/manifestations">Bal/Vide-grenier</a>
        </li>
        <li class="nav-item">
          <a class="nav-link policeNav" href="/recrutement">Recrutement</a>
        </li>
        <li class="nav-item">
          <a class="nav-link policeNav" href="/infos">Manifestations</a>
        </li>
        
        <li class="nav-item dropdown" data-show="connected">
          <li><a class="nav-link policeDrop" href="/Blog" data-show="actif">SPV</a></li>
          <li><a class="nav-link policeDrop" href="/admin" data-show="admin">Administrateur</a></li>
        </li>
        
        <li class="nav-item" data-show="disconnected">
          <a class="nav-link policeNav" href="/signin">Connexion</a>
        </li>
        <li class="nav-item" data-show="connected">
          <button class="nav-link policeNav" id="btnSignout">Déconnexion</button>
        </li>
      </ul>
    </div>
  </div>
</nav>

<section class="hero-scene text-center text-white">
            <div class="hero-scene-content"><br><br><br><br>
                <h1 style="color: white;" class="hero-scene-text">Modification / Récupération de vos mots de passe</h1>
                <div><a href="/" class="btn btn-primary">Retour Accueil</a></div>
            </div>        
    </section>

    <nav class="navbar navbar-expand-lg bg-pompier admin-subnav" data-bs-theme="dark">
    <div class="container-fluid">
    <a class="navbar-brand" href="/admin" data-show="admin">Tableau de bord Administrateur</a>
    <a class="navbar-brand" href="/Blog" data-show="actif">Tableau de bord</a>
    <?php if (!empty($prenom_connected)): ?>
      <span class="navbar-text text-light ms-3">Bienvenue, <?php echo htmlspecialchars($prenom_connected); ?></span>
    <?php endif; ?>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ms-auto">
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
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="reservationsDropdownForum" role="button" data-bs-toggle="dropdown" aria-expanded="false">Réservations</a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="reservationsDropdownForum">
            <li><a class="dropdown-item" href="/fendeuse">Fendeuse</a></li>
            <li><a class="dropdown-item" href="/reservation-vl">VL</a></li>
            <li><a class="dropdown-item" href="/admin/reservations-vl">Historique</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/GalerieSPV">Gestion des Photos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/Blog">Discussions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/forum/account.php">Mon Compte</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<main>
<!-- Liste des Mots de passe enregistrés-->
<section class="container">    
    <div class="row bg-arc-mint-green-light-staff py-3">
        <div class="card-list-employe mt-3">
            <h2 class="titre-section">Vos Coordonnées</h2>
                <br><br>
            <?php
            // Afficher message de succès si modification réussie
            if (isset($_GET['success']) && $_GET['success'] == '1') {
                echo '<div class="alert alert-success" role="alert">✓ Modification enregistrée avec succès!</div>';
            }
            
            // Récupérer CAgent depuis URL (GET) ou formulaire (POST)
            $CAgentFromURL = '';
            if (isset($_GET['CAgent'])) {
                $CAgentFromURL = htmlspecialchars($_GET['CAgent']);
            } elseif (isset($_POST['CAgent'])) {
                $CAgentFromURL = htmlspecialchars($_POST['CAgent']);
            }
            ?>
            <div>
                <form method="post" class="form-contact">
                    <div class="form-row">
                        <label for="CAgent">Code Agent :</label>
                        <input type="text" id="CAgent" name="CAgent" value="<?php echo $CAgentFromURL; ?>" required>
                    </div>
                                        
                    <button type="submit" class="btn btn-danger">Afficher</button>
                </form>
            </div>            
            
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
                // Utiliser le helper centralisé
                require_once __DIR__ . '/../pages/controleurs/db_mysqli.php';
                $conn = $mysqli;

                ini_set('display_errors', 1);
                error_reporting(E_ALL);

                // Accepter POST ou GET
                if ($_SERVER["REQUEST_METHOD"] === "POST" || isset($_GET['CAgent'])) {
                    $CAgent = '';
                    if (isset($_POST["CAgent"])) {
                        $CAgent = htmlspecialchars(trim($_POST["CAgent"]));
                    } elseif (isset($_GET['CAgent'])) {
                        $CAgent = htmlspecialchars(trim($_GET['CAgent']));
                    }

                    if ($CAgent) {
                        $stmt = $conn->prepare("SELECT CAgent, NomInput, PrenomInput FROM Users WHERE CAgent = ?");
                        $stmt->bind_param("s", $CAgent);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        echo "<p class='form-contact '>Code Agent recherché : <strong>" . htmlspecialchars($CAgent) . "</strong></p>";

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
                        }
                ?>
                    
                    </table>
            </div>

    </div>        
<br><br><br>

        <div class="container">
            <div class="card-body">
                <h2 class="titre-section">Informations Personnelles</h2>
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
// Utiliser le helper centralisé
$conn = $mysqli;
            
            ini_set('display_errors', 1);
            error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST" || isset($_GET['CAgent'])) {
    $CAgent = '';
    if (isset($_POST["CAgent"])) {
        $CAgent = htmlspecialchars(trim($_POST["CAgent"]));
    } elseif (isset($_GET['CAgent'])) {
        $CAgent = htmlspecialchars(trim($_GET['CAgent']));
    }

    if ($CAgent) {
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
        }
?>
                    
                </table>
            </div>
        </div>

<br><br><br>

        <div class="container">
            <div class="card-body">
                <h2 class="titre-section">Vos mots de passes</h2>
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
                      // Utiliser le helper mysqli centralisé
                      require_once __DIR__ . '/../pages/controleurs/db_mysqli.php';
                      $conn = $mysqli;
                        //$conn = new mysqli("mysql-pompiers-leon.alwaysdata.net", "408942", "@Admin-2025@", "pompiers-leon_admin");
                                    

                        ini_set('display_errors', 1);
                        error_reporting(E_ALL);

                        if ($_SERVER["REQUEST_METHOD"] === "POST" || isset($_GET['CAgent'])) {
                            $CAgent = '';
                            if (isset($_POST["CAgent"])) {
                                $CAgent = htmlspecialchars(trim($_POST["CAgent"]));
                            } elseif (isset($_GET['CAgent'])) {
                                $CAgent = htmlspecialchars(trim($_GET['CAgent']));
                            }

                            if ($CAgent) {
                                $stmt = $conn->prepare("SELECT PasswordInput, Apis, Outlook, Firewall FROM Users WHERE CAgent = ?");
                                $stmt->bind_param("s", $CAgent);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                //echo "<p class='mt-3'>Code Agent recherché : <strong>" . htmlspecialchars($CAgent) . "</strong></p>";

                                if ($result && $result->num_rows > 0) {
                                    echo "<tbody>";
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        // Ne jamais afficher les mots de passe en clair
                                        echo "<td>••••••</td>";
                                        echo "<td>" . htmlspecialchars($row['Apis'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                                        echo "<td>" . htmlspecialchars($row['Outlook'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                                        echo "<td>" . htmlspecialchars($row['Firewall'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                } else {
                                    echo "<tbody><tr><td colspan='3'>Aucun résultat trouvé pour ce code agent.</td></tr></tbody>";
                                }

                                $stmt->close();
                              }
                            }
                    ?>
                    
                    </table>
            </div>
        </div>
    </div>
</div>
</section>

<section>

<!-- Modification Adresse/Telephone  Ca fonctionne-->
    <div class="container"> <!-- Ca fonctionne-->
        <br>
        
            <h2 class="titre-section">
            Modification uniquement adresse et/ou numéro de téléphone
            </h2>

            <form action="/pages/auth/modif_account.php" method="POST" class="form-contact">
            <div class="form-row">
                <label for="CAgent">Code Agent :</label>
                <input type="text" id="CAgent" name="CAgent">
            </div>

            <div class="form-row">
                <label for="Adresse">Adresse :</label>
                <input type="text" id="Adresse" name="Adresse" placeholder="Adresse">
            </div>

            <div class="form-row">
                <label for="Telephone">Téléphone :</label>
                <input type="number" id="Telephone" name="Telephone" placeholder="01.02.03.04.05">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Valider</button>
            </div>
            </form>


    </div>
</section>

<!-- Ajout d'un nouveau Mot de Passe Ca Fonctionne-->
<section class="container"> <!-- Ca fonctionne -->                
            <div class="card-header bg-arc-mint-green text-light">
                <h2 class="titre-section">Ajouter / modifier vos mots de passe</h2>
            </div>

            <form action="/pages/auth/gestion_AOutlook.php" method="POST" class="form-mdp">
                <label for="CAgent" class="intro-text">
                    Modifier votre mot de passe Outlook pour l'enregistrer dans la base de données :
                </label>

                <div class="form-row">
                    <label for="CAgent">Code Agent :</label>
                    <input type="text" id="CAgent" name="CAgent">
                </div>

                <div class="form-row">
                    <label for="Outlook">Outlook :</label>
                    <input type="text" id="Outlook" name="Outlook">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
                                
    <br><br>  
        <hr class="section-divider">
    <br><br>                        
            
            <form action="/pages/auth/gestion_AFirewall.php" method="POST" class="form-mdp">
                <label for="CAgent" class="intro-text">
                    Modifier votre mot de passe FireWall pour l'enregistrer dans la base de données :
                </label>

                <div class="form-row">
                    <label for="CAgent">Code Agent :</label>
                    <input type="text" id="CAgent" name="CAgent">
                </div>

                <div class="form-row">
                    <label for="Firewall">Firewall :</label>
                    <input type="text" id="Firewall" name="Firewall">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
                             
                    
                    
    <br><br>  
        <hr class="section-divider">
    <br><br>    
    
            <form action="/pages/auth/gestion_AApis.php" method="POST" class="form-mdp">
                <label for="CAgent" class="intro-text">
                    Modifier votre mot de passe Apis pour l'enregistrer dans la base de données :
                </label>

                <div class="form-row">
                    <label for="CAgent">Code Agent :</label>
                    <input type="text" id="CAgent" name="CAgent">
                </div>

                <div class="form-row">
                    <label for="Apis">Apis :</label>
                    <input type="text" id="Apis" name="Apis">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
    
                    
                    

    <br><br>  
        <hr class="section-divider">
    <br><br>    
                                                       
                    <form action="/pages/auth/gestion_AMDP.php" method="POST" class="form-mdp">
                        <label for="CAgent" class="intro-text">
                            Modifier votre mot de passe du site "pompiers-leon40" pour l'enregistrer dans la base de données :
                        </label>

                        <div class="form-row">
                            <label for="CAgent">Code Agent :</label>
                            <input type="text" id="CAgent" name="CAgent">
                        </div>

                        <div class="form-row">
                          <label for="PasswordInput">Mot de passe du site :</label>
                          <input type="password" id="PasswordInput" name="PasswordInput" autocomplete="new-password">
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                    </form>

    <br><br>  
        <hr class="section-divider">
    <br><br> 
 </section>                   
</main>
 
<!-- Bouton retour haut -->

<button id="backToTop" aria-label="Retour en haut" title="Retour en haut">↑ Haut</button>
<footer class="footer">
  
  <div class="footer-container">
    <div class="footer-col">
      <h3>Nous contacter</h3>
      <p>Adresse M@il : 
        <a class="mail" href="mailto:aspleon40@gmail.com">aspleon40@gmail.com</a>
      </p>
      <div class="social-buttons">
        <button class="facebook" onclick="window.location.href='https://www.facebook.com/csleon.sapeurspompiers';">
          <i class="bi bi-facebook"></i> Facebook
        </button>
        <button class="instagram" onclick="window.location.href='https://www.instagram.com/sapeurs_pompiers_de_leon';">
          <i class="bi bi-instagram"></i> Instagram
        </button>
      </div>
    </div>

    <div class="footer-col">
      <p>
        Centre de secours et d'incendie <br>
        Route de Laguens <br>
        40550 Léon <br>
        Tel Chef de centre : 06.89.76.78.67 <br>
        Tel Président Amicale : 06.14.81.77.03
      </p>
    </div>

    <div class="footer-col">
      <p>Mentions légales</p>
      <a href="/fichiers/mentions_legales_spv.docx" class="btn-mentions">Télécharger ICI</a>
      <p class="copyright">© 2025 Amicale des Sapeurs-Pompiers de Léon<br>Tous droits réservés</p>
    </div>
  </div>

  <div class="signature">
    <p>Site conçu gracieusement par Bourdeloux Corinne - Web-Crea 2.0 - contactez-moi 
      <a class="mail" href="mailto:w3b.cre4@gmail.com">ICI</a>
    </p>
  </div>
</footer>  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>    

<script src="/JS/script.js" type="module"></script>

      <script type="module" src="/JS/auth/roleManager.js"></script>
      <script type="module" src="/JS/auth/signin-script.js"></script>
      <script type="module" src="/JS/auth/signout.js"></script>
      <script type="module" src="/Router/router.js"></script>
      <script type="module" src="/JS/auth/reservation.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>
  // Smooth scroll to top
  function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  // Afficher / cacher le bouton selon la position de la page
  document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('backToTop');

    // Ne pas continuer si bouton introuvable
    if (!btn) return;

    // Au chargement, cacher le bouton
    btn.classList.remove('visible');

    window.addEventListener('scroll', function () {
      // Affiche le bouton quand on a défilé de 300px (à adapter)
      if (window.scrollY > 300) {
        btn.classList.add('visible');
      } else {
        btn.classList.remove('visible');
      }
    });

    // Optionnel : fermer le menu mobile si nécessaire quand on clique (exemple)
    btn.addEventListener('click', scrollToTop);
  });
</script>

</body>
</html>