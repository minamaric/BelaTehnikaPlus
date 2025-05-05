<?php
$statistikaFile = $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/data/statistika.txt';

if (file_exists($statistikaFile)) {
    $file = fopen($statistikaFile, 'r');
    $data = [];
    while (($line = fgets($file)) !== false) {
        list($date, $page) = explode(' ', trim($line), 2);
        $data[$page][] = $date;
    }
    fclose($file);

    $totalVisits = array_sum(array_map('count', $data));
    if ($totalVisits > 0) {
        echo '<table>';
        echo '<thead><tr><th>Stranica</th><th>Posete</th><th>Procenat</th></tr></thead>';
        echo '<tbody>';

        foreach ($data as $page => $visits) {
            $visitCount = count($visits);
            $percentage = ($visitCount / $totalVisits) * 100;
            echo "<tr><td>" . htmlspecialchars($page) . "</td><td>$visitCount</td><td>" . number_format($percentage, 2) . "%</td></tr>";
        }

        echo '</tbody></table>';
    } else {
        echo '<p class="text-center">Nema dostupnih podataka.</p>';
    }
} else {
    echo 'Statistika nije dostupna.';
}
