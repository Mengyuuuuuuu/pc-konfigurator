<?php
// step4_ram.php
include_once("includes/header.php");

$cpu = $_POST['cpu'] ?? null;
$gehaeuse = $_POST['gehaeuse'] ?? null;
$maxRam = 128; // fallback-Wert

// Verbindung zur Datenbank
$conn = new mysqli("localhost", "root", "", "mustermann");
$conn->set_charset("utf8");

if ($cpu) {
    $stmt = $conn->prepare("SELECT max_ram FROM cpus WHERE modell = ?");
    $stmt->bind_param("s", $cpu);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $maxRam = $row['max_ram'];
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>PC-Konfigurator - Schritt 4: RAM</title>
  <link href="../bootstrap5.3/css/bootstrap.min.css" rel="stylesheet">
  <script>
    function updatePreis() {
      const ram = document.getElementById("ram").value;
      const preis = (ram * 0.80).toFixed(2).replace(".", ",");
      document.getElementById("preisAnzeige").innerText = preis + " €";
    }
  </script>
</head>
<body>
  <main class="container py-5">
    <h1 class="display-5 fw-bold">PC-Konfigurator</h1>
    <h2 class="fs-4 mb-4">Schritt 4 von 5: Arbeitsspeicher</h2>

    <form action="zubehoer.php" method="post">
      <!-- Weitergabe bisheriger Auswahl -->
      <input type="hidden" name="cpu" value="<?= htmlspecialchars($cpu) ?>">
      <input type="hidden" name="gehaeuse" value="<?= htmlspecialchars($gehaeuse) ?>">

      <label for="ram" class="form-label">Arbeitsspeicher wählen (max. <?= $maxRam ?> GB):</label>
      <select class="form-select w-25 mb-3" name="ram" id="ram" onchange="updatePreis()">
        <?php
          for ($i = 4; $i <= $maxRam; $i += 4) {
              echo "<option value='$i'>{$i} GB</option>";
          }
        ?>
      </select>

      <div class="mb-3">Preis: <strong id="preisAnzeige">3,20 €</strong></div>

      <a href="cpu.php" class="btn btn-secondary ms-2">Zurück zu Schritt 3</a>
      <button type="submit" class="btn btn-primary">Weiter zu Schritt 5</button>
    </form>
  </main>
  <script>updatePreis();</script>
  <script src="../bootstrap5.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
include_once("includes/footer.php");
?>

