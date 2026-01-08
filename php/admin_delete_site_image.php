<?php
// Image deletion disabled
header('Content-Type: application/json; charset=utf-8');
http_response_code(410);
echo json_encode(['success' => false, 'message' => 'Image management disabled']);
exit;
?>
