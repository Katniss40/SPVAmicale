<div class="hero-scene text-center text-white">
        <div class="hero-scene-content">
                <h1 class="hero-scene-text">Espace Administrateur</h1>
                <div><a href="/" class="btn btn-primary">Retour Accueil</a></div>
        </div>
</div>
<br>
<br>
<br>
<br>
<br>
<section>
    <nav class="navbar navbar-expand-lg bg-primary " data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin">Tableau de bord Administrateur</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/spv">Liste des membres</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/calendrier">Gérer le calendrier</a>
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
                    <h2 class="text-center text-primary">Ajouter un nouveau membre</h2>
                </div>                    
                    <form action="/pages/admin/gestion_spv.php" method="POST">
                        <div class="row">
                            <div class="form-group">
                                    <label for="Role">Rôle</label>
                                    <input type="text" class="form-control" id="Role", name="Role", value="Role" required>
                                </div>
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label for="NomInput">Nom</label>
                                    <input type="text" class="form-control" id="NomInput" name="NomInput" value="Nom" required>
                                </div>
                                <div class="form-group">
                                    <label for="PrenomInput">Prénom</label>
                                    <input type="text" class="form-control" id="PrenomInput" name="PrenomInput" value="Prénom" required>                              
                                </div>
                                <div class="form-group">
                                    <label for="Adresse">Adresse</label>
                                    <input type="text" class="form-control" id="Adresse" name="Adresse" value="Adresse" required>
                                </div>                                                                                                                                                     
                            </div>

                            <div class="col-md-6">                                
                                <div class="form-group">
                                    <label for="PasswordInput">Mot de passe</label>
                                    <input type="text" class="form-control" id="PasswordInput", name="Password", value="Mot de passe" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="Em@il" required>
                                </div>
                                <div class="form-group">
                                    <label for="Telephone">Téléphone</label>
                                    <input type="text" class="form-control" id="Telephone" name="Telephone" value="01.02.03.04.05" required>
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
                    <h2 class="text-center text-primary">Modifier un membre</h2>
                </div>                    
                    <form action="/pages/admin/supp_spv.php" method="POST">
                        <div class="row">
                            <div class="form-group">
                                    <label for="Role">Rôle</label>
                                    <input type="text" class="form-control" id="Role" name="Role" placeholder="Role" required>
                                </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="NomInput">Nom</label>
                                    <input type="text" class="form-control" id="NomInput" name="NomInput" value="Nom" required>
                                </div>
                                <div class="form-group">
                                    <label for="PrenomInput">Prénom</label>
                                    <input type="text" class="form-control" id="PrenomInput" name="PrenomInput" value="Prénom" required>                              
                                </div>
                                <div class="form-group">
                                    <label for="Adresse">Adresse</label>
                                    <input type="text" class="form-control" id="Adresse" name="Adresse" value="Adresse" required>
                                </div>                                                                                                                                                     
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="PasswordInput">Mot de passe</label>
                                    <input type="text" class="form-control" id="PasswordInput", name="Password", value="Mot de passe" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="Em@il" required>
                                </div> 
                                <div class="form-group">
                                    <label for="Telephone">Téléphone</label>
                                    <input type="text" class="form-control" id="Telephone" name="Telephone" value="01.02.03.04.05" required>
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
                    <h2 class="text-center text-primary">Supprimer un membre</h2>
                </div>                    
                    <form action="/pages/admin/supp_spv.php" method="POST">
                        <div class="row">
                            <div class="form-group">
                                    <label for="ID">ID</label>
                                    <input type="text" class="form-control" id="ID" name="ID" placeholder="ID" required>
                                </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="NomInput">Nom</label>
                                    <input type="text" class="form-control" id="NomInput" name="NomInput" value="Nom" required>
                                </div>
                                <div class="form-group">
                                    <label for="PrenomInput">Prénom</label>
                                    <input type="text" class="form-control" id="PrenomInput" name="PrenomInput" value="Prénom" required>                              
                                </div>
                                <div class="form-group">
                                    <label for="Adresse">Adresse</label>
                                    <input type="text" class="form-control" id="Adresse" name="Adresse" value="Adresse" required>
                                </div>                                                                                                                                                     
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="PasswordInput">Mot de passe</label>
                                    <input type="text" class="form-control" id="PasswordInput", name="Password", value="Mot de passe" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="Em@il" required>
                                </div> 
                                <div class="form-group">
                                    <label for="Telephone">Téléphone</label>
                                    <input type="text" class="form-control" id="Telephone" name="Telephone" value="01.02.03.04.05" required>
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


<section>
    <div class="row bg-arc-mint-green-light-staff py-3">
        <div class="card-list-employe mt-3">
            <div class="card-header">
                    Liste des Membres enregistrés
            </div>

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
                        echo "<td>" . htmlspecialchars($row['NomInput']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['PrenomInput']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Adresse']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['PasswordInput']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>"; 
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
