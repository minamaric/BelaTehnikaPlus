<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/konekcija.php';
global $conn;

$id = $_POST['korisnik_id'];

try {
    // Pripremanje izjave
    $sql = "DELETE FROM korisnici WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Izvršavanje izjave
    if ($stmt->execute()) {
        echo "Korisnik je uspešno obrisan.";
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "Greška pri brisanju korisnika: " . $errorInfo[2];
    }
} catch (PDOException $e) {
    echo "Greška: " . $e->getMessage();
}

// Preusmeravanje na admin panel
header("Location: http://localhost/PHP2Sajt/models/admin/admin_panel.php");
exit();
