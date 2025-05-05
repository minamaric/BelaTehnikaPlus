<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/konekcija.php';
global $conn;

if (isset($_GET['kod'])) {
    $aktivacijaKod = $_GET['kod'];

    try {
        $proveraUpit = "SELECT id FROM korisnici WHERE aktivacija_kod = :aktivacija_kod";
        $stmt = $conn->prepare($proveraUpit);
        $stmt->bindParam(':aktivacija_kod', $aktivacijaKod);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $upit = "UPDATE korisnici SET aktiviran = 1, aktivacija_kod = NULL WHERE aktivacija_kod = :aktivacija_kod";
            $stmt = $conn->prepare($upit);
            $stmt->bindParam(':aktivacija_kod', $aktivacijaKod);
            $stmt->execute();

            $poruka = "Vaš nalog je uspešno aktiviran!";
        } else {
            $poruka = "Nevažeći aktivacioni kod!";
        }
    } catch (PDOException $ex) {
        $poruka = "Došlo je do greške prilikom aktivacije naloga: " . $ex->getMessage();
    }
} else {
    $poruka = "Nema aktivacionog koda u URL-u!";
}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Aktivacija naloga</title>
</head>
<body>
<h1><?php echo $poruka; ?></h1>
<p><a href="http://localhost/PHP2Sajt/index.php">Povratak na početnu stranicu</a></p>
</body>
</html>
