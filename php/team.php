<?php
// Verbindung zur Datenbank aufbauen
$link = mysqli_connect("localhost", "root", "", "mustermann")
or die("Fehler: " . mysqli_error($link));

echo "<h1>Support-Team</h1>";

$queryCount = "SELECT COUNT(*) AS cnt FROM team";
$resultCount = mysqli_query($link, $queryCount) or die("Query error: " . mysqli_error($link));
$countData = mysqli_fetch_assoc($resultCount);
echo "<p><strong>Anzahl Teammitglieder:</strong> " . $countData['cnt'] . "</p>";

$queryAlpha = "SELECT nachname FROM team ORDER BY nachname ASC";
$resultAlpha = mysqli_query($link, $queryAlpha) or die("Query error: " . mysqli_error($link));
$namesAlpha = [];
while ($row = mysqli_fetch_assoc($resultAlpha)) {
    $namesAlpha[] = $row['nachname'];
}
echo "<p><strong>Support-Team (alphabetisch):</strong> " . implode(" ", $namesAlpha) . "</p>";

$queryOld = "SELECT nachname FROM team WHERE eintrittsjahr < 2018 ORDER BY nachname ASC";
$resultOld = mysqli_query($link, $queryOld) or die("Query error: " . mysqli_error($link));
$longTerm = [];
while ($row = mysqli_fetch_assoc($resultOld)) {
    $longTerm[] = $row['nachname'];
}
echo "<p><strong>Support-Team (langjährige Mitarbeiter*innen):</strong> " . implode(" ", $longTerm) . "</p>";

$queryJoin = "SELECT nachname, eintrittsjahr FROM team ORDER BY eintrittsjahr DESC";
$resultJoin = mysqli_query($link, $queryJoin) or die("Query error: " . mysqli_error($link));
$entryList = [];
while ($row = mysqli_fetch_assoc($resultJoin)) {
    $entryList[] = $row['nachname'] . " (" . $row['eintrittsjahr'] . ")";
}
echo "<p><strong>Support-Team (nach Firmeneintritt):</strong> " . implode(", ", $entryList) . "</p>";

$queryList = "SELECT vorname, nachname, eintrittsjahr FROM team ORDER BY eintrittsjahr DESC";
$resultList = mysqli_query($link, $queryList) or die("Query error: " . mysqli_error($link));
echo "<p><strong>Support-Team in Liste:</strong></p>";
echo "<ul>";
while ($row = mysqli_fetch_assoc($resultList)) {
    echo "<li>" . $row['vorname'] . " " . $row['nachname'] . ", " . $row['eintrittsjahr'] . "</li>";
}
echo "</ul>";

mysqli_close($link);
?>