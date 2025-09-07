<div class="hero-scene text-center text-white" style="background-color: #F5E6CC; color: #2E7D32; text-align: center;">
        <div class="hero-scene-content">
                <h1 class="hero-scene-text">Lecture des sujets </h1>
        </div>
</div>
<br><br><br><br><br>

<section >
    <nav class="navbar navbar-expand-lg bg-primary " data-bs-theme="dark" style="background-color: #2E7D32;  list-style: none; color: #F5E6CC; display: flex;">
        <div class="container-fluid">
            <a class="navbar-brand" href="/Blog" style="color: #F5E6CC; font-weight: bold;font-size: 20px; font: montserrat">Tableau de bord </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/liens" style="color: #F5E6CC; text-decoration: none; padding: 10px;">Liens Utiles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/calendrier" style="color: #F5E6CC; text-decoration: none; padding: 10px;">Calendrier des Gardes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/VideGrenier" style="color: #F5E6CC; text-decoration: none; padding: 10px;">Vide grenier</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/GalerieSPV" style="color: #F5E6CC; text-decoration: none; padding: 10px;">Gestion des Photos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Blog" style="color: #F5E6CC; text-decoration: none; padding: 10px;">Discutions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/account" style="color: #F5E6CC; text-decoration: none; padding: 10px;">Mon Compte</a>
                        </li>
                    </ul>
                </div>
        </div>
    </nav>
</section>

<section style="background-color: #F5E6CC;">
<?php
if (!isset($_GET['IdLireSujet'])) {
	echo 'Sujet non défini.';
}
else {
?>
	<table class="blog_table">
	<tr>
		<td width="500" style="border: 1px solid black;">
			Auteur
		</td>
		<td width="500" style="border: 1px solid black;">
			Messages
		</td >
	</tr>

<?php
	// on se connecte à notre base de données
	$base = mysqli_connect ('mysql-pompiers-leon.alwaysdata.net', '408942', '@Admin-2025@');
	mysqli_select_db ($base, 'pompiers-leon_admin') ;

	// on prépare notre requête
	$sql = 'SELECT auteur, message, date_reponse FROM forum_reponses WHERE correspondance_sujet="'.$_GET['IdLireSujet'].'" ORDER BY date_reponse ASC';

	// on lance la requête (mysqli_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
	$req = mysqli_query($base, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($base));

	// on va scanner tous les tuples un par un
	while ($data = mysqli_fetch_array($req)) {

	// on décompose la date
	sscanf($data['date_reponse'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);

	// on affiche les résultats
	echo '<tr>';
	echo '<td width="500" style="border: 1px solid black;">';

	// on affiche le nom de l'auteur de sujet ainsi que la date de la réponse
	echo htmlentities(trim($data['auteur']));
	echo '<br />';
	echo $jour , '-' , $mois , '-' , $annee , ' ' , $heure , ':' , $minute;

	echo '</td>
	<td width="500" style="border: 1px solid black;">';

	// on affiche le message
	echo nl2br(htmlentities(trim($data['message'])));
	echo '</td><hr></tr>';
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
	<a href="../forum/insert_reponse.php?NumeroSujet=<?php echo $_GET['IdLireSujet']; ?>">Répondre</a>
	<?php
}
?>

<br /><br />
<!-- on insère un lien qui nous permettra de retourner à l'accueil du forum -->
<a href="/Blog">Retour à l'accueil du forum</a>

</section>

