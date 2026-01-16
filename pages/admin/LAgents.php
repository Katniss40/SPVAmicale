<div class="hero-scene text-center text-white">
        <div class="hero-scene-content">
                <h1 class="hero-scene-text">Liste des Agents</h1>
                <div><a href="/" class="btn btn-primary">Retour Accueil</a></div>
        </div>
</div>

<section>
    <nav class="navbar navbar-expand-lg bg-pompier navbar-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin" data-show="admin">Tableau de bord Administrateur</a>

            <a class="navbar-brand" href="/Blog" data-show="actif" >Tableau de bord </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
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
                            <a class="nav-link" href="/fendeuse">Réservation fendeuse</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/forum/account.php">Mon Compte</a>
                        </li>
                    </ul>
                </div>
        </div>
    </nav>

</section>

<section class="admin-page">
    <article class="bg-white text-black">
        <div class="container p-4">
            <div class="page-title-container text-center">
                <h1 class="page-title"><i class="bi bi-calendar-check me-3"></i>Gardes et Formations SPV</h1>
                <div class="page-title-underline"></div>
            </div>
        </div>
    </article>
</section>




<section class="container">
    <!-- Liste des Membres enregistrés-->
    <div class="row bg-arc-mint-green-light-staff py-3">
        <div class="card-list-employe mt-3">
            <h2 class="text-center text-primary admin">Liste des Agents Actifs</h2>

            <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <!--<th>ID</th>
                                <th>Rôle</th>-->
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Adresse</th>
                                <!--<th>Mot de Passe</th>-->
                                <th>Em@il</th>
                                <th>Téléphone</th>                                                           
                            </tr>
                        </thead>

                        <?php
                include("connexion.php");
                require_once __DIR__ . '/../controleurs/hidden_accounts.php';

                $sql = "SELECT * FROM Users";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        // Ne pas afficher les comptes masqués
                        if (is_hidden_user($row)) {
                            continue;
                        }
                        echo "<tr>";
                        //echo "<td>" . htmlspecialchars(string: $row['ID']) . "</td>";
                        //echo "<td>" . htmlspecialchars($row['Role']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['NomInput']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['PrenomInput']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Adresse']) . "</td>";
                        //echo "<td>" . htmlspecialchars($row['PasswordInput']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['EmailInput']) . "</td>"; 
                        echo "<td>" . htmlspecialchars($row['Telephone']) . "</td>";                                                                                                                          
                        //echo "<td><a href='/pages/admin/modif_spv.php'" . $row['id'] . "' class='btn btn-primary btn-sm'>Modif</a> ";
                        //echo "<a href='/pages/admin/supp_spv.php'" . $row['id'] . "' class='btn btn-danger btn-sm'>Supp</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12'>Aucun Sapeurs Pompiers trouvés trouvé.</td></tr>";
                }
                $conn->close();
                ?>

                    </table>
            </div>
        </div>
    </div>
</section>