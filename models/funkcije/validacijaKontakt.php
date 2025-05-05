<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/konekcija.php';
global $conn;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imeKorisnika = $_POST["imeK"];
    $emailKorisnika = $_POST["emailK"];
    $poruka = $_POST["poruka"];

    $imeRegEx = "/^[A-Z][a-z]{2,}(\s[A-Z][a-z]{2,})*$/";
    $emailKorisnikaRegEx = "/^[a-zA-Z0-9._%+-]+@(gmail\.com|ict\.edu\.rs|yahoo\.com)$/";

    $greske = [];

    if (!preg_match($imeRegEx, $imeKorisnika)) {
        $greske[] = "Ime i prezime moraju početi velikim slovom i sadržati barem 3 karaktera!";
    }

    if (!preg_match($emailKorisnikaRegEx, $emailKorisnika)) {
        $greske[] = "Email nije u ispravnom formatu!";
    }

    if (empty($poruka)) {
        $greske[] = "Poruka je obavezna!";
    }

    if (!empty($greske)) {
        $odgovor = [
            "uspeh" => false,
            "poruke" => $greske
        ];
    } else {
        try {
            $upit = "INSERT INTO kontakt (imeKorisnika, emailKorisnika, poruka) VALUES (:imeKorisnika, :emailKorisnika, :poruka)";
            $stmt = $conn->prepare($upit);

            $stmt->bindParam(':imeKorisnika', $imeKorisnika);
            $stmt->bindParam(':emailKorisnika', $emailKorisnika);
            $stmt->bindParam(":poruka", $poruka);

            $stmt->execute();

            $odgovor = [
                "uspeh" => true,
                "poruka" => "Uspešno ste nas kontaktirali!"
            ];

            $updateUpit = "UPDATE meni SET naziv = 'Odjavite se', putanja = 'odjava.php' WHERE id = 3";
            $stmtUpdate = $conn->prepare($updateUpit);
            $stmtUpdate->execute();
        } catch (PDOException $ex) {
            $odgovor = [
                "uspeh" => false,
                "poruka" => "Došlo je do greške prilikom komunikacije."
            ];
        }
    }

    header("Content-type: application/json");
    echo json_encode($odgovor);
    exit;
}
