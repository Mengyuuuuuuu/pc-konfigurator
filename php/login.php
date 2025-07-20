<?php
session_start();
header('Content-Type: application/json');

// DB Config
$host = "localhost";
$user = "root";
$password = "";
$dbname = "mustermann";

// Verbindung herstellen
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(["success" => false, "error" => "Verbindungsfehler."]);
    exit;
}
$conn->set_charset("utf8mb4");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email'] ?? '');
    $passwort = trim($_POST['password'] ?? '');

    if (empty($email) || empty($passwort)) {
        echo json_encode(["success" => false, "error" => "Bitte E-Mail und Passwort eingeben."]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => false, "error" => "Ungültige E-Mail-Adresse."]);
        exit;
    }

    $sql = "SELECT id, vorname, passwort FROM benutzer WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo json_encode(["success" => false, "error" => "Datenbankfehler."]);
        exit;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $nutzer = $result->fetch_assoc();
        if (password_verify($passwort, $nutzer['passwort'])) {
            $_SESSION['user_id'] = $nutzer['id'];
            $_SESSION['user_name'] = htmlspecialchars($nutzer['vorname'], ENT_QUOTES, 'UTF-8');
            echo json_encode(["success" => true]); // JS redirectet dann
            exit;
        }
    }

    echo json_encode(["success" => false, "error" => "E-Mail oder Passwort ist falsch."]);
    $stmt->close();
}
$conn->close();
?>

