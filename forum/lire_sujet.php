<!-- --- Interface HTML --- -->

<!-- --- Interface HTML --- -->

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Amicale des Sapeurs-Pompiers - Sujet</title>
    
  <<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.0/font/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/global.css">
  <link rel="stylesheet" href="/assets/css/lire_sujet.css"> <!-- si nécessaire -->


  
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
</section>

    <section class="hero-scene text-center text-white">
            <div class="hero-scene-content"><br><br><br><br>
                <h1 style="color: white;" class="hero-scene-text">Lecture du sujet</h1>
            </div>        
    </section>

    <nav class="navbar navbar-expand-lg">        
        <div class="navbar" style="background-color: #2E7D32;"> 
            <img src="/Images/Logo_SPleon3.png" alt="Logo" width="50" height="40" class="d-inline-block align-text-top">
                <a class="navbar-brand" href="/admin" data-show="admin">Tableau de bord Administrateur</a>
                
                    <a class="navbar-brand" href="/Blog" data-show="actif" >Tableau de bord </a>
                    <a class="nav-link" href="/liens">Liens Utiles</a>
                    <a class="nav-link" href="/calendrier">Calendrier des Gardes</a>
                    <a class="nav-link" href="/VideGrenier">Vide grenier</a>
                    <a class="nav-link" href="/GalerieSPV">Gestion des Photos</a>
                    <a class="nav-link" href="/Blog">Discussions</a>
                    <a class="nav-link" href="/pages/auth/reservation.php">Réservation fendeuse</a>
                    <a class="nav-link" href="/forum/account.php">Mon Compte</a>                
        </div>
    </nav>
</header>

<br>

<main>
<!-- on insère un lien qui nous permettra de retourner à l'accueil du forum -->
<a class="btn" href="/Blog" >Retour à l'accueil</a>
<br><br><br>
<?php
if (!isset($_GET['id_sujet_a_lire'])) {
	echo 'Sujet non défini.';
}
else {
?>
	<table style="width: 1300px; margin: 0 auto; border-collapse: collapse;">
	<tr style="border: 2px solid rgb(196, 29, 29); padding: 8px; text-align: left; background-color:  rgb(227, 227, 227);">
		<td style="border: 1px solid rgb(196, 29, 29); padding: 8px; text-align: left; color: #2E7D32; text-decoration: rgb(196, 29, 29) wavy underline;">
			Auteur
		</td>
		<td style="border: 1px solid rgb(196, 29, 29); padding: 8px; text-align: left; color: #2E7D32; text-decoration: rgb(196, 29, 29) wavy underline;">
			Messages
		</td>
		<td style="border: 1px solid rgb(196, 29, 29); padding: 8px; text-align: left; color: #2E7D32; text-decoration: rgb(196, 29, 29) wavy underline;">
			Date de la reponse
		</td>
	</tr>

	<?php
	// on se connecte à notre base de données
	$base = mysqli_connect ('mysql-pompiers-leon.alwaysdata.net', '408942', '@Admin-2025@');
	mysqli_select_db ($base, 'pompiers-leon_admin');

	// on prépare notre requête
	$sql = 'SELECT auteur, message, date_reponse FROM forum_reponses WHERE correspondance_sujet="'.$_GET['id_sujet_a_lire'].'" ORDER BY date_reponse ASC';

	// on lance la requête (mysqli_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
	$req = mysqli_query($base, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($base));

	// on va scanner tous les tuples un par un
	while ($data = mysqli_fetch_array($req)) {

	// on décompose la date
	sscanf($data['date_reponse'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);

	// on affiche les résultats
	echo '<tr style="border: 1px solid rgb(196, 29, 29); padding: 8px; text-align: left; background-color:  rgb(227, 227, 227);">';
	echo '<td style="border: 1px solid rgb(196, 29, 29); padding: 8px; text-align: left;">';
// on affiche le nom de l'auteur de sujet ainsi que la date de la réponse
	echo htmlentities(trim($data['auteur']));
	//echo '<br />';
	//echo $jour , '-' , $mois , '-' , $annee , ' ' , $heure , ':' , $minute;
	echo '</td>
	
	<td style="border: 1px solid rgb(196, 29, 29); padding: 8px; text-align: left;">';
	// on affiche le message
	echo nl2br(htmlentities(trim($data['message'])));
	echo '</td>
	<td style="border: 1px solid rgb(196, 29, 29); padding: 8px; text-align: left;">';
	// on affiche la date de la dernière réponse de ce sujet
	echo $jour , '-' , $mois , '-' , $annee , ' ' , $heure , ':' , $minute;
	echo '</td>
	</tr>';	
	}

	// on libère l'espace mémoire alloué pour cette reqête
	mysqli_free_result ($req);
	// on ferme la connection à la base de données.
	mysqli_close ($base);
	?>

	<!-- on ferme notre table html -->
	</table>

	<br /><br />
	<!-- on insère un lien qui nous permettra de rajouter des réponses à ce sujet -->
	<a class="btn" href="./insert_reponse.php?numero_du_sujet=<?php echo $_GET['id_sujet_a_lire']; ?>" >Répondre</a>
	<?php
}
?>
<br /><br />
<br>
<p></p>

</main>


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