<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/konekcija.php';
global $conn;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naziv = $_POST['naziv'];
    $opis = $_POST['opis'];
    $cena = $_POST['cena'];

    $slika = $_FILES['slika'];
    $imeSlike = time() . "_" . basename($slika['name']);
    $targetDir = "../../assets/img/";
    $targetFilePath = $targetDir . $imeSlike;

    if (move_uploaded_file($slika['tmp_name'], $targetFilePath)) {
        $sql = "INSERT INTO proizvodi (naziv, opis, cena, slika) VALUES (:naziv, :opis, :cena, :slika)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':naziv', $naziv);
        $stmt->bindParam(':opis', $opis);
        $stmt->bindParam(':cena', $cena);
        $stmt->bindParam(':slika', $imeSlike);

        if ($stmt->execute()) {
            echo "Proizvod je uspešno dodat.";
        } else {
            echo "Greška prilikom dodavanja proizvoda.";
        }
    } else {
        echo "Greška prilikom učitavanja slike.";
    }
}
