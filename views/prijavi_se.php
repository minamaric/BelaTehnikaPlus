<?php
    require_once '../config/konekcija.php';
    require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config/config.php';
    require_once ABSOLUTE_PATH . 'models/funkcije/funkcije.php';
    require_once ABSOLUTE_PATH . 'models/funkcije/prijava.php';
    include ABSOLUTE_PATH . 'models/funkcije/statistikaLogika.php';
    global $conn;
?>

<!doctype html>
<html lang="en">
<head>
    <meta name="description" content='Registrujte se i obezvedite sebi razne dodatne mogućnosti koje olakšavaju kupovinu i razgledanje naših proizvoda!' />
    <meta name="keywords" content="BelaTehnikaPlus. Registracija, prijava, logovanje" />
    <?php include "fixed/head.php" ?>
    <link rel="shortcut icon" href="../assets/img/ikonica.png" />
    <title>BelaTehnikaPlus - Prijava</title>
</head>
<body>
<?php include "fixed/header.php" ?>
<?php
if (isset($_SESSION['error_message'])) {
    echo '<div class="alert alert-danger mt-5 mb-1">' . $_SESSION['error_message'] . '</div>';
    unset($_SESSION['error_message']);
}
?>
    <main>
        <section>
            <div class="container">
                    <section id="section5">
                        <div class="container">
                            <div class="row " id="prijava">
                                <h1 class="text-center my-5">Prijavi <span>se</span></h1>
                                <form method="POST" action="../models/funkcije/validacijaForme.php" class="container" id="registracijaForma">
                                    <div class="row">
                                        <div id="prvaKolona" class="col-12 col-xl-6">
                                            <div class="form-group mt-3">
                                                <label for="ime">Ime i prezime:</label>
                                                <input type="text" class="form-control borderClass" id="ime" placeholder="Unesite ime i prezime">
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="email">Email:</label>
                                                <input type="text" class="form-control borderClass" id="email" placeholder="Unesite email">
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="sifra">Šifra:</label>
                                                <input type="password" class="form-control borderClass" id="sifra" placeholder="Unesite šifru">
                                            </div>
                                        </div>
                                        <div id="drugaKolona" class="col-12 col-xl-6">
                                            <div class="form-group mt-3">
                                                <label for="adresa">Adresa:</label>
                                                <input type="text" class="form-control borderClass" id="adresa" placeholder="Unesite adresu">
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="vrstaIsporuke">Odaberi vrstu isporuke:</label>
                                                <select class="form-control" id="vrstaIsporuke" name="vrstaIsporuke">
                                                    <option value="0">Izaberi</option>
                                                    <option value="1">Brza pošta</option>
                                                    <option value="2">Obična isporuka</option>
                                                </select>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label>Pol:</label>
                                                <div id="pol" class="d-flex align-items-center">
                                                    <div class="form-check mx-3">
                                                        <input class="form-check-input" type="radio" name="pol" id="muski" value="muski">
                                                        <label class="form-check-label" for="muski">Muški</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="pol" id="zenski" value="zenski">
                                                        <label class="form-check-label" for="zenski">Ženski</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <span id="prijavaSpan" class="mt-5 text-center"></span>
                                <button type="submit" id="prijaviSe">Prijavi se</button>
                                <span id="pocetnaSpan" class="mt-2 text-center"></span>
                            </div>
                            <a href="#" id="vecPostojiNalog"><p class="my-5">Već imate nalog?</p></a>
                        </div>

                        <div class="container" id="login">
                            <div class="row d-flex justify-content-center align-items-center">
                                <div id="formaZaLogovanje" style="display: none" class="col-10" >
                                    <h1 class="text-center my-5" id="loginh1">Login</h1>
                                    <form method="POST" action="../models/funkcije/prijava.php" class="d-grid my-2"  id="logovanjeForma">
                                        <div class="col-5 mb-4">
                                            <label for="emailLog">Email:</label>
                                            <input type="text" class="form-control borderClass" id="emailLog" placeholder="Unesite email" required />
                                        </div>
                                        <div class="col-5">
                                            <label for="sifraLog">Šifra:</label>
                                            <input type="password" class="form-control borderClass" id="sifraLog" placeholder="Unesite šifru" required />
                                        </div>
                                        <button type="submit" id="loginSe">Login</button>
                                    </form>
                                    <span id="loginSpan" class="mt-5 text-center"></span>
                                    <span id="loginLinkSpan" class="mt-2 text-center"></span>
                                </div>
                            </div>
                        </div>
                    </section>
            </div>
        </section>
    </main>

    <footer id="footer_prijava">
        <?php include "fixed/footer.php" ?>
    </footer>

<script src="../assets/jQuery/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="../assets/js/script.js"></script>
</body>
</html>