<?php
require_once "config.php";

pristupStranici();

try {
    $conn = new PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE . ";charset=utf8", USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    echo $ex->getMessage();
}

function pristupStranici() {
    $open = fopen(LOG_FAJL, "a");
    if ($open) {
        $logEntry = date('Y-m-d H:i:s') . "\t{$_SERVER['PHP_SELF']}\t{$_SERVER['REMOTE_ADDR']}\n";
        fwrite($open, $logEntry);
        fclose($open);
    }
}