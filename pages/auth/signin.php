<div class="hero-scene text-center text-white">
    <div class="hero-scene-content">
            <h1 class="hero-scene-text">Connexion Réservée au STAFF</h1>
    </div>
</div>
<br><br><br><br><br>

<div class="container">
  <br>
  <form action="../php/verification.php" method="post">
  <h3> Connexion </h3>
  <br>
  <form>
    <div class="mb-3">
      <label for="EmailInput" class="form-label">Adresse Mail</label>
      <input type="email" class="form-control" id="EmailInput" placeholder="votre email@mail.fr"> 
      <div class="invalid-feedback">
        Le mail et/ou le mot de passe ne correspondent pas 
      </div>    
    </div>
    <div class="mb-3">
      <label for="PassewordInput" class="form-label">Mot de Passe</label>
      <input type="password" class="form-control" id="PassewordInput">
    </div>
    <div class="text-center">
    <button type="button" class="btn btn-primary" id="btnSignin">Connexion</button>
    </div>
  </form>

  <a> Vous avez oublié vos infos de connexion? Contactez le président de l'amicale</a>

    

</div>

<?php
require('connexion.php');
session_start();


if (isset($_POST['EmailInput'])){
  $EmailInput = stripslashes($_REQUEST['EmailInput']);
  $EmailInput = mysqli_real_escape_string($conn, $EmailInput);
  $_SESSION['EmailInput'] = $EmailInput;
  $PasswordInput = stripslashes($_REQUEST['PasswordInput']);
  $PasswordInput = mysqli_real_escape_string($conn, $PasswordInput);
    $query = "SELECT * FROM `Users` WHERE EmailInput='$EmailInput' 
  and PasswordInput='$PasswordInput'";

  $result = mysqli_query($conn,$query) or die();
  
  if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
    // vérifier si l'utilisateur est un administrateur ou un utilisateur
    if ($user['type'] == 'Admin') {
      header('location: /admin');      
    }else{
      header('location: /spv');
    }
  }else{
    $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
  }
}


?>