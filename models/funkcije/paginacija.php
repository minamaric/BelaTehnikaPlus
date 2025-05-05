<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/config.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/config/konekcija.php';
    global $conn;

    $korisniciPoStrani = 5;
    $trenutnaStrana = isset($_GET['strana']) ? (int)$_GET['strana'] : 1;
    $offset = ($trenutnaStrana - 1) * $korisniciPoStrani;

    $upitBroj = "SELECT COUNT(*) as ukupno FROM korisnici";
    $stmtBroj = $conn->query($upitBroj);
    $ukupnoKorisnika = $stmtBroj->fetch(PDO::FETCH_ASSOC)['ukupno'];

    $ukupnoStranica = ceil($ukupnoKorisnika / $korisniciPoStrani);

    $upit = "SELECT * FROM korisnici LIMIT :limit OFFSET :offset";
    $stmt = $conn->prepare($upit);
    $stmt->bindValue(':limit', $korisniciPoStrani, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $korisnici = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $tabela = "<table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Korisničko Ime</th>
                <th>Email</th>
                <th>Uloga</th>
            </tr>
        </thead>
        <tbody>";
    foreach ($korisnici as $korisnik) {
        $tabela .= "<tr>
            <td>" . htmlspecialchars($korisnik['id']) . "</td>
            <td>" . htmlspecialchars($korisnik['ime']) . "</td>
            <td>" . htmlspecialchars($korisnik['email']) . "</td>
            <td>" . ($korisnik['email'] == "maricmina2506@gmail.com" ? "Admin" : "Korisnik") . "</td>
        </tr>";
    }
    $tabela .= "</tbody></table>";

    $paginacija = "<nav><ul class='paginacija'>";
    for ($i = 1; $i <= $ukupnoStranica; $i++) {
        $paginacija .= "<li class='page-item paginacijaLink'><a class='page-link' href='#listaKorisnika' data-strana='$i'>$i</a></li>";
    }
    $paginacija .= "</ul></nav>";

    echo json_encode([
        'tabela' => $tabela,
        'paginacija' => $paginacija
    ]);
?>
