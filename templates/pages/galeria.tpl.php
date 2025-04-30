<h2>Galéria</h2>

<?php
// Feltöltés feldolgozása (ha POST és be van jelentkezve)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['login'])) {
    $celmappa = "gallery/";

    if (isset($_FILES['fajl']) && $_FILES['fajl']['error'] == 0) {
        $fajlnev = basename($_FILES['fajl']['name']);
        $cel = $celmappa . $fajlnev;

        $kiterjesztes = strtolower(pathinfo($fajlnev, PATHINFO_EXTENSION));
        $engedelyezett = array("jpg", "jpeg", "png", "gif");

        if (in_array($kiterjesztes, $engedelyezett)) {
            if (move_uploaded_file($_FILES['fajl']['tmp_name'], $cel)) {
                $uzenet = "Sikeres feltöltés!";
            } else {
                $uzenet = "Hiba történt a feltöltés során!";
            }
        } else {
            $uzenet = "Csak képfájlokat (.jpg, .jpeg, .png, .gif) lehet feltölteni!";
        }
    } else {
        $uzenet = "Nem választottál ki képet!";
    }
}
?>


<?php if (isset($uzenet)) : ?>
    <p style="color: green;"><?= htmlspecialchars($uzenet) ?></p>
<?php endif; ?>

<?php if (isset($_SESSION['login'])): ?>
    <!-- Képfeltöltő űrlap -->
    <form action="" method="post" enctype="multipart/form-data">
        <label for="fajl">Kép feltöltése:</label>
        <input type="file" name="fajl" id="fajl" accept=".jpg,.jpeg,.png,.gif" required>
        <input type="submit" value="Feltöltés">
    </form>

<?php endif; ?>

<hr>

<!-- Képek megjelenítése -->
<div class="galeria">
    <?php
    $mappa = './gallery/';
    $kepek = array_diff(scandir($mappa), array('.', '..'));

    if (count($kepek) > 0) {
        foreach ($kepek as $kep) {
            $eleres = $mappa . $kep;
            if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $kep)) {
                echo '<div class="kep">';
                echo '<img src="' . $eleres . '" alt="' . htmlspecialchars($kep) . '" width="300">';
                echo '</div>';
            }
        }
    } else {
        echo "<p>Nincsenek képek a galériában.</p>";
    }
    ?>
</div>
