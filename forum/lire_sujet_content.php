<?php
// forum/lire_sujet_content.php
// Version partielle pour injection SPA (uniquement le contenu du sujet)
if (!isset($_GET['id_sujet_a_lire'])) {
    echo '<div class="admin-card"><h2 class="titre-section">Sujet non défini.</h2></div>';
} else {
    // Utiliser le helper centralisé pour la connexion MySQL
    require_once __DIR__ . '/../pages/controleurs/db_mysqli.php';
    $base = $mysqli;
    $id_sujet = mysqli_real_escape_string($base, $_GET['id_sujet_a_lire']);
    $sql_titre = 'SELECT titre FROM forum_sujets WHERE id="' . $id_sujet . '"';
    $req_titre = mysqli_query($base, $sql_titre);
    $titre_sujet = '';
    if ($req_titre && $data_titre = mysqli_fetch_array($req_titre)) {
        $titre_sujet = htmlentities(trim($data_titre['titre']));
    }
    mysqli_free_result($req_titre);
    echo '<div class="admin-card">';
    echo '<h1 class="titre-section">Lecture du sujet : ' . $titre_sujet . '</h1>';
    echo '<br>';
    echo '<div class="forum-reponses-list">';
    $sql = 'SELECT auteur, message, date_reponse FROM forum_reponses WHERE correspondance_sujet="' . $id_sujet . '" ORDER BY date_reponse ASC';
    $req = mysqli_query($base, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($base));
    $nb_reponses = 0;
    while ($data = mysqli_fetch_array($req)) {
        $nb_reponses++;
        sscanf($data['date_reponse'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);
        echo '<div class="forum-reponse-card">';
        echo '<div class="forum-reponse-header">';
        echo '<span class="forum-reponse-auteur">' . htmlentities(trim($data['auteur'])) . '</span>';
        echo '<span class="forum-reponse-date">' . $jour . '-' . $mois . '-' . $annee . ' ' . $heure . ':' . $minute . '</span>';
        echo '</div>';
        echo '<div class="forum-reponse-message">' . nl2br(htmlentities(trim($data['message']))) . '</div>';
        echo '</div>';
    }
    if ($nb_reponses === 0) {
        echo '<div class="forum-reponse-card"><em>Aucune réponse pour ce sujet pour le moment.</em></div>';
    }
    mysqli_free_result($req);
    mysqli_close($base);
    echo '</div>';
    echo '<br />';
    echo '<a class="btn" href="./insert_reponse.php?numero_du_sujet=' . $id_sujet . '">Répondre</a>';
    echo '</div>';
}
?>
