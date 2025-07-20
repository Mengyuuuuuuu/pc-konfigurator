<?php
include_once("includes/header.php");
// Verbindung zur Datenbank
$conn = new mysqli("localhost", "root", "", "mustermann");
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}
$conn->set_charset("utf8");

// Vorherige Auswahl mitnehmen
$gehaeuse = $_POST['gehaeuse'] ?? '';
$cpu = $_POST['cpu'] ?? '';
$ram = $_POST['ram'] ?? '';
$zubehoer = $_POST['zubehoer'] ?? [];
$ausstattung = $_POST['ausstattung'] ?? [];

// OS & Software laden
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

  <form action="monitor.php" method="post">
    <!-- Übergabe vorheriger Daten -->
    <input type="hidden" name="gehaeuse" value="<?= htmlspecialchars($gehaeuse) ?>">
    <input type="hidden" name="cpu" value="<?= htmlspecialchars($cpu) ?>">
    <input type="hidden" name="ram" value="<?= htmlspecialchars($ram) ?>">
    <?php foreach ((array)$zubehoer as $z): ?>
      <input type="hidden" name="zubehoer[]" value="<?= htmlspecialchars($z) ?>">
    <?php endforeach; ?>
    <?php foreach ((array)$ausstattung as $a): ?>
      <input type="hidden" name="ausstattung[]" value="<?= htmlspecialchars($a) ?>">
    <?php endforeach; ?>

    <!-- Betriebssystem Auswahl (radio) -->
    <h4>Betriebssystem</h4>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-sm-3 g-4 mb-4">
      <?php while($os = $osResult->fetch_assoc()): ?>
        <div class="col">
          <div class="card h-100 shadow-sm">
            <img src="../img/<?= $os['bildpfad'] ?>" class="card-img-top img-fluid mx-auto d-block" alt="<?= $os['name'] ?>" style="max-height:120px; width:auto; object-fit:contain;">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title"><?= $os['name'] ?></h5>
              <p class="card-text"><?= $os['beschreibung'] ?></p>
              <p><strong><?= number_format($os['preis'], 2, ',', '.') ?> €</strong></p>
              <div class="form-check mt-auto">
                <input class="form-check-input" type="radio" name="os" id="os<?= $os['id'] ?>" value="<?= $os['id'] ?>" required>
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
            <img src="../img/<?= $sw['bildpfad'] ?>" class="card-img-top img-fluid   mx-auto d-block" alt="<?= $sw['name'] ?>" style="max-height:120px; width:auto; object-fit:contain;">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title"><?= $sw['name'] ?></h5>
              <p class="card-text"><?= $sw['beschreibung'] ?></p>
              <p><strong><?= number_format($sw['preis'], 2, ',', '.') ?> €</strong></p>
              <div class="form-check mt-auto">
                <input class="form-check-input" type="checkbox" name="software[]" value="<?= $sw['id'] ?>" id="sw<?= $sw['id'] ?>">
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
