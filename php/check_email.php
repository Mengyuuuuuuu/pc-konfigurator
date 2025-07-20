<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "mustermann");
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Verbindung fehlgeschlagen."]);
    exit;
}

$email = $_GET['email'] ?? '';

if (empty($email)) {
    http_response_code(400);
    echo json_encode(["error" => "E-Mail fehlt."]);
    exit;
}

$stmt = $conn->prepare("SELECT id FROM benutzer WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

$exists = $stmt->num_rows > 0;

$stmt->close();
$conn->close();

echo json_encode(["exists" => $exists]);
