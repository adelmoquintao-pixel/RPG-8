<?php
require "json_db.php";
$db = loadDB();
echo '<pre>';
print_r($db['usuarios']);
echo '</pre>';
