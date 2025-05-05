<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/konekcija.php';
global $conn;

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    $user_id = $_SESSION['user_id'];
    $user_email = $_SESSION['user_email'];
    logujAktivnost($conn, $user_id, $user_email, 'Odjava');
}

$_SESSION = array();
session_destroy();

try {
    $updateUpit = "UPDATE meni SET naziv = 'Prijavite se', putanja = 'http://localhost/PHP2Sajt/views/prijavi_se.php' WHERE id = 3";
    $stmtUpdate = $conn->prepare($updateUpit);
    $stmtUpdate->execute();
} catch (PDOException $e) {
    echo json_encode(["uspeh" => false, "poruka" => "Došlo je do greške pri ažuriranju baze podataka: " . $e->getMessage()]);
    exit;
}

header("Location: http://localhost/PHP2Sajt/index.php");
exit();
