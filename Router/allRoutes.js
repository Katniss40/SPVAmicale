import Route from "./Route.js";

//Définir ici vos routes
export const allRoutes = [
    new Route("/", "Accueil", "/pages/home.html", []),
    new Route("/galerie", "La galerie", "/pages/galerie/galerie.php", [], "/js/galerie.js"),
    new Route("/manifestations", "Manifestations", "/pages/manifestations.html", []),
    new Route("/contact", "Contact", "/pages/contact.html", []),
    new Route("/infos", "Infos", "/pages/infos.html", []),

    new Route("/signin", "connection", "/pages/auth/signin.html",["disconnected"], "/JS/auth/signin.js"),
    new Route("/signup", "Inscription", "/pages/auth/signup.html",["disconnected"],  "/JS/auth/signup.js"),

    new Route("/account", "Mon compte", "/pages/auth/account.php", ["spv", "admin"]),
    new Route("/editPassword", "Modification", "/pages/auth/editPassword.php",["spv", "admin"]),
    new Route("/infosPerso", "Mes infos", "/pages/auth/infosPerso.php",["spv", "admin"], "/js/auth/editAccount.js"),

    new Route("/reponse", "reponse", "/pages/forum/insert_reponse.php", ["spv", "admin"]),
    new Route("/Lsujet", "Article", "/pages/forum/lire_sujet.php", ["spv", "admin"]),
    new Route("/Isujet", "sujet", "/pages/forum/insert_sujet.php", ["spv", "admin"]),
    new Route("/Blog", "Forum de discussion", "/pages/Forum/index.php", ["spv", "admin"]),

    new Route("/GalerieSPV", "Photos", "/pages/galerie/galerieSPV.php", ["spv", "admin"]),
    new Route("/VideGrenier", "Vide Grenier 2025", "/pages/admin/VideGrenier.php", ["spv", "admin"]),  
    new Route("/calendrier", "Calendrier", "/pages/admin/calendrier.php", ["spv", "admin"]),
    new Route("/liens", "Liens", "/pages/admin/liens.html", ["spv", "admin"]),
    new Route("/admin", "Administrateur", "/pages/admin/admin.php",["admin"]),
    new Route("/spv", "SPV", "/pages/admin/spv.php",["admin"]),
    new Route("/blog", "Forum", "/pages/Forum/index.php",["admin", "spv"]),
];

//Le titre s'affiche comme ceci : Route.titre - websitename
export const websiteName = "Amicale des pompiers de Léon";


