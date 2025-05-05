<?php
include '../config/config.php';
include '../config/konekcija.php';
include ABSOLUTE_PATH . 'models/funkcije/statistikaLogika.php';
global $conn;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Korpa - BelaTehnikaPlus</title>
    <?php include "fixed/head.php" ?>
    <link rel="shortcut icon" href="../assets/img/ikonica.png" />
</head>
<body>
<?php include "../views/fixed/header.php" ?>
<?php
if (!empty($_SESSION['cart'])) {
    $productIds = array_keys($_SESSION['cart']);
    $ids = implode(',', array_fill(0, count($productIds), '?'));

    $query = "SELECT * FROM proizvodi WHERE id IN ($ids)";
    $stmt = $conn->prepare($query);
    $stmt->execute($productIds);

    echo "<h1 class='text-center fw-bold pt-5'>Vaša <span style='color: #e13142'>Korpa</span></h1>";
    echo "<table>";
    echo "<tr><th>Naziv</th><th>Količina</th><th>Cena</th><th>Ukupno</th><th>Akcija</th></tr>";

    $total = 0;

    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
        $quantity = $_SESSION['cart'][$row->id];
        $price = $row->cena;
        $subtotal = $quantity * $price;
        $total += $subtotal;

        echo "<tr>";
        echo "<td>" . htmlspecialchars($row->naziv) . "</td>";
        echo "<td>" . htmlspecialchars($quantity) . "</td>";
        echo "<td>" . htmlspecialchars($price) . " RSD</td>";
        echo "<td>" . htmlspecialchars($subtotal) . " RSD</td>";
        echo '<td><form method="post" action="../models/funkcije/ukloni_iz_korpe.php"><input type="hidden" name="product_id" value="' . htmlspecialchars($row->id) . '"><button type="submit" name="ukloni_iz_korpe" class="ukloni">Ukloni</button></form></td>';
        echo "</tr>";
    }

    echo "<tr><td colspan='3'>Ukupno</td><td>" . htmlspecialchars($total) . " RSD</td><td></td></tr>";
    echo "</table>";

    if (isset($_SESSION['success_message'])) {
        echo '<div class="alert alert-success text-center" role="alert" id="korpaPoruka">' . $_SESSION['success_message'] . '</div>';
        unset($_SESSION['success_message']);
    }
    if (!empty($_SESSION['cart'])) {
        echo "<div id='kupovinaForma' class='mb-5'>";
        echo "<h2 class='text-center fw-bold pt-5'>Završetak <span style='color: #e13142'>kupovine</span></h2>";
        echo '<form method="post" action="../models/funkcije/zavrsi_kupovinu.php">';
        echo '<div class="form-group">';
        echo '<label for="adresa">Adresa za dostavu:</label>';
        echo '<input type="text" class="form-control" name="adresa" id="adresa" required>';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label for="vrstaIsporuke">Vrsta isporuke:</label>';
        echo '<select class="form-control" name="vrstaIsporuke" id="vrstaIsporuke" required>';
        echo '<option value="standardna">Standardna</option>';
        echo '<option value="brza">Brza</option>';
        echo '</select>';
        echo '</div>';
        echo '<button type="submit" class="btn btn-primary">Završi kupovinu</button>';
        echo '</form>';
        echo '</div>';
    }
} else {
    echo "<p>Vaša korpa je prazna.</p>";
}

?>

<footer class="mt-5">
    <?php include "fixed/footer.php" ?>
</footer>
</body>
</html>
