<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/config.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/konekcija.php';
    global $conn;
    session_start();
    function ispisMeni($stavka)
    {
        $brojID = 1;

        while ($red = $stavka->fetch(PDO::FETCH_ASSOC)) {
            if ($brojID == 3) {
                echo "<li class='mx-4 py-2'><a href='" . $red["putanja"] . "' id='prijavaOdjava'>" . $red["naziv"] . "</a></li>";
            } else {
                echo "<li class='mx-4 py-2'><a href='" . $red["putanja"] . "'>" . $red["naziv"] . "</a></li>";
            }
            $brojID++;
        }

        if (isset($_SESSION["email"]) && $_SESSION["email"] == "maricmina2506@gmail.com") {
            echo "<li class='mx-4 py-2'><a href='http://localhost/PHP2Sajt/models/admin/admin_panel.php'>Admin Panel</a></li>";
            //echo "<li class='mx-4 py-2'><a href='http://localhost/PHP2Sajt/views/admin.php'>Posete</a></li>";
        }
        if (isset($_SESSION["loggedin"])) {
            echo "<li class='mx-4 py-2'><a href='http://localhost/PHP2Sajt/views/korpa.php'>Korpa</a></li>";
        }
    }




function slika($slika) {
        echo "<img src='" . $slika["putanja"] . "' alt='" . $slika["alt"] . "' class='slikaRez'/>";
    }
    function ponuda($x) {
        $prvaSlikaPreskocena = false;

        foreach ($x as $index => $slika) {
            if (!$prvaSlikaPreskocena) {
                $prvaSlikaPreskocena = true;
                continue;
            }
            if($index == 5) continue;

            echo '<div class="col mt-5 col-md-6 col-lg-3 pt-3">';
            echo '<a href="http://localhost/PHP2Sajt/views/prodavnica.php">';
            echo '<h3 class="text-center mb-5">' . $slika["naziv"] . '</h3> <hr/>';
            echo '<img src="' . $slika["putanja"] . '" alt="' . $slika["alt"] . '" width="200px" class="slike_ponuda"/>';
            echo '</a>';
            echo '</div>';
        }
    }
    function ikonica($ikonica) {
        foreach ($ikonica as $i) {
            echo "<div class='col-4'>
                    <h3 class='text-center mb-5'>" . $i["naziv"] . "</h3>" . $i["tag"] . "
                  </div>";
        }
    }
    function ispisProizvoda($proizvodi) {
        foreach ($proizvodi as $p) {
            echo '<div class="col-xl-2 shop-items m-5">
                            <div class="slikaDiv">
                                <img src="' . $p["slika"] . '" alt="' . $p["naziv"] . '" class="slike_ponuda shop-item-image" />
                            </div>
                            <div class="tekstProizvoda">
                                <h6 class="text-center shop-item-title">' . $p["naziv"] . '</h6>
                                <p>Cena: ' . $p["cena"] . ' RSD</p>
                                <input type="button" class="dugme_opis" value="Detaljnije" />
                                <div class="detaljan_opis hidden detaljanProzor" id="detaljanProzor">
                                    <div class="col-xl-2 shop-items mx-5">
                                    <h6 class="text-center shop-item-title mt-5">' . $p["naziv"] . '</h6>
                                        <div class="slikaDiv">
                                             <img src="' . $p["slika"] . '" alt="' . $p["naziv"] . '" class="slike_ponuda shop-item-image" />
                                        </div>
                                        <div class="tekstProizvoda" id="tekstProizvoda2">
                                            <h6 class="mb-5">Cena: ' . $p["cena"] . ' RSD</h6>
                                            <p>' . $p["opis"] . '</p>
                                        </div>
                                        <button class="btn btn-primary shop-item-button mt-2 zatvori">Zatvori</button>
                                    </div>
                                </div>
                            </div>
                            <form method="post" action="prodavnica.php">
                                <input type="hidden" name="product_id" value="' . $p["id"] . '">
                                <button type="submit" class="btn btn-primary shop-item-button mt-2 dodaj_u_korpu">Dodaj u korpu</button>
                            </form>
                        </div>';
        }
    }

    function ispisKategorije($proizvod) {
        $i = 1;
        foreach($proizvod as $p) {
            echo '<option value="' . $i . '">' . $p["vrsta"] . '</option>';
            $i++;
        }
    }


    //FILTRIRANJE I SORTIRANJE
    if (isset($_GET['action']) && $_GET['action'] == 'sortirajIFiltrirajProizvode') {

        $tip = $_GET['tip'];
        $kategorija = $_GET['kategorija'];

        if ($kategorija === "0") {
            $upit = "SELECT * FROM proizvodi";
        } else {
            $upit = "SELECT * FROM proizvodi WHERE vrsta_proizvoda_id = ?";
        }

        switch ($tip) {
            case 'nazivAsc':
                $upit .= " ORDER BY naziv ASC";
                break;
            case 'nazivDesc':
                $upit .= " ORDER BY naziv DESC";
                break;
            case 'cenaAsc':
                $upit .= " ORDER BY cena ASC";
                break;
            case 'cenaDesc':
                $upit .= " ORDER BY cena DESC";
                break;
        }

        $stmt = $conn->prepare($upit);
        if ($kategorija !== "0") {
            $stmt->execute([$kategorija]);
        } else {
            $stmt->execute();
        }
        $podaci = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ispisProizvoda($podaci);
    }

    //PRETRAGA
    if (isset($_GET['action']) && $_GET['action'] == 'pretraziProizvode') {
        $pretraga = '%' . $_GET['pretraga'] . '%';
        $tip = $_GET['tip'];
        $kategorija = $_GET['kategorija'];

        if ($kategorija === "0") {
            $upit = "SELECT * FROM proizvodi WHERE naziv LIKE ?";
        } else {
            $upit = "SELECT * FROM proizvodi WHERE vrsta_proizvoda_id = ? AND naziv LIKE ?";
        }

        switch ($tip) {
            case 'nazivAsc':
                $upit .= " ORDER BY naziv ASC";
                break;
            case 'nazivDesc':
                $upit .= " ORDER BY naziv DESC";
                break;
            case 'cenaAsc':
                $upit .= " ORDER BY cena ASC";
                break;
            case 'cenaDesc':
                $upit .= " ORDER BY cena DESC";
                break;
        }

        $stmt = $conn->prepare($upit);
        if ($kategorija !== "0") {
            $stmt->execute([$kategorija, $pretraga]);
        } else {
            $stmt->execute([$pretraga]);
        }
        $podaci = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ispisProizvoda($podaci);
    }

    function uloge($uloga_id, $naziv_uloge) {
        echo "<option value='" . htmlspecialchars($uloga_id) . "'>" . htmlspecialchars($naziv_uloge) . "</option>";
    }

function logujAktivnost($conn, $user_id, $email, $aktivnost) {
    try {
        $timestamp = date('Y-m-d H:i:s');
        $upit = "INSERT INTO logovi (user_id, email, aktivnost, vreme) VALUES (:user_id, :email, :aktivnost, :vreme)";
        $stmt = $conn->prepare($upit);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':aktivnost', $aktivnost);
        $stmt->bindParam(':vreme', $timestamp);
        $stmt->execute();
    } catch (PDOException $e) {
        error_log("Greška pri logovanju aktivnosti: " . $e->getMessage());
    }
}