# Gestion des images du site (admin)

Ce document décrit les clés d'images gérées par l'interface d'administration et la procédure pour uploader/remplacer des images via l'UI.

## Clés d'images (section `home` dans `data/dates.json`)
- `home_groupe` : image du groupe (affichée sur la page d'accueil)
- `home_remise_medaille` : image remise de médaille
- `home_vide_grenier` : image du vide-grenier

> Ces clés sont présentes dans `data/dates.json` sous la section `home` et contiennent le chemin relatif vers le fichier (ex: `/uploads/site/1605678900-groupe.jpg`).

## Upload / remplacement (via l'interface admin)
- Se connecter en tant qu'administrateur.
- Ouvrir la page d'accueil (le panneau admin apparaît automatiquement si vous êtes admin) ou ouvrir la console et appeler `adminImagesInit()`.
- Dans la section *Gestion images du site*, choisir un fichier (jpg/png/webp, max 4MB), renseigner la **clé** visée (ex: `home_groupe`) et cliquer sur *Uploader*.
- Si une clé est fournie, le serveur enregistre le fichier dans `/uploads/site/` et met à jour `data/dates.json` : `home.{clé}` sera égal au chemin du fichier uploadé.
- L'image sur la page se mettra à jour automatiquement.

## Emplacement des fichiers
- Les images uploadées sont stockées dans `uploads/site/` sur le serveur.
- Ce dossier est ignoré par Git (règle `.gitignore`), afin de ne pas alourdir le dépôt.

## Types et limites
- Types autorisés : `jpg`, `jpeg`, `png`, `webp`.
- Taille maximale par fichier : 4 MB.

## Sécurité
- Les endpoints d'upload et suppression vérifient que l'utilisateur est administrateur (`$_SESSION['Role'] === 'admin'`).
- Il est recommandé de s'assurer que `uploads/site/` a les droits d'écriture pour le processus PHP et qu'il n'est pas accessible en écriture publique par d'autres moyens.

## Remarques
- Si vous préférez versionner certaines images "officielles", placez-les dans `assets/` et suivez-les en Git ; les images uploadées par les admins via l'UI resteront dans `uploads/site/` et ne seront pas versionnées.
- Pour toute clé supplémentaire à rendre éditable, demandez et je l'ajouterai à `data/dates.json` et à la documentation.
