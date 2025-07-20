<?php
include_once("includes/header.php");
session_start();

// Sicherstellen, dass der Benutzer angemeldet ist
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// POST-Daten aus den vorherigen Schritten empfangen
$gehaeuse = $_SESSION['gehaeuse'] ?? '';
$cpu = $_POST['cpu'] ?? '';
$ram = $_POST['ram'] ?? '';
$zubehoer = $_POST['zubehoer'] ?? []; // Array von Zubehör-IDs
$ausstattung = $_POST['ausstattung'] ?? []; // Array von Ausstattungs-IDs
$os = $_POST['os'] ?? '';
$software = $_POST['software'] ?? []; // Array von Software-IDs
$monitore = $_POST['monitore'] ?? []; // Array von Monitor-IDs

// Verbindung zur Datenbank
$mysqli = new mysqli("localhost", "root", "", "mustermann");
if ($mysqli->connect_error) {
    die("Verbindungsfehler: " . $mysqli->connect_error);
}
$mysqli->set_charset("utf8");

// Benutzeradresse aus der Tabelle 'benutzer' laden
$stmt = $mysqli->prepare("SELECT vorname, nachname, ort, strasse, plz FROM benutzer WHERE id = ?");

$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_result = $stmt->get_result()->fetch_assoc();

// Arrays zu Strings konvertieren (zur Vereinfachung)
$zubehoer_str = implode(',', $zubehoer);
$ausstattung_str = implode(',', $ausstattung);
$software_str = implode(',', $software);
$monitore_str = implode(',', $monitore);

// Bestellung in der Tabelle 'bestellung' speichern
$insert = $mysqli->prepare("
    INSERT INTO bestellung 
    (benutzer_id, gehaeuse, cpu, ram, zubehoer, ausstattung, os, software, monitore, bestelldatum) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
");
$insert->bind_param("issssssss", $user_id, $gehaeuse, $cpu, $ram, $zubehoer_str, $ausstattung_str, $os, $software_str, $monitore_str);
$insert->execute();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>PC-Konfigurator – Zusammenfassung</title>
    <link href="../bootstrap5.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="container py-5">
    <h1 class="display-5 fw-bold">PC-Konfigurator</h1>
    <h2 class="fs-4 mb-4">Letzter Schritt: Zusammenfassung</h2>

    <div class="mb-4">
        <h4>Lieferadresse:</h4>
        <p><?= htmlspecialchars($user_result['nachname']) ?> <?= htmlspecialchars($user_result['vorname']) ?><br>
           <?= htmlspecialchars($user_result['strasse']) ?><br>
           <?= htmlspecialchars($user_result['plz']) ?> <?= htmlspecialchars($user_result['ort']) ?>
        </p>
    </div>

    <hr class="my-4"> <!-- a horizontal line-->
 
    <div class="mb-4">
        <h4>Ihre Auswahl:</h4>
        <ul>
            <li><strong>Gehäuse:</strong> <?= htmlspecialchars($gehaeuse) ?></li>
            <li><strong>CPU:</strong> <?= htmlspecialchars($cpu) ?></li>
            <li><strong>RAM:</strong> <?= htmlspecialchars($ram) ?> GB</li>
            <li><strong>Zubehör:</strong>
                <ul>
                <?php
                if (!empty($zubehoer)) {
                    $ids = implode(',', array_map('intval', $zubehoer));
                    $result = $mysqli->query("SELECT name, beschreibung, preis FROM zubehoer WHERE id IN ($ids)");
                    while ($row = $result->fetch_assoc()) {
                        echo "<li>" . htmlspecialchars($row['name']) . " – " . htmlspecialchars($row['beschreibung']) . " (" . number_format($row['preis'], 2, ',', '.') . " €)</li>";
                    }
                } else {
                    echo "<li>Keine Auswahl</li>";
                }
                ?>
                </ul>
            </li>
            <li><strong>Ausstattung:</strong>
                <ul>
                <?php
                if (!empty($ausstattung)) {
                    $ids = implode(',', array_map('intval', $ausstattung));
                    $result = $mysqli->query("SELECT name, beschreibung, preis FROM ausstattung WHERE id IN ($ids)");
                    while ($row = $result->fetch_assoc()) {
                        echo "<li>" . htmlspecialchars($row['name']) . " – " . htmlspecialchars($row['beschreibung']) . " (" . number_format($row['preis'], 2, ',', '.') . " €)</li>";
                    }
                } else {
                    echo "<li>Keine Auswahl</li>";
                }
                ?>
                </ul>
            </li>
            <li><strong>Betriebssystem:</strong>
                <ul>
                <?php
                if (!empty($os)) {
                    $result = $mysqli->query("SELECT name, beschreibung, preis FROM os WHERE id = " . intval($os));
                    if ($row = $result->fetch_assoc()) {
                        echo "<li>" . htmlspecialchars($row['name']) . " – " . htmlspecialchars($row['beschreibung']) . " (" . number_format($row['preis'], 2, ',', '.') . " €)</li>";
                    }
                } else {
                    echo "<li>Keine Auswahl</li>";
                }
                ?>
                </ul>
            </li>
            <li><strong>Software:</strong>
                <ul>
                <?php
                if (!empty($software)) {
                    $ids = implode(',', array_map('intval', $software));
                    $result = $mysqli->query("SELECT name, beschreibung, preis FROM software WHERE id IN ($ids)");
                    while ($row = $result->fetch_assoc()) {
                        echo "<li>" . htmlspecialchars($row['name']) . " – " . htmlspecialchars($row['beschreibung']) . " (" . number_format($row['preis'], 2, ',', '.') . " €)</li>";
                    }
                } else {
                    echo "<li>Keine Auswahl</li>";
                }
                ?>
                </ul>
            </li>
            <li><strong>Monitor:</strong>
                <ul>
                <?php
                if (!empty($monitore)) {
                    $ids = implode(',', array_map('intval', $monitore));
                    $result = $mysqli->query("SELECT name, groesse_zoll, preis FROM monitore WHERE id IN ($ids)");
                    while ($row = $result->fetch_assoc()) {
                        echo "<li>" . htmlspecialchars($row['name']) . " – " . htmlspecialchars($row['groesse_zoll']) . ' Zoll (' . number_format($row['preis'], 2, ',', '.') . " €)</li>";
                    }
                } else {
                    echo "<li>Keine Auswahl</li>";
                }
                ?>
                </ul>
            </li>
        </ul>
    </div>

    <div class="alert alert-success">
        ✅ Die Bestellung wurde erfolgreich gespeichert.
    </div>
   
    <div class="mt-4 d-flex gap-2">
    <a href="monitor.php" class="btn btn-secondary">Zurück zu Schritt 7</a>
    <button class="btn btn-danger" disabled>Jetzt kostenpflichtig bestellen</button>
</div>

</main>
<script src="../bootstrap5.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
include_once("includes/footer.php");
?>
