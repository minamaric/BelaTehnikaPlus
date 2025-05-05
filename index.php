<?php
    require_once 'config/konekcija.php';

    include "views/fixed/head.php";
    include "views/fixed/header.php";

    if(!isset($_GET['page'])) {
        include "views/pocetna.php";
    }
    else {
        switch ($_GET['page']) {
            case 'prodavnica.php':
                include "views/prodavnica.php";
                break;
            case 'korpa.php':
                include "views/korpa.php";
                break;
            case 'prijavi_se.php':
                include "views/prijavi_se.php";
                break;
            case "kontakt.php":
                include "views/kontakt.php";
                break;
            case 'autor.php':
                include "views/autor.php";
                break;
            default:
                include "views/fixed/404.php";
                break;
        }
    }

?>