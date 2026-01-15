# Amicale des Sapeurs-Pompiers de Léon
Site vitrine et espace d'administration pour l'amicale des Sapeurs-Pompiers de Léon.

## Résumé des changements récents
- Harmonisation des navbars administratives (`bg-pompier`, `admin-subnav`).
- Nouvelle route client-side `/lireS` pointant vers `forum/lire_sujet.php`.
- Déplacement de `pages/liens.php` vers `pages/admin/liens.php` (redirect maintenu).
- Ajustements PHP : utilisation centralisée de `db_mysqli.php`, corrections de redirections internes.
- Backups réguliers créés dans `backups/` avant modifications.

Branche de travail principale pour ces changements : `fix/public-audit`.

## Installation locale (rapide)
1. Cloner le dépôt:

	git clone https://github.com/Katniss40/SPVAmicale.git

2. Configurer un serveur PHP (ex: PHP intégré ou XAMPP) pointant sur le dossier `ASPLFront`.
3. Vérifier la configuration de la base de données dans `pages/controleurs/db_mysqli.php`.

## Déploiement
- Pousser vos commits vers la branche distante (ex: `fix/public-audit`) puis ouvrir une PR vers `main`.
- Vérifier les backups avant toute suppression de fichiers.

## Notes de debugging
- Si une page n'affiche pas tous les éléments (ex: table de sujets), vérifier la requête SQL et le rendu HTML dans `pages/Forum/index.php`.
- Pour les dropdowns/togglers Bootstrap, assurez-vous d'inclure `bootstrap.bundle.min.js` dans le layout.

---
Si vous voulez que je complète ce README (guide de contribution, checklist de tests), dites-moi quoi ajouter.
