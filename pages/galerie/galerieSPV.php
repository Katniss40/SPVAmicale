<div class="hero-scene text-center text-white">
    <div class="hero-scene-content">
        <h1 class="hero-scene-text">Galerie</h1>
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
        <div class="container p-4"><br>
            <!-- Titre harmonisé -->
            <div class="mb-5 text-center">
                <h1 class="policeNav" style="color: #2E7D32; font-size: 2.5rem; font-weight: 700; letter-spacing: 0.5px;">
                    <i class="bi bi-image me-3"></i>Ajouter Une Photo
                </h1>
                <div style="width: 60px; height: 4px; background: #2E7D32; margin: 15px auto; border-radius: 2px;"></div>
            </div>

            <!-- Formulaire professionnel avec drag & drop -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0 rounded-4" style="border-top: 5px solid #2E7D32;">
                        <div class="card-body p-5" style="background: #fafafa;">
                            <form method="post" action="/pages/galerie/ajouter_photo.php" enctype="multipart/form-data" id="formAjouterPhoto">
                                
                                <!-- Input file - HIDDEN -->
                                <input type="file" id="fileInput" name="photo" accept="image/*" style="display: none; pointer-events: none;">
                                
                                <!-- Zone clickable LABEL -->
                                <label for="fileInput" id="dropZone" style="display: flex; border: 3px dashed #2E7D32; padding: 40px 20px; text-align: center; background: #f0f7f0; border-radius: 12px; margin-bottom: 20px; min-height: 250px; align-items: center; justify-content: center; flex-direction: column; cursor: pointer; user-select: none;">
                                    <i class="bi bi-cloud-arrow-up" style="font-size: 3rem; color: #2E7D32; display: block; margin-bottom: 10px;"></i>
                                    <p style="color: #2E7D32; font-weight: 600; font-size: 1.1rem; margin: 0; padding: 0;">Glissez votre image ici ou cliquez</p>
                                    <small style="color: #999; margin-top: 5px;">PNG, JPG, WEBP jusqu'à 10 Mo</small>
                                </label>

                                <!-- Aperçu image -->
                                <div id="previewContainer" class="mb-4" style="display: none;">
                                    <div class="text-center">
                                        <img id="previewImage" src="" alt="Aperçu" class="img-fluid rounded-3" style="max-height: 300px; max-width: 100%; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                        <p id="fileName" class="mt-2" style="font-size: 0.95rem; color: #666;"></p>
                                        <button type="button" id="btnClearImage" class="btn btn-sm btn-outline-secondary mt-2">Changer l'image</button>
                                    </div>
                                </div>

                                <!-- Commentaire -->
                                <div class="mb-4">
                                    <label for="commentaire" class="form-label" style="color: #2E7D32; font-weight: 600;">Commentaire (optionnel)</label>
                                    <textarea name="commentaire" id="commentaire" class="form-control form-control-lg" rows="5" placeholder="Décrivez cette photo..." style="border: 2px solid #E0E0E0; border-radius: 12px;"></textarea>
                                    <small id="charCount" style="color: #999; display: block; margin-top: 5px;">0 / 500 caractères</small>
                                </div>

                                <!-- Info box -->
                                <div class="alert alert-info border-0 rounded-3 mb-4" style="background: #E3F2FD; color: #1565C0;">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <strong>Conseil :</strong> Utilisez des images de bonne qualité (au moins 1200x800px) pour une meilleure présentation en galerie.
                                </div>

                                <!-- Boutons -->
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="reset" class="btn btn-outline-secondary btn-lg rounded-3" style="font-weight: 600;">Annuler</button>
                                    <button type="submit" class="btn btn-lg rounded-3" style="background: #2E7D32; color: white; font-weight: 600; border: none;">
                                        <i class="bi bi-upload me-2"></i>Envoyer la photo
                                    </button>
                                </div>

                                <!-- Progress bar -->
                                <div id="progressContainer" style="display: none; margin-top: 20px;">
                                    <div class="progress" style="height: 6px;">
                                        <div id="progressBar" class="progress-bar" style="background: #2E7D32; width: 0%;"></div>
                                    </div>
                                    <p id="progressText" class="text-center mt-2" style="font-size: 0.9rem; color: #666;">Envoi en cours...</p>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script src="/JS/galerieSPV-upload.js"></script>
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