<!-- Styles globaux + habillage des blocs admin (sans toucher hero/nav) -->
<link rel="stylesheet" href="/assets/css/global.css">
<link rel="stylesheet" href="/assets/css/admin-custom.css">

<div class="hero-scene admin-hero text-center text-white">
    <div class="hero-scene-content">
        <h1 class="hero-scene-text">Espace Administrateur</h1>
        <div><a href="/" class="btn btn-primary">Retour Accueil</a></div>
    </div>
</div>
<section>
    <nav class="navbar navbar-expand-lg bg-primary admin-subnav" data-bs-theme="dark">
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
                            <a class="nav-link" href="/fendeuse">Réservation fendeuse</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="reservationsDropdownAdmin" role="button" data-bs-toggle="dropdown" aria-expanded="false">Réservations</a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="reservationsDropdownAdmin">
                                <li><a class="dropdown-item" href="/fendeuse">Fendeuse</a></li>
                                <li><a class="dropdown-item" href="/reservation-vl">VL</a></li>
                                <li><a class="dropdown-item" href="/admin/reservations-vl">Historique</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/forum/account.php">Mon Compte</a>
                        </li>
                        <li class="nav-item" data-show="admin">
                            <a class="nav-link" href="/forum/reponses_supprimees.php">Réponses supprimées</a>
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
                <h1 class="page-title"><i class="bi bi-gear me-3"></i>Tableau de Bord Administrateur</h1>
                <div class="page-title-underline"></div>
            </div>
        </div>
    </article>
</section>

<section class="admin-page">
<div class="container">
    <h1 class="titre-section">Bienvenue sur votre tableau de bord</h1>

    <div class="mb-3">
        <div class="column column-1">

                <p class="admin-intro">Vous pouvez accéder à toutes les fonctionnalités réservées à l'administration du site.</p>
            
                <!-- Ajout d'un nouveau membre--> <!-- Ca fonctionne ne plus toucher -->
            <div class="admin-card">
                <div class="card-header bg-arc-mint-green text-light">
                    <h2 class="titre-section">Ajouter un nouveau membre</h2>  <!-- Ca fonctionne -->
                </div>                    
                    <form action="/pages/admin/gestion_spv.php" method="POST" class="form-contact">
                        <div class="row">                                                       
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label for="Role">Rôle</label>
                                    <select class="form-control" id="Role", name="Role">
                                        <option value="admin">admin</option>
                                        <option value="actif">actif</option>
                                    </select>    
                                </div>
                                <div class="form-group">
                                    <label for="NomInput">Nom</label>
                                    <input type="text" class="form-control" id="NomInput" name="NomInput" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="PrenomInput">Prénom</label>
                                    <input type="text" class="form-control" id="PrenomInput" name="PrenomInput" value="" required>                              
                                </div>
                                <div class="form-group">
                                    <label for="Adresse">Adresse</label>
                                    <input type="text" class="form-control" id="Adresse" name="Adresse" value="" required>
                                </div>                                                                                                                                                     
                            </div>

                            <div class="col-md-6">   
                                <div class="form-group">
                                    <label for="CAgent">Code Agent</label>
                                    <input type="number" class="form-control" id="CAgent", name="CAgent", value="" required>
                                </div>                             
                                <div class="form-group">
                                    <label for="PasswordInput">Mot de passe</label>
                                    <input type="password" class="form-control" id="PasswordInput" name="PasswordInput" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="EmailInput">Email</label>
                                    <input type="email" class="form-control" id="EmailInput" name="EmailInput" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="Telephone">Téléphone</label>
                                    <input type="text" class="form-control" id="Telephone" name="Telephone" value="" required>
                                </div>                          
                            </div>
                        </div>
                        <br>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        <br>
                    </form>
            </div>  
            
            <div>

            </div>
                <br>
                <br>

            <!-- Modification d'un membre--> <!-- Ca fonctionne ne plus toucher-->
            <div class="admin-card">
                <div class="card-header bg-arc-mint-green text-light">
                    <h2 class="titre-section">Modifier un membre</h2>  <!-- Ca fonctionne -->
                </div>                    
                    <form action="/pages/admin/modif_spv.php" method="POST" class="form-contact">
                        <div class="row">
                            <div class="form-group">
                                    <label for="ID">ID</label>
                                    <input type="number" class="form-control" id="ID" name="ID" autocomplete="off" placeholder="" required>
                                </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Cagent">Code Agent</label>
                                    <input type="number" class="form-control" id="CAgent" name="CAgent" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="NomInput">Nom</label>
                                    <input type="text" class="form-control" id="NomInput" name="NomInput" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="PrenomInput">Prénom</label>
                                    <input type="text" class="form-control" id="PrenomInput" name="PrenomInput" value="" required>                              
                                </div>
                                <div class="form-group">
                                    <label for="Adresse">Adresse</label>
                                    <input type="text" class="form-control" id="Adresse" name="Adresse" value="" required>
                                </div>                                                                                                                                                     
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Role">Rôle</label>
                                    <select class="form-control" id="Role", name="Role">
                                        <option value="admin">admin</option>
                                        <option value="actif">actif</option>
                                    </select>    
                                </div>
                                <div class="form-group">
                                    <label for="PasswordInput">Mot de passe</label>
                                    <input type="password" class="form-control" id="PasswordInput" name="PasswordInput" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="EmailInput">Email</label>
                                    <input type="email" class="form-control" id="EmailInput" name="EmailInput" value="" required>
                                </div> 
                                <div class="form-group">
                                    <label for="Telephone">Téléphone</label>
                                    <input type="text" class="form-control" id="Telephone" name="Telephone" value="" required>
                                </div>                       
                            </div>
                        </div>
                        <br>
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        <br>
                    </form>
            </div>                 
                <br>
                <br> 
                
            <!-- Suppression d'un membre-->       <!-- Ca fonctionne ne plus touchez -->         
            <div class="admin-card">
                <div class="card-header bg-arc-mint-green text-light">
                    <h2 class="titre-section">Supprimer un membre</h2> <!-- Ca fonctionne -->
                </div>                    
                    <form action="/pages/admin/supp_spv.php" method="POST" class="form-contact">
                        <div class="row">
                            <div class="form-group">
                                    <label for="ID">ID</label>
                                    <input type="number" class="form-control" id="ID" name="ID" placeholder="" required>
                                </div>
                            <!--<div class="col-md-6">
                                <div class="form-group">
                                    <label for="NomInput">Nom</label>
                                    <input type="text" class="form-control" id="NomInput" name="NomInput" value="" >
                                </div>
                                <div class="form-group">
                                    <label for="PrenomInput">Prénom</label>
                                    <input type="text" class="form-control" id="PrenomInput" name="PrenomInput" value="" >                              
                                </div>                                                                                                                                            
                            </div>-->
                        </div>
                        <br>
                            <button type="submit" class="btn btn-primary">Supprimer</button>
                        <br>
                    </form>
            </div>
        </div>   
        
    </div>  
</section>


<section class="container admin-card">
    <!-- Liste des Membres enregistrés-->
    <div class="row bg-arc-mint-green-light-staff py-3">
        <div class="card-list-employe mt-3 table-membres">
            <h2 class="titre-section">Liste des Membres enregistrés</h2>

            <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Rôle</th>
                                <th>Code Agent</th>
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

                $sql = "SELECT * FROM Users WHERE LOWER(NomInput) <> 'test'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td data-label='ID'>" . htmlspecialchars($row['ID']) . "</td>";
                        if ($row['Role'] === 'admin') {
                            echo "<td data-label='Rôle'><span class='badge-admin'>admin</span></td>";
                        } else {
                            echo "<td data-label='Rôle'>" . htmlspecialchars($row['Role']) . "</td>";
                        }
                        echo "<td data-label='Code Agent'>" . htmlspecialchars($row['CAgent']) . "</td>";
                        echo "<td data-label='Nom'>" . htmlspecialchars($row['NomInput']) . "</td>";
                        echo "<td data-label='Prénom'>" . htmlspecialchars($row['PrenomInput']) . "</td>";
                        echo "<td data-label='Adresse'>" . htmlspecialchars($row['Adresse']) . "</td>";
                        //echo "<td>" . htmlspecialchars($row['PasswordInput']) . "</td>";
                        echo "<td data-label='Email'>" . htmlspecialchars($row['EmailInput']) . "</td>"; 
                        echo "<td data-label='Téléphone'>" . htmlspecialchars($row['Telephone']) . "</td>";                                                                                                                          
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


<section class="container admin-card">
    <!-- Liste des sujets du forum-->
    <div class="row bg-arc-mint-green-light-staff py-3">
        <div class="card-list-employe mt-3 table-forum">
            <h2 class="titre-section">Liste des Sujets du Forum</h2>

            <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Auteur</th>
                                <th>Titre</th>
                                <th>Dernière activité</th> 
                               <!--<th>Action</th>-->                                                  
                            </tr>
                        </thead>

                        <?php
                include("connexion.php");

                $sql = "SELECT * FROM forum_sujets";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td data-label='ID'>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td data-label='Auteur'>" . htmlspecialchars($row['auteur']) . "</td>";
                        echo "<td data-label='Titre'>" . htmlspecialchars($row['titre']) . "</td>";
                        echo "<td data-label='Dernière activité'>" . htmlspecialchars($row['date_derniere_reponse']) . "</td>";                                                                                                                        
                       // echo "<td><a href='/pages/admin/supp_sujet.php'" . $row['id'] . "' class='btn btn-danger btn-sm'>Supp</a> ";
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

    <!-- Suppression d'un sujet-->  <!-- Ca fonctionne ne plus toucher-->
     <div class="admin-card">
                <div class="card-header bg-arc-mint-green text-light">
                    <h2 class="titre-section">Supprimer un sujet</h2> <!-- Ca fonctionne -->
                </div>                    
                    <form action="/pages/admin/supp_sujet.php" method="POST" class="form-contact">
                        <div class="row">
                            <div class="form-group">
                                    <label for="id">ID</label>
                                    <input type="text" class="form-control" id="id" name="id" placeholder="" required>
                            </div>
                            
                        </div>
                        <br>
                            <button type="submit" class="btn btn-primary">Supprimer</button>
                        <br>
                    </form>
            </div>
</section>
