<div class="hero-scene text-center text-white">
        <div class="hero-scene-content">
                <h1 class="hero-scene-text">Gestion des membres</h1>
                <div><a href="/admin" class="btn btn-primary" data-show="admin">Retour au Tableau de bord</a></div>
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
<br>
<section>
<div class="container liens-utiles spv">
    <div>
        <br>
        <div class="row bg-arc-mint-green-light-staff py-3">
            <div class="card-list-employe mt-3">
                <div class="card-header">
                    <h2 class="text-center text-primary admin">Liste des Membres enregistrés</h2>
                </div>

                <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Rôle</th>
                                    <th>Code Agent</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Adresse</th>
                                    <th>Mot de Passe</th>
                                    <th>Em@il</th>
                                    <th>Téléphone</th>                                                           
                                </tr>
                            </thead>

                            <?php
                    include("connexion.php");
                    
                    //$conn = new mysqli("mysql-pompiers-leon.alwaysdata.net", "408942", "@Admin-2025@", "pompiers-leon_admin");

                    //if ($conn->connect_error) {
                        //die("Échec de la connexion : " . $conn->connect_error);
                    //}

                    $sql = "SELECT * FROM Users";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Role']) . "</td>";
                            echo "<td>" . $row['CAgent'] . "</td>";
                            echo "<td>" . htmlspecialchars($row['NomInput']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['PrenomInput']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Adresse']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['PasswordInput']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['EmailInput']) . "</td>"; 
                            echo "<td>" . htmlspecialchars($row['Telephone']) . "</td>";                                                                                                                          
                            //echo "<td><a href='/pages/admin/modif_spv.php'" . $row['id'] . "' class='btn btn-primary btn-sm'>Modif</a> ";
                            //echo "<a href='/pages/admin/supp_spv.php'" . $row['id'] . "' class='btn btn-danger btn-sm'>Supp</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='12'>Aucun employés trouvé.</td></tr>";
                    }
                    $conn->close();
                    ?>

                        </table>
                </div>
            </div>
        </div>
    </div>    
</section>

