<?php
    require_once '../config/konekcija.php';
    require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config/config.php';

    if (file_exists(LOG_FAJL) && is_readable(LOG_FAJL)) {
        $logovi = file(LOG_FAJL, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    } else {
        $logovi = [];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="keywords" content="BelaTehnikaPlus. Bela tehnika, frižideri, klime, veš mašine" />
    <meta name="description" content='Odaberite tačno ono što Vam treba! Sve na jednom mestu!' />
    <?php include "fixed/head.php" ?>
    <link rel="shortcut icon" href="../assets/img/ikonica.png" />
    <title>Admin - Pregled Poseta</title>
</head>
<body>
    <?php include "fixed/header.php" ?>
        <div class="row align-items-center">
            <div class="col naslov">
                <h1 class="text-center mt-5">Pregled <span id="prod">poseta</span></h1>
            </div>
        </div>

    <?php if (!empty($logovi)): ?>
        <table border="1" id="poseteTabela">
            <thead>
            <tr>
                <th>Vreme</th>
                <th>Stranica</th>
                <th>IP Adresa</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($logovi as $log): ?>
                <?php
                $delovi = explode("\t", $log);
                if (count($delovi) === 3):
                    list($vreme, $stranica, $ip) = $delovi;
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($vreme); ?></td>
                        <td><?= htmlspecialchars($stranica); ?></td>
                        <td><?= htmlspecialchars($ip); ?></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="3">Neispravna linija loga: <?= htmlspecialchars($log); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nema zabeleženih poseta.</p>
    <?php endif; ?>

    <footer>
        <?php include "fixed/footer.php" ?>
    </footer>

    <script src="../assets/jQuery/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>
