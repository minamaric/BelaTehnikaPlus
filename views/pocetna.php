<?php
    include ABSOLUTE_PATH . 'models/funkcije/statistikaLogika.php';
    require_once 'config/konekcija.php';
    global $conn;
?>

<!doctype html>
<html lang="en">
<head>
    <meta name="description" content='Mesto gde možete pronaći najpouzdaniju, najnoviju i najpovoljniju belu tehniku. Naravno, sve to uz raznovrsan izbor, brze i sigurne isporuke.' />
    <meta name="keywords" content="BelaTehnikaPlus. Bela tehnika, frižideri, klime, veš mašine" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="mailto:mina.maric.55.22@ict.edu.rs" />
    <link rel="stylesheet" href="assets/css/style.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/responsive.css" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="shortcut icon" href="./assets/img/ikonica.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap">
    <title>BelaTehnikaPlus</title>
</head>
<body id="index">
<?php //include "views/fixed/header.php" ?>
<main>
        <section id="section_cover">
            <div class="row">
                <div class="container-fluid">
                    <?php
                        $upit = "SELECT * FROM slike WHERE id = 1";
                        $rez = $conn->query($upit);
                        $slika = $rez->fetch(PDO::FETCH_ASSOC);
                        slika($slika);
                    ?>
                    <h1 class="my-4" id="naslovna_slika">Odaberite najbolje!</h1>
                    <h4 class="my-4" id="opis_naslov"><span>&nbsp;BelaTehnikaPlus</span> garantuje kvalitet i sigurnost!</h4>
                    <a href="#section_ponuda"><input type="button" value="Saznaj više" class="mt-5"/></a>
                </div>
            </div>
        </section>

        <section id="section_ponuda">
            <div class="container">
                <h1 class="text-center mt-5 mb-5 fw-bold">Naša <span>ponuda</span></h1>
                <div id="ponuda-div" class="row g-4">
                    <?php
                    $upit = "SELECT * FROM slike";
                    $rez = $conn->query($upit);
                    $slike = $rez->fetchAll(PDO::FETCH_ASSOC);
                    ponuda($slike);
                    ?>
                </div>
            </div>
        </section>


        <section id="o_nama_section">
            <div class="row">
                <div class="container">
                    <h1 class="text-center my-5 pb-4 fw-bold">O <span>nama</span></h1>
                    <div id="o_nama_div" class="d-flex justify-content-center align-items-center">
                        <div class="col-6">
                            <h3 class="text-center">Dobrodošli u <span>BelaTehnikaPlus</span></h3> <hr/>
                            <p class="text-left m-5 px-5">
                                Verujemo u transparentnost, pouzdanost i izvanrednu korisničku podršku. <br/>Naš tim stručnjaka je tu da Vam pruži sve neophodne informacije i savete kako biste doneli najbolju odluku prilikom odabira bele tehnike za Vaš dom.<br/><br/>
                                Hvala Vam što ste izabrali BelaTehnikaPlus. Radujemo se što ćemo Vam pružiti vrhunsko iskustvo kupovine i usluge koje zaslužujete.
                            </p>
                        </div>
                        <div class="col-6">
                            <?php
                                $upit = "SELECT * FROM slike WHERE id = 7";
                                $rez = $conn->query($upit);
                                $slika = $rez->fetch(PDO::FETCH_ASSOC);
                                slika($slika);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section4">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-center mt-5">Naše <span>novosti</span></h1>
                        <p class="text-center">Prijavite se za obaveštenja na nedeljnom nivou!</p>
                        <form action="../models/funkcije/prijavaPocetna.php" id="prijavaForma">
                            <div id="mail" class="d-flex justify-content-center align-items-center">
                                <input id="text" type="text" placeholder="&nbsp; E-mail" />
                                <input id="button1" type="button" name="button1" value="Pretplatite se" data-bs-toggle="modal" data-bs-target="#exampleModal"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <span id="mejlSpan"></span>

        </section>

        <section id="pogodnosti">
            <div class="row">
                <div class="container">
                    <div id="ikonice" class="d-flex justify-content-around align-items-center m-5 px-5">
                        <?php
                            $upit = "SELECT * FROM ikonice";
                            $rez = $conn->query($upit);
                            $ikonica = $rez->fetchAll(PDO::FETCH_ASSOC);
                            ikonica($ikonica);
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <?php include "views/fixed/footer.php" ?>
    </footer>

    <script src="./assets/jQuery/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="./assets/js/script.js"></script>
</body>
</html>