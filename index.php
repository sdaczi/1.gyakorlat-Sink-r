<?php
session_start();
include('./config.inc.php');

$oldal = '/';
if (isset($_GET['oldal'])) {
    $oldal = $_GET['oldal'];
}
if (!array_key_exists($oldal, $oldalak)) {
    $oldal = '/';
}
$keres = $oldalak[$oldal];

include('./index.tpl.php');
?>