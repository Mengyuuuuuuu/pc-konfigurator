<?php
include_once("includes/header.php");
session_start();

if (isset($_POST['gehaeuse'])) {
    $_SESSION['gehaeuse'] = $_POST['gehaeuse']; //  gehaeuse in session speichern
}

// Datenbankverbindung
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'mustermann';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}
$conn->set_charset("utf8");

// Hersteller-Filter übernehmen
$hersteller = $_GET['hersteller'] ?? ($_POST['hersteller'] ?? 'Intel');

// CPU-Daten abfragen
$sql = "SELECT * FROM cpus WHERE hersteller = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $hersteller);
$stmt->execute();
$result = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>PC-Konfigurator - Schritt 3: CPU</title>
  <link href="../bootstrap5.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main>
  <div class="container py-5">
    <h1 class="display-5 fw-bold">PC-Konfigurator</h1>
    <h2 class="fs-4 mb-4">Schritt 3 von 5: Prozessor</h2>

    <!-- Hersteller-Filter -->
    <div class="mb-3">
      <a href="?hersteller=Intel" class="me-3">Intel</a>
      <a href="?hersteller=AMD">AMD</a>
    </div>

    <!-- CPU-Tabelle -->
    <table class="table table-striped align-middle">
      <thead class="table-light">
        <tr>
          <th>Modell</th>
          <th>Produktnr.</th>
          <th>Preis</th>
          <th>max RAM</th>
          <th>Auswahl</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['modell']) ?></td>
            <td><?= htmlspecialchars($row['produktnummer']) ?></td>
            <td><?= number_format($row['preis'], 2, ',', '.') ?> €</td>
            <td><?= intval($row['max_ram']) ?> GB</td>
            <td>
              <!-- ✅ nur um CPU weiterzugeben，die anderen Werte sind schon in der Session -->
              <form method="post" action="ram.php">               
                <input type="hidden" name="cpu" value="<?= (int)$row['id'] ?>">
                <button type="submit" class="btn btn-outline-primary btn-sm">auswählen und weiter</button>
              </form>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

    <a href="../gehaeuse.html" class="btn btn-secondary mt-4">Zurück zu Schritt 2</a>
  </div>
</main>

<script src="../bootstrap5.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
include_once("includes/footer.php");
?>
