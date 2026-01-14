<!-- Styles forum alignés avec admin -->
<link rel="stylesheet" href="/assets/css/forum-custom.css">

<div class="hero-scene text-center text-white">
        <div class="hero-scene-content">
                <h1 class="hero-scene-text">Forum de Discussion</h1>
        </div>
</div>


<section>
    <nav class="navbar navbar-expand-lg bg-primary " data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin" data-show="admin">Tableau de bord Administrateur</a>

            <a class="navbar-brand" href="/Blog" data-show="actif" >Tableau de bord </a>
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
                            <a class="nav-link" href="/fendeuse">Réservation fendeuse</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/forum/account.php">Mon Compte</a>
                        </li>
                    </ul>
                </div>
        </div>
    </nav>

</section>

<section class="admin-page">
    <article>
        <div class="container p-4">
            <div class="page-title-container text-center">
                <h1 class="page-title"><i class="bi bi-chat-dots me-3"></i>Discussions et Débats</h1>
                <div class="page-title-underline"></div>
            </div>
        </div>
    </article>
</section>

<br>
<br>

<section>
    <div class="container">
            <!-- on place un lien permettant d'accéder à la page contenant le formulaire d'insertion d'un nouveau sujet -->  
             <br>
            
             <a href="/Isujet" data-show="admin" class="btn btn-primary">Insérer un sujet</a><!-- le lien vers la page d'ajout d'un sujet fonctionne -->
            
            <a href="/admin" data-show="admin" class="btn btn-primary">Retour au tableau de bord</a>
            </div>
            <br />
            <br />
    <div class="container">
<?php



// on se connecte à notre base de données via le helper centralisé
require_once __DIR__ . '/../controleurs/db_mysqli.php';
$base = $mysqli;

// préparation de la requete
$sql = 'SELECT id, auteur, titre, date_derniere_reponse FROM forum_sujets ORDER BY date_derniere_reponse DESC';

// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
$req = mysqli_query($base, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($base));

// on compte le nombre de sujets du forum
$nb_sujets = mysqli_num_rows($req);

// Tableau d'affichage des sujets
if ($nb_sujets == 0) {
	echo 'Aucun sujet';
}
else {
	?>
	<table class="blog_table"><tr>
	<td>
	<b>Auteur</b>
	</td><td>
	<b>Titre du sujet</b>
	</td><td>
	<b>Date dernière réponse</b>
	</td></tr>
	<?php
	// on va scanner tous les tuples un par un
	while ($data = mysqli_fetch_array($req)) {

	// on décompose la date
	sscanf($data['date_derniere_reponse'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);

	// on affiche les résultats
	echo '<tr>';
	echo '<td>';

	// on affiche le nom de l'auteur de sujet
	echo htmlentities(trim($data['auteur']));
	echo '</td><td>';

	// on affiche le titre du sujet, et sur ce sujet, on insère le lien qui nous permettra de lire les différentes réponses de ce sujet
    //echo '<a href="/Lsujet?id_sujet_a_lire=' , $data['id'] , '">' , htmlentities(trim($data['titre'])) , '</a>';
	echo '<a href="../forum/lire_sujet.php?id_sujet_a_lire=' , $data['id'] , '">' , htmlentities(trim($data['titre'])) , '</a>';
    //echo '<a href="/Forum/lire_sujet.php?id_sujet_a_lire=' , $data['id'] , '">' , htmlentities(trim($data['titre'])) , '</a>';

	echo '</td><td>';

	// on affiche la date de la dernière réponse de ce sujet
	echo $jour , '-' , $mois , '-' , $annee , ' ' , $heure , ':' , $minute;
	}
	?>
	</td></tr></table>
	<?php
}

// on libère l'espace mémoire alloué pour cette requête
mysqli_free_result ($req);
// on ferme la connexion à la base de données.
mysqli_close ($base);
?>
    </div>
</section>