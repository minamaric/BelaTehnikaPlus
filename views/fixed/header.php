<?php
    require_once ABSOLUTE_PATH . '/config/config.php';
    require_once ABSOLUTE_PATH . '/config/konekcija.php';
    require_once ABSOLUTE_PATH . '/models/funkcije/funkcije.php';
    global $conn;
?>
<div class="bg-light container-fluid">
    <header class="d-flex justify-content-around align-items-center py-3">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="meni">
                    <a id="logo" href="http://localhost/PHP2Sajt/index.php"><li>BelaTehnikaPlus</li></a>
                    <?php
                    $upit = "SELECT * FROM meni";
                    $rezultat = $conn->query($upit);
                    ispisMeni($rezultat);
                    ?>
                </div>
            </div>
        </nav>
    </header>
</div>
