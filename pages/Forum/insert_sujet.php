<!-- La page fonctionne -->


<div class="hero-scene text-center text-white">
        <div class="hero-scene-content">
                <h1 class="hero-scene-text">Inserer un Sujet de Discussion!</h1>
        </div>
</div>
<br><br><br><br><br>

<section data-show="admin">
    <nav class="navbar navbar-expand-lg bg-primary " data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin" data-show="admin">Tableau de bord Administrateur</a>
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
<br>
<br>
<section>
    <div class="container">
        <h1 class="text-center text-primary admin">Vous pouvez démarrer une nouvelle discution</h1>
            <!-- on place un lien permettant d'accéder à la page contenant le formulaire d'insertion d'un nouveau sujet -->  
            
    </div>
            <br />
            <br />
    <div class="container">



<?php
// on teste si le formulaire a été soumis
if (isset ($_POST['go']) && $_POST['go']=='Poster') {
	// on teste la déclaration de nos variables
	if (!isset($_POST['auteur']) || !isset($_POST['titre']) || !isset($_POST['message'])) {
	$erreur = 'Les variables nécessaires au script ne sont pas définies.';
	}
	else {
	// on teste si les variables ne sont pas vides
	if (empty($_POST['auteur']) || empty($_POST['titre']) || empty($_POST['message'])) {
		$erreur = 'Au moins un des champs est vide.';
	}

	// si tout est bon, on peut commencer l'insertion dans la base
	else {
		// on se connecte à notre base
		include("connexion.php");
		//$base = mysqli_connect ('mysql-pompiers-leon.alwaysdata.net', '408942', '@Admin-2025@');
		//mysqli_select_db ($base, 'pompiers-leon_admin') ;

		// on calcule la date actuelle
		$date = date("Y-m-d H:i:s");

		// préparation de la requête d'insertion (pour la table forum_sujets)
		$sql = 'INSERT INTO forum_sujets VALUES("", "'.mysqli_real_escape_string($conn, $_POST['auteur']).'", "'.mysqli_real_escape_string($conn, $_POST['titre']).'", "'.$date.'")';

		// on lance la requête (mysqli_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
		mysqli_query($conn, $sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($conn));

		// on recupère l'id qui vient de s'insérer dans la table forum_sujets
		$id_sujet = mysqli_insert_id($conn);

		// lancement de la requête d'insertion (pour la table forum_reponses
		$sql = 'INSERT INTO forum_reponses VALUES("", "'.mysqli_real_escape_string($conn, $_POST['auteur']).'", "'.mysqli_real_escape_string($conn, $_POST['message']).'", "'.$date.'", "'.$id_sujet.'")';

		// on lance la requête (mysqli_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
		mysqli_query($conn, $sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($conn));

		// on ferme la connexion à la base de données
		mysqli_close($conn);

		// on redirige vers la page d'accueil
		header('Location: /Blog');

		// on termine le script courant
		exit;
	}
	}
}
?>


<!-- on fait pointer le formulaire vers la page traitant les données -->
<form action="/pages/Forum/insert_sujet.php" method="post"> <!-- Ca fonctionne -->
<table class="blog_table">
<tr><td>
<b>Auteur :  </b>
</td><td>
<input type="text" name="auteur" maxlength="30" size="125" value="<?php if (isset($_POST['auteur'])) echo htmlentities(trim($_POST['auteur'])); ?>">
</td></tr><tr><td>
<b>Titre :     </b>
</td><td>
<input type="text" name="titre" maxlength="50" size="125" value="<?php if (isset($_POST['titre'])) echo htmlentities(trim($_POST['titre'])); ?>">
</td></tr><tr><td>
<b>Message :</b>
</td><td>
<textarea name="message" cols="125" rows="11"><?php if (isset($_POST['message'])) echo htmlentities(trim($_POST['message'])); ?></textarea>
</td></tr><tr><td><td>
<input type="submit" name="go" value="Poster">
</td></tr></table>
</form>
</div>
</div>
</section>
<?php
// on affiche les erreurs éventuelles
if (isset($erreur)) echo '<br /><br />',$erreur;
?>

<br><br>

<!-- on insère un lien qui nous permettra de retourner à l'accueil du forum -->
<a href="/Blog" style="border-radius: 5px; background-color: #2E7D32; color: #F5E6CC; padding: 10px 15px; text-decoration: none; width: 1300px; margin: auto  175px;">Retour à l'accueil</a>


