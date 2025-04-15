<div class="hero-scene text-center text-white">
        <div class="hero-scene-content">
                <h1 class="hero-scene-text">Aspace Administrateur</h1>
                <div><a href="/" class="btn btn-primary">Retour Accueil</a></div>
        </div>
</div>
<br>
<section>
<nav class="navbar navbar-expand-lg bg-primary " data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/admin">Dashboard Administrateur</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/spv">Gérer les membres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pages/gestion_employe.php">Gérer le calendrier</a>
                </li>
                <!--<li class="nav-item">
                    <a class="nav-link" href="/pages/gestion_animal.php">Gérer les animaux</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pages/gestion_habitat.php">Gérer les habitats</a>
                </li>-->
            </ul>
        </div>
    </div>
</nav>

<div id="body">

<section id="admin" class="section ">
        
<div class="row bg-arc-mint-green-light-staff py-3">
    <div class="dashboard">
        <div class="column column-1">
            <?php
                //session_start();
                //if($_SESSION['username'] !== ""){
                //$user = $_SESSION['username'];
                // afficher un message
                //echo "Bonjour $user, vous êtes connecté";
                //}
            ?>
                <h2>Bienvenue sur votre tableau de bord</h2>
                    <p>Vous pouvez maintenant accéder à toutes les fonctionnalités réservées à l'administration du site.</p>
                 
            <div class="container mt-5 bg-arc-mint-green-light">
                <div class="card-header bg-arc-mint-green text-light">
                    <h2>Ajouter un nouveau membre</h2>
                </div>
                    <h2></h2>
                        <form action="/pages/controleurs/gestion_employe.php" method="POST">
                            <div class="row">
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
                                    <div class="form-group">
                                        <label for="PasswordInput">Adresse</label>
                                        <input type="text" class="form-control" id="PasswordInput" name="PasswordInput" value="PasswordInput" required>
                                    </div>                        
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <input type="text" class="form-control" id="role" name="role" value="Role" required>
                                    </div>    
                                    <div class="input-group"> 
                                    </div>                                 
                                    <div class="input-group-append">                                    
                                    </div>                      
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="statut">Statut</label>
                                        <input type="text" class="form-control" id="statut" name="statut" value="" required>
                            
                                        <div class="input-group"> 
                                            <div class="input-group-append">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Rôle</label>
                                        <input type="text" class="form-control" id="role", name="role", value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="habitat">Habitat (pour les employés)</label>
                                        <input type="text" class="form-control" id="habitat", name="habitat", value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">email</label>
                                        <input type="text" class="form-control" id="email" name="email" value="" required>
                                    </div>
                        
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>
            </div>                 
                <br>
                <br>
                <div class="card-services">
                    <div id="employees">
                        <div class="card-header bg-arc-mint-green text-light">
                            <h2>Modification des services</h2>
                        </div>
                            
                        <div class="card-body">
                            <form action="/pages/controleurs/gestion_service.php" method="POST">
                                <div class="form-group">
                                    <label for="id">ID</label>
                                        <input type="text" class="form-control" id="id" name="id" required>
                                </div>   
                                <div class="form-group">
                                    <label for="service">Nom du service</label>
                                    <input type="text" class="form-control" id="service" name="service"  required>
                                </div>
                                <div class="form-group">
                                    <label for="habitat">Nom de l'habitat</label>
                                    <input type="text" class="form-control" id="habitat" name="habitat"  required>
                                </div>
                                <div class="form-group">
                                    <label for="horaires">Horaires</label>
                                    <input type="text" class="form-control" id="horaires" name="horaires"  required>
                                </div>
                                <div class="form-group">
                                    <label for="action">Action</label>
                                    <input type="text" class="form-control" id="action" name="action"  required>
                                </div>
                                    <button type="submit" class="btn btn-primary" id="btnServices">Mettre à jour</button>
                            </form>
                        </div>
                    </div>
                        <br>
                        <br>
                </div>
                <br>
                <br>                             
                <div class="card-employe">                        
                    <div id="employees">
                            <div class="card-header bg-arc-mint-green text-light">
                                
                                <h2>Modification d'un habitat</h2>
                            </div>
                            <div class="card-body">
                                <form action="/pages/controleurs/modif_habitat.php" method="POST">
                                    <div class="form-group">
                                        <label for="nom">Ancien nom de l'habitat</label>
                                        <input type="text" class="form-control" id="name_old" name="nom" required>
                                        <label for="habitat_name">Nouveau nom de l'habitat</label>
                                        <input type="text" class="form-control" id="name_new" name="nom" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                </form>
                            </div>
                    </div>
                </div>
                <br>
                <br>
        </div>   
        <div class="container mt-5 bg-arc-mint-green-light">
            <div class="card-header bg-arc-mint-green text-light">
                <h2>Ajouter un nouvel animal</h2>
            </div>
                <h2></h2>
                <form action="/pages/controleurs/gestion_animal.php" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nom">Nom de l'animal</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                            <div class="form-group">
                                <label for="habitat">Habitat</label>
                                <select class="form-control" id="habitat" name="habitat" required>
                                    <option value="La Savane">La Savane</option>
                                    <option value="Les Marais">Les Marais</option>
                                    <option value="La Jungle">La Jungle</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="espece">Espèce</label>
                                <input type="text" class="form-control" id="espece" name="espece" required>
                            </div>
                            <div class="form-group">
                                <label for="age">Âge</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="age" name="age" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">ans</span>
                                            </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label for="commentaire">Commentaire santé</label>
                                <textarea class="form-control" id="commentaires" name="commentaires" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="poids">Poids</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="poids" name="poids" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">kg</span>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                            <label for="typeN">Type de Nourriture</label>
                            <input type="text" class="form-control" id="typeN" name="typeN" required>
                            </div>
                            <div class="form-group">
                            <label for="repas">Dernier repas</label>
                            <input type="datetime-local" class="form-control" id="repas" name="repas" required>
                            </div>
                            <div class="form-group">
                            <label for="quantite">Quantité de nourriture</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="quantite" name="quantite" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">kg</span>
                                </div>
                            </div>
                            </div>
                            <div class="form-group">
                            <label for="remarques">Commentaire privé</label>
                            <textarea class="form-control" id="remarques" name="remarques" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
        </div>                        
    </div>         
</div>
</div>
               
</section>


<!--<div ><h1 style="color: white; ">Consultation des animaux</h1></div>

<div class="animal-grid">
  
  <div class="animal-card">
      <div class="animal-info">
        <h2>Nom : Animal 2</h2>
        <p>Nombre de vue : 325</p>
        <p>Click : 175</p>
      </div>
  </div>
  
  <div class="animal-card">
      
      <div class="animal-info">
        <h2>Nom : Animal 2</h2>
        <p>Nombre de vue : 325</p>
        
      </div>
  </div>
  <div class="animal-card">
      <div class="animal-info">
        <h2>Nom : simba</h2>
        <p>Nombre de vue : 325</p>
      </div>
  </div>-->
  
    
  
  <!-- Add more animal cards here -->
<!--</div>
<div><h1 style="color: white; ">Rapport Vétérinaire</h1>
  <form class="filter-form">
      <label for="date-filter">Filter par date:</label>
      <input type="date" id="date-filter" />
      <label for="animal-id-filter">Filtrer par animal ID:</label>
      <input type="number" id="animal-id-filter" />
      <button type="submit" id="btn-rapport-filter">Apply filter</button>
    </form>
  <div class="container">
      <div class="container-rapport black">
          <div class="container-rapport-card">
              <h1 style="color:white; font-family: Cormorant Upright;">Id Animal</h1>
              <h2 style="color:white;">Nom</h2>
              <p class="card-text">
                  Venez profiter d'une game de repas variées et soutenez ainsi des producteurs locaux soucieux de l'environnemnt
              </p>
              <p class="card-text">
                  date
              </p>
          </div>
      </div>-->
  </div>
</div>