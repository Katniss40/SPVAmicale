<!-- --- Interface HTML --- -->

<!-- --- Interface HTML --- -->

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Amicale des Sapeurs-Pompiers - Réponse</title>
    
  <<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.0/font/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/global.css">
  <link rel="stylesheet" href="/assets/css/insert_reponse.css"> <!-- si nécessaire -->


  
</head>

<body>

<header>

<section>
<nav class="navbar navbar-expand-lg fixed-top" style="background-color: white;">
     <div class="navbar">
      <a class="navbar-brand policeDrop" href="/">
        <img src="/Images/Logo_SPleon3.png" alt="Logo" width="70" height="50" class="d-inline-block align-text-top">Amicale des Sapeurs-Pompiers de Léon</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                    <!--<a class="nav-link policeNav dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Interne
                    </a>
                  <ul class="dropdown-menu">-->
                    <li><a class="nav-link policeDrop" href="/Blog" data-show="actif">SPV</a></li>
                    <li><a class="nav-link policeDrop" href="/admin" data-show="admin">Administrateur</a></li>
                  <!--</ul>-->
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
</section>

    <section class="hero-scene text-center text-white">
            <div class="hero-scene-content"><br><br><br><br>
                <h1 style="color: white;" class="hero-scene-text">Répondre au sujet</h1>
            </div>        
    </section>

    <nav class="navbar navbar-expand-lg" style="background-color: #2E7D32;">
  <div class="container-fluid">
    <a class="navbar-brand" href="/" style="color: white; font-weight: bold;">
      <img src="/Images/Logo_SPleon3.png" alt="Logo" width="50" height="40" class="d-inline-block align-text-top">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin" aria-controls="navbarAdmin" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarAdmin">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item" data-show="admin">
          <a class="nav-link" href="/admin" style="color: white;">Tableau de bord Administrateur</a>
        </li>
        <li class="nav-item" data-show="actif">
          <a class="nav-link" href="/Blog" style="color: white;">Tableau de bord</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/liens" style="color: white;">Liens Utiles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/calendrier" style="color: white;">Calendrier des Gardes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/VideGrenier" style="color: white;">Vide grenier</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/GalerieSPV" style="color: white;">Gestion des Photos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/Blog" style="color: white;">Discussions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/pages/auth/reservation.php" style="color: white;">Réservation fendeuse</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/forum/account.php" style="color: white;">Mon Compte</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
</header>


<br><br>
<h1 class="reponse">Insertion d'une nouvelle réponse</h1>
<?php


// on teste si le formulaire a été soumis
if (isset ($_POST['go']) && $_POST['go']=='Poster') {
	// on teste le contenu de la variable $auteur
	if (!isset($_POST['auteur']) || !isset($_POST['message']) || !isset($_GET['numero_du_sujet'])) {
	$erreur = 'Les variables nécessaires au script ne sont pas définies.';
	}
	else {
	if (empty($_POST['auteur']) || empty($_POST['message']) || empty($_GET['numero_du_sujet'])) {
		$erreur = 'Au moins un des champs est vide.';
	}
	// si tout est bon, on peut commencer l'insertion dans la base
	else {
		// on se connecte à notre base de données
		$base = mysqli_connect ('mysql-pompiers-leon.alwaysdata.net', '408942', '@Admin-2025@');
		mysqli_select_db ($base, 'pompiers-leon_admin');

		// on recupere la date de l'instant présent
		$date = date("Y-m-d H:i:s");

		// préparation de la requête d'insertion (table forum_reponses)
		$sql = 'INSERT INTO forum_reponses VALUES("", "'.mysqli_real_escape_string($base, $_POST['auteur']).'", "'.mysqli_real_escape_string($base, $_POST['message']).'", "'.$date.'", "'.$_GET['numero_du_sujet'].'")';

		// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
		mysqli_query($base, $sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($base));

		// préparation de la requête de modification de la date de la dernière réponse postée (dans la table forum_sujets)
		$sql = 'UPDATE forum_sujets SET date_derniere_reponse="'.$date.'" WHERE id="'.$_GET['numero_du_sujet'].'"';

		// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
		mysqli_query($base, $sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($base));

		// on ferme la connexion à la base de données
		mysqli_close($base);

		// on redirige vers la page de lecture du sujet en cours
		header('Location: lire_sujet.php?id_sujet_a_lire='.$_GET['numero_du_sujet']);

		// on termine le script courant
		exit;
	}
	}
}
?>

<br>


<!-- on fait pointer le formulaire vers la page traitant les données -->
<form action="insert_reponse.php?numero_du_sujet=<?php echo $_GET['numero_du_sujet']; ?>" method="post">
	<table style="width: 1300px; margin: 0 auto; border-collapse: collapse;">
		<tr style="border: 1px solid rgb(196, 29, 29); padding: 8px; text-align: left; background-color:  rgb(227, 227, 227);">
			<td style="border: 1px solid rgb(196, 29, 29); padding: 8px; text-align: left;">
				<b style="color: #2E7D32; text-decoration: rgb(196, 29, 29) wavy underline;">Auteur :</b>
			</td>
			<td style="border: 1px solid rgb(196, 29, 29); padding: 8px; text-align: left;">
				<input type="text" name="auteur" maxlength="30" size="50" value="<?php if (isset($_POST['auteur'])) echo htmlentities(trim($_POST['auteur'])); ?>">
			</td>
		</tr>
		<tr style="border: 1px solid rgb(196, 29, 29); padding: 8px; text-align: left; background-color:  rgb(227, 227, 227);">
			<td style="border: 1px solid rgb(196, 29, 29); padding: 8px; text-align: left;">
				<b style="color: #2E7D32; text-decoration: rgb(196, 29, 29) wavy underline;">Message :</b>
			</td>
			<td style="border: 1px solid rgb(196, 29, 29); padding: 8px; text-align: left;">
				<textarea name="message" cols="50" rows="10"><?php if (isset($_POST['message'])) echo htmlentities(trim($_POST['message'])); ?></textarea>
			</td>
		</tr>
		<tr style="border: 1px solid rgb(196, 29, 29); padding: 8px; text-align: left; background-color:  rgb(227, 227, 227);">
			<td style="border: 1px solid rgb(196, 29, 29); padding: 8px; text-align: left;">
			</td>
			<td style="border: 1px solid rgb(196, 29, 29); padding: 8px; text-align: left;">
				<input type="submit" name="go" value="Poster">
			</td>
		</tr>
	</table>
</form>



<?php
if (isset($erreur)) echo '<br /><br />',$erreur;
?>

<br><br><br><br><br>

<!-- on insère un lien qui nous permettra de retourner à l'accueil du forum -->
<a href="/Blog" style="border-radius: 5px; background-color: #2E7D32; color: #F5E6CC; padding: 10px 15px; text-decoration: none; width: 1300px; margin: auto  175px;">Retour à l'accueil</a>
<br><br><br><br>
<br>


<!-- Bouton retour haut --><

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

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>    

<script src="/JS/script.js" type="module"></script>

      <script type="module" src="/JS/auth/roleManager.js"></script>
      <script type="module" src="/JS/auth/signin-script.js"></script>
      <script type="module" src="/JS/auth/signout.js"></script>
      <script type="module" src="/Router/router.js"></script>

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