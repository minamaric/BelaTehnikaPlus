<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/konekcija.php';
global $conn;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $greske = [];

    if(empty($email)) {
        $greske = 'Email mora biti popunjen!';
    }

    if (!empty($greske)) {
        $odgovor = [
            "uspeh" => false,
            "poruke" => $greske
        ];
    } else {
        try {
            $upit = "INSERT INTO prijavaNovosti (`email`) VALUES (:email)";
            $stmt = $conn->prepare($upit);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $odgovor = [
                "uspeh" => true,
                "poruka" => "Uspešno ste se prijavili za novosti!"
            ];
        }
        catch (Exception $e) {
            $odgovor = [
                "uspeh" => false,
                "poruka" => "Došlo je do greške prilikom unosa u bazu."
            ];
        }
    }

    header("Content-type: application/json");
    echo json_encode($odgovor);
    exit;
}


