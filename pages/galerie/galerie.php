<div class="hero-scene text-center text-white">
        <div class="hero-scene-content">
                <h1 class="hero-scene-text">Galerie</h1>
        </div>
</div>
<br><br><br><br><br>


<article>
        <div class="container p-4">
                    <!-- Liste des photos -->
            <h2 class="text-center text-primary admin">La galerie Photos</h2> 

                <div class="galerie-public">
                    <?php

                    //include("connexion.php");

                   // $result = $conn->query("SELECT * FROM photos ORDER BY id DESC");
                   // while ($photo = $result->fetch_assoc()) {
                   //     echo '<div style="text-align: center;">';
                   //     echo '<img src="' . $photo['name'] . '" alt="photo" style="width: auto; height: 300px; border: 1px solid #ccc; box-shadow: 8px 8px 10px rgba(0,0,0,0.5); border-radius: 5px;" class="galerie-photo">';
                   //     echo '<p style="margin-top: 8px; font-size: 20px; color: #333;">' . htmlspecialchars($photo['commentaire']) . '</p>';
                        
                   //     echo '</div>';
                  //  }


                include("connexion.php");
                $result = $conn->query("SELECT * FROM photos ORDER BY id DESC");

                while ($photo = $result->fetch_assoc()) {
                    $src = !empty($photo['url']) ? $photo['url'] : $photo['name'];
                    echo '<div class="photo-card" onclick="openLightbox(this)">';
                    echo '<img src="' . htmlspecialchars($src) . '" alt="photo" class="galerie-photo" data-full-src="' . htmlspecialchars($src) . '" data-comment="' . htmlspecialchars($photo['commentaire']) . '">';
                    echo '<p>' . htmlspecialchars($photo['commentaire']) . '</p>';
                    echo '<input type="hidden" name="photo_id" value="' . intval($photo['id']) . '">';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </article>

</section>

<!-- Lightbox Carrousel -->
<div id="photoLightbox" class="photo-lightbox" style="display: none;">
    <div class="lightbox-content">
        <button class="lightbox-close" onclick="closeLightbox()">✕</button>
        <button class="lightbox-prev" onclick="prevPhoto()">❮</button>
        <img class="lightbox-image" id="lightboxImage" src="" alt="Photo" />
        <button class="lightbox-next" onclick="nextPhoto()">❯</button>
        <p class="lightbox-comment" id="lightboxComment"></p>
    </div>
</div>  