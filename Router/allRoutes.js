import Route from "./Route.js";

//Définir ici vos routes
export const allRoutes = [
    new Route("/", "Accueil", "/pages/home.html", [], "/JS/admin-dates.js"),
    new Route("/galerie", "La galerie", "/pages/galerie/galerie.php", [], "/JS/galerie.js"),
    new Route("/manifestations", "Manifestations", "/pages/manifestations.php", [], "/JS/admin-dates.js"),
    new Route("/contact", "Contact", "/pages/contact.html", []),
    new Route("/infos", "Infos", "/pages/infos.php", [], "/JS/admin-dates.js"),
    new Route("/recrutement", "Recrutement", "/pages/recrutements.html", []),

    new Route("/signin", "connection", "/pages/auth/signin.php",["disconnected"], "/JS/auth/signin-script.js"),   
    new Route("/reset", "Réinitialisation du mot de passe", "/pages/auth/resetPassword.php", []), 
    new Route("/forgot", "Réinitialisation du mot de passe", "/pages/auth/forgot-password.php", []),

    //new Route("/account", "Mon compte", "/pages/auth/account.php", ["actif", "admin"]),
    new Route("/editPassword", "Modification", "/pages/auth/editPassword.php",["actif", "admin"]),
    new Route("/infosPerso", "Mes infos", "/pages/auth/infosPerso.php",["actif", "admin"], "/js/auth/editAccount.js"),

    new Route("/reponse", "reponse", "/pages/Forum/insert_reponse.php", ["actif", "admin"]),
    new Route("/Lsujet", "Article", "/pages/Forum/lire_sujet.php", ["actif", "admin"]),   
    new Route("/Isujet", "sujet", "/pages/Forum/insert_sujet.php", ["actif", "admin"]),
    new Route("/Blog", "Forum de discussion", "/pages/Forum/index.php", ["actif", "admin"]),    

    new Route("/GalerieSPV", "Photos", "/pages/galerie/galerieSPV.php", ["actif", "admin"]),
    new Route("/VideGrenier", "Vide Grenier 2025", "/pages/admin/VideGrenier.php", ["actif", "admin"]),  
    new Route("/calendrier", "Calendrier", "/pages/admin/calendrier.php", ["actif", "admin"], "/JS/admin-dates.js"),
    new Route("/agents", "Listes des Agents", "/pages/admin/LAgents.php", ["actif", "admin"]),
    //new Route("/fendeuse", "Réservation fendeuse", "/pages/auth/reservation.php", ["actif", "admin"], "/js/auth/reservation.js"),
    new Route("/liens", "Liens", "/pages/admin/liens.html", ["actif", "admin"]),
    new Route("/admin", "Administrateur", "/pages/admin/admin.php",["admin"]),
    new Route("/spv", "SPV", "/pages/admin/spv.php",["admin"]),
    
];

//Le titre s'affiche comme ceci : Route.titre - websitename
export const websiteName = "Amicale des pompiers de Léon";


