<div class="hero-scene text-center text-white">
        <div class="hero-scene-content">
                <h1 class="hero-scene-text">Contactez nous!</h1>
        </div>
</div>
<br><br><br><br><br>

<section >
    <nav class="navbar navbar-expand-lg bg-primary " data-bs-theme="dark" style="background-color: #2E7D32; color: #F5E6CC;">
        <div class="container-fluid">
            <a class="navbar-brand" href="/Blog" >Tableau de bord </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/liens" style="color: #F5E6CC;">Liens Utiles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/calendrier" style="color: #F5E6CC;"">Calendrier des Gardes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/VideGrenier" style="color: #F5E6CC;">Vide grenier</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/GalerieSPV" style="color: #F5E6CC;">Gestion des Photos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Blog" style="color: #F5E6CC;">Discutions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/account" style="color: #F5E6CC;">Mon Compte</a>
                        </li>
                    </ul>
                </div>
        </div>
    </nav>

</section>

<?php
// on teste si le formulaire a été soumis
if (isset ($_POST['go']) && $_POST['go']=='Poster') {
	// on teste le contenu de la variable $auteur
	if (!isset($_POST['auteur']) || !isset($_POST['message']) || !isset($_GET['NumeroSujet'])) {
	$erreur = 'Les variables nécessaires au script ne sont pas définies.';
	}
	else {
	if (empty($_POST['auteur']) || empty($_POST['message']) || empty($_GET['NumeroSujet'])) {
		$erreur = 'Au moins un des champs est vide.';
	}
	// si tout est bon, on peut commencer l'insertion dans la base
	else {
		// on se connecte à notre base de données
        include("connexion.php");
        //$base = mysqli_connect ('mysql-pompiers-leon.alwaysdata.net', '408942', '@Admin-2025@');
		//mysqli_select_db ($base, 'pompiers-leon_admin') ;

		// on recupere la date de l'instant présent
		$date = date("Y-m-d H:i:s");

		// préparation de la requête d'insertion (table forum_reponses)
		$sql = 'INSERT INTO forum_reponses VALUES("", "'.mysqli_real_escape_string($base, $_POST['auteur']).'", "'.mysqli_real_escape_string($base, $_POST['message']).'", "'.$date.'", "'.$_GET['numero_du_sujet'].'")';

		// on lance la requête (mysqli_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
		mysqli_query($base, $sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($base));

		// préparation de la requête de modification de la date de la dernière réponse postée (dans la table forum_sujets)
		$sql = 'UPDATE forum_sujets SET date_derniere_reponse="'.$date.'" WHERE id="'.$_GET['NumeroSujet'].'"';

		// on lance la requête (mysqli_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
		mysqli_query($base, $sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($base));

		// on ferme la connexion à la base de données
		mysqli_close($base);

		// on redirige vers la page de lecture du sujet en cours
		header('Location:./pages/Forum/lire_sujet?IdLireSujet='.$_GET['NumeroSujet']);

		// on termine le script courant
		exit;
	}
	}
}
?>


<!-- on fait pointer le formulaire vers la page traitant les données -->
<form action="/pages/Forum/insert_sujet?numero_du_sujet=<?php echo $_GET['numero_du_sujet']; ?>"method="post">
<table style="border: 1px solid black;">
<tr><td>
<b>Auteur :</b>
</td><td>
<input type="text" name="auteur" maxlength="30" size="50" value="<?php if (isset($_POST['auteur'])) echo htmlentities(trim($_POST['auteur'])); ?>">
</td></tr><tr><td>
<b>Message :</b>
</td><td>
<textarea name="message" cols="50" rows="10"><?php if (isset($_POST['message'])) echo htmlentities(trim($_POST['message'])); ?></textarea>
</td></tr><tr><td><td align="right">
<input type="submit" name="go" value="Poster">
</td></tr></table>
</form>
<?php
if (isset($erreur)) echo '<br /><br />',$erreur;
?>