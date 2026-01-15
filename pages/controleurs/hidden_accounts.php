<?php
// Liste configurable des comptes à masquer partout sur le site.
// Remplissez avec les identifiants, emails ou codes agents des comptes tests à cacher.
$HIDDEN_USER_IDS = [
    // exemple: 123,
];
$HIDDEN_USER_EMAILS = [
    // exemple: 'test1@example.com', 'test2@example.com',
];
$HIDDEN_USER_CAGENTS = [
    // exemple: 'TEST1', 'TEST2',
];

function is_hidden_user(array $row): bool {
    global $HIDDEN_USER_IDS, $HIDDEN_USER_EMAILS, $HIDDEN_USER_CAGENTS;
    if (isset($row['ID']) && in_array($row['ID'], $HIDDEN_USER_IDS, true)) return true;
    if (isset($row['EmailInput']) && in_array($row['EmailInput'], $HIDDEN_USER_EMAILS, true)) return true;
    if (isset($row['CAgent']) && in_array($row['CAgent'], $HIDDEN_USER_CAGENTS, true)) return true;
    return false;
}

?>
