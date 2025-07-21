<?php
include_once("includes/header.php");
session_start();

// ⬇️ Schritt-7-Daten speichern（nach POST）
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['monitore'] = $_POST['monitore'] ?? [];

    // ➡️ Weiterleitung zur Zusammenfassung
    header("Location: zusammenfassung.php");
    exit();
}

// ⬇️ Verbindung zur Datenbank
$conn = new mysqli("localhost", "root", "", "mustermann");
$conn->set_charset("utf8");

// ⬇️ Filterwert aus der URL auslesen (z.B. ?filter=22)
$filter = $_GET['filter'] ?? '';

// ⬇️ Monitor-Daten abfragen mit optionalem Filter
$sql = "SELECT * FROM monitore";
if ($filter === '22') {
    $sql .= " WHERE groesse_zoll >= 22";
} elseif ($filter === '32') {
    $sql .= " WHERE groesse_zoll >= 32";
}
$monitore = $conn->query($sql);
?>



<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Schritt 7: Monitor</title>
  <link href="../bootstrap5.3/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .preview:hover {
      cursor: pointer;
      border: 2px solid #007bff;
    }
  </style>
  <script>
    function enlarge(imageSrc) {
      const win = window.open("", "_blank");
      win.document.write("<img src='" + imageSrc + "' style='max-width:100%'>");
    }
  </script>
</head>
<body>
<main class="container py-5">
  <h1 class="display-5">PC-Konfigurator</h1>
  <h2 class="h4 mb-4">Schritt 7 von 8: Monitorauswahl</h2>

  <form method="post">
  <!-- Filter-Buttons -->
  <div class="mb-3">
    <a href="?filter=22" class="btn btn-outline-secondary btn-sm">≥ 22 Zoll</a>
    <a href="?filter=32" class="btn btn-outline-secondary btn-sm">≥ 32 Zoll</a>
    <a href="monitor.php" class="btn btn-outline-secondary btn-sm">Alle</a>
  </div>

  <!-- Monitorauswahl -->
  <div class="row">
    <?php while ($row = $monitore->fetch_assoc()): ?>
      <div class="col-md-3 mb-4">
        <div class="card h-100">
          <img src="../img/<?= htmlspecialchars($row['bildpfad_thumb']) ?>"
               class="card-img-top preview img-fluid img-thumbnail"
               onclick="enlarge('../img/<?= htmlspecialchars($row['bildpfad_gross']) ?>')"
               alt="<?= htmlspecialchars($row['name']) ?>"
               style="height:140px; object-fit:contain;">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($row['name']) ?> (<?= $row['groesse_zoll'] ?>")</h5>
            <p class="card-text"><?= htmlspecialchars($row['beschreibung']) ?></p>
            <p><strong><?= number_format($row['preis'], 2, ',', '.') ?> €</strong></p>
            <div class="form-check">
              <input class="form-check-input"
                     type="checkbox"
                     name="monitore[]"
                     value="<?= $row['id'] ?>"
                     id="m<?= $row['id'] ?>"
                     <?= (isset($_SESSION['monitore']) && in_array($row['id'], $_SESSION['monitore'])) ? 'checked' : '' ?>>
              <label class="form-check-label" for="m<?= $row['id'] ?>">Auswählen</label>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>

  <!-- Navigation -->
  <div class="mt-4">
    <a href="software.php" class="btn btn-secondary">Zurück zu Schritt 6</a>
    <button type="submit" class="btn btn-primary">Auswahl bestätigen</button>
  </div>
</form>

</main>
<script src="../bootstrap5.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<?php
include_once("includes/footer.php");
?>
