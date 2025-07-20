<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "mustermann");
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Verbindung fehlgeschlagen."]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $anrede   = $_POST['anrede'] ?? '';
    $vorname  = $_POST['vorname'] ?? '';
    $nachname = $_POST['nachname'] ?? '';
    $email    = $_POST['email'] ?? '';
    $firma    = $_POST['firma'] ?? '';
    $ort      = $_POST['ort'] ?? '';
    $strasse  = $_POST['strasse'] ?? '';
    $plz      = $_POST['plz'] ?? '';
    $passwort = $_POST['passwort'] ?? '';
    $passwort_wiederholen = $_POST['passwort_wiederholen'] ?? '';

    // Pflichtfelder prüfen
    if (empty($email) || empty($passwort) || empty($passwort_wiederholen)) {
        http_response_code(400);
        echo json_encode(["error" => "Pflichtfelder fehlen."]);
        exit;
    }

    // Passwortübereinstimmung prüfen
    if ($passwort !== $passwort_wiederholen) {
        http_response_code(400);
        echo json_encode(["error" => "Passwörter stimmen nicht überein."]);
        exit;
    }

    // Prüfen, ob E-Mail bereits registriert ist
    $stmt = $conn->prepare("SELECT id FROM benutzer WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        http_response_code(409);
        echo json_encode(["error" => "E-Mail ist bereits registriert."]);
        exit;
    }
    $stmt->close();

    // Passwort hashen
    $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);

    // Daten in Datenbank einfügen
    $stmt = $conn->prepare("INSERT INTO benutzer (anrede, vorname, nachname, email, firma, ort, strasse, plz, passwort)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $anrede, $vorname, $nachname, $email, $firma, $ort, $strasse, $plz, $passwort_hash);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Fehler beim Speichern: " . $conn->error]);
    }

    $stmt->close();
}

$conn->close();

