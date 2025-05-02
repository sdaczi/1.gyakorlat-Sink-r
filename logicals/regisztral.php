<?php
session_start();
include('./config.inc.php');

$uzenet = "";
$ujra = false;

if ($_SERVER["REQUEST_METHOD"] === "POST" &&
    isset($_POST['felhasznalo']) &&
    isset($_POST['jelszo']) &&
    isset($_POST['vezeteknev']) &&
    isset($_POST['utonev'])) {

    try {
        $dbh = new PDO(
            'mysql:host=localhost;dbname=daczihu0_webprog',
            'daczihu0_daczihu0',
            '2u4Y3ocdUI',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );

        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

        $sqlSelect = "SELECT id FROM felhasznalok WHERE bejelentkezes = :bejelentkezes";
        $sth = $dbh->prepare($sqlSelect);
        $sth->execute([':bejelentkezes' => $_POST['felhasznalo']]);

        if ($sth->fetch(PDO::FETCH_ASSOC)) {
            $uzenet = "A felhasználónév már foglalt!";
            $ujra = true;
        } else {
            $sqlInsert = "INSERT INTO felhasznalok (csaladi_nev, uto_nev, bejelentkezes, jelszo)
                          VALUES (:csaladinev, :utonev, :bejelentkezes, :jelszo)";
            $stmt = $dbh->prepare($sqlInsert);
            $stmt->execute([
                ':csaladinev' => $_POST['vezeteknev'],
                ':utonev' => $_POST['utonev'],
                ':bejelentkezes' => $_POST['felhasznalo'],
                ':jelszo' => sha1($_POST['jelszo'])
            ]);

            if ($stmt->rowCount()) {
                $newid = $dbh->lastInsertId();
                $uzenet = "Sikeres regisztráció!";
                $ujra = false;
            } else {
                $uzenet = "A regisztráció nem sikerült.";
                $ujra = true;
            }
        }
    } catch (PDOException $e) {
        $uzenet = "Hiba: " . $e->getMessage();
        $ujra = true;
    }
} else {
    $uzenet = "Hiányzó adatok!";
    $ujra = true;
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Regisztráció eredménye</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background-color: #f9f9f9;
        }
        .message {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: <?= $ujra ? '#f8d7da' : '#d4edda' ?>;
            color: <?= $ujra ? '#721c24' : '#155724' ?>;
            border: 1px solid <?= $ujra ? '#f5c6cb' : '#c3e6cb' ?>;
            border-radius: 5px;
            text-align: center;
        }
        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
        }
        .back-link a {
            text-decoration: none;
            color: #007bff;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

</html>
