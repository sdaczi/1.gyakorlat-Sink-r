
<?php
if (!isset($_SESSION['login'])) {
    echo "<p style='color:red;'>Az üzenetek megtekintéséhez be kell jelentkezni.</p>";
    return;
}

require_once 'webprogconnection.php';

$sql = "SELECT name, message, created_at FROM sentmessage ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Kapcsolatfelvételi üzenetek</h2>";
    echo "<table border='1' cellpadding='10' cellspacing='0'>
            <tr>
                <th>Küldő neve</th>
                <th>Üzenet</th>
                <th>Küldés ideje</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        $nev = trim($row["name"]) === "" ? "Vendég" : htmlspecialchars($row["name"]);
        echo "<tr>
                <td>{$nev}</td>
                <td>" . nl2br(htmlspecialchars($row["message"])) . "</td>
                <td>" . $row["created_at"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>Nincsenek még üzenetek.</p>";
}
$conn->close();
?>
