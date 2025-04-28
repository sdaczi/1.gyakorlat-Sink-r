<?php
$uzenet = "";
$ujra = false;

if (
    $_SERVER["REQUEST_METHOD"] === "POST" &&
    isset($_POST['felhasznalo']) &&
    isset($_POST['jelszo']) &&
    isset($_POST['vezeteknev']) &&
    isset($_POST['utonev'])
) {
    try {
        $dbh = new PDO(
            'mysql:host=localhost;dbname=daczihu0_webprog',
            'daczihu0_daczihu0',
            '2u4Y3ocdUI',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

        // Felhasználónév ellenőrzés
        $sqlSelect = "SELECT id FROM felhasznalok WHERE bejelentkezes = :bejelentkezes";
        $sth = $dbh->prepare($sqlSelect);
        $sth->execute([':bejelentkezes' => $_POST['felhasznalo']]);

        if ($sth->fetch(PDO::FETCH_ASSOC)) {
            $uzenet = "A felhasználónév már foglalt!";
            $ujra = true;
        } else {
            // Új regisztráció
            $sqlInsert = "INSERT INTO felhasznalok (id, csaladi_nev, uto_nev, bejelentkezes, jelszo)
                          VALUES (0, :csaladinev, :utonev, :bejelentkezes, :jelszo)";
            $stmt = $dbh->prepare($sqlInsert);
            $stmt->execute([
                ':csaladinev' => $_POST['vezeteknev'],
                ':utonev' => $_POST['utonev'],
                ':bejelentkezes' => $_POST['felhasznalo'],
                ':jelszo' => sha1($_POST['jelszo'])
            ]);

            if ($stmt->rowCount()) {
                $newid = $dbh->lastInsertId();
                $uzenet = "Sikeres regisztráció! Azonosító: {$newid}";
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
}
