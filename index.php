<?php
session_start();
include('./config.inc.php');

// Először beolvassuk az oldalt
$oldal = '/';
if (isset($_GET['oldal'])) {
    $oldal = $_GET['oldal'];
}
if (!array_key_exists($oldal, $oldalak)) {
    $oldal = '/';
}
$keres = $oldalak[$oldal];

// És csak utána kezeljük a POST-ot
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($oldal) {
        case 'kapcsolat':
            include('kapcsolat.php');
            break;
        case 'regisztral':
            include('regisztral.php');
            break;
        case 'belepes':
            include('belepes.php');
            break;
        // ide jöhetnek új POST kezelők
    }
}

// Végül megjelenítjük az oldalt
include('./index.tpl.php');
?>
