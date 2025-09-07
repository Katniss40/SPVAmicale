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
	</style>
</head>
<body>

<header>
	<nav>
  		<div class="navbar" style="background-color: #2E7D32;">
			<a href="/">Accueil</a>
   			<a href="/blog">forum</a>
  		</div>
	</nav>
		<h1>Bienvenue sur notre forum de discussion</h1>
</header>

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
		$base = mysqli_connect ('mysql-pompiers-leon.alwaysdata.net', '408942', '@Admin-2025@');
		mysqli_select_db ($base, 'pompiers-leon_admin');

		// on calcule la date actuelle
		$date = date("Y-m-d H:i:s");

		// préparation de la requête d'insertion (pour la table forum_sujets)
		$sql = 'INSERT INTO forum_sujets VALUES("", "'.mysqli_real_escape_string($base, $_POST['auteur']).'", "'.mysqli_real_escape_string($base, $_POST['titre']).'", "'.$date.'")';

		// on lance la requête (mysqli_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
		mysqli_query($base, $sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($base));

		// on recupère l'id qui vient de s'insérer dans la table forum_sujets
		$id_sujet = mysqli_insert_id($base);

		// lancement de la requête d'insertion (pour la table forum_reponses
		$sql = 'INSERT INTO forum_reponses VALUES("", "'.mysqli_real_escape_string($base, $_POST['auteur']).'", "'.mysqli_real_escape_string($base, $_POST['message']).'", "'.$date.'", "'.$id_sujet.'")';

		// on lance la requête (mysqli_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
		mysqli_query($base, $sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($base));

		// on ferme la connexion à la base de données
		mysqli_close($base);

		// on redirige vers la page d'accueil
		header('Location: /Blog');

		// on termine le script courant
		exit;
	}
	}
}
?>
<html>
<head>
<title>Insertion d'un nouveau sujet</title>
</head>

<body>

<!-- on fait pointer le formulaire vers la page traitant les données -->
<form action="insert_sujet.php" method="post">
<table>
<tr><td>
<b>Auteur :</b>
</td><td>
<input type="text" name="auteur" maxlength="30" size="50" value="<?php if (isset($_POST['auteur'])) echo htmlentities(trim($_POST['auteur'])); ?>">
</td></tr><tr><td>
<b>Titre :</b>
</td><td>
<input type="text" name="titre" maxlength="50" size="50" value="<?php if (isset($_POST['titre'])) echo htmlentities(trim($_POST['titre'])); ?>">
</td></tr><tr><td>
<b>Message :</b>
</td><td>
<textarea name="message" cols="50" rows="10"><?php if (isset($_POST['message'])) echo htmlentities(trim($_POST['message'])); ?></textarea>
</td></tr><tr><td><td>
<input type="submit" name="go" value="Poster">
</td></tr></table>
</form>
<?php
// on affiche les erreurs éventuelles
if (isset($erreur)) echo '<br /><br />',$erreur;
?>






<footer style="background-color: #2E7D32; color: #F5E6CC; font-family: montserrat; font-size: 20px; padding: 0px; position: absolute; bottom: 0; width: 100%;  ">
	
	<p style="text-align: center;">Notre Forum de discussion - Tous droits réservés - &copy; 2025 Notre Forum de discussion</p>
	
</footer>

</body>
</html>