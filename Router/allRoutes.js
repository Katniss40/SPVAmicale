import Route from "./Route.js";

//Définir ici vos routes
export const allRoutes = [
    new Route("/", "Accueil", "/pages/home.html", []),
    new Route("/galerie", "La galerie", "/pages/galerie.html", [], "/js/galerie.js"),
    new Route("/signin", "connection", "/pages/auth/signin.html",["disconnected"], "/JS/auth/signin.js"),
    new Route("/signup", "Inscription", "/pages/auth/signup.html",["disconnected"],  "/JS/auth/signup.js"),
    new Route("/account", "Mon compte", "/pages/auth/account.html", ["spv", "admin"]),
    new Route("/editPassword", "Modification", "/pages/auth/editPassword.html",["spv", "admin"]),
    new Route("/VideGrenier", "Vide Grenier 2025", "/pages/reservations/VideGrenier.php", ["spv", "admin"]),
    new Route("/contact", "contact", "/pages/reservations/contact.html", ["spv", "admin"]),
    new Route("/manifestations", "Manifestations", "/pages/manifestations.html", []),
    new Route("/calendrier", "Calendrier", "/pages/calendrier.php", ["spv", "admin"]),
    new Route("/liens", "Liens", "/pages/liens.html", ["spv", "admin"]),
    new Route("/contact", "Contact", "/pages/contact.html", []),
    new Route("/infos", "Infos", "/pages/infos.html", []),
    new Route("/infosPerso", "InfosPerso", "/pages/auth/infosPerso.php",["spv", "admin"]),

];

//Le titre s'affiche comme ceci : Route.titre - websitename
export const websiteName = "Amicales des pompiers de Léon";
