<?php
require_once '../config/konekcija.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config/config.php';
require_once ABSOLUTE_PATH . 'models/funkcije/funkcije.php';
include ABSOLUTE_PATH . 'models/funkcije/statistikaLogika.php';
global $conn;

if (isset($_POST['dodaj_u_korpu'])) {
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        $_SESSION['error_message'] = "Morate biti prijavljeni da biste dodali proizvod u korpu.";
        header('Location: ../views/prijavi_se.php');
        exit();
    }

    if (isset($_SESSION['error_message'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
        unset($_SESSION['error_message']);
    }

    $productId = $_POST['product_id'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if (!isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] = 1;
    } else {
        $_SESSION['cart'][$productId]++;
    }

    header('Location: ../views/prodavnica.php');
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta name="keywords" content="BelaTehnikaPlus. Bela tehnika, frižideri, klime, veš mašine" />
    <meta name="description" content='Odaberite tačno ono što Vam treba! Sve na jednom mestu!' />
    <?php include "fixed/head.php" ?>
    <link rel="shortcut icon" href="../assets/img/ikonica.png" />
    <title>BelaTehnikaPlus - Prodavnica</title>
</head>
<body>
<?php include "fixed/header.php" ?>
    <main>
        <section>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col naslov">
                        <h1 class="text-center my-5">Naša <span id="prod">prodavnica</span></h1>
                    </div>
                </div>

                <div class="row align-items-center mt-3" id="prodavnica">
                    <div class="col-md-4">
                        <h5>Pretraži</h5>
                        <input type="search" class="form-control" id="inputZaFunkciju"/>
                    </div>
                    <div class="col-md-4">
                        <h5 class="mt-4 mt-md-0">Sortiraj</h5>
                        <select name="sort" id="sort" class="form-control">
                            <option value="0">Izaberi</option>
                            <option value="cenaAsc">Ceni - rastuće</option>
                            <option value="cenaDesc">Ceni - opadajuće</option>
                            <option value="nazivAsc">Nazivu - rastuće</option>
                            <option value="nazivDesc">Nazivu - opadajuće</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <h5>Kategorije</h5>
                        <div id="proizvodi">
                            <select name="kategorije" id="kategorije" class="form-control">
                                <option value="0">Izaberite</option>
                                <?php
                                $upit = "SELECT * FROM vrsta_proizvoda";
                                $rez = $conn->query($upit);
                                $proizvod = $rez->fetchAll(PDO::FETCH_ASSOC);
                                ispisKategorije($proizvod);
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex shop-items" id="sviProizvodi">
                        <?php
                        $query = "SELECT * FROM proizvodi";
                        $stmt = $conn->query($query);

                        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {  // PDO::FETCH_OBJ vraća rezultate kao objekte
                            echo '<div class="col-xl-2 shop-item m-5">';
                            echo '<div class="slikaDiv">';
                            echo '<img src="' . htmlspecialchars($row->slika) . '" alt="' . htmlspecialchars($row->naziv) . '" class="slike_ponuda shop-item-image" />';
                            echo '</div>';
                            echo '<div class="tekstProizvoda">';
                            echo '<h6 class="text-center shop-item-title">' . htmlspecialchars($row->naziv) . '</h6>';
                            echo '<p>Cena: ' . htmlspecialchars($row->cena) . ' RSD</p>';
                            echo '<form method="post" action="prodavnica.php">';
                            echo '<input type="hidden" name="product_id" value="' . htmlspecialchars($row->id) . '">';
                            echo '<button type="submit" name="dodaj_u_korpu" class="btn btn-primary shop-item-button mt-2 dodaj_u_korpu">Dodaj u korpu</button>';
                            echo '</form>';
                            echo '</div>';
                            echo '</div>';
                        }


                        ?>
                    </div>
                </div>
            </div>
        </section>

        <script src="../assets/jQuery/jquery-3.7.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="../assets/js/script.js"></script>
        <script src="../assets/js/korpa.js"></script>
    </main>

    <footer id="footer_prodavnica">
        <?php include "fixed/footer.php" ?>
    </footer>

</body>
</html>