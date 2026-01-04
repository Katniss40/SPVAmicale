<div class="hero-scene text-center text-white">
    <div class="hero-scene-content">
        <h1 class="hero-scene-text">Galerie</h1>
    </div>
</div>

<br><br><br><br><br>


<section>
    <nav class="navbar navbar-expand-lg bg-primary " data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin" data-show="admin">Tableau de bord Administrateur</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

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



<section>
    <article>
        <div class="container p-4"><br><br>
            <h1 class="text-center text-primary admin">Ajouter Une Photo</h1>

            <!-- ✅ Formulaire d'ajout -->
            <form method="post" action="/pages/galerie/ajouter_photo.php" enctype="multipart/form-data">
                <input type="file" name="photo" accept="image/*" required>
                <br><br>
                <textarea name="commentaire" rows="6" cols="60" placeholder="Commentaire sur la photo"></textarea>
                <br>
                <button type="submit">Ajouter</button>
            </form>
        </div>
    </article>

    <br><br><hr>

    <article>
        <div class="container p-4">
            <h2 class="text-center text-primary admin">La galerie Photos</h2>
            <div class="galerieSPV">
                <?php
                include("connexion.php");
                $result = $conn->query("SELECT * FROM photos ORDER BY id DESC");

                while ($photo = $result->fetch_assoc()) {
                    $src = !empty($photo['url']) ? $photo['url'] : $photo['name'];
                    echo '<div class="photo-card-admin">';
                    echo '<img src="' . htmlspecialchars($src) . '" alt="photo" class="galerie-photo">';
                    echo '<p>' . htmlspecialchars($photo['commentaire']) . '</p>';
                    echo '<form method="post" action="/pages/galerie/delete.php" onsubmit="return confirm(\'Supprimer cette photo ?\');">';
                    echo '<input type="hidden" name="photo_id" value="' . intval($photo['id']) . '">';
                    echo '<button type="submit" class="delete-button"><i class="bi bi-trash"></i></button>';
                    echo '</form>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </article>
</section>