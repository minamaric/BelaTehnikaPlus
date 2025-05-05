<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/konekcija.php';
global $conn;

$korisnicko_ime = $_POST['APime'];
$email = $_POST['APemail'];
$uloga = $_POST['APuloga'];

try {
    // Pripremljena izjava
    $sql = "INSERT INTO korisnici (ime, email, uloga) VALUES (:ime, :email, :uloga)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':ime', $korisnicko_ime, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':uloga', $uloga, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "Novi korisnik je uspešno dodat.";
    } else {
        echo "Greška: " . $sql . "<br>" . $conn->error;
    }
} catch (PDOException $e) {
    echo "Greška: " . $e->getMessage();
}

// Zatvaranje konekcije
$conn = null;

header("Location: http://localhost/PHP2Sajt/models/admin/admin_panel.php");
exit();
