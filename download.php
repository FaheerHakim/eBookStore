<?php
// download.php: Force download van een eBook PDF uit de uploads map
if (!isset($_GET['file']) || empty($_GET['file'])) {
    http_response_code(404);
    exit('File not specified.');
}

$filename = basename($_GET['file']);
$filepath = __DIR__ . '/ebooks/' . $filename;

if (!file_exists($filepath)) {
    http_response_code(404);
    exit('File not found.');
}

// Force download headers
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filepath));
flush();
readfile($filepath);
exit();
