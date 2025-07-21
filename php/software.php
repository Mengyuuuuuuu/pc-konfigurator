<?php
include_once("includes/header.php");
session_start();

// Schritt 6: OS und Software speichern (nach POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['os'] = $_POST['os'] ?? null;
    $_SESSION['software'] = $_POST['software'] ?? [];

    // Weiterleitung zu Schritt 7
    header("Location: monitor.php");
    exit();
}

// Verbindung zur Datenbank
$conn = new mysqli("localhost", "root", "", "mustermann");
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}
$conn->set_charset("utf8");

// OS & Software aus DB laden
$osResult = $conn->query("SELECT * FROM os");
$swResult = $conn->query("SELECT * FROM software");
?>


<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Schritt 6: Betriebssystem & Software</title>
  <link href="../bootstrap5.3/css/bootstrap.min.css" rel="stylesheet">
      <link href="../bootstrap5.3/css/main.css" rel="stylesheet">

</head>
<body>
<main class="container py-5">
  <h1 class="display-5 fw-bold">PC-Konfigurator</h1>
  <h2 class="fs-4 mb-4">Schritt 6 von 7: Betriebssystem & Software</h2>

  <form method="post">
  <!-- Betriebssystem Auswahl (radio) -->
  <h4>Betriebssystem</h4>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-sm-3 g-4 mb-4">
    <?php while($os = $osResult->fetch_assoc()): ?>
      <div class="col">
        <div class="card h-100 shadow-sm">
          <img src="../img/<?= htmlspecialchars($os['bildpfad']) ?>"
               class="card-img-top img-fluid mx-auto d-block"
               alt="<?= htmlspecialchars($os['name']) ?>"
               style="max-height:120px; width:auto; object-fit:contain;">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= htmlspecialchars($os['name']) ?></h5>
            <p class="card-text"><?= htmlspecialchars($os['beschreibung']) ?></p>
            <p><strong><?= number_format($os['preis'], 2, ',', '.') ?> €</strong></p>
            <div class="form-check mt-auto">
              <input class="form-check-input"
                     type="radio"
                     name="os"
                     id="os<?= $os['id'] ?>"
                     value="<?= $os['id'] ?>"
                     <?= (isset($_SESSION['os']) && $_SESSION['os'] == $os['id']) ? 'checked' : '' ?>
                     required>
              <label class="form-check-label" for="os<?= $os['id'] ?>">Auswählen</label>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>

  <!-- Software Auswahl (checkbox) -->
  <h4>Zusatzsoftware</h4>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-sm-3 g-4">
    <?php while($sw = $swResult->fetch_assoc()): ?>
      <div class="col">
        <div class="card h-100 shadow-sm">
          <img src="../img/<?= htmlspecialchars($sw['bildpfad']) ?>"
               class="card-img-top img-fluid mx-auto d-block"
               alt="<?= htmlspecialchars($sw['name']) ?>"
               style="max-height:120px; width:auto; object-fit:contain;">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= htmlspecialchars($sw['name']) ?></h5>
            <p class="card-text"><?= htmlspecialchars($sw['beschreibung']) ?></p>
            <p><strong><?= number_format($sw['preis'], 2, ',', '.') ?> €</strong></p>
            <div class="form-check mt-auto">
              <input class="form-check-input"
                     type="checkbox"
                     name="software[]"
                     value="<?= $sw['id'] ?>"
                     id="sw<?= $sw['id'] ?>"
                     <?= (isset($_SESSION['software']) && in_array($sw['id'], $_SESSION['software'])) ? 'checked' : '' ?>>
              <label class="form-check-label" for="sw<?= $sw['id'] ?>">Hinzufügen</label>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>

  <!-- Navigation -->
  <div class="mt-4">
    <a href="zubehoer.php" class="btn btn-secondary">Zurück zu Schritt 5</a>
    <button type="submit" class="btn btn-primary">Weiter zu Schritt 7</button>
  </div>
</form>

</main>
<script src="../bootstrap5.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
include_once("includes/footer.php");
?>
