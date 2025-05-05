<?php
    require_once '../config/konekcija.php';
    require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config/config.php';
    require_once ABSOLUTE_PATH . 'models/funkcije/funkcije.php';
    global $conn;
    include ABSOLUTE_PATH . 'models/funkcije/statistikaLogika.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta name="keywords" content="O autoru, Mina Marić" />
    <meta name="description" content= 'Saznajte više o autoru sajta!' />
    <?php include "fixed/head.php"; ?>
    <link rel="shortcut icon" href="../assets/img/ikonica.png" />
    <title>O autoru</title>
</head>
<body>

    <?php include "fixed/header.php" ?>

    <section id="autor">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Autor</h1>
                </div>
                <div id="tekst" class="col-md-4">
                    <h3 class="my-3">OSNOVNE INFORMACIJE</h3>
                    <p><span>Ime:</span> Mina</p>
                    <p><span>Prezime</span>: Marić</p>
                    <p><span>Indeks:</span> 55/22</p>
                    <p><span>E-mail:</span> mina.maric.55.22@ict.edu.rs</p>
                    <p><span>Rođendan:</span> 25.06.2003.</p>
                </div>
                <div id="slika" class="col-md-4">
                    <img src="../assets/img/ja.gif" alt="My photo" />
                </div>
                <div id="biografija" class="col-md-4">
                    <h3 class="text-center">BIOGRAFIJA</h3>
                    <p class="text-center d-flex justify-content-center px-5">
                        Rođena sam u Beogradu, 25.06.2003. Ubrzo sam se preselila u Kikindu, gde sam završila Gimnaziju "Dušan Vasiljev".

                        Sada studiram na Visokoj ICT, smer IT.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <footer id="autorFuter">
        <?php include "fixed/footer.php"; ?>
    </footer>
</body>
</html>