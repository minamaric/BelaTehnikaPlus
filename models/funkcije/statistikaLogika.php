<?php
$statistikaFile = $_SERVER['DOCUMENT_ROOT'] . '/PHP2Sajt/data/statistika.txt';
$currentPage = basename($_SERVER['SCRIPT_NAME']);
$currentDate = date('Y-m-d');

$data = [];
if (file_exists($statistikaFile)) {
    $file = fopen($statistikaFile, 'r');
    while (($line = fgets($file)) !== false) {
        list($date, $page) = explode(' ', trim($line), 2);
        $data[$page][] = $date;
    }
    fclose($file);
}

$data[$currentPage][] = $currentDate;

$file = fopen($statistikaFile, 'w');
if ($file) {
    foreach ($data as $page => $visits) {
        foreach ($visits as $visitDate) {
            $line = $visitDate . ' ' . $page . PHP_EOL;
            fwrite($file, $line);
        }
    }
    fclose($file);
}
