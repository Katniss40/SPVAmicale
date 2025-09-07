<div class="hero-scene text-center text-white">
        <div class="hero-scene-content">
                <h1 class="hero-scene-text">Galerie</h1>
        </div>
</div>
<br><br><br><br><br>

<section >
    <nav class="navbar navbar-expand-lg bg-primary " data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/Blog" >Tableau de bord </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
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
                            <a class="nav-link" href="/Blog">Discutions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/account">Mon Compte</a>
                        </li>
                    </ul>
                </div>
        </div>
    </nav>

</section>

<section>
    <article>
        <div class="container p-4" data-show="admin, spv"><br><br>
            <h1 class="text-center text-primary admin">Ajouter Une Photo</h1>

                <!-- Formulaire pour ajouter une photo -->
                <form action="./pages/galerie/upload.php" method="POST" enctype="multipart/form-data">
                    <label for="photo">Sélectionné la photo :</label>
                    
                    <input type="file" name="photo" id="photo" accept="image/*" required>
                    <p style="font-size: x-small;">* Formats acceptés : jpg, jpeg, png, gif, webp /  Attention la photo doit etre au format 200X200 px max:-)</p>
                    <br>
                    
                    <!--<label for="custom_name">Nom personnalisé :</label>
                    <input type="text" name="custom_name" id="custom_name" placeholder="Nom de l'image" required>-->
                    <br>
                    <button type="submit" class="delete-button">Ajouter</button>
                </form>
        </div>
    </article>

<br>
<br>
<hr>

   <article>

   <div class="container p-4" data-show="admin, spv">
            <!-- Liste des photos -->
    <h2 class="text-center text-primary admin">La galerie Photos</h2> 

              <?php
              
// Chemin du dossier contenant les images
$dossier = '../../uploads/';

// Vérifie si le dossier existe
if (is_dir($dossier)) {
    // Ouvre le dossier
    if ($handle = opendir($dossier)) {
        echo '<div style="display: flex; flex-wrap: wrap; gap: 10px; justify-content: space-between;">';
        
        // Parcourt les fichiers du dossier
        while (($file = readdir($handle)) !== false) {
            // Vérifie si le fichier est une image
            if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                echo '<img src="' . $dossier . $file . '" alt="' . $file . '" style="width: 200px; height: 200px; border: 1px solid #ccc; box-shadow:8px 8px 10px 0 rgba(0,0,0,0.5) justify-content: space-between" class="rounded w-25">';
                echo '<form action="/pages/galerie/delete.php" method="POST" style="display:inline;">
                       <input type="hidden" name="photo" value="' . $dossier . $file . '">
                       <button type="submit" class="delete-button"><i class="bi bi-trash"></i></button>
                    </form>';
                }
                 }
        
                     echo '</div>';
                    closedir($handle);
                }
                } else {
                    echo 'Le dossier n\'existe pas.';
                }

            ?>

        </div>

    </article>
</section>  