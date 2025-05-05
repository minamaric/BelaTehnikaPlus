<?php
session_start();

if (isset($_POST['ukloni_iz_korpe'])) {
    $productId = $_POST['product_id'];

    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
        $_SESSION['success_message'] = "Proizvod je uspešno uklonjen iz korpe.";

        if (empty($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
    }

    header('Location: ../../views/korpa.php');
    exit();
}
