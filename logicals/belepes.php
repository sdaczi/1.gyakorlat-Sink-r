<?php
session_start();



$hiba = "";

if (isset($_POST['felhasznalo']) && isset($_POST['jelszo'])) {
    try {
        $dbh = new PDO(
            'mysql:host=localhost;dbname=daczihu0_webprog',
            'daczihu0_daczihu0',
            '2u4Y3ocdUI',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

        $sqlSelect = "SELECT csaladi_nev, uto_nev 
                      FROM felhasznalok 
                      WHERE bejelentkezes = :bejelentkezes AND jelszo = sha1(:jelszo)";
        $sth = $dbh->prepare($sqlSelect);
        $sth->execute([
            ':bejelentkezes' => $_POST['felhasznalo'],
            ':jelszo' => $_POST['jelszo']
        ]);

        $row = $sth->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $_SESSION['csn'] = $row['csaladi_nev'];
            $_SESSION['un'] = $row['uto_nev'];
            $_SESSION['login'] = $_POST['felhasznalo'];
            header("Location: index.php");
            exit();
        } else {
            $hiba = "Hibás felhasználónév vagy jelszó!";
        }
    } catch (PDOException $e) {
        $hiba = "Adatbázishiba: " . $e->getMessage();
    }
}
