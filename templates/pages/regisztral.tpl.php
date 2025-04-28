<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Regisztráció</title>
</head>
<body>
    <h2>Regisztrációs űrlap</h2>

    <?php if (!empty($uzenet)) : ?>
        <p style="color: blue;"><strong><?= $uzenet ?></strong></p>
        <?php if ($ujra) : ?>
            <p><a href="index.php?oldal=regisztral">Próbálja újra</a></p>
        <?php endif; ?>
    <?php endif; ?>

    <form method="POST" action="index.php?oldal=regisztral">
        <label>Felhasználónév: <input type="text" name="felhasznalo" required></label><br><br>
        <label>Jelszó: <input type="password" name="jelszo" required></label><br><br>
        <label>Vezetéknév: <input type="text" name="vezeteknev" required></label><br><br>
        <label>Utónév: <input type="text" name="utonev" required></label><br><br>
        <button type="submit">Regisztrálok</button>
    </form>
</body>
</html>
