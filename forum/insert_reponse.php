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
<body style="background-color: #F5E6CC">

<header>

<div class="hero-scene text-center text-white" style="position: absolute; top:-130px; left:0; width:100%; height:68%; background-image: url(../Images/groupe2023.jpg); background-size: cover; filter: brightness(0.5);">
        <div class="hero-scene-content">
                <h1 class="hero-scene-text">Forum</h1>
        </div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

	<nav>
  		<div class="navbar" style="background-color: #2E7D32;">
			<a href="/">Accueil</a>
   			<a href="/blog">forum</a>    
  		</div>
	</nav>
	<br>
		<h1 style="color: #2E7D32; text-align: center; border-width: 2px; border-style: solid; border-color: rgb(196, 29, 29); background-color: rgb(227, 227, 227);width: 1300px;margin: 20px 175px; border-collapse: collapse;">Insertion d'une nouvelle réponse</h1>
</header>
<br>
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

<br><br><br>
<!-- on insère un lien qui nous permettra de retourner à l'accueil du forum -->
<a href="/Blog" style="border-radius: 5px; background-color: #2E7D32; color: #F5E6CC; padding: 10px 15px; text-decoration: none; width: 1300px; margin: auto  175px;">Retour à l'accueil</a>
<br><br><br>

<footer style="background-color: #2E7D32; color: #F5E6CC; font-family: montserrat; font-size: 20px; padding: 1px; bottom: 0; width: 100%;">
	
	<p style="text-align: center;">Notre Forum de discussion - Tous droits réservés - &copy; 2025 Notre Forum de discussion</p>
	
</footer>

</body>
</html>