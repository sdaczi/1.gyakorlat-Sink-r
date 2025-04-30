<?php
$uzenet = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === "" || $email === "" || $message === "") {
        $uzenet = "Minden mezőt ki kell tölteni!";
    } else {
        try {
            $dbh = new PDO(
                'mysql:host=localhost;dbname=daczihu0_webprog',
                'daczihu0_daczihu0',
                '2u4Y3ocdUI',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
            $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

if (!isset($_SESSION['login'])){
    $name = 'Vendég';
}


            $stmt = $dbh->prepare("INSERT INTO sentmessage (name, email, message) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $message]);

            $uzenet = "Üzenet sikeresen elküldve.";
        } catch (PDOException $e) {
            $uzenet = "Hiba történt: " . $e->getMessage();
        }
    }
}
