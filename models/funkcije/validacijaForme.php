<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/konekcija.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/models/funkcije/funkcije.php';
require "../../PHPMailer-master/PHPMailer-master/src/Exception.php";
require "../../PHPMailer-master/PHPMailer-master/src/PHPMailer.php";
require "../../PHPMailer-master/PHPMailer-master/src/SMTP.php";

//session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

global $conn;

$logFile = $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/data/logovi.txt';
function upisiLog($user_id, $email, $aktivnost) {
    global $logFile;
    $timestamp = date('Y-m-d H:i:s');
    $logEntry = "$timestamp\t$user_id\t$email\t$aktivnost\n";

    $fileHandle = fopen($logFile, 'a');

    if ($fileHandle) {
        fwrite($fileHandle, $logEntry);
        fclose($fileHandle);
    } else {
        echo 'Greška pri otvaranju fajla.';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ime = $_POST["ime"];
    $email = $_POST["email"];
    $sifra = $_POST["sifra"];
    $hes_sifra = password_hash($sifra, PASSWORD_DEFAULT);
    $adresa = $_POST["adresa"];
    $isporuka = $_POST["vrstaIsporuke"];
    $pol = $_POST["pol"];
    $uloga = 1;

    $imeRegEx = "/^[A-Z][a-z]{2,}(\s[A-Z][a-z]{2,})*$/";
    $sifraRegEx = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[.!@#$%^&*])[A-Za-z\d.!@#$%^&*]{8,}$/";
    $adresaRegEx = "/^(\d{1,5})?\s*([a-zA-ZćčžšđĆČŽŠĐ]+\s*)+\d{0,5}(\s*[,.\-]?\s*[a-zA-ZćčžšđĆČŽŠĐ]+\s*\d{0,5})*$/";

    $greske = [];

    if (!preg_match($imeRegEx, $ime)) {
        $greske[] = "Ime i prezime moraju početi velikim slovom i sadržati barem 3 karaktera!";
    }

    if (!preg_match($sifraRegEx, $sifra)) {
        $greske[] = "Šifra mora sadržati najmanje 8 karaktera, od kojih bar jedno veliko slovo, jedno malo slovo i jedan broj!";
    }

    if (!preg_match($adresaRegEx, $adresa)) {
        $greske[] = "Adresa nije u ispravnom formatu!";
    }

    if (empty($isporuka)) {
        $greske[] = "Odaberite vrstu isporuke!";
    }

    if (empty($pol)) {
        $greske[] = "Odaberite pol!";
    }

    if (!empty($greske)) {
        $odgovor = [
            "uspeh" => false,
            "poruke" => $greske
        ];
    } else {
        try {
            $proveraUpit = "SELECT id FROM korisnici WHERE email = :email";
            $stmt = $conn->prepare($proveraUpit);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $odgovor = [
                    "uspeh" => false,
                    "poruke" => ["Email već postoji."]
                ];
            } else {
                if ($email == "maricmina2506@gmail.com") {
                    $uloga = 2;
                }

                $aktivacijaKod = md5(uniqid($email, true));

                $upit = "INSERT INTO korisnici (`ime`, `email`, `sifra`, `adresa`, `vrsta_isporuke`, `pol`, `uloga`, `aktiviran`, `broj_neuspelih_pokusaja`, `poslednji_neuspeo_pokusaj`, `zakljucan`, `aktivacija_kod`) 
                         VALUES (:ime, :email, :hes_sifra, :adresa, :vrsta_isporuke, :pol, :uloga, 0, 0, NULL, 0, :aktivacija_kod)";

                $stmt = $conn->prepare($upit);
                $stmt->bindParam(':ime', $ime);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(":hes_sifra", $hes_sifra);
                $stmt->bindParam(':adresa', $adresa);
                $stmt->bindParam(':vrsta_isporuke', $isporuka);
                $stmt->bindParam(':pol', $pol);
                $stmt->bindParam(':uloga', $uloga);
                $stmt->bindParam(':aktivacija_kod', $aktivacijaKod);

                $stmt->execute();

                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $conn->lastInsertId();
                $_SESSION["email"] = $email;
                $_SESSION["ime"] = $ime;
                $_SESSION["sifraHes"] = $hes_sifra;

                logujAktivnost($conn, $_SESSION["id"], $email, 'Registracija');
                upisiLog($_SESSION["id"], $email, 'Registracija');

                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'maricmina2506@gmail.com';
                    $mail->Password = 'vcfp raml wqgw krmn';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587; // Port za SMTP

                    $mail->setFrom('maricmina2506@gmail.com', 'No Reply');
                    $mail->addAddress($email);

                    $mail->isHTML(true);
                    $mail->Subject = 'Aktivacija naloga';
                    $mail->Body    = 'Poštovani, kliknite na sledeći link kako biste aktivirali vaš nalog: <a href="http://localhost/PHP2Sajt/models/funkcije/aktivacija.php?kod=' . $aktivacijaKod . '">Aktiviraj nalog</a>';

                    $mail->send();

                    if (!empty($greske)) {
                        $odgovor = [
                            "uspeh" => false,
                            "poruke" => $greske
                        ];
                        error_log("Greške: " . json_encode($greske));
                    } else {
                        // ...
                        try {
                            // ...
                        } catch (Exception $e) {
                            $odgovor = [
                                "uspeh" => false,
                                "poruka" => "Poruka nije mogla biti poslata. Greška: {$mail->ErrorInfo}"
                            ];
                            error_log("Greška u slanju maila: " . $mail->ErrorInfo);
                        }
                    }


                    $odgovor = [
                        "uspeh" => true,
                        "poruka" => "Uspešno ste se registrovali!",
                        "redirect" => "http://localhost/PHP2Sajt/index.php"
                    ];

                    $updateUpit = "UPDATE meni SET naziv = 'Odjavite se', putanja = 'http://localhost/PHP2Sajt/models/funkcije/odjava.php' WHERE id = 3";
                    $stmtUpdate = $conn->prepare($updateUpit);
                    $stmtUpdate->execute();
                } catch (Exception $e) {
                    $odgovor = [
                        "uspeh" => false,
                        "poruka" => "Poruka nije mogla biti poslata. Greška: {$mail->ErrorInfo}"
                    ];
                }
            }
        } catch (PDOException $ex) {
            $odgovor = [
                "uspeh" => false,
                "poruka" => "Došlo je do greške prilikom registracije: " . $ex->getMessage()
            ];
        }
    }

    header("Content-type: application/json");
    echo json_encode($odgovor);
    exit;
}
