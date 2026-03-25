<?php
header('Content-Type: application/json');
$input = json_decode(file_get_contents('php://input'), true);
if (!$input || empty($input['nama']) || empty($input['email']) || empty($input['pesan'])) {
  http_response_code(422);
  echo json_encode(['message' => 'Data belum lengkap']);
  exit;
}

echo json_encode(['message' => 'Pesan berhasil dikirim. Tim PSTI Jatim akan menghubungi Anda.']);
