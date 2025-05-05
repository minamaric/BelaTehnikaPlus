<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/konekcija.php';
global $conn;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Pronalazi proizvod
    $stmt = $conn->prepare("SELECT * FROM proizvodi WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $proizvod = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($proizvod) {
        // Brisanje zavisnih podataka iz tabele narudzbine_proizvodi
        $sql = "DELETE FROM narudzbine_proizvodi WHERE proizvod_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $sql = "DELETE FROM snizenje_proizvoda WHERE proizvod_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Brisanje slike iz foldera
        $slikaPath = "uploads/" . $proizvod['slika'];
        if (file_exists($slikaPath)) {
            unlink($slikaPath);
        }

        // Brisanje proizvoda iz baze
        $sql = "DELETE FROM proizvodi WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);

        // Provera da li je upit uspešan
        if ($stmt->execute()) {
            echo "Proizvod je uspešno obrisan.";
        } else {
            echo "Greška prilikom brisanja proizvoda.";
        }
    } else {
        echo "Proizvod nije pronađen.";
    }
}
