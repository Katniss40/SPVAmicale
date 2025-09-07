<div class="hero-scene text-center text-white">
        <div class="hero-scene-content">
                <h1 class="hero-scene-text">Espace Administrateur</h1>
                <div><a href="/" class="btn btn-primary">Retour Accueil</a></div>
        </div>
</div>
<br><br><br><br><br>

<section data-show="admin">
    <nav class="navbar navbar-expand-lg bg-primary " data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin" data-show="admin">Tableau de bord Administrateur</a>
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
                            <a class="nav-link" href="/blog">Discutions</a>
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
<div class="container">
    <br>
<h1 class="text-center text-primary admin">Bienvenue sur votre tableau de bord</h1>
<br>

    <div class="mb-3">
        <div class="column column-1">
            <?php
                //session_start();
                //if($_SESSION['username'] !== ""){
                //$user = $_SESSION['username'];
                // afficher un message
                //echo "Bonjour $user, vous êtes connecté";
                //}
            ?>
                <p>Vous pouvez maintenant accéder à toutes les fonctionnalités réservées à l'administration du site.</p>
                 
            <div class="container mt-5 bg-arc-mint-green-light">
                <div class="card-header bg-arc-mint-green text-light">
                    <h2 class="text-center text-primary">Ajouter un nouveau membre</h2>  <!-- Ca fonctionne -->
                </div>                    
                    <form action="/pages/admin/gestion_spv.php" method="POST">
                        <div class="row">
                            <div class="form-group">
                                    <label for="Role">Rôle</label>
                                    <input type="text" class="form-control" id="Role", name="Role", value="" required>
                                </div>
                            <div class="col-md-6"> 
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
            <div class="container mt-5 bg-arc-mint-green-light">
                <div class="card-header bg-arc-mint-green text-light">
                    <h2 class="text-center text-primary">Modifier un membre</h2>  <!-- Ca fonctionne -->
                </div>                    
                    <form action="/pages/admin/modif_spv.php" method="POST">
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ID">ID</label>
                                    <input type="text" class="form-control" id="ID" name="ID" placeholder="" required>
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
                                    <input type="text" class="form-control" id="Role" name="Role" placeholder="" required>
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
                
            <div class="container mt-5 bg-arc-mint-green-light">
                <div class="card-header bg-arc-mint-green text-light">
                    <h2 class="text-center text-primary">Supprimer un membre</h2> <!-- Ca fonctionne -->
                </div>                    
                    <form action="/pages/admin/supp_spv.php" method="POST">
                        <div class="row">
                            <div class="form-group">
                                    <label for="ID">ID</label>
                                    <input type="text" class="form-control" id="ID" name="ID" placeholder="" required>
                                </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="NomInput">Nom</label>
                                    <input type="text" class="form-control" id="NomInput" name="NomInput" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="PrenomInput">Prénom</label>
                                    <input type="text" class="form-control" id="PrenomInput" name="PrenomInput" value="" required>                              
                                </div>                                                                                                                                            
                            </div>
                        </div>
                        <br>
                            <button type="submit" class="btn btn-primary">Supprimer</button>
                        <br>
                    </form>
            </div>
        </div>   
        
    </div>  
</section>


<section class="container">
    <div class="row bg-arc-mint-green-light-staff py-3">
        <div class="card-list-employe mt-3">
            <h2 class="text-center text-primary">Liste des Membres enregistrés</h2>

            <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Rôle</th>
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

                $sql = "SELECT * FROM Users";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Role']) . "</td>";
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
</section>
