<div class="hero-scene text-center text-white">
    <div class="hero-scene-content">
        <h1 class="hero-scene-text">Changement de mot de passe</h1>
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
                            <a class="nav-link" href="/Blog">Discussions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/forum/account.php">Mon Compte</a>
                        </li>
                    </ul>
                </div>
        </div>
    </nav>

</section>


    <div class="container">
        <br>
        <h3> Modification</h3>
        <br>
        <form>
            <div class="mb-3">
              <label for="OdlPasswordInput" class="form-label">Ancien Mot de passe</label>
              <input type="password" class="form-control" id="OdlPasswordInput" name="Password">
            </div>
            <div class="mb-3">
              <label for="NewPasswordInput" class="form-label">Nouveau Mot de passe</label>
              <input type="password" class="form-control" id="NewPasswordInput" name="Password">
            </div>
            <div class="mb-3">
                <label for="ValidatePasswordInput" class="form-label">Validez votre mot de passe</label>
                <input type="password" class="form-control" id="ValidatePasswordInput" name="PasswordConfirm">
              </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Changer mon mot de passe</button>
            </div>
        </form>
        <div class="text-center pt-3">
            <a href="/account">Modifier mes informations personnelles</a>
        </div>
    </div>