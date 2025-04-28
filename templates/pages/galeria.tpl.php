<h2>Galéria</h2>

<?php
// Feltöltés feldolgozása (ha POST és be van jelentkezve)

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
