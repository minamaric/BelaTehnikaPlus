<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


define("BASE_URL", "http://127.0.0.1/PHP2Sajt/");
define("ABSOLUTE_PATH", $_SERVER["DOCUMENT_ROOT"] . "/PHP2Sajt/");

define("ENV_FAJL", ABSOLUTE_PATH."/config/.env");
define("LOG_FAJL", ABSOLUTE_PATH."/data/log.txt");
define("ADRESAR", ABSOLUTE_PATH."/data/adresar.txt");
define("SEPARATOR", "&");

define("SERVER", env("SERVER"));
define("DATABASE", env("DBNAME"));
define("USERNAME", env("USERNAME"));
define("PASSWORD", env("PASSWORD"));

function env($naziv) {
    $vrednost = "";
    if ($open = fopen(ENV_FAJL, "r")) {
        $podaci = file(ENV_FAJL);
        fclose($open);

        // Provera da li su podaci preuzeti
        if(empty($podaci)) {
            echo "Podaci nisu preuzeti iz fajla!";
        } else {
            foreach($podaci as $value){
                $konfig = explode("=", trim($value));
                if($konfig[0] == $naziv && isset($konfig[1])) {
                    $vrednost = $konfig[1];
                    break;
                }
            }
        }
    } else {
        echo "Fajl nije otvoren!";
    }
    return $vrednost;
}


