<?php
function db_file() {
    return __DIR__ . "/data.json";
}
function loadDB() {
    $f = db_file();
    if (!file_exists($f)) {
        file_put_contents($f, json_encode(["usuarios"=>[], "fichas"=>[]], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
    }
    $json = file_get_contents($f);
    return json_decode($json, true);
}
function saveDB($db) {
    $f = db_file();
    file_put_contents($f, json_encode($db, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
}
?>
