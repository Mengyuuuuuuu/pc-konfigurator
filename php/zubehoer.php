<?php
// Schritt 5 – Zubehörauswahl

include_once("includes/header.php");
// Verbindung zur Datenbank
$mysqli = new mysqli("localhost", "root", "", "mustermann");
if ($mysqli->connect_error) {
    die("Verbindungsfehler: " . $mysqli->connect_error);
}
$mysqli->set_charset("utf8");

// Schritt-4-Daten empfangen
$cpu = $_POST['cpu'] ?? '';
$ram = $_POST['ram'] ?? '';
$gehaeuse = $_POST['gehaeuse'] ?? '';

// Daten abfragen
$zubehoerResult = $mysqli->query("SELECT * FROM zubehoer");
$ausstattungResult = $mysqli->query("SELECT * FROM ausstattung");
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>PC-Konfigurator – Schritt 5: Zubehör</title>
    <link href="../bootstrap5.3/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
<main class="container py-5">
    <h1 class="display-5 fw-bold">PC-Konfigurator</h1>
    <h2 class="fs-4 mb-4">Schritt 5 von 5: Zubehör / Ausstattung</h2>

    <form method="post" action="software.php">
        <!-- hidden fields zur Weitergabe -->
        <input type="hidden" name="cpu" value="<?= htmlspecialchars($cpu) ?>">
        <input type="hidden" name="ram" value="<?= htmlspecialchars($ram) ?>">
        <input type="hidden" name="gehaeuse" value="<?= htmlspecialchars($gehaeuse) ?>">

        <div class="row">
            <h4>Zubehör</h4>
            <?php while ($row = $zubehoerResult->fetch_assoc()): ?>
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="../img/<?= htmlspecialchars($row['bildpfad']) ?>"
                             class="card-img-top img-fluid img-thumbnail"
                             alt="<?= htmlspecialchars($row['name']) ?>"
                             style="height:140px; object-fit:contain;">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($row['beschreibung']) ?></p>
                            <p><strong><?= number_format($row['preis'], 2, ',', '.') ?> €</strong></p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="zubehoer[]" value="<?= $row['id'] ?>" id="z<?= $row['id'] ?>">
                                <label class="form-check-label" for="z<?= $row['id'] ?>">Auswählen</label>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="row mt-5">
            <h4>Ausstattung</h4>
            <?php while ($row = $ausstattungResult->fetch_assoc()): ?>
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="../img/<?= htmlspecialchars($row['bildpfad']) ?>"
                             class="card-img-top img-fluid img-thumbnail"
                             alt="<?= htmlspecialchars($row['name']) ?>"
                             style="height:140px; object-fit:contain;">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($row['beschreibung']) ?></p>
                            <p><strong><?= number_format($row['preis'], 2, ',', '.') ?> €</strong></p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="ausstattung[]" value="<?= $row['id'] ?>" id="a<?= $row['id'] ?>">
                                <label class="form-check-label" for="a<?= $row['id'] ?>">Auswählen</label>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="mt-4">
            <a href="ram.php?cpu=<?= urlencode($cpu) ?>&gehaeuse=<?= urlencode($gehaeuse) ?>" class="btn btn-secondary">
               Zurück zu Schritt 4
            </a>

            <button type="submit" class="btn btn-primary">Weiter zu Schritt 6</button>
        </div>
    </form>
</main>
<script src="../bootstrap5.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
include_once("includes/footer.php");
?>

