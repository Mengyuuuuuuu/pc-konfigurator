<?php
include_once("includes/header.php");
session_start();

// Sicherstellen, dass der Benutzer angemeldet ist
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$gehaeuse = $_SESSION['gehaeuse'] ?? '';
$cpu = $_SESSION['cpu'] ?? '';
$ram = $_SESSION['ram'] ?? '';
$zubehoer = $_SESSION['zubehoer'] ?? [];
$ausstattung = $_SESSION['ausstattung'] ?? [];
$os = $_SESSION['os'] ?? '';
$software = $_SESSION['software'] ?? [];
$monitore = $_SESSION['monitore'] ?? [];

// Verbindung zur Datenbank
$mysqli = new mysqli("localhost", "root", "", "mustermann");
if ($mysqli->connect_error) {
    die("Verbindungsfehler: " . $mysqli->connect_error);
}
$mysqli->set_charset("utf8");

// Benutzeradresse auslesen
$stmt = $mysqli->prepare("SELECT vorname, nachname, ort, strasse, plz FROM benutzer WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_result = $stmt->get_result()->fetch_assoc();

$gesamtpreis = 0.00;

// ✅ CPU aus Datenbank laden
$cpu_preis = 0.00;
$cpu_modell = '';
if (!empty($cpu) && is_numeric($cpu)) {
    $stmt = $mysqli->prepare("SELECT modell, preis FROM cpus WHERE id = ?");
    $stmt->bind_param("i", $cpu); // id 是整數
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        $cpu_modell = htmlspecialchars($row['modell']);
        $cpu_preis = (float) $row['preis'];
        $gesamtpreis += $cpu_preis;
    }
}


// Bei finaler Bestellung: Session bereinigen
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
    $benutzer_session = $_SESSION['user_id'];
    session_unset();
    session_destroy();
    session_start();
    $_SESSION['user_id'] = $benutzer_session;
}
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

    <hr class="my-4">

    <div class="mb-4">
        <h4>Ihre Auswahl:</h4>
        <ul>
            <?php
               $gehaeusePreise = [
                 'desktop' => 49.99,
                 'midi' => 59.99,
                 'maxi' => 89.99
       ];
$gehaeuseNamen = [
  'desktop' => 'Desktop',
  'midi' => 'Midi-Tower',
  'maxi' => 'Maxi-Tower'
           ];
$gehaeusePreis = $gehaeusePreise[$gehaeuse] ?? 0.00;
$gehaeuseName = $gehaeuseNamen[$gehaeuse] ?? $gehaeuse;
$gesamtpreis += $gehaeusePreis;
?>

<li><strong>Gehäuse:</strong> <?= htmlspecialchars($gehaeuseName) ?> (<?= number_format($gehaeusePreis, 2, ',', '.') ?> €)</li>

            <li><strong>CPU:</strong> <?= htmlspecialchars($cpu_modell) ?> (<?= number_format($cpu_preis, 2, ',', '.') ?> €)</li>

            <?php
  $ramInt = (int) $ram;
$ramPreis = $ramInt * 0.8;
$gesamtpreis += $ramPreis;
?>
            <li><strong>RAM:</strong> <?= htmlspecialchars($ramInt) ?> GB (<?= number_format($ramPreis, 2, ',', '.') ?> €)</li>            
            <li><strong>Zubehör:</strong>
                <ul>
                <?php
    if (!empty($zubehoer)) {
        $ids = implode(',', array_map('intval', $zubehoer));
        $result = $mysqli->query("SELECT name, beschreibung, preis FROM zubehoer WHERE id IN ($ids)");
        while ($row = $result->fetch_assoc()) {
            $gesamtpreis += $row['preis'];
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
        $gesamtpreis += $row['preis'];
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
        $gesamtpreis += $row['preis'];
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
        $gesamtpreis += $row['preis'];
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
        $gesamtpreis += $row['preis'];
        echo "<li>" . htmlspecialchars($row['name']) . " – " . htmlspecialchars($row['groesse_zoll']) . ' Zoll (' . number_format($row['preis'], 2, ',', '.') . " €)</li>";
    }
} else {
    echo "<li>Keine Auswahl</li>";
}
?>
                </ul>
            </li>

             <li class="mt-3"><strong>Gesamtpreis:</strong> <span class="text-success"><?= number_format($gesamtpreis, 2, ',', '.') ?> €</span></li>
        </ul>
    </div>

    <div class="alert alert-success">
        ✅ Die Bestellung wurde erfolgreich gespeichert.
    </div>

    <form method="post">
        <div class="mt-4 d-flex gap-2">
            <a href="monitor.php" class="btn btn-secondary">Zurück zu Schritt 7</a>
            <button type="submit" name="confirm" class="btn btn-danger">Jetzt kostenpflichtig bestellen</button>
        </div>
    </form>
</main>
<script src="../bootstrap5.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// ✅ Bestellung erst nach der Preisberechnung speichern
$insert = $mysqli->prepare("
    INSERT INTO bestellung 
    (benutzer_id, gehaeuse, cpu, ram, zubehoer, ausstattung, os, software, monitore, gesamtpreis, bestelldatum) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
");

$zubehoer_str = implode(',', $zubehoer);
$ausstattung_str = implode(',', $ausstattung);
$software_str = implode(',', $software);
$monitore_str = implode(',', $monitore);
$insert->bind_param("issssssssd", $user_id, $gehaeuse, $cpu, $ram, $zubehoer_str, $ausstattung_str, $os, $software_str, $monitore_str, $gesamtpreis);
$insert->execute();

$mysqli->close();

include_once("includes/footer.php");
?>