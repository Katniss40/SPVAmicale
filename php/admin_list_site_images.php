<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

// Only admins can list admin-managed images

// Image listing disabled
http_response_code(410);
echo json_encode(['success' => false, 'message' => 'Image management disabled']);
exit;

?>

?>
