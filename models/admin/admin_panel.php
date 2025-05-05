<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/config.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/konekcija.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/models/funkcije/funkcije.php';
    global $conn;

    function ispisLogova($conn) {
        $upit = "SELECT * FROM logovi WHERE vreme >= NOW() - INTERVAL 1 DAY";
        $rez = $conn->query($upit);

        if ($rez && $rez->rowCount() > 0) {
            while ($log = $rez->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($log['user_id']) . "</td>";
                echo "<td>" . htmlspecialchars($log['email']) . "</td>";
                echo "<td>" . htmlspecialchars($log['vreme']) . "</td>";
                echo "<td>" . htmlspecialchars($log['aktivnost']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nema logova za poslednjih 24h.</td></tr>";
        }
    }
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
    <link rel="stylesheet" href="../../assets/css/style.css" type="text/css" />
    <link rel="stylesheet" href="../../assets/css/responsive.css" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="shortcut icon" href="../../assets/img/ikonica.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap">
    <title>BelaTehnikaPlus - Admin Panel</title>
</head>
<body>
    <?php include "../../views/fixed/header.php" ?>
    <h1 class="text-center fw-bold mt-5 mb-4">Admin <span style="color: #e13142">panel</span></h1>
        <main class="container mt-4">
            <h2 class="text-center mb-5">Dodavanje proizvoda</h2>
            <div class="container">
                <div class="row">
                    <div id="adminProizvodi" class="d-flex justify-content-center mb-5">
                        <form action="../funkcije/dodaj_proizvod.php" method="POST" enctype="multipart/form-data">
                            <label for="naziv">Naziv proizvoda:</label>
                            <input type="text" id="naziv" name="naziv" required class="form-control"><br><br>

                            <label for="opis">Opis proizvoda:</label>
                            <textarea id="opis" name="opis" required class="form-control"></textarea><br><br>

                            <label for="cena">Cena:</label>
                            <input type="number" id="cena" name="cena" required class="form-control"><br><br>

                            <label for="slika">Slika proizvoda:</label>
                            <input type="file" id="slika" name="slika" required class="form-control"><br><br>

                            <button type="submit" id="dodaj">Dodaj proizvod</button>
                        </form>
                    </div>
                </div>
            </div>

<!--            <div class="container">-->
<!--                <div class="row">-->
<!--                    <div id="brisanjeProizvoda">-->
<!--                        <table>-->
<!--                            <thead>-->
<!--                            <tr>-->
<!--                                <th>Naziv</th>-->
<!--                                <th>Opis</th>-->
<!--                                <th>Cena</th>-->
<!--                                <th>Slika</th>-->
<!--                                <th>Akcija</th>-->
<!--                            </tr>-->
<!--                            </thead>-->
<!--                            <tbody>-->
<!--                            --><?php
//                            $sql = "SELECT * FROM proizvodi";
//                            $stmt = $conn->prepare($sql);
//                            $stmt->execute();
//                            $proizvodi = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
//                            foreach ($proizvodi as $proizvod) {
//                                echo "<tr>";
//                                echo "<td>{$proizvod['naziv']}</td>";
//                                echo "<td>{$proizvod['opis']}</td>";
//                                echo "<td>{$proizvod['cena']}</td>";
//                                echo "<td><img src='../{$proizvod['slika']}' width='100'></td>";
//                                echo "<td><form action='../funkcije/obrisi_proizvod.php' method='POST'>
//                                        <input type='hidden' name='id' value='{$proizvod['id']}'>
//                                        <button type='submit'>Obriši</button>
//                                      </form></td>";
//                                echo "</tr>";
//                            }
//                            ?>
<!--                            </tbody>-->
<!--                        </table>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

            <h2 class="text-center mt-5">Logovani korisnici za poslednjih 24h</h2>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Vreme</th>
                    <th>Akcija</th>
                </tr>
                </thead>
                <tbody id="logTabela">
                <?php ispisLogova($conn); ?>
                </tbody>
            </table>

            <div class="container">
                <div class="statistika">
                    <h2 class="text-center mt-5">Statistika posećenosti stranica</h2>
                    <?php
                        require_once ABSOLUTE_PATH . 'models/funkcije/statistika.php';
                    ?>
                </div>
            </div>


            <section id="dodajKorisnika" class="mb-4">
                <h2 class="text-center mt-5 mb-4">Dodaj korisnika</h2>
                <form method="post" action="../funkcije/dodaj_korisnika.php" id="formaDodavanjeKorisnika">
                    <div class="form-group">
                        <label for="APime" class="my-2">Korisničko Ime:</label>
                        <input type="text" class="form-control" id="APime" name="APime"/>
                        <div class="invalid-feedback">Unesite korisničko ime.</div>
                    </div>
                    <div class="form-group">
                        <label for="APemail" class="my-2">Email:</label>
                        <input type="email" class="form-control" id="APemail" name="APemail"/>
                        <div class="invalid-feedback">Unesite validan email.</div>
                    </div>
                    <div class="form-group">
                        <label for="APuloga" class="my-2">Uloga:</label>
                        <select id="APuloga" name="APuloga" class="form-control">
                            <option value="0">Izaberite ulogu</option>
                            <?php
                                $upit = "SELECT * FROM uloge";
                                $rez = $conn->query($upit);
                                if ($rez) {
                                    while ($uloga = $rez->fetch(PDO::FETCH_ASSOC)) {
                                        uloge($uloga['id'], $uloga['uloga']);
                                    }
                                }
                                else {
                                    echo "Greška pri izvršavanju upita.";
                                }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-5 mt-5" id="APdodaj">Dodaj Korisnika</button>
                </form>
                <form method="post" action="../funkcije/brisanje_korisnika.php" id="brisanjeKorisnika">
                    <label for="korisnik_id" id="labelBrisanjeKorisnika">Izaberite korisnika za brisanje:</label>
                    <select name="korisnik_id" id="korisnik_id">
                        <?php
                        $upit = "SELECT id, ime FROM korisnici";
                        $rezultat = $conn->query($upit);
                        while ($red = $rezultat->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $red['id'] . "'>" . $red['ime'] . "</option>";
                        }
                        ?>
                    </select>
                    <button type="submit" id="dugmeBrisanje">Obriši korisnika</button>
                </form>
            </section>


            <section id="listaKorisnika" class="pt-5">
                <h2 class="mt-5 text-center">Lista svih korisnika</h2>
                <div id="tabelaKorisnika">
                </div>
                <div id="paginacija">
                </div>
            </section>
        </main>

    <footer>
        <?php include "../../views/fixed/footer.php" ?>
    </footer>

    <script src="../../assets/jQuery/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../../assets/js/script.js"></script>
</body>
</html>