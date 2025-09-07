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
	  background-color: #F5E6CC;
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


<body  style="background-color: #F5E6CC">

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
		<h1 style="border-radius: 10px; color: #2E7D32; text-align: center; border-width: 2px; border-style: solid; border-color: rgb(196, 29, 29); background-color: rgb(227, 227, 227);width: 1300px;margin: 20px 175px; border-collapse: collapse;">Insertion d'une nouvelle réponse</h1>
</header>



<!-- on insère un lien qui nous permettra de retourner à l'accueil du forum -->
<a href="/blog" style="border-radius: 5px; background-color: #2E7D32; color: #F5E6CC; padding: 10px 15px; text-decoration: none;">Retour à l'accueil</a>

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
	<a href="./insert_reponse.php?numero_du_sujet=<?php echo $_GET['id_sujet_a_lire']; ?>" style="border-radius: 5px; background-color: #2E7D32; color: #F5E6CC; padding: 10px 15px; text-decoration: none;">Répondre</a>
	<?php
}
?>
<br /><br />
<br>
<p></p>


<footer style="background-color: #2E7D32; color: #F5E6CC; font-family: montserrat; font-size: 20px; padding: 1px; bottom: 0; width: 100%;  ">
	
	<p style="text-align: center;">Notre Forum de discussion - Tous droits réservés - &copy; 2025 Notre Forum de discussion</p>
	
</footer>

</body>
</html>