<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/konekcija.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/models/funkcije/funkcije.php';
//session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require $_SERVER['DOCUMENT_ROOT'] . "/PHP2Sajt/PHPMailer-master/PHPMailer-master/src/Exception.php";
require $_SERVER['DOCUMENT_ROOT'] . "/PHP2Sajt/PHPMailer-master/PHPMailer-master/src/PHPMailer.php";
require $_SERVER['DOCUMENT_ROOT'] . "/PHP2Sajt/PHPMailer-master/PHPMailer-master/src/SMTP.php";

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
        echo json_encode([
            "uspeh" => false,
            "poruka" => 'Greška pri otvaranju fajla.'
        ]);
        exit;
    }
}

function azurirajNeuspelePokusaje($conn, $email, $brojNeuspelihPokusaja) {
    $updateUpit = "UPDATE korisnici SET broj_neuspelih_pokusaja = :broj_neuspelih_pokusaja, poslednji_neuspeo_pokusaj = NOW() WHERE email = :email";
    $stmtUpdate = $conn->prepare($updateUpit);
    $stmtUpdate->bindParam(':broj_neuspelih_pokusaja', $brojNeuspelihPokusaja);
    $stmtUpdate->bindParam(':email', $email);
    $stmtUpdate->execute();
}

function posaljiUpozorenjeEmail($mail, $email) {
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'maricmina2506@gmail.com';
        $mail->Password = 'vcfp raml wqgw krmn';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('no-reply@belatehnikaplus.com', 'No Reply');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Upozorenje!';
        $mail->Body = 'Ukoliko prijava još jednom bude neuspešna Vaš nalog biće zaključan!';

        $mail->send();
    } catch (Exception $e) {
        error_log("Greška pri slanju email-a: " . $mail->ErrorInfo);
        return false;
    }
    return true;
}

function zakljucajNalog($conn, $email) {
    $zakljucajNalogUpit = "UPDATE korisnici SET zakljucan = 1 WHERE email = :email";
    $stmtZakljucaj = $conn->prepare($zakljucajNalogUpit);
    $stmtZakljucaj->bindParam(':email', $email);
    $stmtZakljucaj->execute();
}

function posaljiZakljucavanjeEmail($mail, $email) {
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'maricmina2506@gmail.com';
        $mail->Password = 'vcfp raml wqgw krmn';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('no-reply@belatehnikaplus.com', 'No Reply');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Ovaj nalog je zaključan';
        $mail->Body = 'Nalog je zaključan zbog previše neuspešnih pokušaja prijave. Molimo Vas da kontaktirate podršku za dalje korake.';

        $mail->send();
    } catch (Exception $e) {
        error_log("Greška pri slanju email-a: " . $mail->ErrorInfo);
        return false;
    }
    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['emailLog'] ?? '';
    $sifra = $_POST['sifraLog'] ?? '';
    $currentTime = new DateTime();
    $mail = new PHPMailer(true);

    $odgovor = [
        "uspeh" => false,
        "poruka" => "Došlo je do greške."
    ];

    try {
        $sql = "SELECT id, sifra, aktiviran, broj_neuspelih_pokusaja, poslednji_neuspeo_pokusaj, zakljucan FROM korisnici WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashed_password = $user['sifra'];
            $id = $user['id'];
            $aktiviran = $user['aktiviran'];
            $brojNeuspelihPokusaja = $user['broj_neuspelih_pokusaja'];
            $poslednjiNeuspeoPokusajVreme = $user['poslednji_neuspeo_pokusaj'];
            $zakljucan = $user['zakljucan'];

            if ($zakljucan) {
                $odgovor = [
                    "uspeh" => false,
                    "poruka" => "Vaš nalog je zaključan. Molimo Vas da kontaktirate podršku."
                ];
            } else {
                if (password_verify($sifra, $hashed_password)) {
                    $_SESSION['id'] = $id;
                    $_SESSION['email'] = $email;
                    $_SESSION['loggedin'] = true;

                    logujAktivnost($conn, $id, $email, 'Prijava');
                    upisiLog($id, $email, 'Prijava');

                    $resetPokusajiUpit = "UPDATE korisnici SET broj_neuspelih_pokusaja = 0, poslednji_neuspeo_pokusaj = NULL WHERE email = :email";
                    $stmtReset = $conn->prepare($resetPokusajiUpit);
                    $stmtReset->bindParam(':email', $email);
                    $stmtReset->execute();

                    $updateMeni = "UPDATE meni SET naziv = 'Odjavi se' WHERE id = 3";
                    $stmtUpdateMenu = $conn->prepare($updateMeni);
                    $stmtUpdateMenu->execute();

                    $odgovor = [
                        "uspeh" => true,
                        "poruka" => "Uspešno ste se prijavili!",
                        "redirect" => "http://localhost/PHP2Sajt/index.php"
                    ];
                } else {
                    $odgovor = [
                        "uspeh" => false,
                        "poruka" => "Neispravna šifra."
                    ];

                    $brojNeuspelihPokusaja++;
                    azurirajNeuspelePokusaje($conn, $email, $brojNeuspelihPokusaja);

                    if($brojNeuspelihPokusaja == 2) {
                        posaljiUpozorenjeEmail($mail, $email);
                    }

                    if ($brojNeuspelihPokusaja >= 3) {
                        $poslednjiNeuspeoPokusaj = new DateTime($poslednjiNeuspeoPokusajVreme);
                        $interval = $poslednjiNeuspeoPokusaj->diff($currentTime);
                        $minutesPassed = $interval->i + ($interval->h * 60);

                        if ($minutesPassed <= 5) {
                            zakljucajNalog($conn, $email);
                            posaljiZakljucavanjeEmail($mail, $email);

                            $odgovor = [
                                "uspeh" => false,
                                "poruka" => "Vaš nalog je zaključan. Molimo Vas da kontaktirate podršku."
                            ];
                        }
                    } else {
                        $preostaliPokusaji = 3 - $brojNeuspelihPokusaja;
                        $odgovor['poruka'] = "Neuspešna prijava. Preostali pokušaji: " . $preostaliPokusaji;
                    }
                }
            }
        } else {
            $odgovor = [
                "uspeh" => false,
                "poruka" => "Ne postoji nalog sa ovim emailom."
            ];
        }
    } catch (PDOException $e) {
        $odgovor = [
            "uspeh" => false,
            "poruka" => "Greška u pripremi upita: " . $e->getMessage()
        ];
    }

    $conn = null;

    echo json_encode($odgovor);
}



//
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    $email = $_POST["email"];
//    $sifra = $_POST["sifra"];
//    $currentTime = new DateTime();
//
//    try {
//        $sql = "SELECT id, sifra, aktiviran, broj_neuspelih_pokusaja, poslednji_neuspeo_pokusaj, zakljucan FROM korisnici WHERE email = :email";
//        $stmt = $conn->prepare($sql);
//        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
//        $stmt->execute();
//
//        if ($stmt->rowCount() == 1) {
//            $user = $stmt->fetch(PDO::FETCH_ASSOC);
//            $hes_sifra_baza = $user['sifra'];
//            $aktiviran = $user['aktiviran'];
//            $brojNeuspelihPokusaja = $user['broj_neuspelih_pokusaja'];
//            $poslednjiNeuspeoPokusajVreme = $user['poslednji_neuspeo_pokusaj'];
//            $zakljucan = $user['zakljucan'];
//
//            if ($zakljucan) {
//                $odgovor = [
//                    "uspeh" => false,
//                    "poruka" => "Vaš nalog je zaključan. Molimo Vas da kontaktirate podršku."
//                ];
//            } elseif (password_verify($sifra, $hes_sifra_baza)) {
//                if ($poslednjiNeuspeoPokusajVreme) {
//                    $poslednjiNeuspeoPokusaj = new DateTime($poslednjiNeuspeoPokusajVreme);
//                    $interval = $poslednjiNeuspeoPokusaj->diff($currentTime);
//                    $minutesPassed = $interval->i + ($interval->h * 60);
//
//                    if ($minutesPassed <= 5 && $brojNeuspelihPokusaja >= 2) {
//                        $zakljucajNalogUpit = "UPDATE korisnici SET zakljucan = 1 WHERE email = :email";
//                        $stmtZakljucaj = $conn->prepare($zakljucajNalogUpit);
//                        $stmtZakljucaj->bindParam(':email', $email);
//                        $stmtZakljucaj->execute();
//
//                        $mail = new PHPMailer(true);
//                        try {
//                            $mail->isSMTP();
//                            $mail->Host = 'smtp.gmail.com';
//                            $mail->SMTPAuth = true;
//                            $mail->Username = 'maricmina2506@gmail.com';
//                            $mail->Password = 'vcfp raml wqgw krmn';
//                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//                            $mail->Port = 587;
//
//                            $mail->setFrom('no-reply@belatehnikaplus.com', 'No Reply');
//                            $mail->addAddress($email);
//
//                            $mail->isHTML(true);
//                            $mail->Subject = 'Ovaj nalog je zaključan';
//                            $mail->Body = 'Nalog je zaključan zbog previše neuspešnih pokušaja prijave. Molimo Vas da kontaktirate podršku za dalje korake.';
//
//                            $mail->send();
//                        } catch (Exception $e) {
//                            $odgovor = [
//                                "uspeh" => false,
//                                "poruka" => "Greška pri slanju email-a: " . $mail->ErrorInfo
//                            ];
//                        }
//
//                        $odgovor = [
//                            "uspeh" => false,
//                            "poruka" => "Vaš nalog je zaključan. Molimo Vas da kontaktirate podršku."
//                        ];
//                    } else {
//                        $brojNeuspelihPokusaja++;
//                        $updateUpit = "UPDATE korisnici SET broj_neuspelih_pokusaja = :broj_neuspelih_pokusaja, poslednji_neuspeo_pokusaj = NOW() WHERE email = :email";
//                        $stmtUpdate = $conn->prepare($updateUpit);
//                        $stmtUpdate->bindParam(':broj_neuspelih_pokusaja', $brojNeuspelihPokusaja);
//                        $stmtUpdate->bindParam(':email', $email);
//                        $stmtUpdate->execute();
//
//                        $odgovor = [
//                            "uspeh" => false,
//                            "poruka" => "Neuspešna prijava. Preostali pokušaji: " . (3 - $brojNeuspelihPokusaja)
//                        ];
//                    }
//                } else {
//                    $updateUpit = "UPDATE korisnici SET broj_neuspelih_pokusaja = 1, poslednji_neuspeo_pokusaj = NOW() WHERE email = :email";
//                    $stmtUpdate = $conn->prepare($updateUpit);
//                    $stmtUpdate->bindParam(':email', $email);
//                    $stmtUpdate->execute();
//
//                    $odgovor = [
//                        "uspeh" => false,
//                        "poruka" => "Neuspešna prijava. Preostali pokušaji: " . (3 - 1)
//                    ];
//                }
//            } else {
//                $_SESSION["loggedin"] = true;
//                $_SESSION["id"] = $user['id'];
//                $_SESSION["email"] = $email;
//
//                logujAktivnost($conn, $user['id'], $email, 'Prijava');
//                upisiLog($user['id'], $email, 'Prijava');
//
//                $updateUpit = "UPDATE korisnici SET broj_neuspelih_pokusaja = 0, poslednji_neuspeo_pokusaj = NULL WHERE email = :email";
//                $stmtUpdate = $conn->prepare($updateUpit);
//                $stmtUpdate->bindParam(':email', $email);
//                $stmtUpdate->execute();
//
//                $updateMeni = "UPDATE meni SET naziv = 'Odjavi se' WHERE id = 3";
//                $stmtUpdateMenu = $conn->prepare($updateMeni);
//                $stmtUpdateMenu->execute();
//
//                $odgovor = [
//                    "uspeh" => true,
//                    "poruka" => "Uspešno ste se prijavili!",
//                    "redirect" => "http://localhost/PHP2Sajt/index.php"
//                ];
//            }
//        } else {
//            $odgovor = [
//                "uspeh" => false,
//                "poruka" => "Korisnik sa datim emailom ne postoji."
//            ];
//        }
//    } catch (PDOException $e) {
//        $odgovor = [
//            "uspeh" => false,
//            "poruka" => "Došlo je do greške: " . $e->getMessage()
//        ];
//    }
//
//    header('Content-Type: application/json');
//    echo json_encode($odgovor);
//    exit;
//}
//
//
//
////session_start();
////require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/config.php';
////require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/konekcija.php';
////global $conn;
////
////if ($_SERVER["REQUEST_METHOD"] == "POST") {
////    $email = $_POST['email'];
////    $sifra = $_POST['sifra'];
////
////    try {
////        $sql = "SELECT id, sifra, aktiviran FROM korisnici WHERE email = :email";
////        $stmt = $conn->prepare($sql);
////        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
////        $stmt->execute();
////
////        if ($stmt->rowCount() == 1) {
////            $user = $stmt->fetch(PDO::FETCH_ASSOC);
////            $hes_sifra_baza = $user['sifra'];
////            $aktiviran = $user['aktiviran'];
////
////            if (!password_verify($sifra, $hes_sifra_baza)) {
////                if ($aktiviran) {
////                    $_SESSION["loggedin"] = true;
////                    $_SESSION["id"] = $user['id'];
////                    $_SESSION["email"] = $email;
////
////                    $odgovor = [
////                        "uspeh" => true,
////                        "poruka" => "Uspešno ste se prijavili!",
////                        "redirect" => "http://localhost/PHP2Sajt/index.php"
////                    ];
////                } else {
////                    $odgovor = ["uspeh" => false, "poruka" => "Vaš nalog nije aktiviran. Molimo vas da aktivirate nalog."];
////                }
////            } else {
////                $odgovor = ["uspeh" => false, "poruka" => "Pogrešna šifra."];
////            }
////        } else {
////            $odgovor = ["uspeh" => false, "poruka" => "Ne postoji korisnik sa unetim email-om."];
////        }
////    } catch (PDOException $e) {
////        $odgovor = ["uspeh" => false, "poruka" => "Došlo je do greške: " . $e->getMessage()];
////    }
////
////    header('Content-Type: application/json');
////    echo json_encode($odgovor);
////    exit;
////} else {
////    $odgovor = ["uspeh" => false, "poruka" => "Došlo je do greške. Metod nije POST."];
////    header('Content-Type: application/json');
////    echo json_encode($odgovor);
////    exit;
////}
