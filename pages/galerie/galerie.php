<div class="hero-scene text-center text-white">
        <div class="hero-scene-content">
                <h1 class="hero-scene-text">Galerie</h1>
        </div>
</div>
<br><br><br><br><br>

    <article>
        <div class="container p-4">
            <!-- Liste des photos -->
            <h2 class="text-center text-primary admin">La galerie Photos de vos pompiers préférés</h2>
<div class="gallery"></div>
<br>

                <?php

// Chemin du dossier contenant les images
$dossier = '../../uploads/';

// Vérifie si le dossier existe
if (is_dir($dossier)) {
    // Ouvre le dossier
    if ($handle = opendir($dossier)) {
        echo '<div style="display: flex; flex-wrap: wrap; gap: 10px;justify-content: space-between;">';
        
        // Parcourt les fichiers du dossier
        while (($file = readdir($handle)) !== false) {
            // Vérifie si le fichier est une image
            if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                echo '<img src="' . $dossier . $file . '" alt="' . $file . '" style="width: 200px; height: 200px; border: 2px solid #ccc; box-shadow:8px 8px 10px 0 rgba(0,0,0,0.5)" class="rounded w-25">';
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