<?php
// Liste configurable des comptes à masquer partout sur le site.
// Remplissez avec les identifiants, emails, codes agents ou noms des comptes tests à cacher.
$HIDDEN_USER_IDS = [8, 9];
$HIDDEN_USER_EMAILS = [
    'bourdeloux.corinne@orange.fr',
    'test@test.fr',
];
$HIDDEN_USER_CAGENTS = [
    '1234',
];
$HIDDEN_USER_NAMES = [
    // Nom ou NomInput à filtrer (insensible à la casse)
    'test',
];

function is_hidden_user(array $row): bool {
    global $HIDDEN_USER_IDS, $HIDDEN_USER_EMAILS, $HIDDEN_USER_CAGENTS, $HIDDEN_USER_NAMES;
    if (isset($row['ID']) && in_array((int)$row['ID'], $HIDDEN_USER_IDS, true)) return true;

    if (isset($row['EmailInput'])) {
        $email = strtolower(trim($row['EmailInput']));
        $emails = array_map('strtolower', $HIDDEN_USER_EMAILS);
        if (in_array($email, $emails, true)) return true;
    }

    if (isset($row['CAgent']) && in_array($row['CAgent'], $HIDDEN_USER_CAGENTS, true)) return true;

    // Vérifier nom/prénom (champs possibles selon les pages)
    $namesToCheck = [];
    if (isset($row['NomInput'])) $namesToCheck[] = $row['NomInput'];
    if (isset($row['Nom'])) $namesToCheck[] = $row['Nom'];
    if (!empty($namesToCheck)) {
        $lowerNames = array_map(function($v){ return strtolower(trim($v)); }, $namesToCheck);
        $hiddenLower = array_map('strtolower', $HIDDEN_USER_NAMES);
        foreach ($lowerNames as $n) {
            if (in_array($n, $hiddenLower, true)) return true;
        }
    }

    return false;
}

?>
