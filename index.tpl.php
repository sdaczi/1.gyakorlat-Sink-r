<?php
session_start();

 if (file_exists('./logicals/' . $keres['fajl'] . '.php')) {
    include("./logicals/{$keres['fajl']}.php");
} ?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <title><?= $ablakcim['cim'] . (isset($ablakcim['mottó']) ? ' | ' . $ablakcim['mottó'] : '') ?></title>
    <link rel="stylesheet" href="./styles/stilus.css" type="text/css">
    <link rel="stylesheet" href="./styles/responsive.css" type="text/css">
    <?php if (file_exists('./styles/' . $keres['fajl'] . '.css')) { ?>
        <link rel="stylesheet" href="./styles/<?= $keres['fajl'] ?>.css" type="text/css">
    <?php } ?>
</head>
<body>
<header>
    <img src="./images/<?= $fejlec['kepforras'] ?>" alt="<?= $fejlec['kepalt'] ?>">
    <h1><?= $fejlec['cim'] ?></h1>
    <?php if (isset($fejlec['motto'])) { ?><h2><?= $fejlec['motto'] ?></h2><?php } ?>

    <?php if (isset($_SESSION['login'])): ?>
        <p>Bejelentkezett: <?= $_SESSION['csn'] ?> <?= $_SESSION['un'] ?> (<?= $_SESSION['login'] ?>)</p>
    <?php endif; ?>
</header>

    <button class="menu-toggle" id="menu-toggle">&#9776;</button>
    <aside id="nav">
        <nav class="main-nav" id="main-nav">
            <ul class="menu">
                <?php foreach ($oldalak as $url => $oldal) { ?>
                    <?php if (!isset($_SESSION['login']) && $oldal['menun'][0] || isset($_SESSION['login']) && $oldal['menun'][1]) { ?>
                        <li<?= (($oldal == $keres) ? ' class="active"' : '') ?>>
                            <a href="index.php?oldal=<?= ($url == '/') ? '' : $url ?>">
                                <?= $oldal['szoveg'] ?>
                            </a>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </nav>
    </aside>

    <div id="wrapper">
        <div id="content">
            <?php include("./templates/pages/{$keres['fajl']}.tpl.php"); ?>
        </div>
    </div>


    <footer>
<br>
        <?php if (isset($lablec['copyright'])) { ?>
            &copy; <?= $lablec['copyright'] ?>
        <?php } ?>
        <?php if (isset($lablec['ceg'])) { ?>
            <?= $lablec['ceg'] ?>
        <?php } ?>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggle = document.getElementById("menu-toggle");
            const nav = document.getElementById("main-nav");

            toggle.addEventListener("click", function () {
                nav.classList.toggle("open");
            });
        });
    </script>
</body>
</html>