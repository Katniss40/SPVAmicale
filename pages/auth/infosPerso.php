<div class="hero-scene text-center text-white">
    <div class="hero-scene-content">
        <h1 class="hero-scene-text">Vos informations de connexions</h1>
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

<h2 style="text-align: center;">Informations Personnelles</h2>
    <table>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Adresse</th>
            <th>Téléphone</th>
            <th>Adresse mail</th>
        </tr>
        <?php
        // Exemple de données personnelles
        $personnes = [
            ["nom" => "Dupont", "prenom" => "Jean", "adresse" => "123 Rue de la Paix, Paris", "tel" => "01.02.03.04.05", "email" => "jean.dupont@example.com"],
            
        ];

        // Affichage des données dans le tableau
        foreach ($personnes as $personne) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($personne['nom']) . "</td>";
            echo "<td>" . htmlspecialchars($personne['prenom']) . "</td>";
            echo "<td>" . htmlspecialchars($personne['adresse']) . "</td>";
            echo "<td>" . htmlspecialchars($personne['tel']) . "</td>";
            echo "<td>" . htmlspecialchars($personne['email']) . "</td>";
            echo "</tr>";
        }

        ?>
    </table>

    <table>
        <tr>
            <th>Mot de passe Site web</th>
            <th>Mot de passe APIS</th>
            <th>Mot de passe FIREWALL</th>
            <th>Mot de passe OUTLOOK</th>
        </tr>

        <?php
        // Exemple de données personnelles
        $personnes = [
            ["mdpSite" => "MDP", "mdpApis" => "MDP", "mdpFire" => "MDP", "mdpOutl" => "MDP"],
            
        ];

        // Affichage des données dans le tableau
        foreach ($personnes as $personne) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($personne['mdpSite']) . "</td>";
            echo "<td>" . htmlspecialchars($personne['mdpApis']) . "</td>";
            echo "<td>" . htmlspecialchars($personne['mdpFire']) . "</td>";
            echo "<td>" . htmlspecialchars($personne['mdpOutl']) . "</td>";
            echo "</tr>";
        }

        ?>
    </table>