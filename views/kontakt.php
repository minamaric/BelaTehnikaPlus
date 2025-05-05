<?php
    require_once '../config/konekcija.php';
    require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config/config.php';
    require_once ABSOLUTE_PATH . 'models/funkcije/funkcije.php';
    include ABSOLUTE_PATH . 'models/funkcije/statistikaLogika.php';
    global $conn;
?>

<!doctype html>
<html lang="en">
<head>
    <meta name="description" content='Mesto gde možete pronaći najpouzdaniju, najnoviju i najpovoljniju belu tehniku. Naravno, sve to uz raznovrsan izbor, brze i sigurne isporuke.' />
    <meta name="keywords" content="BelaTehnikaPlus. Bela tehnika, frižideri, klime, veš mašine" />
    <?php include "fixed/head.php" ?>
    <link rel="shortcut icon" href="../assets/img/ikonica.png" />
    <title>BelaTehnikaPlus</title>
</head>
<body id="index">
    <?php include "fixed/header.php" ?>
    <main>
        <div class="container">
            <h1 class="text-center mt-5 fw-bold">Kontaktirajte <span style="color: #e13142">nas</span></h1>
            <form id="kontaktForma" action="validacijaKontakt.php" method="POST">
                <div class="mb-3 mt-5">
                    <label for="imeK" class="form-label">Ime i prezime:</label>
                    <input type="text" class="form-control" id="imeK" name="imeK" placeholder="Ime i prezime"/>
                </div>
                <div class="mb-3">
                    <label for="emailK" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="emailK" name="emailK" placeholder="Email"/>
                </div>
                <div class="mb-3">
                    <label for="poruka" class="form-label">Poruka:</label>
                    <textarea class="form-control" id="poruka" name="poruka" rows="3" placeholder="Vaša poruka"></textarea>
                </div>
                <span class="text-center" id="spanKontakt"></span>
                <button type="submit" class="btn btn-primary mb-5" id="kontaktDugme">Pošalji</button>
            </form>
        </div>
    </main>

    <footer class="mt-5">
        <?php include "fixed/footer.php" ?>
    </footer>

    <script src="../assets/jQuery/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>