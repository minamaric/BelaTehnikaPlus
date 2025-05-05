<?php
$logFile = 'data/statistika.txt';
$today = date('Y-m-d');

if (file_exists($logFile)) {
    $logovi = file_get_contents($logFile);
    echo nl2br(htmlspecialchars($logovi));
} else {
    echo 'Nema logova za tekući dan.';
}

