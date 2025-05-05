<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/konekcija.php';
global $conn;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['id'];
    $adresa = $_POST['adresa'];
    $vrstaIsporuke = $_POST['vrstaIsporuke'];
    $proizvodi = $_SESSION['cart'];
    $ukupanIznos = 0;

    foreach ($proizvodi as $productId => $quantity) {
        $query = "SELECT cena FROM proizvodi WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$productId]);
        $product = $stmt->fetch(PDO::FETCH_OBJ);

        if ($product) {
            $ukupanIznos += $product->cena * $quantity;
        }
    }

    try {
        $conn->beginTransaction();

        $upitNarudzbina = "INSERT INTO narudzbine (user_id, ukupan_iznos, adresa, vrsta_isporuke, datum) VALUES (:user_id, :ukupan_iznos, :adresa, :vrsta_isporuke, NOW())";
        $stmtNarudzbina = $conn->prepare($upitNarudzbina);
        $stmtNarudzbina->bindParam(':user_id', $user_id);
        $stmtNarudzbina->bindParam(':ukupan_iznos', $ukupanIznos);
        $stmtNarudzbina->bindParam(':adresa', $adresa);
        $stmtNarudzbina->bindParam(':vrsta_isporuke', $vrstaIsporuke);
        $stmtNarudzbina->execute();

        $narudzbina_id = $conn->lastInsertId();

        $upitProizvodi = "INSERT INTO narudzbine_proizvodi (narudzbina_id, proizvod_id, kolicina, cena) VALUES (:narudzbina_id, :proizvod_id, :kolicina, :cena)";
        $stmtProizvodi = $conn->prepare($upitProizvodi);

        foreach ($proizvodi as $productId => $quantity) {
            $stmtProizvodi->bindParam(':narudzbina_id', $narudzbina_id);
            $stmtProizvodi->bindParam(':proizvod_id', $productId);
            $stmtProizvodi->bindParam(':kolicina', $quantity);
            $stmtProizvodi->bindParam(':cena', $product->cena);
            $stmtProizvodi->execute();
        }

        $conn->commit();

        $_SESSION['success_message'] = "Uspešno ste završili kupovinu!";
        unset($_SESSION['cart']);

        header('Location: ../../views/korpa.php');
        exit();

    } catch (PDOException $ex) {
        $conn->rollBack();
        $_SESSION['success_message'] = "Došlo je do greške prilikom završavanja kupovine: " . $ex->getMessage();

        header('Location: ../../views/korpa.php');
        exit();
    }
}
