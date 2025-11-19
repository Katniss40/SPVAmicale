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

                <div class="galerieSPV" style="display: flex; flex-wrap: wrap; gap: 10px; justify-content: space-between;">
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
                    echo '<div style="text-align: center;">';
                    echo '<img src="' . htmlspecialchars($src) . '" alt="photo" style="width:auto; height:300px; border:1px solid #ccc; box-shadow:8px 8px 10px rgba(0,0,0,0.5); border-radius:5px;" class="galerie-photo">';
                    echo '<p style="margin-top: 8px; font-size: 20px; color: #333;">' . htmlspecialchars($photo['commentaire']) . '</p>';
                    //echo '<form method="post" action="/pages/galerie/delete.php" onsubmit="return confirm(\'Supprimer cette photo ?\');">';
                    echo '<input type="hidden" name="photo_id" value="' . intval($photo['id']) . '">';
                    //echo '<button type="submit" class="delete-button"><i class="bi bi-trash"></i></button>';
                    echo '</form>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </article>

</section>  