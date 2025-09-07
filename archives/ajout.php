<div class="hero-scene text-center text-white">
        <div class="hero-scene-content">
                <h1 class="hero-scene-text">Blog</h1>
        </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>



<div class="container">
    <h1  class="text-center text-primary admin">Ajouter un nouvel article</h1>
    <form action="/ajout_blog.php" method="POST">
        <div class="mb-3">
            <input type="text" name="title" placeholder="Titre" required>
        </div>
        <div class="mb-3">
            <textarea name="content" placeholder="Contenu" required></textarea>
        </div>
        <div class="mb-3"> 
        <button type="submit">Publier</button>
        </div>
    </form>
</div>






