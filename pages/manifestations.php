<?php
session_start();
$isAdmin = (isset($_SESSION['Role']) && $_SESSION['Role'] === 'admin');
?>


<div class="hero-scene text-center text-white">
    <div class="hero-scene-content">
            <h1 class="hero-scene-text">Nos Manifestations</h1>
    </div>
</div>

<br>
<!-- Anchor for admin panel insertion -->
<div id="admin-panel-anchor"></div>

<section>     
  <article class="bg-white text-black">
    <div class="container p-4"><br><br>
  <h2 class="text-center text-primary"><span id="title_bal_pompiers">Bal des Pompiers 2025</span></h2>
  <h2 class="text-center text-primary">Annulation du bal des pompiers pour cette année</h2><br><br><br>
        <div class="row row-cols-1 row-cols-lg-2 align-items-center">
          <div class="col">
            <p class="text-justify">
              Nous sommes désolés de vous annoncer que le bal des pompiers prévu pour le <span id="date_bal_pompiers">1er août 2025</span> a été annulé.
              En effet, nous avons rencontré des difficultés d'organisation et de logistique qui nous ont contraint à prendre cette décision.
              Nous tenons à nous excuser pour les désagréments que cela pourrait causer et nous espérons que vous comprendrez notre situation.
              Nous vous remercions de votre compréhension et nous espérons vous retrouver lors de nos prochaines manifestations
            </p>
          </div>
          <div id="video" class="col">
            <h4 class="text-center text-primary">En attendant notre retour, nous l'espérons l'an prochain, revivez les moments phares de 2024</h4>
              <p class="text-center">Et un grand merci à @animlandes qui a su mettre le feu à cette soirée !! 🍾🍾🔥</p>
              <div class="ratio ratio-16x9" style="max-width: 560px; margin: 0 auto;">
                <video controls class="rounded">
                  <source src="/Images/Enregistrement 2025-07-12 110032.mp4" type="video/mp4">
                  <source src="mon-film.ogg" type="video/ogg">
                  Votre navigateur ne supporte pas la balise vidéo.
                </video>
              </div>
                <!--<img class="w-50 rounded" src="/Images/bal_pompiers_2024.jpg"/>-->
          </div>
        </div>
        <!--<div class="text-center pt-4">
          <a href="/infos" class="btn btn-primary">Nos Informations</a>
        </div>-->
    </div>
  </article>

  <article class="bg-black text-white">
    <div class="container p-4">
  <h2 class="text-center"><span id="date_vide_grenier">15 Août 2025</span> : Vide-grenier Annuel</h2>
        <div class="row row-cols-1 row-cols-lg-2 align-items-center">
          <div class="col">
            <img class="vide-grenier-img rounded" style="display: block; margin: 0 auto; width: 40%; height: auto; max-height: 400px;" src="/Images/vide_grenier.jpg"/>
          </div>
          <div class="col">
            <p class="text-justify">
              Comme chaque année nous organisons notre vide-grenier sur les berges du Lac de Léon. Venez nombreux pour chiner et faire de bonnes affaires.
                <br>
              Vous souhaitez exposer? Contactez-nous par <a class="mail" href="mailto:videgrenieramicalepompiersleon@gmail.com">mail</a>  ou par téléphone 
                <br>
              <p id="contact">-- Corinne : 06.37.99.13.58 -- </p>
                
              <p>Vous pouvez aussi télécharger le règlement du vide-grenier, l'attestation obligatoire de participation à la brocante, ainsi que le bulletin d'inscription et nous le renvoyer avec votre règlement.
                <br>
              
                <br>
              Vous pouvez nous aider en partageant l'information sur les réseaux sociaux.
              <br>
              Vous trouverez ci-dessous les liens pour télécharger les documents nécessaires à votre participation.
            </p>
              <div class="text-center pt-4">
                <h2>Vous pouvez télécharger le dossier d'incription à notre vide-grenier 2025 ci-dessous </h2>
                  <a href="/fichiers/Reglement_VG.pdf" class="btn btn-secondary" download="Reglement.pdf">Règlement</a>
                  <a href="/fichiers/Bulletin_inscription.pdf" class="btn btn-secondary" download="inscription.pdf">Inscription</a>
                  <a href="/fichiers/Brocante-Attestation.pdf" class="btn btn-secondary" download="attestation.pdf">Attestation</a>
              </div>
          </div> 
        </div>
    </div>                                       
  </article>                   


  </article>
</section>      

            






